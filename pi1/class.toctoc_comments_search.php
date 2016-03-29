<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * class.toctoc_comments_search.php
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
 *   56: class toctoc_comments_search extends toctoc_comment_lib
 *   67:     protected function commentssearch ($conf, $pObj, $fromAjax = FALSE, $data = '', $cidin)
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
class toctoc_comments_search extends toctoc_comment_lib {
	/**
 * generation of top ratings
 *
 * @param	[type]		$conf: ...
 * @param	[type]		$pObj: ...
 * @param	[type]		$fromAjax: ...
 * @param	[type]		$data: ...
 * @param	[type]		$cidin: ...
 * @return	string		...
 */
	protected function commentssearch ($conf, $pObj, $fromAjax = FALSE, $data = '', $cidin) {
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

		if ($fromAjax == TRUE) {
		// ...
			$commentageopt = 0;
			$searchincomments = '';

			$fromrow=$data['from'];
			$cid = $cidin;
			$browsecommand=$data['browsecommand']; // down, show or up
			if ($browsecommand == 'up') {
				$fromrow = $fromrow + intval($conf['search.']['showCommentsPerPage']);
			} elseif ($browsecommand == 'down') {
				$fromrow = $fromrow - intval($conf['search.']['showCommentsPerPage']);
			} else {
				$commentageopt=$data['commentage'];
				$searchincomments=base64_decode($data['search']);
			}

		} else {
			$fromrow = 1;
			$commentageopt = $conf['search.']['initialCommentage'];
			$browsecommand = 'show';
			$searchincomments = '';
		}

		// initialCommentage, options: 1=1 day, 2=7 days, 3=1 month, 4=last 6 months, 5=1 year, 6=ever
		$commentage = 365;
		if ($commentageopt == 2){
			$commentage = 7;
		} elseif ($commentageopt == 1){
			$commentage = 1;
		} elseif ($commentageopt == 3){
			$commentage = 30;
		} elseif ($commentageopt == 4){
			$commentage = 182;
		} elseif ($commentageopt == 6){
			$commentage = 36500;
		}

		if ($fromAjax == FALSE) {
			$commentage_text = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_commentsmade', FALSE) . ' ' .
			$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.year', FALSE);
			$txtsel1 = '';
			$txtsel2 = '';
			$txtsel3 = '';
			$txtsel4 = '';
			$txtsel5 = '';
			$txtsel6 = '';
			$txtage1 = '24 ' .
			$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hours', FALSE);
			$txtage2 = '1 ' .
				$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.week', FALSE);
			$txtage3 = '1 ' .
					$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.month', FALSE);
			$txtage4 = '6 ' .
					$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.monthsgermannon', FALSE);
			$txtage5 = '1 ' .
					$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.year', FALSE);
			$txtage6 = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_alltime', FALSE);

			if ($commentageopt == 2){
				$commentage_text = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_commentsmade', FALSE) . ' ' .
				$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.week', FALSE);
				$txtsel2 = ' selected="selected"';
			} elseif ($commentageopt == 1){
				$commentage_text = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_commentsmade', FALSE) . ' 24' .
					' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hours', FALSE);
				$txtsel1 = ' selected="selected"';
			} elseif ($commentageopt == 3){
				$commentage_text = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_commentsmade', FALSE) . ' ' .
				$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.month', FALSE);
				$txtsel3 = ' selected="selected"';
			} elseif ($commentageopt == 4){
				$commentage_text = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_commentsmade', FALSE) . ' 6 ' .
				$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.months', FALSE);
				$txtsel4 = ' selected="selected"';
			} elseif ($commentageopt == 6){
				$commentage_text = $this->pi_getLLWrap($pObj, 'pi1_template.commentssearch_commentsalltime', FALSE);
				$txtsel6 = ' selected="selected"';
			} else {
				$txtsel5 = ' selected="selected"';
			}
		}

