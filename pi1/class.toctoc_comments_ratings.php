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
 * class.class.toctoc_comments_ratings.php
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
 *   68: class toctoc_comments_ratings extends toctoc_comment_lib
 *
 *              SECTION: Rating functions
 *   89:     public function getRatingDisplay($ref, $conf = NULL, $fromAjax = 0, $pid=0, $returnasarray = FALSE, $feuserid = 0, $cmd = 'vote',
			$pObj = NULL, $cid, $fromcomments, $scopeid=0, $isReview = 0, $commentusername = '')
 *  156:     public function getBarWidth($rating, $conf, $isReview = 0)
 *  174:     protected function synchLikesWithEmoLikes($pObj, $ref, $conf, $fromAjax)
 *  277:     protected function getSubEmoLikeResultText($conf, $pObj, $template, $ref, $cid, $myemolikeval, $feuserid, $fromAjax)
 *  663:     protected function getSubEmoLikeResultIcons($conf, $pObj, $template, $ref, $rows, $myemolikeval, $fromAjax)
 *  760:     protected function getEmoTextColorLL($myemoval)
 *  796:     protected function getRatingInfo($ref, $pObj, $feuserid=-1, $conf, $scopeid=0, $fromAjax, $isReview = 0, $fromcomments = 0, $reviewfeuserid = 0)
 * 1040:     protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
	$scopeid = 0, $isReview = 0, $commentusername = '')
 * 2211:     public function emopopup($pObj, $template, $hidecss,$cid,$refforvote, $conf, $fromAjax, $selected = '-1')
 * 2324:     public function setemopopupiLikeDislikeSession($conf)
 * 2379:     private function makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating = array(), $mylikeval, $mydis='', $template, $cid,
			$extpreffortext, $myemoval = 0, $myemoll = '')
 *
 * TOTAL FUNCTIONS: 11
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
class toctoc_comments_ratings extends toctoc_comment_lib {
	/**
	 * Rating functions
	 *
	 *
	 */

