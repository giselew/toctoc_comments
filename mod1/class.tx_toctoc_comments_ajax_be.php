<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
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
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
}
// Load the language file
$GLOBALS['LANG']->includeLLFile('EXT:toctoc_comments/mod1/locallang.xml');
/*
 * @deprecated since 6.0, the classname tx_opendocs and this file is obsolete
 * and will be removed with 6.2. The class was renamed and is now located at:
 * typo3/sysext/opendocs/Classes/Controller/OpendocsController.php
 */
if (version_compare(TYPO3_version, '6.0', '>')) {
	require_once t3lib_extMgm::extPath('toctoc_comments') . 'Classes/Controller/AdministrationTocTocASNCAjaxController.php';
}
?>