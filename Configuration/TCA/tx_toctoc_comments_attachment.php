<?php
if (!defined ('TYPO3_MODE')) die('Access denied.');

if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

if (version_compare(TYPO3_version, '7.6', '<')) {
	$iconfilepath = t3lib_extMgm::extRelPath('toctoc_comments');
} else {
	$iconfilepath = 'EXT:toctoc_comments/';
}

$tx_toctoc_comments_attachment = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'sortby' => 'crdate',
		'default_sortby' => ' ORDER BY crdate DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
				'disabled' => 'hidden',
		),
		'iconfile' => $iconfilepath . 'icon_tx_toctoc_comments_attachment.gif',
		'MM' => 'tx_toctoc_comments_attachment_mm',
		'searchFields' => 'title,description',
	),
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
						'type' => 'input',
						'eval' => 'trim',
					),
			),
			'photos_etc' => array (
					'exclude' => 1,
					'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:tx_toctoc_comments_attachment.photos_etc',
					'config' => array (
						'type' => 'input',
						'eval' => 'trim',
					),
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
			0 => array ('showitem' => 'hidden,reference,systemurltext,title,description,photo_main,attachmentfilesize,photos_etc,attachmentvariant'),
	),
);

return $tx_toctoc_comments_attachment;
?>