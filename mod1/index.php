<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
$use_OldBackendModule = intval($extConf['use_OldBackendModule']);

if ($use_OldBackendModule == 0) {
	if (version_compare(TYPO3_version, '6.0', '<')) {
		$use_OldBackendModule = 1;
	}
}

if ($use_OldBackendModule == 1) {
	require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Backend/OldBackendAdministration.php'));
} else {
	require_once (t3lib_extMgm::extPath('toctoc_comments', 'Classes/Backend/BackendAdministration.php'));
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/mod1/index.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/mod1/index.php']);
}
?>