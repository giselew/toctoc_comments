<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

if (version_compare(TYPO3_version, '6.3', '>')) {
	$scriptelem = 'module';
	$scriptcontent = array(
	'name' => 'wizard_element_browser',
	'urlParameters' => array(
		'mode' => 'wizard',
		'act' => 'edit'
	)
);
	
} else {
	$scriptelem = 'script';
	$scriptcontent = 'wizard_edit.php';

}
$TCA['tx_toctoc_comments_comments'] = array (
	'ctrl' => $TCA['tx_toctoc_comments_comments']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'content,commenttitle,firstname,lastname,email,location,homepage,remote_addr,toctoc_comments_user,external_ref,external_ref_uid,tx_commentsresponse_response',
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
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_comments.External_Ref',
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
		0 => array ('showitem' => 'hidden;;;;1,approved;;;;2-2-2,firstname,lastname,commenttitle;;;;3-3-3,toctoc_comments_user,toctoc_commentsfeuser_feuser,'.
				'remote_addr;;;;4-4-4,email,homepage,location,content,tx_commentsnotify_notify;;;;5-5-5,external_prefix,external_ref,external_ref_uid,tx_commentsresponse_response'),
	),
);

$TCA['tx_toctoc_comments_feuser_mm'] = array (
	'ctrl' => $TCA['tx_toctoc_comments_feuser_mm']['ctrl'],
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
		)
		,'pagetstampmyrating' => array (
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
);

$TCA['tx_toctoc_comments_user'] = array (
		'ctrl' => $TCA['tx_toctoc_comments_user']['ctrl'],
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
				0 => array ('showitem' => 'hidden;;;;1,toctoc_comments_user;;2, ip, ipresolved;;4,, tstamp;;7, current_ip;;3, tstamp_lastupdate;;6, comment_count;;5'),
		),
		'palettes' => array (
				'2' => array ('showitem' => 'initial_firstname,initial_lastname'),
				'3' => array ('showitem' => 'current_email,current_homepage,current_location'),
				'4' => array ('showitem' => 'initial_email,initial_homepage,initial_location'),
				'5' => array ('showitem' => 'optindate,optin_email,optin_ip'),
				'6' => array ('showitem' => 'average_rating,vote_count,like_count,dislike_count'),
				'7' => array ('showitem' => 'current_firstname,current_lastname'),

		)
);
$TCA['tx_toctoc_comments_urllog'] = array (
	'ctrl' => $TCA['tx_toctoc_comments_urllog']['ctrl'],
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

$TCA['tx_toctoc_ratings_data'] = array (
	'ctrl' => $TCA['tx_toctoc_ratings_data']['ctrl'],
	'interface' => array (
			'showRecordFieldList' => 'reference,reference_scope,url,rating,vote_count',
			'maxDBListItems' => 50,
	),
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
					'upper' => '10000000',
					'lower' => '0'
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
					'upper' => '10000000',
					'lower' => '0'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'reference,reference_scope;;;;1-1-1, rating, vote_count')
	),
);

$TCA['tx_toctoc_ratings_iplog'] = array (
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
		'0' => array ('showitem' => 'reference,reference_scope;;;;1-1-1, crdate, ip')
	),

);

