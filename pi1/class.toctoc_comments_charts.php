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
 * class.toctoc_comments_charts.php
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
 *   60: class toctoc_comments_charts extends toctoc_comment_lib
 *   69:     public function topratings ($conf, $pObj, $fromusercenterid = 0)
 * 1521:     public function topsharings ($conf, $pObj)
 * 1953:     private function human_sharesize($bytes, $decimals = 1)
 * 1973:     private function enrichrows($conf, $rowsmerged, $pObj, $show_uid, $input_sys_language_uid = FALSE)
 * 2793:     private function initconf($pidcond, $conf, $restrictor)
 *
 * TOTAL FUNCTIONS: 5
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
class toctoc_comments_charts extends toctoc_comment_lib {
	/**
 * generation of top ratings
 *
 * @param	[type]		$conf: ...
 * @param	[type]		$pObj: ...
 * @param	[type]		$fromusercenterid: ...
 * @return	string		...
 */
	public function topratings ($conf, $pObj, $fromusercenterid = 0) {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$siteRelPath = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments');
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}

		$pidcond='';
		if ($tmpint) {
			$conf['storagePid'] = intval($conf['storagePid']);
			$pidcond = 'deleted=0 AND pid='. $conf['storagePid'] . ' AND ';
		} else {
			$conf['storagePid'] = $GLOBALS['TYPO3_DB']->cleanIntList($conf['storagePid']);
			$pidcond = 'deleted=0 AND pid IN (' . $conf['storagePid'] . ') AND ';
		}

		$pidonlycond = ($tmpint ?
		'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')');
		$restrictor = $pidcond;
		$feusersql = '';
		$feusersort = '';
		$feusergroupby = '';
		$shownbritemsinusercenter=0;
		if ($fromusercenterid != 0) {
			$shownbritemsinusercenter = intval($conf['userCenter.']['commentsPerUCList']);
			$conf['topRatings.']['topRatingsMode']=$fromusercenterid-1;
			$conf['topRatings.']['RatingsDays']=$conf['userCenter.']['maxItemAgeUCList'];
			$conf['topRatings.']['RatedItemsListCount']=$conf['userCenter.']['maxItemsPerUCList'];
			$conf['topRatings.']['NumberOfVotesRequired']=0.5;
			$conf['topRatings.']['AlignResultsWithMaxVotesAndAvgVote'] = 0;
			$conf['topRatings.']['showMinimumVotesinTitle'] = 0;
			$conf['topRatings.']['showAlignCommentinTitle'] = 0;
			$conf['topRatings.']['showCountTopViewsLastView'] = 0;
			$pidonlycond = '';
			$restrictor = 'deleted=0 AND ';
			$restrictor .= 'toctoc_commentsfeuser_feuser=' . $GLOBALS['TSFE']->fe_user->user['uid'] . ' AND ';

			if ($fromusercenterid == 2) {
				$feusergroupby = ', isreview, (CASE WHEN tstampmyrating = 0 THEN tstamp ELSE tstampmyrating END), toctoc_commentsfeuser_feuser';

				$feusersort = '(CASE WHEN tstampmyrating = 0 THEN tstamp ELSE tstampmyrating END) DESC, ';
				$feusersql = ', isreview AS isreview, toctoc_commentsfeuser_feuser AS toctoc_commentsfeuser_feuser,
						(CASE WHEN tstampmyrating = 0 THEN tstamp ELSE tstampmyrating END) AS ratedate';
				$restrictor .= 'isreview<>1 AND ';
			} else {
				$feusergroupby = ', (CASE WHEN tstampidislike = 0 THEN CASE WHEN tstampilike = 0 THEN tstamp ELSE tstampilike END ELSE tstampidislike END),
						toctoc_commentsfeuser_feuser, emolikeid';

				$feusersort = '(CASE WHEN tstampidislike = 0 THEN CASE WHEN tstampilike = 0 THEN tstamp ELSE tstampilike END ELSE tstampidislike END) DESC, ';
				$feusersql = ', emolikeid AS emolikeid, toctoc_commentsfeuser_feuser AS toctoc_commentsfeuser_feuser,
						(CASE WHEN tstampidislike = 0 THEN CASE WHEN tstampilike = 0 THEN tstamp ELSE tstampilike END ELSE tstampidislike END) AS ratedate';
			}

		}

		$daysago=$conf['topRatings.']['RatingsDays'];
		$limitrows=$conf['topRatings.']['RatedItemsListCount'];
		$debug='';
		$initarr = array();
		$initarr= $this->initconf($pidcond, $conf, $restrictor);
		$this->mmtabletoexternalprefix=$initarr['mmtabletoexternalprefix'];
		$this->mmtable=$initarr['mmtable'];
		$restrictor =$initarr['restrictor'];
		$externaltable=$initarr['externaltable'];
		$show_uid=$initarr['show_uid'];
		$displayfields=$initarr['displayfields'];

		if (intval($conf['topRatings.']['NumberOfVotesRequired'])>1) {
			$numberofvotesrequired=intval($conf['topRatings.']['NumberOfVotesRequired']);
		} else {
			$numberofvotesrequired=1;
		}

		$datesince=time()-(86400*$daysago);
		$addonsqlforoldratings = ' CASE WHEN tstampmyrating = 0 THEN CASE WHEN tstamp > '.$datesince.' THEN 1 ELSE 0 END ELSE 0 END ';
		$addonsqlforoldviews = ' CASE WHEN tstampseen = 0 THEN CASE WHEN tstamp > '.$datesince.' THEN 1 ELSE 0 END ELSE 0 END ';
		$addonsqlforoldactivities = '
				CASE WHEN tstampseen = 0 THEN
					CASE WHEN tstampmyrating > '.$datesince.' THEN
						1
					ELSE
						CASE WHEN tstampilike > '.$datesince.' THEN
							1
						ELSE
							CASE WHEN tstamp > '.$datesince.' THEN
								1
							ELSE
								0
							END
						END
					END
				ELSE
				 	0
				END';

