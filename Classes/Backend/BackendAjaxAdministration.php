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
require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Utility/BackendStartup.php'));

if ((version_compare(TYPO3_version, '7.6.8', '<'))) {

	if (!is_array($MCONF)) {
		$MCONF = array();

		$MCONF['name'] = 'web_toctoccommentsbeM1';
		$MCONF['script'] = '_DISPATCH';
		$MCONF['_'] = 'mod.php?M=web_toctoccommentsbeM1';
		$MCONF['access'] = 'user,group';
	}

	$GLOBALS['BE_USER']->modAccess($MCONF, 1);	// This checks permissions and exits if the users has no permission for entry.
}
/**
} * AJAX Social Network Components
} *
} * @author Gisele Wendl <gisele.wendl@toctoc.ch>
} * @package TYPO3
} * @subpackage toctoc_comments
} */
class BackendAjaxAdministration extends t3lib_SCbase {
	public $pageinfo;

	// set $vmcNPC if you encounter T3-Crashs while clearing page cache
	public $vmcNPC = 0;

	public $deleteduserischecked = FALSE;

	// Set to true if you want to see which content elements and pages have cleared cache (shown at end of messages)
	public $showcachemessage = FALSE;
	public $picpathsysext = 'sysext/t3skin/icons/gfx/';
	public $picpathgfx = 'gfx/';
	public $picpathtoctoc = '';
	//iconfiles
	//edit
	public $iconEdit = 'edit2.gif';
	//delete
	public $iconDelete = 'garbage.gif';
	//new
	public $iconNew = 'new_el.gif';
	// approval
	public $iconApproved = 'icon_tx_toctoc_comments.gif';
	public $iconNotApproved = 'icon_tx_toctoc_comments_not_approved.gif';
	// refresh
	public $iconRefresh = 'actions-refresh.svg';
	public $iconUnhide = 'button_unhide.gif';
	public $iconHide = 'button_hide.gif';
	public $iconWidthHeight = '';

	/**
	 * 1st main function executes under SOBE (see end of file)
	 *
	 * @return	void		...
	 */
	public function init()	{
		$this->be_common = new toctoc_comments_be_common;
		$this->be_common->setIconsFileMeta($this);
		parent::init();
	}
	/**
	 * 2nd main function executes under SOBE (see end of file)
	 *
	 * @return	[type]		...
	 */
	public function menuConfig()	{
		//placeholder
		$this->MOD_MENU = Array (
				'function' => Array (
						'1' => $GLOBALS['LANG']->getLL('function1'),
				)
		);
		$MCONF = array();

		$MCONF['name'] = 'web_toctoccommentsbeM1';
		$MCONF['script'] = '_DISPATCH';
		$MCONF['_'] = 'mod.php?M=web_toctoccommentsbeM1';
		$MCONF['access'] = 'user,group';
		if (!$this->MCONF['name']) {
			$this->MCONF = $MCONF;
		}
		parent::menuConfig();
	}
	/**
	 * 2nd main function executes under SOBE (see end of file)
	 *
	 * @return	void		...
	 */
	public function main()	{
		if (!isset($_SESSION)) {
			session_name('sess_toctoccommentsbackend');
			session_start();
			if (!isset($_SESSION['sess_toctoccommentsbackend'])) {
				$_SESSION['sess_toctoccommentsbackend']='';
			}

		} else {
			if (!isset($_SESSION['sess_toctoccommentsbackend'])) {
				session_write_close();
				session_name('sess_toctoccommentsbackend');
				session_start();
			}
			if (!isset($_SESSION['sess_toctoccommentsbackend'])) {
				$_SESSION['sess_toctoccommentsbackend']='';
			}

		}

		$this->be_common->initExtConfAndAccessCheck($this);

		if (($_SESSION['backendpid'] && $this->access) || ($GLOBALS['BE_USER']->user['admin'] && !$_SESSION['backendpid']))	{
			// Draw the header.
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->styleSheetFile2=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule.css';
			if (version_compare(TYPO3_version, '6.0', '>')) {
				$this->doc->styleSheetFile=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule7.css';
			}else {
				$this->doc->styleSheetFile=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule4.css';
			}

			$this->doc->backPath = $BACK_PATH;
			$this->doc->form='<form action="" name="myform3" method="post" enctype="multipart/form-data">';

			// JavaScript
			$this->doc->JScode = '';
			$this->doc->postCode='';
			// Render content:
			$this->moduleContent();
		}

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
			$this->extConf = $this->be_common->defaultTYPO3EXTCONF();
		} else {
			if (!$this->extConf['max_records']) {
				$this->extConf = $this->be_common->defaultTYPO3EXTCONF();
			}

		}

