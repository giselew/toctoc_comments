<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * Comment management script.
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 *
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   78: class toctoc_comments_ajax
 *  118:     public function __construct()
 *  410:     public function main()
 *  449:     public function handleCommentatorNotifications()
 *  460:     protected function updateCommentDisplay()
 *  475:     protected function updateComment()
 *  490:     protected function webpagepreview()
 *  502:     protected function cleanupfup()
 *  516:     function getCaptcha($captchatype, $cid)
 *  646:     function chkcaptcha($cid, $code)
 *  667:     protected function getUserCard()
 *  679:     protected function updateRating()
 *  913:     protected function processDeleteSubmission()
 *  958:     protected function processDenotifycommentSubmission()
 *
 * TOTAL FUNCTIONS: 13
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
require_once(PATH_tslib . 'class.tslib_pibase.php');
require_once(t3lib_extMgm::extPath('toctoc_comments', 'class.toctoc_comments_api.php'));
$_EXTKEY = 'toctoc_comments';
require_once(t3lib_extMgm::extPath('toctoc_comments', 'ext_tables.php'));
unset($_EXTKEY);
require_once(t3lib_extMgm::extPath('toctoc_comments', 'tca.php'));
if(!version_compare(TYPO3_version, '4.6', '<')) {
	require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
}
// require(PATH_t3lib.'class.t3lib_parsehtml.php');
/**
 * Comment management script.
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_ajax {
	protected $ref;
	protected $extref;
	protected $pid;
	protected $feuser;
	protected $cmd;
	protected $rating;
	protected $conf;
	protected $piVars;
	protected $cid;
	protected $AjaxData;
	protected $check;
	protected $userpic;
	protected $commentspics = Array();
	protected $commentid;
	protected $captchatype;
	protected $captchacode;
	protected $basedimgstr;
	protected $basedtoctocuid;
	protected $previewid;
	protected $previewconf = Array();
	protected $tctreestate = Array();
	protected $content;
	protected $originalfilename;


	var $extKey = 'toctoc_comments';

	// constants for captcha generation of freecap-clone
	var $capchafreecapbackgoundcolor = '255, 255, 255'; //valid rgb
	var $capchafreecaptextcolor = '95, 117, 200'; //valid rgb
	var $capchafreecapnumberchars = 5;    //max is 10, min is 3
	var $capchafreecapheight = 23;    //max is 50, min is 23
	var $softcheck = 0;

	/**
	 * Initializes the class
	 *
	 * @return	void
	 */
	public function __construct() {

		$data_str = t3lib_div::_GP('data');
		$data = unserialize(base64_decode($data_str));

		$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
		$GLOBALS['LANG']->init($data['lang'] ? $data['lang'] : 'default');
		$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/locallang_ajax.xml');

		tslib_eidtools::connectDB();

		// is there any possible valid cmd what the script shall do?
		$this->cmd = t3lib_div::_GP('cmd');
		if(trim($this->cmd) == '') {
			echo $GLOBALS['LANG']->getLL('bad_cmd_value');
			exit();
		}
		// echo 'here';exit;
		if($this->cmd == 'getcap') {
			// For captcha check and generation we go straight in the code
			// inside the class
			$this->captchatype = t3lib_div::_GP('captchatype');
			$this->cid = t3lib_div::_GP('cid');
			$this->capchafreecapbackgoundcolor= t3lib_div::_GP('srcbcc');
			$this->capchafreecaptextcolor= t3lib_div::_GP('srctc');
			$this->capchafreecapnumberchars= t3lib_div::_GP('srcnbc');
			$this->capchafreecapheight = t3lib_div::_GP('srch');

		} elseif($this->cmd == 'checkcap') {
			// For captcha check we also go straight in the code inside the
			// class
			$this->captchacode = t3lib_div::_GP('code');
			$this->cid = t3lib_div::_GP('cid');
		} elseif ((strstr($this->cmd,'preview')) || ($this->cmd == 'cleanupfup')){
			// Pagepreviewrequests go api->lib->libpreview (if needed)
			$this->cid = t3lib_div::_GP('ref');

			$this->previewconf=$data;
			/* if($this->cmd == 'getpreviewinit') {
				echo $GLOBALS['LANG']->getLL('bad_cmd_value');
			    exit();
			} */
			$data_strconf = t3lib_div::_GP('dataconf');
			$dataconf = unserialize(base64_decode($data_strconf));
			$this->conf	=$dataconf['conf'];

			$data_str = t3lib_div::_GP('dataconfatt');
			$dataconfatt = unserialize(base64_decode($data_str));
			$this->conf['attachments.']=$dataconfatt['conf'];


			$this->previewid = t3lib_div::_GP('previewid');
			if(!is_array($this->conf)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value');
				exit();
			}
			if ($this->cmd == 'cleanupfup'){
				$ofn = t3lib_div::_GP('originalfilename');
				$this->originalfilename = base64_decode($ofn);
				//return print $this->originalfilename ;

			}
		} elseif($this->cmd == 'getuc') {
			// get the UserCard

			$this->basedimgstr = t3lib_div::_GP('imagetag');
			$this->basedtoctocuid = t3lib_div::_GP('toctocuserid');
			$this->commentid=t3lib_div::_GP('commentid');
			if(version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->commentid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->commentid);
			}
			if(!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_commentid_value') . ': ' . $this->commentid;
				exit();
			}
			$this->conf = $data['conf'];
		} elseif($this->cmd == 'handlecn') {
			$this->conf = $data['conf'];
			$this->pid = $data['pid'];
			$this->ref = t3lib_div::_GP('ref');
			if(trim($this->ref) == '') {
				echo $GLOBALS['LANG']->getLL('bad_ref_value');
				exit();
			}
		} elseif(($this->cmd == 'updatect')) {
			$this->conf = $data['conf'];
			$this->commentid=t3lib_div::_GP('cuid');
			$content_str = t3lib_div::_GP('content');
			$this->content=  unserialize(base64_decode($content_str));
			$this->pid = t3lib_div::_GP('pid');


		} else {
			// More Sanity checks

			if (intval(t3lib_div::_GP('softcheck'))) {
				// no piVars check when deleting and then rescanning comments
				$this->softcheck =	intval(t3lib_div::_GP('softcheck'));
			}

			// Is the configuration array really an array
			$this->conf = $data['conf'];
			if(!is_array($this->conf)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value');
				exit();
			}
			// we 'preload the Page ID of the request
			$this->pid = $data['pid'];

			if((strpos($this->cmd, 'ote') === false) &&(strpos($this->cmd, 'like') === false) &&($this->cmd !== 'deletecomment') &&($this->cmd !== 'denotifycomment') &&(strpos($this->cmd, 'browse') === false)) {
				// apart from the cases we don't need the piVars we check now if
				// they are accordingly formatted
				// this is important for new comment submissions
				$datacommentstr = t3lib_div::_GP('datac');
				$datacomment = unserialize(base64_decode($datacommentstr));

				$this->piVars = $datacomment;
				if (!$this->softcheck) {
					// no piVars check when deleting and then rescanning comments
					if(!is_array($this->piVars)) {
						echo $GLOBALS['LANG']->getLL('bad_piVars_value') . ': ' . $datacomment;
						exit();
					}
				}
			}
			// rating is always sent along the request, must be integer
			$this->rating = t3lib_div::_GP('rating');
			if(version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->rating);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->rating);
			}
			if(!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_rating_value');
				exit();
			}
			// reference is always sent along the request, is needed
			$this->ref = t3lib_div::_GP('ref');
			if(trim($this->ref) == '') {
				echo $GLOBALS['LANG']->getLL('bad_ref_value');
				exit();
			}
			if($this->cmd === 'addcomment'){
				$this->extref = t3lib_div::_GP('extref');
				if(trim($this->extref) == '') {
					echo $GLOBALS['LANG']->getLL('bad_ref_value') . ' (external)';
					exit();
				}
			} else {
				if($this->cmd === 'showcomments'){

					$this->extref = t3lib_div::_GP('extref');
					if(trim($this->extref) == '') {
						echo $GLOBALS['LANG']->getLL('bad_ref_value') . ' (external, showcomments)';
						exit();
					}
				} else {
					//$this->extref =$this->ref;
				}
			}

			// the user id may be 0, but we need to check if it's int
			$this->feuser = $data['feuser'];
			if($this->feuser === 0) {
				$tmpint = 1;
			} else {
				if(version_compare(TYPO3_version, '4.6', '<')) {
					$tmpint = t3lib_div::testInt($this->feuser);
				} else {
					$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->feuser);
				}
			}
			if(!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_feuser_value') . ': ' . $this->feuser;
				exit();
			}

			// now lets check the check
			$this->check = t3lib_div::_GP('check');
			if(($this->cmd !== 'deletecomment') &&($this->cmd !== 'denotifycomment') &&(strpos($this->cmd, 'rowse') === false)) {
			 	if(md5($this->ref . $this->rating  . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $this->check) {
			 		if (!$this->softcheck) {
						echo $this->cmd . ': ' . $GLOBALS['LANG']->getLL('wrong_check_value') . ' ' . $GLOBALS['LANG']->getLL('forcomment') . ' ' . $this->ref . ' , check is: ' . $this->check;
						exit();
			 		}
				}
			} else {
				if (($this->cmd === 'deletecomment') || ($this->cmd === 'denotifycomment')){
					$this->commentid = t3lib_div::_GP('cuid'); // holds the commentid
					if(version_compare(TYPO3_version, '4.6', '<')) {
						$tmpint = t3lib_div::testInt($this->commentid);
					} else {
						$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->commentid);
					}
					if(!$tmpint) {
						echo $GLOBALS['LANG']->getLL('bad_commentid_value') . ': ' . $this->commentid;
						exit();
					}
					if(md5($this->commentid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $this->check) {
						echo 'deletecomment: ' . $GLOBALS['LANG']->getLL('wrong_check_value') . ' for comment ' . $this->commentid;
						exit();
					}
				} else {
					// browse oder browsehide
				}
			}
			// setting ajaxData
			$this->AjaxData = $data_str;

			// checking the pid
			if(version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->pid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->pid);
			}
			if(!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_pid_value');
				exit();
			}

			// checking the cid
			$this->cid = $data['cid'];

			if(version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->cid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->cid);
			}
			if(!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_cid_value');
				exit();
			}

			if((strpos($this->cmd, 'ote') === false) &&(strpos($this->cmd, 'like') === false) &&($this->cmd !== 'deletecomment')&&($this->cmd !== 'denotifycomment')) {
				// getting the information from the pi-Form(most of its
				// }zhis-variables, to be cleanedup...)
				// and sent as AJAX-data
				$datathiscommentstr = t3lib_div::_GP('datathis');
				$datathiscomment = unserialize(base64_decode($datathiscommentstr));



				$this->datathis = $datathiscomment;
				if(!is_array($this->datathis)) {
					echo $GLOBALS['LANG']->getLL('bad_Ajax_value');
					exit();
				}
				// We add capass to the datathis array so its where it belongs
				// to I hope
				$this->datathis['sessionCaptchaData'] = t3lib_div::_GP('capsess');

				if(strpos($this->cmd, 'rowse') !== false) {
					$this->datathis['totalrows'] = t3lib_div::_GP('totalrows');
					$this->datathis['startpoint'] = t3lib_div::_GP('startpoint');
					$this->ref = t3lib_div::_GP('ref');
				}
				// from a logged in user the pic - we need it after the insert
				// in the form
				$this->userpic = t3lib_div::_GP('userpic');
				if(($this->cmd === 'showcomments') ||(strpos($this->cmd, 'rowse') !== false)) {
					// for comments and browser we need the commentimgs, this is
					// in the 3rd Ajaxarray
					$data_str = t3lib_div::_GP('commentsimgs');
					$data = unserialize(base64_decode($data_str));
					$this->commentspics = $data;

					$data_str = t3lib_div::_GP('tctreestateenc');
					$data = unserialize(base64_decode($data_str));
					$this->tctreestate = $data;

				} else {
					$this->commentspics = Array();
				}
				if(!is_array($this->commentspics)) {
					echo $GLOBALS['LANG']->getLL('bad_commentspics_value') . ': ' . $this->commentspics;
					exit();
				}
			} elseif (strpos($this->cmd, 'ike') !== false) {
				$data_str = t3lib_div::_GP('commentsimgs');
				$data = unserialize(base64_decode($data_str));
				$this->commentspics = $data;
			}
		}
	}

	/**
	 * Main processing function of eID script
	 *
	 * @return	void
	 */
	public function main() {
		if((strpos($this->cmd, 'ote') !== false) ||(strpos($this->cmd, 'like') !== false)) {
			$this->updateRating();
		} elseif($this->cmd == 'getuc') {

			$this->getUserCard();		}
		elseif($this->cmd == 'handlecn') {

			$this->handleCommentatorNotifications();
		} elseif(($this->cmd == 'getcap')) {
			$this->getCaptcha($this->captchatype, $this->cid);

		} elseif(($this->cmd == 'checkcap')) {
			$this->chkcaptcha($this->cid, $this->captchacode);
		} elseif(($this->cmd == 'deletecomment')) {
			$this->processDeleteSubmission();
		} elseif(($this->cmd == 'denotifycomment')) {
				$this->processDenotifycommentSubmission();
		} elseif(($this->cmd == 'updatect')) {
				$this->updateComment();
		} elseif (strstr($this->cmd,'preview')){
			$this->webpagepreview();


		} elseif ($this->cmd == 'cleanupfup'){
			$this->cleanupfup();


		} else {
			$this->updateCommentDisplay();

		}
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function handleCommentatorNotifications() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		$apiObj->handleCommentatorNotifications($this->ref, $this->conf, true, $this->pid);
		return '';
	}

	/**
	 * Updates comments data Display
	 *
	 * @return	void
	 */
	protected function updateCommentDisplay() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */
		if(version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}
		$piVars = $this->piVars;
		echo $apiObj->getAjaxCommentDisplay($this->ref, $this->conf, true, $this->pid, false, $this->feuser, $this->cmd, $this->piVars, $this->cid, $this->datathis, $this->AjaxData, $this->userpic, $this->commentspics, $this->check, $this->extref,$this->tctreestate);
	}
	/**
	 * Updates comment
	 *
	 * @return	void
	 */
	protected function updateComment() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */
		if(version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}
		echo $apiObj->updateComment($this->conf, $this->commentid, $this->content, $this->pid);
	}

	/**
	 * Handling of webpagepreviews
	 *
	 * @return	void
	 */
	protected function webpagepreview() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		echo $apiObj->getwebpagepreview($this->cmd, $this->cid, $this->previewconf,$this->previewid, $this->conf);
	}

	/**
	 * Handling of webpagepreviews
	 *
	 * @return	void
	 */
	protected function cleanupfup() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		echo $apiObj->cleanupfup($this->cmd, $this->cid, $this->previewconf,$this->previewid, $this->conf,$this->originalfilename);
	}

	/**
	 * Returns a captcha image
	 *
	 * @param	int		$captchatype: type of captcha
	 * @param	int		$cid: content element id
	 * @return	image
	 */
	function getCaptcha($captchatype, $cid) {
		session_name('sess_' . $this->extKey);
		session_start();
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
			if($num == 1) {
				$font = "Capture it 2.ttf"; // font style
			} else {
				$font = "Walkway rounded.ttf"; // font style
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


			$color = imagecolorallocate($image, $bgcols[0], $bgcols[1], $bgcols[2]); // color


			$white = imagecolorallocate($image,$bgcols[0], $bgcols[1], $bgcols[2]); // background color
			                                                  // white
			imagefilledrectangle($image, 0, 0, $widthcap, $this->capchafreecapheight, $white);
			$angle = - 10;
			$toctocblue = imagecolorallocate($image, $colorcols[0], $colorcols[1], $colorcols[2]); // textcolor at the start
			                                                        // color white
			for($i = 1; $i < ($this->capchafreecapnumberchars+1); $i++) {
				$offset =(($i - 1) * 17) + 5;
				$modi = $i % 2;
				$angle = - 10 + 20 * $modi;
				if ($modi) {
					$botcapput=$botcap;
				} else
				{
					$botcapput=19;
				}
				$toctocblue = imagecolorallocate($image, $colorcols[0],($colorcols[1] + intval($angle / 2) + $i * 2),($colorcols[2] - $i * 2));
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

			$font = "recaptchaFont.ttf"; // font style

			$color = imagecolorallocate($image, 0, 0, 0); // color

			$white = imagecolorallocate($image, 255, 255, 255); // background color
			                                                    // white

			imagefilledrectangle($image, 0, 0, 709, 99, $white);

			imagettftext($image, 22, 0, 5, 30, $color, $dir . $font, $_SESSION[$sessionindex]);
		}

		header("Content-type: image/png");
		return imagepng($image);
	}
/**
 * Checks a captcha entry
 *
 * @param	string		$cid: content element id
 * @param	string		$code: captcha code
 * @return	int
 */
	function chkcaptcha($cid, $code) {
		session_name('sess_' . $this->extKey);
		session_start();
		if($code) {
			$sessionindex = 'random_number' . $cid . '';
			if(strtolower($code) == strtolower($_SESSION[$sessionindex])) {
				$_SESSION[$sessionindex] = '';
				echo 1; // submitted
			} else {
				echo 0; // invalid code
			}
		} else {
			echo 0; // invalid code
		}
	}

	/**
	 * Triggers generation of a usercard
	 *
	 * @return	HTML
	 */
	protected function getUserCard() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		$content = $apiObj->getUserCard($this->basedimgstr, $this->basedtoctocuid, $this->conf,$this->commentid);
		print($content) ;
	}
	/**
	 * Updates rating data and outputs new result
	 *
	 * @return	void
	 */
	protected function updateRating() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */
		if(version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}

		if($this->conf['ratings.']['disableIpCheck'] || !$apiObj->isVoted($this->ref, $this->conf) ||!(($this->cmd == 'vote') ||($this->cmd == 'votearticle'))) {
			$feusertoinsert = 0;
			$fetoctocusertoinsert = '';
			$fetoctocusertoquery = '';

			$strCurrentIP = $apiObj->lib->getCurrentIp();
			$newlastname= '';
			$newfirstname= '';
			$newemail= '';
			$newwww= '';
			$newloc= '';
			if(intval($this->feuser) === 0) {
				$fetoctocusertoquery = '"' . $strCurrentIP . '.0"';
				$fetoctocusertoinsert = '' . $strCurrentIP . '.0';
			} else {
				$fetoctocusertoquery = '"0.0.0.0.' . $this->feuser . '"';
				$fetoctocusertoinsert = '0.0.0.0.' . $this->feuser;

				//fe_user-integration
				$rowfe = array();
				$rowfe['toctoc_commentsfeuser_feuser'] =$this->feuser;
				$rowfe['gender'] = 0;
				$templatetd='';
				$markerArray = array();
				$params = array(
						'template' => $template,
						'markers' => $markerArray,
						'row' => $rowfe,
				);
				$tempMarkers = $apiObj->comments_getComments_fe_user($params, $conf);
				if (is_array($tempMarkers)) {

					$newlastname=$tempMarkers['###LASTNAME###'] ;
					$newfirstname=$tempMarkers['###FIRSTNAME###'] ;
					$newemail=$tempMarkers['###EMAILADR###'] ;
					$newwww=$tempMarkers['###WWWADR###'] ;
					$newloc=$tempMarkers['###LOCADR###'] ;
				}
			}
			$feusertoinsert = intval($this->feuser);
			// Do everything inside transaction
			//$GLOBALS['TYPO3_DB']->sql_query('START TRANSACTION');
			if(($this->cmd == 'vote') ||($this->cmd == 'votearticle') ||(strpos($this->cmd, 'ike') !== false)) {

				$dataWhere = 'pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $this->ref . '"';
				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_ratings_data', $dataWhere);

				// vote of the user
				$dataWheremm = 'toctoc_comments_user = ' . $fetoctocusertoquery . '' . ' AND reference="' . $this->ref . '"';
				list($rowmm) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tmm, SUM(ilike) AS ilike, SUM(idislike) AS idislike', 'tx_toctoc_comments_feuser_mm', $dataWheremm);

				//if($this->conf['userStats']) {
					$dataWhereuser = 'pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '';
					list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr', 'tx_toctoc_comments_user', $dataWhereuser);
				//}
			}

			if($row['t'] > 0) {
				if(($this->cmd == 'vote') ||($this->cmd == 'votearticle')) {
					$GLOBALS['TYPO3_DB']->sql_query("UPDATE tx_toctoc_ratings_data SET vote_count=vote_count+1,
						rating=rating+" . intval($this->rating) . ", tstamp=" . time() . " WHERE " . $dataWhere);
				}
			} else {
				if(($this->cmd == 'vote') ||($this->cmd == 'votearticle')) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_ratings_data', array(
							'pid' => $this->conf['storagePid'],
							'crdate' => time(),
							'tstamp' => time(),
							'reference' => $this->ref,
							'vote_count' => 1,
							'rating' => $this->rating
					));
				}
			}

			if($rowmm['tmm'] > 0) {
				if(($this->cmd == 'vote') ||($this->cmd == 'votearticle')) {
					$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'myrating=' . intval($this->rating) . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
				} elseif($this->cmd === 'unlike') {
					if($rowmm['idislike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'idislike=0, tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'ilike=0, idislike=1, tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					}
				} elseif(($this->cmd === 'like')) {
					if($rowmm['ilike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'ilike=0, tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'ilike=1, idislike=0, tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '"  WHERE ' . $dataWheremm);
					}
				}
			} else {

				if(($this->cmd == 'vote') ||($this->cmd == 'votearticle')) {
					if(($feusertoinsert > 0) ||($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstamp' => time(),
								'ilike' => 0,
								'pid' => $this->conf['storagePid'],
								'idislike' => 0,
								'myrating' => $this->rating,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'remote_addr' => $strCurrentIP
						));
					}
				} elseif($this->cmd === 'unlike') {
					if(($feusertoinsert > 0) ||($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstamp' => time(),
								'ilike' => 0,
								'pid' => $this->conf['storagePid'],
								'idislike' => 1,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'remote_addr' => $strCurrentIP
						));
					}
				} elseif($this->cmd == 'like') {
					if(($feusertoinsert > 0) ||($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstamp' => time(),
								'ilike' => 1,
								'pid' => $this->conf['storagePid'],
								'idislike' => 0,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'remote_addr' => $strCurrentIP
						));
					}
				}
			}
			//if($this->conf['userStats']) {
				if(intval($rowusr['tusr']) === 0) {
					$strCurrentIPres = gethostbyaddr($strCurrentIP);
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user', array(
							'crdate' => time(),
							'tstamp' => time(),
							'pid' => $this->conf['storagePid'],
							'toctoc_comments_user' => $fetoctocusertoinsert,
							'ipresolved' => $strCurrentIPres,
							'ip' => $strCurrentIP,
							'initial_firstname' => $newfirstname,
							'initial_lastname' => $newlastname,
							'initial_email' => $newemail,
							'initial_homepage' => $newwww,
							'initial_location' => $newloc,
					));
				}
				$dataWhereStats = 'pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';

				$sqlstr = 'SELECT COUNT(uid) AS nbrentries, SUM(ilike) AS sumilike, SUM(idislike) AS sumidislike, SUM(myrating) AS summyrating, SUM(CASE WHEN myrating > 0 THEN 1 ELSE 0 END) AS nbrmyrating FROM tx_toctoc_comments_feuser_mm WHERE ' . $dataWhereStats;
				$resultcount = mysql_query($sqlstr);
				$rowStats = mysql_fetch_array($resultcount);


				if(intval($rowStats['nbrmyrating']) === 0) {
					// which should not be, but if results in a difff/0 just
					// after, so we avoid this at least...
					$rowStats['nbrmyrating'] = 1;
				}
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' . 'vote_count=' . intval($rowStats['nbrentries']) . ', current_ip="' . $strCurrentIP . '", like_count=' . intval($rowStats['sumilike']) . ', dislike_count=' . intval($rowStats['sumidislike']) . ', average_rating=' . round((intval($rowStats['summyrating']) / intval($rowStats['nbrmyrating'])), 2) . ', tstamp_lastupdate=' . time() . ' WHERE ' . $dataWhereStats);
			//}

			// Call hook if ratings is updated
			if(is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['updateRatings'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['updateRatings'] as $userFunc) {
					$params = array(
							'pObj' => &$this,
							'pid' => $this->pid,
							'ref' => $this->ref
					);
					t3lib_div::callUserFunction($userFunc, $params, $this);
				}
			}
			if(($this->conf['advanced.']['enableUrlLog']) || (!($this->conf['ratings.']['disableIpCheck']))) {
				if((strpos($this->cmd, 'ote') !== false)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_ratings_iplog', array(
							'pid' => $this->conf['storagePid'],
							'crdate' => time(),
							'tstamp' => time(),
							'reference' => $this->ref,
							'ip' => $strCurrentIP
					));
				}
			}
			//$GLOBALS['TYPO3_DB']->sql_query('COMMIT');

			// Clear cache
			$cacheidlist = strval($this->pid); // . ', 100';
			if ($_SESSION['commentsPageOrigId']!=0) {
				$cacheidlist .= ', ' .$_SESSION['commentsPageOrigId'];
			}
			$pidList = t3lib_div::intExplode(',', $cacheidlist);

			t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			/* @var $tce t3lib_TCEmain */

			foreach($pidList as $pid) {
				if($pid != 0) {
					$tce->clear_cacheCmd($pid);
				}
			}
		}

		// Get rating display
		$content = $apiObj->getAjaxRatingDisplay($this->ref, $this->conf, true, $this->pid, false, $this->feuser, $this->cmd, $this->cid, false,$this->commentspics);
		echo $content;

	}
	/**
	 * Processes comment Delete submissions.
	 *
	 * @param	array		$piVars: array with piVars
	 * @param	object		$pObj: parent object
	 * @return	void
	 */
	protected function processDeleteSubmission() {
		if(version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}

		$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->commentid, array(
				'deleted' => 1
		));
		if($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] > 0) {
			$_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] = $_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] - 1;
		}
		// Clear cache

		if ($this->pid != 0) {
			$pidList = $this->pid;
		}
		$additionalClearCachePages = trim($this->conf['additionalClearCachePages']);
		if (!empty($additionalClearCachePages)) {
			if ($pidList !=0) {
				$pidList .= ',' . $additionalClearCachePages;
			}
		}
		if ($_SESSION['commentsPageOrigId']!=0) {
			$pidList .= ', ' .$_SESSION['commentsPageOrigId'];
		}
		$pidListarr= explode(',', $pidList);
		t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');

		/* @var $tce t3lib_TCEmain */
		foreach($pidListarr as $pid) {
			if($pid != 0) {
				$tce->clear_cacheCmd($pid);
			}
		}

	}
	/**
	 * Processes comment Denotify submissions.
	 *
	 * @param	array		$piVars: array with piVars
	 * @param	object		$pObj: parent object
	 * @return	void
	 */
	protected function processDenotifycommentSubmission() {
		if(version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}

		$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->commentid, array(
				'tx_commentsnotify_notify' => 0
		));

		// Clear cache
		$cacheidlist = strval($this->pid); // . ', 100';
		if ($_SESSION['commentsPageOrigId']!=0) {
			$cacheidlist .= ', ' .$_SESSION['commentsPageOrigId'];
		}
		$pidList = t3lib_div::intExplode(',', $cacheidlist);

		t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');

		/* @var $tce t3lib_TCEmain */
		foreach($pidList as $pid) {
			if($pid != 0) {
				$tce->clear_cacheCmd($pid);
			}
		}
	}
}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_ajax.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_ajax.php']);
}

// Make instance:
$SOBE = t3lib_div::makeInstance('toctoc_comments_ajax');
$SOBE->main();

?>