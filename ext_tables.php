<?php

if (!defined('TYPO3_MODE')) die('Access denied.');

// Add static files for plugins
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/', 'AJAX Commenting system');

// Add pi1 plugin
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform';
t3lib_extMgm::addPlugin(Array('LLL:EXT:toctoc_comments/pi1/locallang.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'), 'list_type');
if (version_compare(TYPO3_version, '4.2', '<')) {
	// Pre-4.2 dies if flexform has references to sheets
	require_once(t3lib_extMgm::extPath('toctoc_comments', 'flexform_functions.php'));
	t3lib_extMgm::addPiFlexFormValue($_EXTKEY .'_pi1', toctoc_comments_makeTempFlexFormDS());
}
else {
	// 4.2 or newer works fine with flexforms
	t3lib_extMgm::addPiFlexFormValue($_EXTKEY .'_pi1', 'FILE:EXT:toctoc_comments/pi1/flexform_ds.xml');
}

// Comments table
$TCA['tx_toctoc_comments_comments'] = array(
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments',
		'label' => 'content',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'default_sortby' => ' ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments.gif',
		//'type' => 'approved',
		'typeicon_column' => 'approved',
		'typeicons' => array(
			'0' => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_toctoc_comments_not_approved.gif',
			'1' => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_toctoc_comments.gif',
		),
	)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_comments');
t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_comments');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_comments', 'EXT:toctoc_comments/locallang_csh.php');

// Comments to FeUser table
$TCA['tx_toctoc_comments_feuser_mm'] = array(
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm',
		'label' => 'remote_addr',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_feuser_mm.gif',
	)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_feuser_mm');
t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_feuser_mm');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_feuser_mm', 'EXT:toctoc_comments/locallang_csh.php');

// Comments to Comments User
$TCA['tx_toctoc_comments_user'] = array(
		'ctrl' => array (
				'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user',
				'label' => 'toctoc_comments_user',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'sortby' => 'crdate',
				'delete' => 'deleted',
				'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
				'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_user.gif',
		)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_user');
t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_user');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_user', 'EXT:toctoc_comments/locallang_csh.php');

// URL log table
$TCA['tx_toctoc_comments_urllog'] = array(
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_urllog',
		'label' => 'external_ref',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'external_ref',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_urllog.gif',
	)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_urllog');
t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_urllog');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_urllog', 'EXT:toctoc_comments/locallang_csh.php');


if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['user_toctoc_comments_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.user_toctoc_comments_pi1_wizicon.php';
}

// from ratings

$TCA['tx_toctoc_ratings_data'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data',
		'label'     => 'reference',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate DESC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_ratings_data.gif',
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,
		'readOnly'	=> $toctoc_ratings_debug_mode_disabled,
	),
);

$TCA['tx_toctoc_ratings_iplog'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog',
		'label'     => 'reference',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate DESC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_ratings_iplog.gif',
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,
		'readOnly'	=> $toctoc_ratings_debug_mode_disabled,
	),
);

$TCA['tx_toctoc_comments_spamwords'] = array (
		'ctrl' => array (
				'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_spamwords',
				'label'     => 'spamword',
				'tstamp'    => 'tstamp',
				'crdate'    => 'crdate',
				'cruser_id' => 'cruser_id',
				'default_sortby' => 'ORDER BY spamword',
				'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
				'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_spamwords.gif',
		),
);

t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_ratings_data');
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_ratings_iplog');
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_spamwords');

// from comment_feuser
$tempColumns = Array (
	'toctoc_commentsfeuser_feuser' => Array (
		'exclude' => 1,
		'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser',
		'config' => Array (
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'fe_users',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	),
);

t3lib_div::loadTCA('tx_toctoc_comments_comments');
t3lib_extMgm::addTCAcolumns('tx_toctoc_comments_comments',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tx_toctoc_comments_comments','toctoc_commentsfeuser_feuser;;;;1-1-1');

# Firstname should not be required as we are now expecting a frontend user record
$TCA['tx_toctoc_comments_comments']['columns']['firstname']['config']['eval'] = 'trim';


// from commentbe

if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_toctoccommentsbeM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
	t3lib_extMgm::addModule('web', 'toctoccommentsbeM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}
?>