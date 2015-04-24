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
 *   56: class user_toctoc_comments_pi1_wizicon
 *   64:     public function proc($wizardItems)
 *   84:     protected function includeLocalLang()
 *  100:     protected function getLlxmlParser()
 *
 * TOTAL FUNCTIONS: 3
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

/**
 * Class that adds the wizard icon.
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	(class_exists('t3lib_l10n_parser_Llxml', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Localization\Parser\LocallangXmlParser', 't3lib_l10n_parser_Llxml');
}

	/**
	 * [Describe function...]
	 *
	 */
class user_toctoc_comments_pi1_wizicon {
	protected $llxmlParser;
	/**
	 * Processing the wizard items array
	 *
	 * @param	array		$wizardItems: The wizard items
	 * @return	array		Modified array with wizard items
	 */
	public function proc($wizardItems)	{
		$LL = $this->includeLocalLang();
		$wizardItems['plugins_toctoc_comments_pi1'] = array(
			'icon'=>t3lib_extMgm::extRelPath('toctoc_comments').'pi1/ce_wiz.gif',
			'title'=>$GLOBALS['LANG']->getLLL('tt_content.list_type_pi1', $LL),
			'description'=>$GLOBALS['LANG']->getLLL('pi1_plus_wiz_description', $LL),
			'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=toctoc_comments_pi1'
		);

		return $wizardItems;
	}

	/**
	 * Reads the [extDir]/locallang.xml and returns the $LOCAL_LANG array found in that file.
	 *
	 * @return	array		The array with language labels
	 */
	protected function includeLocalLang()	{

		$charset = '';
		$llFile = t3lib_extMgm::extPath('toctoc_comments').'pi1/locallang.xml';
		if (version_compare(TYPO3_version, '4.8', '<')) {
			$LOCAL_LANG = t3lib_div::readLLXMLfile($llFile, $GLOBALS['LANG']->lang, $charset);
		} else {
			$LOCAL_LANG = $this->getLlxmlParser()->getParsedData($llFile, $GLOBALS['LANG']->lang, $charset);
		}

		return $LOCAL_LANG;
	}

	/**
	 * @return	t3lib_l10n_parser_Llxml
	 */
	protected function getLlxmlParser() {
		if (!isset($this->llxmlParser)) {
			$this->llxmlParser = t3lib_div::makeInstance('t3lib_l10n_parser_Llxml');
		}

		return $this->llxmlParser;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.user_toctoc_comments_pi1_wizicon.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/class.user_toctoc_comments_pi1_wizicon.php']);
}
?>