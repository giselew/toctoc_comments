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
require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Utility/BackendStartup.php'));
require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Controller/Dto/BackendOverview.php'));

if (version_compare(TYPO3_version, '7.6.8', '<')) {
	if (!is_array($MCONF)) {
		$modulePath=t3lib_extMgm::extPath('toctoc_comments', 'mod1/');

		$MCONF = array();
		$MCONF['name'] = 'web_toctoccommentsbeM1';
		$MCONF['script'] = '_DISPATCH';
		$MCONF['_'] = 'mod.php?M=web_toctoccommentsbeM1';
		$MCONF['access'] = 'user,group';
	}

	$GLOBALS['BE_USER']->modAccess($MCONF, 1);
}
// This checks permissions and exits if the users has no permission for entry.

/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_module2 extends t3lib_SCbase {
	public $pageinfo;

	// set $vmcNPC if you encounter T3-Crashs while clearing page cache
	private $vmcNPC = 0;

	private $deleteduserischecked = FALSE;

	// Set to true if you want to see which content elements and pages have cleared cache (shown at end of messages)
	private $showcachemessage = FALSE;
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
		$this->be_overview = new toctoc_comments_be_overview;

		$MCONF = array();
		$MCONF['name'] = 'web_toctoccommentsbeM1';
		$MCONF['script'] = '_DISPATCH';
		$MCONF['_'] = 'mod.php?M=web_toctoccommentsbeM1';
		$MCONF['access'] = 'user,group';

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
	 * 3rd main function executes under SOBE (see end of file)
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
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/jquery-1.10.2.min.js"></script>
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/jquery.tablesorter.toctoc.js"></script>
						<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/jquery.tablesorter.toctoc.pager.js"></script>
						<script language="javascript" type="text/javascript">
							var reportssave = [];
							reportssave[0] = "";
							reportssave[1] = "";
							reportssave[2] = "";
							reportssave[3] = "";
							reportssave[4] = "";
							var lastreportindex = 0;
							script_ended = 0;
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
			$this->content.='<a name="txtctopancer" id="txtctopancer"></a>' . $this->doc->header($GLOBALS['LANG']->getLL('title'));
			// Render content:
			$this->moduleContent();

			// ShortCut
			if ($GLOBALS['BE_USER']->mayMakeShortcut())	{
				$this->content .= $this->doc->section('', $this->doc->makeShortcutIcon('id', implode(',', array_keys($this->MOD_MENU)),
						$this->MCONF['name']));
			}
			if (version_compare(TYPO3_version, '7.6.8', '<')) {
				$this->content.=$this->doc->spacer(10);
			}
		} else {
			// If no access or if ID == zero
			$this->doc = t3lib_div::makeInstance('bigDoc');
			$this->doc->backPath = $BACK_PATH;

			$this->content.=$this->doc->startPage($GLOBALS['LANG']->getLL('title'));
			$this->content.=$this->doc->header($GLOBALS['LANG']->getLL('title'));
			if (version_compare(TYPO3_version, '7.6.8', '<')) {
				$this->content.=$this->doc->spacer(5);
				$this->content.=$this->doc->spacer(10);
			}

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
			$max_records = $this->extConf['max_records'];
			$id8 = '';
			if (version_compare(TYPO3_version, '7.9.9', '>')) {
				$id8 = '.8';
			}
			$readyfunctionjs = '		<script language="javascript" type="text/javascript">
					var picext = "' .$this->picext . '";
			function txtcinittablesorter () {
				(function($) {
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


				};

			})(jQuery);
		}
		</script>
		<script type="text/javascript" src="../typo3conf/ext/toctoc_comments/Resources/Public/JavaScript/tx-tc-be-ftr' . $id8 . '.js"></script>
		<script language="javascript" type="text/javascript">
			jQuery(document).ready(function() {
				txtcinittablesorter();
				beftr();
			})(jQuery);
		</script>
				';
			$this->doc->postCode = $readyfunctionjs . $this->doc->postCode;
			$this->content .= '</div><div class="tx-tc-100 tx-tc-donborder"></div>' . $donmsg . '
					<div class="tx-tc-100 tx-tc-toprequester"><span id="txtctoptrigger" class="tx-tc-be-link">to top</span></div>' . $this->doc->endPage();

			// $_SESSION-fill
			//$_SESSION['backendcontent']=$this->content;
		session_write_close();
		echo  $this->content;//. '<div><br>' . session_id(). ', ' . $_SESSION['backendcontentlastlist']. '</div>';

	}

	/**
	 * Main processing - one function for all backend menu points
	 * the function works on $this->content and does all needed data processing
	 * individual menu point logics are separated by a switch in the following code
	 *
	 * @return	void		works on $this->content
	 */
	private function moduleContent()	{
		// Get current Page ID
		$pid = intval(t3lib_div::_GP('id'));
		if (($pid==0) && (intval($this->id) != 0)) {
			$pid = $this->id;
		}

		if ($_SESSION['backendpid']) {
			if ($_SESSION['backendpid'] != $pid) {
				$_SESSION = array();
				$_SESSION['sess_toctoccommentsbackend']='';
			}
		} else {
			$_SESSION = array();
			$_SESSION['sess_toctoccommentsbackend']='';
		}

		$_SESSION['backendpid'] = $pid;

		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		if (!is_array($this->extConf)) {
			$this->extConf = $this->be_common->defaultTYPO3EXTCONF();
		} else {
			if (!$this->extConf['max_records']) {
				$this->extConf = $this->be_common->defaultTYPO3EXTCONF();
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

		if (trim($_SESSION['backendcontentoverviewlist']) != '') {
			$contentoverview = $_SESSION['backendcontentoverviewlist'];
		} else {
			$contentoverview=$this->be_overview->getoverview($this);
			$_SESSION['backendcontentoverviewlist'] = $contentoverview;
		}

		$displaycommentlist=' tx-tc-dontshow';
		$displaycommentlisttitle='';

		if ($_SESSION['backendcontentlastlist']=='comments') {
			$contenttab=$_SESSION['backendcontentcommentlist'];
			$displaycommentlist=' tx-tc-show';
			$displaycommentlisttitle=' tx-tc-show';
		}

		$displayuserlist=' tx-tc-dontshow';
		$displayuserlisttitle='';

		if ($_SESSION['backendcontentlastlist']=='users') {
			$contentusertab = $_SESSION['backendcontentuserslist'];
			$displayuserlist = ' tx-tc-show';
			$displayuserlisttitle = ' tx-tc-show';
		}

		$displayreportlist = ' tx-tc-dontshow';
		$displayreportlisttitle = '';
		$sessidx = 0;
		if ($_SESSION['backendcontentlastlist'] == 'reports') {
			$sessidx = intval($_SESSION['reportlistidx']);
			$contentreporttab = $_SESSION['backendcontentreportlist'][$sessidx];
			$displayreportlist = ' tx-tc-show';
			$displayreportlisttitle = ' tx-tc-show';
		}

		$this->content .= '
		<div id="txtcbe-ajaxtitleoverview" class="tx-tc-panelbar">
				<span class="tx-tc-title">'.$GLOBALS['LANG']->getLL('overview').'</span>

	    		<span id="shwoverview" class="tx-tc-showpanel" title="'.$GLOBALS['LANG']->getLL('refresh').'"><img ' . $this->iconWidthHeight . 'src="'.
					$GLOBALS['BACK_PATH'] . $this->picpathsysext . $this->iconHide . '" border="0" title="'.
	    			$GLOBALS['LANG']->getLL('refresh').'" align="top" alt="" />
	    		</span>
	    		<span id="roverview" class="tx-tc-refresh" title="'.$GLOBALS['LANG']->getLL('refresh').'"><img ' . $this->iconWidthHeight . 'src="'.
					$GLOBALS['BACK_PATH'] . $this->picpathsysext . $this->iconRefresh . '" border="0" title="'.
	    			$GLOBALS['LANG']->getLL('refresh').'" align="top" alt="" />
	    		</span>

		</div>
	    <div id="txtcbe-ajaxloadingoverview" class="tx-tc-100 tx-tc-loadingbar" style="display: none;">
	    		<img width="32" src="'.$GLOBALS['BACK_PATH'] . $this->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    $GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    </div>
	    <div id="txtcbe-ajaxoverview" class="">
			' . $contentoverview . '
		</div>

		<div id="txtcbe-ajaxtitletablecomments" class="tx-tc-panelbar' . $displaycommentlisttitle . '">
				<span class="tx-tc-title">'.$GLOBALS['LANG']->getLL('function1').'</span>
				<span id="rcomment" class="tx-tc-refresh" title="'.$GLOBALS['LANG']->getLL('refresh').'"><img ' . $this->iconWidthHeight . 'src="'.$GLOBALS['BACK_PATH'] .
				 $this->picpathsysext . $this->iconRefresh . '" border="0" title="'.
	    $GLOBALS['LANG']->getLL('refresh').'" align="top" alt="" /></span>
		</div>
	    <div class="tx-tc-100 tx-tc-loadingbar" id="txtcbe-ajaxloadingcomments" style="display: none;">
	    		<img width="32" src="'.$GLOBALS['BACK_PATH'] . $this->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    $GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    </div>
		 <div id="txtcbe-ajaxtablecomments" class="tx-tc-100' . $displaycommentlist . '">
		 		' . $contenttab . '
		</div>

	    <div id="txtcbe-ajaxtitletableusers" class="tx-tc-panelbar' . $displayuserlisttitle . '">
				<span class="tx-tc-title">'.$GLOBALS['LANG']->getLL('function2').'</span>
				<span id="ruser" class="tx-tc-refresh" title="'.$GLOBALS['LANG']->getLL('refresh').'"><img ' . $this->iconWidthHeight . 'src="'.$GLOBALS['BACK_PATH'] .
				$this->picpathsysext . $this->iconRefresh . '" border="0" title="'.$GLOBALS['LANG']->getLL('refresh').'" align="top" alt="" />
				</span>
		</div>
	    <div id="txtcbe-ajaxloadingusers" class="tx-tc-100 tx-tc-loadingbar" style="display: none;">
	    		<img width="32" src="'.$GLOBALS['BACK_PATH'] . $this->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    $GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    </div>
		 <div id="txtcbe-ajaxtableusers" class="tx-tc-100' . $displayuserlist . '">
		 		' . $contentusertab . '
		</div>

	    <div id="txtcbe-ajaxtitletablereports" class="tx-tc-panelbar' . $displayreportlisttitle . '">
		 	<span class="tx-tc-title">'.$GLOBALS['LANG']->getLL('function4').'</span>
				<span id="rreport" class="tx-tc-refresh" title="'.$GLOBALS['LANG']->getLL('refresh').'"><img ' . $this->iconWidthHeight . 'src="'.$GLOBALS['BACK_PATH'] .
				$this->picpathsysext . $this->iconRefresh . '" border="0" title="'.$GLOBALS['LANG']->getLL('refresh').'" align="top" alt="" />
				</span>
		</div>
	    <div id="txtcbe-ajaxloadingreports" class="tx-tc-100 tx-tc-loadingbar" style="display: none;">
	    		<img width="32" src="'.$GLOBALS['BACK_PATH'] . $this->picpathsysext . 'big-f0f0f0.gif" border="0" title="'.
	    $GLOBALS['LANG']->getLL('refreshing').'" align="top" alt="" />
	    </div>
	    <div id="txtcbe-ajaxtablereports" class="tx-tc-100' . $displayreportlist . '">
		 		' . $contentreporttab  . '
		</div>
		<div class="clearit">&nbsp;</div>
		';
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/Classes/Backend/BackendAdministration.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/Classes/Backend/BackendAdministration.php']);
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

// Make instance:
$SOBE = t3lib_div::makeInstance('toctoc_comments_module2');
$SOBE->init();
$SOBE->menuConfig();
$SOBE->main();
$SOBE->printContent();

?>