	/**
	 * Generates HTML code for displaying ratings.
	 *
	 * @param	string		$ref	Reference
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$pid: storagePid
	 * @param	array		$returnasarray: returned array
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	object		$pObj: parent object
	 * @param	int		$cid: ID of the content element
	 * @return	string		HTML content
	 */
	public function getRatingDisplay($ref, $conf = NULL, $fromAjax = 0, $pid=0, $returnasarray = FALSE, $feuserid = 0, $cmd = 'vote',
			$pObj = NULL, $cid, $fromcomments, $scopeid=0, $isReview = 0, $commentusername = '') {

		// Get template
		if (is_null($conf)) {
			$conf = $this->getDefaultConfig();
		}

		if ($conf['advanced.']['midDot'] != '') {
			$this->middotchar = $conf['advanced.']['midDot'];
		} else {
			$this->middotchar = '&nbsp;';
		}

		if (intval($conf['theme.']['themeVersion']) == 2) {
			$this->middotchar = '';
		}

		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['ratings.']['ratingsTemplateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);

		if (!$fromAjax) {
			// Normal call
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $pObj->conf['ratings.']['ratingsTemplateFile']);
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
			$template = $this->t3fileResource($pObj, $usetemplateFile);

		} else {
			// Called from ajax
			$template = @file_get_contents(PATH_site . $usetemplateFile);
		}

		if (!$template) {
			t3lib_div::devLog('Unable to load template code from "' . $usetemplateFile . '"', 'toctoc_comments', 3);
			return '';
		}

		//catch
		$refarr=explode('-', $ref);
		$countratingarr = count($refarr);
		if($countratingarr>1) {
			$ref=$refarr[0];
		}
		//endcatch

		if (!$fromAjax) {
			$html = $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
					$scopeid, $isReview, $commentusername);
		} else {
			$html = $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
					$scopeid, $isReview, $commentusername);
		}

		$html = $this->getCleanHTML($html);

		return $html;
	}


	/**
	 * Calculates image bar width
	 *
	 * @param	int		$rating	Rating value
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	[type]		$isReview: ...
	 * @return	int
	 */
	public function getBarWidth($rating, $conf, $isReview = 0) {
		if ($isReview == 0) {
			$retstr = intval($conf['ratings.']['ratingImageWidth']*$rating);
		} else {
			$retstr = intval($conf['ratings.']['reviewImageWidth']*$rating);
		}
		return $retstr;
	}

	/**
	 * Upgrade helper for new emolikes based on number on likes and dislikes
	 *
	 * @param	string		$ref	Rating value
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	boolean		$fromAjax: ...
	 * @param	[type]		$fromAjax: ...
	 * @return	int
	 */
	protected function synchLikesWithEmoLikes($pObj, $ref, $conf, $fromAjax) {
		if ($fromAjax == FALSE) {
			// if the ratings.emoLikeSet changes after the have been already made emolikes with another set
			// Then all emolikes are reset
			$myrows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_feuser_mm.emolikeid',
					'tx_toctoc_comments_feuser_mm',
					($tmpint ?
							'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
					' AND tx_toctoc_comments_feuser_mm.reference = "' . $ref . '" AND tx_toctoc_comments_feuser_mm.emolikeid <> "" AND
				tx_toctoc_comments_feuser_mm.emolikeid NOT IN (SELECT tx_toctoc_comments_emolike.uid AS emolikeid
							FROM tx_toctoc_comments_emolike
							WHERE emolike_setfolder = "'.$conf['ratings.']['emoLikeSet'] .'"
							AND tx_toctoc_comments_emolike.deleted = 0)' .
					$this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax),
					'',
					'');
			if (count($myrows) > 0) {
				//reset the emoikeids to ""
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' .
						'tx_toctoc_comments_feuser_mm.emolikeid= "" WHERE (tx_toctoc_comments_feuser_mm.emolikeid <> "" ) AND deleted=0 AND reference= "' . $ref . '"');

			}

			// Preparing migration from simple likes to emolikes. Populating Likes and Dislike-rows with according amolikeids
			$strsql = 'SELECT inx, sum(countemolikes) AS cntemolike, sum(countlikes) AS cntlike
						FROM
						((SELECT 1 as inx, count(tx_toctoc_comments_emolike.uid) AS countemolikes,
						0 as countlikes
						FROM tx_toctoc_comments_emolike, tx_toctoc_comments_feuser_mm
						WHERE emolike_setfolder = "'.$conf['ratings.']['emoLikeSet'] .'"
						AND tx_toctoc_comments_emolike.uid =
						tx_toctoc_comments_feuser_mm.emolikeid
						AND tx_toctoc_comments_emolike.deleted = 0
						AND tx_toctoc_comments_feuser_mm.deleted = 0
						AND emolike_ll = "Like"
						AND tx_toctoc_comments_feuser_mm.reference= "' . $ref . '")
						UNION (SELECT 1 as inx, 0 AS countemolikes,
						sum(ilike) as countlikes
						FROM tx_toctoc_comments_feuser_mm
						WHERE tx_toctoc_comments_feuser_mm.deleted = 0
						AND tx_toctoc_comments_feuser_mm.reference= "' . $ref . '")
						) AS ttbl
						GROUP BY inx';
			$emolikeidlike = 0;
			$emolikeiddislike = 0;
			$result= $GLOBALS['TYPO3_DB']->sql_query($strsql);
			while ($testrows = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
				if ($testrows['cntemolike'] <> $testrows['cntlike']) {
					$strsql='SELECT tx_toctoc_comments_emolike.uid AS emolikeid
							FROM tx_toctoc_comments_emolike
							WHERE emolike_setfolder = "'.$conf['ratings.']['emoLikeSet'] .'"
							AND tx_toctoc_comments_emolike.deleted = 0
							AND emolike_ll = "Like"';
					$resultl= $GLOBALS['TYPO3_DB']->sql_query($strsql);
					while ($likerows = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultl)) {
						$emolikeidlike = $likerows['emolikeid'];
						break;
					}

					$strsql='SELECT tx_toctoc_comments_emolike.uid AS emolikeid
							FROM tx_toctoc_comments_emolike
							WHERE emolike_setfolder = "' . $conf['ratings.']['emoLikeSet'] . '"
							AND tx_toctoc_comments_emolike.deleted = 0
							AND emolike_ll = "DisLike"';
					$resultdl= $GLOBALS['TYPO3_DB']->sql_query($strsql);
					while ($dislikerows = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultdl)) {
						$emolikeiddislike = $dislikerows['emolikeid'];
						break;
					}

				}

				break;
			}

			if ($emolikeidlike != 0) {
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' .
						'emolikeid=' . intval($emolikeidlike) .
						' WHERE ilike=1 AND deleted=0 AND emolikeid="" AND reference= "' . $ref . '"');
			}

			if ($emolikeiddislike != 0) {
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' .
						'emolikeid=' . intval($emolikeiddislike) .
						' WHERE idislike=1 AND deleted=0 AND emolikeid="" AND reference= "' . $ref . '"');
			}

		}

	}
	/**
	 * Renders the emoliketext in the emoresult
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	Array		$rows	$rows containing current emolikes
	 * @param	[type]		$template: ...
	 * @param	[type]		$ref: ...
	 * @param	[type]		$cid: ...
	 * @param	[type]		$myemolikeval: ...
	 * @param	[type]		$feuserid: ...
	 * @param	[type]		$fromAjax: ...
	 * @return	array		Array with two values: emolike report text and total emolike count
	 */
	protected function getSubEmoLikeResultText($conf, $pObj, $template, $ref, $cid, $myemolikeval, $feuserid, $fromAjax) {
		$ret=array();
		$ret[0] = '';
		$ret[1] = '';
		$feusertoquery = 0;
		$fetoctocusertoquery = '';
		$fetoctocusertoinsert = '';
		$strCurrentIP = $this->getCurrentIp();
		if (intval($feuserid) == 0) {
			$fetoctocusertoquery = '"' . $strCurrentIP . '.0' . '"';
			$fetoctocusertoinsert = $strCurrentIP . '.0';
		} else {
			$fetoctocusertoquery = '"0.0.0.0.' . $feuserid . '"';
			$fetoctocusertoinsert = '0.0.0.0.' . $feuserid;
		}

		$userswhere =($tmpint ?
				'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
				' AND tx_toctoc_comments_feuser_mm.pid=tx_toctoc_comments_user.pid AND ' . ($tmpint ?
						'tx_toctoc_comments_user.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_user.pid IN (' . $conf['storagePid'] . ')') .
						' AND tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
		$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery .
		' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' .
		$fetoctocusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = '.$feuserid.'))';
		$userswhere .= ' AND emolikeid > 0 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax);
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'toctoc_commentsfeuser_feuser, current_email, emolikeid, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
							ilike AS usersilike, ipresolved, CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END AS current_firstname,
						    CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END AS current_lastname ',
				'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
				$userswhere,
				'',
				'CASE WHEN CONCAT(CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END,
						CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) = "" THEN 0 ELSE 1 END DESC,
						tx_toctoc_comments_feuser_mm.crdate DESC, (CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) DESC',
				'');
		//print $userswhere;
		$namedcount = $conf['ratings.']['LikeMaxReportLineEntries'];

		$othersmaxcount = $conf['ratings.']['LikeMaxReportTippEntries'];

		$nbrnamed=count($recs);
		$countrecs=count($recs);

		$otherscount=0;
		$likingusersstr=' ';
		$printname='';
		$iothers=0;
		$namedlikearr=array();
		$uchtmlarr=array();
		$mylikehtml='';

		if ($myemolikeval!=0) {
			$nbrnamed=$nbrnamed+1;
		}

		if ($nbrnamed>0) {
			if ($nbrnamed > $namedcount) {
				$nbrnamed=$namedcount;
			}

			$prefix=  $ref;
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($ref, 0, $posbeforeid);
			$mmtable=substr($ref, 0, $posbeforeid-1);
			$refID = substr($ref, $posbeforeid);
			$refID = (799999-$refID)*10;

			// gefaellt das Produkt
			$selectorlikelikes='';
			if ($extpreffortext== 'tx_wecstaffdirectory_pi1') {
				// gefaellt die Person
				$selectorlikelikes='_fem';
			} elseif ($extpreffortext== 'tx_ttnews') {
				// gefallen die News
				$selectorlikelikes='_femplur';

			}

			$lastwithother=1;
			if ($countrecs <= ($namedcount+1)) {
				$lastwithother=0;
			}

			for ($i = 0; $i <= $nbrnamed; $i++) {
				if (($recs[$i]['current_lastname'] != '') && ($i != intval($nbrnamed-$lastwithother))) {
					$printname=$recs[$i]['current_lastname'];
					if ($recs[$i]['current_firstname'] !='') {

						$printname=$recs[$i]['current_firstname'] . ' ' . $printname;

					}

					$pseudocommentid=$refID+$i;
					$uchtml='';

					$templateuclink = $this->t3getSubpart($pObj, $template, '###SHOWUC_SUB###');

					$fontsizeforuc= '100%';
					$lineheightforuc= '109.1%';
					$plachdr = '';
					if ($conf['theme.']['selectedBoxmodelkoogled']==1) {
						$plachdr = '***';
					}

					$uchtml = $this->t3substituteMarkerArray($templateuclink, array(
							'###COMMENT_ID###' => $pseudocommentid,
							'###FONTSIZE###'=> $fontsizeforuc,
							'###LINEHEIGHT###'=> $lineheightforuc,
							'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
							'###PCEHDRPIC###' => $plachdr,
					));

					$timeout= intval($conf['timeoutUC']);
					if ($timeout < 3) {
						$timeout=3;
					} elseif ($timeout > 15) {
						$timeout=15;
					}

					$timeout= 1000*$timeout;

					$templateuclink = $this->t3getSubpart($pObj, $template, '###SHOWUCLINK_SUB###');

					$pictureuser= $recs[$i]['toctoc_commentsfeuser_feuser'];
					$fetoctocusertoquery ='"0.0.0.0.' . $recs[$i]['toctoc_commentsfeuser_feuser'] . '"';
					$fetoctocusertomarker ='0.0.0.0.' . $recs[$i]['toctoc_commentsfeuser_feuser'];
					if ($pictureuser==0) {
						//check if female
						$fetoctocusertoquery ='"' . $recs[$i]['tc_ct_user'] . '"';
						$fetoctocusertomarker =$recs[$i]['tc_ct_user'];

						$rowsgender = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('gender',
								'tx_toctoc_comments_comments',
								'toctoc_comments_user = ' . $fetoctocusertoquery,
								'',
								'uid DESC',
								1);
						if (count($rowsgender)>0) {
							if ($rowsgender[0]['gender']==1) {
								$pictureuser=99999;
							}

						}

					}

					$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
							'',
							'',
							'uid DESC',
							1 );
					$usergenderexistsstr='';
					if (count($rowsfeuser)>0) {
						if (array_key_exists('gender', $rowsfeuser[0])) {
							$usergenderexistsstr=' fe_users.gender AS gender, ';
						}

					}

					if (!$fromAjax) {
						$this->build_AJAXImages($conf, $pObj, $usergenderexistsstr, $fromAjax);
					} else {
						if (count($_SESSION['AJAXimages']) != 0 ) {
							$this->AJAXimages = $_SESSION['AJAXimages'];
							$this->gravatarimages = $_SESSION['gravatarimages'];
							$this->AJAXimagesCache = $_SESSION['AJAXOrigimages'];								
						}

					}

					if ($recs[$i]['toctoc_commentsfeuser_feuser'] != 0) {
						$pictureuserfromAjax = $this->getAJAXimage($recs[$i]['toctoc_commentsfeuser_feuser'], $pseudocommentid, $conf, $recs[$i]['current_email']);
					} else {
						$pictureuserfromAjax = $this->getAJAXimage($pictureuser, $pseudocommentid, $conf);
						$pictureuserfromAjaxwrkarr=explode('title="', $pictureuserfromAjax);
						if (count($pictureuserfromAjaxwrkarr)>1) {
							$pictureuserfromAjaxwrkarr2=explode('" ', $pictureuserfromAjaxwrkarr[1]);
							$pictureuserfromAjax=$pictureuserfromAjaxwrkarr[0] . 'title="' . $printname . '" ' . $pictureuserfromAjaxwrkarr2[1];
						} else {
							$pictureuserfromAjax=str_replace(' tx-tc-nodisp', '', $pictureuserfromAjax);
							$pictureuserfromAjax=str_replace('">', '" title="' . $pictureuserfromAjax . '">', $pictureuserfromAjax);
						}
					}

					$uchtmlarr[$i]=trim($uchtml);

					$printname='<a class="tx-tc-picclasslink" id="tx-tc-nameclasslink__'.$pseudocommentid.'__'.
							$cid.'__'.base64_encode($fetoctocusertomarker).'__'.base64_encode($pictureuserfromAjax).
							'__'.$timeout.'" rel="nofollow" href="javascript:void(0)">' . $printname . '</a>, ';

				} else {
					$iothers=$i;
					if ($likingusersstr != '') {
						$otherscount=$countrecs-$i;
					} else {
						$otherscount=$countrecs;
					}
					if ($i==0) {
						$nbrinterpunkt='';
					}

					break;
				}

				$likingusersstr .= $printname;

				$namedlikearr[$i]['name']=$printname;
				$namedlikearr[$i]['tcuser']=$recs[$i]['toctoc_comments_user'];
			}

			$others ='';
			$otherscountp=0;
			if (trim($likingusersstr) == '') {
				$otherscount=$countrecs;
				$otherscountp=1;
			}

			if ($otherscount>0) {
				$otheruserarray=array();
				$i=0;
				$overmax=0;
				$cntilkeusers=count($recs);
				for ($j = (count($recs)-$otherscount); $j < $cntilkeusers; $j++) {

					if (trim($recs[$j]['current_lastname']) !='') {
						$printname=$recs[$j]['current_lastname'];
						if ($recs[$j]['current_firstname'] !='') {
							$printname=$recs[$j]['current_firstname'] . ' ' . $printname;
						}

					} else {
						if ($conf['ratings.']['useIPsInLikeDislike'] == 1) {
							$printname=$recs[$j]['ipresolved'];
						} else {
							$printname = '';
						}

					}

					if (($i < $othersmaxcount) && ($printname != '')) {
						$otheruserarray[$i]=$printname;
						$i++;
						$iovermax=$i;
					} else {
						$overmax++;
						if ($overmax==1) {
							$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otheruser', $fromAjax);

						} else {
							$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otherusers', $fromAjax);
						}

						$i++;
					}

				}

				if ($otherscount==1) {
					$another=$this->pi_getLLWrap($pObj, 'api_ilike_einanderer', $fromAjax);
					if ((count($namedlikearr)>0) || ($myemolikeval>0)) {
						$others .= $another;
					} else {
						$anotherarr = explode(' ', $another);
						$anotherarr[0]=ucwords($anotherarr[0]);
						$another = implode(' ', $anotherarr);
						$others .= $another;
					}

				} else {
					$others .= $otherscount . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otherusers', $fromAjax);
				}

				$others ='<span class="tx-tc-oth" id="tx-tc-oth-' . $ref . '"><span class="tx-tc-othertitle tx-tc-otheremouserstitle tx-tc-textlink" id="tx-tc-othertitle-' .
						$ref . '__' . $cid . '" title="' . implode('<br />', $otheruserarray) . '">' . $others . '</span></span>';

			} else {
				if (strpos($likingusersstr, ', ') > 0) {
					$likingusersarr = explode(', ', $likingusersstr);
					$lastnameduser = trim($likingusersarr[(count($likingusersarr)-1)]);
					$strlastlen = strlen($lastnameduser);
					$likingusersstr = substr($likingusersstr, 0, (strlen($likingusersstr)-$strlastlen-2));
					$likingusersarr=explode(', ', $likingusersstr);
					if (count($likingusersarr) > 1) {
						$lastnameduser = trim($likingusersarr[(count($likingusersarr)-1)]);
						$strlastlen = strlen($lastnameduser);
						$likingusersstr = substr($likingusersstr, 0, (strlen($likingusersstr)-$strlastlen-2)) . ' ' .
								$this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) .
								' ' . $lastnameduser;
					}

				}

			}

			if ($otherscount==0) {
				$others='';
			}

			if ($myemolikeval==0) {
				if ($nbrnamed<=1) {
					if ($otherscount==0) {
						$mylikehtml=$likingusersstr . implode($uchtmlarr);
					} else {
						if (trim($likingusersstr) !='') {
							$mylikehtml=trim($likingusersstr . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ' . $others . implode($uchtmlarr));
						} else{
							$mylikehtml=$others . implode($uchtmlarr);

						}

					}

				} else {
					if ($otherscount==0) {
						$mylikehtml=$likingusersstr . implode($uchtmlarr);
					} else {
						$likingusersarr=explode(', ', $likingusersstr);
						$lastnameduser=trim($likingusersarr[(count($likingusersarr)-1)]);
						$strlastlen=strlen($lastnameduser);
						$likingusersstr = substr($likingusersstr, 0, (strlen($likingusersstr)-$strlastlen-2));
						if (trim($likingusersstr) !='') {
							$mylikehtml=$likingusersstr . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ' . $others . implode($uchtmlarr);
						} else {
							$mylikehtml=$others . implode($uchtmlarr);
						}
					}

				}

			} else {
				$countrecs = $countrecs + 1;
				if ($nbrnamed <= 1) {
					$mylikehtml = $this->pi_getLLWrap($pObj, 'api_ilike_du', $fromAjax) . implode($uchtmlarr);
				} else {
					if ($otherscount==0) {
						if (trim($likingusersstr) =='') {
							$mylikehtml = $this->pi_getLLWrap($pObj, 'api_ilike_du', $fromAjax) . implode($uchtmlarr);
						} else {
							$mylikehtml = $this->pi_getLLWrap($pObj, 'api_ilike_du', $fromAjax)  . ' ' .
									$this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ' .  $likingusersstr . implode($uchtmlarr);
						}

					} else {
						if (trim($likingusersstr) == '') {
							$mylikehtml = $this->pi_getLLWrap($pObj, 'api_ilike_du', $fromAjax)  . ' ' .
									$this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ' . $others . implode($uchtmlarr);
						} else {
							if (substr($likingusersstr, (strlen($likingusersstr)-2)) == ', ') {
								$likingusersarr=explode(', ', $likingusersstr);
								$likingusersstr = substr($likingusersstr, 0, (strlen($likingusersstr)-2));
							}

							$mylikehtml = $this->pi_getLLWrap($pObj, 'api_ilike_du', $fromAjax) . ', ' . $likingusersstr  . ' ' .
									$this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) .  ' ' . $others . implode($uchtmlarr);

						}

					}

				}

			}

			$ret[0] = $mylikehtml;
			$ret[1] = $countrecs;
			if ($countrecs==0) {
				$ret[1] = '';
			}

		}

		return $ret;

	}
	/**
	 * Renders the emolikeicons in the emoresult
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	Array		$rows	$rows containing current emolikes
	 * @param	[type]		$template: ...
	 * @param	[type]		$ref: ...
	 * @param	[type]		$rows: ...
	 * @param	[type]		$myemolikeval: ...
	 * @param	[type]		$fromAjax: ...
	 * @return	string		Array with two values: rating and count, which is calculated rating value and number of votes respectively
	 */
	protected function getSubEmoLikeResultIcons($conf, $pObj, $template, $ref, $rows, $myemolikeval, $fromAjax) {
		//###SUBEMORESLTICON###

		$maxtippentries = $conf['ratings.']['emoLikeMaxTippEntries'];

		$ret = '';
		$templateemolike = $this->t3getSubpart($pObj, $template, '###SUBEMORESLTICON###');

		$hasmyemolikeval = 0;
		if ($myemolikeval != 0) {
			$hasmyemolikeval = 1;
		}

		$allothersemocount = 0;
		foreach ($rows['allemorecs'] as $emorec) {
			$allothersemocount = $allothersemocount+$emorec['sumemolike'];
		}

		$allothersemocount = $allothersemocount-$hasmyemolikeval;

		$countemoarr = count($rows['allemorecs']);
		$countallemoarr = count($rows['ilikeemousers']);

		for ($i=0;$i<$countemoarr;$i++) {

			$emonbrusers = 0;
			$otheremos=array();
			$oe = 0;
			$others = 0;
			$tippentries = 0;
			$hasmyemolikeselval = 0;

			if ($myemolikeval == $rows['allemorecs'][$i]['emolike_uid']) {
				$hasmyemolikeselval = 1;
				$otheremos[$oe] = $this->pi_getLLWrap($pObj, 'api_ilike_du', $fromAjax);
				$oe++;
			}

			$emotipptext='<b>' . $rows['allemorecs'][$i]['sumemolike'] . ' ' .
					$this->pi_getLLWrap($pObj, 'api_ilike_topline_oneunlike'. $rows['allemorecs'][$i]['emolike_ll'], $fromAjax) . '</b><br />';
			for ($m=0;$m<$countallemoarr;$m++) {
				if ($rows['allemorecs'][$i]['emolike_uid'] == $rows['ilikeemousers'][$m]['emolikeid']) {
					if ($tippentries < $maxtippentries) {
						if (trim($rows['ilikeemousers'][$m]['current_lastname']) !='') {
							$printname=$rows['ilikeemousers'][$m]['current_lastname'];
							if ($rows['ilikeemousers'][$m]['current_firstname'] !='') {
								$printname=$rows['ilikeemousers'][$m]['current_firstname'] . ' ' . $printname;
							}

						} else {
							if ($conf['ratings.']['useIPsInLikeDislike'] == 1) {
								$printname=$rows['ilikeemousers'][$m]['ipresolved'];
							} else {
								$printname = '';
								$others++;
							}

						}
						if ($printname != '') {
							$otheremos[$oe] = $printname;
							$oe++;
							$tippentries++;
						}
					} else {
						$others++;
					}

				}

			}

			if ($others == 1) {
				$otheremos[$oe] = '1 ' . $this->pi_getLLWrap($pObj, 'api_ilike_otheruser', $fromAjax);
			} elseif ($others > 1) {
				$otheremos[$oe] = $others . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otherusers', $fromAjax);
			}

			$emotipptext .= implode('<br />', $otheremos);
			$emomarkers = array(
					'###REF###' => $ref,
					'###SORT###' => $rows['allemorecs'][$i]['emolike_sort'],
					'###TIPPTEXTNBRUSERSEMO###' => $emotipptext,
					'###SUBEMORESLTICONS###' => $rows['allemorecs'][$i]['sumemolike'],
					'###NBRUSERSEMO###' => $emonbrusers,
			);
			$ret .= $this->t3substituteMarkerArray($templateemolike, $emomarkers);
		}

		return $ret;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$myemoval: ...
	 * @return	[type]		...
	 */
	protected function getEmoTextColorLL($myemoval) {
		$ret = '';

		$where ='uid = ' . $myemoval . '';
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, emolike_ll',
				'tx_toctoc_comments_emolike',
				$where,
				'',
				'',
				'');
		if (count($rows)>0) {
			// main template processing
			foreach($rows as $row) {
				if (($row['emolike_ll'] != 'Like') && ($row['emolike_ll'] != 'Dislike')){
					$ret = $row['emolike_ll'];

				}
			}
		}

		return $ret;
	}
	/**
	 * Fetches rating information for $ref
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	object		$pObj: parent object
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	[type]		$scopeid: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$isReview: ...
	 * @param	[type]		$fromcomments: ...
	 * @param	[type]		$reviewfeuserid: ...
	 * @return	array		Array with two values: rating and count, which is calculated rating value and number of votes respectively
	 */
	protected function getRatingInfo($ref, $pObj, $feuserid=-1, $conf, $scopeid=0, $fromAjax, $isReview = 0, $fromcomments = 0, $reviewfeuserid = 0) {
		if ($scopeid!=0) {
			$scopeidtxt= ' AND reference_scope=' . $scopeid . ' ';
			$scopeidtxtfeuser_mm= ' AND tx_toctoc_comments_feuser_mm.reference_scope=' . $scopeid . ' ';
		} else {
			$scopeidtxt= ' AND (reference_scope=0) ';
			$scopeidtxtfeuser_mm= ' AND (tx_toctoc_comments_feuser_mm.reference_scope=0) ';
		}
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}
		if ($feuserid != -1) {
			$feusertoquery = 0;
			$fetoctocusertoquery = '';
			$fetoctocusertoinsert = '';
			$strCurrentIP = $this->getCurrentIp();
			if (intval($feuserid) == 0) {
				$fetoctocusertoquery = '"' . $strCurrentIP . '.0' . '"';
				$fetoctocusertoinsert = $strCurrentIP . '.0';
			} else {
				$fetoctocusertoquery = '"0.0.0.0.' . $feuserid . '"';
				$fetoctocusertoinsert = '0.0.0.0.' . $feuserid;
				$feusertoquery =  intval($feuserid);
			}

			$recs['myrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('myrating AS myrating, ilike AS ilike, idislike AS idislike , emolikeid AS myemolike ',
					'tx_toctoc_comments_feuser_mm',
					($tmpint ?
							'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') . ' AND ((toctoc_commentsfeuser_feuser = ' . $feusertoquery .
					' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
					$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' .
					$scopeidtxtfeuser_mm . ' AND reference="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));

			$recs['myrecs'] = (count($recs) ? $recs['myrecs'] : array('myrating' => 0, 'ilike' => 0, 'idislike' => 0, 'myemolike' => 0));

			if (($isReview == 1) && ($fromcomments == 0) && ($feuserid == 0)) {
				$recs['myrecs'] = array('myrating' => 0, 'ilike' => 0, 'idislike' => 0, 'myemolike' => 0);
			}

		}
		$feusertoquery =  intval($feuserid);

		if ($feuserid == -1) {
			if (($isReview == 0) || ($fromcomments == 0)) {
				$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('rating,vote_count',
						'tx_toctoc_ratings_data',
						($tmpint ?
								'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
						$scopeidtxt . ' AND reference=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($ref, 'tx_toctoc_ratings_data') .
						$this->enableFields('tx_toctoc_ratings_data', $pObj, $fromAjax));
				$retstr = (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));

			} else {
				$feusertoquery =0;
				$fetoctocusertoquery ='';
				$fetoctocusertoinsert='';
				$strCurrentIP = $this->getCurrentIp();
				if (intval($reviewfeuserid) == 0) {
					$fetoctocusertoquery ='"' . $strCurrentIP . '.0' . '"';
					$fetoctocusertoinsert = $strCurrentIP . '.0';
				} else {
					$fetoctocusertoquery ='"0.0.0.0.' . $reviewfeuserid . '"';
					$fetoctocusertoinsert ='0.0.0.0.' . $reviewfeuserid;
				}

				$feusertoquery =  intval($reviewfeuserid);
				$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('myrating AS rating, 1 AS vote_count',
						'tx_toctoc_comments_feuser_mm',
						($tmpint ?
								'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') . ' AND ((toctoc_commentsfeuser_feuser = ' . $feusertoquery .
						' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
						$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' .
						$scopeidtxtfeuser_mm . ' AND reference="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));
				$retstr = (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));
				if (count($recs) >0) {
					if (($recs[0]['rating'] == 0) && ($recs[0]['vote_count'] == 1)) {
						$recs[0]['vote_count'] = 0;
					}

				}

				$retstr = (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));

			}

			return $retstr;
		} else {

			$recs['allrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(ilike) AS totalilikes, SUM(idislike) AS totalidislikes ',
					'tx_toctoc_comments_feuser_mm',
					($tmpint ?
							'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') . ' AND reference="' . $ref . '"'.
					$scopeidtxtfeuser_mm . $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));

			$commentidcandidate=str_replace('tx_toctoc_comments_comments_', '', $ref);
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($commentidcandidate);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($commentidcandidate);
			}

			if ($tmpint) {
				$commentidcandidate=intval($commentidcandidate);

				$recs['comment'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('crdate AS commentdate, uid as commentuid, firstname as commentfirstname, lastname as commentlastname',
						'tx_toctoc_comments_comments',
						($tmpint ?
								'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
						' AND uid=' . $commentidcandidate . $this->enableFields('tx_toctoc_comments_comments', $pObj, $fromAjax));
				if ($conf['advanced.']['showCountCommentViews'] ==1){
					$recs['commentviews'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(seen) AS commentviews',
							'tx_toctoc_comments_feuser_mm',
							($tmpint ?
									'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
							' AND seen>0 AND reference="tx_toctoc_comments_comments_' . $commentidcandidate . '" '.
							$this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));
				} else {
					$recs['commentviews'] = array(
							'commentviews' => 0, );
				}

			} else {
				$recs['comment'] = array(
						'commentdate' => 0,
						'commentlastname' => '',
						'commentfirstname' => '',
						'commentuid' => 0,);
				$recs['commentviews'] = array(
						'commentviews' => 0, );
				if ($conf['ratings.']['emoLike'] ==1) {
					//toplike with emolikes
					$this->synchLikesWithEmoLikes($pObj, $ref, $conf, $fromAjax);

					$recs['allemorecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(tx_toctoc_comments_feuser_mm.emolikeid) AS sumemolike,
						tx_toctoc_comments_emolike.uid AS emolike_uid, tx_toctoc_comments_emolike.emolike_ll As emolike_ll, tx_toctoc_comments_emolike.emolike_sort As emolike_sort',
							'tx_toctoc_comments_emolike, tx_toctoc_comments_feuser_mm',
							($tmpint ?
									'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
							' AND tx_toctoc_comments_feuser_mm.emolikeid = tx_toctoc_comments_emolike.uid AND tx_toctoc_comments_feuser_mm.reference = "' . $ref . '"'.
							$this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax),
							'tx_toctoc_comments_emolike.emolike_sort, tx_toctoc_comments_emolike.uid, tx_toctoc_comments_emolike.emolike_ll',
							'sumemolike DESC,tx_toctoc_comments_emolike.emolike_sort, tx_toctoc_comments_emolike.uid');
				}
			}

			$recs['ilikeusers'] = array();
			if (($recs['allrecs'][0]['totalilikes']>1) || (($recs['allrecs'][0]['totalilikes']>0) && ($recs['myrecs'][0]['ilike']==0))) {
				$userswhere =($tmpint ?
						'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
						' AND tx_toctoc_comments_feuser_mm.pid=tx_toctoc_comments_user.pid AND ' . ($tmpint ?
								'tx_toctoc_comments_user.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_user.pid IN (' . $conf['storagePid'] . ')') .
								' AND tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
				$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery .
				' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' .
				$fetoctocusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
				$userswhere .=$scopeidtxtfeuser_mm . ' AND ilike = 1 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax);
				$recs['ilikeusers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'toctoc_commentsfeuser_feuser, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
						ilike AS usersilike, ipresolved, CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END AS current_firstname,
					    CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END AS current_lastname ',
						'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
						$userswhere,
						'',
						'CASE WHEN CONCAT(CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END,
					CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) = "" THEN 0 ELSE 1 END DESC,
					tx_toctoc_comments_feuser_mm.crdate DESC, (CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) DESC',
						'');
			}

			if ($recs['allemorecs']) {
				//toplike with emolikes
				$recs['ilikeemousers'] = array();
				if (count($recs['allemorecs'])>0) {
					$userswhere =($tmpint ?
							'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
							' AND tx_toctoc_comments_feuser_mm.pid=tx_toctoc_comments_user.pid AND ' . ($tmpint ?
									'tx_toctoc_comments_user.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_user.pid IN (' . $conf['storagePid'] . ')') .
									' AND tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
					$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery .
					' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' .
					$fetoctocusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
					$userswhere .= ' AND emolikeid > 0 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax);
					$recs['ilikeemousers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'toctoc_commentsfeuser_feuser, emolikeid, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
							ilike AS usersilike, ipresolved, CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END AS current_firstname,
						    CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END AS current_lastname ',
							'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
							$userswhere,
							'',
							'emolikeid, CASE WHEN CONCAT(CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END,
						CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) = "" THEN 0 ELSE 1 END DESC,
						tx_toctoc_comments_feuser_mm.crdate DESC, (CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) DESC',
							'');
				}
			}

			$recs['idislikeusers'] = array();
			if (($recs['allrecs'][0]['totalidislikes']>1) || (($recs['allrecs'][0]['totalidislikes']>0) && ($recs['myrecs'][0]['idislike']==0))) {
				$userswhere =($tmpint ?
						'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
						' AND tx_toctoc_comments_feuser_mm.pid=tx_toctoc_comments_user.pid AND ' . ($tmpint ?
								'tx_toctoc_comments_user.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_user.pid IN (' . $conf['storagePid'] . ')') .
								' AND tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
				$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery .
				' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' . $fetoctocusertoquery .
				' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
				$userswhere .= $scopeidtxtfeuser_mm . ' AND idislike = 1 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax);
				$recs['idislikeusers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'toctoc_commentsfeuser_feuser, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
						ilike AS usersilike, ipresolved, CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END AS current_firstname,
					    CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END AS current_lastname ',
						'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
						$userswhere,
						'',
						'CASE WHEN CONCAT(CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END, CASE WHEN current_lastname =""
					THEN initial_lastname ELSE current_lastname END) = "" THEN 0 ELSE 1 END DESC, tx_toctoc_comments_feuser_mm.crdate DESC,
					CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END DESC',
						'');
			}

			return $recs;
		}

	}

	/**
	 * Generates array with rating content for given $ref using $template HTML template
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	string		$template	HTML template to use
	 * @param	array		$conf: Plugin configuration array
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$pid: storagePid
	 * @param	boolean		$returnasarray: if the output should be an array
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	object		$pObj: parent object
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	int		$cid: ID of the content element
	 * @param	boolean		$fromcomments: if its a request coming from comments()
	 * @param	[type]		$scopeid: ...
	 * @return	string		conditionally also an arraywith the rating content
	 */
	protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
	$scopeid = 0, $isReview = 0, $commentusername = '') {

		// inits
		$siteRelPath = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments');
		$refforvote=$ref;
		if($scopeid!=0) {
			$refforvote=$ref.'-'.$scopeid;
		}

		if (($fromAjax)) {
			$language = &$GLOBALS['LANG'];
			$languagecode = $GLOBALS['LANG']->lang;
		} else {
			$language = t3lib_div::makeInstance('language');
			$language->init($GLOBALS['TSFE']->lang);
			$languagecode = $GLOBALS['TSFE']->lang;
		}

		/*@var $language language */

		$contentarr=array();
		$myrating = array();
		$refforvote = $ref;
		if($scopeid != 0) {
			$refforvote = $ref . '-' . $scopeid;
		}

		// get the ratings
		$this->trackdebug('ratings.getRatingInfo_rating');

		$rating = $this->getRatingInfo($ref, $pObj, -1, $conf, $scopeid, $fromAjax, $isReview, $fromcomments, $feuserid);
		$this->trackdebug('ratings.getRatingInfo_rating');
		$this->trackdebug('ratings.getRatingInfo_myrating');

		$myrating = $this->getRatingInfo($ref, $pObj, $feuserid, $conf, $scopeid, $fromAjax, $isReview, $fromcomments, $feuserid);

		$savereviewconfratingsmode = $conf['ratings.']['mode'];
		$savereviewconfratingsdisableIpCheck = $conf['ratings.']['disableIpCheck'];
		$savuseLikeDislike = $conf['ratings.']['useLikeDislike'];
		$savuseDislike = $conf['ratings.']['useDislike'];

		$this->trackdebug('ratings.getRatingInfo_myrating');
		$this->trackdebug('ratings.generateRatingContent');
		$classvotebar = 'tx-tc-rts-vote-bar';
		$hidelikeilikecss = '';
		if ((($isReview != 0) && ($fromcomments == 0) && ($feuserid == 0)) || (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic'))) {
			$hidelikeilikecss = ' tx-tc-nodisp';
		}
		if (($cmd=='vote') || ($cmd=='votearticle')) {
			$this->trackdebug('ratings.generateRatingContent.vote');
			// for the votes get the texts and mix with values :-)
			if (($isReview != 0) && ($fromcomments == 0) && ($feuserid == $_SESSION['feuserid']) && ($feuserid > 0)) {
				if (!isset($conf['ratings.']['modeusercenter'])) {
					$conf['ratings.']['mode'] = 'auto';
					$conf['ratings.']['disableIpCheck'] = 1;
				}

			}

			if ($rating['vote_count'] > 0) {
				$rating_value = $rating['rating']/$rating['vote_count'];
				if (round($rating['vote_count'], 0) == 1) {
					if ($isReview == 0) {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.vote', $fromAjax);
					} else {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.review', $fromAjax);
					}

				} else {
					if ($isReview == 0) {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.votes', $fromAjax);
					} else {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.reviews', $fromAjax);
					}

				}

				if (intval($conf['ratings.']['useNumberOfVotes']) == 1) {
					if ($cmd=='votearticle') {
						$votetext = ' (' . round($rating['vote_count'], 0) . ' ' . $votetext . ')';
					} else {
						$votetext = ' (' . round($rating['vote_count'], 0) . ' ' . $votetext . ')';
					}

				}

				else {
					$votetext ='';
				}

				if (intval($conf['ratings.']['useNumberOfStars']) == 1) {
					$rating_str = sprintf($this->pi_getLLWrap($pObj, 'api_rating', $fromAjax), $rating_value, $conf['ratings.']['maxValue'], '') . $votetext;
				} else {
					if (intval($conf['ratings.']['useAvgOfVotes']) == 1) {
						$rating_str = round($rating_value, 1) . $votetext;
					} else {
						$rating_str = trim($votetext);
					}

				}

			} else {
				$rating_value = 0;
				if ($isReview == 0) {

					$rating_str = $this->pi_getLLWrap($pObj, 'api_not_rated', $fromAjax);
				} else {
					if (($isReview == 1) && ($fromcomments == 1)) {
						$rating_str = '';
						if ($scopeid == 0) {
							if (($feuserid != $_SESSION['feuserid']) || ($feuserid == 0)){
								$rating_str = $this->pi_getLLWrap($pObj, 'api_not_yetreviewedby', $fromAjax) . ' ' . $commentusername;
							}
						}

					} else {
						if ($feuserid == $_SESSION['feuserid']) {
							$rating_str = '';
						} else {
							$rating_str = $this->pi_getLLWrap($pObj, 'api_not_reviewed', $fromAjax);
						}

					}
				}

			}

			// get the template
			if ((($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) ||
					(($conf['ratings.']['disableIpCheck'] == 0) && $this->isVoted($ref, $pObj, $scopeid, $feuserid, $fromAjax))) {
				$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_RATING###');
				$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_STATIC###');

				$voteSub = $this->t3getSubpart($pObj, $template, '###VOTE_LINK_SUB_OVERALLVOTE###');

			} else {
				$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_RATING###');
				$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_STATIC###');
				if (!$conf['ratings.']['modeplus']) {
					$conf['ratings.']['modeplus']=$conf['ratings.']['mode'];
				}

				if ($conf['ratings.']['modeplus'] == 'autostatic') {
					// for overall-votes with overall votes disabled
					$voteSub = $this->t3getSubpart($pObj, $template, '###VOTE_LINK_SUB_OVERALLVOTE###');
				} else {
					$voteSub = $this->t3getSubpart($pObj, $template, '###VOTE_LINK_SUB###');

				}

			}

			// Make ajaxData
			if ($fromAjax == TRUE) {
				if ($fromcomments) {
					$ajaxData = $this->AjaxData;
				} else {
					$ajaxData = $this->getAjaxData($feuserid, $pid, $conf, $cid, $ref);
				}

			} else {
				$ajaxData = $this->getAjaxData($feuserid, $pid, $conf, $cid, $ref);
			}

			// Create links
			$links = '';
			$stepping=1;
			$steppingarr=array();
			$start=1;
			$gap=intval($conf['ratings.']['maxValue'])-intval($conf['ratings.']['minValue']);
			if (($gap>10) || (intval($conf['ratings.']['minValue'])>1)) {
				// no tips stepping to big or minvalue > 1
				$start=-1;
			} elseif  ($gap==10) {

				$stepping='1,1,1,1,1,1,1,1,1,1';
			} elseif  ($gap==9) {

				$stepping='1,1,1,2,1,1,1,1,1';
			} elseif  ($gap==8) {

				$stepping='1,1,1,2,1,1,1,2';
			} elseif  ($gap==7) {

				$stepping='2,2,1,2,1,1,1';
			} elseif  ($gap==6) {

				$stepping='2,2,1,2,2,1';
			} elseif  ($gap==5) {

				$stepping='2,3,2,2,1';
			} elseif  ($gap==4) {

				$stepping='2,3,2,3';
			} elseif  ($gap==3) {

				$stepping='5,2,3';
			} elseif  ($gap==2) {

				$stepping='5,5';
			} elseif  ($gap==1) {

				$stepping='10';
			} elseif  ($gap==0) {

				$stepping='0';
				$start=6;
			}

			$steppingarr=explode(',', $stepping);
			$nextstep=$start;
			for ($i = $conf['ratings.']['minValue']; $i <= $conf['ratings.']['maxValue']; $i++) {
				$refforvote=$ref;
				if($scopeid!=0) {
					$refforvote=$ref.'-'.$scopeid;
				}

				$check = $this->getcheck($refforvote, $i, TRUE);
				$apiratingtip='';
				If ($start!=-1) {

					$apiratingtip=$this->pi_getLLWrap($pObj, 'api_tipstar_' . $nextstep, $fromAjax);
					$nextstep= $nextstep+$steppingarr[($i-intval($conf['ratings.']['minValue']))];
				}

				$links .= $this->t3substituteMarkerArray($voteSub, array(
						'###VALUE###' => $i,
						'###REF###' => $refforvote,
						'###PID###' => $pid,
						'###CID###' => $cid,
						'###APIRATINGTIP###' => $apiratingtip,
						'###CHECK###' => $check,
						'###SITE_REL_PATH###' => $siteRelPath,
				));
			}

			$commentdateSub = $this->t3getSubpart($pObj, $template, '###COMMENT_DATE_SUB###');

			$commentdatehtml ='';
			$txtviews='';

			$jscommentviewcounter='';

			if ($myrating['comment'][0]['commentdate']) {

				$commentcontinuation='';
				if (intval($conf['ratings.']['enableRatings']) ==1 ) {
					$commentcontinuation='&nbsp;' . $this->middotchar . '&nbsp;';
				}

				if (intval($conf['advanced.']['countCommentViews']) ==1 ) {
					$jscommentviewcounter='<span class="tx-tc-cmtvcntr tx-tc-nodisp" id="tx-tc-cmtvcntr__'. 'tx_toctoc_comments_comments_'.
							$myrating['comment'][0]['commentuid'] .
							'__'. $_SESSION['feuserid'] . '__'. $cid . '__1__' . $conf['storagePid'] .'"></span>';
				}

				if (intval($conf['advanced.']['showCountCommentViews']) ==1 ) {
					if ($myrating['commentviews'][0]['commentviews'] > 0) {
						if ($myrating['commentviews'][0]['commentviews']==1) {
							if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.view', $fromAjax);
							} else {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewlong', $fromAjax);
							}

						} else {
							if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.views', $fromAjax);
							} else {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewslong', $fromAjax);
							}

						}

						$txtviews= '<span class="tx-tc-commentviews">&nbsp;' . $myrating['commentviews'][0]['commentviews'] . ' ' .
								$strviews. $commentcontinuation. '</span>';
						$commentcontinuation='';
					}

				}
				if (intval($conf['ratings.']['dontUseCommentdate']) ==0) {
					$commentdatehtml = $this->t3substituteMarkerArray($commentdateSub, array(
							'###COMMENT_DATE###' => $this->formatDate($myrating['comment'][0]['commentdate'], $pObj, $fromAjax, $conf). $commentcontinuation,
							'###COMMENTID###' => $myrating['comment'][0]['commentuid'],
							'###COMMENT_TIMESTAMP###' => $myrating['comment'][0]['commentdate'],
							'###STYLECOMMENT###' => '',
							'###COMMENTVIEWS###' => $txtviews . $jscommentviewcounter,
					));
				}
			}

			$this->trackdebug('ratings.generateRatingContent.vote');
		} else {
			// for all other cmd get the templates for the topline-ratings (other ratings templates follow later)
			$this->trackdebug('ratings.generateRatingContent.rating');
			if ($fromAjax == TRUE) {
				if ($fromcomments) {
					$ajaxData = $this->AjaxData;
				} else {
					$ajaxData = $this->getAjaxData($feuserid, $pid, $conf, $cid, $refforvote);
				}

			} else {
				$ajaxData = $this->getAjaxData($feuserid, $pid, $conf, $cid, $refforvote);
			}

			if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
					$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
				} else {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}

			} else {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
					$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
				} else {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}

			}

			$this->trackdebug('ratings.generateRatingContent.rating');
		}

		// Init the vars containing values ready for print
		$this->trackdebug('ratings.generateRatingContent.dislike');
		$mydislikeval = intval($myrating['myrecs'][0]['idislike']);
		$mylikeval = intval($myrating['myrecs'][0]['ilike']);
		$myemoval = intval($myrating['myrecs'][0]['myemolike']);

		$myemoll = '';
		$cssemo='';

		if ($myemoval != 0) {
			$tretarr = $this->getEmoTextColorLL($myemoval);
			if ($tretarr!=''){
				$cssemo= ' tx-tc-emo-button tx-tc-emo-' . strtolower($tretarr);

				$myemoll =$tretarr;
			}
		}

		$idemo ='';

		// '', just setting up session values $_SESSION['emo(Dis)Like'] before it's to late...
		$idemomrk =	$this->setemopopupiLikeDislikeSession($conf);

		if (($conf['ratings.']['emoLike'] ==1) && (str_replace('tx_toctoc_comments_comments_', '', $refforvote) == $refforvote)) {
			$idemo = $_SESSION['emoLike'];

			if (intval($myemoval) != 0) {
				$idemo = $myemoval;
			}

			$idemomrk = '__' . $idemo;
		}

		$sumdislikevalstr = '&nbsp;' . $myrating['allrecs'][0]['totalidislikes'];
		if (intval($myrating['allrecs'][0]['totalidislikes']) === 0) {
			$sumdislikevalstr = '';
		}

		$sumlikevalstr= '&nbsp;' . $myrating['allrecs'][0]['totalilikes'];
		if (intval($myrating['allrecs'][0]['totalilikes']) === 0) {
			$sumlikevalstr = '';
		}

		$myrating_str = '';

		if (($conf['ratings.']['useLikeDislike'] == 1) && ($conf['ratings.']['useDislike'] == 1)) {
			if (is_array($_SESSION['dislikeditem'])) {
				if ($_SESSION['dislikeditem']['ref'] == $ref) {
					if ($conf['ratings.']['dlikeCtsNotifLvl']==$myrating['allrecs'][0]['totalidislikes']) {
						// need to send notification
						$newUid=intval(str_replace('tx_toctoc_comments_comments_', '', $ref));
						// only if idislike on comment
						if ($newUid>0) {
							$sendnotif=TRUE;
							if (is_array($_SESSION['ndislikeditem'])) {
								if ($_SESSION['ndislikeditem']['time' . $ref]>0) {
									//an email has already been sent
									$conf_idletime = $conf['ratings.']['dlikeCtsNotifIdlTime'];
									$conf_idletime =(time() - ($conf_idletime *60));
									if ($conf_idletime-$_SESSION['ndislikeditem']['time' . $ref]<0) {
										$sendnotif=FALSE;
									}

								}

							}

							if ($sendnotif==TRUE) {
								$this->sendNotificationEmail($newUid, 0, FALSE, 'rating', $conf, $pObj, $fromAjax,
										$piVars, $pid, $_SESSION['dislikeditem']['toctoc_user'], 0, 0, '', $_SESSION['dislikeditem']['pageid'], $languagecode);
								$_SESSION['ndislikeditem']['time' . $ref]=time();
							}

						}

					}

					unset($_SESSION['dislikeditem']);
				}

			}

		}

		// here we determine the text to display in the topline, if it's a rating on News, Products normal Content Element or other records...

		$extpreffortext = 'pages';
		if ((trim($conf['externalPrefix'])=='tt_products') || (trim($conf['externalPrefix']) == 'tx_commerce_pi1')) {
			$extpreffortext ='tt_products';
		} elseif  ((trim($conf['externalPrefix'])=='tx_wecstaffdirectory_pi1')) {
			$extpreffortext ='tx_wecstaffdirectory_pi1';
		} elseif  ((trim($conf['externalPrefix'])=='tx_rouge')) {
			$extpreffortext ='tx_rouge';
		} elseif  ((trim($conf['externalPrefix'])=='tx_album3x_pi1')) {
			$extpreffortext ='tx_album3x_pi1';
		} elseif   ((trim($conf['externalPrefix'])=='tx_mininews_pi1') || (trim($conf['externalPrefix'])=='tx_ttnews') ||
				(trim($conf['externalPrefix'])=='tx_news_pi1')) {
			$extpreffortext ='tx_ttnews';
		}

		//Setting up idislike zone
		$retarr=$this->makeiLikeText($conf, $pObj, $cmd, $refforvote, $fromAjax, $myrating, $mydislikeval, 'dis', $template, $cid,
				$extpreffortext, 0, '', '');

		$mydislike=$retarr[0];
		$mydislikehtml=$retarr[1];
		$mydislikehtmlnv=$retarr[2];
		$mydislikepic=$retarr[3];
		$mydislikepicalkt=$retarr[4];
		$this->trackdebug('ratings.generateRatingContent.dislike');

		// same processing for iLike
		$this->trackdebug('ratings.generateRatingContent.like');

		$retarr=$this->makeiLikeText($conf, $pObj, $cmd, $refforvote, $fromAjax, $myrating, $mylikeval, '', $template, $cid,
				$extpreffortext, $myemoval, $myemoll);

		$mylike=$retarr[0];
		$mylikehtml=$retarr[1];
		$mylikehtmlnv=$retarr[2];
		$mylikepic=$retarr[3];
		$mylikepicalkt=$retarr[4];

		$this->trackdebug('ratings.generateRatingContent.like');

		$this->trackdebug('ratings.generateRatingContent.markers');

		// selecting the template

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		} else {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_LINK_SUB###');
		}

		if ($mydislikeval == 1 ) {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		// make the HTML for the iLike-Picture

		$i=-1*($mylikeval-1);

		if (($conf['ratings.']['emoLike'] ==1) && (str_replace('tx_toctoc_comments_comments_', '', $refforvote) == $refforvote)) {
			$check = $this->getcheck($refforvote, $idemo, TRUE);
		} else {
			$check = $this->getcheck($refforvote, $i, TRUE);
		}

		$mypiclikehtmlSub =  $this->t3substituteMarkerArray($mypiclikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mylike,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => '',
				'###CSSEMO###' => $cssemo,
				'###IDEMO###' => $idemomrk,
		));
		$mylikestatic='';
		if (($conf['ratings.']['useLikeDislikeStyle']==1) || ((intval($conf['ratings.']['useShortTopLikes']) == 1) && ($cmd=='votearticle')))  {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
			$mypiclikehtmlstaticSub =  $this->t3substituteMarkerArray($mypiclikeSub, array(
					'###VALUE###' => $i,
					'###REF###' => $refforvote,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###CHECK###' => $check,
					'###CONTENT###' => $mylike,
					'###CONTENTADDCSS###' => '',
					'###SITE_REL_PATH###' => $siteRelPath,
					'###TITLE###' => '',
			));
			$mylikestatic=$mypiclikehtmlstaticSub;
		}

		$mylike=$mypiclikehtmlSub;

		// selecting the same template again for the text version of the ilike link and the topline-ilke link (the one without number of votes)

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		} else {
			$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_LINK_SUB###');
		}

		if ($mydislikeval == 1 ) {
			$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		if (($conf['ratings.']['emoLike'] ==1) && (str_replace('tx_toctoc_comments_comments_', '', $refforvote) == $refforvote)) {
			$check = $this->getcheck($refforvote, $idemo, TRUE);
		} else {
			$check = $this->getcheck($refforvote, $i, TRUE);
		}

		$mylikehtmlSub =  $this->t3substituteMarkerArray($mylikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mylikehtmlnv,
				'###CONTENTADDCSS###' => $hidelikeilikecss,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mylikepicalkt .'"',
				'###CSSEMO###' => $cssemo,
				'###IDEMO###' => $idemomrk,
		));
		$mylikehtmlnv=$mylikehtmlSub;
		$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		$mylikehtmlSub = $this->t3substituteMarkerArray($mylikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mylikehtml,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mylikepicalkt .'"',

		));
		$mylikehtml=$mylikehtmlSub;
		// dont show topline ilike pic when not iLiked by any one

		if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
			if ((intval($myrating['allrecs'][0]['totalilikes']) == 0) && (intval($conf['ratings.']['useShortTopLikes']) == 0)) {
				$mylike= '';
				$mylikestatic='';
				$mylikehtml='';
			}

		}

		$idemo ='';
		$idemomrk ='';
		if (($conf['ratings.']['emoLike'] ==1) && (str_replace('tx_toctoc_comments_comments_', '', $refforvote) == $refforvote)) {
			$idemo = $_SESSION['emoDislike'];
			if (intval($myemoval) != 0) {
				$idemo = $myemoval;
			}
			$idemomrk = '__' . $idemo;
		}

		$mydislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		$i=-1*($mydislikeval-1);

		if (($conf['ratings.']['emoLike'] ==1) && (str_replace('tx_toctoc_comments_comments_', '', $refforvote) == $refforvote)) {
			$check = $this->getcheck($refforvote, $idemo, TRUE);
		} else {
			$check = $this->getcheck($refforvote, $i, TRUE);
		}

		$mydislikehtmlSub =  $this->t3substituteMarkerArray($mydislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislikehtml,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mydislikepicalkt .'"',
		));

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mydislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		} else {
			$mydislikeSub = $this->t3getSubpart($pObj, $template, '###IDISLIKE_LINK_SUB###');
		}

		if ($mylikeval == 1 ) {
			$mydislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		$mydislikehtml=$mydislikehtmlSub;
		$mydislikehtmlSub =  $this->t3substituteMarkerArray($mydislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislikehtmlnv,
				'###CONTENTADDCSS###' => $hidelikeilikecss,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mydislikepicalkt .'"',
				'###IDEMO###' => $idemomrk,
		));
		$mydislikehtmlnv=$mydislikehtmlSub;

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		} else {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###IDISLIKE_LINK_SUB###');
		}

		// now, now now, static isn't the only reason to go static.
		// the other reason is that user has made iLike, so IDislike is only activ after he unlikes it.
		if ($mylikeval == 1 ) {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}
		if (($conf['ratings.']['emoLike'] ==1) && (str_replace('tx_toctoc_comments_comments_', '', $refforvote) == $refforvote)) {
			$check = $this->getcheck($refforvote, $idemo, TRUE);
		} else {
			$check = $this->getcheck($refforvote, $i, TRUE);
		}

		$mypicdislikehtmlSub =  $this->t3substituteMarkerArray($mypicdislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislike,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => '',
				'###IDEMO###' => $idemomrk,
		));
		$mydislikestatic='';
		if (($conf['ratings.']['useLikeDislikeStyle']==1) || ((intval($conf['ratings.']['useShortTopLikes']) == 1) && ($cmd=='votearticle')))  {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
			$mypicdislikehtmlstaticSub =  $this->t3substituteMarkerArray($mypicdislikeSub, array(
					'###VALUE###' => $i,
					'###REF###' => $refforvote,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###CHECK###' => $check,
					'###CONTENT###' => $mydislike,
					'###CONTENTADDCSS###' => $hidelikeilikecss,
					'###SITE_REL_PATH###' => $siteRelPath,
					'###TITLE###' => '',
			));
			$mydislikestatic=$mypicdislikehtmlstaticSub;
		}

		$mydislike=$mypicdislikehtmlSub;

		// dont show topline ilike pic when not iLiked by any one

		if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
			if ((intval($myrating['allrecs'][0]['totalidislikes'])===0) && (intval($conf['ratings.']['useShortTopLikes']) == 0)){
				$mydislike= '';
				$mydislikehtml='';
				$mydislikestatic='';
			}

		}

		// get the "your rating" part

		$myrating_value=round($myrating['myrecs'][0]['myrating'], 1);
		$myrating_intvalue=round($myrating['myrecs'][0]['myrating'], 0);
		$myratingtext = '';
		if ($myrating_value==0) {
			$myrating_left = 0;
			$myrating_width = 0;
		} else {
			$myrating_left = intval($myrating_intvalue*intval($conf['ratings.']['ratingImageWidth']) -intval($conf['ratings.']['ratingImageWidth']));
			$myrating_width = intval($conf['ratings.']['ratingImageWidth']);
			if ($isReview == 0) {
				$myratingtext = $this->pi_getLLWrap($pObj, 'api_yourrating', $fromAjax) . ' ' . $myrating_value;
			} else {

				$myrating_left = intval(round($myrating_intvalue, 0)*intval($conf['ratings.']['reviewImageWidth']) - intval($conf['ratings.']['reviewImageWidth']));
				$myrating_width = intval($conf['ratings.']['reviewImageWidth']);
				if (($feuserid > 0) && (intval($fromcomments) == 0)) {
					$myratingtext = $this->pi_getLLWrap($pObj, 'api_yourreview', $fromAjax) . ' ' . $myrating_value;
				} else {
					$myratingtext = '';
					if (($feuserid == $_SESSION['feuserid']) && ($feuserid != 0)) {
						$myratingtext = '';
					} else {
						if (intval($scopeid) == 0) {
							if ($commentusername == '') {
								$commentusername= $this->getUserName($feuserid, $pObj, $fromAjax, $conf);
							}

							if ($commentusername != '') {
								$myratingtext = $this->pi_getLLWrap($pObj, 'api_rating.reviewby', $fromAjax) . ' ' . $commentusername . ': ' . $myrating_value;
								if ($rating_str != '') {
									$rating_str = '';
								}

							}

						} else {
							$myratingtext = ucfirst($this->pi_getLLWrap($pObj, 'api_rating.review', $fromAjax)) . ': ' . $myrating_value;
						}

					}

				}

			}

		}

		// considering options and resetting the HTML-fragments if needed (I admit this could be done in parts before...)
		$middottop  = '&nbsp;' . $this->middotchar . '&nbsp;';

		if ($conf['ratings.']['useLikeDislikeStyle']==1) {

			if (substr($ref, 0, 6) != 'tx_toc') {
				$middot=$middottop;
			}

		} else {
			$middot = '&nbsp;' . $this->middotchar . '&nbsp;';
		}

		if (intval($conf['ratings.']['useShortTopLikes']) == 1) {
			if (substr($ref, 0, 6) != 'tx_toc') {
				$middot = '';
				$middottop = '';
			}

		}

		if (intval($conf['ratings.']['useLikeDislike'] ) != 1) {
			$mylikehtml = '';
			$mylikehtmlnv = '';
			$mydislikehtml = '';
			$mydislikestatic = '';
			$mydislikehtmlnv = '';
			$mylike ='';
			$mylikestatic = '';
			$mydislike ='';
		} else {
			// for top line adding the continuations
			if (intval($conf['ratings.']['useDislike']) != 1) {
				$mydislikehtml = '';
				$mydislikestatic = '';
				$mydislikehtmlnv = '';
				$mydislike ='';
				if ($cmd == 'liketop') {
					if (($mylikehtml !='') || ($conf['ratings.']['useVotes']==1) || ($conf['sharing.']['useSharing']==1) ||
							(($conf['sharing.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0) && ($conf['ratings.']['ratingsOnly']==0))) {
						$mylikehtmlnv .= $middottop . '&nbsp;';
					}

					$mylikehtml .= $middottop . '&nbsp;';
				}

			} else {
				if ($cmd=='votearticle') {
					$middot=$middottop;
				}

				if ($mylikehtml !='') {
					if ($mydislikehtml !='') {
						$mylikehtml .= $middot . '';
					}

				}

				if ($mydislikeval==0) {
					if ($mylikeval==0) {
						$mylikehtmlnv .= $middot . '';
					} else {
						$mylikehtmlnv .= $middot . '&nbsp;';
					}

				} else {
					$mylikehtmlnv .= $middot . '';
				}

				if (strpos($cmd, 'top')!==FALSE) {
					if (($mydislikehtml !='') || ($conf['ratings.']['useVotes']==1) || ($conf['sharing.']['useSharing']==1) ||
							(($conf['sharing.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0) && ($conf['ratings.']['ratingsOnly']==0))) {
						$mydislikehtmlnv .= $middot . '&nbsp;';
					}

					$mydislikehtml .= $middot . '&nbsp;';
				}

			}

		}

		// considering values and resetting the HTML-fragments if needed (Again, I admit this could be done in parts before...)
		if ($mydislikeval==0) {
			if ($mylikeval!=0) {
				$mydislikehtmlnv= '';
			}

		}

		if ($mylikeval==0) {
			if ($mydislikeval!=0) {
				$mylikehtmlnv= '';
			}

		}

		// cleaning out voting HTML-fragments if options require

		if (intval($conf['ratings.']['useMyVote'] ) !== 1) {
			$myratingtext= '';
			$myrating_width = 0;
			$myrating_left=0;
		}

		$strhidevote = '';

		// preparing strings needed in CSS for hideing of elements
		if (intval($conf['ratings.']['useVotes'])==0) {
			$strhidevote = '-hide';
		}

		if ((intval($conf['ratings.']['useTopVotes']) == 0 ) && ($cmd == 'votearticle')) {
			$strhidevote = '-hide';
		}

		$hidecss ='';

		// We won't print out the $*htmlout if there's no pic to show
		$mylikehtmlout=$mylikehtml;
		if ($mylike=='') {
			$mylikehtmlout='';
		}

		$mydislikehtmlout=$mydislikehtml;
		if ($mydislike=='') {
			$mydislikehtmlout='';
		}

		// preparing the entire rating area
		$brforfirstscope='';
		if ($scopeid==0) {
			$prefix=  $ref;
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($ref, 0, $posbeforeid);
			$brforfirstscope='';
			if ($prefix != 'tx_toctoc_comments_comments_') {
				$cntsess=count($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']]);
			}

		}

		$areamarkers = array(
				'###MYILIKE###' => $mylike,
				'###MYIDISLIKE###' => $mydislike,
				'###MYILIKETEXT###' => $mylikehtmlout,
				'###MYIDISLIKETEXT###' => $mydislikehtmlout,
				'###REF###' => htmlspecialchars($refforvote),
				'###BRFORFIRSTSCOPE###' => $brforfirstscope,
		);

		$areamarkersstatic = array();
		if ($conf['ratings.']['useLikeDislikeStyle']==1) {
			if ($cmd!='votearticle') {
				$areamarkers = array(
						'###MYILIKE###' => $mylike,
						'###MYIDISLIKE###' => $mydislike,
						'###MYILIKETEXT###' => $mylikehtmlout,
						'###MYIDISLIKETEXT###' => $mydislikehtmlout,
						'###REF###' => htmlspecialchars($refforvote),
						'###BRFORFIRSTSCOPE###' => $brforfirstscope,
				);
			}

		}

		if (intval($conf['ratings.']['useShortTopLikes']) == 1) {
			if ($cmd=='votearticle') {
				$areamarkers = array(
						'###MYILIKE###' => $mylike,
						'###MYIDISLIKE###' => $mydislike,
						'###MYILIKETEXT###' => $mylikehtmlout,
						'###MYIDISLIKETEXT###' => $mydislikehtmlout,
						'###REF###' => htmlspecialchars($refforvote),
						'###BRFORFIRSTSCOPE###' => $brforfirstscope,
				);
			}

		}
		$strhidevoteplus = '';
		if ($conf['advanced.']['commentReview']==1) {
			$strhidevoteplus = ' tx-tc-yourreview';
		}

		$mylikestaticareahtml= '';
		if ((intval($conf['ratings.']['useTopLikeDislike']) == 0 ) && ($cmd == 'votearticle')) {
			$mylikeareahtml= '';

		} else {
			$mylikeareahtml= $this->t3substituteMarkerArray($subTemplateMyILikeArea, $areamarkers);
		}

		// preparing output for
		// 1. ilikes or votings, iLikes are subclassed into topline-1st/topline-2nd or  Comment line
		// 2. the enitre area (pi1-calls)
		if (strpos($cmd, 'like')!==FALSE) {
			// iLikes/idislikes

			if (strpos($cmd, 'liketop')!==FALSE) {

				// top line
				// the 2nd top line
				if (intval($conf['ratings.']['useTopLikeDislike']) == 1 ) {

					$mylikehtml = str_replace('\'like\',', '\'liketop\',', $mylikehtml );
					$mydislikehtml = str_replace('\'unlike\',', '\'unliketop\',', $mydislikehtml );
					$mylikehtml = str_replace('\'myratings\'', '\'myratingstop\'', $mylikehtml );
					$mydislikehtml = str_replace('\'myratings\'', '\'myratingstop\'', $mydislikehtml );
					// the 1st top line
					$mylikehtmlnv = str_replace('\'like\',', '\'liketop\',', $mylikehtmlnv );
					$mydislikehtmlnv = str_replace('\'unlike\',', '\'unliketop\',', $mydislikehtmlnv );
					$mylikehtmlnv = str_replace('\'myratings\'', '\'myratingstop\'', $mylikehtmlnv );
					$mydislikehtmlnv = str_replace('\'myratings\'', '\'myratingstop\'', $mydislikehtmlnv );
				} else {
					$mylikehtml = '';
					$mydislikehtml = '';
					$mylikehtml = '';
					$mydislikehtml = '';
					$mylikehtmlnv = '';
					$mydislikehtmlnv = '';
					$mylikehtmlnv = '';
					$mydislikehtmlnv = '';
				}

			}

			if ((($cmd=== 'like') || ($cmd=== 'unlike')) == FALSE) {
				$mylikehtml=$mylikehtmlnv;
				$mydislikehtml=$mydislikehtmlnv;
			}

			if ($conf['ratings.']['emoLike'] != 0) {
				$outtemplateemolike = $this->emopopup($pObj, $template, $hidecss, $cid, htmlspecialchars($refforvote), $conf, $fromAjax, $myemoval);
			} else {
				$outtemplateemolike = '';
			}

			$markers = array(
					'###EMOPOPUP###' => $outtemplateemolike,
					'###PID###' => $pid,
					'###HIDECSS###'=> $hidecss,
					'###CID###' => $cid,
					'###REF###' => htmlspecialchars($refforvote),
					'###SITE_REL_PATH###' => $siteRelPath,
					'###MYILIKE_AREA###' => $mylikeareahtml,
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
			);
		} else {
			$hidecss ='';
			$emomarkers = array(
					'###REF###' => htmlspecialchars($refforvote),
			);
			$markers = array(
					'###HIDECSS###'=> $hidecss,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###HIDEVOTEMYRATING###' => $strhidevote . $strhidevoteplus,
					'###HIDEVOTE###' => $strhidevote,
					'###REF###' => htmlspecialchars($refforvote),
					'###TEXT_SUBMITTING###' => $this->pi_getLLWrap($pObj, 'api_submitting', $fromAjax),
					'###TEXT_ALREADY_RATED###' => $this->pi_getLLWrap($pObj, 'api_already_rated', $fromAjax),
					'###BAR_WIDTH###' => $this->getBarWidth($rating_value, $conf, $isReview),
					'###CLASSVOTEBARREVIEW###' => $classvotebar,
					'###COMMENT_DATE###' => $commentdatehtml,
					'###RATING###' => $rating_str,
					'###TEXT_RATING_TIP###' => $this->pi_getLLWrap($pObj, 'api_tip', $fromAjax),
					'###SITE_REL_PATH###' => $siteRelPath,
					'###VOTE_LINKS###' => $links,
					'###MYRATING###' => $myratingtext,
					'###MYILIKE_AREA###' => $mylikeareahtml,
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
					'###MYBAR_WIDTH###' => $myrating_width,
					'###MYBAR_LEFT###'=> $myrating_left,
			);
		}

		// we will output either an array or a string
		// (pi1: array)
		if (intval($conf['ratings.']['enableRatings']) === 1 ) {
			if ((intval($conf['ratings.']['emoLike']) == 1) && ($scopeid == 0)
					&& ($conf['ratings.']['useShortTopLikes'] == 0) && ($conf['ratings.']['useTopLikeDislike'] == 1))  {
				if (($cmd=='votearticle') ||
						(($cmd=='likeemo') && (substr($ref, 0, 6) != 'tx_toc')) ||
						(($cmd=='vote') && (substr($ref, 0, 6) != 'tx_toc')) ||
						(($cmd=='unlikeemo') && (substr($ref, 0, 6) != 'tx_toc'))) {

					$subemolikericons = $this->getSubEmoLikeResultIcons($conf, $pObj, $template, htmlspecialchars($refforvote), $myrating, $myemoval, $fromAjax);
					$subemolikearr = array();
					$subemolikearr = $this->getSubEmoLikeResultText($conf, $pObj, $template, htmlspecialchars($refforvote), $cid, $myemoval, $feuserid, $fromAjax);

					$templateemolike = $this->t3getSubpart($pObj, $template, '###SUBEMORESLT###');
					$outemolikeov='';
					if ($subemolikearr[0] != '') {
						$templateemolikeov = $this->t3getSubpart($pObj, $template, '###SHOWEMOUSERS_SUB###');
						$emolikeovmarkers = array(
								'###CID###' => $cid,
								'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
						);
						$outemolikeov=$contentarr['voteemo']= $this->t3substituteMarkerArray($templateemolikeov, $emolikeovmarkers);

					}

					$emomarkers = array(
							'###REF###' => htmlspecialchars($refforvote),
							'###TOTALNBRUSERS###' => $subemolikearr[1],
							'###CID###' => $cid,
							'###TOTALUSERSTEXT###' => $subemolikearr[0],
							'###EMOOVERVIEW###' => $outemolikeov,
							'###TIPPTEXTWHOREACTED###' => $this->pi_getLLWrap($pObj, 'pi1_template.emolike.whoreacted', $fromAjax),
							'###SUBEMORESLTICONS###' => $subemolikericons,
					);

					$markers['###EMOPOPUP###'] = '';
					$markers['###COMMENT_DATE###'] = '';
					$markers['###MYILIKE_AREA###'] = '';
					$markers['###MYILIKE###'] = '';
					$markers['###MYIDISLIKE###'] = '';
					$markers['###MYILIKETEXT###'] = '';
					$markers['###MYIDISLIKETEXT###'] = '';

					$outemolike=$this->t3substituteMarkerArray($templateemolike, $emomarkers);
					if (($cmd!='unlikeemo') && ($cmd!='likeemo')) {
						$contentarr['voteing']= '<div style="width: 100%;" ></div>' . $this->t3substituteMarkerArray($subTemplate, $markers);
					}

					$outemolike.=$contentarr['voteing'];
					$contentarr['voteing']='';
					$contentarr['voteemo']= $outemolike;

				} else {
					$contentarr['voteing']= $this->t3substituteMarkerArray($subTemplate, $markers);
				}

			} else {
				$contentarr['voteing']= $this->t3substituteMarkerArray($subTemplate, $markers);
			}

		} else {
			$contentarr['voteing']='';
		}

		$contentarr['idislike']='';
		$contentarr['ilike']='';
		$contentarr['myvote']='';
		$contentarr['mylikehtml']='';
		$contentarr['mydislikehtml']='';
		if ($mydislikeval==0) {
			if ($mylikeval!=0) {
				$mydislikehtmlnv= '';
			}

		}

		if ($mylikeval==0) {
			if ($mydislikeval!=0) {
				$mylikehtmlnv= '';
			}

		}

		if ((intval($conf['ratings.']['useLikeDislike'] ) === 1) && (intval($conf['ratings.']['useTopLikeDislike']) == 1)) {
			$contentarr['mylikehtml']=$mylikehtml;
			$contentarr['ilike']=$mylikehtmlnv;
			if (intval($conf['ratings.']['useDislike']) === 1) {
				$contentarr['idislike']=$mydislikehtmlnv;
				$contentarr['mydislikehtml']=$mydislikehtml;
			}

		}

		if (intval($conf['ratings.']['useMyVote']) ===1 ) {
			$contentarr['myvote']=$myrating_left . ',' . $myrating_width;
		}

		$this->trackdebug('ratings.generateRatingContent.markers');
		$this->trackdebug('ratings.generateRatingContent');

		$conf['ratings.']['mode'] = $savereviewconfratingsmode;
		$conf['ratings.']['disableIpCheck'] = $savereviewconfratingsdisableIpCheck;

		if (($isReview != 0) && ($feuserid > 0) && ($fromcomments == 1) && ($feuserid == $_SESSION['feuserid'])) {
			$contentarr['voteing']='';
		}

		$contentarr['myemolikeval']=intval($myemoval);

		if ($contentarr['voteemo']) {
			$contentarr['voteing']=$contentarr['voteemo'];
		}

		if ($returnasarray) {
			return $contentarr;
		} else {
			$contentarr['voteing']=str_replace('<div class="tx-tc-rts-container">',
					'<div id="tx-tc-tipemo-2-'.htmlspecialchars($refforvote).'" class="tx-tc-rts-container tx-tc-tipemo-2">', $contentarr['voteing']);
			if ($conf['ratings.']['useLikeDislikeStyle']==1) {
				if (substr($ref, 0, 6) == 'tx_toc') {
					$contentarr['voteing']='<div class="tx-tc-overrating">' .
							str_replace('<div id="tx-tc-rts-dp-tx_toctoc_comments_comments',
									'</div></div><div class="tx-tc-overrating-date"><div id="tx-tc-rts-dp-tx_toctoc_comments_comments', $contentarr['voteing'] );
				} else {
					if ((intval($conf['ratings.']['useShortTopLikes']) == 1) || (intval($conf['ratings.']['useLikeDislikeStyle']) == 1)) {
						$repl='/id="tx-tc-myrts-dp-'.$ref.'-(\d)" class="tx-tc-rts-li/';
						$replw='id="tx-tc-myrts-dp-'.$ref.'-$1" class="tx-tc-rts-li tx-tc-nodisp';

						$wrkareaHTML=str_replace('id="tx-tc-myrtstop-'.$ref.'" class="tx-tc-rts-area', 'id="tx-tc-myrtstop-'.$ref.
								'" class="tx-tc-rts-area tx-tc-nodisp', $contentarr['voteing']);
						$topareaHTML=preg_replace($repl, $replw, $wrkareaHTML);

						$repl='/id="tx-tc-myrts-'.$ref.'-(\d)" class="tx-tc-rts-area/';
						$replw='id="tx-tc-myrts-'.$ref.'-$1" class="tx-tc-rts-area tx-tc-nodisp';
						$contentarr['voteing']=preg_replace($repl, $replw, $topareaHTML);

					}
				}

			}

			return $contentarr['voteing'];
		}

	}
	/**
	 * Renders the emolike popup.
	 *
	 * @param	object		$pObj: ...
	 * @param	string		$template: ...
	 * @param	string		$hidecss: ...
	 * @param	string		$cid: ...
	 * @param	string		$refforvote: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$selected: ...
	 * @return	string		$outtemplateemolike
	 */
	public function emopopup($pObj, $template, $hidecss,$cid,$refforvote, $conf, $fromAjax, $selected = '-1') {
		// emo meta selection
		$where ='emolike_setfolder = "' . $conf['ratings.']['emoLikeSet'] . '" AND deleted=0';

		if (intval($conf['ratings.']['useDislike']) == 0) {
			$where .= ' AND emolike_ll != "Dislike"';
		}
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, emolike_ll,emolike_sort',
				'tx_toctoc_comments_emolike',
				$where,
				'',
				'emolike_sort',
				'');
		$subtemplateicons = '';
		if (count($rows)>0) {
			// main template processing
			$templateemolikeicon = $this->t3getSubpart($pObj, $template, '###SUBEMOPOPUPICON###');
			$sortplus =0;
			$sortnr = 1;

			foreach($rows as $row) {
				$check = $this->getcheck($refforvote, $row['uid'], TRUE);
				if ($row['uid'] == intval($selected)) {
					$rowselected = 1;
					$rowcssselemo = ' actemo';
					$tipaction= '';
				} else {
					$rowselected = -1;
					$rowcssselemo = '';
					$tipaction= '';
				}

				if ($row['emolike_ll'] == 'Like') {
					//###CID###__###CHECK###" class="tx-tc-emlp-im-###SORT### tx-tc-emlp-il2"></i>

					if (intval($conf['ratings.']['useLikeDislike']) != 0) {
					$_SESSION['emoLike'] = $row['uid'];
							$markersemoicon = array(
									'###EMOTITLE###'=> $tipaction . $this->pi_getLLWrap($pObj, 'api_ilike_topline_oneunlike'.$row['emolike_ll'], $fromAjax),
									'###EMOTABINDEX###' => $rowselected,
									'###SORT###' => 1,
									'###EMOUID###' => $row['uid'],
									'###CSSSELEMO###' => $rowcssselemo,
									'###CID###' => $cid,
									'###CHECK###' => $check,
									'###CSSDLIKE###' => '',
							);
							$sortplus = 0;
					} else {
						$sortplus = -1;
					}
				} elseif ($row['emolike_ll'] == 'Dislike') {
					if (intval($conf['ratings.']['useDislike']) != 0) {
						$markersemoicon = array(
								'###EMOTITLE###'=> $tipaction . $this->pi_getLLWrap($pObj, 'api_ilike_topline_oneunlike'.$row['emolike_ll'], $fromAjax),
								'###EMOTABINDEX###' => $rowselected,
								'###SORT###' => 7 + $sortplus,
								'###EMOUID###' => $row['uid'],
								'###CSSSELEMO###' => $rowcssselemo,
								'###CID###' => $cid,
								'###CHECK###' => $check,
								'###CSSDLIKE###' => ' tx-tc-emodislike',
						);
						$_SESSION['emoDislike'] = $row['uid'];

					}
				} else {
					$sortnr = $sortnr +1;
					$markersemoicon = array(
							'###EMOTITLE###'=> $tipaction . $this->pi_getLLWrap($pObj, 'api_ilike_topline_oneunlike'.$row['emolike_ll'], $fromAjax),
							'###EMOTABINDEX###' => $rowselected,
							'###SORT###' => $sortnr + $sortplus,
							'###EMOUID###' => $row['uid'],
							'###CSSSELEMO###' => $rowcssselemo,
							'###CID###' => $cid,
							'###CHECK###' => $check,
							'###CSSDLIKE###' => '',
					);

				}
				$subtemplateicons .= $this->t3substituteMarkerArray($templateemolikeicon, $markersemoicon);
			}

		}

		// sub template processing

		// main template processing
		$templateemolike = $this->t3getSubpart($pObj, $template, '###SUBEMOPOPUP###');
		$markersemo = array(
				'###HIDECSS###'=> $hidecss,
				'###CID###' => $cid,
				'###REF###' => $refforvote,
				'###SUBEMOICONS###' => $subtemplateicons,
		);
		$outtemplateemolike = $this->t3substituteMarkerArray($templateemolike, $markersemo);
		return $outtemplateemolike;

	}

	/**
	 * Renders the emolike popup.
	 *
	 * @param	object		$pObj: ...
	 * @param	string		$template: ...
	 * @param	string		$hidecss: ...
	 * @param	string		$cid: ...
	 * @param	string		$refforvote: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$selected: ...
	 * @return	string		$outtemplateemolike
	 */
	public function setemopopupiLikeDislikeSession($conf) {
		// emo meta selection
		if ((intval($conf['ratings.']['useLikeDislike']) != 0)) {
			$where ='emolike_setfolder = "' . $conf['ratings.']['emoLikeSet'] . '" AND deleted=0';

			if (intval($conf['ratings.']['useDislike']) == 0) {
				$where .= ' AND emolike_ll != "Dislike"';
			}

			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, emolike_ll,emolike_sort',
					'tx_toctoc_comments_emolike',
					$where,
					'',
					'emolike_sort',
					'');
			$_SESSION['emoLike']=-1;
			$_SESSION['emoDislike']=-1;
			if (count($rows)>0) {
				// main template processing
				foreach($rows as $row) {
					if ($row['emolike_ll'] == 'Like') {
						if (intval($conf['ratings.']['useLikeDislike']) != 0) {
							$_SESSION['emoLike'] = $row['uid'];
						}
					} elseif ($row['emolike_ll'] == 'Dislike') {
						if (intval($conf['ratings.']['useDislike']) != 0) {
							$_SESSION['emoDislike'] = $row['uid'];

						}
					}
				}

			}
		}
		return '';

	}


	/**
	 * Makes text for iLike or idislike.
	 *
	 * @param	array		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$cmd: ...
	 * @param	[type]		$ref: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$myrating: ...
	 * @param	[type]		$mylikeval: ...
	 * @param	[type]		$mydis: ...
	 * @param	[type]		$template: ...
	 * @param	[type]		$cid: ...
	 * @param	[type]		$extpreffortext: ...
	 * @return	array		$retarr:[0]=$mylike;[1]=$mylikehtml;[2]=$mylikehtmlnv;[3]=$mylikepic;
	 */
	private function makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating = array(), $mylikeval, $mydis='', $template, $cid,
			$extpreffortext, $myemoval = 0, $myemoll = '') {
		// same processing for iLike and iDislike
		$namedcount = $conf['ratings.']['LikeMaxReportLineEntries'];
		$useUn = 'un';
		if (intval($conf['ratings.']['likeTextWithUn']) == 0) {
			if ($myemoll == '') {
				$useUn = '';
			}

		}

		$othersmaxcount = $conf['ratings.']['LikeMaxReportTippEntries'];
		if ((trim($conf['theme.']['themeVersion']) == '2') && ($conf['theme.']['selectedBoxmodelkoogled']!=1)) {
			$this->addv2 = 'v2';
		}

		$nbrnamed = $myrating['allrecs'][0]['totali' . $mydis . 'likes'];
		if (($myemoval != 0) && (intval($conf['ratings.']['emoLike']) == 1) && (intval($conf['ratings.']['useLikeDislikeStyle']) == 0) &&
				(trim($conf['ratings.']['emoLikeSet']) != '')) {
			$mylikeval = 1;
		}

		$otherscount=0;
		$likingusersstr=' ';
		$printname='';
		$iothers=0;
		$namedlikearr=array();
		$uchtmlarr=array();
		if ($nbrnamed>0) {
			$nbrinterpunkt=' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ';
			if ($nbrnamed>0) {
				$nbrinterpunkt=', ';
			}

			if ($nbrnamed > $namedcount) {
				$nbrnamed=$namedcount;
			}

			$prefix=  $ref;
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($ref, 0, $posbeforeid);
			$mmtable=substr($ref, 0, $posbeforeid-1);
			$refID = substr($ref, $posbeforeid);
			if ($mydis=='') {
				$refID = (999999-$refID)*10;
			} else {
				$refID = (899999-$refID)*10;
			}

			// gefaellt das Produkt
			$selectorlikelikes='';
			if ($extpreffortext== 'tx_wecstaffdirectory_pi1') {
				// gefaellt die Person
				$selectorlikelikes='_fem';
			} elseif ($extpreffortext== 'tx_ttnews') {
				// gefallen die News
				$selectorlikelikes='_femplur';

			}

			for ($i = 0; $i < $nbrnamed; $i++) {
				if ($myrating['i' . $mydis . 'likeusers'][$i]['current_lastname'] !='') {
					$printname=$myrating['i' . $mydis . 'likeusers'][$i]['current_lastname'];
					if ($myrating['i' . $mydis . 'likeusers'][$i]['current_firstname'] !='') {

						$printname=$myrating['i' . $mydis . 'likeusers'][$i]['current_firstname'] . ' ' . $printname;

					}

					$pseudocommentid=$refID+$i;
					$uchtml='';

					$templateuclink = $this->t3getSubpart($pObj, $template, '###SHOWUC_SUB###');

					$fontsizeforuc= '100%';
					$lineheightforuc= '109.1%';
					if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
						$fontsizeforuc= '90.9%';
						$lineheightforuc= '109.1%';
					}

					$plachdr = '';
					if ($conf['theme.']['selectedBoxmodelkoogled']==1) {
						$plachdr = '***';
					}

					$uchtml =  $this->t3substituteMarkerArray($templateuclink, array(
							'###COMMENT_ID###' => $pseudocommentid,
							'###FONTSIZE###'=> $fontsizeforuc,
							'###LINEHEIGHT###'=> $lineheightforuc,
							'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
							'###PCEHDRPIC###' => $plachdr,
					));

					$timeout= intval($conf['timeoutUC']);
					if ($timeout < 3) {
						$timeout=3;
					} elseif ($timeout > 15) {
						$timeout=15;
					}

					$timeout= 1000*$timeout;

					$templateuclink = $this->t3getSubpart($pObj, $template, '###SHOWUCLINK_SUB###');

					$pictureuser= $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'];
					$fetoctocusertoquery ='"0.0.0.0.' . $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'] . '"';
					$fetoctocusertomarker ='0.0.0.0.' . $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'];
					if ($pictureuser==0) {
						//check if female
						$fetoctocusertoquery ='"' . $myrating['i' . $mydis . 'likeusers'][$i]['tc_ct_user'] . '"';
						$fetoctocusertomarker =$myrating['i' . $mydis . 'likeusers'][$i]['tc_ct_user'];

						$rowsgender = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('gender',
								'tx_toctoc_comments_comments',
								'toctoc_comments_user = ' . $fetoctocusertoquery,
								'',
								'uid DESC',
								1);
						if (count($rowsgender)>0) {
							if ($rowsgender[0]['gender']==1) {
								$pictureuser=99999;
							}

						}

					}

					$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
							'',
							'',
							'uid DESC',
							1 );
					$usergenderexistsstr='';
					if (count($rowsfeuser)>0) {
						if (array_key_exists('gender', $rowsfeuser[0])) {
							$usergenderexistsstr=' fe_users.gender AS gender, ';
						}

					}

					if (!$fromAjax) {
						$this->build_AJAXImages($conf, $pObj, $usergenderexistsstr, $fromAjax);
					} else {
						if (count($_SESSION['AJAXimages']) !=0 ) {
							$this->AJAXimages = $_SESSION['AJAXimages'];
							$this->gravatarimages = $_SESSION['gravatarimages'];
							$this->AJAXimagesCache = $_SESSION['AJAXOrigimages'];
						}

					}

					$pictureuserfromAjax = $this->getAJAXimage($pictureuser, $pseudocommentid, $conf);
					$pictureuserfromAjaxwrkarr=explode('title="', $pictureuserfromAjax);
					if (count($pictureuserfromAjaxwrkarr)>1) {
						$pictureuserfromAjaxwrkarr2=explode('" ', $pictureuserfromAjaxwrkarr[1]);
						$pictureuserfromAjax=$pictureuserfromAjaxwrkarr[0] . 'title="' . $printname . '" ' . $pictureuserfromAjaxwrkarr2[1];
					} else {
						$pictureuserfromAjax=str_replace(' tx-tc-nodisp', '', $pictureuserfromAjax);
						$pictureuserfromAjax=str_replace('">', '" title="' . $pictureuserfromAjax . '">', $pictureuserfromAjax);
					}

					$uchtmlarr[$i]=trim($uchtml);

					$printname='<a class="tx-tc-picclasslink" id="tx-tc-nameclasslink__'.$pseudocommentid.'__'.
							$cid.'__'.base64_encode($fetoctocusertomarker).'__'.base64_encode($pictureuserfromAjax).
							'__'.$timeout.'" rel="nofollow" href="javascript:void(0)">' . $printname . '</a>';

				} else {
					$iothers=$i;
					$otherscount=$nbrnamed-$i;
					if ($i==0) {
						$nbrinterpunkt='';
					}

					if ($likingusersstr!='') {
						$likingusersstr=substr($likingusersstr, 0, (strlen($likingusersstr)-2));
					}

					break;
				}

				if ($nbrnamed-1 > $i) {
					$likingusersstr .= $printname . ', ';
				} elseif ($nbrnamed-1==$i) {
					$likingusersstr .= $printname;
				} elseif ($nbrnamed==$i) {
					$likingusersstr .= $printname;
				}

				$namedlikearr[$i]['name']=$printname;
				$namedlikearr[$i]['tcuser']=$myrating['i' . $mydis . 'likeusers'][$i]['toctoc_comments_user'];
			}

		}

		$others ='';

		$otherscount=$otherscount+$myrating['allrecs'][0]['totali' . $mydis . 'likes']-$mylikeval-$nbrnamed;
		if ($otherscount>0) {
			$otheruserarray=array();

			$i=0;
			$overmax=0;
			$cntilkeusers=count($myrating['i' . $mydis . 'likeusers']);
			for ($j = (count($myrating['i' . $mydis . 'likeusers'])-$otherscount); $j < $cntilkeusers; $j++) {
				if (trim($myrating['i' . $mydis . 'likeusers'][$j]['current_lastname']) !='') {
					$printname=$myrating['i' . $mydis . 'likeusers'][$j]['current_lastname'];
					if ($myrating['i' . $mydis . 'likeusers'][$j]['current_firstname'] !='') {
						$printname=$myrating['i' . $mydis . 'likeusers'][$j]['current_firstname'] . ' ' . $printname;
					}

				} else {
					if ($conf['ratings.']['useIPsInLikeDislike'] == 1) {
						$printname=$myrating['i' . $mydis . 'likeusers'][$j]['ipresolved'];
					} else {
						$printname = '';
					}
				}

				if (($i < $othersmaxcount) && ($printname != '')) {
					$otheruserarray[$i]=$printname;
					$i++;
					$iovermax=$i;
				} else {
					$overmax++;
					if ($overmax==1) {
						$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otheruser', $fromAjax);

					} else {
						$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otherusers', $fromAjax);
					}

					$i++;
				}

			}

			if ($otherscount==1) {
				$another=$this->pi_getLLWrap($pObj, 'api_ilike_another', $fromAjax);
				if ((count($namedlikearr)>0) || ($mylikeval>0)) {
					$others .= $another;
				} else {
					$anotherarr = explode(' ', $another);
					$anotherarr[0]=ucwords($anotherarr[0]);
					$another = implode(' ', $anotherarr);
					$others .= $another;
				}

			} else {

				$others .= $otherscount . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_others', $fromAjax);
			}
			$others ='<span class="tx-tc-oth" id="tx-tc-oth' . $mydis . '-' . $ref . '"><span class="tx-tc-othertitle tx-tc-textlink" id="tx-tc-othertitle' .
					$mydis . '-' .
					$ref . '" title="' . implode('<br />', $otheruserarray) . '">' . $others . '</span></span>';
			if ((count($namedlikearr)>0) || ($mylikeval>0)) {
				$others = ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) .  ' ' . $others;
			}

		} else {
			if (strpos($likingusersstr, ', ')>0) {
				$likingusersarr=explode(', ', $likingusersstr);
				$lastnameduser=trim($likingusersarr[(count($likingusersarr)-1)]);
				$strlastlen=strlen($lastnameduser);
				$likingusersstr = substr($likingusersstr, 0, (strlen($likingusersstr)-$strlastlen-2)) . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) .
				' ' . $lastnameduser;
			} else {
				if ($likingusersstr!='') {
					$nbrinterpunkt=' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ';
				}

			}

		}

		$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis' . $selectorlikelikes, $fromAjax);
		if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==1) {
			if ($mylikeval==0) {
				// another user likes it
				$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likesthis' . $selectorlikelikes, $fromAjax);
			}

		}

		$emoextpreffortext=$extpreffortext;
		if ($myemoval != 0) {
			$emoextpreffortext='';
		}

		if ($mylikeval==0) {
			// not yet liked by the user
			$mylikepic='i' . $mydis . 'likemaybe'.$this->addv2.'.png';

			if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
				// if liking on toparea

				if (substr($ref, 0, 9)!=='tt_conten') {
					//records
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . $mydis . 'likemaybe', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_' . $extpreffortext . 'topline_onelike', $fromAjax);
					$mylikehtml= $likingusersstr . ' ' . $others . ' ' . $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' .
							$extpreffortext . 'item', $fromAjax) . implode($uchtmlarr);

				} else {
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . $mydis . 'likemaybe', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_topline_onelike', $fromAjax);
					$mylikehtml=$likingusersstr . ' ' . $others . ' ' . $likethis . implode($uchtmlarr);
				}

			} else {
				$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_' . $mydis . 'likemaybe', $fromAjax);
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==0) {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_' . $mydis . 'like', $fromAjax);

				} else {
					$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis', $fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==1) {
						$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likesthis', $fromAjax);
					}

					$mylikehtml= $likingusersstr . ' ' . $others . ' ' . $likethis . implode($uchtmlarr);
				}

				$mylikehtmlnv= $mylikehtml;

			}

		} else {
			$mylikepic='i' . $mydis . 'like'.$this->addv2.'.png';
			if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
				// if liking on toparea
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
					$likethis=str_replace($this->pi_getLLWrap($pObj, 'api_ilike_like', $fromAjax),
							$this->pi_getLLWrap($pObj, 'api_ilike_like_lat_tu', $fromAjax), $likethis);
				}

				if (substr($ref, 0, 9)!=='tt_conten') {
					//records

					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $emoextpreffortext . 'i' . $mydis . 'likethis', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_' . $emoextpreffortext . 'topline_one'.$useUn.'like' . $myemoll, $fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you_lat', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' .
								$others . ' ' . $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item', $fromAjax) . implode($uchtmlarr);

					} else {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' .
								$others . ' ' . $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item', $fromAjax) . implode($uchtmlarr);

					}

				} else {
					//pages
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'i' . $mydis . 'likethis', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_topline_one'.$useUn.'like' . $myemoll, $fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you_lat', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' . $others  .
						' ' . $likethis . ' ' . implode($uchtmlarr);

					} else {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you', $fromAjax) . $nbrinterpunkt . $likingusersstr . $others . ' ' .
								$likethis . ' ' . implode($uchtmlarr);
					}

				}

			} else {
				$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'likethis', $fromAjax);
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_ilike_you_lat', $fromAjax) . ' ' . $this->pi_getLLWrap($pObj, 'api_i' .
							$mydis . 'like_likethis_lat_tu', $fromAjax) . implode($uchtmlarr);

				} else {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_ilike_you', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' . $others . ' ' .
							$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis', $fromAjax) . implode($uchtmlarr);

				}

				$mylikehtmlnv= $mylikehtml;
			}

		}

		$mylike= '<img alt="' . $mylikepicalkt . '" title="' . $mylikepicalkt
		. '" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
		$conf['theme.']['selectedTheme'] . '/img/' . $mylikepic . '" />';
		$retarr=array();

		if (($conf['ratings.']['useLikeDislikeStyle'] == 0)) {
			$retarr[0]=$mylike;
			$retarr[1]=$mylikehtml;
			$retarr[2]=$mylikehtmlnv;
			$retarr[3]=$mylikepic;
			$retarr[4]=$mylikepicalkt;
			// short form
			if ((substr($ref, 0, 9)!=='tx_toctoc')) {
				if (intval($conf['ratings.']['useShortTopLikes']) == 1) {
					$retarr[0]=$mylike;
					$retarr[1]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[2]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[3]=$mylikepic;
					$retarr[4]=$mylikepicalkt;
				}

			}

		} elseif (($conf['ratings.']['useLikeDislikeStyle']==1)) {
			// short form
			if ((substr($ref, 0, 9)!=='tx_toctoc')) {
				if (intval($conf['ratings.']['useShortTopLikes']) == 0) {
					$retarr[0]=$mylike;
					$retarr[1]=$mylikehtml;
					$retarr[2]=$mylikehtmlnv;
					$retarr[3]=$mylikepic;
					$retarr[4]=$mylikepicalkt;
				} else {
					$retarr[0]=$mylike;
					$retarr[1]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[2]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[3]=$mylikepic;
					$retarr[4]=$mylikepicalkt;
				}

			} else {
				//when it's a comment
				$retarr[0]=$mylike;
				$retarr[1]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
				$retarr[2]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
				$retarr[3]=$mylikepic;
				$retarr[4]=$mylikepicalkt;
			}

		} else {
			$retarr[0]=$mylike;
			$retarr[1]=$mylikehtml;
			$retarr[2]=$mylikehtmlnv;
			$retarr[3]=$mylikepic;
			$retarr[4]=$mylikepicalkt;

		}

		return $retarr;
	}
}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.class.toctoc_comments_ratings.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.class.toctoc_comments_ratings.php']);
}
?>