<?php
namespace GeorgRinger\News\ViewHelpers\Social;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Core\Utility\GeneralUtility;
/**
 * ViewHelper to add a toctoc_comments-plugin
 *
 * Examples
 * ==============
 *
 * <n:social.toctoccomments newsItem="{newsItem}" />
 * Result: toctoc_comments-plugin
 *
 * 
 * @package TYPO3
 * @subpackage tx_news
 */
class ToctoccommentsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	 * @var \GeorgRinger\News\Service\SettingsService
	 */
	protected $pluginSettingsService;
	
	/**
	 * @var \GeorgRinger\News\Service\SettingsService $pluginSettingsService
	 * @return void
	 */
	public function injectSettingsService(\GeorgRinger\News\Service\SettingsService $pluginSettingsService) {
		$this->pluginSettingsService = $pluginSettingsService;
	}
	
	/**
	 * Arguments initialization
	 *
	 * @return void
	 */
	public function initializeArguments() {
	}
		
	public function render(\GeorgRinger\News\Domain\Model\News $newsItem) {
		
		$tsSettings = $this->pluginSettingsService->getSettings();
		include_once (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('toctoc_comments', 'pi1/class.toctoc_comments_pi1.php'));
		$lib = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_toctoccomments_pi1');

		$content='';
		
		$conftc=array();
		$conftc= $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];

		if (is_array($tsSettings['toctoc_comments.'])) {
			$conftc = array_replace_recursive($conftc, $tsSettings['toctoc_comments.']);
		}

		$code = $lib->main($content, $conftc, 'tx_news_pi1', $newsItem->getUid());
		unset($lib);
		return $code;
	}
}