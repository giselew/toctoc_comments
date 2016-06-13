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
 * BackendOverview.php
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
 *   59: class toctoc_comments_be_overview
 *   67:     public function getoverview(&$pObj)
 *  190:     public function createCommentstext ($overviewdata, $pObj)
 *  329:     public function createUserstext($overviewdata, $pObj)
 *  452:     public function createRatingstext ($overviewdata)
 *  606:     public function createReportstext ($overviewdata, $pObj)
 *  731:     public function createSystemtext ($overviewdata, $pObj)
 *  774:     public function createBLtext ($overviewdata, $pObj)
 *
 * TOTAL FUNCTIONS: 7
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
class toctoc_comments_be_overview {

	/**
	 * Desc
	 *
	 * @param	[type]		$$pObj: ...
	 * @return	[type]		...
	 */
	public function getoverview(&$pObj) {

		$overviewdata = $pObj->be_common->getOverviewData($pObj);

		$Commentstext = $this->createCommentstext($overviewdata['Comments'], $pObj);
		$Userstext = $this->createUserstext($overviewdata['Users'], $pObj);
		$Ratingstext = $this->createRatingstext($overviewdata['Ratings']);
		$Reportstext = $this->createReportstext($overviewdata['Reports'], $pObj);
		$Systemtext = $this->createSystemtext($overviewdata['System'], $pObj);
		$BLtext = $this->createBLtext($overviewdata['BlacklistData'], $pObj);

		$icoComments = '<img class="tx-tc-titleicon" align="left" src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx . $pObj->iconComments . '" ' . $pObj->iconWidthHeightTitle .
					    ' title="' . $GLOBALS['LANG']->getLL('function1'). '" alt="" />';
		$icoRatings = '<img class="tx-tc-titleicon" align="left" src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx . $pObj->iconRatings . '" ' . $pObj->iconWidthHeightTitle .
					    ' title="' . $GLOBALS['LANG']->getLL('functionratings').'" alt="" />';

		$icoUser = '<img class="tx-tc-titleicon" align="left" src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx .  $pObj->iconOverviewUser . '" ' . $pObj->iconWidthHeightTitle .
						    ' title="' . $GLOBALS['LANG']->getLL('function2').'" alt="" />';

		$icoReports = '<img class="tx-tc-titleicon" align="left"  src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx .  $pObj->iconReports . '" ' . $pObj->iconWidthHeightTitle .
					    ' title="' . $GLOBALS['LANG']->getLL('function4').'" alt="" />';

		$icoBlacklistCrawler = '<img class="tx-tc-titleicon" align="left"  src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx .  $pObj->iconBlacklistCrawler . '" ' . $pObj->iconWidthHeightTitle .
					    ' title="' . $GLOBALS['LANG']->getLL('ipaccessandcrawlers').'" alt="" />';

		$icoSystem = '<img class="tx-tc-titleicon" align="left"  src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx . $pObj->iconSystem . '" ' . $pObj->iconWidthHeightTitle .
					    ' title="' . $GLOBALS['LANG']->getLL('functionsystem').'" alt="" />';

		$contentoverview='
				<div class="tx-tc-100" id="tx-tc-subiconpanel" style="display: none;">
					<div class="tx-tc-subicons" id="tx-tc-subicon1">
						<span class="tx-tc-be-link">
							' . $icoComments .'
					    </span>
					 </div>
					 <div class="tx-tc-subicons" id="tx-tc-subicon2">
						<span class="tx-tc-be-link">
							' . $icoRatings .'
					   	</span>
					 </div>
					 <div class="tx-tc-subicons" id="tx-tc-subicon3">
						<span class="tx-tc-be-link">
							' . $icoUser .'
					   	</span>
					 </div>
					 <div class="tx-tc-subicons" id="tx-tc-subicon4">
						<span class="tx-tc-be-link">
							' . $icoReports .'
					   	</span>
					 </div>
					 <div class="tx-tc-subicons" id="tx-tc-subicon5">
						<span class="tx-tc-be-link">
							' . $icoBlacklistCrawler .'
					   	</span>
					 </div>
					 <div class="tx-tc-subicons" id="tx-tc-subicon6">
						<span class="tx-tc-be-link">
							' . $icoSystem .'
					   	</span>
					 </div>
				</div>
				<div class="tx-tc-100">
				<div class="tx-tc-50" id="tx-tc-subpanel1">
		<div class="tx-tc-subpaneltitle">
							' . $icoComments .'
			<span>' . $GLOBALS['LANG']->getLL('function1') . '</span><span id="tx-tc-subpaneltitle1" class="tx-tc-panelclosebutton" title="'.$GLOBALS['LANG']->getLL('closepanel').'">x</span>
			</div>' .
			$Commentstext . '

		</div>
		<div class="tx-tc-50" id="tx-tc-subpanel2">
			<div class="tx-tc-subpaneltitle">
				' . $icoRatings .'
				<span>' . $GLOBALS['LANG']->getLL('functionratings') . '</span><span id="tx-tc-subpaneltitle2" class="tx-tc-panelclosebutton" title="'.$GLOBALS['LANG']->getLL('closepanel').'">x</span>
			</div>' .
			$Ratingstext . '
		</div>
					</div>
				<div class="tx-tc-100">
		<div class="tx-tc-50" id="tx-tc-subpanel3">
			<div class="tx-tc-subpaneltitle">
				' . $icoUser .'
				<span>' . $GLOBALS['LANG']->getLL('function2') . '</span><span id="tx-tc-subpaneltitle3" class="tx-tc-panelclosebutton" title="'.$GLOBALS['LANG']->getLL('closepanel').'">x</span>
			</div>' .
			$Userstext . '

		</div>
    	<div class="tx-tc-50" id="tx-tc-subpanel4">
    		<div class="tx-tc-subpaneltitle">
				' . $icoReports .'
    			<span>' . $GLOBALS['LANG']->getLL('function4') . '</span><span id="tx-tc-subpaneltitle4" class="tx-tc-panelclosebutton" title="'.$GLOBALS['LANG']->getLL('closepanel').'">x</span>
    		</div>
    		' .
			$Reportstext . '
    	</div>
    					</div>
				<div class="tx-tc-100">
		<div class="tx-tc-50" id="tx-tc-subpanel5">
			<div class="tx-tc-subpaneltitle">
				' . $icoBlacklistCrawler .'
				<span>'.$GLOBALS['LANG']->getLL('ipaccessandcrawlers').'</span><span id="tx-tc-subpaneltitle5" class="tx-tc-panelclosebutton" title="'.$GLOBALS['LANG']->getLL('closepanel').'">x</span>
			</div> ' . $BLtext . '

		</div>
		<div class="tx-tc-50" id="tx-tc-subpanel6">
			<div class="tx-tc-subpaneltitle">
	    		' . $icoSystem .'
				<span>' . $GLOBALS['LANG']->getLL('functionsystem') . '</span>
						<span id="tx-tc-subpaneltitle6" class="tx-tc-panelclosebutton" title="'.$GLOBALS['LANG']->getLL('closepanel').'">x</span>
			</div>' .
			$Systemtext . '
		</div></div>
				';
		return $contentoverview;
	}

