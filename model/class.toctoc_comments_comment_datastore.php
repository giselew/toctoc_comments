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
 *   46: class toctoc_comments_comment_datastore
 *   59:     public function __construct()
 *
 * TOTAL FUNCTIONS: 1
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */


/**
 * This class implements comments extension data store
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comments_comment_datastore {
	/**
	 * A single instance of this class
	 *
	 * @var	toctoc_comments_comment_datastore
	 */
	static protected $instance = null;

	/**
	 * Creates an instance of this class.
	 *
	 * @return	void
	 */
	public function __construct() {
		$this->tableName = 'tx_toctoc_comments_comments';
		$this->dataClass = 'toctoc_comments_comment';
	}

	/**
	 * Factory method for this class.
	 *
	 * @return	toctoc_comments_comment_datastore	Instance of this class (singleton)
	 */
	static public function getInstance() {
		if (self::$instance == null) {
			self::$instance = t3lib_div::makeInstance('toctoc_comments_comment_datastore');
		}
		return self::instance;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/model/class.toctoc_comments_comment_datastore.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/model/class.toctoc_comments_comment_datastore.php']);
}

?>