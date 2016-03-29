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
 * BackendUtilities.php
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
 *   81: class toctoc_comments_be_common
 *   88:     public function setIconsFileMeta(&$pObj)
 *  164:     public function initExtConfAndAccessCheck(&$pObj)
 *  188:     public function defaultTYPO3EXTCONF()
 *  216:     public function getSessionArray($optionactivetime)
 *  415:     public function getSessionSavePath()
 *  446:     public function human_filesize($bytes, $decimals = 2)
 *  458:     public function getBlacklistForIP($ip)
 *  473:     public function checkTableBLs($ipaddr)
 *  486:     private function checkLocalBL($ipaddr)
 *  530:     public function addLocalBL($ipaddr, $blockfe)
 *  563:     public function checkStaticBL($ipaddr)
 *  596:     public function idbot($hua, $huas, $isbl= FALSE)
 *  648:     public function activetime($activetimestamdiff)
 *  702:     public function printPager($pObj, $showWhat, $fromajax)
 *  758:     public function getOverviewData($pObj)
 *  775:     public function getOverviewCommentData ($pObj)
 *  868:     public function getOverviewRatingsData ($pObj)
 *  987:     public function getOverviewUsersData ($pObj)
 * 1080:     public function getOverviewSessionsData ()
 * 1113:     public function getOverviewActiveUsersData ()
 * 1165:     public function getOverviewCrawlersData ()
 * 1197:     public function getOverviewBlacklistsData ()
 * 1227:     public function getOverviewReportsData ()
 * 1244:     public function getNameofPid($pid)
 * 1261:     public function getOverviewLocalBlacklistData()
 * 1314:     public function getOverviewSystemData()
 *
 * TOTAL FUNCTIONS: 26
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
class toctoc_comments_be_common {
	/**
 * Desc
 *
 * @param	[type]		$$pObj: ...
 * @return	[type]		...
 */
	public function setIconsFileMeta(&$pObj) {
		$pObj->picpathpager = '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/';
		// Refresh icon
		$pObj->iconComments = 'table/icon_tx_toctoc_comments.gif';
		$pObj->iconIpbllocal = 'table/icon_tx_toctoc_comments_ipbl_local.gif';
		$pObj->iconIpblstatic = 'table/icon_tx_toctoc_comments_ipbl_static.gif';
		$pObj->iconRatings = 'table/icon_tx_toctoc_comments_ratings_data.gif';
		$pObj->iconOverviewUser = 'table/icon_tx_toctoc_comments_feuser_mm.gif';
		$pObj->iconReports = 'table/iconreports.gif';

		$pObj->iconSystem = 'table/icon_tx_toctoc_comments.gif';
		$pObj->iconBlacklistCrawler = 'table/icon_tx_toctoc_comments_ipbl_static.gif';
		$pObj->iconWidthHeightTitle = ' width="16" ';

		if (version_compare(TYPO3_version, '6.0', '<')) {
			$pObj->picpathsysext = 'sysext/t3skin/icons/gfx/';
			$pObj->picpathgfx = 'gfx/';
			$pObj->picpathtoctoc = '';

			$pObj->iconRefresh = '';
			// Pager
			$pObj->iconPagerStyle = '';
			$pObj->iconPagerFirst = 'pager/first.png';
			$pObj->iconPagerLast = 'pager/last.png';
			$pObj->iconPagerNext = 'pager/next.png';
			$pObj->iconPagerPrev = 'pager/prev.png';
			$pObj->iconPagerWidthHeight = ' height="16" width="16" ';
		} else {
			$picext='png';
			$pObj->picpathsysext = '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/';
			$pObj->picpathgfx = '/typo3conf/ext/toctoc_comments/Resources/Public/Icons/';
			$pObj->picpathtoctoc = '/Resources/Public/Icons';

			// Refresh icon
			$pObj->iconRefresh = 'actions-refresh.' . $picext;

			$pObj->iconEdit = 'actions-open.' . $picext;
			//delete
			$pObj->iconDelete = 'actions-edit-delete.' . $picext;
			//new
			$pObj->iconNew = 'actions-document-new.' . $picext;
			// approval
			$pObj->iconApproved = 'overlay-approved.' . $picext;
			$pObj->iconNotApproved = 'overlay-hidden.' . $picext;
			// Unhide
			$pObj->iconUnhide = 'actions-edit-unhide.' . $picext;
			$pObj->iconHide = 'actions-edit-hide.' . $picext;
			// Overview Panel
			$pObj->iconShowPanel = 'actions-edit-unhide.' . $picext;
			$pObj->iconList = 'overlay-list.' . $picext;
			// Pager
			$pObj->iconPagerStyle = ' tx-tc-pagerbutton ';
			$pObj->iconPagerFirst = 'actions-view-paging-first.' . $picext;
			$pObj->iconPagerLast = 'actions-view-paging-last.' . $picext;
			$pObj->iconPagerNext = 'actions-view-paging-next.' . $picext;
			$pObj->iconPagerPrev = 'actions-view-paging-previous.' . $picext;

			$pObj->iconUsers = 'overlay-frontendusers.' . $picext;
			$pObj->iconUser = 'overlay-frontenduser.' . $picext;
			$pObj->iconViewReport = 'actions-document-view.' . $picext;

			$pObj->iconPagerWidthHeight = ' width="30" ';

			$pObj->iconWidthHeight = ' width="30" ';
			$pObj->picext=$picext;
			return '';
		}

	}