	/**
	 * Returns text used in the overview
	 *
	 * @param	array		$overviewdata
	 * @param	[type]		$pObj: ...
	 * @return	$overview		html with Overviews commentstext
	 */
	public function createCommentstext ($overviewdata, $pObj) {
		/* [Comments] =>
		Array ( [newcomments] => 0 [allcomments] => 543 [pidcount] => 1 [pids] =>
				Array ( [0] =>
						Array ( [pid] => 3 [commentcount] => 543 [approvedcommentcount] => 530 )
				)
				[newcommentstxt] => 1 day
				[allapprovedcomments] => 530
		) */

		$overview = '
				<div>';

		if ($overviewdata['newcomments'] >0) {
			$txtsince = $GLOBALS['LANG']->getLL('sysnewssince');
			$overview .= '<div class="tx-tc-100">';
			$txthout = $overviewdata['newcommentstxt'];
			if ($overviewdata['newcomments'] > 1) {
				$overview .= trim('<div class="tx-tc-newcommentstar"><span class="tx-tc-star">*</span></div>' .
						$overviewdata['newcomments'] . ' ' . $GLOBALS['LANG']->getLL('nnewcomments'). ' ' . $txtsince) . ' '. $txthout;
			}

			if ($overviewdata['newcomments'] == 1) {
				$overview .= trim('<div class="tx-tc-newcommentstar"><span class="tx-tc-star">*</span></div>' .
						$GLOBALS['LANG']->getLL('onenewcomment'). ' ' . $txtsince) . ' ' . $txthout;
			}

			$overview .= '</div>';
		}
		$folderdisplayscomments = FALSE;
		if (isset($overviewdata['allcomments'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';

			if ($overviewdata['allcomments'] > 1) {
				$overview .= sprintf($GLOBALS['LANG']->getLL('overviewcommentsnoverall'), $overviewdata['allcomments']) . ' ';
				if ($overviewdata['pidcount'] > 1) {
					$overview .= sprintf($GLOBALS['LANG']->getLL('overviewpids'), $overviewdata['pidcount']);
				} elseif ($overviewdata['pidcount'] == 1) {
					$overview .= $GLOBALS['LANG']->getLL('overview1pid');
				}

				if ($overviewdata['allapprovedcomments'] != $overviewdata['allcomments']) {
					if ($overviewdata['allapprovedcomments'] == 0) {
						$overview .= ', ' .$GLOBALS['LANG']->getLL('overviewbutnoapprovedcomments');
					} else {
						$overview .= ', ' . $overviewdata['allapprovedcomments'] . ' ' . $GLOBALS['LANG']->getLL('overviewapprovedcomments');
					}
				}

			} elseif ($overviewdata['allcomments'] == 1) {
				$overview .= $GLOBALS['LANG']->getLL('overviewcomment1noverall');
				if ($overviewdata['allapprovedcomments'] != $overviewdata['allcomments']) {
					$overview .= ', ' .$GLOBALS['LANG']->getLL('overviewbutnoapprovedcomments');
				}
			} elseif ($overviewdata['allcomments'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewcomment0noverall');

			}

			$overview .= '
					</span>
				</div>
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">
						<div class="tx-tc-100">
							<span class="reportoptionstitle" title="'. $GLOBALS['LANG']->getLL('folderswithdata') . '">'. $GLOBALS['LANG']->getLL('folders') . '</span>
						</div>';

			$endtag ='';
			$starttag ='';

			for ($i=0; $i < $overviewdata['pidcount']; $i++) {
				if (($i==2) && ($overviewdata['pidcount'] > 2)) {
					$starttag ='<div id="shwmorecommentstrg" class="tx-tc-be-link">'. $GLOBALS['LANG']->getLL('showmore') .'...</div><div id="shwmorecomments">';
					$endtag ='<div id="shwlesscomments" class="tx-tc-be-link">'. $GLOBALS['LANG']->getLL('showless') .'</div></div>';
				} else {
					$starttag = '';
				}
				$overview .= $starttag . '
							<div class="tx-tc-100">';
				$boldstart = '';
				$boldend = '';

				if ($overviewdata['pids'][$i]['pid'] == $_SESSION['backendpid']) {
					$boldstart = '<b>';
					$boldend = '</b>';
					$folderdisplayscomments = TRUE;
				}

				$overview .= $boldstart . '<span title="pid">' . $overviewdata['pids'][$i]['pid'] .
						'</span>, <span title="'. $GLOBALS['LANG']->getLL('overviewnameofpid') .'">' .
						$overviewdata['pids'][$i]['nameofpid'] .
						'</span> ('.$overviewdata['pids'][$i]['approvedcommentcount'] .'/'. $overviewdata['pids'][$i]['commentcount'].')' . $boldend;
				$overview .= '</div>';
			}

			$overview .= $endtag . '
					</span>
				</div>';

		}

		if ($_SESSION['backendpid']==0) {
			$folderdisplayscomments = TRUE;
		}
		if ($folderdisplayscomments) {
			$buttonclass = 'tx-tc-datarequester tx-tc-be-link';
			$buttontitle = $GLOBALS['LANG']->getLL('listup') . ' ' .	$GLOBALS['LANG']->getLL('function1');
		} else {
			$buttonclass = 'tx-tc-nodatarequester';
			$buttontitle = $GLOBALS['LANG']->getLL('overviewnocommentsinfolder');
		}

		if ($overviewdata['allcomments'] > 0) {
			$overview .= '
				<div class="tx-tc-100">
					<span class="tx-tc-be-showlist">
						<img id="pcomment" class="' . $buttonclass . '" align="left" src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx . $pObj->iconList . '" ' . $pObj->iconWidthHeightTitle .
						 	' title="' . $buttontitle . '" alt="" />
						<span title="' . $buttontitle . '" id="acomment" class="' . $buttonclass . '">' . $GLOBALS['LANG']->getLL('listup'). ' ' .
						$GLOBALS['LANG']->getLL('function1') . '
						</span>
					</span>
				</div>';
		}

		$overview .= '</div>';
		return $overview;
	}

	/**
	 * Returns text used in the overview
	 *
	 * @param	array		$overviewdata
	 * @param	[type]		$pObj: ...
	 * @return	$overview		html with Overviews Userstext
	 */
	public function createUserstext($overviewdata, $pObj) {
		$overview = '<div>';

		/* [Users] =>
		Array ( [allUsers] => 278 [pidcount] => 1 [maxcrdate] => 1430669752 [pids] =>
				Array ( [0] =>
						Array ( [pid] => 3 [Userscount] => 278 )
				)
		) */

		$txthout=$overviewdata['newuserstxt'];
		if ($overviewdata['newusers'] >0) {
			$txtsince = $GLOBALS['LANG']->getLL('sysnewssince');
			$overview .= '
				<div class="tx-tc-100">';
			if ($overviewdata['newusers'] > 1) {
				$overview .= trim('<div class="tx-tc-newuserstar"><span class="tx-tc-star">*</span></div>' .
						$overviewdata['newusers'] . ' ' . $GLOBALS['LANG']->getLL('nnewusers'). ' ' . $txtsince) . ' '. $txthout;
			}

			if ($overviewdata['newusers'] == 1) {
				$overview .= trim('<div class="tx-tc-newuserstar"><span class="tx-tc-star">*</span></div>' .
						$GLOBALS['LANG']->getLL('onenewuser'). ' ' . $txtsince) . ' ' . $txthout;
			}

			$overview .= '
				</div>';
		}
		$folderdisplayscomments = FALSE;
		if (isset($overviewdata['allUsers'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';

			if ($overviewdata['allUsers'] > 1) {
				$overview .= sprintf($GLOBALS['LANG']->getLL('overviewusersnoverall'), $overviewdata['allUsers']) . ' ';
				if ($overviewdata['pidcount'] > 1) {
					$overview .= sprintf($GLOBALS['LANG']->getLL('overviewpids'), $overviewdata['pidcount']);
				} elseif ($overviewdata['pidcount'] == 1) {
					$overview .= $GLOBALS['LANG']->getLL('overview1pid');
				}
			} elseif ($overviewdata['allUsers'] == 1) {
				$overview .= $GLOBALS['LANG']->getLL('overviewuser1noverall');

			} elseif ($overviewdata['allUsers'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewuser0noverall');
			}

			$overview .= '</span>
					</div>
					<div class="tx-tc-50">
						<span class="tx-tc-margin-right">
							<div class="tx-tc-100">
								<span class="reportoptionstitle" title="'. $GLOBALS['LANG']->getLL('folderswithdata') . '">'.
								$GLOBALS['LANG']->getLL('foldersusers') . '</span>
							</div>';

			$endtag ='';
			$starttag ='';
			for ($i=0; $i < $overviewdata['pidcount']; $i++) {
				if (($i==2) && ($overviewdata['pidcount'] > 2)) {
					$starttag ='<div id="shwmoreuserstrg" class="tx-tc-be-link">'. $GLOBALS['LANG']->getLL('showmore') .'...</div><div id="shwmoreusers">';
					$endtag ='<div id="shwlessusers" class="tx-tc-be-link">'. $GLOBALS['LANG']->getLL('showless') .'</div></div>';
				} else {
					$starttag = '';
				}
				$overview .= $starttag . '
							<div class="tx-tc-100">';
				$boldstart = '';
				$boldend = '';

				if ($overviewdata['pids'][$i]['pid'] == $_SESSION['backendpid']) {
					$boldstart = '<b>';
					$boldend = '</b>';
					$folderdisplayscomments = TRUE;
				}

				$overview .= $boldstart . '<span title="pid">' . $overviewdata['pids'][$i]['pid'] .
				'</span>, <span title="'. $GLOBALS['LANG']->getLL('overviewnameofpid') .'">' .
				$overviewdata['pids'][$i]['nameofpid'] . ' (' . $overviewdata['pids'][$i]['Userscount'] . ')' .
				'</span>' . $boldend;
				$overview .= '
							</div>';
			}

			$overview .= $endtag . '</span>
					</div>';
		}

		if ($_SESSION['backendpid']==0) {
			$folderdisplayscomments = TRUE;
		}
		if ($folderdisplayscomments) {
			$buttonclass = 'tx-tc-datarequester tx-tc-be-link';
			$buttontitle = $GLOBALS['LANG']->getLL('listup') . ' ' .	$GLOBALS['LANG']->getLL('function2');
		} else {
			$buttonclass = 'tx-tc-nodatarequester';
			$buttontitle = $GLOBALS['LANG']->getLL('overviewnousersinfolder');
		}

		if ($overviewdata['allUsers'] > 0) {
			$overview .= '
			<div class="tx-tc-100">
				<span class="tx-tc-be-showlist">
					<img id="puser" class="' . $buttonclass . '" align="left" src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx . $pObj->iconList . '" ' . $pObj->iconWidthHeightTitle .
					 ' title="' . $buttontitle . '" alt="" />
					<span title="' . $buttontitle . '" id="auser" class="' . $buttonclass . '">' . $GLOBALS['LANG']->getLL('listup'). ' ' .
					$GLOBALS['LANG']->getLL('function2') . '</span>
	    		</span>
			</div>';
		}
		$overview .= '</div>';
		return $overview;
	}

	/**
	 * Returns text used in the overview
	 *
	 * @param	array		$overviewdata
	 * @param	[type]		$pObj: ...
	 * @return	$overview		html with Overviews Ratingstext
	 */
	public function createRatingstext ($overviewdata) {
		$overview = '';
		/* [Ratings] =>
		Array ( [newratings] => 0 [allratings] => 296 [newlikes] => 0 [alllikes] => 368 [pidcount] => 1 [pids] =>
				Array ( [0] =>
						Array ( [pid] => 3 [ratingscount] => 296 )
				) [newratingstxt] => 1 day [newdislikes] => 0
		) */

		$txthout = $overviewdata['newratingstxt'];
		if ($overviewdata['newratings'] >0) {
			$txtsince = $GLOBALS['LANG']->getLL('sysnewssince');
			$overview .= '
				<div class="tx-tc-100">';
			if ($overviewdata['newratings'] > 1) {
				$overview .= trim('<div class="tx-tc-newratingstar"><span class="tx-tc-star">*</span></div>' .
						$overviewdata['newratings'] . ' ' . $GLOBALS['LANG']->getLL('nnewratings'). ' ' . $txtsince) . ' '. $txthout;
			}

			if ($overviewdata['newratings'] == 1) {
				$overview .= trim('<div class="tx-tc-newratingstar"><span class="tx-tc-star">*</span></div>' .
						$GLOBALS['LANG']->getLL('onenewrating'). ' ' . $txtsince) . ' ' . $txthout;
			}

			$overview .= '
				</div>';
		}
		if ($overviewdata['newlikes'] >0) {
			$txtsince = $GLOBALS['LANG']->getLL('sysnewssince');
			$overview .= '
				<div class="tx-tc-100">';
			if ($overviewdata['newlikes'] > 1) {
				$overview .= trim('<div class="tx-tc-newlikestar"><span class="tx-tc-star">*</span></div>' .
						$overviewdata['newlikes'] . ' ' . $GLOBALS['LANG']->getLL('nnewlikes'). ' ' . $txtsince) . ' '. $txthout;
			}

			if ($overviewdata['newlikes'] == 1) {
				$overview .= trim('<div class="tx-tc-newlikestar"><span class="tx-tc-star">*</span></div>' .
						$GLOBALS['LANG']->getLL('onenewlike'). ' ' . $txtsince) . ' ' . $txthout;
			}

			$overview .= '
				</div>';
		}

		if ($overviewdata['newdislikes'] >0) {
			$txtsince = $GLOBALS['LANG']->getLL('sysnewssince');
			$overview .= '
				<div class="tx-tc-100">';
			if ($overviewdata['newdislikes'] > 1) {
				$overview .= trim('<div class="tx-tc-newlikestar"><span class="tx-tc-star">*</span></div>' .
						$overviewdata['newdislikes'] . ' ' . $GLOBALS['LANG']->getLL('nnewdislikes'). ' ' . $txtsince) . ' '. $txthout;
			}

			if ($overviewdata['newdislikes'] == 1) {
				$overview .= trim('<div class="tx-tc-newlikestar"><span class="tx-tc-star">*</span></div>' .
						$GLOBALS['LANG']->getLL('onenewdislike'). ' ' . $txtsince) . ' ' . $txthout;
			}

			$overview .= '
				</div>';
		}

		if (isset($overviewdata['allratings'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';

			if ($overviewdata['allratings'] > 1) {
				$overview .= sprintf($GLOBALS['LANG']->getLL('overviewratingsnoverall'), $overviewdata['allratings']) . ' ';
				if ($overviewdata['pidcount'] > 1) {
					$overview .= sprintf($GLOBALS['LANG']->getLL('overviewpids'), $overviewdata['pidcount']);
				} elseif ($overviewdata['pidcount'] == 1) {
					$overview .= $GLOBALS['LANG']->getLL('overview1pid');
				}
			} elseif ($overviewdata['allratings'] == 1) {
				$overview .= $GLOBALS['LANG']->getLL('overviewrating1noverall');

			} elseif ($overviewdata['allratings'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewrating0noverall');
			}

			$overview .= '</span>
					</div>
					<div class="tx-tc-50">
						<span class="tx-tc-margin-right">
							<div class="tx-tc-100">
								<span class="reportoptionstitle" title="'. $GLOBALS['LANG']->getLL('folderswithdata') . '">'.
										$GLOBALS['LANG']->getLL('foldersratings') . '</span>
							</div>';
			$endtag ='';
			$starttag ='';
			for ($i=0; $i < $overviewdata['pidcount']; $i++) {
				if (($i==2) && ($overviewdata['pidcount'] > 2)) {
					$starttag ='<div id="shwmoreratingstrg" class="tx-tc-be-link">'. $GLOBALS['LANG']->getLL('showmore') .'...</div><div id="shwmoreratings">';
					$endtag ='<div id="shwlessratings" class="tx-tc-be-link">'. $GLOBALS['LANG']->getLL('showless') .'</div></div>';
				} else {
					$starttag = '';
				}
				$overview .= $starttag . '
							<div class="tx-tc-100">';
				$boldstart = '';
				$boldend = '';

				if ($overviewdata['pids'][$i]['pid'] == $_SESSION['backendpid']) {
					$boldstart = '<b>';
					$boldend = '</b>';
				}

				$overview .= $boldstart . '<span title="pid">' . $overviewdata['pids'][$i]['pid'] .
				'</span>, <span title="'. $GLOBALS['LANG']->getLL('overviewnameofpid') .'">' .
				$overviewdata['pids'][$i]['nameofpid'] . ' (' . $overviewdata['pids'][$i]['ratingscount'] . ')' .
				'</span>' . $boldend;
				$overview .= '
							</div>';
			}

			$overview .= $endtag . '</span>
					</div>';
		}

		if (isset($overviewdata['alllikes'])) {
			$overview .= '
				<div class="tx-tc-100">
					<span class="tx-tc-margin-right">';

			if ($overviewdata['alllikes'] > 1) {
				$overview .= sprintf($GLOBALS['LANG']->getLL('overviewlikesnoverall'), $overviewdata['alllikes']) . ' ';
				if ($overviewdata['pidcount'] > 1) {
					$overview .= sprintf($GLOBALS['LANG']->getLL('overviewpids'), $overviewdata['pidcount']);
				} elseif ($overviewdata['pidcount'] == 1) {
					$overview .= $GLOBALS['LANG']->getLL('overview1pid');
				}
			} elseif ($overviewdata['alllikes'] == 1) {
				$overview .= $GLOBALS['LANG']->getLL('overviewlike1noverall');

			} elseif ($overviewdata['alllikes'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewlike0noverall');
			}

			$overview .= '</span>
					</div>';
		}

		return $overview;
	}

	/**
	 * Returns text used in the overview
	 *
	 * @param	array		$overviewdata
	 * @param	[type]		$pObj: ...
	 * @return	$overview		html with Overviews Reportstext
	 */
	public function createReportstext ($overviewdata, $pObj) {
		$overview = '';
		/* [Reports] =>
		Array ( [Sessions] =>
				Array ( [sessioncount] => 31
				) [ActiveUsers] =>
				Array ( [allActiveUsers] => 270 [pidcount] => 1 [maxcrdate] => 1414170735
						[pids] =>
						Array (
								[0] => Array ( [pid] => 3 [ActiveUserscount] => 270
								)
						)
				)
				[Crawlers] =>
				Array ( [crawlersactive] => 1 [crawlersfilepath] => W:\www2\toctoc4x.ch\typo3conf\ext\toctoc_comments\pi1\crawlerprotocol.txt [crawlerentries] => 10000
				)
				[Blacklists] =>
				Array ( [blacklistingactive] => 0 [blacklistfilepath] => W:\www2\toctoc4x.ch\typo3conf\ext\toctoc_comments\pi1\blacklistprotocol.txt [blacklistentries] => 9679 [blacklistactive] => 1
				)
		)
		) */
		$_SESSION['canreport'] = 0;
		if (isset($overviewdata['Sessions'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';
			$_SESSION['cansessionreport'] = 1;
			$_SESSION['canreport'] = 1;
			if ($overviewdata['Sessions']['sessioncount'] > 1) {
				$overview .= sprintf($GLOBALS['LANG']->getLL('overviewsessionsnoverall'), $overviewdata['Sessions']['sessioncount']) . ' ';
			} elseif ($overviewdata['Sessions']['sessioncount'] == 1) {
				$overview .= $GLOBALS['LANG']->getLL('overviewsession1noverall');

			} elseif ($overviewdata['Sessions']['sessioncount'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewsession0noverall');
				$_SESSION['cansessionreport'] = 0;
			}

			$overview .= '</span>
					</div>';
		}

		if (isset($overviewdata['ActiveUsers'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';
			$_SESSION['canactiveusersreport'] = 1;
			$_SESSION['canreport'] = 1;
			if ($overviewdata['ActiveUsers']['allActiveUsers'] > 1) {
				$overview .= sprintf($GLOBALS['LANG']->getLL('overviewactiveusersnoverall'), $overviewdata['ActiveUsers']['allActiveUsers']) . ' ';
				if ($overviewdata['pidcount'] > 1) {
					$overview .= sprintf($GLOBALS['LANG']->getLL('overviewpids'), $overviewdata['pidcount']);
				} elseif ($overviewdata['pidcount'] == 1) {
					$overview .= $GLOBALS['LANG']->getLL('overview1pid');
				}
			} elseif ($overviewdata['ActiveUsers']['allActiveUsers'] == 1) {
				$overview .= $GLOBALS['LANG']->getLL('overviewactiveuser1noverall');

			} elseif ($overviewdata['ActiveUsers']['allActiveUsers'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewactiveuser0noverall');
				$_SESSION['canactiveusersreport'] = 0;
			}

			$overview .= '</span>
					</div>';
		}

		if (isset($overviewdata['Crawlers'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';
			$_SESSION['cancrawlersreport'] = 1;
			$_SESSION['canreport'] = 1;
				if ($overviewdata['Crawlers']['crawlersactive'] == 1) {
				$overview .= '<span title="'. $GLOBALS['LANG']->getLL('overviewfile').': ' .$overviewdata['Crawlers']['crawlersfilepath'] .
						'">' . $GLOBALS['LANG']->getLL('overviewcrawlerprotocolactive') .
						'</span>, ' . sprintf($GLOBALS['LANG']->getLL('overviewnentries'), $overviewdata['Crawlers']['crawlerentries']);

			} elseif ($overviewdata['Crawlers']['crawlersactive'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewcrawlerprotocolinactive');
				$_SESSION['cancrawlersreport'] = 0;
			}

			$overview .= '</span>
					</div>';
		}
		if (isset($overviewdata['Blacklists'])) {
			$overview .= '
				<div class="tx-tc-50">
					<span class="tx-tc-margin-right">';
				$_SESSION['canblreport'] = 1;
				$_SESSION['canreport'] = 1;
			if ($overviewdata['Blacklists']['blacklistingactive'] == 1) {
				$overview .= '<span title="'.$GLOBALS['LANG']->getLL('overviewfile').': ' .$overviewdata['Blacklists']['blacklistfilepath'] .
				'">' . $GLOBALS['LANG']->getLL('overviewblprotocolactive') .
				'</span>, ' . sprintf($GLOBALS['LANG']->getLL('overviewnentries'), $overviewdata['Blacklists']['blacklistentries']);

			} elseif ($overviewdata['Blacklists']['blacklistingactive'] == 0) {
				$overview .= $GLOBALS['LANG']->getLL('overviewblprotocolinactive');
				$_SESSION['canblreport'] = 0;
			}

			$overview .= '</span>
					</div>';
		}
    	if ($_SESSION['canreport'] == 1) {
	    	$overview .= '<div class="tx-tc-100">
	    			<span class="tx-tc-be-showlist">
	    			<img id="preport" class="tx-tc-datarequester tx-tc-be-link" align="left" src="' . $GLOBALS['BACK_PATH']. $pObj->picpathgfx . $pObj->iconList . '" ' . $pObj->iconWidthHeightTitle . ' title="' . $GLOBALS['LANG']->getLL('listup'). ' '.
	    							$GLOBALS['LANG']->getLL('function4').'" alt="" />
	    			<span id="areport" class="tx-tc-datarequester tx-tc-be-link">'.$GLOBALS['LANG']->getLL('listup').' ' . $GLOBALS['LANG']->getLL('function4') . '</span>
				</span>
	    					</div>';
    	}

		return $overview;
	}

/**
 * Returns text used in the overview
 *
 * @param	array		$overviewdata
 * @param	[type]		$pObj: ...
 * @return	$overview		html with Overviews Systemtext
 */
	public function createSystemtext ($overviewdata, $pObj) {
		require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendSystem.php'));
	    $this->be_db = new toctoc_comments_be_db;
	    $be_dbmessage = $this->be_db->bedb($pObj);
		$overview = '';
		if ($_SESSION['backendpid'] !=0) {
			$overview .= '<div class="tx-tc-100" id="sysbackendpid">' . $GLOBALS['LANG']->getLL('currentpage') . ': ' . $_SESSION['backendpid'] . ', ' .
			$pObj->be_common->getNameofPid($_SESSION['backendpid']) .  '</div>';
		} else {
			$overview .= '<div class="tx-tc-100" id="sysbackendpid">' . $GLOBALS['LANG']->getLL('nocurrentpage') .  '</div>';
		}

		if ($overviewdata['numberofrows'] !=0) {
			$overview .= '<div class="tx-tc-100">' . $GLOBALS['LANG']->getLL('rowsindatabase') . ': <span id="sysnbrofrows">' . $overviewdata['numberofrows'] .  '</span>';
			if ($overviewdata['datalength'] !=0) {
				$overview .= ',  ' . $GLOBALS['LANG']->getLL('sizeindb') .
				': <span id="sysdbsize">' . $pObj->be_common->human_filesize($overviewdata['datalength']) .  '</span>';
			}
			if ($overviewdata['lastcheck'] != '') {
				$overview .= '<br />' . $GLOBALS['LANG']->getLL('lastcheck') . ': <span id="syslastcheck">' . $overviewdata['lastcheck'].  '</span>';
			}

			$overview .= '</div>';

		} else {
			$overview .= '<div class="tx-tc-100">' . $GLOBALS['LANG']->getLL('norowsindatabase') .  '</div>';
		}

		$overview .= '
		<div class="tx-tc-100">
				<div class="tx-tc-margin-right" id="databasehtmlframe">
		' . $be_dbmessage . '
		</div>';

		return $overview;
	}
	/**
	 * Returns text used in the overview
	 *
	 * @param	array		$overviewdata
	 * @param	[type]		$pObj: ...
	 * @return	$overview		html with Overviews Systemtext
	 */
	public function createBLtext ($overviewdata, $pObj) {
		require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendIPs.php'));
		$this->be_ips = new toctoc_comments_be_ips;
		$be_ipsmessage = $this->be_ips->beIPs($pObj, $_SESSION['backendpid'], TRUE);
		$pidlist = '';
		$localblacklist = '';
		if (isset($overviewdata['allLocalBlacklist'])) {
			$localblacklist .= '';
			if ($overviewdata['allLocalBlacklist'] > 0) {
				$pidlist = '(';
				for ($i=0; $i < $overviewdata['pidcount']; $i++) {

					if ($i>0) {
						$pidlist .= ', ';
					}

					$pidlist .= $overviewdata['pids'][$i]['pid'];
				}

				$pidlist .= ')';
			}

			if ($overviewdata['allLocalBlacklist'] > 1) {
				$localblacklist .= sprintf($GLOBALS['LANG']->getLL('overviewlocalblacklistnoverall'), trim($overviewdata['allLocalBlacklist'])) . ' ';
				if ($overviewdata['pidcount'] > 1) {
					$localblacklist .= sprintf($GLOBALS['LANG']->getLL('overviewpids'), $overviewdata['pidcount']) . ' ' . $pidlist;
				} elseif ($overviewdata['pidcount'] == 1) {
					$localblacklist .= $GLOBALS['LANG']->getLL('overview1pid') . ' ' . $pidlist;
				}
			} elseif ($overviewdata['allLocalBlacklist'] == 1) {
				$localblacklist .= $GLOBALS['LANG']->getLL('overviewlocalblacklist1noverall'). ' ' . $pidlist;

			} elseif ($overviewdata['allLocalBlacklist'] == 0) {
				$localblacklist .= $GLOBALS['LANG']->getLL('overviewlocalblacklist0noverall');
			}

		}

		$overview = '
			<div class="tx-tc-100">
				<span class="tx-tc-margin-right"><b>' . $GLOBALS['LANG']->getLL('localblacklist') . '</b></span>
			</div>
			<div class="tx-tc-100">
				<span class="tx-tc-margin-right">' . $localblacklist . '</span>
			</div>
			<div class="tx-tc-100">
				<span class="tx-tc-margin-right"><b>' . $GLOBALS['LANG']->getLL('staticblacklist') . '</b></span>
			</div>
			<div class="tx-tc-100">
				<div class="tx-tc-margin-right" id="spamhaushtmlframe">' . $be_ipsmessage . '
			</div>
			';

		if (!t3lib_extMgm::isLoaded('toctoccommentssiteban')) {
			$overview .= '
			<div class="tx-tc-100">
				<span class="tx-tc-margin-right">' . $GLOBALS['LANG']->getLL('sitebannotloaded') . '</span>
			</div>';
		} else {
			$overview .= '
			<div class="tx-tc-100">
				<span class="tx-tc-margin-right">' . $GLOBALS['LANG']->getLL('sitebanloaded') . '</span>
			</div>';
		}
		return $overview;
	}
}
?>