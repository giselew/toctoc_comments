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
	$GLOBALS['BE_USER']->modAccess($MCONF, 1);	// This checks permissions and exits if the users has no permission for entry.
}


/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class  toctoc_comments_module1 extends t3lib_SCbase {

	public $pageinfo;

	// set $vmcNPC if you encounter T3-Crashs while clearing page cache
	public $vmcNPC = 0;

	public $deleteduserischecked = FALSE;

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
		$this->be_common->initExtConfAndAccessCheck($this);

		if (($this->id && $this->access) || ($GLOBALS['BE_USER']->user['admin'] && !$this->id))	{
			// Draw the header.
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->styleSheetFile2=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule.css';
			if (version_compare(TYPO3_version, '6.0', '>')) {
				$this->doc->styleSheetFile=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule7.css';
			} else {
				$this->doc->styleSheetFile=$GLOBALS['temp_modPath'].'../typo3conf/ext/toctoc_comments/mod1/css/bemodule4.css';
			}

			$this->doc->backPath = $BACK_PATH;
			$this->doc->form='<form action="" name="myform3" method="post" enctype="multipart/form-data">';

			// JavaScript
			$this->doc->JScode = '
						<script src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/jquery-1.10.2.min.js" type="text/javascript"></script>
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/jquery.tablesorter.toctoc.js"></script>
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/jquery.tablesorter.toctoc.pager.js"></script>
						<script language="javascript" type="text/javascript">
							var script_ended = 0;
							function jumpToUrl(URL)	{
								document.location = URL;
							}
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
		$max_records = $this->extConf['max_records'];
		$donmsg = $donlib->displayDonationMessage();

		$readyfunctionjs = '<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/tx-tc-be-ftr.js"></script>
		<script language="javascript" type="text/javascript">
		jQuery(document).ready(function() {
		if ($(".pagenav").length > 0) {
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
		}
		beftr();
		})(jQuery);
	</script>
			';
		$this->doc->postCode=$readyfunctionjs.$this->doc->postCode;
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
			$this->extConf = $this->be_common->defaultTYPO3EXTCONF();
		} else {
			if ((!$this->extConf['max_records']) || intval($this->extConf['text_crop']) == 0) {
				$this->extConf = $this->be_common->defaultTYPO3EXTCONF();
			}
		}

		$this->max_records = $this->extConf['max_records'];
		$this->text_crop = $this->extConf['text_crop'];
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
		$this->delusers_firstname = $delusers_firstname;
		$this->delusers_lastname = $delusers_lastname;
		$this->delusers_email = $delusers_email;

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

		$newcomments = 0;
		$newusers = 0;
		$newsince = intval($this->extConf['new_Hours']);

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

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_user', 'deleted=0 AND crdate > ' . $newsince);
		if (count($recs)>0) {
			if ($recs[0]['t'] != 0) {
				// new users
				$newusers = $recs[0]['t'];
			}
		}

		$newsmessage='';
		If ($newusers+$newcomments > 0) {
			$txtsince = $GLOBALS['LANG']->getLL('sysnewssince');
			$newsmessage='<div class="tx-tc-title tx-tc-newstitle tx-tc-information">'.$GLOBALS['LANG']->getLL('sysnews').'</div>
				<div class="tx-tc-textbody">';
			If ($newcomments > 1) {
				$newsmessage .= trim('<div class="tx-tc-newcommentstar"><span class="tx-tc-star">*</span></div>' . $newcomments . ' ' . $GLOBALS['LANG']->getLL('nnewcomments'). ' ' . $txtsince) . ' '. $txthout;
			}

			If ($newcomments == 1) {
				$newsmessage .= trim('<div class="tx-tc-newcommentstar"><span class="tx-tc-star">*</span></div>' . $GLOBALS['LANG']->getLL('onenewcomment'). ' ' . $txtsince) . ' ' . $txthout;
			}

			If ($newcomments > 0) {
				$newsmessage .= '<br />';
				$txthout = '';
				$txtsince = '';
			}

			If ($newusers > 1) {
				$newsmessage .= trim('<div class="tx-tc-newuserstar"><span class="tx-tc-star">*</span></div>' . $newusers . ' ' . $GLOBALS['LANG']->getLL('nnewusers'). ' ' . $txtsince . ' '. $txthout);
			}

			If ($newusers == 1) {
				$newsmessage .= trim('<div class="tx-tc-newuserstar"><span class="tx-tc-star">*</span></div>' . $GLOBALS['LANG']->getLL('onenewuser'). ' ' . $txtsince . ' '. $txthout);
			}

			$newsmessage .= '</div>';
		}

		$this->content .= '
		<div class="tx-tc-50">
		  <span class="tx-tc-title">'.$GLOBALS['LANG']->getLL('function').'</span>
		  <select name="admincommand" size="1">
		    <option value="1" ' . $selected1 . '>' . $GLOBALS['LANG']->getLL('function1') . '</option>
		    <option value="2" ' . $selected2 . '>'. $GLOBALS['LANG']->getLL('function2').'</option>
		    <option value="3" ' . $selected3 . '>'. $GLOBALS['LANG']->getLL('function3').'</option>
		    <option value="4" ' . $selected4 . '>'. $GLOBALS['LANG']->getLL('function4').'</option>
		  </select>
		  <input type="submit" name="actadmincommand" value="'.$GLOBALS['LANG']->getLL('go').'" />
		</div>
		<div class="tx-tc-50">
		  		' . $newsmessage . '
		</div>
		<div class="clearit">&nbsp;</div>
		';

		if (((string)$this->MOD_SETTINGS['function']) == 1)	{
			$_POST['oldbe'] = 1;
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
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendComments.php'));

				$this->be_comments = new toctoc_comments_be_comments;
				$this->be_comments->beComments($this, $pid);
				break;
		    case 2:
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendUsers.php'));
		    	$this->be_users = new toctoc_comments_be_users;
	    		$this->be_users->beUsers($this, $pid);
			    break;

			case 3:
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendIPs.php'));
				$this->be_ips = new toctoc_comments_be_ips;
				$this->be_ips->beIPs($this, $pid);
				break;

		    case 4:
		    	require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendReports.php'));
				$this->be_reports = new toctoc_comments_be_reports;
				$this->be_reports->beReports($this, $pid);

		    	break;

			}
			unset($_POST['oldbe']);

		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/Classes/Backend/OldBackendAdministration.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/Classes/Backend/OldBackendAdministration.php']);
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