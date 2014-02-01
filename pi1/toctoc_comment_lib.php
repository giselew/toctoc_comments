<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 2013 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *  193: class toctoc_comment_lib  extends tslib_pibase
 *  226:     public function maincomments($ref, $conf = null, $fromAjax = false, $pid=0, $feuserid = 0, $cmd = '', &$pObj, $piVars = array(),
		$cid = 0, $sessioncapdata = '', $userpic='', $commentspics = array(), $check='', $AjaxData = '', $ajaxextref= '', $tctreestate = null)
 *  360:     protected function checkExternalUid($conf,$pObj)
 *
 *              SECTION: Commenting functions
 *  388:     public function comments($conf,&$pObj,$fromAjax,$feuserid,$pid)
 * 1253:     public function comments_getComments(&$rows,$conf,$pObj,$feuserid,$fromAjax,$pid)
 * 1786:     protected function comments_getComments_getRatings(&$row,$conf,$pObj,$feuserid, $fromAjax)
 * 1805:     protected function comments_getComments_getEmail($email)
 * 1819:     protected function isCommentingClosed($conf,$pObj)
 * 1865:     protected function commentingClosed($pObj,$fromAjax)
 * 1885:     protected function comments_getCommentsBrowser($rpp,$startpoint,$totalrows,$pObj,$fromAjax, $conf)
 * 2001:     protected function build_AJAXImages ($conf,$usergenderexistsstr='')
 * 2139:     public function comments_getComments_fe_user($params, $conf, $pObj,$commentid,$fromAjax)
 * 2226:     protected function fixFeUserPic ($conf, $pic)
 *
 *              SECTION: functions for images cache (AJAX)
 * 2252:     protected function setAJAXimage($image,$feuserid)
 * 2263:     protected function getAJAXimage($feuserid,$commentid)
 * 2294:     protected function setAJAXimageCache($image,$imageoriginal,$feuserid)
 * 2305:     protected function getAJAXimageCache($commentuserimageout)
 *
 *              SECTION: Form functions
 * 2330:     public function form($conf, &$pObj, $piVars,$fromAjax,$pid, $ifeuserid=0, $userpic)
 * 2845:     protected function form_updatePostVarsWithFeUserData($conf, &$pObj, $piVars, $feuserid, $fromAjax, $userpic, $cid)
 * 3137:     protected function form_getCaptcha($pObj, $conf,$fromAjax)
 * 3185:     protected function form_wrapError($field, $pObj, $conf)
 *
 *              SECTION: Comments page-browser functions
 * 3218:     protected function processBrowserSubmission($conf, $pObj, $piVars, $fromAjax, $cid, $cmd,$pid, $ref)
 *
 *              SECTION: Inserting and Updating Comments functions
 * 3299:     public function processSubmission($conf,$pObj,$piVars,$fromAjax,$feuserid,$pid,$lang)
 * 3727:     public function updateComment($conf,$pObj,$ctid,$content,$pid)
 * 3832:     protected function processSubmission_checkTypicalSpam($pObj, $conf, $piVars, $lang, $fromAjax)
 * 3905:     protected function processSubmission_validate($piVars, $conf, $pObj,$fromAjax)
 * 3974:     public function sendNotificationEmail($uid, $points, $action, $conf, $pObj, $fromAjax, $piVars, $pid,$fetoctocusertoinsert,$attachment_id=0 ,$attachment_subid=0, $optinemail='')
 * 4324:     protected function emailOptIn($conf, $optinemail, $optin_ip)
 * 4397:     protected function checkCOI($conf,$email,$checkip=true)
 *
 *              SECTION: language handling functions
 * 4433:     public function fixLL(&$conf)
 * 4454:     protected function fixLL_internal($LL, &$ll, $prefix = '')
 *
 *              SECTION: mostly formatting functions
 * 4477:     protected function createLinks($text, $conf)
 * 4499:     protected function applyStdWrap($text, $stdWrapName, $conf = null, $pObj = null)
 * 4518:     protected function checkCustomFunctionCodes($code, $pObj)
 * 4540:     protected function isNoCacheUrl($url)
 * 4561:     protected function substituteMarkersAndSubparts($template, array $markers, array $subparts, $pObj)
 *
 *              SECTION: session and cache functions
 * 4584:     public function resetSessionVars($resetcontext, $alsoajaxvar = true)
 * 4629:     public function getClearCacheIds($conf, $pid = 0)
 *
 *              SECTION: Smilie functions
 * 4669:     public function parseSmilieArray($data)
 * 4686:     public function replaceSmilies($content,$conf)
 * 4704:     public function replaceBBs($content,$conf,$purge=false)
 *
 *              SECTION: functions for the AJAx interface with jQuery/JavaScript
 * 4757:     protected function getAjaxJSData($feuserid, $pid, $languagecode, $conf, $pObj, $cid, $fromAjax, $dataonly=false)
 * 4797:     protected function getAjaxData($feuserid, $pid, $languagecode, $conf, $cid)
 * 4841:     protected function getAjaxDataAttachments($conf,$fromAjax,$pObj)
 * 4862:     protected function getAjaxJSDataCommentImgs($cid, $pObj,$fromAjax)
 * 4898:     protected function getAjaxJSDataComments($cid,$pObj,$fromAjax)
 * 4936:     protected function getAjaxDataComments($pObj, $cid)
 * 4956:     protected function getAjaxDataImgs()
 *
 *              SECTION: URL- and IP-related functions
 * 4975:     public function getCurrentIp()
 * 4989:     public function hasValidItemUrl($piVars)
 * 5012:     public function getDefaultConfig($pluginkey='')
 * 5025:     protected function ae_detect_ie()
 *
 *              SECTION: Rating functions
 * 5053:     public function getRatingDisplay($ref, $conf = null, $fromAjax = 0, $pid=0, $returnasarray = false, $feuserid = 0, $cmd = 'vote',
			$pObj = null, $cid, $fromcomments,$commentspics = array())
 * 5099:     public function isVoted($ref,$conf,$pObj)
 * 5117:     protected function getBarWidth($rating,$conf)
 * 5130:     protected function getRatingInfo($ref,$pObj, $feuserid=-1,$conf)
 * 5231:     protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments, $commentspics)
 * 5794:     function makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating = array(),$mylikeval,$mydis='',$template,$cid, $commentspics,$extpreffortext)
 *
 *              SECTION: TYPO3 workarounds
 * 6136:     public function enableFields($tableName,$pObj)
 * 6156:     public function pi_getLLWrap($pObj, $llkey, $fromAjax)
 * 6174:     protected function getcheck ($ref, $i, $ajaxData, $ratingscheck)
 * 6195:     protected function formatDate($date, $pObj, $fromAjax, $conf)
 * 6315:     protected function getPageURL($fromAjax = false,$pid = 0)
 * 6341:     protected function getCleanHTML ($html)
 *
 *              SECTION: Usercards
 * 6374:     public function getUserCard($basedimgstr,$basedtoctocuid,$conf,$pObj,$commentid)
 *
 *              SECTION: Mail functions
 * 6690:     protected function getMailTo($mailAddress, $linktxt = '', $initP = '?')
 * 6733:     protected function encryptEmail($string,$back=0)
 * 6769:     protected function encryptCharcode($n,$start,$end,$offset)
 * 6791:     function send_mail ($toEMail,$subject,$message,$html,$fromEMail,$fromName,$attachment='')
 * 6919:     protected function slashName ($name, $apostrophe='"')
 *
 *              SECTION: Commentator-Notification functions
 * 6943:     public function handleCommentatorNotifications($uid, $conf,$pObj, $fromeID = false, $pid=0,$fromAjax=1)
 *
 *              SECTION: Administrator comment response functions
 * 7050:     protected function getCommentsReponse(&$params, &$pObj, $conf)
 *
 *              SECTION: Website preview functions
 * 7094:     public function cleanupfup($cmd, $cid, $data, $pObj, $fromAjax, $uploadedfile, $conf, $originalfilename)
 * 7114:     public function getwebpagepreview($cmd, $cid, $data, $pObj, $fromAjax, $websitepreviewid=0, $conf)
 * 7160:     protected function getpreviewinit($cid,$data, $pObj)
 * 7193:     protected function savewebpagepreviewtodb($pcid,$pcommentid,$userurl,$conf)
 * 7380:     protected function cleanupdbandfiles($conf,$uploadedfile='',$originalfilename='')
 * 7508:     protected function getwebpagecache($pcid,$pcommentid, $conf, $url='', $isbeforefetch = false)
 * 7619:     protected function read_dir($dir, $array = array())
 * 7647:     protected function commentShowWebpagepreview ($rowattachmentid,$rowattachment_subid,$conf,$pObj,$cid,$topwebsitepreview,$fromAjax, $row = array(), $isforemailnotification = false)
 * 7931:     protected function makeAttachementPicture($picturefilename,$conf,$descriptionbyuser,$originalfilename, $firstname, $lastname,$fetoctocusertoinsert)
 *
 *              SECTION: eID-Interface functions
 * 8104:     public function handleeID($uid, $conf,$pObj,$messagetodisplay,$refreshurl)
 *
 *              SECTION: Reply on comments functions
 * 8203:     protected function getCommentBoxDisplay($commentid,$conf,$level,$fromAjax)
 * 8262:     protected function getCommentBoxChildrenDisplayIsCollapsed($commentschildrenids,$conf,$level,$fromAjax)
 *
 *              SECTION: Fe-usergroup functions
 * 8317:     public function usersGroupmembers($pObj, $fromAjax, $conf)
 *
 *              SECTION: Recent comments functions
 * 8398:     public function getRecentComments($pObj, $conf,$feuserid)
 * 8459:     protected function comments_getRecentComments($rows,$conf,$pObj)
 * 8634:     protected function trimContent($text,$conf, $maxChars=0)
 * 8675:     protected function createRCLinks($text, $refID, $commentID, $prefix, $table, $externalprefix, $singlePid, $conf,$show_uid)
 *
 *              SECTION: Report comments functions
 * 8723:     protected function getCommentsReportLink($params, &$pObj, $conf ,$fromAjax,$pid)
 * 8758:     public function mainReport($content, $conf, $pObj, $piVars)
 * 8782:     protected function processReportForm(array &$errors,$conf, $pObj, $piVars)
 * 8910:     protected function showReportThanks($conf,$pObj)
 * 8923:     protected function showReportForm(array $errors,$conf,$pObj,$piVars)
 * 9006:     protected function getReportCaptcha($required, $error,$conf,$pObj)
 *
 *              SECTION: IP-blocking functions
 * 9050:     protected function IPBlockSpamCheck(&$params, &$pObj)
 * 9069:     protected function sendNotificationIPBlock($params, &$pObj)
 * 9083:     private function getIpAddr()
 * 9098:     private function checkTableBLs($ipaddr)
 * 9109:     private function checkLocalBL($ipaddr)
 * 9122:     private function checkStaticBL($ipaddr)
 * 9149:     function checkNetworkBLs($ipaddr)
 *
 * TOTAL FUNCTIONS: 101
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
require_once(PATH_t3lib . 'class.t3lib_refindex.php');
require_once(PATH_tslib . 'class.tslib_pibase.php');
require_once(PATH_t3lib . 'class.t3lib_befunc.php');

