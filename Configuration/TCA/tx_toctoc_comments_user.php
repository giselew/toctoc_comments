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

if (version_compare(TYPO3_version, '7.6', '<')) {
	$iconfilepath = t3lib_extMgm::extRelPath('toctoc_comments');
} else {
	$iconfilepath = 'EXT:toctoc_comments/';
}

$tx_toctoc_comments_comments = array(
		'ctrl' => array (
			'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user',
			'label' => 'toctoc_comments_user',
			'tstamp' => 'tstamp',
			'crdate' => 'crdate',
			'sortby' => 'crdate',
			'delete' => 'deleted',
			'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_user.gif',
			'searchFields' => 'toctoc_comments_user,initial_firstname,initial_lastname,initial_email,initial_homepage,initial_location,' .
				'current_firstname,current_lastname,current_email,current_homepage,current_location',
		),
		'interface' => array (
			'showRecordFieldList' => 'toctoc_comments_user,initial_firstname,initial_lastname,initial_email,initial_homepage,initial_location,' .
			'current_firstname,current_lastname,current_email,current_homepage,current_location,ip,' .
			'ipresolved,current_ip,average_rating,vote_count,like_count,dislike_count,comment_count,'.
				'average_rating,tstamp_lastupdate,tstamp,optindate,optin_email,optin_ip',
			'maxDBListItems' => 50,
			'readOnly' => 1,
		),
		'columns' => array (
			'toctoc_comments_user' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.toctoc_comments_user',
					'config' => array (
						'type' => 'input',
						'eval' => 'trim,required',
							'readOnly' => 1,
							'size'     => '22',
							'max'      => '255',
					),
				),
				'initial_firstname' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_firstname',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'initial_lastname' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_lastname',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'initial_email' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_email',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'initial_homepage' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_homepage',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'initial_location' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_location',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'ip' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.ip',
						'config' => array (
								'type'     => 'input',
								'size'     => '22',
								'max'      => '16',
								'eval'     => 'trim',
								'readOnly' => 1,
						)
				),
				'ipresolved' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.ipresolved',
						'config' => array (
								'type'     => 'input',
								'size'     => '22',
								'max'      => '255',
								'eval'     => 'trim',
								'readOnly' => 1,
						)
				),
				'current_firstname' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_firstname',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'current_lastname' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_lastname',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'current_email' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_email',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'current_homepage' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_homepage',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'current_location' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_location',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '18',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'current_ip' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_ip',
						'config' => array (
								'type'     => 'input',
								'size'     => '22',
								'max'      => '16',
								'eval'     => 'trim',
								'readOnly' => 1,
						)
				),
				'average_rating' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.average_rating',
						'config' => array (
								'type' => 'input',
								'size' => '6',
								'eval' => 'trim,double12',
								'max' => '20',
								'readOnly' => 1,
						)
				),
				'dislike_count' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.dislike_count',
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
				'like_count' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.like_count',
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
				'comment_count' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.comment_count',
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
				'vote_count' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.vote_count',
						'config' => array (
								'type'     => 'input',
								'size'     => '4',
								'max'      => '4',
								'eval'     => 'int',
								'checkbox' => '0',
								'range'    => array (
										'upper' => '1000000',
										'lower' => '0'
								),
								'default' => 0,
								'readOnly' => 1,
						)
				),
				'tstamp' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.tstamp',
						'config' => array (
								'type'     => 'input',
								'size'     => '22',
								'max'      => '16',
								'eval'     => 'datetime',
								'readOnly' => 1,
						)
				),
				'tstamp_lastupdate' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.tstamp_lastupdate',
						'config' => array (
								'type'     => 'input',
								'size'     => '22',
								'max'      => '16',
								'eval'     => 'datetime',
								'readOnly' => 1,
						)
				),
				'optindate' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.optindate',
						'config' => array (
								'type'     => 'input',
								'size'     => '22',
								'max'      => '16',
								'eval'     => 'datetime',
								'readOnly' => 1,
						)
				),
				'optin_email' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.optin_email',
						'config' => array (
								'type' => 'input',
								'eval' => 'trim',
								'size'     => '22',
								'max'      => '255',
								'readOnly' => 1,
						),
				),
				'optin_ip' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.optin_ip',
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
			0 => array ('showitem' => 'hidden,toctoc_comments_user,--palette--;;2,ip,ipresolved,--palette--;;4,tstamp,--palette--;;7,current_ip,--palette--;;3,tstamp_lastupdate,--palette--;;6,comment_count,--palette--;;5,--palette--;;6,--palette--;;7'),
		),
		'palettes' => array (
			'2' => array ('showitem' => 'initial_firstname,initial_lastname'),
			'3' => array ('showitem' => 'current_email,current_homepage,current_location'),
			'4' => array ('showitem' => 'initial_email,initial_homepage,initial_location'),
			'5' => array ('showitem' => 'optindate,optin_email,optin_ip'),
			'6' => array ('showitem' => 'average_rating,vote_count,like_count,dislike_count'),
			'7' => array ('showitem' => 'current_firstname,current_lastname'),
		),
);
	
return $tx_toctoc_comments_comments;
?>