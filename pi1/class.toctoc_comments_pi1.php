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
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *  106: class tx_toctoccomments_pi1 extends tslib_pibase
 *  190:     public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = NULL)
 * 2597:     protected function checkJSLoc()
 * 2884:     protected function checkCSSTheme()
 * 2995:     protected function checkCSSLoc()
 * 3495:     protected function makesharingcss ()
 * 3674:     protected function initprefixToTableMap()
 * 3710:     protected function initexternaluid($withinitprefixToTableMap)
 * 3849:     protected function init()
 * 4419:     protected function mergeConfiguration()
 * 4804:     protected function fetchConfigValue($param)
 * 4832:     protected function ae_detect_ie()
 * 4855:     protected function boxmodel()
 * 5527:     protected function crunchcss($buffer)
 * 5552:     protected function calculate_string( $mathString )
 * 5575:     protected function locationHeaderUrlsubDir()
 * 5594:     protected function currentPageName()
 * 5622:     protected function ttclearcache ($pid, $withplugin=TRUE, $withcache = FALSE, $debugstr = '')
 * 5657:     protected function doClearCache ($forceclear=FALSE)
 * 5692:     protected function getPluginCacheControlTstamp ($external_ref_uid)
 * 5703:     protected function getLastUserAdditionTstamp ()
 * 5726:     protected function initLegacyCache ()
 * 5740:     protected function check_scopes()
 * 5898:     protected function initializeprefixtotablemap()
 * 5938:     protected function sharrrejs()
 * 6020:     protected function createVersionNumberedFilename($file, $forceQueryString = FALSE)
 * 6073:     private function resolveBackPath($pathStr)
 * 6108:     private function dirname($path)
 * 6122:     private function revExplode($delimiter, $string, $count = 0)
 * 6138:     public function applyStdWrap($text, $stdWrapName, $conf = NULL)
 * 6161:     public function createLinks($text, $conf = NULL)
 * 6184:     protected function getThemeTmageDimension($filename, $returnindex)
 * 6204:     protected function checktoctoccommentsuser()
 * 6321:     protected function fbgoogle_lan($isfacebook)
 *
 * TOTAL FUNCTIONS: 33
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

if (version_compare(TYPO3_version, '6.0', '<')) {
	//require_once(PATH_t3lib . 'class.t3lib_befunc.php');
	require_once(PATH_tslib . 'class.tslib_pibase.php');
	if (!version_compare(TYPO3_version, '4.6', '<')) {
		require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
	}
} else {
	//require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Utility/BackendUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('tslib_pibase', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Plugin\AbstractPlugin', 'tslib_pibase');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	(class_exists('t3lib_utility_Math', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\MathUtility', 't3lib_utility_Math');
	(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
	if (!t3lib_extMgm::isLoaded('compatibility6')) {
		(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
	}

}

require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));
require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_common.php'));

