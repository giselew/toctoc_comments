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
		'title'     => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_spamwords',
		'label'     => 'spamword',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY spamword',
		'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_spamwords.gif',
	),
	'interface' => array (
			'showRecordFieldList' => 'spamword,spamvalue',
			'maxDBListItems' => 50,
	),
	'columns' => array (
			'hidden' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
					'config' => array (
							'type' => 'check',
							'default' => '0'
					)
			),

			'spamword' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_spamwords.spamword',
					'config' => array (
						'type' => 'input',
						'eval' => 'trim,required',
					),
			),
			'spamvalue' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_spamwords.spamvalue',
					'config' => array (
							'type'     => 'input',
							'size'     => '2',
							'max'      => '2',
							'eval'     => 'int,required',
							'checkbox' => '0',
							'range'    => array (
									'upper' => '10',
									'lower' => '1'
							),
							'default' => 1
					)
			),
			'sys_language_uid' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
					'config' => array (
							'type' => 'select',
							'foreign_table' => 'sys_language',
							'foreign_table_where' => 'ORDER BY sys_language.title',
							'items' => array (
									array ('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
									array ('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
							)
					)
			),
	),
	'types' => array (
			0 => array ('showitem' => 'hidden;;;;1,spamword;;;;2-2-2,spamvalue,sys_language_uid'),
	),
);
	
return $tx_toctoc_comments_comments;
?>