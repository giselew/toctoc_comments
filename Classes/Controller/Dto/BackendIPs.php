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
 * BackendIPs.php
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
 *   53: class toctoc_comments_be_ips
 *   65:     public function beIPs(&$pObj, $pid=0, $fromAjax =FALSE)
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
class toctoc_comments_be_ips {



	/**
	 * Desc
	 *
	 * @param	[type]		$$pObj: ...
	 * @param	[type]		$pid: ...
	 * @param	[type]		$fromAjax: ...
	 * @return	[type]		...
	 */
	public function beIPs(&$pObj, $pid=0, $fromAjax =FALSE) {
		$editTable = 'tx_toctoc_comments_ipbl_static';

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
	    		if (!$fromAjax) {
			$content .= '<br /><br />';
			$strbrbr = '<br /><br />';
			$strbrbrstart = '';
			$strbrbrdivend = '';
			$strinfostart = '<div class="tx-tc-information">';
			$strinfoend = '</div>';
			$strbstart = '<b>';
			$strbend = '</b>';

		} else {
			$content = '';
			$strbrbr = '';
			$strbrbrstart = '<div class="tx-tc-100 tx-tc-sessioncolornone" id="spamhaushtml">';
			$strbrbrdivend = '</div>';
			$strinfostart = '&nbsp;';
			$strinfoend = '';
			$strbstart = '';
			$strbend = '';
		}

    	$infomessage = '';
    	$alertmsg = 0;

    	// Bulk actions
    	if (isset($_POST['refreships'])) {

    		//  droplasso, select, delete, insert, report
    		$storagePid=0;
    		$lastUpdate=0;
    		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('pid, tstamp', 'tx_toctoc_comments_ipbl_static', '', '', '');

    		$num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
    		$data = '';
    		// No Comment
    		if ($num_rows == '') {
    			$storagePid=$pid;
    		} else {
    			while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
    				$storagePid=$row['pid'];
    				$lastUpdate=$row['tstamp'];
    				break;
    			}
    		}

    		if (!extension_loaded('curl')) {
    			$infomessage .= 'PHP-Problem: Curl extension is required!';
    			$alertmsg = 1;
    		} else {
    			$ch = curl_init();
			$toctoccommentsuseragent = 'TocTocCommentsExternalhit/1.1 (+https://www.toctoc.ch/en/home/toctoc-comments/)';

	    		$urltofetch = 'http://www.spamhaus.org/DROP/drop.lasso';
			curl_setopt($ch, CURLOPT_USERAGENT, toctoccommentsuseragent);

    			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
    			curl_setopt($ch, CURLOPT_URL, $urltofetch);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    			curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    			curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    			curl_setopt($ch, CURLOPT_FILETIME, 1);
    			curl_setopt($ch, CURLOPT_HEADER, 0);
    			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    			curl_setopt($ch, CURLOPT_TRANSFERTEXT, 1);
    			curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
    			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7);

    			$data = curl_exec($ch);
    			$curl_errno = curl_errno($ch);

    			if ($curl_errno > 0) {
    				$curl_errmsg =  curl_error($ch);
    				curl_close($ch);
    				$infomessage = 'Curl, error reading: ' . $curl_errmsg;
    				$alertmsg = 1;

    			} else {
    				if (strpos(strtolower($data), '</head>')==0) {
    					$urltofetch = str_replace('http:', 'https:', $urltofetch);
    					curl_setopt($ch, CURLOPT_URL, $urltofetch);
    					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    					$data = curl_exec($ch);
    				}

    			}

    			$infohttpcode = intval(curl_getinfo($ch, CURLINFO_HTTP_CODE));
    		// checking mime types
    			if ($infohttpcode< 400)  {
    				curl_close($ch);
    				$infomessage = '';
    			} else {
    				$infomessage = 'Curl returned code ' . $infohttpcode . ' for URL: ' . $urltofetch;
    				$alertmsg = 1;
    				curl_close($ch);
    			}
    		}
    		$newIPsArr = array();
    		$iIP=0;
    		if ($data != '') {
    			$dataarr = explode(';', $data);
    			$foundExpires = FALSE;
    			foreach ($dataarr as $datarow) {
    				$bannedIP = '';
    				if (str_replace('Expires', '', $datarow) != $datarow) {
    					$foundExpires = TRUE;
    					$rowarr = explode('GMT', $datarow);
    					$cntrowarr = count($rowarr);
    					$bannedIP = $rowarr[1];
    					$newIPsArr[$iIP] = $bannedIP;
    					$iIP++;
    					$infomessage .= '' . trim($rowarr[0] . 'GMT');
    				} else {
    					if ($foundExpires == FALSE) {
    						$infomessage .= '' . $datarow;
    					} else {
    						if ($bannedIP == '') {
    							if (strpos($datarow, "\n") > 0) {
    								$bannedIP = substr($datarow, strpos($datarow, "\n"));
    								$newIPsArr[$iIP] = $bannedIP;
    								$iIP++;
    							} else {
    								$bannedIP = htmlspecialchars($datarow);
    							}

    						}

    					}
		    		}
		    	}

		    	$cntnewIPs = count($newIPsArr);
		    	if ($cntnewIPs > 1) {
		    		// now delete and then INSERT
		    		$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_ipbl_static', '');
		    		foreach ($newIPsArr as $newIP) {
		    			if (trim($newIP) != '') {
			    			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_ipbl_static', array(
			    					'pid' => $storagePid,
			    					'tstamp' => time(),
			    					'crdate' => time(),
			    					'ipaddr' => $newIP,
			    					'comment' => 'DROP lasso',
			    			));
		    			} else {
		    				$cntnewIPs = $cntnewIPs - 1;
		    			}
		    		}
		    	}
		    	$infomessage .= '<br>' . $cntnewIPs . ' ' . $GLOBALS['LANG']->getLL('bannedipsrefreshed') . ' in SysFolder ' . $storagePid;
		    } else {
			    $infomessage .= '<br>' . $num_rows . ' ' . $GLOBALS['LANG']->getLL('bannedipsnotrefreshed');
		    }
		}

    	if ($infomessage != '') {
    		if ($fromAjax == TRUE) {
    			$infomessage = '<div class="tx-tc-messagebody">' . $infomessage . '</div><div class="tx-tc-messageclosebutton" title="'.$GLOBALS['LANG']->getLL('closemessage').'">x</div>';
    		}

    		if ($alertmsg == 1) {
    			$infomessage = '<div class="tx-tc-alert">' . $infomessage . '</div>';
    		} else {
    			$infomessage = '<div class="tx-tc-information">' . $infomessage . '</div>';
    		}

    	}

		$content .= $infomessage;
		    	// Show all comments on root page

    	$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_ipbl_static', '', '', '');

    	$num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

    	// No IP
    	if ($num_rows == '') {
    		$content .= $strbrbrstart.$GLOBALS['LANG']->getLL('noip').$strbrbr;
    	}
    	// Root Page and 1 IP
    	else if ($num_rows == '1') {
    		$content .= $strbrbrstart.$GLOBALS['LANG']->getLL('ipglobal_one') . $strbstart. ' '. $num_rows . $strbend . ' '.
    		$GLOBALS['LANG']->getLL('commentglobal_two').$strbrbr;
    	}
    	// Root Page and more than 1 IP
    	else if ($num_rows > '1') {
    		$content .= $strbrbrstart.$GLOBALS['LANG']->getLL('ipglobalmore_one') . $strbstart. ' '.$num_rows . $strbend . ' '.
    				$GLOBALS['LANG']->getLL('ipglobalmore_two').$strbrbr;
    	}
    	// 1 IP
    	else if ($num_rows == '1') {
    		$content .= $strbrbrstart.$GLOBALS['LANG']->getLL('oneip_one') . $strbstart. ' '.$num_rows . $strbend . ' '.
    		$GLOBALS['LANG']->getLL('oneip_two').$strbrbr;
    	}
    	// More IP
    	else {
    		$content .= $strbrbrstart.$GLOBALS['LANG']->getLL('moreip_one') . $strbstart. ' '.$num_rows . $strbend . ' '.
    		$GLOBALS['LANG']->getLL('moreip_two').$strbrbr;
    	}

    	if ($num_rows == '') {
    		$storagePid=$pid;
    		$infomessage = $strinfostart . $GLOBALS['LANG']->getLL('lastupdatenone') . $strinfoend;

    	} else {
    		while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
    			$storagePid=$row['pid'];
    			$lastUpdate=$row['tstamp'];
    			if (intval($lastUpdate) > 0) {
    				$lastUpdatetime = ''. date('d.m.Y', $lastUpdate).' - '.date('H:i', $lastUpdate).'';
    				$infomessage = $strinfostart . $GLOBALS['LANG']->getLL('lastupdate') . ' ' . $lastUpdatetime . $strinfoend;
    			} else {
    				$infomessage = $strinfostart . $GLOBALS['LANG']->getLL('lastupdateunknown') . $strinfoend;
    			}

    			break;
    		}

    	}

	    $content .= $infomessage;
	    if ($fromAjax == TRUE) {
		   $content .= ''.$strbrbrdivend.'
		   		</div>';
		   if (!$_POST['refreships']) {
		   	$content .= '
				<span>
		    		<span id="admincommand36g906g9'.
		  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkspamhaus">

		  			<img id="padmincommand36g906g9'.
		  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
			'src="'.
					$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconRefresh . '" ' . $pObj->iconWidthHeight . 'title="'.
			    					$GLOBALS['LANG']->getLL('refreshblockedips').'" alt="" />' . $GLOBALS['LANG']->getLL('refreshblockedips') .
			    	'</span>
				</span>

			';
		   }
	    } else {
		    $content .= '
		<div class="div-float">
		  '.$GLOBALS['LANG']->getLL('refreshblockedips').'
		  						  <input type="hidden" name="admincommand3" value="3">
			  <input type="hidden" name="actadmincommand3" value="1">
		  <input type="submit" name="refreships" value="'.$GLOBALS['LANG']->getLL('go').'" onclick="return confirm(unescape(\''.
		    			  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'\'));" />
		</div>
		</fieldset>

		<div class="clearit">&nbsp;</div>
		';
	    }
	    unset($_POST['refreships']);
	    if ($fromAjax == TRUE) {
	    	return $content;
	    } else {
			$pObj->content.=$pObj->doc->section('', $content, 0, 1);
			return '';
	    }
	}
}
?>