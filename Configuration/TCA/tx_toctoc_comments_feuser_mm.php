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
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm',
		'label' => 'toctoc_comments_user',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'delete' => 'deleted',
		'iconfile' => 'EXT:toctoc_comments/icon_tx_toctoc_comments_feuser_mm.gif',
		'hideTable'	=> $toctoc_ratings_debug_mode_disabled,
	),
	'interface' => array (
		'showRecordFieldList' => 'reference,reference_scope,toctoc_comments_user,ilike,idislike,myrating,remote_addr,tstampilike,pagetstampilike,tstampidislike,'.
			'pagetstampidislike,tstampmyrating,pagetstampmyrating,seen,tstampseen,pagetstampseen',
		'maxDBListItems' => 50,
		'readOnly' => 1,
	),
	'columns' => array (
		'ilike' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.ilike',
			'config' => array (
				'type' => 'check',
				'default' => 0,
			),
		),
		'idislike' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.idislike',
			'config' => array (
				'type' => 'check',
				'default' => 0,
			),
		),
		'myrating' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.myrating',
			'config' => array (
				'type' => 'input',
				'size' => '6',
				'eval' => 'trim,double12',
				'max' => '20',
				'readOnly' => 1,
			),
		),
		'remote_addr' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.remote_addr',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim,required,is_in',
				'is_in' => '0123456789.',
				'readOnly' => 1,
			),
		),
		'reference' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.reference',
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
		'isreview' => array (
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.isreview',
				'config' => array (
						'type' => 'check',
						'items' => array (
								array ('LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.isreview.I.0', '')
						),
						'default' => 0,
				),
		),
		'toctoc_comments_user' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.toctoc_comments_user',
			'config' => array (
			'type' => 'input',
			'eval' => 'trim,required,is_in',
			'is_in' => '0123456789.',
			'readOnly' => 1,
			),
		),
		'toctoc_commentsfeuser_feuser' => array (
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser',
			'config' => array (
				'type' => 'input',
				'eval'     => 'int',
				'default' => 0,
				'readOnly' => 1,
			),
		),
		'tstampilike' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.tstampilike',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'datetime',
				'readOnly' => 1,
			)
		),
		'pagetstampilike' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.pagetstampilike',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'trim',
				'readOnly' => 1,
			)
		),
		'tstampidislike' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.tstampidislike',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'datetime',
				'readOnly' => 1,
			)
		),
		'pagetstampidislike' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.pagetstampidislike',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'trim',
				'readOnly' => 1,
			)
		),
		'tstampmyrating' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.tstampmyrating',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'datetime',
				'readOnly' => 1,
			)
		),
		'pagetstampmyrating' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.pagetstampmyrating',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'trim',
				'readOnly' => 1,
			)
		),
		'seen' => array (
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.seen',
				'config' => array (
						'type' => 'input',
						'size' => '4',
						'max'      => '4',
						'eval'     => 'int',
						'checkbox' => '0',
						'default' => 0,
				),
		),
		'tstampseen' => array (
				'exclude' => 1,
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.tstampseen',
				'config' => array (
						'type'     => 'input',
						'size'     => '22',
						'max'      => '16',
						'eval'     => 'datetime',
						'readOnly' => 1,
				)
		),
		'pagetstampseen' => array (
				'exclude' => 1,
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.pagetstampseen',
				'config' => array (
						'type'     => 'input',
						'size'     => '22',
						'max'      => '16',
						'eval'     => 'trim',
						'readOnly' => 1,
				)
		),
	),
	'types' => array (
		0 => array ('showitem' => 'hidden;;;;1,reference,reference_scope;;;;2-2-2,toctoc_comments_user,toctoc_commentsfeuser_feuser;;;;3-3-3,ilike,idislike,myrating,'.
				'seen,remote_addr,tstampilike,pagetstampilike,tstampidislike,pagetstampidislike,tstampmyrating,pagetstampmyrating,tstampseen,pagetstampseen'),
	),
];
	
return $tx_toctoc_comments_comments;
?>