/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class tx_toctoccomments_pi1 extends tslib_pibase {

	// Default plugin variables:
	public $prefixId = 'toctoc_comments_pi1';
	public $scriptRelPath = 'pi1/class.toctoc_comments_pi1.php';
	public $extKey = 'toctoc_comments';
	public $extVersion = '740';

	public $pi_checkCHash = TRUE;				// Required for proper caching! See in the typo3/sysext/cms/tslib/class.tslib_pibase.php
	public $externalUid;						// UID of external record
	public $showUidParam = 'showUid';			// Name of 'showUid' GET parameter (different for tt_news!)
	public $where;								// SQL WHERE for records
	public $where_dpck;						// SQL WHERE for double post checks
	public $templateCode;						// Full template code
	public $foreignTableName;					// Table name of the record we comment on
	public $formValidationErrors = array();	// Array of form validation errors
	public $formTopMessage = '';// This message is displayed in the top of the form
	public $feuserid=0;

	public $templavoila_field = 'field_content';  // If the option is not set, this is the default name of the TemplaVoila Field which holds the MainContent
	public $maxtimeafterinsert = 1400;			   // time in milliseconds the system waits until considering a submit as new total transaction
											   //    insert, header and then show the plugins of the page
	public $totalrows  = 0;
	public $startpoint  = 0;
	public $ref = '';
	public $extref = '';

	public $lhookTablePrefix  = 0;
	public $lhookId = '';
	public $hooksrecordcontentelement  = 0;
	public $hooksrecordpage  = 0;

	public $showonlyHTML5 = TRUE;				// HTML5 Upload is only used for Browsers that use HTML5
	public $respectExternalPrefixinWhereClause= FALSE;    // when selecting comments the field external_prefix limiting the selcting to the extension who wrote the
															// comments, not the table - with FALSE the extension is ignored and the record itself is the object
															// which is more logic. however here you can change it again to the restriction for extension

	public $communityFriendsProfileListAccessright = 1;  // 0:only me, 1= only friends, 2 all users see comments on my user profile

	public $boxmodelcss='';
	public $boxmodelTextareaAreaTotalHeight=32;

	public $processcssandjsfiles = FALSE;
	public $cachedropped=FALSE;

	public $showsdebugprint = FALSE;
	public $sdebugprint='';
	public $sdebuginitprint='';
	public $sdebugprintuser=-1;
	public $showsdebugprintstartuptimes=FALSE;

	public $activateClearPageCache=FALSE;
	public $debugshowuserint=FALSE;
	protected $tclogincard = '';
	public $confcss = '';
	public $themeCSS = '';
	public $showCSScomments = 0;
	public $showDropsfromBoxmodel = 0;
	public $confid = '';
	protected $arrResponsiveSteps = array();

	public $ignorequerystring= FALSE;
	private $middotchar = '&middot;';
	// when generating cHashes for Links to new comments - used in notification mails
	// there's a problem with AJAX
	// so here we fix the estimated number of new comments that could be entered in the system until a user
	// saves his comment.
	// rise this value if you have many new comments and notification emails don't contain hotlinks anymore.
	private $potentialNewCommentsCHashes = 4;

	public $hitipcomment = '';
	public $hitip = '';


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
	public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = NULL) {
		if ($conf['optionalRecordId'] == 'Pagemode') {
			$conf['optionalRecordId'] =  'pages_' . $GLOBALS['TSFE']->id;
		}
		
		//$GLOBALS['TCA']['pages']['columns'] must be set
		
		If (!is_array($GLOBALS['TCA'])) {
			$GLOBALS['TCA'] = array();
		}
		If (!is_array($GLOBALS['TCA']['pages'])) {
			$GLOBALS['TCA']['pages'] = array();
		}
		If (!is_array($GLOBALS['TCA']['pages']['columns'])) {
			$GLOBALS['TCA']['pages']['columns'] = array();
		}
		
		$this->conf = $conf;
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);

		if (intval($this->conf['debug.']['useDebug'])==1) {
			$this->showsdebugprint = TRUE;
		}

		if (intval($this->conf['pluginmode'])>0) {
			if ($hookTablePrefix != '') {
				if ($hookcObj) {
					$this->cObj=$hookcObj;
				}
			}

			$hookTablePrefix = '';
			$hookId = 0;
		}

		$loginreset=FALSE;
		$sdebugprintli='';
		// give a reply to search enignes and avoid indexing of comments
		$interestingCrawlers = array('googlebot','yahoo','baidu','msnbot','bingbot','spider','bot.htm','yandex','jeevez' );
		$interestingCrawlersConf = explode(',', $this->conf['advanced.']['blacklistCrawlerAgentStrings']);

		$tmparr = array_merge($interestingCrawlers, $interestingCrawlersConf);
		$interestingCrawlers = array_unique($tmparr);
		$interestingWhiteCrawlersConf = explode(',', $conf['advanced.']['whitelistCrawlerAgentStrings']);
		$interestingWhiteCrawlersConf = array_unique($interestingWhiteCrawlersConf);

		$numcookies = count($_COOKIE);
		$numMatches = 0;
		$countinterestingCrawlers =count($interestingCrawlers);
		$countinterestingWhiteCrawlersConf = count($interestingWhiteCrawlersConf);
		$identstr='';

		if ($_SERVER['HTTP_USER_AGENT']){
			if (trim($_SERVER['HTTP_USER_AGENT']) != ''){
				$foundwhite = 0;
				for ($i=0; $i<$countinterestingWhiteCrawlersConf; $i++){
					if (str_replace(strtolower(trim($interestingWhiteCrawlersConf[$i])), '', strtolower($_SERVER['HTTP_USER_AGENT'])) != strtolower($_SERVER['HTTP_USER_AGENT'])) {
						$foundwhite = 1;
						$identstr=trim($interestingWhiteCrawlersConf[$i]);
					}

				}
				if ($foundwhite == 0) {
					for ($i=0; $i<$countinterestingCrawlers; $i++){
						if (str_replace(strtolower(trim($interestingCrawlers[$i])), '', strtolower($_SERVER['HTTP_USER_AGENT'])) != strtolower($_SERVER['HTTP_USER_AGENT'])) {
							$numMatches++;
							$identstr=trim($interestingCrawlers[$i]);
							break;
						}

					}
				}

			} else {
				if (intval($this->conf['advanced.']['dontTakeEmptyAgentStringAsCrawler']) == 0) {
					$numMatches++;
				}
			}

		} else {
			if (intval($this->conf['advanced.']['dontTakeEmptyAgentStringAsCrawler']) == 0) {
					$numMatches++;
			}
		}
		
		$this->lib = new toctoc_comment_lib;
		if (($numMatches > 0) || ($foundwhite == 1)) {
			if ($conf['advanced.']['protocolCrawlerAgents'] == 1) {
				if (($numMatches > 0)) {
					$protocol = '';
					$identstrbing = '';
					if ($_SERVER['HTTP_USER_AGENT']){
						if (trim($_SERVER['HTTP_USER_AGENT']) != ''){
							if ($identstr == 'bingbot') {
								// test if the bot is from a true ms adress
								$strCurrentIP = $this->lib->getIpAddr();
								$strCurrentIPres = gethostbyaddr($strCurrentIP);
								$arrCurrentIPres = explode('.', $strCurrentIPres);
								$cntarrCurrentIPres = count($arrCurrentIPres);
								$IPrevTest = '';
								for ($i = $cntarrCurrentIPres-1; (($i > 0) && ($i > ($cntarrCurrentIPres -4))); $i--) {
									$IPrevTest = '.' . $arrCurrentIPres[$i] . $IPrevTest; 
								}
								
								if (strlen($IPrevTest) > 2) {
									$IPrevTest = substr($IPrevTest, 1);
								}
								
								if ($strCurrentIPres == '') {
									$IPrevTest = $strCurrentIP;
								}
								
								if ($IPrevTest != 'search.msn.com') {
									$identstrbing == 'wrong bingbot@' . $strCurrentIPres . ' using user-agent ';
								}
						
								
							}
							$protocol = 'BL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . $identstrbing . $_SERVER['HTTP_USER_AGENT'] . ' idfd "' . $identstr .
								'"@@' . $GLOBALS['TSFE']->id . '@@' . $GLOBALS['TSFE']->lang;	
						}
						
					}

					if ($protocol == ''){
						$protocol = 'BL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . 'HTTP_USER_AGENT missing' . ' idfd "' . $identstr .
						'"@@' . $GLOBALS['TSFE']->id . '@@' . $GLOBALS['TSFE']->lang;
					}

				} else {
					$protocol = 'WL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . $_SERVER['HTTP_USER_AGENT'] . ' idfd "' . $identstr .
					'"@@' . $GLOBALS['TSFE']->id . '@@' . $GLOBALS['TSFE']->lang;
				}
				
				if (!(file_exists(realpath(dirname(__FILE__)) . '/crawlerprotocol.txt'))) {
					if (version_compare(TYPO3_version, '6.0', '<')) {
						t3lib_div::writeFile(realpath(dirname(__FILE__)) . '/crawlerprotocol.txt', $protocol);
					} else	{
						\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile(realpath(dirname(__FILE__)) . '/crawlerprotocol.txt', $protocol);
					}

				} else {
					$content = file_get_contents(realpath(dirname(__FILE__)) . '/crawlerprotocol.txt');
					$contentarr = explode("\r\n", $content);
					$testelem= 	$contentarr[count($contentarr)-1];
					$testelemarr = explode('@@', $testelem);
					$testelemarrhua = explode(' idfd "', $testelemarr[0]);
					$testelemarrhua2 = explode(': ', $testelemarrhua[0]);
					$hua = $testelemarrhua2[count($testelemarrhua2)-1];
					$protocol = str_replace("\r\n", ', ', $protocol);
					$protocol = str_replace("\n", ', ', $protocol);
					if (($hua != $_SERVER['HTTP_USER_AGENT']) || ($testelemarr[1] != $GLOBALS['TSFE']->id) || ($testelemarr[2] != $GLOBALS['TSFE']->lang)) {
						$content = $content . "\r\n" . $protocol;
						$contentarr = explode("\r\n", $content);
						if (count($contentarr) > $conf['advanced.']['protocolCrawlerAgentsMaxLines']) {
							array_shift($contentarr);
							$content = implode("\r\n", $contentarr);
						}
						// Write the contents back to the file
						file_put_contents(realpath(dirname(__FILE__)) . '/crawlerprotocol.txt', $content);
					}

				}
				
			}
			
		}
		
		if ($this->lib->checkTableBLs('', TRUE, $this) == TRUE) {
			$numMatches++;
			if ($conf['advanced.']['protocolBlacklistedIPs'] == 1) {
				if (($numMatches > 0)) {
					$ip = $this->lib->getIpAddr();

					$protocol = '';
					$protocol = 'BL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . $this->hitip . ' ' . trim($this->hitipcomment .
							' ' . $_SERVER['HTTP_USER_AGENT']) . ' idfd "' . $ip . '"@@' . $GLOBALS['TSFE']->id . '@@' . $GLOBALS['TSFE']->lang;
				}

				$blprt = realpath(dirname(__FILE__)) . '/blacklistprotocol.txt';
				if (!(file_exists($blprt))) {
					if (version_compare(TYPO3_version, '6.0', '<')) {
						t3lib_div::writeFile($blprt, $protocol);
					} else	{
						\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile($blprt, $protocol);
					}

				} else {
					$content = file_get_contents($blprt);
					$contentarr = explode("\r\n", $content);
					$testelem= 	$contentarr[count($contentarr)-1];
					$testelemarr = explode('@@', $testelem);
					$testelemarrhua = explode(' idfd "', $testelemarr[0]);
					$testelemarrhua2 = explode('"', $testelemarrhua[1]);

					$hua = $testelemarrhua2[0];
					if (($hua != $ip) || ($testelemarr[1] != $GLOBALS['TSFE']->id) || ($testelemarr[2] != $GLOBALS['TSFE']->lang)) {
						$protocol = str_replace("\r\n", ', ', $protocol);
						$protocol = str_replace("\n", ', ', $protocol);

						$content = $content . "\r\n" . $protocol;
						$contentarr = explode("\r\n", $content);
						if (count($contentarr) > $conf['advanced.']['protocolBlacklistedIPsMaxLines']) {
							array_shift($contentarr);
							$content = implode("\r\n", $contentarr);
						}
						// Write the contents back to the file
						file_put_contents($blprt, $content);
					}

				}
			}
		}

		if($numMatches > 0) {
			// Found a match
			if (intval($this->conf['dontSkipSearchEngines']) == 0) {
				return 'botMessage_' . $this->extKey . '_' . $this->extVersion;
			}
			$this->conf['advanced.']['useSessionCache'] = 0;
		}
		// end exclude search enignes and avoid indexing of comments

		if ($this->conf['debug.']['useDebugFeUserIds']!='') {
			$dbuarr=explode(',', $this->conf['debug.']['useDebugFeUserIds']);
			foreach($dbuarr as $dbusr) {
				if ($dbusr==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$this->sdebugprintuser=$dbusr;
				}

			}

		}

		if (intval($this->conf['debug.']['showStartupDetails'])==1) {
			$this->showsdebugprintstartuptimes = TRUE;
		}

		if (intval($this->conf['debug.']['showLibDetails'])==1) {
			$showsdebugprintlibtimes = TRUE;
		}
		$this->showCSScomments = $this->conf['debug.']['showCSScomments'];
		$this->showDropsfromBoxmodel = $this->conf['debug.']['showDropsfromBoxmodel'];

		unset($this->conf['debug.']);

		$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
		$sessionTimeout=$this->conf['sessionTimeout'];
		$this->commonObj->start_toctoccomments_session($sessionTimeout, '', $this->conf);

		if ($this->showsdebugprint==TRUE) {
			$starttimedebug=microtime(TRUE);
			$timereportlast='';
			if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$tdifftolastrun = 1000*(microtime(TRUE) - $_SESSION['edgeTime']);
				if ($tdifftolastrun<=intval($this->maxtimeafterinsert)) {
					$timereportlast='<div class="tx-tc-debug">Time since last rendering: ' . round($tdifftolastrun, 1) . ' ms</div>';
				}

			}

		}

		/* 		We choose to use PHP-Sessions instead of TYPO3-sessions
		 * 		The TYPO3-sessions work well from page call to page call, but inside page generation these sessions are
		 * 		not suitable, because they commit only after the page has been generated,
		 * 		which is definetely to slow to pass session-information in contentelement rendering
		 */

		if (intval($showsdebugprintlibtimes)==1) {
			$strdebugprintlib='';
			$starttimedebuglib=microtime(TRUE);
		}

		if (intval($showsdebugprintlibtimes)==1) {
			$difftimedebuglib= 1000*(microtime(TRUE)-$starttimedebuglib);
			$strdebugprintlib='<div class="tx-tc-debug"><b>Lib, details</b> (times in ms): <br />Load Lib ' . round($difftimedebuglib, 1) . '';
		}

		$this->lib->fixLL($this->conf);

		$this->pi_loadLL();
		// check plugin
		$this->boxmodelcss ='tx-tc-' . $this->extVersion . '.css';
		$this->pi_initPIflexForm();
		$isPlugin=0;

		if (intval($this->conf['dataProtect.']['cookieLifetime'])<7) {
			$this->conf['dataProtect.']['cookieLifetime']=7;
		}

		if (intval($this->conf['advanced.']['sortMostPopular']) == 1) {
			$this->conf['advanced.']['reverseSorting'] = 1;
		}

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
			$this->activateClearPageCache=TRUE;
			$this->conf['advanced.']['useSessionCache'] = 0;
		}

		if (trim($this->conf['advanced.']['gravatarLocalHost']) != '0') {
			$gravatarLocalHost = 'mm';
			if ((trim($this->conf['advanced.']['gravatarLocalHost']) == 'mm') || (trim($this->conf['advanced.']['gravatarLocalHost']) == 'identicon') ||
					(trim($this->conf['advanced.']['gravatarLocalHost']) == 'monsterid') || (trim($this->conf['advanced.']['gravatarLocalHost']) == 'wavatar') ||
					(trim($this->conf['advanced.']['gravatarLocalHost']) == 'retro')) {
				$gravatarLocalHost = trim($this->conf['advanced.']['gravatarLocalHost']);
			}
			$this->conf['advanced.']['gravatarLocalHost']=$gravatarLocalHost;

		}

		if (((intval($_SESSION['AJAXimagesrefresh']) == TRUE) || ($this->conf['advanced.']['useSessionCache'] == 0)) && (intval($_SESSION['cachepurged'])!=1)) {
		// clean sessions if on a different page the plugin is call with useSessionCache == 0
		// is equivalent to ?puge_cache=1
			$saveactivateClearPageCache=$this->activateClearPageCache;
			$this->activateClearPageCache=TRUE;
			$tempStartTime = microtime(TRUE);
			if (isset($_SESSION['StartTime'])) {
				$tempStartTime = $_SESSION['StartTime'];
			}
			$tempblocktime = 0;
			if (isset($_SESSION['unBlockTime'])) {
				$tempblocktime = $_SESSION['unBlockTime'];
			}
			$_SESSION = array();
			$_SESSION['StartTime'] = $tempStartTime;
			$_SESSION['unBlockTime'] = $tempblocktime;
			$this->doClearCache();
			$this->activateClearPageCache=$saveactivateClearPageCache;
			$_SESSION['cachepurged']=1;
		}

		if ((intval(t3lib_div::_GP('purge_cache'))==1) && (intval($_SESSION['cachepurged'])!=1 )) {
			$saveactivateClearPageCache=$this->activateClearPageCache;
			$this->activateClearPageCache=TRUE;
			$tempStartTime = microtime(TRUE);
			if (isset($_SESSION['StartTime'])) {
				$tempStartTime = $_SESSION['StartTime'];
			}
			$tempblocktime = 0;
			if (isset($_SESSION['unBlockTime'])) {
				$tempblocktime = $_SESSION['unBlockTime'];
			}
			$_SESSION = array();
			$_SESSION['StartTime'] = $tempStartTime;
			$_SESSION['unBlockTime'] = $tempblocktime;
			$this->doClearCache();
			$this->activateClearPageCache=$saveactivateClearPageCache;
			$_SESSION['cachepurged']=1;
			$sdebugprintli .= '<br />'. 'purge_cache = 1, page-id ' .$GLOBALS['TSFE']->id. '<br />';
		} else {
			if (($loginreset==TRUE) && (intval($_SESSION['cachepurgedlogin'])!=1) && (intval($_SESSION['cachepurged'])!=1)) {
				$saveactivateClearPageCache=$this->activateClearPageCache;
				$this->activateClearPageCache=TRUE;
				$tempStartTime = microtime(TRUE);
				if (isset($_SESSION['StartTime'])) {
					$tempStartTime = $_SESSION['StartTime'];
				}
				$tempblocktime = 0;
				if (isset($_SESSION['unBlockTime'])) {
					$tempblocktime = $_SESSION['unBlockTime'];
				}
				$_SESSION = array();
				$_SESSION['StartTime'] = $tempStartTime;
				$_SESSION['unBlockTime'] = $tempblocktime;
				$this->doClearCache();
				$this->activateClearPageCache=$saveactivateClearPageCache;

				$loginreset=FALSE;

				$this->lib->resetSessionVars(0);

				$_SESSION['activeBoxmodel']=$this->conf['theme.']['selectedBoxmodel'];
				$_SESSION['commentsPageId'] = $GLOBALS['TSFE']->id;
				$_SESSION['curPageName'] = $this->currentPageName();
				$_SESSION['activelang'] = $GLOBALS['TSFE']->lang;

				$_SESSION['cachepurgedlogin']=1;
				$sdebugprintli .= '<br />'. 'Init Sessionvariables because of logout/in on page id ' .$GLOBALS['TSFE']->id. '<br />';

			} else {
				if (intval(t3lib_div::_GP('purge_cache'))==1) {

					$sdebugprintli.= '<br />'. 'No more Init Sessionvariables because of logout/in or purge_cache ('.intval($_SESSION['cachepurged']).') on page id ' .$GLOBALS['TSFE']->id. '<br />';
				} else {
					$_SESSION['cachepurgedlogin']=0;
				}
			}
		}

		$_SESSION['activelangid'] = $GLOBALS['TSFE']->sys_language_uid;
		$postDatapi2 = t3lib_div::_GET('tx_toctoccomments_pi2');
		if ($postDatapi2['forgothash'] != '') {
			if (isset($_SESSION['doChangePasswordForm']) == FALSE) {
				$_SESSION['doChangePasswordForm'] = 2;
			} elseif ($_SESSION['doChangePasswordForm'] == 0) {
				$_SESSION['doChangePasswordForm'] = 2;
			}

			if (($_SESSION['doChangePasswordForm'] == 2) && (intval($_SESSION['cachepurged'])!=1 )) {
				$saveactivateClearPageCache=$this->activateClearPageCache;
				$this->activateClearPageCache=TRUE;
				$tempStartTime = microtime(TRUE);
				if (isset($_SESSION['StartTime'])) {
					$tempStartTime = $_SESSION['StartTime'];
				}
				$tempblocktime = 0;
				if (isset($_SESSION['unBlockTime'])) {
					$tempblocktime = $_SESSION['unBlockTime'];
				}
				$_SESSION = array();
				$_SESSION['StartTime'] = $tempStartTime;
				$_SESSION['unBlockTime'] = $tempblocktime;
				$this->doClearCache();
				$this->activateClearPageCache=$saveactivateClearPageCache;
				$_SESSION['cachepurged']=1;
				$sdebugprintli .= '<br />'. 'purge_cache on reset password, page-id ' .$GLOBALS['TSFE']->id. '<br />';
			}
		}

		if (!isset($_SESSION['mirrorconf'])) {
			$_SESSION['mirrorconf']=base64_encode(serialize($this->conf));
		}
		$_SESSION['httpuseragent']=$_SERVER['HTTP_USER_AGENT'];

		if (intval($this->conf['useUserImage'])==0) {
			$this->conf['UserImageSize']=1;
		}
		if (intval($this->conf['theme.']['boxmodelTextareaLineHeight'])<10) {
			$this->conf['theme.']['boxmodelTextareaLineHeight']=10;
		}

		if (intval($this->conf['theme.']['boxmodelTextareaLineHeight'])>60) {
			$this->conf['theme.']['boxmodelTextareaLineHeight']=60;
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

		if (intval($this->conf['ratings.']['dlikeCtsNotifLvl'])<1) {
			$this->conf['ratings.']['dlikeCtsNotifLvl'] =1;
		}

		if (intval($this->conf['ratings.']['dlikeCtsNotifLvl'])>99) {
			$this->conf['ratings.']['dlikeCtsNotifLvl'] =99;
		}

		if (intval($this->conf['ratings.']['useLikeDislikeStyle']) == 1) {
			// force top likes to be short if dislikestyle = 1 - inverse is possible
			$this->conf['ratings.']['useShortTopLikes'] = 1;
		}

		if (intval($this->conf['advanced.']['wallExtension']) != 0) {
			// on cummunity page reviews and login required is not possible
			$this->conf['advanced.']['loginRequired'] = 0;
			$this->conf['advanced.']['commentReview'] = 0;
		}

		if (intval($this->conf['sessionTimeout']) < 2) {
			$this->conf['sessionTimeout'] = 540;
		}

		if (intval($this->conf['advanced.']['autoConvertLinksCropLength']) < 2) {
			$this->conf['advanced.']['autoConvertLinksCropLength'] = 40;
		} else {
			if (intval($this->conf['advanced.']['autoConvertLinksCropLength']) > 150) {
				$this->conf['advanced.']['autoConvertLinksCropLength'] = 150;
			}

		}

		if (intval($this->conf['userCenter.']['commentsPerUCList']) < 1) {
			$this->conf['userCenter.']['commentsPerUCList'] = 1;
		}

		if (intval($this->conf['userCenter.']['maxItemsPerUCList']) <= intval($this->conf['userCenter.']['commentsPerUCList'])) {
			$this->conf['userCenter.']['maxItemsPerUCList'] = intval($this->conf['userCenter.']['commentsPerUCList'])+1;
		}

		if (intval($this->conf['userCenter.']['maxItemAgeUCList']) < 1) {
			$this->conf['userCenter.']['maxItemAgeUCList'] = 1;
		}

		$filename = 'toctoc_comments_myrating_star.png';
		$this->conf['ratings.']['ratingImageWidth'] = $this->getThemeTmageDimension($filename, 0);
		$filename = 'toctoc_comments_myreview_star.png';
		$this->conf['ratings.']['reviewImageWidth'] = $this->getThemeTmageDimension($filename, 0);

		if (!is_array(explode(',', $this->conf['theme.']['responsiveSteps']))) {
			$this->arrResponsiveSteps[0]=350;
			$this->arrResponsiveSteps[1]=450;
		} else {
			$this->arrResponsiveSteps=explode(',', $this->conf['theme.']['responsiveSteps']);
			if (intval(trim($this->arrResponsiveSteps[0])) != 0) {
				$this->arrResponsiveSteps[0]=intval(trim($this->arrResponsiveSteps[0]));
			} else {
				$this->arrResponsiveSteps[0]=350;
			}

			if (intval(trim($this->arrResponsiveSteps[1])) != 0) {
				$this->arrResponsiveSteps[1]=intval(trim($this->arrResponsiveSteps[1]));
			} else {
				$this->arrResponsiveSteps[1]=450;
			}

		}

		if ($this->conf['advanced.']['midDot'] != '') {
			$this->middotchar = $this->conf['advanced.']['midDot'];
		}

		if ((($this->conf['advanced.']['gravatarRating'] == 'G') ||
			($this->conf['advanced.']['gravatarRating'] == 'PG') ||
				($this->conf['advanced.']['gravatarRating'] == 'R') ||
				($this->conf['advanced.']['gravatarRating'] == 'X')) == FALSE ) {
			$this->conf['advanced.']['gravatarRating'] = 'G';
		}

		$this->arrResponsiveSteps[2]=intval($this->conf['attachments.']['picUploadMaxDimX'])+200;

		// make sure value are int because of eval in boxmodeller
		$this->conf['theme.']['boxmodelTextareaLineHeight']=intval($this->conf['theme.']['boxmodelTextareaLineHeight']);
		$this->conf['theme.']['boxmodelSpacing']=intval($this->conf['theme.']['boxmodelSpacing']);
		$this->conf['theme.']['boxmodelTextareaNbrLines']=intval($this->conf['theme.']['boxmodelTextareaNbrLines']);
		$this->conf['theme.']['boxmodelLineHeight']=intval($this->conf['theme.']['boxmodelLineHeight']);
		$this->conf['theme.']['boxmodelLabelWidth'] =intval($this->conf['theme.']['boxmodelLabelWidth']);
		$this->conf['theme.']['boxmodelInputFieldSize'] =intval($this->conf['theme.']['boxmodelInputFieldSize']);
		$this->conf['theme.']['boxmodelLabelInputPreserve'] =intval($this->conf['theme.']['boxmodelLabelInputPreserve']);

		if (!$this->conf['HTMLEmail']) {
			unset($this->conf['spamProtect.']['emailTemplatecoiHTML']);
			unset($this->conf['spamProtect.']['emailTemplateHTML']);
			unset($this->conf['advanced.']['notificationForCommentatorHTMLEmailTemplate']);
		} else {
			unset($this->conf['spamProtect.']['emailTemplatecoi']);
			unset($this->conf['spamProtect.']['emailTemplateInfo']);
			unset($this->conf['spamProtect.']['emailTemplate']);
			unset($this->conf['advanced.']['notificationForCommentatorEmailTemplate']);
		}

		$this->boxmodelTextareaHeight=intval($this->conf['theme.']['boxmodelTextareaLineHeight'])*intval($this->conf['theme.']['boxmodelTextareaNbrLines']);
		$this->boxmodelTextareaAreaTotalHeight=4 + $this->boxmodelTextareaHeight  + (2 * intval($this->conf['theme.']['boxmodelSpacing']));
		$this->communityFriendsProfileListAccessright = $this->conf['advanced.']['communityProfileCommentsVisibility'];
		unset ($this->conf['advanced.']['communityProfileCommentsVisibility']); // dont need it anymore, free some place in $conf
		if ($this->showsdebugprint==TRUE) {
			$starttimeprefixes=microtime(TRUE);
		}

		$this->fetchConfigValue('optionalRecordId');
		$this->fetchConfigValue('externalPrefix');
		if  ($this->extConf['importDataprefixtotable']) {
			$this->initializeprefixtotablemap();
		}

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

				$arrwithid=explode('_', $this->conf['optionalRecordId']);
				unset($arrwithid[count($arrwithid)-1]);
				$recordtable=implode('_', $arrwithid);
				if ($this->conf['externalPrefix'] != 'pages') {

					if($recordtable != $rows[0]['pi1_table']) {
						if (($recordtable != 'tt_content') && ($recordtable != '')) {
						//then we have mismach between $this->conf['externalPrefix'] and the record
						// or it's from toctoccommentsfe and $recordtable is = '' (optionalRecordId not yet set)
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
				$arrwithid=explode('_', $this->conf['optionalRecordId']);
				unset($arrwithid[count($arrwithid)-1]);
				$recordtable=implode('_', $arrwithid);

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
							$retstr = sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' .
									$this->lib->pi_getLLWrap($this, 'error.prefix.table', FALSE) . '</p></div>', $this->conf['optionalRecordId']);
							return $retstr;

						}

					}

				}

			}

		}

		if (trim($this->conf['optionalRecordId']) == '') {
			if (($hookTablePrefix) != '' && ($hookId > 0)) {
				if ($hookTablePrefix == 'tt_content') {
					$this->conf['optionalRecordId'] = $hookTablePrefix . '_' . $hookId;
					if ($this->conf['externalPrefix'] != 'pages') {
						$this->conf['optionalRecordId'] = '';
						$hookTablePrefix = $this->conf['externalPrefix'];

						// the hookid needs to be replaced with the id in the GET_VARS
						$newhookId=0;
						if ($this->initexternaluid(TRUE) == TRUE) {
							$newhookId = $this->externalUid;
						}

						if ($newhookId > 0) {
							$hookId = $newhookId;
						}

						$this->conf['externalPrefix'] = 'pages';
					}

				}

			}

		}

		$this->conf['optionalRecordId'] . ',externalPrefix ' . $this->conf['externalPrefix'] . '<br>';

		$contentelementMultiReference='';
		if (($this->conf['externalPrefix'] != 'pages') && ($this->lhookTablePrefix == '')) {
			$contentelementMultiReference=''. $this->conf['storagePid'];
		}

		$optionalRecordIdlhookTablePrefix='';
		$optionalRecordIdlhookId=0;
		$optionalRecordIdforexternalPrefix='';
		if ($this->conf['optionalRecordId'] != '') {
			$arrwithid=explode('_', $this->conf['optionalRecordId']);
			$triggeredRecordId=$arrwithid[count($arrwithid)-1];
			unset($arrwithid[count($arrwithid)-1]);
			$triggeredRecord=implode('_', $arrwithid);

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
					$this->foreignTableName = 'pages';
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

		$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
		$no_cacheflag = 0;
		if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) ==0) {
			if ($useCacheHashNeeded == 1) {
				$no_cacheflag = 1;
			}

		}

		if ($this->conf['commentsreport.']['active']) {
			$conftx_commentsreport = $this->conf['commentsreport.'];
			$this->conf['tx_commentsreport_pi1.']['reportPid']=$conftx_commentsreport['reportPid'];
			$conflink = array(
					// Link to current page
					'parameter' => $conftx_commentsreport['reportPid'],
					// Set additional parameters
					'additionalParams' => '',
					'useCacheHash' => $useCacheHashNeeded,
					'no_cache'  => $no_cacheflag,
					// We want link only
					'returnLast' => 'url',
					'ATagParams' => 'rel="nofollow"',
			);
			$reportpage = $this->cObj->typoLink('', $conflink);
			$_SESSION['reportpage'] = $reportpage;
		}

		if (intval($this->conf['dataProtect.']['disclaimerPageID']) > 0) {
			$conflink = array(
					// Link to current page
					'parameter' => intval($this->conf['dataProtect.']['disclaimerPageID']),
					// Set additional parameters
					'additionalParams' => '',
					'useCacheHash' => $useCacheHashNeeded,
					'no_cache' => $no_cacheflag,
					'ATagParams' => 'rel="nofollow"',
			);
			$policypage = $this->cObj->typoLink($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimerpagetextreplacelinktext', FALSE), $conflink);
			$_SESSION['policypage'] = $policypage;
		}

		if(intval($this->conf['advanced.']['acceptTermsCondsOnSubmit']) > 0) {

			$conflink = array(
					// Link to current page
					'parameter' => intval($this->conf['advanced.']['acceptTermsCondsOnSubmit']),
					// Set additional parameters
					'additionalParams' => '',
					'useCacheHash' => $useCacheHashNeeded,
					'no_cache' => $no_cacheflag,
					'ATagParams' => 'rel="nofollow" target="_terms"',
			);
			$TermsCondspage = $this->cObj->typoLink($this->lib->pi_getLLWrap($this, 'pi1_template.termscondspagelinktext', FALSE), $conflink);
			$_SESSION['TermsCondspage'] = $TermsCondspage;
		}

		if ((intval($conf['userCenter.']['userCenterPageID']) != 0) && (intval($GLOBALS['TSFE']->fe_user->user['uid']) > 0)) {
			$conflink = array(
					// Link to current page
					'parameter' => intval($this->conf['userCenter.']['userCenterPageID']),
					// Set additional parameters
					'additionalParams' => '',
					'useCacheHash' => $useCacheHashNeeded,
					'no_cache' => $no_cacheflag,
					'ATagParams' => 'rel="nofollow"',
			);
			$TermsCondspage = $this->cObj->typoLink($this->lib->pi_getLLWrap($this, 'pi1_template.userCenterpagelinktext', FALSE), $conflink);
			$_SESSION['userCenterPage'] = $TermsCondspage;

		}

		//conf-ckecks
		if ($this->conf['advanced.']['userCommentResponseLevels'] > 20) {
			$this->conf['advanced.']['userCommentResponseLevels'] = 20;
		}

		if ($this->conf['advanced.']['userCommentResponseLevelExpanded'] > 20) {
			$this->conf['advanced.']['userCommentResponseLevelExpanded'] = 20;
		}

		if ($this->conf['advanced.']['userCommentResponseLevelExpanded'] < 1) {
			$this->conf['advanced.']['userCommentResponseLevelExpanded'] = 1;
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

		if ($this->showsdebugprint==TRUE) {
			$starttimesessions=microtime(TRUE);
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
			$_SESSION['TSFE']['mainScript'] =$GLOBALS['TSFE']->config['mainScript'];
			$_SESSION['TSFE']['getMethodUrlIdToken']=$GLOBALS['TSFE']->getMethodUrlIdToken;
			$_SESSION['TSFE']['renderCharset']=$GLOBALS['TSFE']->renderCharset;
			if ($_SESSION['TSFE']['renderCharset'] == '') {
				$_SESSION['TSFE']['renderCharset'] = 'utf-8';
			}

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

		$tdiff = 1000*(microtime(TRUE) - $_SESSION['edgeTime']);

		$printrendering='';
		$sessionreseted=FALSE;
		$this->processcssandjsfiles=FALSE;
		$localssesreset=FALSE;
		if (!isset($_SESSION['indexOfSortedCommentsCidList'])) {
			$_SESSION['indexOfSortedCommentsCidList']=0;
		}

		if ($_SESSION['indexOfSortedCommentsCidList']=='') {
			$_SESSION['indexOfSortedCommentsCidList']=0;
		}

		if (intval($tdiff) > intval($this->maxtimeafterinsert)) {
			if (isset($_SESSION['rowscidflex'])) {
				if (count($_SESSION['rowscidflex'])>0) {

					if (intval($_SESSION['indexOfSortedCommentsCidList']) >=count($_SESSION['rowscidflex'])-1) {

						$localssesreset=TRUE;
					} else {
						if ($_SESSION['renderingdone']==TRUE) {
							$localssesreset=TRUE;
						} elseif (intval($tdiff) > intval($this->maxtimeafterinsert)) {
							$printrendering .= 'Start Pagerendering at <b>' . date('H:i:s') . '</b>';
							$timereportlast='';
							$_SESSION['renderedplugins']=0;
							$_SESSION['indexOfSortedCommentsCidList']=0;

						}

					}

				} else {
						$localssesreset=TRUE;
				}

			} else {
				$localssesreset=TRUE;
			}

			if ($localssesreset==TRUE) {
				$this->lib->resetSessionVars(0);
				$sessionreseted=TRUE;
				$printrendering .= 'Start Pagerendering at <b>' . date('H:i:s') . '</b>, resetSessionVars(0) done';
				$timereportlast='';
			}

		}

		if ($this->showsdebugprint==TRUE) {
			if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				if ($printrendering!='') {
					$timereportlast.='<div class="tx-tc-debug">' . $printrendering . '</div>';

				}

			}

		}

		$slcurrentPageName=str_replace('?no_cache=1', '', $this->currentPageName());
		$slcurrentPageName=str_replace('&no_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('?purge_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('&purge_cache=1', '', $slcurrentPageName);
		$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;

		/*
		 * independent situations where a emptycache is needed subsequently
		 * 1. a new page and since the last visit there have been changes possibly
		 * 2. In the languagemenu the user changes from one lang to another.
		 * 3. The user logs in as a different user
		 */

		$this->sdebugprint='<div class="tx-tc-debug">';
		$sessionreseted=TRUE;
		$_SESSION['debugprintlib']='';
		$_SESSION['debugprintlib']=array();
		$_SESSION['debugprintlib']['debugtext']=$strdebugprintlib;

		$this->feuserid=intval($GLOBALS['TSFE']->fe_user->user['uid']);
		$_SESSION['currentfeuserid']=$this->feuserid;

		$this->pi_USER_INT_obj = 0;

		if ($_SESSION['commentsPageId'] != $GLOBALS['TSFE']->id) {
			// new page
			// store request url for eID
			$this->lib->resetSessionVars(0);
			$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new page id ' .$GLOBALS['TSFE']->id. '<br />';
			$_SESSION['numberOfPages']++;
		} elseif ($_SESSION['curPageName'] != $slcurrentPageName) {
			// language change
			$this->lib->resetSessionVars(0);
			$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new curPageName ' . $slcurrentPageName . '<br />';
			$_SESSION['curPageName'] = $slcurrentPageName;
			$_SESSION['numberOfPages']++;
		} elseif ($_SESSION['activelang'] != $GLOBALS['TSFE']->lang) {
			// language change
			$this->lib->resetSessionVars(0);
			$this->doClearCache();
			$this->sdebugprint .= 'Init Sessionvariables because of new language ' .$GLOBALS['TSFE']->lang . '<br />';
			$_SESSION['numberOfPages']++;
		} elseif ($_SESSION['feuserid'] != $GLOBALS['TSFE']->fe_user->user['uid']) {
			// User has made a logon or logout

			if ($GLOBALS['TSFE']->fe_user->user['uid']>0) {
				$_SESSION['feuserid'] =0;
			}

			$this->sdebugprint .= 'feuserid, no total init of Sessionvariables ' .$clearCacheIds. '<br />';
		}  else {
			$sessionreseted=FALSE;
			$this->pi_USER_INT_obj = 0;
		}

		if (intval($GLOBALS['TSFE']->fe_user->user['uid'])!=0) {
			if (intval($GLOBALS['TSFE']->config['config'][', FALSE'])==1) {
				$this->ttclearcache($GLOBALS['TSFE']->id, FALSE, TRUE, 'sendCacheHeaders');
				$this->sdebugprint .= 'You could set TS Option page.config.sendCacheHeaders = 0 for logged in users to avoid this clear cache<br />';
			}

		}

		if (!isset($_GET['toctoc_comments_pi1']['anchor'])) {
			if (intval($_SESSION['recentcommentsclearcachepage'])!=0) {

				$this->ttclearcache($_SESSION['recentcommentsclearcachepage'], TRUE, TRUE, 'recentcommentsclearcachepage');
				$_SESSION['recentcommentsclearcachepage']=0;
			}

		}

		if ($sessionreseted==TRUE) {
			// common session inits after a reset
			$_SESSION['commentListIndex'] = array();
			$_SESSION['curPageName'] = $this->currentPageName();
			$_SESSION['activelang'] =$GLOBALS['TSFE']->lang;
			$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;
			$_SESSION['piGllW'][$_SESSION['activelangid']] = array();
			$sessionreseted=FALSE;
		} else {
			if (t3lib_div::_GP('no_cache')==1) {
				$this->doClearCache(TRUE);
			}

		}

		if ($_SESSION['feuserid'] == '') {
			// init of session var holding fe_userid to integer value
			$_SESSION['feuserid'] = 0;
		}
		$strCurrentIP = $this->lib->getCurrentIp();
		$_SESSION['CurrentIP'] = '' . $strCurrentIP;

		if (intval($GLOBALS['TSFE']->fe_user->user['uid']) == 0) {
			$_SESSION['toctoc_user'] = '' . $strCurrentIP . '.0';
		} else {
			$_SESSION['toctoc_user'] = '0.0.0.0.' . $GLOBALS['TSFE']->fe_user->user['uid'];
		}

		$_SESSION['confAJAXlogin']=array();
		if (isset($this->conf['confAJAXlogin.'])) {

			if (is_array($this->conf['confAJAXlogin.'])) {

				$_SESSION['confAJAXlogin']=array_merge($this->conf['confAJAXlogin.']);
			} else {
				unset($this->conf['confAJAXlogin.']);
			}
			unset($this->conf['confAJAXlogin.']);
		}

		$_SESSION['confAJAXlogout']=array();
		if (isset($this->conf['confAJAXlogout.'])) {
			if (is_array($this->conf['confAJAXlogout.'])) {

				$_SESSION['confAJAXlogout']=array_merge($this->conf['confAJAXlogout.']);
				//
			} else {
				unset($this->conf['confAJAXlogout.']);
			}

			unset($this->conf['confAJAXlogout.']);
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
		if ($this->showsdebugprint==TRUE) {
			$starttimeTYPO3metamodel=microtime(TRUE);
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
		$wherettcontentNoTV = ' (colPos = ' . $this->conf['advanced.']['UseMainColPos'] . $langcond .
								" AND CType = 'list' AND deleted=0 AND hidden=0 AND list_type = 'toctoc_comments_pi1') ";
		$ttcontentsortNoTV = 'sorting';

		// Check if TS template was included
		if (!isset($conf['advanced.'])) {
			// TS template is not included
			$retstr = '<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
					$this->lib->pi_getLLWrap($this, 'error.no.ts.template', FALSE)) . '</p></div>';
			return $retstr;
		}

		// Initialize
		if ($this->showsdebugprint==TRUE) {
			$starttimeinit=microtime(TRUE);
		}

		if (str_replace('koogle', '', $this->conf['theme.']['selectedBoxmodel'] ) !=$this->conf['theme.']['selectedBoxmodel']) {
			$this->conf['theme.']['selectedBoxmodelkoogled']=1;
		}

		if ($this->showsdebugprint==TRUE) {
			$tdifftimeCSSLoc=round(1000*(microtime(TRUE)-$starttimeinit), 1);
		}

		if ($this->showsdebugprint==TRUE) {
			$starttimeinit=microtime(TRUE);
		}

		$communitydisplaylist = $this->init();

		// preparing for notifications
		$gettemp= $_GET;
		unset ($gettemp['toctoc_comments_pi1']['anchor']);
		unset ($gettemp['no_cache']);
		unset ($gettemp['purge_cache']);
		unset ($gettemp['id']);
		unset ($gettemp['cHash']);

		if (count($gettemp['toctoc_comments_pi1']) == 0) {
			unset ($gettemp['toctoc_comments_pi1']);
		}

		$conflink = array(
				'useCacheHash' => FALSE,
				// Link to current page
				'parameter' => $GLOBALS['TSFE']->id,
				// Set additional parameters
				'additionalParams' => t3lib_div::implodeArrayForUrl('', $gettemp, '', 1),
				// We must add cHash because we use parameters ... hmmm - not that sure!
				// We want link only
				'returnLast' => 'url',
				'ATagParams' => '',
				'forceAbsoluteUrl' => 1,
		);
		$commentsPageIdPage = $this->cObj->typoLink('', $conflink);
		$_SESSION['commentsPageIdsClean'][$GLOBALS['TSFE']->id] = $commentsPageIdPage;

		$_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id] = array();
		$gettemp['toctoc_comments_pi1']= array();
		$lastcommentid=0;

		$rowstt2 = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'MAX(tx_toctoc_comments_comments.uid) AS uid',
				'tx_toctoc_comments_comments',
				''
		);
		if (count($rowstt2)>0) {
			if ($rowstt2[0]['uid'] !='') {
				$lastcommentid=$rowstt2[0]['uid'];

			}
		}
		$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
		$no_cacheflag = 0;
		if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) ==0) {
			if ($useCacheHashNeeded == 1) {
				$no_cacheflag = 1;
			}
		}

		for ($i=($lastcommentid+1); $i<($lastcommentid + $this->potentialNewCommentsCHashes +1);$i++)  {
			$gettemp['toctoc_comments_pi1']['anchor'] =  substr($conf['recentcomments.']['anchorPre'], 1) . $i;
			$conflink = array(
					'useCacheHash' => $useCacheHashNeeded,
					'no_cache'         => $no_cacheflag,
					// Link to current page
					'parameter' => $GLOBALS['TSFE']->id. $this->conf['recentcomments.']['anchorPre'].$i,
					// Set additional parameters
					'additionalParams' => t3lib_div::implodeArrayForUrl('', $gettemp, '', 1),
					// We must add cHash because we use parameters ... hmmm - not that sure!
					// We want link only
					'returnLast' => 'url',
					'ATagParams' => '',
					'forceAbsoluteUrl' => 1,
			);
			$commentsPageIdPage = $this->cObj->typoLink('', $conflink);
			$_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id][$i] = $commentsPageIdPage;

		}

		$_SESSION['commentsPageIds'][$GLOBALS['TSFE']->id] = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
		$_SESSION['commentsPageTitles'][$GLOBALS['TSFE']->id] = $GLOBALS['TSFE']->page['title'];

		// end preparing for notifications

		if ($this->conf['additionalClearCachePagesLocal'] != '') {
			$arraddpgTS=explode(',', $this->conf['additionalClearCachePagesLocal'] );
			$arraddpg=explode(',', $this->conf['additionalClearCachePages'] );
			$arraddpgout=array_merge($arraddpg, $arraddpgTS);
			$arraddpgout=array_unique($arraddpgout);
			$this->conf['additionalClearCachePages']=implode(',', $arraddpgout);
		}

		if ($this->showsdebugprint==TRUE) {
			$endtimeinit=microtime(TRUE);
		}
		if (strlen(trim($communitydisplaylist)) > 3) {
			// no theme found
			return $communitydisplaylist;
		} elseif ($communitydisplaylist==FALSE) {
			return '';
		}

		if (!$this->foreignTableName) {
			$retstr = sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' .
						$this->lib->pi_getLLWrap($this, 'error.undefined.foreign.table', FALSE) . '</p></div>', $this->conf['externalPrefix']);
			return $retstr;
		}

		if ($_SESSION['commentListCount']==0) {
			// do this only at the start of the session, the vars are then kept in seession vars
			// to optimize DB-IOs

			if (t3lib_extMgm::isLoaded('templavoila')) {
				if ($this->showsdebugprint==TRUE) {
					$starttimeTYPO3metamodeltemplavoila=microtime(TRUE);
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
					$rowscidflex = t3lib_div::trimExplode(',', $flexData['data']['sDEF']['lDEF'][$this->conf['advanced.']['UseTemplavoilaField']]['vDEF']);
					$rowscidflexstr = implode(',', $rowscidflex);
					$wherettcontentNoTV .= 'AND uid IN (' . $rowscidflexstr .')';
				}

				else
				{
					$rowscidflex =$flexData;
					$wherettcontentNoTV .=  'AND pid = ' . strval($GLOBALS['TSFE']->id);
				}

				/*
				 * Reihenfolge der TempaVoila-ContentElemente: zb 89,45, 23
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
				);
				$tv_comments_cidstrds='(';
				if (array_key_exists(0, $rowsttcntcidflexds)) {
					if (array_key_exists('uid', $rowsttcntcidflexds[0])) {
						foreach ($rowsttcntcidflexds as $rowds) {
							$tv_comments_cidstrds= $tv_comments_cidstrds . $rowds['uid'] . ',';
						}

					} else {
						$tv_comments_cidstrds='(0,';
					}

				} else {
					$tv_comments_cidstrds='(0,';
				}

				$tv_comments_cidstrds= $tv_comments_cidstrds . '0)';
				// the list of DS with injected comments TS is here

				$templavoilads=' AND tx_templavoila_ds IN ' . $tv_comments_cidstrds;

				// Now we need also "normal" TV-ContentObjecs
				$wherettcontent = "((CType = 'templavoila_pi1' " . $langcond . ' AND deleted=0 AND hidden=0 AND pid = ' . strval($GLOBALS['TSFE']->id) .
									$templavoilads. ')' . ' OR ' . $wherettcontentNoTV . ')';

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
				if ($this->showsdebugprint==TRUE) {
					$endtimeTYPO3metamodeltemplavoila=microtime(TRUE);
				}

			} else {
				// simply sorted by sorting and its ok
				$wherettcontentNoTV .=  'AND pid = ' . strval($GLOBALS['TSFE']->id);
				$wherettcontent = $wherettcontentNoTV;
			}

			if ($this->showsdebugprint==TRUE) {
					$starttimeTYPO3metamodelinternal=microtime(TRUE);
			}

			$rowsttcntcidflex = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'uid, pid, t3_origuid, sys_language_uid',
					'tt_content',
					$wherettcontent,
					$ttcontentsortNoTV
			);

			$tv_comments_cidstr='';
			$tv_comments_meta=array();
			if (array_key_exists(0, $rowsttcntcidflex)) {
				if (array_key_exists('uid', $rowsttcntcidflex[0])) {
					foreach ($rowsttcntcidflex as $row) {
						$tv_comments_cidstr= $tv_comments_cidstr . $row['uid'] . ',';
						$virginLastcid=$row['uid'];
						$tv_comments_meta['c' . $row['t3_origuid']]['parent']=$row['uid'];
						$tv_comments_meta['c' . $row['t3_origuid']]['langid']=$row['sys_language_uid'];
					}

				}

			}

			$tv_comments_cidstr= $tv_comments_cidstr . '';
			$tv_comments_cid = explode(',', $tv_comments_cidstr);
			unset($tv_comments_cid[count($tv_comments_cid)-1]);
			if (!t3lib_extMgm::isLoaded('templavoila')) {
				$rowscidflex= $tv_comments_cid;
			}

			$_SESSION['rowscidflex']=$rowscidflex;
			$tv_comments_cidout=array();
			$j=0;
			$tv_comments_metakeys=array_keys($tv_comments_meta);
			$counttv_comments_cid=count($tv_comments_cid);
			for ($m=0; $m<$counttv_comments_cid; $m++) {

				$dodrop=FALSE;
				$counttv_comments_metakeys=count($tv_comments_metakeys);
				for ($n=0; $n<$counttv_comments_metakeys; $n++) {
					if ('c' . $tv_comments_cid[$m] == $tv_comments_metakeys[$n]) {
						if ($tv_comments_meta[$tv_comments_metakeys[$n]]['langid']>0) {

							$dodrop=TRUE;
						}

					}

				}

				if ($dodrop==FALSE) {
					$tv_comments_cidout[$j]=$tv_comments_cid[$m];
					$j++;
				}

			}

			$_SESSION['tv_comments_cid']=$tv_comments_cidout;
			$_SESSION['tv_comments_meta']=$tv_comments_meta;
			if ($this->showsdebugprint==TRUE) {
				$endtimeTYPO3metamodelinternal=microtime(TRUE);
			}

		}

		$cid_hook=0;
		if ($this->lhookTablePrefix !='') {
			//if the plugin is called from tt_news-hook we add insert new records in the plugins-list arrays.
			// the records get a artificial id: tt_content_100000 + newid
			if ($this->showsdebugprint==TRUE) {
				$starttimehookaccess=microtime(TRUE);
			}

			if ($this->lhookTablePrefix !='tt_content') {
				$cid_hookpp= 1000 + $GLOBALS['TSFE']->id; // 1023, 1123, 2223
				$cid_hookpp= $cid_hookpp . $this->conf['storagePid'];
				$cid_hook= intval($cid_hookpp . $hookId);
			} else	{
				$cid_hook=$this->lhookId;
			}

			if ($isPlugin==0) {
				$cidwrk=array();

				for ($i=0; $i<$_SESSION['indexOfSortedCommentsCidList']; $i++) {
					if ($_SESSION['rowscidflex'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['rowscidflex'][$i];
					}

				}

				$ji=$i;
				$cidwrk[$i]=$cid_hook;

				$countrowscidflex=count($_SESSION['rowscidflex']);
				for ($i=$ji+1; $i<=$countrowscidflex; $i++) {
					if ($_SESSION['rowscidflex'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['rowscidflex'][$i-1];
					}

				}

				ksort($cidwrk);
				$_SESSION['rowscidflex']=$cidwrk;

				$cidwrk=array();
				for ($i=0; $i<$_SESSION['indexOfSortedCommentsCidList']; $i++) {
					if ($_SESSION['tv_comments_cid'][$i] != $cid_hook) {
						$cidwrk[$i]=$_SESSION['tv_comments_cid'][$i];
					}

				}

				$ji=$i;
				$cidwrk[$i]=$cid_hook;
				$counttv_comments_cid=count($_SESSION['tv_comments_cid']);
				for ($i=$ji+1; $i<=$counttv_comments_cid; $i++) {
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

			if ($this->showsdebugprint==TRUE) {
				$endtimehookaccess=microtime(TRUE);
			}

		} else {
			$incrementlistcid=1;
		}

		if ($this->showsdebugprint==TRUE) {
			$starttimesetcommentListRecord=microtime(TRUE);
		}

		$wrki=0;
		$commentlistcountout=0;
		$lastindexOfSortedCommentsCidList = $_SESSION['indexOfSortedCommentsCidList'];

		/* The sorted Array $rowscidflex (CIDs of all TemplaVoila Objects) gets filtered by
		 * the list of objects containing plugins (Array $tv_comments_cid)
		 * and $_SESSION['indexOfSortedCommentsCidList'], the work-index for $rowscidflex, is set
		 */
		$sdebugprintli.='Current index, start: ' . $_SESSION['indexOfSortedCommentsCidList'];
		if ($optionalRecordIdlhookTablePrefix!='') {
			$sdebugprintli.=', $optionalRecordIdlhookTablePrefix: ' . $optionalRecordIdlhookTablePrefix;

		}

		$wrkrowscidflex = $_SESSION['rowscidflex'];
		$wrktv_comments_cid = $_SESSION['tv_comments_cid'];
		$tv_comments_meta = $_SESSION['tv_comments_meta'];
		$errornocidfound=FALSE;
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
					$errornocidfound=TRUE;
					if ($this->showsdebugprint==TRUE) {
						$debugnocidfoundtext='<p><b>Additional information on detected content element IDs:</b><br />All content elements: ' .
						json_encode($wrkrowscidflex) .
						'<br />toctoc_comments content elements: ' . json_encode($wrktv_comments_cid) .
						'<br />multi-language structure: '  .json_encode($tv_comments_meta) .
						'<br />Current index: ' . $_SESSION['indexOfSortedCommentsCidList'] . '<br />
						Setup in TypoScript optionalRecordId for the plugin(s) if the error persists.<br />
						Alternatively to optionalRecordId you can set up "Trigger optional record" in Backend Plugin</p>';
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

			if (($this->lhookTablePrefix == '') && ($errornocidfound==TRUE) && (intval($this->conf['pluginmode'])==0)) {
				// The Contentelement ID containing the plugin could not be found automatically.
				$edatum = date('d.m.Y', time());
				$euhrzeit = date('H:i', time());
				$echodate = $edatum . ' - '. $euhrzeit;
				$retstr = sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $echodate . '<br />' .
						$this->lib->pi_getLLWrap($this, 'error.automaticcidfail', FALSE)  .
						'</p></div>', $this->conf['advanced.']['UseMainColPos'], $this->conf['advanced.']['UseTemplavoilaField']) . $debugnocidfoundtext;
				return $retstr;
			}

			if ($this->showsdebugprint==TRUE) {
				$endtimesetcommentListRecord=microtime(TRUE);
			}

			// the viginity-checks for freshly updated 1.5.4. versions of comments
			if  ($this->extConf['updateMode']) {
				if ($this->showsdebugprint==TRUE) {
					$starttimecommentsupdate=microtime(TRUE);
				}

				// means only one toctoc_comments-plugin is on the page - this is needed in
				// order to assign 1 old plugin to one new plugin (cannot distribute...)
				$wherevcomments = '';
				// ckeck tables for existance
				$checktxcomments=FALSE;
				$checktxratings=FALSE;
				$checkveguestbook=FALSE;
				$tables = $GLOBALS['TYPO3_DB']->admin_get_tables();
				if (array_key_exists('tx_comments_comments', $tables)) {
					if ($tables['tx_comments_comments']['Rows'] > 0) {
						$checktxcomments=TRUE;
					}

				}

				if (array_key_exists('tx_ratings_data', $tables)) {
					if ($tables['tx_ratings_data']['Rows'] > 0) {
						$checktxratings=TRUE;
					}

				}

				if (array_key_exists('tx_veguestbook', $tables)) {
					if ($tables['tx_veguestbook']['Rows'] > 0) {
						$checkveguestbook=TRUE;
					}

				}

				if ($checktxcomments) {
					$idmatchtable= array();
					$tmpwhere = 'approved=1 AND ' . $this->where_dpck;

					$rowstest = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_toctoc_comments_comments', $tmpwhere);

					if (count($rowstest)==0) {
						$tmprep='AND pid=' . $this->conf['storagePid'];
						$tmpwhere = str_replace($tmprep, '', $tmpwhere);
						$tmpwhere = str_replace('AND pid IN (' . $this->conf['storagePid'] . ')', '', $tmpwhere);
						$tmpwhere = str_replace('tx_toctoc_comments_comments', 'tx_comments_comments', $tmpwhere);
						$tmpsorting = 'crdate';

						$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
								'tx_comments_comments', $tmpwhere, $tmpsorting);
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
							$dataWhereuser = 'deleted=0 AND pid=' . $row['pid'] .
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

								$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user', $record);
							}

							$dataWhereStats = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) .
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
						$commentsuid=trim(substr($row['reference'], 21, 30));
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

				if ($this->showsdebugprint==TRUE) {
					$endtimecommentsupdate=microtime(TRUE);
				}

			}

		}

		$this->checktoctoccommentsuser();

		if ($this->showsdebugprint==TRUE) {
			$starttimesetJSCSS=microtime(TRUE);
		}

		$content = '';

		$this->checkJSLoc();
		$this->check_scopes();

		$_SESSION['renderedplugins']++;

		if ($_SESSION['renderedplugins']>=count($_SESSION['tv_comments_cid'])) {
			$_SESSION['renderingdone']=TRUE;
			$_SESSION['renderedplugins']=0;
			if ((($this->lhookTablePrefix!='') && ($this->lhookId!=0))==FALSE) {
				$this->sdebugprint .= 'Finishing rendering '. count($_SESSION['tv_comments_cid']). ' plugins from internal list<br />';
				$_SESSION['cachepurged']=0;
				$_SESSION['cachepurgedlogin']=0;
				$_SESSION['indexOfSortedCommentsCidList']=0;

			}

		}

		if ($this->showsdebugprint==TRUE) {
			$endtimesetJSCSS=microtime(TRUE);
		}

		$domemcache = FALSE;
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

		if ($this->feuserid == 0) {
			if (($this->conf['advanced.']['commentReview'] == 1) && ($this->conf['advanced.']['loginRequired'] == 0)) {
				$this->conf['code'] = 'COMMENTS';
				$this->conf['ratings.']['mode'] = 'static';
			}

		}
		if ($this->conf['advanced.']['commentReview'] == 1) {
			$this->conf['ratings.']['useTopVotes'] = 1;
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
					$this->sdebugprint .= 'Will display recent comment on page ' . $GLOBALS['TSFE']->id . '<br />';
					$_SESSION['runMemCache'] = FALSE;
				} else {
					$_SESSION['runMemCache'] = TRUE;
					$this->sdebugprint .= 'Show cache (recent comments mode) for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' .
					 intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br />';
					if ($_SESSION['runMemCache'] == TRUE) {
						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = TRUE;
							$this->sdebugprint .= 'Try using Cache<br />';
						} else {
							$this->sdebugprint .= 'Caching is disabled<br />';
						}

					}

				}

			} else {
				if ($_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]>=2) {
					$_SESSION['runMemCache'] = FALSE;
					if ($_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]==$_SESSION['commentListRecord']) {
						$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=3;
						$this->ttclearcache($_SESSION['reemptycachepage']['p' . $GLOBALS['TSFE']->id], TRUE, TRUE, 'reemptycachepage');
						$this->sdebugprint .= 'Reempty cache on page ' . $GLOBALS['TSFE']->id . ' on "reemptycacheplugin" ' . $_SESSION['reemptycacheplugin']['p' .
												$GLOBALS['TSFE']->id] . '<br />';
						$this->pi_USER_INT_obj = 1;
					} else {

						if ($_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]==3) {
							$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=0;
							$_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]='';
							$_SESSION['reemptycachepage']['p' . $GLOBALS['TSFE']->id]='';

						}

						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = TRUE;
							$_SESSION['runMemCache'] = TRUE;
							if ((intval($this->conf['advanced.']['wallExtension']) == 0) && (intval(t3lib_div::_GP('no_cache')==0))) {
								if ($_SESSION['reemptycacheplugin']['p' . $GLOBALS['TSFE']->id]=='') {
									$this->sdebugprint .= 'Try using cache (reseted recent comments mode), on ' . $_SESSION['commentListRecord'] . ', L: ' .
															$_SESSION['activelang'] . ', Userid: ' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br />';
								} else {
									$this->sdebugprint .= 'Try using cache (reseted recent comments mode), waiting for ' . $_SESSION['reemptycacheplugin']['p' .
															$GLOBALS['TSFE']->id] . ' on ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' .
															intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br />';
								}

							}

						} else {
							$this->sdebugprint .= 'Caching is disabled<br />';
						}

					}

				} else {
					$_SESSION['reemptycache']['p' . $GLOBALS['TSFE']->id]=0;
					if ($_SESSION['runMemCache'] == TRUE) {
						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = TRUE;
							if ((intval($this->conf['advanced.']['wallExtension']) == 0) && (intval(t3lib_div::_GP('no_cache')==0))) {
								$this->sdebugprint .= 'Try using cache for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' .
														intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br />';
							}

						} else {
							$this->sdebugprint .= 'Caching is disabled<br />';
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
					$tdiffstartup = round(1000*(microtime(TRUE) - $starttimedebug), 1);
					$startupreport='';
					if ($this->showsdebugprintstartuptimes) {
						$tdiffstartupconf = round(1000*($starttimeprefixes - $starttimedebug), 1);
						$tdiffstartupprefixes = round(1000*($starttimesessions - $starttimeprefixes), 1);
						$tdiffstartupsessions = round(1000*($starttimeTYPO3metamodel - $starttimesessions), 1);
						$tdiffstartupTYPO3metamodel = round(1000*($starttimesetJSCSS - $starttimeTYPO3metamodel), 1);
						$tdiffstartupinit = round(1000*($endtimeinit - $starttimeinit), 1);
						$tdiffstartupTYPO3metamodeltemplavoila=-1;
						if ($endtimeTYPO3metamodeltemplavoila >0) {
							$tdiffstartupTYPO3metamodeltemplavoila = round(1000*($endtimeTYPO3metamodeltemplavoila -$starttimeTYPO3metamodeltemplavoila), 1);
						}

						$tdiffstartupTYPO3metamodelinternal=-1;
						if ($endtimeTYPO3metamodelinternal >0) {
							$tdiffstartupTYPO3metamodelinternal = round(1000*($endtimeTYPO3metamodelinternal - $starttimeTYPO3metamodelinternal), 1);
						}

						$tdiffstartuphookaccess=-1;
						if ($endtimehookaccess >0) {
							$tdiffstartuphookaccess = round(1000*($endtimehookaccess - $starttimehookaccess), 1);
						}

						$tdiffstartuphookcommentsupdate=-1;
						if ($endtimecommentsupdate >0) {
							$tdiffstartupcommentsupdate = round(1000*($endtimecommentsupdate - $starttimecommentsupdate), 1);
						}

						$tdiffstartupcommentListRecord=-1;
						if ($endtimesetcommentListRecord >0) {
							$tdiffstartupcommentListRecord = round(1000*($endtimesetcommentListRecord - $starttimesetcommentListRecord), 1);
						}

						$tdiffstartupsetJSCSS = round(1000*($endtimesetJSCSS-$starttimesetJSCSS), 1);
						$startupreport = '<br /><b>Start-up, details</b> (times in ms):<br /> Conf: ' . $tdiffstartupconf . ', ' .
								'Prefixes: ' . $tdiffstartupprefixes . ', ' .
								'Sessions: ' . $tdiffstartupsessions . ', ' .
								'TYPO3 Metamodel: ' . $tdiffstartupTYPO3metamodel . ' (' .
								'Check CSSLoc: ' . $tdifftimeCSSLoc . ', ' .
								'Init: ' . $tdiffstartupinit . $this->sdebuginitprint . ', ';

						if ($tdiffstartupTYPO3metamodeltemplavoila != -1) {
							$startupreport .= 'Templavoila: ' . $tdiffstartupTYPO3metamodeltemplavoila . ', ';
						} else {
							$startupreport .= 'No Templavoila, ';
						}

						if ($tdiffstartupTYPO3metamodelinternal != -1) {
							$startupreport .= 'Internal: ' . $tdiffstartupTYPO3metamodelinternal . ', ';
						} else {
							$startupreport .= 'No Internal, ';
						}

						if ($tdiffstartuphookaccess != -1) {
							$startupreport .= 'Hookmode: ' . $tdiffstartuphookaccess . ', ';
						} else {
							$startupreport .= 'No Hookmode, ';
						}

						if ($tdiffstartuphookcommentsupdate != -1) {
							$startupreport .= 'Updatemode: ' . $tdiffstartuphookcommentsupdate . ', ';
						} else {
							$startupreport .= 'No Updatemode, ';
						}

						if ($tdiffstartupcommentListRecord != -1) {
							$startupreport .= 'Setup PluginID: ' . $tdiffstartupcommentListRecord;
						} else {
							$startupreport .= 'No Setup PluginID';
						}

						$startupreport .= ') Check JS and theme-CSS: ' . $tdiffstartupsetJSCSS . '<br />';
					}

					$starttimedebuglib=microtime(TRUE);
				}

			}

			if ($this->showsdebugprint==TRUE) {
				if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$this->sdebugprint .= '<br /><b>Additional information on detected content element IDs:</b><br />' .
							              $sdebugprintli. '<br />All content elements: ' . json_encode($wrkrowscidflex) . '<br />toctoc_comments content elements: ' .
					                      json_encode($wrktv_comments_cid) . '<br />multi-language structure: '  .json_encode($tv_comments_meta) .
					                      '<br />Current index: ' . $_SESSION['indexOfSortedCommentsCidList'] . '<br />';
				}

			}

			$outml = '';
			if ((intval($this->conf['advanced.']['wallExtension']) != 0) || (t3lib_div::_GP('no_cache')==1)) {
				$domemcache = FALSE;
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						if ((intval($this->conf['advanced.']['wallExtension']) == 0)) {
							$this->sdebugprint .= '<b>Cache dropped</b> for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' .
													intval($this->feuserid) .'<br />';
						} else {
							$this->sdebugprint .= '<b>No Cache Access on Wall</b> for ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] .
													', Userid: ' . intval($this->feuserid) .'<br />';
						}

					}

				}

			}

			if ($domemcache == TRUE) {

				if ($this->conf['theme.']['selectedBoxmodel'] != $_SESSION['activeBoxmodel']) {
					$_SESSION['AJAXimages'] = array();
					$domemcache = FALSE;
					$_SESSION['DefaultUserImage'] = array();
					if ($this->showsdebugprint) {
						if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {

							$this->sdebugprint .= '<b>Cache dropped and recacheing</b> (new boxmodel ' . $this->conf['theme.']['selectedBoxmodel'] . ') for ' .
													$_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' . intval($this->feuserid) .'<br />';
						}

					}

				}

				if ($_SESSION['renderingdone']==TRUE) {
					$_SESSION['activeBoxmodel']=$this->conf['theme.']['selectedBoxmodel'];
					$_SESSION['cachepurged']=0;
					$_SESSION['cachepurgedlogin']=0;
				}

			}

			$whynocache='';
			if ($domemcache == TRUE) {

				if (isset($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
						$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id])) {
					if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]>0) {
						if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' .
								$GLOBALS['TSFE']->id] > $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
							$outml = $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id];
						} else {
							if ($this->showsdebugprint) {
								if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
									$this->sdebugprint .= '<b>' . date('H:i:s') . '</b>: Cache dropped, last cachetime ' .
															date('H:i:s', $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] .
															'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]) .
															' older than  ' . date( 'H:i:s', $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) .
														', cid: ' .$_SESSION['commentListRecord'] .'<br />';
									$whynocache='was dropped';
								}

							}

							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';

							$domemcache=FALSE;
							$this->cachedropped=TRUE;
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

					$domemcache=FALSE;
				} else {

					if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' .
							$GLOBALS['TSFE']->id] < $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
						if ($this->showsdebugprint) {
							if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
								$this->sdebugprint .= '<b>Cache dropped</b> for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] .
													', Userid: ' . intval($this->feuserid) .'<br />';
							}

						}

						if ($this->getLastUserAdditionTstamp() > $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] .
								'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]) {
							// if exeptionally a new user has been added since the last caching time, then the user pics need an update
							$_SESSION['AJAXimages']=array();

						}

						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';

						$domemcache=FALSE;
					}

				}

			}
			if ($_SESSION['commentsSorting']['mcp' . $_SESSION['commentListRecord']] != $this->conf['advanced.']['reverseSorting']) {
				// Admin made change in TS-Setup, here just clear the cache if not already done
				$_SESSION['commentsSorting']['mcp' . $_SESSION['commentListRecord']] = $this->conf['advanced.']['reverseSorting'];
				unset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]);
				$domemcache=FALSE;
			}

			if ($_SESSION['sortMostPopular']['mcp' . $_SESSION['commentListRecord']] != $this->conf['advanced.']['sortMostPopular']) {
				// Admin made change in TS-Setup, here just clear the cache if not already done
				$_SESSION['sortMostPopular']['mcp' . $_SESSION['commentListRecord']] = $this->conf['advanced.']['sortMostPopular'];
				unset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]);
				$_SESSION['sortMostPopular']['mcp' . $_SESSION['commentListRecord']] = $this->conf['advanced.']['sortMostPopular'];
				$domemcache=FALSE;
			}

			$outmlmemcache='';
			if ($this->showsdebugprint) {
				if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$this->sdebugprint .= '</div>';
				}

			}

			if ($domemcache == FALSE) {
				// access to lib
				$outml=$this->lib->maincomments($this->ref, $this->conf, FALSE, $_SESSION['commentsPageId'], $this->feuserid, 'commentdisplay', $this, $this->piVars);
				$sharrrejsfile = $this->sharrrejs();

				$outml = $outml . $sharrrejsfile;
				if ($_SESSION['doChangePasswordForm'] == 2) {
					$outml .= '<div id="tx-tc-cpwf" class="tx-tc-nodisp"></div>';
					$_SESSION['doChangePasswordForm'] = 1;
				}
				$outmlmemcache=$timereportlast . $this->sdebugprint . $outml;
				if (intval($this->conf['advanced.']['wallExtension']) == 0) {
					if ((intval(t3lib_div::_GP('no_cache'))==0) && (!isset($_GET['toctoc_comments_pi1']['anchor']))) {
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=round(microtime(TRUE), 0);
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]=$outml;
					} else {
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' . $GLOBALS['TSFE']->id]=0;
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' . $GLOBALS['TSFE']->id]='';
					}

				}

			} else {
				if ($this->showsdebugprint==TRUE) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$outmlmemcache=$timereportlast . $this->sdebugprint . '<div class="tx-tc-debug">' . '<b>Cached result:</b></div>' . $outml;
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
					$userintstate=' as pi_USER_INT_obj = 0';
					if ($this->pi_USER_INT_obj == 1) {
						$userintstate=' as pi_USER_INT_obj = 1';
					}

					$tdifflib = 1000*(microtime(TRUE) - $starttimedebuglib);
					$tdifftotal = 1000*(microtime(TRUE) - $starttimedebug);
					if (!$this->debugshowuserint) {
						$userintstate='';
					}

					$timereport='<div class="tx-tc-debug">Start-up: ' . round($tdiffstartup, 0) . 'ms, Lib: ' . round($tdifflib, 0) . 'ms, <b>Total: ' .
								round($tdifftotal, 0) . 'ms</b>' . $userintstate . ' ' . $startupreport.'</div>';
					if($_SESSION['debugprintlib']['debugtext']!=''){
						$_SESSION['debugprintlib']['debugtext'] .= '</div>';
					}

					$outmlmemcache .= $timereport . $_SESSION['debugprintlib']['debugtext'];
				}

			}
			//check imagelinks on https:
			if (@$_SERVER['HTTPS'] == 'on') {
				$outmlmemcache = str_replace('src="http://', 'src="https://', $outmlmemcache);
			}

			$_SESSION['edgeTime'] = microtime(TRUE);
			if ($_SESSION['renderingdone']==TRUE) {
				$_SESSION['edgeTime']=$_SESSION['edgeTime']-10;
				$_SESSION['indexOfSortedCommentsCidList']=0;
				$_SESSION['doChangePasswordForm'] = 0;
				$_SESSION['cachepurged']=0;
				$_SESSION['cachepurgedlogin']=0;
			}

			$_SESSION['activeBoxmodel'] = $this->conf['theme.']['selectedBoxmodel'];
			return $outmlmemcache;

		} elseif ($this->conf['pluginmode'] == 1) {
			$this->pi_USER_INT_obj = 1;
			if (!$this->showsdebugprint) {
				$timereportlast='';
			} elseif ($this->sdebugprintuser!=intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$timereportlast='';
			}

			$timereport='';
			$starttimedebuglib=microtime(TRUE);
			$outml=$timereportlast .$this->lib->getRecentComments($this, $this->conf, $this->feuserid);
			if ($this->showsdebugprint) {
				if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {

					$userintstate=' as USER-object';
					if ($this->pi_USER_INT_obj == 1) {
						$userintstate=' as USER_INT-object';
					}

					$tdifflib = 1000*(microtime(TRUE) - $starttimedebuglib);
					$tdifftotal = 1000*(microtime(TRUE) - $starttimedebug);
					if (!$this->debugshowuserint) {
						$userintstate='';
					}

					$timereport='<div class="tx-tc-debug">Start-up: ' . round($tdiffstartup, 0) . 'ms, Lib: ' . round($tdifflib, 0) . 'ms, <b>Total: ' .
								round($tdifftotal, 0) . 'ms</b>' . $userintstate . ' ' . $startupreport.'</div>';

				}

			}

			$_SESSION['edgeTime'] = microtime(TRUE);
			return $outml . $timereport;

		} elseif ($this->conf['pluginmode'] == 2) {
			$content='';
			$this->pi_setPiVarDefaults();
			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(TRUE);

			$retstr =$this->lib->mainReport($content, $this->conf, $this, $this->piVars);
			return $retstr;

		} elseif (($this->conf['pluginmode'] == 3) || ($this->conf['pluginmode'] == 4)) {

			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(TRUE);
			$retstr = $this->lib->showtopRatings($this->conf, $this);
			return $retstr;

		} elseif (($this->conf['pluginmode'] == 5)) {

			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(TRUE);

			$retstr = $this->tclogincard;
			if ($_SESSION['doChangePasswordForm'] == 2) {
				$retstr .= $this->tcchangepasswordcard;
				$_SESSION['doChangePasswordForm']=0;
			}
			return $retstr;

		} elseif (($this->conf['pluginmode'] == 6)) {

			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(TRUE);
			$retstr = $this->lib->showuserCenter($this->conf, $this);
			return $retstr;

		}  elseif (($this->conf['pluginmode'] == 7)) {
			$_SESSION['activelang'] =$GLOBALS['TSFE']->lang;
			$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;
			$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set.
			                               //We do this, because it's a USER_INT object!
			$_SESSION['edgeTime'] = microtime(TRUE);
			$retstr = $this->lib->showCommentsSearch($this->conf, $this, FALSE, '');
			return $retstr;

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

		$filenamejs='tx-tc-' . $_SESSION['activelang'] . '.js';
		if ($this->conf['theme.']['selectedBoxmodel'] !='') {
			$filenamejs='tx-tc-' . str_replace('.txt', '-', $this->conf['theme.']['selectedBoxmodel']) . $_SESSION['activelang'] . '.js';
		}

		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

		$txdirname= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/temp/' );
		$filenamejs=$txdirname . $filenamejs;

		$unlinked=FALSE;
		$jscontent = '';

		$strtexterrorlength = sprintf($this->lib->pi_getLLWrap($this, 'pi1_template.texterrorlength', FALSE), $this->conf['minCommentLength']);
		$strtextsearcherrorlength = sprintf($this->lib->pi_getLLWrap($this, 'pi1_template.texterrorsearchlength', FALSE), $this->conf['search.']['minSearchTermLength']);

		if ($this->conf['advanced.']['useBBCodeMenu']>0) {
			$fetchBBs=TRUE;
			if ((isset($_SESSION['BBCard'][$_SESSION['activelang']])===TRUE)) {
				if (trim($_SESSION['BBCard'][$_SESSION['activelang']]) !='') {
					$fetchBBs=FALSE;
				}
			}

			$tcbb=$this->lib->getBBCard($this->conf, $this);
			$_SESSION['BBCard'][$_SESSION['activelang']]=$tcbb;
			$tcbbenchtml='var tcbbcard = \''. $tcbb.'\';
';
		} else {
			$tcbbenchtml='var tcbbcard ="";
';
		}
		if ($this->showsdebugprint==TRUE) {
			$starttimedebug21=microtime(TRUE);
		}

		if ($this->conf['advanced.']['useEmoji']>0) {
			$fetchemojis=TRUE;
			if ((intval($this->conf['advanced.']['emojiConfigCacheLevel'])==0)) {
				if ((isset($_SESSION['SmilieCard'][$_SESSION['activelang']])===TRUE)) {
					if (trim($_SESSION['SmilieCard'][$_SESSION['activelang']]) !='') {
						$fetchemojis=FALSE;
					}
				}

			} elseif ((intval($this->conf['advanced.']['emojiConfigCacheLevel'])==1)) {
				if ((isset($_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']])===TRUE)) {
					if (trim($_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']]) !='') {
						$fetchemojis=FALSE;
					}
				}

			}

			if ($fetchemojis==TRUE) {
				$tcsc=$this->lib->getSmiliesCard($this->conf);
				if ($this->conf['advanced.']['emojiConfigCacheLevel']==1) {
					$_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']]=$tcsc;
				} elseif ($this->conf['advanced.']['emojiConfigCacheLevel']==0) {
					$_SESSION['SmilieCard'][$_SESSION['activelang']]=$tcsc;
				}

				if ($this->showsdebugprint==TRUE) {
					$this->sdebuginitprint.='Emojis from Code: ';
				}

			} else {
				if ($this->conf['advanced.']['emojiConfigCacheLevel']==0) {
					$tcsc=$_SESSION['SmilieCard'][$_SESSION['activelang']];
				} elseif ($this->conf['advanced.']['emojiConfigCacheLevel']==1) {
					$tcsc=$_SESSION[$_SESSION['commentsPageId']]['SmilieCard'][$_SESSION['activelang']];

				}

				if ($this->showsdebugprint==TRUE) {
					$this->sdebuginitprint.='Emojis from Cache: ';
				}

			}

			if ($this->showsdebugprint==TRUE) {
				$starttimedebug221=microtime(TRUE);
				$this->sdebuginitprint.=round(1000*($starttimedebug221 - $starttimedebug21), 1) .', ';
			}

			// PHP 5.3.4 is not able to output a javascript var longer than 99959 chars correctly, that's why this
			// slicing is needed
			$tcsc1=substr($tcsc, 0, 99959);
			$tcsc2=substr($tcsc, 99959, 99959);
			$tcsc3=substr($tcsc, 199918, 99959);
			$tcsc4=substr($tcsc, 299877, 99959);

			$tcsmiliesenchtml='var tcsc1 = \''. $tcsc1.'\';
var tcsc2 = \''. $tcsc2.'\';
var tcsc3 = \''. $tcsc3.'\';
var tcsc4 = \''. $tcsc4.'\';
var tcsmiliecard =tcsc1+tcsc2+tcsc3+tcsc4;
';
			if ($this->showsdebugprint==TRUE) {
				$starttimedebug22=microtime(TRUE);
				$this->sdebuginitprint.='Preparing JS for Emojis: ' . round(1000*($starttimedebug22-$starttimedebug221), 1) .', ';
			}

		} else {
			$tcsmiliesenchtml='var tcsmiliecard ="";
';
		}

		$countbbs =0;
		$locBBhtmlarr= $this->lib->getBBCard($this->conf, $this, TRUE, TRUE);
		if (is_array($locBBhtmlarr)) {
			if (is_array($locBBhtmlarr['html'])) {
				$countbbs = count($locBBhtmlarr['html']);

			}
		}

		$varbbshtml='var BBs = [];' . "\n";
		for($i = 0; $i < $countbbs; $i++) {
			$varbbshtml .= 'BBs['. $i. '] = ' . "'" . $locBBhtmlarr['html'][$i] . "'" . ';' . "\n";
		}
		$varbbshtml .= 'var BBsBBs = [];' . "\n";
		for($i = 0; $i < $countbbs; $i++) {
			$varbbshtml .= 'BBsBBs['. $i. '] = ' . "'" . $locBBhtmlarr['bb'][$i] . "'" . ';' . "\n";
		}

		$confpi2 = $this->lib->getDefaultConfig('tx_toctoccomments_pi2');
		$scopefb = '';
		$confpi2appId = '';
		//checking facebook stuff
		$this->nofacebook = FALSE;
		if (!is_dir(PATH_site.$conf['facebook.']['imageDir'])) {
			$this->nofacebook = TRUE;
		}

		if (!isset($confpi2['facebook.']['appId']) || $confpi2['facebook.']['appId'] == '') {
			$this->nofacebook = TRUE;
		}

		if (!isset($confpi2['facebook.']['secret']) || $confpi2['facebook.']['secret'] == '') {
			$this->nofacebook = TRUE;
		}

		if ($this->nofacebook == FALSE) {
			$confpi2appId = $confpi2['facebook.']['appId'];
			$scopefb = 'email';
		}
		$scopegoogle = '';
		$this->nogoogle = FALSE;
		if (!isset($confpi2['google.']['ClientID']) || $confpi2['google.']['ClientID'] == '') {
			$this->nogoogle = TRUE;
		}

		if (!isset($confpi2['google.']['ClientSecret']) || $confpi2['google.']['ClientSecret'] == '') {
			$this->nogoogle = TRUE;
		}

		if ($this->nogoogle == FALSE) {
			$confpi2ClientID = $confpi2['google.']['ClientID'];
			$scopegoogle = 'emails.0.value';
		}
		$fblan = $this->fbgoogle_lan(TRUE);
		$googlelan = $this->fbgoogle_lan(FALSE);

		$sendbackafterloginout=intval($confpi2['sendBack']);

		if(intval($this->conf['advanced.']['acceptTermsCondsOnSubmit']) > 0) {
			$termscond = 1;
		} else {
			$termscond = 0;
		}
		if ($this->conf['RequiredMark'] == '') {
			$this->conf['RequiredMark'] = '*';
		}

		$jscontent .= $tcsmiliesenchtml . "\n";
		$jscontent .= $tcbbenchtml . "\n";
		$jscontent .= $varbbshtml . "\n";
		$jscontent .= 'var textErrCommentLength = "' . base64_encode($strtexterrorlength) . '";' . "\n";
		$jscontent .= 'var textErrNotReviewed = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmakefirstreview', FALSE)) . '";' . "\n";
		$jscontent .= 'var confagbchck = ' . $termscond . ';' . "\n";
		$jscontent .= 'var activelang = "' . $_SESSION['activelang'] . '";' . "\n";
		$jscontent .= 'var sendbackafterloginout = ' . $sendbackafterloginout . ';' . "\n";
		$jscontent .= 'var cookieLifetime = ' . intval($this->conf['dataProtect.']['cookieLifetime']) . ';' . "\n";
		$jscontent .= 'var textErrCommentNull = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.texterrornull', FALSE)) . '";' . "\n";
		$jscontent .= 'var textErrSearchLength = "' . base64_encode($strtextsearcherrorlength) . '";' . "\n";
		$jscontent .= 'var textErrSearchNull = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.searcherrornull', FALSE)) . '";' . "\n";
		$jscontent .= 'var textSaveComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.savecomment', FALSE)) . '";' . "\n";
		$jscontent .= 'var textCommenttitle = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.commenttitle', FALSE)) . '";' . "\n";
		$requiredFields = t3lib_div::trimExplode(',', $this->conf['requiredFields'], TRUE);
		$requiredcommenttitle =in_array('commenttitle', $requiredFields) ? base64_encode($this->conf['RequiredMark']) : '';
		$jscontent .= 'var textrequiredcommenttitle = "' . $requiredcommenttitle . '";' . "\n";
		$jscontent .= 'var textcommentTitleStdWrap = "' . base64_encode($this->conf['commentTitle_stdWrap.']['wrap']) . '";' . "\n";
		$jscontent .= 'var textCancelEditComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.canceleditcomment', FALSE)) . '";' . "\n";
		$jscontent .= 'var textEditComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.editlink', FALSE)) . '";' . "\n";
		$jscontent .= 'var textAddComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.add_comment', FALSE)) . '";' . "\n";
		$jscontent .= 'var textReplyToComment = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.replytocomment', FALSE)) . '";' . "\n";
		$jscontent .= 'var textAddComplaint = "' . base64_encode($this->lib->pi_getLLWrap($this, 'commentreport.text_text', FALSE)) . '";' . "\n";
		$jscontent .= 'var textAddemoji = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.add_emoji', FALSE)) . '";' . "\n";
		$jscontent .= 'var textCloseemoji = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.close_emoji', FALSE)) . '";' . "\n";
		$jscontent .= 'var confuseEmoji = ' . intval($this->conf['advanced.']['useEmoji']) . ';' . "\n";
    	$jscontent .= 'var textLoading = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.loadingpreview', FALSE)) . '";' . "\n";
		$jscontent .= 'var textDeleteConfirm = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.deletecommentconfirm', FALSE)) . '";' . "\n";
		$jscontent .= 'var textCookieConfirm = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.cookiecommentconfirm', FALSE)) . '";' . "\n";
		$jscontent .= 'var texttermscond = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.termscondconfirm', FALSE)) . '";' . "\n";
		$jscontent .= 'var textdisclaimernohttps = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimersafetyreporthttp', FALSE)) . '";' . "\n";
		$jscontent .= 'var textdisclaimerhttps = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimersafetyreporthttps', FALSE)) . '";' . "\n";
		$jscontent .= 'var textdisclaimersafetyreportminimal = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimersafetyreportminimal', FALSE)) . '";' . "\n";
		$jscontent .= 'var textdisclaimersafetyreportcouldbebetter = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimersafetyreportcouldbebetter', FALSE)) . '";' . "\n";
		$jscontent .= 'var textdisclaimersafetyreportlooksgood = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimersafetyreportlooksgood', FALSE)) . '";' . "\n";
		$jscontent .= 'var textDgClose = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.dialogboxclose', FALSE)) . '";' . "\n";
		$jscontent .= 'var textPicFileToBig = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imageuploadfiletobig', FALSE)) . '";' . "\n";
		$jscontent .= 'var textPdfFileToBig = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.pdfuploadfiletobig', FALSE)) . '";' . "\n";
		$jscontent .= 'var textPicFiletypeErr = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imageuploadfiletypeerror', FALSE)) . '";' . "\n";
		$jscontent .= 'var textpdfFiletypeErr = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imageuploadfiletypeerrorpdf', FALSE)) . '";' . "\n";
		$jscontent .= 'var picUploadMaxfilesize = ' . 1024*intval($this->conf['attachments.']['picUploadMaxfilesize']) . ';' . "\n";
		$jscontent .= 'var pdfUploadMaxfilesize = ' . 1024*intval($this->conf['attachments.']['pdfUploadMaxfilesize']) . ';' . "\n";
		$jscontent .= 'var textpdfdescribe = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.pdfdescribe', FALSE)) . '";' . "\n";
		$jscontent .= 'var textimagedescribe = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.imagedescribe', FALSE)) . '";' . "\n";
		$jscontent .= 'var textclosepdfupload = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.closepdfupload', FALSE)) . '";' . "\n";
		$jscontent .= 'var textclosepicupload = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.closeimageupload', FALSE)) . '";' . "\n";
		$jscontent .= 'var textshowmore = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.text_usercenter_showmore', FALSE)) . '";' . "\n";
		$jscontent .= 'var texthideshowmore = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.text_usercenter_showless', FALSE)) . '";' . "\n";
		if ($GLOBALS['TYPO3_CONF_VARS']['GFX']['im_version_5'] != 'gm') {
			$jscontent .= 'var pathim = "' . base64_encode($GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path']) . '";' . "\n";
		} else {
			//graphicsMagick
			if (DIRECTORY_SEPARATOR == '\\') {
				$addpath = '.exe" convert';
			} else {
				$addpath = '" convert';
			}
			$jscontent .= 'var pathim = "' . base64_encode($GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path'] . 'gm' . $addpath) . '";' . "\n";

		}
		$jscontent .= 'var textmessagecannotdelete = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmessagecannotdelete', FALSE)) . '";' . "\n";
		$jscontent .= 'var textmessagecannotinsert = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.textmessagecannotinsert', FALSE)) . '";' . "\n";
		$jscontent .= 'var configbaseURL = "' . base64_encode($this->locationHeaderUrlsubDir()) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvseconds = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.seconds', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvsecond = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.second', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvminutes = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.minutes', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvminute = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.minute', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvhours = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.hours', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvhour = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.hour', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvdays = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.days', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvday = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.day', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvweeks = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.weeks', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvweek = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.week', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvmonths = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.months', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvmonth = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.month', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvyears = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.years', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvyear = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.year', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvtextafter = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.textafter', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi1_templatetimeconvtextbefore = "' . base64_encode($this->lib->pi_getLLWrap($this, 'pi1_template.timeconv.textbefore', FALSE)) . '";' . "\n";
		$jscontent .= 'var pi2_fbappId = "' . $confpi2appId . '";' . "\n";
		$jscontent .= 'var pi2_fbscope = "' . $scopefb . '";' . "\n";
		$jscontent .= 'var pi2_googleClientID = "' . $confpi2ClientID . '";' . "\n";
		$jscontent .= 'var pi2_googlescope = "' . $scopegoogle . '";' . "\n";
		$jscontent .= 'var pi2_fblan = "' . $fblan . '";' . "\n";
		$jscontent .= 'var pi2_googlelan = "' . $googlelan . '";' . "\n";
		if (file_exists($filenamejs)) {
			$content = file_get_contents($filenamejs);
			if ($content != $jscontent) {
				$unlinked=TRUE;
				unlink($filenamejs);
			}

		}

		if ((!file_exists($filenamejs)) || ($unlinked)) {
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
			$this->themeCSS = '';
			$filenametheme='theme.txt';

			$dirsep=DIRECTORY_SEPARATOR;

			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
			if (trim($this->conf['theme.']['selectedTheme']) == '') {
				$this->conf['theme.']['selectedTheme'] = 'default';
			}
			$txdirnametheme= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
							'res/css/themes/' . $this->conf['theme.']['selectedTheme'] . '/' );
			$filenametheme=$txdirnametheme . $filenametheme;

			$filenamecssfile='tx-tc-' . $this->extVersion . '-theme.css';
			$txdirnamedefault= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/themes/default/css/' );
			$filenamedefaultcss=$txdirnamedefault . $filenamecssfile;
			if (strlen($this->conf['theme.']['themeFontFamily']) < 4) {
				$this->conf['theme.']['themeFontFamily']='';
			}

			$printstr='';
				if (file_exists($filenametheme)) {
					$contenttheme = file_get_contents($filenametheme);
					if (file_exists($filenamedefaultcss)) {
						$contentdefaultcss = file_get_contents($filenamedefaultcss);

						$contentthemearr = explode(':', $contenttheme);
						$countcontentthemearr=count($contentthemearr);
						for ($i=1; $i<$countcontentthemearr; $i++) {
							$contentthemecolormatch= trim($contentthemearr[$i]);
							$contentthemecolormatcharr=explode("\n", $contentthemecolormatch);
							$contentthemecolormatch = $contentthemecolormatcharr[0];
							$printstr.= $contentthemecolormatch .'<br />';
							$contentthemecolormatcharr=explode(' ', $contentthemecolormatch);
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

								$contentdefaultcss=str_replace(trim($contentthemecolormatcharr[1]), trim($contentthemecolormatcharr[0]), $contentdefaultcss);
							}

						}

						if (!$this->processcssandjsfiles) {
							// exit is possible only here, the additional theme options ...
							// future tuning would be possible with SESSION-cache per theme
							return '';
						}

						$contentarr=explode('font-family:', $contentdefaultcss);
						if (trim($this->conf['theme.']['themeFontFamily']) != '') {
							$countcontentarr=count($contentarr);
							for ($i=1; $i<$countcontentarr; $i++) {
								$contentarrfontfamilyarr=explode(';', $contentarr[$i]);
								$contentarrfontfamilyarr[0]=trim($this->conf['theme.']['themeFontFamily']);
								$contentarr[$i]=implode(';', $contentarrfontfamilyarr);
							}
							$contentdefaultcss=implode('font-family:', $contentarr);
						} else {
							$countcontentarr=count($contentarr);
							for ($i=1; $i<$countcontentarr; $i++) {
								$contentarrfontfamilyarr=explode(';', $contentarr[$i]);
								$contentarrfontfamilyarr[0]='';
								$contentarr[$i]=implode('', $contentarrfontfamilyarr);
							}
							$contentdefaultcss=implode('', $contentarr);
						}
						$this->themeCSS = $contentdefaultcss;
						$this->themeCSS = str_replace('../img/', '../themes/' . $this->conf['theme.']['selectedTheme'] . '/img/', $this->themeCSS);
						$this->themeCSS = str_replace('../../../emoji', '../emoji', $this->themeCSS);

					} else {
						$retstr = $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
								$this->lib->pi_getLLWrap($this, 'error.no.css.defaulttheme', FALSE)) . ': ' . $filenamedefaultcss;
						return $retstr;

					}

				} else {
					$retstr =$this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
							$this->lib->pi_getLLWrap($this, 'error.no.css.themetxt', FALSE)) . ': ' . $filenametheme;
				    return $retstr;
				}

		return '';
	}

	/**
	 * Checks if the CSS-File for config-dependent values (UserImageSize) exists and if not creates it.
	 *
	 * @return	$changedconfig		TRUE if new file has been written
	 */
	protected function checkCSSLoc() {
		$themeopacity = 1;
		$tapadding='1';
		if ($this->conf['advanced.']['useEmoji']>0) {
			$tapadding=21+intval(intval($this->conf['theme.']['boxmodelSpacing'])/2);
		}
		$taheight = (intval($this->conf['theme.']['boxmodelTextareaLineHeight'])*intval($this->conf['theme.']['boxmodelTextareaNbrLines']));

		$expandiconCSSmargin='margin: 6px 0 0 4px;';
		$closebuttonkooglemargin='';
		if ($this->conf['theme.']['selectedBoxmodelkoogled']==1) {
			$expandiconCSSmargin='margin: 6px 0 0 ' . (2*intval($this->conf['theme.']['boxmodelSpacing'])) . 'px;';
			$closebuttonkooglemargin='
.tx-tc-ct-uc .tx-tc-ct-uc-pic2 + .tx-tc-ct-box-ctclose {
	margin: 48px 0 -48px 4px;
}
.tx-tc-ucinner {
	margin-right: 15px;
}
';
		}
		if ($this->conf['theme.']['boxmodelLevelIndent']==1) {
			$levelindent=$this->conf['UserImageSize']+(3*round($this->conf['theme.']['boxmodelSpacing']/2));
		} elseif ($this->conf['theme.']['boxmodelLevelIndent']==3) {
			$levelindent=round($this->conf['UserImageSize']/3)+(3*round($this->conf['theme.']['boxmodelSpacing']/2));
		} elseif ($this->conf['theme.']['boxmodelLevelIndent']==2) {
			$levelindent=round($this->conf['UserImageSize']/2)+(3*round($this->conf['theme.']['boxmodelSpacing']/2));
		} else {
			$levelindent=round($this->conf['theme.']['boxmodelSpacing']);
		}
		$cssreplyindents='';
		$margincheck = 0;
		if (intval($this->conf['theme.']['boxmodelLineHeight']) > 16) {
			$margincheck = intval(0.9*(intval($this->conf['theme.']['boxmodelLineHeight']) - 16));
		}
		$sortind=0;
		if (intval($this->conf['theme.']['boxmodelLineHeight']) > 17) {
			$sortind = intval((intval($this->conf['theme.']['boxmodelLineHeight']) - 16)/2);
		}

		$boxmodelLineHeightorReviewlineHeight = intval($this->conf['theme.']['boxmodelLineHeight']);
		if (intval($this->conf['ratings.']['reviewImageWidth']) > $boxmodelLineHeightorReviewlineHeight) {
			$boxmodelLineHeightorReviewlineHeight = intval($this->conf['ratings.']['reviewImageWidth']);
		}

		$marginleftcommentingform = 0;
		if ($this->conf['useUserImage'] == 1) {
			$marginleftcommentingform = 9;
		}
		$cssforminputspreserved = '';
		$marginhalfbm = intval($this->conf['theme.']['boxmodelSpacing']);
		if ($this->conf['theme.']['boxmodelLabelInputPreserve']==1) {
			$cssforminputspreserved='
div.tx-tc-ct-form-field {
	float: left;
	margin-right: inherit !important;
	margin-bottom: ' . round(intval($this->conf['theme.']['boxmodelSpacing'])/2, 0) . 'px;
	margin-top: ' . round(intval($this->conf['theme.']['boxmodelSpacing'])/2, 0) . 'px;
	min-height: inherit !important;
	padding: inherit !important;
	-webkit-box-sizing: border-box !important;
	-moz-box-sizing: border-box !important;
	box-sizing: border-box !important;
}
.tx-tc-ct-ntf-wrap {
	float: left;
	margin-right: inherit !important;
	min-height: inherit !important;
	padding: inherit !important;
	-webkit-box-sizing: border-box !important;
	-moz-box-sizing: border-box !important;
	box-sizing: border-box !important;
}
.tx-tc-ct-form-gender {
	padding: '.intval($this->conf['theme.']['boxmodelSpacing']/2).'px !important;
}
.tx-tc-ct-form-field-1, .tx-tc-div-submit {
	margin-left: inherit !important;
}
.tx-tc-responsive .tx-tc-ct-cap-area-image {
	margin: 0 1px 10px 5px;
}
.tx-tc-responsive .tx-tc-ct-cap-area-image + input {
	float: left;
}
.tx-tc-responsive img.tx-tc-cap-image-rf {
	float: none;
}
.tx-tc-responsive .tx-tc-ct-label-cap {
	float: none;
	width: 100%;
}
.tx-tc-responsive .tx-tc-ct-cap-area .tx-tc-ct-cap-area-cantreadit .tx-srfreecap-pi2-cant-read, .tx-tc-ct-cap-area-cantread .tx-srfreecap-pi2-cant-read {
	width: 100%;
}
div.tx-tc-ct-form-field input, textarea.tx-tc-ctinput-textarea, textarea.tx-tc-ctinput-textarea-rq {
	-webkit-box-sizing: border-box !important;
	-moz-box-sizing: border-box !important;
	box-sizing: border-box !important;
}
.tx-tc-responsive .tx-tc-ctinput-textarea, .tx-tc-responsive .tx-tc-ct-input, .tx-tc-responsive input[type="text"], .tx-tc-responsive input[type="password"] {
	line-height: ' . intval($this->conf['theme.']['boxmodelLineHeight']) . 'px;
	width: 100%;
}
.tx-tc-responsive .tx-tc-ct-ntf-wrap {
	width: calc(100% - 35px) !important;
    width: 85%;
}
.tx-tc-responsive .tx-tcfh0 .tx-tc-ct-form-field {
    width: 100%;
}
.tx-tc-responsive .tx-tc-ctinput-textarea {
	padding: ' .  (intval(($this->conf['theme.']['boxmodelSpacing'])/2)-1) . 'px 0 ' .
	(intval(($this->conf['theme.']['boxmodelSpacing'])/2)-1) . 'px ' . (intval(($this->conf['theme.']['boxmodelSpacing'])/2)-1) . 'px !important;
}
.tx-tc-responsive .tx-tc-ct-form-field input[type=text] {
	padding-left: ' .  (intval(($this->conf['theme.']['boxmodelSpacing'])/2)-1) . 'px !important;
}
.tx-tc-responsive input[type=text], .tx-tc-responsive input[type=password] {
    height: ' . (intval($this->conf['theme.']['boxmodelLineHeight']) + intval($this->conf['theme.']['boxmodelSpacing'])) . 'px;
}
.tx-tc-responsive .tx-tc-ct-cap-area-image {
    margin: 0 1px ' . intval($this->conf['theme.']['boxmodelSpacing']) . 'px ' . intval($this->conf['theme.']['boxmodelSpacing']/2) . 'px;
}
.tx-tc-responsive .tx-tc-ct-cap-area-image + input {
    float: left;
}
.tx-tc-responsive img.tx-tc-cap-image-rf {
    float: none;
}
.tx-tc-responsive .tx-tc-ct-label-cap {
    float: none;
    width: 100%;
}
.tx-tc-responsive .tx-tc-ct-cap-area .tx-tc-ct-cap-area-cantreadit .tx-srfreecap-pi2-cant-read, .tx-tc-ct-cap-area-cantread .tx-srfreecap-pi2-cant-read {
    width: 100%;
}
.toctoc-comments-pi1 .tx-tc-ct-box-cttxt .tx-tc-ctinput-textarea, .toctoc-comments-pi1 .tx-tc-pi1 .tx-tc-ctinput-textarea {
	padding-bottom: '.intval(-1+0.5*$this->conf['theme.']['boxmodelSpacing']).'px;
	padding-top: '.intval(-1+0.5*$this->conf['theme.']['boxmodelSpacing']).'px;
}
.tx-tc-ct-form-field-1, .tx-tc-div-submit {
	margin-left: '.intval($this->conf['theme.']['boxmodelSpacing']).'px;
}

';
			//$marginhalfbm = intval(0.5*$this->conf['theme.']['boxmodelSpacing']);
		}
		for ($f=0; $f <= 20; $f++) {

			if (($this->conf['theme.']['boxmodelLevelIndent'] > 0) && ($this->conf['theme.']['boxmodelLevelIndent']<4)) {
				$scalebecauseofindent= ($this->conf['UserImageSize'] * ($f/$this->conf['theme.']['boxmodelLevelIndent']));
			} else {
				$scalebecauseofindent=0;
			}

			$labelwidth = round(($this->conf['theme.']['boxmodelLabelWidth'] - ($scalebecauseofindent/2)), 0);

			if ($labelwidth <= 50) {
				$labelwidth=50;
				$lcsssel .= ' ,.tx-tc-ct-box-rlvl-' . $f;
				$lcsssel2 .= ' ,.tx-tc-ct-box-rlvlm-' . $f;
			} else {
				$shiftleft = $f * $levelindent;
			}

			if (($labelwidth <= 50) && ($f<19)) {
				$scalebecauseofindent=0;
			} elseif (($labelwidth <= 50) && ($f ==19)) {
				$cssreplyindents .= '
' . substr($lcsssel, 2) . ' {
	width: ' . intval($labelwidth) . 'px;
}
' . substr($lcsssel2, 2) . ' {
	margin: 0 0 0 ' . $shiftleft . 'px;
	width: calc(100% - ' . $shiftleft . 'px);
}
';
			} else {
				$cssreplyindents .= '
.tx-tc-ct-box-rlvl-' . $f . ' {
	width: ' . intval($labelwidth) . 'px;
}
.tx-tc-ct-box-rlvlm-' . $f . ' {

	margin: 0 0 0 ' . $shiftleft . 'px;
	width: calc(100% - ' . $shiftleft . 'px);
}
';
			}
		}
		$highlightstyle = '
.tx-tc-highlightstyle {
	min-height: ' . (intval($this->conf['UserImageSize'])+4*intval($this->conf['theme.']['boxmodelSpacing'])) . 'px;
}
';
		$marginpiccomment = 0;

		if ($this->conf['theme.']['selectedBoxmodelkoogled']==1) {
			$marginpiccomment = 15;
			$themeopacity = 0.5;
		}

		if ($this->conf['useUserImage']==1) {
			$useUserImageSize = $this->conf['UserImageSize'];
			$ctpicvisibility = 'visible';
			$cssctpicform= '';
			$ctpicwidth = '';
		} else {
			$useUserImageSize = 0;
			$ctpicvisibility = 'hidden';
			$ctpicwidth = '
    width: 0px;';
			$marginpiccomment=-intval($this->conf['theme.']['boxmodelSpacing']);
			$cssctpicform= '.tx-tc-ct-box-ctpic2 {
	display: none;
}
.tx-tc-ct-rybox img {
    display: none;
}
.tx-tc-ucinner .tx-tc-ct-uc-pic {
    display: none;
}
.tx-tc-ct-uc-text-contact, .tx-tc-ct-uc-text-stats, .tx-tc-ct-uc-text-ip, .tx-tc-ct-uc-text, .tx-tc-ct-uc-text-contact-title {
    width: 92%;
}

';

		}
		$minheightcommentbox = intval($this->conf['UserImageSize']) + (3*(intval($this->conf['theme.']['boxmodelSpacing'])));

		$vidmaxwidth=round(intval($this->conf['attachments.']['webpagePreviewHeight'])*(4/3), 0);
		$websitepreviewareaimagewidth = intval($this->conf['attachments.']['webpagePreviewHeight']) + 10;

		$stylemargincontent=intval($this->conf['topRatings.']['topratingsimagesize'])+2*intval($this->conf['theme.']['boxmodelSpacing']);
		if ($this->conf['theme.']['selectedBoxmodelkoogled']==1) {
			$stylemargincontent=$stylemargincontent-6;
		}

		$vidmaxwidth=round(intval($this->conf['attachments.']['webpagePreviewHeight'])*(4/3), 0);
		$picstrvid='.tx-tc-pvs-vid-img-size {
	display: block;
	max-width: ' . $vidmaxwidth . 'px;
	max-height: ' . $this->conf['attachments.']['webpagePreviewHeight'] .'px;
}
';

		$wpplogoCSSmargin='.tx-tc-wpplogo {
	margin: 4px 0 0;
	max-height: ' . $this->conf['attachments.']['webpagePreviewHeight'] . 'px;
	max-width:' .(30+$this->conf['attachments.']['webpagePreviewHeight']) . 'px;
	float:right;
}
';

		$this->confid = $this->conf['UserImageSize'] . $this->conf['theme.']['boxmodelSpacing'] .$this->conf['theme.']['boxmodelLabelInputPreserve'].
										$this->conf['theme.']['boxmodelLineHeight'] . $this->conf['theme.']['boxmodelLabelWidth'] .
										intval($this->conf['attachments.']['webpagePreviewHeight']) .
										base64_encode(trim($this->conf['theme.']['themeFontFamily'])) .
										intval($this->conf['topRatings.']['topratingsnumberwidth']) .
										$this->conf['sharing.']['dontUseSharingFacebook'] . $this->conf['sharing.']['dontUseSharingTwitter'] .
										$this->conf['sharing.']['dontUseSharingGoogle'] . $this->conf['sharing.']['dontUseSharingLinkedIn'] .
										$this->conf['sharing.']['dontUseSharingStumbleupon'] . $this->conf['sharing.']['dontUseSharingPinterest'] .
										$this->conf['sharing.']['dontUseSharingDigg'] . $this->conf['sharing.']['dontUseSharingDelicious'] .
										$this->conf['theme.']['shareCountborderColor'] . $this->conf['theme.']['shareBackgroundColor'] .
										$this->conf['theme.']['shareborderColor1'] . $this->conf['theme.']['shareborderColor2'] .
										$this->conf['theme.']['borderColor'] . intval($this->showCSScomments) .
										$this->conf['ratings.']['useLikeDislikeStyle'];
		$csscontent = '/* confid: "6g9' . $this->confid . '6g9"