	/**
	 * Returns the path where to store our session files
	 *
	 * @param	[type]		$$pObj: ...
	 * @return	[type]		...
	 */
	public function initExtConfAndAccessCheck(&$pObj) {
		$pObj->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		if (!is_array($pObj->extConf)) {
			$pObj->extConf = $this->defaultTYPO3EXTCONF();
		} else {
			if (!$this->extConf['max_records']) {
				$pObj->extConf = $this->defaultTYPO3EXTCONF();
			}

		}

		// Access check!
		// The page will show only if there is a valid page and if this page may be viewed by the user
		$pObj->pageinfo = t3lib_BEfunc::readPageAccess($pObj->id, $pObj->perms_clause);
		$pObj->access = is_array($pObj->pageinfo) ? 1 : 0;

		return '';
	}
	/**
	 * Returns a default TYPO3EXTCONF when $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments'] is empty .
	 * (Concerns a bug seen with TYPO3 7.0.2, after a fresh install)
	 *
	 * @return	array		defaults of $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']
	 */
	public function defaultTYPO3EXTCONF() {
		$ret = array('donationSecret' => '',
				'max_records' => '10',
				'new_Hours' => '24',
				'text_crop' => '55',
				'show_sub' => '1',
				'select_val' => '5,10,20,30,50,100',
				'dnsbl_list' => '',
				'useSpamhausBlocklistForWebsiteBan' => '0',
				'importDataprefixtotable' => '0',
				'updatefromRoottoCommentFolder' => '',
				'updateMode' => '0',
				'debugMode' => '0',
				'delusers_firstname' => 'deleted',
				'delusers_lastname ' => 'user',
				'delusers_email' => 'deleteduser@site.tld',
				'urlWhoisIP4' => 'http://www.whois.com/whois/',
				'urlWhoisIP6' => 'http://www.tcpiputils.com/whois-lookup/',
		);
		return $ret;
	}

