<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

$TCA['tx_toctoc_comments_comments'] = array(
	'ctrl' => $TCA['tx_toctoc_comments_comments']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'content,firstname,lastname,email,location,homepage,remote_addr',
		'maxDBListItems' => 60,
	),
	'columns' => array(
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'external_ref' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepand_tname' => true,
				'allowed' => '*',
				'minsize' => 1,
				'maxsize' => 1,
				'size' => 1,
				'wizards' => Array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref.wizard',
						'script' => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			),
		),
		'external_ref_uid' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepand_tname' => true,
				'allowed' => '*',
				'minsize' => 1,
				'maxsize' => 1,
				'size' => 1,
				'wizards' => Array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid.wizard',
						'script' => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			),
		),
		'external_prefix' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_prefix',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim,alphanum_x',
					'readOnly' => 1,
			),
		),
		'approved' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.approved',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.approved.I.0', '')
				),
				'default' => 0,
			),
		),
		'firstname' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.firstname',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim,required',
			),
		),
		'lastname' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.lastname',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
			),
		),
		'email' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.email',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
			),
		),
		'homepage' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.homepage',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
			),
		),
		'location' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.location',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
			),
		),
		'content' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.content',
			'config' => array(
				'type' => 'text',
				'wrap' => 'virtual',
				'cols' > 48,	// full form width
				'rows' => 15,
			),
		),
		'remote_addr' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.remote_addr',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim,required,is_in',
				'is_in' => '0123456789.',
					'readOnly' => 1,
			),
		),
		'double_post_check' => array(
			'label' => '',
			'config' => array(
				'type' => 'passthrough'
			)
		)
	),
	'types' => array(
		0 => array('showitem' => 'hidden;;;;1,approved;;;;2-2-2,firstname;;;;3-3-3,lastname,email,homepage,location,content,remote_addr,external_ref,external_ref_uid;;;;5-5-5,external_prefix'),
	),
);

$TCA['tx_toctoc_comments_feuser_mm'] = array(
		'ctrl' => $TCA['tx_toctoc_comments_feuser_mm']['ctrl'],
		'interface' => Array (
				'showRecordFieldList' => 'reference,toctoc_commentsfeuser_feuser,ilike,idislike,myrating,remote_addr',
				'maxDBListItems' => 60,
				'readOnly' => 1,
		),
		'columns' => array(


				'ilike' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.ilike',
						'config' => array(
								'type' => 'check',
								'default' => 0,
						),
				),
				'idislike' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.idislike',
						'config' => array(
								'type' => 'check',
								'default' => 0,
						),
				),
				'myrating' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.myrating',
						'config' => array(
								'type' => 'input',
								'size' => '4',
								'max'      => '4',
								'eval'     => 'int',
								'checkbox' => '0',
								'default' => 0,
						),
				),
				'remote_addr' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.remote_addr',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim,required,is_in',
								'is_in' => '0123456789.',
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
					)
				),
				'toctoc_commentsfeuser_feuser' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser',
						'config' => array(
								'type' => 'input',
								'eval'     => 'int',
								'default' => 0,
						),
				),
		),
		'types' => array(
				0 => array('showitem' => 'hidden;;;;1,reference;;;;2-2-2,toctoc_commentsfeuser_feuser;;;;3-3-3,ilike,idislike,myrating,remote_addr'),
		),
);
$TCA['tx_toctoc_comments_user'] = array(
		'ctrl' => $TCA['tx_toctoc_comments_user']['ctrl'],
		'interface' => Array (
				'showRecordFieldList' => 'toctoc_comments_user,initial_firstname,initial_lastname,initial_email,initial_homepage,initial_location,' .
				'current_firstname,current_lastname,current_email,current_homepage,current_location,ip,' .
				'ipresolved,current_ip,average_rating,vote_count,like_count,dislike_count,comment_count,average_rating,tstamp_lastupdate,tstamp',
				'maxDBListItems' => 60,
				'readOnly' => 1,
		),
		'columns' => array(
			'toctoc_comments_user' => array(
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.toctoc_comments_user',
					'config' => array(
						'type' => 'input',
						'eval' => 'trim,required',
							'readOnly' => 1,
					),
				),
				'initial_firstname' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_firstname',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'initial_lastname' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_lastname',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'initial_email' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_email',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'initial_homepage' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_homepage',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'initial_location' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.initial_location',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
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
								'size'     => '40',
								'max'      => '255',
								'eval'     => 'trim',
								'readOnly' => 1,
						)
				),
				'current_firstname' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_firstname',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'current_lastname' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_lastname',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'current_email' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_email',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'current_homepage' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_homepage',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
								'readOnly' => 1,
						),
				),
				'current_location' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.current_location',
						'config' => array(
								'type' => 'input',
								'eval' => 'trim',
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
				'average_rating' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_user.average_rating',
						'config' => Array (
								'type' => 'input',
								'size' => '20',
								'eval' => 'trim,double2',
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
										'upper' => '1000',
										'lower' => '10'
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
										'upper' => '1000',
										'lower' => '10'
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
										'upper' => '1000',
										'lower' => '10'
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
										'upper' => '1000',
										'lower' => '10'
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
		),
		'types' => array(
				0 => array('showitem' => 'hidden;;;;1,toctoc_comments_user;;2, ip, ipresolved, tstamp;;4,current_firstname,current_lastname,current_ip,tstamp_lastupdate;;3,average_rating,vote_count,like_count,dislike_count,comment_count'),
		),
		'palettes' => Array (
				'2' => Array('showitem' => 'initial_firstname,initial_lastname'),
				'3' => Array('showitem' => 'current_email,current_homepage,current_location'),
				'4' => Array('showitem' => 'initial_email,initial_homepage,initial_location'),
		)
);
$TCA['tx_toctoc_comments_urllog'] = array(
	'ctrl' => $TCA['tx_toctoc_comments_urllog']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'external_ref,url,external_ref_uid',
		'maxDBListItems' => 60,
	),
	'columns' => array(
		'external_ref' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepand_tname' => true,
				'allowed' => '*',
				'minsize' => 1,
				'maxsize' => 1,
				'size' => 1,
				'wizards' => Array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref.wizard',
						'script' => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			),
		),
		'url' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_urllog.url',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim,required',
			),
		),
		'external_ref_uid' => array(
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'prepand_tname' => true,
				'allowed' => '*',
				'minsize' => 1,
				'maxsize' => 1,
				'size' => 1,
				'wizards' => Array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.external_ref_uid.wizard',
						'script' => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			),
		),
	),
	'types' => array(
		0 => array('showitem' => 'external_ref,external_ref_uid;;;;1,url'),
	),
);

