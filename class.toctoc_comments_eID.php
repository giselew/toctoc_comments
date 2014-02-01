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
* class.toctoc_comments_eID.php
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
 *   62: class toctoc_comments_eID
 *   73:     function init()
 *  130:     function main()
 *  302:     protected function ipBlock()
 *
 * TOTAL FUNCTIONS: 3
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
	var $apiObj;
	var $lang;
	var $processing;
	var $notifications;
	var $notificationscoi;
	var $messageinternal = '';

	function init() {
		$GLOBALS['LANG'] = t3lib_div::makeInstance('language');
		require_once(t3lib_extMgm::extPath('toctoc_comments', 'class.toctoc_comments_api.php'));
		$this->apiObj = t3lib_div::makeInstance('toctoc_comments_api');

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
			$this->messageinternal .= $GLOBALS['LANG']->getLL('bad_uid_value') . '<br />';
			$this->uid = 0;
		}

		$check = t3lib_div::_GET('chk');
		if (md5($this->uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']) != $check) {
			$this->messageinternal .=  $GLOBALS['LANG']->getLL('wrong_check_value') . '<br />';
		}
		$this->command = t3lib_div::_GET('cmd');
		if (!t3lib_div::inList('denotify,approve,approvecoi,delete,kill', $this->command)) {
			$this->messageinternal .=  $GLOBALS['LANG']->getLL('wrong_cmd') . '<br />';
		}

		$data_str = t3lib_div::_GET('confenc');
		$data = unserialize(base64_decode($data_str));
		$this->conf =$data;
		$this->processing = t3lib_div::_GET('processing');
		if (!$this->processing) {
			$returnurl=$_SERVER["REQUEST_URI"] . '&processing=1';
			echo $this->apiObj->handleeID($this->uid, $this->conf,$rtecho,$returnurl);
			exit;
		}
		$this->notifications = t3lib_div::_GET('notifications');
		$this->notificationscoi = t3lib_div::_GET('notificationscoi');
	}

	/**
	 * Main processing function of eID script
	 *
	 * @return	void
	 */
	function main() {
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$this->apiObj->InitCaches();
		}
		$rtecho = '';
		if ($this->notifications) {
			$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_approved')) . '<br />' . $this->apiObj->handleCommentatorNotifications($this->uid, $this->conf, false, $this->conf['storagePid']);
		} elseif ($this->notificationscoi) {
			$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_approvedcoi')) . '<br />';
		} else {

			$sendmailok = 0;
			$coiok=0;
			if ($this->messageinternal =='') {
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid);

				if ($rows[0]['t'] == 0) {
					$rtecho .= $GLOBALS['LANG']->getLL('comment_does_not_exist');

				} else {
					 switch ($this->command) {
						case 'denotify':
							$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_toctoc_comments_comments', 'uid=' . $this->uid);
							//print_r	( $rowsa); print_r	( $this->conf); exit;
							$triggeredplugin= $rowsa[0]['external_ref_uid'];
							$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'toctoc_comments_user="' .
									$this->conf['toctoc_comments_user'] . '" AND external_ref_uid="' .
									$triggeredplugin . '"', array('tx_commentsnotify_notify' => 0));
							//sprintf($this->pi_getLLWrap($pObj, 'email.textdenotifycomment', $fromAjax), $row['external_ref_uid']);
							$rtecho .=  htmlspecialchars(sprintf($GLOBALS['LANG']->getLL('comment_denotified'), $this->conf['email']))
							 . '<br />';
							$sendmailok=0;
							break;
						case 'approvecoi':
							$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . ' AND hidden = 1');

							if ($rowsa[0]['t'] == 0) {
								$rtecho .= $GLOBALS['LANG']->getLL('comment_alreadycoi');

							} else {
								$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t, toctoc_comments_user As tuser', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . ' AND approved = 1');

								if ($rowsa[0]['t'] == 0) {
									$rtecho .= $GLOBALS['LANG']->getLL('comment_notyetapproved');
									$coiok=2;

								} else {
									$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('comment_coi')) . '<br />';
									$coiok=1;
									$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
									$commentcount = intval($rowsb[0]['count_comments'])+1;
									$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));




								}
							}

							break;
						case 'approve':
							$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t, toctoc_comments_user As tuser', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . ' AND approved = 0');

							if ($rowsa[0]['t'] == 0) {
								$rtecho .= $GLOBALS['LANG']->getLL('comment_alreadyapproved');

							} else {

								$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('approved' => 1));

								$rowscoi = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . ' AND hidden = 0');
								if ($rowscoi[0]['t'] != 0) {

									$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
									$commentcount = intval($rowsb[0]['count_comments']);

									$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));
								}
								$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('comment_approved')) . '<br />';
								$sendmailok=1;
							}

							break;
						case 'delete':

							$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_comments_user As tuser', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . '');

							$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('deleted' => 1));
							$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
							$commentcount = intval($rowsb[0]['count_comments']);
							$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));

							$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_deleted'));
							break;
						case 'kill':
							$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_comments_user As tuser', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . '');

							$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid);
							$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
							$commentcount = intval($rowsb[0]['count_comments']);
							$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));

							$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_killed'));
							break;
					}
					//echo $rtecho;

					if ($this->command=='approve') {
					// check commentator notifications
						if ($sendmailok==1) {
							if (!$this->notifications) {
								$returnurl=$_SERVER["REQUEST_URI"] . '&notifications=1';
								$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('nowsendemailnotification')) . '<br />';
								echo $this->apiObj->handleeID($this->uid, $this->conf,$rtecho,$returnurl);
								exit;
							}

						}
					}
					if ($this->command=='approvecoi') {
						// check commentator notifications
						if ($coiok>=1) {
							if (!$this->notifications) {
								$returnurl='tocomment';
								if ($coiok>=2) {
									$returnurl='tocomment' . $_SERVER["REQUEST_URI"] . '&notificationscoi=1';
								}
								//$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('nowsendemailnotification')) . '<br />';
								echo $this->apiObj->handleeID($this->uid, $this->conf,$rtecho,$returnurl);
								exit;
							}

						}
					}
					//t3lib_div::callUserFunction($userFunc, $params, $this);
					$rtecho .=  $this->ipBlock();
					// Call hooks
					if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['eID_postProc'])) {
						foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['eID_postProc'] as $userFunc) {
							$params = array(
								'pObj' => &$this,
							);
							t3lib_div::callUserFunction($userFunc, $params, $this);
						}
					}

				}
				//echo '</p></div></body></html>';
			} else {
				$rtecho = $this->messageinternal;
			}
		}

		/* @var $apiObj toctoc_comments_api */
		//handleeID($uid, $conf,$pObj,$pid=0,$messagetodisplay)
		echo $this->apiObj->handleeID($this->uid, $this->conf,$rtecho,'');
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
	/**
	 * Adds ip address to local block list.
	 *
	 * @return	void		...
	 */
	protected function ipBlock() {
		$ip = long2ip(t3lib_div::_GP('ip'));
		/* @var $pObj tx_comments_eID */
		if ($ip && ($this->command == 'delete' || $this->command == 'kill')) {
			if ($ip != '0.0.0.0') {
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_ipbl_local', array(
						'pid' => $this->conf['storagePid'],
						'crdate' => time(),
						'tstamp' => time(),
						'ipaddr' => $ip,
						'comment' => '',
				));
				return htmlspecialchars($GLOBALS['LANG']->getLL('ip_blocked')) . ' ' . $ip . '<br />';
			}
		}
		return '';
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