		$okdatelikes='(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
						(CASE WHEN ilike = 0 AND idislike=0 THEN 0 ELSE 1 END) *
						(CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
						(CASE WHEN tstampilike > '.$datesince.' THEN
							1
						ELSE
						      	CASE WHEN tstampilike = 0 THEN
						           	CASE WHEN tstampidislike > '.$datesince.'  THEN
						           		1
						           	ELSE
						                     CASE WHEN tstamp > '.$datesince.' THEN
						                     	1
						                     ELSE
						                     	0
						                     END
						             END
						      ELSE 0 END
						END)';

		$i=0;
		$rowsmerged=array();
		$maxvotesfound=0;
		$sumnbrvotesfound=0;
		$sumvotingfound=0;
		$sumlikecountfound=0;
		if ($conf['topRatings.']['topRatingsMode']==0){
			$emolikepicarr= array();
			$emobase= '<i class="tx-tc-elikeov-ico tx-tc-elikeov-chart" style="6g9" title="8g9"></i>';
			$rowsemo = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, emolike_ll,emolike_sort,emolike_setpos,emolike_setfolder as emolike_set',
					'tx_toctoc_comments_emolike',
					'deleted=0',
					'',
					'uid',
					'');

			if (count($rowsemo)>0) {
				if ($conf['theme.']['selectedTheme']=='') {
					$conf['theme.']['selectedTheme'] = 'default';
				}
				foreach($rowsemo as $rowemo) {
					$strpathlikeoremolike = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'Resources/Public/Icons/emolike/' . $rowemo['emolike_set'] . '/';
					$strpicpartlikeoremolike = 'ld';
					$strpicemolikeposition = '';
					$strtitle = $this->pi_getLLWrap($pObj, 'api_ilike_topline_oneunlike'.$rowemo['emolike_ll'], FALSE);
					if (($rowemo['emolike_ll'] == 'Like') || ($rowemo['emolike_ll'] == 'Dislike')) {

						$strpathlikeoremolike= $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/';
						if ($rowemo['emolike_setpos'] == 1) {
							$strpicemolikeposition = '0';
						} else {
							$strpicemolikeposition = '-36';
						}
					} else {
						$strpicpartlikeoremolike='';
						if ($rowemo['emolike_setpos'] == 1) {
							$strpicemolikeposition = '0';
						} elseif ($rowemo['emolike_setpos'] == 2) {
							$strpicemolikeposition = '-36';
						} elseif ($rowemo['emolike_setpos'] == 3) {
							$strpicemolikeposition = '-54';
						} elseif ($rowemo['emolike_setpos'] == 4) {
							$strpicemolikeposition = '-90';
						} elseif ($rowemo['emolike_setpos'] == 5) {
							$strpicemolikeposition = '-108';
						}
					}

					$strstyle = 'background-image: url(\''.$strpathlikeoremolike.'elke'.$strpicpartlikeoremolike.'18.png\'); background-position: 0 '.
									$strpicemolikeposition.'px;';
					$emolikepicarr[$rowemo['uid']] = str_replace('8g9', $strtitle, str_replace('6g9', $strstyle, $emobase));
				}
			}

			$querymerged='SELECT DISTINCT MAX(CASE WHEN pagetstampilike = 0 THEN pagetstampidislike ELSE pagetstampilike END) as pageid,
					reference As ref, ' .
					$okdatelikes . ' as okdate,
					sum(ilike)-sum(idislike) as sumilike,
					sum(ilike)+sum(idislike) as nbrvotes,
					'. $conf['ratings.']['maxValue'] . '*((sum(ilike)-sum(idislike))/(sum(ilike)+sum(idislike))) as sumilikedislikevote,
					min(pid) AS pid, min(deleted) AS deleted'. $feusersql . '
					FROM tx_toctoc_comments_feuser_mm
					GROUP BY reference, ' . $okdatelikes . $feusergroupby . ' HAVING ' . $restrictor . 'okdate>0  AND nbrvotes>= ' . $numberofvotesrequired
					. ' ORDER BY '.$feusersort.'okdate DESC, sumilike DESC, nbrvotes, ref';

			$resultmerged1= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
			while ($rowsmerged1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1)) {
				// reorder fields

				$rowsmerged[$i]['likecount'] = round($rowsmerged1['sumilike'], 1);
				$rowsmerged[$i]['nbrvotes'] = $rowsmerged1['nbrvotes'];
				$rowsmerged[$i]['voting'] = round($rowsmerged1['sumilikedislikevote'], 1);
				$rowsmerged[$i]['ref'] = $rowsmerged1['ref'];
				$rowsmerged[$i]['pageid'] = $rowsmerged1['pageid'];
				$rowsmerged[$i]['sumilikedislike'] = $rowsmerged1['sumilike'];
				$rowsmerged[$i]['sumilikedislikevote'] = $rowsmerged1['sumilikedislikevote'];
				if (isset($rowsmerged1['emolikeid'])) {
					$rowsmerged[$i]['emolikeid'] = $rowsmerged1['emolikeid'];
				}
				if ($fromusercenterid != 0) {
					$rowsmerged[$i]['ratedate'] = $rowsmerged1['ratedate'];
				}
				if ($rowsmerged[$i]['nbrvotes'] > $maxvotesfound) {
					$maxvotesfound=$rowsmerged[$i]['nbrvotes'];
				}

				$sumnbrvotesfound= $sumnbrvotesfound+$rowsmerged1['nbrvotes'];
				$sumlikecountfound = $sumlikecountfound+($rowsmerged1['sumilikedislikevote']);

				 $sumvotingfound= $sumvotingfound+($rowsmerged1['sumilikedislikevote']);
				$i++;

			}

		} elseif ($conf['topRatings.']['topRatingsMode']==1){
			$querymerged='SELECT DISTINCT MIN(pagetstampmyrating) as pageid,
					reference As ref,
					(CASE WHEN myrating = 0 THEN 0 ELSE 1 END) *(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN tstampmyrating > '.
					$datesince.' THEN 1 ELSE' . $addonsqlforoldratings .'END) as okdate,
					sum(myrating)/' . $conf['ratings.']['maxValue'] . ' as sumilikedislike,
					count(uid) as nbrvotes,
					avg(myrating) as sumilikedislikevote,
					min(pid) AS pid, min(deleted) AS deleted'. $feusersql . '
					FROM tx_toctoc_comments_feuser_mm
					GROUP BY reference,
					(CASE WHEN myrating = 0 THEN 0 ELSE 1 END) *(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) * (CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN tstampmyrating > '.
					$datesince.' THEN 1 ELSE' . $addonsqlforoldratings .'END)' . $feusergroupby . '
					HAVING ' . $restrictor . 'okdate>0  AND nbrvotes>= ' . $numberofvotesrequired
					. ' ORDER BY '.$feusersort.'okdate DESC, sumilikedislikevote DESC, nbrvotes DESC, ref';

			$resultmerged1= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
			while ($rowsmerged1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1)) {
				// reorder fields
				$rowsmerged[$i]['voting'] = round($rowsmerged1['sumilikedislikevote'], 1);
				$rowsmerged[$i]['nbrvotes'] = $rowsmerged1['nbrvotes'];
				$rowsmerged[$i]['likecount'] = round($rowsmerged1['sumilikedislike'], 1);
				// need to handle this... tx_restdoc_pi16g9doc_CommentsAndRatingsOn7g8Index
				$fixedref = $rowsmerged1['ref'];
				$arrref = explode('6g9', $rowsmerged1['ref']);
				if (count($arrref) > 1) {

					$refpart1 = $arrref[0];
					$arrreffromrest = explode('_', $arrref[1]);
					array_shift($arrreffromrest);

					$tmpexternalUid = implode('_', $arrreffromrest);
					$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $tmpexternalUid));
					list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
							'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

					if (trim($uidrow['externaluid']) != '') {
						$tmpexternalUid = $uidrow['externaluid'];
					}

					$tmpexternalUidarr = explode('@page', $tmpexternalUid);
					if (count($tmpexternalUidarr) >1) {
						$tmpexternalUid = array_shift($tmpexternalUidarr);
					}

					$refpart2 = str_replace('7g8', '-', $tmpexternalUid);
					$fixedref = $refpart1 . '_' . $refpart2;
					$sprint= TRUE;
				}

				$rowsmerged[$i]['ref'] = $fixedref;
				$rowsmerged[$i]['pageid'] = $rowsmerged1['pageid'];
				$rowsmerged[$i]['sumilikedislike'] = $rowsmerged1['sumilikedislike'];
				$rowsmerged[$i]['sumilikedislikevote'] = $rowsmerged1['sumilikedislikevote'];
				if ($fromusercenterid != 0) {
					$rowsmerged[$i]['ratedate'] = $rowsmerged1['ratedate'];
				}
				if ($rowsmerged[$i]['nbrvotes'] > $maxvotesfound) {
					$maxvotesfound=$rowsmerged[$i]['nbrvotes'];
				}

				$sumnbrvotesfound= $sumnbrvotesfound+$rowsmerged1['nbrvotes'];
				$sumvotingfound = $sumvotingfound+($rowsmerged1['sumilikedislikevote']);

				$sumlikecountfound = $sumlikecountfound+$rowsmerged1['sumilikedislike'];

				$i++;

			}

		} elseif (($conf['topRatings.']['topRatingsMode']==3) || ($conf['topRatings.']['topRatingsMode']==2)){

			$querymerged='(SELECT DISTINCT MIN(pagetstampmyrating) as pageid,
			reference As ref,
			(CASE WHEN myrating = 0 THEN 0 ELSE 1 END) *
			(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
			(CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
			(CASE WHEN tstampmyrating > '.$datesince.' THEN
					1
					ELSE
			CASE WHEN tstampmyrating = 0 THEN
			CASE WHEN tstamp > '.$datesince.' THEN
					1
					ELSE
					0
					END
					ELSE
					0
					END
					END) as okdate,
					sum(myrating/' . $conf['ratings.']['maxValue'] . ') as sumilikedislike, count(uid) as nbrvotes, avg(myrating) as sumilikedislikevote,
					min(pid) AS pid, min(deleted) AS deleted'. $feusersql . '
					FROM tx_toctoc_comments_feuser_mm
					GROUP BY reference,
					(CASE WHEN myrating = 0 THEN 0 ELSE 1 END) *
					(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN tstampmyrating > '.$datesince.' THEN
							1
							ELSE
					CASE WHEN tstampmyrating = 0 THEN
					CASE WHEN tstamp > '.$datesince.' THEN
							1
							ELSE
							0
							END
							ELSE
							0
							END
							END)'. $feusergroupby . '
							HAVING ' . $restrictor . 'okdate>0
			) UNION (
					SELECT DISTINCT MAX(CASE WHEN pagetstampilike = 0 THEN pagetstampidislike ELSE pagetstampilike END) as pageid,
					reference As ref,
					(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN ilike = 0 AND idislike=0 THEN 0 ELSE 1 END) *
					(CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN tstampilike > '.$datesince.' THEN
							1
							ELSE
					CASE WHEN tstampilike = 0 THEN
					CASE WHEN tstampidislike > '.$datesince.'  THEN
							1
							ELSE
					CASE WHEN tstamp > '.$datesince.' THEN
							1
							ELSE
							0
							END
							END
							ELSE 0 END
							END) as okdate,
					sum(ilike-idislike) as sumilikedislike, count(uid) as nbrvotes, ' . intval($conf['ratings.']['maxValue']) .
					'*(sum(ilike-idislike)/count(uid))  as sumilikedislikevote,
					min(pid) AS pid, min(deleted) AS deleted'. $feusersql . '
					FROM tx_toctoc_comments_feuser_mm
					GROUP BY reference,
					(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN ilike = 0 AND idislike=0 THEN 0 ELSE 1 END) *
					(CASE WHEN reference_scope = 0 THEN 1 ELSE 0 END) *
					(CASE WHEN tstampilike > '.$datesince.' THEN
							1
							ELSE
					CASE WHEN tstampilike = 0 THEN
					CASE WHEN tstampidislike > '.$datesince.'  THEN
							1
							ELSE
					CASE WHEN tstamp > '.$datesince.' THEN
							1
							ELSE
							0
							END
							END
							ELSE 0 END
							END)'. $feusergroupby . '
					HAVING ' . $restrictor . 'okdate>0 )
					order BY '.$feusersort.'okdate DESC, ref, sumilikedislike DESC, nbrvotes, ref';

			$resultmerged= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
			$currentref='';
			$rowsmergedout=array();

			while ($rowsmerged = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged)) {
				// cleanup UNION result, resort and limit to top x				$fixedref = $rowsmerged1['ref'];

				$arrref = explode('6g9', $rowsmerged['ref']);

				if (count($arrref) > 1) {

					$refpart1 = $arrref[0];
					$arrreffromrest = explode('_', $arrref[1]);
					array_shift($arrreffromrest);

					$tmpexternalUid = implode('_', $arrreffromrest);
					$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $tmpexternalUid));
					list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
							'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

					if (trim($uidrow['externaluid']) != '') {
						$tmpexternalUid = $uidrow['externaluid'];
					}
					$tmpexternalUidarr = explode('@page', $tmpexternalUid);
					if (count($tmpexternalUidarr) >1) {
						$tmpexternalUid = array_shift($tmpexternalUidarr);
					}
					$refpart2 = str_replace('7g8', '-', $tmpexternalUid);
					$fixedref = $refpart1 . '_' . $refpart2;
					$rowsmerged['ref'] = $fixedref;
				}

				if ($currentref!=$rowsmerged['ref']) {
					$currentref=$rowsmerged['ref'];
					$rowsmergedout[$i]=$rowsmerged;
					$i++;
				} else {
					$rowsmergedout[$i-1]['sumilikedislikevote'] = ($rowsmergedout[$i-1]['sumilikedislikevote']*$rowsmergedout[$i-1]['nbrvotes']+
							$rowsmerged['sumilikedislikevote']*$rowsmerged['nbrvotes'])/($rowsmergedout[$i-1]['nbrvotes']+$rowsmerged['nbrvotes']);
					$rowsmergedout[$i-1]['nbrvotes'] = $rowsmergedout[$i-1]['nbrvotes']+$rowsmerged['nbrvotes'];
					$rowsmergedout[$i-1]['sumilikedislike'] = $rowsmergedout[$i-1]['sumilikedislike']+$rowsmerged['sumilikedislike'];
					if ($rowsmerged['pageid']>$rowsmergedout[$i-1]['pageid']) {
						$rowsmergedout[$i-1]['pageid']=$rowsmerged['pageid'];
					}

				}
			}

			$iout=0;
			$countrowsmergedout=count($rowsmergedout);
			for ($i=0; $i<$countrowsmergedout; $i++) {
				if ($rowsmergedout[$i]['nbrvotes'] >= $numberofvotesrequired) {
					if ($rowsmergedout[$i]['nbrvotes'] > $maxvotesfound) {
						$maxvotesfound=$rowsmergedout[$i]['nbrvotes'];
					}

					$sumnbrvotesfound= $sumnbrvotesfound+$rowsmergedout[$i]['nbrvotes'];
					$sumvotingfound = $sumvotingfound+($rowsmergedout[$i]['sumilikedislikevote']);

					$sumlikecountfound = $sumlikecountfound+$rowsmergedout[$i]['sumilikedislike'];
					if ($conf['topRatings.']['topRatingsMode']==2){
						$rowsmerged[$iout]['voting'] = round($rowsmergedout[$i]['sumilikedislikevote'], 1);
					} else {
						$rowsmerged[$iout]['likecount'] = round($rowsmergedout[$i]['sumilikedislike'], 1);
					}

					$rowsmerged[$iout]['nbrvotes'] = $rowsmergedout[$i]['nbrvotes'];

					if ($conf['topRatings.']['topRatingsMode']==3){
						$rowsmerged[$iout]['voting'] = round($rowsmergedout[$i]['sumilikedislikevote'], 1);

					} else {
						$rowsmerged[$iout]['likecount'] = round($rowsmergedout[$i]['sumilikedislike'], 1);
					}

					$rowsmerged[$iout]['ref'] = $rowsmergedout[$i]['ref'];
					$rowsmerged[$iout]['pageid'] = $rowsmergedout[$i]['pageid'];
					$rowsmerged[$iout]['sumilikedislike'] = $rowsmergedout[$i]['sumilikedislike'];
					$rowsmerged[$iout]['sumilikedislikevote'] = $rowsmergedout[$i]['sumilikedislikevote'];
					$iout++;
				}

			}

			if (is_array($rowsmerged)) {
				rsort($rowsmerged);
			}

		} elseif ($conf['topRatings.']['topRatingsMode']==4){
			$querymerged='SELECT DISTINCT MIN(pagetstampseen) as pageid,
					reference As ref,
					(CASE WHEN seen = 0 THEN 0 ELSE 1 END) *(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *(CASE WHEN reference_scope = 0 THEN 1 ELSE 1 END) *
					(CASE WHEN tstampseen > '.$datesince.' THEN 1 ELSE' . $addonsqlforoldviews .'END) as okdate,
					sum(seen) as sumilikedislike,
					count(uid) as nbrvotes,
					min(tstampseen) as firstview,
					max(tstampseen) as lastview,
					sum(seen) as sumilikedislikevote,
					min(pid) AS pid, min(deleted) AS deleted
					FROM tx_toctoc_comments_feuser_mm
					GROUP BY reference, (CASE WHEN seen = 0 THEN 0 ELSE 1 END) *(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *
							(CASE WHEN reference_scope = 0 THEN 1 ELSE 1 END) * (CASE WHEN tstampseen > '.$datesince.' THEN 1 ELSE' . $addonsqlforoldviews .'END)
					HAVING ' . $restrictor . 'okdate>0  AND nbrvotes>= ' . $numberofvotesrequired
					. ' ORDER BY okdate DESC, sumilikedislikevote DESC, nbrvotes DESC, ref';
			$resultmerged1= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
			while ($rowsmerged1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1)) {
				if (substr($rowsmerged1['ref'], 0, 5)=='tt_co') {
						$whereplus=' AND (external_ref_uid="' . $rowsmerged1['ref'] .'")';

				} else {
					$whereplus=' AND (external_ref="' . $rowsmerged1['ref'] .'")';
				}

				$wherecommunity='';
				if (substr($rowsmerged1['ref'], 0, 5) == 'fe_us') {
					$wherecommunity =' AND parentuid=0';
				}

				$tmpwhere=' approved=1 AND ' . $pidonlycond .
						$this->enableFields('tx_toctoc_comments_comments', $pObj) . $whereplus . $wherecommunity . ' AND tstamp > '.$datesince.'';
				$querymergedc='SELECT COUNT(*) AS counter, MIN(tstamp) AS firstcommentview
					FROM tx_toctoc_comments_comments
					WHERE ' . $tmpwhere;

				$resultmerged1c= $GLOBALS['TYPO3_DB']->sql_query($querymergedc);
				while ($rowsmerged1c = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1c)) {
					$commentscounter=intval($rowsmerged1c['counter']);
					$firstcommentview=intval($rowsmerged1c['firstcommentview']);
				}

				$viewscounter=intval($rowsmerged1['sumilikedislikevote']);

				// reorder fields
				$rowsmerged[$i]['voting'] = $viewscounter;
				$rowsmerged[$i]['nbrvotes'] = $rowsmerged1['nbrvotes'];
				$rowsmerged[$i]['likecount'] = $viewscounter;

				$arrref = explode('6g9', $rowsmerged1['ref']);

				if (count($arrref) > 1) {

					$refpart1 = $arrref[0];
					$arrreffromrest = explode('_', $arrref[1]);
					array_shift($arrreffromrest);

					$tmpexternalUid = implode('_', $arrreffromrest);
					$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $tmpexternalUid));
					list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
							'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

					if (trim($uidrow['externaluid']) != '') {
						$tmpexternalUid = $uidrow['externaluid'];
					}
					$tmpexternalUidarr = explode('@page', $tmpexternalUid);
					if (count($tmpexternalUidarr) >1) {
						$tmpexternalUid = array_shift($tmpexternalUidarr);
					}
					$refpart2 = str_replace('7g8', '-', $tmpexternalUid);
					$fixedref = $refpart1 . '_' . $refpart2;
					$rowsmerged1['ref'] = $fixedref;
				}

				$rowsmerged[$i]['ref'] = $rowsmerged1['ref'];
				$rowsmerged[$i]['pageid'] = $rowsmerged1['pageid'];
				$rowsmerged[$i]['sumilikedislike'] = $viewscounter;
				$rowsmerged[$i]['sumilikedislikevote'] = $viewscounter;
				$date=$rowsmerged1['firstview'];
				//compare to date from commentstable

				if (intval($firstcommentview) !=0) {
					if ($firstcommentview<$date)  {
						$date= $firstcommentview;
					}

				}

				// formating found date as specified in conf
				$datefirstview=$date;
				$rowsmerged[$i]['datefirstview'] = '';
				if (intval($date)!=0) {
					if ($conf['advanced.']['dateFormatMode'] == 'strftime') {
						$datefirstview=strftime($conf['advanced.']['dateFormat'], $date);
						if ($datefirstview=='') {
							$datefirstview='strftime format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
						}

					} else {
						$datefirstview=date($conf['advanced.']['dateFormat'], $date);
						if ($datefirstview=='') {
							$datefirstview='date format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
						}

					}

					$lastview='';
					if (($rowsmerged1['lastview']!=0) && ($conf['topRatings.']['showCountTopViewsLastView']==1)) {
						$timebefore=$this->formatDate($rowsmerged1['lastview'], $pObj, FALSE, $conf);
						$timebefore=strtolower(substr($timebefore, 0, 1)) . substr($timebefore, 1);
						$lastview = ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.lastseen', FALSE) . ' ' . $timebefore;
					}

					$rowsmerged[$i]['datefirstview'] = ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.since', FALSE) . ' ' . $datefirstview . $lastview;
				}

				if ($rowsmerged[$i]['nbrvotes'] > $maxvotesfound) {
					$maxvotesfound=$rowsmerged[$i]['nbrvotes'];
				}

				$sumnbrvotesfound= $sumnbrvotesfound+$rowsmerged1['nbrvotes'];
				$sumvotingfound = $sumvotingfound+($viewscounter);

				$sumlikecountfound = $sumlikecountfound+$viewscounter;
				$i++;
			}

			if (is_array($rowsmerged)) {
				rsort($rowsmerged);
			}

		} elseif ($conf['topRatings.']['topRatingsMode']==5){
			$querymerged='SELECT DISTINCT
					MIN(CASE WHEN pagetstampseen=0 THEN 1377017087 ELSE pagetstampseen END) as pageid,
					MIN(CASE WHEN pagetstampilike=0 THEN 1377017087 ELSE pagetstampilike END) as pageid2,
					MIN(CASE WHEN pagetstampmyrating=0 THEN 1377017087 ELSE pagetstampmyrating END) as pageid3,
					reference As ref,
					(CASE WHEN (seen = 0 AND ilike=0 AND myrating=0) THEN 0 ELSE 1 END) *(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) * (CASE WHEN tstampseen > '.
					$datesince.' THEN 1 ELSE ' . $addonsqlforoldactivities .' END) as okdate,
					sum(seen)+' .
					intval($conf['advanced.']['activityMultiplicatorRating']) .'*(sum(ilike)+sum(idislike)+sum(CASE WHEN myrating>0 THEN 1 ELSE 0 END)) as sumilikedislike,
					count(uid) as nbrvotes,
					min(CASE WHEN tstampseen=0 THEN UNIX_TIMESTAMP() ELSE tstampseen END) as firstview,
					min(CASE WHEN tstampilike THEN UNIX_TIMESTAMP() ELSE tstampilike END) as firstview2,
					min(CASE WHEN tstampmyrating THEN UNIX_TIMESTAMP() ELSE tstampmyrating END) as firstview3,
					min(tstamp) as firstview4,
					max(tstampseen) as lastview,
					max(tstampilike) as lastview2,
					max(tstampmyrating) as lastview3,
					max(tstamp) as lastview4,
					sum(seen) as sumseen,
					sum(seen)+' .
					intval($conf['advanced.']['activityMultiplicatorRating']) .'*(sum(ilike)+sum(idislike)+sum(CASE WHEN myrating>0 THEN 1 ELSE 0 END)) as sumilikedislikevote,
							min(pid) AS pid, min(deleted) AS deleted
					FROM tx_toctoc_comments_feuser_mm
					GROUP BY reference,
							(CASE WHEN (seen = 0 AND ilike=0 AND myrating=0) THEN 0 ELSE 1 END) *(CASE WHEN deleted = 0 THEN 1 ELSE 0 END) *  (CASE WHEN tstampseen > '.
							$datesince.' THEN 1 ELSE ' . $addonsqlforoldactivities .' END)
					HAVING sumseen>0 AND ' . $restrictor . 'okdate>0  AND nbrvotes>= ' . $numberofvotesrequired
					. ' ORDER BY okdate DESC, sumilikedislikevote DESC, nbrvotes DESC, ref';
			$resultmerged1= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
			while ($rowsmerged1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1)) {
				// getting date of first activity
				$date='';
				$date=intval($rowsmerged1['firstview']);
				if (intval($rowsmerged1['firstview2'])>0) {
					if (intval($rowsmerged1['firstview2'])<$date) {
						$date = intval($rowsmerged1['firstview2']);
					}
				}

				if (intval($rowsmerged1['firstview3'])>0) {
					if (intval($rowsmerged1['firstview3'])<$date) {
						$date = intval($rowsmerged1['firstview3']);
					}

				}

				if ((intval($rowsmerged1['firstview4'])>0) && ($date==0)) {
					if (intval($rowsmerged1['firstview4'])<$date) {
						$date = intval($rowsmerged1['firstview4']);
					}

				}

				$lastview='';
				$lastview=intval($rowsmerged1['lastview']);
				if (intval($rowsmerged1['lastview2'])>0) {
					if (intval($rowsmerged1['lastview2'])>$lastview) {
						$lastview = intval($rowsmerged1['lastview2']);
					}

				}

				if (intval($rowsmerged1['lastview3'])>0) {
					if (intval($rowsmerged1['lastview3'])>$lastview) {
						$lastview = intval($rowsmerged1['lastview3']);
					}

				}

				if ((intval($rowsmerged1['lastview4'])>0) && ($lastview==0)) {
					if (intval($rowsmerged1['lastview4'])>$lastview) {
						$lastview = intval($rowsmerged1['lastview4']);
					}

				}

				if (substr($rowsmerged1['ref'], 0, 5)=='tt_co') {
						$whereplus=' AND (external_ref_uid="' . $rowsmerged1['ref'] .'")';

				} else {
					$whereplus=' AND (external_ref="' . $rowsmerged1['ref'] .'")';
				}

				if (str_replace('tx_toctoc_comments_comments_', '', $rowsmerged1['ref']) == $rowsmerged1['ref']){
					$wherecommunity='';
					if (substr($rowsmerged1['ref'], 0, 5) == 'fe_us') {
						$wherecommunity =' AND parentuid=0';
					}

					// counting comments
					$tmpwhere=' approved=1 AND ' . $pidonlycond .
								$this->enableFields('tx_toctoc_comments_comments', $pObj) . $whereplus . $wherecommunity . ' AND tstamp > '.$datesince.'';
					$querymergedc='SELECT COUNT(*) AS counter, MIN(tstamp) AS firstcommentview, MAX(tstamp) AS lastcommentview
						FROM tx_toctoc_comments_comments
						WHERE ' . $tmpwhere;

					$resultmerged1c= $GLOBALS['TYPO3_DB']->sql_query($querymergedc);
					while ($rowsmerged1c = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1c)) {
						$commentscounter=intval($rowsmerged1c['counter']);
						$firstcommentview=intval($rowsmerged1c['firstcommentview']);
						$lastcommentview=intval($rowsmerged1c['lastcommentview']);
					}

					if (intval($lastcommentview)>$lastview) {
						$lastview = $lastcommentview;
					}

				}

				if (str_replace('tx_toctoc_comments_comments_', '', $rowsmerged1['ref']) != $rowsmerged1['ref']){
					// counting subcomments (only for comments)
					$refarr=explode('_', $rowsmerged1['ref']);
					$refid=$refarr[count($refarr)-1];

					$tmpwhere=' parentuid=' .$refid .'  AND approved=1 AND ' . $pidonlycond .
							$this->enableFields('tx_toctoc_comments_comments', $pObj) . $whereplus . ' AND tstamp > '.$datesince.'';
					$querymergedc='SELECT COUNT(*) AS counter, MIN(tstamp) AS firstcommentview, MAX(tstamp) AS lastcommentview
						FROM tx_toctoc_comments_comments
						WHERE ' . $tmpwhere;

					$resultmerged1c= $GLOBALS['TYPO3_DB']->sql_query($querymergedc);
					while ($rowsmerged1c = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1c)) {
						$commentscounter=intval($rowsmerged1c['counter']);
						$firstcommentview=intval($rowsmerged1c['firstcommentview']);
						$lastcommentview=intval($rowsmerged1c['lastcommentview']);
					}

					if (intval($lastcommentview)>$lastview) {
						$lastview = $lastcommentview;
					}

				}

				$viewscounter=intval($rowsmerged1['sumilikedislikevote'])+intval($conf['advanced.']['activityMultiplicatorComment'])*$commentscounter;
				// reorder fields
				$rowsmerged[$i]['voting'] = $viewscounter;
				$rowsmerged[$i]['nbrvotes'] = $rowsmerged1['nbrvotes'];
				$rowsmerged[$i]['likecount'] = $viewscounter;
				$arrref = explode('6g9', $rowsmerged1['ref']);

				if (count($arrref) > 1) {

					$refpart1 = $arrref[0];
					$arrreffromrest = explode('_', $arrref[1]);
					array_shift($arrreffromrest);

					$tmpexternalUid = implode('_', $arrreffromrest);
					$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $tmpexternalUid));
					list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
							'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

					if (trim($uidrow['externaluid']) != '') {
						$tmpexternalUid = $uidrow['externaluid'];
					}
					$tmpexternalUidarr = explode('@page', $tmpexternalUid);
					if (count($tmpexternalUidarr) >1) {
						$tmpexternalUid = array_shift($tmpexternalUidarr);
					}
					$refpart2 = str_replace('7g8', '-', $tmpexternalUid);
					$fixedref = $refpart1 . '_' . $refpart2;
					$rowsmerged1['ref'] = $fixedref;
				}

				$rowsmerged[$i]['ref'] = $rowsmerged1['ref'];
				if ((intval($rowsmerged1['pageid'])>0) && (intval($rowsmerged1['pageid']) !=1377017087)) {
					$rowsmerged[$i]['pageid'] = $rowsmerged1['pageid'];
				} elseif ((intval($rowsmerged1['pageid2'])>0) && (intval($rowsmerged1['pageid2']) !=1377017087)) {
					$rowsmerged[$i]['pageid'] = $rowsmerged1['pageid2'];

				} elseif ((intval($rowsmerged1['pageid3'])>0) && (intval($rowsmerged1['pageid3']) !=1377017087)) {
					$rowsmerged[$i]['pageid'] = $rowsmerged1['pageid3'];

				}

				$rowsmerged[$i]['sumilikedislike'] = $viewscounter;
				$rowsmerged[$i]['sumilikedislikevote'] = $viewscounter;

				//compare to date from commentstable

				if (intval($firstcommentview) !=0) {
					if ($firstcommentview<$date)  {
						$date= $firstcommentview;
					}

				}

				// formating found date as specified in conf
				$datefirstview=$date;
				$rowsmerged[$i]['datefirstview'] = '';
				if (intval($date)!=0) {
					if ($conf['advanced.']['dateFormatMode'] == 'strftime') {
						$datefirstview=strftime($conf['advanced.']['dateFormat'], $date);
						if ($datefirstview=='') {
							$datefirstview='strftime format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
						}

					} else {
						$datefirstview=date($conf['advanced.']['dateFormat'], $date);
						if ($datefirstview=='') {
							$datefirstview='date format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
						}

					}

					if (($lastview!='') && ($conf['topRatings.']['showCountTopViewsLastView']==1)) {
						$timebefore=$this->formatDate($lastview, $pObj, FALSE, $conf);
						$timebefore=strtolower(substr($timebefore, 0, 1)) . substr($timebefore, 1);
						$lastview = ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.lastactivity', FALSE) . ' ' . $timebefore;
					} else {
						$lastview ='';
					}

					$rowsmerged[$i]['datefirstview'] = ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.since', FALSE) . ' ' . $datefirstview . $lastview;
				}

				if ($rowsmerged[$i]['nbrvotes'] > $maxvotesfound) {
					$maxvotesfound=$rowsmerged[$i]['nbrvotes'];
				}

				$sumnbrvotesfound= $sumnbrvotesfound+$rowsmerged1['nbrvotes'];
				$sumvotingfound = $sumvotingfound+$viewscounter;

				$sumlikecountfound = $sumlikecountfound+$viewscounter;
				$i++;
			}
			if (is_array($rowsmerged)) {
				if (count($rowsmerged) > 0) {
					rsort($rowsmerged);
				}
			}
		}

		if ($conf['topRatings.']['topRatingsMode']<4){
			if ($conf['topRatings.']['AlignResultsWithMaxVotesAndAvgVote']==1) {
				$rowsmergedout=array();
				$rowsmergedout=$rowsmerged;
				$rowsmerged=array();
				if ($sumnbrvotesfound != 0) {
					$overallavgvotingfound=(($sumlikecountfound*intval($conf['ratings.']['maxValue'])))/$sumnbrvotesfound;
					$countrowsmergedout2=count($rowsmergedout);
					for ($i=0; $i<$countrowsmergedout2; $i++) {
						if (($conf['topRatings.']['topRatingsMode']==2) || ($conf['topRatings.']['topRatingsMode']==1)){
							$rowsmerged[$i]['voting']=round((($rowsmergedout[$i]['sumilikedislikevote']*$rowsmergedout[$i]['nbrvotes'])+
									($overallavgvotingfound*($maxvotesfound-$rowsmergedout[$i]['nbrvotes'])))/$maxvotesfound, 2);
						} else {
							$rowsmerged[$i]['likecount'] = round((($rowsmergedout[$i]['sumilikedislike'])+
									(($overallavgvotingfound/intval($conf['ratings.']['maxValue']))*($maxvotesfound-$rowsmergedout[$i]['nbrvotes']))), 2);
						}

						$rowsmerged[$i]['nbrvotes'] = $rowsmergedout[$i]['nbrvotes'];
						if ($conf['topRatings.']['topRatingsMode']==3){
							$rowsmerged[$i]['voting']=round((($rowsmergedout[$i]['sumilikedislikevote']*$rowsmergedout[$i]['nbrvotes'])+
									($overallavgvotingfound*($maxvotesfound-$rowsmergedout[$i]['nbrvotes'])))/$maxvotesfound, 2);
						} else {
							$rowsmerged[$i]['likecount'] = round((($rowsmergedout[$i]['sumilikedislike'])+
									(($overallavgvotingfound/intval($conf['ratings.']['maxValue']))*($maxvotesfound-$rowsmergedout[$i]['nbrvotes']))), 2);
						}

						$rowsmerged[$i]['ref'] = $rowsmergedout[$i]['ref'];
						$rowsmerged[$i]['pageid'] = $rowsmergedout[$i]['pageid'];
						if (isset($rowsmergedout[$i]['emolikeid'])) {
							$rowsmerged[$i]['emolikeid']=$rowsmergedout[$i]['emolikeid'];
						}

					}
				}

				if (is_array($rowsmerged)) {
					if (count($rowsmerged) > 0) {
						rsort($rowsmerged);
					}

				}

			}

		}

		$overallavgvotingfound=round($overallavgvotingfound, 2);
        $this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() .
        		t3lib_extMgm::siteRelPath('toctoc_comments'), $conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);
		// now $rowsmerged contains the data to build the list
		$irank=0;

		if ((count($rowsmerged)>0) && ($rowsmerged[0]['nbrvotes']!='')) {
			$rowsmerged = $this->enrichrows($conf, $rowsmerged, $pObj, $show_uid);
		}

		$rowsmergedclean= array();
		$i2=0;
		if ((count($rowsmerged)>0) && ($rowsmerged[0]['nbrvotes']!='')) {
			$countrowsmerged=count($rowsmerged);
			for ($i=0; $i<$countrowsmerged; $i++) {
				if ($rowsmerged[$i]['isok']==1) {
					$rowsmergedclean[$i2]=$rowsmerged[$i];
					$i2++;
				}

			}

		}

		$rowsmerged=array();
		$countrowsmergedclean=count($rowsmergedclean);
		for ($i=0; $i<$countrowsmergedclean; $i++) {
			$rowsmerged[$i]=$rowsmergedclean[$i];
		}

		$mofdays='';
		if ($conf['topRatings.']['showMinimumVotesinTitle']==1) {
			$mofdays=', ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_minimumvotesrequired', FALSE).' ' . $numberofvotesrequired;
		}

		$trconfigstr=' '. intval($conf['topRatings.']['RatingsDays']) . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.daysgermann', FALSE) . $mofdays .'.';
		if ($conf['topRatings.']['topRatingsMode']==0){
			$topratings_ilike_vote_desc=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_conf0', FALSE) . $trconfigstr;
		} elseif ($conf['topRatings.']['topRatingsMode']==1){
			$topratings_ilike_vote_desc=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_conf1', FALSE) . $trconfigstr;
		} elseif ($conf['topRatings.']['topRatingsMode']==2){
			$topratings_ilike_vote_desc=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_conf2', FALSE) . $trconfigstr;
		} elseif ($conf['topRatings.']['topRatingsMode']==3){
			$topratings_ilike_vote_desc=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_conf3', FALSE) . $trconfigstr;
		} elseif ($conf['topRatings.']['topRatingsMode']==4){
			$topratings_ilike_vote_desc=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_conf4', FALSE) . $trconfigstr;
		} elseif ($conf['topRatings.']['topRatingsMode']==5){
			$topratings_ilike_vote_desc=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_conf5', FALSE) . $trconfigstr;
		}

		$AlignResultsWithMaxVotesAndAvgVoteText='';
		if ($conf['topRatings.']['topRatingsMode']<4){
			if (($conf['topRatings.']['AlignResultsWithMaxVotesAndAvgVote']==1) && ($conf['topRatings.']['showAlignCommentinTitle']==1)) {

				$topratingsAlignResultsdesc = str_replace('%s', $maxvotesfound, $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_calcalign', FALSE));
				$AlignResultsWithMaxVotesAndAvgVoteText='<br />' . $topratingsAlignResultsdesc . ' ' . round($overallavgvotingfound, 1);
			}

			$text_topratings = str_replace('%s', $conf['topRatings.']['RatedItemsListCount'], $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings', FALSE));
		} else {
			if ($conf['topRatings.']['topRatingsMode']==4){
			$text_topratings = str_replace('%s', $conf['topRatings.']['RatedItemsListCount'], $this->pi_getLLWrap($pObj, 'pi1_template.text_topviews', FALSE));
			} else {
				//5
				$text_topratings .= ' ' . str_replace('%s', $conf['topRatings.']['RatedItemsListCount'],
						$this->pi_getLLWrap($pObj, 'pi1_template.text_topactivities', FALSE));

			}

		}

		if ((trim($conf['topRatings.']['topRatingsrestrictToExternalPrefix'])=='') || (trim($conf['topRatings.']['topRatingsrestrictToExternalPrefix'])=='0')) {
			if ($conf['topRatings.']['topRatingsMode']<4){
				$text_topratings .= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_allratedrecords', FALSE);
			} else {
				$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_allviewedrecords', FALSE);

			}

		} elseif ($conf['topRatings.']['topRatingsrestrictToExternalPrefix']=='content') {
			if ($conf['topRatings.']['topRatingsMode']<4){
				$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_pagecontent', FALSE);
			} else {
				if ($conf['topRatings.']['topRatingsMode']==4){
					$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topviews_pagecontent', FALSE);
				} else {
					//5
					$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topviews_pagecontent', FALSE);
				}

			}

		} elseif ($conf['topRatings.']['topRatingsrestrictToExternalPrefix']=='comments') {

			if ($conf['topRatings.']['topRatingsMode']<4){
				$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_comments', FALSE);
			} else {
				//5
				$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_views_viewcountcomments', FALSE);
			}

		} elseif ($conf['topRatings.']['topRatingsrestrictToExternalPrefix']=='custom') {
			if ($externaltable!='') {
				if ($this->mmtable=='') {
					$this->mmtable=$externaltable;
				}

				if ($conf['topRatings.']['topRatingsMode']<4){
					$text_topratings .= ',';
				}

				$text_topratings .= ' '. ucfirst($this->pi_getLLWrap($pObj, 'comments_recent.' . $this->mmtable .'', FALSE));
			} else {
				if ($conf['topRatings.']['topRatingsMode']<4){
					$text_topratings .= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_allratedrecords', FALSE);
				} else {
					$text_topratings .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_allviewedrecords', FALSE);

				}

			}

		} else {
			$text_topratings .= ', Error with topRatingsrestrictToExternalPrefix:' . $conf['topRatings.']['topRatingsrestrictToExternalPrefix'];
		}

		if ((count($rowsmerged) == 0) || ((count($rowsmerged)>0) && ($rowsmerged[0]['nbrvotes']==''))) {

			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###NO_TOPRATINGS###');
			if ($template) {
				$textprob=$this->pi_getLLWrap($pObj, 'pi1_template.text_no_topratings', FALSE);
				if ($conf['topRatings.']['topRatingsMode']==4){
					$textprob=$this->pi_getLLWrap($pObj, 'pi1_template.text_no_topviews', FALSE);
				}

				if ($conf['topRatings.']['topRatingsMode']==5){
					$textprob=$this->pi_getLLWrap($pObj, 'pi1_template.text_no_topactivity', FALSE);
				}

				$retstr = $this->t3substituteMarkerArray($template, array (
						'###LL_TEXT_NO_TOPRATINGS###' => $textprob,
						'###TOPRATINGS_CONFIG_TITLE###' => $text_topratings. '<br />',
						'###TOPRATINGS_CONFIG_DETAIL###' => $topratings_ilike_vote_desc. '<br />',
						));
				return $retstr;

			}

		}

		$entries = array();
		$template= $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_TOPRATINGS###');
		$usetemplateFileratings= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['ratings.']['ratingsTemplateFile']);
		$usetemplateFileratings= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFileratings);
		$templateratings = $this->t3fileResource($pObj, $usetemplateFileratings);
		$okrowsi=0;
		$rank=1;

		foreach ($rowsmerged as $row) {

			$externalprefix=$row['pi1_key'];
			$this->mmtable=$row['pi1_table'];
			$prefix=$this->mmtable . '_';
			$refID = $row['refID'];
			$where = $this->mmtable. '.uid = ' . $refID;
			$ownershipok=1;

			if ($this->mmtable== 'fe_users') {
				$arr_groupmembers=explode(',', $this->usersGroupmembers($pObj, FALSE, $conf, TRUE));

				$arr_groupmembers=array_flip($arr_groupmembers);
				if (!array_key_exists($refID, $arr_groupmembers))  {
					$ownershipok=0;
					$pObj->reprtUserByID = TRUE;
				}

			}

			if ($ownershipok==1) {
				$skiprow=FALSE;
				if ($skiprow==FALSE) {
				 	$commentID = $row['refID'];
					if ($prefix == 'tt_content_') {

						if (version_compare(TYPO3_version, '7.0', '<')) {
							$exticon= '/typo3/sysext/cms/ext_icon.gif">';
						} else {
							$exticon= t3lib_extMgm::siteRelPath('toctoc_comments') . '/Resources/Public/Icons/x-content-text.png">';
						}
					} elseif ($prefix == 'tt_news_') {
						$exticon= t3lib_extMgm::siteRelPath('tt_news') . 'ext_icon.gif">';
					} elseif ($prefix == 'tt_products_') {
						$exticon= t3lib_extMgm::siteRelPath('tt_products') . 'ext_icon.gif">';
					} elseif ($prefix == 'tx_wecstaffdirectory_info_') {
						$exticon= t3lib_extMgm::siteRelPath('wec_staffdirectory') .	'ext_icon.gif">';
					} elseif ($prefix == 'fe_users_') {
						$pObj->reprtUserByID = TRUE;
						$exticon= $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
						$conf['theme.']['selectedTheme'] . '/img/usericon.gif">';
						$row['topratingsimagesfolder']=$conf['advanced.']['FeUserImagePath'];
					} else {
						if ($conf['theme.']['themeVersion'] == 2) {
							$exticon= $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/commentv2.png">';
						} else {
							$exticon= $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'ext_icon.gif">';
						}
					}

					$itemtitle = ucfirst($this->pi_getLLWrap($pObj, 'comments_recent.' . $this->mmtable .'', FALSE));

					if ($itemtitle !='') {
						$itemtitle='title="' . $itemtitle . '" ';
					}

					$titleimage = '<img class="tx-tc-rcentpic" width="14" height="14" valign="middle" ' . $itemtitle . 'src="' . $exticon;

					$commenttext =$row['text'];

					//picture handling
					$ratingimage='';
					$profileimgclass='tx-tc-trtpic';
					if (count(explode(',', $row['image']))>1) {
						$imgarr=explode(',', $row['image']);
						$row['image']=$imgarr[0];
					}

					if (strpos($row['topratingsimagesfolder'], '/')>1) {
						//there is a path
						if (trim ($row['image']) != '') {
							//there is an image
							$ratingimage=$row['topratingsimagesfolder'] . $row['image'];
						}

					} else {
						if (strrpos($row['image'], '/')>1) {
							//theres an image with path
							$ratingimage=$row['image'];
						}

					}

					$dirsep=DIRECTORY_SEPARATOR;
					$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

					$txdirname= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . $ratingimage);

					$tmpimgstr='';
					$styleheight='';
					$stylemargincontent=0;
					if (file_exists($txdirname)) {
						$userimgsize=$conf['topRatings.']['topratingsimagesize'];
						if ($ratingimage!='') {

							$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
							$img = array();
							$img['file'] = GIFBUILDER;
							$img['file.']['XY'] = '' . $userimgsize .',' . $userimgsize . '';
							$img['file.']['10'] = IMAGE;
							$img['file.']['10.']['file'] = $ratingimage;
							$img['file.']['10.']['file.']['width'] = $userimgsize .'c';
							$img['file.']['10.']['file.']['height'] = $userimgsize .'c';
							$img['params'] = 'class="' . $profileimgclass . '" title="'.$row['linktext']. '"';
							if (version_compare(TYPO3_version, '7.6', '<')) {
								$tmpimgimgstr = $pObj->cObj->IMAGE($img);
							} else {
								$tmpimgimgstr = $pObj->cObj->cObjGetSingle('IMAGE', $img);
							}

							$tmpimgstr = '<div class="tx-tc-trt-rating-img">'.str_replace($row['linktext'], $tmpimgimgstr, $row['link']) .'</div>';
							$styleheight=' tx-tc-trt-userisz';
							$stylemargincontent = $userimgsize+2*intval($conf['theme.']['boxmodelSpacing']);
							if ($conf['theme.']['selectedBoxmodelkoogled'] == 1) {
								$stylemargincontent = $stylemargincontent - 6;
							}

						}

					}

					if (strpos($row['link'], 'href=')>0) {

						if ($conf['ratings.']['useNumberOfVotes'] != 1) {
							$row['nbrvotes']='';
						} else {
							if ($fromusercenterid == 0) {
								if ($conf['topRatings.']['topRatingsMode']<4){
									if ($row['nbrvotes'] != 1) {
										$row['nbrvotes']='(' . $row['nbrvotes'] . ' ' . $this->pi_getLLWrap($pObj, 'api_rating.votes', FALSE) . ')';
									} else {
										$row['nbrvotes']='(' . $row['nbrvotes'] . ' ' . $this->pi_getLLWrap($pObj, 'api_rating.vote', FALSE) . ')';
									}
								} else {
									if ($conf['topRatings.']['topRatingsMode']==4){
										$row['nbrvotes']=', ' . $row['nbrvotes'] . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_count', FALSE) . ' ' .
										$this->pi_getLLWrap($pObj, 'pi1_template.text_views_viewcount', FALSE) . '';
									} else {
										$row['nbrvotes']='';
									}

								}
							} else {
								$row['nbrvotes']='(' . $this->formatDate($row['ratedate'], $pObj, FALSE, $conf) . ')';
							}

						}

						$subTemplate = $this->t3getSubpart($pObj, $templateratings, '###TEMPLATE_RATING###');
						$voteSub = $this->t3getSubpart($pObj, $templateratings, '###VOTE_LINK_SUB_OVERALLVOTE###');

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
							$refforvote='123';
							$check = '123';
							$apiratingtip='';
							If ($start!=-1) {
								$apiratingtip=$this->pi_getLLWrap($pObj, 'api_tipstar_' . $nextstep, FALSE);
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

						$hidecss ='';
						$markers = array(
								'###HIDECSS###' . $hidecss,
								'###PID###' => $pid,
								'###CID###' => $cid,
								'###HIDEVOTE###' => $strhidevote,
								'###REF###' => htmlspecialchars($refforvote),
								'###TEXT_SUBMITTING###' => $this->pi_getLLWrap($pObj, 'api_submitting', FALSE),
								'###TEXT_ALREADY_RATED###' => $this->pi_getLLWrap($pObj, 'api_already_rated', FALSE),
								'###BAR_WIDTH###' => $this->getBarWidth($row['voting'], $conf),
								'###COMMENT_DATE###' => $commentdatehtml,
								'###RATING###' => $rating_str,
								'###TEXT_RATING_TIP###' => $this->pi_getLLWrap($pObj, 'api_tip', FALSE),
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
						$voteingstr= '</div>' . $this->t3substituteMarkerArray($subTemplate, $markers) . '<div class="tx-tc-trt-rating-right">';
						$strdislike='';
						$strv2='';
						if ($conf['theme.']['themeVersion'] == 2) {
							$strv2='v2';
						}
						if ($row['emolikeid']>0) {
							//print $row['emolikeid'] . ' - ' ;
							$mylikepic= $emolikepicarr[$row['emolikeid']];
						} else {
							if ($row['likecount']>0) {
								$mylikepic='ilike'.$strv2.'.png';

							} else {
								$mylikepic='idislike'.$strv2.'.png';
								$row['likecount']=$row['likecount']*(-1);
								$strdislike='dis';

							}
						}

						$mylikepictitle=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_'.$strdislike.'likes', FALSE);
						if ($conf['topRatings.']['topRatingsMode']==4){
								$mylikepic='icon_views.png';
								$mylikepictitle=ucfirst($this->pi_getLLWrap($pObj, 'pi1_template.text_views_viewcount', FALSE));
						}

						if ($conf['topRatings.']['topRatingsMode']==5){
							$mylikepic='icon_activity.png';
							$mylikepictitle=ucfirst($this->pi_getLLWrap($pObj, 'pi1_template.activities', FALSE));
						}

						$addbr='';
						if ($row['emolikeid']==0) {
							$mylike = '<img class="tx-tc-trt-rating-like" alt="' . $mylikepictitle . '" title=" ' . $mylikepictitle
										. '" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
										$conf['theme.']['selectedTheme'] . '/img/' . $mylikepic . '" />';
						} else {
							$mylike = $mylikepic;
						}

						$titlelink = $row['link'];
						if ($conf['topRatings.']['topRatingsMode']==0){
							$topratings_ilike_vote= '&nbsp;' . str_replace('tx-tc-trt-rating-like', 'tx-tc-trt-rating-like-only', $mylike) . '<b>'.
							$row['likecount']. '</b> ';
							$addbr='<br />';
							if ($fromusercenterid == 0) {
								$row['nbrvotes']='';
							}
						} elseif ($conf['topRatings.']['topRatingsMode']==1){
							$topratings_ilike_vote=$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_rating', FALSE) . ':&nbsp;' .
							$voteingstr . $row['voting']. ' ';
						} elseif ($conf['topRatings.']['topRatingsMode']==2){
							$topratings_ilike_vote= $this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_rating', FALSE) . ':&nbsp;' .
							$voteingstr . $row['voting'] . '  ' . $this->middotchar . ' ' . $mylike . ' ' . $row['likecount'] . ' ';
						} elseif ($conf['topRatings.']['topRatingsMode']==3){
							$topratings_ilike_vote='' . $mylike . '<b> ' . round($row['likecount'], 1) . '</b> ' . $this->middotchar . ' ' .
							$this->pi_getLLWrap($pObj, 'pi1_template.text_topratings_rating', FALSE) . ':&nbsp;' . $voteingstr . $row['voting'] . ' ';
						} elseif ($conf['topRatings.']['topRatingsMode']==4){
							$topratings_ilike_vote='' . $mylike . '&nbsp;<b> ' . round($row['likecount'], 1) . '</b>' . $row['datefirstview'];
							$addbr='<br class="tx-tc-br-articleview">';
							$row['nbrvotes']='';
						} elseif ($conf['topRatings.']['topRatingsMode']==5){
							//activity
							$topratings_ilike_vote='' . $mylike . '&nbsp;<b> ' . round($row['likecount'], 1) . '</b>' . $row['datefirstview'];
							$addbr='<br class="tx-tc-br-articleview">';

							$row['nbrvotes']='';

						}

						$contenttxt='';

						//margin twice 3px, border 2*1px, width 20px + 8px padding
						$marginratingnumber = $conf['theme.']['boxmodelSpacing']-1;
						$paddingratingnumber = $conf['theme.']['boxmodelSpacing'];

						if ($stylemargincontent==0) {
							$margincontent= ' tx-tc-mrgcntnp-left';
						}
						else {
							$margincontent= ' tx-tc-mrgcnt-left';
						}
						if (trim($row['text']) != '') {
							$contenttxt = '<div class="tx-tc-trt-content' . $margincontent . '">' . $row['text'] . '</div>';
						}

						$rankstyle='';
						if ($rank==1){
							//gold
							$rankstyle=' tx-tc-rank1';
						} elseif ($rank==2){
							//silver
							$rankstyle=' tx-tc-rank2';
						} elseif ($rank==3){
							//bronze
							$rankstyle=' tx-tc-rank3';
						}
						$titledate = '';
						if ($row['date'] != '') {
							if ($conf['topRatings.']['RatedItemSeparatedDate'] == 1) {
								$titledate = ' &#124; ' . $row['date'];
							} else {
								$titledate = ' ' . $row['date'];
							}
							if ($conf['topRatings.']['RatedItemShowDate'] != 1) {
								$titledate = '';
							}

						}

						$titletxt='<div class="tx-tc-trt-entry' . $margincontent . '">' . $titleimage . $titlelink . $titledate . '</div>';

						$markerArray = array(
								'###TOPRATINGS_RANK###' => '<div class="tx-tc-trt-rating'.$rankstyle .'"><div class="tx-tc-trl-rank">' . $rank . '</div></div>',
								'###TOPRATINGS_ILIKE_VOTE###' => $topratings_ilike_vote,
								'###TOPRATINGS_NBRVOTES###' => $row['nbrvotes'],
								'###TOPRATINGS_IMG###' => $tmpimgstr,
								'###LINKTOPRATEDITEM###' => $titletxt,
								'###TOPRATINGS_CONTENT###' => $contenttxt,
								'###RCID###' => $_SESSION['commentListCount'].$okrowsi,
								'###STYLEHEIGHT###' => $styleheight,
								'###ADDBR###' => $addbr
						);

						$entries[] = $this->t3substituteMarkerArray($template, $markerArray);
						$okrowsi++;
						$rank=$rank+1;
					}

					// if not: link did not resolve -> not accessible to user - we skip
				}

				// if not: link did not resolve -> not accessible to user - we skip
			}

			if ($okrowsi>=$conf['topRatings.']['RatedItemsListCount']) {
				break;
			}

		}

		// output the entire plugin
		// Merge
		if (intval($fromusercenterid)==0) {
			$retstr = implode($entries);
		} else {
			$cntentries = count($entries);
			for ($i=0; (($i<$shownbritemsinusercenter) && ($i<$cntentries)); $i++) {
				$retstr .= $entries[$i];
			}

			for ($i=$shownbritemsinusercenter; $i<$cntentries; $i++) {
				$retstrinner .= $entries[$i];
			}

			if ($retstrinner !='') {
				$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###TOPSHARINGS_DROPDOWNSHOWMORE###'),
						array(
								'###DROPDOWNID###' => ($fromusercenterid+$fromusercenterid*10),
								'###DROPDOWNTIPTEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenter_showmoreorless', FALSE),
								'###DROPUPORDOWN###' => 'Down',
								'###TITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.text_usercenter_showmore', FALSE),
								'###CONTENT###' => $retstrinner,

						)
				);
			}

		}

		$subParts = array(
			'###SINGLE_TOPRATINGS###' => $retstr,
		);
		$retstr='';
		$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###TOPRATINGS_LIST###');
		$markers = array(
			'###TOPRATINGS_CONFIG_TITLE###' => $text_topratings . '<br />',
			'###TOPRATINGS_CONFIG_DETAIL###' => $topratings_ilike_vote_desc.$AlignResultsWithMaxVotesAndAvgVoteText. '<br />',
		);

		$retstr = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
		return $retstr;

	}
	/**
	 * generation of top sharings
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$fromusercenterid: ...
	 * @return	string		...
	 */
	public function topsharings ($conf, $pObj) {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$siteRelPath = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments');

		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}

		$pidcond='';
		if ($tmpint) {
			$conf['storagePid'] = intval($conf['storagePid']);
			$pidcond = 'deleted=0 AND pid='. $conf['storagePid'] . ' AND ';
		} else {
			$conf['storagePid'] = $GLOBALS['TYPO3_DB']->cleanIntList($conf['storagePid']);
			$pidcond = 'deleted=0 AND pid IN (' . $conf['storagePid'] . ') AND ';
		}

		$pidonlycond = ($tmpint ?
				'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')');
		$restrictor = $pidcond;

		$initarr = array();
		$initarr= $this->initconf($pidcond, $conf, $restrictor);
		$this->mmtabletoexternalprefix=$initarr['mmtabletoexternalprefix'];
		$this->mmtable=$initarr['mmtable'];
		$restrictor=$initarr['restrictor'];
		$externaltable=$initarr['externaltable'];
		$show_uid=$initarr['show_uid'];
		$displayfields=$initarr['displayfields'];

		$this->grandtotalsharecount = 0;
		$this->grandtotalshareurlcount = 0;

		//pickout valid pages
		$querymerged='SELECT DISTINCT
