<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * Hooks to tt_news.
 *
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   56: class user_toctoc_comments_ttnews
 *   66:     public function extraItemMarkerProcessor($markerArray, $row, $lConf, &$pObj)
 *  221:     private function getNumberOfComments($newsUid, &$pObj)
 *  240:     private function getTemplate($section, $conf, &$pObj)
 *  274:     private function getItemLink($itemUid, &$pObj)
 *
 * TOTAL FUNCTIONS: 4
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
}

/**
 * This clas provides hook to tt_news to add extra markers.
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class user_toctoc_comments_ttnews {
	/**
 * Processes comments-specific markers for tt_news
 *
 * @param	array		$markerArray	Array with merkers
 * @param	array		$row	tt_news record
 * @param	array		$lConf	Configuration array for current tt_news view
 * @param	tx_ttnews		$pObj	Reference to parent object
 * @return	array		Modified marker array
 */
	public function extraItemMarkerProcessor($markerArray, $row, $lConf, &$pObj) {
		/* @var $pObj tx_ttnews */
		$beginlist =0;
		$endlist =0;
		$poscommentscount=0;
		$poscommentsplugin =0;
		if ($pObj->theCode == 'LIST') {
			$beginlist= strpos ($pObj->templateCode, '###TEMPLATE_LIST### begin');
			$endlist= strpos ($pObj->templateCode, '###TEMPLATE_LIST### end');
			$poscommentscount= strpos ($pObj->templateCode, '###TX_COMMENTS_COUNT###', $beginlist);
			$poscommentsplugin = strpos ($pObj->templateCode, '###TX_TOCTOCCOMMENTS###', $beginlist);
		}

			if ($pObj->theCode == 'LIST2') {
			$beginlist= strpos ($pObj->templateCode, '###TEMPLATE_LIST2### begin');
			$endlist= strpos ($pObj->templateCode, '###TEMPLATE_LIST2### end');
			$poscommentscount= strpos ($pObj->templateCode, '###TX_COMMENTS_COUNT###', $beginlist);
			$poscommentsplugin = strpos ($pObj->templateCode, '###TX_TOCTOCCOMMENTS###', $beginlist);
		}

			if ($pObj->theCode == 'LIST3') {
			$beginlist= strpos ($pObj->templateCode, '###TEMPLATE_LIST2### begin');
			$endlist= strpos ($pObj->templateCode, '###TEMPLATE_LIST2### end');
			$poscommentscount= strpos ($pObj->templateCode, '###TX_COMMENTS_COUNT###', $beginlist);
			$poscommentsplugin = strpos ($pObj->templateCode, '###TX_TOCTOCCOMMENTS###', $beginlist);
		}

		if ($pObj->theCode == 'SINGLE') {
			$beginlist= strpos ($pObj->templateCode, '###TEMPLATE_SINGLE### begin');
			$endlist= strpos ($pObj->templateCode, '###TEMPLATE_SINGLE### end');
			$poscommentscount= strpos ($pObj->templateCode, '###TX_COMMENTS_COUNT###', $beginlist);
			$poscommentsplugin = strpos ($pObj->templateCode, '###TX_TOCTOCCOMMENTS###', $beginlist);
		}

		if ($pObj->theCode == 'LATEST') {
			$beginlist= strpos ($pObj->templateCode, '###TEMPLATE_LATEST### begin');
			$endlist= strpos ($pObj->templateCode, '###TEMPLATE_LATEST### end');
			$poscommentscount= strpos ($pObj->templateCode, '###TX_COMMENTS_COUNT###', $beginlist);
			$poscommentsplugin = strpos ($pObj->templateCode, '###TX_TOCTOCCOMMENTS###', $beginlist);
		}

		if ($pObj->theCode == 'SEARCH') {
			$beginlist= strpos ($pObj->templateCode, '###TEMPLATE_SEARCH### begin');
			$endlist= strpos ($pObj->templateCode, '###TEMPLATE_SEARCH### end');
			$poscommentscount= strpos ($pObj->templateCode, '###TX_COMMENTS_COUNT###', $beginlist);
			$poscommentsplugin = strpos ($pObj->templateCode, '###TX_TOCTOCCOMMENTS###', $beginlist);
		}

		if ($poscommentscount > 0) {
			$markerArray['###TX_COMMENTS_COUNT###'] = 'poscommentscount: '.$poscommentscount . ' $beginlist: '.$beginlist. ' $$endlist: '.$endlist;
				if (($poscommentscount > $beginlist) && ($poscommentscount < $endlist)) {
				switch ($pObj->theCode) {
					case 'LATEST':
					case 'LIST':
					case 'LIST2':
					case 'LIST3':
					case 'SINGLE':
					case 'SEARCH':
						// Add marker for number of comments
						$commentCount = $this->getNumberOfComments($row['uid'], $pObj);
						$templateName = $commentCount ? '###TTNEWS_COMMENT_COUNT_SUB###' : '###TTNEWS_COMMENT_NONE_SUB###';
						if (($template = $this->getTemplate($templateName, $lConf, $pObj))) {
							$lang = t3lib_div::makeInstance('language');
							/* @var $lang language */
							$lang->init($GLOBALS['TSFE']->lang);
							$commenttextoption=0;
							if (is_array($pObj->conf['toctoc_comments.'])) {
								$commenttextoption= intval($pObj->conf['toctoc_comments.'][$pObj->theCode . '.']['commentsShowCountText']);
							}

							if ($commenttextoption==0) {
								if ($commentCount==1) {
								$commenttextnb=$lang->sL('LLL:EXT:toctoc_comments/locallang_hooks.xml:comments_number_one');
								} else {
									$commenttextnb = sprintf($lang->sL('LLL:EXT:toctoc_comments/locallang_hooks.xml:comments_number'), $commentCount);
								}

								$markerArray['###TX_COMMENTS_COUNT###'] = $pObj->cObj->substituteMarkerArray(
									$template, array(
										'###COMMENTS_COUNT_NUMBER###' => $commentCount,
										'###COMMENTS_COUNT###' => $commenttextnb,
										'###COMMENTS_COUNT_NONE###' => $lang->sL('LLL:EXT:toctoc_comments/locallang_hooks.xml:comments_number_none'),
										'###UID###' => $row['uid'],
										'###COMMENTS_LINK###' => $this->getItemLink($row['uid'], $pObj),
									)
								);
							} else {
								$markerArray['###TX_COMMENTS_COUNT###'] = $pObj->cObj->substituteMarkerArray(
										$template, array(
												'###COMMENTS_COUNT_NUMBER###' => intval($commentCount),
												'###COMMENTS_COUNT###' => intval($commentCount),
												'###COMMENTS_COUNT_NONE###' => '0',
												'###UID###' => $row['uid'],
												'###COMMENTS_LINK###' => $this->getItemLink($row['uid'], $pObj),
										)
								);
							}

							unset($lang);
							// Free memory explicitely!
						}

					break;
				}

			}

		}

		if ($poscommentsplugin > 0) {
			if (($poscommentsplugin > $beginlist) && ($poscommentsplugin < $endlist)) {

				include_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_pi1.php'));
				$lib = new tx_toctoccomments_pi1;
				switch ($pObj->theCode) {
					case 'LATEST':
					case 'LIST':
					case 'LIST2':
					case 'LIST3':
					case 'SEARCH':
						$content='';
						if (!$this->cObj) {
							$this->cObj = t3lib_div::makeInstance('tslib_cObj');
							$this->cObj->start('', '');
						}

						$conftc=array();
						$conftc= $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];

						if (is_array($pObj->conf['toctoc_comments.'])) {
							// stuff to merge
							$conftc = array_replace_recursive($conftc, $pObj->conf['toctoc_comments.']);
						}

						$markerArray['###TX_TOCTOCCOMMENTS###'] = $lib->main($content, $conftc, 'tx_ttnews', $row['uid'], $this->cObj);
						unset($lib);
						break;
				}

			}

		}

		return $markerArray;
	}

	/**
	 * Retrieves number of comments
	 *
	 * @param	int		$newsUid	UID of tt_news item
	 * @param	tx_ttnews		$pObj	Reference to parent object
	 * @return	int		Number of comments for this news item
	 * @access private
	 */
	private function getNumberOfComments($newsUid, &$pObj) {
		/* @var $pObj tx_ttnews */
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments',
				'external_prefix=' . $GLOBALS['TYPO3_DB']->fullQuoteStr('tx_ttnews', 'tx_toctoc_comments_comments') .
				' AND external_ref=' . $GLOBALS['TYPO3_DB']->fullQuoteStr('tt_news_' . $newsUid, 'tx_toctoc_comments_comments') .
				' AND approved=1 ' .
				$pObj->cObj->enableFields('tx_toctoc_comments_comments'));
		return $recs[0]['t'];
	}

	/**
	 * Retrieves template for custom marker
	 *
	 * @param	string		$section	Section name in the template
	 * @param	arrasy		$conf	tt_news configuration
	 * @param	tx_ttnews		$pObj	Reference to parent object
	 * @return	string		Template section
	 * @access private
	 */
	private function getTemplate($section, $conf, &$pObj) {
		// Search for file
		if (isset($conf['commentsTemplateFile'])) {
			$file = $conf['commentsTemplateFile'];
		}

		elseif (isset($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.']['templateFile'])) {
			$file = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.']['templateFile'];
		}

		else {
			// Use default
			$file = 'EXT:toctoc_comments/res/template/toctoccomments_template.html';
		}

		if (($template = $pObj->cObj->fileResource($file))) {
			$template = $pObj->cObj->getSubpart($template, $section);
		}

		return $template;
	}

	/**
	 * Attempts to build URL to item.
	 * Firsts it checks if marker value is not empty. If yes, it treats it as a
	 * link to item and attempts to extract the link. If value is empty, it uses item
	 * uid to manually create link
	 *
	 * @param	string		$marker	Marker value with link
	 * @param	int		$itemUid	Item uid
	 * @param	tx_ttnews		$pObj	Reference to parent object
	 * @return	string		Generated URL to item
	 * @access private
	 */
	private function getItemLink($itemUid, &$pObj) {
		$result = '';
		if (isset($GLOBALS['TSFE']->register['newsMoreLink']) &&
				($pos = strpos($GLOBALS['TSFE']->register['newsMoreLink'], 'href="')) !== FALSE) {
			$value = substr($GLOBALS['TSFE']->register['newsMoreLink'], $pos + 6);
			$result = substr($value, 0, strpos($value, '"'));
		}

		if (!$result) {
			$params = array(
				'additionalParams' => '&tx_ttnews[tt_news]=' . $itemUid,
				'no_cache' => $GLOBALS['TSFE']->no_cache,
				'parameter' => $pObj->conf['singlePid'] ? $pObj->conf['singlePid'] : $GLOBALS['TSFE']->id,
				'useCacheHash' => !$GLOBALS['TSFE']->no_cache,
				'returnLast' => 'url',
			);
			$result = $pObj->cObj->typolink('|', $params);
		}

		return $result;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.user_toctoc_comments_ttnews.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.user_toctoc_comments_ttnews.php']);
}

?>