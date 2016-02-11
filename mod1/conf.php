<?php

	// DO NOT REMOVE OR CHANGE THESE 2 LINES:
	$MCONF['name'] = 'web_toctoccommentsbeM1';
	$MCONF['script'] = '_DISPATCH';
	
	$MCONF['access'] = 'user,group';
	$act = '';
	$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
	$newsince = intval($extConf['new_Hours']);
	if ($newsince== 0) {
		$newsince = 6;
	}
	
	$newsince = time() - $newsince*3600;
	$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_comments', 'crdate > ' . $newsince);
	if (count($recs)>0) {
		if ($recs[0]['t'] != 0) {
			// new comments
			$act .= 'c';
		}
	}
	$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('count(*) AS t', 'tx_toctoc_comments_user', 'crdate > ' . $newsince);
	if (count($recs)>0) {
		if ($recs[0]['t'] != 0) {
			// new users
			$act .= 'u';
		}
	}
	
	if (version_compare(TYPO3_version, '6.3', '<')) {
		$MLANG['default']['tabs_images']['tab'] = 'moduleicon' . $act . '.gif';
	} else {
		$MLANG['default']['tabs_images']['tab'] = 'CommentsModuleIcon' . $act . '.png';
	}
	
	$MLANG['default']['ll_ref'] = 'LLL:EXT:toctoc_comments/mod1/locallang_mod.xml';
	
?>