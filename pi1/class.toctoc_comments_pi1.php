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
 *  109: class tx_toctoccomments_pi1 extends tslib_pibase
 *  201:     public function main($content, $conf, $hookTablePrefix = '', $hookId = 0, $hookcObj = NULL)
 * 2886:     protected function checkJSLoc()
 * 3173:     protected function checkCSSTheme()
 * 3219:     protected function checkCSSLoc()
 * 3555:     protected function makesharingcss($CSSmode = TRUE)
 * 3579:     protected function initprefixToTableMap()
 * 3615:     protected function initexternaluid($withinitprefixToTableMap)
 * 3766:     protected function init()
 * 4443:     protected function mergeConfiguration()
 * 4792:     protected function fetchConfigValue($param)
 * 4820:     protected function ae_detect_ie()
 * 4843:     protected function boxmodel()
 * 5847:     protected function crunchcss($buffer)
 * 5870:     protected function locationHeaderUrlsubDir()
 * 5889:     protected function currentPageName()
 * 5919:     protected function ttclearcache ($pid, $withplugin=TRUE, $withcache = FALSE, $debugstr = '')
 * 5954:     protected function doClearCache($forceclear=FALSE)
 * 5988:     protected function InitCachingVariables ()
 * 6047:     protected function getPluginCacheControlTstamp ($external_ref_uid)
 * 6058:     protected function getLastUserAdditionTstamp ()
 * 6081:     protected function initLegacyCache ()
 * 6095:     protected function check_scopes()
 * 6253:     protected function initializeprefixtotablemap()
 * 6296:     protected function sharrrejs()
 * 6404:     protected function createVersionNumberedFilename($file, $forceQueryString = FALSE)
 * 6457:     private function resolveBackPath($pathStr)
 * 6492:     private function dirname($path)
 * 6506:     private function revExplode($delimiter, $string, $count = 0)
 * 6522:     public function applyStdWrap($text, $stdWrapName, $conf = NULL)
 * 6545:     public function createLinks($text, $conf = NULL)
 * 6568:     protected function getThemeTmageDimension($filename, $returnindex)
 * 6588:     protected function checktoctoccommentsuser()
 * 6711:     protected function getExternalUidShortId()
 * 6756:     protected function checkandload_emolikes()
 * 6807:     protected function fbgoogle_lan($isfacebook)
 * 6889:     private function detectmobile($isTabletOrHandyexceptFF = FALSE)
 * 6929:     protected function getReportUser($ReportPluginMode)
 *
 * TOTAL FUNCTIONS: 37
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
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('tslib_pibase', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Plugin\AbstractPlugin', 'tslib_pibase');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	(class_exists('t3lib_utility_Math', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\MathUtility', 't3lib_utility_Math');
	(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
	if ((!t3lib_extMgm::isLoaded('compatibility6')) && (!t3lib_extMgm::isLoaded('compatibility7'))) {
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
	public $extVersion = '920';
	public $extLESSVersion = 'toctoc_comments-LESS.2';

	public $pi_checkCHash = TRUE;				// Required for proper caching! See in the typo3/sysext/cms/tslib/class.tslib_pibase.php
	public $externalUid;						// UID of external record
	public $externalUidString = '';
	public $showUidParam = 'showUid';			// Name of 'showUid' GET parameter (different for tt_news!)
	public $where;								// SQL WHERE for records
	public $where_dpck;						// SQL WHERE for double post checks
	public $templateCode;						// Full template code
	public $foreignTableName;					// Table name of the record we comment on
	public $formValidationErrors = array();	// Array of form validation errors
	public $formTopMessage = '';// This message is displayed in the top of the form
	public $feuserid=0;

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
	public $conf = array();
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

	private $newestLessFileTime = 0;
	private $newestCSSFileTime = 0;

	public $canZip = FALSE;
	public $reprtUserByID = FALSE;
	public $clientissearchengine = FALSE;

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
		if (!is_array($conf)) {
			return '<div><span>Basic configuration for extension toctoc_comments is missing. Static template loaded?</span></div>';
		} elseif (count($conf) < 20) {
			$cntconf = count($conf);
			return '<div><span>Basic configuration (elements: ' . $cntconf . ') for extension toctoc_comments too small. Static template loaded?</span></div>';
		}

		if (function_exists('gzdecode')) {
			$this->canZip = TRUE;
		}

		if ($conf['optionalRecordId'] == 'Pagemode') {
			$conf['optionalRecordId'] =  'pages_' . $GLOBALS['TSFE']->id;
		}

		unset($conf['theme.']['refreshCSSFromLESS']);
		unset($conf['theme.']['freezeLevelCSS']);

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
		if (intval($this->conf['sessionTimeout']) < 2) {
			$this->conf['sessionTimeout'] = 1440;
		}

		if (intval($this->conf['dbCacheTimeout']) < intval($this->conf['sessionTimeout'])) {
			$this->conf['dbCacheTimeout'] = intval($this->conf['sessionTimeout']);
		}
		
		$this->conf['advanced.']['useSessionCache'] = 1;

		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);

		if (intval($this->conf['debug.']['useDebug']) == 1) {
			$this->showsdebugprint = TRUE;
		}

		if (intval($this->conf['pluginmode']) > 0) {
			if ($hookTablePrefix != '') {
				if ($hookcObj != NULL) {
					$this->cObj=$hookcObj;
				} else {
					if (!isset($this->cObj)) {
						$this->cObj = t3lib_div::makeInstance('tslib_cObj');
						$this->cObj->start('', '');
					}

				}

			}

			$hookTablePrefix = '';
			$hookId = 0;
		}

		$loginreset = FALSE;
		$sdebugprintli = '';
		// give a reply to search enignes and avoid indexing of comments
		if (intval($this->conf['pluginmode'])==0) {
			$interestingCrawlers = array('googlebot','yahoo','baidu','msnbot','bingbot','spider','bot.htm','yandex','jeevez' );
			$interestingCrawlersConf = explode(',', $this->conf['advanced.']['blacklistCrawlerAgentStrings']);

			$tmparr = array_merge($interestingCrawlers, $interestingCrawlersConf);
			$interestingCrawlers = array_unique($tmparr);
			$interestingWhiteCrawlersConf = explode(',', $conf['advanced.']['whitelistCrawlerAgentStrings']);
			$interestingWhiteCrawlersConf = array_unique($interestingWhiteCrawlersConf);

			$numcookies = count($_COOKIE);
			$numMatches = 0;
			$countinterestingCrawlers = count($interestingCrawlers);
			$countinterestingWhiteCrawlersConf = count($interestingWhiteCrawlersConf);
			$identstr = '';

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

		}

		$this->lib = t3lib_div::makeInstance('toctoc_comment_lib');

		$this->clientissearchengine = FALSE;

		if (intval($this->conf['pluginmode'])==0) {
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
									for ($i = $cntarrCurrentIPres-1; (($i > 0) && ($i > ($cntarrCurrentIPres-4))); $i--) {
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

					if (!(file_exists(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt'))) {
						if (version_compare(TYPO3_version, '6.0', '<')) {
							t3lib_div::writeFile(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt', $protocol);
						} else	{
							\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt', $protocol);
						}

					} else {
						$content = file_get_contents(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt');
						$contentarr = explode("\r\n", $content);
						$testelem = $contentarr[count($contentarr)-1];
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

					$blprt = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'blacklistprotocol.txt';
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

			if ((trim($hookTablePrefix)) != '' && (intval($hookId) > 0)) {
				$this->conf['dontSkipSearchEngines'] = 1;
			}

			if($numMatches > 0) {
				// Found a match
				if (intval($this->conf['dontSkipSearchEngines']) == 0) {
					$this->pi_USER_INT_obj = 1;
					return 'botMessage_' . $this->extKey . '_' . $this->extVersion;
				}

				$this->conf['advanced.']['useSessionCache'] = 0;
				$this->clientissearchengine = TRUE;
			}

			// end exclude search enignes and avoid indexing of comments
			$zeroUserId = FALSE;
			if ($this->conf['debug.']['useDebugFeUserIds'] != '') {
				$dbuarr=explode(',', $this->conf['debug.']['useDebugFeUserIds']);
				foreach($dbuarr as $dbusr) {
					if ($dbusr == intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$this->sdebugprintuser=$dbusr;
					}

					if ($dbusr == intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$zeroUserId = TRUE;
					}

				}

			}

			if ($zeroUserId == TRUE) {
				if (version_compare(TYPO3_version, '4.9', '>')) {
					if (!\TYPO3\CMS\Core\Utility\GeneralUtility::cmpIP(
							\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR'),
							$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'])
					) {
						$this->sdebugprintuser=$dbusr;
					}

				} else {
					if(!t3lib_div::cmpIP(t3lib_div::getIndpEnv('REMOTE_ADDR'), $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'])) {
						$this->sdebugprintuser=$dbusr;
					}

				}

			}

		}

		if (intval($this->conf['debug.']['showStartupDetails']) == 1) {
			$this->showsdebugprintstartuptimes = TRUE;
		}

		if (intval($this->conf['debug.']['showLibDetails']) == 1) {
			$showsdebugprintlibtimes = TRUE;
		}

		$this->showCSScomments = $this->conf['debug.']['showCSScomments'];
		$this->showDropsfromBoxmodel = $this->conf['debug.']['showDropsfromBoxmodel'];

		unset($this->conf['debug.']);

		$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
		$this->commonObj->start_toctoccomments_session($this->conf['sessionTimeout'], '', $this->conf, TRUE);

		// detect possible COOKIE unfriendly client
		$countcookies = count($_COOKIE);
		$hascookie = trim($_COOKIE['sess_' . $this->extKey]);

		if ($hascookie == '') {
			$countcookies = 0;
		}

		if ($countcookies == 0) {
			// could be COOKIE unfriendly client
			$strCurrentIP = $this->lib->getIpAddr();
			$this->commonObj->removegarbagesessions($strCurrentIP);
		}

		if ($this->showsdebugprint == TRUE) {
			$starttimedebug = microtime(TRUE);
			$timereportlast = '';
			if ($this->sdebugprintuser == intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$tdifftolastrun = 1000*(microtime(TRUE) - $_SESSION['edgeTime']);
				if ($tdifftolastrun <= intval($this->maxtimeafterinsert)) {
					$timereportlast = '<div class="tx-tc-debug">Time since last rendering: ' . intval($tdifftolastrun) . ' ms</div>';
				}

			}

		}

		if (intval($showsdebugprintlibtimes) == 1) {
			$strdebugprintlib = '';
			$starttimedebuglib = microtime(TRUE);
		}

		if (intval($showsdebugprintlibtimes) == 1) {
			$difftimedebuglib = 1000*(microtime(TRUE)-$starttimedebuglib);
			$strdebugprintlib = '<div class="tx-tc-debug"><b>Lib, details</b> (times in ms):<br />Load Lib ' . intval($difftimedebuglib) . '';
		}

		$this->lib->fixLL($this->conf);

		$this->pi_loadLL();

		// check plugin
		$this->boxmodelcss = 'tx-tc-' . $this->extVersion . '.css';

		$this->pi_initPIflexForm();
		$isPlugin=0;

		if (intval($this->conf['dataProtect.']['cookieLifetime']) < 7) {
			$this->conf['dataProtect.']['cookieLifetime'] = 7;
		}

		if (intval($this->conf['advanced.']['sortMostPopular']) == 1) {
			$this->conf['advanced.']['reverseSorting'] = 1;
		}

		if (intval($this->conf['ratings.']['maxValue']) > 11) {
			$this->conf['ratings.']['maxValue'] = 11;
		}

		if (intval($this->conf['ratings.']['maxValue']) < 1) {
			$this->conf['ratings.']['maxValue'] = 1;
		}

		if (intval($this->conf['advanced.']['emailValidDays']) > 365) {
			$this->conf['advanced.']['emailValidDays'] = 365;
		}

		if (intval($this->conf['advanced.']['emailValidDays']) < 7) {
			$this->conf['advanced.']['emailValidDays'] = 7;
		}

		if (intval($this->conf['ratings.']['minValue']) > intval($this->conf['ratings.']['maxValue'])) {
			$this->conf['ratings.']['minValue'] = intval($this->conf['ratings.']['maxValue']);
		}

		$this->conf['advanced.']['activateClearPageCache'] = 0;

		if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
			if (str_replace('.txt', '', $this->conf['theme.']['selectedBoxmodel']) == $this->conf['theme.']['selectedBoxmodel']) {
				$this->conf['theme.']['selectedBoxmodel'] .= '.txt';
			}

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

		if ((intval($_SESSION['AJAXimagesrefresh']) == TRUE) || ($this->conf['advanced.']['useSessionCache'] == 0)) {
			$this->InitCachingVariables();

		}

		if (version_compare(TYPO3_version, '4.9', '>')) {
			if (!\TYPO3\CMS\Core\Utility\GeneralUtility::cmpIP(
					\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR'),
					$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'])
			) {
				unset($_GET['purge_cache']);
			}

		} else {
			if(!t3lib_div::cmpIP(t3lib_div::getIndpEnv('REMOTE_ADDR'), $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'])) {
				unset($_GET['purge_cache']);
			}

		}

		if (((intval($this->conf['pluginmode'])==0) || (intval($this->conf['pluginmode'])==5)) && (intval($_GET['purge_cache'])==1)) {
			unset($_GET['purge_cache']);
			$this->InitCachingVariables();
			$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cacheajax');
			$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport');
			$_SESSION['ccacheajax'] = 1;
			$sdebugprintli .= '<br />'. 'purge_cache = 1, page-id ' .$GLOBALS['TSFE']->id. '<br />';
		} else {
			if ($loginreset == TRUE) {
				$this->InitCachingVariables();
				$loginreset = FALSE;
				$this->lib->resetSessionVars(0);
				$_SESSION['activeBoxmodel']=$this->conf['theme.']['selectedBoxmodel'];
				$_SESSION['commentsPageId'] = $GLOBALS['TSFE']->id;
				$_SESSION['curPageName'] = $this->currentPageName();
				$_SESSION['activelang'] = $GLOBALS['TSFE']->lang;
				$sdebugprintli .= '<br />'. 'Init Sessionvariables because of logout/in on page id ' .$GLOBALS['TSFE']->id. '<br />';
			} else {
				if (intval(t3lib_div::_GP('purge_cache'))==1) {

					$sdebugprintli.= '<br />'. 'No more Init Sessionvariables because of logout/in or purge_cache on page id ' .$GLOBALS['TSFE']->id. '<br />';
				}

			}

		}

		if (t3lib_div::_GET('tx_toctoccomments_pi2')) {
			$postDatapi2temp = t3lib_div::_GET('tx_toctoccomments_pi2');
			if (($postDatapi2temp['ajax'] == 'tx_toctoccomments_pi2') && (t3lib_div::_GET('pid')) && (t3lib_div::_GET('refreshcontent')== 'refresh')) {
				$_GET = array();
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

			if ($_SESSION['doChangePasswordForm'] == 2) {
				$this->InitCachingVariables();
				$sdebugprintli .= '<br />'. 'purge_cache on reset password, page-id ' .$GLOBALS['TSFE']->id. '<br />';
			}

		}

		$_SESSION['httpuseragent'] = $_SERVER['HTTP_USER_AGENT'];
		$_SESSION['formTopMessage'] = '';

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

		if (intval($this->conf['theme.']['boxmodelSpacing'])>20) {
			$this->conf['theme.']['boxmodelSpacing']=20;
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
			$this->conf['theme.']['boxmodelInputFieldSize'] = 12;
		}

		if (intval($this->conf['advanced.']['showCountViews'])== 0) {
			$this->conf['advanced.']['showCountCommentViews'] = 0;
		}

		if (intval($this->conf['advanced.']['viewMaxAge'])==0) {
			$this->conf['advanced.']['viewMaxAge'] = 28;
		}

		if (intval($this->conf['advanced.']['activityMultiplicatorRating']) < 1) {
			$this->conf['advanced.']['activityMultiplicatorRating'] = 1;
		}

		if (intval($this->conf['advanced.']['activityMultiplicatorComment']) < 1) {
			$this->conf['advanced.']['activityMultiplicatorComment'] = 1;
		}

		if (intval($this->conf['ratings.']['dlikeCtsNotifLvl']) <  1) {
			$this->conf['ratings.']['dlikeCtsNotifLvl'] = 1;
		}

		if (intval($this->conf['ratings.']['dlikeCtsNotifLvl'])> 99) {
			$this->conf['ratings.']['dlikeCtsNotifLvl'] = 99;
		}

		if (intval($this->conf['ratings.']['useLikeDislikeStyle']) == 1) {
			// force top likes to be short if dislikestyle = 1 - inverse is possible
			$this->conf['ratings.']['useShortTopLikes'] = 1;
		}

		if (intval($this->conf['ratings.']['useShortTopLikes']) == 1) {
			$this->conf['ratings.']['emoLike'] = 0;
		}

		if (intval($this->conf['advanced.']['wallExtension']) != 0) {
			// on cummunity page reviews and login required is not possible
			$this->conf['advanced.']['loginRequired'] = 0;
			$this->conf['advanced.']['commentReview'] = 0;
		}

		if (intval($this->conf['sessionTimeout']) < 2) {
			$this->conf['sessionTimeout'] = 1440;
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

		if (trim($this->conf['sessionCompressionLevel']) == '') {
			$this->conf['sessionCompressionLevel'] = 0;
		}

		if (intval($this->conf['sessionCompressionLevel']) < 0) {
			$this->conf['sessionCompressionLevel'] = 0;
		}

		if (intval($this->conf['sessionCompressionLevel']) >5) {
			$this->conf['sessionCompressionLevel'] = 5;
		}

		if (intval($conf['ratings.']['emoLikeMaxTippEntries']) >10) {
			$this->conf['ratings.']['emoLikeMaxTippEntries'] = 10;
		}

		if (intval($conf['ratings.']['emoLikeMaxTippEntries']) <3) {
			$this->conf['ratings.']['emoLikeMaxTippEntries'] = 3;
		}

		if (intval($conf['ratings.']['LikeMaxReportLineEntries']) >5) {
			$this->conf['ratings.']['LikeMaxReportLineEntries'] = 5;
		}

		if (intval($conf['ratings.']['LikeMaxReportLineEntries']) <2) {
			$this->conf['ratings.']['LikeMaxReportLineEntries'] = 3;
		}

		if (intval($conf['ratings.']['LikeMaxReportTippEntries']) >13) {
			$this->conf['ratings.']['LikeMaxReportTippEntries'] = 13;
		}

		if (intval($conf['ratings.']['LikeMaxReportTippEntries']) <3) {
			$this->conf['ratings.']['LikeMaxReportTippEntries'] = 6;
		}

		if (intval($conf['ratings.']['emoLikeMaxOverviewEntries']) < 3) {
			$this->conf['ratings.']['emoLikeMaxOverviewEntries'] = 12;
		}
		if (intval($conf['ratings.']['emoLikeMaxOverviewEntries']) > 50) {
			$this->conf['ratings.']['emoLikeMaxOverviewEntries'] = 50;
		}

		if ($this->conf['UserImageSize'] > 96) {
			$this->conf['UserImageSize'] = 96;
		}

		if ($this->conf['UserImageSize'] < 18) {
			$this->conf['UserImageSize'] = 18;
		}

		if (intval($this->conf['UserImageSizeInForm']) == 0) {
			$this->conf['UserImageSizeInForm'] = $this->conf['UserImageSize'];
		}

		if ($this->conf['UserImageSizeInForm'] > 96) {
			$this->conf['UserImageSizeInForm'] = 96;
		}

		if ($this->conf['UserImageSizeInForm'] < 18) {
			$this->conf['UserImageSizeInForm'] = 18;
		}

		$filename = 'toctoc_comments_myrating_star.png';
		$this->conf['ratings.']['ratingImageWidth'] = $this->getThemeTmageDimension($filename, 0);
		$filename = 'toctoc_comments_myreview_star.png';
		$this->conf['ratings.']['reviewImageWidth'] = $this->getThemeTmageDimension($filename, 0);
		$filename = 'ilikev2.png';
		$this->conf['ratings.']['likeV2ImageWidth'] = $this->getThemeTmageDimension($filename, 0);
		$filename = 'commentslist-more.png';
		$this->conf['ratings.']['CommentImageWidth'] = $this->getThemeTmageDimension($filename, 0);
		$filename = 'ilike.png';
		$this->conf['ratings.']['likeImageWidth'] = $this->getThemeTmageDimension($filename, 0);

		if (!is_array(explode(',', $this->conf['theme.']['responsiveSteps']))) {
			$this->arrResponsiveSteps[0] = 350;
			$this->arrResponsiveSteps[1] = 450;
		} else {
			$this->arrResponsiveSteps=explode(',', $this->conf['theme.']['responsiveSteps']);
			if (intval(trim($this->arrResponsiveSteps[0])) != 0) {
				$this->arrResponsiveSteps[0] = intval(trim($this->arrResponsiveSteps[0]));
			} else {
				$this->arrResponsiveSteps[0] = 350;
			}

			if (intval(trim($this->arrResponsiveSteps[1])) != 0) {
				$this->arrResponsiveSteps[1] = intval(trim($this->arrResponsiveSteps[1]));
			} else {
				$this->arrResponsiveSteps[1] = 450;
			}

		}

		if ($this->conf['advanced.']['midDot'] != '') {
			$this->middotchar = $this->conf['advanced.']['midDot'];
		} else {
			$this->middotchar = '&nbsp;';
		}

		if (intval($this->conf['theme.']['themeVersion']) == 2) {
			$this->middotchar = '';
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

		$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;

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

		$contentelementMultiReference = '';
		if (($this->conf['externalPrefix'] != 'pages') && ($this->lhookTablePrefix == '')) {
			$contentelementMultiReference = '' . $this->conf['storagePid'];
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
		$_SESSION['sharrrejs'] = '';
		unset($_SESSION['requestCapcha']);
		$_SESSION['requestCapcha'] = array();

		$tdiff = 1000*(microtime(TRUE) - $_SESSION['edgeTime']);
		$sessionreseted=FALSE;
		$this->processcssandjsfiles=FALSE;

		if ($this->showsdebugprint==TRUE) {
			if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$timereportlast.='<div class="tx-tc-debug"><b>' . date('H:i:s') . '</b></div>';
			}

		}

		$slcurrentPageName = $this->currentPageName();
		$_SESSION['activelangid'] = $GLOBALS['TSFE']->sys_language_uid;

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
			$_SESSION['curPageName'] = $slcurrentPageName;
			$_SESSION['numberOfPages']++;

		} elseif ($_SESSION['curPageName'] != $slcurrentPageName) {
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

			$_SESSION['feuserid'] = $GLOBALS['TSFE']->fe_user->user['uid'];

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

		if ($this->showsdebugprint==TRUE) {
			$starttimeTYPO3metamodel=microtime(TRUE);
			$endtimehookaccess=0;
			$endtimesetcommentListRecord=0;
			$endtimecommentsupdate=0;
		}

		$wherecid = 'uid = ' . strval($GLOBALS['TSFE']->id) . '';

		// Check if TS template was included
		if (!isset($conf['advanced.'])) {
			// TS template is not included
			$retstr = '<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
					$this->lib->pi_getLLWrap($this, 'error.no.ts.template', FALSE)) . '</p></div>';
			$this->commonObj->stop_toctoccomments_session();
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

		if ($this->showsdebugprint==TRUE) {
			$starttimecObj=microtime(TRUE);
		}

		if (!isset($this->cObj)) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}
		$uidok = 0;
		$current_content_uid = 0;
		if (isset($this->cObj->data['uid'])) {
			if ($this->cObj->data['uid'] != '') {

				$current_content_uid = $this->cObj->data['uid'];
				if ($GLOBALS['TSFE']->sys_language_uid != 0) {
					if (intval($this->conf['advanced.']['useMultilingual']) == 0) {
						//debug($this->cObj);
						if ($this->cObj->data['l18n_parent'] != 0) {
							$current_content_uid = $this->cObj->data['l18n_parent'];
						}

					}

				}

				$current_content_CType =  $this->cObj->data['CType'];
				if ($this->conf['externalPrefix'] == 'pages') {
					$current_content_record = 'tt_content';
				} else {
					$current_content_record = $this->conf['externalPrefix'];
				}

				$uidok = 1;

			}
		}
		if (isset($this->cObj->parentRecord['data']['uid']) && ($uidok == 0)) {
			if ($this->cObj->parentRecord['data']['uid'] != '') {
				$current_content_uid =  $this->cObj->parentRecord['data']['uid'];
				if ($GLOBALS['TSFE']->sys_language_uid != 0) {
					if (intval($this->conf['advanced.']['useMultilingual']) == 0) {
						//debug($this->cObj->parentRecord['data']);
						if ($this->cObj->parentRecord['data']['l18n_parent'] != 0) {
							$current_content_uid = $this->cObj->parentRecord['data']['l18n_parent'];
						}

					}

				}

				$current_content_CType =  $this->cObj->parentRecord['data']['CType'];
				if ($this->conf['externalPrefix'] == 'pages') {
					$current_content_record = 'tt_content';
				} else {
						$current_content_record = $this->conf['externalPrefix'];
				}

				$uidok = 1;
			}

		}

	 	if (($uidok == 0)) {
			$current_content_uid = (1000 + $GLOBALS['TSFE']->id) . $this->conf['storagePid'] . $this->lhookId;
			if ($GLOBALS['TSFE']->sys_language_uid != 0) {
				if (intval($this->conf['advanced.']['useMultilingual']) == 1) {
					$current_content_uid = (1000 + (($GLOBALS['TSFE']->sys_language_uid)*1000) + $GLOBALS['TSFE']->id) . $this->conf['storagePid'] . $this->lhookId;
				}

			}

			$current_content_CType =  'hook';
			$current_content_record =  $this->lhookTablePrefix;
		}

		if (($current_content_uid == 0) && (intval($this->conf['pluginmode']) == 0)) {
			// The Contentelement ID containing the plugin could not be found automatically.
			$edatum = date('d.m.Y', time());
			$euhrzeit = date('H:i', time());
			$echodate = $edatum . ' - '. $euhrzeit;
			$retstr = '<div class="tx-tc-form-top-message tx-tc-required-error"><p>' . $echodate . '<br />' .
					$this->lib->pi_getLLWrap($this, 'error.automaticcidfail', FALSE) .
					'</p></div>';
			$this->commonObj->stop_toctoccomments_session();
			return $retstr;
		}

		if ($this->showsdebugprint==TRUE) {
			$endtimecObj=microtime(TRUE);
		}

		if ((intval($GLOBALS['TSFE']->fe_user->user['uid'])>0) && ($this->conf['pluginmode'] == 0 )) {
			if ($this->conf['sharing.']['useOnlySharing'] != 1) {
			// checking if there was a change of the current users image
				$fldimage = 'image';
				if ($this->conf['advanced.']['FeUserDbField']) {
					$fldimage = $this->conf['advanced.']['FeUserDbField'];
				}
				$currentuserimage = '';
				if (intval(trim($GLOBALS['TSFE']->fe_user->user[$fldimage])) != 0) {
					$querysys_file_reference = 'SELECT uid_local FROM sys_file_reference WHERE tablenames = "fe_users" AND deleted=0 and hidden=0 and uid_foreign=' . $GLOBALS['TSFE']->fe_user->user['uid'] . ' AND sorting_foreign=1 AND fieldname="' . $fldimage .'"';
					$resultsys_file_reference= $GLOBALS['TYPO3_DB']->sql_query($querysys_file_reference);
					$uid_local = 0;
					while ($rowssys_file_reference = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultsys_file_reference)) {
						$uid_local = $rowssys_file_reference['uid_local'];
						break;
					}
					$storage = 0;
					if ($uid_local != 0) {
						$querysys_file = 'SELECT name, identifier, storage FROM sys_file where uid=' . $uid_local;
						$resultsys_file= $GLOBALS['TYPO3_DB']->sql_query($querysys_file);
						$uid_local = 0;
						while ($rowssys_file = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultsys_file)) {
							$currentuserimage = $rowssys_file['identifier'];
							$storage = $rowssys_file['storage'];
							break;
						}
					}
					$currentstorage = 'fileadmin';
					if ($storage != 0) {
						$querysys_storage = 'SELECT configuration FROM sys_file_storage where uid=' . $storage;
						$resultsys_storage = $GLOBALS['TYPO3_DB']->sql_query($querysys_storage);
						$uid_local = 0;
						while ($rowssys_storage = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultsys_storage)) {
							$currentstoragexml = $rowssys_storage['configuration'];
											/*
											 * <?xml version="1.0" encoding="utf-8" standalone="yes" ?>
				<T3FlexForms>
				    <data>
				        <sheet index="sDEF">
				            <language index="lDEF">
				                <field index="basePath">
				                    <value index="vDEF">fileadmin/</value>
				                </field>
				                <field index="pathType">
											*/
							$currentstoragexmlarr = explode('"basePath"', $currentstoragexml);
							$currentstoragexmlarrs1 = $currentstoragexmlarr[1];
							$currentstoragexmlarr2 = explode('index="vDEF">', $currentstoragexmlarrs1);
							$currentstoragexmlarrs2 = $currentstoragexmlarr2[1];
							$currentstoragexmlarr3 = explode('/</value>', $currentstoragexmlarrs2);
							$currentstorage= $currentstoragexmlarr3[0];
							break;
						}
					}
					if ($currentuserimage != '') {
						$arrimg = explode('/', $currentuserimage);
						$currentuserimagename = array_pop($arrimg);
						$FeUserImagePath = implode('/', $arrimg);
						$FeUserImagePath = $currentstorage . $FeUserImagePath . '/';
						$currentuserimage = $currentstorage . $currentuserimage;
						$this->conf['advanced.']['FeUserImagePath'] = $FeUserImagePath;
					}

				} else {
					$currentuserimage = trim($this->conf['advanced.']['FeUserImagePath']) . trim($GLOBALS['TSFE']->fe_user->user[$fldimage]);
					$currentuserimagename = trim($GLOBALS['TSFE']->fe_user->user[$fldimage]);
				}

				if (isset($_SESSION['AJAXOrigimages'])) {
					if (is_array($_SESSION['AJAXOrigimages'])) {
						if (count($_SESSION['AJAXOrigimages'])>1) {
							if (trim($_SESSION['AJAXOrigimages'][$currentuserimage]) == '') {
								$_SESSION['AJAXimages'] = array();
								$_SESSION['AJAXOrigimages'] = array();
								$saveactivateClearPageCache=$this->activateClearPageCache;
								$this->activateClearPageCache=TRUE;
								$this->doClearCache();
								$this->activateClearPageCache=$saveactivateClearPageCache;
								$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport WHERE ReportPluginMode = 11');
								$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET tstamp =' . time() . ' WHERE external_ref_uid != "tx_toctoc_comments_feuser_mm_0"');

							}

						}

					}

				}

			}

		}

		$typolinksmade = 0;
		if ((intval($this->conf['pluginmode']) == 0) || (intval($this->conf['pluginmode']) == 5)) {
			$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
			$no_cacheflag = 0;
			if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) == 0) {
				if ($useCacheHashNeeded == 1) {
					$no_cacheflag = 1;
				}

			}

			//unset($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]);
			if ($this->conf['commentsreport.']['active']) {
				$conftx_commentsreport = $this->conf['commentsreport.'];
				$this->conf['tx_commentsreport_pi1.']['reportPid']=$conftx_commentsreport['reportPid'];
				$_SESSION['reportpageid'] = $conftx_commentsreport['reportPid'];
			}

			if (intval($this->conf['dataProtect.']['disclaimerPageID']) > 0) {

				if (!(is_array($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]))) {

					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])] = array();
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage'] = '';
				}

				if (!isset($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage'])) {
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage'] = '';
				}

				if (trim($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage']) == '') {
					$conflink = array(
							// Link to current page
							'parameter' => intval($this->conf['dataProtect.']['disclaimerPageID']),
							// Set additional parameters
							'additionalParams' => '',
							'ATagParams' => 'rel="nofollow"',
					);
					$policypage = $this->cObj->typoLink($this->lib->pi_getLLWrap($this, 'pi1_template.disclaimerpagetextreplacelinktext', FALSE), $conflink);

					$typolinksmade++;
					$_SESSION['policypage'] = $policypage;
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage'] = $policypage;
				}

				$_SESSION['policypage'] = $_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' .
					intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage'];

				$_SESSION['lantypoLink' . $_SESSION['activelangid']]['policypage'] = $_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' .
					intval($GLOBALS['TSFE']->fe_user->user['uid'])]['policypage'];
			}

			if(intval($this->conf['advanced.']['acceptTermsCondsOnSubmit']) > 0) {
				if (!(is_array($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]))) {
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]=array();
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['TermsCondspage'] = '';
				}

				if (!isset($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['TermsCondspage'])) {
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['TermsCondspage'] = '';
				}

				if (trim($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['TermsCondspage']) == '') {
					$conflink = array(
							// Link to current page
							'parameter' => intval($this->conf['advanced.']['acceptTermsCondsOnSubmit']),
							// Set additional parameters
							'additionalParams' => '',
							'ATagParams' => 'rel="nofollow" target="terms"',
					);
					$TermsCondspage = $this->cObj->typoLink($this->lib->pi_getLLWrap($this, 'pi1_template.termscondspagelinktext', FALSE), $conflink);
					$typolinksmade++;
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['TermsCondspage'] = $TermsCondspage;
				}

				$_SESSION['lantypoLink' . $_SESSION['activelangid']]['TermsCondspage'] = $_SESSION['lantypoLink' .
					$GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['TermsCondspage'];

			}

			if ((intval($conf['userCenter.']['userCenterPageID']) != 0) && (intval($GLOBALS['TSFE']->fe_user->user['uid']) > 0)) {
				if (!(is_array($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]))) {
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]=array();
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage'] = '';
				}

				if (!isset($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage'])) {
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage'] = '';
				}

				if (trim($_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage']) == '') {
					$conflink = array(
							// Link to current page
							'parameter' => intval($this->conf['userCenter.']['userCenterPageID']),
							// Set additional parameters
							'additionalParams' => '',
							'ATagParams' => 'rel="nofollow"',
					);
					$userCenterPage = $this->cObj->typoLink($this->lib->pi_getLLWrap($this, 'pi1_template.userCenterpagelinktext', FALSE), $conflink);
					$typolinksmade++;
					unset($_SESSION['userCenterPage']);
					$_SESSION['userCenterPage'] = $userCenterPage;
					$_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' . intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage'] = $userCenterPage;
				}

				$_SESSION['userCenterPage'] = $_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' .
					intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage'];

				$_SESSION['lantypoLink' . $_SESSION['activelangid']]['userCenterPage'] = $_SESSION['lantypoLink' . $GLOBALS['TSFE']->sys_language_uid . 'l' .
					intval($GLOBALS['TSFE']->fe_user->user['uid'])]['userCenterPage'];

			}

			//conf-checks
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

			if ($this->conf['advanced.']['commentsEditBack'] >50) {
				$this->conf['advanced.']['commentsEditBack']=50;
			}
		}

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
		if (isset($_SESSION['commentsPageIdsClean']) == FALSE) {
			$_SESSION['commentsPageIdsClean'] = array();
		}
		if (isset($_SESSION['commentsPageIdsClean'][$GLOBALS['TSFE']->id]) == FALSE) {
			$_SESSION['commentsPageIdsClean'][$GLOBALS['TSFE']->id] = '';
		}

		if (trim($_SESSION['commentsPageIdsClean'][$GLOBALS['TSFE']->id]) == '') {
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
			$typolinksmade++;
			$_SESSION['commentsPageIdsClean'][$GLOBALS['TSFE']->id] = $commentsPageIdPage;
		}

		//$this->sdebugprint .= 'typolinksmade: '.$typolinksmade.' ' .$_SESSION['policypage'].' ' .$_SESSION['userCenterPage'];
		if (!is_array($_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id])) {
			$_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id] = array();
		}

		$gettemp['toctoc_comments_pi1']= array();

		if (count($_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id]) != $this->potentialNewCommentsCHashes) {
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
				$typolinksmade++;
				$_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id][$i] = $commentsPageIdPage;

			}
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
			$this->commonObj->stop_toctoccomments_session();
			return $communitydisplaylist;
		} elseif ($communitydisplaylist==FALSE) {
			return '';
		}

		if (!$this->foreignTableName) {
			$retstr = sprintf('<div class="tx-tc-form-top-message tx-tc-required-error"><p>' .
						$this->lib->pi_getLLWrap($this, 'error.undefined.foreign.table', FALSE) . '</p></div>', $this->conf['externalPrefix']);
			$this->commonObj->stop_toctoccomments_session();
			return $retstr;
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
				if ($GLOBALS['TSFE']->sys_language_uid != 0) {
					if (intval($this->conf['advanced.']['useMultilingual']) == 1) {
						$cid_hookpp =  (1000 + (($GLOBALS['TSFE']->sys_language_uid)*1000) + $GLOBALS['TSFE']->id);
					}
				}
				$cid_hookpp= $cid_hookpp . $this->conf['storagePid'];
				$cid_hook= trim($cid_hookpp . $hookId);
			} else	{
				$cid_hook=$this->lhookId;
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

		/*
		 * Here is the CID of the Comment-Plugin that is currently being rendered.
		 */
		$_SESSION['commentListCount'] = $current_content_uid;

		if (intval($this->conf['pluginmode']) == 0) {

			if (($this->lhookTablePrefix != '') && ($isPlugin == 1)) {
				$_SESSION['commentListCount'] = $cid_hook;
				$_SESSION['commentListRecord'] = 'tt_content_' . $_SESSION['commentListCount'];
			}

			if (($this->lhookTablePrefix == '') && ($this->conf['externalPrefix'] == 'pages')) {
				$_SESSION['commentListRecord'] = 'tt_content_' . $_SESSION['commentListCount'];
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

		if (trim($_SESSION['commentListRecord']) == '') {
			$_SESSION['commentListRecord'] = 'tt_content_' . $_SESSION['commentListCount'];
		}

		$this->checktoctoccommentsuser();

		if ($this->showsdebugprint==TRUE) {
			$starttimesetJSCSS=microtime(TRUE);
		}

		$content = '';

		$this->checkJSLoc();
		$this->check_scopes();

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

		$md5url = 'p' . $GLOBALS['TSFE']->id . md5($_SESSION['curPageName']);
		if (intval($this->conf['pluginmode'])==0) {
			if ($this->getLastUserAdditionTstamp() > $this->lib->getReportDBCacheMinTimestamp(11)) {
				// if exeptionally a new user has been added since the last caching time, then the user pics need an update
				$_SESSION['AJAXimages'] = array();
				$_SESSION['AJAXOrigimages'] = array();
				$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport WHERE ReportPluginMode = 11');
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET tstamp =' . time());
			}

			if ($_SESSION['findanchorok'] == '1') {
				$clearCacheIds = $GLOBALS['TSFE']->id;
				$_SESSION['recentcommentsclearcachepage']= $GLOBALS['TSFE']->id;
				if ($_SESSION['findanchor'] != '0') {
					$this->pi_USER_INT_obj = 1;
					$_SESSION['reemptycache'][$md5url] = 2;
					$_SESSION['reemptycachepage'][$md5url] = $GLOBALS['TSFE']->id;
					$_SESSION['reemptycacheplugin'][$md5url] = $_SESSION['commentListRecord'];
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
				if ($_SESSION['reemptycache'][$md5url] >= 2) {
					$_SESSION['runMemCache'] = FALSE;
					if ($_SESSION['reemptycacheplugin'][$md5url] == $_SESSION['commentListRecord']) {
						$_SESSION['reemptycache'][$md5url] = 3;
						$this->ttclearcache($_SESSION['reemptycachepage'][$md5url], TRUE, TRUE, 'reemptycachepage');
						$this->sdebugprint .= 'Reempty cache on page ' . $GLOBALS['TSFE']->id . ' on "reemptycacheplugin" ' . $_SESSION['reemptycacheplugin'][$md5url]
						. '<br />';
						$this->pi_USER_INT_obj = 1;
					} else {

						if ($_SESSION['reemptycache'][$md5url] == 3) {
							$_SESSION['reemptycache'][$md5url] = 0;
							$_SESSION['reemptycacheplugin'][$md5url] = '';
							$_SESSION['reemptycachepage'][$md5url] = '';

						}

						if ($this->conf['advanced.']['useSessionCache']==1) {
							$domemcache = TRUE;
							$_SESSION['runMemCache'] = TRUE;
							if ((intval($this->conf['advanced.']['wallExtension']) == 0) && (intval(t3lib_div::_GP('no_cache')==0))) {
								if ($_SESSION['reemptycacheplugin'][$md5url]=='') {
									$this->sdebugprint .= 'Try using cache (reseted recent comments mode), on ' . $_SESSION['commentListRecord'] . ', L: ' .
															$_SESSION['activelang'] . ', Userid: ' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br />';
								} else {
									$this->sdebugprint .= 'Try using cache (reseted recent comments mode), waiting for ' . $_SESSION['reemptycacheplugin'][$md5url]
											. ' on ' . $_SESSION['commentListRecord'] . ', L: ' . $_SESSION['activelang'] . ', Userid: ' .
															intval($GLOBALS['TSFE']->fe_user->user['uid']) . '<br />';
								}

							}

						} else {
							$this->sdebugprint .= 'Caching is disabled<br />';
						}

					}

				} else {
					$_SESSION['reemptycache'][$md5url]=0;
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
						$tcObj = round(1000*($endtimecObj - $starttimecObj), 1);
						$tTypoLinkConfChecks = round(1000*($endtimeinit - $endtimecObj), 1);

						$tdiffstartuphookaccess=-1;
						if ($endtimehookaccess >0) {
							$tdiffstartuphookaccess = round(1000*($endtimehookaccess - $starttimehookaccess), 1);
						}

						$tdiffstartuphookcommentsupdate=-1;
						if ($endtimecommentsupdate >0) {
							$tdiffstartupcommentsupdate = round(1000*($endtimecommentsupdate - $starttimecommentsupdate), 1);
						}

						$tdiffstartupcommentListRecord = -1;
						if ($endtimesetcommentListRecord > 0) {
							$tdiffstartupcommentListRecord = round(1000*($endtimesetcommentListRecord - $starttimesetcommentListRecord), 1);
						}

						if ($typolinksmade != 0) {
							$printlinkscheck = 'TypoLinks made: '. $typolinksmade .' in ' . $tTypoLinkConfChecks . 'ms, ';
						}

						$tdiffstartupsetJSCSS = round(1000*($endtimesetJSCSS-$starttimesetJSCSS), 1);
						$startupreport = '<br /><b>Start-up, details</b> (times in ms):<br /> Conf: ' . $tdiffstartupconf . ', ' .
								'Prefixes: ' . $tdiffstartupprefixes . ', ' .
								'Sessions: ' . $tdiffstartupsessions . ', ' .
								'TYPO3 Metamodel: ' . $tdiffstartupTYPO3metamodel . '<br />(' .
								'Check CSSLoc: ' . $tdifftimeCSSLoc . ', ' .
								'Init: ' . $tdiffstartupinit . '<br /><small>(Check PluginID: ' . $tcObj . ', ' . $printlinkscheck . $this->sdebuginitprint . '<br />';

						if ($tdiffstartuphookaccess != -1) {
							$startupreport .= 'Hookmode: ' . $tdiffstartuphookaccess . ', ';
						}

						if ($tdiffstartuphookcommentsupdate != -1) {
							$startupreport .= 'Updatemode: ' . $tdiffstartuphookcommentsupdate . ', ';
						}

						if ($tdiffstartupcommentListRecord != -1) {
							$startupreport .= 'Setup PluginID: ' . $tdiffstartupcommentListRecord;
						}

						$startupreport .= ')<br />Check JS: ' . $tdiffstartupsetJSCSS . '<br />';
					}

					$starttimedebuglib=microtime(TRUE);
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

			$whynocache='';
			if ($domemcache == TRUE) {

				if (isset($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
						$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url])) {
					if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]>0) {
						if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url] > $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
									if ($this->conf['sessionCompressionLevel'] > 0) {
										if ($this->canZip == TRUE) {
											$outml = gzdecode($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
												$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url]);

										} else {
											$outml = gzuncompress($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
												$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url]);
										}
									} else {
										$outml = $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
													$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url];
									}
						} else {
							if ($this->showsdebugprint) {
								if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
									$this->sdebugprint .= '<b>' . date('H:i:s') . '</b>: Cache dropped, last cachetime ' .
															date('H:i:s', $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] .
															'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]) .
															' older than  ' . date( 'H:i:s', $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) .
														', cid: ' .$_SESSION['commentListRecord'] .'<br />';
									$whynocache='was dropped';
								}

							}

							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]=0;
							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url]='';

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

				if (trim($outml) == '') {
					if ($this->showsdebugprint) {
						if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
							$this->sdebugprint .= '<b>No Cache present</b> (Cache ' . $whynocache . ')<br />';
						}

					}

					$domemcache=FALSE;
				} else {

					if ($_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url] <
							$this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
						if ($this->showsdebugprint) {
							if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
								$this->sdebugprint .= '<b>Cache dropped</b> for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] .
													', Userid: ' . intval($this->feuserid) .'<br />';
							}

						}

						if ($this->getLastUserAdditionTstamp() > $_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] .
								'U' . $GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]) {
							// if exeptionally a new user has been added since the last caching time, then the user pics need an update
							$_SESSION['AJAXimages'] = array();
							$_SESSION['AJAXOrigimages'] = array();
							$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport WHERE ReportPluginMode = 11');
							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET tstamp =' . time());
						}

						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]=0;
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url]='';

						$domemcache=FALSE;
					}

				}

			}

			if ($_SESSION['confchk'][$md5url]['mcp' . $_SESSION['commentListRecord']] != 'mcp' . md5(serialize($this->conf))) {
				// Admin made change in TS-Setup, here just clear the cache if not already done
				$_SESSION['confchk'][$md5url]['mcp' . $_SESSION['commentListRecord']] = 'mcp' . md5(serialize($this->conf));
				//unset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]);
				if ($domemcache==TRUE) {
					if ($this->showsdebugprint) {
						if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
							$this->sdebugprint .= '<b>Config-Change detected - cache dropped</b> for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] .
													', Userid: ' . intval($this->feuserid) .'<br />';
						}
					}
				}
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
				$VirginUserNoMemcache = FALSE;
				if (($this->lib->isVirginUser($_SESSION['commentListRecord']) == TRUE) || (intval($this->conf['sharing.']['useOnlySharing']) == 1)) {
					$ReportUser = 0;
					$md5PluginId = md5(serialize($this->conf) . $GLOBALS['TSFE']->lang . $this->ref);
					$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);

					if ($dbCache == '') {
						if ($this->showsdebugprint) {
							if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
								$this->sdebugprint .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' No DB-Cache - filling cache</div>';
							}

						}

						$outml=$this->lib->maincomments($this->ref, $this->conf, FALSE, $_SESSION['commentsPageId'], $this->feuserid, 'commentdisplay', $this, $this->piVars);
						$this->lib->setReportDBCache($this->conf, 0, $ReportUser, $outml, $md5PluginId, $_SESSION['commentListRecord']);

					} else {
						if ($this->showsdebugprint) {
							if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
								$this->sdebugprint .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' Using DB-Cache</div>';
							}

						}

						$outml= $dbCache;
					}

					$VirginUserNoMemcache = TRUE;
				} else {
					$ReportUser = $this->feuserid;
					if ($this->feuserid != 0) {
						$md5PluginId = md5(serialize($this->conf) . $GLOBALS['TSFE']->lang . $this->ref);
						$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);

						if ($dbCache == '') {
							if ($this->showsdebugprint) {
								if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
									$this->sdebugprint .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' No DB-Cache - filling cache for userid '.$this->feuserid.'</div>';
								}

							}

							$outml=$this->lib->maincomments($this->ref, $this->conf, FALSE, $_SESSION['commentsPageId'], $this->feuserid, 'commentdisplay', $this, $this->piVars);
							$this->lib->setReportDBCache($this->conf, 0, $ReportUser, $outml, $md5PluginId, $_SESSION['commentListRecord']);

						} else {
							if ($this->showsdebugprint) {
								if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
									$this->sdebugprint .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' Using DB-Cache for userid '.$this->feuserid.'</div>';
								}

							}

							$outml= $dbCache;
						}

					} else {
						$outml=$this->lib->maincomments($this->ref, $this->conf, FALSE, $_SESSION['commentsPageId'], $this->feuserid, 'commentdisplay', $this, $this->piVars);
					}

				}

				$sharrrejsfile = $this->sharrrejs();

				$outml = $outml . $sharrrejsfile;
				if ($_SESSION['doChangePasswordForm'] == 2) {
					$outml .= '<div id="tx-tc-cpwf" class="tx-tc-nodisp"></div>';
					$_SESSION['doChangePasswordForm'] = 1;
				}

				$outmlmemcache=$timereportlast . $this->sdebugprint . $outml;
				if (intval($this->conf['advanced.']['wallExtension']) == 0) {
					if ((intval(t3lib_div::_GP('no_cache'))==0) && ($_SESSION['findanchorok'] != '1')) {
						if ($VirginUserNoMemcache == FALSE) {
							$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]=round(microtime(TRUE), 0);
							if ($this->conf['sessionCompressionLevel'] > 0) {
								if ($this->canZip == TRUE) {
									$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
											$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url] = gzencode($outml, $this->conf['sessionCompressionLevel']);
								} else {
									$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
										$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url] = gzcompress($outml, $this->conf['sessionCompressionLevel']);
								}

							} else {
									$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
											$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url]=$outml;
							}
						}

					} else {
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url]=0;
						$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url]='';
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

					$timereport='<div class="tx-tc-debug"><b>' . date('H:i:s') . '</b>: Start-up: ' . intval($tdiffstartup) . ' ms, Lib: ' . intval($tdifflib) . ' ms, <b>Total: ' .
								intval($tdifftotal) . ' ms (milliseconds)</b>' . $userintstate . ' ' . $startupreport.'</div>';
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

			$_SESSION['activeBoxmodel'] = $this->conf['theme.']['selectedBoxmodel'];
			$this->commonObj->stop_toctoccomments_session();
			$outmlmemcache = $this->w3cIzer($outmlmemcache);
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

			$ReportUser = $this->getReportUser($this->conf['pluginmode']);
			$md5PluginId = md5(serialize($this->conf) . $GLOBALS['TSFE']->lang . $GLOBALS['TSFE']->id);
			$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);
			if ($dbCache == '') {
				if (intval($GLOBALS['TSFE']->fe_user->user['uid']) != 0) {
					$dbCache = $this->lib->getReportDBCache($md5PluginId, intval($GLOBALS['TSFE']->fe_user->user['uid']));
				}
			}

			if ($dbCache == '') {
				$this->reprtUserByID = FALSE;
				$ReportData = $this->lib->getRecentComments($this, $this->conf, $this->feuserid);
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$timereportlast .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' No DB-Cache - filling cache</div>';
					}

				}

				$outml = $timereportlast . $ReportData;
				if (($this->reprtUserByID == FALSE) || ($ReportUser == 0)) {
					$this->lib->setReportDBCache($this->conf, $this->conf['pluginmode'], $ReportUser, $ReportData, $md5PluginId);
				} else {
					$this->lib->setReportDBCache($this->conf, $this->conf['pluginmode'], intval($GLOBALS['TSFE']->fe_user->user['uid']),
							$ReportData, $md5PluginId);
				}

			} else {
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$timereportlast.= '<div class="tx-tc-debug">' . $this->conf['pluginmode'] . ' Using DB-Cache</div>';
					}

				}

				$outml= $timereportlast . $dbCache;
			}

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
					$timereport='<div class="tx-tc-debug"><b>Total: ' .
								intval($tdifftotal) . ' ms (milliseconds)</b>' . $userintstate . ' ' . $startupreport.'</div>';
				}

			}

			$_SESSION['edgeTime'] = microtime(TRUE);
			$this->commonObj->stop_toctoccomments_session();
			$outml = $this->w3cIzer($outml);
			return $outml . $timereport;

		} elseif ($this->conf['pluginmode'] == 2) {
			$content='';
			$this->pi_setPiVarDefaults();
			$this->pi_USER_INT_obj = 1;
			$_SESSION['edgeTime'] = microtime(TRUE);
			$retstr =$this->lib->mainReport($content, $this->conf, $this, $this->piVars);
			$this->commonObj->stop_toctoccomments_session();
			$retstr = $this->w3cIzer($retstr);
			return $retstr;

		} elseif (($this->conf['pluginmode'] == 3) || ($this->conf['pluginmode'] == 4)) {
			if (!$this->showsdebugprint) {
				$timereportlast='';
			} elseif ($this->sdebugprintuser!=intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$timereportlast='';
			}

			$timereport='';
			$starttimedebuglib=microtime(TRUE);

			$this->pi_USER_INT_obj = 1;
			$_SESSION['edgeTime'] = microtime(TRUE);

			$ReportUser = $this->getReportUser($this->conf['pluginmode']);
			$md5PluginId = md5(serialize($this->conf) . $GLOBALS['TSFE']->lang . $GLOBALS['TSFE']->id);
			$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);
			if ($dbCache == '') {
				if (intval($GLOBALS['TSFE']->fe_user->user['uid']) != 0) {
					$dbCache = $this->lib->getReportDBCache($md5PluginId, intval($GLOBALS['TSFE']->fe_user->user['uid']));

				}

			}

			if ($dbCache == '') {
				$this->reprtUserByID = FALSE;
				$retstr = $this->lib->showtopRatings($this->conf, $this);
				$loctopRatingsMode = '';
				if (($this->conf['pluginmode'] == 4) && ($this->conf['topRatings.']['topRatingsMode'] == 5)) {
					$loctopRatingsMode = 1;
				}

				if (($this->reprtUserByID == FALSE) || ($ReportUser == 0)) {
					$this->lib->setReportDBCache($this->conf, $this->conf['pluginmode'].$loctopRatingsMode, $ReportUser, $retstr, $md5PluginId);
				} else {
					$this->lib->setReportDBCache($this->conf, $this->conf['pluginmode'].$loctopRatingsMode, intval($GLOBALS['TSFE']->fe_user->user['uid']),
							$retstr, $md5PluginId);
				}

				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$retstr .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode'] . $loctopRatingsMode) . ' No DB-Cache - filling cache</div>';
					}

				}

			} else {
				$retstr= $dbCache;
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$retstr .= '<div class="tx-tc-debug">' . $this->conf['pluginmode'] . $loctopRatingsMode . ' Using DB-Cache</div>';
					}

				}
			}
			$startreport='';
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
					$startreport='<div class="tx-tc-debug"><b>' . date('H:i:s') . '</b></div>';
					$timereport='<div class="tx-tc-debug"><b>Total: ' .
							intval($tdifftotal) . ' ms</b>' . $userintstate . ' ' . $startupreport.'</div>';
				}

			}

			$this->commonObj->stop_toctoccomments_session();
			$retstr = $this->w3cIzer($retstr);
			return $startreport . $retstr . $timereport;

		} elseif (($this->conf['pluginmode'] == 5)) {
			$this->pi_USER_INT_obj = 1;
			$_SESSION['edgeTime'] = microtime(TRUE);

			$retstr = $this->tclogincard;
			if ($_SESSION['doChangePasswordForm'] == 2) {
				$retstr .= $this->tcchangepasswordcard;
				$_SESSION['doChangePasswordForm']=0;
			}

			$this->commonObj->stop_toctoccomments_session();
			$retstr = $this->w3cIzer($retstr);
			return $retstr;

		} elseif (($this->conf['pluginmode'] == 6)) {
			if (!$this->showsdebugprint) {
				$timereportlast='';
			} elseif ($this->sdebugprintuser!=intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$timereportlast='';
			}

			$timereport='';
			$starttimedebuglib=microtime(TRUE);

			$this->pi_USER_INT_obj = 1;
			$_SESSION['edgeTime'] = microtime(TRUE);

			$ReportUser = $this->getReportUser($this->conf['pluginmode']);
			$md5PluginId = md5(serialize($this->conf) . $GLOBALS['TSFE']->lang . $GLOBALS['TSFE']->id);
			$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);
			if ($dbCache == '') {
				$retstr = $this->lib->showuserCenter($this->conf, $this);
				$this->lib->setReportDBCache($this->conf, $this->conf['pluginmode'], $ReportUser, $retstr, $md5PluginId);
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$retstr .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' No DB-Cache - filling cache</div>';
					}

				}

			} else {
				$retstr= $dbCache;
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$retstr .= '<div class="tx-tc-debug">' . $this->conf['pluginmode'] . ' Using DB-Cache</div>';
					}

				}

			}
			$startreport='';
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
					$startreport='<div class="tx-tc-debug"><b>' . date('H:i:s') . '</b></div>';
					$timereport='<div class="tx-tc-debug"><b>Total: ' .
							intval($tdifftotal) . ' ms (milliseconds)</b>' . $userintstate . ' ' . $startupreport.'</div>';
				}

			}

			$this->commonObj->stop_toctoccomments_session();
			$retstr = $this->w3cIzer($retstr);
			return $startreport . $retstr . $timereport;

		}  elseif (($this->conf['pluginmode'] == 7)) {
			$_SESSION['activelang'] =$GLOBALS['TSFE']->lang;
			$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;
			$this->pi_USER_INT_obj = 1;
			$_SESSION['edgeTime'] = microtime(TRUE);
			$retstr = $this->lib->showCommentsSearch($this->conf, $this, FALSE, '');
			$this->commonObj->stop_toctoccomments_session();
			$retstr = $this->w3cIzer($retstr);
			return $retstr;

		} elseif (($this->conf['pluginmode'] == 8)) {

			if (!$this->showsdebugprint) {
				$timereportlast='';
			} elseif ($this->sdebugprintuser!=intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$timereportlast='';
			}

			$timereport='';
			$starttimedebuglib=microtime(TRUE);

			$_SESSION['activelang'] =$GLOBALS['TSFE']->lang;
			$_SESSION['activelangid'] =$GLOBALS['TSFE']->sys_language_uid;
			$this->pi_USER_INT_obj = 1;
			$_SESSION['edgeTime'] = microtime(TRUE);
			$ReportUser = $this->getReportUser($this->conf['pluginmode']);
			$md5PluginId = md5(serialize($this->conf) . $GLOBALS['TSFE']->lang . $GLOBALS['TSFE']->id);
			$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);
			if ($dbCache == '') {
				$retstr = $this->lib->showtopSharings($this->conf, $this);
				$this->lib->setReportDBCache($this->conf, $this->conf['pluginmode'], $ReportUser, $retstr, $md5PluginId);
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$retstr .= '<div class="tx-tc-debug">' . intval($this->conf['pluginmode']) . ' No DB-Cache - filling cache</div>';
					}

				}

			} else {
				$retstr= $dbCache;
				if ($this->showsdebugprint) {
					if ($this->sdebugprintuser==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
						$retstr .= '<div class="tx-tc-debug">' . $this->conf['pluginmode'] . ' Using DB-Cache</div>';
					}

				}
			}

			$startreport='';
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
					$startreport='<div class="tx-tc-debug"><b>' . date('H:i:s') . '</b></div>';
					$timereport='<div class="tx-tc-debug"><b>Total: ' .
							intval($tdifftotal) . ' ms (milliseconds)</b>' . $userintstate . ' ' . $startupreport.'</div>';
				}

			}

			$this->commonObj->stop_toctoccomments_session();
			$retstr = $this->w3cIzer($retstr);
			return $startreport . $retstr . $timereport;
		} else {
			$this->commonObj->stop_toctoccomments_session();
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
		$this->themeLESSfile = '';
		$this->themeCSS = '';

		$filenametheme='theme.less';

		$dirsep=DIRECTORY_SEPARATOR;

		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
		if (trim($this->conf['theme.']['selectedTheme']) == '') {
			$this->conf['theme.']['selectedTheme'] = 'default';
		}

		$txdirnametheme= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
						'res/css/themes/' . $this->conf['theme.']['selectedTheme'] . '/' );
		$filenametheme=$txdirnametheme . $filenametheme;

		if (strlen($this->conf['theme.']['themeFontFamily']) < 4) {
			$this->conf['theme.']['themeFontFamily']='';
		}

		// get_filedate of LESS-file $filenametheme for color variables of the theme
		if (file_exists($filenametheme)) {
			$filetime = @filemtime($filenametheme);
			if ($this->newestLessFileTime < $filetime) {
				$this->newestLessFileTime = $filetime;
			}
			$this->themeLESSfile = $filenametheme;
		}
		$this->themeCSS ='';

		$this->conf['theme.']['borderColor']='d8d8d8';
		$this->conf['theme.']['shareborderColor1']='adaeaf';
		$this->conf['theme.']['shareborderColor2']='a4a5a7';
		$this->conf['theme.']['shareCountborderColor']='e3e3e3';
		$this->conf['theme.']['shareBackgroundColor']='ffffff';

		return '';

	}

	/**
	 * Checks if the CSS-File for config-dependent values (UserImageSize) exists and if not creates it.
	 *
	 * @return	$changedconfig		TRUE if new file has been written
	 */
	protected function checkCSSLoc() {
		$this->LESSVars = array(
				'var' => array(),
				'val' => array(),
		);

		$this->LESS_i = 0;

		$this->LESSVars['comment'][$this->LESS_i] = '// "koogled" boxmodels behave different and there will be some CSS if the boxmodel is koogled' . "\n" .
					'// when the name of the boxmodel contains "koogle" the boxmodel is forced to be koogled'. "\n" .
		'// you can setup koogled-mode with setup option theme.selectedBoxmodelkoogled = 1'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@selectedBoxmodelkoogled';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['theme.']['selectedBoxmodelkoogled'] == 1 ? 'true' : 'false';
		$this->LESS_i++;

		$themeopacity = 1;
		$tapadding='1';
		if ($this->conf['advanced.']['useEmoji']>0) {
			$tapadding=21+intval(intval($this->conf['theme.']['boxmodelSpacing'])/2);
		}
		$taheight = (intval($this->conf['theme.']['boxmodelTextareaLineHeight'])*intval($this->conf['theme.']['boxmodelTextareaNbrLines']));

		$this->LESSVars['comment'][$this->LESS_i] = '// padding of the textarea in commenting forms' . "\n" .
				'// it is 1px, but it is different if advanced.useEmoji != 0'. "\n" .
				'// then it depends on theme.boxmodelSpacing'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@tapadding';
		$this->LESSVars['val'][$this->LESS_i] = $tapadding . 'px';
		$this->LESS_i++;
		$this->LESSVars['comment'][$this->LESS_i] = '// height of the textarea in commenting forms' . "\n" .
				'// theme.boxmodelTextareaLineHeight*theme.boxmodelTextareaNbrLines'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@taheight';
		$this->LESSVars['val'][$this->LESS_i] = $taheight . 'px';
		$this->LESS_i++;

		if ($this->conf['theme.']['boxmodelLevelIndent'] == 1) {
			$levelindent = $this->conf['UserImageSize']+(3*round($this->conf['theme.']['boxmodelSpacing']/2));
		} elseif ($this->conf['theme.']['boxmodelLevelIndent'] == 3) {
			$levelindent = round($this->conf['UserImageSize']/3)+(3*round($this->conf['theme.']['boxmodelSpacing']/2));
		} elseif ($this->conf['theme.']['boxmodelLevelIndent'] == 2) {
			$levelindent = round($this->conf['UserImageSize']/2)+(3*round($this->conf['theme.']['boxmodelSpacing']/2));
		} else {
			$levelindent = round($this->conf['theme.']['boxmodelSpacing']);
		}

		$margincheck = 0;
		if (intval($this->conf['theme.']['boxmodelLineHeight']) > 16) {
			$margincheck = intval(0.9*(intval($this->conf['theme.']['boxmodelLineHeight']) - 16));
		}

		$sortind=0;
		if (intval($this->conf['theme.']['boxmodelLineHeight']) > 17) {
			if ($this->conf['theme.']['themeVersion'] !=2) {
				$sortind = intval((intval($this->conf['theme.']['boxmodelLineHeight']) - 16)/2);
			} else {
				$sortind = 0;
			}

		}

		$boxmodelLineHeightorReviewlineHeight = intval($this->conf['theme.']['boxmodelLineHeight']);
		if (intval($this->conf['ratings.']['reviewImageWidth']) > $boxmodelLineHeightorReviewlineHeight) {
			$boxmodelLineHeightorReviewlineHeight = intval($this->conf['ratings.']['reviewImageWidth']);
		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  theme.boxmodelLabelInputPreserve' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelLabelInputPreserve';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['theme.']['boxmodelLabelInputPreserve'] == 1 ? 'true' : 'false';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  theme.boxmodelLineHeight' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelLineHeight';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['theme.']['boxmodelLineHeight']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  theme.boxmodelSpacing' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelSpacing';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['theme.']['boxmodelSpacing']). 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// top-margin of checkbox is different from 0 and grows when theme.boxmodelLineHeight > 16' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@topMarginCheckBox';
		$this->LESSVars['val'][$this->LESS_i] = $margincheck . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// line height in reviews containing stars is normally theme.boxmodelLineHeight'. "\n" .
		                                       '// when ratings.reviewImageWidth > theme.boxmodelLineHeight then ratings.reviewImageWidth'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelReviewlineHeight';
		$this->LESSVars['val'][$this->LESS_i] = $boxmodelLineHeightorReviewlineHeight . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  topRatings.topRatingsImageSize' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@topRatingsImageSize';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['topRatings.']['topratingsimagesize']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// When Facebook sharing is available then 4px, else 0' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@leftShareFb';
		$this->LESSVars['val'][$this->LESS_i] = $this->makesharingcss(FALSE) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// if theme.boxmodelLevelIndent between 1,2,3: then this is true' . "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@doScaleBecauseOfIndent';
		$this->LESSVars['val'][$this->LESS_i] = (($this->conf['theme.']['boxmodelLevelIndent'] > 0) && ($this->conf['theme.']['boxmodelLevelIndent']<4)) ? 'true' : 'false';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageSize'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@userImageSize';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['UserImageSize']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageSizeInForm'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@userImageSizeInForm';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['UserImageSizeInForm']) . 'px';
		$this->LESS_i++;

		$arrUserImageCSS = explode(',', $this->conf['theme.']['UserImageCSSGrayScale']);
		$strfilter = '50%';
		if (count($arrUserImageCSS) == 2) {
			$filterAmount = str_replace('%', '', $arrUserImageCSS[0]);
			if (($filterAmount != $arrUserImageCSS[0]) && (intval($filterAmount) >= 0) && (intval($filterAmount) <= 100)) {
				$strfilter = $arrUserImageCSS[0];
			}
		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageCSSGrayScale'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@UserImageCSSGrayScale';
		$this->LESSVars['val'][$this->LESS_i] = $strfilter;
		$this->LESS_i++;

		$strfilter = '0%';
		if (count($arrUserImageCSS) == 2) {
			$filterAmount = str_replace('%', '', $arrUserImageCSS[1]);
			if (($filterAmount != $arrUserImageCSS[1]) && (intval($filterAmount) >= 0) && (intval($filterAmount) <= 100)) {
				$strfilter = $arrUserImageCSS[1];
			}

		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageCSSGrayScaleHover'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@UserImageCSSGrayScaleHover';
		$this->LESSVars['val'][$this->LESS_i] = $strfilter;
		$this->LESS_i++;

		$arrUserImageCSS = explode(',', $this->conf['theme.']['UserImageCSSBlur']);
		$strfilter = '0px';
		if (count($arrUserImageCSS) == 2) {
			$filterAmount = str_replace('px', '', $arrUserImageCSS[0]);
			if (($filterAmount != $arrUserImageCSS[0]) && (intval($filterAmount) >= 0) && (intval($filterAmount) <= 100)) {
				$strfilter = $arrUserImageCSS[0];
			}

		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageCSSBlur'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@UserImageCSSBlur';
		$this->LESSVars['val'][$this->LESS_i] = $strfilter;
		$this->LESS_i++;

		$strfilter = '0px';

		if (count($arrUserImageCSS) == 2) {
			$filterAmount = str_replace('px', '', $arrUserImageCSS[1]);
			if (($filterAmount != $arrUserImageCSS[1]) && (intval($filterAmount) >= 0) && (intval($filterAmount) <= 100)) {
				$strfilter = $arrUserImageCSS[1];
			}

		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageCSSBlurHover'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@UserImageCSSBlurHover';
		$this->LESSVars['val'][$this->LESS_i] = $strfilter;
		$this->LESS_i++;

		$arrUserImageCSS = explode(',', $this->conf['theme.']['UserImageCSSSepia']);
		$strfilter = '0%';

		if (count($arrUserImageCSS) == 2) {
			$filterAmount = str_replace('%', '', $arrUserImageCSS[0]);
			if (($filterAmount != $arrUserImageCSS[0]) && (intval($filterAmount) >= 0) && (intval($filterAmount) <= 100)) {
				$strfilter = $arrUserImageCSS[0];
			}

		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageCSSSepia'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@UserImageCSSSepia';
		$this->LESSVars['val'][$this->LESS_i] = $strfilter;
		$this->LESS_i++;

		$strfilter = '0%';
		if (count($arrUserImageCSS) == 2) {
			$filterAmount = str_replace('%', '', $arrUserImageCSS[1]);
			if (($filterAmount != $arrUserImageCSS[1]) && (intval($filterAmount) >= 0) && (intval($filterAmount) <= 100)) {
				$strfilter = $arrUserImageCSS[1];
			}

		}

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  UserImageCSSSepiaHover'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@UserImageCSSSepiaHover';
		$this->LESSVars['val'][$this->LESS_i] = $strfilter;
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  theme.boxmodelLevelIndent no px value'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelLevelIndent';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['theme.']['boxmodelLevelIndent']);
		// no px
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  theme.boxmodelLabelWidth'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelLabelWidth';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['theme.']['boxmodelLabelWidth']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  theme.boxmodelTextareaLineHeight'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelTextareaLineHeight';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['theme.']['boxmodelTextareaLineHeight']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// indent of commenting boxes when there is a hierarchy'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@levelIndent';
		$this->LESSVars['val'][$this->LESS_i] = $levelindent . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// when useUserImage > 0 then true'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@useUserImage';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['useUserImage'] > 0 ? 'true' : 'false';
		$this->LESS_i++;

		$marginpiccomment = 0;

		if ($this->conf['theme.']['selectedBoxmodelkoogled']==1) {
			$marginpiccomment = 15;
			$themeopacity = 0.5;
		}

		if ($this->conf['useUserImage']!=1) {
			$useUserImageSize = 0;
			$useUserImageSizeInForm = 0;
			$ctpicvisibility = 'hidden';
			$marginpiccomment=-intval($this->conf['theme.']['boxmodelSpacing']);
		}

		$vidmaxwidth=round(intval($this->conf['attachments.']['webpagePreviewHeight'])*(4/3), 0);

		$vidmaxwidth=round(intval($this->conf['attachments.']['webpagePreviewHeight'])*(4/3), 0);

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  attachments.webpagePreviewHeight'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@webpagePreviewHeight';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['attachments.']['webpagePreviewHeight']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS:  attachments.webpagePreviewHeight*(4/3)'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@vidMaxWidth';
		$this->LESSVars['val'][$this->LESS_i] = $vidmaxwidth . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: theme.usethemeFontFamilyForPlugin'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@usethemeFontFamilyForPlugin';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['theme.']['usethemeFontFamilyForPlugin'] == 1 ? 'true' : 'false';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: theme.themeFontFamily'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@themeFontFamily';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['theme.']['themeFontFamily'];
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// needed to calculated the margin right of user pic to comment in list'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@marginPicComment';
		$this->LESSVars['val'][$this->LESS_i] = $marginpiccomment . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: attachments.picUploadMaxDimWebpage'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@picUploadMaxDimWebpage';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['attachments.']['picUploadMaxDimWebpage']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: theme.responsiveSteps, 1st step'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@screen-sm';
		$this->LESSVars['val'][$this->LESS_i] = $this->arrResponsiveSteps[0] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: theme.responsiveSteps, 2nd step'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@screen-md';
		$this->LESSVars['val'][$this->LESS_i] = $this->arrResponsiveSteps[1] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// responsiveSteps, 3nd step from attachments.picUploadMaxDimX+200'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@screen-lg';
		$this->LESSVars['val'][$this->LESS_i] = $this->arrResponsiveSteps[2] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: attachments.picUploadMaxDimYWebpage'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@picUploadMaxDimYWebpage';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['attachments.']['picUploadMaxDimYWebpage']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: attachments.picUploadMaxDimX'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@picUploadMaxDimX';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['attachments.']['picUploadMaxDimX']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: attachments.picUploadMaxDimY'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@picUploadMaxDimY';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['attachments.']['picUploadMaxDimY']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: topRatings.topratingsnumberwidth'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@topRatingsNumberWidth';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['topRatings.']['topratingsnumberwidth']) . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// Opacity used for koogled: 0.5 else 1'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@themeOpacity';
		$this->LESSVars['val'][$this->LESS_i] = $themeopacity;
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// top margin of sorticon in menu'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@topMarginSortIndicator';
		$this->LESSVars['val'][$this->LESS_i] = $sortind . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// if ratings.useLikeDislikeStyle = 1 then true'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@useLikeDislikeStyleOne';
		$this->LESSVars['val'][$this->LESS_i] = intval($this->conf['ratings.']['useLikeDislikeStyle']) == 1 ? 'true' : 'false';
		$this->LESS_i++;

		return '';
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$CSSmode: ...
	 * @return	[type]		...
	 */
	protected function makesharingcss($CSSmode = TRUE) {
		$retcss = '';
		$leftpxfb=0;
		if ($this->conf['sharing.']['sharingNoCalculatedCSS'] == 0) {

			if ($this->conf['sharing.']['dontUseSharingFacebook'] !=1 ) {
				$leftpxfb = 4;
			}

		}
		if ($CSSmode) {
			return $retcss;
		} else {
			return $leftpxfb;
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
		// exts without table and string identiers
		if (intval($this->externalUid)==0) {
			$this->externalUid = (is_array($ar) ? $ar[$this->showUidParam] : FALSE);
			if (trim($this->externalUid) != '') {
				$this->externalUid = str_replace('-', '7g8', $this->externalUid) . '@page' . $GLOBALS['TSFE']->id;
				$this->externalUid = $this->getExternalUidShortId();
				$this->externalUidString = $this->externalUid;
				$this->foreignTableName = $this->conf['externalPrefix'] . '6g9' . $this->showUidParam;

			}

		}

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
			$this->sdebuginitprint.='InitprefixToTableMap: ' . round(1000*($endtimedebug - $starttimedebug), 1) .', ';
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
		if (!isset($this->cObj)) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}
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
					$_SESSION['AJAXOrigimages'] = array();
					$_SESSION['DefaultUserImage'] = array();
				}

				$_SESSION['selectedTheme'] = $this->conf['theme.']['selectedTheme'];
				$this->processcssandjsfiles = TRUE;

				if ($this->clientissearchengine == FALSE) {
					$ckeckresult=$this->checkCSSTheme();
					if ($ckeckresult!='') {
						return $ckeckresult;
					}

					$this->checkandload_emolikes();
					$this->checkCSSLoc();
					$this->boxmodel();
				}

				if ($this->showsdebugprint==TRUE) {
					$endtimedebug2=microtime(TRUE);
					$this->sdebuginitprint.='Boxmodel: ' . round(1000*($endtimedebug2 - $starttimedebug2), 1) .', ';
					$starttimedebug2=microtime(TRUE);
				}

				if ($this->conf['ratings.']['additionalCSS']) {
					$subSubPart = $this->cObj->getSubpart($this->templateCode, '###ADDITIONAL_CSS###');
					$subParts['###ADDITIONAL_CSS###'] = trim($this->cObj->substituteMarker($subSubPart,
							'###CSS_FILE###', $GLOBALS['TSFE']->tmpl->getFileName($this->conf['ratings.']['additionalCSS'])));
				} else {
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

				if (trim($this->conf['theme.']['selectedTheme']) == '') {
					$this->conf['theme.']['selectedTheme'] = 'default';
				}

				if (!is_array($_SESSION['colourcodesemo'])) {
					$_SESSION['colourcodesemo'] = array();
				}

				$checkedcolourcodesemo = '';
				if ($this->clientissearchengine == FALSE) {
					if (!isset($_SESSION['colourcodesemo'][$this->conf['theme.']['selectedTheme']])) {
						$colourcodesemo = '';
						if ($this->conf['ratings.']['emoLike'] ==1 ) {
							$filenametheme='theme.less';
							$dirsep=DIRECTORY_SEPARATOR;
							$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
							$txdirnametheme= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
									'res/css/themes/' . $this->conf['theme.']['selectedTheme'] . '/' );
							$filenametheme=$txdirnametheme . $filenametheme;
							$contentlesscolors = file_get_contents($this->themeLESSfile);
							$colarr =  explode('@linkbox-color-dislike-active: ', $contentlesscolors);
							$colarr2 = explode(';', $colarr[1]);
							$colarra =  explode('@linkbox-color-active: ', $contentlesscolors);
							$colarra2 = explode(';', $colarra[1]);
							$colourcodesemo = 'colourcodeemo[0] = "'.trim($colarra2[0]).'";
			colourcodeemo[1] = "'.trim($colarra2[0]).'";
			colourcodeemo[7] = "'.trim($colarr2[0]).'";';

							$strsql='SELECT uid AS emolikeid, emolike_sort, emolike_colorcode
										FROM tx_toctoc_comments_emolike
										WHERE emolike_colorcode != "" AND emolike_setfolder = "'.$this->conf['ratings.']['emoLikeSet'] .'"
										AND deleted = 0
										ORDER BY emolike_sort';
							$resultl= $GLOBALS['TYPO3_DB']->sql_query($strsql);
							while ($likerows = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultl)) {
								$colourcodesemo .= '
			colourcodeemo['.$likerows['emolike_sort'] .'] = "'.$likerows['emolike_colorcode'].'";';
							}
							$checkedcolourcodesemo = ' and emoLike-colorcodes ';
						}

						$_SESSION['colourcodesemo'][$this->conf['theme.']['selectedTheme']] = $colourcodesemo;
					} else {
						$colourcodesemo = $_SESSION['colourcodesemo'][$this->conf['theme.']['selectedTheme']];
					}

				}

				if ($this->showsdebugprint==TRUE) {
					$starttimedebug21=microtime(TRUE);
					$this->sdebuginitprint.='Check new comments' . $checkedcolourcodesemo . ': ' . round(1000*($starttimedebug21 - $starttimedebug2), 1) .', ';
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
				$locchangePasswordFormhtml = '	var tcpasswordcard ="";
';

				$rsajsloc = 'resources';
				if (version_compare(TYPO3_version, '6.3', '>')) {
					$rsajsloc = 'Resources/Public/JavaScript';
				}

				if (version_compare(TYPO3_version, '6.1', '>')) {
					$rsajsenc = '/FrontendLoginFormRsaEncryption.js';
					$rsascript='<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/js' . $rsajsenc . '"></script>';
				} else {
					$rsajsenc = '/rsaauth_min.js';
					$rsascript='<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . $rsajsenc . '"></script>';
				}

				$plsUseRSA = 0;

				if (version_compare(TYPO3_version, '7.4', '<')) {
					$rsajsstr = '<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/jsbn.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/prng4.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/rng.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/rsa.js"></script>
						<script type="text/javascript" src="'. $this->locationHeaderUrlsubDir(). 'typo3/sysext/rsaauth/' . $rsajsloc . '/jsbn/base64.js"></script>
						' . $rsascript . '';
				} else {
					$rsajsstr = $rsascript . '';
					if ((t3lib_extMgm::isLoaded('rsaauth')) && (t3lib_extMgm::isLoaded('saltedpasswords')) &&
							($GLOBALS['TYPO3_CONF_VARS']['FE']['loginSecurityLevel'] == 'rsa')) {
						$plsUseRSA = 1;
					}

				}

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
					$locLoginFormhtml = '	var tclogincard =\'' . $locLoginFormhtml . '\';
';
				}

				$jscontent = ' var errCommentRequiredLength = ' . intval($this->conf['minCommentLength']) . ';' . "\n";
				$jscontent .= '	var errSearchRequiredLength = ' . intval($this->conf['search.']['minSearchTermLength']) . ';' . "\n";
				$jscontent .= '	var maxCommentLength = ' . intval($this->conf['maxCommentLength']) . ';' . "\n";
				$jscontent .= '	var selectedTheme = "' . $this->conf['theme.']['selectedTheme'] . '";' . "\n";
				$jscontent .= '	var boxmodelTextareaAreaTotalHeight = ' . intval($this->boxmodelTextareaAreaTotalHeight) . ';' . "\n";
				$jscontent .= '	var plsUseRSA = ' . $plsUseRSA . ';' . "\n";
				$jscontent .= '	var boxmodelTextareaHeight = ' . intval($this->boxmodelTextareaHeight) . ';' . "\n";
				if ($this->conf['theme.']['boxmodelLabelInputPreserve']==0) {
					$jscontent .= '	var boxmodelLabelWidth = ' . intval($this->conf['theme.']['boxmodelLabelWidth']) . ';' . "\n";
				} else {
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
				$jscontent .= ' var middotchar = \'' . $this->middotchar .'\'' . ';' . "\n";
				$jscontent .= '	var confreplyModeInline = ' . intval($this->conf['advanced.']['replyModeInline']) . ';' . "\n";
				$jscontent .= '	var confreplyModeInlineOpenForm = ' . intval($this->conf['advanced.']['replyModeInlineOpenForm']) . ';' . "\n";
				$jscontent .= '	var textnameCommentSeparator = "' . base64_encode(trim($this->conf['advanced.']['nameCommentSeparator'])) . '";' . "\n";
				$jscontent .= '	var confuseNameCommentSeparator = ' . intval($this->conf['advanced.']['useNameCommentSeparator']) . ';' . "\n";
				$starttimedebug22=microtime(TRUE);
				$jsjqmobile = '0';
				if ($this->detectmobile() == TRUE) {
					$jsjqmobile = '1';
				}

				$emolike = '
	var emolike = 0;';
				if ($this->conf['ratings.']['emoLike'] == 1) {
					$emolike = '
	var emolike = 1;
	var colourcodeemo = [];
	' . $colourcodesemo;
				}
				$ajaxdna = md5($GLOBALS['TSFE']->sys_language_uid . 'g6g9g' . $GLOBALS['TSFE']->lang . 'g6g9g' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) . 'l6l9l' . $GLOBALS['TSFE']->sys_language_uid . 'g6g9g' . $GLOBALS['TSFE']->lang . 'g6g9g' . intval($GLOBALS['TSFE']->fe_user->user['uid']);
				$jsservervars = '' . $rsajsstr . '
<script type="text/javascript">
	var tcistouch = ' . $jsjqmobile  .';
	var screenmd = ' . $this->arrResponsiveSteps[1] . ';
	var tccommnetidstart = ' . $mincommentid  .';
	var tccommnetidto = ' . $maxcommentid  .';
	var pageid = ' . $GLOBALS['TSFE']->id .';
	var pagelanId = ' . $GLOBALS['TSFE']->sys_language_uid .';
	var storagePid = ' . intval($this->conf['storagePid']) .';
	var loginRequiredIdLoginForm = "' . $loginRequiredIdLoginForm .'";
	var loginRequiredRefreshCIDs = "";
	var loginRequiredRefreshRecs = "";
	var ajaxdna = "' . $ajaxdna . '";
	var global_loggedon = '. $tlogon . ';' . $emolike . "\n". $locLoginFormhtml . $locchangePasswordFormhtml . "\n". '
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
				//$jsjqmobile = '1';
				$jquerymobilefile = '';
				if ($jsjqmobile == '1') {
					$filenjqmobinit = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/tx-tc-jquerymobileinit-' .$this->extVersion. '.js';
					$filenjqmob = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/jquery.mobile.min.js';
					$jquerymobilefile = '
							<script type="text/javascript" src="' . $this->createVersionNumberedFilename($filenjqmobinit) .'"></script>
							<script type="text/javascript" src="' . $this->createVersionNumberedFilename($filenjqmob) .'"></script>';
				}

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
						'###JSJQMOBILE###' => $jquerymobilefile,
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
			$this->sdebuginitprint.='Init end: ' . round(1000*($endtimedebug2 - $starttimedebug2), 1) .')</small> ';

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
		$this->fetchConfigValue('sharing.useSharingV2');
		$this->fetchConfigValue('sharing.dontUseSharingFacebookV2');
		$this->fetchConfigValue('sharing.dontUseSharingGoogleV2');
		$this->fetchConfigValue('sharing.dontUseSharingTwitterV2');
		$this->fetchConfigValue('sharing.dontUseSharingLinkedInV2');
		$this->fetchConfigValue('sharing.dontUseSharingStumbleuponV2');
		$this->fetchConfigValue('sharing.shareUsersTotalTextV2');
		$this->fetchConfigValue('sharing.shareDataTextV2');
		$this->fetchConfigValue('sharing.sharePageURLV2');
		$this->fetchConfigValue('sharing.useOnlySharing');
		$this->fetchConfigValue('sharing.useSharingDesign');

		if (isset($this->conf['sharing.']['useSharingV2'])) {
			if ($this->conf['sharing.']['useSharingV2'] != '') {
				$this->conf['sharing.']['useSharing']=$this->conf['sharing.']['useSharingV2'];
			}
			unset($this->conf['sharing.']['useSharingV2']);
		}

		if (isset($this->conf['sharing.']['dontUseSharingFacebookV2'])) {
			if ($this->conf['sharing.']['dontUseSharingFacebookV2'] != '') {
				$this->conf['sharing.']['dontUseSharingFacebook']=$this->conf['sharing.']['dontUseSharingFacebookV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingFacebookV2']);
		}

		if (isset($this->conf['sharing.']['dontUseSharingGoogleV2'])) {
			if ($this->conf['sharing.']['dontUseSharingGoogleV2'] != '') {
				$this->conf['sharing.']['dontUseSharingGoogle']=$this->conf['sharing.']['dontUseSharingGoogleV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingGoogleV2']);
		}

		if (isset($this->conf['sharing.']['dontUseSharingTwitterV2'])) {
			if ($this->conf['sharing.']['dontUseSharingTwitterV2'] != '') {
				$this->conf['sharing.']['dontUseSharingTwitter']=$this->conf['sharing.']['dontUseSharingTwitterV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingTwitterV2']);
		}

		if (isset($this->conf['sharing.']['dontUseSharingLinkedInV2'])) {
			if ($this->conf['sharing.']['dontUseSharingLinkedInV2'] != '') {
				$this->conf['sharing.']['dontUseSharingLinkedIn']=$this->conf['sharing.']['dontUseSharingLinkedInV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingLinkedInV2']);
		}

		if (isset($this->conf['sharing.']['dontUseSharingStumbleuponV2'])) {
			if ($this->conf['sharing.']['dontUseSharingStumbleuponV2'] != '') {
				$this->conf['sharing.']['dontUseSharingStumbleupon']=$this->conf['sharing.']['dontUseSharingStumbleuponV2'];
			}
			unset($this->conf['sharing.']['dontUseSharingStumbleuponV2']);
		}

		if (isset($this->conf['sharing.']['shareUsersTotalTextV2'])) {
			if ($this->conf['sharing.']['shareUsersTotalTextV2'] != '') {
				$this->conf['sharing.']['shareUsersTotalText']=$this->conf['sharing.']['shareUsersTotalTextV2'];
			}
			unset($this->conf['sharing.']['shareUsersTotalTextV2']);
		}

		if (isset($this->conf['sharing.']['shareDataTextV2'])) {
			if ($this->conf['sharing.']['shareDataTextV2'] != '') {
				$this->conf['sharing.']['shareDataText']=$this->conf['sharing.']['shareDataTextV2'];
			}
			unset($this->conf['sharing.']['shareDataTextV2']);
		}

		if (isset($this->conf['sharing.']['sharePageURLV2'])) {
			if ($this->conf['sharing.']['sharePageURLV2'] != '') {
				$this->conf['sharing.']['sharePageURL']=$this->conf['sharing.']['sharePageURLV2'];
			}
			unset($this->conf['sharing.']['sharePageURLV2']);
		}

		if (trim($this->conf['sharing.']['sharePageURL']) != '') {
			$this->conf['sharing.']['staticMode']= 1;
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

		if (intval($this->conf['sharing.']['useOnlySharing'])==1) {
			$this->conf['ratings.']['ratingsOnly'] = 1;
			$this->conf['ratings.']['enableRatings'] = 0;
		}

		if ((intval($this->conf['ratings.']['ratingsOnly']) == 1) && ($this->conf['ratings.']['enableRatings'] == 0)) {
			$this->conf['sharing.']['useOnlySharing'] = 1;
		}

		if ((($this->conf['sharing.']['useOnlySharing'] == 1) || (($this->conf['sharing.']['useSharing'] == 1) && ($this->conf['ratings.']['ratingsOnly'] == 1) && ($this->conf['ratings.']['enableRatings'] == 0))) == FALSE) {
			if (($this->conf['sharing.']['useSharing'] == 1) && ((($this->conf['ratings.']['ratingsOnly'] == 0) && ($this->conf['ratings.']['enableRatings'] == 1) && ($this->conf['ratings.']['useLikeDisLike'] == 1)) ||
					($this->conf['advanced.']['useCommentLink'] == 1))) {
				if ($this->conf['sharing.']['useSharingDesign'] == 4) {
					// add this is set to opoup small buttons, because it's to large for the location in the plugin
					$this->conf['sharing.']['useSharingDesign'] = 0;
				}

				if ($this->conf['sharing.']['useSharingDesign'] == 3) {
					// buttons open definetely wont work, this is set to popup buttons, because it's to large for the location in the plugin
					$this->conf['sharing.']['useSharingDesign'] = 1;
				}

				if ($this->conf['sharing.']['useSharingDesign'] == 5) {
					// switch off sharing if user want to place a disabled open plugin into the topline of a comments ( ratings combined plugin
					$this->conf['sharing.']['useSharing'] = 0;
				}

			}
		}

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
		$dirsep = DIRECTORY_SEPARATOR;
		$repstr = str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
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

		$applyv2imagewidth = 0;
		if (($ratinglineheight-$this->conf['ratings.']['likeV2ImageWidth'])>5) {
			$applyv2imagewidth = 1;
		}

		$reviewMarginTop = intval((intval($this->conf['theme.']['boxmodelLineHeight'])-intval($this->conf['ratings.']['reviewImageWidth']))/2);
		$ratingMarginTop = intval((intval($this->conf['theme.']['boxmodelLineHeight'])-intval($this->conf['ratings.']['ratingImageWidth']))/2);
		$nbrofstars= intval($this->conf['ratings.']['maxValue']) - intval($this->conf['ratings.']['minValue']) + 1;

		$this->LESSVars['comment'][$this->LESS_i] = '// line height in with like v2 image'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@likeV2ImageWidth';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['ratings.']['likeV2ImageWidth'] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// image width for show more comments link in theme version 2 (v2)'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@CommentImageWidth';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['ratings.']['CommentImageWidth'] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// if to apply special top margin for the ilkev2 pics'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@applyv2imagewidth';
		$this->LESSVars['val'][$this->LESS_i] = $applyv2imagewidth == 1 ? 'true' : 'false';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// line height in with like image'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@likeImageWidth';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['ratings.']['likeImageWidth'] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// line height in ratings, calculated'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@ratingLineHeight';
		$this->LESSVars['val'][$this->LESS_i] = $ratinglineheight . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// line height in reviews, calculated'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@reviewLineHeight';
		$this->LESSVars['val'][$this->LESS_i] = $reviewlineheight . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// top margin in ratings, calculated'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@ratingMarginTop';
		$this->LESSVars['val'][$this->LESS_i] = $ratingMarginTop . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// top margin in reviews, calculated'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@reviewMarginTop';
		$this->LESSVars['val'][$this->LESS_i] = $reviewMarginTop . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// margin in rating texts, calculated'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@ratingTextMargin';
		$this->LESSVars['val'][$this->LESS_i] = $ratingTextMargin . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// margin in review texts, calculated'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@reviewTextMargin';
		$this->LESSVars['val'][$this->LESS_i] = $reviewTextMargin . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// Image width of rating image (PHP calculates it)'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@ratingImageWidth';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['ratings.']['ratingImageWidth'] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// Number of rating- oder review stars used'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@ratingNbrStars';
		$this->LESSVars['val'][$this->LESS_i] =  $nbrofstars;
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// Image width of review image (PHP calculates it)'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@reviewImageWidth';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['ratings.']['reviewImageWidth'] . 'px';
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: theme.boxmodelTextareaNbrLines'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@boxmodelTextareaNbrLines';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['theme.']['boxmodelTextareaNbrLines'];
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: theme.themeVersion'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@themeVersion';
		$this->LESSVars['val'][$this->LESS_i] = $this->conf['theme.']['themeVersion'];
		$this->LESS_i++;

		$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPath';
		$this->LESSVars['val'][$this->LESS_i] = '"../../../Resources/Public/Icons/emolike/' . $this->conf['ratings.']['emoLikeSet'] . '/"';
		$this->LESS_i++;

		$isTabletOrHandyexceptFF = $this->detectmobile(TRUE);
		$this->LESSVars['comment'][$this->LESS_i] = '// TS: isTabletOrHandyexceptFF'. "\n";
		$this->LESSVars['var'][$this->LESS_i] = '@isTabletOrHandyexceptFF';
		$this->LESSVars['val'][$this->LESS_i] = intval($isTabletOrHandyexceptFF) == 1 ? 'true' : 'false';
		$this->LESS_i++;
		$ratingsemoLikeSet = $this->conf['ratings.']['emoLikeSet'];
		if (trim($this->conf['ratings.']['emoLikeSet']) == '') {
			$ratingsemoLikeSet = 'default';
		}

		$whereel ='emolike_setfolder = "' . $ratingsemoLikeSet . '" AND deleted = 0 AND emolike_ll <> "Like" AND emolike_ll <> "Dislike"';

		$rowsel = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, emolike_setpos, emolike_ll,emolike_sort, emolike_colorcode',
				'tx_toctoc_comments_emolike',
				$whereel,
				'',
				'emolike_sort',
				'5');
		$emolikeLLarr = array();
		$ei = 0;

		$indataarr = array();
		$foundpos1 = FALSE;
		$foundpos2 = FALSE;
		$foundpos3 = FALSE;
		$foundpos4 = FALSE;
		$foundpos5 = FALSE;

		if (count($rowsel)>0) {
			$iel = 2;
			foreach ($rowsel as $rowel) {
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Positions(' . trim(intval($rowel['emolike_sort'])) . ')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPathPos'. $iel;
				if ($rowel['emolike_setpos'] == 5) {
					// normally angry
					$emolike_setpos = '-336px';
					$foundpos5 = TRUE;
				} elseif ($rowel['emolike_setpos'] == 4) {
					// normally sad
					$emolike_setpos = '-240px';
					$foundpos4 = TRUE;
				} elseif ($rowel['emolike_setpos'] == 3) {
					// normally wow
					$emolike_setpos = '-144px';
					$foundpos3 = TRUE;
				} elseif ($rowel['emolike_setpos'] == 2) {
					// normally haha
					$emolike_setpos = '-96px';
					$foundpos2 = TRUE;
				} elseif ($rowel['emolike_setpos'] == 1) {
					// normally love
					$emolike_setpos = '0px';
					$foundpos1 = TRUE;
				} else {
					// normally the grey haha, it's not used
					$emolike_setpos = '-48px';
				}
				$indataarr[$iel] = $iel;
				$this->LESSVars['val'][$this->LESS_i] = $emolike_setpos;
				$this->LESS_i++;
				$iel++;
			}
			if ($foundpos5 == FALSE) {
				// find free sort
				$freesort = count($indataarr)+2;
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Positions('.$freesort.')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPathPos'.$freesort;
				$this->LESSVars['val'][$this->LESS_i] = '-48px';
				$this->LESS_i++;
				$indataarr[count($indataarr)+1] = $freesort;
			}
			if ($foundpos4 == FALSE) {
				// find free sort
				$freesort = count($indataarr)+2;
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Positions('.$freesort.')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPathPos'.$freesort;
				$this->LESSVars['val'][$this->LESS_i] = '-48px';
				$this->LESS_i++;
				$indataarr[count($indataarr)+1] = $freesort;
			}
			if ($foundpos3 == FALSE) {
				// find free sort
				$freesort = count($indataarr)+2;
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Positions('.$freesort.')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPathPos'.$freesort;
				$this->LESSVars['val'][$this->LESS_i] = '-48px';
				$this->LESS_i++;
				$indataarr[count($indataarr)+1] = $freesort;
			}
			if ($foundpos2 == FALSE) {
				// find free sort
				$freesort = count($indataarr)+2;
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Positions('.$freesort.')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPathPos'.$freesort;
				$this->LESSVars['val'][$this->LESS_i] = '-48px';
				$this->LESS_i++;
				$indataarr[count($indataarr)+1] = $freesort;
			}
			if ($foundpos1 == FALSE) {
				// find free sort
				$freesort = count($indataarr)+2;
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Positions('.$freesort.')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetPathPos'.$freesort;
				$this->LESSVars['val'][$this->LESS_i] = '-48px';
				$this->LESS_i++;
				$indataarr[count($indataarr)+1] = $freesort;
			}

			foreach ($rowsel as $rowel) {
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Colorcode(' . trim($rowel['emolike_ll']) . ')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetColorCode'.trim($rowel['emolike_ll']);
				$this->LESSVars['val'][$this->LESS_i] = $rowel['emolike_colorcode'];
				$this->LESS_i++;
				$emolikeLLarr[$ei] = '"' . trim($rowel['emolike_ll']) . '"';
				$ei++;
			}
		}
		$emolikeLLs = implode (',', $emolikeLLarr);
		// step to add the css for other emolikes which are not used, so the LESS-model wiill be staisfied
		$whereel ='emolike_ll NOT IN (' . $emolikeLLs . ') AND deleted = 0 AND emolike_ll <> "Like" AND emolike_ll <> "Dislike"';

		$rowsel = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('DISTINCT emolike_ll',
				'tx_toctoc_comments_emolike',
				$whereel,
				'',
				'emolike_ll',
				'');

		if (count($rowsel)>0) {
			foreach ($rowsel as $rowel) {
				$this->LESSVars['comment'][$this->LESS_i] = '// TS: ratings.emoLikeSet->Colorcode(' . trim($rowel['emolike_ll']) . ')'. "\n";
				$this->LESSVars['var'][$this->LESS_i] = '@emoLikeSetColorCode'.trim($rowel['emolike_ll']);
				$this->LESSVars['val'][$this->LESS_i] = '#cccccc';
				$this->LESS_i++;
			}
		}

		$httpsid='';
		if (@$_SERVER['HTTPS'] == 'on') {
			$httpsid='-https';
		}

		$atMediaWitdhs = '-' . $this->arrResponsiveSteps[0] . $this->arrResponsiveSteps[1] . $this->arrResponsiveSteps[2];
		$isTabletOrHandyexceptFF = $this->detectmobile(TRUE);

		$ratingsemoLikeSet = trim($this->conf['ratings.']['emoLikeSet']);
		if (trim($this->conf['ratings.']['emoLikeSet']) == '') {
			$ratingsemoLikeSet = 'default';
		}
		$cssmd5 = md5(serialize($this->LESSVars['val']) . $this->conf['ratings.']['useLikeDislikeStyle'] .
					'-' . $this->conf['theme.']['boxmodelLabelInputPreserve'] . $this->conf['theme.']['themeVersion'] .
			$this->conf['ratings.']['emoLike'] . $ratingsemoLikeSet . intval($isTabletOrHandyexceptFF) . intval($this->conf['useUserImage']) . $atMediaWitdhs);

		if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
			$filenamecssoutfile='tx-tc-' . $this->extVersion . '-' . str_replace('.txt', '', $this->conf['theme.']['selectedBoxmodel']) .'-' .
					$this->conf['theme.']['selectedTheme'] . '-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '-' . $cssmd5 . '.css';
		} else {
			$filenamecssoutfile='tx-tc-' . $this->extVersion . '-system-' .
					$this->conf['theme.']['selectedTheme'] . '-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '-' . $cssmd5 . '.css';
		}

		$txdirname= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/css/temp/' );
		$filenamecss = $txdirname . $filenamecssoutfile;

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

		$filenamecssfile='';
		$contentTSless = '';
		$controlTSless = '';
		$lessvarcount = count($this->LESSVars['var']);
		for ($i=0;$i<$lessvarcount;$i++) {
			$contentTSless .= $this->LESSVars['comment'][$i];
			$contentTSless .= $this->LESSVars['var'][$i] . ':' . "\t\t" .  $this->LESSVars['val'][$i]. ';' . "\n";
			$controlTSless .= $this->LESSVars['val'][$i];
		}

		$txdirnametemp = str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/css/temp' );
		$txdirnamebase = str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep .
				t3lib_extMgm::siteRelPath('toctoc_comments'));
		$txdirtoctoc = '../';
		// get max LESS-filemtime
		$txdirnamelessbootstrap = str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep .
				t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/less/' . $this->extLESSVersion . '' );
		$lessbootstrapfile = $txdirnamelessbootstrap . DIRECTORY_SEPARATOR . 'bootstrap.less';
		if (file_exists($lessbootstrapfile)) {
			$contentbootstrap = file_get_contents($lessbootstrapfile);
			$cbsarrimports = explode('@import "', $contentbootstrap);
			$countcbsarrimports = count($cbsarrimports);
			for ($i =1; $i < $countcbsarrimports; $i++) {
				$importcandarr = explode('"', $cbsarrimports[$i]);
				$importcand = $importcandarr[0];
				$checktime = FALSE;
				if (str_replace('.less', '', $importcand) != $importcand) {
					if (str_replace('_php', '', $importcand) != $importcand) {
						if ($importcand == '_php/boxmodelderivedvariables.less') {
							$checktime = TRUE;
						}

					} else {
						$checktime = TRUE;
					}

				}

				if ($checktime == TRUE) {
					$timecheckfile =$txdirnamelessbootstrap. DIRECTORY_SEPARATOR . $importcand;
					if (file_exists($timecheckfile)) {
						$filetime = @filemtime($timecheckfile);
						if ($this->newestLessFileTime < $filetime) {
							$this->newestLessFileTime = $filetime;
						}

					} else {
						print 'less-file ' . $timecheckfile. ' not found<br>';
						exit;
					}

				}

			}

		} else {
			print 'bootstrap-file ' . $lessbootstrapfile. ' not found<br>';
			exit;
		}

		$lessbootstrapfile = $txdirnamelessbootstrap . DIRECTORY_SEPARATOR . '_php'. DIRECTORY_SEPARATOR .'boxmodel.less';
		if (file_exists($lessbootstrapfile)) {
			if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
				$timecheckfile = $txdirnamelessbootstrap . DIRECTORY_SEPARATOR .
				'boxmodel' . DIRECTORY_SEPARATOR .
				str_replace('boxmodel_', '', str_replace('.txt', '', trim($this->conf['theme.']['selectedBoxmodel']))) . '.less';
				if (file_exists($timecheckfile)) {
					$filetime = @filemtime($timecheckfile);
					if ($this->newestLessFileTime < $filetime) {
						$this->newestLessFileTime = $filetime;
					}

				} else {
					print 'boxmodel-file ' . $timecheckfile. ' not found<br>';
					exit;
				}

			}
			if (trim($this->conf['theme.']['themeVersion']) == '2') {
				$timecheckfile = $txdirnamelessbootstrap . DIRECTORY_SEPARATOR .
				'_php' . DIRECTORY_SEPARATOR . 'themeVersion2.less';
				if (file_exists($timecheckfile)) {
					$filetime = @filemtime($timecheckfile);
					if ($this->newestLessFileTime < $filetime) {
						$this->newestLessFileTime = $filetime;
					}

				} else {
					print 'boxmodelthemeVersion-file ' . $timecheckfile. ' not found<br>';
					exit;
				}
				if (trim($this->conf['ratings.']['emoLike']) == '1') {
					$timecheckfile = $txdirnamelessbootstrap . DIRECTORY_SEPARATOR .
					'ratings' . DIRECTORY_SEPARATOR . 'emolike.less';
					if (file_exists($timecheckfile)) {
						$filetime = @filemtime($timecheckfile);
						if ($this->newestLessFileTime < $filetime) {
							$this->newestLessFileTime = $filetime;
						}

					} else {
						print 'boxmodelthemeVersion-file ' . $timecheckfile. ' not found<br>';
						exit;
					}

				}

			}

		} else {
			print 'boxmodel-include-file ' . $lessbootstrapfile. ' not found<br>';
			exit;
		}

		$controlTSless = $this->newestLessFileTime . '-' . $controlTSless;
		// check controlfile
		$filenamecontrolcss = str_replace('.css', '.txt', $filenamecss);
		$doless= FALSE;
		if (file_exists($filenamecontrolcss)) {
			$contentcurrentcontrol = file_get_contents($filenamecontrolcss);
			if ($controlTSless != $contentcurrentcontrol) {

				$doless= TRUE;
			} else {
				if (!file_exists($filenamecss)) {
					$doless= TRUE;
				}

			}

		} else {
			$doless= TRUE;
		}

		if ($doless ==TRUE) {
		// Check LOCK-file
			$lockfile = $txdirnametemp . DIRECTORY_SEPARATOR . '~lock.less';
			if (file_exists($lockfile)) {
				$i=0;
				do {
					usleep(200);
					$fex = file_exists($lockfile);
					$i++;
				} while (($fex == FALSE) || ($i > 60));

			} else {
				file_put_contents($lockfile, 'locked');
			}

			// Loop, sleep 3 ms, if lock file until nomore lockfile
			// make new look file

			// copy css/themes/[theme]/theme.less over less/' . $this->extLESSVersion . '/_php/themecolorvariables.less
			$contentlesscolors = file_get_contents($this->themeLESSfile);
			$txdirnamelessphp = str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
					'res/less/' . $this->extLESSVersion . '/_php' );
			$lessphpfile = $txdirnamelessphp . DIRECTORY_SEPARATOR . 'themecolorvariables.less';
			if (file_exists($lessphpfile)) {
				file_put_contents($lessphpfile, $contentlesscolors);
			}

			$lessphpTSfile = $txdirnamelessphp . DIRECTORY_SEPARATOR . 'boxmodelvariables.less';
			if (file_exists($lessphpTSfile)) {
				file_put_contents($lessphpTSfile, $contentTSless);
			}

			$lessphpbmfile = $txdirnamelessphp . DIRECTORY_SEPARATOR . 'boxmodel.less';
			if (file_exists($lessphpbmfile)) {
				$contentbmless = '';
				if (trim($this->conf['theme.']['selectedBoxmodel']) != '') {
					$contentbmless .= '@import "../boxmodel/' .
									str_replace('boxmodel_', '', str_replace('.txt', '', trim($this->conf['theme.']['selectedBoxmodel']))) .
									'.less";' . "\n";
				}
				$sepl = '';
				if (trim($this->conf['theme.']['themeVersion']) == '2') {
					$contentbmless .= '@import "themeVersion2.less";';
					$sepl = "\n";
				}

				if (trim($this->conf['ratings.']['emoLike']) == '1') {
					$contentbmless .= $sepl . '@import "../ratings/emolike.less";';
				}

				file_put_contents($lessphpbmfile, $contentbmless);
			}

			require_once (t3lib_extMgm::extPath('toctoc_comments', 'contrib/less/less.php/Autoloader.php'));
			if (!class_exists('Less_Cache')) {
				$autoload = t3lib_div::makeInstance('Less_Autoloader');
				$autoload::register();
			}

			Less_Cache::$cache_dir = $txdirnametemp;
			$files = array();
			$files[$txdirnamebase . 'res/less/' . $this->extLESSVersion . '/bootstrap.less'] = $txdirtoctoc;

			$filenamecssfile = Less_Cache::Get( $files );
			$subfldrLESS = 'temp/';
			$txdirnamedefault= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep . t3lib_extMgm::siteRelPath('toctoc_comments') .
					'res/css/' );
			$filenamedefaultcssmod= $txdirnamedefault . $subfldrLESS . $filenamecssfile;
			if (file_exists($filenamedefaultcssmod)) {
				// tx-tc' . $this->extVersion . '.css is present
				$contentdefaultcssmod = file_get_contents($filenamedefaultcssmod);
				$contentdefaultcssmod = str_replace('   ', "\t", $contentdefaultcssmod);
				$contentdefaultcssmod = str_replace('  ', "\t", $contentdefaultcssmod);
				$contentdefaultcssmod = str_replace(',' . "\r\n", ', ', $contentdefaultcssmod);
				$contentdefaultcssmod = str_replace(',' . "\n", ', ', $contentdefaultcssmod);
				$contentdefaultcssmod = str_replace('url("../../', 'url("../', $contentdefaultcssmod);
				file_put_contents($filenamedefaultcssmod, $contentdefaultcssmod);
			} else {
				print '! File default css mod "' . $filenamedefaultcssmod . '" not found<br>';
				exit;
			}

			file_put_contents($filenamecontrolcss, $controlTSless);
			$runboxmodel = TRUE;
		}

		if ($filenamecssfile == '') {
			$runboxmodel = FALSE;
		} else {

			$txdirnamedefault= str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . $dirsep .
					t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/' );
			$filenamedefaultcss=$txdirnamedefault . $subfldrLESS . $filenamecssfile;

			if (!isset($_SESSION['fileTimeDefaultCSS'])) {
				$runboxmodel = TRUE;
				$_SESSION['fileTimeDefaultCSS'] = $filetime;
			} else {
				if ($_SESSION['fileTimeDefaultCSS'] != $filetime) {
					$runboxmodel = TRUE;
					$_SESSION['fileTimeDefaultCSS'] = $filetime;
				}

			}

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

			if (!isset($_SESSION['AJAXOrigimages'])) {
				$_SESSION['AJAXOrigimages'] = array();
			}

		}

		if ($runboxmodel == TRUE) {
			if (file_exists($filenamecss)) {
				// boxmodel.css file found
				$content = file_get_contents($filenamecss);
				$bmcsslastmodif = filemtime($filenamecss);
			}

			$forceregenerate=TRUE;

			if (file_exists($filenamedefaultcss)) {
				// tx-tc' . $this->extVersion . '.css is present
				$contentdefaultcss = file_get_contents($filenamedefaultcss);

				$basecsslastmodif = filemtime($filenamedefaultcss);
				if (($forceregenerate==TRUE) || ($bmcsslastmodif<$bmtxtlastmodif) || ($bmcsslastmodif<$basecsslastmodif)) {
					if ($this->conf['theme.']['boxmodelLineHeightPreserve'] == 1) {
						// deleting some line-heights in CSS
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

					$contentdefaultcss = str_replace('}/*', '}' . "\n" . '/*', $contentdefaultcss);
					$contentdefaultcss = str_replace(' }', '}', $contentdefaultcss);
					$contentdefaultcss = str_replace("\r\n", "\n", $contentdefaultcss);
					$contentdefaultcss = str_replace("\n\n", "\n", $contentdefaultcss);

					// merging identical selectors and overwrite properties with more Css-Importance
					$contentdefaultscssarr = explode("\n" .'}', $contentdefaultcss);
					$countcssselectors = count($contentdefaultscssarr);
					$selectorarr = array();
					$onatmedia = FALSE;
					$sti=0;
					for ($i=0;$i< $countcssselectors;$i++) {

						$strselectorarr = array();
						$strcssselectorall = $contentdefaultscssarr[$i];
						$strselectorarr = explode("\n", $strcssselectorall);
						$countcssprops = count($strselectorarr);
						if ($strselectorarr[0] !='') {
							$strselectorarr0 = $strselectorarr[0];
							$jstart=1;

						} else {
							$strselectorarr0 = $strselectorarr[1];
							$jstart=2;
						}

						if ($onatmedia == TRUE) {
								//@media is finished
								$onatmedia = FALSE;
						}

						$selectorarr[$sti] = array();
						$selectorarr[$sti]['selector'] = $strselectorarr0;

						// check if comment
						$selectorarr[$sti]['comment'] = FALSE;

						if (str_replace('/*', '', $selectorarr[$sti]['selector']) != $selectorarr[$sti]['selector']) {
							$selectorarr[$sti]['comment'] = TRUE;
							do {$selectorarr[$sti]['selectoratmedia'] = FALSE;
								$selectorarr[$sti]['properities'] = array();
								if (str_replace('*/', '', $selectorarr[$sti]['selector']) != $selectorarr[$sti]['selector']) {
									$sti++;

									$strselectorarr0 = $strselectorarr[$jstart];
									$jstart++;
									$selectorarr[$sti]['selector'] = $strselectorarr0;
									$selectorarr[$sti]['comment'] = FALSE;
								} else {
									//find end line, move all to selector
									for ($c=$jstart; $c < $countcssprops; $c++) {
										$selectorarr[$sti]['selector'] .= "\n" . $strselectorarr[$c];
										$strselectorarr0 = $strselectorarr[$c];
										$jstart++;

										if (str_replace('*/', '', $strselectorarr[$c]) != $strselectorarr[$c]) {
											$sti++;
											$selectorarr[$sti]['selector'] = $strselectorarr[$c+1];
											$selectorarr[$sti]['comment'] = FALSE;

											if (str_replace('/*', '', $selectorarr[$sti]['selector']) != $selectorarr[$sti]['selector']) {
												$selectorarr[$sti]['comment'] = TRUE;

											}
											$jstart++;
											break;
										}
									}
								}

							} while ($selectorarr[$sti]['comment'] == TRUE);
						}

						if (str_replace('@media', '', $strselectorarr0) != $strselectorarr0) {
							// leaving @media untouched and get the different kind of arraystructure
							$onatmedia = TRUE;
						}

						$selectorarr[$sti]['selectoratmedia'] = $onatmedia;
						$selectorarr[$sti]['properities'] = array();
						for ($j=0;$j< ($countcssprops - $jstart);$j++) {
							$selectorarr[$sti]['properities'][$j] = array();
							$propertyarr = explode(':', $strselectorarr[$jstart+$j]);
							$selectorarr[$sti]['properities'][$j]['propname'] = trim($propertyarr[0]);// zB height
							if (count($propertyarr) > 1) {
								$selectorarr[$sti]['properities'][$j]['propval'] = trim($propertyarr[1]); // zB 30px;
							} else {
								$selectorarr[$sti]['properities'][$j]['propval'] = ''; // in @media constructs;
							}

						}
						if (count($selectorarr[$sti]['properities']) > 0) {
							$sti++;
						}

					}

					// now we parse $selectorarr, lock out for duplicate selectors
					// if we find one, going down the tree we add new properies to the selector,
					// overwrite existing properties values, if according to !important if present.
					$countselectorarr = count($selectorarr);
					$selectormergedarr = array();
					$smi = 0;

					$droparr = array();
					$dpi= 0;

					for ($i=0;$i<$countselectorarr;$i++) {
						$collectedpropertiesarr = array();
						$cp=0;
						$currentselector = $selectorarr[$i]['selector'];

						// $droparr
						// it allows to let drop already processed selectors
						$dropselector = FALSE;
						// checking $droparr
						if ($selectorarr[$i]['selectoratmedia'] == FALSE) {
							for  ($d=0;$d< $dpi;$d++) {
								if (trim($droparr[$d])== trim($currentselector)) {
									$dropselector = TRUE;
									break;
								}
							}
						}

						if ($selectorarr[$i]['selectoratmedia'] == FALSE) {
							// no job to do looking out for twin selectors if we are on @media

							if ($dropselector == FALSE) {
								// job to do if we cannot let drop the current selector
								// with another index we scan again the selectors
								$countproperitiesarr = count($selectorarr[$i]['properities']);
								for ($p=0; $p<$countproperitiesarr; $p++) {
									// we add an element to the currently collected properties array
									$collectedpropertiesarr[$cp]= array();
									// and copy the found properties
									$collectedpropertiesarr[$cp]['propname'] = $selectorarr[$i]['properities'][$p]['propname'];
									$collectedpropertiesarr[$cp]['propval'] = $selectorarr[$i]['properities'][$p]['propval'];
									$cp++;
								}

								for ($j=$i+1;$j < $countselectorarr; $j++) {
									// if we find a twin we xcan go ahead

									if (trim($currentselector) == trim($selectorarr[$j]['selector'])) {
										// duplicate selector found on position $j
										$countproperitiesarr = count($selectorarr[$j]['properities']);
										// counting currently< present properties
										for ($p=0; $p<$countproperitiesarr; $p++) {
											// we add an element to the currently collected properties array
											$collectedpropertiesarr[$cp]= array();
											// and copy the found properties
											$collectedpropertiesarr[$cp]['propname'] = $selectorarr[$j]['properities'][$p]['propname'];
											$collectedpropertiesarr[$cp]['propval'] = $selectorarr[$j]['properities'][$p]['propval'];
											$cp++;
										}
									}
								}
								// after the walk thru the selectors array we count the propertities we've found
								$countcollectedpropertiesarr = count($collectedpropertiesarr);
								$droparr[$dpi]= $currentselector;
								$dpi++;

								if ($countcollectedpropertiesarr > 0) {
									// add current selector to future drops

									// well collected properties present
									// for every element in the $collectedpropertiesarr we first check if a 'propname'-twin is present
									$addedpropertiesarr = array();
									$ap=0;
									$countpresentselectors=0;

									for ($j=0; $j < $countcollectedpropertiesarr; $j++) {
										if (trim($collectedpropertiesarr[$j]['propname']) !='') {
											$currentproperty = $collectedpropertiesarr[$j]['propname'];
											$currentpropval = $collectedpropertiesarr[$j]['propval'];
											// the number of already present properties wil allow to add nw ones at the end:
											$countpresentselectors = count($selectorarr[$i]['properities']);
											$propertyreplaced = FALSE;
											for ($p=0; $p< $countpresentselectors; $p++) {
												if ($currentproperty == $selectorarr[$i]['properities'][$p]['propname']) {
													// found one, now check if current property is not !important

													if (str_replace('!important', '', $currentpropval) == $currentpropval) {
														// current property is not !important, replace propertyvalue
														$selectorarr[$i]['properities'][$p]['propval'] = $currentpropval;

													}
													// else we let drop the new one
													// but we have to say propertyreplaced because else we'll add it
													$propertyreplaced = TRUE;
													//break;
												}

											}

											If ($propertyreplaced == FALSE) {
												// the addedproperties array gets a new item
												$addedpropertiesarr[$ap] = array();
												$addedpropertiesarr[$ap]['propname'] = $collectedpropertiesarr[$j]['propname'];
												$addedpropertiesarr[$ap]['propval'] = $collectedpropertiesarr[$j]['propval'];
												$ap++;
											}
										}

									}
									// changes have been made, now we add the new (added) properties to $selectorarr[$i]['selector']
									$countadded = count($addedpropertiesarr);
									for ($j=0; $j < $countadded; $j++) {
										$selectorarr[$i]['properities'][$countpresentselectors + $j]['propname']=$addedpropertiesarr[$j]['propname'];
										$selectorarr[$i]['properities'][$countpresentselectors + $j]['propval']=$addedpropertiesarr[$j]['propval'];

									}

								}

								// now we add the item to the outputing array $selectormergedarr
								$selectormergedarr[$smi]['selector'] = $selectorarr[$i]['selector'];
								$selectormergedarr[$smi]['comment'] = $selectorarr[$i]['comment'];
								$selectormergedarr[$smi]['selectoratmedia'] = $selectorarr[$i]['selectoratmedia'];
								$selectormergedarr[$smi]['properities'] = array();
								$countcssprops = count($selectorarr[$i]['properities']);

								for ($j=0;$j< $countcssprops;$j++) {
									$selectormergedarr[$smi]['properities'][$j] = array();

									$selectormergedarr[$smi]['properities'][$j]['propname'] = $selectorarr[$i]['properities'][$j]['propname'];// zB height
									if (count($selectorarr[$i]['properities'][$j]) > 1) {
										$selectormergedarr[$smi]['properities'][$j]['propval'] = $selectorarr[$i]['properities'][$j]['propval']; // zB 30px;
									} else {
										$selectormergedarr[$smi]['properities'][$j]['propval'] = ''; // in @media constructs;
									}

								}
								$smi++;
							}

						} else {
							// on @media - just copy the item to the outputing array $selectormergedarr
							$selectormergedarr[$smi]['selector'] = $selectorarr[$i]['selector'];
							$selectormergedarr[$smi]['comment'] = $selectorarr[$i]['comment'];
							$selectormergedarr[$smi]['selectoratmedia'] = $selectorarr[$i]['selectoratmedia'];
							$selectormergedarr[$smi]['properities'] = array();
							$countcssprops = count($selectorarr[$i]['properities']);
							for ($j=0;$j< $countcssprops;$j++) {
								$selectormergedarr[$smi]['properities'][$j] = array();

								$selectormergedarr[$smi]['properities'][$j]['propname'] = $selectorarr[$i]['properities'][$j]['propname'];// zB height
								if (count($selectorarr[$i]['properities'][$j]) > 1) {
									$selectormergedarr[$smi]['properities'][$j]['propval'] = $selectorarr[$i]['properities'][$j]['propval']; // zB 30px;
								} else {
									$selectormergedarr[$smi]['properities'][$j]['propval'] = ''; // in @media constructs;
								}

							}

							$smi++;
						}

					}

					// and after all this theatre we can restore $selectormergedarr into $contentdefaultcss
					$countselectorarr=count($selectormergedarr);
					$contentdefaultcssmerged = '';
					for ($i=0;$i< $countselectorarr-1;$i++) {
						$contentdefaultcssmerged .= $selectormergedarr[$i]['selector'] . "\n";
						$countcssprops= count($selectormergedarr[$i]['properities']);
						for ($j=0;$j< $countcssprops;$j++) {
							$contentdefaultcssmerged .= "\t" . $selectormergedarr[$i]['properities'][$j]['propname'];
							if ($selectormergedarr[$i]['properities'][$j]['propval'] != '') {
								$contentdefaultcssmerged .= ': ' . $selectormergedarr[$i]['properities'][$j]['propval'];
							}

							$contentdefaultcssmerged .= "\n";
						}

						if ($selectormergedarr[$i]['comment'] == FALSE) {
							$contentdefaultcssmerged .= '}' . "\n";

						}

					}

					$contentdefaultcssmerged = str_replace(', ' . "\t" . '.', ', .', $contentdefaultcssmerged);
					$contentdefaultcss = $contentdefaultcssmerged;

					if ($this->conf['theme.']['crunchCSS'] == 1) {
						$contentdefaultcss =$this->crunchcss($contentdefaultcss);
					}

					if (($contentdefaultcss != '') && ($contentdefaultcss != $content)) {
						file_put_contents($filenamecss, $contentdefaultcss);
					}

				}

				//sets active css to boxmodell css
				$this->boxmodelcss ='temp/' . $filenamecssoutfile;
			} else {
				$retstr =$this->pi_wrapInBaseClass($this->lib->pi_getLLWrap($this, 'error', FALSE) . ': ' .
				$this->lib->pi_getLLWrap($this, 'error.no.css.defaultcss', FALSE)) . ': ' . $filenamedefaultcss;
				if ($txdirnametemp != '') {
					foreach (glob($txdirnametemp . DIRECTORY_SEPARATOR . 'lessphp*.*') as $filenametmp) {
						unlink($filenametmp);
					}

					if (file_exists($lockfile)) {
						unlink($lockfile);
					}

				}

				return $retstr;
			}

		} else {
			$this->boxmodelcss ='temp/' . $filenamecssoutfile;
		}

		if ($txdirnametemp != '') {
			foreach (glob($txdirnametemp . DIRECTORY_SEPARATOR . 'lessphp*.*') as $filenametmp) {
				unlink($filenametmp);
			}

			// remove possible LOCK-file
			if (file_exists($lockfile)) {
				unlink($lockfile);
			}

		}

		return '';
		// brr :-)
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

		$slcurrentPageName=str_replace('?&no_cache=1', '', $serverrequri);
		$slcurrentPageName=str_replace('?no_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('&no_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('?&purge_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('?purge_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('&purge_cache=1', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('?&L=0', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('&L=0', '', $slcurrentPageName);
		$slcurrentPageName=str_replace('?L=0', '', $slcurrentPageName);

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
			$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
				$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachetimecid'][$md5url] = 0;
			$_SESSION['mcp' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
				$GLOBALS['TSFE']->fe_user->user['uid']]['Plugincachecid'][$md5url] = '';
		}

	}

	/**
	 * Clears page cache and maintains SESSION processedcachepages
	 *
	 * @param	boolean		$forceclear: when $this->activateClearPageCache is not active, pagecache is forced to be checked
	 * @return	void
	 */
	protected function doClearCache($forceclear=FALSE) {
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
	 * Clears page cache and maintains SESSION processedcachepages
	 *
	 * @param	boolean		$forceclear: when $this->activateClearPageCache is not active, pagecache is forced to be checked
	 * @return	void
	 */
	protected function InitCachingVariables () {

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

			$currentSessionModule = $_SESSION['cSModule'];
			$currentSessionName = $_SESSION['cSName'];
			$currentSessionPath = $_SESSION['cSPath'];
			$currentSessiongc_probability = $_SESSION['cSgcPr'];
			$currentSessiongc_divisor = $_SESSION['cSgcDv'];
			$currentSessiongc_maxlifetime = $_SESSION['cSgcMl'];
			$sessionwasset = $_SESSION['cSwasSet'];
			$sessionid = $_SESSION['cSId'];
			$viewMaxAgeDone = intval($_SESSION['viewMaxAgeDone']);
			$curPageName = '-';

			if (isset($_SESSION['curPageName'])) {
				$curPageName = $_SESSION['curPageName'];
			}

			// total session reset
			$_SESSION = array();

			// but restore some core vars
			$_SESSION['StartTime'] = $tempStartTime;
			$_SESSION['unBlockTime'] = $tempblocktime;
			$_SESSION['cSModule'] = $currentSessionModule;
			$_SESSION['cSName'] = $currentSessionName;
			$_SESSION['cSPath'] = $currentSessionPath;
			$_SESSION['cSgcPr'] = $currentSessiongc_probability;
			$_SESSION['cSgcDv'] = $currentSessiongc_divisor;
			$_SESSION['cSgcMl'] = $currentSessiongc_maxlifetime;
			$_SESSION['cSwasSet'] = $sessionwasset;
			$_SESSION['cSId'] = $sessionid;
			$_SESSION['viewMaxAgeDone'] = $viewMaxAgeDone;

			if ($curPageName != '-') {
				$_SESSION['curPageName'] = $curPageName;
			}

			$this->doClearCache();
			$this->activateClearPageCache = $saveactivateClearPageCache;

	}

	/**
	 * Reads the cache control table and returns timestamp of last modify of a plugins data
	 *
	 * @param	string		$external_ref_uid: reference to the plugin
	 * @return	int		timestamp or 0
	 */
	protected function getPluginCacheControlTstamp ($external_ref_uid) {
		$tstamp = $this->lib->getPluginCacheControlTstamp($external_ref_uid);
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
			$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_prefixtotable VALUES (12, ' . $this->conf['storagePid'] .
					", 1360836119, 1360836119, 0, 'tx_restdoc_pi1', 'tx_restdoc_pi1', 'doc', '', '', 0)");
		}

	}

	/**
	 * writes if needed a tx-tc-shrrr-nnn.js
	 * returns link to file to be appended on output
	 *
	 * @return	void
	 */
	protected function sharrrejs() {
		$ret = '';
		$httpsid = '';
		$jscontent = '';

		if (@$_SERVER['HTTPS'] == 'on') {
			// on https StumbleUpon and Digg fail
			if (($this->conf['sharing.']['dontUseSharingStumbleupon'] == 0) || ($this->conf['sharing.']['dontUseSharingDigg'] == 0)) {
				$httpsid = '-https';
			}

		}

		$sharingconfimprint =  $this->conf['sharing.']['useSharingDesign'] . $this->conf['sharing.']['dontUseSharingFacebook'] .
		$this->conf['sharing.']['dontUseSharingGoogle'] . $this->conf['sharing.']['dontUseSharingTwitter'] . $this->conf['sharing.']['dontUseSharingLinkedIn'] .
		$this->conf['sharing.']['dontUseSharingStumbleupon'] . $this->conf['sharing.']['dontUseSharingPinterest'] . $this->conf['sharing.']['dontUseSharingDigg'] .
		$this->conf['sharing.']['dontUseSharingDelicious'] . $this->conf['sharing.']['dontUseSharingAddThisMore'];
		$md5url = md5($_SESSION['curPageName'] . $sharingconfimprint);
		$filenamejs='tx-tc-shrrr-' . $this->extVersion . '-' . $md5url . '-' . $GLOBALS['TSFE']->id . '-' . $_SESSION['commentListRecord'] .
		'-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . '.js';

		$repstr = str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/pi1');

		$txdirname = str_replace('/', DIRECTORY_SEPARATOR, str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR .
				t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/temp/');

		$filenamejslink = $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/js/temp/' . $filenamejs;

		$filenamejs = $txdirname . $filenamejs;
		$hassharrefile = FALSE;
		if (file_exists($filenamejs)) {
			$hassharrefile = TRUE;
		}

		$ReportUser = 0;
		$md5PluginId = md5($GLOBALS['TSFE']->id . '-' . $_SESSION['commentListRecord'] . '-' . $GLOBALS['TSFE']->sys_language_uid  . $httpsid . 'shr');

		if (($GLOBALS['TSFE']->id != '') && (trim($_SESSION['sharrrejs']) != '')) {
			$jscontent = trim($_SESSION['sharrrejs']);
			$jscontent = '/*
 * sharrre events
 */
function tcrebshr' . $_SESSION['commentListRecord'] . '(){
	(function($) {
			'. $jscontent .'
	})(jQuery);
}';

			$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport WHERE md5PluginId = "' . $md5PluginId . '" AND ReportUser = "' . $ReportUser . '"');
			$this->lib->setReportDBCache($this->conf, 0, $ReportUser, $jscontent, $md5PluginId, $_SESSION['commentListRecord']);
		} elseif (($GLOBALS['TSFE']->id != '') && (trim($_SESSION['sharrrejs']) == '')) {
			$dbCache = $this->lib->getReportDBCache($md5PluginId, $ReportUser);
			if ($dbCache != '') {
				$jscontent = $dbCache;
			}

		}

		if ($jscontent != '') {
			$unlinked = FALSE;
			if ($hassharrefile == TRUE) {
				$content = file_get_contents($filenamejs);
				if ($content != $jscontent) {
					$unlinked = TRUE;
					unlink($filenamejs);
				}

			}

			if ((!file_exists($filenamejs)) || ($unlinked == TRUE)) {
				// Write the contents back to the file
				file_put_contents($filenamejs, $jscontent);
				$hassharrefile = TRUE;
			}

		}

		$_SESSION['sharrrejs'] = '';

		if ($hassharrefile == TRUE) {
			$mod1_file = $this->createVersionNumberedFilename($filenamejslink);
			$ret = '<script type="text/javascript" src="'. $mod1_file . '"></script>';

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
				$fldimage = 'image';
				if ($this->conf['advanced.']['FeUserDbField']) {
					$fldimage = $this->conf['advanced.']['FeUserDbField'];
				}

				$_SESSION['AJAXUserimagerefreshImage'] = trim($this->conf['advanced.']['FeUserImagePath']) . trim($GLOBALS['TSFE']->fe_user->user[$fldimage]);
				$_SESSION['checktoctoccommentsuser'] = 1;
			}

		}

	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	protected function getExternalUidShortId() {
		$externalUid = $this->externalUid;
// updatecheck 8.0.0 -> 8.1.1:

		$querymerged='SELECT uid, externaluid FROM tx_toctoc_comments_longuidreference WHERE externaluid NOT LIKE "%@page%"';
		$resultmerged1= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
		$dodelete = FALSE;
		while ($rowsmerged1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1)) {
			$dataWhere = 'reference LIKE "%_ext' .$rowsmerged1['uid']. '%"';
			list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('reference, pagetstampseen',
					'tx_toctoc_comments_feuser_mm', $dataWhere);
			if (intval($row['pagetstampseen']) != 0) {
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_longuidreference SET ' .
						'externaluid="' . $rowsmerged1['externaluid'] . '@page' . $row['pagetstampseen'] . '"' .
						' WHERE uid=' . $rowsmerged1['uid']);
			}

			$dodelete = TRUE;
		}

		if ($dodelete) {
			// After an update there must be no more records without the @page in externaluid
			$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_longuidreference ' .
					' WHERE externaluid NOT LIKE "%@page%"');
		}

		$dataWhere = 'externaluid = "' . $externalUid . '"';
		list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid',
				'tx_toctoc_comments_longuidreference', $dataWhere);
		if (intval($row['uid']) === 0) {
			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_longuidreference', array(
					'externaluid' => $externalUid,
			));
			$externalUid = 'ext' . $GLOBALS['TYPO3_DB']->sql_insert_id();
		} else {
			$externalUid = 'ext' . $row['uid'];
		}

		return $externalUid;
	}
	/**
	 * Checks tx_toctoc_comments_emolike and if empty adds a first set of data
	 *
	 * @return	void
	 */
	protected function checkandload_emolikes() {
		list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid',
				'tx_toctoc_comments_emolike', 'uid=1');
		if (intval($row['uid']) === 0) {
			// insert first set of tx_toctoc_comments_emolike
			if (count($rowsrf)==0) {
				$GLOBALS['TYPO3_DB']->sql_query('INSERT INTO tx_toctoc_comments_emolike VALUES (1,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Like","default",1,8,1,7,""),
(2,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Love","default",1,9,2,9,"#dc1f46"),
(3,' . $this->conf['storagePid'] . ',1458399799,1458399689,0,"Haha","default",2,7,3,6,"#e96d5a"),
(4,' . $this->conf['storagePid'] . ',1458399704,1458399704,0,"Wow","default",3,6,4,7,"#e12d8d"),
(5,' . $this->conf['storagePid'] . ',1458399745,1458399745,0,"Sad","default",4,3,5,3,"#57c3eb"),
(6,' . $this->conf['storagePid'] . ',1458399932,1458399904,0,"Angry","default",5,1,6,1,"#de2723"),
(7,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Dislike","default",2,2,7,4,""),
(8,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Like","facebook",1,8,1,7,""),
(9,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Love","facebook",1,9,2,9,"#e84965"),
(10,' . $this->conf['storagePid'] . ',1458399799,1458399689,0,"Haha","facebook",2,7,3,6,"#f0ba15"),
(11,' . $this->conf['storagePid'] . ',1458399704,1458399704,0,"Wow","facebook",3,6,4,7,"#f0ba15"),
(12,' . $this->conf['storagePid'] . ',1458399745,1458399745,0,"Sad","facebook",4,3,5,3,"#f0ba15"),
(13,' . $this->conf['storagePid'] . ',1458399932,1458399904,0,"Angry","facebook",5,1,6,1,"#f7714b"),
(14,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Dislike","facebook",2,2,7,4,""),
(15,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Like","food",1,8,1,7,""),
(16,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Yummie","food",1,9,2,9,"#e44134"),
(17,' . $this->conf['storagePid'] . ',1458399799,1458399689,0,"Hungry","food",2,7,3,6,"#67bd2a"),
(18,' . $this->conf['storagePid'] . ',1458399704,1458399704,0,"Fat","food inactive",3,6,4,7,"#cccccc"),
(19,' . $this->conf['storagePid'] . ',1458399745,1458399745,0,"Beurk","food",4,3,5,3,"#d066a6"),
(20,' . $this->conf['storagePid'] . ',1458399932,1458399904,0,"Yuck","food",5,1,6,1,"#b9a700"),
(21,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Dislike","food",2,2,7,4,""),
(22,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Like","news",1,8,1,7,""),
(23,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Yay","news  inactive",1,9,2,9,"#cc67d3"),
(24,' . $this->conf['storagePid'] . ',1458399799,1458399689,0,"Ohyes","news",2,7,3,6,"#ce9d00"),
(25,' . $this->conf['storagePid'] . ',1458399704,1458399704,0,"Kkkk","news",3,6,4,7,"#ec7022"),
(26,' . $this->conf['storagePid'] . ',1458399745,1458399745,0,"Yawn","news",4,3,5,3,"#8a95a1"),
(27,' . $this->conf['storagePid'] . ',1458399932,1458399904,0,"Fedup","news",5,1,6,1,"#b5263c"),
(28,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Dislike","news",2,2,7,4,""),
(29,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Like","music",1,8,1,7,""),
(30,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Love","music",1,9,2,9,"#e12d8d"),
(31,' . $this->conf['storagePid'] . ',1458399799,1458399689,0,"Dance","music",2,7,3,6,"#da2c36"),
(32,' . $this->conf['storagePid'] . ',1458399704,1458399704,0,"Sing","music",3,6,4,7,"#e185d7"),
(33,' . $this->conf['storagePid'] . ',1458399745,1458399745,0,"Ninja","music",4,3,5,3,"#608098"),
(34,' . $this->conf['storagePid'] . ',1458399799,1458399658,0,"Dislike","music",2,2,7,4,"")');
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

	/**
	 * detects if browser is tablet or handy, special handling for firefox on tablet.
	 *
	 * @param	boolean		$isTabletOrHandyexceptFF: ...
	 * @return	boolean		TRUE if mobile, FALSE if not
	 */
	private function detectmobile($isTabletOrHandyexceptFF = FALSE){
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$useragents = array (
				'iPhone',
				'iPod',
				'iPad',
				'Android',
				'PlayBook',
				'Kindle',
				'Opera Mobi',
				'Windows Phone',
				'BlackBerry',
				'webOS'
		);

		$result = FALSE;
		foreach ( $useragents as $useragent ) {
			if (preg_match('/'.$useragent.'/i', $agent)){
				$result = TRUE;
			}

		}

		if ($isTabletOrHandyexceptFF == TRUE){
			if (str_replace('Firefox', '', $agent) != $agent) {
				$result = FALSE;
			}

		}

		return $result;
	}


	/**
	 * returns ReportUser according loggin-state and plugin-mode
	 *
	 * @param	int		$ReportPluginMode:  Cache-Type (2, 3 ,4 ...)
	 * @return	string		$ret (holding $ReportUser)
	 */
	protected function getReportUser($ReportPluginMode) {
		if (intval($GLOBALS['TSFE']->fe_user->user['uid']) > 0) {
			// 1: recent comments, 3: topratings, 4: other reports, 6: user center, 8: topsharings

			if ($ReportPluginMode == 6) {
				$ret = intval($GLOBALS['TSFE']->fe_user->user['uid']);
			} else {
				$ret = 1;
			}

		} else {
			$ret = 0;
		}

		return $ret;
	}
	
	/**
	 * returns html with missing alt tags, empty alt-Tags with filled alt tags taking the value from the title-attrubute
	 *
	 * @param	string		$content:  HTML to work on
	 * @return	string		$content:  fixed HTML
	 */
	protected function w3cIzer($content) {
		$contentimgarr = explode('<img', $content);
		$cntcontentimgarr = count($contentimgarr);
		for ($img = 1; $img<$cntcontentimgarr; $img++) {
			$contentsnglimgarr = explode('>', $contentimgarr[$img]);
			$contentsnglimg = $contentsnglimgarr[0];
			if (str_replace(' alt=""', '', $contentsnglimg) != $contentsnglimg) {
				// alttag empty
				if (str_replace(' title="', '', $contentsnglimg) != $contentsnglimg) {
					// title present
					$contentsnglimgtitlearr = explode('title="', $contentsnglimg);
					$contentsnglimgtitlearr2 = explode('"', $contentsnglimgtitlearr[1]);
					$title = $contentsnglimgtitlearr2[0];
					if (trim($title) != '') {
						$contentsnglimg = str_replace(' alt=""', ' alt="' . $title . '"', $contentsnglimg);
					}
				}
			} elseif (str_replace(' alt=', '', $contentsnglimg) == $contentsnglimg) { 
				// no altttag at all
				if (str_replace(' title="', '', $contentsnglimg) != $contentsnglimg) {
					// title present
					$contentsnglimgtitlearr = explode('title="', $contentsnglimg);
					$contentsnglimgtitlearr2 = explode('"', $contentsnglimgtitlearr[1]);
					$title = $contentsnglimgtitlearr2[0];
					if (trim($title) != '') {
						$contentsnglimg = str_replace(' title="', ' alt="' . $title . '" title="', $contentsnglimg);
					}
				}
			} 
			
			$contentsnglimgarr[0] = $contentsnglimg;
			$contentimgarr[$img] = implode('>', $contentsnglimgarr);
			
		}
		
		$content = implode('<img', $contentimgarr);
		$content = str_replace(' size="" ', ' ', $content);
		$content = str_replace(' action=""', ' ', $content);
		$content = str_replace(' align="right"', ' ', $content);
		$content = str_replace(' align="left"', ' ', $content);
		$content = str_replace(' border="0"', ' ', $content);
		return $content;
	}


}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.toctoc_comments_pi1.php']);
}
?>