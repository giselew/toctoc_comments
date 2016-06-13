<?php
namespace GiseleWendl\ToctocComments\Controller;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\ResponseInterface;

/**
 * AdministrationAJAX controller
 *
 * @package TYPO3
 * @subpackage tx_toctoc_comments
 */
class AdministrationTocTocASNCAjaxController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	const SIGNAL_ADMINISTRATIONTOCTOCASNCAJAX_INDEX_ACTION = 'indexAction';

	/**
	 * Main action for administration
	 *
	 * @param
	 * @return	void
	 * @dontvalidate  $assignedValues
	 */
	public function indexAction() {

		if ((version_compare(TYPO3_version, '7.6.8', '<'))) {

			$MCONF['name'] = 'web_toctoccommentsbeM1';
			$MCONF['script'] = '_DISPATCH';

			$MCONF['access'] = 'user,group';
		}

		$admincommand = $_POST['admincommand'];
		
		$ret = GeneralUtility::requireOnce(ExtensionManagementUtility::extPath('toctoc_comments') . 'Classes/Backend/BackendAjaxAdministration.php');
		echo $ret;
		exit;
	}
}
