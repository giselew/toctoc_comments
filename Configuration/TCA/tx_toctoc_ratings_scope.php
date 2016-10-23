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
					'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_scope',
					'label' => 'scope_title',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l18n_parent',
					'transOrigDiffSourceField' => 'l18n_diffsource',
					'sortby' => 'sorting',
					'delete' => 'deleted',
					'enablecolumns' => array (
						'disabled' => 'hidden',
					),
					'origUid' => 't3_origuid',
					'shadowColumnsForNewPlaceholders' => 'sys_language_uid,l18n_parent',
					'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_ratings_scope.gif',
			),
			'interface' => array (
					'showRecordFieldList' => 'sys_language_uid,l18n_parent,l18n_diffsource,hidden,scope_title,scope_description,display_order'
			),
			'columns' => array (
					'sys_language_uid' => array (
							'exclude' => 1,
							'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
							'config' => array (
									'type' => 'select',
									'renderType' => 'selectSingle',
									'foreign_table' => 'sys_language',
									'foreign_table_where' => 'ORDER BY sys_language.title',
									'items' => array(
											array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
											array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
									)
							)
					),
					'l18n_parent' => array (
							'displayCond' => 'FIELD:sys_language_uid:>:0',
							'exclude' => 1,
							'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
							'config' => array (
									'type' => 'select',
									'renderType' => 'selectSingle',
									'items' => array (
											array('', 0),
									),
									'foreign_table' => 'tx_toctoc_ratings_scope',
									'foreign_table_where' => 'AND tx_toctoc_ratings_scope.pid=###CURRENT_PID### AND tx_toctoc_ratings_scope.sys_language_uid IN (-1,0)',
							)
					),
					'l18n_diffsource' => array (
							'config' => array (
									'type' => 'passthrough'
							)
					),
					'hidden' => array (
							'exclude' => 1,
							'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
							'config' => array (
									'type' => 'check',
									'default' => '0'
							)
					),
	
					'scope_title' => array (
							'exclude' => 1,
							'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_scope.scope_title',
							'config' => array (
									'type' => 'input',
									'size' => '32',
									'max' => '128',
									'eval' => 'trim,required',
							)
					),
					'scope_description' => array (
							'exclude' => 1,
							'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_scope.scope_description',
							'config' => array (
									'type' => 'text',
									'cols' => '40',
									'rows' => '4',
									'eval' => 'trim,required',							
							)
					),
	
					'display_order' => array (
							'exclude' => 1,
							'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_scope.display_order',
							'config' => array (
									'type' => 'input',
									'size' => '5',
									'max' =>  '8',
							)
					),
					't3ver_label' => array (
							'displayCond' => 'FIELD:t3ver_label:REQ:true',
							'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
							'config' => array (
									'type'=>'none',
									'cols' => 27
							)
					),
			),
			'types' => array (
					'0' => array('showitem' => 'sys_language_uid,l18n_parent,l18n_diffsource,hidden,scope_title,scope_description,display_order')
			),
	);
	
return $tx_toctoc_comments_comments;
?>