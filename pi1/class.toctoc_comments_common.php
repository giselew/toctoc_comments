<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * class.toctoc_comments_common.php
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
 *   62: class toctoc_comments_common
 *  115:     public function stop_toctoccomments_session()
 *  161:     public function start_toctoccomments_session($expireTimeInMinutes, $sessionSavePathSaved = '', $conf = array(), $frompi1 = FALSE)
 *  447:     public function removegarbagesessions($sessIp)
 *  529:     private function getSessionSavePath()
 *  552:     private function ensureSessionSavePathExists($sessionSavePath, $dohtaccess = TRUE)
 *  615:     public function substGifbuilder ($contentdir, $filename, $imgsize)
 *  737:     private function getGifBuilderSavePath()
 *
 * TOTAL FUNCTIONS: 7
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
class toctoc_comments_common {
	/**
	 * The path to our typo3temp (where we can write our sessions). Set in the
	 * constructor.
	 *
	 * @var string
	 */
	private $typo3tempPath;

	/**
	 * Path where to store our session files in typo3temp. %s will be
	 * non-guessable.
	 *
	 * @var string
	 */
	private $sessionPath = 'TocTocCommentsSessions/%s';
	private $picsPath = 'TocTocCommentsSessions/%s';

	/**
	 * the cookie to store the session ID
	 *
	 * @var string
	 */
	public $extKey = 'toctoc_comments';
	/**
	 * time (minutes) to expire an ununsed session
	 *
	 * @var integer
	 */
	private $expireTimeInMinutes = 60;

	/**
	 * time (minutes) to generate a new session id for our current session
	 *
	 * @var integer
	 */
	private $regenerateSessionIdTime = 5;

	/**
	 * part of the referer when the install tool has been called from the backend
	 *
	 * @var string
	 */
	private $backendFile = 'index.php';

	/**
	 * Starts and handles Session used
	 *
	 * @param	[type]		$expireTimeInMinutes: ...
	 * @param	[type]		$sessionSavePathSaved: ...
	 * @param	[type]		$conf: ...
	 * @return	[type]		...
	 */
	public function stop_toctoccomments_session() {

		$newSessionModule = $_SESSION['cSModule'];
		$newSessionName = $_SESSION['cSName'];
		$newSessionPath = $_SESSION['cSPath'];
		$newSessiongc_probability = $_SESSION['cSgcPr'];
		$newSessiongc_divisor = $_SESSION['cSgcDv'];
		$newSessiongc_maxlifetime = $_SESSION['cSgcMl'];
		$sessionwasset = $_SESSION['cSwasSet'];

		session_write_close();

		if (trim($newSessionName) != 'sess_toctoc_comments') {
			if (trim($newSessionName) != '') {
				session_name($newSessionName);
			}

			session_save_path($newSessionPath);

			if (trim($newSessionModule) != '') {
				session_module_name($newSessionModule);
			}

		}

		if (trim($newSessiongc_probability) != '') {
			ini_set('session.gc_probability', $newSessiongc_probability);
		}

		if (trim($newSessiongc_divisor) != '') {
			ini_set('session.gc_divisor', $newSessiongc_divisor);
		}

		if (trim($newSessiongc_maxlifetime) != '') {
			ini_set('session.gc_maxlifetime', $newSessiongc_maxlifetime);
		}
	}
	/**
	 * Starts and handles Session used
	 *
	 * @param	[type]		$expireTimeInMinutes: ...
	 * @param	[type]		$sessionSavePathSaved: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$frompi1: ...
	 * @return	[type]		...
	 */
	public function start_toctoccomments_session($expireTimeInMinutes, $sessionSavePathSaved = '', $conf = array(), $frompi1 = FALSE) {
		//check if pic is in temp and them move the 2 pics in attachments
		$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/pi1');
		$PATH_site = str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR;
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$PATH_site = str_replace(DIRECTORY_SEPARATOR, '/', $PATH_site);
		}

