<?php
namespace GiseleWendl\ToctocComments\Controller;
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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
}

	/**
	 * [Describe function...]
	 *
	 */
class AdministrationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	const SIGNAL_ADMINISTRATION_INDEX_ACTION = 'indexAction';

	/**
	 * Main action for administration
	 *
	 * @param
	 * @return	void
	 * @dontvalidate  $assignedValues
	 */
	public function indexAction() {
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		$use_OldBackendModule = intval($extConf['use_OldBackendModule']);

		if ($use_OldBackendModule == 0) {
			if (version_compare(TYPO3_branch, '6.0', '<')) {
				$use_OldBackendModule = 1;
			}
		}
		if ($use_OldBackendModule == 1) {
			require_once (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('toctoc_comments', 'Classes/Backend/OldBackendAdministration.php'));
		} else {
			require_once (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('toctoc_comments', 'Classes/Backend/BackendAdministration.php'));
		}
		if (!(version_compare(TYPO3_version, '7.6.8', '<'))) {
			exit;
		}

	}
}
?>