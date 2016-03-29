<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * class.toctoc_comments_ajax.php
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
 *   75: class toctoc_comments_captcha
 *   94:     public function getCaptcha($captchatype, $cid)
 *  244:     public function chkcaptcha($cid, $code, $noecho = FALSE)
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(PATH_tslib . 'class.tslib_pibase.php');
	if (!version_compare(TYPO3_version, '4.6', '<')) {
		require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
	}
	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
}
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}
require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_common.php'));



/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_captcha {
	// constants for captcha generation of freecap-clone
	private $capchafreecapbackgoundcolor = '255, 255, 255';
	//valid rgb
	private $capchafreecaptextcolor = '95, 117, 200';
	//valid rgb
	private $capchafreecapnumberchars = 5;
	//max is 10, min is 3
	private $capchafreecapheight = 23;
	private $commonObj;


	/**
	 * Returns a captcha image
	 *
	 * @param	int		$captchatype: type of captcha
	 * @param	int		$cid: content element id
	 * @return	image
	 */
	public function getCaptcha($captchatype, $cid) {
		$opensess = TRUE;
		if(isset($_SESSION)) {
			if (isset($_SESSION['cSModule'])) {
				$opensess = FALSE;
			}
		}
		if ($opensess == TRUE) {
			if (!(isset($this->commonObj))) {
				require_once (str_replace(DIRECTORY_SEPARATOR . 'pi2', DIRECTORY_SEPARATOR . 'pi1', realpath(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'class.toctoc_comments_common.php');
				$this->commonObj = new toctoc_comments_common;
			}

			$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
			$sessionTimeout=3*1440;
			$this->commonObj->start_toctoccomments_session($sessionTimeout);
		}

		$string = '';
		$reportstr = '';
		$dir = 'typo3conf/ext/toctoc_comments/pi1/fonts/';
		$sessionindex = 'random_number' . $cid . '';
		if($captchatype === '1') {
			//sr_freecap style
			if (intval($this->capchafreecapnumberchars) > 10) {
				$this->capchafreecapnumberchars = 10;
			}

			if (intval($this->capchafreecapnumberchars) < 3) {
				$this->capchafreecapnumberchars = 3;
			}

			if (intval($this->capchafreecapheight) > 50) {
				$this->capchafreecapheight = 50;
			}

			if (intval($this->capchafreecapheight) < 23) {
				$this->capchafreecapheight = 23;
			}

			for($i = 0; $i < $this->capchafreecapnumberchars; $i++) {
				$string .= chr(rand(97, 122));
			}

			$widthcap= 18*$this->capchafreecapnumberchars;
			$botcap= $this->capchafreecapheight-4;
			$_SESSION[$sessionindex] = $string;
			$image = imagecreatetruecolor($widthcap, $this->capchafreecapheight);

			// random number 1 or 2
			$num = rand(1, 2);
			// font style
			if($num == 1) {
				$font = 'Capture it 2.ttf';
			} else {
				$font = 'Walkway rounded.ttf';
			}

			// random number 1 or 2
			$num2 = rand(1, 2);
			$reportstr .= ', dir.font: ' . $dir . $font;

			$bgcols = explode(',', $this->capchafreecapbackgoundcolor);
			if (count($bgcols) != 3) {
				$this->capchafreecapbackgoundcolor = '255,255,255';
				$bgcols = explode(',', $this->capchafreecapbackgoundcolor);
			}

			for($i = 0; $i < 3; $i++) {
				if (intval($bgcols[$i]) > 255) {
					$bgcols[$i]='255';
				}

				if (intval($bgcols[$i]) < 0 ) {
					$bgcols[$i]='0';
				}

			}

			$colorcols = explode(',', $this->capchafreecaptextcolor);
			if (count($colorcols) != 3) {
				$this->capchafreecaptextcolor = '255,255,255';
				$colorcols = explode(',', $this->capchafreecaptextcolor);
			}

			for($i = 0; $i < 3; $i++) {
				if (intval($colorcols[$i]) > 255) {
					$colorcols[$i]='255';
				}

				if (intval($colorcols[$i]) < 0 ) {
					$colorcols[$i]='0';
				}

			}

			// color
			$color = imagecolorallocate($image, $bgcols[0], $bgcols[1], $bgcols[2]);
			$white = imagecolorallocate($image, $bgcols[0], $bgcols[1], $bgcols[2]);
			imagefilledrectangle($image, 0, 0, $widthcap, $this->capchafreecapheight, $white);
			$angle = - 10;
			$toctocblue = imagecolorallocate($image, $colorcols[0], $colorcols[1], $colorcols[2]);

			for($i = 1; $i < ($this->capchafreecapnumberchars+1); $i++) {
				$offset =(($i - 1) * 17) + 5;
				$modi = $i % 2;
				$angle = - 10 + 20 * $modi;
				if ($modi) {
					$botcapput=$botcap;
				} else {
					$botcapput=19;
				}

				$toctocblue = imagecolorallocate($image, $colorcols[0], ($colorcols[1] + intval($angle / 2) + $i * 2), ($colorcols[2] - $i * 2));
				imagettftext($image, 17, $angle, $offset, $botcapput, $toctocblue, $dir . $font, substr($_SESSION[$sessionindex], $i - 1, 1));
			}

		} else {
			$word_1 = '';
			$word_2 = '';

			for($i = 0; $i < 4; $i++) {
				$word_1 .= chr(rand(97, 122));
			}

			for($i = 0; $i < 4; $i++) {
				$word_2 .= chr(rand(97, 122));
			}

			$_SESSION[$sessionindex] = $word_1 . ' ' . $word_2;
			$image = imagecreatetruecolor(165, 50);
			$font = 'recaptchaFont.ttf';
			$color = imagecolorallocate($image, 0, 0, 0);
			$white = imagecolorallocate($image, 255, 255, 255);
			imagefilledrectangle($image, 0, 0, 709, 99, $white);
			imagettftext($image, 22, 0, 5, 30, $color, $dir . $font, $_SESSION[$sessionindex]);
		}

		header('Content-type: image/png');
		$retstr = imagepng($image);
		return $retstr;
	}
/**
 * Checks a captcha entry
 *
 * @param	string		$cid: content element id
 * @param	string		$code: captcha code
 * @param	[type]		$noecho: ...
 * @return	int
 */
	public function chkcaptcha($cid, $code, $noecho = FALSE) {
		$opensess = TRUE;
		if(isset($_SESSION)) {
			if (isset($_SESSION['cSModule'])) {
				$opensess = FALSE;
			}
		}
		if ($opensess == TRUE) {
			if (!(isset($this->commonObj))) {
				require_once (str_replace(DIRECTORY_SEPARATOR . 'pi2', DIRECTORY_SEPARATOR . 'pi1', realpath(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'class.toctoc_comments_common.php');
				$this->commonObj = new toctoc_comments_common;
			}

			$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
			$sessionTimeout=3*1440;
			$this->commonObj->start_toctoccomments_session($sessionTimeout);
		}

		if($code) {
			$sessionindex = 'random_number' . $cid . '';
			if(strtolower($code) == strtolower($_SESSION[$sessionindex])) {
				$_SESSION[$sessionindex] = '';
				if ($noecho == FALSE) {
					echo 1;
				} else {
					return 1;
				}
				// submitted
			} else {
				// invalid code
				if ($noecho == FALSE) {
					echo 0;
				} else {
					return 0;
				}
			}

		} else {
			if ($noecho == FALSE) {
				echo 0;
			} else {
				return 0;
			}
			// invalid code
		}

	}


}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_captcha.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_captcha.php']);
}

?>