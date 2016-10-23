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
if (version_compare(TYPO3_version, '7.9', '>')) {
	$configlink = 'actions-open';
} else {
	$configlink = array (
							'type' => 'popup',
							'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref.wizard',
							$scriptelem => $scriptcontent,
							'popup_onlyOpenIfSelected' => 1,
							'icon' => 'edit2.gif',
							'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						);
}

if (version_compare(TYPO3_version, '7.6', '<')) {
	$iconfilepath = t3lib_extMgm::extRelPath('toctoc_comments');
} else {
	$iconfilepath = 'EXT:toctoc_comments/';
}

$tx_toctoc_comments_comments = array(
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable',
		'label' => 'pi1_key',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'default_sortby' => ' ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
				'disabled' => 'hidden',
		),
		'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_prefixtotable.gif',
	),
	'interface' => array (
			'showRecordFieldList' => 'pi1_key,pi1_table,show_uid,displayfields,topratingsdetailpage,topratingsimagesfolder',
			'maxDBListItems' => 50,
	),
	'columns' => array (
			'pi1_key' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable.pi1_key',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
					)
			),
			'pi1_table' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable.pi1_table',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
					),
			),
			'show_uid' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable.show_uid',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'displayfields' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable.displayfields',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'topratingsdetailpage' => array (
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable.topratingsdetailpage',
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
						'edit' => $configlink,
					),
				),
			),
			'topratingsimagesfolder' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_prefixtotable.topratingsimagesfolder',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
	),
	'types' => array (
			0 => array ('showitem' => 'hidden,pi1_key,pi1_table,show_uid,displayfields,topratingsdetailpage,topratingsimagesfolder'),
	),
);
	
return $tx_toctoc_comments_comments;
?>