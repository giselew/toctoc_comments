<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *   55: class toctoc_comments_formview extends toctoc_comments_baseview
 *   85:     public function __construct(toctoc_comments_fecontroller &$controller)
 *   97:     public function render()
 *  159:     protected function getCaptca()
 *  179:     protected function getCaptchaFromCaptchaExt($subpart)
 *  197:     protected function getCaptchaFromSrFreeCap($subpart)
 *  217:     protected function wrapMissingFieldError($field)
 *
 * TOTAL FUNCTIONS: 6
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(t3lib_extMgm::extPath('toctoc_comments', 'view/class.toctoc_comments_baseview.php'));

/**
 * This class implements a form view for the comments extension. This class
 * only displays the form, it does not process form submissions. If you look
 * for submission code, look in ../controller/class.toctoc_comments_fecontroller.php
 * instead.
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comments_formview extends toctoc_comments_baseview {

	/**
	 * Form validation results (provided by a controller)
	 *
	 * @var	array
	 */
	protected $formValidationResults;

	/**
	 * An instance of Frontend controller class
	 *
	 * @var	toctoc_comments_fecontroller
	 */
	protected $controller;

	/**
	 * Language object
	 *
	 * @var	language
	 */
	protected $lang;

	/**
	 * Creates an instance of this class. This constructor is redefined to ensure
	 * that proper controller class is passed to it.
	 *
	 * @param	toctoc_comments_fecontroller		$controller	Controller
	 * @return	[type]		...
	 */
	public function __construct(toctoc_comments_fecontroller &$controller) {
		parent::__construct($controller);

		$this->lang = &$this->controller->getLang();
		$this->formValidationResults = $this->controller->getFormValidationResults();
	}

	/**
	 * Renders form for the comments extension
	 *
	 * @return	string		Generated HTML
	 */
	public function render() {
		$content = '';

		// Get subpart
		$subpart = $cObj->getSubpart($this->templateCode, '###COMMENT_FORM###');

		$url = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
		$currentComment = $this->controller->getSubmittedComment();
		/* @var $currentComment toctoc_comments_comment */
		$validationErrors = $currentComment->getValidationResults();
		$userIntMarker = '<input type="hidden" name="typo3_user_int" value="1" />';
		$markers = array(
			'###ACTION_URL###' => htmlspecialchars($url),
			'###CAPTCHA###' => $this->getCaptcha(),
			'###CONTENT###' => count($validationErrors) > 0 && $currentComment ? htmlspecialchars($currentComment->getContent()) : '',
			'###CURRENT_URL###' => htmlspecialchars($url),
			'###CURRENT_URL_CHK###' => md5($url . $cObj->data['uid'] . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']),
			'###EMAIL###' => htmlspecialchars($currentComment->getEmail()),
			'###ERROR_CONTENT###' => (isset($validationErrors['content']) ? htmlspecialchars($validationErrors['content']) : ''),
			'###ERROR_EMAIL###' => (isset($validationErrors['email']) ? htmlspecialchars($validationErrors['email']) : ''),
			'###ERROR_FIRSTNAME###' => (isset($validationErrors['firstname']) ? htmlspecialchars($validationErrors['firstname']) : ''),
			'###ERROR_HOMEPAGE###' => (isset($validationErrors['homepage']) ? htmlspecialchars($validationErrors['homepage']) : ''),
			'###ERROR_LASTNAME###' => (isset($validationErrors['lastname']) ? htmlspecialchars($validationErrors['lastname']) : ''),
			'###ERROR_IMAGE###' => (isset($validationErrors['image']) ? htmlspecialchars($validationErrors['image']) : ''),
			'###ERROR_LOCATION###' => (isset($validationErrors['location']) ? htmlspecialchars($validationErrors['location']) : ''),
			'###FIRSTNAME###' => $currentComment ? htmlspecialchars($currentComment->getFirstName()) : '',
			'###JS_USER_DATA###' => $userIntMarker . ($this->piVars['submit'] ? '' : '<script type="text/javascript">toctoc_comments_pi1_setUserData()</script>'),
			'###HOMEPAGE###' => $currentComment ? htmlspecialchars($currentComment->getHomePage()) : '',
			'###LASTNAME###' => $currentComment ? htmlspecialchars($currentComment->getLastName()) : '',
			'###CID###' => $currentComment ? htmlspecialchars($currentComment->getCID()) : '',
			'###LOCATION###' => $currentComment ? htmlspecialchars($currentComment->getLocation()) : '',
			'###TEXT_ADD_COMMENT###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.add_comment'),
			'###TEXT_ADD_COMMENTTOP###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.add_comment_top'),
			'###TEXT_ADD_COMMENTTITLE###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.add_comment_title'),
			'###TEXT_CONTENT###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.content'),
			'###TEXT_EMAIL###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.email'),
			'###TEXT_FIRST_NAME###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.first_name'),
			'###TEXT_LAST_NAME###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.last_name'),
			'###TEXT_IMAGE###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.image'),
			'###TEXT_LOCATION###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.location'),
			'###TEXT_REQUIRED_HINT###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.required_field'),
			'###TEXT_SUBMIT###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.submit'),
			'###TEXT_RESET###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.reset'),
			'###TEXT_WEB_SITE###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.web_site'),
			'###TEXT_DELETE_LINK###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.deletelink'),
			'###COMMENT_LINK_TEXT###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.textcommentlink'),
			'###TEXT_ERR_COMMENT_LENGTH###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.texterrorlength'),
			'###TEXT_ERR_COMMENT_NULL###' => $lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.texterrornull'),
			'###TOP_MESSAGE###' => '',
			'###ERRCODE###' => '',
		);

		$content = $cObj->substituteMarkerArray($subpart, $markers);

		return $content;
	}

	/**
	 * Obtains captcha code according to the configuration
	 *
	 * @return	string		Generated captcha HTML code
	 */
	protected function getCaptca() {
		$result = '';
		if ($this->conf['spamprotect.']['useCaptcha']) {
			$subpart = $this->cObj->getSubpart($this->templateCode, '###CAPTCHA_SUB###');
			if ($this->conf['spamprotect.']['useCaptcha'] == 1 && t3lib_extMgm::isLoaded('captcha')) {
				$result = $this->getCaptchaFromCaptchaExt($subpart);
			}
			elseif ($this->conf['spamprotect.']['useCaptcha'] == 2 && t3lib_extMgm::isLoaded('sr_freecap')) {
				$result = $this->getCaptchaFromSrFreeCap($subpart);
			}
		}
		return $result;
	}

	/**
	 * Obtains captcha from captcha extension
	 *
	 * @param	string		$subpart	Subpart
	 * @return	string		Generated HTML
	 */
	protected function getCaptchaFromCaptchaExt($subpart) {
		$code = $this->cObj->substituteMarkerArray($subpart, array(
						'###SR_FREECAP_IMAGE###' => '<img src="' . t3lib_extMgm::siteRelPath('captcha') . 'captcha/captcha.php" alt="" />',
						'###SR_FREECAP_CANT_READ###' => '',
						'###REQUIRED_CAPTCHA###' => $this->cObj->getSubpart($this->templateCode, '###REQUIRED_FIELD###'),
						'###ERROR_CAPTCHA###' => $this->wrapMissingFieldError('captcha'),
						'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('comments'),
						'###TEXT_ENTER_CODE###' => $this->lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.enter_code'),
					));
		return str_replace('<br /><br />', '<br />', $code);
	}

	/**
	 * Obtains captcha from captcha extension
	 *
	 * @param	string		$subpart	Subpart
	 * @return	string		Generated HTML
	 */
	protected function getCaptchaFromSrFreeCap($subpart) {
		require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
		$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
		/* @var $freeCap tx_srfreecap_pi2 */
		return $this->cObj->substituteMarkerArray($subpart, array_merge($freeCap->makeCaptcha(), array(
						'###REQUIRED_CAPTCHA###' => $this->cObj->getSubpart($this->templateCode, '###REQUIRED_FIELD###'),
						'###ERROR_CAPTCHA###' => $this->wrapMissingFieldError('captcha'),
						'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('comments'),
						'###TEXT_ENTER_CODE###' => $this->lang->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:pi1_template.enter_code'),
					)));
	}

	/**
	 * Wraps error message with the stdWrap. This happens if:
	 * - form was subbmitted
	 * - there are validation errors for the form field
	 *
	 * @param	string		$field	Field
	 * @return	string		HTML
	 */
	protected function wrapMissingFieldError($field) {
		$result = '';
		if (isset($this->formValidationResults[$field]) && $this->controller->isFormSubmitted()) {
			$result = $this->cObj->stdWrap(htmlspecialchars($this->formValidationResults[$field]),
				$this->conf['requiredFields_errorWrap.']);
		}
		return $result;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/view/class.toctoc_comments_formview.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/view/class.toctoc_comments_formview.php']);
}

?>