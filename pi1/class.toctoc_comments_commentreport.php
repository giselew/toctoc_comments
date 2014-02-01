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
 * class.toctoc_comments_commentreport.php
 *
 * AJAX Social Network Components
 * Report comments functions
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 *
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   61: class toctoc_comments_commentreport extends toctoc_comment_lib
 *   72:     public function generateReport ($content, $conf, $pObj, $piVars)
 *   96:     protected function processReportForm(array &$errors, $conf, $pObj, $piVars)
 *  242:     protected function showReportThanks($pObj)
 *  257:     protected function showReportForm(array $errors, $conf, $pObj, $piVars)
 *  347:     protected function getReportCaptcha($required, $error, $conf, $pObj)
 *
 * TOTAL FUNCTIONS: 5
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
class toctoc_comments_commentreport extends toctoc_comment_lib {

	/**
	 * The main method of the PlugIn-instance comment reporting
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$piVars: ...
	 * @return	string		The content that is displayed on the website
	 */
	public function generateReport ($content, $conf, $pObj, $piVars) {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');

		$errors = array();
		if (!$this->processReportForm($errors, $conf, $pObj, $piVars)) {
			$content = $this->showReportForm($errors, $conf, $pObj, $piVars);
		} else {
			$content = $this->showReportThanks($pObj);
		}

		$retstr = $this->pi_wrapInBaseClass($content);
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
	protected function processReportForm(array &$errors, $conf, $pObj, $piVars) {
		$fromAjax=FALSE;
		if ($piVars['submit']) {
			// Check captcha
			$captchaType = intval($conf['commentsreport.']['useCaptcha']);
			if ($captchaType == 1 && t3lib_extMgm::isLoaded('captcha')) {
				session_name('sess_' . $pObj->extKey);
				@session_start();
				$captchaStr = $_SESSION['tx_captcha_string'];
				$_SESSION['tx_captcha_string'] = '';
				if (!$captchaStr || $piVars['captcha'] !== $captchaStr) {
					$errors['captcha'] = $this->pi_getLLWrap($pObj, 'error.wrong.captcha', FALSE);

				}

			} elseif ($captchaType == 2 && t3lib_extMgm::isLoaded('sr_freecap')) {
				require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
				$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
				/* @var $freeCap tx_srfreecap_pi2 */
				if (!$freeCap->checkWord($piVars['captcha'])) {
					$errors['captcha'] = $this->pi_getLLWrap($pObj, 'error.wrong.captcha', FALSE);
				}

			}

			// Check required fields
			foreach (t3lib_div::trimExplode(',', $conf['commentsreport.']['requiredFields'], TRUE) as $field) {
				if (trim($piVars[$field]) == '') {
					$errors[$field] = $this->pi_getLLWrap($pObj, 'error.empty.field', FALSE);
				}

			}

			if ($piVars['frommail'] != '' && !t3lib_div::validEmail($piVars['frommail'])) {
				$errors['frommail'] = $this->pi_getLLWrap($pObj, 'error.invalid.email', FALSE);
			}

			if (substr($piVars['from'], 2, 10) !='') {
				if (stristr($piVars['text'], substr($piVars['from'], 2, 10)) != '') {
					$errors['from'] = $this->pi_getLLWrap($pObj, 'commentreport.error.required.fieldcorrect', FALSE);
				}

			}

			// Decode info
			$info = @unserialize(base64_decode($piVars['info']));
			if (!is_array($info)) {
				$errors['text'] = $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_info', FALSE);
			} else {
				// Get comment
				t3lib_div::loadTCA('tx_toctoc_comments_comments');
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
						'tx_toctoc_comments_comments',
						'uid=' . intval($info['uid']));
				if (count($rows) == 0) {
					$errors['text'] = $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_comment', FALSE);
				} else {
					$comment = $rows[0];
				}

			}

			// Process form
			if (count($errors) == 0) {

				if ($conf['HTMLEmail']) {
					$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['commentsreport.']['HTMLemailTemplateFile']);

				} else {
					$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['commentsreport.']['emailTemplateFile']);
				}

				$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
				if ($fromAjax) {
					$templateCode = @file_get_contents(PATH_site . $usetemplateFile);
				} else {
					$templateCode = $this->t3fileResource($pObj, $usetemplateFile);
				}

				$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
				$myhomepagelink=$myhomepagelinkarr[1];
				$infoleft='';
				$contentformail=$this->replaceBBs($comment['content'], $pObj, $conf, FALSE);
				$contentformail =$this->addleadingspace($contentformail);
				$saveconfemoji=$conf['advanced.']['useEmoji'];

				$conf['advanced.']['useEmoji']=0;
				$contentformail = $this->makeemoji($contentformail, $conf, 'processReportForm');

				$conf['advanced.']['useEmoji']=$saveconfemoji;

				$markerArray = array(
					'###URL###' => $info['url'],
					'###UID###' => $comment['uid'],
					'###FROM###' => $piVars['from'],
					'###FROMMAIL###' => $piVars['frommail'],
					'###USER_TEXT###' => $piVars['text'],
					'###COMMENT_TEXT###' => $contentformail,
					'###USER_IP###' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
					'###MYHOMEPAGE###'  => $myhomepagelink,
					'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###MYHOMEPAGELINK###'  => t3lib_div::locationHeaderUrl(''),
					'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
					'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					'###INFOSLEFT###'  => $infoleft,
					'###MESSAGETYPE###' => $this->pi_getLLWrap($pObj, 'commentreport.report_subject', FALSE),
					'###TXTINAPPRO###' => $this->pi_getLLWrap($pObj, 'commentreport.text_inappropriate', FALSE),
					'###TXTPAGE###' => $this->pi_getLLWrap($pObj, 'comments_recent.pages', FALSE),
					'###TXTFROM###' => $this->pi_getLLWrap($pObj, 'commentreport.text_sentby', FALSE),
					'###TEXT_FROMMAIL###' => $this->pi_getLLWrap($pObj, 'pi1_template.email', FALSE),
					'###TEXT_COMPLAINT###' => $this->pi_getLLWrap($pObj, 'commentreport.text_complaint', FALSE),
					'###TEXT_COMMENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.textcommentlink', FALSE),

				);