*/' . "\n";
		if (intval($this->showCSScomments) == 1) {
			$csscontent .= '/*
CSS file generated by toctoc_comments
Begin CSS Configured from TS-Variables in function checkCSSLoc

		userImageSize: ' . $this->conf['UserImageSize'] . 'px
		boxmodelSpacing:' . $this->conf['theme.']['boxmodelSpacing'] . 'px
		boxmodelLineHeight: ' .	$this->conf['theme.']['boxmodelLineHeight'] . 'px
		webpagePreviewHeight: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px
		topratingsnumberwidth: ' . intval($this->conf['topRatings.']['topratingsnumberwidth']) .'px;
		theme.themeFontFamily: ' . trim($this->conf['theme.']['themeFontFamily']) .';

		! Boxmodel, userImageSize, theme, ratings sharing configuration go together (and webpagePreviewHeight and topratingsnumberwidth)
		To use another configuration with the same boxmodel use a copy of the boxmodel and rename it to reflect the changes

*/' . "\n";
		}

		if ($this->conf['theme.']['usethemeFontFamilyForPlugin'] == 1) {
			$csscontent .= '.toctoc-comments-pi1 {
    font-family: ' . $this->conf['theme.']['themeFontFamily'] . ';
}
textarea.tx-tc-ctinput-textarea, textarea.tx-tc-ctinput-textarea-rq, input.tx-tc-ct-input, #cap-wrap .text-box label {
    font-family: ' . $this->conf['theme.']['themeFontFamily'] . ';
}
.tx-tc-ct-submit, .tx-tc-ct-reset, .tx-tc-ct-submit-loggedin, .tx-tc-cts-ctsbrowse-submit-hide, .tx-tc-cts-ctsbrowse-submit {
    		font-family: ' . $this->conf['theme.']['themeFontFamily'] . ';
}'. "\n";
		}

		$csscontent .= '.toctoc-comments-pi1 .tx-tc-cts .tx-tc-ct-box-cttxt {
    margin-left: ' . (intval($useUserImageSize)+6+(intval($this->conf['theme.']['boxmodelSpacing'])+$marginpiccomment)) . 'px;
}
.tx-tc-images-img {
    max-width: '.intval($this->conf['attachments.']['picUploadMaxDimWebpage']).'px;
}
@media (max-width: '.($this->arrResponsiveSteps[2]).'px) {
    .txtc_details {
    	width: 100% !important;
		display:table;
	}
	.txtc_details p, .txtc_details .txtc_h2 {
   		margin-right: '. (2*intval($this->conf['theme.']['boxmodelSpacing'])).'px;
	}
}
.tx-tc-img-image, .tx-tc-images-img-browse-frame {
    max-height: '.intval($this->conf['attachments.']['picUploadMaxDimYWebpage']).'px;
}
.tx-tc-ct-ry-report-line {
    margin: -4px 4px 2px ' . (intval($useUserImageSize)+10) . 'px;
}
.tx-tc-ct-rybox {
    min-height: ' . (intval($this->conf['UserImageSize'])+ 4 + intval($this->conf['theme.']['boxmodelLineHeight']-16)) . 'px;
}
.tx-tc-ct-box-picturecrop32 {
    height: ' . (intval($this->conf['UserImageSize'])-8) .'px;
}
.tx-tcresponse-text {
    margin: 0 0 0 ' . (intval($useUserImageSize)+10) .'px;
 }
