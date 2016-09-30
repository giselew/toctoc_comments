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
$tempColumns = array (
		'tx_toctoc_comments_facebook_id' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.toctoc_comments_id',
				'config' => array (
						'type' => 'input',
						'size' => '20',
				)
		),
		'tx_toctoc_comments_facebook_link' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.toctoc_comments_link',
				'config' => array (
						'type'     => 'input',
						'size'     => '30',
						'max'      => '255',
						'checkbox' => '',
						'eval'     => 'trim',
						'wizards'  => array(
								'_PADDING' => 2,
								'link'     => array(
										'type'         => 'popup',
										'title'        => 'Link',
										'icon'         => 'link_popup.gif',
										$scriptelem => $scriptcontent,
										'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
								)
						)
				)
		),
		'tx_toctoc_comments_facebook_gender' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.toctoc_comments_gender',
				'config' => array (
						'type' => 'input',
						'size' => '5',
				)
		),
		'tx_toctoc_comments_facebook_email' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.toctoc_comments_email',
				'config' => array (
						'type' => 'input',
						'size' => '30',
				)
		),
		'tx_toctoc_comments_facebook_locale' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.tx_toctoc_comments_facebook_locale',
				'config' => array (
						'type' => 'input',
						'size' => '5',
						'max' => '5',
						'eval' => 'trim',
				)
		),
		'tx_toctoc_comments_facebook_updated_time' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.tx_toctoc_comments_facebook_updated_time',
				'config' => array (
						'type' => 'input',
						'size' => '15',
						'max' => '25',
						'eval' => 'trim',
				)
		),
		'gender' => array (
				'exclude' => '1',
				'label' => 'LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.gender',
				'config' => array (
						'type' => 'radio',
						'items' => array (
								array('LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.gender.I.0',
										0),
								array('LLL:EXT:toctoc_comments/locallang_db.xml:fe_users.gender.I.1',
										1)
						)
				)
		)
);

if($GLOBALS['TCA']['fe_users']['columns']['gender']) {
	unset($tempColumns['gender']);
}

t3lib_extMgm::addTCAcolumns('fe_users', $tempColumns, 1);

if (version_compare(TYPO3_branch, '7.0', '<')) {
	$sgender = '';
	$sgenderadd = FALSE;
	$fei = 'fe' . 'Interface';
	$feadm = 'fe' . '_admin_fieldList';

	if (str_replace('gender,', '', $GLOBALS['TCA']['fe_users'][$fei][$feadm] ) == $GLOBALS['TCA']['fe_users'][$fei][$feadm] ) {
		$sgender = ',gender';
		$sgenderadd = TRUE;
	}
	$GLOBALS['TCA']['fe_users'][$fei][$feadm] .= ',tx_toctoc_comments_facebook_id,tx_toctoc_comments_facebook_link,tx_toctoc_comments_facebook_email,tx_toctoc_comments_facebook_gender,tx_toctoc_comments_facebook_locale,tx_toctoc_comments_facebook_updated_time' . $sgender;
}

$sgender = '';
if (str_replace('gender,', '', $GLOBALS['TCA']['fe_users']['interface']['showRecordFieldList'] ) == $GLOBALS['TCA']['fe_users']['interface']['showRecordFieldList']) {
	$sgender = ',gender';
	$sgenderadd = TRUE;
}

$GLOBALS['TCA']['fe_users']['interface']['showRecordFieldList'] .= ',tx_toctoc_comments_facebook_id,tx_toctoc_comments_facebook_link,tx_toctoc_comments_facebook_email,tx_toctoc_comments_facebook_gender,tx_toctoc_comments_facebook_locale,tx_toctoc_comments_facebook_updated_time' . $sgender;
if ($sgenderadd == TRUE) {
	t3lib_extMgm::addToAllTCATypes('fe_users', '--div--;toctoc comments,tx_toctoc_comments_facebook_id;;;;1-1-1,tx_toctoc_comments_facebook_link,tx_toctoc_comments_facebook_email,tx_toctoc_comments_facebook_gender,tx_toctoc_comments_facebook_locale,tx_toctoc_comments_facebook_updated_time,gender');
} else {
	t3lib_extMgm::addToAllTCATypes('fe_users', '--div--;toctoc comments,tx_toctoc_comments_facebook_id;;;;1-1-1,tx_toctoc_comments_facebook_link,tx_toctoc_comments_facebook_email,tx_toctoc_comments_facebook_gender,tx_toctoc_comments_facebook_locale,tx_toctoc_comments_facebook_updated_time');
}
?>