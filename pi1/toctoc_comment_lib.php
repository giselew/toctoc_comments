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
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *  244: class toctoc_comment_lib extends tslib_pibase
 *  312:     public function __construct()
 *  330:     public function maincomments($ref, $conf = NULL, $fromAjax = FALSE, $pid=0, $feuserid = 0, $cmd = '', &$pObj, $piVars = array(),
		$cid = 0, $sessioncapdata = '', $userpic='', $commentspics = array(), $check='', $AjaxData = '', $ajaxextref= '',
		$tctreestate = NULL, $commentreplyid=0, $confSess=array())
 *  639:     protected function checkExternalUid($conf, $pObj, $fromAjax)
 *
 *              SECTION: Commenting functions
 *  680:     public function comments($conf,&$pObj, $fromAjax, $feuserid, $pid)
 * 3062:     protected function getCommentsMenu($pObj, $conf, $externalref, $fromAjax, $cntrowsorig)
 * 3523:     protected function getBaseCommentsArray($uid, $uidlist = '', $selectparentuid = FALSE)
 * 3581:     protected function getBaseFeUsersArray($pObj, $fromAjax, $uid, $uidlist = '', $conf)
 * 3638:     protected function makeemoji($text, $conf, $debug)
 * 3786:     public function comments_getComments(&$rows, $conf, $pObj, $feuserid, $fromAjax, $pid, $levelhlt=0)
 * 4847:     public function comments_getComments_getRatings(&$row, $conf, $pObj, $feuserid, $fromAjax, $isReview = 0, $externalref = '', $commentusername = '')
 * 5076:     protected function comments_getComments_getEmail($email)
 * 5092:     protected function isCommentingClosed($conf, $pObj)
 * 5147:     protected function commentingClosed($pObj, $fromAjax, $conf)
 * 5170:     protected function comments_getCommentsBrowser($rpp, $startpoint, $totalrows, $pObj, $fromAjax, $conf)
 * 5320:     public function comments_getComments_fe_user($params, $conf, $pObj, $commentid, $fromAjax, $commentusername)
 * 5426:     protected function addleadingspace($text)
 * 5455:     protected function check_comment_ownership ($rowexternal_ref, $feuserid)
 * 5478:     public function previewcomment($data, $pObj, $conf)
 *
 *              SECTION: functions for images cache (AJAX)
 * 5507:     protected function setAJAXimage($image, $feuserid)
 * 5520:     public function getAJAXimage($feuserid, $commentid, $conf, $email = '')
 * 5588:     protected function setAJAXimageCache($image, $imageoriginal)
 * 5598:     protected function getAJAXimageCache($commentuserimageout)
 * 5613:     protected function checkAjaxUserPic ($cid=0)
 * 5645:     protected function build_AJAXImages($conf, $pObj, $usergenderexistsstr = '', $fromAjax = FALSE)
 * 5876:     protected function fixFeUserPic ($pic)
 * 5900:     protected function makeImageSprite($conf)
 *
 *              SECTION: Form functions
 * 6103:     private function form($conf, &$pObj, $piVars, $fromAjax, $pid, $ifeuserid=0, $userpic, $commentid=0, $replylevel=0,	$fromcomments = FALSE)
 * 7355:     protected function form_updatePostVarsWithFeUserData($pObj, $fromAjax, $conf, $piVars, $feuserid, $userpic, $cid, $output_cid)
 * 7689:     protected function getUserName($fe_user_user_uid, $pObj, $fromAjax, $conf)
 * 7756:     protected function form_getCaptcha($pObj, $conf, $fromAjax)
 * 7813:     protected function form_wrapError($field, $pObj, $conf)
 *
 *              SECTION: Comments page-browser functions
 * 7850:     protected function processBrowserSubmission($conf, $pObj, $cmd, $ref)
 *
 *              SECTION: Inserting and Updating Comments functions
 * 7915:     public function processSubmission($conf, $pObj, $piVars, $fromAjax, $feuserid, $pid, $lang)
 * 8451:     public function updateComment($conf, $pObj, $ctid, $content, $pid, $plugincacheid, $commenttitle = '')
 *
 *              SECTION: IP-blocking functions, Spam checking
 * 8555:     protected function IPBlockSpamCheck(&$pObj)
 * 8573:     protected function sendNotificationIPBlock($params)
 * 8588:     protected function checkSMTPService($hostname, $port, $confcheckSMTPService = 0)
 * 8610:     public function getIpAddr()
 * 8628:     public function checkTableBLs($ipaddr = '', $checksiteblock = FALSE, $pObj)
 * 8646:     private function checkLocalBL($ipaddr, $checksiteblock = FALSE, $pObj)
 * 8688:     private function checkStaticBL($ipaddr, $checksiteblock = FALSE, $pObj)
 * 8731:     private function checkNetworkBLs($ipaddr)
 * 8755:     protected function processSubmission_checkTypicalSpam($pObj, $conf, $piVars, $lang, $fromAjax)
 * 8828:     protected function processSubmission_validate($piVars, $conf, $pObj, $fromAjax)
 *
 *              SECTION: E-mail notification
 * 8909:     public function sendNotificationEmail($uid, $plugincacheid, $points, $action, $conf, $pObj, $fromAjax, $piVars, $pid, $fetoctocusertoinsert,
			$attachment_id=0, $attachment_subid=0, $optinemail='', $ratingpageid=0, $langajax = '')
 * 9680:     protected function emailOptIn($conf, $optinemail, $optin_ip)
 * 9757:     protected function checkCOI($conf, $email, $checkip=TRUE)
 *
 *              SECTION: language handling functions
 * 9793:     public function fixLL(&$conf)
 * 9818:     protected function fixLL_internal($LL, &$ll, $prefix = '')
 *
 *              SECTION: mostly formatting functions
 * 9843:     protected function createLinks($text, $conf)
 * 9898:     protected function applyStdWrap($text, $stdWrapName, $conf = NULL)
 * 9921:     protected function checkCustomFunctionCodes($code, $pObj)
 * 9946:     protected function isNoCacheUrl($url)
 * 9968:     protected function substituteMarkersAndSubparts($template, array $markers, array $subparts, $pObj)
 *
 *              SECTION: session and cache functions
 * 9995:     public function resetSessionVars($resetcontext, $alsoajaxvar = TRUE)
 * 10047:     public function getClearCacheIds($conf, $pid = 0, $repectsession = TRUE)
 * 10114:     protected function getClearCacheExternal_ref_uids($external_ref_uid = '')
 * 10143:     public function setPluginCacheControlTstamp ($external_ref_uid_list)
 * 10220:     public function getPluginCacheControlTstamp ($external_ref_uid)
 * 10243:     public function initCaches()
 * 10299:     protected function clearPagesCaches($conf, $pid, $plugincacheid)
 *
 *              SECTION: Smilie functions
 * 10340:     public function parseSmilieArray($data)
 * 10357:     public function replaceSmilies($content, $conf)
 * 10379:     protected function checkbbcrop($content, $commentCropLength, $conf, $pObj)
 * 10415:     protected function replaceBBs($content, $pObj, $conf, $purge=FALSE)
 *
 *              SECTION: functions for the AJAx interface with jQuery/JavaScript
 * 10467:     protected function getAjaxJSData($feuserid, $pid, $languagecode, $conf, $pObj, $cid, $fromAjax, $dataonly=FALSE, $externalref)
 * 10539:     protected function arraydiffassocrecursive($array1, $array2)
 * 10568:     protected function getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $ref)
 * 10591:     protected function mirrorconf($conf)
 * 10654:     protected function updateAjaxData($feuserid, $conf)
 * 10674:     protected function getAjaxLoggedInData($forjsvariable, $outputloginstate)
 * 10738:     protected function getAjaxDataAttachments($conf, $fromAjax, $pObj)
 * 10760:     protected function getAjaxJSDataCommentImgs($cid, $fromAjax)
 * 10797:     protected function getAjaxJSDataComments($cid, $pObj, $fromAjax)
 * 10835:     protected function getAjaxDataComments($pObj)
 * 10853:     protected function getAjaxDataImgs()
 *
 *              SECTION: URL- and IP-related functions
 * 10870:     public function getCurrentIp()
 * 10886:     public function hasValidItemUrl($piVars)
 * 10909:     public function getDefaultConfig($pluginkey='')
 *
 *              SECTION: Rating functions
 * 10939:     public function getRatingDisplay($ref, $conf = NULL, $fromAjax = 0, $pid=0, $returnasarray = FALSE, $feuserid = 0, $cmd = 'vote',
			$pObj = NULL, $cid, $fromcomments, $commentspics = array(), $scopeid=0, $isReview = 0, $commentusername = '')
 * 11017:     public function isVoted($ref, $pObj, $scopeid=0, $feuserid=0, $fromAjax)
 * 11055:     public function isCommented($ref, $pObj, $feuserid=0, $fromAjax)
 * 11088:     public function getBarWidth($rating, $conf, $isReview = 0)
 * 11111:     protected function getRatingInfo($ref, $pObj, $feuserid=-1, $conf, $scopeid=0, $fromAjax, $isReview = 0, $fromcomments = 0, $reviewfeuserid = 0)
 * 11310:     protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
	$commentspics, $scopeid = 0, $isReview = 0, $commentusername = '')
 * 12345:     private function makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating = array(), $mylikeval, $mydis='', $template, $cid, $commentspics, $extpreffortext)
 *
 *              SECTION: TYPO3 workarounds
 * 12790:     public function enableFields($tableName, $pObj, $getFromSession = FALSE)
 * 12812:     public function pi_getLLWrap($pObj, $llkey, $fromAjax)
 * 12853:     protected function t3getSubpart ($pObj, $templateCode, $templateMarker)
 * 12873:     public function t3substituteMarkerArray ($content, $markContentArray)
 * 12894:     protected function t3substituteMarker ($template, $marker, $markContent)
 * 12908:     protected function t3fileResource ($pObj, $usetemplateFile)
 * 12925:     protected function getcheck ($ref, $i, $ratingscheck)
 * 12949:     protected function formatDate($date, $pObj, $fromAjax, $conf)
 * 13085:     protected function getPageURL($fromAjax = FALSE, $pid = 0)
 * 13107:     public function locationHeaderUrlsubDir($withleadingslash = TRUE)
 * 13132:     protected function getCleanHTML ($html)
 * 13155:     public function getLoginForm()
 * 13185:     public function getChangePasswordForm($uid = 0, $piHash = '')
 * 13216:     public function getBBCard($conf, $pObj, $buildthisbb = FALSE, $returnbbarray = FALSE)
 *
 *              SECTION: Usercards
 * 13319:     public function getSmiliesCard($conf)
 * 13585:     public function getUserCard($basedimgstr, $basedtoctocuid, $conf, $pObj, $commentid, $fromAjax = TRUE, $fromusercenter = FALSE)
 *
 *              SECTION: Mail functions
 * 14044:     protected function getMailTo($mailAddress, $linktxt = '', $initP = '?')
 * 14091:     protected function encryptEmail($string, $back=0)
 * 14133:     protected function encryptCharcode($n, $start, $end, $offset)
 * 14158:     public function send_mail ($toEMail, $subject, $message, $html, $fromEMail, $fromName, $confcheckSMTPService = 0, $attachment='')
 * 14331:     protected function slashName ($name, $apostrophe='"')
 *
 *              SECTION: Notification functions
 * 14355:     public function handleCommentatorNotifications($uid, $conf, $pObj, $fromeID = FALSE, $pid=0, $fromAjax=1)
 * 14700:     public function handleNewUserNotification($uid, $conf, $pObj, $fromeID = FALSE, $pid=0, $fromAjax=1)
 *
 *              SECTION: Website preview functions
 * 14844:     public function cleanupfup($uploadedfile, $conf, $originalfilename)
 * 14863:     public function getwebpagepreview($cmd, $pObj, $cid, $data, $conf)
 * 14906:     protected function getpreviewinit($cid, $data, $conf)
 * 14954:     protected function savewebpagepreviewtodb($pcid, $pObj, $pcommentid, $conf)
 * 15193:     protected function cleanupdbandfiles($conf, $uploadedfile='', $originalfilename='')
 * 15348:     protected function getwebpagecache($pcid, $pObj, $pcommentid, $conf, $url='', $isbeforefetch = FALSE)
 * 15515:     protected function read_dir($dir, $array = array())
 * 15544:     protected function commentShowWebpagepreview ($rowattachmentid, $rowattachment_subid, $conf, $pObj, $cid, $topwebsitepreview, $fromAjax,
			$row = array(), $isforemailnotification = FALSE)
 * 16047:     protected function makeAttachementPicture($picturefilename, $conf, $descriptionbyuser, $originalfilename, $firstname,
			$lastname, $fetoctocusertoinsert)
 *
 *              SECTION: eID-Interface functions
 * 16227:     public function handleeID($uid, $conf, $pObj, $messagetodisplay, $refreshurl)
 *
 *              SECTION: Reply on comments functions
 * 16338:     protected function getCommentBoxDisplay($commentid, $conf, $level, $fromAjax, $triggeredlevel=0, $levelexpandoverride=0)
 * 16414:     protected function getCommentBoxChildrenDisplayIsCollapsed($commentschildrenids, $conf, $level, $fromAjax, $triggeredlevel=0, $levelexpandoverride=0)
 *
 *              SECTION: Fe-usergroup functions
 * 16486:     public function usersGroupmembers($pObj, $fromAjax, $conf, $communitybuddies = FALSE)
 * 16567:     protected function isUserOnline($feuser_uid)
 *
 *              SECTION: Recent comments functions
 * 16606:     public function getRecentComments($pObj, $conf, $feuserid)
 * 16622:     protected function trimContent($text, $conf, $maxChars=0, $dospecialChars=TRUE, $precrop = FALSE)
 *
 *              SECTION: Report comments functions
 * 16679:     protected function getCommentsReportLink($params, &$pObj, $fromAjax, $pid)
 * 16728:     public function mainReport($content, $conf, $pObj, $piVars)
 *
 *              SECTION: Debug function
 * 16755:     protected function trackdebug ($trackingfunction)
 *
 *              SECTION: Top ratings functions
 * 16782:     public function showtopRatings($conf, $pObj)
 * 16797:     public function showtopSharings($conf, $pObj)
 *
 *              SECTION: show userCenter functions
 * 16820:     public function showuserCenter($conf, $pObj)
 * 16838:     public function showCommentsSearch($conf, $pObj, $fromAjax = FALSE, $data = '', $cid = 0)
 * 16855:     private function gravatarize($conf, $outstr, $email, $watchanonymgravatar = FALSE)
 * 16917:     private function gifbuild($conf, $pObj, $gravatarEnable, $userimgFile, $imagesize, $profileimgclass, $classonline,
			$userimagestyle, $usernametitle, $email, $cssid, $nogen = FALSE, $imgalign = '', $watchanonymgravatar = FALSE)
 *
 * TOTAL FUNCTIONS: 134
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(PATH_t3lib . 'class.t3lib_refindex.php');
	require_once(PATH_tslib . 'class.tslib_pibase.php');
	//require_once(PATH_t3lib . 'class.t3lib_befunc.php');
} else {
	//require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('backend') . 'Classes/Utility/BackendUtility.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('frontend') . 'Classes/Plugin/AbstractPlugin.php';
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/Database/ReferenceIndex.php';
}
if (version_compare(TYPO3_version, '6.3', '>')) {
	(class_exists('t3lib_extMgm', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Utility\ExtensionManagementUtility', 't3lib_extMgm');
	(class_exists('tslib_pibase', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\Plugin\AbstractPlugin', 'tslib_pibase');
}
require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_common.php'));


/**
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comment_lib extends tslib_pibase {
	private $sessionCaptchaData = '';
	private $AJAXimages = array();
	private $AJAXimagesCache = array();
	private $gravatarimages = array();
	public $smilies = array();
	// Smilie array
	public $smiliesPath = '';
	//	Path to smilie folder, will be set to config value later
	private $check = '';
	private $AjaxData = '';
	private $AJAXimage = '';
	private $newcommentid = -1;
	private $limitofrows =  500;
	// maximum of rows fetched for comments at a time.
	protected $externalref = '';
	protected $ajaxextref= '';
	private $tctreestate = array();
	private $tctreelastlevel =0;
	private $tctreelastdisplay =0;
	private $newcommentneedscoi = 0;
	protected $table = 'tx_toctoc_comments_comments';
	protected $webpagepreviewsavefolder = 'uploads/tx_toctoccomments/webpagepreview/';
	protected $webpagepreviewtempfolder = 'uploads/tx_toctoccomments/temp/';
	private $lastpreviewid = 0;
	private $userrows = '';
	private $ajaxHeader = '';
	private $topareaHTML = '';
	private $insertwasnotconsistent = FALSE;
	private $numberOfLeadingBlanksToReplace = 50;
	// you can extend number of leading blanks possible in comments here
	private $allowHTMLTagsInComments=FALSE;
	// set this to TRUE to allow html-tags in comments (bit dangerous, not fully bulletproof)
	private $BBhtmls = 'b,i,code,q,blockquote,cite';
	private $BBcodes = 'b,i,code,q,bq,ct';
	//corresponding vertical position in bbs.png
	private $BBimgpos = '20,80,60,100,0,40';
	private $BBtitles = array();
	private $BBs = array();
	//CSS
	private $boxmodelspacing = 4;                                    //      *** will be set = intval($conf['theme.']['boxmodelSpacing'])
	private $expandiconCSSmargin = ' tx-tc-expandicon'; 			//       *** fixed here, apart for boxmdel koogle (margin of the icon for
	private $picuploadCSSmargin=' tx-tc-picupload';  			//picupload  *** fixed here, apart for boxmdel koogle (attachments, margin of image preview pics)
	private $pdfuploadCSSmargin=' tx-tc-pdfupload';  			//PdfUpload  *** fixed here, apart for boxmdel koogle (attachments, margin of pdf preview pics)
	public $userimagesize = 96;	                                // 		 *** fixed here (size of generated user pic, it will be downsized by CSS later
	private $taareaCSSheightinit=32;  //                                     *** will be later = 4 + (intval($conf['theme.']['boxmodelTextareaLineHeight'])*
																				// intval($conf['theme.']['boxmodelTextareaNbrLines']))  +
																				// (2 * intval($conf['theme.']['boxmodelSpacing']));

	//cache
	protected $cacheInstance;
	private $ajaxDataloginSess;
	protected $debugprintlib=array();

	private $middotchar = '&middot;';
	private $dontuseGIFBUILDER = 0;

	protected $allrowsarr = array();
	protected $rowsfeuser = array();
	protected $FeUsers = array();
	protected $FeUsersSet = FALSE;
	private $sqnumber= 0;

	/**
	 * Class init.
	 *
	 * @return
	 */
	public function __construct() {
		if (version_compare(TYPO3_version, '6.3', '>')) {
			(class_exists('t3lib_div', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Utility\GeneralUtility', 't3lib_div');
			(class_exists('language', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Lang\LanguageService', 'language');
			(class_exists('tslib_cObj', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer', 'tslib_cObj');
			(class_exists('t3lib_refindex', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\Database\ReferenceIndex', 't3lib_refindex');
			if (!t3lib_extMgm::isLoaded('compatibility6')) {
				(class_exists('t3lib_mail_Message', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Core\Mail\MailMessage', 't3lib_mail_Message');
				(class_exists('t3lib_TCEmain', FALSE)) ? TRUE : class_alias('TYPO3\CMS\Core\DataHandling\DataHandler', 't3lib_TCEmain');
			}
		}
	}

	/**
	 * Entrypoint function and dispatcher for subfunctions.
	 *
	 * @return	string		HTML-Output
	 */
	public function maincomments($ref, $conf = NULL, $fromAjax = FALSE, $pid=0, $feuserid = 0, $cmd = '', &$pObj, $piVars = array(),
		$cid = 0, $sessioncapdata = '', $userpic='', $commentspics = array(), $check='', $AjaxData = '', $ajaxextref= '',
		$tctreestate = NULL, $commentreplyid=0, $confSess=array()) {
		$content = '';

		if ($conf['advanced.']['dontuseGIFBUILDER'] != '') {
			$this->dontuseGIFBUILDER = intval($conf['advanced.']['dontuseGIFBUILDER']);
		}

		if (count($confSess)>0) {
			//reset session vars to input
			if (is_array($confSess['commentListIndex'])) {
				$_SESSION['commentListIndex'] = array_replace_recursive($_SESSION['commentListIndex'], $confSess['commentListIndex']);
			}

			if (is_array($confSess['ratingsscopesinternalm1table'])) {
				if (!is_array($_SESSION['ratingsscopesinternalm1table'])) {
					$_SESSION['ratingsscopesinternalm1table'] = array();
				}

				$_SESSION['ratingsscopesinternalm1table'] = array_replace_recursive($_SESSION['ratingsscopesinternalm1table'],
						$confSess['ratingsscopesinternalm1table']);
			}

			$_SESSION['commentsPageId']=$confSess['commentsPageId'];
			$_SESSION['commentListCount'] = $confSess['commentListCount'];
			$_SESSION['activelangid']= $confSess['activelangid'];
			$_SESSION['commentListRecord']= $confSess['commentListRecord'];
			$_SESSION['findanchorok']= $confSess['findanchorok'];
			$_SESSION['newcommentid']=  $confSess['newcommentid'];
			if (isset($confSess['lastStartpoint'])) {
				if (isset($confSess['lastStartpoint'][$cid])) {
					if (intval($confSess['lastStartpoint'][$cid])!=0) {
						$pObj->totalrows= $confSess['lastTotalrows'][$cid];
						$pObj->startpoint= $confSess['lastStartpoint'][$cid];
					}
					$_SESSION['lastTotalrows'][$cid]= $confSess['lastTotalrows'][$cid];
					$_SESSION['lastStartpoint'][$cid]= $confSess['lastStartpoint'][$cid];
				}

			}

		}

		if ($_SESSION['debugprintlib']!='') {
			$this->debugprintlib=$_SESSION['debugprintlib'];
			$this->debugprintlib['starttime']=microtime(TRUE);
		}

		if ($_SESSION['commentsPageOrigId'] !=0) {
			if ($pid !=0) {
				$pid= $_SESSION['commentsPageOrigId'];
			}

		}

		if (intval($sessioncapdata) == 4) {
			$this->sessionCaptchaData=0;
		} else {
			$this->sessionCaptchaData=1;
		}

		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$this->smiliesPath = str_replace('EXT:toctoc_comments/', t3lib_div::locationHeaderUrl('') .
				t3lib_extMgm::siteRelPath('toctoc_comments'), $conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);
		$this->check = $check;
		$this->AjaxData = $AjaxData;
		if (trim($userpic) != '') {
			if ($_SESSION['userAJAXimage'] != $userpic) {
				$_SESSION['userAJAXimage'] = $userpic;
			}

		}

		$this->newcommentid = -1;
		$this->externalref = $ref;
		$this->ajaxextref = $ajaxextref;
		$this->numberOfLeadingBlanksToReplace=50;
		if (is_array($tctreestate)) {
			$this->tctreestate = $tctreestate;
		}

		if ($conf['theme.']['selectedBoxmodelkoogled']==1) {
			$this->picuploadCSSmargin =' tx-tc-margin0';
			$this->pdfuploadCSSmargin =' tx-tc-pdfupload-koogle';
		}

		$this->boxmodelspacing= intval($conf['theme.']['boxmodelSpacing']);

		if (((trim($conf['code'])=='FORM,COMMENTS') || (trim($conf['code'])=='COMMENTS,FORM') || (trim($conf['code'])=='COMMENTS')) == FALSE) {
			// reset to default
			$conf['code']='COMMENTS,FORM';
		}

		$this->allowHTMLTagsInComments = $conf['advanced.']['allowHTMLTagsInComments'];

		if ($AjaxData != '') {
			$_SESSION['ajaxData']=$AjaxData;
		}

		if ($_SESSION['debugprintlib']!='') {
			$this->debugprintlib['debugtext'] .= ', maincomments init: ' . round(1000*(microtime(TRUE)-$this->debugprintlib['starttime']), 1);
			$this->debugprintlib['starttime']=microtime(TRUE);
		}

		if ($conf['advanced.']['midDot'] != '') {
			$this->middotchar = $conf['advanced.']['midDot'];
		}

		// check if we need to go at all
		if ($fromAjax === TRUE) {

			$_SESSION['commentListCount'] = $cid;

			if ($this->checkExternalUid($conf, $pObj, $fromAjax)) {

				if ($cmd === 'addcomment') {

					$commentingClosed = $this->isCommentingClosed($conf, $pObj);
					if (!$commentingClosed) {
						    $this->processSubmission($conf, $pObj, $piVars, $fromAjax, $feuserid, $pid, $_SESSION['activelangid']);
						    $this->checkAjaxUserPic();
							$content .= $this->form($conf, $pObj, $piVars, $fromAjax, $pid, $feuserid, $userpic, $commentreplyid);

					} else {
						$content .= $this->commentingClosed($pObj, $fromAjax, $conf);
					}

				}

				if ($cmd === 'deletecomment') {
					$content .= $this->processDeleteSubmission($piVars, $pObj);
				}

				if ($cmd === 'showcomments') {
					$this->AJAXimages=$commentspics;
					$content .= $this->comments($conf, $pObj, $fromAjax, $feuserid, $pid);
					$content=$this->topareaHTML.$content;
				}

				if ($cmd === 'showform') {
					$this->AJAXimages = $commentspics;
					$this->checkAjaxUserPic($cid);

					$content .= $this->form($conf, $pObj, $piVars, $fromAjax, $pid, $feuserid, $_SESSION['userAJAXimage'], 0, 0, FALSE);
					if ($_SESSION['AJAXimagesrefresh'] == TRUE) {
						$_SESSION['AJAXimagesrefresh'] = FALSE;
						$_SESSION['AJAXimagesrefreshImage']='';
					}
					//print $content;die();
				}

				if ($cmd === 'updateAJAXdata') {
					$content .= $this->updateAjaxData($feuserid, $conf);
				}

				if (($cmd === 'browse') || ($cmd === 'browsehide')) {
					$this->processBrowserSubmission($conf, $pObj, $cmd, $ref);
					if (!isset($_SESSION['lastStartpoint'])) {
						$_SESSION['lastStartpoint'] = array();
					}
					$_SESSION['lastTotalrows'][$cid] = $pObj->totalrows;
					$_SESSION['lastStartpoint'][$cid] = $pObj->startpoint;

					$this->AJAXimages = $commentspics;
					$content .= $this->comments($conf, $pObj, $fromAjax, $feuserid, $pid) . '<div class="dummy"></div><div class="dummy2">' .
					$this->ajaxDataloginSess . '</div>';
					$content=$this->topareaHTML.$content;
					if ( $content=='') {
						$content .= 'No CIDs found';
					}

				}

			}

			$this->resetSessionVars(2);
		} else {
			if ($this->checkExternalUid($conf, $pObj, $fromAjax)) {
				$commentingClosed = $this->isCommentingClosed($conf, $pObj);

				if ($conf['ratings.']['ratingsOnly'] !=0) {

					$content .= $this->comments($conf, $pObj, $fromAjax, intval($GLOBALS['TSFE']->fe_user->user['uid']), $GLOBALS['TSFE']->id);

					if ( $content=='') {
						$content .= 'No CIDs found';
					} else {
						$content =$this->ajaxHeader.$this->topareaHTML.$content;
					}

				} else {

					foreach (t3lib_div::trimExplode(',', $conf['code'], TRUE) as $code) {

						 switch ($code) {
							case 'COMMENTS':
								$this->trackdebug('COMMENTS');
								$content .= $this->comments($conf, $pObj, $fromAjax, intval($GLOBALS['TSFE']->fe_user->user['uid']), $GLOBALS['TSFE']->id);
								$this->trackdebug('COMMENTS');

								if ( $content=='') {
									$content .= 'No CIDs found';
								}

								break;
							case 'FORM':
								if ($commentingClosed) {
									$content .= $this->commentingClosed($pObj, $fromAjax, $conf);
								} else {
									// check form submission
									$this->trackdebug('FORM');
									$content .= $this->form($conf, $pObj, $piVars, $fromAjax, $GLOBALS['TSFE']->id,
											intval($GLOBALS['TSFE']->fe_user->user['uid']), $userpic);
							 		$this->trackdebug('FORM');
								}

								break;
							default:
								 $content .= $this->checkCustomFunctionCodes($code, $pObj);
						 		break;
						}

					}

					$content =$this->ajaxHeader.$this->topareaHTML.$content;

				}

				$contentarr=explode('<div id="dummy"></div>', $content);
				if (count($contentarr)==2) {
					if (($conf['ratings.']['ratingsOnly'] == 1) && ($conf['ratings.']['enableRatings'] == 0)) {
						$contentarr[1] = '';
					}

				}

				$content=implode('', $contentarr);
				$content = $pObj->pi_wrapInBaseClass($content);
				if ($pObj->cachedropped==TRUE) {
					if ($conf['advanced.']['cacheBackTrack']==1) {
					$content = str_replace('class="toctoc-comments-pi1"', 'class="toctoc-comments-pi1 tx-tc-newdata"', $content);
					}

					$pObj->cachedropped=FALSE;
				}
				if ($conf['theme.']['boxmodelLabelInputPreserve']==1) {
					$content = str_replace('class="toctoc-comments-pi1', 'class="toctoc-comments-pi1 tx-tc-responsive', $content);
				}

			}

			$this->resetSessionVars(2);
		}

		if ($_SESSION['debugprintlib']!='') {
			$this->debugprintlib['debugtext'] .= ', maincomments rest: ' . round(1000*(microtime(TRUE)-$this->debugprintlib['starttime']), 1);
			$this->debugprintlib['starttime']=microtime(TRUE);
			$trackingfunctionarr=$this->debugprintlib['trackingfunction'];
			$trackingfunctiontotalarr=array();
			$trackingfunctiondetailarr=array();
			if (is_array($trackingfunctionarr)) {
				foreach  ($trackingfunctionarr as $key => $valarr) {
					$sumoftime=0;
					$countvalarr=count($valarr);
					for($u=0; $u<$countvalarr; $u++) {
							$sumoftime = $sumoftime+$valarr[$u];
							$trackingfunctiondetailarr[$key][$u]=round(($valarr[$u]*1000), 1);
						}

					$trackingfunctiontotalarr[$key]=round(($sumoftime*1000), 1);
				}

			}

			if (count($trackingfunctiontotalarr)>0) {
				ksort($trackingfunctiondetailarr);
				$json = json_encode($trackingfunctiondetailarr);
				$phpStringArray = '<br />Functioncall-times' . str_replace(', "', '"', str_replace(array('{', '}', ':', ',', ']'),
						array(' :<br />', '', ': ', ', ', ']<br />'), $json));
			}

			if (count($trackingfunctiontotalarr)>0) {
				ksort($trackingfunctiontotalarr);
				$json = json_encode($trackingfunctiontotalarr);
				$phpStringArrayTotal = '<br />Total times' . str_replace(array('{', '}', ':', ','), array(' :<br />', '', ': ', ',<br />'), $json);
			}

			$this->debugprintlib['debugtext'] .= $phpStringArrayTotal;

			$_SESSION['debugprintlib']['debugtext'] = $this->debugprintlib['debugtext'];
		}

		$search = array('@<![\s\S]*?--[ \t\n\r]*>@',         // Strip remaining comments including CDATA
					);
		$content = preg_replace($search, '', $content);
		return $content;
	}

	/**
	 * Checks that $this->externalUid represents a real record.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	[type]		$fromAjax: ...
	 * @return	boolean		TRUE, if $this->externalUid is ok
	 */
	protected function checkExternalUid($conf, $pObj, $fromAjax) {
		$result = ($conf['externalPrefix'] == 'pages');
		if (trim($pObj->externalUidString) == '') {
			if (!$result && $pObj->externalUid) {
			// Check other tables
				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', $pObj->foreignTableName,
						'uid=' . intval($pObj->externalUid) . $this->enableFields($pObj->foreignTableName, $pObj, $fromAjax));
				$result = ($row['t'] == 1);
			}
			if ($result == 0) {
				if ((intval($pObj->externalUid)== 0) && (trim($pObj->externalUid) != '')) {
					if (trim($pObj->externalUidString) != '') {
						$result = 1;
					}

				}

			}
		} else {
			$result = 1;
		}

		return $result;
	}

	/**
	 * Commenting functions
	 *
	 *
	 */

	/**
	 * Returns formatted comments.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	object		$pObjCobj: Cobj of the parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$pid: pageid
	 * @return	string		Formatted comments
	 */
	public function comments($conf,&$pObj, $fromAjax, $feuserid, $pid) {

		// Find starting record
		if ($conf['ratings.']['ratingsOnly'] ==0) {

			if ($this->isCommentingClosed($conf, $pObj)) {
				$conf['ratings.']['mode'] = 'static';

			}

			if (isset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'])) {
				$startpoint = $_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'];
			} else {
				$startpoint =-1;
			}

			if ($_SESSION['submittedCid'] == 0) {
				unset($_SESSION['requestCapcha'][$_SESSION['commentListCount']]['startIndex']);
			}

			$condfeusergroup='';
			$condfeusergroupmembers='';
			if ((($conf['advanced.']['wallExtension'] != 0) && (intval($feuserid) !=0)) OR
			 (($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) !=0) && ($conf['advanced.']['showFeUsercomments']==1))) {
				$condfeusergroupmembers=$this->usersGroupmembers($pObj, $fromAjax, $conf);
				$condfeusergroup = ' AND tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser IN ('. $condfeusergroupmembers . ')';
			} else {
				if (($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) ==0)) {
					$condfeusergroup = ' AND tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser=0';
				}

			}

			if ($conf['advanced.']['showFeUsercomments']==0) {
				$condfeusergroup = ' AND tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser=0';
			}

			$rpp = intval($conf['advanced.']['commentsPerPage']);
			$rpp = ($rpp == 0 ? 1 : $rpp);

			if (substr($_SESSION['commentListRecord'], 0, 5)=='tt_co') {
				if ($pObj->foreignTableName == 'pages' ) {
					$whereplus=' AND (external_ref_uid="tt_content_' . $_SESSION['commentListCount'] .'")';
				}

			}

			// total comments count 1st
			$totalcommentscount='';
			$totalcommentsviewcount='';
			$firstcommentview=0;

			$piLLreviewident = '';
			if ($conf['advanced.']['commentReview'] ==1) {
				$piLLreviewident = 'review';
			}

			if (($conf['advanced.']['commentsShowCount'] ==1) || ($conf['advanced.']['countViews'] ==1)) {
				$this->trackdebug('comments commentscounter');
				$wherecommunity='';
				if ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users') {
					$wherecommunity =' AND parentuid=0';
				}
				$tmpwhere=' approved=1 ' . $whereplus . ' AND (' . $pObj->where_dpck . ')' . $wherecommunity;

				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS counter, MIN(tstamp) AS firstcommentview',
						'tx_toctoc_comments_comments', $tmpwhere . $condfeusergroup);
				$commentscounter=intval($row['counter']);
				$firstcommentview=intval($row['firstcommentview']);
				$this->trackdebug('comments commentscounter');
			}

			if ($conf['advanced.']['commentsShowCount'] ==1) {
				if ($commentscounter>=$conf['advanced.']['commentsShowCountLevel']) {
					if ($commentscounter==1) {
						if ($conf['advanced.']['commentsShowCountText'] ==0) {
							// with old standard: text explicit
							$totalcommentscount= '<span class="tx-tc-nbrofcomments">1 </span>' .
							$this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'commentavailable', $fromAjax);
							$totalpostscount='<span class="tx-tc-nbrofcomments">1 </span>' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'postavailable', $fromAjax);
						} elseif ($conf['advanced.']['commentsShowCountText'] == 1) {
							// only number
							$totalcommentscount='<span class="tx-tc-nbrofcomments-1">1</span>';
							$totalpostscount='<span class="tx-tc-nbrofcomments-1">1</span>';
						} elseif ($conf['advanced.']['commentsShowCountText'] == 2) {
							$commentnricon = 'icon_commentson.png';
							$commentnriconcommenttitle='1 ' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'commentavailable', $fromAjax);
							$commentnriconposttitle='1 ' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'postavailable', $fromAjax);
							$totalcommentscount='<span class="tx-tc-nbrofcomment-2"><img class="tx-tc-commentnricon" alt="'
									. $commentnriconcommenttitle . '" title="'
									. $commentnriconcommenttitle
									. '" src="' . $this->locationHeaderUrlsubDir()
									.  t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/'
									. $conf['theme.']['selectedTheme'] . '/img/' . $commentnricon . '" />1</span>';
							$totalpostscount = '<span class="tx-tc-nbrofcomments-2"><img class="tx-tc-commentnricon" alt="'
									. $commentnriconposttitle . '" title=" '
									. $commentnriconposttitle
									. '" src="' . $this->locationHeaderUrlsubDir()
									.  t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/'
									. $conf['theme.']['selectedTheme'] . '/img/' . $commentnricon . '" />1</span>';
						} elseif ($conf['advanced.']['commentsShowCountText'] == 3) {
							// with text short
							$totalcommentscount='<span class="tx-tc-nbrofcomments srt">1 </span>' .
							$this->pi_getLLWrap($pObj, 'comments_recent.tx_toctoc_comments_comments', $fromAjax);
							$totalpostscount='<span class="tx-tc-nbrofcomments srt">1 </span>' .
							$this->pi_getLLWrap($pObj, 'comments_recent.tx_toctoc_comments_comments', $fromAjax);
						}

					} else {
						if ($conf['advanced.']['commentsShowCountText'] == 0) {
							// with old standard: text explicit
							if ($commentscounter==0) {
								$totalcommentscount='<span class="tx-tc-nbrnocomments">'.
								$this->pi_getLLWrap($pObj, 'text_no_comments', $fromAjax) . ' </span>';
								$totalpostscount='<span class="tx-tc-nbrnocomments">'.
								$this->pi_getLLWrap($pObj, 'text_no_comments', $fromAjax) . ' </span>';
							} else {
								$totalcommentscount='<span class="tx-tc-nbrofcomments">'. $commentscounter . '</span> '.
								$this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'commentsavailable', $fromAjax);
								$totalpostscount='<span class="tx-tc-nbrofcomments">'. $commentscounter . '</span> ' .
								$this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'postsavailable', $fromAjax);
							}

						} elseif ($conf['advanced.']['commentsShowCountText'] == 1) {
							// only number
							$totalcommentscount='<span class="tx-tc-nbrofcomments-1">'. $commentscounter . '</span>';
							$totalpostscount='<span class="tx-tc-nbrofcomments-1">'. $commentscounter . '</span>';
						} elseif ($conf['advanced.']['commentsShowCountText'] == 2) {
							if ($commentscounter==0) {
								$totalcommentscount=htmlspecialchars($this->pi_getLLWrap($pObj, 'text_no_comments', $fromAjax));
								$commentnricon = 'icon_commentsoff.png';
							} else {
								$totalcommentscount=$commentscounter . ' '. htmlspecialchars($this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'commentsavailable', $fromAjax));
								$commentnricon = 'icon_commentson.png';
							}

							$commentnriconposttitle='1 ' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'postavailable', $fromAjax);
							$totalcommentscount='<span class="tx-tc-nbrofcomment-2"><img class="tx-tc-commentnricon" alt="'	. $totalcommentscount .
									'" title="' . $totalcommentscount .
									'" src="' . $this->locationHeaderUrlsubDir() .
									t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
									$conf['theme.']['selectedTheme'] . '/img/' . $commentnricon . '" />'. $commentscounter . '</span>';
							$totalpostscount=$totalcommentscount;
						} elseif ($conf['advanced.']['commentsShowCountText'] ==3) {
							// with text short
							if ($commentscounter==0) {
								$totalcommentscount='<span class="tx-tc-nbrnocomments">'. $this->pi_getLLWrap($pObj, 'text_no_comments', $fromAjax) . ' </span>';
								$totalpostscount='<span class="tx-tc-nbrnocomments">'. $this->pi_getLLWrap($pObj, 'text_no_comments', $fromAjax) . ' </span>';
							} else {
								$totalcommentscount='<span class="tx-tc-nbrofcomments srt">'. $commentscounter . ' </span>'.
													$this->pi_getLLWrap($pObj, 'pi1_template.text_views_viewcountcomments', $fromAjax);
								$totalpostscount='<span class="tx-tc-nbrofcomments srt">'. $commentscounter . ' </span>'.
													$this->pi_getLLWrap($pObj, 'pi1_template.text_views_viewcountcomments', $fromAjax);
							}

						}

					}

					if ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users') {
						$totalcommentscount =$totalpostscount;
					}

					$templatecommentscount = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENTSCOUNTSUB###');
					$markerscommentscount= array(
							'###CID###'=> $_SESSION['commentListCount'],
							'###COMMENTSCOUNT###'=> $totalcommentscount,
					);
					$totalcommentscount=$this->t3substituteMarkerArray($templatecommentscount, $markerscommentscount);
				}

			}

			if ($conf['advanced.']['countViews'] ==1) {
				$this->trackdebug('comments countViews');
				$querymerged='SELECT SUM(seen) AS views, MIN(tstampseen) AS firstview
				 FROM tx_toctoc_comments_feuser_mm
				 WHERE deleted= 0 AND pid='.$conf['storagePid']. ' AND seen>0 AND reference = "'.$_SESSION['commentListRecord'].'"';
				$resultmerged= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
				$date='';
				while ($rowsmerged = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged)) {
					if ($date=='') {
						$date=$rowsmerged['firstview'];
						$totalcommentviewscount=intval($rowsmerged['views']);
					}

				}

				if ($totalcommentviewscount==0) {
					$totalcommentviewscount=1;
					$date= time();
				}
 				//compare to date from commentstable
				if ($conf['advanced.']['countViewsAddComments'] ==1) {
					if (intval($firstcommentview) !=0) {
						if ($firstcommentview<$date)  {
							$date= $firstcommentview;
						}

					}

					// formating found date as specified in conf
					$datefirstview=$date;
					if (intval($conf['advanced.']['initialViewsDate'])!=0) {
						//taking value from plugin if exists
						$datefirstview= $conf['advanced.']['initialViewsDate'];
						$date=$datefirstview;
					}

				}

				if ($conf['advanced.']['dateFormatMode'] == 'strftime') {
					$datefirstview=strftime($conf['advanced.']['dateFormat'], $date);
					if ($datefirstview=='') {
						$datefirstview='strftime format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
					}

				} else {
					$datefirstview=date($conf['advanced.']['dateFormat'], $date);
					if ($datefirstview=='') {
						$datefirstview='date format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
					}

				}

				$onlyCounting =FALSE;
				if ($conf['advanced.']['showCountViewsOnlyIfCommentsExist'] ==1) {
					if ($commentscounter==0) {
						$onlyCounting =TRUE;
					}

				}

				if (($conf['advanced.']['showCountViews'] ==1) && ($onlyCounting ==FALSE)) {
					// make the 'views'-Text

					//adding the initial value
					$totalcommentviewscount=$totalcommentviewscount+intval($conf['advanced.']['initialViewsCount']);
					//it can be its smaller than the number of comments found, but this looks bad, therefore commentscount will be the base.

					//1 comment is = 1 view
					if ($conf['advanced.']['countViewsAddComments'] ==1) {
						$totalcommentviewscount=$totalcommentviewscount+$commentscounter;
					}

					$templatecommentviewscount = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENTSVIEWCOUNTSUB###');
					if ($totalcommentviewscount==1) {
						if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.view', $fromAjax);
						} else {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewlong', $fromAjax);
						}

					} else {
						if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.views', $fromAjax);
						} else {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewslong', $fromAjax);
						}

					}

					$strsince='';
					if ($conf['advanced.']['countViewsShowSince'] ==1) {
						$strsince= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.since', $fromAjax) . ' ' . $datefirstview;
					}

					$markerscommentviewscount= array(
							'###CID###'=> $_SESSION['commentListCount'],
							'###RECORD###'=> $_SESSION['commentListRecord'],
							'###FEUSERID###'=> $feuserid,
							'###COMMENTSVIEWCOUNT###'=> $totalcommentviewscount . ' ' . $strviews . $strsince,
							'###STORPID###'=> $conf['storagePid'],
					);
				} else {
					//* only counting is enabled
					$templatecommentviewscount = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENTSVIEWONLYCOUNTSUB###');
					$markerscommentviewscount= array(
							'###CID###'=> $_SESSION['commentListCount'],
							'###RECORD###'=> $_SESSION['commentListRecord'],
							'###FEUSERID###'=> $feuserid,
							'###STORPID###'=> $conf['storagePid'],
					);
				}

				$totalcommentsviewcount.= $this->t3substituteMarkerArray($templatecommentviewscount, $markerscommentviewscount);
				$this->trackdebug('comments countViews');
			}
			$this->trackdebug('comments startpoint');
			$totalcommentscount .=$totalcommentsviewcount;
			if (($conf['advanced.']['countViews'] ==1) && ($conf['advanced.']['commentsShowCount'] ==1)) {
				$totalcommentscount = '<div class="tx-tc-cntandviews">' . $totalcommentscount . '</div>';
			}

			$whereplus.=' AND parentuid=0';
			if (strpos($pObj->where, $whereplus)==0) {
				$pObj->where .= $whereplus;
			}

			list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS counter',
					'tx_toctoc_comments_comments', $pObj->where . $condfeusergroup);
			$commentscounter=intval($row['counter']);

			if ($startpoint < 0) {
				if ($conf['advanced.']['reverseSorting']==0) {
					$startpoint = intval($row['counter']-$rpp) <= 0 ? 0 : (intval($row['counter']-$rpp));
					$hasolderrows = $startpoint;
				} else {
					$startpoint =$rpp;
					$hasolderrows = intval($row['counter']-$rpp) <= 0 ? 0 : (intval($row['counter']-$rpp));
				}

			} else {
				if ($conf['advanced.']['reverseSorting']==0) {
					$hasolderrows = $startpoint;
				} else {
					if ($startpoint == 0) {
						$startpoint =$rpp;
						$hasolderrows = intval($row['counter']-$rpp) <= 0 ? 0 : (intval($row['counter']-$rpp));
					} else {
						$hasolderrows = intval($row['counter']-$startpoint);
					}

				}

			}

			//relations betwenn startpoint and $commentscounter
			if ($conf['advanced.']['reverseSorting']==0) {
				$maxstartpoint =$commentscounter-$rpp;
				if  ($maxstartpoint>=0) {
					if ($maxstartpoint<$startpoint) {
						$startpoint=$maxstartpoint;
					}

				}

			} else {
				$maxstartpoint =$commentscounter;
			}

			$confmaxstepsbackbyolder = $conf['advanced.']['CommentsShowOldPerCID'];
			$stepbackbyolder = $confmaxstepsbackbyolder *$rpp;
			// now $startpoint shoud be 0 or if no we make add checks
			if ($startpoint>0) {
				if ($conf['advanced.']['reverseSorting']==0) {
					$moddiff= ($stepbackbyolder+($commentscounter - $startpoint -  $rpp)) % $stepbackbyolder;
				} else {
					$moddiff= ($startpoint -  $rpp + $stepbackbyolder) % $stepbackbyolder;
				}

				if ($moddiff != 0) {
					//try adjust get next higher startpoint
					if ($conf['advanced.']['reverseSorting']==0) {
						$trystartpoint=$startpoint +  $moddiff -$stepbackbyolder;
						if ($maxstartpoint<= $trystartpoint) {
							$startpoint=$maxstartpoint;
						}

						if ($startpoint< 0) {
							while ($startpoint< 0) {
								$startpoint=$startpoint+$stepbackbyolder;
							}

							if ($startpoint> $maxstartpoint) {
								$startpoint=$maxstartpoint;
							}

						}

					} else {
						$startpoint=$startpoint -  $moddiff +$stepbackbyolder;
						if ($maxstartpoint<= $startpoint) {
							$startpoint=$maxstartpoint;
						}

					}

				}

			}

			if ($conf['advanced.']['reverseSorting']!=0) {
				if ($startpoint<=0) {
					$startpoint=$rpp;
					$start=0;
				} else {

					$start=0;
				}

				$this->limitofrows=$startpoint;
			} else {
				if ($startpoint<0) {
					if (($commentscounter - $rpp) > 0) {
						$startpoint=$commentscounter - $rpp;
					} else {
						$startpoint=0;
					}

				}

			}

			$_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'] = $startpoint;
			if ($conf['advanced.']['reverseSorting']==0) {
				$start = $startpoint;
			}

			$limitofrows=$this->limitofrows;

			// Get records
			$sorting = 'crdate';
			$sortinglvl0 = 'tx_toctoc_comments_comments.crdate';
			if ($conf['advanced.']['reverseSorting']==1) {
				$sortinglvl0 .= ' DESC';
			}

			$this->trackdebug('comments startpoint');

			$this->trackdebug('comments domemcache');
			$domemcache = FALSE;
			if (($conf['advanced.']['useSessionCache']==1) && (intval($conf['advanced.']['wallExtension']) == 0)) {
				$domemcache = TRUE;
			}
			$allrows = array();
			$whynocache='';
			$showsdebugprint= FALSE;
			$txtsdebugprint='';
			$allcommentsstarttime=microtime(TRUE);
			if ($domemcache == TRUE) {
				if (isset($_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
						$feuserid]['Plugincachetimecid']['p' . $pid])) {
					if ($_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$feuserid]['Plugincachetimecid']['p' . $pid]>0) {
						if ($_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachetimecid']['p' .
								$pid] > $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
							$allrows = $_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachecid']['p' . $pid];
							$rowsorig = $_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachecid']['rowsorig_p' . $pid];
							$reviewcommentid = $_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachecid']['reviewcommentid' . $pid];
						} else {
							if ($showsdebugprint) {
									$txtsdebugprint .= ' ****' . date('H:i:s') . ' ****: Cache dropped, last cachetime ' .
											date('H:i:s', $_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] .
													'U' . $feuserid]['Plugincachetimecid']['p' . $pid]) .
													' older than  ' . date( 'H:i:s', $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) .
													', cid: ' .$_SESSION['commentListRecord'] .' ****';
									$whynocache='was dropped';
							}

							$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachetimecid']['p' . $pid]=0;
							$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachecid']['p' . $pid]=array();
							$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachecid']['rowsorig_p' . $pid]=array();
							$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
									$feuserid]['Plugincachecid']['reviewcommentid' . $pid]=0;

							$domemcache=FALSE;
						}

					} else {
						$whynocache='empty';
						$domemcache=FALSE;
					}

				} else {
					$whynocache='not set';
					if (intval($conf['advanced.']['wallExtension']) != 0) {
						$whynocache .= ', wallextension = ' . $conf['advanced.']['wallExtension'];
					}

					$domemcache=FALSE;
				}

				if (count($allrows) == 0) {
					if ($showsdebugprint) {
						$txtsdebugprint .= ' **** No Cache present (Cache ' . $whynocache . ') ****';
					}

					$domemcache=FALSE;
				} else {
					if ($_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
							$feuserid]['Plugincachetimecid']['p' .
							$pid] < $this->getPluginCacheControlTstamp($_SESSION['commentListRecord'])) {
						if ($showsdebugprint) {
								$txtsdebugprint .= ' ****Cache dropped for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] .
								', Userid: ' . intval($feuserid) .' ****';
						}

						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachetimecid']['p' . $pid]=0;
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['p' . $pid]=array();
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['rowsorig_p' . $pid]=array();
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['reviewcommentid' . $pid]=0;

						$domemcache=FALSE;
					} else {
						if ($showsdebugprint) {
							$txtsdebugprint .= ' ****Cache found for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] .
							', Userid: ' . intval($feuserid) .' ****';
						}
					}

				}

			}

			if ($domemcache == FALSE) {
				// for testing most popular sort
				$reviewcommentid = 0;
				$allrowswhereloc = $pObj->where;
				$reviewsql = '';
				if (($conf['advanced.']['commentReview'] == 1) && ($feuserid>0)) {

					$reviewrows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user, uid,approved,crdate,
									commenttitle,firstname,lastname,homepage,
									location,email,content,tx_commentsnotify_notify,remote_addr,SUBSTR(external_ref_uid,12) AS external_ref_uid,
									attachment_id,attachment_subid,parentuid,gender,external_ref,tx_commentsresponse_response',
							'tx_toctoc_comments_comments', $allrowswhereloc . ' AND toctoc_commentsfeuser_feuser=' . $feuserid .
							$condfeusergroup, '', 'CASE WHEN parentuid=0 THEN crdate ELSE (2*UNIX_TIMESTAMP() - crdate) END DESC');
					$cntreviewrows=count($reviewrows);
					if ($cntreviewrows > 0) {
						$reviewcommentid = $reviewrows[0]['uid'];
						$reviewsql = '(tx_toctoc_comments_comments.uid = '.$reviewcommentid.') OR ';
					}
				}

				if ((intval($conf['advanced.']['sortMostPopular']) == 0) && (intval($conf['advanced.']['useMostPopular']) == 0)) {
					// make OFFSET and LIMIT in PHP, this allow mysql to cache the query for later page browseing
					$rowsorig = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid',
							'tx_toctoc_comments_comments', $reviewsql . '(' . $pObj->where . $condfeusergroup . ')', '', $sortinglvl0);
				} else {
					// most popular
					if (intval($conf['advanced.']['sortMostPopular']) != 0) {
						$sortinglvlpop = 'sumilikedislike DESC';
					} else {
						$sortinglvlpop = $sortinglvl0;
					}

					$rowsorigraw = array();
					$rowsorigcrdateraw = array();
					$rowsorig = array();
					$i=0;
					$wherepttm='tx_toctoc_comments_comments.external_ref';

					if (substr($_SESSION['commentListRecord'], 0, 5)=='tt_co') {
						if ($pObj->foreignTableName == 'pages' ) {
							$wherepttm='tx_toctoc_comments_comments.external_ref_uid';
						}

					}

					if ($conf['externalPrefix'] != 'pages') {
						if ($conf['advanced.']['wallExtension'] != 0) {
							$where_dpck = '(external_prefix="tx_community" OR external_prefix="tx_cwtcommunity_pi1") AND ';
						}
					}

					$wherecompletepttm = '(' . $wherepttm . '="'.$_SESSION['commentListRecord'].'") AND';
					if ($condfeusergroupmembers != '') {
						$wherecompletepttm = '';
					}

					$reviewsqlfeusermm = '';
					if ($reviewsql != '') {
						$reviewsqlfeusermm = '(tx_toctoc_comments_comments.uid = SUBSTRING(tx_toctoc_comments_feuser_mm.reference, 29) AND
						tx_toctoc_comments_comments.pid = tx_toctoc_comments_feuser_mm.pid AND tx_toctoc_comments_feuser_mm.reference_scope = 0) AND ';
					}

					$queryrowsorig='SELECT tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
						sum(tx_toctoc_comments_feuser_mm.seen) + '
								. intval($conf['advanced.']['activityMultiplicatorRating']) .
								'*(sum(ilike)+sum(idislike)+sum(CASE WHEN myrating>0 THEN 1 ELSE 0 END)) as sumilikedislike
						FROM tx_toctoc_comments_comments, tx_toctoc_comments_feuser_mm
						WHERE ' . $reviewsqlfeusermm . $reviewsql . '(tx_toctoc_comments_comments.uid = SUBSTRING(tx_toctoc_comments_feuser_mm.reference, 29) AND
						tx_toctoc_comments_comments.pid = tx_toctoc_comments_feuser_mm.pid AND
						tx_toctoc_comments_comments.approved=1 AND tx_toctoc_comments_comments.pid=' . $conf['storagePid'] . ' AND
						tx_toctoc_comments_comments.deleted=0 AND
						tx_toctoc_comments_feuser_mm.deleted=0 AND
						tx_toctoc_comments_feuser_mm.reference_scope=0 AND
						tx_toctoc_comments_comments.hidden=0 AND ' . $where_dpck . $wherecompletepttm . '
						tx_toctoc_comments_comments.parentuid= 0 ' . $condfeusergroup . ')
						GROUP BY tx_toctoc_comments_comments.uid, tx_toctoc_comments_comments.crdate
						ORDER BY ' . $sortinglvlpop;
					$qryrowsorig = $GLOBALS['TYPO3_DB']->sql_query($queryrowsorig);
					$uidswithstats = '0,';
					while ($datarowsorig = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($qryrowsorig)) {
						$rowsorigraw[$datarowsorig['uid']] = $datarowsorig['sumilikedislike'];
						$rowsorigcrdateraw[$datarowsorig['uid']] = $datarowsorig['crdate'];
						$uidswithstats .= $datarowsorig['uid'] . ',';
					}
					$uidswithstats = $uidswithstats . ')';
					$uidswithstats = str_replace(',)', ')', $uidswithstats);
					$uidswithstats = str_replace(')', '', $uidswithstats);
					$reviewsqlexclude = $reviewsql;
					if ($reviewsql !='') {
						$reviewsqlexclude = str_replace(' OR ', ') OR ', $reviewsqlexclude);
						$reviewsqlexclude = '((tx_toctoc_comments_comments.uid NOT IN (' . $uidswithstats .')) AND ' .$reviewsqlexclude;
					}

					$cntrowsorig = count($rowsorigraw);

					$queryrowsorignostats='SELECT tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
						0 as sumilikedislike
						FROM tx_toctoc_comments_comments
						WHERE ' . $reviewsqlexclude . '((tx_toctoc_comments_comments.uid NOT IN (' . $uidswithstats .')) AND
						tx_toctoc_comments_comments.approved=1 AND tx_toctoc_comments_comments.pid=' . $conf['storagePid'] . ' AND
						tx_toctoc_comments_comments.deleted=0 AND
						tx_toctoc_comments_comments.hidden=0 AND ' . $where_dpck . $wherecompletepttm . '
						tx_toctoc_comments_comments.parentuid= 0 ' . $condfeusergroup . ')
						GROUP BY tx_toctoc_comments_comments.uid, tx_toctoc_comments_comments.crdate
						ORDER BY ' . $sortinglvlpop;

					$queryrowsorignostats = $GLOBALS['TYPO3_DB']->sql_query($queryrowsorignostats);
					while ($datarowsorignostats = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($queryrowsorignostats)) {
						$rowsorigraw[$datarowsorignostats['uid']] = $datarowsorignostats['sumilikedislike'];
						$rowsorigcrdateraw[$datarowsorignostats['uid']] = $datarowsorignostats['crdate'];
					}

					$cntrowsorig = count($rowsorigraw);
					if ($reviewsql != '') {
						$reviewsql = ' OR ' . str_replace(' OR ', '', $reviewsql);
					}
					$where_dpckloc = str_replace('external_prefix', 'tx_toctoc_comments_comments.external_prefix', $where_dpck);
					$queryctcnt='SELECT tx_toctoc_comments_comments.uid AS uid,
						' . intval($conf['advanced.']['activityMultiplicatorComment']) . '*count(tta.uid) as cntdirectsubcomments
						FROM tx_toctoc_comments_comments, tx_toctoc_comments_comments tta
						WHERE
						tta.parentuid = tx_toctoc_comments_comments.uid AND
						tta.deleted=0 AND
						tta.approved=1 AND
						tta.hidden=0 AND
						tx_toctoc_comments_comments.pid = tta.pid AND ((
						tx_toctoc_comments_comments.approved=1 AND tx_toctoc_comments_comments.pid=' . $conf['storagePid'] . ' AND
						tx_toctoc_comments_comments.deleted=0 AND
						tx_toctoc_comments_comments.hidden=0 AND ' . $where_dpckloc .$wherecompletepttm . '
						tx_toctoc_comments_comments.parentuid= 0 ' . $condfeusergroup . ')'. $reviewsql . ')
						GROUP BY tx_toctoc_comments_comments.uid';
					$qryctcnt = $GLOBALS['TYPO3_DB']->sql_query($queryctcnt);

					while ($datactcnt = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($qryctcnt)) {
						foreach($rowsorigraw as $key => $value) {
							if ($key == $datactcnt['uid'] ) {
								$value += $datactcnt['cntdirectsubcomments'];
							}

						}

					}

					$ri=0;
					if (intval($conf['advanced.']['sortMostPopular']) == 1) {
						arsort($rowsorigraw, SORT_NUMERIC);
						foreach($rowsorigraw as $key => $value) {
							$rowsorig[$ri]['uid']=$key;
							$rowsorig[$ri]['sumilikedislike']=$rowsorigraw[$key];
							$ri++;
						}

					} else {
						if ($conf['advanced.']['reverseSorting']==1) {
							//desc
							arsort($rowsorigcrdateraw, SORT_NUMERIC);
							foreach($rowsorigcrdateraw as $key => $value) {
								$rowsorig[$ri]['uid']=$key;
								$rowsorig[$ri]['crdate']=$rowsorigcrdateraw[$key];
								$ri++;
							}

							$tmpcntrowsorig = count($rowsorig);
							foreach($rowsorigraw as $key => $value) {
								for ($rii=0;$rii<$tmpcntrowsorig;$rii++) {
									if ($rowsorig[$rii]['uid'] == $key) {
										$rowsorig[$rii]['sumilikedislike']=$rowsorigraw[$key];
										break;
									}

								}
							}

						} else {
							asort($rowsorigcrdateraw, SORT_NUMERIC);
							foreach($rowsorigcrdateraw as $key => $value) {
								$rowsorig[$ri]['uid']=$key;
								$rowsorig[$ri]['crdate']=$rowsorigcrdateraw[$key];
								$ri++;
							}
							$tmpcntrowsorig = count($rowsorig);
							foreach($rowsorigraw as $key => $value) {
								for ($rii=0;$rii<$tmpcntrowsorig;$rii++) {
									if ($rowsorig[$rii]['uid'] == $key) {
										$rowsorig[$rii]['sumilikedislike']=$rowsorigraw[$key];
										break;
									}

								}

							}
						}
					}

				}
			}

			$rowsin = array();
			$ri_i = 0;
			$firstuid= 0;
			$cntrowsorig = count($rowsorig);
			if (($conf['advanced.']['commentReview'] == 1) && ($feuserid>0)) {
				for ($l_i = 0; ($l_i < $cntrowsorig); $l_i++) {
					if ($rowsorig[$l_i]['uid'] == $reviewcommentid)   {
						$rowsin[$ri_i]=$rowsorig[$l_i];
						$ri_i++;
						break;
					}

				}

			}

			for ($sql_i = $start; (($sql_i < $cntrowsorig) && ($sql_i < ($start+$limitofrows))); $sql_i++)	{
				$rowsin[$ri_i]=$rowsorig[$sql_i];
				$firstuid= $rowsorig[$sql_i]['uid'];
				$ri_i++;
			}

			$this->trackdebug('comments domemcache');
			$this->trackdebug('comments domemcacheallrows');
			//make an array with all comments possible from the request
			if ($conf['advanced.']['reverseSorting']==0) {
				$sortinglvlall = $sortinglvl0;

			} else {
				$sortinglvlall = 'CASE WHEN parentuid=0 THEN crdate ELSE (2*UNIX_TIMESTAMP() - crdate) END DESC';
			}

			if ($domemcache == FALSE) {
				$allrowswhereloc = str_replace(' AND parentuid=0', '', $pObj->where);

				$allrows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user, uid,approved,crdate,
									commenttitle,firstname,lastname,homepage,
									location,email,content,tx_commentsnotify_notify,remote_addr,SUBSTR(external_ref_uid,12) AS external_ref_uid,
									attachment_id,attachment_subid,parentuid,gender,external_ref,tx_commentsresponse_response',
						'tx_toctoc_comments_comments', $allrowswhereloc . $condfeusergroup, '', $sortinglvlall);

				//add statvals
				$cntallrows=count($allrows);
				$txtin ='';
				if (intval($conf['advanced.']['showCountCommentViews']) ==1 ) {
					for($stati=0;$stati<$cntallrows;$stati++) {
						$txtin .= '"tx_toctoc_comments_comments_'.$allrows[$stati]['uid'].'",';
					}
					$txtin .= ')';
					$txtin = str_replace(',)', ')', $txtin);
					$txtin = str_replace(')', '', $txtin);

					$totalcommentviewscount=0;
					if ($txtin != '') {
						$querymerged='SELECT SUBSTRING(tx_toctoc_comments_feuser_mm.reference, 29) AS uid, SUM(seen) AS views, MIN(tstampseen) AS firstview

						 FROM tx_toctoc_comments_feuser_mm
						 WHERE deleted= 0 AND pid='.$conf['storagePid']. ' AND seen>0 AND reference IN ('.$txtin.')';
					} else {
						$querymerged='SELECT SUBSTRING(tx_toctoc_comments_feuser_mm.reference, 29) AS uid, SUM(seen) AS views, MIN(tstampseen) AS firstview

						 FROM tx_toctoc_comments_feuser_mm
						 WHERE deleted= 0 AND pid='.$conf['storagePid']. ' AND seen>0 AND reference = ""';
					}

					$resultmerged= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
					$firstviewdate='';
					while ($rowsmerged = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged)) {
						if ($firstviewdate == '') {
							$firstviewdate = $rowsmerged['firstview'];
							$totalcommentviewscount = intval($rowsmerged['views']);
						}

						for($stati=0;$stati<$cntallrows;$stati++) {
							if ($allrows['uid'] == $rowsmerged['uid']) {
								$allrows['firstview'] = $firstviewdate;
								$allrows['commentviewscount'] = $totalcommentviewscount;
							}

						}

						$totalcommentviewscount = 0;
						$firstviewdate = '';
					}

				}

				//resort $allrows if ...
				if ($conf['advanced.']['sortMostPopular'] == 1) {
					$allrowstmp = array();
					$atmpi = 0;
					for($ri=0;$ri<$cntrowsorig;$ri++) {
						for($ari=0;$ari<$cntallrows;$ari++) {
							if ($rowsorig[$ri]['uid']==$allrows[$ari]['uid']) {
								$allrowstmp[$atmpi]=$allrows[$ari];
								$atmpi++;
							}

						}

					}
					for($ari=0;$ari<$cntallrows;$ari++) {
						if ($allrows[$ari]['parentuid']!=0) {
							$allrowstmp[$atmpi]=$allrows[$ari];
							$atmpi++;
						}

					}
					$allrows=array();
					$allrows=$allrowstmp;
				}

				//resort $allrows if ...
				if (($conf['advanced.']['commentReview'] == 1) && ($feuserid>0)) {
					if ($reviewcommentid != 0) {
						$allrowstmp = array();
						$atmpi = 0;

						for($ari=0;$ari<$cntallrows;$ari++) {
							if ($reviewcommentid == $allrows[$ari]['uid']) {
								$allrowstmp[$atmpi]=$allrows[$ari];
								$atmpi++;
							}

						}

						for($ari=0;$ari<$cntallrows;$ari++) {
							if ($reviewcommentid != $allrows[$ari]['uid']) {
								$allrowstmp[$atmpi]=$allrows[$ari];
								$atmpi++;
							}

						}

						$allrows=array();
						$allrows=$allrowstmp;
					}

				}

				if (($conf['advanced.']['useSessionCache']==1) && (intval($conf['advanced.']['wallExtension']) == 0)) {
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachetimecid']['p' . $pid]=round(microtime(TRUE), 0);
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['p' . $pid]=array();
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['p' . $pid]=$allrows;
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['rowsorig_p' . $pid]=array();
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['rowsorig_p' . $pid]=$rowsorig;
						$_SESSION['mcpdata' . $_SESSION['commentListRecord']]['L' . $_SESSION['activelang'] . 'U' .
								$feuserid]['Plugincachecid']['reviewcommentid' . $pid]=$reviewcommentid;
						$txtsdebugprint .= ' **** Cache filled for ' . $_SESSION['commentListRecord']. ', L: ' . $_SESSION['activelang'] .
						', Userid: ' . intval($feuserid) .' ****';
				}

			}

			$this->allrowsarr = array();
			$cntallrows=count($allrows);

			for ($i = 0; $i < $cntallrows; $i++) {
				$this->allrowsarr[$i] = array();
				$this->allrowsarr[$i] = $allrows[$i];

				if (($this->allrowsarr[$i]['uid'] == $firstuid) && ($showsdebugprint == TRUE)) {
					$txtsdebugprint .= ', time: ' . round(1000*(microtime(TRUE)-$allcommentsstarttime), 3) . ' ms';
					$this->allrowsarr[$i]['content'] .= ' DEBUGTEXT: ' . $txtsdebugprint;
					$txtsdebugprint ='';
				}

				$populatityicon = '';
				if ((intval($conf['advanced.']['sortMostPopular']) == 1) || (intval($conf['advanced.']['useMostPopular']) == 1)) {
					if ($conf['advanced.']['showSortMostPopularIcon'] == 1) {
						for($ri=0;$ri<$cntrowsorig;$ri++) {
							if ($rowsorig[$ri]['uid']==$this->allrowsarr[$i]['uid']) {
								$populatitypic='popularitystar.png';
								$populatitypictitle=ucfirst($this->pi_getLLWrap($pObj, 'pi1_template.popularity', $fromAjax)) .
								': ' . $rowsorig[$ri]['sumilikedislike'];
								$populatityicon= '<img class="tx-tc-popularity-pic" alt="' . $populatitypictitle . '" title=" ' . $populatitypictitle
								. '" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
								$conf['theme.']['selectedTheme'] . '/img/' . $populatitypic . '" /> ';
								$this->allrowsarr[$i]['popularityicon'] = $populatityicon;
								$this->allrowsarr[$i]['popularityvalue'] = $rowsorig[$ri]['sumilikedislike'];
								break;
							}

						}
					}

				}

			}
			$this->trackdebug('comments domemcacheallrows');

			// comment to be highlighted
			$hlsctid=0;
			$levelhlt=0;
			$levelhlttopparentid=0;
			// HIGHLIGHT HANDLING
			if (($_GET['toctoc_comments_pi1']['anchor']) || (intval($_SESSION['newcommentid']) > 0)) {
				if (($_SESSION['findanchor'] == '1') || (intval($_SESSION['newcommentid']) > 0)) {
					$this->trackdebug('comments anchor');
					$hlsanchorarr=explode('-', $_GET['toctoc_comments_pi1']['anchor']);
					if ((count($hlsanchorarr)>0) || (intval($_SESSION['newcommentid']) > 0)) {

						if (intval($_SESSION['newcommentid']) > 0) {
							$hlsctid= intval($_SESSION['newcommentid']);
						} else {
							$hlsctid= $hlsanchorarr[(count($hlsanchorarr)-1)];
						}

						// get him!
						$hlsctrow = $this->getBaseCommentsArray($hlsctid);

						//adjust level and visible levels:
						if (isset($hlsctrow['uid'])) {
							if ($hlsctrow['uid'] == $hlsctid) {
								if ($hlsctrow['parentuid']>0) {
						 			$parentidhlt= $hlsctrow['parentuid'];

								 	$levelhlt=1;
								 	do {
									 	$hlsctprow = $this->getBaseCommentsArray($parentidhlt);
									 	$parentidhlt= $hlsctprow['parentuid'];
									 	$levelhlt++;
									 	if ($levelhlt>1000) {
									 		$parentidhlt=0;
									 		return 'endless loop detected at HIGHLIGHT HANDLING';
									 	}

								 	} while ($parentidhlt!=0);
								 	$hlsctrow =$hlsctprow;
								 	$levelhlttopparentid=$hlsctrow['uid'];
								 }

								 if (count($hlsctrow) > 0) {
						 			$_SESSION['findanchorok'] = '1';
						 		 }

							}

						}

					}
					$this->trackdebug('comments anchor');
				}

			}

			$gobed=0;
			if ($hlsctid!=0) {
				if (isset($hlsctrow['uid'])) {
					if ($hlsctrow['parentuid'] == 0) {
						$countrowsin=count($rowsin);
						for ($i = 0; $i < $countrowsin; $i++) {
							if ($hlsctrow['uid'] == $rowsin[$i]['uid']) {
								$gobed=1;
							}

						}
						if ($gobed==0) {
							//add it to recordset
							$rowsin[count($rowsin)]=$hlsctrow;
							$rpp = $rpp +1;
							$gobed=1;
						} else {
							$gobed=0;
						}

					}

				}

			}

			$hasolderrows = $hasolderrows-$gobed;
			// comment to be highlighted end

			//Sorting for comments on comments
			$this->trackdebug('comments commentsoncomments');
			$uidarr = array();
			$uidmetaarr = array();
			$countrowsin=count($rowsin);

			for ($i = 0; $i < $countrowsin; $i++) {
				$uidarr[$i] = $rowsin[$i]['uid'];
				$uidmetaarr['c' . $rowsin[$i]['uid']]['level'] = 0;
				$uidmetaarr['c' . $rowsin[$i]['uid']]['parentuid'] = 0;
				$uidmetaarr['c' . $rowsin[$i]['uid']]['children'] = '';
				$uidmetaarr['c' . $rowsin[$i]['uid']]['allchildren'] = '';
				$uidmetaarr['c' . $rowsin[$i]['uid']]['uid'] = $rowsin[$i]['uid'];
			}

			$uidsubsel = implode(',', $uidarr);
			$uidsubselall = $uidsubsel;

			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($conf['storagePid']);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
			}

			$controlrows=count($rowsin);
			$level=1;
			if ($uidsubsel !='') {
				Do {
					$rowschildrenin = $this->getBaseCommentsArray('', $uidsubsel, TRUE);
					$uidarr = array();
					$controlrows=count($rowschildrenin);
					for ($i = 0; $i < $controlrows; $i++) {
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['level'] = $level;
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['allchildren']  = '';
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['parentuid'] = $rowschildrenin[$i]['parentuid'];
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['uid'] = $rowschildrenin[$i]['uid'];
						$uidmetaarr['c' . $rowschildrenin[$i]['parentuid']]['children'] = $uidmetaarr['c' . $rowschildrenin[$i]['parentuid']]['children'] . ',' .
							$rowschildrenin[$i]['uid'];

						$uidarr[$i] = $rowschildrenin[$i]['uid'];
					}

					if (count($rowschildrenin) > 0) {
						$uidsubsel = implode(',', $uidarr);
						$uidsubselall .= ',' . $uidsubsel;
						$level++;
					}

	            } while ($controlrows != 0);
			}

			//find the allchildren info from the bottom of the hierarchy
			$i=intval($conf['advanced.']['userCommentResponseLevels']);
			do {
				foreach  ($uidmetaarr as $uidmetakey) {
					if ($uidmetakey['level']== $i) {
						$keycommentid= 'c' . $uidmetakey['parentuid'];
						if ($uidmetakey['parentuid']!=0) {
							$allchildren='';
							if (trim($uidmetakey['allchildren']) != '') {
								$allchildren=$uidmetakey['allchildren'];
							}

							$uidmetaarr[$keycommentid]['allchildren'] .= $uidmetakey['uid'] . ', ' . $allchildren;
						}

					}

				}
				$i=$i-1;
			} while ($i >= 0);

			if ($uidsubselall=='') {
				$uidsubselall='0';
			}

            $rowsin = $this->getBaseCommentsArray('', $uidsubselall);
            $i = 0;
            $controlrows = 1;
            $nextlevelidarr=array();
           	$nextlevelidarr[0]=0;
           	$nextparentuid=0;
           	$outp=0;
            $processingpoint=0;

            //build feusers owned rows
            $userrows= array();
            $userrowscrd= array();
            $this->userrows='';
            $ui=0;
            if (intval($feuserid) != 0) {
            	foreach ($rowsin as $row) {
            		if ($row['toctoc_commentsfeuser_feuser'] == $feuserid) {
             			$userrowscrd[$row['crdate']]=$row['uid'];
            		}

            	}

            	if (count($userrowscrd)>0) {
            		sort($userrowscrd, SORT_NUMERIC);
					$userrows=array_reverse($userrowscrd);

            		$jur = 0;
            		$userrowsout=array();
            		foreach ($userrows as $userrow) {
            			$userrowsout[$jur]=$userrow;
            			$jur++;
            		}

            		$spliceval=intval($conf['advanced.']['commentsEditBack']);
            		if (count($userrowsout) <= $spliceval) {
            			$spliceval=count($userrowsout);
            		}

            		if (count($userrowsout) != $spliceval) {
            			array_splice($userrowsout, $spliceval);
            		}

            		$this->userrows=implode(',', $userrowsout);
	           	}

            }

			$jlc=0;

	        if (count($rowsin)>0) {
	            Do {
	            	// find next required level
	            	$levelreq= 0;
	            	$levelfound= FALSE;
	            	$countnextlevelidarr=count($nextlevelidarr);
	            	for ($j = 1; $j < $countnextlevelidarr; $j++) {
	            		// level 0 is always 0 so we start at 1
	            		if ($nextlevelidarr[$j]!=0) {
	            			// 0: the end of the list is reached, the level to work on is jsut the level below.
	            			// !=0: there's a parentid for this level stored, we suggest this level to work on
	            			$levelreq= $j;
	            			$levelfound= TRUE;
	            		}

	            	}

	            	if ($levelfound== FALSE) {
	            		$levelreq= 0;
	            	}

	            	$nextparentuid=$nextlevelidarr[$levelreq];

					$levelexpandoverride=0;
	            	// we scan all rows (odered by crdate), starting from the last processed row
					$countrowsin=count($rowsin);
	            	for ($p = $processingpoint; $p < $countrowsin; $p++) {
	            		//check if its the right level
	            		if (!$rowsin[$p]['processed']) {
			            	if ($uidmetaarr['c' . $rowsin[$p]['uid']]['level'] == $levelreq) {
			            		// check if it's the right parent uid
								if (($levelreq<=1) && ($uidmetaarr['c' . $rowsin[$p]['uid']]['uid']==$levelhlttopparentid )) {
									$levelexpandoverride=1;
								}

								if (($levelreq== 0) && ($uidmetaarr['c' . $rowsin[$p]['uid']]['uid']!=$levelhlttopparentid )) {
									$levelexpandoverride=0;
								}

			            		if ($uidmetaarr['c' . $rowsin[$p]['uid']]['parentuid'] == $nextlevelidarr[$levelreq]) {
					            	$rowsin[$p]['level'] = $uidmetaarr['c' . $rowsin[$p]['uid']]['level'];
					            	$rowsin[$p]['children'] = substr($uidmetaarr['c' . $rowsin[$p]['uid']]['children'], 1);
					            	$rowsin[$p]['allchildren'] = $uidmetaarr['c' . $rowsin[$p]['uid']]['allchildren'];
					            	$rowsin[$p]['replies'] = 0;
					            	$rowsin[$p]['processed'] = 1;
					            	$rowsin[$p]['levelexpandoverride'] = $levelexpandoverride;

					            	foreach ($uidmetaarr as $uidmetakey) {
					            		if ($uidmetakey['parentuid']==$rowsin[$p]['uid']) {
					            			$rowsin[$p]['replies']++;
					            		}

					            	}

					            	if ($rowsin[$p]['replies'] > 0) {
					            		// Replies? We store the uid of the level and the number of expected replies in this level
					            		$nextlevelidarr[$levelreq+1]=$rowsin[$p]['uid'];
					            		$nextlevelcountarr[$levelreq+1]=$rowsin[$p]['replies'];

					            	} else {
					            		$nextlevelidarr[$levelreq+1]=0;
					            		$nextlevelcountarr[$levelreq+1]=0;
					            	}

					            	// number of replies in the level goes down by 1
					            	$nextlevelcountarr[$levelreq]=$nextlevelcountarr[$levelreq]-1;
					            	if ($nextlevelcountarr[$levelreq]<=0) {
					            		//if no more replies, then on this level the id to search for can be set to 0
					            		$nextlevelidarr[$levelreq]=0;
					            	}

					            	$rows[$outp]=$rowsin[$p];
					            	$outp++;
					            	if ($p == $processingpoint) {
					            		$processingpoint++;
					            	}

					            	break;
			            		}

			            	}

	            		} else {
	            			if ($p == $processingpoint) {
	            				$processingpoint++;
	            			}

	            		}

	            		$countrowsin = count($rowsin);
	            	}

	            	if ($processingpoint >= count($rowsin)) {
	            		$controlrows = 0;
	            	}

	            	$jlc++;
	            	if ($jlc > 9999) {
	            		$controlrows = 0;
	            		//return 'endless loop detected at find next required level';
	            	}

	            } while ($controlrows != 0);
	       	}

	       	$this->trackdebug('comments commentsoncomments');

			$tmpuid=$pObj->externalUid;
			$subParts = array(
					'###SINGLE_COMMENT###' => $this->comments_getComments($rows, $conf, $pObj, $feuserid, $fromAjax, $pid, $levelhlt),
					'###SITE_REL_PATH###' =>  t3lib_div::locationHeaderUrl('') . t3lib_extMgm::siteRelPath('toctoc_comments'),
			);
		} else {
			$subParts = array(
					'###SINGLE_COMMENT###' => '',
					'###SITE_REL_PATH###' =>  t3lib_div::locationHeaderUrl('') . t3lib_extMgm::siteRelPath('toctoc_comments'),
			);
		}

		$this->trackdebug('comments vote scope');
		$externalbegin=substr($this->externalref, 0, 5);
		if (($this->externalref != '') && ($externalbegin != 'pages')) {
			if ($this->ajaxextref != '') {
				//ajaxextref: needed to build correct js calls for toctoc_comments_submit
				// it's token from pi and filled if its not a tt_content record
				$externalref = $this->ajaxextref;
			} else {
				$externalref = $this->externalref;
			}

		} else {
			if ($this->ajaxextref != '') {
				$externalref = $this->ajaxextref;
			} else {
				$externalref = 'tt_content_' . $_SESSION['commentListCount'];
			}

		}

		if ($conf['advanced.']['commentReview'] != 0) {
			$savuseMyVote = $conf['ratings.']['useMyVote'];
			$savuseVotes = $conf['ratings.']['useVotes'];
			$conf['ratings.']['useMyVote'] = 1;
			$conf['ratings.']['useVotes'] = 1;
		}

		$externalrefscope = $externalref;
		if (intval($conf['ratings.']['enableRatings']) !=0) {
			$scopearr= array();
			$scopearr= explode(',', trim($_SESSION['ratingsscopes'][$_SESSION['commentListRecord']]));
			$j=0;
			if ((count($scopearr)==0) || ((count($scopearr) == 1) && ($scopearr[0] == ''))) {
				$scopearr[0]=array();
				$scopearr[0]['uid']=0;
				$scopearr[0]['scope_title']='';
				$scopearr[0]['scope_description']='';
				$j=1;
			} else {
				if (intval($conf['ratings.']['useOverallScopeForVote']) == 1) {
					$scopearr[0]=array();
					$scopearr[0]['uid']=0;
					$scopearr[0]['scope_title']=$this->pi_getLLWrap($pObj, 'api_rating.votescopeoveraall', $fromAjax);
					$scopearr[0]['scope_description']=$this->pi_getLLWrap($pObj, 'api_rating.votescopeoveraalldesc', $fromAjax);
					$j=1;
				}

			}

			// now do we have cscopes in current language?
			$scopesavailableincurrentlanguage= 0;
			$cntsess=count($_SESSION['ratingsscopesinternalm1tablelan'][$_SESSION['commentListRecord']]);
			for ($i=0; $i<$cntsess; $i++){
				if ($_SESSION['ratingsscopesinternalm1tablelan'][$_SESSION['commentListRecord']][$i]==$_SESSION['activelangid']) {
					$scopesavailableincurrentlanguage= $_SESSION['activelangid'];
				}

			}

			//copy the scopes in correct language from session to local var
			$cntsess=count($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']]);
			for ($i=0; $i<$cntsess; $i++){
					if ($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']][$i]['sys_language_uid'] == $scopesavailableincurrentlanguage) {
						$scopearr[$j]=$_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']][$i];
						$j++;
					}

			}

			$articlerating = array();

			for ($i=0; $i<$j; $i++){
				if ($scopearr[$i]['uid']==0) {
					$externalrefscope = $externalref;
					$scopeid=0;
				} else {
					$externalrefscope = $externalref;
					$scopeid=$scopearr[$i]['uid'];
				}

				$articlerating[$i] = array();
				$compics=array();
				$saveconfstaticmode= $conf['ratings.']['mode'];
				$saveconfstaticmodeplus= $conf['ratings.']['mode'];
				if (intval($conf['ratings.']['useOverallScopeForVote']) == 1) {
					if (intval($conf['ratings.']['enableOverallScopeForVote'])==0) {
						if (($i==0) && (count($scopearr)>1)) {
							$conf['ratings.']['modeplus']='autostatic';
						}

					}

				}

				if (($feuserid==0) && ($conf['advanced.']['commentReview'] != 0)) {
					 $conf['ratings.']['mode'] = 'static';
				}

				if (($i==0) && ($scopeid!=0)) {

					$articleratingtmp = $this->getRatingDisplay($externalrefscope, $conf, $fromAjax, $_SESSION['commentsPageId'], TRUE,
							$feuserid, 'votearticle', $pObj, $_SESSION['commentListCount'], 0, $compics, 0, $conf['advanced.']['commentReview']);
					$articleratingtmp['ilike'] = str_replace('\'like\',', '\'liketop\',', $articleratingtmp['ilike'] );
					$articleratingtmp['idislike'] = str_replace('\'unlike\',', '\'unliketop\',', $articleratingtmp['idislike'] );
					$articleratingtmp['ilike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articleratingtmp['ilike'] );
					$articleratingtmp['idislike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articleratingtmp['idislike'] );

					$articleratingtmpvotingarr = explode('<div class="tx-tc-rts-container">', $articleratingtmp['voteing'] );
					$articleratingtmpvoting = $articleratingtmpvotingarr[0];

				}

				$articlerating[$i] = $this->getRatingDisplay($externalrefscope, $conf, $fromAjax, $_SESSION['commentsPageId'], TRUE,
						$feuserid, 'votearticle', $pObj, $_SESSION['commentListCount'], 0, $compics, $scopeid, $conf['advanced.']['commentReview']);
				if (($i==0) && ($scopeid!=0)) {
					$articlerating[$i]['ilike'] = $articleratingtmp['ilike'];
					$articlerating[$i]['idislike'] = $articleratingtmp['idislike'];
					$articlerating[$i]['mylikehtml'] = $articleratingtmp['mylikehtml'];
					$articlerating[$i]['mydislikehtml'] = $articleratingtmp['mydislikehtml'];
					$articleratingtmpvotingarr = explode('<div class="tx-tc-rts-container">', $articlerating[$i]['voteing'] );
					if (trim($articleratingtmpvoting .$articleratingtmpvotingarr[1])!='') {
						$articlerating[$i]['voteing']  = $articleratingtmpvoting . '<div class="tx-tc-rts-container">'. $articleratingtmpvotingarr[1];
					}

				} else {

					$articlerating[$i]['ilike'] = str_replace('\'like\',', '\'liketop\',', $articlerating[$i]['ilike'] );
					$articlerating[$i]['idislike'] = str_replace('\'unlike\',', '\'unliketop\',', $articlerating[$i]['idislike'] );
					$articlerating[$i]['ilike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articlerating[$i]['ilike'] );
					$articlerating[$i]['idislike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articlerating[$i]['idislike'] );

				}

				$conf['ratings.']['mode']=$saveconfstaticmode;
				$conf['ratings.']['modeplus']=$saveconfstaticmodeplus;
			}

		}
		$this->trackdebug('comments vote scope');
		$this->trackdebug('sharrre');
		$isReviewClass = '';
		if ($conf['advanced.']['commentReview'] ==1) {
			$isReviewClass = ' tx-tx-share-in-review';
		}

		$shareHTML='';
		$stylecomment='';
		if ($conf['sharing.']['useSharing'] !=0 ) {

			$confdontUseSharingStumbleupon = $conf['sharing.']['dontUseSharingStumbleupon'];
			$confdontUseSharingDigg = $conf['sharing.']['dontUseSharingDigg'];
			if (@$_SERVER['HTTPS'] == 'on') {
				// on https StumbleUpon and Digg fail
				$confdontUseSharingStumbleupon = 1;
				$confdontUseSharingDigg = 1;

			}
			$sharelistfacebook = '';
			$sharelisttwitter = '';
			$sharelistgoogle = '';
			$sharelistlinkedin = '';
			$shareliststumbleupon = '';
			$sharelistpinterest = '';
			$sharelistdigg = '';
			$sharelistdelicious = '';
			$sharehtmlfacebook = '';
			$sharehtmltwitter = '';
			$sharehtmlgoogle = '';
			$sharehtmllinkedin = '';
			$sharehtmlstumbleupon = '';
			$sharehtmlpinterest = '';
			$sharehtmldigg = '';
			$sharehtmldelicious = '';
			$sharejsfacebook = '';
			$sharejstwitter = '';
			$sharejsgoogle = '';
			$sharejslinkedin = '';
			$sharejsstumbleupon = '';
			$sharejspinterest = '';
			$sharejsdigg = '';
			$sharejsdelicious = '';
			$addthistwitter = '';
			$addthisfacebook = '';
			$addthisgoogle = '';
			$addthislinkedin = '';
			$addthisstumbleupon = '';
			$addthispinterest = '';
			$addthisdigg = '';
			$addthisdelicious = '';
			$addthisconfig = '';
			$sharelistfacebookputacomma = FALSE;
			$sharelisttwitterputacomma = FALSE;
			$sharelistgoogleputacomma = FALSE;
			$sharelistlinkedinputacomma = FALSE;
			$shareliststumbleuponputacomma = FALSE;
			$sharelistpinterestputacomma = FALSE;
			$sharelistdiggputacomma = FALSE;
			$sharelistdeliciousputacomma = FALSE;

			$hasValidSharingItems = 0;
			$fblang= $_SESSION['activelang'] . '_' . strtoupper($_SESSION['activelang']);
			$golang= $_SESSION['activelang'];
			$twlang= $_SESSION['activelang'];
			if ($golang=='en') {
				$golang.= '-US';
				$fblang= $_SESSION['activelang'] . '_US';
			} else {

				$fblang= $golang . '_' . strtoupper($golang);
				$twlang =$golang;

				if ($golang==='dk') {
					$fblang='da_DK';
					$twlang ='en';
					$golang='da-DK';
				}

				if ($golang==='gr') {
					$fblang='el_GR';
					$twlang ='en';
					$golang='el-GR';
				}

				if ($golang==='nl') {
					$twlang ='en';
				}

				if ($golang==='he') {
					$fblang='he_IL';
					$golang='he-IL';
				}
			}

			if (intval($conf['sharing.']['useSharing']) == 1) {
				if (intval($conf['sharing.']['useSharingDesign']) == 4) {
					//addthis
					if (intval($conf['sharing.']['dontUseSharingTwitter']) !== 1) {
						$addthistwitter = '<a class="addthis_button_tweet"></a>';
					}

					if (intval($conf['sharing.']['dontUseSharingFacebook']) !== 1) {
						$addthisfacebook = '<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>';
					}

					if (intval($conf['sharing.']['dontUseSharingGoogle']) !== 1) {
						$addthisgoogle = '<a class="addthis_button_google_plusone" g:plusone:size="medium"></a> ';
					}

					if (intval($conf['sharing.']['dontUseSharingLinkedIn']) !== 1) {
						$addthislinkedin = ' <a class="addthis_button_linkedin_counter"></a>';
					}

					if (intval($conf['sharing.']['dontUseSharingStumbleupon']) !== 1) {
							$addthisstumbleupon = '<a class="addthis_button_stumbleupon_badge"></a>';
					}

					if (intval($conf['sharing.']['dontUseSharingPinterest']) !== 1) {
						$addthispinterest = '';
					}

					if (intval($conf['sharing.']['dontUseSharingDigg']) !== 1) {
						$addthisdigg = '<a class="addthis_button_digg"></a>';
					}

					if (intval($conf['sharing.']['dontUseSharingDelicious']) !== 1) {
						$addthisdelicious = '<a class="addthis_button_delicious"></a>';
					}

					if (intval($conf['sharing.']['dontUseSharingAddThisMore']) !== 1) {
						$addthismore = '<a class="addthis_counter addthis_pill_style"></a>';
					}

					$addthisconfig = '"data_track_addressbar":false';
				}

				$sharejstemplate = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREJSCALL###');
				if ($conf['sharing.']['dontUseSharingFacebook'] !=1 ) {
					$sharehtmlfacebook='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
						' facebook" class="facebook tx-tc-textlink">f</span>';
					$sharelistfacebook = 'facebook: true';
					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharelistfacebookputacomma = TRUE;
					// make the JavaScript template
					$markers= array(
							'###CLICKFUNCTION###'=> '.facebook',
							'###OPENPOPUPVAR###'=> 'facebook',
					);
					$sharejsfacebook= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
					// for design with buttons
					$sharebuttonfacebook = "facebook: {layout: 'box_count', lang: '" . $fblang . "'}";
				}

				if ($conf['sharing.']['dontUseSharingTwitter'] !=1 ) {
					$conf['sharing.']['noShareCount'] = 1;
					$sharelisttwitter = 'twitter: true';
					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharebuttontwitter = "twitter: {count: 'vertical', lang: '".$twlang ."'}";
					//lang: 'en'
					$sharehtmltwitter='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
						' Twitter" class="twitter tx-tc-textlink">t</span>';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					$sharelisttwitterputacomma = TRUE;
					$markers= array(
							'###CLICKFUNCTION###'=> '.twitter',
							'###OPENPOPUPVAR###'=> 'twitter',
					);
					$sharejstwitter= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				if ($conf['sharing.']['dontUseSharingGoogle'] !=1 ) {
					$sharelistgoogle = 'googlePlus: true';
					$sharebuttongoogle = "googlePlus: {size: 'tall', annotation:'bubble', lang: '".$golang."'}";
					$sharehtmlgoogle='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
						' Google+" class="googleplus tx-tc-textlink">+1</span>';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
						$sharelisttwitterputacomma = FALSE;
						$sharebuttontwitter .= ',';
					}

					$sharelistgoogleputacomma = TRUE;
					$hasValidSharingItems = $hasValidSharingItems+1;
					$markers= array(
							'###CLICKFUNCTION###'=> '.googleplus',
							'###OPENPOPUPVAR###'=> 'googlePlus',
					);
					$sharejsgoogle= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				if ($conf['sharing.']['dontUseSharingLinkedIn'] !=1 ) {
					$sharelistlinkedin = 'linkedin: true';
					$sharebuttonlinkedin="linkedin: {counter: 'top'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
						$sharelisttwitterputacomma = FALSE;
						$sharebuttontwitter .= ',';
					}

					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ',';
						$sharelistgoogleputacomma = FALSE;
						$sharebuttongoogle .= ',';
					}

					$sharelistlinkedinputacomma = TRUE;
					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmllinkedin='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
						' LinkedIn" class="linkedin tx-tc-textlink">L</span>';
					$markers= array(
							'###CLICKFUNCTION###'=> '.linkedin',
							'###OPENPOPUPVAR###'=> 'linkedin',
					);
					$sharejslinkedin= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				if ($confdontUseSharingStumbleupon !=1 ) {
					$shareliststumbleupon = 'stumbleupon: true';
					$sharebuttonstumbleupon = "stumbleupon: {layout: '5'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
						$sharelisttwitterputacomma = FALSE;
						$sharebuttontwitter .= ',';
					}

					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ',';
						$sharelistgoogleputacomma = FALSE;
						$sharebuttongoogle .= ',';
					}

					if ($sharelistlinkedinputacomma) {
						$sharelistlinkedin .= ',';
						$sharelistlinkedinputacomma = FALSE;
						$sharebuttonlinkedin .= ',';
					}

					$shareliststumbleuponputacomma = TRUE;

					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmlstumbleupon='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
						' Stumbleupon" class="stumbleupon tx-tc-textlink">S</span>';
					$markers= array(
							'###CLICKFUNCTION###'=> '.stumbleupon',
							'###OPENPOPUPVAR###'=> 'stumbleupon',
					);
					$sharejsstumbleupon= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				if ($conf['sharing.']['dontUseSharingPinterest'] !=1 ) {
					$sharelistpinterest = 'pinterest: true';
					$sharebuttonpinterest = "pinterest: {media: '', description: jQuery('#shareme".$_SESSION['commentListCount'].
											"').data('text'), layout: 'vertical'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
						$sharelistlisttwitterputacomma = FALSE;
						$sharebuttontwitter .= ',';
					}

					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ',';
						$sharelistgoogleputacomma = FALSE;
						$sharebuttongoogle .= ',';
					}

					if ($sharelistlinkedinputacomma) {
						$sharelistlinkedin .= ',';
						$sharelistlinkedinputacomma = FALSE;
						$sharebuttonlinkedin .= ',';
					}

					if ($shareliststumbleuponputacomma) {
						$shareliststumbleupon .= ',';
						$shareliststumbleuponputacomma = FALSE;
						$sharebuttonstumbleupon .= ',';
					}

					$sharelistpinterestputacomma = TRUE;

					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmlpinterest='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
					' Pinterest" class="pinterest tx-tc-textlink">P</span>';
					$markers= array(
							'###CLICKFUNCTION###'=> '.pinterest',
							'###OPENPOPUPVAR###'=> 'pinterest',
					);
					$sharejspinterest= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				if ($confdontUseSharingDigg !=1 ) {
					$sharelistdigg = 'digg: true';
					$sharebuttondigg = "digg: {type: 'DiggMedium'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
						$sharelistlisttwitterputacomma = FALSE;

						$sharebuttontwitter .= ',';
					}

					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ',';
						$sharelistgoogleputacomma = FALSE;
						$sharebuttongoogle .= ',';
					}

					if ($sharelistlinkedinputacomma) {
						$sharelistlinkedin .= ',';
						$sharelistlinkedinputacomma = FALSE;
						$sharebuttonlinkedin .= ',';
					}

					if ($shareliststumbleuponputacomma) {
						$shareliststumbleupon .= ',';
						$shareliststumbleuponputacomma = FALSE;
						$sharebuttonstumbleupon .= ',';
					}

					if ($sharelistpinterestputacomma) {
						$sharelistpinterest .= ',';
						$sharelistpinterestputacomma = FALSE;
						$sharebuttonpinterest .= ',';
					}

					$sharelistdiggputacomma = TRUE;

					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmldigg='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
					' Digg" class="digg tx-tc-textlink">Di</span>';
					$markers= array(
							'###CLICKFUNCTION###'=> '.digg',
							'###OPENPOPUPVAR###'=> 'digg',
					);
					$sharejsdigg= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				if ($conf['sharing.']['dontUseSharingDelicious'] !=1 ) {
					$sharelistdelicious = 'delicious: true';
					$sharebuttondelicious = "delicious: {size: 'tall'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
						$sharelistfacebookputacomma = FALSE;
						$sharebuttonfacebook .= ',';
					}

					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
						$sharebuttontwitter .= ',';
					}

					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ',';
						$sharebuttongoogle .= ',';
					}

					if ($sharelistlinkedinputacomma) {
						$sharelistlinkedin .= ',';
						$sharebuttonlinkedin .= ',';
					}

					if ($shareliststumbleuponputacomma) {
						$shareliststumbleupon .= ',';
						$sharebuttonstumbleupon .= ',';
					}

					if ($sharelistpinterestputacomma) {
						$sharelistpinterest .= ',';
						$sharebuttonpinterest .= ',';
					}

					if ($sharelistdiggputacomma) {
						$sharelistdigg .= ',';
						$sharebuttondigg .= ',';
					}
					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmldelicious='<span title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) .
					' Delicious" class="delicious tx-tc-textlink">De</span>';
					$markers= array(
							'###CLICKFUNCTION###'=> '.delicious',
							'###OPENPOPUPVAR###'=> 'delicious',
					);
					$sharejsdelicious= $this->t3substituteMarkerArray($sharejstemplate, $markers) . "\n";
				}

				$sharingtext = $this->pi_getLLWrap($pObj, 'text_share', $fromAjax);
				$sharingUsersTotalText = $this->pi_getLLWrap($pObj, 'text_share_this_page', $fromAjax);

				if (intval($conf['sharing.']['useSharingDesign']) === 0) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRRE###');
				} elseif (intval($conf['sharing.']['useSharingDesign']) === 1) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREDESIGN2###');
				} elseif (intval($conf['sharing.']['useSharingDesign']) === 2) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREDESIGN3###');
				} elseif (intval($conf['sharing.']['useSharingDesign']) === 3) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREDESIGN4###');
				} elseif (intval($conf['sharing.']['useSharingDesign']) === 4) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREDESIGNADDTHIS###');
				}

				if (intval($conf['sharing.']['staticMode']) == 1) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREDESIGN5###');
					$conf['sharing.']['useSharingDesign'] = 3;
				}

				if (intval($conf['sharing.']['useSharingDesign']) == 5) {
					$templatesharrre = $this->t3getSubpart($pObj, $pObj->templateCode, '###SHARRREDESIGN5###');
					$conf['sharing.']['useSharingDesign'] = 3;
					$conf['sharing.']['staticMode'] = 1;
				}

				$sharedUsersTotalText = $sharingUsersTotalText;
				$pageTitle = '';
				if ($_SESSION['commentsPageTitles'][$pid] == '') {
					$pageTitle = $_SESSION['commentsPageIdsClean'][$pid];
				} else {
					$pageTitle = $_SESSION['commentsPageTitles'][$pid];
				}

				if ($pageTitle == '') {
					$pageTitle = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
				}

				if ($conf['ratings.']['ratingsOnly'] != 1) {
					$sharedtext = $this->pi_getLLWrap($pObj, $piLLreviewident . 'text_share_datatext_comments', $fromAjax) . ' ' . $pageTitle;
				} else {
					$sharedtext = $this->pi_getLLWrap($pObj, 'text_share_datatext', $fromAjax) . ' ' . $pageTitle;
				}

				if ($conf['sharing.']['shareUsersTotalText'] != '') {
					$sharedUsersTotalText = $conf['sharing.']['shareUsersTotalText'];
				}

				if ($conf['sharing.']['shareDataText'] != '') {
					$sharedtext = $conf['sharing.']['shareDataText'];
				}

				$shareicon='';
				if ($conf['sharing.']['useShareIcon'] == 1) {
					$shareicon='<span class="tx-tc-shareicon" title="' . $sharingtext . '"></span>';
					if (intval($conf['sharing.']['staticMode']) == 1) {
						$shareicon='<span class="tx-tc-shareicon" title="' .
						$this->pi_getLLWrap($pObj, 'pi1_template.sharingclosed', $fromAjax) . '"></span>';
					}

				}

				$sharePageURL = $this->getPageURL($fromAjax, $pid);
				if ($conf['sharing.']['sharePageURL'] != '') {
					$sharePageURL = $conf['sharing.']['sharePageURL'];
				}

				 // add the external_prefix and external_ref
				$externalprefixshare = trim($conf['externalPrefix']);
				if ($pObj->foreignTableName == 'pages') {
					$externalrefshare = $pObj->foreignTableName . '_' . $pid;
				} else {
					$externalrefshare = $pObj->foreignTableName . '_' . $pObj->externalUid;
				}

				$txtsut = str_replace('https://', '', str_replace('http://', '', $sharePageURL));
				$txtsotarr= explode('/', $txtsut);
				if ($txtsotarr > 1) {
					array_shift($txtsotarr);
				}

				$txtsut = implode('/', $txtsotarr);
				$textsharePageURL = $this->pi_getLLWrap($pObj, 'pi1_template.topsharings_sharedas', $fromAjax) . ' ' . $txtsut;

				$hidedetails = '';
				$hidedetailstotal = '';
				$hidedetailstotalsbox = '';
				if ($conf['sharing.']['staticMode'] == 1) {
					if ($conf['sharing.']['staticModeNoDetails'] == 1) {
						$hidedetails = ' tx-tc-hidedes5detail';
						$hidedetailstotal = ' tx-tc-hidedes5detailtotal';
						$hidedetailstotalsbox = ' tx-tc-hidedes5detailtotalsbox';
						$sharedUsersTotalText .= '<br><small>' . $textsharePageURL . '</small>';
					}

				}

				$hidesharestotal = '';
				if ($conf['sharing.']['noShareCount'] == 1) {
					$hidesharestotal = 'tx-tc-nodisp';
				}

				$titlewithouttotal = $this->pi_getLLWrap($pObj, 'text_share', $fromAjax);
				$coverimage = '<img class="tx-tc-shrdes5coverimage" src="' . $this->locationHeaderUrlsubDir() .
				t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
				'/img/white90.png"  /><span id="shrdes5covertext' . $_SESSION['commentListCount'] . '" class="tx-tc-shrdes5covertext">' . $textsharePageURL . '</span>';
				$markerssharre= array(
						'###ISREVIEWCLASS###'=> $isReviewClass,
						'###ARTICLESHAREURL###'=> $sharePageURL,
						'###CID###' => $_SESSION['commentListCount'],
						'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
						'###TXTLOADING###' => $this->pi_getLLWrap($pObj, 'pi1_template.loadingsharing', $fromAjax),
						'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
						'###SHAREICON###' => $shareicon,
						'###ARTICLESHARE###' => $sharingtext,
						'###ARTICLESHARETITLE###' => $this->pi_getLLWrap($pObj, 'text_share_title', $fromAjax),
						'###ARTICLESHAREDATATEXT###' => $sharedtext,
						'###ARTICLESHAREDATATITLE###' => $sharedUsersTotalText,
						'###SHARELIST_FACEBOOK###' => $sharelistfacebook,
						'###SHARELIST_TWITTER###' => $sharelisttwitter,
						'###SHARELIST_GOOGLE###' => $sharelistgoogle,
						'###SHARELIST_LINKEDIN###' => $sharelistlinkedin,
						'###SHARELIST_STUMBLEUPON###' => $shareliststumbleupon,
						'###SHARELIST_PINTEREST###' => $sharelistpinterest,
						'###SHARELIST_DIGG###' => $sharelistdigg,
						'###SHARELIST_DELICIOUS###' => $sharelistdelicious,
						'###SHAREHTML_FACEBOOK###' => $sharehtmlfacebook,
						'###SHAREHTML_TWITTER###' => $sharehtmltwitter,
						'###SHAREHTML_GOOGLE###' => $sharehtmlgoogle,
						'###SHAREHTML_LINKEDIN###' => $sharehtmllinkedin,
						'###SHAREHTML_STUMBLEUPON###' => $sharehtmlstumbleupon,
						'###SHAREHTML_PINTEREST###' => $sharehtmlpinterest,
						'###SHAREHTML_DIGG###' => $sharehtmldigg,
						'###SHAREHTML_DELICIOUS###' => $sharehtmldelicious,
						'###JSSHARRRED###' => $sharejsstumbleupon,
						'###JSSHARRREF###' => $sharejsfacebook,
						'###JSSHARRREG###' => $sharejsgoogle,
						'###JSSHARRREL###' => $sharejslinkedin,
						'###JSSHARRRET###' => $sharejstwitter,
						'###JSSHARRREP###' => $sharejspinterest,
						'###JSSHARRREDI###' => $sharejsdigg,
						'###JSSHARRREDE###' => $sharejsdelicious,
						'###SHAREBUTTON_FACEBOOK###' => $sharebuttonfacebook,
						'###SHAREBUTTON_TWITTER###' => $sharebuttontwitter,
						'###SHAREBUTTON_GOOGLE###' => $sharebuttongoogle,
						'###SHAREBUTTON_LINKEDIN###' => $sharebuttonlinkedin,
						'###SHAREBUTTON_STUMBLEUPON###' => $sharebuttonstumbleupon,
						'###SHAREBUTTON_PINTEREST###' => $sharebuttonpinterest,
						'###SHAREBUTTON_DIGG###' => $sharebuttondigg,
						'###SHAREBUTTON_DELICIOUS###' => $sharebuttondelicious,
						'###ADDTHIST###' => $addthistwitter,
						'###ADDTHISF###' => $addthisfacebook,
						'###ADDTHISG###' => $addthisgoogle,
						'###ADDTHISL###' => $addthislinkedin,
						'###ADDTHISD###' => $addthisstumbleupon,
						'###ADDTHISP###' => $addthispinterest,
						'###ADDTHISDI###' => $addthisdigg,
						'###ADDTHISDE###' => $addthisdelicious,
						'###ADDTHISCONFIG###' => $addthisconfig,
						'###ADDTHISMORE###' => $addthismore,
						'###ADDTHISID###' => $conf['sharing.']['AddThisID'],
						'###EXTREF###' => '\'' . $externalrefshare .'\'',
						'###EXTPREFIX###' => '\'' . $externalprefixshare .'\'',
						'###COVERIMAGE###' => $coverimage,
						'###HIDEDETAILSCSS###' => $hidedetails,
						'###HIDEDETAILSCSSTOTAL###' => $hidedetailstotal,
						'###HIDEDETAILSCSSTOTALSBOX###' => $hidedetailstotalsbox,
						'###SHARETOTALVISIBLE###' => $hidesharestotal,
						'###TITLEWITHOUTTOTAL###' => $titlewithouttotal,

				);
				if ($templatesharrre && ($hasValidSharingItems>0)) {
					$shareHTML=$this->t3substituteMarkerArray($templatesharrre, $markerssharre);
					// isolation of javascript, but only for sharrre!
					if (intval($conf['sharing.']['useSharingDesign']) != 4) {
						$shareHTMLarr1 = explode('<script type="text/javascript">', $shareHTML);
						$cntscrpts = count($shareHTMLarr1);
						for ($ji=1; $ji<$cntscrpts; $ji++) {
							$shareHTMLarr2 = explode('</script>', $shareHTMLarr1[$ji]);
							$_SESSION['sharrrejs'] .= $shareHTMLarr2[0];
							$shareHTMLarr1[$ji] = $shareHTMLarr2[1];
						}
						$shareHTML = implode('', $shareHTMLarr1);

					}
					$shareHTML = $shareHTML . '<div id="tx-tc-sharre-id-' . $_SESSION['commentListRecord'] . '" class="tx-tc-sharre-trigger tx-tc-nodisp"></div>';

					$stylecomment =' tx-tc-fleft';
				}

			}

		}

		$ilikedislikeHTML='';
		$this->trackdebug('sharrre');
		if ($conf['ratings.']['enableRatings'] ==1) {
			if (intval($conf['ratings.']['useLikeDislike']) == 1 ) {
				if ((intval($conf['ratings.']['useDislike']) == 1 ) && ($articlerating[0]['idislike']!='')) {
					$ilikedislikeHTML=$articlerating[0]['ilike'] . $articlerating[0]['idislike'];

					if (($articlerating[0]['mydislikehtml'] !='') || (($conf['ratings.']['useVotes']==1) && ($conf['ratings.']['useTopVotes']==1)) ||
							($conf['sharing.']['useSharing']==1) ||
							(($conf['sharing.']['useSharing']==0) && (($conf['ratings.']['useVotes']==0) || ($conf['ratings.']['useTopVotes']==0)) &&
							($conf['ratings.']['ratingsOnly']==0))) {
						$ilikedislikeHTML .= '&nbsp;' . $this->middotchar . '&nbsp;';
						$stylecomment=' tx-tc-fleft';
					}

				} else {
					$ilikedislikeHTML=$articlerating[0]['ilike'];

					if ($articlerating[0]['ilike']!='') {

						if (intval($conf['ratings.']['useDislike']) == 0 ) {
							if (($articlerating[0]['mylikehtml'] != '') || (($conf['ratings.']['useVotes']==1) &&
									($conf['ratings.']['useTopVotes']==1)) || ($conf['sharing.']['useSharing']==1) ||
									(($conf['sharing.']['useSharing']==0) && (($conf['ratings.']['useVotes']==0) ||
									($conf['ratings.']['useTopVotes']==0)) && ($conf['ratings.']['ratingsOnly']==0))) {
								$ilikedislikeHTML.= '&nbsp;' . $this->middotchar . '&nbsp;';
								$stylecomment=' tx-tc-fleft';
							}

						}

					}

				}

			}

		}

		$voteHTML='';
		$countarticlerating=count($articlerating);
		for ($i=0; $i<$countarticlerating; $i++){
			$firstvotedivstart='';
			$firstvotedivend='';

			if (trim($articlerating[$i]['voteing'])!='') {
				$scopetitlehtml='';
				if ($scopearr[$i]['uid']==0) {
					$scopeid=$externalref;
				} else {
					$scopeid=$externalref . '-' . $scopearr[$i]['uid'];
				}

				if($scopearr[$i]['scope_title']!='') {
					$scopetitlebold = '';
					if($i==0) {
						if (intval($conf['ratings.']['useOverallScopeForVote']) == 1) {
							$scopetitlebold = 'bold';
							$scopeid=$externalref;
						}

						$firstvotedivstart='<div class="tx-tc-firstvote">';
						$firstvotedivend='</div>';
					}

					$scopetitlehtml=$firstvotedivstart. '<span id="tx-tc-scope-'.$scopeid.'" title="'. $scopearr[$i]['scope_description'] .
					'" class="tx-tc-scopetitle'.$scopetitlebold.'">'. $scopearr[$i]['scope_title'] . '</span>';
				}

				$divend='';
				if(($i+1)<count($articlerating)) {
					$divend='</div>';
				}

				$divstart='';
				if(($i>0)) {
					if ($conf['advanced.']['commentReview'] ==1) {
						$rtsrws = 'rws';
					} else {
						$rtsrws = 'rts';
					}

					$divstart='<div id="tx-tc-rts-'.$externalref . '-' . $scopearr[$i]['uid'].'" class="tx-tc-' . $rtsrws . '-area">';
				}

				$voteHTML .= $divstart .
							str_replace('<div class="tx-tc-rts-container">', '<div id="tx-tc-rts-container-scp-' .
									$_SESSION['commentListCount'] . '__0' . $scopeid . '" class="tx-tc-rts-cntrdata tx-tc-rts-container">' .
									$scopetitlehtml, $articlerating[$i]['voteing']) .
						    $firstvotedivend . $divend;
			}

		}

		if (($conf['ratings.']['useVotes'] == 0) || ($conf['ratings.']['useTopVotes']==0)) {
     		// kick out the scopes and remaining voting area
			$voteHTML=trim($voteHTML);
			$voteHTML=trim(substr($voteHTML, 0, strpos($voteHTML, 'tx-tc-rts-container')-9));
		}

		$tmpcid=$_SESSION['commentListCount'];
		$templatecommenttop = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENTLINKTOP###');
		$commenttopHTML='';

		if (($conf['ratings.']['ratingsOnly'] ==0) && ($conf['code'] != 'COMMENTS') && (($conf['ratings.']['mode'] != 'static') || ($conf['ratings.']['modeplus'] == 'autostatic'))) {
			$loggedin = 0;
			if ($feuserid > 0) {
				$loggedin = 1;
			}

			$beginstring= '';
			if ((intval($conf['ratings.']['useLikeDislike']) == 0 ) || (intval($conf['ratings.']['useTopLikeDislike']) == 0 )) {
				$beginstring = '&nbsp;';
			}

			if ((intval($conf['advanced.']['useCommentLink']) == 0 ) || (intval($conf['advanced.']['commentReview']) != 0)) {
				$stylecomment=$stylecomment . ' tx-tc-nodisp';
			}

			$sharePageURL = $this->getPageURL($fromAjax, $pid);
			if ($conf['sharing.']['sharePageURL'] != '') {
				$sharePageURL = $conf['sharing.']['sharePageURL'];
			}

			if ($conf['advanced.']['commentReview'] == 0) {
				$add_comment_top = $this->pi_getLLWrap($pObj, 'pi1_template.add_comment_top', $fromAjax);
				$add_comment_title = $this->pi_getLLWrap($pObj, 'pi1_template.add_comment_title', $fromAjax);
			} else {
				$add_comment_top = '';
				$add_comment_title = '';
			}

			$markerstopHTML = array(
					'###ISREVIEWCLASS###'=> $isReviewClass,
					'###ARTICLESHAREURL###'=> $sharePageURL,
					'###BEGINSTRING###' => $beginstring,
					'###LOGGEDIN###'=> $loggedin,
					'###UID###' => $pObj->externalUid,
					'###CID###' => $_SESSION['commentListCount'],
					'###STYLECOMMENT###' => $stylecomment,
					'###TEXT_ADD_COMMENTTOP###' => $add_comment_top,
					'###TEXT_ADD_COMMENTTITLE###' => $add_comment_title,
			);
			$commenttopHTML=$this->t3substituteMarkerArray($templatecommenttop, $markerstopHTML);

		}

		if (($commenttopHTML!='') && ($shareHTML!='')) {
			IF ($conf['ratings.']['useShortTopLikes']==0) {
				$commenttopHTML=str_replace('</a>', '</a>&nbsp;' . $this->middotchar . '&nbsp;', $commenttopHTML);
			}
			$commenttopHTML=str_replace('></a>&nbsp;' . $this->middotchar . '&nbsp;', '></a>', $commenttopHTML);
		}

		$hidecss ='';

		$staticaddonHTML='';
		if ($conf['ratings.']['mode'] == 'static' ) {
			$staticaddonHTML ='-static';
		}

		$attachmentHTML='';
		$attachmentHTMLhide='';
		if (intval($conf['attachments.']['useWebpagePreview']) ===1 ) {
			if (intval($conf['attachments.']['useTopWebpagePreview']) > 0) {
				$attachmentHTML= $this->commentShowWebpagepreview(intval($conf['attachments.']['useTopWebpagePreview']),
						intval($conf['attachments.']['topWebpagePreviewPicture']), $conf, $pObj, $_SESSION['commentListCount'], TRUE, $fromAjax);
				if ((intval($conf['sharing.']['useSharing']) == 0) && (intval($conf['ratings.']['enableRatings']) == 0) &&
						(intval($conf['ratings.']['ratingsOnly']) == 1)) {
					$attachmentHTMLhide=' tx-tc-nodisp';
				}

			}

		}

		$replyoncommentHTML='';
		if (intval($conf['advanced.']['userCommentResponseLevels']) >0) {
			$replyoncommentHTML.= '<a id="comment-ry-' . $_SESSION['commentListCount'] . '" name="comment-ry-' . $_SESSION['commentListCount'] .
				'"></a><div class="tx-tc-ct-ry-frameover" id="tx-tc-ct-ry-frame-' . $_SESSION['commentListCount'] . '" >';

			$replyoncommentHTML.= '<div id="tx-tc-cts-cocfuncs-' . $_SESSION['commentListCount'] . '"  class="tx-tc-cocfuncs tx-tc-nodisp">';
			$replyoncommentHTML.= '<img id="tx-tc-cts-nococ-' . $_SESSION['commentListCount'] . '" src="' . $this->locationHeaderUrlsubDir() .
				t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
				'/img/nopreviewpic.png" height="11" width="12" title="'.$this->pi_getLLWrap($pObj, 'pi1_template.closereply', $fromAjax).
				'" class="tx-tc-coc tx-tc-nodisp" />';
			$replyoncommentHTML.= '</div>';
			$replyoncommentHTML.= '<div class="tx-tc-ct-rybox-title tx-tc-nodisp" id="tx-tc-ct-rybox-title-' . $_SESSION['commentListCount'] . '" >';
			$replyoncommentHTML.= $this->pi_getLLWrap($pObj, 'pi1_template.entercommentoncomment', $fromAjax) . '</div>';
			$replyoncommentHTML.= '<div class="tx-tc-ct-rybox tx-tc-nodisp" id="tx-tc-ct-rybox-' . $_SESSION['commentListCount'] . '" >';
			$replyoncommentHTML.= '</div>';
			$replyoncommentHTML.= '</div>';

			$replyoncommenttopHTML= '';
			if (substr($conf['code'], 0, 4) == 'FORM') {
				$replyoncommenttopHTML=$replyoncommentHTML;
				$replyoncommentHTML= '';
			}

		}

		$topareaHTML='';
		$templatetoparea = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBTOPAREA###');
		$commentsmenu = '';
		if (($cntrowsorig > 1) || ($conf['dataProtect.']['useDisclaimer'] == 1)){
			$commentsmenu = $this->getCommentsMenu($pObj, $conf, $externalref, $fromAjax, $cntrowsorig);
		}

		if ($conf['advanced.']['commentReview'] != 0) {
			$strlistContainsReview = '';
			if ($this->isVoted($externalref, $pObj, 0, $feuserid, $fromAjax) == TRUE) {
				if ($this->isCommented($externalref, $pObj, $feuserid, $fromAjax) > 0) {
					$strlistContainsReview = '__0';
				}
			}
			$voteHTML = '<div class="tx-tc-rws-area" id="tx-tc-rws-area-' . $strlistContainsReview . $externalrefscope . '">' . $voteHTML . '</div>';
		}

		$markerstoparea = array(
				'###ARTICLECOMMENTLINK###' => $commenttopHTML,
				'###HIDECSS###'=> $hidecss,
				'###UID###' => $pObj->externalUid,
				'###REF###' => $externalrefscope,
				'###REFCSS###' => $externalrefscope,
				'###CID###' => $_SESSION['commentListCount'],
				'###ARTICLEVOTE###' => $voteHTML,
				'###TXTCONFIRM###' => $this->pi_getLLWrap($pObj, 'pi1_template.confirm', $fromAjax),
				'###TXTNO###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useno', $fromAjax),
				'###TXTYES###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useyes', $fromAjax),
				'###TXTOK###' => $this->pi_getLLWrap($pObj, 'pi1_template.ok', $fromAjax),
				'###TXTINFO###' => $this->pi_getLLWrap($pObj, 'pi1_template.information', $fromAjax),
				'###ARTICLELIKE###' => $ilikedislikeHTML,
				'###STATICADDON###' => $staticaddonHTML,
				'###ARTICLESHARE###' => $shareHTML,
				'###TOPATTACHMENT###' => $attachmentHTML,
				'###TOPATTACHMENTSTYLEHIDE###' => $attachmentHTMLhide,
				'###REPLYONCOMMENT###'=> $replyoncommentHTML,
				'###REPLYONCOMMENTTOP###'=> $replyoncommenttopHTML,
				'###COMMENTSCOUNT###' => $totalcommentscount,
				'###COMMENTSMENU###' => $commentsmenu,
		);
		$topareaHTML=$this->t3substituteMarkerArray($templatetoparea, $markerstoparea);
		if ((intval($conf['ratings.']['useShortTopLikes']) == 1) || (intval($conf['ratings.']['useLikeDislikeStyle']) == 1)) {
			$repl='/id="tx-tc-myrts-dp-'.$externalrefscope.'-(\d)" class="tx-tc-rts-li/';
			$replw='id="tx-tc-myrts-dp-'.$externalrefscope.'-$1" class="tx-tc-rts-li tx-tc-nodisp';
			$wrkareaHTML=str_replace('id="tx-tc-myrtstop-'.$externalrefscope.'" class="tx-tc-rts-area', 'id="tx-tc-myrtstop-'.$externalrefscope.
					'" class="tx-tc-rts-area tx-tc-nodisp', $topareaHTML);
			$topareaHTML=preg_replace($repl, $replw, $wrkareaHTML);
			$repl='/id="tx-tc-myrts-'.$externalrefscope.'-(\d)" class="tx-tc-rts-area/';
			$replw='id="tx-tc-myrts-'.$externalrefscope.'-$1" class="tx-tc-rts-area tx-tc-nodisp';
			$topareaHTML=preg_replace($repl, $replw, $topareaHTML);
		}

		if (substr($conf['code'], 0, 4) == 'FORM') {
			$topareaHTMLfc='';
			$templatetopareafc = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBTOPAREAFP###');
			$markerstopareafc = array(
					'###TOPAREA###' => $topareaHTML,
					'###REFCSS###' => $externalrefscope,
			);
			$topareafcHTML=$this->t3substituteMarkerArray($templatetopareafc, $markerstopareafc);

			$this->topareaHTML=$topareafcHTML;
			$topareaHTML='';
			if ($conf['ratings.']['ratingsOnly'] ==0) {
				$borderclass= ' txtc_topborder';
			}

		} else {
			$borderclass='';
		}

		if ($conf['advanced.']['commentReview'] != 0) {
			$conf['ratings.']['useMyVote'] = $savuseMyVote;
			$conf['ratings.']['useVotes'] = $savuseVotes;
		}

		$markers = array(
				'###ARTICLECOMMENTLINK###' => $commenttopHTML,
				'###HIDECSS###'=> $hidecss,
				'###UID###' => $pObj->externalUid,
				'###REF###' => $externalref,
				'###REFCSS###' => $externalref,
				'###CID###' => $_SESSION['commentListCount'],
				'###ARTICLEVOTE###' => $articlerating['voteing'],
				'###TXTCONFIRM###' => $this->pi_getLLWrap($pObj, 'pi1_template.confirm', $fromAjax),
				'###TXTNO###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useno', $fromAjax),
				'###TXTYES###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useyes', $fromAjax),
				'###TXTOK###' => $this->pi_getLLWrap($pObj, 'pi1_template.ok', $fromAjax),
				'###TXTINFO###' => $this->pi_getLLWrap($pObj, 'pi1_template.information', $fromAjax),
				'###ARTICLELIKE###' => $ilikedislikeHTML,
				'###STATICADDON###' => $staticaddonHTML,
				'###ARTICLEMYVOTE###' => $myvoteHTML,
				'###TOPATTACHMENT###' => $attachmentHTML,
				'###TOPATTACHMENTSTYLEHIDE###' => $attachmentHTMLhide,
				'###REPLYONCOMMENT###'=> $replyoncommentHTML,
				'###REPLYONCOMMENTTOP###'=> $replyoncommenttopHTML,
				'###COMMENTSMENU###' => $commentsmenu,
				'###COMMENTSCOUNT###' => $totalcommentscount,
				'###SUBTEMPLATE_TOPAREA###' => $topareaHTML,
				'###TOPBORDERCLASS###' => $borderclass,
		);
		// Fetch template
		if (!$fromAjax) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENT_LIST###');
		} else {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENT_LISTAJAX###');
		}

		if (!$fromAjax) {
			if ($this->ajaxHeader=='') {
				$templateajaxHeader = $this->t3getSubpart($pObj, $pObj->templateCode, '###AJAXHEADER###');
				$markersajaxHeader = array(
						'###CID###' => $_SESSION['commentListCount'],
						'###UID###' => $pObj->externalUid,
						'###AJAX_DATA###' => $this->getAjaxJSData($feuserid, $GLOBALS['TSFE']->id, $GLOBALS['TSFE']->lang,
								$conf, $pObj, $tmpcid, $fromAjax, FALSE, $externalref),
						'###AJAX_COMMENTSDATA###' => $this->getAjaxJSDataComments($tmpcid, $pObj, $fromAjax),
						'###AJAX_COMMENTSIMGS###' => $this->getAjaxJSDataCommentImgs($tmpcid, $fromAjax),
						'###IMAGESPRITE###' => $this->makeImageSprite($conf),
				);
				$this->ajaxHeader=$this->t3substituteMarkerArray($templateajaxHeader, $markersajaxHeader);
			}

		}

		// comments browser
		if (($conf['ratings.']['ratingsOnly'] ==0)) {
			$pagebrowserHTML = $this->comments_getCommentsBrowser($rpp, $hasolderrows, $commentscounter, $pObj, $fromAjax, $conf);

			$pagebrowsertopHTML= '';
			if (substr($conf['code'], 0, 4) == 'FORM') {
				$pagebrowsertopHTML=$pagebrowserHTML;
				$pagebrowserHTML= '';
			}

			if ($conf['advanced.']['invertBrowser'] ==1) {
				$pagebrowsertopHTMLsave=$pagebrowsertopHTML;
				$pagebrowsertopHTML=$pagebrowserHTML;
				$pagebrowserHTML=$pagebrowsertopHTMLsave;
			}

			 $markers['###PAGE_BROWSER###'] = $pagebrowserHTML;
			 $markers['###PAGE_BROWSERTOP###'] = $pagebrowsertopHTML;
		} else {
			$markers['###PAGE_BROWSER###'] ='';
			$markers['###PAGE_BROWSERTOP###']  ='';
		}

		if ($fromAjax) {
			$this->ajaxDataloginSess =  rawurlencode($this->getAjaxLoggedInData('session', 0));
		}

		/* Call hook for custom markers */
		 if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments'] as $userFunc) {
				$params = array(
						'pObj' => $pObj,
						'template' => $pObj->templateCode,
						'markers' => $subParts,
						'plainMarkers' => $markers,
				);
				if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
					$subParts = $tempMarkers;
				}

			}

		}

		// Merge
		$retstr = $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);

		// Adjust gravatars for https or http
		if ($conf['advanced.']['gravatarEnable'] == 1) {
			if (@$_SERVER['HTTPS'] == 'on') {
				$retstr = str_replace('http://www.gravatar.', 'https://secure.gravatar.', $retstr);
			} else {
				$retstr = str_replace('https://secure.gravatar.', 'http://www.gravatar.', $retstr);
			}
		}

		return $retstr;
	}
	/**
	 * returns an string which is used a user menu over the comments list
	 *
	 * @param	string		$pObj: single uid in order to return a 1-dim array
	 * @param	string		$conf: multiple uids needed, returns array with 2 dims
	 * @param	[type]		$externalref: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$cntrowsorig: ...
	 * @return	array		$ret
	 */
	protected function getCommentsMenu($pObj, $conf, $externalref, $fromAjax, $cntrowsorig){
		$ret = '';
		if ((intval($conf['dataProtect.']['disclaimerPageID']) == 0) && ($conf['dataProtect.']['disclaimerSystemCheck'] == 0) &&
				($conf['dataProtect.']['disclaimerFromTocToc'] == 0)){
			$conf['dataProtect.']['useDisclaimer'] = 0;
		}
		$useSortMenu = $conf['advanced.']['useSortMenu'];
		$useDisclaimer = 0;
		$useuserCenterPageID =$conf['userCenter.']['userCenterPageID'];
		if ((intval($conf['ratings.']['ratingsOnly']) == 1)) {

			if ((intval($conf['dataProtect.']['useDisclaimerInRatingsOnly']) == 1)) {
				if (intval($conf['ratings.']['enableRatings']) == 1) {
					$useDisclaimer = 1;
				}
			}

			$useSortMenu = 0;
			$useuserCenterPageID = 0;
		}
		$userCentermenu = '';
		if ((intval($useuserCenterPageID) != 0) && ($_SESSION['feuserid'] > 0)) {
			//print the link to the user center
			$userCentermenu = '<div class="tx-tc-usermenumenutitle tx-tc-textlink" id="tx-tc-usermenumenutitle_'. $externalref. '__0' .  $_SESSION['commentListCount'].
			'" title="'. $this->pi_getLLWrap($pObj, 'pi1_template.userCentermenutiptext', $fromAjax).'">'.
			$_SESSION['userCenterPage'].'</div>';
		}

		if ((intval($conf['ratings.']['ratingsOnly']) == 0) && (intval($conf['dataProtect.']['useDisclaimer']) == 1)) {
			$useDisclaimer = 1;
		}

		if (($useSortMenu == 1) || ($useDisclaimer == 1) || ($userCentermenu != '')) {
			if (($conf['advanced.']['sortMostPopular'] == 0) && ($conf['advanced.']['reverseSorting']) == 1) {
				$selectedpic = 'down';
			}

			if (($conf['advanced.']['sortMostPopular'] == 0) && ($conf['advanced.']['reverseSorting']) == 0) {
				$selectedpic = 'up';
			}

			if ($conf['advanced.']['useMostPopular'] == 1) {
				if ($conf['advanced.']['sortMostPopular'] == 1) {
					$selectedpic = 'pop';
				}

			}

			$ret .= '<div class="tx-tc-sortlistmenu" id="tx-tc-sortlistmenu_'. $externalref. '__0' .  $_SESSION['commentListCount']. '">';
			if ($useDisclaimer == 1) {
				$ret .= '<div class="tx-tc-dsclmrlistmenutitle tx-tc-textlink" id="tx-tc-dsclmrlistmenutitle_'. $externalref. '__0' .  $_SESSION['commentListCount'].
						 '" title="'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimermenutiptext', $fromAjax).'">'.
				$this->pi_getLLWrap($pObj, 'pi1_template.disclaimermenutext', $fromAjax).'</div>';
				$ret .= '<div class="tx-tc-dsclmrlistpanel tx-tc-nodisp" id="tx-tc-dsclmrlistpanel_'. $externalref. '__0' .  $_SESSION['commentListCount']. '">';
				$ret .= '<div class="tx-tc-title">'.$this->pi_getLLWrap($pObj, 'pi1_template.disclaimermenutiptext', $fromAjax).'</div>';

				if (intval($conf['dataProtect.']['disclaimerPageID']) > 0) {
					$ret .= '<div class="tx-tc-subtitle">'.$this->pi_getLLWrap($pObj, 'pi1_template.disclaimerpagetitle', $fromAjax).'</div>';
					$ret .= '<div class="tx-tc-dsclmrtext">';
					$ret .= sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimerpagetext', $fromAjax), $_SESSION['policypage']);
					$ret .= '</div>';
				}

				if ($conf['dataProtect.']['disclaimerSystemCheck'] == 1) {

					$dateFormatMode = $conf['advanced.']['dateFormatMode'];
					$dateFormat = $conf['advanced.']['dateFormat'];
					$confdateFormatOldStyle = $conf['advanced.']['dateFormatOldStyle'];
					$conf['advanced.']['dateFormatOldStyle'] = 1;
					$conf['advanced.']['dateFormatMode'] = 'date';
					$conf['advanced.']['dateFormat'] = 'j.n.Y, H:i:s';
					$formatDate= $this->formatDate(time(), $pObj, $fromAjax, $conf);
					$conf['advanced.']['dateFormatOldStyle'] = $confdateFormatOldStyle;
					$conf['advanced.']['dateFormatMode'] = $dateFormatMode;
					$conf['advanced.']['dateFormat'] = $dateFormat;
					$pts = 0.00;
					$ret .= '<div class="tx-tc-subtitle">'.$this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreport', $fromAjax).' - ' . $formatDate . '</div>';
					$ret .= '<div>';

					$ret .= '<div id="tx-tc-dsclmrhttps_'. $externalref. '__0' .  $_SESSION['commentListCount']. '" class="tx-tc-dsclmrcheck ';
					if (@$_SERVER['HTTPS'] == 'on') {
						$ret .= 'tx-tc-green">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreporthttps', $fromAjax);
						$pts++;
					} else {
						$ret .= 'tx-tc-warn">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreporthttp', $fromAjax);
					}
					$ret .= '</div>';
					$ret .= '<div class="tx-tc-dsclmrcheck ';

					if (version_compare(TYPO3_version, '6.0', '<')) {
						$strlocalhost = TYPO3_db_host;
					} else {
						$cm = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager');
						$strlocalhost = $cm->getLocalConfigurationValueByPath('DB/host');
					}

					If ((trim(strtolower($strlocalhost)) == 'localhost') || ((trim(strtolower($strlocalhost)) == '127.0.0.1'))) {
						$ret .= 'tx-tc-green">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportlocalhost', $fromAjax);
						$pts++;
					} elseIf (trim(strtolower($strlocalhost)) == '') {
						$ret .= 'tx-tc-info">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportnolocalhost', $fromAjax);
						$pts = $pts+0.5;
					} else {
						$ret .= 'tx-tc-warn">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportnotlocalhost', $fromAjax). ' "' . trim($strlocalhost) . '"';
					}

					$ret .= '</div>';

					$cookie_dataProtect = $_COOKIE['toctoc_comments_pi1_dataProtect'];
					$cookie_gender = $_COOKIE['toctoc_comments_pi1_gender'];
					$cookie_gimme55 = intval($_COOKIE['toctoc_comments_pi1_gimme55']);

					if ($cookie_gimme55 != 1) {
						$cookie_firstname = $_COOKIE['toctoc_comments_pi1_firstname'];
					} else {
						$cookie_firstname = base64_decode($_COOKIE['toctoc_comments_pi1_firstname']);
					}

					if ($cookie_gimme55 != 1) {
						$cookie_lastname = $_COOKIE['toctoc_comments_pi1_lastname'];
					} else {
						$cookie_lastname = htmlspecialchars(base64_decode($_COOKIE['toctoc_comments_pi1_lastname']));
					}

					if ($cookie_gimme55 != 1) {
						$cookie_email = $_COOKIE['toctoc_comments_pi1_email'];
					} else {
						$cookie_email = htmlspecialchars(base64_decode($_COOKIE['toctoc_comments_pi1_email']));
					}

					if ($cookie_gimme55 != 1) {
						$cookie_location = $_COOKIE['toctoc_comments_pi1_location'];
					} else {
						$cookie_location = htmlspecialchars(base64_decode($_COOKIE['toctoc_comments_pi1_location']));
					}

					if ($cookie_gimme55 != 1) {
						$cookie_homepage = $_COOKIE['toctoc_comments_pi1_homepage'];
					} else {
						$cookie_homepage = htmlspecialchars(base64_decode($_COOKIE['toctoc_comments_pi1_homepage']));
					}

					$cookie_all =$cookie_homepage . $cookie_location . $cookie_email . $cookie_lastname . $cookie_firstname . $cookie_gender;
					$ret .= '<div class="tx-tc-dsclmrcheck ';
					$foundcookies = 0;
					If ($cookie_dataProtect == '') {
						$ret .= '"><span class="tx-tc-info tx-tc-fleft tx-tc-cookiemessage" id="tx-tc-cookie-msg_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportsetcookienotdefined', $fromAjax) . '</span>
								<span id="tx-tc-cookie-accept_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieaccept tx-tc-textlink" title="' .
						sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookieaccepttip', $fromAjax), $conf['dataProtect.']['cookieLifetime']) .
						'">' . 	$this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookieaccept', $fromAjax) . '</span><span id="tx-tc-cookie-notaccept_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieaccept tx-tc-textlink" title="' .
						sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookienotaccepttip', $fromAjax), $conf['dataProtect.']['cookieLifetime']) .
						'">' . $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookienotaccept', $fromAjax) . '</span>';
					} elseif ($cookie_dataProtect == 1) {
						$ret .= '"><span class="tx-tc-warn tx-tc-fleft tx-tc-cookiemessage" id="tx-tc-cookie-msg_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportsetcookieaccepted', $fromAjax) . '</span>
								<span id="tx-tc-cookie-accept_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieaccept tx-tc-textlink tx-tc-nodisp" title="' .
						sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookieaccepttip', $fromAjax), $conf['dataProtect.']['cookieLifetime']) .
						'">' . $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookieaccept', $fromAjax) . '</span><span id="tx-tc-cookie-notaccept_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieaccept tx-tc-textlink" title="' .
						sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookienotaccepttip', $fromAjax), $conf['dataProtect.']['cookieLifetime']) .
						'">' . $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookienotaccept', $fromAjax) . '</span>';

					} else {
						$ret .= '"><span class="tx-tc-green tx-tc-fleft tx-tc-cookiemessage" id="tx-tc-cookie-msg_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportsetcookienotaccepted', $fromAjax) . '</span>
								<span id="tx-tc-cookie-accept_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieaccept tx-tc-textlink" title="' .
						sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookieaccepttip', $fromAjax), $conf['dataProtect.']['cookieLifetime']) .
						'">' . $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookieaccept', $fromAjax) . '</span><span id="tx-tc-cookie-notaccept_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieaccept tx-tc-textlink tx-tc-nodisp" title="' .
						sprintf($this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookienotaccepttip', $fromAjax), $conf['dataProtect.']['cookieLifetime']) .
						'">' . $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetycookienotaccept', $fromAjax) . '</span>';
						$pts += 1;
					}

					$ret .= '<span id="tx-tc-cookie-accept_msg1_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-nodisp">' .
						$this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportsetcookieaccepted', $fromAjax) . '</span>
								<span id="tx-tc-cookie-accept_msg0_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-nodisp">' .
						$this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportsetcookienotaccepted', $fromAjax) . '</span></div>';
					$cntcookies=6;
					if ($cookie_all !='') {
						$ret .= '<div class="tx-tc-dsclmrcheck ';
						$ret .= 'tx-tc-warn tx-tc-dropup" id="tx-tc-cookie-dropup_' .
						$externalref. '__0' .  $_SESSION['commentListCount'] .
						'"><span class="tx-tc-fleft tx-tc-width88">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportfoundcookies', $fromAjax);
						$ret .= '</span><div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-dropup_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-cookieshow tx-tc-DropDownButton" title="' .
						$this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportfoundcookies', $fromAjax) . '"></span></div>';
						$ret .= '</div>';

						$ret .= '<div id="tx-tc-cookie-dropuppanel_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
						'" class="tx-tc-dropuppanel tx-tc-nodisp">';
						if ($cookie_firstname !='') {
							$ret .= '<div class="tx-tc-dsclmrcheck tx-tc-killcookie" id="tx_tc_cookie_firstname_' . $externalref. '__0' .
							$_SESSION['commentListCount']. '">';
							$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax)  . ' ' . $cookie_firstname;

							$ret .= '<div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-firstname_' . $externalref. '__0' .
							$_SESSION['commentListCount'] .
							        '" class="tx-tc-cookieclose tx-tc-CloseButton" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.delcookie', $fromAjax) .
							' ' . str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax)) . '"></span></div>';
							$ret .= '</div>';
							$pts = $pts -(1/$cntcookies);
							$foundcookies++;
						}

						if ($cookie_lastname !='') {
							$ret .= '<div class="tx-tc-dsclmrcheck tx-tc-killcookie" id="tx_tc_cookie_lastname_' . $externalref. '__0' .
							$_SESSION['commentListCount']. '">';
							$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax)  . ' ' . $cookie_lastname;

							$ret .= '<div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-lastname_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
							'" class="tx-tc-cookieclose tx-tc-CloseButton" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.delcookie', $fromAjax) . ' ' .
							str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax)) . '"></span></div>';
							$ret .= '</div>';
							$pts = $pts -(1/$cntcookies);
							$foundcookies++;
						}

						if ($cookie_gender !='') {
							if ($cookie_gender ==1) {
								$txtgender =$this->pi_getLLWrap($pObj, 'pi1_template.usefemale', $fromAjax);
							} else {
								$txtgender =$this->pi_getLLWrap($pObj, 'pi1_template.usemale', $fromAjax);
							}

							$ret .= '<div class="tx-tc-dsclmrcheck tx-tc-killcookie" id="tx_tc_cookie_gender_' . $externalref. '__0' .
							$_SESSION['commentListCount']. '">';
							$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.gender', $fromAjax)  . ' ' . $txtgender;

							$ret .= '<div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-gender_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
							'" class="tx-tc-cookieclose tx-tc-CloseButton" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.delcookie', $fromAjax) . ' ' .
							str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.gender', $fromAjax)) . '"></span></div>';
							$ret .= '</div>';
							$pts = $pts -(1/$cntcookies);
							$foundcookies++;
						}

						if ($cookie_email !='') {
							$ret .= '<div class="tx-tc-dsclmrcheck tx-tc-killcookie" id="tx_tc_cookie_email_' . $externalref. '__0' .
							$_SESSION['commentListCount']. '">';
							$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax)  . ' ' . $cookie_email;

							$ret .= '<div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-email_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
							'" class="tx-tc-cookieclose tx-tc-CloseButton" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.delcookie', $fromAjax) . ' ' .
							str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax)) . '"></span></div>';
							$ret .= '</div>';
							$pts = $pts -(1/$cntcookies);
							$foundcookies++;
						}
						if ($cookie_homepage !='') {
							$ret .= '<div class="tx-tc-dsclmrcheck tx-tc-killcookie" id="tx_tc_cookie_homepage_' . $externalref. '__0' .
							$_SESSION['commentListCount']. '">';
							$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax)  . ' ' . $cookie_homepage;

							$ret .= '<div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-homepage_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
							'" class="tx-tc-cookieclose tx-tc-CloseButton" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.delcookie', $fromAjax) . ' ' .
							str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax)) . '"></span></div>';
							$ret .= '</div>';
							$pts = $pts -(1/$cntcookies);
							$foundcookies++;
						}
						if ($cookie_location !='') {
							$ret .= '<div class="tx-tc-dsclmrcheck tx-tc-killcookie" id="tx_tc_cookie_location_' . $externalref. '__0' .
							$_SESSION['commentListCount']. '">';
							$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax)  . ' ' . $cookie_location;

							$ret .= '<div class="tx-tc-ct-box-ctclose"><span id="tx-tc-cookie-cls-location_' . $externalref. '__0' .
							$_SESSION['commentListCount'] .
							'" class="tx-tc-cookieclose tx-tc-CloseButton" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.delcookie', $fromAjax) .
							' ' . str_replace(':', '', $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax)) . '"></span></div>';
							$ret .= '</div>';
							$pts = $pts -(1/$cntcookies);
							$foundcookies++;
						}
						$ret .= '</div>';

					}
					$ret .= '<div id="tx-tc-cookie-count_' . $externalref. '__0' .  $_SESSION['commentListCount'] .
					'" class="tx-tc-nodisp">'. $foundcookies . '_' . $cntcookies .'</div>';

					$ret .= '<div class="tx-tc-dsclmrcheck ';
					If (intval($conf['dontSkipSearchEngines']) == 0) {
						$ret .= 'tx-tc-green">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportsedisabled', $fromAjax);
						$pts++;
					} else {
						$ret .= 'tx-tc-warn">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportseenabled', $fromAjax);
					}
					$ret .= '</div>';

					$ret .= '<div id="tx-tc-dsclmrcheckresult_' . $externalref. '__0' .  $_SESSION['commentListCount'] . '" class="tx-tc-dsclmrcheckresult ';
					if ($pts < 1.5) {
						$ret .= 'tx-tc-warn">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportminimal', $fromAjax);
					} elseif (($pts >= 1.5) && ($pts <= 3)) {
						$ret .= 'tx-tc-info">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportcouldbebetter', $fromAjax);
					} elseif ($pts > 3) {
						$ret .= 'tx-tc-green">'. $this->pi_getLLWrap($pObj, 'pi1_template.disclaimersafetyreportlooksgood', $fromAjax);
					}
					$ptsprcnt = $pts;
					$ptsprcnt = round(100*($pts/4), 0);
					$ret .= ' (' . $ptsprcnt . '%)';
					$ret .= '</div>
							<div class="tx-tc-nodisp" id="tx-tc-dsclmrcheckresult_count_' . $externalref. '__0' .  $_SESSION['commentListCount'] . '">' .
					$pts . '</div>
						</div>';
				}

				if ($conf['dataProtect.']['disclaimerFromTocToc'] == 1) {
					$ret .= '<div class="tx-tc-subtitle">'.$this->pi_getLLWrap($pObj, 'pi1_template.disclaimertoctoctitle', $fromAjax).'</div>';
					$ret .= '<div class="tx-tc-dsclmrtext">';
					$langlink = '+M5d637b1e38d';
					if ($_SESSION['activelang'] == 'de') {
						$langlink = '';
					}

					$toctocdplink = '<a href="https://www.toctoc.ch/toctoc_comments_dataprotection'.$langlink.'.html">www.toctoc.ch</a>';
					$ret .= $this->pi_getLLWrap($pObj, 'pi1_template.disclaimertoctoctext', $fromAjax) . ' ' . $toctocdplink;
					$ret .= '</div>';
				}

				$ret .= '</div>';
			}

			$piLLreviewident = '';
			if ($conf['advanced.']['commentReview'] ==1) {
				$piLLreviewident = 'review';
			}

			if (($conf['advanced.']['useSortMenu'] == 1) && ($cntrowsorig > 1)) {
				$ret .= '<div class="tx-tc-sortlistmenutitle tx-tc-textlink" id="tx-tc-sortlistmenutitle_'. $externalref. '__0' .  $_SESSION['commentListCount'].
						 '">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortmenu', $fromAjax) .
					'<span id="tx-tc-sortind_'. $externalref. '__0' .  $_SESSION['commentListCount']. '" class="tx-tc-sortind tx-tc-sortind-' .$selectedpic .
				'" ></span></div>';
				$ret .= '<div class="tx-tc-sortlistpanel tx-tc-nodisp" id="tx-tc-sortlistpanel_'. $externalref. '__0' .  $_SESSION['commentListCount']. '">';
				if (($conf['advanced.']['sortMostPopular'] == 0) && ($conf['advanced.']['reverseSorting']) == 1) {
					$selected = 'selected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink-selected" id="sel_tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__01">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortdown', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" >&#8730;</span></span>';
					$ret .= '	</div>';
					$selected = 'notselected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink tx-tc-textlink tx-tc-nodisp" id="tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__01">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortdown', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" ></span></span>';
					$ret .= '	</div>';
				} else {
					$selected = 'notselected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink tx-tc-textlink" id="tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__01">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortdown', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" ></span></span>';
					$ret .= '	</div>';
					$selected = 'selected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink-selected tx-tc-nodisp" id="sel_tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__01">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortdown', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" >&#8730;</span></span>';
					$ret .= '	</div>';
				}

				if (($conf['advanced.']['sortMostPopular'] == 0) && ($conf['advanced.']['reverseSorting']) == 0) {
					$selected = 'selected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink-selected" id="sel_tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__00">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortup', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" >&#8730;</span></span>';
					$ret .= '	</div>';
					$selected = 'notselected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink tx-tc-textlink tx-tc-nodisp" id="tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__00">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortup', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" ></span></span>';
					$ret .= '	</div>';
				} else {
					$selected = 'notselected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink tx-tc-textlink" id="tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__00">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortup', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" ></span></span>';
					$ret .= '	</div>';
					$selected = 'selected';
					$ret .= '	<div class="tx-tc-sortlistlinkbox">';
					$ret .= '		<span class="tx-tc-sortlistlink-selected tx-tc-nodisp" id="sel_tx-tc-sortlistlink_'. $externalref. '__0' .
							$_SESSION['commentListCount']. '__00">' . $this->pi_getLLWrap($pObj, 'pi1_template.' . $piLLreviewident . 'titlesortup', $fromAjax) .
							'<span class="tx-tc-sortlistlink-ind-' .$selected .'" >&#8730;</span></span>';
					$ret .= '	</div>';
				}

				if ($conf['advanced.']['useMostPopular'] == 1) {
					if ($conf['advanced.']['sortMostPopular'] == 1) {
						$selected = 'selected';
						$ret .= '	<div class="tx-tc-sortlistlinkbox">';
						$ret .= '		<span class="tx-tc-sortlistlink-selected tx-tc-sortpopular" id="sel_tx-tc-sortlistlink_'. $externalref. '__0' .
								$_SESSION['commentListCount']. '__02">' . $this->pi_getLLWrap($pObj, 'pi1_template.titlesortpopularity', $fromAjax) .
								'<span class="tx-tc-sortlistlink-ind-' .$selected .'" >&#8730;</span></span>';
						$ret .= '	</div>';

						$selected = 'notselected';
						$ret .= '	<div class="tx-tc-sortlistlinkbox">';
						$ret .= '		<span class="tx-tc-sortlistlink tx-tc-sortpopular tx-tc-textlink tx-tc-nodisp" id="tx-tc-sortlistlink_'. $externalref. '__0' .
								$_SESSION['commentListCount']. '__02">' . $this->pi_getLLWrap($pObj, 'pi1_template.titlesortpopularity', $fromAjax) .
								'<span class="tx-tc-sortlistlink-ind-' .$selected .'" ></span></span>';
						$ret .= '	</div>';

					} else {
						$selected = 'notselected';
						$ret .= '	<div class="tx-tc-sortlistlinkbox">';
						$ret .= '		<span class="tx-tc-sortlistlink tx-tc-sortpopular tx-tc-textlink" id="tx-tc-sortlistlink_'. $externalref. '__0' .
								$_SESSION['commentListCount']. '__02">' . $this->pi_getLLWrap($pObj, 'pi1_template.titlesortpopularity', $fromAjax) .
								'<span class="tx-tc-sortlistlink-ind-' .$selected .'" ></span></span>';
						$ret .= '	</div>';

						$selected = 'selected';
						$ret .= '	<div class="tx-tc-sortlistlinkbox">';
						$ret .= '		<span class="tx-tc-sortlistlink-selected tx-tc-sortpopular tx-tc-nodisp" id="sel_tx-tc-sortlistlink_'. $externalref. '__0' .
								$_SESSION['commentListCount']. '__02">' . $this->pi_getLLWrap($pObj, 'pi1_template.titlesortpopularity', $fromAjax) .
								'<span class="tx-tc-sortlistlink-ind-' .$selected .'" >&#8730;</span></span>';
						$ret .= '	</div>';
					}

				}

				$ret .= '</div>';
			}

			if ($userCentermenu != '') {
				$ret .= $userCentermenu;
			}

			$ret .= '</div>';
		}

		return $ret;
	}
	/**
	 * returns an array of comments, correponding to SQL request from cached all comments query array
	 *
	 * @param	string		$uid: single uid in order to return a 1-dim array
	 * @param	string		$uidlist: multiple uids needed, returns array with 2 dims
	 * @param	[type]		$selectparentuid: ...
	 * @return	array		$retarr
	 */
	protected function getBaseCommentsArray($uid, $uidlist = '', $selectparentuid = FALSE) {
		//$this->trackdebug('getBaseCommentsArray');

		$cnt = count($this->allrowsarr);
		$retarr = array();
		if ($uidlist != '') {
			$j=0;
			$uidlistarr = array();
			$uidlistarr = explode(',', $uidlist);
			$cntuidlistarr = count($uidlistarr);
		}
		for ($i = 0; $i < $cnt; $i++) {
			if ($uid != '') {
				if ($this->allrowsarr[$i]['uid'] == $uid) {
					$retarr = $this->allrowsarr[$i];
					break;
				}

			} else {
				for ($s = 0; $s < $cntuidlistarr; $s++) {
					if ($selectparentuid == FALSE) {
						if ($this->allrowsarr[$i]['uid'] == $uidlistarr[$s]) {
							$retarr[$j] = $this->allrowsarr[$i];
							$j++;
							break;
						}
					} else {
						if ($this->allrowsarr[$i]['parentuid'] == $uidlistarr[$s]) {
							$retarr[$j] = $this->allrowsarr[$i];
							$j++;
							break;
						}
					}

				}
				if (($j) == $cntuidlistarr) {
					if ($selectparentuid == FALSE) {
						break;
					}
				}

			}

		}
		//$this->trackdebug('getBaseCommentsArray');

		return $retarr;
	}
	/**
	 * returns an array of comments, correponding to SQL request from cached all comments query array
	 *
	 * @param	string		$uid: single uid in order to return a 1-dim array
	 * @param	string		$uidlist: multiple uids needed, returns array with 2 dims
	 * @param	[type]		$uid: ...
	 * @param	[type]		$uidlist: ...
	 * @param	[type]		$conf: ...
	 * @return	array		$retarr
	 */
	protected function getBaseFeUsersArray($pObj, $fromAjax, $uid, $uidlist = '', $conf) {
		$this->trackdebug('getBaseFeUsersArray');
		if ($this->FeUsersSet == FALSE) {
			$imagestr = '';
			if (trim($conf['advanced.']['FeUserDbField']) != '') {
				if (trim($conf['advanced.']['FeUserDbField']) != 'image') {
					$imagestr = ', ' . $conf['advanced.']['FeUserDbField'];
				}

			}

			$txtc_Fe_usersFields = 'uid, pid, username, email, image, gender, first_name, name, last_name, www, city, country' . $imagestr;
			$AdditionalFe_usersField = '';
			if (trim($conf['advanced.']['useAdditionalFe_usersFields']) != '') {
				$AdditionalFe_usersFieldsarr = explode(', ', $txtc_Fe_usersFields . ',' . trim($conf['advanced.']['useAdditionalFe_usersFields']));
				$AdditionalFe_usersFieldsarrunique = array_unique($AdditionalFe_usersFieldsarr);
				$txtc_Fe_usersFields = implode(',', $AdditionalFe_usersFieldsarrunique);
			}

			$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($txtc_Fe_usersFields, 'fe_users', 'uid>0 ' . $this->enableFields('fe_users', $pObj, $fromAjax), '', 'uid');

			$cntfeusers = count($rowsfeuser);
			for ($i = 0; $i < $cntfeusers; $i++) {
				$this->FeUsers[$rowsfeuser[$i]['uid']] = $rowsfeuser[$i];
			}

			$this->FeUsersSet = TRUE;
		}

		$cnt = count($this->FeUsers);
		$retarr = array();
		if ($uidlist != '') {
			$uidlistarr = array();
			$uidlistarr = explode(',', $uidlist);
			$cntuidlistarr = count($uidlistarr);
		}

		if ($uid != '') {
			$retarr = $this->FeUsers[$uid];
		} else {
			for ($s = 0; $s < $cntuidlistarr; $s++) {
				$retarr[$s] = $this->FeUsers[$uidlistarr[$s]];
			}
		}

		$this->trackdebug('getBaseFeUsersArray');
		return $retarr;
	}

	/**
	 * Generates emojis
	 *
	 * @param	string		$text: text with emojis to convert
	 * @param	array		$conf: config array
	 * @param	string		$debug: identifier for debug function
	 * @return	string		text with converted emojis
	 */
	protected function makeemoji($text, $conf, $debug) {
		$this->trackdebug('0 makeemoji_' . $debug);
		$explodekey="\r\n";
		$textstreams =explode($explodekey, $text);
		if (count($textstreams)<2) {
			$explodekey="\n";
			$textstreams =explode($explodekey, $text);
		}

		if (count($textstreams)>1) {
			$text=implode('-@#@-', $textstreams);
		}

		$textsave=$text;
		$textua =explode('\\u', $text);
		$spanreplcarr =array();
		$v=0;
		if (count($textua)>1) {
			$cvrt1='';
			$cvrt2='';
			$counttextua=count($textua);
			for($u=0; $u<$counttextua; $u++) {
				$donecozonlyonecode = FALSE;
				if (substr($textua[$u], 0, 4) == '20E3') {
					$cvrt2= '-u' .substr($textua[$u], 0, 4);
					$cvrt1= 'u' .substr(strrev($textua[$u-1]), 0, 1);
				} else {
					if (strlen($textua[$u]) == 4) {
						if (ctype_xdigit($textua[$u])) {
							if (substr($textua[$u], 0, 4) == 'D83C') {
								if ($u<count($textua)-3) {
									if ((substr($textua[$u+1], 0, 3) == 'DDE') || (substr($textua[$u+1], 0, 3) == 'DDF'))  {
										$cvrt1= 'u' . $textua[$u] . '-u' . $textua[$u+1];
										$cvrt2= '-u' . $textua[$u+2] . '-u' . substr($textua[$u+3], 0, 4);
										$u=$u+3;
									}

								}

							}

							if ($cvrt1 == '') {
								if ((substr($textua[$u], 0, 1) == '0') || (substr($textua[$u], 0, 1) == '2')) {
											$cvrt1= 'u' .$textua[$u];
											$cvrt2= '';
											$donecozonlyonecode=TRUE;
								} else {
									$cvrt1= 'u' . $textua[$u];
								}

							} elseif ($cvrt2 == '') {
								$cvrt2= '-u' . $textua[$u];
							}

						}

					} else {
						$ustr=substr($textua[$u], 0, 4);
						if (ctype_xdigit($ustr)) {
							if ((substr($textua[$u], 0, 1) == '0') || (substr($textua[$u], 0, 1) == '2')) {
								$cvrt1= 'u' .$ustr;
								$cvrt2= '';
								$donecozonlyonecode=TRUE;
							} else {
								$cvrt2= '-u' .$ustr;
							}

						}

					}

				}

				if ((($cvrt1 !='') && ($cvrt2 !='')) || ($donecozonlyonecode==TRUE)) {
					$spanreplcarr[$v]=$cvrt1 .$cvrt2;
					$cvrt1='';
					$cvrt2='';
					$v++;
				}

			}

		}

		$text =str_replace('"', '\"', $text);
		$text ='"' . $text .'"';
		$text = json_decode($text);
		$text =str_replace('&quot;', '"', $text);
		if ($text=='') {
			$text=$textsave;
		}

		if ($conf['advanced.']['useEmoji']>=1) {
			if (!(isset($this->libemoji))) {
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_emoji.php'));
				if (!isset($_SESSION['libemoji']) ){
					$this->libemoji = new toctoc_comments_emoji;
					$_SESSION['libemoji']=serialize($this->libemoji);
				} else {
					$this->libemoji=unserialize($_SESSION['libemoji']);
				}

			}

			$text= $this->libemoji->emoji_unified_to_html($text, t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_emoji_language.php'),
					$_SESSION['activelang']);
			$textspanarr =explode('class="emoji emoji', $text);
			if (count($textspanarr)>1) {
				$v=0;
				$counttextspanarr=count($textspanarr);
				for($u=0; $u<$counttextspanarr; $u++) {
					$textspanarr2=explode('"></span>', $textspanarr[$u]);
					if (count($textspanarr2)>1) {
						$textspanarr2[0] .= ' ' . $spanreplcarr[$v];
						$v++;
						$textspanarr[$u]=implode('"></span>', $textspanarr2);
					}

					$counttextspanarr=count($textspanarr);
				}

				$text=implode('class="emoji emoji', $textspanarr);
			}

		}

		if (count($textstreams)>1) {
			$textarrout=explode('-@#@-', $text);
			$text=implode($explodekey, $textarrout);
		}

		$this->trackdebug('0 makeemoji_' . $debug);
		return $text;
	}


	/**
	 * Main comments display function
	 *
	 * @param	[type]		$rows: Data from the db
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	int		$feuserid: id of current user...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$pid: ...
	 * @param	[type]		$levelhlt: ...
	 * @return	[type]		...
	 */
	public function comments_getComments(&$rows, $conf, $pObj, $feuserid, $fromAjax, $pid, $levelhlt=0) {
		$this->trackdebug('comments_getComments');
		$piLLreviewident = '';
		if ($conf['advanced.']['commentReview'] ==1) {
			$piLLreviewident = 'review';
		}

		$piVars= array(); // for form call
		if (count($rows) == 0) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###NO_COMMENTS###');
			if ($template) {
				$row = array();
				$row['toctoc_commentsfeuser_feuser']=intval($GLOBALS['TSFE']->fe_user->user['uid']);
				$markerArray = array();
				$params = array(
						'template' => $template,
						'markers' => $markerArray,
						'row' => $row,
				);
				$tempMarkers = $this->comments_getComments_fe_user($params, $conf, $pObj, 0, $fromAjax, '');

				$ret=$this->t3substituteMarker($template, '###TEXT_NO_COMMENTS###', $this->pi_getLLWrap($pObj, $piLLreviewident . 'text_no_comments', $fromAjax));

				return $ret;
			}

		}

		$entries = array();
		$alt = 1;
		$templatemain = $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_COMMENT###');
		$templatesub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SINGLE_SUBCOMMENT###');
		$template = $templatemain;

		$currpageid= $GLOBALS['TSFE']->id;
		$currcontentelementid = $_SESSION['commentListCount'];

		foreach ($rows as $row) {

			$iuid= $row['uid'];
			$check = md5($row['uid'] . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);

			$strdivactionbuttons = '<div class="tx-tc-ct-actionforms">';
			$strdivactionbuttonsend ='</div>';
				$externalbegin=substr($this->externalref, 0, 5);
				if (($this->externalref != '') && ($externalbegin != 'pages')) {
					if ($this->ajaxextref != '') {
						//ajaxextref: needed to build correct js calls for toctoc_comments_submit
						// it's token from pi and filled if its not a tt_content record
						$externalref = $this->ajaxextref;
					} else {
						$externalref = $this->externalref;
					}

				} else {
					if ($this->ajaxextref != '') {
						$externalref = $this->ajaxextref;
					} else {
						$externalref = 'tt_content_' . $_SESSION['commentListCount'];
					}

				}

			$commentisowned = $this->check_comment_ownership($row['external_ref'], intval($feuserid));

			$haseditlink=FALSE;
			$stylebox='';
			$deletelinkout='';
			if (($commentisowned==TRUE) ||
					(($row['toctoc_commentsfeuser_feuser'] == intval($feuserid)) && (intval($feuserid) !==0))) {

				$tmpcid=$_SESSION['commentListCount'];
				$submithtml='';
				$ref='tx-tc-cts_' . $iuid;

				$submitSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###DELETE_COMMENT_LINK_SUB###');
				$submithtmlSub =  $this->t3substituteMarkerArray($submitSub, array(
						'###VALUE###' => '1',
						'###REF###' => $ref,
						'###PID###' => $pid,
						'###CID###' => $tmpcid,
						'###UID###' => $iuid,
						'###CHECK###' => $check,
						'###PCID###' => $row['parentuid'],
						'###REFSHOW###' => $externalref,
						'###EXTREF###'=> $externalref,
				));
				$submithtml=$submithtmlSub;
				if ($row['children'] == '') {
					if (intval($conf['advanced.']['allowCommentDeletion']) == 1) {
						$deletelinkout='<div class="tx-tc-ct-deleteform" id="df' . $iuid . '">';
						$deletelinkout .= '	<span class="tx-tc-ct-deletebutton" ';
						$deletelinkout .= ' id="toctoc_comments_pi1_submit_uid' . trim($submithtml) . '" title="' .
						$this->pi_getLLWrap($pObj, 'pi1_template.deletelink', $fromAjax) . '">';
						$deletelinkout .= '</span></div>';
						$stylebox='1';
						}

				}

				$submithtml='';
				$submitSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###EDIT_COMMENT_LINK_SUB###');

				$submithtmlSub =  $this->t3substituteMarkerArray($submitSub, array(
						'###UID###' => $iuid,
						'###PID###' => $pid,
						'###ONOFF###' => 1,
						'###CID###' => $_SESSION['commentListCount'],
				));
				$submithtml=$submithtmlSub;

				$editlinkout='';
				$userarr=explode(',', $this->userrows);
				$userarr=array_flip($userarr);
				if (array_key_exists($row['uid'], $userarr)) {
					$editlinkout='<div class="tx-tc-ct-editform" id="edf' . $iuid . '"';
					$editlinkout.= '>';
					$editlinkout .= '<span class="tx-tc-ct-editbutton"';
					$editlinkout .= ' id="toctoc_comments_pi1_submitedit_uid' . trim($submithtml) . '" title="' .
					$this->pi_getLLWrap($pObj, 'pi1_template.editlink', $fromAjax) . '">';
					$editlinkout .= '</span></div>';
					$haseditlink=TRUE;
					$stylebox.='1';
				}

			} else {
				$editlinkout='';
			}

			// disable notify
			$strCurrentIP = $this->getCurrentIp();
			$denotifylinkout='';
			if ((($row['toctoc_commentsfeuser_feuser'] == intval($feuserid)) && (intval($feuserid) !==0)) ||
					(($row['remote_addr'] ==  $strCurrentIP) && ($row['toctoc_commentsfeuser_feuser'] == intval($feuserid)))) {

				if ($row['tx_commentsnotify_notify']==1) {
					if (($conf['advanced.']['commentatorNotifybyIP'] == 1) || ((intval($feuserid)!==0) && ($conf['advanced.']['commentatorNotifybyIP'] == 0))) {

						$tmpcid=$_SESSION['commentListCount'];
						$submithtml='';
						$ref='tx_toctoc_comments_comments_' . $iuid;
						$submitSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###DENOTIFY_COMMENT_LINK_SUB###');
						$submithtmlSub =  $this->t3substituteMarkerArray($submitSub, array(
								'###VALUE###' => '1',
								'###REF###' => $ref,
								'###PID###' => $pid,
								'###CID###' => $tmpcid,
								'###UID###' => $iuid,
								'###CHECK###' => $check,
								'###PCID###' => 0,
								'###REFSHOW###' => 0,
								'###EXTREF###'=> 0,
						));
						$submithtml=$submithtmlSub;

						$denotifylinkout.='<div class="tx-tc-ct-denotifyform" id="dnf' . $iuid . '">';
						$denotifylinkout .= '<span class="tx-tc-ct-denotifybutton" ';
						$denotifylinkout .= 'id="toctoc_comments_pi1_submit_uid' . trim($submithtml) . '" title="' .
						$this->pi_getLLWrap($pObj, 'pi1_template.denotifylink', $fromAjax) . '" />';
						$denotifylinkout .= '</span></div>';
						$stylebox.='1';
					}

				}

			}

			$stylebox='';

			$actionst= $deletelinkout . $editlinkout;
			if ($denotifylinkout =='') {
				if ($actionst !='') {
					$deletelinkout = $strdivactionbuttons . $deletelinkout;
					$editlinkout=$editlinkout.$strdivactionbuttonsend;
				}

			} else {
				if ($actionst =='') {
					$denotifylinkout = $strdivactionbuttons . $denotifylinkout . $strdivactionbuttonsend;
				} else  {
					$denotifylinkout = $strdivactionbuttons . $denotifylinkout;
					$editlinkout=$editlinkout.$strdivactionbuttonsend;
				}

			}
			$commentCropLength = $conf['commentCropLength'];
			if (($row['level'] == 0) && (intval($conf['advanced.']['commentReview']) ==1)) {
				$commentCropLength = $conf['reviewCropLength'];
			}
			$row['content']=htmlspecialchars($row['content']);
			if (strlen($row['content']) > $conf['commentCropLength']) {
				$bbterminatorarr=array();

				$textcroppedleft = substr($row['content'], 0, $commentCropLength);
				$textcroppedright = substr($row['content'], $commentCropLength);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {
					$showrestofcomment=$this->pi_getLLWrap($pObj, 'pi1_template.clicktoshowtherest', $fromAjax);
					$showrestofcommenttext=$this->pi_getLLWrap($pObj, 'pi1_template.showmore', $fromAjax);

					$testbblen=strlen($textcroppedleft .$textcroppedrightarr[0]);

					$bbterminatorarr= $this->checkbbcrop($row['content'], $testbblen, $conf, $pObj);

					$textcroppedleft .=$textcroppedrightarr[0] . $bbterminatorarr[0] .
										' <span class="tx-tc-inlinedisp" id="tx-tc-acropped-' . $row['uid'] .
										'"><br /><span class="tx-tc-tcsroc tx-tc-textlink" id="tx-tc-tcsroc-' .
										$row['uid'] . '" title="' . $showrestofcomment . '">' . $showrestofcommenttext . '</span></span><span id="tx-tc-cropped-' .
										$row['uid'] . '" class="tx-tc-nodisp">' . $bbterminatorarr[1] . substr($textcroppedright, strlen($textcroppedrightarr[0])) .
					'</span>';
					$row['content'] = $textcroppedleft;
				}

			}

			$commentcontinuation='';

			if (intval($conf['ratings.']['enableRatings']) == 1) {
				$commentcontinuation='&nbsp;' . $this->middotchar . '&nbsp;';
			}

			if ($commentcontinuation!='') {
				$stylecomment=' tx-tc-fleft';
			}

			$attachmentHTML='';

			if ((intval($conf['attachments.']['useWebpagePreview']) ==1) || (intval($conf['attachments.']['usePicUpload']) ==1 ) ||
					(intval($conf['attachments.']['usePdfUpload']) ==1 )) {
				if ($row['attachment_id']> 0) {
					$attachmentHTML= $this->commentShowWebpagepreview ($row['attachment_id'], $row['attachment_subid'], $conf, $pObj, $iuid, FALSE, $fromAjax, $row);
				}

			}

			$expandcommentsHTML='';
			$subcommentreply='';

			$replyreportLineHTML1='';
			$replyreportLineHTML2='';

			// show comment under hierarchy level if triggered by link
			$noresetstatic_levelexpandoverride =0;
			if (($row['levelexpandoverride'] ==1) && ($row['level']==0)) {
				$static_levelexpandoverride =1;
				$noresetstatic_levelexpandoverride =1;

			}

			if ($static_levelexpandoverride ==1) {
				if ($row['level']>0) {
					$row['levelexpandoverride'] =1;
				} else {
					if ($noresetstatic_levelexpandoverride==0) {
						$static_levelexpandoverride =0;
					}

				}

			}

			$commentAjaxDatavar= $_SESSION['commentListCount'] . '6g9' . $row['uid'] . '6g9';
			$this->trackdebug('comments_report_and_reply');
			$txthaschildern='';
			$txtwatermarkform=$this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax);
			if (($conf['advanced.']['userCommentResponseLevels'] != 0) && ($this->isCommentingClosed($conf, $pObj) == 0) &&
					($row['level']<$conf['advanced.']['userCommentResponseLevels'])) {
				$txtwatermarkform=$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax) . '...';
				if (trim($conf['code'])!='COMMENTS') {
					$subcomment=$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax);
					$subcommentlink='';
					$subcommentlink.='<span class="tx-tc-ct-div-ry-data tx-tc-textlink" id="tx-tc-ct-div-ry-' . $row['uid'] . '__0' .
										$_SESSION['commentListCount'] . '__0' . $externalref . '" title="' .
										$subcomment . '">' . $subcomment .'</span>';
				}

				if (trim($conf['code'])!='COMMENTS') {
					$replyreportLineHTML1='<div class="tx-tc-ct-ry-report-line" id="tx-tc-ct-ry-rl-' . $row['uid'] . '">';
					$replyreportLineHTML2='</div>';

					if ($conf['commentsreport.']['active']){
						if (intval($conf['ratings.']['useLikeDislikeStyle']) == 0){
								$subcomment= '|  ' . $subcommentlink;
							} else {
								$subcomment= '&nbsp;' . $subcommentlink;
							}

					} else {
						$subcomment= $subcommentlink;
					}

				} else {
					$subcomment= '';
				}

				//if (($txthaschildern != '') || ($conf['advanced.']['replyModeInline']==1)) {
				if (($conf['advanced.']['replyModeInline']==1)) {
					$cssdisplayreplybox= ' tx-tc-blockdisp';
					if (trim($conf['code'])!='COMMENTS') {
						$subcomment=$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax);
						$subcommentlink='';
						$subcommentlink.='<span class="tx-tc-ct-div-ry-data tx-tc-textlink" id="tx-tc-ct-div-ry-' . $row['uid'] . '__0' .
											$_SESSION['commentListCount'] . '__0' . $externalref . '__0triggerform__0' .
											$_SESSION['commentListCount'] . '6g9' . $row['uid'] . '6g9" title="' .
											$subcomment . '">' . $subcomment .'</span>';
					}

					$subcomment= '';
					if (trim($conf['code'])!='COMMENTS') {
						$replyreportLineHTML1='<div class="tx-tc-ct-ry-report-line" id="tx-tc-ct-ry-rl-' . $row['uid'] . '">';
						$replyreportLineHTML2='</div>';

						if ($conf['commentsreport.']['active']){
							if (intval($conf['ratings.']['useLikeDislikeStyle']) == 0){
									$subcomment = '' . $subcommentlink;
								} else {
									$subcomment = '&nbsp;' . $subcommentlink;
								}

						}  else {
							$subcomment = $subcommentlink;
						}

					}

					if ($conf['advanced.']['replyModeInlineOpenForm']==0) {
						$subcommentreply.= '<div class="tx-tc-ct-ry tx-tc-blockdisp" id="tx-tc-ct-ry-fh-' . $row['uid'] .'">';
						$subcommentreply.= $subcomment.'</div>';
						$cssdisplayreplybox= ' tx-tc-nodisp';
					}

					if ($conf['commentsreport.']['active']==0) {
						$spacingleft=' tx-tc-margin0';
					} else {
						if  ((intval($conf['advanced.']['loginRequired']) == 1) && (intval($conf['useUserImage']) == 1)) {
							$spacingleft = ' tx-tc-margin0';
						}

					}

					$subcommentreply.= '<div class="tx-tc-ct-rply'. $spacingleft . $cssdisplayreplybox . '" id="tx-tc-cts-rply-' . $row['uid'] . '">';

					if ($fromAjax) {
						$subcommentreplyformhtml = $this->form($conf, $pObj, $piVars, TRUE, $pid, $feuserid, $_SESSION['userAJAXimage'],
								$iuid, ($row['level']+1), TRUE);
						$subcommentreplyformhtmlarr = explode('tx-tc-uimg-', $subcommentreplyformhtml);
						if (count($subcommentreplyformhtmlarr)>1) {
							$remainingthmlarr=explode('"', $subcommentreplyformhtmlarr[1]);
							if (count($remainingthmlarr)>1) {
								$remainingthmlarr[0]= '' . $_SESSION['commentListCount'] . '6g9' . $row['uid'] . '6g9';
							}

							$subcommentreplyformhtmlarr[1]=implode('"', $remainingthmlarr);
						}

						$subcommentreplyformhtml = implode('tx-tc-uimg-', $subcommentreplyformhtmlarr);
						//tx-tc-cts-img-c
						$subcommentreplyformhtmlarr = explode('tx-tc-cts-img-c', $subcommentreplyformhtml);
						if (count($subcommentreplyformhtmlarr)>1) {
							$remainingthmlarr=explode('"', $subcommentreplyformhtmlarr[1]);
							if (count($remainingthmlarr)>1) {
								$remainingthmlarr[0]= '' . $_SESSION['commentListCount'] . '6g9' . $row['uid'] . '6g9';
							}

							$subcommentreplyformhtmlarr[1]=implode('"', $remainingthmlarr);
						}

						$subcommentreplyformhtml = implode('tx-tc-uimg-', $subcommentreplyformhtmlarr);
						$subcommentreplyformhtmlarr = explode('tx-tc-cts-img-', $subcommentreplyformhtml);
						if (count($subcommentreplyformhtmlarr)>1) {
							$remainingthmlarr=explode('"', $subcommentreplyformhtmlarr[1]);
							if (count($remainingthmlarr)>1) {
								$remainingthmlarr[0]= '' . $_SESSION['commentListCount'] . '6g9' . $row['uid'] . '6g9';
							}

							$subcommentreplyformhtmlarr[1]=implode('"', $remainingthmlarr);
						}

						$subcommentreplyformhtml = implode('tx-tc-uimg-', $subcommentreplyformhtmlarr);
						$repl='/>tx-tc-uimg-(\d)</';
						$replw='><';
						$subcommentreplyformhtml=preg_replace($repl, $replw, $subcommentreplyformhtml);
						$subcommentreply.= $subcommentreplyformhtml;
					} else {

						$subcommentreply.= $this->form($conf, $pObj, $piVars, FALSE, $GLOBALS['TSFE']->id, intval($GLOBALS['TSFE']->fe_user->user['uid']),
								$userpic, $iuid, ($row['level']+1), TRUE);

					}

					$subcommentreply= str_replace('class="tx-tc-ct-box-cttxt', 'class="tx-tc-ct-box-cttxt-reply', $subcommentreply);
					$subcommentreply= str_replace('"' . $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax), '"' .
							$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax), $subcommentreply);
					$subcommentreply= str_replace('\'' . $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax), '\'' .
							$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax), $subcommentreply);
					$subcommentreply= str_replace('tx-tc-cAD-' . $_SESSION['commentListCount'] . '6g9' .
							$row['uid'] . '6g9', 'tx-tc-cAD-' . $_SESSION['commentListCount'], $subcommentreply);
					$subcommentreply= str_replace('tx-tc-cADAtt-' . $_SESSION['commentListCount'] . '6g9' .
							$row['uid'] . '6g9', 'tx-tc-cADAtt-' . $_SESSION['commentListCount'], $subcommentreply);
					$subcommentreply.= '</div>';

					$commentAjaxDatavar= $_SESSION['commentListCount'];

				} else {
					$subcommentreply.= '<div class="tx-tc-ct-ry">';
					$subcommentreply.= $subcomment.'</div>';
				}

				if (($conf['code']=='COMMENTS') && ($conf['commentsreport.']['active']==0)) {
					$subcommentreply= '';
				}

				if ($row['children'] != '') {

					if ($conf['advanced.']['displayChildComments']==1) {
						$nbrchildren=count(explode(',', $row['children']));
						$nbrallchildren=count(explode(',', $row['allchildren']))-1;
						if ($nbrchildren==1) {
							$txthaschildern = '<div id="tx-tc-cts-explink-' . $row['uid'] .
							                   '" class="tx-tc-nbrsubcomments"><span class="tx-tc-lnkexp-2 tx-tc-textlink" id="tctrvw__0__' .
							                   trim($row['uid']) . '__' . str_replace(',', 'rr', str_replace(' ', '@', trim($row['children']))) .
							                   '__' . str_replace(',', 'rr', str_replace(' ', '@', trim($row['allchildren']))) . '__nbcl">' .
							                   $nbrchildren . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.answer', $fromAjax);
						} else {
						 	$txthaschildern = '<div id="tx-tc-cts-explink-' . $row['uid'] .
						 						'" class="tx-tc-nbrsubcomments"><span class="tx-tc-lnkexp-2 tx-tc-textlink" id="tctrvw__0__' .
						 						trim($row['uid']) . '__' . str_replace(',', 'rr', str_replace(' ', '@', trim($row['children']))) .
						 						'__' . str_replace(',', 'rr', str_replace(' ', '@', trim($row['allchildren']))) . '__nbcl">' .
						 						$nbrchildren . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.answers', $fromAjax);
						}

						if ($nbrchildren!=$nbrallchildren) {
							if ($nbrallchildren==0) {
								$txthaschildern .= '';
							} elseif ($nbrallchildren==1) {
								$txthaschildern .= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.total', $fromAjax) . ' ' . $nbrallchildren . ' ' .
								$this->pi_getLLWrap($pObj, 'pi1_template.subcomment', $fromAjax);
							} else {
								$txthaschildern .= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.total', $fromAjax) . ' ' . $nbrallchildren . ' ' .
								$this->pi_getLLWrap($pObj, 'pi1_template.subcomments', $fromAjax);
							}

						}

						$txthaschildern .= '</span></div>';
					}

					for ($i=0; $i<2; $i++) {
							if ($i==0) {
								$userconfimgFile='tcexpand';
								$opa=trim($this->expandiconCSSmargin);
								if (!$this->getCommentBoxChildrenDisplayIsCollapsed($row['children'], $conf, $row['level'], $fromAjax, $levelhlt,
										$row['levelexpandoverride'])) {
									$opa.=' tx-tc-nodisp';
									$txthaschildern=str_replace('tctrvw__0', 'tctrvw__1', $txthaschildern);
									$txthaschildern=str_replace('"tx-tc-lnkexp-2', '"tx-tc-lnkexp', $txthaschildern);
								} else {
									$opa.=' tx-tc-blockdisp';
								}

								$alttext= $this->pi_getLLWrap($pObj, 'pi1_template.expand', $fromAjax);
								$onclick= ' id="tctrvw__0__' . trim($row['uid']) . '__' . str_replace(',', 'rr', str_replace(' ', '@', trim($row['children']))) . '__' .
											str_replace(',', 'rr', str_replace(' ', '@', trim($row['allchildren']))) . '"';

							} else {
								$userconfimgFile='tccollapse';
								$opa=trim($this->expandiconCSSmargin);
								if ($this->getCommentBoxChildrenDisplayIsCollapsed($row['children'], $conf, $row['level'], $fromAjax, $levelhlt,
										$row['levelexpandoverride'])) {
									$opa.=' tx-tc-nodisp';
								} else {
									$opa.=' tx-tc-blockdisp';
									$txthaschildern=str_replace('tctrvw__0', 'tctrvw__1', $txthaschildern);
									$txthaschildern=str_replace('"tx-tc-lnkexp-2', '"tx-tc-lnkexp', $txthaschildern);
								}

								$alttext= $this->pi_getLLWrap($pObj, 'pi1_template.collapse', $fromAjax);
								$onclick= ' id="tctrvw__1__' . trim($row['uid']) . '__' . str_replace(',', 'rr', str_replace(' ', '@', trim($row['children']))) . '__' .
								str_replace(',', 'rr', str_replace(' ', '@', trim($row['allchildren']))) . '"';
							}

							$tmpimgstr='';
							$userimgFile = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') .  'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/'. $userconfimgFile . '.png';
							$expandcommentsHTML .= '<span '. $onclick . '><img src="' . $userimgFile . '" ' . 'class="' . $opa .
													'" title="' . $alttext . '" ' .
													' id="tx-tc-cts-img-exp-' . $i . '-' . $row['uid'] . '"></span>';

					}

				}

			}

			$this->trackdebug('comments_report_and_reply');

			if (($conf['commentsreport.']['active']) || (($conf['advanced.']['userCommentResponseLevels'] != 0) &&
					($this->isCommentingClosed($conf, $pObj) == 0) && ($row['level']==$conf['advanced.']['userCommentResponseLevels']))) {
				if (($conf['code']!='COMMENTS') || ($conf['commentsreport.']['active']!=0)) {
					$replyreportLineHTML1='<div class="tx-tc-ct-ry-report-line" id="tx-tc-ct-ry-rl-' . $row['uid'] . '">';
					$replyreportLineHTML2='</div>';
				}

			}

			$displaycss=$this->getCommentBoxDisplay($iuid, $conf, $row['level'], $fromAjax, $levelhlt, $row['levelexpandoverride']);
			$stylesubcommentHTML = ' tx-tc-mihgt-ctbox';
			$template = $templatemain;

			if (($row['level']>0) || ($displaycss !=''))  {

				if ($row['level']>0)  {
					$template = $templatesub;

					$shiftleft=' tx-tc-ct-box-rlvlm-' . $row['level'];
					$stylesubcommentHTML .= $shiftleft . ' tx-tc-indent-subcmt';
				}

				if ($displaycss !='')  {
					$stylesubcommentHTML .= $displaycss;
				}

			}
			if ($row['level'] == 0)  {
				$stylesubcommentHTML .= ' tx-tc-ct-box-rlvlm-0';
				if ((intval($conf['advanced.']['commentReview']) ==1) && ($_SESSION['feuserid'] > 0) && ($row['toctoc_commentsfeuser_feuser'] == $_SESSION['feuserid'])) {
					$stylesubcommentHTML .= ' tx-tc-ct-userreview';
				}
			}

			$commentDateNoRatings='';

			$txtviews='';
			$jscommentviewcounter='';
			if (intval($conf['advanced.']['countCommentViews']) ==1 ) {
				$jscommentviewcounter='<span class="tx-tc-cmtvcntr tx-tc-nodisp" id="tx-tc-cmtvcntr__'. 'tx_toctoc_comments_comments_'.$row['uid'] .
										'__'. $_SESSION['feuserid'] . '__'. $commentAjaxDatavar . '__1__' . $conf['storagePid'] .'"></span>';
			}

			if (intval($conf['advanced.']['showCountCommentViews']) ==1 ) {
				$totalcommentviewscount=0;
				$date='';
				if (isset($rows['firstview'])) {
					$date=$rows['firstview'];
					$totalcommentviewscount=intval($rows['commentviewscount']);
				}

				if ($totalcommentviewscount > 0) {
					if ($totalcommentviewscount==1) {
						if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.view', $fromAjax);
						} else {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewlong', $fromAjax);
						}

					} else {
						if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.views', $fromAjax);
						} else {
							$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewslong', $fromAjax);
						}

					}

					$txtviews= '<span class="tx-tc-commentviews">&nbsp;' . $totalcommentviewscount . ' ' . $strviews . '</span>';
				}

			}

			if ($conf['ratings.']['enableRatings'] != 1) {
				$templatecommentDateNoRatings = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENTDATE_NORATINGS###');
				$commentDateNoRatings =  $this->t3substituteMarkerArray($templatecommentDateNoRatings, array(
						'###COMMENT_DATE###' => $this->formatDate($row['crdate'], $pObj, $fromAjax, $conf) . $commentcontinuation,
						'###REF###' => $iuid,
						'###COMMENTID###' => $row['uid'],
						'###COMMENT_TIMESTAMP###' => $row['crdate'],
						'###STYLECOMMENT###' => $stylecomment,
						'###COMMENTVIEWS###' => $txtviews . $jscommentviewcounter,
				));
			}

			//namepart handling
			$firstname = $this->applyStdWrap(htmlspecialchars($row['firstname']), 'firstName_stdWrap', $conf);
			$lastname = $this->applyStdWrap(htmlspecialchars($row['lastname']), 'lastName_stdWrap', $conf);

			if ($conf['advanced.']['useNameCommentSeparator'] == 1) {
				$namepart = '' . trim($firstname . '&nbsp;' . $lastname) . ' ' . $conf['advanced.']['nameCommentSeparator'] . '&nbsp;';
			} else {
				$namepart = '' . trim($firstname . '&nbsp;' . $lastname);
			}

			if ((intval($conf['advanced.']['wallExtension']) > 0) && (intval($conf['advanced.']['wallExtension']) < 3)) {
				//communities: link all user names to their profiles on a wall
				if ($_SESSION['communityprofilepageparams'] == '') {
					$communityprofilepage = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepage']);
				} else {
					$linknameparm = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepageparams']);
					$communityprofilepage = str_replace('" rel', $linknameparm . '" rel', $_SESSION['communityprofilepage']);
				}

				$linknamepart = str_replace('dummy', trim($firstname . '&nbsp;' . $lastname), $communityprofilepage);
				$namepart = '' . $linknamepart . '';
			} elseif  ((intval($conf['advanced.']['wallExtension']) == 0) && ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users')) {
				//link if feuserid not current user
				$namepart = '' . trim($firstname . '&nbsp;' . $lastname) . '';
				$triggereduseridarr= explode('_', $_SESSION['commentListRecord']);
				$triggereduserid = $triggereduseridarr[count($triggereduseridarr)-1];
				if ($triggereduserid != $row['toctoc_commentsfeuser_feuser']) {
					if ($_SESSION['communityprofilepageparams'] == '') {
						$communityprofilepage = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepage']);
					} else {
						$linknameparm = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepageparams']);
						$communityprofilepage = str_replace('" rel', $linknameparm . '" rel', $_SESSION['communityprofilepage']);
					}

					$linknamepart = str_replace('dummy', trim($firstname . '&nbsp;' . $lastname), $communityprofilepage);
					$namepart = '' . $linknamepart . '';
				}

			}

			if (($conf['advanced.']['wallExtension'] != 0) || ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users')) {
				// get the user who was triggerd
				$triggereduseridarr= explode('_', $row['external_ref']);
				$triggereduserid = $triggereduseridarr[count($triggereduseridarr)-1];
				if ($conf['advanced.']['useNameCommentSeparator'] == 1) {
					$namepartsep = ' ' . $conf['advanced.']['nameCommentSeparator'] . '&nbsp;';
				} else {
					$namepartsep = '';
				}

				IF ($triggereduserid != $feuserid) {
					if ($conf['advanced.']['wallExtension'] != 0) {
						$rowsfeuser = $this->getBaseFeUsersArray($pObj, $fromAjax, $triggereduserid, '', $conf);
						$lastname2='';
						$firstname2='';
						if (count($rowsfeuser)>0) {
							if (array_key_exists('last_name', $rowsfeuser)) {
								$lastname2=$this->applyStdWrap(htmlspecialchars($rowsfeuser['last_name']), 'lastName_stdWrap', $conf);
							}

							if (array_key_exists('first_name', $rowsfeuser)) {
								$firstname2=$this->applyStdWrap(htmlspecialchars($rowsfeuser['first_name']), 'firstName_stdWrap', $conf);
							}

							if (trim($rowsfeuser['first_name']) . trim($rowsfeuser['last_name'])=='') {
								if (array_key_exists('name', $rowsfeuser)) {
									// make first-last name pair from name if possible
									$namePartsArr=explode(' ', $rowsfeuser['name']);
									$countNameParts = count($namePartsArr);

									if ($countNameParts>1) {
										$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
										$tmpLASTNAME = trim(substr($rowsfeuser['name'], (strlen($rowsfeuser['name'])-$lastpartlen), 1000));
										$tmpFIRSTNAME = trim(substr($rowsfeuser['name'], 0, strlen($rowsfeuser['name'])-strlen($tmpLASTNAME)));
									} else {
										$tmpLASTNAME = trim($rowsfeuser['name']);
										$tmpFIRSTNAME = '';
									}

									$lastname2=$this->applyStdWrap(htmlspecialchars($tmpLASTNAME), 'lastName_stdWrap', $conf);
									$firstname2=$this->applyStdWrap(htmlspecialchars($tmpFIRSTNAME), 'firstName_stdWrap', $conf);

								}

							}

						}

						if (trim($firstname . '&nbsp;' . $lastname)!=trim($firstname2 . '&nbsp;' . $lastname2)) {
							if ($_SESSION['communityprofilepageparams'] == '') {
								$communityprofilepage = str_replace('9999999', $triggereduserid, $_SESSION['communityprofilepage']);
							} else {
								$linknameparm = str_replace('9999999', $triggereduserid, $_SESSION['communityprofilepageparams']);
								$communityprofilepage = str_replace('" rel', $linknameparm . '" rel', $_SESSION['communityprofilepage']);

							}

							$linknamepart = str_replace('dummy', trim($firstname2 . '&nbsp;' . $lastname2), $communityprofilepage);

							if ($namepart!=$linknamepart) {
								$namepart = $namepart . '&nbsp;'. $this->pi_getLLWrap($pObj, 'pi1_template.via', $fromAjax).'&nbsp;' . $linknamepart . $namepartsep;

							} else {
								$namepart = $namepart . $namepartsep;
							}

						} else {
							$namepart .= $namepartsep;
						}

					} else {
						//on profile page
						$namepart .= $namepartsep;
					}

				} else {
						//on profile page
						$namepart .= $namepartsep;
					}

			}

			//Parse for Links and Smilies and BB-codes

			$this->trackdebug('0 comments_prepare_commenttext');
			$text = $this->applyStdWrap(nl2br($this->createLinks($row['content'], $conf)), 'content_stdWrap', $conf);
			$text = $this->replaceSmilies($text, $conf);
			$text =$this->replaceBBs($text, $pObj, $conf, FALSE);
			$text =$this->addleadingspace($text);
			$this->trackdebug('0 comments_prepare_commenttext');
			$text = $this->makeemoji($text, $conf, 'comments_getComments');

			$text = str_replace('"> <a', '">&nbsp;<a', $text);

			$useFields = t3lib_div::trimExplode(',', $conf['useFieldsSequence'], TRUE);
			$hascommenttitle =in_array('commenttitle', $useFields) ? 1 : 0;

			if ($hascommenttitle==1) {
				$linesplit = '<br>';
				if (trim($row['commenttitle']) == '') {
					$linesplit = '';
				}
				$text = '<span class="tx-tc-commenttitle" id="tx-tc-commenttitle-'.$row['uid'].'">' .
						$this->applyStdWrap(htmlspecialchars($row['commenttitle']), 'commentTitle_stdWrap', $conf) . $linesplit . '</span>' . $text;
			}
			$tippjsemoji='';
			if (($conf['advanced.']['useEmoji'] > 0) || is_array($conf['smilies.'])) {
				if ($haseditlink!=TRUE) {
					if (($conf['ratings.']['useLikeDislikeStyle'] == 0) || ($conf['useUserImage'] == 0) || ($conf['ratings.']['useVotes'] == 0)) {
						$cssidpart='tx-tc-ct-box-cttxt-';

					} else {
						$cssidpart='tx-tc-ct-box-cttxt-start-';
					}

					$tippjsemoji=' tx-tc-tipemo-1" id="tx-tc-tipemo-1-' . $cssidpart . '__0' . $iuid;
				}

			}
			$row['sqnumber'] = intval($this->sqnumber);
			$this->sqnumber++;
			$commentusername=trim($row['firstname'] . ' ' . $row['lastname']);
			$this->trackdebug('comments_getComments_getRatings');
			$allratingmarkers=$this->comments_getComments_getRatings($row, $conf, $pObj, $feuserid, $fromAjax);
			$this->trackdebug('comments_getComments_getRatings');
			if ($conf['ratings.']['useLikeDislikeStyle']==1) {
				$allratingmarkersarr=explode('<div class="tx-tc-overrating-date">', $allratingmarkers);
				$allratingmarkersarrrest=explode('<p id="tx-tc-ct-box-cttxt', $allratingmarkersarr[1]);
				$allratingmarkers=$allratingmarkersarr[0].$allratingmarkersarrrest[1];
				$extractedcommentdate= '</div><div class="tx-tc-overrating-date">' . $allratingmarkersarrrest[0];
				$extractedcommentdate= str_replace('<div', '<span', $extractedcommentdate);
				$extractedcommentdate= str_replace('</div', '</span', $extractedcommentdate);
				$extractedcommentdate= str_replace('' . $this->middotchar . '', '', $extractedcommentdate);
				$brratingsovercomment='<br />';
				$idchange = '';
				$classchange = '';
				if ($conf['ratings.']['useVotes']==1) {
					$idchange = '-start';
					$classchange = 'lower-';
					$extractedcommentdate = str_replace('<span class="tx-tc-rts-dp">', '<br /><span class="tx-tc-rts-dp">', $extractedcommentdate);
					$brratingsovercomment='';
					//extract the voting html
					$allratingmarkersarrvt=explode('<span class="tx-tc-rts-dp">', $extractedcommentdate);
					$countspanendtags= count(explode('</span>', $allratingmarkersarrvt[1]));
					$extractedcommentvoting = '';
					$spanendtags= explode('</span>', $allratingmarkersarrvt[1]);
					for ($sp=0;$sp<$countspanendtags-4;$sp++) {
						$extractedcommentvoting .= $spanendtags[$sp] .'</span>';
					}

					$extractedcommentvoting =str_replace('<span', '<div', '<span class="tx-tc-overrating-voting" id="tx-tc-rts-disp2-tx_toctoc_comments_comments_' .
							$row['uid'] . '"><span class="tx-tc-rts-dp">'. $extractedcommentvoting . '</span><br />');
					$extractedcommentvoting = '</p>' . str_replace('</span', '</div', $extractedcommentvoting) .
					'<p class="tx-tc-' . $classchange . 'text" id="tx-tc-ct-box-cttxt'.$idchange . '-' . $row['uid'] .'">';
					$extractedcommentvoting =str_replace('idrep"></div>', 'idrep"></span>', $extractedcommentvoting);
					$extractedcommentvoting =str_replace('<div title=', '<span title=', $extractedcommentvoting);
					$newdatec=$allratingmarkersarrvt[0].'</span></span></span>';
					$extractedcommentdate=$newdatec. $extractedcommentvoting;
				}

				$ratingsundercomment='';
				$ratingsovercomment=$allratingmarkers;
				if ($conf['advanced.']['useNameCommentSeparator'] == 1) {
					$namepart= str_replace($conf['advanced.']['nameCommentSeparator'], $conf['advanced.']['nameCommentSeparator'] . '&nbsp;', $namepart);
				} else {
					$namepart= str_replace($conf['advanced.']['nameCommentSeparator'], '', $namepart);
				}

				$namepart= '<span id="txtcnamepart' . $iuid . '" class="tx-tc-fleft">'.  $namepart;

			} else {
				$brratingsovercomment='';
				$ratingsundercomment=$allratingmarkers;
				$ratingsovercomment='';
				$extractedcommentdate='';
			}

			$commentreview='';
			if (($conf['advanced.']['commentReview'] == 1) && ($row['level'] == 0)) {
				if ($row['toctoc_commentsfeuser_feuser'] == $feuserid) {
					// active
					//print_r($conf);
					//print $_SESSION['commentsPageId'] . ', '. $_SESSION['commentListCount'] . ' ' . $externalref . $commentusername .$feuserid;exit;
					$commentreview = $this->comments_getComments_getRatings($row, $conf, $pObj, $feuserid, $fromAjax, 1, $externalref, $commentusername);
				} else {
					// static
					$saveconfratingsmode = $conf['ratings.']['mode'];
					$conf['ratings.']['mode'] = 'static';
					$commentreview = $this->comments_getComments_getRatings($row, $conf, $pObj, $row['toctoc_commentsfeuser_feuser'], $fromAjax, 1, $externalref, $commentusername);
					$conf['ratings.']['mode'] = $saveconfratingsmode;
				}

			}

			$populatityvalue = intval($row['popularityvalue']);
			if ($populatityvalue == 0) {
				$populatityvalue = 1;
			}

			$markerArray = array(
					'###ALTERNATE###' => '-' . ($alt + 1),
					'###FIRSTNAME###' => $firstname,
					'###LASTNAME###' => $lastname ,
					'###NAMEPART###' => $row['popularityicon'] . $namepart,
					'###STYLEBOX###' => $stylebox,
					'###IMAGE###' => '',
					'###LOGOUT###' => $loggout,
					'###IMAGETAG###' => $this->applyStdWrap($row['imagetag'], 'image_stdWrap', $conf),
					'###EMAIL###' => $this->applyStdWrap($this->comments_getComments_getEmail($row['email']), 'email_stdWrap', $conf),
					'###LOCATION###' => $this->applyStdWrap(htmlspecialchars($row['location']), 'location_stdWrap', $conf),
					'###HOMEPAGE###' => $this->applyStdWrap(htmlspecialchars($row['homepage']), 'webSite_stdWrap', $conf),
					'###COMMENT_DATE###' => $this->formatDate($row['crdate'], $pObj, $fromAjax, $conf) . $commentcontinuation,
					'###COMMENTVIEWS###' => $txtviews . $jscommentviewcounter,
					'###STYLECOMMENT###' => $stylecomment,
					'###COMMENTDATENORATINGS###' => $commentDateNoRatings,
					'###COMMENT_CONTENT###' => $text,
					'###COMMENT_ID###' => $iuid,
					'###SORTING###' => intval($conf['advanced.']['reverseSorting']),
					'###SQNUMBER###' => $row['crdate'] ,
					'###POPNUMBER###' => $populatityvalue . '__0' . $row['sqnumber'] . '__0' . $row['level'],
					'###SORTPOPULAR###' => $conf['advanced.']['sortMostPopular'],
					'###CID###' => $_SESSION['commentListCount'],
					'###TOCTOCUID###' => base64_encode($row['toctoc_comments_user']),
					'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###RATINGS###' => $ratingsundercomment,
					'###OVERCOMMENTRATINGS###' => $ratingsovercomment,
					'###COMMENTREVIEW###' => $commentreview,
					'###BROVERCOMMENTRATINGS###' => $extractedcommentdate. $brratingsovercomment,
					'###DENOTIFY_LINK###' => $denotifylinkout,
					'###TIPPJS###' => $tippjsemoji,
					'###EDIT_LINK###' => $editlinkout,
					'###DELETE_LINK###' => $deletelinkout,
					'###DELETE_LINK_TEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.deletelink', $fromAjax),
					'###DELETE_COMMENT_IMAGE###' => htmlspecialchars($conf['DeleteCommentImage']),
					'###KILL_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $iuid . '&chk=' . $check  . '&lng=' . $lang . '&cmd=kill'),
					'###ENCTEXT_ADD_COMMENT###' => base64_encode($txtwatermarkform),
					'###TEXT_ADD_COMMENT###' => $txtwatermarkform,
					'###COMMENT_RESPONSE###' => '',
					'###ATTACHMENT###' => $attachmentHTML,
					'###EXPANDCOMMENTS###' => $expandcommentsHTML,
					'###TX_COMMENTSREPLY###' => $subcommentreply,
					'###STYLECOMMENTBOX###' => $stylesubcommentHTML,
					'###LINE_COMMENTSREPORTREPLYSTART###' => $replyreportLineHTML1,
					'###LINE_COMMENTSREPORTREPLYEND###' => $replyreportLineHTML2,
					'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
					'###TXTHASCHILDREN###' => $txthaschildern,
				);
			//fe_user-integration
			$params = array(
					'template' => $template,
					'markers' => $markerArray,
					'row' => $row,
			);

			$this->trackdebug('comments_getComments_fe_user');
			$tempMarkers = $this->comments_getComments_fe_user($params, $conf, $pObj, $iuid, $fromAjax, $commentusername);
			// little sanitychecks:
			$tempMarkers['###IMAGE###']=str_replace('alt="" title=""', 'alt=""', $tempMarkers['###IMAGE###']);

			if (strlen(trim($tempMarkers['###IMAGE###'])) > strpos('>', trim($tempMarkers['###IMAGE###']))) {
				//Then let's put it at the end'
				$corrimage = str_replace ('>', ' ', $tempMarkers['###IMAGE###']);
				$corrimage = $corrimage . '">';
				$corrimage = str_replace('"" ">', '"">', $corrimage);
				$corrimage = str_replace(' ">', '>', $corrimage);
				$tempMarkers['###IMAGE###'] = $corrimage;
			}

			if (str_replace('class="tx-tc-margin0 tx-tc-online"', '', $tempMarkers['###IMAGE###']) != $tempMarkers['###IMAGE###']) {
				$tempMarkers['###IMAGE###']=str_replace('class="tx-tc-margin0 tx-tc-online"', 'class="tx-tc-userpic tx-tc-online tx-tc-uimgsize"', $tempMarkers['###IMAGE###']);
			}

			$this->trackdebug('comments_getComments_fe_user');

			if (is_array($tempMarkers)) {
				$markerArray = $tempMarkers;
			}

			$timeout = intval($conf['timeoutUC']);
			if ($timeout < 3) {
				$timeout = 3;
			} elseif ($timeout > 15) {
				$timeout = 15;
			}

			$timeout = 1000*$timeout;

			$plachdr = '';
			if ($conf['theme.']['selectedBoxmodelkoogled'] == 1) {
				$plachdr = '***';
			}

			$markerArray['###PCEHDRPIC###'] = $plachdr;

			$markerArray['###SHOWUCLINK###'] = '';
			// Call hook for custom markers

			if (intval($conf['useUserImage']) != 0) {
				$markerArray['###SHOWUCLINK###'] = 'tx-tc-nameclasslink__'.$iuid.'__'.
						$_SESSION['commentListCount'].'__'.base64_encode($row['toctoc_comments_user']).'__'.base64_encode($markerArray['###IMAGE###']).
						'__'.$timeout;
			} else {
				if ($conf['advanced.']['wallExtension'] == 0) {
				$markerArray['###NAMEPART###'] = '<span class="tx-tc-commenttextuclink tx-tc-textlink" id="tx-tc-nameclasslink__'.$iuid.'__'.
						$_SESSION['commentListCount'].'__'.base64_encode($row['toctoc_comments_user']).'__'.base64_encode($markerArray['###IMAGE###']).
						'__'.$timeout .'">' . $markerArray['###NAMEPART###'] . '</span>';
				}
			}

			$pObj->conf = $conf;
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments_getComments'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments_getComments'] as $userFunc) {
					$params = array(
							'pObj' => $pObj,
							'template' => $template,
							'markers' => $markerArray,
							'row' => $row,
					);

						if (($userFunc != 'comments_response') && ($userFunc != 'comments_report')) {
							if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
								$markerArray = $tempMarkers;
							}

						}

				}
			}

			//comments_response
			$commentresponse_start='';
			$commentresponse_end='';
			$commentsresponse = '';
			if (intval($conf['advanced.']['adminCommentResponse']) == 1) {
				if ($row['tx_commentsresponse_response'] != '') {
					$commentsresponse = $this->applyStdWrap(
							nl2br($this->createLinks(htmlspecialchars($row['tx_commentsresponse_response']), $conf)),
							'content_stdWrap',
							$conf
					);
					$commentsresponse = $this->replaceSmilies($commentsresponse, $conf);
					$commentsresponse = $this->replaceBBs($commentsresponse, $pObj, $conf, FALSE);
					$commentsresponse = $this->makeemoji($commentsresponse, $conf, 'getCommentsReponse');
					$commentsresponse =$this->addleadingspace($commentsresponse);
				}

				$markerArray['###COMMENT_RESPONSE###'] = $commentsresponse;
			}

			if ((intval($conf['advanced.']['adminCommentResponse']) == 1) || ($markerArray['###COMMENT_RESPONSE###'] !='')) {
				if (trim($markerArray['###COMMENT_RESPONSE###']) !='') {
					$markers['###RESPOND_LINK###'] = $this->pi_getLLWrap($pObj, 'email.textresponsetothecomment', $fromAjax) .
					$markers['###RESPOND_LINK###'];
					$commentresponse_start='<div class="tx-tcresponse-text" id="tx-id-tcresponse-text-__0'.$row['uid'].'"><span class="tx-tcresponse-text-title">' .
					$this->pi_getLLWrap($pObj, 'pi1_template.admincommenttitle', $fromAjax) . '</span>';
					$commentresponse_end='</div>';
				}

			}

			$markerArray['###COMMENT_RESPONSE_START###'] = $commentresponse_start;
			$markerArray['###COMMENT_RESPONSE_END###'] = $commentresponse_end;

			//comments_report

			if ($conf['commentsreport.']['active']) {

					$markerArray['###TX_COMMENTSREPORT###'] ='';
					$params = array(
							'pObj' => $pObj,
							'template' => $template,
							'markers' => $markerArray,
							'row' => $row,
					);
					$this->trackdebug('comments_getReportLink');
					if (is_array($tempMarkers = $this->getCommentsReportLink($params, $pObj, $fromAjax, $pid))) {
						$markerArray = $tempMarkers;
					}

					$this->trackdebug('comments_getReportLink');
					//post processing  :-)
					if ($markerArray['###TX_COMMENTSREPORT###'] !='') {
						$linktag=strstr($markerArray['###TX_COMMENTSREPORT###'], '>', TRUE) .'>';
						$totllinktext=substr($markerArray['###TX_COMMENTSREPORT###'], strlen($linktag));
						$linkendtag=strstr($totllinktext, '<');
						$linkendtext=str_replace($linkendtag, '', $totllinktext);
						$imghtml = '<img height="15" width="15" src="' . $this->locationHeaderUrlsubDir() .
						t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/report.png" title="' .
						$linkendtext .'" />';
						$markerArray['###TX_COMMENTSREPORT###'] ='<div class="tx-tc-ct-report" id="tx-tc-ct-report-'. $row['uid'] .'">' . $linktag .$imghtml.$linkendtag . '</div>';
					}

			} else {
				$markerArray['###TX_COMMENTSREPORT###'] ='';
			}

			//highlight for selected (anchor-referenced) comment
			$highlightstyle = 'class="tx-tc-ct-innerctbox';
			if (($_GET['toctoc_comments_pi1']['anchor']) || (intval($_SESSION['newcommentid']) > 0)) {
				$hlsanchorarr=explode('-', $_GET['toctoc_comments_pi1']['anchor']);
				if ((count($hlsanchorarr)>0) || (intval($_SESSION['newcommentid']) > 0)) {
					if (intval($_SESSION['newcommentid']) > 0) {
						$hlsctid= intval($_SESSION['newcommentid']);

					} else {
						$hlsctid= $hlsanchorarr[(count($hlsanchorarr)-1)];
					}

					if ($iuid==$hlsctid) {
						$highlightstyle.=' tx-tc-ct-highlight';
						$_SESSION['newcommentid']=0;
					}

				}

			}
			$highlightstyle.='"';
			$markerArray['###HIGHLIGHTSTYLE###'] = $highlightstyle;
			$entries[] = $this->t3substituteMarkerArray($template, $markerArray);
			$alt = ($alt + 1) % 2;
		}

		$this->trackdebug('comments_getComments');
		$retstr = implode( $entries);
		return $retstr;
	}

	/**
	 * Retrieves ratings for this comment if ratings are enabled
	 * if not returns empty string.
	 *
	 * @param	array		$row	Comment row data
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @param	[type]		$scopeid: ...
	 * @param	[type]		$externalref: ...
	 * @param	[type]		$commentusername: ...
	 * @return	string		Ratings	HTML for this row
	 */
	public function comments_getComments_getRatings(&$row, $conf, $pObj, $feuserid, $fromAjax, $isReview = 0, $externalref = '', $commentusername = '') {
		if ($conf['ratings.']['enableRatings']) {
			if ($this->isCommentingClosed($conf, $pObj)) {
				$conf['ratings.']['mode'] = 'static';
			}

			if ($isReview == 0) {
				$strrating = $this->getRatingDisplay('tx_toctoc_comments_comments_' . $row['uid'], $conf, $fromAjax, $_SESSION['commentsPageId'], FALSE,
					$feuserid, 'vote', $pObj, $_SESSION['commentListCount'], TRUE);
			} else {

				$savuseMyVote = $conf['ratings.']['useMyVote'];
				$savuseVotes = $conf['ratings.']['useVotes'];
				$savuseNumberOfVotes = $conf['ratings.']['useNumberOfVotes'];
				$savuseNumberOfStars = $conf['ratings.']['useNumberOfStars'];
				$savuseAvgOfVotes = $conf['ratings.']['useAvgOfVotes'];
				$savuseLikeDislike = $conf['ratings.']['useLikeDislike'];
				$savuseDislike = $conf['ratings.']['useDislike'];

				$conf['ratings.']['useMyVote'] = 1;
				$conf['ratings.']['useVotes'] = 1;
				$conf['ratings.']['useNumberOfVotes'] = 0;
				$conf['ratings.']['useNumberOfStars'] = 0;
				$conf['ratings.']['useAvgOfVotes'] = 0;
				$conf['ratings.']['useLikeDislike'] = 0;
				$conf['ratings.']['useDislike'] = 0;

				$scopearr= array();
				if (isset($_SESSION['ratingsscopes'][$_SESSION['commentListRecord']])) {
					$scopearr= explode(',', trim($_SESSION['ratingsscopes'][$_SESSION['commentListRecord']]));
				}
				$j=0;
				if ((count($scopearr)==0) || ((count($scopearr) == 1) && ($scopearr[0] == ''))) {
					$scopearr[0]=array();
					$scopearr[0]['uid']=0;
					$scopearr[0]['scope_title']='';
					$scopearr[0]['scope_description']='';
					$j=1;
				} else {
					if (intval($conf['ratings.']['useOverallScopeForVote']) == 1) {
						$scopearr[0]=array();
						$scopearr[0]['uid']=0;
						$scopearr[0]['scope_title']=$this->pi_getLLWrap($pObj, 'api_rating.votescopeoveraall', $fromAjax);
						$scopearr[0]['scope_description']=$this->pi_getLLWrap($pObj, 'api_rating.votescopeoveraalldesc', $fromAjax);
						$j=1;
					}

				}

				// now do we have cscopes in current language?
				$scopesavailableincurrentlanguage= 0;
				$cntsess= 0;
				if (isset($_SESSION['ratingsscopesinternalm1tablelan'][$_SESSION['commentListRecord']])) {
					$cntsess=count($_SESSION['ratingsscopesinternalm1tablelan'][$_SESSION['commentListRecord']]);
				}
				for ($i=0; $i<$cntsess; $i++){
					if ($_SESSION['ratingsscopesinternalm1tablelan'][$_SESSION['commentListRecord']][$i]==$_SESSION['activelangid']) {
						$scopesavailableincurrentlanguage= $_SESSION['activelangid'];
					}

				}

				//copy the scopes in correct language from session to local var
				$cntsess= 0;
				if (isset($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']])) {
					$cntsess=count($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']]);
				}
				for ($i=0; $i<$cntsess; $i++){
					if ($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']][$i]['sys_language_uid'] == $scopesavailableincurrentlanguage) {
						$scopearr[$j]=$_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']][$i];
						$j++;
					}

				}

				$articlerating = array();

				for ($i=0; $i<$j; $i++){
					if ($scopearr[$i]['uid']==0) {
						$externalrefscope = $externalref;
						$scopeid=0;
					} else {
						$externalrefscope = $externalref;
						$scopeid=$scopearr[$i]['uid'];
					}

					$articlerating[$i] = array();
					$compics=array();
					$saveconfstaticmode= $conf['ratings.']['mode'];
					$saveconfstaticmodeplus= $conf['ratings.']['mode'];
					if (intval($conf['ratings.']['useOverallScopeForVote']) == 1) {
						if (intval($conf['ratings.']['enableOverallScopeForVote'])==0) {
							if (($i==0) && (count($scopearr)>1)) {
								$conf['ratings.']['modeplus']='autostatic';
							}

						}

					}

					if (($i==0) && ($scopeid!=0)) {
						$articleratingtmp = $this->getRatingDisplay($externalrefscope, $conf, $fromAjax, $_SESSION['commentsPageId'], TRUE,
								$feuserid, 'votearticle', $pObj, $_SESSION['commentListCount'], TRUE, $compics, 0, 1, $commentusername);
						$articleratingtmp['ilike'] = str_replace('\'like\',', '\'liketop\',', $articleratingtmp['ilike'] );
						$articleratingtmp['idislike'] = str_replace('\'unlike\',', '\'unliketop\',', $articleratingtmp['idislike'] );
						$articleratingtmp['ilike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articleratingtmp['ilike'] );
						$articleratingtmp['idislike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articleratingtmp['idislike'] );

						$articleratingtmpvotingarr = explode('<div class="tx-tc-rts-container">', $articleratingtmp['voteing'] );
						$articleratingtmpvoting = $articleratingtmpvotingarr[0];

					}

					$articlerating[$i] = $this->getRatingDisplay($externalrefscope, $conf, $fromAjax, $_SESSION['commentsPageId'], TRUE,
							$feuserid, 'votearticle', $pObj, $_SESSION['commentListCount'], TRUE, $compics, $scopeid, 1, $commentusername);
					if (($i==0) && ($scopeid!=0)) {
						$articlerating[$i]['ilike'] = $articleratingtmp['ilike'];
						$articlerating[$i]['idislike'] = $articleratingtmp['idislike'];
						$articlerating[$i]['mylikehtml'] = $articleratingtmp['mylikehtml'];
						$articlerating[$i]['mydislikehtml'] = $articleratingtmp['mydislikehtml'];
						$articleratingtmpvotingarr = explode('<div class="tx-tc-rts-container">', $articlerating[$i]['voteing'] );
						if (trim($articleratingtmpvoting .$articleratingtmpvotingarr[1])!='') {
							$articlerating[$i]['voteing']  = $articleratingtmpvoting . '<div class="tx-tc-rts-container">'. $articleratingtmpvotingarr[1];
						}

					} else {

						$articlerating[$i]['ilike'] = str_replace('\'like\',', '\'liketop\',', $articlerating[$i]['ilike'] );
						$articlerating[$i]['idislike'] = str_replace('\'unlike\',', '\'unliketop\',', $articlerating[$i]['idislike'] );
						$articlerating[$i]['ilike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articlerating[$i]['ilike'] );
						$articlerating[$i]['idislike'] = str_replace('\'myratings\'', '\'myratingstop\'', $articlerating[$i]['idislike'] );

					}

					$conf['ratings.']['mode']=$saveconfstaticmode;
					$conf['ratings.']['modeplus']=$saveconfstaticmodeplus;
				}

				$voteHTML='';
				$countarticlerating=count($articlerating);
				for ($i=0; $i<$countarticlerating; $i++){
					$firstvotedivstart='';
					$firstvotedivend='';

					if (trim($articlerating[$i]['voteing'])!='') {
						$scopetitlehtml='';
						if ($scopearr[$i]['uid']==0) {
							$scopeid=$externalref;
						} else {
							$scopeid=$externalref . '-' . $scopearr[$i]['uid'];
						}

						if($scopearr[$i]['scope_title']!='') {
							$scopetitlebold = '';
							if($i==0) {
								if (intval($conf['ratings.']['useOverallScopeForVote']) == 1) {
									$scopetitlebold = 'bold';
									$scopeid=$externalref;
								}

								$firstvotedivstart='<div class="tx-tc-firstvote">';
								$firstvotedivend='</div>';
							}

							$scopetitlehtml=$firstvotedivstart. '<span id="tx-tc-scope-'.$scopeid.'" title="'. $scopearr[$i]['scope_description'] .
							'" class="tx-tc-scopetitle'.$scopetitlebold.'">'. $scopearr[$i]['scope_title'] . '</span>';
						}

						$divend='';
						if(($i+1)<count($articlerating)) {
							$divend='</div>';
						}

						$divstart='';
						if(($i>0)) {
							if ($conf['advanced.']['commentReview'] ==1) {
								$rtsrws = 'rws';
							} else {
								$rtsrws = 'rts';
							}

							$divstart='<div id="tx-tc-rts-'.$externalref . '-' . $scopearr[$i]['uid'].'" class="tx-tc-' . $rtsrws . '-area">';
						}

						$voteHTML .= $divstart .
						str_replace('<div class="tx-tc-rts-container">', '<div id="tx-tc-rts-container-scp-' .
								$_SESSION['commentListCount'] . '__0' . $scopeid . '" class="tx-tc-rts-cntrdata tx-tc-rts-container">' .
								$scopetitlehtml, $articlerating[$i]['voteing']) .
								$firstvotedivend . $divend;
					}

				}

				if (($conf['ratings.']['useVotes'] == 0) || ($conf['ratings.']['useTopVotes']==0)) {
					// kick out the scopes and remaining voting area
					$voteHTML=trim($voteHTML);
					$voteHTML=trim(substr($voteHTML, 0, strpos($voteHTML, 'tx-tc-rts-container')-9));
				}

				$conf['ratings.']['useMyVote'] = $savuseMyVote;
				$conf['ratings.']['useVotes'] = $savuseVotes;
				$conf['ratings.']['useNumberOfVotes'] = $savuseNumberOfVotes;
				$conf['ratings.']['useNumberOfStars'] = $savuseNumberOfStars;
				$conf['ratings.']['useAvgOfVotes'] = $savuseAvgOfVotes;
				$conf['ratings.']['useLikeDislike'] = $savuseLikeDislike;
				$conf['ratings.']['useDislike'] = $savuseDislike;
				$voteHTML = str_replace('id="tx-tc-rts', 'id="tx-tc-rws' . $row['uid'], $voteHTML);
				$voteHTML = str_replace('id="tx-tc-myrts', 'id="tx-tc-myrws' . $row['uid'], $voteHTML);
				$voteHTML = str_replace('id="tx-tc-scope-', 'id="tx-tc-scope-' . $row['uid'], $voteHTML);
				if (trim($voteHTML) != '') {
					$voteHTML = '<div class="tx-tc-rws-area">' . $voteHTML . '</div>';
				}

				$strrating = $voteHTML;

			}
			return $strrating;
		}

		return '';
	}

	/**
	 * Generates e-mail taking spam protection into account
	 *
	 * @param	string		$email		E-mail
	 * @param	object		$pObjCobj: Cobj of the parent object
	 * @return	string		Generated e-mail code
	 */
	protected function comments_getComments_getEmail($email) {
		$retstr = ($email ? $this->cObj->typoLink_URL(array(
				'parameter' => $email,
		))
				: '');
		return $retstr;

	}

	/**
	 * Checks if commenting is closed for this item
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	boolean		<code>TRUE</code> if commenting is closed
	 */
	protected function isCommentingClosed($conf, $pObj) {

		// Try global settings
		if ($conf['advanced.']['commentingClosed']==0) {
			$timeAdd = $conf['advanced.']['closeCommentsAfter'];
			if ($timeAdd == '') {
				// No time limit emposed
				return FALSE;
			}
			if (trim($pObj->externalUidString) == '') {
				if (version_compare(TYPO3_branch, '6.1', '<')) {
					t3lib_div::loadTCA($pObj->foreignTableName);
				}
				if (isset($GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['crdate'])) {
					$fieldName = $GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['crdate'];
				} elseif (isset($GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['tstamp'])) {
					$fieldName = $GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['tstamp'];
				} else {
					// No time field configured in TCA -- cannot limit!
					return FALSE;
				}

				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($fieldName, $pObj->foreignTableName,
						'uid=' . intval($pObj->externalUid) . $this->enableFields($pObj->foreignTableName, $pObj, $fromAjax));
				if (count($rows) == 1) {
					$time = strtotime($timeAdd, $rows[0][$fieldName]);
					if ($time <= $GLOBALS['EXEC_TIME']) {
						$conf['ratings.']['mode'] = 'static';
						return TRUE;
					}

					$GLOBALS['TSFE']->set_cache_timeout_default($time - $GLOBALS['EXEC_TIME']);
				}

			} else {
				return FALSE;
			}

		} else {
			$conf['ratings.']['mode'] = 'static';
			return TRUE;
		}

		return FALSE;
	}


	/**
	 * Produces "commenting closed" message.
	 *
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	[type]		$conf: ...
	 * @return	void
	 */
	protected function commentingClosed($pObj, $fromAjax, $conf) {
		$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENTING_CLOSED###');
		$retstr =  $this->t3substituteMarkerArray($template, array(
				'###MESSAGE###' => $this->pi_getLLWrap($pObj, 'commenting.closed', $fromAjax),
				'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###SELTHEME###' => $conf['theme.']['selectedTheme'],
			)
		);
		return $retstr;

	}

	/**
	 * Creates a comments browser
	 *
	 * @param	int		$rpp: 			number of records shown
	 * @param	int		$startpoint:	row number from that on comments are shown
	 * @param	int		$totalrows: 	total of rows present
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	[type]		$conf: ...
	 * @return	string		Generated HTML
	 */
	protected function comments_getCommentsBrowser($rpp, $startpoint, $totalrows, $pObj, $fromAjax, $conf) {
		$result='';
		$piLLreviewident = '';
		if ($conf['advanced.']['commentReview'] ==1) {
			$piLLreviewident = 'review';
		}

		$emptybrowsestr='<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' . $_SESSION['commentListCount'] . '"></div>';
		$externalbegin=substr($this->externalref, 0, 5);
		if (($this->externalref != '') && ($externalbegin != 'pages')) {
			if ($this->ajaxextref != '') {
				//ajaxextref: needed to build correct js calls for toctoc_comments_submit
				// it's token from pi and filled if its not a tt_content record
				$externalref = $this->ajaxextref;
			} else {
				$externalref = $this->externalref;
			}

		} else {
			if ($this->ajaxextref != '') {
				$externalref = $this->ajaxextref;
			} else {
				$externalref = 'tt_content_' . $_SESSION['commentListCount'];
			}

		}

		$conditionshow=FALSE;
		$conditionhide=FALSE;

		if ($conf['advanced.']['reverseSorting']==1) {
			if ($startpoint>0) {
				$conditionshow=TRUE;
			}

			if (($totalrows-$startpoint) > $rpp) {
				$conditionhide=TRUE;
			}

			$startpt=$totalrows-$startpoint;
		} else {
			if ($startpoint > 0) {
				$conditionshow=TRUE;
			}

			if (($totalrows-$startpoint) > $rpp) {
				$conditionhide=TRUE;
			}

			$startpt=$startpoint;
		}
		$submitSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###BROWSE_COMMENT_LINK_SUB###');
		if ($conditionshow==TRUE) {
			$emptybrowsestr='';
			$submithtml='';
			$check = md5($ref . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			$tmpcid=$_SESSION['commentListCount'];
			$ref='tt_content_' . $tmpcid;
			$submithtmlSub =  $this->t3substituteMarkerArray($submitSub, array(
					'###VALUE###' => '1',
					'###REF###' => $externalref,
					'###PID###' => $pid,
					'###CID###' => $tmpcid,
					'###CHECK###' => $check,
					'###HIDE###' => '',
					'###STARTPOINT###' => $startpt,
					'###TOTALROWS###' => $totalrows,
			));

			$submithtml=$submithtmlSub;
			if ($conf['advanced.']['sortMostPopular'] == 0) {
				$txtoldercommentsOnemore = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'older_row_available', $fromAjax);
				$txtoldercommentsSomemore = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'older_rows_available', $fromAjax);
			} else {
				$txtoldercommentsOnemore = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'lesspopular_row_available', $fromAjax);
				$txtoldercommentsSomemore = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'lesspopular_rows_available', $fromAjax);
			}

			if ($startpoint==1) {
				$oldercomments=$txtoldercommentsOnemore;
			} else {
				$oldercomments=$txtoldercommentsSomemore;
			}

			if ($conf['advanced.']['sortMostPopular'] == 0) {
				$linktipp = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'show_older_rows_text', $fromAjax) . ' ' . $startpoint . ' ' . $oldercomments;
				$linktext = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'show_older_rows_linktext', $fromAjax);
			} else {
				$linktipp = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'show_lesspopular_rows_text', $fromAjax) . ' ' . $startpoint . ' ' . $oldercomments;
				$linktext = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'show_lesspopular_rows_linktext', $fromAjax);
			}

			$result .= '<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' . $_SESSION['commentListCount'] . '"><span id="bf' .
			$_SESSION['commentListCount'] . '" class="comment-browseform">';
			$result .= '<span id="toctoc_comments_pi1_submit_bcid' . trim($submithtml) . '" ';
			$result .= 'class="tx-tc-cts-ctsbrowse-submit tx-tc-textlink" title="' . $linktipp;
			$result .= '">' . $linktext . '</span>';
			$result .= '</span></div>';
		}

		if ($conditionhide==TRUE) {

			$submithtml='';
			$check = md5($ref . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			$tmpcid=$_SESSION['commentListCount'];
			$ref='tt_content_' . $tmpcid;
			$submithtmlSub =  $this->t3substituteMarkerArray($submitSub, array(
					'###VALUE###' => '1',
					'###REF###' => $externalref,
					'###PID###' => $pid,
					'###CID###' => $tmpcid,
					'###CHECK###' => $check,
					'###HIDE###' => 'hide',
					'###STARTPOINT###' => $startpoint,
					'###TOTALROWS###' => $totalrows,
			));
			$submithtml = $submithtmlSub;
			if ($conf['advanced.']['sortMostPopular'] == 0) {
				$linktipp = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'hide_older_rows_text', $fromAjax);
				$linktext = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.hide_older_rows_linktext', $fromAjax);
			} else {
				$linktipp = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.' . $piLLreviewident . 'hide_lesspopular_rows_text', $fromAjax);
				$linktext = $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.hide_lesspopular_rows_linktext', $fromAjax);
			}

			$result .= $emptybrowsestr . '<div class="tx-tc-cts-ctsbrowse-hide" id="tx-tc-cts-ctsbrowse-hide-' .
			$_SESSION['commentListCount'] . '"><span id="bfh' . $_SESSION['commentListCount'] . '" ';
			$result .= 'class="comment-browseform-hide">';
			$result .= '<span id="toctoc_comments_pi1_submit_bhcid' . trim($submithtml) . '" ';
			$result .= 'class="tx-tc-cts-ctsbrowse-submit-hide tx-tc-textlink" title="' . $linktipp;
			$result .= '">' . $linktext .'</span>';
			$result .= '</span></div>';
		}

		return $result;
	}



	/**
	 * Returns a list of markers with fe_user properties
	 *
	 * @param	[type]		$params: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$commentid: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$commentusername: ...
	 * @return	array
	 */
	public function comments_getComments_fe_user($params, $conf, $pObj, $commentid, $fromAjax, $commentusername) {
		// sets default value if no user is logged in
		$params['markers']['###USERNAME###'] = $params['markers']['###FIRSTNAME###']. ' '
				. $params['markers']['###LASTNAME###'];
		$rowsfeuser = array();
		$rowsfeuser = $this->getBaseFeUsersArray($pObj, $fromAjax, $params['row']['toctoc_commentsfeuser_feuser'], '', $conf);
		$usergenderexistsstr='';
		if (count($rowsfeuser)>0) {
			if (array_key_exists('gender', $rowsfeuser)) {
				$usergenderexistsstr=' fe_users.gender AS gender, ';
			}

		}
		if (!$fromAjax) {
			$this->build_AJAXImages($conf, $pObj, $usergenderexistsstr, $fromAjax);
		}
		$pictureuser = intval($params['row']['toctoc_commentsfeuser_feuser']);
		if (($pictureuser == 0 ) && ($params['row']['gender'] == 1)) {
			$pictureuser = 99999;

		}

		if ($commentid != 0) {
			$params['markers']['###IMAGE###'] = $this->getAJAXimage($pictureuser, $commentid, $conf, $params['row']['email']);

			//kill title and replace by commentusername
			$killtitlearr = explode('title="', $params['markers']['###IMAGE###']);
			if (count($killtitlearr) > 0) {
				$killtitlearr2 = explode('"', $killtitlearr[1]);
				$killtitlearr2[0] = $commentusername;
				$killtitlearr[1] = implode ('"', $killtitlearr2);
				$params['markers']['###IMAGE###'] = implode('title="', $killtitlearr);
			}

		}

		if (count($rowsfeuser) >= 1) {
			//foreach($rowsfeuser as $key) {
				$params['markers']['###USERNAME###'] = $rowsfeuser['username'];
				$params['markers']['###EMAILADR###'] = $rowsfeuser['email'];
				$params['markers']['###LOCADR###'] = $rowsfeuser['city'];
				$params['markers']['###WWWADR###'] = $rowsfeuser['www'];
				//make a guess for the users first and lastname (and fullname if existing)
				if ($rowsfeuser['name'] != '') {
					$params['markers']['###FULLNAME###'] = $rowsfeuser['name'];
					$namePartsArr=explode(' ', $rowsfeuser['name']);
					$countNameParts = count($namePartsArr);
					if ($countNameParts>1) {
						$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
						$params['markers']['###LASTNAME###'] = trim($namePartsArr[$countNameParts-1]);
						$params['markers']['###FIRSTNAME###'] = trim(substr($rowsfeuser['name'], 0, strlen($rowsfeuser['name'])-strlen(trim($namePartsArr[$countNameParts-1]))));
					} else {
						$params['markers']['###LASTNAME###'] = trim(substr($rowsfeuser['name'], 1, 1000));
						$params['markers']['###FIRSTNAME###'] = trim(substr($rowsfeuser['name'], 0, 1)) . '.';
					}

				} elseif ($rowsfeuser['last_name'] != '') {
					// no fullname, so maybe a name
					$params['markers']['###FULLNAME###'] = $rowsfeuser['last_name'];
					$params['markers']['###LASTNAME###'] = $rowsfeuser['last_name'];
					$params['markers']['###FIRSTNAME###'] = trim(substr($rowsfeuser['last_name'], 0, 1)) . '.';

				} elseif ($rowsfeuser['first_name'] != '') {
					// no fullname, no last_name, so maybe a first_name?
					$params['markers']['###FULLNAME###'] = $rowsfeuser['first_name'];
					$params['markers']['###FIRSTNAME###'] = $rowsfeuser['first_name'];
					$params['markers']['###LASTNAME###'] = $rowsfeuser['first_name'];
				}

				//now overwrite the guess if data is actually here'
				if ($rowsfeuser['first_name']!='') {
					$params['markers']['###FIRSTNAME###'] = $rowsfeuser['first_name'];
				}

				if ($rowsfeuser['last_name']!='') {
					$params['markers']['###LASTNAME###'] = $rowsfeuser['last_name'];
				}

			//}

			//Markers like '###FEUSER_IMAGE###'
			if ($commentid != 0) {

				if (array_key_exists('username', $rowsfeuser)) {

					foreach($rowsfeuser as $key=>$value) {

						$params['markers']['###FEUSER_' . strtoupper($key) . '###'] = $this->applyStdWrap($value, 'feuser_' . $key .
								'_stdWrap', $conf);
					}
				}

			}

		}
		return $params['markers'];
	}



	/**
	 * converts leading spaces to &nbsp; for an number of $this->numberOfLeadingBlanksToReplace spaces
	 *
	 * @param	[type]		$text: ...
	 * @return	string
	 */
	protected function addleadingspace($text) {

		for ($i = $this->numberOfLeadingBlanksToReplace; $i>0; $i=$i-1) {
			$blanks='';
			$nsbps='';
			for($j = 0; $j < $i; $j++) {
				$blanks .= ' ';
				$nsbps .= '&nbsp;';
			}

			$textnew = str_replace( "\n" . $blanks . '', "\n" . $nsbps . '', $text);
			if ($textnew ==$text) {
				$textnew = str_replace( "\r" . $blanks . '', "\r" . $nsbps . '', $text);
			}

			$text = $textnew;

		}

		return $text;
	}

	/**
	 * Checks ownership of comments made on fe_users (community-feature)
	 *
	 * @param	string		$rowexternal_ref: external ref to check
	 * @param	int		$feuserid: uid to check against $rowexternal_ref
	 * @return	boolean		TRUE if owned
	 */
	protected function check_comment_ownership ($rowexternal_ref, $feuserid) {
		//are we community on profile?
		if (substr($rowexternal_ref, 0, 8)=='fe_users') {
			//yes we do
			$uidowner=intval(trim(substr($rowexternal_ref, 9, 100)));
			if ($feuserid==$uidowner) {
				// the comment is owned by current user
				return TRUE;
			}

		}

		return FALSE;
	}

	/**
	 * Gemnerates coment preview, call by AJAX - adds smilies, bbs etc
	 *
	 * @param	array		$data: data array containing text for preview
	 * @param	array		$conf: ...
	 * @param	[type]		$conf: ...
	 * @return	string		preview to display
	 */
	public function previewcomment($data, $pObj, $conf) {
		$text=base64_decode($data['content']);
		//Parse for Links and Smilies and BB-codes
		$this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() .
				t3lib_extMgm::siteRelPath('toctoc_comments'), $conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);

		$text = $this->applyStdWrap(nl2br($this->createLinks($text, $conf)), 'content_stdWrap', $conf);
		$text = $this->replaceSmilies($text, $conf);
		$text = $this->replaceBBs($text, $pObj, $conf, FALSE);
		$text = $this->makeemoji($text, $conf, 'previewcomment');

		$text = $this->addleadingspace($text);
		return $text;
	}

	/**
	 * functions for images cache (AJAX)
	 *
	 *
	 */

	/**
	 * Feed the array with userimages
	 *
	 * @param	string		$image: image link
	 * @param	int		$feuserid: userid
	 * @return	void
	 */
	protected function setAJAXimage($image, $feuserid) {
		$this->AJAXimages[$feuserid] = $image;
	}

	/**
	 * Searches images in the array for images
	 *
	 * @param	int		$feuserid: userid
	 * @param	int		$commentid: uid of the comment
	 * @param	[type]		$conf: ...
	 * @param	[type]		$email: ...
	 * @return	string		HTML for the image in the commentslist
	 */
	public function getAJAXimage($feuserid, $commentid, $conf, $email = '') {
		if ($this->AJAXimages[$feuserid]) {
			$tmpint=$this->AJAXimages[$feuserid];

			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpintuid = t3lib_div::testInt($tmpint);
			} else {
				$tmpintuid = t3lib_utility_Math::canBeInterpretedAsInteger($tmpint);
			}

			if (!$tmpintuid) {
				$imageout = $this->AJAXimages[$feuserid];
			} else {
				$imageout = $this->AJAXimages[$tmpint];
			}

			$newstr='tx-tc-cts-img-' . $commentid;
			$oldstr='tx-tc-cts-img-';
			$outstr= str_replace($oldstr, $newstr, $imageout);
			if (($conf['advanced.']['gravatarEnable'] == 1) && ($email != '')) {
				$outstr = $this->gravatarize($conf, $outstr, $email);
			}
			if ((($feuserid == 0) || ($feuserid == 99999)) && ($conf['advanced.']['gravatarEnable'] == 1) && ($email != '')) {
				if ($this->gravatarimages[$email]) {
					$outstr = $this->gravatarimages[$email];
				}
			}

			return $outstr;
		} else {
			if ($_SESSION['userAJAXimage'] == '') {
				// new user signed up
				if ($feuserid != 0) {
					$userpic = str_replace('id="tx-tc-uimg-"', 'id="tx-tc-uimg-'.$commentid.'"', $_SESSION['AJAXimages'][0]);
					$_SESSION['userAJAXimage'] = $userpic;
					$_SESSION['AJAXimages'][$feuserid] = $_SESSION['userAJAXimage'];
					$userconfimgFile = 'EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile.png';
					$userimgFile = $GLOBALS['TSFE']->absRefPrefix  .$userconfimgFile;
					$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName . $userimgFile;
					$userimgFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$userimgFile = str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$this->setAJAXimageCache($_SESSION['userAJAXimage'], $userimgFile);
					$this->AJAXimages[$feuserid] = $_SESSION['AJAXimages'][0];
				}
			}
			
			if ((($feuserid == 0) || ($feuserid == 99999)) && ($conf['advanced.']['gravatarEnable'] == 1) && ($email != '')) {
				$outstr = $_SESSION['userAJAXimage'];
				//$outstr = $this->gravatarize ($conf, $outstr, $email);
				if ($this->gravatarimages[$email]) {
					$outstr = $this->gravatarimages[$email];
				}

				$_SESSION['userAJAXimage'] = $outstr;
				return $outstr;

			} else {
				return $_SESSION['userAJAXimage'];
			}
		}

	}

	/**
	 * Set images into the cache-array for images
	 *
	 * @param	string		$image: image link
	 * @param	string		$imageoriginal: link to original image (not in cache)
	 * @param	int		$feuserid: userid
	 * @return	void
	 */
	protected function setAJAXimageCache($image, $imageoriginal) {
		$this->AJAXimagesCache[$imageoriginal] = $image;
	}

	/**
	 * Searches images in the cache-array for images
	 *
	 * @param	int		$commentuserimageout: userid
	 * @return	string		link for image
	 */
	protected function getAJAXimageCache($commentuserimageout) {
		if ($this->AJAXimagesCache[$commentuserimageout]) {
			return $this->AJAXimagesCache[$commentuserimageout];
		} else {
			return '';
		}

	}
	/**
	 * Checks that the userpic has the cid needed in its id.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	boolean		TRUE, if $this->externalUid is ok
	 */
	protected function checkAjaxUserPic ($cid=0) {

		$userAJAXimag=$_SESSION['userAJAXimage'];
		$userAJAXimag=str_replace('tx-tc-cts-img-c', 'tx-tc-uimg-', $userAJAXimag);
		$userAJAXimag=str_replace('tx-tc-cts-img-', 'tx-tc-uimg-', $userAJAXimag);
		$userAJAXimagarr=explode('6g9', $userAJAXimag);
		if (count($userAJAXimagarr)>0) {
			$userAJAXimag=$userAJAXimagarr[0] . $userAJAXimagarr[2];
		}

		$userAJAXimagarr=explode('tx-tc-uimg', $userAJAXimag);
		$userAJAXimagarr2=explode('"', $userAJAXimagarr[1]);
		if ($cid > 0) {
			$userAJAXimagarr2[0]='-' . $cid;
		} elseif (intval($_SESSION['submittedCid']) > 0) {
			$userAJAXimagarr2[0]='-' . $_SESSION['submittedCid'];
		} else {
			$userAJAXimagarr2[0]='-';
		}
		$userAJAXimagarr[1]=implode('"', $userAJAXimagarr2);
		$userAJAXimag=implode('tx-tc-uimg', $userAJAXimagarr);
		$_SESSION['userAJAXimage']=$userAJAXimag;
	}
	/**
	 * Creates a cached structure holding the userpictures
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$usergenderexistsstr: ...
	 * @param	[type]		$fromAjax: ...
	 * @return	[type]		...
	 */
	protected function build_AJAXImages($conf, $pObj, $usergenderexistsstr = '', $fromAjax = FALSE) {

		if (isset($this->AJAXimages) == FALSE) {
			$this->AJAXimages = array();
		}

		if (isset($_SESSION['AJAXimages']) == FALSE) {
			$_SESSION['AJAXimages'] = array();
		}

		if (isset($_SESSION['gravatarimages']) == FALSE) {
			$_SESSION['gravatarimages'] = array();
		}

		if (isset($_SESSION['AJAXOrigimages']) == FALSE) {
			$_SESSION['AJAXOrigimages']  = array();
		}

		$cnt1 = count($this->AJAXimages);
		$cnt2 = count($_SESSION['AJAXimages']);
		$keyimageuid = 0;
		$this->trackdebug('0 build_AJAXImages-' . $cnt1 . '-' . $cnt2);
		if ($cnt1 == 0) {
			if ($cnt2 != 0) {
				$this->AJAXimages = $_SESSION['AJAXimages'];
				$this->gravatarimages = $_SESSION['gravatarimages'];
			} else {

				//build $this->AJAXimages
				$start_time_for_conversion = microtime();
				$imagefield='';
				if ($conf['advanced.']['FeUserDbField'] != 'image') {
					$imagefield='fe_users.' . $conf['advanced.']['FeUserDbField'] . ', ';
				}
				$this->trackdebug('0 SELECTgetRows build_AJAXImages' . $cnt1 . '-' . $cnt2);
				/* $rowsfeuserimages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('fe_users.uid AS uid, '. $usergenderexistsstr .' fe_users.image AS image, ' .
						$imagefield .'fe_users.lastlogin AS lastlogin, fe_users.is_online AS is_online, fe_users.last_name AS lastname, fe_users.email AS email,
				 			fe_users.username AS username, fe_users.first_name AS firstname, fe_users.name AS feusername',
						'fe_users,tx_toctoc_comments_feuser_mm',
						'fe_users.uid=tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser AND
				 			fe_users.deleted=0 AND tx_toctoc_comments_feuser_mm.deleted=0',
						'fe_users.uid, fe_users.image, fe_users.lastlogin, fe_users.is_online',
						'fe_users.lastlogin DESC');
 */				
 			$rowsfeuserimages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('fe_users.uid AS uid, '. $usergenderexistsstr .' fe_users.image AS image, ' .
						$imagefield .'fe_users.lastlogin AS lastlogin, fe_users.is_online AS is_online, fe_users.last_name AS lastname, fe_users.email AS email,
				 			fe_users.username AS username, fe_users.first_name AS firstname, fe_users.name AS feusername',
						'fe_users,tx_toctoc_comments_user',
						'CONCAT("0.0.0.0.", fe_users.uid)=tx_toctoc_comments_user.toctoc_comments_user AND
				 			fe_users.deleted=0 AND tx_toctoc_comments_user.deleted=0',
						'fe_users.uid, fe_users.image, fe_users.lastlogin, fe_users.is_online',
						'fe_users.lastlogin DESC');
				$this->trackdebug('0 SELECTgetRows build_AJAXImages' . $cnt1 . '-' . $cnt2);
				$userimagestylesize=$conf['UserImageSize'];
				$userimagestyle= ' tx-tc-uimgsize';
				$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];
				foreach($rowsfeuserimages as $keyimage) {
					$usernametitle=trim($keyimage['firstname'] . ' ' . $keyimage['lastname']);
					if ($usernametitle =='') {
						$usernametitle=trim($keyimage['feusername']);
					}

					if ($usernametitle =='') {
						$usernametitle=trim($keyimage['username']);
					}

					$youstr ='';
					if (intval($GLOBALS['TSFE']->fe_user->user['uid']) != 0) {
						if (intval($keyimage['uid'])==intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
							$youstr = ' (' . $this->pi_getLLWrap($pObj, 'pi1_template.fe_users.you', $fromAjax);
						}

					}

					$fuenfMin = 5*60+1; // 5 Min, 1 sek.
					$vorFuenfMin = time()-$fuenfMin;
					$is_online=0;

					if ($this->isUserOnline(intval($keyimage['uid']))==TRUE) {
						$is_online=1;
					}

					if (($is_online==1) && (intval($keyimage['uid'])!=intval($GLOBALS['TSFE']->fe_user->user['uid']))) {
						if ($youstr=='') {
							$youstr = ' (' . $this->pi_getLLWrap($pObj, 'pi1_template.fe_users.isonline', $fromAjax) . ')';
						} else {
							$youstr .= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.fe_users.isonline', $fromAjax) . ')';
						}

					} else {
						if ($youstr != '') {
							$youstr .= ')';
						}

					}

					$usernametitle .= $youstr;
					$classonline = '';
					if ($is_online == 1) {
						$classonline = ' tx-tc-online';
					}

					$keyFeUserDbField = $this->fixFeUserPic(trim($keyimage[$conf['advanced.']['FeUserDbField']]));
					$femp = '';
					if ($usergenderexistsstr != '') {
						if (intval($keyimage['gender']) == 1) {
							$femp = 'f';
						}

					}

					$userconfimgFile = 'EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile' . $femp . '.png';
					$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
					$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
					$userimgFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$userimgFile = str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$dosessanonympic = FALSE;
					if (strval(trim($keyFeUserDbField)) != '') {
						$userimagesarr = explode(',', $keyFeUserDbField);
						if (count($userimagesarr)>0) {
							$commentuserimageout = $commentuserimagepath . $userimagesarr[0];
						} else {
							$commentuserimageout = $commentuserimagepath . $keyFeUserDbField;
						}

					} else {
						$commentuserimageout = $userimgFile;
						$dosessanonympic = TRUE;
					}

					$tmpimgstr ='';
					$tmpimgfeuser = $keyimage['uid'];
					$tmpimgstr = $this->getAJAXimageCache($commentuserimageout);
					if ($dosessanonympic) {
						if ($tmpimgstr != '') {
							if ($femp != 'f') {
								$_SESSION['userpicm'] = $tmpimgstr;
							} else {
								$_SESSION['userpicf'] = $tmpimgstr;
							}
						}
					}

					$profileimgclass='tx-tc-userpic' . $femp;

					if ($tmpimgstr == '') {
						$tmpimgstr = $this->gifbuild($conf, $pObj, $conf['advanced.']['gravatarEnable'], $commentuserimageout,
								$this->userimagesize,
								$profileimgclass, $classonline, $userimagestyle, $usernametitle, $keyimage['email'], 'tx-tc-cts-img-', FALSE, '', $dosessanonympic);

						if ($dosessanonympic) {
							if ($tmpimgstr != '') {
								if ($femp != 'f') {
									$_SESSION['userpicm'] = $tmpimgstr;
								} else {
									$_SESSION['userpicf'] = $tmpimgstr;
								}
							}
						}

						$this->setAJAXimage($tmpimgstr, $keyimage['uid']);
						$this->setAJAXimageCache($tmpimgstr, $commentuserimageout);
					} else {
						$this->setAJAXimage($tmpimgstr, $keyimage['uid']);
					}

					if ($keyimage['uid'] == intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
							if (!isset($_SESSION['userAJAXimage'])) {
								$_SESSION['AJAXUserimagerefresh'] = TRUE;
								$_SESSION['userAJAXimage']='';
							}

							if ($_SESSION['userAJAXimage'] == '') {
								$_SESSION['AJAXUserimagerefresh'] = TRUE;
							}
							if ($_SESSION['AJAXUserimagerefresh'] == TRUE) {
								$_SESSION['AJAXUserimagerefreshImage'] = $keyimage['image'];
								$keyimageuid = $keyimage['uid'];
							}
					}

				}
				$youstr ='';
				for ($n=0; $n<2; $n++) {
					if ($n==0) {
						$femp='';
						$userindex=0;

					} else {
						$femp='f';
						$userindex=99999;
					}

					$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile' . $femp . '.png';
					$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
					$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
					$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);

					$tmpimgstr ='';
					$tmpimgstr = $this->getAJAXimageCache($userimgFile);

					$profileimgclass='tx-tc-userpic' . $femp;
					if ($tmpimgstr==='') {
						$tmpimgstr = $this->gifbuild($conf, $pObj, 0, $userimgFile, $this->userimagesize, $profileimgclass, $classonline, $userimagestyle, '', '', 'tx-tc-cts-img-', TRUE);
						$this->setAJAXimageCache($tmpimgstr, $userimgFile);
					}

					$this->setAJAXimage($tmpimgstr, $userindex);
				}

				$_SESSION['AJAXimages'] = $this->AJAXimages;
				$_SESSION['gravatarimages'] = $this->gravatarimages;
				$_SESSION['AJAXOrigimages'] = $this->AJAXimagesCache;
				$_SESSION['AJAXimagesTimeStamp'] = microtime(TRUE);
				if (intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
					$currfeuserid=intval($GLOBALS['TSFE']->fe_user->user['uid']);

					if ($_SESSION['AJAXUserimagerefresh'] == TRUE) {
						$_SESSION['AJAXUserimagerefresh'] = FALSE;
						$_SESSION['userAJAXimage'] = $_SESSION['AJAXimages'][$currfeuserid];
						$this->AJAXimages[$currfeuserid] = $_SESSION['AJAXimages'][$currfeuserid];
						$this->setAJAXimageCache($_SESSION['userAJAXimage'], $_SESSION['AJAXUserimagerefreshImage']);
					}

				}

			}

		}
		
		$this->trackdebug('0 build_AJAXImages-' . $cnt1 . '-' . $cnt2);

	}
	/**
	 * Brings first Pic from the user pic field in fe_users.
	 *
	 * @param	string		$pic	Sttring from DB
	 * @return	string		$pic prepared for add in URL
	 */
	protected function fixFeUserPic ($pic) {
		$picout=$pic;
		$picarr=explode(',', $pic);
		if ($pic !='') {
			if (is_array($picarr)) {
				$picout=$picarr[0];
			} else {
				$picout=$pic;
			}

		}
		$retstr = '';
		if ($picout !='') {
			$retstr = rawurlencode ($picout);
		}
		return $retstr;

	}
	/**
	 * make HTML with images to be preloaded.
	 *
	 * @param	array		$conf
	 * @return	string		string to be inserted in comments part at the top, containing 0 sized images that possibly will be used in the plugin part.
	 */
	protected function makeImageSprite($conf) {
		//we fill and check session.themename.emojistyle.smilieyesno.sprites() and add only new pics to the string containing the images
		//we read directories only once per session and fill session.directory.images, subsequent scans target the session array.
		$imageSprite='';
		$emojispan='';
		$imageSpriteTemplate= '<img src="###IMAGE###" width=0 height=0>';
		$imageSpriteArr=array();
		// emojis if useEmoji and then the emoji style. used only if not rating_only mode
		if (!isset($_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']])) {
			$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]=array();
		}

		if (!isset($_SESSION[$_SESSION['commentsPageId']][preloadimages])) {
			$_SESSION[$_SESSION['commentsPageId']][preloadimages]=array();
		}

		if ($conf['advanced.']['useEmoji']>0) {
			if (intval($conf['ratings.']['ratingsOnly'])==0) {
				$emojispan='<span class="moji moji1f43b ud83d-udc3b tx-tx-w0h0"></span>';
				if (!isset($_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'])) {
					if ($conf['advanced.']['useEmoji']==1) {
						$emojipic=$this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji16.png';
					} elseif ($conf['advanced.']['useEmoji']==2) {
						$emojipic=$this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji20.png';
					} elseif ($conf['advanced.']['useEmoji']==3) {
						$emojipic=$this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji26.png';
					} elseif ($conf['advanced.']['useEmoji']==4) {
						$emojipic=$this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/emoji33.png';
					}

					$emojipath=$this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments') .'res/css/emoji/';
					$i=0;
					$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i]=$emojipic;
					$i++;
					$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i]=$emojipath . 'edot1.png';
					$i++;
					$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i]=$emojipath . 'edot0.png';
					$i++;
					for ($j=0; $j<6; $j++) {
						$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i]=$emojipath . 'epage'. $j . '-0.png';
						$i++;
						$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i]=$emojipath . 'epage'. $j . '-1.png';
						$i++;
						$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i]=$emojipath . 'epage'. $j . '-2.png';
						$i++;
					}

				}

				$p=count($_SESSION[$_SESSION['commentsPageId']][preloadimages]);
				$cntsess=count($_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji']);
				for ($i=0; $i<$cntsess; $i++) {
					if ((in_array($_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i],
							$_SESSION[$_SESSION['commentsPageId']][preloadimages])) == FALSE) {
						$_SESSION[$_SESSION['commentsPageId'][preloadimages]][$p] =
						$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i];
						$p++;
						$imageSprite .= str_replace('###IMAGE###',
								$_SESSION[$conf['theme.']['selectedTheme']][$conf['advanced.']['useEmoji']]['emoji'][$i], $imageSpriteTemplate);
					}

				}

			}

		}

		// smilies if smilies present used only if not rating_only mode
		$p=count($_SESSION[$_SESSION['commentsPageId']][preloadimages]);

		if (count($conf['smilies.'])>0) {
			if (intval($conf['ratings.']['ratingsOnly'])==0) {
				if (count($this->smilies)==0) {
					$this->smilies = $this->parseSmilieArray($conf['smilies.']);
				}

				$lastsmilesprite='';
				foreach ($this->smilies as $path => $smilieArray) {
					foreach ($smilieArray as $smilie) {
						$image = $this->smiliesPath . '/' . $path . '.' . $conf['fileExt'];
						if ((in_array($image, $_SESSION[$_SESSION['commentsPageId']][preloadimages])) == FALSE) {
							$_SESSION[$_SESSION['commentsPageId'][preloadimages]][$p] = $image;
							$p++;
							$smilesprite=str_replace('###IMAGE###', $image, $imageSpriteTemplate);
							if ($smilesprite!=$lastsmilesprite) {
								$lastsmilesprite=$smilesprite;

							} else {
								$smilesprite='';
							}

							$imageSprite .= $smilesprite;
						}

					}

				}

			}

		}

		// read theme imgs get all images of the theme and add them to the preload, filter with rating_only mode, login pics
		$themepath=$this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/';
		if (!isset($_SESSION[$conf['theme.']['selectedTheme']]['pics'])) {
			$i=0;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'idislike.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'ilike.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'idislikemaybe.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'ilikemaybe.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'toctoc_comments_myrating_star.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'toctoc_comments_myreview_star.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'toctoc_comments_rating_stars.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'toctoc_comments_review_stars.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'ucstats.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'uccontact.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'ucip.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'rclogos.jpg';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'rcrefresh.jpg';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'refresh.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'workingslides.gif';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'tcexpand.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'tccollapse.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'savecomment.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'ceditcommentfe.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'play_vid.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'white90.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'black.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'tiparrow.png';
			$i++;
			$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'popularitystar.png';
			$i++;
			if (intval($conf['advanced.']['useEmoji'])>0) {
				$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'tipemo.png';
				$i++;
				$_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i]=$themepath.'emojiselector.png';
				$i++;
			}

		}

		$p=count($_SESSION[$_SESSION['commentsPageId']][preloadimages]);
		$cntsess=count($_SESSION[$conf['theme.']['selectedTheme']]['pics']);
		for ($i=0; $i<$cntsess; $i++) {
			if ((in_array($_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i], $_SESSION[$_SESSION['commentsPageId']][preloadimages]))==FALSE) {
				$_SESSION[$_SESSION['commentsPageId'][preloadimages]][$p] = $_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i];
				$p++;
				$imageSprite .= str_replace('###IMAGE###', $_SESSION[$conf['theme.']['selectedTheme']]['pics'][$i], $imageSpriteTemplate);
			}

		}

		if ($imageSprite=='') {
			return '';
		} else {
			return '<div class="tx-tc-imagesprite">' . $imageSprite . $emojispan . '</div>';
		}

	}

	/**
	 * Form functions
	 *
	 *
	 */

	/**
	 * Returns form to add a comment.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$pid: pageid
	 * @param	int		$ifeuserid: userid
	 * @param	string		$userpic: Picture of the user as link
	 * @param	int		$commentid: ...
	 * @param	int		$replylevel: ...
	 * @param	boolean		$fromcomments: ...
	 * @return	string		Formatted form
	 */
	private function form($conf, &$pObj, $piVars, $fromAjax, $pid, $ifeuserid=0, $userpic, $commentid=0, $replylevel=0,	$fromcomments = FALSE) {

		$cid = $_SESSION['submittedCid'];

		if (!$fromAjax) {
			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENT_FORM###');
		} else {

			if ($fromcomments) {
				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENT_FORM###');
			} else {
				$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###COMMENT_FORMAJAX###');
			}

		}

		$externalbegin=substr($this->externalref, 0, 5);
		if (($this->externalref != '') && ($externalbegin != 'pages')) {
			if ($this->ajaxextref != '') {
				//ajaxextref: needed to build correct js calls for toctoc_comments_submit
				// it's token from pi and filled if its not a tt_content record
				$externalref = $this->ajaxextref;
			} else {
				$externalref = $this->externalref;
			}

		} else {
			if ($this->ajaxextref != '') {
				$externalref = $this->ajaxextref;
			} else {
				$externalref = 'tt_content_' . $_SESSION['commentListCount'];
			}

		}

		$actionLink = $_SESSION['commentsPageIdsClean'][$pid];

		if (($commentid!=0) && ($conf['advanced.']['replyModeInline']==1)) {
			//replyform
			$externalref=$externalref . '6g9' . $commentid . '6g9';
		}

		$txtentercomment=$this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax);
		if (($conf['advanced.']['commentReview']==1) && ($fromcomments==FALSE)) {
			$txtentercomment=$this->pi_getLLWrap($pObj, 'pi1_template.add_review', $fromAjax);
		}

		$output_cid=htmlspecialchars($_SESSION['commentListCount']);
		if (($commentid!=0) && ($conf['advanced.']['replyModeInline']==1)) {
			//replyform
			$output_cid=$output_cid . '6g9' . $commentid . '6g9';
			$txtentercomment=$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax) . '...';
		}

		$requiredFields = t3lib_div::trimExplode(',', $conf['requiredFields'], TRUE);
		If (trim($conf['requiredMark']) == '') {
			$conf['requiredMark'] = '*';
		}
		$requiredMark = $conf['requiredMark'];

		if (!$fromAjax) {
			if (intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				$feuserid=intval(intval($GLOBALS['TSFE']->fe_user->user['uid']));
			} else {
				$feuserid=0;
			}

		} else {
			$feuserid=$ifeuserid;
		}

		$formReviewStyle = '';
		$reviewMessage = '';
		$reviewaction = '';
		if ((intval($fromcomments) == 0) && ($conf['advanced.']['commentReview'] == 1)) {
			$formReviewStyle = ' tx-tc-nodisp tx-tc-reviewform';
			if ($this->isVoted($externalref, $pObj, 0, $feuserid, $fromAjax) == TRUE) {
				if ($this->isCommented($externalref, $pObj, $feuserid, $fromAjax) == 0) {
					$formReviewStyle = ' tx-tc-reviewform';
					$reviewMessage = $this->pi_getLLWrap($pObj, 'pi1_template.makereviewtocomplete', $fromAjax);
					//'Please leave a review to complete your recension';
				} else {
					if (($conf['advanced.']['loginRequired'] == 1) && ($feuserid == 0)) {
						$reviewMessage = $this->pi_getLLWrap($pObj, 'pi1_template.pleaseloginforreview', $fromAjax);
						$formReviewStyle = ' tx-tc-reviewform';
					} else {
						$reviewaction = '<span class="tx-tc-nodisp">tx-tc-reviewhideform</span>';
					}
				}
			} else {
				$formReviewStyle = ' tx-tc-reviewform';
				$reviewMessage = $this->pi_getLLWrap($pObj, 'pi1_template.voteandmakereviewtocomplete', $fromAjax);
				//'Please make your vote and leave a review to complete your recension';
			}
			if ($reviewMessage != '') {
				$reviewMessage = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###FORM_TOP_MESSAGE###'),
						array(
								'###MESSAGE###' => $reviewMessage,
								'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
								'###CID###' => $externalref,
								'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
						)
				);
			}

		}
		$this->trackdebug('form_updatePostVarsWithFeUserData');
		if ($feuserid>0) {

			if ($userpic=='') {
				if ($fromAjax) {
					$userpic=$this->getAJAXimage($feuserid, $output_cid, $conf, $_SESSION['submitCommentVars'][$cid]['email']);
					if ($userpic=='') {
						if (intval($_SESSION['submitCommentVars'][$cid]['gender']) == 0) {
							$userpic=$this->getAJAXimage(0, $output_cid, $conf, $_SESSION['submitCommentVars'][$cid]['email']);

						} else {
							$userpic=$this->getAJAXimage(99999, $output_cid, $conf, $_SESSION['submitCommentVars'][$cid]['email']);

						}
						$this->setAJAXimage($userpic, $feuserid);
						$this->setAJAXimageCache($userpic, $commentuserimageout);
					}

				}
			} else {
				if (str_replace('"tx-tc-cts-img-"', '', $userpic) != $userpic) {
					$userpic = str_replace('"tx-tc-cts-img-"', '"tx-tc-cts-img-' . $output_cid . '"', $userpic);
				}
			}
			$userpic = str_replace('class="tx-tc-userpic tx-tc-uimgsize"', 'class="tx-tc-margin0 tx-tc-nodisp"', $userpic);
			$userpic = str_replace('class="tx-tc-userpicf tx-tc-uimgsize"', 'class="tx-tc-margin0 tx-tc-nodisp"', $userpic);

			$userpic = str_replace('class="tx-tc-userpic tx-tc-online tx-tc-uimgsize"',
					'class="tx-tc-margin0 tx-tc-nodisp" width="' .$this->userimagesize .'" height="' .$this->userimagesize .'" align="left"', $userpic);
			$userpic = str_replace('class="tx-tc-userpicf tx-tc-online tx-tc-uimgsize"',
					'class="tx-tc-margin0 tx-tc-nodisp" width="' .$this->userimagesize .'" height="' .$this->userimagesize .'" align="left"', $userpic);
			$userpic = str_replace('width="' .$this->userimagesize .'"', 'width="'.$conf['UserImageSize'].'"', $userpic);
			$userpic = str_replace('height="' .$this->userimagesize .'"', 'height="'.$conf['UserImageSize'].'"', $userpic);

		}
		$this->form_updatePostVarsWithFeUserData($pObj, $fromAjax, $conf, $piVars, $feuserid, $userpic, $cid, $output_cid);
		$this->trackdebug('form_updatePostVarsWithFeUserData');

		$itemUrl = $_SESSION['commentsPageIdsClean'][$pid];

		$userIntMarker = '<input type="hidden" name="typo3_user_int" value="1" />';
		$terrorarr=array();
		$trequiredarr=array();

		if ($output_cid == $cid) {
			$terrorarr['firstname'] = $this->form_wrapError('firstname', $pObj, $conf);
			if ($terrorarr['firstname'] !='') {
				$terrorarr['firstname']='<div class="tx-tc-ct-form-field">' . $terrorarr['firstname'] . '</div>';
			}

			$terrorarr['lastname'] = $this->form_wrapError('lastname', $pObj, $conf);
			if ($terrorarr['lastname'] !='') {
				$terrorarr['lastname']='<div class="tx-tc-ct-form-field">' . $terrorarr['lastname'] . '</div>';
			}

			$terrorarr['image'] = $this->form_wrapError('image', $pObj, $conf);
			if ($terrorarr['image'] !='') {
				$terrorarr['image']='<div class="tx-tc-ct-form-field">' . $terrorarr['image'] . '</div>';
			}

			$terrorarr['email'] = $this->form_wrapError('email', $pObj, $conf);
			if ($terrorarr['email'] !='') {
				$terrorarr['email']='<div class="tx-tc-ct-form-field">' . $terrorarr['email'] . '</div>';
			}

			$terrorarr['location'] = $this->form_wrapError('location', $pObj, $conf);
			if ($terrorarr['location'] !='') {
				$terrorarr['location']='<div class="tx-tc-ct-form-field">' . $terrorarr['location'] . '</div>';
			}

			$terrorarr['commenttitle'] = $this->form_wrapError('commenttitle', $pObj, $conf);
			if ($terrorarr['commenttitle'] !='') {
				$terrorarr['commenttitle']='<div class="tx-tc-ct-form-field">' . $terrorarr['commenttitle'] . '</div>';
			}

			$terrorarr['homepage'] = $this->form_wrapError('homepage', $pObj, $conf);
			if ($terrorarr['homepage'] !='') {
				$terrorarr['homepage']='<div class="tx-tc-ct-form-field">' . $terrorarr['homepage'] . '</div>';
			}

			$terrorarr['content'] = $this->form_wrapError('content', $pObj, $conf);
			if ($terrorarr['content'] !='') {
				$terrorarr['content']='<div class="tx-tc-ct-form-field">' . $terrorarr['content'] . '</div>';
			}

			$tERRCODE = (count($_SESSION['formValidationErrors']) == 0 ? '' : '1');
			$trequiredarr['firstname'] = in_array('firstname', $requiredFields) ? $requiredMark : '';
			$trequiredarr['lastname'] = $requiredMark;
			$trequiredarr['image'] = in_array('image', $requiredFields) ? $requiredMark : '';
			$trequiredarr['email'] = $requiredMark;
			$trequiredarr['location'] = in_array('location', $requiredFields) ? $requiredMark : '';
			$trequiredarr['commenttitle'] = in_array('commenttitle', $requiredFields) ? $requiredMark : '';
			$trequiredarr['homepage'] = in_array('homepage', $requiredFields) ? $requiredMark : '';
			$trequiredarr['content'] = '';
			if (((count($_SESSION['formValidationErrors']) == 0 ) && ($_SESSION['formTopMessage'] !='')) ||
					($_SESSION['formValidationErrors']['email'] == $this->pi_getLLWrap($pObj, 'error.invalid.useremail', $fromAjax))) {
				if (($_SESSION['formValidationErrors']['email'] == $this->pi_getLLWrap($pObj, 'error.invalid.useremail', $fromAjax))) {
					$_SESSION['formTopMessage']= '<div class="tx-tc-form-top-message"><p class="tx-tc-text">' . $_SESSION['formValidationErrors']['email'] .
					'</p></div>';
				}

				$tformTopMessage =$_SESSION['formTopMessage'];

			} else {
				$requiredFields = array_unique(t3lib_div::trimExplode(',', 'email, lastname,' . $conf['requiredFields'], TRUE));

				$errfound= 0;
				$errfields = '';
				foreach ($requiredFields as $field) {
					if ($_SESSION['formValidationErrors'][$field] == $this->pi_getLLWrap($pObj, 'error.required.field', $fromAjax)) {
						$errfound++;
						if ($errfound > 1) {
							$errfields .= ', ';
						}
						$errfields .= $field;
					}

				}

				if (($errfound > 0) && ($feuserid > 0)) {
					$_SESSION['formTopMessage']= '<div class="tx-tc-form-top-message"><p class="tx-tc-text">' .
					$this->pi_getLLWrap($pObj, 'error.required.fieldsadminshouldadd', $fromAjax) . ': ' . $errfields .
					'</p></div>';
					$tformTopMessage =$_SESSION['formTopMessage'];

				} else {
					$tformTopMessage = '';
				}
			}

			$jstext='<span class="tx-tc-setuserdata tx-tc-nodisp" id="tx-tc-setuserdata-' . trim($output_cid) . '"></span>';
			$jsval=$userIntMarker . (count($_SESSION['submitCommentVars']) == 0 ? $jstext : '');
		} else {
			$terrorarr['firstname'] = '';
			$terrorarr['lastname'] = '';
			$terrorarr['image'] = '';
			$terrorarr['email'] = '';
			$terrorarr['location'] = '';
			$terrorarr['commenttitle'] = '';
			$terrorarr['homepage'] = '';
			$terrorarr['content'] = '';
			$tERRCODE = '';
			$trequiredarr['firstname'] = in_array('firstname', $requiredFields) ? $requiredMark : '';
			$trequiredarr['lastname'] = $requiredMark;
			$trequiredarr['image'] = in_array('image', $requiredFields) ? $requiredMark : '';
			$trequiredarr['email'] = $requiredMark;
			$trequiredarr['location'] = in_array('location', $requiredFields) ? $requiredMark : '';
			$trequiredarr['commenttitle'] = in_array('commenttitle', $requiredFields) ? $requiredMark : '';
			$trequiredarr['homepage'] = in_array('homepage', $requiredFields) ? $requiredMark : '';
			$trequiredarr['content'] = '';
			$tformTopMessage = '';
			$jsval = $userIntMarker . '<span class="tx-tc-setuserdata tx-tc-nodisp" id="tx-tc-setuserdata-' . trim($output_cid) . '"></span>';
		}

		$requiredhint='';
		if (count($requiredFields)>0) {
			$requiredhint='<div class="tx-tc-ct-form-reqhint"><span class="tx-tc-ct-reqhint">' . $requiredMark . ': ' .
			$this->pi_getLLWrap($pObj, 'pi1_template.required_field', $fromAjax) . '</span></div>';
		}

		$tempcaptcha='';
		$captchasession ='0';

		if ($cid == $output_cid) {
			$ctval = htmlspecialchars((count($_SESSION['formValidationErrors']) == 0 ? '' : $_SESSION['submitCommentVars'][$cid]['content']));
			if ($_SESSION['requestCapcha'][$cid] >= 1) {
				$ctval = htmlspecialchars($_SESSION['submitCommentVars'][$cid]['content']);
				$tERRCODE = '1';
				$captchaErrorMessage ='';
				$captchaType = $conf['spamProtect.']['useCaptcha'];
				if ($captchaType > 0) {
					if ($_SESSION['requestCapcha'][$cid] == 2) {
						$captchaErrorMessage = $this->form_wrapError('captcha', $pObj, $conf);
						$_SESSION['requestCapcha'][$cid] = 2;
					} else {
						if ($_SESSION['requestCapcha'][$cid] == 1) {
							$captchaErrorMessage = $this->pi_getLLWrap($pObj, 'pi1_template.captchaInputNeededErrMsg', $fromAjax);
							//captchaInputNeededErrMsg
							$_SESSION['requestCapcha'][$cid] = 2;
						} else {
							unset($_SESSION['requestCapcha'][$cid]);
						}

					}

				}

				$tempcaptcha = $this->form_getCaptcha($pObj, $conf, $fromAjax);
				$captchasession ='1';
			}

		} else {
			$ctval ='';
		}

		$tmpcid=$output_cid;
		$submithtml='';
		$ref='tt_content_' . $output_cid;
		$submitSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###ADD_COMMENT_LINK_SUB###');
		$ajaxData = $_SESSION['ajaxData'];

		$loggedon= 'false';
		if ($feuserid!= 0) {
			$loggedon= 'true';
		}

		$this->check='';
		$check = $this->getcheck($ref, '1', FALSE);

		$submithtmlSub =  $this->t3substituteMarkerArray($submitSub, array(
				'###LOGGEDON###' => $loggedon,
				'###VALUE###' => '1',
				'###REF###' => $ref,
				'###EXTREF###' => $externalref,
				'###PID###' => $pid,
				'###CID###' => $output_cid,
				'###CHECK###' => $check,
				'###CAPSESS###' => $captchasession,
				'###ERROR_CAPTCHA###' => $captchaErrorMessage,
				'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
		));
		$submithtml=$submithtmlSub;

		$subformhtml='';
		if ($feuserid == 0) {
			if (intval($conf['advanced.']['loginRequired'])==0) {
				$subformTemplate = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMIP###');
			} else {
				$subformTemplate = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORLOGINREQ###');
			}

		} else {
			$subformTemplate = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMUSER###');
		}

		$txtgender='';

		$this->trackdebug('form set DefaultUserImage');

		if (!$fromAjax) {
			$processimage=FALSE;
			if (!isset($_SESSION['DefaultUserImage'])) {
				$_SESSION['DefaultUserImage'] = array();
				$processimage=TRUE;

			} else {
				if (count($_SESSION['DefaultUserImage'])!=2) {
					$processimage=TRUE;
				}

			}

			if ($processimage==TRUE) {
				for ($i=0; $i<2; $i++) {

					if ($i == 0) {
						$userconfimgFile = 'EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile.png';
						$alttext = $this->pi_getLLWrap($pObj, 'pi1_template.usemaleavatar', $fromAjax);
						$profileimgclass = 'tx-tc-defuserpic tx-tc-defuserpic_m tx-tc-pointer tx-tc-opa1';
					} else {
						$userconfimgFile = 'EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profilef.png';
						$alttext = $this->pi_getLLWrap($pObj, 'pi1_template.usefemaleavatar', $fromAjax);
						$profileimgclass = 'tx-tc-defuserpic tx-tc-defuserpic_f tx-tc-pointer tx-tc-opa40';
					}

					$tmpimgstr = '';
					$userimgFile = $GLOBALS['TSFE']->absRefPrefix . $userconfimgFile;
					$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName . $userimgFile;
					$userimgFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$userimgFile = str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
					$commentuserimageout = $userimgFile;
					$tmpimgstr = $this->gifbuild($conf, $pObj, 0, $commentuserimageout, $this->userimagesize, $profileimgclass, '', '', $alttext, '',
							'tx-toctoc-comments-comments-img-gender-' . $i . '-placeholdercid', TRUE);
					$this->trackdebug('0 form set DefaultUserImage pObj->cObj->IMAGE(img)');
					if ($tmpimgstr != '') {
						$_SESSION['DefaultUserImage']['p' . $i] = $tmpimgstr;
					} else {
						$_SESSION['DefaultUserImage']['p' . $i] = '<img src="https://www.toctoc.ch/fileadmin/txtc/txtc-inf.gif" class="' . $profileimgclass .
								' ' . $opa . '" title="' . $alttext . '"' .
										' id="tx-toctoc-comments-comments-img-gender-' . $i . '-placeholdercid" />';
					}
				}

			}

		}

		$this->trackdebug('form set DefaultUserImage');

		$txtgender = $_SESSION['DefaultUserImage']['p0'] . '  ' . $_SESSION['DefaultUserImage']['p1'];
		$txtgender = str_replace('placeholdercid', $tmpcid, $txtgender);
		if (intval($_SESSION['submitCommentVars'][$cid]['gender']) == 1) {
			$txtgender = str_replace('tx-tc-opa1', 'dummyopa', $txtgender);
			$txtgender = str_replace('tx-tc-opa40', 'tx-tc-opa1', $txtgender);
			$txtgender = str_replace('dummyopa', 'tx-tc-opa40', $txtgender);
		}

		$commentminlength = intval($conf['minCommentLength']);
		$htmlsubpicupload = '';
		$dodisplaycss = TRUE;
		if (($conf['attachments.']['usePicUpload'] == 1) || ($conf['attachments.']['usePdfUpload'] == 1)) {

			$this->trackdebug('form SUBFORMPICUPLOAD');

			if ($fromAjax) {
				if ($conf['attachments.']['useWebpagePreview'] == 1) {
					if ($_SESSION['submitCommentVars'][$cid]['previewselpreviewid'] != 0) {
						$dodisplaycss = FALSE;
					}

				}

			}

			$htmlpicuploadSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMPICUPLOAD###');
			$firstmargin = $this->picuploadCSSmargin;
			$secondmargin = $this->pdfuploadCSSmargin;
			if ($conf['attachments.']['usePicUpload'] == 1) {
				$uploadpictext = '<img class="tx-tc-upload tx-tc-blockdisp ' . $firstmargin . '" align="left" src="' .
				$this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
				'/img/uploadpic.png" width="16" ';
				$uploadpictext .= 'height="16" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.imageuploadpic', $fromAjax) . '" />';
			} else {
				$uploadpictext = '';
				$secondmargin = $firstmargin;
			}

			if ($conf['attachments.']['usePdfUpload'] == 1) {
				$uploadpdftext = '<img class="tx-tc-upload tx-tc-blockdisp ' . $secondmargin . '" align="left" src="' .
				$this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
				'/img/uploadpdf.png" width="16" ';
				$uploadpdftext .= 'height="16" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.imageuploadpdf', $fromAjax) . '" />';
			} else {
				$uploadpdftext = '';
			}

			$fullfppath = '';
			$fppic = '';
			$displaycss = ' tx-tc-blockdisp';
			$descriptionbyuser = '';
			$originalfilename = '';
			$hidecss = ' tx-tc-nodisp';
			$fppicheight = '0';
			$fppicmargin = 0;
			$tippimageupload = '';
			$tippcancelupload = '';
			$adddescriptiontext = '';
			if (($fromAjax) && ($_SESSION['submitCommentVars'][$cid]['uploadpicid'] != '')) {
				$fppicmargin = 8;
				$displaycss = ' tx-tc-nodisp';
				$hidecss = '';
				$fppicheight = $_SESSION['submitCommentVars'][$cid]['uploadpicheight']+$fppicmargin;
				$fppic = $_SESSION['submitCommentVars'][$cid]['uploadpicid'];
				$arrext = explode('.', $_SESSION['submitCommentVars'][$cid]['originalfilename']);
				if (($_SESSION['submitCommentVars'][$cid]['uploadpicid'] == 'adobepdf.png')) {
					$fullfppath = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
					$conf['theme.']['selectedTheme'] . '/img/' . $_SESSION['submitCommentVars'][$cid]['uploadpicid'];

				} else {
					$fullfppath = $this->locationHeaderUrlsubDir() . $this->webpagepreviewtempfolder . $_SESSION['submitCommentVars'][$cid]['uploadpicid'];
				}

				if ($arrext[count($arrext)-1] == 'pdf') {
					$adddescriptiontext = $this->pi_getLLWrap($pObj, 'pi1_template.pdfdescribe', $fromAjax) . ' ' .
					$_SESSION['submitCommentVars'][$cid]['originalfilename'] . '';
					$tippcancelupload = $this->pi_getLLWrap($pObj, 'pi1_template.closepdfupload', $fromAjax);
					$tippimageupload = $_SESSION['submitCommentVars'][$cid]['originalfilename'];
				} else {
					$adddescriptiontext = $this->pi_getLLWrap($pObj, 'pi1_template.imagedescribe', $fromAjax) . ' ' .
					$_SESSION['submitCommentVars'][$cid]['originalfilename'];
					$tippcancelupload = $this->pi_getLLWrap($pObj, 'pi1_template.closeimageupload', $fromAjax);
					$tippimageupload = $this->pi_getLLWrap($pObj, 'pi1_template.tippimageupload', $fromAjax);
				}

				$descriptionbyuser = $_SESSION['submitCommentVars'][$cid]['descriptionbyuser'];
				$originalfilename = $_SESSION['submitCommentVars'][$cid]['originalfilename'];

			}

			if ($dodisplaycss == FALSE) {
				$displaycss = ' tx-tc-nodisp';
			}

			$uploadpictextweb = '<span class="tx-tc-uploadlink tx-tc-pointer" id="tx-tc-uploadlink-pic-' . $tmpcid . '">'. $uploadpictext .'</span>';
			$uploadpdftextweb = '<span class="tx-tc-uploadlink tx-tc-pointer" id="tx-tc-uploadlink-pdf-' . $tmpcid . '">'. $uploadpdftext .'</span>';
			$htmlsubpicupload =  $this->t3substituteMarkerArray($htmlpicuploadSub, array(
					'###OPENFILEDIALOG###' => $uploadpictextweb,
					'###OPENPDFFILEDIALOG###' => $uploadpdftextweb,
					'###CID###' => $tmpcid,
					'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###LANG###' => $_SESSION['activelang'],
					'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
					'###NAVICLOSEMGLEFT###' => 24,
					'###NAVICLOSEMGTOP###' => $conf['attachments.']['webpagePreviewHeight'] - 8,
					'###NAVICLOSEPADLEFT###' => $conf['attachments.']['webpagePreviewHeight']-38,
					'###TXTPREV###' => $this->pi_getLLWrap($pObj, 'pi1_template.previous', $fromAjax),
					'###TXTNEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.next', $fromAjax),
					'###TXTNOPREVIEWPIC###' => $this->pi_getLLWrap($pObj, 'pi1_template.nopreviewpics', $fromAjax),
					'###TXTCLSFUP###' => $tippcancelupload,
					'###TXTTIPPFUP###' => $tippimageupload,
					'###TXTLOADING###' => $this->pi_getLLWrap($pObj, 'pi1_template.loadingpreview', $fromAjax),
					'###UPLOADPICID###' => $fppic,
					'###UPLOADPICRELPATH###' => $fullfppath,
					'###CSSSHOW###' => $displaycss,
					'###CSSHIDE###' => $hidecss,
					'###TEXT_ADD_DESC###' => $adddescriptiontext,
					'###ENCTEXT_ADD_DESC###' => base64_encode($adddescriptiontext),
					'###UPLOADPICHEIGHT###' => $fppicheight,
					'###ORIGINALUPLOADFILENAME###' => $originalfilename,
					'###USERUPLOADDESCRIPTION###' => $descriptionbyuser,
					'###SELTHEME###' => $conf['theme.']['selectedTheme'],
			));
			$this->trackdebug('form SUBFORMPICUPLOAD');

		}

		$this->trackdebug('form SUBFORM');
		$cssstyleeye = 'tx-tc-ct-prv-icon';
		if ($loggedon == 'true') {
			$cssstyleeye = 'tx-tc-ct-prv-icon-login';
		}

		$prvcttext = '<div class="' . $cssstyleeye . '-dp" id="tx-tc-cts-prv-ct-dp-' . $tmpcid . '"><img id="prv-ct-' . $tmpcid . '" class="' .
					$cssstyleeye . ' tx-tc-nodisp" align="left" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') .
					'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/previewct.png" width="16" ';
		$prvcttext .= 'height="16" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.previewcomment', $fromAjax) . '" /></div>';

		$htmlprvcttextweb = '';
		$prvcommentHTML = '';
		if ($conf['advanced.']['allowCommentPreview'] == 1) {
			$htmlprvcttextweb ='<div class="tx-tc-prvcnt-data" id="tx-tc-prvcnt-data-' . $tmpcid . '">' . $prvcttext . '</div>';
			$prvcommentHTML = '<div class="tx-tc-ct-prv-frameover" id="tx-tc-cts-prv-ct-' . $tmpcid . '">';
			$prvcommentHTML .= '<div id="tx-tc-cts-div-ct-prv-' . $tmpcid . '"  class="tx-tc-prvcnt-data-off tx-tc-ct-prv tx-tc-nodisp">';
			$prvcommentHTML .= '<img id="tx-tc-cts-img-prv-ct-' . $tmpcid . '" src="' . $this->locationHeaderUrlsubDir() .
									t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
									'/img/nopreviewpic.png" height="11" width="12" title="' .
									$this->pi_getLLWrap($pObj, 'pi1_template.closecommentpreview', $fromAjax) .
									'" class="tx-tc-ct-prv tx-tc-pointer tx-tc-blockdisp" />';
			$prvcommentHTML .= '</div>';
			$prvcommentHTML .= '<div class="tx-tc-ct-prv-frame" id="tx-tc-cts-prv-content-' . $tmpcid . '">';
			$prvcommentHTML .= '</div></div>';
		}

		if ((intval($piVars['level']) != 0)) {
			$replylevel = intval($piVars['level']);
		}

		if (($conf['theme.']['boxmodelLevelIndent'] > 0) && ($conf['theme.']['boxmodelLevelIndent'] <4 )) {
			$scalebecauseofindent = ($conf['UserImageSize'] * ($replylevel / $conf['theme.']['boxmodelLevelIndent']));
		} else {
			$scalebecauseofindent = 0;
		}

		$labelwidth = ' tx-tc-ct-box-rlvl-' . $replylevel;
		$inputfieldsize = round(($conf['theme.']['boxmodelInputFieldSize'] - (35 / 238) * ($scalebecauseofindent)), 0);
		if ($inputfieldsize < 12) {
			$inputfieldsize = 12;
		}
		if ($conf['theme.']['boxmodelLabelInputPreserve']==1) {
			$inputfieldsize = '';
		}

		$loggedin = 0;
		if ($feuserid > 0) {
			$loggedin = 1;
		}

		$jssetparentcomment ='';
		if ($commentid != 0) {
			$jssetparentcomment = "previewselcomment['" . $output_cid . "'] = " . $commentid . ';';
		}

		$loggout = '';
		if ($conf['advanced.']['loginRequired'] == 1) {
			$loggoutlink = '<span class="tx-tc-loggout-data tx-tc-textlink" id="tx-tc-loggout-data-' . $tmpcid . '__0' . $externalref . '">'.
								$this->pi_getLLWrap($pObj, 'pi1_template.logout', $fromAjax) .
							'</span>';
			$loggout = '<div class="tx-tc-loggout">' . $this->pi_getLLWrap($pObj, 'pi1_template.loggedinas', $fromAjax) . ' '.
						htmlspecialchars(trim($_SESSION['submitCommentVars'][$cid]['firstname'] . ' ' . $_SESSION['submitCommentVars'][$cid]['lastname'])) .
						'<br />' . $loggoutlink . '</div><div id="tx-tc-loginlogoutinprogress-' . $tmpcid . '" class="tx-tc-nodisp">
<div class="tx-tc-loginlogoutinprogress">
</div>
</div>';
		}

		$tempcaptcha = str_replace('###CID###', $output_cid, $tempcaptcha);
		$labelsarr = array();
		$labelarr = array();
		$pcehldrarr = array();
		$jswmarr = array();
		$labelsarr['firstname'] = $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax);
		$labelsarr['lastname'] = $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax);
		$labelsarr['email'] = $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax);
		$labelsarr['homepage'] = $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax);
		$labelsarr['location'] = $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax);
		$labelsarr['commenttitle'] = $this->pi_getLLWrap($pObj, 'pi1_template.commenttitle', $fromAjax);
		if ($conf['advanced.']['watermarkFormFields'] == 1) {
			$labelarr['firstname'] = '';
			$labelarr['lastname'] = '';
			$labelarr['email'] = '';
			$labelarr['homepage'] = '';
			$labelarr['location'] = '';
			$labelarr['commenttitle'] = '';
			$labelsarr['firstname']=str_replace(':', '', $labelsarr['firstname']);
			$labelsarr['lastname']=str_replace(':', '', $labelsarr['lastname']);
			$labelsarr['email']=str_replace(':', '', $labelsarr['email']);
			$labelsarr['homepage']=str_replace(':', '', $labelsarr['homepage']);
			$labelsarr['location']=str_replace(':', '', $labelsarr['location']);
			$labelsarr['commenttitle']=str_replace(':', '', $labelsarr['commenttitle']);
			$pcehldrarr['firstname'] = 'placeholder="' . $labelsarr['firstname'].$trequiredarr['firstname'].'" ';
			$pcehldrarr['lastname'] = 'placeholder="' . $labelsarr['lastname'].$trequiredarr['lastname'].'" ';
			$pcehldrarr['email'] = 'placeholder="' . $labelsarr['email'].$trequiredarr['email'].'" ';
			$pcehldrarr['homepage'] = 'placeholder="' . $labelsarr['homepage'].$trequiredarr['homepage'].'" ';
			$pcehldrarr['location'] = 'placeholder="' . $labelsarr['location'].$trequiredarr['location'].'" ';
			$pcehldrarr['commenttitle'] = 'placeholder="' . $labelsarr['commenttitle'].$trequiredarr['commenttitle'].'" ';
			$jswmarr['firstname'] = '<span class="tx-tc-wtrmrk-formf tx-tc-nodisp" id="tx-tc-wtrmrk-formf-'.$output_cid.'__0firstname__0' .
			base64_encode($labelsarr['firstname'].$trequiredarr['firstname']).'"></span>';
			$jswmarr['lastname'] = '<span class="tx-tc-wtrmrk-formf tx-tc-nodisp" id="tx-tc-wtrmrk-formf-'.$output_cid.'__0lastname__0' .
			base64_encode($labelsarr['lastname'].$trequiredarr['lastname']).'"></span>';
			$jswmarr['email'] =  '<span class="tx-tc-wtrmrk-formf tx-tc-nodisp" id="tx-tc-wtrmrk-formf-'.$output_cid.'__0email__0' .
			base64_encode($labelsarr['email'].$trequiredarr['email']).'"></span>';
			$jswmarr['homepage'] =  '<span class="tx-tc-wtrmrk-formf tx-tc-nodisp" id="tx-tc-wtrmrk-formf-'.$output_cid.'__0homepage__0' .
			base64_encode($labelsarr['homepage'].$trequiredarr['homepage']).'"></span>';
			$jswmarr['location'] =  '<span class="tx-tc-wtrmrk-formf tx-tc-nodisp" id="tx-tc-wtrmrk-formf-'.$output_cid.'__0location__0' .
			base64_encode($labelsarr['location'].$trequiredarr['location']).'"></span>';
			$jswmarr['commenttitle'] =  '<span class="tx-tc-wtrmrk-formf tx-tc-nodisp" id="tx-tc-wtrmrk-formf-'.$output_cid.'__0commenttitle__0' .
			base64_encode($labelsarr['commenttitle']).'"></span>';
		} else {
			$labelarr['firstname'] = '<label class="tx-tc-ct-label tx-tc-ct-label-firstname'.$labelwidth.'" for="toctoc_comments_pi1_firstname">' .
			$labelsarr['firstname'].$trequiredarr['firstname'].'</label>';
			$labelarr['lastname'] = '<label class="tx-tc-ct-label tx-tc-ct-label-lastname'.$labelwidth.'" for="toctoc_comments_pi1_lastname">' .
			$labelsarr['lastname'].$trequiredarr['lastname'].'</label>';
			$labelarr['email'] = '<label class="tx-tc-ct-label tx-tc-ct-label-email'.$labelwidth.'" for="toctoc_comments_pi1_email">' .
			$labelsarr['email'].$trequiredarr['email'].'</label>';
			$labelarr['homepage'] = '<label class="tx-tc-ct-label tx-tc-ct-label-homepage'.$labelwidth.'" for="toctoc_comments_pi1_homepage">' .
			$labelsarr['homepage'].$trequiredarr['homepage'].'</label>';
			$labelarr['location'] = '<label class="tx-tc-ct-label tx-tc-ct-label-location'.$labelwidth.'" for="toctoc_comments_pi1_location">' .
			$labelsarr['location'].$trequiredarr['location'].'</label>';
			$labelarr['commenttitle'] = '<label class="tx-tc-ct-label tx-tc-ct-label-commenttitle'.$labelwidth.'" for="toctoc_comments_pi1_commenttitle">' .
			$labelsarr['commenttitle'].$trequiredarr['commenttitle'].'</label>';
			$pcehldrarr['firstname'] = '';
			$pcehldrarr['lastname'] = '';
			$pcehldrarr['email'] = '';
			$pcehldrarr['homepage'] = '';
			$pcehldrarr['location'] = '';
			$pcehldrarr['commenttitle'] = '';
			$jswmarr['firstname'] = '';
			$jswmarr['lastname'] = '';
			$jswmarr['email'] = '';
			$jswmarr['homepage'] = '';
			$jswmarr['location'] = '';
			$jswmarr['commenttitle'] = '';
		}
		$fieldstodispArr = explode(',', $conf['useFieldsSequence']);
		$fieldshtml = '';

		if ($feuserid == 0) {
			if (intval($conf['advanced.']['loginRequired'])==0) {
				$formFieldSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELD###');
				$formFieldwithGenderSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDGDR###');
				$formFieldSubct = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELD###');
			} else {
				$formFieldSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDHIDDEN###');
				$formFieldwithGenderSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDHIDDEN###');
				$formFieldSubct = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDHIDDEN###');
			}

		} else {
			$formFieldSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDHIDDEN###');
			$formFieldwithGenderSub = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDHIDDEN###');
			$formFieldSubct = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELD###');
		}

		$possiblefields = 'commenttitle,firstname,lastname,email,location,homepage';
		$possiblefieldsArr = explode(',', $possiblefields);
		$fieldstyle = '';
		$fieldstylegender = '';
		if ($conf['theme.']['boxmodelLabelInputPreserve']==0) {
			$inputfieldsizesml = $inputfieldsize - 8;
		} else {
			$inputfieldsizesml ='';
		}

		$confuseGenderWithField = trim($conf['useGenderWithField']);
		if ((trim($conf['useGenderWithField']) == '') || (strpos('firstname lastname email location homepage', $conf['useGenderWithField']) === FALSE)) {
			$fieldstylegender = ' tx-tc-nodisp';
			$inputfieldsizesml = $inputfieldsize;
			$confuseGenderWithField = 'lastname';
		}
		$fieldnumber=1;
		foreach($fieldstodispArr as $fieldtodisp) {
			$fieldtodisp = trim($fieldtodisp);
			$fieldpresent = FALSE;
			foreach($possiblefieldsArr as $possiblefield) {
				$fieldstyle = '';
				if ($possiblefield == $fieldtodisp) {
					$fieldpresent = TRUE;
					$formfieldcclasssmallwidthforgender='';
					if ($possiblefield == $confuseGenderWithField) {
						$formFieldTemplate = $formFieldwithGenderSub;
						if (($conf['theme.']['boxmodelLabelInputPreserve']==1)) {
							$formfieldcclasssmallwidthforgender= ' tx-tc-width100-85';
						}
					} else {
						$formFieldTemplate = $formFieldSub;
					}

					if ($possiblefield == 'commenttitle') {
						if ($feuserid != 0) {
							$formFieldTemplate = $formFieldSubct;
							$fieldstyle = ' tx-tc-hhalfbm';
						}

					}
					if (($conf['theme.']['boxmodelLabelInputPreserve']==1)) {
						$fieldstyleresp= ' tx-tc-winherit';
					} else {
						$fieldstyleresp= ' tx-tc-width100-85';
					}

					if (($fieldnumber==1) && ($conf['theme.']['boxmodelLabelInputPreserve']==1)) {
						if (($conf['attachments.']['usePicUpload']==1) || ($conf['attachments.']['usePdfUpload']==1)) {
							$fieldstyleresp =  ' tx-tc-width100-25';
						}
						if ($possiblefield == 'commenttitle') {
							if (($conf['attachments.']['usePicUpload']==1) || ($conf['attachments.']['usePdfUpload']==1)) {
								if ($feuserid != 0) {
									$fieldstyleresp =  ' tx-tc-width100-85';
								}
								if ($conf['advanced.']['watermarkFormFields']==1) {
									$fieldstyleresp =  ' tx-tc-width100-40';
								}
							}

						}
					}
					$fieldstyle=$fieldstyle . $fieldstyleresp;

					$fieldnumber++;
					if ($conf['theme.']['boxmodelLabelInputPreserve'] ==0 ) {
						$formfieldcclass = 'tx-tc-ct-input tx-tc-ct-input-' . $fieldtodisp;
					}else{
						$formfieldcclass = trim('' . $formfieldcclasssmallwidthforgender);
					}
					$tmphtml = $this->t3substituteMarkerArray($formFieldTemplate, array(
							'###FIELDSTYLE###' => $fieldstyle,
							'###FIELDSTYLEGENDER###' => $fieldstylegender,
							'###LABEL_FIELD_NAME###' => $labelarr[$fieldtodisp],
							'###PHDR_FIELD_NAME###' => $pcehldrarr[$fieldtodisp],
							'###WMJS_FIELD_NAME###' => $whjsarr[$fieldtodisp],
							'###FIELD_FORMNAME###' => $fieldtodisp,
							'###FIELD_FORMCLASS###' => $formfieldcclass,
							'###CID###' => $output_cid,
							'###FIELD_VALUE###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid][$fieldtodisp]),
							'###INPUTSIZE###' => $inputfieldsize,
							'###INPUTSIZESMALL###' => $inputfieldsizesml,
							'###TEXT_GENDER###' => $txtgender,
							'###GENDER###'=> htmlspecialchars($_SESSION['submitCommentVars'][$cid]['gender']),
							'###ERROR_FIELD_NAME###'=> $terrorarr[$fieldtodisp],
					));
					$fieldshtml .= $tmphtml;
				}

			}

		}
		foreach($possiblefieldsArr as $possiblefield) {
			$fieldpresent = FALSE;
			foreach($fieldstodispArr as $fieldtodisp) {
				$fieldtodisp=trim($fieldtodisp);
				if ($possiblefield == $fieldtodisp) {
					$fieldpresent = TRUE;
				}
			}
			if ($fieldpresent == FALSE) {
				$formFieldTemplate = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMFIELDHIDDEN###');
				if ($conf['theme.']['boxmodelLabelInputPreserve'] == 0) {
					$formfieldcclass = 'tx-tc-ct-input tx-tc-ct-input-' . $possiblefield;
				}else{
					$formfieldcclass = '';
				}
				$tmphtml = $this->t3substituteMarkerArray($formFieldTemplate, array(
						'###FIELD_FORMNAME###' => $possiblefield,
						'###FIELD_FORMCLASS###' => $formfieldcclass,
						'###CID##' => $output_cid,
						'###FIELD_VALUE###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid][$possiblefield]),
				));
				$fieldshtml .= $tmphtml;
			}

		}

		$htmlagbaccepted = '';
		if(intval($conf['advanced.']['acceptTermsCondsOnSubmit']) > 0) {
			$checked = '';
			if(intval($_COOKIE['toctoc_comments_pi1_tc']) ==1) {
				$checked = 'checked ';
			}
			$htmlagbaccepted = '<div class="tx-tc-termscondtext"><label class="tx-tc-ct-label-ntf" for="toctoc_comments_pi1[acceptterms]">'.
									sprintf($this->pi_getLLWrap($pObj, 'pi1_template.termscondstext', $fromAjax), $_SESSION['TermsCondspage']).'</label>';
			$htmlagbaccepted .= '<input type="checkbox" name="toctoc_comments_pi1[acceptterms]" title="' .
									$this->pi_getLLWrap($pObj, 'pi1_template.termscondstip', $fromAjax).
									'" ' .
					'class="tx-tc-ntf-check tx-tc-terms-check" ' . $checked . ' id="toctoc_comments_pi1_' . $output_cid . 'acceptterms" value="' . intval($_COOKIE['toctoc_comments_pi1_tc']) . '" />';
			$htmlagbaccepted .= '</div>';
		}

		$htmlcookieaccept = '';
		if(intval($conf['dataProtect.']['setCookie']) > 0) {

			if (($conf['theme.']['boxmodelLabelInputPreserve']==1)) {
				$fieldstyleresp= ' tx-tc-winherit';
			} else {
				$fieldstyleresp= ' tx-tc-width100-85';
			}
			$checked = '';
			if(intval($_COOKIE['toctoc_comments_pi1_dataProtect']) ==1) {
				$checked = 'checked ';
			}
			$htmlcookieaccept = '<div class="tx-tc-ct-form-text' . $fieldstyleresp . '"><label class="tx-tc-ct-label-ntf tx-tc-label-cookie" for="toctoc_comments_pi1[acceptcookie]">'.
									$this->pi_getLLWrap($pObj, 'pi1_template.acceptcookietext', $fromAjax).'</label>';
			$htmlcookieaccept .= '<input type="checkbox" name="toctoc_comments_pi1[acceptcookie]" title="' .
									$this->pi_getLLWrap($pObj, 'pi1_template.acceptcookietip', $fromAjax).
									'" ' .
					'class="tx-tc-ntf-check tx-tc-cookie-checker" ' . $checked . ' id="toctoc_comments_pi1_' . $output_cid . 'acceptcookie" value="' . intval($_COOKIE['toctoc_comments_pi1_dataProtect']) . '" />';
			$htmlcookieaccept .= '</div>';
		}

		$subformhtml =  $this->t3substituteMarkerArray($subformTemplate, array(
				'###CURRENT_URL_CHK###' => md5($itemUrl . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']),
				'###ACTION_URL###' => htmlspecialchars($actionLink),
				'###FIELDSHTML###' => $fieldshtml,
				'###GENDER###'=> htmlspecialchars($_SESSION['submitCommentVars'][$cid]['gender']),
				'###FIRSTNAME###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['firstname']),
				'###LASTNAME###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['lastname']),
				'###IMAGE###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['image']),
				'###EMAIL###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['email']),
				'###LOCATION###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['location']),
				'###HOMEPAGE###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['homepage']),
				'###CAPTCHA###' => $tempcaptcha,
				'###CONTENT###' => $ctval,
				'###CID###' => $output_cid,
				'###LOGOUT###' => $loggout,
				'###ERRCODE###' => $tERRCODE,
				'###ERROR_FIRSTNAME###' => $terrorarr['firstname'],
				'###ERROR_LASTNAME###' => $terrorarr['lastname'],
				'###ERROR_IMAGE###' => $terrorarr['image'],
				'###ERROR_EMAIL###' => $terrorarr['email'],
				'###ERROR_LOCATION###' => $terrorarr['location'],
				'###ERROR_HOMEPAGE###' => $terrorarr['homepage'],
				'###ERROR_CONTENT###' => $terrorarr['content'],
				'###REQUIRED_FIRSTNAME###' => $trequiredarr['firstname'],
				'###REQUIRED_LASTNAME###' => $trequiredarr['lastname'],
				'###REQUIRED_IMAGE###' => $trequiredarr['image'],
				'###REQUIRED_EMAIL###' => $trequiredarr['email'],
				'###REQUIRED_LOCATION###' => $trequiredarr['location'],
				'###REQUIRED_HOMEPAGE###' => $trequiredarr['homepage'],
				'###REQUIRED_CONTENT###' => $trequiredarr['content'],
				'###TEXT_ADD_COMMENT###' => $txtentercomment,
				'###ENCTEXT_ADD_COMMENT###' => base64_encode($txtentercomment),
				'###TEXT_REQUIRED_HINT###' => $requiredhint,
				'###TEXT_FIRST_NAME###' => $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax),
				'###TEXT_GENDER###' =>  $txtgender,
				'###TEXT_LAST_NAME###' => $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax),
				'###TEXT_IMAGE###' => $this->pi_getLLWrap($pObj, 'pi1_template.image', $fromAjax),
				'###TEXT_EMAIL###' => $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax),
				'###TEXT_WEB_SITE###' => $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax),
				'###TEXT_LOCATION###' => $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax),
				'###TEXT_CONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax),
				'###TEXT_SUBMIT###' => $this->pi_getLLWrap($pObj, 'pi1_template.submit', $fromAjax),
				'###TEXT_RESET###' => $this->pi_getLLWrap($pObj, 'pi1_template.reset', $fromAjax),
				'###SUBMITONCLICK###' => trim($submithtml),
				'###LABEL_FIRST_NAME###' => $labelarr['firstname'],
				'###LABEL_LAST_NAME###' => $labelarr['lastname'],
				'###LABEL_EMAIL###' => $labelarr['email'],
				'###LABEL_WEB_SITE###' => $labelarr['homepage'],
				'###LABEL_LOCATION###' => $labelarr['location'],
				'###PHDR_FIRST_NAME###' => $pcehldrarr['firstname'],
				'###PHDR_LAST_NAME###' => $pcehldrarr['lastname'],
				'###PHDR_EMAIL###' => $pcehldrarr['email'],
				'###PHDR_WEB_SITE###' => $pcehldrarr['homepage'],
				'###PHDR_LOCATION###' => $pcehldrarr['location'],
				'###WMJS_FIRST_NAME###' => $jswmarr['firstname'],
				'###WMJS_LAST_NAME###' => $jswmarr['lastname'],
				'###WMJS_EMAIL###' => $jswmarr['email'],
				'###WMJS_WEB_SITE###' => $jswmarr['homepage'],
				'###WMJS_LOCATION###' => $jswmarr['location'],
				'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###LANG###' => $_SESSION['activelang'],
				'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
				'###NAVICLOSEMGLEFT###' => 24,
				'###NAVICLOSEMGTOP###' => $conf['attachments.']['webpagePreviewHeight'] - 8,
				'###NAVICLOSEPADLEFT###' => $conf['attachments.']['webpagePreviewHeight']-38,
				'###TXTPREV###' => $this->pi_getLLWrap($pObj, 'pi1_template.previous', $fromAjax),
				'###TXTNEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.next', $fromAjax),
				'###TXTNOPREVIEWPIC###' => $this->pi_getLLWrap($pObj, 'pi1_template.nopreviewpics', $fromAjax),
				'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
				'###FORMPICUPLOAD###' => $htmlsubpicupload,
				'###PRVCT###'=> $htmlprvcttextweb,
				'###AGBACCEPTED###'=> $htmlagbaccepted,
				'###COOKIEACCEPT###'=> $htmlcookieaccept,
				'###INPUTSIZE###'=> $inputfieldsize,
				'###INPUTSIZESMALL###'=> $inputfieldsize - 8,
				'###SETPARENTCOMMENT####' => $jssetparentcomment,
				'###LEVEL###'=> $replylevel,
		));

		$this->trackdebug('form SUBFORM');

		if ($feuserid == 0) {
			if (intval($conf['advanced.']['loginRequired']) == 0) {
				$subformloginhtml = '';
			} else {
				$subformTemplate = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORLOGINREQ2###');
				$subformloginhtml = $this->t3substituteMarkerArray($subformTemplate,
						array(
							'###SUBMITONCLICK###' => trim($submithtml),
							'###CID###' => $output_cid,
							'###ERRCODE###' => $tERRCODE,
							'###TEXT_SUBMIT###' => $this->pi_getLLWrap($pObj, 'pi1_template.submit', $fromAjax),
							'###TEXT_RESET###' => $this->pi_getLLWrap($pObj, 'pi1_template.reset', $fromAjax),
							'###PRVCT###'=> $htmlprvcttextweb,
							'###AGBACCEPTED###'=> $htmlagbaccepted,
						));
			}

		} else {
			$subformloginhtml='';
		}
		if ($_SESSION['AJAXimagesrefresh'] == TRUE) {
			//$_SESSION['AJAXimagesrefresh'] = FALSE;
			$_SESSION['userAJAXimage'] = $_SESSION['AJAXimages'][$feuserid];
			$this->AJAXimages[$feuserid] = $_SESSION['AJAXimages'][$feuserid];
			$this->setAJAXimageCache($_SESSION['userAJAXimage'], $_SESSION['AJAXimagesrefreshImage']);
			//$_SESSION['AJAXimagesrefreshImage']='';
		}

		$imagetag = trim($_SESSION['userAJAXimage']);
		//new user special fix
		if ($feuserid != 0) {

			if ($imagetag=='') {
				if (count($this->AJAXimages) == 0) {
					$this->build_AJAXImages($conf, $pObj);
				}

				$_SESSION['userAJAXimage']=$this->AJAXimages[$feuserid];
				$_SESSION['userAJAXimage']=str_replace('"tx-tc-userpic tx-tc-online tx-tc-uimgsize"', '"tx-tc-userpic tx-tc-nodisp tx-tc-online tx-tc-uimgsize"', $_SESSION['userAJAXimage']);
				$this->checkAjaxUserPic();
				$imagetag =  $_SESSION['userAJAXimage'];
				$imagetag = str_replace('id="tx-tc-uimg-0"', 'id="tx-tc-uimg-'.$output_cid.'"', $_SESSION['userAJAXimage']);

				$imagetag = str_replace('class="tx-tc-userpic tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
				$imagetag = str_replace('class="tx-tc-userpic tx-tc-online tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
				$imagetag = str_replace('class="tx-tc-userpicf tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
				$imagetag = str_replace('class="tx-tc-userpicf tx-tc-online tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
				$imagetag = str_replace('width="' .$this->userimagesize .'"', 'width="'.$conf['UserImageSize'].'"', $imagetag);
				$imagetag = str_replace('height="' .$this->userimagesize .'"', 'height="'.$conf['UserImageSize'].'"', $imagetag);

				$_SESSION['userAJAXimage'] = $imagetag;
			}

			$imagetag = str_replace('id="tx-tc-uimg-"', 'id="tx-tc-uimg-'.$output_cid.'"', $_SESSION['userAJAXimage']);
			$imagetag = str_replace('id="tx-tc-cts-img-"', 'id="tx-tc-uimg-'.$output_cid.'"', $_SESSION['userAJAXimage']);
			if ($imagetag!=$_SESSION['userAJAXimage']) {
				$imagetagarr = explode('title="', $imagetag);
				if (count($imagetagarr) == 2) {
					$imagetagarr2 = explode('"', $imagetagarr[1]);
					$imagetagarr2[0] =trim(htmlspecialchars($_SESSION['submitCommentVars'][$cid]['firstname']) . ' ' .
							htmlspecialchars($_SESSION['submitCommentVars'][$cid]['lastname'])) . ' * ' . $this->pi_getLLWrap($pObj, 'pi1_template.welcome', $fromAjax);
					$imagetagarr[1] =implode('"', $imagetagarr2);
					$imagetag = implode('title="', $imagetagarr);
				}
				$imagetag = str_replace('class="tx-tc-userpic tx-tc-online tx-tc-uimg-'.$output_cid.'"', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online"', $imagetag);
				$imagetag = str_replace('class="tx-tc-userpic tx-tc-online tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
				$imagetag = str_replace('class="tx-tc-userpicf tx-tc-online tx-tc-uimg-'.$output_cid.'"', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online"', $imagetag);
				$imagetag = str_replace('class="tx-tc-userpicf tx-tc-online tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
				$imagetag = str_replace('width="' .$this->userimagesize .'"', 'width="'.$conf['UserImageSize'].'"', $imagetag);
				$imagetag = str_replace('height="' .$this->userimagesize .'"', 'height="'.$conf['UserImageSize'].'"', $imagetag);

				$_SESSION['userAJAXimage'] = $imagetag;
			} else {
				if (str_replace('<img', '', $imagetag) == $imagetag) {
					// no comments present
					$imagetag=$this->AJAXimages[$feuserid];

					$imagetag = str_replace('id="tx-tc-cts-img-"', 'id="tx-tc-uimg-'.$output_cid.'"', $imagetag);

					$imagetag = str_replace('class="tx-tc-userpic tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
					$imagetag = str_replace('class="tx-tc-userpic tx-tc-online tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
					$imagetag = str_replace('class="tx-tc-userpicf tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
					$imagetag = str_replace('class="tx-tc-userpicf tx-tc-online tx-tc-uimgsize" title', 'class="tx-tc-margin0 tx-tc-nodisp tx-tc-online" title', $imagetag);
					$imagetag = str_replace('width="' .$this->userimagesize .'"', 'width="'.$conf['UserImageSize'].'"', $imagetag);
					$imagetag = str_replace('height="' .$this->userimagesize .'"', 'height="'.$conf['UserImageSize'].'"', $imagetag);

					$_SESSION['userAJAXimage'] = $imagetag;
				}

				$checkname = trim(htmlspecialchars($_SESSION['submitCommentVars'][$cid]['firstname']) . ' ' .
						htmlspecialchars($_SESSION['submitCommentVars'][$cid]['lastname']));
				$imagetagtest = str_replace($checkname, '', $imagetag);
				if ($imagetagtest == $imagetag) {
					$imagetagarr = array();
					$imagetagarr = explode('title="', $imagetag);
					if (count($imagetagarr) == 2) {
						$titlearr = explode('"', $imagetagarr[1]);
						if (count($titlearr) >= 2) {
							$titlearr[0]=$checkname;
							$imagetagarr[1] = implode('"', $titlearr);
							$imagetag = implode('title="', $imagetagarr);
						}
					}

				}

				$_SESSION['userAJAXimage'] = $imagetag;

			}

		} else {
			$_SESSION['userAJAXimage']='';
			$imagetag='';
		}

		$txtwatermarkform = $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax);
		if (($conf['advanced.']['commentReview']==1) && ($fromcomments==FALSE)) {
			$txtwatermarkform=$this->pi_getLLWrap($pObj, 'pi1_template.add_review', $fromAjax);
		}

		$outputcidarr=explode('6g9', $output_cid);
		if (count($outputcidarr) >0) {

			$toreplacecid = $outputcidarr[0];
			if (str_replace('title="', '', $imagetag) == $imagetag) {
				$imagetag = str_replace('alt=""', 'title="' . trim(htmlspecialchars($_SESSION['submitCommentVars'][$cid]['firstname']) . ' ' .
					htmlspecialchars($_SESSION['submitCommentVars'][$cid]['lastname'])) .'"', $imagetag);
			}
			$imagetag = str_replace(' title=""', '', $imagetag);
			$imagetag = str_replace('alt="" >', 'alt="" />', $imagetag);

			$imagetag = str_replace('tx-tc-uimg-' . $toreplacecid . '"', 'tx-tc-uimg-' . $output_cid . '"', $imagetag);
			if (!(strpos($imagetag, '6g9') > 1)) {
				$imagetag = str_replace('tx-tc-uimg-' . $toreplacecid . '"', 'tx-tc-uimg-' . $output_cid . '"', $imagetag);
			}

			$txtwatermarkform = $this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax) . '...';
		}

		$smilieselectorhtml = '';
		$tapadding = '1';
		if ($conf['advanced.']['useEmoji']>0) {
			$smilieselectorttooltip = ' title="' .$this->pi_getLLWrap($pObj, 'pi1_template.add_emoji', $fromAjax) .'"';
			$smilieselectorhtml='<div id="tx-tc-smilie-iconlink-'.$output_cid.'">
					<div class="tx-tc-smilie-icon" id="tx-tc-smilie-icon-' . $output_cid .'"' . $smilieselectorttooltip . '></div>
					</div>
					<div class="tx-tc-smilie-popup" id="tx-tc-smilie-popup-'.$output_cid. '"></div>';
		}

		$this->taareaCSSheightinit = (4 + (intval($conf['theme.']['boxmodelTextareaLineHeight'])*intval($conf['theme.']['boxmodelTextareaNbrLines']))  +
									(2 * intval($conf['theme.']['boxmodelSpacing'])));

		if ($reviewMessage != '') {
			$tformTopMessage = $reviewMessage;
		}

		$markers = array(
				'###TAAREAHEIGHT###' => $this->taareaCSSheightinit,
				'###CURRENT_URL###' => htmlspecialchars($itemUrl),
				'###CURRENT_URL_CHK###' => md5($itemUrl . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']),
				'###TOP_MESSAGE###' => $tformTopMessage,
				'###SUBFORM###' => $subformhtml,
				'###SUBFORMLOGIN###' => $subformloginhtml,
				'###SUBMITONCLICK###' => trim($submithtml),
				'###ACTION_URL###' => '',
				'###REF###' => $externalref,
				'###IMAGETAG###' => $imagetag,
				'###JS_USER_DATA###' => $jsval,
				'###CAPTYPE###' => $conf['spamProtect.']['useCaptcha'],
				'###AJAXDATACONF###' => '&srcbcc=' . $conf['spamProtect.']['freecapBackgoundcolor'] . '&srctc=' . $conf['spamProtect.']['freecapTextcolor']
				. '&srcnbc=' . $conf['spamProtect.']['freecapNumberchars'] . '&srch=' . $conf['spamProtect.']['freecapHeight'],
				'###CID###' => $output_cid,
				'###SUBFORMCOMMENTATORNOTIFYPART###' => '',
				'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###LANG###' => $_SESSION['activelang'],
				'###TXTCLSPRV###' => $this->pi_getLLWrap($pObj, 'pi1_template.closepreview', $fromAjax),
				'###TXTLOADING###' => $this->pi_getLLWrap($pObj, 'pi1_template.loadingpreview', $fromAjax),
				'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
				'###MAXCOMMENTLENGTH###' => $conf['maxCommentLength'],
				'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
				'###ENCTEXT_ADD_COMMENT###' => base64_encode($txtwatermarkform),
				'###REVIEWACTION###' => $reviewaction,
				'###TEXT_ADD_COMMENT###' => $txtwatermarkform,
				'###TAHEIGHT###' => (intval($conf['theme.']['boxmodelTextareaLineHeight'])*intval($conf['theme.']['boxmodelTextareaNbrLines'])),
				'###PRVCTAREA###'=> $prvcommentHTML,
				'###LOGGEDIN###' => $loggedin,
				'###REVIEWSTYLE###' => $formReviewStyle,
				'###SMILIESSELECTOR###' => $smilieselectorhtml,
				'###TAPADDING###' => $tapadding,
		);

		//fe_user-intergration
		$markers['###USERNAME###'] = $GLOBALS['TSFE']->fe_user->user['username'];

		//commentator-notify-intergration
		$commentatorNotifyLevelBased = TRUE;
		if (($replylevel == $conf['advanced.']['userCommentResponseLevels']) && ($conf['advanced.']['notificationLevel'] == 1)) {
			$commentatorNotifyLevelBased = FALSE;
		}

		if (($conf['advanced.']['commentatorNotify'] == 1) && ($commentatorNotifyLevelBased == TRUE)) {
			if ($feuserid == 0) {
				$addcls = 'nl';
			}

			$durationtxt = '';
			if ($conf['advanced.']['notificationValidDays'] > 0) {
				if ($conf['advanced.']['notificationValidDays'] == 1) {
					$durationtxt = ' (24 ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hours', $fromAjax) . ')';
				} else {
					$durationtxt = ' (' . $conf['advanced.']['notificationValidDays'] . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.daysgermann', $fromAjax) . ')';
				}

			}

			$subformTemplateNotify = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMCOMMENTATORNOTIFY###');
			$notifytext= $this->pi_getLLWrap($pObj, 'pi1_template.notificationforcommentator_desc', $fromAjax) . $durationtxt;
			if ($conf['advanced.']['notificationLevel'] == 1) {
				$notifytext= $this->pi_getLLWrap($pObj, 'pi1_template.notificationforcommentator_desc_answers', $fromAjax) . $durationtxt;
			} elseif ($conf['advanced.']['notificationLevel'] == 2) {
				$notifytext= $this->pi_getLLWrap($pObj, 'pi1_template.notificationforcommentator_desc_answersandsame', $fromAjax) . $durationtxt;
			}
			$checked = '';
			if(intval($_SESSION['submitCommentVars'][$cid]['notify']) ==1) {
				$checked = 'checked ';
			}

			$subformTemplateNotifySub =  $this->t3substituteMarkerArray($subformTemplateNotify, array(
					'###DIVSHOW_NOTIFICATION###' => '<div class="tx-tc-ct-form-field-1' . $addcls . '">',
					'###TEXT_NOTIFICATION###' => $this->pi_getLLWrap($pObj, 'pi1_template.notificationforcommentator', $fromAjax),
					'###CID###' => $output_cid,
					'###TEXT_NOTIFICATION_DESC###' => $notifytext,
					'###NOTIFICATION_VALUE###' => intval($_SESSION['submitCommentVars'][$cid]['notify']),
					'###NOTIFICATION_CHECKED###' => $checked,
			));
		} else  {
			$subformTemplateNotifySub = '';
		}

		$markers['###SUBFORMCOMMENTATORNOTIFYPART###'] = $subformTemplateNotifySub;
		// Call hook for custom markers
		$pObj->conf = $conf;
		if ($callextfunc == 0) {
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['form'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['form'] as $userFunc) {
					$params = array(
							'pObj' => $pObj,
							'template' => $template,
							'markers' => $markers,
					);
					if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
						$markers = $tempMarkers;
					}

				}

			}

		}

		$retstr = '';
		if ($fromAjax) {

			if ($this->newcommentid != -1) {
				if ((intval($conf['spamProtect.']['requireApproval']) == 0) && ($this->newcommentneedscoi == 0)) {
					// the comment is in the base and can be shown
					$retstr = '<div id=101' . $this->newcommentid . '></div>';
				} else {
					// the comment is in the base and but need approval or coi first
					$retstr = '<div id=201' . $this->newcommentid . '></div>';
				}

			} else {
				// db inconsistent on insert
				if ($this->insertwasnotconsistent == 1) {
					$retstr = '<div id=401999999999></div>';
					$this->insertwasnotconsistent = 0;

				}

			}

			$cid = 0;
		}

		$this->trackdebug('form COMMENT_FORM');
		$parentidhiddenformfield = '<input type="hidden" name="toctoc_comments_pi1[commentparentid]" id="toctoc_comments_pi1_' .
		$output_cid .'commentparentid" value="' . $commentid . '" />';
		$outhtml = $this->t3substituteMarkerArray($template, $markers);
		if ((intval($piVars['level']) != 0)) {
			$outhtml = str_replace('class="tx-tc-ct-box-cttxt"', 'class="tx-tc-ct-box-cttxt-reply"', $outhtml);
			$outhtml = str_replace('"' . $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax), '"' .
					$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax), $outhtml);
			$outhtml = str_replace('\'' . $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax), '\'' .
					$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax), $outhtml);
		}

		$outhtml = str_replace('insert" value="insert" />', 'insert" value="insert" />' . $parentidhiddenformfield, $outhtml);
		$outhtml = str_replace('tx-tc-cAD-' . $_SESSION['commentListCount'] . '6g9' . $commentid . '6g9', 'tx-tc-cAD-' .
				$_SESSION['commentListCount'], $outhtml);
		$outhtml = str_replace('tx-tc-cADImg-' . $_SESSION['commentListCount'] . '6g9' . $commentid . '6g9', 'tx-tc-cADImg-' .
				$_SESSION['commentListCount'], $outhtml);
		$outhtml = str_replace('tx-tc-cThisData-' . $_SESSION['commentListCount'] . '6g9' . $commentid . '6g9', 'tx-tc-cThisData-' .
				$_SESSION['commentListCount'], $outhtml);
		$outhtml = str_replace('tx-tc-cADC-' . $_SESSION['commentListCount'] . '6g9' . $commentid . '6g9', 'tx-tc-cADC-' .
				$_SESSION['commentListCount'], $outhtml);
		$outhtml = str_replace('tx-tc-cADAtt-' . $_SESSION['commentListCount'] . '6g9' . $commentid . '6g9', 'tx-tc-cADAtt-' .
				$_SESSION['commentListCount'], $outhtml);

		$this->trackdebug('form COMMENT_FORM');

		$retstr = $retstr . $outhtml;

		// Adjust gravatars for https or http
		if ($conf['advanced.']['gravatarEnable'] == 1) {
			if (@$_SERVER['HTTPS'] == 'on') {
				$retstr = str_replace('http://www.gravatar.', 'https://secure.gravatar.', $retstr);
			} else {
				$retstr = str_replace('https://secure.gravatar.', 'http://www.gravatar.', $retstr);
			}
		}
		return $retstr;
	}

	/**
	 * Examines $piVars and fills missing fields with FE user data.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	string		$userpic: user picture link
	 * @param	int		$cid: Content element ID
	 * @param	string		$output_cid: CID to be used in form html (ids CSS)
	 * @return	void
	 */
	protected function form_updatePostVarsWithFeUserData($pObj, $fromAjax, $conf, $piVars, $feuserid, $userpic, $cid, $output_cid) {
			if ($fromAjax) {
				$fe_user_user_uid =$feuserid;
			} else {
				$fe_user_user_uid =intval($GLOBALS['TSFE']->fe_user->user['uid']);
			}

			if ($fe_user_user_uid) {
				$reloadpivars=FALSE;
				if (!$_SESSION['feuserid']) {
					$_SESSION['feuserid']=0;
				}

				if ($_SESSION['feuserid'] != $fe_user_user_uid) {
					$piVars['firstname']='';
					$piVars['commenttitle']='';
					$piVars['lastname']='';
					$piVars['location']='';
					$piVars['homepage']='';
					$piVars['email'] ='';
					$piVars['image']='';
					$piVars['imagetag']='';

					$_SESSION['submitCommentVars'][$cid]['commenttitle']='';
					$_SESSION['submitCommentVars'][$cid]['firstname']='';
					$_SESSION['submitCommentVars'][$cid]['lastname']='';
					$_SESSION['submitCommentVars'][$cid]['location']='';
					$_SESSION['submitCommentVars'][$cid]['homepage']='';
					$_SESSION['submitCommentVars'][$cid]['email'] ='';
					$_SESSION['submitCommentVars'][$cid]['gender'] =0;
					$_SESSION['submitCommentVars'][$cid]['uploadpicid']='';
					$_SESSION['submitCommentVars'][$cid]['uploadpicheight']='';
					$_SESSION['submitCommentVars'][$cid]['descriptionbyuser']='';
					$_SESSION['submitCommentVars'][$cid]['originalfilename']='';
					$_SESSION['submitCommentVars'][$cid]['image']='';
					$_SESSION['submitCommentVars'][$cid]['imagetag']='';
					$_SESSION['submitCommentVars'][$cid]['previewselpreviewid']=0;

					$_SESSION['feuserid'] = intval($fe_user_user_uid);
					$reloadpivars=TRUE;
				}

				/* Do everything to buildup First and Lastname
				 * regardless of the how its filled in feusers
				* 1. Firstname and Lastname
				* 2. if 1. not ok the we take it from name
				* 3. if this still doesnt work (only username exists) We create
				* First- and Lastname from the username
				*/
					$rows = array();
					$rows = $this->getBaseFeUsersArray($pObj, $fromAjax, $fe_user_user_uid, '', $conf);

					if (count($rows) >=1) {
						$keyFeUserDbField=trim($this->fixFeUserPic($rows[$conf['advanced.']['FeUserDbField']]));
						$femp='';
						if (array_key_exists('gender', $rows)) {
							if ($rows['gender']==1) {
								$femp='f';

							}

						}

						if ((!$piVars['gender']) || $reloadpivars) {
							if (array_key_exists('gender', $rows)) {
								$piVars['gender']=$rows['gender'];
								$_SESSION['submitCommentVars'][$cid]['gender'] = intval($piVars['gender']);
							} else {
								$piVars['gender']=0;
								$_SESSION['submitCommentVars'][$cid]['gender'] = 0;
							}

						}

						$nonames=0;
						if ((!$piVars['firstname']) || $reloadpivars) {

							if ($rows['first_name']) {
								$piVars['firstname'] = $rows['first_name'];
								$_SESSION['submitCommentVars'][$cid]['firstname'] = $piVars['firstname'];
								$nonames=10;
							} else {
								$nonames=1;
							}

						}

						if ((!$piVars['lastname']) || $reloadpivars) {
							if ($rows['last_name']) {
								$piVars['lastname'] = $rows['last_name'];
								$_SESSION['submitCommentVars'][$cid]['lastname'] = $piVars['lastname'];
								$nonames=$nonames+20;
							} else {
								$nonames=$nonames+2;
							}

						}

						if (($reloadpivars) || !(($piVars['lastname']) && ($piVars['firstname']))) {
							$namePartsArr=explode(' ', $rows['name']);
							$countNameParts = count($namePartsArr);

							if ($countNameParts>1) {
								$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
								$tmpLASTNAME = trim(substr($rows['name'], (strlen($rows['name'])-$lastpartlen), 1000));
								$tmpFIRSTNAME = trim(substr($rows['name'], 0, strlen($rows['name'])-strlen($tmpLASTNAME)));
							} elseif (strlen($rows['name'])>1) {
								$tmpLASTNAME = trim($rows['name']);
								$tmpFIRSTNAME = '';
							} else {
								$tmpLASTNAME = trim($rows['username']);
								$tmpFIRSTNAME = '';
							}

							if ($nonames< 30) {
								if ($nonames>20) {
									// only firstname missing
									$piVars['firstname'] = $tmpFIRSTNAME;
									$_SESSION['submitCommentVars'][$cid]['firstname'] = $piVars['firstname'];

								} elseif ($nonames>10) {
									// only lastname missing
									$piVars['lastname'] = $tmpLASTNAME;
									$_SESSION['submitCommentVars'][$cid]['lastname'] = $piVars['lastname'];

								} elseif ($nonames>0)  {
									// both missing
									$piVars['firstname'] = $tmpFIRSTNAME;
									$_SESSION['submitCommentVars'][$cid]['firstname'] = $piVars['firstname'];
									$piVars['lastname'] = $tmpLASTNAME;
									$_SESSION['submitCommentVars'][$cid]['lastname'] = $piVars['lastname'];

								}

							}

						}

						if ((!$piVars['image']) || $reloadpivars) {
							$nouserpic=TRUE;
							if ($keyFeUserDbField) {
								if ($keyFeUserDbField!='') {
									$piVars['image'] = $keyFeUserDbField;
									$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];
									$nouserpic=FALSE;
								}

							}

							if ($nouserpic) {
								$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile' . $femp . '.png';
								$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
								$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
								$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
								$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
								$userimgFileArr= explode('/', $userimgFile);

								$commentimageout=$userimgFileArr[count($userimgFileArr)-1];
								$nouserpic=FALSE;
								$piVars['image'] = $commentimageout;
								$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];

							}

							if ($nouserpic) {
								$piVars['image'] = 'nopic.jpg';
								$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];

								$nouserpic=FALSE;
							}

						}

						if ((!$piVars['imagetag']) || $reloadpivars) {

							$userimagesize = $conf['UserImageSize'];
							$userimagestyle = '';
							$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];
							if (($keyFeUserDbField !='') || ($keyFeUserDbField)) {
								$userimagesarr=explode(',', $keyFeUserDbField);
								if (count($userimagesarr)>0) {
									$commentuserimageextr=  $userimagesarr[0];
								} else {
									$commentuserimageextr=  $keyFeUserDbField;
								}

								$piVars['imagetag'] = $commentuserimageextr;
								$commentuserimageout= $commentuserimagepath . $commentuserimageextr;
							} else
							{
								$piVars['imagetag'] = $keyFeUserDbField;
								$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
								$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
								$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
								$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $userimgFile);
								$commentuserimageout=$userimgFile;
							}

							if ($fromAjax) {
								$piVars['imagetag']= $userpic;
							} else {
								$this->trackdebug('0 form_updatePostVarsWithFeUserData imagetag');
								$makepic=FALSE;
								if (!isset($tuserformimage)) {
									$makepic=TRUE;
								} elseif (trim($tuserformimage)=='') {
									$makepic=TRUE;
								}

								$gifbuildimage = '';
								if ($makepic==TRUE) {
									$gifbuildimage = $this->gifbuild($conf, $pObj, 0, $commentuserimageout,
											$userimagesize, 'tx-tc-margin0 tx-tc-nodisp', '', '', '', $piVars['email'], 'tx-tc-uimg-xx', FALSE, 'left');
								}

								if (!isset($tuserformimage)) {
									$piVars['imagetag'] = $gifbuildimage;
									if ($piVars['imagetag'] != '') {
										$tuserformimage= $piVars['imagetag'];
									} else {
										$tuserformimage = '<img src="https://www.toctoc.ch/fileadmin/txtc/txtc-inf.gif" id="tx-tc-uimg-xx" class="tx-tc-margin0 tx-tc-nodisp" align="left" />';
									}

								} elseif (trim($tuserformimage)=='') {
									$piVars['imagetag'] = $gifbuildimage;
									if ($piVars['imagetag'] != '') {
										$tuserformimage= $piVars['imagetag'];
									} else {
										$tuserformimage = '<img src="https://www.toctoc.ch/fileadmin/txtc/txtc-inf.gif" id="tx-tc-uimg-xx" class="tx-tc-margin0 tx-tc-nodisp" align="left" />';
									}

								} else {
									$piVars['imagetag'] =$tuserformimage;
								}

								if ($_SESSION['commentListCount']) {
									$piVars['imagetag']=str_replace('img-xx', 'img-'.$output_cid, $tuserformimage);
								}

								// gravatar
								if ($conf['advanced.']['gravatarEnable'] == 1) {
										$piVars['imagetag'] = $this->gravatarize($conf, $piVars['imagetag'], $rows['email']);
								}

								$_SESSION['userAJAXimage']= $piVars['imagetag'];
								$this->trackdebug('0 form_updatePostVarsWithFeUserData imagetag');
							}

							$_SESSION['submitCommentVars'][$cid]['imagetag'] = $piVars['imagetag'];
							if ($piVars['imagetag'] != '') {
								$testarr = explode('tx-tc-uimg-0', $piVars['imagetag']);
								if (count($testarr) == 2) {
									$piVars['imagetag'] = implode('', $testarr);
									$piVars['imagetag'] =str_replace('tx-tc-cts-img', 'tx-tc-uimg', $piVars['imagetag']);

								}

								$_SESSION['submitCommentVars'][$cid]['imagetag'] = $piVars['imagetag'];
								if ($_SESSION['userAJAXimage'] != $piVars['imagetag']) {
									$_SESSION['userAJAXimage']= $piVars['imagetag'];
								}

							}

						}

						if ((!$piVars['email']) || $reloadpivars) {
							if ($rows['email']!='') {
								$piVars['email'] = $rows['email'];
							} else {
								$piVars['email'] = 'badmailadress@nosite.net';
							}

							$_SESSION['submitCommentVars'][$cid]['email'] = $piVars['email'];
						}

						if ((!$piVars['location']) || $reloadpivars) {
							$data = array();
							if ($rows['city']) {
								$data[] = $rows['city'];
							}

							if ($rows['country']) {
								$data[] = $rows['country'];
							}

							$piVars['location'] = implode(', ', $data);
							$_SESSION['submitCommentVars'][$cid]['location'] = $piVars['location'];
							unset($data);
						}

						if ((!$piVars['homepage']) || $reloadpivars) {
							$piVars['homepage'] = $rows['www'];
							$_SESSION['submitCommentVars'][$cid]['homepage'] = $piVars['homepage'];
						}

				}

			} else {
				if ($_SESSION['feuserid'] != 0) {
					$piVars['commenttitle']='';
					$_SESSION['submitCommentVars'][$cid]['commenttitle']='';
					$piVars['firstname']='';
					$_SESSION['submitCommentVars'][$cid]['firstname']='';
					$piVars['lastname']='';
					$_SESSION['submitCommentVars'][$cid]['lastname']='';
					$piVars['location']='';
					$_SESSION['submitCommentVars'][$cid]['location']='';
					$piVars['homepage']='';
					$_SESSION['submitCommentVars'][$cid]['homepage']='';
					$piVars['email'] ='';
					$_SESSION['submitCommentVars'][$cid]['email'] ='';
					$piVars['image']='';
					$_SESSION['submitCommentVars'][$cid]['image']='';
					$piVars['imagetag']='';
					$_SESSION['submitCommentVars'][$cid]['imagetag']='';
					$_SESSION['feuserid'] = 0;
				}

		}

	}

	/**
	 * gets a users name.
	 *
	 * - @param	array		$conf:  Array with the plugin configuration
	 *
	 * @param	integer		$fe_user_user_uid: fe_users.uid
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	[type]		$conf: ...
	 * @return	string		users name
	 */
	protected function getUserName($fe_user_user_uid, $pObj, $fromAjax, $conf) {
		$rows = array();
		$rows = $this->getBaseFeUsersArray($pObj, $fromAjax, $fe_user_user_uid, '', $conf);
		$ret='';

		if (count($rows) >=1) {
			if ($rows['first_name']) {
				$piVarsfirstname = $rows['first_name'];
				$nonames=10;
			} else {
				$nonames=1;
			}

			if ($rows['last_name']) {
				$piVarslastname = $rows['last_name'];

				$nonames=$nonames+20;
			} else {
				$nonames=$nonames+2;
			}

			if (!(($piVarslastname) && ($piVarsfirstname))) {
				$namePartsArr=explode(' ', $rows['name']);
				$countNameParts = count($namePartsArr);

				if ($countNameParts>1) {
					$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
					$tmpLASTNAME = trim(substr($rows['name'], (strlen($rows['name'])-$lastpartlen), 1000));
					$tmpFIRSTNAME = trim(substr($rows['name'], 0, strlen($rows['name'])-strlen($tmpLASTNAME)));
				} elseif (strlen($rows['name'])>1) {
					$tmpLASTNAME = trim($rows['name']);
					$tmpFIRSTNAME = '';
				} else {
					$tmpLASTNAME = trim($rows['username']);
					$tmpFIRSTNAME = '';
				}

				if ($nonames< 30) {
					if ($nonames>20) {
						// only firstname missing
						$piVarsfirstname = $tmpFIRSTNAME;

					} elseif ($nonames>10) {
						// only lastname missing
						$piVarslastname = $tmpLASTNAME;

					} elseif ($nonames>0)  {
						// both missing
						$piVarsfirstname = $tmpFIRSTNAME;
						$piVarslastname= $tmpLASTNAME;
					}

				}
			}
			$ret = trim($piVarsfirstname .' ' . $piVarslastname);
		}
		return $ret;
	}
	/**
	 * Adds captcha code if enabled.
	 * and if requested by submit. cid has to fit as well
	 *
	 * @param	object		$pObj: parent object
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	string		Generated HTML
	 */
	protected function form_getCaptcha($pObj, $conf, $fromAjax) {
		$captchaType = intval($conf['spamProtect.']['useCaptcha']);
		if ($captchaType > 2) {
			print 'spamProtect.useCaptcha = "' . $conf['spamProtect.']['useCaptcha'] . '" is invalid';
			exit;
		}

		if ($captchaType == 1) {
			/* captcha in sr_freecap_style */

			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###CAPTCHA_SUB###');
			$retstr = $this->t3substituteMarkerArray($template, array(
					'###REQUIRED_CAPTCHA###' => $this->t3getSubpart($pObj, $pObj->templateCode, '###REQUIRED_FIELD###'),
					'###ERROR_CAPTCHA###' => $this->form_wrapError('captcha', $pObj, $conf),
					'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_ENTER_CODE###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code', $fromAjax),
					'###AJAXDATACONF###' => '&srcbcc=' . trim(str_replace(' ', '', $conf['spamProtect.']['freecapBackgoundcolor'])) .
											'&srctc=' . trim(str_replace(' ', '', $conf['spamProtect.']['freecapTextcolor'])) .
											'&srcnbc=' . trim(str_replace(' ', '', $conf['spamProtect.']['freecapNumberchars'])) .
											'&srch=' . trim(str_replace(' ', '', $conf['spamProtect.']['freecapHeight'])) . '&mtm=' .
											(10*round(microtime(TRUE), 1)),
					'###SR_FREECAP_CANT_READ###' => $this->pi_getLLWrap($pObj, 'pi1_template.captcha_cant_read', $fromAjax),
					'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
			));
			return $retstr;

		}

		if ($captchaType == 2) {
			/* captcha in recaptcha style */

			$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###RECAPTCHA_SUB###');
			$retstr =  $this->t3substituteMarkerArray($template, array(
					'###REQUIRED_CAPTCHA###' => $this->t3getSubpart($pObj, $pObj->templateCode, '###REQUIRED_FIELD###'),
					'###ERROR_CAPTCHA###' => $this->form_wrapError('captcha', $pObj, $conf),
					'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_ENTER_CODE###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code', $fromAjax),
					'###SR_FREECAP_CANT_READ###' => $this->pi_getLLWrap($pObj, 'pi1_template.captcha_cant_read', $fromAjax),
					'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
			));
			return $retstr;
		}

		return '';
	}

	/**
	 * Wraps error message for the given field if error exists. Is always called from ajax.
	 * thus does not use normal stdWrap call
	 *
	 * @param	string		$field	Input field from the form
	 * @param	object		$pObj: parent object
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Error wrapped with stdWrap or empty string
	 */
	protected function form_wrapError($field, $pObj, $conf) {
		$retstr='';
		if ($_SESSION['formValidationErrors'][$field]) {
			$retstr=$_SESSION['formValidationErrors'][$field];
			if ($conf['requiredFields_errorWrap.']['dataWrap']) {
				$arrWrap=explode('|', $conf['requiredFields_errorWrap.']['dataWrap']);
				if (is_array($arrWrap)) {
					$arrWrapbegin = str_replace('{LLL:EXT:toctoc_comments/pi1/locallang.xml:error}', $this->pi_getLLWrap($pObj, 'error', TRUE), $arrWrap[0] );
					$retstr=$arrWrapbegin . $_SESSION['formValidationErrors'][$field] .$arrWrap[1];
				}

			}

		}

		return $retstr;
	}

	/**
	 * Comments page-browser functions
	 *
	 *
	 */

	/**
	 * Processes form Browser-submissions.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$cid: Content element ID
	 * @param	string		$cmd: "browse" or "browsehide"
	 * @param	int		$pid: pageid
	 * @param	string		$ref: ...
	 * @return	void
	 */
	protected function processBrowserSubmission($conf, $pObj, $cmd, $ref) {

			$rpp = intval($conf['advanced.']['commentsPerPage']);
			$rpp = ($rpp == 0 ? 1 : $rpp);

			$confmaxstepsbackbyolder = $conf['advanced.']['CommentsShowOldPerCID'];
			$maxstepsbackbyolder = $confmaxstepsbackbyolder *$rpp;

			if ($cmd=='browse') {
				if ($conf['advanced.']['reverseSorting']==1) {
					if (($pObj->startpoint + $maxstepsbackbyolder) > $pObj->totalrows) {
						$pObj->startpoint=$pObj->totalrows;
					} else {

						$pObj->startpoint = $pObj->startpoint + $maxstepsbackbyolder;
					}

				} else {
					if (($pObj->startpoint - $maxstepsbackbyolder)<0) {
						$pObj->startpoint=0;
					} else {
						$pObj->startpoint = $pObj->startpoint - $maxstepsbackbyolder;
					}

				}

			} elseif ($cmd=='browsehide') {
				if ($conf['advanced.']['reverseSorting']==1) {
					$pObj->startpoint = $rpp;
				} else {
					$pObj->startpoint = $pObj->totalrows - $rpp;
					if ($pObj->startpoint<0) {
						$pObj->startpoint=0;
					}

				}

			}

			/*
			 * now startpoint can be 0 but cannot be greater than
			* currenttotalrows-startpoint
			*/

			$_SESSION['commentListIndex']['cid' . $ref]['startIndex'] =$pObj->startpoint;
	}

	/**
	 * Inserting and Updating Comments functions
	 *
	 *
	 */

	/**
	 * Inserts a new comment
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: pageid
	 * @param	int		$lang: languagecode
	 * @return	void
	 */
	public function processSubmission($conf, $pObj, $piVars, $fromAjax, $feuserid, $pid, $lang) {

		if ($piVars['insert']=='insert') {

			$_SESSION['submitJustProcessed'] = '1';

			$lang=intval($lang);

			$_SESSION['submittedCid'] = trim($piVars['cid']);
			$cid= trim($piVars['cid']);
			$piVars['content']=base64_decode($piVars['content']);
			$_SESSION['submitCommentVars'][$cid]['content'] = trim($piVars['content']);
			$_SESSION['submitCommentVars'][$cid]['commenttitle'] = trim($piVars['commenttitle']);
			$_SESSION['submitCommentVars'][$cid]['homepage'] = trim($piVars['homepage']);
			$_SESSION['submitCommentVars'][$cid]['firstname'] = trim($piVars['firstname']);
			$_SESSION['submitCommentVars'][$cid]['image'] = trim($piVars['image']);
			$_SESSION['submitCommentVars'][$cid]['lastname'] = trim($piVars['lastname']);
			$_SESSION['submitCommentVars'][$cid]['email'] = trim($piVars['email']);
			$_SESSION['submitCommentVars'][$cid]['location'] = trim($piVars['location']);
			$_SESSION['submitCommentVars'][$cid]['previewselpic'] = trim($piVars['previewselpic']);
			$_SESSION['submitCommentVars'][$cid]['previewselpreviewid'] = trim($piVars['previewselpreviewid']);
			$_SESSION['submitCommentVars'][$cid]['commentparentid'] = trim($piVars['commentparentid']);
			$_SESSION['submitCommentVars'][$cid]['gender'] = intval(trim($piVars['gender']));
			$_SESSION['submitCommentVars'][$cid]['notify'] = intval(trim($piVars['notify']));
			$_SESSION['submitCommentVars'][$cid]['uploadpicid'] = trim($piVars['uploadpicid']);
			$_SESSION['submitCommentVars'][$cid]['uploadpicheight'] = trim($piVars['uploadpicheight']);
			$_SESSION['submitCommentVars'][$cid]['descriptionbyuser'] = trim($piVars['descriptionbyuser']);
			$_SESSION['submitCommentVars'][$cid]['originalfilename'] = trim($piVars['originalfilename']);

			$_SESSION['submitCommentVars'][$cid]['level'] = trim($piVars['level']);
			$this->newcommentid = 0;
			$newattachment_id =0;
			$_SESSION['formValidationErrors'] = array();
			if (!($this->processSubmission_validate($piVars, $conf, $pObj, $fromAjax))) {
				if ($pObj->foreignTableName == 'pages') {
					$external_ref = $pObj->foreignTableName . '_' . $pid;

				} else {
					$external_ref = $pObj->foreignTableName . '_' . $pObj->externalUid;
				}

				/* Create record
					*
				* We could add 'image' => trim($piVars['image']),
				* The table should include the filed and then we could display
				* the userpic in the backend from the table
				*/
				$this->newcommentneedscoi=0;
				if (($conf['spamProtect.']['confirmedOptIn'] ==1) || ($conf['spamProtect.']['confirmedOptInEmailOnly'] == 1)) {
					if ($conf['spamProtect.']['confirmedOptInEmailOnly'] == 0) {
						$this->newcommentneedscoi=$this->checkCOI($conf, trim($piVars['email']), TRUE);
					} else {
						$this->newcommentneedscoi=$this->checkCOI($conf, trim($piVars['email']), FALSE);
					}
				}

				$strCurrentIP = $this->getCurrentIp();

				//if it's a form post as reply on a comment, then cid has bad format for external_ref_uid and needs to be fixed
				// it then looks like 10029276000279000
				$testedexternal_ref_uid = 'tt_content_' . trim($piVars['cid']);
				$testedexternal_ref_uidarr = explode('6g9', $testedexternal_ref_uid);
				if (count($testedexternal_ref_uidarr)>1) {
					$testedexternal_ref_uid =$testedexternal_ref_uidarr[0];
					if ($piVars['commentparentid']==0) {
						$piVars['commentparentid'] = intval($testedexternal_ref_uidarr[1]) . $testedexternal_ref_uidarr[2];
						$_SESSION['submitCommentVars'][$cid]['commentparentid']= intval($testedexternal_ref_uidarr[1]) . $testedexternal_ref_uidarr[2];
					}

				}

				$record = array (
						'pid' => intval($conf['storagePid']),
						'external_ref' => $external_ref,
						'external_prefix' => trim($conf['externalPrefix']),
						'firstname' => trim($piVars['firstname']),
						'commenttitle' => trim($piVars['commenttitle']),
						'lastname' => trim($piVars['lastname']),
						'email' => trim($piVars['email']),
						'hidden' => $this->newcommentneedscoi,
						'gender' => intval(trim($piVars['gender'])),
						'location' => trim($piVars['location']),
						'homepage' => trim($piVars['homepage']),
						'content' => trim($piVars['content']),
						'external_ref_uid' => $testedexternal_ref_uid,
						'tx_commentsresponse_response' => '',
						'remote_addr' => $strCurrentIP,
				);

				$plugincacheid=$external_ref;
				if (trim($conf['externalPrefix'])=='pages') {
					$plugincacheid=$testedexternal_ref_uid;
				}

				if ($conf['advanced.']['commentatorNotify'] ==1) {
					$record['tx_commentsnotify_notify'] = $piVars['notify'];
				} else {
					$record['tx_commentsnotify_notify'] = 0;
				}

				$record['attachment_subid'] = 0;
				$record['attachment_id'] =0;
				$newattachment_subid =0;
				if ($conf['attachments.']['useWebpagePreview'] ==1) {
					if ($piVars['previewselpreviewid']!=0) {
						if (intval($piVars['previewselpic']) == 888) {
							$record['attachment_subid'] = 999;
						} else {
							$record['attachment_subid'] = $piVars['previewselpic'];
							$newattachment_subid = $piVars['previewselpic'];
						}

						$record['attachment_id'] = $piVars['previewselpreviewid'];
						$newattachment_id =$piVars['previewselpreviewid'];
					}

				}

				if ($conf['advanced.']['userCommentResponseLevels'] >0) {
					if ($piVars['commentparentid']!=0) {
						$record['parentuid'] = $piVars['commentparentid'];
					}

				}

				// integration of fe_user

				if (version_compare(TYPO3_version, '4.6', '<')) {
					$tmpintuid = t3lib_div::testInt($feuserid);
				} else {
					$tmpintuid = t3lib_utility_Math::canBeInterpretedAsInteger($feuserid);
				}

				if (!$tmpintuid) {
					$record['toctoc_commentsfeuser_feuser'] = 0;
					$feuserid=0;
				} else {
					$record['toctoc_commentsfeuser_feuser'] = $feuserid;
				}

				$fetoctocusertoinsert ='';
				if (intval($feuserid)===0) {
					$fetoctocusertoquery ='"' . $strCurrentIP . '.0"';
					$fetoctocusertoinsert ='' . $strCurrentIP . '.0';
				} else {
					$fetoctocusertoquery ='"0.0.0.0.' . $feuserid . '"';
					$fetoctocusertoinsert ='0.0.0.0.' . $feuserid;

				}

				$record['toctoc_comments_user'] = $fetoctocusertoinsert;
				$record['isreview']=0;
				// Check for double post
				$double_post_check = md5(implode(',', $record));
				if ($conf['preventDuplicatePosts']) {
					list($info) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments',
							$pObj->where_dpck . ' AND crdate>=' . (time() - 60*60) . ' AND double_post_check=' .
							$GLOBALS['TYPO3_DB']->fullQuoteStr($double_post_check, 'tx_toctoc_comments_comments'));
				} else {
					$info = array('t' => 0);
				}

				// check for double review
				if (($conf['advanced.']['commentReview']==1) && (intval($record['parentuid'] ==0))) {
					$record['isreview']=1;
					list($inforeview) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments',
							$pObj->where_dpck . ' AND parentuid = 0 AND toctoc_commentsfeuser_feuser=' . $feuserid . ' AND external_ref_uid="' . $record['external_ref_uid'] . '"');
				} else {
					$inforeview = array('t' => 0);
				}

				if (intval($this->sessionCaptchaData)==0) {
					unset($_SESSION['requestCapcha'][$cid]);
				}
				$timegap = 0;
				if ($_SESSION['lasttimecomment']) {
					if ($_SESSION['lasttimecomment'] > 0) {
						$limittimegap = 60 * intval($conf['spamProtect.']['commentWaitTime']);
						$lastallowedcommentingtime = microtime(TRUE) - $limittimegap;
						if ($_SESSION['lasttimecomment'] > $lastallowedcommentingtime) {
							$timegap = intval(($_SESSION['lasttimecomment']-$lastallowedcommentingtime)/60);
							if ($timegap == 0) {
								$timegap = 1;
							}
						} else {
							$_SESSION['lasttimecomment'] = 0;
						}
					}
				} else {
					$_SESSION['lasttimecomment'] = 0;
				}
				if ($info['t'] > 0) {
					// Double post!

					$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'error.double.post', $fromAjax);
					unset($_SESSION['requestCapcha'][$cid]);
				} elseif ($inforeview['t'] > 0) {
					//show and request captcha
					$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'pi1_template.alreadymadeareview', $fromAjax);
				} elseif ($timegap > 0) {
					//show and request captcha
					if ($timegap == 1) {
						$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'pi1_template.needwaitforoneminute', $fromAjax) . ' '
								. $this->pi_getLLWrap($pObj, 'pi1_template.needwait_untilyoucanrepost', $fromAjax);
					} else {
						$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'pi1_template.needwaitfor', $fromAjax) . ' ' . $timegap . ' '
								. $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.minutes', $fromAjax) . ' '
								. $this->pi_getLLWrap($pObj, 'pi1_template.needwait_untilyoucanrepost', $fromAjax);

					}
				} elseif ($_SESSION['requestCapcha'][$cid]>=1) {
					//show and request captcha

					$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'pi1_template.captchaInputNeeded', $fromAjax);
				} else {
					$pObj->conf=$conf;
					$isSpam = $this->processSubmission_checkTypicalSpam($pObj, $conf, $piVars, $lang, $fromAjax);
					$cutOffPoint = $conf['spamProtect.']['spamCutOffPoint'] ? $conf['spamProtect.']['spamCutOffPoint'] : $isSpam + 1;
					if ($isSpam < $cutOffPoint) {
						$this->insertwasnotconsistent=0;
						if ($conf['advanced.']['userCommentResponseLevels'] >0) {
							if ($piVars['commentparentid']!=0) {
								$dataWhereparent = 'uid=' . intval($piVars['commentparentid']) . ' AND deleted=0 ';
								list($rowparent) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS parentcount',
										'tx_toctoc_comments_comments', $dataWhereparent);
								if (count($rowparent)==0) {
									$this->insertwasnotconsistent=1;
									$this->newcommentid = -1;
								} else {
									if (intval($rowparent['parentcount']) === 0) {
										// parent has been removed
										$this->insertwasnotconsistent=1;
										$this->newcommentid = -1;
									}

								}

							}

						}

						if ($this->insertwasnotconsistent == 0) {
							$isApproved = 1;
							if (intval($conf['spamProtect.']['requireApproval']) == 1) {
								$isApproved = 0;
							}

							// Add rest of the fields
							$record['crdate'] = $record['tstamp'] = time();
							$record['approved'] = $isApproved;
							$record['double_post_check'] = $double_post_check;
							if (($conf['attachments.']['usePicUpload'] ==1) || (intval($conf['attachments.']['usePdfUpload']) ==1 )) {
								if (trim($piVars['uploadpicid'])!='') {
									$record['attachment_id'] = $this->makeAttachementPicture(trim($piVars['uploadpicid']), $conf,
											trim($piVars['descriptionbyuser']), trim($piVars['originalfilename']), trim($piVars['firstname']),
											trim($piVars['lastname']), $record['toctoc_comments_user']);
									$newattachment_id = $record['attachment_id'];
								}

							}

							$this->initCaches();

							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_comments', $record);
							$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
							// increase startpoint if set

							$_SESSION['submitCommentVars'][$cid]['uploadpicid']='';
							$_SESSION['submitCommentVars'][$cid]['uploadpicheight'] = 0;
							$_SESSION['submitCommentVars'][$cid]['descriptionbyuser'] = '';
							$_SESSION['submitCommentVars'][$cid]['originalfilename'] ='';
							$_SESSION['submitCommentVars'][$cid]['previewselpreviewid']=0;
							$_SESSION['submitCommentVars'][$cid]['commenttitle']='';

							$optinemail='';
							$optinip='';
							if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($this->newcommentneedscoi==1)) {
								$optinemail=trim($piVars['email']);
								$optinip=$this->getCurrentIp();
							}

							// check the toctoc_comments_user
							$dataWhereStats = 'deleted= 0 AND pid=' . intval($conf['storagePid']) .
							' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';
							$dataWhereStatsEnable = ' AND approved=1 AND deleted=0 AND hidden=0';

								$dataWhereuser = 'deleted= 0 AND pid=' . intval($conf['storagePid']) .
								' AND toctoc_comments_user = ' . $fetoctocusertoquery . '';
								list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS tusr',
										'tx_toctoc_comments_user', $dataWhereuser);
								if (intval($rowusr['tusr']) === 0) {
									$strCurrentIPres=gethostbyaddr($strCurrentIP);

									$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_user',
											array(
													'crdate' => time(),
													'tstamp' => time(),
													'pid' => $conf['storagePid'],
													'toctoc_comments_user' => $fetoctocusertoinsert,
													'ipresolved' => $strCurrentIPres,
													'ip' => $strCurrentIP,
													'initial_firstname' => trim($piVars['firstname']),
													'initial_lastname' => trim($piVars['lastname']),
													'initial_email' => trim($piVars['email']),
													'initial_homepage' => trim($piVars['homepage']),
													'initial_location' => trim($piVars['location']),
													'optin_email' => $optinemail,
													'optin_ip' => $optinip,
													'comment_count' => 1,
											));
								}

								$sqlstr = 'SELECT COUNT(uid) AS nbrentries FROM tx_toctoc_comments_comments WHERE ' . $dataWhereStats . $dataWhereStatsEnable;
								$resultcount = $GLOBALS['TYPO3_DB']->sql_query($sqlstr);
								$rowStats = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultcount);

								list($rowusrdata) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid,initial_firstname,initial_lastname,initial_email,
										initial_homepage,initial_location',
										'tx_toctoc_comments_user', $dataWhereuser);
								if (intval($rowusrdata['uid']) !== 0) {
									if ($rowusrdata['initial_firstname']==='') {
										$strinitial_firstname='", initial_firstname="' . trim($piVars['firstname']);
									} else {
										$strinitial_firstname='';
									}

									if ($rowusrdata['initial_lastname']==='') {
										$strinitial_lastname='", initial_lastname="' . trim($piVars['lastname']);
									} else {
										$strinitial_lastname='';
									}

									if ($rowusrdata['initial_email']==='') {
										$strinitial_email='", initial_email="' . trim($piVars['email']);
									} else {
										$strinitial_email='';
									}

									if ($rowusrdata['initial_homepage']==='') {
										$strinitial_homepage='", initial_homepage="' . trim($piVars['homepage']);
									} else {
										$strinitial_homepage='';
									}

									if ($rowusrdata['initial_location']==='') {
										$strinitial_location='", initial_location="' . trim($piVars['location']);
									} else {
										$strinitial_location='';
									}

								}

								$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' .
										'comment_count=' . intval($rowStats['nbrentries']) .
										', current_ip="' . $strCurrentIP .
										'", current_firstname="' . trim($piVars['firstname']) .
										'", current_lastname="' . trim($piVars['lastname']) .
										'", current_email="' . trim($piVars['email']) .
										'", optin_email="' . trim($piVars['email']) .
										'", optin_ip="' . $strCurrentIP .
										'", current_homepage="' . trim($piVars['homepage']) .
										'", current_location="' . trim($piVars['location']) .
										$strinitial_firstname . $strinitial_lastname . $strinitial_email . $strinitial_homepage .
										$strinitial_location . '", tstamp_lastupdate=' . time()  .
										' WHERE ' . $dataWhereStats );

							// Update reference index. This will show in theList view that someone refers to external record.
							$refindex = t3lib_div::makeInstance('t3lib_refindex');
							/* @var $refindex t3lib_refindex */
							if (isset($GLOBALS['TCA']['tx_toctoc_comments_comments']['columns'])) {
								$refindex->updateRefIndexTable('tx_toctoc_comments_comments', $newUid);
							}
							$this->newcommentid = intval($newUid);
							// Insert URL (if exists)
							if (($this->newcommentid > 0)) {
								if ((!intval($conf['spamProtect.']['requireApproval']) == 1)) {
									$_SESSION['newcommentid']=$this->newcommentid;
								}
								$_SESSION['lasttimecomment'] = microtime(TRUE);
							}

							// process gender-entries for the anonymous users
							if ($feuserid==0) {
								$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET ' .
										'gender=' . intval($piVars['gender']) .
										' WHERE ' . $dataWhereStats );
							}

							if ($conf['advanced.']['enableUrlLog'] && $this->hasValidItemUrl($piVars)) {
								// See if exists
								$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid,url', 'tx_toctoc_comments_urllog',
										'external_ref=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($external_ref, 'tx_toctoc_comments_urllog') .
										$this->enableFields('tx_toctoc_comments_urllog', $pObj, $fromAjax));
								if (count($rows) == 0) {
									$record = array(
											'crdate' => time(),
											'tstamp' => time(),
											'pid' => intval($conf['storagePid']),
											'external_ref' => $external_ref,
											'external_ref_uid' =>  $testedexternal_ref_uid,
											'url' => $piVars['itemurl'],
									);
									$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_urllog', $record);
									if (isset($GLOBALS['TCA']['tx_toctoc_comments_urllog']['columns'])) {
										$refindex->updateRefIndexTable('tx_toctoc_comments_urllog', $GLOBALS['TYPO3_DB']->sql_insert_id());
									}

								} elseif ($rows[0]['url'] != $piVars['itemurl'] && !$this->isNoCacheUrl($piVars['itemurl'])) {
									$record = array(
											'tstamp' => time(),
											'url' => $piVars['itemurl'],
									);
									$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_urllog', 'uid=' . $rows[0]['uid'], $record);
								}

							}
							if ($feuserid===0) {
								// Set cookies, but only for logged out users (protection of the data of logged in users)
								$cookieaccpeted = intval($_COOKIE['toctoc_comments_pi1_dataProtect']);
								if (($conf['dataProtect.']['setCookie'] == 1) && ($cookieaccpeted == 1)) {
									foreach (array('firstname', 'lastname', 'email', 'location', 'homepage', 'gender') as $field) {
										if ($field == 'gender') {
											setcookie($pObj->prefixId . '_' . $field, $piVars[$field], time() + intval($conf['dataProtect.']['cookieLifetime'])*24*60*60, '/');

										} else {
											setcookie($pObj->prefixId . '_' . $field, base64_encode($piVars[$field]), time() + intval($conf['dataProtect.']['cookieLifetime'])*24*60*60, '/');
										}

									}

									setcookie($pObj->prefixId . '_gimme55', 1, time() + intval($conf['dataProtect.']['cookieLifetime'])*24*60*60, '/');
								}
							}

							if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($this->newcommentneedscoi==1)) {
								$this->sendNotificationEmail($newUid, $plugincacheid, $isSpam, 'coi', $conf, $pObj, $fromAjax, $piVars, $pid,
										$fetoctocusertoinsert, $newattachment_id, $newattachment_subid, $optinemail, 0, $_SESSION['activelang']);
							}

							// See what to do next
							if (!$isApproved) {
								// Show message
								if (!$isApproved) {
									$pObj->formTopMessage .= $this->pi_getLLWrap($pObj, 'requires.approval', $fromAjax);
								}

								if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($this->newcommentneedscoi==1)) {
									$pObj->formTopMessage .= '<br /><span class="txtc-coimsg">' . $this->pi_getLLWrap($pObj, 'requires.coi', $fromAjax) . '</span>';
								}

								$this->sendNotificationEmail($newUid, $plugincacheid, $isSpam, 'approve', $conf, $pObj, $fromAjax, $piVars, $pid,
										$fetoctocusertoinsert, $newattachment_id, $newattachment_subid, '', 0, $_SESSION['activelang']);
								// Clear cache not needed
								unset($_SESSION['requestCapcha'][$cid]);
							} else {
								unset($_SESSION['requestCapcha'][$cid]);
								if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($this->newcommentneedscoi==1)) {
									$pObj->formTopMessage .= '<span class="txtc-coimsg">' . $this->pi_getLLWrap($pObj, 'requires.coi', $fromAjax) . '</span>';
								}

								// Call hook for custom actions (requested by Cyrill Helg)
								$pObj->conf=$conf;
								$piVarsrestore= $pObj->piVars;
								$pObj->piVars=$piVars;
								if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['processValidComment'])) {
									foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['processValidComment'] as $userFunc) {
										$params = array(
												'pObj' => $pObj,
												'uid' => intval($newUid),
										);
										t3lib_div::callUserFunction($userFunc, $params, $pObj);
									}

								}

								$pObj->piVars=$piVarsrestore;

								if (strlen($conf['spamProtect.']['informationEmail']) > 0) {
									$this->sendNotificationEmail($newUid, $plugincacheid, $isSpam, 'info', $conf, $pObj, $fromAjax, $piVars, $pid,
											$fetoctocusertoinsert, $newattachment_id, $newattachment_subid, '', 0, $_SESSION['activelang']);
								}

								// Clear cache of current page, additional pages and app cache
								$plugincacheid=$external_ref;
								if (trim($conf['externalPrefix'])=='pages') {
									$plugincacheid=$testedexternal_ref_uid;
								}

								$this->clearPagesCaches($conf, $pid, $plugincacheid);

								$_SESSION['formTopMessage'] = $pObj->formTopMessage;
							}

						}

					} else {
						// Spam cut off point reached
						$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'error_too_many_spam_points', $fromAjax) . ' (' . $isSpam . '/' . $cutOffPoint . ')';
					}

				}

			}

			if ($pObj->formTopMessage) {

				if ($pObj->formTopMessage!='') {
					$pObj->formTopMessage = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###FORM_TOP_MESSAGE###'),
							array(
									'###MESSAGE###' => $pObj->formTopMessage,
									'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
									'###CID###' => trim($piVars['cid']),
									'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
							)
					);
					$_SESSION['formTopMessage'] = $pObj->formTopMessage;
				}

			}

		}

	}

	/**
	 * Updates a comment
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: pageid
	 * @param	int		$lang: languagecode
	 * @return	void
	 */
	public function updateComment($conf, $pObj, $ctid, $content, $pid, $plugincacheid, $commenttitle = '') {

		//make virtual piVars for function processSubmission_checkTypicalSpam
		$piVsubs= array();
		// 20130627 comment content is base64_encoded, so we need to decode it here and set the $content such it will result in decoded content
		$piVsubs['content']=base64_decode($content);
		$content=$piVsubs['content'];
		$strCurrentIP = $this->getCurrentIp();
		$requiredFields = t3lib_div::trimExplode(',', $conf['requiredFields'], TRUE);
		$useFields = t3lib_div::trimExplode(',', $conf['useFieldsSequence'], TRUE);
		$requiredcommenttitle = in_array('commenttitle', $requiredFields) ? TRUE : FALSE;
		$usecommenttitle = in_array('commenttitle', $useFields) ? TRUE : FALSE;
		if ($usecommenttitle) {
			$piVsubs['commenttitle']=base64_decode($commenttitle);
			$commenttitle=$piVsubs['commenttitle'];
			$record = array(
				'content' => trim(substr($piVsubs['content'], 0, $conf['maxCommentLength'])),
				'remote_addr' => $strCurrentIP,
				'commenttitle' => $piVsubs['commenttitle'],
			);
			if ($commenttitle == '')  {
				if ($requiredcommenttitle) {
					$record = array(
						'content' => trim(substr($piVsubs['content'], 0, $conf['maxCommentLength'])),
						'remote_addr' => $strCurrentIP,
					);
				}
			}
		} else {
			$record = array(
				'content' => trim(substr($piVsubs['content'], 0, $conf['maxCommentLength'])),
				'remote_addr' => $strCurrentIP,
			);
		}

		$pObj->conf=$conf;
		$isSpam = $this->processSubmission_checkTypicalSpam($pObj, $conf, $piVsubs, $_SESSION['activelangid'], TRUE);
		$cutOffPoint = $conf['spamProtect.']['spamCutOffPoint'] ? $conf['spamProtect.']['spamCutOffPoint'] : $isSpam + 1;
		if ($isSpam < $cutOffPoint) {
			$record['tstamp'] = time();
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $ctid, $record);
			// Clear cache after update with plugin
			$this->initCaches();
			$this->clearPagesCaches($conf, $pid, $plugincacheid);

			$pObj->formTopMessage='';
			$_SESSION['formTopMessage'] = $pObj->formTopMessage;

		} else {
			// Spam cut off point reached
			$rowsin = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('content',
					'tx_toctoc_comments_comments', 'uid=' . $ctid);
			$content =$rowsin[0]['content'];

		}

		$outputstr='';
		if ($pObj->formTopMessage) {

			if ($pObj->formTopMessage!='') {
				$pObj->formTopMessage = $this->t3substituteMarkerArray($this->t3getSubpart($pObj, $pObj->templateCode, '###FORM_TOP_MESSAGE###'),
						array(
								'###MESSAGE###' => $pObj->formTopMessage,
								'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
								'###CID###' => $plugincacheid,
								'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
						)
				);
				$outputstr= $pObj->formTopMessage;
			}

		}

		//Parse for Links and Smilies
		$this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
				$conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);
		$content=htmlspecialchars($content);
		$contenttext = $this->applyStdWrap(nl2br($this->createLinks($content, $conf)), 'content_stdWrap', $conf);
		$contenttext = $this->replaceSmilies($contenttext, $conf);
		$contenttext =$this->replaceBBs($contenttext, $pObj, $conf, FALSE);
		$contenttext = $this->makeemoji($contenttext, $conf, 'updateComment');

		$contenttext =$this->addleadingspace($contenttext);

		$outputstr .= $contenttext;
		return $outputstr;

	}
	/**
	 * IP-blocking functions, Spam checking
	 *
	 *
	 */

	/**
	 * Checks ip blocking lists and sets spam points to a high value if IP address
	 * is found in spam lists.
	 *
	 * @param	array		$params	Parameters to the function
	 * @param	tx_comments_pi1		$pObj	Parent object
	 * @return	int		Number of spam points
	 * @see	tx_comments_pi1::processSubmission_checkTypicalSpam()
	 */
	protected function IPBlockSpamCheck(&$pObj) {
		$points = 0;
		$ipaddr = $this->getIpAddr();
		if ($pObj->conf['spamProtect.']['spamCutOffPoint'] && ($this->checkTableBLs($ipaddr, FALSE, $pObj) || $this->checkNetworkBLs($ipaddr, FALSE, $pObj))) {
			$points = $pObj->conf['spamProtect.']['spamCutOffPoint'] + 1;
		}

		return $points;
	}

	/**
	 * Adds new markers to notification e-mail.
	 *
	 * @param	array		$params	Parameters to the function
	 * @param	tx_comments_pi1		$pObj	Parent object
	 * @return	int		Number of spam points
	 * @see	tx_comments_pi1::sendNotificationEmail()
	 */
	protected function sendNotificationIPBlock($params) {
		$markers = $params['markers'];
		$markers['###DELETE_LINK_AND_BLOCK###'] = $markers['###DELETE_LINK###'] . '&ip=' . ip2long($this->getIpAddr());
		$markers['###KILL_LINK_AND_BLOCK###'] = $markers['###KILL_LINK###'] . '&ip=' . ip2long($this->getIpAddr());
		return $markers;
	}

	/**
	 * checks if mail server is up
	 *
	 * @param	string		$hostname: ...
	 * @param	string		$port: ...
	 * @param	[type]		$confcheckSMTPService: ...
	 * @return	boolean		TRUE if online
	 */
	protected function checkSMTPService($hostname, $port, $confcheckSMTPService = 0) {
		// Create a socket.  If we fail to create a socket return FALSE
		// This is really more to check that we are able to create a socket
		// than if we are able to check the server
		if ($confcheckSMTPService == 1) {
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			if($socket === FALSE) return FALSE;

			// Now we will connect to the server.  If we fail we return FALSE.
			$result = socket_connect($socket, $hostname, $port);
			if($result === FALSE) return FALSE;
		}

		return TRUE;

	}

	/**
	 * Retrieves real ip address of the client
	 *
	 * @return	string		IP address
	 */
	public function getIpAddr() {
		$ipaddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
		if ($ipaddr && long2ip(ip2long($ipaddr)) == $ipaddr && !preg_match('/^127\.0|192\.168\.|172\.16\.|10\./', $ipaddr)) {
			return $ipaddr;
		}

		$retstr = t3lib_div::getIndpEnv('REMOTE_ADDR');
		return $retstr;
	}

	/**
	 * Checks table-based blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @param	[type]		$checksiteblock: ...
	 * @param	[type]		$pObj: ...
	 * @return	boolean		TRUE if exists in the list
	 */
	public function checkTableBLs($ipaddr = '', $checksiteblock = FALSE, $pObj) {
		$this->hitip = '';
		$this->hitipcomment = '';
		if ($ipaddr == '') {
			$ipaddr = $this->getIpAddr();
		}
		$retstr = $this->checkLocalBL($ipaddr, $checksiteblock, $pObj) || $this->checkStaticBL($ipaddr, $checksiteblock, $pObj);
		return $retstr;
	}

	/**
	 * Checks local blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @param	[type]		$checksiteblock: ...
	 * @param	[type]		$pObj: ...
	 * @return	boolean		TRUE if exists in the list
	 */
	private function checkLocalBL($ipaddr, $checksiteblock = FALSE, $pObj) {
		$parts = explode('.', $ipaddr);
		$blockfe = '';
		if ($checksiteblock == TRUE) {
			$blockfe = 'blockfe=1 AND ';
		}

		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('ipaddr, comment', 'tx_toctoc_comments_ipbl_local',
				$blockfe . 'ipaddr LIKE ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($parts[0] . '.' . $parts[1] . '.%', 'tx_toctoc_comments_ipbl_static'));

		foreach ($recs as $rec) {
			list($addr, $mask) = explode('/', $rec['ipaddr']);
			if ($mask == '') {
				if ($addr == $ipaddr) {
					$pObj->hitip = $rec['ipaddr'];
					$pObj->hitipcomment = $rec['comment'];
					return TRUE;
				}

			} else {
				$mask = 0xFFFFFFFF << (32 - $mask);
				if (long2ip(ip2long($ipaddr) & $mask) == $addr) {
					$pObj->hitip = $rec['ipaddr'];
					$pObj->hitipcomment = $rec['comment'];
					return TRUE;
				}

			}

		}

		return FALSE;
	}

	/**
	 * Checks static blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @param	[type]		$checksiteblock: ...
	 * @param	[type]		$pObj: ...
	 * @return	boolean		TRUE if exists in the list
	 */
	private function checkStaticBL($ipaddr, $checksiteblock = FALSE, $pObj) {
		$parts = explode('.', $ipaddr);
		$retblockfe = TRUE;
		if ($checksiteblock == TRUE) {
			$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
			$retblockfe = FALSE;
			if ($extConf['useSpamhausBlocklistForWebsiteBan'] == 1) {
				$retblockfe = TRUE;
			}

		}
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('ipaddr, comment', 'tx_toctoc_comments_ipbl_static',
				'ipaddr LIKE ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($parts[0] . '.' . $parts[1] . '.%', 'tx_toctoc_comments_ipbl_static'));
		foreach ($recs as $rec) {
			list($addr, $mask) = explode('/', $rec['ipaddr']);
			if ($mask == '') {
				if ($addr == $ipaddr) {
					$pObj->hitip = $rec['ipaddr'];
					$pObj->hitipcomment = $rec['comment'];
					return $retblockfe;
				}

			} else {
				$mask = 0xFFFFFFFF << (32 - $mask);
				if (long2ip(ip2long($ipaddr) & $mask) == $addr) {
					$pObj->hitip = $rec['ipaddr'];
					$pObj->hitipcomment = $rec['comment'];
					return $retblockfe;
				}

			}

		}

		return FALSE;
	}

	/**
	 * Checks network blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	boolean		TRUE if exists in the list
	 */
	private function checkNetworkBLs($ipaddr) {
		$parts = explode('.', $ipaddr);
		$ipaddr = $parts[3] . '.' . $parts[2] . '.' .$parts[1] . '.' .$parts[0];
		$sysconf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		$parts = t3lib_div::trimExplode(',', $sysconf['dnsbl_list'], TRUE);
		foreach ($parts as $dnsbl) {
			if (substr(gethostbyname($ipaddr . '.' . $dnsbl), 0, 8) == '127.0.0.') {
				return TRUE;
			}

		}

		return FALSE;
	}
	/**
	 * Checks for typical spam scenarios
	 *
	 * @param	object		$pObj:
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	int		$lang: sys_lnaguage_uid needed to access spamwords in current language
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @return	int		Number of points. Considered as spam if more than zero
	 */
	protected function processSubmission_checkTypicalSpam($pObj, $conf, $piVars, $lang, $fromAjax) {

		$points = 0;

		if ($conf['spamProtect.']['checkTypicalSpam']) {
			// Typical BB-style spam: "[url="
			$points += intval(count(explode('[url=', $piVars['content'])))-1;

			// Many links
			$points += intval(count(explode('http://', $piVars['content'])))-1;
			$points += intval(count(explode('www', $piVars['content'])))-1;

			$testcontnt= $piVars['content'];
			// \n in the fields where it cannot appear due to form definition
			foreach (array('commenttitle', 'firstname', 'lastname', 'email', 'homepage', 'location') as $key) {
				$points += (strpos($piVars[$key], chr(10)) !== FALSE ? 1 : 0);
				if ($key != 'homepage') {
					$points += (strpos($piVars[$key], 'http://') !== FALSE ? 1 : 0);
				}

				$testcontnt .= ',' . $piVars[$key];
			}

			// Check referer - not reliable because firewals block it or browsers may forget to send it
			if ($conf['considerReferer']) {
				$parts1 = parse_url(t3lib_div::getIndpEnv('HTTP_REFERER'));
				$parts2 = parse_url(t3lib_div::getIndpEnv('HTTP_HOST'));
				$points += ($parts1['host'] != $parts2['host']);
			}

			// CHECK THE SPAMWORDS TABLE
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('spamword,spamvalue', 'tx_toctoc_comments_spamwords',
					'sys_language_uid=-1 OR sys_language_uid=' . $lang .
					$this->enableFields('tx_toctoc_comments_spamwords', $pObj, $fromAjax));

			if (count($rows) > 0) {
				foreach($rows as $key) {
					$points += (intval(count(explode($key['spamword'], $piVars['content'])))-1)*$key['spamvalue'];
				}

			}

		}

		if ($conf['spamProtect.']['useIPblocking']==1) {
			$points += $this->IPBlockSpamCheck($pObj);
		}

		// External spam checkers
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['externalSpamCheck'])) {
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['externalSpamCheck'] as $_funcRef) {
				$params = array(
						'pObj' => $pObj,
						'formdata' => $piVars,
						'points' => $points,
				);
				$points += t3lib_div::callUserFunction($_funcRef, $params, $pObj);
			}

		}

		return $points;
	}

	/**
	 * Validates submitted form. Errors are collected in <code>$this->formValidationErrors</code>
	 *
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	boolean		TRUE, if form is ok.
	 */
	protected function processSubmission_validate($piVars, $conf, $pObj, $fromAjax) {
		// trim all
		foreach ($piVars as $key => $value) {
			$piVars[$key] = trim($value);
		}

		// Check required fields first
		$requiredFields = t3lib_div::trimExplode(',', 'email, lastname,' . $conf['requiredFields'], TRUE);
		$errfound= FALSE;
		foreach ($requiredFields as $field) {
			if (!$piVars[$field]) {
				$_SESSION['formValidationErrors'][$field] = $this->pi_getLLWrap($pObj, 'error.required.field', $fromAjax);
				$_SESSION['formValidationErrors']['errorcode'] = '12';
				$errfound= TRUE;

			}

		}

		// Validate e-mail
		if ($piVars['email'] && !t3lib_div::validEmail($piVars['email'])) {
			$_SESSION['formValidationErrors']['email'] = $this->pi_getLLWrap($pObj, 'error.invalid.email', $fromAjax);
			$_SESSION['formValidationErrors']['errorcode'] = '13';
			$errfound= TRUE;

		}

		if ($piVars['email'] == 'badmailadress@nosite.net') {
			$_SESSION['formValidationErrors']['email'] = $this->pi_getLLWrap($pObj, 'error.invalid.useremail', $fromAjax);
			$_SESSION['formValidationErrors']['errorcode'] = '14';
			$errfound= TRUE;
		}

		// Check spam: captcha
		$captchaType = intval($conf['spamProtect.']['useCaptcha']);
		if ($captchaType > 0) {
			if ($_SESSION['requestCapcha'][$_SESSION['submittedCid']] == 2) {
				$sessvar = 'random_number' . $_SESSION['submittedCid'];
				if ($_SESSION[$sessvar] == '') {
					$pObj->formTopMessage = '';
				}

				if (!$errfound) {
					unset($_SESSION['requestCapcha'][$_SESSION['submittedCid']]);
				}

			} else {
				$_SESSION['requestCapcha'][$_SESSION['submittedCid']] = 1;
				$this->formTopMessage = 'Validation: ' . $this->pi_getLLWrap($pObj, 'pi1_template.captchaInputNeeded', $fromAjax);
			}

		}

		return $errfound;
	}


	/**
	 * E-mail notification
	 *
	 *
	 */

	/**
	 * Sends notification e-mail about new comment
	 *
	 * @param	int		$uid	UID of new comment
	 * @param	int		$points	Number of earned spam points
	 * @param	int		$action	what to do, 'info' or 'approve'
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	int		$pid: pageid
	 * @param	string		$fetoctocusertoinsert: ...
	 * @param	int		$attachment_id: ...
	 * @param	int		$attachment_subid: ...
	 * @param	string		$optinemail: email adress to use for coi
	 * @param	[type]		$ratingpageid: ...
	 * @return	void
	 */
	public function sendNotificationEmail($uid, $plugincacheid, $points, $action, $conf, $pObj, $fromAjax, $piVars, $pid, $fetoctocusertoinsert,
			$attachment_id=0, $attachment_subid=0, $optinemail='', $ratingpageid=0, $langajax = '') {

		// there's a special call coming from pi2, the pObj is not the same and function params are properly misused:
		// $this->lib->sendNotificationEmail(0, 0, 0, 'adminconfirmsignup', $confpi1, $this, TRUE, $row, $GLOBALS['TSFE']->id,
 		//							$GLOBALS['TSFE']->page['title'], $requrl, 0, '', 0, $langajax);
		if (($fromAjax)) {
			$language = &$GLOBALS['LANG'];

			if ($langajax == '') {
				$language->init('default');
			} else {
				$language->init($langajax);
			}

			$lang = $GLOBALS['LANG']->lang;
		} else {
			$language = t3lib_div::makeInstance('language');
			$language->init($GLOBALS['TSFE']->lang);
			$lang = $GLOBALS['TSFE']->lang;
		}

		if ($action == 'info') {
			$toEmail = $conf['spamProtect.']['informationEmail'];
		} else {
			$toEmail = $conf['spamProtect.']['notificationEmail'];
		}

		$fromEmail = $conf['spamProtect.']['fromEmail'];
		$attachmentinfoHTML = '';
		$hasattachement = FALSE;
		if ($action != 'adminconfirmsignup') {
			$hasattachement = TRUE;
			if ($attachment_id != 0) {
				$attachmentinfoHTML = $this->commentShowWebpagepreview ($attachment_id, $attachment_subid, $conf, $pObj, $uid, FALSE, $fromAjax, array(), TRUE);
				if ($attachmentinfoHTML == '') {
					$attachmentinfoHTML = $this->pi_getLLWrap($pObj, 'email.attachment_mmnotfounderror', $fromAjax) . ' ' . $attachment_id;
					$hasattachement = FALSE;
				}

			} else {
				$attachmentinfoHTML = $this->pi_getLLWrap($pObj, 'email.noattachmentforcomment', $fromAjax);
				$hasattachement = FALSE;
			}

			if (!$conf['HTMLEmail']) {
				if ($hasattachement == TRUE) {
					$attachmentinfoHTML = $this->pi_getLLWrap($pObj, 'email.commenthasattachment', $fromAjax);
				} else {
					$attachmentinfoHTML = $this->pi_getLLWrap($pObj, 'email.noattachmentforcomment', $fromAjax);
				}

			}

		}

		$check = md5($uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);

		if ($action != 'adminconfirmsignup') {
	 		$clearCacheIds = $this->getClearCacheIds($conf, $pid, FALSE);
			$clearCachePlugins = $plugincacheid;

			if ($_SESSION['commentsPageTitles'][$pid] == '') {
				$pageTitle =$_SESSION['commentsPageIdsClean'][$pid];
			} else {
				$pageTitle =$_SESSION['commentsPageTitles'][$pid];
			}

			$linktocomment = $_SESSION['commentsPageIdsClean'][$pid];
			if (isset($_SESSION['commentsPageIdsTypolinks'][$pid][$uid])) {
				$linktocomment=$_SESSION['commentsPageIdsTypolinks'][$pid][$uid];
			} else {
				$linktocomment = '';
			}

			if (($conf['spamProtect.']['confirmedOptIn'] == 1) && ($optinemail != '')) {
				if ($conf['HTMLEmail']) {
					$confencarrcoi =array(
							'advanced.' => array(
								'notificationForCommentatorEmail' => $conf['advanced.']['notificationForCommentatorEmail'],
								'notificationForCommentatorHTMLEmailTemplate' => $conf['advanced.']['notificationForCommentatorHTMLEmailTemplate'],
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
							),
							'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
							'pageURL' => $_SESSION['commentsPageIdsClean'][$pid],
							'pageURLhotlink' => $linktocomment,
							'storagePid' => $conf['storagePid'],
							'HTMLEmail' => $conf['HTMLEmail'],
							'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
							'aP' => $conf['recentcomments.']['anchorPre'],
							'optinemail' => $optinemail,
							'optin_ip' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'plugin' => $plugincacheid,
							'notificationLevel' => $conf['advanced.']['notificationLevel'],
							'notificationValidDays' => $conf['advanced.']['notificationValidDays'],

					);
				} else {
					$confencarrcoi =array(
							'advanced.' => array(
								'notificationForCommentatorEmail' => $conf['advanced.']['notificationForCommentatorEmail'],
								'notificationForCommentatorEmailTemplate' => $conf['advanced.']['notificationForCommentatorEmailTemplate'],
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
							),
							'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
							'pageURL' => $_SESSION['commentsPageIdsClean'][$pid],
							'pageURLhotlink' => $linktocomment,
							'storagePid' => $conf['storagePid'],
							'HTMLEmail' => $conf['HTMLEmail'],
							'aP' => $conf['recentcomments.']['anchorPre'],
							'optinemail' => $optinemail,
							'optin_ip' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'plugin' => $plugincacheid,
							'notificationLevel' => $conf['advanced.']['notificationLevel'],
							'notificationValidDays' => $conf['advanced.']['notificationValidDays'],
					);
				}

				$confenccoi = rawurlencode(base64_encode(serialize($confencarrcoi)));
				$record = array(
						'mailconf' => $confenccoi,
				);

				$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_cache_mailconf', $record);
				$confenccoi = $GLOBALS['TYPO3_DB']->sql_insert_id();

			}

			if ($conf['HTMLEmail']) {
				$confencarr =array(
						'advanced.' => array(
								'notificationForCommentatorEmail' => $conf['advanced.']['notificationForCommentatorEmail'],
								'notificationForCommentatorHTMLEmailTemplate' => $conf['advanced.']['notificationForCommentatorHTMLEmailTemplate'],
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
						),
						'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
						'pageURL' => $_SESSION['commentsPageIdsClean'][$pid],
						'pageURLhotlink' => $linktocomment,
						'aP' => $conf['recentcomments.']['anchorPre'],
						'storagePid' => $conf['storagePid'],
						'HTMLEmail' => $conf['HTMLEmail'],
						'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
						'plugin' => $plugincacheid,
						'vmcNPC' => intval($conf['vmcNoPageCache']),
						'notificationLevel' => $conf['advanced.']['notificationLevel'],
						'notificationValidDays' => $conf['advanced.']['notificationValidDays'],
				);
			} else {
				$confencarr =array(
						'advanced.' => array(
								'notificationForCommentatorEmail' => $conf['advanced.']['notificationForCommentatorEmail'],
								'notificationForCommentatorEmailTemplate' => $conf['advanced.']['notificationForCommentatorEmailTemplate'],
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
						),
						'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
						'pageURL' => $_SESSION['commentsPageIdsClean'][$pid],
						'pageURLhotlink' => $linktocomment,
						'aP' => $conf['recentcomments.']['anchorPre'],
						'storagePid' => $conf['storagePid'],
						'HTMLEmail' => $conf['HTMLEmail'],
						'plugin' => $plugincacheid,
						'vmcNPC' => intval($conf['vmcNoPageCache']),
						'notificationLevel' => $conf['advanced.']['notificationLevel'],
						'notificationValidDays' => $conf['advanced.']['notificationValidDays'],
				);
			}
			$confenc = rawurlencode(base64_encode(serialize($confencarr)));

		}

		if ($action == 'adminconfirmsignup') {
			$attachment_id = str_replace('?&tx_toctoccomments_pi2[signup]=1', '', $attachment_id);
			$attachment_id = str_replace('?tx_toctoccomments_pi2[signup]=1', '', $attachment_id);
			$attachment_id = str_replace('&tx_toctoccomments_pi2[signup]=1', '', $attachment_id);
			if ($conf['HTMLEmail']) {
				$confencadminconfirmsignup=array(
						'advanced.' => array(
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
								'notificationForNewUserEmail' => $conf['advanced.']['notificationForNewUserEmail'],
								'notificationForNewUserHTMLEmailTemplate' => $conf['advanced.']['notificationForNewUserHTMLEmailTemplate'],
						),
						'pageTitle' => $fetoctocusertoinsert,
						'pageURL' => $attachment_id,
						'storagePid' => $conf['storagePid'],
						'HTMLEmail' => $conf['HTMLEmail'],
						'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
						'newuseruid' => $piVars['uid'],
						'newuserusername' => $piVars['username'],
						'newuserfirst_name' => $piVars['first_name'],
						'newuserlast_name' => $piVars['last_name'],
						'newuserlast_email' => $piVars['email'],
				);
			} else {
				$confencadminconfirmsignup=array(
						'advanced.' => array(
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
								'notificationForNewUserEmail' => $conf['advanced.']['notificationForNewUserEmail'],
								'notificationForNewUserHTMLEmailTemplate' => $conf['advanced.']['notificationForNewUserHTMLEmailTemplate'],
						),
						'pageTitle' => $fetoctocusertoinsert,
						'pageURL' => $attachment_id,
						'storagePid' => $conf['storagePid'],
						'HTMLEmail' => $conf['HTMLEmail'],
						'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
						'newuseruid' => $piVars['uid'],
						'newuserusername' => $piVars['username'],
						'newuserfirst_name' => $piVars['first_name'],
						'newuserlast_name' => $piVars['last_name'],
						'newuserlast_email' => $piVars['email'],
				);
			}
			$confenc = rawurlencode(base64_encode(serialize($confencadminconfirmsignup)));
		}

		$record = array(
				'mailconf' => $confenc,
		);

		$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_cache_mailconf', $record);
		$confenc = $GLOBALS['TYPO3_DB']->sql_insert_id();

		$approvelinkcoi = '';
		$seperatorchar = ' - ';

		if (!($this->cObj)) {
			$this->cObj = t3lib_div::makeInstance('tslib_cObj');
			$this->cObj->start('', '');
		}

		if ($action == 'adminconfirmsignup') {
			if ($conf['HTMLEmail']) {
				$seperatorchar = '<br />';
				$approvelinkadminconfirmsignup = '<b><a class="approvelink" href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' .
						$uid . '&chk=' . $check .
						'&lng=' . $lang . '&clearCache=' . urlencode(0) .
							'&cmd=approveadminconfirmsignup&confenc=' . $confenc) . '">' .
				$pObj->pi_getLL('email.textapprovenewuser') .'</a></b>';

				$deletelinkadminconfirmsignup = '<a href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' .
						$check . '&lng=' . $lang .
						'&clearCache=' . urlencode(0) . '&cmd=deleteadminconfirmsignup&confenc=' . $confenc) . '">' .
						$pObj->pi_getLL('email.textdeletenewuser') . '</a>';

			} else {
				$approvelinkadminconfirmsignup = $pObj->pi_getLL('email.textapprovenewuser') . ' ' .
						t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' .
								urlencode(0) .
								'&cmd=approveadminconfirmsignup&confenc=' . $confenc);

				$deletelinkadminconfirmsignup = $pObj->pi_getLL('email.textdeletenewuser') . ' ' .
						t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' .
						$uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode(0) .
								'&cmd=deleteadminconfirmsignup&confenc=' . $confenc);
			}

		} else {
			if ($conf['HTMLEmail']) {
				$seperatorchar = '<br />';
				$approvelink = '<b><a class="approvelink" href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check .
						'&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) .
						'&cmd=approve&confenc=' . $confenc) . '">' . $this->pi_getLLWrap($pObj, 'email.textapprovecomment', $fromAjax) .'</a></b>';
				$approvelinkcoi = '<b><a class="approvelink" href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check .
						'&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) .
						'&cmd=approvecoi&confenc=' . $confenccoi) . '">' . $this->pi_getLLWrap($pObj, 'email.textapprovecoicomment', $fromAjax) .'</a></b>';

				$deletelink = '<a href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang .
						'&clearCache=' . urlencode($clearCacheIds) . '&cmd=delete&confenc=' . $confenc) . '">' .
						$this->pi_getLLWrap($pObj, 'email.textdeletecomment', $fromAjax) . '</a>';

				$killlink = ' | <a href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang .
						'&clearCache=' . urlencode($clearCacheIds) . '&cmd=kill&confenc=' . $confenc) . '">' .
						$this->pi_getLLWrap($pObj, 'email.textkillcomment', $fromAjax) . '</a>';

			} else {
				$approvelink = $this->pi_getLLWrap($pObj, 'email.textapprovecomment', $fromAjax) . ' ' .
						t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' .
								urlencode($clearCacheIds) .
								'&cmd=approve&confenc=' . $confenc);
				$approvelinkcoi = $this->pi_getLLWrap($pObj, 'email.textapprovecoicomment', $fromAjax) . ' ' .
						t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' .
								urlencode($clearCacheIds) .
								'&cmd=approvecoi&confenc=' . $confenccoi);

				$deletelink = $this->pi_getLLWrap($pObj, 'email.textdeletecomment', $fromAjax) . ' ' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' .
						$uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=delete&confenc=' . $confenc);

				$killlink = $this->pi_getLLWrap($pObj, 'email.textkillcomment', $fromAjax) . ' ' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' .
						$uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=kill&confenc=' . $confenc);
			}
		}

		if ($action != 'adminconfirmsignup') {

			$userinfo ='';
			$requiredFields = t3lib_div::trimExplode(',', $conf['requiredFields'], TRUE);
			$userinfo .= ($piVars['commenttitle']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.commenttitle', $fromAjax) . ' ' . $piVars['commenttitle'] .
			$seperatorchar : '';
			$userinfo .= ($piVars['firstname']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax) . ' ' . $piVars['firstname'] . $seperatorchar : '';
			$userinfo .= ($piVars['lastname']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax) . ' ' . $piVars['lastname'] . $seperatorchar : '';
			$userinfo .= ($piVars['email']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax) . ' ' . $piVars['email'] . $seperatorchar : '';
			$userinfo .= ($piVars['location']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax) . ' ' . $piVars['location'] . $seperatorchar : '';
			$userinfo .= ($piVars['homepage']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax) . ' ' . $piVars['homepage'] . $seperatorchar : '';
			if ($action=='rating') {
				$userinfo ='';
				//get comment
				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('content, firstname, lastname, email, location, homepage',
						'tx_toctoc_comments_comments', 'uid =' . $uid);
				$userinfo .= ($row['commenttitle']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.commenttitle', $fromAjax) . ' ' . $row['commenttitle'] .
				$seperatorchar : '';
				$userinfo .= ($row['firstname']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax) . ' ' . $row['firstname'] . $seperatorchar : '';
				$userinfo .= ($row['lastname']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax) . ' ' . $row['lastname'] . $seperatorchar : '';
				$userinfo .= ($row['email']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax) . ' ' . $row['email'] . $seperatorchar : '';
				$userinfo .= ($row['location']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax) . ' ' . $row['location'] . $seperatorchar : '';
				$userinfo .= ($row['homepage']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax) . ' ' . $row['homepage'] . $seperatorchar : '';
				$contentdislike = $row['content'];
			}
			$contentformail=$piVars['content'];
		}
		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];

		//now, now, now we get the user-infos so the admin knows bit more about the commentator
		$infoleft='';
		if ($action != 'adminconfirmsignup') {
			if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($optinemail!='')) {
				if ($conf['HTMLEmail']) {
					$infoleft='<b>' . $this->pi_getLLWrap($pObj, 'pi1_template.informationaboutyou', $fromAjax) . '</b><br />' . $this->getUserCard('',
							$fetoctocusertoinsert, $conf, $pObj, $uid);
					$infoleft=str_replace('src="https://', 'src="http://', $infoleft);
					$URLinfo =  $this->pi_getLLWrap($pObj, 'email.textnewcoi', $fromAjax) . ' ' . $_SESSION['commentsPageIdsClean'][$pid] . '.<br /> ' .
					$this->pi_getLLWrap($pObj, 'email.textemailrequiresyourconfirmation', $fromAjax);
					$contentformail=$this->replaceBBs($piVars['content'], $pObj, $conf, FALSE);
					$contentformail =$this->addleadingspace($contentformail);
					$saveconfemoji=$conf['advanced.']['useEmoji'];

					$conf['advanced.']['useEmoji']=0;
					$contentformail = $this->makeemoji($contentformail, $conf, 'sendNotificationEmail');

					$conf['advanced.']['useEmoji']=$saveconfemoji;
				} else {

					$URLinfo =  $this->pi_getLLWrap($pObj, 'email.textnewcoi', $fromAjax) . ' ' . $_SESSION['commentsPageIdsClean'][$pid] . '. ' .
					$this->pi_getLLWrap($pObj, 'email.textemailrequiresyourconfirmation', $fromAjax);

				}

				if ($conf['HTMLEmail']) {
					$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplatecoiHTML']);

				} else {
					$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplatecoi']);
				}

				$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
				if ($fromAjax) {
					$template = @file_get_contents(PATH_site . $usetemplateFile);
				} else {
					$template = $this->t3fileResource($pObj, $usetemplateFile);
				}
				$myhomepagetypoLink_URL = str_replace('https:', 'http:', $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''), 'ATagParams' => 'rel="nofollow"',)));
				$markers = array(
						'###URL###' =>  $URLinfo,
						'###USER###' => $userinfo,
						'###CONTENT###' =>  $contentformail,
						'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax),
						'###APPROVE_LINK###' => $approvelinkcoi,
						'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
						'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.coiemail', $fromAjax),
						'###INFOSLEFT###'  => $infoleft,
						'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
						'###MYHOMEPAGE###'  => $myhomepagelink,
						'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
						'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
						'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
						'###ATTACHMENT###'  => $attachmentinfoHTML,
				);
				$content = $this->t3substituteMarkerArray($template, $markers);
				if ($conf['spamProtect.']['fromEmailName'] == '') {
					$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - Administrator';
				} else {
					$sendername = str_replace('%site%', $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'], $conf['spamProtect.']['fromEmailName']);
				}

				if (t3lib_div::validEmail($optinemail) && t3lib_div::validEmail($fromEmail)) {
					if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
						self::send_mail($optinemail, $this->pi_getLLWrap($pObj, 'email.subjectcoi', $fromAjax), '', $content,
								$conf['spamProtect.']['fromEmail'], $sendername, $conf['spamProtect.']['checkSMTPService']);
					} else {		// ... else just plain text...
						t3lib_div::plainMailEncoded($optinemail, $this->pi_getLLWrap($pObj, 'email.subjectcoi', $fromAjax), $content,
						'From: ' . $conf['spamProtect.']['fromEmail']);
					}

				}

			}
		}

		if (($action=='approve') || ($action=='info') || ($action=='rating') || ($action == 'adminconfirmsignup')) {
			if (t3lib_div::validEmail($toEmail) && t3lib_div::validEmail($fromEmail)) {
				if ($action != 'adminconfirmsignup') {
					$contentformail=$piVars['content'];
				}

				if ($action=='rating') {

					$contentformail=$contentdislike;
					$contentformailtext = str_replace('%s', $conf['ratings.']['dlikeCtsNotifLvl'], $this->pi_getLLWrap($pObj, 'pi1_template.informationjustobtaineddislikes', FALSE));
					$contentformail= '<b>'. $contentformailtext.'</b><br />' . $contentformail;
				}
				if ($action != 'adminconfirmsignup') {
					if ($conf['HTMLEmail']) {
						$confwrk = $conf;
						$confwrk['userContactUC'] = 1;
						$confwrk['userHomepageUC'] =1;
						$confwrk['userEmailUC'] = 1;
						$confwrk['userLocationUC'] =1;
						$confwrk['userStatsUC'] = 1;
						$confwrk['userIPUC'] = 1;

						if (!isset($this->cObj)) {
							$this->cObj = t3lib_div::makeInstance('tslib_cObj');
							$this->cObj->start('', '');
						}

						if ($action=='rating') {
							$infoleft='<b>' . $this->pi_getLLWrap($pObj, 'pi1_template.informationaboutdislikeevaluator', $fromAjax) . '</b><br />' .
							$this->getUserCard('', $fetoctocusertoinsert, $confwrk, $pObj, $uid);
						} else {
							$infoleft='<b>' . $this->pi_getLLWrap($pObj, 'pi1_template.informationaboutcommentator', $fromAjax) . '</b><br />' .
							$this->getUserCard('', $fetoctocusertoinsert, $confwrk, $pObj, $uid);
						}

						$infoleft=str_replace('src="https://', 'src="http://', $infoleft);

						$contentformail=$this->replaceBBs($contentformail, $pObj, $conf, FALSE);
						$contentformail =$this->addleadingspace($contentformail);
						$saveconfemoji=$conf['advanced.']['useEmoji'];

						$conf['advanced.']['useEmoji']=0;
						$contentformail = $this->makeemoji($contentformail, $conf, 'sendNotificationEmail2');

						$conf['advanced.']['useEmoji']=$saveconfemoji;
					}

					$coiinfo='';
					if ($this->newcommentneedscoi==1) {
						$coiinfo=$this->pi_getLLWrap($pObj, 'email.textrequirescoi', $fromAjax);
					}

				}

				$myhomepagetypoLink_URL = str_replace('https:', 'http:', $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''),
						'ATagParams' => 'rel="nofollow"',)));

				if ($action == 'info') {
					if ($conf['HTMLEmail']) {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateHTML']);

					} else {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateInfo']);
					}

					$usetemplateFile = str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
					if ($fromAjax) {
						$template = @file_get_contents(PATH_site . $usetemplateFile);
					} else {
						$template = $this->t3fileResource($pObj, $usetemplateFile);
					}

					if ($_SESSION['commentsPageTitles'][$pid] == '') {
						$pagename = $_SESSION['commentsPageIdsClean'][$pid];
					} else {
						$pagename = $_SESSION['commentsPageTitles'][$pid];
					}

					$urlofcommentpage = $_SESSION['commentsPageIdsClean'][$pid];
					if (isset($_SESSION['commentsPageIdsTypolinks'][$pid][$uid])) {
						$urlofcomment = '<a href="' . $_SESSION['commentsPageIdsTypolinks'][$pid][$uid] . '">' .
								$pagename . '</a>';
					} else {
						$urlofcomment = '<a href="' . $_SESSION['commentsPageIdsClean'][$pid]  . $conf['recentcomments.']['anchorPre'] . $uid . '">' .
							$pagename . '</a>';

					}

					$markers = array(
							'###URL###' =>  $this->pi_getLLWrap($pObj, 'email.textnewcomment', $fromAjax) . ' ' . $urlofcomment . '. ' .
							$this->pi_getLLWrap($pObj, 'email.textnotrequiresyourapproval', $fromAjax) . '. ',
							'###POINTS###' =>
							$this->pi_getLLWrap($pObj, 'email.textitgot', $fromAjax) . ' ' . $points . ' ' .
							$this->pi_getLLWrap($pObj, 'email.textspampoints', $fromAjax) . '. ' . $coiinfo,
							'###USER###' => $userinfo,
							'###CONTENT###' =>  $contentformail,
							'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax),
							'###REMOTE_ADDR###' => $this->pi_getLLWrap($pObj, 'email.textpostedfromip', $fromAjax) . ' ' . t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'###DELETE_LINK###' => $deletelink,
							'###KILL_LINK###' => $killlink,
							'###APPROVE_LINK###' => '',
							'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.notificationemail', $fromAjax),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###MYHOMEPAGELINK###'  =>$myhomepagetypoLink_URL,
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###ATTACHMENT###'  => $attachmentinfoHTML,
					);
				} elseif ($action == 'approve') {
					if ($conf['HTMLEmail']) {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateHTML']);
					} else {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplate']);
					}

					$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
					if ($fromAjax) {
						$template = @file_get_contents(PATH_site . $usetemplateFile);
					} else {
						$template = $this->t3fileResource($pObj, $usetemplateFile);
					}

					$markers = array(
							'###URL###' =>  $this->pi_getLLWrap($pObj, 'email.textnewcomment', $fromAjax) . ' ' . $_SESSION['commentsPageIdsClean'][$pid] . '. ' .
							$this->pi_getLLWrap($pObj, 'email.textrequiresyourapproval', $fromAjax) . '. ',
							'###POINTS###' => $this->pi_getLLWrap($pObj, 'email.textitgot', $fromAjax) . ' ' . $points  .
							' ' . $this->pi_getLLWrap($pObj, 'email.textspampoints', $fromAjax) . '. ' . $coiinfo,
							'###USER###' => $userinfo,
							'###CONTENT###' =>  $contentformail,
							'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax),
							'###REMOTE_ADDR###' => $this->pi_getLLWrap($pObj, 'email.textpostedfromip', $fromAjax) . ' ' . t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'###APPROVE_LINK###' => $approvelink,
							'###DELETE_LINK###' => $deletelink,
							'###KILL_LINK###' => $killlink,
							'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.approvalemail', $fromAjax),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###ATTACHMENT###'  => $attachmentinfoHTML,
					);
				}  elseif ($action == 'adminconfirmsignup') {
					if ($conf['HTMLEmail']) {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateSignupConfirmHTML']);
					} else {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateSignupConfirm']);
					}

					$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
					if ($fromAjax) {
						$template = @file_get_contents(PATH_site . $usetemplateFile);
					} else {
						$template = $this->t3fileResource($pObj, $usetemplateFile);
					}

					if (substr($piVars['username'], 0, 6) == 'google') {
						$piusername = $pObj->pi_getLL('email.textconfirmationfornewusergoogle');
					} elseif (substr($piVars['username'], 0, 6) == 'facebo') {
						$piusername = $pObj->pi_getLL('email.textconfirmationfornewuserfacebook');
					} else {
						$piusername = $piVars['username'];
					}

					$contentformail = '<b>' . $pObj->pi_getLL('email.textconfirmationfornewuser') . ' ' . piusername .'</b><br />';

					$userinfo='';
					$userinfo .= ($piVars['first_name']!='') ? $pObj->pi_getLL('firstname') . ' ' . $piVars['first_name'] . $seperatorchar : '';
					$userinfo .= ($piVars['last_name']!='') ? $pObj->pi_getLL('lastname') . ' ' . $piVars['last_name'] . $seperatorchar : '';
					$userinfo .= ($piVars['email']!='') ? $pObj->pi_getLL('email') . ' ' . $piVars['email'] . $seperatorchar : '';
					$userinfo .= ($piVars['username']!='') ? $pObj->pi_getLL('username') . ' ' . $piVars['username'] . $seperatorchar : '';

					$infoleft='';
					$rmoteadr = $pObj->pi_getLL('email.textsignedupfromip') . ' ' . t3lib_div::getIndpEnv('REMOTE_ADDR');
					$siteRelPath = $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments');
					$markers = array(
							'###USER###' => $userinfo,
							'###CONTENT###' =>  $contentformail,
							'###TEXTCONTENT###' => '',
							'###REMOTE_ADDR###' => $rmoteadr,
							'###APPROVE_LINK###' => $approvelinkadminconfirmsignup,
							'###DELETE_LINK###' => $deletelinkadminconfirmsignup,
							'###SITE_REL_PATH###' => $siteRelPath,
							'###MESSAGETYPE###'  => $pObj->pi_getLL('email.approvalsignupemail'),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					);

				}  else {
					//rating
					if ($conf['HTMLEmail']) {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateDislikeHTML']);
					} else {
						$usetemplateFile = str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['spamProtect.']['emailTemplateDislike']);
					}

					$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
					if ($fromAjax) {
						$template = @file_get_contents(PATH_site . $usetemplateFile);
					} else {
						$template = $this->t3fileResource($pObj, $usetemplateFile);
					}

					if (isset($_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id][$ratingpageid])) {
						$urlofcomment='<a href="' . $_SESSION['commentsPageIdsTypolinks'][$GLOBALS['TSFE']->id][$ratingpageid] . '">' .
								$_SESSION['commentsPageTitles'][$ratingpageid] . '</a>';
					} else {
						$urlofcommentpage = $_SESSION['commentsPageIdsClean'][$ratingpageid];
						$qssep= '?';
						$urlofcomment='<a href="' . $urlofcommentpage . $conf['recentcomments.']['anchorPre'].$uid . '">' .
						$_SESSION['commentsPageTitles'][$ratingpageid] . '</a>';
					}

					$markers = array(
							'###INTROTEXT###' => $this->pi_getLLWrap($pObj, 'email.textdislikeoncomment', $fromAjax),
							'###URL###' =>  $urlofcomment,
							'###USER###' => $userinfo,
							'###CONTENT###' =>  $contentformail,
							'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax),
							'###REMOTE_ADDR###' => $this->pi_getLLWrap($pObj, 'email.textpostedfromip', $fromAjax) . ' ' . t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.dislikeemail', $fromAjax),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					);
				}

				// Call hook for custom markers
				if ($action != 'adminconfirmsignup') {
					$pObj->conf=$conf;
					$params = array(
							'pObj' => $pObj,
							'template' => $template,
							'check' => $check,
							'markers' => $markers,
							'uid' => $uid
					);
					if (is_array($tempMarkers = $this->sendNotificationIPBlock($params))) {
								$markers = $tempMarkers;
					}

					if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['sendNotificationMail'])) {
						foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['sendNotificationMail'] as $userFunc) {
							if ($userFunc != 'comments_response') {
								$params = array(
										'pObj' => $pObj,
										'template' => $template,
										'check' => $check,
										'markers' => $markers,
										'uid' => $uid
								);
								if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
									$markers = $tempMarkers;
								}

							}

						}

					}

					$blockanddeletelink = $this->pi_getLLWrap($pObj, 'email.textdeleteblock', $fromAjax);
					$blockandkilllink = $this->pi_getLLWrap($pObj, 'email.textkillblock', $fromAjax);

					$markers['###DELETE_LINK_AND_BLOCK###'] = str_replace($this->pi_getLLWrap($pObj, 'email.textdeletecomment', $fromAjax), '',
							$markers['###DELETE_LINK_AND_BLOCK###'] );
					$markers['###KILL_LINK_AND_BLOCK###'] = str_replace($this->pi_getLLWrap($pObj, 'email.textkillcomment', $fromAjax), '',
							$markers['###KILL_LINK_AND_BLOCK###'] );
					if ($conf['HTMLEmail']) {
						$markers['###DELETE_LINK_AND_BLOCK###'] = str_replace('"></a>', '', $markers['###DELETE_LINK_AND_BLOCK###']);
						$markers['###KILL_LINK_AND_BLOCK###'] = str_replace('"></a>', '', $markers['###KILL_LINK_AND_BLOCK###']);
						$markers['###DELETE_LINK_AND_BLOCK###'] = ' | ' . $markers['###DELETE_LINK_AND_BLOCK###'] . '">' . $blockanddeletelink . '</a>';
						$markers['###KILL_LINK_AND_BLOCK###'] = $markers['###KILL_LINK_AND_BLOCK###']. '">' . $blockandkilllink . '</a>';
						$markers['###KILL_LINK###'] = str_replace('|', '', $markers['###KILL_LINK###']);
						$markers['###KILL_LINK###'] ='| ' . $markers['###KILL_LINK###'];
						$markers['###DELETE_LINK###'] = str_replace('|', '', $markers['###DELETE_LINK###']);
					} else {
						$markers['###DELETE_LINK_AND_BLOCK###'] = $blockanddeletelink . $markers['###DELETE_LINK_AND_BLOCK###'];
						$markers['###KILL_LINK_AND_BLOCK###'] = $blockandkilllink . $markers['###KILL_LINK_AND_BLOCK###'];

					}

				} else {
					if ($conf['HTMLEmail']) {
							$markers['###DELETE_LINK###'] = str_replace('|', '', $markers['###DELETE_LINK###']);
					}

				}

				if ($action != 'adminconfirmsignup') {
					if ((intval($conf['advanced.']['adminCommentResponse']) == 1)) {
						//post-handle response to the comment:
						$strrespondlink = $this->pi_getLLWrap($pObj, 'email.textresponsetothecomment', $fromAjax);
						$markers['###RESPOND_LINK###'] = t3lib_div::locationHeaderUrl(
								'index.php?eID=toctoc_comments' .
								'&uid=' . $uid .
								'&chk=' . $check .
								'&cmd=respond' .
								'&confenc=' . $confenc .
								'&lng=' . $lang .
								'&clearCache=' . $pid
						);

						if (trim($markers['###RESPOND_LINK###']) !='') {
							if ($conf['HTMLEmail']) {
								$strrespondlink = str_replace(':', '', $strrespondlink);
								$markers['###RESPOND_LINK###'] = '<br /><a rel="nofollow" href="' . $markers['###RESPOND_LINK###'] . '">' . $strrespondlink . '</a>';

							} else {
								$markers['###RESPOND_LINK###'] = '\\n' . $strrespondlink . ' ' . $markers['###RESPOND_LINK###'];
							}

						}

					} else {
						$markers['###RESPOND_LINK###'] = '';
					}

				}

				if ((intval($conf['advanced.']['adminCommentResponse']) == 0)) {
					$markers['###RESPOND_LINK###'] = '';
				}

				if ($action == 'adminconfirmsignup') {
					$subjecttext = $pObj->pi_getLL('email.subjectadminconfirmsignup');
				} else {
					$subjecttext = $this->pi_getLLWrap($pObj, 'email.subject', $fromAjax);
					if ($action == 'rating') {
						$subjecttext = $this->pi_getLLWrap($pObj, 'email.subjectdislike', $fromAjax);
					}

				}

				$content = $this->t3substituteMarkerArray($template, $markers);
				if ($conf['spamProtect.']['fromEmailName'] == '') {
					$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - toctoc_comments Administrator';
				} else {
					$sendername = str_replace('%site%', $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'], $conf['spamProtect.']['fromEmailName']);
				}

				if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
					self::send_mail($toEmail, $subjecttext, '', $content, $conf['spamProtect.']['fromEmail'], $sendername, $conf['spamProtect.']['checkSMTPService']);
				} else {		// ... else just plain text...
					t3lib_div::plainMailEncoded($toEmail, $subjecttext, $content, 'From: ' . $conf['spamProtect.']['fromEmail']);
				}

			}

		}

	}

	/**
	 * Performs database actions for email confirmation optIn by user
	 *
	 * @param	string		$optinemail: email sent by eID
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	string		$optin_ip: ip sent by eID
	 * @return	array		0 on error, empty array if no approved comment is found, else the comment-row of the newest approved comment
	 */
	protected function emailOptIn($conf, $optinemail, $optin_ip) {
		// update all entries of this email in tx_toctoc_comments_user, so the user can be marked all COIed from whatever IP he will post (and posted already before)
		// noramlly theres one one entry

		$strCurrentIP = $this->getCurrentIp();
		$dataWhereuser = 'pid=' . intval($conf['storagePid']) .
		' AND deleted=0 AND optin_email = "' . $optinemail . '" AND optindate =0 AND optin_ip="' . $optin_ip . '"';
		$rowusr = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'tx_toctoc_comments_user', $dataWhereuser);
		if (count($rowusr) > 0) {
			$ttusersarr=array();
			$tt=0;
			$firstcrdate=$rowusr[0]['crdate'];
			$ttusersarr[0] = $rowusr[0]['toctoc_comments_user'];
			// get toctoc_user_ids and first crdate to compare with comments
			$countrowusr=count($rowusr);
			for ($i=0; $i<$countrowusr; $i++) {
				if ($ttusersarr[$tt] != $rowusr[$i]['toctoc_comments_user'] ) {
					$tt++;
					$ttusersarr[$tt] = $rowusr[$i]['toctoc_comments_user'];
				}

				if ($firstcrdate > $rowusr[$i]['crdate'] ) {
					$firstcrdate = $rowusr[$i]['crdate'];
				}

			}

			$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' .
					'optindate=' . time() .
					', optin_ip="' . $strCurrentIP .
					'", tstamp_lastupdate=' . time()  .
					' WHERE ' . $dataWhereuser );

			if (count($ttusersarr) == 1) {
				// 99% of all cases
				$userlist = '= "' . $ttusersarr[0] .'"';
			} else {
				$userlist = 'IN ("' . implode('", "', $ttusersarr) .'")';
			}

			$dataWhereComments='pid=' . intval($conf['storagePid']) .
			' AND hidden=1 AND deleted=0 AND toctoc_comments_user ' . $userlist . ' AND crdate >= ' . $firstcrdate;
			$rowcmts = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_comments', $dataWhereComments, '', 'crdate');
			//check if already approved
			$approved=0;
			$linkto_comment_id=array();
			if (count($rowcmts) > 0) {
				$countrowcmts=count($rowcmts);
				for ($i=0; $i<$countrowcmts; $i++) {
					if ($approved != $rowcmts[$i]['approved'] ) {
						$approved=1;
						$linkto_comment_id=$rowcmts[$i];
					}

				}

				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET ' .
						'hidden=0' .
						' WHERE ' . $dataWhereComments );
				return $linkto_comment_id;
			}

		}

		return FALSE;
	}

	/**
	 * Checks if confirmed email optin is needed for a given email and IP
	 *
	 * @param	array		$conf:
	 * @param	string		$email: email to check
	 * @param	boolean		$checkip: if IP needs to be checked
	 * @return	boolean		TRUE if coi is needed
	 */
	protected function checkCOI($conf, $email, $checkip=TRUE) {
		$strCurrentIP = $this->getCurrentIp();

		$optin_ip='';
		if ($checkip) {
			$optin_ip = ' AND optin_ip="' . $strCurrentIP . '"';
		}

		$dataWhereuser = 'pid=' . intval($conf['storagePid']) .
		' AND deleted=0 AND optin_email = "' . $email . '" AND optindate >0' . $optin_ip;
		$rowusr = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'tx_toctoc_comments_user', $dataWhereuser);
		if (count($rowusr) > 0) {
			//made optin from currentIP if $checkip=TRUE, else IP does not matter
			return 0;
		}

		return 1;
	}

	/**
	 * language handling functions
	 *
	 *
	 */

	/**
	 * This function is workaround for a bug {@link http://bugs.typo3.org/view.php?id=7154 #7154}.
	 * This plugin uses dot characters in labels, this causes problems when someone
	 * tries to override labels from TS setup. It is possible to fix this by changing dots
	 * to underscopes but this will invalidate all translations + any existing TS template.
	 * Thus this functions converts array back to dotted string.
	 *
	 * @param	array		$conf: plugin configuration
	 * @return	void
	 */
	public function fixLL(&$conf) {
		if (isset($conf['_LOCAL_LANG.'])) {
			// Walk each language
			foreach ($conf['_LOCAL_LANG.'] as $lang => $LL) {
				// If any label is set...
				if (count($LL)) {
					$ll = array();
					$this->fixLL_internal($LL, $ll);
					$conf['_LOCAL_LANG.'][$lang] = $ll;
				}

			}

		}

	}

	/**
	 * Helper function for fixLL. Called recursively.
	 *
	 * @param	array		$LL	Current array
	 * @param	array		$ll	Result array
	 * @param	string		$prefix	Prefix
	 * @return	void
	 */
	protected function fixLL_internal($LL, &$ll, $prefix = '') {
		while (list($key, $val) = each($LL)) {
			if (is_array($val))	{
				$this->fixLL_internal($val, $ll, $prefix . $key);
			} else {
				$ll[$prefix.$key] = $val;
			}

		}

	}

	/**
	 * mostly formatting functions
	 *
	 *
	 */

	/**
	 * Creates links from "http://..." or "www...." phrases.
	 *
	 * @param	string		$text	Text to search for links
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Text to convert
	 */
	protected function createLinks($text, $conf) {
		if ($conf['advanced.']['autoConvertLinks']) {
			$textout=
			preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" class="tx-tc-external-autolink">\1</a>', $text);
			$textout= str_replace('." rel="nofollow"', '" rel="nofollow"', $textout);
			$textout= str_replace('," rel="nofollow"', '" rel="nofollow"', $textout);
			$textout= str_replace(',</a>', '</a>,', $textout);
			$textout= str_replace('.</a>', '</a>.', $textout);
			$textoutarr=explode('tx-tc-external-autolink">', $textout);
			$textworkarr=array();
			$counttextoutarr = count($textoutarr);
			if ($counttextoutarr > 1) {

				for ($i=0; $i<$counttextoutarr; $i++) {
					$textoutarr2 = explode('</a>', $textoutarr[$i]);
					$counttextoutarr2 = count($textoutarr2);
					if (str_replace('a href', '', $textoutarr[$i]) == $textoutarr[$i]) {
						if ($counttextoutarr2 > 0) {

							if (strlen($textoutarr2[0]) > $conf['advanced.']['autoConvertLinksCropLength']) {
								$beginstr = substr($textoutarr2[0], 0, 2*(intval($conf['advanced.']['autoConvertLinksCropLength'])/3)-2);
								$endstr = substr($textoutarr2[0], -((intval($conf['advanced.']['autoConvertLinksCropLength'])/3)-1));
								$textoutarr2[0] = $beginstr . '...' . $endstr;
								$textworkarr[$i] =implode('</a>', $textoutarr2);
							}	else {
								$textworkarr[$i] = $textoutarr[$i];
							}

						} else {
							$textworkarr[$i] = $textoutarr[$i];
						}

					} else {
						$textworkarr[$i] = $textoutarr[$i];
					}
				}
				$textout=implode('tx-tc-external-autolink">', $textworkarr);
			}

		} else {
			$textout=$text;
		}

		return $textout;
	}

	/**
	 * Applies stdWrap to given text
	 *
	 * @param	string		$text	Text to apply stdWrap to
	 * @param	string		$stdWrapName	Name for the stdWrap in $conf
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	string		Wrapped text
	 */
	protected function applyStdWrap($text, $stdWrapName, $conf = NULL) {
		$retstr=$text;
		if (is_array($conf[$stdWrapName . '.'])) {
			if ($conf[$stdWrapName. '.']['wrap']) {
				$arrWrap=explode('|', $conf[$stdWrapName. '.']['wrap']);
				if (is_array($arrWrap)) {
					$retstr=$arrWrap[0] . $text .$arrWrap[1];
				}

			}

		}

		return $retstr;
	}

	/**
	 * Checks and processes custom function codes.
	 *
	 * @param	string		$code	Code
	 * @param	object		$pObj: parent object
	 * @return	string		HTML code
	 */
	protected function checkCustomFunctionCodes($code, $pObj) {
		// Call hook
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['customFunctionCode'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['customFunctionCode'] as $userFunc) {
				$params = array(
						'pObj' => $pObj,
						'code' => $code,
				);
				if (($html = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
					return $html;
				}

			}

		}

		return '';
	}

	/**
	 * Checks if this URL is "no_cache" URL
	 *
	 * @param	string		$url	URL
	 * @return	boolean		TRUE if URL is "no_cache" URL
	 */
	protected function isNoCacheUrl($url) {
		$parts = parse_url($url);
		// Brute force
		if (preg_match('/(^|&)no_cache=1/', $parts['query'])) {
			return TRUE;
		}

		// Ideally we should have checked for alternative methods but they require TSFE
		// to be passed and therefore corrupted. So we do not do it now until we discover
		// how to make it without corrupting TSFE.
		return FALSE;
	}

	/**
	 * Replaces $this->cObj->substituteArrayMarkerCached() because substitued
	 * function polutes cache_hash table a lot.
	 *
	 * @param	string		$template	Template
	 * @param	array		$markers	Markers
	 * @param	array		$subparts	Subparts
	 * @return	string		HTML
	 */
	protected function substituteMarkersAndSubparts($template, array $markers, array $subparts, $pObj) {
		$content = $this->t3substituteMarkerArray($template, $markers);
		if (count($subparts) > 0) {
			foreach ($subparts as $name => $subpart) {
				$this->trackdebug('0 t3substituteSubpart');
				$content = $pObj->cObj->substituteSubpart($content, $name, $subpart);
				$this->trackdebug('0 t3substituteSubpart');
			}

		}

		return $content;
	}

	/**
	 * session and cache functions
	 *
	 *
	 */

	/**
	 * resets Sessionvariables in different reset contexts
	 *
	 * @param	string		$resetcontext	0,1,...
	 * @param	boolean		$alsoajaxvar: reset AJAX-Sessionvaribles as well
	 * @return	boolean		TRUE
	 */
	public function resetSessionVars($resetcontext, $alsoajaxvar = TRUE) {
		if ($resetcontext==0) {
			// quite total init
			$_SESSION['commentListCount'] = 0;
			$_SESSION['findanchorok'] ='0';
			$_SESSION['findanchor'] = '0';

			$_SESSION['commentListRecord']= 0;
			$_SESSION['indexOfSortedCommentsCidList'] = 0;
			$_SESSION['commentsPageId'] =$GLOBALS['TSFE']->id;
			$_SESSION['submittedCid'] = 0;
			if ($alsoajaxvar) {
				$_SESSION['AJAXCid'] = 0;
				$_SESSION['AJAXCidC'] = 0;
				$_SESSION['AJAXCidImg'] = 0;
			}

			$_SESSION['submitJustProcessed'] = '0';
			$_SESSION['formTopMessage'] = '';
			$_SESSION['formValidationErrors'] = array();
			$_SESSION['submitCommentVars'] = array();
			$_SESSION['renderedplugins']=0;
			$_SESSION['renderingdone']=FALSE;

			$_SESSION['processedclearCacheIds']='';
			$_SESSION['runMemCache'] = TRUE;
		} elseif ($resetcontext==1) {
			// remind that submit has been processed
			$_SESSION['submitJustProcessed'] = '1';
		} elseif ($resetcontext==3) {
			// reset all a part from submitted stuff
			$_SESSION['commentListCount'] = 0;
			$_SESSION['commentListRecord']= 0;

			$_SESSION['indexOfSortedCommentsCidList'] = 0;
			if ($GLOBALS['TSFE']->id) {
				$_SESSION['commentsPageId'] =$GLOBALS['TSFE']->id;
			}

		}

		return TRUE;
	}

	/**
	 * Returns a list of pageids on which cache should be cleared.
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pid: ...
	 * @param	[type]		$repectsession: ...
	 * @return	string
	 */
	public function getClearCacheIds($conf, $pid = 0, $repectsession = TRUE) {
		$clearCacheIds=0;
		if ($GLOBALS['TSFE']->id) {
			$clearCacheIds = $GLOBALS['TSFE']->id;
		} else {
			$clearCacheIds = $_SESSION['commentsPageId'];
		}

		if ($pid != 0) {
			$clearCacheIds = $pid;
		}

		$additionalClearCachePages = trim($conf['additionalClearCachePages']);
		//if ($pid == 0) {
			if (!empty($additionalClearCachePages)) {
				if ($clearCacheIds !=0) {
					$clearCacheIds .= ',' . $additionalClearCachePages;
				} else {
					$clearCacheIds = $additionalClearCachePages;
				}

			}

		//}

		if ($_SESSION['commentsPageOrigId']!=0) {
			if ($clearCacheIds !=0) {
				$clearCacheIds .= ',' . $_SESSION['commentsPageOrigId'];
			} else {
				$clearCacheIds = $_SESSION['commentsPageOrigId'];
			}

		}

		$clearCacheIdsarr = array_unique(explode(',', $clearCacheIds));
		if ($repectsession==TRUE) {
			if ($_SESSION['processedclearCacheIds'] != '') {
				$processedclearCacheIdsarr = array_unique(explode(',', $_SESSION['processedclearCacheIds']));
				$clearCacheIdsarr = array_diff($clearCacheIdsarr, $processedclearCacheIdsarr);

			}

			$clearCacheIds = implode(',', $clearCacheIdsarr);
			if ($_SESSION['processedclearCacheIds'] != '') {
				$_SESSION['processedclearCacheIds'] .= ',' . $clearCacheIds;
			} else {
				$_SESSION['processedclearCacheIds'] =$clearCacheIds;
			}

			$clearCacheIdsarr = array_unique(explode(',', $_SESSION['processedclearCacheIds']));
			$_SESSION['processedclearCacheIds'] = implode(',', $clearCacheIdsarr);
		} else {
			$clearCacheIds = implode(',', $clearCacheIdsarr);
		}

		$clearCacheIds=str_replace(' ', '', $clearCacheIds);
		return $clearCacheIds . '';
	}

	/**
	 * Returns a list with external_ref_uids on which session memory cache should be cleared.
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$external_ref_uid: ...
	 * @param	[type]		$repectsession: ...
	 * @return	array
	 */
	protected function getClearCacheExternal_ref_uids($external_ref_uid = '') {
		$clearCachePlugins='';

		if ($external_ref_uid != '') {
			$clearCachePlugins = $external_ref_uid;
		}

		$clearCachePluginsarr = array_unique(explode(',', $clearCachePlugins));
		$clearCachePlugins = implode(',', $clearCachePluginsarr);
			foreach($clearCachePluginsarr as $memexternal_ref_uid) {
			$_SESSION['mcp' . $memexternal_ref_uid]['L' . $_SESSION['activelang'] . 'U' . $_SESSION['currentfeuserid']]=array();
		}
		foreach($clearCachePluginsarr as $memexternal_ref_uid) {
			$_SESSION['mcpdata' . $memexternal_ref_uid]['L' . $_SESSION['activelang'] . 'U' . $_SESSION['currentfeuserid']]=array();
		}

		if ($clearCachePlugins!='') {
			$this->setPluginCacheControlTstamp($clearCachePlugins);
    		}

		return $clearCachePlugins . '';
	}

	/**
	 * Set the timestamp of plugins of $external_ref_uid_list in table tx_toctoc_comments_plugincachecontrol to current value.
	 *
	 * @param	string		$external_ref_uid_list: list of plugins where timestamp must be reset
	 * @return	void
	 */
	public function setPluginCacheControlTstamp ($external_ref_uid_list) {

		$external_ref_uid_arr = explode(',', $external_ref_uid_list);
		$external_ref_uid_arrquoted = array();
		$countexternal_ref_uid_arr = count($external_ref_uid_arr);
		for ($i=0; $i < $countexternal_ref_uid_arr; $i++) {
			$external_ref_uid_arrquoted[$i] = '"' . $external_ref_uid_arr[$i] .'"';
		}

		$external_ref_uid_listquoted = implode(',', $external_ref_uid_arrquoted);

		$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'external_ref_uid',
				'tx_toctoc_comments_plugincachecontrol',
				'external_ref_uid IN (' . $external_ref_uid_listquoted . ')',
				'',
				'',
				''
		);

		$external_ref_uid_arr = explode(',', $external_ref_uid_list);
		if (count($rowsrf) < count($external_ref_uid_arr)) {
			if (count($rowsrf) > 0) {
				$rowrfexternal_ref_uid_arr=array();
				$countrowsrf=count($rowsrf);
				for ($i=0; $i<$countrowsrf; $i++) {
					$rowrfexternal_ref_uid_arr[$i]=$rowsrf[$i]['external_ref_uid'];
				}

				$rowrfexternal_ref_uid_arrinsert = array_diff($external_ref_uid_arr, $rowrfexternal_ref_uid_arr);
				$countrowrfexternal_ref_uid_arrinsert=count($rowrfexternal_ref_uid_arrinsert);
				for ($i=0; $i<$countrowrfexternal_ref_uid_arrinsert; $i++) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_plugincachecontrol',
							array(
									'tstamp' => time(),
									'external_ref_uid' => $rowrfexternal_ref_uid_arrinsert[$i],
							)
					);
				}

				$countrowrfexternal_ref_uid_arr=count($rowrfexternal_ref_uid_arr);
				for ($i=0; $i<$countrowrfexternal_ref_uid_arr; $i++) {
					$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET ' .
							'tstamp=' . time() .
							' WHERE external_ref_uid_="' . $rowrfexternal_ref_uid_arr[$i] . '"');
				}

			} else {
				$countexternal_ref_uid_arr=count($external_ref_uid_arr);
				for ($i=0; $i<$countexternal_ref_uid_arr; $i++) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_plugincachecontrol',
							array(
									'tstamp' => time(),
									'external_ref_uid' => $external_ref_uid_arr[$i],
							)
					);
				}

			}

		} else {
			$countexternal_ref_uid_arr=count($external_ref_uid_arr);
			for ($i=0; $i<$countexternal_ref_uid_arr; $i++) {
				$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET ' .
						'tstamp=' . time() .
						' WHERE external_ref_uid ="' . $external_ref_uid_arr[$i] . '"');
			}

		}

	}
	/**
	 * Reads the cache control table and returns timestamp of last modify of a plugins data
	 *
	 * @param	string		$external_ref_uid: reference to the plugin
	 * @return	int		timestamp or 0
	 */
	public function getPluginCacheControlTstamp ($external_ref_uid) {

		$rowsrf = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'tstamp',
				'tx_toctoc_comments_plugincachecontrol',
				'external_ref_uid="' . $external_ref_uid .'"',
				'',
				'',
				''
		);
		$tstamp=0;
		if (count($rowsrf)>0) {
			$tstamp=$rowsrf[0]['tstamp'];
		}

		return $tstamp;
	}

	/**
	 * inits Caches for TYPO3 v 4.3 to 4.5
	 *
	 * @return	void
	 */
	public function initCaches() {
		if (version_compare(TYPO3_version, '4.6', '<')) {
			t3lib_cache::initializeCachingFramework();
			if (TYPO3_UseCachingFramework) {
				$GLOBALS['typo3CacheManager'] = t3lib_div::makeInstance('t3lib_cache_Manager');
				$GLOBALS['typo3CacheFactory'] = t3lib_div::makeInstance('t3lib_cache_Factory');
				$GLOBALS['typo3CacheManager']->initialize($GLOBALS['typo3CacheManager']);
				if (version_compare(TYPO3_version, '4.3.99', '>')) {
					///TYPO3 4.4-4.5
					try {
						$this->cacheInstance = $GLOBALS['typo3CacheManager']->getCache('cache_hash');
					} catch (t3lib_cache_exception_NoSuchCache $e) {
						$this->cacheInstance = $GLOBALS['typo3CacheFactory']->create(
								'cache_hash',
								$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_hash']['frontend'],
								$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_hash']['backend'],
								$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_hash']['options']
						);
					}

					$GLOBALS['typo3CacheFactory']->setCacheManager($GLOBALS['typo3CacheManager']);
				} else {
					///TYPO3 4.3
					$GLOBALS['typo3CacheFactory']->setCacheManager($GLOBALS['typo3CacheManager']);

					try {
						$this->cacheInstance = $GLOBALS['typo3CacheManager']->getCache('cache_hash');
					} catch (t3lib_cache_exception_NoSuchCache $e) {

						$this->cacheInstance = $GLOBALS['typo3CacheFactory']->create(
								'cache_hash',
								$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['frontend'],
								$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['backend'],
								$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['toctoc_comments_cache']['options']
						);
					}

				}

			}

			t3lib_cache::initPageCache();
			t3lib_cache::initPageSectionCache();
		}

		return '';
	}

	/**
	 * Clears page cache and application cache
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pid: ...
	 * @param	[type]		$plugincacheid: ...
	 * @return	void		...
	 */
	protected function clearPagesCaches($conf, $pid, $plugincacheid) {
		$pidList = explode(',', $this->getClearCacheIds($conf, $pid, FALSE));

		$clearCachePlugins = $this->getClearCacheExternal_ref_uids($plugincacheid);

		if (version_compare(TYPO3_version, '6.0', '<')) {
			t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		} else {
			require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
		}

		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		// the $GLOBALS['TCA']-Patch for eID and FLUX
		if (!(isset($GLOBALS['TCA']))) {
			$GLOBALS['TCA'] = array();
			$GLOBALS['TCA']['tt_content'] = array();
		}

		/* @var $tce t3lib_TCEmain */
		foreach ($pidList as $cpid) {
			if ($cpid != 0) {
					$tce->clear_cacheCmd($cpid);

			}

		}

	}

	/**
	 * Smilie functions
	 *
	 *
	 */

	/**
	 * returns an arry of Smilies for printing use
	 *
	 * @param	array		$data: ...
	 * @return	array		smilie-array
	 */
	public function parseSmilieArray($data) {
		$smilies = array();

		if (is_array($data))
			foreach ($data as $k => $v)
			$smilies[$k] = t3lib_div::trimExplode(' ', $v);

		return $smilies;
	}

	/**
	 * Replaces Smilies with img-HTML-Tag
	 *
	 * @param	string		$content: content
	 * @param	object		$pObj: parent object
	 * @return	string		HTML
	 */
	public function replaceSmilies($content, $conf) {
		foreach ($this->smilies as $path => $smilieArray) {
			foreach ($smilieArray as $smilie) {
				$image = '<img alt="' . $smilie . '" title="' . $path
				. '" src="' . $this->smiliesPath . '/' . $path . '.' . $conf['fileExt'] . '" />';
				$content = str_replace($smilie, $image, $content);
			}

		}

		return $content;
	}

	/**
	 * Checks if cropping length does not hack in a bb-code, if so reduces commentCropLength to part before bb.
	 *
	 * @param	string		$content: content
	 * @param	int		$commentCropLength: planned cropping length
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	array		needed cropping length
	 */
	protected function checkbbcrop($content, $commentCropLength, $conf, $pObj) {

		$bbbrigearr=array();
		$textcroppedleft = substr($content, 0, $commentCropLength+2);
		$bbproximity=100000;
		if (count($this->BBs)==0) {
			$this->getBBCard($conf, $pObj, TRUE);
		}

		$cntBBs=count($this->BBs);
		for ($i=0; $i<$cntBBs; $i=$i+2) {
			$startbbarr= explode($this->BBs[$i][0], $textcroppedleft);
			$endbbarr= explode($this->BBs[$i+1][0], $textcroppedleft);
			if (count($startbbarr) > count($endbbarr)) {
				if (strlen($startbbarr[count($startbbarr)-1])<$bbproximity) {
					$bbproximity=strlen($startbbarr[count($startbbarr)-1]);
					$bbbrigearr[0]=$this->BBs[$i+1][1]; //end tag
					$bbbrigearr[1]=$this->BBs[$i][1]; //start-tag
				}

			}

		}

		return $bbbrigearr;
	}

	/**
	 * Replaces bb-codes with HTML-output
	 *
	 * @param	string		$content: content
	 * @param	object		$pObj: parent object
	 * @param	boolean		$purge: if set to yes bb are dropped
	 * @param	[type]		$purge: ...
	 * @return	string		HTML
	 */
	protected function replaceBBs($content, $pObj, $conf, $purge=FALSE) {

			if (count($this->BBs)==0) {

				$this->getBBCard($conf, $pObj, TRUE);

			}

			$cntBBs=count($this->BBs);
			for ($i=0; $i<$cntBBs; $i++) {
				if (($purge==TRUE)) {
					$content = str_replace($this->BBs[$i][0], '', $content);
				}	else {
					$content = str_replace($this->BBs[$i][0], $this->BBs[$i][1], $content);

				}

			}

			if ($this->allowHTMLTagsInComments) {
				$content=implode('<', explode('&amp;lt;', $content));
				$content=implode('>', explode('&amp;gt;', $content));
				$content=implode("='", explode('=&quot;', $content));
				$content=implode("'>", explode('&quot;>', $content));
			} else {
				$content=implode('&lt;', explode('&amp;lt;', $content));
				$content=implode('&gt;', explode('&amp;gt;', $content));
			}

		return $content;
	}

	/**
	 * functions for the AJAx interface with jQuery/JavaScript
	 *
	 *
	 */

	/**
	 * Returns AJAXData Javascript (or optional, just the AJAXData)
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: storagePid
	 * @param	int		$languagecode: ID of the language
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	int		$cid: ID of the content element
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	boolean		$dataonly: Only return the rawurlencoded AJAXData
	 * @param	[type]		$externalref: ...
	 * @return	string		HTML
	 */
	protected function getAjaxJSData($feuserid, $pid, $languagecode, $conf, $pObj, $cid, $fromAjax, $dataonly=FALSE, $externalref) {

		if (($_SESSION['AJAXCid'] != $cid) || ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $externalref);
				$ajaxDataAttachments = $this->getAjaxDataAttachments($conf, $fromAjax, $pObj);

			} else {

				$ajaxData =$_SESSION['ajaxData'];
				$ajaxDataAttachments =$_SESSION['ajaxDataAttachments'];
			}

            $ajaxDatalogin =  $this->getAjaxLoggedInData('conf', 0);
            $ajaxDatalogout =  $this->getAjaxLoggedInData('conf', 1);
            if ($ajaxDatalogin !='') {
            	$ajaxDataloginstr = '<span id="tx-tc-cADLi-' . $cid . '">';
            	$ajaxDataloginstr .= rawurlencode($ajaxDatalogin);
            	$ajaxDataloginstr .= '</span>';
            } else {
            	$ajaxDataloginstr='';
            }

            if ($ajaxDatalogout !='') {
            	$ajaxDatalogoutstr = '<span id="tx-tc-cADLo-' . $cid . '">';
            	$ajaxDatalogoutstr .= rawurlencode($ajaxDatalogout);
            	$ajaxDatalogoutstr .= '</span>';

            } else {
            	$ajaxDatalogoutstr='';
            }

            $ajaxDataloginSess =  $this->getAjaxLoggedInData('session', 0);
            if ($ajaxDataloginSess !='') {
            	$ajaxDataloginSessstr = '<span id="tx-tc-cADLS-' . $cid . '">';
            	$ajaxDataloginSessstr .= rawurlencode($ajaxDataloginSess);
            	$ajaxDataloginSessstr .= '</span>';
            } else {
            	$ajaxDataloginSessstr='';
            }

            $jsAjaxData = '<span id="tx-tc-cAD-' . $cid . '">';
            $jsAjaxData .= rawurlencode($ajaxData);
            $jsAjaxData .= '</span>';
            $jsAjaxData .= '<span id="tx-tc-cADAtt-' . $cid . '">';
            $jsAjaxData .= rawurlencode($ajaxDataAttachments);
            $jsAjaxData .= '</span>';
			$jsAjaxData .= $ajaxDataloginstr . $ajaxDatalogoutstr . $ajaxDataloginSessstr;
			if ($dataonly) {
				$jsAjaxData =rawurlencode($ajaxData);
			}

			$_SESSION['AJAXCid'] = $cid;
			if (!$fromAjax) {
				$_SESSION['ajaxData'] = $ajaxData;
				$_SESSION['ajaxDataAttachments'] = $ajaxDataAttachments;
			}

			return $jsAjaxData;
		} else {
			return '';
		}

	}
	/**
	 * array_diff_assoc_recursive
	 *
	 * @param	array		$array1:
	 * @param	array		$array2:
	 * @return	array		$difference
	 */
	protected function arraydiffassocrecursive($array1, $array2) {
		$difference=array();
		foreach($array1 as $key => $value) {
			if( is_array($value) ) {
				if( !isset($array2[$key]) || !is_array($array2[$key]) ) {
					$difference[$key] = $value;
				} else {
					$new_diff = $this->arraydiffassocrecursive($value, $array2[$key]);
					if( !empty($new_diff) )
						$difference[$key] = $new_diff;
				}
			} else if( !array_key_exists($key, $array2) || $array2[$key] !== $value ) {
				$difference[$key] = $value;
			}
		}
		return $difference;
	}

	/**
	 * Returns AJAXData
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: storagePid
	 * @param	int		$languagecode: ID of the language
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	int		$cid: ID of the content element
	 * @param	[type]		$ref: ...
	 * @return	string		base64-encoded
	 */
	protected function getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $ref) {
		$confDiff=$this->mirrorconf($conf);
		if (!$feuserid) {
			$feuserid=0;
		}

		$data = serialize(array(
				'feuser' => $feuserid,
				'pid' => $pid,
				'cid' => $cid,
				'conf' => $confDiff,
				'lang' => $languagecode,
				'ref' => $ref,
		));
		$retstr = base64_encode($data);
		return $retstr;
	}
	/**
	 * Mirrors current conf with shadow conf in session, resulting in a difference-array of these confs and therefore resulting in much smaller AJAXData
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	array		$confdiff
	 */
	protected function mirrorconf($conf) {
		unset($confCopy);
		$confCopy = $conf;

		$mirrorconf=unserialize(base64_decode($_SESSION['mirrorconf']));
		// this would generate a too long string for unserialize
		if (isset($mirrorconf['attachments.']['picUploadMaxDimX'])) {
			unset($mirrorconf['attachments.']);
			//unset($mirrorconf['recentcomments.']);
			$mirrorconf['attachments.'] = array();
			// we take useWebpagePreview and webpagePreviewHeight, they are needed on and for submits
			$mirrorconf['attachments.']['webpagePreviewHeight'] = $conf['attachments.']['webpagePreviewHeight'];
			$mirrorconf['attachments.']['useWebpagePreview'] = $conf['attachments.']['useWebpagePreview'];
			// we take zhis also for the top preview
			$mirrorconf['attachments.']['useTopWebpagePreview'] = $conf['attachments.']['useTopWebpagePreview'];
			$mirrorconf['attachments.']['topWebpagePreviewPicture'] = $conf['attachments.']['topWebpagePreviewPicture'];
			// we take zhis for displaying uploadfeatures
			$mirrorconf['attachments.']['usePicUpload'] = $conf['attachments.']['usePicUpload'];
			$mirrorconf['attachments.']['usePdfUpload'] = $conf['attachments.']['usePdfUpload'];
			// need this for coi
			//$mirrorconf['recentcomments.'] = array();
			//$mirrorconf['recentcomments.']['anchorPre'] = $conf['recentcomments.']['anchorPre'];
			unset($mirrorconf['userFunc']);

			$_SESSION['mirrorconf']=base64_encode(serialize($mirrorconf));
		}

		// this would generate a too long string for unserialize
		unset($confCopy['attachments.']);
		//unset($confCopy['recentcomments.']);
		$confCopy['attachments.'] = array();
		// we take useWebpagePreview and webpagePreviewHeight, they are needed on and for submits
		$confCopy['attachments.']['webpagePreviewHeight'] = $conf['attachments.']['webpagePreviewHeight'];
		$confCopy['attachments.']['useWebpagePreview'] = $conf['attachments.']['useWebpagePreview'];
		// we take this also for the top preview
		$confCopy['attachments.']['useTopWebpagePreview'] = $conf['attachments.']['useTopWebpagePreview'];
		$confCopy['attachments.']['topWebpagePreviewPicture'] = $conf['attachments.']['topWebpagePreviewPicture'];
		// we take this for displaying uploadfeatures
		$confCopy['attachments.']['usePicUpload'] = $conf['attachments.']['usePicUpload'];
		$confCopy['attachments.']['usePdfUpload'] = $conf['attachments.']['usePdfUpload'];
		// need this for coi
		//$confCopy['recentcomments.'] = array();
		//$confCopy['recentcomments.']['anchorPre'] = $conf['recentcomments.']['anchorPre'];
		unset($confCopy['userFunc']);

		if (!isset($_SESSION['dontUseMirrorConf'])) {
			$_SESSION['dontUseMirrorConf']=intval($conf['advanced.']['dontUseMirrorConf']);
		}
		if (intval($_SESSION['dontUseMirrorConf']) == 0) {
			$confDiff = $this->arraydiffassocrecursive($confCopy, $mirrorconf);
		} else {
			$confDiff=$confCopy;
		}
		return $confDiff;
	}

	/**
	 * updates feuserid in $_SESSIONs AJAXData
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	[type]		$conf: ...
	 * @return	string		rawurlencode($_SESSION['ajaxData'])
	 */
	protected function updateAjaxData($feuserid, $conf) {

		$dataserialized=base64_decode($_SESSION['ajaxData']);
		$dataarr=unserialize($dataserialized);
		$dataarr['feuser']=$feuserid;
		$confDiff=$this->mirrorconf($conf);
		$dataarr['conf']=$confDiff;
		$data = serialize($dataarr);
		$_SESSION['ajaxData']=base64_encode($data);
		$retstr = rawurlencode($_SESSION['ajaxData']);
		return $retstr;
	}

	/**
	 * Returns AJAXData, specified in confAJAXlogin
	 *
	 * @param	[type]		$forjsvariable: ...
	 * @param	boolean		$outputloginstate: ...
	 * @return	string		base64-encoded
	 */
	protected function getAjaxLoggedInData($forjsvariable, $outputloginstate) {

		if ($forjsvariable=='conf') {
			if ($outputloginstate == 0) {
				$sessionstore='confAJAXlogin';
			} else {
				$sessionstore='confAJAXlogout';
			}

			if (is_array($_SESSION[$sessionstore])) {
				$confCopyo=array();
				$confCopyo = array_merge($_SESSION[$sessionstore]);

			// this would generate a too long string for unserialize

				$data = serialize($confCopyo);
				$retstr = base64_encode($data);
				return $retstr;

			} else {
				return '';
			}

		} else {
			$confCopyo=array();
			if (is_array($_SESSION['commentListIndex'])) {
				$confCopyo['commentListIndex'] = array_replace_recursive($confCopyo, $_SESSION['commentListIndex']);
			}

			if (is_array($_SESSION['ratingsscopesinternalm1table'])) {
				$confCopyo['ratingsscopesinternalm1table'] = array_replace_recursive($confCopyo, $_SESSION['ratingsscopesinternalm1table']);
			}

			$confCopyo['commentsPageId']=$_SESSION['commentsPageId'];
			$confCopyo['commentListCount']= $_SESSION['commentListCount'];
			$confCopyo['activelangid']= $_SESSION['activelangid'];
			$confCopyo['commentListRecord']= $_SESSION['commentListRecord'];
			$confCopyo['findanchorok']= $_SESSION['findanchorok'];
			$confCopyo['newcommentid']=  $_SESSION['newcommentid'];
			if (isset($_SESSION['lastStartpoint'])) {
				if (isset($_SESSION['lastStartpoint'][$_SESSION['commentListCount']])) {
					$confCopyo['lastTotalrows'][$_SESSION['commentListCount']]= $_SESSION['lastTotalrows'][$_SESSION['commentListCount']];
					$confCopyo['lastStartpoint'][$_SESSION['commentListCount']]= $_SESSION['lastStartpoint'][$_SESSION['commentListCount']];
				}

			}

			$data = serialize($confCopyo);
			$retstr = base64_encode($data);
			return $retstr;
		}

	}

	/**
	 * Returns AJAXData for the attachments.
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: storagePid
	 * @param	int		$languagecode: ID of the language
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	int		$cid: ID of the content element
	 * @return	string		base64-encoded
	 */
	protected function getAjaxDataAttachments($conf, $fromAjax, $pObj) {
		unset($confCopy);
		$confCopy = $conf['attachments.'];
		unset($confCopy['userFunc']);
		$data = serialize(array(
				'conf' => $confCopy,
				'awaitgoogle' => base64_encode($this->pi_getLLWrap($pObj, 'pi1_template.awaitgoogle', $fromAjax)),
				'txtimage' => base64_encode($this->pi_getLLWrap($pObj, 'pi1_template.txtimage', $fromAjax)),
				'txtimages' => base64_encode($this->pi_getLLWrap($pObj, 'pi1_template.txtimages', $fromAjax)),
		));
		$retstr = base64_encode($data);
		return $retstr;
	}

	/**
	 * Returns AJAX Data Images Javascript
	 *
	 * @param	int		$cid: Content element ID
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @return	string		HTML
	 */
	protected function getAjaxJSDataCommentImgs($cid, $fromAjax) {
		if (($_SESSION['AJAXCidImg'] !== $cid) || ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxDataImgs();
			} else {
				$ajaxData =$_SESSION['ajaxDataImg'];
			}

			$rudata=rawurlencode($ajaxData);

			$jsAjaxData = '	<span id="tx-tc-cADImg-' . $cid . '">';
			$jsAjaxData .= $rudata;
			$jsAjaxData .= '</span>';

			if (!$fromAjax) {
				$_SESSION['AJAXCidImg'] = $cid;
				$_SESSION['ajaxDataImg'] = $ajaxData;
			}

			return $jsAjaxData;
		} else {
			return '';
		}

	}

	/**
	 * Returns AJAX Data Javascript
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: storagePid
	 * @param	int		$languagecode: ID of the language
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	object		$pObj: parent object
	 * @return	string		HTML
	 */
	protected function getAjaxJSDataComments($cid, $pObj, $fromAjax) {

		if (($_SESSION['AJAXCidC'] !== $cid) || ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxDataComments($pObj);
			} else {
				$ajaxData =$_SESSION['ajaxDataC'];
			}

			$rudata=rawurlencode($ajaxData);

			$jsAjaxData = '	<span id="tx-tc-cADC-' . $cid . '">';
			$jsAjaxData .= '';
			$jsAjaxData .= '</span>';
			$jsAjaxData .= '<span id="tx-tc-cThisData-' . $cid . '">';
			$jsAjaxData .= $rudata;
			$jsAjaxData .= '</span>';

			$_SESSION['AJAXCidC'] = $cid;
			if (!$fromAjax) {
				$_SESSION['ajaxDataC'] = $ajaxData;
			}

			return $jsAjaxData;
		} else {
			return '';
		}

	}

	/**
	 * Returns AJAXData
	 *
	 * @param	object		$pObj: parent object
	 * @param	int		$cid: ID of the content element
	 * @return	string		base64-encoded for comments
	 */
	protected function getAjaxDataComments($pObj) {
		$data = serialize(array(
				'externalUid' => $pObj->externalUid,
				'externalUidString' => $pObj->externalUidString,
				'showUidParam' => $pObj->showUidParam,
				'foreignTableName' => $pObj->foreignTableName,
				'where' => $pObj->where,
				'where_dpck' => $pObj->where_dpck,
		));
		$retstr = base64_encode($data);
		return $retstr;
	}

	/**
	 * Returns AJAXData for images
	 *
	 * @return	string		base64-encoded
	 */
	protected function getAjaxDataImgs() {
		$data = serialize($this->AJAXimages);
		$retstr = base64_encode($data);
		return $retstr;
	}

	/**
	 * URL- and IP-related functions
	 *
	 *
	 */

	/**
	 * Retrieves current IP address
	 *
	 * @return	string		Current IP address
	 */
	public function getCurrentIp() {
		if (preg_match('/^\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * Checks if valid item url is present.
	 * Valid item url is not empty, starts with http:// or https:// and
	 * its checksum match with passed checksum value
	 *
	 * @param	array		$piVars:  Array with pi-Variables
	 * @return	boolean		TRUE if item url is valid
	 */
	public function hasValidItemUrl($piVars) {
		$piVars['itemurl'] = trim($piVars['itemurl']);
		if (!$piVars['itemurl']) {
			return FALSE;
		}

		if (!preg_match('/^https?:\/\//', $piVars['itemurl'])) {
			return FALSE;
		}

		if ($pObj->piVars['itemurlchk'] != md5($piVars['itemurl'] . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'])) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Retrieves default configuration of a plugin, by default toctoc_comments.
	 *
	 * @param	[type]		$pluginkey: ...
	 * @return	array		TypoScript configuration for ratings
	 */
	public function getDefaultConfig($pluginkey='') {
		if ($pluginkey=='') {
			return $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];
		} else {
			return $GLOBALS['TSFE']->tmpl->setup['plugin.'][$pluginkey . '.'];

		}

	}

	/**
	 * Rating functions
	 *
	 *
	 */

	/**
	 * Generates HTML code for displaying ratings.
	 *
	 * @param	string		$ref	Reference
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$pid: storagePid
	 * @param	array		$returnasarray: returned array
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	object		$pObj: parent object
	 * @param	int		$cid: ID of the content element
	 * @return	string		HTML content
	 */
	public function getRatingDisplay($ref, $conf = NULL, $fromAjax = 0, $pid=0, $returnasarray = FALSE, $feuserid = 0, $cmd = 'vote',
			$pObj = NULL, $cid, $fromcomments, $commentspics = array(), $scopeid=0, $isReview = 0, $commentusername = '') {

		// Get template
		if (is_null($conf)) {
			$conf = $this->getDefaultConfig();
		}

		if ($conf['advanced.']['midDot'] != '') {
			$this->middotchar = $conf['advanced.']['midDot'];
		}
		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['ratings.']['ratingsTemplateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);

		if (!$fromAjax) {
		// Normal call
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $pObj->conf['ratings.']['ratingsTemplateFile']);
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
			$template = $this->t3fileResource($pObj, $usetemplateFile);

		} else {
		// Called from ajax
			$template = @file_get_contents(PATH_site . $usetemplateFile);
		}

		if (!$template) {
			t3lib_div::devLog('Unable to load template code from "' . $usetemplateFile . '"', 'toctoc_comments', 3);
			return '';
		}

		//catch
		$refarr=explode('-', $ref);
		$countratingarr = count($refarr);
		if($countratingarr>1) {
			$ref=$refarr[0];

		/* 	if (intval($pObj->externalUid) == 0) {
				$tmpref = str_replace($pObj->externalUidString, '', $ref);
				$refarr=explode('-', $tmpref);
				$countratingarr = count($refarr);
				if($countratingarr>1) {
					$ref=$refarr[0] . $pObj->externalUidString;
				}

			} else {
				if (intval($refarr[($countratingarr-1)]) != 0) {
					$ref=$refarr[0];
				}

			} */

		}

		//endcatch
		if (!$fromAjax) {
			$html =  $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
					$commentspics, $scopeid, $isReview, $commentusername);
		} else {
			$html =  $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
					$commentspics, $scopeid, $isReview, $commentusername);
		}

		$html = $this->getCleanHTML($html);

		return $html;
	}


	/**
	 * Checks if item was already voted by current user
	 *
	 * @param	string		$ref	Reference
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	[type]		$scopeid: ...
	 * @param	[type]		$feuserid: ...
	 * @return	boolean		TRUE if item was voted
	 */
	public function isVoted($ref, $pObj, $scopeid=0, $feuserid=0, $fromAjax) {

			if ($scopeid!=0) {
				$scopeidtxt= ' AND reference_scope=' . $scopeid . ' ';
				$scopeidtxtfeuser_mm= ' AND tx_toctoc_comments_feuser_mm.reference_scope=' . $scopeid . ' ';
			} else {
				$scopeidtxt= ' AND (reference_scope=0) ';
				$scopeidtxtfeuser_mm= ' AND (tx_toctoc_comments_feuser_mm.reference_scope=0) ';
			}

			$feusertoquery =0;
			$fetoctocusertoquery ='';
			$fetoctocusertoinsert='';
			$strCurrentIP = $this->getCurrentIp();
			if (intval($feuserid)<=0) {
				$fetoctocusertoquery ='"' . $strCurrentIP . '.0' . '"';
				$fetoctocusertoinsert = $strCurrentIP . '.0';
			} else {
				$fetoctocusertoquery ='"0.0.0.0.' . $feuserid . '"';
				$fetoctocusertoinsert ='0.0.0.0.' . $feuserid;
			}
			$feusertoquery =  intval($feuserid);
			$recs['myrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('myrating AS myrating',
					'tx_toctoc_comments_feuser_mm',
					'((toctoc_commentsfeuser_feuser = ' . $feusertoquery . ' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
					$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' .
					$scopeidtxtfeuser_mm . ' AND reference="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));
			return ($recs['myrecs'][0]['myrating'] > 0);
	}
	/**
	 * Checks if item was already commented by current user
	 *
	 * @param	string		$ref	Reference
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	int		$feuserid: userid
	 * @return	int		uid of comment, 0 if none
	 */
	public function isCommented($ref, $pObj, $feuserid=0, $fromAjax) {
			$feusertoquery =0;
			$fetoctocusertoquery ='';
			$fetoctocusertoinsert='';
			$ret = 0;
			$strCurrentIP = $this->getCurrentIp();
			if (intval($feuserid)<=0) {
				$fetoctocusertoquery ='"' . $strCurrentIP . '.0' . '"';
				$fetoctocusertoinsert = $strCurrentIP . '.0';
			} else {
				$fetoctocusertoquery ='"0.0.0.0.' . $feuserid . '"';
				$fetoctocusertoinsert ='0.0.0.0.' . $feuserid;
			}

			$feusertoquery =  intval($feuserid);
			$recs['myreview'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('MAX(uid) AS reviewuid',
					'tx_toctoc_comments_comments',
					'((toctoc_commentsfeuser_feuser = ' . $feusertoquery . ' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
					$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' . ' AND external_ref_uid="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_comments', $pObj, $fromAjax));
//  			echo intval($recs['myreview'][0]['reviewuid']) . ', ((toctoc_commentsfeuser_feuser = ' . $feusertoquery . ' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
//  					$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' . ' AND external_ref_uid="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_comments', $pObj, $fromAjax);
			$ret = intval($recs['myreview'][0]['reviewuid']);
			return $ret;
	}

	/**
	 * Calculates image bar width
	 *
	 * @param	int		$rating	Rating value
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	[type]		$isReview: ...
	 * @return	int
	 */
	public function getBarWidth($rating, $conf, $isReview = 0) {
		if ($isReview == 0) {
			$retstr = intval(1+$conf['ratings.']['ratingImageWidth']*$rating);
		} else {
			$retstr = intval(1+$conf['ratings.']['reviewImageWidth']*$rating);
		}
		return $retstr;
	}

	/**
	 * Fetches rating information for $ref
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	object		$pObj: parent object
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	[type]		$scopeid: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$isReview: ...
	 * @param	[type]		$fromcomments: ...
	 * @param	[type]		$reviewfeuserid: ...
	 * @return	array		Array with two values: rating and count, which is calculated rating value and number of votes respectively
	 */
	protected function getRatingInfo($ref, $pObj, $feuserid=-1, $conf, $scopeid=0, $fromAjax, $isReview = 0, $fromcomments = 0, $reviewfeuserid = 0) {
		if ($scopeid!=0) {
			$scopeidtxt= ' AND reference_scope=' . $scopeid . ' ';
			$scopeidtxtfeuser_mm= ' AND tx_toctoc_comments_feuser_mm.reference_scope=' . $scopeid . ' ';
		} else {
			$scopeidtxt= ' AND (reference_scope=0) ';
			$scopeidtxtfeuser_mm= ' AND (tx_toctoc_comments_feuser_mm.reference_scope=0) ';
		}
		if (version_compare(TYPO3_version, '4.6', '<')) {
			$tmpint = t3lib_div::testInt($conf['storagePid']);
		} else {
			$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
		}
		if ($feuserid == -1) {
			if (($isReview == 0) || ($fromcomments == 0)) {
				$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('rating,vote_count',
						'tx_toctoc_ratings_data',
						($tmpint ?
							'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
						$scopeidtxt . ' AND reference=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($ref, 'tx_toctoc_ratings_data') .
						$this->enableFields('tx_toctoc_ratings_data', $pObj, $fromAjax));
				$retstr = (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));

			} else {
				$feusertoquery =0;
				$fetoctocusertoquery ='';
				$fetoctocusertoinsert='';
				$strCurrentIP = $this->getCurrentIp();
				if (intval($reviewfeuserid) == 0) {
					$fetoctocusertoquery ='"' . $strCurrentIP . '.0' . '"';
					$fetoctocusertoinsert = $strCurrentIP . '.0';
				} else {
					$fetoctocusertoquery ='"0.0.0.0.' . $reviewfeuserid . '"';
					$fetoctocusertoinsert ='0.0.0.0.' . $reviewfeuserid;
				}

				$feusertoquery =  intval($reviewfeuserid);
				$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('myrating AS rating, 1 AS vote_count',
						'tx_toctoc_comments_feuser_mm',
						($tmpint ?
								'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') . ' AND ((toctoc_commentsfeuser_feuser = ' . $feusertoquery .
						' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
						$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' .
						$scopeidtxtfeuser_mm . ' AND reference="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));
				$retstr = (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));
				if (count($recs) >0) {
					if (($recs[0]['rating'] == 0) && ($recs[0]['vote_count'] == 1)) {
						$recs[0]['vote_count'] = 0;
					}

				}

				$retstr = (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));

			}

			return $retstr;
		} else {
			$feusertoquery = 0;
			$fetoctocusertoquery = '';
			$fetoctocusertoinsert = '';
			$strCurrentIP = $this->getCurrentIp();
			if (intval($feuserid) == 0) {
				$fetoctocusertoquery = '"' . $strCurrentIP . '.0' . '"';
				$fetoctocusertoinsert = $strCurrentIP . '.0';
			} else {
				$fetoctocusertoquery = '"0.0.0.0.' . $feuserid . '"';
				$fetoctocusertoinsert = '0.0.0.0.' . $feuserid;
			}

			$feusertoquery =  intval($feuserid);
			$recs['myrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('myrating AS myrating, ilike AS ilike, idislike AS idislike ',
					'tx_toctoc_comments_feuser_mm',
					($tmpint ?
							'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') . ' AND ((toctoc_commentsfeuser_feuser = ' . $feusertoquery .
					' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' .
					$fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' .
					$scopeidtxtfeuser_mm . ' AND reference="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));

			$recs['myrecs'] = (count($recs) ? $recs['myrecs'] : array('myrating' => 0, 'ilike' => 0, 'idislike' => 0));

			if (($isReview == 1) && ($fromcomments == 0) && ($feuserid == 0)) {
				$recs['myrecs'] = array('myrating' => 0, 'ilike' => 0, 'idislike' => 0);
			}

			$recs['allrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(ilike) AS totalilikes, SUM(idislike) AS totalidislikes ',
					'tx_toctoc_comments_feuser_mm',
					($tmpint ?
						'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') . ' AND reference="' . $ref . '"'.
					$scopeidtxtfeuser_mm . $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));

			$commentidcandidate=str_replace('tx_toctoc_comments_comments_', '', $ref);
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($commentidcandidate);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($commentidcandidate);
			}

			if ($tmpint) {
				$commentidcandidate=intval($commentidcandidate);

				$recs['comment'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('crdate AS commentdate, uid as commentuid, firstname as commentfirstname, lastname as commentlastname',
						'tx_toctoc_comments_comments',
						($tmpint ?
						'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
						' AND uid=' . $commentidcandidate . $this->enableFields('tx_toctoc_comments_comments', $pObj, $fromAjax));
				if ($conf['advanced.']['showCountCommentViews'] ==1){
					$recs['commentviews'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(seen) AS commentviews',
							'tx_toctoc_comments_feuser_mm',
							($tmpint ?
						'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
							' AND seen>0 AND reference="tx_toctoc_comments_comments_' . $commentidcandidate . '" '.
							$this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax));
				} else {
					$recs['commentviews'] = array(
						'commentviews' => 0, );
				}

			} else {
				$recs['comment'] = array(
						'commentdate' => 0,
						'commentlastname' => '',
						'commentfirstname' => '',
						'commentuid' => 0,);
				$recs['commentviews'] = array(
						'commentviews' => 0, );
			}

			$recs['ilikeusers'] = array();
			if (($recs['allrecs'][0]['totalilikes']>1) || (($recs['allrecs'][0]['totalilikes']>0) && ($recs['allrecs'][0]['ilike']==0))) {
				$userswhere =($tmpint ?
						'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
						' AND tx_toctoc_comments_feuser_mm.pid=tx_toctoc_comments_user.pid AND ' . ($tmpint ?
						'tx_toctoc_comments_user.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_user.pid IN (' . $conf['storagePid'] . ')') .
				' AND tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
				$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery .
				' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' .
				$fetoctocusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
				$userswhere .=$scopeidtxtfeuser_mm . ' AND ilike = 1 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax);
				$recs['ilikeusers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'toctoc_commentsfeuser_feuser, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
							ilike AS usersilike, ipresolved, CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END AS current_firstname,
						    CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END AS current_lastname ',
						'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
						$userswhere,
						'',
						'CASE WHEN CONCAT(CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END,
						CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) = "" THEN 0 ELSE 1 END DESC,
						tx_toctoc_comments_feuser_mm.crdate DESC, (CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END) DESC',
						'');
			}

			$recs['idislikeusers'] = array();
			if (($recs['allrecs'][0]['totalidislikes']>1) || (($recs['allrecs'][0]['totalidislikes']>0) && ($recs['allrecs'][0]['idislike']==0))) {
				$userswhere =($tmpint ?
						'tx_toctoc_comments_feuser_mm.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_feuser_mm.pid IN (' . $conf['storagePid'] . ')') .
						' AND tx_toctoc_comments_feuser_mm.pid=tx_toctoc_comments_user.pid AND ' . ($tmpint ?
						'tx_toctoc_comments_user.pid=' . $conf['storagePid'] : 'tx_toctoc_comments_user.pid IN (' . $conf['storagePid'] . ')') .
				' AND tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
				$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery .
				' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' . $fetoctocusertoquery .
				' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
				$userswhere .= $scopeidtxtfeuser_mm . ' AND idislike = 1 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm', $pObj, $fromAjax);
				$recs['idislikeusers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'toctoc_commentsfeuser_feuser, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
							ilike AS usersilike, ipresolved, CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END AS current_firstname,
						    CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END AS current_lastname ',
						'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
						$userswhere,
						'',
						'CASE WHEN CONCAT(CASE WHEN current_firstname ="" THEN initial_firstname ELSE current_firstname END, CASE WHEN current_lastname =""
						THEN initial_lastname ELSE current_lastname END) = "" THEN 0 ELSE 1 END DESC, tx_toctoc_comments_feuser_mm.crdate DESC,
						CASE WHEN current_lastname ="" THEN initial_lastname ELSE current_lastname END DESC',
						'');
			}

			return $recs;
		}

	}

	/**
	 * Generates array with rating content for given $ref using $template HTML template
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	string		$template	HTML template to use
	 * @param	array		$conf: Plugin configuration array
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$pid: storagePid
	 * @param	boolean		$returnasarray: if the output should be an array
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	object		$pObj: parent object
	 * @param	string		$cmd: Command that needs to be executed
	 * @param	int		$cid: ID of the content element
	 * @param	boolean		$fromcomments: if its a request coming from comments()
	 * @param	array		$commentspics: ...
	 * @param	[type]		$scopeid: ...
	 * @return	string		conditionally also an arraywith the rating content
	 */
	protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj, $cmd, $cid, $fromcomments,
	$commentspics, $scopeid = 0, $isReview = 0, $commentusername = '') {

		// inits
		$siteRelPath = $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments');
		$refforvote=$ref;
		if($scopeid!=0) {
			$refforvote=$ref.'-'.$scopeid;
		}

		if (($fromAjax)) {
			$language = &$GLOBALS['LANG'];
			$languagecode = $GLOBALS['LANG']->lang;
		} else {
			$language = t3lib_div::makeInstance('language');
			$language->init($GLOBALS['TSFE']->lang);
			$languagecode = $GLOBALS['TSFE']->lang;
		}

		/*@var $language language */

		$contentarr=array();
		$myrating = array();
		$refforvote = $ref;
		if($scopeid != 0) {
			$refforvote = $ref . '-' . $scopeid;
		}

		// get the ratings
		$this->trackdebug('ratings.getRatingInfo_rating');

		$rating = $this->getRatingInfo($ref, $pObj, -1, $conf, $scopeid, $fromAjax, $isReview, $fromcomments, $feuserid);
		$this->trackdebug('ratings.getRatingInfo_rating');
		$this->trackdebug('ratings.getRatingInfo_myrating');

		$myrating = $this->getRatingInfo($ref, $pObj, $feuserid, $conf, $scopeid, $fromAjax, $isReview, $fromcomments, $feuserid);

		$savereviewconfratingsmode = $conf['ratings.']['mode'];
		$savereviewconfratingsdisableIpCheck = $conf['ratings.']['disableIpCheck'];
		$savuseLikeDislike = $conf['ratings.']['useLikeDislike'];
		$savuseDislike = $conf['ratings.']['useDislike'];

		$this->trackdebug('ratings.getRatingInfo_myrating');
		$this->trackdebug('ratings.generateRatingContent');
		$classvotebar = 'tx-tc-rts-vote-bar';
		$hidelikeilikecss = '';
		if ((($isReview != 0) && ($fromcomments == 0) && ($feuserid == 0)) || (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic'))) {
			$hidelikeilikecss = ' tx-tc-nodisp';
		}
		if (($cmd=='vote') || ($cmd=='votearticle')) {
			$this->trackdebug('ratings.generateRatingContent.vote');
			// for the votes get the texts and mix with values :-)
			if (($isReview != 0) && ($fromcomments == 0) && ($feuserid == $_SESSION['feuserid']) && ($feuserid > 0)) {
				if (!isset($conf['ratings.']['modeusercenter'])) {
					$conf['ratings.']['mode'] = 'auto';
					$conf['ratings.']['disableIpCheck'] = 1;
				}

			}

			if ($rating['vote_count'] > 0) {
				$rating_value = $rating['rating']/$rating['vote_count'];
				if (round($rating['vote_count'], 0) == 1) {
					if ($isReview == 0) {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.vote', $fromAjax);
					} else {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.review', $fromAjax);
					}

				} else {
					if ($isReview == 0) {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.votes', $fromAjax);
					} else {
						$votetext=$this->pi_getLLWrap($pObj, 'api_rating.reviews', $fromAjax);
					}

			    }

			    if (intval($conf['ratings.']['useNumberOfVotes']) == 1) {
			    	if ($cmd=='votearticle') {
			    		$votetext = ' (' . round($rating['vote_count'], 0) . ' ' . $votetext . ')';
			    	} else {
			    		$votetext = ' (' . round($rating['vote_count'], 0) . ' ' . $votetext . ')';
			    	}

			    }

			    else {
			    	$votetext ='';
			    }

			    if (intval($conf['ratings.']['useNumberOfStars']) == 1) {
					$rating_str = sprintf($this->pi_getLLWrap($pObj, 'api_rating', $fromAjax), $rating_value, $conf['ratings.']['maxValue'], '') . $votetext;
			    } else {
			    	if (intval($conf['ratings.']['useAvgOfVotes']) == 1) {
			    		$rating_str = round($rating_value, 1) . $votetext;
			    	} else {
			    		$rating_str = trim($votetext);
			    	}

			    }

			} else {
				$rating_value = 0;
				if ($isReview == 0) {

					$rating_str = $this->pi_getLLWrap($pObj, 'api_not_rated', $fromAjax);
				} else {
					if (($isReview == 1) && ($fromcomments == 1)) {
						$rating_str = '';
						if ($scopeid == 0) {
							if (($feuserid != $_SESSION['feuserid']) || ($feuserid == 0)){
								$rating_str = $this->pi_getLLWrap($pObj, 'api_not_yetreviewedby', $fromAjax) . ' ' . $commentusername;
							}
						}

					} else {
						if ($feuserid == $_SESSION['feuserid']) {
							$rating_str = '';
						} else {
							$rating_str = $this->pi_getLLWrap($pObj, 'api_not_reviewed', $fromAjax);
						}

					}
				}

			}

			// get the template
			if ((($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) ||
					(!$conf['ratings.']['disableIpCheck'] && $this->isVoted($ref, $pObj, $scopeid, $feuserid, $fromAjax))) {
				$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_RATING###');
				$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_STATIC###');

				$voteSub = $this->t3getSubpart($pObj, $template, '###VOTE_LINK_SUB_OVERALLVOTE###');

			} else {
				$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_RATING###');
				$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_STATIC###');
				if (!$conf['ratings.']['modeplus']) {
					$conf['ratings.']['modeplus']=$conf['ratings.']['mode'];
				}

				if ($conf['ratings.']['modeplus'] == 'autostatic') {
					// for overall-votes with overall votes disabled
					$voteSub = $this->t3getSubpart($pObj, $template, '###VOTE_LINK_SUB_OVERALLVOTE###');
				} else {
					$voteSub = $this->t3getSubpart($pObj, $template, '###VOTE_LINK_SUB###');

				}

			}

			// Make ajaxData
			if ($fromAjax) {
				if ($fromcomments) {
					$ajaxData = $this->AjaxData;
				} else {
					$ajaxData = $this->getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $ref);
				}

			} else {
				$ajaxData = $this->getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $ref);
			}

			// Create links
			$links = '';
			$stepping=1;
			$steppingarr=array();
			$start=1;
			$gap=intval($conf['ratings.']['maxValue'])-intval($conf['ratings.']['minValue']);
			if (($gap>10) || (intval($conf['ratings.']['minValue'])>1)) {
				// no tips stepping to big or minvalue > 1
				$start=-1;
			} elseif  ($gap==10) {

				$stepping='1,1,1,1,1,1,1,1,1,1';
			} elseif  ($gap==9) {

				$stepping='1,1,1,2,1,1,1,1,1';
			} elseif  ($gap==8) {

				$stepping='1,1,1,2,1,1,1,2';
			} elseif  ($gap==7) {

				$stepping='2,2,1,2,1,1,1';
			} elseif  ($gap==6) {

				$stepping='2,2,1,2,2,1';
			} elseif  ($gap==5) {

				$stepping='2,3,2,2,1';
			} elseif  ($gap==4) {

				$stepping='2,3,2,3';
			} elseif  ($gap==3) {

				$stepping='5,2,3';
			} elseif  ($gap==2) {

				$stepping='5,5';
			} elseif  ($gap==1) {

				$stepping='10';
			} elseif  ($gap==0) {

				$stepping='0';
				$start=6;
			}

			$steppingarr=explode(',', $stepping);
			$nextstep=$start;
			for ($i = $conf['ratings.']['minValue']; $i <= $conf['ratings.']['maxValue']; $i++) {
				$refforvote=$ref;
				if($scopeid!=0) {
					$refforvote=$ref.'-'.$scopeid;
				}

				$check = $this->getcheck($refforvote, $i, TRUE);
				$apiratingtip='';
				If ($start!=-1) {

					$apiratingtip=$this->pi_getLLWrap($pObj, 'api_tipstar_' . $nextstep, $fromAjax);
					$nextstep= $nextstep+$steppingarr[($i-intval($conf['ratings.']['minValue']))];
				}

				$links .= $this->t3substituteMarkerArray($voteSub, array(
						'###VALUE###' => $i,
						'###REF###' => $refforvote,
						'###PID###' => $pid,
						'###CID###' => $cid,
						'###APIRATINGTIP###' => $apiratingtip,
						'###CHECK###' => $check,
						'###SITE_REL_PATH###' => $siteRelPath,
				));
			}

			$commentdateSub = $this->t3getSubpart($pObj, $template, '###COMMENT_DATE_SUB###');

			$commentdatehtml ='';
			$txtviews='';

			$jscommentviewcounter='';

			if ($myrating['comment'][0]['commentdate']) {

				$commentcontinuation='';
				if (intval($conf['ratings.']['enableRatings']) ==1 ) {
					$commentcontinuation='&nbsp;' . $this->middotchar . '&nbsp;';
				}

				if (intval($conf['advanced.']['countCommentViews']) ==1 ) {
					$jscommentviewcounter='<span class="tx-tc-cmtvcntr tx-tc-nodisp" id="tx-tc-cmtvcntr__'. 'tx_toctoc_comments_comments_'.
					$myrating['comment'][0]['commentuid'] .
					'__'. $_SESSION['feuserid'] . '__'. $cid . '__1__' . $conf['storagePid'] .'"></span>';
				}

				if (intval($conf['advanced.']['showCountCommentViews']) ==1 ) {
					if ($myrating['commentviews'][0]['commentviews'] > 0) {
						if ($myrating['commentviews'][0]['commentviews']==1) {
							if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.view', $fromAjax);
							} else {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewlong', $fromAjax);
							}

						} else {
							if ($conf['advanced.']['showCountViewsLongFormat'] ==0) {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.views', $fromAjax);
							} else {
								$strviews= $this->pi_getLLWrap($pObj, 'pi1_template.viewslong', $fromAjax);
							}

						}

						$txtviews= '<span class="tx-tc-commentviews">&nbsp;' . $myrating['commentviews'][0]['commentviews'] . ' ' .
						$strviews. $commentcontinuation. '</span>';
						$commentcontinuation='';
					}

				}
				if (intval($conf['ratings.']['dontUseCommentdate']) ==0) {
					$commentdatehtml = $this->t3substituteMarkerArray($commentdateSub, array(
						'###COMMENT_DATE###' => $this->formatDate($myrating['comment'][0]['commentdate'], $pObj, $fromAjax, $conf). $commentcontinuation,
						'###COMMENTID###' => $myrating['comment'][0]['commentuid'],
						'###COMMENT_TIMESTAMP###' => $myrating['comment'][0]['commentdate'],
						'###STYLECOMMENT###' => '',
						'###COMMENTVIEWS###' => $txtviews . $jscommentviewcounter,
						));
				}
	        }

	        $this->trackdebug('ratings.generateRatingContent.vote');
		} else {
			// for all other cmd get the templates for the topline-ratings (other ratings templates follow later)
			$this->trackdebug('ratings.generateRatingContent.rating');
			if ($fromAjax) {
				if ($fromcomments) {
					$ajaxData = $this->AjaxData;
				} else {
					$ajaxData = $this->getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $refforvote);
				}

			} else {
				$ajaxData = $this->getAjaxData($feuserid, $pid, $languagecode, $conf, $cid, $refforvote);
			}

			if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
					$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
				} else {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}

			} else {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
					$subTemplateMyILikeArea = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYRATING_TOP###');
				} else {
					$subTemplate = $this->t3getSubpart($pObj, $template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}

			}

			$this->trackdebug('ratings.generateRatingContent.rating');
		}

		// Init the vars containing values ready for print
		$this->trackdebug('ratings.generateRatingContent.dislike');
		$mydislikeval = intval($myrating['myrecs'][0]['idislike']);
		$mylikeval = intval($myrating['myrecs'][0]['ilike']);
		$sumdislikevalstr = '&nbsp;' . $myrating['allrecs'][0]['totalidislikes'];
		if (intval($myrating['allrecs'][0]['totalidislikes']) === 0) {
			$sumdislikevalstr = '';
		}

		$sumlikevalstr= '&nbsp;' . $myrating['allrecs'][0]['totalilikes'];
		if (intval($myrating['allrecs'][0]['totalilikes']) === 0) {
			$sumlikevalstr = '';
		}

		$myrating_str = '';

		if (($conf['ratings.']['useLikeDislike'] == 1) && ($conf['ratings.']['useDislike'] == 1)) {
			if (is_array($_SESSION['dislikeditem'])) {
				if ($_SESSION['dislikeditem']['ref'] == $ref) {
					if ($conf['ratings.']['dlikeCtsNotifLvl']==$myrating['allrecs'][0]['totalidislikes']) {
					// need to send notification
						$newUid=intval(str_replace('tx_toctoc_comments_comments_', '', $ref));
						// only if idislike on comment
						if ($newUid>0) {
							$sendnotif=TRUE;
							if (is_array($_SESSION['ndislikeditem'])) {
								if ($_SESSION['ndislikeditem']['time' . $ref]>0) {
									//an email has already been sent
									$conf_idletime = $conf['ratings.']['dlikeCtsNotifIdlTime'];
									$conf_idletime =(time() - ($conf_idletime *60));
									if ($conf_idletime-$_SESSION['ndislikeditem']['time' . $ref]<0) {
										$sendnotif=FALSE;
									}

								}

							}

							if ($sendnotif==TRUE) {
								$this->sendNotificationEmail($newUid, 0, FALSE, 'rating', $conf, $pObj, $fromAjax,
										$piVars, $pid, $_SESSION['dislikeditem']['toctoc_user'], 0, 0, '', $_SESSION['dislikeditem']['pageid'], $languagecode);
								$_SESSION['ndislikeditem']['time' . $ref]=time();
							}

						}

					}

					unset($_SESSION['dislikeditem']);
				}

			}

		}

		// here we determine the text to display in the topline, if it's a rating on News, Products normal Content Element or other records...

		$extpreffortext = 'pages';
		if ((trim($conf['externalPrefix'])=='tt_products') || (trim($conf['externalPrefix']) == 'tx_commerce_pi1')) {
			$extpreffortext ='tt_products';
		} elseif  ((trim($conf['externalPrefix'])=='tx_wecstaffdirectory_pi1')) {
			$extpreffortext ='tx_wecstaffdirectory_pi1';
		} elseif  ((trim($conf['externalPrefix'])=='tx_rouge')) {
			$extpreffortext ='tx_rouge';
		} elseif  ((trim($conf['externalPrefix'])=='tx_album3x_pi1')) {
			$extpreffortext ='tx_album3x_pi1';
		} elseif   ((trim($conf['externalPrefix'])=='tx_mininews_pi1') || (trim($conf['externalPrefix'])=='tx_ttnews') ||
				(trim($conf['externalPrefix'])=='tx_news_pi1')) {
			$extpreffortext ='tx_ttnews';
		}

		//Setting up idislike zone
		$retarr=$this->makeiLikeText($conf, $pObj, $cmd, $refforvote, $fromAjax, $myrating, $mydislikeval, 'dis', $template, $cid, $commentspics, $extpreffortext);

		$mydislike=$retarr[0];
		$mydislikehtml=$retarr[1];
		$mydislikehtmlnv=$retarr[2];
		$mydislikepic=$retarr[3];
		$mydislikepicalkt=$retarr[4];
		$this->trackdebug('ratings.generateRatingContent.dislike');

		// same processing for iLike
		$this->trackdebug('ratings.generateRatingContent.like');

		$retarr=$this->makeiLikeText($conf, $pObj, $cmd, $refforvote, $fromAjax, $myrating, $mylikeval, '', $template, $cid, $commentspics, $extpreffortext);

		$mylike=$retarr[0];
		$mylikehtml=$retarr[1];
		$mylikehtmlnv=$retarr[2];
		$mylikepic=$retarr[3];
		$mylikepicalkt=$retarr[4];
		$this->trackdebug('ratings.generateRatingContent.like');
		$this->trackdebug('ratings.generateRatingContent.markers');

		// selecting the template

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		} else {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_LINK_SUB###');
		}

		if ($mydislikeval == 1 ) {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		// make the HTML for the iLike-Picture

		$i=-1*($mylikeval-1);
		$check = $this->getcheck($refforvote, $i, TRUE);
		$mypiclikehtmlSub =  $this->t3substituteMarkerArray($mypiclikeSub, array(
						'###VALUE###' => $i,
						'###REF###' => $refforvote,
						'###PID###' => $pid,
						'###CID###' => $cid,
						'###CHECK###' => $check,
						'###CONTENT###' => $mylike,
						'###CONTENTADDCSS###' => '',
						'###SITE_REL_PATH###' => $siteRelPath,
						'###TITLE###' => '',
    	));
		$mylikestatic='';
		if (($conf['ratings.']['useLikeDislikeStyle']==1) || ((intval($conf['ratings.']['useShortTopLikes']) == 1) && ($cmd=='votearticle')))  {
			$mypiclikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
			$mypiclikehtmlstaticSub =  $this->t3substituteMarkerArray($mypiclikeSub, array(
					'###VALUE###' => $i,
					'###REF###' => $refforvote,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###CHECK###' => $check,
					'###CONTENT###' => $mylike,
					'###CONTENTADDCSS###' => '',
					'###SITE_REL_PATH###' => $siteRelPath,
					'###TITLE###' => '',
			));
			$mylikestatic=$mypiclikehtmlstaticSub;
		}

		$mylike=$mypiclikehtmlSub;

		// selecting the same template again for the text version of the ilike link and the topline-ilke link (the one without number of votes)

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		} else {
			$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_LINK_SUB###');
		}

		if ($mydislikeval == 1 ) {
			$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		$check = $this->getcheck($refforvote, $i, TRUE);
		$mylikehtmlSub =  $this->t3substituteMarkerArray($mylikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mylikehtmlnv,
				'###CONTENTADDCSS###' => $hidelikeilikecss,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mylikepicalkt .'"',
		));
		$mylikehtmlnv=$mylikehtmlSub;
		$mylikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		$mylikehtmlSub = $this->t3substituteMarkerArray($mylikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mylikehtml,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mylikepicalkt .'"',
    	));
		$mylikehtml=$mylikehtmlSub;
		// dont show topline ilike pic when not iLiked by any one

		if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
			if ((intval($myrating['allrecs'][0]['totalilikes']) == 0) && (intval($conf['ratings.']['useShortTopLikes']) == 0)) {
				$mylike= '';
				$mylikestatic='';
				$mylikehtml='';
			}

		}

		// same for the dislikes

		$mydislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		$i=-1*($mydislikeval-1);
		$check = $this->getcheck($refforvote, $i, TRUE);
		$mydislikehtmlSub =  $this->t3substituteMarkerArray($mydislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislikehtml,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mydislikepicalkt .'"',
		));

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mydislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
		} else {
			$mydislikeSub = $this->t3getSubpart($pObj, $template, '###IDISLIKE_LINK_SUB###');
		}

		if ($mylikeval == 1 ) {
			$mydislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		$mydislikehtml=$mydislikehtmlSub;
		$mydislikehtmlSub =  $this->t3substituteMarkerArray($mydislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislikehtmlnv,
				'###CONTENTADDCSS###' => $hidelikeilikecss,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mydislikepicalkt .'"',
		));
		$mydislikehtmlnv=$mydislikehtmlSub;

		if (($conf['ratings.']['mode'] == 'static') && ($conf['ratings.']['modeplus'] != 'autostatic')) {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		} else {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###IDISLIKE_LINK_SUB###');
		}

		// now, now now, static isn't the only reason to go static.
		// the other reason is that user has made iLike, so IDislike is only activ after he unlikes it.
		if ($mylikeval == 1 ) {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		$check = $this->getcheck($refforvote, $i, TRUE);
		$mypicdislikehtmlSub =  $this->t3substituteMarkerArray($mypicdislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $refforvote,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislike,
				'###CONTENTADDCSS###' => '',
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => '',
		));
		$mydislikestatic='';
		if (($conf['ratings.']['useLikeDislikeStyle']==1) || ((intval($conf['ratings.']['useShortTopLikes']) == 1) && ($cmd=='votearticle')))  {
			$mypicdislikeSub = $this->t3getSubpart($pObj, $template, '###ILIKE_STATIC_SUB###');
			$mypicdislikehtmlstaticSub =  $this->t3substituteMarkerArray($mypicdislikeSub, array(
					'###VALUE###' => $i,
					'###REF###' => $refforvote,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###CHECK###' => $check,
					'###CONTENT###' => $mydislike,
					'###CONTENTADDCSS###' => $hidelikeilikecss,
					'###SITE_REL_PATH###' => $siteRelPath,
					'###TITLE###' => '',
			));
			$mydislikestatic=$mypicdislikehtmlstaticSub;
		}

		$mydislike=$mypicdislikehtmlSub;

		// dont show topline ilike pic when not iLiked by any one

		if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
			if ((intval($myrating['allrecs'][0]['totalidislikes'])===0) && (intval($conf['ratings.']['useShortTopLikes']) == 0)){
				$mydislike= '';
				$mydislikehtml='';
				$mydislikestatic='';
			}

		}

		// get the "your rating" part

		$myrating_value=round($myrating['myrecs'][0]['myrating'], 1);
		$myrating_intvalue=round($myrating['myrecs'][0]['myrating'], 0);
		$myratingtext = '';
		if ($myrating_value==0) {
			$myrating_left = 0;
			$myrating_width = 0;
		} else {
			$myrating_left = intval($myrating_intvalue*intval($conf['ratings.']['ratingImageWidth']) -intval($conf['ratings.']['ratingImageWidth']));
			$myrating_width = intval($conf['ratings.']['ratingImageWidth']);
			if ($isReview == 0) {
				$myratingtext = $this->pi_getLLWrap($pObj, 'api_yourrating', $fromAjax) . ' ' . $myrating_value;
			} else {

				$myrating_left = intval(round($myrating_intvalue, 0)*intval($conf['ratings.']['reviewImageWidth']) - intval($conf['ratings.']['reviewImageWidth']));
				$myrating_width = intval($conf['ratings.']['reviewImageWidth']);
				if (($feuserid > 0) && (intval($fromcomments) == 0)) {
					$myratingtext = $this->pi_getLLWrap($pObj, 'api_yourreview', $fromAjax) . ' ' . $myrating_value;
				} else {
					$myratingtext = '';
					if (($feuserid == $_SESSION['feuserid']) && ($feuserid != 0)) {
						$myratingtext = '';
					} else {
						if (intval($scopeid) == 0) {
							if ($commentusername == '') {
								$commentusername= $this->getUserName($feuserid, $pObj, $fromAjax, $conf);
							}

							if ($commentusername != '') {
								$myratingtext = $this->pi_getLLWrap($pObj, 'api_rating.reviewby', $fromAjax) . ' ' . $commentusername . ': ' . $myrating_value;
								if ($rating_str != '') {
									$rating_str = '';
								}

							}

						} else {
							$myratingtext = ucfirst($this->pi_getLLWrap($pObj, 'api_rating.review', $fromAjax)) . ': ' . $myrating_value;
						}

					}

				}

			}

		}

		// considering options and resetting the HTML-fragments if needed (I admit this could be done in parts before...)
		$middottop  = '&nbsp;' . $this->middotchar . '&nbsp;';

		if ($conf['ratings.']['useLikeDislikeStyle']==1) {

			if (substr($ref, 0, 6) != 'tx_toc') {
				$middot=$middottop;
			}

		} else {
			$middot = '&nbsp;' . $this->middotchar . '&nbsp;';
		}

		if (intval($conf['ratings.']['useShortTopLikes']) == 1) {
			if (substr($ref, 0, 6) != 'tx_toc') {
				$middot = '';
				$middottop = '';
			}

		}

		if (intval($conf['ratings.']['useLikeDislike'] ) != 1) {
			$mylikehtml = '';
			$mylikehtmlnv = '';
			$mydislikehtml = '';
			$mydislikestatic = '';
			$mydislikehtmlnv = '';
			$mylike ='';
			$mylikestatic = '';
			$mydislike ='';
		} else {
			// for top line adding the continuations
			if (intval($conf['ratings.']['useDislike']) != 1) {
				$mydislikehtml = '';
				$mydislikestatic = '';
				$mydislikehtmlnv = '';
				$mydislike ='';
				if ($cmd == 'liketop') {
					if (($mylikehtml !='') || ($conf['ratings.']['useVotes']==1) || ($conf['sharing.']['useSharing']==1) ||
							(($conf['sharing.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0) && ($conf['ratings.']['ratingsOnly']==0))) {
						$mylikehtmlnv .= $middottop . '&nbsp;';
					}

					$mylikehtml .= $middottop . '&nbsp;';
				}

			} else {
				if ($cmd=='votearticle') {
					$middot=$middottop;
				}

				if ($mylikehtml !='') {
					if ($mydislikehtml !='') {
						$mylikehtml .= $middot . '';
					}

				}

				if ($mydislikeval==0) {
					if ($mylikeval==0) {
						$mylikehtmlnv .= $middot . '';
					} else {
						$mylikehtmlnv .= $middot . '&nbsp;';
					}

				} else {
					$mylikehtmlnv .= $middot . '';
				}

				if (strpos($cmd, 'top')!==FALSE) {
					if (($mydislikehtml !='') || ($conf['ratings.']['useVotes']==1) || ($conf['sharing.']['useSharing']==1) ||
							(($conf['sharing.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0) && ($conf['ratings.']['ratingsOnly']==0))) {
						$mydislikehtmlnv .= $middot . '&nbsp;';
					}

					$mydislikehtml .= $middot . '&nbsp;';
				}

			}

		}

		// considering values and resetting the HTML-fragments if needed (Again, I admit this could be done in parts before...)
		if ($mydislikeval==0) {
			if ($mylikeval!=0) {
				$mydislikehtmlnv= '';
			}

		}

		if ($mylikeval==0) {
			if ($mydislikeval!=0) {
				$mylikehtmlnv= '';
			}

		}

		// cleaning out voting HTML-fragments if options require

		if (intval($conf['ratings.']['useMyVote'] ) !== 1) {
			$myratingtext= '';
			$myrating_width = 0;
			$myrating_left=0;
		}

		$strhidevote = '';

		// preparing strings needed in CSS for hideing of elements
		if (!($conf['ratings.']['useVotes'])) {
			$strhidevote = '-hide';
		}

		if ((intval($conf['ratings.']['useTopVotes']) == 0 ) && ($cmd == 'votearticle')) {
			$strhidevote = '-hide';
		}

		$hidecss ='';

		// We won't print out the $*htmlout if there's no pic to show
		$mylikehtmlout=$mylikehtml;
		if ($mylike=='') {
			$mylikehtmlout='';
		}

		$mydislikehtmlout=$mydislikehtml;
		if ($mydislike=='') {
			$mydislikehtmlout='';
		}

		// preparing the entire rating area
		$brforfirstscope='';
		if ($scopeid==0) {
			$prefix=  $ref;
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($ref, 0, $posbeforeid);
			$brforfirstscope='';
			if ($prefix != 'tx_toctoc_comments_comments_') {
				$cntsess=count($_SESSION['ratingsscopesinternalm1table'][$_SESSION['commentListRecord']]);
			}

		}

		$areamarkers = array(
				'###MYILIKE###' => $mylike,
				'###MYIDISLIKE###' => $mydislike,
				'###MYILIKETEXT###' => $mylikehtmlout,
				'###MYIDISLIKETEXT###' => $mydislikehtmlout,
				'###REF###' => htmlspecialchars($refforvote),
				'###BRFORFIRSTSCOPE###' => $brforfirstscope,
		);

		$areamarkersstatic = array();
		if ($conf['ratings.']['useLikeDislikeStyle']==1) {
			if ($cmd!='votearticle') {
				$areamarkers = array(
						'###MYILIKE###' => $mylike,
						'###MYIDISLIKE###' => $mydislike,
						'###MYILIKETEXT###' => $mylikehtmlout,
						'###MYIDISLIKETEXT###' => $mydislikehtmlout,
						'###REF###' => htmlspecialchars($refforvote),
						'###BRFORFIRSTSCOPE###' => $brforfirstscope,
				);
			}

		}

		if (intval($conf['ratings.']['useShortTopLikes']) == 1) {
			if ($cmd=='votearticle') {
				$areamarkers = array(
						'###MYILIKE###' => $mylike,
						'###MYIDISLIKE###' => $mydislike,
						'###MYILIKETEXT###' => $mylikehtmlout,
						'###MYIDISLIKETEXT###' => $mydislikehtmlout,
						'###REF###' => htmlspecialchars($refforvote),
						'###BRFORFIRSTSCOPE###' => $brforfirstscope,
				);
			}

		}
		$strhidevoteplus = '';
		if ($conf['advanced.']['commentReview']==1) {
			$strhidevoteplus = ' tx-tc-yourreview';
		}

		$mylikestaticareahtml= '';
		if ((intval($conf['ratings.']['useTopLikeDislike']) == 0 ) && ($cmd == 'votearticle')) {
			$mylikeareahtml= '';

		} else {
			$mylikeareahtml= $this->t3substituteMarkerArray($subTemplateMyILikeArea, $areamarkers);
		}

		// preparing output for
		// 1. ilikes or votings, iLikes are subclassed into topline-1st/topline-2nd or  Comment line
		// 2. the enitre area (pi1-calls)
		if (strpos($cmd, 'like')!==FALSE) {
			// iLikes/idislikes

			if (strpos($cmd, 'liketop')!==FALSE) {

			// top line
				// the 2nd top line
				if (intval($conf['ratings.']['useTopLikeDislike']) == 1 ) {

					$mylikehtml = str_replace('\'like\',', '\'liketop\',', $mylikehtml );
					$mydislikehtml = str_replace('\'unlike\',', '\'unliketop\',', $mydislikehtml );
					$mylikehtml = str_replace('\'myratings\'', '\'myratingstop\'', $mylikehtml );
					$mydislikehtml = str_replace('\'myratings\'', '\'myratingstop\'', $mydislikehtml );
					// the 1st top line
					$mylikehtmlnv = str_replace('\'like\',', '\'liketop\',', $mylikehtmlnv );
					$mydislikehtmlnv = str_replace('\'unlike\',', '\'unliketop\',', $mydislikehtmlnv );
					$mylikehtmlnv = str_replace('\'myratings\'', '\'myratingstop\'', $mylikehtmlnv );
					$mydislikehtmlnv = str_replace('\'myratings\'', '\'myratingstop\'', $mydislikehtmlnv );
				} else {
					$mylikehtml = '';
					$mydislikehtml = '';
					$mylikehtml = '';
					$mydislikehtml = '';
					$mylikehtmlnv = '';
					$mydislikehtmlnv = '';
					$mylikehtmlnv = '';
					$mydislikehtmlnv = '';
				}

			}

			if (!(($cmd=== 'like') || ($cmd=== 'unlike'))) {
				$mylikehtml=$mylikehtmlnv;
				$mydislikehtml=$mydislikehtmlnv;
			}

			$markers = array(
					'###PID###' => $pid,
					'###HIDECSS###'=> $hidecss,
					'###CID###' => $cid,
					'###REF###' => htmlspecialchars($refforvote),
					'###SITE_REL_PATH###' => $siteRelPath,
					'###MYILIKE_AREA###' => $mylikeareahtml,
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
			);
		} else {
			$hidecss ='';
			$markers = array(
					'###HIDECSS###'=> $hidecss,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###HIDEVOTEMYRATING###' => $strhidevote . $strhidevoteplus,
					'###HIDEVOTE###' => $strhidevote,
					'###REF###' => htmlspecialchars($refforvote),
					'###TEXT_SUBMITTING###' => $this->pi_getLLWrap($pObj, 'api_submitting', $fromAjax),
					'###TEXT_ALREADY_RATED###' => $this->pi_getLLWrap($pObj, 'api_already_rated', $fromAjax),
					'###BAR_WIDTH###' => $this->getBarWidth($rating_value, $conf, $isReview),
					'###CLASSVOTEBARREVIEW###' => $classvotebar,
					'###COMMENT_DATE###' => $commentdatehtml,

					'###RATING###' => $rating_str,
					'###TEXT_RATING_TIP###' => $this->pi_getLLWrap($pObj, 'api_tip', $fromAjax),
					'###SITE_REL_PATH###' => $siteRelPath,
					'###VOTE_LINKS###' => $links,
					'###MYRATING###' => $myratingtext,
					'###MYILIKE_AREA###' => $mylikeareahtml,
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
					'###MYBAR_WIDTH###' => $myrating_width,
					'###MYBAR_LEFT###'=> $myrating_left,
			);
		}

		// we will output either an array or a string
		// (pi1: array)
		if (intval($conf['ratings.']['enableRatings']) === 1 ) {
					$contentarr['voteing']= $this->t3substituteMarkerArray($subTemplate, $markers);
		} else {
			$contentarr['voteing']='';
		}

		$contentarr['idislike']='';
		$contentarr['ilike']='';
		$contentarr['myvote']='';
		$contentarr['mylikehtml']='';
		$contentarr['mydislikehtml']='';
		if ($mydislikeval==0) {
			if ($mylikeval!=0) {
				$mydislikehtmlnv= '';
			}

		}

		if ($mylikeval==0) {
			if ($mydislikeval!=0) {
				$mylikehtmlnv= '';
			}

		}

		if ((intval($conf['ratings.']['useLikeDislike'] ) === 1) && (intval($conf['ratings.']['useTopLikeDislike']) == 1)) {
			$contentarr['mylikehtml']=$mylikehtml;
			$contentarr['ilike']=$mylikehtmlnv;
			if (intval($conf['ratings.']['useDislike']) === 1) {
				$contentarr['idislike']=$mydislikehtmlnv;
				$contentarr['mydislikehtml']=$mydislikehtml;
			}

		}

		if (intval($conf['ratings.']['useMyVote']) ===1 ) {
			$contentarr['myvote']=$myrating_left . ',' . $myrating_width;
		}

		$this->trackdebug('ratings.generateRatingContent.markers');
		$this->trackdebug('ratings.generateRatingContent');

		$conf['ratings.']['mode'] = $savereviewconfratingsmode;
		$conf['ratings.']['disableIpCheck'] = $savereviewconfratingsdisableIpCheck;

		if (($isReview != 0) && ($feuserid > 0) && ($fromcomments == 1) && ($feuserid == $_SESSION['feuserid'])) {
			$contentarr['voteing']='';
		}

		if ($returnasarray) {
			return $contentarr;
		} else {
			$contentarr['voteing']=str_replace('<div class="tx-tc-rts-container">',
					'<div id="tx-tc-tipemo-2-'.htmlspecialchars($refforvote).'" class="tx-tc-rts-container tx-tc-tipemo-2">', $contentarr['voteing']);
			if ($conf['ratings.']['useLikeDislikeStyle']==1) {
				if (substr($ref, 0, 6) == 'tx_toc') {
					$contentarr['voteing']='<div class="tx-tc-overrating">' .
					str_replace('<div id="tx-tc-rts-dp-tx_toctoc_comments_comments',
							'</div></div><div class="tx-tc-overrating-date"><div id="tx-tc-rts-dp-tx_toctoc_comments_comments', $contentarr['voteing'] );
				} else {
					if ((intval($conf['ratings.']['useShortTopLikes']) == 1) || (intval($conf['ratings.']['useLikeDislikeStyle']) == 1)) {
						$repl='/id="tx-tc-myrts-dp-'.$ref.'-(\d)" class="tx-tc-rts-li/';
						$replw='id="tx-tc-myrts-dp-'.$ref.'-$1" class="tx-tc-rts-li tx-tc-nodisp';

						$wrkareaHTML=str_replace('id="tx-tc-myrtstop-'.$ref.'" class="tx-tc-rts-area', 'id="tx-tc-myrtstop-'.$ref.
								'" class="tx-tc-rts-area tx-tc-nodisp', $contentarr['voteing']);
						$topareaHTML=preg_replace($repl, $replw, $wrkareaHTML);

						$repl='/id="tx-tc-myrts-'.$ref.'-(\d)" class="tx-tc-rts-area/';
						$replw='id="tx-tc-myrts-'.$ref.'-$1" class="tx-tc-rts-area tx-tc-nodisp';
						$contentarr['voteing']=preg_replace($repl, $replw, $topareaHTML);

					}
				}

			}

			return $contentarr['voteing'];
		}

	}

	/**
	 * Makes text for iLike or idislike.
	 *
	 * @param	array		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$cmd: ...
	 * @param	[type]		$ref: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$myrating: ...
	 * @param	[type]		$mylikeval: ...
	 * @param	[type]		$mydis: ...
	 * @param	[type]		$template: ...
	 * @param	[type]		$cid: ...
	 * @param	[type]		$commentspics: ...
	 * @param	[type]		$extpreffortext: ...
	 * @return	array		$retarr:[0]=$mylike;[1]=$mylikehtml;[2]=$mylikehtmlnv;[3]=$mylikepic;
	 */
	private function makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating = array(), $mylikeval, $mydis='', $template, $cid, $commentspics, $extpreffortext) {
		// same processing for iLike and iDislike
		$namedcount=2;
		$othersmaxcount=5;
		$nbrnamed=$myrating['allrecs'][0]['totali' . $mydis . 'likes'];
		$otherscount=0;
		$likingusersstr=' ';
		$printname='';
		$iothers=0;
		$namedlikearr=array();
		$uchtmlarr=array();
		if ($nbrnamed>0) {
			$nbrinterpunkt=' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ';
			if ($nbrnamed>0) {
				$nbrinterpunkt=', ';
			}

			if ($nbrnamed > $namedcount) {
				$nbrnamed=$namedcount;
			}

			$prefix=  $ref;
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($ref, 0, $posbeforeid);
			$mmtable=substr($ref, 0, $posbeforeid-1);
			$refID = substr($ref, $posbeforeid);
			if ($mydis=='') {
				$refID = (999999-$refID)*10;
			} else {
				$refID = (899999-$refID)*10;
			}

			// gefaellt das Produkt
			$selectorlikelikes='';
			if ($extpreffortext== 'tx_wecstaffdirectory_pi1') {
				// gefaellt die Person
				$selectorlikelikes='_fem';
			} elseif ($extpreffortext== 'tx_ttnews') {
				// gefallen die News
				$selectorlikelikes='_femplur';

			}

			for ($i = 0; $i < $nbrnamed; $i++) {
				if ($myrating['i' . $mydis . 'likeusers'][$i]['current_lastname'] !='') {
					$printname=$myrating['i' . $mydis . 'likeusers'][$i]['current_lastname'];
					if ($myrating['i' . $mydis . 'likeusers'][$i]['current_firstname'] !='') {

						$printname=$myrating['i' . $mydis . 'likeusers'][$i]['current_firstname'] . ' ' . $printname;

					}

					$pseudocommentid=$refID+$i;
					$uchtml='';

					$templateuclink = $this->t3getSubpart($pObj, $template, '###SHOWUC_SUB###');

					$fontsizeforuc= '100%';
					$lineheightforuc= '109.1%';
					if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
						$fontsizeforuc= '90.9%';
						$lineheightforuc= '109.1%';
					}

					$plachdr = '';
					if ($conf['theme.']['selectedBoxmodelkoogled']==1) {
						$plachdr = '***';
					}

					$uchtml =  $this->t3substituteMarkerArray($templateuclink, array(
							'###COMMENT_ID###' => $pseudocommentid,
							'###FONTSIZE###'=> $fontsizeforuc,
							'###LINEHEIGHT###'=> $lineheightforuc,
							'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
							'###PCEHDRPIC###' => $plachdr,
					));

					$timeout= intval($conf['timeoutUC']);
					if ($timeout < 3) {
						$timeout=3;
					} elseif ($timeout > 15) {
						$timeout=15;
					}

					$timeout= 1000*$timeout;

					$templateuclink = $this->t3getSubpart($pObj, $template, '###SHOWUCLINK_SUB###');

					$pictureuser= $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'];
					$fetoctocusertoquery ='"0.0.0.0.' . $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'] . '"';
					$fetoctocusertomarker ='0.0.0.0.' . $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'];
					if ($pictureuser==0) {
						//check if female
						$fetoctocusertoquery ='"' . $myrating['i' . $mydis . 'likeusers'][$i]['tc_ct_user'] . '"';
						$fetoctocusertomarker =$myrating['i' . $mydis . 'likeusers'][$i]['tc_ct_user'];

						$rowsgender = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('gender',
								'tx_toctoc_comments_comments',
								'toctoc_comments_user = ' . $fetoctocusertoquery,
								'',
								'uid DESC',
								1);
						if (count($rowsgender)>0) {
							if ($rowsgender[0]['gender']==1) {
								$pictureuser=99999;
							}

						}

					}

					$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
							'',
							'',
							'uid DESC',
							1 );
					$usergenderexistsstr='';
					if (count($rowsfeuser)>0) {
						if (array_key_exists('gender', $rowsfeuser[0])) {
							$usergenderexistsstr=' fe_users.gender AS gender, ';
						}

					}

					if (!$fromAjax) {
						$this->build_AJAXImages($conf, $pObj, $usergenderexistsstr, $fromAjax);
					} else {
						if (count($_SESSION['AJAXimages']) !=0 ) {
								$this->AJAXimages = $_SESSION['AJAXimages'];
								$this->gravatarimages = $_SESSION['gravatarimages'];
							} else {
								if (count($commentspics) > 0) {
									// now here ends the way of the commentpics that are pumped from AJAX in the system
									// this pattern can be removed in future, because userpics in this place will come from $_SESSION['AJAXimages']
									// ajaxDataC[cid] was pumped in and in former times made the results in AJAX-Images, this pump is an overhead and can be resolved on the server

									$this->AJAXimages = $commentspics;
								}

							}

					}
					$pictureuserfromajax = $this->getAJAXimage($pictureuser, $pseudocommentid, $conf);
					$pictureuserfromajaxwrkarr=explode('title="', $pictureuserfromajax);
					if (count($pictureuserfromajaxwrkarr)>1) {
						$pictureuserfromajaxwrkarr2=explode('" ', $pictureuserfromajaxwrkarr[1]);
						$pictureuserfromajax=$pictureuserfromajaxwrkarr[0] . 'title="' . $printname . '" ' . $pictureuserfromajaxwrkarr2[1];
					} else {
						$pictureuserfromajax=str_replace(' tx-tc-nodisp', '', $pictureuserfromajax);
						$pictureuserfromajax=str_replace('">', '" title="' . $pictureuserfromajax . '">', $pictureuserfromajax);
					}

					$uchtmlarr[$i]=trim($uchtml);

					$printname='<a class="tx-tc-picclasslink" id="tx-tc-nameclasslink__'.$pseudocommentid.'__'.
						$cid.'__'.base64_encode($fetoctocusertomarker).'__'.base64_encode($pictureuserfromajax).
						'__'.$timeout.'" rel="nofollow" href="javascript:void(0)">' . $printname . '</a>';

				} else {
					$iothers=$i;
					$otherscount=$nbrnamed-$i;
					if ($i==0) {
						$nbrinterpunkt='';
					}

					if ($likingusersstr!='') {
						$likingusersstr=substr($likingusersstr, 0, (strlen($likingusersstr)-2));
					}

					break;
				}

				if ($nbrnamed-1 > $i) {
					$likingusersstr .= $printname . ', ';
				} elseif ($nbrnamed-1==$i) {
					$likingusersstr .= $printname;
				} elseif ($nbrnamed==$i) {
					$likingusersstr .= $printname;
				}

				$namedlikearr[$i]['name']=$printname;
				$namedlikearr[$i]['tcuser']=$myrating['i' . $mydis . 'likeusers'][$i]['toctoc_comments_user'];
			}

		}

		$others ='';

		$otherscount=$otherscount+$myrating['allrecs'][0]['totali' . $mydis . 'likes']-$mylikeval-$nbrnamed;
		if ($otherscount>0) {
			$otheruserarray=array();

			$i=0;
			$overmax=0;
			$cntilkeusers=count($myrating['i' . $mydis . 'likeusers']);
			for ($j = (count($myrating['i' . $mydis . 'likeusers'])-$otherscount); $j < $cntilkeusers; $j++) {
				if (trim($myrating['i' . $mydis . 'likeusers'][$j]['current_lastname']) !='') {
					$printname=$myrating['i' . $mydis . 'likeusers'][$j]['current_lastname'];
					if ($myrating['i' . $mydis . 'likeusers'][$j]['current_firstname'] !='') {
						$printname=$myrating['i' . $mydis . 'likeusers'][$j]['current_firstname'] . ' ' . $printname;
					}

				} else {
					if ($conf['ratings.']['useIPsInLikeDislike'] == 1) {
						$printname=$myrating['i' . $mydis . 'likeusers'][$j]['ipresolved'];
					} else {
						$printname = '';
					}
				}

				if (($i < $othersmaxcount) && ($printname != '')) {
					$otheruserarray[$i]=$printname;
					$i++;
					$iovermax=$i;
				} else {
					$overmax++;
					if ($overmax==1) {
						$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otheruser', $fromAjax);

					} else {
						$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otherusers', $fromAjax);
					}

					$i++;
				}

			}

			if ($otherscount==1) {
				$another=$this->pi_getLLWrap($pObj, 'api_ilike_another', $fromAjax);
				if ((count($namedlikearr)>0) || ($mylikeval>0)) {
					$others .= $another;
				} else {
					$anotherarr = explode(' ', $another);
					$anotherarr[0]=ucwords($anotherarr[0]);
					$another = implode(' ', $anotherarr);
					$others .= $another;
				}

			} else {

				$others .= $otherscount . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_others', $fromAjax);
			}
			$others ='<span class="tx-tc-oth" id="tx-tc-oth' . $mydis . '-' . $ref . '"><span class="tx-tc-othertitle tx-tc-textlink" id="tx-tc-othertitle' .
					$mydis . '-' .
					$ref . '" title="' . implode('<br />', $otheruserarray) . '">' . $others . '</span></span>';
			if ((count($namedlikearr)>0) || ($mylikeval>0)) {
				$others = ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) .  ' ' . $others;
			}

		} else {
			if (strpos($likingusersstr, ', ')>0) {
				$likingusersarr=explode(', ', $likingusersstr);
				$lastnameduser=trim($likingusersarr[(count($likingusersarr)-1)]);
				$strlastlen=strlen($lastnameduser);
				$likingusersstr = substr($likingusersstr, 0, (strlen($likingusersstr)-$strlastlen-2)) . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) .
					' ' . $lastnameduser;
			} else {
				if ($likingusersstr!='') {
					$nbrinterpunkt=' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and', $fromAjax) . ' ';
				}

			}

		}

		$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis' . $selectorlikelikes, $fromAjax);
		if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==1) {
			if ($mylikeval==0) {
				// another user likes it
				$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likesthis' . $selectorlikelikes, $fromAjax);
			}

		}

		if ($mylikeval==0) {
			// not yet liked by the user
			$mylikepic='i' . $mydis . 'likemaybe.png';

			if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
				// if liking on toparea

				if (substr($ref, 0, 9)!=='tt_conten') {
					//records
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . $mydis . 'likemaybe', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_' . $extpreffortext . 'topline_onelike', $fromAjax);
					$mylikehtml= $likingusersstr . ' ' . $others . ' ' . $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' .
							$extpreffortext . 'item', $fromAjax) . implode($uchtmlarr);

				} else {
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . $mydis . 'likemaybe', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_topline_onelike', $fromAjax);
					$mylikehtml=$likingusersstr . ' ' . $others . ' ' . $likethis . implode($uchtmlarr);
				}

			} else {
				$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_' . $mydis . 'likemaybe', $fromAjax);
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==0) {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_' . $mydis . 'like', $fromAjax);

				} else {
					$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis', $fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==1) {
						$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likesthis', $fromAjax);
					}

					$mylikehtml= $likingusersstr . ' ' . $others . ' ' . $likethis . implode($uchtmlarr);
				}

				$mylikehtmlnv= $mylikehtml;

			}

		} else {
			$mylikepic='i' . $mydis . 'like.png';
			if ((substr($ref, 0, 9)!=='tx_toctoc') || ($cmd=='votearticle')) {
				// if liking on toparea
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
					$likethis=str_replace($this->pi_getLLWrap($pObj, 'api_ilike_like', $fromAjax),
							$this->pi_getLLWrap($pObj, 'api_ilike_like_lat_tu', $fromAjax), $likethis);
				}

				if (substr($ref, 0, 9)!=='tt_conten') {
					//records

					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'i' . $mydis . 'likethis', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_' . $extpreffortext . 'topline_oneunlike', $fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you_lat', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' .
						$others . ' ' . $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item', $fromAjax) . implode($uchtmlarr);

					} else {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' .
						$others . ' ' . $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item', $fromAjax) . implode($uchtmlarr);

					}

				} else {
					//pages
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'i' . $mydis . 'likethis', $fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_topline_oneunlike', $fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you_lat', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' . $others  .
						' ' . $likethis . ' ' . implode($uchtmlarr);

					} else {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you', $fromAjax) . $nbrinterpunkt . $likingusersstr . $others . ' ' .
						$likethis . ' ' . implode($uchtmlarr);
					}

				}

			} else {
				$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'likethis', $fromAjax);
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_ilike_you_lat', $fromAjax) . ' ' . $this->pi_getLLWrap($pObj, 'api_i' .
							$mydis . 'like_likethis_lat_tu', $fromAjax) . implode($uchtmlarr);

				} else {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_ilike_you', $fromAjax) . $nbrinterpunkt . $likingusersstr . ' ' . $others . ' ' .
					$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis', $fromAjax) . implode($uchtmlarr);

				}

				$mylikehtmlnv= $mylikehtml;
			}

		}

		$mylike= '<img alt="' . $mylikepicalkt . '" title="' . $mylikepicalkt
		. '" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/' . $mylikepic . '" />';
		$retarr=array();

		//if (intval($conf['ratings.']['useShortTopLikes']) == 1) {

		if (($conf['ratings.']['useLikeDislikeStyle'] == 0)) {
			$retarr[0]=$mylike;
			$retarr[1]=$mylikehtml;
			$retarr[2]=$mylikehtmlnv;
			$retarr[3]=$mylikepic;
			$retarr[4]=$mylikepicalkt;
			// short form
			if ((substr($ref, 0, 9)!=='tx_toctoc')) {
				if (intval($conf['ratings.']['useShortTopLikes']) == 1) {
					$retarr[0]=$mylike;
					$retarr[1]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[2]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[3]=$mylikepic;
					$retarr[4]=$mylikepicalkt;
				}

			}

		} elseif (($conf['ratings.']['useLikeDislikeStyle']==1)) {
			// short form
			if ((substr($ref, 0, 9)!=='tx_toctoc')) {
				if (intval($conf['ratings.']['useShortTopLikes']) == 0) {
					$retarr[0]=$mylike;
					$retarr[1]=$mylikehtml;
					$retarr[2]=$mylikehtmlnv;
					$retarr[3]=$mylikepic;
					$retarr[4]=$mylikepicalkt;
				} else {
					$retarr[0]=$mylike;
					$retarr[1]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[2]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
					$retarr[3]=$mylikepic;
					$retarr[4]=$mylikepicalkt;
				}

			} else {
				//when it's a comment
				$retarr[0]=$mylike;
				$retarr[1]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
				$retarr[2]=intval($myrating['allrecs'][0]['totali' . $mydis . 'likes']);
				$retarr[3]=$mylikepic;
				$retarr[4]=$mylikepicalkt;
			}

		} else {
			$retarr[0]=$mylike;
			$retarr[1]=$mylikehtml;
			$retarr[2]=$mylikehtmlnv;
			$retarr[3]=$mylikepic;
			$retarr[4]=$mylikepicalkt;

		}

		return $retarr;
	}

	/**
	 * TYPO3 workarounds
	 *
	 *
	 */

	/**
	 * Implements enableFields call that can be used from regular FE and eID
	 *
	 * @param	string		$tableName	Table name
	 * @param	object		$pObj: parent object
	 * @param	boolean		$getFromSession: ...
	 * @return	string		SQL
	 */
	public function enableFields($tableName, $pObj, $getFromSession = FALSE) {
		if ($getFromSession == FALSE) {
			if ($GLOBALS['TSFE']) {
				$wherec=$pObj->cObj->enableFields($tableName);
				$_SESSION['enfi'][$tableName]=$wherec;
				return $wherec;
			}
		}

		// With eID $GLOBALS['TCA'] is not available, so we need a session to store data at pi, then use it in eID
		$wherec=$_SESSION['enfi'][$tableName];
		return $wherec;
	}

	/**
	 * Handles language labels
	 *
	 * @param	object		$pObj: parent object
	 * @param	string		$llkey: key to the string in the xml file
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	string		translated label text
	 */
	public function pi_getLLWrap($pObj, $llkey, $fromAjax) {
		$lan=$_SESSION['activelangid'];
		if (!$fromAjax) {
			if (!isset($_SESSION['piGllW'][$lan][$llkey])) {
				$this->trackdebug('0 pi_getLLWrap');
				if ($pObj->conf['ll.'][$GLOBALS['TSFE']->lang . '.'][str_replace('.', '-', $llkey)]!='') {
					$_SESSION['piGllW'][$lan][$llkey]= $pObj->conf['ll.'][$GLOBALS['TSFE']->lang . '.'][str_replace('.', '-', $llkey)];
				} else {
					$_SESSION['piGllW'][$lan][$llkey]= $pObj->pi_getLL($llkey);
				}

				$this->trackdebug('0 pi_getLLWrap');
			}

			return  $_SESSION['piGllW'][$lan][$llkey];
		} else {
			if (!isset($_SESSION['piGllW'][$lan][$llkey])) {

				$language = &$GLOBALS['LANG'];
				$lan = $GLOBALS['LANG']->id;

				if ($pObj->conf['ll.'][$_SESSION['activelang'] . '.'][str_replace('.', '-', $llkey)]!='') {
					$_SESSION['piGllW'][$lan][$llkey]= $pObj->conf['ll.'][$_SESSION['activelang'] . '.'][str_replace('.', '-', $llkey)];
				} else {
					$_SESSION['piGllW'][$lan][$llkey]= $GLOBALS['LANG']->getLL($llkey);
				}

			}
			return $_SESSION['piGllW'][$lan][$llkey];
		}

	}

	/**
	 * simplified substitute for TYPO3 function getSubpart, allowing trackdebug
	 *
	 * @param	[type]		$pObj: ...
	 * @param	string		$templateCode: ...
	 * @param	string		$templateMarker: ...
	 * @return	string		$templateout
	 */
	protected function t3getSubpart ($pObj, $templateCode, $templateMarker) {
		$this->trackdebug('0 t3getSubpart');
		if (!isset($_SESSION['subParts'][$templateMarker])) {
			$templateout= $pObj->cObj->getSubpart($templateCode, $templateMarker);
			$_SESSION['subParts'][$templateMarker]=$templateout;
		} else {
			$templateout=$_SESSION['subParts'][$templateMarker];
		}

		$this->trackdebug('0 t3getSubpart');
		return $templateout;
	}

	/**
	 * simplified substitute for TYPO3 function substituteMarkerArray
	 *
	 * @param	string		$content: ...
	 * @param	array		$markContentArray: ...
	 * @return	string		$content
	 */
	public function t3substituteMarkerArray ($content, $markContentArray) {

		if (is_array($markContentArray)) {
			foreach ($markContentArray as $marker => $markContent) {
				$marker = '' . $marker;
				$content = str_replace($marker, $markContent, $content);
			}

		}

		return $content;
	}

	/**
	 * simplified substitute for TYPO3 function substituteMarker, allowing trackdebug
	 *
	 * @param	string		$template: ...
	 * @param	string		$marker: ...
	 * @param	string		$markContent: ...
	 * @return	string		$templateout
	 */
	protected function t3substituteMarker ($template, $marker, $markContent) {
		$this->trackdebug('0 t3substituteMarker');
		$templateout= str_replace($marker, $markContent, $template);
		$this->trackdebug('0 t3substituteMarker');
		return $templateout;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$usetemplateFile: ...
	 * @return	[type]		...
	 */
	protected function t3fileResource ($pObj, $usetemplateFile) {
		$this->trackdebug('0 t3fileResource');
		$templateout = $pObj->cObj->fileResource($usetemplateFile);
		$this->trackdebug('0 t3fileResource');
		return $templateout;

	}

	/**
	 * returns a check-string for Ajax-posts
	 *
	 * @param	string		$ref: record reference
	 * @param	int		$i: rating value
	 * @param	string		$ajaxData: ...
	 * @param	boolean		$ratingscheck: if its a request concerning ratings.
	 * @return	string		md5 encoded check-string
	 */
	protected function getcheck ($ref, $i, $ratingscheck) {
		if ($this->check !== '') {
			if (!$ratingscheck) {
				$checkstr =$this->check;
			} else {
				$checkstr = md5($ref . $i . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			}

		} else {
			$checkstr = md5($ref . $i . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
		}

		return $checkstr;
	}

	/**
	 * Formats date to readable 'time ago'-format
	 *
	 * @param	int		$date	Date as Unix timestamp
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	[type]		$conf: ...
	 * @return	string		Formatted date
	 */
	protected function formatDate($date, $pObj, $fromAjax, $conf) {

		if ($conf['advanced.']['dateFormatOldStyle'] == 1) {
			if ($conf['advanced.']['dateFormatMode'] == 'strftime') {
				$retstr=strftime($conf['advanced.']['dateFormat'], $date);
				if ($retstr=='') {
						$retstr='strftime format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
				}

			} else {
				$retstr=date($conf['advanced.']['dateFormat'], $date);
				if ($retstr=='') {
					$retstr='date format "' . $conf['advanced.']['dateFormat'] . '" is invalid on your system';
				}

			}

		} else {

			$start_time_for_conversion = $date;
			$end_time_for_conversion = time();

			$difference_of_times = $end_time_for_conversion - $start_time_for_conversion;

			$time_difference_string = '';
			$stringcollator=0;
			$morethanonstr ='';
			for($i_make_time = 6; $i_make_time > 0; $i_make_time--)	{
				switch($i_make_time)
				{
					// Handle Minutes
					// ........................

					case '1';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.minute', $fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.minutes', $fromAjax);

					$unit_size = 60;
						break;

					// Handle Hours
					// ........................

					case '2';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hour', $fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hours', $fromAjax);

					$unit_size = 3600;
						break;

						// Handle Days
						// ........................

						case '3';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.day', $fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.days', $fromAjax);
					$unit_size = 86400;
						break;

						// Handle Weeks
						// ........................

						case '4';
						$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.week', $fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.weeks', $fromAjax);

					$unit_size = 604800;
						break;

						// Handle Months (31 Days)
						// ........................

						case '5';
						$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.month', $fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.months', $fromAjax);
					$unit_size = 2678400;
						break;

						// Handle Years (365 Days)
						// ........................

						case '6';
						$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.year', $fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.years', $fromAjax);
					$unit_size = 31536000;
						break;
				}

				if ($difference_of_times > ($unit_size - 1)) {
					$modulus_for_time_difference = $difference_of_times % $unit_size;
					$seconds_for_current_unit = $difference_of_times - $modulus_for_time_difference;
					$units_calculated = $seconds_for_current_unit / $unit_size;
					$difference_of_times = $modulus_for_time_difference;

					if ($stringcollator<2) {
						if ($units_calculated==1) {
							$time_difference_string .= $units_calculated . ' ' . $unit_title . ' ';
						} else {
							$time_difference_string .= $units_calculated . ' ' . $morethanonstr . ' ';
						}

						$stringcollator = $stringcollator + 1;
					}

				}

			}

			// Handle Seconds
			// ........................
			if ($stringcollator<2) {
					if ($difference_of_times==1) {
							$time_difference_string .= $difference_of_times . ' ' .
							$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.second', $fromAjax) . ' ';
					} else {
							$time_difference_string .= $difference_of_times . ' '  .
							$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.seconds', $fromAjax) . ' ';
					}

			}

			 $retstr= trim($this->pi_getLLWrap($pObj, 'pi1_template.timeconv.textbefore', $fromAjax) . ' ' .
			 		$time_difference_string . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.textafter', $fromAjax));
			 $retstr= str_replace('-', '', $retstr );
		}

		return $retstr;
	}

	/**
	 * Retrieves the URL of the current page
	 *
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @param	int		$pid: pageid
	 * @return	string		current URL
	 */
	protected function getPageURL($fromAjax = FALSE, $pid = 0) {
		if ($fromAjax) {
			$pageURL = $_SESSION['commentsPageIdsClean'][$pid];
		} else {
			$pageURL = (@$_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
			if (($_SERVER['SERVER_PORT'] != '80') && ($_SERVER['SERVER_PORT'] != '443')) {
				$pageURL .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
			} else {
				$pageURL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			}

		}

		return $pageURL;
	}

	/**
	 * returns typo3 root if installed in subdir
	 *
	 * @param	boolean		$withleadingslash: if ture leading slash is included
	 * @return	string		ex: '/' or '/typo3dir/' ..
	 */
	public function locationHeaderUrlsubDir($withleadingslash = TRUE) {
		$parts = explode('//', t3lib_div::locationHeaderUrl('') );
		if (count($parts)>1) {
			$partafterroot=$parts[1];
			$partafterrootarr=explode('/', $partafterroot);
			unset($partafterrootarr[0]);
			$partafterroot=implode('/', $partafterrootarr);
			if ($withleadingslash) {
				return '/' . $partafterroot;
			} else {
				return $partafterroot;
			}

		}

		$retstr = t3lib_div::locationHeaderUrl('');
		return $retstr;
	}

	/**
	 * Cleans out generated HTML from AJAX
	 *
	 * @param	string		$html: dirty html
	 * @return	string		clean html..
	 */
	protected function getCleanHTML ($html) {
		//return $html;

		$html = preg_replace('/\n/', '', $html);
		$html = preg_replace('/\s\s+/', ' ', $html);

		$html = preg_replace('/> </', '><', $html);
		$html = str_replace(array("\r\n", "\r", "\n"), '', $html);
		$html = str_replace('div><div', "div>\r\n<div", $html);
		$html = str_replace('</div></div>', "</div>\r\n</div>", $html);
		$search = array(
				'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
		);
		$html = preg_replace($search, '', $html);
		return $html;
	}
	/**
	 * Get the HTML for the login form
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	string
	 */
	public function getLoginForm() {
		$retstr = '';
		if (!(isset($this->liblogin))) {
			require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi2/class.toctoc_comments_felogin_pi1.php'));
			if (!isset($_SESSION['liblogin'])) {
				$_SESSION['liblogin'] = array();
			}

			if (!isset($_SESSION['liblogin']['L' . $_SESSION['activelang']]) ){
				$this->liblogin = new tx_toctoccomments_pi2;
				$_SESSION['liblogin']['L' . $_SESSION['activelang']] = serialize($this->liblogin);
			} else {

				$this->liblogin = unserialize($_SESSION['liblogin']['L' . $_SESSION['activelang']]);
			}

		}

		$conf2=array();
		$conf2=$GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi2.'];
		$retstr= $this->liblogin->main($content, $conf2, FALSE);
		return $retstr;
	}
	/**
	 * Get the HTML for the login form
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	string
	 */
	public function getChangePasswordForm($uid = 0, $piHash = '') {
		$retstr = '';
		if (!(isset($this->liblogin))) {
			require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi2/class.toctoc_comments_felogin_pi1.php'));
			if (!isset($_SESSION['liblogin'])) {
				$_SESSION['liblogin'] = array();
			}

			if (!isset($_SESSION['liblogin']['L' . $_SESSION['activelang']]) ){
				$this->liblogin = new tx_toctoccomments_pi2;
				$_SESSION['liblogin']['L' . $_SESSION['activelang']]=serialize($this->liblogin);
			} else {
				$this->liblogin=unserialize($_SESSION['liblogin']['L' . $_SESSION['activelang']]);
			}

		}

		$conf2=array();
		$conf2=$GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi2.'];
		$retstr= $this->liblogin->main($content, $conf2, TRUE, $uid, $piHash);
		return $retstr;
	}
	/**
	 * Get the HTML for the smilie and emoji selectors
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$buildthisbb: ...
	 * @param	[type]		$returnbbarray: ...
	 * @return	string
	 */
	public function getBBCard($conf, $pObj, $buildthisbb = FALSE, $returnbbarray = FALSE) {
		$retstr = '';
		if ($returnbbarray==TRUE) {
			$retarr = array();
		}
		$htmlcontent = '<div class="tx-tc-bbpopup" id="tx-tc-bbppp">';

		$bbhtmlarr = explode(',', $this->BBhtmls);
		$bbcodearr = explode(',', $this->BBcodes);
		$bbimgposarr = explode(',', $this->BBimgpos);
		$bbcodeconfarr = explode(',', $conf['advanced.']['BBCodebbs']);
		$BBretarr = array();
		$BBretarr['html']= array();
		$BBretarr['bb']= array();

		if ($buildthisbb == TRUE) {
			$icnt = count($bbcodearr);
			$j = 0;
			$jbb = 0;
			$_SESSION['BBretarr'] = array();
			if (count($this->BBs) == 0 ) {
				foreach ($bbcodeconfarr as $bbcodeconf) {
					for ($i = 0; $i < $icnt; $i++) {
						if (trim($bbcodearr[$i]) == trim($bbcodeconf)) {
							$this->BBs[$jbb] = array('[' . $bbcodearr[$i] . ']', '<' . $bbhtmlarr[$i] . '>');
							$jbb++;
							$this->BBs[$jbb] = array('[/' . $bbcodearr[$i] . ']', '</' . $bbhtmlarr[$i] . '>');
							$jbb++;
							$BBretarr['html'][$j] = trim($bbhtmlarr[$i]);
							$BBretarr['bb'][$j] = trim($bbcodearr[$i]);

							$j++;
						}

					}
				}

			} else {
				foreach ($bbcodeconfarr as $bbcodeconf) {
					for ($i = 0; $i < $icnt; $i++) {
						if (trim($bbcodearr[$i]) == trim($bbcodeconf)) {
							$BBretarr[$j] = trim($bbhtmlarr[$i]);
							$j++;
						}

					}
				}
			}

			if (count($_SESSION['BBretarr'])==0) {
				$_SESSION['BBretarr'] = $BBretarr;
			}

		} else {
			$i=0;
			foreach ($bbcodeconfarr as $bbcodeconf) {
				$this->BBtitles[$i] = $this->pi_getLLWrap($pObj, 'pi1_template.bb_' . trim($bbcodeconf), FALSE);
				$i++;
			}

			$this->BBtitles[$i+1] = $this->pi_getLLWrap($pObj, 'pi1_template.bb_copy', FALSE);
			$this->BBtitles[$i+2] = $this->pi_getLLWrap($pObj, 'pi1_template.bb_paste', FALSE);
			$this->BBtitles[$i+3] = $this->pi_getLLWrap($pObj, 'pi1_template.bb_cut', FALSE);
			$this->BBtitles[$i+4] = $this->pi_getLLWrap($pObj, 'pi1_template.bb_del', FALSE);
			// return the bb-html
			$icnt = count($bbcodearr);
			foreach ($bbcodeconfarr as $bbcodeconf) {
				for ($i = 0; $i < $icnt; $i++) {
					if (trim($bbcodearr[$i]) == trim($bbcodeconf)) {
						$htmlcontent .= '<span id="txtcbb-'. $bbcodearr[$i] .'" class="tx-tc-bb-item tx-tc-bb-'. $bbcodearr[$i] .
						'" title="' . $this->BBtitles[$i] . '"></span>';
					}

				}

			}

			$htmlcontent .= '<span class="tx-tc-bb-f-del tx-tc-bb-item" id="txtcbb-del" title="' . $this->BBtitles[$i+4] . '"></span>';
			$titleclose = $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', FALSE);
			$htmlcontent .= '<span class="tx-tc-bbclose tx-tc-CloseButton" title="'.$titleclose.'"></span>';
			$htmlcontent .= '</div>';
		}

		if ($returnbbarray==TRUE) {
			return $_SESSION['BBretarr'];
		} else {
			$retstr = base64_encode($htmlcontent);
			return $retstr;
		}

	}
	/**
	 * Usercards
	 *
	 *
	 */

	/**
	 * Get the HTML for the smilie and emoji selectors
	 *
	 * @param	[type]		$conf: ...
	 * @return	string		Informations about the userstatistics
	 */
	public function getSmiliesCard($conf) {
		$retstr='';
		$pagepacketsize = 21;   //3 times 7 icons
		$smilingpages = array();
		$smilingpagescategories = array();
		$this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
				$conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);

		$i=0;
		$smilingpagesi=0;
		$comparepath='';
		$content='';

		// first pages are filled with the smilies from conf
		if (intval($conf['advanced.']['useInternalSmiliesInEmojiSelector']) == 1){
			foreach ($this->smilies as $path => $smilieArray) {
				foreach ($smilieArray as $smilie) {

					$image = '<img class="tx-tc-emo-int-img" id="tx-tc-emo-int-img-' . str_replace("'", "\'", $smilie) . '" alt="' .
					$smilie . '" title="' . $path
					. '" src="' . $this->smiliesPath . '/' . $path . '.' . $conf['fileExt'] . '" />';
					if ($comparepath != $path) {
						$comparepath = $path;
						$content .= $image . ' ';
						$i++;
						if (($i % $pagepacketsize) == 0){
							$smilingpages[$smilingpagesi]['content'] = $content;
							$smilingpages[$smilingpagesi]['pagetitle'] = 'Smilies page ' . ($smilingpagesi+1);
							$smilingpages[$smilingpagesi]['page'] = ($smilingpagesi+1);
							$smilingpages[$smilingpagesi]['title'] = 'Smilies';
							$content='';
							$smilingpagesi++;
						} elseif (($i % ($pagepacketsize/3)) == 0) {
							$content = trim($content) . '<br />';
						}

					}

				}

			}

			if ($i>0) {
				if (($i % $pagepacketsize) != 0){
					$smilingpages[$smilingpagesi]['content']=$content;
					$smilingpages[$smilingpagesi]['pagetitle']='Smilies page ' . ($smilingpagesi+1);
					$smilingpagesi++;
				}

			}

		}

		$categorycount=5;
		$categorypagescount[0]=$smilingpagesi;
		$categorypagescount[1]=9;
		$categorypagescount[2]=6;
		$categorypagescount[3]=11;
		$categorypagescount[4]=5;
		$categorypagescount[5]=10;
		$smilingcatarr_titles =array();
		if ($smilingpagesi>0) {
			$smilingpagescategories['Smilies'] = $smilingpages;
			$smilingcatarr_titles[0] ='Smilies';
			$categorycount=6;
		}

		$content='';
		// now the emojis
		if ($conf['advanced.']['useEmoji']>=1) {
			if (!(isset($this->libemoji))) {
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_emoji.php'));
				$this->libemoji = new toctoc_comments_emoji;
			}

			if (!(isset($this->libemojitr))) {
				require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_emoji_language.php'));
				$this->libemojitr =  new toctoc_comments_emoji_language;
			}

			// getting emojis by category in an ordered list by category
			$emojiCategoryArr = $this->libemoji->emoji_categories();
			// getting the Textvalues in UPPERCASE for the sometimes different lowercase names in the category list.
			$emojicategoryconvarr = $this->libemoji->emoji_categories_to_textcodes();
			// make an inverted array of the categories list where the value is the key.
			$emojiCategoryArrKeysArr=array_keys($emojiCategoryArr);

			// now for every category ...
			$countemojiCategoryArr=count($emojiCategoryArr);
			for ($i=0; $i<$countemojiCategoryArr; $i++) {
				// init some vars
				$j=1;
				$jstr=''.$j;
				$content = '';
				$contentcoll='';
				$contentsml='';
				$smilingpages = array();
				$smilingpagesi=0;
				$emojiCategoryContentsArr=array();

				// nopw we make an array containing the subarray of the current category
				$emojiCategoryContentsArr=$emojiCategoryArr[$emojiCategoryArrKeysArr[$i]];

				$currentCategory=$emojiCategoryArrKeysArr[$i];
				if ($_SESSION['activelang'] == 'de') {
					$currentCategory=$this->libemojitr->emoji_translate($emojiCategoryArrKeysArr[$i], $_SESSION['activelang'], TRUE);
				}

				$countemojiCategoryContentsArr=count($emojiCategoryContentsArr);
				for ($icat=0; $icat<$countemojiCategoryContentsArr; $icat++) {

					$content .= ':' . $emojicategoryconvarr[$emojiCategoryContentsArr[$jstr]] . ': ';
					$contentsml .= ':' . $emojiCategoryContentsArr[$jstr] . ': ';
					$j++;
					$jstr=''.$j;
				}

				// Content is prepared now with the correct keys to access the emojification !
				$content = $this->libemoji->emoji_text_to_html($content, t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_emoji_language.php'),
						$contentsml, $_SESSION['activelang']);
				$contentarr = explode('> <', $content);
				$contentcoll='';
				$content='';
				$countcontentarr=count($contentarr);
				for ($icat=0; $icat<$countcontentarr; $icat++) {
					if ($icat==0) {
						$content .= $contentarr[$icat] . '>';
					} elseif ($icat==count($contentarr)-1) {
						$content .= ' <' . $contentarr[$icat];
					} else {
						$content .= ' <' . $contentarr[$icat] . '>';
					}

					if ((($icat+1)  % ($pagepacketsize/3)) == 0) {

						$contentcoll .= trim($content) . '<br />';
						$content='';
						$contentsml='';
					}

					if ((($icat+1) % $pagepacketsize) == 0){

						$smilingpages[$smilingpagesi]['content']=''.$contentcoll;
						$smilingpages[$smilingpagesi]['pagetitle']=$currentCategory . ' page ' . ($smilingpagesi+1);
						$smilingpages[$smilingpagesi]['page']= ($smilingpagesi+1);
						$smilingpages[$smilingpagesi]['title']=$currentCategory;
						$contentcoll='';
						$content='';
						$contentsml='';
						$smilingpagesi++;
					}

				}

				if ($icat>0) {
					if ((($icat)  % $pagepacketsize) != 0){
						$contentcoll= trim($contentcoll . $content);
						$smilingpages[$smilingpagesi]['content']=''.$contentcoll;
						$smilingpages[$smilingpagesi]['pagetitle']=$currentCategory . ' page ' .  ($smilingpagesi+1);
						$smilingpages[$smilingpagesi]['page']= ($smilingpagesi+1);
						$smilingpages[$smilingpagesi]['title']=$currentCategory;
						$content='';
						$contentcoll='';
						$contentsml='';
					}

				}

				$smilingpagescategories[$currentCategory] = $smilingpages;
				$smilingcatarr_titles[$i+1]=$currentCategory;
			}

		}

		$smilingpagespage=1;
		$smilingpagestitle='';
		//index on the pages
		$smiling_i=0;
		//index on the categries
		$smilingcat_i=0;
		$smilingcatstart_i=0;
		if($categorycount==5){
			// we start at index 1 if there are no internal smilies
			$smilingcatstart_i=1;
		}

		$dispclass=' tx-tc-blockdisp';
		$htmlcontent='<div class="tx-tc-emopages" id="tx-tc-thisemopages">';
		foreach ($smilingpagescategories as $smilingpagescategory) {
			foreach ($smilingpagescategory as $smilingpage) {
				if ($smilingpagestitle!=$smilingpage['title']) {

					$smilingpagestitle=$smilingpage['title'];
				}

				if ($dispclass!=' tx-tc-nodisp') {
					$htmlcontent .= '<div class="tx-tc-emopage ' . $dispclass . '" id="tx-tc-emopage-' . $smilingcat_i . '-' . $smiling_i . '">';
					$dispclass=' tx-tc-nodisp';
				} else {
					$htmlcontent .= '
						<div class="tx-tc-emopage ' . $dispclass . '" id="tx-tc-emopage-' . $smilingcat_i . '-' . $smiling_i . '">';
				}

				// for every subpage
				$widthemotop=16*$categorypagescount[($smilingcat_i+$smilingcatstart_i)];
				$htmlcontent .= '<div class="tx-tc-emo-nav-frm"><div class="tx-tc-emo-top-nav" style="width: ' . $widthemotop . 'px">';
				// there as many dots to draw as speced in $categorypagescount
				// startindex is 1 later if there are no internal smilies
				for ($i=0; $i<$categorypagescount[($smilingcat_i+$smilingcatstart_i)]; $i++) {
					$htmlcontentspn = '<span class="tx-tc-emo-top-nav-';
					if ($i==$smiling_i) {
						$htmlcontent .= $htmlcontentspn . 'on"></span>';
					} else {
						$htmlcontent .= '<a class="tx-tc-emoselpage" id="tx-tc-emoselpage-' . $smilingcat_i . '-' . $i.'__'.$smilingcat_i . '-' . $smiling_i.'">' .
						$htmlcontentspn . 'off"></span></a>';
					}

					$htmlcontent .= '</span>';
				}

				$htmlcontent .= '</div></div>';
				//inserting the emojis
				$htmlcontent .= '<div class="tx-tc-emopage-emojis">';
				$htmlcontent .= $smilingpage['content'];
				$htmlcontent .= '</div>
						';
				 // now the bottom part
				$htmlcontent .= '<div class="tx-tc-emo-nav-frm"><div class="tx-tc-emo-bot-nav tx-tc-emo-bot-nav-' . $categorycount . '">';

				for ($i=$smilingcatstart_i; $i<6; $i++) {
					$htmlcontentspn = '<span title="' . $smilingcatarr_titles[$i] . '" class="tx-tc-emo-bot-nav-item tx-tc-emo-bot-nav-0-'. $i . '-';
					if (($i-$smilingcatstart_i)==($smilingcat_i)) {
						$htmlcontent .= $htmlcontentspn . 'on">';
					} else {
						$htmlcontent .= '<a class="tx-tc-emoselpage" id="tx-tc-emoselpage-' . ($i-$smilingcatstart_i) . '-0__'.$smilingcat_i . '-' . $smiling_i.'">' .
						$htmlcontentspn . 'off"></a>';
					}

					$htmlcontent .= '</span>';
				}

				$htmlcontent .= '</div></div></div>';
				$smiling_i++;
			}

			$smiling_i=0;
			$smilingcat_i++;
		}

		$retstr = base64_encode($htmlcontent);
		return $retstr;
	}

	/**
	 * Get a the information about a user
	 *
	 * @param	string		$basedimgstr: baseencoded string containing the link to the users image in typo3temp
	 * @param	string		$basedtoctocuid: baseencoded string containing the toctoc-userid
	 * @param	array		$conf: plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	int		$commentid: uid of the comment
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$fromusercenter: ...
	 * @return	string		Informations about the userstatistics
	 */
	public function getUserCard($basedimgstr, $basedtoctocuid, $conf, $pObj, $commentid, $fromAjax = TRUE, $fromusercenter = FALSE) {
		// Get UserCard display

		if (trim($basedimgstr) !='') {
			$imgstr =base64_decode($basedimgstr);
			$toctocuid=base64_decode($basedtoctocuid);
			$closestr ='';
			$mailurl =  $this->locationHeaderUrlsubDir();
			$nbsp ='';
			// patching improper img-tag if ever (from top links)
			$imgstr = str_replace('>', '', $imgstr);
			if ((strpos($imgstr, '">') < 1)) {
				$imgstr.='" />';
			}

			if ((strpos($imgstr, '>') < 1)) {
				$imgstr.=' />';
			}

			$imgstr = str_replace('alt="">', 'alt="" />', $imgstr);

		} else {
			// call from SendNotificationMail
			$toctocuid=$basedtoctocuid;
			$imgstr ='';
			$closestr ='';
			$nbsp ='&nbsp;';
			$mailurl = $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''),));
		}

		$replstr = 'tx-tc-uimgsize"';
		$newstr = 'tx-tc-uimgsize96"';
		if ($conf['theme.']['selectedBoxmodelkoogled']==1) {
			$newstr = 'tx-tc-uimgsize96 tx-tx-uc-img-koogle"';
		}
		$ucnametitle='';
		$septag = '<br />';
		if ($fromusercenter == TRUE) {
			$septag = ', ';
		}
		$dataWhereuser = 'deleted= 0 AND pid=' . intval($conf['storagePid']) .
		' AND toctoc_comments_user = "' . $toctocuid . '"';
		$subWheretoctocuser = ' AND toctoc_comments_user = "' . $toctocuid . '"';
		list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_toctoc_comments_user', $dataWhereuser);

		if ($conf['UCUserStatsByEmail'] == 1 ) {

			$dataWhereuser = 'deleted= 0 AND pid=' . intval($conf['storagePid']);
			if (($rowusr['initial_email'] != '') && ($rowusr['current_email'] == ''))   {
				$subWheretoctocuser = ' AND ((initial_email = "' . $rowusr['initial_email'] . '") OR (current_email = "' . $rowusr['initial_email'] . '"))';
			}

			if (($rowusr['initial_email'] == '') && ($rowusr['current_email'] != ''))   {
				$subWheretoctocuser = ' AND ((initial_email = "' . $rowusr['current_email'] . '") OR (current_email = "' . $rowusr['current_email'] . '"))';
			}

			if (($rowusr['initial_email'] != '') && ($rowusr['current_email'] != '')) {
				$subWheretoctocuser = ' AND ((initial_email = "' . $rowusr['initial_email'] . '") OR (current_email = "' . $rowusr['current_email'] . '")';
				$subWheretoctocuser .= ' OR (initial_email = "' . $rowusr['current_email'] . '") OR (current_email = "' . $rowusr['initial_email'] . '"))';
			}

			$dataWhereuser .= $subWheretoctocuser;
			$saveifn = $rowusr['initial_firstname'];
			$saveiln = $rowusr['initial_lastname'];
			$savecfn = $rowusr['current_firstname'];
			$savecln = $rowusr['current_lastname'];
			$saveie = $rowusr['initial_email'];
			$savece = $rowusr['current_email'];

			list($rowusrall) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('MAX(toctoc_comments_user) AS toctoc_comments_user,
					MAX(ip) AS ip,
					MAX(ipresolved) AS ipresolved,
					MAX(initial_firstname) AS initial_firstname,
					MAX(initial_lastname) AS initial_lastname,
					MAX(initial_email) AS initial_email,
					MAX(initial_homepage) AS initial_homepage,
					MAX(initial_location) AS initial_location,
					MAX(current_firstname) AS current_firstname,
					MAX(current_lastname) AS current_lastname,
					MAX(current_email) AS current_email,
					MAX(current_homepage) AS current_homepage,
					MAX(optin_email) AS optin_email,
					MAX(current_location) AS current_location',
					'tx_toctoc_comments_user', $dataWhereuser);

			$rowusr = array();
			$rowusr = $rowusrall;

			$rowusr['initial_firstname'] = $saveifn;
			$rowusr['initial_lastname'] = $saveiln;
			$rowusr['current_firstname'] = $savecfn;
			$rowusr['current_lastname'] = $savecln;
			$rowusr['toctoc_comments_user'] = $toctocuid;
			$rowusr['initial_email'] = $saveie;
			$rowusr['current_email'] = $savece;
		}
		// vote of the user
		$dataWhereusersum = 'deleted=0 ' . $subWheretoctocuser;
		list($rowusrsum) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('MIN(tstamp) AS tstamp, MIN(pid) AS pid, MIN(uid) AS uid,
SUM(comment_count) AS comment_count, SUM(vote_count*average_rating)/SUM(vote_count) AS average_rating,
SUM(vote_count) AS vote_count, SUM(like_count) AS like_count, SUM(dislike_count) AS dislike_count, MAX(tstamp_lastupdate) AS tstamp_lastupdate',
				'tx_toctoc_comments_user',
				$dataWhereusersum);

		$pizzateile = explode('.', $toctocuid);
		$feuserid = $pizzateile[4];
		$dataWherefeuser = 'uid=' . intval($feuserid);
		list($rowfeusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'fe_users', $dataWherefeuser);
		$dataWherecomment = 'uid=' . $commentid;
		list($rowcomment) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'tx_toctoc_comments_comments', $dataWherecomment);
		if ($conf['userContactUC']) {

			// Name on the User Card
			$ucfullname='';
			if ($rowusr['toctoc_comments_user'] == $toctocuid) {
				$ucfullnameone = $rowusr['initial_firstname'] . ' ' . $rowusr['initial_lastname'];
				$ucfullnametwo = $rowusr['current_firstname'] . ' ' . $rowusr['current_lastname'];
				if ($rowusr['initial_firstname'] != '') {
					$ucfullname.=$rowusr['initial_firstname'];
					if ($rowusr['current_firstname'] != '') {
						if ($rowusr['initial_firstname'] != $rowusr['current_firstname']) {
							$ucfullname .= ' (' . $rowusr['current_firstname'] . ')';
						}

					}

				} else {
					$ucfullname.=$rowusr['current_firstname'];
				}

				if ($ucfullname!='') {
					$ucfullname .= ' ';
				}

				if ($rowusr['initial_lastname'] != '') {
					$ucfullname.=$rowusr['initial_lastname'];
					if ($rowusr['current_lastname'] != '') {
						if ($rowusr['initial_lastname'] != $rowusr['current_lastname']) {
							$ucfullname .= ' (' . $rowusr['current_lastname'] . ')';
						}

					}

				} else {
					$ucfullname.=$rowusr['current_lastname'];
				}

				$divtostats=0;
				$addnameinfo ='';
				$postingname = $rowcomment['firstname'] . ' ' . $rowcomment['lastname'];
				if (trim($postingname) != '') {
					if ((trim($ucfullnameone) != '') && (trim($ucfullnametwo) != '')) {
						if ((trim($postingname) != trim($ucfullnameone)) && (trim($postingname) != trim($ucfullnametwo))) {
							$divtostats=1;
						}

					} elseif ((trim($ucfullnameone)!= '') && (trim($ucfullnametwo) == '')) {
						if (trim($postingname) != trim($ucfullnameone)) {
							$divtostats=1;
						}

					} elseif ((trim($ucfullnameone)== '') && (trim($ucfullnametwo) != '')) {
						if (trim($postingname) != trim($ucfullnametwo)) {
							$divtostats=1;
						}

					}

					if ($divtostats==1) {
						$addnameinfo = '<br /><span class="tx-tc-ct-uc-fullname_addinfo">' .
						'(' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.herepostingas', $fromAjax) . ' ' . $postingname . ')' . '</span>';
					}

				}

				if (($conf['ratings.']['useLikeDislikeStyle']==1) && (trim($basedimgstr) !='')) {
					$ucnametitle='<div class="tx-tc-ct-uc-text-contact-title">' . $ucfullname . '</div>';
				}

				// email on the User Card
				$uccontact='';
				$ucemail='';
				if ($conf['userEmailUC']) {
					if ($rowusr['initial_email'] != '') {
						if ($basedimgstr !='') {
							$ucemailarr = $this->getMailTo($rowusr['initial_email']);
							$ucemail = '<a href="'. $ucemailarr[0] . '">' . $ucemailarr[1] . '</a>';
						} else {
							$ucemail = '<a href="mailto:'. $rowusr['initial_email'] . '">' . $rowusr['initial_email'] . '</a>';
						}

						if ($rowusr['current_email'] != '') {
							if ($rowusr['initial_email'] != $rowusr['current_email']) {
								if ($basedimgstr !='') {
									$ucemailarrc = $this->getMailTo($rowusr['current_email']);
									$ucemailstr = '<a href="'. $ucemailarrc[0] . '">' . $ucemailarrc[1] . '</a>';
								} else {
									$ucemailstr = '<a href="mailto:'. $rowusr['current_email'] . '">' . $rowusr['current_email'] . '</a>';
								}

								$ucemail .= ' (' . $ucemailstr . ')';
							}

						}

					} else {
						if ($rowusr['current_email'] != '') {
							if ($basedimgstr !='') {
								$ucemailarr = $this->getMailTo($rowusr['current_email']);
								$ucemail = '<a href="'. $ucemailarr[0] . '">' . $ucemailarr[1] . '</a>';
							} else {
								$ucemail = '<a href="mailto:'. $rowusr['current_email'] . '">' . $rowusr['current_email'] . '</a>';
							}
						}

					}

				}

				$uccontact .=$ucemail;
				// location on the User Card
				$ucelocation='';
				if ($conf['userLocationUC']) {
					if ($rowusr['initial_location'] != '') {
						$uclocation.= $this->pi_getLLWrap($pObj, 'pi1_template.uc.livesin', $fromAjax) .' ' . $rowusr['initial_location'];
						if ($rowusr['current_location'] != '') {
							if ($rowusr['initial_location'] != $rowusr['current_location']) {
								$uclocation .= ' (' . $rowusr['current_location'] . ')';
							}

						}

					} else {
						if ($rowusr['current_location'] != '') {
							$uclocation.= $this->pi_getLLWrap($pObj, 'pi1_template.uc.livesin', $fromAjax) . ' ' . $rowusr['current_location'];
						}

					}

				}

				if (($uccontact != '') && ($ucelocation != '')) {
					$uccontact .= $septag;
				}

				$uccontact .=$ucelocation;
				// homepage on the User Card
				$uchomepage='';
				if ($conf['userHomepageUC']) {
					if ($rowusr['initial_homepage'] != '') {
						$uchomepage.=$rowusr['initial_homepage'];
						if ($rowusr['current_homepage'] != '') {
							if ($rowusr['initial_homepage'] != $rowusr['current_homepage']) {
								$uchomepage .= ' (' . $rowusr['current_homepage'] . ')';
							}

						}

					} else {
						$uchomepage.=$rowusr['current_homepage'];
					}

					if ($uchomepage != '') {
						$uchomepage = preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" title="'.$uchomepage .
								'" class="tx-tc-external-autolink">\1</a>', $uchomepage);
					}

				}

				if (($uccontact != '') && ($uchomepage != '')) {
					$uccontact .= $septag;
				}

				$uccontact .=$uchomepage;
				if ($uccontact != '') {

					$uccontact ='<div class="tx-tc-ct-uc-text-contact"><img class="tx-tc-ucpic" src="' . $mailurl . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/uccontact.png" height="14" width="14" title="' .
						         	$this->pi_getLLWrap($pObj, 'pi1_template.uc.contact', $fromAjax) . '" />' . $nbsp . $uccontact . '</div>';
				}

				$uccontact =$ucnametitle . $uccontact;

			}

		}

		if ($conf['userStatsUC']) {
			// homepage on the User Card
			$ucstats='';
			if (($rowusrsum['comment_count'] != '') && ($rowusrsum['comment_count'] != '0')) {
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.comments', $fromAjax) . ' ' . $rowusrsum['comment_count'];
			}

			if (($rowusrsum['vote_count'] != '') && ($rowusrsum['vote_count'] != '0')) {
				if ($ucstats != '') {
					$ucstats .= ', ';
				}

				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.rateditems', $fromAjax) . ' ' . $rowusrsum['vote_count'];
			}

			if (($rowusrsum['average_rating'] != '') && (round($rowusrsum['average_rating'], 2) != '0.00')) {
				if ($ucstats != '') {
					$ucstats .= $septag;
				}

				$ucstats .= $this->pi_getLLWrap($pObj, 'pi1_template.uc.averagerating', $fromAjax) . ' ' . round($rowusrsum['average_rating'], 2);
			}

			if (($rowusrsum['like_count'] != '') && ($rowusrsum['like_count'] != '0')) {
				if ($ucstats != '') {
					$ucstats .= ', ';
				}

				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.likes', $fromAjax) . ' ' . $rowusrsum['like_count'];
			}

			if (($rowusrsum['dislike_count'] != '') && ($rowusrsum['dislike_count'] != '0')) {
				if ($ucstats != '') {
					$ucstats .= ', ';
				}

				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.dislikes', $fromAjax) . ' ' . $rowusrsum['dislike_count'];
			}

			if ($rowusrsum['tstamp'] != '') {
				if ($ucstats != '') {
					$ucstats .= '<br />';
				}

				$ucstats.=trim($this->pi_getLLWrap($pObj, 'pi1_template.uc.joined', $fromAjax) . ' ' . $this->formatDate($rowusrsum['tstamp'], $pObj, $fromAjax, $conf));
			}

			if ($rowusrsum['tstamp_lastupdate'] != '') {
				if ($rowusrsum['tstamp_lastupdate'] != $rowusrsum['tstamp'] ) {
					if ($ucstats != '') {
						$ucstats .= $septag;
					}

					$ucstats.=trim($this->pi_getLLWrap($pObj, 'pi1_template.uc.lastactivity', $fromAjax) . ' ' .
					$this->formatDate($rowusrsum['tstamp_lastupdate'], $pObj, $fromAjax, $conf));
				}

			}

			if ($ucstats != '') {
				$ucstats ='<div class="tx-tc-ct-uc-text-stats"><img class="tx-tc-ucpic" src="' . $mailurl . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/ucstats.png" height="14" width="14" title="' .
						         	$this->pi_getLLWrap($pObj, 'pi1_template.uc.stats', $fromAjax) . '" />' . $nbsp . $ucstats . '</div>';
			}

		}

		if ($conf['userIPUC']) {
			// homepage on the User Card
			$ucip='';
			if ($rowusr['ipresolved'] != '') {
				$ucip.=$rowusr['ipresolved'];
				if  (($rowusr['ip'] != '') && ($rowusr['current_ip'] != '') && ($rowusr['ip'] != $rowusr['current_ip'])) {
					$ucip.= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.lastIP', $fromAjax) . ' ' . $rowusr['current_ip'];
				}

			} elseif ($rowusr['ip'] != '') {

				$ucip.=$rowusr['ip'];
				if  (($rowusr['current_ip'] != '') && ($rowusr['ip'] != $rowusr['current_ip'])) {
					$ucip.= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.lastIP', $fromAjax) . ' ' . $rowusr['current_ip'];
				}

			}

			if ($ucip != '') {
				$ucip ='<div class="tx-tc-ct-uc-text-ip"><img class="tx-tc-ucpic" src="' . $mailurl . t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/ucip.png" height="14" width="14" title="'  .
				$this->pi_getLLWrap($pObj, 'pi1_template.uc.IPinfo', $fromAjax) . '" />' . $nbsp . $ucip . '</div>';
			}

		}

		$statusmessage = '';
		if (((!$conf['userIPUC']) && (!$conf['userStatsUC']) && (!$conf['userContactUC'])) ||
		 ((!$conf['userHomepageUC']) && (!$conf['userLocationUC']) && (!$conf['userEmailUC']) && ($conf['userContactUC'])))  {
			$statusmessage = $this->pi_getLLWrap($pObj, 'pi1_template.uc.noucoptions', $fromAjax);
		}

		if ($imgstr != '') {
			$imgstr = str_replace($replstr, $newstr, $imgstr);

		}

		// gravatar
		if ((trim($basedimgstr) !='') && (($conf['advanced.']['gravatarEnable'] == 1) )) {
			$kemail = '';
			if ($rowusr['initial_email'] != '') {
				$kemail = $rowusr['initial_email'];
			} else {
				if ($rowusr['current_email'] != '') {
					$kemail = $rowusr['current_email'];
				}

			}

			$imgstr = $this->gravatarize($conf, $imgstr, $kemail);
		}
		// end gravatar
		$newstr = '';
		if ($conf['theme.']['selectedBoxmodelkoogled']==1) {
			$newstr = ' tx-tx-uc-div-pic-koogle';
		}
		$content =  '<div class="tx-tc-ct-uc-pic'.$newstr.'">' . $imgstr . '<div class="tx-tc-ct-uc-fullname-div"><span class="tx-tc-ct-uc-fullname">' . $ucfullname .
		'</span>' . $addnameinfo .'</div></div>';
		$content .=  '<div class="tx-tc-ct-uc-text">';

		if ($uccontact!='') {
			$content .= $uccontact;
		}

		if ($ucstats!='') {
			$content .= $ucstats;
		}

		if ($ucip!='') {
		 	$content .= $ucip;
		}

		if ($statusmessage!='') {
			$content .= $statusmessage;
		} else {
			if (($uccontact=='') && ($ucip=='') && ($ucstats=='')) {
				$content .= $this->pi_getLLWrap($pObj, 'pi1_template.uc.nodata', $fromAjax);
			}

		}

		$content .= '</div>';
		return $content;
	}

	/**
	 * Mail functions
	 *
	 *
	 */

	/**
	 * Creates a href attibute for given $mailAddress.
	 * The function uses spamProtectEmailAddresses and Jumpurl functionality for encoding the mailto statement.
	 * If spamProtectEmailAddresses is disabled, it'll just return a string like "mailto:user@example.tld".
	 *
	 * 						b) $linktxt: The string between starting and ending <a> tag.
	 *
	 * @param	string		Email address
	 * @param	string		Link text, default will be the email address.
	 * @param	string		Initial link parameters, only used if Jumpurl functionality is enabled. Example: ?id=5&type=0
	 * @return	string		Returns a numerical array with two elements: 1) $mailToUrl, string ready to be inserted into the href attribute of the <a> tag,
	 */
	protected function getMailTo($mailAddress, $linktxt = '', $initP = '?') {
		if (!strcmp($linktxt, '')) {
			$linktxt = $mailAddress;
		}

		$mailToUrl = 'mailto:' . $mailAddress;

		if (!$_SESSION['TSFE']['config']['jumpurl_enable'] || $_SESSION['TSFE']['config']['jumpurl_mailto_disable']) {
			if ($_SESSION['TSFE']['spamProtectEmailAddresses']) {
				if ($_SESSION['TSFE']['spamProtectEmailAddresses'] === 'ascii') {
					$mailToUrl = $this->encryptEmail($mailToUrl);
				} else {
					$mailToUrl = "javascript:linkTo_UnCryptMailto('" . $this->encryptEmail($mailToUrl) . "');";
				}

				if ($_SESSION['TSFE']['config']['spamProtectEmailAddresses_atSubst']) {
					$atLabel = trim($_SESSION['TSFE']['config']['spamProtectEmailAddresses_atSubst']);
				}

				$spamProtectedMailAddress = str_replace('@', ($atLabel ? $atLabel : '(at)'), $mailAddress);

				if ($_SESSION['TSFE']['config']['spamProtectEmailAddresses_lastDotSubst']) {
					$lastDotLabel = trim($_SESSION['TSFE']['config']['spamProtectEmailAddresses_lastDotSubst']);
					$lastDotLabel = $lastDotLabel ? $lastDotLabel : '(dot)';
					$spamProtectedMailAddress = preg_replace('/\.([^\.]+)$/', $lastDotLabel . '$1', $spamProtectedMailAddress);
				}

				$linktxt = str_ireplace($mailAddress, $spamProtectedMailAddress, $linktxt);
			}

		} else {
			$mailToUrl = $_SESSION['TSFE']['absRefPrefix'] . $_SESSION['TSFE']['mainScript'] .
			$initP . '&jumpurl=' . rawurlencode($mailToUrl) . $_SESSION['TSFE']['getMethodUrlIdToken'];
		}

		return array(
				$mailToUrl, $linktxt
		);
	}

	/**
	 * Encryption of email addresses for <A>-tags See the spam protection setup in TS 'config.'
	 *
	 * @param	string		Input string to en/decode: "mailto:blabla@bla.com"
	 * @param	boolean		If set, the process is reversed, effectively decoding, not encoding.
	 * @return	string		encoded/decoded version of $string
	 */
	protected function encryptEmail($string, $back=0) {
		$out = '';

		if ($_SESSION['TSFE']['spamProtectEmailAddresses'] === 'ascii') {
			$strlenstring=strlen($string);
			for ($a=0; $a<$strlenstring; $a++) {
				$out .= '&#'.ord(substr($string, $a, 1)).';';
			}

		} else {
			// like str_rot13() but with a variable offset and a wider character range
			$len = strlen($string);
			$offset = intval($_SESSION['TSFE']['spamProtectEmailAddresses'])*($back?-1:1);
			for ($i=0; $i<$len; $i++) {
				$charValue = ord($string{$i});
				if ($charValue >= 0x2B && $charValue <= 0x3A) { // 0-9 . , - + / :
					$out .= $this->encryptCharcode($charValue, 0x2B, 0x3A, $offset);
				} elseif ($charValue >= 0x40 && $charValue <= 0x5A) { // A-Z @
					$out .= $this->encryptCharcode($charValue, 0x40, 0x5A, $offset);
				} else if ($charValue >= 0x61 && $charValue <= 0x7A) { // a-z
					$out .= $this->encryptCharcode($charValue, 0x61, 0x7A, $offset);
				} else {
					$out .= $string{$i};
				}

			}

		}

		return $out;
	}

	/**
	 * Encryption (or decryption) of a single character.
	 * Within the given range the character is shifted with the supplied offset.
	 *
	 * @param	int		Ordinal of input character
	 * @param	int		Start of range
	 * @param	int		End of range
	 * @param	int		Offset
	 * @return	string		encoded/decoded version of character
	 */
	protected function encryptCharcode($n, $start, $end, $offset) {
		$n = $n + $offset;
		if ($offset > 0 && $n > $end) {
			$n = $start + ($n - $end - 1);
		} else if ($offset < 0 && $n < $start) {
			$n = $end - ($start - $n - 1);
		}

		$retstr = chr($n);
		return $retstr;
	}

	/**
	 * Extended mail function for HTML-Mails
	 *
	 * @param	string		$toEMail: ...
	 * @param	string		$subject: ...
	 * @param	string		$message: ...
	 * @param	string		$html: ...
	 * @param	string		$fromEMail: ...
	 * @param	string		$fromName: ...
	 * @param	string		$attachment: ...
	 * @param	[type]		$attachment: ...
	 * @return	void		...
	 */
	public function send_mail ($toEMail, $subject, $message, $html, $fromEMail, $fromName, $confcheckSMTPService = 0, $attachment='') {

		$docheck=TRUE;
		$mailsewrverarr=explode(':', $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server']);
		if (count($mailsewrverarr)==2) {
			$hostname=$mailsewrverarr[0];
			$port=$mailsewrverarr[1];
		} else if (count($mailsewrverarr) == 1) {
			$hostname=$mailsewrverarr[0];
			$port='25';
		} else {
			$docheck=FALSE;
		}

		$sendmailok=FALSE;
		if ($docheck) {
			if ($this->checkSMTPService($hostname, $port, $confcheckSMTPService)) {
				$sendmailok=TRUE;
			}

		} else {
			$sendmailok=TRUE;
		}

		if ($sendmailok) {

			$booswift=FALSE;
			if (version_compare(TYPO3_version, '6.0', '<')) {
				if (
						isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
						is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
						isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
						is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
						(array_search('t3lib_mail_SwiftMailerAdapter',
								$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) === FALSE) == FALSE
				) {
					$booswift=TRUE;
				}

			} elseif (version_compare(TYPO3_version, '7.0', '<')) {
				if (
						isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
						is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
						isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
						is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
						(array_search('TYPO3\CMS\Core\Mail\SwiftMailerAdapter',
								$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) === FALSE) == FALSE
				) {
					$booswift=TRUE;
				}

			} else {
				$booswift=TRUE;
			}

			if ($booswift) {
				if (!is_array($toEMail)) {
					$emailArray = t3lib_div::trimExplode(',', $toEMail);
					$toEMail = array();
					foreach ($emailArray as $email) {
						$toEMail[] = $email;
					}

				}

				/** @var $mail t3lib_mail_Message */
				$mailMessage = t3lib_div::makeInstance('t3lib_mail_Message');
				$mailMessage->setTo($toEMail)
				->setFrom(array($fromEMail => $fromName))
				->setSubject($subject)
				->setBody($html, 'text/html', $_SESSION['TSFE']['renderCharset'])
				->addPart($message, 'text/plain', $_SESSION['TSFE']['renderCharset']); // since v 7.1.0 we take this from session, before: $GLOBALS['TSFE']->renderCharset);

				if (isset($attachment)) {
					if (is_array($attachment)) {
						$attachmentArray = $attachment;
					} else {
						$attachmentArray = array($attachment);
					}

					foreach ($attachmentArray as $theAttachment) {
						if (file_exists($theAttachment)) {
							$mailMessage->attach(Swift_Attachment::fromPath($theAttachment));
						}

					}

				}

				if ($bcc != '') {
					$mailMessage->addBcc($bcc);
				}

				$mailMessage->send();
			} else {
				//old typo3 < 4.7
				include_once(PATH_t3lib.'class.t3lib_htmlmail.php');
				$fromName = $this->slashName($fromName);

				if (is_array($toEMail)) {
					list($email, $name) = each($toEMail);
					$toEMail = $this->slashName($name) . ' <' . $email . '>';
				}

				$Typo3_htmlmail = t3lib_div::makeInstance('t3lib_htmlmail');
				$Typo3_htmlmail->start();
				$Typo3_htmlmail->mailer = 'TYPO3 HTMLMail';
				$message = html_entity_decode($message);
				if ($Typo3_htmlmail->linebreak == chr(10))	{
					$message = str_replace(chr(13).chr(10), $Typo3_htmlmail->linebreak, $message);
				}

				$Typo3_htmlmail->subject = $subject;
				$Typo3_htmlmail->from_email = $fromEMail;
				$Typo3_htmlmail->returnPath = $fromEMail;
				$Typo3_htmlmail->from_name = $fromName;
				$Typo3_htmlmail->replyto_email = $Typo3_htmlmail->from_email;
				$Typo3_htmlmail->replyto_name = $Typo3_htmlmail->from_name;
				$Typo3_htmlmail->organisation = '';

				if ($attachment != '' && file_exists($attachment))	{
					$Typo3_htmlmail->addAttachment($attachment);
				}

				if ($html)  {
					$Typo3_htmlmail->theParts['html']['content'] = $html; // Fetches the content of the page
					$Typo3_htmlmail->theParts['html']['path'] = t3lib_div::getIndpEnv('TYPO3_REQUEST_HOST') . '/';
					$Typo3_htmlmail->extractMediaLinks();
					$Typo3_htmlmail->extractHyperLinks();
					$Typo3_htmlmail->fetchHTMLMedia();
					$Typo3_htmlmail->substMediaNamesInHTML(0);	// 0 = relative
					$Typo3_htmlmail->substHREFsInHTML();
					$Typo3_htmlmail->setHTML($Typo3_htmlmail->encodeMsg($Typo3_htmlmail->theParts['html']['content']));
					if ($message)	{
						$Typo3_htmlmail->addPlain($message);
					}

				} else {
					$Typo3_htmlmail->addPlain($message);
				}

				$Typo3_htmlmail->setHeaders();
				if ($attachment != '')	{
					if (isset($Typo3_htmlmail->theParts) && is_array($Typo3_htmlmail->theParts) && isset($Typo3_htmlmail->theParts['attach']) &&
							is_array($Typo3_htmlmail->theParts['attach'])) {
						foreach ($Typo3_htmlmail->theParts['attach'] as $k => $media)	{
							$Typo3_htmlmail->theParts['attach'][$k]['filename'] = basename($media['filename']);
						}

					}

				}

				$Typo3_htmlmail->setContent();
				$Typo3_htmlmail->setRecipient(explode(',', $toEMail));
				$Typo3_htmlmail->sendTheMail();

			}

		}

		// in other cases: just does not crash no more
		// could return 'Mailserver ' . $smtphost . ' is not active. email not sent';

	}

	/**
	 * formats from and to-emailadresses
	 *
	 * @param	string		$name: ...
	 * @param	string		$apostrophe: ...
	 * @return	string		$rc: Slashed e-mail adress
	 */
	protected function slashName ($name, $apostrophe='"') {
		$name = str_replace(',', ' ', $name);
		$rc = $apostrophe . addcslashes($name, '<>()@;:\\".[]' . chr('\n')) . $apostrophe;
		return $rc;
	}

	/**
	 * Notification functions
	 *
	 *
	 */

	/**
	 * handles commentator notifications when a new comment has been appoved
	 * called from eid and from processformsubmission (for comments without approval)
	 *
	 * @param	[type]		$uid: the comment id
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	boolean		$fromeID: if request has been made by eID-call
	 * @param	int		$pid: page id needed to fetch right session values
	 * @param	[type]		$fromAjax: ...
	 * @return	string		Nothing or Message to be displayed in eID-Page (if called by eID)
	 */
	public function handleCommentatorNotifications($uid, $conf, $pObj, $fromeID = FALSE, $pid=0, $fromAjax=1) {
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'firstname,lastname,email,uid,external_ref_uid,external_ref,parentuid',
					'tx_toctoc_comments_comments',
					'deleted = 0 AND hidden = 0 AND approved = 1 AND pid='. $conf['storagePid'].' AND uid='.$uid
					);
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		if ($fromeID) {
			$confnotificationLevel = intval($conf['notificationLevel']);
			$confnotificationValidDays = intval($conf['notificationValidDays']);
		} else {
			$confnotificationLevel = intval($conf['advanced.']['notificationLevel']);
			$confnotificationValidDays = intval($conf['advanced.']['notificationValidDays']);
		}

		$ressnd = array();
		$ri = 0;
		$msg = 'LOG start '. $uid;
		if (empty($row)) return 'row empty, storagePid: '. $conf['storagePid'] . ', uid: '.  $uid;
		//we don't need to send a notificationEmail because the new comment is not yet approved
		$msg .= ' - LOG ' . $conf['advanced.']['notificationLevel'];
		if ($confnotificationLevel == 0) {
			$ressnddata = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'DISTINCT firstname,lastname,email,toctoc_comments_user,crdate',
					'tx_toctoc_comments_comments',
					'tx_commentsnotify_notify = 1 AND deleted = 0 AND hidden = 0 AND approved = 1 AND pid='.$conf['storagePid'].' AND external_ref_uid ="'.
					$row['external_ref_uid'] . '" AND external_ref ="'. $row['external_ref'] . '" AND email <> "'. $row['email'] .'"',
					'',
					'email DESC',
					'' );
			while ($rowsnddata = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($ressnddata)) {
				$rowsnd[$ri]['toctoc_comments_user'] = $rowsnddata['toctoc_comments_user'];
				$rowsnd[$ri]['firstname'] = $rowsnddata['firstname'];
				$rowsnd[$ri]['lastname'] = $rowsnddata['lastname'];
				$rowsnd[$ri]['email'] = $rowsnddata['email'];
				$rowsnd[$ri]['crdate'] = $rowsnddata['crdate'];
				$ri++;
			}

		} else {

			$parentuid = intval($row['parentuid']);
			$newparentuid = $parentuid;
			$msg .= ' - parent: ' . $parentuid;
			$resreplys = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'firstname,lastname,email,toctoc_comments_user,tx_commentsnotify_notify,parentuid,uid,crdate',
				'tx_toctoc_comments_comments',
				'deleted = 0 AND hidden = 0 AND approved = 1 AND pid='.$conf['storagePid'].' AND external_ref_uid ="'.
				$row['external_ref_uid'] . '" AND external_ref ="'. $row['external_ref'] . '"',
				'',
				'email DESC',
				'' );
			if ($parentuid > 0) {
				do {
					while ($rowreplys = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resreplys)) {
						if (intval($rowreplys['uid']) == $parentuid) {
							if ((intval($rowreplys['tx_commentsnotify_notify']) == 1) && ($rowreplys['email'] != $row['email'])) {
								$rowsnd[$ri]['toctoc_comments_user'] = $rowreplys['toctoc_comments_user'];
								$rowsnd[$ri]['firstname'] = $rowreplys['firstname'];
								$rowsnd[$ri]['lastname'] = $rowreplys['lastname'];
								$rowsnd[$ri]['email'] = $rowreplys['email'];
								$rowsnd[$ri]['crdate'] = $rowreplys['crdate'];

								$ri++;
								$msg .= ' - message for: ' . $rowreplys['email'];
							}

							$newparentuid = intval($rowreplys['parentuid']);
							$msg .= ' - newparentuid: ' . $newparentuid;
						}

					}
					$resreplys = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
							'firstname,lastname,email,toctoc_comments_user,tx_commentsnotify_notify,parentuid,uid,crdate',
							'tx_toctoc_comments_comments',
							'deleted = 0 AND hidden = 0 AND approved = 1 AND pid='.$conf['storagePid'].' AND external_ref_uid ="'.
							$row['external_ref_uid'] . '" AND external_ref ="'. $row['external_ref'] . '"',
							'',
							'email DESC',
							'' );
					if ($newparentuid != $parentuid) {
						$parentuid=$newparentuid;
					} else {
						$msg .= ' - no parent found for ' . $parentuid;
						$parentuid=0;
					}

				} while ($parentuid != 0);
			}
		}

		if ($confnotificationLevel == 2) {
			$parentuid = $row['parentuid'];
			$resreplys = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'firstname,lastname,email,toctoc_comments_user,tx_commentsnotify_notify,parentuid,uid,crdate',
					'tx_toctoc_comments_comments',
					'deleted = 0 AND hidden = 0 AND approved = 1 AND pid='.$conf['storagePid'].' AND external_ref_uid ="'.
					$row['external_ref_uid'] . '" AND external_ref ="'. $row['external_ref'] . '" AND parentuid ='. $parentuid . ' AND email <> "'
					. $row['email'] .'"',
					'',
					'email DESC',
					'' );
			while ($rowreplys = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resreplys)) {
				if ($rowreplys['parentuid'] == $parentuid) {
					if (($rowreplys['tx_commentsnotify_notify'] == 1) && ($rowreplys['email'] != $row['email'])) {
						$rowsnd[$ri]['toctoc_comments_user'] = $rowreplys['toctoc_comments_user'];
						$rowsnd[$ri]['firstname'] = $rowreplys['firstname'];
						$rowsnd[$ri]['lastname'] = $rowreplys['lastname'];
						$rowsnd[$ri]['email'] = $rowreplys['email'];
						$rowsnd[$ri]['crdate'] = $rowreplys['crdate'];

						$ri++;
						$msg .= ' - message o.s.l. for: ' . $rowreplys['email'];
					}

				}

			}

		}

		if ($conf['HTMLEmail']) {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['advanced.']['notificationForCommentatorHTMLEmailTemplate']);

		} else {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['advanced.']['notificationForCommentatorEmailTemplate']);
		}

		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
		if ($fromAjax==1) {
			$templateCode = @file_get_contents(PATH_site . $usetemplateFile);
			$templatefilepath=PATH_site . $usetemplateFile;
		} else {
			$templateCode = $this->t3fileResource($pObj, $templatefilepath);
			$templatefilepath=$usetemplateFile;
		}

		/*
		 * Denotification link start
		*
		*/

		if (($fromAjax)) {
			$language = &$GLOBALS['LANG'];
			$lang = $GLOBALS['LANG']->lang;
		} else {
			$language = t3lib_div::makeInstance('language');
			$language->init($GLOBALS['TSFE']->lang);
			$lang = $GLOBALS['TSFE']->lang;
		}

		$check = md5($uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
		/*
		 * Denotification link end
		*
		*/

		if ($fromeID) {
			$pageTitle=$conf['pageTitle'];
			if (trim($conf['pageURLhotlink']) != '') {
				$linktocomment = $conf['pageURLhotlink'];
			} else {
				$linktocomment = $conf['pageURL'];
				$linktocomment .= 'toctoc_comments_pi1[anchor]=' . substr($conf['aP'], 1) . $uid .
				$conf['aP'] . $uid;
			}

		} else {

			if ($_SESSION['commentsPageTitles'][$pid] == '') {
				$pageTitle =$_SESSION['commentsPageIdsClean'][$pid];
			} else {
				$pageTitle =$_SESSION['commentsPageTitles'][$pid];
			}

			$linktocomment = $_SESSION['commentsPageIdsClean'][$pid];
			if (isset($_SESSION['commentsPageIdsTypolinks'][$pid][$uid])) {
				$linktocomment=$_SESSION['commentsPageIdsTypolinks'][$pid][$uid];
			} else {
				$linktocomment = $_SESSION['commentsPageIdsClean'][$pid]  . $conf['recentcomments.']['anchorPre'] . $uid;
			}
		}

     	$infoleft='';
		$crdateAdmitted = 0;
		if (intval($confnotificationValidDays) > 0) {
			$crdateAdmitted = time() - (intval($confnotificationValidDays) * 24 * 60 * 60);
		}

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];
		$fromeIDreturn='';
		$lastprocessedemail='';
		$cntnotifs = count($rowsnd);
		for ($si=0;$si<$cntnotifs;$si++) {
			if ($lastprocessedemail!=$rowsnd[$si]['email']) {
				if (intval($rowsnd[$si]['crdate']) > $crdateAdmitted) {
					$lastprocessedemail=$rowsnd[$si]['email'];
					$notifiyusername ='';
					/*
					 * Denotification link start
					*
					*/
					$denotify='';
					if ($conf['HTMLEmail']) {
						$confencarr =array(
								'advanced.' => array(
										'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
								),
								'pageTitle' => $pageTitle,
								'pageURL' => $linktocomment,
								'pageURLhotlink' => $linktocomment,
								'storagePid' => $conf['storagePid'],
								'aP' => $conf['recentcomments.']['anchorPre'],
								'toctoc_comments_user' => $rowsnd[$si]['toctoc_comments_user'],
								'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
								'HTMLEmail' => $conf['HTMLEmail'],
								'email' => $rowsnd[$si]['email'],
								'external_ref_uid' => $row['external_ref_uid'],
						);
					} else {
						$confencarr =array(
								'advanced.' => array(
										'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
								),
								'pageTitle' => $pageTitle,
								'pageURL' => $linktocomment,
								'pageURLhotlink' => $linktocomment,
								'storagePid' => $conf['storagePid'],
								'aP' => $conf['recentcomments.']['anchorPre'],
								'HTMLEmail' => $conf['HTMLEmail'],
								'toctoc_comments_user' => $rowsnd[$si]['toctoc_comments_user'],
								'email' => $rowsnd[$si]['email'],
								'external_ref_uid' => $row['external_ref_uid'],
						);
					}

					$confenc = rawurlencode(base64_encode(serialize($confencarr)));
					$record = array(
							'mailconf' => $confenc,
					);

					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_cache_mailconf', $record);
					$confenc = $GLOBALS['TYPO3_DB']->sql_insert_id();

					if ($conf['HTMLEmail']) {
						$denotify = '<a href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' .
									$lang . '&cmd=denotify&confenc=' . $confenc) . '">' .
									$this->pi_getLLWrap($pObj, 'email.textdenotifycomment', $fromAjax) . '</a>';
					} else {
						$denotify = $this->pi_getLLWrap($pObj, 'email.textdenotifycomment', $fromAjax) . ' ' .
									t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check .
									'&lng=' . $lang . '&cmd=denotify&confenc=' . $confenc);
					}

					/*
					 * Denotification link end
					*
					*/
					if ($rowsnd[$si]['lastname'] != '') {
						$salutation= $this->pi_getLLWrap($pObj, 'commentatorEmail.salutationformal', $fromAjax);
						$notifiyusername = $rowsnd[$si]['lastname'];
						if ($rowsnd[$si]['firstname'] != '') {
							$notifiyusername = $rowsnd[$si]['firstname'] . ' ' . $rowsnd[$si]['lastname'];
						}

					} else {
						$salutation= $this->pi_getLLWrap($pObj, 'commentatorEmail.salutation', $fromAjax);
						if ($rowsnd[$si]['firstname'] != '') {
							$notifiyusername = $rowsnd[$si]['firstname'];
						}

					}
					$myhomepagetypoLink_URL = str_replace('https:', 'http:', t3lib_div::locationHeaderUrl(''));

					$markerArray = array(
							'###USER###' => $notifiyusername,
							'###SALUTATION###' => $salutation,
							'###MESSAGE###' => $this->pi_getLLWrap($pObj, 'commentatorEmail.message', $fromAjax),
							'###PAGETITLE####' => $pageTitle,
							'###LINK_TO_COMMENT###' => $linktocomment,
							'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.commentatoremail', $fromAjax),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###DENOTIFYLINK###'  => $denotify,
					);
					$subject = str_replace('%s', $GLOBALS[GLOBALS][TYPO3_CONF_VARS][SYS][sitename].': '.
							$pageTitle, $this->pi_getLLWrap($pObj, 'commentatorEmail.subject', $fromAjax));
					if ($conf['advanced.']['notificationForCommentatorEmailName'] == '') {
						$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - ' . $this->pi_getLLWrap($pObj, 'email.commentingsystem', $fromAjax);
					} else {
						$sendername = str_replace('%site%', $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'], $conf['advanced.']['notificationForCommentatorEmailName']);
					}

					if (t3lib_div::validEmail($conf['advanced.']['notificationForCommentatorEmail'])) {
						if (t3lib_div::validEmail($rowsnd[$si]['email'])) {
							if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
								$content = $this->t3substituteMarkerArray($templateCode, $markerArray);
								self::send_mail($rowsnd[$si]['email'], $subject, '', $errortext. $content,
										$conf['advanced.']['notificationForCommentatorEmail'], $sendername, $conf['spamProtect.']['checkSMTPService']);
							} else {
								$template = $this->t3getSubpart($pObj, $templateCode, '###COMMENTS_RECIPENT_MAIL###');
								$mailContent = $this->t3substituteMarkerArray($template, $markerArray); // substitute markerArray for HTML content
								t3lib_div::plainMailEncoded($rowsnd[$si]['email'], $subject, $mailContent, 'From: ' .
								$conf['advanced.']['notificationForCommentatorEmail']);
							}

							$fromeIDreturn .=  '<br />'. $this->pi_getLLWrap($pObj, 'commentatorEmail.notificationsentto', $fromAjax) . ' : '. $rowsnd[$si]['email'];
						} else {
							$fromeIDreturn .=  '<br />'. $this->pi_getLLWrap($pObj, 'error.invalid.email', $fromAjax) . ' : '. $rowsnd[$si]['email'];
						}

					} else {
						$fromeIDreturn .=  '<br />'. $this->pi_getLLWrap($pObj, 'error.invalid.email', $fromAjax) .
						' (TS-Setup) advanced.notificationForCommentatorEmail: '. $conf['advanced.']['notificationForCommentatorEmail'];
					}

				}

			}

		}

		if ($fromeID) {
			return  $fromeIDreturn . '<br />';
		}

	}
	/**
	 * handles new user notifications when a new user has been appoved or refused
	 * called from eid
	 *
	 * @param	int		$uid: the user uid
	 * @param	array		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	boolean		$fromeID: if request has been made by eID-call
	 * @param	int		$pid: page id needed to fetch right session values
	 * @param	boolean		$fromAjax: ...
	 * @return	string		Message to be displayed in eID-Page
	 */
	public function handleNewUserNotification($uid, $conf, $pObj, $fromeID = FALSE, $pid=0, $fromAjax=1) {
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'first_name AS firstname,last_name AS lastname,email,uid,username,disable',
				'fe_users',
				'uid='.$uid
		);
		$pid = 0;
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);

		if ($conf['HTMLEmail']) {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['advanced.']['notificationForNewUserHTMLEmailTemplate']);

		} else {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['advanced.']['notificationForNewUserEmailTemplate']);
		}

		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);
		if ($fromAjax==1) {
			$templateCode = @file_get_contents(PATH_site . $usetemplateFile);
			$templatefilepath=PATH_site . $usetemplateFile;
		}

		$language = &$GLOBALS['LANG'];
		$lang = $GLOBALS['LANG']->lang;

		$check = md5($uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);

		$pageTitle=$conf['pageTitle'];

		if (trim($conf['pageURLhotlink']) != '') {
			$linktologin = $conf['pageURLhotlink'];
		} else {
			$linktologin = $conf['pageURL'];
		}

		$infoleft='';

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];
		$fromeIDreturn='';
		$lastprocessedemail=$row['email'];
		$notifiyusername ='';

		if ($row['lastname'] != '') {
			$salutation= $this->pi_getLLWrap($pObj, 'commentatorEmail.salutationformal', $fromAjax);
			$notifiyusername = $row['lastname'];
			if ($row['firstname'] != '') {
				$notifiyusername = $row['firstname'] . ' ' . $row['lastname'];
			}

		} else {
			$salutation= $this->pi_getLLWrap($pObj, 'commentatorEmail.salutation', $fromAjax);
			if ($row['firstname'] != '') {
				$notifiyusername = $row['firstname'];
			}

		}
		if ($row['disable'] == 0) {
			if (substr($row['username'], 0, 6) == 'google') {
				$piusername = $this->pi_getLLWrap($pObj, 'newUserEmail.usernameisGoogle', $fromAjax);
			} elseif (substr($row['username'], 0, 8) == 'facebook') {
				$piusername = $this->pi_getLLWrap($pObj, 'newUserEmail.usernameisFacebook', $fromAjax);
			} else {
				$piusername = $this->pi_getLLWrap($pObj, 'newUserEmail.usernameis', $fromAjax) . ': <b>' . $row['username'] . '</b>';
			}

			$mailmessage = $this->pi_getLLWrap($pObj, 'newuserEmail.messageok', $fromAjax) . '<br />' . piusername;
		} else {
			$mailmessage = $this->pi_getLLWrap($pObj, 'newuserEmail.messageko', $fromAjax);
			$linktologin = '';
		}

		$myhomepagetypoLink_URL = str_replace('https:', 'http:', t3lib_div::locationHeaderUrl(''));

		$markerArray = array(
				'###USER###' => $notifiyusername,
				'###SALUTATION###' => $salutation,
				'###MESSAGE###' => $mailmessage,
				'###PAGETITLE####' => $pageTitle,
				'###LINK_TO_COMMENT###' => $linktologin,
				'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.newuseremail', $fromAjax),
				'###INFOSLEFT###'  => $infoleft,
				'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
				'###MYHOMEPAGE###'  => $myhomepagelink,
				'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(FALSE). t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
				'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
				'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
				'###DENOTIFYLINK###'  => $denotify,
		);
		$subject = str_replace('%s', $GLOBALS[GLOBALS][TYPO3_CONF_VARS][SYS][sitename].': '.
				$pageTitle, $this->pi_getLLWrap($pObj, 'newUserEmail.subject', $fromAjax));
		if ($conf['advanced.']['notificationForNewUserEmailName'] == '') {
			$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - ' . $this->pi_getLLWrap($pObj, 'email.commentingsystem', $fromAjax);
		} else {
			$sendername = str_replace('%site%', $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'], $conf['advanced.']['notificationForNewUserEmailName']);
		}

		if (t3lib_div::validEmail($conf['advanced.']['notificationForNewUserEmail'])) {
			if (t3lib_div::validEmail($row['email'])) {
				if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
					$content = $this->t3substituteMarkerArray($templateCode, $markerArray);
					self::send_mail($row['email'], $subject, '', $errortext. $content,
							$conf['advanced.']['notificationForNewUserEmail'], $sendername, $conf['spamProtect.']['checkSMTPService']);
				} else {
					$template = $this->t3getSubpart($pObj, $templateCode, '###COMMENTS_RECIPENT_MAIL###');
					$mailContent = $this->t3substituteMarkerArray($template, $markerArray); // substitute markerArray for HTML content
					t3lib_div::plainMailEncoded($row['email'], $subject, $mailContent, 'From: ' .
							$conf['advanced.']['notificationForNewUserEmail']);
				}

				$fromeIDreturn .=  '<br />'. $this->pi_getLLWrap($pObj, 'commentatorEmail.notificationsentto', $fromAjax) . ' : '. $row['email'];
			} else {
				$fromeIDreturn .=  '<br />'. $this->pi_getLLWrap($pObj, 'error.invalid.email', $fromAjax) . ' : '. $row['email'];
			}

		} else {
			$fromeIDreturn .=  '<br />'. $this->pi_getLLWrap($pObj, 'error.invalid.email', $fromAjax) .
			' (TS-Setup) advanced.notificationForNewUserEmail: '. $conf['advanced.']['notificationForNewUserEmail'];
		}

		if ($fromeID) {
			return  $fromeIDreturn . '<br />';
		}

	}
	/**
	 * Website preview functions
	 *
	 *
	 */
	/**
	 * Handles Website previews
	 *
	 * @param	string		$cmd: Action to be performed: startpreview, getpreview or cleanuppreview
	 * @param	int		$cid: Content element of the plugin
	 * @param	object		$pObj: Reference to parent object
	 * @param	boolean		$fromAjax: is request from AJAX?
	 * @param	array/string		$data: url to examine
	 * @param	int		$websitepreviewid	Websitepreviewid with the preview, 0 if new or top website preview
	 * @param	array		$conf:
	 * @param	[type]		$originalfilename: ...
	 * @return	string		HTML to display
	 */
	public function cleanupfup($uploadedfile, $conf, $originalfilename) {
		$this->lastpreviewid=0;
		//clean up db and files
		$this->cleanupdbandfiles($conf, $uploadedfile, $originalfilename);
		return '';
	}

	/**
	 * Handles Website previews
	 *
	 * @param	string		$cmd: Action to be performed: startpreview, getpreview or cleanuppreview
	 * @param	int		$cid: Content element of the plugin
	 * @param	object		$pObj: Reference to parent object
	 * @param	boolean		$fromAjax: is request from AJAX?
	 * @param	array/string		$data: url to examine
	 * @param	int		$websitepreviewid	Websitepreviewid with the preview, 0 if new or top website preview
	 * @param	array		$conf:
	 * @return	string		HTML to display
	 */
	public function getwebpagepreview($cmd, $pObj, $cid, $data, $conf) {
		$outhtml='';
		if ($cmd=='startpreview') {
			if ($this->getwebpagecache('p'. $cid, $pObj, 'p'. $data['commentid'], $conf, $data['url'], TRUE)==0) {
				$_SESSION['p'. $cid]['p'. $data['commentid']]['url'] =$data['url'];
 				require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_webpagepreview.php'));
	 			$this->pvslib = new toctoc_comments_webpagepreview;
				$this->pvslib->main($data['url'], $data['commentid'], $cid, $data['lang'], $conf, $this, $pObj);
				$outhtml = '';
			} else {
				$outhtml = $this->lastpreviewid;
			}

		} elseif ($cmd=='getpreviewinit') {
			$outhtml = $this->getpreviewinit($cid, $data, $conf);

		} elseif ($cmd=='cleanuppreview') {
			//unlink files in temp
			$this->lastpreviewid=0;
			//clean up db and files
			$this->cleanupdbandfiles($conf);
			$this->getpreviewinit($cid, $data, $conf);

		} elseif ($cmd=='savepreview') {
			$outhtml = $this->savewebpagepreviewtodb('p'. $cid, $pObj, 'p'. $data['commentid'], $conf);

		} else {
			$outhtml = 'Wrong cmd';
		}

		return $outhtml;

	}

	/**
	 * Initialilizes the session vars for webpage previews
	 *
	 * @param	int		$cid: ...
	 * @param	array		$data:array with needed comment id
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$conf: ...
	 * @return	string		confirmation for the request
	 */
	protected function getpreviewinit($cid, $data, $conf) {
		$this->lastpreviewid=0;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['title']='';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['working'] = 1;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['url'] = '';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['urlfound'] = '';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['urltext'] = '';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['description'] = '';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['logo'] = '';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['images'] = array();
		$_SESSION['p'. $cid]['p'. $data['commentid']]['totalcounter'] = 0;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['exectime'] = 0;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['needgoogle'] = 0;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['urlanalyzing']='';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['logofile'] ='';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['videoprocessed']=FALSE;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['videotype']='';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['videosite']='';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['titleoutfound']='';
		unset($_SESSION['p'. $cid]['p'. $data['commentid']]['embedUrl']);

		$sessionFile = realpath(dirname(__FILE__)) . '/sessionpath.tmp';
		$sessionSavePath =  @file_get_contents($sessionFile);
		$sessionTimeout = 3*1440;
		if (intval($conf['sessionTimeout']) > 1) {
			$sessionTimeout = intval($conf['sessionTimeout']);
		}

		session_write_close();
		if (!(isset($this->commonObj))) {
			require_once ('class.toctoc_comments_common.php');
			$this->commonObj = new toctoc_comments_common;
		}
		$this->commonObj->start_toctoccomments_session($sessionTimeout, $sessionSavePath);
		$_SESSION['p'. $cid]['p'. $data['commentid']]['url'] =$data['url'];
		return  'getpreviewinit done, cid ' . $cid . ', commentid ' . $data['commentid'];
	}

	/**
	 * Saves a new webpage preview in the db and returns the new id
	 *
	 * @param	int		$pcid: content element id
	 * @param	int		$pcommentid: comment id
	 * @param	string		$userurl: url as entered by the user
	 * @param	array		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	int		$newUid, uid of the attachment in tx_toctoc_comments_attachment_mm
	 */
	protected function savewebpagepreviewtodb($pcid, $pObj, $pcommentid, $conf) {
		$debug='';
		$conf_cachetimetemppics = $conf['attachments.']['webpagePreviewCacheTimeTempImages'];
		$conf_cachetimetemppics =(time() - ($conf_cachetimetemppics *60));

		//copy pic in /uploads/tx_toctoccomments/webpagepreview
		//create record in attachments

		$newUid=0;
		$newUid = $this->getwebpagecache($pcid, $pObj, $pcommentid, $conf, '', FALSE);
		$debug.= 'newuid 1: ' . $newUid;
		$savelog='';
		if ($newUid==0) {

			$photo_main ='';
			$photos_etc ='';
			$microtimearr=explode('.', microtime(TRUE));
			$replacebyinfilename=strval($microtimearr[0]. '-' . substr(strval($microtimearr[1]), 0, 3) . '-');

			// copy logo from 		$_SESSION[$pcid][$pcommentid]]['logo']
			$isVidlinkSave = FALSE;
			if (array_key_exists('embedUrl', $_SESSION[$pcid][$pcommentid])) {
				if ($_SESSION[$pcid][$pcommentid]['embedUrl']!='') {
					// is vidlink save
					$isVidlinkSave = TRUE;

				}

			}

			if (!$isVidlinkSave) {
				$cntssesimg=count($_SESSION[$pcid][$pcommentid]['images']);
				for ($i=0; $i<$cntssesimg; $i++) {

					if (count($_SESSION[$pcid][$pcommentid]['images']) > 0) {
						$file = $_SESSION[$pcid][$pcommentid]['images'][$i]['localpathfilename'];
						//prepare for unlinking older files
						//only once
						if ($i==0) {
							$pathparts=explode('\\', $file);
							if (count($pathparts)>1) {
								$sepdir = '\\';
							} else {
								$pathparts=explode('/', $file);
								$sepdir = '/';
							}

							$filename=$pathparts[count($pathparts)-1];
							unset($pathparts[count($pathparts)-1]);
							$pathofdir=implode($sepdir, $pathparts);

							$filesarr= $this->read_dir($pathofdir);

							$partsessionid = strstr($filename, 'Gcidp', TRUE );

							$partcommentid = strstr($filename, 'Wcidp', FALSE );
							$poscommentid = strpos($partcommentid, 'Gpix')-5;

							$partcommentid = substr($partcommentid, 5, $poscommentid);

							$partcid = strstr($filename, 'Gcidp', FALSE );
							$poscid = strpos($partcid, 'Wcidp')-5;

							$partcid = substr($partcid, 5, $poscid);
							$replaceinfilename = $partsessionid . 'Gcidp' . $partcid . 'Wcidp' . $partcommentid . 'Gpix';

							//now we unlink all the files matching pattern $partsessionid . 'Gcid' . $partcid . 'Wcid' . $i_partcommentid . 'Gpix' . $killer_i .
							//'Wend'
							// and - optional - '_logo'
							// where $killer_i is the running index and $i_partcommentid < $partcommentid
							$countfilesarr=count($filesarr);
							for ($ifile = 0; $ifile < $countfilesarr; $ifile++) {
								$ipartsessionid = strstr($filesarr[$ifile], 'Gcidp', TRUE );
								$ipartcommentid = strstr($filesarr[$ifile], 'Wcidp', FALSE );
								$iposcommentid = strpos($ipartcommentid, 'Gpix')-5;
								$ipartcommentid = substr($ipartcommentid, 5, $iposcommentid);
								$ipartcid = strstr($filesarr[$ifile], 'Gcidp', FALSE );
								$iposcid = strpos($ipartcid, 'Wcidp')-5;
								$ipartcid = substr($ipartcid, 5, $iposcid);
								$unlinked=0;
								if ($ipartsessionid == $partsessionid) {
									if ($ipartcid == $partcid) {
										if ($ipartcommentid < $partcommentid) {
											// yes, then unlink it...
											unlink($pathofdir. $sepdir . $filesarr[$ifile]);
											$unlinked=1;
										}

									}

								}

								if ($unlinked==0) {
								//then check if file is older than cache time and if yes bye
									$filetime= filemtime($pathofdir. $sepdir . $filesarr[$ifile]);
									if (($conf_cachetimetemppics-$filetime)>0 ) {
										unlink($pathofdir. $sepdir . $filesarr[$ifile]);
										$unlinked=1;
									}

								}

							}

						}

						$copytofile=$_SESSION[$pcid][$pcommentid]['images'][$i]['localpathfilename'];
						$linktofile=$_SESSION[$pcid][$pcommentid]['images'][$i]['locallink'];
						$copytofile=str_replace($replaceinfilename, $replacebyinfilename, $copytofile);
						$copytofile=str_replace('Wendtemp', '', $copytofile);
						$linktofile=str_replace($replaceinfilename, $replacebyinfilename, $linktofile);
						$linktofile=str_replace('Wendtemp', '', $linktofile);

						$photos_etc .= str_replace('/', '', str_replace('uploads\\tx_toctoccomments\\temp\\', '',
								str_replace($this->webpagepreviewtempfolder, '', $linktofile))) . ',';
						$newfile = str_replace('\\temp\\', '\\webpagepreview\\', str_replace('/temp/', '/webpagepreview/', $copytofile));

						if (!copy($file, $newfile)) {
							$savelog .= 'failed imagescopy nr ' . $i . ' for ' . $file . ' to ' . $newfile . "\n";
							break;
						}

					}

				}

				// copy logo from pics from		$_SESSION[$pcid][$pcommentid]]['images'][$i]
				if ($_SESSION[$pcid][$pcommentid]['logo'] !='') {
					$copytofile=$_SESSION[$pcid][$pcommentid]['logofile'];
					$linktofile=$_SESSION[$pcid][$pcommentid]['logo'];
					$copytofile=str_replace($replaceinfilename, $replacebyinfilename, $copytofile);
					$copytofile=str_replace('Wendtemp', '', $copytofile);
					$linktofile=str_replace($replaceinfilename, $replacebyinfilename, $linktofile);
					$linktofile=str_replace('Wendtemp_logo', '', $linktofile);

					$photo_main = str_replace('uploads\\tx_toctoccomments\\temp\\', '', str_replace($this->webpagepreviewtempfolder, '', $linktofile));
					$photo_main = str_replace('/', '', $photo_main);
					$file = $_SESSION[$pcid][$pcommentid]['logofile'];
					$newfile = str_replace('\\temp\\', '\\webpagepreview\\', str_replace('/temp/', '/webpagepreview/', $copytofile));

					if (!copy($file, $newfile)) {
						$savelog .= 'failed logocopy nr '. $i .' for '.$file.' to ' . $newfile. "\n";
					}

				}

			}

					//return "photomain $photo_main  \n";
			if ($_SESSION[$pcid][$pcommentid]['urlfound'] != '') {
				//if it's '', then CURL had an error
				if (!$isVidlinkSave) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_attachment',
						array(
							'crdate' => time(),
							'tstamp' => time(),
							'pid' => intval($conf['storagePid']),
							'attachmentvariant' => 1,
							'systemurltext' => $_SESSION[$pcid][$pcommentid]['urlfound'],
							'photo_main' => $photo_main,
							'photos_etc' => $photos_etc,
							'title' => $_SESSION[$pcid][$pcommentid]['title'],
							'description' => $_SESSION[$pcid][$pcommentid]['description'],
							)
						);
				} else {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_attachment',
							array(
									'crdate' => time(),
									'tstamp' => time(),
									'pid' => intval($conf['storagePid']),
									'attachmentvariant' => 3,
									'systemurltext' => $_SESSION[$pcid][$pcommentid]['urlfound'],
									'photo_main' => $_SESSION[$pcid][$pcommentid]['logo'],
									'photos_etc' => $_SESSION[$pcid][$pcommentid]['embedUrl'] . '@@@' . $_SESSION[$pcid][$pcommentid]['videosite'],
									'title' => $_SESSION[$pcid][$pcommentid]['title'],
									'description' => $_SESSION[$pcid][$pcommentid]['description'],
							)
					);
					unset($_SESSION[$pcid][$pcommentid]['embedUrl'] );
					unset($_SESSION[$pcid][$pcommentid]['videosite'] );

				}

				//get the uid
				$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
			}

		}

		/// Set the attachments mm without reference yet to the comment (which actually does not yet exist, apart if cached)

		$cacheuid=0;
		$rowsattm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_attachment_mm.uid AS uid',
				'tx_toctoc_comments_attachment_mm',
				'tx_toctoc_comments_attachment_mm.userurltext="' . $_SESSION[$pcid][$pcommentid]['url'] . '" AND tx_toctoc_comments_attachment_mm.attachmentid=' .
				$newUid . ' AND tx_toctoc_comments_attachment_mm.deleted=0',
				'',
				'tx_toctoc_comments_attachment_mm.tstamp DESC',
				'');
		if (count($rowsattm) >0) {
			foreach($rowsattm as $key) {

					$cacheuid=$key['uid'];

			}

		}

		$debug .= ', cacheuid 1: ' . $cacheuid;
		if ($cacheuid==0) {
		//create attachment record and attachment mm record (just for the user url)
			$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_attachment_mm',
				array(
					'crdate' => time(),
					'tstamp' => time(),
					'pid' => intval($conf['storagePid']),
					'attachmentid' => $newUid,
					'userurltext' => $_SESSION[$pcid][$pcommentid]['url'],
					)
				);
			// the uid of the mm goes session for further use
			$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
		} else {
			$newUid =$cacheuid;
		}

		$debug .= ', cacheuid 2: ' . $newUid;
		return $newUid;
	}

	/**
	 * Cleans up Attachments DB - records older than cache time and unused by comments go shredder, as well as their associated images.
	 *
	 * @param	array		$conf: Plugin Config
	 * @param	string		$uploadedfile: ...
	 * @param	string		$originalfilename: ...
	 * @return	void
	 */
	protected function cleanupdbandfiles($conf, $uploadedfile='', $originalfilename='') {
		if ($uploadedfile=='') {
			$conf_cachetime = $conf['attachments.']['webpagePreviewCacheTimePage'];
			$conf_cachetime =(time() - ($conf_cachetime *60));

			// we need all rows in tx_toctoc_comments_attachment_mm which are older than the cachetime and which are not linked to a comment

			$rowsattm = $GLOBALS['TYPO3_DB']->exec_DELETEquery 	('tx_toctoc_comments_attachment_mm',
					'tx_toctoc_comments_attachment_mm.tstamp < ' . $conf_cachetime .
					' AND tx_toctoc_comments_attachment_mm.uid NOT IN (SELECT DISTINCT attachment_id FROM tx_toctoc_comments_comments)'
					);

			//exclude previews referenced in tt_content as part of the plugin
			$flexData=array();
			$rowscidflexstr ='';
			$rowsciduidstr ='';
			$rowstopwebpagepreviews = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,pi_flexform',
					'tt_content',
					'list_type = "toctoc_comments_pi1" AND pi_flexform LIKE "%useTopWebpagePreview%" ',
					'',
					'');
			while($rowtwp = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($rowstopwebpagepreviews)) {
				$rowsciduidstr.=$rowtwp['uid'] . ',';
				$flexData = t3lib_div::xml2array($rowtwp['pi_flexform']);
				if (is_array($flexData)) {
					$rowscidflex = t3lib_div::trimExplode(',', $flexData['data']['sAttachments']['lDEF']['useTopWebpagePreview']['vDEF']);
					if (($rowscidflexstr !='') && (count($rowscidflex)>0)) {
						$rowscidflexstr .= ',';
					}

					$rowscidflexstr .= implode(',', $rowscidflex);
				}

			}

			$wherettcontnt ='';
			if ($rowscidflexstr!='') {
				$wherettcontnt = ' AND tx_toctoc_comments_attachment.uid NOT IN (' . $rowscidflexstr . ')';
			}

			// now get the TRUE deletion "victims" ....
			$rowsattmmm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_attachment',
					'tx_toctoc_comments_attachment.tstamp < ' . $conf_cachetime . $wherettcontnt .
					' AND tx_toctoc_comments_attachment.uid NOT IN (SELECT DISTINCT attachmentid FROM tx_toctoc_comments_attachment_mm)',
					'',
					'');

			$dirsep=DIRECTORY_SEPARATOR;
			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
			$dirsep=str_replace($repstr, '', dirname(__FILE__));

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirroot= str_replace('/', '\\', $dirsep);
			} else {
				$txdirroot=$dirsep;
			}

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirname= str_replace('/', '\\', $txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder);
			} else {
				$txdirname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder;
			}

			if (count($rowsattmmm) >0) {
				$countrowsattmmm=count($rowsattmmm);
				for($i = 0; $i < $countrowsattmmm; $i++) {

					if ($rowsattmmm[$i]['photo_main']!='') {
						if (file_exists($txdirname . $rowsattmmm[$i]['photo_main'])) {
							unlink($txdirname . $rowsattmmm[$i]['photo_main']);
						}

					}

					$arrimages = explode(',', $rowsattmmm[$i]['photos_etc']);
					$countarrimages = count($arrimages)-1;
					for ($j = 0; $j < $countarrimages; $j++) {
						if (file_exists($txdirname . $arrimages[$j])) {
							unlink($txdirname . $arrimages[$j]);
						}
					}

				}

			}

			$rowsattm = $GLOBALS['TYPO3_DB']->exec_DELETEquery 	('tx_toctoc_comments_attachment',
					'tx_toctoc_comments_attachment.tstamp < ' . $conf_cachetime . $wherettcontnt .
					' AND tx_toctoc_comments_attachment.uid NOT IN (SELECT DISTINCT attachmentid FROM tx_toctoc_comments_attachment_mm)'
			);
		} else {
			//no db clean up needed- just kill the files in temp
			$dirsep=DIRECTORY_SEPARATOR;
			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
			$dirsep=str_replace($repstr, '', dirname(__FILE__));

			if (DIRECTORY_SEPARATOR == '\\') {
				// windoze
				$txdirroot= str_replace('/', '\\', $dirsep);
			} else {
				$txdirroot=$dirsep;
			}

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirtmpname= str_replace('/', '\\', $txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder);
			} else {
				$txdirtmpname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder;
			}

			$picturefilenamearr=explode('.', $uploadedfile);
			$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_big';
			$picturefilenamebig= implode('.', $picturefilenamearr);
			$picturefilenamearr=explode('.', $uploadedfile);
			$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_list';
			$picturefilenamelist= implode('.', $picturefilenamearr);

			// deletion of uploaded files
			if ($originalfilename !='') {
				if (file_exists($txdirtmpname . $originalfilename)) {
					unlink($txdirtmpname . $originalfilename);
				}

			}

			if (file_exists($txdirtmpname . $uploadedfile)) {
				unlink($txdirtmpname . $uploadedfile);
			}

			if (file_exists($txdirtmpname . $picturefilenamebig)) {
				unlink($txdirtmpname . $picturefilenamebig);
			}

			if (file_exists($txdirtmpname . $picturefilenamelist)) {
				unlink($txdirtmpname . $picturefilenamelist);
			}

		}

	}

	/**
	 * Checks the cached webpage preview in the db and if a hit is there, shows these infos ($_SESSION is filled from DB, not from page scanner)
	 *
	 * @param	int		$pcid: content element id
	 * @param	int		$pcommentid: comment id
	 * @param	string		$url: url to check for
	 * @param	boolean		$isbeforefetch: if it's before or after a fetch by the webpage scanner
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$pObj: ...
	 * @return	int		$cacheuid: ID of the cache attachment
	 */
	protected function getwebpagecache($pcid, $pObj, $pcommentid, $conf, $url='', $isbeforefetch = FALSE) {
		$conf_cachetime = $conf['attachments.']['webpagePreviewCacheTimePage']; //3 hours
		$conf_cachetime =(time() - ($conf_cachetime *60));
		$cacheuid=0;
		if ($isbeforefetch) {
		// check the att_mm for 'url', get the one with the highest ID
			$cacheattachmentid=0;
			$rowsattm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_attachment_mm.uid AS uid,
					tx_toctoc_comments_attachment_mm.attachmentid AS attachmentid',
					'tx_toctoc_comments_attachment_mm',
					'tx_toctoc_comments_attachment_mm.userurltext="' . $url . '" AND tx_toctoc_comments_attachment_mm.deleted=0',
					'',
					'tx_toctoc_comments_attachment_mm.uid DESC',
					'');
			if (count($rowsattm) >0) {
				$cacheattachmentid=$rowsattm[0]['attachmentid'];
				$this->lastpreviewid =$rowsattm[0]['uid'];

			}

			if ($cacheattachmentid!=0) {
				$_SESSION[$pcid][$pcommentid]['url'] = $url;
				$rowsattmmm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
						'tx_toctoc_comments_attachment',
						'tx_toctoc_comments_attachment.uid='. $cacheattachmentid .' AND tx_toctoc_comments_attachment.deleted=0',
						'',
						'');

				$keytstamp=0;
				if (count($rowsattmmm) >0) {
					if ($conf_cachetime > $rowsattmmm[0]['tstamp']) {
						$cacheuid=0;

					} else {

						$cacheuid=$rowsattmmm[0]['uid'];

						$_SESSION[$pcid][$pcommentid]['working'] = 3;
						$_SESSION[$pcid][$pcommentid]['title'] =$rowsattmmm[0]['title'];
						$_SESSION[$pcid][$pcommentid]['urlfound']=$rowsattmmm[0]['systemurltext'];
						$_SESSION[$pcid][$pcommentid]['description'] =$rowsattmmm[0]['description'];
						if ($rowsattmmm[0]['attachmentvariant'] < 3) {
							if ($rowsattmmm[0]['photo_main']!='') {
								$_SESSION[$pcid][$pcommentid]['logo'] =$this->locationHeaderUrlsubDir() .'uploads/tx_toctoccomments/webpagepreview/' .
								$rowsattmmm[0]['photo_main'];
							}

							$arrimages = explode(',', $rowsattmmm[0]['photos_etc']);
							$countarrimages2=count($arrimages)-1;
							for ($i = 0; $i < $countarrimages2; $i++) {
								$_SESSION[$pcid][$pcommentid]['images'][$i]['locallink']=$this->locationHeaderUrlsubDir() .
								'uploads/tx_toctoccomments/webpagepreview/' . $arrimages[$i];
							}

							$_SESSION[$pcid][$pcommentid]['totalcounter'] = count($_SESSION[$pcid][$pcommentid]['images']);
						} elseif ($rowsattmmm[0]['attachmentvariant']==3) {

							$photos_etc=$rowsattmmm[0]['photos_etc'];
							if (@$_SERVER['HTTPS'] == 'on') {
								if (str_replace('.mp4@@', '', $rowsattmmm[0]['photos_etc']) == $rowsattmmm[0]['photos_etc']) {
									$photos_etc=str_replace('http://', 'https://', $rowsattmmm[0]['photos_etc']);
								}

							}

							$rrpic=explode('@@@', $photos_etc);
							$embedurl='';
							$titlesitevid=$rowsattmmm[0]['title'];

							if (count($rrpic)>0) {
								$embedurl = $rrpic[0];
								if (count($rrpic) >1) {
									$titlesitevid .= ' (' . $rrpic[1] .')';
								}

							}

							$picstr='<img id="vidimg' . $cid . 'index1" src="' . $rowsattmmm[0]['photo_main'] . '" class="tx-tc-pvs-vid-img tx-tc-pvs-vid-img-size" />';
							$desriptionweb = $this->trimContent($rowsattmmm[0]['description'], $conf, $conf['attachments.']['webpagePreviewDescriptionLength']);
							$desriptionweb = nl2br($this->createLinks($desriptionweb, $conf));
							$desriptionweb = $this->replaceSmilies($desriptionweb, $conf);
							$desriptionweb = $this->replaceBBs($desriptionweb, $pObj, $conf, TRUE);
							$desriptionweb = $this->makeemoji($desriptionweb, $conf, 'getwebpagecache');

							$desriptionweb =$this->addleadingspace($desriptionweb);
							$_SESSION[$pcid][$pcommentid]['description'] =$desriptionweb;
							$_SESSION[$pcid][$pcommentid]['title'] =$titlesitevid;
							$_SESSION[$pcid][$pcommentid]['embedUrl'] = $embedurl;
							$_SESSION[$pcid][$pcommentid]['attachmentHTML'] = $attachmentHTML;

							$_SESSION[$pcid][$pcommentid]['logo'] = $rowsattmmm[0]['photo_main'];
							$_SESSION[$pcid][$pcommentid]['totalcounter'] = 0;
							if ($rowsattmmm[0]['photo_main'] !='') {
								$_SESSION[$pcid][$pcommentid]['totalcounter'] = 1;
							}

						}

						$_SESSION[$pcid][$pcommentid]['exectime'] = 0;
						$_SESSION[$pcid][$pcommentid]['needgoogle'] = 0;
						$_SESSION[$pcid][$pcommentid]['urlanalyzing']='';
						$_SESSION[$pcid][$pcommentid]['logofile'] ='';

						$fullurlarr = parse_url($rowsattmmm[0]['systemurltext']);
						$strpathout='';
						if (isset($fullurlarr['path'])) {
							if (strlen ($fullurlarr['path']) >30) {
								$strpathout=trim(substr($fullurlarr['path'], 0, 30)) . ' ...';

							} else {
								$strpathout=trim($fullurlarr['path']);
							}

						}

						$_SESSION[$pcid][$pcommentid]['urltext'] = trim($fullurlarr['host']) . $strpathout;
					}

				}

			}

			return $cacheuid;

		} else {

			$rowsattm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('MAX(tx_toctoc_comments_attachment.tstamp) AS tstamp',
					'tx_toctoc_comments_attachment',
					'tx_toctoc_comments_attachment.systemurltext="' . $_SESSION[$pcid][$pcommentid]['urlfound'] . '" AND tx_toctoc_comments_attachment.deleted=0',
					'',
					'',
					'');
			$keytstamp=0;
			if (count($rowsattm) >0) {
				if ($conf_cachetime <= $rowsattm[0]['tstamp']) {

					$keytstamp= $rowsattm[0]['tstamp'];
				}

			}

			if ($keytstamp!=0) {
				//get the id
				$rowsattmmm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_attachment.uid AS uid',
						'tx_toctoc_comments_attachment',
						'tx_toctoc_comments_attachment.systemurltext="' . $_SESSION[$pcid][$pcommentid]['urlfound'] . '" AND tx_toctoc_comments_attachment.tstamp='.
						$keytstamp .' AND tx_toctoc_comments_attachment.deleted=0',
						'',
						'');
				if (count($rowsattmmm) >0) {
						$cacheuid=$rowsattmmm[0]['uid'];
				}

			}

			return $cacheuid;
		}

	}

	/**
	 * Returns an array with filenames of a directory
	 *
	 * @param	string		$dir: .directory.
	 * @param	array		$array: exluded files (if any)
	 * @return	array		$files: filenames found in $dir
	 */
	protected function read_dir($dir, $array = array()) {
		$dh = opendir($dir);
		$files = array();
		while (($file = readdir($dh)) !== FALSE) {
			$flag = FALSE;
			if ($file !== '.' && $file !== '..' && !in_array($file, $array)) {
				$files[] = $file;
			}

		}

		closedir($dh);
		return $files;
	}

	/**
	 * Shows attachement Webpagepreview in comment display
	 *
	 * @param	int		$rowattachmentid: ...
	 * @param	int		$rowattachment_subid: ...
	 * @param	array		$conf: ...
	 * @param	object		$pObj: parent object
	 * @param	int		$cid: content element ID
	 * @param	boolean		$topwebsitepreview: If the preview is on top of the plugin
	 * @param	[type]		$row: ...
	 * @param	[type]		$row: ...
	 * @param	[type]		$isforemailnotification: ...
	 * @return	string		$attachmentHTML: HTML to be placed in template
	 */
	protected function commentShowWebpagepreview ($rowattachmentid, $rowattachment_subid, $conf, $pObj, $cid, $topwebsitepreview, $fromAjax,
			$row = array(), $isforemailnotification = FALSE) {
		if (count($row)>0) {
			$cid=$row['uid'];
			$ttfeuserid=$row['toctoc_comments_user'];
		}

		if (intval($conf['attachments.']['maxCharsPreviewTitle']) ==0) {
			if ($conf['attachments.']['maxCharsPreviewTitle']>250) {
				$conf['attachments.']['maxCharsPreviewTitle']=250;
			}

			if ($conf['attachments.']['maxCharsPreviewTitle']<10) {
				$conf['attachments.']['maxCharsPreviewTitle']=10;
			}

		}

		$maxChars=$conf['attachments.']['maxCharsPreviewTitle'];
		if (intval($conf['attachments.']['webpagePreviewDescriptionLength']) ==0) {
			$conf['attachments.']['webpagePreviewDescriptionLength'] = 150;
		}

		if ($conf['attachments.']['webpagePreviewDescriptionLength'] < 50) {
			$conf['attachments.']['webpagePreviewDescriptionLength'] = 50;
		}

		if ($conf['attachments.']['webpagePreviewDescriptionLength'] > 500) {
			$conf['attachments.']['webpagePreviewDescriptionLength'] = 500;
		}

		$maxDescChars=$conf['attachments.']['webpagePreviewDescriptionLength'];

		$plinkhomepage=$this->locationHeaderUrlsubDir();
		$palign='';
		if ($isforemailnotification) {
			$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
			$plinkhomepage=((@$_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://' ) . $myhomepagelinkarr[1] . $this->locationHeaderUrlsubDir(FALSE);
		}

		if ($topwebsitepreview) {
			$idplusstr='top-';
			$attwhere = ' tx_toctoc_comments_attachment.attachmentvariant= 1 AND tx_toctoc_comments_attachment.deleted=0 ' .
					' AND tx_toctoc_comments_attachment.uid =' . $rowattachmentid;
			$rowsatt = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'tx_toctoc_comments_attachment.systemurltext as systemurltext, tx_toctoc_comments_attachment.attachmentvariant as attachmentvariant,
											tx_toctoc_comments_attachment.attachmentfilesize as attachmentfilesize,
											tx_toctoc_comments_attachment.photo_main as photo_main, tx_toctoc_comments_attachment.photos_etc as photos_etc,
											tx_toctoc_comments_attachment.title as title, tx_toctoc_comments_attachment.description as description',
					'tx_toctoc_comments_attachment',
					$attwhere,
					'',
					'',
					'');

		} else {
			$idplusstr='';
			$attwhere = 'tx_toctoc_comments_attachment.uid = tx_toctoc_comments_attachment_mm.attachmentid AND ' .
					' tx_toctoc_comments_attachment.deleted=0 ' .
					' AND tx_toctoc_comments_attachment_mm.uid =' . $rowattachmentid;
			$rowsatt = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					'tx_toctoc_comments_attachment.systemurltext as systemurltext, tx_toctoc_comments_attachment.attachmentvariant as attachmentvariant,
											tx_toctoc_comments_attachment.attachmentfilesize as attachmentfilesize,
											tx_toctoc_comments_attachment.photo_main as photo_main, tx_toctoc_comments_attachment.photos_etc as photos_etc,
											tx_toctoc_comments_attachment.title as title, tx_toctoc_comments_attachment.description as description',
					'tx_toctoc_comments_attachment_mm, tx_toctoc_comments_attachment',
					$attwhere,
					'',
					'',
					'');
		}

		$logostr='';
		$link='javascript:void(0)';
		$picstr='';

		if (count($rowsatt)>0) {

			//Parse for Links and Smilies
			if (!$isforemailnotification) {
				$this->smiliesPath = str_replace('EXT:toctoc_comments/', $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
						$conf['smiliePath']);
				$this->smilies = $this->parseSmilieArray($conf['smilies.']);
				$desriptionweb = $this->trimContent($rowsatt[0]['description'], $conf, $conf['attachments.']['webpagePreviewDescriptionLength']);
				$desriptionwebtitle=$desriptionweb;
				$desriptionweb = nl2br($this->createLinks($desriptionweb, $conf));
				$desriptionweb = $this->replaceSmilies($desriptionweb, $conf);
				$desriptionweb = $this->replaceBBs($desriptionweb, $pObj, $conf, TRUE);
				$desriptionweb = $this->makeemoji($desriptionweb, $conf, 'commentShowWebpagepreview');

				$desriptionweb =$this->addleadingspace($desriptionweb);

			} else {
				$desriptionweb=$rowsatt[0]['description'];
				$desriptionwebtitle=$desriptionweb;
			}

			if ($rowsatt[0]['attachmentvariant'] < 3) {
				if ($rowsatt[0]['photo_main']!='') {
					$logostr .= '<div class="tx-tc-pvs-logobg-ct">';
					$logostr .= '<img src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rowsatt[0]['photo_main'] . '" ' . $palign .
					' class="tx-tc-wpplogo">';
					$logostr .= '</div>';
				}

				$textareamargin= 'tx-tc-pvs-tamgnone';
				if ((trim($rowsatt[0]['photos_etc']!='')) && ($rowattachment_subid!=999)) {
					$textareamargin='tx-tc-pvs-tamg';
					$rrpic=explode(',', $rowsatt[0]['photos_etc']);

					$rrpicpic=$rrpic[$rowattachment_subid];

					$rrpicpicweb = str_replace('_big.', '_list.', $rrpicpic);
					if (!$isforemailnotification) {
						if ($rowsatt[0]['attachmentvariant']==1) {
							$picstr .= '<div class="tx-tc-ct-pvs-images tx-tc-fleft">';
						} else {
							$picstr .= '<div class="tx-tc-ct-img-images">';
						}

						$picstr .= '<div>';
					}

					if ($rowsatt[0]['attachmentvariant']==1) {
						if ($isforemailnotification) {
							$palign=' align="left" hspace="4" ';
						}

						$picstr .= '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign . ' src="' .
						$plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpic . '" ';
						$picstr .= 'class="tx-tc-pvs-img tx-tc-blockdisp" />';
						$picsrcstr='';
						if (!$isforemailnotification) {
							$picstr .= '</div>';
							$picstr .= '</div>';
						}

					} else {
						$linktitle =$rowsatt[0]['systemurltext'];
						if (count($rrpic)>0) {
							//pic or pdf with pvpic
							if (!$isforemailnotification) {
								$picsrcstr= '<div class="tx-tc-images-img-browse-frame"><img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign .
								' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpic . '" ';
								$picsrcstr .= 'class="tx-tc-images-img-browse tx-tc-blockdisp" /></div>';
							} else {
								$picsrcstr = '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" class="tx-tc-blockdisp" ' . $palign .
								' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rowsatt[0]['photo_main'] . '" ';
								$picsrcstr .= ' />';
							}

						} else {
							//pdf no pvpic
							$picsrcstr= '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign .
							' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
							'/img/adobepdf.png" ';
							$picsrcstr .= 'class="tx-tc-images-img-browse tx-tc-blockdisp" />';
						}

						if (count($rrpic)>1) {
							//pic
							if (!$isforemailnotification) {
								$picstr = '<img rel="#txtcphoto' . $cid . '" title="' . htmlspecialchars($rowsatt[0]['title']) .
								'" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpicweb . '" ';
								$picstr .= 'class="tx-tc-images-img tx-tc-blockdisp" />';
							} else {
								$picstr = '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" class="tx-tc-blockdisp" ' . $palign .
								' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rowsatt[0]['photo_main'] . '" ';
								$picstr .= ' />';
							}

						} elseif (count($rrpic) == 1) {
							//pdf with previewpic
							if (!$isforemailnotification) {
								$picstr = '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign . ' src="' .
								$plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpicweb . '" ';
								$picstr .= 'class="tx-tc-images-img tx-tc-blockdisp" />';
							} else {
								$picstr = '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" class="tx-tc-blockdisp" ' . $palign . ' src="' .
								$plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpicweb . '" ';
								$picstr .= ' />';
							}

							$link='' . $plinkhomepage . $this->webpagepreviewsavefolder . $ttfeuserid . str_replace(' ', '_', $rowsatt[0]['systemurltext']);
						} else {
							//pdf
							$picstr = '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign . ' src="' .
							$plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
							'/img/adobepdf.png" ';
							$picstr .= 'class="tx-tc-images-img tx-tc-blockdisp" />';
							$link='' . $plinkhomepage . $this->webpagepreviewsavefolder . $ttfeuserid . str_replace(' ', '_', $rowsatt[0]['systemurltext']);
						}

						$sizeout=intval($rowsatt[0]['attachmentfilesize']/1024);
						if ($sizeout>1024) {
							$sizeout=round(($sizeout/1024), 2);
							$linktitle .= ' (' . $sizeout . ' MB)';
						} else {
							if ($sizeout !=0) {
								$linktitle .= ' (' . $sizeout . ' KB)';
							}

						}

					}

				} else {
					if ($rowsatt[0]['attachmentvariant']==2) {
						//pdf no pvpic
						$linktitle =$rowsatt[0]['systemurltext'];
						$picsrcstr= '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign .
						' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
						'/img/adobepdf.png" ';
						$picsrcstr .= 'class="tx-tc-images-img-browse tx-tc-blockdisp" />';
						$picstr = '<img title="' . htmlspecialchars($rowsatt[0]['title']) . '" ' . $palign .
						' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] .
						'/img/adobepdf.png" ';
						$picstr .= 'class="tx-tc-images-img tx-tc-blockdisp" />';
						$link=$plinkhomepage . $this->webpagepreviewsavefolder . $ttfeuserid . str_replace(' ', '_', $rowsatt[0]['systemurltext']);
						$sizeout=intval($rowsatt[0]['attachmentfilesize']/1024);
						if ($sizeout>1024) {
							$sizeout=round(($sizeout/1024), 2);
							$linktitle .= ' (' . $sizeout . ' MB)';
						} else {
							if ($sizeout !=0) {
								$linktitle .= ' (' . $sizeout . ' KB)';
							}

						}

					}

				}

			}

			if ($rowsatt[0]['attachmentvariant']==2) {
				if ($desriptionweb=='') {
					$desriptionweb=$rowsatt[0]['title'];
				}

			}

			$fullurlarr = parse_url($rowsatt[0]['systemurltext']);
			$strpathout='';
			if (isset($fullurlarr['path'])) {
				if (strlen ($fullurlarr['path']) >30) {
					$strpathout=trim(substr($fullurlarr['path'], 0, 30)) . ' ...';
				} else {
					$strpathout=trim($fullurlarr['path']);
				}

			}

			$strUrlText = trim($fullurlarr['host']) . $strpathout;

			if (!$isforemailnotification) {
				if ($rowsatt[0]['attachmentvariant'] == 1) {
					$minheightbox = '';
					if ($picstr != '') {
						$minheightbox=' tx-tc-pvs-mnhgbox';

					}

					$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTWPP###');
					$attachmentHTML =  $this->t3substituteMarkerArray($templateattachmentHTML, array(
						'###BOXMINHEIGHT###' => $minheightbox,
						'###URL###' => $rowsatt[0]['systemurltext'],
						'###TITLE###' => $this->trimContent($rowsatt[0]['title'], $conf, $conf['attachments.']['maxCharsPreviewTitle']),
						'###IMAGE###' => $picstr,
						'###URLTEXT###' => $strUrlText,
						'###DESC###' => $rowsatt[0]['description'],
						'###DESCTITLE###' => $rowsatt[0]['description'],
						'###LOGOBG###' => $logostr,
						'###TEXTAREAMARGIN###' => $textareamargin,
						'###CID###' => $cid,
						'###IDPLUS###' => $idplusstr,
				));
				} elseif ($rowsatt[0]['attachmentvariant']==2) {
					$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTPIC###');
					$attachmentHTML =  $this->t3substituteMarkerArray($templateattachmentHTML, array(
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###IMAGESRC###' => $picsrcstr,
							'###DESC###' => $desriptionweb,
							'###DESCTITLE###' => $desriptionwebtitle,
							'###CID###' => $cid,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $link,
							'###LINKTITLE###' => $linktitle,
					));
				} elseif ($rowsatt[0]['attachmentvariant']==3) {
					$photos_etc=$rowsatt[0]['photos_etc'];
					if (@$_SERVER['HTTPS'] == 'on') {
						if (str_replace('.mp4@@', '', $rowsatt[0]['photos_etc']) == $rowsatt[0]['photos_etc']) {
							$photos_etc=str_replace('http://', 'https://', $rowsatt[0]['photos_etc']);
						}

					}

					$rrpic=explode('@@@', $photos_etc);
					$embedurl='';
					$titlesitevid=$rowsatt[0]['title'];

					if (count($rrpic)>0) {
						$embedurl = $rrpic[0];

						if (str_replace('youtube', '', $embedurl) != $embedurl) {
							if (str_replace('/embed/', '', $embedurl) == $embedurl) {
								$embedurlparamarr=explode('?', $embedurl);
								$embedurl=$embedurlparamarr[0];
								$embedurlparamarr=explode('//', $embedurl);
								$embedurlonly=$embedurlparamarr[1];
								$embedurlonlyarr=explode('/', $embedurlonly);
								$embedurl = $embedurlparamarr[0] . '//' . $embedurlonlyarr[0] . '/embed/' . $embedurlonlyarr[count($embedurlonlyarr)-1] .
								'?rel=0&showinfo=0';
							}

						}

						if (count($rrpic) >1) {
							$rrpicwrk = str_replace('http://', '', $rrpic[1]);
							$rrpicwrk = str_replace('https://', '', $rrpicwrk);
							if ($rrpicwrk!=$rrpic[1]) {
								$rrpicwrkarr=explode('/', $rrpicwrk);
								$rrpicwrk=$rrpicwrkarr[0];
								$rrpicwrk=str_replace('www.', '', $rrpicwrk);

							}

							$titlesitevid .= ' (' . $rrpicwrk .')';
						}

					}

					$picstr='<img id="vidimg' . $cid . 'index1" src="' .
							$rowsatt[0]['photo_main'] . '" class="tx-tc-pvs-vid-img tx-tc-blockdisp tx-tc-pvs-vid-img-size" />';

					$picstroverlay='<img class="tx-tc-pvs-vid-img_olay tx-tc-blockdisp tx-tc-mrg-ovl-50002040" title="' .
					$this->pi_getLLWrap($pObj, 'pi1_template.playvideo', $fromAjax) .
					'" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
					$conf['theme.']['selectedTheme'] . '/img/play_vid.png" />';

					$videoembedhtml='';
					$photos_etc=$rowsatt[0]['photos_etc'];
					if (@$_SERVER['HTTPS'] == 'on') {
						if (str_replace('.mp4@@', '', $rowsatt[0]['photos_etc']) == $rowsatt[0]['photos_etc']) {
							$photos_etc=str_replace('http://', 'https://', $rowsatt[0]['photos_etc']);
						}

					}

					$sourcearr=explode('@@@', $photos_etc);

					if (count($sourcearr) >=3) {
						$picstroverlay='<img class="tx-tc-pvs-vid-img_olay tx-tc-mrg-pct-40002040 tx-tc-blockdisp" title="' .
						$this->pi_getLLWrap($pObj, 'pi1_template.playvideo', $fromAjax) .
						'" src="' . $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' .
						$conf['theme.']['selectedTheme'] . '/img/play_vid.png" />';

						$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTVIDHTML5###');
						$videohtml = '';
						$vidstyleimg=' width="" class="tx-tc-blockdisp tx-tc-mrg-2-0-0 tx-tc-pvsmxhgt" id="vidimg' . $cid . 'index1"';
						$videohtml .= '<video' . $vidstyleimg . '>';
						$html5flag ='Y';
						$countsourcearr = count($sourcearr);
						for ($v=0; $v < $countsourcearr; $v++) {
							if ($v==0) {
								$videotype='video/ogg';
							} elseif ($v==1) {
								$videotype='video/mp4';
							} else	{
								$videotype='video/webm';
							}

							if (strlen($sourcearr[$v])>4) {
								$videohtml .= '<source src="' . $sourcearr[$v] . '" type="' . $videotype . '">';
							}

						}

						$videohtml .= '</video>';
						$picstr=$videohtml;
						$videohtml =str_replace(' id="vidimg' . $cid . 'index1"', ' id="vidimg' . $idplusstr . 'p' . $cid . 'index2"', $videohtml);
						$videohtml =str_replace('width=""', '', $videohtml);

					} else {
						if (str_replace('@@@Soundcloud', '', $photos_etc) != $photos_etc) {
							$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTSOUNDCLOUD###');
						} else {
							$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTVIDFLASH###');
						}
						$html5flag ='';
					}

					$videoembedhtml=  $this->t3substituteMarkerArray($templateattachmentHTML, array(
							'###VIDEOHTML###' => $videohtml,
							'###TITLE###' => $titlesitevid,
							'###IMAGE###' => $picstr,
							'###IMAGESRC###' => $picsrcstr,
							'###DESC###' => $desriptionweb,
							'###DESCTITLE###' => $desriptionwebtitle,
							'###CID###' => $cid,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $rowsatt[0]['systemurltext'],
							'###LINKTITLE###' => htmlspecialchars($rowsatt[0]['title']),
							'###EMBEDURL###' => $embedurl,
							'###VIDEOURL###' => $rowsatt[0]['systemurltext'],
							'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###IMAGEOVERLAY###' => $picstroverlay,

					));

					$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTVID###');
					$attachmentHTML =  $this->t3substituteMarkerArray($templateattachmentHTML, array(
							'###TITLE###' => $titlesitevid,
							'###IMAGE###' => $picstr,
							'###IMAGESRC###' => $picsrcstr,
							'###DESC###' => $desriptionweb,
							'###DESCTITLE###' => $desriptionwebtitle,
							'###CID###' => $cid,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $rowsatt[0]['systemurltext'],
							'###LINKTITLE###' => htmlspecialchars($rowsatt[0]['title']),
							'###EMBEDURL###' => $embedurl,
							'###VIDEOURL###' => $rowsatt[0]['systemurltext'],
							'###SITE_REL_PATH###' =>  $this->locationHeaderUrlsubDir() . t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###IMAGEOVERLAY###' => $picstroverlay,
							'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
							'###SUBVIDEOEMBED###' => $videoembedhtml,
							'###HTML5FLAG###' => $html5flag,
					));
				}

			} else {
				if ($rowsatt[0]['attachmentvariant']==1) {
					$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTWPPMAIL###');
					$attachmentHTML =  $this->t3substituteMarkerArray($templateattachmentHTML, array(
							'###URL###' => $rowsatt[0]['systemurltext'],
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###URLTEXT###' => $strUrlText,
							'###DESC###' => $rowsatt[0]['description'],
							'###DESCTITLE###' => $desriptionwebtitle,
							'###TXTATTACHMENT###' => $this->pi_getLLWrap($pObj, 'email.attachment_webpagepreview', $fromAjax),
					));
				} elseif ($rowsatt[0]['attachmentvariant']==2) {
					$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTPICMAIL###');
					$attachmentHTML =  $this->t3substituteMarkerArray($templateattachmentHTML, array(
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###DESC###' => $desriptionweb,
							'###DESCTITLE###' => $desriptionwebtitle,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $link,
							'###LINKTITLE###' => $linktitle,
							'###TXTATTACHMENT###' => $this->pi_getLLWrap($pObj, 'email.attachment_pdforpicture', $fromAjax),
					));
				} elseif ($rowsatt[0]['attachmentvariant']==3) {

					if (count(explode('@@@', $rowsatt[0]['photo_main'])) > 1 ) {
						$picstr='<span>(' .$this->pi_getLLWrap($pObj, 'email.attachment_nohtml5picture', $fromAjax) . ')</span>';
					} else {
						$picstr='<img id="vidimg' . $cid .
						'index1" src="' . $rowsatt[0]['photo_main'] . '" class="tx-tc-pvs-vid-img tx-tc-blockdisp tx-tc-pvsmxhgt tx-tc-pvs-vid-img-size" />';

					}

					$templateattachmentHTML = $this->t3getSubpart($pObj, $pObj->templateCode, '###SUBFORMATTACHMENTVIDMAIL###');
					$attachmentHTML =  $this->t3substituteMarkerArray($templateattachmentHTML, array(
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###DESC###' => $desriptionweb,
							'###DESCTITLE###' => $desriptionwebtitle,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $link,
							'###LINKTITLE###' => $linktitle,
							'###TXTATTACHMENT###' => $this->pi_getLLWrap($pObj, 'email.attachment_video', $fromAjax),
					));
				}

			}

		} else {
			$attachmentHTML='no data found for rowattachmentid: ' . $rowattachmentid;
		}

		return $attachmentHTML;

	}

	/**
	 * Inserts an uploaded pic for an new comment
	 *
	 * @param	string		$picturefilename: filename
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	[type]		$descriptionbyuser: ...
	 * @param	[type]		$originalfilename: ...
	 * @param	[type]		$firstname: ...
	 * @param	[type]		$lastname: ...
	 * @param	[type]		$fetoctocusertoinsert: ...
	 * @return	integer		new tx_toctoccomments_attachement_mm uid for insert in tx_toctoccomments_comments
	 */
	protected function makeAttachementPicture($picturefilename, $conf, $descriptionbyuser, $originalfilename, $firstname,
			$lastname, $fetoctocusertoinsert) {

		//check if pic is in temp and them move the 2 pics in attachments
		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
		$dirsep=str_replace($repstr, '', dirname(__FILE__));
		$filesize=0;
		$picturefilenamesav=$picturefilename;
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirroot= str_replace('/', '\\', $dirsep);
		} else {
			$txdirroot=$dirsep;
		}

		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirname= str_replace('/', '\\', $txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder);
		} else {
			$txdirname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder;
		}

		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirtmpname= str_replace('/', '\\', $txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder);
		} else {
			$txdirtmpname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder;
		}

		$photos_etc='';
		$originalfilenamearr=explode('.', $originalfilename);
		$pdfsave=FALSE;
		if ($originalfilenamearr[count($originalfilenamearr)-1]=='pdf') {
			$pdfsave=TRUE;
			$copyfromfile=$txdirtmpname . $originalfilename;
			$outfile=str_replace(' ', '_', $originalfilename);
			$outfile=$fetoctocusertoinsert . $outfile;

			$copytofile=$txdirname . $outfile;
			if (!copy($copyfromfile, $copytofile)) {
				return 'failed imagescopy for '. $copyfromfile .' to ' . $copytofile. "\n";

			} else {
				$filesize=filesize($copyfromfile);
				unlink($copyfromfile);
			}

		}

		if (file_exists($txdirtmpname . $picturefilename)) {
			$copyfromfile=$txdirtmpname . $picturefilename;
			$copytofile=$txdirname . $picturefilename;

			if (!$pdfsave) {
				if (!copy($copyfromfile, $copytofile)) {
					return 'failed imagescopy for '. $copyfromfile .' to ' . $copytofile. "\n";
				}

				$picturefilenamearr=explode('.', $picturefilename);
						$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_big';
						$picturefilenamebig= implode('.', $picturefilenamearr);
						$copyfromfile=$txdirtmpname . $picturefilenamebig;
						$copytofile=$txdirname . $picturefilenamebig;
						if (!copy($copyfromfile, $copytofile)) {
						return 'failed imagescopy for '. $copyfromfile .' to ' . $copytofile. "\n";

				} else {
					$photos_etc = $picturefilenamebig;
				}

				$filesize=filesize($txdirtmpname . $picturefilenamebig);
				unlink($txdirtmpname . $picturefilenamebig);
			}

			$picturefilenamearr=explode('.', $picturefilename);
			$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_list';
			$picturefilenamelist= implode('.', $picturefilenamearr);
			$copyfromfile=$txdirtmpname . $picturefilenamelist;
			$copytofile=$txdirname . $picturefilenamelist;
			$picturefilenamelistpdf=$picturefilenamelist;
			if (!copy($copyfromfile, $copytofile)) {
				return 'failed imagescopy for '. $copyfromfile .' to ' . $copytofile. "\n";
			}

			unlink($txdirtmpname . $picturefilename);
			unlink($txdirtmpname . $picturefilenamelist);

			if (!$pdfsave) {
				$photos_etc .= ', ' . $picturefilenamelist;
			} else {
				$photos_etc = $picturefilenamelistpdf;
			}

		}

		if ($pdfsave) {
				$picturefilenamesav=$outfile;
		}

		$systemurltext_filename=$originalfilename; // zB bikers.png
		if ($descriptionbyuser=='') {
			$title_filenamebyuser=trim($firstname . ' ' . $lastname) . ': ' . $originalfilename;
		} else {
			$title_filenamebyuser=$this->trimContent(trim($firstname . ' ' . $lastname) . ': ' . $descriptionbyuser, $conf, 30);
		}

		$description_descriptionbyuser=$descriptionbyuser; //filename optionally overwritten by user
		//create record in attachments
		$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_attachment',
			array(
				'crdate' => time(),
				'tstamp' => time(),
				'pid' => intval($conf['storagePid']),
				'attachmentvariant' => 2,
				'attachmentfilesize' => $filesize,
				'systemurltext' => $systemurltext_filename,
				'photo_main' => $picturefilenamesav,
				'photos_etc' => $photos_etc,
				'title' => $title_filenamebyuser,
				'description' => $description_descriptionbyuser,
				)
		);
	//get the uid
		$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();

	//check for create record in attachments_mm
		$cacheuid=0;
		$rowsattm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_attachment_mm.uid AS uid',
			'tx_toctoc_comments_attachment_mm',
			'tx_toctoc_comments_attachment_mm.attachmentid=' . $newUid . ' AND tx_toctoc_comments_attachment_mm.deleted=0',
			'',
			'tx_toctoc_comments_attachment_mm.tstamp DESC',
			''
		);
		if (count($rowsattm) >0) {
			foreach($rowsattm as $key) {
				$cacheuid=$key['uid'];
		}

	}

	//create record in attachments_mm
	if ($cacheuid==0) {
	//create attachment record and attachment mm record (just for the user url)
		$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_attachment_mm',
			array(
				'crdate' => time(),
				'tstamp' => time(),
				'pid' => intval($conf['storagePid']),
				'attachmentid' => $newUid,
				'userurltext' => $title_filenamebyuser,
			)
		);
				// the uid of the mm goes session for further use
		$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
	} else {
		$newUid =$cacheuid;
	}

	return $newUid;
	// return the attachement_mm uid
	}

	/**
	 * eID-Interface functions
	 *
	 *
	 */

	/**
	 * Handles request from the eID-Interfaces, grabs the template and generated the HTML-Page
	 *
	 * @param	int		$uid: commentid
	 * @param	array		$conf: ...
	 * @param	object		$pObj: parent object
	 * @param	string		$messagetodisplay: the message from eID to display on the page
	 * @param	string		$refreshurl: Refreh-URL for the http-equiv=refresh redirects
	 * @return	string		$content: Content to be display by eID
	 */
	public function handleeID($uid, $conf, $pObj, $messagetodisplay, $refreshurl) {
		$content='';
		$fromAjax= TRUE;
		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $conf['advanced.']['eIDHTMLTemplate']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments', $usetemplateFile);

		$templateCode = @file_get_contents(PATH_site . $usetemplateFile);

		$pageTitle=$conf['pageTitle'];
		$linktocomment = $conf['pageURL'];
		$linktocommenthotlink = $conf['pageURLhotlink'];

		$infoleft='';

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];
		$refresh='';
		$waittext='';

		if ($refreshurl !='') {
			if (substr($refreshurl, 0, 9) =='tocomment') {
				// dbaction
				$optinemail=$conf['optinemail'];
				$optin_ip=$conf['optin_ip'];
				$commentrowconfirmed= $this->emailOptIn($conf, $optinemail, $optin_ip);
				if (is_array($commentrowconfirmed)) {
					//all went ok.
					if (count($commentrowconfirmed)>0) {
						if (strpos($linktocomment, '?') > 0) {
							$linktocomment .= '&';
						} else {
							$linktocomment .= '?';
						}

						$linktocomment .= 'toctoc_comments_pi1[anchor]=' . substr($conf['aP'], 1).$commentrowconfirmed['uid'] . $conf['aP'].
						$commentrowconfirmed['uid'];
						$messagetodisplay .=$this->handleCommentatorNotifications($uid, $conf, $pObj, TRUE, $conf['storagePid'], 1);

					}
					if ($linktocommenthotlink !='') {
						$linktocomment = $linktocommenthotlink;
					}

				}

				if ($refreshurl =='tocomment') {
					$refresh='<meta http-equiv="refresh" content="0;URL=' . $linktocomment . '">';
				} else {
					$refreshurl=substr($refreshurl, 9);
					$refresh='';
				}

			} elseif (str_replace('notificationsadmconfirm', '', $refreshurl) != $refreshurl) {
				// dbaction
				$messagetodisplay .=$this->handleNewUserNotification($uid, $conf, $pObj, TRUE, $conf['storagePid'], 1);
				$refresh='<meta http-equiv="refresh" content="0;URL=' . $refreshurl . '&rteecho=' . base64_encode($messagetodisplay) .'">';

			} else {
				$refresh='<meta http-equiv="refresh" content="0;URL=' . $refreshurl . '">';
			}

			if ($refresh!='') {
				$waittext=$this->pi_getLLWrap($pObj, 'eid_template.pleasewaitprocessing', $fromAjax);
				$waittext.='<img class="tx-tc-waittxt" align="left" src="' . $this->locationHeaderUrlsubDir() .
				t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/workingslides.gif" width="16" ';
				$waittext.='height="11" title="' . $this->pi_getLLWrap($pObj, 'eid_template.titleprocessing', $fromAjax) . '" />';
			} else {
				$waittext='<br /><br />' . $this->pi_getLLWrap($pObj, 'eid_template.processingdone', $fromAjax);
			}

		} else {
			$waittext='<br /><br />' . $this->pi_getLLWrap($pObj, 'eid_template.processingdone', $fromAjax);
		}
		$myhomepagetypoLink_URL = str_replace('https:', 'http:', t3lib_div::locationHeaderUrl(''));
		$markerArray = array(
				'###MESSAGE###' => $this->pi_getLLWrap($pObj, 'commentatorEmail.message', $fromAjax),
				'###WAITTEXT###' => $waittext,
				'###LINK_TO_COMMENT###' => $linktocomment,
				'###REFRESHURL###' => $refresh,
				'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'eid_template.messagetype', $fromAjax),
				'###MESSAGEDISPLAY###'  => $messagetodisplay,
				'###INFOSLEFT###'  => $infoleft,
				'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
				'###MYHOMEPAGE###'  => $myhomepagelink,
				'###SITE_REL_PATH###' => $this->locationHeaderUrlsubDir(). t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###MYHOMEPAGELINK###'  => $myhomepagetypoLink_URL,
				'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
				'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
		);
		$content = $this->t3substituteMarkerArray($templateCode, $markerArray);

		return $content;
	}

	/**
	 * Reply on comments functions
	 *
	 *
	 */

	 /**
 * Checks if comment for $commentid should be displayed or not
 *
 * @param	int		$commentid: ...
 * @param	array		$conf: ...
 * @param	boolean		$level: hierarchical level of the $commentid
 * @param	boolean		$fromAjax: ...
 * @param	[type]		$triggeredlevel: ...
 * @param	[type]		$levelexpandoverride: ...
 * @return	string		$displaystr: css-style for display
 */
	protected function getCommentBoxDisplay($commentid, $conf, $level, $fromAjax, $triggeredlevel=0, $levelexpandoverride=0) {
		// comment to be highlighted
		if (((intval($levelexpandoverride) == 1) && ($triggeredlevel>0) && ($triggeredlevel > $conf['advanced.']['userCommentResponseLevelExpanded'])) == FALSE) {
			$triggeredlevel=$conf['advanced.']['userCommentResponseLevelExpanded'];
		}

		if (array_key_exists($commentid, $this->tctreestate)) {
			if ($fromAjax) {
				if ($this->tctreestate[$commentid]==1) {
					$donotdisplay= TRUE;
				}

			} else {
				if ($level>=$triggeredlevel) {
					$donotdisplay= TRUE;
				} else {
					if (($this->tctreestate[$commentid]==1) && (intval($levelexpandoverride)==0 )) {
						$donotdisplay= TRUE;
					}

				}

			}

		}

		if (!$fromAjax) {
			if ($level>=$triggeredlevel) {
				$donotdisplay= TRUE;
			}

		} else {
			if ($level>=$triggeredlevel) {
				if (!array_key_exists($commentid, $this->tctreestate)) {
					$donotdisplay= TRUE;
				}

			}

		}

		if ($level > $this->tctreelastlevel) {
			if (!$this->tctreelastdisplay) {
				$donotdisplay= TRUE;
			} else {
				$this->tctreelastlevel=$level;

			}

		} else {
			$this->tctreelastlevel=$level;

		}

		if ($donotdisplay) {
			$displaystr= ' tx-tc-nodisp';
		} else {
			$displaystr='';
		}

		$this->tctreelastdisplay=!$donotdisplay;

		return $displaystr;
	}

	/**
	 * Checks if the commentbox for a comment child (reply) is opened or closed
	 *
	 * @param	string		$commentschildrenids: string with list of child-IDs
	 * @param	array		$conf: ...
	 * @param	int		$level: hierarchical level of the request
	 * @param	boolean		$fromAjax: ...
	 * @param	[type]		$triggeredlevel: ...
	 * @param	[type]		$levelexpandoverride: ...
	 * @return	boolean		...
	 */
	protected function getCommentBoxChildrenDisplayIsCollapsed($commentschildrenids, $conf, $level, $fromAjax, $triggeredlevel=0, $levelexpandoverride=0) {
		// comment to be highlighted
		if ((($levelexpandoverride ==1 ) && ($triggeredlevel>0 ) && ($triggeredlevel > $conf['advanced.']['userCommentResponseLevelExpanded'])) == FALSE) {
			$triggeredlevel=$conf['advanced.']['userCommentResponseLevelExpanded'];
		}

		$commentschildrenarr = explode(',', trim($commentschildrenids));
		$controlstate=0;
		$countcommentschildrenarr=count($commentschildrenarr);
		for ($i = 0; $i < $countcommentschildrenarr; $i++) {
			$keycandidate=intval(trim($commentschildrenarr[$i]));
			if ($keycandidate!=0) {
				if (array_key_exists($keycandidate, $this->tctreestate)) {
					if ($fromAjax) {
						if ($this->tctreestate[$keycandidate]==1) {
							$controlstate++;
						}

					} else {
						if ($level<$triggeredlevel) {
							if (($this->tctreestate[$keycandidate]==1) && (intval($levelexpandoverride)==0 )) {
								$controlstate++;
							}

						}

					}

				}

				if (!$fromAjax) {
					if ($level+1>=$triggeredlevel) {
							$controlstate++;
					}

				} else {
					if ($level+1>=$triggeredlevel) {
						if (!array_key_exists($keycandidate, $this->tctreestate)) {
							$controlstate++;
						}

					}

				}

			}

		}

		if  (count($commentschildrenarr)==$controlstate) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	/**
	 * Fe-usergroup functions
	 *
	 *
	 */

	/**
	 * returns the list of all users belonging to usergroups the current user belongs to
	 *
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$conf: ...
	 * @param	[type]		$communitybuddies: ...
	 * @return	string		List of users like (123, 234, 244, 245)
	 */
	public function usersGroupmembers($pObj, $fromAjax, $conf, $communitybuddies = FALSE) {
		if (!$fromAjax) {
			$usersfromenvironment='';

			if (($conf['advanced.']['wallExtension'] != 0) || ($communitybuddies))  {
				if (($conf['advanced.']['wallExtension'] == 1) || (($communitybuddies) && (t3lib_extMgm::isLoaded('community'))))  {
					//tx_community
					$relationtable ='tx_community_domain_model_relation';
					$userfields ='initiating_user AS uid1,requested_user AS uid2';
					$where ='status=2 AND deleted=0 AND hidden=0 AND (initiating_user=' . $GLOBALS['TSFE']->fe_user->user['uid'] .
					' OR requested_user=' . $GLOBALS['TSFE']->fe_user->user['uid'] .')';
					//?&tx_community[action]=show&tx_community[controller]=User&tx_community[user]=67
				}

				if (($conf['advanced.']['wallExtension'] == 2) || (($communitybuddies) && (t3lib_extMgm::isLoaded('cwt_community'))))  {
					//tx_cwt_community
					$relationtable ='tx_cwtcommunity_buddylist';
					$userfields ='fe_users_uid AS uid1,buddy_uid AS uid2';
					$where ='deleted=0 AND hidden=0 AND (fe_users_uid=' . intval($GLOBALS['TSFE']->fe_user->user['uid']) . ' OR buddy_uid=' .
					intval($GLOBALS['TSFE']->fe_user->user['uid']) .')';
					//&action=getviewprofile&uid=67
				}

				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($userfields, $relationtable,
						$where );

				if (count($rows) > 0) {
					foreach ($rows as $row) {
						$usersfromenvironment.= $row['uid1'] . ',' . $row['uid2'] . ',';
					}

				}
				$input=$GLOBALS['TSFE']->fe_user->user['uid'] . ',' . substr($usersfromenvironment, 0, strlen($usersfromenvironment)-1);
				$usersfromenvironment = implode(',', array_unique(explode(',', $input)));
				if (substr($usersfromenvironment, strlen($usersfromenvironment)-1)==',') {
					$usersfromenvironment = substr($usersfromenvironment, 0, strlen($usersfromenvironment)-1);
				}

			} else {
				$groupSelectArray =explode(',', $GLOBALS['TSFE']->fe_user->user['usergroup']);
				$where = '( ';
				$whereConn = 'OR';
				$whereLike = 'LIKE';
				$countgroupSelectArray=count($groupSelectArray);
				for ($i=0; $i<$countgroupSelectArray; $i++) {
					if ($i<>0) $where.= $whereConn;
					$where.= ' usergroup ' . $whereLike.' "' . $groupSelectArray[$i].'" '. $whereConn.' usergroup '. $whereLike . ' "%,' .
					$groupSelectArray[$i].'" '.$whereConn.' usergroup '.$whereLike.' "'.$groupSelectArray[$i].',%" '.$whereConn.' usergroup '.
					$whereLike.' "%,'.$groupSelectArray[$i].',%" ';
				}

				$where.=')';

				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid', 'fe_users',
						$where .
						$this->enableFields('fe_users', $pObj, $fromAjax));

				if (count($rows) > 0) {
					foreach ($rows as $row) {
						$usersfromenvironment.= $row['uid'] . ',';
					}

				}

				$usersfromenvironment=substr($usersfromenvironment, 0, strlen($usersfromenvironment)-1);
			}

			$_SESSION['usersfromenvironment']=$usersfromenvironment;
		} else {
			$usersfromenvironment=$_SESSION['usersfromenvironment'];
		}

		return $usersfromenvironment;
	}

	/**
	 * Determines if a specific FE User is online or not.
	 *
	 * @param	int		valid uid from 'fe_users' table.
	 * @return	boolean		TRUE if online; FALSE if not.
	 */
	protected function isUserOnline($feuser_uid) {
		// Get online status
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('ses_tstamp', 'fe_users,fe_sessions',
				'fe_users.uid = '.intval($feuser_uid).' AND fe_users.uid = fe_sessions.ses_userid');
		$last_action=0;
		if (count($rows) > 0) {
			$last_action= $rows[0]['ses_tstamp'];
		}

		$max_idle_time = 5; // 5 minutes
		$time = time();

		$diff = $time - intval($last_action);
		if ($diff < 0) {
			return TRUE;
		}

		if (($diff / 60) < $max_idle_time) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	/**
	 * Recent comments functions
	 *
	 *
	 */

	/**
	 * Generates entire list of recent comments
	 *
	 * @param	object		$pObj
	 * @param	array		$conf
	 * @param	int		$feuserid: id of current user...
	 * @return	string		Generated HTML
	 */
	public function getRecentComments($pObj, $conf, $feuserid) {
		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_recentcomments.php'));
		$librecentcomments = new toctoc_comments_recentcomments;
		$retstr = $librecentcomments->mainRecentComments($pObj, $conf, $feuserid);
		return $retstr;
	}
	/**
	 * Trim recent comment
	 *
	 * @param	string		$text	Text to crop
	 * @param	array		$conf
	 * @param	int		$maxChars: ...
	 * @param	boolean		$dospecialChars: ...
	 * @param	[type]		$precrop: ...
	 * @return	string		cropped Text
	 */
	protected function trimContent($text, $conf, $maxChars=0, $dospecialChars=TRUE, $precrop = FALSE) {
		if ($maxChars==0) {
			$maxChars = $conf['recentcomments.']['maxCharCount'];
		}

		$text=nl2br($text);
		$htmlarr=explode('<br />', $text);
		$text=implode(' ', $htmlarr);
		$htmlarr=explode('<br>', $text);
		$text=implode(' ', $htmlarr);

		if ($dospecialChars) {
			$text=htmlspecialchars(stripslashes($text));
		}

		$trimedText=$text;
		if (strlen($text) > $maxChars) {
			if ($precrop == FALSE) {
				$textcroppedleft = substr($text, 0, $maxChars);
				$textcroppedright = substr($text, $maxChars);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {
					$textcroppedleft .=$textcroppedrightarr[0] . ' ...';
					$trimedText =$textcroppedleft;
				}
			} else{
				$textcroppedleft = substr($text, 0, $maxChars);
				$textcroppedright = substr($text, $maxChars);
				$textcroppedleftarr = explode(' ', $textcroppedleft);
				if (count($textcroppedleftarr)>1) {
					$textcroppedleft = '...' . $textcroppedleftarr[count($textcroppedleftarr)-1];
					$trimedText = $textcroppedleft . $textcroppedright;
				}
			}

		}

		return $trimedText;
	}


	/**
	 * Report comments functions
	 *
	 *
	 */

	/**
	 * Adds extra marker to commented item for comment reporting
	 *
	 * @param	array		$params: Array of parameters
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$conf: ...
	 * @param	boolean		$fromAjax: ...
	 * @param	int		$pid: page id for referencing the report link used in the page
	 * @return	array		Updated markers
	 */
	protected function getCommentsReportLink($params, &$pObj, $fromAjax, $pid) {

		$markers = $params['markers'];
		$template = $this->t3getSubpart($pObj, $pObj->templateCode, '###REPORT_LINK###');
		$theURLe = $_SESSION['commentsPageIdsClean'][$pid];
		$queryParams='&toctoc_comments_pi1[info]=' . base64_encode(serialize(array(
				'url' => $theURLe,
				'uid' => $params['row']['uid'],
		)));

		if ($_SESSION['reportpageid'] == '') {
			$markers['###TX_COMMENTSREPORT###'] ='';
		} else {
			$theURLr = $_SESSION['reportpage'];
			$useCacheHashNeeded = intval($GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFoundOnCHashError']);
			$no_cacheflag = 0;
			if (intval($GLOBALS['TYPO3_CONF_VARS']['FE']['disableNoCacheParameter']) ==0) {
				if ($useCacheHashNeeded == 1) {
					$no_cacheflag = 1;
				}

			}

			$theLink = $this->cObj->typoLink_URL(array(
					'useCacheHash'     => $useCacheHashNeeded,
					'no_cache'         => $no_cacheflag,
					'parameter' => $_SESSION['reportpageid'],
					'additionalParams' => $queryParams,
					'ATagParams' => 'rel="nofollow"',
					'forceAbsoluteUrl' => 1,
			));
			$markers['###TX_COMMENTSREPORT###'] = $this->t3substituteMarkerArray($template, array(
					'###LINK###' => $theLink,
					'###TITLE###' => $this->pi_getLLWrap($pObj, 'comments_report.report_link_title', $fromAjax),
			));
		}

		return $markers;
	}

	/**
	 * The main method of the PlugIn-instance comment reporting
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$piVars: ...
	 * @return	string		The content that is displayed on the website
	 */
	public function mainReport($content, $conf, $pObj, $piVars) {

		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_commentreport.php'));
		$libreport = new toctoc_comments_commentreport;
		$retstr = $libreport->generateReport($content, $conf, $pObj, $piVars);
		return $retstr;
	}




	/**
	 * Debug function
	 *
	 *
	 */

	/**
	 * tracks execution times of functions if debug.showLibDetails = 1 and active.
	 * tracking works with 2 subsequent calls to this function
	 * the name of the tracked function of these 2 calls must be the same
	 * the function fills the internal array $this->debugprintlib with the execution times
	 * result is then generated in maincomments(..)	 *
	 *
	 * @param	string		$trackingfunction: the name of the tracked function
	 * @return	void		...
	 */
	protected function trackdebug ($trackingfunction) {
		if (trim($_SESSION['debugprintlib']['debugtext'])!='') {
			$i=intval($this->debugprintlib['tfs'][$trackingfunction . 'index']);
			$this->debugprintlib['tfs'][$trackingfunction . '_in'][$i] = microtime(TRUE);
				if ($i % 2 == 1) {
				$this->debugprintlib['trackingfunction'][$trackingfunction][($i-1)/2]=$this->debugprintlib['tfs'][$trackingfunction. '_in'][$i]-
																				$this->debugprintlib['tfs'][$trackingfunction. '_in'][$i-1];
				}

			$this->debugprintlib['tfs'][$trackingfunction . 'index']=intval($this->debugprintlib['tfs'][$trackingfunction . 'index'])+1;
		}

	}

	/**
	 * Top ratings functions
	 *
	 *
	 */

	/**
	 * Entry point from pi, stating a cObj in $this and lauch generation of top ratings
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	string		...
	 */
	public function showtopRatings($conf, $pObj) {

		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_charts.php'));
		$libchart = new toctoc_comments_charts;

		$retstr = $libchart->topratings($conf, $pObj);
		return $retstr;
	}
	/**
	 * Entry point from pi, stating a cObj in $this and lauch generation of top sharings
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	string		...
	 */
	public function showtopSharings($conf, $pObj) {

		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_charts.php'));
		$libchart = new toctoc_comments_charts;

		$retstr = $libchart->topsharings($conf, $pObj);
		return $retstr;
	}


	/**
	 * show userCenter functions
	 *
	 *
	 */

	/**
	 * Entry point from pi to launch generation of user Center
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @return	string		...
	 */
	public function showuserCenter($conf, $pObj) {
		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_usercenter.php'));
		$libusercenter = new toctoc_comments_usercenter;

		$retstr = $libusercenter->usercenter($conf, $pObj);
		return $retstr;
	}

	/**
	 * Entry point from pi for search comments
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$pObj: ...
	 * @param	[type]		$fromAjax: ...
	 * @param	[type]		$data: ...
	 * @param	[type]		$cid: ...
	 * @return	string		...
	 */
	public function showCommentsSearch($conf, $pObj, $fromAjax = FALSE, $data = '', $cid = 0) {

		require_once(t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_search.php'));
		$libsearch = new toctoc_comments_search;

		$retstr = $libsearch->commentssearch($conf, $pObj, $fromAjax, $data, $cid);
		return $retstr;
	}
	/**
	 * Changes a user picture to the corresponding gravatar, using current email.
	 *
	 * @param	array		$conf: ...
	 * @param	string		$outstr: linkaddress of the current userpic
	 * @param	string		$email: users email
	 * @param	[type]		$watchanonymgravatar: ...
	 * @return	string		...
	 */
	private function gravatarize($conf, $outstr, $email, $watchanonymgravatar = FALSE) {
		$originaloutstr = $outstr;
		if  (str_replace('gravatar.com', '', $outstr) == $outstr) {
			$default = '';
			$tmpimgstrarr = array();
			$tmpimgstrarr = explode('src="', $outstr);
			$tmpimgstrarrstr = $tmpimgstrarr[1];
			$tmpimgstrarrstrarr = array();
			$tmpimgstrarrstrarr = explode('"', $tmpimgstrarrstr);
			$default = $tmpimgstrarrstrarr[0];
			if (trim($conf['advanced.']['gravatarLocalHost']) != '0') {
				$default = 'd=' . trim($conf['advanced.']['gravatarLocalHost']) . '&amp;';
			} else {
				if  (str_replace('http', '', $default) == $default) {
					$defaulturl = (@$_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
					$default = $defaulturl . $_SERVER['HTTP_HOST']. '/'. $default;
				}

				$default = 'd='. urlencode($default) . '&amp;';
			}

			$grav_url = (@$_SERVER['HTTPS'] == 'on') ? 'https://secure.' : 'http://www.';
			$grav_url .= 'gravatar.com/avatar/'. md5($email).	'?' . $default . 's=' . intval($this->userimagesize).
			'&amp;r=' . $conf['advanced.']['gravatarRating'];

			$tmpimgstrarrstrarr[0] = $grav_url;
			$tmpimgstrarrstr = implode('"', $tmpimgstrarrstrarr);
			$tmpimgstrarr[1] = $tmpimgstrarrstr;
			$outstr = implode('src="', $tmpimgstrarr);
		}

		if ($watchanonymgravatar || (str_replace($_SESSION['userpicm'], '', $originaloutstr) != $originaloutstr) ||
				(str_replace($_SESSION['userpicf'], '', $originaloutstr) != $originaloutstr)) {
			if ($email != '') {
				$this->gravatarimages[$email] = $outstr;
				$_SESSION['gravatarimages'][$email] = $outstr;
			}

			return $originaloutstr;
		} else {
			return $outstr;
		}

	}
	/**
	 * Creates an square image using GIFBUILDER or PHP-Builtin functions.
	 *
	 * @param	string		$userimgFile: ...
	 * @param	int		$imagesize: size of the pic userpic
	 * @param	string		$profileimgclass: users email
	 * @param	string		$classonline: users email
	 * @param	string		$userimagestyle: users email
	 * @param	string		$usernametitle: users email
	 * @param	[type]		$classonline: ...
	 * @param	[type]		$userimagestyle: ...
	 * @param	[type]		$usernametitle: ...
	 * @param	[type]		$email: ...
	 * @param	[type]		$cssid: ...
	 * @param	[type]		$nogen: ...
	 * @param	[type]		$imgalign: ...
	 * @return	string		$tmpimgstr: img-tag of the pic
	 */
	private function gifbuild($conf, $pObj, $gravatarEnable, $userimgFile, $imagesize, $profileimgclass, $classonline,
			$userimagestyle, $usernametitle, $email, $cssid, $nogen = FALSE, $imgalign = '', $watchanonymgravatar = FALSE) {
		if ($imgalign != '') {
			$imgalign = ' align="' . $imgalign . '" ';
		}

		if ($nogen == TRUE) {
			if ((str_replace('http:/', '', $userimgFile) == $userimgFile) && (str_replace('https:/', '', $userimgFile) == $userimgFile)) {
				if (substr($userimgFile, 0, 1) != '/') {
					$userimgFile = '/' . $userimgFile;
				}

			}

			$tmpimgstr = '<img src="'.$userimgFile.'" class="'.$profileimgclass . $classonline . $userimagestyle .
			'"' . $imgalign . ' title="'. $usernametitle . '"  id="' . $cssid . '" />';
		} else {
			if ($this->dontuseGIFBUILDER == 1) {
				if (!(isset($this->commonObj))) {
					require_once ('class.toctoc_comments_common.php');
					$this->commonObj = new toctoc_comments_common;
				}

				$picpath = '';
				$picname = '';
				$commentuserimageoutarr = explode('/', $userimgFile);
				$picname = $commentuserimageoutarr[(count($commentuserimageoutarr)-1)];
				$picpath = str_replace($picname, '', $userimgFile);
				$tmpimglink = $this->commonObj->substGifbuilder($picpath, $picname, $imagesize);
				$tmpimgstr = '<img src="' . $tmpimglink . '" class="' . $profileimgclass . $classonline . $userimagestyle .
				'" title="'. $usernametitle . '"  id="' . $cssid . '" />';

			} else {
				if (!(isset($pObj->cObj))) {
					$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
				}
				
				$buildimagesize = $imagesize;
				$img = array();
				$img['file'] = GIFBUILDER;
				$img['file.']['XY'] = '' . $buildimagesize .',' . $buildimagesize . '';
				$img['file.']['10'] = IMAGE;
				$img['file.']['10.']['file'] = $userimgFile;
				$img['file.']['10.']['file.']['width'] = $buildimagesize .'c';
				$img['file.']['10.']['file.']['height'] = $buildimagesize .'c';
				$img['params'] = 'class="' . $profileimgclass . $classonline . $userimagestyle . '"' . $imgalign . ' title="'.$usernametitle.'" id="' . $cssid . '"';
				$tmpimgstr = $pObj->cObj->IMAGE($img);
			}
			
		}
		
		if ($tmpimgstr == '') {
			$tmpimgstr = '<img src="https://www.toctoc.ch/fileadmin/txtc/txtc-inf.gif" class="'.$profileimgclass . $classonline . $userimagestyle .
			'" title="'. $usernametitle . '"  id="' . $cssid . '" />';
		}

		// gravatar
		if ($gravatarEnable == 1) {
			$tmpimgstr = $this->gravatarize($conf, $tmpimgstr, $email, $watchanonymgravatar);
		}
		
		return $tmpimgstr;
	}

}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/toctoc_comment_lib.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/pi1/toctoc_comment_lib.php']);
}
?>