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
 *  108: class toctoc_comments_ajax
 *  165:     public function __construct()
 *  350:     protected function launchCmd($data)
 *  887:     protected function initTSFE()
 *  961:     public function main()
 * 1016:     private function checksharre()
 * 1099:     public function handleCommentatorNotifications()
 * 1110:     protected function updateCommentDisplay()
 * 1128:     protected function updateComment()
 * 1143:     protected function webpagepreview()
 * 1155:     protected function previewcomment()
 * 1166:     protected function commentsSearch()
 * 1178:     protected function cleanupfup()
 * 1192:     public function getCaptcha($captchatype, $cid)
 * 1209:     public function chkcaptcha($cid, $code)
 * 1222:     protected function getUserCard()
 * 1234:     protected function getEmoCard()
 * 1246:     protected function getCurrentIp()
 * 1259:     protected function updateCommentsView()
 * 1564:     protected function updateRating()
 * 2261:     protected function processDeleteSubmission()
 * 2342:     protected function deleteDBcachereport($cachedEntities, $ref = '')
 * 2353:     protected function processDenotifycommentSubmission()
 * 2404:     protected function recentCommentsClearCache()
 * 2437:     protected function getAJAXDBCache($uid)
 *
 * TOTAL FUNCTIONS: 24
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(PATH_t3lib . 'class.t3lib_refindex.php');
	require_once(PATH_tslib . 'class.tslib_pibase.php');
	if (!version_compare(TYPO3_version, '4.6', '<')) {
		require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
	}

	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Database/ReferenceIndex.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Page/PageRepository.php';
}
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
	(class_exists('t3lib_utility_Math', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\MathUtility', 't3lib_utility_Math');
	if ((!t3lib_extMgm::isLoaded('compatibility6')) && (!t3lib_extMgm::isLoaded('compatibility7')))  {
		(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
		(class_exists('tslib_eidtools', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Utility\EidUtility', 'tslib_eidtools');
	}
	(class_exists('t3lib_refindex', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Database\ReferenceIndex', 't3lib_refindex');
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
	public $conf;
	private $piVars;
	private $cid;
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
	public $nosessclose = FALSE;

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
	public $commonObj;
	private $runMain = TRUE;
	private $dispatchmessage = '';
	private $echostr = '';



	/**
	 * Initializes the class
	 *
	 * @return	void
	 */
	public function __construct() {
		if (version_compare(TYPO3_version, '4.5', '<')) {
			// Initialize FE user object:
			$feUserObj = tslib_eidtools::initFeUser();
		}

		if (version_compare(TYPO3_version, '6.1', '<')) {
			tslib_eidtools::connectDB();
		}
		
		if ((isset($_POST['cmd'])) || (isset($_GET['cmd']))) {
			$this->cmd = t3lib_div::_GP('cmd');
			$data_str = t3lib_div::_GP('data');
			$data_uid = t3lib_div::_GP('data');
			if (intval($data_uid) != 0) {
				$data_str = $this->getAJAXDBCache($data_uid);
			}

			$data = unserialize(base64_decode($data_str));

			if (($this->cmd != 'getcap') && ($this->cmd != 'checkcap')) {
				$ajaxdna_str = t3lib_div::_GP('ajaxdna');
				$ajaxdna_arr = explode('l6l9l', $ajaxdna_str);
				$ajaxdna_check = md5($ajaxdna_arr[1] . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
				if ($ajaxdna_check != $ajaxdna_arr[0]) {
					echo 'Invalid AJAX dna';
					//echo $GLOBALS['LANG']->getLL('bad_dna') . '""';
					exit();
				} else {
					$ajaxdna_arr_arr = explode('g6g9g', $ajaxdna_arr[1]);
					$dnalanid = $ajaxdna_arr_arr[0];
					$dnalang = $ajaxdna_arr_arr[1];
					$dnafeuser = $ajaxdna_arr_arr[2];
					if (isset($data['feuser'])) {
						$data['feuser'] = $dnafeuser;
					}
					if (isset($data['lang'])) {
						$data['lang'] = $dnalang;
					}
					if (isset($data['langid'])) {
						$data['langid'] = $dnalanid;
					}
					if (isset($data['activelangid'])) {
						$data['activelangid'] = $dnalanid;
					}
				}				
	
				$this->nosessclose = FALSE;
				if (str_replace('preview', '', t3lib_div::_GP('cmd')) != t3lib_div::_GP('cmd')) {
					if (t3lib_div::_GP('cmd') != 'previewcomment') {
						$this->nosessclose = TRUE;
					}
					
				}
				
			}
		
		} else {
			$this->cmd = 'attachmentupload';
		}
		
		$this->pageid = 0;
		if (trim(t3lib_div::_GP('pageid')) != '') {
			$this->pageid = intval(t3lib_div::_GP('pageid'));
		}

		if ($this->cmd == 'searchcomment') {
			$this->initTSFE();
		} elseif (!isset($GLOBALS['TCA']['pages']['ctrl'])) {
			// make sure $GLOBALS['TCA'] is present
			$this->initTSFE();
		} elseif (!isset($GLOBALS['TSFE'])) {
			// make sure $GLOBALS['TSFE'] is present
			$this->initTSFE();
		} elseif (!isset($GLOBALS['TSFE']->page['content_from_pid'])) {
			// make sure $GLOBALS['TSFE']->page['content_from_pid'] is present
			$this->initTSFE();
		}

		if (version_compare(TYPO3_version, '4.3.99', '>') && (!isset($data['lang']))) {
			$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
			if ($this->nosessclose == FALSE) {

				if (!isset($_SESSION['activelang'])) {
					$sessionTimeout=1440;
					$this->commonObj->start_toctoccomments_session($sessionTimeout);
				}

			} else {
				session_start();
			}
			
			$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
			$GLOBALS['LANG']->init($_SESSION['activelang'] ? $_SESSION['activelang'] : 'default');
			$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/locallang_ajax.xml');
			$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/pi1/locallang.xml', TRUE, TRUE);
		} else {
			$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
			$GLOBALS['LANG']->init($data['lang'] ? $data['lang'] : 'default');
			$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/locallang_ajax.xml');
			$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/pi1/locallang.xml', TRUE, TRUE);

			$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
			if ($this->nosessclose == FALSE) {
				if (!isset($_SESSION['activelang'])) {
					$sessionTimeout=1440;
					$this->commonObj->start_toctoccomments_session($sessionTimeout);
				}
			} else {
				session_start();
			}

			$_SESSION['activelang'] = ($data['lang'] ? $data['lang'] : 'default');
		}

		if (isset($data['langid'])) {
			$_SESSION['activelangid'] = intval($data['langid']);
		}

		if ($this->cmd == 'dispatchAjax') {
			$dispatchData_str = t3lib_div::_GP('dispatchData');
			$data_uid = t3lib_div::_GP('dispatchData');
			if (intval($data_uid) != 0) {
				$dispatchData_str = $this->getAJAXDBCache($data_uid);
			}

			$dispatchData = unserialize(base64_decode($dispatchData_str));
			$this->nosessclose = TRUE;
			$locnosessclose = FALSE;

			if (is_array($dispatchData)) {
				foreach($dispatchData as $dispatch) {
					$_POST = array();
					$dispatched = base64_decode($dispatch);
					$dispatchPOST = explode('&', $dispatched);

					foreach($dispatchPOST as $patchPOST) {
						$patchvalPOST = array();
						$patchvalPOST = explode('=', $patchPOST);
						if ($patchvalPOST[0]=='cmd') {
							$this->cmd=$patchvalPOST[1];
							if ((strstr($this->cmd, 'preview')) && ($this->cmd != 'webpagepreviewajax')) {
								$locnosessclose = TRUE;
							}

						}
						if ($patchvalPOST[0]=='data') {
							$data_str = $patchvalPOST[1];
							$data_uid = $patchvalPOST[1];
							if (intval($data_uid) != 0) {
								$data_str = $this->getAJAXDBCache($data_uid);
							}

							$data = unserialize(base64_decode($data_str));
						}

						$_POST[$patchvalPOST[0]] = $patchvalPOST[1];
					}
					$this->launchCmd($data);
					$this->main();
				}

			} else {
				$this->dispatchmessage .= 'Error in PHP (unserialize), received invalid dispatch-array, length of string retrieved in AJAX: ' .
							strlen($dispatchData_str) .
							', number of elements in PHP-unserialized array: ' . count($dispatchData);
			}
			
			//if ($this->echostr != '') {
				//$this->dispatchmessage .= $this->echostr;
			//}			
			if ($locnosessclose == FALSE) {
				$this->commonObj->stop_toctoccomments_session();
			}

			$this->runMain = FALSE;

		} else {
			$this->nosessclose = FALSE;
			if (str_replace('preview', '', t3lib_div::_GP('cmd')) != t3lib_div::_GP('cmd')){
				if (t3lib_div::_GP('cmd') != 'previewcomment'){
					$this->nosessclose = TRUE;
				}

			}

			$this->launchCmd($data);
		}

	}
	/**
	 * laucher for commands either called induvidually or in dispatch mode, this means several times by AJAX-call
	 * Does basic checks on the data
	 *
	 * @param	array		$data: holding eg. conf, pid, feuser, and lang / langid
	 * @return	void
	 */
	protected function launchCmd($data) {

		if ($this->cmd == 'showcomments') {
			$confLogin=array();
			$confLoginSess=array();
			$data_strtmp = t3lib_div::_GP('dataLogin');
			$data_uid = t3lib_div::_GP('dataLogin');
			if (intval($data_uid) != 0) {
				$data_strtmp = $this->getAJAXDBCache($data_uid);
			}
			$confLogin = unserialize(base64_decode($data_strtmp));
			$data_strtmp = t3lib_div::_GP('dataLoginSess');
			$data_uid = t3lib_div::_GP('dataLoginSess');
			if (intval($data_uid) != 0) {
				$data_strtmp = $this->getAJAXDBCache($data_uid);
			}
			$confLoginSess = unserialize(base64_decode($data_strtmp));
		}

		if (trim($this->cmd) == '') {
			echo $GLOBALS['LANG']->getLL('bad_cmd_value') . '""';
			exit();
		}

		if ($this->cmd == 'previewcomment') {
			$dataconf_str = t3lib_div::_GP('dataconf');
			$data_uid = t3lib_div::_GP('dataconf');

			if (intval($data_uid) != 0) {
				$dataconf_str = $this->getAJAXDBCache($data_uid);
			}

			$dataconf = unserialize(base64_decode($dataconf_str));
			if (!is_array($dataconf['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd . ' (2)';
				exit();
			}

			$this->conf = $dataconf['conf'];
				
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
			$this->previewconf = $data;
		} elseif (($this->cmd == 'searchcomment') || ($this->cmd == 'searchbrowse')) {
			$dataconf_str = t3lib_div::_GP('data');
			
			$dataconf = unserialize(base64_decode($dataconf_str));
			
			$data_uid = $dataconf['conf'];
			if (intval($data_uid) != 0) {
				$dataconf_str = $this->getAJAXDBCache($data_uid);
			}
			
			$confdiffarray = unserialize(base64_decode($dataconf_str));

			if (!is_array($confdiffarray)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd . ' (1)';
				exit();
			}
			$this->conf = $confdiffarray;
				
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}
			$this->pluginid = t3lib_div::_GP('ref');
			$this->previewconf = $dataconf;
			
		} elseif ($this->cmd == 'gettime') {
			echo time();
			exit;
		} elseif ($this->cmd == 'commentsview') {
			$this->pluginid = t3lib_div::_GP('ref');
			$this->feuser = intval(t3lib_div::_GP('usr'));
			$this->pageid = intval(t3lib_div::_GP('pageid'));

			//conf in commentsview
			if (!is_array($data['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd . ', conf: ' . $data['conf'];
				exit();
			}
			
			$this->conf = $data['conf'];
			if ($this->conf == '') {
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

		} elseif ($this->cmd == 'checkcap') {
			// For captcha check we also go straight in the code inside the
			// class
			$this->captchacode = t3lib_div::_GP('code');
			$this->cid = t3lib_div::_GP('cid');
		} elseif (((strstr($this->cmd, 'preview')) && ($this->cmd != 'webpagepreviewajax')) || ($this->cmd == 'cleanupfup')) {
			// Pagepreviewrequests go api->lib->libpreview (if needed)
			$this->cid = t3lib_div::_GP('ref');

			$this->previewconf=$data;
			$data_strconf = t3lib_div::_GP('dataconf');
			$data_uid = t3lib_div::_GP('dataconf');
			if (intval($data_uid) != 0) {
				$data_strconf = $this->getAJAXDBCache($data_uid);
			}

			$dataconf = unserialize(base64_decode($data_strconf));
			if (!is_array($dataconf['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd . ' (4)';
				exit();
			}
			$this->conf = $dataconf['conf'];
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$data_strtmp = t3lib_div::_GP('dataconfatt');
			$data_uid = t3lib_div::_GP('dataconfatt');
			if (intval($data_uid) != 0) {
				$data_strtmp = $this->getAJAXDBCache($data_uid);
			}

			$dataconfatt = unserialize(base64_decode($data_strtmp));
			$this->conf = $dataconfatt['conf'];

			$this->previewid = t3lib_div::_GP('previewid');
			
			if (!is_array($this->conf)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ' (2: ' . $this->cmd .') ' . $this->conf . ' - ' . $data_strtmp;
				exit();
			}

			if ($this->cmd == 'cleanupfup'){
				$ofn = t3lib_div::_GP('originalfilename');
				$this->originalfilename = base64_decode($ofn);
			}

		} elseif ($this->cmd == 'getuc') {
			// get the UserCard

			$this->basedimgstr = t3lib_div::_GP('imagetag');
			$this->basedtoctocuid = t3lib_div::_GP('toctocuserid');
			$this->commentid=t3lib_div::_GP('commentid');
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->commentid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->commentid);
			}

			if (!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_commentid_value') . ': ' . $this->commentid;
				exit();
			}

			$this->conf = $data['conf'];
			
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
		} elseif ($this->cmd == 'getemorslt') {
			// get the emolikeoverviewCard
			if (!$this->feUserObj){
				$this->feUserObj = tslib_eidtools::initFeUser();
			}
			$this->feuser = intval($this->feUserObj->user['uid']);

			$this->basedimgstr = t3lib_div::_GP('imagedata');
			$this->cid = t3lib_div::_GP('cid');
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->cid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->cid);
			}

			if (!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_cid_value') . ': ' . $this->commentid;
				exit();
			}
			$this->ref = trim(t3lib_div::_GP('ref'));
			$this->conf = $data['conf'];
			
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
		} elseif ($this->cmd == 'handlecn') {
			$this->conf = $data['conf'];
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			$this->pluginid = $data['ref'];
			$this->pid = $data['pid'];
			$this->ref = trim(t3lib_div::_GP('ref'));
			if (trim($this->ref) == '') {
				echo $GLOBALS['LANG']->getLL('bad_ref_value');
				exit();
			}

		} elseif ($this->cmd == 'updatect') {
			$this->conf = $data['conf'];
			if ($this->conf == '') {
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
		} elseif ($this->cmd == 'checksharre') {
			$this->storagePid= t3lib_div::_GP('storagePid');
			$this->conf = $data;
			$this->pageid = t3lib_div::_GP('pageid');
		} elseif ($this->cmd == 'webpagepreviewajax') {
			$this->ref = $_POST['ref'];
		}  elseif ($this->cmd == 'attachmentupload') {
			$this->ref = 'none';
		} else {
			// More Sanity checks

			if (intval(t3lib_div::_GP('softcheck'))) {
				// no piVars check when deleting and then rescanning comments
				$this->softcheck = intval(t3lib_div::_GP('softcheck'));
			}
			if (!is_array($data['conf'])) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ', diffconf in ' .$this->cmd . ' (3)';
				exit();
			}

			$this->conf = $data['conf'];
			if ($this->conf == '') {
				echo $GLOBALS['LANG']->getLL('session_expired');
				exit();
			}

			// Is the configuration array really an array
			if (!is_array($this->conf)) {
				echo $GLOBALS['LANG']->getLL('bad_conf_value') . ' (1)';
				exit();
			}

			// we 'preload the Page ID of the request
			$this->pid = $data['pid'];
			$this->pluginid = $data['ref'];
			if ((strpos($this->cmd, 'ote') === FALSE) && (strpos($this->cmd, 'like') === FALSE) && ($this->cmd !== 'deletecomment') &&
					($this->cmd !== 'denotifycomment') && (strpos($this->cmd, 'browse') === FALSE)) {
				// apart from the cases we don't need the piVars we check now if
				// they are accordingly formatted
				// this is important for new comment submissions
				$datacommentstr = t3lib_div::_GP('datac');
				$datacomment = unserialize(base64_decode($datacommentstr));
				$this->piVars = $datacomment;
				if (!$this->softcheck) {
					// no piVars check when deleting and then rescanning comments
					if (!is_array($this->piVars)) {
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

			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = is_numeric($this->rating);
			} else {
				$tmpint = is_numeric($this->rating);
			}

			if (!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_rating_value') . ': ' . $this->rating;
				exit();
			}

			// reference is always sent along the request, is needed
			$this->ref = trim(t3lib_div::_GP('ref'));
			if (trim($this->ref) == '') {
				echo $GLOBALS['LANG']->getLL('bad_ref_value');
				exit();
			}

			if ($this->cmd === 'addcomment'){
				$this->extref = t3lib_div::_GP('extref');
				$this->commentreplyid = t3lib_div::_GP('commentreplyid');
				if (trim($this->extref) == '') {
					echo $GLOBALS['LANG']->getLL('bad_ref_value') . ' (external)';
					exit();
				}

			} else {
				if ($this->cmd === 'showcomments'){

					$this->extref = t3lib_div::_GP('extref');
					if (trim($this->extref) == '') {
						echo $GLOBALS['LANG']->getLL('bad_ref_value') . ' (external, showcomments)';
						exit();
					}

				}

			}

			// the user id may be 0, but we need to check if it's int
			if (intval(t3lib_div::_GP('isrefresh')) == 0) {
				$this->feuser = $data['feuser'];
			} else {
				if ($this->cmd === 'showcomments'){
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

			if ($this->feuser === 0) {
				$tmpint = 1;
			} else {
				if (version_compare(TYPO3_version, '4.6', '<')) {
					$tmpint = t3lib_div::testInt($this->feuser);
				} else {
					$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->feuser);
				}

			}

			if (!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_feuser_value') . ': ' . $this->feuser;
				exit();
			}

			// now lets check the check
			$this->overallvote = intval(t3lib_div::_GP('overall'));
			$this->pageid = intval(t3lib_div::_GP('pageid'));
			$this->check = t3lib_div::_GP('check');
			if (($this->cmd !== 'deletecomment') && ($this->cmd !== 'denotifycomment') && (strpos($this->cmd, 'rowse') === FALSE)) {
				if (md5($this->ref . $chkrating . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $this->check) {
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
					if (version_compare(TYPO3_version, '4.6', '<')) {
						$tmpint = t3lib_div::testInt($this->commentid);
					} else {
						$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->commentid);
					}

					if (!$tmpint) {
						echo $GLOBALS['LANG']->getLL('bad_commentid_value') . ': ' . $this->commentid;
						exit();
					}

					if (md5($this->commentid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $this->check) {
						echo 'deletecomment: ' . $GLOBALS['LANG']->getLL('wrong_check_value') . ' for comment ' . $this->commentid;
						exit();
					}

				}

			}

			// checking the pid
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->pid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->pid);
			}

			if (!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_pid_value');
				exit();
			}

			// checking the cid
			$this->cid = $data['cid'];

			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($this->cid);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->cid);
			}

			if (!$tmpint) {
				echo $GLOBALS['LANG']->getLL('bad_cid_value');
				exit();
			}

			if ((strpos($this->cmd, 'ote') === FALSE) && (strpos($this->cmd, 'like') === FALSE) && ($this->cmd !== 'deletecomment') &&
					($this->cmd !== 'denotifycomment')) {
				// getting the information from the pi-Form
				$datathiscommentstr = t3lib_div::_GP('datathis');
				$data_uid = t3lib_div::_GP('datathis');
				if (intval($data_uid) != 0) {
					$datathiscommentstr = $this->getAJAXDBCache($data_uid);
				}

				$datathiscomment = unserialize(base64_decode($datathiscommentstr));
				$this->datathis = $datathiscomment;
				if (!is_array($this->datathis)) {
					echo $GLOBALS['LANG']->getLL('bad_Ajax_value');
					exit();
				}

				// We add capass to the datathis array so its where it belongs
				// to I hope
				$this->datathis['sessionCaptchaData'] = t3lib_div::_GP('capsess');

				if (strpos($this->cmd, 'rowse') !== FALSE) {
					$this->datathis['totalrows'] = t3lib_div::_GP('totalrows');
					$this->datathis['startpoint'] = t3lib_div::_GP('startpoint');
					$this->ref = trim(t3lib_div::_GP('ref'));
				}

				// from a logged in user the pic - we need it after the insert
				// in the form
				$this->userpic = base64_decode(t3lib_div::_GP('userpic'));
				if (str_replace('>', '', $this->userpic) == $this->userpic) {
					$this->userpic .= '>';
				}

				if (($this->cmd === 'showcomments') || (strpos($this->cmd, 'rowse') !== FALSE)) {
					// for comments and browser we need the commentimgs, this is
					// in the 3rd Ajaxarray
					$data_str = t3lib_div::_GP('commentsimgs');
					$data_uid = t3lib_div::_GP('commentsimgs');
					if (intval($data_uid) != 0) {
						$data_str = $this->getAJAXDBCache($data_uid);
					}
					$data = unserialize(base64_decode($data_str));
					$this->commentspics = $data;

					$data_str = t3lib_div::_GP('tctreestateenc');
					$data = unserialize(base64_decode($data_str));
					$this->tctreestate = $data;

				} else {
					$this->commentspics = Array();
				}

				if (!is_array($this->commentspics)) {
					echo $GLOBALS['LANG']->getLL('bad_commentspics_value') . ': ' . $this->commentspics;
					exit();
				}

			} elseif (strpos($this->cmd, 'ike') !== FALSE) {
				$data_str = t3lib_div::_GP('commentsimgs');
				$data_uid = t3lib_div::_GP('commentsimgs');
				if (intval($data_uid) != 0) {
					$data_str = $this->getAJAXDBCache($data_uid);
				}

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
		if (version_compare(TYPO3_version, '8.0', '>')) {
			\TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();
		}

		if (version_compare(TYPO3_version, '6.1', '>')) {
			if (!isset($GLOBALS['TCA']['pages']['ctrl'])) {
				\TYPO3\CMS\Core\Core\Bootstrap::getInstance()->loadCachedTca();
			} else {
				if (!isset($GLOBALS['TCA']['pages']['ctrl'])) {
					\TYPO3\CMS\Core\Core\Bootstrap::getInstance()->loadCachedTca();
				}
			}

		}

		if (!isset($GLOBALS['TCA'])) {
			$GLOBALS['TCA'] = array();
		}

		if (!isset($GLOBALS['TCA']['pages'])) {
			$GLOBALS['TCA']['pages'] = array();
		}

		if (!isset($GLOBALS['TCA']['pages']['columns'])) {
			$GLOBALS['TCA']['pages']['columns'] = array();
		}

		try {
			/** @var $frontend TypoScriptFrontendController */
			$pgitdone = FALSE;

			if (!isset($GLOBALS['TSFE'])) {
				if (version_compare(TYPO3_version, '4.8', '>')) {
					$frontend = t3lib_div::makeInstance(
							'TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController',
							$GLOBALS['TYPO3_CONF_VARS'], $this->pageid, ''
					);
				} else {
					$frontend = t3lib_div::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], $this->pageid, '');
				}

				$GLOBALS['TSFE'] = & $frontend;

				if (version_compare(TYPO3_version, '8.0.99', '>')) {
						\TYPO3\CMS\Frontend\Page\PageGenerator::pagegenInit();
						$pgitdone = TRUE;
				}

				$frontend->initFEuser();
				$frontend->determineId();
				$frontend->initTemplate();
	 			$frontend->getConfigArray();
			}

			if ($pgitdone == FALSE) {
				//       // Get linkVars, absRefPrefix, etc
				if (version_compare(TYPO3_version, '4.8', '>')) {
					\TYPO3\CMS\Frontend\Page\PageGenerator::pagegenInit();
				} else {
					TSpagegen::pagegenInit();
				}
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

			if ($this->runMain == TRUE) {

			if ((strpos($this->cmd, 'ote') !== FALSE) || (strpos($this->cmd, 'like') !== FALSE)) {
				$this->updateRating();
			} elseif ($this->cmd == 'commentsview') {
				$this->updateCommentsView();
			} elseif ($this->cmd == 'getuc') {
				$this->getUserCard();
			} elseif ($this->cmd == 'getemorslt') {
				$this->getEmoCard();
			} elseif ($this->cmd == 'handlecn') {
				$this->handleCommentatorNotifications();
			} elseif (($this->cmd == 'getcap')) {
				$this->getCaptcha($this->captchatype, $this->cid);
			} elseif (($this->cmd == 'checkcap')) {
				$this->chkcaptcha($this->cid, $this->captchacode);
			} elseif (($this->cmd == 'deletecomment')) {
				$this->processDeleteSubmission();
			} elseif (($this->cmd == 'denotifycomment')) {
				$this->processDenotifycommentSubmission();
			} elseif (($this->cmd == 'updatect')) {
				$this->updateComment();
			} elseif (($this->cmd == 'searchcomment') || ($this->cmd == 'searchbrowse')) {
				$this->commentsSearch();
			} elseif ($this->cmd == 'previewcomment'){
				$this->previewcomment();
			} elseif ((strstr($this->cmd, 'preview')) && ($this->cmd != 'webpagepreviewajax')) {
				$this->nosessclose = TRUE;
				$this->webpagepreview();
			} elseif ($this->cmd == 'cleanupfup'){
				$this->cleanupfup();
			} elseif ($this->cmd == 'rcclearcache'){
				$this->recentCommentsClearCache();
			} elseif ($this->cmd == 'checksharre') {
				$this->checksharre();
			} elseif ($this->cmd == 'webpagepreviewajax') {
				require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_webpagepreview_ajax.php'));
				$webpagepreviewObj = t3lib_div::makeInstance('toctoc_comments_getpagepreview');
				$webpagepreviewObj->main($_POST['cmd'], $this->ref, $_POST['dataconf'], $_POST['dataconfatt'], $_POST['data'], $this);
			} elseif ($this->cmd == 'attachmentupload') {
				require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_attachmentupload.php'));
				$attachmentuploadObj = t3lib_div::makeInstance('toctoc_comments_attachmentupload');
				$attachmentuploadObj->main($_FILES, $_POST, $this);
			} else {
				$this->updateCommentDisplay();
			}

			if ($this->nosessclose == FALSE) {
				$this->commonObj->stop_toctoccomments_session();
			}

		} else {
			echo $this->dispatchmessage;
		}

	}
	/**
	 * checks the sharrre-array from the client against the DB and maintains the sharing-table
	 *
	 * @return	string		empty
	 */
	private function checksharre() {
		$ret = '';
		$countsharings = count($this->conf);
		$protocol = 'confcountsharings: ' . $countsharings . '<br>';
		for ($i = 0;$i < $countsharings; $i++) {
			$dataWhere = 'deleted=0 AND pid=' . intval($this->storagePid) . ' AND reference="' . $this->pageid . '" AND sharer="' .
					$this->conf[$i]['sharer'] . '" AND external_prefix="' .
					$this->conf[$i]['external_prefix'] . '" AND external_ref="' .
					$this->conf[$i]['external_ref'] . '" AND sys_language_uid=' .
					$this->conf[$i]['lang'] . ' AND shareurl="' . $this->conf[$i]['url'] . '"';
			$protocol .= '<br>'. 'sharer: ' . $this->conf[$i]['sharer'] . ' with ' . intval($this->conf[$i]['count']) . '<br>';
			$protocol .= '<br>'. 'url: ' . $this->conf[$i]['url'] . '<br>';

			list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('crdate AS LastChangedTime, uid AS uid, sharecount AS sharecount',
					'tx_toctoc_comments_sharing', $dataWhere, '', 'crdate DESC', 1);

			$protocol .= 'sharecount: ' . intval($row['sharecount']) . '<br>';
			$protocol .= 'confcount: ' . intval($this->conf[$i]['count']) . '<br>';
			$protocol .= 'dataWhere: ' . $dataWhere . '<br>';

			if (intval($row['sharecount']) != intval($this->conf[$i]['count'])) {

				$continuewithinsert = TRUE;
				if (intval($row['sharecount']) == 1 && intval($this->conf[$i]['count']) == 0) {
					// to reset to 0 can come from a missing total.
					if ((time() - $row['LastChangedTime']) < 86000) {
						// please - this only after a day after the last insert
						$continuewithinsert = FALSE;
					}

				}

				if (intval($row['sharecount']) - intval($this->conf[$i]['count']) > 1) {
					// felt down by more than 1 since last observation
					if ((time() - $row['LastChangedTime']) < 86000) {
						// also this only after a day after the last insert
						$continuewithinsert = FALSE;
					}

				}

				if ($continuewithinsert == TRUE) {
				//insert the sharer with the new count
					$protocol .= 'insert the sharer ' . $this->conf[$i]['sharer'] . ' with the new count: ' . $this->conf[$i]['count'] . '<br>';
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_sharing', array(
						'crdate' => time(),
						'reference' => $this->pageid,
						'tstamp' => time(),
						'sharecount' => $this->conf[$i]['count'],
						'pid' => $this->storagePid,
						'sharer' => $this->conf[$i]['sharer'],
						'shareurl' => $this->conf[$i]['url'],
						'external_ref' => $this->conf[$i]['external_ref'],
						'external_prefix' => $this->conf[$i]['external_prefix'],
						'sys_language_uid' => $this->conf[$i]['lang'],
					));

					$this->deleteDBcachereport('sharings');

					$this->conf[$i]['sharer'] . ' with url ' . $this->conf[$i]['url'] . ', count: ' . $this->conf[$i]['count'] . ' ----';

					$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
					// Update reference index. This will show in theList view that someone refers to external record.
					$refindex = t3lib_div::makeInstance('t3lib_refindex');
					/* @var $refindex t3lib_refindex */
					if (isset($GLOBALS['TCA']['tx_toctoc_comments_sharing']['columns'])) {
						$refindex->updateRefIndexTable('tx_toctoc_comments_sharing', $newUid);
					}

				}

			}

		}

		echo '';//$protocol;
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
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$apiObj->initCaches();
		}

		$piVars = $this->piVars;
		echo $apiObj->getAjaxCommentDisplay($this->ref, $this->conf, TRUE, $this->pid, $this->feuser, $this->cmd, $this->piVars, $this->cid, $this->datathis,
				$this->userpic, $this->commentspics, $this->check, $this->extref, $this->tctreestate, $this->commentreplyid, $this->isrefresh,
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
		if (version_compare(TYPO3_version, '4.6', '<')) {
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
	public function getCaptcha($captchatype, $cid) {

		require_once(t3lib_extMgm::extPath('toctoc_comments') . 'pi1/class.toctoc_comments_captcha.php');
		$freeCap = t3lib_div::makeInstance('toctoc_comments_captcha');

		$cap = $freeCap->getCaptcha($captchatype, $cid);
		return $cap;

	}
/**
 * Checks a captcha entry
 *
 * @param	string		$cid: content element id
 * @param	string		$code: captcha code
 * @param	[type]		$noecho: ...
 * @return	int
 */
	public function chkcaptcha($cid, $code) {

		require_once(t3lib_extMgm::extPath('toctoc_comments') . 'pi1/class.toctoc_comments_captcha.php');
		$freeCap = t3lib_div::makeInstance('toctoc_comments_captcha');
		$freeCap->chkcaptcha($cid, $code, FALSE);

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
	 * Retrieves current IP address
	 *
	 * @return	string		Current IP address
	 */
	protected function getEmoCard() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */

		$content = $apiObj->getEmoCard($this->conf, $this->cid, $this->ref, intval($this->feuser));
		print($content);
	}
	/**
	 * Retrieves current IP address
	 *
	 * @return	string		Current IP address
	 */
	protected function getCurrentIp() {
		if (preg_match('/^\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		return $_SERVER['REMOTE_ADDR'];
	}

		/**
 * Updates rating data and outputs new result
 *
 * @return	void
 */
	protected function updateCommentsView() {
		$feusertoinsert = intval($this->feuser);
		//$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		$strCurrentIP = $this->getCurrentIp();
		$pageid= $this->pageid;
		$GLOBALS['TYPO3_DB']->sql_query('START TRANSACTION');
		$pluginid= $this->pluginid;
		$action='try';
		if (intval($this->feuser) === 0) {

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
		$this->echostr .= time() . ' - ' . $_SESSION['viewMaxAgeDone'] . '-' . intval($_SESSION['viewMaxAgeDone']) . ' *** ';
		// seen compress to viewMaxAge
		if (intval($_SESSION['viewMaxAgeDone']) == 0) {

			//check timestamp last update
			$external_ref_uid = 'tx_toctoc_comments_feuser_mm_0';
			$res2 = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('external_ref_uid, tstamp, uid', 'tx_toctoc_comments_plugincachecontrol', 'external_ref_uid="'.
					$external_ref_uid.'"', '', '');
			$num_rows2 = count($res2);
			$viewscheckneeded= FALSE;
			if ($num_rows2>0) {
				$lastchecktime = $res2[0]['tstamp'];
				$this->echostr .= time() . ' - ' . $lastchecktime . ', ' . $num_rows2 . ', ' . $_SESSION['viewMaxAgeDone'] . ' *** ';
				if ((time() - $lastchecktime) > 86000) {
					$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET ' .
						'tstamp=' . time() .
						' WHERE external_ref_uid ="' . $external_ref_uid . '"');
					$viewscheckneeded= TRUE;
				}
			} else {
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_plugincachecontrol',
						array(
								'tstamp' => time(),
								'external_ref_uid' => $external_ref_uid,
						)
				);
				$viewscheckneeded = TRUE;
			}
			$_SESSION['viewMaxAgeDone']=1;

			if ($viewscheckneeded == TRUE) {
				$compressAgeDifferenceSeconds = intval($this->conf['advanced.']['viewMaxAge'])*86000;
				$compressAgeTime = time() - $compressAgeDifferenceSeconds;
				$dataWhere = 'tstampseen < ' . $compressAgeTime . ' AND seen >= 1 AND deleted=0 AND reference_scope=0 AND toctoc_comments_user<>"0.0.0.127.0"';
				$limitrows = 100000;

				/* @var $refindex t3lib_refindex */
				$refindex = t3lib_div::makeInstance('t3lib_refindex');

				Do {
					//$GLOBALS['TYPO3_DB']->sql_query('START TRANSACTION');
					$rows = array();
					$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('(ilike+idislike+myrating) as rateval, pagetstampseen AS pagetstampseen,
							tstampseen AS tstampseen, pid AS pid, reference AS reference, seen AS seen, uid AS uid',
							'tx_toctoc_comments_feuser_mm',
							$dataWhere,
							'',
							'reference, pid, tstampseen',
							$limitrows);
					// brings all 'too old' seens
					$limitrows = count($rows);

					if ($limitrows > 0) {
						$arr127 = array();
						$arr127cnt = 0;
						$rowreference='';
						$rowpid='';
						foreach($rows as $row) {
							if (($rowreference != $row['reference']) || ($rowpid != $row['pid'])) {
								$arr127[$arr127cnt] = array();
								$arr127[$arr127cnt]['reference'] = $row['reference'];
								$arr127[$arr127cnt]['pid'] = $row['pid'];
								$arr127[$arr127cnt]['tstampseen'] = $row['tstampseen'];
								$arr127[$arr127cnt]['pagetstampseen'] = $row['pagetstampseen'];
								$arr127[$arr127cnt]['seen'] = $row['seen'];
								$arr127cnt++;
							} else {
								if ((($arr127[$arr127cnt]['tstampseen'] > $row['tstampseen']) && (intval($row['tstampseen'])>0)) ||
										((intval($arr127[$arr127cnt]['tstampseen'])==0) && (intval($row['tstampseen'])>0))) {
									$arr127[$arr127cnt]['tstampseen'] = $row['tstampseen'];
								}
								$arr127[$arr127cnt]['seen'] += $row['seen'];
							}

							$dataWhereup = 'uid=' . $row['uid'];
							if ($row['rateval'] > 0) {
								//update to 0
								$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET seen=0,
										pagetstampseen=NULL, tstampseen=NULL WHERE ' . $dataWhereup);

							} else {
								// delete
								$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_feuser_mm WHERE ' . $dataWhereup);

							}

						}

						foreach($arr127 as $row) {
							$dataWhere = 'pid=' . intval($row['pid']) . ' AND deleted=0 AND reference_scope=0 AND reference="' . $row['reference'] .
							'" AND toctoc_comments_user="0.0.0.127.0"';
							$rows127 = array();
							$rows127 = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('pagetstampseen AS pagetstampseen, tstampseen AS tstampseen, seen AS seen, uid AS uid',
									'tx_toctoc_comments_feuser_mm', $dataWhere);

							if (count($rows127) > 0) {
								if (is_array($rows127[0])) {
									$rows127uid = $rows127[0]['uid'];
									$rows127seen= $rows127[0]['seen'];
									$rows127tstampseen=$rows127[0]['tstampseen'];
								} else {
									$rows127uid = $rows127['uid'];
									$rows127seen= $rows127['seen'];
									$rows127tstampseen=$rows127['tstampseen'];
								}

								if ($rows127uid > 0) {
									$dataWhereup = 'uid=' . $rows127uid;
									if ((($rows127tstampseen > $row['tstampseen']) && (intval($row['tstampseen'])>0)) ||
											((intval($rows127tstampseen)==0) && (intval($row['tstampseen'])>0))) {
										$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET tstamp = ' . $row['tstampseen'] .
												', crdate = ' . $row['tstampseen'] .
												', tstampseen = ' . $row['tstampseen'] .
												', seen = ' . (intval($rows127seen) + intval($row['seen']))  .
												' WHERE ' . $dataWhereup);
									} else {
										$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET seen=' .
												(intval($rows127seen) + intval($row['seen']))  . ' WHERE ' . $dataWhereup);
									}

								}
							} else {
								$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
										'crdate' => $row['tstampseen'],
										'tstampseen' => $row['tstampseen'],
										'pagetstampseen' => $row['pagetstampseen'],
										'tstamp' => $row['tstampseen'],
										'seen' => intval($row['seen']),
										'pid' => $row['pid'],
										'idislike' => 0,
										'myrating' => 0,
										'toctoc_commentsfeuser_feuser' => 0,
										'toctoc_comments_user' => '0.0.0.127.0',
										'reference' => $row['reference'],
										'reference_scope' => 0,
										'remote_addr' => '0.0.0.127'
								));

								$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
								// Update reference index. This will show in theList view that someone refers to external record.
								if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
									$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
								}
							}

						}

					}

				} while ($limitrows > 10);
			// delete orphans in tx_toctoc_comments_user
				$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_user WHERE
					vote_count = 0 AND like_count = 0 AND dislike_count = 0 AND
					toctoc_comments_user NOT IN (SELECT DISTINCT toctoc_comments_user FROM tx_toctoc_comments_feuser_mm) AND
					toctoc_comments_user NOT IN (SELECT DISTINCT toctoc_comments_user FROM tx_toctoc_comments_comments)');

			}

		}

		// seen compress to viewMaxAge end
		$GLOBALS['TYPO3_DB']->sql_query('COMMIT');

		$dataWhere = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $pluginid . '" AND toctoc_comments_user=' .
						$fetoctocusertoquery .'';
		list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('seen AS seenrows, uid AS insertedrows', 'tx_toctoc_comments_feuser_mm', $dataWhere);

		if (intval($row['insertedrows'] > 0)) {
			if (intval($row['seenrows']) == 0) {
				//update to 1
				$action='update';

				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET seen=1,
						pagetstampseen=' . $pageid . ', tstampseen=' . time() . ', tstamp=' . time() . ' WHERE ' . $dataWhere);

				$this->deleteDBcachereport('views', $pluginid);
			}

		} else {
			$action='insert';
			$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_feuser_mm',
					'deleted=1 AND pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $pluginid . '" AND toctoc_comments_user=' .
						$fetoctocusertoquery .'');
			$this->deleteDBcachereport('views', $pluginid);
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
			$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
			// Update reference index. This will show in theList view that someone refers to external record.
			$refindex = t3lib_div::makeInstance('t3lib_refindex');
			/* @var $refindex t3lib_refindex */
			if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
				$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
			}

			$this->deleteDBcachereport('views', $pluginid);
		}

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
				if (version_compare(TYPO3_version, '4.6', '<')) {
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
			if (intval($this->conf['advanced.']['viewsCacheDelay']) == 0) {
				$viewsCacheDelay = 3*60*1000;
			} else {
				$viewsCacheDelay = intval($this->conf['advanced.']['viewsCacheDelay'])*60*1000;
			}
			$droptime = (time()*1000) - $viewsCacheDelay;
			if ($tdifftolastrun>$droptime) {
				if (!isset($apiObj)) {
					$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
				}

				$_SESSION['commentViewsUpdateTimePlugin'][$pluginid]=microtime(TRUE);
				
				$this->echostr .= time() . ' - ' . $viewsCacheDelay/1000 . ',tdifftolastrun: ' . $tdifftolastrun . ' *** ';
				$apiObj->setPluginCacheControlTstamp($setPluginCacheControlTstamppluginid, (microtime(TRUE)-(intval($this->conf['advanced.']['viewsCacheDelay'])*60)));
				$action .= ' setPluginCache id ' . $setPluginCacheControlTstamppluginid;
			}

		}

	}

	/**
	 * Updates rating data and outputs new result
	 *
	 * @return	void
	 */
	protected function updateRating() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$apiObj->initCaches();
		}
		$saveratingsdisableIpCheck = $this->conf['ratings.']['disableIpCheck'];
		$pageid= $this->pageid;
		$ratingarr=explode('-', trim($this->ref));
		$scopeid = 0;
		$countratingarr = count($ratingarr);
		if ($countratingarr==2) {
			$this->ref=$ratingarr[0];
			$scopeid =intval($ratingarr[1]);

		}
		if (!$this->feUserObj){
			$this->feUserObj = tslib_eidtools::initFeUser();
		}

		if (intval($this->feuser)==0){
			$this->feuser = intval($this->feUserObj->user['uid']);
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

		if ($this->conf['ratings.']['disableIpCheck'] || ($alreadyvoted == FALSE) || ($ratingsmode=='autostatic') ||
				!(($this->cmd == 'vote') || ($this->cmd == 'votearticle'))) {
			$feusertoinsert = 0;
			$fetoctocusertoinsert = '';
			$fetoctocusertoquery = '';

			$strCurrentIP = $this->getCurrentIp();
			$newlastname= '';
			$newfirstname= '';
			$newemail= '';
			$newwww= '';
			$newloc= '';
			if (intval($this->feuser) === 0) {
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

			if (($this->cmd == 'vote') || ($this->cmd == 'votearticle') || (strpos($this->cmd, 'ike') !== FALSE)) {

				$dataWhere = 'pid=' . intval($this->conf['storagePid']) . ' AND reference="' . $this->ref . '" AND reference_scope=' . $scopeid;
				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_ratings_data', $dataWhere);

				// vote of the user
				$dataWheremm = 'deleted=0 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '' .
								' AND reference="' . $this->ref . '" AND reference_scope=' . $scopeid;
				list($rowmm) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tmm, SUM(ilike) AS ilike, SUM(idislike) AS idislike, MIN(emolikeid) AS emolikeid, AVG(myrating) as avgmyrating',
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
						if ($rowmmscp['tmm'] > 0) {
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

			if (($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
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
				if ($row['t'] > 0) {
					if (($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
						if ($this->conf['ratings.']['disableIpCheck']) {
							if ($alreadyvoted)  {
								$thevotes = 0;
								$therating = 0;
								if ($rowmm['tmm'] > 0) {
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
						$this->deleteDBcachereport('ratings', $this->ref);
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_ratings_data SET isreview='. $isReview . ', vote_count=vote_count+'.$thevotes .
								',rating=rating+' . $therating . ', tstamp=' . time() . ' WHERE ' . $dataWhere);
					}

				} else {
					if (($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
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
					$this->deleteDBcachereport('ratings', $this->ref);

				}
			}

			if ($this->votes==0) {
				$this->votes=1;
			}

			$locrating=$this->rating;
			if ($this->overallvote==1) {
				$locrating=$this->rating/$this->votes;
			}

			if ($rowmm['tmm'] > 0) {
				if (($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
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
				} elseif ($this->cmd === 'unlike') {
					if ($rowmm['idislike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET idislike=0, pagetstampidislike=' . $pageid .
								', tstampidislike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$_SESSION['dislikeditem'] = array();
						$_SESSION['dislikeditem']['pageid'] = $pageid;
						$_SESSION['dislikeditem']['IP'] = $strCurrentIP;
						$_SESSION['dislikeditem']['time'] = time();
						$_SESSION['dislikeditem']['ref'] = $this->ref;
						$_SESSION['dislikeditem']['toctoc_user'] = $fetoctocusertoinsert;
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=0, idislike=1, pagetstampidislike=' . $pageid .
								', tstampidislike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					}

				} elseif (($this->cmd === 'like')) {
					if ($rowmm['ilike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=0, pagetstampilike=' . $pageid . ', tstampilike=' .
								time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=1, idislike=0, pagetstampilike=' . $pageid .
								', tstampilike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '"  WHERE ' . $dataWheremm);
					}

				} elseif ($this->cmd === 'unlikeemo') {
					if ($rowmm['idislike'] > 0) {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET idislike=0, pagetstampidislike=' . $pageid .
								', tstampidislike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					} else {
						$_SESSION['dislikeditem'] = array();
						$_SESSION['dislikeditem']['pageid'] = $pageid;
						$_SESSION['dislikeditem']['IP'] = $strCurrentIP;
						$_SESSION['dislikeditem']['time'] = time();
						$_SESSION['dislikeditem']['ref'] = $this->ref;
						$_SESSION['dislikeditem']['toctoc_user'] = $fetoctocusertoinsert;
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=0, idislike=1, pagetstampidislike=' . $pageid .
								', tstampidislike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
					}

				} elseif (($this->cmd === 'likeemo')) {
					if ($rowmm['ilike'] > 0) {
						if ($rowmm['emolikeid'] <> $this->rating) {
							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET pagetstampilike=' . $pageid . ', tstampilike=' .
									time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
						} else {
							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=0, pagetstampilike=' . $pageid . ', tstampilike=' .
									time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
						}

					} else {
						if ($rowmm['emolikeid'] <> $this->rating) {

							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=1, idislike=0, pagetstampilike=' . $pageid .
								', tstampilike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '"  WHERE ' . $dataWheremm);
						} else {
							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET ilike=0, idislike=0, pagetstampilike=' . $pageid .
									', tstampilike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '"  WHERE ' . $dataWheremm);
						}

					}

				}

				if (($this->cmd === 'unlikeemo') || ($this->cmd === 'likeemo')) {
 					if ($rowmm['emolikeid'] == $this->rating) {
 						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET emolikeid="", pagetstampilike=' . $pageid . ', tstampilike=' .
 								time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '" WHERE ' . $dataWheremm);
 					} else {
						$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_feuser_mm SET emolikeid='.$this->rating.', pagetstampilike=' . $pageid .
								', tstampilike=' . time() . ', tstamp=' . time() . ', remote_addr="' . $strCurrentIP . '"  WHERE ' . $dataWheremm);
					}

				}
				$this->deleteDBcachereport('ratings', $this->ref);

			} else {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_feuser_mm',
										'deleted=1 AND pid=' . intval($this->conf['storagePid']) . ' AND toctoc_comments_user = ' . $fetoctocusertoquery . '' .
										' AND reference="' . $this->ref . '"');

				if (($this->cmd == 'vote') || ($this->cmd == 'votearticle')) {
					if ($allowedNumberOfRatingsExceededBlocktimeMessage == '') {

						if (($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
									'crdate' => time(),
									'tstampmyrating' => time(),
									'pagetstampmyrating' => $pageid,
									'tstampseen' => time(),
									'pagetstampseen' => $pageid,
									'seen' => 1,
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
							$this->deleteDBcachereport('ratings', $this->ref);
							$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
							// Update reference index. This will show in theList view that someone refers to external record.
							$refindex = t3lib_div::makeInstance('t3lib_refindex');
							/* @var $refindex t3lib_refindex */
							if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
								$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
							}
						}
					}

				} elseif ($this->cmd == 'unlike') {
					if (($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstamp' => time(),
								'tstampidislike' => time(),
								'pagetstampidislike' => $pageid,
								'tstampseen' => time(),
								'pagetstampseen' => $pageid,
								'seen' => 1,
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
						$this->deleteDBcachereport('ratings', $this->ref);
						$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
						// Update reference index. This will show in theList view that someone refers to external record.
						$refindex = t3lib_div::makeInstance('t3lib_refindex');
						/* @var $refindex t3lib_refindex */
						if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
							$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
						}
						$_SESSION['dislikeditem'] = array();
						$_SESSION['dislikeditem']['pageid'] = $pageid;
						$_SESSION['dislikeditem']['IP'] = $strCurrentIP;
						$_SESSION['dislikeditem']['time'] = time();
						$_SESSION['dislikeditem']['ref'] = $this->ref;
						$_SESSION['dislikeditem']['toctoc_user'] = $fetoctocusertoinsert;
					}

				} elseif ($this->cmd == 'like') {
					if (($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstampilike' => time(),
								'pagetstampilike' =>$pageid,
								'tstampseen' => time(),
								'pagetstampseen' => $pageid,
								'seen' => 1,
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
						$this->deleteDBcachereport('ratings', $this->ref);
						$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
							// Update reference index. This will show in theList view that someone refers to external record.
							$refindex = t3lib_div::makeInstance('t3lib_refindex');
							/* @var $refindex t3lib_refindex */
							if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
								$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
							}
					}

				} elseif ($this->cmd == 'unlikeemo') {
					if (($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstamp' => time(),
								'tstampidislike' => time(),
								'pagetstampidislike' => $pageid,
								'tstampseen' => time(),
								'pagetstampseen' => $pageid,
								'seen' => 1,
								'ilike' => 0,
								'pid' => $this->conf['storagePid'],
								'idislike' => 1,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'reference_scope' => $scopeid,
								'remote_addr' => $strCurrentIP,
								'emolikeid' => $this->rating
						));
						$this->deleteDBcachereport('ratings', $this->ref);
						$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
						// Update reference index. This will show in theList view that someone refers to external record.
						$refindex = t3lib_div::makeInstance('t3lib_refindex');
						/* @var $refindex t3lib_refindex */
						if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
							$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
						}
						$_SESSION['dislikeditem'] = array();
						$_SESSION['dislikeditem']['pageid'] = $pageid;
						$_SESSION['dislikeditem']['IP'] = $strCurrentIP;
						$_SESSION['dislikeditem']['time'] = time();
						$_SESSION['dislikeditem']['ref'] = $this->ref;
						$_SESSION['dislikeditem']['toctoc_user'] = $fetoctocusertoinsert;
					}

				} elseif ($this->cmd == 'likeemo') {
					if (($feusertoinsert > 0) || ($fetoctocusertoinsert !== '0.0.0.0.' . $feusertoinsert)) {
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_feuser_mm', array(
								'crdate' => time(),
								'tstampilike' => time(),
								'pagetstampilike' =>$pageid,
								'tstampseen' => time(),
								'pagetstampseen' => $pageid,
								'tstamp' => time(),
								'ilike' => 1,
								'seen' => 1,
								'pid' => $this->conf['storagePid'],
								'idislike' => 0,
								'myrating' => 0,
								'toctoc_commentsfeuser_feuser' => $feusertoinsert,
								'toctoc_comments_user' => $fetoctocusertoinsert,
								'reference' => $this->ref,
								'reference_scope' => $scopeid,
								'remote_addr' => $strCurrentIP,
								'emolikeid' => $this->rating
						));
						$this->deleteDBcachereport('ratings', $this->ref);
						$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
						// Update reference index. This will show in theList view that someone refers to external record.
						$refindex = t3lib_div::makeInstance('t3lib_refindex');
						/* @var $refindex t3lib_refindex */
						if (isset($GLOBALS['TCA']['tx_toctoc_comments_feuser_mm']['columns'])) {
							$refindex->updateRefIndexTable('tx_toctoc_comments_feuser_mm', $newUid);
						}

					}

				}

			}

			if (intval($rowusr['tusr']) === 0) {
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

				if (intval($rowStats['nbrmyrating']) === 0) {
					// which should not be, but if results in a difff/0 just
					// after, so we avoid this at least...
					$rowStats['nbrmyrating'] = 1;
				}

				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' . 'vote_count=' . $rowStats['nbrmyrating'] . ', current_ip="' . $strCurrentIP .
						'", like_count=' . intval($rowStats['sumilike']) . ', dislike_count=' . intval($rowStats['sumidislike']) . ', average_rating=' .
						round((intval($rowStats['summyrating']) / intval($rowStats['nbrmyrating'])), 9) . ', tstamp_lastupdate=' . time() . ' WHERE ' .
						$upddataWhereStats);

				// Call hook if ratings is updated
				if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['updateRatings'])) {
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

				if (($this->conf['advanced.']['enableUrlLog']) || (!($this->conf['ratings.']['disableIpCheck']))) {
					if ((strpos($this->cmd, 'ote') !== FALSE)) {
						if ($ratingsmode == '') {
							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_ratings_iplog', array(
									'pid' => $this->conf['storagePid'],
									'crdate' => time(),
									'tstamp' => time(),
									'reference' => $this->ref,
									'reference_scope' => $scopeid,
									'ip' => $strCurrentIP
							));
							$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
							// Update reference index. This will show in theList view that someone refers to external record.
							$refindex = t3lib_div::makeInstance('t3lib_refindex');
							/* @var $refindex t3lib_refindex */
							if (isset($GLOBALS['TCA']['tx_toctoc_ratings_iplog']['columns'])) {
								$refindex->updateRefIndexTable('tx_toctoc_ratings_iplog', $newUid);
							}
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
					if ($pid != 0) {
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
					$scopeid, $isReview);

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
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$apiObj->initCaches();
			}

			$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->commentid, array(
					'deleted' => 1
			));
			$this->deleteDBcachereport('comments', $_SESSION['commentListRecord']);
			if ($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] > 0) {
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
				if ($pid != 0) {
					$tce->clear_cacheCmd($pid);
				}

			}
			
			$apiObj->setPluginCacheControlTstamp($this->pluginid);
		}

	}
	/**
	 * triggering cachereport maintenance
	 *
	 * @param	[type]		$cachedEntities: ...
	 * @param	[type]		$ref: ...
	 * @return	void
	 */
	protected function deleteDBcachereport($cachedEntities, $ref = '') {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		$ret = $apiObj->deleteDBcachereport($cachedEntities, $ref);
		return $ret;
	}

	/**
	 * Processes comment Denotify submissions.
	 *
	 * @return	void
	 */
	protected function processDenotifycommentSubmission() {
		$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
		/* @var $apiObj toctoc_comments_api */
		if (version_compare(TYPO3_version, '4.6', '<')) {
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
			if ($pid != 0) {
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
		if (version_compare(TYPO3_version, '4.6', '<')) {

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
	/**
	 * Gets data of AJAXDBCache for given uid
	 *
	 * @param	int		$uid:  Cache-Type ('Data', 'ThisData' ...)
	 * @return	string		$AJAXDBdata
	 */
	public function getAJAXDBCache($uid) {
		$recs = array();
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('AJAXdata',
				'tx_toctoc_comments_cacheajax',
				'uid=' . $uid);
		$ret = $recs[0]['AJAXdata'];
	
		if ($ret == '') {
			$ret = $recs['AJAXdata'];
		}
	
		if ($ret == '') {
			echo 'no data '.count($recs).'found in tx_toctoc_comments_cacheajax for uid=' . intval($uid);
			exit;
		}
	
		if (function_exists('gzdecode')) {
			$AJAXDBdata=gzdecode($ret);
		} else {
			$AJAXDBdata=gzuncompress($ret);
		}
	
		if ($AJAXDBdata == '') {
			$AJAXDBdata=$ret;
		}
	
		return $AJAXDBdata;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_ajax.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_ajax.php']);
}

// Make instance:
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$SOBE = t3lib_div::makeInstance('toctoc_comments_ajax');
$SOBE->main();

?>