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
 *  117: class tx_toctoccomments_pi2 extends tslib_pibase
 *  142:     protected function processRedirect()
 *  156:     protected function pmain($content, $dochangepassword = FALSE, $uid = 0, $piHash = '')
 *  248:     public function main($content, $conf, $dochangepassword = FALSE, $uid = 0, $piHash = '')
 *  519:     protected function watermark($conf, $content)
 *  557:     protected function showForgot()
 *  637:     protected function showLogout()
 *  672:     protected function showLogin()
 *  824:     protected function getRSAKeyPair()
 *  861:     protected function getPageLink($label, $piVars, $returnUrl = FALSE)
 *  897:     protected function getPreserveGetVars()
 *  950:     protected function generatePassword($len)
 *  970:     protected function getDisplayText($label, $stdWrapArray=array())
 *  982:     protected function getUserFieldMarkers()
 * 1024:     protected function validateRedirectUrl($url)
 * 1055:     protected function isInCurrentDomain($url)
 * 1067:     protected function isInLocalDomain($url)
 * 1108:     protected function isRelativeUrl($url)
 * 1124:     protected function generateAndSendHash($user)
 * 1296:     protected function changePassword($uid, $piHash)
 * 1420:     protected function showSignon()
 * 1838:     protected function getSignupCaptcha($required, $errcp, $cpval)
 * 1931:     protected function locationHeaderUrlsubDir($withleadingslash = TRUE)
 * 1958:     protected function processSignupCaptcha($postData)
 * 2006:     protected function loginUser($facebookId)
 * 2035:     protected function storeUser($facebookUserProfile, $socialnetwork)
 * 2366:     private function registerUserGroup()
 * 2428:     private function copyImageFromFacebook($facebookUserId, $url, $socialnetwork, $facebook_updated_time)
 * 2465:     protected function file_get_contents_curl($urltofetch,$ext, $savepathfilename = '')
 * 2555:     protected function getCurrentIp()
 * 2564:     protected function initTSFE()
 * 2636:     protected function addSysFile($FileName, $FileNameIdentifier, $currentstorage, $advancedFeUserImagePath,
			$useruid, $feuserstoragefolder, $imagefield)
 *
 * TOTAL FUNCTIONS: 31
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
	if ((!t3lib_extMgm::isLoaded('compatibility6')) && (!t3lib_extMgm::isLoaded('compatibility7')))  {
		(class_exists('tslib_eidtools', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Utility\EidUtility', 'tslib_eidtools');
		(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
	}
	(class_exists('t3lib_utility_Array', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ArrayUtility', 't3lib_utility_Array');
	if ((t3lib_extMgm::isLoaded('saltedpasswords')) && ($GLOBALS['TYPO3_CONF_VARS']['FE']['loginSecurityLevel']))  {
		if ((!t3lib_extMgm::isLoaded('compatibility6')) && (!t3lib_extMgm::isLoaded('compatibility7')))  {
			(class_exists('tx_saltedpasswords_div', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility', 'tx_saltedpasswords_div');
		}
	}

}

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
	protected $noRedirect = TRUE;	// flag for disable the redirect
	protected $logintype;	// logintype (given as GPvar), possible: login, logout
	protected $loginParameter = 'fb_login';
	protected $nofacebook = FALSE;
	protected $tableName = 'fe_users';
	protected $fberror = '';
	protected $gotnewpic = FALSE;
	protected $usrimagesize = 96;

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

		$this->spid = $this->conf['storagePid'];

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
		$this->userIsLoggedIn = 0;
		if (intval($GLOBALS['TSFE']->fe_user->user['uid']) != 0) {
			$this->userIsLoggedIn = $GLOBALS['TSFE']->loginUser;
		}

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
		if (($this->logintype === 'login' || $this->logintype === 'logout' || $this->logintype === 'forgot' || $this->logintype === 'signup') &&
				$this->redirectUrl && !$this->noRedirect) {
			if (version_compare(TYPO3_version, '6.1', '>')) {
				$fe_usercookieOK = $GLOBALS['TSFE']->fe_user->isCookieSet();
			} else {
				$fe_usercookieOK = $GLOBALS['TSFE']->fe_user->cookieId;
			}

			if (!$fe_usercookieOK) {
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

		if (intval($this->conf['register.']['signupAdminConfirmation']) == 1) {
			$this->conf['register.']['signupConfirmEmail'] = 0;
		}

		$this->conf['redirectMode'] = '';
		$this->conf['redirectDisable'] = '';
		$this->conf['redirectFirstMethod'] = '';
		$this->conf['preserveGETvars'] = 'all';
		// Loading default pivars
		$this->pi_setPiVarDefaults();

		// Loading language-labels
		$this->pi_loadLL();

		if (t3lib_div::_GP('getrsahash')) {
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

			if($_POST['tx_toctoccomments_pi2']['fbLogin'] == '1') {
				if (!isset($_SESSION['fb_access_ok'])) {
					require_once(t3lib_extmgm::extPath('toctoc_comments', 'contrib/facebookv4/autoload.php'));

					$this->fberror = '';
					if (($conf['facebook.']['apiVersion'] < '2.0') || ($conf['facebook.']['apiVersion'] > '2.9')) {
						$conf['facebook.']['apiVersion'] = '2.5';
					}

					$_SESSION['fbaccessToken'] = NULL;

					$facebook = new Facebook\Facebook(array(
						'app_id' => $conf['facebook.']['appId'],
						'app_secret' => $conf['facebook.']['secret'],
						'default_graph_version' => 'v' . trim($conf['facebook.']['apiVersion']),
						'cookie' => TRUE,
						));

					$helper = $facebook->getJavaScriptHelper();
					try {
					  $accessToken = $helper->getAccessToken();
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
					  // When Graph returns an error
					  	$this->fberror .=  'Facebook error: Graph returned an error: ' . $e->getMessage();
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
					  // When validation fails or other local issues
					  $this->fberror .= 'Facebook error: Facebook SDK returned an error: ' . $e->getMessage();

					}

					if (!isset($accessToken)) {
						if ($this->fberror == '') {
							$this->fberror =  'Facebook Error: Bad request, getAccessToken() failed by some reasons. Check the facebook app';
						}
					} else {
						$_SESSION['fb_access_token'] = (string)$accessToken;
						try {
							$response = $facebook->get('/me?fields=id,updated_time,picture,first_name,last_name,locale,link,name,gender,email', $_SESSION['fb_access_token']);
							$facebookUserProfile = $response->getGraphUser();

							if (trim($facebookUserProfile['email']) == '') {
								$this->fberror .= $this->pi_getLL('facebookloginerrormail', '', 1);
							} else {
								$facebookUserProfile['imageurl'] = $facebookUserProfile['picture']['data']['url'];
								$this->storeUser($facebookUserProfile, 'facebook');
								$_SESSION['fb_access_ok']=$facebookUserProfile['id'];
								$this->loginUser($facebookUserProfile['id']);
								$_SESSION['fb_access_ok']=$facebookUserProfile['id'];
							}
						} catch(Facebook\Exceptions\FacebookResponseException $e) {
							$this->fberror = 'Facebook problem: Graph returned an error: ' . $e->getMessage();

						} catch(Facebook\Exceptions\FacebookSDKException $e) {
							$this->fberror =  'Facebook problem: Facebook SDK returned an error: ' . $e->getMessage();
						}

					}

					$fbstatustext = '';

					if (trim($this->fberror) != '') {
						$fbstatustext = '<div style="float: none; display: inline-block;"><span class="tx-tc-required-error">' . $this->fberror . '</span></div>';
					}

				} else {
					// User has made successful login, we won't bother Facebook twice as
					// in anyway the same accesstoken cannot be reused anymore (09/2016)
					$fb_access_ok = $_SESSION['fb_access_ok'];
					$this->loginUser($fb_access_ok);
					$_SESSION['fb_access_ok'] = $fb_access_ok;

				}
			}

			$subpart = trim($this->cObj->getSubpart($this->template, '###TEMPLATE_FACEBOOK###'));
			$thefacebooklogin=$this->pi_getLL('facebooklogin', '', 1);
			$subpartArray = $linkpartArray = $markerArray = array(
					'###FBLOGIN###' => $thefacebooklogin,
					);
			$fbbutton = trim($this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray));
     		$contentfb .= '
			<div id="facebookauth">' . $fbbutton . '</div>
' . $fbstatustext;
		}

		$nogoogle = FALSE;
		if (!isset($conf['google.']['ClientID']) || $conf['google.']['ClientID'] == '') {
			$nogoogle = TRUE;
		}

		if (!isset($conf['google.']['ClientSecret']) || $conf['google.']['ClientSecret'] == '') {
			$nogoogle = TRUE;
		}

		$contentgoogle = '';
		if ($nogoogle == FALSE) {
			if(($_POST['tx_toctoccomments_pi2']['googleLogin'] == '1') && ($_POST['tx_toctoccomments_pi2']['googleEncUser'] != '')) {
				$data_str = $_POST['tx_toctoccomments_pi2']['googleEncUser'];
				$facebookUserProfile = unserialize(base64_decode($data_str));
				$this->storeUser($facebookUserProfile, 'google');
				$this->loginUser($facebookUserProfile['id']);

			}

			$subpart = trim($this->cObj->getSubpart($this->template, '###TEMPLATE_GOOGLE###'));
			$subpartArray = $linkpartArray = $markerArray = array(
					'###CLIENT_ID###' => $conf['google.']['ClientID'],
					);
			$googlebutton = trim($this->cObj->substituteMarkerArrayCached($subpart, $markerArray, $subpartArray, $linkpartArray));
     		$contentgoogle .= '
     				<div id="googleauth">' . $googlebutton . '</div>
     				';
		}

		$content = $this->pmain($content, $dochangepassword, $uid, $piHash);

		if (t3lib_div::_GP('refreshcontent') != 'refresh') {

			$newuser = '';
			$forgotpw = '<span class="tx-tc-forgotpw link tx-tc-textlink" id="tx-tc-forgotpw-link">'  .
						$this->pi_getLL('ll_forgot_header', '', 1) . '</span>';
			$hideIfFacebookActiveClass = '';
			$hideshowIfFacebookActiveClass = ' tx-tc-blockdisp';
			if ((intval($conf['hideIfFaceBookActive']) == 1) && ($this->nofacebook == FALSE) && ($this->nogoogle == FALSE)){
				$hideIfFacebookActiveClass = ' tx-tc-nodisp';
				$hideshowIfFacebookActiveClass = ' tx-tc-nodisp';
			}

			if (intval($conf['register.']['enableSignup']) == 1) {
				$buttonnewaccount = '<div class="tx-tc-login-form-iframe' . $hideIfFacebookActiveClass . '" id="tx-tc-buttonfornewaccount">
					 		<input type="button" id="tx-tc-buttonfornewaccount-bt" value="' . $this->pi_getLL('sign_up', '', 1) .
					 		'"	class="tx-tc-ct-submit tx-tc-login-button" /></div>';
			}

			$contentforgotpwarr=explode('###DIV_BLOCKLINKS###', $content);

			if (count($contentforgotpwarr) > 1) {
				$contentarrlink = explode('</a>', $contentforgotpwarr[1]);
				$contentarrlink[0] = $forgotpw;
				$contentforgotpwarr[1] = implode('', $contentarrlink);
				$content = implode('###DIV_BLOCKLINKS###', $contentforgotpwarr);
			}

			$policyLink = '';
			if (intval($conf['policyPid']) > 0) {
				$conflink = array(
						'parameter' => intval($conf['policyPid']),
						'ATagParams' => 'rel="nofollow"',
				);
				$policyLink = '<div class="tx-tc-login-form-field tx-tc-login-policy">' . $this->cObj->typoLink($this->pi_getLL('policy_link', '', 1), $conflink) .
				'</div>';
			}

			$content=strtr($content, array(
										'###FORM_ID###'=>$prefix.'_form',
										'###DIV_BLOCKLINKS###'=>'',
										'###SIGNUP###'=> $this->showSignon(),
										'###REGISTER###' => $buttonnewaccount,
										'###FACEBOOK###' => $contentfb . $contentgoogle ,
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
				$strCurrentIP = $this->getCurrentIp();

				if (intval($GLOBALS['TSFE']->fe_user->user['uid']) == 0) {
					$_SESSION['toctoc_user'] = '' . $strCurrentIP . '.0';
				} else {
					$_SESSION['toctoc_user'] = '0.0.0.0.' . $GLOBALS['TSFE']->fe_user->user['uid'];
				}

				$search = array('@<![\s\S]*?--[ \t\n\r]*>@',
				);
				$content = preg_replace($search, '', $content);
				$answerarr = $redirect . 'toctoc-data-sep' . $content . 'toctoc-data-sep' . trim($this->conf['refreshIdList']);
				$responsedec = base64_encode($answerarr);
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
						'uid, username, password, email, first_name, last_name, name',
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
		$markerArray['###LEGEND###'] = ''; //-> 7.4.0: $this->pi_getLL('oLabel_header_welcome', '', 1);
		$dofp = 0;
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
				if ($this->fberror == 'waitconfirm') {
					$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('error_message_waitconfirm', $this->conf['errorMessage_stdWrap.']);

				} else {
					$markerArray['###STATUS_MESSAGE###'] = $this->getDisplayText('error_message', $this->conf['errorMessage_stdWrap.']);
				}

				$gpRedirectUrl = t3lib_div::_GP('redirect_url');
				$dofp = 1;
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
					$dofp = 2;
				}
				if($this->logintype === 'signup') {
					$dofp = 3;
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
			$socialnetwork='';
			if ((str_replace('facebook', '', $tempFeUserName) != $tempFeUserName)) {
				$socialnetwork='Facebook';
			} elseif (str_replace('google', '', $tempFeUserName) != $tempFeUserName) {
				$socialnetwork='Google';
			}

			if ($socialnetwork != '') {
				$fblink = '(<a href="' . $marker['###FEUSER_TX_TOCTOC_COMMENTS_FACEBOOK_LINK###'] . '">'. $socialnetwork .'</a>)';
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
		$confpi1 = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];
		if (intval($this->conf['register.']['signupConfirmEmail']) == 1) {
			$msg = sprintf($this->pi_getLL('ll_register_validate_reset_password', '', 0), $user['username'], $link, $validEndString);

		} else {
			$msg = sprintf($this->pi_getLL('ll_forgot_validate_reset_password', '', 0), $user['username'], $link, $validEndString);
		}
		$msg = str_replace("\r\n", "\n", $msg);
		$msgarr = explode("\n", $msg);
		$subject = array_shift($msgarr);
		$dummy = array_shift($msgarr);
		$msgbody = implode('<br>', $msgarr);
		$msgbody = str_replace($link . '<br>', '', $msgbody);

		// no RDCT - Links for security reasons
		$oldSetting = $GLOBALS['TSFE']->config['config']['notification_email_urlmode'];
		$GLOBALS['TSFE']->config['config']['notification_email_urlmode'] = 0;

		require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));
		if (!(isset($this->lib))) {
			$this->lib = new toctoc_comment_lib;
		}

		if (!(isset($this->lib->cObj))) {
			$this->lib->cObj = t3lib_div::makeInstance('tslib_cObj');
		}

		if ($confpi1['HTMLEmail']) {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $confpi1['advanced.']['notificationForPwdChangeHTMLEmailTemplate']);
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);

			$templateCode = @file_get_contents(PATH_site . $usetemplateFile);
			$templatefilepath=PATH_site . $usetemplateFile;
		}

		if (intval($this->conf['register.']['signupConfirmEmail']) == 1) {
			$pageTitle=$this->pi_getLL('userEmail.Setuppasswordhere');//'Set up your password here';
			$messageType=$this->pi_getLL('userEmail.Signuppassword');//'Sign up, password';
			//$subject = $this->pi_getLL('UserEmail.Setuppasswordsubject');
		} else {
			$pageTitle=$this->pi_getLL('userEmail.Resetpasswordhere');//''Reset your password here';
			$messageType=$this->pi_getLL('userEmail.Resetpassword');//'Reset your password';
			//$subject = $this->pi_getLL('UserEmail.Resetpasswordsubject');
		}

		if ($confpi1['HTMLEmail']) {
			$linktologin = $link;

			$infoleft='';

			$myhomepagelinkarr = explode('//', t3lib_div::locationHeaderUrl(''));
			$myhomepagelink = $myhomepagelinkarr[1];
			$fromeIDreturn = '';

			$notifiyusername = $user['username'];
			if ($user['last_name'] != '') {
				$salutation= $this->pi_getLL('userEmail.salutationformal');
				$notifiyusername = $user['last_name'];
				if ($user['first_name'] != '') {
					$notifiyusername = $user['first_name'] . ' ' . $user['last_name'];
				}

			} else {
				$salutation= $this->pi_getLL('userEmail.salutation');
				if ($user['first_name'] != '') {
					$notifiyusername = $user['first_name'];
				}

			}

			$myhomepagetypoLink_URL = str_replace('https:', 'http:', t3lib_div::locationHeaderUrl(''));

			$markerArray = array(
					'###USER###' => $notifiyusername,
					'###SALUTATION###' => $salutation,
					'###MESSAGEBODY###' => $msgbody,
					'###PAGETITLE####' => $pageTitle,
					'###LINK_TO_COMMENT###' => $linktologin,
					'###MESSAGETYPE###'  => $messageType,
					'###INFOSLEFT###'  => $infoleft,
					'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					'###MYHOMEPAGE###'  => $myhomepagelink,
					'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
					'###MYFONTFAMILY###'  => $confpi1['HTMLEmailFontFamily'],
					'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
			);
		}

		if ($this->conf['email_fromName'] == '') {
			$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - ' . $this->pi_getLL('userEmail.Useradministration');
		} else {
			$sendername = str_replace('%site%', $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'], $this->conf['email_fromName']);
		}

		if (t3lib_div::validEmail($this->conf['email_from'])) {
			if (t3lib_div::validEmail($user['email'])) {
				if ($confpi1['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
					$content = $this->lib->t3substituteMarkerArray($templateCode, $markerArray);
					$this->lib->send_mail($user['email'], $subject, '', $content,
							$this->conf['email_from'], $sendername, $confpi1['spamProtect.']['checkSMTPService']);
				} else {
					$this->cObj->sendNotifyEmail($msg, $user['email'], '', $this->conf['email_from'], $sendername, $this->conf['replyTo']);
				}
			} else {
				$ret = sprintf($this->pi_getLL('ll_error_invalid_email'), trim($user['email']));
				return $ret;
			}

		} else {
			$ret =  $this->pi_getLL('userEmail.invalid.email') . ' - (TS-Setup) email_from: '. $this->conf['email_from'];
			return $ret;
		}

		// restore settings
		$GLOBALS['TSFE']->config['config']['notification_email_urlmode'] = $oldSetting;

		return '';

	}
	/**
	 * This function checks the hash from link and checks the validity. If it's valid it shows the form for
	 * changing the password and process the change of password after submit, if not valid it returns the error message
	 *
	 * @param	int		$uid: ...
	 * @param	string		$piHash: ...
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
			$markerArray['###STATUS_MESSAGE###'] = 'ERROR' . $this->getDisplayText('change_password_notvalid_message',
					$this->conf['changePasswordNotValidMessage_stdWrap.']);
			$subpartArray['###CHANGEPASSWORD_FORM###'] = '';
		} else {
			$user = $this->pi_getRecord('fe_users', intval($uid));
			$userHash = $user['felogin_forgotHash'];
			$compareHash = explode('|', $userHash);

			if (!$compareHash || !$compareHash[1] || $compareHash[0] < time() || $hash[0] != $compareHash[0] || md5($hash[1]) != $compareHash[1]) {
				$markerArray['###STATUS_MESSAGE###'] = 'ERROR' . $this->getDisplayText('change_password_notvalid_message',
						$this->conf['changePasswordNotValidMessage_stdWrap.']);
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
					$errpassword1 = sprintf($this->getDisplayText('change_password_tooshort_message',
							$this->conf['changePasswordTooShortMessage_stdWrap.']), $minLength);
					$errcount++;
				} elseif ($postData['password1'] != $postData['password2']) {
					$errpassword2 = sprintf($this->getDisplayText('change_password_notequal_message',
							$this->conf['changePasswordNotEqualMessage_stdWrap.']), $minLength);
					$errcount++;
				}

				if (strlen($postData['user']) < $minUserLength) {
					$erruser = sprintf($this->getDisplayText('new_user_tooshort_message', $this->conf['newUserTooShortMessage_stdWrap.']), $minUserLength);
					$errcount++;
				}

				if (trim($postData['signup_email']) == '') {
						$errsignup_email = sprintf($this->getDisplayText('new_user_email_required', $this->conf['newEmailTooShortMessage_stdWrap.']),
								trim($postData['signup_email']));
						$errcount++;
				} else {
					if (trim($postData['signup_email']) != '' && !t3lib_div::validEmail(trim($postData['signup_email']))) {
						$errsignup_email = sprintf($this->getDisplayText('error_invalid_email', $this->conf['newEmailInvalidMessage_stdWrap.']),
								trim($postData['signup_email']));
						$errcount++;
					}
				}

				if (trim($postData['firstname']) == '') {
					If (intval($this->conf['register.']['signupRequireFirstname'])==1) {
						$errfirstname = sprintf($this->getDisplayText('new_user_firstname_required', $this->conf['newUserFirstnameRequiredMessage_stdWrap.']),
								$minUserLength);
						$errcount++;
					}
				}
				if (trim($postData['lastname']) == '') {
					$errlastname =  sprintf($this->getDisplayText('new_user_lastname_required', $this->conf['newUserLastnameRequiredMessage_stdWrap.']),
							$minUserLength);
					$errcount++;
				}
				$captchaok = FALSE;

				if ($errcount>0) {
					$status_message[$smi] = sprintf($this->getDisplayText('signup_haderrors_message_error', $this->conf['newUserDataHasErrorsMessage_stdWrap.']),
							$errcount);
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
							$record['usergroup'] = $this->registerUserGroup();
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
			$markerArray['###STATUS_STYLE###'] = '';
			if ((count($status_message)>0) || ($postData['cpdone'] == '0')) {
				if ((count($status_message)>0)) {
					$markerArray['###STATUS_MESSAGESO###'] = $this->cObj->stdWrap(implode('<br />', $status_message), $this->conf['signupErrorMessage_stdWrap.']);
					$markerArray['###STATUS_STYLE###'] = ' tx-tc-alert';
				} else {
					$markerArray['###STATUS_MESSAGESO###'] = $this->getDisplayText('title_captcha', $this->conf['signupHeader_stdWrap.']);
					$shwcap = TRUE;
				}

			} else {
				if ($this->logintype == 'signup') {
					if (intval($this->conf['register.']['signupConfirmEmail']) != 1) {
						if (intval($this->conf['register.']['signupAdminConfirmation']) == 1) {
							$markerArray['###STATUS_STYLE###'] = ' tx-tc-information';
							$markerArray['###STATUS_MESSAGESO###'] = '<span class="tx-tc-nodisp">SIGNUPANDCONFIRM</span>';
							$markerArray['###STATUS_MESSAGESO###'] .= $this->cObj->stdWrap($this->pi_getLL('ll_signupOk_AdminConfirmation', '', 1),
									$this->conf['signupOkMessage_stdWrap.']);
						} else {
							$markerArray['###STATUS_MESSAGESO###'] = '<span class="tx-tc-nodisp">SIGNUPANDLOGINOK</span>';
							$markerArray['###STATUS_MESSAGESO###'] .= $this->cObj->stdWrap($this->pi_getLL('ll_signupOk_message', '', 1),
									$this->conf['signupOkMessage_stdWrap.']);
						}

					} else {
						$markerArray['###STATUS_MESSAGESO###'] = '<span class="tx-tc-nodisp">SIGNUPANDCONFIRM</span>';
						$markerArray['###STATUS_STYLE###'] = ' tx-tc-information';

						if (intval($this->conf['register.']['signupAdminConfirmation']) == 1) {
							$markerArray['###STATUS_MESSAGESO###'] .= $this->cObj->stdWrap($this->pi_getLL('ll_signupOk_messageconfirmAndAdminConfirmation', '', 1),
									$this->conf['signupOkMessage_stdWrap.']);
						} else {
							$markerArray['###STATUS_MESSAGESO###'] .= $this->cObj->stdWrap($this->pi_getLL('ll_signupOk_messageconfirm', '', 1),
									$this->conf['signupOkMessage_stdWrap.']);
						}
						// send confirmation mail
						// generate hash
						$hash = md5($this->generatePassword(3));
						// set hash in feuser session
						$GLOBALS['TSFE']->fe_user->setKey('ses', 'forgot_hash', array('forgot_hash' => $hash));

						$postedHash = $hash;
						$hashData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'forgot_hash');

						if ($postedHash === $hashData['forgot_hash']) {
							$row = FALSE;

							// look for user record
							$data = $GLOBALS['TYPO3_DB']->fullQuoteStr($postData['forgot_email'], 'fe_users');
							$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
									'uid, username, password, email',
									'fe_users',
									'(email="' . $postData['signup_email'] .'") AND pid IN ('.$GLOBALS['TYPO3_DB']->cleanIntList($this->spid).') '.
									$this->cObj->enableFields('fe_users')
							);

							if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
								$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
							}

							$error = NULL;
							if ($row) {
								// generate an email with the hashed link
								$error = $this->generateAndSendHash($row);
							}

						}

					}

					if (intval($this->conf['register.']['signupAdminConfirmation']) == 1) {
						// set new user to hidden
						$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
								'uid, username, first_name, last_name, email',
								'fe_users',
								'(email="' . $postData['signup_email'] .'") AND pid IN ('.$GLOBALS['TYPO3_DB']->cleanIntList($this->spid).') '.
								$this->cObj->enableFields('fe_users')
						);

						if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
							$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
						}

						if ($row) {
							require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));
							if (!$this->lib) {
								$this->lib = new toctoc_comment_lib;
							}
							$confpi1 = array();
							$confpi1 = $this->lib->getDefaultConfig('tx_toctoccomments_pi1');
							$requrl = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
							$langajax = $GLOBALS['TSFE']->lang;
 							$this->lib->sendNotificationEmail($row['uid'], 0, 0, 'adminconfirmsignup', $confpi1, $this, FALSE, $row, $GLOBALS['TSFE']->id,
 									$GLOBALS['TSFE']->page['title'], $requrl, 0, '', 0, $langajax);

							$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('fe_users', '(email="' . $postData['signup_email'] .
									'") AND pid IN ('.$GLOBALS['TYPO3_DB']->cleanIntList($this->spid).') '.
										$this->cObj->enableFields('fe_users'), array('disable' => 1));
							// send mail to admin
						}
					}

					$done = TRUE;
					$subpartArray['###SIGNON_FORM###'] = '';
				} else {
					$markerArray['###STATUS_MESSAGESO###'] = $this->getDisplayText('signup_header', $this->conf['signupHeader_stdWrap.']);
				}
			}
			$markerArray['###BACKLINK_SIGNON###'] = $this->pi_getLL('ll_forgot_header_backToLogin', '', 1);

			$passwordcss = '';
			$postDatapassword1 = $postData['password1'];
			$postDatapassword2 = $postData['password2'];
			$Datapassword1 = '';
			$Datapassword2 = '';
			if (intval($this->conf['register.']['signupConfirmEmail']) == 1) {
			 	$passwordcss = ' tx-tc-nodisp';
			 	$hash = md5($this->generatePassword(3));
			 	$Datapassword1 = $hash;
			 	$Datapassword2 = $hash;
			 }

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
				$markerArray['###CSSPWDCF###'] = $passwordcss;
				$markerArray['###NEWUSER###'] = $this->prefixId . '[user]';
				$markerArray['###NEWFIRSTNAME###'] = $this->prefixId . '[firstname]';
				$markerArray['###NEWLASTNAME###'] = $this->prefixId . '[lastname]';
				$markerArray['###NEWEMAIL###'] = $this->prefixId . '[signup_email]';
				if ($this->logintype == 'signup') {
					$markerArray['###NEWPASSWORD1V###'] = $postDatapassword1;
					$markerArray['###NEWPASSWORD2V###'] = $postDatapassword2;
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
					$markerArray['###NEWPASSWORD1V###'] = $Datapassword1;
					$markerArray['###NEWPASSWORD2V###'] = $Datapassword2;
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
		} elseif (($captchaType == 2) || ($captchaType == 1))  {

			$retstr = '<span class="tx-tc-required-error">' . $this->pi_getLL('enter_captcha_errornotloaded', '', 1) . '</span>';
			return $retstr;
		} elseif ($captchaType == 3) {
			require_once(t3lib_extMgm::extPath('toctoc_comments') . 'pi1/class.toctoc_comments_captcha.php');
			$freeCap = t3lib_div::makeInstance('toctoc_comments_captcha');
			require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));
			if (!$this->lib) {
				$this->lib = new toctoc_comment_lib;
			}
			$confpi1 = array();
			$confpi1 = $this->lib->getDefaultConfig('tx_toctoccomments_pi1');

			$captchaSubType = intval($confpi1['spamProtect.']['useCaptcha']);
			$template = $this->cObj->getSubpart($this->template, '###SIGNUP_CAPTCHA###');
			$AJAXDATACONF='';

			if ($captchaSubType == 1) {
				$AJAXDATACONF='&srcbcc=' . trim(str_replace(' ', '', $confpi1['spamProtect.']['freecapBackgoundcolor'])) .
											'&srctc=' . trim(str_replace(' ', '', $confpi1['spamProtect.']['freecapTextcolor'])) .
											'&srcnbc=' . trim(str_replace(' ', '', $confpi1['spamProtect.']['freecapNumberchars'])) .
											'&srch=' . trim(str_replace(' ', '', $confpi1['spamProtect.']['freecapHeight'])) . '&mtm=' .
											(10*round(microtime(TRUE), 1));
				$cantread = ' <img class="tx-tc-cap-image-rf tx-tc-cap-image-rf-mrg" id="toctoc_comments_caprefresh_txtccommentssignup_ctp1__0'.$AJAXDATACONF.
					'" src="'.$this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments').
					'res/css/themes/' . $confpi1['theme.']['selectedTheme'] . '/img/refresh.png"
	        		width="25" title="'.htmlspecialchars($this->pi_getLL('captcha_cant_read', '', 1)).'" />';
			} else {
				$cantread = '<div class="cap-action">
				                <img class="tx-tc-cap-image-rf" id="toctoc_comments_caprefresh_txtccommentssignup_ctp2" src="'.$this->locationHeaderUrlsubDir() .
				                t3lib_extMgm::siteRelPath('toctoc_comments').
				                'res/css/themes/' . $confpi1['theme.']['selectedTheme'] . '/img'.
				                '/rcrefresh.jpg" width="16" title="'.htmlspecialchars($this->pi_getLL('captcha_cant_read', '', 1)).'" />
				            </div>';
			}

			$markerArray = array(
					'###SR_FREECAP_IMAGE###' => '<img id="toctoc_comments_cap_txtccommentssignup" src="index.php?eID=toctoc_comments_ajax&cmd=getcap&captchatype='.
					$captchaSubType.'&cid=txtccommentssignup' . $AJAXDATACONF . '" alt="" />',
					'###SR_FREECAP_CANT_READ###' => $cantread,
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $errcp,
					'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_CAPTCHA###' =>  $this->pi_getLL('enter_captcha', '', 1),
					'###NEWCAPTCHAV###' => $cpval,
			);
			$code = $this->cObj->substituteMarkerArrayCached($template, $markerArray, $subpartArray, $linkpartArray);
			$retstr = str_replace('<br /><br />', '<br />', $code);
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

			$sessionFile = str_replace(DIRECTORY_SEPARATOR . 'pi2', DIRECTORY_SEPARATOR . 'pi1', realpath(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'sessionpath.tmp';
			$sessionSavePath =  @file_get_contents($sessionFile);
			$sessionTimeout = 3*1440;
			if (!(isset($commonObj))) {
				require_once (str_replace(DIRECTORY_SEPARATOR . 'pi2', DIRECTORY_SEPARATOR . 'pi1', realpath(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'class.toctoc_comments_common.php');
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

		} elseif ($captchaType == 3) {

			require_once(t3lib_extMgm::extPath('toctoc_comments') . 'pi1/class.toctoc_comments_captcha.php');
			$freeCap = t3lib_div::makeInstance('toctoc_comments_captcha');
			if (!$freeCap->chkcaptcha('txtccommentssignup', $postData['captcha'], TRUE)) {
				$err = $this->pi_getLL('error_wrong_captcha', '', 1);
			}

		}else {
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
		if ($this->fberror != 'waitconfirm') {
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
	}

	/**
	 * inserts or updates the facebook values to table fe_users
	 *
	 * @param	array		$facebookUserProfile: UserProfile
	 * @param	string		$socialnetwork: facebook or google
	 * @return	[type]		...
	 */
	protected function storeUser($facebookUserProfile, $socialnetwork) {

		$this->fe_usersValues['pid'] = $this->conf['storagePid'];
		// username should be a unique, random string that should never be used with any registration
		$username = $socialnetwork . $facebookUserProfile['id'] . '.' . t3lib_div::getRandomHexString(12);

		$where = 'tx_toctoc_comments_facebook_id=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($facebookUserProfile['id'], $this->tableName) .
		' AND deleted=0';

		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->tableName, $where, '', '', 1);

		$userFound = ($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0)?TRUE:FALSE;
		require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));
		if (!$this->lib) {
			$this->lib = new toctoc_comment_lib;
		}
		$confpi1 = array();
		$confpi1 = $this->lib->getDefaultConfig('tx_toctoccomments_pi1');

		$fldimage = 'image';
		if ($confpi1['advanced.']['FeUserDbField']) {
			$fldimage = $confpi1['advanced.']['FeUserDbField'];
		}

		if (version_compare(TYPO3_version, '8.2', '>')) {
			$this->conf['facebook.']['imageDir'] = 'fileadmin/user_upload/';
		}

		if($userFound == TRUE) {
			$user = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result);
			$username = $user['username'];
			if(($user['tx_toctoc_comments_facebook_updated_time'] != '') && ($user['tx_toctoc_comments_facebook_updated_time'] != $user['tstamp'])) {

				if(!($facebookUserProfile['updated_time'] instanceof DateTime)) {
					$facebookUserProfileupdated_time = trim($facebookUserProfile['updated_time']);
				} else {
					$facebookUserProfileupdated_time = $facebookUserProfile['updated_time']->getTimestamp();
				}

				if($facebookUserProfileupdated_time == '') {
					$facebookUserProfileupdated_time = $user['tstamp'];
				}

				if($user['tx_toctoc_comments_facebook_updated_time'] == $facebookUserProfileupdated_time) {
					if ($user['disable'] != 0) {
						$this->fberror = 'waitconfirm';
					}
					/* no update needed since facebook profile was not updated */
					return;
				}

			}

			if (version_compare(TYPO3_version, '8.2', '>')) {
				$currentuserimage = '';
				if (intval($user[$fldimage]) != 0) {
					$querysys_file_reference = 'SELECT uid_local FROM sys_file_reference WHERE tablenames = "fe_users" AND deleted=0 and hidden=0 and uid_foreign=' . $user['uid'] . ' AND sorting_foreign=1 AND fieldname="' . $fldimage .'"';
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
					$currentstorage = '';
					if ($storage != 0) {
						$querysys_storage = 'SELECT configuration FROM sys_file_storage where uid=' . $storage;
						$resultsys_storage= $GLOBALS['TYPO3_DB']->sql_query($querysys_storage);
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
						$FileNameIdentifier = $currentuserimage;
						$arrimg = explode('/', $currentuserimage);
						$currentuserimagename = array_pop($arrimg);
						$FeUserImagePath = implode('/', $arrimg);
						$FeUserImagePath = $currentstorage . $FeUserImagePath . '/';
						$confpi1['advanced.']['FeUserImagePath'] = $FeUserImagePath;

					}

				}

			}

		}

		$imageurl='';
		if($socialnetwork=='google') {
			$imageurl=$facebookUserProfile['imageurl'];
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
			if ($fe_usersValues['tx_toctoc_comments_facebook_gender'] == 'female') {
				$fe_usersValues['gender'] = 1;
			}

		}

		if(isset($facebookUserProfile['email'])) {
			$fe_usersValues['tx_toctoc_comments_facebook_email'] = $facebookUserProfile['email'];
			$fe_usersValues['email'] = $facebookUserProfile['email'];
		}

		if(!($facebookUserProfile['updated_time'] instanceof DateTime)) {
		 	$fe_usersValues['tx_toctoc_comments_facebook_updated_time'] = trim($facebookUserProfile['updated_time']);
		} else {
		 	$fe_usersValues['tx_toctoc_comments_facebook_updated_time'] = $facebookUserProfile['updated_time']->getTimestamp();
		}

		$fe_usersValuesfacebook_updated_time = $fe_usersValues['tx_toctoc_comments_facebook_updated_time'];
		if ($fe_usersValues['tx_toctoc_comments_facebook_updated_time'] == '') {
			if (isset($facebookUserProfile['etag']) == TRUE) {
				if (trim($facebookUserProfile['etag']) != '') {
					$fe_usersValuesfacebook_updated_time = md5($facebookUserProfile['etag']);
				} else {
					$fe_usersValuesfacebook_updated_time = $user['tstamp'];
				}

			} else {
				$fe_usersValuesfacebook_updated_time = $user['tstamp'];
			}

			$fe_usersValues['tx_toctoc_comments_facebook_updated_time'] = $user['tstamp'];
		}

		$fe_usersValues['pid'] = $this->conf['storagePid'];
		$imagename = '';
		$imagename = $this->copyImageFromFacebook($facebookUserProfile['id'], $imageurl, $socialnetwork, $fe_usersValuesfacebook_updated_time);
		if ($this->gotnewpic == FALSE) {
			$sameimage = TRUE;
			if (version_compare(TYPO3_version, '8.2', '>')) {
				$fe_usersValues[$fldimage] = $user[$fldimage];
			}
		} else {
			$sameimage = FALSE;
			if (version_compare(TYPO3_version, '8.2', '>')) {
				$fe_usersValues[$fldimage] = $user[$fldimage] + 1;
			}

		}

		$addSysFileMsg = '';
		if (version_compare(TYPO3_version, '8.3', '<')) {
			$fe_usersValues[$fldimage] = $imagename;
		}

		if ($userFound == TRUE) {
			$userId = $user['uid'];
			if ($user['disable'] == 1) {
				$this->fberror = 'waitconfirm';
			}

			$updateWhere = 'uid=' . $user['uid'];
			$userId = $user['uid'];
			$makeUpdate = FALSE;
			foreach($fe_usersValues as $newkey => $newval){
				if (isset($user[$newkey])) {
					if (($newkey != 'tstamp') && ($newkey != 'tx_toctoc_comments_facebook_updated_time') && ($newkey != 'lastlogin')) {
						if ($user[$newkey] != $newval) {
							$makeUpdate = TRUE;
							break;
						}

					}

				}

			}

			if ($makeUpdate == TRUE) {
				$fe_usersValues['tx_toctoc_comments_facebook_updated_time'] = time();
				$GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->tableName, $updateWhere, $fe_usersValues);
			}

		} else {
			$fe_usersValues['tx_toctoc_comments_facebook_id'] = $facebookUserProfile['id'];
			$fe_usersValues['usergroup'] = $this->registerUserGroup();
			$fe_usersValues['password'] = t3lib_div::getRandomHexString(32);
			$fe_usersValues['crdate'] = time();
			$fe_usersValues['tx_toctoc_comments_facebook_updated_time'] = time();
			$fe_usersValues['disable'] = intval($this->conf['register.']['signupAdminConfirmation']);
			$GLOBALS['TYPO3_DB']->exec_INSERTquery($this->tableName, $fe_usersValues);

			$userId = $GLOBALS['TYPO3_DB']->sql_insert_id();
			if (intval($this->conf['register.']['signupAdminConfirmation']) == 1) {
				$this->fberror = 'waitconfirm';
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
						'uid, username, first_name, last_name, email',
						'fe_users',
						'(uid=' . $userId .')'
				);

				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
					$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				}

				if ($row) {
					$requrl = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
					$langajax = $GLOBALS['TSFE']->lang;
					$this->lib->sendNotificationEmail($row['uid'], 0, 0, 'adminconfirmsignup', $confpi1, $this, TRUE, $row, $GLOBALS['TSFE']->id,
							$GLOBALS['TSFE']->page['title'], $requrl, 0, '', 0, $langajax);
				}

			}

		}

		if (version_compare(TYPO3_version, '8.2', '>')) {
			$confpi1['advanced.']['FeUserImagePath'] = $this->conf['facebook.']['imageDir'];
			if ($this->gotnewpic == TRUE) {
				if ($currentuserimage == '') {
					$FileNameIdentifier = 'user_upload/' . $imagename;
					$currentstorage = 'fileadmin';
				}

				$addSysFileMsg = $this->addSysFile($imagename, $FileNameIdentifier, $currentstorage . '/', $confpi1['advanced.']['FeUserImagePath'],
						$userId, $this->conf['storagePid'], $confpi1['advanced.']['FeUserDbField']);
			}

		}

 		if ($imagename != '') {
 			// and add $fe_usersValues['image'] to the $_SESSION['AJAXimages']
			$commentuserimagepath = $confpi1['advanced.']['FeUserImagePath'];
			$userimagesize = $this->usrimagesize;
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
			$commentuserimageout = $commentuserimagepath . $fe_usersValues[$fldimage];
			if ($confpi1['advanced.']['dontuseGIFBUILDER'] == 1) {
				if (!(isset($this->commonObj))) {
					require_once (str_replace(DIRECTORY_SEPARATOR . 'pi2', DIRECTORY_SEPARATOR . 'pi1', realpath(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'class.toctoc_comments_common.php');
					$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
				}

				$picpath = '';
				$picname = '';
				$commentuserimageoutarr = explode('/', $commentuserimageout);
				$picname = $commentuserimageoutarr[(count($commentuserimageoutarr)-1)];
				$picpath = str_replace($picname, '', $commentuserimageout);
				$tmpimglink = $this->commonObj->substGifbuilder($picpath, $picname, $userimagesize);
				$tmpimgstr = '<img src="' . $tmpimglink . '" class="' . $profileimgclass . $classonline . $userimagestyle .
				'" title="'. $usernametitle . '"  id="tx-tc-cts-img-" />';
	 		} else {
			 	$img = array();
				$img['file'] = GIFBUILDER;
				$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
				$img['file.']['10'] = IMAGE;
				$img['file.']['10.']['file'] = $commentuserimageout;
				$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
				$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
				$img['params'] = 'class="'.$profileimgclass . $classonline . $userimagestyle . '" title="'. $usernametitle .
				'"  id="tx-tc-cts-img-"';
				if (version_compare(TYPO3_version, '7.6', '<')) {
					$tmpimgstr = $this->cObj->IMAGE($img);
				} else {
					$tmpimgstr = $this->cObj->cObjGetSingle('IMAGE', $img);
				}
	 		}

			$_SESSION['AJAXimages'][$userId] = $tmpimgstr;
			$_SESSION['AJAXimagesrefresh'] = TRUE;
			$_SESSION['AJAXimagesrefreshImage'] = $fe_usersValues[$fldimage];
			$_SESSION['AJAXimagesTimeStamp'] = microtime(TRUE);
			$GLOBALS['TYPO3_DB']->sql_query('DELETE FROM tx_toctoc_comments_cachereport
					WHERE (ReportPluginMode = 11) OR (ReportPluginMode = 0 AND ReportUser ="' . $userId . '")');
			$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET tstamp =' . time() . ' WHERE external_ref_uid != "tx_toctoc_comments_feuser_mm_0"');
 		}

	}
	/**
	 * checks conf['register.']['usergroup'], handles missing usergroup and adjusts conf['register.']['usergroup'] to correct usergroup
	 *
	 * @return	string		$conf['register.']['usergroup']
	 */
	private function registerUserGroup() {
		// check if $this->conf['register.']['usergroup'] exists, if not handle it
		$firstugarr= explode(',', $this->conf['register.']['usergroup']);
		if (count($firstugarr)>1) {
			$usergroupsql=trim($firstugarr[0]);
		} else {
			$usergroupsql=$this->conf['register.']['usergroup'];
		}
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid',
				'fe_groups',
				'uid=' . $usergroupsql . ' AND pid = ' . $this->conf['storagePid'] . ' ' .
				$this->cObj->enableFields('fe_groups')
		);
		$row=array();
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
			$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		}

		if (count($row) == 0) {
			// not good, user group does not exists like specified in config
			// but could have been created under another uid in the right pid, so lets check if usergroup with title "toctoc_comments" exists
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'uid',
					'fe_groups',
					'title="toctoc_comments" AND pid = ' . $this->conf['storagePid'] . ' ' .
					$this->cObj->enableFields('fe_groups')
			);
			$row=array();
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res)) {
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
			}

			if (count($row)>0) {
				if (count($row[0])>0) {
					$this->conf['register.']['usergroup'] = $row[0]['uid'];
				} else {
					$this->conf['register.']['usergroup'] = $row['uid'];
				}
			} else {
				// no usable usergroup, we create usergroup with title "toctoc_comments"
				$userId = 0;
				$record=array();
				$record['crdate'] = $record['tstamp'] = time();
				$record['title'] = 'toctoc_comments';
				$record['description'] = 'Usergroup automatically created by extension toctoc_comments';
				$record['pid'] = $this->conf['storagePid'];
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('fe_groups', $record);
				$this->conf['register.']['usergroup'] = $GLOBALS['TYPO3_DB']->sql_insert_id();
			}
		}
		return $this->conf['register.']['usergroup'];
	}
	/**
	 * copy Image from Facebook
	 *
	 * @param	string		$facebookUserId: url to fetch
	 * @param	[type]		$url: ...
	 * @param	[type]		$socialnetwork: ...
	 * @param	[type]		$facebook_updated_time: ...
	 * @return	string		$imgname
	 */
	private function copyImageFromFacebook($facebookUserId, $url, $socialnetwork, $facebook_updated_time) {
		$imageUrl = 'http://graph.facebook.com/' . $facebookUserId. '/picture?width=300&height=300';
		if ($url !='') {
			$imageUrl =$url;
		}
		$this->gotnewpic = FALSE;
		$fileNameExists = '';
		if (file_exists(PATH_site . $this->conf['facebook.']['imageDir'] . $socialnetwork . $facebookUserId . $facebook_updated_time . '.jpg')) {
			$fileNameExists = $socialnetwork . $facebookUserId  . $facebook_updated_time .  '.jpg';
		} elseif (file_exists(PATH_site . $this->conf['facebook.']['imageDir'] . $socialnetwork . $facebookUserId . $facebook_updated_time . '.png')) {
			$fileNameExists = $socialnetwork . $facebookUserId  . $facebook_updated_time .  '.png';
		} elseif (file_exists(PATH_site . $this->conf['facebook.']['imageDir'] . $socialnetwork . $facebookUserId . $facebook_updated_time . '.bmp')) {
			$fileNameExists = $socialnetwork . $facebookUserId  . $facebook_updated_time .  '.bmp';
		} elseif (file_exists(PATH_site . $this->conf['facebook.']['imageDir'] . $socialnetwork . $facebookUserId . $facebook_updated_time . '.gif')) {
			$fileNameExists = $socialnetwork . $facebookUserId  . $facebook_updated_time .  '.gif';
		}

		if ($fileNameExists == '') {
			$fileName = $socialnetwork . $facebookUserId . $facebook_updated_time . '.jpg';

			$savepathfilename = $this->file_get_contents_curl($imageUrl, 'jpg', PATH_site . $this->conf['facebook.']['imageDir'] . $fileName);
			$this->gotnewpic = TRUE;
			$ret = str_replace(PATH_site . $this->conf['facebook.']['imageDir'], '', $savepathfilename);
		} else {
			$ret = $fileNameExists;
		}

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

		$toctoccommentsuseragent = 'TocTocCommentsExternalhit/1.1 (+https://www.toctoc.ch/en/home/toctoc-comments/)';
		curl_setopt($ch, CURLOPT_USERAGENT, toctoccommentsuseragent);
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
				} elseif ($ext == 'gif') {
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
	/**
	 * Retrieves current IP address
	 *
	 * @return	string		Current IP address
	 */
	protected function getCurrentIp() {
		$ret = t3lib_div::getIndpEnv('REMOTE_ADDR');
		return $ret;
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
		// print_r($GLOBALS['TCA']);exit;
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
							$GLOBALS['TYPO3_CONF_VARS'], $pageId, ''
					);
				} else {
					$frontend = t3lib_div::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], $pageId, '');
				}
				$GLOBALS['TSFE'] = & $frontend;
				//       // Get linkVars, absRefPrefix, etc
				if (version_compare(TYPO3_version, '6.0.99', '>')) {
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
	 * Initializes TSFE and sets $GLOBALS['TSFE']
	 *
	 * @return	void
	 */
	protected function addSysFile($FileName, $FileNameIdentifier, $currentstorage, $advancedFeUserImagePath,
			$useruid, $feuserstoragefolder, $imagefield) {
		//echo '1 $FileName -' . $FileName . '2 $FileNameIdentifier -' . $FileNameIdentifier . '3 $currentstorage -' . $currentstorage . '4 $advancedFeUserImagePath -' . $advancedFeUserImagePath . '<br>\n' .
			//'5 $useruid -' . $useruid . '6 $feuserstoragefolder -' . $feuserstoragefolder . '7 $imagefield -' . $imagefield;die();

		$content = '';
		// get id of currentstorage
		$querysys_storage = 'SELECT uid FROM sys_file_storage where configuration LIKE "%>' . $currentstorage . '<%"';
		$resultsys_storage= $GLOBALS['TYPO3_DB']->sql_query($querysys_storage);
		$currentstorageuid = 0;
		while ($rowssys_storage = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultsys_storage)) {
			$currentstorageuid = $rowssys_storage['uid'];
			break;
		}

		//Index the file

		$filePath = $advancedFeUserImagePath . $FileName; // path relative to TYPO3 root
		$fileObject = TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->retrieveFileOrFolderObject($filePath);

		if ($fileObject) {

			$someFileIdentifier = $currentstorageuid . ':/' . $FileNameIdentifier;
			$fac = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory'); // create instance to storage repository
			$file = $fac->getFileObjectFromCombinedIdentifier($someFileIdentifier);

			if ($file) {
				$data = array(
						'uid_local'   => $file->getUid(),
						'sorting_foreign' => 1,
						'tablenames'  => 'fe_users',
						'tstamp' => time(),
						'crdate' => time(),
						'cruser_id' => 1,
						'sorting' => 128,
						'pid'    => $feuserstoragefolder,
						'uid_foreign' => $useruid, // uid of your fe_user record
						'fieldname'   => $imagefield,
						'table_local' => 'sys_file',
						'sorting_foreign' => 1,
				);
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_file_reference', $data);
				$content .= 'image ok <br>';

			} else {
				$content .= '$file not ok '. $currentstorageuid . ':/' . $FileNameIdentifier;
			}
		} else {
			$content .= '$fileObject not ok '. $filePath;
		}

		return $content;

	}
}
?>