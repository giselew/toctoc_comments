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
 * BackendReports.php
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
 *   55: class toctoc_comments_be_reports
 *   57:     public function beReports(&$pObj, $pid  = 0, $sessidx = 0)
 *  391:     function visiblizeReportOptionsInt(selval)
 *  433:     function visiblizeReportOptions(obj)
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
class toctoc_comments_be_reports {

	public function beReports(&$pObj, $pid  = 0, $sessidx = 0) {

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
	    if ($fromAjax == TRUE) {
				if (isset($_POST['optreport'])) {
					$_SESSION['optreport']=$_POST['optreport'];
					if (intval($_POST['bulkactreport']) == 1) {
						$_POST['activesessionsince']=$_POST['optreport'];
					} elseif (intval($_POST['bulkactreport']) == 3) {
						$_POST['crawleraggregate']=$_POST['optreport'];
					} elseif (intval($_POST['bulkactreport']) == 4) {
						$_POST['blacklistaggregate']=$_POST['optreport'];
					}
				} else {
					if (intval($_POST['bulkactreport']) == 1) {
						$_POST['activesessionsince']=$_SESSION['optreport'];
					} elseif (intval($_POST['bulkactreport']) == 3) {
						$_POST['crawleraggregate']=$_SESSION['optreport'];
					} elseif (intval($_POST['bulkactreport']) == 4) {
						$_POST['blacklistaggregate']=$_SESSION['optreport'];
					}
				}

			}

			$editTable = 'tx_toctoc_comments_feuser_mm';
	    	$infomessage = '';
	    	$selected0 = ' selected';
	    	$selected1 = '';
	    	$selected2 = '';
	    	$selected3 = '';
	    	$selected4 = '';
	    	$boxstyle1 = '';
	    	$boxstyle2 = '';
	    	$boxstyle3 = '';
	    	$boxstyle4 = '';

	    	if (($_SESSION['reportlistidx'] ==1) || (intval($_POST['bulkactreport']) == 1)) {
	    		$selected0 = '';
	    		$selected1 = ' selected';
	    		$selected2 = '';
	    		$selected3 = '';
	    		$selected4 = '';
	    		$boxstyle1 = ' style="background: #c4c4c4"';
	    		$boxstyle2 = '';
	    		$boxstyle3 = '';
	    		$boxstyle4 = '';

	    	}
	    	if (($_SESSION['reportlistidx'] ==2) || (intval($_POST['bulkactreport']) == 2)) {
	    		$selected0 = '';
	    		$selected1 = '';
	    		$selected2 = ' selected';
	    		$selected3 = '';
	    		$selected4 = '';
	    		$boxstyle1 = '';
	    		$boxstyle2 = ' style="background: #c4c4c4"';
	    		$boxstyle3 = '';
	    		$boxstyle4 = '';

	    	}
	    	if (($_SESSION['reportlistidx'] ==3) || (intval($_POST['bulkactreport']) == 3)) {
	    		$selected0 = '';
	    		$selected1 = '';
	    		$selected2 = '';
	    		$selected3 = ' selected';
	    		$selected4 = '';
	    		$boxstyle1 = '';
	    		$boxstyle2 = '';
	    		$boxstyle3 = ' style="background: #c4c4c4"';
	    		$boxstyle4 = '';

	    	}
	    	if (($_SESSION['reportlistidx'] == 4) || (intval($_POST['bulkactreport']) == 4)) {
	    		$selected0 = '';
	    		$selected1 = '';
	    		$selected2 = '';
	    		$selected3 = '';
	    		$selected4 = ' selected';
	    		$boxstyle1 = '';
	    		$boxstyle2 = '';
	    		$boxstyle3 = '';
	    		$boxstyle4 = ' style="background: #c4c4c4"';

	    	}
	    	if (intval($_POST['activesessionsince']) == 0) {
		    	$oselected0 = ' selected';
		    	$oselected1 = '';
		    	$oselected2 = '';
		    	$oselected3 = '';
	    	} elseif (intval($_POST['activesessionsince']) == 1) {
	    		$oselected0 = '';
	    		$oselected1 = ' selected';
	    		$oselected2 = '';
	    		$oselected3 = '';

	    	} elseif (intval($_POST['activesessionsince']) == 2) {
	    		$oselected0 = '';
	    		$oselected1 = '';
	    		$oselected2 = ' selected';
	    		$oselected3 = '';
	    	} elseif (intval($_POST['activesessionsince']) == 3) {
	    		$oselected0 = '';
	    		$oselected1 = '';
	    		$oselected2 = '';
	    		$oselected3 = ' selected';
	    	}

	    	$cselected0 = '';
	    	$cselected1 = '';
	    	$cselected2 = ' selected';
	    	if (isset($_POST['crawleraggregate'])) {
				if (intval($_POST['crawleraggregate']) == 0) {
			    	$cselected0 = 'selected';
			    	$cselected1 = '';
			    	$cselected2 = '';
				} elseif (intval($_POST['crawleraggregate']) == 1) {
		    		$cselected0 = '';
		    		$cselected1 = ' selected';
		    		$cselected2 = '';
		    	} elseif (intval($_POST['crawleraggregate']) == 2) {
		    		$cselected0 = '';
		    		$cselected1 = '';
		    		$cselected2 = ' selected';
		    	}
	    	}

	    	$blselected0 = '';
	    	$blselected1 = '';
	    	$blselected2 = ' selected';
	    	if (isset($_POST['blacklistaggregate'])) {
		    	if (intval($_POST['blacklistaggregate']) == '1') {
		    		$blselected0 = '';
		    		$blselected1 = ' selected';
		    		$blselected2 = '';
		    	} elseif (intval($_POST['blacklistaggregate']) == '0') {
			    	$blselected0 = ' selected';
			    	$blselected1 = '';
			    	$blselected2 = '';
		    	} elseif (intval($_POST['blacklistaggregate']) == '2') {
		    		$blselected0 = '';
		    		$blselected1 = '';
		    		$blselected2 = ' selected';
		    	}
	    	}

	    	if ($fromAjax == TRUE) {
	    		$visiblereport = array();
	    		$visiblereport[0] = '';
	    		$visiblereport[1] = '';
	    		$visiblereport[2] = '';
	    		$visiblereport[3] = '';
	    		if ($_SESSION['cansessionreport'] == 0) {
	    			$visiblereport[0] = ' tx-tc-dontshow';
	    		}
	    		if ($_SESSION['canactiveusersreport'] == 0) {
	    			$visiblereport[1] = ' tx-tc-dontshow';
	    		}
	    		if ($_SESSION['cancrawlersreport'] == 0) {
	    			$visiblereport[2] = ' tx-tc-dontshow';
	    		}
	    		if ($_SESSION['canblreport'] == 0) {
	    			$visiblereport[3] = ' tx-tc-dontshow';
	    		}
	    		//if (intval($_POST['bulkactreport']) == 0) {
	    		$content .= '
			<script language="javascript" type="text/javascript">

				var numofreports = 4;
	    		var txtblockedcommenting = \'' . htmlspecialchars($GLOBALS['LANG']->getLL('blockedcommenting')) . '\';
	    		var txtblockedfrontend = \'' . htmlspecialchars($GLOBALS['LANG']->getLL('blockedfrontend')) . '\';
	    		var txtblockedSpamhausfrontend = \'' . htmlspecialchars($GLOBALS['LANG']->getLL('blockedSpamhausfrontend')) . '\';
	    		var txtblockedSpamhauscommenting = \'' . htmlspecialchars($GLOBALS['LANG']->getLL('blockedSpamhauscommenting')) . '\';
	    		var extConfuseSpamhausBlocklistForWebsiteBan = ' . intval($pObj->extConf['useSpamhausBlocklistForWebsiteBan']) . ';

			</script>
		    		<div class="tx-tc-100 tx-tc-sessioncolornone">
		    			<span id="showreport1" class="tx-tc-be-link tx-tc-be-bulkactr'.$visiblereport[0] .'"' . $boxstyle1 . '>' .
							$GLOBALS['LANG']->getLL('bulkactreport_one') . '</span>
						<span id="showreport2" class="tx-tc-be-link tx-tc-be-bulkactr'.$visiblereport[1] .'"' . $boxstyle2 . '>' .
							$GLOBALS['LANG']->getLL('bulkactreport_two') . '</span>
						<span id="showreport3" class="tx-tc-be-link tx-tc-be-bulkactr'.$visiblereport[2] .'"' . $boxstyle3 . '>' .
							$GLOBALS['LANG']->getLL('bulkactreport_three') . '</span>
						<span id="showreport4" class="tx-tc-be-link tx-tc-be-bulkactr'.$visiblereport[3] .'"' . $boxstyle4 . '>' .
							$GLOBALS['LANG']->getLL('bulkactreport_four') . '</span>
					</div>
					<div class="tx-tc-reportoptionarea tx-tc-100">

    			   <div class="reportoptions" id="rep1options">
						<div class="tx-tc-100">
				    		<div id="subpaneltitle1" class="tx-tc-subpaneltitle">'.$GLOBALS['LANG']->getLL('SessionreportOptions').'</div>
				    	</div>
					    <div class="tx-tc-50">
						    <label for="activesessionsince" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('activesessionsince').': </label>
						    <select id="optreport6g91" name="activesessionsince" size="4" onchange="">
							    <option value="0" ' . $oselected0 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_zero').'</option>
							    <option value="1" ' . $oselected1 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_one').'</option>
							    <option value="2" ' . $oselected2 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_two').'</option>
							    <option value="3" ' . $oselected3 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_three').'</option>
						    </select>
						</div>
					    <div class="tx-tc-50">
						    <span id="actreport6g91" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact">
			    					<img id="pactreport6g91" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
										' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconViewReport . '" ' .
										$pObj->iconWidthHeight . 'title="'.$GLOBALS['LANG']->getLL('bulkactreport_one').'" alt="" />'.
	    							$GLOBALS['LANG']->getLL('showup').' ' .
										$GLOBALS['LANG']->getLL('bulkactreport_one') . '
		    				</span>
							<span id="txtcbe-ajaxloadingreport1" class="tx-tc-loadingbar" style="display: none;">
									<img width="32" src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    							$GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    					</span>
						</div>
				  	</div>

				  	<div class="reportoptions" id="rep2options">
			    		<div class="tx-tc-100">
					    	<div id="subpaneltitle2" class="tx-tc-subpaneltitle">'.$GLOBALS['LANG']->getLL('ActiveUsersreportOptions').'</div>
					    </div>
					    <div class="tx-tc-50">
					    	<div class="tx-tc-100">
						    	<label for="activeuserreportsince" class="tx-tc-label">'.
						    	str_replace('(yyyy-mm-tt)', '', $GLOBALS['LANG']->getLL('activeuserreportsince')).': </label>
						    	<input type="text" size="18" placeholder="yyyy-mm-tt" name="activeuserreportsince" id="activeuserreportsince" value="' . $_POST['activeuserreportsince'] . '" />
							</div>
						    <div class="tx-tc-100">
					    		<label for="activeuserreportto" class="tx-tc-label">'.str_replace('(yyyy-mm-tt)', '', $GLOBALS['LANG']->getLL('activeuserreportto')).': </label>
					    		<input type="text" placeholder="yyyy-mm-tt" size="18" name="activeuserreportto" id="activeuserreportto" value="' . $_POST['activeuserreportto'] . '" />
							</div>

				  		</div>
					    <div class="tx-tc-50">
					    	<div class="tx-tc-100">
						    	<label for="activeuserreporttimedays" class="tx-tc-label">'.
		    							    $GLOBALS['LANG']->getLL('activeuserreporttimedays').': </label>
						    	<input type="text" placeholder="1" size="7" id="activeuserreporttimedays" name="activeuserreporttimedays" value="' . $_POST['activeuserreporttimedays'] . '" />
						    </div>
						    <div class="tx-tc-100">
						    	<span id="actreport6g92" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact">
		    					<img id="pactreport6g92" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
									' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconViewReport . '" ' .
									$pObj->iconWidthHeight . 'title="'.$GLOBALS['LANG']->getLL('bulkactreport_two').'" alt="" />'.
	    							$GLOBALS['LANG']->getLL('showup').' ' .
									$GLOBALS['LANG']->getLL('bulkactreport_two') . '
		    					</span>
								<span id="txtcbe-ajaxloadingreport2" class="tx-tc-loadingbar" style="display: none;">
									<img width="32" src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    							$GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    						</span>
							</div>
						</div>
					</div>

				 	<div class="reportoptions" id="rep3options">
				    	<div class="tx-tc-100">
					    	<div  id="subpaneltitle3" class="tx-tc-subpaneltitle">'.$GLOBALS['LANG']->getLL('CrawlerreportOptions').'</div>
					   </div>
					    <div class="tx-tc-50">
						    <div>
					    <label for="crawleraggregate" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('crawleraggregate').': </label>
					    <select id="optreport6g93" name="crawleraggregate" size="3">
						    <option value="2" ' . $cselected2 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_two').'</option>
						    <option value="1" ' . $cselected1 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_one').'</option>
						    <option value="0" ' . $cselected0 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_zero').'</option>
					    </select>
						    </div>
						 </div>
					    <div class="tx-tc-50">
				  			<span id="actreport6g93" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact">
		    				<img id="pactreport6g93" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
									' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconViewReport . '" ' .
									$pObj->iconWidthHeight . 'title="'.$GLOBALS['LANG']->getLL('bulkactreport_three').'" alt="" />'.
	    							$GLOBALS['LANG']->getLL('showup').' ' .
									$GLOBALS['LANG']->getLL('bulkactreport_three') . '
	    					</span>
							<span id="txtcbe-ajaxloadingreport3" class="tx-tc-loadingbar" style="display: none;">
									<img width="32" src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    							$GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    					</span>
						</div>
					</div>
				  	<div class="reportoptions" id="rep4options">
						<div class="tx-tc-100">
						    <div id="subpaneltitle4" class="tx-tc-subpaneltitle">'.$GLOBALS['LANG']->getLL('BlacklistreportOptions').'</div>
						 </div>
						 <div class="tx-tc-50">
						    <div>
						    	<label for="blacklistaggregate" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('blacklistaggregate').': </label>
						    	<select id="optreport6g94" name="blacklistaggregate" size="3">
								    <option value="2" ' . $blselected2 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_two').'</option>
								    <option value="1" ' . $blselected1 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_one').'</option>
								    <option value="0" ' . $blselected0 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_zero').'</option>
							    </select>
							 </div>
						 </div>
					    <div class="tx-tc-50">
						    <div>
								<span id="actreport6g94" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact">
				    				<img id="pactreport6g94" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
											' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconViewReport . '" ' .
											$pObj->iconWidthHeight . 'title="'.$GLOBALS['LANG']->getLL('bulkactreport_four').'" alt="" />'.
	    							$GLOBALS['LANG']->getLL('showup').' ' .
											$GLOBALS['LANG']->getLL('bulkactreport_four') . '
			    				</span>
								<span id="txtcbe-ajaxloadingreport4" class="tx-tc-loadingbar" style="display: none;">
									<img width="32" src="'.$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    							$GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    						</span>
							</div>
					  </div>
					</div>
	    			<div id="jscleaning">
		    			<div id="txtcbulkstatus" class="tx-tc-100" style="display: none;">
	    				</div>
		    			<div class="clearit">&nbsp;</div>

	    	';
	    		//}
	    	} else {
	    		$content .= '
			<script language="javascript" type="text/javascript">
				var numofreports = 4;
				function visiblizeReportOptionsInt(selval)	{
					var elemcap=document.getElementById(\'rep\' + selval + \'options\');
					if (elemcap) {
						elemcap.style.display = \'block\';
						for (i=1;i<=numofreports;i++) {
							if (i != selval) {
								elemcap=document.getElementById(\'rep\' + i + \'options\');
					    		if (elemcap) {
									elemcap.style.display = \'none\';
					    		}

							}

						}
						elemcap=document.getElementById(\'repsubmit\');
						if (elemcap) {
						    elemcap.style.display = \'block\';
						}

					} else {
						for (i=1;i<=numofreports;i++) {
							elemcap=document.getElementById(\'rep\' + i + \'options\');
			    			if (elemcap) {
	    						elemcap.style.display = \'none\';
			    			}

					    	elemcap=document.getElementById(\'repsubmit\');
					   		if (elemcap) {
					   			elemcap.style.display = \'none\';
					   		}

						}
					}

				}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$obj: ...
	 * @return	[type]		...
	 */
			    function visiblizeReportOptions(obj)	{
			    	visiblizeReportOptionsInt(obj.value);
				}
			    var selreport = ' . intval($_POST['bulkactreport']) . ';
			</script>
					<div class="tx-tc-reportoptionarea"><fieldset>
					  '.$GLOBALS['LANG']->getLL('bulkreports').':
					  <select name="bulkactreport" size="1" onchange="visiblizeReportOptions(this)">
					    <option value="0" ' . $selected0 . '>'.$GLOBALS['LANG']->getLL('bulkactreport_zero').':</option>
					    <option value="1" ' . $selected1 . '>'.$GLOBALS['LANG']->getLL('bulkactreport_one').'</option>
					    <option value="2" ' . $selected2 . '>'.$GLOBALS['LANG']->getLL('bulkactreport_two').'</option>
					    <option value="3" ' . $selected3 . '>'.$GLOBALS['LANG']->getLL('bulkactreport_three').'</option>
					    <option value="4" ' . $selected4 . '>'.$GLOBALS['LANG']->getLL('bulkactreport_four').'</option>
					    		</select>
					  <div class="reportoptions" id="rep1options">
					    <span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('SessionreportOptions').'</span>
					    		 <br />
					    <label for="activesessionsince" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('activesessionsince').': </label>
					    		 <select name="activesessionsince" size="1" onchange="">
					    <option value="0" ' . $oselected0 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_zero').'</option>
					    <option value="1" ' . $oselected1 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_one').'</option>
					    <option value="2" ' . $oselected2 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_two').'</option>
					    <option value="3" ' . $oselected3 . '>'.$GLOBALS['LANG']->getLL('activesessionsince_three').'</option>
					    </select>
					  </div>
					  <div class="reportoptions" id="rep2options">
					  	<div class="tx-tc-100">
					    	<span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('ActiveUsersreportOptions').'</span>
					     </div>
					    <div class="tx-tc-50">
						    <label for="activeuserreportsince" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('activeuserreportsince').': </label>
						    <input type="text" size="18" name="activeuserreportsince" value="' . $_POST['activeuserreportsince'] . '" />
						</div>
					    <div class="tx-tc-50">
						     <label for="activeuserreportto" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('activeuserreportto').': </label>
						    <input type="text" size="18" name="activeuserreportto" value="' . $_POST['activeuserreportto'] . '" />
						</div>
					    <div class="tx-tc-100">
						    <label for="activeuserreporttimedays" class="tx-tc-label">'.
						    $GLOBALS['LANG']->getLL('activeuserreporttimedays').': </label>
						    <input type="text" size="7" name="activeuserreporttimedays"  value="' . $_POST['activeuserreporttimedays'] . '" />
					   </div>
					  </div>
					  <div class="reportoptions" id="rep3options">
					    <span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('CrawlerreportOptions').'</span>
					    <br />
					   	<label for="crawleraggregate" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('crawleraggregate').': </label>
					    <select name="crawleraggregate" size="1" onchange="">
						    <option value="2" ' . $cselected2 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_two').'</option>
						    <option value="1" ' . $cselected1 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_one').'</option>
						    <option value="0" ' . $cselected0 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_zero').'</option>
					    </select>

					  </div>
					  <div class="reportoptions" id="rep4options">
					    <span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('BlacklistreportOptions').'</span>
						<br />
					    <label for="blacklistaggregate" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('blacklistaggregate').': </label>
					    <select name="blacklistaggregate" size="1" onchange="">
						    <option value="2" ' . $blselected2 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_two').'</option>
						    <option value="1" ' . $blselected1 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_one').'</option>
						    <option value="0" ' . $blselected0 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_zero').'</option>
					    </select>
					  </div>
					  <input type="hidden" name="admincommand4" value="4">
					  <input type="hidden" name="actadmincommand4" value="1">
					  <input type="submit" id="repsubmit" name="actreport" value="'.$GLOBALS['LANG']->getLL('makereport').'" onclick="" />
					</div>
					<script language="javascript" type="text/javascript">
						if(selreport > 0) {
							visiblizeReportOptionsInt(selreport);
						};
					</script>
					</fieldset>
					<div class="clearit">&nbsp;</div>
					';
				}
		    	// Bulk actions
    			if(isset($_POST['bulkactreps'])) {
			    	if(intval($_POST['bulkactreps']) > 0) {
			    		$fields = array();
			    		if (isset($_POST['fields'])) {
			    			if (is_array($_POST['fields'])) {
			    				$fields = $_POST['fields'];
			    			} else {
			    				$fields = explode('7g87g8', $_POST['fields']);
			    			}

			    		}
		    			// session report
		    			$numsessions = count($fields);
		    			$numsessionsstring = '<span id="numsessions" style="display: none;">' . $numsessions . '</span>';
		    			$contenttable = '';
		    			$numsessionsdone = 0;
		    			// SessionName [drop], SessionAgeHMS, SessionLastuse, Sessionsize, SessionActiveTime, emailOrIp, Sessionip [block/unblock],
		    			// Sessionipresolved, InitialName, toctoc_comments_user
		    			if ($_POST['bulkactreps'] == '1') {
		    				if ($numsessions > 0) {
			    				foreach ($fields as $field) {

			    					$farr = explode('6g9-6g9', $field);
			    					$delfile = $farr[0];
			    					if ($fromAjax == TRUE) {
			    						$delfile = base64_decode(rawurldecode($farr[0]));
			    					}

			    					if (file_exists($delfile)) {
			    						unlink($delfile);
			    						$numsessionsdone++;
			    					}

			    				}
			    				if ($numsessionsdone == 1){
			    					$infomessage = $GLOBALS['LANG']->getLL('permanentsessionsdelete1');
			    				} elseif ($numsessionsdone >1){
			    					$infomessage =  sprintf($GLOBALS['LANG']->getLL('permanentsessionsdeleten'), $numsessionsdone);
			    				}
		    				}
		    			} elseif ($_POST['bulkactreps'] == '2') {

		    				if ($numsessions > 0) {
		    					$infomessage = $GLOBALS['LANG']->getLL('blockcommenting1');
		    					if ($numsessions !=1){
		    						$infomessage =  sprintf($GLOBALS['LANG']->getLL('blockcommentingn'), $numsessions);
		    					}

		    					foreach ($fields as $field) {
		    						$farr = explode('6g9-6g9', $field);
		    						$blockip = $farr[1];
		    						$pObj->be_common->addLocalBL($blockip, 0);
		    					}
		    				}

		    			} elseif ($_POST['bulkactreps'] == '3') {
		    				if ($numsessions > 0) {
		    					$infomessage = $GLOBALS['LANG']->getLL('blockfe1');
		    					if ($numsessions !=1){
		    						$infomessage =  sprintf($GLOBALS['LANG']->getLL('blockfen'), $numsessions);
		    					}

		    					foreach ($fields as $field) {
		    						$farr = explode('6g9-6g9', $field);
		    						$blockip = $farr[1];
		    						$pObj->be_common->addLocalBL($blockip, 1);

		    					}
		    				}
		    			}
		    			if (($_POST['bulkactreps']) && ($numsessions == 0)) {
		    				$infomessage = $GLOBALS['LANG']->getLL('nothingtodo');
		    				$alertmsg = 1;
		    			}

	    	}

    	}
	$reporttitle = '';
	if ($infomessage != '') {
		if(isset($_POST['bulkactreps'])) {
			$outinfomessage= '<div class="tx-tc-messagebody">' . $infomessage . '</div><div class="tx-tc-messageclosebutton" title="'.$GLOBALS['LANG']->getLL('closemessage').'">x</div>';
		}

		if ($alertmsg == 1) {
			$outinfomessage = '<div class="tx-tc-alert">' . $outinfomessage . '</div>';
		} else {
			$outinfomessage = '<div class="tx-tc-information">' . $outinfomessage . $cachemessage . '</div>';
		}

	}

	if (($_POST['bulkactreps']) && ($fromAjax)) {
		unset($_POST['fields']);
		unset($_POST['bulkactreps']);
		$pObj->content=$outinfomessage . $numsessionsstring;
		return;
	}

	if (!$_SESSION['backendcontentreportlist'][$sessidx]) {

		if($_POST['bulkactreport'] == '1') {
			$reporttitle = '<span class="tx-tc-reporttitle">' . $GLOBALS['LANG']->getLL('bulkreports') . ': '. $GLOBALS['LANG']->getLL('bulkactreport_one') . '</span>';
			$sessionrows = $pObj->be_common->getSessionArray(intval($_POST['activesessionsince']));
			$countsessionrows = count($sessionrows);
			$pObj->currentTable = 'tx_toctoc_comments_user';
	    	if($countsessionrows >= 1) {

	    		$contenttable .= '<div class="tx-tc-flipflop-repsess"><div class="tx-tc-flipflop">
					  	<div class="tx-tc-flips">'.$GLOBALS['LANG']->getLL('showup').': '.$GLOBALS['LANG']->getLL('showflip').'</div>
						 <div class="tx-tc-flipflop-cont">
						  	<div class="tx-tc-flip1">'.$GLOBALS['LANG']->getLL('SessionName').'</div>
						  	<div class="tx-tc-flop1">'.$GLOBALS['LANG']->getLL('Sessionfilesize').'</div>
						  	<div class="tx-tc-flip2">'.$GLOBALS['LANG']->getLL('SessionLastuse').'</div>
						  	<div class="tx-tc-flop2">'.$GLOBALS['LANG']->getLL('emailOrIp').'</div>
						  	<div class="tx-tc-flip3">'.$GLOBALS['LANG']->getLL('SessionUser').'</div>
						  	<div class="tx-tc-flop3">'.$GLOBALS['LANG']->getLL('ipresolvedip').'</div>
						 	<div class="tx-tc-flip4">'.$GLOBALS['LANG']->getLL('UserAgent').'</div>
						  	<div class="tx-tc-flop4">'.$GLOBALS['LANG']->getLL('lastPage').'</div>
						  </div>
				  	</div>
		  			<fieldset><table id="tablesorter-reps" class="tablesorter">
				      <thead>
					<tr>
    				  <th class="id tx-tc-be-dispnone"></th>
					  <th class="tx-tc-wm60 tx-tc-flip1-col">'.$GLOBALS['LANG']->getLL('SessionName').'</th>
					  <th class="tx-tc-wm60 tx-tc-flip2-col">'.$GLOBALS['LANG']->getLL('SessionLastuse').'</th>
					  <th class="tx-tc-wm30 tx-tc-flop1-col">'.$GLOBALS['LANG']->getLL('Sessionfilesize').'</th>
					  <th class="tx-tc-wm60 tx-tc-flop2-col">'.$GLOBALS['LANG']->getLL('emailOrIp').'</th>
					  <th class="tx-tc-wm100 tx-tc-flip3-col">'.$GLOBALS['LANG']->getLL('SessionUser').'</th>
					  <th class="tx-tc-wm100 tx-tc-flop4-col">'.$GLOBALS['LANG']->getLL('lastPage').'</th>
					  <th class="tx-tc-wm60 tx-tc-flop3-col">'.$GLOBALS['LANG']->getLL('ipresolvedip').'</th>
					  <th class="tx-tc-wm100 tx-tc-flip4-col">'.$GLOBALS['LANG']->getLL('UserAgent').'</th>
					  <th class="tx-tc-wm20"><input type="checkbox" class="checkall" title="'.$GLOBALS['LANG']->getLL('check_all').'"></th>
					</tr>
					</thead>';

    		$infomessage .= '<span id="countsomesessionrows">
    				' .
      		$GLOBALS['LANG']->getLL('statssessionsfound') . ': <span id="countsessionrows">' . $countsessionrows . '</span>
      				</span>
      				' .
    				'<span id="countnosessionrows" style="display: none;">' . $GLOBALS['LANG']->getLL('nosessionsfound'). '
    				</span>';
    		$num_rows = count($sessionrows);
    		$totalsize=0;
    		$minlastuse = microtime(TRUE);
    		$microtime = $minlastuse;
    		$maxlastuse = 0;
			foreach ($sessionrows as $sessionrow) {
    			$editUidprt = $sessionrow['SessionName'] . $sessionrow['PHPCookie'];
    			$editUid = $sessionrow['SessionName'];
    			$toctocuser = $sessionrow['toctoc_comments_user'];
    			$InitialName = $sessionrow['InitialName'];
    			$ActiveTimeStr =$pObj->be_common->activetime($sessionrow['ActiveTime']);
    			if ($ActiveTimeStr != '') {
    				$ActiveTimeStr = ' ' . $GLOBALS['LANG']->getLL('active') . ': ' . $ActiveTimeStr;
    			}

    			$IPStr = '';
    			if ($sessionrow['Sessionip'] != '') {
    				if (strlen($sessionrow['Sessionip']) > 16) {
    					$whoisurl = $pObj->extConf['urlWhoisIP6'];
    				} else {
    					$whoisurl = $pObj->extConf['urlWhoisIP4'];
    				}

    				$IPStr = '<a class="tx-tc-externallink" href="' . $whoisurl  .
		    				$sessionrow['Sessionip'] . '" target="_whois" title="' . trim(htmlspecialchars($GLOBALS['LANG']->getLL('whois') . ' ' . $sessionrow['Sessionip'] . '?')) . '" >' .
    				$sessionrow['Sessionip'] . '</a>';
    			}

    			$blacklistarr = $pObj->be_common->getBlacklistForIP($sessionrow['Sessionip']);
    			$strbl = '';
    			$supclass = '';

    			if ($fromAjax == TRUE) {
    				$rowUid = $sessionrow['SessionLastuseTs'];
    				$fieldval = rawurlencode(base64_encode($sessionrow['SessionNameFull'])) . '6g9-6g9' .
    						htmlspecialchars($sessionrow['Sessionip']) . '6g9-6g9' . trim($rowUid);

    			} else {
    				$fieldval = $sessionrow['SessionNameFull'] . '6g9-6g9' .
    						$sessionrow['Sessionip'] .'6g9-6g9' . trim($editUid);
    				$rowUid=trim($editUid);
    			}
    			$supclass = 'tx-tc-sup';
    			if (count($blacklistarr) == 2) {
    				if ($blacklistarr[0] == 1) {
    					$strbl = $GLOBALS['LANG']->getLL('blockedcommenting');
    				}

    				if ($blacklistarr[0] == 2) {
    					$strbl = $GLOBALS['LANG']->getLL('blockedfrontend');
    					$supclass = 'tx-tc-sup tx-tc-alert';
    				}

    				if ($blacklistarr[1] == 1) {
    					if ($pObj->extConf['useSpamhausBlocklistForWebsiteBan'] == 1) {
    						$strbl = '' . $GLOBALS['LANG']->getLL('blockedSpamhausfrontend') . '';
    						$supclass = 'tx-tc-sup  tx-tc-alert';
    					} else {
    						$strbl = '' . $GLOBALS['LANG']->getLL('blockedSpamhauscommenting') . '';
    					}

    				}

    				if ($strbl != '') {
    					$strbl = '<sup id="sup-row-' . trim($rowUid) . '" class="' . $supclass . '" title="' . trim($strbl) . '">&#8709;</sup>';
    				}
    			}

    			$totalsize+=$sessionrow['Sessionsize'];
    			if ($minlastuse > $sessionrow['SessionLastuseTs']) {
    				$minlastuse = $sessionrow['SessionLastuseTs'];
    			}

    			if ($maxlastuse < $sessionrow['SessionLastuseTs']) {
    				$maxlastuse = $sessionrow['SessionLastuseTs'];
    			}

    			$contenttable .= '
		    					<tr id="txtc-row-' . trim($rowUid) . '">
		    					<td class="img tx-tc-be-dispnone">' . $sessionrow['SessionLastuseTs']. '</td>
								  <td class="date tx-tc-wm60 tx-tc-wwbword tx-tc-flip1-col">' . $editUidprt. '</td>
								  <td class="name tx-tc-wm60 tx-tc-wwbword tx-tc-flip2-col">' . $sessionrow['SessionLastuse'] .
								  $ActiveTimeStr . '</td>
								  <td class="name tx-tc-wm30 tx-tc-wwbword tx-tc-flop1-col">' . $pObj->be_common->human_filesize($sessionrow['Sessionsize']). '</td>
								  <td class="name tx-tc-wm60 tx-tc-wwbword tx-tc-flop2-col">' . $sessionrow['emailOrIp'] . '</td>
								  <td class="name tx-tc-wm100 tx-tc-wwbword tx-tc-flip3-col">' . $sessionrow['toctoc_comments_user'] . '<br>' . $InitialName .  '</td>
								  <td class="name tx-tc-wm100 tx-tc-wwbword tx-tc-flop4-col">' . $sessionrow['LastVisitedPage'] . '<sup>' . $sessionrow['activelang'] . '</sup><sup title="page count">' . $sessionrow['numberOfPages'] . '</sup></td>
								  <td class="name tx-tc-wm60 tx-tc-wwbword tx-tc-flop3-col">' . $sessionrow['Sessionipresolved'] .
								  '<br>' . $IPStr . '<span id="ctlsup-row-' . trim($rowUid) . '"></span>' . $strbl . '</td>
								  <td class="name tx-tc-wm100 tx-tc-wwbword tx-tc-flip4-col">' . $sessionrow['httpUserAgent'] . '</td>
								  <td class="tx-tc-wm20"><input type="checkbox" name="fields[]" value="' . $fieldval . '" /></td>';

    			$contenttable .= '
						</tr>
					';
			}

			$usetime = $microtime - $minlastuse;
			$ActiveTimeStr =$pObj->be_common->activetime($usetime);
			$usetimestr = '';

			if ($usetime != 0) {
				$usetimestr = '<br>' . $GLOBALS['LANG']->getLL('timesincefirstsession') . ': ' . $ActiveTimeStr;
				$datemin = date('Y-m-d H:i:s', $minlastuse);
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('COUNT(hash) AS typo3sessions', 'fe_session_data', 'tstamp>' . $minlastuse, '', '');
				while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
					if ($row[typo3sessions]) {
						$usetimestr .= '<br>' . $GLOBALS['LANG']->getLL('numberTYPO3sessions') . ' ' . $datemin . ': ' .  $row[typo3sessions];
					}

				}

			}

			$contenttable .= '
			  </table>
			';
			$infomessage .= '<span id="countsomesessionrowsrest">, ' . $GLOBALS['LANG']->getLL('totalsize') . ': ' . $pObj->be_common->human_filesize($totalsize) .
			$usetimestr .'</span>';
    	} else {
    		$infomessage .= $GLOBALS['LANG']->getLL('nosessionsfound');
    	}

    	$showwhat = $GLOBALS['LANG']->getLL('show_sessions');

    } elseif($_POST['bulkactreport'] == '2') {
    	$reporttitle = '<span class="tx-tc-reporttitle">' . $GLOBALS['LANG']->getLL('bulkreports') . ': '. $GLOBALS['LANG']->getLL('bulkactreport_two') . '</span>';
    	$contenttable='';
    	// user activity report
    	// Show all users on root page
    	$dataWherereport .= 'tx_toctoc_comments_feuser_mm.pid = tx_toctoc_comments_user.pid';
    	if($pid == 0) {
    		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('COUNT(DISTINCT(tx_toctoc_comments_user.uid)) as cuid', 'tx_toctoc_comments_feuser_mm,
    				tx_toctoc_comments_user',
    				'tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user != "0.0.0.127.0" AND
    				tx_toctoc_comments_feuser_mm.toctoc_comments_user = tx_toctoc_comments_user.toctoc_comments_user AND
    				tx_toctoc_comments_feuser_mm.pid = tx_toctoc_comments_user.pid', '', '');
    		$dataWherereport .= '';
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
    		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('COUNT(DISTINCT(tx_toctoc_comments_user.uid)) as cuid', 'tx_toctoc_comments_feuser_mm,
    				tx_toctoc_comments_user',
    				'tx_toctoc_comments_user.deleted=0 AND
    				tx_toctoc_comments_user.toctoc_comments_user != "0.0.0.127.0" AND tx_toctoc_comments_user.pid IN ('.$pages.') AND
    				tx_toctoc_comments_feuser_mm.toctoc_comments_user = tx_toctoc_comments_user.toctoc_comments_user AND
    				tx_toctoc_comments_feuser_mm.pid = tx_toctoc_comments_user.pid', '', '');
    		$dataWherereport .= ' AND tx_toctoc_comments_feuser_mm.pid IN ('.$pages.')';
    	}

    	$num_rowsfound = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
    	if ($num_rowsfound == '') {
    		$num_rows = '';
    	} else {
    		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
    			$num_rows = $row['cuid'];
    			break;
    		}

    	}

    	// No user
    	if ($num_rows == '') {
    		$infomessageusersfound .= ''.$GLOBALS['LANG']->getLL('nouser');
    	}
    			// Root Page and 1 user
    	else if ($num_rows == '1' && $pid == '0') {
    		$infomessageusersfound .= '' . $GLOBALS['LANG']->getLL('userglobal_one') . '<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('userglobal_two');
    	}

    	// Root Page and more than 1 user
    	else if ($num_rows > '1' && $pid == '0') {
    		$infomessageusersfound .= ''.$GLOBALS['LANG']->getLL('userglobalmore_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('userglobalmore_two');
    	}

    	// 1 user
    	else if ($num_rows == '1') {
    		$infomessageusersfound .= ''.$GLOBALS['LANG']->getLL('oneuser_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('oneuser_two');
    	} else {
	    	// More user
	    	$infomessageusersfound .= ''.$GLOBALS['LANG']->getLL('morecomments_one').' <b>'.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('moreusers_two');
	    }

    			// Show Table Head only if at least 1 user exists.
	    if($num_rows >= '1') {

	    	$contenttable .= '<div class="tx-tc-flipflop">
	  	<div class="tx-tc-flips">'.$GLOBALS['LANG']->getLL('showup').': '.$GLOBALS['LANG']->getLL('showflip').'</div>
			 <div class="tx-tc-flipflop-cont">
			  	<div class="tx-tc-flip1">'.$GLOBALS['LANG']->getLL('Lastactivity').'</div>
			  	<div class="tx-tc-flop1">'.$GLOBALS['LANG']->getLL('Firstactivity').'</div>
			  	<div class="tx-tc-flip2">'.$GLOBALS['LANG']->getLL('ActiveTime').'</div>
			  	<div class="tx-tc-flop2">'.$GLOBALS['LANG']->getLL('InitialName').'</div>
			  	<div class="tx-tc-flip3">'.$GLOBALS['LANG']->getLL('emailOrUser').'</div>
			  	<div class="tx-tc-flop3">'.$GLOBALS['LANG']->getLL('ipresolved').'</div>
			  </div>
	  	</div>
					     <fieldset>
	    				<table id="tablesorter-repo" class="tablesorter">
					      <thead>
						<tr>
				    	  <th class="id tx-tc-be-dispnone"></th>
						  <th class="tx-tc-wm60 tx-tc-flip1-col">'.$GLOBALS['LANG']->getLL('Lastactivity').'</th>
						  <th class="tx-tc-wm60 tx-tc-flop1-col">'.$GLOBALS['LANG']->getLL('Firstactivity').'</th>
						  <th class="tx-tc-wm100nomax">'.$GLOBALS['LANG']->getLL('toctoc_comments_user').'</th>
						  <th class="tx-tc-wm60 tx-tc-flip2-col">'.$GLOBALS['LANG']->getLL('ActiveTime').'</th>
						  <th class="tx-tc-wm60 tx-tc-flop2-col">'.$GLOBALS['LANG']->getLL('InitialName').'</th>
						  <th class="tx-tc-wm60 tx-tc-flip3-col">'.$GLOBALS['LANG']->getLL('emailOrUser').'</th>
						  <th class="tx-tc-wm60nomax tx-tc-flop3-col">'.$GLOBALS['LANG']->getLL('ipresolved').'</th>
						</tr>
						</thead>';
	    }
    $having='';
    $dataWherereport .= ' AND tx_toctoc_comments_feuser_mm.toctoc_comments_user = tx_toctoc_comments_user.toctoc_comments_user AND
tx_toctoc_comments_user.toctoc_comments_user <> "0.0.0.127.0"';
    if ($_POST['activeuserreporttimedays'] != '') {
    	if (intval($_POST['activeuserreporttimedays']) > 0) {
			$having = 'HAVING (MAX(tx_toctoc_comments_feuser_mm.tstamp)-MIN(tx_toctoc_comments_feuser_mm.tstamp)) > ' . 86000*intval($_POST['activeuserreporttimedays']) . '';
		}

    }

    if ($_POST['activeuserreportsince'] != '') {
    	if (intval($_POST['activeuserreporttimedays']) == 0) {
    		$having = 'HAVING ';
    	} else {
    		$having .= ' AND ';
    	}

    	$having .= 'MIN(tx_toctoc_comments_feuser_mm.tstamp) > UNIX_TIMESTAMP("' . $_POST['activeuserreportsince'] . '")';
    }

    if ($_POST['activeuserreportto'] != '') {
    	if ((intval($_POST['activeuserreporttimedays']) == 0) && ($_POST['activeuserreportsince'] == '')) {
    		$having = 'HAVING ';
    	} else {
    		$having .= ' AND ';
    	}

    	$having .= 'MAX(tx_toctoc_comments_feuser_mm.tstamp) < UNIX_TIMESTAMP("' . $_POST['activeuserreportto'] . '")';
    }

    $querymerged='SELECT MAX(tx_toctoc_comments_feuser_mm.tstamp) AS TsLastSeen,
FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp)) AS LastSeen,
FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)) AS FirstTimeSeen,
CASE WHEN tx_toctoc_comments_user.initial_email = "" THEN
tx_toctoc_comments_user.toctoc_comments_user ELSE
tx_toctoc_comments_user.initial_email END As emailOrIp,
MAX(tx_toctoc_comments_user.ipresolved) AS ipresolved,
MAX(tx_toctoc_comments_user.ip) AS ip,
MIN(tx_toctoc_comments_user.toctoc_comments_user) AS toctoc_comments_user1,
MAX(tx_toctoc_comments_user.toctoc_comments_user) AS toctoc_comments_user2,
COUNT(DISTINCT tx_toctoc_comments_user.uid) AS CountUid,
COUNT(DISTINCT tx_toctoc_comments_feuser_mm.pid) AS CountPid,
MAX(CONCAT(tx_toctoc_comments_user.initial_firstname, "@@" ,tx_toctoc_comments_user.initial_lastname)) AS InitialName,
DATEDIFF(FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp))) As TotalTime,
TRIM(CONCAT(TIMESTAMPDIFF(YEAR,FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp))),
"-", MOD(TIMESTAMPDIFF(MONTH,FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp))),12),
"-", MOD(TIMESTAMPDIFF(DAY,FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp))),30),
"-", MOD(TIMESTAMPDIFF(HOUR,FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp))),24),
"-", MOD(TIMESTAMPDIFF(MINUTE,FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp))),60),
"-", MOD(TIMESTAMPDIFF(SECOND,FROM_UNIXTIME(MIN(tx_toctoc_comments_feuser_mm.tstamp)),FROM_UNIXTIME(MAX(tx_toctoc_comments_feuser_mm.tstamp))),60))) AS ActiveTime

