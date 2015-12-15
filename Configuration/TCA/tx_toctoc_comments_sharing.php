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

$tx_toctoc_comments_comments = [
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing',
		'label' => 'sharer',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'default_sortby' => ' ORDER BY crdate DESC',
		'delete' => 'deleted',
		'iconfile' => 'EXT:toctoc_comments/icon_tx_toctoc_comments_sharing.gif',
	),
	'interface' => array (
		'showRecordFieldList' => 'external_ref, external_prefix, reference, sys_language_uid, sharer, shareurl, sharecount',
		'maxDBListItems' => 50,
	),
	'columns' => array (
			'sharer' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.sharer',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
							'readOnly' => 1,
					)
			),
			'shareurl' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.shareurl',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
							'readOnly' => 1,
					),
			),
			'crdate' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.crdate',
					'config' => array (
							'type'     => 'input',
							'size'     => '22',
							'max'      => '16',
							'eval'     => 'datetime',
							'readOnly' => 1,
					)
			),
			'sharecount' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.sharecount',
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
							'readOnly' => 1,
							'default' => 0
					)
			),
			'external_ref' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.external_ref',
					'config' => array (
							'type' => 'group',
							'internal_type' => 'db',
							'prepand_tname' => TRUE,
							'allowed' => '*',
							'minsize' => 1,
							'maxsize' => 1,
							'size' => 1,
							'wizards' => array (
									'_PADDING' => 1,
									'_VERTICAL' => 1,
									'edit' => array (
											'type' => 'popup',
											'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref.wizard',
											$scriptelem => $scriptcontent,
											'popup_onlyOpenIfSelected' => 1,
											'icon' => 'edit2.gif',
											'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
									),
							),
							'readOnly' => 1,
					),
					
			),
			'external_prefix' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.external_prefix',
					'config' => array (
							'type' => 'input',
							'size' => 15,
							'eval' => 'trim,alphanum_x,required',
							'readOnly' => 1,
					),
			),
			
			'reference' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_sharing.reference',
					'config' => array (
							'type' => 'group',
							'internal_type' => 'db',
							'prepand_tname' => TRUE,
							'allowed' => 'pages',
							'minsize' => 1,
							'maxsize' => 1,
							'size' => 1,
							'wizards' => array (
									'_PADDING' => 1,
									'_VERTICAL' => 1,
									'edit' => array (
											'type' => 'popup',
											'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref.wizard',
											$scriptelem => $scriptcontent,
											'popup_onlyOpenIfSelected' => 1,
											'icon' => 'edit2.gif',
											'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
									),
							),
							'readOnly' => 1,
					),
			),
			'sys_language_uid' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
					'config' => array (
							'type' => 'select',
							'readOnly' => 1,
							'foreign_table' => 'sys_language',
							'foreign_table_where' => 'ORDER BY sys_language.title',
							'items' => array(
									array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
									array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
							)
					)
			),
			
	),
	'types' => array (
			0 => array ('showitem' => 'hidden;;;;1,external_ref, external_prefix, reference, sys_language_uid;;;;2-2-2,sharer;;;;3-3-3,crdate,shareurl,sharecount'),
	),
];
	
return $tx_toctoc_comments_comments;
?>