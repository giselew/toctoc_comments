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
 * class.toctoc_comments_usercenter.php
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
 *   56: class toctoc_comments_usercenter extends toctoc_comment_lib
 *   65:     protected function usercenter ($conf, $pObj, $fromAjax = FALSE)
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
class toctoc_comments_usercenter extends toctoc_comment_lib {
	/**
 * generation of top ratings
 *
 * @param	[type]		$conf: ...
 * @param	[type]		$pObj: ...
 * @param	[type]		$fromAjax: ...
 * @return	string		...
 */
	protected function usercenter ($conf, $pObj, $fromAjax = FALSE) {
		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_recentcomments.php'));
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$siteRelPath = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments');
		$debug='';

		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}

		$pidcond='';
		if ($tmpint) {
			$conf['storagePid'] = intval($conf['storagePid']);
		} else {
			$conf['storagePid'] = $GLOBALS['TYPO3_DB']->cleanIntList($conf['storagePid']);
		}
		$pidcond='deleted=0 AND approved=1 AND hidden=0 AND ';
		$UserImage = '';
		if (intval($conf['useUserImage']) != 0) {
			$mpics = FALSE;
			 if (!isset($_SESSION['userAJAXimage'])) {
			 	$mpics = TRUE;
			 } else {
			 	if (trim($_SESSION['userAJAXimage'])=='') {
			 		$mpics = TRUE;
			 	}
			 }

			 if ($mpics == TRUE) {
				$rowsfeuser = array();
				$rowsfeuser = $this->getBaseFeUsersArray($pObj, $fromAjax, $GLOBALS['TSFE']->fe_user->user['uid']);
				$usergenderexistsstr='';
				if (count($rowsfeuser)>0) {
					if (array_key_exists('gender', $rowsfeuser)) {
						$usergenderexistsstr=' fe_users.gender AS gender, ';
					}

				}

				$this->build_AJAXImages($conf, $pObj, $usergenderexistsstr, $fromAjax);
				$UserImage=$this->getAJAXimage($GLOBALS['TSFE']->fe_user->user['uid'], 0, $conf);
			 } else {
			 	$UserImage = $_SESSION['userAJAXimage'];
			 }
			$UserImage = str_replace(' tx-tc-nodisp', '', $UserImage);
			$UserImage = str_replace(' align="left"', '', $UserImage);
			$UserImage = str_replace('  title', ' title', $UserImage);
			$userImageArr = explode('width="', $UserImage);
			$userImageArr2 = explode('"', $userImageArr[1]);
			$userImageArr2[0] = $this->userimagesize;
			$userImageArr[1] = implode('"', $userImageArr2);
			$UserImage = implode('width="', $userImageArr);
			$userImageArr = explode('height="', $UserImage);
			$userImageArr2 = explode('"', $userImageArr[1]);
			$userImageArr2[0] = $this->userimagesize;
			$userImageArr[1] = implode('"', $userImageArr2);
			$UserImage = implode('height="', $userImageArr);
		}
		// Build the user portrait

		//enable all uc options
		$saveuserContactUC = $conf['userContactUC'];
		$saveuserHomepageUC = $conf['userHomepageUC'];
		$saveuserEmailUC = $conf['userEmailUC'];
		$saveuserLocationUC = $conf['userLocationUC'];
		$saveuserStatsUC = $conf['userStatsUC'];
		$saveUCUserStatsByEmail = $conf['UCUserStatsByEmail'];
		$saveuserIPUC = $conf['userIPUC'];
		$conf['userContactUC'] = 1;
		$conf['userHomepageUC'] = 1;
		$conf['userEmailUC'] = 1;
		$conf['userLocationUC'] = 1;
		$conf['userStatsUC'] = 1;
		$conf['UCUserStatsByEmail'] = 0;
		$conf['userIPUC'] = 1;

