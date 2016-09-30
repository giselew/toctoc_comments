<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * BackendComments.php
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
 *   53: class toctoc_comments_be_comments
 *   64:     public function beComments(&$pObj, $pid = 0)
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
class toctoc_comments_be_comments {

	protected $backendUser;
	protected $sessionToken;
	/**
	 * Desc
	 *
	 * @param	[type]		$$pObj: ...
	 * @param	[type]		$pid: ...
	 * @return	[type]		...
	 */
	public function beComments(&$pObj, $pid = 0) {
	// "Create New" Button
	// params = Create New

		$editTable = 'tx_toctoc_comments_comments';
		$params = '&edit['.$editTable.']['.$pid.']=new&defVals['.$editTable.']';
		$newlink = '<a href="#" onclick="'.htmlspecialchars(t3lib_BEfunc::editOnClick($params, $GLOBALS['BACK_PATH'])).'">
		    <img class="txtc-newicon" ' . $pObj->iconWidthHeight . ' src="'. $GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconNew . '" title="'.$GLOBALS['LANG']->getLL('newcomment').'" border="0" alt="" />
		    </a><br /><br />';

		$backpathCorrectionString = '%2Ftypo3%2Fmod.php%3FM%3Dweb_toctoccommentsbeM1%26id%3D3%26';
		if (version_compare(TYPO3_version, '6.1', '>')) {
			$this->backendUser = $GLOBALS['BE_USER'];
			$this->sessionToken = $this->backendUser->getSessionData('formSessionToken');
			//print $this->sessionToken .'<br>';
			$tokenId = \TYPO3\CMS\Core\Utility\GeneralUtility::hmac('moduleCall' . 'web_toctoccommentsbeM1' . '' . $this->sessionToken);
			//print $tokenId;exit;
			$backpathCorrectionString = '%2Ftypo3%2Fmod.php%3FM%3Dweb_toctoccommentsbeM1%26moduleToken%3D'.$tokenId.'%26id%3D3%26';
		}

		$backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
		if (count($backpathCorrectionA) >1) {
			$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
		}

		$content .= $newlink;
		$infomessage = '';
		$alertmsg = 0;
		// Bulk actions
		if (isset($_POST['actmul'])) {
			$fields = array();
			if (isset($_POST['fields'])) {
				if (is_array($_POST['fields'])) {
					$fields = $_POST['fields'];
				} else {
					$fields = explode('-', $_POST['fields']);
				}
			}
			$numcomments = count($fields);
			if ($numcomments > 0) {
				$fields_new = '';
				foreach($fields as $field)$fields_new .= ','.intval($field);
				$fields_new = substr($fields_new, 1);

				// Approve
				if ($_POST['bulkact'] == '1') {
					$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET approved=1 WHERE uid IN ('.
							$fields_new.')');
					$infomessage = $GLOBALS['LANG']->getLL('approved1');
					if ($numcomments !=1){
						$infomessage = sprintf($GLOBALS['LANG']->getLL('approvedn'), $numcomments);
					}

				} elseif ($_POST['bulkact'] == '2') {
					// Disapprove
					$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET approved=0 WHERE uid IN ('.
							$fields_new.')');
					$infomessage = $GLOBALS['LANG']->getLL('disapproved1');
					if ($numcomments !=1){
						$infomessage = sprintf($GLOBALS['LANG']->getLL('disapprovedn'), $numcomments);
					}

				} elseif ($_POST['bulkact'] == '3') {
					// Hide
					$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET hidden=1 WHERE uid IN ('.
							$fields_new.')');
					$infomessage = $GLOBALS['LANG']->getLL('hidden1');
					if ($numcomments !=1){
						$infomessage = sprintf($GLOBALS['LANG']->getLL('hiddenn'), $numcomments);
					}

				} elseif ($_POST['bulkact'] == '4') {
					// Show
					$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET hidden=0 WHERE uid IN ('.$fields_new.')');
					$infomessage = $GLOBALS['LANG']->getLL('unhide1');
					if ($numcomments !=1){
						$infomessage = sprintf($GLOBALS['LANG']->getLL('unhiden'), $numcomments);
					}

				} elseif ($_POST['bulkact'] == '5') {
					// Delete
					$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET deleted=1 WHERE uid IN ('.$fields_new.')');
					$infomessage = $GLOBALS['LANG']->getLL('commentsdelete1');
					if ($numcomments !=1){
						$infomessage = sprintf($GLOBALS['LANG']->getLL('commentsdeleten'), $numcomments);
					}

				}
				$infomessage .= '<br>';
				$infomessage .= $GLOBALS['LANG']->getLL('donelist') . ': ' . $fields_new;
				$cachemessage ='';

				if ((intval($_POST['bulkact']) >= 1) && (intval($_POST['bulkact']) <= 5)) {

					$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('DISTINCT external_ref_uid, external_ref, external_prefix', 'tx_toctoc_comments_comments', 'uid IN ('.$fields_new.')', '', '');
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

							// cachereport
							$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport WHERE external_ref_uid = "' . $external_ref_uid .'"');							
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

			} else {
				$infomessage = $GLOBALS['LANG']->getLL('nocommentsselected');
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
					$_SESSION['backendcontentlastlist']='';

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

		unset($_POST['actmul']);
		unset($_POST['bulkact']);
		unset($_POST['fields']);

		if (!$_SESSION['backendcontentcommentlist']) {
		    $fromAjax =FALSE;
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

		    $content .= $infomessage;
				// Show all comments on root page
		    if($pid == 0) {
		      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0', '', '');
		    }

		    // Show comments on page
		    else {
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
		      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND pid IN ('.$pages.')', '', '');
		    }

		    $num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

		    // No Comment
		    if ($num_rows == '') {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('nocomment').'</div>';
		    }

		    // Root Page and 1 Comment
		    else if ($num_rows == '1' && $pid == 0) {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('commentglobal_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('commentglobal_two').'</div>';
		    }

		    // Root Page and more than 1 Comment
		    else if ($num_rows > '1' && $pid == 0) {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('commentglobalmore_one').'<b> '.$num_rows.'</b> '.
		      				$GLOBALS['LANG']->getLL('commentglobalmore_two').'</div>';
		    }

		    // 1 Comment
		    else if ($num_rows == '1') {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('onecomment_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('onecomment_two').'</div>';
		    }

		    // More Comments
		    else {
		      $content .= '<div class="tx-tc-100 tx-tc-sessioncolornone">'.$GLOBALS['LANG']->getLL('morecomments_one').' <b>'.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('morecomments_two').'</div>';
		    }

		  // Show Table Head only if at least 1 Comment exists.
		  if($num_rows >= '1') {
		  $content .= '
		  	<div class="tx-tc-flipflop">
		  		<div class="tx-tc-flips">'.$GLOBALS['LANG']->getLL('showup').': '.$GLOBALS['LANG']->getLL('showflip').'</div>
				<div class="tx-tc-flipflop-cont">
				  	<div class="tx-tc-flip1">'.$GLOBALS['LANG']->getLL('deletetwo').'</div>
				  	<div class="tx-tc-flop1">'.$GLOBALS['LANG']->getLL('edittwo').'</div>
				  	<div class="tx-tc-flip2">'.$GLOBALS['LANG']->getLL('hideshow').'</div>
				  	<div class="tx-tc-flop2">'.$GLOBALS['LANG']->getLL('approveboth').'</div>
				  	<div class="tx-tc-flip3">'.$GLOBALS['LANG']->getLL('date').'</div>
				  	<div class="tx-tc-flop3">'.$GLOBALS['LANG']->getLL('name').'</div>
				 	<div class="tx-tc-flip4">'.$GLOBALS['LANG']->getLL('pid').'</div>
				  	<div class="tx-tc-flop4">'.$GLOBALS['LANG']->getLL('id').'</div>
				 </div>
		  	</div>
		  	<fieldset>
		      <table id="tablesorter-demo" class="tablesorter">
		      <thead>
			<tr>
			  <th class="id tx-tc-wm40  tx-tc-flop4-col">'.$GLOBALS['LANG']->getLL('id').'</th>
			  <th class="tx-tc-wm40 tx-tc-flip4-col">'.$GLOBALS['LANG']->getLL('pid').'</th>
			  <th class="tx-tc-wm100 tx-tc-flip3-col">'.$GLOBALS['LANG']->getLL('date').'</th>
			  <th class="tx-tc-wm100 tx-tc-flop3-col">'.$GLOBALS['LANG']->getLL('name').'</th>
			  <th class="tx-tc-wm300">'.$GLOBALS['LANG']->getLL('comment').'</th>
			  <th class="tx-tc-wm30 tx-tc-flop2-col" title="'.$GLOBALS['LANG']->getLL('approveboth').'">'.substr($GLOBALS['LANG']->getLL('approveboth'), 0, 2) .'...</th>
			  <th class="tx-tc-wm30 tx-tc-flip2-col" title="'.$GLOBALS['LANG']->getLL('hideshow').'">'.substr($GLOBALS['LANG']->getLL('hideshow'), 0, 2) .'...</th>
			  <th class="tx-tc-wm30 tx-tc-flop1-col" title="'.$GLOBALS['LANG']->getLL('edittwo').'">' . htmlspecialchars(substr(trim($GLOBALS['LANG']->getLL('edittwo')), 0, 2)) .'...</th>
			  <th class="tx-tc-wm30 tx-tc-flip1-col" title="'.$GLOBALS['LANG']->getLL('deletetwo').'">' . htmlspecialchars(substr(trim($GLOBALS['LANG']->getLL('deletetwo')), 0, 3)) .'...</th>
			  <th class="tx-tc-wm20"><input type="checkbox" class="checkall tx-tc-wm20" title="'.$GLOBALS['LANG']->getLL('check_all').'"></th>
			</tr>
			</thead>';
			}

			while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			  // Get the fields
			  $editTable = 'tx_toctoc_comments_comments';
			  $editUid = $row['uid'];
			  $pid_record = $row['pid'];
			  $hiddenField = 'hidden';
			  $approvedField = 'approved';
			  $name = ''.$row['firstname'].' '.$row['lastname'].'';
			  $comment_txt=htmlspecialchars($row['content']);
			  if (strlen($comment_txt)>$pObj->text_crop) {

				$textcroppedleft = substr($comment_txt, 0, $pObj->text_crop);
				$textcroppedright = substr($comment_txt, $pObj->text_crop);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {

					$textcroppedleft .=$textcroppedrightarr[0] . ' ... ';

				} else {
					$textcroppedleft .=$textcroppedright;
				}
				$comment_txt =$textcroppedleft;
			  }
			  $comment_txt_crop = ''.$comment_txt;

			  $tstamp = $row['crdate'];
			  $time = date('Y-m-d H:i:s', $tstamp);

			  /*
			  params2 = Edit
			  params3 = Delete
			  params4 = Hide
			  params5 = Show
			  params6 = Disapprove
			  params7 = Approve
			  */

			  // Get the params
			  $params2 = '&edit['.$editTable.']['.$editUid.']=edit';
			  $params3 ='&cmd['.$editTable.']['.$editUid.'][delete]=1';
			  $params4 ='&data['.$editTable.']['.$editUid.']['.$hiddenField.']=0';
			  $params5 ='&data['.$editTable.']['.$editUid.']['.$hiddenField.']=1';
			  $params6 ='&data['.$editTable.']['.$editUid.']['.$approvedField.']=0';
			  $params7 ='&data['.$editTable.']['.$editUid.']['.$approvedField.']=1';

			  $aparams3 ='delete6g9' . $editUid;
			  $aparams4 ='hide06g9' . $editUid;
			  $aparams5 ='hide16g9' . $editUid;
			  $aparams6 ='approve06g9' . $editUid;
			  $aparams7 ='approve16g9' . $editUid;

			  $pObj->currentTable = 'tx_toctoc_comments_comments';

			$content .= '

			<tr id="txtc-row-' . $editUid . '">
			  <td class="img tx-tc-wm40  tx-tc-flop4-col">'.$editUid.'</td>
			  <td class="tx-tc-wm40 tx-tc-flip4-col">'.$pid_record.'</td>
			  <td class="date tx-tc-wm100 tx-tc-flip3-col">'.$time.'</td>
			  <td class="name tx-tc-wm100 tx-tc-flop3-col">'.$name.'</td>
			  <td class="tx-tc-wm300">'.$comment_txt_crop.'</td>

			  ';

			  if ($row[$approvedField])	{
			  	if ((version_compare(TYPO3_version, '7.6', '<'))) {
			  		$newlink=$pObj->doc->issueCommand($params6);
			  	} else {
			  		$newlink=TYPO3\CMS\Backend\Utility\BackendUtility::getLinkToDataHandlerAction($params6);
			  	}

			  	$backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
			  	if (count($backpathCorrectionA) >1) {
			  		$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
			  	}
			  	if ($fromAjax == TRUE) {
			  		$content .= '
				    <td class="img tx-tc-wm30 tx-tc-flop2-col">
				  		<span class="tx-tc-cmdparams6" id="'.$aparams6. '">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'].'../typo3conf/ext/toctoc_comments' . $pObj->picpathtoctoc . '/' . $pObj->iconApproved . '" border="0" title="'.
				      $GLOBALS['LANG']->getLL('disapprove').'" align="top" alt=""
				      /></span></td>
			      		';
				  } else {
					    $content .='
					      <td class="img tx-tc-wm30 tx-tc-flop2-col"><a href="'.$newlink.'">
					      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'].'../typo3conf/ext/toctoc_comments' . $pObj->picpathtoctoc . '/' . $pObj->iconApproved . '" border="0" title="'.
					      $GLOBALS['LANG']->getLL('disapprove').'" align="top" alt=""
					      /></a></td>
				    ';
				 }
			  } else {
			  	if ((version_compare(TYPO3_version, '7.6', '<'))) {
			  		$newlink=$pObj->doc->issueCommand($params7);
			  	} else {
			  		$newlink=TYPO3\CMS\Backend\Utility\BackendUtility::getLinkToDataHandlerAction($params7);

			  	}

			  	$backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
			  	if (count($backpathCorrectionA) >1) {
			  		$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
			  	}
			  	if ($fromAjax == TRUE) {
			  		$content .= '
				    <td class="img tx-tc-wm30 tx-tc-flop2-col">
				  		<span class="tx-tc-cmdparams7" id="'.$aparams7. '">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'].'../typo3conf/ext/toctoc_comments' . $pObj->picpathtoctoc . '/' . $pObj->iconNotApproved . '" border="0" title="'.
				    $GLOBALS['LANG']->getLL('approve').'" align="top" alt="" /></span></td>
			      		';
			  	} else {
				    $content .= '
				      <td class="img tx-tc-wm30 tx-tc-flop2-col"><a href="'.$newlink.'">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'].'../typo3conf/ext/toctoc_comments' . $pObj->picpathtoctoc . '/' . $pObj->iconNotApproved . '" border="0" title="'.
				    $GLOBALS['LANG']->getLL('approve').'" align="top" alt="" /></a></td>';
				  }
			  }

			  if ($row[$hiddenField])	{
			  	if ((version_compare(TYPO3_version, '7.6', '<'))) {
			  		$newlink=$pObj->doc->issueCommand($params4);
			  	} else {
			  		$newlink=TYPO3\CMS\Backend\Utility\BackendUtility::getLinkToDataHandlerAction($params4);

			  	}

			  	$backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
			  	if (count($backpathCorrectionA) >1) {
			  		$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
			  	}
			  	if ($fromAjax == TRUE) {
			  		$content .= '
				    <td class="img tx-tc-wm30 tx-tc-flip2-col">
				  		<span class="tx-tc-cmdparams4" id="'.$aparams4. '">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconUnhide . '" border="0" title="'.
			      $GLOBALS['LANG']->getLL('show').'" align="top" alt=""
			      /></span></td>
			      		';
			  	} else {
				    $content .='
				      <td class="img tx-tc-wm30 tx-tc-flip2-col"><a href="'.$newlink.'">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconUnhide . '" border="0" title="'.
				      $GLOBALS['LANG']->getLL('show').'" align="top" alt=""
				      /></a></td>
				    ';
			  	}
			  } else {
			  	if ((version_compare(TYPO3_version, '7.6', '<'))) {
			  		$newlink=$pObj->doc->issueCommand($params5);
			  	} else {
			  		$newlink=TYPO3\CMS\Backend\Utility\BackendUtility::getLinkToDataHandlerAction($params5);
			  	}

			  	$backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
			  	if (count($backpathCorrectionA) >1) {
			  		$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
			  	}
			  	if ($fromAjax == TRUE) {
			  		$content .= '
				    <td class="img tx-tc-wm30 tx-tc-flip2-col">
				  		<span class="tx-tc-cmdparams5" id="'.$aparams5 . '">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconHide . '" border="0" title="'.
				    $GLOBALS['LANG']->getLL('hide').'" align="top" alt="" /></span></td>
			      		';
			  	} else {
				    $content .= '
				      <td class="img tx-tc-wm30 tx-tc-flip2-col"><a href="'.$newlink.'">
				      <img ' . $pObj->iconWidthHeight . ' src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconHide . '" border="0" title="'.
				    $GLOBALS['LANG']->getLL('hide').'" align="top" alt="" /></a></td>';
				  }
			  }

			  $newlink = htmlspecialchars(t3lib_BEfunc::editOnClick($params2, $GLOBALS['BACK_PATH']));
			  $backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
			  if (count($backpathCorrectionA) >1) {
			  	$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
			  }

			  $content .= '
			    <td class="img tx-tc-wm30 tx-tc-flop1-col"><a href="#" onclick="'.$newlink.'">
			      <img src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx  . $pObj->iconEdit . '" ' . $pObj->iconWidthHeight . 'title="'.
			      $GLOBALS['LANG']->getLL('edit').'" border="0" alt="" /></a>
			    </td>';

				if ((version_compare(TYPO3_version, '7.6', '<'))) {
			  		$newlink=$pObj->doc->issueCommand($params3);
			  	} else {
			  		$newlink=TYPO3\CMS\Backend\Utility\BackendUtility::getLinkToDataHandlerAction($params3);
			  	}

			  $backpathCorrectionA = explode('%2Ftypo3%2Fajax.php%3FajaxID%3DAdministrationTocTocASNCAjaxController%3A%3AindexAction', $newlink);
			  if (count($backpathCorrectionA) >1) {
			  	$newlink = $backpathCorrectionA[0] . $backpathCorrectionString . $backpathCorrectionA[1];
			  }

			  if ($fromAjax == TRUE) {
				  $content .= '
				    <td class="img tx-tc-wm30 tx-tc-flip1-col">
				  		<span class="tx-tc-cmdparams3" id="'.$aparams3.'6g9' . rawurlencode(''.$GLOBALS['LANG']->getLL('delete_txt').'') . '">
				      <img src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconDelete . '" ' . $pObj->iconWidthHeight . 'title="'.
				      $GLOBALS['LANG']->getLL('delete').'" alt="" /></span>
				    </td>';
			  } else {
				 $content .= '<td class="img tx-tc-wm30 tx-tc-flip1-col"><a href="'.$newlink.'"
				  onclick="return confirm(unescape(\''.rawurlencode(''.$GLOBALS['LANG']->getLL('delete_txt').'').'\'));">
				  <img src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconDelete . '" ' . $pObj->iconWidthHeight . 'title="'.
				  $GLOBALS['LANG']->getLL('delete').'" alt="" /></a>
				  </td>';
			  		}
			  $content .= '
			    <td class="tx-tc-wm20">
			      <input class="tx-tc-wm20" type="checkbox" name="fields[]" value="'.$editUid.'" />
			    </td>';

			  $content .= '
			    </tr>
			  ';
			}

			$content .= '
			  </table>
			  </fieldset>
			';

			if($num_rows != 0) {
			  	$content .= $pObj->be_common->printPager($pObj, 'comments', $fromAjax);
			}

			if ($fromAjax == TRUE) {
				$content .= '
				<div class="tx-tc-100">
					<div class="tx-tc-subpaneltitle tx-tc-bulkact-title">
						<span>' . $GLOBALS['LANG']->getLL('bulkact') . '</span>
					</div>
					<span id="actmul6g91" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactmul6g91" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx  . $pObj->iconApproved . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkact_one').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkact_one') . '</span>
					<span id="actmul6g92" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactmul6g92" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx  . $pObj->iconNotApproved . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkact_two').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkact_two') . '</span>
					<span id="actmul6g93" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactmul6g93" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx  . $pObj->iconUnhide . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkact_three').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkact_three') . '</span>
					<span id="actmul6g94" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactmul6g94" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx  . $pObj->iconHide . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkact_four').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkact_four') . '</span>
					<span id="actmul6g956g9'.
				  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pactmul6g956g9'.
				  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx  . $pObj->iconDelete . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkact_five').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkact_five') . '</span>
				</div>
				<div id="txtcbulkstatus" class="tx-tc-100" style="display: none;">
				</div>
				<div class="clearit">&nbsp;</div>
			</div>';
			} else {
				$content .= '
				<div class="div-float">
				  '.$GLOBALS['LANG']->getLL('bulkact').'
				  <select name="bulkact" size="1">
				    <option value="1">'.$GLOBALS['LANG']->getLL('bulkact_one').'</option>
				    <option value="2">'.$GLOBALS['LANG']->getLL('bulkact_two').'</option>
				    <option value="3">'.$GLOBALS['LANG']->getLL('bulkact_three').'</option>
				    <option value="4">'.$GLOBALS['LANG']->getLL('bulkact_four').'</option>
				    <option value="5">'.$GLOBALS['LANG']->getLL('bulkact_five').'</option>
				  </select>
				  <input type="submit" name="actmul" value="'.$GLOBALS['LANG']->getLL('go').'" onclick="return confirm(unescape(\''.
				  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'\'));" />
				</div>
				<div class="clearit">&nbsp;</div>
				</div>';
			}

			$backendcontentcommentlist=$pObj->doc->section('', $content, 0, 1);
			$pObj->content.=$backendcontentcommentlist;
			if (isset($_SESSION['sess_toctoccommentsbackend'])) {
				if (($backendcontentcommentlist != $_SESSION['backendcontentcommentlist']) || ($_SESSION['backendcontentlastlist'] != 'comments')) {
					unset($_SESSION['backendcontentlastlist']);
					$_SESSION['backendcontentlastlist']='comments';
					$_SESSION['backendcontentcommentlist']=$backendcontentcommentlist;
					unset($_SESSION['backendcontent']);
				}

			}

			if (isset($_POST['fromajax'])) {
				$pObj->content=$outinfomessage;
			}

		} else {
			$backendcontentcommentlist=$_SESSION['backendcontentcommentlist'];
			if ($_SESSION['backendcontentlastlist']!='comments') {
				unset($_SESSION['backendcontent']);
			}

			unset($_SESSION['backendcontentlastlist']);
			$_SESSION['backendcontentlastlist']='comments';
			$pObj->content.=$backendcontentcommentlist;
		}

		return '';
	}

}
?>