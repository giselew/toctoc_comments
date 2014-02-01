<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Gisele Wendl <gisele.wendl@toctoc.ch>
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

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   48: class toctoc_comments_errorview extends toctoc_comments_baseview
 *   64:     public function __construct(toctoc_comments_fecontroller &$controller, array $errors)
 *   74:     public function render()
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(t3lib_extMgm::extPath('toctoc_comments', 'view/class.toctoc_comments_baseview.php'));

/**
 * This class implements a error view for the toctoc_comments extension
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comments_errorview extends toctoc_comments_baseview {

	/**
	 * Erros to display
	 *
	 * @var	array
	 */
	protected $errors;

	/**
	 * Creates an instance of this class. This view requires FE controller
	 * and will not work with AJAX controller.
	 *
	 * @param	toctoc_comments_fecontroller		$controller	Controller for this view
	 * @return	void
	 */
	public function __construct(toctoc_comments_fecontroller &$controller, array $errors) {
		parent::__construct($controller);
		$this->errors = $errors;
	}

	/**
	 * Renders the content of the view
	 *
	 * @return	string		HTML
	 */
	public function render() {
		// Get content object
		$cObj = &$this->controller->getCObj();

		// Get subparts
		$subpart = $cObj->getSubpart($this->templateCode, '###ERROR_SUB###');
		$errorSubpart = $cObj->getSubpart($subpart, '###ERROR###');

		// Create error list
		$content = '';
		foreach ($this->errors as $error) {
			$content .= $cObj->substituteMarker($errorSubpart, '###MESSAGE###',
				htmlspecialchars($error));
		}

		// Wrap into main subpart
		$content = $cObj->substituteSubpart($subpart, '###ERROR###', $content);

		return $content;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/view/class.toctoc_comments_errorview.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/view/class.toctoc_comments_errorview.php']);
}

?>