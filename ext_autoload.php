<?php
$extensionClassesPath = t3lib_extMgm::extPath('toctoc_comments') . '';
$default = array(
		'tx_news_viewhelpers_social_toctoccommentsviewhelper' => $extensionClassesPath . 'Classes/ViewHelpers/Social/TocTocCommentsViewHelper.php',
		'tx_news_viewhelpers_social_toctoccommentscountviewhelper' => $extensionClassesPath . 'Classes/ViewHelpers/Social/TocTocCommentsCountViewHelper.php',
		
);
return $default;
?>