.tx-tc-ct-form-field-1 {
   	margin-left: -' . (intval($useUserImageSize)) .'px;
}
.tx-tc-trt-rating {
    margin: 0 '.(intval($this->conf['theme.']['boxmodelSpacing'])).'px 0 0;
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
.tx-tc-ct-box-ctpic {
	visibility: '. $ctpicvisibility . ';' . $ctpicwidth . '
}
.tx-tc-div-submit {
	opacity: ' . $themeopacity . ';
}
.tx-tc-dtadyn {
	min-height: ' . $taheight . 'px;
	padding: 0 ' . $tapadding . 'px 0 0;
}
.tx-tc-hhalfbm {
	margin-left: '. $marginhalfbm .'px;
	font-weight: bold;
}
.tx-tc-ntf-check {
    margin: '. $margincheck .'px 8px 0 0 !important;
    line-height:'.intval($this->conf['theme.']['boxmodelLineHeight']).'px !important;
}
.tx-tc-sortind {
	margin-top: '. $sortind .'px;
}
.tx-tc-uimgsize {
	width: ' . intval($this->conf['UserImageSize']) . 'px;
	height: ' . intval($this->conf['UserImageSize']) . 'px;
}
textarea.tx-tc-ctinput-textarea, textarea.tx-tc-ctinput-textarea-rq {
	height: ' . $taheight . 'px;
}
.tx-tc-expandicon {
' . $expandiconCSSmargin . '
}
.tx-tc-vidimg {
	max-width: ' . $vidmaxwidth .'px;
}
.tx-tc-vidimgh5, .tx-tc-vidimg {
	max-height: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px;
}
.tx-tc-pvs-formtext {
	margin: 0 0 0 ' . (15+intval($this->conf['attachments.']['webpagePreviewHeight'])) . 'px;
}
.tx-tc-pvs-images {
	width: ' .	$websitepreviewareaimagewidth . 'px;
	height: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px;
}
.tx-tc-pvs-img {
	max-width: ' .	$websitepreviewareaimagewidth . 'px;
	max-height: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px;
}
.tx-tc-wpp-mrgn {
	margin: 5px 0 3px ' . $marginleftcommentingform . 'px;
}
.tc-tc-webpagepreview {
	min-height: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px;
}
.tx-tc-pvs-logobg {
	margin-top: -' . (7+intval($this->conf['attachments.']['webpagePreviewHeight'])) . 'px;
}
.tx-tc-pvs-logopic, .tx-tc-pvsmxhgt {
	max-height: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px;
}
.tx-tc-pvs-prevnext {
	margin-top: ' . (intval($this->conf['attachments.']['webpagePreviewHeight'])-8) . 'px;
	width: ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px;
}
.tx-tc-pvs-nopreviewpic {
	padding: 1px 2px 1px  ' . (intval($this->conf['attachments.']['webpagePreviewHeight'])-38) . 'px;
	margin-left: 24px;
}
.tx-tc-pvs-tamg {
	margin: 0 0 0 ' . (intval($this->conf['attachments.']['webpagePreviewHeight'])+7) . 'px;
}
.tx-tc-pvs-mnhgbox {
	min-height: ' . (intval($this->conf['attachments.']['webpagePreviewHeight'])+5) . 'px;
}
.tx-tc-frmsqrhgt {
	height: ' . (4 + (intval($this->conf['theme.']['boxmodelTextareaLineHeight']) * intval($this->conf['theme.']['boxmodelTextareaNbrLines']))  +
		(2 * intval($this->conf['theme.']['boxmodelSpacing']))) . 'px;
}
.tx-tc-mihgt-ctbox {
	min-height:' . $minheightcommentbox . 'px;
}
form.tx-tc-form-for-newcomment {
    padding: 0 0 ' .intval((3/2)*$this->conf['theme.']['boxmodelSpacing']) . 'px;
}
.tx-tc-trt-userisz {
	min-height: ' . intval($this->conf['topRatings.']['topratingsimagesize']) . 'px;
}
.tx-tc-mrgcnt-left {
	margin-left: ' .  intval($this->conf['theme.']['boxmodelSpacing']) . 'px;
}
.tx-tc-trt-rating-img + .tx-tc-trt-rating-detail .tx-tc-mrgcntnp-left {
	margin-left: ' . intval($this->conf['theme.']['boxmodelSpacing']). 'px;
}
.tx-tc-text-top {
	line-height: ' . $boxmodelLineHeightorReviewlineHeight . 'px;
}
' .
$cssctpicform .
$cssreplyindents .
$cssforminputspreserved .
$highlightstyle .
$picstrvid .
$wpplogoCSSmargin .
$closebuttonkooglemargin . '
.tx-tc-pi1 .tx-tc-cts-form-fieldtextarea-1 {
	min-height: ' . (intval($this->conf['UserImageSize'])) .'px;
}
';
if (intval($this->conf['ratings.']['useLikeDislikeStyle']) == 1) {
		$csscontent .= 	'div.tx-tc-cts-ct-dp div.tx-tc-ct-box div.tx-tc-ct-box-cttxt p.tx-tc-text {
			width: 80%;
		}';
}

	$csscontent .= 	$this->makesharingcss();
