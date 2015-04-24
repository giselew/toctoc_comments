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
 *   93: class toctoc_comments_ajax
 *  145:     public function __construct()
 *  658:     protected function initTSFE()
 *  704:     public function main()
 *  744:     public function handleCommentatorNotifications()
 *  755:     protected function updateCommentDisplay()
 *  773:     protected function updateComment()
 *  788:     protected function webpagepreview()
 *  800:     protected function previewcomment()
 *  811:     protected function commentsSearch()
 *  823:     protected function cleanupfup()
 *  837:     protected function getCaptcha($captchatype, $cid)
 *  972:     protected function chkcaptcha($cid, $code)
 *  999:     protected function getUserCard()
 * 1012:     protected function updateCommentsView()
 * 1137:     protected function updateRating()
 * 1665:     protected function processDeleteSubmission()
 * 1746:     protected function processDenotifycommentSubmission()
 * 1797:     protected function recentCommentsClearCache()
 *
 * TOTAL FUNCTIONS: 18
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
}

require_once(t3lib_extMgm::extPath('toctoc_comments', 'class.toctoc_comments_api.php'));
require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_common.php'));



/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_ajax {
	private $ref;
	private $extref;
	private $pid;
	private $feuser;
	private $cmd;
	private $rating;
	private $votes;
	private $conf;
	private $piVars;
	private $cid;
	private $AjaxData;
	private $check;
	private $userpic;
	private $commentspics = Array();
	private $commentid;
	private $captchatype;
	private $captchacode;
	private $basedimgstr;
	private $basedtoctocuid;
	private $previewid;
	private $previewconf = Array();
	private $tctreestate = Array();
	private $confSess = Array();
	private $content;
	private $originalfilename;
	private $commentreplyid;
	private $pluginid;
	private $overallvote;
	private $pageid;
	private $isrefresh = 0;

	public $extKey = 'toctoc_comments';

	// constants for captcha generation of freecap-clone
	private $capchafreecapbackgoundcolor = '255, 255, 255';
	//valid rgb
	private $capchafreecaptextcolor = '95, 117, 200';
	//valid rgb
	private $capchafreecapnumberchars = 5;
	//max is 10, min is 3
	private $capchafreecapheight = 23;
	//max is 50, min is 23

	private $softcheck = 0;
	private $commonObj;

	/**
	 * Initializes the class
	 *
	 * @return	void
	 */
	public function __construct() {
		if (version_compare(TYPO3_version, '6.3', '>')) {
			(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
			(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
			(class_exists('t3lib_utility_Math', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\MathUtility', 't3lib_utility_Math');
			(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
			(class_exists('tslib_eidtools', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Utility\EidUtility', 'tslib_eidtools');
		}

		$data_str = t3lib_div::_GP('data');
		$data = unserialize(base64_decode($data_str));
		if (version_compare(TYPO3_version, '4.3.99', '>') && (!isset($data['lang']))) {
			$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
			if (!isset($_SESSION['activelang'])) {
				$sessionTimeout=3*1440;
				$this->commonObj->start_toctoccomments_session($sessionTimeout);
			}

			$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
			$GLOBALS['LANG']->init($_SESSION['activelang'] ? $_SESSION['activelang'] : 'default');
			$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/locallang_ajax.xml');
		} else {
			$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
			$GLOBALS['LANG']->init($data['lang'] ? $data['lang'] : 'default');
			$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/locallang_ajax.xml');
			$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
		}

		if (version_compare(TYPO3_version, '4.5', '<')) {
		// Initialize FE user object:
			$feUserObj = tslib_eidtools::initFeUser();
		}
		if (version_compare(TYPO3_version, '6.1', '<')) {
			tslib_eidtools::connectDB();
		}
		// is there any possible valid cmd what the script shall do?
		$this->cmd = t3lib_div::_GP('cmd');

		if ($this->cmd == 'searchcomment') {
			$this->initTSFE();
		} elseif (!isset($GLOBALS['TCA']['pages']['ctrl'])) {
			// avoid flux crashes or other exts replacing TCA
			$this->initTSFE();
			if (!isset($GLOBALS['TCA'])) {
				$GLOBALS['TCA'] = array();
			}
			if (!isset($GLOBALS['TCA']['pages'])) {
				$GLOBALS['TCA']['pages'] = array();
			}
			if (!isset($GLOBALS['TCA']['pages']['columns'])) {
				$GLOBALS['TCA']['pages']['columns'] = array();
			}
		}

		if($this->cmd == 'showcomments') {
			$confLogin=array();
			$confLoginSess=array();
			$data_strtmp = t3lib_div::_GP('dataLogin');
			$confLogin = unserialize(base64_decode($data_strtmp));
			$data_strtmp = t3lib_div::_GP('dataLoginSess');
			$confLoginSess = unserialize(base64_decode($data_strtmp));
		}

		if(trim($this->cmd) == '') {
			echo $GLOBALS['LANG']->getLL('bad_cmd_value') . '""';
			exit();
		}

		if($this->cmd == 'previewcomment') {
			$dataconf_str = t3lib_div::_GP('dataconf');
			$dataconf = unserialize(base64_decode($dataconf_str));
			if(!is_array($dataconf['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd;
				exit();
			}
			$this->conf = $this->commonObj->unmirrorConf($dataconf['conf']);

			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
			$this->previewconf = $data;
		} elseif(($this->cmd == 'searchcomment') || ($this->cmd == 'searchbrowse')) {
			$dataconf_str = t3lib_div::_GP('data');
			$dataconf = unserialize(base64_decode($dataconf_str));
			$confdiffarray = unserialize(base64_decode($dataconf['conf']));

			if(!is_array($confdiffarray)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd;
				exit();
			}
			$this->conf = $this->commonObj->unmirrorConf($confdiffarray);
			//print 'storagePid AAJX'. $this->conf['storagePid'];

			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}
			$this->pluginid = t3lib_div::_GP('ref');
			$this->previewconf = $data;
		} elseif ($this->cmd == 'gettime') {
			echo time();
			exit;
		} elseif ($this->cmd == 'commentsview') {
			$this->pluginid = t3lib_div::_GP('ref');
			$this->feuser = intval(t3lib_div::_GP('usr'));
			$this->pageid = intval(t3lib_div::_GP('pageid'));
			if(!is_array($data['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd . ', conf: ' . $data['conf'];
				exit();
			}
			$this->conf = $this->commonObj->unmirrorConf($data['conf']);
			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			if (intval(t3lib_div::_GP('storagepid')) != 0) {
				$this->conf['storagePid']=intval(t3lib_div::_GP('storagepid'));
			}

		} elseif ($this->cmd == 'getcap') {
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
		} elseif ((strstr($this->cmd, 'preview')) || ($this->cmd == 'cleanupfup')){
			// Pagepreviewrequests go api->lib->libpreview (if needed)
			$this->cid = t3lib_div::_GP('ref');

			$this->previewconf=$data;
			$data_strconf = t3lib_div::_GP('dataconf');
			$dataconf = unserialize(base64_decode($data_strconf));
			if(!is_array($dataconf['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd;
				exit();
			}
			$this->conf=$this->commonObj->unmirrorConf($dataconf['conf']);
			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$data_strtmp = t3lib_div::_GP('dataconfatt');
			$dataconfatt = unserialize(base64_decode($data_strtmp));
			$this->conf['attachments.']=$dataconfatt['conf'];

			$this->previewid = t3lib_div::_GP('previewid');
			if(!is_array($this->conf)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value');
				exit();
			}

			if ($this->cmd == 'cleanupfup'){
				$ofn = t3lib_div::_GP('originalfilename');
				$this->originalfilename = base64_decode($ofn);
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

			$this->conf = $this->commonObj->unmirrorConf($data['conf']);
			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
		} elseif($this->cmd == 'handlecn') {
			$this->conf = $this->commonObj->unmirrorConf($data['conf']);
			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
			$this->pid = $data['pid'];
			$this->ref = t3lib_div::_GP('ref');
			if(trim($this->ref) == '') {
				echo $GLOBALS['LANG']->getLL('bad_ref_value');
				exit();
			}

		} elseif ($this->cmd == 'updatect') {
			$this->conf = $this->commonObj->unmirrorConf($data['conf']);
			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
			$this->commentid = t3lib_div::_GP('cuid');
			$content_str = t3lib_div::_GP('content');
			$updatearr = unserialize(base64_decode($content_str));
			$this->content = $updatearr['content'];
			$this->commenttitle = $updatearr['commenttitle'];
			$this->pid = t3lib_div::_GP('pid');
		} elseif ($this->cmd == 'rcclearcache') {
				$this->pid = t3lib_div::_GP('pid');
		} else {
			// More Sanity checks

			if (intval(t3lib_div::_GP('softcheck'))) {
				// no piVars check when deleting and then rescanning comments
				$this->softcheck = intval(t3lib_div::_GP('softcheck'));
			}
			if(!is_array($data['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd;
				exit();
			}

			$this->conf = $this->commonObj->unmirrorConf($data['conf']);
			if($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			// Is the configuration array really an array
			if(!is_array($this->conf)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value');
				exit();
			}

			// we 'preload the Page ID of the request
			$this->pid = $data['pid'];
			$this->pluginid = $data['ref'];
			if((strpos($this->cmd, 'ote') === FALSE) && (strpos($this->cmd, 'like') === FALSE) && ($this->cmd !== 'deletecomment') &&
					($this->cmd !== 'denotifycomment') && (strpos($this->cmd, 'browse') === FALSE)) {
				// apart from the cases we don't need the piVars we check now if
				// they are accordingly formatted
				// this is important for new comment submissions
				$datacommentstr = t3lib_div::_GP('datac');
				$datacomment = unserialize(base64_decode($datacommentstr));
				$this->piVars = $datacomment;
				if (!$this->softcheck) {
					// no piVars check when deleting and then rescanning comments
					if(!is_array($this->piVars)) {
						if (intval(t3lib_div::_GP('isrefresh')) == 0) {
							echo $GLOBALS['LANG']->getLL('bad_piVars_value') . ': ' . $datacomment;
							exit();
						} else {
							$this->piVars=array();
							$this->isrefresh=1;
						}

					}

				}

			}

			// rating is always sent along the request, must be integer
			$this->rating = t3lib_div::_GP('rating');
			$chkrating=$this->rating;
			$this->votes=1;
			$ratingarr=explode('-', $this->rating );
			if (count($ratingarr)==2) {
				$this->rating=$ratingarr[0]/$ratingarr[1];
				$this->votes =1/$ratingarr[1];
				$chkrating=$ratingarr[0];
			}

			if(version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = is_numeric($this->rating);
			} else {
				$tmpint = is_numeric($this->rating);
			}

			if(!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_rating_value') . ': ' . $this->rating;
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
				$this->commentreplyid = t3lib_div::_GP('commentreplyid');
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

				}

			}

			// the user id may be 0, but we need to check if it's int
			if (intval(t3lib_div::_GP('isrefresh')) == 0) {
				$this->feuser = $data['feuser'];
			} else {
				if($this->cmd === 'showcomments'){
					if (intval(t3lib_div::_GP('islogout')) == 1) {
						$this->feuser =0;
					} else {
						$this->feUserObj = tslib_eidtools::initFeUser();
						$this->feuser = intval($this->feUserObj->user['uid']);
					}

					$tmpconf=array();
					$tmpconf= $this->conf;
					if (is_array($confLogin)) {
						// stuff to merge into conf
						$this->conf = array_replace_recursive($tmpconf, $confLogin);
					}

					// now changeing $data which will beused in AJAXdata
					$newdata = serialize(array(
							'feuser' => $this->feuser,
							'pid' => $data['pid'],
							'cid' => $data['cid'],
							'conf' => $this->conf,
							'lang' => $data['lang'],
							'ref' => $data['ref'],
					));
					$data_str = base64_encode($newdata);
					if (is_array($confLoginSess)) {
						// stuff to merge into Session
						$this->confSess = $confLoginSess;
					}

				}

			}

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
			$this->overallvote = intval(t3lib_div::_GP('overall'));
			$this->pageid = intval(t3lib_div::_GP('pageid'));
			$this->check = t3lib_div::_GP('check');
			if(($this->cmd !== 'deletecomment') && ($this->cmd !== 'denotifycomment') && (strpos($this->cmd, 'rowse') === FALSE)) {
			 	if(md5($this->ref . $chkrating . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $this->check) {
			 		if (!$this->softcheck) {
			 			if (intval(t3lib_div::_GP('isrefresh')) == 0) {
							echo $this->cmd . ': ' . $GLOBALS['LANG']->getLL('wrong_check_value') . ' ' . $GLOBALS['LANG']->getLL('forcomment') . ' ' .
								$this->ref . ', check is: ' . $this->check;
							exit();
			 			}

			 		}

				}

			} else {
				if (($this->cmd === 'deletecomment') || ($this->cmd === 'denotifycomment')){
					$this->commentid = t3lib_div::_GP('cuid');
					// holds the commentid
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

			if((strpos($this->cmd, 'ote') === FALSE) && (strpos($this->cmd, 'like') === FALSE) && ($this->cmd !== 'deletecomment') &&
					($this->cmd !== 'denotifycomment')) {
				// getting the information from the pi-Form
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

				if(strpos($this->cmd, 'rowse') !== FALSE) {
					$this->datathis['totalrows'] = t3lib_div::_GP('totalrows');
					$this->datathis['startpoint'] = t3lib_div::_GP('startpoint');
					$this->ref = t3lib_div::_GP('ref');
				}

				// from a logged in user the pic - we need it after the insert
				// in the form
				$this->userpic = base64_decode(t3lib_div::_GP('userpic'));
				if (str_replace('>', '', $this->userpic) == $this->userpic) {
					$this->userpic .= '>';
				}

				if(($this->cmd === 'showcomments') || (strpos($this->cmd, 'rowse') !== FALSE)) {
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

			} elseif (strpos($this->cmd, 'ike') !== FALSE) {
				$data_str = t3lib_div::_GP('commentsimgs');
				$data = unserialize(base64_decode($data_str));
				$this->commentspics = $data;
			}

		}

	}
	/**
	 * Initializes TSFE and sets $GLOBALS['TSFE']
	 *
	 * @return	void
	 */
	protected function initTSFE() {
		try {
// 			$GLOBALS['TT'] = new \TYPO3\CMS\Core\TimeTracker\NullTimeTracker();
 //			$GLOBALS['TT']->start();

			/** @var $frontend TypoScriptFrontendController */
			//$GLOBALS['TSFE'] = t3lib_div::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], t3lib_div::_GP('id'), 0);

			if (version_compare(TYPO3_version, '4.8', '>')) {
				$frontend = t3lib_div::makeInstance(
						'TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController',
						$GLOBALS['TYPO3_CONF_VARS'], $pageId, ''
				);
			} else {
				$frontend = t3lib_div::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], $pageId, '');
			}
			$GLOBALS['TSFE'] = & $frontend;

//			$frontend->connectToDB();
			$frontend->initFEuser();
//			$frontend->checkAlternativeIdMethods();
			$frontend->determineId();
			$frontend->initTemplate();
 //			$frontend->getFromCache();
 			$frontend->getConfigArray();
// 			$frontend->settingLanguage();
// 			$frontend->settingLocale();
			//     $frontend->newCObj();

			//       // Get linkVars, absRefPrefix, etc
			if (version_compare(TYPO3_version, '4.8', '>')) {
				\TYPO3\CMS\Frontend\Page\PageGenerator::pagegenInit();
			} else {
				TSpagegen::pagegenInit();
			}

		} catch (Exception $e) {
			print_r($e);
		}
	}

	/**
	 * Main processing function of eID script
	 *
	 * @return	void
	 */
	public function main() {
		if((strpos($this->cmd, 'ote') !== FALSE) || (strpos($this->cmd, 'like') !== FALSE)) {
			$this->updateRating();
		} elseif ($this->cmd == 'commentsview') {
			$this->updateCommentsView();
		} elseif($this->cmd == 'getuc') {
			$this->getUserCard();
		} elseif($this->cmd == 'handlecn') {
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
		} elseif(($this->cmd == 'searchcomment') || ($this->cmd == 'searchbrowse')) {
			$this->commentsSearch();
		} elseif ($this->cmd == 'previewcomment'){
			$this->previewcomment();
		} elseif (strstr($this->cmd, 'preview')){
			$this->webpagepreview();
		} elseif ($this->cmd == 'cleanupfup'){
			$this->cleanupfup();
		} elseif ($this->cmd == 'rcclearcache'){
			$this->recentCommentsClearCache();
		} else {
			$this->updateCommentDisplay();
		}

	}

	/**
	 * triggers notification e-mails about the new comment
	 *
	 * @return	string		empty
	 */
	public function handleCommentatorNotifications() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		$ret=$apiObj->handleCommentatorNotifications($this->ref, $this->conf, TRUE, $this->pid);
		echo $ret;
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
			$apiObj->initCaches();
		}

		$piVars = $this->piVars;
		echo $apiObj->getAjaxCommentDisplay($this->ref, $this->conf, TRUE, $this->pid, $this->feuser, $this->cmd, $this->piVars, $this->cid, $this->datathis,
				$this->AjaxData, $this->userpic, $this->commentspics, $this->check, $this->extref, $this->tctreestate, $this->commentreplyid, $this->isrefresh,
				$this->confSess);
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
			$apiObj->initCaches();
		}

		echo $apiObj->updateComment($this->conf, $this->commentid, $this->content, $this->pid, $this->pluginid, $this->commenttitle);
	}

	/**
	 * Handling of webpagepreviews
	 *
	 * @return	void
	 */
	protected function webpagepreview() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		echo $apiObj->getwebpagepreview($this->cmd, $this->cid, $this->previewconf, $this->conf);
	}

	/**
	 * Handling of commentpreviews
	 *
	 * @return	void
	 */
	protected function previewcomment() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		echo $apiObj->previewcomment($this->previewconf, $this->conf);
	}
	/**
	 * Handling of commentsSearch
	 *
	 * @return	void
	 */
	protected function commentsSearch() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		echo $apiObj->commentsSearch($this->previewconf, $this->conf, $this->pluginid);
	}

	/**
	 * Handling of webpagepreviews
	 *
	 * @return	void
	 */
	protected function cleanupfup() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		echo $apiObj->cleanupfup($this->previewid, $this->conf, $this->originalfilename);
	}

	/**
	 * Returns a captcha image
	 *
	 * @param	int		$captchatype: type of captcha
	 * @param	int		$cid: content element id
	 * @return	image
	 */
	protected function getCaptcha($captchatype, $cid) {
		$sessionTimeout=3*1440;
		$this->commonObj->start_toctoccomments_session($sessionTimeout);

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
 * @return	int
 */
	protected function chkcaptcha($cid, $code) {
		$sessionTimeout=3*1440;
		$this->commonObj->start_toctoccomments_session($sessionTimeout);

		if($code) {
			$sessionindex = 'random_number' . $cid . '';
			if(strtolower($code) == strtolower($_SESSION[$sessionindex])) {
				$_SESSION[$sessionindex] = '';
				echo 1;
				// submitted
			} else {
				// invalid code
				echo 0;
			}

		} else {
			echo 0;
			// invalid code
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

		$content = $apiObj->getUserCard($this->basedimgstr, $this->basedtoctocuid, $this->conf, $this->commentid);
		print($content);
	}

		/**
 * Updates rating data and outputs new result
 *
 * @return	void
 */
	protected function updateCommentsView() {
		$feusertoinsert = intval($this->feuser);
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		$strCurrentIP = $apiObj->lib->getCurrentIp();
		$pageid= $this->pageid;
		$GLOBALS['TYPO3_DB']->sql_query('START TRANSACTION');
		$pluginid= $this->pluginid;
		$action='try';
		if(intval($this->feuser) === 0) {

			$fetoctocusertoquery = '"' . $strCurrentIP . '.0"';
			$fetoctocusertoinsert = '' . $strCurrentIP . '.0';
		} else {
			$fetoctocusertoquery = '"0.0.0.0.' . $this->feuser . '"';
			$fetoctocusertoinsert = '0.0.0.0.' . $this->feuser;
		}

		if (!isset($_SESSION['commentViewsLastPluginId'])) {
			$_SESSION['commentViewsLastPluginId']='';

		}

		if ((str_replace('tx_toctoc_comments_comments_', '', $pluginid) != $pluginid) && ($_SESSION['commentViewsLastPluginId'] != '')) {
			$setPluginCacheControlTstamppluginid=$_SESSION['commentViewsLastPluginId'];
		} else {
			$_SESSION['commentViewsLastPluginId']=$pluginid;
			$setPluginCacheControlTstamppluginid=$pluginid;
		}

		$dataWhere = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $pluginid . '" AND toctoc_comments_user=' .
						$fetoctocusertoquery .'';
		list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('seen AS seenrows, uid AS insertedrows', 'tx_toctoc_comments_feuser_mm', $dataWhere);
		if(intval($row['insertedrows'] > 0)) {
			if($row['seenrows'] == 0) {
				//update to 1
				$action='update';
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET seen=1,
						pagetstampseen=' . $pageid . ', tstampseen=' . time() . ', tstamp=' . time() . ' WHERE ' . $dataWhere);
			}

		} else {
			$action='insert';
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_feuser_mm',
					'deleted=1 AND pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $pluginid . '" AND toctoc_comments_user=' .
						$fetoctocusertoquery .'');

			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
					'crdate' => time(),
					'tstampseen' => time(),
					'pagetstampseen' =>$pageid,
					'tstamp' => time(),
					'seen' => 1,
					'pid' => $this->conf['storagePid'],
					'idislike' => 0,
					'myrating' => 0,
					'toctoc_commentsfeuser_feuser' => $feusertoinsert,
					'toctoc_comments_user' => $fetoctocusertoinsert,
					'reference' => $pluginid,
					'remote_addr' => $strCurrentIP
			));
		}

		$GLOBALS['TYPO3_DB']->sql_query('COMMIT');
		if ($action != 'try') {
			if (!isset($_SESSION['commentViewsUpdateTime'])) {
				$_SESSION['commentViewsUpdateTime']=0;

			}

			if (!isset($_SESSION['commentViewsUpdateTimePlugin'])) {
				$_SESSION['commentViewsUpdateTimePlugin']=array();

			}

			if (!isset($_SESSION['commentViewsUpdateTimePlugin'][$pluginid])) {
				$_SESSION['commentViewsUpdateTimePlugin'][$pluginid]=0;

			}

			$tdifftolastrun = 1000*(microtime(TRUE) - $_SESSION['commentViewsUpdateTime']);
			if ($tdifftolastrun>5000) {
				$_SESSION['commentViewsUpdateTime']=microtime(TRUE);
				$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
				/* @var $apiObj toctoc_comments_api */
				if(version_compare(TYPO3_version, '4.6', '<')) {
					$apiObj->initCaches();
				}

				if (version_compare(TYPO3_version, '6.0', '<')) {
					t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
				} else {
					require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
				}
				// the $GLOBALS['TCA']-Patch for eID and FLUX
				if (!(isset($GLOBALS['TCA']))) {
					$GLOBALS['TCA'] = array();
					$GLOBALS['TCA']['tt_content'] = array();
				}
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');
				$tce->clear_cacheCmd($pageid);
				$action .= ' cleared page cache for id ' . $pageid;

			}

			$tdifftolastrun = 1000*(microtime(TRUE) - $_SESSION['commentViewsUpdateTimePlugin'][$pluginid]);
			if ($tdifftolastrun>2000) {
				if (!isset($apiObj)) {
					$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
				}

				$_SESSION['commentViewsUpdateTimePlugin'][$pluginid]=microtime(TRUE);
				$apiObj->setPluginCacheControlTstamp($setPluginCacheControlTstamppluginid);
				$action .= ' setPluginCache id ' . $setPluginCacheControlTstamppluginid;
			}

		}

		echo '';
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
			$apiObj->initCaches();
		}
		$saveratingsdisableIpCheck = $this->conf['ratings.']['disableIpCheck'];
		$pageid= $this->pageid;
		$ratingarr=explode('-', $this->ref);
		$scopeid =0;
		if (count($ratingarr)==2) {
			$this->ref=$ratingarr[0];
			$scopeid =intval($ratingarr[1]);
		}

		$ratingsmode='';
		if (trim($this->conf['ratings.']['useScopesForVote'])!='') {
			if ($this->overallvote==1) {
				$ratingsmode='autostatic';
			}

		}
		$isReview = 0;
		if ((str_replace('tx_toctoc_comments_', '', $this->ref) == $this->ref) && ($this->conf['advanced.']['commentReview'] == 1) && ($this->feuser > 0)) {
			$this->conf['ratings.']['disableIpCheck'] = 1;
			$isReview = 1;
		}
		$alreadyvoted = $apiObj->isVoted($this->ref, $scopeid, $this->feuser, TRUE);

		if($this->conf['ratings.']['disableIpCheck'] || ($alreadyvoted == FALSE) || ($ratingsmode=='autostatic') ||
				!(($this->cmd == 'vote') || ($this->cmd == 'votearticle'))) {
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
				$tempMarkers = $apiObj->comments_getComments_fe_user($params, $this->conf);
				if (is_array($tempMarkers)) {
					$newlastname=$tempMarkers['###LASTNAME###'];
					$newfirstname=$tempMarkers['###FIRSTNAME###'];
					$newemail=$tempMarkers['###EMAILADR###'];
					$newwww=$tempMarkers['###WWWADR###'];
					$newloc=$tempMarkers['###LOCADR###'];
				}

			}
			$feusertoinsert = intval($this->feuser);
			$allowedNumberOfRatingsExceededBlocktimeMessage = '';
			if (!(isset($_SESSION['allowedNumberOfRatings']))) {
				$_SESSION['allowedNumberOfRatings'] = 0;
			}

			if (!(isset($_SESSION['unBlockTime']))) {
				$_SESSION['unBlockTime'] = 0;
			}

			if (!(isset($_SESSION['ratingtimes']))) {
				$_SESSION['ratingtimes'] = array();
			}

			if(($this->cmd == 'vote') || ($this->cmd == 'votearticle') || (strpos($this->cmd, 'ike') !== FALSE)) {

				$dataWhere = 'pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $this->ref . '" AND reference_scope=' . $scopeid;
				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_ratings_data', $dataWhere);

				// vote of the user
				$dataWheremm = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '' .
								' AND reference="' . $this->ref . '" AND reference_scope=' . $scopeid;
				list($rowmm) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tmm, SUM(ilike) AS ilike, SUM(idislike) AS idislike, AVG(myrating) as avgmyrating',
						'tx_toctoc_comments_feuser_mm', $dataWheremm);
				if (($scopeid==0) && ($this->overallvote==1) || ($scopeid!=0)) {
					// for scopred ratings we need some more data, we need the values of the scoped entries for calulation of the average in ratings_data
					$dataWheremmscp = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '' .
							' AND reference="' . $this->ref . '" AND reference_scope!=0';
					list($rowmmscp) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tmm, SUM(ilike) AS ilike, SUM(idislike) AS idislike,
							AVG(myrating) as avgmyrating, SUM(myrating) as summyrating',
							'tx_toctoc_comments_feuser_mm', $dataWheremmscp);
					if ($scopeid!=0) {
						// storing initial number of voted scopes and their avarage rating in SESSION
						if($rowmmscp['tmm'] > 0) {
							$_SESSION['vctrlinitialvotedscopes' . intval($this->conf['storagePid']) . $this->ref] =
							round(($rowmmscp['summyrating']/$rowmmscp['avgmyrating']), 0);
							$_SESSION['vctrlinitialrating' . intval($this->conf['storagePid']) . $this->ref] = $rowmmscp['avgmyrating'];

						} else {
							$_SESSION['vctrlinitialvotedscopes' . intval($this->conf['storagePid']) . $this->ref] = 0;
							$_SESSION['vctrlinitialrating' . intval($this->conf['storagePid']) . $this->ref] = 0;
						}
					} else {
						// now in the 2nd AJAX call the overall will be done, we pick up the current values
						$vctrcurrentvotedscopes = round(($rowmmscp['summyrating']/$rowmmscp['avgmyrating']), 0);
						$vctrcurrentrating = $rowmmscp['avgmyrating'];
					}
				}

				$dataWhereuser = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '';
				list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr', 'tx_toctoc_comments_user', $dataWhereuser);

			}

			if(($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
				if (intval($_SESSION['unBlockTime']) > 1000*(microtime(TRUE))) {
					$waittime = intval(((intval($_SESSION['unBlockTime'])-1000*(microtime(TRUE)))/60000));
					$toomanyratings = $GLOBALS['LANG']->getLL('made_toomanyratings');
					if ($waittime > 1) {
						$allowedNumberOfRatingsExceededBlocktimeMessage = $toomanyratings . '. ' . $GLOBALS['LANG']->getLL('next_rating_in') . ' ' .
							$waittime . ' ' . $GLOBALS['LANG']->getLL('next_rating_minutes');
					} else {
						$allowedNumberOfRatingsExceededBlocktimeMessage = $toomanyratings . '. ' . $GLOBALS['LANG']->getLL('next_rating_inaminute');
					}
				} else {
					$countratingtimes = count($_SESSION['ratingtimes']);
					$_SESSION['ratingtimes'][$countratingtimes] = 1000*(microtime(TRUE));
					$_SESSION['allowedNumberOfRatings'] = $_SESSION['allowedNumberOfRatings']+1;
					//echo ' <br> ' . $_SESSION['allowedNumberOfRatings'] . ' allowedNumberOfRatings ' . intval($this->conf['ratings.']['allowedNumberOfRatings']);
					if ($_SESSION['allowedNumberOfRatings'] > intval($this->conf['ratings.']['allowedNumberOfRatings'])) {
						$timecompare = $_SESSION['ratingtimes'][($countratingtimes-$this->conf['ratings.']['allowedNumberOfRatings'])];
						$timediff = (1000*microtime(TRUE))/60 - $timecompare/60;
						$timediff = $timediff/1000;
						intval($this->conf['ratings.']['timeForAllowedNumberOfRatings']) . ' index of compare ' .
						($countratingtimes-$this->conf['ratings.']['allowedNumberOfRatings']);
						if (intval($timediff) < intval($this->conf['ratings.']['timeForAllowedNumberOfRatings'])) {
							if ($_SESSION['unBlockTime'] == 0) {
								$_SESSION['unBlockTime'] = 1000*(microtime(TRUE)) + 60*1000*(intval($this->conf['ratings.']['allowedNumberOfRatingsExceededBlocktime']));
							}
						}
					}
					if ($_SESSION['unBlockTime'] > 1000*(microtime(TRUE))) {
						$waittime = intval(((intval($_SESSION['unBlockTime'])-intval(1000*(microtime(TRUE))))/60000));
						$toomanyratings = $GLOBALS['LANG']->getLL('made_toomanyratings');
						if ($waittime > 1) {
							$allowedNumberOfRatingsExceededBlocktimeMessage = $toomanyratings . '. ' . $GLOBALS['LANG']->getLL('next_rating_in') . ' ' .
							$waittime . ' ' . $GLOBALS['LANG']->getLL('next_rating_minutes');
						} else {
							$allowedNumberOfRatingsExceededBlocktimeMessage = $toomanyratings . '. ' . $GLOBALS['LANG']->getLL('next_rating_inaminute');
						}
					} else {
						if ($_SESSION['unBlockTime'] > 0) {
							$_SESSION['unBlockTime'] = 0;
						}
					}
				}
			}
			if ($allowedNumberOfRatingsExceededBlocktimeMessage == '') {
				if($row['t'] > 0) {
					if(($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
						if ($this->conf['ratings.']['disableIpCheck']) {
							if ($alreadyvoted)  {
								$thevotes = 0;
								$therating = 0;
								if($rowmm['tmm'] > 0) {
									if (($scopeid==0) && ($this->overallvote==1)) {
										// here we need to decide what to add to the ratings table
										// for this we use the SESSION variables we've loaded just before when the vote on the scope passed thru this pghp-file
										$thevotes = ($vctrcurrentvotedscopes-
												$_SESSION['vctrlinitialvotedscopes' . intval($this->conf['storagePid']) . $this->ref])*$this->votes;

										if ($thevotes == 0) {
											$therating = ($vctrcurrentrating -
													$_SESSION['vctrlinitialrating' . intval($this->conf['storagePid']) . $this->ref])*
													($_SESSION['vctrlinitialvotedscopes' . intval($this->conf['storagePid']) . $this->ref]*$this->votes);
										} else {
											// need to add the rating, new scope was voted first time
											$therating = $this->rating;
										}
										// we can unset the session varibles, they are not needed to be present for instance
										unset($_SESSION['vctrlinitialvotedscopes' . intval($this->conf['storagePid']) . $this->ref]);
										unset( $_SESSION['vctrlinitialrating' . intval($this->conf['storagePid']) . $this->ref]);
									} else {
										// it's a vote on a scope, the rating value to add is just the difference to the existing value,
										// maybe negative if its a downvote
										$therating = $this->rating - $rowmm['avgmyrating'];
									}

								} else {
									// case should not occur sice data can only be present if item has already been voted.
									$thevotes = $this->votes;
									$therating = $this->rating;

								}
							} else {
								// not yet voted
								$thevotes = $this->votes;
								$therating = $this->rating;

							}
						} else {
							// has already some votes, IPCheck enabled
							$thevotes = $this->votes;
							$therating = $this->rating;
						}

						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_ratings_data SET isreview='. $isReview . ', vote_count=vote_count+'.$thevotes .
								',rating=rating+' . $therating . ', tstamp=' . time() . ' WHERE ' . $dataWhere);
					}

				} else {
					if(($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_ratings_data', array(
							'pid' => $this->conf['storagePid'],
							'crdate' => time(),
							'tstamp' => time(),
							'reference' => $this->ref,
							'vote_count' => $this->votes,
							'rating' => $this->rating,
							'reference_scope' => $scopeid,
							'isreview' => $isReview,
						));
					}

				}
			}

			if ($this->votes==0) {
				$this->votes=1;
			}

			$locrating=$this->rating;
			if ($this->overallvote==1) {
				$locrating=$this->rating/$this->votes;
			}

			if($rowmm['tmm'] > 0) {
				if(($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
					//select all scopes avgs if overallscope
					if ($allowedNumberOfRatingsExceededBlocktimeMessage == '') {
						$voteround=9;
						if ($this->overallvote==1) {
							$whereloc = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '' .
							' AND reference="' . $this->ref . '" AND reference_scope > 0';
							list($rowavg) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('AVG(myrating) as avgmyrating, COUNT(reference_scope) as countreference',
									'tx_toctoc_comments_feuser_mm', $whereloc);
							if (count($rowavg)>0) {
								$locrating=$rowavg['avgmyrating'];
							}

							$voteround=9;
						}

						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET isreview='. $isReview . ', myrating=' . round($locrating, $voteround) . ', pagetstampmyrating=' .
								$pageid . ', tstampmyrating=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					}
				} elseif($this->cmd === 'unlike') {
					if($rowmm['idislike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'idislike=0, pagetstampidislike=' . $pageid .
								', tstampidislike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$_SESSION['dislikeditem'] = array();
						$_SESSION['dislikeditem']['pageid'] = $pageid;
						$_SESSION['dislikeditem']['IP'] = $strCurrentIP;
						$_SESSION['dislikeditem']['time'] = time();
						$_SESSION['dislikeditem']['ref'] = $this->ref;
						$_SESSION['dislikeditem']['toctoc_user'] = $fetoctocusertoinsert;
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'ilike=0, idislike=1, pagetstampidislike=' . $pageid .
								', tstampidislike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					}

				} elseif(($this->cmd === 'like')) {
					if($rowmm['ilike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'ilike=0, pagetstampilike=' . $pageid . ', tstampilike=' .
								time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ' . 'ilike=1, idislike=0, pagetstampilike=' . $pageid .
								', tstampilike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '"  WHERE ' . $dataWheremm);
					}

				}

			} else {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_feuser_mm',
										'deleted=1 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '' .
										' AND reference="' . $this->ref . '"');

				if(($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
					if ($allowedNumberOfRatingsExceededBlocktimeMessage == '') {

						if(($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
									'crdate' => time(),
									'tstampmyrating' => time(),
									'pagetstampmyrating' => $pageid,
									'tstamp' => time(),
									'ilike' => 0,
									'pid' => $this->conf['storagePid'],
									'idislike' => 0,
									'myrating' => $locrating,
									'toctoc_commentsfeuser_feuser' => $feusertoinsert,
									'toctoc_comments_user' => $fetoctocusertoinsert,
									'reference' => $this->ref,
									'reference_scope' => $scopeid,
									'isreview' => $isReview,
									'remote_addr' => $strCurrentIP
							));
						}
					}

				} elseif($this->cmd == 'unlike') {
					if(($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstamp' => time(),
								'tstampidislike' => time(),
								'pagetstampidislike' => $pageid,
								'ilike' => 0,
								'pid' => $this->conf['storagePid'],
								'idislike' => 1,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'reference_scope' => $scopeid,
								'remote_addr' => $strCurrentIP
						));
						$_SESSION['dislikeditem'] = array();
						$_SESSION['dislikeditem']['pageid'] = $pageid;
						$_SESSION['dislikeditem']['IP'] = $strCurrentIP;
						$_SESSION['dislikeditem']['time'] = time();
						$_SESSION['dislikeditem']['ref'] = $this->ref;
						$_SESSION['dislikeditem']['toctoc_user'] = $fetoctocusertoinsert;
					}

				} elseif($this->cmd == 'like') {
					if(($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstampilike' => time(),
								'pagetstampilike' =>$pageid,
								'tstamp' => time(),
								'ilike' => 1,
								'pid' => $this->conf['storagePid'],
								'idislike' => 0,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'reference_scope' => $scopeid,
								'remote_addr' => $strCurrentIP
						));
					}

				}

			}

			if(intval($rowusr['tusr']) === 0) {
				$strCurrentIPres = gethostbyaddr($strCurrentIP);
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_user',
						'deleted=1 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery);

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
			if ($allowedNumberOfRatingsExceededBlocktimeMessage == '') {
				$dataWhereStats = 'reference_scope = 0 AND deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user="' .
				$fetoctocusertoinsert . '"';
				$upddataWhereStats = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';

				$sqlstr = 'SELECT SUM(CASE WHEN myrating+ilike+idislike > 0 THEN 1 ELSE 0 END) AS nbrentries, SUM(ilike) AS sumilike, SUM(idislike) AS sumidislike,
						SUM(myrating) AS summyrating,
						SUM(CASE WHEN myrating > 0 THEN 1 ELSE 0 END) AS nbrmyrating FROM tx_toctoc_comments_feuser_mm WHERE ' . $dataWhereStats;
				$resultcount = $GLOBALS['TYPO3_DB']->sql_query($sqlstr);
				$rowStats = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultcount);

				if(intval($rowStats['nbrmyrating']) === 0) {
					// which should not be, but if results in a difff/0 just
					// after, so we avoid this at least...
					$rowStats['nbrmyrating'] = 1;
				}

				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' . 'vote_count=' . $rowStats['nbrmyrating'] . ', current_ip="' . $strCurrentIP .
						'", like_count=' . intval($rowStats['sumilike']) . ', dislike_count=' . intval($rowStats['sumidislike']) . ', average_rating=' .
						round((intval($rowStats['summyrating']) / intval($rowStats['nbrmyrating'])), 9) . ', tstamp_lastupdate=' . time() . ' WHERE ' .
						$upddataWhereStats);

				// Call hook if ratings is updated
				if(is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['updateRatings'])) {
					foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['updateRatings'] as $userFunc) {
						$params = array(
								'pObj' => $this,
								'pid' => $this->pid,
								'ref' => $this->ref,
								'reference_scope' => $scopeid
						);
						t3lib_div::callUserFunction($userFunc, $params, $this);
					}

				}

				if(($this->conf['advanced.']['enableUrlLog']) || (!($this->conf['ratings.']['disableIpCheck']))) {
					if((strpos($this->cmd, 'ote') !== FALSE)) {
						if ($ratingsmode == '') {
							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_ratings_iplog', array(
									'pid' => $this->conf['storagePid'],
									'crdate' => time(),
									'tstamp' => time(),
									'reference' => $this->ref,
									'reference_scope' => $scopeid,
									'ip' => $strCurrentIP
							));
						}

					}

				}

				// Clear cache
				$cacheidlist = strval($this->pid);
				if ($_SESSION['commentsPageOrigId']!=0) {
					$cacheidlist .= ', ' .$_SESSION['commentsPageOrigId'];
				}

				$pidList = t3lib_div::intExplode(',', $cacheidlist);
				$pidList=array_unique($pidList);
				if (version_compare(TYPO3_version, '6.0', '<')) {
					t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
				} else {
					require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
				}

				$tce = t3lib_div::makeInstance('t3lib_TCEmain');
				/* @var $tce t3lib_TCEmain */
				// the $GLOBALS['TCA']-Patch for eID and FLUX
				if (!(isset($GLOBALS['TCA']))) {
					$GLOBALS['TCA'] = array();
					$GLOBALS['TCA']['tt_content'] = array();
				}
				foreach($pidList as $pid) {
					if($pid != 0) {
						$tce->clear_cacheCmd($pid);
					}

				}

				$apiObj->setPluginCacheControlTstamp($this->pluginid);
			}
		}
		if ($allowedNumberOfRatingsExceededBlocktimeMessage == '') {
		// Get rating display
			$saveconfstaticmode= $this->conf['ratings.']['mode'];
			$saveconfstaticmodeplus= $this->conf['ratings.']['mode'];
			if (intval($this->conf['ratings.']['enableOverallScopeForVote'])==0) {
				if ($this->overallvote==1) {
					$this->conf['ratings.']['modeplus']='autostatic';
				}

			}
			if ($isReview != 0) {
				$savuseMyVote = $this->conf['ratings.']['useMyVote'];
				$savuseVotes = $this->conf['ratings.']['useVotes'];
				$this->conf['ratings.']['useMyVote'] = 1;
				$this->conf['ratings.']['useVotes'] = 1;
			}

			$content = $apiObj->getAjaxRatingDisplay($this->ref, $this->conf, TRUE, $this->pid, FALSE, $this->feuser, $this->cmd, $this->cid,
					$this->commentspics, $scopeid, $isReview);

			if ($isReview != 0) {
				$this->conf['ratings.']['useMyVote'] = $savuseMyVote;
				$this->conf['ratings.']['useVotes'] = $savuseVotes;
			}

			if ($scopeid != 0) {
				if ((intval($this->conf['ratings.']['useShortTopLikes']) == 1) || (intval($this->conf['ratings.']['useLikeDislikeStyle']) == 1)) {
					$externalrefscope=$this->ref.'-'.$scopeid;
					$repl='id="tx-tc-myrts-dp-'.$externalrefscope . '" class="tx-tc-rts-area';
					$replw='class="tx-tc-nodisp" id="tx-tc-myrts-dp-'.$externalrefscope. '" class="tx-tc-rts-area tx-tc-nodisp';
					$wrkareaHTML=str_replace('id="tx-tc-myrtstop-'.$externalrefscope.'" class="tx-tc-rts-area', 'id="tx-tc-myrtstop-'.$externalrefscope.
						'" class="tx-tc-rts-area tx-tc-nodisp', $content);
					$content=str_replace($repl, $replw, $wrkareaHTML);
				}

			}

			if ($isReview != 0) {
				$content = '<div class="tx-tc-rws-area">' . $content . '</div>';
			}

			$this->conf['ratings.']['mode']= $saveconfstaticmode;
			$this->conf['ratings.']['modeplus']= $saveconfstaticmodeplus;
			$this->conf['ratings.']['disableIpCheck'] = $saveratingsdisableIpCheck;
		} else {
			$content = '<div class="tx-tc-warn tx-tc-sysmessage">' . $allowedNumberOfRatingsExceededBlocktimeMessage . '</div>';
		}
		echo $content;

	}

	/**
	 * Processes comment Delete submissions.
	 *
	 * @param	array		$piVars: array with piVars
	 * @param	object		$pObj: parent object
	 * @return	void		or string on error
	 */
	protected function processDeleteSubmission() {

		// checking children and aborting if already parent
		$whereloc = 'deleted=0 ANd parentuid=' .$this->commentid;
		//respect COI- and approval-needed comments
		list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user, uid,approved,crdate,firstname,lastname,homepage,
						location,email,content,tx_commentsnotify_notify,remote_addr,SUBSTR(external_ref_uid,12) AS external_ref_uid,
						attachment_id,attachment_subid,parentuid,gender,external_ref',
				'tx_toctoc_comments_comments', $whereloc);
		if (count($row)>0) {
			//child comment exists and probably has been added between page load and submit
			// deletion is not possible
			echo '<div>db403</div>';
		} else {

			$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
			/* @var $apiObj toctoc_comments_api */
			if(version_compare(TYPO3_version, '4.6', '<')) {
				$apiObj->initCaches();
			}

			$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->commentid, array(
					'deleted' => 1
			));
			if($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] > 0) {
				$_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] = $_SESSION['commentListIndex']['cid' .
				$_SESSION['commentListRecord']]['startIndex'] - 1;
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
			$pidListarr=array_unique($pidListarr);
			if (version_compare(TYPO3_version, '6.0', '<')) {
				t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
			} else {
				require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
			}

			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			// the $GLOBALS['TCA']-Patch for eID and FLUX
			if (!(isset($GLOBALS['TCA']))) {
				$GLOBALS['TCA'] = array();
				$GLOBALS['TCA']['tt_content'] = array();
			}
			/* @var $tce t3lib_TCEmain */
			foreach($pidListarr as $pid) {
				if($pid != 0) {
					$tce->clear_cacheCmd($pid);
				}

			}

			$apiObj->setPluginCacheControlTstamp($this->pluginid);
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
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */
		if(version_compare(TYPO3_version, '4.6', '<')) {
			$apiObj->initCaches();
		}

		$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->commentid, array(
				'tx_commentsnotify_notify' => 0
		));

		// Clear cache
		$cacheidlist = strval($this->pid);
		if ($_SESSION['commentsPageOrigId']!=0) {
			$cacheidlist .= ', ' .$_SESSION['commentsPageOrigId'];
		}

		$pidListarr = t3lib_div::intExplode(',', $cacheidlist);

		$pidListarr=array_unique($pidListarr);

		if (version_compare(TYPO3_version, '6.0', '<')) {
			t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		} else {
			require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
		}

		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		// the $GLOBALS['TCA']-Patch for eID and FLUX
		if (!(isset($GLOBALS['TCA']))) {
			$GLOBALS['TCA'] = array();
			$GLOBALS['TCA']['tt_content'] = array();
		}
		/* @var $tce t3lib_TCEmain */
		foreach($pidListarr as $pid) {
			if($pid != 0) {
				$tce->clear_cacheCmd($pid);
			}

		}

		$apiObj->setPluginCacheControlTstamp($this->pluginid);
	}

	/**
	 * Processes comment Denotify submissions.
	 *
	 * @param	array		$piVars: array with piVars
	 * @param	object		$pObj: parent object
	 * @return	void
	 */
	protected function recentCommentsClearCache() {
		/* @var $apiObj toctoc_comments_api */
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		if(version_compare(TYPO3_version, '4.6', '<')) {

			$apiObj->initCaches();
		}

		if (version_compare(TYPO3_version, '6.0', '<')) {
			t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		} else {
			require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
		}

		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		// the $GLOBALS['TCA']-Patch for eID and FLUX
		if (!(isset($GLOBALS['TCA']))) {
			$GLOBALS['TCA'] = array();
			$GLOBALS['TCA']['tt_content'] = array();
		}

		$tce->clear_cacheCmd($this->pid);

		echo $this->pid;

	}
}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_ajax.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_ajax.php']);
}

// Make instance:
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$SOBE = t3lib_div::makeInstance('toctoc_comments_ajax');
$SOBE->main();

?>