		$userportrait = $this->getUserCard(base64_encode($UserImage),
				base64_encode('0.0.0.0.'. $GLOBALS['TSFE']->fe_user->user['uid']), $conf, $pObj, 0, FALSE, TRUE);
		$userportrait = str_replace('tx-tc-ct-uc-', 'tx-tc-ct-usercenter-', $userportrait);

		$conf['userContactUC'] = $saveuserContactUC;
		$conf['userHomepageUC'] = $saveuserHomepageUC;
		$conf['userEmailUC'] = $saveuserEmailUC;
		$conf['userLocationUC'] = $saveuserLocationUC;
		$conf['userStatsUC'] = $saveuserStatsUC;
		$conf['UCUserStatsByEmail'] = $saveUCUserStatsByEmail;
		$conf['userIPUC'] = $saveuserIPUC;
		// Build the lists

		// when a list is specified it's content is separated from the main comement list comments
		// Comments, Ratings, Reviews, Plugintotablemap, Commentsoncomments, Imageattachments, pdfattachments

		$retstr = 	'';
		$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),
				array(
						'###DROPDOWNID###' => 1,
						'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentertitle_showorhideuserinformation', FALSE),
						'###DROPUPORDOWN###' => 'Up',
						'###TITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentertitle_userinformation', FALSE),
						'###CONTENT###' => $userportrait,

				)
		);

		$wherecommentlistcontentCoc = '';
		$wherecommentlistcontentRev = '';
		$wherecommentlistcontentPlitT = '';
		$listreview = FALSE;
		$listCommentsoncomments = FALSE;
		$listPlugintotablemap = FALSE;
		$wherebase = $pidcond . 'toctoc_commentsfeuser_feuser='. $GLOBALS['TSFE']->fe_user->user['uid'];

		if (str_replace('Reviews', '', $conf['userCenter.']['uCLists']) != $conf['userCenter.']['uCLists']) {
			$wherecommentlistcontentRev = ' AND isreview = 0';
			$listreview = TRUE;
		}

		if (str_replace('Commentsoncomments', '', $conf['userCenter.']['uCLists']) != $conf['userCenter.']['uCLists']) {
			$wherecommentlistcontentCoc = ' AND parentuid = 0';
			$listCommentsoncomments = TRUE;
		}

		if (str_replace('Plugintotablemap', '', $conf['userCenter.']['uCLists']) != $conf['userCenter.']['uCLists']) {
			$wherecommentlistcontentPlitT = ' AND external_prefix = "pages"';
			$listPlugintotablemap = TRUE;
		}
		$mincrdate = time() - 24*60*60*$conf['userCenter.']['maxItemAgeUCList'];
		$wherecrdate = ' AND crdate > ' . $mincrdate;
		$sorting = $conf['recentcomments.']['sorting'];
		$wherecomm = $wherebase . $wherecommentlistcontentCoc . $wherecommentlistcontentRev . $wherecommentlistcontentPlitT . $wherecrdate;
		$saverecentcommentslistCount = $conf['recentcomments.']['listCount'];
		$conf['recentcomments.']['listCount'] = $conf['userCenter.']['maxItemsPerUCList'];
		$conf['recentcommentslistCount'] = $conf['userCenter.']['maxItemsPerUCList'];

		if ($conf['userCenter.']['maxItemAgeUCList'] > 1) {
			$showcasedoc = $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentercomments_commentsratingsmadein', FALSE) . ' ' .
			$conf['userCenter.']['maxItemAgeUCList'] . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.days', FALSE);
		} else {
			$showcasedoc = $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentercomments_commentsratingsmadein', FALSE) . ' 24' .
			' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hours', FALSE);
		}
		$retstr .= '<div class="tx-tc-title tx-tc-ucliststitle"><span class="tx-tc-ucliststitletext">'. $showcasedoc .'</span></div>';

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'"dummy" AS refTitle, tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
            tx_toctoc_comments_comments.firstname AS firstname, tx_toctoc_comments_comments.lastname AS lastname,
            tx_toctoc_comments_comments.content AS content, tx_toctoc_comments_comments.external_ref AS external_ref,
			tx_toctoc_comments_comments.external_ref_uid AS external_ref_uid,
			tx_toctoc_comments_comments.parentuid AS parentuid,
 			tx_toctoc_comments_comments.external_prefix AS external_prefix,
 			tx_toctoc_comments_comments.crdate AS crdate',
				'tx_toctoc_comments_comments',
				$wherecomm,
				'',
				$sorting
		);
		$countrows = count($rows);
		if ($countrows > 0) {

			$librecentcomments = new toctoc_comments_recentcomments;
			$subParts = array(
					'###SINGLE_USERCENTERCOMMENT###' => $librecentcomments->comments_getRecentComments($rows, $conf, $pObj, 1, 1),
			);
			$markers = array();
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTERCOMMENT_LIST###');
			$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
			$carr = explode('"tx-tc-recent-cts-article"', $content);
			$countrows = count($carr) -1;
			$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),
					array(
							'###DROPDOWNID###' => 2,
							'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentercomments_showorhideuserinformation', FALSE),
							'###DROPUPORDOWN###' => 'Up',
							'###TITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentercomments_title', FALSE). ' ('.$countrows.')',
							'###CONTENT###' => $content,

					)
			);
		}

		if ($listCommentsoncomments == TRUE) {
			$wherecommentlistcontent = str_replace('AND parentuid = 0', 'AND parentuid != 0', $wherecommentlistcontent);
			$wherecommentlistcontentCocLoc = ' AND parentuid != 0';
			$wherecomm = $wherebase . $wherecommentlistcontentCocLoc . $wherecommentlistcontentRev . $wherecommentlistcontentPlitT . $wherecrdate;
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'"dummy" AS refTitle, tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
            tx_toctoc_comments_comments.firstname AS firstname, tx_toctoc_comments_comments.lastname AS lastname,
            tx_toctoc_comments_comments.content AS content, tx_toctoc_comments_comments.external_ref AS external_ref,
			tx_toctoc_comments_comments.external_ref_uid AS external_ref_uid,
			tx_toctoc_comments_comments.parentuid AS parentuid,
 			tx_toctoc_comments_comments.external_prefix AS external_prefix,
 			tx_toctoc_comments_comments.crdate AS crdate',
					'tx_toctoc_comments_comments',
					$wherecomm,
					'',
					$sorting
			);
			$countrows = count($rows);
			if ($countrows > 0) {
				if (!isset($librecentcomments)) {
					$librecentcomments = new toctoc_comments_recentcomments;
				}
				$subParts = array(
						'###SINGLE_USERCENTERCOMMENT###' => $librecentcomments->comments_getRecentComments($rows, $conf, $pObj, 1, 5),
				);
				$markers = array();
				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTERCOMMENT_LIST###');
				$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
				$carr = explode('"tx-tc-recent-cts-article"', $content);
				$countrows = count($carr) -1;
				$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),
						array(
								'###DROPDOWNID###' => 5,
								'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentersubcomments_showorhideuserinformation', FALSE),
								'###DROPUPORDOWN###' => 'Up',
								'###TITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentersubcomments_title', FALSE). ' ('.$countrows.')',
								'###CONTENT###' => $content,

						)
				);
			}
		}

		if ($listPlugintotablemap == TRUE) {
			// make list of plugin to tablemaps with comments
			$wherecommentlistcontentPlitTLoc = ' AND external_prefix != "pages"';
			$wherecomm = $wherebase . $wherecommentlistcontentCoc . $wherecommentlistcontentRev . $wherecommentlistcontentPlitTLoc . $wherecrdate;
			$rowstablemap = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'DISTINCT tx_toctoc_comments_comments.external_prefix AS external_prefix',
					'tx_toctoc_comments_comments',
					$wherecomm,
					'',
					''
			);
			$countrowstablemap = count($rowstablemap);
			if ($countrowstablemap > 0) {

				for ($i=0;$i<$countrowstablemap;$i++) {
					// make a commentlist per plugin to tablemap
					$sorting = $conf['recentcomments.']['sorting'];
					$wherecommentlistcontentPlitTLoc = ' AND external_prefix = "'.$rowstablemap[$i]['external_prefix'].'"';

					$wherecomm = $wherebase . $wherecommentlistcontentCoc . $wherecommentlistcontentRev . $wherecommentlistcontentPlitTLoc . $wherecrdate;
					$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'"dummy" AS refTitle, tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
            tx_toctoc_comments_comments.firstname AS firstname, tx_toctoc_comments_comments.lastname AS lastname,
            tx_toctoc_comments_comments.content AS content, tx_toctoc_comments_comments.external_ref AS external_ref,
			tx_toctoc_comments_comments.external_ref_uid AS external_ref_uid,
			tx_toctoc_comments_comments.parentuid AS parentuid,
 			tx_toctoc_comments_comments.external_prefix AS external_prefix,
 			tx_toctoc_comments_comments.crdate AS crdate',
							'tx_toctoc_comments_comments',
							$wherecomm,
							'',
							$sorting
					);
					$countrows = count($rows);
					if ($countrows > 0) {
						if (!isset($librecentcomments)) {
							$librecentcomments = new toctoc_comments_recentcomments;
						}	$subParts = array(
								'###SINGLE_USERCENTERCOMMENT###' => $librecentcomments->comments_getRecentComments($rows, $conf, $pObj, 1, '2i'.$rowstablemap[$i]['external_prefix']),
						);
						$markers = array();
						$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTERCOMMENT_LIST###');
						$extpreffortext = 'pages';
						if ((trim($rowstablemap[$i]['external_prefix'])=='tt_products') || (trim($rowstablemap[$i]['external_prefix']) == 'tx_commerce_pi1')) {
							$extpreffortext ='tt_products';
						} elseif  (trim($rowstablemap[$i]['external_prefix'])=='tx_wecstaffdirectory_pi1') {
							$extpreffortext ='tx_wecstaffdirectory_pi1';
						} elseif  (trim($rowstablemap[$i]['external_prefix'])=='tx_album3x_pi1') {
							$extpreffortext ='tx_album3x_pi1';
						} elseif   ((trim($rowstablemap[$i]['external_prefix'])=='tx_mininews_pi1') || (trim($rowstablemap[$i]['external_prefix'])=='tx_ttnews') ||
								(trim($rowstablemap[$i]['external_prefix'])=='tx_news_pi1')) {
							$extpreffortext ='tx_ttnews';
						}
						$pttmtext = $this->pi_getLLWrap($pObj, 'pi1_template.text_on', FALSE) . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item', $fromAjax);

						if  ((trim($rowstablemap[$i]['external_prefix'])=='tx_community') || (trim($rowstablemap[$i]['external_prefix'])=='tx_cwtcommunity_pi1')) {
							$pttmtext =$this->pi_getLLWrap($pObj, 'pi1_template.text_usercenter_incommunity', FALSE);
						}

						$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
						$carr = explode('"tx-tc-recent-cts-article"', $content);
						$countrows = count($carr) -1;
						$boxtitle = $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentercomments_title', FALSE) . ' ' . $pttmtext. ' ('.$countrows.')';
						$tmpret=
						$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),

								array(
										'###DROPDOWNID###' => '2'.$rowstablemap[$i]['external_prefix'],
										'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentercomments_showorhideuserinformation', FALSE),
										'###DROPUPORDOWN###' => 'Up',
										'###TITLE###' => $boxtitle,
										'###CONTENT###' => $content,

								)
						);
					}
				}
			}

		}

		if ($listreview == TRUE) {
			$wherecommentlistcontentRevloc = ' AND isreview = 1';
			$wherecomm = $wherebase . $wherecommentlistcontentCoc . $wherecommentlistcontentRevloc . $wherecommentlistcontentPlitT . $wherecrdate;
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'"dummy" AS refTitle, tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
            tx_toctoc_comments_comments.firstname AS firstname, tx_toctoc_comments_comments.lastname AS lastname,
            tx_toctoc_comments_comments.content AS content, tx_toctoc_comments_comments.external_ref AS external_ref,
			tx_toctoc_comments_comments.external_ref_uid AS external_ref_uid,
			tx_toctoc_comments_comments.parentuid AS parentuid,
 			tx_toctoc_comments_comments.external_prefix AS external_prefix,
			tx_toctoc_comments_comments.crdate AS crdate,
			tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser AS toctoc_commentsfeuser_feuser,
			tx_toctoc_comments_comments.toctoc_comments_user AS toctoc_comments_user',
					'tx_toctoc_comments_comments',
					$wherecomm,
					'',
					$sorting
			);
			$countrows = count($rows);
			if ($countrows > 0) {
				if (!isset($librecentcomments)) {
					$librecentcomments = new toctoc_comments_recentcomments;
				}
				$subParts = array(
						'###SINGLE_USERCENTERCOMMENT###' => $librecentcomments->comments_getRecentComments($rows, $conf, $pObj, 1, 9),
				);
				$markers = array();
				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTERCOMMENT_LIST###');
				$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
				$boxtitle = $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenterreviews_title', FALSE) . ' ('.$countrows.')';
				$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),
				array(
						'###DROPDOWNID###' => '9',
						'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenterreviews_showorhideuserinformation', FALSE),
						'###DROPUPORDOWN###' => 'Up',
						'###TITLE###' => $boxtitle,
						'###CONTENT###' => $content,

				)
				);
			}
		}
		$conf['recentcomments.']['listCount'] = $saverecentcommentslistCount;
