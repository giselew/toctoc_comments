<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2015 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *   56: class user_toctoc_comments_toctoc_comments
 *   68:     public function displayDonationMessage()
 *  199:     protected function checkSecret($secret)
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
}

if (version_compare(TYPO3_version, '6.3', '>')) {
			(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
			(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
			(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
}

/**
 * This class provides userfunctions used by toctoc_comments itself
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class user_toctoc_comments_toctoc_comments {

public $donExtkey = 'toctoccommentsce';
public $donExtension = 'toctoc_comments';
public $donExtversion = '929';
public $donationServer= 'www.toctoc.ch';

	/**
	 * This method returns the message's content
	 * HTML should be display as is
	 *
	 * @return	string		The HTML for the form field
	 */
	public function displayDonationMessage() {
		$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
		$tsSettings  =  unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		$langreq = 'en';
		if (strlen($GLOBALS['BE_USER']->uc['lang']) > 0) {
			$langreq = $GLOBALS['BE_USER']->uc['lang'];
		}

		if ($langreq == '') {
			$GLOBALS['LANG']->init('default');
		} else {
			$GLOBALS['LANG']->init($langreq);
		}

		if (!isset($_SESSION)) {
			session_name('sess_toctoccommentsfe');
			session_start();
			if (!isset($_SESSION['toctoc_commentsfedonation'])) {
				$_SESSION['toctoc_commentsfedonation']='';
				$_SESSION['toctoc_commentsfedonationdone']=0;
				$_SESSION['toctoc_commentsfedonationlang']=$langreq;
			}

		} else {
			if (!isset($_SESSION['toctoc_commentsfedonation'])) {
				session_write_close();
				session_name('sess_toctoccommentsfe');
				session_start();
			}
			
			if (!isset($_SESSION['toctoc_commentsfedonation'])) {
				$_SESSION['toctoc_commentsfedonation']='';
				$_SESSION['toctoc_commentsfedonationdone']=0;
				$_SESSION['toctoc_commentsfedonationlang']=$langreq;
			}

		}

		$datadonation = '';
		$secret='';		
		if (trim($tsSettings['donationServer']) != '') {
			$this->donationServer = trim($tsSettings['donationServer']);
		}
		
		if (trim($_SESSION['toctoccommentsfedonationsecret']) != '') {
			// secret from toctooccommmetts
			if ($tsSettings['donationSecret'] == '') {
				$tsSettings['donationSecret'] = $_SESSION['toctoccommentsfedonationsecret'];
				if ($_SESSION['toctoc_commentsfedonationsecret'] != $_SESSION['toctoccommentsfedonationsecret']) {
					$_SESSION['toctoc_commentsfedonation'] = '';
				}
				
			}
			
		}

		if ($_SESSION['toctoc_commentsfedonationlang'] != $langreq) {
			$_SESSION['toctoc_commentsfedonationlang'] = $langreq;
			$_SESSION['toctoc_commentsfedonation'] = '';

		}

		if ($tsSettings['donationSecret'] != '') {
			$secret= trim($tsSettings['donationSecret']);
			if ($_SESSION['toctoc_commentsfedonationsecret'] != $secret) {
				$_SESSION['toctoc_commentsfedonation'] = '';
				$_SESSION['toctoc_commentsfedonationdone'] = 0;
				$_SESSION['toctoc_commentsfedonationsecret'] = $secret;
			}

			$datadonation = $this->checkSecret($secret);
		} else {
			if ($_SESSION['toctoc_commentsfedonationsecret'] != 'dmy') {
				$_SESSION['toctoc_commentsfedonation'] = '';
				$_SESSION['toctoc_commentsfedonationdone'] = 0;
				$_SESSION['toctoc_commentsfedonationsecret'] = 'dmy';
			}

			$datadonation = $this->checkSecret('dmy');
		}

		$txtstatusdonation =  $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/locallang_cedb.xml:tx_toctoccommentscedonation.statusdonation');
		$txtoptionnotset =  $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/locallang_cedb.xml:tx_toctoccommentsdonation.optionnotset');
		$txtthanksforusing =  $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/locallang_cedb.xml:tx_toctoccommentscedonation.thanksforusing');

		$datadonationarr = explode('@', $datadonation);
		$datadonationretcode = '403';
		if (count($datadonationarr) > 1) {
			$datadonation = $datadonationarr[1];
			$datadonationintro = $datadonationarr[2];
			$datadonationoutro = $datadonationarr[3];
			$datadonationretcode = $datadonationarr[0];

			if (count($datadonationarr) > 4) {
				$datadonationarrauth = $datadonationarr[4];
				$autharr = explode(',', $datadonationarrauth);
				$dkcontent = $_SESSION['toctoc_commentsfedonationsecret'];

			}

		}

		if (intval($datadonationretcode) < 400) {
			$html = '<div class="tx-tc-donationmessage"><div style="display:table;"><span>' .
					$datadonationintro . $datadonation . $datadonationoutro .'</span></div></div>';
			$this->toctoccommentsfedonationdone=1;
		} else {
			if ($secret == '') {
				if (($datadonation == '') || ($_SESSION['toctoc_commentsfedonationsecret'] == 'dmy')) {
					$datadonation = $txtoptionnotset;
				} else {
					$datadonation .= '<br>' . $txtoptionnotset;
				}
				
			}

			$this->toctoccommentsfedonationdone=0;
			if (intval($datadonationretcode) == 403) {
				$html = '<div class="tx-tc-donationmessage"><div style="float:left;display: table;"><span>' .
				 $datadonationoutro . $txtstatusdonation . ': ' . $datadonation . '</span></div></div>';
			} else {
				$html = '<div class="tx-tc-donationmessage"><div style="float:left;display: table;"><span>' . $datadonationintro . '</span></div>
						<div style="display: table;"><span>'.$txtthanksforusing.' <i>toctoc_comments</i>.<br>
					' . $datadonationoutro . $txtstatusdonation . ': ' . $datadonation . '</span></div></div>';
			}

		}

		$_SESSION['toctoc_commentsfedonationdone']=$this->toctoccommentsfedonationdone;
		return $html;
	}

	/**
	 * checks the secret
	 *
	 * @param	secret
	 * @return	void
	 */
	protected function checkSecret($secret) {
		$data ='';
		$infomessage = '';
		$donationserver = $this->donationServer;
		if (trim($_SESSION['toctoc_commentsfedonation']) != '') {
			if ($_SESSION['toctoc_commentsfedonationdone']==1) {
				$this->toctoccommentsfedonationdone=1;
			}

			return $_SESSION['toctoc_commentsfedonation'];
		} else {
			if (!extension_loaded('curl')) {
				$infomessage = 'Curl, PHP-Problem: Curl extension is required!';
				$alertmsg = 1;
			} else {
				$curip = $_ENV['SERVER_ADDR'];
				$curipres = $_ENV['SERVER_NAME'];

				if (trim($curip) == '') {
					$curip = isset($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:gethostbyname(gethostname());
				}
				if (trim($curipres) == '') {
					$curipres = isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:gethostname();
				}

				if (trim($curip) == '') {
					$curip = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:gethostname();
				}

				if (trim($curip) == '') {
					$curip = gethostname();
				}

				$ch = curl_init();
				$langreq = 'en';
				if (strlen($GLOBALS['BE_USER']->uc['lang']) > 0) {
					$langreq = $GLOBALS['BE_USER']->uc['lang'];
				}

				$dataWhereuser = 'deleted=0';
				list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr',
						'tx_toctoc_comments_user', $dataWhereuser);
				$nbrusers = intval($rowusr['tusr']);
				$dataarr = array(
						'secret' => $secret,
						'remoteadr' => $curip,
						'lang' => $langreq,
						'extensionkey' => $this->donExtkey,
						'extension' => $this->donExtension,
						'version' => $this->donExtversion,
						'hostname' => $curipres,
						'typo3version' => TYPO3_version,
						'nbrusers' => $nbrusers,
				);

				$dataout = rawurlencode(base64_encode(serialize($dataarr)));
				$toctoccommentsuseragent = 'TocTocCommentsDonationsExternalhit/1.1 (+https://' . $donationserver . '/en/home/toctoc-comments/)';
				$urltofetch = 'https://' . $donationserver . '/index.php?eID=toctoc_donations&data=' . $dataout;
				curl_setopt($ch, CURLOPT_USERAGENT, toctoccommentsuseragent);
				curl_setopt($ch, CURLOPT_URL, $urltofetch);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FAILONERROR, 0);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
				curl_setopt($ch, CURLOPT_FILETIME, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_TRANSFERTEXT, 1);
				curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7);
				$data = curl_exec($ch);
				$curl_errno = curl_errno($ch);
				if ($curl_errno > 0) {
					$curl_errmsg =  curl_error($ch);
					curl_close($ch);
					$infomessage = 'Curl, error reading: ' . $curl_errmsg;
					$alertmsg = 1;
				} else {
					$infohttpcode = intval(curl_getinfo($ch, CURLINFO_HTTP_CODE));
					// checking mime types
					if ($infohttpcode < 400)  {
						curl_close($ch);
					} else {
						$infomessage = 'Curl, returned code ' . $infohttpcode . ' for URL: ' . $urltofetch;
						$alertmsg = 1;
						curl_close($ch);
					}
					
				}

			}

			if ((trim($data) == '') && (trim($infomessage) == '')) {
				$infomessage = 'Curl, tx_donations not installed on ' . $donationserver;
			}

			if (trim($data) != '') {
				$_SESSION['toctoc_commentsfedonation'] = $data;
				$ret = trim($data);
				return $ret;
			} else {
				$_SESSION['toctoc_commentsfedonation'] = $infomessage;
				return $infomessage;
			}

		}

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.user_toctoc_comments_toctoc_comments.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.user_toctoc_comments_toctoc_comments.php']);
}

?>