/**
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class toctoc_comment_lib  extends tslib_pibase {
	var $sessionCaptchaData = '';
	var $AJAXimages = array();
	var $AJAXimagesCache = array();
	var $smilies = array();				       // Smilie array
	var $smiliesPath = '';				//	Path to smilie folder
	var $check = '';
	var $AjaxData = '';
	var $AJAXimage = '';
	var $newcommentid = -1;
	var $limitofrows =  500; // maximum of rows fetched for comments at a time.
	var $externalref = '';
	var $ajaxextref= '';
	var $tctreestate = array();
	var $tctreelastlevel =0;
	var $tctreelastdisplay =0;


	var $table = 'tx_toctoc_comments_comments';

	var $webpagepreviewsavefolder = 'uploads/tx_toctoccomments/webpagepreview/';
	var $webpagepreviewtempfolder = 'uploads/tx_toctoccomments/temp/';
	var $lastpreviewid = 0;
	var $userrows = '';
	var $ajaxHeader = '';
	var $topareaHTML = '';
	var $BBs=array();
	var $allowHTMLTagsInComments=false;
	/**
	 * Entrypoint function and dispatcher for subfunctions.
	 *
	 * @return	string		HTML-Output
	 */
	public function maincomments($ref, $conf = null, $fromAjax = false, $pid=0, $feuserid = 0, $cmd = '', &$pObj, $piVars = array(),
		$cid = 0, $sessioncapdata = '', $userpic='', $commentspics = array(), $check='', $AjaxData = '', $ajaxextref= '', $tctreestate = null) {
		$content = '';
		if ($_SESSION['commentsPageOrigId'] !=0) {
			if ($pid !=0) {
				$pid= $_SESSION['commentsPageOrigId'];
			}
		}
		$this->sessionCaptchaData=$sessioncapdata;
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		$this->smiliesPath = str_replace('EXT:toctoc_comments/','/' . t3lib_extMgm::siteRelPath('toctoc_comments'),$conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);
		$this->check = $check;
		$this->AjaxData = $AjaxData;
		$this->AJAXimage = $userpic;
		$this->newcommentid = -1;
		$this->externalref = $ref;
		$this->ajaxextref = $ajaxextref;

		if (is_array($tctreestate)) {
			$this->tctreestate = $tctreestate;
		}

		if ((trim($conf['code'])=='FORM,COMMENTS') || (trim($conf['code'])=='COMMENTS,FORM') || (trim($conf['code'])=='COMMENTS')) {
			// code is ok
		} else {
			// reset to default
			$conf['code']='COMMENTS,FORM';
		}

		$this->allowHTMLTagsInComments = $conf['advanced.']['allowHTMLTagsInComments'];


		if ($AjaxData !=='') {
			$_SESSION['ajaxData']=$AjaxData;
		}

		// check if we need to go at all
		if ($fromAjax === true) {

			$_SESSION['commentListCount']=$cid;

			if ($this->checkExternalUid($conf,$pObj)) {

				if ($cmd === 'addcomment') {

					$commentingClosed = $this->isCommentingClosed($conf,$pObj);
					if (!$commentingClosed) {
						//echo 'processSubmission';exit;
						    $this->processSubmission($conf,$pObj,$piVars,$fromAjax,$feuserid,$pid, $_SESSION['activelangid']);

							$content .= $this->form($conf, $pObj, $piVars,$fromAjax,$pid,$feuserid, $userpic);
					} else {
						$content .= $this->commentingClosed($pObj,$fromAjax);
					}
				}
				if ($cmd === 'deletecomment') {
					$content .= $this->processDeleteSubmission($piVars,$pObj);
				}
				if ($cmd === 'showcomments') {
					$this->AJAXimages = $commentspics;
					$content .= $this->comments($conf,$pObj,$fromAjax,$feuserid,$pid);
					$content=$this->topareaHTML.$content;
				}
				if (($cmd === 'browse')||($cmd === 'browsehide')) {
					$this->processBrowserSubmission($conf,$pObj,$piVars,$fromAjax,$cid,$cmd,$pid,$ref);
					$this->AJAXimages = $commentspics;
					$content .= $this->comments($conf,$pObj,$fromAjax,$feuserid,$pid);
					$content=$this->topareaHTML.$content;
					if ( $content=='') {
						$content .= "No CIDs found";
					}
				}
			}
			$this->resetSessionVars(2);
		} else {
			if ($this->checkExternalUid($conf,$pObj)) {
				$commentingClosed = $this->isCommentingClosed($conf,$pObj);

				if ($conf['ratings.']['ratingsOnly'] !=0) {

					$content .= $this->comments($conf,$pObj,$fromAjax,intval($GLOBALS['TSFE']->fe_user->user['uid']),$GLOBALS['TSFE']->id);

					if ( $content=='') {
						$content .= "No CIDs found";
					} else {
						$content =$this->ajaxHeader.$this->topareaHTML.$content;
					}
				} else {

					foreach (t3lib_div::trimExplode(',', $conf['code'], true) as $code) {

						 switch ($code) {
							case 'COMMENTS':

								$content .= $this->comments($conf,$pObj,$fromAjax,intval($GLOBALS['TSFE']->fe_user->user['uid']),$GLOBALS['TSFE']->id);

								if ( $content=='') {
									$content .= "No CIDs found";
								}
								break;
							case 'FORM':
								if ($commentingClosed) {
									$content .= $this->commentingClosed($pObj,$fromAjax);
								}
								else {
									// check form submission
									$content .= $this->form($conf, $pObj, $piVars,$fromAjax,$GLOBALS['TSFE']->id,intval($GLOBALS['TSFE']->fe_user->user['uid']), $userpic);
							 	}
								break;
							default:
								 $content .= $this->checkCustomFunctionCodes($code,$pObj);
						 		break;
						}
					}
					$content =$this->ajaxHeader.$this->topareaHTML.$content;

				}
				$content = $pObj->pi_wrapInBaseClass($content);
			}
			$this->resetSessionVars(2);
		}

		return $content;
	}

	/**
	 * Checks that $this->externalUid represents a real record.
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	boolean		true, if $this->externalUid is ok
	 */
	protected function checkExternalUid($conf,$pObj) {
	 $result = ($conf['externalPrefix'] == 'pages');
	if (!$result && $pObj->externalUid) {
	// Check other tables¨
	list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', $pObj->foreignTableName,
			'uid=' . intval($pObj->externalUid) . $this->enableFields($pObj->foreignTableName,$pObj));
	$result = ($row['t'] == 1);
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
	public function comments($conf,&$pObj,$fromAjax,$feuserid,$pid) {

		// Find starting record
		if ($conf['ratings.']['ratingsOnly'] ==0) {


			if ($this->isCommentingClosed($conf,$pObj)) {
				$conf['ratings.']['mode'] = 'static';

			}
			if (isset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'])) {
				$startpoint = $_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'];
			}else{
				$startpoint =-1;
			}
			if (intval($_SESSION['submittedCid']) == 0) {
				unset($_SESSION['requestCapcha'][$_SESSION['commentListCount']]['startIndex']);
			}
			$condfeusergroup='';
			if ((($conf['advanced.']['wallExtension'] != 0) && (intval($feuserid) !=0)) OR
			 (($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) !=0) &&($conf['advanced.']['showFeUsercomments']==1))) {
				$condfeusergroup = ' AND toctoc_commentsfeuser_feuser IN ('. $this->usersGroupmembers($pObj, $fromAjax,$conf) . ')';
			} else {
				if (($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) ==0)) {
					$condfeusergroup = ' AND toctoc_commentsfeuser_feuser=0';
				}
			}

			if ($conf['advanced.']['showFeUsercomments']==0){
				$condfeusergroup = ' AND toctoc_commentsfeuser_feuser=0';
			}


			$rpp = intval($conf['advanced.']['commentsPerPage']);
			$rpp = ($rpp == 0 ? 1 : $rpp);

			if (substr($_SESSION['commentListRecord'],0,5)=='tt_co') {
				if ($pObj->foreignTableName == 'pages' ) {
					$whereplus=' AND (external_ref_uid="tt_content_' . $_SESSION['commentListCount'] .'")';
				}
			}

			// total comments count 1st
			$totalcommentscount='';
			if ($conf['advanced.']['commentsShowCount'] ==1) {
				$wherecommunity='';
				if ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users') {
					$wherecommunity =' AND parentuid=0';
				}
				$tmpwhere=' approved=1 AND ' . ($tmpint ?
					'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
					$this->enableFields('tx_toctoc_comments_comments',$pObj) . $whereplus . ' AND (' . $pObj->where_dpck . ')' . $wherecommunity;

				list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS counter',
						'tx_toctoc_comments_comments', $tmpwhere . $condfeusergroup);
				$commentscounter=intval($row['counter']);
				if ($commentscounter>0){

					if ($commentscounter==1) {

						$totalcommentscount='1 '  . $this->pi_getLLWrap($pObj, 'pi1_template.commentavailable', $fromAjax) ;
						$totalpostscount='1 '  . $this->pi_getLLWrap($pObj, 'pi1_template.postavailable', $fromAjax) ;


					}else{
						$totalcommentscount=$commentscounter . ' '  . $this->pi_getLLWrap($pObj, 'pi1_template.commentsavailable', $fromAjax) ;
						$totalpostscount=$commentscounter . ' '  . $this->pi_getLLWrap($pObj, 'pi1_template.postsavailable', $fromAjax) ;
					}
					if ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users') {
						$totalcommentscount =$totalpostscount;
					}
					$templatecommentscount = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENTSCOUNTSUB###');

					$markerscommentscount= array(
							'###CID###'=> $_SESSION['commentListCount'],
							'###COMMENTSCOUNT###'=> $totalcommentscount,
					);
					$totalcommentscount=$pObj->cObj->substituteMarkerArray($templatecommentscount, $markerscommentscount);
				}
			}

			$whereplus.=' AND parentuid=0';
			if (strpos($pObj->where,$whereplus)==0){
				$pObj->where .= $whereplus;
			}
			list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS counter',
					'tx_toctoc_comments_comments', $pObj->where . $condfeusergroup);
			$commentscounter=intval($row['counter']);

			if ($startpoint < 0) {
				if ($conf['advanced.']['reverseSorting']==0) {
					$startpoint = intval($row['counter']-$rpp) <= 0 ? 0 : (intval($row['counter']-$rpp));
					$hasolderrows = $startpoint;
				} else{
					$startpoint =$rpp;
					$hasolderrows = intval($row['counter']-$rpp) <= 0 ? 0 : (intval($row['counter']-$rpp));
				}

			}
			else {
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
				if  ($maxstartpoint>=0){
					if ($maxstartpoint<$startpoint){
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
				}
				else {
					$moddiff= ($startpoint -  $rpp + $stepbackbyolder) % $stepbackbyolder;
				}
				if ($moddiff == 0) {
					//cool
				}
				else {
					//try adjust get next higher startpoint
					if ($conf['advanced.']['reverseSorting']==0) {
						$trystartpoint=$startpoint +  $moddiff -$stepbackbyolder;
						if ($maxstartpoint<= $trystartpoint){
							$startpoint=$maxstartpoint;
						}
						else {
							//$startpoint=$trystartpoint;
						}
						if ($startpoint< 0){
							while ($startpoint< 0) {
								$startpoint=$startpoint+$stepbackbyolder;
							}
							if ($startpoint> $maxstartpoint){
								$startpoint=$maxstartpoint;
							}
						}
					} else {
						$startpoint=$startpoint -  $moddiff +$stepbackbyolder;
						if ($maxstartpoint<= $startpoint){
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
			$sortinglvl0 = 'crdate';
			if ($conf['advanced.']['reverseSorting']==1) {
				$sortinglvl0 .= ' DESC';
			}

			$rowsin = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid',
					'tx_toctoc_comments_comments', $pObj->where . $condfeusergroup, '', $sortinglvl0, $limitofrows . ' OFFSET ' . $start);
			//Sorting for comments on comments
			$uidarr = array();
			$uidmetaarr = array();
			for ($i = 0; $i < count($rowsin); $i++) {
				$uidarr[$i] = $rowsin[$i]['uid'];
				$uidmetaarr['c' . $rowsin[$i]['uid']]['level'] = 0;
				$uidmetaarr['c' . $rowsin[$i]['uid']]['parentuid'] = 0;
				$uidmetaarr['c' . $rowsin[$i]['uid']]['children'] = '';
				$uidmetaarr['c' . $rowsin[$i]['uid']]['allchildren'] = '';
				$uidmetaarr['c' . $rowsin[$i]['uid']]['uid'] = $rowsin[$i]['uid'];
			}
			$uidsubsel = implode(',',$uidarr);
			$uidsubselall = $uidsubsel;


			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($conf['storagePid']);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($conf['storagePid']);
			}
			$subselwhere = ' AND approved=1 AND ' . ($tmpint ?
					'pid=' . $conf['storagePid'] : 'pid IN (' . $conf['storagePid'] . ')') .
					$this->enableFields('tx_toctoc_comments_comments',$pObj);


			$controlrows=count($rowsin);

			$level=1;
			if ($uidsubsel !='') {
				Do {

					$rowschildrenin = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, parentuid',
							'tx_toctoc_comments_comments', 'parentuid IN (' . $uidsubsel . ') ' . $condfeusergroup . $subselwhere) ;

					$uidarr = array();
					$controlrows=count($rowschildrenin);
					for ($i = 0; $i < count($rowschildrenin); $i++) {
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['level'] = $level;
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['allchildren']  = '';
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['parentuid'] = $rowschildrenin[$i]['parentuid'];
						$uidmetaarr['c' . $rowschildrenin[$i]['uid']]['uid'] = $rowschildrenin[$i]['uid'];
						$uidmetaarr['c' . $rowschildrenin[$i]['parentuid']]['children'] = $uidmetaarr['c' . $rowschildrenin[$i]['parentuid']]['children'] . ',' . $rowschildrenin[$i]['uid'];;

						$uidarr[$i] = $rowschildrenin[$i]['uid'];
					}
					if (count($rowschildrenin) > 0) {
						$uidsubsel = implode(',',$uidarr);
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

			if ($uidsubselall==''){
				$uidsubselall='0';
			}
			if ($conf['advanced.']['reverseSorting']==0) {
				$sortinglvlall = $sortinglvl0;

			} else {
				$sortinglvlall = 'CASE WHEN parentuid=0 THEN crdate ELSE (2*UNIX_TIMESTAMP() - crdate) END DESC';
			}
            $rowsin = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user, uid,approved,crdate,firstname,lastname,homepage,
					location,email,content,tx_commentsnotify_notify,remote_addr,SUBSTR(external_ref_uid,12) AS external_ref_uid,attachment_id,attachment_subid,parentuid,gender,external_ref',
            		'tx_toctoc_comments_comments', 'uid IN (' . $uidsubselall . ')' . $condfeusergroup, '', $sortinglvlall);

            $i = 0;
            $controlrows = 1;
            $nextlevelidarr=array();
           	$nextlevelidarr[0]=0;
           	$nextparentuid=0;
           	$outp=0;
            $processingpoint=0;

            //build feusers owned rows
            $userrows= array();
            $this->userrows='';
            $ui=0;
            if (intval($feuserid) != 0) {
            	foreach ($rowsin as $row) {
            		if ($row['toctoc_commentsfeuser_feuser'] == $feuserid) {
            			$userrows[$ui]=$row['uid'];
            			$ui++;
            		}
            	}
            	if (count($userrows)>0) {
            		$userrows=array_reverse($userrows);
            		$spliceval=$conf['advanced.']['commentsEditBack'];
            		if (count($userrows) <= $spliceval) {
            			$spliceval=count($userrows);
            		}
            		if (count($userrows) != $spliceval) {
            			array_splice($userrows, $spliceval);
            		}
            		$this->userrows=implode(',',$userrows);
            	}
            }

	        if (count($rowsin)>0){
	            Do {
	            	// find next required level

	            	$levelreq= 0;
	            	$levelfound= false;
	            	for ($j = 1; $j < count($nextlevelidarr); $j++) {
	            		// level 0 is always 0 so we start at 1
	            		if ($nextlevelidarr[$j]==0) {
	            		// the end of the list is reached, the level to work on is jsut the level below.
	            		} else {
	            			// there's a parentid for this level stored, we suggest this level to work on
	            			$levelreq= $j;
	            			$levelfound= true;
	            		}
	            	}
	            	if ($levelfound== false) {
	            		$levelreq= 0;
	            	}

	            	$nextparentuid=$nextlevelidarr[$levelreq];


	            	// we scan all rows (odered by crdate), starting from the point of the last contiously processed row
	            	for ($p = $processingpoint; $p < count($rowsin); $p++) {
	            		//check if its the right level
	            		if (!$rowsin[$p]['processed']){
			            	if ($uidmetaarr['c' . $rowsin[$p]['uid']]['level'] == $levelreq) {
			            		// check if it's the right parent uid

			            		if ($uidmetaarr['c' . $rowsin[$p]['uid']]['parentuid'] == $nextlevelidarr[$levelreq]) {
					            	$rowsin[$p]['level'] = $uidmetaarr['c' . $rowsin[$p]['uid']]['level'];
					            	$rowsin[$p]['children'] = substr($uidmetaarr['c' . $rowsin[$p]['uid']]['children'],1);
					            	$rowsin[$p]['allchildren'] = $uidmetaarr['c' . $rowsin[$p]['uid']]['allchildren'];
					            	$rowsin[$p]['replies'] = 0;
					            	$rowsin[$p]['processed'] = 1;

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
	            	}

	            	if ($processingpoint>=count($rowsin)) {
	            		$controlrows = 0;
	            	}


	           } while ($controlrows != 0);
	       }
			$tmpuid=$pObj->externalUid;
			//print '_$count: ' . count($rows) . ', $$pid' .  $pid. ', where' . $pObj->where . $condfeusergroup;exit;

			$subParts = array(
					'###SINGLE_COMMENT###' => $this->comments_getComments($rows,$conf,$pObj,$feuserid,$fromAjax,$pid),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
			);
		} else {
			$subParts = array(
					'###SINGLE_COMMENT###' => '',
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
			);
		}
		$externalbegin=substr($this->externalref,0,5);
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

		if (($conf['ratings.']['ratingsOnly'] !=0) || (($conf['ratings.']['ratingsOnly'] ==0) && ($conf['ratings.']['enableRatings'] !=0))){
			$articlerating = array();

			$articlerating = $this->getRatingDisplay($externalref, $conf, $fromAjax, $_SESSION['commentsPageId'], true, $feuserid , 'votearticle', $pObj,$_SESSION['commentListCount'],true);
			$articlerating['ilike'] = str_replace('\'like\',', '\'liketop\',',$articlerating['ilike'] );
			$articlerating['idislike'] = str_replace('\'unlike\',', '\'unliketop\',',$articlerating['idislike'] );
			$articlerating['ilike'] = str_replace('\'myratings\'', '\'myratingstop\'',$articlerating['ilike'] );
			$articlerating['idislike'] = str_replace('\'myratings\'', '\'myratingstop\'',$articlerating['idislike'] );
		}
		$shareHTML='';
		if ($conf['advanced.']['useSharing'] !=0){
			$sharelistfacebook = '';
			$sharelisttwitter = '';
			$sharelistgoogle = '';
			$sharelistlinkedin = '';
			$shareliststumbleupon = '';
			$sharehtmlfacebook = '';
			$sharehtmltwitter = '';
			$sharehtmlgoogle = '';
			$sharehtmllinkedin = '';
			$sharehtmlstumbleupon = '';
			$sharejsfacebook = '';
			$sharejstwitter = '';
			$sharejsgoogle = '';
			$sharejslinkedin = '';
			$sharejsstumbleupon = '';

			$sharelistfacebookputacomma = false;
			$sharelisttwitterputacomma = false;
			$sharelistgoogleputacomma = false;
			$sharelistlinkedinputacomma = false;
			$shareliststumbleuponputacomma = false;

			$hasValidSharingItems = 0;
			$fblang= $_SESSION['activelang'] . '_' . strtoupper($_SESSION['activelang']);
			$golang= $_SESSION['activelang'] ;
			$twlang= $_SESSION['activelang'] ;
			$fbminwidthcorr=0;
			$twminwidthcorr=0;
			if ($golang=='en') {
				$golang.= '-US';
				$fblang= $_SESSION['activelang'] . '_US';
			} else {

				$fblang= $golang . '_' . strtoupper($golang);
				$twlang =$golang;

				if ($golang==='de') {$fbminwidthcorr=30;$twminwidthcorr=12;}
				if ($golang==='fr') {$fbminwidthcorr=10;$twminwidthcorr=12;}
				if ($golang==='es') {$fbminwidthcorr=28;$twminwidthcorr=12;}
				if ($golang==='pt') {$fbminwidthcorr=12;$twminwidthcorr=12;}
				if ($golang==='pl') {$fbminwidthcorr=24;$twminwidthcorr=14;}
				if ($golang==='hu') {$fbminwidthcorr=14;}
				if ($golang==='it') {$fbminwidthcorr=20;}
				if ($golang==='dk') {$fbminwidthcorr=54;$fblang='da_DK';$twlang ='en';$golang='da-DK';}
				if ($golang==='gr') {$fbminwidthcorr=40;$fblang='el_GR';$twlang ='en';$golang='el-GR';}
				if ($golang==='ru') {$fbminwidthcorr=52;$twminwidthcorr=22;}
				if ($golang==='nl') {$fbminwidthcorr=34;$twlang ='en';}
				if ($golang==='he') {$fbminwidthcorr=18;$twminwidthcorr=24;$fblang='he_IL';$golang='he-IL';}
				if ($golang==='ar') {$fbminwidthcorr=20;$twminwidthcorr=10;}
			}

			if (intval($conf['advanced.']['useSharing']) ==1 ) {

				$accumulatedwidth=0;
				$leftpxfb=0;
				$leftpxtw=0;
				$leftpxgo=0;
				$leftpxli=0;
				$leftpxst=0;
				if (intval($conf['advanced.']['dontUseSharingFacebook']) !==1 ) {
					$sharehtmlfacebook='<a title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' facebook" rel="nofollow" href="javascript:void(0)" class="facebook">f</a>';
					$sharelistfacebook = 'facebook: true'; $hasValidSharingItems = $hasValidSharingItems+1; $sharelistfacebookputacomma = true;
					$sharejsfacebook = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREF###');
				// for design 2, buttons
					$sharebuttonfacebook = "facebook: {layout: 'box_count', lang: '".$fblang."'}";
					$leftpxfb=4;
					$accumulatedwidth +=50+$fbminwidthcorr;
				}
				if (intval($conf['advanced.']['dontUseSharingTwitter']) !==1 ) {
					$sharelisttwitter = 'twitter: true'; $hasValidSharingItems = $hasValidSharingItems+1;
					$sharebuttontwitter = "twitter: {count: 'vertical', lang: '".$twlang ."'}";
					//lang: 'en'
					$sharehtmltwitter='<a href="javascript:void(0)" rel="nofollow" title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' Twitter" class="twitter">t</a>';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;	$sharebuttonfacebook .= ',';
					}
					$sharelisttwitterputacomma = true;
					$sharejstwitter = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRRET###');
					$leftpxtw=4+$accumulatedwidth;
					$accumulatedwidth +=64+$twminwidthcorr;
				}
				if (intval($conf['advanced.']['dontUseSharingGoogle']) !==1 ) {
					$sharelistgoogle = 'googlePlus: true';
					$sharebuttongoogle = "googlePlus: {size: 'tall', lang: '".$golang."'}";
					$sharehtmlgoogle='<a title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' Google+" rel="nofollow" href="javascript:void(0)" class="googleplus">+1</a>';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;	$sharebuttonfacebook .= ',';
					}
					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ','; $sharelisttwitterputacomma = false;	$sharebuttontwitter .= ',';
					}
					$sharelistgoogleputacomma = true;$hasValidSharingItems = $hasValidSharingItems+1;
					$sharejsgoogle = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREG###');
					$leftpxgo=4+$accumulatedwidth;
					$accumulatedwidth +=55;
				}
				if (intval($conf['advanced.']['dontUseSharingLinkedIn']) !==1 ) {
					$sharelistlinkedin = 'linkedin: true';
					$sharebuttonlinkedin="linkedin: {counter: 'top'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;	$sharebuttonfacebook .= ',';
					}
					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ','; $sharelisttwitterputacomma = false;	$sharebuttontwitter .= ',';
					}
					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ','; $sharelistgoogleputacomma = false; $sharebuttongoogle .= ',';
					}
					$sharelistlinkedinputacomma = true;$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmllinkedin='<a href="javascript:void(0)" rel="nofollow" title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' LinkedIn" class="linkedin">L</a>';
					$sharejslinkedin = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREL###');
					$leftpxli=4+$accumulatedwidth;
					$accumulatedwidth +=69;
				}
				if (intval($conf['advanced.']['dontUseSharingStumbleupon']) !==1 ) {
					$shareliststumbleupon = 'stumbleupon: true';
					$sharebuttonstumbleupon = "stumbleupon: {layout: '5'}";
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;	$sharebuttonfacebook .= ',';
					}
					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ','; $sharebuttontwitter .= ',';
					}
					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ','; $sharebuttongoogle .= ',';
					}
					if ($sharelistlinkedinputacomma) {
						$sharelistlinkedin .= ','; $sharebuttonlinkedin .= ',';
					}
					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmlstumbleupon='<a href="javascript:void(0)" rel="nofollow" title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' Stumbleupon" class="stumbleupon">S</a>';
					$sharejsstumbleupon = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRRED###');
					$leftpxst=4+$accumulatedwidth;
					$accumulatedwidth +=54;
				}

				$buttonscountwidth= 4 + $accumulatedwidth;
				$sharingtext= $this->pi_getLLWrap($pObj, 'text_share', $fromAjax);
				$sharingtitle= $this->pi_getLLWrap($pObj, 'text_share_this_page', $fromAjax);
				if (intval($conf['advanced.']['useSharingDesign']) ===0 ) {
					$templatesharrre = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRRE###');
				} else{
					$templatesharrre = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREDESIGN2###');
				}
				$markerssharre= array(
						'###ARTICLESHAREURL###'=> $this->getPageURL($fromAjax,$pid),
						'###CID###' => $_SESSION['commentListCount'],
						'###ARTICLESHARE###' => $sharingtext,
						'###BUTTONSCOUNTWIDTH###' => $buttonscountwidth,
						'###BUTTONFBLEFT###' => $leftpxfb,
						'###BUTTONTWLEFT###' => $leftpxtw,
						'###BUTTONGOLEFT###' => $leftpxgo,
						'###BUTTONINLEFT###' => $leftpxli,
						'###BUTTONSTLEFT###' => $leftpxst,
						'###SHRBRDR_ADADAD###' => $conf['theme.']['shareborderColor1'],
						'###SHRBRDR_A2A2A2###' => $conf['theme.']['shareborderColor2'],
						'###SHRCNTBRDR_CCCCCC###' => $conf['theme.']['shareCountborderColor'],
						'###SHRBOXSHADOW_DDD###' => $conf['theme.']['borderColor'],
						'###SHRBG_E6E6E6###' => $conf['theme.']['shareBackgroundColor'],
						'###ARTICLESHARETITLE###' => $this->pi_getLLWrap($pObj, 'text_share_title', $fromAjax),
						'###ARTICLESHAREDATATEXT###' => $this->pi_getLLWrap($pObj, 'text_share_datatext', $fromAjax) . ' ' . $this->getPageURL($fromAjax,$pid),
						'###ARTICLESHAREDATATITLE###' => $sharingtitle,
						'###SHARELIST_FACEBOOK###' => $sharelistfacebook,
						'###SHARELIST_TWITTER###' => $sharelisttwitter,
						'###SHARELIST_GOOGLE###' => $sharelistgoogle,
						'###SHARELIST_LINKEDIN###' => $sharelistlinkedin,
						'###SHARELIST_STUMBLEUPON###' => $shareliststumbleupon,
						'###SHAREHTML_FACEBOOK###' => $sharehtmlfacebook,
						'###SHAREHTML_TWITTER###' => $sharehtmltwitter,
						'###SHAREHTML_GOOGLE###' => $sharehtmlgoogle,
						'###SHAREHTML_LINKEDIN###' => $sharehtmllinkedin,
						'###SHAREHTML_STUMBLEUPON###' => $sharehtmlstumbleupon,
						'###JSSHARRRED###' => $sharejsstumbleupon,
						'###JSSHARRREF###' => $sharejsfacebook,
						'###JSSHARRREG###' => $sharejsgoogle,
						'###JSSHARRREL###' => $sharejslinkedin,
						'###JSSHARRRET###' => $sharejstwitter,
						'###SHAREBUTTON_FACEBOOK###' => $sharebuttonfacebook,
						'###SHAREBUTTON_TWITTER###' => $sharebuttontwitter,
						'###SHAREBUTTON_GOOGLE###' => $sharebuttongoogle,
						'###SHAREBUTTON_LINKEDIN###' => $sharebuttonlinkedin,
						'###SHAREBUTTON_STUMBLEUPON###' => $sharebuttonstumbleupon,
				);
				if ($templatesharrre && ($hasValidSharingItems>0)) {
					$shareHTML=$pObj->cObj->substituteMarkerArray($templatesharrre, $markerssharre);
				}
			}
		}
		$ilikedislikeHTML='';
		if ($conf['ratings.']['enableRatings'] ==1) {
			if (intval($conf['ratings.']['useLikeDislike']) ===1 ) {
				if ((intval($conf['ratings.']['useDislike']) ===1 ) && ($articlerating['idislike']!='')) {
					$ilikedislikeHTML=$articlerating['ilike'] .  $articlerating['idislike'] ;

					if (($articlerating['mydislikehtml'] !='') || ($conf['ratings.']['useVotes']==1) || ($conf['advanced.']['useSharing']==1) || (($conf['advanced.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0))){
						$ilikedislikeHTML .= '&nbsp;&middot;&nbsp;&nbsp;';
					}
				} else {
					$ilikedislikeHTML=$articlerating['ilike'];
					if ($articlerating['ilike']!='') {
						if (intval($conf['ratings.']['useDislike']) ===0 ) {
							if (($articlerating['mylikehtml'] !='') || ($conf['ratings.']['useVotes']==1) || ($conf['advanced.']['useSharing']==1)|| (($conf['advanced.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0))) {

							$ilikedislikeHTML.= '&nbsp;&middot;&nbsp;&nbsp;';
							}
						}
					}
				}
			}
		}
		$myvoteHTML='';
		if (intval($conf['ratings.']['useMyVote']) ===1 ) {
				$myvoteHTML=$articlerating['myvote'] . '&nbsp;&middot;&nbsp;';
		}
		$tmpcid=$_SESSION['commentListCount'];
		$templatecommenttop = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENTLINKTOP###');
		$commenttopHTML='';

		if (($conf['ratings.']['ratingsOnly'] ==0) && ($conf['code'] != 'COMMENTS') && ($conf['ratings.']['mode'] != 'static')) {
			$loggedin = 0;
			if ($feuserid > 0) {
				$loggedin = 1;
			}
			$beginstring= '';
			if (intval($conf['ratings.']['useLikeDislike']) ===0 ) {
				$beginstring = '&nbsp;';
			}
			$markerstopHTML = array(
					'###ARTICLESHAREURL###'=> $this->getPageURL($fromAjax,$pid),
					'###BEGINSTRING###' => $beginstring,
					'###LOGGEDIN###'=> $loggedin,
					'###UID###' => $pObj->externalUid,
					'###CID###' => $_SESSION['commentListCount'],
					'###TEXT_ADD_COMMENTTOP###' => $this->pi_getLLWrap($pObj, 'pi1_template.add_comment_top', $fromAjax),
					'###TEXT_ADD_COMMENTTITLE###' => $this->pi_getLLWrap($pObj, 'pi1_template.add_comment_title', $fromAjax),
			);
			$commenttopHTML=$pObj->cObj->substituteMarkerArray($templatecommenttop, $markerstopHTML);

		}
		if (($commenttopHTML!='') && ($shareHTML!='')) {
			$commenttopHTML=str_replace('</a>', '</a>&nbsp;&middot;&nbsp;', $commenttopHTML);
			$commenttopHTML=str_replace('></a>&nbsp;&middot;&nbsp;','></a>', $commenttopHTML);
		}
		$hidecss ='';
		//if (($conf['ratings.']['ratingsOnly'] ==1)) {
			//$hidecss ='-hide';
		//}

		$staticaddonHTML='';
		if ($conf['ratings.']['mode'] == 'static' ) {
			$staticaddonHTML ='-static';
		}
		$attachmentHTML='';
		$attachmentHTMLhide='';
		if (intval($conf['attachments.']['useWebpagePreview']) ===1 ) {
			if (intval($conf['attachments.']['useTopWebpagePreview']) > 0) {
				$attachmentHTML= $this->commentShowWebpagepreview (intval($conf['attachments.']['useTopWebpagePreview']),intval($conf['attachments.']['topWebpagePreviewPicture']),$conf,$pObj,$_SESSION['commentListCount'],true,$fromAjax);
				if ((intval($conf['advanced.']['useSharing']) == 0) && (intval($conf['ratings.']['enableRatings']) == 0) && (intval($conf['ratings.']['ratingsOnly']) == 1)) {
					$attachmentHTMLhide='style="display:none;"';
				}
			}
		}
		$replyoncommentHTML='';
		if (intval($conf['advanced.']['userCommentResponseLevels']) >0) {
			$replyoncommentHTML.= '<a id="comment-ry-' . $_SESSION['commentListCount'] . '" name="comment-ry-' . $_SESSION['commentListCount'] . '"></a><div class="tx-tc-ct-ry-frameover" style="display:none;opacity:0;filter: alpha(opacity=0); " id="tx-tc-ct-ry-frame-' . $_SESSION['commentListCount'] . '" >';

			$replyoncommentHTML.= '<div onclick="toctoc_coc_close(' . $_SESSION['commentListCount'] . ');" id="tx-tc-cts-cocfuncs-' . $_SESSION['commentListCount'] . '"  class="tx-tc-cocfuncs" style="display:none;" >';
			$replyoncommentHTML.= '<img id="tx-tc-cts-nococ-' . $_SESSION['commentListCount'] . '" src="' . '/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/nopreviewpic.png" height="11" width="12" title="'.$this->pi_getLLWrap($pObj, 'pi1_template.closereply', $fromAjax).'" class="tx-tc-coc" style="display:none;" >';
			$replyoncommentHTML.= '</div>';



			$replyoncommentHTML.= '<div class="tx-tc-ct-rybox-title" style="display:none;" id="tx-tc-ct-rybox-title-' . $_SESSION['commentListCount'] . '" >';
			$replyoncommentHTML.= $this->pi_getLLWrap($pObj, 'pi1_template.entercommentoncomment', $fromAjax) . '</div>';
			$replyoncommentHTML.= '<div class="tx-tc-ct-rybox" style="display:none;" id="tx-tc-ct-rybox-' . $_SESSION['commentListCount'] . '" >';
			$replyoncommentHTML.= '</div>';
			$replyoncommentHTML.= '</div>';

			$replyoncommenttopHTML= '';
			if (substr($conf['code'],0,4) == 'FORM'){
				$replyoncommenttopHTML=$replyoncommentHTML;
				$replyoncommentHTML= '';
			}
		}
		$topareaHTML='';
		$templatetoparea = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBTOPAREA###');
		$markerstoparea = array(
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
				'###ARTICLESHARE###' => $shareHTML,
				'###TOPATTACHMENT###' => $attachmentHTML,
				'###TOPATTACHMENTSTYLEHIDE###' => $attachmentHTMLhide,
				'###REPLYONCOMMENT###'=> $replyoncommentHTML,
				'###REPLYONCOMMENTTOP###'=> $replyoncommenttopHTML,
				'###COMMENTSCOUNT###' => $totalcommentscount,
		);
		$topareaHTML=$pObj->cObj->substituteMarkerArray($templatetoparea, $markerstoparea);
		if (substr($conf['code'],0,4) == 'FORM'){
			$topareaHTMLfc='';
			$templatetopareafc = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBTOPAREAFP###');
			$markerstopareafc = array(
					'###TOPAREA###' => $topareaHTML,
					'###REFCSS###' => $externalref,
			);
			$topareafcHTML=$pObj->cObj->substituteMarkerArray($templatetopareafc, $markerstopareafc);

			$this->topareaHTML=$topareafcHTML;
			$topareaHTML='';
			if ($conf['ratings.']['ratingsOnly'] ==0) {
				$borderclass= ' txtc_topborder';
			}
		} else {
			$borderclass='';
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
				'###COMMENTSCOUNT###' => $totalcommentscount,
				'###SUBTEMPLATE_TOPAREA###' => $topareaHTML,
				'###TOPBORDERCLASS###' => $borderclass,
		);
		// Fetch template
		if (!$fromAjax) {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_LIST###');
		} else {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_LISTAJAX###');
		}

		// $this->ajaxHeader for FORM, COMMENTS view
		if (!$fromAjax) {
			if ($this->ajaxHeader=='') {
				$templateajaxHeader = $pObj->cObj->getSubpart($pObj->templateCode, '###AJAXHEADER###');
				$markersajaxHeader = array(
						'###CID###' => $_SESSION['commentListCount'],
						'###UID###' => $pObj->externalUid,
						'###AJAX_DATA###' => 	$this->getAjaxJSData($feuserid,$GLOBALS['TSFE']->id,$GLOBALS['TSFE']->lang,$conf,$pObj, $tmpcid,$fromAjax),
						'###AJAX_COMMENTSDATA###' => $this->getAjaxJSDataComments($tmpcid,$pObj,$fromAjax),
						'###AJAX_COMMENTSIMGS###' => $this->getAjaxJSDataCommentImgs($tmpcid,$pObj,$fromAjax),
				);
				$this->ajaxHeader=$pObj->cObj->substituteMarkerArray($templateajaxHeader, $markersajaxHeader);
			}
		}

		// comments browser
		if (($conf['ratings.']['ratingsOnly'] ==0)) {
			$pagebrowserHTML = $this->comments_getCommentsBrowser($rpp,$hasolderrows,$commentscounter,$pObj,$fromAjax, $conf);

			$pagebrowsertopHTML= '';
			if (substr($conf['code'],0,4) == 'FORM'){
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

		/* Call hook for custom markers */
		 if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments'] as $userFunc) {
				$params = array(
						'pObj' => &$pObj,
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
		return $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
	}

	/**
	 * Generates list of comments
	 *
	 * @param	array		$rows	Rows from tx_toctoc_comments_comments
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	object		$pObjCobj: Cobj of the parent object
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @param	[type]		$pid: ...
	 * @return	string		Generated HTML
	 */
	public function comments_getComments(&$rows,$conf,$pObj,$feuserid,$fromAjax,$pid) {
		global $TSFE;

		if (count($rows) == 0) {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###NO_COMMENTS###');
			if ($template) {
				return $pObj->cObj->substituteMarker($template, '###TEXT_NO_COMMENTS###', $this->pi_getLLWrap($pObj, 'text_no_comments',$fromAjax));
			}
		}
		$entries = array(); $alt = 1;
		$template = $pObj->cObj->getSubpart($pObj->templateCode, '###SINGLE_COMMENT###');


		$currpageid= $TSFE->id;
		$currcontentelementid = $_SESSION['commentListCount'];


		foreach ($rows as $row) {
			$iuid= $row['uid'] ;
			$check = md5($row['uid'] . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);

			$strdivactionbuttons = '<div  class="tx-tc-ct-actionforms">';
			$strdivactionbuttonsend ='</div>';
			if (($row['toctoc_commentsfeuser_feuser'] == intval($feuserid)) && (intval($feuserid) !==0)){

				$tmpcid=$_SESSION['commentListCount'];
				$submithtml='';
				$ref='tx-tc-cts_' . $iuid;
				$refshow='tt_content_' . $_SESSION['commentListCount'];
				$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###DELETE_COMMENT_LINK_SUB###');
				$externalbegin=substr($this->externalref,0,5);
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
				$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
						'###VALUE###' => '1',
						'###REF###' => $ref,
						'###PID###' => $pid,
						'###CID###' => $tmpcid,
						'###UID###' => $iuid,
						'###CHECK###' => $check,
						'###PCID###' => $row['parentuid'],
						'###REFSHOW###' => $refshow,
						'###EXTREF###'=> $externalref,
				));
				$submithtml=$submithtmlSub;
				if ($row['children'] == ''){
					$deletelinkout='<form  class="tx-tc-ct-deleteform" id="df' . $iuid . '" action="';
					$deletelinkout.= '" method="post">';
					$deletelinkout .= '	<input type="button" class="tx-tc-ct-deletebutton" style="background: url(';
					$deletelinkout .= '\'/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/deletecommentfe.png';

					$deletelinkout .= $imgFile;
					$deletelinkout .= "'";
					$deletelinkout .= ') no-repeat top left;" name="toctoc_comments_pi1[submit]" ';
					$deletelinkout .= ' onclick="' . $submithtml . ';" ';
					$deletelinkout .= ' id="toctoc_comments_pi1_submit_uid' . $iuid . '" value="" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.deletelink', $fromAjax) . '" />';
					$deletelinkout .= '<input type="hidden" value="1" name="typo3_user_int"></form>';
				} else{
					$deletelinkout='';
				}

				$submithtml='';
				$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###EDIT_COMMENT_LINK_SUB###');

				$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
						'###UID###' => $iuid,
						'###PID###' => $pid,
						'###ONOFF###' => 1,
						'###CID###' => $_SESSION['commentListCount'],
				));
				$submithtml=$submithtmlSub;

				$editlinkout='';
				$userarr=explode(',',$this->userrows);
				$userarr=array_flip($userarr);
				if (array_key_exists($row['uid'], $userarr)) {
					$editlinkout='<form  class="tx-tc-ct-editform" id="edf' . $iuid . '" action="';
					$editlinkout.= '" method="post">';
					$editlinkout .= '	<input type="button" class="tx-tc-ct-editbutton" style="background: url(';
					$editlinkout .= '\'/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/editcommentfe.png';
					$editlinkout .= $imgFile;
					$editlinkout .= "'";
					$editlinkout .= ') no-repeat top left;" name="toctoc_comments_pi1[submitedit]" ';
					$editlinkout .= ' onclick="' . $submithtml . ';" ';
					$editlinkout .= ' id="toctoc_comments_pi1_submitedit_uid' . $iuid . '" value="" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.editlink', $fromAjax) . '" />';
					$editlinkout .= '<input type="hidden" value="1" name="typo3_user_int"></form>';
				}
			}else {
				$deletelinkout='';
				$editlinkout='';
			}

			// disable notify
			$strCurrentIP = $this->getCurrentIp();
			$denotifylinkout='';
			if ((($row['toctoc_commentsfeuser_feuser'] == intval($feuserid)) && (intval($feuserid) !==0)) || (($row['remote_addr'] ==  $strCurrentIP) && ($row['toctoc_commentsfeuser_feuser'] == intval($feuserid)))){

				if ($row['tx_commentsnotify_notify']==1) {
					if (($conf['advanced.']['commentatorNotifybyIP'] == 1) ||((intval($feuserid)!==0) && ($conf['advanced.']['commentatorNotifybyIP'] == 0))) {

						$tmpcid=$_SESSION['commentListCount'];
						$submithtml='';
						$ref='tx_toctoc_comments_comments_' . $iuid;
						$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###DENOTIFY_COMMENT_LINK_SUB###');

						$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
								'###VALUE###' => '1',
								'###REF###' => $ref,
								'###PID###' => $pid,
								'###CID###' => $tmpcid,
								'###UID###' => $iuid,
								'###CHECK###' => $check,
						));
						$submithtml=$submithtmlSub;

						$denotifylinkout.='<form  class="tx-tc-ct-denotifyform" id="dnf' . $iuid . '" action="';
						$denotifylinkout.= '" method="post">';
						$denotifylinkout .= '	<input type="button" class="tx-tc-ct-denotifybutton" style="background: url(';
						//$denotifylinkout .= "'../../../";
						$denotifylinkout .= '\'/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/denotifycommentfe.png';

						$denotifylinkout .= "'";
						$denotifylinkout .= ') no-repeat top left;" name="toctoc_comments_pi1[submit]" ';
						$denotifylinkout .= ' onclick="' . $submithtml . ';" ';
						$denotifylinkout .= ' id="toctoc_comments_pi1_submit_uid' . $iuid . '" value="" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.denotifylink', $fromAjax) . '" />';
						$denotifylinkout .= '<input type="hidden" value="1" name="typo3_user_int"></form>';
					}
				}
			}
			$actionst= $deletelinkout . $editlinkout;
			if ($denotifylinkout ==''){
				if ($actionst !=''){
					$deletelinkout = $strdivactionbuttons . $deletelinkout;
					$editlinkout=$editlinkout.$strdivactionbuttonsend;
				}
			} else {
				if ($actionst ==''){
					$denotifylinkout = $strdivactionbuttons . $denotifylinkout . $strdivactionbuttonsend;
				} else  {
					$denotifylinkout = $strdivactionbuttons . $denotifylinkout;
					$editlinkout=$editlinkout.$strdivactionbuttonsend;
				}
			}

			$row['content']=htmlspecialchars($row['content']);
			if (strlen($row['content'])>$conf['commentCropLength']){
				$textcroppedleft = substr($row['content'],0,$conf['commentCropLength']);
				$textcroppedright = substr($row['content'],$conf['commentCropLength']);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {
					$showrestofcomment=$this->pi_getLLWrap($pObj, 'pi1_template.clicktoshowtherest', $fromAjax);
					$showrestofcommenttext=$this->pi_getLLWrap($pObj, 'pi1_template.showmore', $fromAjax);
					$textcroppedleft .=$textcroppedrightarr[0] . ' <span style="display: inline;" id="tx-tc-acropped-' . $row['uid'] . '"><br /><a rel="nofollow" href="javascript:tcsroc(' . $row['uid'] . ');" title="' . $showrestofcomment . '">' . $showrestofcommenttext . '</a></span><span id="tx-tc-cropped-' . $row['uid'] . '" style="display: none;">' . substr($textcroppedright,strlen($textcroppedrightarr[0])) . '</span>';
					$row['content'] =$textcroppedleft;
				}
			}

			//Parse for Links and Smilies and BB-codes
			$text = $this->applyStdWrap(nl2br($this->createLinks($row['content'], $conf)), 'content_stdWrap', $conf, $pObj);
			$text = $this->replaceSmilies($text, $conf);
			$text =$this->replaceBBs($text, $conf,false);


			$commentcontinuation='';
			if (intval($conf['ratings.']['enableRatings']) ===1 ) {
				$commentcontinuation='&nbsp;&middot;&nbsp;';
			}

			if (intval($conf['ratings.']['enableRatings']) ===1 ) {
				$commentcontinuation='&nbsp;&middot;&nbsp;';
			}
			$attachmentHTML='';
			if ((intval($conf['attachments.']['useWebpagePreview']) ==1) || (intval($conf['attachments.']['usePicUpload']) ==1 )|| (intval($conf['attachments.']['usePdfUpload']) ==1 )){
				if ($row['attachment_id']> 0) {
					$attachmentHTML= $this->commentShowWebpagepreview ($row['attachment_id'],$row['attachment_subid'],$conf,$pObj,$iuid, false,$fromAjax,$row);
				}
			}

			$expandcommentsHTML='';
			$subcommentreply='';

			$replyreportLineHTML1='';
			$replyreportLineHTML2='';
			if (($conf['advanced.']['userCommentResponseLevels'] != 0) && ($this->isCommentingClosed($conf,$pObj) == 0) && ($row['level']<$conf['advanced.']['userCommentResponseLevels'])) {
				if (trim($conf['code'])!='COMMENTS') {
					$subcomment=$this->pi_getLLWrap($pObj, 'pi1_template.replytocomment', $fromAjax);
					$subcommentlink='';
					$subcommentlink.='<span id="tx-tc-ct-div-ry-' . $row['uid'] . '"><a rel="nofollow" href="javascript:commentreply(' . $row['uid'] . ', previewselcomment' . $_SESSION['commentListCount'] . ', ' . $_SESSION['commentListCount'] . ');" title="' .$subcomment . '">' . $subcomment .'</a>'.'</span>';
				}
				if (trim($conf['code'])!='COMMENTS') {
					$replyreportLineHTML1='<div class="tx-tc-ct-ry-report-line" id="tx-tc-ct-ry-rl-' . $row['uid'] .  '">';
					$replyreportLineHTML2='<div>&nbsp;</div></div>';

					if ($conf['commentsreport.']['active']) {
						$subcomment= '|  ' . $subcommentlink;

					} else {
						$subcomment= $subcommentlink;
					}
				} else {
					$subcomment= '';
				}
				$subcommentreply.= '<div class="tx-tc-ct-ry">';
				$subcommentreply.= $subcomment.'</div>';
				if (($conf['code']=='COMMENTS') && ($conf['commentsreport.']['active']==0)) {
					$subcommentreply= '';
				}

				if ($row['children'] != '') {
					for ($i=0;$i<2;$i++) {
							if ($i==0) {
								$userconfimgFile='tcexpand';
								$opa='cursor:pointer; margin: 6px 0 0 4px; ';
								if (!$this->getCommentBoxChildrenDisplayIsCollapsed($row['children'],$conf,$row['level'],$fromAjax)) {
									$opa.='display:none;';
								} else {
									$opa.='display:block;';
								}

								$alttext= $this->pi_getLLWrap($pObj, 'pi1_template.expand', $fromAjax);
								$onclick= ' onclick="javascript:tctrvw (0, ' . $row['uid'] . ', \'' . $row['children'] . '\', \'' . $row['allchildren'] . '\')"';

							} else {
								$userconfimgFile='tccollapse';
								$opa='cursor:pointer; margin: 6px 0 0 4px; ';
								if ($this->getCommentBoxChildrenDisplayIsCollapsed($row['children'],$conf,$row['level'],$fromAjax)) {
									$opa.='display:none;';
								} else {
									$opa.='display:block;';
								}
								$alttext= $this->pi_getLLWrap($pObj, 'pi1_template.collapse', $fromAjax);
								$onclick= ' onclick="javascript:tctrvw (1, ' . $row['uid'] . ', \'' . $row['children'] . '\', \'' . $row['allchildren'] . '\')"';
															}
							$tmpimgstr='';
							$userimgFile='/typo3conf/ext/toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/'. $userconfimgFile . '.png';
							$expandcommentsHTML .= '<img src="' . $userimgFile . '" ' . 'style="' . $opa .
													'" title="' . $alttext . '" '. $onclick .
													' id="tx-tc-cts-img-exp-' . $i . '-' . $row['uid'] . '">'  ;

					}
				}
			}
			if (($conf['commentsreport.']['active']) || (($conf['advanced.']['userCommentResponseLevels'] != 0) && ($this->isCommentingClosed($conf,$pObj) == 0) && ($row['level']==$conf['advanced.']['userCommentResponseLevels']))) {
				if (($conf['code']!='COMMENTS') || ($conf['commentsreport.']['active']!=0)) {
					$replyreportLineHTML1='<div class="tx-tc-ct-ry-report-line" id="tx-tc-ct-ry-rl-' . $row['uid'] .  '">';
					$replyreportLineHTML2='<div>&nbsp;</div></div>';
				}
			}
			$stylesubcommentHTML='';
			$displaycss=$this->getCommentBoxDisplay($iuid,$conf,$row['level'],$fromAjax);
			if (($row['level']>0) || ($displaycss !=''))  {
				$stylesubcommentHTML = 'style="';
				if ($row['level']>0)  {
					$shiftleft=$row['level']*22;
					$stylesubcommentHTML .= 'margin: 0 0 0 ' . $shiftleft . 'px; border-left:#' . $conf['theme.']['borderColor'] . ' 1px solid;border-radius: 10px 4px 0 0 ;';
				}
				if ($displaycss !='')  {
					$stylesubcommentHTML .= $displaycss;
				}
				$stylesubcommentHTML .= '" ';
			}
			$commentDateNoRatings='';
			if ($conf['ratings.']['enableRatings'] != 1) {
				$templatecommentDateNoRatings = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENTDATE_NORATINGS###');
				$commentDateNoRatings =  $pObj->cObj->substituteMarkerArray($templatecommentDateNoRatings, array(
						'###COMMENT_DATE###' => $this->formatDate($row['crdate'], $pObj, $fromAjax, $conf) .$commentcontinuation,
						'###REF###' => $iuid,
				));
			}

			$text = str_replace('"> <a','">&nbsp;<a',$text);

			//namepart handling
			$firstname = $this->applyStdWrap(htmlspecialchars($row['firstname']), 'firstName_stdWrap', $conf, $pObj);
			$lastname = $this->applyStdWrap(htmlspecialchars($row['lastname']), 'lastName_stdWrap', $conf, $pObj);

			$namepart = '<b>' . trim($firstname . ' ' . $lastname)  . '</b> - ';

			if ((intval($conf['advanced.']['wallExtension']) > 0) && (intval($conf['advanced.']['wallExtension']) <3)) {
				//communities: link all user names to their profiles on a wall
				if ($_SESSION['communityprofilepageparams']=='') {
					$communityprofilepage = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepage']);
				} else {
					$linknameparm = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepageparams']);
					$communityprofilepage = str_replace('" rel', $linknameparm . '" rel', $_SESSION['communityprofilepage']);

				}
				$linknamepart = str_replace('dummy', trim($firstname . ' ' . $lastname), $communityprofilepage);
				$namepart = '<b>' . $linknamepart  . '</b>';


			} elseif  ((intval($conf['advanced.']['wallExtension']) == 0) && ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users')) {
				//link if feuserid not current user
				$namepart = '<b>' . trim($firstname . ' ' . $lastname)  . '</b>';
				$triggereduseridarr= explode('_',$_SESSION['commentListRecord']);
				$triggereduserid = $triggereduseridarr[count($triggereduseridarr)-1];
				if ($triggereduserid != $row['toctoc_commentsfeuser_feuser']) {

					if ($_SESSION['communityprofilepageparams']=='') {
						$communityprofilepage = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepage']);
					} else {
						$linknameparm = str_replace('9999999', $row['toctoc_commentsfeuser_feuser'], $_SESSION['communityprofilepageparams']);
						$communityprofilepage = str_replace('" rel', $linknameparm . '" rel', $_SESSION['communityprofilepage']);

					}
					$linknamepart = str_replace('dummy', trim($firstname . ' ' . $lastname), $communityprofilepage);
					$namepart = '<b>' . $linknamepart  . '</b>';
				}
			}

			if (($conf['advanced.']['wallExtension'] != 0) || ($conf['prefixToTableMap.'][$conf['externalPrefix']] == 'fe_users')) {
				// get the user who was triggerd
				$triggereduseridarr= explode('_',$row['external_ref']);
				$triggereduserid = $triggereduseridarr[count($triggereduseridarr)-1];
				IF ($triggereduserid != $feuserid) {
					if ($conf['advanced.']['wallExtension'] != 0) {
						$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
								'uid=' . $triggereduserid );

						$lastname2='';
						$firstname2='';
						if (count($rowsfeuser)>0) {
							if (array_key_exists('last_name',$rowsfeuser[0])) {
								$lastname2=$rowsfeuser[0]['last_name'];
							}
							if (array_key_exists('first_name',$rowsfeuser[0])) {
								$firstname2=$rowsfeuser[0]['first_name'];
							}
							if (trim($firstname2 . ' ' . $lastname2)=='') {
								if (array_key_exists('name',$rowsfeuser[0])) {
									$lastname2=$rowsfeuser[0]['name'];
								}
							}
						}
						if (trim($firstname . ' ' . $lastname)!=trim($firstname2 . ' ' . $lastname2)) {
							if ($_SESSION['communityprofilepageparams']=='') {
								$communityprofilepage = str_replace('9999999', $triggereduserid, $_SESSION['communityprofilepage']);
							} else {
								$linknameparm = str_replace('9999999', $triggereduserid, $_SESSION['communityprofilepageparams']);
								$communityprofilepage = str_replace('" rel', $linknameparm . '" rel', $_SESSION['communityprofilepage']);

							}
							$linknamepart = str_replace('dummy', trim($firstname2 . ' ' . $lastname2), $communityprofilepage);
							$namepart = $namepart . ' '.$this->pi_getLLWrap($pObj, 'pi1_template.via', $fromAjax).' <b>' . $linknamepart  . '</b> - ';
						} else {
							$namepart .= ' - ';
						}
					} else {
						//on profile page
						$namepart .= ' - ';
					}

				} else {
						//on profile page
						$namepart .= ' - ';
					}
			}

			$markerArray = array(
					'###ALTERNATE###' => '-' . ($alt + 1),
					'###FIRSTNAME###' => $firstname,
					'###LASTNAME###' => $lastname,
					'###NAMEPART###' => $namepart,
					'###IMAGE###' => '',
					'###IMAGETAG###' => $this->applyStdWrap($row['imagetag'], 'image_stdWrap', $conf, $pObj),
					'###EMAIL###' => $this->applyStdWrap($this->comments_getComments_getEmail($row['email']), 'email_stdWrap', $conf, $pObj),
					'###LOCATION###' => $this->applyStdWrap(htmlspecialchars($row['location']), 'location_stdWrap', $conf, $pObj),
					'###HOMEPAGE###' => $this->applyStdWrap(htmlspecialchars($row['homepage']), 'webSite_stdWrap', $conf, $pObj),
					'###COMMENT_DATE###' => $this->formatDate($row['crdate'], $pObj, $fromAjax, $conf) .$commentcontinuation,
					'###COMMENTDATENORATINGS###' => $commentDateNoRatings,
					'###COMMENT_CONTENT###' => $text,
					'###COMMENT_ID###' => $iuid,
					'###CID###' => $_SESSION['commentListCount'],
					'###TOCTOCUID###' => base64_encode($row['toctoc_comments_user']),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###RATINGS###' => $this->comments_getComments_getRatings($row,$conf,$pObj,$feuserid, $fromAjax),
					'###DENOTIFY_LINK###' => $denotifylinkout,
					'###EDIT_LINK###' => $editlinkout,
					'###DELETE_LINK###' => $deletelinkout,
					'###DELETE_LINK_TEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.deletelink', $fromAjax),
					'###DELETE_COMMENT_IMAGE###' => htmlspecialchars($conf['DeleteCommentImage']),
					'###KILL_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $iuid . '&chk=' . $check . '&cmd=kill'),
					'###TEXT_ADD_COMMENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax),
					'###COMMENT_RESPONSE###' => '',
					'###ATTACHMENT###' => $attachmentHTML,
					'###EXPANDCOMMENTS###' => $expandcommentsHTML,
					'###TX_COMMENTSREPLY###' => $subcommentreply,
					'###STYLECOMMENTBOX###' => $stylesubcommentHTML,
					'###LINE_COMMENTSREPORTREPLYSTART###' => $replyreportLineHTML1,
					'###LINE_COMMENTSREPORTREPLYEND###' => $replyreportLineHTML2,
					'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),

				);


			//fe_user-integration
			$params = array(
					'template' => $template,
					'markers' => $markerArray,
					'row' => $row,
			);
			$tempMarkers = $this->comments_getComments_fe_user($params, $conf,$pObj,$iuid,$fromAjax);
			if (is_array($tempMarkers)) {
				$markerArray = $tempMarkers;
			}


			$uclink='';
			$timeout= intval($conf['timeoutUC']);
			if ($timeout < 3) {
				$timeout=3;
			} elseif ($timeout > 15) {
				$timeout=15;
			}
			$timeout= 1000*$timeout;
			$templateuclink = $pObj->cObj->getSubpart($pObj->templateCode, '###SHOWUCLINK_SUB###');
			$uclink =  $pObj->cObj->substituteMarkerArray($templateuclink, array(
					'###COMMENT_ID###' => $iuid,
					'###CID###' => $_SESSION['commentListCount'],
					'###TOCTOCUID###' => base64_encode($row['toctoc_comments_user']),
					'###IMGBENC###' => base64_encode($markerArray['###IMAGE###']),
					'###TIMEOUTMS###' => $timeout,
			));


			$markerArray['###SHOWUCLINK###']= $uclink;
			// Call hook for custom markers
			$pObj->conf =$conf;
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments_getComments'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments_getComments'] as $userFunc) {
					$params = array(
							'pObj' => &$pObj,
							'template' => $template,
							'markers' => $markerArray,
							'row' => $row,
					);

						if ((!$userFunc['comments_response']) && (!$userFunc['comments_report'])) {
							if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
								$markerArray = $tempMarkers;
							}
						} else {
							if (is_array($tempMarkers = $this->getCommentsReponse($params, $pObj, $conf))) {
								$markerArray = $tempMarkers;
							}
						}

				}
			}
			//comments_response
			$commentresponse_start='';
			$commentresponse_end='';
			if ((intval($conf['advanced.']['adminCommentResponse']) ===1) || ($markerArray['###COMMENT_RESPONSE###'] !='')) {
				if (t3lib_extMgm::isLoaded('comments_response')) {
					if (trim($markerArray['###COMMENT_RESPONSE###']) !='') {
						$markers['###RESPOND_LINK###'] = $this->pi_getLLWrap($pObj, 'email.textresponsetothecomment', $fromAjax) . $markers['###RESPOND_LINK###'];
						$commentresponse_start='<p class="tx-tcresponse-text"><span class="tx-tcresponse-text-title">' . $this->pi_getLLWrap($pObj, 'pi1_template.admincommenttitle', $fromAjax) . '</span>';
						$commentresponse_end='</p>';
					}
				}
			}
			$markerArray['###COMMENT_RESPONSE_START###'] = $commentresponse_start;
			$markerArray['###COMMENT_RESPONSE_END###'] = $commentresponse_end;

			//comments_report

			if ($conf['commentsreport.']['active']) {

					$markerArray['###TX_COMMENTSREPORT###'] ='';
					$params = array(
							'pObj' => &$pObj,
							'template' => $template,
							'markers' => $markerArray,
							'row' => $row,
					);
					if (is_array($tempMarkers =$this->getCommentsReportLink($params, $pObj, $conf, $fromAjax, $pid))) {
						$markerArray = $tempMarkers;
					}
					//post-wurstel :-)
					if($markerArray['###TX_COMMENTSREPORT###'] !=''){
						$linktag=strstr($markerArray['###TX_COMMENTSREPORT###'],'>',true) .'>';
						$totllinktext=substr($markerArray['###TX_COMMENTSREPORT###'],strlen($linktag));
						$linkendtag=strstr($totllinktext,'<');
						$linkendtext=str_replace($linkendtag,'',$totllinktext);
						$imghtml = '<img height="15" width="15" src="' . '/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/report.png" title="' . $linkendtext .'">';
						$markerArray['###TX_COMMENTSREPORT###'] ='<div class="tx-tc-ct-report">' .  $linktag .$imghtml.$linkendtag . '</div>';
					}

			} else {
				$markerArray['###TX_COMMENTSREPORT###'] ='';
			}
			//highlight for selected (anchor-referenced) comment
			$highlightstyle='';
			if ($_GET['toctoc_comments_pi1']['anchor']) {
				$hlsanchorarr=explode('-',$_GET['toctoc_comments_pi1']['anchor']);
				if (count($hlsanchorarr)>0) {
					$hlsctid= $hlsanchorarr[(count($hlsanchorarr)-1)];
					if ($iuid==$hlsctid) {
						$highlightstyle='class="tx-tc-ct-highlight"';
					}
				}
			}
			$markerArray['###HIGHLIGHTSTYLE###'] = $highlightstyle;
			$entries[] = $pObj->cObj->substituteMarkerArray($template, $markerArray);
			$alt = ($alt + 1) % 2;
		}

		return implode( $entries);
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
	 * @return	string		Ratings	HTML for this row
	 */
	protected function comments_getComments_getRatings(&$row,$conf,$pObj,$feuserid, $fromAjax) {
		if ($conf['ratings.']['enableRatings']) {
			if ($this->isCommentingClosed($conf,$pObj)) {
				$conf['ratings.']['mode'] = 'static';
			}

			return $this->getRatingDisplay('tx_toctoc_comments_comments_' . $row['uid'], $conf, $fromAjax, $_SESSION['commentsPageId'], false, $feuserid , 'vote', $pObj,$_SESSION['commentListCount'], true);

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
		return ($email ? $this->cObj->typoLink_URL(array(
				'parameter' => $email,
		))
				: '');
	}

	/**
	 * Checks if commenting is closed for this item
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @return	boolean		<code>true</code> if commenting is closed
	 */
	protected function isCommentingClosed($conf,$pObj) {

		// Try global settings
		if ($conf['advanced.']['commentingClosed']==0) {
			$timeAdd = $conf['advanced.']['closeCommentsAfter'];
			if ($timeAdd == '') {
				// No time limit emposed
				return false;
			}
			t3lib_div::loadTCA($pObj->foreignTableName);
			if (isset($GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['crdate'])) {
				$fieldName = $GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['crdate'];
			}
			elseif (isset($GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['tstamp'])) {
				$fieldName = $GLOBALS['TCA'][$pObj->foreignTableName]['ctrl']['tstamp'];
			}
			else {
				// No time field configured in TCA -- cannot limit!
				return false;
			}
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($fieldName, $pObj->foreignTableName,
					'uid=' . intval($pObj->externalUid) . $this->enableFields($pObj->foreignTableName,$pObj));
			if (count($rows) == 1) {
				$time = strtotime($timeAdd, $rows[0][$fieldName]);
				if ($time <= $GLOBALS['EXEC_TIME']) {
					$conf['ratings.']['mode'] = 'static';
					return true;
				}
				$GLOBALS['TSFE']->set_cache_timeout_default($time - $GLOBALS['EXEC_TIME']);
			}
		} else {
			$conf['ratings.']['mode'] = 'static';
			return true;
		}
		return false;
	}



	/**
	 * Produces "commenting closed" message.
	 *
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	void
	 */
	protected function commentingClosed($pObj,$fromAjax) {
		$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENTING_CLOSED###');
		return $pObj->cObj->substituteMarkerArray($template, array(
				'###MESSAGE###' => $this->pi_getLLWrap($pObj, 'commenting.closed',$fromAjax),
				'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments')
		)
		);
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
	protected function comments_getCommentsBrowser($rpp,$startpoint,$totalrows,$pObj,$fromAjax, $conf) {
		$result='';
		$emptybrowsestr='<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' . $_SESSION['commentListCount']  . '"></div>';
		$externalbegin=substr($this->externalref,0,5);
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
		$conditionshow=false;
		$conditionhide=false;

		if ($conf['advanced.']['reverseSorting']==1) {
			if ($startpoint>0){
				$conditionshow=true;
			}
			if (($totalrows-$startpoint)>$rpp) {
				$conditionhide=true;
			}
			$startpt=$totalrows-$startpoint;
		}else{
			if ($startpoint > 0){
				$conditionshow=true;
			}
			if (($totalrows-$startpoint)>$rpp) {
				$conditionhide=true;
			}
			$startpt=$startpoint;
		}
		if ($conditionshow==true){
			$emptybrowsestr='';
			$submithtml='';
			$check = md5($ref . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			$tmpcid=$_SESSION['commentListCount'];
			$ref='tt_content_' . $tmpcid;
			$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###BROWSE_COMMENT_LINK_SUB###');
			$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
					'###VALUE###' => '1',
					'###REF###' => $externalref,
					'###PID###' => $pid,
					'###CID###' => $tmpcid,
					'###CHECK###' => $check,
					'###STARTPOINT###' => $startpt,
					'###TOTALROWS###' => $totalrows,
			));
			$submithtml=$submithtmlSub;
			if ($startpoint==1) {
				$oldercomments=$this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.older_row_available', $fromAjax);
			} else {
				$oldercomments=$this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.older_rows_available', $fromAjax);
			}
			$result .= '<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' . $_SESSION['commentListCount']  . '"><form id="bf' . $_SESSION['commentListCount']  . '" class="comment-browseform" ';
			$result .= ' method="post" action="">';
			$result .= '<input id="toctoc_comments_pi1_submit_bcid' . $_SESSION['commentListCount']  . '" ';
			$result .= ' type="button" title="';
			$result .= '" value="' . $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.show_older_rows_text', $fromAjax) . ' ' . $startpoint;
			$result .= ' ' . $oldercomments;
			$result .= '" name="toctoc_comments_pi1[submit]"  class="tx-tc-cts-ctsbrowse-submit" ';
			$result .= ' onclick="' . $submithtml . '" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';"';
			$result .= '>';
			$result .= '<input type="hidden" name="typo3_user_int" value="1">';
			$result .= '</form></div>';
		}
		else{
		}
		if ($conditionhide==true){


			$submithtml='';
			$check = md5($ref . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			$tmpcid=$_SESSION['commentListCount'];
			$ref='tt_content_' . $tmpcid;
			$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###BROWSEHIDE_COMMENT_LINK_SUB###');
			$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
					'###VALUE###' => '1',
					'###REF###' => $externalref,
					'###PID###' => $pid,
					'###CID###' => $tmpcid,
					'###CHECK###' => $check,
					'###STARTPOINT###' => $startpoint,
					'###TOTALROWS###' => $totalrows,
			));
			$submithtml=$submithtmlSub;

			$result .= $emptybrowsestr . '<div class="tx-tc-cts-ctsbrowse-hide" id="tx-tc-cts-ctsbrowse-hide-' . $_SESSION['commentListCount']  . '"><form id="bfh' . $_SESSION['commentListCount']  . '" ';
			$result .= ' class="comment-browseform-hide" ';
			$result .= ' method="post" action="">';
			$result .= '<input id="toctoc_comments_pi1_submit_bhcid' . $_SESSION['commentListCount']  . '" ';
			$result .= ' type="button" title="';
			$result .= '" value="' . $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.hide_older_rows_text', $fromAjax) . '" name="toctoc_comments_pi1[submit]"';
			$result .= ' onclick="' . $submithtml . '" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';"';
			$result .= ' class="tx-tc-cts-ctsbrowse-submit-hide">';
			$result .= '<input type="hidden" name="typo3_user_int" value="1">';
			$result .= '</form></div>';
		}

		return $result;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$conf: ...
	 * @param	[type]		$usergenderexistsstr: ...
	 * @return	[type]		...
	 */
	protected function build_AJAXImages ($conf,$usergenderexistsstr='') {
			if (count($this->AJAXimages)==0) {
				if (count($_SESSION['AJAXimages'])!=0) {
					$this->AJAXimages=$_SESSION['AJAXimages'];
				} else {
					//build $this->AJAXimages
					$start_time_for_conversion = microtime();
					$imagefield='';
					if ($conf['advanced.']['FeUserDbField'] != 'image') {
						$imagefield='fe_users.' . $conf['advanced.']['FeUserDbField'] . ', ';
					}

				 	$rowsfeuserimages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('fe_users.uid AS uid, '. $usergenderexistsstr .' fe_users.image AS image, ' .$imagefield .'fe_users.lastlogin AS lastlogin, fe_users.is_online AS is_online, fe_users.last_name AS lastname', 'fe_users,tx_toctoc_comments_comments',
							'fe_users.uid=tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser AND fe_users.deleted=0',
				 			'fe_users.uid, fe_users.image, fe_users.lastlogin, fe_users.is_online',
				 			'fe_users.lastlogin DESC',
				 			'100');
					$userimagesize=96;
					$userimagestylesize=$conf['UserImageSize'];
					$userimagestyle= ' width: ' . $userimagestylesize . 'px; height: ' . $userimagestylesize . 'px; ';
					$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];

					foreach($rowsfeuserimages as $keyimage) {
						$keyFeUserDbField=$this->fixFeUserPic($conf, $keyimage[$conf['advanced.']['FeUserDbField']]);
						$femp='';
						if ($usergenderexistsstr!='') {
							if (intval($keyimage['gender'])==1) {

								$femp='f';
							}
						}


						$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile' . $femp . '.png';

						$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;

						$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
						$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
						$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);

						if (strval($keyFeUserDbField!=='')) {

							$userimagesarr=explode(',',$keyFeUserDbField);
							if (count($userimagesarr)>0){
								$commentuserimageout= $commentuserimagepath . $userimagesarr[0];
							} else {
								$commentuserimageout= $commentuserimagepath . $keyFeUserDbField;
							}

						} else {

							$commentuserimageout=$userimgFile;
						}
						/* if (($keyimage['lastname'])=='Whendell') {
							print '$userconfimgFile: ' . $userconfimgFile . ', $commentuserimageout: ' . $commentuserimageout;exit;
						}  */
						$tmpimgstr ='';
						$tmpimgstrarr = $this->getAJAXimageCache($commentuserimageout);
						if (is_array($tmpimgstrarr)) {
							$tmpimgstr =$tmpimgstrarr['image'];
							$tmpimgfeuser =$tmpimgstrarr['feuserid'];
						} else {
							$tmpimgstr ='';
						}
						$profileimgclass='tx-tc-userpic' . $femp;
						if ($tmpimgstr==='') {
							$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
							$img = array();
							$img['file'] = GIFBUILDER;
							$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
							$img['file.']['10'] = IMAGE;
							$img['file.']['10.']['file'] = $commentuserimageout;
							$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
							$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
							$img['params'] = 'style="' . $userimagestyle . '" class="'.$profileimgclass.'" id="tx-tc-cts-img-"'  ;   //style="margin: -6px 6px -6px -3px; padding: 0pt 0pt 0pt 0px; border-radius: 2px 2px 2px 2px; border: 1px solid #97b0ee;" align="left"';
							$tmpimgstr = $pObj->cObj->IMAGE($img);
							$this->setAJAXimage($tmpimgstr,$keyimage['uid']);
							$this->setAJAXimageCache($tmpimgstr,$commentuserimageout,$keyimage['uid']);
						} else {
							$this->setAJAXimage($tmpimgfeuser,$keyimage['uid']);
						}

					}
					for ($n=0; $n<2;$n++) {
						if ($n==0) {
							$femp='';
							$userindex=0;

						}else {
							$femp='f';
							$userindex=99999;
						}
						$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile' . $femp . '.png';

						$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;

						$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
						$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
						$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);


						$tmpimgstr ='';
						$tmpimgstrarr = $this->getAJAXimageCache($userimgFile);
						if (is_array($tmpimgstrarr)) {
							$tmpimgstr =$tmpimgstrarr['image'];
							$tmpimgfeuser =$tmpimgstrarr['feuserid'];
						} else {
							$tmpimgstr ='';
						}
						$profileimgclass='tx-tc-userpic' . $femp;
						if ($tmpimgstr==='') {
							$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
							$img = array();
							$img['file'] = GIFBUILDER;
							$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
							$img['file.']['10'] = IMAGE;
							$img['file.']['10.']['file'] = $userimgFile;
							$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
							$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
							$img['params'] = 'style="' . $userimagestyle . '" class="'.$profileimgclass.'" id="tx-tc-cts-img-"'  ;   //style="margin: -6px 6px -6px -3px; padding: 0pt 0pt 0pt 0px; border-radius: 2px 2px 2px 2px; border: 1px solid #97b0ee;" align="left"';
							$tmpimgstr = $pObj->cObj->IMAGE($img);

							$this->setAJAXimageCache($tmpimgstr,$userimgFile,$userindex);
						}
						$this->setAJAXimage($tmpimgstr,$userindex);
					}

					$_SESSION['AJAXimages']=$this->AJAXimages;

				}
			}
	}
	/*
	 * Returns a list of markers with fe_user properties
	*
	* @return array
	*/
	public function comments_getComments_fe_user($params, $conf, $pObj,$commentid,$fromAjax) {
		// sets default value if no user is logged in
		$params['markers']['###USERNAME###'] = $params['markers']['###FIRSTNAME###']." "
				.$params['markers']['###LASTNAME###'];
		$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
				'uid=' . $params['row']['toctoc_commentsfeuser_feuser'] );
		$usergenderexistsstr='';
		if (count($rowsfeuser)>0) {
			if (array_key_exists('gender',$rowsfeuser[0])) {
					$usergenderexistsstr=' fe_users.gender AS gender, ';
			}
		}
		if (!$fromAjax) {
			$this->build_AJAXImages($conf,$usergenderexistsstr);
		}
		$pictureuser= $params['row']['toctoc_commentsfeuser_feuser'];
		if (($params['row']['toctoc_commentsfeuser_feuser'] == 0 ) && ($params['row']['gender'] ==1)) {
			$pictureuser= 99999;

		}
		if ($commentid !=0) {
			$params['markers']['###IMAGE###'] = $this->getAJAXimage($pictureuser ,$commentid);
		}

		if (count($rowsfeuser) ==1) {
			foreach($rowsfeuser as $key) {
				$params['markers']['###USERNAME###'] = $key['username'];
				$params['markers']['###EMAILADR###'] = $key['email'];
				$params['markers']['###LOCADR###'] = $key['city'];
				$params['markers']['###WWWADR###'] = $key['www'];
				//make a guess for the users first and lastname (and fullname if existing)
				if ($key['name'] != '') {
					$params['markers']['###FULLNAME###'] = $key['name'];
					$namePartsArr=explode(' ', $key['name']);
					$countNameParts = count($namePartsArr);
					if ($countNameParts>1) {
						$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
						$params['markers']['###LASTNAME###'] = trim($namePartsArr[$countNameParts-1]);
						$params['markers']['###FIRSTNAME###'] = trim(substr($key['name'],0,strlen($key['name'])-strlen(trim($namePartsArr[$countNameParts-1]))));
					} else {
						$params['markers']['###LASTNAME###'] = trim(substr($key['name'],1,1000));
						$params['markers']['###FIRSTNAME###'] = trim(substr($key['name'],0,1)) . '.';
					}
				}
				elseif ($key['last_name'] != '') {
					// no fullname, so maybe a name
					$params['markers']['###FULLNAME###'] = $key['last_name'];
					$params['markers']['###LASTNAME###'] = $key['last_name'];
					$params['markers']['###FIRSTNAME###'] = trim(substr($key['last_name'],0,1)) . '.';

				}
				elseif ($key['first_name'] != '') {
					// no fullname, no last_name, so maybe a first_name?
					$params['markers']['###FULLNAME###'] = $key['first_name'];
					$params['markers']['###FIRSTNAME###'] = $key['first_name'];
					$params['markers']['###LASTNAME###'] = $key['first_name'];
				}
				//now overwrite the guess if data is actually here'
				if ($key['first_name']!=''){
					$params['markers']['###FIRSTNAME###'] = $key['first_name'];
				}
				if ($key['last_name']!=''){
					$params['markers']['###LASTNAME###'] = $key['last_name'];
				}
			}

			//Markers like '###FEUSER_IMAGE###'
			if ($commentid !=0) {
				if (array_key_exists(0, $rowsfeuser) && array_key_exists('username', $rowsfeuser[0])) {

					foreach($rowsfeuser[0] as $key=>$value) {
						$params['markers']['###FEUSER_' . strtoupper($key) . '###'] = $this->applyStdWrap($rowsfeuser[0][$key], 'feuser_' . $key . '_stdWrap', $conf, $pObj);
					}
				}
			}
		}

		return $params['markers'];
	}

	/**
	 * Brings first Pic from the user pic field in fe_users.
	 *
	 * @param	array		$conf	...
	 * @param	string		$pic	Sttring from DB
	 * @return	string		$pic prepared for add in URL
	 */
	protected function fixFeUserPic ($conf, $pic) {
		$picout=$pic;
		if ($pic !='') {
			if (is_array($pic)) {
				$picout=$pic[0];
			} else {
				$picout=$pic;
			}
		}
		return  rawurlencode ($picout);

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
	protected function setAJAXimage($image,$feuserid) {
		$this->AJAXimages[$feuserid] = $image;
	}

	/**
	 * Searches images in the array for images
	 *
	 * @param	int		$feuserid: userid
	 * @param	int		$commentid: uid of the comment
	 * @return	string		HTML for the image in the commentslist
	 */
	protected function getAJAXimage($feuserid,$commentid) {
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
			$oldstr='tx-tc-cts-img-' ;
			$outstr= str_replace($oldstr, $newstr,$imageout);
			return $outstr;
		} else {
			return $this->AJAXimage;
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
	protected function setAJAXimageCache($image,$imageoriginal,$feuserid) {
		$this->AJAXimagesCache[$imageoriginal]['image'] = $image;
		$this->AJAXimagesCache[$imageoriginal]['feuserid'] = $feuserid;
	}

	/**
	 * Searches images in the cache-array for images
	 *
	 * @param	int		$commentuserimageout: userid
	 * @return	string		link for image
	 */
	protected function getAJAXimageCache($commentuserimageout){
		if ($this->AJAXimagesCache[$commentuserimageout]) {
			return $this->AJAXimagesCache[$commentuserimageout];
		} else {
			return '';
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
	 * @return	string		Formatted form
	 */
	public function form($conf, &$pObj, $piVars,$fromAjax,$pid, $ifeuserid=0, $userpic) {

		$cid = $_SESSION['submittedCid'];
		if (!$fromAjax) {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_FORM###');
		} else {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_FORMAJAX###');
		}

		//$externalref = 'tt_content_' . $_SESSION['commentListCount'];
		$externalbegin=substr($this->externalref,0,5);
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

		if ($fromAjax) {
			$actionLink = $_SESSION['commentsPageIds'][$pid];
		} else {
			$actionLink = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
		}

		$requiredFields = t3lib_div::trimExplode(',', $conf['requiredFields'], true);
		$requiredMark = $pObj->cObj->getSubpart($pObj->templateCode, '##REQUIRED_FIELD###');

		$txtentercomment=$this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax);

		if (!$fromAjax) {
			if (intval($_SESSION['feuserid']) != intval($GLOBALS['TSFE']->fe_user->user['uid'])) {
				//$_SESSION['feuserid'] = intval($GLOBALS['TSFE']->fe_user->user['uid']);
			}
			if (intval($GLOBALS['TSFE']->fe_user->user['uid'])) {

				$feuserid=intval(intval($GLOBALS['TSFE']->fe_user->user['uid']));
			} else {
				$feuserid=0;
			}

		} else {
			$feuserid=$ifeuserid;
		}



		$this->form_updatePostVarsWithFeUserData($conf, $pObj, $piVars,$feuserid,$fromAjax, $userpic, $cid);

		if ($fromAjax) {
			$itemUrl = $_SESSION['commentsPageIds'][$pid];
		} else {
			$itemUrl = t3lib_div::getIndpEnv('TYPO3_REQUEST_URL');
		}

		$userIntMarker = '<input type="hidden" name="typo3_user_int" value="1" />';


		if ($_SESSION['commentListCount'] == $cid) {

			$tERROR_FIRSTNAME = $this->form_wrapError('firstname', $pObj,$conf);

			$tERROR_LASTNAME = $this->form_wrapError('lastname', $pObj,$conf);
			$tERROR_IMAGE = $this->form_wrapError('image', $pObj,$conf);
			$tERROR_EMAIL = $this->form_wrapError('email', $pObj,$conf);
			$tERROR_LOCATION = $this->form_wrapError('location', $pObj,$conf);
			$tERROR_HOMEPAGE = $this->form_wrapError('homepage', $pObj,$conf);
			$tERROR_CONTENT = $this->form_wrapError('content', $pObj,$conf);
			$frmtERROR_CAPCHA = $this->form_wrapError('captcha', $pObj,$conf);
			$tERRCODE = (count($_SESSION['formValidationErrors']) == 0 ? '' : '1');
			$tREQUIRED_FIRSTNAME = in_array('firstname', $requiredFields) ? $requiredMark : '';
			$tREQUIRED_LASTNAME = in_array('lastname', $requiredFields) ? $requiredMark : '';
			$tREQUIRED_IMAGE = in_array('image', $requiredFields) ? $requiredMark : '';
			$tREQUIRED_EMAIL = in_array('email', $requiredFields) ? $requiredMark : '';
			$tREQUIRED_LOCATION = in_array('location', $requiredFields) ? $requiredMark : '';
			$tREQUIRED_HOMEPAGE = in_array('homepage', $requiredFields) ? $requiredMark : '';
			$tREQUIRED_CONTENT = in_array('content', $requiredFields) ? $requiredMark : '';
			if (((count($_SESSION['formValidationErrors']) == 0 ) && ($_SESSION['formTopMessage'] !='')) || ($_SESSION['formValidationErrors']['email'] == $this->pi_getLLWrap($pObj, 'error.invalid.useremail', $fromAjax))) {
				if (($_SESSION['formValidationErrors']['email'] == $this->pi_getLLWrap($pObj, 'error.invalid.useremail', $fromAjax))) {
					$_SESSION['formTopMessage']= '<div class="tx-tc-form-top-message"><p class="tx-tc-text">' . $_SESSION['formValidationErrors']['email'] . '</p></div>';
				}
				$tformTopMessage =$_SESSION['formTopMessage'];

			} else {
				$tformTopMessage = '';
			}
			$jstext='<script type="text/javascript">toctoc_comments_pi1_setUserData(' . htmlspecialchars($_SESSION['commentListCount']) . ')</script>';
			$jsval=$userIntMarker . (count($_SESSION['submitCommentVars']) == 0 ? $jstext : '');
		}
		else {
			//echo 'tEROinit: ' . $_SESSION['submittedCid']; exit;
			$tERROR_FIRSTNAME = '';
			$tERROR_LASTNAME = '';
			$tERROR_IMAGE = '';
			$tERROR_EMAIL = '';
			$tERROR_LOCATION = '';
			$tERROR_HOMEPAGE = '';
			$tERROR_CONTENT = '';
			$frmtERROR_CAPCHA = '';
			$tERRCODE = '';
			$tREQUIRED_FIRSTNAME  = '';
			$tREQUIRED_LASTNAME  = '';
			$tREQUIRED_IMAGE = '';
			$tREQUIRED_EMAIL = '';
			$tREQUIRED_LOCATION = '';
			$tREQUIRED_HOMEPAGE = '';
			$tREQUIRED_CONTENT = '';
			$tformTopMessage = '';
			$jsval=$userIntMarker . '<script type="text/javascript">toctoc_comments_pi1_setUserData(' . htmlspecialchars($_SESSION['commentListCount']) . ')</script>';
		}


		$tempcaptcha='';
		$captchasession ='0';

		if ($cid == $_SESSION['commentListCount']){
			$ctval = htmlspecialchars((count($_SESSION['formValidationErrors']) == 0 ? '' : $_SESSION['submitCommentVars'][$cid]['content']));
			if ($_SESSION['requestCapcha'][$cid] >= 1) {
				$ctval = htmlspecialchars($_SESSION['submitCommentVars'][$cid]['content']);
				$tERRCODE = '1';
				$pObj->tERROR_CAPCHA ='';
				$captchaType = $conf['spamProtect.']['useCaptcha'];
				if ($captchaType > 0) {
					if ($_SESSION['requestCapcha'][$cid] == 2) {
						$pObj->tERROR_CAPCHA = $this->form_wrapError('captcha', $pObj,$conf);
						$_SESSION['requestCapcha'][$cid] = 2;
					} else {
						if ($_SESSION['requestCapcha'][$cid] == 1) {
							$pObj->tERROR_CAPCHA = $this->pi_getLLWrap($pObj, 'pi1_template.captchaInputNeededErrMsg', $fromAjax);
							//captchaInputNeededErrMsg
							$_SESSION['requestCapcha'][$cid] = 2;
						} else {
							unset($_SESSION['requestCapcha'][$cid]);
						}
					}
				}
				$tempcaptcha = $this->form_getCaptcha($pObj, $conf,$fromAjax);
				$captchasession ='1';
			}
		} else {
			$ctval ='';//$this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax);
		}


		$tmpcid=$_SESSION['commentListCount'];
		$submithtml='';
		$ref='tt_content_' . $_SESSION['commentListCount'];
		$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###ADD_COMMENT_LINK_SUB###');
		$ajaxData = $_SESSION['ajaxData'];

		$loggedon= 'false';
		if ($feuserid!= 0) {
			$loggedon= 'true';
		}
		$check = $this->getcheck($ref, '1', $ajaxData,false);

		$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
				'###LOGGEDON###' => $loggedon,
				'###VALUE###' => '1',
				'###REF###' => $ref,
				'###EXTREF###' => $externalref,
				'###PID###' => $pid,
				'###CID###' => $tmpcid,
				'###CHECK###' => $check,
				'###CAPSESS###' => $captchasession,
				'###ERROR_CAPTCHA###' => $pObj->tERROR_CAPCHA,
				'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
		));
		$submithtml=$submithtmlSub;

		$subformhtml='';
		if ($feuserid == 0) {
			$subformTemplate = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMIP###');
		} else {
			$subformTemplate = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMUSER###');
		}
		$txtgender='';

		$userimagesize=3*18;

		if (!$fromAjax) {
			$_SESSION['DefaultUserImage'] = array();
			for ($i=0;$i<2;$i++) {
				if ($i==0) {

					$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile.png';
					$opa='opacity:1; filter: alpha(opacity=100);';
					$alttext= $this->pi_getLLWrap($pObj, 'pi1_template.usemaleavatar', $fromAjax);
					$profileimgclass='tx-tc-avatarpic';
					$onclick= ' onclick="javascript:changeavatar(0,placeholdercid);" ';
				} else {

					$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profilef.png';
					$opa='opacity:0.4; filter: alpha(opacity=40);cursor:pointer;';
					$alttext= $this->pi_getLLWrap($pObj, 'pi1_template.usefemaleavatar', $fromAjax);
					$onclick= ' onclick="javascript:changeavatar(1,placeholdercid);" ';
					$profileimgclass='tx-tc-avatarpicf';
				}
				$tmpimgstr='';
				$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
				$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
				$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
				$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
				$commentuserimageout=$userimgFile;

				$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
				$img = array();
				$img['file'] = GIFBUILDER;
				$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
				$img['file.']['10'] = IMAGE;
				$img['file.']['10.']['file'] = $commentuserimageout;
				$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
				$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
				//$img['params'] = 'style="' . $opa . $userimagestyle . '" class="' . $profileimgclass . '" title="' . $alttext . '" '. $onclick . ' id="tx-toctoc-comments-comments-img-gender-' . $i . '-placeholdercid"';
				$img['params'] = 'style="' . $opa . '" class="' . $profileimgclass . '" title="' . $alttext . '" '. $onclick . ' id="tx-toctoc-comments-comments-img-gender-' . $i . '-placeholdercid"';
				$tmpimgstr = $pObj->cObj->IMAGE($img);
				$_SESSION['DefaultUserImage']['p' . $i]=$tmpimgstr;
			}
		}

		$txtgender=$_SESSION['DefaultUserImage']['p0'] . '  ' . $_SESSION['DefaultUserImage']['p1'];
		$txtgender=str_replace('placeholdercid' ,$tmpcid,$txtgender);
		if ($_SESSION['submitCommentVars'][$cid]['gender']==1) {
			$txtgender=str_replace('opacity:1;' ,'opacity:0.9;',$txtgender);
			$txtgender=str_replace('filter: alpha(opacity=100);' ,'filter: alpha(opacity=90);',$txtgender);
			$txtgender=str_replace('opacity:0.4;' ,'opacity:1;',$txtgender);
			$txtgender=str_replace('filter: alpha(opacity=40);' ,'filter: alpha(opacity=100);',$txtgender);
			$txtgender=str_replace('opacity:0.9;' ,'opacity:0.4;',$txtgender);
			$txtgender=str_replace('filter: alpha(opacity=90);' ,'filter: alpha(opacity=40);',$txtgender);
		}

		$commentminlength= intval($conf['minCommentLength']);

		$htmlsubpicupload='';
		$dodisplaycss=true;
		if (($conf['attachments.']['usePicUpload']==1) || ($conf['attachments.']['usePdfUpload']==1)) {
			if ($fromAjax) {
				if ($conf['attachments.']['useWebpagePreview'] ==1) {
					if ($_SESSION['submitCommentVars'][$cid]['previewselpreviewid']!=0) {
						$dodisplaycss=false;
					}
				}
			}
			$htmlpicuploadSub = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMPICUPLOAD###');
			$firstmargin='margin: 0 4px;';
			$secondmargin='margin: 2px 4px 0;';
			if ($conf['attachments.']['usePicUpload']==1) {
				$uploadpictext='<img style="display:block;' . $firstmargin . '" align="left" src="/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/uploadpic.png" width="16" ';
				$uploadpictext.='height="16" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.imageuploadpic', $fromAjax) . '" />';
			} else {
				$uploadpictext='';
				$secondmargin=$firstmargin;
			}
			if ($conf['attachments.']['usePdfUpload']==1) {
				$uploadpdftext='<img style="display:block;' . $secondmargin . '" align="left" src="/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/uploadpdf.png" width="16" ';
				$uploadpdftext.='height="16" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.imageuploadpdf', $fromAjax) . '" />';
			} else {
				$uploadpdftext='';
			}
			$fullfppath='';
			$fppic='';
			$displaycss='block';
			$descriptionbyuser='';
			$originalfilename='';
			$hidecss='none';
			$fppicheight='0';
			$fppicmargin=0;
			$tippimageupload='';
			$tippcancelupload='';
			$adddescriptiontext='';
			if (($fromAjax) && ($_SESSION['submitCommentVars'][$cid]['uploadpicid']!='')) {
				$fppicmargin=8;
				$displaycss='none';
				$hidecss='block';
				$fppicheight=$_SESSION['submitCommentVars'][$cid]['uploadpicheight']+$fppicmargin;
				$fppic=$_SESSION['submitCommentVars'][$cid]['uploadpicid'];
				$arrext= explode('.',$_SESSION['submitCommentVars'][$cid]['originalfilename']);
				if (($_SESSION['submitCommentVars'][$cid]['uploadpicid'] == 'adobepdf.png')) {
					$fullfppath= '/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/' . $_SESSION['submitCommentVars'][$cid]['uploadpicid'];

				} else {
					$fullfppath='/' . $this->webpagepreviewtempfolder . $_SESSION['submitCommentVars'][$cid]['uploadpicid'];
				}


				if ($arrext[count($arrext)-1]='pdf') {
					$adddescriptiontext= $this->pi_getLLWrap($pObj, 'pi1_template.pdfdescribe', $fromAjax) . ' ' . $_SESSION['submitCommentVars'][$cid]['originalfilename'] . '';
					$tippcancelupload =$this->pi_getLLWrap($pObj, 'pi1_template.closepdfupload', $fromAjax);
					$tippimageupload=$_SESSION['submitCommentVars'][$cid]['originalfilename'];
				} else {
					$adddescriptiontext= $this->pi_getLLWrap($pObj, 'pi1_template.imagedescribe', $fromAjax)  . ' ' . $_SESSION['submitCommentVars'][$cid]['originalfilename'] ;
					$tippcancelupload = $this->pi_getLLWrap($pObj, 'pi1_template.closeimageupload', $fromAjax);
					$tippimageupload=$this->pi_getLLWrap($pObj, 'pi1_template.tippimageupload', $fromAjax);
				}
				$descriptionbyuser = $_SESSION['submitCommentVars'][$cid]['descriptionbyuser'];
				$originalfilename = $_SESSION['submitCommentVars'][$cid]['originalfilename'] ;

			}
			if($dodisplaycss==false){
				$displaycss='none';
			}
			$uploadpictextweb='<a href="javascript:void(0)" rel="nofollow"  onclick="tcOpenFile(\'toctoc_comments_pi1_' . $tmpcid . 'uploadpic\', \'pic\');return;">'. $uploadpictext .'</a>';
			$uploadpdftextweb='<a href="javascript:void(0)" rel="nofollow"  onclick="tcOpenFile(\'toctoc_comments_pi1_' . $tmpcid . 'uploadpic\', \'pdf\');return;">'. $uploadpdftext .'</a>';
			$htmlsubpicupload =  $pObj->cObj->substituteMarkerArray($htmlpicuploadSub, array(
					'###OPENFILEDIALOG###' => $uploadpictextweb,
					'###OPENPDFFILEDIALOG###' => $uploadpdftextweb,
					'###CID###' => $tmpcid,
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###LANG###' => $_SESSION['activelang'],
					'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
					'###NAVICLOSEMGLEFT###' => 24,
					'###NAVICLOSEMGTOP###' => $conf['attachments.']['webpagePreviewHeight']-8,
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
					'###UPLOADPICHEIGHT###' => $fppicheight,
					'###ORIGINALUPLOADFILENAME###' => $originalfilename,
					'###USERUPLOADDESCRIPTION###' => $descriptionbyuser,
			));
		}

		$subformhtml =  $pObj->cObj->substituteMarkerArray($subformTemplate, array(
				'###CURRENT_URL_CHK###' => md5($itemUrl . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']),
				'###ACTION_URL###' => htmlspecialchars($actionLink),
				'###GENDER###'=> htmlspecialchars($_SESSION['submitCommentVars'][$cid]['gender']),
				'###FIRSTNAME###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['firstname']),
				'###LASTNAME###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['lastname']),
				'###IMAGE###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['image']),
				'###EMAIL###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['email']),
				'###LOCATION###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['location']),
				'###HOMEPAGE###' => htmlspecialchars($_SESSION['submitCommentVars'][$cid]['homepage']),
				'###CAPTCHA###' => $tempcaptcha,
				'###CONTENT###' => $ctval,
				'###CID###' => htmlspecialchars($_SESSION['commentListCount']),
				'###ERROR_FIRSTNAME###' => $tERROR_FIRSTNAME,
				'###ERROR_LASTNAME###' => $tERROR_LASTNAME,
				'###ERROR_IMAGE###' => $tERROR_IMAGE,
				'###ERROR_EMAIL###' => $tERROR_EMAIL,
				'###ERROR_LOCATION###' => $tERROR_LOCATION,
				'###ERROR_HOMEPAGE###' => $tERROR_HOMEPAGE,
				'###ERROR_CONTENT###' => $tERROR_CONTENT,
				'###ERRCODE###' => $tERRCODE,
				'###REQUIRED_FIRSTNAME###' => $tREQUIRED_FIRSTNAME,
				'###REQUIRED_LASTNAME###' => $tREQUIRED_LASTNAME,
				'###REQUIRED_IMAGE###' => $tREQUIRED_IMAGE,
				'###REQUIRED_EMAIL###' => $tREQUIRED_EMAIL,
				'###REQUIRED_LOCATION###' => $tREQUIRED_LOCATION,
				'###REQUIRED_HOMEPAGE###' => $tREQUIRED_HOMEPAGE,
				'###REQUIRED_CONTENT###' => $tREQUIRED_CONTENT,
				'###TEXT_ADD_COMMENT###' => $txtentercomment,
				'###TEXT_REQUIRED_HINT###' => $this->pi_getLLWrap($pObj, 'pi1_template.required_field', $fromAjax),
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
				'###SUBMITONCLICK###' => $submithtml,
				'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###LANG###' => $_SESSION['activelang'],
				'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
				'###NAVICLOSEMGLEFT###' => 24,
				'###NAVICLOSEMGTOP###' => $conf['attachments.']['webpagePreviewHeight']-8,
				'###NAVICLOSEPADLEFT###' => $conf['attachments.']['webpagePreviewHeight']-38,
				'###TXTPREV###' => $this->pi_getLLWrap($pObj, 'pi1_template.previous', $fromAjax),
				'###TXTNEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.next', $fromAjax),
				'###TXTNOPREVIEWPIC###' => $this->pi_getLLWrap($pObj, 'pi1_template.nopreviewpics', $fromAjax),
				'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
				'###FORMPICUPLOAD###' => $htmlsubpicupload,


		));

		$markers = array(
				'###CURRENT_URL###' => htmlspecialchars($itemUrl),
				'###CURRENT_URL_CHK###' => md5($itemUrl . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']),
				'###TOP_MESSAGE###' => $tformTopMessage,
				'###SUBFORM###' => $subformhtml,
				'###ACTION_URL###' => '',
				'###REF###' => $externalref,
				'###IMAGETAG###' => $_SESSION['submitCommentVars'][$cid]['imagetag'],
				'###JS_USER_DATA###' => $jsval,
				'###CAPTYPE###' => $conf['spamProtect.']['useCaptcha'],
				'###AJAXDATACONF###' => '&srcbcc=' . $conf['spamProtect.']['freecapBackgoundcolor'] . '&srctc=' . $conf['spamProtect.']['freecapTextcolor']
				. '&srcnbc=' . $conf['spamProtect.']['freecapNumberchars'] . '&srch=' . $conf['spamProtect.']['freecapHeight'],
				'###CID###' => htmlspecialchars($_SESSION['commentListCount']),
				//'###AJAX_DATA###' => $this->getAjaxJSData($feuserid,$GLOBALS['TSFE']->id,$GLOBALS['TSFE']->lang,$conf,$pObj,$tmpcid, $fromAjax),
				//'###AJAX_COMMENTSDATA###' => $this->getAjaxJSDataComments ($tmpcid,$pObj,$fromAjax),
				//'###AJAX_COMMENTSIMGS###' => $this->getAjaxJSDataCommentImgs($tmpcid,$pObj,$fromAjax),
				'###SUBFORMCOMMENTATORNOTIFYPART###' => '',
				'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###LANG###' => $_SESSION['activelang'],
				'###TXTCLSPRV###' => $this->pi_getLLWrap($pObj, 'pi1_template.closepreview', $fromAjax),
				'###TXTLOADING###' => $this->pi_getLLWrap($pObj, 'pi1_template.loadingpreview', $fromAjax),
				'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
				'###MAXCOMMENTLENGTH###' => $conf['maxCommentLength'],
				'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
				'###TEXT_ADD_COMMENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax),

		);
		// $this->ajaxHeader for FORM, COMMENTS view
		/* if (!$fromAjax) {
			if ($this->ajaxHeader=='') {
				$templateajaxHeader = $pObj->cObj->getSubpart($pObj->templateCode, '###AJAXHEADER###');
				$markersajaxHeader = array(
						'###CID###' => htmlspecialchars($_SESSION['commentListCount']),
						'###UID###' => '',
					'###AJAX_DATA###' => $this->getAjaxJSData($feuserid,$GLOBALS['TSFE']->id,$GLOBALS['TSFE']->lang,$conf,$pObj,$tmpcid, $fromAjax),
					'###AJAX_COMMENTSDATA###' => $this->getAjaxJSDataComments ($tmpcid,$pObj,$fromAjax),
					'###AJAX_COMMENTSIMGS###' => $this->getAjaxJSDataCommentImgs($tmpcid,$pObj,$fromAjax),
									);
				$this->ajaxHeader=$pObj->cObj->substituteMarkerArray($templateajaxHeader, $markersajaxHeader);
			}
		} */



		//fe_user-intergration
		$markers['###USERNAME###'] = $GLOBALS['TSFE']->fe_user->user['username'];

		//commentator-notify-intergration

		$subformTemplateNotify = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMCOMMENTATORNOTIFY###');
		$callextfunc=0;
		if ($conf['advanced.']['commentatorNotify'] == 1) {
			if (($tempcaptcha !='') || ($conf['spamProtect.']['useCaptcha'] == 0)) {
				if (($conf['advanced.']['commentatorNotifybyIP'] == 1) ||((intval($feuserid)!==0) && ($conf['advanced.']['commentatorNotifybyIP'] == 0))) {
					$callextfunc=1;
				}
			}
		}
		if ($callextfunc==1) {
			 if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
			 	$addcls='';
			 } else {
			 	$addcls='';
			 }
			if ($feuserid==0) {
				$addcls='nl';
			}
			$subformTemplateNotifySub =  $pObj->cObj->substituteMarkerArray($subformTemplateNotify, array(
					'###DIVSHOW_NOTIFICATION###' => '<div class="tx-tc-ct-form-field-1' . $addcls .  '">',
					'###TEXT_NOTIFICATION###' => $this->pi_getLLWrap($pObj, 'pi1_template.notificationforcommentator', $fromAjax),
					'###CID###' => htmlspecialchars($_SESSION['commentListCount']),
					'###TEXT_NOTIFICATION_DESC###' => $this->pi_getLLWrap($pObj, 'pi1_template.notificationforcommentator_desc', $fromAjax),
			));
		} else  {
			$subformTemplateNotifySub ='';
		}
		$markers['###SUBFORMCOMMENTATORNOTIFYPART###'] = $subformTemplateNotifySub;

		// Call hook for custom markers
		$pObj->conf =$conf;
		if ($callextfunc==0) {
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['form'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['form'] as $userFunc) {
					$params = array(
							'pObj' => &$pObj,
							'template' => &$template,
							'markers' => $markers,
					);
					if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
						$markers = $tempMarkers;
					}
				}
			}
		}

		$retstr='';
		if ($fromAjax) {
			$cid = 0;
			if (($this->newcommentid !== -1)) {
				if ((!intval($conf['spamProtect.']['requireApproval']) == 1)){
					$retstr = '<div id=101' . $this->newcommentid . '></div>';
				} else{
					$retstr = '<div id=201' . $this->newcommentid . '></div>';
				}
			}
		}

		return $retstr . $pObj->cObj->substituteMarkerArray($template, $markers);
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
	 * @return	void
	 */
	protected function form_updatePostVarsWithFeUserData($conf, &$pObj, $piVars, $feuserid, $fromAjax, $userpic, $cid) {
		global $TSFE;

		if ($fromAjax) {
			$fe_user_user_uid =$feuserid;
		}
		else{
			$fe_user_user_uid =intval($TSFE->fe_user->user['uid']);
		}

		if ($fe_user_user_uid) {
			$reloadpivars=FALSE;
			if (!$_SESSION['feuserid']) {
				$_SESSION['feuserid']=0;
			}
			if ($_SESSION['feuserid'] != $fe_user_user_uid) {
				$piVars['firstname']='';
				$piVars['lastname']='';
				$piVars['location']='';
				$piVars['homepage']='';
				$piVars['email'] ='';
				$piVars['image']='';
				$piVars['imagetag']='';

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

			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'fe_users',
					'uid=' . $fe_user_user_uid );

			if (count($rows) ==1) {
				foreach($rows as $key) {
					$keyFeUserDbField=$this->fixFeUserPic($conf, $key[$conf['advanced.']['FeUserDbField']]);

					$femp='';
					if (array_key_exists('gender',$rows[0])) {
						if ($rows[0]['gender']==1) {
							$femp='f';

						}
					}
					if ((!$piVars['gender']) || $reloadpivars) {
						if (array_key_exists('gender',$rows[0])) {
							$piVars['gender']=$key['gender'];
							$_SESSION['submitCommentVars'][$cid]['gender'] = intval($piVars['gender']);
						} else {
							$piVars['gender']=0;
							$_SESSION['submitCommentVars'][$cid]['gender'] = 0;
						}
					}
					$nonames=0;
					if ((!$piVars['firstname']) || $reloadpivars) {

						if ($key['first_name']) {
							$piVars['firstname'] = $key['first_name'];
							$_SESSION['submitCommentVars'][$cid]['firstname'] = $piVars['firstname'];
							$nonames=10;
						}
						else {
							$nonames=1;
						}
					}
					if ((!$piVars['lastname']) || $reloadpivars) {
						if ($key['last_name']) {
							$piVars['lastname'] = $key['last_name'];
							$_SESSION['submitCommentVars'][$cid]['lastname'] = $piVars['lastname'];
							$nonames=$nonames+20;
						}
						else {
							$nonames=$nonames+2;
						}
					}

					if (($reloadpivars) || !(($piVars['lastname']) && ($piVars['firstname']))) {
						$namePartsArr=explode(' ', $key['name']);
						$countNameParts = count($namePartsArr);

						if ($countNameParts>1) {
							$lastpartlen=strlen($namePartsArr[$countNameParts-1]);
							$tmpLASTNAME = trim(substr($key['name'],(strlen($key['name'])-$lastpartlen),1000));
							$tmpFIRSTNAME = trim(substr($key['name'],0,strlen($key['name'])-strlen($tmpLASTNAME)));
						} elseif (strlen($key['name'])>1) {
							$tmpLASTNAME = trim(substr($key['name'],1,1000));
							$tmpFIRSTNAME = trim(substr($key['name'],0,1)) . '.';
						}
						else {
							$tmpLASTNAME = trim(substr($key['username'],1,1000));
							$tmpFIRSTNAME = trim(substr($key['username'],0,1)) . '.';
						}
						if ($nonames<30) {
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
						if ($nouserpic){
							$userconfimgFile='EXT:toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/profile' . $femp . '.png';
							$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
							$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
							$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
							$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
							$userimgFileArr= explode('/',$userimgFile);

							$commentimageout=$userimgFileArr[count($userimgFileArr)-1];
							$nouserpic=FALSE;
							$piVars['image'] = $commentimageout;
							$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];

						}
						if ($nouserpic){
							$piVars['image'] = 'nopic.jpg';
							$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];
							$nouserpic=FALSE;
						}

					}

					if ((!$piVars['imagetag'])  || $reloadpivars) {


						$userimagesize=$conf['UserImageSize'];
						$userimagestyle='';
						$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];
						if (($keyFeUserDbField !='') || ($keyFeUserDbField)) {
							$userimagesarr=explode(',',$keyFeUserDbField);
							if (count($userimagesarr)>0){
								$commentuserimageextr=  $userimagesarr[0];
							} else {
								$commentuserimageextr=  $keyFeUserDbField;
							}
							$piVars['imagetag'] = $commentuserimageextr;
							$commentuserimageout= $commentuserimagepath . $commentuserimageextr;
						}
						else
						{
							$piVars['imagetag'] = $keyFeUserDbField;
							$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$userconfimgFile;
							$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
							$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
							$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
							$commentuserimageout=$userimgFile;

						}


						$this->cObj = t3lib_div::makeInstance('tslib_cObj');
						$img = array();

						$img['file'] = GIFBUILDER;

						$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
						$img['file.']['10'] = IMAGE;

						$img['file.']['10.']['file'] = $commentuserimageout;
						$img['file.']['10.']['file.']['width'] = $userimagesize . 'c';
						$img['file.']['10.']['file.']['height'] = $userimagesize . 'c';

						if (!$_SESSION['commentListCount']) {
							$img['params'] = 'style="' . $userimagestyle . ' display:none; margin:0;" id="tx-tc-uimg-xx" align="left"';
						}
						else {
							$img['params'] = 'style="' . $userimagestyle . ' display:none; margin:0;" id="tx-tc-uimg-' . $_SESSION['commentListCount'] . '" align="left"';
						}
						if ($fromAjax){
							$piVars['imagetag']= $userpic;
						} else {
							$piVars['imagetag'] = $this->cObj->IMAGE($img);
						}
						$_SESSION['submitCommentVars'][$cid]['imagetag'] = $piVars['imagetag'];




					} else {
					}


					if ((!$piVars['email']) || $reloadpivars) {
						if ($key['email']!='') {
							$piVars['email'] = $key['email'];
						} else {
							$piVars['email'] = 'badmailadress@nosite.net';
						}
						$_SESSION['submitCommentVars'][$cid]['email'] = $piVars['email'];

					}
					if ((!$piVars['location']) || $reloadpivars) {
						$data = array();
						if ($key['city']) {
							$data[] = $key['city'];

						}
						if ($key['country']) {
							$data[] = $key['country'];
						}
						$piVars['location'] = implode(', ', $data);
						$_SESSION['submitCommentVars'][$cid]['location'] = $piVars['location'];

						unset($data);
					}
					if ((!$piVars['homepage']) || $reloadpivars) {
						$piVars['homepage'] = $key['www'];
						$_SESSION['submitCommentVars'][$cid]['homepage'] = $piVars['homepage'];

					}



				}
			}


		} else {
			if ($_SESSION['feuserid'] != 0) {
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
	 * Adds captcha code if enabled.
	 * and if requested by submit. cid has to fit as well
	 *
	 * @param	object		$pObj: parent object
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	string		Generated HTML
	 */
	protected function form_getCaptcha($pObj, $conf,$fromAjax) {
		$captchaType = intval($conf['spamProtect.']['useCaptcha']);
		if ($captchaType > 2) {
			print $conf['spamProtect.']['useCaptcha']; exit;
		}
		if ($captchaType == 1) {
			/* captcha in sr_freecap_style */

			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###CAPTCHA_SUB###');
			return $pObj->cObj->substituteMarkerArray($template, array(
					'###REQUIRED_CAPTCHA###' => $pObj->cObj->getSubpart($pObj->templateCode, '###REQUIRED_FIELD###'),
					'###ERROR_CAPTCHA###' => $this->form_wrapError('captcha', $pObj, $conf),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_ENTER_CODE###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code', $fromAjax),
					'###AJAXDATACONF###' => '&srcbcc=' . $conf['spamProtect.']['freecapBackgoundcolor'] . '&srctc=' . $conf['spamProtect.']['freecapTextcolor']
					 . '&srcnbc=' . $conf['spamProtect.']['freecapNumberchars'] . '&srch=' . $conf['spamProtect.']['freecapHeight'] . '&mtm=' . (10*round(microtime(true),1)),
					'###SR_FREECAP_CANT_READ###' => $this->pi_getLLWrap($pObj, 'pi1_template.captcha_cant_read', $fromAjax),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
			));
		}
		if ($captchaType == 2) {
			/* captcha in recaptcha style */

			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###RECAPTCHA_SUB###');
			return $pObj->cObj->substituteMarkerArray($template, array(
					'###REQUIRED_CAPTCHA###' => $pObj->cObj->getSubpart($pObj->templateCode, '###REQUIRED_FIELD###'),
					'###ERROR_CAPTCHA###' => $this->form_wrapError('captcha', $pObj, $conf),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_ENTER_CODE###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code', $fromAjax),
					'###AJAXDATACONF###' =>  '&srcbcc=' . $conf['spamProtect.']['freecapBackgoundcolor'] . '&srctc=' . $conf['spamProtect.']['freecapTextcolor']
					 . '&srcnbc=' . $conf['spamProtect.']['freecapNumberchars'] . '&srch=' . $conf['spamProtect.']['freecapHeight'] . '&mtm=' . (10*round(microtime(true),1)),
					'###SR_FREECAP_CANT_READ###' => $this->pi_getLLWrap($pObj, 'pi1_template.captcha_cant_read', $fromAjax),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###THEMEPATH###' => 'css/themes/' . $conf['theme.']['selectedTheme'] . '/img',
			));
		}
		return '' ;
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
		if($_SESSION['formValidationErrors'][$field]) {
			$retstr=$_SESSION['formValidationErrors'][$field];
			if ($conf['requiredFields_errorWrap.']['dataWrap']) {
				$arrWrap=explode('|', $conf['requiredFields_errorWrap.']['dataWrap']);
				if (is_array($arrWrap)) {
					$arrWrapbegin = str_replace('{LLL:EXT:toctoc_comments/pi1/locallang.xml:error}',$this->pi_getLLWrap($pObj, 'error', true),$arrWrap[0] );
					$retstr=$arrWrapbegin . $_SESSION['formValidationErrors'][$field] .$arrWrap[1]  ;
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
	 * @param	[type]		$cmd: ...
	 * @param	int		$pid: pageid
	 * @param	[type]		$ref: ...
	 * @return	void
	 */
	protected function processBrowserSubmission($conf, $pObj, $piVars, $fromAjax, $cid, $cmd,$pid, $ref) {

			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}

			$rpp = intval($conf['advanced.']['commentsPerPage']);
			$rpp = ($rpp == 0 ? 1 : $rpp);

			$confmaxstepsbackbyolder = $conf['advanced.']['CommentsShowOldPerCID'];
			$maxstepsbackbyolder = $confmaxstepsbackbyolder *$rpp;

			if ($cmd=="browse"){
				if ($conf['advanced.']['reverseSorting']==1) {
					//print $pObj->startpoint . ', ' . $maxstepsbackbyolder;exit;
					if(($pObj->startpoint +$maxstepsbackbyolder)> $pObj->totalrows){
						$pObj->startpoint=$pObj->totalrows;
					}
					else{

						$pObj->startpoint = $pObj->startpoint + $maxstepsbackbyolder;
					}
				} else {
					if(($pObj->startpoint - $maxstepsbackbyolder)<0){
						$pObj->startpoint=0;
					}
					else{
						$pObj->startpoint = $pObj->startpoint - $maxstepsbackbyolder;
					}
				}

			} elseif ($cmd=="browsehide") {
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
		// Clear cache
			$cacheidlist= strval($pid); //;
			$pidList = t3lib_div::intExplode(',', $cacheidlist);

			t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');

			/* @var $tce t3lib_TCEmain */
			foreach ($pidList as $cpid) {
				if ($cpid != 0) {
					$tce->clear_cacheCmd($cpid);
				}
			}
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
	public function processSubmission($conf,$pObj,$piVars,$fromAjax,$feuserid,$pid,$lang) {

		if ($piVars['insert']=='insert') {

			$_SESSION['submitJustProcessed'] = '1';

			$lang=intval($lang);
			//print  $pObj->where . '<br>2: ' .  $pObj->where_dpck;
			$_SESSION['submittedCid'] = intval(trim($piVars['cid']));
			$cid= trim($piVars['cid']);
			$_SESSION['submitCommentVars'][$cid]['content'] = trim($piVars['content']);
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
			$_SESSION['submitCommentVars'][$cid]['uploadpicid'] = trim($piVars['uploadpicid']);
			$_SESSION['submitCommentVars'][$cid]['uploadpicheight'] = trim($piVars['uploadpicheight']);
			$_SESSION['submitCommentVars'][$cid]['descriptionbyuser'] = trim($piVars['descriptionbyuser']);
			$_SESSION['submitCommentVars'][$cid]['originalfilename'] = trim($piVars['originalfilename']);
			$this->newcommentid = 0;
			$newattachment_id =0;

			if (!($this->processSubmission_validate($piVars, $conf, $pObj,$fromAjax))) {
				$_SESSION['timeintensivedbaction'] = '1';
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
				$hidebecauseofCOI=0;
				if ($conf['spamProtect.']['confirmedOptIn'] ==1) {
					$hidebecauseofCOI=$this->checkCOI($conf, trim($piVars['email']), true);
				}
				$strCurrentIP = $this->getCurrentIp();
				$record = array(
						'pid' => intval($conf['storagePid']),
						'external_ref' => $external_ref,	// t3lib_loaddbgroup should be used but it is very complicated for FE... So we just do it with brute force.
						'external_prefix' => trim($conf['externalPrefix']),
						'firstname' => trim($piVars['firstname']),
						'lastname' => trim($piVars['lastname']),
						'email' => trim($piVars['email']),
						'hidden' => $hidebecauseofCOI,
						'gender' => intval(trim($piVars['gender'])),
						'location' => trim($piVars['location']),
						'homepage' => trim($piVars['homepage']),
						'content' => trim($piVars['content']),
						'external_ref_uid' => 'tt_content_' . trim($piVars['cid']),
						'remote_addr' => $strCurrentIP,
				);
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
							$record['attachment_subid'] = 0;
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
				// Check for double post
				$double_post_check = md5(implode(',', $record));
				if ($conf['preventDuplicatePosts']) {
					list($info) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_comments',
							$pObj->where_dpck . ' AND crdate>=' . (time() - 60*60) . ' AND double_post_check=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($double_post_check, 'tx_toctoc_comments_comments'));
				}
				else {
					$info = array('t' => 0);
				}
				if ($info['t'] > 0) {
					// Double post!

					$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'error.double.post', $fromAjax);
					unset($_SESSION['requestCapcha'][$cid]);
				} elseif ($_SESSION['requestCapcha'][$cid]>=1){
					//show and request captcha

					$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'pi1_template.captchaInputNeeded', $fromAjax);
				} else {
					$pObj->conf=$conf;
					$isSpam = $this->processSubmission_checkTypicalSpam($pObj, $conf, $piVars,$lang, $fromAjax);
					$cutOffPoint = $conf['spamProtect.']['spamCutOffPoint'] ? $conf['spamProtect.']['spamCutOffPoint'] : $isSpam + 1;
					if ($isSpam < $cutOffPoint) {
						$isApproved = 1;
						if (intval($conf['spamProtect.']['requireApproval']) == 1){
							$isApproved = 0;
						}
						// Add rest of the fields
						$record['crdate'] = $record['tstamp'] = time();
						$record['approved'] = $isApproved;
						$record['double_post_check'] = $double_post_check;
						if (($conf['attachments.']['usePicUpload'] ==1) || (intval($conf['attachments.']['usePdfUpload']) ==1 )) {
							if (trim($piVars['uploadpicid'])!='') {
								$record['attachment_id'] = $this->makeAttachementPicture(trim($piVars['uploadpicid']),$conf,trim($piVars['descriptionbyuser']),trim($piVars['originalfilename']), trim($piVars['firstname']), trim($piVars['lastname']),$record['toctoc_comments_user']);
								$newattachment_id = $record['attachment_id'];
							}
						}



						if (version_compare ( TYPO3_version, '4.6', '<' )) {
							t3lib_cache::initPageCache ();
							t3lib_cache::initPageSectionCache ();
						}

						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_comments', $record);
						$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
						// increase startpoint if set

						$_SESSION['submitCommentVars'][$cid]['uploadpicid']='';
						$_SESSION['submitCommentVars'][$cid]['uploadpicheight'] = 0;
						$_SESSION['submitCommentVars'][$cid]['descriptionbyuser'] = '';
						$_SESSION['submitCommentVars'][$cid]['originalfilename'] ='';

						$optinemail='';
						$optinip='';
						if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($hidebecauseofCOI==1)) {
							$optinemail=trim($piVars['email']);
							$optinip=$this->getCurrentIp();
						}
						// check the toctoc_comments_user
						$dataWhereStats = 'pid=' . intval($conf['storagePid']) .
						' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';
						$dataWhereStatsEnable = ' AND approved=1 AND deleted=0 AND hidden=0';

							$dataWhereuser = 'pid=' . intval($conf['storagePid']) .
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
												'optin_ip' =>$optinip,
												'comment_count' =>1,
										));
							}


							$sqlstr = 'SELECT COUNT(uid) AS nbrentries FROM tx_toctoc_comments_comments WHERE ' . $dataWhereStats . $dataWhereStatsEnable;
							$resultcount = mysql_query($sqlstr);
							$rowStats = mysql_fetch_array($resultcount);

							list($rowusrdata) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid,initial_firstname,initial_lastname,initial_email,initial_homepage,initial_location',
									'tx_toctoc_comments_user', $dataWhereuser);
							if (intval($rowusrdata['uid']) !== 0) {
								if($rowusrdata['initial_firstname']==='') {
									$strinitial_firstname='", initial_firstname="' . trim($piVars['firstname']);
								} else {
									$strinitial_firstname='';
								}
								if($rowusrdata['initial_lastname']==='') {
									$strinitial_lastname='", initial_lastname="' . trim($piVars['lastname']);
								} else {
									$strinitial_lastname='';
								}
								if($rowusrdata['initial_email']==='') {
									$strinitial_email='", initial_email="' . trim($piVars['email']);
								} else {
									$strinitial_email='';
								}
								if($rowusrdata['initial_homepage']==='') {
									$strinitial_homepage='", initial_homepage="' . trim($piVars['homepage']);
								} else {
									$strinitial_homepage='';
								}
								if($rowusrdata['initial_location']==='') {
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
									$strinitial_firstname . $strinitial_lastname . $strinitial_email . $strinitial_homepage . $strinitial_location . '", tstamp_lastupdate=' . time()  .
									' WHERE ' . $dataWhereStats );



						// Update reference index. This will show in theList view that someone refers to external record.
						$refindex = t3lib_div::makeInstance('t3lib_refindex');
						/* @var $refindex t3lib_refindex */
						$refindex->updateRefIndexTable('tx_toctoc_comments_comments', $newUid);
						$this->newcommentid = intval($newUid);
						// Insert URL (if exists)

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
									$this->enableFields('tx_toctoc_comments_urllog',$pObj));
							if (count($rows) == 0) {
								$record = array(
										'crdate' => time(),
										'tstamp' => time(),
										'pid' => intval($conf['storagePid']),
										'external_ref' => $external_ref,
										'external_ref_uid' =>  'tt_content_' . $piVars['cid'],
										'url' => $piVars['itemurl'],
								);
								$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_urllog', $record);
								$refindex->updateRefIndexTable('tx_toctoc_comments_urllog', $GLOBALS['TYPO3_DB']->sql_insert_id());
							}
							elseif ($rows[0]['url'] != $piVars['itemurl'] && !$this->isNoCacheUrl($piVars['itemurl'])) {
								$record = array(
										'tstamp' => time(),
										'url' => $piVars['itemurl'],
								);
								$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_urllog', 'uid=' . $rows[0]['uid'], $record);
							}
						}

						// Set cookies, but only for logged out users (protectioon of the data of
						//logged in users
						if ($feuserid===0) {
							foreach (array('firstname', 'lastname', 'email', 'location', 'homepage', 'gender') as $field) {
								setcookie($pObj->prefixId . '_' . $field, $piVars[$field], time() + 365*24*60*60, '/');
							}
						}
						$_SESSION['edgeTime'] = microtime(true);
						if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($hidebecauseofCOI==1)){
							$this->sendNotificationEmail($newUid, $isSpam, 'coi', $conf, $pObj, $fromAjax, $piVars, $pid,$fetoctocusertoinsert,$newattachment_id, $newattachment_subid,$optinemail);
						}

						// See what to do next
						if (!$isApproved){
							// Show message
							if (!$isApproved) {
								$pObj->formTopMessage .= $this->pi_getLLWrap($pObj, 'requires.approval', $fromAjax);
							}
							if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($hidebecauseofCOI==1)) {
								$pObj->formTopMessage .= '<br /><span class="txtc-coimsg">' . $this->pi_getLLWrap($pObj, 'requires.coi', $fromAjax) . '</span>';
							}
							$this->sendNotificationEmail($newUid, $isSpam, 'approve', $conf, $pObj, $fromAjax, $piVars, $pid,$fetoctocusertoinsert,$newattachment_id, $newattachment_subid,$optinemail);
							// Clear cache
							$cacheidlist= strval($pid);
							$pidList = t3lib_div::intExplode(',', $cacheidlist);

							t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
							$tce = t3lib_div::makeInstance('t3lib_TCEmain');

							/* @var $tce t3lib_TCEmain */
							foreach ($pidList as $cpid) {
								if ($cpid != 0) {
									$tce->clear_cacheCmd($cpid);
								}
							}
							unset($_SESSION['requestCapcha'][$cid]);
						} else {
							unset($_SESSION['requestCapcha'][$cid]);
							if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($hidebecauseofCOI==1)) {
								$pObj->formTopMessage .= '<span class="txtc-coimsg">' . $this->pi_getLLWrap($pObj, 'requires.coi', $fromAjax) . '</span>';
							}
// 							if ((trim($piVars['commentparentid']) !='') && (intval(trim($piVars['commentparentid']))==0)) {
// 								//only if on level 0
// 								if ($conf['advanced.']['reverseSorting'] ==0) {
// 									if (isset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'])) {
// 										//$_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex']=($_SESSION['commentListIndex']['cid' . $_SESSION['commentListRecord']]['startIndex'])+1;
// 									}
// 								}
// 							}

							// Call hook for custom actions (requested by Cyrill Helg)

							$pObj->conf=$conf;
							$piVarsrestore= $pObj->piVars;
							$pObj->piVars=$piVars;
							if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['processValidComment'])) {
								foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['processValidComment'] as $userFunc) {
									$params = array(
											'pObj' => &$pObj,
											'uid' => intval($newUid),
									);
									t3lib_div::callUserFunction($userFunc, $params, $pObj);
								}
							}
							$pObj->piVars=$piVarsrestore;

							if (strlen($conf['spamProtect.']['informationEmail']) > 0) {
								$this->sendNotificationEmail($newUid, $isSpam, 'info', $conf, $pObj, $fromAjax, $piVars, $pid,$fetoctocusertoinsert, $newattachment_id, $newattachment_subid,$optinemail);
							}

							// Clear cache of current page and additional pages
							$pidList = explode(',' , $this->getClearCacheIds($conf,$pid));
							t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
							$tce = t3lib_div::makeInstance('t3lib_TCEmain');

							/* @var $tce t3lib_TCEmain */
							foreach ($pidList as $cpid) {
								if ($cpid != 0) {
									$tce->clear_cacheCmd($cpid);
								}
							}
							//$this->resetSessionVars(0, false);
							//$pObj->formTopMessage='';
							$_SESSION['formTopMessage'] = $pObj->formTopMessage;

						}
					} else {
						// Spam cut off point reached
						$pObj->formTopMessage = $this->pi_getLLWrap($pObj, 'error_too_many_spam_points', $fromAjax) . ' (' . $isSpam . '/' . $cutOffPoint . ')';
					}
				}
			}

			if ($pObj->formTopMessage) {

				if ($pObj->formTopMessage!='') {
					$pObj->formTopMessage = $pObj->cObj->substituteMarkerArray(
							$pObj->cObj->getSubpart($pObj->templateCode, '###FORM_TOP_MESSAGE###'), array(
									'###MESSAGE###' => $pObj->formTopMessage,
									'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
									'###CID###' => trim($piVars['cid']),
									'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
							)
					);
					$_SESSION['formTopMessage'] = $pObj->formTopMessage;
				}
			}
			if (($_SESSION['formTopMessage']) || ($_SESSION['formValidationErrors']['errorcode'])) {
				// Clear cache only of current page
				$cacheidlist= strval($pid);
				$pidList = t3lib_div::intExplode(',', $cacheidlist);
				t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');

				/* @var $tce t3lib_TCEmain */
				foreach ($pidList as $cpid) {
					if ($cpid != 0) {
						$tce->clear_cacheCmd($cpid);
					}
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
	public function updateComment($conf,$pObj,$ctid,$content,$pid) {

		$piVsubs= array();
		$piVsubs['content']=$content;
		$lang=$_SESSION['activelangid'];
		$fromAjax=true;

		$strCurrentIP = $this->getCurrentIp();
		$record = array(
				'content' => trim(substr($piVsubs['content'],0,$conf['maxCommentLength'])),
				'remote_addr' => $strCurrentIP,
		);

		$pObj->conf=$conf;
		$isSpam = $this->processSubmission_checkTypicalSpam($pObj, $conf, $piVsubs,$lang, true);
		$cutOffPoint = $conf['spamProtect.']['spamCutOffPoint'] ? $conf['spamProtect.']['spamCutOffPoint'] : $isSpam + 1;
		if ($isSpam < $cutOffPoint) {
			$record['tstamp'] = time();
			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_toctoc_comments_comments', 'uid=' . $ctid, $record);


			// Clear cache
			// $cacheidlist= strval($pid);
			// $pidList = t3lib_div::intExplode(',', $cacheidlist);
			$pidList = explode(',' , $this->getClearCacheIds($conf,$pid));

			t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');

			/* @var $tce t3lib_TCEmain */
			foreach ($pidList as $cpid) {
				if ($cpid != 0) {
					$tce->clear_cacheCmd($cpid);
				}
			}
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
				$pObj->formTopMessage = $pObj->cObj->substituteMarkerArray(
						$pObj->cObj->getSubpart($pObj->templateCode, '###FORM_TOP_MESSAGE###'), array(
								'###MESSAGE###' => $pObj->formTopMessage,
								'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments')
						)
				);


				$outputstr= $pObj->formTopMessage;
			}
		}



		// Clear cache
		$cacheidlist= strval($pid);
		$pidList = t3lib_div::intExplode(',', $cacheidlist);

		t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');

		/* @var $tce t3lib_TCEmain */
		foreach ($pidList as $cpid) {
			if ($cpid != 0) {
				$tce->clear_cacheCmd($cpid);
			}
		}

		//Parse for Links and Smilies
		$this->smiliesPath = str_replace('EXT:toctoc_comments/','/' . t3lib_extMgm::siteRelPath('toctoc_comments'),$conf['smiliePath']);
		$this->smilies = $this->parseSmilieArray($conf['smilies.']);
		$content=htmlspecialchars($content);
		$contenttext = $this->applyStdWrap(nl2br($this->createLinks($content, $conf)), 'content_stdWrap', $conf, $pObj);
		$contenttext = $this->replaceSmilies($contenttext, $conf);
		$contenttext =$this->replaceBBs($contenttext, $conf,false);


		$outputstr .= $contenttext;
		return $outputstr;

	}
	/**
	 * Checks for typical spam scenarios
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	[type]		$lang: ...
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @param	[type]		$fromAjax: ...
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

			$testcontnt=	$piVars['content'];
			// \n in the fields where it cannot appear due to form definition
			foreach (array('firstname', 'lastname', 'email', 'homepage', 'location') as $key) {
				$points += (strpos($piVars[$key], chr(10)) !== false ? 1 : 0);
				if ($key != 'homepage') {
					$points += (strpos($piVars[$key], 'http://') !== false ? 1 : 0);
				}
				$testcontnt .=	',' . $piVars[$key];
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
					$this->enableFields('tx_toctoc_comments_spamwords',$pObj));

			if (count($rows) > 0) {
				foreach($rows as $key) {
					$points += (intval(count(explode($key['spamword'], $piVars['content'])))-1)*$key['spamvalue'];
				}
			}

		}
		$params = array(
				'pObj' => &$pObj,
				'formdata' => $piVars,
				'points' => $points,
		);

		if ($conf['spamProtect.']['useIPblocking']==1) {
			$points += $this->IPBlockSpamCheck($params, $pObj);
		}

		// External spam checkers
		if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['externalSpamCheck'])) {
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['externalSpamCheck'] as $_funcRef) {
				$params = array(
						'pObj' => &$pObj,
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
	 * @return	boolean		true, if form is ok.
	 */
	protected function processSubmission_validate($piVars, $conf, $pObj,$fromAjax) {
		// trim all
		foreach ($piVars as $key => $value) {
			$piVars[$key] = trim($value);
		}

		// Check required fields first

		$requiredFields = t3lib_div::trimExplode(',', $conf['requiredFields'], true);
		$errfound= false;
		foreach ($requiredFields as $field) {
			if (!$piVars[$field]) {
				$_SESSION['formValidationErrors'][$field] = $this->pi_getLLWrap($pObj, 'error.required.field', $fromAjax);
				$_SESSION['formValidationErrors']['errorcode'] = '12';
				$errfound= true;

			}
		}
		// Validate e-mail
		if ($piVars['email'] && !t3lib_div::validEmail($piVars['email'])) {
			$_SESSION['formValidationErrors']['email'] = $this->pi_getLLWrap($pObj, 'error.invalid.email', $fromAjax);
			$_SESSION['formValidationErrors']['errorcode'] = '13';
			$errfound= true;

		}
		if ($piVars['email'] == 'badmailadress@nosite.net') {
			$_SESSION['formValidationErrors']['email'] = $this->pi_getLLWrap($pObj, 'error.invalid.useremail', $fromAjax);
			$_SESSION['formValidationErrors']['errorcode'] = '14';
			$errfound= true;
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
	 * @param	[type]		$fetoctocusertoinsert: ...
	 * @param	[type]		$attachment_id: ...
	 * @param	[type]		$attachment_subid: ...
	 * @param	[type]		$optinemail: ...
	 * @return	void
	 */
	public function sendNotificationEmail($uid, $points, $action, $conf, $pObj, $fromAjax, $piVars, $pid,$fetoctocusertoinsert,$attachment_id=0 ,$attachment_subid=0, $optinemail='') {
		if (($fromAjax)) {
			$language = &$GLOBALS['LANG'];
			$lang = $GLOBALS['LANG']->lang;
		}
		else {
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
		$attachmentinfoHTML='';
		if ($attachment_id != 0) {
			$attachmentinfoHTML= $this->commentShowWebpagepreview ($attachment_id,$attachment_subid,$conf,$pObj,$uid,false, $fromAjax, array(), true);
			if ($attachmentinfoHTML=='') {
				$attachmentinfoHTML= $this->pi_getLLWrap($pObj, 'email.attachment_mmnotfounderror', $fromAjax) . ' ' . $attachment_id;
			}
		} else {
			$attachmentinfoHTML = $this->pi_getLLWrap($pObj, 'email.noattachmentforcomment', $fromAjax);
		}
		if ($attachmentinfoHTML!='') {
			if (!$conf['HTMLEmail']) {
				$attachmentinfoHTML = $this->pi_getLLWrap($pObj, 'email.commenthasattachment', $fromAjax);
			}
		}



		$clearCacheIds = $this->getClearCacheIds($conf,$pid);
		$check = md5($uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);

		if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($optinemail!='')) {
			if ($conf['HTMLEmail']) {
				$confencarrcoi =array(
						'advanced.' => array(
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
						),
						'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
						'pageURL' => $_SESSION['commentsPageIds'][$pid],
						'storagePid' => $conf['storagePid'],
						'HTMLEmail' => $conf['HTMLEmail'],
						'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
						'aP' => $conf['recentcomments.']['anchorPre'],
						'optinemail' => $optinemail,
						'optin_ip' => t3lib_div::getIndpEnv('REMOTE_ADDR'),

				);
			} else {
				$confencarrcoi =array(
						'advanced.' => array(
								'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
						),
						'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
						'pageURL' => $_SESSION['commentsPageIds'][$pid],
						'storagePid' => $conf['storagePid'],
						'HTMLEmail' => $conf['HTMLEmail'],
						'aP' => $conf['recentcomments.']['anchorPre'],
						'optinemail' => $optinemail,
						'optin_ip' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
				);
			}

			$confenccoi = rawurlencode(base64_encode(serialize($confencarrcoi)));


		}

		if ($conf['HTMLEmail']) {
			$confencarr =array(
					'advanced.' => array(
							'notificationForCommentatorEmail' => $conf['advanced.']['notificationForCommentatorEmail'],
							'notificationForCommentatorHTMLEmailTemplate' => $conf['advanced.']['notificationForCommentatorHTMLEmailTemplate'],
							'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
					),
					'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
					'pageURL' => $_SESSION['commentsPageIds'][$pid],
					'storagePid' => $conf['storagePid'],
					'HTMLEmail' => $conf['HTMLEmail'],
					'HTMLEmailFontFamily' => $conf['HTMLEmailFontFamily'],
			);
		} else {
			$confencarr =array(
					'advanced.' => array(
							'notificationForCommentatorEmail' => $conf['advanced.']['notificationForCommentatorEmail'],
							'notificationForCommentatorEmailTemplate' => $conf['advanced.']['notificationForCommentatorEmailTemplate'],
							'eIDHTMLTemplate' => $conf['advanced.']['eIDHTMLTemplate'],
					),
					'pageTitle' => $_SESSION['commentsPageTitles'][$pid],
					'pageURL' => $_SESSION['commentsPageIds'][$pid],
					'storagePid' => $conf['storagePid'],
					'HTMLEmail' => $conf['HTMLEmail'],
			);
		}

		$confenc = rawurlencode(base64_encode(serialize($confencarr)));

		$approvelinkcoi = '';
		$seperatorchar = '\\n';
		if ($conf['HTMLEmail']) {
			$seperatorchar = '<br />';
			$approvelink = '<b><a class="approvelink" href="'  . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) .
						'&cmd=approve&confenc=' . $confenc) . '">' . $this->pi_getLLWrap($pObj, 'email.textapprovecomment', $fromAjax) .'</a></b>';
			$approvelinkcoi = '<b><a class="approvelink" href="'  . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) .
						'&cmd=approvecoi&confenc=' . $confenccoi) . '">' . $this->pi_getLLWrap($pObj, 'email.textapprovecoicomment', $fromAjax) .'</a></b>';
			$deletelink = '<a href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=delete&confenc=' . $confenc) . '">' . $this->pi_getLLWrap($pObj, 'email.textdeletecomment', $fromAjax)  . '</a>';
			$killlink = ' | <a href="' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=kill&confenc=' . $confenc) . '">' . $this->pi_getLLWrap($pObj, 'email.textkillcomment', $fromAjax)  . '</a>';

		} else {
			$approvelink = $this->pi_getLLWrap($pObj, 'email.textapprovecomment', $fromAjax)  . ' ' .
							t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) .
							'&cmd=approve&confenc=' . $confenc);
			$approvelinkcoi = $this->pi_getLLWrap($pObj, 'email.textapprovecoicomment', $fromAjax)  . ' ' .
							t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) .
							'&cmd=approvecoi&confenc=' . $confenccoi);

			$deletelink = $this->pi_getLLWrap($pObj, 'email.textdeletecomment', $fromAjax)  . ' ' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=delete&confenc=' . $confenc);
			$killlink = $this->pi_getLLWrap($pObj, 'email.textkillcomment', $fromAjax)  . ' ' . t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&lng=' . $lang . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=kill&confenc=' . $confenc);

		}
		$userinfo ='';
		$requiredFields = t3lib_div::trimExplode(',', $conf['requiredFields'], true);
		$userinfo .= ($piVars['firstname']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.first_name', $fromAjax)  . ' ' . $piVars['firstname'] . $seperatorchar : '';
		$userinfo .= ($piVars['lastname']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax)  . ' ' . $piVars['lastname'] . $seperatorchar : '';
		$userinfo .= ($piVars['email']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax)  . ' ' . $piVars['email'] . $seperatorchar : '';
		$userinfo .= ($piVars['location']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax)  . ' ' . $piVars['location'] . $seperatorchar : '';
		$userinfo .= ($piVars['homepage']!='') ? $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax)  . ' ' . $piVars['homepage'] . $seperatorchar : '';

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];

		//now, now, now we get the user-infos so the admin knows bit more about the commentator
		$infoleft='';

		if (($conf['spamProtect.']['confirmedOptIn'] ==1) && ($optinemail!='')) {
			if ($conf['HTMLEmail']) {
				$infoleft='<b>' . $this->pi_getLLWrap($pObj, 'pi1_template.informationaboutyou', $fromAjax) . '</b><br />' . $this->getUserCard('',$fetoctocusertoinsert,$conf,$pObj,$uid);
				$URLinfo =  $this->pi_getLLWrap($pObj, 'email.textnewcoi', $fromAjax) . ' ' . $_SESSION['commentsPageIds'][$pid]  . '.<br /> ' . $this->pi_getLLWrap($pObj, 'email.textemailrequiresyourconfirmation', $fromAjax);
			} else {
				$URLinfo =  $this->pi_getLLWrap($pObj, 'email.textnewcoi', $fromAjax) . ' ' . $_SESSION['commentsPageIds'][$pid]  . '. ' . $this->pi_getLLWrap($pObj, 'email.textemailrequiresyourconfirmation', $fromAjax);

			}
			if ($conf['HTMLEmail']) {
				$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplatecoiHTML']);

			} else {
				$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplatecoi']);
			}
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
			if ($fromAjax) {
				$template = @file_get_contents(PATH_site . $usetemplateFile);
			} else {
				$template = $pObj->cObj->fileResource($usetemplateFile);
			}
			$markers = array(
					'###URL###' =>  $URLinfo,
					'###USER###' => $userinfo,
					'###CONTENT###' =>  $piVars['content'],
					'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax) ,
					'###APPROVE_LINK###' => $approvelinkcoi,
					'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.coiemail', $fromAjax),
					'###INFOSLEFT###'  => $infoleft,
					'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					'###MYHOMEPAGE###'  => $myhomepagelink,
					'###MYHOMEPAGELINK###'  => $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''),'ATagParams' => 'rel="nofollow"',)),
					'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
					'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					'###ATTACHMENT###'  => $attachmentinfoHTML,
			);
			$content = $pObj->cObj->substituteMarkerArray($template, $markers);
			$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - Administrator';
			if (t3lib_div::validEmail($optinemail) && t3lib_div::validEmail($fromEmail)) {
				if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
					self::send_mail($optinemail,  $this->pi_getLLWrap($pObj, 'email.subjectcoi', $fromAjax), '', $content, $conf['spamProtect.']['fromEmail'], $sendername);
				} else {		// ... else just plain text...
					t3lib_div::plainMailEncoded($optinemail, $this->pi_getLLWrap($pObj, 'email.subjectcoi', $fromAjax), $content, 'From: ' . $conf['spamProtect.']['fromEmail']);
				}
			}
		}


		if (($action=='approve') ||  ($action=='info')) {
			if (t3lib_div::validEmail($toEmail) && t3lib_div::validEmail($fromEmail)) {

				if ($conf['HTMLEmail']) {
					$infoleft='<b>' . $this->pi_getLLWrap($pObj, 'pi1_template.informationaboutcommentator', $fromAjax) . '</b><br />' . $this->getUserCard('',$fetoctocusertoinsert,$conf,$pObj,$uid);
				}
				if ($action == 'info') {
					if ($conf['HTMLEmail']) {
						$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplateHTML']);

					} else {
						$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplateInfo']);
					}
					$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
					if ($fromAjax) {
						$template = @file_get_contents(PATH_site . $usetemplateFile);
					} else {
						$template = $pObj->cObj->fileResource($usetemplateFile);
					}
					$markers = array(
							'###URL###' =>  $this->pi_getLLWrap($pObj, 'email.textnewcomment', $fromAjax) . ' ' . $_SESSION['commentsPageIds'][$pid]  . '. ' . $this->pi_getLLWrap($pObj, 'email.textnotrequiresyourapproval', $fromAjax) . '. '  ,
							'###POINTS###' => $this->pi_getLLWrap($pObj, 'email.textitgot', $fromAjax)  . ' ' . $points  . ' ' . $this->pi_getLLWrap($pObj, 'email.textspampoints', $fromAjax) . '. ',
							'###USER###' => $userinfo,
							'###CONTENT###' =>  $piVars['content'],
							'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax) ,
							'###REMOTE_ADDR###' => $this->pi_getLLWrap($pObj, 'email.textpostedfromip', $fromAjax)  . ' ' . t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'###DELETE_LINK###' => $deletelink,
							'###KILL_LINK###' => $killlink,
							'###APPROVE_LINK###' => '',
							'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.notificationemail', $fromAjax),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###MYHOMEPAGELINK###'  => $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''),'ATagParams' => 'rel="nofollow"',)),
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###ATTACHMENT###'  => $attachmentinfoHTML,
					);
				} else {
					if ($conf['HTMLEmail']) {
						$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplateHTML']);

					}else {
						$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplate']);
					}
					$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
					if ($fromAjax) {
						$template = @file_get_contents(PATH_site . $usetemplateFile);
					} else {
						$template = $pObj->cObj->fileResource($usetemplateFile);
					}



					$markers = array(
							'###URL###' =>  $this->pi_getLLWrap($pObj, 'email.textnewcomment', $fromAjax) . ' ' . $_SESSION['commentsPageIds'][$pid]  . '. ' . $this->pi_getLLWrap($pObj, 'email.textrequiresyourapproval', $fromAjax) . '. ',
							'###POINTS###' => $this->pi_getLLWrap($pObj, 'email.textitgot', $fromAjax)  . ' ' . $points  . ' ' . $this->pi_getLLWrap($pObj, 'email.textspampoints', $fromAjax) . '. ',
							'###USER###' => $userinfo,
							'###CONTENT###' =>  $piVars['content'],
							'###TEXTCONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax) ,
							'###REMOTE_ADDR###' => $this->pi_getLLWrap($pObj, 'email.textpostedfromip', $fromAjax)  . ' ' . t3lib_div::getIndpEnv('REMOTE_ADDR'),
							'###APPROVE_LINK###' => $approvelink,
							'###DELETE_LINK###' => $deletelink,
							'###KILL_LINK###' => $killlink,
							'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
							'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.approvalemail', $fromAjax),
							'###INFOSLEFT###'  => $infoleft,
							'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###MYHOMEPAGE###'  => $myhomepagelink,
							'###MYHOMEPAGELINK###'  => $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''),'ATagParams' => 'rel="nofollow"',)),
							'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
							'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
							'###ATTACHMENT###'  => $attachmentinfoHTML,
					);
				}


				// Call hook for custom markers
				$pObj->conf=$conf;
				$params = array(
						'pObj' => &$pObj,
						'template' => $template,
						'check' => $check,
						'markers' => $markers,
						'uid' => $uid
				);
				if (is_array($tempMarkers = $this->sendNotificationIPBlock($params, $pObj))) {
							$markers = $tempMarkers;
				}

				if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['sendNotificationMail'])) {
					foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['sendNotificationMail'] as $userFunc) {
						$params = array(
								'pObj' => &$pObj,
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

				$blockanddeletelink = $this->pi_getLLWrap($pObj, 'email.textdeleteblock', $fromAjax) ;
				$blockandkilllink = $this->pi_getLLWrap($pObj, 'email.textkillblock', $fromAjax);

				$markers['###DELETE_LINK_AND_BLOCK###'] = str_replace($this->pi_getLLWrap($pObj, 'email.textdeletecomment', $fromAjax),'', $markers['###DELETE_LINK_AND_BLOCK###'] );
				$markers['###KILL_LINK_AND_BLOCK###'] = str_replace($this->pi_getLLWrap($pObj, 'email.textkillcomment', $fromAjax),'', $markers['###KILL_LINK_AND_BLOCK###'] );
				if ($conf['HTMLEmail']) {
					$markers['###DELETE_LINK_AND_BLOCK###'] = str_replace('"></a>','',$markers['###DELETE_LINK_AND_BLOCK###']);
					$markers['###KILL_LINK_AND_BLOCK###'] = str_replace('"></a>','',$markers['###KILL_LINK_AND_BLOCK###']);
					$markers['###DELETE_LINK_AND_BLOCK###'] = ' | ' . $markers['###DELETE_LINK_AND_BLOCK###'] . '">' . $blockanddeletelink . '</a>';
					$markers['###KILL_LINK_AND_BLOCK###'] = $markers['###KILL_LINK_AND_BLOCK###']. '">' . $blockandkilllink . '</a>';
					$markers['###KILL_LINK###'] = str_replace('|', '',$markers['###KILL_LINK###']);
					$markers['###KILL_LINK###'] ='| ' . $markers['###KILL_LINK###'];
					$markers['###DELETE_LINK###'] = str_replace('|', '',$markers['###DELETE_LINK###']);
				} else {
					$markers['###DELETE_LINK_AND_BLOCK###'] = $blockanddeletelink . $markers['###DELETE_LINK_AND_BLOCK###'];
					$markers['###KILL_LINK_AND_BLOCK###'] = $blockandkilllink . $markers['###KILL_LINK_AND_BLOCK###'];

				}

				if (t3lib_extMgm::isLoaded('comments_response')) {
					//post-handle response to the comment:
					$strrespondlink=$this->pi_getLLWrap($pObj, 'email.textresponsetothecomment', $fromAjax);
					if (trim($markers['###RESPOND_LINK###']) !='') {
						if ($conf['HTMLEmail']) {
							$strrespondlink=str_replace(':','',$strrespondlink);
							$markers['###RESPOND_LINK###'] = '<br /><a rel="nofollow" href="' . $markers['###RESPOND_LINK###'] . '">' . $strrespondlink . '</a>';

						} else {
							$markers['###RESPOND_LINK###'] = '\\n' . $strrespondlink . ' ' . $markers['###RESPOND_LINK###'];
						}
					}
				} else {
					$markers['###RESPOND_LINK###'] = '';
				}
				if ((intval($conf['advanced.']['adminCommentResponse']) ===0)) {
					$markers['###RESPOND_LINK###'] = '';
				}

				$content = $pObj->cObj->substituteMarkerArray($template, $markers);
				$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - toctoc_comments Administrator';
				if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email

					self::send_mail($toEmail,  $this->pi_getLLWrap($pObj, 'email.subject', $fromAjax), '', $content, $conf['spamProtect.']['fromEmail'], $sendername);
				} else {		// ... else just plain text...
					t3lib_div::plainMailEncoded($toEmail, $this->pi_getLLWrap($pObj, 'email.subject', $fromAjax), $content, 'From: ' . $conf['spamProtect.']['fromEmail']);
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
		//print 'in f' . $optinemail . ' ';
		//$rowusr=array();
		$rowusr = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'tx_toctoc_comments_user', $dataWhereuser);
		if (count($rowusr) > 0) {
			//print_r ($rowusr);
			$ttusersarr=array();
			$tt=0;
			$firstcrdate=$rowusr[0]['crdate'] ;
			$ttusersarr[0] = $rowusr[0]['toctoc_comments_user'];
			// get toctoc_user_ids and first crdate to compare with comments
			for ($i=0;$i<count($rowusr);$i++){
				if ($ttusersarr[$tt] != $rowusr[$i]['toctoc_comments_user'] ){
					$tt++;
					$ttusersarr[$tt] = $rowusr[$i]['toctoc_comments_user'];
				}
				if ($firstcrdate > $rowusr[$i]['crdate'] ){
					$firstcrdate = $rowusr[$i]['crdate'];
				}

			}

			$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' .
					'optindate=' .  time() .
					', optin_ip="' . $strCurrentIP .
					'", tstamp_lastupdate=' . time()  .
					' WHERE ' . $dataWhereuser );

			if (count($ttusersarr)==1) {
				// 99% of all cases
				$userlist = '= "' . $ttusersarr[0] .'"';
			} else {
				$userlist = 'IN ("' . implode('", "',$ttusersarr) .'")';
			}
			$dataWhereComments='pid=' . intval($conf['storagePid']) .
			' AND hidden=1 AND deleted=0 AND toctoc_comments_user ' . $userlist . ' AND crdate >= ' . $firstcrdate;
			$rowcmts = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_comments', $dataWhereComments, '', 'crdate');
			//check if already approved
			//print 'in f   ' . $dataWhereComments . ' '; exit;
			$approved=0;
			$linkto_comment_id=array(); 			;
			if (count($rowcmts) > 0) {
				for ($i=0;$i<count($rowcmts);$i++){
					if ($approved != $rowcmts[$i]['approved'] ){
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
		return false;
	}

	/**
	 * Checks if confirmed email optin is needed for a given email and IP
	 *
	 * @param	[type]		$conf:
	 * @param	string		$email: email to check
	 * @param	boolean		$checkip: if IP needs to be checked
	 * @return	boolean		true if coi is needed
	 */
	protected function checkCOI($conf,$email,$checkip=true) {
		$strCurrentIP = $this->getCurrentIp();

		$optin_ip='';
		if ($checkip) {
			$optin_ip = 'AND optin_ip="' . $strCurrentIP . '"';
		}
		$dataWhereuser = 'pid=' . intval($conf['storagePid']) .
		' AND deleted=0 AND optin_email = "' . $email . '" AND optindate >0 ' . $optin_ip;
		//print $dataWhereuser; exit;
		$rowusr = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
				'tx_toctoc_comments_user', $dataWhereuser);
		if (count($rowusr) > 0) {
			//made optin from currentIP if $checkip=true, else IP does not matter
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
	 * @param	array		$$conf: plugin configuration
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
			$textout= preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" class="tx-tc-external-autolink">\1</a>', $text);
			$textout= str_replace('." rel="nofollow"','" rel="nofollow"',$textout);
			$textout= str_replace('," rel="nofollow"','" rel="nofollow"',$textout);
			$textout= str_replace(',</a>','</a>,',$textout);
			$textout= str_replace('.</a>','</a>.',$textout);
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
	protected function applyStdWrap($text, $stdWrapName, $conf = null, $pObj = null) {
		$retstr=$text;
		if (is_array($conf[$stdWrapName . '.'])) {
			if ($conf[$stdWrapName. '.']['wrap']) {
				$arrWrap=explode('|', $conf[$stdWrapName. '.']['wrap']);
				if (is_array($arrWrap)) {
					$retstr=$arrWrap[0] . $text .$arrWrap[1]  ;
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
						'pObj' => &$pObj,
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
	 * @return	boolean		true if URL is "no_cache" URL
	 */
	protected function isNoCacheUrl($url) {
		$parts = parse_url($url);
		// Brute force
		if (preg_match('/(^|&)no_cache=1/', $parts['query'])) {
			return true;
		}
		// Ideally we should have checked for alternative methods but they require TSFE
		// to be passed and therefore corrupted. So we do not do it now until we discover
		// how to make it without corrupting TSFE.
		return false;
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
		$content = $pObj->cObj->substituteMarkerArray($template, $markers);
		if (count($subparts) > 0) {
			foreach ($subparts as $name => $subpart) {
				$content = $pObj->cObj->substituteSubpart($content, $name, $subpart);
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
	 * @return	boolean		true
	 */
	public function resetSessionVars($resetcontext, $alsoajaxvar = true) {
		if ($resetcontext==0) {
			// quite total init
			$_SESSION['commentListCount'] = 0;

			$_SESSION['commentListRecord']= 0;
			$_SESSION['indexOfSortedCommentsCidList'] = 0;
			$_SESSION['edgeTime'] = microtime(true);
			$_SESSION['commentsPageId'] =$GLOBALS['TSFE']->id;
			$_SESSION['submittedCid'] = 0;
			if ($alsoajaxvar) {
				$_SESSION['AJAXCid'] = 0;
				$_SESSION['AJAXCidC'] = 0;
				$_SESSION['AJAXCidImg'] = 0;
				$_SESSION['AJAXimages'] = array();
			}
			$_SESSION['submitJustProcessed'] = '0';
			$_SESSION['formTopMessage'] = '';
			$_SESSION['formValidationErrors'] = array();
			$_SESSION['submitCommentVars'] = array();
		} elseif ($resetcontext==1) {
			// remind that submit has been processed
			$_SESSION['submitJustProcessed'] = '1';
		} elseif ($resetcontext==2) {
			// reset the time after a active db operation (LEGACY)
			$_SESSION['edgeTime'] = microtime(true);
		} elseif ($resetcontext==3) {
			// reset all a part from submitted stuff
			$_SESSION['commentListCount'] = 0;
			$_SESSION['commentListRecord']= 0;

			$_SESSION['indexOfSortedCommentsCidList'] = 0;
			$_SESSION['edgeTime'] = microtime(true);
			if ($GLOBALS['TSFE']->id) {
				$_SESSION['commentsPageId'] =$GLOBALS['TSFE']->id;
			}
		}
		return true;
	}

	/*
	 * Returns a list of pageids on which cache should be cleared.
	*
	* @return string
	*/
	public function getClearCacheIds($conf, $pid = 0) {
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
		if (!empty($additionalClearCachePages)) {
			if ($clearCacheIds !=0) {
				$clearCacheIds .= ',' . $additionalClearCachePages;
			} else {
				$clearCacheIds = $additionalClearCachePages;
			}
		}
		if ($_SESSION['commentsPageOrigId']!=0) {
			if ($clearCacheIds !=0) {
				$clearCacheIds .= ',' . $_SESSION['commentsPageOrigId'];
			} else {
				$clearCacheIds = $_SESSION['commentsPageOrigId'];
			}
		}
		return $clearCacheIds . '';
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
	 * @return	array		...
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
	public function replaceSmilies($content,$conf) {
		foreach ($this->smilies as $path => $smilieArray) {
			foreach ($smilieArray as $smilie) {
				$image = '<img alt="' . $smilie . '" title="' . $smilie
				. '" src="' . $this->smiliesPath . '/' . $path . '.' . $conf['fileExt'] . '" />';
				$content = str_replace($smilie, $image, $content);
			}
		}
		return $content;
	}
	/**
	 * Replaces Smilies with img-HTML-Tag
	 *
	 * @param	string		$content: content
	 * @param	object		$pObj: parent object
	 * @param	[type]		$purge: ...
	 * @return	string		HTML
	 */
	public function replaceBBs($content,$conf,$purge=false) {

		$this->BBs=array (
			array('[b]','<b>'),
			array('[/b]','</b>'),
			array('[i]','<i>'),
			array('[/i]' ,'</i>'),
			array('[code]','<code>'),
			array('[/code]','</code>'),

		);

			for ($i=0;$i<count($this->BBs);$i++) {
				if (($purge==true)) {
					$content = str_replace($this->BBs[$i][0], '', $content);
				}	else {
					$content = str_replace($this->BBs[$i][0], $this->BBs[$i][1], $content);

				}
			}
			//$content = str_replace("&", "", $content);
			if ($this->allowHTMLTagsInComments) {
				$content=implode('<',explode("&amp;lt;",$content));
				$content=implode('>',explode('&amp;gt;',$content));
				$content=implode("='",explode('=&quot;',$content));
				$content=implode("'>",explode('&quot;>',$content));
			} else {
				$content=implode('&lt;',explode("&amp;lt;",$content));
				$content=implode('&gt;',explode('&amp;gt;',$content));
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
	 * @return	string		HTML
	 */
	protected function getAjaxJSData($feuserid, $pid, $languagecode, $conf, $pObj, $cid, $fromAjax, $dataonly=false) {

		if (($_SESSION['AJAXCid'] != $cid) || ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid);
				$ajaxDataAttachments = $this->getAjaxDataAttachments($conf,$fromAjax,$pObj);
			} else {
				$ajaxData =$_SESSION['ajaxData'];
				$ajaxDataAttachments =$_SESSION['ajaxDataAttachments'];
			}

			$jsAjaxData = '	<script type="text/javascript">';
			$jsAjaxData .= "var commentsAjaxData" . $cid . " = '" . rawurlencode($ajaxData) . "'; var commentsAjaxDataAtt" . $cid . " = '" . rawurlencode($ajaxDataAttachments) . "';</script>";
			if ($dataonly) {
				$jsAjaxData =rawurlencode($ajaxData);
			}

			$_SESSION['AJAXCid'] = $cid;
			if (!$fromAjax) {
				$_SESSION['ajaxData'] = $ajaxData;
				$_SESSION['ajaxDataAttachments'] = $ajaxDataAttachments;
			}

			return $jsAjaxData;
		}
		else {
			return '';
		}
	}
	/**
	 * Returns AJAXData
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: storagePid
	 * @param	int		$languagecode: ID of the language
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	int		$cid: ID of the content element
	 * @return	string		base64-encoded
	 */
	protected function getAjaxData($feuserid, $pid, $languagecode, $conf, $cid) {
		unset($confCopy);
		$confCopy = $conf;

		// this would generate a too long string for unserialize
		unset($confCopy['attachments.']);
		unset($confCopy['recentcomments.']);
		$confCopy['attachments.'] = array();
		// we take useWebpagePreview and webpagePreviewHeight, they are needed on and for submits
		$confCopy['attachments.']['webpagePreviewHeight'] = $conf['attachments.']['webpagePreviewHeight'];
		$confCopy['attachments.']['useWebpagePreview'] = $conf['attachments.']['useWebpagePreview'];
		// we take zhis also for the top preview
		$confCopy['attachments.']['useTopWebpagePreview'] = $conf['attachments.']['useTopWebpagePreview'];
		$confCopy['attachments.']['topWebpagePreviewPicture'] = $conf['attachments.']['topWebpagePreviewPicture'];
		// we take zhis for displaying uploadfeatures
		$confCopy['attachments.']['usePicUpload'] = $conf['attachments.']['usePicUpload'];
		$confCopy['attachments.']['usePdfUpload'] = $conf['attachments.']['usePdfUpload'];
		// need this for coi
		$confCopy['recentcomments.']['anchorPre'] = $conf['recentcomments.']['anchorPre'];

		unset($confCopy['userFunc']);
		if (!$feuserid){$feuserid=0;}

		$data = serialize(array(
				'feuser' => $feuserid,
				'pid' => $pid,
				'cid' => $cid,
				'conf' => $confCopy,
				'lang' => $languagecode,
		));
// 		$retdata= base64_encode($data);
// 		$dataarr= unserialize(base64_decode($retdata));
		return base64_encode($data);
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
	protected function getAjaxDataAttachments($conf,$fromAjax,$pObj) {
		unset($confCopy);
		$confCopy = $conf['attachments.'];
		unset($confCopy['userFunc']);
		$data = serialize(array(
				'conf' => $confCopy,
				'awaitgoogle' => $this->pi_getLLWrap($pObj, 'pi1_template.awaitgoogle', $fromAjax),
				'txtimage' => $this->pi_getLLWrap($pObj, 'pi1_template.txtimage', $fromAjax),
				'txtimages' => $this->pi_getLLWrap($pObj, 'pi1_template.txtimages', $fromAjax),
		));
		return base64_encode($data);
	}

	/**
	 * Returns AJAX Data Images Javascript
	 *
	 * @param	int		$cid: Content element ID
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @return	string		HTML
	 */
	protected function getAjaxJSDataCommentImgs($cid, $pObj,$fromAjax) {
		if (($_SESSION['AJAXCidImg'] !== $cid)|| ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxDataImgs();
			} else {
				$ajaxData =$_SESSION['ajaxDataImg'];
			}

			$rudata=rawurlencode($ajaxData);

			$jsAjaxData = '	<script type="text/javascript">';
			$jsAjaxData .= 'var commentsAjaxDataImg' . $cid ;
			$jsAjaxData .= " = '" . $rudata . "';";
			$jsAjaxData .= "</script>";

			if (!$fromAjax) {
				$_SESSION['AJAXCidImg'] = $cid;
				$_SESSION['ajaxDataImg'] = $ajaxData;
			}
			return $jsAjaxData;
		}
		else {
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
	protected function getAjaxJSDataComments($cid,$pObj,$fromAjax) {

		if (($_SESSION['AJAXCidC'] !== $cid)|| ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxDataComments($pObj, $cid);
			} else {
				$ajaxData =$_SESSION['ajaxDataC'];
			}

			$rudata=rawurlencode($ajaxData);

			$jsAjaxData = '	<script type="text/javascript">';

			$jsAjaxData .= 'var commentsAjaxDataC' . $cid ;
			$jsAjaxData .= " = '';";

			$jsAjaxData .= ' var commentsAjaxThisData' . $cid ;
			$jsAjaxData .= " = '" . $rudata . "';";
			$jsAjaxData .= "</script>";

			$_SESSION['AJAXCidC'] = $cid;
			if (!$fromAjax) {
				$_SESSION['ajaxDataC'] = $ajaxData;
			}
			return $jsAjaxData;
		}
		else {
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
	protected function getAjaxDataComments($pObj, $cid) {


		$data = serialize(array(
				'externalUid' => $pObj->externalUid,
				'showUidParam' => $pObj->showUidParam,
				'foreignTableName' => $pObj->foreignTableName,
				'where' => $pObj->where,
				'widthExtCapcha' => $pObj->widthExtCapcha,
				'tERROR_CAPCHA' => $pObj->tERROR_CAPCHA,
				'where_dpck' => $pObj->where_dpck,
		));
		return base64_encode($data);
	}

	/**
	 * Returns AJAXData for images
	 *
	 * @return	string		base64-encoded
	 */
	protected function getAjaxDataImgs() {



		$data = serialize($this->AJAXimages);
		return base64_encode($data);
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
	 * @return	boolean		true if item url is valid
	 */
	public function hasValidItemUrl($piVars) {
		$piVars['itemurl'] = trim($piVars['itemurl']);
		if (!$piVars['itemurl']) {
			return false;
		}
		if (!preg_match('/^https?:\/\//', $piVars['itemurl'])) {
			return false;
		}
		if ($pObj->piVars['itemurlchk'] != md5($piVars['itemurl'] . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'])) {
			return false;
		}
		return true;
	}



	/**
	 * Retrieves default configuration of a plugin, by default toctoc_comments.
	 * Uses plugin.toctoc_ratings_pi1 from page TypoScript template
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
	 * Checks if IE is HTML5 compatible
	 *
	 * @return	boolean		true if HTML5 compatible IE
	 */
	protected function ae_detect_ie()
	{
		if (isset($_SERVER['HTTP_USER_AGENT']) && ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) || (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 1') === true))) {
			return true;
		} else{
			return false;
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
	public function getRatingDisplay($ref, $conf = null, $fromAjax = 0, $pid=0, $returnasarray = false, $feuserid = 0, $cmd = 'vote',
			$pObj = null, $cid, $fromcomments,$commentspics = array()) {

		// Get template
		if (is_null($conf)) {
			$conf = $this->getDefaultConfig();
		}

		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['ratings.']['ratingsTemplateFile']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);

		if (!$fromAjax) {
		// Normal call
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$pObj->conf['ratings.']['ratingsTemplateFile']);
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
			$template = $pObj->cObj->fileResource($usetemplateFile);

		} else {
		// Called from ajax
			$template = @file_get_contents(PATH_site . $usetemplateFile);
		}
		if (!$template) {
			t3lib_div::devLog('Unable to load template code from "' . $usetemplateFile . '"', 'toctoc_comments', 3);
			return '';
		}
		if (!$fromAjax) {
			$html =  $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments, $commentspics);
		} else {
			$html =  $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments, $commentspics);

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
	 * @return	boolean		true if item was voted
	 */
	public function isVoted($ref,$conf,$pObj) {
		list($rec) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t',
				'tx_toctoc_ratings_iplog',
				'pid=' . intval($conf['storagePid']) .
				' AND reference=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($ref, 'tx_toctoc_ratings_iplog') .
				' AND ip='. $GLOBALS['TYPO3_DB']->fullQuoteStr($this->getCurrentIp(), 'tx_toctoc_ratings_iplog') .
				$this->enableFields('tx_toctoc_ratings_iplog',$pObj));
		return ($rec['t'] > 0);
	}


	/**
	 * Calculates image bar width
	 *
	 * @param	int		$rating	Rating value
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	int
	 */
	protected function getBarWidth($rating,$conf) {
		return intval($conf['ratings.']['ratingImageWidth']*$rating);
	}

	/**
	 * Fetches rating information for $ref
	 *
	 * @param	string		$ref	Reference in TYPO3 "datagroup" format (i.e. tt_content_10)
	 * @param	object		$pObj: parent object
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	array		Array with two values: rating and count, which is calculated rating value and number of votes respectively
	 */
	protected function getRatingInfo($ref,$pObj, $feuserid=-1,$conf) {
		if ($feuserid==-1){
			$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('rating,vote_count',
					'tx_toctoc_ratings_data',
					'pid=' . intval($conf['storagePid']) .
					' AND reference=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($ref, 'tx_toctoc_ratings_data') . $this->enableFields('tx_toctoc_ratings_data',$pObj));
			return (count($recs) ? $recs[0] : array('rating' => 0, 'vote_count' => 0));


		} else {

			$feusertoquery =0;
			$fetoctocusertoquery ='';
			$fetoctocusertoinsert='';
			$strCurrentIP = $this->getCurrentIp();
			if (intval($feuserid)===0) {
				$fetoctocusertoquery ='"' . $strCurrentIP . '.0' . '"' ;
				$fetoctocusertoinsert = $strCurrentIP . '.0' ;
			} else {
				$fetoctocusertoquery ='"0.0.0.0.' . $feuserid . '"' ;
				$fetoctocusertoinsert ='0.0.0.0.' . $feuserid ;
			}
			$feusertoquery =  intval($feuserid);
			$recs['myrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('myrating AS myrating, ilike AS ilike, idislike AS idislike ',
					'tx_toctoc_comments_feuser_mm',
					'((toctoc_commentsfeuser_feuser = ' . $feusertoquery . ' AND toctoc_commentsfeuser_feuser > 0) OR (toctoc_comments_user = ' . $fetoctocusertoquery . ' AND toctoc_commentsfeuser_feuser = 0))' .
					' AND reference="' . $ref . '"'. $this->enableFields('tx_toctoc_comments_feuser_mm',$pObj));

			$recs['myrecs'] = (count($recs) ? $recs['myrecs'] : array('myrating' => 0, 'ilike' => 0, 'idislike' => 0));

			$recs['allrecs'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(ilike) AS totalilikes , SUM(idislike) AS totalidislikes ',
					'tx_toctoc_comments_feuser_mm',
					'reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm',$pObj));

			$commentidcandidate=str_replace('tx_toctoc_comments_comments_','',$ref);
			if (version_compare(TYPO3_version, '4.6', '<')) {
				$tmpint = t3lib_div::testInt($commentidcandidate);
			} else {
				$tmpint = t3lib_utility_Math::canBeInterpretedAsInteger($commentidcandidate);
			}
			if ($tmpint) {
				$commentidcandidate=intval($commentidcandidate);

				$recs['comment'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('crdate AS commentdate',
						'tx_toctoc_comments_comments',
						'pid=' . intval($conf['storagePid']) .
						' AND uid=' . $commentidcandidate . $this->enableFields('tx_toctoc_comments_comments',$pObj));
			}
			else {
				$recs['comment'] = array('crdate' => 0);
			}
			$recs['ilikeusers'] = array();
			if (($recs['allrecs'][0]['totalilikes']>1) || (($recs['allrecs'][0]['totalilikes']>0) && ($recs['allrecs'][0]['ilike']==0))) {
				$userswhere ='tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
				$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' . $fetoctocusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
				$userswhere .=' AND ilike = 1 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm',$pObj);
				$recs['ilikeusers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'toctoc_commentsfeuser_feuser, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
							ilike AS usersilike, ipresolved, current_firstname, current_lastname ',
						'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
						$userswhere,
						'',
						'CASE WHEN CONCAT(current_firstname, current_lastname) = "" THEN 0 ELSE 1 END DESC,  tx_toctoc_comments_feuser_mm.crdate DESC, current_lastname DESC',
						'');
			}
			$recs['idislikeusers'] = array();
			if (($recs['allrecs'][0]['totalidislikes']>1) || (($recs['allrecs'][0]['totalidislikes']>0) && ($recs['allrecs'][0]['idislike']==0))) {
				$userswhere =' tx_toctoc_comments_user.deleted=0 AND tx_toctoc_comments_user.toctoc_comments_user=tx_toctoc_comments_feuser_mm.toctoc_comments_user';
				$userswhere .=' AND NOT ((tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = ' . $feusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser > 0) OR (tx_toctoc_comments_feuser_mm.toctoc_comments_user = ' . $fetoctocusertoquery . ' AND tx_toctoc_comments_feuser_mm.toctoc_commentsfeuser_feuser = 0))';
				$userswhere .=' AND idislike = 1 AND reference="' . $ref . '"'.  $this->enableFields('tx_toctoc_comments_feuser_mm',$pObj);
				$recs['idislikeusers'] = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'toctoc_commentsfeuser_feuser, tx_toctoc_comments_user.toctoc_comments_user AS tc_ct_user,
							ilike AS usersilike, ipresolved, current_firstname, current_lastname ',
						'tx_toctoc_comments_feuser_mm, tx_toctoc_comments_user',
						$userswhere,
						'',
						'CASE WHEN CONCAT(current_firstname, current_lastname) = "" THEN 0 ELSE 1 END DESC,  tx_toctoc_comments_feuser_mm.crdate DESC, current_lastname DESC',
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
	 * @param	[type]		$commentspics: ...
	 * @return	string		conditionally also an arraywith the rating content
	 */
	protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments, $commentspics) {

		// inits
		$siteRelPath = '/' . t3lib_extMgm::siteRelPath('toctoc_comments');

		if (($fromAjax)) {
			$language = &$GLOBALS['LANG'];
			$languagecode = $GLOBALS['LANG']->lang;
		}
		else {
			$language = t3lib_div::makeInstance('language');
			$language->init($GLOBALS['TSFE']->lang);
			$languagecode = $GLOBALS['TSFE']->lang;
		}
		/*@var $language language */

		$contentarr=array();
		$myrating = array();

		// get the ratings

		$rating = $this->getRatingInfo($ref, $pObj,-1,$conf);
		$myrating = $this->getRatingInfo($ref,$pObj,$feuserid,$conf);

		if (($cmd=='vote') ||($cmd=='votearticle')) {

			// for the votes get the texts and mix with values :-)

			if ($rating['vote_count'] > 0) {
				$rating_value = $rating['rating']/$rating['vote_count'];
				if ($rating['vote_count']==1) {
					$votetext=$this->pi_getLLWrap($pObj, 'api_rating.vote',$fromAjax);
				} else {
					$votetext=$this->pi_getLLWrap($pObj, 'api_rating.votes',$fromAjax);
			    }
			    $votetext = ' (' . $rating['vote_count'] . ' ' . $votetext . ')';
				//$mydislikehtml=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'dislike',$fromAjax);
				$rating_str = sprintf($this->pi_getLLWrap($pObj, 'api_rating',$fromAjax), $rating_value, $conf['ratings.']['maxValue'], '') . $votetext;
			}
			else {
				$rating_value = 0;
				$rating_str = $rating_str = $this->pi_getLLWrap($pObj, 'api_not_rated',$fromAjax);
			}

			// get the template
			if ($conf['ratings.']['mode'] == 'static' || (!$conf['ratings.']['disableIpCheck'] && $this->isVoted($ref,$conf,$pObj))) {
				$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_RATING_STATIC###');
				$subTemplateMyILikeArea = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING###');
				$links = '';
			}
			else {
				$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_RATING###');
				$subTemplateMyILikeArea = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING_STATIC###');
				$voteSub = $pObj->cObj->getSubpart($template, '###VOTE_LINK_SUB###');

				// Make ajaxData
				if ($fromAjax) {
					if ($fromcomments) {
						$ajaxData = $this->AjaxData;
					} else {
						$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid) ;
					}
				} else {
					$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid) ;
				}

				// Create links
				$links = '';
				for ($i = $conf['ratings.']['minValue']; $i <= $conf['ratings.']['maxValue']; $i++) {
					$check = $this->getcheck($ref, $i, $ajaxData, true);

					$links .= $pObj->cObj->substituteMarkerArray($voteSub, array(
							'###VALUE###' => $i,
							'###REF###' => $ref,
							'###PID###' => $pid,
							'###CID###' => $cid,
							'###CHECK###' => $check,
							'###SITE_REL_PATH###' => $siteRelPath,
					));
				}
			}

			$commentdateSub = $pObj->cObj->getSubpart($template, '###COMMENT_DATE_SUB###');

			$commentdatehtml ='';
			if ($myrating['comment'][0]['commentdate']){
				$commentcontinuation='';
				if (intval($conf['ratings.']['enableRatings']) ===1 ) {
					$commentcontinuation='&nbsp;&middot;&nbsp;';
				}
				$commentdatehtml = $pObj->cObj->substituteMarkerArray($commentdateSub, array(
					'###COMMENT_DATE###' => $this->formatDate($myrating['comment'][0]['commentdate'], $pObj, $fromAjax, $conf) .$commentcontinuation,
						));
	        }
		} else {
			// for all other cmd get the templates for the topline-ratings (other ratings templates follow later)
			if ($fromAjax) {
				if ($fromcomments) {
					$ajaxData = $this->AjaxData;
				} else {
					$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid) ;
				}
			} else {
				$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid) ;
			}
			if ($conf['ratings.']['mode'] == 'static' ) {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING_TOP###');
					$subTemplateMyILikeArea = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING_TOP###');
				} else {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}
				$links = '';
			} else {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING_TOP###');
					$subTemplateMyILikeArea = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING_TOP###');
				} else {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}
			}
		}

		// Init the vars containing values ready for print

		$mydislikeval=intval($myrating['myrecs'][0]['idislike']);
		$mylikeval=intval($myrating['myrecs'][0]['ilike']);
		$sumdislikevalstr='&nbsp;' . $myrating['allrecs'][0]['totalidislikes'];
		if (intval($myrating['allrecs'][0]['totalidislikes'])===0){
			$sumdislikevalstr= '';
		}
		$sumlikevalstr= '&nbsp;' . $myrating['allrecs'][0]['totalilikes'];
		if (intval($myrating['allrecs'][0]['totalilikes'])===0){
			$sumlikevalstr= '';
		}
		$myrating_str='';


		// here we determine the text to display in the topline, if it's a rating on News, Products normal Content Element or other records...

		$extpreffortext = 'pages';
		if ((trim($conf['externalPrefix'])=='tt_products') || (trim($conf['externalPrefix'])=='tx_commerce_pi1')) {
			$extpreffortext ='tt_products';
		} elseif  ((trim($conf['externalPrefix'])=='tx_wecstaffdirectory_pi1')) {
			$extpreffortext ='tx_wecstaffdirectory_pi1';
		} elseif  ((trim($conf['externalPrefix'])=='tx_rouge')) {
			$extpreffortext ='tx_rouge';
		} elseif  ((trim($conf['externalPrefix'])=='tx_album3x_pi1')) {
			$extpreffortext ='tx_album3x_pi1';
		} elseif   ((trim($conf['externalPrefix'])=='tx_mininews_pi1') || (trim($conf['externalPrefix'])=='tx_ttnews')) {
			$extpreffortext ='tx_ttnews';
		}


		//Setting up idislike zone



		$retarr=$this->makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating,$mydislikeval,'dis',$template,$cid, $commentspics,$extpreffortext);

		$mydislike=$retarr[0];
		$mydislikehtml=$retarr[1];
		$mydislikehtmlnv=$retarr[2];
		$mydislikepic=$retarr[3];
		$mydislikepicalkt=$retarr[4];
		// same processing for iLike

		$retarr=$this->makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating,$mylikeval,'',$template,$cid, $commentspics,$extpreffortext);

		$mylike=$retarr[0];
		$mylikehtml=$retarr[1];
		$mylikehtmlnv=$retarr[2];
		$mylikepic=$retarr[3];
		$mylikepicalkt=$retarr[4];



		// selecting the template

		if ($conf['ratings.']['mode'] == 'static' ) {
			$mypiclikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mypiclikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_LINK_SUB###');
		}

		if ($mydislikeval == 1 ) {
			$mypiclikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		// make the HTML for the iLike-Picture

		$i=-1*($mylikeval-1);
		$check = $this->getcheck($ref, $i, $ajaxData, true);
		$mypiclikehtmlSub =  $pObj->cObj->substituteMarkerArray($mypiclikeSub, array(
						'###VALUE###' => $i,
						'###REF###' => $ref,
						'###PID###' => $pid,
						'###CID###' => $cid,
						'###CHECK###' => $check,
						'###CONTENT###' => $mylike,
						'###SITE_REL_PATH###' => $siteRelPath,
						'###TITLE###' => '',
    	));
		$mylike=$mypiclikehtmlSub;

		// selecting the same template again for the text version of the ilike link and the topline-ilke link (the one without number of votes)

		if ($conf['ratings.']['mode'] == 'static' ) {
			$mylikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mylikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_LINK_SUB###');
		}
		if ($mydislikeval == 1 ) {
			$mylikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		$check = $this->getcheck($ref, $i, $ajaxData, true);
		$mylikehtmlSub =  $pObj->cObj->substituteMarkerArray($mylikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $ref,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mylikehtmlnv,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mylikepicalkt .'"',
		));
		$mylikehtmlnv=$mylikehtmlSub;
		$mylikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		$mylikehtmlSub =  $pObj->cObj->substituteMarkerArray($mylikeSub, array(
						'###VALUE###' => $i,
						'###REF###' => $ref,
						'###PID###' => $pid,
						'###CID###' => $cid,
						'###CHECK###' => $check,
						'###CONTENT###' => $mylikehtml,
						'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mylikepicalkt .'"',
    	));
		$mylikehtml=$mylikehtmlSub;
		// dont show topline ilike pic when not iLiked by any one

		if ((substr($ref, 0,9)!=='tx_toctoc') || ($cmd=='votearticle')) {
			if (intval($myrating['allrecs'][0]['totalilikes'])===0){

				$mylike= '';
				$mylikehtml='';

			}
		}

		// same for the dislikes


		$mydislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		$i=-1*($mydislikeval-1);
		$check = $this->getcheck($ref, $i, $ajaxData, true);
		$mydislikehtmlSub =  $pObj->cObj->substituteMarkerArray($mydislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $ref,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislikehtml,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mydislikepicalkt .'"',
		));
		if ($conf['ratings.']['mode'] == 'static' ) {
			$mydislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mydislikeSub = $pObj->cObj->getSubpart($template, '###IDISLIKE_LINK_SUB###');
		}
		if ($mylikeval == 1 ) {
			$mydislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}
		$mydislikehtml=$mydislikehtmlSub;
		$mydislikehtmlSub =  $pObj->cObj->substituteMarkerArray($mydislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $ref,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislikehtmlnv,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => 'title="' . $mydislikepicalkt .'"',
		));
		$mydislikehtmlnv=$mydislikehtmlSub;

		if ($conf['ratings.']['mode'] == 'static' ) {
			$mypicdislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		} else {
			$mypicdislikeSub = $pObj->cObj->getSubpart($template, '###IDISLIKE_LINK_SUB###');
		}
		// now, now now, static isn't the only reason to go static.
		// the other reason is that user has made iLike, so IDislike is only activ after he unlikes it.
		if ($mylikeval == 1 ) {
			$mypicdislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###'); //same as IDISLIKE_STATIC_SUB would be
		}

		$check = $this->getcheck($ref, $i, $ajaxData, true);
		$mypicdislikehtmlSub =  $pObj->cObj->substituteMarkerArray($mypicdislikeSub, array(
				'###VALUE###' => $i,
				'###REF###' => $ref,
				'###PID###' => $pid,
				'###CID###' => $cid,
				'###CHECK###' => $check,
				'###CONTENT###' => $mydislike,
				'###SITE_REL_PATH###' => $siteRelPath,
				'###TITLE###' => '',
		));
		$mydislike=$mypicdislikehtmlSub;

		// dont show topline ilike pic when not iLiked by any one

		if ((substr($ref, 0,9)!=='tx_toctoc') || ($cmd=='votearticle')) {
			if (intval($myrating['allrecs'][0]['totalidislikes'])===0){
				$mydislike= '';
				$mydislikehtml='';
			}
		}


		// get the "your rating" part

		$myrating_value=intval($myrating['myrecs'][0]['myrating']);

		if ($myrating_value==0){
			$myrating_left = 0;
			$myrating_width = 0;
			$myratingtext='';
		} else {
			$myrating_left = $myrating_value*11 -11;
			$myrating_width = 11;
			$myratingtext=$this->pi_getLLWrap($pObj, 'api_yourrating',$fromAjax) . '&nbsp;' . $myrating_value;
		}

		// considering options and resetting the HTML-fragments if needed (I admit this could be done in parts before...)

		if (intval($conf['ratings.']['useLikeDislike'] ) !== 1) {
			$mylikehtml = '';
			$mylikehtmlnv = '';
			$mydislikehtml = '';
			$mydislikehtmlnv = '';
			$mylike ='';
			$mydislike ='';
		} else {
			// for top line adding the continuations
			if (intval($conf['ratings.']['useDislike'] ) !== 1) {
				$mydislikehtml = '';
				$mydislikehtmlnv = '';
				$mydislike ='';
				if ($cmd === 'liketop') {
					if (($mylikehtml !='') || ($conf['ratings.']['useVotes']==1) || ($conf['advanced.']['useSharing']==1) || (($conf['advanced.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0))) {
						$mylikehtmlnv .= '&nbsp;&middot;&nbsp;&nbsp;';
					}
					$mylikehtml .= '&nbsp;&middot;&nbsp;&nbsp;';
				}
			} else {
				if ($mylikehtml !='') {
					if ($mydislikehtml !='') {
						$mylikehtml .= '&nbsp;&middot;&nbsp;';
					}
				}
				if ($mydislikeval==0) {
					if ($mylikeval==0) {
							$mylikehtmlnv .= '&nbsp;&middot;&nbsp;';
					} else {
						$mylikehtmlnv .= '&nbsp;&middot;&nbsp;&nbsp;';
					}

				} else{
					$mylikehtmlnv .= '&nbsp;&middot;&nbsp;';
				}

				if (strpos($cmd, 'top')!==false) {
					if (($mydislikehtml !='') || ($conf['ratings.']['useVotes']==1) || ($conf['advanced.']['useSharing']==1) || (($conf['advanced.']['useSharing']==0) && ($conf['ratings.']['useVotes']==0))) {
						$mydislikehtmlnv .= '&nbsp;&middot;&nbsp;&nbsp;';
					}
					$mydislikehtml .= '&nbsp;&middot;&nbsp;&nbsp;';
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
		$areamarkers = array(
				'###MYILIKE###' => $mylike,
				'###MYIDISLIKE###' => $mydislike,
				'###MYILIKETEXT###' => $mylikehtmlout,
				'###MYIDISLIKETEXT###' => $mydislikehtmlout,
				'###REF###' => htmlspecialchars($ref),
		);
		$mylikeareahtml= $pObj->cObj->substituteMarkerArray($subTemplateMyILikeArea, $areamarkers);


		// preparing output for
		// 1. ilikes or votings, iLikes are subclassed into topline-1st/topline-2nd or  Comment line
		// 2. the enitre area (pi1-calls)
		if (strpos($cmd, 'like')!==false) {
			// iLikes/idislikes

			if (strpos($cmd, 'liketop')!==false) {

			// top line
				// the 2nd top line
				$mylikehtml = str_replace('\'like\',', '\'liketop\',',$mylikehtml );
				$mydislikehtml = str_replace('\'unlike\',', '\'unliketop\',',$mydislikehtml );
				$mylikehtml = str_replace('\'myratings\'', '\'myratingstop\'',$mylikehtml );
				$mydislikehtml = str_replace('\'myratings\'', '\'myratingstop\'',$mydislikehtml );
				// the 1st top line
				$mylikehtmlnv = str_replace('\'like\',', '\'liketop\',',$mylikehtmlnv );
				$mydislikehtmlnv = str_replace('\'unlike\',', '\'unliketop\',',$mydislikehtmlnv );
				$mylikehtmlnv = str_replace('\'myratings\'', '\'myratingstop\'',$mylikehtmlnv );
				$mydislikehtmlnv = str_replace('\'myratings\'', '\'myratingstop\'',$mydislikehtmlnv );


				if (($conf['ratings.']['ratingsOnly'] ==1)) {
					//$hidecss ='-hide';
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
					'###REF###' => htmlspecialchars($ref),
					'###SITE_REL_PATH###' => $siteRelPath,
					'###MYILIKE_AREA###' => $mylikeareahtml,
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
			);
		} else {
			$hidecss ='';
			if (($conf['ratings.']['ratingsOnly'] ==1)) {
				//$hidecss ='-hide';
			}
			$markers = array(
					'###HIDECSS###'=> $hidecss,
					'###PID###' => $pid,
					'###CID###' => $cid,
					'###HIDEVOTE###' => $strhidevote,
					'###REF###' => htmlspecialchars($ref),
					'###TEXT_SUBMITTING###' => $this->pi_getLLWrap($pObj, 'api_submitting',$fromAjax),
					'###TEXT_ALREADY_RATED###' => $this->pi_getLLWrap($pObj, 'api_already_rated',$fromAjax),
					'###BAR_WIDTH###' => $this->getBarWidth($rating_value,$conf),
					'###COMMENT_DATE###' => $commentdatehtml,
					'###RATING###' => $rating_str,
					'###TEXT_RATING_TIP###' => $this->pi_getLLWrap($pObj, 'api_tip',$fromAjax),
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
					$contentarr['voteing']= $pObj->cObj->substituteMarkerArray($subTemplate, $markers);
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
		if (intval($conf['ratings.']['useLikeDislike'] ) === 1) {
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
		if ($returnasarray) {
			return $contentarr;
		} else {
			return $contentarr['voteing'];
		}
	}
	/**
	 * Makes text for iLike or idislike.
	 *
	 * @param	[type]		$conf: ...
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
	function makeiLikeText($conf, $pObj, $cmd, $ref, $fromAjax, $myrating = array(),$mylikeval,$mydis='',$template,$cid, $commentspics,$extpreffortext) {
		// same processing for iLike and iDislike
		$namedcount=2;
		$othersmaxcount=5;
		$likingusersstr='';
		$nbrnamed=$myrating['allrecs'][0]['totali' . $mydis . 'likes'];
		$otherscount=0;
		$likingusersstr=' ';
		$printname='';
		$iothers=0;
		$namedlikearr=array();
		$uchtmlarr=array();
		if ($nbrnamed>0) {
			$nbrinterpunkt=' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and',$fromAjax)  . ' ';
			if ($nbrnamed>0) {
				$nbrinterpunkt=', ' ;
			}
			if ($nbrnamed>$namedcount) {
				$nbrnamed=$namedcount;
			}


			$prefix=  $ref;
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($ref, 0, $posbeforeid);
			$mmtable=substr($ref, 0, $posbeforeid-1);
			$refID = substr($ref, $posbeforeid);
			$refID = (999999-$refID)*10;

			// gefällt das Produkt
			$selectorlikelikes='';
			if ($extpreffortext== 'tx_wecstaffdirectory_pi1') {
				// gefällt die Person
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

					$templateuclink = $pObj->cObj->getSubpart($template, '###SHOWUC_SUB###');

					$fontsizeforuc= '100%';
					$lineheightforuc= '109.1%';
					if ((substr($ref, 0,9)!=='tx_toctoc') || ($cmd=='votearticle')) {
						$fontsizeforuc= '90.9%';
						$lineheightforuc= '109.1%';
					}
					$uchtml =  $pObj->cObj->substituteMarkerArray($templateuclink, array(
							'###COMMENT_ID###' => $pseudocommentid,
							'###FONTSIZE###'=> $fontsizeforuc,
							'###LINEHEIGHT###'=> $lineheightforuc,
							'###TXTCLOSE###' => $this->pi_getLLWrap($pObj, 'pi1_template.dialogboxclose', $fromAjax),
					));

					$uclink='';
					$timeout= intval($conf['timeoutUC']);
					if ($timeout < 3) {
						$timeout=3;
					} elseif ($timeout > 15) {
						$timeout=15;
					}
					$timeout= 1000*$timeout;
					if (!$fromAjax) {
						$templateuclink = $pObj->cObj->getSubpart($template, '###SHOWUCLINK_SUB###');
					} else {
						$templateuclink = $pObj->cObj->getSubpart($template, '###SHOWUCLINK_SUB###');

					}
					$pictureuser= $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'];
					$fetoctocusertoquery ='"0.0.0.0.' . $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'] . '"' ;
					$fetoctocusertomarker ='0.0.0.0.' . $myrating['i' . $mydis . 'likeusers'][$i]['toctoc_commentsfeuser_feuser'] ;
					if ($pictureuser==0) {
						//check if female
						$fetoctocusertoquery ='"' . $myrating['i' . $mydis . 'likeusers'][$i]['tc_ct_user'] . '"' ;
						$fetoctocusertomarker =$myrating['i' . $mydis . 'likeusers'][$i]['tc_ct_user'] ;

						$rowsgender = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('gender',
								'tx_toctoc_comments_comments',
								'toctoc_comments_user = ' . $fetoctocusertoquery,
								'',
								'uid DESC',
								1);
						if (count($rowsgender)>0) {
							if($rowsgender[0]['gender']==1) {
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
						if (array_key_exists('gender',$rowsfeuser[0])) {
							$usergenderexistsstr=' fe_users.gender AS gender, ';
						}
					}
					if (!$fromAjax) {
						$this->build_AJAXImages($conf,$usergenderexistsstr);
					} else {
						if (count($commentspics)>0) {
							$this->AJAXimages = $commentspics;
						}

					}

					$pictureuserfromajax = $this->getAJAXimage($pictureuser ,$pseudocommentid);
					$uclink =  $pObj->cObj->substituteMarkerArray($templateuclink, array(
							'###COMMENT_ID###' => $pseudocommentid ,
							'###CID###' => $cid,
							'###TOCTOCUID###' => base64_encode($fetoctocusertomarker),
							'###IMGBENC###' => base64_encode($pictureuserfromajax),
							'###TIMEOUTMS###' => $timeout,
					));

					$uchtmlarr[$i]=trim($uchtml);

					$printname='<a rel="nofollow" href="javascript:void(0)" onclick="' . $uclink . '">' .  $printname . '</a>';

				} else {
					$iothers=$i;
					$otherscount=$nbrnamed-$i;
					if ($i==0) {
						$nbrinterpunkt='';
					}
					if ($likingusersstr!='') {
						$likingusersstr=substr($likingusersstr,0,(strlen($likingusersstr)-2));
					}
					break;
				}
				if ($nbrnamed-1>$i) {
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
			for ($j = (count($myrating['i' . $mydis . 'likeusers'])-$otherscount); $j < count($myrating['i' . $mydis . 'likeusers']); $j++) {
				if (trim($myrating['i' . $mydis . 'likeusers'][$j]['current_lastname']) !='') {
					$printname=$myrating['i' . $mydis . 'likeusers'][$j]['current_lastname'];
					if ($myrating['i' . $mydis . 'likeusers'][$j]['current_firstname'] !='') {
						$printname=$myrating['i' . $mydis . 'likeusers'][$j]['current_firstname'] . ' ' . $printname;
					}
				} else {
					$printname=$myrating['i' . $mydis . 'likeusers'][$j]['ipresolved'];
				}

				if ($i < $othersmaxcount) {
					$otheruserarray[$i]=$printname;
					$i++;
					$iovermax=$i;
				} else {
					$overmax++;
					if ($overmax==1) {
						$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otheruser',$fromAjax);

					} else {
						$otheruserarray[$iovermax]= $overmax . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_otherusers',$fromAjax);
					}
					$i++;
				}


			}
			if ($otherscount==1) {
				$another=$this->pi_getLLWrap($pObj, 'api_ilike_another',$fromAjax);
				if ((count($namedlikearr)>0) || ($mylikeval>0)) {
					$others .= $another;
				} else {
					$anotherarr = explode(' ',$another);
					$anotherarr[0]=ucwords($anotherarr[0]);
					$another = implode(' ',$anotherarr);
					$others .= $another;
				}

			}else {

				$others .= $otherscount .  ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_others',$fromAjax);
			}

			$othersjs='<script type="text/javascript">jQuery(\'#tx-tc-oth' . $mydis . '-' . $ref . ' a[title]\').tooltip({offset: [-1, 0],effect: ';
			$othersjs.="'fade'";
			$othersjs.=',opacity: 1});</script> ';

			$others ='<span id="tx-tc-oth' . $mydis . '-' . $ref . '"><a class="tx_tc_othertitle" rel="nofollow" href="javascript:void(0)" title="' . implode('<br>',$otheruserarray)  . '">' .  $others . '</a></span>' . $othersjs;
			if ((count($namedlikearr)>0) || ($mylikeval>0)) {
				$others = ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and',$fromAjax) .   ' ' . $others;
			}
		} else {
			if (strpos($likingusersstr,', ')>0) {
				$likingusersarr=explode(', ', $likingusersstr);
				$lastnameduser=trim($likingusersarr[(count($likingusersarr)-1)]);
				$strlastlen=strlen($lastnameduser);
				$likingusersstr = substr($likingusersstr,0,(strlen($likingusersstr)-$strlastlen-2)) . ' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and',$fromAjax)  . ' ' . $lastnameduser;
			} else {
				if ($likingusersstr!='') {
					$nbrinterpunkt=' ' . $this->pi_getLLWrap($pObj, 'api_ilike_and',$fromAjax)  . ' ';
				}
			}

		}
		$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis' . $selectorlikelikes,$fromAjax) ;
		if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==1) {
			if ($mylikeval==0) {
				// another user likes it
				$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likesthis' . $selectorlikelikes,$fromAjax) ;
			}
		}
		if ($mylikeval==0) {
			// not yet liked by the user
			$mylikepic='i' . $mydis . 'likemaybe.png';

			if ((substr($ref, 0,9)!=='tx_toctoc') || ($cmd=='votearticle')) {
				// if liking on toparea

				if (substr($ref, 0,9)!=='tt_conten') {
					//records
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext  . $mydis . 'likemaybe',$fromAjax);

					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_' . $extpreffortext . 'topline_onelike',$fromAjax);
					$mylikehtml= $likingusersstr .  ' ' . $others  .  ' ' .  $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item',$fromAjax) .  implode($uchtmlarr);

				} else {
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . $mydis . 'likemaybe',$fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_topline_onelike',$fromAjax);
					$mylikehtml=$likingusersstr .  ' ' .  $others  .  ' ' . $likethis  .  implode($uchtmlarr);
				}

			} else {
				$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_' . $mydis . 'likemaybe',$fromAjax);
				//$mylikehtml=$this->pi_getLLWrap($pObj, 'api_like',$fromAjax);
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==0) {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_' . $mydis . 'like',$fromAjax);

				} else {
					$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis' ,$fromAjax) ;
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']==1) {
						$likethis=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likesthis' ,$fromAjax) ;
					}

					$mylikehtml= $likingusersstr .  ' ' . $others  .  ' ' .  $likethis .  implode($uchtmlarr);
				}
				$mylikehtmlnv= $mylikehtml;

			}

		} else {
			$mylikepic='i' . $mydis . 'like.png';
			if ((substr($ref, 0,9)!=='tx_toctoc') || ($cmd=='votearticle')) {
				// if liking on toparea
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
					$likethis=str_replace($this->pi_getLLWrap($pObj, 'api_ilike_like',$fromAjax),$this->pi_getLLWrap($pObj, 'api_ilike_like_lat_tu',$fromAjax),$likethis);
				}
				if (substr($ref, 0,9)!=='tt_conten') {
					//records

					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext .  'i' . $mydis . 'likethis',$fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_' . $extpreffortext . 'topline_oneunlike',$fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you_lat',$fromAjax) . $nbrinterpunkt .  $likingusersstr .  ' ' . $others  .  ' ' .  $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item',$fromAjax) .  implode($uchtmlarr);

					} else {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you',$fromAjax) . $nbrinterpunkt .  $likingusersstr .  ' ' . $others  .  ' ' .  $likethis . ' ' . $this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext . 'item',$fromAjax) .  implode($uchtmlarr);

					}
				} else {
					//pages
					$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_top' . $extpreffortext .  'i' . $mydis . 'likethis',$fromAjax);
					$mylikehtmlnv=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_topline_oneunlike',$fromAjax);
					if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you_lat',$fromAjax) . $nbrinterpunkt .  $likingusersstr .  ' ' . $others  .  ' ' .  $likethis . ' '  .  implode($uchtmlarr);

					} else {
						$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike_you',$fromAjax) . $nbrinterpunkt .  $likingusersstr .  $others  .  ' ' .    $likethis . ' ' .  implode($uchtmlarr);
					}
				}
			} else {
				$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'likethis',$fromAjax);
				if ($myrating['allrecs'][0]['totali' . $mydis . 'likes']<=1) {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_ilike_you_lat',$fromAjax) . ' ' .  $this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis_lat_tu',$fromAjax) .  implode($uchtmlarr);

				} else {
					$mylikehtml= $this->pi_getLLWrap($pObj, 'api_ilike_you',$fromAjax) . $nbrinterpunkt . $likingusersstr .  ' ' . $others .  ' ' .  $this->pi_getLLWrap($pObj, 'api_i' . $mydis . 'like_likethis',$fromAjax) .  implode($uchtmlarr);

				}
				$mylikehtmlnv= $mylikehtml;
			}

		}

		$mylike= '<img alt="' . $mylikepicalkt . '" title="' . $mylikepicalkt
		. '" src="' . '/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/'  . $mylikepic . '" />';
		$retarr=array();
		$retarr[0]=$mylike;
		$retarr[1]=$mylikehtml;
		$retarr[2]=$mylikehtmlnv;
		$retarr[3]=$mylikepic;
		$retarr[4]=$mylikepicalkt;

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
	 * @return	string		SQL
	 */
	public function enableFields($tableName,$pObj) {
		if ($GLOBALS['TSFE']) {
			$wherec=$pObj->cObj->enableFields($tableName);
			$_SESSION['enfi'][$tableName]=$wherec;
			return $wherec;
		}

		// With eID $GLOBALS['TCA'] is not available, so we need a session to store data at pi, then use it in eID
		$wherec=$_SESSION['enfi'][$tableName];
		return $wherec;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	object		$pObj: parent object
	 * @param	string		$llkey: key to the string in the xml file
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	[type]		...
	 */
	public function pi_getLLWrap($pObj, $llkey, $fromAjax) {
		if (!$fromAjax) {
			return $pObj->pi_getLL($llkey);
		} else {
			$language = &$GLOBALS['LANG'];
			return $language->sL('LLL:EXT:toctoc_comments/pi1/locallang.xml:' . $llkey);
		}
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
	protected function getcheck ($ref, $i, $ajaxData, $ratingscheck) {
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
			} else {
					$retstr=date($conf['advanced.']['dateFormat'], $date);
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
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.minute',$fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.minutes',$fromAjax);

					$unit_size = 60;
						break;

					// Handle Hours
					// ........................

					case '2';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hour',$fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hours',$fromAjax);

					$unit_size = 3600;
						break;

						// Handle Days
						// ........................

						case '3';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.day',$fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.days',$fromAjax);
					$unit_size = 86400;
						break;

						// Handle Weeks
						// ........................

						case '4';
						$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.week',$fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.weeks',$fromAjax);

					$unit_size = 604800;
						break;

						// Handle Months (31 Days)
						// ........................

						case '5';
						$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.month',$fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.months',$fromAjax);
					$unit_size = 2678400;
						break;

						// Handle Years (365 Days)
						// ........................

						case '6';
						$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.year',$fromAjax);
					$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.years',$fromAjax);
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
							$time_difference_string .= $difference_of_times . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.second',$fromAjax) . ' ';
					} else {
							$time_difference_string .= $difference_of_times . ' '  . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.seconds',$fromAjax) . ' ';
					}
			}

			 $retstr= trim($this->pi_getLLWrap($pObj, 'pi1_template.timeconv.textbefore',$fromAjax) . ' ' . $time_difference_string . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.textafter',$fromAjax));
			 $retstr= str_replace('-','',$retstr );
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
	protected function getPageURL($fromAjax = false,$pid = 0) {
		if ($fromAjax) {
			$pageURL = $_SESSION['commentsPageIds'][$pid];
		} else {
			$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
			if ($_SERVER["SERVER_PORT"] != "80")
			{
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			}
			else
			{
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
		}


		return $pageURL;

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
		$html = str_replace("div><div", "div>\r\n<div", $html);
		$html = str_replace("</div></div>", "</div>\r\n</div>", $html);
		$search = array(
				'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
		);
		$html = preg_replace($search, '', $html);
		return $html;
	}

	/**
	 * Usercards
	 *
	 *
	 */

	/**
	 * Get a the information about a user
	 *
	 * @param	string		$basedimgstr: baseencoded string containing the link to the users image in typo3temp
	 * @param	string		$basedtoctocuid: baseencoded string containing the toctoc-userid
	 * @param	array		$conf: plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	int		$commentid: uid of the comment
	 * @return	string		Informations about the userstatistics
	 */
	public function getUserCard($basedimgstr,$basedtoctocuid,$conf,$pObj,$commentid) {
		// Get UserCard display

		if ($basedimgstr !='') {
			$imgstr =base64_decode($basedimgstr);
			$toctocuid=base64_decode($basedtoctocuid);
			$closestr ='';
			$mailurl = '/';
			$nbsp ='';
		} else {
			// call from SendNotificationMail
			$toctocuid=$basedtoctocuid;
			$imgstr ='';
			$closestr ='';
			$nbsp ='&nbsp;';
			$mailurl = $this->cObj->typoLink_URL(array('parameter' => t3lib_div::locationHeaderUrl(''),));
		}

		$userimagesize= 96;
		$replstr = 'width: ' . $conf['UserImageSize'] . 'px; height: ' . $conf['UserImageSize'] . 'px';
		$newstr = 'width: ' . $userimagesize . 'px; height: ' . $userimagesize . 'px';
		$replstrtg = 'width="' . $conf['UserImageSize'];
		$newstrtg = 'width="' . $userimagesize;
		$replstrtgh = 'height="' . $conf['UserImageSize'];
		$newstrtgh = 'height="' . $userimagesize;
		if ($conf['userContactUC']) {
			$dataWhereuser = 'pid=' . intval($conf['storagePid']) .
			' AND toctoc_comments_user = "' . $toctocuid . '"';
			list($rowusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_user', $dataWhereuser);
			$pizzateile = explode('.', $toctocuid);
			$feuserid = $pizzateile[4];
			$dataWherefeuser = 'uid=' . intval($feuserid);
			list($rowfeusr) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'fe_users', $dataWherefeuser);
			$dataWherecomment = 'uid=' . $commentid;
			list($rowcomment) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_comments', $dataWherecomment);
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
					if ((trim($ucfullnameone) != '') &&  (trim($ucfullnametwo) != '')) {
						if ((trim($postingname) != trim($ucfullnameone)) && (trim($postingname) != trim($ucfullnametwo))) {
							$divtostats=1;
						}
					} elseif ((trim($ucfullnameone)!= '') &&  (trim($ucfullnametwo) == '')) {
						if (trim($postingname) != trim($ucfullnameone)) {
							$divtostats=1;
						}
					} elseif ((trim($ucfullnameone)== '') &&  (trim($ucfullnametwo) != '')) {
						if (trim($postingname) != trim($ucfullnametwo)) {
							$divtostats=1;
						}
					}
					if ($divtostats==1) {
						$addnameinfo = '<br /><span class="tx-tc-ct-uc-fullname_addinfo">' .
						'(' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.herepostingas', true) . ' ' . $postingname . ')' . '</span>';
					}

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
						if ($basedimgstr !='') {
							$ucemailarr = $this->getMailTo($rowusr['current_email']);
							$ucemail = '<a href="'. $ucemailarr[0] . '">' . $ucemailarr[1] . '</a>';
						} else {
							$ucemail = '<a href="mailto:'. $rowusr['current_email'] . '">' . $rowusr['current_email'] . '</a>';
						}
					}
				}
				$uccontact .=$ucemail;
				// location on the User Card
				$ucelocation='';
				if ($conf['userLocationUC']) {
					if ($rowusr['initial_location'] != '') {
						$uclocation.= $this->pi_getLLWrap($pObj, 'pi1_template.uc.livesin',true) .' ' . $rowusr['initial_location'];
						if ($rowusr['current_location'] != '') {
							if ($rowusr['initial_location'] != $rowusr['current_location']) {
								$uclocation .= ' (' . $rowusr['current_location'] . ')';
							}
						}
					} else {
						if ($rowusr['current_location'] != '') {
							$uclocation.= $this->pi_getLLWrap($pObj, 'pi1_template.uc.livesin',true) . ' ' . $rowusr['current_location'];
						}
					}
				}
				if (($uccontact != '') && ($ucelocation != '')) {$uccontact .='<br />';}
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
						$uchomepage = preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" title="'.$uchomepage .'" class="tx-tc-external-autolink">\1</a>', $uchomepage);
						//$uchomepage = ', ' . '<a href="' . $uchomepage . '" title="'.$uchomepage .'">Website</a>';
					}
				}
				if (($uccontact != '') && ($uchomepage != '')) {$uccontact .='<br />';}
				$uccontact .=$uchomepage;
				if ($uccontact != '') {

					$uccontact ='<div class="tx-tc-ct-uc-text-contact"><img class="tx-tc-ucpic" src="' . $mailurl . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/img/uccontact.png" height="14" width="14" title="' .
						         	$this->pi_getLLWrap($pObj, 'pi1_template.uc.contact',true) . '">' . $nbsp . $uccontact . '</div>';
				}

			}
		}
		if ($conf['userStatsUC']) {
			// homepage on the User Card
			$ucstats='';


			if (($rowusr['comment_count'] != '')&& ($rowusr['comment_count'] != '0')) {
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.comments',true) . ' ' . $rowusr['comment_count'];
			}
			if (($rowusr['vote_count'] != '')&& ($rowusr['vote_count'] != '0')) {

				if ($ucstats != '') {
					$ucstats .= ', ' ;
				}
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.rateditems',true) . ' ' . $rowusr['vote_count'];
			}

			if (($rowusr['average_rating'] != '') && ($rowusr['average_rating'] != '0.00')) {

				if ($ucstats != '') {
					$ucstats .= '<br>' ;
				}
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.averagerating',true) . ' ' . $rowusr['average_rating'];
			}
			if (($rowusr['like_count'] != '')&& ($rowusr['like_count'] != '0')) {
				if ($ucstats != '') {
					$ucstats .= ', ' ;
				}
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.likes',true) . ' ' . $rowusr['like_count'];
			}
			if (($rowusr['dislike_count'] != '')&& ($rowusr['dislike_count'] != '0')) {
				if ($ucstats != '') {
					$ucstats .= ', ' ;
				}
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.dislikes',true) . ' ' . $rowusr['dislike_count'];
			}
			if ($rowusr['tstamp'] != '') {

				if ($ucstats != '') {
					$ucstats .= '<br>' ;
				}
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.joined',true) . ' ' . $this->formatDate($rowusr['tstamp'], $pObj, true, $conf);

			}
			if ($rowusr['tstamp_lastupdate'] != '') {
				if ($rowusr['tstamp_lastupdate'] != $rowusr['tstamp'] ) {

					if ($ucstats != '') {
						$ucstats .= '<br>' ;
					}
					$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.lastactivity',true) . ' ' . $this->formatDate($rowusr['tstamp_lastupdate'], $pObj, true, $conf);
				}
			}
			if ($ucstats != '') {
				$ucstats ='<div class="tx-tc-ct-uc-text-stats"><img class="tx-tc-ucpic" src="' . $mailurl . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/img/ucstats.png" height="14" width="14" title="' .
						         	$this->pi_getLLWrap($pObj, 'pi1_template.uc.stats',true) . '">'  . $nbsp . $ucstats . '</div>';
			}
		}

		if ($conf['userIPUC']) {
			// homepage on the User Card
			$ucip='';

			if ($rowusr['ipresolved'] != '') {
				$ucip.=$rowusr['ipresolved'];
				if  (($rowusr['ip'] != '') && ($rowusr['current_ip'] != '')  && ($rowusr['ip'] != $rowusr['current_ip'])) {
					$ucip.= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.lastIP',true) . ' ' . $rowusr['current_ip'];
				}
			} elseif ($rowusr['ip'] != '') {

				$ucip.=$rowusr['ip'];
				if  (($rowusr['current_ip'] != '')  && ($rowusr['ip'] != $rowusr['current_ip'])) {
					$ucip.= ', ' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.lastIP',true) . ' ' . $rowusr['current_ip'];
				}
			} else {

			}


			if ($ucip != '') {
				$ucip ='<div class="tx-tc-ct-uc-text-ip"><img class="tx-tc-ucpic" src="' . $mailurl . t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/img/ucip.png" height="14" width="14" title="'  . $this->pi_getLLWrap($pObj, 'pi1_template.uc.IPinfo',true) . '">'  . $nbsp . $ucip . '</div>';
			}

		}
		$statusmessage = '';
		if (((!$conf['userIPUC']) && (!$conf['userStatsUC']) && (!$conf['userContactUC'])) ||
		 ((!$conf['userHomepageUC']) && (!$conf['userLocationUC'])  && (!$conf['userEmailUC']) && ($conf['userContactUC'])))  {
			$statusmessage = $this->pi_getLLWrap($pObj, 'pi1_template.uc.noucoptions',true);
		}

		if ($imgstr != '') {
			$imgstr = str_replace($replstr,$newstr, $imgstr);
			$imgstr = str_replace($replstrtg,$newstrtg, $imgstr);
			$imgstr = str_replace($replstrtgh,$newstrtgh, $imgstr);
			if (strpos($imgstr,'>')<1) {
				$imgstr.='>';
			}

		}

		$content =  '<div class="tx-tc-ct-uc-pic">' . $imgstr . '<div class="tx-tc-ct-uc-fullname-div"><span class="tx-tc-ct-uc-fullname">' . $ucfullname . '</span>' . $addnameinfo .'</div></div>' ;
		$content .=  '<div class="tx-tc-ct-uc-text">' ;

		if ($uccontact!=''){
			$content .= $uccontact;
		}

		if ($ucstats!=''){
			$content .= $ucstats;
		}

		 if ($ucip!=''){
		 	$content .= $ucip;
		 }

		if ($statusmessage!=''){
			$content .= $statusmessage;
		} else {
			if (($uccontact=='') && ($ucip=='') && ($ucstats=='')){
				$content .= $this->pi_getLLWrap($pObj, 'pi1_template.uc.nodata',true);
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
	 * @param	string		Email address
	 * @param	string		Link text, default will be the email address.
	 * @param	string		Initial link parameters, only used if Jumpurl functionality is enabled. Example: ?id=5&type=0
	 * @return	string		Returns a numerical array with two elements: 1) $mailToUrl, string ready to be inserted into the href attribute of the <a> tag, b) $linktxt: The string between starting and ending <a> tag.
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
	protected function encryptEmail($string,$back=0) {
		$out = '';

		if ($_SESSION['TSFE']['spamProtectEmailAddresses'] === 'ascii') {
			for ($a=0; $a<strlen($string); $a++) {
				$out .= '&#'.ord(substr($string, $a, 1)).';';
			}
		} else {
			// like str_rot13() but with a variable offset and a wider character range
			$len = strlen($string);
			$offset = intval($_SESSION['TSFE']['spamProtectEmailAddresses'])*($back?-1:1);
			for ($i=0; $i<$len; $i++) {
				$charValue = ord($string{$i});
				if ($charValue >= 0x2B && $charValue <= 0x3A) { // 0-9 . , - + / :
					$out .= $this->encryptCharcode($charValue,0x2B,0x3A,$offset);
				} elseif ($charValue >= 0x40 && $charValue <= 0x5A) { // A-Z @
					$out .= $this->encryptCharcode($charValue,0x40,0x5A,$offset);
				} else if ($charValue >= 0x61 && $charValue <= 0x7A) { // a-z
					$out .= $this->encryptCharcode($charValue,0x61,0x7A,$offset);
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
	protected function encryptCharcode($n,$start,$end,$offset) {
		$n = $n + $offset;
		if ($offset > 0 && $n > $end) {
			$n = $start + ($n - $end - 1);
		} else if ($offset < 0 && $n < $start) {
			$n = $end - ($start - $n - 1);
		}
		return chr($n);
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
	 * @return	void		...
	 */
	function send_mail ($toEMail,$subject,$message,$html,$fromEMail,$fromName,$attachment='') {
		global $TYPO3_CONF_VARS;
		$booswift=false;
		if (version_compare(TYPO3_version, '6.0', '<')) {
			if (
					isset($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
					is_array($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
					isset($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
					is_array($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
					(array_search('t3lib_mail_SwiftMailerAdapter', $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) === FALSE) == false
			) {
				$booswift=true;
			}
		} else {
			if (
					isset($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
					is_array($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) &&
					isset($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
					is_array($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) &&
					(array_search('TYPO3\CMS\Core\Mail\SwiftMailerAdapter', $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) === FALSE) == false
			) {
				$booswift=true;
			}
		}

		if ($booswift) {
			// 			$strconfarr=$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery'];
			// 		$stradd='1:' . isset($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) . '2:' . is_array($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']) . '3:' . isset($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) . '4:' . is_array($TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) . '5:' . array_search('t3lib_mail_SwiftMailerAdapter', $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) . '6:' . (array_search('t3lib_mail_SwiftMailerAdapter', $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/utility/class.t3lib_utility_mail.php']['substituteMailDelivery']) === FALSE ? 0:1) . '7:'. (array_search('t3lib_mail_SwiftMailerAdapter',$strconfarr) === FALSE ? 0:1) . '8:'. array_search('t3lib_mail_SwiftMailerAdapter',$strconfarr) ;

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
			->setBody($html, 'text/html', $GLOBALS['TSFE']->renderCharset)
			->addPart($message, 'text/plain', $GLOBALS['TSFE']->renderCharset);

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
			include_once(PATH_t3lib.'class.t3lib_htmlmail.php');
			$fromName = $this->slashName($fromName);

			if (is_array($toEMail)) {
				list($email, $name) = each($toEMail);
				$toEMail = $this->slashName($name) . ' <' . $email . '>';
			}

			$Typo3_htmlmail = t3lib_div::makeInstance('t3lib_htmlmail');
			$Typo3_htmlmail->start();
			$Typo3_htmlmail->mailer = 'TYPO3 HTMLMail';
			// $Typo3_htmlmail->useBase64(); +++ TODO
			$message = html_entity_decode($message);
			if ($Typo3_htmlmail->linebreak == chr(10))	{
				$message = str_replace(chr(13).chr(10),$Typo3_htmlmail->linebreak,$message);
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
				if (isset($Typo3_htmlmail->theParts) && is_array($Typo3_htmlmail->theParts) && isset($Typo3_htmlmail->theParts['attach']) && is_array($Typo3_htmlmail->theParts['attach'])) {
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

	/**
	 * formats from and to-emailadresses
	 *
	 * @param	string		$name: ...
	 * @param	string		$apostrophe: ...
	 * @return	string		$rc: Slashed e-mail adress
	 */
	protected function slashName ($name, $apostrophe='"') {
		$name = str_replace(',' , ' ', $name);
		$rc = $apostrophe . addcslashes($name, '<>()@;:\\".[]' . chr('\n')) . $apostrophe;
		return $rc;
	}

	/**
	 * Commentator-Notification functions
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
	 * @param	int		$pid: page id needed to fetsch right session values
	 * @param	[type]		$fromAjax: ...
	 * @return	string		Nothing or Message to be displayed in eID-Page (if called by eID)
	 */
	public function handleCommentatorNotifications($uid, $conf,$pObj, $fromeID = false, $pid=0,$fromAjax=1) {

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'firstname,lastname,email,uid,external_ref_uid,external_ref',
				'tx_toctoc_comments_comments',
				'deleted = 0 AND hidden = 0 AND approved = 1 AND pid='.$conf['storagePid'].' AND uid='.$uid,
				'',
				'uid DESC',
				'1' );
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		if (empty($row)) return; //we don't need to send a notificationEmail because the new comment is not yet approved
		$ressnd = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'DISTINCT firstname,lastname,email',
				'tx_toctoc_comments_comments',
				'tx_commentsnotify_notify = 1 AND deleted = 0 AND hidden = 0 AND approved = 1 AND pid='.$conf['storagePid'].' AND external_ref_uid ="'.$row['external_ref_uid'] . '" AND external_ref ="'.$row['external_ref'] . '" AND email <> "'. $row['email'] .'"',
				'',
				'email DESC',
				'' );

		if ($conf['HTMLEmail']) {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['advanced.']['notificationForCommentatorHTMLEmailTemplate']);

		} else {
			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['advanced.']['notificationForCommentatorEmailTemplate']);
		}
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
		if ($fromAjax) {
			$templateCode = @file_get_contents(PATH_site . $usetemplateFile);
		} else {
			$templateCode = $pObj->cObj->fileResource($usetemplateFile);
		}

		if($fromeID) {
			$pageTitle=$conf['pageTitle'];
			$linktocomment = $conf['pageURL'];
		} else {
			$pageTitle=$_SESSION['commentsPageTitles'][$pid];
			$linktocomment = $_SESSION['commentsPageIds'][$pid];
		}

		$infoleft='';

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];
		$fromeIDreturn="";
		while ($rowsnd = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($ressnd)) {
			$notifiyusername ='';
			if ($rowsnd['lastname'] != '') {
				$salutation= $this->pi_getLLWrap($pObj, 'commentatorEmail.salutationformal', $fromAjax);
				$notifiyusername = $rowsnd['lastname'];
				if ($rowsnd['firstname'] != '') {
					$notifiyusername = $rowsnd['firstname'] . ' ' . $rowsnd['lastname'];
				}
			} else {
				$salutation= $this->pi_getLLWrap($pObj, 'commentatorEmail.salutation', $fromAjax);
				if ($rowsnd['firstname'] != '') {
					$notifiyusername = $rowsnd['firstname'];
				}
			}
			$markerArray = array(
					'###USER###' => $notifiyusername,
					'###SALUTATION###' => $salutation,
					'###MESSAGE###' => $this->pi_getLLWrap($pObj, 'commentatorEmail.message', $fromAjax),
					'###LINK_TO_COMMENT###' => $linktocomment,
					'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'email.commentatoremail', $fromAjax),
					'###INFOSLEFT###'  => $infoleft,
					'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					'###MYHOMEPAGE###'  => $myhomepagelink,
					'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###MYHOMEPAGELINK###'  => t3lib_div::locationHeaderUrl(''),
					'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
					'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
			);
			$subject = str_replace('%s', $GLOBALS[GLOBALS][TYPO3_CONF_VARS][SYS][sitename].': '.$pageTitle, $this->pi_getLLWrap($pObj, 'commentatorEmail.subject', $fromAjax));
			$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - '  . $this->pi_getLLWrap($pObj, 'email.commentingsystem', $fromAjax);

			if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
				$content = $pObj->cObj->substituteMarkerArray($templateCode, $markerArray);

				self::send_mail($rowsnd['email'],  $subject,  '', $content, $conf['advanced.']['notificationForCommentatorEmail'], $sendername);

			} else {
				$template = $pObj->cObj->getSubpart($templateCode, '###COMMENTS_RECIPENT_MAIL###');
				$mailContent = $pObj->cObj->substituteMarkerArray($template, $markerArray); // substitute markerArray for HTML content
				t3lib_div::plainMailEncoded($rowsnd['email'], $subject, $mailContent, 'From: ' . $conf['advanced.']['notificationForCommentatorEmail']);
			}
			$fromeIDreturn .=  '<br>'. $this->pi_getLLWrap($pObj, 'commentatorEmail.notificationsentto', $fromAjax) . ' : '. $rowsnd['email'];
		}
		if($fromeID) {
			return  $fromeIDreturn;
		}
	}

	/**
	 * Administrator comment response functions
	 *
	 *
	 */

	/**
	 * Inserts admin-responses into the marker array
	 *
	 * @param	array		$params   Parameters to the function
	 * @param	$pObj		Parent object
	 * @param	[type]		$conf: ...
	 * @return	array		the modified marker array
	 */
	protected function getCommentsReponse(&$params, &$pObj, $conf) {

		$data = array_pop(
				$GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_commentsresponse_response',
						'tx_toctoc_comments_comments',
						'uid = ' . intval($params['row']['uid'])
				)
		);

		$response = '';

		if (!empty($data)) {
			$response = $this->applyStdWrap(
					nl2br($this->createLinks(htmlspecialchars($data['tx_commentsresponse_response']),$conf)),
					'content_stdWrap',
					$conf,
					$pObj
			);
		}

		$params['markers']['###COMMENT_RESPONSE###'] = $response;

		return $params['markers'];
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
	public function cleanupfup($cmd, $cid, $data, $pObj, $fromAjax, $uploadedfile, $conf, $originalfilename) {
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
	public function getwebpagepreview($cmd, $cid, $data, $pObj, $fromAjax, $websitepreviewid=0, $conf) {
		$outhtml='';
		if ($cmd=='startpreview') {
			if ($this->getwebpagecache('p'. $cid, 'p'. $data['commentid'], $conf, $data['url'],true)==0) {
				//$_SESSION['pvscont'] = 0;
				$_SESSION['p'. $cid]['p'. $data['commentid']]['url'] =$data['url'];
 				require_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_webpagepreview.php'));
	 			$this->pvslib = new toctoc_comments_webpagepreview;
				$this->pvslib->main($data['url'],$data['commentid'],$cid,$data['lang'], $conf, $this, $pObj);
				$outhtml = "";
			} else {
				$outhtml = $this->lastpreviewid;
			}
		} elseif ($cmd=='getpreviewinit') {

			$outhtml = $this->getpreviewinit($cid,$data, $pObj);


		} elseif ($cmd=='getpreview') {
			// is in class.toctoc_comments_webpagepreview_ajax.php to avoid TYPO3 overhead

		} elseif ($cmd=='cleanuppreview') {
		//unlink files in temp
			$this->lastpreviewid=0;
			//clean up db and files
			$this->cleanupdbandfiles($conf);
			$this->getpreviewinit($cid,$data, $pObj);

		} elseif ($cmd=='savepreview') {
			$outhtml = $this->savewebpagepreviewtodb('p'. $cid,'p'. $data['commentid'], $data['url'], $conf);

		} else {
			$outhtml = "Wrong cmd";
		}
		return $outhtml;

	}

	/**
	 * Initialilizes the session vars for webpage previews
	 *
	 * @param	int		$cid: ...
	 * @param	array		$data:array with needed comment id
	 * @param	[type]		$pObj: ...
	 * @return	string		confirmation for the request
	 */
	protected function getpreviewinit($cid,$data, $pObj) {
		$this->lastpreviewid=0;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['title']='';
		$_SESSION['p'. $cid]['p'. $data['commentid']]['working'] = 1;
		$_SESSION['p'. $cid]['p'. $data['commentid']]['title'] = '';
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

		session_write_close();
		session_name('sess_' . $pObj->extKey);
		session_start();

		$_SESSION['p'. $cid]['p'. $data['commentid']]['url'] =$data['url'];
		return  "getpreviewinit done, cid " . $cid . ", commentid " . $data['commentid'];
	}
	/**
	 * Saves a new webpage preview in the db and returns the new id
	 *
	 * @param	int		$pcid: content element id
	 * @param	int		$pcommentid: comment id
	 * @param	string		$userurl: url as entered by the user
	 * @param	array		$conf: ...
	 * @return	int		$newUid, uid of the attachment in tx_toctoc_comments_attachment_mm
	 */
	protected function savewebpagepreviewtodb($pcid,$pcommentid,$userurl,$conf) {
		$debug='';
		$conf_cachetimetemppics = $conf['attachments.']['webpagePreviewCacheTimeTempImages'];
		$conf_cachetimetemppics =(time() - ($conf_cachetimetemppics *60));

		//copy pic in /uploads/tx_toctoccomments/webpagepreview
		//create record in attachments

		$newUid=0;
		$newUid = $this->getwebpagecache($pcid,$pcommentid, $conf);
		$debug.= 'newuid 1: ' . $newUid;
		$savelog='';
		if ($newUid==0){

			$photo_main ='';
			$photos_etc ='';
			$microtimearr=explode('.',microtime(true));
			$replacebyinfilename=strval($microtimearr[0]. '-' . substr(strval($microtimearr[1]),0,3) . '-');

			// copy logo from 		$_SESSION[$pcid][$pcommentid]]['logo']
			for ($i=0;$i<count($_SESSION[$pcid][$pcommentid]['images']);$i++) {

				if (count($_SESSION[$pcid][$pcommentid]['images']) > 0) {
					$file = $_SESSION[$pcid][$pcommentid]['images'][$i]['localpathfilename'];
					//prepare for unlinking older files
					//only once
					if($i==0){
						$pathparts=explode('\\',$file);
						if (count($pathparts)>1) {
							$sepdir = '\\';
						} else {
							$pathparts=explode('/',$file);
							$sepdir = '/';
						}
						$filename=$pathparts[count($pathparts)-1];
						unset($pathparts[count($pathparts)-1]);
						$pathofdir=implode($sepdir,$pathparts);

						$filesarr= $this->read_dir($pathofdir);

						$partsessionid = strstr($filename,'Gcidp', true );


						$partcommentid = strstr($filename,'Wcidp', false );
						$poscommentid = strpos($partcommentid, 'Gpix')-5;

						$partcommentid = substr($partcommentid,5, $poscommentid);

						$partcid = strstr($filename,'Gcidp', false );
						$poscid = strpos($partcid, 'Wcidp')-5;

						$partcid = substr($partcid,5, $poscid);
						$replaceinfilename = $partsessionid . 'Gcidp' . $partcid . 'Wcidp' . $partcommentid . 'Gpix';

						//now we unlink all the files matching pattern $partsessionid . 'Gcid' . $partcid  . 'Wcid' . $i_partcommentid . 'Gpix' . $killer_i .   . 'Wend'
						// and - optional - '_logo'
						// where $killer_i is the running index and $i_partcommentid < $partcommentid
						for($ifile = 0; ($ifile < (count($filesarr))); $ifile++) {
							$ipartsessionid = strstr($filesarr[$ifile],'Gcidp', true );
							$ipartcommentid = strstr($filesarr[$ifile],'Wcidp', false );
							$iposcommentid = strpos($ipartcommentid, 'Gpix')-5;
							$ipartcommentid = substr($ipartcommentid,5, $iposcommentid);
							$ipartcid = strstr($filesarr[$ifile],'Gcidp', false );
							$iposcid = strpos($ipartcid, 'Wcidp')-5;
							$ipartcid = substr($ipartcid,5, $iposcid);
							$unlinked=0;
							if ($ipartsessionid == $partsessionid) {
								if ($ipartcid == $partcid) {
									if ($ipartcommentid < $partcommentid) {
										// yes, then unlink it...
										unlink($pathofdir. $sepdir . $filesarr[$ifile]);
										$unlinked=1;
										//$savelog .= "unlink $pathofdir$sepdir$filesarr[$ifile] ,\n";

									}
								}
							}
							if ($unlinked==0) {
							//then check if file is older than cache time and if yes bye
								$filetime= filemtime($pathofdir. $sepdir . $filesarr[$ifile]);
								if (($conf_cachetimetemppics-$filetime)>0 ) {
									unlink($pathofdir. $sepdir . $filesarr[$ifile]);
									$unlinked=1;
									//$savelog .= "unlink because of age $pathofdir$sepdir$filesarr[$ifile] ,\n";
								}
							}
						}
					}
					$copytofile=$_SESSION[$pcid][$pcommentid]['images'][$i]['localpathfilename'];
					$linktofile=$_SESSION[$pcid][$pcommentid]['images'][$i]['locallink'];
					$copytofile=str_replace($replaceinfilename,$replacebyinfilename,$copytofile);
					$copytofile=str_replace('Wendtemp','',$copytofile);
					$linktofile=str_replace($replaceinfilename,$replacebyinfilename,$linktofile);
					$linktofile=str_replace('Wendtemp','',$linktofile);

					$photos_etc .= str_replace('/','',str_replace('uploads\\tx_toctoccomments\\temp\\','',str_replace($this->webpagepreviewtempfolder,'',$linktofile))) . ',';
					$newfile = str_replace('\\temp\\','\\webpagepreview\\',str_replace('/temp/','/webpagepreview/',$copytofile));

					if (!copy($file, $newfile)) {
						$savelog .= "failed imagescopy nr $i for $file to $newfile\n";
						break;
					}
				}
			}
			// copy logo from pics from		$_SESSION[$pcid][$pcommentid]]['images'][$i]
			if ($_SESSION[$pcid][$pcommentid]['logo'] !='') {
				$copytofile=$_SESSION[$pcid][$pcommentid]['logofile'];
				$linktofile=$_SESSION[$pcid][$pcommentid]['logo'];
				$copytofile=str_replace($replaceinfilename,$replacebyinfilename,$copytofile);
				$copytofile=str_replace('Wendtemp','',$copytofile);
				$linktofile=str_replace($replaceinfilename,$replacebyinfilename,$linktofile);
				$linktofile=str_replace('Wendtemp_logo','',$linktofile);

				$photo_main = str_replace('uploads\\tx_toctoccomments\\temp\\','',str_replace($this->webpagepreviewtempfolder,'',$linktofile));
				$photo_main = str_replace('/','',$photo_main);
				$file = $_SESSION[$pcid][$pcommentid]['logofile'];
				$newfile = str_replace('\\temp\\','\\webpagepreview\\',str_replace('/temp/','/webpagepreview/',$copytofile));

				if (!copy($file, $newfile)) {
					$savelog .= "failed logocopy nr$i for $file to $newfile\n";
				}
			}
					//return "photomain $photo_main  \n";
			if ($_SESSION[$pcid][$pcommentid]['urlfound'] != '') {
				//if it's '', then CURL had an error

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
				//get the uid
				$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();
			}
		}
		/// Set the attachments mm without reference yet to the comment (which actually does not yet exist, apart if cached)

		$cacheuid=0;
		$rowsattm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_attachment_mm.uid AS uid',
				'tx_toctoc_comments_attachment_mm',
				'tx_toctoc_comments_attachment_mm.userurltext="' . $_SESSION[$pcid][$pcommentid]['url'] . '" AND tx_toctoc_comments_attachment_mm.attachmentid=' . $newUid . ' AND tx_toctoc_comments_attachment_mm.deleted=0',
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
	 * @param	[type]		$uploadedfile: ...
	 * @param	[type]		$originalfilename: ...
	 * @return	void
	 */
	protected function cleanupdbandfiles($conf,$uploadedfile='',$originalfilename='') {
		if ($uploadedfile=='') {
			$conf_cachetime = $conf['attachments.']['webpagePreviewCacheTimePage'];
			$conf_cachetime =(time() - ($conf_cachetime *60));

			// we need all rows in tx_toctoc_comments_attachment_mm which are older than the cachetime and which are not linked to a comment

			$rowsattm = $GLOBALS['TYPO3_DB']->exec_DELETEquery 	('tx_toctoc_comments_attachment_mm',
					'tx_toctoc_comments_attachment_mm.tstamp < ' . $conf_cachetime . ' AND tx_toctoc_comments_attachment_mm.uid NOT IN (SELECT DISTINCT attachment_id FROM tx_toctoc_comments_comments)'
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
				$rowsciduidstr.=$rowtwp['uid'] .  ',';
				$flexData = t3lib_div::xml2array($rowtwp['pi_flexform']);
				if (is_array($flexData)) {
					$rowscidflex = t3lib_div::trimExplode(',',$flexData['data']['sAttachments']['lDEF']['useTopWebpagePreview']['vDEF']);
					if (($rowscidflexstr !='') &&(count($rowscidflex)>0)) {
						$rowscidflexstr .= ',';
					}
					$rowscidflexstr .= implode(',', $rowscidflex);
				}
			}
			$wherettcontnt ='';
			if ($rowscidflexstr!='') {
				$wherettcontnt = ' AND tx_toctoc_comments_attachment.uid NOT IN (' . $rowscidflexstr . ')';
			}
			// now get the true deletion "victims" ....
			$rowsattmmm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_attachment',
					'tx_toctoc_comments_attachment.tstamp < ' . $conf_cachetime . $wherettcontnt . ' AND tx_toctoc_comments_attachment.uid NOT IN (SELECT DISTINCT attachmentid FROM tx_toctoc_comments_attachment_mm)',
					'',
					'');

			$dirsep=DIRECTORY_SEPARATOR;
			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
			$dirsep=str_replace($repstr,'',dirname(__FILE__));

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirroot= str_replace('/','\\',$dirsep);
			} else {
				$txdirroot=$dirsep ;
			}



			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirname= str_replace('/','\\',$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder);
			} else {
				$txdirname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder;
			}

			if (count($rowsattmmm) >0) {
				for($i = 0; $i < count($rowsattmmm); $i++) {

					if ($rowsattmmm[$i]['photo_main']!='') {

						unlink($txdirname . $rowsattmmm[$i]['photo_main']);

					}
					$arrimages = explode(',',$rowsattmmm[$i]['photos_etc']);

					for ($j = 0; $j < count($arrimages)-1; $j++) {
						unlink($txdirname . $arrimages[$j]);
					}
				}
			}
			$rowsattm = $GLOBALS['TYPO3_DB']->exec_DELETEquery 	('tx_toctoc_comments_attachment',
					'tx_toctoc_comments_attachment.tstamp < ' . $conf_cachetime . $wherettcontnt . ' AND tx_toctoc_comments_attachment.uid NOT IN (SELECT DISTINCT attachmentid FROM tx_toctoc_comments_attachment_mm)'
			);
		} else {
			//no db clean up needed- just kill the files in temp
			$dirsep=DIRECTORY_SEPARATOR;
			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
			$dirsep=str_replace($repstr,'',dirname(__FILE__));

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirroot= str_replace('/','\\',$dirsep);
			} else {
				$txdirroot=$dirsep ;
			}

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirtmpname= str_replace('/','\\',$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder);
			} else {
				$txdirtmpname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder;
			}


			$picturefilenamearr=explode('.',$uploadedfile);
			$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_big';
			$picturefilenamebig= implode('.',$picturefilenamearr);

			$picturefilenamearr=explode('.',$uploadedfile);
			$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_list';
			$picturefilenamelist= implode('.',$picturefilenamearr);

			if ($originalfilename !='') {
				unlink($txdirtmpname . $originalfilename);
			}
			unlink($txdirtmpname . $uploadedfile);
			unlink($txdirtmpname . $picturefilenamebig);
			unlink($txdirtmpname . $picturefilenamelist);
		}
	}
	/**
	 * Checks the cached webpage preview in the db and if a hit is there, shows these infos ($_SESSION is filled from DB, not from page scanner)
	 *
	 * @param	int		$pcid: content element id
	 * @param	int		$pcommentid: comment id
	 * @param	string		$url: url to check for
	 * @param	boolean		$isbeforefetch: if it's before or after a fetch by the webpage scanner
	 * @param	[type]		$isbeforefetch: ...
	 * @return	int		$cacheuid: ID of the cache attachment
	 */
	protected function getwebpagecache($pcid,$pcommentid, $conf, $url='', $isbeforefetch = false) {
		$conf_cachetime = $conf['attachments.']['webpagePreviewCacheTimePage']; //3 hours
		$conf_cachetime =(time() - ($conf_cachetime *60));
		$cacheuid=0;
		if ($isbeforefetch) {
		// check the att_mm for 'url', get the one with the highest ID
			$cacheattachmentid=0;
			$rowsattm = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tx_toctoc_comments_attachment_mm.uid AS uid,tx_toctoc_comments_attachment_mm.attachmentid AS attachmentid',
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
						if ($rowsattmmm[0]['photo_main']!='') {
							$_SESSION[$pcid][$pcommentid]['logo'] ='/uploads/tx_toctoccomments/webpagepreview/' . $rowsattmmm[0]['photo_main'];
						}
						$arrimages = explode(',',$rowsattmmm[0]['photos_etc']);

						for ($i = 0; $i < count($arrimages)-1; $i++) {
							$_SESSION[$pcid][$pcommentid]['images'][$i]['locallink']='/uploads/tx_toctoccomments/webpagepreview/' . $arrimages[$i];
						}

						$_SESSION[$pcid][$pcommentid]['totalcounter'] = count($_SESSION[$pcid][$pcommentid]['images']);
						$_SESSION[$pcid][$pcommentid]['exectime'] = 0;
						$_SESSION[$pcid][$pcommentid]['needgoogle'] = 0;
						$_SESSION[$pcid][$pcommentid]['urlanalyzing']='';
						$_SESSION[$pcid][$pcommentid]['logofile'] ='';

						$fullurlarr = parse_url($rowsattmmm[0]['systemurltext']);
						$strpathout='';
						if (isset($fullurlarr['path'])) {
							if (strlen ($fullurlarr['path']) >30) {
								$strpathout=trim(substr($fullurlarr['path'],0,30)) . ' ...';

							} else{
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
						'tx_toctoc_comments_attachment.systemurltext="' . $_SESSION[$pcid][$pcommentid]['urlfound'] . '" AND tx_toctoc_comments_attachment.tstamp='. $keytstamp .' AND tx_toctoc_comments_attachment.deleted=0',
						'',
						'');
				if (count($rowsattmmm) >0) {
						$cacheuid=$rowsattmmm[0]['uid'];
				}

			}

			return $cacheuid ;
		}
	}

	/**
	 * Returns an array with filenames of a directory
	 *
	 * @param	string		$dir: .directory.
	 * @param	array		$array: exluded files (if any)
	 * @return	array		$files: filenames found in $dir
	 */
	protected function read_dir($dir, $array = array()){
		$dh = opendir($dir);
		$files = array();
		while (($file = readdir($dh)) !== false) {
			$flag = false;
			if($file !== '.' && $file !== '..' && !in_array($file, $array)) {
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
	protected function commentShowWebpagepreview ($rowattachmentid,$rowattachment_subid,$conf,$pObj,$cid,$topwebsitepreview,$fromAjax, $row = array(), $isforemailnotification = false) {
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

		$plinkhomepage='/';
		$palign='';
		if ($isforemailnotification) {
			$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
			$plinkhomepage=(@$_SERVER["HTTPS"] == "on") ? "https://" : "http://" . $myhomepagelinkarr[1];

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
				$this->smiliesPath = str_replace('EXT:toctoc_comments/','/' . t3lib_extMgm::siteRelPath('toctoc_comments'),$conf['smiliePath']);
				$this->smilies = $this->parseSmilieArray($conf['smilies.']);
				$desriptionweb = $this->trimContent($rowsatt[0]['description'],$conf,$conf['attachments.']['webpagePreviewDescriptionLength']);
				$desriptionweb = nl2br($this->createLinks($desriptionweb, $conf));
				$desriptionweb = $this->replaceSmilies($desriptionweb, $conf);
				$desriptionweb = $this->replaceBBs($desriptionweb, $conf,true);
			} else {
				$desriptionweb=$rowsatt[0]['description'];
			}
			//$desriptionweb=$rowsatt[0]['description'];
			if ($rowsatt[0]['photo_main']!='') {
				$logostr .= '<div class="tx-tc-pvs-logobg-ct">';//style="height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px; margin-top: -' . $conf['attachments.']['webpagePreviewHeight'] . 'px; "
				$logostr .= '<img src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rowsatt[0]['photo_main'] . '" ' . $palign . ' style="margin: 4px 0 0;max-height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px; max-width:' . (30+$conf['attachments.']['webpagePreviewHeight']) . 'px; float:right; ">';
				$logostr .= '</div>';
			}

			$textareamargin=2;
			if (trim($rowsatt[0]['photos_etc']!='')) {
				$textareamargin=$conf['attachments.']['webpagePreviewHeight']+7;
				$rrpic=explode(',',$rowsatt[0]['photos_etc']);
				$rrpicpic=$rrpic[$rowattachment_subid];

				$rrpicpicweb = str_replace('_big.','_list.',$rrpicpic);
				if (!$isforemailnotification) {
					if ($rowsatt[0]['attachmentvariant']==1) {
						$picstr .= '<div class="tx-tc-ct-pvs-images" style="float: left; ">';
					} else {
						$picstr .= '<div class="tx-tc-ct-img-images">';
					}
					$picstr .= '<div>';
				}

				if ($rowsatt[0]['attachmentvariant']==1) {
					if ($isforemailnotification) {
						$palign=' align="left" hspace="4" ';
					}
					$picstr .= '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage .  $this->webpagepreviewsavefolder . $rrpicpic . '" ';
					$picstr .= 'class="tx-tc-pvs-img" />';
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
							$picsrcstr= '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpic . '" ';
							$picsrcstr .= 'class="tx-tc-images-img-browse" />';
						} else {
							$picsrcstr = '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rowsatt[0]['photo_main'] . '" ';
							$picsrcstr .= ' />';

						}
					} else {
						//pdf no pvpic
						$picsrcstr= '<img title="' . $rowsatt[0]['title'] . '" style="display: block;"  ' . $palign . ' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/adobepdf.png" ';
						$picsrcstr .= 'class="tx-tc-images-img-browse" />';
					}
					if (count($rrpic)>1) {
						//pic
						if (!$isforemailnotification) {
							$picstr = '<img rel="#txtcphoto' . $cid . '" title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpicweb . '" ';
							$picstr .= 'class="tx-tc-images-img" />';
						} else {
							$picstr = '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rowsatt[0]['photo_main'] . '" ';
							$picstr .= ' />';

						}
					} elseif (count($rrpic)==1) {
						//pdf with previewpic
						if (!$isforemailnotification) {
							$picstr = '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpicweb . '" ';
							$picstr .= 'class="tx-tc-images-img" />';
						} else {
							$picstr = '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . $this->webpagepreviewsavefolder . $rrpicpicweb . '" ';
							$picstr .= ' />';

						}
						$link='' . $plinkhomepage . $this->webpagepreviewsavefolder . $ttfeuserid . str_replace(' ', '_', $rowsatt[0]['systemurltext']);
					} else {
						//pdf
						$picstr = '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/adobepdf.png" ';
						$picstr .= 'class="tx-tc-images-img" />';
						$link='' . $plinkhomepage . $this->webpagepreviewsavefolder . $ttfeuserid . str_replace(' ', '_', $rowsatt[0]['systemurltext']);

					}
					$sizeout=intval($rowsatt[0]['attachmentfilesize']/1024);
					if ($sizeout>1024) {
						$sizeout=round(($sizeout/1024),2);
						$linktitle .= ' (' . $sizeout . ' MB)';
					} else {
						if ($sizeout !=0){
							$linktitle .= ' (' . $sizeout . ' KB)';
						}
					}
				}

			} else {
				if ($rowsatt[0]['attachmentvariant']==2) {
					//pdf no pvpic
					$linktitle =$rowsatt[0]['systemurltext'];
					$picsrcstr= '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/adobepdf.png" ';
					$picsrcstr .= 'class="tx-tc-images-img-browse" />';
					$picstr = '<img title="' . $rowsatt[0]['title'] . '" style="display: block;" ' . $palign . ' src="' . $plinkhomepage . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/adobepdf.png" ';
					$picstr .= 'class="tx-tc-images-img" />';
					$link=$plinkhomepage . $this->webpagepreviewsavefolder . $ttfeuserid . str_replace(' ', '_', $rowsatt[0]['systemurltext']);
					$sizeout=intval($rowsatt[0]['attachmentfilesize']/1024);
					if ($sizeout>1024) {
						$sizeout=round(($sizeout/1024),2);
						$linktitle .= ' (' . $sizeout . ' MB)';
					} else {
						if ($sizeout !=0){
							$linktitle .= ' (' . $sizeout . ' KB)';
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
					$strpathout=trim(substr($fullurlarr['path'],0,30)) . ' ...';
				} else{
					$strpathout=trim($fullurlarr['path']);
				}
			}
			$strUrlText = trim($fullurlarr['host']) . $strpathout;

			if (!$isforemailnotification) {
				if ($rowsatt[0]['attachmentvariant']==1) {
					$templateattachmentHTML = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMATTACHMENTWPP###');
					$attachmentHTML =  $pObj->cObj->substituteMarkerArray($templateattachmentHTML, array(
						'###PVSHEIGHT05###' => ($conf['attachments.']['webpagePreviewHeight']+5),
						'###PVSHEIGHT15###' => ($conf['attachments.']['webpagePreviewHeight']+15),
						'###PVSHEIGHT###' => $conf['attachments.']['webpagePreviewHeight'],
						'###URL###' => $rowsatt[0]['systemurltext'],
						'###TITLE###' => $this->trimContent($rowsatt[0]['title'],$conf,$conf['attachments.']['maxCharsPreviewTitle']),
						'###IMAGE###' => $picstr,
						'###URLTEXT###' => $strUrlText,
						'###DESC###' => $rowsatt[0]['description'],
						'###LOGOBG###' => $logostr,
						'###TEXTAREAMARGIN###' => $textareamargin,
						'###CID###' => $cid,
						'###IDPLUS###' => $idplusstr,
				));
				} elseif ($rowsatt[0]['attachmentvariant']==2) {
					$templateattachmentHTML = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMATTACHMENTPIC###');
					$attachmentHTML =  $pObj->cObj->substituteMarkerArray($templateattachmentHTML, array(
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###IMAGESRC###' => $picsrcstr,
							'###DESC###' => $desriptionweb,
							'###CID###' => $cid,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $link,
							'###LINKTITLE###' => $linktitle,
					));
				}
			} else {
				if ($rowsatt[0]['attachmentvariant']==1) {
					$templateattachmentHTML = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMATTACHMENTWPPMAIL###');
					$attachmentHTML =  $pObj->cObj->substituteMarkerArray($templateattachmentHTML, array(
							'###URL###' => $rowsatt[0]['systemurltext'],
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###URLTEXT###' => $strUrlText,
							'###DESC###' => $rowsatt[0]['description'],
							'###TXTATTACHMENT###' => $this->pi_getLLWrap($pObj, 'email.attachment_webpagepreview', $fromAjax),
					));
				} elseif ($rowsatt[0]['attachmentvariant']==2) {
					$templateattachmentHTML = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMATTACHMENTPICMAIL###');
					$attachmentHTML =  $pObj->cObj->substituteMarkerArray($templateattachmentHTML, array(
							'###TITLE###' => $rowsatt[0]['title'],
							'###IMAGE###' => $picstr,
							'###DESC###' => $desriptionweb,
							'###IDPLUS###' => $idplusstr,
							'###LINK###' => $link,
							'###LINKTITLE###' => $linktitle,
							'###TXTATTACHMENT###' => $this->pi_getLLWrap($pObj, 'email.attachment_pdforpicture', $fromAjax),
					));
				}
			}
		}
		else {
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
	protected function makeAttachementPicture($picturefilename,$conf,$descriptionbyuser,$originalfilename, $firstname, $lastname,$fetoctocusertoinsert) {

		//check if pic is in temp and them move the 2 pics in attachments
		$dirsep=DIRECTORY_SEPARATOR;
		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
		$dirsep=str_replace($repstr,'',dirname(__FILE__));
		$filesize=0;
		$picturefilenamesav=$picturefilename;
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirroot= str_replace('/','\\',$dirsep);
		} else {
			$txdirroot=$dirsep ;
		}
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirname= str_replace('/','\\',$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder);
		} else {
			$txdirname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewsavefolder;
		}
		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirtmpname= str_replace('/','\\',$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder);
		} else {
			$txdirtmpname=$txdirroot . DIRECTORY_SEPARATOR . $this->webpagepreviewtempfolder;
		}
		$photos_etc='';
		$originalfilenamearr=explode('.',$originalfilename);
		$pdfsave=false;
		if ($originalfilenamearr[count($originalfilenamearr)-1]=='pdf') {
			$pdfsave=true;
			$copyfromfile=$txdirtmpname . $originalfilename;
			$outfile=str_replace(' ', '_', $originalfilename);
			$outfile=$fetoctocusertoinsert . $outfile;

			$copytofile=$txdirname . $outfile;
			if (!copy($copyfromfile, $copytofile)) {
				return "failed imagescopy for $copyfromfile to $copytofile\n";

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
			return "failed imagescopy for $copyfromfile to $copytofile\n";
			}
			$picturefilenamearr=explode('.',$picturefilename);
					$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_big';
					$picturefilenamebig= implode('.',$picturefilenamearr);
					$copyfromfile=$txdirtmpname . $picturefilenamebig;
					$copytofile=$txdirname . $picturefilenamebig;
					if (!copy($copyfromfile, $copytofile)) {
					return "failed imagescopy for $copyfromfile to $copytofile\n";

			} else {
			$photos_etc = $picturefilenamebig;
			}
			$filesize=filesize($txdirtmpname . $picturefilenamebig);
			unlink($txdirtmpname . $picturefilenamebig);
			}
			$picturefilenamearr=explode('.',$picturefilename);
			$picturefilenamearr[count($picturefilenamearr)-2] = $picturefilenamearr[count($picturefilenamearr)-2] .'_list';
			$picturefilenamelist= implode('.',$picturefilenamearr);
			$copyfromfile=$txdirtmpname . $picturefilenamelist;
			$copytofile=$txdirname . $picturefilenamelist;
			$picturefilenamelistpdf=$picturefilenamelist;
			if (!copy($copyfromfile, $copytofile)) {
			return "failed imagescopy for $copyfromfile to $copytofile\n";
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
	$title_filenamebyuser=$this->trimContent(trim($firstname . ' ' . $lastname) . ': ' . $descriptionbyuser,$conf, 30);
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
						'photos_etc' => $photos_etc ,
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
				'');
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

	return 0;
	}

	/**
	 * eID-Interface functions
	 *
	 *
	 */

	/**
	 * Handles request from the eID-Interfaces, grabs the template and generated the HTML-Page
	 *
	 * @param	???		$uid: obsolete and in fact not needed here
	 * @param	array		$conf: ...
	 * @param	object		$pObj: parent object
	 * @param	string		$messagetodisplay: the message from eID to display on the page
	 * @param	string		$refreshurl: Refreh-URL for the http-equiv=refresh redirects
	 * @return	string		$content: Content to be display by eID
	 */
	public function handleeID($uid, $conf,$pObj,$messagetodisplay,$refreshurl) {
		$content='';
		$fromAjax= true;
		$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['advanced.']['eIDHTMLTemplate']);
		$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);

		$templateCode = @file_get_contents(PATH_site . $usetemplateFile);



		$pageTitle=$conf['pageTitle'];
		$linktocomment = $conf['pageURL'];


		$infoleft='';

		$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
		$myhomepagelink=$myhomepagelinkarr[1];
		$refresh='';
		$waittext='';
		if ($refreshurl !='') {
			if (substr($refreshurl,0, 9) =='tocomment') {
				// dbaction
				$optinemail=$conf['optinemail'];
				$optin_ip=$conf['optin_ip'];
				$commentrowconfirmed= $this->emailOptIn($conf, $optinemail, $optin_ip);
				if (is_array($commentrowconfirmed)) {
					//all went ok.
					if (count($commentrowconfirmed)>0) {
						if (strpos($linktocomment,'?') > 0) {
							$linktocomment .= '&';
						} else {
							$linktocomment .= '?';
						}
						/* print_r($conf);
						print 'toctoc_comments_pi1[anchor]=' . substr($conf['aP'],1).$commentrowconfirmed['uid'] . $conf['aP'].$commentrowconfirmed['uid'];
						print '<br>';
						print_r($commentrowconfirmed);
						exit; */
						$linktocomment .= 'toctoc_comments_pi1[anchor]=' . substr($conf['aP'],1).$commentrowconfirmed['uid'] . $conf['aP'].$commentrowconfirmed['uid'];
						//$linktocomment .= $conf['aP'].$commentrowconfirmed['uid'];
					}
				}
				//exit;
				if ($refreshurl =='tocomment') {
					$refresh="<meta http-equiv=\"refresh\" content=\"0;URL=$linktocomment\">";
				} else {
					$refreshurl=substr($refreshurl,9);
					$refresh="";
				}
			} else {
				$refresh="<meta http-equiv=\"refresh\" content=\"0;URL=$refreshurl\">";
			}
			if ($refresh!='') {
				$waittext=$this->pi_getLLWrap($pObj, 'eid_template.pleasewaitprocessing', $fromAjax);
				$waittext.='<img style="display:block;margin: 0 4px;" align="left" src="' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/workingslides.gif" width="16" ';
				$waittext.='height="11" title="' . $this->pi_getLLWrap($pObj, 'eid_template.titleprocessing', $fromAjax) . '" />';
			}
			else{
				$waittext='<br /><br />' . $this->pi_getLLWrap($pObj, 'eid_template.processingdone', $fromAjax);
			}
		} else {
			$waittext='<br /><br />' . $this->pi_getLLWrap($pObj, 'eid_template.processingdone', $fromAjax);
		}
		$markerArray = array(
				'###MESSAGE###' => $this->pi_getLLWrap($pObj, 'commentatorEmail.message', $fromAjax),
				'###WAITTEXT###' => $waittext,
				'###LINK_TO_COMMENT###' => $linktocomment,
				'###REFRESHURL###' =>$refresh,
				'###MESSAGETYPE###'  => $this->pi_getLLWrap($pObj, 'eid_template.messagetype', $fromAjax),
				'###MESSAGEDISPLAY###'  => $messagetodisplay,
				'###INFOSLEFT###'  => $infoleft,
				'###INFOSRIGHT###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
				'###MYHOMEPAGE###'  => $myhomepagelink,
				'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
				'###MYHOMEPAGELINK###'  => t3lib_div::locationHeaderUrl(''),
				'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
				'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
		);
		$content = $pObj->cObj->substituteMarkerArray($templateCode, $markerArray);

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
 * @return	string		$displaystr: css-style for display
 */
	protected function getCommentBoxDisplay($commentid,$conf,$level,$fromAjax) {
		$donotdisplay= false;
		if (array_key_exists($commentid, $this->tctreestate)) {
			if ($fromAjax) {
				if ($this->tctreestate[$commentid]==1) {
					$donotdisplay= true;
				}
			} else {
				if ($level>=$conf['advanced.']['userCommentResponseLevelExpanded']) {
					$donotdisplay= true;
				} else {
					if ($this->tctreestate[$commentid]==1) {
						$donotdisplay= true;
					}
				}
			}
		}
		if (!$fromAjax) {
			if ($level>=$conf['advanced.']['userCommentResponseLevelExpanded']) {
				$donotdisplay= true;
			}
		} else {
			if ($level>=$conf['advanced.']['userCommentResponseLevelExpanded']) {
				if (!array_key_exists($commentid, $this->tctreestate)) {
					$donotdisplay= true;
				}
			}
		}

		if ($level > $this->tctreelastlevel) {
			if (!$this->tctreelastdisplay) {
				$donotdisplay= true;
			} else {
				$this->tctreelastlevel=$level;

			}
		} else {
			$this->tctreelastlevel=$level;

		}
		if ($donotdisplay) {
			$displaystr= 'display: none; ';
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
	 * @return	boolean		...
	 */
	protected function getCommentBoxChildrenDisplayIsCollapsed($commentschildrenids,$conf,$level,$fromAjax) {
		//userCommentResponseLevelExpanded
		$commentschildrenarr = explode(',',trim($commentschildrenids));
		$controlstate=0;
		for ($i = 0; $i < count($commentschildrenarr); $i++) {
			$keycandidate=intval(trim($commentschildrenarr[$i]));
			if ($keycandidate!=0){
				if (array_key_exists($keycandidate, $this->tctreestate)) {
					if ($fromAjax) {
						if ($this->tctreestate[$keycandidate]==1) {
							$controlstate++;
						}
					} else {
						if ($level<$conf['advanced.']['userCommentResponseLevelExpanded']) {
							if ($this->tctreestate[$keycandidate]==1) {
								$controlstate++;
							}
						}
					}
				}
				if (!$fromAjax) {
					if ($level+1>=$conf['advanced.']['userCommentResponseLevelExpanded']) {
							$controlstate++;
					}
				} else {
					if ($level+1>=$conf['advanced.']['userCommentResponseLevelExpanded']) {
						if (!array_key_exists($keycandidate, $this->tctreestate)) {
							$controlstate++;
						}
					}
				}
			}
		}
		if  (count($commentschildrenarr)==$controlstate) {
			return true;
		} else {
			return false;
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
	 * @return	string		List of users like (123, 234, 244, 245)
	 */
	public function usersGroupmembers($pObj, $fromAjax, $conf) {
		if (!$fromAjax) {
			global $TSFE;
			$usersfromenvironment='';
			if ($conf['advanced.']['wallExtension'] != 0) {
				if ($conf['advanced.']['wallExtension'] == 1) {
					//tx_community

					$relationtable ='tx_community_domain_model_relation';
					$userfields ='initiating_user AS uid1,requested_user AS uid2';
					$where ='status=2 AND deleted=0 AND hidden=0 AND (initiating_user=' . $TSFE->fe_user->user['uid'] . ' OR requested_user=' . $TSFE->fe_user->user['uid'] .')';
					//?&tx_community[action]=show&tx_community[controller]=User&tx_community[user]=67

				} elseif  ($conf['advanced.']['wallExtension']== 2) {
					//tx_community
					$relationtable ='tx_cwtcommunity_buddylist';
					$userfields ='fe_users_uid AS uid1,buddy_uid AS uid2';
					$where ='deleted=0 AND hidden=0 AND (fe_users_uid=' . $TSFE->fe_user->user['uid'] . ' OR buddy_uid=' . $TSFE->fe_user->user['uid'] .')';

					//&action=getviewprofile&uid=67
				} else {
					// unknown community wall option
				}
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($userfields, $relationtable,
						$where );

				if (count($rows) > 0) {
					foreach ($rows as $row) {
						$usersfromenvironment.= $row['uid1'] . ',' . $row['uid2'] . ',';
					}
				}
				$input=$TSFE->fe_user->user['uid'] . ',' . substr($usersfromenvironment,0,strlen($usersfromenvironment)-1);
				$usersfromenvironment = implode(',',array_unique(explode(',',$input)));
				if (substr($usersfromenvironment,strlen($usersfromenvironment)-1)==',') {
					$usersfromenvironment = substr($usersfromenvironment,0,strlen($usersfromenvironment)-1);
				}
				//print $where;exit;
			} else {
				$groupSelectArray =explode(',', $TSFE->fe_user->user['usergroup']);
				$where = '( ';
				$whereConn = 'OR';
				$whereLike = 'LIKE';
				for ($i=0;$i<count($groupSelectArray);$i++) {
					if ($i<>0) $where.= $whereConn;
					$where.= ' usergroup '.$whereLike.' "'.$groupSelectArray[$i].'" '.$whereConn.' usergroup '.$whereLike.' "%,'.$groupSelectArray[$i].'" '.$whereConn.' usergroup '.$whereLike.' "'.$groupSelectArray[$i].',%" '.$whereConn.' usergroup '.$whereLike.' "%,'.$groupSelectArray[$i].',%" ';
				}
				$where.=')';

				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid', 'fe_users',
						$where .
						$this->enableFields('fe_users',$pObj));

				if (count($rows) > 0) {
					foreach ($rows as $row) {
					$usersfromenvironment.= $row['uid'] . ',';
					}
				}
				$usersfromenvironment=substr($usersfromenvironment,0,strlen($usersfromenvironment)-1);
			}
			$_SESSION['usersfromenvironment']=$usersfromenvironment;
		} else {
			$usersfromenvironment=$_SESSION['usersfromenvironment'];
		}

		return $usersfromenvironment;
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
	 * @param	[type]		$feuserid: ...
	 * @return	string		Generated HTML
	 */
	public function getRecentComments($pObj, $conf,$feuserid) {
		$pObj->pi_USER_INT_obj = 0;    // Configuring so caching is expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!

		$where = 'tx_toctoc_comments_comments.pid = ' . $conf['storagePid'] . $this->enableFields('tx_toctoc_comments_comments',$pObj);
		$where .= ' AND tx_toctoc_comments_comments.approved =1';
		$condfeusergroup='';
		if ($conf['restrictToExternalPrefix'] !='') {
				$condfeusergroup= ' AND tx_toctoc_comments_comments.external_prefix = "' . $conf['restrictToExternalPrefix'] . '"';
		}
		if (((intval($conf['advanced.']['wallExtension']) != 0) && (intval($feuserid) !=0)) OR
				(($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) !=0) && ($conf['advanced.']['showFeUsercomments']==1))) {
			$condfeusergroup .= ' AND toctoc_commentsfeuser_feuser IN ('. $this->usersGroupmembers($pObj, $fromAjax, $conf) . ')';
		} else {
			if (($conf['advanced.']['showFeUsercommentsOnlyInSameUserGroup']==1) && (intval($feuserid) ==0)) {
				$condfeusergroup .= ' AND toctoc_commentsfeuser_feuser=0';
			}
		}

		if ($conf['advanced.']['showFeUsercomments']==0){
			$condfeusergroup='';
			$condfeusergroup = ' AND toctoc_commentsfeuser_feuser=0';
		}

		$where .= $condfeusergroup;
		$sorting = $conf['recentcomments.']['sorting'];

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'"dummy" AS refTitle, tx_toctoc_comments_comments.uid AS uid, tx_toctoc_comments_comments.crdate AS crdate,
            tx_toctoc_comments_comments.firstname AS firstname, tx_toctoc_comments_comments.lastname AS lastname,
            tx_toctoc_comments_comments.content AS content, tx_toctoc_comments_comments.external_ref AS external_ref,
 			tx_toctoc_comments_comments.external_ref_uid AS external_ref_uid,
 			tx_toctoc_comments_comments.external_prefix AS external_prefix,
 			tx_toctoc_comments_comments.crdate AS crdate',
				'tx_toctoc_comments_comments',
				$where,
				'',
				$sorting,
				'50' //$listCount
		);

		$subParts = array(
				'###SINGLE_RECENTCOMMENT###' => $this->comments_getRecentComments($rows,$conf,$pObj),
		);

		$markers = array();

		// Fetch template
		$template = $pObj->cObj->getSubpart($pObj->templateCode, '###RECENTCOMMENT_LIST###');

		// Merge
		return $this->substituteMarkersAndSubparts($template, $markers, $subParts, $pObj);
	}

	/**
	 * Generates list of recent comments
	 *
	 * @param	array		$rows	Rows from tx_toctoc_comments_comments
	 * @param	array		$conf
	 * @param	object		$pObj
	 * @return	string		Generated HTML
	 */
	protected function comments_getRecentComments($rows,$conf,$pObj) {
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');
		if (count($rows) == 0) {

			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###RECENTNO_COMMENTS###');
			if ($template) {
				return $pObj->cObj->substituteMarker($template, '###LL_TEXT_NO_COMMENTS###', $this->pi_getLLWrap($pObj, 'pi1_template.text_no_comments',false));
			}
		}

		$entries = array();
		$template= $pObj->cObj->getSubpart($pObj->templateCode, '###SINGLE_RECENTCOMMENT###');
		$listCount = $conf['recentcomments.']['listCount'];
		if ($conf['recentcommentslistCount']) {
			$listCount = $conf['recentcommentslistCount'];
		}
		$okrowsi=0;
		foreach ($rows as $row) {
			$externalprefix=$row['external_prefix'];
			$prefix=  $row['external_ref'];
			$posbeforeid = strrpos($prefix, '_')+1;
			$prefix=substr($row['external_ref'], 0, $posbeforeid);
			$mmtable=substr($row['external_ref'], 0, $posbeforeid-1);
			$refID = substr($row['external_ref'], $posbeforeid);

			$where = $mmtable. '.uid = ' . $refID;
			$targetfortitle='title';
					if ($mmtable== 'tx_wecstaffdirectory_info') {
				$targetfortitle='full_name';
			}
			if ($mmtable== 'fe_users') {
				$targetfortitle='name';
			}
			$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
					$mmtable . '.' . $targetfortitle . ' AS refTitle',
					$mmtable,
					$where,
					'',
					'',
					''
			);
			$row['refTitle']=$rowstitle[0]['refTitle'];
			$itemtitle = 'News';
			$cttitle = str_replace(':','',$this->pi_getLLWrap($pObj, 'pi1_template.textcommentlink', false)) ;
			$itemtitle = $this->pi_getLLWrap($pObj, 'comments_recent.' . $mmtable .'', false);

			$pageidrecord='';
			if ($prefix == 'pages_') {
				$pageid=$refID;
				//check ($conf['recentcommentsPluginpages']) from the plugins configuration for existance of the current pid
				$recentcommentsPluginpages=explode(',', $conf['advanced.']['recentcommentsPluginpages']);

				if (count($recentcommentsPluginpages) >0) {
					$i=0;
					$j=-1;
					foreach ($recentcommentsPluginpages as $rcpid) {
						if ($rcpid==$pageid) {
							$j=$i;
							break;
						}
						$i++;
					}
					if ($j != -1) {
						$recentcommentsPluginRecords=explode(',', $conf['advanced.']['recentcommentsPluginRecords']);
						$pageidrecord=$recentcommentsPluginRecords[$j]; // zb tt_news_21
						$prefix=$pageidrecord;
						$posbeforeid = strrpos($pageidrecord, '_')+1;
						$prefix=substr($pageidrecord, 0, $posbeforeid);
						$mmtable=substr($pageidrecord, 0, $posbeforeid-1);
						$refID = substr($pageidrecord, $posbeforeid);
						$where = 'deleted=0 AND pi1_table="' . $mmtable .'"';
						$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
								'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key',
								'tx_toctoc_comments_prefixtotable',
								$where,
								'',
								'',
								''
						);
						$externalprefix=$rowstitle[0]['pi1_key'];
					}
				}
				// if found we have all now to construct the param for the link
				$show_uid='';
			} else {
				// check value for uid
				$where = 'deleted=0 AND pi1_key="' . $externalprefix .'"';
				$rowstitle = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tx_toctoc_comments_prefixtotable.show_uid AS show_uid',
						'tx_toctoc_comments_prefixtotable',
						$where,
						'',
						'',
						''
				);
				$show_uid=$rowstitle[0]['show_uid'];

				$rowspage = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
						'tt_content.pid AS pid',
						'tt_content',
						'tt_content.uid =' . substr($row['external_ref_uid'], 11),
						'',
						'',
						''
				);
				if (count($rowspage)>0) {
					$pageid=$rowspage[0]['pid'];
				} else {
					//artificial content element id for tt_news hook
					$paID=substr($row['external_ref_uid'], 11,6);
					$pageid=intval($paID-100000);
				}
			}
			$this->applyStdWrap(htmlspecialchars($row['firstname']), 'firstName_stdWrap', $conf, $pObj);

			$commentID = $row['uid'];
			if ($prefix == 'pages_') {
				$exticon= '/typo3/sysext/cms/ext_icon.gif">';
			} elseif ($prefix == 'tt_news_') {
				$exticon= t3lib_extMgm::siteRelPath('tt_news') . 'ext_icon.gif">';
			} elseif ($prefix == 'tt_products_') {
				$exticon= t3lib_extMgm::siteRelPath('tt_products') . 'ext_icon.gif">';
			} elseif ($prefix == 'tx_wecstaffdirectory_info_') {
				$exticon= t3lib_extMgm::siteRelPath('wec_staffdirectory') .	'ext_icon.gif">';
			} elseif ($prefix == 'fe_users_') {
				$exticon= t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/img/usericon.gif">';
			} else {
				$exticon= t3lib_extMgm::siteRelPath('toctoc_comments') . 'ext_icon.gif">';
			}
			$commenttext = $this->trimContent($row['content'],$conf,$conf['recentcomments.']['maxCharCount']);
			//Parse for Links and Smilies
			$this->smiliesPath = str_replace('EXT:toctoc_comments/','/' . t3lib_extMgm::siteRelPath('toctoc_comments'),$conf['smiliePath']);
			$this->smilies = $this->parseSmilieArray($conf['smilies.']);
			//$contenttext = $this->applyStdWrap(nl2br($this->createLinks($content, $conf)), 'content_stdWrap', $conf, $pObj);
			$commenttext = $this->replaceSmilies($commenttext, $conf);
			$commenttext =$this->replaceBBs($commenttext, $conf,true);


			$titleimage = '<img class="tx-tc-rcentpic" width="14" height="14" valign="middle" title="' . $itemtitle  . '" src="' . $exticon;
			/*
			 * $commentimage = '<img class="tx-tc-ucpic" width="14" height="14" valign="middle" title="' . $cttitle  . '" src="' . t3lib_extMgm::siteRelPath('toctoc_comments') .	'ext_icon.gif">';
			 * $authorimage = '<img class="tx-tc-ucpic" width="14" height="14" valign="middle" title="' . $row['firstname'].' '.$row['lastname'] . '" src="' . t3lib_extMgm::siteRelPath('toctoc_comments') .	'res/img/uccontact.png">';
 			*/
			$commentimage = '';
			$authorimage = '';

			$link=$this->createRCLinks($commenttext, $refID, $commentID, $prefix, $mmtable, $externalprefix, $pageid, $conf,$show_uid);
			if ($link !=$commenttext) {
				$markerArray = array(
						'###AUTHOR###' => $this->applyStdWrap($authorimage. htmlspecialchars($row['firstname'].' '.$row['lastname']), 'author_stdWrap', $conf, $pObj),
						'###COMMENT_DATE###' => $this->applyStdWrap($this->formatDate($row['crdate'], $pObj, false, $conf), 'crdate_stdWrap', $conf, $pObj),
						'###TITLE###' => $this->applyStdWrap($titleimage . $this->createRCLinks(strip_tags($row['refTitle']), $refID, $commentID, $prefix, $mmtable, $externalprefix, $pageid, $conf,$show_uid), 'recentComment_stdWrap', $conf, $pObj),
						'###COMMENT_CONTENT###' => $this->applyStdWrap($commentimage. $link, 'content_stdWrap', $conf, $pObj),
				);
				$entries[] = $pObj->cObj->substituteMarkerArray($template, $markerArray);
				$okrowsi++;
			} else {
				// link did not resolve -> not accessible to user - we skip
			}
			if ($okrowsi>=$listCount) {
				break;
			}
		}
		return implode( $entries);
	}

	/**
	 * Trim recent comment
	 *
	 * @param	string		$text	Text to crop
	 * @param	array		$conf
	 * @param	[type]		$maxChars: ...
	 * @return	string		cropped Text
	 */
	protected function trimContent($text,$conf, $maxChars=0) {
		if ($maxChars==0) {
			$maxChars = $conf['recentcomments.']['maxCharCount'];
		}
		$text=nl2br($text);
		$htmlarr=explode('<br />', $text);
		$text=implode(' ', $htmlarr);


	/* 	$trimedText = htmlspecialchars(stripslashes(mb_substr($text, 0, $maxChars, 'utf-8')));
		if (strlen($trimedText) < strlen($text)) {
			return $trimedText . '...';
		} */
		$text=htmlspecialchars(stripslashes($text));
		$trimedText=$text;
		if (strlen($text)>$maxChars){
			$textcroppedleft = substr($text,0,$maxChars);
			$textcroppedright = substr($text,$maxChars);
			$textcroppedrightarr = explode(' ', $textcroppedright);
			if (count($textcroppedrightarr)>1) {
				$textcroppedleft .=$textcroppedrightarr[0] . ' ...';
				$trimedText =$textcroppedleft;
			}
		}
		return $trimedText;
	}

	/**
	 * Creates links for single recent comment-line
	 *
	 * @param	string		$text	Text to search for links
	 * @param	int		$refID
	 * @param	int		$commentID
	 * @param	string		$prefix
	 * @param	string		$table
	 * @param	string		$externalprefix
	 * @param	int		$singlePid
	 * @param	array		$conf
	 * @param	[type]		$show_uid: ...
	 * @return	string		Link
	 */
	protected function createRCLinks($text, $refID, $commentID, $prefix, $table, $externalprefix, $singlePid, $conf,$show_uid) {
		if ($conf['recentcomments.']['linkComments'] == 1) {
			if ($show_uid=='') {
				$show_uid = 'uid';
			}
			if (strpos($show_uid, '&')===false) {
				$getparams = $externalprefix .'[' . $show_uid . ']';
			} else {
				$getparams = $show_uid;
			}
			$params = array(
	                $getparams => $refID,
					'toctoc_comments_pi1[anchor]'=>substr($conf['recentcomments.']['anchorPre'],1).$commentID,
	            );
	        if ($prefix == 'pages_') {
        		$params = array(
        				'toctoc_comments_pi1[anchor]'=>substr($conf['recentcomments.']['anchorPre'],1).$commentID,
        		);
        	}
 			$conf = array(
        		'useCacheHash'     => 1,
        		'no_cache'         => 0,
        		'parameter'        => $singlePid.$conf['recentcomments.']['anchorPre'].$commentID,
        		'additionalParams' => t3lib_div::implodeArrayForUrl('',$params,'',1),
				'ATagParams' => 'rel="nofollow"',
        	);
        	$text = $this->cObj->typoLink($text, $conf);
        }

        return $text;
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
	protected function getCommentsReportLink($params, &$pObj, $conf ,$fromAjax,$pid) {

		$markers = &$params['markers'];
		$template = $pObj->cObj->getSubpart($pObj->templateCode, '###REPORT_LINK###');
		$theURLe = $_SESSION['commentsPageIds'][$pid];
		$queryParams='&toctoc_comments_pi1[info]=' . base64_encode(serialize(array(
				'url' => $theURLe,
				'uid' => $params['row']['uid'],
		)));

		if ($_SESSION['reportpage']==''){
			$markers['###TX_COMMENTSREPORT###'] ='';
		} else {
			$theURLr = $_SESSION['reportpage'];
			$theLink = $this->cObj->typoLink_URL(array(
					'parameter' => $theURLr . '?' . $queryParams,
					'ATagParams' => 'rel="nofollow"',
			));

			$markers['###TX_COMMENTSREPORT###'] = $pObj->cObj->substituteMarkerArray($template, array(
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
		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		$this->cObj->start('', '');

		$errors = array();
		if (!$this->processReportForm($errors,$conf, $pObj,$piVars)) {
			$content = $this->showReportForm($errors,$conf, $pObj, $piVars);
		}
		else {
			$content = $this->showReportThanks($conf,$pObj);
		}

		return $this->pi_wrapInBaseClass($content);
	}

	/**
	 * Processes the report form for complaints and sends message by e-mail
	 *
	 * @param	array		$errors
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$piVars: ...
	 * @return	boolean		true if successful
	 */
	protected function processReportForm(array &$errors,$conf, $pObj, $piVars) {
		$fromAjax=false;
		if ($piVars['submit']) {
			// Check captcha
			$captchaType = intval($conf['commentsreport.']['useCaptcha']);
			if ($captchaType == 1 && t3lib_extMgm::isLoaded('captcha')) {
				session_name('sess_' . $pObj->extKey);
				@session_start();    // As of PHP 4.3.3, calling session_start() while the session has already been started will result in an error of level E_NOTICE. Also, the second session start will simply be ignored.
				$captchaStr = $_SESSION['tx_captcha_string'];
				$_SESSION['tx_captcha_string'] = '';
				if (!$captchaStr || $piVars['captcha'] !== $captchaStr) {
					$errors['captcha'] = $this->pi_getLLWrap($pObj, 'error.wrong.captcha', false);

				}
			}
			elseif ($captchaType == 2 && t3lib_extMgm::isLoaded('sr_freecap')) {
				require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
				$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
				/* @var $freeCap tx_srfreecap_pi2 */
				if (!$freeCap->checkWord($piVars['captcha'])) {
					$errors['captcha'] = $this->pi_getLLWrap($pObj, 'error.wrong.captcha', false);
				}
			}
			// Check required fields
			foreach (t3lib_div::trimExplode(',', $conf['commentsreport.']['requiredFields'], true) as $field) {
				if (trim($piVars[$field]) == '') {
					$errors[$field] = $this->pi_getLLWrap($pObj, 'error.empty.field', false);
				}
			}
			if ($piVars['frommail'] != '' && !t3lib_div::validEmail($piVars['frommail'])) {
				$errors['frommail'] = $this->pi_getLLWrap($pObj, 'error.invalid.email', false);
			}

			if (substr($piVars['from'], 2,10) !='') {
				if (stristr($piVars['text'], substr($piVars['from'], 2,10)) != '') {
					$errors['from'] = $this->pi_getLLWrap($pObj, 'commentreport.error.required.fieldcorrect', false);
				}
			}

			// Decode info
			$info = @unserialize(base64_decode($piVars['info']));
			if (!is_array($info)) {
				$errors['text'] = $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_info', false);
			}
			else {
				// Get comment
				t3lib_div::loadTCA('tx_toctoc_comments_comments');
				$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
						'tx_toctoc_comments_comments',
						'uid=' . intval($info['uid']));
				if (count($rows) == 0) {
					$errors['text'] = $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_comment', false);
				}
				else {
					$comment = $rows[0];
				}
			}

			// Process form
			if (count($errors) == 0) {

				if ($conf['HTMLEmail']) {
					$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['commentsreport.']['HTMLemailTemplateFile']);

				} else {
					$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['commentsreport.']['emailTemplateFile']);
				}
				$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
				if ($fromAjax) {
					$templateCode = @file_get_contents(PATH_site . $usetemplateFile);
				} else {
					$templateCode = $pObj->cObj->fileResource($usetemplateFile);
				}

				$myhomepagelinkarr=explode('//', t3lib_div::locationHeaderUrl(''));
				$myhomepagelink=$myhomepagelinkarr[1];
				$infoleft='';

				$markerArray = array(
					'###URL###' => $info['url'],
					'###UID###' => $comment['uid'],
					'###FROM###' => $piVars['from'],
					'###FROMMAIL###' => $piVars['frommail'],
					'###USER_TEXT###' => $piVars['text'],
					'###COMMENT_TEXT###' => $comment['content'],
					'###USER_IP###' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
					'###MYHOMEPAGE###'  => $myhomepagelink,
					'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###MYHOMEPAGELINK###'  => t3lib_div::locationHeaderUrl(''),
					'###MYFONTFAMILY###'  => $conf['HTMLEmailFontFamily'],
					'###MYHOMEPAGETITLE###'  => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
					'###INFOSLEFT###'  => $infoleft,
					'###MESSAGETYPE###' => $this->pi_getLLWrap($pObj, 'commentreport.report_subject', false),
					'###TXTINAPPRO###' => $this->pi_getLLWrap($pObj, 'commentreport.text_inappropriate', false),
					'###TXTPAGE###' => $this->pi_getLLWrap($pObj, 'comments_recent.pages', false),
					'###TXTFROM###' => $this->pi_getLLWrap($pObj, 'commentreport.text_sentby',false),
					'###TEXT_FROMMAIL###' => $this->pi_getLLWrap($pObj, 'pi1_template.email',false),
					'###TEXT_COMPLAINT###' => $this->pi_getLLWrap($pObj, 'commentreport.text_complaint',false),
					'###TEXT_COMMENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.textcommentlink',false),

				);

				$subject = str_replace('%s', $GLOBALS[GLOBALS][TYPO3_CONF_VARS][SYS][sitename].': '.$pageTitle, $this->pi_getLLWrap($pObj, 'commentreport.report_subject', $fromAjax));
				$sendername = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] . ' - '  . $this->pi_getLLWrap($pObj, 'email.commentingsystem', $fromAjax);

				if ($conf['HTMLEmail']) {	// If htmlmail lib is included, then generate a nice HTML-email
					$content = $pObj->cObj->substituteMarkerArray($templateCode, $markerArray);

					self::send_mail($conf['commentsreport.']['destinationEmail'],  $subject,  '', $content, $conf['commentsreport.']['sourceEmail'] , $sendername);

				} else {
					$template = $pObj->cObj->getSubpart($templateCode, '###COMMENTS_RECIPENT_MAIL###');
					$mailContent = $pObj->cObj->substituteMarkerArray($template, $markerArray); // substitute markerArray for HTML content
					t3lib_div::plainMailEncoded($conf['commentsreport.']['destinationEmail'], $subject, $mailContent, 'From: ' . $conf['commentsreport.']['sourceEmail'] );
				}
				return true;
			}
		}
		return false;
	}

	/**
	 * Shows "thank you" message after text was submitted
	 *
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @return	string		HTML
	 */
	protected function showReportThanks($conf,$pObj) {
		$template = $pObj->cObj->getSubpart($pObj->templateCode, '###THANK_YOU###');
		return $pObj->cObj->substituteMarker($template, '###TEXT_THANKYOU###', $this->pi_getLLWrap($pObj, 'commentreport.text_thankyou',false));
	}
	/**
	 * Shows Report Form for the complaints
	 *
	 * @param	array		$errors
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @param	array		$piVars: ...
	 * @return	string		HTML
	 */
	protected function showReportForm(array $errors,$conf,$pObj,$piVars) {
		$template = $pObj->cObj->getSubpart($pObj->templateCode, '###REPORT_FORM###');
		$req_template = $pObj->cObj->getSubpart($pObj->templateCode, '###REPORT_REQUIRED###');
		$error_template = $pObj->cObj->getSubpart($pObj->templateCode, '###REPORT_ERROR###');

		$required = $pObj->cObj->substituteMarker($req_template, '###TEXT_REQUIRED###', $this->pi_getLLWrap($pObj, 'commentreport.text_required',false));
		// Decode info
		$info = @unserialize(base64_decode($piVars['info']));
		if (!is_array($info)) {
			$complainedcomment= $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_info', false);
		}
		else {
			// Get comment
			t3lib_div::loadTCA('tx_toctoc_comments_comments');
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*',
					'tx_toctoc_comments_comments',
					'uid=' . intval($info['uid']));
			if (count($rows) == 0) {
				$complainedcomment= $this->pi_getLLWrap($pObj, 'commentreport.error_cannot_get_comment', false);
			}
			else {
				//$conf[]=1;
				$complainedcomment=$this->comments_getRecentComments($rows,$conf,$pObj);
			}
		}

		$markers = array(
				'###ACTION###' => $this->pi_getPageLink($GLOBALS['TSFE']->id),
				'###INFO###' => $piVars['info'],
				'###FROM###' => htmlspecialchars($piVars['from']),
				'###FROMMAIL###' => htmlspecialchars($piVars['frommail']),
				'###TEXT###' => htmlspecialchars($piVars['text']),
				'###TEXT_FROM###' => $this->pi_getLLWrap($pObj, 'commentreport.text_from',false),
				'###TEXT_FROMMAIL###' => $this->pi_getLLWrap($pObj, 'pi1_template.email',false),
				'###TEXT_TEXT###' => $this->pi_getLLWrap($pObj, 'commentreport.text_text',false),
				'###TEXT_SUBMIT###' => $this->pi_getLLWrap($pObj, 'pi1_template.submit',false),
				'###ERROR_FROM###' => '',
				'###ERROR_FROMMAIL###' => '',
				'###ERROR_TEXT###' => '',
				'###REQUIRED_FROM###' => '',
				'###REQUIRED_FROMMAIL###' => '',
				'###REQUIRED_TEXT###' => '',
				'###CAPTCHA###' => '',
				'###TXTCONFIRM###' => $this->pi_getLLWrap($pObj, 'pi1_template.confirm', false),
				'###TXTNO###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useno', false),
				'###TXTYES###' => $this->pi_getLLWrap($pObj, 'tt_content.toctoc_comments_pi1.useyes', false),
				'###TXTOK###' => $this->pi_getLLWrap($pObj, 'pi1_template.ok', false),
				'###TXTINFO###' => $this->pi_getLLWrap($pObj, 'pi1_template.information', false),
				'###BADCOMMENT###' => 	$complainedcomment,
				'###TEXT_YOURCOMPLAINT###' => 	$this->pi_getLLWrap($pObj, 'pi1_template.textyourcomplaint',false),

		);

		foreach ($errors as $field => $error) {
			if ($field != 'captcha') {
				$markers['###ERROR_' . strtoupper($field) . '###'] = $pObj->cObj->substituteMarker($error_template, '###TEXT###', htmlspecialchars($error));
			}
		}
		foreach (t3lib_div::trimExplode(',', $conf['commentsreport.']['requiredFields'], true) as $field) {
			$markers['###REQUIRED_' . strtoupper($field) . '###'] = $required;
		}

		// Captcha
		if ($conf['commentsreport.']['useCaptcha']) {
			$error = '';
			if ($errors['captcha']) {
				$error = $pObj->cObj->substituteMarker($error_template, '###TEXT###', htmlspecialchars($errors['captcha']));
			}
			$markers['###CAPTCHA###'] = $this->getReportCaptcha($required, $error,$conf,$pObj);
		}

		return $pObj->cObj->substituteMarkerArray($template, $markers);
	}

	/**
	 * Adds captcha code if enabled.
	 *
	 * @param	string		$required
	 * @param	string		$error: Possible error text
	 * @param	array		$conf: The PlugIn configuration
	 * @param	object		$pObj: Reference to parent object
	 * @return	string		Generated HTML
	 */
	protected function getReportCaptcha($required, $error,$conf,$pObj) {
		$captchaType = intval($conf['commentsreport.']['useCaptcha']);

		if (($captchaType == 1) && (t3lib_extMgm::isLoaded('captcha'))) {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###REPORT_CAPTCHA###');
			$code = $pObj->cObj->substituteMarkerArray($template, array(
					'###SR_FREECAP_IMAGE###' => '<img src="' . t3lib_extMgm::siteRelPath('captcha') . 'captcha/captcha.php" alt="" />',
					'###SR_FREECAP_CANT_READ###' => '',
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $error,
					'###SITE_REL_PATH###' => t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###TEXT_CAPTCHA###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code',false),
			));
			return str_replace('<br /><br />', '<br />', $code);
		}
		elseif (($captchaType == 2) && (t3lib_extMgm::isLoaded('sr_freecap'))) {
			require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
			$freeCap = t3lib_div::makeInstance('tx_srfreecap_pi2');
			/* @var $freeCap tx_srfreecap_pi2 */
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###REPORT_CAPTCHA###');
			return $pObj->cObj->substituteMarkerArray($template, array_merge($freeCap->makeCaptcha(), array(
					'###REQUIRED_CAPTCHA###' => $required,
					'###ERROR_CAPTCHA###' => $error,
					'###TEXT_CAPTCHA###' => $this->pi_getLLWrap($pObj, 'pi1_template.enter_code',false),
			)));
		}
		return '';
	}

	/**
	 * IP-blocking functions
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
	protected function IPBlockSpamCheck(&$params, &$pObj) {
		$points = 0;
		$ipaddr = $this->getIpAddr();
		if ($pObj->conf['spamProtect.']['spamCutOffPoint'] && $this->checkTableBLs($ipaddr) || $this->checkNetworkBLs($ipaddr)) {
			/* @var $pObj tx_comments_pi1 */
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
	protected function sendNotificationIPBlock($params, &$pObj) {
		$markers = $params['markers'];
		$markers['###DELETE_LINK_AND_BLOCK###'] = $markers['###DELETE_LINK###'] . '&ip=' . ip2long($this->getIpAddr());
		$markers['###KILL_LINK_AND_BLOCK###'] = $markers['###KILL_LINK###'] . '&ip=' . ip2long($this->getIpAddr());
		return $markers;
	}



	/**
	 * Retrieves real ip address of the client
	 *
	 * @return	string		IP address
	 */
	private function getIpAddr() {
		$ipaddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
		if ($ipaddr && long2ip(ip2long($ipaddr)) == $ipaddr && !preg_match('/^127\.0|192\.168\.|172\.16\.|10\.', $ipaddr)) {
			return $ipaddr;
		}
		return t3lib_div::getIndpEnv('REMOTE_ADDR');
	}


	/**
	 * Checks table-based blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	boolean		true if exists in the list
	 */
	private function checkTableBLs($ipaddr) {
		return $this->checkLocalBL($ipaddr) || $this->checkStaticBL($ipaddr);
	}


	/**
	 * Checks local blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	boolean		true if exists in the list
	 */
	private function checkLocalBL($ipaddr) {
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS t', 'tx_toctoc_comments_ipbl_local',
				'ipaddr=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($ipaddr, 'tx_toctoc_comments_ipbl_local'));
		return ($recs[0]['t'] != 0);
	}


	/**
	 * Checks static blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	boolean		true if exists in the list
	 */
	private function checkStaticBL($ipaddr) {
		$parts = explode('.', $ipaddr);
		$recs = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('ipaddr', 'tx_toctoc_comments_ipbl_static',
				'ipaddr LIKE ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($parts[0] . '.' . $parts[1] . '.%', 'tx_toctoc_comments_ipbl_static'));
		foreach ($recs as $rec) {
			list($addr, $mask) = explode('/', $rec['ipaddr']);
			if ($mask == '') {
				if ($addr == $ipaddr) {
					return true;
				}
			}
			else {
				$mask = 0xFFFFFFFF << (32 - $mask);
				if (long2ip(ip2long($ipaddr) & $mask) == $addr) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Checks network blocking lists.
	 *
	 * @param	string		$ipaddr	IP address
	 * @return	boolean		true if exists in the list
	 */
	function checkNetworkBLs($ipaddr) {
		$parts = explode('.', $ipaddr);
		$ipaddr = $parts[3] . '.' . $parts[2] . '.' .$parts[1] . '.' .$parts[0];
		$sysconf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['toctoc_comments']);
		$parts = t3lib_div::trimExplode(',', $sysconf['dnsbl_list'], true);
		foreach ($parts as $dnsbl) {
			if (substr(gethostbyname($ipaddr . '.' . $dnsbl), 0, 8) == '127.0.0.') {
				return true;
			}
		}
		return false;
	}

}
?>
