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

require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
require_once(t3lib_extMgm::extPath('cms', 'tslib/class.tslib_content.php'));
require_once(PATH_t3lib . 'class.t3lib_page.php');
require_once(PATH_t3lib . 'class.t3lib_befunc.php');
require_once(PATH_t3lib . 'class.t3lib_refindex.php');
require_once(PATH_tslib . 'class.tslib_pibase.php');
if (!version_compare(TYPO3_version, '4.6', '<')) {
	require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
}

include_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   64: class toctoc_comments_api
 *  105:     public function __construct()
 *  151:     public function comments_getComments_fe_user($params, $conf)
 *  168:     public function getwebpagepreview($cmd, $cid, $data,$previewid, $conf)
 *  181:     public function handleCommentatorNotifications($ref, $conf = null, $notfromeID =false,$pid)
 *  197:     public function handleeID($ref, $conf, $messagetodisplay,$returnurl)
 *  217:     public function getAjaxRatingDisplay($ref, $conf = null, $fromAjax = false, $pid=0, $returnasarray = false, $feuserid = 0, $cmd,$cid, $fromcomments=false, $commentspics)
 *  232:     public function getUserCard($basedimgstr,$basedtoctocuid,$conf,$commentid)
 *  250:     public function getAjaxCommentDisplay($ref, $conf = null, $fromAjax, $pid=0, $returnasarray = false,
				$feuserid = 0, $cmd, $piVars, $cid, $datathis, $AjaxData, $userpic,$commentspics, $check='',$extref='',$tctreestate  = null)
 *  289:     public function updateComment($conf,$ctid,$content,$pid)
 *  300:     public function isVoted($ref,$conf)
 *
 * TOTAL FUNCTIONS: 10
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

