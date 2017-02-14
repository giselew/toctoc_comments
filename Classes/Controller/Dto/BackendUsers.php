<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * BackendUsers.php
 *
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 *
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   53: class toctoc_comments_be_users
 *   55:     public function beUsers(&$pObj, $pid = 0)
 *
 * TOTAL FUNCTIONS: 1
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */


/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_be_users {

	public function beUsers(&$pObj, $pid = 0) {

		$fromAjax = FALSE;
		if (!($_POST['oldbe'])) {
		    if (str_replace('ajax.php', '', $_SERVER['SCRIPT_NAME']) != $_SERVER['SCRIPT_NAME']) {
		    	$fromAjax = TRUE;

		    } else {
			    if (str_replace('typo3/index.php', '', $_SERVER['SCRIPT_NAME']) != $_SERVER['SCRIPT_NAME']) {
			    	$fromAjax = TRUE;
			    } else {
			    	 if (str_replace('typo3/deprecated.php', '', $_SERVER['SCRIPT_NAME']) != $_SERVER['SCRIPT_NAME']) {
			    		$fromAjax = TRUE;
			    	}
			    }
		    }
		} 

		$editTable = 'tx_toctoc_comments_user';
		$infomessage = '';
		    // Bulk actions
		if (isset($_POST['actuser'])) {
			$fields = array();
			if (isset($_POST['fields'])) {
				if (is_array($_POST['fields'])) {
					$fields = $_POST['fields'];
				} else {
					$fields = explode('-', $_POST['fields']);
				}
			}

			$numusers = count($fields);
			if ($numusers > 0) {
					$fields_new = '';
					$alertmsg=0;
					foreach($fields as $field) $fields_new .= ',"'. $field .'"';
					$fields_new = substr($fields_new, 1);
					$cachemessage = '';
					if ((intval($_POST['bulkactuser']) >= 1) && (intval($_POST['bulkactuser']) <= 3)) {
						$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('DISTINCT external_ref_uid, external_ref, external_prefix', 'tx_toctoc_comments_comments', 'toctoc_comments_user IN ('.$fields_new.')', '', '');
						$num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
						$cpidList = '';
						$external_ref_uidList = '';
						if (intval($num_rows) > 0) {
							$cachemessage .= '<br>';
							while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
								$external_ref_uid = $row['external_ref_uid'];

								if ($row['external_prefix'] == 'pages') {
									$cpidList .= ',' . intval(substr($row['external_ref'], 6));
								} else {
									$contentelementid = intval(substr($row['external_ref_uid'], 11));
									$page_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('pid', 'tt_content', 'uid='.$contentelementid);

									while($row_page=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($page_res)) {
										$cpidList .= ',' . $row_page['pid'];
									}
								}

								$res2 = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_plugincachecontrol', 'external_ref_uid="'.
										$external_ref_uid.'"', '', '');
								$num_rows2 = $GLOBALS['TYPO3_DB']->sql_num_rows($res2);
								if ($num_rows2>0) {
									$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET ' .
											'tstamp=' . time() .
											' WHERE external_ref_uid ="' . $external_ref_uid . '"');
									$external_ref_uidList .= ', ' . $external_ref_uid;
								} else {
									$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_plugincachecontrol',
											array(
													'tstamp' => time(),
													'external_ref_uid' => $external_ref_uid,
											)
									);
									$external_ref_uidList .= ', ' . $external_ref_uid;
								}

							}
							$external_ref_uidList = substr($external_ref_uidList, 1);
							$extArr = explode(',', $external_ref_uidList);
							$extArr = array_unique($extArr);
							$external_ref_uidList = implode (',', $extArr);
							$cachemessage .= 'Reset plugincachecontrol for ' . $external_ref_uidList;

							$cpidList = substr($cpidList, 1);
							$cpidArr = explode(',', $cpidList);
							$cpidArr = array_unique($cpidArr);
							$cpidList = implode (',', $cpidArr);
							$cachemessage .= '<br />Clear pagecache for pages ' . $cpidList;
							if (version_compare(TYPO3_version, '6.0', '<')) {
								t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
							} else {
								require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
							}

							$tce = t3lib_div::makeInstance('t3lib_TCEmain');

							/* @var $tce t3lib_TCEmain */
							foreach ($cpidArr as $cpid) {
								if ($cpid != 0) {
									if (intval($pObj->vmcNPC) == 0) {
										$tce->clear_cacheCmd($cpid);
									}

								}

							}
							unset($tce);
						}
					}

					if ($_POST['bulkactuser'] == '1') {
						// delete all user data
						$infomessage = $GLOBALS['LANG']->getLL('usersdelete1');
						if ($numusers !=1){
							$infomessage = sprintf($GLOBALS['LANG']->getLL('usersdeleten'), $numusers);
						}

						$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET deleted=1 WHERE toctoc_comments_user IN ('.$fields_new.')');
					  	$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET deleted=1 WHERE toctoc_comments_user IN ('.$fields_new.')');

					  $resd = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'toctoc_comments_user IN ('.$fields_new.')', '', 'uid DESC');
					  $num_rowsd = $GLOBALS['TYPO3_DB']->sql_num_rows($resd);
					  if (intval($num_rowsd) > 0) {
						  	while($rowd=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd)) {
						  		if ($rowd['attachment_id'] > 0) {
						  			$resdamm = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_attachment_mm', 'uid = '.$rowd['attachment_id'].'', '', '');
						  			$num_rowsamm = $GLOBALS['TYPO3_DB']->sql_num_rows($resdamm);
						  			if (intval($num_rowsamm) > 0) {
						  				while($rowdamm=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resdamm)) {
						  					if ($rowdamm['attachmentid'] > 0) {
						  						$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_attachment SET deleted=1 WHERE uid='.$rowdamm['attachmentid'].'');

						  					}

						  				}
						  				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_attachment_mm SET deleted=1 WHERE uid='.$rowd['attachment_id'].'');

						  			}

						  		}
						  		// comments children test
						  		$haschildren = FALSE;
						  		$currentpid=0;
						  		$resdac = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND parentuid = '.$rowd['uid'].'', '', 'uid DESC');
						  		$num_rowsac = $GLOBALS['TYPO3_DB']->sql_num_rows($resdac);
						  		if (intval($num_rowsac) > 0) {
						  			while($rowdac=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resdac)) {
						  				if (($rowdac['parentuid'] > 0) && ($rowdac['deleted'] == 0)) {
						  					$haschildren = TRUE;
						  					$currentpid=$rowdac['pid'];
						  					break;
						  				}

						  			}

						  		}

						  		if ($haschildren == TRUE) {
						  			// ckeck the deleted user
						  			if ($pObj->deleteduserischecked == FALSE) {
							  			$resdusr = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'toctoc_comments_user', 'toctoc_comments_user = "0.0.0.127.0" AND deleted=0 AND pid = '.$currentpid, '', '');
							  			$num_rowsdusr = $GLOBALS['TYPO3_DB']->sql_num_rows($resdusr);
							  			if (intval($num_rowsdusr) == 0) {
							  				$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user', array(
							  						'crdate' => time(),
							  						'tstamp' => time(),
													'tstamp_lastupdate' => time(),
							  						'pid' => $currentpid,
							  						'toctoc_comments_user' => '0.0.0.127.0',
							  						'ipresolved' => '',
							  						'ip' => '0.0.0.127',
							  						'initial_firstname' => $delusers_firstname,
							  						'initial_lastname' => $delusers_lastname,
							  						'initial_email' => $delusers_email,
							  						'initial_homepage' => '',
							  						'initial_location' => '',
							  						'current_ip' => '0.0.0.127',
							  						'current_firstname' => $delusers_firstname,
							  						'current_lastname' => $delusers_lastname,
							  						'current_email' => $delusers_email,
							  						'current_homepage' => '',
							  						'current_location' => '',
							  				));
							  			}
							  			$pObj->deleteduserischecked = TRUE;
						  			}
						  			//set comment user to deleted user 0.0.0.127.0, firstname: deleted, lastname: user, web:'', email deleteduser@void.tt
						  			$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET firstname="'. $delusers_firstname. '", ' .
						  					'lastname="'. $delusers_lastname. '", ' .
						  					'email="'. $delusers_email. '", ' .
						  					'location="", ' .
						  					'remote_addr="0.0.0.127", ' .
						  					'content="' . $GLOBALS['LANG']->getLL('commentdeleted') . '", ' .
						  					'attachment_id=0, ' .
						  					'attachment_subid=0, ' .
						  					'gender=0, ' .
						  					'commenttitle="", ' .
						  					'tx_commentsresponse_response="", ' .
						  					'toctoc_commentsfeuser_feuser=0, ' .
						  					'toctoc_comments_user="0.0.0.127.0", ' .
						  					'tx_commentsnotify_notify=0, ' .
						  					'homepage="" ' .
						  					'WHERE uid ='.$rowd['uid'].'');
						  		} else {
						  			$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET deleted=1 WHERE uid ='.$rowd['uid']);
							  	}

						  	}

					  	}
					  	// check new "old" deleted users comments that can be deleted (because children just have been deleted)
					  	// It does the level above (not more)
					  	$resd = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted= 0 AND email ="'.$delusers_email.'"', '', 'uid DESC');
					  	$num_rowsd = $GLOBALS['TYPO3_DB']->sql_num_rows($resd);
					  	if (intval($num_rowsd) > 0) {
					  		while($rowd=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd)) {

					  			// comments children test
					  			$haschildren = FALSE;
					  			$currentpid=0;
					  			$resdac = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND parentuid = '.$rowd['uid'].'', '', 'uid DESC');
					  			$num_rowsac = $GLOBALS['TYPO3_DB']->sql_num_rows($resdac);
					  			if (intval($num_rowsac) > 0) {
					  				while($rowdac=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resdac)) {
					  					if (($rowdac['parentuid'] > 0) && ($rowdac['deleted'] == 0)) {
					  						$haschildren = TRUE;
					  						$currentpid=$rowdac['pid'];
					  						break;
					  					}
					  				}
					  			}

					  			if ($haschildren == FALSE)  {
					  				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET deleted=1 WHERE uid ='.$rowd['uid']);
					  			}

					  		}

					  	}
					} elseif ($_POST['bulkactuser'] == '2') {
						$infomessage = $GLOBALS['LANG']->getLL('permanentusersdelete1');
						if ($numusers !=1){
							$infomessage = sprintf($GLOBALS['LANG']->getLL('permanentusersdeleten'), $numusers);
						}

						// kill all user data
						$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_user WHERE toctoc_comments_user IN ('.$fields_new.')');
						$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_feuser_mm WHERE toctoc_comments_user IN ('.$fields_new.')');

						$resd = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'toctoc_comments_user IN ('.$fields_new.')', '', 'uid DESC');
						$num_rowsd = $GLOBALS['TYPO3_DB']->sql_num_rows($resd);
						if (intval($num_rowsd) > 0) {
							while($rowd=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd)) {
						  		if ($rowd['attachment_id'] > 0) {
						  			$resdamm = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_attachment_mm', 'uid = '.$row['attachment_id'].'', '', '');
						  			$num_rowsamm = $GLOBALS['TYPO3_DB']->sql_num_rows($resdamm);
						  			if (intval($num_rowsamm) > 0) {
						  				while($rowdamm=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resdamm)) {
						  					if ($rowdamm['attachmentid'] > 0) {
						  						$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_attachment WHERE uid='.$rowdamm['attachmentid'].'');
						  					}

						  				}
						  				$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_attachment_mm WHERE uid='.$rowd['attachment_id'].'');
						  			}

						  		}

					  			// comments children test
								$haschildren = FALSE;
								  $currentpid=0;
								  $resdac = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND parentuid = '.$rowd['uid'].'', '', 'uid DESC');
								  $num_rowsac = $GLOBALS['TYPO3_DB']->sql_num_rows($resdac);
								  if (intval($num_rowsac) > 0) {
								  	while($rowdac=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resdac)) {
								  		if (($rowdac['parentuid'] > 0) && ($rowdac['deleted'] == 0)) {
								  			$haschildren = TRUE;
								  			$currentpid=$rowdac['pid'];
								  			break;
								  		}
								  	}
								  }

								  if ($haschildren == TRUE) {
								  	// ckeck the deleted user
								  	if ($pObj->deleteduserischecked == FALSE) {
									  	$resdusr = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'toctoc_comments_user', 'toctoc_comments_user = "0.0.0.127.0" AND deleted=0 AND pid = '.$currentpid, '', '');
									  	$num_rowsdusr = $GLOBALS['TYPO3_DB']->sql_num_rows($resdusr);
									  	if (intval($num_rowsdusr) == 0) {
									  			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user', array(
																'crdate' => time(),
																'tstamp' => time(),
																'tstamp_lastupdate' => time(),
																'pid' => $currentpid,
																'toctoc_comments_user' => '0.0.0.127.0',
																'ipresolved' => '',
																'ip' => '0.0.0.127',
																'initial_firstname' => $delusers_firstname,
																'initial_lastname' => $delusers_lastname,
																'initial_email' => $delusers_email,
																'initial_homepage' => '',
																'initial_location' => '',
											  					'current_ip' => '0.0.0.127',
											  					'current_firstname' => $delusers_firstname,
											  					'current_lastname' => $delusers_lastname,
											  					'current_email' => $delusers_email,
											  					'current_homepage' => '',
											  					'current_location' => '',
														));
						  				}
						  				$pObj->deleteduserischecked = TRUE;
								  	}

					  	//set comment user to deleted user 0.0.0.127.0, firstname: deleted, lastname: user, web:'', email deleteduser@void.tt
						  			$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET firstname="'. $delusers_firstname. '", ' .
						  			'lastname="'. $delusers_lastname. '", ' .
						  			'email="'. $delusers_email. '", ' .
						  			'location="", ' .
						  			'remote_addr="0.0.0.127", ' .
						  			'content="' . $GLOBALS['LANG']->getLL('commentdeleted') . '", ' .
						  			'attachment_id=0, ' .
						  			'attachment_subid=0, ' .
						  			'gender=0, ' .
						  			'commenttitle="", ' .
						  			'tx_commentsresponse_response="", ' .
						  			'toctoc_commentsfeuser_feuser=0, ' .
						  			'toctoc_comments_user="0.0.0.127.0", ' .
						  			'tx_commentsnotify_notify=0, ' .
						  			'homepage="" ' .
						  			'WHERE uid ='.$rowd['uid'].'');

						  		} else {
						  			$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_comments WHERE uid ='. $rowd['uid']);
						  		}

					  		}

					  	}
					  	// check new "old" deleted users comments that can be deleted (because children just have been deleted)
					  	// It does the level above (not more)

					  	$resd = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND email ="' . $delusers_email . '"', '', 'uid DESC');
					  	$num_rowsd = $GLOBALS['TYPO3_DB']->sql_num_rows($resd);
					  	if (intval($num_rowsd) > 0) {
					  		while($rowd=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd)) {

					  			// comments children test
					  			$haschildren = FALSE;
					  			$currentpid=0;
					  			$resdac = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND parentuid = '.$rowd['uid'].'', '', 'uid DESC');
					  			$num_rowsac = $GLOBALS['TYPO3_DB']->sql_num_rows($resdac);
					  			if (intval($num_rowsac) > 0) {
					  				while($rowdac=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resdac)) {
					  					if (($rowdac['parentuid'] > 0) && ($rowdac['deleted'] == 0)) {
					  						$haschildren = TRUE;
					  						$currentpid=$rowdac['pid'];
					  						break;
					  					}
					  				}
					  			}

					  			if ($haschildren == FALSE)  {
					  				$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_comments WHERE uid ='.$rowd['uid']);
					  			}

					  		}

					  	}

					} elseif ($_POST['bulkactuser'] == '3') {
						$newuser=trim($_POST['mergeuser']);
						$newusercheck = explode('.', $newuser);
						if (count($newusercheck) == 5) {
							$feuseruid = str_replace('0.0.0.0.', '', $newuser);
							if ($feuseruid == $newuser) {
								$feuseruid = 0;
							}

							$infomessage = $GLOBALS['LANG']->getLL('mergeusers1');
							if ($numusers !=1){
								$infomessage = sprintf($GLOBALS['LANG']->getLL('mergeusersn'), $numusers);
							}

							$infomessage .= ' ' . $newuser . '.';
							$currentpid=0;
							// check new user
							$resd = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_user', 'toctoc_comments_user ="'.$newuser.'" AND deleted=0', '', '');
							$num_rowsd = $GLOBALS['TYPO3_DB']->sql_num_rows($resd);
							if (intval($num_rowsd) > 0) {
								while($rowd=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd)) {
									if ($rowd['pid'] != $currentpid) {
										$currentpid=$rowd['pid'];
										$lasttimestamp = $rowd['tstamp'];
										$lasttimestamplastupdate = $rowd['tstamp_lastupdate'];
										$oldestcrdate = $rowd['crdate'];
										$comment_count = $rowd['comment_count'];
										$average_rating = $rowd['average_rating'];
										$rating=0;
										if (intval($rowd['vote_count'])>0) {
											if ($rowd['average_rating'] > 0) {
												$rating = $rowd['average_rating']*intval($rowd['vote_count']);
											}
										}

										$vote_count = $rowd['vote_count'];
										$like_count = $rowd['like_count'];
										$dislike_count = $rowd['dislike_count'];
										//ip remains untouched as its linked to the userid

										$initial_firstname = $rowd['initial_firstname'];
										$initial_lastname = $rowd['initial_lastname'];
										$initial_email = $rowd['initial_email'];
										$initial_homepage = $rowd['initial_homepage'];
										$initial_location = $rowd['initial_location'];

										$current_firstname = $rowd['current_firstname'];
										$current_lastname = $rowd['current_lastname'];
										$current_email = $rowd['current_email'];
										$current_homepage = $rowd['current_homepage'];
										$current_location = $rowd['current_location'];
										$current_ip = $rowd['current_up'];
										$optindate = $rowd['optindate'];
										$optin_ip = $rowd['optin_ip'];
										$optin_email = $rowd['optin_email'];

										$resd2 = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_user', 'toctoc_comments_user IN ('.$fields_new.') AND deleted=0 AND pid = ' .
												$currentpid, '', '');
										$num_rowsd2 = $GLOBALS['TYPO3_DB']->sql_num_rows($resd2);
										if (intval($num_rowsd2) > 0) {
											while($rowd2=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd2)) {
												if ($rowd['toctoc_comments_user'] != $rowd2['toctoc_comments_user']) {
													$comment_count += intval($rowd2['comment_count']);
													if (intval($rowd2['vote_count']) > 0) {
														if ($rowd2['average_rating'] > 0) {
															$rating2 = $rowd2['average_rating']*intval($rowd2['vote_count']);
															if ($rating2 != 0) {
																$rating= $rating + $rating2;
															}

															$vote_count += $rowd2['vote_count'];

															if ($vote_count != 0) {
																$average_rating = $rating/$vote_count;
															}
														}
													}

													$like_count += intval($rowd2['like_count']);
													$dislike_count += intval($rowd2['dislike_count']);

													if (($lasttimestamp > $rowd2['tstamp']) && ($rowd2['tstamp'] !=0)) {
														$lasttimestamp = $rowd2['tstamp'];
													}

													if ($lasttimestamplastupdate < $rowd2['tstamp_lastupdate']) {
														$lasttimestamplastupdate = $rowd2['tstamp_lastupdate'];
														if (($rowd2['current_firstname'] != '') && ($rowd2['current_lastname'] != '')) {
															$current_firstname = $rowd2['current_firstname'];
															$current_lastname = $rowd2['current_lastname'];
														} elseif (($rowd2['current_firstname'] == '') && ($rowd2['current_lastname'] != '')) {
															$current_lastname = $rowd2['current_lastname'];
														}

														if ($rowd2['current_email'] != '') {
															$current_email = $rowd2['current_email'];
														}

														if ($rowd2['current_homepage'] != '') {
															$current_homepage = $rowd2['current_homepage'];
														}

														if ($rowd2['current_location'] != '') {
															$current_location = $rowd2['current_location'];
														}

														if ($rowd2['current_ip'] != '') {
															$current_ip = $rowd2['current_ip'];
														}

													} else {
														if ($current_firstname == '') {
															$current_firstname = $rowd2['current_firstname'];
														}

														if ($current_lastname == '') {
															$current_lastname = $rowd2['current_lastname'];
														}

														if ($current_email == '') {
															$current_email = $rowd2['current_email'];
														}

														if ($current_homepage == '') {
															$current_homepage = $rowd2['current_homepage'];
														}

														if ($current_location == '') {
															$current_location = $rowd2['current_location'];
														}

														if ($current_ip == '') {
															$current_ip = $rowd2['current_ip'];
														}
													}

													if (($oldestcrdate > $rowd2['crdate']) && ($rowd2['crdate'] !=0)) {
														$oldestcrdate = $rowd2['crdate'];
														if (($rowd2['initial_firstname'] != '') && ($rowd2['initial_lastname'] != '')) {
															$initial_firstname = $rowd2['initial_firstname'];
															$initial_lastname = $rowd2['initial_lastname'];
														} elseif (($rowd2['initial_firstname'] == '') && ($rowd2['initial_lastname'] != '')) {
															$initial_lastname = $rowd2['initial_lastname'];
														}

														if ($rowd2['initial_email'] != '') {
															$initial_email = $rowd2['initial_email'];
														}

														if ($rowd2['initial_homepage'] != '') {
															$initial_homepage = $rowd2['initial_homepage'];
														}

														if ($rowd2['initial_location'] != '') {
															$initial_location = $rowd2['initial_location'];
														}
													}

													if (($initial_firstname == '') && ($rowd2['initial_firstname'] != '') && ($rowd2['initial_lastname'] != '')) {
														$initial_firstname = $rowd2['initial_firstname'];
														$initial_lastname = $rowd2['initial_lastname'];
													}

													if (($initial_firstname == '' ) && ($rowd2['initial_firstname'] != '')) {
														$initial_firstname = $rowd2['initial_firstname'];
													}

													if (($initial_lastname == '' ) && ($rowd2['initial_lastname'] != '')) {
														$initial_lastname = $rowd2['initial_lastname'];
													}

													if (intval($rowd2['optindate']) != 0) {
														if ((intval($optindate) > intval($rowd2['optindate'])) && (intval($rowd2['optindate']) !=0)) {
															$optindate=$rowd2['optindate'];
															$optin_ip = $rowd2['optin_ip'];
															$optin_email = $rowd2['optin_email'];
														}

													}

												}

											}
										}
										// merge into new user
										$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET
												tstamp ='. intval($lasttimestamp) . ',
												crdate ='. intval($oldestcrdate) . ',
												initial_firstname ="'. $initial_firstname . '",
												initial_lastname ="'. $initial_lastname . '",
												initial_email ="'. $initial_email . '",
												initial_homepage ="'. $initial_homepage . '",
												initial_location ="'. $initial_location . '",
												comment_count='. intval($comment_count) . ',
												average_rating ='. $average_rating . ',
												vote_count='. intval($vote_count) . ',
												like_count='. intval($like_count) . ',
												dislike_count='. intval($dislike_count) . ',
												current_firstname ="'. $current_firstname . '",
												current_lastname ="'. $current_lastname . '",
												current_email ="'. $current_email . '",
												current_homepage ="'. $current_homepage . '",
												current_location ="'. $current_location . '",
												current_ip ="'. $current_ip . '",
												tstamp_lastupdate ='. intval($lasttimestamplastupdate) . ',
												optindate ='. intval($optindate) . ',
												optin_email ="'. $optin_email . '",
												optin_ip ="'. $optin_ip . '"
												WHERE toctoc_comments_user = "' . $newuser.
												'" AND deleted=0 AND pid = ' . $currentpid, '');

										// delete old users
										$fields_new_wo_newuser = str_replace($newuser, '0.0.0.0.0', $fields_new);
										$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_user
												WHERE toctoc_comments_user IN ('.$fields_new_wo_newuser. ') AND deleted=0 AND pid = ' . $currentpid, '');
									}

								}

								$fields_new_wo_newuser = str_replace($newuser, '0.0.0.0.0', $fields_new);
								$currentpid = 0;
								$resd = $GLOBALS['TYPO3_DB']->exec_SELECTquery('DISTINCT pid', 'tx_toctoc_comments_feuser_mm', 'toctoc_comments_user ="'.$newuser.
										'" AND deleted=0', '', '');
								$num_rowsd = $GLOBALS['TYPO3_DB']->sql_num_rows($resd);
								if (intval($num_rowsd) > 0) {
									while($rowd=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd)) {
										if ($rowd['pid'] != $currentpid) {
											$currentpid=$rowd['pid'];
											$resd2 = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_feuser_mm', 'toctoc_comments_user IN ('.
													$fields_new_wo_newuser.') AND deleted=0 AND pid = ' .
													$currentpid, '', 'reference');
											$reference = '';
											$reference_scope = '';
											$remote_addr = '';
											$updatefemm = FALSE;
											$num_rowsd2 = $GLOBALS['TYPO3_DB']->sql_num_rows($resd2);
											if (intval($num_rowsd2) > 0) {
												while($rowd2=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd2)) {
													if (($reference != $rowd2['reference'] ) || ($reference_scope != $rowd2['reference_scope'])) {
														if ($reference != '') {
															// update $newusers tx_toctoc_comments_feuser_mm for $reference/$reference_scope/$currentpid
															if ($updatefemm == TRUE) {
																$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET
																		tstamp = '.$tstamp.',
																		crdate = '.$crdate.',
																		tstampilike = '.$tstampilike.',
																		tstampidislike = '.$tstampidislike.',
																		tstampmyrating = '.$tstampmyrating.',
																		tstampseen = '.$tstampseen.',
																		pagetstampilike = '.$pagetstampilike.',
																		pagetstampidislike = '.$pagetstampidislike.',
																		pagetstampmyrating ='.$pagetstampmyrating.',
																		pagetstampseen = '.$pagetstampseen.',
																		ilike = '.$ilike.',
																		idislike = '.$idislike.',
																		myrating = '.$myrating.',
																		seen = '. $seen.' WHERE toctoc_comments_user = "'.$newuser.
																		'" AND reference="'.$reference.'" AND reference_scope = '.$reference_scope.
																		' AND pid = ' . $currentpid);
															} else {
																// insert new tx_toctoc_comments_feuser_mm
																$newfeuser = str_replace('0.0.0.0.', '', $newuser);
																if ($newfeuser == $newuser) {
																	$newfeuser = 0;
																}

																$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
																		'reference' => $reference,
																'reference_scope' => $reference_scope,
																'pid' => $currentpid,
																'tstamp' => $tstamp,
																'crdate' => $crdate,
																'tstampilike' => $tstampilike,
																'tstampidislike' => $tstampidislike,
																'tstampmyrating' => $tstampmyrating,
																'tstampseen' => $tstampseen,
																'pagetstampilike' => $pagetstampilike,
																'pagetstampidislike' => $pagetstampidislike,
																'pagetstampmyrating' => $pagetstampmyrating,
																'pagetstampseen' => $pagetstampseen,
																'ilike' => $ilike,
																'idislike' => $idislike,
																'myrating' => $myrating,
																'seen' => $seen,
														'toctoc_comments_user' => $newuser,
														'toctoc_commentsfeuser_feuser' => $newfeuser,
																'remote_addr' => $remote_addr,
																));

															}
															// delete $fields_new_wo_newuser tx_toctoc_comments_feuser_mm for $reference/$reference_scope/$currentpid
															$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_feuser_mm
																	WHERE toctoc_comments_user IN ('.$fields_new_wo_newuser. ') AND reference="'.
																	$reference.'" AND reference_scope = '.$reference_scope.' AND pid = ' . $currentpid, '');
														}

														$reference = $rowd2['reference'];
														$reference_scope = $rowd2['reference_scope'];
														$resd3 = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_feuser_mm',
																'toctoc_comments_user = "'.$newuser.'" AND
																reference="'.$reference.'" AND
																reference_scope = '.$reference_scope.' AND
																pid = ' . $currentpid);
														$num_rowsd3 = $GLOBALS['TYPO3_DB']->sql_num_rows($resd3);
														$updatefemm = FALSE;

														if (intval($num_rowsd3) > 0) {
															while($rowd3=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($resd3)) {
																$updatefemm = TRUE;
																$tstamp = $rowd3['tstamp'];
																$crdate = $rowd3['crdate'];
																$tstampilike = $rowd3['tstampilike'];
																$tstampidislike = $rowd3['tstampidislike'];
																$tstampmyrating = $rowd3['tstampmyrating'];
																$tstampseen = $rowd3['tstampseen'];
																$pagetstampilike = $rowd3['pagetstampilike'];
																$pagetstampidislike = $rowd3['pagetstampidislike'];
																$pagetstampmyrating = $rowd3['pagetstampmyrating'];
																$pagetstampseen = $rowd3['pagetstampseen'];
																$ilike = $rowd3['ilike'];
																$idislike = $rowd3['idislike'];
																$myrating = $rowd3['myrating'];
																$seen = $rowd3['seen'];
																$remote_addr = $rowd3['remote_addr'];
															}

														} else {
															$remote_addr = '';
															$tstamp = 0;
															$crdate = 0;
															$tstampilike = 0;
															$tstampidislike = 0;
															$tstampmyrating = 0;
															$tstampseen = 0;
															$pagetstampilike = 0;
															$pagetstampidislike = 0;
															$pagetstampmyrating = 0;
															$pagetstampseen = 0;
															$ilike = 0;
															$idislike = 0;
															$myrating = 0;
															$seen = 0;
														}

													}

													if (($remote_addr == '') && ($rowd2['remote_addr'] != '')) {
														$remote_addr = $rowd2['remote_addr'];
													}

													if ($rowd2['seen'] != 0) {
														$seen = $rowd2['seen'];
													}

													if ($rowd2['myrating'] > 0) {
														if ($myrating > 0) {
															$myrating= ($rowd2['myrating']+$myrating)/2;
														} else {
															$myrating = $rowd2['myrating'];
														}

													}

													if (($rowd2['ilike'] != 0) && ($idislike == 0)) {
														$like = $rowd2['ilike'];
													}

													if (($rowd2['idislike'] != 0) && ($ilike ==0)) {
														$idislike = $rowd2['idislike'];
													}

													if ($rowd2['pagetstampseen'] != 0) {
														if ($pagetstampseen == 0) {
															$pagetstampseen = $rowd2['pagetstampseen'];
														}

													}

													if ($rowd2['tstampseen'] != 0) {
														if ($tstampseen == 0) {
															$tstampseen = $rowd2['tstampseen'];
														} elseif ($tstampseen > $rowd2['tstampseen']) {
															$tstampseen = $rowd2['tstampseen'];
														}

													}

													if ($rowd2['pagetstampmyrating'] != 0) {
														if ($pagetstampmyrating == 0) {
															$pagetstampmyrating = $rowd2['pagetstampmyrating'];
														}

													}

													if ($rowd2['tstampmyrating'] != 0) {
														if ($tstampmyrating == 0) {
															$tstampmyrating = $rowd2['tstampmyrating'];
														} elseif ($tstampmyrating > $rowd2['tstampmyrating']) {
															$tstampmyrating = $rowd2['tstampmyrating'];
														}

													}

													if ($rowd2['pagetstampidislike'] != 0) {
														if ($pagetstampidislike == 0) {
															$pagetstampidislike = $rowd2['pagetstampidislike'];
														}

													}

													if ($rowd2['tstampidislike'] != 0) {
														if ($tstampidislike == 0) {
															$tstampidislike = $rowd2['tstampidislike'];
														} elseif ($tstampidislike > $rowd2['tstampidislike']) {
															$tstampidislike = $rowd2['tstampidislike'];
														}

													}

													if ($rowd2['pagetstampilike'] != 0) {
														if ($pagetstampilike == 0) {
															$pagetstampilike = $rowd2['pagetstampilike'];
														}

													}

													if ($rowd2['tstampilike'] != 0) {
														if ($tstampilike == 0) {
															$tstampilike = $rowd2['tstampilike'];
														} elseif ($tstampilike > $rowd2['tstampilike']) {
															$tstampilike = $rowd2['tstampilike'];
														}

													}

													if ($rowd2['crdate'] != 0) {
														if ($crdate == 0) {
															$crdate = $rowd2['crdate'];
														} elseif ($crdate > $rowd2['crdate']) {
															$crdate = $rowd2['crdate'];
														}

													}

													if ($rowd2['tstamp'] != 0) {
														if ($tstamp == 0) {
															$tstamp = $rowd2['tstamp'];
														} elseif ($tstamp > $rowd2['tstamp']) {
															$tstamp = $rowd2['tstamp'];
														}
													}

												}
												// last record
												if ($reference != '') {
													// update $newusers tx_toctoc_comments_feuser_mm for $reference/$reference_scope/$currentpid
													if ($updatefemm == TRUE) {
														$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET
																		tstamp = '.$tstamp.',
																		crdate = '.$crdate.',
																		tstampilike = '.$tstampilike.',
																		tstampidislike = '.$tstampidislike.',
																		tstampmyrating = '.$tstampmyrating.',
																		tstampseen = '.$tstampseen.',
																		pagetstampilike = '.$pagetstampilike.',
																		pagetstampidislike = '.$pagetstampidislike.',
																		pagetstampmyrating = '.$pagetstampmyrating.',
																		pagetstampseen = '.$pagetstampseen.',
																		ilike = '.$ilike.',
																		idislike = '.$idislike.',
																		myrating = '.$myrating.',
																		seen = '. $seen.' WHERE toctoc_comments_user = "'.$newuser.
																'" AND reference="'.$reference.'" AND reference_scope = '.$reference_scope.
																' AND pid = ' . $currentpid);
													} else {
														// insert new tx_toctoc_comments_feuser_mm
														$newfeuser = str_replace('0.0.0.0.', '', $newuser);
														if ($newfeuser == $newuser) {
															$newfeuser = 0;
														}

														$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
																'reference' => $reference,
																'reference_scope' => $reference_scope,
																'pid' => $currentpid,
																'tstamp' => $tstamp,
																'crdate' => $crdate,
																'tstampilike' => $tstampilike,
																'tstampidislike' => $tstampidislike,
																'tstampmyrating' => $tstampmyrating,
																'tstampseen' => $tstampseen,
																'pagetstampilike' => $pagetstampilike,
																'pagetstampidislike' => $pagetstampidislike,
																'pagetstampmyrating' => $pagetstampmyrating,
																'pagetstampseen' => $pagetstampseen,
																'ilike' => $ilike,
																'idislike' => $idislike,
																'myrating' => $myrating,
																'seen' => $seen,
																'toctoc_comments_user' => $newuser,
																'toctoc_commentsfeuser_feuser' => $newfeuser,
																'remote_addr' => $remote_addr,
														));

													}
													// delete $fields_new_wo_newuser tx_toctoc_comments_feuser_mm for $reference/$reference_scope/$currentpid
													$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_feuser_mm
																	WHERE toctoc_comments_user IN ('.$fields_new_wo_newuser. ') AND reference="'.
															$reference.'" AND reference_scope = '.$reference_scope.' AND pid = ' . $currentpid, '');
												}

											}

										}

									}

								}

								//update comments to new user
								$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET
									toctoc_comments_user="'. $newuser . '",
									toctoc_commentsfeuser_feuser='. $feuseruid .
									' WHERE toctoc_comments_user IN ('.$fields_new.')');

							} else {
								$infomessage = sprintf($GLOBALS['LANG']->getLL('mergefailusernotexist'), $newuser);
								$alertmsg=1;
							}

						} else {
							$infomessage = sprintf($GLOBALS['LANG']->getLL('mergefailusermalformatted'), $numusers, $newuser);
							$alertmsg=1;
						}

					}

			} else {
	  			$infomessage = $GLOBALS['LANG']->getLL('nousersselected');
	  			$alertmsg = 1;
			}

		}

		if ($pObj->showcachemessage == FALSE) {
			$cachemessage='';
		}
		if ($infomessage != '') {
			if (isset($_POST['fromajax'])) {
				$outinfomessage = '<div class="tx-tc-messagebody">' . $infomessage . '</div><div class="tx-tc-messageclosebutton" title="'.$GLOBALS['LANG']->getLL('closemessage').'">x</div>';
				unset($_SESSION['backendcontentcommentlist']);
				$_SESSION['backendcontentlastlist'] = '';

			}
			if ($alertmsg == 1) {
				$infomessage = '<div class="tx-tc-alert" id="tx-tc-message">' . $infomessage . '</div>';
				$outinfomessage ='<div class="tx-tc-alert" id="tx-tc-message">' . $outinfomessage . '</div>';
			} else {
				$infomessage = '<div class="tx-tc-information" id="tx-tc-message">' . $infomessage . $cachemessage . '</div>';
				$outinfomessage = '<div class="tx-tc-information" id="tx-tc-message">' . $outinfomessage . $cachemessage . '</div>';
			}
			if (isset($_POST['fromajax'])) {
				$infomessage='';
			}
		}

		unset($_POST['actuser']);
		unset($_POST['bulkactuser']);

		unset($_POST['fields']);

		if (!$_SESSION['backendcontentuserslist']) {
		$content .= $infomessage;

		    // Show all users on root page
		    if($pid == 0) {
		      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_user', 'deleted=0 AND toctoc_comments_user != "0.0.0.127.0"', '', '');
		    } else {
		    // Show comments on page
				$page_array = array();
				$page_array[] = $pid; // Insert active pid in array
				// Show comments in subpages, if activated in ext manager
			      if($pObj->extConf['show_sub'] == 1) {
						$page_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'deleted=0 AND pid='.$pid);

						while($row_page=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($page_res)) {
						  $page_array[] = $row_page['uid'];
						}
			      }
			      $pages = implode(',', $page_array);
			      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_user', 'deleted=0 AND toctoc_comments_user != "0.0.0.127.0" AND pid IN ('.$pages.')', '', '');
		    }

		    $num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

		    // No user
		    if ($num_rows == '') {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('nouser').'</div>';
		    }

		    // Root Page and 1 user
		    else if ($num_rows == '1' && $pid == 0) {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('userglobal_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('userglobal_two').'</div>';
		    }

		    // Root Page and more than 1 user
		    else if ($num_rows > '1' && $pid == 0) {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('userglobalmore_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('userglobalmore_two').'</div>';
		    }

		    // 1 user
		    else if ($num_rows == '1') {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('oneuser_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('oneuser_two').'</div>';
		    }

		    // More user
		    else {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('moreusers_one').' <b>'.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('moreusers_two').'</div>';
		    }

		  	// Show Table Head only if at least 1 user exists.
		  	if($num_rows >= '1') {

		  	$content .= '<div class="tx-tc-flipflop">
				  		<div class="tx-tc-flips">'.$GLOBALS['LANG']->getLL('showup').': '.$GLOBALS['LANG']->getLL('showflip').'</div>
						<div class="tx-tc-flipflop-cont">
						  	<div class="tx-tc-flip1">'.$GLOBALS['LANG']->getLL('pid').'</div>
						  	<div class="tx-tc-flop1">'.$GLOBALS['LANG']->getLL('date').'</div>
						  	<div class="tx-tc-flip2">'.$GLOBALS['LANG']->getLL('initial_name').'</div>
						  	<div class="tx-tc-flop2">'.$GLOBALS['LANG']->getLL('current_name').'</div>
						  	<div class="tx-tc-flip3">'.$GLOBALS['LANG']->getLL('initial_email').'</div>
						  	<div class="tx-tc-flop3">'.$GLOBALS['LANG']->getLL('current_email').'</div>

						</div>
				  	</div>
				    <fieldset>
				      <table id="tablesorter-user" class="tablesorter">
				      <thead>
					<tr>
					  <th class="id tx-tc-wm100">'.$GLOBALS['LANG']->getLL('toctoc_comments_user').'</th>
					  <th class="tx-tc-wm40 tx-tc-flip1-col">'.$GLOBALS['LANG']->getLL('pid').'</th>
					  <th class="tx-tc-wm100 tx-tc-flop1-col">'.$GLOBALS['LANG']->getLL('date').'</th>
					  <th class="tx-tc-wm100 tx-tc-flip2-col">'.$GLOBALS['LANG']->getLL('initial_name').'</th>
					  <th class="tx-tc-wm100 tx-tc-flip3-col">'.$GLOBALS['LANG']->getLL('initial_email').'</th>
					  <th class="tx-tc-wm100 tx-tc-flop2-col">'.$GLOBALS['LANG']->getLL('current_name').'</th>
					  <th class="tx-tc-wm100 tx-tc-flop3-col">'.$GLOBALS['LANG']->getLL('current_email').'</th>
					  <th class="tx-tc-wm150nomax">'.$GLOBALS['LANG']->getLL('report').'</th>
		       		  <th class="tx-tc-wm20"><input type="checkbox" class="checkall tx-tc-wm20" title="'.$GLOBALS['LANG']->getLL('check_all').'"></th>
					</tr>
					</thead>';
					}

				while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				  // Get the fields

						if ($row['toctoc_comments_user'] != '0.0.0.127.0') {

							  $editTable = 'tx_toctoc_comments_user';
							  $uid = $row['uid'];
							  $editUid = $row['toctoc_comments_user'];
							  $pid_record = $row['pid'];
							  $hiddenField = 'hidden';
							  $approvedField = 'approved';
							  $name = ''.$row['initial_firstname'].' '.$row['initial_lastname'].'';
							  $currentname = ''.$row['current_firstname'].' '.$row['current_lastname'].'';
							  $initial_email = ''.$row['initial_email'].'';
							  $current_email = ''.$row['current_email'].'';

							  $report='';
							  // vote of the user
							  $feuseruid = str_replace('0.0.0.0.', '', $row['toctoc_comments_user']);
							  if ($feuseruid == $row['toctoc_comments_user']) {
							  	$feuseruid = 0;
							  }
							  $toctocuid = $row['toctoc_comments_user'];
							  $dataWhereuser = 'deleted= 0 AND pid=' . intval($row['pid']) .
							  ' AND toctoc_comments_user = "' . $toctocuid . '"';
							  $subWheretoctocuser = ' AND toctoc_comments_user = "' . $toctocuid . '"';
							  $dataWhereusersum = 'deleted=0 ' . $subWheretoctocuser;
							list($rowusrsum) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('MIN(tstamp) AS tstamp, MIN(pid) AS pid, MIN(uid) AS uid,
				SUM(comment_count) AS comment_count, SUM(vote_count*average_rating)/SUM(vote_count) AS average_rating,
				SUM(vote_count) AS vote_count, SUM(like_count) AS like_count, SUM(dislike_count) AS dislike_count, MAX(tstamp_lastupdate) AS tstamp_lastupdate',
							  		'tx_toctoc_comments_user',
							  		$dataWhereusersum);
							if (str_replace('0.0.0.0.', '', $row['toctoc_comments_user']) != $row['toctoc_comments_user']) {

								  $pizzateile = explode('.', $toctocuid);
								  $feuserid = $pizzateile[4];
								  if (((trim($initial_email) == '') && (trim($current_email) == '') && ($feuserid != 0)) ||
								  		((trim($currentname) == '') && ($feuserid != 0))) {
									  $dataWherefeuser = 'uid=' . intval($feuseruid);
									  list($rowfeusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
									  		'fe_users', $dataWherefeuser);
									  if ((trim($currentname) == '') && ($feuserid != 0)){
									  	$currentname = ''.$rowfeusr['first_name'].' '.$rowfeusr['last_name'].'';
									  	if (trim($currentname) == '') {
									  		$currentname=$rowfeusr['username'];
									  	}
									  }

									  if ((trim($initial_email) == '') && (trim($current_email) == '') && ($feuserid != 0)){
									  	$initial_email =$rowfeusr['email'];
									  }
								  }
							}

							$dataWherecomment = 'toctoc_comments_user= "' . $toctocuid . '" AND deleted= 0 AND pid=' . intval($row['pid']);
							list($rowcomment) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
							  		'tx_toctoc_comments_comments', $dataWherecomment);

							if (($rowusrsum['comment_count'] != '') && ($rowusrsum['comment_count'] != '0')) {
							  	$report .=$GLOBALS['LANG']->getLL('pi1_template.uc.comments') . ' ' . $rowusrsum['comment_count'];
							 }

							  if (($rowusrsum['vote_count'] != '') && ($rowusrsum['vote_count'] != '0')) {
							  	if ($report != '') {
							  		$report .= ', ';
							  	}

							  	$report.= $GLOBALS['LANG']->getLL('pi1_template.uc.rateditems') . ' ' . $rowusrsum['vote_count'];
							  }

							  if (($rowusrsum['average_rating'] != '') && (round($rowusrsum['average_rating'], 2) != '0.00')) {
							  	if ($report != '') {
							  		$report .= '<br />';
							  	}

							  	$report .= $GLOBALS['LANG']->getLL('pi1_template.uc.averagerating') . ' ' . round($rowusrsum['average_rating'], 2);
							  }

							  if (($rowusrsum['like_count'] != '') && ($rowusrsum['like_count'] != '0')) {
							  	if ($report != '') {
							  		$report .= ', ';
							  	}

							  	$report.= $GLOBALS['LANG']->getLL('pi1_template.uc.likes') . ' ' . $rowusrsum['like_count'];
							  }

							  if (($rowusrsum['dislike_count'] != '') && ($rowusrsum['dislike_count'] != '0')) {
							  	if ($report != '') {
							  		$report .= ', ';
							  	}

							  	$report.= $GLOBALS['LANG']->getLL('pi1_template.uc.dislikes') . ' ' . $rowusrsum['dislike_count'];
							  }

							  if (intval($rowusrsum['tstamp']) != 0) {
							  	if ($report != '') {
							  		$report .= '<br />';
							  	}

							  	$report.= $GLOBALS['LANG']->getLL('pi1_template.uc.joined') . ' ' . ''.date('d.m.Y', $rowusrsum['tstamp']).' - '.date('H:i', $rowusrsum['tstamp']).'';
							  }

							  if (intval($rowusrsum['tstamp_lastupdate']) != 0) {
							  	if ($rowusrsum['tstamp_lastupdate'] != $rowusrsum['tstamp'] ) {
							  		if ($report != '') {
							  			$report .= '<br />';
							  		}

							  		$report.= $GLOBALS['LANG']->getLL('pi1_template.uc.lastactivity') . ' ' .
							  				''.date('d.m.Y', $rowusrsum['tstamp_lastupdate']).' - '.date('H:i', $rowusrsum['tstamp_lastupdate']).'';
							  	}

							  }

							$tstamp = $row['crdate'];
							$time = date('Y-m-d H:i:s', $tstamp);

					  		$pObj->currentTable = 'tx_toctoc_comments_user';
							$content .= '

							<tr id="txtc-row-' . str_replace(':', '', str_replace('.', '', $editUid)) . '">
							  <td class="img tx-tc-wm100">'.$editUid.'</td>
							  <td class="tx-tc-wm40 tx-tc-flip1-col">'.$pid_record.'</td>
							  <td class="date tx-tc-wm100 tx-tc-flop1-col">'.$time.'</td>
							  <td class="name tx-tc-wm100 tx-tc-flip2-col">'.$name.'</td>
							  <td class="name tx-tc-wm100 tx-tc-flip3-col">'.$initial_email.'</td>
							  <td class="name tx-tc-wm100 tx-tc-flop2-col">'.$currentname.'</td>
							  <td class="name tx-tc-wm100 tx-tc-flop3-col">'.$current_email.'</td>
							  <td class="name tx-tc-wm150nomax">'.$report.'</td>

							  ';
							  $content .= '
							    <td class="tx-tc-wm20">
							      <input class="tx-tc-wm20" type="checkbox" name="fields[]" value="'.$editUid.'" />
							    </td>';

							  $content .= '
							    </tr>
							  ';
						}
				}

				$content .= '
				  </table>
				  </fieldset>
				  <hr style="margin-top: 5px; margin-bottom: 5px;"/>
				';

			if($num_rows != 0) {
				$content .= $pObj->be_common->printPager($pObj, 'users', $fromAjax);
			}

			if ($fromAjax == TRUE) {
					$content .= '
			<div class="tx-tc-100">
					<div class="tx-tc-subpaneltitle tx-tc-bulkact-title">
						<span>' . $GLOBALS['LANG']->getLL('bulkact') . '</span>
					</div>
					<span id="actuser6g91" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactuser6g91" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
									' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconDelete . '" ' . $pObj->iconWidthHeight . 'title="'.
									$GLOBALS['LANG']->getLL('bulkactuser_one').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkactuser_one') . '</span>
					<span id="actuser6g92" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactuser6g92" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
									' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconNotApproved . '" ' . $pObj->iconWidthHeight . 'title="'.
									$GLOBALS['LANG']->getLL('bulkactuser_two').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkactuser_two') . '</span>
					<div class="tx-tc-keeptogether">
							<span id="actuser6g93" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactuser6g93" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
									' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconUsers . '" ' . $pObj->iconWidthHeight . 'title="'.
									$GLOBALS['LANG']->getLL('bulkactuser_three').'" alt="" />' .
									$GLOBALS['LANG']->getLL('bulkactuser_three') . '<img style="float:right;" class="tx-tc-be-link" align="left" '.
									' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconUser . '" ' . $pObj->iconWidthHeight . 'title="'.
									$GLOBALS['LANG']->getLL('bulkactuser_three').'" alt="" /></span><input placeholder="0.0.0.0.0" type="text" size="18" id="mergeuser" name="mergeuser" /></div>
				</div>
				<div id="txtcbulkstatus" class="tx-tc-100" style="display: none;">
				</div>
				<div class="clearit">&nbsp;</div>
			</div>';
			} else {
					$content .= '
					<div class="tx-tc-100">
						<div class="div-float tx-tc-keeptogether-simple">
							<div class="tc-tc-50">
								  '.$GLOBALS['LANG']->getLL('bulkact').'
								  <select name="bulkactuser" size="1">
								    <option value="1">'.$GLOBALS['LANG']->getLL('bulkactuser_one').'</option>
								    <option value="2">'.$GLOBALS['LANG']->getLL('bulkactuser_two').'</option>
								    <option value="3">'.$GLOBALS['LANG']->getLL('bulkactuser_three').'</option>
								  </select>
					    	</div>
					    	<div class="tx-tc-keeptogether-simple tc-tc-50">
								  <input type="hidden" name="admincommand2" value="2">
								  <input type="hidden" name="actadmincommand2" value="1">
								  <label for="mergeuser" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('mergewithuser').'</label><input type="text" size="18" name="mergeuser" />
								  <input type="submit" name="actuser" value="'.$GLOBALS['LANG']->getLL('go').'" onclick="return confirm(unescape(\''.
								  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'\'));" />
							</div>
						</div>
					 </div>
					<div class="clearit">&nbsp;</div>
					';
					$content .= '</div>';
			}

			$backendcontentcommentlist=$pObj->doc->section('', $content, 0, 1);
			$pObj->content.=$backendcontentcommentlist;

			if (isset($_SESSION['sess_toctoccommentsbackend'])) {
				if (($backendcontentcommentlist != $_SESSION['backendcontentuserslist']) || ($_SESSION['backendcontentlastlist'] != 'users')) {
					unset($_SESSION['backendcontentlastlist']);
					$_SESSION['backendcontentlastlist']='users';
					$_SESSION['backendcontentuserslist']=$backendcontentcommentlist;
					unset($_SESSION['backendcontent']);
				}
			}

			if (isset($_POST['fromajax'])) {
				$pObj->content=$outinfomessage;
			}

		} else {
			$backendcontentcommentlist=$_SESSION['backendcontentuserslist'];
			if ($_SESSION['backendcontentlastlist']!='users') {
				unset($_SESSION['backendcontent']);
			}

			unset($_SESSION['backendcontentlastlist']);
			$_SESSION['backendcontentlastlist']='users';
			$pObj->content.=$backendcontentcommentlist;
		}
		return '';
	}
}
?>