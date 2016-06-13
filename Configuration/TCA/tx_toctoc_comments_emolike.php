<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

$scriptelem = 'module';
$scriptcontent = array(
		'name' => 'wizard_element_browser',
		'urlParameters' => array(
				'mode' => 'wizard',
				'act' => 'edit'
		)
);
if (version_compare(TYPO3_version, '7.6', '<')) {
	$iconfilepath = t3lib_extMgm::extRelPath('toctoc_comments');
} else {
	$iconfilepath = 'EXT:toctoc_comments/';
}

$tx_toctoc_comments_comments = array(
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike',
		'label' => 'emolike_ll',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'emolike_setfolder',
		'default_sortby' => ' ORDER BY emolike_setfolder',
		'delete' => 'deleted',
		'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_emolike.gif',
	),
	'interface' => array (
					'showRecordFieldList' => 'emolike_setfolder,emolike_setpos,emolike_sort,emolike_ll,emolike_colorcode,emolike_rating,emolike_engagement',
					'maxDBListItems' => 50,
			),
	'columns' => array (					
			'emolike_setfolder' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_setfolder',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
							'default' => 'default'
					),
			),
			'emolike_setpos' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_setpos',
					'config' => array (
							'type'     => 'input',
							'size'     => '4',
							'max'      => '4',
							'eval'     => 'int,required',
							'checkbox' => '0',
							'range'    => array (
								'upper' => '5',
								'lower' => '1'
							),
							'default' => 1
					),
			),'emolike_sort' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_sort',
					'config' => array (
							'type'     => 'input',
							'size'     => '4',
							'max'      => '4',
							'eval'     => 'int,required',
							'checkbox' => '0',
							'range'    => array (
								'upper' => '5',
								'lower' => '1'
							),
							'default' => 1
					),
			),
			
			'emolike_ll' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_ll',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
					)
			),
			
			'emolike_colorcode' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_colorcode',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					)
			),
			
			'emolike_rating' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_rating',
					'config' => array (
							'type'     => 'input',
							'size'     => '4',
							'max'      => '4',
							'eval'     => 'int,required',
							'checkbox' => '0',
							'range'    => array (
								'upper' => '9',
								'lower' => '1'
							),
							'default' => 5
					),
			),
			'emolike_engagement' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_emolike.emolike_engagement',
					'config' => array (
							'type'     => 'input',
							'size'     => '4',
							'max'      => '4',
							'eval'     => 'int,required',
							'checkbox' => '0',
							'range'    => array (
								'upper' => '9',
								'lower' => '1'
							),
							'default' => 5
					),
			),
	),
	'types' => array (
					0 => array ('showitem' => 'emolike_setfolder,emolike_setpos;;;;1-1-1,emolike_sort;;;;2-2-2,emolike_ll,emolike_colorcode,emolike_rating,emolike_engagement'),
				),
);
	
return $tx_toctoc_comments_comments;
?>