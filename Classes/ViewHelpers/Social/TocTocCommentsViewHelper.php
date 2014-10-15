<?php
/***************************************************************
 *  Copyright notice
 *  (c) 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * <div id="toctoccomments_thread">
 * <nt:social.TocTocComments newsItem="{newsItem}"></nt:social.TocTocComments>
 * </div>
 *
 * @package TYPO3
 * @subpackage tx_news
 */
class Tx_News_ViewHelpers_Social_TocTocCommentsViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

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
	 * @return	string
	 */
	public function render(Tx_News_Domain_Model_News $newsItem) {
		$tsSettings = $this->pluginSettingsService->getSettings();
		include_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_pi1.php'));
		$lib = new tx_toctoccomments_pi1;

		$content='';
		if (!$this->cObj) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}

		$conftc=array();
		$conftc= $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];

		if (is_array($tsSettings['toctoc_comments.'])) {
			$conftc = array_replace_recursive($conftc, $tsSettings['toctoc_comments.']);
		}

		$code = $lib->main($content, $conftc, 'tx_news_pi1', $newsItem->getUid(), $this->cObj);
		unset($lib);
		return $code;
	}
}