		$pidcond='';
		if ($fromAjax == TRUE) {
			// Build the searchresult
			$conf['storagePid']=$_SESSION['srchstoragePid'];
		}

		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}

		if ($tmpint) {
			$conf['storagePid'] = intval($conf['storagePid']);
			$pidcond='pid=' . $conf['storagePid'] . ' AND ';
		} else {
			$conf['storagePid'] = $GLOBALS['TYPO3_DB']->cleanIntList($conf['storagePid']);
			$pidcond='pid IN(' . $conf['storagePid'] . ') AND ';
		}

		$pidcond .= 'deleted=0 AND approved=1 AND hidden=0 AND ';

		// Build the list

		$retstr = 	'';

		if ($fromAjax == TRUE) {
			// Build the searchresult
			$wherebase = $pidcond . '(content LIKE "%'. $searchincomments . '%"';
			$wherebase .=  ' OR firstname LIKE "%'. $searchincomments . '%"';
			$wherebase .=  ' OR lastname LIKE "%'. $searchincomments . '%")';
			$mincrdate = time() - 24*60*60*$commentage;
			$wherecrdate = ' AND crdate > ' . $mincrdate;
			$sorting = 'uid DESC'; // $conf['recentcomments.']['sorting'];
			$wherecomm = $wherebase  . $wherecrdate;

			$saverecentcommentslistCount = $conf['recentcomments.']['listCount'];
			$saverecentcommentslinkComments = $conf['recentcomments.']['linkComments'];
			$saverecentcommentsmaxCharCount = $conf['recentcomments.']['maxCharCount'];
			$conf['recentcomments.']['linkComments'] = $conf['search.']['linkComments'];
			$conf['recentcomments.']['maxCharCount'] = $conf['search.']['SearchCommentCropLength'];
			$conf['recentcomments.']['listCount'] = $conf['search.']['searchMaxComments'];
			$conf['recentcommentslistCount'] = $conf['search.']['searchMaxComments'];

			$retstr .= '<div class="tx-tc-title tx-tc-ucliststitle"><span class="tx-tc-ucliststitletext">'. $commentage_text .'</span></div>';

			If ($browsecommand == 'show') {
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
				$_SESSION['srchrltcntrws']=$countrows;
			} else {

				$countrows = $_SESSION['srchrltcntrws'];
			}

			if ($countrows > 0) {
				If ($browsecommand == 'show') {
					$librecentcomments = new toctoc_comments_recentcomments;
					$RecentComments = $librecentcomments->comments_getRecentComments($rows, $conf, $pObj, 0, 0, TRUE, $searchincomments);
					$_SESSION['srchrlt']=array();
					$_SESSION['srchrlt']=$RecentComments;
					$_SESSION['srchterm']=$searchincomments;
				} else {
					$RecentComments = $_SESSION['srchrlt'];
					$countrows = $_SESSION['srchrltcntrws'];
					$searchincomments = $_SESSION['srchterm'];
				}

				$carr = explode('"tx-tc-recent-cts-article"', $RecentComments);
				$countrows = count($carr)-1;

				$text_found = trim($this->pi_getLLWrap($pObj, 'pi1_template.searchcommentsfoundtextbeforenr', TRUE) . ' ' . $countrows . ' ' .
					$this->pi_getLLWrap($pObj, 'pi1_template.searchcommentsfoundtextafternr', TRUE) . ' "' .
					'<span class="tx-tc-foundtext">' . htmlspecialchars($searchincomments)  .'</span>'. '"');
				$text_browse= '';
				$show_up = '';
				$show_down = '';
				$torow= ($fromrow + 2*intval($conf['search.']['showCommentsPerPage'])-1);
				if ($torow > $countrows) {
					$torow = $countrows;
				}
				$fromrownext = $fromrow + intval($conf['search.']['showCommentsPerPage']) . ' - ' . $torow;
				$fromrowprev = $fromrow - intval($conf['search.']['showCommentsPerPage']) . ' - ' . ($fromrow-1);

				if (($fromrow + intval($conf['search.']['showCommentsPerPage'])) < $countrows) {
					// show_up
					$show_up = '<div class="tx-tc-textlink tx-tc-searchmore"><span class="tx-tc-searchmore" id="txtc_show_up'. $cid . '__0' . $fromrow .'">'.
					$this->pi_getLLWrap($pObj, 'pi1_template.searchcommentsnext', TRUE) .' (' . $fromrownext . ')</span></div>';
				}
				if (($fromrow + intval($conf['search.']['showCommentsPerPage'])) == $countrows) {
					// show_up
					$show_up = '<div class="tx-tc-textlink tx-tc-searchmore"><span class="tx-tc-searchmore" id="txtc_show_up'. $cid . '__0' . $fromrow .'">'.
							$this->pi_getLLWrap($pObj, 'pi1_template.searchcommentsnext', TRUE) .' (' . (($fromrow + intval($conf['search.']['showCommentsPerPage']))) . ')</span></div>';
				}

				if (($fromrow - intval($conf['search.']['showCommentsPerPage'])) > 0) {
					$show_down .= '<div class="tx-tc-textlink tx-tc-searchprev"><span class="tx-tc-searchprev tx-tc-searchmore" id="txtc_show_down'. $cid . '__0' . $fromrow .'">'.
					$this->pi_getLLWrap($pObj, 'pi1_template.searchcommentsback', TRUE)  .' (' . $fromrowprev . ')</span></div>';
				}

				if (($show_up != '') || ($show_down != '')) {
					$text_browse = '<div class="tx-tc-searchbrowser">' . $show_up . $show_down . '</div>';
				}
				$rcommOutArr = array();
				$rcommArr = explode('<div class="tx-tc-recent-cts-article"', $RecentComments);
				$countrcomrows = count($rcommArr);
				$rcommOutArr[0] = $rcommArr[0];
				$j=1;
				$otherupperlimit = $fromrow + intval($conf['search.']['showCommentsPerPage']);

				for ($i = $fromrow; (($i< $countrcomrows) && ($i < $otherupperlimit)); $i++) {
					$rcommOutArr[$j] = $rcommArr[$i];
					$j++;
				}

				$RecentComments = implode('<div class="tx-tc-recent-cts-article"', $rcommOutArr);
				$subParts = array(
						'###SINGLE_SEARCHCOMMENT###' => $RecentComments,
				);

				$markers = array(
						'###SEARCHFOUND_TEXT###' => $text_found,
						'###SEARCHCOMMENTBROWSE###' => $text_browse,
				);

				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###SEARCHCOMMENT_CONTENT###');
				$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
			} else {
	        	// no comments found
	        	$subParts = array(
	        			'###SINGLE_SEARCHCOMMENT###' => '',
	        	);
	        	$markers = array(
	        			'###SEARCHFOUND_TEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.nocommentsfoundfor', TRUE) . ' "' . '<span class="tx-tc-foundtext">' . htmlspecialchars($searchincomments)  .'</span>'. '"',
	        			'###SEARCHCOMMENTBROWSE###' => '',
	        	);
	        	$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###SEARCHCOMMENT_CONTENT###');
	        	$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
			}
			$conf['recentcomments.']['listCount'] = $saverecentcommentslistCount;
			$conf['recentcomments.']['linkComments'] = $saverecentcommentslinkComments;
			$conf['recentcomments.']['maxCharCount'] = $saverecentcommentsmaxCharCount;

			$retstrout = $content;
		} else {
			$cid = '700' . $GLOBALS['TSFE']->id;
			$_SESSION['srchstoragePid']=$conf['storagePid'];

			$confDiff=$this->mirrorconf($conf, $cid);
			$dataarr = array();
			$dataarr['conf']=$confDiff;
			$data = serialize($dataarr);
			$hiddenconfDiff=base64_encode($data);

			$labelstyle = '';
			$phdr = '';
			if (intval($conf['advanced.']['watermarkFormFields']) == 1) {
				$labelstyle = ' tx-tc-nodisp';
				$phdr = 'placeholder="' . trim(str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.commentsearch_text_search', FALSE))) . '"';
			}

			if ($conf['theme.']['boxmodelLabelInputPreserve'] ==0 ) {
				$formfieldcclass = 'tx-tc-ct-input';
			} else{
				$formfieldcclass = '';
			}

			$retstr = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###SEARCHCOMMENT_FORM###'),
				array(
					'###LABELSTYLE###' => $labelstyle,
					'###TEXT_SEARCH###' => $this->pi_getLLWrap($pObj, 'pi1_template.commentsearch_text_search', FALSE),
					'###CID###' => $cid,
					'###SEARCH###' => htmlspecialchars($searchincomments),
					'###PHDR_SEARCH###' => $phdr,
					'###TEXT_SUBMIT###' => trim(str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.commentsearch_text_search', FALSE))),
					'###ENCTEXT###' =>  base64_encode(htmlspecialchars($searchincomments)),
					'###ENCTEXT_SEARCH_COMMENT###' =>  base64_encode($this->pi_getLLWrap($pObj, 'pi1_template.commentsearch_text_search', FALSE)),
					'###HIDDENCONFDIFF###' => $hiddenconfDiff,
					'###SEL1###' => $txtsel1,
					'###SEL2###' => $txtsel2,
					'###SEL3###' => $txtsel3,
					'###SEL4###' => $txtsel4,
					'###SEL5###' => $txtsel5,
					'###SEL6###' => $txtsel6,
					'###INPUTCLASS###' => $formfieldcclass,
					'###TEXT_CTAGE1###' => $txtage1,
					'###TEXT_CTAGE2###' => $txtage2,
					'###TEXT_CTAGE3###' => $txtage3,
					'###TEXT_CTAGE4###' => $txtage4,
					'###TEXT_CTAGE5###' => $txtage5,
					'###TEXT_CTAGE6###' => $txtage6,
					'###TEXT_COMMENTAGE###' => $this->pi_getLLWrap($pObj, 'pi1_template.commentsearch_text_age', FALSE),
					'###TXTOK###' => $this->pi_getLLWrap($pObj, 'pi1_template.ok', $fromAjax),
					'###TXTINFO###' => $this->pi_getLLWrap($pObj, 'pi1_template.information', $fromAjax),
				)
			);
			$searchpaneltitle = '';

			if ($conf['search.']['SearchDisplayTitle']) {
				$searchpaneltitle = '<div class="tx-tc-title tx-tc-title-usercenter">' . $this->pi_getLLWrap($pObj, 'pi1_template.text_commentssearchtitle', FALSE) . '</div>';
			}

			$retstrout = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###SEARCHCOMMENT_MAIN###'),
				array(
					'###TXTLOADING###' => $this->pi_getLLWrap($pObj, 'pi1_template.loadingpreview', FALSE),
					'###SEARCHCOMMENTOFTITLE###' => $searchpaneltitle,
					'###SEARCHCOMMENTFORM###' => $retstr,
					'###SEARCHCOMMENTCONTENT###' => '',
					'###CID###' => $cid,
				)
			);

			$retstrout = $pObj->pi_wrapInBaseClass(str_replace(' class="toctoc-comments-pi1"', '', $retstrout));

			if ($conf['theme.']['boxmodelLabelInputPreserve']==1) {
				$retstrout = str_replace('class="toctoc-comments-pi1', 'class="toctoc-comments-pi1 tx-tc-responsive', $retstrout);
			}
		}
		return $retstrout;
	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_search.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_search.php']);
}
?>