tx_toctoc_comments_sharing.reference AS reference, pages.uid AS uid, pages.title AS title
FROM tx_toctoc_comments_sharing, pages
WHERE pages.uid = tx_toctoc_comments_sharing.reference
AND pages.deleted = 0 and pages.hidden= 0';
		$pageslinkable = array();
		$pl = 0;
		$resultpages= $GLOBALS['TYPO3_DB']->sql_query($querymerged);

		$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
		$no_cacheflag = 0;

		if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) ==0) {
			if ($useCacheHashNeeded == 1) {
				$no_cacheflag = 1;
			}

		}

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

		$comma ='';
		$in = '';
		$paramarr = array();
		if ($no_cacheflag == 1) {
			$paramarr['no_cache']=1;
		}

		$params=t3lib_div::implodeArrayForUrl('', $paramarr, '', 1);

		while ($rowspages = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultpages)) {
			$conflink = array(
					'useCacheHash'     => $useCacheHashNeeded,
					'parameter'        => $rowspages['uid'],
					'additionalParams' => $params,
					'ATagParams' => 'rel="nofollow"',
					'forceAbsoluteUrl' => 1,
				);
			$textorig = $rowspages['title'];
			$text = $this->cObj->typoLink($textorig, $conflink);
			if (str_replace('cHash=', '', $text) == $text) {
				$text = str_replace('&no_cache=1', '', $text);
				$text = str_replace('?no_cache=1', '', $text);
			}

			$linkpurearr = explode('"', $text);
			$linkpure = $linkpurearr[1];
			if (strpos($text, 'href=') != 0) {
				if (strlen($textorig) < strlen($text)) {
					// linkable
					$pageslinkable[$pl] = array();
					$pageslinkable[$pl]['uid'] = $rowspages['uid'];
					$pageslinkable[$pl]['link'] = $text;
					$pageslinkable[$pl]['linkpure'] = $linkpure;
					$pl++;
					$in .= $comma . $rowspages['uid'];
					$comma = ',';
				}

			}

		}

		if ($in != '') {
			if (str_replace(',', '', $in) == $in) {
				$in = '=' . $in;
			} else {
				$in = ' IN(' . $in . ')';
			}

		}

		$checkdate = time();
		$checkdateinfo = '';
		if (intval($conf['topSharings.']['topSharingsLookBackDays']) != 0) {
			$checkdate = $checkdate - 86000 * intval($conf['topSharings.']['topSharingsLookBackDays']);
			$tmp=$conf['advanced.']['dateFormatOldStyle'];
			$conf['advanced.']['dateFormatOldStyle'] = 1;
			$checkdateinfo = ', ' . $this->formatDate(($checkdate-2000), $pObj, FALSE, $conf);
			$conf['advanced.']['dateFormatOldStyle']=$tmp;
		}

		$querymerged='SELECT sharer, reference, shareurl, deleted, crdate, sharecount, external_prefix, external_ref, sys_language_uid as lang
		FROM tx_toctoc_comments_sharing
		GROUP BY sharer, crdate, sharecount, reference, shareurl, deleted, external_prefix, external_ref, sys_language_uid
		HAVING deleted = 0 AND reference' . $in . ' AND crdate < ' . $checkdate . ' ORDER BY reference, shareurl, sharer, crdate DESC';

		$resultshares= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
		$i=0;
		$selectedshares=array();

		while ($rowsshares = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultshares)) {
			// reorder fields and skip rows

			if ((($lastsharer == $rowsshares['sharer']) && ($lastreference == $rowsshares['reference']) &&
					($lastshareurl == $rowsshares['shareurl']))==FALSE) {
				$lastsharer = $rowsshares['sharer'];
				$lastreference = $rowsshares['reference'];
				$lastshareurl = $rowsshares['shareurl'];
				$pickupshare = TRUE;

			} else {
				$pickupshare = FALSE;
			}

			if ($pickupshare == TRUE) {
				$selectedshares[$i]['crdate'] = $rowsshares['crdate'];
				$selectedshares[$i]['sharecount'] = $rowsshares['sharecount'];
				$selectedshares[$i]['sharer'] = $rowsshares['sharer'];
				$selectedshares[$i]['reference'] = $rowsshares['reference'];
				$selectedshares[$i]['shareurl'] = $rowsshares['shareurl'];
				$selectedshares[$i]['external_prefix'] = $rowsshares['external_prefix'];
				$selectedshares[$i]['external_ref'] = $rowsshares['external_ref'];
				$selectedshares[$i]['lang'] = $rowsshares['lang'];
				for ($p=0;p<$pl;$p++) {
					if ($pageslinkable[$p]['uid']==$rowsshares['reference']){
						$selectedshares[$i]['referenceurl'] = $pageslinkable[$p]['link'];
						$selectedshares[$i]['referencelink'] = $pageslinkable[$p]['linkpure'];
						break;
					}

				}

				$i++;
			}

		}

		// now selectedshares holds the valid shares for $checkdate
		$sumtotalshares=0;
		$countselectedshares = count($selectedshares);
		$outputedshares = array();
		$op=0;

		if ($conf['topSharings.']['topSharingsMode']== 0) {
			// aggregate by sharer
			for ($d=0; $d<$countselectedshares; $d++) {
				$currentsharer = $selectedshares[$d]['sharer'];
				$o_isfound = FALSE;
				for ($o=0; $o<$op; $o++) {
					if ($currentsharer == $outputedshares[$o]['sharer']){
						$o_isfound = TRUE;
						break;
					}

				}

				if ($o_isfound == TRUE) {

				// add sharecount to sharer, add share url to shareurls subarray
					$outputedshares[$o]['sharecount'] += $selectedshares[$d]['sharecount'];
					$outputedshares[$o]['shareurlcount'] += 1;
					$shareurlindex= $outputedshares[$o]['shareurlcount']-1;
					$outputedshares[$o]['shareurls'][$shareurlindex]['sharecount'] = $selectedshares[$d]['sharecount'];
					$outputedshares[$o]['shareurls'][$shareurlindex]['url'] = $selectedshares[$d]['shareurl'];
					$outputedshares[$o]['shareurls'][$shareurlindex]['reference'] = $selectedshares[$d]['reference'];
					$outputedshares[$o]['shareurls'][$shareurlindex]['ref'] = $selectedshares[$d]['external_ref'];
					$outputedshares[$o]['shareurls'][$shareurlindex]['referenceurl'] = $selectedshares[$d]['referenceurl'];
					$outputedshares[$o]['shareurls'][$shareurlindex]['referencelink'] = $selectedshares[$d]['referencelink'];
					$outputedshares[$o]['shareurls'][$shareurlindex]['lang'] = $selectedshares[$d]['lang'];
				} else {
					$outputedshares[$op]['sharecount'] = $selectedshares[$d]['sharecount'];
					$outputedshares[$op]['sharer'] = $currentsharer;
					$outputedshares[$op]['shareurlcount'] = 1;
					$shareurlindex= $outputedshares[$op]['shareurlcount']-1;
					$outputedshares[$op]['shareurls'] = array();
					$outputedshares[$op]['shareurls'][$shareurlindex]['sharecount'] = $selectedshares[$d]['sharecount'];
					$outputedshares[$op]['shareurls'][$shareurlindex]['url'] = $selectedshares[$d]['shareurl'];
					$outputedshares[$op]['shareurls'][$shareurlindex]['reference'] = $selectedshares[$d]['reference'];
					$outputedshares[$op]['shareurls'][$shareurlindex]['ref'] = $selectedshares[$d]['external_ref'];
					$outputedshares[$op]['shareurls'][$shareurlindex]['referenceurl'] = $selectedshares[$d]['referenceurl'];
					$outputedshares[$op]['shareurls'][$shareurlindex]['referencelink'] = $selectedshares[$d]['referencelink'];
					$outputedshares[$op]['shareurls'][$shareurlindex]['lang'] = $selectedshares[$d]['lang'];
					$op++;
				}

			}

			if (is_array($outputedshares)) {
				if (count($outputedshares) > 0) {
					rsort($outputedshares);
				}

			}

			$countoutput = count($outputedshares);
			for ($o=0; $o<$countoutput; $o++) {
				$outputedsharestenr = array();
				$outputedsharestenr = $outputedshares[$o]['shareurls'];
				$outputedshares[$o]['shareurls'] = $this->enrichrows($conf, $outputedsharestenr, $pObj, $show_uid);
				if (is_array($outputedshares[$o]['shareurls'])) {
					if (count($outputedshares[$o]['shareurls']) > 0) {
						rsort($outputedshares[$o]['shareurls']);
					}

				}

			}

		} elseif ($conf['topSharings.']['topSharingsMode']== 1) {
			// aggregate by page
			for ($d=0; $d<$countselectedshares; $d++) {
				$currentshareurl = $selectedshares[$d]['shareurl'];

				$o_isfound = FALSE;
				for ($o=0; $o<$op; $o++) {
					if ($currentshareurl == $outputedshares[$o]['url']){
						$o_isfound = TRUE;
						break;
					}
				}

				if ($o_isfound == TRUE) {
					// add sharecount to sharer, add share url to shareurls subarray
					$outputedshares[$o]['sharecount'] += $selectedshares[$d]['sharecount'];
					$outputedshares[$o]['sharerscount'] += 1;
					$outputedshares[$o]['reference'] = $selectedshares[$d]['reference'];
					$outputedshares[$o]['referenceurl'] = $selectedshares[$d]['referenceurl'];
					$outputedshares[$o]['referencelink'] = $selectedshares[$d]['referencelink'];
					$outputedshares[$o]['ref'] = $selectedshares[$d]['external_ref'];
					$outputedshares[$o]['lang'] = $selectedshares[$d]['lang'];
					$outputedshares[$o]['url'] = $currentshareurl;
					$sharersindex= $outputedshares[$o]['sharerscount']-1;
					$outputedshares[$o]['sharers'][$sharersindex]['sharecount'] = $selectedshares[$d]['sharecount'];
					$outputedshares[$o]['sharers'][$sharersindex]['sharer'] = $selectedshares[$d]['sharer'];
				} else {
					$outputedshares[$op]['sharecount'] = $selectedshares[$d]['sharecount'];
					$outputedshares[$op]['sharerscount'] = 1;
					$outputedshares[$op]['reference'] = $selectedshares[$d]['reference'];
					$outputedshares[$op]['referenceurl'] = $selectedshares[$d]['referenceurl'];
					$outputedshares[$op]['referencelink'] = $selectedshares[$d]['referencelink'];
					$outputedshares[$op]['ref'] = $selectedshares[$d]['external_ref'];
					$outputedshares[$op]['lang'] = $selectedshares[$d]['lang'];
					$outputedshares[$op]['url'] = $currentshareurl;
					$sharersindex= $outputedshares[$op]['sharerscount']-1;
					$outputedshares[$op]['sharers'] = array();
					$outputedshares[$op]['sharers'][$sharersindex]['sharecount'] = $selectedshares[$d]['sharecount'];
					$outputedshares[$op]['sharers'][$sharersindex]['sharer'] = $selectedshares[$d]['sharer'];
					$op++;
				}

			}

			$outputedshares = $this->enrichrows($conf, $outputedshares, $pObj, $show_uid, TRUE);

			if (is_array($outputedshares)) {
				if (count($outputedshares) > 0) {
					rsort($outputedshares);
				}

			}

			$countoutput = count($outputedshares);
			for ($o=0; $o<$countoutput; $o++) {
				if (is_array($outputedshares[$o]['sharers'])) {
					if (count($outputedshares[$o]['sharers']) > 0) {
						rsort($outputedshares[$o]['sharers']);
					}

				}

			}

		}

		$retstr = 	'';
		if ($conf['topSharings.']['topSharingsMode']== 0) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_TOPSHARINGSSHAREURL###');
			$dropdowntiptext = $this->pi_getLLWrap($pObj, 'pi1_template.text_topsharings_showorhidesharedurls', FALSE);
			$textgrandtotaldetail = '';

		} else {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_TOPSHARINGSSHARER###');
			$dropdowntiptext = $this->pi_getLLWrap($pObj, 'pi1_template.text_topsharings_showorhidesharers', FALSE);
			$textgrandtotaldetail = ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.text_on', FALSE) .
			' ' . $this->grandtotalshareurlcount . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.topsharings_webpages', FALSE);
		}

		$countoutput = count($outputedshares);
		for ($o=0; $o<$countoutput; $o++) {
			$details='';
			if ($conf['topSharings.']['topSharingsMode']== 0) {
				$countdetailsoutput= count($outputedshares[$o]['shareurls']);
			} else {
				$countdetailsoutput= count($outputedshares[$o]['sharers']);
			}

			$entries = array();
			for ($d=0; $d<$countdetailsoutput; $d++) {
				if ($conf['topSharings.']['topSharingsMode']== 0) {
					$hereSharedAs = '';
					if ($outputedshares[$o]['shareurls'][$d]['url'] != $outputedshares[$o]['shareurls'][$d]['linkfinalpure']) {
						$hereSharedAs = '<br><small>' . $this->pi_getLLWrap($pObj, 'pi1_template.topsharings_sharedas', FALSE) .
						' ' . $outputedshares[$o]['shareurls'][$d]['url'] . '</small>';
					}

					$markerArray = array(
							'###SHAREURL###' => $outputedshares[$o]['shareurls'][$d]['link'] . $hereSharedAs,
							'###SHARECOUNT###' =>  $this->human_sharesize($outputedshares[$o]['shareurls'][$d]['sharecount']),
					);
				} else {
					$markerArray = array(
							'###SHARER###' => $outputedshares[$o]['sharers'][$d]['sharer'],
							'###SHARECOUNT###' => $this->human_sharesize($outputedshares[$o]['sharers'][$d]['sharecount']),
					);
				}

				$entries[] = $this->t3substituteMarkerArray($template, $markerArray);
			}

			$details = implode($entries);

			$markers = array();
			$hereSharedAs = '';
			if ($outputedshares[$o]['url'] != $outputedshares[$o]['linkfinalpure']) {
				$hereSharedAs = ' <small>' . $this->pi_getLLWrap($pObj, 'pi1_template.topsharings_sharedas', FALSE) .
						' ' . $outputedshares[$o]['url'] . '</small>';
			}
			$countoutput=intval($outputedshares[$o]['sharecount']);
			$this->grandtotalsharecount += $countoutput;
			$countoutputfmt=$this->human_sharesize($countoutput);
			if ($conf['topSharings.']['topSharingsMode']== 0) {
				$subParts = array(
					'###SINGLE_TOPSHARINGSSHAREURL###' => $details,
				);
				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###TOPSHARINGSSHAREURL_LIST###');
				$boxtitle = $outputedshares[$o]['sharer'] . ' (' . trim($countoutputfmt) . ')';
				$sharertitle= ' tx-tc-sharertitle sharer' . $outputedshares[$o]['sharer'];
			} else {
				$subParts = array(
						'###SINGLE_TOPSHARINGSSHARER###' => $details,
				);
				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###TOPSHARINGSSHARER_LIST###');
				$boxtitle = $outputedshares[$o]['link'] . ' (' . trim($countoutputfmt) . ')' . $hereSharedAs;
				$sharertitle= '';
			}

			$content = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
			if ($countoutput > 0) {
				$retstr .= $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###TOPSHARINGS_DROP_DOWN###'),
					array(
							'###DROPDOWNID###' => $o,
							'###DROPDOWNTIPTEXT###' => $dropdowntiptext,
							'###DROPUPORDOWN###' => 'Up',
							'###TITLE###' => $boxtitle,
							'###SHARERCSS###' => $sharertitle,
							'###CONTENT###' => $content,

					)
				);
			}

		}

		$text_topsharingstitle = $this->pi_getLLWrap($pObj, 'pi1_template.text_topsharingstitle', FALSE) . ' - ' . $this->grandtotalsharecount .
		' ' . $this->pi_getLLWrap($pObj, 'pi1_template.topsharings_sharesintotal', FALSE) . $textgrandtotaldetail;

		$retstrout = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###TOPSHARINGS###'),
				array(
				'###TOPSHARINGSOFTITLE###' => $text_topsharingstitle . $checkdateinfo,
				'###TOPSHARINGSCONTENT###' => $retstr,
				)
		);

		$retstrout = $pObj->pi_wrapInBaseClass(str_replace(' class="toctoc-comments-pi1"', '', $retstrout));
		return $retstrout;

	}

	/**
	 * Returns human numberformat for shares
	 *
	 * @param	[type]		$bytes: ...
	 * @param	[type]		$decimals: ...
	 * @return	string		...
	 */
	private function human_sharesize($bytes, $decimals = 1) {
		$sz = ' KMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		if ($factor==0) {
			$decimals = 0;
		}
		$ret = sprintf('%.' .$decimals . 'f', $bytes / pow(1024, $factor)) . @$sz[$factor];
		return $ret;
	}

	/**
	 * enriches rows by links to pages which are accessible to currentuser, filters out unaccessible pages
	 *
	 * @param	[type]		$bytes: ...
	 * @param	[type]		$decimals: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$show_uid: ...
	 * @param	[type]		$input_sys_language_uid: ...
	 * @return	string		...
	 */
	private function enrichrows($conf, $rowsmerged, $pObj, $show_uid, $input_sys_language_uid = FALSE) {

		$countrowsmergedout3=count($rowsmerged);
		for ($i=0; $i<$countrowsmergedout3; $i++) {
			// from $rowsmerged[$i]['ref'] get the table name and id
			$input_sys_language_uid = 0;
			if ($input_sys_language_uid == TRUE) {
				$input_sys_language_uid = $rowsmerged[$i]['lang'];
			}
			$pageidrecord=$rowsmerged[$i]['ref'];
			// zb tt_news_21
			$prefix=$pageidrecord;
			$posbeforeid = strrpos($pageidrecord, '_')+1;

			$prefix=substr($pageidrecord, 0, $posbeforeid);
			$this->mmtable=substr($pageidrecord, 0, $posbeforeid-1);

			$refID = substr($pageidrecord, $posbeforeid);
			if (str_replace('ext', '', $refID) != $refID) {
				$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $refID));
				list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
						'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

				if (trim($uidrow['externaluid']) != '') {
					$rowsmerged[$i]['ref'] = str_replace($refID, $uidrow['externaluid'], $rowsmerged[$i]['ref']);
					$refID = $uidrow['externaluid'];
				}

			}

			if (!is_array($_SESSION['prefixes'])) {
				$displayfieldsareset = FALSE;
				$topratingsimagesfolderset = FALSE;
				$_SESSION['prefixes']=array();
				$where = 'deleted=0 ';
				$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table,
								show_uid as show_uid, displayfields As displayfields, topratingsdetailpage As topratingsdetailpage,
							topratingsimagesfolder AS topratingsimagesfolder',
						'tx_toctoc_comments_prefixtotable',
						$where,
						'',
						'',
						''
				);

				$countrowstitle=count($rowstitle);
				for ($j; $j<$countrowstitle; $j++){
					$_SESSION['prefixes'][$rowstitle[$j]['pi1_key']]=$rowstitle[$j];
					if (trim($rowstitle[$j]['displayfields'])!='') {
						$displayfieldsareset = TRUE;
					}

					if (trim($rowstitle[$j]['topratingsimagesfolder'])!='') {
						$topratingsimagesfolderset = TRUE;
					}

				}

				if (($displayfieldsareset==FALSE) || ($topratingsimagesfolderset==FALSE)) {
					// make an initial set of displayfields in the db and reload
					if ($displayfieldsareset==FALSE) {
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='title tstamp image sys_language_uid, short' WHERE pi1_key='tx_ttnews'");
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='title image, subtitle' WHERE pi1_key='tt_products'");
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='full_name start_date photo_main sys_language_uid, biography' WHERE pi1_key='tx_rouge'");
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='full_name start_date photo_main sys_language_uid, biography' WHERE pi1_key='tx_wecstaffdirectory_pi1'");
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='first_name last_name image' WHERE pi1_key='tx_community'");
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='first_name last_name image' WHERE pi1_key='tx_cwtcommunity_pi1'");
						$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET
									displayfields='title teaser tstamp sys_language_uid, bodytext' WHERE pi1_key='tx_news_pi1'");
					}

					if ($topratingsimagesfolderset==FALSE) {
						$ctemp=array();
						if (t3lib_extMgm::isLoaded('tt_news')) {
							$imguploadpath=$conf['advanced.']['FeUserImagePath'];
							$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET topratingsimagesfolder='".
									$imguploadpath."' WHERE pi1_key='tx_ttnews'");
						}

						if (t3lib_extMgm::isLoaded('tt_products')) {
							$ctemp= $this->getDefaultConfig('tt_products');
							$imguploadpath=$ctemp['defaultImageDir'];
							$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET topratingsimagesfolder='".
									$imguploadpath."' WHERE pi1_key='tt_products'");
						}

						if (t3lib_extMgm::isLoaded('wec_staffdirectory')) {
							$ctemp= $this->getDefaultConfig('tx_wecstaffdirectory_pi1');
							$imguploadpath=$ctemp['altImageDir'];
							if (($ctemp['useFEPhoto']==1) || ($imguploadpath=='')){
								$imguploadpath=$conf['advanced.']['FeUserImagePath'];
							}

							$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET topratingsimagesfolder='".
									$imguploadpath."' WHERE pi1_key='tx_rouge'");
							$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET topratingsimagesfolder='".
									$imguploadpath."' WHERE pi1_key='tx_wecstaffdirectory_pi1'");
						}

						if (t3lib_extMgm::isLoaded('community')) {
							$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET topratingsimagesfolder='".
									$conf['advanced.']['FeUserImagePath']."' WHERE pi1_key='tx_community'");
						}

						if (t3lib_extMgm::isLoaded('cwt_community')) {
							$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_comments_prefixtotable SET topratingsimagesfolder='".
									$conf['advanced.']['FeUserImagePath']."' WHERE pi1_key='tx_cwtcommunity_pi1'");
						}

					}

				}

				$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table,
								show_uid as show_uid, displayfields AS displayfields, topratingsdetailpage AS topratingsdetailpage,
							topratingsimagesfolder AS topratingsimagesfolder',
						'tx_toctoc_comments_prefixtotable',
						$where,
						'',
						'',
						''
				);
				$countrowstitle2=count($rowstitle);
				for ($j=0; $j<$countrowstitle2; $j++){
					$_SESSION['prefixes'][$rowstitle[$j]['pi1_key']]=array();
					$_SESSION['prefixes'][$rowstitle[$j]['pi1_key']]=$rowstitle[$j];
					$_SESSION['prefixes']['tbl' . $rowstitle[$j]['pi1_table']]=array();
					$_SESSION['prefixes']['tbl' . $rowstitle[$j]['pi1_table']]=$rowstitle[$j];

					if ($rowstitle[$j]['displayfields']!='') {
						$displayfieldsareset = TRUE;
					}

				}

				$_SESSION['prefixes']['tt_content']['pi1_key'] ='';

				$_SESSION['prefixes']['tt_content']['pi1_table'] ='tt_content';
				$_SESSION['prefixes']['tt_content']['displayfields'] = 'header crdate image sys_language_uid, bodytext';
				$_SESSION['prefixes']['tt_content']['show_uid'] = '';
				$_SESSION['prefixes']['tt_content']['topratingsimagesfolder'] = $conf['advanced.']['FeUserImagePath'];
				if (version_compare(TYPO3_version, '4.99', '>')) {
					$_SESSION['prefixes']['tt_content']['topratingsimagesfolder'] = 'fileadmin/_migrated/pics/';
				}

				$_SESSION['prefixes']['tbltt_content']['pi1_table'] ='tt_content';
				$_SESSION['prefixes']['tbltt_content']['pi1_key'] ='tt_content';

				$_SESSION['prefixes']['tx_toctoc_comments_comments']['pi1_key'] ='';
				$_SESSION['prefixes']['tx_toctoc_comments_comments']['pi1_table'] =  'tx_toctoc_comments_comments';
				$_SESSION['prefixes']['tx_toctoc_comments_comments']['displayfields'] =  'firstname lastname crdate, content';
				$_SESSION['prefixes']['tx_toctoc_comments_comments']['show_uid'] = '';

				$_SESSION['prefixes']['tbltx_toctoc_comments_comments']['pi1_table'] ='tx_toctoc_comments_comments';
				$_SESSION['prefixes']['tbltx_toctoc_comments_comments']['pi1_key'] ='tx_toctoc_comments_comments';

				$_SESSION['prefixes']['pages']['pi1_key'] ='';

				$_SESSION['prefixes']['pages']['pi1_table'] ='pages_language_overlay';
				$_SESSION['prefixes']['pages']['displayfields'] = 'title crdate sys_language_uid, subtitle';
				$_SESSION['prefixes']['pages']['show_uid'] = '';
				$_SESSION['prefixes']['pages']['topratingsimagesfolder'] = $conf['advanced.']['FeUserImagePath'];
				if (version_compare(TYPO3_version, '4.99', '>')) {
					$_SESSION['prefixes']['pages']['topratingsimagesfolder'] = 'fileadmin/_migrated/pics/';
				}

				$_SESSION['prefixes']['tblpages']['pi1_table'] ='pages_language_overlay';
				$_SESSION['prefixes']['tblpages']['pi1_key'] ='pages_language_overlay';

				$_SESSION['prefixes']['pages_language_overlay']['pi1_key'] ='';

				$_SESSION['prefixes']['pages_language_overlay']['pi1_table'] ='pages_language_overlay';
				$_SESSION['prefixes']['pages_language_overlay']['displayfields'] = 'title crdate sys_language_uid, subtitle';
				$_SESSION['prefixes']['pages_language_overlay']['show_uid'] = '';
				$_SESSION['prefixes']['pages_language_overlay']['topratingsimagesfolder'] = $conf['advanced.']['FeUserImagePath'];
				if (version_compare(TYPO3_version, '4.99', '>')) {
					$_SESSION['prefixes']['pages_language_overlay']['topratingsimagesfolder'] = 'fileadmin/_migrated/pics/';
				}

				$_SESSION['prefixes']['tblpages_language_overlay']['pi1_table'] ='pages_language_overlay';
				$_SESSION['prefixes']['tblpages_language_overlay']['pi1_key'] ='pages_language_overlay';

			}

			// read from Session or Prefixtotable map the fields
			$rowsmerged[$i]['refID']=$refID;

			if (($conf['topRatings.']['topRatingsExternalPrefix'] == '') || ($this->mmtabletoexternalprefix == TRUE)) {
				$this->mmtabletoexternalprefix = TRUE;
				$conf['topRatings.']['topRatingsExternalPrefix'] = $_SESSION['prefixes']['tbl' . $this->mmtable]['pi1_key'];
			}

			$rowsmerged[$i]['pi1_key'] = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['pi1_key'];
			$rowsmerged[$i]['pi1_table'] = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['pi1_table'];
			$rowsmerged[$i]['show_uid'] = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['show_uid'];
			$rowsmerged[$i]['topratingsdetailpage'] = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['topratingsdetailpage'];
			$rowsmerged[$i]['topratingsimagesfolder'] = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['topratingsimagesfolder'];
			$tmmtable = $this->mmtable;
			$rowsdisplay = array();
			$deadtca = TRUE;
			if (intval($refID) != 0) {
				if (is_array($GLOBALS['TCA'][$tmmtable])) {
					$deadtca = FALSE;
					$where = 'uid=' . $refID . ' ' . $this->enableFields($tmmtable, $pObj);
					$tmpdisplayfields = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['displayfields'];
					if ($this->mmtable == 'pages') {
						if ($rowsmerged[$i]['lang'] == 0) {
							$tmpdisplayfields = str_replace('sys_language_uid, ', '', $tmpdisplayfields);
						}
					}

					$sorting = '';
					$addparamforextensionswithoutsyslanguid = '';
					If ((strrpos($tmpdisplayfields, 'sys_language_uid') > 0) &&
							($GLOBALS['TSFE']->sys_language_uid > 0)) {
						$where = '((uid=' . $refID . ') OR (l18n_parent=' . $refID . ' AND sys_language_uid=' . $GLOBALS['TSFE']->sys_language_uid . ')) '  .
								$this->enableFields($tmmtable, $pObj);
						$sorting = 'sys_language_uid DESC';
					}

					if (($this->mmtable == 'pages') || ($this->mmtable == 'pages_language_overlay')) {
						if ($input_sys_language_uid != 0) {
							$tmmtable = 'pages_language_overlay';
							$where = '(pid=' . $refID . ' AND sys_language_uid=' . $input_sys_language_uid . ') '  .
									$this->enableFields($tmmtable, $pObj);
						}  else {
							$where = '(uid=' . $refID . ') '  .
									$this->enableFields($tmmtable, $pObj);
							$sorting = '';
						}
					}

					If ((strrpos($tmpdisplayfields, 'sys_language_uid') == 0) &&
							($GLOBALS['TSFE']->sys_language_uid > 0)) {
						if (($this->mmtable != 'tx_toctoc_comments_comments') && ($this->mmtable != 'pages') && ($this->mmtable != 'pages_language_overlay')) {
							$addparamforextensionswithoutsyslanguid = '&L=0';
						}

					}
				}

			} else {
				$deadtca = FALSE;
				$displayfieldsforselect = 'title crdate sys_language_uid, subtitle';
				$tmpdisplayfields = $displayfieldsforselect;
				If ($GLOBALS['TSFE']->sys_language_uid > 0) {
					$sorting = 'sys_language_uid DESC';
				}

				if ($rowsmerged[$i]['topratingsdetailpage'] == 0) {
					$rowsmerged[$i]['topratingsdetailpage'] = $rowsmerged[$i]['pageid'];
				}

				if ($input_sys_language_uid != 0) {
					$tmmtable = 'pages_language_overlay';
					$where = '(pid=' . $rowsmerged[$i]['topratingsdetailpage'] . ' AND sys_language_uid=' . $input_sys_language_uid . ') '  .
							$this->enableFields($tmmtable, $pObj);
				}  else {
					$tmmtable = 'pages';
					$where = '(uid=' . $rowsmerged[$i]['topratingsdetailpage'] . ') '  .
							$this->enableFields($tmmtable, $pObj);
					$sorting = '';
				}
			}

			if ($deadtca == FALSE) {
				$displayfieldsarrexplode1 = explode(', ', $tmpdisplayfields);
				$displayfieldsarrexplode2=array();
				$longtextdisplayfield = '';
				if (count($displayfieldsarrexplode1)>1) {
					$longtextdisplayfield = $displayfieldsarrexplode1[1];
					$countdisplayfieldsarrexplode1 = count($displayfieldsarrexplode1);
					for ($g=0; $g<$countdisplayfieldsarrexplode1; $g++){
						$displayfieldsarrexplode2 = array_merge($displayfieldsarrexplode2, explode(' ', $displayfieldsarrexplode1[$g]));
					}

					$displayfieldsforselect = implode (', ', $displayfieldsarrexplode2);
				} else {
					$displayfieldsarrexplode2 = explode(' ', $tmpdisplayfields);
					$displayfieldsforselect = implode (', ', $displayfieldsarrexplode2);
				}
				// Select data from Table
				if ($this->mmtable == 'tt_content') {
					$displayfieldsforselect .= ', uid, pid';
				}
				if (intval($refID) != 0) {
					if (($this->mmtable == 'pages') || ($this->mmtable == 'pages_language_overlay')) {
						if ($input_sys_language_uid == 0) {
							$displayfieldsforselect = str_replace('sys_language_uid,', '', $displayfieldsforselect);
						}
					}
				} else {
					if ($input_sys_language_uid == 0) {
						$displayfieldsforselect = str_replace('sys_language_uid,', '', $displayfieldsforselect);
					}
				}

				$rowsdisplay = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						$displayfieldsforselect,
						$tmmtable,
						$where,
						'',
						$sorting,
						''
				);
				$rowsdisplaycompressed = array();

				// Create link text, cropping texts to topRatingsTextCropLength chars max
				if (count($rowsdisplay)>0) {
					if ($this->mmtable=='tt_content') {
						$tt_contentUid = $rowsdisplay[0]['uid'];
						$tt_contentPid = $rowsdisplay[0]['pid'];
						$syslanid = $rowsdisplay[0]['sys_language_uid'];
					}
					$k=0;
					$rowsdisplaycompressed = array();
					foreach($rowsdisplay[0] as $key=>$val) {
						$tmpdisplayfieldswork=$tmpdisplayfields;
						if (($key== 'crdate') || ($key== 'tstamp') || ($key== 'datetime') || ($key== 'start_date')) {
							if (intval($val) != 0) {
								$rowsdisplaycompressed[4] = $this->formatDate($val, $pObj, FALSE, $conf);
							} else {
								$rowsdisplaycompressed[4] = '';
							}
						} elseif ((substr($key, 0, 5)== 'image') || (substr($key, 0, 5)== 'photo') || ($key== 'picture')) {
							if (intval($val) == 0) {
								$rowsdisplaycompressed[3] = $val;
							} else {
								$dataWhereContentPic = 'sys_file_reference.tablenames="tt_content" AND sys_file_reference.uid_foreign=tt_content.uid ' .
										'AND sys_file_reference.deleted=0 AND sys_file_reference.uid_local=sys_file.uid ' .
										'AND sys_file_reference.sys_language_uid=' .$syslanid .' AND tt_content.uid = ' . $tt_contentUid;

								$sqlstr = 'SELECT sys_file_reference.uid, sys_file_reference.uid, sys_file_reference.pid, sys_file_reference.uid_foreign,
												sys_file_reference.uid_local,sys_file.name AS image6, tt_content.image FROM ' .
														'tt_content, sys_file_reference , sys_file WHERE ' . $dataWhereContentPic;
								$resultContentPic = $GLOBALS['TYPO3_DB']->sql_query($sqlstr);
								$rowStats = array();
								$rowStats = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultContentPic);
								if (count($rowStats) >0) {
									if ($rowStats['image6']) {
										$rowsdisplaycompressed[3] = $rowStats['image6'];
									} else {
										$rowsdisplaycompressed[3] = $rowStats[0]['image6'];
									}
								} else {
									$rowsdisplaycompressed[3] = '';
								}

							}
						} elseif ($key== 'sys_language_uid') {
							$rowsdisplaycompressed[2] = $val;
						} elseif ($key== 'uid') {
							$rowsdisplaycompressed[5] = $val;
						} elseif ($key== 'pid') {
							$rowsdisplaycompressed[6]= $val;
						} else {
							$rowsdisplaycompressed[$k] = $rowsdisplaycompressed[$k] . ' ' . $val;  //ex.: first_name last_name - this gets concat here
						}

						if (str_replace($key . ' ', '', $tmpdisplayfieldswork)==$tmpdisplayfields){
							//not in sequence, the second string has to be started, because the displayfield is not separated by ' ' but by ', '

							if ($rowsdisplaycompressed[$k] == ''){
								$rowsdisplaycompressed[$k] = $val;
							}

							$rowsdisplaycompressed[$k] = trim($rowsdisplaycompressed[$k]);
							$k++;
						}

					}

				}

				If (($conf['topRatings.']['topRatingsOriginalLangDisplay']==1) || ($rowsdisplaycompressed[0]=='')) {
					if (count($rowsdisplay)>1) {
						$rowsdisplaycompressedzerosave=$rowsdisplaycompressed[0];
						$rowsdisplaycompressed[0]='';

						// 2 records found, 2nd is language original
						// or if we don't find vaild title in orig. language
						$k=0;
						foreach($rowsdisplay[1] as $key=>$val) {
							$tmpdisplayfieldswork=$tmpdisplayfields;
							if (($key== 'crdate') || ($key== 'tstamp') || ($key== 'datetime') || ($key== 'start_date')) {
								if (intval($val) == 0) {
									$rowsdisplaycompressed[4] = '';
								} else {
									$rowsdisplaycompressed[4] = $this->formatDate($val, $pObj, FALSE, $conf);
								}
							} elseif ((substr($key, 0, 5)== 'image') || (substr($key, 0, 5)== 'photo') || ($key== 'picture')) {
								if (intval($val) == 0) {
									$rowsdisplaycompressed[3] = $val;
								} else {
									$dataWhereContentPic = 'sys_file_reference.tablenames="tt_content" AND sys_file_reference.uid_foreign=tt_content.uid ' .
											'AND sys_file_reference.deleted=0 AND sys_file_reference.uid_local=sys_file.uid ' .
											'AND sys_file_reference.sys_language_uid=' .$syslanid .' AND tt_content.uid = ' . $tt_contentUid;

									$sqlstr = 'SELECT sys_file_reference.uid, sys_file_reference.uid, sys_file_reference.pid, sys_file_reference.uid_foreign,
													sys_file_reference.uid_local,sys_file.name AS image6, tt_content.image FROM ' .
															'tt_content, sys_file_reference , sys_file WHERE ' . $dataWhereContentPic;
									$resultContentPic = $GLOBALS['TYPO3_DB']->sql_query($sqlstr);
									$rowStats = array();
									$rowStats = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultContentPic);
									if (count($rowStats) >0) {
										if ($rowStats['image6']) {
											$rowsdisplaycompressed[3] = $rowStats['image6'];
										} else {
											$rowsdisplaycompressed[3] = $rowStats[0]['image6'];
										}
									} else {
										$rowsdisplaycompressed[3] = '';
									}

								}
							} elseif ($key== 'sys_language_uid') {
								$rowsdisplaycompressed[2] = $val;
							}	elseif ($key== 'uid') {
								$rowsdisplaycompressed[5] = $val;
							} elseif ($key== 'pid') {
								$rowsdisplaycompressed[6]= $val;
							}  else {
								if ($key!= $longtextdisplayfield) {
									If (($rowsdisplaycompressed[$k]=='') || ($conf['topRatings.']['topRatingsOriginalLangDisplay']==1)) {
										$rowsdisplaycompressed[$k] = $rowsdisplaycompressed[$k] . ' ' . $val;
									}

								}

							}

							if (str_replace($key . ' ', '', $tmpdisplayfieldswork)==$tmpdisplayfields){
								//not in sequence
								if ($rowsdisplaycompressed[$k]==''){
									$rowsdisplaycompressed[$k]=$val;
								}

								$rowsdisplaycompressed[$k]=trim($rowsdisplaycompressed[$k] );
								$k++;
							}

						}

					}

				}

				if (count($rowsdisplay)>0) {
					if ($rowsdisplaycompressed[0] != ''){
						//title
						$text = $rowsdisplaycompressed[0];
						$rowsdisplaycompressed[0] = $text;
					} else {
						if (trim($rowsdisplaycompressed[6]) != ''){
							// let's get the title of the page
							$pagestable = 'pages';
							$where = '(uid=' . $rowsdisplaycompressed[6]. ') '  . $this->enableFields($pagestable, $pObj);
							$rowspages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
									'title',
									$pagestable,
									$where,
									'',
									'',
									''
							);
							if (count($rowspages) == 1) {
								$rowsdisplaycompressed[0] = $rowspages[0]['title'];
							} else {
								$rowsdisplaycompressed[0] = 'no title found at all';
							}

						} else {
							$rowsdisplaycompressed[0] = 'no title found';
						}
					}

					if ($rowsdisplaycompressed[1]!=''){
						//long text
						$textdirty=$rowsdisplaycompressed[1];
						$textdirty=str_replace('<br>', '67g89', $textdirty);
						$textdirty=str_replace('<br />', '67g89', $textdirty);

						$search = array('@<script[^>]*?>.*?</script>@si', // Strip out javascript
								'@<[\/\!]*?[^<>]*?>@si',           // Strip out HTML tags
								'@<style[^>]*?>.*?</style>@siU',   // Strip style tags properly
								'@<![\s\S]*?--[ \t\n\r]*>@',        // Strip multi-line comments including CDATA
						);
						$text = preg_replace($search, '', $textdirty);
						$text = str_replace('67g89', '<br>', $text);

						if (strlen($text) > $conf['topRatings.']['TextCropLength']) {
							$bbterminatorarr = array();

							$textcroppedleft = substr($text, 0, $conf['topRatings.']['TextCropLength']);
							$textcroppedright = substr($text, $conf['topRatings.']['TextCropLength']);
							$textcroppedrightarr = explode(' ', $textcroppedright);
							if (count($textcroppedrightarr) > 1) {

								$testbblen = strlen($textcroppedleft . $textcroppedrightarr[0]);

								$bbterminatorarr = $this->checkbbcrop($text, $testbblen, $conf, $pObj);

								$textcroppedleft .= $textcroppedrightarr[0] . $bbterminatorarr[0] . '...';
								$text = $textcroppedleft;
								$text = str_replace('<br>...', '', $text);
								$text = str_replace('<br...', '', $text);
								$text = str_replace('<b...', '', $text);
								$text = str_replace('<...', '', $text);
							}

						}

						$text = nl2br($this->createLinks($text, $conf));
						$text = $this->replaceSmilies($text, $conf);
						$text = $this->replaceBBs($text, $pObj, $conf, FALSE);
						$text = $this->addleadingspace($text);
						$text = $this->makeemoji($text, $conf, 'topratings');
						$text = str_replace('"> <a', '">&nbsp;<a', $text);
						$rowsdisplaycompressed[1] = $text;
					}

					$text = $rowsdisplaycompressed[0];
					$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
					$no_cacheflag = 0;
					if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) == 0) {
						if ($useCacheHashNeeded == 1) {
							$no_cacheflag = 1;
						}

					}

					$show_uid = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['show_uid'];
					$externalprefix = $conf['topRatings.']['topRatingsExternalPrefix'];
					if ($show_uid == '') {
						$show_uid = 'uid';
					}

					if (strpos($show_uid, '&') === FALSE) {
						$getparamsl = $externalprefix .'[' . $show_uid . ']';
					} else {
						$getparamsl = $show_uid;
					}

					$params = '';
					$paramarr = array();
					if ($this->mmtable=='tx_toctoc_comments_comments') {
						//link to comment
						$rowsdisplay = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
								'external_ref, external_prefix, external_ref_uid',
								'tx_toctoc_comments_comments',
								'uid='.$refID,
								'',
								'',
								''
						);
						$additionalurlparamsforrecord = '';
						if (count($rowsdisplay) > 0) {
							$tmpextref=$rowsdisplay[0]['external_ref'];
							if (str_replace('pages_', '', $tmpextref)!=$rowsdisplay[0]['external_ref']) {
								if ($rowsmerged[$i]['pageid'] == 0) {
									$rowsmerged[$i]['pageid'] = intval(str_replace('pages_', '', $tmpextref));
								}

							} else {
								// build url-params for record
								$show_uidtmp = trim($_SESSION['prefixes'][$rowsdisplay[0]['external_prefix']]['show_uid']);
								if ($show_uidtmp == '') {
									$show_uidtmp = 'uid';
								}

								if (strpos($show_uidtmp, '&')===FALSE) {
									$getparams = $rowsdisplay[0]['external_prefix'] .'[' . $show_uidtmp . ']';
								} else {
									$getparams = $show_uidtmp;
								}

								$refidtmp = trim(substr($rowsdisplay[0]['external_ref'], 1+strrpos($rowsdisplay[0]['external_ref'], '_')));

								if (str_replace('ext', '', $refidtmp) != $refidtmp) {
									$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $refidtmp));
									list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
											'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

									if (trim($uidrow['externaluid']) != '') {
										$refidtmp = $uidrow['externaluid'];
									}

								}

								$paramarr[$getparams] = $refidtmp;

								$mmtabletmp = substr($rowsdisplay[0]['external_ref'], 0, strrpos($rowsdisplay[0]['external_ref'], '_'));

								// now is that record still online ?
								if (intval($refidtmp) > 0) {
									$rowsmm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, pid AS pageid',
											$mmtabletmp,
											'uid =' . $refidtmp . ' ' . $this->enableFields($mmtabletmp, $pObj),
											'',
											'');
									if (count($rowsmm) == 0) {
										$rowsmerged[$i]['pageid'] = 0;
									} else {
										if ($rowsmerged[$i]['pageid'] == 0) {
											// only for old ratings with no pageid in the stats, we get the page over the content element id from tt_content
											$contentidtmp = substr($rowsdisplay[0]['external_ref_uid'], 1+strrpos($rowsdisplay[0]['external_ref_uid'], '_'));
											$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, pid AS pageid',
													'tt_content',
													'uid =' . $contentidtmp,
													'',
													'');
											if (count($rowspage) > 0) {
												$rowsmerged[$i]['pageid'] = intval($rowspage[0]['pageid']);
											}

										}

									}
								} else {
									$rowsmerged[$i]['pageid'] = 0;
									$contentidtmp = substr($rowsdisplay[0]['external_ref_uid'], 1+strrpos($rowsdisplay[0]['external_ref_uid'], '_'));
									$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, pid AS pageid',
											'tt_content',
											'uid =' . $contentidtmp,
											'',
											'');
									if (count($rowspage) > 0) {
										$rowsmerged[$i]['pageid'] = intval($rowspage[0]['pageid']);
									}
								}

							}

						}

						$paramtl = $rowsmerged[$i]['pageid'] . $conf['recentcomments.']['anchorPre'] . $refID;
						$paramarr['toctoc_comments_pi1[anchor]']=substr($conf['recentcomments.']['anchorPre'], 1) . $refID;
					} elseif ($this->mmtable == 'tt_content') {
						if ($rowsmerged[$i]['pageid'] == 0) {
							// only for old ratings with no pageid in the stats, we get the page over the content element id from tt_content
							$contentidtmp=substr($rowsdisplay[0]['external_ref_uid'], 1+strrpos($rowsdisplay[0]['external_ref_uid'], '_'));
							$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, pid AS pageid',
									'tt_content',
									'uid =' . $refID,
									'',
									'');
							if (count($rowspage) > 0) {
								$rowsmerged[$i]['pageid'] = intval($rowspage[0]['pageid']);
							}

						}
						$paramarr['L']=0;
						//lang params
						if (($rowsdisplaycompressed[2] >0) && ($GLOBALS['TSFE']->sys_language_uid==0)) {
							if ($conf['advanced.']['useMultilingual'] == 1) {
								$paramarr['L']=$rowsdisplaycompressed[2];
							} else {
								$paramarr['L']=0;
							}

						}

						if (($rowsdisplaycompressed[2] == 0) && ($GLOBALS['TSFE']->sys_language_uid > 0)) {
							$paramarr['L']=0;
						}

						if (($rowsdisplaycompressed[2] > 0) && ($GLOBALS['TSFE']->sys_language_uid > 0)) {
							$paramarr['L']=$rowsdisplaycompressed[2];
						}

						$paramtl = $rowsmerged[$i]['pageid'] . '#tx-tc-cts-att_content_' . $refID;
					} elseif (($this->mmtable == 'pages') || ($this->mmtable == 'pages_language_overlay')){
						$paramtl = $rowsmerged[$i]['reference'];
						if ($GLOBALS['TSFE']->sys_language_uid != 0) {
							$paramarr['L']=0;
						}
						$texttip='';
						if (intval($rowsmerged[$i]['lang']) != 0) {
							$paramarr['L']=intval($rowsmerged[$i]['lang']);
							$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('title, flag',
									'sys_language',
									'uid =' . intval($rowsmerged[$i]['lang']),
									'',
									'');

							if (count($rowspage) > 0) {
								$texttip = ' title= "' . $rowspage[0]['title'] . '"';
								$text .= ' (' . strtolower(substr($rowspage[0]['title'], 0, 2)). ')';
							}

						}

					} else {
						if (intval($_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['topratingsdetailpage'])!=0) {
							$paramtl = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['topratingsdetailpage'];
							$rowsmerged[$i]['pageid'] = $_SESSION['prefixes'][$conf['topRatings.']['topRatingsExternalPrefix']]['topratingsdetailpage'];
						}  else {
							$paramtl = $rowsmerged[$i]['pageid'];
						}

						$paramarr['L']=intval($rowsmerged[$i]['lang']);

						if (strpos($getparamsl, '&') == 1) {
							$getparamsl = substr($getparamsl, 1);
						}

						if (str_replace('ext', '', $refID) != $refID) {
							$dataWhereuidrow = 'uid = ' . intval(str_replace('ext', '', $refID));
							list($uidrow) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('externaluid',
									'tx_toctoc_comments_longuidreference', $dataWhereuidrow);

							if (trim($uidrow['externaluid']) != '') {
								$refID = $uidrow['externaluid'];
							}

						}

						$paramarr[$getparamsl] = $refID;

						if (strpos($addparamforextensionswithoutsyslanguid, 'L=0') > 0) {
							$paramarr['L']=0;
						}

					}

					if ($no_cacheflag == 1) {
						$paramarr['no_cache']=1;
					}

					$params=t3lib_div::implodeArrayForUrl('', $paramarr, '', 1);

					// '7g8' is replacement string for '-' in extensions with non integer showUid
					$tmpexternalUidarr = explode('%40page', $params);
					if (count($tmpexternalUidarr) >1) {
						$params = array_shift($tmpexternalUidarr);
						$tmpexternalUid = implode ('', $tmpexternalUidarr);
						$tmpexternalUidarr = explode('&', $tmpexternalUid);
						if (count($tmpexternalUidarr) >1) {
							array_shift($tmpexternalUidarr);
							$tmpexternalUid = implode('&', $tmpexternalUidarr);
							$params .= '&' . $tmpexternalUid;
							$params = str_replace('&&', '&', $params);
						}
					}
					$params = str_replace('7g8', '-', $params);

					$conflink = array(
							'useCacheHash'     => $useCacheHashNeeded,
							'parameter'        => $paramtl,
							'additionalParams' => $params,
							'ATagParams' => 'rel="nofollow"' . $texttip,
							'forceAbsoluteUrl' => 1,
					);

					$rowsmerged[$i]['linktext'] = $text;
					if ($rowsmerged[$i]['pageid'] == '') {
						$rowsmerged[$i]['pageid'] = $rowsmerged[$i]['reference'];
					}

					$text = $this->cObj->typoLink($text, $conflink);
					//$text = $this->cObj->typoLink($textorig, $conflink);
					if (str_replace('cHash=', '', $text) == $text) {
						$text = str_replace('&no_cache=1', '', $text);
						$text = str_replace('?no_cache=1', '', $text);
					}

					$linkpurearr = explode('"', $text);
					$linkpure = $linkpurearr[1];
					$text = str_replace('href="', 'href="javascript:recentct(1,\'' . $_SESSION['commentListCount'].$irank . '\',' .
							$rowsmerged[$i]['pageid'] . ',\'', $text);
					$text = str_replace('" rel="nofollow', '\')" rel="nofollow', $text);

					$rowsdisplaycompressed[0] = $text;
					$rowsmerged[$i]['link'] = $rowsdisplaycompressed[0];

					$rowsmerged[$i]['text'] = $rowsdisplaycompressed[1];
					$rowsmerged[$i]['language'] = $rowsdisplaycompressed[2];
					$rowsmerged[$i]['image'] = $rowsdisplaycompressed[3];
					$rowsmerged[$i]['date'] = $rowsdisplaycompressed[4];
					$rowsmerged[$i]['linkfinalpure'] = $linkpure;
					$rowsmerged[$i]['isok'] = 1;
					if (strpos($rowsmerged[$i]['link'], 'href=') == 0) {
						$rowsmerged[$i]['isok'] = 0;
					} else {

						if ($conf['topSharings.']['topSharingsMode'] == 1) {
							$this->grandtotalshareurlcount += 1;
						}

					}

				} else {
					$rowsmerged[$i]['isok'] = 0;
				}

				$rowsmerged[$i]['rank'] = $irank;
				$irank = $irank+$rowsmerged[$i]['isok'];
			}
		}

		return $rowsmerged;
	}


	/**
	 * initializes some parts of the conf ($conf['topRatings.']['topRatingsExternalPrefix'] with correct value from tx_toctoc_comments_prefixtotable)
	 *
	 * @param	[type]		$bytes: ...
	 * @param	[type]		$decimals: ...
	 * @param	[type]		$restrictor: ...
	 * @return	string		...
	 */
	private function initconf($pidcond, $conf, $restrictor) {
		$retarr= array();
		$retarr['displayfields']='';
		//specs: $displayfields = 'titlepart1 titlepart2, longertext, linktoimage';
		$retarr['show_uid']='showUid';
		$retarr['restrictor']=$restrictor;

		if ($conf['topRatings.']['topRatingsrestrictToExternalPrefix'] == 'custom') {
			if ($conf['topRatings.']['topRatingsExternalPrefix']!='') {
				//then we have mismach between $this->conf['externalPrefix'] and the record
				$where = 'uid=' . $conf['topRatings.']['topRatingsExternalPrefix'] .'';

				$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table,
						show_uid as show_uid, displayfields As displayfields, topratingsdetailpage As topratingsdetailpage,
						topratingsimagesfolder AS topratingsimagesfolder',
						'tx_toctoc_comments_prefixtotable',
						$where,
						'',
						'',
						''
				);

				if (count($rowsrf)>0) {
					$reta = array();
					if (strlen($rowsrf[0]['pi1_table']) > 0) {
						$reta = $rowsrf[0];

					} else {
						$reta = $rowsrf;
					}
					$retarr['mmtabletoexternalprefix']=TRUE;
					$retarr['externaltable']=$reta['pi1_table'];
					$conf['topRatings.']['topRatingsExternalPrefix'] = $reta['pi1_key'];

					$retarr['displayfields']=$reta['displayfields'];
					if ($retarr['displayfields']=='') {
						$retarr['displayfields']='title - description';
					}

					if ($reta['show_uid']!='') {
						$retarr['show_uid']=$reta['show_uid'];
					}

				}

				if ($retarr['externaltable']=='pages') {
					$retarr['externaltable']='tt_content';
				}

				$retarr['restrictor']='reference LIKE "'.$retarr['externaltable'].'%" AND ' .  $pidcond;
			}

		} elseif ($conf['topRatings.']['topRatingsrestrictToExternalPrefix'] == 'comments') {
			$retarr['restrictor']='reference LIKE "tx_toctoc_comments_comments%" AND ' .  $pidcond;
			$retarr['mmtable']='tx_toctoc_comments_comments';
			$retarr['externaltable']=$retarr['mmtable'];
			$conf['topRatings.']['topRatingsExternalPrefix']=$retarr['mmtable'];

		} elseif ($conf['topRatings.']['topRatingsrestrictToExternalPrefix'] == 'content') {
			$retarr['restrictor']='reference LIKE "tt_conten%" AND ' .  $pidcond;
			$retarr['mmtable']='tt_content';
			$retarr['externaltable']=$retarr['mmtable'];
			$conf['topRatings.']['topRatingsExternalPrefix']=$retarr['mmtable'];
		} else {
			$conf['topRatings.']['topRatingsExternalPrefix']='';
			$retarr['mmtabletoexternalprefix']=TRUE;
		}
		return $retarr;
	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_charts.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_charts.php']);
}
?>