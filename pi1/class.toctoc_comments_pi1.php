<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2013 Gisele Wendl <gisele.wendl@toctoc.ch>
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
* class.toctoc_comments_pi1.php
*
* AJAX Social Network Components.
*
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   83: class tx_toctoccomments_pi1 extends tslib_pibase
 *  148:     public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = null)
 * 1599:     protected function checkJSLoc()
 * 1686:     protected function checkCSSTheme()
 * 1777:     protected function checkCSSLoc()
 * 1875:     protected function initprefixToTableMap()
 * 1907:     function init($newconfigcsswaswritten = 0)
 * 2321:     function mergeConfiguration()
 * 2564:     function fetchConfigValue($param)
 * 2587:     function createLinks($text)
 * 2606:     function applyStdWrap($text, $stdWrapName)
 * 2618:     protected function ae_detect_ie()
 * 2639:     protected function boxmodel($newconfigcsswaswritten = 0)
 * 2999:     protected function calculate_string( $mathString )
 * 3020:     protected function locationHeaderUrlsubDir()
 * 3036:     protected function currentPageName()
 * 3056:     protected function ttclearcache ($pid, $withplugin=true, $withcache = false, $debugstr = '')
 * 3081:     protected function doClearCache ($forceclear=false)
 * 3107:     protected function getPluginCacheControlTstamp ($external_ref_uid)
 * 3129:     protected function getLastUserAdditionTstamp ()
 * 3150:     protected function initLegacyCache ()
 * 3162:     protected function check_scopes()
 *
 * TOTAL FUNCTIONS: 21
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(PATH_t3lib . 'class.t3lib_befunc.php');
require_once(PATH_tslib . 'class.tslib_pibase.php');
if (!version_compare(TYPO3_version, '4.6', '<')) {
	require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
}

require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));