		$max_records = $this->extConf['max_records'];
		$this->text_crop = $this->extConf['text_crop'];
		$this->delusers_firstname = $this->extConf['delusers_firstname'];
		$this->delusers_lastname = $this->extConf['delusers_lastname'];
		$this->delusers_email = $this->extConf['delusers_email'];
		if (trim($this->delusers_firstname) == ''){
			$this->delusers_firstname = 'deleted';
		}

		if (trim($this->delusers_lastname) == ''){
			$this->delusers_lastname = 'user';
		}

		if (trim($this->delusers_email) == ''){
			$this->delusers_email = 'deleteduser@site.tld';
		}

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

		$content .= '';
		$settingfunction = 1;
		if ($_POST['admincommand']=='delete') {
			if (intval($_POST['uid']) > 0) {
				$upd = $GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_comments WHERE uid='.$_POST['uid']);
				unset($_SESSION['backendcontentcommentlist']);
				return '';
			} else {
				return '000';
			}

		}

		if ($_POST['admincommand']=='hide') {
			if (intval($_POST['uid']) > 0) {
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET hidden=1 WHERE uid='.$_POST['uid']);
				unset($_SESSION['backendcontentcommentlist']);
				return '';
			} else {
				return '000';
			}

		}

		if ($_POST['admincommand']=='unhide') {
			if (intval($_POST['uid']) > 0) {
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET hidden=0 WHERE uid='.$_POST['uid']);
				unset($_SESSION['backendcontentcommentlist']);
				return '';
			} else {
				return '000';
			}

		}

		if ($_POST['admincommand']=='approve') {
			if (intval($_POST['uid']) > 0) {
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET approved=1 WHERE uid='.$_POST['uid']);
				unset($_SESSION['backendcontentcommentlist']);
				return '';
			} else {
				return '000';
			}
		}

		if ($_POST['admincommand'] == 'disapprove') {
			if (intval($_POST['uid']) > 0) {
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET approved=0 WHERE uid='.$_POST['uid']);
				unset($_SESSION['backendcontentcommentlist']);
				return '';
			} else {
				return '000';
			}

		}

		$settingfunction = 0;
		if(($_POST['actadmincommand']) || ($_POST['actadmincommand1']) || ($_POST['actadmincommand2']) ||
				($_POST['actadmincommand3']) || ($_POST['actadmincommand4']) || ($_POST['actadmincommand5']))  {
			if(intval($_POST['admincommand']) == 1) {
				$settingfunction = 1;
			} elseif(intval($_POST['admincommand']) == 2) {
				$settingfunction = 2;
			} elseif(intval($_POST['admincommand']) == 3) {
				$settingfunction = 3;
			} elseif(intval($_POST['admincommand']) == 4) {
				$settingfunction = 4;
			} elseif(intval($_POST['admincommand']) == 5) {
				$settingfunction = 5;
			}

		}

