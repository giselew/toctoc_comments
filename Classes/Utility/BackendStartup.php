<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
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
$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/mod1/locallang.xml');
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(PATH_t3lib . 'class.t3lib_scbase.php');
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Module/BaseScriptClass.php';
}

// DEFAULT initialization of a module [END]


if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_SCbase', FALSE) || interface_exists('t3lib_SCbase', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Backend\Module\BaseScriptClass', 't3lib_SCbase');
	(class_exists('t3lib_extMgm', FALSE) || interface_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('bigDoc', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Backend\Template\DocumentTemplate', 'bigDoc');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
	if ((!t3lib_extMgm::isLoaded('compatibility6')) && (!t3lib_extMgm::isLoaded('compatibility7')))  {
		(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
	}
}

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_BEfunc', FALSE) || interface_exists('t3lib_BEfunc', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Backend\Utility\BackendUtility', 't3lib_BEfunc');
}
require_once (t3lib_extMgm::extPath('toctoc_comments', 'class.user_toctoc_comments_toctoc_comments.php'));
require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Utility/BackendUtilities.php'));

if (version_compare(TYPO3_version, '7.0.99', '>')) {
	$modulePath=t3lib_extMgm::extPath('toctoc_comments', 'mod1/');
	$MCONF = array();
	$MCONF = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::configureModule('web_toctoccommentsbeM1', $modulePath);
}
?>