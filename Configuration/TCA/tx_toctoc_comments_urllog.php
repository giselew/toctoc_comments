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
			'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_urllog',
			'label' => 'external_ref',
			'tstamp' => 'tstamp',
			'crdate' => 'crdate',
			'sortby' => 'external_ref',
			'delete' => 'deleted',
			'iconfile' => 'EXT:toctoc_comments/icon_tx_toctoc_comments_urllog.gif',
			'hideTable'	=> $toctoc_ratings_debug_mode_disabled,
	
		),
	'interface' => array (
		'showRecordFieldList' => 'external_ref,url,external_ref_uid',
		'maxDBListItems' => 50,
	),
	'columns' => array (
		'external_ref' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref',
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
			),
		),
		'url' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_urllog.url',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim,required',
			),
		),
		'external_ref_uid' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid',
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
						'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid.wizard',
						$scriptelem => $scriptcontent,
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			),
		),
	),
	'types' => array (
		0 => array ('showitem' => 'external_ref,external_ref_uid;;;;1,url'),
	),
);
	
return $tx_toctoc_comments_comments;
?>