	/**
	 * read Session directory and return array
	 *
	 * @param	[type]		$optionactivetime: ...
	 * @return	Array		...
	 */
	public function getSessionArray($optionactivetime) {

		$restartsession=FALSE;
		if (isset($_SESSION)) {
			if (isset($_SESSION['sess_toctoccommentsbackend'])) {
				session_write_close();
				$restartsession=TRUE;
				$sessionsave = $_SESSION;
			}
		}

		$retarr = array();
		$sessionfiles = array();
		$getSessionSavePath = $this->getSessionSavePath();
		/// read path to sessiondirectory in .tempfile
		if (is_dir($getSessionSavePath)) {
			$d = dir($getSessionSavePath);
		}

		if (!isset($_SESSION)) {
			session_name('sess_toctoccomments_be');
			session_start();
			if (!isset($_SESSION['toctoccomments_be'])) {
				$_SESSION['toctoccomments_be']='';
			}

		} else {
			if (!isset($_SESSION['toctoccomments_be'])) {
				session_write_close();
				session_name('sess_toctoccomments_be');
				session_start();
			}

			if (!isset($_SESSION['toctoccomments_be'])) {
				$_SESSION['toctoccomments_be']='';
			}

		}

		if (is_dir($getSessionSavePath)) {
			if ($d != FALSE){
				// dir the sessionfiles
				$i=0;
				while (FALSE !== ($entry = $d->read())) {
					if (str_replace('sess_', '', $entry) != $entry) {
						$sessionfiles[$i] = array();
						$sessionfiles[$i]['SessionName'] = $entry;
						$i++;
					}

				}

				$d->close();
			}
		}

		$i=0;
		$sessioninfo=array();

		foreach($sessionfiles as $sessionfile) {
			$filesize = @filesize($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName']);
			$filetime = 0;
			$filetime = @filemtime($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName']);
			$filefullpath = $getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'];

			if ($filetime == 0) {
				$filetime = time();
			}

			$Sessioncontent='';
			if (file_exists($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'])) {
				$Sessioncontent = file_get_contents($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName']);
			}
			$_SESSION = array();
			session_decode($Sessioncontent);
			$gethostbyaddr = '';
			$rowInitialName='';
			$rowinitial_email = '';
			$row = array();
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('ipresolved, initial_firstname, initial_lastname, initial_email', 'tx_toctoc_comments_user',
					'toctoc_comments_user = "'.$_SESSION['toctoc_user'].'"', '', '');

			$num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

			if (intval($num_rows) > 0) {
				while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
					$gethostbyaddr = $row['ipresolved'];
					$pizzaInitialName = explode('@@', $row['initial_firstname'] . '@@' . $row['initial_lastname']);
					if ($pizzaInitialName[0] != '') {
						$rowInitialName .= $pizzaInitialName[0];
						if ($pizzaInitialName[1] != '') {
							$rowInitialName .= ' ' . $pizzaInitialName[1];
						}

					} elseif ($pizzaInitialName[1] != '') {
						$rowInitialName .= $pizzaInitialName[1];
					}

					$rowinitial_email=$row['initial_email'];
					break;
				}

			}

			// SessionName [drop], SessionAgeHMS, SessionLastuse, Sessionsize, emailOrIp, Sessionip [block/unblock],
			// Sessionipresolved, InitialName, toctoc_comments_user
			if ($rowinitial_email == ''){
				$emailOrIp = $_SESSION['CurrentIP'];
			} else {
				$emailOrIp = $rowinitial_email;
			}

			if ($gethostbyaddr == '') {
				$gethostbyaddr = @gethostbyaddr($_SESSION['CurrentIP']);
			}

			$maxactivetime = 860000;
			$minactivetime = -1;

			if ($optionactivetime == 1) {
				$maxactivetime = 60;
			}

			if ($optionactivetime == 2) {
				$minactivetime = 60;
			}

			if ($optionactivetime == 3) {
				$minactivetime = 3600;
			}

			if (intval($_SESSION['StartTime']) > 0) {
				$sessionActiveTime = intval($filetime) - intval($_SESSION['StartTime']);
			} else {
				$sessionActiveTime = 0;
			}

			if (($sessionActiveTime >= $minactivetime) && ($sessionActiveTime <= $maxactivetime)) {
				$sessioninfo[$filetime+$i]=array();
				$sessioninfo[$filetime+$i]['SessionLastuseTs'] = (100*$filetime)+$i;
				$sessioninfo[$filetime+$i]['SessionLastuse'] = date('Y-m-d H:i:s', $filetime);
				$sessioninfo[$filetime+$i]['SessionName'] = $sessionfile['SessionName'];
				$sessioninfo[$filetime+$i]['Sessionsize'] = $filesize;
				$sessioninfo[$filetime+$i]['emailOrIp'] = $emailOrIp;
				$sessioninfo[$filetime+$i]['Sessionip'] = $_SESSION['CurrentIP'];
				$sessioninfo[$filetime+$i]['Sessionipresolved'] = $gethostbyaddr;
				$sessioninfo[$filetime+$i]['toctoc_comments_user'] = $_SESSION['toctoc_user'];
				$sessioninfo[$filetime+$i]['InitialName'] = $rowInitialName;
				$sessioninfo[$filetime+$i]['LastVisitedPage'] = $_SESSION['curPageName'];
				$sessioninfo[$filetime+$i]['httpUserAgent'] = $_SESSION['httpuseragent'];
				$sessioninfo[$filetime+$i]['activelang'] = $_SESSION['activelang'];
				$sessioninfo[$filetime+$i]['SessionNameFull'] = $filefullpath;
				$sessioninfo[$filetime+$i]['numberOfPages'] = $_SESSION['numberOfPages'];

				if (intval($_SESSION['StartTime']) > 0) {
					$sessioninfo[$filetime+$i]['ActiveTime'] = $filetime - $_SESSION['StartTime'];
				} else {
					$sessioninfo[$filetime+$i]['ActiveTime'] = 0;
				}

				if (!isset($_SESSION['strPHPCookies'])) {
					$strPHPCookies = '';
				} else {
					$strPHPCookies = $_SESSION['strPHPCookies'];
				}

				if (!isset($_SESSION['PHPCookie'])) {
					$strbl = $GLOBALS['LANG']->getLL('sessionnocookies');
					$sessioninfo[$filetime+$i]['PHPCookie'] = '<sup class="tx-tc-alert" title="' . $strbl . '">NA</sup>';
				} elseif ($_SESSION['PHPCookie'] == 0) {
					$strbl = $GLOBALS['LANG']->getLL('sessionzerocookies');
					$sessioninfo[$filetime+$i]['PHPCookie'] = '<sup class="tx-tc-alert" title="' . $strbl . '">&#8709;</sup>';
				} else {
					$strbl = $_SESSION['PHPCookie'] . ' ' . $GLOBALS['LANG']->getLL('sessioncookiesdetected') . ': ' . $strPHPCookies . '';
					$sessioninfo[$filetime+$i]['PHPCookie'] = '<sup class="tx-tc-info" title="' . $strbl . '">' . $_SESSION['PHPCookie'] . '</sup>';
				}

				$i++;
			}

			$_SESSION = array();
		}

		krsort($sessioninfo);
		$retarr=$sessioninfo;
		session_write_close();
		if ($restartsession) {
			session_name('sess_toctoccommentsbackend');
			session_start();
			$_SESSION = $sessionsave;
		}
		return $retarr;
	}

	/**
	 * Returns the path for dir() of session files
	 *
	 * @return	string		...
	 */
	public function getSessionSavePath() {

		$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/Classes/Utility');
		$PATH_site = str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR;
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$PATH_site = str_replace(DIRECTORY_SEPARATOR, '/', $PATH_site);
		}

		$toctoctempPath = $PATH_site . 'typo3conf/ext/toctoc_comments/pi1/sessionTemp/';
		$sessionPath = 'TocTocCommentsSessions/%s';

		if (version_compare(TYPO3_version, '6.0', '<')) {
			$sessionSavePath = sprintf($toctoctempPath . $sessionPath, md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
		} else {
			$sessionSavePath = sprintf($toctoctempPath . $sessionPath, \TYPO3\CMS\Core\Utility\GeneralUtility::hmac('session:' .
					$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
		}
		if (DIRECTORY_SEPARATOR == '\\') {
			$sessionSavePath=str_replace('/', DIRECTORY_SEPARATOR, $sessionSavePath);
			$sessionSavePath=str_replace(':\\', ':\\\\', $sessionSavePath);
		}
		return $sessionSavePath;
	}
	/**
	 * Returns human_filesize
	 *
	 * @param	[type]		$bytes: ...
	 * @param	[type]		$decimals: ...
	 * @return	string		...
	 */
	public function human_filesize($bytes, $decimals = 2) {
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		$ret = sprintf('%.' .$decimals . 'f', $bytes / pow(1024, $factor)) . @$sz[$factor];
		return $ret;
	}
	/**
	 * returns the Blacklist-Array for the requested IP
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	array
	 */
	public function getBlacklistForIP($ip) {
		$returnValue = array();

		if ($ip != '') {
			$returnValue = $this->checkTableBLs($ip);
		}

		return $returnValue;
	}
	/**
	 * Checks table-based blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	array		[0] local BL, [1] static BL
	 */
	public function checkTableBLs($ipaddr) {
		$retstr = array();
		$retstr[0]= intval($this->checkLocalBL($ipaddr));
		$retstr[1]= intval($this->checkStaticBL($ipaddr));
		return $retstr;
	}

	/**
	 * Checks local blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	int		1, blocked commenting, 2 blocked for site
	 */
	private function checkLocalBL($ipaddr) {
		$parts = explode('.', $ipaddr);
		$ret=0;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('ipaddr, blockfe', 'tx_toctoc_comments_ipbl_local',
				'ipaddr LIKE ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($parts[0] . '.' . $parts[1] . '.%', 'tx_toctoc_comments_ipbl_static'));
		foreach ($recs as $rec) {
			list($addr, $mask) = explode('/', $rec['ipaddr']);
			if ($mask == '') {
				if ($addr == $ipaddr) {
					if ($rec['blockfe'] == 1) {
						$ret = 2;
					} else {
						$ret = 1;
					}

					break;
				}

			} else {
				$mask = 0xFFFFFFFF << (32 - $mask);
				if (long2ip(ip2long($ipaddr) & $mask) == $addr) {
					if ($rec['blockfe'] == 1) {
						$ret = 2;
					} else {
						$ret = 1;
					}

					break;
				}

			}

		}

		return $ret;

	}
	/**
	 * Checks local blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @param	[type]		$blockfe: ...
	 * @return	boolean		TRUE if exists in the list
	 */
	public function addLocalBL($ipaddr, $blockfe) {

		$pid = 0;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('MAX(pid) AS t', 'tx_toctoc_comments_ipbl_local', '');
		if (count($recs)>0) {
			$pid = ($recs[0]['t']);
		}

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_ipbl_local',
				'ipaddr=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($ipaddr, 'tx_toctoc_comments_ipbl_local'));
		$mustupdate = ($recs[0]['t'] != 0);
		if ($mustupdate) {
			//update comments to new user
			$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_ipbl_local SET
										blockfe='. $blockfe . ' WHERE ipaddr = "'. $ipaddr .'"');
		} else {
			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_ipbl_local', array(
					'pid' => $pid,
					'tstamp' => time(),
					'crdate' => time(),
					'ipaddr' => $ipaddr,
					'blockfe' => $blockfe,
					'comment' => '',
			));
		}

	}
	/**
	 * Checks static blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	boolean		TRUE if exists in the list
	 */
	public function checkStaticBL($ipaddr) {
		$parts = explode('.', $ipaddr);
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('ipaddr', 'tx_toctoc_comments_ipbl_static',
				'ipaddr LIKE ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($parts[0] . '.' . $parts[1] . '.%', 'tx_toctoc_comments_ipbl_static'));
		foreach ($recs as $rec) {
			list($addr, $mask) = explode('/', $rec['ipaddr']);
			if ($mask == '') {
				if ($addr == $ipaddr) {
					return 1;
				}

			} else {
				$mask = 0xFFFFFFFF << (32 - $mask);
				if (long2ip(ip2long($ipaddr) & $mask) == $addr) {
					return 1;
				}

			}

		}

		return 0;
	}


	/**
	 * Checks static blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @param	[type]		$huas: ...
	 * @param	[type]		$isbl: ...
	 * @return	boolean		TRUE if exists in the list
	 */
	public function idbot($hua, $huas, $isbl= FALSE) {
		$ret ='';
		if (($hua != '') && ($huas != '')) {
			$poshuas = strpos(strtolower($hua), strtolower($huas));
			$strleft = substr($hua, 0, $poshuas);
			$strleftrev = strrev($strleft);
			$strright = substr($hua, $poshuas);
			$arrstpchr = array(';', '/', ' ', ')', '(', '+');
			if ($isbl == TRUE) {
				$arrstpchr = array(';', ' ', ')', '(', '+');
			}
			$cntarrstpchr = count($arrstpchr);
			$stopcharfnd = FALSE;
			$lenstrrightrev=strlen($strright);
			for ($i=0; $i<$lenstrrightrev; $i++) {
				$testc = substr($strright, $i, 1);
				for ($j=0;$j<$cntarrstpchr;$j++) {
					if ($testc == $arrstpchr[$j]) {
						$stopcharfnd = TRUE;
						break;
					}
				}
				if ($stopcharfnd == TRUE) {
					break;
				}
			}
			$strright = substr($strright, 0, $i);
			$stopcharfnd = FALSE;
			$lenstrleftrev=strlen($strleftrev);
			for ($i=0; $i<$lenstrleftrev; $i++) {
				$testc = substr($strleftrev, $i, 1);
				for ($j=0;$j<$cntarrstpchr;$j++) {
					if ($testc == $arrstpchr[$j]) {
						$stopcharfnd = TRUE;
						break;
					}
				}
				if ($stopcharfnd == TRUE) {
					break;
				}
			}
			$strleft = strrev(substr($strleftrev, 0, $i));
			$ret = $strleft . $strright;
		}
		return $ret;
	}
	/**
	 * Checks static blocking lists.
	 *
	 * @param	int		$activetimestamdiff	Difference between timestamps
	 * @return	$ActiveTimeStr		string representation of time difference
	 */
	public function activetime($activetimestamdiff) {
		$ActiveTime = round($activetimestamdiff, 0);
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

		return $ActiveTimeStr;

	}
	/**
	 * Returns HTML for the table pager
	 *
	 * @param	obj		$pObj
	 * @param	[type]		$showWhat: ...
	 * @param	[type]		$fromajax: ...
	 * @return	$contenttable		string Pager HTML
	 */
	public function printPager($pObj, $showWhat, $fromajax) {
		$pagedisplayboxstart = '';
		$pagedisplayboxend = '';
		if ($fromajax) {
			$pagedisplayboxstart = '<span class="pagerbox">
						';
			$pagedisplayboxend = '</span>
						';
		}
		$contenttable = '<div class="pagenav">
		    <div id="pager" class="pager">
				<img '.$pObj->iconPagerWidthHeight.' src="' . $pObj->picpathpager . $pObj->iconPagerFirst . '" class="first' . $pObj->iconPagerStyle . '" />
				<img '.$pObj->iconPagerWidthHeight.' src="' . $pObj->picpathpager . $pObj->iconPagerPrev . '" class="prev' . $pObj->iconPagerStyle . '" />
				' . $pagedisplayboxstart . '<input type="text" class="pagedisplay"/>' . $pagedisplayboxend . '
				<img '.$pObj->iconPagerWidthHeight.' src="' . $pObj->picpathpager . $pObj->iconPagerNext . '" class="next' . $pObj->iconPagerStyle . '" />
				<img '.$pObj->iconPagerWidthHeight.' src="' . $pObj->picpathpager . $pObj->iconPagerLast . '" class="last' . $pObj->iconPagerStyle . '" />
				 <div class="tx-tc-keeptogether-simple">
					<span class="show_comments">' . $GLOBALS['LANG']->getLL('show_' . $showWhat) . '</span>
					<select class="pagesize">
			    ';
			$select_val = trim($pObj->extConf['select_val']);
			$select_val_arr = explode(',', $select_val);
			//$select_val_arr[] = $pObj->extConf['max_records']; // Add starting value defined in ext manager
			sort($select_val_arr); // Sort array
			$select_val_arr_unique = array_unique($select_val_arr);

			// Build selectbox
			foreach($select_val_arr_unique as $o) {
				// Highlight starting value
				if($o == $pObj->extConf['max_records']) {
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
					</div>
				</div>
			</div>';
		return $contenttable;
	}
	/**
	 * Returns an array with all data used in the overview (apart Spamhaus)
	 *
	 * @param	obj		$pObj
	 * @return	$overview		array holding arrays of the diffenent OverviewData
	 */
	public function getOverviewData($pObj) {
		$overview = array();
		$overview['Comments'] = $this->getOverviewCommentData($pObj);
		$overview['Users'] = $this->getOverviewUsersData($pObj);
		$overview['Ratings'] = $this->getOverviewRatingsData($pObj);
		$overview['Reports'] = $this->getOverviewReportsData();
		$overview['BlacklistData'] = $this->getOverviewLocalBlacklistData();
		$overview['System'] = $this->getOverviewSystemData();
		return $overview;

	}
	/**
	 * Returns an array with all data used in the overviews commentbox
	 *
	 * @param	obj		$pObj
	 * @return	$overviewcomment		array holding arrays of the different comments-Data
	 */
	public function getOverviewCommentData ($pObj) {
		$overviewcomment = array();
		$overviewcomment['newcomments'] = 0;
		$overviewcomment['allcomments'] = 0;
		$overviewcomment['pidcount'] = 0;
		$overviewcomment['pids'] = array();
		$overviewcomment['newcommentstxt'] = '';

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(uid) AS countcomments, pid, approved', 'tx_toctoc_comments_comments',
				'deleted=0 AND hidden=0', 'pid, approved', 'pid, approved');
		$pid='';
		$pidcount=0;
		$pidcommentcount=0;
		$pidapprovedcommentcount=0;
		$totalapprovedcommentcount=0;
		$totalcommentcount=0;
		$i=-1;

		foreach ($recs as $rec) {
			if ($rec['pid'] != $pid) {
				$i++;
				$pidcount++;
				$pid = $rec['pid'];
				$overviewcomment['pids'][$i] = array();
				$overviewcomment['pids'][$i]['pid'] = $pid;
				$overviewcomment['pids'][$i]['nameofpid'] = $this->getNameofPid($pid);
				$overviewcomment['pids'][$i]['commentcount'] = 0;
				$overviewcomment['pids'][$i]['approvedcommentcount'] = 0;
				$pidcommentcount=0;
				$pidapprovedcommentcount=0;

			}

			if ($rec['approved'] == 1) {
				$totalapprovedcommentcount+=$rec['countcomments'];
				$overviewcomment['pids'][$i]['approvedcommentcount']+=$rec['countcomments'];
			}
			$overviewcomment['pids'][$i]['commentcount'] +=$rec['countcomments'];

			$totalcommentcount+=$rec['countcomments'];
		}

		$overviewcomment['allcomments']=$totalcommentcount;
		$overviewcomment['allapprovedcomments']=$totalapprovedcommentcount;
		$overviewcomment['pidcount'] = $pidcount;

		$newcomments = 0;
		$newsince = intval($pObj->extConf['new_Hours']);

		if ($newsince== 0) {
			$newsince = 24;
		}

		$newsincehours = $newsince;

		$newsincedays= intval($newsincehours/24);
		$txthout = '';
		if ($newsincedays > 0) {
			if ($newsincedays > 1) {
				$txthout = $newsincedays . ' ' . $GLOBALS['LANG']->getLL('days') . ' ';
			} else {
				$txthout = '1 ' . $GLOBALS['LANG']->getLL('day') . ' ';
			}
		}

		$newsincehours = $newsincehours % (24);
		if ($newsincehours > 1) {
			$txthout .= $newsincehours . ' ' . $GLOBALS['LANG']->getLL('hours');
		} elseif ($newsincehours == 1) {
			$txthout .= $newsincehours . ' ' . $GLOBALS['LANG']->getLL('hour');
		}

		$newsince = time() - $newsince*3600;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_comments', 'deleted=0 AND crdate > ' . $newsince);

		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// new comments
				$newcomments = $recs[0]['t'];
			}
		}
		$overviewcomment['newcomments'] = $newcomments;
		$overviewcomment['newcommentstxt'] = $txthout;

		return $overviewcomment;

	}
	/**
	 * Returns an array with all data used in the overviews ratingsbox
	 *
	 * @param	obj		$pObj
	 * @return	$overviewratings		array holding arrays of the different ratings-Data
	 */
	public function getOverviewRatingsData ($pObj) {
		$overviewratings = array();
		$overviewratings['newratings'] = 0;
		$overviewratings['allratings'] = 0;
		$overviewratings['newlikes'] = 0;
		$overviewratings['alllikes'] = 0;
		$overviewratings['pidcount'] = 0;
		$overviewratings['pids'] = array();
		$overviewratings['newratingstxt'] = '';

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(uid) AS countratings, pid', 'tx_toctoc_ratings_data',
				'', 'pid', 'pid');
		$pid='';
		$pidcount=0;
		$pidratingscount=0;
		$totalratingscount=0;
		$i=-1;

		foreach ($recs as $rec) {
			if ($rec['pid'] != $pid) {
				$i++;
				$pidcount++;
				$pid = $rec['pid'];
				$overviewratings['pids'][$i] = array();
				$overviewratings['pids'][$i]['pid'] = $pid;
				$overviewratings['pids'][$i]['nameofpid'] = $this->getNameofPid($pid);
				$overviewratings['pids'][$i]['ratingscount'] = 0;
				$pidratingscount=0;

			}

			$overviewratings['pids'][$i]['ratingscount']+=$rec['countratings'];
			$totalratingscount+=$rec['countratings'];
		}

		$overviewratings['allratings']=$totalratingscount;
		$overviewratings['pidcount'] = $pidcount;

		$newratings = 0;
		$newsince = intval($pObj->extConf['new_Hours']);

		if ($newsince== 0) {
			$newsince = 24;
		}

		$newsincehours = $newsince;

		$newsincedays= intval($newsincehours/24);
		$txthout = '';
		if ($newsincedays > 0) {
			if ($newsincedays > 1) {
				$txthout = $newsincedays . ' ' . $GLOBALS['LANG']->getLL('days') . ' ';
			} else {
				$txthout = '1 ' . $GLOBALS['LANG']->getLL('day') . ' ';
			}
		}

		$newsincehours = $newsincehours % (24);
		if ($newsincehours > 1) {
			$txthout .= $newsincehours . ' ' . $GLOBALS['LANG']->getLL('hours');
		} elseif ($newsincehours == 1) {
			$txthout .= $newsincehours . ' ' . $GLOBALS['LANG']->getLL('hour');
		}

		$newsince = time() - $newsince*3600;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_ratings_data', 'crdate > ' . $newsince);

		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// new ratings
				$newratings = $recs[0]['t'];
			}
		}

		$alllikes = 0;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_feuser_mm', 'ilike>0 AND deleted=0');

		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// all likes
				$alllikes = $recs[0]['t'];
			}
		}