$TCA['tx_toctoc_ratings_data'] = array (
	'ctrl' => $TCA['tx_toctoc_ratings_data']['ctrl'],
	'columns' => array (
		'reference' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.reference',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => '*',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			)
		),
		'rating' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.rating',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
		'vote_count' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_data.vote_count',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'reference;;;;1-1-1, rating, vote_count')
	),
);

$TCA['tx_toctoc_ratings_iplog'] = array(
	'ctrl' => $TCA['tx_toctoc_ratings_iplog']['ctrl'],
	'columns' => array (
		'reference' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog.reference',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => '*',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
			)
		),
		'crdate' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog.crdate',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'datetime',
				'readOnly' => $toctoc_ratings_debug_mode_disabled,
			)
		),
		'ip' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_ratings_iplog.ip',
			'config' => array (
				'type'     => 'input',
				'size'     => '22',
				'max'      => '16',
				'eval'     => 'trim',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'reference;;;;1-1-1, crdate, ip')
	),

);

$TCA['tx_toctoc_comments_spamwords'] = array(
		'ctrl' => $TCA['tx_toctoc_comments_spamwords']['ctrl'],
		'interface' => Array (
				'showRecordFieldList' => 'spamword,spamvalue',
				'maxDBListItems' => 60,
		),
		'columns' => array(
				'hidden' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
						'config' => Array (
								'type' => 'check',
								'default' => '0'
						)
				),

				'spamword' => array(
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_spamwords.spamword',
						'config' => array(
							'type' => 'input',
							'eval' => 'trim',
						),
				),
				'spamvalue' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_spamwords.spamvalue',
						'config' => array (
								'type'     => 'input',
								'size'     => '2',
								'max'      => '2',
								'eval'     => 'int',
								'checkbox' => '0',
								'range'    => array (
										'upper' => '10',
										'lower' => '1'
								),
								'default' => 1
						)
				),
				'sys_language_uid' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
						'config' => Array (
								'type' => 'select',
								'foreign_table' => 'sys_language',
								'foreign_table_where' => 'ORDER BY sys_language.title',
								'items' => Array(
										Array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
										Array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
								)
						)
				),
		),
		'types' => array(
				0 => array('showitem' => 'hidden;;;;1,spamword;;;;2-2-2,spamvalue,sys_language_uid'),
		),
);
?>