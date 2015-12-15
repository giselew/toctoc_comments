<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2015 Gisele Wendl <gisele.wendl@toctoc.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * class.toctoc_comments_recentcomments.php
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
 *   58: class toctoc_comments_recentcomments extends toctoc_comment_lib
 *   68:     public function mainRecentComments($pObj, $conf, $feuserid)
 *  151:     public function comments_getRecentComments($rows, $conf, $pObj, $fromusercenterid = 0, $usercenterlistid = 0,
			$fromAjax = FALSE, $searchincomments = '')
 *  654:     protected function createRCLinks($text, $refID, $commentID, $prefix, $externalprefix, $singlePid, $conf, $show_uid, $okrowsi)
 *
 * TOTAL FUNCTIONS: 3
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
class toctoc_comments_recentcomments extends toctoc_comment_lib {

	/**
	 * Generates entire list of recent comments
	 *
	 * @param	object		$pObj
	 * @param	array		$conf
	 * @param	int		$feuserid: id of current user...
	 * @return	string		Generated HTML
	 */
	public function mainRecentComments($pObj, $conf, $feuserid) {
		$fromAjax = FALSE;
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}

		$pidcond='';
		if ($tmpint) {
			$conf['storagePid'] = intval($conf['storagePid']);
			$pidcond='pid='. $conf['storagePid'] . ' ';
		} else {
			$conf['storagePid'] = $GLOBALS['TYPO3_DB']->cleanIntList($conf['storagePid']);
			$pidcond='pid IN (' . $conf['storagePid'] . ') ';
		}

		$where = 'tx_toctoc_comments_comments.' . $pidcond . $this->enableFields('tx_toctoc_comments_comments', $pObj, $fromAjax);
		$where .= ' AND tx_toctoc_comments_comments.approved =1';
		$condfeusergroup='';
		if ($conf['restrictToExternalPrefix'] !='') {
				$condfeusergroup= ' AND tx_toctoc_comments_comments.external_prefix = "' . $conf['restrictToExternalPrefix'] . '"';
		}