$TCA['tx_toctoc_comments_spamwords'] = array (
		'ctrl' => $TCA['tx_toctoc_comments_spamwords']['ctrl'],
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

$TCA['tx_toctoc_comments_attachment'] = array (
		'ctrl' => $TCA['tx_toctoc_comments_attachment']['ctrl'],
		'interface' => array (
				'showRecordFieldList' => 'attachmentvariant,systemurltext,photo_main,photos_etc,title,description',
				'maxDBListItems' => 50,
		),
		'columns' => array (
				'attachmentvariant' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.attachmentvariant',
						'config' => array (
								'type' => 'input',
								'size' => '4',
								'max'      => '4',
								'eval'     => 'int,required',
								'checkbox' => '0',
								'default' => 0,
								'readOnly' => 1,
						),
				),
				'systemurltext' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.systemurltext',
						'config' => array (
							'type' => 'input',
							'eval' => 'trim',
						),
				),
				'photo_main' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.photo_main',
						'config' => array (
								'type' => 'group',
								'internal_type' => 'file',
								'allowed' => 'gif,png,jpeg,jpg,png,pdf',
								'max_size' => 1000,
								'uploadfolder' => 'uploads/tx_toctoccomments/webpagepreview',
								'show_thumbs' => 1,
								'size' => 1,
								'minitems' => 0,
								'maxitems' => 1,
						)
				),
				'photos_etc' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.photos_etc',
						'config' => array (
								'type' => 'group',
								'internal_type' => 'file',
								'allowed' => 'gif,png,jpeg,jpg,png',
								'max_size' => 500,
								'uploadfolder' => 'uploads/tx_toctoccomments/webpagepreview',
								'show_thumbs' => 1,
								'size' => 3,
								'minitems' => 0,
								'maxitems' => 25,
						)
				),

				'title' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.title',
						'config' => array (
							'type' => 'input',
							'eval' => 'trim,required',
						),
				),
				'description' => array (
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.description',
						'config' => array (
							'type' => 'text',
							'wrap' => 'virtual',
							'cols' > 48,	// full form width
							'rows' => 15,
						),
				),
				'attachmentfilesize' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.attachmentfilesize',
						'config' => array (
								'type'     => 'input',
								'size'     => '4',
								'max'      => '4',
								'eval'     => 'int',
								'checkbox' => '0',
								'range'    => array (
									'upper' => '10000000',
									'lower' => '1'
								),
								'default' => 0
						)
				),
		),
		'types' => array (
				0 => array ('showitem' => 'hidden;;;;1,reference;;;;2-2-2,systemurltext,title,description;;;;3-3-3,photo_main,'.
						'attachmentfilesize,photos_etc,attachmentvariant'),
		),
);


$TCA['tx_toctoc_comments_prefixtotable'] = array (
		'ctrl' => $TCA['tx_toctoc_comments_prefixtotable']['ctrl'],
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
				0 => array ('showitem' => 'hidden;;;;1,pi1_key;;;;2-2-2,pi1_table;;;;3-3-3,show_uid,displayfields,topratingsdetailpage,topratingsimagesfolder'),
		),
);

$TCA['tx_toctoc_comments_ipbl_local'] = array (
	'ctrl' => $TCA['tx_toctoc_comments_ipbl_local']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'ipaddr,blockfe,comment'
	),
	'columns' => array (
		'ipaddr' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.ipaddr',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim,nospace,unique',
			)
		),
		'blockfe' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.blockfe',
			'config' => array (
					'type' => 'check',
					'default' => '0'
			)
		),
		'crdate' => array (
			'excude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.crdate',
			'config' => array (
				'type' => 'input',
				'eval' => 'tx_toctoc_comments_ipbl_hooks,datetime',
				'readOnly' => TRUE,
				'default' => time(),
			),
		),
		'comment' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_local.comment',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'ipaddr,blockfe;;;;1-1-1, crdate, comment')
	),
	'palettes' => array (
		'1' => array ('showitem' => '')
	)
);

$TCA['tx_toctoc_comments_ipbl_static'] = array (
	'ctrl' => $TCA['tx_toctoc_comments_ipbl_static']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'ipaddr,comment'
	),
	'columns' => array (
		'ipaddr' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_static.ipaddr',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim,nospace,unique',
			)
		),
		'comment' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_ipbl_static.comment',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => array (
		'0' => array ('showitem' => 'ipaddr;;;;1-1-1, comment')
	),
	'palettes' => array (
		'1' => array ('showitem' => '')
	)
);

$TCA['tx_toctoc_ratings_scope'] = array (
		'ctrl' => $TCA['tx_toctoc_ratings_scope']['ctrl'],
		'interface' => array (
				'showRecordFieldList' => 'sys_language_uid,l18n_parent,l18n_diffsource,hidden,scope_title,scope_description,display_order'
		),
		'columns' => array (
				'sys_language_uid' => array (
						'exclude' => 1,
						'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
						'config' => array (
								'type' => 'select',
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
				'0' => array('showitem' => 'sys_language_uid;;;;3-3-3, l18n_parent, l18n_diffsource, hidden, scope_title, scope_description, display_order')
		),
		'palettes' => array (
				'1' => array('showitem' => 'scope_title,scope_description'),
				'2' => array('showitem' => 'l18n_parent,l18n_diffsource'),
		),
);

?>