if (intval($this->showCSScomments) == 1) {
	$csscontent .= '/*
End CSS Configured from TS-Variables in function checkCSSLoc

Start CSS from tx-tc-' . $this->extVersion . '.css

Variables used in the boxmodel.txt-files res/css/boxmodels/system/boxmodel-system.txt and user-defined res/css/boxmodels/boxmodel.txt:
	boxmodelTextareaLineHeight: '.$this->conf['theme.']['boxmodelTextareaLineHeight'] . ',
	boxmodelTextareaHeight: ' . $this->boxmodelTextareaHeight . ',
	boxmodelSpacing: ' . intval($this->conf['theme.']['boxmodelSpacing']) . ',
	boxmodelLineHeight: ' . $this->conf['theme.']['boxmodelLineHeight'] . ',
	boxmodelLineHeightHalf: ' . round(($this->conf['theme.']['boxmodelLineHeight']-16)/2, 0) . ',
	boxmodelSpacingHalf: ' . round(($this->conf['theme.']['boxmodelSpacing'])/2, 0) . ',
	boxmodelInputFieldSize: ' . intval($this->conf['theme.']['boxmodelInputFieldSize']) . ',
	boxmodelLabelInputPreserve: ' . intval($this->conf['theme.']['boxmodelLabelInputPreserve']) . ',
	boxmodelLabelWidth: ' . intval($this->conf['theme.']['boxmodelLabelWidth']) . ',
	picUploadMaxDimX: ' . $this->conf['attachments.']['picUploadMaxDimX'] . ',
	userImageSize: ' . $this->conf['userImageSize'] . ',
	ratingImageWidth: ' . $this->conf['ratings.']['ratingImageWidth'] . '
	reviewImageWidth: ' . $this->conf['ratings.']['reviewImageWidth'] . '
*/';
}

		$this->confcss=$csscontent . "\n";
		return '';
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	protected function makesharingcss () {
		$retcss = '';
		$confdontUseSharingStumbleupon = $this->conf['sharing.']['dontUseSharingStumbleupon'];
		$confdontUseSharingDigg = $this->conf['sharing.']['dontUseSharingDigg'];
		$confdontUseSharingDelicious = $this->conf['sharing.']['dontUseSharingDelicious'];
		if (@$_SERVER['HTTPS'] == 'on') {
			// on https StumbleUpon and Digg fail ... and also Delious cause braking SSL-certs
			$confdontUseSharingStumbleupon = 1;
			$confdontUseSharingDigg = 1;
			$confdontUseSharingDelicious = 1;

		}
		if ($this->conf['sharing.']['sharingNoCalculatedCSS'] == 0) {
			$hasValidSharingItems = 0;
			$golang= $_SESSION['activelang'];

			$fbminwidthcorr=0;
			$twminwidthcorr=0;
			$piminwidthcorr=0;
			if ($golang!='en') {

				if ($golang==='de') {
					$fbminwidthcorr=34;
					$twminwidthcorr=12;
				}

				if ($golang==='fr') {
					$fbminwidthcorr=10;
					$twminwidthcorr=12;
				}

				if ($golang==='es') {
					$fbminwidthcorr=28;
					$twminwidthcorr=12;
				}

				if ($golang==='pt') {
					$fbminwidthcorr=12;
					$twminwidthcorr=12;
				}

				if ($golang==='pl') {
					$fbminwidthcorr=24;
					$twminwidthcorr=14;
				}

				if ($golang==='hu') {
					$fbminwidthcorr=14;
				}

				if ($golang==='it') {
					$fbminwidthcorr=20;
				}

				if ($golang==='dk') {
					$fbminwidthcorr=54;
				}

				if ($golang==='gr') {
					$fbminwidthcorr=40;
					}

				if ($golang==='ru') {
					$fbminwidthcorr=52;
					$twminwidthcorr=22;
				}

				if ($golang==='nl') {
					$fbminwidthcorr=34;
				}

				if ($golang==='he') {
					$fbminwidthcorr=18;
					$twminwidthcorr=24;
				}

				if ($golang==='ar') {
					$fbminwidthcorr=20;
					$twminwidthcorr=10;
				}

			}
			$accumulatedwidth=0;
			$leftpxfb=0;
			$leftpxtw=0;
			$leftpxgo=0;
			$leftpxli=0;
			$leftpxst=0;
			$leftpxpi=0;
			$leftpxdi=0;
			if ($this->conf['sharing.']['dontUseSharingFacebook'] !=1 ) {
				$hasValidSharingItems++;
				$leftpxfb = 4;
				$accumulatedwidth += 60 + $fbminwidthcorr;
			}

			if ($this->conf['sharing.']['dontUseSharingTwitter'] !=1 ) {
				$hasValidSharingItems++;
				$leftpxtw = 4 + $accumulatedwidth;
				$accumulatedwidth += 64 + $twminwidthcorr;
			}

			if ($this->conf['sharing.']['dontUseSharingGoogle'] !=1 ) {
				$hasValidSharingItems++;
				$leftpxgo= 4 + $accumulatedwidth;
				$accumulatedwidth += 55;
			}

			if ($this->conf['sharing.']['dontUseSharingLinkedIn'] !=1 ) {
				$hasValidSharingItems++;
				$leftpxli = 4 + $accumulatedwidth;
				$accumulatedwidth += 72;
			}

			if ($confdontUseSharingStumbleupon !=1 ) {
				$hasValidSharingItems++;
				$leftpxst = 4 + $accumulatedwidth;
				$accumulatedwidth += 56;
			}

			if ($this->conf['sharing.']['dontUseSharingPinterest'] !=1 ) {
				$hasValidSharingItems++;
				$leftpxpi = 4 + $accumulatedwidth;
				$accumulatedwidth += 48;
			}

			if ($confdontUseSharingDigg !=1 ) {
				$hasValidSharingItems++;
				$leftpxdi = 4 + $accumulatedwidth;
				$accumulatedwidth += 62;
			}

			if ($confdontUseSharingDelicious !=1 ) {
				$hasValidSharingItems++;
				$leftpxde = 4 + $accumulatedwidth;
				$accumulatedwidth += 54;
			}

			$buttonscountwidth = 4 + $accumulatedwidth;
			$shareboxopenwidth = 41 + $hasValidSharingItems*20;
			if (intval($this->showCSScomments) == 1 ) {
				$retcss = '/*
sharrre design 2 and 4, calculated specifics
*/';
			}

			$retcss .= '
.shrdes2 .buttons {
	background: none repeat scroll 0 0 #' . $this->conf['theme.']['shareBackgroundColor'] . ';
	border-color: #' . $this->conf['theme.']['shareborderColor2'] . ' #' . $this->conf['theme.']['shareborderColor2'] . ' #' .
	$this->conf['theme.']['shareborderColor1'] . ';
	-webkit-box-shadow: 0 1px 2px #' . $this->conf['theme.']['borderColor'] . ';
	-moz-box-shadow: 0 1px 2px #' . $this->conf['theme.']['borderColor'] . ';
	box-shadow: 0 1px 2px #' . $this->conf['theme.']['borderColor'] . ';
}
.shrdes4 .count {
	border-right:1px solid #' . $this->conf['theme.']['shareCountborderColor'] . ';
}
.shrdes4 .buttons {
	background: none repeat scroll 0 0 #' . $this->conf['theme.']['shareBackgroundColor'] . ';
	-webkit-box-shadow: 0 1px 2px #' . $this->conf['theme.']['borderColor'] . ';
	-moz-box-shadow: 0 1px 2px #' . $this->conf['theme.']['borderColor'] . ';
	box-shadow: 0 1px 2px #' . $this->conf['theme.']['borderColor'] . ';
}
.shrdes4 .facebook {
	left: ' . $leftpxfb . 'px;
}
';
		}
		return $retcss;
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
				'tx_toctoc_comments_prefixtotable', $tmpwhere, $tmpsorting);
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
	 * Initializes the externaluid
	 *
	 * @param	boolean		$withinitprefixToTableMap	With init of $this->conf['showUidMap.'] (needed for toctoccommentsce-hook)
	 * @return	boolean		FALSE if no comment plugin should be shown (community setting)
	 */
	protected function initexternaluid($withinitprefixToTableMap) {
		if ($withinitprefixToTableMap == TRUE) {
			$this->initprefixToTableMap();
		}

		if ($this->conf['showUidMap.'][$this->conf['externalPrefix']]) {
			$this->showUidParam = $this->conf['showUidMap.'][$this->conf['externalPrefix']];
		}

		$ar = t3lib_div::_GP($this->conf['externalPrefix']);

		$this->externalUid = (is_array($ar) ? intval($ar[$this->showUidParam]) : FALSE);

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
							'additionalParams' => t3lib_div::implodeArrayForUrl('', $params, '', 1),
							'ATagParams' => 'rel="nofollow"',
					);
					$_SESSION['communityprofilepage']= $this->cObj->typoLink('dummy', $conflink);
					$_SESSION['communityprofilepageparams']='';
					if (strpos($_SESSION['communityprofilepage'], '9999999')===FALSE) {
						$conflink = array(
								'useCacheHash'     => $useCacheHashNeeded,
								'no_cache'         => $no_cacheflag,
								'parameter'        => $profilepage,
								'ATagParams' => 'rel="nofollow"',
						);
						$_SESSION['communityprofilepage']= $this->cObj->typoLink('dummy', $conflink);
						$_SESSION['communityprofilepageparams']= t3lib_div::implodeArrayForUrl('', $params, '', 1);
						if (strpos($_SESSION['communityprofilepage'], '?')===FALSE) {
							$_SESSION['communityprofilepageparams']= '?' . substr($_SESSION['communityprofilepageparams'], 1);
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
						$buddies= $this->lib->usersGroupmembers($this, FALSE, $this->conf);
						$this->conf['advanced.']['wallExtension']=$safewe;
						$budarr=explode(',', $buddies);

						if (!in_array($this->externalUid, $budarr)) {
							if ($this->communityFriendsProfileListAccessright==1) {
								return FALSE;
							} elseif ($this->communityFriendsProfileListAccessright==2) {
								$this->conf['code']='COMMENTS';
							}

						}

						if ($this->communityFriendsProfileListAccessright==0) {
							if ($this->externalUid != $GLOBALS['TSFE']->fe_user->user['uid']) {
								return FALSE;
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
				$buddies= $this->lib->usersGroupmembers($this, FALSE, $this->conf);
				$this->conf['advanced.']['wallExtension']=$safewe;
				$budarr=explode(',', $buddies);

				if (!in_array($this->externalUid, $budarr)) {
					if ($this->communityFriendsProfileListAccessright==1) {
						return FALSE;
					} elseif ($this->communityFriendsProfileListAccessright==2) {
						$this->conf['code']='COMMENTS';
					}

				}

				if ($this->communityFriendsProfileListAccessright==0) {
					if ($this->externalUid != $GLOBALS['TSFE']->fe_user->user['uid']) {
						return FALSE;
					}

				}

			}

		}

		$this->foreignTableName = $this->conf['prefixToTableMap.'][$this->conf['externalPrefix']];
		$_SESSION['commentListRecord']=$this->foreignTableName . '_' . $this->externalUid;
		return TRUE;
	}

	/**
	 * Initializes the plugin
	 *
	 * @return	boolean		FALSE if no comment plugin should be shown (community setting)
	 */
	protected function init() {
		if ($this->showsdebugprint==TRUE) {
			$this->sdebuginitprint='';
			$starttimedebug=microtime(TRUE);
		}

		$this->initprefixToTableMap();

		if ($this->showsdebugprint==TRUE) {
			$endtimedebug=microtime(TRUE);
			$this->sdebuginitprint.=' (InitprefixToTableMap: ' . round(1000*($endtimedebug - $starttimedebug), 1) .', ';
		}

		$this->mergeConfiguration();

		if ($this->showsdebugprint==TRUE) {
			$starttimedebug=microtime(TRUE);
			$this->sdebuginitprint.='MergeConfiguration: ' . round(1000*($starttimedebug - $endtimedebug), 1) .', ';
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
				$_SESSION['commentListRecord']='tt_content_' . $this->externalUid;
			} else {

				$like = '%<field index="externalPrefix">\n                    <value index="vDEF">5</value>%';
				$origidswhere= ' pages.uid = tt_content.pid AND tt_content.pi_flexform LIKE \'' . $like . '\' ' .
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
			if ($this->initexternaluid(FALSE) == FALSE) {
				return FALSE;
			}

		} else {
			// We are commenting normally
			$this->externalUid = $GLOBALS['TSFE']->id;
			$this->foreignTableName = 'pages';
			$this->showUidParam = '';
			// $_SESSION['commentListRecord'] will be set later after the selection of $_SESSION['commentListIndex']
		}

		if ($this->showsdebugprint==TRUE) {
			$endtimedebug=microtime(TRUE);
			$this->sdebuginitprint.='Setting up Table maps: ' . round(1000*($endtimedebug - $starttimedebug), 1) .', ';
		}

		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $this->conf['templateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
		$this->templateCode = $this->cObj->fileResource($usetemplateFile);

		$key = 'EXT:toctoc_comments_' . md5($this->templateCode);
		if ($this->showsdebugprint==TRUE) {
			$this->sdebuginitprint.='Reading Templatefile: ' . $this->conf['templateFile'] . ': ' . round(1000*(microtime(TRUE) - $endtimedebug), 1) .', ';
		}

		if (!isset($GLOBALS['TSFE']->additionalHeaderData[$key])) {
			$headerParts = $this->cObj->getSubpart($this->templateCode, '###HEADER_ADDITIONS###');
			if ($headerParts) {
				if ($this->showsdebugprint==TRUE) {
					$starttimedebug2=microtime(TRUE);
				}

				if ($this->conf['theme.']['selectedTheme']!=$_SESSION['selectedTheme']) {
					$forceregenerate = TRUE;
					$_SESSION['AJAXimages'] = array();
					$_SESSION['selectedTheme']=$this->conf['theme.']['selectedTheme'];
					$_SESSION['DefaultUserImage'] = array();
				}
				$this->processcssandjsfiles=TRUE;
				$ckeckresult=$this->checkCSSTheme();
				if ($ckeckresult!='') {
					return $ckeckresult;
				}
				$this->checkCSSLoc();
				$this->boxmodel();
				if ($this->showsdebugprint==TRUE) {
					$endtimedebug2=microtime(TRUE);
					$this->sdebuginitprint.='Boxmodel: ' . round(1000*($endtimedebug2 - $starttimedebug2), 1) .', ';
					$starttimedebug2=microtime(TRUE);
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

				if ($this->showsdebugprint==TRUE) {
					$starttimedebug21=microtime(TRUE);
					$this->sdebuginitprint.='Check new comments: ' . round(1000*($starttimedebug21 - $starttimedebug2), 1) .', ';
				}

				$loginRequiredIdLoginForm ='';
				if (($this->conf['advanced.']['loginRequired'] == 1) || ($this->conf['pluginmode'] == 5)) {
					$loginRequiredIdLoginForm = 'tx-tc-loginform';
				}
				$tlogon=0;
				if (intval($GLOBALS['TSFE']->fe_user->user['uid']) > 0) {
					$tlogon=1;
				}

				$this->tcchangepasswordcard = '';
				$locchangePasswordFormhtml= '	var tcpasswordcard ="";
';

				$rsajsloc = 'resources';
				if (version_compare(TYPO3_version, '6.3', '>')) {
					$rsajsloc = 'Resources/Public/JavaScript';
				}
				
				$rsajsstr = '<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/jsbn.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/prng4.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/rng.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/rsa.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/base64.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/rsaauth_min.js"></script>';
				
				if ((intval($this->conf['advanced.']['loginRequired']) == 0) && ($this->conf['pluginmode'] != 5)) {
					$locLoginFormhtml= '	var tclogincard ="";
';
					$rsajsstr = '';
				} else {

					$postDatapi2 =  t3lib_div::_GET('tx_toctoccomments_pi2');

					if ($postDatapi2['forgothash']) {
						$getChangePasswordForm = $this->lib->getChangePasswordForm($postDatapi2['user'], $postDatapi2['forgothash']);
						$getChangePasswordForm= str_replace('<div id="tx_toctoccomments_pi2">', '<div id="tx_toctoccomments_pi2_cp">', $getChangePasswordForm);
						$getChangePasswordForm= str_replace('<div id="tx_toctoccomments_pi2_indication" class="tx-tc-nodisp"></div>', '', $getChangePasswordForm);
						$this->tcchangepasswordcard =$getChangePasswordForm;
						$locchangePasswordFormhtmlenc = base64_encode($getChangePasswordForm);
						$_SESSION['doChangePasswordForm'] = 2;
						$locchangePasswordFormhtml= '	var tcpasswordcard ="' . $locchangePasswordFormhtmlenc . '";
';
					}

					$locLoginFormhtml= str_replace('<div id="tx_toctoccomments_pi2_indication" class="tx-tc-nodisp"></div>', '',
							$this->lib->getLoginForm());
					$locLoginFormhtml= str_replace('<div id="tx_toctoccomments_pi2">', '',
							$locLoginFormhtml);
					$locLoginFormhtml= substr($locLoginFormhtml, 0, (strlen($locLoginFormhtml)-6));
					$locLoginFormhtml= str_replace('###PERMALOGIN_VALID###', '',
							$locLoginFormhtml);
					$locLoginFormhtml= str_replace('###FORGOTP_VALID###', '',
							$locLoginFormhtml);
					$locLoginFormhtml= str_replace('###SIGNON_FORM###', '',
							$locLoginFormhtml);
					$loctest= explode('<div class="tx-tc-loginform" id="tx-tc-loginform">', $locLoginFormhtml);
					if  (intval($this->conf['pluginmode']) != 5) {
						$locLoginFormhtml= str_replace('<div class="tx-tc-loginform" id="tx-tc-loginform">', '', $locLoginFormhtml);
						$locLoginFormhtml= substr($locLoginFormhtml, 0, (strlen($locLoginFormhtml)-6));
						$locLoginFormhtmlarr = explode('<!-- ###LOGIN_FORM### -->', $locLoginFormhtml);
						if(count($locLoginFormhtmlarr)>1) {
							$locLoginFormhtmlarr[2]=substr($locLoginFormhtmlarr[2], 8);
						}

						$locLoginFormhtml=implode('', $locLoginFormhtmlarr);
						$testlogoutarr = explode('formlo', $locLoginFormhtml);
						$locLoginFormhtml=substr($locLoginFormhtml, 0, strlen($locLoginFormhtml));
					} elseif ((intval($this->conf['pluginmode']) == 5) && (count($loctest) > 2)){
						$locLoginFormhtml= substr($locLoginFormhtml, strlen('<div class="tx-tc-loginform" id="tx-tc-loginform">'));
						$locLoginFormhtmlarr = explode('<!-- ###LOGIN_FORM### -->', $locLoginFormhtml);
						if(count($locLoginFormhtmlarr)>2) {
							$locLoginFormhtmlarr[3]=substr($locLoginFormhtmlarr[3], 8);
						}

						$locLoginFormhtml=implode('ttt', $locLoginFormhtmlarr);
					} elseif ((intval($this->conf['pluginmode']) == 5) && (count($loctest)<3)){
						$testlogoutarr = explode('formlo', $locLoginFormhtml);
						$adddiv='</div>';
						if (count($testlogoutarr) > 1) {
							$adddiv='';
						}

						$locLoginFormhtmlarr = explode('<!-- ###LOGIN_FORM### -->', $locLoginFormhtml);
						if(count($locLoginFormhtmlarr) > 2) {
							$locLoginFormhtmlarr[3] =substr($locLoginFormhtmlarr[3], 8);
						}

						$locLoginFormhtml = implode('', $locLoginFormhtmlarr) . $adddiv;

					}

					$locLoginFormhtmlarr = explode('<!-- ###FORGOT_FORM### -->', $locLoginFormhtml);
					if(count($locLoginFormhtmlarr) > 1) {
						$locLoginFormhtmlarr[2] = substr($locLoginFormhtmlarr[2], 8);
					}

					$locLoginFormhtml = implode('', $locLoginFormhtmlarr);
					$locLoginFormhtml = str_replace('<!--', '', $locLoginFormhtml);
					$locLoginFormhtml = str_replace('User login', '', $locLoginFormhtml);
					$locLoginFormhtml = str_replace('-->', '', $locLoginFormhtml);

					$locLoginFormhtml = trim($locLoginFormhtml);
					$locLoginFormhtmlarr = explode('</form>', $locLoginFormhtml);
					$locLoginFormhtmlarr[1] = trim($locLoginFormhtmlarr[1]);
					$locLoginFormhtml = implode('</form>', $locLoginFormhtmlarr);
					$locLoginFormhtmlarr = array();
					$locLoginFormhtmlarr = explode('</form>', $locLoginFormhtml);
					$locLoginFormhtmlarr[count($locLoginFormhtmlarr)-1] = '</div>';
					$locLoginFormhtml = implode('</form>', $locLoginFormhtmlarr);
					// rsa
					$locLoginFormhtmlarr = array();
					$locLoginFormhtmlarr = explode('id="rsa_n"', $locLoginFormhtml);
					if (count($locLoginFormhtmlarr) > 1) {
						$rsajscompletestr = substr($locLoginFormhtmlarr[0], 0, (strlen($locLoginFormhtmlarr[0])-21));
						$locLoginRsaJsarr = array();
						$locLoginRsaJsarr = explode('[noredirect]"', $rsajscompletestr);
						if (count($locLoginRsaJsarr) > 1) {
							$rsajsstroff = trim(substr($locLoginRsaJsarr[1], 13));
							$locLoginFormhtml= str_replace($rsajsstroff, '', $locLoginFormhtml);
						}

					}
					if ($this->conf['theme.']['boxmodelLabelInputPreserve']==1) {
						$locLoginFormhtml = str_replace('class="tx-tc-loginform', 'class="tx-tc-loginform tx-tc-responsive', $locLoginFormhtml);
					}

					$this->tclogincard = str_replace('Youre logged in.', '', $locLoginFormhtml);
					$locLoginFormhtml = base64_encode($locLoginFormhtml);
					$locLoginFormhtml = '	var tclogincard ="' . $locLoginFormhtml . '";
';
				}

				$jscontent = ' var errCommentRequiredLength = ' . intval($this->conf['minCommentLength']) . ';' . "\n";
				$jscontent .= '	var errSearchRequiredLength = ' . intval($this->conf['search.']['minSearchTermLength']) . ';' . "\n";
				$jscontent .= '	var maxCommentLength = ' . intval($this->conf['maxCommentLength']) . ';' . "\n";
				$jscontent .= '	var selectedTheme = "' . $this->conf['theme.']['selectedTheme'] . '";' . "\n";
				$jscontent .= '	var boxmodelTextareaAreaTotalHeight = ' . intval($this->boxmodelTextareaAreaTotalHeight) . ';' . "\n";

				$jscontent .= '	var boxmodelTextareaHeight = ' . intval($this->boxmodelTextareaHeight) . ';' . "\n";
				if ($this->conf['theme.']['boxmodelLabelInputPreserve']==0) {
					$jscontent .= '	var boxmodelLabelWidth = ' . intval($this->conf['theme.']['boxmodelLabelWidth']) . ';' . "\n";
				}else {
					$jscontent .= '	var boxmodelLabelWidth = 0;' . "\n";
				}
				$jscontent .= '	var dolabel = ' . intval($this->conf['advanced.']['watermarkFormFields']) . ';' . "\n";
				$jscontent .= '	var boxmodelSpacing = ' . intval($this->conf['theme.']['boxmodelSpacing']) . ';' . "\n";
				$jscontent .= '	var boxmodelLineHeight = ' . intval($this->conf['theme.']['boxmodelLineHeight']) . ';' . "\n";
				$jscontent .= '	var confpvsheight = ' . intval($this->conf['attachments.']['webpagePreviewHeight']) . ';' . "\n";
				$jscontent .= '	var confcommentsPerPage = ' . intval($this->conf['advanced.']['commentsPerPage']) . ';' . "\n";
				$jscontent .= '	var tcdateformat = ' . $this->conf['advanced.']['dateFormatOldStyle'] . ';' . "\n";
				$jscontent .= '	var confuserpicsize = ' . intval($this->conf['UserImageSize']) . ';' . "\n";
				$jscontent .= '	var confuseUserImage = ' . intval($this->conf['useUserImage']) . ';' . "\n";
				$jscontent .= '	var showlesstooltips = ' . intval($this->conf['theme.']['useLessToolTips']) . ';' . "\n";
				$jscontent .= '	var emojinotooltips = ' . intval($this->conf['theme.']['emojiNoToolTips']) . ';' . "\n";
				$jscontent .= ' var middotchar = \'' . $this->middotchar .'\'' . "\n";
				$jscontent .= '	var confreplyModeInline = ' . intval($this->conf['advanced.']['replyModeInline']) . ';' . "\n";
				$jscontent .= '	var confreplyModeInlineOpenForm = ' . intval($this->conf['advanced.']['replyModeInlineOpenForm']) . ';' . "\n";
				$jscontent .= '	var textnameCommentSeparator = "' . base64_encode(trim($this->conf['advanced.']['nameCommentSeparator'])) . '";' . "\n";
				$jscontent .= '	var confuseNameCommentSeparator = ' . intval($this->conf['advanced.']['useNameCommentSeparator']) . ';' . "\n";
				$starttimedebug22=microtime(TRUE);
				$jsservervars = $rsajsstr . '<script type="text/javascript">
	var tccommnetidstart = ' . $mincommentid  .';
	var tccommnetidto = ' . $maxcommentid  .';
	var pageid = ' . $GLOBALS['TSFE']->id .';
	var loginRequiredIdLoginForm = "' . $loginRequiredIdLoginForm .'";
	var loginRequiredRefreshCIDs = "";
	var loginRequiredRefreshRecs = "";
	var global_loggedon = '. $tlogon . ';' . "\n". $locLoginFormhtml . $locchangePasswordFormhtml . "\n". '
</script>'. "\n". '<script type="text/javascript">
' . $jscontent . "\n". '</script>';

				$lancode= $_SESSION['activelang'];
				if ($this->conf['theme.']['selectedBoxmodel'] !='') {
					$lancode=str_replace('.txt', '-', $this->conf['theme.']['selectedBoxmodel']) . $_SESSION['activelang'];
				}

				$emojicss='';
				$emojifycss='';
				$emojijs='';

				if ($this->conf['advanced.']['useEmoji']>0) {
					$filenm = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/js/tx-tc-premojify.js';
					$mod1_file = $this->createVersionNumberedFilename($filenm);
					$emojijs='<script type="text/javascript" src="'. $mod1_file . '"></script>';
				}

				if ($this->conf['advanced.']['useEmoji']==1) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/emoji/emoji16.css" rel="stylesheet" type="text/css"/>';
				} elseif ($this->conf['advanced.']['useEmoji']==2) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/emoji/emoji20.css" rel="stylesheet" type="text/css"/>';
				} elseif ($this->conf['advanced.']['useEmoji']==3) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/emoji/emoji26.css" rel="stylesheet" type="text/css"/>';
				} elseif ($this->conf['advanced.']['useEmoji']==4) {
					$emojicss='<link href="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/emoji/emoji33.css" rel="stylesheet" type="text/css"/>';
				}

				$ajaxloginjs='';
				$freecapjs='';
				if ((intval($this->conf['advanced.']['loginRequired']) == 1) || (intval($this->conf['pluginmode']) == 5)) {
					$confpi2 = $this->lib->getDefaultConfig('tx_toctoccomments_pi2');
					$filenm = $GLOBALS['TSFE']->tmpl->getFileName('EXT:toctoc_comments/res/js/tx-tc-afl-' . $this->extVersion . '.js');
					$mod1_file = $this->createVersionNumberedFilename($filenm);

					$ajaxloginjs='<script type="text/javascript" src="'.$mod1_file.'"></script>';

					$nogoogle = FALSE;
					if (!isset($confpi2['google.']['ClientID']) || $confpi2['google.']['ClientID'] == '') {
						$nogoogle = TRUE;
					}

					if (!isset($confpi2['google.']['ClientSecret']) || $confpi2['google.']['ClientSecret'] == '') {
						$nogoogle = TRUE;
					}
					$googleloginjs = '';
					if ($nogoogle == FALSE) {
						$googlelan = $this->fbgoogle_lan(FALSE);
						$googleloginjs= '<script>
  window.___gcfg = {
    lang: \'' . $googlelan . '\'
  };
</script>
 <script src="https://apis.google.com/js/client:platform.js" async defer></script>
';
					}

					if (t3lib_extMgm::isLoaded('sr_freecap')) {

						if (is_array($confpi2)) {
							if ($confpi2['register.']['enableSignup'] == 1) {
								$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/pi1');
								$filenamefreecap= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR .
										t3lib_extMgm::siteRelPath('sr_freecap') . 'pi2/freeCap.js' );
								if (file_exists($filenamefreecap)) {
									$filenm = 'typo3conf/ext/sr_freecap/pi2/freeCap.js';
									$mod1_file = $this->createVersionNumberedFilename($filenm);
									$freecapjs= "\n" . '<script type="text/javascript" src="'. $mod1_file. '"></script>';
								} else {
									$filenm = 'typo3conf/ext/sr_freecap/Resources/Public/JavaScript/freeCap.js';
									$mod1_file = $this->createVersionNumberedFilename($filenm);
									$freecapjs= "\n" . '<script type="text/javascript" src="'. $mod1_file. '"></script>';
								}

							}

						}

					}

				}
				$filenm = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/css/' . $this->boxmodelcss;
				$mod1_file = $this->createVersionNumberedFilename($filenm);
				$filenm2 = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/tx-tc-' .$this->extVersion. '.js';
				$jsmain = $this->createVersionNumberedFilename($filenm2);
				$filenjqt = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/jquery.toctoc.tools.min.js';
				$jquerytoolsfile = '<script type="text/javascript" src="' . $this->createVersionNumberedFilename($filenjqt) .'"></script>';

				$arrpagejslibs = ($GLOBALS['TSFE']->pSetup['includeJSlibs.']);
				$arrpagejs = ($GLOBALS['TSFE']->pSetup['includeJS.']);
				$arrfooterjs = ($GLOBALS['TSFE']->pSetup['includeJSFooterlibs.']);

				$jqueryfound = FALSE;
				$jquerytoolsfound = FALSE;
				if (is_array($arrpagejslibs)){
					foreach ($arrpagejslibs as $keyofpagesetup => $valueoftext) {
						$strtest = str_replace('jquery-1', '', $valueoftext);
						if ($strtest!=$valueoftext) {
							$jqueryfound = TRUE;

						}
						$strtest = str_replace('jquery.tools.min', '', $valueoftext);
						if ($strtest!=$valueoftext) {
							$jquerytoolsfound = TRUE;
						}
					}
				}
				if (is_array($arrpagejs)){
					foreach ($arrpagejs as $keyofpagesetup => $valueoftext) {
						$strtest = str_replace('jquery-1', '', $valueoftext);
						if ($strtest!=$valueoftext) {
							$jqueryfound = TRUE;
						}
						$strtest = str_replace('jquery.tools.min', '', $valueoftext);
						if ($strtest!=$valueoftext) {
							$jquerytoolsfound = TRUE;
						}
					}
				}
				if (is_array($arrfooterjs)){
					foreach ($arrfooterjs as $keyofpagesetup => $valueoftext) {
						$strtest = str_replace('jquery-1', '', $valueoftext);
						if ($strtest!=$valueoftext) {
							$jqueryfound = TRUE;
						}
					}
				}

				// compatibility fix for updates from version 5.1 to 5.1.1
				if ($jquerytoolsfound == TRUE) {
					$jquerytoolsfile = '<!-- jquery.tools.min found in page.includeJSlibs, you can delete it from there, the new jquery.toctoc.tools.min.js will then be loaded in this place -->';
				}

				if ($jqueryfound == FALSE) {
					$jquerytoolsfile .= "\n" . '<!-- Warning: jquery not found in page.includeJSlibs, nor includeJS or includeJSFooterlibs -->';
				}

				$headerParts = $this->cObj->substituteMarkerArrayCached($headerParts, array(
						'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
						'###LANCODE###' => $lancode,
						'###JQUERYTOOLS###' => $jquerytoolsfile,
						'###BOXMODEL###' => $mod1_file,
						'###EMOJICSS###' => $emojicss,
						'###EMOJIJS###' => $emojijs,
						'###AJAXLOGINJS###' => $ajaxloginjs . $freecapjs . $googleloginjs,
						'###JSSERVERVARS###' => $jsservervars,
						'###JSMAIN###' => $jsmain,
				), $subParts);
				$GLOBALS['TSFE']->additionalHeaderData[$key] = $headerParts;
				if ($this->showsdebugprint==TRUE) {
					$endtimedebug2=microtime(TRUE);
					$this->sdebuginitprint.='Header: ' . round(1000*($endtimedebug2 - $starttimedebug22), 1) .', ';

				}

			}
			$filenm = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/js/tx-tc-ftr-' . $this->extVersion . '.js';
			$mod1_file = $this->createVersionNumberedFilename($filenm);
			$GLOBALS['TSFE']->additionalFooterData[$key] = '<script src="'. $mod1_file . '" type="text/javascript"></script>';
		}

		// We are commenting on cid
		if ($this->showsdebugprint==TRUE) {
			$starttimedebug2=microtime(TRUE);
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
				$this->where_dpck = 'external_ref=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->foreignTableName . '_' .
										$this->externalUid, 'tx_toctoc_comments_comments') .
				' AND ' . ($tmpint ?
				'pid=' . $this->conf['storagePid'] : 'pid IN (' . $this->conf['storagePid'] . ')') .
				$this->cObj->enableFields('tx_toctoc_comments_comments');
			}

		}

		$this->where = 'approved=1 AND ' . $this->where_dpck;

		$this->ref=$this->foreignTableName . '_' . $this->externalUid;
		if ($this->showsdebugprint==TRUE) {
			$endtimedebug2=microtime(TRUE);
			$this->sdebuginitprint.='Init end: ' . round(1000*($endtimedebug2 - $starttimedebug2), 1) .') ';

		}

		return TRUE;

	}

	/**
	 * Merges TS configuration with configuration from flexform (latter takes precedence).
	 *
	 * @return	void
	 */
	protected function mergeConfiguration() {
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
		$this->fetchConfigValue('advanced.commentReview');
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
		$this->fetchConfigValue('advanced.shareUsersTotalText');
		$this->fetchConfigValue('advanced.shareDataText');
		$this->fetchConfigValue('advanced.sharePageURL');

		$this->fetchConfigValue('sharing.useSharingV2');
		$this->fetchConfigValue('sharing.dontUseSharingFacebookV2');
		$this->fetchConfigValue('sharing.dontUseSharingGoogleV2');
		$this->fetchConfigValue('sharing.dontUseSharingTwitterV2');
		$this->fetchConfigValue('sharing.dontUseSharingLinkedInV2');
		$this->fetchConfigValue('sharing.dontUseSharingStumbleuponV2');
		$this->fetchConfigValue('sharing.shareUsersTotalTextV2');
		$this->fetchConfigValue('sharing.shareDataTextV2');
		$this->fetchConfigValue('sharing.sharePageURLV2');

		if (isset($this->conf['sharing.']['useSharingV2'])) {
			if ($this->conf['sharing.']['useSharingV2'] != '') {
				$this->conf['sharing.']['useSharing']=$this->conf['sharing.']['useSharingV2'];
			}
			unset($this->conf['sharing.']['useSharingV2']);
		} elseif ($this->conf['advanced.']['useSharing'] != 0) {
			$this->conf['sharing.']['useSharing']=$this->conf['advanced.']['useSharing'];
		}

		if (isset($this->conf['sharing.']['dontUseSharingFacebookV2'])) {
			if ($this->conf['sharing.']['dontUseSharingFacebookV2'] != '') {
				$this->conf['sharing.']['dontUseSharingFacebook']=$this->conf['sharing.']['dontUseSharingFacebookV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingFacebookV2']);
		} elseif ($this->conf['advanced.']['dontUseSharingFacebook'] != 0) {
			$this->conf['sharing.']['dontUseSharingFacebook']=$this->conf['advanced.']['dontUseSharingFacebook'];
		}

		if (isset($this->conf['sharing.']['dontUseSharingGoogleV2'])) {
			if ($this->conf['sharing.']['dontUseSharingGoogleV2'] != '') {
				$this->conf['sharing.']['dontUseSharingGoogle']=$this->conf['sharing.']['dontUseSharingGoogleV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingGoogleV2']);
		} elseif ($this->conf['advanced.']['dontUseSharingGoogle'] != 0) {
			$this->conf['sharing.']['dontUseSharingGoogle']=$this->conf['advanced.']['dontUseSharingGoogle'];
		}

		if (isset($this->conf['sharing.']['dontUseSharingTwitterV2'])) {
			if ($this->conf['sharing.']['dontUseSharingTwitterV2'] != '') {
				$this->conf['sharing.']['dontUseSharingTwitter']=$this->conf['sharing.']['dontUseSharingTwitterV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingTwitterV2']);
		} elseif ($this->conf['advanced.']['dontUseSharingTwitter'] != 0) {
			$this->conf['sharing.']['dontUseSharingTwitter']=$this->conf['advanced.']['dontUseSharingTwitter'];
		}

		if (isset($this->conf['sharing.']['dontUseSharingLinkedInV2'])) {
			if ($this->conf['sharing.']['dontUseSharingLinkedInV2'] != '') {
				$this->conf['sharing.']['dontUseSharingLinkedIn']=$this->conf['sharing.']['dontUseSharingLinkedInV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingLinkedInV2']);
		} elseif ($this->conf['advanced.']['dontUseSharingLinkedIn'] != 0) {
			$this->conf['sharing.']['dontUseSharingLinkedIn']=$this->conf['advanced.']['dontUseSharingLinkedIn'];
		}

		if (isset($this->conf['sharing.']['dontUseSharingStumbleuponV2'])) {
			if ($this->conf['sharing.']['dontUseSharingStumbleuponV2'] != '') {
				$this->conf['sharing.']['dontUseSharingStumbleupon']=$this->conf['sharing.']['dontUseSharingStumbleuponV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingStumbleuponV2']);
		} elseif ($this->conf['advanced.']['dontUseSharingStumbleupon'] != 0) {
			$this->conf['sharing.']['dontUseSharingStumbleupon']=$this->conf['advanced.']['dontUseSharingStumbleupon'];
		}

		if (isset($this->conf['sharing.']['shareUsersTotalTextV2'])) {
			if ($this->conf['sharing.']['shareUsersTotalTextV2'] != '') {
				$this->conf['sharing.']['shareUsersTotalText']=$this->conf['sharing.']['shareUsersTotalTextV2'];
			}
			unset($this->conf['sharing.']['shareUsersTotalTextV2']);
		} elseif ($this->conf['advanced.']['shareUsersTotalText'] != '') {
			$this->conf['sharing.']['shareUsersTotalText']=$this->conf['advanced.']['shareUsersTotalText'];
		}

		if (isset($this->conf['sharing.']['shareDataTextV2'])) {
			if ($this->conf['sharing.']['shareDataTextV2'] != '') {
				$this->conf['sharing.']['shareDataText']=$this->conf['sharing.']['shareDataTextV2'];
			}
			unset($this->conf['sharing.']['shareDataTextV2']);
		} elseif ($this->conf['advanced.']['shareDataText'] != '') {
			$this->conf['sharing.']['shareDataText']=$this->conf['advanced.']['shareDataText'];
		}
		if (isset($this->conf['sharing.']['sharePageURLV2'])) {
			if ($this->conf['sharing.']['sharePageURLV2'] != '') {
				$this->conf['sharing.']['sharePageURL']=$this->conf['sharing.']['sharePageURLV2'];
			}
			unset($this->conf['sharing.']['sharePageURLV2']);
		} elseif ($this->conf['advanced.']['sharePageURL'] != '') {
			$this->conf['sharing.']['sharePageURL']=$this->conf['advanced.']['sharePageURL'];
		}

		if ($this->conf['advanced.']['sharingNoCalculatedCSS'] != 0) {
			$this->conf['sharing.']['sharingNoCalculatedCSS']=$this->conf['advanced.']['sharingNoCalculatedCSS'];
		}

		if ($this->conf['advanced.']['useSharingDesign'] != 0) {
			$this->conf['sharing.']['useSharingDesign']=$this->conf['advanced.']['useSharingDesign'];
		}

		if ($this->conf['advanced.']['dontUseSharingPinterest'] != 0) {
			$this->conf['sharing.']['dontUseSharingPinterest']=$this->conf['advanced.']['dontUseSharingPinterest'];
		}

		if ($this->conf['advanced.']['dontUseSharingDigg'] != 0) {
			$this->conf['sharing.']['dontUseSharingDigg']=$this->conf['advanced.']['dontUseSharingDigg'];
		}

		if ($this->conf['advanced.']['dontUseSharingDelicious'] != 0) {
			$this->conf['sharing.']['dontUseSharingDelicious']=$this->conf['advanced.']['dontUseSharingDelicious'];
		}

		if ($this->conf['advanced.']['useShareIcon'] != 1) {
			$this->conf['sharing.']['useShareIcon']=$this->conf['advanced.']['useShareIcon'];
		}

		if ($this->conf['advanced.']['dontUseSharingAddThisMore'] != 0) {
			$this->conf['sharing.']['dontUseSharingAddThisMore']=$this->conf['advanced.']['dontUseSharingAddThisMore'];
		}

		if ($this->conf['advanced.']['AddThisID'] != '') {
			$this->conf['sharing.']['AddThisID']=$this->conf['advanced.']['AddThisID'];
		}

		$this->fetchConfigValue('ratings.enableRatings');
		$this->fetchConfigValue('ratings.ratingsTemplateFile');
		$this->fetchConfigValue('ratings.useMyVote');
		$this->fetchConfigValue('ratings.useVotes');
		$this->fetchConfigValue('ratings.useScopesForVote');
		$this->fetchConfigValue('ratings.useOverallScopeForVote');
		$this->fetchConfigValue('ratings.useLikeDislike');
		$this->fetchConfigValue('ratings.useDislike');
		$this->fetchConfigValue('ratings.ratingsOnly');
		$this->fetchConfigValue('ratings.useShortTopLikes');

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
			if ($this->conf['pluginmode']!=7) {
				unset ($this->conf['recentcommentslistCount']);
			}
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
					'pObj' => $this,
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
	protected function fetchConfigValue($param) {
		if (strchr($param, '.')) {
			list($section, $param) = explode('.', $param, 2);
		}
		if (isset($this->cObj->data['pi_flexform'])) {
			$value = trim($this->pi_getFFvalue($this->cObj->data['pi_flexform'], $param, ($section ? 's' . ucfirst($section) : 'sDEF')));
			if (!is_null($value)) {
				if (trim($value) !== '') {
					if ($section) {
						$this->conf[$section . '.'][$param] = $value;
					} else {
						$this->conf[$param] = $value;
					}

				}

			}

		}

	}


	/**
	 * detects IE and return TRUE if version > 10
	 *
	 * @return	boolean		TRUE if IE9 or older
	 */
	protected function ae_detect_ie() {

		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)) {
			// its IE
			if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 1') !== FALSE) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10') !== TRUE)){
				// its IE 10 to 19 (or 1 if you want...)
				// once IE will be able to handle the fileobject, set it to FALSE .. grrr
				return FALSE;
			} else{
				return TRUE;
			}

		} else {
			return FALSE;
		}

	}

	/**
	 * applies boxmadel to maincss and sets active CSS to boxmodell CSS
	 *
	 * @return	string		optional error message
	 */
	protected function boxmodel() {
		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
		$runboxmodel = FALSE;
		$filenameboxmodel=$this->conf['theme.']['selectedBoxmodel']; //'boxmodel.txt'

		$txdirnameboxmodel= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep .
				t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/' );
		$filenameboxmodel=$txdirnameboxmodel . $filenameboxmodel;

		if ($this->conf['theme.']['selectedBoxmodel'] != '') {
			if (file_exists($filenameboxmodel)) {
				$filetime = @filemtime($filenameboxmodel);
				if (!isset($_SESSION['fileTimeSelectedBoxModel'])) {
					$runboxmodel = TRUE;
					$_SESSION['fileTimeSelectedBoxModel'] = $filetime;
				} else {
					if ($_SESSION['fileTimeSelectedBoxModel']  != $filetime) {
						$runboxmodel = TRUE;
						$_SESSION['fileTimeSelectedBoxModel'] = $filetime;
					}

				}
			}
		}

		$reviewlineheight = $this->conf['ratings.']['reviewImageWidth'];
		if ($reviewlineheight < $this->conf['theme.']['boxmodelLineHeight'] ) {
			$reviewlineheight = $this->conf['theme.']['boxmodelLineHeight'];
		}

		$ratinglineheight = $this->conf['ratings.']['ratingImageWidth'];
		if ($ratinglineheight < $this->conf['theme.']['boxmodelLineHeight'] ) {
			$ratinglineheight = $this->conf['theme.']['boxmodelLineHeight'];
		}

		$reviewTextMargin = intval(0.5*(intval($this->conf['ratings.']['reviewImageWidth'])-intval($this->conf['theme.']['boxmodelLineHeight'])));

		if (($this->conf['ratings.']['reviewImageWidth']-$this->conf['theme.']['boxmodelLineHeight'])>0) {
			$reviewTextMargin = intval(0.5*($this->conf['ratings.']['reviewImageWidth']-$this->conf['theme.']['boxmodelLineHeight']));
		}

		$ratingTextMargin=0;
		if (($this->conf['ratings.']['ratingImageWidth']-$this->conf['theme.']['boxmodelLineHeight'])>0) {
			$ratingTextMargin = $this->conf['ratings.']['ratingImageWidth']-$this->conf['theme.']['boxmodelLineHeight'];
		}

		$reviewMarginTop = intval((intval($this->conf['theme.']['boxmodelLineHeight'])-intval($this->conf['ratings.']['reviewImageWidth']))/2);
		$ratingMarginTop = intval((intval($this->conf['theme.']['boxmodelLineHeight'])-intval($this->conf['ratings.']['ratingImageWidth']))/2);

		$txdirnameboxmodelsystem= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep .
									t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/boxmodels/system/' );
		$filenameboxmodelsystem=$txdirnameboxmodelsystem . 'boxmodel_system.txt';
		$filetime = @filemtime($filenameboxmodelsystem);
		if (!isset($_SESSION['fileTimeBoxModelSystem'])) {
			$runboxmodel = TRUE;
			$_SESSION['fileTimeBoxModelSystem'] = $filetime;
		} else {
			if ($_SESSION['fileTimeBoxModelSystem']  != $filetime) {
				$runboxmodel = TRUE;
				$_SESSION['fileTimeBoxModelSystem'] = $filetime;
			}

		}

		$filenamecssfile='tx-tc-' . $this->extVersion . '.css';
		$httpsid='';
		if (@$_SERVER['HTTPS'] == 'on') {
			// on https StumbleUpon and Digg fail
			if (($this->conf['sharing.']['dontUseSharingStumbleupon'] == 0) || ($this->conf['sharing.']['dontUseSharingDigg'] == 0)) {
				$httpsid='-https';
			}
		}
		$atMediaWitdhs = '-' . $this->arrResponsiveSteps[0] . $this->arrResponsiveSteps[1] . $this->arrResponsiveSteps[2];
		if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
			$filenamecssoutfile='tx-tc-' . $this->extVersion . '-' . str_replace('.txt', '', $this->conf['theme.']['selectedBoxmodel']) .'-' .
			$this->conf['theme.']['selectedTheme'] . '-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '-' . $this->conf['ratings.']['useLikeDislikeStyle'] .
			'-' . $this->conf['theme.']['boxmodelLabelInputPreserve'] . $atMediaWitdhs . '.css';
		} else {
			$filenamecssoutfile='tx-tc-' . $this->extVersion . '-system-' .
			$this->conf['theme.']['selectedTheme'] . '-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '-' . $this->conf['ratings.']['useLikeDislikeStyle'] .
			'-' . $this->conf['theme.']['boxmodelLabelInputPreserve'] . $atMediaWitdhs . '.css';
		}

		$txdirname= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
						'res/css/temp/' );
		$filenamecss=$txdirname . $filenamecssoutfile;

		if (file_exists($filenamecss)) {
			$filetime = @filemtime($filenamecss);
			if (!isset($_SESSION['fileTimeCSS'])) {
				$runboxmodel = TRUE;
				$_SESSION['fileTimeCSS'] = $filetime;
			} else {
				if ($_SESSION['fileTimeCSS'] != $filetime) {
					$runboxmodel = TRUE;
					$_SESSION['fileTimeCSS'] = $filetime;
				}

			}

			if (!$this->processcssandjsfiles) {
				$this->boxmodelcss ='temp/' . $filenamecssoutfile;
				return '';
			}

		} else {
			$runboxmodel = TRUE;
		}

		$txdirnamedefault= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
							'res/css/' );
		$filenamedefaultcss=$txdirnamedefault . $filenamecssfile;

		$filetime = @filemtime($filenamedefaultcss);
		if (!isset($_SESSION['fileTimeDefaultCSS'])) {
			$runboxmodel = TRUE;
			$_SESSION['fileTimeDefaultCSS'] = $filetime;
		} else {
			if ($_SESSION['fileTimeDefaultCSS'] != $filetime) {
				$runboxmodel = TRUE;
				$_SESSION['fileTimeDefaultCSS'] = $filetime;
			}

		}
		$nbrofstars= intval($this->conf['ratings.']['maxValue']) - intval($this->conf['ratings.']['minValue']) + 1;

		$printstr='';
		$content ='';
		$bmcsslastmodif=0;
		$bmtxtlastmodif=0;
		$basecsslastmodif=0;
		$forceregenerate = FALSE;
		$dropprotokollon= intval($this->showDropsfromBoxmodel);
		if (($dropprotokollon) && ($this->showsdebugprint==TRUE)) {
			$this->sdebuginitprint.='<br />Boxmodeldroplist: ';
		}

		if (!isset($_SESSION['AJAXimages'])) {
			$_SESSION['AJAXimages'] = array();
		}

		if ($runboxmodel ==TRUE) {
			if (file_exists($filenamecss)) {
				// boxmodel.css file found
				$content = file_get_contents($filenamecss);
				$bmcsslastmodif = filemtime($filenamecss);
			}
			$contentconfidarr= explode('6g9', $content);

			if (($contentconfidarr[1] != $this->confid) || ($this->conf['theme.']['freezeLevelCSS'] == 0)) {
				$forceregenerate=TRUE;

			}
			if ($this->conf['theme.']['freezeLevelCSS'] < 2) {
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
						if (($forceregenerate==TRUE) || ($bmcsslastmodif<$bmtxtlastmodif) || ($bmcsslastmodif<$basecsslastmodif)) {

							for ($ifile=0; $ifile<$nbrfilestoprocess; $ifile++) {
								//*// // first system-boxmodel, then possible normal box-model
								//*// // output will be one file, so both resuls are merge into the rest.

								if ($ifile==1) {
									$currentfilename = $this->conf['theme.']['selectedBoxmodel'];
									$boxmodelarr = file($filenameboxmodel);
								} else {
									$currentfilename = 'boxmodel_system.txt';
								}

								$boxmodelcssarr = array();
								$boxmodelsrulesarr = array();
								$i_rules=0;
								$i_boxmodel=-1;
								$parsestate = '';
								$countboxmodelarr=count($boxmodelarr);
								for ($i=0; $i<$countboxmodelarr; $i++) {

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
										$boxmodelcssarrtmp=explode(':', $boxmodelarr[$i]);
										$boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS]=$boxmodelcssarrtmp[0];
										$boxmodelcssarr[$i_boxmodel]['CSS'][$i_boxmodelCSS+1]=$boxmodelcssarrtmp[1];
										$parsestate = 'CSS2';
									} elseif ($parsestate== 'CSS2') {

										$boxmodelcssarr[$i_boxmodel]['CSS2']=explode(':', $boxmodelarr[$i]);

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
										$boxmodelcssarr[$i_boxmodel]['CSSComment'][$i_selector]='
		/*
		change for ' . $boxmodelarr[$i] . ' on line ' . $i . ' in ' . $currentfilename .'
		*/
		';
										$i_selector++;

									}

								}

								//now the 2 boxmodel arrays are there: one with rules, the other with data to process

								// 1. apply rules on data-array
								$countboxmodelsrulesarr=count($boxmodelsrulesarr);
								for ($i=0; $i<$countboxmodelsrulesarr; $i++) {

									// get the value to replace
									$replrightarr= explode('}', $boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);  // xxx{2, px;
									$replright=$replrightarr[1]; // px;
									$replleftarr= explode('{', $boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);   // xxx   2}px;
									$replleft=$replrightarr[0]; // xxx
									if ($replright !='') {
										$varrighttrimedarr= explode($replright, $boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS'][1]); // xxx170 ,
										$varrighttrimed=implode($varrighttrimedarr); // xxx170
									} else {
										$varrighttrimed=$boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS'][1];
									}

									$vartrimed=intval($varrighttrimed); // if not int -> 0

									if ($replleft !='') {
										// xxx
										$varlefttrimedarr= explode($replleft, $varrighttrimed); // xxx170
										$vartrimed=$varlefttrimedarr[0];		// 170
									}

									$boxmodelsrulesarr[$i]['varval']=$vartrimed;
									$varnamearr= explode('{', $boxmodelcssarr[$boxmodelsrulesarr[$i]['boxmodel']]['CSS2'][1]);  // xxx  2}px;
									$varnamearr2=explode('}', $varnamearr[1]); // 2   px;
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
											$boxmodelsrulesarr[$i]['varval']=round(($this->conf['theme.']['boxmodelLineHeight']-16)/2, 0);
										}

										if ($boxmodelsrulesarr[$i]['varname']=='boxmodelSpacingHalf') {
											$boxmodelsrulesarr[$i]['varval']=round(($this->conf['theme.']['boxmodelSpacing'])/2, 0);
										}

										if ($boxmodelsrulesarr[$i]['varname']=='ratingImageWidth') {
											$boxmodelsrulesarr[$i]['varval']=$this->conf['ratings.']['ratingImageWidth'];
										}

										if ($boxmodelsrulesarr[$i]['varname']=='reviewImageWidth') {
											$boxmodelsrulesarr[$i]['varval']=$this->conf['ratings.']['reviewImageWidth'];
										}

										if ($boxmodelsrulesarr[$i]['varname']=='reviewLineHeight') {
											$boxmodelsrulesarr[$i]['varval']=$reviewlineheight;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='ratingLineHeight') {
											$boxmodelsrulesarr[$i]['varval']=$ratinglineheight;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='reviewTextMargin') {
											$boxmodelsrulesarr[$i]['varval']=$reviewTextMargin;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='ratingTextMargin') {
											$boxmodelsrulesarr[$i]['varval']=$ratingTextMargin;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='reviewMarginTop') {
											$boxmodelsrulesarr[$i]['varval']=$reviewMarginTop;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='ratingMarginTop') {
											$boxmodelsrulesarr[$i]['varval']=$ratingMarginTop;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='ratingNbrStars') {
											$boxmodelsrulesarr[$i]['varval']=$nbrofstars;
										}

										if ($boxmodelsrulesarr[$i]['varname']=='picUploadMaxDimX') {
											$boxmodelsrulesarr[$i]['varval']=$this->conf['attachments.']['picUploadMaxDimX'];
										}

										if ($boxmodelsrulesarr[$i]['varname']=='boxmodelLabelWidth') {
											$boxmodelsrulesarr[$i]['varval']=intval($this->conf['theme.']['boxmodelLabelWidth']);
										}

										if ($boxmodelsrulesarr[$i]['varname']=='userImageSize') {
											$boxmodelsrulesarr[$i]['varval']=intval($this->conf['userImageSize']);
										}

									}

									if ($boxmodelsrulesarr[$i]['fullruleeval'] != '') {
										// set the values in the formula
										$rulevarnamepartevalpartarr= explode('=', $boxmodelsrulesarr[$i]['fullruleeval'] );
										$varpart=  trim($rulevarnamepartevalpartarr[0]); // {3}

										$evalpart=  trim($rulevarnamepartevalpartarr[1]); // {1} + {2} + 30
										$countjjboxmodelsrulesarr=count($boxmodelsrulesarr);

										for ($j=0; $j<$countjjboxmodelsrulesarr; $j++) {
											if ($boxmodelsrulesarr[$j]['varname']=='boxmodelTextareaLineHeight') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['theme.']['boxmodelTextareaLineHeight'],
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelTextareaHeight') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->boxmodelTextareaHeight, $evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelSpacing') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', intval($this->conf['theme.']['boxmodelSpacing']),
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelLineHeight') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['theme.']['boxmodelLineHeight'], $evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelLineHeightHalf') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}',
														round(($this->conf['theme.']['boxmodelLineHeight']-16)/2, 0), $evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='ratingImageWidth') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['ratings.']['ratingImageWidth'],
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='ratingNbrStars') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $nbrofstars,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='reviewImageWidth') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['ratings.']['reviewImageWidth'],
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='reviewLineHeight') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $reviewlineheight,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='ratingLineHeight') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $ratinglineheight,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='reviewTextMargin') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $reviewTextMargin,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='ratingTextMargin') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $ratingTextMargin,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='reviewMarginTop') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $reviewMarginTop,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='ratingMarginTop') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $ratingMarginTop,
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelLabelWidth') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', intval($this->conf['theme.']['boxmodelLabelWidth']),
														$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='picUploadMaxDimX') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['attachments.']['picUploadMaxDimX'],
																$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='userImageSize') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $this->conf['userImageSize'],
																$evalpart);
											} elseif ($boxmodelsrulesarr[$j]['varname']=='boxmodelSpacingHalf') {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', round(($this->conf['theme.']['boxmodelSpacing'])/2, 0),
														$evalpart);
											} else {
												$evalpart= str_replace('{' . $boxmodelsrulesarr[$j]['varname'] . '}', $boxmodelsrulesarr[$j]['varval'], $evalpart);
											}

											$countjjboxmodelsrulesarr=count($boxmodelsrulesarr);
										}

										$boxmodelsrulesarr[$i]['varname']=str_replace('{', '', str_replace('}', '', $varpart)); // 3
										$boxmodelsrulesarr[$i]['varval']= $this->calculate_string($evalpart);  //240
									}

									$countboxmodelsrulesarr=count($boxmodelsrulesarr);
								}

								// not the values in the data-array are set and calculated
								// replace the vars in CSS2 with varvals and replace CSS with CSS2
								$countiboxmodelcssarr=count($boxmodelcssarr);
								for ($i=0; $i<$countiboxmodelcssarr; $i++) {
									$countboxmodelsrulesarrj=count($boxmodelsrulesarr);
									for ($j=0; $j<$countboxmodelsrulesarrj; $j++) {
										$countboxmodelcssarriCSS2=count($boxmodelcssarr[$i]['CSS2']);
										for ($c=1; $c<$countboxmodelcssarriCSS2; $c=$c+2) {
											$boxmodelcssarr[$i]['CSS2'][$c]=str_replace('{' . $boxmodelsrulesarr[$j]['varname'] .
													'}', $boxmodelsrulesarr[$j]['varval'], $boxmodelcssarr[$i]['CSS2'][$c]);
											// width: 200px; becomes width: 240px if CSS2= width: {3}px;
											$countboxmodelcssarriCSS2=count($boxmodelcssarr[$i]['CSS2']);
										}

									}

									$countboxmodelcssarriCSS2=count($boxmodelcssarr[$i]['CSS2']);
									for ($c=1; $c<$countboxmodelcssarriCSS2; $c=$c+2) {
										if ($boxmodelcssarr[$i]['CSS2'][$c]!='') {
											$boxmodelcssarr[$i]['CSS'][$c]=$boxmodelcssarr[$i]['CSS2'][$c];
										}

										$countboxmodelcssarriCSS2=count($boxmodelcssarr[$i]['CSS2']);
									}

									$countiboxmodelcssarr=count($boxmodelcssarr);
								}

								// So now all the CSS  in the data-array are ready to be checked against the CSS file
								//spilt CSS on seletor and subsequent '}'
								$countiboxmodelcssarr=count($boxmodelcssarr);
								for ($i=0; $i<$countiboxmodelcssarr; $i++) {
									$countboxmodelcssarrselectorCSSkey=count($boxmodelcssarr[$i]['selectorCSSkey']);
									for ($j=0; $j<$countboxmodelcssarrselectorCSSkey; $j++) {
									// - checking every css-selector in the boxmodel-entry
										$dolbrk=TRUE;
										$selectorCSSkey= rtrim($boxmodelcssarr[$i]['selectorCSSkey'][$j]) . ' {';
										// - selectorCSSkey looks like for example "tx-tc-goodguy {"
										$countcboxmodelcssarriCSS=count($boxmodelcssarr[$i]['CSS']);
										for ($c=0; $c<$countcboxmodelcssarriCSS; $c=$c+2) {
										// - for every CSS-property to be assigned to the  current selectorCSSKey. $c holds search value, $d replace with value
											$d=$c+1;
											// take the selector to work on and isolate it from default CSS
											$contentdefaultcssarr = explode("\n". $selectorCSSkey, $contentdefaultcss);
											// - the entire default CSS gets splitet on the selectorCSSKey
											if (count($contentdefaultcssarr) >1) {
												// -if splitting was successful
												$contentdefaultcssarr2= explode('}', $contentdefaultcssarr[1]);
												// -make an array with the part after the selectorCSSKey
												$selectorsscss= $contentdefaultcssarr2[0];
												// -setting selectorcss to the css-properies of the selectorCSSKey
											} else {
												// - if splitting wasn't successful'
												$selectorsscss= '';
												// -selectors CSS is empty
												$contentdefaultcssarr2=array();
												$contentdefaultcssarr2[0]='';
												$contentdefaultcssarr2[1]='';
											}

											// isolation done
											// find property $boxmodelcssarr[$i]['CSS2'][0] in the selector
											$boxmodelcssarr[$i]['CSS'][$d]=str_replace(';', '', $boxmodelcssarr[$i]['CSS'][$d]);
											// -remove ";" from new CSS-Property-line
											$selectorsscssarr= explode("\t" . $boxmodelcssarr[$i]['CSS'][$c] . ':', $selectorsscss);
											// - Now we split the found CSS-Properties on the Property whose value we want to replace
											//   EX1: splitting such the array will be so: (height)
											//      width: 34px;   height: 45px; top: 0px;->  [0]:   width: 34px; [1]: 45px: top: 0px;
											//   is empty if $selectorsscss=''
											if (count($selectorsscssarr)>1) {
												// property was found now we replace its content

												$selectorsscssarr2= explode(';', $selectorsscssarr[1]);
												// - EX1: we isolate the "45 px", it's in element [0]
												$selectorsscssarr2[0]=$boxmodelcssarr[$i]['CSS'][$d];
												// - here we filled in the new value 79px
												//and implode back

												$selectorsscssarr[1]=implode(';', $selectorsscssarr2);
												// - [1] has now the new value inside
												$selectorsscssarr[1]=str_replace("\r\n" . ';', ';', $selectorsscssarr[1]);
												$selectorsscssarr[1]=str_replace("\n" . ';', ';', $selectorsscssarr[1]);
												// - replaced the new lines in the "79px-string" [1]
												$selectorsscss=implode( "\t".$boxmodelcssarr[$i]['CSS'][$c] .':', $selectorsscssarr);
												// - restored the selectors entire CSS properties
												$contentdefaultcssarr2[0]="\t". $selectorsscss;
												// - prepend a tab and write it back to the originating array element
												$contentdefaultcssarr[1]=implode('}', $contentdefaultcssarr2);

												// - rebuild the originating array element
											} else {
												// property was not, we check for a leading '+' in the property string
												// if present we add the property (without the '+' to the selector

												if (substr($boxmodelcssarr[$i]['CSS'][$c], 0, 1) == '+') {

													$selectorsscssplus = "\t" . substr($boxmodelcssarr[$i]['CSS'][$c], 1). ':' . $boxmodelcssarr[$i]['CSS'][$d] . ";\n";
													$selectorsscssplus =str_replace("\r\n" . ';', ';', $selectorsscssplus);
													$selectorsscssplus =str_replace("\n" . ';', ';', $selectorsscssplus);
													// - new CSS Property with value set up
													$selectorsscss .= $selectorsscssplus;
													// appending new stuff to existing selectorscss

													$contentdefaultcssarr2[0]=$selectorsscss;
													if ($dolbrk) {
														$contentdefaultcssarr[1]="\r\n" .implode('}', $contentdefaultcssarr2);
														$dolbrk=FALSE;
													} else {
														$contentdefaultcssarr[1]=implode('}', $contentdefaultcssarr2);
													}

												} else {
													if (($dropprotokollon) && ($this->showsdebugprint==TRUE)) {
														$this->sdebuginitprint.= 'DROP: '. json_encode($boxmodelcssarr[$i]). '<br />';
													}

												}

											}
											if (intval($this->showCSScomments) == 1) {
												$contentdefaultcss=implode(trim($boxmodelcssarr[$i]['CSSComment'][$j]) . "\n". $selectorCSSkey, $contentdefaultcssarr);
												$contentdefaultcss=str_replace('*//*', '', $contentdefaultcss);
											} else {
												$contentdefaultcss=implode("\n". $selectorCSSkey, $contentdefaultcssarr);

											}
											$countcboxmodelcssarriCSS=count($boxmodelcssarr[$i]['CSS']);
										}

										$countboxmodelcssarrselectorCSSkey=count($boxmodelcssarr[$i]['selectorCSSkey']);
									}

									$countiboxmodelcssarr=count($boxmodelcssarr);
								}

							}

							// and apply the correct path to the theme in the rating stars url

							$contentdefaultcss = $this->confcss .
							str_replace('themes/default/', 'themes/' . $this->conf['theme.']['selectedTheme'] . '/', $contentdefaultcss) . "\n" . $this->themeCSS;

							if ($this->conf['theme.']['boxmodelLineHeightPreserve'] ==1) {
								$nolineheightarr = array('.tx-tc-recent-cts-entry {',
														'.tx-tc-recent-cts-title {',
														'.tx-tc-myrts-ilke {',
														'.tx-tc-myrts-disilke {',
														'.tx-tc-rts {',
														'toctoc-comments-pi1 {',
														'.tx-tc-text {',
														'.tx-tc-myrts-ilke {',
														'.tx-tc-text-top {',
														'.tx-tc-ct-viewcnt {',
														'.tx-tc-ftm-text {',
														'.tx-tcresponse-text {',
														'.tx-tcresponse-text-title {',
														'.tx-tc-ct-rybox-title {',
														'.tx-tc-ct-rybox {',
														'.tx-tc-ct-cnt {',
														'.txtc_details {',
														'.tx-tc-ct-cnt span, .tx-tc-ct-viewcnt span {',
														'.tx-tc-ct-prv-frame {',
														'.tx-tc-ntf-box {',
														'.tx-tc-scopetitle, .tx-tc-scopetitlebold {',
														'.tx-tcresponse-text {',
										);
								$countnolineheight = count($nolineheightarr);
								for ($x=0; $x < $countnolineheight; $x++) {
									$contentdefaultcssarr = explode($nolineheightarr[$x], $contentdefaultcss);
									$contentdefaultcssarrlineheight = explode('line-height', $contentdefaultcssarr[1]);
									$contentdefaultcssarrlineheightend = explode(';', $contentdefaultcssarrlineheight[1]);
									array_shift($contentdefaultcssarrlineheightend);
									$contentdefaultcssarrlineheight[1] = 'lnh' . implode(';', $contentdefaultcssarrlineheightend);
									$contentdefaultcssarr[1] = implode('line-height', $contentdefaultcssarrlineheight);
									$contentdefaultcss = implode($nolineheightarr[$x], $contentdefaultcssarr);

									$contentdefaultcss = str_replace('line-heightlnh'."\n", '', $contentdefaultcss);
									$contentdefaultcss = str_replace('line-heightlnh'."\r\n", '', $contentdefaultcss);
								}
							}

							// remove button CSS if boxmodelLabelInputPreserve is forced
							if ($this->conf['theme.']['boxmodelLabelInputPreserve'] == 1) {
								if ($this->conf['theme.']['boxmodelButtonPreserve'] == 1) {
									$nolineheightarr = array('.tx-tc-ct-submit, .tx-tc-ct-submit-loggedin {',
										'.tx-tc-ct-submit, .tx-tc-ct-reset, .tx-tc-ct-submit-loggedin {',
										);
								} else {
									$nolineheightarr = array();
								}
								$countnolineheight = count($nolineheightarr);
								for ($x=0; $x < $countnolineheight; $x++) {
									$contentdefaultcssarr = explode($nolineheightarr[$x], $contentdefaultcss);
									$contentdefaultcssarrlineheight = explode('}', $contentdefaultcssarr[1]);
									$contentdefaultcssarrlineheight[0] = '';
									$contentdefaultcssarr[1] = implode('}', $contentdefaultcssarrlineheight);
									$contentdefaultcss = implode($nolineheightarr[$x], $contentdefaultcssarr);

								}
							}

							// @media-widths
							$contentdefaultcss = str_replace('@media (max-width: 950px)', '@media (max-width: '.$this->arrResponsiveSteps[2].'px)', $contentdefaultcss);
							$contentdefaultcss = str_replace('@media (min-width: 950px)', '@media (min-width: '.$this->arrResponsiveSteps[2].'px)', $contentdefaultcss);
							$contentdefaultcss = str_replace('@media (max-width: 450px)', '@media (max-width: '.$this->arrResponsiveSteps[1].'px)', $contentdefaultcss);
							$contentdefaultcss = str_replace('@media (min-width: 450px)', '@media (min-width: '.$this->arrResponsiveSteps[1].'px)', $contentdefaultcss);
							$contentdefaultcss = str_replace('@media (max-width: 350px)', '@media (max-width: '.$this->arrResponsiveSteps[0].'px)', $contentdefaultcss);
							$contentdefaultcss = str_replace('@media (min-width: 350px)', '@media (min-width: '.$this->arrResponsiveSteps[0].'px)', $contentdefaultcss);

							if (intval($this->conf['theme.']['crunchCSS']) == 1) {
								$contentdefaultcss = $this->crunchcss($contentdefaultcss);
							}
							if (($contentdefaultcss != $content) || ($this->conf['theme.']['freezeLevelCSS'] == 0)) {
								file_put_contents($filenamecss, $contentdefaultcss);
							}

						}

						//sets active css to boxmodell css
						$this->boxmodelcss ='temp/' . $filenamecssoutfile;
					} else {
						$retstr =$this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
								$this->lib->pi_getLLWrap($this, 'error.no.css.defaultcss', FALSE)) . ': ' . $filenamedefaultcss;
						return $retstr;
					}

				} else {
					$retstr =$this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
							$this->lib->pi_getLLWrap($this, 'error.no.css.boxmodeltxt', FALSE)) . ': ' . $filenameboxmodel;
				    return $retstr;
				}
			} else {
				$this->boxmodelcss ='temp/' . $filenamecssoutfile;
			}
		} else {
			$this->boxmodelcss ='temp/' . $filenamecssoutfile;
		}
		return '';
	}
	/**
	 * Crunches CSS
	 *
	 * @param	string		$buffer: uncompressed CSS
	 * @return	string		compressed CSS
	 */
	protected function crunchcss($buffer) {
		/* remove comments */
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		/* remove tabs, spaces, new lines, etc. */
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		/* remove unnecessary spaces */
		$buffer = str_replace('{ ', '{', $buffer);
		$buffer = str_replace(' }', '}', $buffer);
		$buffer = str_replace('; ', ';', $buffer);
		$buffer = str_replace(', ', ',', $buffer);
		$buffer = str_replace(' {', '{', $buffer);
		$buffer = str_replace('} ', '}', $buffer);
		$buffer = str_replace(': ', ':', $buffer);
		$buffer = str_replace(' ,', ',', $buffer);
		$buffer = str_replace(' ;', ';', $buffer);

		return $buffer;
	}

	/**
	 * Calculated an expressions value comparable to JS eval
	 *
	 * @param	string		$$mathString: String to be evaluated
	 * @return	int		value calculated
	 */
	protected function calculate_string( $mathString )    {
		$mathString = trim($mathString);     // trim white spaces
		$mathString = preg_replace('~[^0-9\(\)\-\+\*\/]~', '', $mathString);    // remove any non-numbers chars; exception for math operators
	//print $mathString . '<br>';
		try
		{
			$compute = create_function('', 'return (' . $mathString . ');' );
		}

		catch (Exception $e)
		{
			print 'Invalid formula in boxmodel: ' . $mathString .'<br />';
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

		$retstr =t3lib_div::locationHeaderUrl('');
		return $retstr;
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

		 $s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
		 $slcurrentPageName=str_replace('?&no_cache=1', '', $serverrequri);
		 $slcurrentPageName=str_replace('?no_cache=1', '', $slcurrentPageName);
		 $slcurrentPageName=str_replace('&no_cache=1', '', $slcurrentPageName);
		 $slcurrentPageName=str_replace('?&purge_cache=1', '', $slcurrentPageName);
		 $slcurrentPageName=str_replace('?purge_cache=1', '', $slcurrentPageName);
		 $slcurrentPageName=str_replace('&purge_cache=1', '', $slcurrentPageName);

		 return $slcurrentPageName;
	}

	/**
	 * Clears page cache and maintains plugin sessioncache as well as SESSION processedcachepages
	 *
	 * @param	int		$pid: page-id where the page-cache need to be dropped
	 * @param	boolean		$withplugin: if TRUE plugins session cache is reseted as well ($_SESSION['commentListRecord'])
	 * @param	boolean		$withcache: page caqche for pid will be dropped
	 * @param	[type]		$debugstr: ...
	 * @return	void
	 */
	protected function ttclearcache ($pid, $withplugin=TRUE, $withcache = FALSE, $debugstr = '') {
		if ($withcache) {
			$this->initLegacyCache();

			//just maintain the processedcachepages
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf, $pid);

			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			/* @var $tce t3lib_TCEmain */
			// the $GLOBALS['TCA']-Patch for eID and FLUX
			if (!(isset($GLOBALS['TCA']))) {
				$GLOBALS['TCA'] = array();
				$GLOBALS['TCA']['tt_content'] = array();
			}

			$tce->clear_cacheCmd($pid);

			$this->sdebugprint .= 'tt clear page cache for page ' . $pid. ' triggered by "' . $debugstr . '"<br />';
		}

		if ($withplugin) {
			$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid']['p' .
				$GLOBALS['TSFE']->id]=0;
			$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid']['p' .
				$GLOBALS['TSFE']->id]='';
		}

	}

	/**
	 * Clears page cache and maintains SESSION processedcachepages
	 *
	 * @param	boolean		$forceclear: when $this->activateClearPageCache is not active, pagecache is forced to be checked
	 * @return	void
	 */
	protected function doClearCache ($forceclear=FALSE) {
		$this->initLegacyCache();
		if (($this->activateClearPageCache) || ($forceclear)) {
			$clearCacheIds = $this->lib->getClearCacheIds($this->conf, $GLOBALS['TSFE']->id);
			if (trim($clearCacheIds)!='') {
				$pidListarr = t3lib_div::intExplode(',', $clearCacheIds);
				$pidListarr=array_unique($pidListarr);
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');
				// the $GLOBALS['TCA']-Patch for eID and FLUX
				if (!(isset($GLOBALS['TCA']))) {
					$GLOBALS['TCA'] = array();
					$GLOBALS['TCA']['tt_content'] = array();
				}

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
		$tstamp=$this->lib->getPluginCacheControlTstamp($external_ref_uid);
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
				$wherearr = explode(',', $this->conf['ratings.']['useScopesForVote']);
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
				$countirows=count($rows);
				for ($i=0; $i<$countirows; $i++){
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
				$countjrows2=count($rows2);
				for ($j=0; $j<$countjrows2; $j++){
					$useScopesForVote[$i]=$rows2[$j]['uid'];
					$i++;
				}

				$useScopesForVote = array_unique($useScopesForVote);

				$this->conf['ratings.']['useScopesForVote'] = implode(',', $useScopesForVote);
				$_SESSION['ratingsscopes'][$_SESSION['commentListRecord']] = $this->conf['ratings.']['useScopesForVote'];

				// now for these find and build internal scope array
				$where2 = '((l18n_parent IN (' . $_SESSION['ratingsscopes'][$_SESSION['commentListRecord']] . ') AND sys_language_uid>0) OR (uid IN (' .
				$_SESSION['ratingsscopes'][$_SESSION['commentListRecord']] . ') AND sys_language_uid<=0)) ' . $this->cObj->enableFields('tx_toctoc_ratings_scope');
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
				$countirows2=count($rows2);
				for ($i=0; $i<$countirows2; $i++){
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
				$addlanarr=array();
				$addlanarr[0]=0;
				$a=1;
				$countijrows2=count($rows2);
				for ($i=$j; $i<$countijrows2; $i++){
					if ($rows2[$i]['sys_language_uid']> 0) {
						if ($rows2[$i]['sys_language_uid']!= $curlan) {

							$curlan=$rows2[$i]['sys_language_uid'];
							$addlanarr[$a]=$curlan;
							$a++;
							// take over 0 table
							$curlanratingsscopesinternalm1table[$curlan] =$ratingsscopesinternalm1table;
							$countcurlanratingsscopesinternalm1tablecurlan=count($curlanratingsscopesinternalm1table[$curlan]);
							for ($t=0; $t<$countcurlanratingsscopesinternalm1tablecurlan; $t++){
								$curlanratingsscopesinternalm1table[$curlan][$t]['sys_language_uid']=$curlan;
							}

						}

						// build sys_lang_table
						$parent_found=0;
						$countcurlanratingsscopesinternalm1tablecurlan2=count($curlanratingsscopesinternalm1table[$curlan]);
						for ($t=0; $t<$countcurlanratingsscopesinternalm1tablecurlan2; $t++){
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
				$countaddlanarr=count($addlanarr);
				for ($t=0; $t<$countaddlanarr; $t++){
					$countaddlanarr2=count($curlanratingsscopesinternalm1table[$addlanarr[$t]]);
					for ($u=0; $u<$countaddlanarr2; $u++){
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
	/**
	 * Initializes tx_toctoc_comments_prefixtotable
	 *
	 * @return	void
	 */
	protected function initializeprefixtotablemap() {
		$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'*',
				'tx_toctoc_comments_prefixtotable',
				'',
				'',
				'',
				''
		);

		if (count($rowsrf)==0) {
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (1, ' . $this->conf['storagePid'] .
					", 1355437070, 1355437070, 0, 'tx_album3x_pi1', 'tx_album3x_images', '', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (2, ' . $this->conf['storagePid'] .
					", 1355437094, 1355437094, 0, 'tx_commerce_pi1', 'tx_commerce_products', '', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (3, ' . $this->conf['storagePid'] .
					", 1355437111, 1355437111, 0, 'tx_irfaq_pi1', 'tx_irfaq_q', '', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (4, ' . $this->conf['storagePid'] .
					", 1355437124, 1355437124, 0, 'tx_mininews_pi1', 'tx_mininews_news', '', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (5, ' . $this->conf['storagePid'] .
					", 1355437154, 1355437154, 0, 'tx_ttnews', 'tt_news', 'tt_news', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (6, ' . $this->conf['storagePid'] .
					", 1355437173, 1355437173, 0, 'tt_products', 'tt_products', 'product', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (8, ' . $this->conf['storagePid'] .
					", 1355437188, 1355437188, 0, 'tx_wecstaffdirectory_pi1', 'tx_wecstaffdirectory_info', '', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (9, ' . $this->conf['storagePid'] .
					", 1359197720, 1359197720, 0, 'tx_community', 'fe_users', 'user', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (10, ' . $this->conf['storagePid'] .
					", 1359299671, 1359299671, 0, 'tx_cwtcommunity_pi1', 'fe_users', 'action=getviewprofile&uid', '', '', 0)");
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (11, ' . $this->conf['storagePid'] .
					", 1360836115, 1360836115, 0, 'tx_news_pi1', 'tx_news_domain_model_news', 'news', '', '', 0)");
		}

	}
	/**
	 * writes if needed a tx-tc-shrrr-nnn.js
	 * returns link to file to be appended on output
	 *
	 * @return	void
	 */
	protected function sharrrejs() {
		$ret='';
		if ($_SESSION['sharrrejs'][$GLOBALS['TSFE']->id]!='') {
			$httpsid='';
			if (@$_SERVER['HTTPS'] == 'on') {
				// on https StumbleUpon and Digg fail
				if (($this->conf['sharing.']['dontUseSharingStumbleupon'] == 0) || ($this->conf['sharing.']['dontUseSharingDigg'] == 0)) {
					$httpsid='-https';
				}
			}

			$filenamejs='tx-tc-shrrr-' . $this->extVersion . '-' . $GLOBALS['TSFE']->id . '-' . $_SESSION['commentListRecord'] .
			'-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '.js';

			$dirsep=DIRECTORY_SEPARATOR;
			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');

			$txdirname= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/temp/' );
			$filenamejs=$txdirname . $filenamejs;

			$unlinked=FALSE;
			$jscontent = trim($_SESSION['sharrrejs']);

			$jscontent = '/*
 * sharrre events
 */
function tcrebshr' . $_SESSION['commentListRecord'] . '(){
	(function($) {
			'. $jscontent .'
	})(jQuery);
}';

			if (file_exists($filenamejs)) {
				$content = file_get_contents($filenamejs);
				if ($content != $jscontent) {
					$unlinked=TRUE;
					unlink($filenamejs);
				}

			}

			if ((!file_exists($filenamejs)) || ($unlinked)) {
				// Write the contents back to the file
				file_put_contents($filenamejs, $jscontent);
			}
			$httpsid='';
			if (@$_SERVER['HTTPS'] == 'on') {
				// on https StumbleUpon and Digg fail
				if (($this->conf['sharing.']['dontUseSharingStumbleupon'] == 0) || ($this->conf['sharing.']['dontUseSharingDigg'] == 0)) {
					$httpsid='-https';
				}
			}
			$filenm = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
			'res/js/temp/tx-tc-shrrr-' . $this->extVersion . '-' . $GLOBALS['TSFE']->id . '-' . $_SESSION['commentListRecord'] .
			'-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '.js';
			$mod1_file = $this->createVersionNumberedFilename($filenm);
			$ret='<script type="text/javascript" src="'. $mod1_file . '"></script>';

			$_SESSION['sharrrejs']='';
		}
		return $ret;
	}
	/**
	 * Function for static version numbers on files, based on the filemtime
	 *
	 * This will make the filename automatically change when a file is
	 * changed, and by that re-cached by the browser. If the file does not
	 * exist physically the original file passed to the function is
	 * returned without the timestamp.
	 *
	 * Behaviour is influenced by the setting
	 * TYPO3_CONF_VARS[TYPO3_MODE][versionNumberInFilename]
	 * = TRUE (BE) / "embed" (FE) : modify filename
	 * = FALSE (BE) / "querystring" (FE) : add timestamp as parameter
	 *
	 *                      ...the versioning to occur in the query string. This is needed for scriptaculous.js ...
	 *                      ...which cannot have a different filename in order to load its modules (?load=...)
	 *
	 * @param	string		$file Relative path to file including all potential query parameters (not htmlspecialchared yet)
	 * @param	boolean		$forceQueryString If settings would suggest to embed in filename, this parameter allows us to force ...
	 * @return	string		Relative path with version filename including the timestamp
	 */
	protected function createVersionNumberedFilename($file, $forceQueryString = FALSE) {
		$lookupFile = explode('?', $file);
		$path = $this->resolveBackPath($this->dirname(PATH_thisScript) . '/' . $lookupFile[0]);
		$mode = trim(strtolower($GLOBALS['TYPO3_CONF_VARS']['FE']['versionNumberInFilename']));

		if ($mode === 'embed') {
			$mode = TRUE;
		} else {
			if ($mode === 'querystring') {
				$mode = FALSE;
			} else {
				$doNothing = TRUE;
			}
		}
		if ($this->ignorequerystring == TRUE) {
			$doNothing = TRUE;
		}
		if (!file_exists($path) || $doNothing) {
			// File not found, return filename unaltered
			$fullName = $file;

		} else {
			if (!$mode || $forceQueryString) {
				// If use of .htaccess rule is not configured,
				// we use the default query-string method
				if ($lookupFile[1]) {
					$separator = '&';
				} else {
					$separator = '?';
				}

				$fullName = $file . $separator . filemtime($path);

			} else {
				// Change the filename
				$name = explode('.', $lookupFile[0]);
				$extension = array_pop($name);
				array_push($name, filemtime($path), $extension);
				$fullName = implode('.', $name);
				// append potential query string
				$fullName .= $lookupFile[1] ? '?' . $lookupFile[1] : '';
			}
		}

		return $fullName;
	}
	/**
	 * Resolves "../" sections in the input path string.
	 * For example "fileadmin/directory/../other_directory/" will be resolved to "fileadmin/other_directory/"
	 *
	 * @param	string		$pathStr File path in which "/../" is resolved
	 * @return	string
	 */
	private function resolveBackPath($pathStr) {
		$parts = explode('/', $pathStr);
		$output = array();
		$c = 0;
		foreach ($parts as $pV) {
			if ($pV == '..') {
				if ($c) {
					array_pop($output);
					$c--;
				} else {
					$output[] = $pV;
				}
			} else {
				$c++;
				$output[] = $pV;
			}
		}
		$ret = implode('/', $output);
		return $ret;
	}
	/**
	 * Returns the directory part of a path without trailing slash
	 * If there is no dir-part, then an empty string is returned.
	 * Behaviour:
	 *
	 * '/dir1/dir2/script.php' => '/dir1/dir2'
	 * '/dir1/' => '/dir1'
	 * 'dir1/script.php' => 'dir1'
	 * 'd/script.php' => 'd'
	 * '/script.php' => ''
	 * '' => ''
	 *
	 * @param	string		$path Directory name / path
	 * @return	string		Processed input value. See function description.
	 */
	private function dirname($path) {
		$p = $this->revExplode('/', $path, 2);
		$ret = count($p) == 2 ? $p[0] : '';
		return $ret;
	}
	/**
	 * Reverse explode which explodes the string counting from behind.
	 * Thus tx_div2007_div::revExplode(':','my:words:here',2) will return array('my:words','here')
	 *
	 * @param	string		$delimiter Delimiter string to explode with
	 * @param	string		$string The string to explode
	 * @param	integer		$count Number of array entries
	 * @return	array		Exploded values
	 */
	private function revExplode($delimiter, $string, $count = 0) {
		$explodedValues = explode($delimiter, strrev($string), $count);
		$explodedValues = array_map('strrev', $explodedValues);
		$ret = array_reverse($explodedValues);
		return $ret;
	}

	/**
	 * Applies stdWrap to given text
	 *
	 * @param	string		$text	Text to apply stdWrap to
	 * @param	string		$stdWrapName	Name for the stdWrap in $conf
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	string		Wrapped text
	 */
	public function applyStdWrap($text, $stdWrapName, $conf = NULL) {
		$conf = NULL;
		$retstr=$text;
		if (is_array($this->conf[$stdWrapName . '.'])) {
			if ($this->conf[$stdWrapName. '.']['wrap']) {
				$arrWrap=explode('|', $this->conf[$stdWrapName. '.']['wrap']);
				if (is_array($arrWrap)) {
					$retstr=$arrWrap[0] . $text .$arrWrap[1];
				}

			}

		}

		return $retstr;
	}
	/**
	 * Creates links from "http://..." or "www...." phrases.
	 *
	 * @param	string		$text	Text to search for links
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Text to convert
	 */
	public function createLinks($text, $conf = NULL) {
		$conf = NULL;
		if ($this->conf['advanced.']['autoConvertLinks']) {
			$textout=
			preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" class="tx-tc-external-autolink">\1</a>', $text);
			$textout= str_replace('." rel="nofollow"', '" rel="nofollow"', $textout);
			$textout= str_replace('," rel="nofollow"', '" rel="nofollow"', $textout);
			$textout= str_replace(',</a>', '</a>,', $textout);
			$textout= str_replace('.</a>', '</a>.', $textout);
		} else {
			$textout=$text;
		}

		return $textout;
	}

	/**
	 * returns height of a image in the current themes img directory
	 *
	 * @param	string		$filename: ...
	 * @param	int		$returnindex: 0 width, 1 height
	 * @return	int
	 */
	protected function getThemeTmageDimension($filename, $returnindex){
		$selectedTheme = trim($this->conf['theme.']['selectedTheme']);
		if (trim($this->conf['theme.']['selectedTheme']) == '') {
			$selectedTheme = 'default';
		}

		$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/pi1');
		$txdirname= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/');
		$filename=$txdirname . $selectedTheme . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $filename;
		$size = getimagesize($filename);
		$ret = $size[$returnindex];

		return $ret;

	}
	/**
	 * checks if a toctoc_comments user for an fe_user already exists and creates it if not
	 *
	 * @return	void
	 */
	protected function checktoctoccommentsuser(){
		$record = array();
		$feuserid=intval($GLOBALS['TSFE']->fe_user->user['uid']);
		if (!isset($_SESSION['checktoctoccommentsuser'])) {
			$_SESSION['checktoctoccommentsuser']=0;
		}

		if (($_SESSION['checktoctoccommentsuser'] == 0) && ($feuserid>0) && ($this->conf['pluginmode'] == 0 )) {

			$strCurrentIP=$this->lib->getCurrentIp();

			$fetoctocusertoquery ='"0.0.0.0.' . $feuserid . '"';
			$fetoctocusertoinsert ='0.0.0.0.' . $feuserid;

			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->conf['storagePid']);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->conf['storagePid']);
			}

			if ($tmpint) {
				$storagePidcond = 'pid=' . intval($this->conf['storagePid']);
				$firstpid= intval($this->conf['storagePid']);
			} else {
				$storagePidcond = 'pid IN (' . $GLOBALS['TYPO3_DB']->cleanIntList($this->conf['storagePid']) . ')';
				$pidarr = explode(',', $GLOBALS['TYPO3_DB']->cleanIntList($this->conf['storagePid']));
				$firstpid= intval(trim($pidarr[0]));
			}

			$rowfirstname = trim($GLOBALS['TSFE']->fe_user->user['first_name']);
			$rowlastname = trim($GLOBALS['TSFE']->fe_user->user['last_name']);

			if (($rowlastname == '') && ($rowfirstname == '')) {
				$rowfullname=trim($GLOBALS['TSFE']->fe_user->user['name']);
				$namePartsArr=explode(' ', $rowfullname);
				$countNameParts = count($namePartsArr);

				if ($countNameParts>1) {
					$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
					$tmpLASTNAME = trim(substr($rowfullname, (strlen($rowfullname)-$lastpartlen), 1000));
					$tmpFIRSTNAME = trim(substr($rowfullname, 0, strlen($rowfullname)-strlen($tmpLASTNAME)));
				} elseif (strlen($rowfullname)>1) {
					$tmpLASTNAME = trim($rowfullname);
					$tmpFIRSTNAME = '';
				} else {
					$tmpLASTNAME =trim($GLOBALS['TSFE']->fe_user->user['username']);
					$tmpFIRSTNAME = '';
				}

				$rowfirstname = trim($tmpFIRSTNAME );
				$rowlastname = trim($tmpLASTNAME );
			}

			$rowemail = trim($GLOBALS['TSFE']->fe_user->user['email']);
			$rowhomepage = trim($GLOBALS['TSFE']->fe_user->user['www']);
			$rowlocation = trim($GLOBALS['TSFE']->fe_user->user['city']);
			if ($rowemail != '') {
				$pageid = $GLOBALS['TSFE']->id;
				$pluginid = $_SESSION['commentListRecord'];
			// check the toctoc_comments_user
				$dataWhereuser = 'deleted=0 AND ' . $storagePidcond .
				' AND toctoc_comments_user = ' . $fetoctocusertoquery . '';
				list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr',
						'tx_toctoc_comments_user', $dataWhereuser);

				if (intval($rowusr['tusr']) === 0) {
					$strCurrentIPres=gethostbyaddr($strCurrentIP);
					$record= array(
							'crdate' => time(),
							'tstamp' => time(),
							'pid' => $firstpid,
							'toctoc_comments_user' => $fetoctocusertoinsert,
							'ipresolved' => trim($strCurrentIPres),
							'ip' => $strCurrentIP,
							'initial_firstname' => $rowfirstname,
							'initial_lastname' => trim($rowlastname),
							'initial_email' => trim($rowemail),
							'initial_homepage' => trim($rowhomepage),
							'initial_location' => trim($rowlocation),
					);
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user', $record);

					list($rowusrmm) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr',
							'tx_toctoc_comments_feuser_mm', $dataWhereuser);
					if (intval($rowusrmm['tusr']) === 0) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstampseen' => time(),
								'pagetstampseen' =>$pageid,
								'tstamp' => time(),
								'seen' => 0,
								'pid' => $firstpid,
								'idislike' => 0,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feuserid,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $pluginid,
								'remote_addr' => $strCurrentIP
						));
					}

				}

				$_SESSION['AJAXUserimagerefresh'] = TRUE;
				$_SESSION['AJAXUserimagerefreshImage'] = trim($GLOBALS['TSFE']->fe_user->user['image']);
				$_SESSION['checktoctoccommentsuser']=1;
			}

		}

	}
	/**
	 * Translates current TYPO3 languague to Facebook or Google Language Code
	 *
	 * @param	[type]		$isfacebook: ...
	 * @return	void
	 */
	protected function fbgoogle_lan($isfacebook) {
		$translarray = array(
'af' => array('af','af_ZA'),
'sq' => array('en-GB','sq_AL'),
'ar' => array('ar','ar_AR'),
'ms' => array('en-GB','ml_IN'),
'eu' => array('eu','eu_ES'),
'bs' => array('bn','bs_BA'),
'pt_BR' => array('pt-BR','pt_BR'),
'bg' => array('bg','bg_BG'),
'ca' => array('ca','ca_ES'),
'ch' => array('zh-CN','zh_CN'),
'zh' => array('zh-TW','zh_TW'),
'hr' => array('hr','hr_HR'),
'cs' => array('cs','cs_CZ'),
'da' => array('da','da_DK'),
'nl' => array('nl','nl_NL'),
'en' => array('en-GB','en_GB'),
'eo' => array('en-GB','eo_EO'),
'et' => array('et','et_EE'),
'fo' => array('fil','fo_FO'),
'fi' => array('fi','fi_FI'),
'fr' => array('fr','fr_FR'),
'fr_CA' => array('fr-CA','fr_CA'),
'gl' => array('gl','gl_ES'),
'ka' => array('en-GB','ka_GE'),
'de' => array('de','de_DE'),
'el' => array('el','el_GR'),
'kl' => array('en-GB','en_GB'),
'he' => array('iw','he_IL'),
'hi' => array('hi','hi_IN'),
'hu' => array('hu','hu_HU'),
'is' => array('is','is_IS'),
'it' => array('it','it_IT'),
'ja' => array('ja','ja_JP'),
'km' => array('en-GB','km_KH'),
'ko' => array('ko','ko_KR'),
'lv' => array('lv','lv_LV'),
'lt' => array('lt','lt_LT'),
'no' => array('no','nb_NO'),
'fa' => array('fa','fa_IR'),
'pl' => array('pl','pl_PL'),
'pt' => array('pt-PT','pt_PT'),
'ro' => array('ro','ro_RO'),
'ru' => array('ru','ru_RU'),
'sr' => array('sr','sr_RS'),
'sk' => array('sk','sk_SK'),
'sl' => array('sl','sl_SI'),
'es' => array('es','es_ES'),
'sv' => array('sv','sv_SE'),
'th' => array('th','th_TH'),
'tr' => array('tr','tr_TR'),
'uk' => array('uk','uk_UA'),
'vi' => array('vi','vi_VN'),
);
		$ret='';
		$selarray = $translarray[$GLOBALS['TSFE']->lang];
		if (is_array($selarray)) {
			if ($isfacebook == TRUE) {
				$ret=$selarray[1];
			} else {
				$ret=$selarray[0];
			}

		} else {
			if ($isfacebook == TRUE) {
				$ret='en_GB';
			} else {
				$ret='en-GB';
			}
		}
		return $ret;

	}


}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']);
}
?>