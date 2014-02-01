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
* class.toctoc_comments_pi1.php
*
* Comment management script.
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   61: class toctoc_comments_eID
 *   67:     function init()
 *  121:     function main()
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
require_once(PATH_site . 't3lib/class.t3lib_tcemain.php');
if (!version_compare(TYPO3_version, '4.6', '<')) {
	require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
}

/**
 * Comment management script.
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_eID {
	var $uid;
	var $command;
	var $conf;
	var $lang;

	function init() {
		$GLOBALS['LANG'] = t3lib_div::makeInstance('language');

		$this->lang = t3lib_div::_GET('lng');
		if ($this->lang == '') {
			$GLOBALS['LANG']->init('default');
		} else {
			$GLOBALS['LANG']->init($this->lang);
		}

		$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/locallang_eID.xml');

		tslib_eidtools::connectDB();

		// Sanity check
		$this->uid = t3lib_div::_GET('uid');

		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($this->uid);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($this->uid);
		}

		if (!$tmpint) {
			echo $GLOBALS['LANG']->getLL('bad_uid_value');
			exit;
		}


		$check = t3lib_div::_GET('chk');
		if (md5($this->uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $check) {
			echo $GLOBALS['LANG']->getLL('wrong_check_value');
			exit;
		}
		$this->command = t3lib_div::_GET('cmd');
		if (!t3lib_div::inList('approve,delete,kill', $this->command)) {
			echo $GLOBALS['LANG']->getLL('wrong_cmd');
			exit;
		}
		if ($this->command=='approve') {
			$data_str = t3lib_div::_GET('confenc');
			$data = unserialize(base64_decode($data_str));
			$this->conf =$data;
		}



	}

	/**
	 * Main processing function of eID script
	 *
	 * @return	void
	 */
	function main() {
		if (version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}
		$rtecho = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body><div><p>';
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid);

		if ($rows[0]['t'] == 0) {
			$rtecho .= $GLOBALS['LANG']->getLL('comment_does_not_exist');
			echo $rtecho;
			echo '</p></div></body></html>';
			exit;
		}
		switch ($this->command) {
			case 'approve':
				$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('approved' => 1));
				$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('comment_approved'));
				break;
			case 'delete':
				$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('deleted' => 1));
				$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_deleted'));
				break;
			case 'kill':
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid);
				$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_killed'));
				break;
		}
		echo $rtecho;

		if ($this->command=='approve') {
		// check commentator notifications
			require_once(t3lib_extMgm::extPath('toctoc_comments', 'class.toctoc_comments_api.php'));
			$apiObj = t3lib_div::makeInstance('toctoc_comments_api');
			/* @var $apiObj toctoc_comments_api */
			 $apiObj->handleCommentatorNotifications($this->uid, $this->conf);
		}

		// Call hooks
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['eID_postProc'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['eID_postProc'] as $userFunc) {
				$params = array(
					'pObj' => &$this,
				);
				t3lib_div::callUserFunction($userFunc, $params, $this);
			}
		}
		echo '</p></div></body></html>';
		// Clear cache
		$pidList = t3lib_div::intExplode(',', t3lib_div::_GET('clearCache'));
		t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		/* @var $tce t3lib_TCEmain */
		foreach ($pidList as $pid) {
			if ($pid != 0) {
				$tce->clear_cacheCmd($pid);
			}
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_eID.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_eID.php']);
}

// Make instance:
$SOBE = t3lib_div::makeInstance('toctoc_comments_eID');
$SOBE->init();
$SOBE->main();
?>