				$subject = str_replace('%s', $GLOBALS[GLOBALS][TYPO3_CONF_VARS][SYS][sitename].': '.$pageTitle, $this->pi_getLLWrap($pObj,
						'commentreport.report_subject', $fromAjax));
				$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - ' . $this->pi_getLLWrap($pObj, 'email.commentingsystem', $fromAjax);

				if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
					$content = $this->t3substituteMarkerArray($templateCode, $markerArray);

					self::send_mail($conf['commentsreport.']['destinationEmail'], $subject, '', $content, $conf['commentsreport.']['sourceEmail'], $sendername);

				} else {
					$template = $this->t3getSubpart($pObj, $templateCode, '###COMMENTS_RECIPENT_MAIL###');
					$mailContent = $this->t3substituteMarkerArray($template, $markerArray); // substitute markerArray for HTML content
					t3lib_div::plainMailEncoded($conf['commentsreport.']['destinationEmail'], $subject, $mailContent, 'From: ' .
					$conf['commentsreport.']['sourceEmail'] );
				}

				return TRUE;
			}

		}

		return FALSE;
	}

	/**
	 * Shows "thank you" message after text was submitted
	 *
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @return	string		HTML
	 */
	protected function showReportThanks($pObj) {
		$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###THANK_YOU###');
		$retstr = $this->t3substituteMarker($template, '###TEXT_THANKYOU###', $this->pi_getLLWrap($pObj, 'commentreport.text_thankyou', FALSE));
		return $retstr;
	}

	/**
	 * Shows Report Form for the complaints
	 *
	 * @param	array		$errors
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$piVars: ...
	 * @return	string		HTML
	 */
	protected function showReportForm(array $errors, $conf, $pObj, $piVars) {
		$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###REPORT_FORM###');
		$req_template = $this->t3getSubpart($pObj, $pObj->templateCode, '###REPORT_REQUIRED###');
		$error_template = $this->t3getSubpart($pObj, $pObj->templateCode, '###REPORT_ERROR###');

		$required = $this->t3substituteMarker($req_template, '###TEXT_REQUIRED###', $this->pi_getLLWrap($pObj, 'commentreport.text_required', FALSE));
		// Decode info
		$info = @unserialize(base64_decode($piVars['info']));
		if (!is_array($info)) {
			$complainedcomment= $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_info', FALSE);
		} else {
			// Get comment
			t3lib_div::loadTCA('tx_toctoc_comments_comments');
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_comments',
					'uid=' . intval($info['uid']));
			if (count($rows) == 0) {
				$complainedcomment= $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_comment', FALSE);
			} else {
				require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_recentcomments.php'));
				$librecentcomments = new toctoc_comments_recentcomments;

				$complainedcomment=$librecentcomments->comments_getRecentComments($rows, $conf, $pObj);
			}

		}

		$markers = array(
				'###ACTION###' => $this->pi_getPageLink($GLOBALS['TSFE']->id),
				'###INFO###' => $piVars['info'],
				'###FROM###' => htmlspecialchars($piVars['from']),
				'###FROMMAIL###' => htmlspecialchars($piVars['frommail']),
				'###ENCTEXT###' => base64_encode(htmlspecialchars($piVars['text'])),
				'###TEXT###' => htmlspecialchars($piVars['text']),
				'###TEXT_FROM###' => $this->pi_getLLWrap($pObj, 'commentreport.text_from', FALSE),
				'###TEXT_FROMMAIL###' => $this->pi_getLLWrap($pObj, 'pi1_template.email', FALSE),
				'###ENCTEXT_ADD_COMMENT###' => base64_encode($this->pi_getLLWrap($pObj, 'commentreport.text_text', FALSE)),
				'###TEXT_TEXT###' => $this->pi_getLLWrap($pObj, 'commentreport.text_text', FALSE),
				'###TEXT_SUBMIT###' => $this->pi_getLLWrap($pObj, 'pi1_template.submit', FALSE),
				'###ERROR_FROM###' => '',
				'###ERROR_FROMMAIL###' => '',
				'###ERROR_TEXT###' => '',
				'###REQUIRED_FROM###' => '',
				'###REQUIRED_FROMMAIL###' => '',
				'###REQUIRED_TEXT###' => '',
				'###CAPTCHA###' => '',
				'###CONTENT###' => htmlspecialchars($piVars['text']),
				'###TXTCONFIRM###' => $this->pi_getLLWrap($pObj, 'pi1_template.confirm', FALSE),
				'###TXTNO###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useno', FALSE),
				'###TXTYES###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useyes', FALSE),
				'###TXTOK###' => $this->pi_getLLWrap($pObj, 'pi1_template.ok', FALSE),
				'###TXTINFO###' => $this->pi_getLLWrap($pObj, 'pi1_template.information', FALSE),
				'###BADCOMMENT###' => 	$complainedcomment,
				'###TEXT_YOURCOMPLAINT###' => 	$this->pi_getLLWrap($pObj, 'pi1_template.textyourcomplaint', FALSE),
		);

		foreach ($errors as $field => $error) {
			if ($field != 'captcha') {
				$markers['###ERROR_' . strtoupper($field) . '###'] = $this->t3substituteMarker($error_template, '###TEXT###', htmlspecialchars($error));
			}

		}

		foreach (t3lib_div::trimExplode(',', $conf['commentsreport.']['requiredFields'], TRUE) as $field) {
			$markers['###REQUIRED_' . strtoupper($field) . '###'] = $required;
		}

		// Captcha
		if ($conf['commentsreport.']['useCaptcha']) {
			$error = '';
			if ($errors['captcha']) {
				$error = $this->t3substituteMarker($error_template, '###TEXT###', htmlspecialchars($errors['captcha']));
			}

			$markers['###CAPTCHA###'] = $this->getReportCaptcha($required, $error, $conf, $pObj);
		}

		$retstr = $this->t3substituteMarkerArray($template, $markers);
		return $retstr;
	}

	/**
	 * Adds captcha code if enabled.
	 *
	 * @param	string		$required
	 * @param	string		$error: Possible error text
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @return	string		Generated HTML
	 */
	protected function getReportCaptcha($required, $error, $conf, $pObj) {
		$captchaType = intval($conf['commentsreport.']['useCaptcha']);

		if (($captchaType == 1) && (t3lib_extMgm::isLoaded('captcha'))) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###REPORT_CAPTCHA###');
			$code = $this->t3substituteMarkerArray($template, array(
					'###SR_FREECAP_IMAGE###' => '<img src="' . t3lib_extMgm::siteRelPath('captcha') . 'captcha/captcha.php" alt="" />',
					'###SR_FREECAP_CANT_READ###' => '',
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $error,
					'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_CAPTCHA###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code', FALSE),
			));
			$retstr = str_replace('<br /><br />', '<br />', $code);
			return $retstr;

		} elseif (($captchaType == 2) && (t3lib_extMgm::isLoaded('sr_freecap'))) {
			require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
			$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
			/* @var $freeCap tx_srfreecap_pi2 */
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###REPORT_CAPTCHA###');
			$retstr = $this->t3substituteMarkerArray($template, array_merge($freeCap->makeCaptcha(), array(
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $error,
					'###TEXT_CAPTCHA###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code', FALSE),
			)));
			return $retstr;
		}

		return '';
	}


}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_commentreport.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_commentreport.php']);
}
?>