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
 * class.toctoc_comments_felogin_pi1.php
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
 *  109: class tx_toctoccomments_pi2 extends tslib_pibase
 *  133:     protected function processRedirect()
 *  147:     protected function pmain($content, $dochangepassword = FALSE, $uid = 0, $piHash = '')
 *  246:     public function main($content, $conf, $dochangepassword = FALSE, $uid = 0, $piHash = '')
 *  431:     protected function watermark($conf, $content)
 *  469:     protected function showForgot()
 *  549:     protected function showLogout()
 *  584:     protected function showLogin()
 *  730:     protected function getRSAKeyPair()
 *  767:     protected function getPageLink($label, $piVars, $returnUrl = FALSE)
 *  803:     protected function getPreserveGetVars()
 *  856:     protected function generatePassword($len)
 *  876:     protected function getDisplayText($label, $stdWrapArray=array())
 *  888:     protected function getUserFieldMarkers()
 *  923:     protected function validateRedirectUrl($url)
 *  954:     protected function isInCurrentDomain($url)
 *  966:     protected function isInLocalDomain($url)
 * 1007:     protected function isRelativeUrl($url)
 * 1023:     protected function generateAndSendHash($user)
 * 1089:     protected function changePassword($uid, $piHash)
 * 1211:     protected function showSignon()
 * 1519:     protected function getSignupCaptcha($required, $errcp, $cpval)
 * 1562:     protected function locationHeaderUrlsubDir($withleadingslash = TRUE)
 * 1589:     protected function processSignupCaptcha($postData)
 * 1629:     protected function loginUser($facebookId)
 * 1655:     protected function storeUser($facebookUserProfile)
 * 1763:     private function copyImageFromFacebook($facebookUserId)
 * 1778:     protected function file_get_contents_curl($urltofetch,$ext, $savepathfilename = '')
 *
 * TOTAL FUNCTIONS: 27
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
	//require_once(PATH_t3lib . 'class.t3lib_befunc.php');
	require_once(PATH_tslib . 'class.tslib_pibase.php');
	if (!version_compare(TYPO3_version, '4.6', '<')) {
		require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
	}
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
	//require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Utility/BackendUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/GeneralUtility.php';
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('tslib_pibase', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Plugin\AbstractPlugin', 'tslib_pibase');
	(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	(class_exists('t3lib_utility_Math', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\MathUtility', 't3lib_utility_Math');
	(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
	(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
	(class_exists('t3lib_utility_Array', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ArrayUtility', 't3lib_utility_Array');

}

require_once(t3lib_extmgm::extPath('toctoc_comments', 'pi2/facebook.php'));


/**
 * AJAX login/Logout
 *
 */
class tx_toctoccomments_pi2 extends tslib_pibase {
	public $prefixId      = 'tx_toctoccomments_pi2';		// Same as class name
	public $scriptRelPath = 'pi2/class.toctoc_comments_felogin_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey = 'toctoc_comments';
	public $pi_checkCHash = FALSE;
	public $pi_USER_INT_obj = TRUE;

	protected $userIsLoggedIn;	// Is user logged in?
	protected $template;	// holds the template for FE rendering
	protected $uploadDir;	// upload dir, used for flexform template files
	protected $redirectUrl;	// URL for the redirect
	protected $noRedirect = FALSE;	// flag for disable the redirect
	protected $logintype;	// logintype (given as GPvar), possible: login, logout
	protected $loginParameter = 'fb_login';
	protected $nofacebook = FALSE;
	protected $tableName = 'fe_users';
	protected $fberror = '';


	/**
	 * [Describe function...]
	 *
	 * @return	array		...
	 */
	protected function processRedirect() {
		return array();
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$content: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$dochangepassword: ...
	 * @param	[type]		$uid: ...
	 * @param	[type]		$piHash: ...
	 * @return	[type]		...
	 */
    protected function pmain($content, $dochangepassword = FALSE, $uid = 0, $piHash = '') {

		$this->uploadDir = 'uploads/tx_felogin/';

			// Loading default pivars
		$this->pi_setPiVarDefaults();

			// Loading language-labels
		$this->pi_loadLL();
		 //PIDs:
		if ($this->conf['storagePid']) {
			if (intval($this->conf['recursive'])) {
				$this->spid = $this->pi_getPidList($this->conf['storagePid'], intval($this->conf['recursive']));
			} else {
				$this->spid = $this->conf['storagePid'];
			}
		} else {
			$pids = $GLOBALS['TSFE']->getStorageSiterootPids();
			$this->spid = $pids['_STORAGE_PID'];
		}

			// GPvars:
		$this->logintype = t3lib_div::_GP('logintype');
		$this->referer = $this->validateRedirectUrl(t3lib_div::_GP('referer'));
		$this->noRedirect = TRUE;

			// if config.typolinkLinkAccessRestrictedPages is set, the var is return_url
		$returnUrl =  t3lib_div::_GP('return_url');
		if ($returnUrl) {
			$this->redirectUrl = $returnUrl;
		} else {
			$this->redirectUrl = t3lib_div::_GP('redirect_url');
		}

		$this->redirectUrl = $this->validateRedirectUrl($this->redirectUrl);

			// Is user logged in?
		$this->userIsLoggedIn = $GLOBALS['TSFE']->loginUser;

			// Redirect
		if ($this->conf['redirectMode'] && !$this->conf['redirectDisable'] && !$this->noRedirect) {
			$redirectUrl = $this->processRedirect();
			if (count($redirectUrl)) {
				$this->redirectUrl = $this->conf['redirectFirstMethod'] ? array_shift($redirectUrl) : array_pop($redirectUrl);
			} else {
				$this->redirectUrl = '';
			}
		}

		$this->redirectUrl = '';
			// What to display
		$content='';
		$postData =  t3lib_div::_POST($this->prefixId);
		if (t3lib_div::_GP('forgot')) {
			$content .= $this->showForgot();
		} elseif (t3lib_div::_GP('signup')) {
			$content .= $this->showSignon();
		} elseif (($postData['forgothash']) || ($dochangepassword)) {
			$content .= $this->changePassword($uid, $piHash);
		} else {
			if($this->userIsLoggedIn && !$this->logintype) {
				$content .= $this->showLogout();
			} else {
				$content .= $this->showLogin();
			}
		}

		// Get storage
			// Process the redirect
		if (($this->logintype === 'login' || $this->logintype === 'logout' || $this->logintype === 'forgot' || $this->logintype === 'signup') && $this->redirectUrl && !$this->noRedirect) {
			if (!$GLOBALS['TSFE']->fe_user->cookieId) {
				$content .= $this->cObj->stdWrap($this->pi_getLL('cookie_warning', '', 1), $this->conf['cookieWarning_stdWrap.']);
			}

		}

		$this->redirhtml = '';
		if (t3lib_div::_GP('refreshcontent') == 'refresh') {
			if (intval($this->conf['pageTypeRefreshs']) != 0) {
				$link = 'index.php?id=' . $GLOBALS['TSFE']->id . '&type=' . $this->conf['pageTypeRefreshs'] . '&' . http_build_query($_GET);
			}  else {
				$link = $this->pi_getPageLink($GLOBALS['TSFE']->id);
			}

		}

		return $content;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$content: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$dochangepassword: ...
	 * @param	[type]		$uid: ...
	 * @param	[type]		$piHash: ...
	 * @return	[type]		...
	 */
	public function main($content, $conf, $dochangepassword = FALSE, $uid = 0, $piHash = ''){

		$prefix=$this->prefixId;
		$this->conf = $conf;

		if (t3lib_div::_GP('getrsahash')) {
			//
			$this->getRSAKeyPair();
		}
		if (!isset($this->cObj)) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}
		// Get Template
		$templateFile = $this->conf['templateFile'] ? $this->conf['templateFile'] : 'EXT:toctoc_comments/res/template/toctoccomments_template_felogin_pi1.html';
		$this->template = $this->cObj->fileResource($templateFile);

		//checking facebook stuff
		if(!is_dir(PATH_site.$conf['facebook.']['imageDir'])) {
			$this->nofacebook = TRUE;
		}

		if (!isset($conf['facebook.']['appId']) || $conf['facebook.']['appId'] == '') {
			$this->nofacebook = TRUE;
		}

		if (!isset($conf['facebook.']['secret']) || $conf['facebook.']['secret'] == '') {
			$this->nofacebook = TRUE;
		}
		$contentfb='';
		if ($this->nofacebook == FALSE) {
			$facebook = new Facebooktc(array(
					'appId' => $conf['facebook.']['appId'],
					'secret' => $conf['facebook.']['secret']
			));

			$fbuser = $facebook->getUser();
			$_SESSION['fbaccessToken'] = NULL;
			if ($fbuser) {
				$_SESSION['fbaccessToken'] = $facebook->getAccessToken();
			}

			if(($_POST['tx_toctoccomments_pi2']['fbLogin'] == '1') && $fbuser) {
				try {
					if ($_SESSION['fbaccessToken'] != NULL) {
						$facebook->setAccessToken($_SESSION['fbaccessToken']);
					}

					$facebookUserProfile = $facebook->api('/me');
					$this->storeUser($facebookUserProfile);
					$this->loginUser($fbuser);
				} catch (FacebookApiException $e) {
					$this->fberror=$e;
					$fbuser = NULL;
				}
			}
			$subpart = trim($this->cObj->getSubpart($this->template, '###TEMPLATE_FACEBOOK###'));
			$subpartArray = $linkpartArray = $markerArray = array();
			$fbbutton = trim($this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray));
     		$contentfb .= '
			<div id="facebookauth">' . $fbbutton . '</div>
';
		}

		$content = $this->pmain($content, $dochangepassword, $uid, $piHash);

		if (t3lib_div::_GP('refreshcontent') != 'refresh') {
			if ($conf['ll.'][$GLOBALS['TSFE']->lang . '.']['NewAccount'] == '') {
				$conf['ll.'][$GLOBALS['TSFE']->lang . '.']['NewAccount'] = 'new account';
			}

			if ($conf['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'] == '') {
				$conf['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'] = $this->pi_getLL('ll_forgot_header', '', 1);
			}

			$newuser='';

			$forgotpw= '<span class="tx-tc-forgotpw link tx-tc-textlink" id="tx-tc-forgotpw-link">'  .
						$conf['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'] . '</span>';
			$hideIfFacebookActiveClass = '';
			$hideshowIfFacebookActiveClass = ' tx-tc-blockdisp';
			if ((intval($conf['hideIfFaceBookActive']) ==1) && ($this->nofacebook == FALSE)){
				$hideIfFacebookActiveClass = ' tx-tc-nodisp';
				$hideshowIfFacebookActiveClass = ' tx-tc-nodisp';
			}

			if (intval($conf['register.']['enableSignup'])==1) {
				$buttonnewaccount = '<div class="tx-tc-login-form-iframe' . $hideIfFacebookActiveClass . '" id="tx-tc-buttonfornewaccount">
					 		<input type="button" id="tx-tc-buttonfornewaccount-bt" value="' . $conf['ll.'][$GLOBALS['TSFE']->lang . '.']['ButtonNewAccount'] .
					 		'"	class="tx-tc-ct-submit tx-tc-login-button" /></div>';
			}

			$contentforgotpwarr=explode('###DIV_BLOCKLINKS###', $content);

			if (count($contentforgotpwarr)>1) {
				$contentarrlink=explode('</a>', $contentforgotpwarr[1]);
				$contentarrlink[0]=$forgotpw;
				$contentforgotpwarr[1]=implode('', $contentarrlink);
				$content=implode('###DIV_BLOCKLINKS###', $contentforgotpwarr);
			}

			$policyLink = '';
			if (intval($conf['policyPid']) > 0) {
				$params = array();
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
						'parameter'        => intval($conf['policyPid']),
						'additionalParams' => t3lib_div::implodeArrayForUrl('', $params, '', 1),
						'ATagParams' => 'rel="nofollow"',
				);
				$policyLink = '<div class="tx-tc-login-form-field tx-tc-login-policy">' . $this->cObj->typoLink($this->pi_getLL('policy_link', '', 1), $conflink) . '</div>';
			}

			$content=strtr($content, array(
										'###FORM_ID###'=>$prefix.'_form',
										'###DIV_BLOCKLINKS###'=>'',
										'###SIGNUP###'=> $this->showSignon(),
										'###REGISTER###' => $buttonnewaccount,
										'###FACEBOOK###' => $contentfb,
										'###POLICY###' => $policyLink,
										'###HIDEIFFBACTIV###' => $hideIfFacebookActiveClass,
										'###HIDESHOWIFFBACTIV###' => $hideshowIfFacebookActiveClass,
										)
							);

			$redirect=FALSE;
			// Redirect
			if ($this->conf['redirectMode'] && !$this->conf['redirectDisable'] && !$this->noRedirect) {
				$redirectUrl = $this->processRedirect();
				if (count($redirectUrl)) {
					$this->redirectUrl = $this->conf['redirectFirstMethod'] ? array_shift($redirectUrl) : array_pop($redirectUrl);
				} else {
					$this->redirectUrl = '';
				}

			}

			// Process the redirect
			if (($this->logintype === 'login' || $this->logintype === 'logout') && $this->redirectUrl && !$this->noRedirect) {
				if (!$GLOBALS['TSFE']->fe_user->cookieId) {
					$content .= $this->cObj->stdWrap($this->pi_getLL('cookie_warning', '', 1), $this->conf['cookieWarning_stdWrap.']);
				} else {
					$redirect=$this->redirectUrl;
				}

			}
		}
		//watermark formfields
		$content = $this->watermark($conf, $content);

		if($_POST['tx_toctoccomments_pi2']['ajax']){
			if (t3lib_div::_GP('refreshcontent') != 'refresh') {

				$search = array('@<![\s\S]*?--[ \t\n\r]*>@',
				);
				$content = preg_replace($search, '', $content);
				$answerarr = $redirect . 'toctoc-data-sep' . $content . 'toctoc-data-sep' . trim($this->conf['refreshIdList']);
				$responsedec= base64_encode($answerarr);
				echo $responsedec;
				die();
			}
		}

		$content='<div id="'.$prefix.'">'.$content.'</div>';
		$content.='<div id="'.$prefix.'_indication" class="tx-tc-nodisp"></div>';
		return $content;
	}

	/**
	 * watermarks form fields and hides labels
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$content: ...
	 * @return	string		content
	 */
	protected function watermark($conf, $content) {
		if ($conf['watermark']==1) {
			$contentarr=explode('<label class="tx-tc-ct-label tx-tc-ct-box-rlvl-0"', $content);
			$countcontentarr=count($contentarr);
			for ($i=1;$i<$countcontentarr;$i++) {
				$contentarrlabel=explode('">', $contentarr[$i]);
				$contentarrlabeltext=explode('</label>', $contentarrlabel[1]);
				$contentlabeltext=$contentarrlabeltext[0];
				$contentlabeltext=str_replace(':', '', $contentlabeltext);
				$contentarrrest=array();
				$contentarrrest=explode('</label>', $contentarr[$i]);
				if (count($contentarrrest)>1) {
					$contentarr[$i]=$contentarrrest[1];
				}

				if (count($contentarrrest)>2) {
					$countcontentarrrest=count($contentarrrest);
					for ($j=2;$j<$countcontentarrrest;$j++) {
						$contentarr[$i].='</label>'.$contentarrrest[$j];
					}

				}

				$contentarr[$i]=str_replace('tx-tc-ct-input"', 'tx-tc-ct-input" placeholder="' . $contentlabeltext . '" ', $contentarr[$i]);
				$countcontentarr=count($contentarr);
			}
			$ret = implode('', $contentarr);
			return $ret;
		} else {
			return $content;
		}
	}

	/**
	 * Shows the forgot password form
	 *
	 * @return	string		content
	 */
	protected function showForgot() {
		$subpart = trim($this->cObj->getSubpart($this->template, '###TEMPLATE_FORGOT###'));
		$subpartArray = $linkpartArray = array();
		$postData =  t3lib_div::_POST($this->prefixId);

		if ($postData['forgot_email']) {

			//  hashes for compare
			$postedHash = $postData['forgot_hash'];
			$hashData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'forgot_hash');

			if ($postedHash === $hashData['forgot_hash']) {
				$row = FALSE;

				// look for user record
				$data = $GLOBALS['TYPO3_DB']->fullQuoteStr($postData['forgot_email'], 'fe_users');
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
						'uid, username, password, email',
						'fe_users',
						'(email=' . $data .' OR username=' . $data . ') AND pid IN ('.$GLOBALS['TYPO3_DB']->cleanIntList($this->spid).') '.
						$this->cObj->enableFields('fe_users')
				);

				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
					$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				}

				$error = NULL;
				if ($row) {
					// generate an email with the hashed link
					$error = $this->generateAndSendHash($row);
				} elseif ($this->conf['exposeNonexistentUserInForgotPasswordDialog']) {
					$error = $this->pi_getLL('ll_forgot_reset_message_error');
				}

				// generate message
				if ($error) {
					$markerArray['###STATUS_MESSAGE###'] = $this->cObj->stdWrap($error, $this->conf['forgotErrorMessage_stdWrap.']);
				} else {
					$markerArray['###STATUS_MESSAGE###'] =
					$this->cObj->stdWrap($this->pi_getLL('ll_forgot_reset_message_emailSent', '', 1), $this->conf['forgotResetMessageEmailSentMessage_stdWrap.']);
				}

				$subpartArray['###FORGOT_FORM###'] = '';

			} else {
				//wrong email
				$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('forgot_reset_message', $this->conf['forgotMessage_stdWrap.']);
				$markerArray['###BACKLINK_LOGIN###'] = '';
			}

		} else {
			$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('forgot_reset_message', $this->conf['forgotMessage_stdWrap.']);
			$markerArray['###BACKLINK_LOGIN###'] = '';
		}

		$markerArray['###BACKLINK_LOGIN###'] = $this->pi_getLL('ll_forgot_header_backToLogin', '', 1);
		$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('forgot_header', $this->conf['forgotHeader_stdWrap.']);
		$markerArray['###LEGEND###'] = $this->pi_getLL('legend', $this->pi_getLL('reset_password', '', 1), 1);
		$markerArray['###ACTION_URI###'] = $this->getPageLink('', array($this->prefixId . '[forgot]'=>1), TRUE);
		$markerArray['###EMAIL_LABEL###'] = $this->pi_getLL('your_email', '', 1);
		$markerArray['###FORGOT_PASSWORD_ENTEREMAIL###'] = $this->pi_getLL('forgot_password_enterEmail', '', 1);
		$markerArray['###FORGOT_EMAIL###'] = $this->prefixId.'[forgot_email]';
		$markerArray['###SEND_PASSWORD###'] = $this->pi_getLL('reset_password', '', 1);
		$markerArray['###DATA_LABEL###'] = $this->pi_getLL('ll_enter_your_data', '', 1);
		$markerArray = array_merge($markerArray, $this->getUserFieldMarkers());
		// generate hash
		$hash = md5($this->generatePassword(3));
		$markerArray['###FORGOTHASH###'] = $hash;
		// set hash in feuser session
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'forgot_hash', array('forgot_hash' => $hash));
		$ret = trim($this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray));
		return $ret;

	}
	/**
	 * Shows logout form
	 *
	 * @return	string		The content.
	 */
	protected function showLogout() {
		$subpart = $this->cObj->getSubpart($this->template, '###TEMPLATE_LOGOUT###');
		$subpartArray = $linkpartArray = array();

		$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('status_header', $this->conf['logoutHeader_stdWrap.']);

		$tmpStatusMessage = $this->getDisplayText('success_message', $this->conf['successMessage_stdWrap.']);
		$tmpStatusMessage = str_replace ('\'', '', $tmpStatusMessage);
		$markerArray['###STATUS_MESSAGE###'] = $tmpStatusMessage;
		$markerArray['###LEGEND###'] = $this->pi_getLL('logout', '', 1);
		$markerArray['###ACTION_URI###'] = $this->getPageLink('', array(), TRUE);
		$markerArray['###LOGOUT_LABEL###'] = $this->pi_getLL('logout', '', 1);
		$markerArray['###NAME###'] = htmlspecialchars($GLOBALS['TSFE']->fe_user->user['name']);
		$markerArray['###STORAGE_PID###'] = $this->spid;
		$markerArray['###USERNAME###'] = htmlspecialchars($GLOBALS['TSFE']->fe_user->user['username']);
		$markerArray['###USERNAME_LABEL###'] = $this->pi_getLL('username', '', 1);
		$markerArray['###NOREDIRECT###'] = $this->noRedirect ? '1' : '0';
		$markerArray['###PREFIXID###'] = $this->prefixId;
		$markerArray = array_merge($markerArray, $this->getUserFieldMarkers());

		if ($this->redirectUrl) {
			// use redirectUrl for action tag because of possible access restricted pages
			$markerArray['###ACTION_URI###'] = htmlspecialchars($this->redirectUrl);
			$this->redirectUrl = '';
		}

		$ret = $this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray);
		return $ret;
	}

	/**
	 * Shows login form
	 *
	 * @return	string		content
	 */
	protected function showLogin() {
		$subpart = $this->cObj->getSubpart($this->template, '###TEMPLATE_LOGIN###');
		$subpartArray = $linkpartArray = $markerArray = array();

		$gpRedirectUrl = '';
		$postData =  t3lib_div::_POST($this->prefixId);
		$markerArray['###LEGEND###'] = $this->pi_getLL('oLabel_header_welcome', '', 1);
		$dofp=0;
		if($this->logintype === 'login') {
			if($this->userIsLoggedIn) {
				// login success
				$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('success_header', $this->conf['successHeader_stdWrap.']);
				$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('success_message', $this->conf['successMessage_stdWrap.']);
				$markerArray = array_merge($markerArray, $this->getUserFieldMarkers());
				$subpartArray['###LOGIN_FORM###'] = '';

				// show logout form directly (regardless of $this->conf['showLogoutFormAfterLogin'])
				$this->redirectUrl = '';
				$ret = $this->showLogout();
				return $ret;
			} else {
				// login error
				$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('error_header', $this->conf['errorHeader_stdWrap.']);
				$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('error_message', $this->conf['errorMessage_stdWrap.']) . $this->fberror;
				$gpRedirectUrl = t3lib_div::_GP('redirect_url');
				$dofp=1;
			}
		} else {
			$dofp=1;
			if($this->logintype === 'logout') {
				// login form after logout
				$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('logout_header', $this->conf['logoutHeader_stdWrap.']);
				$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('logout_message', $this->conf['logoutMessage_stdWrap.']);
			} else {
				// login form
				if($this->logintype === 'forgot') {
					$dofp=2;
				}
				if($this->logintype === 'signup') {
					$dofp=3;
				}
				$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('welcome_header', $this->conf['welcomeHeader_stdWrap.']);
				$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('welcome_message', $this->conf['welcomeMessage_stdWrap.']);

			}

		}

		// Hook (used by kb_md5fepw extension by Kraft Bernhard <kraftb@gmx.net>)
		// This hook allows to call User JS functions.
		// The methods should also set the required JS functions to get included
		$onSubmit = '';
		$extraHidden = '';
		$onSubmitAr = array();
		$extraHiddenAr = array();

		// check for referer redirect method. if present, save referer in form field
		if (t3lib_div::inList($this->conf['redirectMode'], 'referer') || t3lib_div::inList($this->conf['redirectMode'], 'refererDomains')) {
			$referer = $this->referer ? $this->referer : t3lib_div::getIndpEnv('HTTP_REFERER');
			if ($referer) {
				$extraHiddenAr[] = '<input type="hidden" name="referer" value="' . htmlspecialchars($referer) . '" />';
				if ($postData['redirectReferrer'] === 'off') {
					$extraHiddenAr[] = '<input type="hidden" name="' . $this->prefixId . '[redirectReferrer]" value="off" />';
				}
			}
		}
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs'])) {
			$_params = array();
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs'] as $funcRef) {
				list($onSub, $hid) = t3lib_div::callUserFunction($funcRef, $_params, $this);
				$onSubmitAr[] = $onSub;
				$extraHiddenAr[] = $hid;
			}
		}

		if (count($onSubmitAr)) {
			$onSubmit = implode('; ', $onSubmitAr).'; return TRUE;';
			$onSubmit = str_replace('; return TRUE;', '', $onSubmit);
		}
		if (count($extraHiddenAr)) {
			$extraHidden = implode(LF, $extraHiddenAr);
		}

		if (!$gpRedirectUrl && $this->redirectUrl) {
			$gpRedirectUrl = $this->redirectUrl;
		}

		// Login form
		$markerArray['###ACTION_URI###'] = $this->getPageLink('', array(), TRUE);
		$markerArray['###EXTRA_HIDDEN###'] = $extraHidden; // used by kb_md5fepw extension...
		$markerArray['###LEGEND###'] = $this->pi_getLL('login', '', 1);
		$markerArray['###LOGIN_LABEL###'] = $this->pi_getLL('login', '', 1);
		$markerArray['###ON_SUBMIT###'] = $onSubmit; // used by kb_md5fepw extension...
		$markerArray['###PASSWORD_LABEL###'] = $this->pi_getLL('password', '', 1);
		$markerArray['###STORAGE_PID###'] = $this->spid;
		$markerArray['###USERNAME_LABEL###'] = $this->pi_getLL('username', '', 1);
		$markerArray['###REDIRECT_URL###'] = htmlspecialchars($gpRedirectUrl);
		$markerArray['###NOREDIRECT###'] = $this->noRedirect ? '1' : '0';
		$markerArray['###PREFIXID###'] = $this->prefixId;
		$markerArray = array_merge($markerArray, $this->getUserFieldMarkers());

		if ($this->conf['showForgotPasswordLink']) {
			$linkpartArray['###FORGOT_PASSWORD_LINK###'] = explode('|', $this->getPageLink('|', array($this->prefixId.'[forgot]'=>1)));
			$markerArray['###FORGOT_PASSWORD###'] = $this->pi_getLL('ll_forgot_header', '', 1);
		} else {
			$subpartArray['###FORGOTP_VALID###'] = '';
		}

		// The permanent login checkbox should only be shown if permalogin is not deactivated (-1), not forced to be always active (2) and lifetime is greater than 0
		if ($this->conf['showPermaLogin'] && t3lib_div::inList('0,1', $GLOBALS['TYPO3_CONF_VARS']['FE']['permalogin']) &&
				$GLOBALS['TYPO3_CONF_VARS']['FE']['lifetime'] > 0) {
			$markerArray['###PERMALOGIN###'] = $this->pi_getLL('permalogin', '', 1);
			if($GLOBALS['TYPO3_CONF_VARS']['FE']['permalogin'] == 1) {
				$markerArray['###PERMALOGIN_HIDDENFIELD_ATTRIBUTES###'] = 'disabled="disabled"';
				$markerArray['###PERMALOGIN_CHECKBOX_ATTRIBUTES###'] = 'checked="checked"';
			} else {
				$markerArray['###PERMALOGIN_HIDDENFIELD_ATTRIBUTES###'] = '';
				$markerArray['###PERMALOGIN_CHECKBOX_ATTRIBUTES###'] = '';
			}

		} else {
			$subpartArray['###PERMALOGIN_VALID###'] = '';
		}

		if ($dofp<2) {
			$ret=$this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray);
			if ($dofp==1) {
				$ret .= $this->showForgot();
			}

		} else {
			if ($dofp==2) {
			$ret = $this->showForgot();
			} else {
				$ret = $this->showSignon();
			}
		}
		return $ret;
	}
	/**
	 * Generates the RSA hiddenextra Filed and the onSubmit-Code
	 * Used by an AJAX-call that makes sure the RSA-Key is fresh when submitting a login
	 * returns by 'die after echo'
	 *
	 * @return	string		$responsedec Encodes string with $onSubmit and
	 */
	protected function getRSAKeyPair() {
		$onSubmit = '';
		$extraHidden = '';
		$onSubmitAr = array();
		$extraHiddenAr = array();

		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs'])) {
			$_params = array();
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs'] as $funcRef) {
				list($onSub, $hid) = t3lib_div::callUserFunction($funcRef, $_params, $this);
				$onSubmitAr[] = $onSub;
				$extraHiddenAr[] = $hid;
			}
		}

		if (count($onSubmitAr)) {
			$onSubmit = implode('; ', $onSubmitAr).'; return TRUE;';
			$onSubmit = str_replace('; return TRUE;', '', $onSubmit);
		}

		if (count($extraHiddenAr)) {
			$extraHidden = implode(LF, $extraHiddenAr);
		}

		$answerarr = $onSubmit . 'toctoc-data-sep' . $extraHidden;
		$responsedec= base64_encode($answerarr);
		echo $responsedec;
		die();
	}
	/**
	 * Generate link with typolink function
	 *
	 * @param	string		linktext
	 * @param	array		link vars
	 * @param	boolean		TRUE: returns only url  FALSE (default) returns the link)
	 * @return	string		link or url
	 */
	protected function getPageLink($label, $piVars, $returnUrl = FALSE) {
		$additionalParams = '';
		$this->conf['preservevars']=1;
		if (count($piVars)) {
			foreach($piVars as $key=>$val) {
				$additionalParams .= '&' . $key . '=' . $val;
			}
		}
		// should vars be preserved?
		if ($this->conf['preservevars'])	{
			$additionalParams .= $this->getPreserveGetVars();
		}

		$this->conf['linkConfig.']['parameter'] = $GLOBALS['TSFE']->id;
		if ($additionalParams)	{
			$this->conf['linkConfig.']['additionalParams'] =  $additionalParams;
		}

		if ($returnUrl) {
			$ret = htmlspecialchars($this->cObj->typolink_url($this->conf['linkConfig.']));
			return $ret;
		} else {
			$ret = $this->cObj->typolink($label, $this->conf['linkConfig.']);
			return $ret;
		}

	}

	/**
	 * Add additional parameters for links according to TS setting preservevars.
	 * Possible values are "all" or a comma separated list of allowed GET-vars.
	 * Supports multi-dimensional GET-vars.
	 * Some hardcoded values are dropped.
	 *
	 * @return	string		additionalParams-string
	 */
	protected function getPreserveGetVars() {
		$getVars = t3lib_div::_GET();
		unset(
				$getVars['id'],
				$getVars['no_cache'],
				$getVars['logintype'],
				$getVars['redirect_url'],
				$getVars['cHash'],
				$getVars['toctoc_comments_pi1']['anchor'],
				$getVars['toctoc_comments_pi1'],
				$getVars[$this->prefixId]
		);

		if (version_compare(TYPO3_version, '4.7', '<')) {
			$params = '';
			$preserveVars =! ($this->conf['preserveGETvars'] || $this->conf['preserveGETvars']=='all' ? array() : implode(',', (array)$this->conf['preserveGETvars']));

			foreach ($getVars as $key => $val) {
				if (stristr($key, $this->prefixId) === FALSE) {
					if (is_array($val)) {
						foreach ($val as $key1 => $val1) {
							if ($this->conf['preserveGETvars'] == 'all' || in_array($key . '[' . $key1 .']', $preserveVars)) {
								$params .= '&' . $key . '[' . $key1 . ']=' . $val1;
							}
						}
					} else {
						if (!in_array($key, array('id','no_cache','logintype','redirect_url','cHash'))) {
							$params .= '&' . $key . '=' . $val;
						}
					}
				}
			}
		} else {

			if ($this->conf['preserveGETvars'] === 'all') {
				$preserveQueryParts = $getVars;
			} else {
				$preserveQueryParts = t3lib_div::trimExplode(',', $this->conf['preserveGETvars']);
				$preserveQueryParts = t3lib_div::explodeUrl2Array(implode('=1&', $preserveQueryParts) . '=1', TRUE);
				$preserveQueryParts = t3lib_utility_Array::intersectRecursive($getVars, $preserveQueryParts);
			}
			$params = t3lib_div::implodeArrayForUrl('', $preserveQueryParts);
		}
		return $params;
	}

	/**
	 * Is used by forgot password - function with md5 option.
	 *
	 * @param	int		length of new password
	 * @return	string		new password
	 * @author	Bernhard Kraft
	 */
	protected function generatePassword($len) {
		$pass = '';
		while ($len--) {
			$char = rand(0, 35);
			if ($char < 10) {
				$pass .= '' . $char;
			} else {
				$pass .= chr($char - 10 + 97);
			}
		}
		return $pass;
	}

	/**
	 * Returns the header / message value from flexform if present, else from locallang.xml
	 *
	 * @param	string		label name
	 * @param	string		TS stdWrap array
	 * @return	string		label text
	 */
	protected function getDisplayText($label, $stdWrapArray=array()) {
		$text = $this->cObj->stdWrap($this->pi_getLL('ll_'.$label, '', 1), $stdWrapArray);
		$replace = $this->getUserFieldMarkers();
		$ret = strtr($text, $replace);
		return $ret;
	}

	/**
	 * Returns Array of markers filled with user fields
	 *
	 * @return	array		marker array
	 */
	protected function getUserFieldMarkers() {
		$marker = array();
		// replace markers with fe_user data
		if ($GLOBALS['TSFE']->fe_user->user) {
			// all fields of fe_user will be replaced, scheme is ###FEUSER_FIELDNAME###
			foreach ($GLOBALS['TSFE']->fe_user->user as $field => $value) {
				$marker['###FEUSER_' . t3lib_div::strtoupper($field) . '###'] = $this->cObj->stdWrap($value, $this->conf['userfields.'][$field . '.']);
			}
			// add ###USER### for compatibility
			$tempFeUserName = $marker['###FEUSER_USERNAME###'];
			$firstname = $marker['###FEUSER_FIRST_NAME###'];
			$lastname = $marker['###FEUSER_LAST_NAME###'];
			$fullname = trim($firstname . ' ' . $lastname);
			if (str_replace('facebook', '', $tempFeUserName) != $tempFeUserName) {
				$fblink = '(<a href="' . $marker['###FEUSER_TX_TOCTOC_COMMENTS_FACEBOOK_LINK###'] . '">facebook</a>)';
				$marker['###USER###'] = trim($fullname . ' ' . $fblink);
			} else {
				if ($fullname != '') {
					$marker['###USER###'] = $marker['###FEUSER_USERNAME###'] . ' (' . $fullname . ')';
				} else {
					$marker['###USER###'] = $marker['###FEUSER_USERNAME###'];
				}

			}

		}
		return $marker;
	}

	/**
	 * Returns a valid and XSS cleaned url for redirect, checked against configuration "allowedRedirectHosts"
	 *
	 * @param	string		$url
	 * @return	string		cleaned referer or empty string if not valid
	 */
	protected function validateRedirectUrl($url) {
		$url = strval($url);
		if ($url === '') {
			return '';
		}

		$decodedUrl = rawurldecode($url);
		$sanitizedUrl = t3lib_div::removeXSS($decodedUrl);

		if ($decodedUrl !== $sanitizedUrl || preg_match('#["<>\\\]+#', $url)) {
			t3lib_div::sysLog(sprintf($this->pi_getLL('xssAttackDetected'), $url), 'toctoc_comments', t3lib_div::SYSLOG_SEVERITY_WARNING);
			return '';
		}

		// Validate the URL:
		if ($this->isRelativeUrl($url) || $this->isInCurrentDomain($url) || $this->isInLocalDomain($url)) {
			return $url;
		}

		// URL is not allowed
		t3lib_div::sysLog(sprintf($this->pi_getLL('noValidRedirectUrl'), $url), 'toctoc_comments', t3lib_div::SYSLOG_SEVERITY_WARNING);
		return '';
	}

	/**
	 * Determines whether the URL is on the current host
	 * and belongs to the current TYPO3 installation.
	 *
	 * @param	string		$url URL to be checked
	 * @return	boolean		Whether the URL belongs to the current TYPO3 installation
	 */
	protected function isInCurrentDomain($url) {
		$ret =  (t3lib_div::isOnCurrentHost($url) && t3lib_div::isFirstPartOfStr($url, t3lib_div::getIndpEnv('TYPO3_SITE_URL')));
		return $ret;
	}

	/**
	 * Determines whether the URL matches a domain
	 * in the sys_domain databse table.
	 *
	 * @param	string		$url Absolute URL which needs to be checked
	 * @return	boolean		Whether the URL is considered to be local
	 */
	protected function isInLocalDomain($url) {
		$result = FALSE;

		if (t3lib_div::isValidUrl($url)) {
			$parsedUrl = parse_url($url);
			if ($parsedUrl['scheme'] === 'http' || $parsedUrl['scheme'] === 'https' ) {
				$host = $parsedUrl['host'];
				// Removes the last path segment and slash sequences like /// (if given):
				$path = preg_replace('#/+[^/]*$#', '', $parsedUrl['path']);

				$localDomains = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'domainName',
						'sys_domain',
						'1=1' . $this->cObj->enableFields('sys_domain')
				);
				if (is_array($localDomains)) {
					foreach ($localDomains as $localDomain) {
						// strip trailing slashes (if given)
						$domainName = rtrim($localDomain['domainName'], '/');
						if (t3lib_div::isFirstPartOfStr($host. $path . '/', $domainName . '/')) {
							$result = TRUE;
							break;
						}

					}
				}

			}

		}

		return $result;
	}

	/**
	 * Determines wether the URL is relative to the
	 * current TYPO3 installation.
	 *
	 * @param	string		$url URL which needs to be checked
	 * @return	boolean		Whether the URL is considered to be relative
	 */
	protected function isRelativeUrl($url) {
		$parsedUrl = @parse_url($url);
		if ($parsedUrl !== FALSE && !isset($parsedUrl['scheme']) && !isset($parsedUrl['host'])) {
			// If the relative URL starts with a slash, we need to check if it's within the current site path
			$ret = (!t3lib_div::isFirstPartOfStr($parsedUrl['path'], '/') || t3lib_div::isFirstPartOfStr($parsedUrl['path'], t3lib_div::getIndpEnv('TYPO3_SITE_PATH')));
			return $ret;
		}

		return FALSE;
	}
	/**
	 * generates a hashed link and send it with email
	 *
	 * @param	array		$user   contains user data
	 * @return	string		Empty string with success, error message with no success
	 */
	protected function generateAndSendHash($user) {
		$hours = intval($this->conf['forgotLinkHashValidTime']) > 0 ? intval($this->conf['forgotLinkHashValidTime']) : 24;
		$validEnd = time() + 3600 * $hours;
		$validEndString = date($this->conf['dateFormat'], $validEnd);

		$hash = md5(t3lib_div::generateRandomBytes(64));
		$randHash = $validEnd . '|' . $hash;
		$randHashDB = $validEnd . '|' . md5($hash);

		//write hash to DB
		$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('fe_users', 'uid=' . $user['uid'], array('felogin_forgotHash' => $randHashDB));

		// send hashlink to user
		$this->conf['linkPrefix'] = -1;
		$isAbsRelPrefix = !empty($GLOBALS['TSFE']->absRefPrefix);
		$isBaseURL  = !empty($GLOBALS['TSFE']->baseUrl);
		$isFeloginBaseURL = !empty($this->conf['feloginBaseURL']);

		$link = $this->pi_getPageLink($GLOBALS['TSFE']->id, '', array(
				$this->prefixId . '[user]' => $user['uid'],
				$this->prefixId . '[forgothash]' => $randHash
		));

		// Prefix link if necessary
		if ($isFeloginBaseURL) {
			// First priority, use specific base URL
			// "absRefPrefix" must be removed first, otherwise URL will be prepended twice
			if (!empty($GLOBALS['TSFE']->absRefPrefix)) {
				$link = substr($link, strlen($GLOBALS['TSFE']->absRefPrefix));
			}
			$link = $this->conf['feloginBaseURL'] . $link;
		} elseif ($isAbsRelPrefix) {
			// Second priority
			// absRefPrefix must not necessarily contain a hostname and URL scheme, so add it if needed
			$link = t3lib_div::locationHeaderUrl($link);
		} elseif ($isBaseURL) {
			// Third priority
			// Add the global base URL to the link
			$link = $GLOBALS['TSFE']->baseUrlWrap($link);
		} else {
			// no prefix is set, return the error
			$ret = $this->pi_getLL('ll_change_password_nolinkprefix_message');
			return $ret;
		}

		$msg = sprintf($this->pi_getLL('ll_forgot_validate_reset_password', '', 0), $user['username'], $link, $validEndString);

		// no RDCT - Links for security reasons
		$oldSetting = $GLOBALS['TSFE']->config['config']['notification_email_urlmode'];
		$GLOBALS['TSFE']->config['config']['notification_email_urlmode'] = 0;
		// send the email
		$this->cObj->sendNotifyEmail($msg, $user['email'], '', $this->conf['email_from'], $this->conf['email_fromName'], $this->conf['replyTo']);
		// restore settings
		$GLOBALS['TSFE']->config['config']['notification_email_urlmode'] = $oldSetting;

		return '';

	}
	/**
	 * This function checks the hash from link and checks the validity. If it's valid it shows the form for
	 * changing the password and process the change of password after submit, if not valid it returns the error message
	 *
	 * @param	[type]		$uid: ...
	 * @param	[type]		$piHash: ...
	 * @return	string		The content.
	 */
	protected function changePassword($uid, $piHash) {

		$subpartArray = $linkpartArray = array();
		$done = FALSE;

		$minLength = intval($this->conf['newPasswordMinLength']) ? intval($this->conf['newPasswordMinLength']) : 6;

		$subpart = $this->cObj->getSubpart($this->template, '###TEMPLATE_CHANGEPASSWORD###');

		$markerArray['###STATUS_HEADER###'] = $this->getDisplayText('change_password_header', $this->conf['changePasswordHeader_stdWrap.']);
		$markerArray['###STATUS_MESSAGE###'] = sprintf($this->getDisplayText('change_password_message', $this->conf['changePasswordMessage_stdWrap.']), $minLength);

		$markerArray['###BACKLINK_LOGIN###'] = '';
		$postData =  t3lib_div::_POST($this->prefixId);
		$hash = explode('|', $piHash);
		if (intval($uid) == 0) {
			$markerArray['###STATUS_MESSAGE###'] = 'ERROR' . $this->getDisplayText('change_password_notvalid_message', $this->conf['changePasswordNotValidMessage_stdWrap.']);
			$subpartArray['###CHANGEPASSWORD_FORM###'] = '';
		} else {
			$user = $this->pi_getRecord('fe_users', intval($uid));
			$userHash = $user['felogin_forgotHash'];
			$compareHash = explode('|', $userHash);

			if (!$compareHash || !$compareHash[1] || $compareHash[0] < time() || $hash[0] != $compareHash[0] || md5($hash[1]) != $compareHash[1]) {
				$markerArray['###STATUS_MESSAGE###'] = 'ERROR' . $this->getDisplayText('change_password_notvalid_message', $this->conf['changePasswordNotValidMessage_stdWrap.']);
				$subpartArray['###CHANGEPASSWORD_FORM###'] = '';
			} else {
				// all is fine, continue with new password
				$postData = t3lib_div::_POST($this->prefixId);

				if (isset($postData['changepasswordsubmit'])) {
					if (strlen($postData['password0']) < $minLength) {
						$markerArray['###STATUS_MESSAGE###'] = 'ERROR' . sprintf($this->getDisplayText('change_password_tooshort_message',
								$this->conf['changePasswordTooShortMessage_stdWrap.']), $minLength);
					} elseif ($postData['password0'] != $postData['password2']) {
						$markerArray['###STATUS_MESSAGE###'] = 'ERROR' . sprintf($this->getDisplayText('change_password_notequal_message',
								$this->conf['changePasswordNotEqualMessage_stdWrap.']), $minLength);
					} else {
						$newPass = $postData['password0'];

						$arrPassword = array();

						// Uebergebenes Password setzten.
						// Hier wird kein strip_tags() o.Ae. benoetigt, da beim schreiben in die Datenbank immer "$GLOBALS['TYPO3_DB']->fullQuoteStr()" ausgefuehrt wird!
						$arrPassword['normal'] = trim($newPass);

						// Erstellt ein Password.

						// Unverschluesseltes Passwort uebertragen.
						$arrPassword['encrypted'] = $arrPassword['normal'];

						// Wenn "saltedpasswords" installiert ist wird deren Konfiguration geholt, und je nach Einstellung das Password verschluesselt.
						if ((t3lib_extMgm::isLoaded('saltedpasswords')) && ($GLOBALS['TYPO3_CONF_VARS']['FE']['loginSecurityLevel']))  {
							$saltedpasswords = tx_saltedpasswords_div::returnExtConf();

							if ($saltedpasswords['enabled']) {
								$tx_saltedpasswords = t3lib_div::makeInstance($saltedpasswords['saltedPWHashingMethod']);
								$arrPassword['encrypted'] = $tx_saltedpasswords->getHashedPassword($arrPassword['normal']);
							}
						} else

							// Wenn "md5passwords" installiert ist wird wenn aktiviert, das Password md5 verschluesselt.
							if (t3lib_extMgm::isLoaded('md5passwords')) {
							$arrConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['md5passwords']);

							if ($arrConf['activate'] == 1) {
								$arrPassword['encrypted'] = md5($arrPassword['normal']);
							}
						} else

							// Wenn "t3sec_saltedpw" installiert ist wird wenn aktiviert, das Password gehashed.
							if (t3lib_extMgm::isLoaded('t3sec_saltedpw')) {
							require_once t3lib_extMgm::extPath('t3sec_saltedpw') . 'res/staticlib/class.tx_t3secsaltedpw_div.php';

							if (tx_t3secsaltedpw_div::isUsageEnabled()) {
								require_once t3lib_extMgm::extPath('t3sec_saltedpw') . 'res/lib/class.tx_t3secsaltedpw_phpass.php';
								$tx_t3secsaltedpw_phpass = t3lib_div::makeInstance('tx_t3secsaltedpw_phpass');
								$arrPassword['encrypted'] = $tx_t3secsaltedpw_phpass->getHashedPassword($arrPassword['normal']);
							}
						}
						$newPass=$arrPassword['encrypted'];
						// save new password and clear DB-hash
						$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery(
								'fe_users',
								'uid=' . $user['uid'],
								array('password' => $newPass, 'felogin_forgotHash' => '')
						);
						$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('change_password_done_message', $this->conf['changePasswordDoneMessage_stdWrap.']);
						$done = TRUE;
						$subpartArray['###CHANGEPASSWORD_FORM###'] = '';
						$markerArray['###BACKLINK_LOGIN###'] = $this->getPageLink(
								$this->pi_getLL('ll_forgot_header_backToLogin', '', 1),
								array($this->prefixId . '[redirectReferrer]' => 'off')
						);
					}
				}

				if (!$done) {
					// Change password form
					$markerArray['###ACTION_URI###'] = $this->pi_getPageLink($GLOBALS['TSFE']->id, '', array(
							$this->prefixId . '[user]' => $user['uid'],
							$this->prefixId . '[forgothash]' => $piHash
					));
					$markerArray['###LEGEND###'] = $this->pi_getLL('change_password', '', 1);
					$markerArray['###NEWPASSWORD1_LABEL###'] = $this->pi_getLL('newpassword_label1', '', 1);
					$markerArray['###NEWPASSWORD2_LABEL###'] = $this->pi_getLL('newpassword_label2', '', 1);
					$markerArray['###NEWPASSWORD1###'] = $this->prefixId . '[password0]';
					$markerArray['###NEWPASSWORD2###'] = $this->prefixId . '[password2]';
					$markerArray['###STORAGE_PID###'] = $this->spid;
					$markerArray['###SEND_PASSWORD###'] = $this->pi_getLL('change_password', '', 1);
					$markerArray['###FORGOTHASH###'] = $piHash;
				}
			}
		}
		$ret = $this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray);
		return $ret;
	}
 /**
  * Shows the forgot password form
  *
  * @return	string		content
  */
	protected function showSignon() {

		if (intval($this->conf['register.']['enableSignup'])==0) {
			return '';
		} else {
			$subpart = $this->cObj->getSubpart($this->template, '###TEMPLATE_SIGNON###');
			$subpartArray = $linkpartArray = array();
			$status_message = array();
			$smi=0; // ;-)

			$postData =  t3lib_div::_POST($this->prefixId);
			$done = FALSE;

			$minLength = intval($this->conf['newPasswordMinLength']) ? intval($this->conf['newPasswordMinLength']) : 6;
			$minUserLength = intval($this->conf['register.']['newUserMinLength']) ? intval($this->conf['register.']['newUserMinLength']) : 6;

			if ((count($postData) == 0) && ($this->logintype == 'signup')) {
				$status_message[$smi] = 'No postdata for: ' . $this->prefixId;
				$smi++;
			}

			if (isset($postData['signupsubmit'])) {
				$errcount=0;
				$errpassword1 ='';
				$errpassword2 ='';
				$erruser ='';
				$errsignup_email ='';
				$errfirstname ='';
				$errlastname ='';
				$errcaptcha = '';
				if (strlen($postData['password1']) < $minLength) {
					$errpassword1 = sprintf($this->getDisplayText('change_password_tooshort_message', $this->conf['changePasswordTooShortMessage_stdWrap.']), $minLength);
					$errcount++;
				} elseif ($postData['password1'] != $postData['password2']) {
					$errpassword2 = sprintf($this->getDisplayText('change_password_notequal_message', $this->conf['changePasswordNotEqualMessage_stdWrap.']), $minLength);
					$errcount++;
				}

				if (strlen($postData['user']) < $minUserLength) {
					$erruser = sprintf($this->getDisplayText('new_user_tooshort_message', $this->conf['newUserTooShortMessage_stdWrap.']), $minUserLength);
					$errcount++;
				}

				if (trim($postData['signup_email']) == '') {
						$errsignup_email = sprintf($this->getDisplayText('new_user_email_required', $this->conf['newEmailTooShortMessage_stdWrap.']), trim($postData['signup_email']));
						$errcount++;
				} else {
					if (trim($postData['signup_email']) != '' && !t3lib_div::validEmail(trim($postData['signup_email']))) {
						$errsignup_email = sprintf($this->getDisplayText('error_invalid_email', $this->conf['newEmailInvalidMessage_stdWrap.']), trim($postData['signup_email']));
						$errcount++;
					}
				}

				if (trim($postData['firstname']) == '') {
					If (intval($this->conf['register.']['signupRequireFirstname'])==1) {
						$errfirstname = sprintf($this->getDisplayText('new_user_firstname_required', $this->conf['newUserFirstnameRequiredMessage_stdWrap.']), $minUserLength);
						$errcount++;
					}
				}
				if (trim($postData['lastname']) == '') {
					$errlastname =  sprintf($this->getDisplayText('new_user_lastname_required', $this->conf['newUserLastnameRequiredMessage_stdWrap.']), $minUserLength);
					$errcount++;
				}
				$captchaok = FALSE;

				if ($errcount>0) {
					$status_message[$smi] = sprintf($this->getDisplayText('signup_haderrors_message_error', $this->conf['newUserDataHasErrorsMessage_stdWrap.']), $errcount);
					$smi++;
				} else {
					if ($postData['cpdone'] == '0') {
						$errcaptcha = $this->processSignupCaptcha($postData);
						if ($errcaptcha != '') {
							$errcount++;
						} else {
							$captchaok = TRUE;
							$postData['cpdone'] = '1';
						}
					} elseif ($postData['cpdone'] == '2') {
						$postData['cpdone'] = '0';
					} else {
						$captchaok = TRUE;
					}

				}

				if (count($status_message) === 0) {
					if (intval($postData['cpdone']) == 1) {
						$newPass = $postData['password1'];

						$arrPassword = array();

						// Uebergebenes Password setzten.
						// Hier wird kein strip_tags() o.Ae. benoetigt, da beim schreiben in die Datenbank immer "$GLOBALS['TYPO3_DB']->fullQuoteStr()" ausgefuehrt wird!
						$arrPassword['normal'] = trim($newPass);

						// Erstellt ein Password.

						// Unverschluesseltes Passwort uebertragen.
						$arrPassword['encrypted'] = $arrPassword['normal'];

						// Wenn "saltedpasswords" installiert ist wird deren Konfiguration geholt, und je nach Einstellung das Password verschluesselt.
						if ((t3lib_extMgm::isLoaded('saltedpasswords')) && ($GLOBALS['TYPO3_CONF_VARS']['FE']['loginSecurityLevel']))  {
							$saltedpasswords = tx_saltedpasswords_div::returnExtConf();

							if ($saltedpasswords['enabled']) {
								$tx_saltedpasswords = t3lib_div::makeInstance($saltedpasswords['saltedPWHashingMethod']);
								$arrPassword['encrypted'] = $tx_saltedpasswords->getHashedPassword($arrPassword['normal']);
							}
						} else

							// Wenn "md5passwords" installiert ist wird wenn aktiviert, das Password md5 verschluesselt.
							if (t3lib_extMgm::isLoaded('md5passwords')) {
							$arrConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['md5passwords']);

							if ($arrConf['activate'] == 1) {
								$arrPassword['encrypted'] = md5($arrPassword['normal']);
							}
						} else

							// Wenn "t3sec_saltedpw" installiert ist wird wenn aktiviert, das Password gehashed.
							if (t3lib_extMgm::isLoaded('t3sec_saltedpw')) {
							require_once t3lib_extMgm::extPath('t3sec_saltedpw') . 'res/staticlib/class.tx_t3secsaltedpw_div.php';

							if (tx_t3secsaltedpw_div::isUsageEnabled()) {
								require_once t3lib_extMgm::extPath('t3sec_saltedpw') . 'res/lib/class.tx_t3secsaltedpw_phpass.php';
								$tx_t3secsaltedpw_phpass = t3lib_div::makeInstance('tx_t3secsaltedpw_phpass');
								$arrPassword['encrypted'] = $tx_t3secsaltedpw_phpass->getHashedPassword($arrPassword['normal']);
							}
						}
						$newPass=$arrPassword['encrypted'];

						$row = FALSE;

						// look for user record
						$data = $GLOBALS['TYPO3_DB']->fullQuoteStr($postData['signup_email'], 'fe_users');
						$datausr = $GLOBALS['TYPO3_DB']->fullQuoteStr($postData['user'], 'fe_users');
						$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
								'uid, username, password, email',
								'fe_users',
								'(email=' . $data .' OR username=' . $datausr . ') AND pid IN ('.$GLOBALS['TYPO3_DB']->cleanIntList($this->spid).') '.
								$this->cObj->enableFields('fe_users')
						);

						if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
							$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
						}

						$error = NULL;
						if ($row) {
							// generate an email with the hashed link
							// User already exists
							$status_message[$smi] = $this->pi_getLL('ll_signup_userexistsalready_message_error');
							$smi++;
						} else {
							// password check and insert
							$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
									'',
									'',
									'uid DESC',
									1 );
							$usergenderexistsstr='';
							if (count($rowsfeuser)>0) {
								if (array_key_exists('gender', $rowsfeuser[0])) {
									$record['gender'] = intval($postData['gender']);
								}
								if (array_key_exists('language', $rowsfeuser[0])) {
									$record['language'] = intval($_SESSION['activelang']);
								}

							}
							$userId = 0;
							$record=array();
							$record['crdate'] = $record['tstamp'] = time();
							$record['first_name'] = $postData['firstname'];
							$record['name'] = trim($postData['firstname'] . ' ' . $postData['lastname']);
							$record['last_name'] = $postData['lastname'];
							$record['password'] = $postData['password1'];
							$record['username'] = $postData['user'];
							$record['pid'] = $postData['pid'];
							$record['usergroup'] = $this->conf['register.']['usergroup'];
							$record['email'] = $postData['signup_email'];
							$record['image'] = '';

							$GLOBALS['TYPO3_DB']->exec_INSERTquery('fe_users', $record);
							$userId = $GLOBALS['TYPO3_DB']->sql_insert_id();
							if (intval($userId) == 0) {
								$status_message[$smi] = 'insert in fe_users failed'; //$this->pi_getLL('ll_signup_userexistsalready_message_error');
								$smi++;
							}

						}

					}

				}

			}

			// generate message
			if ((count($status_message)>0) || ($postData['cpdone'] == '0')) {
				if ((count($status_message)>0)) {
					$markerArray['###STATUS_MESSAGESO###'] = $this->cObj->stdWrap(implode('<br />', $status_message), $this->conf['signupErrorMessage_stdWrap.']);
				} else {
					$markerArray['###STATUS_MESSAGESO###'] = $this->getDisplayText('title_captcha', $this->conf['signupHeader_stdWrap.']);
					$shwcap = TRUE;
				}

			} else {
				if ($this->logintype == 'signup') {
					$markerArray['###STATUS_MESSAGESO###'] = '<span class="tx-tc-nodisp>SIGNUPANDLOGINOK</span>' .
														$this->cObj->stdWrap($this->pi_getLL('ll_signupOk_message', '', 1), $this->conf['signupOkMessage_stdWrap.']);
					$done = TRUE;
					$subpartArray['###SIGNON_FORM###'] = '';
				} else {
					$markerArray['###STATUS_MESSAGESO###'] = $this->getDisplayText('signup_header', $this->conf['signupHeader_stdWrap.']);
				}
			}
			$markerArray['###BACKLINK_SIGNON###'] = $this->pi_getLL('ll_forgot_header_backToLogin', '', 1);

			if (!$done) {
				$markerArray['###FORM_ID###'] = 'tx_toctoccomments_pi2_form';
				$markerArray['###PASSWORD_LABEL###'] = $this->pi_getLL('password', '', 1);
				$markerArray['###PASSWORD2_LABEL###'] = $this->pi_getLL('password', '', 1);
				$markerArray['###STORAGE_PID###'] = $this->spid;
				$markerArray['###USERNAME_LABEL###'] = $this->pi_getLL('username', '', 1);
				$markerArray['###FIRSTNAME_LABEL###'] = $this->pi_getLL('firstname', '', 1);
				$markerArray['###LASTNAME_LABEL###'] = $this->pi_getLL('lastname', '', 1);
				$markerArray['###SIGN_UP###'] = $this->pi_getLL('sign_up', '', 1);
				$markerArray['###BACKLINK_SIGNON###'] = $this->pi_getLL('ll_forgot_header_backToLogin', '', 1);
				$markerArray['###SUBMIT_SOONCLICK###'] = 'return ttc_ajaxfesignup(this);';
				$markerArray['###ACTION_URI###'] = $this->getPageLink('', array($this->prefixId . '[signup]'=>1), TRUE);
				$markerArray['###EMAIL_LABEL###'] = $this->pi_getLL('your_email', '', 1);
				$markerArray['###SIGNON_PASSWORD_ENTEREMAIL###'] = $this->pi_getLL('forgot_password_enterEmail', '', 1);
				$markerArray['###SEND_PASSWORD###'] = $this->pi_getLL('sign_up', '', 1);
				$markerArray['###DATA_LABEL###'] = $this->pi_getLL('email', '', 1);
				$markerArray['###NEWPASSWORD1_LABEL###'] = $this->pi_getLL('newpassword_label1', '', 1);
				$markerArray['###NEWPASSWORD2_LABEL###'] = $this->pi_getLL('newpassword_label2', '', 1);
				$markerArray['###NEWPASSWORD1###'] = $this->prefixId . '[password1]';
				$markerArray['###NEWPASSWORD2###'] = $this->prefixId . '[password2]';
				$markerArray['###NEWUSER###'] = $this->prefixId . '[user]';
				$markerArray['###NEWFIRSTNAME###'] = $this->prefixId . '[firstname]';
				$markerArray['###NEWLASTNAME###'] = $this->prefixId . '[lastname]';
				$markerArray['###NEWEMAIL###'] = $this->prefixId . '[signup_email]';
				if ($this->logintype == 'signup') {
					$markerArray['###NEWPASSWORD1V###'] = $postData['password1'];
					$markerArray['###NEWPASSWORD2V###'] = $postData['password2'];
					$markerArray['###NEWUSERV###'] = $postData['user'];
					$markerArray['###NEWFIRSTNAMEV###'] = $postData['firstname'];
					$markerArray['###NEWLASTNAMEV###'] = $postData['lastname'];
					$markerArray['###NEWEMAILV###'] = $postData['signup_email'];
					$markerArray['###ERRNEWPASSWORD1V###'] = $errpassword1;
					$markerArray['###ERRNEWPASSWORD2V###'] = $errpassword2;
					$markerArray['###ERRNEWUSERV###'] = $erruser;
					$markerArray['###ERRNEWFIRSTNAMEV###'] = $errfirstname;
					$markerArray['###ERRNEWLASTNAMEV###'] = $errlastname;
					$markerArray['###ERRNEWEMAILV###'] = $errsignup_email;
					$markerArray['###CPDONED###'] = $postData['cpdone'];
					$required = '';
					if (intval($postData['cpdone']) == 0) {
						if ($errcount == 0) {
							$markerArray['###CAPTCHA###'] = $this->getSignupCaptcha($required, $errcaptcha, $postData['captcha']);
						} else{
							if ($shwcap === TRUE) {
								$markerArray['###CAPTCHA###'] = $this->getSignupCaptcha($required, $errcaptcha, $postData['captcha']);
							} else {
								$markerArray['###CAPTCHA###'] = '';
							}
						}
					} else {
						$markerArray['###CAPTCHA###'] = '';
					}
				} else {
					$markerArray['###NEWPASSWORD1V###'] = '';
					$markerArray['###NEWPASSWORD2V###'] = '';
					$markerArray['###NEWUSERV###'] = '';
					$markerArray['###NEWFIRSTNAMEV###'] = '';
					$markerArray['###NEWLASTNAMEV###'] = '';
					$markerArray['###NEWEMAILV###'] = '';
					$markerArray['###ERRNEWPASSWORD1V###'] = '';
					$markerArray['###ERRNEWPASSWORD2V###'] = '';
					$markerArray['###ERRNEWUSERV###'] = '';
					$markerArray['###ERRNEWFIRSTNAMEV###'] = '';
					$markerArray['###ERRNEWLASTNAMEV###'] = '';
					$markerArray['###ERRNEWEMAILV###'] = '';

					$required = '';
					$markerArray['###CPDONED###'] = '2';
					$error = '';
					$markerArray['###CAPTCHA###'] = '';

				}

			}
			$markerArray = array_merge($markerArray, $this->getUserFieldMarkers());
			$ret = $this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray);
			return $ret;
		}
	}

	/**
	 * Adds captcha code if enabled.
	 *
	 * @param	string		$required
	 * @param	string		$error: Possible error text
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$this: Reference to parent object
	 * @return	string		Generated HTML
	 */
	protected function getSignupCaptcha($required, $errcp, $cpval) {
		$captchaType = intval($this->conf['register.']['signupUseCaptcha']);
		$subpartArray = $linkpartArray = array();

		if (($captchaType == 1) && (t3lib_extMgm::isLoaded('captcha'))) {
			$template = $this->cObj->getSubpart($this->template, '###SIGNUP_CAPTCHA###');
			$markerArray = array(
					'###SR_FREECAP_IMAGE###' => '<img src="' . t3lib_extMgm::siteRelPath('captcha') . 'captcha/captcha.php" alt="" />',
					'###SR_FREECAP_CANT_READ###' => '',
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $errcp,
					'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_CAPTCHA###' =>  $this->pi_getLL('enter_captcha', '', 1),
					'###NEWCAPTCHAV###' => $cpval,
			);
			$code = $this->cObj->substituteMarkerArrayCached($template, $markerArray, $subpartArray, $linkpartArray);
			$retstr = str_replace('<br /><br />', '<br />', $code);
			return $retstr;

		} elseif (($captchaType == 2) && (t3lib_extMgm::isLoaded('sr_freecap'))) {

			require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
			$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
			/* @var $freeCap tx_srfreecap_pi2 */
			$template = $this->cObj->getSubpart($this->template, '###SIGNUP_CAPTCHA###');
			$markerArray = array_merge($freeCap->makeCaptcha(), array(
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $errcp,
					'###TEXT_CAPTCHA###' => $this->pi_getLL('enter_captcha', '', 1),
					'###NEWCAPTCHAV###' => $cpval,
			));
			$retstr = $this->cObj->substituteMarkerArrayCached($template, $markerArray, $subpartArray, $linkpartArray);
			return $retstr;
		}

		return '';
	}
	/**
	 * returns typo3 root if installed in subdir
	 *
	 * @param	boolean		$withleadingslash: if ture leading slash is included
	 * @return	string		ex: '/' or '/typo3dir/' ..
	 */
	protected function locationHeaderUrlsubDir($withleadingslash = TRUE) {
		$parts = explode('//', t3lib_div::locationHeaderUrl('') );
		if (count($parts)>1) {
			$partafterroot=$parts[1];
			$partafterrootarr=explode('/', $partafterroot);
			unset($partafterrootarr[0]);
			$partafterroot=implode('/', $partafterrootarr);
			if ($withleadingslash) {
				return '/' . $partafterroot;
			} else {
				return $partafterroot;
			}

		}

		$retstr = t3lib_div::locationHeaderUrl('');
		return $retstr;
	}
	/**
	 * Processes the report form for complaints and sends message by e-mail
	 *
	 * @param	array		$errors
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$piVars: the pi-Vars :-)
	 * @return	boolean		TRUE if successful
	 */
	protected function processSignupCaptcha($postData) {
		$err = '';
		$captchaType = intval($this->conf['register.']['signupUseCaptcha']);
		if ($captchaType == 1 && t3lib_extMgm::isLoaded('captcha')) {

			$sessionFile = str_replace('/pi2', '/pi1', realpath(dirname(__FILE__))) . '/sessionpath.tmp';
			$sessionSavePath =  @file_get_contents($sessionFile);
			$sessionTimeout = 3*1440;
			if (!(isset($commonObj))) {
				require_once (str_replace('/pi2', '/pi1', realpath(dirname(__FILE__))) . '/class.toctoc_comments_common.php');
				$commonObj = new toctoc_comments_common;
			}

			$commonObj->start_toctoccomments_session($sessionTimeout, $sessionSavePath);

			$captchaStr = $_SESSION['tx_captcha_string'];
			$_SESSION['tx_captcha_string'] = '';
			if (!$captchaStr || $postData['captcha'] !== $captchaStr) {
				$err = $this->pi_getLL('error_wrong_captcha', '', 1);
			}

		} elseif ($captchaType == 2 && t3lib_extMgm::isLoaded('sr_freecap')) {
			require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
			$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
			/* @var $freeCap tx_srfreecap_pi2 */
			if (!$freeCap->checkWord($postData['captcha'])) {
				$err = $this->pi_getLL('error_wrong_captcha', '', 1);
			}

		} else {
			$err = 'captcha no longer available for type ' . $captchaType;
		}
		return $err;
	}
	/**
	 * login for facebook users
	 *
	 * @param	[type]		$facebookId: ...
	 * @return	[type]		...
	 */
	protected function loginUser($facebookId) {
		$where = 'tx_toctoc_comments_facebook_id=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($facebookId, $this->tableName) .
		' AND deleted=0';

		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->tableName, $where, '', '', 1);
		if ($userToLogin = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
			$feUser = $GLOBALS['TSFE']->fe_user;
			unset($feUser->user);
			if($this->conf['facebook.']['makeSessionPermanent']) {
				$feUser->is_permanent = 1;
			}

			$feUser->createUserSession($userToLogin);
			$feUser->loginSessionStarted = TRUE;
			$feUser->user = $feUser->fetchUserSession();
			$GLOBALS['TSFE']->loginUser = 1;
			$GLOBALS['TSFE']->initUserGroups(); // this is needed in case the redirection is to a restricted page.
		}
	}

	/**
	 * inserts or updates the facebook values to table fe_users
	 *
	 * @param	[type]		$facebookUserProfile: ...
	 * @return	[type]		...
	 */
	protected function storeUser($facebookUserProfile) {

		$this->fe_usersValues['pid'] = $this->conf['storagePid'];
		// username should be a unique, random string that should never be used with any registration
		$username = 'facebook' . $facebookUserProfile['id'] . '.' . t3lib_div::getRandomHexString(12);

		$where = 'tx_toctoc_comments_facebook_id=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($facebookUserProfile['id'], $this->tableName) .
		' AND deleted=0';

		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->tableName, $where, '', '', 1);

		$userFound = ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0)?TRUE:FALSE;

		if($userFound) {
			$user = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result);

			if($user['tx_toctoc_comments_facebook_updated_time'] == $facebookUserProfile['updated_time']) {
				/* no update needed since facebook profile was not updated */
				return;
			}

		}

		$fe_usersValues['tstamp'] = time();
		$fe_usersValues['first_name'] = $facebookUserProfile['first_name'];
		$fe_usersValues['last_name'] = $facebookUserProfile['last_name'];
		$fe_usersValues['username'] = $username;
		$fe_usersValues['lastlogin'] = time();
		$fe_usersValues['tx_toctoc_comments_facebook_link'] = $facebookUserProfile['link'];
		$fe_usersValues['name'] = $facebookUserProfile['name'];

		if(isset($facebookUserProfile['locale'])) {
			$fe_usersValues['tx_toctoc_comments_facebook_locale'] = $facebookUserProfile['locale'];
		}

		if(isset($facebookUserProfile['gender'])) {
			$fe_usersValues['tx_toctoc_comments_facebook_gender'] = $facebookUserProfile['gender'];

		}

		if(isset($facebookUserProfile['email'])) {
			$fe_usersValues['tx_toctoc_comments_facebook_email'] = $facebookUserProfile['email'];
			$fe_usersValues['email'] = $facebookUserProfile['email'];
		}

		$fe_usersValues['pid'] = $this->conf['storagePid'];
		$imagename = '';
		$imagename = $this->copyImageFromFacebook($facebookUserProfile['id']);
		$fe_usersValues['image'] = $imagename;
		$fe_usersValues['tx_toctoc_comments_facebook_updated_time'] = $facebookUserProfile['updated_time'];

		if($userFound) {
			$userId = $user['uid'];
			$updateWhere = 'uid=' . $user['uid'];
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->tableName, $updateWhere, $fe_usersValues);
		} else {
			$fe_usersValues['tx_toctoc_comments_facebook_id'] = $facebookUserProfile['id'];
			$fe_usersValues['usergroup'] = $this->conf['register.']['usergroup'];
			$fe_usersValues['password'] = t3lib_div::getRandomHexString(32);
			$fe_usersValues['crdate'] = time();
			$GLOBALS['TYPO3_DB']->exec_INSERTquery($this->tableName, $fe_usersValues);
			$userId = $GLOBALS['TYPO3_DB']->sql_insert_id();
		}

 		if ($imagename != '') {
 			// and add $fe_usersValues['image'] to the $_SESSION['AJAXimages']
			$conf=$GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];
			$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];
			$userimagesize = 96;
			$userimagestyle = ' tx-tc-uimgsize';
			$profileimgclass ='tx-tc-userpic';

			$usernametitle = trim($facebookUserProfile['first_name'] . ' ' . $facebookUserProfile['last_name']);
			if ($usernametitle == '') {
				$usernametitle = trim($facebookUserProfile['name']);
			}

			if ($usernametitle == '') {
				$usernametitle = trim($username);
			}

			$classonline = ' tx-tc-online';
			$commentuserimageout = $commentuserimagepath . $fe_usersValues['image'];

		 	$img = array();
			$img['file'] = GIFBUILDER;
			$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
			$img['file.']['10'] = IMAGE;
			$img['file.']['10.']['file'] = $commentuserimageout;
			$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
			$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
			$img['params'] = 'class="'.$profileimgclass . $classonline . $userimagestyle . '" title="'. $usernametitle .
			'"  id="tx-tc-cts-img-"';
			$tmpimgstr = $this->cObj->IMAGE($img);

			$_SESSION['AJAXimages'][$userId] = $tmpimgstr;
			$_SESSION['AJAXimagesrefresh'] = TRUE;
			$_SESSION['AJAXimagesrefreshImage'] = $fe_usersValues['image'];
			$_SESSION['AJAXimagesTimeStamp'] = microtime(TRUE);
 		}

	}
	/**
	 * copy Image from Facebook
	 *
	 * @param	string		$facebookUserId: url to fetch
	 * @return	string		$imgname
	 */
	private function copyImageFromFacebook($facebookUserId) {
		$imageUrl = 'http://graph.facebook.com/' . $facebookUserId. '/picture?width=300&height=300 ';
		$fileName = 'facebook' . $facebookUserId . '.jpg';
		$savepathfilename = $this->file_get_contents_curl($imageUrl, 'jpg', PATH_site . $this->conf['facebook.']['imageDir'] . $fileName);
		$ret = str_replace(PATH_site . $this->conf['facebook.']['imageDir'], '', $savepathfilename);
		return $ret;
	}
	/**
	 * Read content from the web with CURL
	 *
	 * @param	string		$urltofetch: url to fetch
	 * @param	string		$ext: file extension
	 * @param	string		$savepathfilename: path and filename to save
	 * @return	variant		$savepathfilename or FALSE
	 */
	protected function file_get_contents_curl($urltofetch,$ext, $savepathfilename = '') {
		$extorig = $ext;
		$ext = strtolower($ext);
		$urlarr = explode('//', $urltofetch);
		$urlstr = '';
		if (strtolower(substr($urlarr[0], 0, 3) == 'htt')) {
			$urlstr=$urlarr[0] . '/';
			$urlarr[0] = '';
		}
		$urlstr .= implode('//', $urlarr);
		$urlstr = str_replace('///', '//', $urlstr);
		$urltofetch = $urlstr;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
		curl_setopt($ch, CURLOPT_URL, $urltofetch);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FILETIME, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		$curl_errno=0;

		$data = curl_exec($ch);
		$curl_errno = curl_errno($ch);

		if ($curl_errno > 0) {
			$curl_errmsg =  curl_error($ch) . ', ' . $urltofetch;
			curl_close($ch);
			return FALSE;
		}
		$infohttpcode = intval(curl_getinfo($ch, CURLINFO_HTTP_CODE));
		// checking mime types
		if ($infohttpcode < 400)  {
			$this->returnurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
			$infofiletype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
			$infofiletime = curl_getinfo($ch, CURLINFO_FILETIME);
			$infofilesize = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
			if ($infofiletype == 'image/gif') {
				$newext = 'gif';

			} elseif  (($infofiletype == 'image/jpeg') || ($infofiletype == 'image/pjpeg')) {
				$newext = 'jpg';

			} elseif ($infofiletype == 'image/png') {
				$newext = 'png';

			} elseif (($infofiletype == 'image/bmp') || ($infofiletype == 'image/x-windows-bmp')){
				$newext = 'bmp';

			} else {
				$newheader = '';
				if ($ext == 'jpg') {
					$newheader = 'Content-Type: image/jpeg';
				} elseif ($ext == 'png') {
					$newheader = 'Content-Type: image/png';
				}  elseif ($ext == 'gif') {
					$newheader = 'Content-Type: image/gif';
				} elseif ($ext == 'bmp') {
					$newheader = 'Content-Type: image/bmp';
				}
				$data = $data;
				$newext = $ext;
			}
			curl_close($ch);
			$savepathfilename = str_replace ('.' . $extorig, '.' . $newext, $savepathfilename);

			if (file_exists($savepathfilename)){
				unlink($savepathfilename);
			}

			file_put_contents($savepathfilename, $data);

			return $savepathfilename;
		} else {
			return FALSE;
		}

	}
}
?>