		$newlikes = 0;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_feuser_mm', 'ilike>0 AND deleted=0 AND crdate > ' . $newsince);

		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// new likes
				$newlikes = $recs[0]['t'];
			}
		}

		$newdislikes = 0;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_feuser_mm', 'idislike>0 AND deleted=0 AND crdate > ' . $newsince);

		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// new ratings
				$newdislikes = $recs[0]['t'];
			}
		}

		$overviewratings['alllikes'] = $alllikes;
		$overviewratings['newratings'] = $newratings;
		$overviewratings['newdislikes'] = $newdislikes;
		$overviewratings['newlikes'] = $newlikes;
		$overviewratings['newratingstxt'] = $txthout;

		return $overviewratings;

	}
	/**
	 * Returns an array with all data used in the overviews Users
	 *
	 * @param	[type]		$pObj: ...
	 * @return	$OverviewUsers		array holding arrays of the Users-Data
	 */
	public function getOverviewUsersData ($pObj) {
		$OverviewUsers = array();
		$OverviewUsers['allUsers'] = 0;
		$OverviewUsers['pidcount'] = 0;
		$OverviewUsers['maxcrdate'] = 0;
		$OverviewUsers['pids'] = array();
		/* SELECT count(uid) AS countuid,pid,max(crdate) As maxcrdate FROM toctoc_prod_62x.tx_toctoc_comments_user
			WHERE (comment_count+dislike_count+like_count+vote_count>0) AND
		deleted=0
		GROUP BY pid */

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(uid) AS countuid,pid,max(crdate) As maxcrdate', 'tx_toctoc_comments_user',
				'deleted=0 AND toctoc_comments_user != "0.0.0.127.0" ', 'pid', 'pid');
		$pid='';
		$pidcount=0;
		$maxcrdate=0;
		$pidUserscount=0;

		$totalUserscount=0;
		$i=-1;

		foreach ($recs as $rec) {
			if ($rec['maxcrdate'] > $maxcrdate) {
				$maxcrdate = $rec['maxcrdate'];
			}

			if ($rec['pid'] != $pid) {
				$pidcount++;
				$i++;
				$pid = $rec['pid'];
				$OverviewUsers['pids'][$i] = array();
				$OverviewUsers['pids'][$i]['pid'] = $pid;
				$OverviewUsers['pids'][$i]['nameofpid'] = $this->getNameofPid($pid);
				$OverviewUsers['pids'][$i]['Userscount'] = 0;
				$pidUserscount=0;

			}

			$OverviewUsers['pids'][$i]['Userscount']+=$rec['countuid'];
			$totalUserscount+=$rec['countuid'];
		}

		$OverviewUsers['maxcrdate'] = $maxcrdate;
		$OverviewUsers['allUsers']=$totalUserscount;
		$OverviewUsers['pidcount'] = $pidcount;

		$newusers = 0;
		$newsince = intval($pObj->extConf['new_Hours']);

		if ($newsince== 0) {
			$newsince = 24;
		}

		$newsincehours = $newsince;

		$newsincedays= intval($newsincehours/24);
		$txthout = '';
		if ($newsincedays > 0) {
			if ($newsincedays > 1) {
				$txthout = $newsincedays . ' ' . $GLOBALS['LANG']->getLL('days') . ' ';
			} else {
				$txthout = '1 ' . $GLOBALS['LANG']->getLL('day') . ' ';
			}
		}

		$newsincehours = $newsincehours % (24);
		if ($newsincehours > 1) {
			$txthout .= $newsincehours . ' ' . $GLOBALS['LANG']->getLL('hours');
		} elseif ($newsincehours == 1) {
			$txthout .= $newsincehours . ' ' . $GLOBALS['LANG']->getLL('hour');
		}

		$newsince = time() - $newsince*3600;
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_user', 'deleted=0 AND crdate > ' . $newsince);

		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// new users
				$newusers = $recs[0]['t'];
			}
		}
		$OverviewUsers['newusers'] = $newusers;
		$OverviewUsers['newuserstxt'] = $txthout;

		return $OverviewUsers;

	}
	/**
	 * Returns an array with all data used in the overviews Sessions
	 *
	 * @param	obj		$pObj
	 * @return	$overviewSessions		array holding arrays of the Sessions-Data
	 */
	public function getOverviewSessionsData () {
		$overviewSessions = array();
		$retarr = array();
		$sessionfiles = array();
		$getSessionSavePath = $this->getSessionSavePath();
		/// read path to sessiondirectory in .tempfile
		if (is_dir($getSessionSavePath)) {
			$d = dir($getSessionSavePath);
		}
		$i=0;
		if (is_dir($getSessionSavePath)) {
			if ($d != FALSE){
				// dir the sessionfiles

				while (FALSE !== ($entry = $d->read())) {
					if (str_replace('sess_', '', $entry) != $entry) {
						$i++;
					}

				}

				$d->close();
			}
		}
		$overviewSessions['sessioncount'] = $i;
		return $overviewSessions;

	}
	/**
	 * Returns an array with all data used in the overviews ActiveUsers
	 *
	 * @return	$OverviewActiveUsers		array holding arrays of the ActiveUsers-Data
	 */
	public function getOverviewActiveUsersData () {
		$OverviewActiveUsers = array();
		$OverviewActiveUsers['allActiveUsers'] = 0;
		$OverviewActiveUsers['pidcount'] = 0;
		$OverviewActiveUsers['maxcrdate'] = 0;
		$OverviewActiveUsers['pids'] = array();
		/* SELECT count(uid) AS countuid,pid,max(crdate) As maxcrdate FROM toctoc_prod_62x.tx_toctoc_comments_user
		WHERE (comment_count+dislike_count+like_count+vote_count>0) AND
		deleted=0
		GROUP BY pid */

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(uid) AS countuid,pid,max(crdate) As maxcrdate', 'tx_toctoc_comments_user',
				'deleted=0 AND (comment_count+dislike_count+like_count+vote_count>0) AND toctoc_comments_user != "0.0.0.127.0" ', 'pid', 'pid');
		$pid='';
		$pidcount=0;
		$maxcrdate=0;
		$pidActiveUserscount=0;

		$totalActiveUserscount=0;
		$i=-1;

		foreach ($recs as $rec) {
			if ($rec['maxcrdate'] > $maxcrdate) {
				$maxcrdate = $rec['maxcrdate'];
			}

			if ($rec['pid'] != $pid) {
				$pidcount++;
				$i++;
				$pid = $rec['pid'];
				$OverviewActiveUsers['pids'][$i] = array();
				$OverviewActiveUsers['pids'][$i]['pid'] = $pid;
				$OverviewActiveUsers['pids'][$i]['ActiveUserscount'] = 0;
				$pidActiveUserscount=0;

			}

			$OverviewActiveUsers['pids'][$i]['ActiveUserscount']+=$rec['countuid'];
			$totalActiveUserscount+=$rec['countuid'];
		}
		$OverviewActiveUsers['maxcrdate'] = $maxcrdate;
		$OverviewActiveUsers['allActiveUsers']=$totalActiveUserscount;
		$OverviewActiveUsers['pidcount'] = $pidcount;

		return $OverviewActiveUsers;

	}
	/**
	 * Returns an array with all data used in the overviews Crawlers
	 *
	 * @return	$OverviewCrawlers		array holding arrays of the Crawlers-Data
	 */
	public function getOverviewCrawlersData () {
		$OverviewCrawlers = array();
		$OverviewCrawlers['crawlersactive'] = 0;
		$OverviewCrawlers['crawlersfilepath'] = str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt');
		$OverviewCrawlers['crawlerentries'] = 0;

		$contentfile = '';
		if (file_exists(str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt'))) {
			$contentfile = file_get_contents(str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt'));
		} else {
			$OverviewCrawlers['crawlersfilepath'] = 'no ' . str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt');
		}

		if ($contentfile == '') {
			$res = array();
			$num_rows = 0;
		} else {
			$OverviewCrawlers['crawlersactive'] = 1;
			$res = explode("\r\n", $contentfile);
			$num_rows = count($res);
		}

		$OverviewCrawlers['crawlerentries'] = $num_rows;

		return $OverviewCrawlers;

	}
	/**
	 * Returns an array with all data used in the overviews Blacklists
	 *
	 * @return	$OverviewBlacklists		array holding arrays of the Blacklists-Data
	 */
	public function getOverviewBlacklistsData () {
		$OverviewBlacklists = array();
		$OverviewBlacklists['blacklistingactive'] = 0;
		$OverviewBlacklists['blacklistfilepath'] = str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'blacklistprotocol.txt');
		$OverviewBlacklists['blacklistentries'] = 0;

		$contentfile = '';
		if (file_exists(str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'blacklistprotocol.txt'))) {
			$contentfile = file_get_contents(str_replace('Classes' . DIRECTORY_SEPARATOR . 'Utility', 'pi1', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'blacklistprotocol.txt'));
		} else {
			$OverviewBlacklists['blacklistfilepath'] ='';
		}

		if ($contentfile == '') {
			$res = array();
			$num_rows = 0;
		} else {
			$OverviewBlacklists['blacklistingactive'] = 1;
			$res = explode("\r\n", $contentfile);
			$num_rows = count($res);
		}
		$OverviewBlacklists['blacklistentries'] = $num_rows;
		return $OverviewBlacklists;

	}
	/**
	 * Returns an array with all data used in the overviews ratingsbox
	 *
	 * @return	$overviewreports		array holding arrays of the different reports-Data
	 */
	public function getOverviewReportsData () {
		$overviewreports = array();
		$overviewreports['Sessions'] = $this->getOverviewSessionsData();
		$overviewreports['ActiveUsers'] = $this->getOverviewActiveUsersData();
		$overviewreports['Crawlers'] = $this->getOverviewCrawlersData();
		$overviewreports['Blacklists'] = $this->getOverviewBlacklistsData();

		return $overviewreports;

	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$pid: ...
	 * @return	[type]		...
	 */
	public function getNameofPid($pid){
		$pidname='';
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('title', 'pages',
				'uid='.$pid.'', '', '');
		foreach ($recs as $rec) {
			$pidname = $rec['title'];
			break;
		}
		return $pidname;
	}

	/**
	 * Returns an array with all data used in the overviews LocalBlacklist
	 *
	 * @param	[type]		$pObj: ...
	 * @return	$OverviewLocalBlacklist		array holding arrays of the LocalBlacklist-Data
	 */
	public function getOverviewLocalBlacklistData() {
		$OverviewLocalBlacklist = array();
		$OverviewLocalBlacklist['allLocalBlacklist'] = 0;
		$OverviewLocalBlacklist['pidcount'] = 0;
		$OverviewLocalBlacklist['maxcrdate'] = 0;
		$OverviewLocalBlacklist['pids'] = array();
		/* SELECT count(uid) AS countuid,pid,max(crdate) As maxcrdate FROM toctoc_prod_62x.tx_toctoc_comments_user
			WHERE (comment_count+dislike_count+like_count+vote_count>0) AND
		deleted=0
		GROUP BY pid */

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(uid) AS countuid,pid,max(crdate) As maxcrdate', 'tx_toctoc_comments_ipbl_local',
				'', 'pid', 'pid');
		$pid='';
		$pidcount=0;
		$maxcrdate=0;
		$pidLocalBlacklistcount=0;

		$totalLocalBlacklistcount=0;
		$i=-1;

		foreach ($recs as $rec) {
			if ($rec['maxcrdate'] > $maxcrdate) {
				$maxcrdate = $rec['maxcrdate'];
			}

			if ($rec['pid'] != $pid) {
				$pidcount++;
				$i++;
				$pid = $rec['pid'];
				$OverviewLocalBlacklist['pids'][$i] = array();
				$OverviewLocalBlacklist['pids'][$i]['pid'] = $pid;
				$OverviewLocalBlacklist['pids'][$i]['LocalBlacklistcount'] = 0;
				$pidLocalBlacklistcount=0;

			}

			$OverviewLocalBlacklist['pids'][$i]['LocalBlacklistcount']+=$rec['countuid'];
			$totalLocalBlacklistcount+=$rec['countuid'];
		}
		$OverviewLocalBlacklist['maxcrdate'] = $maxcrdate;
		$OverviewLocalBlacklist['allLocalBlacklist']=$totalLocalBlacklistcount;
		$OverviewLocalBlacklist['pidcount'] = $pidcount;

		return $OverviewLocalBlacklist;

	}
	/**
	 * Returns an array with all data used in the overviews SystemData
	 *
	 * @param	[type]		$pObj: ...
	 * @return	$OverviewSystemData		array holding arrays of the Overview SystemData
	 */
	public function getOverviewSystemData() {
		$OverviewSystemData = array();
		$OverviewSystemData['numberofrows'] = 0;
		$OverviewSystemData['datalength'] = 0;
		$OverviewSystemData['lastcheck'] = 0;

		$schema = '';
		if (version_compare(TYPO3_version, '6.0', '<')) {
			$schema = TYPO3_db_name;
		} else {
			$cm = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager');
			$schema = $cm->getLocalConfigurationValueByPath('DB/database');
		}

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(TABLE_ROWS) AS numberofrows, SUM(DATA_LENGTH) AS datalength, UNIX_TIMESTAMP(MAX(CHECK_TIME)) as lastcheck', 'INFORMATION_SCHEMA.TABLES',
				'TABLE_SCHEMA = "'.$schema.'" AND TABLE_NAME LIKE "%tx_toc%"', '', '');

		foreach ($recs as $rec) {
			$OverviewSystemData['numberofrows'] = $rec['numberofrows'];
			$OverviewSystemData['datalength'] = $rec['datalength'];
			$lastUpdate = $rec['lastcheck'];
			if (intval($lastUpdate) > 0) {
				$lastUpdatetime = ''. date('d.m.Y', $lastUpdate).' - '.date('H:i', $lastUpdate).'';
			} else {
				$lastUpdatetime = '0';
			}
			$OverviewSystemData['lastcheck'] = $lastUpdatetime;

			if (trim($OverviewSystemData['lastcheck']) == '0') {
				$OverviewSystemData['lastcheck'] = $GLOBALS['LANG']->getLL('lastupdatenone');
			}

			break;
		}

		return $OverviewSystemData;

	}
}
?>