/**
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comments_api {

	/**
	 * Instance of tslib_cObj
	 *
	 * @var	tslib_cObj
	 */
	public $cObj;

	// Default plugin variables:
	var $prefixId = 'toctoc_comments_pi1';
	var $scriptRelPath = 'class.toctoc_comments_api.php';
	var $extKey = 'toctoc_comments';

	var $pi_checkCHash = true;				// Required for proper caching! See in the typo3/sysext/cms/tslib/class.tslib_pibase.php
	var $externalUid;						// UID of external record
	var $showUidParam = 'showUid';			// Name of 'showUid' GET parameter (different for tt_news!)
	var $where;								// SQL WHERE for records
	var $where_dpck;						// SQL WHERE for double post checks
	var $templateCode;						// Full template code
	var $foreignTableName;					// Table name of the record we comment on
	var $formValidationErrors = array();	// Array of form validation errors
	var $formTopMessage = '';				// This message is displayed in the top of the form


	// comments 2.0.0 additions

	var $templavoila_field = 'field_content';  // Name of the TemplaVoila Field which hold the MainContent
	var $MainColPos = 0;					   // colPos of the MainArea where the comments plugin goes
	var $maxtimeafterinsert = 7999;			   // time in milliseconds the system waits until considering a submit as new total transaction
	var $tERROR_CAPCHA = '';				   // the Text for a capcha error needs to be held in a classattibute
	var $widthExtCapcha = '110';			   // the width of the image if "captcha" is selected as extension

	var $totalrows = 0;				   // the Text for a capcha error needs to be held in a classattibute
	var $startpoint = 0;			   // the width of the image if "captcha" is selected as extension

	/**
	 * Creates an instance of this class
	 *
	 * @return	void
	 */
	public function __construct() {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$this->lib = new toctoc_comment_lib;
		session_name('sess_' . $this->extKey);
		session_start();

		$_SESSION['started'] = (!isset($_SESSION['started']) ? 0 : 1);

		if ($_SESSION['started'] == 0) {
			// brand new session: Init almost all session vars
			$this->lib->resetSessionVars(0);
			$_SESSION['commentListIndex'] = array();
			$_SESSION['timeintensivedbaction'] = '0';

		}

		$tdiff = 1000*(microtime(true) - $_SESSION['edgeTime']);
		/*
		 * with 'edgeTime' we setup sort of beginn and end of the !entire! process where
		* session variables are not reinitialized again, after this time they can be reset.
		* This is just data-hygienics
		*
		* More important is 'timeintensivdbaction'
		* it gives the boolean state weather the insert or delete-process is active or not
		* This process includes 2 page-calls. In the 2nd call (comment display and form result)
		* this variable indicates that the code should lookout for the CID where the process was started from
		* :-) It looks more difficult than it actually is :-)
		*
		*/

		if ($_SESSION['timeintensivedbaction'] == '1') {
			$this->lib->resetSessionVars(2);
			$_SESSION['timeintensivedbaction'] = '0';
		}
		else {
			$this->lib->resetSessionVars(0);
		}


	}
	/*
	 * Returns a list of markers with fe_user properties
	*
	* @return array
	*/
	public function comments_getComments_fe_user($params, $conf) {
		$tempMarkers = $this->lib->comments_getComments_fe_user($params, $conf,$this,0,true);
		if (is_array($tempMarkers)) {
			return $tempMarkers;
		}
		return array();
	}
	/**
	 * handles Webpage previews
	 *
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	string		$cid: content element of the comment plugin
	 * @param	array		$data: optional input url to handle
	 * @param	int		$previewid: attachement.uid
	 * @param	array		$conf: Configuration of the plugin
	 * @return	string		Generated HTML
	 */
	public function getwebpagepreview($cmd, $cid, $data,$previewid, $conf) {
	 	$html = $this->lib->getwebpagepreview($cmd, $cid, $data, $this,true,$previewid, $conf);
	 	return $html;
	}
	/**
	 * handles Commentator Notifications
	 *
	 * @param	string		$ref: record reference
	 * @param	array		$conf: Configuration of the plugin
	 * @param	boolean		$notfromeID: if commentator notification is initiated by eID or AJAX request
	 * @param	inti		$pid: page id
	 * @return	void		or string Generated HTML, depending on $notfromeID
	 */
	public function handleCommentatorNotifications($ref, $conf = null, $notfromeID =false,$pid) {
	 	$html = $this->lib->handleCommentatorNotifications($ref, $conf, $this, !$notfromeID,$pid);
	 	if (!$notfromeID) {
	 		return $html;
	 	}
	}

	/**
	 * handles request from eID
	 *
	 * @param	string		$ref: record reference (co)
	 * @param	array		$conf: Configuration of the plugin
	 * @param	string		$messagetodisplay: the message from eID to display on the page
	 * @param	string		$refreshurl: Refreh-URL for the http-equiv=refresh redirects
	 * @return	string		html to display as webpage
	 */
	public function handleeID($ref, $conf, $messagetodisplay,$returnurl) {
		$html = $this->lib->handleeID($ref, $conf, $this,$messagetodisplay,$returnurl);
		return $html;
	}

	/**
	 * gets ratings display
	 *
	 * @param	string		$ref: record reference
	 * @param	array		$conf: Configuration of the plugin
	 * @param	boolean		$fromAjax: if request from Ajax
	 * @param	int		$pid: page id
	 * @param	array		$returnasarray: return values as array
	 * @param	int		$feuserid: userid
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	int		$cid: content element id.
	 * @param	[type]		$fromcomments: ...
	 * @param	[type]		$commentspics: ...
	 * @return	string		Generated HTML
	 */
	public function getAjaxRatingDisplay($ref, $conf = null, $fromAjax = false, $pid=0, $returnasarray = false, $feuserid = 0, $cmd,$cid, $fromcomments=false, $commentspics) {
		//$html = $commentspics[0]; //exit;
		$html = $this->lib->getRatingDisplay($ref, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $cmd, $this,$cid,false, $commentspics);
		return $html;
	}

	/**
	 * returns a user card
	 *
	 * @param	string		$basedimgstr: baseencoded toctoc userimage-link
	 * @param	string		$basedtoctocuid: baseencoded toctoc userid
	 * @param	array		$conf: Configuration of the plugin
	 * @param	int		$commentid: comment uid
	 * @return	string		Generated HTML
	 */
		public function getUserCard($basedimgstr,$basedtoctocuid,$conf,$commentid) {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['templateFile']);
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);

			$this->templateCode = @file_get_contents(PATH_site . $usetemplateFile);
			$html = $this->lib->getUserCard($basedimgstr,$basedtoctocuid,$conf,$this,$commentid);
			return $html;
		}





		/**
 * gets display of comments
 *
 * @return	string		Generated HTML
 */
		public function getAjaxCommentDisplay($ref, $conf = null, $fromAjax, $pid=0, $returnasarray = false,
				$feuserid = 0, $cmd, $piVars, $cid, $datathis, $AjaxData, $userpic,$commentspics, $check='',$extref='',$tctreestate  = null) {
			if ($fromAjax) {
				$this->externalUid = $datathis['externalUid'];
				$this->showUidParam = $datathis['showUidParam'];
				$this->where = $datathis['where'];
				$this->where_dpck  = $datathis['where_dpck'];

				$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['templateFile']);
				$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);

				$this->templateCode = @file_get_contents(PATH_site . $usetemplateFile);

				$this->foreignTableName = $datathis['foreignTableName'];
				$this->tERROR_CAPCHA  = $datathis['tERROR_CAPCHA'];
				$this->widthExtCapcha  = $datathis['widthExtCapcha'];
				$this->totalrows  = $datathis['totalrows'];
				$this->startpoint  = $datathis['startpoint'];
				if ($conf['externalPrefix'] != 'pages') {
					$_SESSION['commentListRecord']=$this->foreignTableName . '_' . $this->externalUid;

				} else {
					$_SESSION['commentListRecord']='tt_content_' . $cid;
					//$_SESSION['commentListRecord']=$ref;
				}
			}

			$html .= $this->lib->maincomments($ref, $conf, $fromAjax, $pid, $feuserid, $cmd, $this, $piVars, $cid,$datathis['sessionCaptchaData'], $userpic,$commentspics,$check,$AjaxData,$extref,$tctreestate);
			return $html;
		}
		/**
 * updates a comment
 *
 * @param	array		$conf:  Array with the plugin configuration
 * @param	object		$pObj: parent object
 * @param	int		$ctid: comment id.
 * @param	int		$pid: page id
 * @return	boolean		true if item was voted
 */
		public function updateComment($conf,$ctid,$content,$pid) {
			return $this->lib->updateComment($conf,$this,$ctid,$content,$pid);
		}
		/**
 * Checks if item was already voted by current user
 *
 * @param	string		$ref	Reference
 * @param	array		$conf:  Array with the plugin configuration
 * @param	object		$pObj: parent object
 * @return	boolean		true if item was voted
 */
		public function isVoted($ref,$conf) {
			return $this->lib->isVoted($ref,$conf,$this);
		}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_api.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_api.php']);
}

?>