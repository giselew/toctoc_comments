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

$tx_toctoc_comments_comments = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments',
		'label' => 'content',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments.gif',
		'sortby' => 'crdate',
		'default_sortby' => ' ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'typeicon_column' => 'approved',
		'typeicons' => array(
			'0' => $iconfilepath . 'icon_tx_toctoc_comments_not_approved.gif',
			'1' => $iconfilepath . 'icon_tx_toctoc_comments.gif',
		),
		'searchFields' => 'uid,content,commenttitle,firstname,lastname,email,location,homepage,tx_commentsresponse_response,toctoc_comments_user',
	),
	'interface' => array (
			'showRecordFieldList' => 'content,commenttitle,firstname,lastname,gender,email,location,homepage,remote_addr,toctoc_comments_user,external_ref,external_ref_uid,tx_commentsresponse_response',
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
			'external_ref' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref',
					'config' => array (
						'type' => 'input',
						'eval' => 'trim,required',
					),
			),
			'external_prefix' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_prefix',
					'config' => array (
							'type' => 'input',
							'size' => 15,
							'eval' => 'trim,alphanum_x,required',
							'readOnly' => 1,
					),
			),
			'approved' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.approved',
					'config' => array (
							'type' => 'check',
							'items' => array (
									array ('LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.approved.I.0', '')
							),
							'default' => 0,
					),
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
			'commenttitle' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.commenttitle',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'firstname' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.firstname',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'lastname' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.lastname',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'gender' => array (
					'exclude' => '1',
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.gender',
					'config' => array (
							'type' => 'radio',
							'items' => array (
									array('LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.gender.I.0', '0'),
									array('LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.gender.I.1', '1')
							),
					)
			),
			'email' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.email',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'homepage' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.homepage',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'location' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.location',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'content' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.content',
					'config' => array (
							'type' => 'text',
							'wrap' => 'virtual',
							'cols' => 48,
							'rows' => 15,
							'eval' => 'trim,required',
					),
			),
			'remote_addr' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.remote_addr',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required,is_in',
							'is_in' => '0123456789.',
							'readOnly' => 1,
					),
			),
			'double_post_check' => array (
					'label' => '',
					'config' => array (
							'type' => 'passthrough'
					)
			),
			'toctoc_commentsfeuser_feuser' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser',
					'config' => array (
							'type' => 'group',
							'internal_type' => 'db',
							'allowed' => 'fe_users',
							'size' => 1,
							'minitems' => 0,
							'maxitems' => 1,
							'readOnly' => 1,
					)
			),
			'toctoc_comments_user' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.toctoc_comments_user',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim,required,is_in',
							'is_in' => '0123456789.',
							'readOnly' => 1,
					)
			),
			'tx_commentsnotify_notify' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.tx_commentsnotify_notify',
					'config' => array (
							'type' => 'check',
							'items' => array (
									array ('LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.tx_commentsnotify_notify.I.0', '')
							),
							'default' => 0,
					),
			),
			'external_ref_uid' => array (
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid',
					'config' => array (
							'type' => 'input',
							'eval' => 'trim',
					),
			),
			'tx_commentsresponse_response' => array (
					'exclude' => 0,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.tx_commentsresponse_response',
					'config' => array (
							'type' => 'text',
							'wrap' => 'virtual',
				  	'cols' => 48,
							'rows' => 15,
					)
			),
	),
	'types' => array (
			0 => array ('showitem' => 'hidden,approved,firstname,lastname,gender,commenttitle,toctoc_comments_user,toctoc_commentsfeuser_feuser,remote_addr,email,homepage,location,content,tx_commentsnotify_notify,external_prefix,external_ref,external_ref_uid,tx_commentsresponse_response'),
	),
);
	
return $tx_toctoc_comments_comments;
?>