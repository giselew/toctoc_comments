<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
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
* AJAX Social Network Components
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   67: class toctoc_comments_eID
 *   81:     public function init()
 *  207:     public function main()
 *  473:     protected function processReponseOutput()
 *  571:     protected function ipBlock()
 *
 * TOTAL FUNCTIONS: 4
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
if (version_compare(TYPO3_version, '6.0', '<')) {
	if (!version_compare(TYPO3_version, '4.6', '<')) {
		require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
	}

	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
}

/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_eID {
	private $uid;
	private $command;
	private $conf;
	private $apiObj;
	private $lang;
	private $processing;
	private $notifications;
	private $notificationscoi;
	private $messageinternal = '';
	public $clearCacheNeeded = TRUE;
	private $cObj;
	private $data;

	public function init() {
		if (version_compare(TYPO3_version, '6.3', '>')) {
			(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
			(class_exists('t3lib_utility_Math', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\MathUtility', 't3lib_utility_Math');
			(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
			(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
			(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
			(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
			(class_exists('tslib_eidtools', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Utility\EidUtility', 'tslib_eidtools');
		}

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
		$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/pi1/locallang.xml', TRUE, TRUE);
		if (version_compare(TYPO3_version, '6.1', '<')) {
			tslib_eidtools::connectDB();
		}

		// Sanity check
		$this->uid = t3lib_div::_GET('uid');
		$this->rteecho ='';
		if (t3lib_div::_GET('rteecho') != '') {
			$this->rteecho = base64_decode(trim(t3lib_div::_GET('rteecho')));
		}
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
		if (!t3lib_div::inList('respond,approveadminconfirmsignup,deleteadminconfirmsignup,denotify,approve,approvecoi,delete,kill', $this->command)) {
			$this->messageinternal .=  $GLOBALS['LANG']->getLL('wrong_cmd') . '<br />';
		}

		$data_str ='';
		$data_str_id = t3lib_div::_GET('confenc');

		if (intval($data_str_id) > 0) {
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('mailconf', 'tx_toctoc_comments_cache_mailconf',
					'id=' . $data_str_id);
			if (count($rows) == 1) {
				$data_str = $rows[0]['mailconf'];
			}

			if ($data_str == '') {
				$this->messageinternal .=  str_replace('%s', $data_str_id, $GLOBALS['LANG']->getLL('wrong_conf')) . '<br />';
			}

		} else {
			$data_str = $data_str_id;
		}

		$data = unserialize(base64_decode(rawurldecode($data_str)));
		$this->conf = $data;

		if ($this->command != 'respond') {
			$this->processing = t3lib_div::_GET('processing');
			if (!$this->processing) {
				$returnurl=$_SERVER['REQUEST_URI'] . '&processing=1';
				echo $this->apiObj->handleeID($this->uid, $this->conf, $rtecho, $returnurl);
				exit;
			}

		} else {
			if (($this->command == 'approveadminconfirmsignup') || ($this->command == 'deleteadminconfirmsignup')) {
				$this->data = array_pop(
						$GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
								'uid as uid',
								'fe_users',
								'uid=' . $this->uid
						)
				);
				if (empty($this->data)) {

					echo $GLOBALS['LANG']->getLL('user_does_not_exist');
					exit;
				}

			} else {
				$this->data = array_pop(
						$GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
								'content as comment, tx_commentsresponse_response AS response',
								'tx_toctoc_comments_comments',
								'uid=' . $this->uid
						)
				);
				if (empty($this->data)) {

					echo $GLOBALS['LANG']->getLL('comment_does_not_exist');
					exit;
				}

			}

		}
		$this->notifications = t3lib_div::_GET('notifications');
		$this->notificationscoi = t3lib_div::_GET('notificationscoi');
		$this->notificationsadmconfirm = t3lib_div::_GET('notificationsadmconfirm');
	}

	/**
	 * Main processing function of eID script
	 *
	 * @return	void
	 */
	public function main() {
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$this->apiObj->InitCaches();
		}

		if ($this->command != 'respond') {
			if ($this->notifications) {
				$rtecho = '';
				$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_approved')) . '<br />' .
				$this->apiObj->handleCommentatorNotifications($this->uid, $this->conf, FALSE, $this->conf['storagePid']);
			} elseif ($this->notificationscoi) {
				$rtecho = '';
				$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_approvedcoi')) . '<br />';
			} elseif ($this->notificationsadmconfirm) {
				$rtecho = $this->rteecho . '<br />';
				$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('user_approvaldone')) . '<br />';
			} else {
				$rtecho = '';
				$sendmailok = 0;
				$coiok=0;
				if ($this->messageinternal =='') {
					if (($this->command == 'approveadminconfirmsignup') || ($this->command == 'deleteadminconfirmsignup')) {
						$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'fe_users', 'uid=' . $this->uid);
					} else {
						$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid);
					}

					if ($rows[0]['t'] == 0) {
						if (($this->command == 'approveadminconfirmsignup') || ($this->command == 'deleteadminconfirmsignup')) {
							$rtecho .= $GLOBALS['LANG']->getLL('user_does_not_exist');
						} else {
							$rtecho .= $GLOBALS['LANG']->getLL('comment_does_not_exist');
						}
						$this->clearCacheNeeded=FALSE;

					} else {
						 switch ($this->command) {
							case 'denotify':
								$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_toctoc_comments_comments', 'uid=' . $this->uid);
								$triggeredplugin= $rowsa[0]['external_ref_uid'];
								$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'toctoc_comments_user="' .
										$this->conf['toctoc_comments_user'] . '" AND external_ref_uid="' .
										$triggeredplugin . '"', array('tx_commentsnotify_notify' => 0));
								$rtecho .=  htmlspecialchars(sprintf($GLOBALS['LANG']->getLL('comment_denotified'), $this->conf['email']))
								 . '<br />';
								$sendmailok=0;
								break;
							case 'approveadminconfirmsignup':
								$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('fe_users', 'uid=' . $this->uid, array('disable' => 0));

								$rtecho .=  htmlspecialchars(sprintf($GLOBALS['LANG']->getLL('user_approved'), $this->conf['email']))
								. '<br />';

								$admconfirmok=1;
								break;
							case 'deleteadminconfirmsignup':
								$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('fe_users', 'uid=' . $this->uid, array('disable' => 1));

								$rtecho .=  htmlspecialchars(sprintf($GLOBALS['LANG']->getLL('user_deleted'), $this->conf['email']))
								. '<br />';
								$admconfirmok=1;

								break;
							case 'approvecoi':
								$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . ' AND hidden = 1');

								if ($rowsa[0]['t'] == 0) {
									$rtecho .= $GLOBALS['LANG']->getLL('comment_alreadycoi');
									$this->clearCacheNeeded=FALSE;

								} else {
									$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t, toctoc_comments_user As tuser', 'tx_toctoc_comments_comments', 'uid=' .
											$this->uid . ' AND approved = 1');

									if ($rowsa[0]['t'] == 0) {
										$rtecho .= $GLOBALS['LANG']->getLL('comment_notyetapproved');
										$coiok=2;
										$this->clearCacheNeeded=FALSE;

									} else {
										$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('comment_coi')) . '<br />';
										$coiok=1;
										$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments',
												'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
										$commentcount = intval($rowsb[0]['count_comments'])+1;
										$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] . '"
												AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));
										$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('hidden' => 0));
										$this->clearCacheNeeded=TRUE;

									}

								}

								break;
							case 'approve':
								$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t, toctoc_comments_user As tuser', 'tx_toctoc_comments_comments',
									'uid=' . $this->uid . ' AND approved = 0');

								if ($rowsa[0]['t'] == 0) {
									$rtecho .= $GLOBALS['LANG']->getLL('comment_alreadyapproved');
									$this->clearCacheNeeded=FALSE;

								} else {

									$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('approved' => 1));

									$rowscoi = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments', 'uid=' . $this->uid .
											' AND hidden = 0');
									if ($rowscoi[0]['t'] != 0) {

										$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments',
												'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
										$commentcount = intval($rowsb[0]['count_comments']);
										$sendmailok=1;
										$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] .
												'" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));
									} else {
										$sendmailok=0;
										$rtecho .= $GLOBALS['LANG']->getLL('comment_notyetcoi') . '<br />';
										$this->clearCacheNeeded=FALSE;
									}

									$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('comment_approved')) . '<br />';

								}

								break;
							case 'delete':

								$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_comments_user As tuser', 'tx_toctoc_comments_comments', 'uid=' . $this->uid . '');

								$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid, array('deleted' => 1));
								$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments',
										'toctoc_comments_user="' . $rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
								$commentcount = intval($rowsb[0]['count_comments']);
								$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' . $rowsa[0]['tuser'] .
										'" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));

								$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_deleted'));
								break;
							case 'kill':
								$rowsa = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_comments_user As tuser', 'tx_toctoc_comments_comments',
								'uid=' . $this->uid . '');

								$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_toctoc_comments_comments', 'uid=' . $this->uid);
								$rowsb = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS count_comments', 'tx_toctoc_comments_comments', 'toctoc_comments_user="' .
										$rowsa[0]['tuser'] . '" AND approved = 1 AND deleted = 0 and hidden=0');
								$commentcount = intval($rowsb[0]['count_comments']);
								$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_user', 'toctoc_comments_user="' .
										$rowsa[0]['tuser'] . '" AND deleted = 0 and pid=' . $this->conf['storagePid'] . '', array('comment_count' => $commentcount));

								$rtecho .= htmlspecialchars($GLOBALS['LANG']->getLL('comment_killed'));
								break;
						}

						if ($this->command=='approve') {
						// check commentator notifications
							if ($sendmailok==1) {
								if (!$this->notifications) {
									$returnurl=$_SERVER['REQUEST_URI'] . '&notifications=1';
									$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('nowsendemailnotification')) . '<br />';
									echo $this->apiObj->handleeID($this->uid, $this->conf, $rtecho, $returnurl);
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
										$returnurl='tocomment' . $_SERVER['REQUEST_URI'] . '&notificationscoi=1';
									} else {
										$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('nowsendemailnotification')) . '<br />';
									}

									echo $this->apiObj->handleeID($this->uid, $this->conf, $rtecho, $returnurl);
									exit;
								}

							}

						}

						if (($this->command=='approveadminconfirmsignup') || ($this->command=='deleteadminconfirmsignup')) {
							// check new user notifications
							if ($admconfirmok>=1) {
								if (!$this->notifications) {
									$returnurl=$_SERVER['REQUEST_URI'] . '&notificationsadmconfirm=1';
									$rtecho .=  htmlspecialchars($GLOBALS['LANG']->getLL('nowsendemailnotificationadmconfirm')) . '<br />';
									echo $this->apiObj->handleeID($this->uid, $this->conf, $rtecho, $returnurl);
									exit;
								}

							}

						}

						$rtecho .=  $this->ipBlock();
						// Call hooks
						if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['eID_postProc'])) {
							foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['eID_postProc'] as $userFunc) {
								$params = array(
									'pObj' => $this,
								);
								t3lib_div::callUserFunction($userFunc, $params, $this);
							}

						}

					}

				} else {
					$rtecho = $this->messageinternal;
				}

			}

			/* @var $apiObj toctoc_comments_api */
			echo $this->apiObj->handleeID($this->uid, $this->conf, $rtecho, '');
			// Clear cache
			if ($this->clearCacheNeeded) {
				$pidList = t3lib_div::intExplode(',', t3lib_div::_GET('clearCache'));
				$pidList=array_unique($pidList);
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
				foreach ($pidList as $pid) {
					if ($pid != 0) {
							$tce->clear_cacheCmd($pid);

					}

				}

				$this->apiObj->setPluginCacheControlTstamp($this->conf['plugin']);
				$this->apiObj->deleteDBcachereport('comments', $this->conf['plugin']);
			}
		} else {

			echo $this->processReponseOutput();
		}

	}

	/**
	 * Generation of the output of the eID script for admin responses
	 *
	 * @return	string		The output
	 */
	protected function processReponseOutput() {
		if (!isset($this->cObj)) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}
		$content = '';
		$this->template = file_get_contents(
				t3lib_extMgm::extPath('toctoc_comments', '/res/template/toctoccomments_template_response_eid.html')
		);
		if (t3lib_div::_POST('response')) {

			$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
					'tx_toctoc_comments_comments',
					'uid=' . $this->uid,
					array('tx_commentsresponse_response' => t3lib_div::_POST('response'))
			);

			$message = $this->cObj->getSubpart($this->template, '###MESSAGE###');
			$messageMarkers = array(
					'###STATUS_MESSAGE###' => $GLOBALS['LANG']->getLL('response_saved')
			);

			// Clear page cache
			$pidList = t3lib_div::intExplode(',', t3lib_div::_GET('clearCache'));
			$pidList=array_unique($pidList);
			if (version_compare(TYPO3_version, '6.0', '<')) {
				t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
			} else {
				require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
			}

			$tce = t3lib_div::makeInstance('t3lib_TCEmain');

			/* @var $tce t3lib_TCEmain */
			foreach ($pidList as $pid) {
				if ($pid != 0) {
					// the $GLOBALS['TCA']-Patch for eID and FLUX
					if (!(isset($GLOBALS['TCA']))) {
						$GLOBALS['TCA'] = array();
						$GLOBALS['TCA']['tt_content'] = array();
					}

						$tce->clear_cacheCmd($pid);
						$messageMarkers = array(
							'###STATUS_MESSAGE###' => $GLOBALS['LANG']->getLL('response_saved_cache_cleared')
						);

				}

			}
			$this->apiObj->setPluginCacheControlTstamp($this->conf['plugin']);
			$this->apiObj->deleteDBcachereport('comments', $this->conf['plugin']);

			$content = $this->cObj->substituteMarkerArray($message, $messageMarkers);
		} else {
			$form = $this->cObj->getSubpart($this->template, '###FORM###');
			$formMarkers = array(
					'###COMMENT_LABEL###' => $GLOBALS['LANG']->getLL('comment'),
					'###COMMENT###' => htmlspecialchars($this->data['comment']),
					'###RESPONSE_LABEL###' => $GLOBALS['LANG']->getLL('tx_commentsresponse_response'),
					'###RESPONSE###' => htmlspecialchars($this->data['response']),
					'###SUBMIT_LABEL###' => $GLOBALS['LANG']->getLL('submit_label'),
			);

			$content = $this->cObj->substituteMarkerArray($form, $formMarkers);
		}

		$document = $this->cObj->getSubpart($this->template, '###DOCUMENT###');

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];
		$pageTitle=$this->conf['pageTitle'];
		$linktocomment = $this->conf['pageURL'];
		$documentMarkers = array(
				'###MESSAGE###' => '',
				'###WAITTEXT###' => '',
				'###LINK_TO_COMMENT###' => $linktocomment,
				'###REFRESHURL###' =>'',
				'###MESSAGEDISPLAY###'  => '',
				'###INFOSLEFT###'  => '',
				'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
				'###MYHOMEPAGE###'  => $myhomepagelink,
				'###SITE_REL_PATH###' => $this->apiObj->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###MYHOMEPAGELINK###'  => t3lib_div::locationHeaderUrl(''),
				'###MYFONTFAMILY###'  => $this->conf['HTMLEmailFontFamily'],
				'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
				'###TITLE###' => $GLOBALS['LANG']->getLL('title'),
				'###CONTENT###' => $content,
		);
		$rettext = $this->cObj->substituteMarkerArray($document, $documentMarkers);
		return $rettext;
	}

	/**
	 * Adds ip address to local block list.
	 *
	 * @return	string		success message or empty
	 */
	protected function ipBlock() {
		$ip = long2ip(t3lib_div::_GP('ip'));
		if ($ip && ($this->command == 'delete' || $this->command == 'kill')) {
			if ($ip != '0.0.0.0') {
				$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_ipbl_local', array(
						'pid' => $this->conf['storagePid'],
						'crdate' => time(),
						'tstamp' => time(),
						'ipaddr' => $ip,
						'comment' => '',
				));
				$retstr = '<br />' . htmlspecialchars($GLOBALS['LANG']->getLL('ip_blocked')) . ' ' . $ip . '<br />';
				return $retstr;
			}

		}

		return '';
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_eID.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_eID.php']);
}

// Make instance:
if (isset($SOBE)) {
	unset($SOBE);
}
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$SOBE = t3lib_div::makeInstance('toctoc_comments_eID');
$SOBE->init();
$SOBE->main();
?>