/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class tx_toctoccomments_pi1 extends tslib_pibase {

	// Default plugin variables:
	var $prefixId = 'toctoc_comments_pi1';
	var $scriptRelPath = 'pi1/class.toctoc_comments_pi1.php';
	var $extKey = 'toctoc_comments';
	var $extVersion = '410';

	public $pi_checkCHash = true;				// Required for proper caching! See in the typo3/sysext/cms/tslib/class.tslib_pibase.php
	var $externalUid;						// UID of external record
	var $showUidParam = 'showUid';			// Name of 'showUid' GET parameter (different for tt_news!)
	var $where;								// SQL WHERE for records
	var $where_dpck;						// SQL WHERE for double post checks
	var $templateCode;						// Full template code
	var $foreignTableName;					// Table name of the record we comment on
	var $formValidationErrors = array();	// Array of form validation errors
	var $formTopMessage = '';// This message is displayed in the top of the form
	var $feuserid=0;


	var $templavoila_field = 'field_content';  // If the option is not set, this is the default name of the TemplaVoila Field which holds the MainContent
	var $maxtimeafterinsert = 1299;			   // time in milliseconds the system waits until considering a submit as new total transaction
											   //    insert, header and then show the plugins of the page
	var $totalrows  = 0;
	var $startpoint  = 0;
	var $ref = '';
	var $extref = '';

	var $lhookTablePrefix  = 0;
	var $lhookId = '';
	var $hooksrecordcontentelement  = 0;
	var $hooksrecordpage  = 0;

	var $showonlyHTML5 = true;				// HTML5 Upload is only used for Browsers that use HTML5
	var $respectExternalPrefixinWhereClause= false;    // when selecting comments the field external_prefix limiting the selcting to the extension who wrote the
															// comments, not the table - with false the extension is ignored and the record itself is the object
															// which is more logic. however here you can change it again to the restriction for extension

	var $communityFriendsProfileListAccessright = 1;  // 0:only me, 1= only friends, 2 all users see comments on my user profile

	var $boxmodelcss='';
	var $boxmodelTextareaAreaTotalHeight=32;

	var $processcssandjsfiles = false;
	var $cachedropped=false;

	var $showsdebugprint = false;
	var $sdebugprint='';
	var $sdebuginitprint='';
	var $sdebugprintuser=-1;
	var $showsdebugprintstartuptimes=false;

	var $activateClearPageCache=false;
	var $debugshowuserint=false;

	/**
	 * Main function of the plugin
	 *
	 * @param	string		$content	Content (unused)
	 * @param	array		$conf	TS configuration of the extension
	 * @param	string		$hookTablePrefix: when called from other extensions this is the externalPrefix used in toctoc_comments
	 * @param	int		$hookId: id to be commented or rated on from table behind $hookTablePrefix
	 * @param	obj		$hookcObj: the cObj of the parent object for calls with $hookTablePrefix set
	 * @return	void
	 */
	public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = null) {

		$this->conf = $conf;
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);

		if (intval($this->conf['debug.']['useDebug'])==1) {
			$this->showsdebugprint = true;
		}
		if ($this->conf['debug.']['useDebugFeUserIds']!='') {
			$dbuarr=explode(',',$this->conf['debug.']['useDebugFeUserIds']);
			foreach($dbuarr as $dbusr) {
				if ($dbusr==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$this->sdebugprintuser=$dbusr;
				}
			}

		}
		if (intval($this->conf['debug.']['showStartupDetails'])==1) {
			$this->showsdebugprintstartuptimes = true;
		}
		if (intval($this->conf['debug.']['showLibDetails'])==1) {
			$showsdebugprintlibtimes = true;
		}

		unset($this->conf['debug.']);
		session_name('sess_' . $this->extKey);
		session_start();


		if ($this->showsdebugprint==true) {
			$starttimedebug=microtime(true);
			$timereportlast='';
			if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$tdifftolastrun = 1000*(microtime(true) - $_SESSION['edgeTime']);
				if ($tdifftolastrun<=20000) {
					$timereportlast='<div class="tx-tc-debug">Time since last rendering: ' . round($tdifftolastrun,1) .  ' ms</div>';
				}
			}
		}


		/* 		We choose to use PHP-Sessions instead of TYPO3-sessions
 * 		The TYPO3-sessions work well from page call to page call, but inside page generation these sessions are
 * 		not suitable, because they committ only after the page has been generated,
 * 		which is definetely to slow to pass session-information in contentelement rendering
 *
 *
 */
		if (intval($showsdebugprintlibtimes)==1) {
			$strdebugprintlib='';
			$starttimedebuglib=microtime(true);
		}

		$this->lib = new toctoc_comment_lib;
		if (intval($showsdebugprintlibtimes)==1) {
			$difftimedebuglib= 1000*(microtime(true)-$starttimedebuglib);
			$strdebugprintlib='<div class="tx-tc-debug"><b>Lib, details</b> (times in ms): <br>Load Lib ' . round($difftimedebuglib,1) .  '';
		}
		$this->lib->fixLL($this->conf);

		$this->pi_loadLL();
		// check plugin
		$this->boxmodelcss ='tx-tc' . $this->extVersion . '.css';
		$this->pi_initPIflexForm();
		$isPlugin=0;
		if (intval($this->conf['ratings.']['maxValue'])>11) {
			$this->conf['ratings.']['maxValue']=11;
		}
		if (intval($this->conf['ratings.']['maxValue'])<1) {
			$this->conf['ratings.']['maxValue']=1;
		}
		if (intval($this->conf['ratings.']['minValue'])>intval($this->conf['ratings.']['maxValue'])) {
			$this->conf['ratings.']['minValue']=intval($this->conf['ratings.']['maxValue']);
		}
		if (intval($this->conf['advanced.']['activateClearPageCache'])==1) {
			$this->activateClearPageCache=true;
			$this->conf['advanced.']['useSessionCache'] = 0;
		}

		if ((intval(t3lib_div::_GP('purge_cache'))==1) && (intval($_SESSION['cachepurged'])!=1)) {
			$saveactivateClearPageCache=$this->activateClearPageCache;
			$this->activateClearPageCache=true;
			$_SESSION=array();
			$this->doClearCache();
			$this->activateClearPageCache=$saveactivateClearPageCache;
			$_SESSION['cachepurged']=1;
		} elseif (intval(t3lib_div::_GP('purge_cache'))==1){

		} else {
			$_SESSION['cachepurged']=0;
		}
		if (intval($this->conf['theme.']['boxmodelTextareaLineHeight'])<16) {
			$this->conf['theme.']['boxmodelTextareaLineHeight']=16;
		}
		if (intval($this->conf['theme.']['boxmodelTextareaLineHeight'])>30) {
			$this->conf['theme.']['boxmodelTextareaLineHeight']=30;
		}
		if (intval($this->conf['theme.']['boxmodelSpacing'])<0) {
			$this->conf['theme.']['boxmodelSpacing']=0;
		}
		if (intval($this->conf['theme.']['boxmodelSpacing'])>10) {
			$this->conf['theme.']['boxmodelSpacing']=10;
		}
		if (intval($this->conf['theme.']['boxmodelTextareaNbrLines'])<1) {
			$this->conf['theme.']['boxmodelTextareaNbrLines']=1;
		}
		if (intval($this->conf['theme.']['boxmodelTextareaNbrLines'])>6) {
			$this->conf['theme.']['boxmodelTextareaNbrLines']=6;
		}
		if (intval($this->conf['theme.']['boxmodelLineHeight'])<16) {
			$this->conf['theme.']['boxmodelLineHeight']=16;
		}
		if (intval($this->conf['theme.']['boxmodelLineHeight'])>40) {
			$this->conf['theme.']['boxmodelLineHeight']=40;
		}

		if (intval($this->conf['theme.']['boxmodelLabelWidth'])>200) {
			$this->conf['theme.']['boxmodelLabelWidth'] = 200;
		}
		if (intval($this->conf['theme.']['boxmodelLabelWidth'])<50) {
			$this->conf['theme.']['boxmodelLabelWidth'] =50;
		}
		if (intval($this->conf['theme.']['boxmodelInputFieldSize'])>40) {
			$this->conf['theme.']['boxmodelInputFieldSize'] = 40;
		}
		if (intval($this->conf['theme.']['boxmodelInputFieldSize'])<12) {
			$this->conf['theme.']['boxmodelInputFieldSize'] =12;
		}
		if (intval($this->conf['advanced.']['showCountViews'])==0) {
			$this->conf['advanced.']['showCountCommentViews'] =0;
		}
		if (intval($this->conf['advanced.']['activityMultiplicatorRating'])<1) {
			$this->conf['advanced.']['activityMultiplicatorRating'] =1;
		}
		if (intval($this->conf['advanced.']['activityMultiplicatorComment'])<1) {
			$this->conf['advanced.']['activityMultiplicatorComment'] =1;
		}


		$this->boxmodelTextareaHeight=intval($this->conf['theme.']['boxmodelTextareaLineHeight'])*intval($this->conf['theme.']['boxmodelTextareaNbrLines']);
		$this->boxmodelTextareaAreaTotalHeight=4 + $this->boxmodelTextareaHeight  + (2 * intval($this->conf['theme.']['boxmodelSpacing']));
		$this->communityFriendsProfileListAccessright = $this->conf['advanced.']['communityProfileCommentsVisibility'];
		unset ($this->conf['advanced.']['communityProfileCommentsVisibility']); // dont need it anymore, free some place in $conf
		if ($this->showsdebugprint==true) {
			$starttimeprefixes=microtime(true);
		}
		$this->fetchConfigValue('optionalRecordId');
		$this->fetchConfigValue('externalPrefix');

		if (intval($this->conf['externalPrefix'])>0) {
			if ($this->conf['externalPrefix']!='') {
				$where = 'uid=' . $this->conf['externalPrefix'];
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table',
						'tx_toctoc_comments_prefixtotable',
						$where,
						'',
						'',
						''
				);
				$arrwithid=explode('_',$this->conf['optionalRecordId']);
				unset($arrwithid[count($arrwithid)-1]);
				$recordtable=implode('_',$arrwithid);
				if ($this->conf['externalPrefix'] != 'pages') {

						if($recordtable != $rows[0]['pi1_table']) {
							if ($recordtable != 'tt_content') {
							//then we have mismach between $this->conf['externalPrefix'] and the record
								$where = 'pi1_table="' . $recordtable .'"';
								$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
										'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table',
										'tx_toctoc_comments_prefixtotable',
										$where,
										'',
										'',
										''
								);
								if (count($rowsrf)>0) {
									$this->conf['externalPrefix']=$rowsrf[0]['pi1_key'];
								} else {
									// did really not find an external prefix for this record ...

								}
							} else {
								$this->conf['externalPrefix']=$rows[0]['pi1_key'];
							}

						} else {
							$this->conf['externalPrefix']=$rows[0]['pi1_key'];
						}

				}

			}
		} else {
			// check the record if it's really a tt_content one...
			if ($this->conf['optionalRecordId'] != '') {
				$arrwithid=explode('_',$this->conf['optionalRecordId']);
				unset($arrwithid[count($arrwithid)-1]);
				$recordtable=implode('_',$arrwithid);


				if ($this->conf['externalPrefix'] != 'pages') {
					if ($recordtable != 'tt_content') {
					//then we have mismach between $this->conf['externalPrefix'] and the record

						$where = 'pi1_table="' . $recordtable .'"';
						$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
								'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table',
								'tx_toctoc_comments_prefixtotable',
								$where,
								'',
								'',
								''
						);
						if (count($rowsrf)>0) {
							$this->conf['externalPrefix']=$rowsrf[0]['pi1_key'];
						} else {
							// did really not find an external prefix for this record ...
							return sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->lib->pi_getLLWrap($this, 'error.prefix.table', false) . '</p></div>', $this->conf['optionalRecordId']);
						}
					}
				}
			}

		}
		$contentelementMultiReference='';
		if (($this->conf['externalPrefix'] != 'pages') && ($this->lhookTablePrefix == '')) {
			$contentelementMultiReference=''. $this->conf['storagePid'];

		}

		$optionalRecordIdlhookTablePrefix='';
		$optionalRecordIdlhookId=0;
		$optionalRecordIdforexternalPrefix='';
		if ($this->conf['optionalRecordId'] != '') {
			$arrwithid=explode('_',$this->conf['optionalRecordId']);
			$triggeredRecordId=$arrwithid[count($arrwithid)-1];
			unset($arrwithid[count($arrwithid)-1]);
			$triggeredRecord=implode('_',$arrwithid);

			$isPlugin=1;
			$_SESSION['commentListCount']=0;
			if ($this->conf['externalPrefix'] != 'pages') {
				if ($triggeredRecord != 'tt_content') {
					$hookTablePrefix=$this->conf['externalPrefix'];
					$hookId=$triggeredRecordId;
				} else {
					$optionalRecordIdlhookTablePrefix = 'tt_content';
					$optionalRecordIdlhookId = $triggeredRecordId;
					$optionalRecordIdforexternalPrefix =$this->conf['optionalRecordId'];
					$triggeredRecordId = 0;
				}
			}
			unset($this->conf['optionalRecordId']);
		}


		if ($this->conf['externalPrefix'] == 'pages') {
			if (intval($triggeredRecordId) != 0) {
				if ($isPlugin == 0) {
					$this->cObj = t3lib_div::makeInstance('tslib_cObj');
					$this->cObj->start('', '');
				}
				$this->lhookTablePrefix = 'tt_content';
				$this->lhookId = $triggeredRecordId;
			}
		} else {
			$triggeredRecordId = 0;
		}

		if ($hookTablePrefix != '') {
			if ($hookcObj) {
				$this->cObj=$hookcObj;
			}
			$this->lhookTablePrefix=$hookTablePrefix;
			$this->lhookId=$hookId;
			$hookTablePrefix = '';
		}
		if ($this->conf['commentsreport.']['active']) {
			$conftx_commentsreport = $this->conf['commentsreport.'];
			$this->conf['tx_commentsreport_pi1.']['reportPid']=$conftx_commentsreport['reportPid'];
			$conflink = array(
					// Link to current page
					'parameter' => $conftx_commentsreport['reportPid'],
					// Set additional parameters
					'additionaParams' => '',
					// We must add cHash because we use parameters ... hmmm - not that sure!
					'useCashHash' => true,
					// We want link only
					'returnLast' => 'url',
					'ATagParams' => 'rel="nofollow"',
			);
			$reportpage = $this->cObj->typoLink('', $conflink);
			$_SESSION['reportpage'] = $reportpage;
		}

		//conf-ckecks
		if ($this->conf['advanced.']['userCommentResponseLevels'] > 20) {
			$this->conf['advanced.']['userCommentResponseLevels'] = 20;
		}
		if ($this->conf['advanced.']['userCommentResponseLevelExpanded'] > 20) {
			$this->conf['advanced.']['userCommentResponseLevelExpanded'] = 20;
		}
		if ($this->conf['minCommentLength'] >$this->conf['maxCommentLength']) {
			$this->conf['maxCommentLength']=$this->conf['minCommentLength']+1;
		}
		if ($this->conf['UserImageSize'] >96) {
			$this->conf['UserImageSize']=96;
		}
		if ($this->conf['UserImageSize'] <18) {
			$this->conf['UserImageSize']=18;
		}
		if ($this->conf['advanced.']['commentsEditBack'] >50) {
			$this->conf['advanced.']['commentsEditBack']=50;
		}
		if ($this->showsdebugprint==true) {
			$starttimesessions=microtime(true);
		}
		$_SESSION['started'] = (!isset($_SESSION['started']) ? 0 : 1);

		if ($_SESSION['started'] == 0) {
		// brand new session: Init almost all session vars
			$this->lib->resetSessionVars(0);
			$_SESSION['commentListIndex'] = array();
		}
		if (!is_array($_SESSION['TSFE'])) {
			unset($_SESSION['TSFE']);
			$_SESSION['TSFE']= array();
			$_SESSION['TSFE']['spamProtectEmailAddresses']=$GLOBALS['TSFE']->spamProtectEmailAddresses;
			$_SESSION['TSFE']['absRefPrefix']=$GLOBALS['TSFE']->absRefPrefix;
			$_SESSION['TSFE']['mainScript'] =$GLOBALS['TSFE']->config['mainScript'] ;
			$_SESSION['TSFE']['getMethodUrlIdToken']=$GLOBALS['TSFE']->getMethodUrlIdToken;
		}

		if (!is_array($_SESSION['TSFE']['config'])) {
				unset($_SESSION['TSFE']['config']);
				$_SESSION['TSFE']['config'] = array();
				$_SESSION['TSFE']['config']['jumpurl_enable'] = $GLOBALS['TSFE']->config['config']['jumpurl_enable'];
				$_SESSION['TSFE']['config']['jumpurl_mailto_disable'] = $GLOBALS['TSFE']->config['config']['jumpurl_mailto_disable'];
				$_SESSION['TSFE']['config']['spamProtectEmailAddresses_atSubst']=$GLOBALS['TSFE']->config['config']['spamProtectEmailAddresses_atSubst'];
				$_SESSION['TSFE']['config']['spamProtectEmailAddresses_lastDotSubst']=$GLOBALS['TSFE']->config['config']['spamProtectEmailAddresses_lastDotSubst'];
		}

		unset($_SESSION['requestCapcha']);
		$_SESSION['requestCapcha'] = array();

		$tdiff = 1000*(microtime(true) - $_SESSION['edgeTime']);

		$printrendering='';
		$sessionreseted=false;
		$this->processcssandjsfiles=false;
		$localssesreset=false;
		if (intval($tdiff) > intval($this->maxtimeafterinsert)) {
			if (isset($_SESSION['rowscidflex'])) {
				if (count($_SESSION['rowscidflex'])>0) {

					if (intval($_SESSION['indexOfSortedCommentsCidList']) >=count($_SESSION['rowscidflex'])-1) {

						$localssesreset=true;
					} else {
						if ($_SESSION['renderingdone']==true) {
							$localssesreset=true;
						} elseif (intval($tdiff) > 10*intval($this->maxtimeafterinsert)) {
							$printrendering .= 'Start Pagerendering at <b>' . date("H:i:s") . '</b>';
							$timereportlast='';
							$_SESSION['renderedplugins']=0;

						}

					}
				} else {
						$localssesreset=true;
				}
			} else {
				$localssesreset=true;
			}

			if ($localssesreset==true) {
				$this->lib->resetSessionVars(0);
				$sessionreseted=true;
				$printrendering .= 'Start Pagerendering at <b>' . date("H:i:s") . '</b>, resetSessionVars(0) done';
				$timereportlast='';
				$this->processcssandjsfiles=true;
			}
		}

		if ($this->showsdebugprint==true) {
			if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				if ($printrendering!='') {
					$timereportlast.='<div class="tx-tc-debug">' . $printrendering .  '</div>';

				}
			}
		}

		$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;

		/*
		 * independent situations where a emptycache is needed subsequently
		 * 1. a new page and since the last visit there have been changes possibly
		 * 2. In the languagemenu the user changes from one lang to another.
		 * 3. The user logs in as a different user
		 */
		$_SESSION['commentsPageIds'][$GLOBALS['TSFE']->id] = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
		$_SESSION['commentsPageTitles'][$GLOBALS['TSFE']->id] = $GLOBALS['TSFE']->page['title'];
		$this->sdebugprint='<div class="tx-tc-debug">';
		$sessionreseted=true;
		$_SESSION['debugprintlib']='';
		if (intval($showsdebugprintlibtimes)==1) {
			$_SESSION['debugprintlib']=array();
			$_SESSION['debugprintlib']['debugtext']=$strdebugprintlib;
		}
		$this->feuserid=intval($GLOBALS['TSFE']->fe_user->user['uid']);
		$_SESSION['currentfeuserid']=$this->feuserid;
		$this->pi_USER_INT_obj = 0;
		if ($_SESSION['commentsPageId'] != $GLOBALS['TSFE']->id) {
			// new page
			// store request url for eID
			$this->lib->resetSessionVars(0);
			$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new page id ' .$GLOBALS['TSFE']->id. '<br>';

		} elseif ($_SESSION['curPageName'] != $this->currentPageName()) {
			// language change
			$this->lib->resetSessionVars(0);
			$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new curPageName ' . $this->currentPageName() . '<br>';
			$_SESSION['curPageName'] = $this->currentPageName();

		} elseif ($_SESSION['activelang'] != $GLOBALS['TSFE']->lang) {
			// language change
			$this->lib->resetSessionVars(0);
				$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new language ' .$GLOBALS['TSFE']->lang . '<br>';

		} elseif ($_SESSION['feuserid'] != $GLOBALS['TSFE']->fe_user->user['uid']) {
			// User has made a logon or logout
			if ($GLOBALS['TSFE']->fe_user->user['uid']>0) {
				$_SESSION['feuserid'] =0;
			}
			$this->sdebugprint .= 'feuserid, no total init of Sessionvariables ' .$clearCacheIds. '<br>';


		} elseif ($_SESSION['commentsSorting'] != $this->conf['advanced.']['reverseSorting']) {
			// Admin made change in TS-Setup, here just clear the cache if not already done

			$this->lib->resetSessionVars(0);
				$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new comments sorting, ' . $this->conf['advanced.']['reverseSorting']. '<br>';

		} else {
			$sessionreseted=false;
			$this->pi_USER_INT_obj = 0;
		}
		if (intval($GLOBALS['TSFE']->fe_user->user['uid'])!=0) {
			if (intval($GLOBALS['TSFE']->config['config']['sendCacheHeaders'])==1) {
				$this->ttclearcache($GLOBALS['TSFE']->id,false, true,'sendCacheHeaders');
				$this->sdebugprint .= 'You could set TS Option page.config.sendCacheHeaders = 0 for logged in users to avoid this clear cache<br>';
			}
		}
		if (!isset($_GET['toctoc_comments_pi1']['anchor'])) {
			if (intval($_SESSION['recentcommentsclearcachepage'])!=0) {

				$this->ttclearcache($_SESSION['recentcommentsclearcachepage'],true, true,'recentcommentsclearcachepage');
				$_SESSION['recentcommentsclearcachepage']=0;
			}
		}
		if ($sessionreseted==true) {
			// common session inits after a reset
			$_SESSION['commentListIndex'] = array();
			$_SESSION['curPageName'] = $this->currentPageName();
			$_SESSION['activelang'] =$GLOBALS['TSFE']->lang;
			$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;
			$_SESSION['piGllW'][$_SESSION['activelangid']] = array();
			$sessionreseted=false;
		} else {
			if (t3lib_div::_GP('no_cache')==1) {
				$this->doClearCache(true);
			}
		}

		if (($_SESSION['feuserid'] == '')) {
			// init of session var holding fe_userid to integer value
			$_SESSION['feuserid'] = 0;
		}
		//reset of the commentid of the last comment preview
		$_SESSION['lastpreviewid']=0;

		// we try to show the anchor only once, here we go
		if ($_GET['toctoc_comments_pi1']['anchor']) {
			if (!$_SESSION['findanchorok'] == '1') {
				$_SESSION['findanchor'] = '1';
			} else {
				$_SESSION['findanchor'] = '0';
			}
		}
		 /*
		 * Lets build a where-condition for a query which gets the sequence of the contentelements (CEs)
		 * Here  we only consider CEs from one Column. (UseMainColPos)
		 * This is because we have only one template per page, not per column.
		 * In the "real life" it is very rare that comments are placed in different columns of a webpage, they are normally in the
		 * MainContent-Area.
		 */
		if ($this->showsdebugprint==true) {
			$starttimeTYPO3metamodel=microtime(true);
			$endtimeTYPO3metamodeltemplavoila=0;
			$endtimeTYPO3metamodelinternal=0;
			$endtimehookaccess=0;
			$endtimesetcommentListRecord=0;
			$endtimecommentsupdate=0;

		}
		$wherecid = 'uid = ' . strval($GLOBALS['TSFE']->id) . '';

		if (is_null(($this->conf['advanced.']['UseMainColPos']))) {
			$this->conf['advanced.']['UseMainColPos']= 0;
		}
		if (trim($this->conf['advanced.']['UseMainColPos'])=='') {
			$this->conf['advanced.']['UseMainColPos']= 0;
		}
		if (intval($this->conf['advanced.']['UseMainColPos'])<0) {
			$this->conf['advanced.']['UseMainColPos']= 0;
		}

		$langcond = ' AND (sys_language_uid= -1 OR sys_language_uid= 0 OR sys_language_uid=' . intval($_SESSION['activelangid']) . ')';
		$wherettcontentNoTV = " (colPos = " . $this->conf['advanced.']['UseMainColPos']  . $langcond . " AND CType = 'list' AND deleted=0 AND hidden=0 AND list_type = 'toctoc_comments_pi1') " ;
		$ttcontentsortNoTV = 'sorting';

		// Check if TS template was included
		if (!isset($conf['advanced.'])) {
			// TS template is not included
			return '<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.ts.template', false)) . '</p></div>';
		}

		// Initialize
		if ($this->showsdebugprint==true) {
			$starttimeinit=microtime(true);
		}
		if (str_replace('koogle','',$this->conf['theme.']['selectedBoxmodel'] ) !=$this->conf['theme.']['selectedBoxmodel']) {
			$this->conf['theme.']['selectedBoxmodelkoogled']=1;
		}
		$retCCcheckloc= $this->checkCSSLoc();
		if ($this->showsdebugprint==true) {
			$tdifftimeCSSLoc=round(1000*(microtime(true)-$starttimeinit),1);
		}
		if ($this->showsdebugprint==true) {
			$starttimeinit=microtime(true);
		}
		$communitydisplaylist = $this->init($retCCcheckloc);
		if ($this->conf['additionalClearCachePagesLocal'] != '') {
			$arraddpgTS=explode(',',$this->conf['additionalClearCachePagesLocal'] );
			$arraddpg=explode(',',$this->conf['additionalClearCachePages'] );
			$arraddpgout=array_merge($arraddpg,$arraddpgTS);
			$arraddpgout=array_unique($arraddpgout);
			$this->conf['additionalClearCachePages']=implode(',',$arraddpgout);
		}
		if ($this->showsdebugprint==true) {
			$endtimeinit=microtime(true);
		}

		if ($communitydisplaylist==false) {
			return '';
		}

		if (!$this->foreignTableName) {
			return sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->lib->pi_getLLWrap($this, 'error.undefined.foreign.table', false)  . '</p></div>', $this->prefixId, $this->conf['externalPrefix']);
		}
		if ($_SESSION['commentListCount']==0) {
			// do this only at the start of the session, the vars are then kept in seession vars
			// to optimize DB-IOs

			if (t3lib_extMgm::isLoaded('templavoila')) {
				if ($this->showsdebugprint==true) {
					$starttimeTYPO3metamodeltemplavoila=microtime(true);
				}
				// no sorting in tt_content needed for TV CIDs
				// Templavoila stores the sequence of its CID in the Flexform XML on table 'pages'
				$rowscidflex = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, tx_templavoila_flex',
						'pages', $wherecid);

				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($rowscidflex)) {
					$flexData = t3lib_div::xml2array($row['tx_templavoila_flex']);
				}
				if ($this->conf['advanced.']['UseTemplavoilaField'] == '') {
					// If the option is not set
					$this->conf['advanced.']['UseTemplavoilaField'] = $this->templavoila_field;
				}
				if (is_array($flexData)) {
					$rowscidflex = t3lib_div::trimExplode(',',$flexData['data']['sDEF']['lDEF'][$this->conf['advanced.']['UseTemplavoilaField']]['vDEF']);
					$rowscidflexstr = implode(',', $rowscidflex);
					$wherettcontentNoTV .= 'AND uid IN (' . $rowscidflexstr .')';
				}
				else
				{
					$rowscidflex =$flexData;
					$wherettcontentNoTV .=  'AND pid = ' . strval($GLOBALS['TSFE']->id);
				}
				/*
				 * Reihenfolge der TempaVoila-ContentElemente: zb 89,45,23
				 * in this sequence the TV-CIDs will be on the page
				 *
				 * Later we make a cross check of the CIDs of this list with the
				 * (unsorted) list of CIDs coming from tt_content
				 * templavoila does not care about the sorting attribute in tt_content
				 *
				 * ok now templaviola DS Nr (x, y, ...) with TS-injection of Comments-Plugins are needed
				*
				*/

				$wherecidds = "dataprot LIKE '%< plugin.tx_toctoccomments_pi1%'";
				$rowsttcntcidflexds = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'uid',
						'tx_templavoila_datastructure',
						$wherecidds
						#'',
				#'',
						#''
				);
				$tv_comments_cidstrds='(';
				if (array_key_exists(0, $rowsttcntcidflexds) && array_key_exists('uid', $rowsttcntcidflexds[0])) {
					foreach ($rowsttcntcidflexds as $rowds) {
					$tv_comments_cidstrds= $tv_comments_cidstrds . $rowds['uid'] . ',' ;
					}
				} else {
					$tv_comments_cidstrds='(0,';
				}
				$tv_comments_cidstrds= $tv_comments_cidstrds . '0)' ;
				// the list of DS with injected comments TS is here


				$templavoilads=' AND tx_templavoila_ds IN ' . $tv_comments_cidstrds;

				// Now we need also "normal" TV-ContentObjecs
				$wherettcontent = "((CType = 'templavoila_pi1' " . $langcond . " AND deleted=0 AND hidden=0 AND pid = " . strval($GLOBALS['TSFE']->id) . $templavoilads. ')' . ' OR ' . $wherettcontentNoTV . ')';

				// Here the DS with plugin instances, but no tt_content should be identified as
				// Tempavoila-non-content-objects.
				// It can be for example a TS only Onject in TV witch is not part of a FCE, but of a maintemplate
				// these Plugin instances are not attached to tt_content but to page_templavoila_ds_id_ds_element_id from <field_menupageactions type="array"> dataprot
				// its attached to page_ds_id_index_field where index is the index of the field in <el type="array"> of dataprot

				// Now the sequence how the page is built is held by the sequence of the TV-rendering.
				// It's field by field of dataprot
				// So this influences the list of plugins which will be nelarged by the Non-Content TV-Objects before or after the
				// field for $this->conf['advanced.']['UseTemplavoilaField'], where we'll find the contents.

				// array $tvononcontentobjects
				// select and compare logic with the $this->conf['advanced.']['UseTemplavoilaField']
				// id building and ref-keys
				// when rendering the plugins which come are checked against the list of the expected plugins.
				// here we hook inside TV and attach them as 'normal' record-comments for recored type Page-ID->TypeTVNonCOntent->Index-of-TV-Field.
				if ($this->showsdebugprint==true) {
					$endtimeTYPO3metamodeltemplavoila=microtime(true);
				}
			} else {
				// simply sorted by sorting and its ok
				$wherettcontentNoTV .=  'AND pid = ' . strval($GLOBALS['TSFE']->id);
				$wherettcontent = $wherettcontentNoTV;
			}

			if ($this->showsdebugprint==true) {
					$starttimeTYPO3metamodelinternal=microtime(true);
			}
			$rowsttcntcidflex = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'uid,pid,t3_origuid,sys_language_uid',
					'tt_content',
					$wherettcontent,
					$ttcontentsortNoTV
					#'',
					#''
			);

			$tv_comments_cidstr='';
			$tv_comments_meta=array();
			if (array_key_exists(0, $rowsttcntcidflex) && array_key_exists('uid', $rowsttcntcidflex[0])) {
				foreach ($rowsttcntcidflex as $row) {
					$tv_comments_cidstr= $tv_comments_cidstr . $row['uid'] . ',' ;
					$virginLastcid=$row['uid'];
					$tv_comments_meta['c' . $row['t3_origuid']]['parent']=$row['uid'];
					$tv_comments_meta['c' . $row['t3_origuid']]['langid']=$row['sys_language_uid'];
				}
			}
			$tv_comments_cidstr= $tv_comments_cidstr . '' ;
			$tv_comments_cid = explode(',', $tv_comments_cidstr);
			unset($tv_comments_cid[count($tv_comments_cid)-1]);
			if (!t3lib_extMgm::isLoaded('templavoila')) {
				$rowscidflex= $tv_comments_cid;
			}
			$_SESSION['rowscidflex']=$rowscidflex;
			$tv_comments_cidout=array();
			$j=0;
			$tv_comments_metakeys=array_keys($tv_comments_meta);
			for ($m=0;$m<count($tv_comments_cid);$m++) {

				$dodrop=false;
				for ($n=0;$n<count($tv_comments_metakeys);$n++) {
					if ('c' . $tv_comments_cid[$m] == $tv_comments_metakeys[$n]) {
						if ($tv_comments_meta[$tv_comments_metakeys[$n]]['langid']>0) {

							$dodrop=true;
						}
					}
				}
				if ($dodrop==false) {
					$tv_comments_cidout[$j]=$tv_comments_cid[$m];
					$j++;
				}
			}
			$_SESSION['tv_comments_cid']=$tv_comments_cidout;
			$_SESSION['tv_comments_meta']=$tv_comments_meta ;
			if ($this->showsdebugprint==true) {
				$endtimeTYPO3metamodelinternal=microtime(true);
			}
		}
		$cid_hook=0;
		if ($this->lhookTablePrefix !='') {
			//if the plugin is called from tt_news-hook we add insert new records in the plugins-list arrays.
			// the records get a artificial id: tt_content_100000 + newid
			if ($this->showsdebugprint==true) {
				$starttimehookaccess=microtime(true);
			}
			if ($this->lhookTablePrefix !='tt_content') {
				$cid_hookpp= 1000 + $GLOBALS['TSFE']->id; // 1023, 1123, 2223
				$cid_hookpp= $cid_hookpp . $this->conf['storagePid'] ;
				$cid_hook= intval($cid_hookpp . $hookId);
			} else	{
				$cid_hook=$this->lhookId;
			}
			if ($isPlugin==0) {
				$cidwrk=array();

				for ($i=0;$i<$_SESSION['indexOfSortedCommentsCidList'];$i++) {
					if ($_SESSION['rowscidflex'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['rowscidflex'][$i];
					}
				}
				$ji=$i;
				$cidwrk[$i]=$cid_hook;
				for ($i=$ji+1;$i<=count($_SESSION['rowscidflex']);$i++) {
					if ($_SESSION['rowscidflex'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['rowscidflex'][$i-1];
					}
				}

				ksort($cidwrk);
				$_SESSION['rowscidflex']=$cidwrk;

				$cidwrk=array();
				for ($i=0;$i<$_SESSION['indexOfSortedCommentsCidList'];$i++) {
					if ($_SESSION['tv_comments_cid'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['tv_comments_cid'][$i];
					}
				}
				$ji=$i;
				$cidwrk[$i]=$cid_hook;
				for ($i=$ji+1;$i<=count($_SESSION['tv_comments_cid']);$i++) {
					if ($_SESSION['tv_comments_cid'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['tv_comments_cid'][$i-1];
					}
				}
				ksort($cidwrk);
				$_SESSION['tv_comments_cid']=$cidwrk;
				$incrementlistcid=1;
			} else {
				$incrementlistcid=1;
			}
			if ($this->showsdebugprint==true) {
				$endtimehookaccess=microtime(true);
			}

		} else {
			$incrementlistcid=1;
		}
		if ($this->showsdebugprint==true) {
			$starttimesetcommentListRecord=microtime(true);
		}
		$wrki=0;
		$commentlistcountout=0;
		$lastindexOfSortedCommentsCidList = $_SESSION['indexOfSortedCommentsCidList'];

		/* The sorted Array $rowscidflex (CIDs of all TemplaVoila Objects) gets filtered by
		 * the list of objects containing plugins (Array $tv_comments_cid)
		 * and $_SESSION['indexOfSortedCommentsCidList'], the work-index for $rowscidflex, is set
		 */

		$wrkrowscidflex = $_SESSION['rowscidflex'];
		$wrktv_comments_cid = $_SESSION['tv_comments_cid'];
		$tv_comments_meta = $_SESSION['tv_comments_meta'];
		$errornocidfound=false;
		$debugnocidfoundtext='';
		while ($wrki==0) {
			$lidx=$_SESSION['indexOfSortedCommentsCidList'];
			foreach ($wrktv_comments_cid as $searchrow) {
				if (count($tv_comments_meta)>0) {
					if ($tv_comments_meta['c' . $wrkrowscidflex[$lidx]]['langid']>0) {
						$searchedwrktv_comments_cid=$tv_comments_meta['c' . $wrkrowscidflex[$lidx]]['parent'];

					}else {
						$searchedwrktv_comments_cid=$wrkrowscidflex[$lidx];
					}
				} else {
					$searchedwrktv_comments_cid=$wrkrowscidflex[$lidx];
				}

				if ($searchrow==$searchedwrktv_comments_cid) {
					//found the bugger
					$wrki=1;
					if ($this->conf['advanced.']['useMultilingual'] == 1) {
						$commentlistcountout = $searchedwrktv_comments_cid;
					} else{
						$commentlistcountout = $wrkrowscidflex[$lidx];
					}
					if ($optionalRecordIdlhookTablePrefix!='') {
						// overwrite content_element_id found with optionalRecordID
						$commentlistcountout = $optionalRecordIdlhookId;
					}
				}
			}
			$_SESSION['indexOfSortedCommentsCidList']=$_SESSION['indexOfSortedCommentsCidList'] +$incrementlistcid;
			if ($_SESSION['indexOfSortedCommentsCidList']>count($wrkrowscidflex)) {
				$wrki=1;
				if ($optionalRecordIdlhookTablePrefix!='') {
					// force content_element_id found with optionalRecordID
					$commentlistcountout = $optionalRecordIdlhookId;
				} else {
					// no optionalRecordID given, no element found, aborting to error message
					$errornocidfound=true;
					if ($this->showsdebugprint==true) {
						$debugnocidfoundtext='<br><br><b>Additionalinfo:</b><br>wrkrowscidflex: ' . json_encode($wrkrowscidflex) . '<br>wrktv_comments_cid: '  . json_encode($wrktv_comments_cid) . '<br>tv_comments_meta: '  .json_encode($tv_comments_meta);
					}
					$commentlistcountout = 99;
				}
				$_SESSION['indexOfSortedCommentsCidList']=$lastindexOfSortedCommentsCidList;
			}
		}

		/*
		 * Here is the CID of the Comment-Plugin that is currently being rendered.
		 */
		$_SESSION['commentListCount']=$commentlistcountout;

		if (intval($this->conf['pluginmode'])==0) {

			if (($this->lhookTablePrefix !='') && ($isPlugin==1)) {
				$_SESSION['commentListCount']=$cid_hook;
				$_SESSION['commentListRecord']='tt_content_' . $_SESSION['commentListCount'];
			}

			if (($this->lhookTablePrefix == '') && ($this->conf['externalPrefix'] == 'pages')) {
				$_SESSION['commentListRecord']='tt_content_' . $_SESSION['commentListCount'];
			}

			if (($this->lhookTablePrefix == '') && ($errornocidfound==true) && (intval($this->conf['pluginmode'])==0)) {
				// The Contentelement ID containing the plugin could not be found automatically.
				$edatum = date("d.m.Y",time());
				$euhrzeit = date("H:i",time());
				$echodate = $edatum . ' - '. $euhrzeit;
				return sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $echodate . '<br />' . $this->lib->pi_getLLWrap($this, 'error.automaticcidfail', false)  . '</p></div>', $this->conf['advanced.']['UseMainColPos'], $this->conf['advanced.']['UseTemplavoilaField']) . $debugnocidfoundtext;
			}

			if ($_SESSION['commentsSorting'] != $this->conf['advanced.']['reverseSorting']) {
				// clear the sort array of the cid
				$_SESSION['commentsSorting'] = $this->conf['advanced.']['reverseSorting'];
				unset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]);
			}
			if ($this->showsdebugprint==true) {
				$endtimesetcommentListRecord=microtime(true);
			}
			// the viginity-checks for freshly updated 1.5.4. versions of comments
			if  ($this->extConf['updateMode']) {
				if ($this->showsdebugprint==true) {
					$starttimecommentsupdate=microtime(true);
				}
				// means only one toctoc_comments-plugin is on the page - this is needed in
				// order to assign 1 old plugin to one new plugin (cannot distribute...)
				$wherevcomments = '';
				// ckeck tables for existance
				$checktxcomments=false;
				$checktxratings=false;
				$checkveguestbook=false;
				$tables = $GLOBALS['TYPO3_DB']->admin_get_tables();
				if (array_key_exists('tx_comments_comments', $tables)) {
					if ($tables['tx_comments_comments']['Rows'] > 0) {
						$checktxcomments=true;
					}
				}
				if (array_key_exists('tx_ratings_data', $tables)) {
					if ($tables['tx_ratings_data']['Rows'] > 0) {
						$checktxratings=true;
					}
				}
				if (array_key_exists('tx_veguestbook', $tables)) {
					if ($tables['tx_veguestbook']['Rows'] > 0) {
						$checkveguestbook=true;
					}
				}
				if ($checktxcomments) {
					$idmatchtable= array();
					$tmpwhere = 'approved=1 AND ' . $this->where_dpck;

					$rowstest = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
							'tx_toctoc_comments_comments', $tmpwhere);

					if (count($rowstest)==0) {
						$tmprep='AND pid=' . $this->conf['storagePid'];
						$tmpwhere = str_replace($tmprep,'',$tmpwhere);
						$tmpwhere = str_replace('AND pid IN (' . $this->conf['storagePid'] . ')' ,'',$tmpwhere);
						$tmpwhere = str_replace('tx_toctoc_comments_comments','tx_comments_comments',$tmpwhere);
						$tmpsorting = 'crdate';

						$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
								'tx_comments_comments', $tmpwhere,$tmpsorting);
						foreach ($rows as $row) {
							$record = array(
									'crdate' => $row['crdate'],
									'tstamp' => $row['tstamp'],
									'pid' => $this->conf['storagePid'],
									'deleted' => $row['deleted'],
									'hidden' => $row['hidden'],
									'approved' => $row['approved'],
									'external_ref' => $row['external_ref'],
									'external_prefix' => $row['external_prefix'],
									'firstname' => $row['firstname'],
									'lastname' => $row['lastname'],
									'email' => $row['email'],
									'location' => $row['location'],
									'homepage' => $row['homepage'],
									'content' => $row['content'],
									'double_post_check' => $row['double_post_check'],
									'remote_addr' => $row['remote_addr'],
							);
							if ($row['external_ref_uid']) {
								$record['external_ref_uid'] = $row['external_ref_uid'];
							} else {
								$record['external_ref_uid'] = 'tt_content_' . $_SESSION['commentListCount'];
							}
							$feuserid=0;
							if ($row['tx_commentsfeuser_feuser']) {
								$feuserid= $row['tx_commentsfeuser_feuser'];
							}
							$record['toctoc_commentsfeuser_feuser'] = $feuserid;
							$strCurrentIP=$row['remote_addr'];
							if (intval($feuserid)===0) {
								$fetoctocusertoquery ='"' . $strCurrentIP . '.0"';
								$fetoctocusertoinsert ='' . $strCurrentIP . '.0';
							} else {
								$fetoctocusertoquery ='"0.0.0.0.' . $feuserid . '"';
								$fetoctocusertoinsert ='0.0.0.0.' . $feuserid;
							}
							$olduid=$row['uid'];
							$record['toctoc_comments_user'] = $fetoctocusertoinsert;

							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_comments', $record);
							$newuid=$GLOBALS['TYPO3_DB']->sql_insert_id();
							$idmatchtable[$olduid]=$newuid;

							// check the toctoc_comments_user
							$dataWhereuser = 'pid=' . $row['pid'] .
							' AND toctoc_comments_user = ' . $fetoctocusertoquery . '';
							list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr',
									'tx_toctoc_comments_user', $dataWhereuser);

							if (intval($rowusr['tusr']) === 0) {
								$strCurrentIPres=gethostbyaddr($strCurrentIP);
								$record= array(
										'crdate' => $row['crdate'],
										'tstamp' => $row['tstamp'],
										'pid' => $this->conf['storagePid'],
										'toctoc_comments_user' => $fetoctocusertoinsert,
										'ipresolved' => trim($strCurrentIPres),
										'ip' => $strCurrentIP,
										'initial_firstname' => $row['firstname'],
										'initial_lastname' => trim($row['lastname']),
										'initial_email' => trim($row['email']),
										'initial_homepage' => trim($row['homepage']),
										'initial_location' => trim($row['location']),
								);

								$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user',$record);
							}

							$dataWhereStats = 'pid=' . intval($this->conf['storagePid']) .
							' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';

							$sqlstr = 'SELECT COUNT(uid) AS nbrentries FROM tx_toctoc_comments_comments WHERE ' . $dataWhereStats;
							$resultcount = $GLOBALS['TYPO3_DB']->sql_query($sqlstr);
							$rowStats = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultcount);

							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' .
									'comment_count=' . intval($rowStats['nbrentries']) .
									', current_ip="' . $strCurrentIP .
									'", current_firstname="' . trim($row['firstname']) .
									'", current_lastname="' . trim($row['lastname']) .
									'", current_email="' . trim($row['email']) .
									'", current_homepage="' . trim($row['homepage']) .
									'", current_location="' . trim($row['location']) .
									'", tstamp_lastupdate=' . $row['tstamp']  .
									' WHERE ' . $dataWhereStats );

						}
					}
				}

				if (($checktxratings) && ($checktxcomments)) {
					if (version_compare(TYPO3_version, '4.6', '<')) {
						$tmpint = t3lib_div::testInt($this->conf['storagePid']);
					} else {
						$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['storagePid']);
					}
					$tmpwhere = '';

					$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
							'tx_ratings_data', $tmpwhere);

					foreach ($rows as $row) {
						$commentsuid=trim(substr($row['reference'],21,30));
						if (version_compare(TYPO3_version, '4.6', '<')) {
							$tmpint = t3lib_div::testInt($commentsuid);
						} else {
							$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($commentsuid);
						}
						if ($tmpint) {
							$commentsuid=intval($commentsuid);
						} else{
							$commentsuid= 0;
						}
						if ($idmatchtable[$commentsuid]!=0) {
							$record = array(
									'crdate' => $row['crdate'],
									'tstamp' => $row['tstamp'],
									'pid' => $this->conf['storagePid'],
									'reference' => 'tx_toctoc_comments_comments_' . $idmatchtable[$commentsuid],
									'vote_count' => $row['vote_count'],
									'rating' => $row['rating'],
							);
							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_ratings_data', $record);
						}
					}
				}
				if ($this->showsdebugprint==true) {
					$endtimecommentsupdate=microtime(true);
				}
			}
		}
		if ($this->showsdebugprint==true) {
			$starttimesetJSCSS=microtime(true);
		}
		$content = '';
		$this->checkJSLoc();
		$ckeckresult=$this->checkCSSTheme();
		$this->check_scopes();
		if ($ckeckresult!='') {
			return $ckeckresult;
		}
		$_SESSION['renderedplugins']++;
		if ($_SESSION['renderedplugins']>=count($_SESSION['tv_comments_cid'])) {
			$_SESSION['renderingdone']=true;
			if ((($this->lhookTablePrefix!='') && ($this->lhookId!=0))==false) {
			$this->sdebugprint .= 'Finishing rendering '. count($_SESSION['tv_comments_cid']). ' plugins from internal list<br />';
			}

		}
		if ($this->showsdebugprint==true) {
			$endtimesetJSCSS=microtime(true);
		}
		$domemcache = false;
		$_SESSION['recentcommentsclearcachepage']=0;

		if (intval($this->conf['pluginmode'])<3) {
			unset($this->conf['topRatings']);
			unset($this->conf['topRatingsrestrictToExternalPrefix']);
			unset($this->conf['topRatingsExternalPrefix']);
			unset($this->conf['topRatingsDays']);
			unset($this->conf['topratingslistCount']);
			unset($this->conf['topRatingsNumberOfVotesRequired']);
			unset($this->conf['topratingsimagesize']);
			unset($this->conf['topratingsnumberwidth']);
			unset($this->conf['topRatingsOriginalLangDisplay']);
			unset($this->conf['topRatingsTextCropLength']);
			unset($this->conf['topRatingsAlignResultsWithMaxVotesAndAvgVote']);
			unset($this->conf['topRatings.']);

		} else {
			// sanity tests
			if ($this->conf['topRatings.']['RatingsDays'] < 1) {
				$this->conf['topRatings.']['RatingsDays'] = 1;
			}
			if ($this->conf['topRatings.']['RatedItemsListCount'] < 1) {
				$this->conf['topRatings.']['RatedItemsListCount'] = 1;
			}
			if ($this->conf['topRatings.']['NumberOfVotesRequired'] < 1) {
				$this->conf['topRatings.']['NumberOfVotesRequired'] = 1;
			}
			if ($this->conf['topRatings.']['topratingsimagesize'] < 10) {
				$this->conf['topRatings.']['topratingsimagesize'] = 10;
			}
			if ($this->conf['topRatings.']['topratingsimagesize'] > 120) {
				$this->conf['topRatings.']['topratingsimagesize'] = 120;
			}
			if ($this->conf['topRatings.']['topratingsnumberwidth'] < 5) {
				$this->conf['topRatings.']['topratingsnumberwidth'] = 5;
			}
			if ($this->conf['topRatings.']['topratingsnumberwidth'] > 50) {
				$this->conf['topRatings.']['topratingsnumberwidth'] = 50;
			}
			if ($this->conf['topRatings.']['TextCropLength'] < 5) {
				$this->conf['topRatings.']['TextCropLength'] = 5;
			}
			if ($this->conf['topRatings.']['TextCropLength'] > 250) {
				$this->conf['topRatings.']['TextCropLength'] = 250;
			}
		}

		if (intval($this->conf['pluginmode'])==0) {
			if ($this->getLastUserAdditionTstamp() > intval($_SESSION['AJAXimagesTimeStamp'])) {
				// if exeptionally a new user has been added since the last caching time, then the user pics need an update
				$_SESSION['AJAXimages']=array();
			}
			if (isset($_GET['toctoc_comments_pi1']['anchor'])) {
				$clearCacheIds = $GLOBALS['TSFE']->id;
				$_SESSION['recentcommentsclearcachepage']=$GLOBALS['TSFE']->id;
				if ($_SESSION['findanchor'] != '0') {
					$this->pi_USER_INT_obj = 1;
					$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=2;
					$_SESSION['reemptycachepage']['p' . $GLOBALS['TSFE']->id]=$GLOBALS['TSFE']->id;
					$_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]=$_SESSION['commentListRecord'];
					$this->sdebugprint .= 'Will display recent comment on page ' . $GLOBALS['TSFE']->id . '<br>';
					$_SESSION['runMemCache'] = false;
				} else {
					$_SESSION['runMemCache'] = true;
					$this->sdebugprint .= 'Show cache (recent comments mode) for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br>';
					if ($_SESSION['runMemCache'] == true) {
						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = true;
							$this->sdebugprint .= 'Try using Cache<br>';
						} else {
							$this->sdebugprint .= 'Caching is disabled<br>';
						}
					}
				}
			} else {
				if ($_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]>=2) {
					$_SESSION['runMemCache'] = false;
					if ($_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]==$_SESSION['commentListRecord']) {
						$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=3;
						$this->ttclearcache($_SESSION['reemptycachepage']['p' . $GLOBALS['TSFE']->id],true, true,'reemptycachepage');
						$this->sdebugprint .= 'Reempty cache on page ' . $GLOBALS['TSFE']->id . ' on "reemptycacheplugin" ' . $_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id] . '<br>';
						$this->pi_USER_INT_obj = 1;
					} else {

						if ($_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]==3) {
							$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=0;
							$_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]='';
							$_SESSION['reemptycachepage']['p' . $GLOBALS['TSFE']->id]='';

						}
						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = true;
							$_SESSION['runMemCache'] = true;
							if ((intval($this->conf['advanced.']['wallExtension']) == 0) && (intval(t3lib_div::_GP('no_cache')==0))) {
								if ($_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]=='') {
									$this->sdebugprint .= 'Try using cache (reseted recent comments mode), on ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br>';
								} else {
									$this->sdebugprint .= 'Try using cache (reseted recent comments mode), waiting for ' . $_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id] . ' on ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br>';
								}
							}
						} else {
							$this->sdebugprint .= 'Caching is disabled<br>';
						}
					}
				} else {
					$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=0;
					if ($_SESSION['runMemCache'] == true) {
						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = true;
							if ((intval($this->conf['advanced.']['wallExtension']) == 0) && (intval(t3lib_div::_GP('no_cache')==0))) {
								$this->sdebugprint .= 'Try using cache for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br>';
							}
						} else {
							$this->sdebugprint .= 'Caching is disabled<br>';
						}
					}
				}
			}
			if (!$this->showsdebugprint) {
				$this->sdebugprint='';
			} else {
				if ($this->sdebugprintuser!=intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$this->sdebugprint='';
				} else {
					$tdiffstartup = round(1000*(microtime(true) - $starttimedebug),1);
					$startupreport='';
					if ($this->showsdebugprintstartuptimes) {
						$tdiffstartupconf = round(1000*($starttimeprefixes - $starttimedebug),1);
						$tdiffstartupprefixes = round(1000*($starttimesessions - $starttimeprefixes),1);
						$tdiffstartupsessions = round(1000*($starttimeTYPO3metamodel - $starttimesessions),1);
						$tdiffstartupTYPO3metamodel = round(1000*($starttimesetJSCSS - $starttimeTYPO3metamodel),1);
						$tdiffstartupinit = round(1000*($endtimeinit - $starttimeinit),1);
						$tdiffstartupTYPO3metamodeltemplavoila=-1;
						if ($endtimeTYPO3metamodeltemplavoila >0) {
							$tdiffstartupTYPO3metamodeltemplavoila = round(1000*($endtimeTYPO3metamodeltemplavoila -$starttimeTYPO3metamodeltemplavoila),1);
						}
						$tdiffstartupTYPO3metamodelinternal=-1;
						if ($endtimeTYPO3metamodelinternal >0) {
							$tdiffstartupTYPO3metamodelinternal = round(1000*($endtimeTYPO3metamodelinternal - $starttimeTYPO3metamodelinternal),1);
						}
						$tdiffstartuphookaccess=-1;
						if ($endtimehookaccess >0) {
							$tdiffstartuphookaccess = round(1000*($endtimehookaccess - $starttimehookaccess),1);
						}
						$tdiffstartuphookcommentsupdate=-1;
						if ($endtimecommentsupdate >0) {
							$tdiffstartupcommentsupdate = round(1000*($endtimecommentsupdate - $starttimecommentsupdate),1);
						}
						$tdiffstartupcommentListRecord=-1;
						if ($endtimesetcommentListRecord >0) {
							$tdiffstartupcommentListRecord = round(1000*($endtimesetcommentListRecord - $starttimesetcommentListRecord),1);
						}
						$tdiffstartupsetJSCSS = round(1000*($endtimesetJSCSS-$starttimesetJSCSS),1);
						$startupreport = '<br><b>Start-up, details</b> (times in ms):<br> Conf: ' . $tdiffstartupconf . ', ' .
								'Prefixes: ' . $tdiffstartupprefixes . ', ' .
								'Sessions: ' . $tdiffstartupsessions . ', ' .
								'TYPO3 Metamodel: ' . $tdiffstartupTYPO3metamodel . ' (' .
								'Check CSSLoc: ' . $tdifftimeCSSLoc . ', ' .
								'Init: ' . $tdiffstartupinit  . $this->sdebuginitprint . ', ';

						if ($tdiffstartupTYPO3metamodeltemplavoila != -1) {
							$startupreport .= 'Templavoila: ' . $tdiffstartupTYPO3metamodeltemplavoila . ', ';
						} else {
							$startupreport .= 'No Templavoila, ';
						}
						if ($tdiffstartupTYPO3metamodelinternal != -1) {
							$startupreport .= 'Internal: ' . $tdiffstartupTYPO3metamodelinternal . ', ' ;
						} else {
							$startupreport .= 'No Internal, ';
						}
						if ($tdiffstartuphookaccess != -1) {
							$startupreport .= 'Hookmode: ' . $tdiffstartuphookaccess . ', ' ;
						} else {
							$startupreport .= 'No Hookmode, ';
						}
						if ($tdiffstartuphookcommentsupdate != -1) {
							$startupreport .= 'Updatemode: ' . $tdiffstartuphookcommentsupdate . ', ' ;
						} else {
							$startupreport .= 'No Updatemode, ';
						}
						if ($tdiffstartupcommentListRecord != -1) {
							$startupreport .= 'Setup PluginID: ' . $tdiffstartupcommentListRecord ;
						} else {
							$startupreport .= 'No Setup PluginID';
						}
						$startupreport .= ') Check JS and theme-CSS: ' . $tdiffstartupsetJSCSS . '<br>';
					}
					$starttimedebuglib=microtime(true);
				}
			}
			$outml = '';
			if ((intval($this->conf['advanced.']['wallExtension']) != 0) || (t3lib_div::_GP('no_cache')==1)) {
				$domemcache = false;
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						if ((intval($this->conf['advanced.']['wallExtension']) == 0)) {
							$this->sdebugprint .= '<b>Cache dropped</b> for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($this->feuserid) .'<br>';
						} else {
							$this->sdebugprint .= '<b>No Cache Access on Wall</b> for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($this->feuserid) .'<br>';
						}
					}
				}
			}
			if ($domemcache == true) {
				if ($this->conf['theme.']['selectedBoxmodel'] != $_SESSION['activeBoxmodel']) {
					$_SESSION['AJAXimages'] = array();
					$domemcache = false;
					$_SESSION['DefaultUserImage'] = array();
					if ($this->showsdebugprint) {
						if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {

							$this->sdebugprint .= '<b>Cache dropped and recacheing</b> (new boxmodel ' . $this->conf['theme.']['selectedBoxmodel'] . ') for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($this->feuserid) .'<br>';
						}
					}
				}
				if ($_SESSION['renderingdone']==true) {
					$_SESSION['activeBoxmodel']=$this->conf['theme.']['selectedBoxmodel'];
				}
			}
			$whynocache='';
			if ($domemcache == true) {

				if (isset($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id])) {
					if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]>0) {
						if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id] > $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
							$outml=	$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id];
						} else {
							if ($this->showsdebugprint) {
								if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
									$this->sdebugprint .= '<b>' . date("H:i:s") . '</b>: Cache dropped, last cachetime ' . date('H:i:s',$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]) . ' older than  ' . date( 'H:i:s',$this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) . ', cid: ' .$_SESSION['commentListRecord'] .'<br>';
									$whynocache='was dropped';
								}
							}



							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';

							$domemcache=false;
							$this->cachedropped=true;
						}
					} else {
						$whynocache='empty';
					}
				} else {
					$whynocache='not set';
					if (intval($this->conf['advanced.']['wallExtension']) != 0) {
						$whynocache .= ', wallextension = ' . $this->conf['advanced.']['wallExtension'];
					}
				}
				if ($outml == '') {
					if ($this->showsdebugprint) {
						if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
							$this->sdebugprint .= '<b>No Cache present</b> (Cache ' . $whynocache . ')<br />';
						}
					}
					$domemcache=false;
				} else {

					if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id] < $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
						if ($this->showsdebugprint) {
							if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
								$this->sdebugprint .= '<b>Cache dropped</b> for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($this->feuserid) .'<br>';
							}
						}
						if ($this->getLastUserAdditionTstamp() > $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]) {
							// if exeptionally a new user has been added since the last caching time, then the user pics need an update
							$_SESSION['AJAXimages']=array();

						}
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';

						$domemcache=false;
					}
				}
			}
			$outmlmemcache='';
			if ($this->showsdebugprint) {
				if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$this->sdebugprint .= '</div>';
				}
			}
			if ($domemcache == false) {
				// access to lib
				$outml=$this->lib->maincomments($this->ref, $this->conf, false, $_SESSION['commentsPageId'], $this->feuserid , 'commentdisplay', $this, $this->piVars);
				$outmlmemcache=$timereportlast . $this->sdebugprint . $outml;
				if (intval($this->conf['advanced.']['wallExtension']) == 0) {
					if ((intval(t3lib_div::_GP('no_cache'))==0) && (!isset($_GET['toctoc_comments_pi1']['anchor']))) {
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=round(microtime(true),0);
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]=$outml;
					} else {
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';
					}
				}
			} else {
				if ($this->showsdebugprint==true) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$outmlmemcache=$timereportlast . $this->sdebugprint . '<div class="tx-tc-debug">' . '<b>Cached result:</b></div>' .  $outml;
					} else {
						$outmlmemcache=$outml;
					}
				} else {
					$outmlmemcache=$outml;
				}
			}
			$this->sdebugprint='';
			if ($this->showsdebugprint) {
				if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$userintstate=" as pi_USER_INT_obj = 0";
					if ($this->pi_USER_INT_obj == 1) {
						$userintstate=" as pi_USER_INT_obj = 1";
					}
					$tdifflib = 1000*(microtime(true) - $starttimedebuglib);
					$tdifftotal = 1000*(microtime(true) - $starttimedebug);
					if (!$this->debugshowuserint) {
						$userintstate='';
					}
					$timereport='<div class="tx-tc-debug">Start-up: ' . round($tdiffstartup,0) .  'ms, Lib: ' . round($tdifflib,0) . 'ms, <b>Total: ' . round($tdifftotal,0) . 'ms</b>' . $userintstate . ' ' . $startupreport.'</div>';
					if($_SESSION['debugprintlib']['debugtext']!=''){
						$_SESSION['debugprintlib']['debugtext'] .= '</div>';
					}
					$outmlmemcache .= $timereport . $_SESSION['debugprintlib']['debugtext'];
				}
			}
			$_SESSION['edgeTime'] = microtime(true);
			return $outmlmemcache;

		} elseif ($this->conf['pluginmode'] == 1) {
			$this->pi_USER_INT_obj = 1;
			if (!$this->showsdebugprint) {
				$timereportlast='';
			} elseif ($this->sdebugprintuser!=intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$timereportlast='';
			}
			$timereport='';
			$starttimedebuglib=microtime(true);
			$outml=$timereportlast .$this->lib->getRecentComments($this, $this->conf,$this->feuserid);
			if ($this->showsdebugprint) {
				if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {

					$userintstate=" as USER-object";
					if ($this->pi_USER_INT_obj == 1) {
						$userintstate=" as USER_INT-object";
					}
					$tdifflib = 1000*(microtime(true) - $starttimedebuglib);
					$tdifftotal = 1000*(microtime(true) - $starttimedebug);
					if (!$this->debugshowuserint) {
						$userintstate='';
					}
					$timereport='<div class="tx-tc-debug">Start-up: ' . round($tdiffstartup,0) .  'ms, Lib: ' . round($tdifflib,0) . 'ms, <b>Total: ' . round($tdifftotal,0) . 'ms</b>' . $userintstate . ' ' . $startupreport.'</div>';

				}
			}
			$_SESSION['edgeTime'] = microtime(true);
			return $outml . $timereport;

		} elseif ($this->conf['pluginmode'] == 2) {
			$content='';
			$this->pi_setPiVarDefaults();
			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(true);
			return $this->lib->mainReport($content, $this->conf, $this,$this->piVars);

		} elseif (($this->conf['pluginmode'] == 3) || ($this->conf['pluginmode'] == 4)) {

			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(true);
			return $this->lib->showtopRatings($this->conf, $this);

		} else {
			return '';
		}
	}

	/**
	 * Checks if the JS-File for localized strings exists and if not creates it.
	 *
	 * @return	void
	 */
	protected function checkJSLoc() {
		if (!$this->processcssandjsfiles) {
			return '';
		}
		$filenamejs='tx-tc-' . $_SESSION['activelang']  . '.js';
		if ($this->conf['theme.']['selectedBoxmodel'] !='') {
			$filenamejs='tx-tc-' . str_replace('.txt','-',$this->conf['theme.']['selectedBoxmodel']) . $_SESSION['activelang']  . '.js';
		}

		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

		$txdirname= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/' );
		$filenamejs=$txdirname . $filenamejs;

		$unlinked=false;
		$jscontent = '';

		$strtexterrorlength = sprintf($this->lib->pi_getLLWrap($this, 'pi1_template.texterrorlength',false), $this->conf['minCommentLength']);
		$jscontent .= 'var textErrCommentLength = "' . base64_encode($strtexterrorlength) . '";' . "\n";
		$jscontent .= 'var errCommentRequiredLength = ' . intval($this->conf['minCommentLength']) . ';' . "\n";
		$jscontent .= 'var maxCommentLength = ' . intval($this->conf['maxCommentLength']) . ';' . "\n";
		$jscontent .= 'var textErrCommentNull = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.texterrornull', false)) . '";' . "\n";
		$jscontent .= 'var textSaveComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.savecomment', false)) . '";' . "\n";
		$jscontent .= 'var textCancelEditComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.canceleditcomment', false)) . '";' . "\n";
		$jscontent .= 'var textEditComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.editlink', false)) . '";' . "\n";
		$jscontent .= 'var textAddemoji = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.add_emoji', false)) . '";' . "\n";
		$jscontent .= 'var textCloseemoji = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.close_emoji', false)) . '";' . "\n";
		$jscontent .= 'var confuserpicsize = ' . intval($this->conf['UserImageSize']) . ';' . "\n";
		$jscontent .= 'var boxmodelTextareaAreaTotalHeight = ' . intval($this->boxmodelTextareaAreaTotalHeight) . ';' . "\n";
		$jscontent .= 'var boxmodelTextareaHeight = ' . intval($this->boxmodelTextareaHeight) . ';' . "\n";
		$jscontent .= 'var boxmodelLabelWidth = ' . intval($this->conf['theme.']['boxmodelLabelWidth']) . ';' . "\n";
		$jscontent .= 'var boxmodelSpacing	 = ' . intval($this->conf['theme.']['boxmodelSpacing']) . ';' . "\n";
		$jscontent .= 'var confcommentsPerPage = ' . intval($this->conf['advanced.']['commentsPerPage']) . ';' . "\n";
		$jscontent .= 'var confuseEmoji = ' . intval($this->conf['advanced.']['useEmoji']) . ';' . "\n";
		$jscontent .= 'var textLoading = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.loadingpreview', false)) . '";' . "\n";
		$jscontent .= 'var textDeleteConfirm = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.deletecommentconfirm', false)) . '";' . "\n";
		$jscontent .= 'var textDgClose = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.dialogboxclose', false)) . '";' . "\n";
		$jscontent .= 'var textPicFileToBig = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imageuploadfiletobig', false)) . '";' . "\n";
		$jscontent .= 'var textPdfFileToBig = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.pdfuploadfiletobig', false)) . '";' . "\n";
		$jscontent .= 'var textPicFiletypeErr = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imageuploadfiletypeerror', false)) . '";' . "\n";
		$jscontent .= 'var textpdfFiletypeErr = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imageuploadfiletypeerrorpdf', false)) . '";' . "\n";
		$jscontent .= 'var picUploadMaxfilesize = ' . 1024*intval($this->conf['attachments.']['picUploadMaxfilesize']) . ';' . "\n";
		$jscontent .= 'var pdfUploadMaxfilesize = ' . 1024*intval($this->conf['attachments.']['pdfUploadMaxfilesize']) . ';' . "\n";
		$jscontent .= 'var textpdfdescribe = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.pdfdescribe', false)) . '";' . "\n";
		$jscontent .= 'var textimagedescribe = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imagedescribe', false)) . '";' . "\n";
		$jscontent .= 'var textclosepdfupload = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.closepdfupload', false)) . '";' . "\n";
		$jscontent .= 'var textclosepicupload = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.closeimageupload', false)) . '";' . "\n";
		$jscontent .= 'var pathim = "' . base64_encode($GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path']) . '";' . "\n";
		$jscontent .= 'var textmessagecannotdelete = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmessagecannotdelete', false)) . '";' . "\n";
		$jscontent .= 'var textmessagecannotinsert = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmessagecannotinsert', false)) . '";' . "\n";
		$jscontent .= 'var selectedTheme = "' . $this->conf['theme.']['selectedTheme'] . '";' . "\n";
		$jscontent .= 'var configbaseURL = "' .  base64_encode($this->locationHeaderUrlsubDir())  . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvseconds = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.seconds', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvsecond = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.second', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvminutes = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.minutes', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvminute = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.minute', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvhours = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.hours', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvhour = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.hour', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvdays = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.days', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvday = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.day', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvweeks = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.weeks', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvweek = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.week', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvmonths = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.months', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvmonth = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.month', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvyears = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.years', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvyear = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.year', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvtextafter = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.textafter', false)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvtextbefore = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.textbefore', false)) . '";' . "\n";

		if (file_exists($filenamejs)) {
			$content = file_get_contents($filenamejs);
			if ($content != $jscontent) {
				$unlinked=true;
			}
		}

		if ((!file_exists($filenamejs)) || ($unlinked==true)) {
			// Write the contents back to the file
			file_put_contents($filenamejs, $jscontent);
		}
	}
	/**
	 * Checks if the CSS-File for the theme exists and if not creates it.
	 *
	 * @return	string		empty if all ok, else error message
	 */
	protected function checkCSSTheme() {

			$filenametheme='theme.txt';

			$dirsep=DIRECTORY_SEPARATOR;

			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

			$txdirnametheme= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $this->conf['theme.']['selectedTheme'] . '/' );
			$filenametheme=$txdirnametheme . $filenametheme;

			$filenamecssfile='tx-tc' . $this->extVersion . '-theme.css';
			$txdirname= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $this->conf['theme.']['selectedTheme'] . '/css/' );
			$filenamecss=$txdirname . $filenamecssfile;
			$this->conf['theme.']['borderColor']='d8d8d8';
			$txdirnamedefault= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/default/css/' );
			$filenamedefaultcss=$txdirnamedefault . $filenamecssfile;
			if (strlen($this->conf['theme.']['themeFontFamily']) < 4) {
				$this->conf['theme.']['themeFontFamily']='Arial, Helvetica, sans serif';
			}
			$printstr='';
			if (file_exists($filenamecss)) {
				$content = file_get_contents($filenamecss);
				if (file_exists($filenametheme)) {
					$contenttheme = file_get_contents($filenametheme);
					if (file_exists($filenamedefaultcss)) {
						$contentdefaultcss = file_get_contents($filenamedefaultcss);

						$contentthemearr = explode(':',$contenttheme);
						for ($i=1;$i<count($contentthemearr);$i++) {
							$contentthemecolormatch= trim($contentthemearr[$i]);
							$contentthemecolormatcharr=explode("\n",$contentthemecolormatch);
							$contentthemecolormatch = $contentthemecolormatcharr[0];
							$printstr.= $contentthemecolormatch .'<br>';
							$contentthemecolormatcharr=explode(' ',$contentthemecolormatch);
							if (count($contentthemecolormatcharr)==2) {
								if (trim($contentthemecolormatcharr[1])=='d8d8d8') {
									$this->conf['theme.']['borderColor']=trim($contentthemecolormatcharr[0]);
								}
								if (trim($contentthemecolormatcharr[1])=='adaeaf') {
									$this->conf['theme.']['shareborderColor1']=trim($contentthemecolormatcharr[0]);
								}
								if (trim($contentthemecolormatcharr[1])=='a4a5a7') {
									$this->conf['theme.']['shareborderColor2']=trim($contentthemecolormatcharr[0]);
								}
								if (trim($contentthemecolormatcharr[1])=='e3e3e3') {
									$this->conf['theme.']['shareCountborderColor']=trim($contentthemecolormatcharr[0]);
								}
								if (trim($contentthemecolormatcharr[1])=='ffffff') {
									$this->conf['theme.']['shareBackgroundColor']=trim($contentthemecolormatcharr[0]);
								}
								$contentdefaultcss=str_replace(trim($contentthemecolormatcharr[1]),trim($contentthemecolormatcharr[0]),$contentdefaultcss);
							}
						}
						if (!$this->processcssandjsfiles) {
							// exit is possible only here, the additional theme options ...
							// future tuning would be possible with SESSION-cache per theme
							return '';
						}
						$contentarr=explode('font-family:',$contentdefaultcss);
						for ($i=1; $i<count($contentarr);$i++) {
							$contentarrfontfamilyarr=explode(';',$contentarr[$i]);
							$contentarrfontfamilyarr[0]=$this->conf['theme.']['themeFontFamily'];
							$contentarr[$i]=implode(';',$contentarrfontfamilyarr);
						}
						$contentdefaultcss=implode('font-family:',$contentarr);
						if ($contentdefaultcss!=$content) {
							if ($this->conf['theme.']['selectedTheme']!='custom') {
								file_put_contents($filenamecss, $contentdefaultcss);
							}
						}
					} else {
						return $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.css.defaulttheme', false)) . ': ' . $filenamedefaultcss;
					}
				} else {
					return $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.css.themetxt', false)) . ': ' . $filenametheme;
				}

			} else {
				return $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.css.theme', false)) . ': ' . $filenamecss;

			}

		return '';
	}

	/**
	 * Checks if the CSS-File for config-dependent values (UserImageSize) exists and if not creates it.
	 *
	 * @return	$changedconfig		true if new file has been written
	 */
	protected function checkCSSLoc() {
		$changedconfig = 0;
		if (!$this->processcssandjsfiles) {
			return $changedconfig;
		}

		$filenamecss='tx-tc-conf' . str_replace('.txt','',$this->conf['theme.']['selectedBoxmodel']) . '.css';

		$dirsep=DIRECTORY_SEPARATOR;

		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

		$txdirname= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/' );
		$filenamecss=$txdirname . $filenamecss;

		$unlinked=false;
		$contentnow='';
		if (file_exists($filenamecss)) {
			$contentnow = file_get_contents($filenamecss);
			$changedconfig = filemtime($filenamecss);

		}
		$marginpiccomment = 0;

		if ($this->conf['theme.']['selectedBoxmodelkoogled']==1) {
			$marginpiccomment = 15;
		}
		$csscontent = '/* base: userImageSize is ' . $this->conf['UserImageSize'] . 'px' . $this->conf['theme.']['boxmodelSpacing'] . ' */' . "\n";
		$csscontent .= '/* conf-changed css begin */' . "\n";
		if ($this->conf['theme.']['usethemeFontFamilyForPlugin'] == 1) {
			$csscontent .= '.toctoc-comments-pi1 {
    font-family: ' . $this->conf['theme.']['themeFontFamily'] . ';
}'. "\n";
		}

		$csscontent .= '.toctoc-comments-pi1 .tx-tc-cts .tx-tc-ct-box-cttxt {
    margin-left: ' . (intval($this->conf['UserImageSize'])+intval(3*$this->conf['theme.']['boxmodelSpacing']+$marginpiccomment-($this->conf['theme.']['boxmodelSpacing']/2))) . 'px;
}
textarea.tx-tc-ctinput-textarea, input.tx-tc-ct-input, #cap-wrap .text-box label {
    font-family: ' . $this->conf['theme.']['themeFontFamily'] . ';
}
.tx-tc-ct-submit, .tx-tc-ct-reset, .tx-tc-ct-submit-loggedin, .tx-tc-cts-ctsbrowse-submit-hide, .tx-tc-cts-ctsbrowse-submit {
    		font-family: ' . $this->conf['theme.']['themeFontFamily'] . ';
}
.tx-tc-ct-ry-report-line {
    margin: -4px 0 2px ' . (intval($this->conf['UserImageSize'])+10) . 'px;
}
.tx-tc-ct-rybox {
    min-height: ' . (intval($this->conf['UserImageSize'])+ 4 + intval($this->conf['theme.']['boxmodelLineHeight']-16)) . 'px;
}
.tx-tc-ct-box-picturecrop32 {
    height: ' . (intval($this->conf['UserImageSize'])-8) .'px;
}
.tx-tcresponse-text {
    margin: 0 0 0 ' . (intval($this->conf['UserImageSize'])+10) .'px;
 }