		if (!defined('TYPO3_version')) {
			define('TYPO3_version', 'TYPO3_version');
		}
		// no sessions for bots
		$interestingCrawlers = array('googlebot','yahoo','baidu','msnbot','bingbot','spider','bot.htm','yandex','jeevez');
		$interestingWhiteCrawlersConf = array();
		if (count($conf)>2) {
			$interestingCrawlersConf = explode(',', $conf['advanced.']['blacklistCrawlerAgentStrings']);

			$tmparr = array_merge($interestingCrawlers, $interestingCrawlersConf);
			$interestingCrawlers = array_unique($tmparr);

			$interestingWhiteCrawlersConf = explode(',', $conf['advanced.']['whitelistCrawlerAgentStrings']);
			$interestingWhiteCrawlersConf = array_unique($interestingWhiteCrawlersConf);
		}

		$numcookies = count($_COOKIE);
		$strPhpCookies = '';

		while ($cookieel = current($_COOKIE)) {
			$strPhpCookies .= key($_COOKIE) . '-';
			next($_COOKIE);
		}

		if ($strPhpCookies != '') {
			if (strlen($strPhpCookies) >1) {
				$strPhpCookies = substr($strPhpCookies, 0, (strlen($strPhpCookies) -1));
			}

		}

		$numMatches = 0;
		$countinterestingCrawlers = count($interestingCrawlers);
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
				if (intval($conf['advanced.']['dontTakeEmptyAgentStringAsCrawler']) == 0) {
					$numMatches++;
				}

			}

		} else {
			if (intval($conf['advanced.']['dontTakeEmptyAgentStringAsCrawler']) == 0) {
					$numMatches++;
			}

		}

		if (($numMatches > 0) || ($foundwhite == 1)) {
			if (count($conf) > 2) {
				if ($conf['advanced.']['protocolCrawlerAgents'] == 1) {
					if (($numMatches > 0)) {
						$protocol = '';
						if ($_SERVER['HTTP_USER_AGENT']){
							if (trim($_SERVER['HTTP_USER_AGENT']) != ''){
								$protocol = 'BL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . $_SERVER['HTTP_USER_AGENT'] . ' idfd "' . $identstr . '"@@-@@-';
							}

						}

						if ($protocol == ''){
							$protocol = 'BL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . 'HTTP_USER_AGENT missing' . ' idfd "' . $identstr . '"@@-@@-';

						}

					} else {
						$protocol = 'WL: ' . strftime('%Y/%m/%d %H:%M:%S', microtime(TRUE)) . ': ' . $_SERVER['HTTP_USER_AGENT'] . ' idfd "' . $identstr . '"@@-@@-';
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
						$testelem= 	$contentarr[count($contentarr)-1];
						$testelemarr = explode('@@', $testelem);
						$testelemarrhua = explode(' idfd "', $testelemarr[0]);
						$testelemarrhua2 = explode(': ', $testelemarrhua[0]);
						$hua = $testelemarrhua2[count($testelemarrhua2)-1];
						if (($hua != $_SERVER['HTTP_USER_AGENT']) || ($testelemarr[1] != '-') || ($testelemarr[2] != '-')) {
							$protocol = str_replace("\r\n", ', ', $protocol);
							$protocol = str_replace("\n", ', ', $protocol);

							$content = $content . "\r\n" . $protocol;
							$contentarr = explode("\r\n", $content);
							if (count($contentarr) > $conf['advanced.']['protocolCrawlerAgentsMaxLines']) {
								array_shift($contentarr);
								$content = implode("\r\n", $contentarr);
							}

							// Write the contents back to the file
							file_put_contents(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'crawlerprotocol.txt', $content);
						}

					}

				}

			}

		}

		if($numMatches > 0) {
			return;
		}
		// end

		$this->expireTimeInMinutes = intval($expireTimeInMinutes);
		$this->typo3tempPath = $PATH_site . 'typo3conf/ext/toctoc_comments/pi1/sessionTemp/';

		// Start our PHP session early so that hasSession() works
		if ($sessionSavePathSaved == '') {
			$sessionSavePath =  @file_get_contents(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'sessionpath.tmp');

			if(TYPO3_version == 'TYPO3_version') {

				$sessionSavePathSaved = $sessionSavePath;
			} else {
				if (version_compare(TYPO3_version, '6.0', '<')) {
					$sitepath=t3lib_div::getIndpEnv('TYPO3_SITE_PATH');
				} else {
					$sitepath=\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_PATH');
				}

				$sessionSavePath = $this->getSessionSavePath();
			}

		} else {
			$sessionSavePath = $sessionSavePathSaved;
		}

 		if ($sessionSavePathSaved == '') {
 			if (TYPO3_version != 'TYPO3_version') {
 				if (!(file_exists(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'sessionpath.tmp'))) {
			 		if (version_compare(TYPO3_version, '6.0', '<')) {
			 			t3lib_div::writeFile(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'sessionpath.tmp', $sessionSavePath);
			 		} else	{
			 			\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'sessionpath.tmp', $sessionSavePath);
			 		}

 				}

 			}

 		}

 		$sessionwasset='no';
 		$hascookie= trim($_COOKIE['sess_' . $this->extKey]);
 		$nosession = FALSE;

 		if ($hascookie != '') {
 			$sessionwasset='yes';
 		} else {
 			if (!$frompi1) {
 				$nosession = TRUE;
 			}
 		}

 		if (!$nosession) {
	 		$currentSessionModule = session_module_name();
	 		$currentSessionName = session_name();
	 		$currentSessionPath = session_save_path();
	 		if (isset($_SESSION)) {
		 		session_write_close();
	 		}
	 		session_name('sess_' . $this->extKey);
	 		session_save_path($sessionSavePath);
			$currentSessiongc_probability = ini_get('session.gc_probability');
			$currentSessiongc_divisor = ini_get('session.gc_divisor');
			$currentSessiongc_maxlifetime = ini_get('session.gc_maxlifetime');

	 		ini_set('session.gc_probability', 100);
	 		ini_set('session.gc_divisor', 100);
	 		ini_set('session.gc_maxlifetime', $this->expireTimeInMinutes*60);

	 		if ($hascookie != '') {
	 			session_id($hascookie);
	 		}

	 		session_start();
	 		if ($currentSessionPath != $sessionSavePath) {
		 		$_SESSION['cSModule'] = $currentSessionModule;
		 		$_SESSION['cSName'] = $currentSessionName;
		 		$_SESSION['cSPath'] = $currentSessionPath;
		 		$_SESSION['cSgcPr'] = $currentSessiongc_probability;
		 		$_SESSION['cSgcDv'] = $currentSessiongc_divisor;
		 		$_SESSION['cSgcMl'] = $currentSessiongc_maxlifetime;
		 		$_SESSION['cSwasSet'] = $sessionwasset;
		 		$cSId = session_id();
	 		} else {
	 			if (!isset($_SESSION['cSModule'])) {
	 				$_SESSION['cSwasSet'] = 'no';
	 			}
	 		}

	 		if (!isset($_SESSION['cSId'])) {
	 			$_SESSION['cSId'] = $cSId;
	 		} else {
	 			if ($_SESSION['cSId'] != $cSId) {
	 				$error = '<div>PHP-Session Error: recreated new session id "' . $cSId . '", but new Session is holding value of old session id "' . $_SESSION['cSId'] . '".';
	 				$error .= '<br><b>You need to enable cookies in your browser or use a browser able to handle cookies in order to use plugin toctoc_comments</b></div>';
	 				echo $error;
	 				session_destroy();
	 				exit;
	 			}
	 		}

	 		$_SESSION['PHPCookie'] = $numcookies;
			if (($numcookies > 0) && ($strPhpCookies !='')) {
	 			$_SESSION['strPHPCookies'] = $strPhpCookies;
			}

		 	if (!isset($_SESSION['StartTime'])) {
	 			$_SESSION['StartTime'] =  microtime(TRUE);
	 		}

	 		if (!isset($_SESSION['numberOfPages'])) {
	 			$_SESSION['numberOfPages'] =  0;
	 		}

	 		if (!isset($_SESSION['CurrentIP'])) {
	 			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		 			if (preg_match('/^\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
		 				$currip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		 			}
	 			}

	 			$currip = t3lib_div::getIndpEnv('REMOTE_ADDR');
	 			$_SESSION['CurrentIP'] =  $currip;
	 		}

	 		if (!isset($_SESSION['toctoc_user'])) {
	 			if (isset($GLOBALS['TSFE'])) {
			 		if (intval($GLOBALS['TSFE']->fe_user->user['uid']) == 0) {
			 			$_SESSION['toctoc_user'] = '' . t3lib_div::getIndpEnv('REMOTE_ADDR') . '.0';
			 		} else {
			 			$_SESSION['toctoc_user'] = '0.0.0.0.' . $GLOBALS['TSFE']->fe_user->user['uid'];
			 		}
	 			}
	 		}
 		}

	}
	/**
	 * Removes sessions created by client that do not accept cookies
	 *
	 * @param	[type]		$sessIp: ...
	 * @return	[type]		...
	 */
	public function removegarbagesessions($sessIp) {
		$sessionfiles = array();
		$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/pi1');
		$PATH_site = str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR;
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$PATH_site = str_replace(DIRECTORY_SEPARATOR, '/', $PATH_site);
		}
		$this->typo3tempPath = $PATH_site . 'typo3conf/ext/toctoc_comments/pi1/sessionTemp/';

		$getSessionSavePath = $this->getSessionSavePath();
		/// read path to sessiondirectory in .tempfile
		if (is_dir($getSessionSavePath)) {
			$d = dir($getSessionSavePath);
		}

		$sessionid = session_id();
		if (is_dir($getSessionSavePath)) {
			if ($d != FALSE){
				// dir the sessionfiles
				$i=0;
				while (FALSE !== ($entry = $d->read())) {
					$filesess_id = str_replace('sess_', '', $entry);
					if ($filesess_id != $entry) {
						if ($filesess_id != $sessionid) {
							$filetime = 0;
							$filetime = @filemtime($getSessionSavePath . DIRECTORY_SEPARATOR . $entry);
							if ($filetime == 0) {
								$filetime = $i;
							}
							$sessionfiles[$filetime] = array();
							$sessionfiles[$filetime]['SessionName'] = $entry;
							$i++;
						}
					}

				}

				$d->close();
			}
		}
		krsort($sessionfiles);

		$iffiles = 0;
		$foundsessionfiles = array();

		foreach($sessionfiles as $sessionfile) {

			$filefullpath = $getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'];

			$Sessioncontent='';
			if (file_exists($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'])) {
				$Sessioncontent = substr(file_get_contents($getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName']), 0, 1000);
			}

			if (str_replace('"' .$sessIp  . '"', '', $Sessioncontent) != $Sessioncontent) {
				//hit 1, Other sessionfile contains same IP

				if (str_replace('PHPCookie|i:0', '', $Sessioncontent) != $Sessioncontent) {
					//hit 2, Other sessionfile says has no Cookies, regardless of useragent - we kill it
					$foundsessionfiles[$iffiles] = $getSessionSavePath . DIRECTORY_SEPARATOR . $sessionfile['SessionName'];
					$iffiles++;
				}

			}
		}

		$countfoundfiles = count($foundsessionfiles);

		for ($i=0; $i<$countfoundfiles; $i++){
				if (file_exists($foundsessionfiles[$i])) {
					unlink($foundsessionfiles[$i]);
				}

		}

	}
	/**
	 * Returns the path where to store our session files
	 *
	 * @return	[type]		...
	 */
	private function getSessionSavePath() {

		if (version_compare(TYPO3_version, '6.0', '<')) {
			$sessionSavePath = sprintf($this->typo3tempPath . $this->sessionPath, md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
		} else {
			$sessionSavePath = sprintf($this->typo3tempPath . $this->sessionPath, \TYPO3\CMS\Core\Utility\GeneralUtility::hmac('session:' .
						$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
		}

		$this->ensureSessionSavePathExists($sessionSavePath);
		$sessionSavePath = str_replace('/', DIRECTORY_SEPARATOR, $sessionSavePath);
		$sessionSavePath = str_replace('\\', DIRECTORY_SEPARATOR, $sessionSavePath);
		return $sessionSavePath;
	}
	/**
	 * Create directories for the session save path
	 * and throw an exception if that fails.
	 *
	 * @param	string		$sessionSavePath The absolute path to the session files
	 * @param	[type]		$dohtaccess: ...
	 * @return	[type]		...
	 * @throws \RuntimeException
	 */
	private function ensureSessionSavePathExists($sessionSavePath, $dohtaccess = TRUE) {
		$indexContent = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">';
		$indexContent .= '<HTML><HEAD<TITLE></TITLE><META http-equiv=Refresh Content="0; Url=../../">';
		$indexContent .= '</HEAD></HTML>';
		if (!is_dir($sessionSavePath)) {
			if (version_compare(TYPO3_version, '6.0', '<')) {
				try {

					if ($dohtaccess == FALSE) {
						$subpath = str_replace('/%s', '', $this->picsPath);
					} else {
						$subpath = str_replace('/%s', '', $this->sessionPath);
					}
					if (version_compare(TYPO3_version, '4.5.99', '>')) {
						t3lib_div::mkdir_deep($this->typo3tempPath, $subpath);
						t3lib_div::mkdir_deep($this->typo3tempPath . '/' . $subpath . '/', md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
					} else {
						if (!is_dir($this->typo3tempPath)) {
							mkdir($this->typo3tempPath);
						}
						if (!is_dir($this->typo3tempPath . '/' . $subpath)) {
							mkdir($this->typo3tempPath . '/' . $subpath);
						}
						if (!is_dir($this->typo3tempPath . '/' . $subpath . '/' . md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']))) {
							mkdir($this->typo3tempPath . '/' . $subpath . '/' . md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
						}
					}
				} catch (\RuntimeException $exception) {
					throw new \RuntimeException('Could not create session folder "' . $sessionSavePath . '". Make sure toctoc_comments/pi1/ is writeable!', 1294587484);
				}
				if ($dohtaccess == TRUE) {
					t3lib_div::writeFile($sessionSavePath . '/.htaccess', 'Order deny, allow' . '
' . 'Deny from all' . '
');
					t3lib_div::writeFile($sessionSavePath . '/index.html', $indexContent);
				}

			} else {
				try {
					\TYPO3\CMS\Core\Utility\GeneralUtility::mkdir_deep($sessionSavePath);
				} catch (\RuntimeException $exception) {
					throw new \RuntimeException('Could not create session folder in typo3temp/. Make sure it is writeable!', 1294587484);
				}
				if ($dohtaccess == TRUE) {
					\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile($sessionSavePath . '/.htaccess', 'Order deny, allow' . '
' . 'Deny from all' . '
');
					\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile($sessionSavePath . '/index.html', $indexContent);
				}
			}

		}

	}
	/**
	 * Substitute for slow GIFBUILDER, just for scaling .
	 *
	 * @param	string		$contentdir
	 * @param	string		$filename
	 * @param	int		$imgsize
	 * @return	[type]		...
	 * @throws \RuntimeException
	 */
	public function substGifbuilder ($contentdir, $filename, $imgsize) {
		$targetwidth = $imgsize;
		$targetheight = $imgsize;
		$txdirname= str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $contentdir);
		$savepathfilename = $txdirname . $filename;
		$ext = substr($filename, 1+strrpos($filename, '.'));

		list($width, $height, $typeimg, $attr) = getimagesize($savepathfilename);

		if (isset($typeimg) && in_array($typeimg, array(
				IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_WBMP))) {
			if ($typeimg==3) {
				$ext = 'png';
			} elseif ($typeimg==2) {
				$ext = 'jpg';
			}elseif ($typeimg==1) {
				$ext = 'gif';
			}elseif ($typeimg==4) {
				$ext = 'bmp';
			} else  {
				return FALSE;
			}

		} else  {
			return FALSE;
		}

		if ((strtoupper($ext) == 'JPG') || (strtoupper($ext) == 'JPEG')) {
			$image = imagecreatefromjpeg($savepathfilename);
		} elseif (strtoupper($ext) == 'GIF') {
			$image = imagecreatefromgif($savepathfilename);
		} elseif (strtoupper($ext) == 'PNG') {
			$image = imagecreatefrompng($savepathfilename);
		} elseif (strtoupper($ext) == 'BMP') {
			$image = imagecreatefromwbmp ($savepathfilename);
		} else {
			return FALSE;
		}

		if ($image) {
			$txdirname= $this->getGifBuilderSavePath();
			$savepathfilename= $txdirname . DIRECTORY_SEPARATOR . $filename;
			$image_p = imagecreatetruecolor($targetwidth, $targetheight);

			// handle transparancy
			if ((strtoupper($ext) == 'GIF') || (strtoupper($ext) == 'PNG')) {
				$trnprt_indx = imagecolortransparent($image);
				// If we have a specific transparent color
				if (($trnprt_indx >= 0) && ($trnprt_indx < 254)) {
					// Get the original image's transparent color's RGB values
					$nmbr_color  = imagecolorstotal($image);
					$trnprt_color  = imagecolorsforindex($image, $trnprt_indx);
					// Allocate the same color in the new image resource
					if ($trnprt_color) {
						$trnprt_indx = imagecolorallocate($image_p, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
						// Completely fill the background of the new image with allocated color.
						imagefill($image_p, 0, 0, $trnprt_indx);
						// Set the background color for new image to transparent
						imagecolortransparent($image_p, $trnprt_indx);
					}

				} elseif (strtoupper($ext) =='PNG') {
					// Turn off transparency blending (temporarily)
					imagealphablending($image_p, FALSE);
					// Create a new transparent color for image
					$tspcolor = imagecolorallocatealpha($image_p, 0, 0, 0, 127);
					// Completely fill the background of the new image with allocated color.
					imagefill($image_p, 0, 0, $tspcolor);
					// Restore transparency blending
					imagesavealpha($image_p, TRUE);
				}

			}
			$sizerel = $width/$height;
			if ($sizerel > 1) {
				$srcy = 0;
				$dimdiff = $width-$height;
				$srcx = round(($dimdiff/2), 0);
			} else {
				$srcx = 0;
				$dimdiff = $height-$width;
				$srcy = round(($dimdiff/2), 0);
			}

			imagecopyresampled($image_p, $image, 0, 0, $srcx, $srcy, $targetwidth, $targetheight, $width-2*$srcx, $height-2*$srcy);
			$quality = $GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality'];
			switch(strtolower($ext)) {
				case 'gif':
					imagegif($image_p, $savepathfilename);
					break;
				case 'png':
					// little fixed compression
					imagepng($image_p, $savepathfilename, 3, PNG_ALL_FILTERS);
					break;
				case 'bmp':
					imagewbmp($image_p, $savepathfilename);
					break;
				case 'jpg':
					imagejpeg($image_p, $savepathfilename, intval($quality));
					break;
				case 'jpeg':
					imagejpeg($image_p, $savepathfilename, intval($quality));
					break;
				default:
					return FALSE;

			}
			if (file_exists($savepathfilename) == FALSE) {
				print 'Error in userpicturefile generation: no file_exists for ' . $savepathfilename;
				exit;
			}
			imagedestroy($image_p);
		}

		$savepathfilename = str_replace(DIRECTORY_SEPARATOR, '/', (str_replace($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR, '', $savepathfilename)));
		return $savepathfilename;
	}
	/**
	 * Returns the full-path where to store our user pictures
	 *
	 * @return	[type]		...
	 */
	private function getGifBuilderSavePath() {
		$repstr= str_replace('/', DIRECTORY_SEPARATOR, '/typo3conf/ext/toctoc_comments/pi1');
		$PATH_site =str_replace($repstr, '', dirname(__FILE__)) . DIRECTORY_SEPARATOR;
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$PATH_site= str_replace(DIRECTORY_SEPARATOR, '/', $PATH_site);
		}

		$typo3tempPath = $PATH_site . 'typo3temp/';
		$UserimagesPath = 'TocTocCommentsUserimages/%s';
		$this->picsPath = $UserimagesPath;
		$this->typo3tempPath = $PATH_site . 'typo3temp/';

		if (version_compare(TYPO3_version, '6.0', '<')) {
			$sessionSavePath = sprintf($typo3tempPath . $UserimagesPath, md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
		} else {
			$sessionSavePath = sprintf($typo3tempPath . $UserimagesPath, \TYPO3\CMS\Core\Utility\GeneralUtility::hmac('session:' .
					$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
		}

		$this->ensureSessionSavePathExists($sessionSavePath, FALSE);
		$sessionSavePath = str_replace('/', DIRECTORY_SEPARATOR, $sessionSavePath);

		return $sessionSavePath;
	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_common.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_common.php']);
}
?>