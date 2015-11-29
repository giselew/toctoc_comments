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
$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/mod1/locallang.xml');
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(PATH_t3lib . 'class.t3lib_scbase.php');
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Module/BaseScriptClass.php';
}

// DEFAULT initialization of a module [END]


if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_SCbase', FALSE) || interface_exists('t3lib_SCbase', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Backend\Module\BaseScriptClass', 't3lib_SCbase');
	(class_exists('t3lib_extMgm', FALSE) || interface_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('bigDoc', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Backend\Template\DocumentTemplate', 'bigDoc');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	if (!t3lib_extMgm::isLoaded('compatibility6'))  {
		(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
	}
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_BEfunc', FALSE) || interface_exists('t3lib_BEfunc', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Backend\Utility\BackendUtility', 't3lib_BEfunc');
}

if (version_compare(TYPO3_version, '7.0.99', '>')) {
	$modulePath=t3lib_extMgm::extPath('toctoc_comments', 'mod1/');
	$MCONF = array();
	$MCONF = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::configureModule('web_toctoccommentsbeM1', $modulePath);
}

$GLOBALS['BE_USER']->modAccess($MCONF, 1);	// This checks permissions and exits if the users has no permission for entry.

require_once (t3lib_extMgm::extPath('toctoc_comments', 'class.user_toctoc_comments_toctoc_comments.php'));

