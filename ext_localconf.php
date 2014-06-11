<?php

if (!defined ('TYPO3_MODE')) die('Access denied.');

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.toctoc_comments_pi1.php', '_pi1', 'list_type', 1);
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi2/class.toctoc_comments_felogin_pi1.php', '_pi1', 'list_type', 1);

t3lib_extMgm::addLLrefForTCAdescr('xEXT_toctoc_comments', 'EXT:toctoc_comments/pi1/locallang_csh.xml');
t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.toctoc_comments_pi1.list', 'EXT:toctoc_comments/pi1/locallang_csh.xml');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_toctoc_comments_ipbl_local=1
');

// TCEmain hook to remove comments if referenced item is removed
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['toctoc_comments'] = 'EXT:toctoc_comments/class.user_toctoc_comments_tcemain.php:user_toctoc_comments_tcemain';

// Page module hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['toctoc_comments_pi1'][] = 'EXT:toctoc_comments/class.user_toctoc_comments_cms_layout.php:user_toctoc_comments_cms_layout->getExtensionSummary';

// eID
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['toctoc_comments'] = 'EXT:toctoc_comments/class.toctoc_comments_eID.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['toctoc_comments_ajax'] = 'EXT:toctoc_comments/class.toctoc_comments_ajax.php';

// Extra markers hook for tt_news
if (t3lib_extMgm::isLoaded('tt_news')) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['extraItemMarkerHook'][$_EXTKEY] = 'EXT:toctoc_comments/class.user_toctoc_comments_ttnews.php:&user_toctoc_comments_ttnews';
}

// Register cache 'toctoc_comments_cache' just if TYPO3 4.3-4.5
if (version_compare(TYPO3_version, '4.6', '<')) {
	if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache'] = array();
	}

	// Define string frontend as default frontend, this must be set with TYPO3 4.5 and below
	// and overrides the default variable frontend of 4.6
	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['frontend'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['frontend'] = 't3lib_cache_frontend_StringFrontend';
	}

	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['backend'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['backend'] = 't3lib_cache_backend_DbBackend';
	}

	// Define data and tags table for 4.5 and below (obsolete in 4.6)
	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options'] = array();
	}

	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options']['cacheTable'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options']['cacheTable'] = 'tx_toctoc_comments_cache';
	}

	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options']['tagsTable'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options']['tagsTable'] = 'tx_toctoc_comments_cache_tags';
	}
}

?>