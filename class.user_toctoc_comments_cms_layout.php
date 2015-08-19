<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2015 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *   46: class user_toctoc_comments_cms_layout
 *   54:     public function getExtensionSummary($params, &$pObj)
 *
 * TOTAL FUNCTIONS: 1
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */


/**
 * Hook to display verbose information about pi1 plugin in Web>Page module
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class user_toctoc_comments_cms_layout {
	/**
 * Returns information about this extension's pi1 plugin
 *
 * @param	array		$params	Parameters to the hook
 * @param	object		$pObj	A reference to calling object
 * @return	string		Information about pi1 plugin
 */
	public function getExtensionSummary($params, &$pObj) {
		if (version_compare(TYPO3_version, '6.3', '>')) {
			(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
		}

		$result = '<b>' . $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.list_type_pi1') . '</b><br />';
		if ($params['row']['list_type'] == 'toctoc_comments_pi1') {
			$data = t3lib_div::xml2array($params['row']['pi_flexform']);

			if (is_array($data)) {
				$mode = $data['data']['sDEF']['lDEF']['pluginmode']['vDEF'];
				$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code') . ' ';
				if ($mode =='') {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.usets');
				} elseif ($mode =='0') {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.0');
				} elseif ($mode =='1' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.1');
				} elseif ($mode =='2' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.2');
				} elseif ($mode =='3' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.3');
				} elseif ($mode =='4' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.4');
				} elseif ($mode =='5' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.5');
				} elseif ($mode =='6' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.6');
				} elseif ($mode =='7' ) {
					$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.code.I.7');
				}

				if (($mode =='') || ($mode =='0')) {
					$result .= '<br />';
					$tpfx = $data['data']['sDEF']['lDEF']['externalPrefix']['vDEF'];
					if ($tpfx !='') {
						$result .= ucfirst($GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.trigger.prefix')) . ' ' .$tpfx;
						$result .= '<br />';
					}

					$useshr = $data['data']['sSharing']['lDEF']['useSharingV2']['vDEF'];
					$result .= ucfirst($GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useSharing')) . ' ';
					if ($useshr =='') {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.usets');
					} elseif ($useshr ==1) {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useyes');
					} elseif ($useshr ==0 ) {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useno');
					}

					$result .= '<br />';
					$usert = $data['data']['sRatings']['lDEF']['ratingsOnly']['vDEF'];
					$result .= ucfirst($GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.ratingsOnly')) . ' ';
					if ($usert =='') {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.usets');
					} elseif ($usert ==1) {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useyes');
					} elseif ($usert ==0 ) {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useno');
					}

					$result.= '<br />';
					$enart = $data['data']['sRatings']['lDEF']['enableRatings']['vDEF'];
					$result .= ucfirst($GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.enableRatings')) . ' ';
					if ($enart =='') {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.usets');
					} elseif ($enart ==1) {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useyes');
					} elseif ($enart ==0 ) {
						$result .= $GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.useno');
					}

					$useTopWebpagePreview = $data['data']['sAttachments']['lDEF']['useTopWebpagePreview']['vDEF'];
					if ($useTopWebpagePreview != '') {
						$result .= '<br />' . ucfirst($GLOBALS['LANG']->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.toctoc_comments_pi1.topwebpagepreviewlink')) .
						' ' . $useTopWebpagePreview;

					}
				}

			}

		}

		return $result;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.user_toctoc_comments_cms_layout.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.user_toctoc_comments_cms_layout.php']);
}

?>