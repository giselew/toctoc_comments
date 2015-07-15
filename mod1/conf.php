<?php

	// DO NOT REMOVE OR CHANGE THESE 2 LINES:
	$MCONF['name'] = 'web_toctoccommentsbeM1';
	$MCONF['script'] = '_DISPATCH';
	
	$MCONF['access'] = 'user,group';
	if (version_compare(TYPO3_version, '6.3', '<')) {
		$MLANG['default']['tabs_images']['tab'] = 'moduleicon.gif';
	} else {
		$MLANG['default']['tabs_images']['tab'] = 'CommentsModuleIcon.png';
	}
	$MLANG['default']['ll_ref'] = 'LLL:EXT:toctoc_comments/mod1/locallang_mod.xml';
	
?>