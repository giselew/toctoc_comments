<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
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

if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(PATH_t3lib . 'class.t3lib_refindex.php');
	require_once(PATH_tslib . 'class.tslib_pibase.php');
	require_once(PATH_t3lib . 'class.t3lib_befunc.php');
	if (!version_compare(TYPO3_version, '4.6', '<')) {
		require_once(PATH_t3lib . 'utility/class.t3lib_utility_math.php');
	}

	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
	require_once(PATH_t3lib . 'class.t3lib_page.php');
	require_once(t3lib_extMgm::extPath('cms', 'tslib/class.tslib_content.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Utility/BackendUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Database/ReferenceIndex.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Utility/MathUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Page/PageRepository.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/ContentObject/ContentObjectRenderer.php';

}

include_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/toctoc_comment_lib.php'));
require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_common.php'));

/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   86: class toctoc_comments_api
 *  118:     public function __construct()
 *  143:     public function comments_getComments_fe_user($params, $conf)
 *  162:     public function getwebpagepreview($cmd, $cid, $data, $conf)
 *  178:     public function cleanupfup($previewid, $conf, $originalfilename)
 *  192:     public function handleCommentatorNotifications($ref, $conf = NULL, $notfromeID =FALSE, $pid)
 *  209:     public function handleeID($ref, $conf, $messagetodisplay, $returnurl)
 *  229:     public function getAjaxRatingDisplay($ref, $conf = NULL, $fromAjax = FALSE, $pid=0, $returnasarray = FALSE, $feuserid = 0, $cmd, $cid, $commentspics, $scopeid=0)
 *  243:     public function getUserCard($basedimgstr, $basedtoctocuid, $conf, $commentid)
 *  257:     public function getAjaxCommentDisplay($ref, $conf = NULL, $fromAjax, $pid=0,
			$feuserid = 0, $cmd, $piVars, $cid, $datathis, $AjaxData, $userpic, $commentspics, $check='',
			$extref='', $tctreestate  = NULL, $commentreplyid=0, $isrefresh=0, $confSess = array())
 *  320:     public function updateComment($conf, $ctid, $content, $pid, $plugincacheid)
 *  332:     public function previewcomment($data, $conf)
 *  346:     public function isVoted($ref, $scopeid, $feuser, $fromAjax)
 *  356:     public function initCaches()
 *  367:     public function enableFields($table)
 *  379:     public function setPluginCacheControlTstamp ($external_ref_uid_list)
 *
 *              SECTION: needed by class.tx_commentsresponse_hooks.php
 *  398:     public function applyStdWrap($text, $stdWrapName, $conf = NULL)
 *  421:     public function createLinks($text, $conf = NULL)
 *
 * TOTAL FUNCTIONS: 17
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

	// Default plugin variables
	public $prefixId = 'toctoc_comments_pi1';
	public $scriptRelPath = 'class.toctoc_comments_api.php';
	public $extKey = 'toctoc_comments';

	public $pi_checkCHash = TRUE;				// Required for caching.

	public $externalUid;						// UID of external record
	public $showUidParam = 'showUid';			// Name of 'showUid' GET parameter (different for tt_news!)
	public $where;								// SQL WHERE for records
	public $where_dpck;						// SQL WHERE for double post checks
	public $templateCode;						// Full template code
	public $foreignTableName;					// Table name of the record we comment on
	public $formValidationErrors = array();	// Array of form validation errors
	public $formTopMessage = '';				// This message is displayed in the top of the form
	public $totalrows = 0;
	public $startpoint = 0;

	/**
	 * Creates an instance of this class
	 *
	 * @return	void
	 */
	public function __construct() {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$this->lib = new toctoc_comment_lib;
		$this->commonObj = t3lib_div::makeInstance('toctoc_comments_common');
		$sessionTimeout=3*1440;
		$this->commonObj->start_toctoccomments_session($sessionTimeout);

		$_SESSION['started'] = (!isset($_SESSION['started']) ? 0 : 1);

		if ($_SESSION['started'] == 0) {
			// brand new session: Init almost all session vars
			$this->lib->resetSessionVars(0);
			$_SESSION['commentListIndex'] = array();
		}

	}

	/**
	 * Returns a list of markers with fe_user properties
	 *
	 * @param	[type]		$params: ...
	 * @param	[type]		$conf: ...
	 * @return	array
	 */
	public function comments_getComments_fe_user($params, $conf) {
		$tempMarkers = $this->lib->comments_getComments_fe_user($params, $conf, $this, 0, TRUE, '');
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
	public function getwebpagepreview($cmd, $cid, $data, $conf) {
	 	$html = $this->lib->getwebpagepreview($cmd, $this, $cid, $data, $conf);
	 	return $html;
	}

	/**
	 * handles Webpage previews
	 *
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	string		$cid: content element of the comment plugin
	 * @param	array		$data: optional input url to handle
	 * @param	int		$previewid: attachement.uid
	 * @param	array		$conf: Configuration of the plugin
	 * @param	[type]		$originalfilename: ...
	 * @return	string		Generated HTML
	 */
	public function cleanupfup($previewid, $conf, $originalfilename) {
		$html = $this->lib->cleanupfup($previewid, $conf, $originalfilename);
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
	public function handleCommentatorNotifications($ref, $conf = NULL, $notfromeID =FALSE, $pid) {
	 	$html = $this->lib->handleCommentatorNotifications($ref, $conf, $this, !$notfromeID, $pid);
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
	public function handleeID($ref, $conf, $messagetodisplay, $returnurl) {
		$html = $this->lib->handleeID($ref, $conf, $this, $messagetodisplay, $returnurl);
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
	 * @param	[type]		$commentspics: ...
	 * @param	[type]		$scopeid: ...
	 * @return	string		Generated HTML
	 */
	public function getAjaxRatingDisplay($ref, $conf = NULL, $fromAjax = FALSE, $pid=0, $returnasarray = FALSE, $feuserid = 0, $cmd, $cid, $commentspics, $scopeid=0) {
		$html = $this->lib->getRatingDisplay($ref, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $cmd, $this, $cid, FALSE, $commentspics, $scopeid);
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
	public function getUserCard($basedimgstr, $basedtoctocuid, $conf, $commentid) {
		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['templateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);

		$this->templateCode = @file_get_contents(PATH_site . $usetemplateFile);
		$html = $this->lib->getUserCard($basedimgstr, $basedtoctocuid, $conf, $this, $commentid);
		return $html;
	}

	/**
	 * displays comments
	 *
	 * @return	[type]		...
	 */
		public function getAjaxCommentDisplay($ref, $conf = NULL, $fromAjax, $pid=0,
			$feuserid = 0, $cmd, $piVars, $cid, $datathis, $AjaxData, $userpic, $commentspics, $check='',
			$extref='', $tctreestate  = NULL, $commentreplyid=0, $isrefresh=0, $confSess = array()) {
			if ($fromAjax) {
				$this->externalUid = $datathis['externalUid'];
				$this->showUidParam = $datathis['showUidParam'];
				$this->where = $datathis['where'];
				$this->where_dpck  = $datathis['where_dpck'];

				$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['templateFile']);
				$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);

				$this->templateCode = @file_get_contents(PATH_site . $usetemplateFile);

				$this->foreignTableName = $datathis['foreignTableName'];
				if (isset($datathis['totalrows'])) {
					// browse case
					$this->totalrows  = $datathis['totalrows'];
					$this->startpoint  = $datathis['startpoint'];
					$_SESSION['lastTotalrows'][$cid] = $this->totalrows;
					$_SESSION['lastStartpoint'][$cid] = $this->startpoint;
				} else {
					if (isset($_SESSION['lastTotalrows'][$cid])) {
						$this->totalrows = $_SESSION['lastTotalrows'][$cid];
						$this->startpoint = $_SESSION['lastStartpoint'][$cid];
					}
				}

				if ($conf['externalPrefix'] != 'pages') {
					$_SESSION['commentListRecord']=$this->foreignTableName . '_' . $this->externalUid;
				} else {
					$_SESSION['commentListRecord']='tt_content_' . $cid;
				}

			 }

			 if ($isrefresh==1) {
			 	$_SESSION['userAJAXimage']='';
			 }

			$html = $this->lib->maincomments($ref, $conf, $fromAjax, $pid, $feuserid, $cmd, $this, $piVars, $cid, $datathis['sessionCaptchaData'], $userpic,
					$commentspics, $check, $AjaxData, $extref, $tctreestate, $commentreplyid, $confSess);
			if ($isrefresh==1) {
				$html .= '<div id="dummy"></div>' . $this->lib->maincomments($ref, $conf, $fromAjax, $pid, $feuserid, 'showform', $this, $piVars, $cid,
						$datathis['sessionCaptchaData'], $userpic, $commentspics, $check, $AjaxData, $extref, $tctreestate, $commentreplyid);
				$html .= '<div id="dummy"></div><div>' . $this->lib->maincomments($ref, $conf, $fromAjax, $pid, $feuserid, 'updateAJAXdata', $this,
						$piVars, $cid, $datathis['sessionCaptchaData'], $userpic, $commentspics, $check, $AjaxData, $extref, $tctreestate, $commentreplyid) .
						'</div>';
			}

			return $html;
		}

	/**
	 * updates a comment
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	int		$ctid: comment id.
	 * @param	int		$pid: page id
	 * @param	int		$plugincacheid: ...
	 * @param	[type]		$plugincacheid: ...
	 * @return	boolean		TRUE if item was voted
	 */
	public function updateComment($conf, $ctid, $content, $pid, $plugincacheid) {
		$retstr = $this->lib->updateComment($conf, $this, $ctid, $content, $pid, $plugincacheid);
		return $retstr;
	}

	/**
	 * returns comment preview
	 *
	 * @param	array		$data
	 * @param	array		$conf: ...
	 * @return	string		preview html
	 */
	public function previewcomment($data, $conf) {
		$retstr = $this->lib->previewcomment($data, $this, $conf);
		return $retstr;
	}

	/**
	 * Checks if item was already voted by current user
	 *
	 * @param	string		$ref	Reference
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$this: parent object
	 * @param	int		$feuser: ...
	 * @return	boolean		TRUE if item was voted
	 */
	public function isVoted($ref, $scopeid, $feuser, $fromAjax) {
		$retstr = $this->lib->isVoted($ref, $this, $scopeid, $feuser, $fromAjax);
		return $retstr;
	}

	/**
	 * wrapper for inits Caches for TYPO3 v 4.3 to 4.5
	 *
	 * @return	void
	 */
	public function initCaches() {
		$retstr = $this->lib->initCaches();
		return $retstr;
	}

	/**
	 * wrapper for enableFields calls from AJAX
	 *
	 * @param	[type]		$table: ...
	 * @return	string		condition
	 */
	public function enableFields($table) {
		$getFromSession = TRUE;
		$retstr = $this->lib->enableFields($table, $this, $getFromSession);
		return $retstr;
	}

	/**
	 * Set the timestamp of plugins of $external_ref_uid_list in table tx_toctoc_comments_plugincachecontrol to current value.
	 *
	 * @param	[type]		$external_ref_uid_list: ...
	 * @return	void
	 */
	public function setPluginCacheControlTstamp ($external_ref_uid_list) {
		$this->lib->setPluginCacheControlTstamp($external_ref_uid_list);
	}
	/**
	 * needed by class.tx_commentsresponse_hooks.php
	 *
	 *
	 */


	/**
	 * Applies stdWrap to given text
	 *
	 * @param	string		$text	Text to apply stdWrap to
	 * @param	string		$stdWrapName	Name for the stdWrap in $conf
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	string		Wrapped text
	 */
	public function applyStdWrap($text, $stdWrapName, $conf = NULL) {
		$conf = NULL;
		$retstr=$text;
		if (is_array($this->conf[$stdWrapName . '.'])) {
			if ($this->conf[$stdWrapName. '.']['wrap']) {
				$arrWrap=explode('|', $this->conf[$stdWrapName. '.']['wrap']);
				if (is_array($arrWrap)) {
					$retstr=$arrWrap[0] . $text .$arrWrap[1];
				}

			}

		}

		return $retstr;
	}
	/**
	 * Creates links from "http://..." or "www...." phrases.
	 *
	 * @param	string		$text	Text to search for links
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Text to convert
	 */
	public function createLinks($text, $conf = NULL) {
		$conf = NULL;
		if ($this->conf['advanced.']['autoConvertLinks']) {
			$textout=
			preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" class="tx-tc-external-autolink">\1</a>', $text);
			$textout= str_replace('." rel="nofollow"', '" rel="nofollow"', $textout);
			$textout= str_replace('," rel="nofollow"', '" rel="nofollow"', $textout);
			$textout= str_replace(',</a>', '</a>,', $textout);
			$textout= str_replace('.</a>', '</a>.', $textout);
		} else {
			$textout=$text;
		}

		return $textout;
	}

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_api.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_api.php']);
}

?>