//ratings
		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_charts.php'));
		$libchart = new toctoc_comments_charts;
		$ratings = $libchart->topratings($conf, $pObj, 2);
		if (str_replace('tx-tc-trt-rating-detail', '', $ratings) != $ratings) {
			$countrows = count(explode('tx-tc-trt-rating-detail', $ratings))-1;

			$boxtitle = $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentervotes_title', FALSE) . ' ('.$countrows.')';
			$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),
					array(
							'###DROPDOWNID###' => '3',
							'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentervotes_showorhideuserinformation', FALSE),
							'###DROPUPORDOWN###' => 'Up',
							'###TITLE###' => $boxtitle,
							'###CONTENT###' => $ratings,

					)
			);
		}

		$ratings = $libchart->topratings($conf, $pObj, 1);
		if (str_replace('tx-tc-trt-rating-detail', '', $ratings) != $ratings) {
			$countrows = count(explode('tx-tc-trt-rating-detail', $ratings))-1;
			$boxtitle = $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenterlikes_title', FALSE) . ' ('.$countrows.')';
			$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER_DROP_DOWN###'),
					array(
							'###DROPDOWNID###' => '4',
							'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenterlikes_showorhideuserinformation', FALSE),
							'###DROPUPORDOWN###' => 'Up',
							'###TITLE###' => $boxtitle,
							'###CONTENT###' => $ratings,

					)
			);
		}

		$retstrout = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###USERCENTER###'),
				array(
				'###USERCENTEROFTITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercentertitle', FALSE),
				'###USERCENTERUSER###' => $this->getUserName($GLOBALS['TSFE']->fe_user->user['uid'], $pObj, FALSE, $conf),
				'###USERCENTERCONTENT###' => $retstr,
				)
		);

		$retstrout = $pObj->pi_wrapInBaseClass(str_replace(' class="toctoc-comments-pi1"', '', $retstrout));
		return $retstrout;
	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_usercenter.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_usercenter.php']);
}
?>