<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *   59: class toctoc_comments_common
 *  110:     public function unmirrorConf($confDiff)
 *  145:     public function start_toctoccomments_session($expireTimeInMinutes, $sessionSavePathSaved = '')
 *  196:     private function getSessionSavePath()
 *  216:     private function ensureSessionSavePathExists($sessionSavePath)
 *
 * TOTAL FUNCTIONS: 4
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

	/**
	 * the cookie to store the session ID of the install tool
	 *
	 * @var string
	 */
	private $cookieName = 'TocTocComments';
	private $extKey = 'toctoc_comments';
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
	 * adds the conf-difference again to the mirror of the conf
	 * and reconstuct the full conf
	 *
	 * @param	array		$confDiff: difference to the mirrorconf
	 * @return	array		$confout: rebuilt conf
	 */
	public function unmirrorConf($confDiff) {
		$this->start_toctoccomments_session(3*1440);
		if (intval($_SESSION['dontUseMirrorConf']) == 0) {
			if (isset($_SESSION['mirrorconf'])) {
				$mirrorconf=array();

				$mirrorconf=unserialize(base64_decode($_SESSION['mirrorconf']));
				if (is_array($confDiff)) {
					if (is_array($mirrorconf)) {
						$confout = array_replace_recursive($mirrorconf, $confDiff);
					} else {
						$confout = '';
					}

				} else {
					$confout = $mirrorconf;
				}

			} else {
				$confout = '';
			}

			return $confout;
		} else {
			return $confDiff;
		}
	}

	/**
	 * Starts and handles Session used
	 *
	 * @param	[type]		$expireTimeInMinutes: ...
	 * @param	[type]		$sessionSavePathSaved: ...
	 * @return	[type]		...
	 */
	public function start_toctoccomments_session($expireTimeInMinutes, $sessionSavePathSaved = '') {
		$this->expireTimeInMinutes=intval($expireTimeInMinutes);
		$this->typo3tempPath = PATH_site . 'typo3temp/';
		// Start our PHP session early so that hasSession() works
		if ($sessionSavePathSaved == '') {
			if(TYPO3_version == 'TYPO3_version') {
				$sessionSavePath =  @file_get_contents(realpath(dirname(__FILE__)) . '/sessionpath.tmp');
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

		session_name('sess_' . $this->extKey);
		session_save_path($sessionSavePath);

		ini_set('session.gc_probability', 100);
		ini_set('session.gc_divisor', 100);
		ini_set('session.gc_maxlifetime', $this->expireTimeInMinutes*60);
 		session_start();
 		if ($sessionSavePathSaved == '') {
 			if (TYPO3_version != 'TYPO3_version') {
 				if (!(file_exists(realpath(dirname(__FILE__)) . '/sessionpath.tmp'))) {
			 		if (version_compare(TYPO3_version, '6.0', '<')) {
			 			t3lib_div::writeFile(realpath(dirname(__FILE__)) . '/sessionpath.tmp', $sessionSavePath);
			 		} else	{
			 			\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile(realpath(dirname(__FILE__)) . '/sessionpath.tmp', $sessionSavePath);
			 		}

 				}

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
		return $sessionSavePath;
	}
	/**
	 * Create directories for the session save path
	 * and throw an exception if that fails.
	 *
	 * @param	string		$sessionSavePath The absolute path to the session files
	 * @return	[type]		...
	 * @throws \RuntimeException
	 */
	private function ensureSessionSavePathExists($sessionSavePath) {
		$indexContent = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">';
		$indexContent .= '<HTML><HEAD<TITLE></TITLE><META http-equiv=Refresh Content="0; Url=../../">';
		$indexContent .= '</HEAD></HTML>';
		if (!is_dir($sessionSavePath)) {
			if (version_compare(TYPO3_version, '6.0', '<')) {
				try {

					$subpath = str_replace('/%s', '', $this->sessionPath);

					t3lib_div::mkdir_deep($this->typo3tempPath, $subpath);
					t3lib_div::mkdir_deep($this->typo3tempPath . '/' . $subpath . '/', md5('session:' .	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword']));
				} catch (\RuntimeException $exception) {
					throw new \RuntimeException('Could not create session folder "' . $sessionSavePath . '". Make sure typo3temp/ is writeable!', 1294587484);
				}

				t3lib_div::writeFile($sessionSavePath . '/.htaccess', 'Order deny, allow' . '
' . 'Deny from all' . '
');
				t3lib_div::writeFile($sessionSavePath . '/index.html', $indexContent);
			} else {
				try {
					\TYPO3\CMS\Core\Utility\GeneralUtility::mkdir_deep($sessionSavePath);
				} catch (\RuntimeException $exception) {
					throw new \RuntimeException('Could not create session folder in typo3temp/. Make sure it is writeable!', 1294587484);
				}
				\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile($sessionSavePath . '/.htaccess', 'Order deny, allow' . '
' . 'Deny from all' . '
');
				\TYPO3\CMS\Core\Utility\GeneralUtility::writeFile($sessionSavePath . '/index.html', $indexContent);
			}

		}

	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_common.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_common.php']);
}
?>