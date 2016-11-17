<?php

if (!defined ('TYPO3_MODE')) die('Access denied.');
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}
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

// Add a hook to the login form
if (t3lib_extMgm::isLoaded('rsaauth')) {
	if (version_compare(TYPO3_version, '6.1', '>')) {
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs']['rsaauth'] = 'TYPO3\\CMS\\Rsaauth\\Hook\\FrontendLoginHook->loginFormHook';
	} elseif (version_compare(TYPO3_version, '4.9', '>')) {
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs']['rsaauth'] = 'EXT:rsaauth/hooks/class.tx_rsaauth_feloginhook.php:TYPO3\\CMS\\Rsaauth\\Hook\\FrontendLoginHook->loginFormHook';
	} else {
		$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['loginFormOnSubmitFuncs']['rsaauth'] = 'EXT:rsaauth/hooks/class.tx_rsaauth_feloginhook.php:tx_rsaauth_feloginhook->loginFormHook';
	}
}
// eID
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['toctoc_comments'] = 'EXT:toctoc_comments/class.toctoc_comments_eID.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['toctoc_comments_ajax'] = 'EXT:toctoc_comments/class.toctoc_comments_ajax.php';

// Extra markers hook for tt_news
if (t3lib_extMgm::isLoaded('tt_news')) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['extraItemMarkerHook'][$_EXTKEY] = 'EXT:toctoc_comments/class.user_toctoc_comments_ttnews.php:&user_toctoc_comments_ttnews';
}
// get extension confArr
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
if (!isset($confArr['enableRealURLAutoConfiguration']) || $confArr['enableRealURLAutoConfiguration']) {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['toctoc_comments'] = 'GiseleWendl\\ToctocComments\\Hooks\\RealUrl->addRealURLConfig';
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