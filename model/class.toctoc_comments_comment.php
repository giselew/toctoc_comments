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
 *   69: class toctoc_comments_comment extends toctoc_comments_basemodel
 *   84:     public function __construct(array $row = array())
 *   94:     public function getValidationResults()
 *  104:     public function validate($requiredFields)
 *  113:     public function isApproved()
 *  123:     public function setApproved($approved = true)
 *  132:     public function getFirstName()
 *  142:     public function setFirstName($firstName)
 *  151:     public function getLastName()
 *  161:     public function setLastName($lastName)
 *  169:     public function getImage()
 *  179:     public function setImage($Image)
 *
 *              SECTION: Retrieves e-mail
 *  193:     public function getCID()
 *  204:     public function setCID($CID)
 *  213:     public function getEmail()
 *  223:     public function setEmail($email)
 *  232:     public function getHomePage()
 *  242:     public function setHomePage($homepage)
 *  251:     public function getLocation()
 *  261:     public function setLocation($location)
 *
 * TOTAL FUNCTIONS: 19
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

if (!class_exists('toctoc_comments_basemodel', false)) {
	require_once(t3lib_extMgm::extPath('toctoc_comments', 'model/class.toctoc_comments_basemodel.php'));
}

/**
 * This class is a data record for comments.
 *
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comments_comment extends toctoc_comments_basemodel {

	/**
	 * Validation results
	 *
	 * @var	array
	 */
	protected	$validationResults = array();

	/**
	 * Creates an instance of this class
	 *
	 * @param	array		$row	Data row
	 * @return	[type]		...
	 */
	public function __construct(array $row = array()) {
		parent::__construct($row);
		$this->tableName = 'tx_toctoc_comments_comments';
	}

	/**
	 * Retrieves comment validation results as array
	 *
	 * @return	array		Keys are field names, values are errors
	 */
	public function getValidationResults() {
		return $this->validationResults;
	}

	/**
	 * Validates the comment
	 *
	 * @param	string		A comma-separated list of required fields
	 * @return	boolean		true if comment is valid
	 */
	public function validate($requiredFields) {
		return true;
	}

	/**
	 * Retrieves comment record approval flag
	 *
	 * @return	boolean		true if comment is approved
	 */
	public function isApproved() {
		return (boolean)$this->currentRow['approved'];
	}

	/**
	 * Sets id of the record. This function must be called only for new items!
	 *
	 * @param	boolean		$approved	true if approved
	 * @return	[type]		...
	 */
	public function setApproved($approved = true) {
		$this->currentRow['approved'] = $approved ? 1 : 0;
	}

	/**
	 * Retrieves first name
	 *
	 * @return	string		First name
	 */
	public function getFirstName() {
		return $this->currentRow['firstname'];
	}

	/**
	 * Sets first name
	 *
	 * @param	string		$firstName	First name of the user
	 * @return	void
	 */
	public function setFirstName($firstName) {
		$this->currentRow['firstname'] = $firstName;
	}

	/**
	 * Retrieves last name
	 *
	 * @return	string		Last name
	 */
	public function getLastName() {
		return $this->currentRow['lastname'];
	}

	/**
	 * Sets last name
	 *
	 * @param	string		$lastName	Last name of the user
	 * @return	void
	 */
	public function setLastName($lastName) {
		$this->currentRow['lastname'] = $lastName;
	}
	/**
	 * Retrieves last name
	 *
	 * @return	string		Image
	 */
	public function getImage() {
		return $this->currentRow['image'];
	}

	/**
	 * Sets last name
	 *
	 * @param	string		$Image	Image of the user
	 * @return	void
	 */
	public function setImage($Image) {
		$this->currentRow['image'] = $Image;
	}

	/**
	 * Retrieves e-mail
	 *
	 * @return	string	E-mail
	 */
	/**
	 * Retrieves CID
	 *
	 * @return	string		CID
	 */
	public function getCID() {
		return $this->currentRow['cid'];
	}

	/**
	 * Sets ContentID
	 * of contentnelem
	 *
	 * @param	[type]		$CID: ...
	 * @return	void
	 */
	public function setCID($CID) {
		$this->currentRow['cid'] = $CID;
	}

	/**
	 * Retrieves e-mail
	 *
	 * @return	string		E-mail
	 */
	public function getEmail() {
		return $this->currentRow['email'];
	}

	/**
	 * Sets e-mail
	 *
	 * @param	string		$email	E-mail of the user
	 * @return	void
	 */
	public function setEmail($email) {
		$this->currentRow['e-mail'] = $email;
	}

	/**
	 * Obtains home page
	 *
	 * @return	string		Home page
	 */
	public function getHomePage() {
		return $this->currentRow['homepage'];
	}

	/**
	 * Sets home page
	 *
	 * @param	string		$homepage	Home page
	 * @return	[type]		...
	 */
	public function setHomePage($homepage) {
		$this->currentRow['homepage'] = $homepage;
	}

	/**
	 * Obtains location
	 *
	 * @return	string		Home page
	 */
	public function getLocation() {
		return $this->currentRow['location'];
	}

	/**
	 * Sets home page
	 *
	 * @param	string		$homepage	Home page
	 * @return	[type]		...
	 */
	public function setLocation($location) {
		$this->currentRow['location'] = $location;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/model/class.toctoc_comments_comment.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/model/class.toctoc_comments_comment.php']);
}

?>