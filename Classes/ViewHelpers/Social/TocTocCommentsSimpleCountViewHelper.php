<?php
/***************************************************************
 *  Copyright notice
 *  (c) 2013 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ViewHelper to add toctoccomments
 * Details: http://www.toctoc.ch/
 * Example
 * ==============
 * {namespace nt=Tx_News_ViewHelpers}
 * <nt:social.TocTocCommentsSimpleCount newsItem="{newsItem}"></nt:social.TocTocCommentsSimpleCount>*
 * @package TYPO3
 * @subpackage tx_news
 */
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
}
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('Tx_Fluid_Core_ViewHelper_AbstractViewHelper', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper', 'Tx_Fluid_Core_ViewHelper_AbstractViewHelper');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
	(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
}

	/**
	 * [Describe function...]
	 *
	 */
class Tx_News_ViewHelpers_Social_TocTocCommentsSimpleCountViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	protected $escapingInterceptorEnabled = FALSE;

	/**
	 * @var Tx_News_Service_SettingsService
	 */
	protected $pluginSettingsService;

	/**
	 * @param	[type]		$Tx_News_Service_SettingsService $pluginSettingsService: ...
	 * @return	void
	 * @var Tx_News_Service_SettingsService $pluginSettingsService
	 */
	public function injectSettingsService(Tx_News_Service_SettingsService $pluginSettingsService) {
		$this->pluginSettingsService = $pluginSettingsService;
	}
	/**
	 * Render TocTocComments thread
	 *
	 * @param	Tx_News_Domain_Model_News		$newsItem news item
	 * @param	string		$shortName shortname
	 * @param	string		$link link
	 * @param	[type]		$configuration: ...
	 * @return	string
	 */
	protected function rendererLink(Tx_News_Domain_Model_News $newsItem, $settings = array(), $uriOnly = FALSE, $configuration = array()) {
		$tsSettings = $this->pluginSettingsService->getSettings();
		$newsType = (int)$newsItem->getType();
		switch ($newsType) {
			// internal news
			case 1:
				$configuration['parameter'] = $newsItem->getInternalurl();
				break;
				// external news
			case 2:
				$configuration['parameter'] = $newsItem->getExternalurl();
				break;
				// normal news record
			default:
				$detailPid = 0;
				$detailPidDeterminationMethods = t3lib_div::trimExplode(',', $settings['detailPidDetermination'], TRUE);
	
				// if TS is not set, prefer flexform setting
				if (!isset($settings['detailPidDetermination'])) {
					$detailPidDeterminationMethods[] = 'flexform';
				}
	
				foreach ($detailPidDeterminationMethods as $determinationMethod) {
					if ($callback = $this->detailPidDeterminationCallbacks[$determinationMethod]) {
						if ($detailPid = call_user_func(array($this, $callback), $settings, $newsItem)) {
							break;
						}
					}
				}
	
				if (!$detailPid) {
					$detailPid = $GLOBALS['TSFE']->id;
				}
	
				$configuration['useCacheHash'] = 1;
				$configuration['parameter'] = $detailPid;
				$configuration['additionalParams'] .= '&tx_news_pi1[news]=' . $newsItem->getUid();
	
				if ((int)$tsSettings['link']['skipControllerAndAction'] !== 1) {
					$configuration['additionalParams'] .= '&tx_news_pi1[controller]=News' .
							'&tx_news_pi1[action]=detail';
				}
				// Add date as human readable (30/04/2011)
				if ($tsSettings['link']['hrDate'] == 1 || $tsSettings['link']['hrDate']['_typoScriptNodeValue'] == 1) {
					$dateTime = $newsItem->getDatetime();
	
					if (!empty($tsSettings['link']['hrDate']['day'])) {
						$configuration['additionalParams'] .= '&tx_news_pi1[day]=' . $dateTime->format($tsSettings['link']['hrDate']['day']);
					}
					if (!empty($tsSettings['link']['hrDate']['month'])) {
						$configuration['additionalParams'] .= '&tx_news_pi1[month]=' . $dateTime->format($tsSettings['link']['hrDate']['month']);
					}
					if (!empty($tsSettings['link']['hrDate']['year'])) {
						$configuration['additionalParams'] .= '&tx_news_pi1[year]=' . $dateTime->format($tsSettings['link']['hrDate']['year']);
					}
				}
		}
		if (isset($tsSettings['link']['typesOpeningInNewWindow'])) {
			if (t3lib_div::inList($tsSettings['link']['typesOpeningInNewWindow'], $newsType)) {
				$this->tag->addAttribute('target', '_blank');
			}
	
		}
	
		$url = $this->cObj->typoLink_URL($configuration);
		if ($uriOnly) {
			return $url;
		}
	
		$this->tag->addAttribute('href', $url);
		$this->tag->setContent($this->renderChildren());
		$ret = $this->tag->render();
		return $ret;
	}
	
	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$Tx_News_Domain_Model_News $newsItem: ...
	 * @return	[type]		...
	 */
	public function render(Tx_News_Domain_Model_News $newsItem) {
		if (version_compare(TYPO3_version, '6.3', '>')) {
			(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
			(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
			(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
		}
		$settings = array();
		$uriOnly = FALSE;
		$configuration = array();
		$code='';
		$tsSettings = $this->pluginSettingsService->getSettings();

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments',
				'external_prefix=' . $GLOBALS['TYPO3_DB']->fullQuoteStr('tx_news_pi1', 'tx_toctoc_comments_comments') .
				' AND external_ref=' . $GLOBALS['TYPO3_DB']->fullQuoteStr('tx_news_domain_model_news_' . $newsItem->getUid(), 'tx_toctoc_comments_comments') .
				' AND approved=1 AND hidden = 0 AND deleted= 0');
		$commentCount= $recs[0]['t'];
		if (!$this->cObj) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}

		$conftc=array();
		$conftc= $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];

		if (is_array($tsSettings['toctoc_comments.'])) {
			// stuff to merge
			$conftc = array_replace_recursive($conftc, $tsSettings['toctoc_comments.']);
		}

		$templateName = $commentCount ? '###TXNEWS_COMMENT_COUNT_SUB###' : '###TXNEWS_COMMENT_NONE_SUB###';

		if (($template = $this->getTemplate($templateName, $conftc))) {
			$lang = t3lib_div::makeInstance('language');
			/* @var $lang language */
			$lang->init($GLOBALS['TSFE']->lang);
			$commenttextoption=0;
			if (is_array($tsSettings['toctoc_comments.'])) {
				$commenttextoption= intval($tsSettings['toctoc_comments.']['commentsShowCountText']);
			}
			$configuration['parameter'] = $newsItem->getExternalurl();
			if ($commenttextoption==0) {
				if ($commentCount==1) {
					$commenttextnb=$lang->sL('LLL:EXT:toctoc_comments/locallang_hooks.xml:comments_number_one');
				} else {
					$commenttextnb = sprintf($lang->sL('LLL:EXT:toctoc_comments/locallang_hooks.xml:comments_number'), $commentCount);
				}

				$code = $this->cObj->substituteMarkerArray(
						$template, array(
								'###COMMENTS_COUNT_NUMBER###' => $commentCount,
								'###COMMENTS_COUNT###' => $commenttextnb,
								'###COMMENTS_COUNT_NONE###' => $lang->sL('LLL:EXT:toctoc_comments/locallang_hooks.xml:comments_number_none'),
								'###UID###' => $newsItem->getUid(),
								'###COMMENTS_LINK###' => $this->rendererLink($newsItem, $tsSettings, TRUE, $configuration),
						)
				);
			} else {
				$code = $this->cObj->substituteMarkerArray(
						$template, array(
								'###COMMENTS_COUNT_NUMBER###' => intval($commentCount),
								'###COMMENTS_COUNT###' => intval($commentCount),
								'###COMMENTS_COUNT_NONE###' => '0',
								'###UID###' => $newsItem->getUid(),
								'###COMMENTS_LINK###' => $this->rendererLink($newsItem, $tsSettings, TRUE, $configuration),
						)
				);
			}

			unset($lang);
		}
		return $code;
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
	private function getTemplate($section, $conf) {
		// Search for file
		if (isset($conf['commentsTemplateFile'])) {
			$file = $conf['commentsTemplateFile'];
		} elseif (isset($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.']['templateFile'])) {
			$file = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.']['templateFile'];
		} else {
			// Use default
			$file = 'EXT:toctoc_comments/res/template/toctoccomments_template.html';
		}

		if (($template = $this->cObj->fileResource($file))) {
			$template = $this->cObj->getSubpart($template, $section);
		}

		return $template;
	}
}

