<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['toctoc_comments_pi1'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['toctoc_comments_pi1'] = 'pi_flexform';

// Add static files for plugins
t3lib_extMgm::addStaticFile('toctoc_comments', 'static/', 'AJAX Social Network Components');

t3lib_extMgm::addPiFlexFormValue('toctoc_comments_pi1', 'FILE:EXT:toctoc_comments/pi1/flexform_ds.xml');

?>