.tx-tc-ct-form-field-1 {
   	margin-left: -' . (intval($this->conf['UserImageSize'])) .'px;
}
.tx-tc-trt-rating {
    margin: -2px '.(intval($this->conf['theme.']['boxmodelSpacing'])-1).'px 17px;
    padding: 0 '.$this->conf['theme.']['boxmodelSpacing'].'px;
 }
.tx-tc-trl-rank {
	width: ' . intval($this->conf['topRatings.']['topratingsnumberwidth']) .'px;
}
.tx-tc-trt-rating {
    line-height: '.(intval($this->conf['theme.']['boxmodelLineHeight'])+4).'px;
}
.tx-tc-trtpic {
	margin: 0 '.$this->conf['theme.']['boxmodelSpacing'].'px 0 0;
}
.tx-tc-trt-listdesc {
	margin-bottom: '.(2*intval($this->conf['theme.']['boxmodelSpacing'])).'px;
}
.tx-tc-trt-cts-article {
	margin: '.(intval($this->conf['theme.']['boxmodelSpacing'])).'px 0 '.(2*intval($this->conf['theme.']['boxmodelSpacing'])).'px 0;
}
.tx-tc-pi1 .tx-tc-cts-form-fieldtextarea-1 {
	min-height: ' . (intval($this->conf['UserImageSize'])) .'px;
}' . "\n";

		// Write the contents back to the file if changes
		if ($contentnow!=$csscontent) {
			file_put_contents($filenamecss, $csscontent);
			$changedconfig = time();
		}
		return $changedconfig;

	}


	/**
	 * Initializes the plugins initprefixToTableMap-conf from the table
	 *
	 * @param	array		$conf	Configuration from TS
	 * @return	void
	 */
	protected function initprefixToTableMap() {
		$tmprep='';
		$tmpwhere = 'deleted=0';
		$tmpsorting = 'uid';

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'tx_toctoc_comments_prefixtotable', $tmpwhere,$tmpsorting);
		foreach ($rows as $row) {

			$this->conf['prefixToTableMap.'][$row['pi1_key']]=$row['pi1_table'];
			if ($row['show_uid']) {
				$this->conf['showUidMap.'][$row['pi1_key']]=$row['show_uid'];
			}
		}
		// check if we need to update the pids of the static tables and the ipblock-local
		if  ($this->extConf['updatefromRoottoCommentFolder']) {
			if ($rows[0]['pid'] != intval($this->conf['storagePid'])) {
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_ipbl_local SET ' .
						'pid=' . intval($this->conf['storagePid']));
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_ipbl_static SET ' .
						'pid=' . intval($this->conf['storagePid']));
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_prefixtotable SET ' .
						'pid=' . intval($this->conf['storagePid']));
			}
		}
	}
	/**
	 * Initializes the plugin
	 *
	 * @param	array		$conf	Configuration from TS
	 * @return	boolean		false if no comment plugin should be shown (community setting)
	 */
	function init($newconfigcsswaswritten = 0) {
		if ($this->showsdebugprint==true) {
			$this->sdebuginitprint='';
			$starttimedebug=microtime(true);
		}
		$this->initprefixToTableMap();

		if ($this->showsdebugprint==true) {
			$endtimedebug=microtime(true);
			$this->sdebuginitprint.=' (InitprefixToTableMap: ' . round(1000*($endtimedebug - $starttimedebug),1) .', ' ;
		}

		$this->mergeConfiguration();

		if ($this->showsdebugprint==true) {
			$starttimedebug=microtime(true);
			$this->sdebuginitprint.='MergeConfiguration: ' . round(1000*($starttimedebug - $endtimedebug),1) .', ' ;
		}


		$_SESSION['commentsPageOrigId']=0;
		$_SESSION['commentsContentElementOrigId']=0;
		if ($this->lhookTablePrefix != '') {
			// full plugin hook from other records
			$this->conf['externalPrefix']=$this->lhookTablePrefix;
			if ($this->conf['showUidMap.'][$this->conf['externalPrefix']]) {
				$this->showUidParam = $this->conf['showUidMap.'][$this->conf['externalPrefix']];
			}
			$this->externalUid = $this->lhookId;
			$this->foreignTableName = $this->conf['prefixToTableMap.'][$this->conf['externalPrefix']];
			$_SESSION['commentListRecord']=$this->foreignTableName . '_' . $this->externalUid;

			if ($this->lhookTablePrefix == 'tt_content' ) {
				$this->conf['externalPrefix'] = 'pages';
				$this->foreignTableName = 'pages';
				$this->hooksrecordcontentelement= $this->lhookId;
				$this->hooksrecordpage= $GLOBALS['TSFE']->id;
			} else {

				$like = '%<field index="externalPrefix">\n                    <value index="vDEF">5</value>%';
				$origidswhere= ' pages.uid = tt_content.pid AND tt_content.pi_flexform LIKE \''  . $like . '\' ' .
								'AND tt_content.hidden=0 AND tt_content.deleted=0  ' .
								'AND pages.hidden=0 AND pages.deleted=0';
				if (is_array($_SESSION['hookTablemaps'][$_SESSION['commentsPageOrigId']])) {
					$rowstt=$_SESSION['hookTablemaps'][$_SESSION['commentsPageOrigId']];
				} else {
					$rowstt = array();
					$rowstt = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'tt_content.uid AS uid, pages.uid AS pid',
							'tt_content, pages',
							$origidswhere,
							'tt_content.sys_language_uid'
							);
					$_SESSION['hookTablemaps'][$_SESSION['commentsPageOrigId']]=$rowstt;
				}
				if (count($rowstt)>0) {
					$this->hooksrecordcontentelement= $rowstt[0]['uid'];
					$this->hooksrecordpage= $rowstt[0]['pid'];


				}
				$_SESSION['commentsPageOrigId']=$this->hooksrecordpage;
				$_SESSION['commentsContentElementOrigId']=$this->hooksrecordcontentelement; // ?!?
			}

		} elseif ($this->conf['externalPrefix'] != 'pages') {
			// Adjust 'showUid' for old extensions like tt_news
			if ($this->conf['showUidMap.'][$this->conf['externalPrefix']]) {
				$this->showUidParam = $this->conf['showUidMap.'][$this->conf['externalPrefix']];
			}

			$ar = t3lib_div::_GP($this->conf['externalPrefix']);

			$this->externalUid = (is_array($ar) ? intval($ar[$this->showUidParam]) : false);

			if (intval($this->externalUid)==0) {
				if ($this->conf['prefixToTableMap.'][$this->conf['externalPrefix']] == 'fe_users') {
					$_SESSION['communityprofilepage']='';
					if ((!isset($_SESSION['communityprofilepage'])) || ((isset($_SESSION['communityprofilepage'])) && ($_SESSION['communityprofilepage']==''))) {
						$confcommunity=$this->lib->getDefaultConfig($this->conf['externalPrefix']);

						if ($this->conf['externalPrefix'] != 'tx_cwtcommunity_pi1') {
							$profilepage=$confcommunity['settings.']['profilePage'];
							$getparamscommunity = 'tx_community[user]';
						} else{
							$profilepage=$confcommunity['pid_profile'];
							$getparamscommunity = 'action=getviewprofile&uid';
						}
						$params = array(
								$getparamscommunity => 9999999,
						);
						$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
						$no_cacheflag = 0;
						if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) ==0) {
							if ($useCacheHashNeeded == 1) {
								$no_cacheflag = 1;
							}
						}
						$conflink = array(
								'useCacheHash'     => $useCacheHashNeeded,
								'no_cache'         => $no_cacheflag,
								'parameter'        => $profilepage,
								'additionalParams' => t3lib_div::implodeArrayForUrl('',$params,'',1),
								'ATagParams' => 'rel="nofollow"',
						);
						$_SESSION['communityprofilepage']= $this->cObj->typoLink('dummy', $conflink);
						$_SESSION['communityprofilepageparams']='';
						if (strpos($_SESSION['communityprofilepage'], '9999999')===false) {
							$conflink = array(
									'useCacheHash'     => $useCacheHashNeeded,
									'no_cache'         => $no_cacheflag,
									'parameter'        => $profilepage,
									'ATagParams' => 'rel="nofollow"',
							);
							$_SESSION['communityprofilepage']= $this->cObj->typoLink('dummy', $conflink);
							$_SESSION['communityprofilepageparams']= t3lib_div::implodeArrayForUrl('',$params,'',1);
							if (strpos($_SESSION['communityprofilepage'],'?')===false) {
								$_SESSION['communityprofilepageparams']= '?' . substr($_SESSION['communityprofilepageparams'],1);
							}
						}
					}
					if ($this->conf['externalPrefix'] == 'tx_cwtcommunity_pi1') {

						$this->externalUid = t3lib_div::_GP('uid');
						if (!$this->externalUid) {
							$this->externalUid =$GLOBALS['TSFE']->fe_user->user['uid'];
						} else {
							$safewe=$this->conf['advanced.']['wallExtension'];
							$this->conf['advanced.']['wallExtension'] =2;
							$buddies= $this->lib->usersGroupmembers($this, false, $this->conf);
							$this->conf['advanced.']['wallExtension']=$safewe;
							$budarr=explode(',',$buddies);

							if (!in_array($this->externalUid, $budarr)) {
								if ($this->communityFriendsProfileListAccessright==1) {
									return false;
								} elseif ($this->communityFriendsProfileListAccessright==2) {
									$this->conf['code']="COMMENTS";
								}
							}
							if ($this->communityFriendsProfileListAccessright==0) {
								if ($this->externalUid != $GLOBALS['TSFE']->fe_user->user['uid']) {
									return false;
								}
							}
						}

					} else {

						$this->externalUid =$GLOBALS['TSFE']->fe_user->user['uid'];
					}

				}
			} else {
				if ($this->conf['prefixToTableMap.'][$this->conf['externalPrefix']] == 'fe_users') {
					$safewe=$this->conf['advanced.']['wallExtension'];
					$this->conf['advanced.']['wallExtension'] =1;
					$buddies= $this->lib->usersGroupmembers($this, false, $this->conf);
					$this->conf['advanced.']['wallExtension']=$safewe;
					$budarr=explode(',',$buddies);

					if (!in_array($this->externalUid, $budarr)) {
						if ($this->communityFriendsProfileListAccessright==1) {
							return false;
						} elseif ($this->communityFriendsProfileListAccessright==2) {
							$this->conf['code']="COMMENTS";
						}
					}
					if ($this->communityFriendsProfileListAccessright==0) {
						if ($this->externalUid != $GLOBALS['TSFE']->fe_user->user['uid']) {
							return false;
						}
					}

				}
			}
			$this->foreignTableName = $this->conf['prefixToTableMap.'][$this->conf['externalPrefix']];
			$_SESSION['commentListRecord']=$this->foreignTableName . '_' . $this->externalUid;

		} else {
			// We are commenting normally
			$this->externalUid = $GLOBALS['TSFE']->id;
			$this->foreignTableName = 'pages';
			$this->showUidParam = '';
			// $_SESSION['commentListRecord'] will be set later after the selection of $_SESSION['commentListIndex']
		}
		if ($this->showsdebugprint==true) {
			$endtimedebug=microtime(true);
			$this->sdebuginitprint.='Setting up Table maps: ' . round(1000*($endtimedebug - $starttimedebug),1) .', ' ;
		}

		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$this->conf['templateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
		$this->templateCode = $this->cObj->fileResource($usetemplateFile);

		$key = 'EXT:toctoc_comments_' . md5($this->templateCode);
		if ($this->showsdebugprint==true) {
			$this->sdebuginitprint.='Reading Templatefile: ' . $this->conf['templateFile'] . ': ' . round(1000*(microtime(true) - $endtimedebug),1) .', ' ;
		}
		if (!isset($GLOBALS['TSFE']->additionalHeaderData[$key])) {
			$headerParts = $this->cObj->getSubpart($this->templateCode, '###HEADER_ADDITIONS###');
			if ($headerParts) {
				if ($this->showsdebugprint==true) {
					$starttimedebug2=microtime(true);
				}
				$this->boxmodel($newconfigcsswaswritten);
				if ($this->showsdebugprint==true) {
					$endtimedebug2=microtime(true);
					$this->sdebuginitprint.='Boxmodel: ' . round(1000*($endtimedebug2 - $starttimedebug2),1) .', ' ;
					$starttimedebug2=microtime(true);
				}

				if ($this->conf['ratings.']['additionalCSS']) {
					$subSubPart = $this->cObj->getSubpart($this->templateCode, '###ADDITIONAL_CSS###');
					$subParts['###ADDITIONAL_CSS###'] = trim($this->cObj->substituteMarker($subSubPart,
							'###CSS_FILE###', $GLOBALS['TSFE']->tmpl->getFileName($this->conf['ratings.']['additionalCSS'])));
				}
				else {
					$subParts['###ADDITIONAL_CSS###'] = '';
				}
				$mincommentid=0;
				$maxcommentid=0;
				if (version_compare(TYPO3_version, '4.6', '<')) {
					$tmpint = t3lib_div::testInt($this->conf['storagePid']);
				} else {
					$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['storagePid']);
				}
				$rangenewcommentswhere=' approved=1 AND ' . ($tmpint ?
						'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
						$this->cObj->enableFields('tx_toctoc_comments_comments') . ' AND crdate > ' . (time() - 691200); //newer than 8 days

				$rowstt = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_comments.uid AS uid',
						'tx_toctoc_comments_comments',
						$rangenewcommentswhere,
						'tx_toctoc_comments_comments.uid'
				);
				if (count($rowstt)>0) {
					$mincommentid=$rowstt[0]['uid'];
					$maxcommentid=$rowstt[(count($rowstt)-1)]['uid']+50;
				} else {
					$rangenewcommentswhere=' approved=1 AND ' . ($tmpint ?
							'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
							$this->cObj->enableFields('tx_toctoc_comments_comments'); //any
					$rowstt2 = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
							'MAX(tx_toctoc_comments_comments.uid) AS uid',
							'tx_toctoc_comments_comments',
							$rangenewcommentswhere
					);
					if (count($rowstt2)>0) {
						if ($rowstt2[0]['uid'] !='') {
							$mincommentid=$rowstt2[0]['uid'];
							$maxcommentid=$rowstt2[0]['uid']+50;
						}
					}
					if ($mincommentid==0) {
						$mincommentid=1;
						$maxcommentid=51;
					}
				}

				if ($this->showsdebugprint==true) {
					$starttimedebug21=microtime(true);
					$this->sdebuginitprint.='Check new comments: ' . round(1000*($starttimedebug21 - $starttimedebug2),1) .', ' ;
				}
				$tcsmiliesenchtml='';
				if ($this->conf['advanced.']['useEmoji']>0) {
					$fetchemojis=true;
					if 	((intval($this->conf['advanced.']['emojiConfigCacheLevel'])==0)) {
						if ((isset($_SESSION['SmilieCard'][$_SESSION['activelang']])===true)) {
							$fetchemojis=false;
						}
					} elseif ((intval($this->conf['advanced.']['emojiConfigCacheLevel'])==1)) {
					    if ((isset($_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']])===true)) {
					    	$fetchemojis=false;
					    }
					}
					if ($fetchemojis==true) {
						$tcsc=$this->lib->getSmiliesCard($this->conf);
						if ($this->conf['advanced.']['emojiConfigCacheLevel']==1) {
							$_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']]=$tcsc;
						} elseif ($this->conf['advanced.']['emojiConfigCacheLevel']==0) {
							$_SESSION['SmilieCard'][$_SESSION['activelang']]=$tcsc;
						}
						if ($this->showsdebugprint==true) {
							$this->sdebuginitprint.='Emojis from Code: ' ;
						}
					} else {
						if ($this->conf['advanced.']['emojiConfigCacheLevel']==0) {
							$tcsc=$_SESSION['SmilieCard'][$_SESSION['activelang']];
						} elseif ($this->conf['advanced.']['emojiConfigCacheLevel']==1) {
							$tcsc=$_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']];

						}
						if ($this->showsdebugprint==true) {
							$this->sdebuginitprint.='Emojis from Cache: ' ;
						}
					}
					// PHP 5.3.4 is not able to output a javascript var longer than 99959 chars correctly, that's why this
					if ($this->showsdebugprint==true) {
						$starttimedebug221=microtime(true);
						$this->sdebuginitprint.=round(1000*($starttimedebug221 - $starttimedebug21),1) .', ' ;
					}
					// slicing is needed
					$tcsc1=substr($tcsc,0,99959);
					$tcsc2=substr($tcsc,99959,99959);
					$tcsc3=substr($tcsc,199918,99959);
					$tcsmiliesenchtml='<script type="text/javascript">var tcsc1 = \''. $tcsc1.'\'; </script>
							<script type="text/javascript">var tcsc2 = \''. $tcsc2.'\'; </script>
										<script type="text/javascript">var tcsc3 = \''. $tcsc3.'\'; </script>
									<script type="text/javascript">var tcsmiliecard =tcsc1+tcsc2+tcsc3;
									</script>';
					if ($this->showsdebugprint==true) {
						$starttimedebug22=microtime(true);
						$this->sdebuginitprint.='Preparing JS for Emojis: ' . round(1000*($starttimedebug22-$starttimedebug221),1) .', ' ;
					}
				}
				$starttimedebug22=microtime(true);
				$jsservervars = $tcsmiliesenchtml . '<script type="text/javascript">var tccommnetidstart = ' . $mincommentid  .';
						var tccommnetidto = ' . $maxcommentid  .';
						var tcdateformat = ' . $this->conf['advanced.']['dateFormatOldStyle'] .';
						var pageid = ' . $GLOBALS['TSFE']->id .';
				</script>';

				$lancode= $_SESSION['activelang'];
				if ($this->conf['theme.']['selectedBoxmodel'] !='') {
					$lancode=str_replace('.txt','-',$this->conf['theme.']['selectedBoxmodel']) . $_SESSION['activelang'];
				}
				$emojicss='';$emojifycss='';$emojijs='';

				if ($this->conf['advanced.']['useEmoji']>0) {
					$emojijs='<script  type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/js/tx-tc-premojify.js"></script>';
				}
				if ($this->conf['advanced.']['useEmoji']==1) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji16.css" rel="stylesheet" type="text/css"/>';
				} elseif ($this->conf['advanced.']['useEmoji']==2) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji20.css" rel="stylesheet" type="text/css"/>';
				} elseif ($this->conf['advanced.']['useEmoji']==3) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji26.css" rel="stylesheet" type="text/css"/>';
				} elseif ($this->conf['advanced.']['useEmoji']==4) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji33.css" rel="stylesheet" type="text/css"/>';
				}

				$headerParts = $this->cObj->substituteMarkerArrayCached($headerParts, array(
						'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
						'###LANCODE###' => $lancode,
						'###THEME###' => $this->conf['theme.']['selectedTheme'],
						'###BOXMODEL###' => $this->boxmodelcss,
						'###BOXMODELCONF###' => 'tx-tc-conf' . str_replace('.txt','', $this->conf['theme.']['selectedBoxmodel']) . '.css',
						'###EMOJICSS###' => $emojicss,
						'###EMOJIJS###' => $emojijs,
						'###JSSERVERVARS###' => $jsservervars,
						'###EXTVERSION###' => $this->extVersion,
				), $subParts);
				$GLOBALS['TSFE']->additionalHeaderData[$key] = $headerParts;
				if ($this->showsdebugprint==true) {
					$endtimedebug2=microtime(true);
					$this->sdebuginitprint.='Header: ' . round(1000*($endtimedebug2 - $starttimedebug22),1) .', ' ;

				}
			}
		}
		// We are commenting on cid
		if ($this->showsdebugprint==true) {
			$starttimedebug2=microtime(true);
		}

		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($this->conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['storagePid']);
		}
		if ($this->conf['externalPrefix']=='pages') {
			$this->where_dpck = '' . ($tmpint ?
					'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
					$this->cObj->enableFields('tx_toctoc_comments_comments');

		} else {
			if ($this->conf['advanced.']['wallExtension'] != 0) {
				$this->where_dpck = '(external_prefix="tx_community" OR external_prefix="tx_cwtcommunity_pi1") AND ' .
				($tmpint ?
						'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
						$this->cObj->enableFields('tx_toctoc_comments_comments');
			} elseif ($this->respectExternalPrefixinWhereClause) {
				$this->where_dpck = 'external_prefix=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->conf['externalPrefix'], 'tx_toctoc_comments_comments') .
				' AND external_ref=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->foreignTableName . '_' . $this->externalUid, 'tx_toctoc_comments_comments') .
				' AND ' . ($tmpint ?
						'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
						$this->cObj->enableFields('tx_toctoc_comments_comments');
 			} else {
 				// normal case
				$this->where_dpck = 'external_ref=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->foreignTableName . '_' . $this->externalUid, 'tx_toctoc_comments_comments') .
				' AND ' . ($tmpint ?
				'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
				$this->cObj->enableFields('tx_toctoc_comments_comments');
			}
		}
		$this->where = 'approved=1 AND ' . $this->where_dpck;

		$this->ref=$this->foreignTableName . '_' . $this->externalUid;
		if ($this->showsdebugprint==true) {
			$endtimedebug2=microtime(true);
			$this->sdebuginitprint.='Init end: ' . round(1000*($endtimedebug2 - $starttimedebug2),1) .') ' ;

		}
		return true;

	}

	/**
	 * Merges TS configuration with configuration from flexform (latter takes precedence).
	 *
	 * @return	void
	 */
	function mergeConfiguration() {

		$this->conf['attachments.']['useTopWebpagePreview']='';
		$this->conf['attachments.']['topWebpagePreviewPicture']=0;

		$this->fetchConfigValue('storagePid');
		if (intval($this->conf['externalPrefix'])>0) {
			if ($this->conf['externalPrefix']!='') {
				$where = 'uid=' . $this->conf['externalPrefix'];
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key',
						'tx_toctoc_comments_prefixtotable',
						$where,
						'',
						'',
						''
				);
				$this->conf['externalPrefix']=$rows[0]['pi1_key'];
			}
		}
		$this->fetchConfigValue('pluginmode');
		$this->fetchConfigValue('recentcommentslistCount');
		$this->fetchConfigValue('restrictToExternalPrefix');
		$this->fetchConfigValue('additionalClearCachePagesLocal');
		if ($this->conf['pluginmode']==4) {
			$this->fetchConfigValue('otherCharts');
			$this->fetchConfigValue('otherChartsrestrictToExternalPrefix');
			$this->fetchConfigValue('otherChartsExternalPrefix');
			$this->fetchConfigValue('otherChartsDays');
			$this->fetchConfigValue('otherChartslistCount');
			$this->fetchConfigValue('otherChartsNumberOfVotesRequired');
		}
		$this->fetchConfigValue('topRatings');
		$this->fetchConfigValue('topRatingsrestrictToExternalPrefix');
		$this->fetchConfigValue('topRatingsExternalPrefix');
		$this->fetchConfigValue('topRatingsDays');
		$this->fetchConfigValue('topratingslistCount');
		$this->fetchConfigValue('topRatingsNumberOfVotesRequired');
		$this->fetchConfigValue('topRatingsAlignResultsWithMaxVotesAndAvgVote');
		if ($this->conf['pluginmode']==3) {
			if ($this->conf['topRatings']!='') {
				$this->conf['topRatings.']['topRatingsMode']=$this->conf['topRatings'];
			}
			if ($this->conf['topRatingsrestrictToExternalPrefix']!='') {
				$this->conf['topRatings.']['topRatingsrestrictToExternalPrefix']=$this->conf['topRatingsrestrictToExternalPrefix'];
			}

			if ($this->conf['topRatingsExternalPrefix']!='') {
				$this->conf['topRatings.']['topRatingsExternalPrefix']=$this->conf['topRatingsExternalPrefix'];
			}

			if ($this->conf['topRatingsDays']!='') {
				$this->conf['topRatings.']['RatingsDays']=$this->conf['topRatingsDays'];
			}

			if ($this->conf['topratingslistCount']!='') {
				$this->conf['topRatings.']['RatedItemsListCount']=$this->conf['topratingslistCount'];
			}

			if ($this->conf['topRatingsNumberOfVotesRequired']!='') {
				$this->conf['topRatings.']['NumberOfVotesRequired']=$this->conf['topRatingsNumberOfVotesRequired'];
			}
			if ($this->conf['topRatingsAlignResultsWithMaxVotesAndAvgVote']!='') {
				$this->conf['topRatings.']['AlignResultsWithMaxVotesAndAvgVote']=$this->conf['topRatingsAlignResultsWithMaxVotesAndAvgVote'];
			}

		}
		if ($this->conf['pluginmode']==4) {
			if ($this->conf['otherCharts']!='') {
				$this->conf['topRatings.']['topRatingsMode']=intval($this->conf['otherCharts'])+4;
			}
			if ($this->conf['otherChartsrestrictToExternalPrefix']!='') {
				$this->conf['topRatings.']['topRatingsrestrictToExternalPrefix']=$this->conf['otherChartsrestrictToExternalPrefix'];
			}

			if ($this->conf['otherChartsExternalPrefix']!='') {
				$this->conf['topRatings.']['topRatingsExternalPrefix']=$this->conf['otherChartsExternalPrefix'];
			}

			if ($this->conf['otherChartsDays']!='') {
				$this->conf['topRatings.']['RatingsDays']=$this->conf['otherChartsDays'];
			}

			if ($this->conf['otherChartslistCount']!='') {
				$this->conf['topRatings.']['RatedItemsListCount']=$this->conf['otherChartslistCount'];
			}

			if ($this->conf['otherChartsNumberOfVotesRequired']!='') {
				$this->conf['topRatings.']['NumberOfVotesRequired']=$this->conf['otherChartsNumberOfVotesRequired'];
			}
		}


		$this->fetchConfigValue('userStats');

		$this->fetchConfigValue('advanced.commentingClosed');
		$this->fetchConfigValue('advanced.closeCommentsAfter');
		$this->fetchConfigValue('advanced.useSharing');
		$this->fetchConfigValue('advanced.dontUseSharingFacebook');
		$this->fetchConfigValue('advanced.dontUseSharingGoogle');
		$this->fetchConfigValue('advanced.dontUseSharingTwitter');
		$this->fetchConfigValue('advanced.dontUseSharingLinkedIn');
		$this->fetchConfigValue('advanced.dontUseSharingStumbleupon');
		$this->fetchConfigValue('advanced.initialViewsCount');
		$this->fetchConfigValue('advanced.initialViewsDate');


		$this->fetchConfigValue('ratings.enableRatings');
		$this->fetchConfigValue('ratings.ratingsTemplateFile');
		$this->fetchConfigValue('ratings.useMyVote');
		$this->fetchConfigValue('ratings.useVotes');
		$this->fetchConfigValue('ratings.useScopesForVote');
		$this->fetchConfigValue('ratings.useOverallScopeForVote');
		$this->fetchConfigValue('ratings.useLikeDislike');
		$this->fetchConfigValue('ratings.useDislike');
		$this->fetchConfigValue('ratings.ratingsOnly');

		$this->fetchConfigValue('spamProtect.requireApproval');
		$this->fetchConfigValue('spamProtect.considerReferer');
		$this->fetchConfigValue('spamProtect.useCaptcha');
		$this->fetchConfigValue('spamProtect.notificationEmail');
		$this->fetchConfigValue('spamProtect.fromEmail');

		$this->fetchConfigValue('attachments.useWebpagePreview');
		$this->fetchConfigValue('attachments.useTopWebpagePreview');
		$this->fetchConfigValue('attachments.topWebpagePreviewPicture');

				// Post process some values
		if ($this->conf['code'] == 'FORM') {
			$value = trim($this->conf['advanced.']['closeCommentsAfter']);
			if ($value != '') {
				switch ($value{strlen($value) - 1}) {
					case 'h':
						$suffix = 'hour';
						break;
					case 'm':
						$suffix = 'month';
						break;
					case 'y':
						$suffix = 'year';
						break;
					case 'd':
					default:
						$suffix = 'day';
						break;
				}
				$value = intval($value);
				if ($value > 1) {
					$suffix .= 's';
				}
				$this->conf['advanced.']['closeCommentsAfter'] = '+ ' . $value . ' ' . $suffix;
			}
		}

		// storagePid should be a single pid (list of pids: you can try, but its not tested).
		$this->conf['storagePid'] = trim($this->conf['storagePid']);


		if (($this->ae_detect_ie()) && ($this->showonlyHTML5)) {
			$this->conf['attachments.']['usePicUpload'] = 0;
			$this->conf['attachments.']['usePdfUpload'] = 0;
		}



		if ($this->conf['pluginmode']!=1) {
			unset ($this->conf['restrictToExternalPrefix']);
			unset ($this->conf['recentcommentslistCount']);
		} else {

			if ($this->conf['restrictToExternalPrefix'] != '') {
					$this->fetchConfigValue('restrictToCustomExternalPrefix'); //custom



					if (version_compare(TYPO3_version, '4.6', '<')) {
						$tmpint = t3lib_div::testInt($this->conf['restrictToCustomExternalPrefix']);
					} else {
						$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['restrictToCustomExternalPrefix']);
					}
					if ($tmpint) {

						$this->conf['restrictToExternalPrefix']= $this->conf['restrictToCustomExternalPrefix'];
						$where = 'uid=' . $this->conf['restrictToExternalPrefix'];

						$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
								'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key',
								'tx_toctoc_comments_prefixtotable',
								$where,
								'',
								'',
								''
						);
						$this->conf['restrictToExternalPrefix']=$rows[0]['pi1_key'];
					} else {
						// got the prefix from setup as pi_key already
						$this->conf['restrictToExternalPrefix']=$this->conf['recentcomments.']['restrictToPrefixToTableMap'];
					}
					if ($this->conf['pluginmode']==0) {
						$this->conf['advanced.']['recentcommentsPluginpages']='';
						$this->conf['advanced.']['recentcommentsPluginRecords']='';
					}
			}
		}
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($this->conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['storagePid']);
		}
		if ($tmpint) {
			$this->conf['storagePid'] = intval($this->conf['storagePid']);
		}
		else {
			$this->conf['storagePid'] = $GLOBALS['TYPO3_DB']->cleanIntList($this->conf['storagePid']);
		}
		// If storage pid is not set, use current page
		if (empty($this->conf['storagePid'])) {
			$this->conf['storagePid'] = $GLOBALS['TSFE']->id;
		}

		// Set date
		if (trim($this->conf['advanced.']['dateFormat']) == '') {
			$this->conf['advanced.']['dateFormat'] = $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy'] . ' ' . $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'];
			$this->conf['dateFormatMode'] = 'date';
		}
		// Call hook for custom configuration
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['mergeConfiguration'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['mergeConfiguration'] as $userFunc) {
				$params = array(
					'pObj' => &$this,
				);
				t3lib_div::callUserFunction($userFunc, $params, $this);
			}
		}
	}

	/**
	 * Fetches configuration value from flexform. If value exists, value in
	 * <code>$this->conf</code> is replaced with this value.
	 *
	 * @param	string		$param	Parameter name. If <code>.</code> is found, the first part is section name, second is key (applies only to $this->conf)
	 * @return	void
	 */
	function fetchConfigValue($param) {
		if (strchr($param, '.')) {
			list($section, $param) = explode('.', $param, 2);
		}
		$value = trim($this->pi_getFFvalue($this->cObj->data['pi_flexform'], $param, ($section ? 's' . ucfirst($section) : 'sDEF')));
		if (!is_null($value)) {
			if (trim($value) !== '') {
				if ($section) {
					$this->conf[$section . '.'][$param] = $value;
				}
				else {
					$this->conf[$param] = $value;
				}
			}
		}
	}
	/**
	 * Creates links from "http://..." or "www...." phrases.
	 *
	 * @param	string		$text	Text to search for links
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Text to convert
	 */
	  function createLinks($text) {
		if ($this->conf['advanced.']['autoConvertLinks']) {
			$textout= preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" class="tx-toctoc-comments-external-autolink">\1</a>', $text);
			$textout= str_replace('." rel="nofollow"','" rel="nofollow"',$textout);
			$textout= str_replace('," rel="nofollow"','" rel="nofollow"',$textout);
			$textout= str_replace(',</a>','</a>,',$textout);
			$textout= str_replace('.</a>','</a>.',$textout);
		} else {
			$textout=$text;
		}
		return $textout;
	}
	/**
	 * Applies stdWrap to given text
	 *
	 * @param	string		$text	Text to apply stdWrap to
	 * @param	string		$stdWrapName	Name for the stdWrap in $this->conf
	 * @return	string		Wrapped text
	 */
	function applyStdWrap($text, $stdWrapName) {
		if (is_array($this->conf[$stdWrapName . '.'])) {
			$text = $this->cObj->stdWrap($text, $this->conf[$stdWrapName . '.']);
		}
		return $text;
	}

	/**
	 * detects IE and return true if version > 10
	 *
	 * @return	boolean		true if IE9 or older
	 */
	protected function ae_detect_ie() {

		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
			// its IE
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 1') !== false) {
				// its IE 10 to 19 (or 1 if you want...)
				// once IE will be able to handle the fileobject, set it to false .. grrr
				return true;
			} else{
				return true;
			}
		} else {
			return false;
		}
	}
	/**
	 * applies boxmadel to maincss and sets active css to boxmodell css
	 *
	 * @param	[type]		$newconfigcsswaswritten: ...
	 * @return	string		optional error message
	 */
	protected function boxmodel($newconfigcsswaswritten = 0) {


		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

		$filenameboxmodel=$this->conf['theme.']['selectedBoxmodel']; //'boxmodel.txt'

		$txdirnameboxmodel= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/' );
		$filenameboxmodel=$txdirnameboxmodel . $filenameboxmodel;
		$txdirnameboxmodelsystem= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/system/' );
		$filenameboxmodelsystem=$txdirnameboxmodelsystem . 'boxmodel_system.txt';

		$filenamecssfile='tx-tc' . $this->extVersion . '.css';
		if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
			$filenamecssoutfile='tx-tc' . $this->extVersion . '-' . str_replace('.txt','',$this->conf['theme.']['selectedBoxmodel']) .'.css';
		} else {
			$filenamecssoutfile='tx-tc' . $this->extVersion . '-system.css';
		}

		$txdirname= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/css/' );
		$filenamecss=$txdirname . $filenamecssoutfile;

		if (file_exists($filenamecss)) {
			if (!$this->processcssandjsfiles) {

				$this->boxmodelcss ='boxmodels/css/' . $filenamecssoutfile;
				return '';
			}
		}
		$txdirnamedefault= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/' );
		$filenamedefaultcss=$txdirnamedefault . $filenamecssfile;

		$printstr='';
		$content ='';
		$bmcsslastmodif=0;
		$bmtxtlastmodif=0;
		$basecsslastmodif=0;
		$forceregenerate = false;
		$dropprotokollon= intval($this->conf['debug.']['showDropsfromBoxmodel']);
		if (($dropprotokollon) && ($this->showsdebugprint==true)) {
			$this->sdebuginitprint.='<br>Boxmodeldroplist: ';
		}
		if (!isset($_SESSION['AJAXimages'])) {
			$_SESSION['AJAXimages'] = array();
		}
		if ($this->conf['theme.']['selectedTheme']!=$_SESSION['selectedTheme']) {
			$forceregenerate = true;
			$_SESSION['AJAXimages'] = array();
			$_SESSION['selectedTheme']=$this->conf['theme.']['selectedTheme'];
			$_SESSION['DefaultUserImage'] = array();
		}
		if (file_exists($filenamecss)) {
			// boxmodel.css file found
			$content = file_get_contents($filenamecss);
			$bmcsslastmodif = filemtime($filenamecss);
		}
		if (file_exists($filenameboxmodelsystem)) {
			//boxmodel_system.txt found
			$bmtxtlastmodif = filemtime($filenameboxmodelsystem);
			$boxmodelarr = file($filenameboxmodelsystem);
			$nbrfilestoprocess=1;
			if ((file_exists($filenameboxmodel)) && ($this->conf['theme.']['selectedBoxmodel'] !='')) {
				// use boxmodel.txt found, so iteration will be done twice
				$nbrfilestoprocess=2;
				$bmtxtlastmodif = filemtime($filenameboxmodel);
			}
			if (file_exists($filenamedefaultcss)) {
				// tx-tc' . $this->extVersion . '.css is present
				$contentdefaultcss = file_get_contents($filenamedefaultcss);
				$basecsslastmodif = filemtime($filenamedefaultcss);
				if (($forceregenerate==true) || ($bmcsslastmodif<$bmtxtlastmodif) || ($bmcsslastmodif<$basecsslastmodif) ||($bmcsslastmodif<$newconfigcsswaswritten)) {


					for ($ifile=0;$ifile<$nbrfilestoprocess;$ifile++) {
						//*// // first system-boxmodel, then possible normal box-model
						//*// // output will be one file, so both resuls are merge into the rest.

						if ($ifile==1) {

							$boxmodelarr =file($filenameboxmodel);
						}
						$boxmodelcssarr = array();
						$boxmodelsrulesarr = array();
						$i_rules=0;
						$i_boxmodel=-1;
						$parsestate = '';


						for ($i=0;$i<count($boxmodelarr);$i++) {

							if (trim($boxmodelarr[$i])== 'Boxmodel') {
								$i_boxmodel++;
								$i_boxmodelCSS=-2;
								$boxmodelcssarr[$i_boxmodel] = array();

								$boxmodelcssarr[$i_boxmodel]['selectorCSSkey']= array();
								$parsestate = '';
								$i_selector=0;
							} elseif (trim($boxmodelarr[$i])== 'CSS') {
								$parsestate = 'CSS';
							} elseif (trim($boxmodelarr[$i])== 'Selectors') {
								$parsestate = 'Selectors';
							} elseif (trim($boxmodelarr[$i])== 'Rules') {
								$parsestate = 'Rules';
							} elseif (trim($boxmodelarr[$i])== '***') {
								$parsestate = '';
							} elseif (trim($boxmodelarr[$i])== '') {
								$parsestate = '';
							} elseif (($parsestate== 'CSS')) {

								$i_boxmodelCSS=$i_boxmodelCSS+2;
								$boxmodelcssarrtmp=explode(':',$boxmodelarr[$i]);
								$boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS]=$boxmodelcssarrtmp[0];
								$boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS+1]=$boxmodelcssarrtmp[1];
								$parsestate = 'CSS2';
							} elseif ($parsestate== 'CSS2') {

								$boxmodelcssarr[$i_boxmodel]['CSS2']=explode(':',$boxmodelarr[$i]);

								$boxmodelsrulesarr[$i_boxmodel]=array();
								$boxmodelsrulesarr[$i_boxmodel]['boxmodel'] =$i_boxmodel;
								$boxmodelsrulesarr[$i_boxmodel]['fullrule'] =$boxmodelcssarr[$i_boxmodel]['CSS2'][$i_boxmodelCSS+1]; // {2}px
								$boxmodelsrulesarr[$i_boxmodel]['selector'] =$boxmodelcssarr[$i_boxmodel]['CSS2'][$i_boxmodelCSS]; // border-width
								$boxmodelsrulesarr[$i_boxmodel]['fullruleeval'] ='';
								$parsestate = 'CSS';

								$i_rules++;
							} elseif ($parsestate== 'Rules') {
								$boxmodelsrulesarr[$i_boxmodel]=array();
								$boxmodelsrulesarr[$i_boxmodel]['boxmodel'] =$i_boxmodel;
								$boxmodelsrulesarr[$i_boxmodel]['fullruleeval'] =$boxmodelarr[$i]; //{3} = {1} + {2}+ 30
								$i_rules++;

							} elseif ($parsestate== 'Selectors') {
								$boxmodelcssarr[$i_boxmodel]['selectorCSSkey'][$i_selector]=$boxmodelarr[$i];
								$i_selector++;

							}
						}
						//now the 2 boxmodel arrays are there: one with rules, the other with data to process

						// 1. apply rules on data-array
						for ($i=0;$i<count($boxmodelsrulesarr);$i++) {

							// get the value to replace
							$replrightarr= explode('}',$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);  // xxx{2 , px;
							$replright=$replrightarr[1]; // px;
							$replleftarr= explode('{',$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);   // xxx   2}px;
							$replleft=$replrightarr[0]; // xxx
							if ($replright !='') {
								$varrighttrimedarr= explode($replright,$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS'][1]); // xxx170 ,
								$varrighttrimed=implode($varrighttrimedarr); // xxx170
							} else {
								$varrighttrimed=$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS'][1];
							}


							$vartrimed=intval($varrighttrimed); // if not int -> 0

							if ($replleft !='') {
								// xxx
								$varlefttrimedarr= explode($replleft,$varrighttrimed); // xxx170
								$vartrimed=$varlefttrimedarr[0];		// 170
							}
							$boxmodelsrulesarr[$i]['varval']=$vartrimed;
							$varnamearr= explode('{',$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);  // xxx  2}px;
							$varnamearr2=explode('}',$varnamearr[1]); // 2   px;
							$boxmodelsrulesarr[$i]['varname']=trim($varnamearr2[0]);
							if (intval($boxmodelsrulesarr[$i]['varname'])==0) {
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelTextareaLineHeight') {
									$boxmodelsrulesarr[$i]['varval']=$this->conf['theme.']['boxmodelTextareaLineHeight'];
								}
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelTextareaHeight') {
									$boxmodelsrulesarr[$i]['varval']=$this->boxmodelTextareaHeight;
								}

								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelSpacing') {
									$boxmodelsrulesarr[$i]['varval']=intval($this->conf['theme.']['boxmodelSpacing']);
								}
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelLineHeight') {
									$boxmodelsrulesarr[$i]['varval']=$this->conf['theme.']['boxmodelLineHeight'];
								}
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelLineHeightHalf') {
									$boxmodelsrulesarr[$i]['varval']=round(($this->conf['theme.']['boxmodelLineHeight']-16)/2,0);
								}
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelSpacingHalf') {
									$boxmodelsrulesarr[$i]['varval']=round(($this->conf['theme.']['boxmodelSpacing'])/2,0);
								}
								if ($boxmodelsrulesarr[$i]['varname']=='ratingImageWidth') {
									$boxmodelsrulesarr[$i]['varval']=$this->conf['ratings.']['ratingImageWidth'];
								}
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelInputFieldSize') {
									$boxmodelsrulesarr[$i]['varval']=$this->conf['theme.']['boxmodelInputFieldSize'];
								}
								if ($boxmodelsrulesarr[$i]['varname']=='boxmodelLabelWidth') {
									$boxmodelsrulesarr[$i]['varval']=$this->conf['theme.']['boxmodelLabelWidth'];
								}
							}
							if ($boxmodelsrulesarr[$i]['fullruleeval'] != '') {
								// set the values in the formula
								$rulevarnamepartevalpartarr= explode('=',$boxmodelsrulesarr[$i]['fullruleeval'] );
								$varpart=  trim($rulevarnamepartevalpartarr[0]); // {3}
								$evalpart=  trim($rulevarnamepartevalpartarr[1]); // {1} + {2} + 30

								for ($j=0;$j<count($boxmodelsrulesarr);$j++) {
									if ($boxmodelsrulesarr[$j]['varname']=='boxmodelTextareaLineHeight') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['theme.']['boxmodelTextareaLineHeight'],$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelTextareaHeight') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->boxmodelTextareaHeight,$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelSpacing') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', intval($this->conf['theme.']['boxmodelSpacing']),$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelLineHeight') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['theme.']['boxmodelLineHeight'],$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelLineHeightHalf') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', round(($this->conf['theme.']['boxmodelLineHeight']-16)/2,0),$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='ratingImageWidth') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['ratings.']['ratingImageWidth'],$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelSpacingHalf') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', round(($this->conf['theme.']['boxmodelSpacing'])/2,0),$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelInputFieldSize') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', intval($this->conf['theme.']['boxmodelInputFieldSize']),$evalpart);
									} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelLabelWidth') {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', intval($this->conf['theme.']['boxmodelLabelWidth']),$evalpart);
									} else {
										$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $boxmodelsrulesarr[$j]['varval'],$evalpart);
									}
								}// 170 + 40 + 30
								$boxmodelsrulesarr[$i]['varname']=str_replace('{','',str_replace('}','',$varpart)); // 3
								$boxmodelsrulesarr[$i]['varval']= $this->calculate_string($evalpart);  //240
							}
						}
						// not the values in the data-array are set and calculated
						// replace the vars in CSS2 with varvals and replace CSS with CSS2
						for ($i=0;$i<count($boxmodelcssarr);$i++) {
							for ($j=0;$j<count($boxmodelsrulesarr);$j++) {
								for ($c=1;$c<count($boxmodelcssarr[$i]['CSS2']);$c=$c+2) {
									$boxmodelcssarr[$i]['CSS2'][$c]=str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}',$boxmodelsrulesarr[$j]['varval'],$boxmodelcssarr[$i]['CSS2'][$c]); // width: 200px; becomes width: 240px if CSS2= width: {3}px;
								}

							}
							for ($c=1;$c<count($boxmodelcssarr[$i]['CSS2']);$c=$c+2) {
								if ($boxmodelcssarr[$i]['CSS2'][$c]!='') {
									$boxmodelcssarr[$i]['CSS'][$c]=$boxmodelcssarr[$i]['CSS2'][$c];
								}
							}
						}
						// So now all the CSS  in the data-array are ready to be checked against the CSS file
						//spilt CSS on seletor and subsequent '}'


						for ($i=0;$i<count($boxmodelcssarr);$i++) {

							for ($j=0;$j<count($boxmodelcssarr[$i]['selectorCSSkey']);$j++) {
							// - checking every css-selector in the boxmodel-entry
								$selectorCSSkey= trim($boxmodelcssarr[$i]['selectorCSSkey'][$j]) . ' {';
								// - selectorCSSkey looks like for example "tx-tc-goodguy {"
								for ($c=0;$c<count($boxmodelcssarr[$i]['CSS']);$c=$c+2) {
								// - for every CSS-property to be assigned to the  current selectorCSSKey. $c holds search value, $d replace with value
									$d=$c+1;
									// take the selector to work on and isolate it from default CSS
									$contentdefaultcssarr = explode("\n". $selectorCSSkey, $contentdefaultcss);
									// - the entire default CSS gets splitet on the selectorCSSKey
									if (count($contentdefaultcssarr) >1) {
										// -if splitting was successful
										$contentdefaultcssarr2= explode('}',$contentdefaultcssarr[1]);
										// -make an array with the part after the selectorCSSKey
										$selectorsscss= $contentdefaultcssarr2[0];
										// -setting selectorcss to the css-properies of the selectorCSSKey
									} else {
										// - if splitting wasn't successful'
										$selectorsscss= '';
										// -selectors CSS is empty

										//$selectorsscss= "\t" .$boxmodelcssarr[$i]['CSS'][$c] .':nadesch;';
										$contentdefaultcssarr2=array();
										$contentdefaultcssarr2[0]='';
										$contentdefaultcssarr2[1]='';
									}
									// isolation done
									// find property $boxmodelcssarr[$i]['CSS2'][0] in the selector
									$boxmodelcssarr[$i]['CSS'][$d]=str_replace(';','',$boxmodelcssarr[$i]['CSS'][$d]);
									// -remove ";" from new CSS-Property-line
									$selectorsscssarr= explode("\t" . $boxmodelcssarr[$i]['CSS'][$c] .":",$selectorsscss);
									// - Now we split the found CSS-Properties on the Property whose value we want to replace
									//   EX1: splitting such the array will be so: (height)
									//      width: 34px;   height: 45px; top: 0px;->  [0]:   width: 34px; [1]: 45px: top: 0px;
									//   is empty if $selectorsscss=''
									if (count($selectorsscssarr)>1) {
										// property was found now we replace its content

										$selectorsscssarr2= explode(';',$selectorsscssarr[1]);
										// - EX1: we isolate the "45 px", it's in element [0]
										$selectorsscssarr2[0]=$boxmodelcssarr[$i]['CSS'][$d];
										// - here we filled in the new value 79px
										//and implode back

										$selectorsscssarr[1]=implode(';',$selectorsscssarr2);
										// - [1] has now the new value inside
										$selectorsscssarr[1]=str_replace("\r\n" . ';', ';' , $selectorsscssarr[1]);
										$selectorsscssarr[1]=str_replace("\n" . ';', ';' , $selectorsscssarr[1]);
										// - replaced the new lines in the "79px-string" [1]
										$selectorsscss=implode( "\t".$boxmodelcssarr[$i]['CSS'][$c] .':',$selectorsscssarr);
										// - restored the selectors entire CSS properties
										$contentdefaultcssarr2[0]="\t". $selectorsscss;
										// - prepend a tab and write it back to the originating array element
										$contentdefaultcssarr[1]=implode('}',$contentdefaultcssarr2);
										// - rebuild the originating array element
									} else {
										// property was not, we check for a leading '+' in the property string
										// if present we add the property (without the '+' to the selector

										if (substr($boxmodelcssarr[$i]['CSS'][$c],0,1) == '+') {

											$selectorsscssplus = "\t" . substr($boxmodelcssarr[$i]['CSS'][$c],1).":" . $boxmodelcssarr[$i]['CSS'][$d] . ";\n";
											$selectorsscssplus =str_replace("\r\n" . ';', ';' , $selectorsscssplus);
											$selectorsscssplus =str_replace("\n" . ';', ';' , $selectorsscssplus);
											// - new CSS Property with value set up
											$selectorsscss .= $selectorsscssplus;
											// appending new stuff to existing selectorscss

											$contentdefaultcssarr2[0]="\t". $selectorsscss;
											$contentdefaultcssarr[1]=implode('}',$contentdefaultcssarr2);
										} else {
											if (($dropprotokollon) && ($this->showsdebugprint==true)) {
												$this->sdebuginitprint.= 'DROP: '. json_encode($boxmodelcssarr[$i]). '<br>';
											}
										}
									}
									$contentdefaultcss=implode("\n". $selectorCSSkey,$contentdefaultcssarr);


								}

							}
						}
					}
					// and apply the correct path to the theme in the rating stars url
					$contentdefaultcss=str_replace('themes/default/','themes/' . $this->conf['theme.']['selectedTheme'] . '/',$contentdefaultcss);
					if ($contentdefaultcss!=$content) {
						file_put_contents($filenamecss, $contentdefaultcss);
					}
				}
				//sets active css to boxmodell css
				$this->boxmodelcss ='boxmodels/css/' . $filenamecssoutfile;
			} else {
				return $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.css.defaultcss', false)) . ': ' . $filenamedefaultcss;
			}
		} else {
			return $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.css.boxmodeltxt', false)) . ': ' . $filenameboxmodel;
		}
		return '';
	}

	/**
	 * Calculated an expressions value comparable to JS eval
	 *
	 * @param	string		$$mathString: String to be evaluated
	 * @return	int		value calculated
	 */
	protected function calculate_string( $mathString )    {
		$mathString = trim($mathString);     // trim white spaces
		$mathString = preg_replace('~[^0-9\(\)\-\+\*\/]~','', $mathString);    // remove any non-numbers chars; exception for math operators
		try
		{
			$compute = create_function("", "return (" . $mathString . ");" );
		}
		catch (Exception $e)
		{
			print 'Invalid formula in boxmodell: ' . $mathString .'<br>';
			return 0;
		}

		return 0 + $compute();
	}

	/**
	 * returns the subdir of current TYPO3 Installation, normally '/'
	 *
	 * @return	string		subdir of current TYPO3 Installation, normally '/'
	 */
	protected function locationHeaderUrlsubDir() {
		$parts = explode('//', t3lib_div::locationHeaderUrl('') );
		if (count($parts)>1) {
			$partafterroot=$parts[1];
			$partafterrootarr=explode('/', $partafterroot);
			unset($partafterrootarr[0]);
			$partafterroot=implode('/', $partafterrootarr);
			return '/' . $partafterroot;
		}
		return t3lib_div::locationHeaderUrl('');
	}
	/**
	 * url-name of the page
	 *
	 * @return	string		name like 'home.html'
	 */
	protected function currentPageName() {

		if (!isset($_SERVER['REQUEST_URI'])) {
			$serverrequri = $_SERVER['PHP_SELF'];
	 	} else {
	 		$serverrequri = $_SERVER['REQUEST_URI'];
	 	}
		 $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";

		 return $serverrequri;
	}
	/**
	 * Clears page cache and maintains plugin sessioncache as well as SESSION processedcachepages
	 *
	 * @param	int		$pid: page-id where the page-cache need to be dropped
	 * @param	boolean		$withplugin: if true plugins session cache is reseted as well ($_SESSION['commentListRecord'])
	 * @param	boolean		$withcache: page caqche for pid will be dropped
	 * @param	[type]		$debugstr: ...
	 * @return	void
	 */
	protected function ttclearcache ($pid, $withplugin=true, $withcache = false, $debugstr = '') {
		if ($withcache) {
			$this->initLegacyCache();

			//just maintain the processedcachepages
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf,$pid);

			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			/* @var $tce t3lib_TCEmain */
			$tce->clear_cacheCmd($pid);
			$this->sdebugprint .= 'tt clear page cache for page ' . $pid. ' triggered by "' . $debugstr . '"<br />';
		}

		if ($withplugin) {
			$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
			$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';
		}

	}
	/**
	 * Clears page cache and maintains SESSION processedcachepages
	 *
	 * @param	boolean		$forceclear: when $this->activateClearPageCache is not active, pagecache is forced to be checked
	 * @return	void
	 */
	protected function doClearCache ($forceclear=false) {
		$this->initLegacyCache();
		if (($this->activateClearPageCache) || ($forceclear)) {
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf,$GLOBALS['TSFE']->id);
			if (trim($clearCacheIds)!='') {
				$pidListarr = t3lib_div::intExplode(',', $clearCacheIds);
				$pidListarr=array_unique($pidListarr);
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');

				/* @var $tce t3lib_TCEmain */
				foreach($pidListarr as $spid) {
					if($spid != 0) {
						$tce->clear_cacheCmd($spid);
					}
				}
				$this->sdebugprint .= 'Do clear page cache for page(s) ' . $clearCacheIds. '<br />';
			}
		}
	}

	/**
	 * Reads the cache control table and returns timestamp of last modify of a plugins data
	 *
	 * @param	string		$external_ref_uid: reference to the plugin
	 * @return	int		timestamp or 0
	 */
	protected function getPluginCacheControlTstamp ($external_ref_uid) {

		$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'tstamp',
				'tx_toctoc_comments_plugincachecontrol',
				 'external_ref_uid="' . $external_ref_uid .'"',
				'',
				'',
				''
		);
		$tstamp=0;
		if (count($rowsrf)>0) {
			$tstamp=$rowsrf[0]['tstamp'];
		}
		return $tstamp;
	}
	/**
	 * Reads the fe_users table and returns timestamp of last insert
	 *
	 * @param	string		$external_ref_uid: reference to the plugin
	 * @return	int		timestamp or 0
	 */
	protected function getLastUserAdditionTstamp () {

		$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'MAX(crdate) AS tsmp',
				'tx_toctoc_comments_user',
				'toctoc_comments_user LIKE "0.0.0%"',
				'',
				'',
				''
		);
		$tstamp=0;
		if (count($rowsrf)>0) {
			$tstamp=$rowsrf[0]['tsmp'];
		}
		return $tstamp;
	}
	/**
	 * Inits cache for TYPO3 older than 4.6
	 *
	 * @return	void
	 */
	protected function initLegacyCache () {

		if (version_compare ( TYPO3_version, '4.6', '<' )) {
			t3lib_cache::initPageCache ();
			t3lib_cache::initPageSectionCache ();
		}
	}
	/**
	 * Checks rating scopes and maintains Session_cache for the scopes
	 *
	 * @return	void
	 */
	protected function check_scopes(){
		if ($this->conf['ratings.']['useScopesForVote'] != '') {
			if ($_SESSION['ratingsscopesconf'][$_SESSION['commentListRecord']] != $this->conf['ratings.']['useScopesForVote']) {
				$_SESSION['ratingsscopesconf'][$_SESSION['commentListRecord']] = $this->conf['ratings.']['useScopesForVote'];
				$wherearr = explode(',',$this->conf['ratings.']['useScopesForVote']);
				if (count($wherearr) >1) {
					$wherestr = '(uid IN (' . $this->conf['ratings.']['useScopesForVote'] . '))';
				} else {
					$wherestr = '(uid=' . $this->conf['ratings.']['useScopesForVote'] . ')';
				}

				$where = $wherestr .' AND (sys_language_uid<1) ' . $this->cObj->enableFields('tx_toctoc_ratings_scope');
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_ratings_scope.uid AS uid',
						'tx_toctoc_ratings_scope',
						$where,
						'',
						'',
						''
				);
				$useScopesForVote=array();
				for ($i=0;$i<count($rows);$i++){
					$useScopesForVote[$i]=$rows[$i]['uid'];
				}
				$where2 = $wherestr .' AND (sys_language_uid>0) ' . $this->cObj->enableFields('tx_toctoc_ratings_scope');
				$rows2 = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_ratings_scope.l18n_parent AS uid',
						'tx_toctoc_ratings_scope',
						$where2,
						'',
						'',
						''
				);
				for ($j=0;$j<count($rows2);$j++){
					$useScopesForVote[$i]=$rows2[$j]['uid'];$i++;
				}
				$useScopesForVote = array_unique($useScopesForVote);

				$this->conf['ratings.']['useScopesForVote'] = implode(',',$useScopesForVote);
				$_SESSION['ratingsscopes'][$_SESSION['commentListRecord']] = $this->conf['ratings.']['useScopesForVote'];

				// now for these find and build internal scope array
				$where2 = '((l18n_parent IN (' . $_SESSION['ratingsscopes'][$_SESSION['commentListRecord']] . ') AND sys_language_uid>0) OR (uid IN (' . $_SESSION['ratingsscopes'][$_SESSION['commentListRecord']] . ') AND sys_language_uid<=0)) ' . $this->cObj->enableFields('tx_toctoc_ratings_scope');
				$orderby= 'sys_language_uid, display_order, sorting, uid';
				$rows2 = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_ratings_scope.sys_language_uid AS sys_language_uid,
								tx_toctoc_ratings_scope.display_order AS display_order,
								tx_toctoc_ratings_scope.sorting AS sorting,
								tx_toctoc_ratings_scope.uid AS uid,
								tx_toctoc_ratings_scope.scope_title AS scope_title,
								tx_toctoc_ratings_scope.scope_description AS scope_description,
								tx_toctoc_ratings_scope.l18n_parent AS l18n_parent',
						'tx_toctoc_ratings_scope',
						$where2,
						$orderby,
						'',
						''
				);
				// merge syslang -1 into 0
				// make -1 table
				$ratingsscopesinternalm1table = array();
				// and same time make 0 table

				$j=0;
				for ($i=0;$i<count($rows2);$i++){
					if ($rows2[$i]['sys_language_uid']<= 0) {
						$ratingsscopesinternalm1table[$j]=$rows2[$i];
						$ratingsscopesinternalm1table[$j]['sys_language_uid']=0;
						$j++;
					}

				}
				asort($ratingsscopesinternalm1table);
				// for each syslang i>0
				// merge syslang 0 into i
				// merge syslang -1 into i
				$curlan=0;
				$curlanratingsscopesinternalm1table=array();
				$addlanarr=array();$addlanarr[0]=0;$a=1;
				for ($i=$j;$i<count($rows2);$i++){
					if ($rows2[$i]['sys_language_uid']> 0) {
						if ($rows2[$i]['sys_language_uid']!= $curlan) {

							$curlan=$rows2[$i]['sys_language_uid'];
							$addlanarr[$a]=$curlan;$a++;
							// take over 0 table
							$curlanratingsscopesinternalm1table[$curlan] =$ratingsscopesinternalm1table;
							for ($t=0;$t<count($curlanratingsscopesinternalm1table[$curlan]);$t++){
								$curlanratingsscopesinternalm1table[$curlan][$t]['sys_language_uid']=$curlan;
							}
						}
						// build sys_lang_table
						$parent_found=0;
						for ($t=0;$t<count($curlanratingsscopesinternalm1table[$curlan]);$t++){
							if ($curlanratingsscopesinternalm1table[$curlan][$t]['uid']==$rows2[$i]['l18n_parent']) {
								$parent_found=1;
								if ($rows2[$i]['display_order']!='') {
									$curlanratingsscopesinternalm1table[$curlan][$t]['display_order']=$rows2[$i]['display_order'];
								}
								$curlanratingsscopesinternalm1table[$curlan][$t]['scope_title']=$rows2[$i]['scope_title'];
								$curlanratingsscopesinternalm1table[$curlan][$t]['scope_description']=$rows2[$i]['scope_description'];
								$curlanratingsscopesinternalm1table[$curlan][$t]['sorting']=$rows2[$i]['sorting'];
							}
						}
						if ($parent_found==0) {
							//append it
							$curlanratingsscopesinternalm1table[$curlan][$t]=$rows2[$i];
						}

					}
				}
				//append i table to 0 table
				for ($t=0;$t<count($addlanarr);$t++){
					for ($u=0;$u<count($curlanratingsscopesinternalm1table[$addlanarr[$t]]);$u++){
						$ratingsscopesinternalm1table[$j]=$curlanratingsscopesinternalm1table[$addlanarr[$t]][$u];
						$j++;
					}
				}
				asort($ratingsscopesinternalm1table);
				$_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']]=$ratingsscopesinternalm1table;
				$_SESSION['ratingsscopesinternalm1tablelan'][$_SESSION['commentListRecord']]=$addlanarr;
			} else {
				$this->conf['ratings.']['useScopesForVote'] = $_SESSION['ratingsscopes'][$_SESSION['commentListRecord']];
			}
		}
	}
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']);
}

?>