FROM tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user
WHERE ' . $dataWherereport . ' AND tx_toctoc_comments_feuser_mm.toctoc_comments_user = tx_toctoc_comments_user.toctoc_comments_user
GROUP BY CASE WHEN tx_toctoc_comments_user.initial_email = "" THEN
tx_toctoc_comments_user.toctoc_comments_user ELSE
tx_toctoc_comments_user.initial_email END
		' . $having . '
ORDER BY LastSeen DESC';
	$res = $GLOBALS['TYPO3_DB']->sql_query($querymerged);
	$num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
	$infomessage = $infomessageusersfound . ' ' . $GLOBALS['LANG']->getLL('statsusersfound') . ': ' . $num_rows . '';

	while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
		// Get the fields
		$rowActiveTime = '';
		$cntt = 0;
		$pizzaActiveTime = explode('-', $row['ActiveTime']);
		if ($pizzaActiveTime[0] != 0) {
			if ($pizzaActiveTime[0] == 1) {
				$rowActiveTime .= $pizzaActiveTime[0] . ' ' . $GLOBALS['LANG']->getLL('year') . ' ';
			} else {
				$rowActiveTime .= $pizzaActiveTime[0] .  ' ' . $GLOBALS['LANG']->getLL('years') . ' ';
			}

			$cntt++;
		}

		if ($pizzaActiveTime[1] != 0) {
			if ($pizzaActiveTime[1] == 1) {
				$rowActiveTime .= $pizzaActiveTime[1] . ' ' . $GLOBALS['LANG']->getLL('month') . ' ';
			} else {
				$rowActiveTime .= $pizzaActiveTime[1] .  ' ' . $GLOBALS['LANG']->getLL('months') . ' ';
			}

			$cntt++;
		}

		if ($pizzaActiveTime[2] != 0) {
			if ($pizzaActiveTime[2] == 1) {
				$rowActiveTime .= $pizzaActiveTime[2] .  ' ' . $GLOBALS['LANG']->getLL('day') . ' ';
			} else {
				$rowActiveTime .= $pizzaActiveTime[2] . ' ' . $GLOBALS['LANG']->getLL('days') . ' ';
			}

			$cntt++;
		}

		if ($cntt < 4) {
		   	if ($pizzaActiveTime[3] != 0) {
		   		if ($pizzaActiveTime[3] == 1) {
		   			$rowActiveTime .= $pizzaActiveTime[3] .  ' ' . $GLOBALS['LANG']->getLL('hour') . ' ';
		   		} else {
		   			$rowActiveTime .= $pizzaActiveTime[3] . ' ' . $GLOBALS['LANG']->getLL('hours') . ' ';
		   		}

		   		$cntt++;
		   	}

		}

		if ($cntt < 4) {
    		if ($pizzaActiveTime[4] != 0) {
    			if ($pizzaActiveTime[4] == 1) {
    				$rowActiveTime .= $pizzaActiveTime[4] .  ' ' . $GLOBALS['LANG']->getLL('minute') . ' ';
    			} else {
    					$rowActiveTime .= $pizzaActiveTime[4] . ' ' . $GLOBALS['LANG']->getLL('minutes') . ' ';
    			}

    			$cntt++;
    		}

		}

		if ($cntt < 4) {
    		if ($pizzaActiveTime[5] != 0) {
    			if ($pizzaActiveTime[5] == 1) {
    				$rowActiveTime .= $pizzaActiveTime[5] .  ' ' . $GLOBALS['LANG']->getLL('second') . ' ';
    			} else {
    				$rowActiveTime .= $pizzaActiveTime[5] . ' ' . $GLOBALS['LANG']->getLL('seconds') . ' ';
    			}

    			$cntt++;
    		}
    	}
    	$rowActiveTime = trim($rowActiveTime);
		$rowInitialName='';
		$pizzaInitialName = explode('@@', $row['InitialName']);
		if ($pizzaInitialName[0] != '') {
			$rowInitialName .= $pizzaInitialName[0];
			if ($pizzaInitialName[1] != '') {
				$rowInitialName .= ' ' . $pizzaInitialName[1];
			}

		} elseif ($pizzaInitialName[1] != '') {
			$rowInitialName .= $pizzaInitialName[1];
		}

		$sup = '';
		if ($row['CountUid'] != 1) {
			$sup = '<sup title="' . $row['CountUid'] . ' ' . $GLOBALS['LANG']->getLL('toctoc_userswithEmailorIP') . ' ' . $row['emailOrIp']. ' ' . $GLOBALS['LANG']->getLL('found');
		    if ($row['CountPid'] != 1) {
				$sup .= ' ' . $GLOBALS['LANG']->getLL('in') . ' ' . $row['CountPid'] . ' ' . $GLOBALS['LANG']->getLL('differentStorageFolders') . '.';
		    } else {
		    	$sup .= '.';
		    }

		    if ($row['CountUid'] == 2) {
		    	$toctocuser = $row['toctoc_comments_user1'] . ' ' . $GLOBALS['LANG']->getLL('and') . ' ' . $row['toctoc_comments_user2'];
		    } else {
		    	$toctocuser = $row['toctoc_comments_user1'] . ', ' . $GLOBALS['LANG']->getLL('lastuser') . ' ' . $row['toctoc_comments_user2'];
		    }

		    $sup .= '">' . $GLOBALS['LANG']->getLL('info') . '</sup>';
		} else {
			$toctocuser = $row['toctoc_comments_user1'];
		}

		$ActiveTime = $rowActiveTime;
		$InitialName = $rowInitialName;

		if ((str_replace('0.0.0.0.', '', $row['toctoc_comments_user1']) != $row['toctoc_comments_user1']) ||
				(str_replace('0.0.0.0.', '', $row['toctoc_comments_user2']) != $row['toctoc_comments_user2'])){

			if (str_replace('0.0.0.0.', '', $row['toctoc_comments_user1']) != $row['toctoc_comments_user1']) {
				$feuserid=str_replace('0.0.0.0.', '', $row['toctoc_comments_user1']);
				$ttuser = $row['toctoc_comments_user1'];
			} else {
				$feuserid=str_replace('0.0.0.0.', '', $row['toctoc_comments_user2']);
				$ttuser = $row['toctoc_comments_user2'];
			}

			if ((trim($row['emailOrIp']) == '') && ($feuserid != 0) ||
					(trim($InitialName) == '') && ($feuserid != 0) ||
					(trim($row['emailOrIp']) == $ttuser)) {

				$dataWherefeuser = 'uid=' . $feuserid;
				list($rowfeusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
						'fe_users', $dataWherefeuser);
				if ((trim($InitialName) == '') && ($feuserid != 0)){
					$InitialName = ''.$rowfeusr['first_name'].' '.$rowfeusr['last_name'].'';
					if (trim($InitialName) == '') {
						$InitialName=$rowfeusr['username'];
					}

				}

				if (trim($row['emailOrIp']) == ''){
					$row['emailOrIp'] = $rowfeusr['email'];
				}

				if (trim($row['emailOrIp']) == $ttuser){
					$row['emailOrIp'] = $rowfeusr['email'];
				}
			}
		}

		$editUid = intval($row['TsLastSeen']);
   		$pObj->currentTable = 'tx_toctoc_comments_user';
   		$IPStr = '';
    	if ($row['ipresolved'] != '') {
   			if (strlen($row['ip']) > 16) {
   				$whoisurl = $pObj->extConf['urlWhoisIP6'];
   			} else {
   				$whoisurl = $pObj->extConf['urlWhoisIP4'];
   			}

   			$IPStr = '<a class="tx-tc-externallink" href="' . $whoisurl . $row['ip'] .
	    			'" target="_whois" title="' . $GLOBALS['LANG']->getLL('whois') . ' ' . $row['ip'] . '?" >' .
   					$row['ip'] . '</a>';
   			if ($row['ip'] != $row['ipresolved']) {
   				if ($row['ipresolved'] != '') {
   					$IPStr .= '<br>' . $row['ipresolved'];
   				}

   			}

    	}

		$contenttable .= '
   		<tr>
   	      <td class="img tx-tc-be-dispnone">' . $editUid. '</td>
		  <td class="date tx-tc-wm60 tx-tc-flip1-col">' . $row['LastSeen']. '</td>
		  <td class="name tx-tc-wm60 tx-tc-flop1-col">' . $row['FirstTimeSeen']. '</td>
		  <td class="name tx-tc-wm100nomax">' . $toctocuser . $sup . '</td>
		  <td class="name tx-tc-wm60 tx-tc-flip2-col">' . $ActiveTime . '</td>
		  <td class="name tx-tc-wm60 tx-tc-flop2-col">' . $InitialName . '</td>
		  <td class="name tx-tc-wm60 tx-tc-flip3-col">' . $row['emailOrIp'] . '</td>
		  <td class="name tx-tc-wm60nomax tx-tc-flop3-col">' . $IPStr . '</td>';

   		$contenttable .= '
		    </tr>
		  ';

	}

	$contenttable .= '
			  </table>';
	$showwhat = $GLOBALS['LANG']->getLL('show_activeusers');
} elseif ($_POST['bulkactreport'] == '3') {
	$contentfile = '';

	if (file_exists(str_replace('Classes'. DIRECTORY_SEPARATOR . 'Controller'. DIRECTORY_SEPARATOR . 'Dto', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt'))) {
		$contentfile = file_get_contents(str_replace('Classes'. DIRECTORY_SEPARATOR . 'Controller'. DIRECTORY_SEPARATOR . 'Dto', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt'));
	}

	if ($contentfile == '') {
		$res = array();
		$num_rows = 0;
	} else {
		$res = explode("\r\n", $contentfile);
		$num_rows = count($res);
	}

	$reporttitle = '<span class="tx-tc-reporttitle">' . $GLOBALS['LANG']->getLL('bulkreports') . ': '. $GLOBALS['LANG']->getLL('bulkactreport_three') . '</span>';

	$pObj->currentTable = '';
	$prtcontrolstring = '';
	$entrycnt=0;
	$prtentrycnt=0;
	$infomessage = $GLOBALS['LANG']->getLL('statsprotocolentriesfound') . ': ' . $num_rows . '';
	$aggregatelevel = 0;
    if (isset($_POST['crawleraggregate'])) {
        if ($_POST['crawleraggregate'] == 1) {
        	$aggregatelevel = 1;
        }

        if ($_POST['crawleraggregate'] == 2) {
        	$aggregatelevel = 2;
        }

	}

	if($num_rows >= 1) {

		$contenttable .= '<div class="tx-tc-flipflop">
  	<div class="tx-tc-flips">'.$GLOBALS['LANG']->getLL('showup').': '.$GLOBALS['LANG']->getLL('showflip').'</div>
		 <div class="tx-tc-flipflop-cont">
		  	<div class="tx-tc-flip1">'.$GLOBALS['LANG']->getLL('crawlerFirstAccess').'</div>
		  	<div class="tx-tc-flop1">'.$GLOBALS['LANG']->getLL('crawlerLastAccess').'</div>
		  	<div class="tx-tc-flip2">'.$GLOBALS['LANG']->getLL('UserAgent').'</div>
		  	<div class="tx-tc-flop2">'.$GLOBALS['LANG']->getLL('UserAgentIDstring').'</div>
		  </div>
  	</div><fieldset><table id="tablesorter-repc" class="tablesorter">
			      <thead>
				<tr>
    			  <th class="id tx-tc-be-dispnone"></th>
				  <th class="tx-tc-wm20">'.$GLOBALS['LANG']->getLL('blwl').'</th>
				  <th class="tx-tc-wm150 tx-tc-flip1-col">'.$GLOBALS['LANG']->getLL('crawlerFirstAccess').'</th>
				  <th class="tx-tc-wm150 tx-tc-flop1-col">'.$GLOBALS['LANG']->getLL('crawlerLastAccess').'</th>
				  <th class="tx-tc-wm150 tx-tc-flip2-col">'.$GLOBALS['LANG']->getLL('UserAgent').'</th>
				  <th class="tx-tc-wm150nomax tx-tc-flop2-col">'.$GLOBALS['LANG']->getLL('UserAgentIDstring').'</th>
				  <th class="tx-tc-wm60">'.$GLOBALS['LANG']->getLL('entrycnt').'</th>
				</tr>
				</thead>';
		if ($aggregatelevel > 0) {
			$aggrtable = array();
			$iaggr = 0;
		}

		foreach ($res as $row) {

			$iarrdotdot = explode(':', $row);
			$iagentbase='';
			$icntarrdotdot = count($iarrdotdot);

			for ($i=4;$i<$icntarrdotdot;$i++) {
				$iagentbase .= trim($iarrdotdot[$i]) . ':';
			}

			$iarragentbase = explode(' idfd "', $iagentbase);
			$ihttp_user_agent = trim($iarragentbase[0]);
			if (($prtcontrolstring != '') && ($prtcontrolstring != $ihttp_user_agent)) {
				if ($aggregatelevel == 0) {

					$contenttable .= '
		    					<tr>
		    				      <td class="img tx-tc-be-dispnone">' . $editUid. '</td>
								  <td class="name tx-tc-wm20">' . $blwl. '</td>
								  <td class="date tx-tc-wm150 tx-tc-flip1-col">' . $firstaccesstime. '</td>
								  <td class="name tx-tc-wm150 tx-tc-flop1-col">' . $accesstime . '</td>
								  <td class="name tx-tc-wm150 tx-tc-flip2-col">' . $identifiedbot . '</td>
								  <td class="name tx-tc-wm150nomax tx-tc-flop2-col">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								  <td class="name tx-tc-wm60">' . $entrycnt . '</td>

								 </tr>
							';
					$entrycnt=0;
					$prtentrycnt++;
				} elseif ($aggregatelevel == 1) {
					// find date and useragent
					$ifound = -1;
					for ($i=0;$i<$iaggr;$i++) {
						if ($accessdate == $aggrtable[$i]['accessdate']) {
							if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
								//found
								$ifound = $i;
								break;
							}

						}
					}

					if ($ifound == -1) {
						$aggrtable[$iaggr]['accessdate'] = $accessdate;
						$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
						$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string . '<br><small>' . $http_user_agent . '</small>';
						$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
						$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
						$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
						$aggrtable[$iaggr]['entrycnt'] = intval($entrycnt);
						$aggrtable[$iaggr]['blwl'] = $blwl;
						$iaggr++;

					} else {
						if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
							$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
							$aggrtable[$ifound]['accesstime_to'] = $accesstime;
						}

						if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
							$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
							$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
						}

						$aggrtable[$ifound]['entrycnt'] = intval(intval($aggrtable[$ifound]['entrycnt']) + $entrycnt);

					}
					$entrycnt=0;
				} elseif ($aggregatelevel == 2) {
					// find date and useragent
					$ifound = -1;
					for ($i=0;$i<$iaggr;$i++) {
						if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
							//found
							$ifound = $i;
							break;
						}
					}
					if ($ifound == -1) {
						$aggrtable[$iaggr]['accessdate'] = $accessdate;
						$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
						$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string . '<br><small>' . $http_user_agent . '</small>';
						$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
						$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
						$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
						$aggrtable[$iaggr]['entrycnt'] = intval($entrycnt);
						$aggrtable[$iaggr]['blwl'] = $blwl;
						$iaggr++;

					} else {
						if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
							$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
							$aggrtable[$ifound]['accesstime_to'] = $accesstime;
						}

						if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
							$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
							$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
						}

						$aggrtable[$ifound]['entrycnt'] = intval(intval($aggrtable[$ifound]['entrycnt']) + $entrycnt);

					}
					$entrycnt=0;
				}
			}

			$arrdotdot = explode(':', $row);
			$cntarrdotdot = count($arrdotdot);
			$blwl=$arrdotdot[0];
			$accesstime=trim($arrdotdot[1]) . ':' . $arrdotdot[2]. ':' . $arrdotdot[3];
			$accesstimestamp=strtotime($accesstime);
			$accessdatearr = explode(' ', trim($arrdotdot[1]));
			$accessdate = trim($accessdatearr[0]);
			if (($entrycnt ==0) || (strtotime($firstaccesstime) > $accesstimestamp)) {
				$firstaccesstime = $accesstime;
			}

			$agentbase='';
			for ($i=4;$i<$cntarrdotdot;$i++) {
				$agentbase .= $arrdotdot[$i] . ':';
			}

			$arragentbase = explode(' idfd "', $agentbase);
			$http_user_agent = trim($arragentbase[0]);
			$http_user_agent_string_basearr = explode('@@', $arragentbase[1]);
			$http_user_agent_string_base =$http_user_agent_string_basearr[0];
			$http_user_agent_string = trim(substr($http_user_agent_string_base, 0, (strlen($http_user_agent_string_base)-1)));
			if (($http_user_agent=='HTTP_USER_AGENT missing') || ($http_user_agent=='')) {
				$identifiedbot = 'unknown';
				$http_user_agent_string= 'advanced.dontTakeEmptyAgentStringAsCrawler = 0';
				$http_user_agent='HTTP_USER_AGENT missing';
			} else {
				$identifiedbot = $pObj->be_common->idbot($http_user_agent, $http_user_agent_string);
			}

			$editUid=strtotime($firstaccesstime);
			$prtcontrolstring = $http_user_agent;
			$entrycnt++;
		}

		if ($num_rows >0) {
			if ($aggregatelevel == 0) {

				$contenttable .= '
			    			<tr>
			    			    <td class="img tx-tc-be-dispnone">' . $editUid. '</td>
								<td class="name tx-tc-wm30">' . $blwl. '</td>
								<td class="date tx-tc-wm150 tx-tc-flip1-col">' . $firstaccesstime. '</td>
								<td class="name tx-tc-wm150 tx-tc-flop1-col">' . $accesstime . '</td>
								<td class="name tx-tc-wm150 tx-tc-flip2-col">' . $identifiedbot . '</td>
								<td class="name tx-tc-wm150nomax tx-tc-flop2-col">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								<td class="name tx-tc-wm60">' . $entrycnt . '</td>
							</tr>
				';

				$entrycnt=0;
				$prtentrycnt++;
			} elseif ($aggregatelevel == 1) {
				// find date and useragent
				$ifound = -1;
				for ($i=0;$i<$iaggr;$i++) {
					if ($accessdate == $aggrtable[$i]['accessdate']) {
						if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
							//found
							$ifound = $i;
							break;
						}

					}

				}

				if ($ifound == -1) {
					$aggrtable[$iaggr]['accessdate'] = $accessdate;
					$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
					$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string  . '<br><small>' . $http_user_agent . '</small>';
					$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
					$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
					$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
					$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
					$aggrtable[$iaggr]['entrycnt'] = $entrycnt;
					$aggrtable[$iaggr]['blwl'] = $blwl;
					$iaggr++;
					$entrycnt = 0;

				} else {
					if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
						$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$ifound]['accesstime_to'] = $accesstime;
					}

					if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
						$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
						$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
					}

					$aggrtable[$ifound]['entrycnt'] = intval(intval($aggrtable[$ifound]['entrycnt']) + $entrycnt);
					$entrycnt = 0;
				}

			} elseif ($aggregatelevel == 2) {
				// useragent
				$ifound = -1;
				for ($i=0;$i<$iaggr;$i++) {

					if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
						//found
						$ifound = $i;
						break;
					}

				}

				if ($ifound == -1) {
					$aggrtable[$iaggr]['accessdate'] = $accessdate;
					$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
					$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string  . '<br><small>' . $http_user_agent . '</small>';
					$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
					$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
					$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
					$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
					$aggrtable[$iaggr]['entrycnt'] = $entrycnt;
					$aggrtable[$iaggr]['blwl'] = $blwl;
					$iaggr++;
					$entrycnt = 0;

				} else {
					if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
						$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$ifound]['accesstime_to'] = $accesstime;
					}

					if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
						$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
						$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
					}

					$aggrtable[$ifound]['entrycnt'] = $aggrtable[$ifound]['entrycnt'] + $entrycnt;
					$entrycnt = 0;
				}

			}

			if ($aggregatelevel >= 1) {
				$prtentrycnt=0;
				for ($i=0;$i<$iaggr;$i++) {

					$contenttable .= '
			    			<tr>
			    			    <td class="img tx-tc-be-dispnone">' . $aggrtable[$i]['accesstimestamp_from']. '</td>
								<td class="name tx-tc-wm20">' . $aggrtable[$i]['blwl']. '</td>
								<td class="date tx-tc-wm150 tx-tc-flip1-col">' . $aggrtable[$i]['accesstime_from']. '</td>
								<td class="name tx-tc-wm150 tx-tc-flop1-col">' . $aggrtable[$i]['accesstime_to'] . '</td>
								<td class="name tx-tc-wm150 tx-tc-flip2-col">' . $aggrtable[$i]['http_user_agent'] . '</td>
								<td class="name tx-tc-wm150nomax tx-tc-flop2-col">' . $aggrtable[$i]['http_user_agent_string'] . '</td>
								<td class="name tx-tc-wm60">' . $aggrtable[$i]['entrycnt'] . '</td>
							</tr>
				';
					$prtentrycnt++;
				}
				$infomessageinlist = $GLOBALS['LANG']->getLL('entriesaggregatelist') . ': ' . $prtentrycnt;
			}

			$num_rows = $prtentrycnt;
			$contenttable .= '
					  </table>';
			}
		}

		$showwhat = $GLOBALS['LANG']->getLL('show_crawlerprotocol');
} elseif ($_POST['bulkactreport'] == '4') {
	$contentfile = '';
	if (file_exists(str_replace('Classes'. DIRECTORY_SEPARATOR . 'Controller'. DIRECTORY_SEPARATOR . 'Dto', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'blacklistprotocol.txt'))) {
		$contentfile = file_get_contents(str_replace('Classes'. DIRECTORY_SEPARATOR . 'Controller'. DIRECTORY_SEPARATOR . 'Dto', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'blacklistprotocol.txt'));
	}

	$contentfile = str_replace("\r\n", "\n", $contentfile);
	if ($contentfile == '') {
		$res = array();
		$num_rows = 0;
	} else {
		$res = explode("\n", $contentfile);
		$num_rows = count($res);
	}

	$reporttitle = '<span class="tx-tc-reporttitle">' . $GLOBALS['LANG']->getLL('bulkreports') . ': '. $GLOBALS['LANG']->getLL('bulkactreport_four') . '</span>';
	$pObj->currentTable = '';
	$prtcontrolstring = '';
	$entrycnt=0;
	$prtentrycnt=0;
	$infomessage = $GLOBALS['LANG']->getLL('statsprotocolentriesfound') . ': ' . $num_rows . '';
	$aggregatelevel = 0;
    if ($_POST['blacklistaggregate']) {
       	if ($_POST['blacklistaggregate'] == 1) {
       		$aggregatelevel = 1;
       	}

       	if ($_POST['blacklistaggregate'] == 2) {
       		$aggregatelevel = 2;
       	}

    }

	if($num_rows >= 1) {

		$contenttable .= '<div class="tx-tc-flipflop">
  	<div class="tx-tc-flips">'.$GLOBALS['LANG']->getLL('showup').': '.$GLOBALS['LANG']->getLL('showflip').'</div>
		 <div class="tx-tc-flipflop-cont">
		  	<div class="tx-tc-flip1">'.$GLOBALS['LANG']->getLL('blacklistFirstAccess').'</div>
		  	<div class="tx-tc-flop1">'.$GLOBALS['LANG']->getLL('blacklistLastAccess').'</div>
		  	<div class="tx-tc-flip2">'.$GLOBALS['LANG']->getLL('blacklistentry').'</div>
		  	<div class="tx-tc-flop2">'.$GLOBALS['LANG']->getLL('BLIDbystring').'</div>
		  </div>
  	</div><fieldset><table id="tablesorter-repbl" class="tablesorter">
			      <thead>
				<tr>
   				  <th class="id tx-tc-be-dispnone"></th>
				  <th class="tx-tc-wm100 tx-tc-flip1-col">'.$GLOBALS['LANG']->getLL('blacklistFirstAccess').'</th>
				  <th class="tx-tc-wm100 tx-tc-flop1-col">'.$GLOBALS['LANG']->getLL('blacklistLastAccess').'</th>
				  <th class="tx-tc-wm150 tx-tc-flip2-col">'.$GLOBALS['LANG']->getLL('blacklistentry').'</th>
				  <th class="tx-tc-wm150nomax tx-tc-flop2-col">'.$GLOBALS['LANG']->getLL('BLIDbystring').'</th>
				  <th class="tx-tc-wm60">'.$GLOBALS['LANG']->getLL('entrycnt').'</th>
				</tr>
				</thead>';
		if ($aggregatelevel > 0) {
			$aggrtable=array();
			$iaggr = 0;
		}

		foreach ($res as $row) {
			$iarrdotdot = explode(':', $row);
			$iagentbase='';
			$icntarrdotdot = count($iarrdotdot);

			for ($i=4;$i<$icntarrdotdot;$i++) {
				$iagentbase .= trim($iarrdotdot[$i]) . ':';
			}

			$iarragentbase = explode(' idfd "', $iagentbase);
			$ihttp_user_agent = trim($iarragentbase[0]);

			if (($prtcontrolstring != '') && ($prtcontrolstring != $ihttp_user_agent)) {
				if ($aggregatelevel == 0) {

					$contenttable .= '
		    					<tr>
		    				      <td class="img tx-tc-be-dispnone">' . $editUid. '</td>
								  <td class="date tx-tc-wm100 tx-tc-flip1-col">' . $firstaccesstime. '</td>
								  <td class="name tx-tc-wm100 tx-tc-flop1-col">' . $accesstime . '</td>
								  <td class="name tx-tc-wm150 tx-tc-flip2-col">' . $identifiedbot . '</td>
								  <td class="name tx-tc-wm150nomax tx-tc-flop2-col">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								  <td class="name tx-tc-wm60">' . $entrycnt . '</td>

								 </tr>
							';
					$entrycnt=0;
					$prtentrycnt++;
				} elseif ($aggregatelevel == 1) {
					// find date and useragent
					$ifound = -1;
					for ($i=0;$i<$iaggr;$i++) {
						if ($accessdate == $aggrtable[$i]['accessdate']) {
							if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
								//found
								$ifound = $i;
								break;
							}

						}

					}
					if ($ifound == -1) {
						$aggrtable[$iaggr]['accessdate'] = $accessdate;
						$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
						$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string . '<br><small>' . $http_user_agent . '</small>';
						$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
						$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
						$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
						$aggrtable[$iaggr]['entrycnt'] = intval($entrycnt);
						$aggrtable[$iaggr]['blwl'] = $blwl;
						$iaggr++;

					} else {
						if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
							$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
							$aggrtable[$ifound]['accesstime_to'] = $accesstime;
						}

						if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
							$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
							$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
						}

						$aggrtable[$ifound]['entrycnt'] = intval(intval($aggrtable[$ifound]['entrycnt']) + $entrycnt);

					}

					$entrycnt=0;
				} elseif ($aggregatelevel == 2) {
					// find date and useragent
					$ifound = -1;
					for ($i=0;$i<$iaggr;$i++) {
						if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
							//found
							$ifound = $i;
							break;
						}

					}

					if ($ifound == -1) {
						$aggrtable[$iaggr]['accessdate'] = $accessdate;
						$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
						$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string . '<br><small>' . $http_user_agent . '</small>';
						$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
						$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
						$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
						$aggrtable[$iaggr]['entrycnt'] = intval($entrycnt);
						$aggrtable[$iaggr]['blwl'] = $blwl;
						$iaggr++;

					} else {
						if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
							$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
							$aggrtable[$ifound]['accesstime_to'] = $accesstime;
						}

						if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
							$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
							$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
						}

						$aggrtable[$ifound]['entrycnt'] = intval(intval($aggrtable[$ifound]['entrycnt']) + $entrycnt);

					}

					$entrycnt=0;
				}

			}

			$arrdotdot = explode(':', $row);
			$cntarrdotdot = count($arrdotdot);
			$blwl=$arrdotdot[0];
			$accesstime=trim($arrdotdot[1]) . ':' . $arrdotdot[2]. ':' . $arrdotdot[3];
			$accesstimestamp=strtotime($accesstime);
			$accessdatearr = explode(' ', trim($arrdotdot[1]));
			$accessdate = trim($accessdatearr[0]);

			if (($entrycnt ==0) || (strtotime($firstaccesstime) > $accesstimestamp)) {
				$firstaccesstime = $accesstime;
			}

			$agentbase='';
			for ($i=4;$i<$cntarrdotdot;$i++) {
				$agentbase .= $arrdotdot[$i] . ':';
			}

			$arragentbase = explode(' idfd "', $agentbase);
			$http_user_agent = trim($arragentbase[0]);
			$http_user_agent_string_basearr = explode('@@', $arragentbase[1]);
			$http_user_agent_string_base =$http_user_agent_string_basearr[0];
			$http_user_agent_string = trim(substr($http_user_agent_string_base, 0, (strlen($http_user_agent_string_base)-1)));
			if (($http_user_agent=='HTTP_USER_AGENT missing') || ($http_user_agent=='')) {
				$identifiedbot = 'unknown';
				$http_user_agent_string= 'advanced.dontTakeEmptyAgentStringAsCrawler = 0';
				$http_user_agent='HTTP_USER_AGENT missing';
			} else {
				$identifiedbot = $pObj->be_common->idbot($http_user_agent, $http_user_agent_string, TRUE);
				if (strlen($http_user_agent_string) > 16) {
					$whoisurl = $pObj->extConf['urlWhoisIP6'];
				} else {
					$whoisurl = $pObj->extConf['urlWhoisIP4'];
				}

				$IPStr = '<a class="tx-tc-externallink" href="' . $whoisurl . $http_user_agent_string .
				'" target="_whois" title="' . $GLOBALS['LANG']->getLL('whois') . ' ' . $http_user_agent_string . '?" >' .
				$http_user_agent_string . '</a>';
				$http_user_agent_string = $IPStr;
			}

			$editUid=strtotime($firstaccesstime);
			$prtcontrolstring = $http_user_agent;
			$entrycnt++;
		}

		if ($num_rows >0) {
			if ($aggregatelevel == 0) {
				$contenttable .= '
			    			<tr>
			    			    <td class="img tx-tc-be-dispnone">' . $editUid. '</td>
								<td class="date tx-tc-wm100 tx-tc-flip1-col">' . $firstaccesstime. '</td>
								<td class="name tx-tc-wm100 tx-tc-flop1-col">' . $accesstime . '</td>
								<td class="name tx-tc-wm150 tx-tc-flip2-col">' . $identifiedbot . '</td>
								<td class="name tx-tc-wm150nomax tx-tc-flop2-col">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								<td class="name tx-tc-wm60">' . $entrycnt . '</td>
							</tr>
				';

				$entrycnt=0;
				$prtentrycnt++;
			} elseif ($aggregatelevel == 1) {
				// find date and useragent
				$ifound = -1;
				for ($i=0;$i<$iaggr;$i++) {
					if ($accessdate == $aggrtable[$i]['accessdate']) {
						if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
							//found
							$ifound = $i;
							break;
						}

					}
				}

				if ($ifound == -1) {
					$aggrtable[$iaggr]['accessdate'] = $accessdate;
					$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
					$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string  . '<br><small>' . $http_user_agent . '</small>';
					$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
					$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
					$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
					$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
					$aggrtable[$iaggr]['entrycnt'] = $entrycnt;
					$aggrtable[$iaggr]['blwl'] = $blwl;
					$iaggr++;
					$entrycnt = 0;

				} else {
					if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
						$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$ifound]['accesstime_to'] = $accesstime;
					}

					if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
						$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
						$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
					}

					$aggrtable[$ifound]['entrycnt'] = intval(intval($aggrtable[$ifound]['entrycnt']) + $entrycnt);
					$entrycnt = 0;
				}
			} elseif ($aggregatelevel == 2) {
				// useragent
				$ifound = -1;
				for ($i=0;$i<$iaggr;$i++) {

					if ($identifiedbot == $aggrtable[$i]['http_user_agent']) {
						//found
						$ifound = $i;
						break;
					}

				}
				if ($ifound == -1) {
					$aggrtable[$iaggr]['accessdate'] = $accessdate;
					$aggrtable[$iaggr]['http_user_agent'] = $identifiedbot;
					$aggrtable[$iaggr]['http_user_agent_string'] = $http_user_agent_string  . '<br><small>' . $http_user_agent . '</small>';
					$aggrtable[$iaggr]['accesstimestamp_to'] = $accesstimestamp;
					$aggrtable[$iaggr]['accesstimestamp_from'] = $editUid;
					$aggrtable[$iaggr]['accesstime_to'] = $accesstime;
					$aggrtable[$iaggr]['accesstime_from'] = $firstaccesstime;
					$aggrtable[$iaggr]['entrycnt'] = $entrycnt;
					$aggrtable[$iaggr]['blwl'] = $blwl;
					$iaggr++;
					$entrycnt = 0;

				} else {
					if ($aggrtable[$ifound]['accesstimestamp_to'] < $accesstimestamp) {
						$aggrtable[$ifound]['accesstimestamp_to'] = $accesstimestamp;
						$aggrtable[$ifound]['accesstime_to'] = $accesstime;
					}

					if ($aggrtable[$ifound]['accesstimestamp_from'] > $editUid) {
						$aggrtable[$ifound]['accesstimestamp_from'] = $editUid;
						$aggrtable[$ifound]['accesstime_from'] = $firstaccesstime;
					}

					$aggrtable[$ifound]['entrycnt'] = $aggrtable[$ifound]['entrycnt'] + $entrycnt;
					$entrycnt = 0;
				}
			}

			if ($aggregatelevel >= 1) {
				$prtentrycnt=0;
				for ($i=0;$i<$iaggr;$i++) {

						$contenttable .= '
				    			<tr>
				    			    <td class="img tx-tc-be-dispnone">' . $aggrtable[$i]['accesstimestamp_from']. '</td>
									<td class="date tx-tc-wm100 tx-tc-flip1-col">' . $aggrtable[$i]['accesstime_from']. '</td>
									<td class="name tx-tc-wm100 tx-tc-flop1-col">' . $aggrtable[$i]['accesstime_to'] . '</td>
									<td class="name tx-tc-wm150 tx-tc-flip2-col">' . $aggrtable[$i]['http_user_agent'] . '</td>
									<td class="name tx-tc-wm150nomax tx-tc-flop2-col">' . $aggrtable[$i]['http_user_agent_string'] . '</td>
									<td class="name tx-tc-wm60">' . $aggrtable[$i]['entrycnt'] . '</td>
								</tr>
					';
					$prtentrycnt++;
				}
				$infomessageinlist = $GLOBALS['LANG']->getLL('entriesaggregatelist') . ': ' . $prtentrycnt;
			}

			$num_rows = $prtentrycnt;
			$contenttable .= '
					  </table>';
		}
	}

	$showwhat = $GLOBALS['LANG']->getLL('show_blacklistprotocol');
}

			    if($num_rows != 0) {

					if ($_POST['bulkactreport'] == '1') {
						$contenttable .= $pObj->be_common->printPager($pObj, 'sessions', $fromAjax);
						if ($fromAjax == TRUE) {
							$contenttable .= '<div class="tx-tc-100">
					<div class="tx-tc-subpaneltitle tx-tc-bulkact-title">
						<span>' . $GLOBALS['LANG']->getLL('bulkactsession') . '</span>
					</div>
					<span id="bulkactreps6g91" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pbulkactreps6g91" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconUnhide . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkactreps_one').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkactreps_one') . '</span>
					<span id="bulkactreps6g92" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pbulkactreps6g92" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconNotApproved . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkactreps_two').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkactreps_two') . '</span>
					<span id="bulkactreps6g93" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkact"><img id="pbulkactreps6g93" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
					' src="' . $GLOBALS['BACK_PATH'] . $pObj->picpathgfx . $pObj->iconNotApproved . '" ' . $pObj->iconWidthHeight . 'title="'.
					    					$GLOBALS['LANG']->getLL('bulkactreps_three').'" alt="" />' . $GLOBALS['LANG']->getLL('bulkactreps_three') . '</span>

				</div>
				<div id="txtcbulkstatus" class="tx-tc-100" style="display: none;">
				</div>
				<div class="clearit">&nbsp;</div>
										';
						}	else {
					    $contenttable .= '
										<div class="div-float">
										  '.$GLOBALS['LANG']->getLL('bulkactsession').':
										  <select name="bulkactreps" size="1">
										    <option value="0">'.$GLOBALS['LANG']->getLL('bulkactreps_zero').'</option>
										    <option value="1">'.$GLOBALS['LANG']->getLL('bulkactreps_one').'</option>
										    <option value="2">'.$GLOBALS['LANG']->getLL('bulkactreps_two').'</option>
										    <option value="3">'.$GLOBALS['LANG']->getLL('bulkactreps_three').'</option>
										  </select>
										  <input type="hidden" name="admincommand41" value="41">
										  <input type="hidden" name="actadmincommand41" value="1">
										   <input type="submit" name="sessionsubmit" value="'.$GLOBALS['LANG']->getLL('go').
										   '" onclick="return confirm(unescape(\''.
						    			  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'\'));" />
										</div>
						    		</fieldset>
						    		</div>
									<div class="clearit">&nbsp;</div>
										';
						}
				} elseif($_POST['bulkactreport'] == '2') {
					$contenttable .= $pObj->be_common->printPager($pObj, 'activeusers', $fromAjax);
					$contenttable .= '
									</fieldset>
							<div class="clearit">&nbsp;</div>
									';
				} elseif($_POST['bulkactreport'] == '3') {
					$contenttable .= $pObj->be_common->printPager($pObj, 'crawlerprotocol', $fromAjax);
					$contenttable .= '
									</fieldset>
							<div class="clearit">&nbsp;</div>
									';
				} elseif($_POST['bulkactreport'] == '4') {
					$contenttable .= $pObj->be_common->printPager($pObj, 'blacklistprotocol', $fromAjax);
					$contenttable .= '
									</fieldset>
							<div class="clearit">&nbsp;</div>
									';
				}

			} else {
				$contenttable .= '</fieldset>';
			}

			$contenttable .= '</div>';

			if ($infomessageinlist != '') {
				if ($infomessage != '') {
					$infomessageinlist = '<br />' . $infomessageinlist;
				}

				$infomessage .= $infomessageinlist;
			}

			if ($reporttitle != '') {
				if ($infomessage != '') {
					$infomessage = $reporttitle . '<br>' . $infomessage;
				} else {
					$infomessage = $reporttitle;
				}

			}

			if ($infomessage != '') {
				if ($alertmsg == 1) {
					$infomessage = '<div class="tx-tc-alert">' . $infomessage . '</div>';
				} else {
					$infomessage = '<div class="tx-tc-information">' . $infomessage . $cachemessage . '</div>';
				}

			}

			if ($fromAjax == TRUE) {
				$content .= $infomessage . $contenttable . '</div>';
			} else {
				$content .= $infomessage . $contenttable;
			}

			$backendcontentcommentlist=$pObj->doc->section('', $content, 0, 1);
			$pObj->content.=$backendcontentcommentlist;
			if (isset($_SESSION['sess_toctoccommentsbackend'])) {
				if (isset($_POST['bulkactreport'])) {
					$sessidx = intval($_POST['bulkactreport']);
					$_SESSION['reportlistidx']=$sessidx;
				}

				if (!isset($_SESSION['backendcontentreportlist'])) {
					$_SESSION['backendcontentreportlist']=array();
				}

				if (($backendcontentcommentlist != $_SESSION['backendcontentreportlist'][$sessidx]) || ($_SESSION['backendcontentlastlist'] != 'reports' . $sessidx)) {
					unset($_SESSION['backendcontentlastlist']);
					$_SESSION['backendcontentlastlist']='reports' . $sessidx;
					$_SESSION['backendcontentreportlist'][$sessidx]=$backendcontentcommentlist;
					unset($_SESSION['backendcontent']);
				}
			}

			unset($_POST['actreport']);
			unset($_POST['bulkactreport']);
			unset($_POST['bulkactreps']);
			unset($_POST['fields']);
		} else {
			if (!isset($_SESSION['backendcontentreportlist'])) {
				$_SESSION['backendcontentreportlist']=array();
			}
			$backendcontentcommentlist=$_SESSION['backendcontentreportlist'][$sessidx];
			if ($_SESSION['backendcontentlastlist']!='reports' . $sessidx) {
				unset($_SESSION['backendcontent']);
			}
			unset($_SESSION['backendcontentlastlist']);
			$_SESSION['backendcontentlastlist']='reports' . $sessidx;
			$_SESSION['reportlistidx']=$sessidx;
			$pObj->content.=$backendcontentcommentlist;
			$_SESSION['reportlistidx'] = $sessidx;
		}
		return '';
	}
}
?>