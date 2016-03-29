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

$tx_toctoc_comments_comments = array(
	'ctrl' => array (
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog',
		'label'     => 'reference',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate DESC',
		'iconfile' => 'EXT:toctoc_comments/icon_tx_toctoc_comments_ratings_iplog.gif',
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,
		'readOnly'	=> $toctoc_ratings_debug_mode_disabled,
	),	
	'columns' => array (
		'reference' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog.reference',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => '*',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'readOnly' => 1,
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
		'crdate' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog.crdate',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'datetime',
				'readOnly' => $toctoc_ratings_debug_mode_disabled,
			)
		),
		'ip' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog.ip',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'trim',
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'reference,reference_scope;;;;1-1-1, crdate, ip')
	),
);
	
return $tx_toctoc_comments_comments;
?>