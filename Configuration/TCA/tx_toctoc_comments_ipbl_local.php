<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$tx_toctoc_comments_comments = array(
	'ctrl' => array (
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local',
		'label'     => 'ipaddr',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY ipaddr',
		'iconfile'          => 'EXT:toctoc_comments/icon_tx_toctoc_comments_ipbl_local.gif',
		'rootLevel' => -1,
	),
'interface' => array (
		'showRecordFieldList' => 'ipaddr,blockfe,comment'
	),
	'columns' => array (
		'ipaddr' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.ipaddr',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim,nospace,unique',
			)
		),
		'blockfe' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.blockfe',
			'config' => array (
					'type' => 'check',
					'default' => '0'
			)
		),
		'crdate' => array (
			'excude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.crdate',
			'config' => array (
				'type' => 'input',
				'eval' => 'tx_toctoc_comments_ipbl_hooks,datetime',
				'readOnly' => TRUE,
				'default' => time(),
			),
		),
		'comment' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.comment',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'ipaddr,blockfe;;;;1-1-1, crdate, comment')
	),
	'palettes' => array (
		'1' => array ('showitem' => '')
	),
);
	
return $tx_toctoc_comments_comments;
?>