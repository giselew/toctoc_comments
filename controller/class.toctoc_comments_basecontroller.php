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
 *   76: public function __construct()
 *   90: public function &getCObj()
 *   99: public function getConfiguration()
 *  108: public function &getLang()
 *
 * TOTAL FUNCTIONS: 4
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */


/**
 * This class implements a base controller for the comments extension.
 * correct controller class instance.
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
abstract class toctoc_comments_basecontroller {

	/**
	 * Content object for this class. This is set by tslib_cObj::callUserFunc()
	 * directly after creating the instance of this class.
	 *
	 * @var	tslib_cObj
	 */
	protected $cObj = null;

	/**
	 * Configuration of this plugin instance
	 *
	 * @var	array
	 */
	protected $conf = array();

	/**
	 * Language object
	 *
	 * @var	language
	 */
	protected $lang = null;

	/**
	 * Creates an instance of this class.
	 *
	 * @return	void
	 */
	public function __construct() {
		$this->lang = t3lib_div::makeInstance('language');
		$this->lang->init($GLOBALS['TSFE']->lang);
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');

	}


	/**
	 * Obtains content object for this plugin
	 *
	 * @return	tslib_cObj		Content object
	 */
	public function &getCObj() {
		return $this->cObj;
	}

	/**
	 * Obtains configuration for this plugin
	 *
	 * @return	array		Configuration for this plugin
	 */
	public function getConfiguration() {
		return $this->conf;
	}

	/**
	 * Retrieves language object.
	 *
	 * @return	language		A reference to the language object
	 */
	public function &getLang() {
		return $this->lang;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/controller/class.toctoc_comments_basecontroller.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/controller/class.toctoc_comments_basecontroller.php']);
}

?>