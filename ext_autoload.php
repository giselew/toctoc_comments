<?php
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
}
$extensionClassesPath = t3lib_extMgm::extPath('toctoc_comments') . '';
$default = array(
		'tx_news_viewhelpers_social_toctoccommentsviewhelper' => $extensionClassesPath . 'Classes/ViewHelpers/Social/TocTocCommentsViewHelper.php',
		'tx_news_viewhelpers_social_toctoccommentscountviewhelper' => $extensionClassesPath . 'Classes/ViewHelpers/Social/TocTocCommentsCountViewHelper.php',
		'user_toctoc_comments_toctoc_comments' => $extensionClassesPath . 'class.user_toctoc_comments_toctoc_comments.php',		
);
return $default;
?>