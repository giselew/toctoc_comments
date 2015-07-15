<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2015 Gisele Wendl <gisele.wendl@toctoc.ch>
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

		$editTable = 'tx_toctoc_comments_feuser_mm';
    	$infomessage = '';
    	$selected0 = ' selected';
    	$selected1 = '';
    	$selected2 = '';
    	$selected3 = '';
    	$selected4 = '';
    	 
    	if(intval($_POST['bulkactreport']) == '1') {
    		$selected0 = '';
    		$selected1 = ' selected';
    		$selected2 = '';
    		$selected3 = '';
    		$selected4 = '';
    	}
    	if(intval($_POST['bulkactreport']) == '2') {
    		$selected0 = '';
    		$selected1 = '';
    		$selected2 = ' selected';
    		$selected3 = '';
    		$selected4 = '';
    		
    	}
    	if(intval($_POST['bulkactreport']) == '3') {
    		$selected0 = '';
    		$selected1 = '';
    		$selected2 = '';
    		$selected3 = ' selected';
    		$selected4 = '';
    		
    	}
    	if(intval($_POST['bulkactreport']) == '4') {
    		$selected0 = '';
    		$selected1 = '';
    		$selected2 = '';
    		$selected3 = '';
    		$selected4 = ' selected';
    		
    	}
    	
    	$oselected0 = ' selected';
    	$oselected1 = '';
    	$oselected2 = '';
    	$oselected3 = '';
    	 
    	if(intval($_POST['activesessionsince']) == '1') {
    		$oselected0 = '';
    		$oselected1 = ' selected';
    		$oselected2 = '';
    		$oselected3 = '';
    		
    	}
    	if(intval($_POST['activesessionsince']) == '2') {
    		$oselected0 = '';
    		$oselected1 = '';
    		$oselected2 = ' selected';
    		$oselected3 = '';	
    	}
    	if(intval($_POST['activesessionsince']) == '3') {
    		$oselected0 = '';
    		$oselected1 = '';
    		$oselected2 = '';
    		$oselected3 = ' selected';
    	}
    	
    	$cselected0 = ' selected';
    	$cselected1 = '';
    	$cselected2 = '';
    	 
    	if(intval($_POST['crawleraggregate']) == '1') {
    		$cselected0 = '';
    		$cselected1 = ' selected';  
    		$cselected2 = '';
    	} 
    	if(intval($_POST['crawleraggregate']) == '2') {
    		$cselected0 = '';
    		$cselected1 = '';
    		$cselected2 = ' selected';
    	}   	 
    	$blselected0 = ' selected';
    	$blselected1 = '';
    	$blselected2 = '';
    	
    	if(intval($_POST['blacklistaggregate']) == '1') {
    		$blselected0 = '';
    		$blselected1 = ' selected';
    		$blselected2 = '';
    	}
    	if(intval($_POST['blacklistaggregate']) == '2') {
    		$blselected0 = '';
    		$blselected1 = '';
    		$blselected2 = ' selected';
    	}   	
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
				    <span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('ActiveUsersreportOptions').'</span>
				    <br />
				    <label for="activeuserreportsince" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('activeuserreportsince').': </label>
				    <input type="text" size="18" name="activeuserreportsince" value="' . $_POST['activeuserreportsince'] . '" />
					<br />
				     <label for="activeuserreportto" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('activeuserreportto').': </label>
				    <input type="text" size="18" name="activeuserreportto" value="' . $_POST['activeuserreportto'] . '" />
					<br /><br />
				    <label for="activeuserreporttimedays" class="tx-tc-label">'.
				    $GLOBALS['LANG']->getLL('activeuserreporttimedays').': </label>
				    <input type="text" size="7" name="activeuserreporttimedays"  value="' . $_POST['activeuserreporttimedays'] . '" />					    		
				  </div>
				  <div class="reportoptions" id="rep3options">
				    <span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('CrawlerreportOptions').'</span>
				    		 <br />
				    		<label for="crawleraggregate" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('crawleraggregate').': </label>
				    		 <select name="crawleraggregate" size="1" onchange="">
				    <option value="0" ' . $cselected0 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_zero').'</option>
				    <option value="1" ' . $cselected1 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_one').'</option>
				    <option value="2" ' . $cselected2 . '>'.$GLOBALS['LANG']->getLL('crawleraggregate_two').'</option>
				    </select>
				    
				  </div>
				  <div class="reportoptions" id="rep4options">
				    <span class="reportoptionstitle">'.$GLOBALS['LANG']->getLL('BlacklistreportOptions').'</span>
				    		 <br />
				    		<label for="blacklistaggregate" class="tx-tc-label">'.$GLOBALS['LANG']->getLL('blacklistaggregate').': </label>
				    		 <select name="blacklistaggregate" size="1" onchange="">
				    <option value="0" ' . $blselected0 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_zero').'</option>
				    <option value="1" ' . $blselected1 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_one').'</option>
				    <option value="2" ' . $blselected2 . '>'.$GLOBALS['LANG']->getLL('blacklistaggregate_two').'</option>
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
		    	// Bulk actions
    	if($_POST['bulkactreps']) {
	    	if(intval($_POST['bulkactreps']) > 0) {
	    		$fields = array();
	    		if (isset($_POST['fields'])) {
	    			if (is_array($_POST['fields'])) {
	    				$fields = $_POST['fields'];
	    			}
	    	
	    		}
	    		
    		
    			// session report
    			$numsessions = count($fields);
    			
    			$contenttable = '';
    			// SessionName [drop], SessionAgeHMS, SessionLastuse, Sessionsize, SessionActiveTime, emailOrIp, Sessionip [block/unblock], 
    			// Sessionipresolved, InitialName, toctoc_comments_user
    			if ($_POST['bulkactreps'] == '1') {
    				if ($numsessions > 0) {
    					$infomessage = $GLOBALS['LANG']->getLL('permanentsessionsdelete1');
	    				if ($numsessions !=1){
	    					$infomessage =  sprintf($GLOBALS['LANG']->getLL('permanentsessionsdeleten'), $numsessions);
	    				}
	    				
	    				foreach ($fields as $field) {	    					
	    					$farr = explode('@@', $field);
	    					$delfile = $farr[0];
	    					if (file_exists($delfile)) {
	    						unlink($delfile);			    					
	    					}			    					
	    					
	    				}
	    				
	    				$infomessage .=  '<br>';
	    				
    				}
    				
    			} elseif ($_POST['bulkactreps'] == '2') {
    				
    				if ($numsessions > 0) {
    					$infomessage = $GLOBALS['LANG']->getLL('blockcommenting1');
    					if ($numsessions !=1){
    						$infomessage =  sprintf($GLOBALS['LANG']->getLL('blockcommentingn'), $numsessions);
    					}
    				
    					foreach ($fields as $field) {
    						$farr = explode('@@', $field);
    						$blockip = $farr[1];
    						$this->addLocalBL($blockip, 0);
    					}
    				
    					$infomessage .=  '<br>';
    				
    				}
    				
    			} elseif ($_POST['bulkactreps'] == '3') {
    				if ($numsessions > 0) {
    					$infomessage = $GLOBALS['LANG']->getLL('blockfe1');
    					if ($numsessions !=1){
    						$infomessage =  sprintf($GLOBALS['LANG']->getLL('blockfen'), $numsessions);
    					}
    					 
    					foreach ($fields as $field) {
    						$farr = explode('@@', $field);
    						$blockip = $farr[1];
    						$this->addLocalBL($blockip, 1);
    				
    					}
    					 
    					$infomessage .=  '<br>';    					 
    				}
    			}
    			
	    	}
	    	
    	}
	$reporttitle = '';
	
	if($_POST['bulkactreport'] == '1') {
		$reporttitle = '<span class="tx-tc-reporttitle">' . $GLOBALS['LANG']->getLL('bulkreports') . ': '. $GLOBALS['LANG']->getLL('bulkactreport_one') . '</span>';
		$sessionrows = $this->getSessionArray(intval($_POST['activesessionsince']));
		$countsessionrows = count($sessionrows);
		$this->currentTable = 'tx_toctoc_comments_user';
    	if($countsessionrows >= 1) {
    			
    		$contenttable .= '<fieldset><table id="tablesorter-reps" class="tablesorter">
				      <thead>
					<tr>
    				  <th class="id tx-tc-be-dispnone"></th>
					  <th>'.$GLOBALS['LANG']->getLL('SessionName').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('SessionLastuse').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('Sessionfilesize').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('emailOrIp').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('SessionUser').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('lastPage').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('ipresolvedip').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('UserAgent').'</th>
					  <th><input type="checkbox" class="checkall" title="'.$GLOBALS['LANG']->getLL('check_all').'"></th>
					</tr>
					</thead>';

    		$infomessage .= $GLOBALS['LANG']->getLL('statssessionsfound') . ': ' . $countsessionrows . '';
    		$num_rows = count($sessionrows);
    		$totalsize=0;
			foreach ($sessionrows as $sessionrow) {
    			$editUid = $sessionrow['SessionName'] . $sessionrow['PHPCookie'];
    			$toctocuser = $sessionrow['toctoc_comments_user'];
    			$InitialName = $sessionrow['InitialName'];
    			$ActiveTime = round($sessionrow['ActiveTime'], 0);
    			$ActiveTimeday = round(($ActiveTime/(24*3600)), 0) % (24);
    			$ActiveTimehour = round(($ActiveTime/3600), 0) % (60);
    			$ActiveTimeminute = round(($ActiveTime/60), 0) % (60);
    			$ActiveTimeseconds = $ActiveTime % (60);
    			$ActiveTimeStr = '';
    			if ($ActiveTimeday > 1) {
    				$ActiveTimeStr .= $ActiveTimeday . ' ' . $GLOBALS['LANG']->getLL('days') . ' ';
    			}
    			
    			if ($ActiveTimeday == 1) {
    				$ActiveTimeStr .= $ActiveTimeday . ' ' . $GLOBALS['LANG']->getLL('day') . ' ';
    			}
    			 
    			if ($ActiveTimehour > 1) {
    				$ActiveTimeStr .= $ActiveTimehour . ' ' . $GLOBALS['LANG']->getLL('hours') . ' ';
    			}
    			
    			if ($ActiveTimehour == 1) {
    				$ActiveTimeStr .= $ActiveTimehour . ' ' . $GLOBALS['LANG']->getLL('hour') . ' ';
    			}
    			
    			if ($ActiveTimeminute > 1) {
    				$ActiveTimeStr .= $ActiveTimeminute . ' ' . $GLOBALS['LANG']->getLL('minutes') . ' ';
    			}
    			
    			if ($ActiveTimeminute == 1) {
    				$ActiveTimeStr .= $ActiveTimeminute . ' ' . $GLOBALS['LANG']->getLL('minute') . ' ';
    			}
    			
				if ($ActiveTimeseconds > 1) {
    				$ActiveTimeStr .= $ActiveTimeseconds . ' ' . $GLOBALS['LANG']->getLL('seconds') . ' ';
    			}
    			
    			if ($ActiveTimeseconds == 1) {
    				$ActiveTimeStr .= $ActiveTimeseconds . ' ' . $GLOBALS['LANG']->getLL('second') . ' ';
    			}
    			
    			if (($ActiveTimeseconds == 0) && ($ActiveTimeStr == '')) {
    				$ActiveTimeStr .= '<1 ' . $GLOBALS['LANG']->getLL('second') . ' ';
    			}
    			
    			if ($ActiveTimeStr != '') {
    				$ActiveTimeStr = ' ' . $GLOBALS['LANG']->getLL('active') . ': ' . $ActiveTimeStr;
    			}
    			
    			$IPStr = ''; 
    			if ($sessionrow['Sessionip'] != '') {
    				if (strlen($sessionrow['Sessionip']) > 16) {
    					$whoisurl = $this->extConf['urlWhoisIP6'];
    				} else {
    					$whoisurl = $this->extConf['urlWhoisIP4'];
    				}
    				
    				$IPStr = '<a class="tx-tc-externallink" href="' . $whoisurl  . 
		    				$sessionrow['Sessionip'] . '" target="_whois" title="' . $GLOBALS['LANG']->getLL('whois') . ' ' . $sessionrow['Sessionip'] . '?" >' .
    				$sessionrow['Sessionip'] . '</a>';
    			}
    			
    			$blacklistarr = $this->getBlacklistForIP($sessionrow['Sessionip']);
    			$strbl = '';
    			$supclass = '';
    			if (count($blacklistarr) == 2) {
    				if ($blacklistarr[0] == 1) {
    					$strbl = $GLOBALS['LANG']->getLL('blockedcommenting');
    				}
    				
    				if ($blacklistarr[0] == 2) {
    					$strbl = $GLOBALS['LANG']->getLL('blockedfrontend');
    					$supclass = 'tx-tc-alert';
    				}
    				
    				if ($blacklistarr[1] == 1) {
    					if ($this->extConf['useSpamhausBlocklistForWebsiteBan'] == 1) {
    						$strbl = '' . $GLOBALS['LANG']->getLL('blockedSpamhausfrontend') . '';
    						$supclass = 'tx-tc-alert';
    					} else {
    						$strbl = '' . $GLOBALS['LANG']->getLL('blockedSpamhauscommenting') . '';		    						
    					}
    					
    				}
    				
    				if ($strbl != '') {
    					$strbl = '<sup class="' . $supclass . '" title="' . $strbl . '">&#8709;</sup>';
    				}		    				
    				
    			}
    			
    			$totalsize+=$sessionrow['Sessionsize'];
    			$contenttable .= '
		    					<tr>
		    					<td class="img tx-tc-be-dispnone">' . $sessionrow['SessionLastuseTs']. '</td>
								  <td class="date tx-tc-be-email">' . $editUid. '</td> 
								  <td class="name tx-tc-be-email">' . $sessionrow['SessionLastuse'] . 
								  $ActiveTimeStr . '</td>
								  <td class="name tx-tc-be-email">' . $this->human_filesize($sessionrow['Sessionsize']). '</td>
								  <td class="name tx-tc-be-email">' . $sessionrow['emailOrIp'] . '</td>
								  <td class="name tx-tc-be-email">' . $sessionrow['toctoc_comments_user'] . '<br>' . $InitialName .  '</td>
								  <td class="name tx-tc-be-email">' . $sessionrow['LastVisitedPage'] . '<sup>' . $sessionrow['activelang'] . '</sup><sup title="page count">' . $sessionrow['numberOfPages'] . '</sup></td>
								  <td class="name tx-tc-be-email">' . $sessionrow['Sessionipresolved'] . '<br>' . $IPStr . $strbl .'</td>
								  <td class="name tx-tc-be-email">' . $sessionrow['httpUserAgent'] . '</td>
								  <td><input type="checkbox" name="fields[]" value="'.$sessionrow['SessionNameFull'] . '@@' . $sessionrow['Sessionip'] .'" /></td>';
    			$contenttable .= '
						</tr>
					';
			}
			
			$contenttable .= '
			  </table>
			';
			$infomessage .= ', ' . $GLOBALS['LANG']->getLL('totalsize') . ': ' . $this->human_filesize($totalsize);
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
    	if($pid == '0') {
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
    		if($this->extConf['show_sub'] == 1) {
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
    	}
    			
    			// More user
    else {
    	$infomessageusersfound .= ''.$GLOBALS['LANG']->getLL('morecomments_one').' <b>'.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('moreusers_two');
    }
    			
    			// Show Table Head only if at least 1 user exists.
    if($num_rows >= '1') {
    				
    	$contenttable .= '
				     <fieldset>
    				<table id="tablesorter-repo" class="tablesorter">
				      <thead>
					<tr>
			    	  <th class="id tx-tc-be-dispnone"></th>
					  <th>'.$GLOBALS['LANG']->getLL('Lastactivity').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('Firstactivity').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('toctoc_comments_user').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('ActiveTime').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('InitialName').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('emailOrUser').'</th>
					  <th>'.$GLOBALS['LANG']->getLL('ipresolved').'</th>
					</tr>
					</thead>';
    }
    $having='';
    $dataWherereport .= ' AND tx_toctoc_comments_feuser_mm.toctoc_comments_user = tx_toctoc_comments_user.toctoc_comments_user';
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
		$editUid = intval($row['TsLastSeen']);
   		$this->currentTable = 'tx_toctoc_comments_user';
   		$IPStr = '';
    	if ($row['ipresolved'] != '') {
   			if (strlen($row['ip']) > 16) {
   				$whoisurl = $this->extConf['urlWhoisIP6'];
   			} else {
   				$whoisurl = $this->extConf['urlWhoisIP4'];
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
		  <td class="date tx-tc-be-email">' . $row['LastSeen']. '</td> 
		  <td class="name tx-tc-be-email">' . $row['FirstTimeSeen']. '</td>
		  <td class="name tx-tc-be-email">' . $toctocuser . $sup . '</td>
		  <td class="name tx-tc-be-email">' . $ActiveTime . '</td>
		  <td class="name tx-tc-be-email">' . $InitialName . '</td>
		  <td class="name tx-tc-be-email">' . $row['emailOrIp'] . '</td>
		  <td class="name tx-tc-be-email">' . $IPStr . '</td>';
   		
   		$contenttable .= '
		    </tr>
		  ';
		
	}
		
	$contenttable .= '
			  </table>';
	$showwhat = $GLOBALS['LANG']->getLL('show_activeusers');
} elseif ($_POST['bulkactreport'] == '3') {	
	$contentfile = '';	
	if (file_exists(str_replace('mod1', 'pi1', realpath(dirname(__FILE__)) . '/crawlerprotocol.txt'))) {
		$contentfile = file_get_contents(str_replace('mod1', 'pi1', realpath(dirname(__FILE__)) . '/crawlerprotocol.txt'));
	}
	
	if ($contentfile == '') {
		$res = array();
		$num_rows = 0;
	} else {
		$res = explode("\r\n", $contentfile);
		$num_rows = count($res);
	}
	
	$reporttitle = '<span class="tx-tc-reporttitle">' . $GLOBALS['LANG']->getLL('bulkreports') . ': '. $GLOBALS['LANG']->getLL('bulkactreport_three') . '</span>';

	$this->currentTable = '';	
	$prtcontrolstring = '';
	$entrycnt=0;
	$prtentrycnt=0;
	$infomessage = $GLOBALS['LANG']->getLL('statsprotocolentriesfound') . ': ' . $num_rows . '';
	$aggregatelevel = 0;
    if ($_POST['crawleraggregate']) {
        if ($_POST['crawleraggregate'] == 1) {
        	$aggregatelevel = 1;
        }
        
        if ($_POST['crawleraggregate'] == 2) {
        	$aggregatelevel = 2;
        }
        	 
	}
	
	if($num_rows >= 1) {
			 
		$contenttable .= '<fieldset><table id="tablesorter-repc" class="tablesorter">
			      <thead>
				<tr>
    			  <th class="id tx-tc-be-dispnone"></th>
				  <th>'.$GLOBALS['LANG']->getLL('blwl').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('crawlerFirstAccess').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('crawlerLastAccess').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('UserAgent').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('UserAgentIDstring').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('entrycnt').'</th>
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
								  <td class="name">' . $blwl. '</td>
								  <td class="date tx-tc-be-email">' . $firstaccesstime. '</td>
								  <td class="name tx-tc-be-email">' . $accesstime . '</td>
								  <td class="name tx-tc-be-email">' . $identifiedbot . '</td>
								  <td class="name tx-tc-be-email">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								  <td class="name tx-tc-be-email">' . $entrycnt . '</td>
	
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
				$identifiedbot = $this->idbot($http_user_agent, $http_user_agent_string);
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
								<td class="name">' . $blwl. '</td>
								<td class="date tx-tc-be-email">' . $firstaccesstime. '</td>
								<td class="name tx-tc-be-email">' . $accesstime . '</td>
								<td class="name tx-tc-be-email">' . $identifiedbot . '</td>
								<td class="name tx-tc-be-email">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								<td class="name tx-tc-be-email">' . $entrycnt . '</td>
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
								<td class="name">' . $aggrtable[$i]['blwl']. '</td>
								<td class="date tx-tc-be-email">' . $aggrtable[$i]['accesstime_from']. '</td>
								<td class="name tx-tc-be-email">' . $aggrtable[$i]['accesstime_to'] . '</td>
								<td class="name tx-tc-be-email">' . $aggrtable[$i]['http_user_agent'] . '</td>
								<td class="name tx-tc-be-email">' . $aggrtable[$i]['http_user_agent_string'] . '</td>
								<td class="name tx-tc-be-email">' . $aggrtable[$i]['entrycnt'] . '</td>
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
	if (file_exists(str_replace('mod1', 'pi1', realpath(dirname(__FILE__)) . '/blacklistprotocol.txt'))) {
		$contentfile = file_get_contents(str_replace('mod1', 'pi1', realpath(dirname(__FILE__)) . '/blacklistprotocol.txt'));
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
	$this->currentTable = '';	
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
		$contenttable .= '<fieldset><table id="tablesorter-repbl" class="tablesorter">
			      <thead>
				<tr>
   				  <th class="id tx-tc-be-dispnone"></th>
				  <th>'.$GLOBALS['LANG']->getLL('blacklistFirstAccess').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('blacklistLastAccess').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('blacklistentry').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('BLIDbystring').'</th>
				  <th>'.$GLOBALS['LANG']->getLL('entrycnt').'</th>
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
								  <td class="date tx-tc-be-email">' . $firstaccesstime. '</td>
								  <td class="name tx-tc-be-email">' . $accesstime . '</td>
								  <td class="name tx-tc-be-email">' . $identifiedbot . '</td>
								  <td class="name tx-tc-be-email">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								  <td class="name tx-tc-be-email">' . $entrycnt . '</td>
	
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
				$identifiedbot = $this->idbot($http_user_agent, $http_user_agent_string, TRUE);
				if (strlen($http_user_agent_string) > 16) {
					$whoisurl = $this->extConf['urlWhoisIP6'];
				} else {
					$whoisurl = $this->extConf['urlWhoisIP4'];
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
								<td class="date tx-tc-be-email">' . $firstaccesstime. '</td>
								<td class="name tx-tc-be-email">' . $accesstime . '</td>
								<td class="name tx-tc-be-email">' . $identifiedbot . '</td>
								<td class="name tx-tc-be-email">' . $http_user_agent_string . '<br><small>' . $http_user_agent . '</small></td>
								<td class="name tx-tc-be-email">' . $entrycnt . '</td>
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
									<td class="date tx-tc-be-email">' . $aggrtable[$i]['accesstime_from']. '</td>
									<td class="name tx-tc-be-email">' . $aggrtable[$i]['accesstime_to'] . '</td>
									<td class="name tx-tc-be-email">' . $aggrtable[$i]['http_user_agent'] . '</td>
									<td class="name tx-tc-be-email">' . $aggrtable[$i]['http_user_agent_string'] . '</td>
									<td class="name tx-tc-be-email">' . $aggrtable[$i]['entrycnt'] . '</td>
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
		$contenttable .= '
				  <hr style="margin-top: 5px; margin-bottom: 5px;"/>
				  <div class="pagenav">
				    <div id="pager" class="pager"><fieldset>
					<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/first.png" class="first" />
					<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/prev.png" class="prev" />
					<input type="text" class="pagedisplay"/>
					<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/next.png" class="next" />
					<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/last.png" class="last" />
					<span class="show_reports">'.$showwhat.'</span>
					<select class="pagesize">
				    ';

	$select_val = trim($this->extConf['select_val']);
	$select_val_arr = explode(',', $select_val);
	$select_val_arr[] = $max_records; // Add starting value defined in ext manager
	sort($select_val_arr); // Sort array
	$select_val_arr_unique = array_unique($select_val_arr);

	// Build selectbox
	foreach($select_val_arr_unique as $o) {
		// Highlight starting value
		if($o == $max_records) {
			$contenttable .= '
							<option value="'.$o.'" selected="selected">'.$o.'</option>
					';
		} elseif($o == '') {
			// Do nothing if array value is empty
			$contenttable .= '';
		} else {
			$contenttable .= '
							<option value="'. $o .'">'. $o .'</option>
					';
		}
	}

	$contenttable .= '
					</select>
				       
				  ';
	if ($_POST['bulkactreport'] == '1') {
		    		$contenttable .= '
			    				
					    </div>
					  </div>
							<div class="div-float">
							  Session actions: '.$GLOBALS['LANG']->getLL('bulkactsession').'
							  <select name="bulkactreps" size="1">
							    <option value="0">'.$GLOBALS['LANG']->getLL('bulkactreps_zero').'</option>
							    <option value="1">'.$GLOBALS['LANG']->getLL('bulkactreps_one').'</option>
							    <option value="2">'.$GLOBALS['LANG']->getLL('bulkactreps_two').'</option>
							    <option value="3">'.$GLOBALS['LANG']->getLL('bulkactreps_three').'</option>
							  </select>
							  <input type="hidden" name="admincommand41" value="41">
							  <input type="hidden" name="actadmincommand41" value="1">
							   <input type="submit" name="sessionsubmit" value="'.$GLOBALS['LANG']->getLL('go').'" onclick="return confirm(unescape(\''.
			    			  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'\'));" />
							</div>
			    		</fieldset>
						<div class="clearit">&nbsp;</div>
							';
	} elseif($_POST['bulkactreport'] == '2') {
		$contenttable .= '
						</fieldset>
				    				</div>
				  				</div>
				<div class="clearit">&nbsp;</div>
						';
	} elseif($_POST['bulkactreport'] == '3') {
		$contenttable .= '
						</fieldset>
				    				</div>
				  				</div>
				<div class="clearit">&nbsp;</div>
						';
	} elseif($_POST['bulkactreport'] == '4') {
		$contenttable .= '
						</fieldset>
				    				</div>
				  				</div>
				<div class="clearit">&nbsp;</div>
						';
	}
	
	
} else {
	$contenttable .= '</fieldset>';
	
}

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

unset($_POST['actreport']);
unset($_POST['bulkactreport']);
unset($_POST['bulkactreps']);
unset($_POST['fields']);
	
$content .= $infomessage . $contenttable;
$this->content.=$this->doc->section('', $content, 0, 1);
?>