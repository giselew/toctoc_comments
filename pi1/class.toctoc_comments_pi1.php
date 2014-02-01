<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Gisele Wendl <gisele.wendl@toctoc.ch>
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
* Commenting system.
*
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   75: class tx_toctoccomments_pi1 extends tslib_pibase
 *  127:     public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = null)
 *  978:     protected function checkJSLoc()
 * 1041:     protected function checkCSSTheme()
 * 1129:     protected function checkCSSLoc()
 * 1209:     protected function initprefixToTableMap()
 * 1241:     function init()
 * 1490:     function mergeConfiguration()
 * 1647:     function fetchConfigValue($param)
 * 1670:     function createLinks($text)
 * 1689:     function applyStdWrap($text, $stdWrapName)
 * 1701:     protected function ae_detect_ie()
 * 1720:     protected function boxmodel()
 * 2051:     protected function calculate_string( $mathString )
 *
 * TOTAL FUNCTIONS: 13
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
 * Commenting system
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
	var $pi_checkCHash = true;				// Required for proper caching! See in the typo3/sysext/cms/tslib/class.tslib_pibase.php
	var $externalUid;						// UID of external record
	var $showUidParam = 'showUid';			// Name of 'showUid' GET parameter (different for tt_news!)
	var $where;								// SQL WHERE for records
	var $where_dpck;						// SQL WHERE for double post checks
	var $templateCode;						// Full template code
	var $foreignTableName;					// Table name of the record we comment on
	var $formValidationErrors = array();	// Array of form validation errors
	var $formTopMessage = '';				// This message is displayed in the top of the form

	var $templavoila_field = 'field_content';  // Name of the TemplaVoila Field which hold the MainContent
	var $MainColPos = 0;					   // colPos of the MainArea where the comments plugin goes
	var $maxtimeafterinsert = 599;			   // time in milliseconds the system waits until considering a submit as new total transaction
											   //    insert, header and then show the plugins of the page
	var $tERROR_CAPCHA = '';				   // the Text for a capcha error needs to be held in a classattibute
	var $widthExtCapcha = '110';			   // the width of the image if "captcha" is selected as extension

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
	/**
	 * Main function of the plugin
	 *
	 * @param	string		$content	Content (unused)
	 * @param	array		$conf	TS configuration of the extension
	 * @param	string		$hookTablePrefix: ...
	 * @param	int		$hookId: ...
	 * @param	obj		$hookcObj: ...
	 * @return	void
	 */
	public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = null) {

		$this->conf = $conf;

		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
/* 		We choose to use PHP-Sessions instead of TYPO3-sessions
 * 		The TYPO3-sessions work well from page call to page call, but inside page generation these sessions are
 * 		not suitable, because they committ only after the page has been generated,
 * 		which is definetely to slow to pass session-information in contentelement rendering
 *
 *
 */
		session_name('sess_' . $this->extKey);
		session_start();

		$this->lib = new toctoc_comment_lib;
		$this->lib->fixLL($this->conf);

		$this->pi_loadLL();
		// check plugin
		$this->boxmodelcss ='tx-tc30.css';
		$this->pi_initPIflexForm();
		$isPlugin=0;
		$this->fetchConfigValue('optionalRecordId');
		$this->fetchConfigValue('externalPrefix');
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

		// Size of Form Inputfields


		$this->boxmodelTextareaHeight=intval($this->conf['theme.']['boxmodelTextareaLineHeight'])*intval($this->conf['theme.']['boxmodelTextareaNbrLines']);
		$this->boxmodelTextareaAreaTotalHeight=4 + $this->boxmodelTextareaHeight  + (2 * intval($this->conf['theme.']['boxmodelSpacing']));
		$this->communityFriendsProfileListAccessright = $this->conf['advanced.']['communityProfileCommentsVisibility'];
		unset ($this->conf['advanced.']['communityProfileCommentsVisibility']); // dont need it anymore, free some place in $conf
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
				if ($this->conf['externalPrefix'] != 'pages'){

						if($recordtable != $rows[0]['pi1_table']) {
							if ($recordtable != 'tt_content'){
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
									// did relly not find an external prefix for this record ...

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
				if ($this->conf['externalPrefix'] != 'pages'){
					if ($recordtable != 'tt_content'){
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
							// did relly not find an external prefix for this record ...
							return sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->lib->pi_getLLWrap($this, 'error.prefix.table', false) . '</p></div>', $this->conf['optionalRecordId']);
						}
					}
				}
			}

		}
		if ($conf['additionalClearCachePagesLocal'] != '') {
			$arraddpgTS=explode(',',$conf['additionalClearCachePagesLocal'] );
			$arraddpg=explode(',',$conf['additionalClearCachePages'] );
			$arraddpgout=array_merge($arraddpg,$arraddpgTS);
			$conf['additionalClearCachePages']=implode(',',$arraddpgout);
		}
		if ($this->conf['optionalRecordId'] != '') {
			$arrwithid=explode('_',$this->conf['optionalRecordId']);
			$triggeredRecordId=$arrwithid[count($arrwithid)-1];
			unset($arrwithid[count($arrwithid)-1]);
			$triggeredRecord=implode('_',$arrwithid);
			unset($this->conf['optionalRecordId']);
			$isPlugin=1;
			$_SESSION['commentListCount']=0;
			if ($this->conf['externalPrefix'] != 'pages'){
				if ($triggeredRecord != 'tt_content'){
					$hookTablePrefix=$this->conf['externalPrefix'];
					$hookId=$triggeredRecordId;
				} else {
					$triggeredRecordId = 0;
				}
			}
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
			$hookTablePrefix = '';//print $isPlugin . ' - ' . $this->lhookId;exit;
		}
		if ($this->conf['commentsreport.']['active']) {
			$conftx_commentsreport = $this->conf['commentsreport.'];
			$this->conf['tx_commentsreport_pi1.']['reportPid']=$conftx_commentsreport['reportPid'];
			$conflink = array(
					// Link to current page
					'parameter' => $conftx_commentsreport['reportPid'],
					// Set additional parameters
					'additionaParams' => '',
					// We must add cHash because we use parameters
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
		if ($this->conf['minCommentLength'] >$this->conf['maxCommentLength']){
			$this->conf['maxCommentLength']=$this->conf['minCommentLength']+1;
		}
		if ($this->conf['UserImageSize'] >96){
			$this->conf['UserImageSize']=96;
		}
		if ($this->conf['UserImageSize'] <18){
			$this->conf['UserImageSize']=18;
		}
		if ($this->conf['advanced.']['commentsEditBack'] >50){
			$this->conf['advanced.']['commentsEditBack']=50;
		}

		$_SESSION['started'] = (!isset($_SESSION['started']) ? 0 : 1);

		if ($_SESSION['started'] == 0) {
		// brand new session: Init almost all session vars
			$this->lib->resetSessionVars(0);
			$_SESSION['commentListIndex'] = array();
			$_SESSION['timeintensivedbaction'] = '0';
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
		/*
		 * with 'edgeTime' we setup sort of beginn and end of the !entire! process where
		 * session variables are not reinitialized again, after this time they can be reset.
		 * This is just data-hygienics
		 *
		 * More important is 'timeintensivdbaction'
		 * it gives the boolean state weather the insert or delete-process is active or not
		 * This process includes 2 page-calls. In the 2nd call (comment display and form result)
		 * this variable indicates that the code should lookout for the CID where the process was started from
		 * :-) It looks more difficult than it actually is :-)
		 *
		 */

		if ($_SESSION['timeintensivedbaction'] == '1') {
			$this->lib->resetSessionVars(2);
			$_SESSION['timeintensivedbaction'] = '0';
		}
		else {
			if ($tdiff > $this->maxtimeafterinsert) {
				$this->lib->resetSessionVars(0);

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
		if ($_SESSION['commentsPageId'] != $GLOBALS['TSFE']->id){
			// new page
			// store request url for eID

			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf);
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($clearCacheIds);
			$this->lib->resetSessionVars(0);
			$_SESSION['commentListIndex'] = array();

		} elseif ($_SESSION['activelang'] != $GLOBALS['TSFE']->lang) {
			// language change
			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf);
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($clearCacheIds);

			$this->lib->resetSessionVars(0);
			$_SESSION['commentListIndex'] = array();
			$_SESSION['activelang'] =$GLOBALS['TSFE']->lang;
			$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;
		} elseif ($_SESSION['feuserid'] != $GLOBALS['TSFE']->fe_user->user['uid']) {
			// User has made a logon or logout
			if ($GLOBALS['TSFE']->fe_user->user['uid']>0) {
				$_SESSION['feuserid'] =0;
			}

			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf);
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($clearCacheIds);

		} elseif ($_SESSION['commentsSorting'] != $this->conf['advanced.']['reverseSorting']) {
			// Admin made change in TS-Setup, here just clear the cache if not already done

			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf);
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($clearCacheIds);
		} else {
			// you can carry on my friend :-)
		}
		if (($_SESSION['feuserid'] == '')) {
			$_SESSION['feuserid'] = 0;
		}

		$_SESSION['lastpreviewid']=0;

		if ($_GET['toctoc_comments_pi1']['anchor']) {
			if (!$_SESSION['findanchorok'] == '1'){
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
		$wherettcontentNoTV = " (colPos = " . $this->conf['advanced.']['UseMainColPos'] . " AND CType = 'list' AND deleted=0 AND hidden=0 AND list_type = 'toctoc_comments_pi1') " ;
		$ttcontentsortNoTV = 'sorting';

		// Check if TS template was included
		if (!isset($conf['advanced.'])) {
			// TS template is not included
			return '<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', false) . ': ' . $this->lib->pi_getLLWrap($this, 'error.no.ts.template', false)) . '</p></div>';
		}

		// Initialize
		$communitydisplaylist = $this->init();
		if ($communitydisplaylist==false){
			return '';
		}

		if (!$this->foreignTableName) {
			return sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->lib->pi_getLLWrap($this, 'error.undefined.foreign.table', false)  . '</p></div>', $this->prefixId, $this->conf['externalPrefix']);
		}
		if ($_SESSION['commentListCount']==0) {
			// do this only at the start of the session, the vars are then kept in seession vars
			// to optimize DB-IOs

			if (t3lib_extMgm::isLoaded('templavoila')) {
				// no sorting in tt_content needed for TV CIDs
				// Templavoila stores the sequence of its CID in the Flexform XML on table 'pages'
				$rowscidflex = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, tx_templavoila_flex',
						'pages', $wherecid);

				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($rowscidflex)) {
					$flexData = t3lib_div::xml2array($row['tx_templavoila_flex']);
				}
				if ($this->conf['advanced.']['UseTemplavoilaField'] == '') {
					// If the option is badly set
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
				$wherettcontent = "((CType = 'templavoila_pi1' AND deleted=0 AND hidden=0 AND pid = " . strval($GLOBALS['TSFE']->id) . $templavoilads. ')' . ' OR ' . $wherettcontentNoTV . ')';

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

			}

			else {
				// simply sorted by sorting and its ok
				$wherettcontentNoTV .=  'AND pid = ' . strval($GLOBALS['TSFE']->id);
				$wherettcontent = $wherettcontentNoTV;
			}
			$rowsttcntcidflex = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'uid,pid',
					'tt_content',
					$wherettcontent,
					$ttcontentsortNoTV
					#'',
					#''
			);

			$tv_comments_cidstr='';
			if (array_key_exists(0, $rowsttcntcidflex) && array_key_exists('uid', $rowsttcntcidflex[0])) {
				foreach ($rowsttcntcidflex as $row) {
					$tv_comments_cidstr= $tv_comments_cidstr . $row['uid'] . ',' ;
					$virginLastcid=$row['uid'];
				}
			}
			$tv_comments_cidstr= $tv_comments_cidstr . '' ;
			$tv_comments_cid = explode(',', $tv_comments_cidstr);
			unset($tv_comments_cid[count($tv_comments_cid)-1]);
			// $tv_comments_cid enth�lt Array mit CIDs der templavoilas mit Commentplugin
			if (!t3lib_extMgm::isLoaded('templavoila')) {
				$rowscidflex= $tv_comments_cid;
			}
			$_SESSION['rowscidflex']=$rowscidflex;
			$_SESSION['tv_comments_cid']=$tv_comments_cid;
		}
		$cid_hook=0;
		if ($this->lhookTablePrefix !='') {
			//if the plugin is called from tt_news-hook we add insert new records in the plugins-list arrays.
			// the records get a artificial id: tt_content_100000 + newid

			if ($this->lhookTablePrefix !='tt_content') {
				$cid_hookpp= 100000 + $GLOBALS['TSFE']->id;
				$cid_hook= intval($cid_hookpp . $hookId);
			} else
			{
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

				$i++;


				$cidwrk[$i]=$cid_hook;
				for ($i=$ji;$i<count($_SESSION['rowscidflex']);$i++) {
					if ($_SESSION['rowscidflex'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['rowscidflex'][$i];

					}
				}
				//print $i . ' - ' . $w;exit;
				$_SESSION['rowscidflex']=$cidwrk;
				ksort($_SESSION['rowscidflex']);


				$cidwrk=array();
				for ($i=0;$i<$_SESSION['indexOfSortedCommentsCidList'];$i++) {
					if ($_SESSION['tv_comments_cid'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['tv_comments_cid'][$i];

					}
				}
				$ji=$i;
				$i++;

				$cidwrk[$i]=$cid_hook;
				for ($i=$ji;$i<count($_SESSION['tv_comments_cid']);$i++) {
					if ($_SESSION['tv_comments_cid'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['tv_comments_cid'][$i];

					}
				}
				$_SESSION['tv_comments_cid']=$cidwrk;
				ksort($_SESSION['tv_comments_cid']);

				$_SESSION['indexOfSortedCommentsCidList']=$_SESSION['indexOfSortedCommentsCidList']+1;
				$incrementlistcid=0;
			} else {
				$incrementlistcid=1;
			}

		} else {
			$incrementlistcid=1;
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
		$errornocidfound=false;
		while ($wrki==0){
			$lidx=$_SESSION['indexOfSortedCommentsCidList'];
			foreach ($wrktv_comments_cid as $searchrow){
				if ($searchrow==$wrkrowscidflex[$lidx]){
					//found the bugger
					$wrki=1;
					$commentlistcountout = $wrkrowscidflex[$lidx];
				}
			}
			$_SESSION['indexOfSortedCommentsCidList']=$_SESSION['indexOfSortedCommentsCidList'] +$incrementlistcid;
			if ($_SESSION['indexOfSortedCommentsCidList']>count($wrkrowscidflex)){
				$wrki=1;
				$errornocidfound=true;
				$commentlistcountout = 99;
				$_SESSION['indexOfSortedCommentsCidList']=$lastindexOfSortedCommentsCidList;
			}
		}

		/*
		 * Here is the CID of the Comment-Plugin that is currently being rendered.
		 */

		$_SESSION['commentListCount']=$commentlistcountout;

		if (($this->lhookTablePrefix !='') && ($isPlugin==1)) {
			$_SESSION['commentListCount']=$cid_hook;
			$_SESSION['commentListRecord']='tt_content_' . $_SESSION['commentListCount'];
		}

		if (($this->lhookTablePrefix == '') && ($this->conf['externalPrefix'] == 'pages')) {
			$_SESSION['commentListRecord']='tt_content_' . $_SESSION['commentListCount'];
		}

		if (($this->lhookTablePrefix == '') && ($errornocidfound==true) && (intval($this->conf['pluginmode'])==0)) {
			// The Contentelement ID containing the plugin could not be found automatically.
			return sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->lib->pi_getLLWrap($this, 'error.automaticcidfail', false)  . '</p></div>', $this->conf['advanced.']['UseMainColPos'], $this->conf['advanced.']['UseTemplavoilaField']);
		}

		if ($_SESSION['commentsSorting'] != $this->conf['advanced.']['reverseSorting']) {
			// clear the sort array of the cid
			$_SESSION['commentsSorting'] = $this->conf['advanced.']['reverseSorting'];
			unset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]);
		}

		// the viginity-checks for freshly updated 1.5.4. versions of comments
		if  ($this->extConf['updateMode']) {

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

						$dataWhereStats = 'pid=' . intval($conf['storagePid']) .
						' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';

						$sqlstr = 'SELECT COUNT(uid) AS nbrentries FROM tx_toctoc_comments_comments WHERE ' . $dataWhereStats;
						$resultcount = mysql_query($sqlstr);
						$rowStats = mysql_fetch_array($resultcount);

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
					//'tx_comments_comments_'
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
		}

		$content = '';
		$this->checkJSLoc();
		$this->checkCSSLoc();
		$ckeckresult=$this->checkCSSTheme();
		if ($ckeckresult!=''){
			return $ckeckresult;
		}

		if ($this->conf['pluginmode'] == '') {
			return $this->lib->maincomments($this->ref, $this->conf, false, $_SESSION['commentsPageId'], $_SESSION['feuserid'] , 'commentdisplay', $this, $this->piVars);

		} elseif ($this->conf['pluginmode'] == 1) {
			return $this->lib->getRecentComments($this, $this->conf,$_SESSION['feuserid']);

		} elseif ($this->conf['pluginmode'] == 2) {
			$content='';
			$this->pi_setPiVarDefaults();
			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!

			return $this->lib->mainReport($content, $this->conf, $this,$this->piVars);
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
		$jscontent .= 'var textErrCommentNull = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.texterrornull', false)) . '";' . "\n";
		$jscontent .= 'var textSaveComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.savecomment', false)) . '";' . "\n";
		$jscontent .= 'var textCancelEditComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.canceleditcomment', false)) . '";' . "\n";
		$jscontent .= 'var textEditComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.editlink', false)) . '";' . "\n";
		$jscontent .= 'var confuserpicsize = ' . intval($this->conf['UserImageSize']) . ';' . "\n";
		$jscontent .= 'var boxmodelTextareaAreaTotalHeight = ' . intval($this->boxmodelTextareaAreaTotalHeight) . ';' . "\n";
		$jscontent .= 'var boxmodelTextareaHeight = ' . intval($this->boxmodelTextareaHeight) . ';' . "\n";
		$jscontent .= 'var boxmodelLabelWidth = ' . intval($this->conf['theme.']['boxmodelLabelWidth']) . ';' . "\n";
		$jscontent .= 'var boxmodelSpacing	 = ' . intval($this->conf['theme.']['boxmodelSpacing']) . ';' . "\n";
		$jscontent .= 'var confcommentsPerPage = ' . intval($this->conf['advanced.']['commentsPerPage']) . ';' . "\n";
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
		$jscontent .= 'var pathim = "' . base64_encode($GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path']) . '";' . "\n";
		$jscontent .= 'var textmessagecannotdelete = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmessagecannotdelete', false)) . '";' . "\n";
		$jscontent .= 'var textmessagecannotinsert = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmessagecannotinsert', false)) . '";' . "\n";



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

			$filenamecssfile='tx-tc30-theme.css';
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
		// no need anymore for this now
		unset($this->conf['theme.']['themeFontFamily']);
	}

	/**
	 * Checks if the CSS-File for config-dependent values (UserImageSize) exists and if not creates it.
	 *
	 * @return	void
	 */
	protected function checkCSSLoc() {
		$filenamecss='tx-tc-conf' . str_replace('.txt','',$this->conf['theme.']['selectedBoxmodel']) . '.css';

		$dirsep=DIRECTORY_SEPARATOR;
		if (substr($_SERVER['DOCUMENT_ROOT'], strlen($_SERVER['DOCUMENT_ROOT'])-1,1) == DIRECTORY_SEPARATOR) {
			$dirsep='';
		}
		$txdirname= str_replace('/',DIRECTORY_SEPARATOR,$_SERVER['DOCUMENT_ROOT'] . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/' );
		$filenamecss=$txdirname . $filenamecss;
		$unlinked=false;
		///$unlinked=true;
		$contentnow='';
		if (file_exists($filenamecss)) {
			$contentnow = file_get_contents($filenamecss);

		}
		$marginpiccomment = 0;
		if ($this->conf['theme.']['selectedBoxmodel'] == 'boxmodel_koogle.txt') {
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
.tx-tc-pi1 .tx-tc-cts-form-fieldtextarea-1 {
	min-height: ' . (intval($this->conf['UserImageSize'])) .'px;
}' . "\n";

		// Write the contents back to the file if changes
		if ($contentnow!=$csscontent) {
			file_put_contents($filenamecss, $csscontent);

			//clear page cache
			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf);
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($clearCacheIds);
		}

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
	function init() {
		$this->initprefixToTableMap();

		$this->mergeConfiguration();
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
				$rowstt = array();
				$rowstt = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tt_content.uid AS uid, pages.uid AS pid',
						'tt_content, pages',
						$origidswhere,
						'tt_content.sys_language_uid'
						);
				if (count($rowstt)>0){
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
						$conflink = array(
								'useCacheHash'     => 1,
								'no_cache'         => 0,
								'parameter'        => $profilepage,
								'additionalParams' => t3lib_div::implodeArrayForUrl('',$params,'',1),
								'ATagParams' => 'rel="nofollow"',
						);
						$_SESSION['communityprofilepage']= $this->cObj->typoLink('dummy', $conflink);
						$_SESSION['communityprofilepageparams']='';
						if (strpos($_SESSION['communityprofilepage'], '9999999')===false) {
							$conflink = array(
									'useCacheHash'     => 1,
									'no_cache'         => 0,
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
					//print_r ($confcommunity);
					//print htmlspecialchars($_SESSION['communityprofilepage']) .': ' . $_SESSION['communityprofilepageparams']; exit;

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
						//print $this->externalUid ;exit;

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

		}
		else {
			// We are commenting normally
			$this->externalUid = $GLOBALS['TSFE']->id;
			$this->foreignTableName = 'pages';
			$this->showUidParam = '';
			// $_SESSION['commentListRecord'] will be set later after the selection of $_SESSION['commentListIndex']
		}

		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$this->conf['templateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
		$this->templateCode = $this->cObj->fileResource($usetemplateFile);

		$key = 'EXT:toctoc_comments_' . md5($this->templateCode);
		if (!isset($GLOBALS['TSFE']->additionalHeaderData[$key])) {
			$headerParts = $this->cObj->getSubpart($this->templateCode, '###HEADER_ADDITIONS###');
			if ($headerParts) {

				if ($this->conf['ratings.']['additionalCSS']) {
					$subSubPart = $this->cObj->getSubpart($this->templateCode, '###ADDITIONAL_CSS###');
					$subParts['###ADDITIONAL_CSS###'] = trim($this->cObj->substituteMarker($subSubPart,
							'###CSS_FILE###', $GLOBALS['TSFE']->tmpl->getFileName($this->conf['ratings.']['additionalCSS'])));
				}
				else {
					$subParts['###ADDITIONAL_CSS###'] = '';
				}

				$this->boxmodel();

				$lancode= $_SESSION['activelang'];
				if ($this->conf['theme.']['selectedBoxmodel'] !='') {
					$lancode=str_replace('.txt','-',$this->conf['theme.']['selectedBoxmodel']) . $_SESSION['activelang'];
				}
				//$GLOBALS['TSFE']->additionalHeaderData[$key] =
				$headerParts = $this->cObj->substituteMarkerArrayCached($headerParts, array(
						'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
						'###LANCODE###' => $lancode,
						'###THEME###' => $this->conf['theme.']['selectedTheme'],
						'###BOXMODEL###' => $this->boxmodelcss,
						'###BOXMODELCONF###' => 'tx-tc-conf' . str_replace('.txt','', $this->conf['theme.']['selectedBoxmodel']) . '.css',
				), $subParts);
				$GLOBALS['TSFE']->additionalHeaderData[$key] = $headerParts;
			}
		}
		// We are commenting on cid
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($this->conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['storagePid']);
		}
		if ($this->conf['externalPrefix']=='pages') {
			/* $this->where_dpck = 'external_prefix=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->conf['externalPrefix'], 'tx_toctoc_comments_comments') .
			' AND ' . ($tmpint ?
					'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
					$this->cObj->enableFields('tx_toctoc_comments_comments');
		 */
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
		//print $this->where;exit;

		$this->ref=$this->foreignTableName . '_' . $this->externalUid;
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

		$this->fetchConfigValue('userStats');

		$this->fetchConfigValue('advanced.commentingClosed');
		$this->fetchConfigValue('advanced.closeCommentsAfter');
		$this->fetchConfigValue('advanced.useSharing');
		$this->fetchConfigValue('advanced.dontUseSharingFacebook');
		$this->fetchConfigValue('advanced.dontUseSharingGoogle');
		$this->fetchConfigValue('advanced.dontUseSharingTwitter');
		$this->fetchConfigValue('advanced.dontUseSharingLinkedIn');
		$this->fetchConfigValue('advanced.dontUseSharingStumbleupon');


		$this->fetchConfigValue('ratings.enableRatings');
		$this->fetchConfigValue('ratings.ratingsTemplateFile');
		$this->fetchConfigValue('ratings.useMyVote');
		$this->fetchConfigValue('ratings.useVotes');
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
					if ($this->conf['pluginmode']==0) {
						$this->conf['advanced.']['recentcommentsPluginpages']='';
						$this->conf['advanced.']['recentcommentsPluginRecords']='';
					}
			} else {
				//$this->fetchConfigValue('recentcommentsPluginpages');
				//$this->fetchConfigValue('recentcommentsPluginRecords');
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
	protected function ae_detect_ie(){

		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
			// its IE
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 1') !== false) {
				// its IE 10 to 19 (or 1 if you want...)
				return false;
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
	 * @return	string		optional error message
	 */
	protected function boxmodel(){
		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

		$filenameboxmodel=$this->conf['theme.']['selectedBoxmodel']; //'boxmodel.txt'

		$txdirnameboxmodel= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/' );
		$filenameboxmodel=$txdirnameboxmodel . $filenameboxmodel;
		$txdirnameboxmodelsystem= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/system/' );
		$filenameboxmodelsystem=$txdirnameboxmodelsystem . 'boxmodel_system.txt';

		$filenamecssfile='tx-tc30.css';
		if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
			$filenamecssoutfile='tx-tc30-' . str_replace('.txt','',$this->conf['theme.']['selectedBoxmodel']) .'.css';
		} else {
			$filenamecssoutfile='tx-tc30-system.css';
		}

		$txdirname= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/css/' );
		$filenamecss=$txdirname . $filenamecssoutfile;

		$txdirnamedefault= str_replace('/',DIRECTORY_SEPARATOR,str_replace($repstr,'',dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/' );
		$filenamedefaultcss=$txdirnamedefault . $filenamecssfile;

		$printstr='';
		$content ='';
		if (file_exists($filenamecss)) {
			$content = file_get_contents($filenamecss);
		}
		if (file_exists($filenameboxmodelsystem)) {
			$boxmodelarr = file($filenameboxmodelsystem);
			$nbrfilestoprocess=1;
			if (file_exists($filenameboxmodel)) {
				$nbrfilestoprocess=2; //troet!
			}
			if (file_exists($filenamedefaultcss)) {

				$contentdefaultcss = file_get_contents($filenamedefaultcss);
				for ($ifile=0;$ifile<$nbrfilestoprocess;$ifile++) {
					if ($ifile==1) {
						$boxmodelarr=file($filenameboxmodel);
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
							if ($i_boxmodel>0) {
								///print_r($boxmodelcssarr[$i_boxmodel-1]['selectorCSSkey']);
								///print '<br>(selectorCSSkey)<br>';
							}
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
						} elseif (($parsestate== 'CSS')){

							$i_boxmodelCSS=$i_boxmodelCSS+2;
							$boxmodelcssarrtmp=explode(':',$boxmodelarr[$i]);
							$boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS]=$boxmodelcssarrtmp[0];
							$boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS+1]=$boxmodelcssarrtmp[1];
							///print '<br>>>boxmodelcssarr[ ' . $i_boxmodel . '][CSS][' . ($i_boxmodelCSS + 1) . ']: ' . $boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS+1] .'<br>';
							$parsestate = 'CSS2';


						} elseif ($parsestate== 'CSS2') {

							$boxmodelcssarr[$i_boxmodel]['CSS2']=explode(':',$boxmodelarr[$i]);

							$boxmodelsrulesarr[$i_boxmodel]=array();
							$boxmodelsrulesarr[$i_boxmodel]['boxmodel'] =$i_boxmodel;
							$boxmodelsrulesarr[$i_boxmodel]['fullrule'] =$boxmodelcssarr[$i_boxmodel]['CSS2'][$i_boxmodelCSS+1]; // {2}px
							$boxmodelsrulesarr[$i_boxmodel]['selector'] =$boxmodelcssarr[$i_boxmodel]['CSS2'][$i_boxmodelCSS]; // border-width
							$boxmodelsrulesarr[$i_boxmodel]['fullruleeval'] ='';
							///print '<br>$boxmodelsrulesarr[ ' . $i_boxmodel . ']: ' . print_r($boxmodelsrulesarr[$i_boxmodel]) .'<br>';
							$parsestate = 'CSS';

							$i_rules++;
						} elseif ($parsestate== 'Rules') {
							$boxmodelsrulesarr[$i_boxmodel]=array();
							$boxmodelsrulesarr[$i_boxmodel]['boxmodel'] =$i_boxmodel;
							$boxmodelsrulesarr[$i_boxmodel]['fullruleeval'] =$boxmodelarr[$i]; //{3} = {1} + {2}+ 30

							///print '<br>$boxmodelsrulesarr[ ' . $i_boxmodel . ']: ' . print_r($boxmodelsrulesarr[$i_boxmodel]) .'<br>';
							$i_rules++;

						} elseif ($parsestate== 'Selectors') {
							$boxmodelcssarr[$i_boxmodel]['selectorCSSkey'][$i_selector]=$boxmodelarr[$i];
							$i_selector++;

						}
					}
					//now the 2 boxmodel arrays are there: one with rules, the other with data to process

					// 1. apply rules on data-array
					///print'count boxmodelsrulesarr: '. count($boxmodelsrulesarr). '<br>';
					///print'count $boxmodelcssarr: '. count($boxmodelcssarr). '<br>';
					for ($i=0;$i<count($boxmodelsrulesarr);$i++) {

						// get the value to replace

						///print '<br>xxx count: ' .count($boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2']);
						$replrightarr= explode('}',$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);  // xxx{2 , px;
						$replright=$replrightarr[1]; // px;
						$replleftarr= explode('{',$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);   // xxx   2}px;
						$replleft=$replrightarr[0]; // xxx
						$varrighttrimedarr= explode($replright,$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS'][1]); // xxx170 ,
						$varrighttrimed=implode('',$varrighttrimedarr); // xxx170

						$vartrimed=intval($varrighttrimed); // if not int -> 0

						if ($replleft !='') {
							// xxx
							$varlefttrimedarr= explode($replleft,$varrighttrimed); // xxx170
							$vartrimed=$varlefttrimedarr[0];		// 170
						}
						$boxmodelsrulesarr[$i]['varval']=$vartrimed;
						//$varnamearr= explode('{',$boxmodelcssarr[$i]['CSS2'][1]);  // xxx  2}px;
						$varnamearr= explode('{',$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);  // xxx  2}px;
						$varnamearr2=explode('}',$varnamearr[1]); // 2   px;
						$boxmodelsrulesarr[$i]['varname']=trim($varnamearr2[0]);
						if (intval($boxmodelsrulesarr[$i]['varname'])==0){
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
							///print_r($boxmodelsrulesarr[$i]);
							///print '<br>';
						if ($boxmodelsrulesarr[$i]['fullruleeval'] != '') {
							// set the values in the formula
							$rulevarnamepartevalpartarr= explode('=',$boxmodelsrulesarr[$i]['fullruleeval'] );
							///print_r($rulevarnamepartevalpartarr);
							$varpart=  trim($rulevarnamepartevalpartarr[0]); // {3}
							$evalpart=  trim($rulevarnamepartevalpartarr[1]); // {1} + {2} + 30

							for ($j=0;$j<count($boxmodelsrulesarr);$j++) {
								if ($boxmodelsrulesarr[$j]['varname']=='boxmodelTextareaLineHeight') {
									$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['theme.']['boxmodelTextareaLineHeight'],$evalpart);
								} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelTextareaHeight') {
									$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->boxmodelTextareaHeight,$evalpart);
								} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelSpacing') {
									$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', intval($this->conf['theme.']['boxmodelSpacing']),$evalpart);
									///print '<br>$boxmodelSpacing2: ';intval($this->conf['theme.']['boxmodelSpacing']);
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
								///print '<br>varname: ' . $boxmodelsrulesarr[$j]['varname'];
							}// 170 + 40 + 30

							///print '<br>$evalpart: ';
							///print $evalpart;
							$boxmodelsrulesarr[$i]['varname']=str_replace('{','',str_replace('}','',$varpart)); // 3
							$boxmodelsrulesarr[$i]['varval']= $this->calculate_string($evalpart);  //240
							///print '<br>';
							///print_r($boxmodelsrulesarr[$i]);
							///print '<br>';
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
								///print '<br>$boxmodelcssarr[' .$i . '][CSS2][' . $c . ']: ';
								///print_r ($boxmodelcssarr[$i]['CSS2'][' . $c . ']);
								///print '<br>$boxmodelcssarr[' .$i . '][CSS][' . $c . ']: ';
								///print_r ($boxmodelcssarr[$i]['CSS'][' . $c . ']);

								$boxmodelcssarr[$i]['CSS'][$c]=$boxmodelcssarr[$i]['CSS2'][$c];
								///print '<br>final boxmodelcssarr[' .$i . '][CSS][' . $c . ']: ';
								///print_r ($boxmodelcssarr[$i]['CSS'][$c]);

							}
						}
					}


					// So now all the CSS  in the data-array are ready to be checked against the CSS file

					//spilt CSS on seletor and subsequent '}'
					///print '<br>$contentdefaultcss: ' . $contentdefaultcss;
					for ($i=0;$i<count($boxmodelcssarr);$i++) {

						for ($j=0;$j<count($boxmodelcssarr[$i]['selectorCSSkey']);$j++) {
							$selectorCSSkey= trim($boxmodelcssarr[$i]['selectorCSSkey'][$j]) . ' {';
						///print '<br>$selectorCSSkey: ' . $selectorCSSkey;
							for ($c=0;$c<count($boxmodelcssarr[$i]['CSS']);$c=$c+2) {
								$d=$c+1;
								// take the selector to work on and isolate it from default CSS
								$contentdefaultcssarr = explode("\n". $selectorCSSkey, $contentdefaultcss);
								///print '<br>$count($contentdefaultcssarr): ' . count($contentdefaultcssarr);
								$contentdefaultcssarr2= explode('}',$contentdefaultcssarr[1]);
								$selectorsscss= $contentdefaultcssarr2[0];
								// isolation done

								///print '<br>1selectorsscss: ' . $selectorsscss . '<br>   $boxmodelcssarr[' .$i. '][CSS]['.$c.'] ' . $boxmodelcssarr[$i]['CSS'][$c];


								// find property $boxmodelcssarr[$i]['CSS2'][0] in the selector
								$boxmodelcssarr[$i]['CSS'][$d]=str_replace(';','',$boxmodelcssarr[$i]['CSS'][$d]);
								$selectorsscssarr= explode("\t" . $boxmodelcssarr[$i]['CSS'][$c] .":",$selectorsscss);
								if (count($selectorsscssarr)>1) {
									// property was found now we replace its content

									$selectorsscssarr2= explode(';',$selectorsscssarr[1]);
									///print '<br>$boxmodelcssarr['.$i.'][CSS]['.$d .']: ' . $boxmodelcssarr[$i]['CSS'][$d];
									///print '<br>$selectorsscssarr2: ' . $selectorsscssarr2[0];

									$selectorsscssarr2[0]=$boxmodelcssarr[$i]['CSS'][$d];
									//and implode back

									$selectorsscssarr[1]=implode(';',$selectorsscssarr2);
									$selectorsscssarr[1]=str_replace("\r\n" . ';', ';' , $selectorsscssarr[1]);
									$selectorsscssarr[1]=str_replace("\n" . ';', ';' , $selectorsscssarr[1]);
									///print '<br>HHH$selectorsscssarr[1]: ' . $selectorsscssarr[1];
									$selectorsscss=implode( "\t".$boxmodelcssarr[$i]['CSS'][$c] .':',$selectorsscssarr);
									///print '<br>2	selectorsscss: ' . $selectorsscss . '<br>   $boxmodelcssarr[' .$i. '][CSS]['.$c.'] ' . $boxmodelcssarr[$i]['CSS'][$c];
									$contentdefaultcssarr2[0]="\t". $selectorsscss;
									$contentdefaultcssarr[1]=implode('}',$contentdefaultcssarr2);
									///print '<br>$contentdefaultcss: ' . implode($selectorCSSkey,$contentdefaultcssarr);
									///exit;
								} else {
									// property was not, we check for a leading '+' in the property string
									// if present we add the property (without the '+' to the selector
									if (substr($boxmodelcssarr[$i]['CSS'][$c],0,1) == '+') {
										$selectorsscssplus = "\t" . substr($boxmodelcssarr[$i]['CSS'][$c],1).":" . $boxmodelcssarr[$i]['CSS'][$d] . ";\n";
										$selectorsscssplus =str_replace("\r\n" . ';', ';' , $selectorsscssplus);
										$selectorsscssplus =str_replace("\n" . ';', ';' , $selectorsscssplus);

										$selectorsscss .= $selectorsscssplus;
										$contentdefaultcssarr2[0]="\t". $selectorsscss;
										$contentdefaultcssarr[1]=implode('}',$contentdefaultcssarr2);

									}


								}

								$contentdefaultcss=implode("\n". $selectorCSSkey,$contentdefaultcssarr);

							}
						}
					}
				}
				//sets active css to boxmodell css
				$this->boxmodelcss ='boxmodels/css/' . $filenamecssoutfile;
				// and apply the coorect path to the theme in the rating stars url
				$contentdefaultcss=str_replace('themes/default/','themes/' . $this->conf['theme.']['selectedTheme'] . '/',$contentdefaultcss);

				if ($contentdefaultcss!=$content) {

						file_put_contents($filenamecss, $contentdefaultcss);

				}
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
		$mathString = ereg_replace ('[^0-9\+-\*\/\(\) ]', '', $mathString);    // remove any non-numbers chars; exception for math operators
	///print $mathString .'<br>';
		$compute = create_function("", "return (" . $mathString . ");" );
		return 0 + $compute();
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']);
}

?>