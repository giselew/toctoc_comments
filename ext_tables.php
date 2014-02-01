<?php

if (!defined('TYPO3_MODE')) die('Access denied.');

// Add static files for plugins
t3lib_extMgm::addStaticFile($_EXTKEY, 'static/', 'AJAX Social Network Components');

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

t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.toctoc_comments_pi1.list', 'EXT:toctoc_comments/pi1/locallang_csh.xml');

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
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_comments');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_comments', 'EXT:toctoc_comments/locallang_csh.xml');

// Comments to FeUser table
$TCA['tx_toctoc_comments_feuser_mm'] = array(
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm',
		'label' => 'toctoc_comments_user',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'delete' => 'deleted',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_feuser_mm.gif',
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,

	)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_feuser_mm');
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_feuser_mm');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_feuser_mm', 'EXT:toctoc_comments/locallang_csh.xml');

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
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_user');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_user', 'EXT:toctoc_comments/locallang_csh.xml');

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
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,

	)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_urllog');
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_urllog');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_urllog', 'EXT:toctoc_comments/locallang_csh.xml');


if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['user_toctoc_comments_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.user_toctoc_comments_pi1_wizicon.php';
}

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
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_ratings_data');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_ratings_data', 'EXT:toctoc_comments/locallang_csh.xml');

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
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_ratings_iplog');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_ratings_iplog', 'EXT:toctoc_comments/locallang_csh.xml');

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
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_spamwords');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_spamwords', 'EXT:toctoc_comments/locallang_csh.xml');

// Attachments table
$TCA['tx_toctoc_comments_attachment'] = array(
		'ctrl' => array (
				'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment',
				'label' => 'title',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'sortby' => 'crdate',
				'default_sortby' => ' ORDER BY crdate DESC',
				'delete' => 'deleted',
				//'where' => 'tx_toctoc_comments_attachment.attachmentvariant = 1',
				'enablecolumns' => array (
						'disabled' => 'hidden',
				),
				'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
				'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_attachment.gif',
				'MM' => 'tx_toctoc_comments_attachment_mm',

		)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_attachment');
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_comments');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_attachment', 'EXT:toctoc_comments/locallang_csh.xml');


// prefixtotable table
$TCA['tx_toctoc_comments_prefixtotable'] = array(
		'ctrl' => array (
				'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable',
				'label' => 'pi1_key',
				'tstamp' => 'tstamp',
				'crdate' => 'crdate',
				'sortby' => 'crdate',
				'default_sortby' => ' ORDER BY crdate DESC',
				'delete' => 'deleted',
				//'where' => 'tx_toctoc_comments_attachment.attachmentvariant = 1',
				'enablecolumns' => array (
						'disabled' => 'hidden',
				),
				'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
				'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_prefixtotable.gif',

		)
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_prefixtotable');
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_comments');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_prefixtotable', 'EXT:toctoc_comments/locallang_csh.xml');

$TCA['tx_toctoc_comments_ipbl_local'] = array (
		'ctrl' => array (
				'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local',
				'label'     => 'ipaddr',
				'tstamp'    => 'tstamp',
				'crdate'    => 'crdate',
				'cruser_id' => 'cruser_id',
				'default_sortby' => 'ORDER BY ipaddr',
				'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
				'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_ipbl_local.gif',
				'rootLevel' => -1,
		),
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_ipbl_local');
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_comments');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_ipbl_local', 'EXT:toctoc_comments/locallang_csh.xml');

$TCA['tx_toctoc_comments_ipbl_static'] = array (
		'ctrl' => array (
				'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_static',
				'label'     => 'ipaddr',
				'tstamp'    => 'tstamp',
				'crdate'    => 'crdate',
				'cruser_id' => 'cruser_id',
				'default_sortby' => 'ORDER BY ipaddr',
				'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
				'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_toctoc_comments_ipbl_static.gif',
				'is_static'	=> true,
		),
);
t3lib_extMgm::allowTableOnStandardPages('tx_toctoc_comments_ipbl_static');
//t3lib_extMgm::addToInsertRecords('tx_toctoc_comments_comments');
t3lib_extMgm::addLLrefForTCAdescr('tx_toctoc_comments_ipbl_static', 'EXT:toctoc_comments/locallang_csh.xml');

// from commentbe
if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_toctoccommentsbeM1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
	t3lib_extMgm::addModule('web', 'toctoccommentsbeM1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}
?>