/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class  toctoc_comments_module1 extends t3lib_SCbase {
	private $pageinfo;

	// set $vmcNPC if you encounter T3-Crashs while clearing page cache
	private $vmcNPC = 0;

	private $deleteduserischecked = FALSE;

	// Set to true if you want to see which content elements and pages have cleared cache (shown at end of messages)
	private $showcachemessage = FALSE;
	private $picpathsysext = 'sysext/t3skin/icons/gfx/';
	private $picpathgfx = 'gfx/';
	private $picpathtoctoc = '';

	/**
	 * 1st main function executes under SOBE (see end of file)
	 *
	 * @return	void		...
	 */
	public function init()	{
		if (version_compare(TYPO3_version, '6.0', '<')) {
			$this->picpathsysext = 'sysext/t3skin/icons/gfx/';
			$this->picpathgfx = 'gfx/';
			$this->picpathtoctoc = '';		
		} else {	
			$this->picpathsysext = '../typo3conf/ext/toctoc_comments/mod1/img/';
			$this->picpathgfx = '/typo3conf/ext/toctoc_comments/mod1/img/';
			$this->picpathtoctoc = '/mod1/img';
		}
		parent::init();
	}

	/**
	 * 2nd main function executes under SOBE (see end of file)
	 *
	 * @return	[type]		...
	 */
	public function menuConfig()	{
		$this->MOD_MENU = Array (
			'function' => Array (
				'1' => $GLOBALS['LANG']->getLL('function1'),
			)
		);
		parent::menuConfig();
	}

	/**
	 * 3rd main function executes under SOBE (see end of file)
	 *
	 * @return	void		...
	 */
	public function main()	{
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		if (!is_array($this->extConf)) {
			$this->extConf = $this->defaultTYPO3EXTCONF();
		} else {
			if (!$this->extConf['max_records']) {
				$this->extConf = $this->defaultTYPO3EXTCONF();
			}

		}

		$max_records = $this->extConf['max_records'];

		// Access check!
		// The page will show only if there is a valid page and if this page may be viewed by the user
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id, $this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;

		if (($this->id && $access) || ($GLOBALS['BE_USER']->user['admin'] && !$this->id))	{
			// Draw the header.
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->styleSheetFile2=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule.css';
			if (version_compare(TYPO3_version, '4.7', '>')) {
				$this->doc->styleSheetFile=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule7.css';
			}
			
			$this->doc->backPath = $BACK_PATH;
			$this->doc->form='<form action="" name="myform3" method="post" enctype="multipart/form-data">';

			// JavaScript
			$this->doc->JScode = '
						<script src="../typo3conf/ext/toctoc_comments/mod1/js/jquery.js" type="text/javascript"></script>
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/mod1/js/jquery.tablesorter.js"></script>
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/mod1/js/jquery.tablesorter.pager.js"></script>
							<script language="javascript" type="text/javascript">
								script_ended = 0;
								function jumpToUrl(URL)	{
									document.location = URL;
								}

								$(document).ready(function(){
		  $("#tablesorter-demo")
		  .tablesorter({
		    sortList:[[0,1],[1,0],[2,0],[3,0],[5,0],[6,0]],
		    widgets: [\'zebra\'],
		    headers: {
		      4: {
			sorter: false
		      },
		      7: {
			sorter: false
		      },
		      8: {
			sorter: false
		      },
		      9: {
			sorter: false
		      }
		    }
		  })
		  .tablesorterPager({
		    container: $("#pager"),
		    size: '.$max_records.',
		    positionFixed: false
		  });
		  $("#tablesorter-repo")
		  .tablesorter({
		    sortList:[[0,1],[1,1],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0]],
		    widgets: [\'zebra\'],
		   headers: {
		      8: {
			sorter: false
		      },
		      9: {
			sorter: false
		      }
		    }
		  })
		  .tablesorterPager({
		    container: $("#pager"),
		    size: '.$max_records.',
		    positionFixed: false
		  });

		  $("#tablesorter-repc")
		  .tablesorter({
		    sortList:[[0,1],[1,0],[2,1],[3,0],[4,0],[5,0],[6,0]],
		    widgets: [\'zebra\'],
		   headers: {
		      8: {
			sorter: false
		      }
		    }
		  })
		  .tablesorterPager({
		    container: $("#pager"),
		    size: '.$max_records.',
		    positionFixed: false
		  });

		   $("#tablesorter-repbl")
		  .tablesorter({
		    sortList:[[0,1],[1,1],[2,0],[3,0],[4,0],[5,0]],
		    widgets: [\'zebra\'],
		   headers: {
		      7: {
			sorter: false
		      }
		    }
		  })
		  .tablesorterPager({
		    container: $("#pager"),
		    size: '.$max_records.',
		    positionFixed: false
		  });


		  $("#tablesorter-reps")
		  .tablesorter({
		    sortList:[[0,1],[1,0],[3,0],[4,0],[5,0],[6,0],[7,0],[8,0]],
		    widgets: [\'zebra\'],
		   headers: {
		      2: {
			sorter: false
		      },
		      9: {
			sorter: false
		      }
		    }
		  })
		  .tablesorterPager({
		    container: $("#pager"),
		    size: '.$max_records.',
		    positionFixed: false
		  });
		  $("#tablesorter-user")
		  .tablesorter({
		    sortList:[[0,0],[1,0],[2,0],[3,0],[4,0],[5,0],[6,0],[7,0]],
		    widgets: [\'zebra\'],
		    headers: {
		      8: {
			sorter: false
		      }
		    }
		  })
		  .tablesorterPager({
		    container: $("#pager"),
		    size: '.$max_records.',
		    positionFixed: false
		  });
		});
		</script>
	      <script type="text/javascript">
		$(function () { // this line makes sure this code runs on page load
			$(\'.checkall\').click(function () {
				$(this).parents(\'fieldset:eq(0)\').find(\':checkbox\').attr(\'checked\', this.checked);
			});
		})
	      </script>
			';
			$this->doc->postCode='
				<script language="javascript" type="text/javascript">
					script_ended = 1;
					if (top.fsMod) top.fsMod.recentIds["web"] = 0;
				</script>
			';

			$headerSection = $this->doc->getHeader('pages', $this->pageinfo, $this->pageinfo['_thePath']).'<br />'.
				$GLOBALS['LANG']->sL('LLL:EXT:lang/locallang_core.xml:labels.path').': '.t3lib_div::fixed_lgd_cs($this->pageinfo['_thePath'], 50);

			$this->content.=$this->doc->startPage($GLOBALS['LANG']->getLL('title'));
			$this->content.=$this->doc->header($GLOBALS['LANG']->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->divider(5);

			// Render content:
			$this->moduleContent();

			// ShortCut
			if ($GLOBALS['BE_USER']->mayMakeShortcut())	{
				$this->content .= $this->doc->spacer(20) . $this->doc->section('', $this->doc->makeShortcutIcon('id', implode(',', array_keys($this->MOD_MENU)),
						$this->MCONF['name']));
			}

			$this->content.=$this->doc->spacer(10);
		} else {
				// If no access or if ID == zero
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->backPath = $BACK_PATH;

			$this->content.=$this->doc->startPage($GLOBALS['LANG']->getLL('title'));
			$this->content.=$this->doc->header($GLOBALS['LANG']->getLL('title'));
			$this->content.=$this->doc->spacer(5);
			$this->content.=$this->doc->spacer(10);
		}

	}

	/**
	 * 4th main function executes under SOBE (see end of file)
	 *
	 * @return	void		echoes $this->content
	 */
	public function printContent()	{
		$donlib = new user_toctoc_comments_toctoc_comments;
		$donmsg = $donlib->displayDonationMessage();
		$this->content.=$donmsg.$this->doc->endPage();
		echo $this->content;
	}

	/**
	 * Main processing - one function for all backend menu points
	 * the function works on $this->content and does all needed data processing
	 * individual menu point logics are separated by a switch in the following code
	 *
	 * @return	void		works on $this->content
	 */
	private function moduleContent()	{
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		if (!is_array($this->extConf)) {
			$this->extConf = $this->defaultTYPO3EXTCONF();
		} else {
			if (!$this->extConf['max_records']) {
				$this->extConf = $this->defaultTYPO3EXTCONF();
			}
		}

		$max_records = $this->extConf['max_records'];
		$text_crop = $this->extConf['text_crop'];
		$delusers_firstname = $this->extConf['delusers_firstname'];
		$delusers_lastname = $this->extConf['delusers_lastname'];
		$delusers_email = $this->extConf['delusers_email'];
		if (trim($delusers_firstname) == ''){
			$delusers_firstname = 'deleted';
		}

		if (trim($delusers_lastname) == ''){
			$delusers_lastname = 'user';
		}

		if (trim($delusers_email) == ''){
			$delusers_email = 'deleteduser@site.tld';
		}

		// Get current Page ID
		$pid = $this->id;

		// MAKE THE MENU SELECTION
		$selected1 = ' selected';
		$selected2 = '';
		$selected3 = '';
		$selected4 = '';
		if($_POST['admincommand'] == '2') {
			$selected2 = ' selected';
			$selected1 = '';
			$selected3 = '';
			$selected4 = '';
		}

		if($_POST['admincommand'] == '3') {
			$selected3 = ' selected';
			$selected1 = '';
			$selected2 = '';
			$selected4 = '';
		}

		if($_POST['admincommand'] == '4') {
			$selected4 = ' selected';
			$selected1 = '';
			$selected3 = '';
			$selected2 = '';
		}

		$content .= '
		<div>
		  <span class="tx-tc-title">'.$GLOBALS['LANG']->getLL('function').'</span>
		  <select name="admincommand" size="1">
		    <option value="1" ' . $selected1 . '>' . $GLOBALS['LANG']->getLL('function1') . '</option>
		    <option value="2" ' . $selected2 . '>'. $GLOBALS['LANG']->getLL('function2').'</option>
		    <option value="3" ' . $selected3 . '>'. $GLOBALS['LANG']->getLL('function3').'</option>
		    <option value="4" ' . $selected4 . '>'. $GLOBALS['LANG']->getLL('function4').'</option>
		  </select>
		  <input type="submit" name="actadmincommand" value="'.$GLOBALS['LANG']->getLL('go').'" />
		</div>
		<div class="clearit">&nbsp;</div>
		';

		if (((string)$this->MOD_SETTINGS['function']) == 1)	{

			$settingfunction = 1;
			if(($_POST['actadmincommand']) || ($_POST['actadmincommand2']) || ($_POST['actadmincommand3']) || ($_POST['actadmincommand4']))  {
				if($_POST['admincommand'] == '1') {
					$settingfunction = 1;
				} elseif($_POST['admincommand'] == '2') {
					$settingfunction = 2;
				} elseif($_POST['admincommand'] == '3') {
					$settingfunction = 3;
				} elseif($_POST['admincommand'] == '4') {
					$settingfunction = 4;
				}

			}

			switch((string)$settingfunction) {
			case 1:
				require ('index.comments.php');
				break;

		    case 2:
//* User administration
		    	require ('index.users.php');
			    break;

			case 3:
				require ('index.ips.php');
		    	break;

		    case 4:
		    	require ('index.reports.php');
		    	break;

			}

		}
	}
	/**
	 * read Session directory and return array
	 *
	 * @param	[type]		$optionactivetime: ...
	 * @return	Array		...
	 */
	private function getSessionArray($optionactivetime) {
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
			$filetime = @filemtime($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName']);
			$filefullpath = $getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'];

			$Sessioncontent='';
			if (file_exists($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'])) {
				$Sessioncontent = file_get_contents($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName']);
			}

			session_decode($Sessioncontent);
			$gethostbyaddr = '';
			$rowInitialName='';
			$rowinitial_email = '';
			$row=array();
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('ipresolved, initial_firstname, initial_lastname, initial_email', 'tx_toctoc_comments_user',
					'ip="' . $_SESSION['CurrentIP'] .'" AND toctoc_comments_user = "'.$_SESSION['toctoc_user'].'"', '', '');
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

			$maxactivetime = 8600000;
			$minactivetime = 0;

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
				$sessionActiveTime = $filetime - $_SESSION['StartTime'];
			} else {
				$sessionActiveTime = 0;
			}

			if (($sessionActiveTime >= $minactivetime) && ($sessionActiveTime <= $maxactivetime)) {

				$sessioninfo[$filetime]['SessionLastuseTs'] = $filetime;
				$sessioninfo[$filetime]['SessionLastuse'] = date('Y-m-d H:i:s', $filetime);
				$sessioninfo[$filetime]['SessionName'] = $sessionfile['SessionName'];
				$sessioninfo[$filetime]['Sessionsize'] = $filesize;
				$sessioninfo[$filetime]['emailOrIp'] = $emailOrIp;
				$sessioninfo[$filetime]['Sessionip'] = $_SESSION['CurrentIP'];
				$sessioninfo[$filetime]['Sessionipresolved'] = $gethostbyaddr;
				$sessioninfo[$filetime]['toctoc_comments_user'] = $_SESSION['toctoc_user'];
				$sessioninfo[$filetime]['InitialName'] = $rowInitialName;
				$sessioninfo[$filetime]['LastVisitedPage'] = $_SESSION['curPageName'];
				$sessioninfo[$filetime]['httpUserAgent'] = $_SESSION['httpuseragent'];
				$sessioninfo[$filetime]['activelang'] = $_SESSION['activelang'];
				$sessioninfo[$filetime]['SessionNameFull'] = $filefullpath;
				$sessioninfo[$filetime]['numberOfPages'] = $_SESSION['numberOfPages'];

				if (intval($_SESSION['StartTime']) > 0) {
					$sessioninfo[$filetime]['ActiveTime'] = $filetime - $_SESSION['StartTime'];
				} else {
					$sessioninfo[$filetime]['ActiveTime'] = 0;
				}

				if (!isset($_SESSION['strPHPCookies'])) {
					$strPHPCookies = '';
				} else {
					$strPHPCookies = $_SESSION['strPHPCookies'];
				}

				if (!isset($_SESSION['PHPCookie'])) {
					$strbl = $GLOBALS['LANG']->getLL('sessionnocookies');
					$sessioninfo[$filetime]['PHPCookie'] = '<sup class="tx-tc-alert" title="' . $strbl . '">NA</sup>';
				} elseif ($_SESSION['PHPCookie'] == 0) {
					$strbl = $GLOBALS['LANG']->getLL('sessionzerocookies');
					$sessioninfo[$filetime]['PHPCookie'] = '<sup class="tx-tc-alert" title="' . $strbl . '">&#8709;</sup>';
				} else {
					$strbl = $_SESSION['PHPCookie'] . ' ' . $GLOBALS['LANG']->getLL('sessioncookiesdetected') . ': ' . $strPHPCookies . '';
					$sessioninfo[$filetime]['PHPCookie'] = '<sup class="tx-tc-info" title="' . $strbl . '">' . $_SESSION['PHPCookie'] . '</sup>';
				}

				$i++;
			}
			$_SESSION = array();
		}

		krsort($sessioninfo);
		$retarr=$sessioninfo;
		session_write_close();

		return $retarr;
	}

	/**
	 * Returns the path for dir() of session files
	 *
	 * @return	string		...
	 */
	private function getSessionSavePath() {

		$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/mod1');
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
	private function human_filesize($bytes, $decimals = 2) {
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
	private function getBlacklistForIP($ip) {
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
	private function checkTableBLs($ipaddr) {
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
	private function addLocalBL($ipaddr, $blockfe) {

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
	private function checkStaticBL($ipaddr) {
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
	 * Returns a default TYPO3EXTCONF when $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments'] is empty .
	 * (Concerns a bug seen with TYPO3 7.0.2, after a fresh install)
	 *
	 * @return	array		defaults of $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']
	 */
	private function defaultTYPO3EXTCONF() {
		$ret = array('donationSecret' => '',
					'max_records' => '10',
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
	 * Checks static blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @param	[type]		$huas: ...
	 * @param	[type]		$isbl: ...
	 * @return	boolean		TRUE if exists in the list
	 */
	private function idbot($hua, $huas, $isbl= FALSE) {
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
	 * @return	$ActiveTimeStr		string reprersentation of time difference
	 */
	private function activetime($activetimestamdiff) {
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
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/mod1/index.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/mod1/index.php']);
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

// Make instance:
$SOBE = t3lib_div::makeInstance('toctoc_comments_module1');
$SOBE->init();
$SOBE->menuConfig();
$SOBE->main();
$SOBE->printContent();

?>