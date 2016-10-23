<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

if (version_compare(TYPO3_version, '7.6', '<')) {
	$iconfilepath = t3lib_extMgm::extRelPath('toctoc_comments');
} else {
	$iconfilepath = 'EXT:toctoc_comments/';
}

$tx_toctoc_comments_comments = array(
	'ctrl' => array (
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_static',
		'label'     => 'ipaddr',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY ipaddr',
		'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_ipbl_static.gif',
	),
	'interface' => array (
		'showRecordFieldList' => 'ipaddr,comment'
	),
	'columns' => array (
		'ipaddr' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_static.ipaddr',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim,nospace,unique',
			)
		),
		'comment' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_static.comment',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'ipaddr,comment')
	),
);
	
return $tx_toctoc_comments_comments;
?>