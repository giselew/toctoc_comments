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
 *  104: class toctoc_comment_lib  extends tslib_pibase
 *  122:     public function maincomments($ref, $conf = null, $fromAjax = false, $pid=0, $feuserid = 0, $cmd = '', &$pObj, $piVars = null,
		$cid, $sessioncapdata = '', $userpic='', $commentspics = array(), $check='', $AjaxData = '')
 *  231:     protected function checkExternalUid($conf,$pObj)
 *
 *              SECTION: Comments Functions
 *  259:     public function comments($conf,&$pObj,$fromAjax,$feuserid,$pid)
 *  619:     public function comments_getComments(&$rows,$conf,$pObj,$feuserid,$fromAjax)
 *  776:     protected function comments_getComments_fe_user($params, $conf, $pObj,$commentid,$fromAjax)
 *  931:     protected function setAJAXimage($image,$feuserid)
 *  942:     protected function getAJAXimage($feuserid,$commentid)
 *  973:     protected function setAJAXimageCache($image,$imageoriginal,$feuserid)
 *  984:     protected function getAJAXimageCache($commentuserimageout)
 * 1002:     protected function comments_getComments_getRatings(&$row,$conf,$pObj,$feuserid, $fromAjax)
 * 1020:     protected function comments_getComments_getEmail($email)
 * 1038:     protected function comments_getCommentsBrowser($rpp,$startpoint,$totalrows,$pObj,$fromAjax)
 * 1119:     public function form($conf, &$pObj, $piVars,$fromAjax,$pid, $ifeuserid=0, $userpic)
 * 1383:     protected function form_updatePostVarsWithFeUserData($conf, &$pObj, $piVars, $feuserid, $fromAjax, $userpic, $cid)
 * 1665:     protected function form_getCaptcha($pObj, $conf,$fromAjax)
 * 1706:     protected function form_wrapError($field, &$pObj, $conf)
 * 1724:     protected function processBrowserSubmission($conf, $pObj, $piVars, $fromAjax, $cid, $cmd,$pid)
 * 1788:     public function processSubmission($conf,$pObj,$piVars,$fromAjax,$feuserid,$pid,$lang)
 * 2070:     protected function processSubmission_checkTypicalSpam($conf, $piVars, $lang, $fromAjax)
 * 2123:     protected function processSubmission_validate($piVars, $conf, $pObj,$fromAjax)
 * 2186:     public function sendNotificationEmail($uid, $points, $action, $conf, $pObj, $fromAjax, $piVars, $pid)
 * 2275:     protected function isCommentingClosed($conf,$pObj)
 * 2321:     protected function commentingClosed($pObj,$fromAjax)
 * 2339:     public function fixLL(&$conf)
 * 2360:     protected function fixLL_internal($LL, &$ll, $prefix = '')
 * 2377:     protected function createLinks($text, $conf)
 * 2399:     protected function applyStdWrap($text, $stdWrapName, $conf, $pObj)
 * 2413:     protected function checkCustomFunctionCodes($code, $pObj)
 * 2435:     protected function isNoCacheUrl($url)
 * 2456:     protected function substituteMarkersAndSubparts($template, array $markers, array $subparts, $pObj)
 * 2473:     public function resetSessionVars($resetcontext, $alsoajaxvar = true)
 * 2514:     public function getClearCacheIds($conf, $pid = 0)
 * 2541:     public function parseSmilieArray($data)
 * 2558:     public function replaceSmilies($content,$conf)
 * 2581:     protected function getAjaxJSData($feuserid, $pid, $languagecode, $conf, $pObj, $cid, $fromAjax)
 * 2616:     protected function getAjaxData($feuserid, $pid, $languagecode, $conf, $cid)
 * 2641:     protected function  getAjaxJSDataCommentImgs($cid, $pObj,$fromAjax)
 * 2677:     protected function getAjaxJSDataComments($cid,$pObj,$fromAjax)
 * 2715:     protected function getAjaxDataComments($pObj, $cid)
 * 2740:     protected function getAjaxDataImgs()
 * 2753:     public function getCurrentIp()
 * 2767:     public function hasValidItemUrl($piVars)
 * 2789:     public function getDefaultConfig()
 * 2807:     public function getRatingDisplay($ref, $conf = null, $fromAjax = false, $pid=0, $returnasarray = false, $feuserid = 0, $cmd = 'vote',
			$pObj = null, $cid, $fromcomments)
 * 2847:     public function isVoted($ref,$conf,$pObj)
 * 2865:     protected function getBarWidth($rating,$conf)
 * 2878:     protected function getRatingInfo($ref,$pObj, $feuserid=-1,$conf)
 * 2951:     protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments)
 * 3318:     public function enableFields($tableName,$pObj)
 * 3338:     public function pi_getLLWrap($pObj, $llkey, $fromAjax)
 * 3356:     protected function getcheck ($ref, $i, $ajaxData, $ratingscheck)
 * 3378:     public function formatDate($date, $pObj, $fromAjax)
 * 3487:     protected function getPageURL($fromAjax = false,$pid = 0)
 * 3513:     protected function getCleanHTML ($html)
 * 3534:     public function getUserCard($basedimgstr,$basedtoctocuid,$conf,$pObj,$commentid)
 * 3814:     protected function getMailTo($mailAddress, $linktxt = '', $initP = '?')
 * 3857:     protected function encryptEmail($string,$back=0)
 * 3893:     protected function encryptCharcode($n,$start,$end,$offset)
 *
 * TOTAL FUNCTIONS: 58
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
	var $smilies = array();				       // Smilie array @var array
	var $smiliesPath = '';				//	Path to smilie folder
	var $check = '';
	var $AjaxData = '';
	var $AJAXimage = '';
	var $newcommentid = -1;
	var $limitofrows =  500; // maximum of rows fetched for comments at a time.
	var $externalref = '';

	/**
	 * Entrypoint function and dispatcher for subfunctions.
	 *
	 * @return	string		HTML-Output
	 */
	public function maincomments($ref, $conf = null, $fromAjax = false, $pid=0, $feuserid = 0, $cmd = '', &$pObj, $piVars = null,
		$cid, $sessioncapdata = '', $userpic='', $commentspics = array(), $check='', $AjaxData = '') {
		$content = '';

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
				}
				if (($cmd === 'browse')||($cmd === 'browsehide')) {
					$this->processBrowserSubmission($conf,$pObj,$piVars,$fromAjax,$cid,$cmd,$pid);
					$this->AJAXimages = $commentspics;
					$content .= $this->comments($conf,$pObj,$fromAjax,$feuserid,$pid);
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

					$content .= $this->comments($conf,$pObj,$fromAjax,$GLOBALS['TSFE']->fe_user->user['uid'],$GLOBALS['TSFE']->id);

					if ( $content=='') {
						$content .= "No CIDs found";
					}
				} else {
					foreach (t3lib_div::trimExplode(',', $conf['code'], true) as $code) {

						 switch ($code) {
							case 'COMMENTS':

								$content .= $this->comments($conf,$pObj,$fromAjax,$GLOBALS['TSFE']->fe_user->user['uid'],$GLOBALS['TSFE']->id);

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
									$content .= $this->form($conf, $pObj, $piVars,$fromAjax,$GLOBALS['TSFE']->id,$GLOBALS['TSFE']->fe_user->user['uid'], $userpic);
							 	}
								break;
							default:
								 $content .= $this->checkCustomFunctionCodes($code,$pObj);
						 		break;
						}
					}
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
	 * Comments Functions
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
			if (isset($_SESSION['commentListIndex']['cid' . $_SESSION['commentListCount']]['startIndex'])) {
				$startpoint = $_SESSION['commentListIndex']['cid' . $_SESSION['commentListCount']]['startIndex'];
			}else{
				$startpoint =-1;
			}

			if (intval($_SESSION['submittedCid']) == 0) {
				unset($_SESSION['requestCapcha'][$_SESSION['commentListCount']]['startIndex']);
			}

			$rpp = intval($conf['advanced.']['commentsPerPage']);
			$rpp = ($rpp == 0 ? 1 : $rpp);
			$whereplus=' AND ((external_ref_uid="' . $_SESSION['commentListCount'] .'") OR (external_ref_uid="tt_content_' . $_SESSION['commentListCount'] .'"))';
			$pObj->where .= $whereplus;

			list($row) = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('COUNT(*) AS counter',
					'tx_toctoc_comments_comments', $pObj->where);
			$commentscounter=intval($row['counter']);
			if ($startpoint < 0) {
				$startpoint = intval($row['counter']-$rpp) <= 0 ? 0 : (intval($row['counter']-$rpp));
				$hasolderrows = $startpoint;
			}
			else {
				$hasolderrows = $startpoint;
				//startpoint = $startpoint;
			}
			//relations betwenn startpoint and $commentscounter
			$maxstartpoint =$commentscounter-$rpp;
			if  ($maxstartpoint>=0){
				if ($maxstartpoint<$startpoint){
					$startpoint=$maxstartpoint;
				}
			}

			$confmaxstepsbackbyolder = $conf['advanced.']['CommentsShowOldPerCID'];
			$stepbackbyolder = $confmaxstepsbackbyolder *$rpp;
			// now $startpoint shoud be 0 or if no we make add checks
			if ($startpoint>0) {
				$moddiff= ($stepbackbyolder+($commentscounter - $startpoint -  $rpp)) % $stepbackbyolder;

				if ($moddiff == 0) {
					//cool
				}
				else {
					//try adjust get next higher startpoint

					$trystartpoint=$startpoint +  $moddiff -$stepbackbyolder;
					if ($maxstartpoint<= $trystartpoint){
						$startpoint=$maxstartpoint;
					}
					else {
						$startpoint=$trystartpoint;
					}
					if ($startpoint< 0){
						while ($startpoint< 0) {
							$startpoint=$startpoint+$stepbackbyolder;
						}
						if ($startpoint> $maxstartpoint){
							$startpoint=$maxstartpoint;

						}
					}
				}
			}
			if ($startpoint<0) {$startpoint=0;}
			$_SESSION['commentListIndex']['cid' . $_SESSION['commentListCount']]['startIndex'] = $startpoint;
			$start = $startpoint;
			$limitofrows=$this->limitofrows;

			// Get records
			$sorting = 'crdate';

			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('toctoc_commentsfeuser_feuser, toctoc_comments_user, uid,approved,crdate,firstname,lastname,homepage,
					location,email,content,SUBSTR(external_ref_uid,12) AS external_ref_uid',
					'tx_toctoc_comments_comments', $pObj->where, '', $sorting, $limitofrows . ' OFFSET ' . $start);
			$tmpuid=$pObj->externalUid;
			$subParts = array(
					'###SINGLE_COMMENT###' => $this->comments_getComments($rows,$conf,$pObj,$feuserid,$fromAjax),
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
			$externalref = $this->externalref;
		} else {
			$externalref = 'tt_content_' . $_SESSION['commentListCount'];
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
			if (intval($conf['advanced.']['useSharing']) ===1 ) {
				if (intval($conf['advanced.']['dontUseSharingFacebook']) !==1 ) {
					$sharehtmlfacebook='<a title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' facebook" href="javascript:void(0)" class="facebook">f</a>';
					$sharelistfacebook = 'facebook: true'; $hasValidSharingItems = $hasValidSharingItems+1; $sharelistfacebookputacomma = true;
					$sharejsfacebook = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREF###');

				}
				if (intval($conf['advanced.']['dontUseSharingTwitter']) !==1 ) {
					$sharelisttwitter = 'twitter: true'; $hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmltwitter='<a href="javascript:void(0)" title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' Twitter" class="twitter">t</a>';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;
					}
					$sharelisttwitterputacomma = true;
					$sharejstwitter = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRRET###');

				}
				if (intval($conf['advanced.']['dontUseSharingGoogle']) !==1 ) {
					$sharelistgoogle = 'googlePlus: true';
					$sharehtmlgoogle='<a title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' Google+" href="javascript:void(0)" class="googleplus">+1</a>';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;
					}
					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ','; $sharelisttwitterputacomma = false;
					}
					$sharelistgoogleputacomma = true;$hasValidSharingItems = $hasValidSharingItems+1;
					$sharejsgoogle = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREG###');

				}
				if (intval($conf['advanced.']['dontUseSharingLinkedIn']) !==1 ) {
					$sharelistlinkedin = 'linkedin: true';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ','; $sharelistfacebookputacomma = false;
					}
					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ','; $sharelisttwitterputacomma = false;
					}
					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ','; $sharelistgoogleputacomma = false;
					}
					$sharelistlinkedinputacomma = true;$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmllinkedin='<a href="javascript:void(0)" title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' LinkedIn" class="linkedin">L</a>';
					$sharejslinkedin = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRREL###');

				}
				if (intval($conf['advanced.']['dontUseSharingStumbleupon']) !==1 ) {
					$shareliststumbleupon = 'stumbleupon: true';
					if ($sharelistfacebookputacomma) {
						$sharelistfacebook .= ',';
					}
					if ($sharelisttwitterputacomma) {
						$sharelisttwitter .= ',';
					}
					if ($sharelistgoogleputacomma) {
						$sharelistgoogle .= ',';
					}
					if ($sharelistlinkedinputacomma) {
						$sharelistlinkedin .= ',';
					}
					$hasValidSharingItems = $hasValidSharingItems+1;
					$sharehtmlstumbleupon='<a href="javascript:void(0)" title="' .$this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax) . ' Stumbleupon" class="stumbleupon">S</a>';
					$sharejsstumbleupon = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRRED###');

				}
				$prearticleshare='&nbsp;&middot;&nbsp;';
				$prearticlesharecorrcss=0;
				if ((intval($conf['ratings.']['ratingsOnly']) ==1) || ($conf['code'] == 'COMMENTS') || ($conf['ratings.']['mode'] == 'static')) {
					$prearticleshare='';
					$prearticlesharecorrcss=10;
				}
				$sharremidAddWith = 9 + ($hasValidSharingItems * 13);
				//2: 78 + 2*16 = 110 => (120) ---  -40 = 70 => -60  (60)    83*26=109   -49

				//4: 78 + 4*16 = 142 => (136) ---  -40 = 102 => -50  (92)b  83+52=135   -43
				//5: 78 + 5*16 = 158 => (148) ---  -40 = 118 => -48  (100)  5*13+83     -48

				$sharremidAddRightRight = $hasValidSharingItems * 5;
				if (($conf['ratings.']['ratingsOnly'] ==1)  || ($conf['code'] == 'COMMENTS') || ($conf['ratings.']['mode'] == 'static')) {
					$sharremiddleleft = 4+ (3 * 12) -$prearticlesharecorrcss;

				} else {
					$sharremiddleleft = 4+ (3 * 12) -$prearticlesharecorrcss;
				}
				$sharremiddleleft = $sharremiddleleft + intval($conf['advanced.']['pushSharingAreatoLeft']);
				$templatesharrre = $pObj->cObj->getSubpart($pObj->templateCode, '###SHARRRE###');
				$markerssharre= array(
						'###BEGINSPACER###'=> $prearticleshare,

						'###ARTICLESHAREURL###'=> $this->getPageURL($fromAjax,$pid),
						'###CID###' => $_SESSION['commentListCount'],
						'###ARTICLESHAREON###' => $this->pi_getLLWrap($pObj, 'text_share_on', $fromAjax),
						'###ARTICLESHARE###' => $this->pi_getLLWrap($pObj, 'text_share', $fromAjax),
						'###ARTICLESHARETITLE###' => $this->pi_getLLWrap($pObj, 'text_share_title', $fromAjax),
						'###ARTICLESHAREDIVRIGHTRIGHT###' => $this->pi_getLLWrap($pObj, 'text_share_pixel_length', $fromAjax)-19-$sharremidAddRightRight+$prearticlesharecorrcss,
						'###ARTICLESHAREMIDDLELEFT###' => $sharremiddleleft,
						'###ARTICLESHAREDIVWIDTH###' => $this->pi_getLLWrap($pObj, 'text_share_pixel_length', $fromAjax)+$sharremidAddWith+2+$prearticlesharecorrcss,
						'###ARTICLESHAREDIVWIDTHHM###' => $this->pi_getLLWrap($pObj, 'text_share_pixel_length', $fromAjax)+$sharremidAddWith-48-$prearticlesharecorrcss,
						'###ARTICLESHAREDATATEXT###' => $this->pi_getLLWrap($pObj, 'text_share_datatext', $fromAjax) . ' ' . $this->getPageURL($fromAjax,$pid),
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
				);
				if ($templatesharrre && ($hasValidSharingItems>0)) {
					$shareHTML=$pObj->cObj->substituteMarkerArray($templatesharrre, $markerssharre);
				}
			}
		}
		$ilikedislikeHTML='';
		if ($conf['ratings.']['enableRatings'] !=0) {
			if (intval($conf['ratings.']['useLikeDislike']) ===1 ) {
				if (intval($conf['ratings.']['useDislike']) ===1 ) {
					$ilikedislikeHTML=$articlerating['ilike'] .  $articlerating['idislike'] . '&nbsp;&middot;&nbsp;&nbsp;';
				} else {
					$ilikedislikeHTML=$articlerating['ilike'] . '&nbsp;&middot;&nbsp;&nbsp;';
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

		$hidecss ='';
		if (($conf['ratings.']['ratingsOnly'] ==1)) {
			$hidecss ='-hide';
		}
		$adddiv ='';
		if (($conf['ratings.']['enableRatings'] ==1)) {
			$adddiv ='</div>';
		}
		$markers = array(
				'###ARTICLECOMMENTLINK###' => $commenttopHTML,
				'###HIDECSS###'=> $hidecss,
				'###UID###' => $pObj->externalUid,
				'###REF###' => $externalref,
				'###CID###' => $_SESSION['commentListCount'],
				'###AJAX_DATA###' => 	$this->getAjaxJSData($feuserid,$GLOBALS['TSFE']->id,$GLOBALS['TSFE']->lang,$conf,$this, $tmpcid,$fromAjax),
				'###AJAX_COMMENTSDATA###' => $this->getAjaxJSDataComments($tmpcid,$pObj,$fromAjax),
				'###AJAX_COMMENTSIMGS###' => $this->getAjaxJSDataCommentImgs($tmpcid,$pObj,$fromAjax),
				'###ARTICLEVOTE###' => $articlerating['voteing'] . $adddiv,
				'###ARTICLELIKE###' => $ilikedislikeHTML,
				'###ARTICLEMYVOTE###' => $myvoteHTML,
				'###ARTICLESHARE###' => $shareHTML,
		);
		// Fetch template

		if (!$fromAjax) {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_LIST###');
		} else {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_LISTAJAX###');
		}


		// comments browser
		if (($conf['ratings.']['ratingsOnly'] ==0)) {
			 $markers['###PAGE_BROWSER###'] = $this->comments_getCommentsBrowser($rpp,$hasolderrows,$commentscounter,$pObj,$fromAjax);
		} else {
			$markers['###PAGE_BROWSER###'] ='';
		}

		/* Call hook for custom markers */
		 if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['toctoc_comments'])) {
			foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['toctoc_comments'] as $userFunc) {
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
	 * @return	string		Generated HTML
	 */
	public function comments_getComments(&$rows,$conf,$pObj,$feuserid,$fromAjax) {
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


			if (($row['toctoc_commentsfeuser_feuser'] == $feuserid) && ($feuserid !==0)){

				$tmpcid=$_SESSION['commentListCount'];
				$submithtml='';
				$ref='tx_toctoc_comments_comments_' . $iuid;
				$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###DELETE_COMMENT_LINK_SUB###');

				$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
						'###VALUE###' => '1',
						'###REF###' => $ref,
						'###PID###' => $pid,
						'###CID###' => $tmpcid,
						'###UID###' => $iuid,
						'###CHECK###' => $check,
				));
				$submithtml=$submithtmlSub;

				$deletelinkout='<form  class="tx-toctoc-comments-comment-deleteform" id="df' . $iuid . '" action="';
				$deletelinkout.= '" method="post">';
				$deletelinkout .= '	<input type="button" class="tx-toctoc-comments-comment-deletebutton" style="background: url(';
				$deletelinkout .= "'../../../";

				if ($conf['DeleteCommentImage']) {
					$fileinfo = t3lib_div::split_fileref($conf['DeleteCommentImage']);
					if (t3lib_div::inList('jpg,gif,jpeg,png',$fileinfo['fileext'])) {
						$imgFile = $GLOBALS['TSFE']->absRefPrefix.$conf['DeleteCommentImage'];
						$imgFile = $GLOBALS['TSFE']->getFileAbsFileName.$imgFile;
						$imgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$imgFile);
						$imgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$imgFile);
					}
				}
				$deletelinkout .= $imgFile;
				$deletelinkout .= "'";
				$deletelinkout .= ') no-repeat top left;" name="toctoc_comments_pi1[submit]" ';
				$deletelinkout .= ' onclick="' . $submithtml . ';" ';
				$deletelinkout .= ' id="toctoc_comments_pi1_submit_uid' . $iuid . '" value="" title="' . $this->pi_getLLWrap($pObj, 'pi1_template.deletelink', $fromAjax) . '" />';
				$deletelinkout .= '<input type="hidden" value="1" name="typo3_user_int"></form>';

			}else {
				$deletelinkout='';
			}
			//Parse for Links and Smilies
			$text = $this->applyStdWrap(nl2br($this->createLinks(htmlspecialchars($row['content']), $conf)), 'content_stdWrap', $conf, $pObj);
			$text = $this->replaceSmilies($text, $conf);




			$commentcontinuation='';
			if (intval($conf['ratings.']['enableRatings']) ===1 ) {
				$commentcontinuation='&nbsp;&middot;&nbsp;';
			}
			$markerArray = array(
					'###ALTERNATE###' => '-' . ($alt + 1),
					'###FIRSTNAME###' => $this->applyStdWrap(htmlspecialchars($row['firstname']), 'firstName_stdWrap', $conf, $pObj),
					'###LASTNAME###' => $this->applyStdWrap(htmlspecialchars($row['lastname']), 'lastName_stdWrap', $conf, $pObj),
					'###IMAGE###' => '',
					'###IMAGETAG###' => $this->applyStdWrap($row['imagetag'], 'image_stdWrap', $conf, $pObj),
					'###EMAIL###' => $this->applyStdWrap($this->comments_getComments_getEmail($row['email']), 'email_stdWrap', $conf, $pObj),
					'###LOCATION###' => $this->applyStdWrap(htmlspecialchars($row['location']), 'location_stdWrap', $conf, $pObj),
					'###HOMEPAGE###' => $this->applyStdWrap(htmlspecialchars($row['homepage']), 'webSite_stdWrap', $conf, $pObj),
					'###COMMENT_DATE###' => $this->formatDate($row['crdate'], $pObj, $fromAjax) .$commentcontinuation,
					'###COMMENT_CONTENT###' => $text,
					'###COMMENT_ID###' => $iuid,
					'###CID###' => $_SESSION['commentListCount'],
					'###TOCTOCUID###' => base64_encode($row['toctoc_comments_user']),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
					'###RATINGS###' => $this->comments_getComments_getRatings($row,$conf,$pObj,$feuserid, $fromAjax),
					'###DELETE_LINK###' => $deletelinkout,
					'###DELETE_LINK_TEXT###' => $this->pi_getLLWrap($pObj, 'pi1_template.deletelink', $fromAjax),
					'###DELETE_COMMENT_IMAGE###' => htmlspecialchars($conf['DeleteCommentImage']),
					'###KILL_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $iuid . '&chk=' . $check . '&cmd=kill'),
					'###TEXT_ADD_COMMENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax),


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
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments_getComments'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['comments_getComments'] as $userFunc) {
					$params = array(
							'pObj' => &$pObj,
							'template' => $template,
							'markers' => $markerArray,
							'row' => $row,
					);
					if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $pObj))) {
						$markerArray = $tempMarkers;
					}
				}
			}

			$entries[] = $pObj->cObj->substituteMarkerArray($template, $markerArray);
			$alt = ($alt + 1) % 2;
		}

		return implode('', $entries);
	}
	/*
	 * Returns a list of markers with fe_user properties
	*
	* @return array
	*/
	protected function comments_getComments_fe_user($params, $conf, $pObj,$commentid,$fromAjax) {
		// sets default value if no user is logged in
		$params['markers']['###USERNAME###'] = $params['markers']['###FIRSTNAME###']." "
				.$params['markers']['###LASTNAME###'];
		$rowsfeuser = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, username, name,
					first_name, middle_name, last_name, address,
					telephone, email, crdate, title, zip, city, country, www, company, image, lastlogin, is_online', 'fe_users',
				'uid=' . $params['row']['toctoc_commentsfeuser_feuser'] );
		if (!$fromAjax) {
			if (count($this->AJAXimages)==0) {
				if (count($_SESSION['AJAXimages'])!=0) {
					$this->AJAXimages=$_SESSION['AJAXimages'];
				} else {
					//build $this->AJAXimages
					$start_time_for_conversion = microtime();
					if ($conf['DefaultUserImage']) {
						$fileinfo = t3lib_div::split_fileref($conf['DefaultUserImage']);
						if (t3lib_div::inList('jpg,gif,jpeg,png',$fileinfo['fileext'])) {
							$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$conf['DefaultUserImage'];
							$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
							$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
							$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
						}
					}

				 	$rowsfeuserimages = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('fe_users.uid AS uid, fe_users.image AS image, fe_users.lastlogin AS lastlogin, fe_users.is_online AS is_online', 'fe_users,tx_toctoc_comments_comments',
							'fe_users.uid=tx_toctoc_comments_comments.toctoc_commentsfeuser_feuser AND fe_users.deleted=0',
				 			'fe_users.uid, fe_users.image, fe_users.lastlogin, fe_users.is_online',
				 			'fe_users.lastlogin DESC',
				 			'100');
					$userimagesize=3*$conf['UserImageSize'];
					$userimagestylesize=$conf['UserImageSize'];
					$userimagestyle=$conf['advanced.']['FeUserImageStyle'] . ' width: ' . $userimagestylesize . 'px; height: ' . $userimagestylesize . 'px;';
					$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];

					foreach($rowsfeuserimages as $keyimage) {
						if (strval($keyimage['image']!=='')) {
							$commentuserimageout= $commentuserimagepath . $keyimage['image'];
						} else {

							$commentuserimageout=$userimgFile;
						}
						$tmpimgstr ='';
						$tmpimgstrarr = $this->getAJAXimageCache($commentuserimageout);
						if (is_array($tmpimgstrarr)) {
							$tmpimgstr =$tmpimgstrarr['image'];
							$tmpimgfeuser =$tmpimgstrarr['feuserid'];
						} else {
							$tmpimgstr ='';
						}
						if ($tmpimgstr==='') {
							$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
							$img = array();
							$img['file'] = GIFBUILDER;
							$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
							$img['file.']['10'] = IMAGE;
							$img['file.']['10.']['file'] = $commentuserimageout;
							$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
							$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
							$img['params'] = 'style="' . $userimagestyle . '" id="tx-toctoc-comments-comments-img-"'  ;   //style="margin: -6px 6px -6px -3px; padding: 0pt 0pt 0pt 0px; border-radius: 2px 2px 2px 2px; border: 1px solid #97b0ee;" align="left"';
							$tmpimgstr = $pObj->cObj->IMAGE($img);
							$this->setAJAXimage($tmpimgstr,$keyimage['uid']);
							$this->setAJAXimageCache($tmpimgstr,$commentuserimageout,$keyimage['uid']);
						} else {
							$this->setAJAXimage($tmpimgfeuser,$keyimage['uid']);
						}
					}
					$tmpimgstr ='';
					$tmpimgstrarr = $this->getAJAXimageCache($userimgFile);
					if (is_array($tmpimgstrarr)) {
						$tmpimgstr =$tmpimgstrarr['image'];
						$tmpimgfeuser =$tmpimgstrarr['feuserid'];
					} else {
						$tmpimgstr ='';
					}
					if ($tmpimgstr==='') {
						$pObj->cObj = t3lib_div::makeInstance('tslib_cObj');
						$img = array();
						$img['file'] = GIFBUILDER;
						$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
						$img['file.']['10'] = IMAGE;
						$img['file.']['10.']['file'] = $userimgFile;
						$img['file.']['10.']['file.']['width'] = $userimagesize .'c';
						$img['file.']['10.']['file.']['height'] = $userimagesize .'c';
						$img['params'] = 'style="' . $userimagestyle . '" id="tx-toctoc-comments-comments-img-"'  ;   //style="margin: -6px 6px -6px -3px; padding: 0pt 0pt 0pt 0px; border-radius: 2px 2px 2px 2px; border: 1px solid #97b0ee;" align="left"';
						$tmpimgstr = $pObj->cObj->IMAGE($img);

						$this->setAJAXimageCache($tmpimgstr,$userimgFile,0);
					}
					$this->setAJAXimage($tmpimgstr,0);
					$_SESSION['AJAXimages']=$this->AJAXimages;

				}
			}
		}
		$params['markers']['###IMAGE###'] = $this->getAJAXimage($params['row']['toctoc_commentsfeuser_feuser'] ,$commentid);
		if (count($rowsfeuser) ==1) {
			foreach($rowsfeuser as $key) {
				$params['markers']['###USERNAME###'] = $key['username'];

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
		if (array_key_exists(0, $rowsfeuser) && array_key_exists('username', $rowsfeuser[0])) {
				foreach($rowsfeuser[0] as $key=>$value) {
					$params['markers']['###FEUSER_' . strtoupper($key) . '###'] = $this->applyStdWrap($rowsfeuser[0][$key], 'feuser_' . $key . '_stdWrap', $conf, $pObj);
				}
			}
		}

		return $params['markers'];
	}

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
			$newstr='id="tx-toctoc-comments-comments-img-' . $commentid . '"';
			$oldstr='id="tx-toctoc-comments-comments-img-"' ;
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
	 * Creates a comments browser
	 *
	 * @param	int		$rpp: 			number of records shown
	 * @param	int		$startpoint:	row number from that on comments are shown
	 * @param	int		$totalrows: 	total of rows present
	 * @param	object		$pObj: parent object
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	string		Generated HTML
	 */
	protected function comments_getCommentsBrowser($rpp,$startpoint,$totalrows,$pObj,$fromAjax) {
		$result='';
		$emptybrowsestr='<div class="tx-toctoc-comments-comments-commentsbrowse"></div>';
		if ($startpoint > 0){
			$emptybrowsestr='';
			$submithtml='';
			$check = md5($ref . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			$tmpcid=$_SESSION['commentListCount'];
			$ref='tt_content_' . $tmpcid;
			$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###BROWSE_COMMENT_LINK_SUB###');
			$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
					'###VALUE###' => '1',
					'###REF###' => $ref,
					'###PID###' => $pid,
					'###CID###' => $tmpcid,
					'###CHECK###' => $check,
					'###STARTPOINT###' => $startpoint,
					'###TOTALROWS###' => $totalrows,
			));
			$submithtml=$submithtmlSub;

			$result .= '<div class="tx-toctoc-comments-comments-commentsbrowse"><form id="bf' . $_SESSION['commentListCount']  . '" class="comment-browseform" ';
			$result .= ' method="post" action="">';
			$result .= '<input id="toctoc_comments_pi1_submit_bcid' . $_SESSION['commentListCount']  . '" ';
			$result .= ' type="button" title="';
			$result .= '" value="' . $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.show_older_rows_text', $fromAjax) . ', ' . $startpoint;
			$result .= ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.older_rows_available', $fromAjax);
			$result .= '" name="toctoc_comments_pi1[submit]"  class="tx-toctoc-comments-comments-commentsbrowse-submit" ';
			$result .= ' onclick="' . $submithtml . '" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';"';
			$result .= '>';
			$result .= '<input type="hidden" name="typo3_user_int" value="1">';
			$result .= '</form></div>';
		}
		else{
		}
		if (($totalrows-$startpoint)>$rpp){

			$submithtml='';
			$check = md5($ref . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
			$tmpcid=$_SESSION['commentListCount'];
			$ref='tt_content_' . $tmpcid;
			$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###BROWSEHIDE_COMMENT_LINK_SUB###');
			$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
					'###VALUE###' => '1',
					'###REF###' => $ref,
					'###PID###' => $pid,
					'###CID###' => $tmpcid,
					'###CHECK###' => $check,
					'###STARTPOINT###' => $startpoint,
					'###TOTALROWS###' => $totalrows,
			));
			$submithtml=$submithtmlSub;

			$result .= $emptybrowsestr . '<div class="tx-toctoc-comments-comments-commentsbrowse-hide"><form id="bfh' . $_SESSION['commentListCount']  . '" ';
			$result .= ' class="comment-browseform-hide" ';
			$result .= ' method="post" action="">';
			$result .= '<input id="toctoc_comments_pi1_submit_bhcid' . $_SESSION['commentListCount']  . '" ';
			$result .= ' type="button" title="';
			$result .= '" value="' . $this->pi_getLLWrap($pObj, 'pi1_template.commentsbrowse.hide_older_rows_text', $fromAjax) . '" name="toctoc_comments_pi1[submit]"';
			$result .= ' onclick="' . $submithtml . '" onmouseover="this.style.textDecoration=\'underline\';" onmouseout="this.style.textDecoration=\'none\';"';
			$result .= ' class="tx-toctoc-comments-comments-commentsbrowse-submit-hide">';
			$result .= '<input type="hidden" name="typo3_user_int" value="1">';
			$result .= '</form></div>';
		}
		return $result;
	}



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
		//echo 'form';exit;
		$cid = $_SESSION['submittedCid'];
		if (!$fromAjax) {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_FORM###');
		} else {
			$template = $pObj->cObj->getSubpart($pObj->templateCode, '###COMMENT_FORMAJAX###');
		}

		$externalref = 'tt_content_' . $_SESSION['commentListCount'];

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
				$_SESSION['feuserid'] = intval($GLOBALS['TSFE']->fe_user->user['uid']);
			}
			if ($_SESSION['feuserid']) {

				$feuserid=$_SESSION['feuserid'];
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
					$_SESSION['formTopMessage']= '<div class="tx-toctoc-comments-form-top-message"><p class="tx-toctoc-comments-text">' . $_SESSION['formValidationErrors']['email'] . '</p></div>';
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
				$tempcaptcha=$this->form_getCaptcha($pObj, $conf,$fromAjax);
				$captchasession ='1';
			}
		} else {
			$ctval =$this->pi_getLLWrap($pObj, 'pi1_template.add_comment', $fromAjax);
		}

		$tmpcid=$_SESSION['commentListCount'];
		$submithtml='';
		$ref='tt_content_' . $_SESSION['commentListCount'];
		$submitSub = $pObj->cObj->getSubpart($pObj->templateCode, '###ADD_COMMENT_LINK_SUB###');
		$ajaxData = $_SESSION['ajaxData'];
		//print ('ajaxData: ' . $_SESSION['ajaxData'] . ', pid: '. $pid );exit;
		$loggedon= 'false';
		if ($feuserid!= 0) {
			$loggedon= 'true';
		}
		$check = $this->getcheck($ref, '1', $ajaxData,false);

		$submithtmlSub =  $pObj->cObj->substituteMarkerArray($submitSub, array(
				'###LOGGEDON###' => $loggedon,
				'###VALUE###' => '1',
				'###REF###' => $ref,
				'###PID###' => $pid,
				'###CID###' => $tmpcid,
				'###CHECK###' => $check,
				'###CAPSESS###' => $captchasession,
				'###ERROR_CAPTCHA###' => $pObj->tERROR_CAPCHA,
		));
		$submithtml=$submithtmlSub;

		$subformhtml='';
		if ($feuserid == 0) {
			$subformTemplate = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMIP###');
		} else {
			$subformTemplate = $pObj->cObj->getSubpart($pObj->templateCode, '###SUBFORMUSER###');
		}



		$subformhtml =  $pObj->cObj->substituteMarkerArray($subformTemplate, array(
				'###CURRENT_URL_CHK###' => md5($itemUrl . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']),
				'###ACTION_URL###' => htmlspecialchars($actionLink),	// this must go before ##ACTION_URL### for proper replacement!
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
				'###TEXT_LAST_NAME###' => $this->pi_getLLWrap($pObj, 'pi1_template.last_name', $fromAjax),
				'###TEXT_IMAGE###' => $this->pi_getLLWrap($pObj, 'pi1_template.image', $fromAjax),
				'###TEXT_EMAIL###' => $this->pi_getLLWrap($pObj, 'pi1_template.email', $fromAjax),
				'###TEXT_WEB_SITE###' => $this->pi_getLLWrap($pObj, 'pi1_template.web_site', $fromAjax),
				'###TEXT_LOCATION###' => $this->pi_getLLWrap($pObj, 'pi1_template.location', $fromAjax),
				'###TEXT_CONTENT###' => $this->pi_getLLWrap($pObj, 'pi1_template.content', $fromAjax),
				'###TEXT_SUBMIT###' => $this->pi_getLLWrap($pObj, 'pi1_template.submit', $fromAjax),
				'###TEXT_ERR_COMMENT_LENGTH###' => $this->pi_getLLWrap($pObj, 'pi1_template.texterrorlength', $fromAjax),
				'###TEXT_ERR_COMMENT_NULL###' => $this->pi_getLLWrap($pObj, 'pi1_template.texterrornull', $fromAjax),
				'###SUBMITONCLICK###' => $submithtml,
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
				'###CID###' => htmlspecialchars($_SESSION['commentListCount']),
				'###TEXT_ERR_COMMENT_LENGTH###' => $this->pi_getLLWrap($pObj, 'pi1_template.texterrorlength', $fromAjax),
				'###TEXT_ERR_COMMENT_NULL###' => $this->pi_getLLWrap($pObj, 'pi1_template.texterrornull', $fromAjax),
				'###AJAX_DATA###' => $this->getAjaxJSData($feuserid,$GLOBALS['TSFE']->id,$GLOBALS['TSFE']->lang,$conf,$pObj,$tmpcid, $fromAjax),
				'###AJAX_COMMENTSDATA###' => $this->getAjaxJSDataComments ($tmpcid,$pObj,$fromAjax),
				'###AJAX_COMMENTSIMGS###' => $this->getAjaxJSDataCommentImgs($tmpcid,$pObj,$fromAjax),
		);

		//fe_user-intergration
		$markers['###USERNAME###'] = $GLOBALS['TSFE']->fe_user->user['username'];


		// Call hook for custom markers

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

		$retstr='';
		if ($fromAjax) {
			$cid = 0;
			if (($this->newcommentid !== -1) && (!intval($conf['spamProtect.']['requireApproval']) == 1)){
				$retstr = '<div id=' . $this->newcommentid . '></div>';
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
			$fe_user_user_uid =$TSFE->fe_user->user['uid'];
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

					$_SESSION['submitCommentVars'][$cid]['image']='';
					$_SESSION['submitCommentVars'][$cid]['imagetag']='';

				$_SESSION['feuserid'] = $fe_user_user_uid;
				$reloadpivars=TRUE;
			}

			/* Do everything to buildup First and Lastname
			 * regardless of the how its filled in feusers
			* 1. Firstname and Lastname
			* 2. if 1. not ok the we take it from name
			* 3. if this still doesnt work (only username exists) We create
			* First- and Lastname from the username
			*/

			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('uid, username, name,
					first_name, middle_name, last_name, address,
					telephone, email, crdate, title, zip, city, country, www, company, image, lastlogin, is_online', 'fe_users',
					'uid=' . $fe_user_user_uid );

			if (count($rows) ==1) {
				foreach($rows as $key) {


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

					if ($reloadpivars) {
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
						if ($key['image']) {
							if ($key['image']!='') {
								$piVars['image'] = $key['image'];
								$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];
								$nouserpic=FALSE;
							}
						}
						if ($nouserpic){
							if ($conf['DefaultUserImage']) {
								$fileinfo = t3lib_div::split_fileref($conf['DefaultUserImage']);
								if (t3lib_div::inList('jpg,gif,jpeg,png',$fileinfo['fileext'])) {

									$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$conf['DefaultUserImage'];
									$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
									$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
									$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
									$userimgFileArr= explode('/',$userimgFile);

									$commentimageout=$userimgFileArr[count($userimgFileArr)-1];
									$nouserpic=FALSE;
									$piVars['image'] = $commentimageout;
									$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];
								}
							}
						}
						if ($nouserpic){
							$piVars['image'] = 'nopic.jpg';
							$_SESSION['submitCommentVars'][$cid]['image'] = $piVars['image'];
							$nouserpic=FALSE;
						}

					}

					if ((!$piVars['imagetag'])  || $reloadpivars) {


						$userimagesize=$conf['UserImageSize'];
						$userimagestyle=$conf['advanced.']['FeUserImageStyle'];
						$commentuserimagepath = $conf['advanced.']['FeUserImagePath'];
						if (($key['image'] !='') || ($key['image'])) {
							$piVars['imagetag'] = $key['image'];
							$commentuserimageout= $commentuserimagepath . $key['image'];
						}
						else
						{

							$piVars['imagetag'] = $key['image'];

							if ($conf['DefaultUserImage']) {
								$fileinfo = t3lib_div::split_fileref($conf['DefaultUserImage']);
								if (t3lib_div::inList('jpg,gif,jpeg,png',$fileinfo['fileext'])) {

									$userimgFile = $GLOBALS['TSFE']->absRefPrefix.$conf['DefaultUserImage'];
									$userimgFile = $GLOBALS['TSFE']->getFileAbsFileName.$userimgFile;
									$userimgFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);
									$userimgFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$userimgFile);

								}
							}
							$commentuserimageout=$userimgFile;

						}


						$this->cObj = t3lib_div::makeInstance('tslib_cObj');
						$img = array();

						$img['file'] = GIFBUILDER;
						//print('7<br>' . $commentuserimageout);
						$img['file.']['XY'] = '' . $userimagesize .',' . $userimagesize . '';
						$img['file.']['10'] = IMAGE;

						$img['file.']['10.']['file'] = $commentuserimageout;
						$img['file.']['10.']['file.']['width'] = $userimagesize . 'c';
						$img['file.']['10.']['file.']['height'] = $userimagesize . 'c';

						if (!$_SESSION['commentListCount']) {
							$img['params'] = 'style="' . $userimagestyle . ' visibility: hidden;margin: -1000px 0 0;" id="tx-toctoc-comments-uimg-xx" align="left"';
						}
						else {
							$img['params'] = 'style="' . $userimagestyle . ' visibility: hidden;margin: -1000px 0 0;" id="tx-toctoc-comments-uimg-' . $_SESSION['commentListCount'] . '" align="left"';
						}
						//print('10<br>');
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
					'###SR_FREECAP_CANT_READ###' => $this->pi_getLLWrap($pObj, 'pi1_template.captcha_cant_read', $fromAjax),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
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
					'###SR_FREECAP_CANT_READ###' => $this->pi_getLLWrap($pObj, 'pi1_template.captcha_cant_read', $fromAjax),
					'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
			));
		}
		return '' ;
	}
	/**
	 * Wraps error message for the given field if error exists.
	 *
	 * @param	string		$field	Input field from the form
	 * @param	object		$pObj: parent object
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Error wrapped with stdWrap or empty string
	 */
	protected function form_wrapError($field, &$pObj, $conf) {
		return $_SESSION['formValidationErrors'][$field] ?
		$pObj->cObj->stdWrap($_SESSION['formValidationErrors'][$field], $conf['requiredFields_errorWrap.']) : '';
	}


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
	 * @return	void
	 */
	protected function processBrowserSubmission($conf, $pObj, $piVars, $fromAjax, $cid, $cmd,$pid) {

			if (version_compare ( TYPO3_version, '4.6', '<' )) {
				t3lib_cache::initPageCache ();
				t3lib_cache::initPageSectionCache ();
			}

			$rpp = intval($conf['advanced.']['commentsPerPage']);
			$rpp = ($rpp == 0 ? 1 : $rpp);

			$confmaxstepsbackbyolder = $conf['advanced.']['CommentsShowOldPerCID'];
			$maxstepsbackbyolder = $confmaxstepsbackbyolder *$rpp;

			if ($cmd=="browse"){
				if(($pObj->startpoint - $maxstepsbackbyolder)<0){
					$pObj->startpoint=0;
				}
				else{
					$pObj->startpoint = $pObj->startpoint - $maxstepsbackbyolder;
				}

			} elseif ($cmd=="browsehide") {
				$pObj->startpoint = $pObj->totalrows - $rpp;
				if ($pObj->startpoint<0) {
					$pObj->startpoint=0;
				}
			}
			/*
			 * now startpoint can be 0 but cannot be greater than
			* currenttotalrows-startpoint
			*/

			$_SESSION['commentListIndex']['cid' . $cid]['startIndex'] =$pObj->startpoint;


		// Clear cache
			$cacheidlist= strval($pid); //; // . ', 100';
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
	 * Inserts a new comment
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: pageid
	 * @param	int		$lang: languaguecode
	 * @return	void
	 */
	public function processSubmission($conf,$pObj,$piVars,$fromAjax,$feuserid,$pid,$lang) {

		if ($piVars['insert']=='insert') {

			$_SESSION['submitJustProcessed'] = '1';



			$_SESSION['submittedCid'] = intval(trim($piVars['cid']));
			$cid= trim($piVars['cid']);
			$_SESSION['submitCommentVars'][$cid]['content'] = trim($piVars['content']);
			$_SESSION['submitCommentVars'][$cid]['homepage'] = trim($piVars['homepage']);
			$_SESSION['submitCommentVars'][$cid]['firstname'] = trim($piVars['firstname']);
			$_SESSION['submitCommentVars'][$cid]['image'] = trim($piVars['image']);
			$_SESSION['submitCommentVars'][$cid]['lastname'] = trim($piVars['lastname']);
			$_SESSION['submitCommentVars'][$cid]['email'] = trim($piVars['email']);
			$_SESSION['submitCommentVars'][$cid]['location'] = trim($piVars['location']);
			$this->newcommentid = 0;

			if (!($this->processSubmission_validate($piVars, $conf, $pObj,$fromAjax))) {
				$_SESSION['timeintensivedbaction'] = '1';

				$external_ref = $pObj->foreignTableName . '_' . $pObj->externalUid;
				/* Create record
				*
				* We could add 'image' => trim($this->piVars['image']),
				* The table should include the filed and then we could display
				* the userpic in the backend from the table
				*/
				$strCurrentIP = $this->getCurrentIp();
				$record = array(
						'pid' => intval($conf['storagePid']),
						'external_ref' => $external_ref,	// t3lib_loaddbgroup should be used but it is very complicated for FE... So we just do it with brute force.
						'external_prefix' => trim($conf['externalPrefix']),
						'firstname' => trim($piVars['firstname']),
						'lastname' => trim($piVars['lastname']),
						'email' => trim($piVars['email']),
						'location' => trim($piVars['location']),
						'homepage' => trim($piVars['homepage']),
						'content' => trim($piVars['content']),
						'external_ref_uid' => 'tt_content_' . trim($piVars['cid']),
						'remote_addr' => $strCurrentIP,
				);
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
				}
				else {

					$isSpam = $this->processSubmission_checkTypicalSpam($conf, $piVars,$lang, $fromAjax);

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

						if (version_compare ( TYPO3_version, '4.6', '<' )) {
							t3lib_cache::initPageCache ();
							t3lib_cache::initPageSectionCache ();
						}
						$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_comments', $record);
						$newUid = $GLOBALS['TYPO3_DB']->sql_insert_id();

						// check the toctoc_comments_user
						if ($conf['userStats']) {
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
										));
							}
							$dataWhereStats = 'pid=' . intval($conf['storagePid']) .
							' AND toctoc_comments_user="' . $fetoctocusertoinsert . '"';

							$sqlstr = 'SELECT COUNT(uid) AS nbrentries FROM tx_toctoc_comments_comments WHERE ' . $dataWhereStats;
							$resultcount = mysql_query($sqlstr);
							$rowStats = mysql_fetch_array($resultcount);
							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_user SET ' .
									'comment_count=' . intval($rowStats['nbrentries']) .
									', current_ip="' . $strCurrentIP .
									'", current_firstname="' . trim($piVars['firstname']) .
									'", current_lastname="' . trim($piVars['lastname']) .
									'", current_email="' . trim($piVars['email']) .
									'", current_homepage="' . trim($piVars['homepage']) .
									'", current_location="' . trim($piVars['location']) .
									'", tstamp_lastupdate=' . time()  .
									' WHERE ' . $dataWhereStats );
						}

						$_SESSION['commentListIndex']['cid' . $_SESSION['commentListCount']]['startIndex']=$_SESSION['commentListIndex']['cid' . $_SESSION['commentListCount']]['startIndex']+1;
						// Update reference index. This will show in theList view that someone refers to external record.
						$refindex = t3lib_div::makeInstance('t3lib_refindex');
						/* @var $refindex t3lib_refindex */
						$refindex->updateRefIndexTable('tx_toctoc_comments_comments', $newUid);
						$this->newcommentid = intval($newUid);
						// Insert URL (if exists)
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
							foreach (array('firstname', 'lastname', 'email', 'location', 'homepage') as $field) {
								setcookie($pObj->prefixId . '_' . $field, $piVars[$field], time() + 365*24*60*60, '/');
							}
						}
						$_SESSION['edgeTime'] = microtime(true);

						// See what to do next
						if (!$isApproved) {
							// Show message
							$pObj->formTopMessage .= $this->pi_getLLWrap($pObj, 'requires.approval', $fromAjax);
							$this->sendNotificationEmail($newUid, $isSpam, 'approve', $conf, $pObj, $fromAjax, $piVars, $pid);
							unset($_SESSION['requestCapcha'][$cid]);
						} else {
							unset($_SESSION['requestCapcha'][$cid]);

								// Call hook for custom actions (requested by Cyrill Helg)
 							if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['processValidComment'])) {
								foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['processValidComment'] as $userFunc) {
									$params = array(
											'pObj' => &$pObj,
											'uid' => intval($newUid),
									);
									t3lib_div::callUserFunction($userFunc, $params, $pObj);
								}
							}


							if (strlen($conf['spamProtect.']['informationEmail']) > 0){
								$this->sendNotificationEmail($newUid, $isSpam, 'info', $conf, $pObj, $fromAjax, $piVars, $pid);
							}

							// Clear cache
							$cacheidlist= strval($pid); // . ', 100';
							$pidList = t3lib_div::intExplode(',', $cacheidlist);

							t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
							$tce = t3lib_div::makeInstance('t3lib_TCEmain');

							/* @var $tce t3lib_TCEmain */
							foreach ($pidList as $cpid) {
								if ($cpid != 0) {
									$tce->clear_cacheCmd($cpid);
								}
							}
							//$this->resetSessionVars(0, false);
							$pObj->formTopMessage='';
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
									'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments')
							)
					);
					$_SESSION['formTopMessage'] = $pObj->formTopMessage;
				}
			}
			if (($_SESSION['formTopMessage']) || ($_SESSION['formValidationErrors']['errorcode'])) {


				// Clear cache
				$cacheidlist= strval($pid); // . ', 100';
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
	 * Checks for typical spam scenarios
	 *
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	array		$piVars:  Array with pi-Variables
	 * @param	[type]		$lang: ...
	 * @param	boolean		$fromAjax: if the request comes from Ajax or pi1
	 * @return	int		Number of points. Considered as spam if more than zero
	 */
	protected function processSubmission_checkTypicalSpam($conf, $piVars, $lang, $fromAjax) {

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
				$this->formTopMessage = $this->pi_getLLWrap($pObj, 'pi1_template.captchaInputNeeded', $fromAjax);
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
	 * @return	void
	 */
	public function sendNotificationEmail($uid, $points, $action, $conf, $pObj, $fromAjax, $piVars, $pid) {
		if ($action == 'info') {
			$toEmail = $conf['spamProtect.']['informationEmail'];
		} else {
			$toEmail = $conf['spamProtect.']['notificationEmail'];
		}
		$fromEmail = $conf['spamProtect.']['fromEmail'];

		$clearCacheIds = $this->getClearCacheIds($conf,$pid);

		if (t3lib_div::validEmail($toEmail) && t3lib_div::validEmail($fromEmail)) {
			$check = md5($uid . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);

			$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplateInfo']);
			$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);

			if ($action == 'info') {
				if ($fromAjax) {
					$template = @file_get_contents(PATH_site . $usetemplateFile);
				} else {
					$template = $pObj->cObj->fileResource($usetemplateFile);
				}
				$markers = array(
						'###URL###' => $_SESSION['commentsPageIds'][$pid],
						'###POINTS###' => $points,
						'###FIRSTNAME###' => $piVars['firstname'],
						'###LASTNAME###' => $piVars['lastname'],
						'###EMAIL###' => $piVars['email'],
						'###LOCATION###' => $piVars['location'],
						'###HOMEPAGE###' => $piVars['homepage'],
						'###CONTENT###' => $piVars['content'],
						'###REMOTE_ADDR###' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
						'###DELETE_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=delete'),
						'###KILL_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=kill'),
						'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
				);
			} else {
				$usetemplateFile= str_replace('/EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$conf['spamProtect.']['emailTemplate']);
				$usetemplateFile= str_replace('EXT:toctoc_comments', 'typo3conf/ext/toctoc_comments',$usetemplateFile);
				if ($fromAjax) {
					$template = @file_get_contents(PATH_site . $usetemplateFile);
				} else {
					$template = $pObj->cObj->fileResource($usetemplateFile);
				}
				$markers = array(
						'###URL###' =>  $_SESSION['commentsPageIds'][$pid],
						'###POINTS###' => $points,
						'###FIRSTNAME###' => $piVars['firstname'],
						'###LASTNAME###' => $piVars['lastname'],
						'###EMAIL###' => $piVars['email'],
						'###LOCATION###' => $piVars['location'],
						'###HOMEPAGE###' => $piVars['homepage'],
						'###CONTENT###' => $piVars['content'],
						'###REMOTE_ADDR###' => t3lib_div::getIndpEnv('REMOTE_ADDR'),
						'###APPROVE_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=approve'),
						'###DELETE_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=delete'),
						'###KILL_LINK###' => t3lib_div::locationHeaderUrl('index.php?eID=toctoc_comments&uid=' . $uid . '&chk=' . $check . '&clearCache=' . urlencode($clearCacheIds) . '&cmd=kill'),
						'###SITE_REL_PATH###' => '/' . t3lib_extMgm::siteRelPath('toctoc_comments'),
				);
			}


			// Call hook for custom markers
			if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['sendNotificationMail'])) {
				foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['toctoc_comments']['sendNotificationMail'] as $userFunc) {
					$params = array(
							'pObj' => &$this,
							'template' => $template,
							'check' => $check,
							'markers' => $markers,
							'uid' => $uid
					);
					if (is_array($tempMarkers = t3lib_div::callUserFunction($userFunc, $params, $this))) {
						$markers = $tempMarkers;
					}
				}
			}

			$content = $pObj->cObj->substituteMarkerArray($template, $markers);
			t3lib_div::plainMailEncoded($toEmail, $this->pi_getLLWrap($pObj, 'email.subject', $fromAjax), $content, 'From: ' . $conf['spamProtect.']['fromEmail']);
		}
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
	 * Creates links from "http://..." or "www...." phrases.
	 *
	 * @param	string		$text	Text to search for links
	 * @param	array		$conf:  Array with the plugin configuration
	 * @return	string		Text to convert
	 */
	protected function createLinks($text, $conf) {
		if ($conf['advanced.']['autoConvertLinks']) {
			$textout= preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" class="tx-toctoc-comments-external-autolink">\1</a>', $text);
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
	protected function applyStdWrap($text, $stdWrapName, $conf, $pObj) {

		if (is_array($conf[$stdWrapName . '.'])) {
			$text = $pObj->cObj->stdWrap($text, $conf[$stdWrapName . '.']);
		}
		return $text;
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
		return $clearCacheIds . '';
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$data: ...
	 * @return	[type]		...
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
				$content = str_ireplace($smilie, $image, $content);
			}
		}
		return $content;
	}

	/**
	 * Returns AJAX Data Javascript
	 *
	 * @param	int		$feuserid:  ID of the User, 0 when not logged in
	 * @param	int		$pid: storagePid
	 * @param	int		$languagecode: ID of the language
	 * @param	array		$conf:  Array with the plugin configuration
	 * @param	object		$pObj: parent object
	 * @param	int		$cid: ID of the content element
	 * @param	boolean		$fromAjax: if the request is an AJAX request
	 * @return	string		HTML
	 */
	protected function getAjaxJSData($feuserid, $pid, $languagecode, $conf, $pObj, $cid, $fromAjax) {

		if (($_SESSION['AJAXCid'] != $cid) || ($fromAjax)) {

			if (!$fromAjax) {
				$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid);
			} else {
				$ajaxData =$_SESSION['ajaxData'];
			}

			$jsAjaxData = '	<script type="text/javascript">';
			$jsAjaxData .= "var commentsAjaxData" . $cid . " = '" . rawurlencode($ajaxData) . "';</script>";


			$_SESSION['AJAXCid'] = $cid;
			if (!$fromAjax) {
				$_SESSION['ajaxData'] = $ajaxData;
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

		unset($confCopy['userFunc']);
		if (!$feuserid){$feuserid=0;}

		$data = serialize(array(
				'feuser' => $feuserid,
				'pid' => $pid,
				'cid' => $cid,
				'conf' => $confCopy,
				'lang' => $languagecode,
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
	protected function  getAjaxJSDataCommentImgs($cid, $pObj,$fromAjax) {
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

		/* 	Print_r ($piVarsCopy);
		 Print ('<br>pid: ' . $pid);
		print ('<br>lang: ' . $languagecode);
		print ('<br>user: ' . $feuserid);
		exit; */

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
	 * Retrieves default configuration of ratings.
	 * Uses plugin.toctoc_ratings_pi1 from page TypoScript template
	 *
	 * @return	array		TypoScript configuration for ratings
	 */
	public function getDefaultConfig() {
		return $GLOBALS['TSFE']->tmpl->setup['plugin.']['toctoc_comments_pi1.'];
	}

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
	public function getRatingDisplay($ref, $conf = null, $fromAjax = false, $pid=0, $returnasarray = false, $feuserid = 0, $cmd = 'vote',
			$pObj = null, $cid, $fromcomments) {

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

		$html =  $this->generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments);
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

			/* 			print_r ($recs);
				exit;	 */
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
					$recs['comment'] =array('crdate' => 0);
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
	 * @return	string		conditionally also an arraywith the rating content
	 */
	protected function generateRatingContent($ref, $template, $conf, $fromAjax, $pid, $returnasarray, $feuserid, $pObj,$cmd, $cid,$fromcomments) {
		// Init language
		$siteRelPath = '/' . t3lib_extMgm::siteRelPath('toctoc_comments');

		/* $language = t3lib_div::makeInstance('language');
		$language->init($GLOBALS['TSFE']->lang); */
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
		$rating = $this->getRatingInfo($ref, $pObj,-1,$conf);

		$myrating = $this->getRatingInfo($ref,$pObj,$feuserid,$conf);

		/* 		print_r($rating) ;
			print '<br>';
		print_r($myrating) ;*/

		if (($cmd=='vote') ||($cmd=='votearticle')) {
			if ($rating['vote_count'] > 0) {
				$rating_value = $rating['rating']/$rating['vote_count'];
				$rating_str = sprintf($this->pi_getLLWrap($pObj, 'api_rating',$fromAjax), $rating_value, $conf['ratings.']['maxValue'], $rating['vote_count']);
			}
			else {
				$rating_value = 0;
				$rating_str = $rating_str = $this->pi_getLLWrap($pObj, 'api_not_rated',$fromAjax);
			}
			if ($conf['ratings.']['mode'] == 'static' || (!$conf['ratings.']['disableIpCheck'] && $this->isVoted($ref,$conf,$pObj))) {
				$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_RATING_STATIC###');
				$links = '';
			}
			else {
				$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_RATING###');
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
			$introdiv = '<div class="tx-toctoc-comments-ratings">';
			$outrodiv='</div>';
			if (($fromAjax)) {
				if ($myrating['comment'][0]['commentdate']){
					if (!$fromcomments) {
						$commentcontinuation='';
						if (intval($conf['ratings.']['enableRatings']) ===1 ) {
							$commentcontinuation='&nbsp;&middot;&nbsp;';
						}
						$commentdatehtml = $pObj->cObj->substituteMarkerArray($commentdateSub, array(
							'###COMMENT_DATE###' => $this->formatDate($myrating['comment'][0]['commentdate'], $this, $fromAjax) .$commentcontinuation,
								));
						$introdiv = '';
						$outrodiv='';
					}
					else {
						$introdiv = '';
					}
		        }

			}
			else{
				if ($myrating['comment'][0]['commentdate'] > 0) {
					$introdiv = '';
				}
			}
		} else {
			if ($fromAjax) {
				if ($fromcomments) {
					$ajaxData = $this->AjaxData;
					//print ('<br>ajaxData1b:' . $ajaxData);
				} else {
					$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid) ;
				}
			} else {
				$ajaxData = $this->getAjaxData($feuserid,$pid,$languagecode,$conf,$cid) ;
			}
			if ($conf['ratings.']['mode'] == 'static' ) {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING_STATIC###');
				} else {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}
				$links = '';
			} else {
				if (($cmd=== 'like') || ($cmd=== 'unlike')) {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYRATING###');
				} else {
					$subTemplate = $pObj->cObj->getSubpart($template, '###TEMPLATE_MYARTICLERATING_TOP###');
				}
			}
		}
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
		if ($mydislikeval==0) {
			$mydislikepic='idislikemaybe.png';
			$mydislikepicalkt=$this->pi_getLLWrap($pObj, 'api_dislikemaybe',$fromAjax);
			$mydislikehtml=$this->pi_getLLWrap($pObj, 'api_dislike',$fromAjax);

		} else {
			$mydislikepic='idislike.png';
			$mydislikepicalkt=$this->pi_getLLWrap($pObj, 'api_idislikethis',$fromAjax);
			$mydislikehtml=$this->pi_getLLWrap($pObj, 'api_idislike',$fromAjax);
		}
		$mydislikehtml=$mydislikehtml . $sumdislikevalstr;
		$mydislike='<img alt="' . $mydislikepicalkt . '" title="' . $mydislikepicalkt
		. '" src="' . '/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/' . $mydislikepic . '" />';

		if ($mylikeval==0) {
			$mylikepic='ilikemaybe.png';
			$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_likemaybe',$fromAjax);
			$mylikehtml=$this->pi_getLLWrap($pObj, 'api_like',$fromAjax);

		} else {
			$mylikepic='ilike.png';
			$mylikepicalkt=$this->pi_getLLWrap($pObj, 'api_ilikethis',$fromAjax);
			$mylikehtml=$this->pi_getLLWrap($pObj, 'api_ilike',$fromAjax);
		}
		$mylikehtml=$mylikehtml. $sumlikevalstr;
		$mylike= '<img alt="' . $mylikepicalkt . '" title="' . $mylikepicalkt
		. '" src="' . '/' . t3lib_extMgm::siteRelPath('toctoc_comments') . 'res/css/'  . $mylikepic . '" />';


		if ($conf['ratings.']['mode'] == 'static' ) {
			$mypiclikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mypiclikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_LINK_SUB###');
		}
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
    	));
		$mylike=$mypiclikehtmlSub;

		if ($conf['ratings.']['mode'] == 'static' ) {
			$mylikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mylikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_LINK_SUB###');
		}
		$check = $this->getcheck($ref, $i, $ajaxData, true);
		$mylikehtmlSub =  $pObj->cObj->substituteMarkerArray($mylikeSub, array(
						'###VALUE###' => $i,
						'###REF###' => $ref,
						'###PID###' => $pid,
						'###CID###' => $cid,
						'###CHECK###' => $check,
						'###CONTENT###' => $mylikehtml,
						'###SITE_REL_PATH###' => $siteRelPath,
    	));
		$mylikehtml=$mylikehtmlSub;

		if ($conf['ratings.']['mode'] == 'static' ) {
			$mydislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mydislikeSub = $pObj->cObj->getSubpart($template, '###IDISLIKE_LINK_SUB###');
		}
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
		));
		$mydislikehtml=$mydislikehtmlSub;
		if ($conf['ratings.']['mode'] == 'static' ) {
			$mypicdislikeSub = $pObj->cObj->getSubpart($template, '###ILIKE_STATIC_SUB###');
		} else {
			$mypicdislikeSub = $pObj->cObj->getSubpart($template, '###IDISLIKE_LINK_SUB###');
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
		));
		$mydislike=$mypicdislikehtmlSub;

		$myrating_value=intval($myrating['myrecs'][0]['myrating']);

		if ($myrating_value==0){
			$myrating_left = 0;
			$myrating_width = 0;
			$myratingtext='';
		} else {
			$myrating_left = $myrating_value*11 -11;
			$myrating_width = 11;
			$myratingtext=$this->pi_getLLWrap($pObj, 'api_yourrating',$fromAjax) . $myrating_value;
		}

		if (intval($conf['ratings.']['useLikeDislike'] ) !== 1) {
			$mylikehtml = '';
			$mydislikehtml = '';
			$mylike ='';
			$mydislike ='';
		} else {
			if (intval($conf['ratings.']['useDislike'] ) !== 1) {
				$mydislikehtml = '';
				$mydislike ='';
				if ($cmd === 'liketop') {
					$mylikehtml .= '&nbsp;&middot;&nbsp;&nbsp;';
				}
			} else {
				$mylikehtml .= '&nbsp;&middot;&nbsp;';
				if (strpos($cmd, 'top')!==false) {
					$mydislikehtml .= '&nbsp;&middot;&nbsp;&nbsp;';
				}
			}
		}

		if (intval($conf['ratings.']['useMyVote'] ) !== 1) {
			$myratingtext= '';
			$myrating_width = 0;
			$myrating_left=0;
		}
		$strhidevote = '';
		if (!($conf['ratings.']['useVotes'])) {
			$strhidevote = '-hide';
			//print_r ($conf);exit;
		}
		$hidecss ='';
		if (strpos($cmd, 'like')!==false) {

			if (strpos($cmd, 'liketop')!==false) {
				$mylikehtml = str_replace('\'like\',', '\'liketop\',',$mylikehtml );
				$mydislikehtml = str_replace('\'unlike\',', '\'unliketop\',',$mydislikehtml );
				$mylikehtml = str_replace('\'myratings\'', '\'myratingstop\'',$mylikehtml );
				$mydislikehtml = str_replace('\'myratings\'', '\'myratingstop\'',$mydislikehtml );

				if (($conf['ratings.']['ratingsOnly'] ==1)) {
					$hidecss ='-hide';
				}

			}

			$markers = array(
					'###PID###' => $pid,
					'###HIDECSS###'=> $hidecss,
					'###CID###' => $cid,
					'###REF###' => htmlspecialchars($ref),
					'###SITE_REL_PATH###' => $siteRelPath,
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
			);
		} else {
			$hidecss ='';
			if (($conf['ratings.']['ratingsOnly'] ==1)) {
				$hidecss ='-hide';
			}
			$markers = array(
					'###HIDECSS###'=> $hidecss,
					'###INTRODIV###' => $introdiv,
					'###OUTRODIV###' => $outrodiv,
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
					'###MYILIKE###' => $mylike,
					'###MYIDISLIKE###' => $mydislike,
					'###MYILIKETEXT###' => $mylikehtml,
					'###MYIDISLIKETEXT###' => $mydislikehtml,
					'###MYBAR_WIDTH###' => $myrating_width,
					'###MYBAR_LEFT###'=> $myrating_left,
			);
		}
		if (intval($conf['ratings.']['enableRatings']) === 1 ) {
					$contentarr['voteing']= $pObj->cObj->substituteMarkerArray($subTemplate, $markers);
		} else {
			$contentarr['voteing']='';
		}
		$contentarr['idislike']='';
		$contentarr['ilike']='';
		$contentarr['myvote']='';
		if (intval($conf['ratings.']['useLikeDislike'] ) === 1) {
			$contentarr['ilike']=$mylikehtml;
			if (intval($conf['ratings.']['useDislike']) === 1) {
				$contentarr['idislike']=$mydislikehtml;
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
				//print ('<br>ref' . $ref . '<br>ajaxData2' .$ajaxData . '<br>i' .$i );
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
	 * @return	string		Formatted date
	 */
	public function formatDate($date, $pObj, $fromAjax) {

		$start_time_for_conversion = $date;
		$end_time_for_conversion = time();

		$difference_of_times = $end_time_for_conversion - $start_time_for_conversion;

		$time_difference_string = '';
		$stringcollator=0;
		$morethanonstr =$this->pi_getLLWrap($pObj, 'timeconv.morethanone',$fromAjax);
			for($i_make_time = 6; $i_make_time > 0; $i_make_time--)	{
			switch($i_make_time)
			{
				// Handle Minutes
				// ........................

				case '1';
				$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.minute',$fromAjax);
				$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.n',$fromAjax);

				$unit_size = 60;
					break;

				// Handle Hours
				// ........................

				case '2';
				$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.hour',$fromAjax);
				$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.n',$fromAjax);

				$unit_size = 3600;
					break;

					// Handle Days
					// ........................

					case '3';
				$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.day',$fromAjax);
				$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.en',$fromAjax);
				$unit_size = 86400;
					break;

					// Handle Weeks
					// ........................

					case '4';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.week',$fromAjax);
				$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.n',$fromAjax);

				$unit_size = 604800;
					break;

					// Handle Months (31 Days)
					// ........................

					case '5';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.month',$fromAjax);
				$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.n',$fromAjax);
				$unit_size = 2678400;
					break;

					// Handle Years (365 Days)
					// ........................

					case '6';
					$unit_title = $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.year',$fromAjax);
				$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.en',$fromAjax);
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
						$time_difference_string .= $units_calculated . ' ' . $unit_title . $morethanonstr . ' ';
					}
					$stringcollator = $stringcollator + 1;
				}
			}
		}

		// Handle Seconds
		// ........................
		if ($stringcollator<2) {
			$morethanonstr =$this->pi_getLLWrap($pObj, 'pi1_template.timeconv.morethanonegerman.n',$fromAjax);

				if ($difference_of_times==1) {
						$time_difference_string .= $difference_of_times . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.second',$fromAjax) . ' ';
				} else {
						$time_difference_string .= $difference_of_times . ' ' . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.second',$fromAjax) . $morethanonstr . ' ';
				}
		}
					return trim($this->pi_getLLWrap($pObj, 'pi1_template.timeconv.textbefore',$fromAjax) . ' ' . $time_difference_string . $this->pi_getLLWrap($pObj, 'pi1_template.timeconv.textafter',$fromAjax));
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
		$html = preg_replace('/\n/', '', $html);
		$html = preg_replace('/\s\s+/', ' ', $html);

		$html = preg_replace('/> </', '><', $html);
		$html = str_replace(array("\r\n", "\r", "\n"), '', $html);
		$html = str_replace("div><div", "div>\r\n<div", $html);
		$html = str_replace("</div></div>", "</div>\r\n</div>", $html);
		return $html;
	}

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


		$imgstr =base64_decode($basedimgstr);
		$toctocuid=base64_decode($basedtoctocuid);
		$userimagesize= 3*$conf['UserImageSize'];
		$replstr = 'width: ' . $conf['UserImageSize'] . 'px; height: ' . $conf['UserImageSize'] . 'px';
		$newstr = 'width: ' . $userimagesize . 'px; height: ' . $userimagesize . 'px';
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
						$addnameinfo = '<br /><span class="tx-toctoc-comments-comment-uc-fullname_addinfo">' .
						'(' . $this->pi_getLLWrap($pObj, 'pi1_template.uc.herepostingas', true) . ' ' . $postingname . ')' . '</span>';
					}

				}



				// email on the User Card
				$uccontact='';
				$ucemail='';
				if ($conf['userEmailUC']) {
					if ($rowusr['initial_email'] != '') {
						$ucemailarr = $this->getMailTo($rowusr['initial_email']);
						$ucemail = '<a href="'. $ucemailarr[0] . '">' . $ucemailarr[1] . '</a>';
						if ($rowusr['current_email'] != '') {
							if ($rowusr['initial_email'] != $rowusr['current_email']) {
								$ucemailarrc = $this->getMailTo($rowusr['current_email']);
								$ucemailstr = '<a href="'. $ucemailarrc[0] . '">' . $ucemailarrc[1] . '</a>';

								$ucemail .= ' (' . $ucemailstr . ')';
							}
						}
					} else {
						$ucemailarr = $this->getMailTo($rowusr['current_email']);
						$ucemail = '<a href="'. $ucemailarr[0] . '">' . $ucemailarr[1] . '</a>';
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
						$uchomepage = preg_replace('/((https?:\/\/)?((?(2)([^\s]+)|(www\.[^\s]+))))/', '<a href="http://\3" rel="nofollow" title="'.$uchomepage .'" class="tx-toctoc-comments-external-autolink">\1</a>', $uchomepage);
						//$uchomepage = ', ' . '<a href="' . $uchomepage . '" title="'.$uchomepage .'">Website</a>';
					}
				}
				if (($uccontact != '') && ($uchomepage != '')) {$uccontact .='<br />';}
				$uccontact .=$uchomepage;
				if ($uccontact != '') {
					$uccontact ='<div class="tx-toctoc-comments-comment-uc-text-contact"><img class="tx-toctoc-ucpic" src="/' . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/img/uccontact.png" height="14" width="14" title="' .
						         	$this->pi_getLLWrap($pObj, 'pi1_template.uc.contact',true) . '">' . $uccontact .
						         '</div>';
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
				$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.joined',true) . ' ' . $this->formatDate($rowusr['tstamp'], $pObj, true);

			}
			if ($rowusr['tstamp_lastupdate'] != '') {
				if ($rowusr['tstamp_lastupdate'] != $rowusr['tstamp'] ) {

					if ($ucstats != '') {
						$ucstats .= '<br>' ;
					}
					$ucstats.=$this->pi_getLLWrap($pObj, 'pi1_template.uc.lastactivity',true) . ' ' . $this->formatDate($rowusr['tstamp_lastupdate'], $pObj, true);
				}
			}
			if ($ucstats != '') {
				$ucstats ='<div class="tx-toctoc-comments-comment-uc-text-stats"><img class="tx-toctoc-ucpic" src="/' . t3lib_extMgm::siteRelPath('toctoc_comments') .
								'res/img/ucstats.png" height="14" width="14" title="' .
						         	$this->pi_getLLWrap($pObj, 'pi1_template.uc.stats',true) . '">'  . $ucstats . '</div>';
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
				$ucip ='<div class="tx-toctoc-comments-comment-uc-text-ip"><img class="tx-toctoc-ucpic" src="/' . t3lib_extMgm::siteRelPath('toctoc_comments') .
				'res/img/ucip.png" height="14" width="14" title="'  . $this->pi_getLLWrap($pObj, 'pi1_template.uc.IPinfo',true) . '">'  . $ucip . '</div>';
			}

		}
		$statusmessage = '';
		if (((!$conf['userIPUC']) && (!$conf['userStatsUC']) && (!$conf['userContactUC'])) ||
		 ((!$conf['userHomepageUC']) && (!$conf['userLocationUC'])  && (!$conf['userEmailUC']) && ($conf['userContactUC'])))  {
			$statusmessage = $this->pi_getLLWrap($pObj, 'pi1_template.uc.noucoptions',true);
		}

		$imgstr = str_replace($replstr,$newstr, $imgstr);
		$content =  '<div class="tx-toctoc-comments-comment-uc-pic">' .
				$imgstr . '<br />' .
				'<span class="tx-toctoc-comments-comment-uc-fullname">' . $ucfullname . '</span>' . $addnameinfo .
				'</div>' .
				'<div class="tx-toctoc-comments-comment-uc-text">' ;

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

		if (!$_SESSION['TSFE']['config']['jumpurl_enable'] || $$_SESSION['TSFE']['config']['jumpurl_mailto_disable']) {
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

}


?>