		if (((intval($conf['advanced.']['wallExtension']) != 0) && (intval($feuserid) !=0)) OR
				(($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) !=0) && ($conf['advanced.']['showFeUsercomments']==1))) {
			$condfeusergroup .= ' AND toctoc_commentsfeuser_feuser IN ('. $this->usersGroupmembers($pObj, $fromAjax, $conf) . ')';
		} else {
			if (($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) ==0)) {
				$condfeusergroup .= ' AND toctoc_commentsfeuser_feuser=0';
			}

		}

		if ($conf['advanced.']['showFeUsercomments']==0) {
			$condfeusergroup='';
			$condfeusergroup = ' AND toctoc_commentsfeuser_feuser=0';
		}

		$where .= $condfeusergroup;
		$sorting = $conf['recentcomments.']['sorting'];

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'"dummy" AS refTitle, tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
            tx_toctoc_comments_comments.firstname AS firstname, tx_toctoc_comments_comments.lastname AS lastname,
            tx_toctoc_comments_comments.content AS content, tx_toctoc_comments_comments.external_ref AS external_ref,
			tx_toctoc_comments_comments.external_ref_uid AS external_ref_uid,
			tx_toctoc_comments_comments.parentuid AS parentuid,
 			tx_toctoc_comments_comments.external_prefix AS external_prefix,
 			tx_toctoc_comments_comments.crdate AS crdate',
				'tx_toctoc_comments_comments',
				$where,
				'',
				$sorting,
				'100'
		);

		$subParts = array(
				'###SINGLE_RECENTCOMMENT###' => $this->comments_getRecentComments($rows, $conf, $pObj),
		);

		$markers = array();

		// Fetch template
		$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###RECENTCOMMENT_LIST###');

		// Merge
		$retstr = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
		return $retstr;
	}



	/**
	 * Generates list of recent comments
	 *
	 * @param	array		$rows	Rows from tx_toctoc_comments_comments
	 * @param	array		$conf
	 * @param	object		$pObj
	 * @param	int		$fromusercenterid: ...
	 * @param	int		$usercenterlistid: ...
	 * @return	string		Generated HTML
	 */
	public function comments_getRecentComments($rows, $conf, $pObj, $fromusercenterid = 0, $usercenterlistid = 0,
			$fromAjax = FALSE, $searchincomments = '') {

		if (!isset($this->cObj)) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}
		if (count($rows) == 0) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###RECENTNO_COMMENTS###');
			if ($template) {
				$retstr =$this->t3substituteMarker($template, '###LL_TEXT_NO_COMMENTS###', $this->pi_getLLWrap($pObj, 'pi1_template.text_no_comments', $fromAjax));
				return $retstr;
			}
		}

		$showrecentcomment=0;
		if ($fromusercenterid > 0) {
			$showrecentcomment = intval($conf['userCenter.']['commentsPerUCList']);
		}
		$entries = array();
		if ($fromusercenterid == 0) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_RECENTCOMMENT###');

		} else {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_USERCENTERCOMMENT###');
		}

		$listCount = $conf['recentcomments.']['listCount'];
		if ($conf['recentcommentslistCount']) {
			$listCount = $conf['recentcommentslistCount'];
		}

		$okrowsi=0;
		foreach ($rows as $row) {
			$externalprefix=$row['external_prefix'];
			$prefix=  $row['external_ref'];
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($row['external_ref'], 0, $posbeforeid);
			$mmtable=substr($row['external_ref'], 0, $posbeforeid-1);
			$refID = substr($row['external_ref'], $posbeforeid);

			if (is_array($GLOBALS['TCA'][$mmtable])) {
				$where = $mmtable. '.uid = ' . $refID . $this->enableFields($mmtable, $pObj, $fromAjax);
			} else {
				$where = $mmtable. '.uid = ' . $refID;
			}

			$targetfortitle='title';
			if ($mmtable== 'tx_wecstaffdirectory_info') {
				$targetfortitle='full_name';
			}

			$ownershipok=1;
			if ($mmtable== 'fe_users') {
				$targetfortitle='name';
				$arr_groupmembers=explode(',', $this->usersGroupmembers($pObj, $fromAjax, $conf, TRUE));

				$arr_groupmembers=array_flip($arr_groupmembers);
				if (!array_key_exists($refID, $arr_groupmembers))  {
					$ownershipok=0;
				}

				//this was covering most cases, now we still have to ckeck top parent
				//
				if ($ownershipok==1) {
					if ($row['parentuid'] !=0) {
						list($hlsctrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user, uid,approved,
								crdate,firstname,lastname,homepage,
								location,email,content,tx_commentsnotify_notify,remote_addr,SUBSTR(external_ref_uid,12) AS external_ref_uid,attachment_id,
								attachment_subid,parentuid,gender,external_ref',
								'tx_toctoc_comments_comments', 'uid=' . $row['parentuid']);

						//find top level:
						if (intval($hlsctrow['parentuid'])>0) {
							$parentidhlt= $hlsctrow['parentuid'];
							$levelhlt=1;
							do {
								list($hlsctprow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user,
										uid,approved,crdate,firstname,lastname,homepage,
										location,email,content,tx_commentsnotify_notify,remote_addr,SUBSTR(external_ref_uid,12) AS external_ref_uid,
										attachment_id,attachment_subid,parentuid,gender,external_ref',
										'tx_toctoc_comments_comments', 'uid=' . $parentidhlt);
								$parentidhlt= $hlsctprow['parentuid'];
								$levelhlt++;
								if ($levelhlt>1000) {
									$parentidhlt=0;
									return 'endless loop detected at comments_getRecentComments';
								}

							} while ($parentidhlt!=0);
							$hlsctrow =$hlsctprow;

						}

						$posbeforeidh = strrpos($hlsctrow['external_ref'], '_')+1;
						$refIDh = substr($hlsctrow['external_ref'], $posbeforeidh);

						if (!array_key_exists($refIDh, $arr_groupmembers))  {
							$ownershipok=0;
						}

					}

				}

			}

			if ($ownershipok==1) {
				$rowstitle = array();

				if (is_array($GLOBALS['TCA'][$mmtable])) {
					$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							$mmtable . '.' . $targetfortitle . ' AS refTitle',
							$mmtable,
							$where,
							'',
							'',
							''
					);
					if (trim($rowstitle[0]['refTitle']) == '') {
						$ownershipok=0;
					} else {
						$row['refTitle']=$rowstitle[0]['refTitle'];
					}
				} else {
					$row['refTitle']='';
				}

				$itemtitle = 'News';
				$cttitle = str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.textcommentlink', $fromAjax));
				$itemtitle = ucfirst($this->pi_getLLWrap($pObj, 'comments_recent.' . $mmtable .'', $fromAjax));

				$pageidrecord='';
				if ($prefix == 'pages_') {
					$pageid=$refID;
					//check ($conf['recentcommentsPluginpages']) from the plugins configuration for existance of the current pid
					$recentcommentsPluginpages=explode(',', $conf['advanced.']['recentcommentsPluginpages']);

					if (count($recentcommentsPluginpages) >0) {
						$i=0;
						$j=-1;
						foreach ($recentcommentsPluginpages as $rcpid) {
							if ($rcpid==$pageid) {
								$j=$i;
								break;
							}

							$i++;
						}

						if ($j != -1) {
							$recentcommentsPluginRecords=explode(',', $conf['advanced.']['recentcommentsPluginRecords']);
							$pageidrecord=$recentcommentsPluginRecords[$j]; // zb tt_news_21
							$prefix=$pageidrecord;
							$posbeforeid = strrpos($pageidrecord, '_')+1;
							$prefix=substr($pageidrecord, 0, $posbeforeid);
							$mmtable=substr($pageidrecord, 0, $posbeforeid-1);
							$refID = substr($pageidrecord, $posbeforeid);
							$where = 'deleted=0 AND pi1_table="' . $mmtable .'"';
							$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
									'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key',
									'tx_toctoc_comments_prefixtotable',
									$where,
									'',
									'',
									''
							);
							$externalprefix=$rowstitle[0]['pi1_key'];
						}

					}

					// if found we have all now to construct the param for the link
					$show_uid='';
				} else {
					// check value for uid
					$where = 'deleted=0 AND pi1_key="' . $externalprefix .'"';
					$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'tx_toctoc_comments_prefixtotable.show_uid AS show_uid',
							'tx_toctoc_comments_prefixtotable',
							$where,
							'',
							'',
							''
					);
					$show_uid=$rowstitle[0]['show_uid'];

					$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'tt_content.pid AS pid',
							'tt_content',
							'tt_content.uid =' . substr($row['external_ref_uid'], 11),
							'',
							'',
							''
					);
					if (count($rowspage)>0) {
						$pageid=$rowspage[0]['pid'];
					} else {
						//artificial content element id for tt_news hook
						$paID=substr($row['external_ref_uid'], 11, 4);
						$pageid=intval($paID-1000);
					}

				}

				$skiprow=FALSE;
				// check multilingual-access
				if ($conf['advanced.']['useMultilingual'] == 1) {

					$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'sys_language_uid,t3_origuid',
							'tt_content',
							'tt_content.uid =' . substr($row['external_ref_uid'], 11),
							'',
							'',
							''
					);
					if (count($rowspage)>0) {
						if ($rowspage[0]['sys_language_uid']!=-1) {
							if ($rowspage[0]['sys_language_uid']==0) {
								//might be there if there's no translation
								if ($GLOBALS['TSFE']->sys_language_uid!=0) {
									$rowspageparent = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
											'sys_language_uid,t3_origuid',
											'tt_content',
											'sys_language_uid =' . $GLOBALS['TSFE']->sys_language_uid . ' AND t3_origuid =' . substr($row['external_ref_uid'], 11) .
											' AND hidden=0 AND deleted=0',
											'',
											'',
											''
									);
									if (count($rowspageparent)>0) {
										// on the page the content element for langid=0 will be replaced by sys_lang_id's content element
										$skiprow=TRUE;
									}

								}

							} elseif ($rowspage[0]['sys_language_uid']!=$GLOBALS['TSFE']->sys_language_uid) {
								$skiprow=TRUE;
							}

						}

					}

					// if not: artificial content element id, link should work
				}

				if (($skiprow==FALSE) && ($ownershipok==1)) {

					$row['firstname']=$this->applyStdWrap(htmlspecialchars($row['firstname']), 'firstName_stdWrap', $conf);
					$row['lastname']=$this->applyStdWrap(htmlspecialchars($row['lastname']), 'lastName_stdWrap', $conf);

					$commentID = $row['uid'];
					if ($prefix == 'pages_') {
						$exticon= '/typo3/sysext/cms/ext_icon.gif">';
					} elseif ($prefix == 'tt_news_') {
						$exticon= t3lib_extMgm::siteRelPath('tt_news') . 'ext_icon.gif">';
					} elseif ($prefix == 'tt_products_') {
						$exticon= t3lib_extMgm::siteRelPath('tt_products') . 'ext_icon.gif">';
					} elseif ($prefix == 'tx_wecstaffdirectory_info_') {
						$exticon= t3lib_extMgm::siteRelPath('wec_staffdirectory') .	'ext_icon.gif">';
					} elseif ($prefix == 'fe_users_') {
						$exticon= $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
						$conf['theme.']['selectedTheme'] . '/img/usericon.gif">';
					} else {
						$exticon= $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'ext_icon.gif">';
					}

					if ($searchincomments != '') {
						$commenttextprecrop = $row['content'];
						$searchincommentsendpos = strpos(strtoupper($commenttextprecrop), strtoupper($searchincomments)) + strlen($searchincomments);
						if (($searchincommentsendpos > intval($conf['recentcomments.']['maxCharCount']/2)) ) {
							// precut
							$precutpos = $searchincommentsendpos - intval($conf['recentcomments.']['maxCharCount']/2);
							$commenttextprecrop = $this->trimContent($row['content'], $conf, $precutpos, FALSE, TRUE);
							$commenttext = $this->trimContent($commenttextprecrop, $conf, (4 + $conf['recentcomments.']['maxCharCount']), FALSE);

						} else {
							$commenttext = $this->trimContent($commenttextprecrop, $conf, $conf['recentcomments.']['maxCharCount'], FALSE);
						}

					} else {
						$commenttext = $this->trimContent($row['content'], $conf, $conf['recentcomments.']['maxCharCount'], FALSE);
					}
					if ($searchincomments != '') {
						$searchincommentsarrupper = explode(strtoupper($searchincomments), strtoupper($commenttext));
						$cntupper= count($searchincommentsarrupper);
						$searchincommentsarr=array();
						$searchincommentstermarr=array();
						$searchincommentstermarr[0] ='';
						$curpos =0;
						for ($i=0;$i<$cntupper;$i++) {
							$searchincommentsarr[$i] = substr($commenttext, $curpos, strlen($searchincommentsarrupper[$i]));
							if ($i>0) {
								$searchincommentstermarr[$i] = substr($commenttext, $curpos-strlen($searchincomments), strlen($searchincomments));
							}
							$curpos= $curpos + strlen($searchincommentsarr[$i])+strlen($searchincomments);
						}
						$commenttext = $searchincommentsarr[0];
						for ($i=1;$i<$cntupper;$i++) {
							if ($i>0) {
								$commenttext .= '<span class="tx-tc-foundserchterm">' . $searchincommentstermarr[$i] . '</span>' .$searchincommentsarr[$i];
							}
						}
					}

					//Parse for Links and Smilies
					$this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() .
							t3lib_extMgm::siteRelPath('toctoc_comments'), $conf['smiliePath']);
					$this->smilies = $this->parseSmilieArray($conf['smilies.']);
					$commenttext = $this->replaceSmilies($commenttext, $conf);
					$commenttext =$this->replaceBBs($commenttext, $pObj, $conf, TRUE);
					$saveconfemoji=$conf['advanced.']['useEmoji'];

					$commenttext = $this->makeemoji($commenttext, $conf, 'comments_getRecentComments');

					$conf['advanced.']['useEmoji']=$saveconfemoji;

					$commenttext =$this->addleadingspace($commenttext);
					if ($itemtitle !='') {
						$itemtitle='title="' . $itemtitle . '" ';
					}

					$titleimage = '<img class="tx-tc-rcentpic" width="14" height="14" ' . $itemtitle . 'src="' . $exticon;
					$commentimage = '';
					$authorimage = '';

					$saverecentcommentslinkComments = $conf['recentcomments.']['linkComments'];

					$conf['recentcomments.']['linkComments']=1;
					$titlelink=$this->createRCLinks(strip_tags($row['refTitle']), $refID, $commentID, $prefix, $externalprefix,
							$pageid, $conf, $show_uid, $okrowsi);
					$conf['recentcomments.']['linkComments'] = $saverecentcommentslinkComments;

					if ($titlelink !=$commenttext) {
						$link = $this->createRCLinks($commenttext, $refID, $commentID, $prefix, $externalprefix,
								$pageid, $conf, $show_uid, $okrowsi);
						$autortext = '';
						$ratinghtml = '';
						$reviewhtml = '';
						$commentcontent =  $this->applyStdWrap($commentimage. $link, 'content_stdWrap', $conf);
						if ($usercenterlistid == 0) {
							$autortext = $this->applyStdWrap($authorimage. $row['firstname'].'&nbsp;'.$row['lastname'], 'author_stdWrap', $conf);
							if ($searchincomments != '') {
								$searchincommentsarrupper = explode(strtoupper($searchincomments), strtoupper($autortext));
								$cntupper= count($searchincommentsarrupper);
								$searchincommentsarr=array();
								$searchincommentstermarr=array();
								$searchincommentstermarr[0] ='';
								$curpos =0;
								for ($i=0;$i<$cntupper;$i++) {
									$searchincommentsarr[$i] = substr($autortext, $curpos, strlen($searchincommentsarrupper[$i]));
									if ($i>0) {
										$searchincommentstermarr[$i] = substr($autortext, $curpos-strlen($searchincomments), strlen($searchincomments));
									}
									$curpos= $curpos + strlen($searchincommentsarr[$i])+strlen($searchincomments);
								}
								$autortext = $searchincommentsarr[0];
								for ($i=1;$i<$cntupper;$i++) {
									if ($i>0) {
										$autortext .= '<span class="tx-tc-foundserchterm">' . $searchincommentstermarr[$i] . '</span>' .$searchincommentsarr[$i];
									}
								}
							}

						} else {
							$feuserid = $GLOBALS['TSFE']->fe_user->user['uid'];
							$savratingsuseLikeDislikeStyle = $conf['ratings.']['useLikeDislikeStyle'];
							$conf['ratings.']['useLikeDislikeStyle'] = 0;
							$savratingsmode =$conf['ratings.']['mode'];
							$conf['ratings.']['mode'] = 'static';
							$savshowCountCommentViews =$conf['advanced.']['showCountCommentViews'];
							$conf['advanced.']['showCountCommentViews'] = 0;
							$conf['ratings.']['dontUseCommentdate'] = 1;
							$allratingmarkers = $this->comments_getComments_getRatings($row, $conf, $pObj, $feuserid, $fromAjax);
							if ($usercenterlistid == 9) {
								$savexternal_ref_uid = $row['external_ref_uid'];
								$allreviewmarkers='';
								$arrextref = explode('_', $row['external_ref']);
								$_SESSION['commentsPageId'] = $arrextref[count($arrextref)-1];
								$_SESSION['commentListCount']= str_replace('tt_content_', '', $row['external_ref_uid']);

								$savcommentReview =$conf['advanced.']['commentReview'];
								$savuseMyVote = $conf['ratings.']['useMyVote'];
								$savuseVotes = $conf['ratings.']['useVotes'];
								$savuseNumberOfVotes = $conf['ratings.']['useNumberOfVotes'];
								$savuseNumberOfStars = $conf['ratings.']['useNumberOfStars'];
								$savuseAvgOfVotes = $conf['ratings.']['useAvgOfVotes'];
								$savuseLikeDislike = $conf['ratings.']['useLikeDislike'];
								$savuseDislike = $conf['ratings.']['useDislike'];

								$conf['advanced.']['commentReview'] = 1;
								$conf['ratings.']['useMyVote'] = 1;
								$conf['ratings.']['useVotes'] = 1;
								$conf['ratings.']['useNumberOfVotes'] = 0;
								$conf['ratings.']['useNumberOfStars'] = 0;
								$conf['ratings.']['useAvgOfVotes'] = 0;
								$conf['ratings.']['useLikeDislike'] = 0;
								$conf['ratings.']['useDislike'] = 0;
								$conf['ratings.']['mode'] = 'static';
								$conf['ratings.']['modeusercenter'] = 1;
								$articleratingarr = $this->getRatingDisplay($savexternal_ref_uid, $conf, $fromAjax, $_SESSION['commentsPageId'], TRUE,
										$feuserid, 'votearticle', $pObj, $_SESSION['commentListCount'], 0, $compics, $scopeid, 1);
								unset($conf['ratings.']['modeusercenter']);
								$voteHTML = $articleratingarr['voteing'];
								$conf['ratings.']['useMyVote'] = $savuseMyVote;
								$conf['ratings.']['useVotes'] = $savuseVotes;
								$conf['ratings.']['useNumberOfVotes'] = $savuseNumberOfVotes;
								$conf['ratings.']['useNumberOfStars'] = $savuseNumberOfStars;
								$conf['ratings.']['useAvgOfVotes'] = $savuseAvgOfVotes;
								$conf['ratings.']['useLikeDislike'] = $savuseLikeDislike;
								$conf['ratings.']['useDislike'] = $savuseDislike;
								$conf['advanced.']['commentReview'] = $savcommentReview;
								$voteHTML = str_replace('id="tx-tc-rts', 'id="tx-tc-rws' . $row['uid'], $voteHTML);
								$voteHTML = str_replace('id="tx-tc-myrts', 'id="tx-tc-myrws' . $row['uid'], $voteHTML);
								$voteHTML = str_replace('id="tx-tc-scope-', 'id="tx-tc-scope-' . $row['uid'], $voteHTML);
								if (trim($voteHTML) != '') {
									$allreviewmarkers = '<div class="tx-tc-rws-area">' . $voteHTML . '</div>';
								}
								$reviewhtml =  '<div class="tx-tc-width100 tx-tc-tabledisp">' . $allreviewmarkers .'</div>';
							}
							$conf['ratings.']['useLikeDislikeStyle'] = $savratingsuseLikeDislikeStyle;
							$conf['ratings.']['mode'] = $savratingsmode;
							$conf['advanced.']['showCountCommentViews'] = $savshowCountCommentViews;
							unset($conf['ratings.']['dontUseCommentdate']);
							$ratinghtml = '<div class="tx-tc-width100 tx-tc-tabledisp">' . $allratingmarkers .'</div>';
							$commentcontent = '<div class="tx-tc-width100 tx-tc-tabledisp">' . $commentcontent .'</div>';
						}
						$markerArray = array(
								'###AUTHOR###' => $autortext,
								'###COMMENT_DATE###' => '<span id="tx-tc-rctdatedisp-' .$row['uid'] .'">' .
								$this->applyStdWrap($this->formatDate($row['crdate'], $pObj, $fromAjax, $conf), 'crdate_stdWrap', $conf) .
								'</span><span id="tx-tc-rctdatetime-' .$row['uid'] .'" class="tx-tc-nodisp">'.$row['crdate'].'</span>',
								'###TITLE###' => $this->applyStdWrap($titleimage . $titlelink, 'recentComment_stdWrap', $conf),
								'###COMMENT_CONTENT###' => $commentcontent,
								'###RCID###' => $okrowsi,
								'###RATING###' => $ratinghtml,
								'###REVIEW###' => $reviewhtml,
						);

						$entries[] = $this->t3substituteMarkerArray($template, $markerArray);
						$okrowsi++;
					}

					// if not: link did not resolve -> not accessible to user - we skip
				}

				// if not: link did not resolve -> not accessible to user - we skip
			}

			if ($okrowsi>=$listCount) {

				break;
			}

		}
		$retstrinner='';
		if (intval($showrecentcomment)==0) {
			$retstr = implode($entries);

		} else {
			$cntentries = count($entries);
			for ($i=0; (($i<$showrecentcomment) && ($i<$cntentries)); $i++) {
				$retstr .= $entries[$i];
			}
			for ($i=$showrecentcomment;($i<$cntentries);$i++) {
				$retstrinner .= $entries[$i];
			}
			if ($retstrinner !='') {
				$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROPDOWNSHOWMORE###'),
						array(
								'###DROPDOWNID###' => ($usercenterlistid+$usercenterlistid*100),
								'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenter_showmoreorless', $fromAjax),
								'###DROPUPORDOWN###' => 'Down',
								'###TITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenter_showmore', $fromAjax),
								'###CONTENT###' => $retstrinner,

						)
				);
			}

		}
		return $retstr;
	}


	/**
	 * Creates links for single recent comment-line
	 *
	 * @param	string		$text	Text to search for links
	 * @param	int		$refID
	 * @param	int		$commentID
	 * @param	string		$prefix
	 * @param	string		$table
	 * @param	string		$externalprefix
	 * @param	int		$singlePid
	 * @param	array		$conf
	 * @param	boolean		$show_uid: ...
	 * @param	[type]		$okrowsi: ...
	 * @return	string		Link
	 */
	protected function createRCLinks($text, $refID, $commentID, $prefix, $externalprefix, $singlePid, $conf, $show_uid, $okrowsi) {
		$otext=$text;
		if ($conf['recentcomments.']['linkComments'] == 1) {
			if ($show_uid=='') {
				$show_uid = 'uid';
			}

			if (strpos($show_uid, '&')===FALSE) {
				$getparams = $externalprefix .'[' . $show_uid . ']';
			} else {
				$getparams = $show_uid;
			}

			if (str_replace('ext', '', $refID) != $refID) {
			 	$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $refID));
				list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
					'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

				if (trim($uidrow['externaluid']) != '') {
					$refID = $uidrow['externaluid'];
				}
			}

			$params = array(
	                $getparams => $refID,
					'toctoc_comments_pi1[anchor]'=>substr($conf['recentcomments.']['anchorPre'], 1).$commentID,
	            );
	        if ($prefix == 'pages_') {
        		$params = array(
        				'toctoc_comments_pi1[anchor]'=>substr($conf['recentcomments.']['anchorPre'], 1).$commentID,
        		);
        	}

			$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
        	$no_cacheflag = 0;

        	if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) ==0) {
        		if ($useCacheHashNeeded == 1) {
        			$no_cacheflag = 1;
        		}

        	}
        	$addparams = t3lib_div::implodeArrayForUrl('', $params, '', 1);
        	$tmpexternalUidarr = explode('%40page', $addparams);
		if (count($tmpexternalUidarr) >1) {
			$addparams = array_shift($tmpexternalUidarr);
			$tmpexternalUid = implode ('', $tmpexternalUidarr);
			$tmpexternalUidarr = explode('&', $tmpexternalUid);
			if (count($tmpexternalUidarr) >1) {
				array_shift($tmpexternalUidarr);
				$tmpexternalUid = implode('&', $tmpexternalUidarr); 
				$addparams .= '&' . $tmpexternalUid;
				$addparams = str_replace('&&', '&', $addparams);
			}					
		}
        	$addparams = str_replace('7g8', '-', $addparams);

 			$conflink = array(
        		'useCacheHash'     => $useCacheHashNeeded,
        		'no_cache'         => $no_cacheflag,
        		'parameter'        => $singlePid.$conf['recentcomments.']['anchorPre'].$commentID,
        		'additionalParams' => $addparams,
				'ATagParams' => 'rel="nofollow"',
 				'forceAbsoluteUrl' => 1,
        	);

 			// This part of code is to make enablefields() work in environment which delete these globals
 			if (!isset($GLOBALS['TCA'])) {
 				$GLOBALS['TCA'] = array();
 			}

 			if (!isset($GLOBALS['TCA']['sys_domain'])) {
 				$GLOBALS['TCA']['sys_domain'] = array();
 			}
 			if (!isset($GLOBALS['TCA']['sys_domain']['ctrl'])) {
 				$GLOBALS['TCA']['sys_domain']['ctrl'] = array();
 			}

 			if (!isset($GLOBALS['TCA']['tt_content'])) {
 				$GLOBALS['TCA']['tt_content'] = array();
 			}
 			if (!isset($GLOBALS['TCA']['tt_content']['ctrl'])) {
 				$GLOBALS['TCA']['tt_content']['ctrl'] = array();
 			}
 			//
        	$text = $this->cObj->typoLink($text, $conflink);
        	$text = str_replace('href="', 'href="javascript:recentct(0, ' . $okrowsi . ', ' . $singlePid . ', \'', $text);
        	$text = str_replace('" rel="nofollow', '\')" rel="nofollow', $text);
        }

        return $text;
	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_recentcomments.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_recentcomments.php']);
}
?>