<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

$scriptelem = 'module';
$scriptcontent = array(
	'name' => 'wizard_element_browser',
	'urlParameters' => array(
		'mode' => 'wizard',
		'act' => 'edit'
	)
);
		
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$tx_toctoc_comments_sysconf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
$toctoc_ratings_debug_mode_disabled = !intval($tx_toctoc_comments_sysconf['debugMode']);

$tx_toctoc_comments_comments = [
	'ctrl' => array (
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data',
		'label'     => 'reference',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate DESC',
		'iconfile'          => 'EXT:toctoc_comments/icon_tx_toctoc_comments_ratings_data.gif',
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,
		'readOnly'	=> $toctoc_ratings_debug_mode_disabled,
	),
	'interface' => array (
			'showRecordFieldList' => 'reference,reference_scope,url,rating,vote_count',
			'maxDBListItems' => 50,
	),
	'columns' => array (
		'reference' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.reference',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => '*',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			)
		),
		'reference_scope' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.reference_scope',
			'config' => array (
				'type' => 'input',
				'eval'     => 'int',
				'default' => 0,
				'readOnly' => 1,			
			)
		),
		'rating' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.rating',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '10000000',
					'lower' => '0'
				),
				'default' => 0
			)
		),
		'vote_count' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.vote_count',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '10000000',
					'lower' => '0'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'reference,reference_scope;;;;1-1-1, rating, vote_count')
	),
];
	
return $tx_toctoc_comments_comments;
?>