<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *  132:     public function comments_getRecentComments($rows, $conf, $pObj)
 *  447:     protected function createRCLinks($text, $refID, $commentID, $prefix, $externalprefix, $singlePid, $conf, $show_uid, $okrowsi)
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
				
		$where = 'tx_toctoc_comments_comments.' . $pidcond . $this->enableFields('tx_toctoc_comments_comments', $pObj);
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
	 * @return	string		Generated HTML
	 */
	public function comments_getRecentComments($rows, $conf, $pObj) {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		if (count($rows) == 0) {

			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###RECENTNO_COMMENTS###');
			if ($template) {
				$retstr =$this->t3substituteMarker($template, '###LL_TEXT_NO_COMMENTS###', $this->pi_getLLWrap($pObj, 'pi1_template.text_no_comments', FALSE));
				return $retstr;
			}

		}

		$entries = array();
		$template= $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_RECENTCOMMENT###');
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

			$where = $mmtable. '.uid = ' . $refID;
			$targetfortitle='title';
			if ($mmtable== 'tx_wecstaffdirectory_info') {
				$targetfortitle='full_name';
			}

			$ownershipok=1;
			if ($mmtable== 'fe_users') {
				$targetfortitle='name';
				$arr_groupmembers=explode(',', $this->usersGroupmembers($pObj, FALSE, $conf, TRUE));

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
				$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						$mmtable . '.' . $targetfortitle . ' AS refTitle',
						$mmtable,
						$where,
						'',
						'',
						''
				);
				$row['refTitle']=$rowstitle[0]['refTitle'];
				$itemtitle = 'News';
				$cttitle = str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.textcommentlink', FALSE));
				$itemtitle = ucfirst($this->pi_getLLWrap($pObj, 'comments_recent.' . $mmtable .'', FALSE));

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

				if ($skiprow==FALSE) {

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

					$commenttext = $this->trimContent($row['content'], $conf, $conf['recentcomments.']['maxCharCount'], FALSE);

					//Parse for Links and Smilies
					$this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() .
							t3lib_extMgm::siteRelPath('toctoc_comments'), $conf['smiliePath']);
					$this->smilies = $this->parseSmilieArray($conf['smilies.']);
					$commenttext = $this->replaceSmilies($commenttext, $conf);
					$commenttext =$this->replaceBBs($commenttext, $pObj, $conf, TRUE);
					$saveconfemoji=$conf['advanced.']['useEmoji'];

					//$conf['advanced.']['useEmoji']=0;
					$commenttext = $this->makeemoji($commenttext, $conf, 'comments_getRecentComments');

					$conf['advanced.']['useEmoji']=$saveconfemoji;

					$commenttext =$this->addleadingspace($commenttext);
					if ($itemtitle !='') {
						$itemtitle='title="' . $itemtitle . '" ';
					}

					$titleimage = '<img class="tx-tc-rcentpic" width="14" height="14" valign="middle" ' . $itemtitle . 'src="' . $exticon;
					$commentimage = '';
					$authorimage = '';

					$link=$this->createRCLinks($commenttext, $refID, $commentID, $prefix, $externalprefix, $pageid, $conf, $show_uid, $okrowsi);
					if ($link !=$commenttext) {
						$titlelink = $this->createRCLinks(strip_tags($row['refTitle']), $refID, $commentID, $prefix, $externalprefix,
								$pageid, $conf, $show_uid, $okrowsi);
						$markerArray = array(
								'###AUTHOR###' => $this->applyStdWrap($authorimage. $row['firstname'].'&nbsp;'.$row['lastname'], 'author_stdWrap', $conf),
								'###COMMENT_DATE###' => '<span id="tx-tc-rctdatedisp-' .$row['uid'] .'">' .
								$this->applyStdWrap($this->formatDate($row['crdate'], $pObj, FALSE, $conf), 'crdate_stdWrap', $conf) .
								'</span><span id="tx-tc-rctdatetime-' .$row['uid'] .'" class="tx-tc-nodisp">'.$row['crdate'].'</span>',
								'###TITLE###' => $this->applyStdWrap($titleimage . $titlelink, 'recentComment_stdWrap', $conf),
								'###COMMENT_CONTENT###' => $this->applyStdWrap($commentimage. $link, 'content_stdWrap', $conf),
								'###RCID###' => $okrowsi,
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

		$retstr = implode($entries);
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
 			$conf = array(
        		'useCacheHash'     => $useCacheHashNeeded,
        		'no_cache'         => $no_cacheflag,
        		'parameter'        => $singlePid.$conf['recentcomments.']['anchorPre'].$commentID,
        		'additionalParams' => t3lib_div::implodeArrayForUrl('', $params, '', 1),
				'ATagParams' => 'rel="nofollow"',
        	);
        	$text = $this->cObj->typoLink($text, $conf);
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