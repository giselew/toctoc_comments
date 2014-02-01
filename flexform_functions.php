<?php
/**
 * Checks if merged flexform file must be written to typo3temp.
 *
 * @param	string		$filePath	Path to merged file
 * @return	boolean		<code>true</code> if file has to be written
 */
function toctoc_comments_mustUpdateTempFlexFile($filePath) {
	if (!@file_exists($filePath)) {
		return true;
	}
	$mtime = @filemtime($filePath);
	foreach (array('general', 'advanced', 'spamprotect') as $pref) {
		if ($mtime < @filemtime(t3lib_extMgm::extPath('toctoc_comments', 'pi1/flexform_ds_' . $pref . '.xml'))) {
			return true;
		}
	}
	return false;
}

/**
 * Makes workaround against a bug in pre-4.2 versions of typo3 where flexform sheet references caused fatal PHP error in PHP5.
 *
 * @return	string		Merged flexform file path
 */
function toctoc_comments_makeTempFlexFormDS() {
	$ffFileName = PATH_site . 'typo3temp/toctoc_comments_flexform_ds.xml';
	if (toctoc_comments_mustUpdateTempFlexFile($ffFileName)) {
		$ffContent = t3lib_div::getURL(t3lib_extMgm::extPath('toctoc_comments', 'pi1/flexform_ds.xml'));
		$ds = t3lib_div::xml2array($ffContent);
		$sheets = t3lib_div::resolveAllSheetsInDS($ds);
		unset($ds['sheets']);
		$ds['sheets'] = $sheets['sheets'];
		$ffContentNew = t3lib_div::array2xml($ds, '', 0, 'T3DataStructure');
		t3lib_div::writeFileToTypo3tempDir($ffFileName, $ffContentNew);
	}
	return 'FILE:' . substr($ffFileName, strlen(PATH_site));
}

?>