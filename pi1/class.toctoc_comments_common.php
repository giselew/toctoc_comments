<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2015 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *   61: class toctoc_comments_common
 *  113:     public function unmirrorConf($confDiff)
 *  148:     public function start_toctoccomments_session($expireTimeInMinutes, $sessionSavePathSaved = '')
 *  226:     private function getSessionSavePath()
 *  247:     private function ensureSessionSavePathExists($sessionSavePath, $dohtaccess = TRUE)
 *  310:     public function substGifbuilder ($contentdir, $filename, $imgsize)
 *  430:     private function getGifBuilderSavePath()
 *
 * TOTAL FUNCTIONS: 6
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
		// no sessions for bots
		$interestingCrawlers = array('googlebot', 'yahoo', 'baidu', 'msnbot', 'bingbot', 'spider', 'bot.htm', 'yandex', 'jeevez');
		$numMatches = 0;
		$countinterestingCrawlers = count($interestingCrawlers);
		for ($i=0; $i<$countinterestingCrawlers; $i++){
			if (str_replace(strtolower($interestingCrawlers[$i]), '', strtolower($_SERVER['HTTP_USER_AGENT'])) != strtolower($_SERVER['HTTP_USER_AGENT'])) {
				$numMatches++;
			}
		}
		if($numMatches > 0) {
			return;
		}
		// end

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

		$this->expireTimeInMinutes = intval($expireTimeInMinutes);
		$this->typo3tempPath = $PATH_site . 'typo3conf/ext/toctoc_comments/pi1/sessionTemp/';

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
			switch(strtolower($ext)) {
				case 'gif':
					imagegif($image_p, $savepathfilename);
					break;
				case 'png':
					imagepng($image_p, $savepathfilename, 0);
					break;
				case 'bmp':
					imagewbmp($image_p, $savepathfilename);
					break;
				case 'jpg':
					imagejpeg($image_p, $savepathfilename, 100);
					break;
				case 'jpeg':
					imagejpeg($image_p, $savepathfilename, 100);
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