		switch((string)$settingfunction) {
		case 0:
			if ((!$_SESSION['backendcontentoverviewlist']) || ($_POST['refresh'] == '1')) {
				if ($_POST['refresh'] == '1') {
					unset($_SESSION['backendcontentoverviewlist']);
				}

				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendOverview.php'));

				$this->be_overview = new toctoc_comments_be_overview;
				$contentoverview=$this->be_overview->getoverview($this);
				$this->content=$contentoverview;
			} else {
				$this->content= str_replace('tx-tc-sessioncolornone', 'tx-tc-sessioncolor', $_SESSION['backendcontentoverviewlist']);
			}

			break;
		case 1:
			if ((!$_SESSION['backendcontentcommentlist']) || ($_POST['refresh'] == '1')) {
				if ($_POST['refresh'] == '1') {
					unset($_SESSION['backendcontentcommentlist']);
				}

				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendComments.php'));
				$this->be_comments = new toctoc_comments_be_comments;
				$this->be_comments->beComments($this, $_SESSION['backendpid']);
				$_SESSION['backendcontentlastlist']='comments';
			} else {
				$this->content= str_replace('tx-tc-sessioncolornone', 'tx-tc-sessioncolor', $_SESSION['backendcontentcommentlist']);
				$_SESSION['backendcontentlastlist']='comments';
			}

			break;

	    case 2:
		//* User administration
	    	if ((!$_SESSION['backendcontentuserslist']) || ($_POST['refresh'] == '1')) {
	    		if ($_POST['refresh'] == '1') {
	    			unset($_SESSION['backendcontentuserslist']);
	    		}

				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendUsers.php'));
	    		$this->be_users = new toctoc_comments_be_users;
	    		$this->be_users->beUsers($this, $_SESSION['backendpid']);

	    		$_SESSION['backendcontentlastlist'] = 'users';
	    	} else {
	    		$this->content= str_replace('tx-tc-sessioncolornone', 'tx-tc-sessioncolor', $_SESSION['backendcontentuserslist']);
	    		$_SESSION['backendcontentlastlist'] = 'users';
	    	}

		    break;

		case 3:
			require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendIPs.php'));
			$this->be_ips = new toctoc_comments_be_ips;
			$this->content = $this->be_ips->beIPs($this, $_SESSION['backendpid']);
			break;
	    case 4:
	    	if ($_POST['bulkactreport']) {
		    	$sessidx = intval($_POST['bulkactreport']);
		    	$_SESSION['reportlistidx'] = $sessidx;
	    	}

	    	$sessidx = intval($_SESSION['reportlistidx']);

	    	if ((!$_SESSION['backendcontentreportlist'][$sessidx]) || ($_POST['refresh'] == '1')) {
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendReports.php'));
				$this->be_reports = new toctoc_comments_be_reports;
				$this->be_reports->beReports($this, $_SESSION['backendpid'], $sessidx);
	    		if ($_POST['refresh'] == '1') {
	    			unset($_SESSION['backendcontentreportlist'][$sessidx]);
	    		}

	    		$_SESSION['backendcontentlastlist']='reports' . $sessidx;
	    	} else {
	    		$this->content= str_replace('tx-tc-sessioncolornone', 'tx-tc-sessioncolor', $_SESSION['backendcontentreportlist'][$sessidx]);
	    		$_SESSION['backendcontentlastlist']='reports' . $sessidx;
	    	}

	    	break;
	    case 5:
	    	require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendSystem.php'));
	    	$this->be_db = new toctoc_comments_be_db;
	    	$this->content = $this->be_db->bedb($this);
	    	break;
		}

	}

	/**
	 * 3rd main function executes under SOBE (see end of file)
	 *
	 * @return	void		echoes $this->content
	 */
	public function printContent()	{
		echo $this->content;
		session_write_close();
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/Classes/Backend/BackendAjaxAdministration.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/Classes/Backend/BackendAjaxAdministration.php']);
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

// Make instance:
$SOBE = t3lib_div::makeInstance('BackendAjaxAdministration');
$SOBE->init();
$SOBE->menuConfig();
$SOBE->main();
$SOBE->printContent();

?>