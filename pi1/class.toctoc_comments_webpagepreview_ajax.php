<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
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
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
* class.toctoc_comments_webpagepreview_ajax.php
*
* AJAX Social Network Components
*
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   55: class toctoc_comments_getpagepreview
 *   59:     public function main($POSTcmd, $POSTref, $POSTdataconf, $POSTdataconfatt, $POSTdata, $pObj)
 *
 * TOTAL FUNCTIONS: 1
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

/**
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */
class toctoc_comments_getpagepreview {
private $lang = 0;
public $extKey = 'toctoc_comments';

	public function main($POSTcmd, $POSTref, $POSTdataconf, $POSTdataconfatt, $POSTdata, $pObj) {

		$cmd = $POSTcmd;

		$maxChars=50;
		$cid = 'p'. trim($POSTref);

		$data_str = $POSTdataconf;
		$data_uid = $POSTdataconf;
		if (intval($data_uid) != 0) {
			$data_str = $pObj->getAJAXDBCache($data_uid);
		}

		$data = unserialize(base64_decode($data_str));

		$conf = $data['conf'];

		$data_str = $POSTdata;
		$data = unserialize(base64_decode($data_str));

		$this->lang = $data['lang'];
		if (isset($data['commentid'])) {
			$commentid='p'. trim($data['commentid']);
		} else {
			$commentid='p0';
		}

		$data_str = $POSTdataconfatt;
		$data_uid = $POSTdataconfatt;
		if (intval($data_uid) != 0) {
			$data_str = $pObj->getAJAXDBCache($data_uid);
		}

		$dataconfatt = unserialize(base64_decode($data_str));

		$conf = $dataconfatt['conf'];
		$websitepreviewareaimagewidth =  $conf['attachments.']['webpagePreviewHeight'] + 10;

		$awaitgoogle = base64_decode($dataconfatt['awaitgoogle']);
		$txtimage = base64_decode($dataconfatt['txtimage']);
		$txtimages = base64_decode($dataconfatt['txtimages']);

		if ($conf['attachments.']['maxCharsPreviewTitle']!='') {
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
		$outhtml='';
		$divlogoset=FALSE;

		if (!isset($conf['theme.']['selectedTheme'])) {
			$conf['theme.']['selectedTheme'] = 'default';
		}

		if ($conf['theme.']['selectedTheme'] == '') {
			$conf['theme.']['selectedTheme'] = 'default';
		}
		$wrkimg = '<img align="right" id="tx-tc-form-wpp-working' . trim($POSTref) . '" src="'.$data['configBaseURL'].
					'typo3conf/ext/toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/workingslides.gif" class="tx-tc-working tx-tc-blockdisp" width="16" height="11" />';

		$workingstate=$_SESSION[$cid][$commentid]['working'];
		if ($_SESSION[$cid][$commentid]['description'] != '') {
			$testcurlerrarr = explode(',', $_SESSION[$cid][$commentid]['description']);
			if (count($testcurlerrarr)>2) {
				if ($testcurlerrarr[0] =='CURL') {
					if (intval($testcurlerrarr[1]) > 0) {
						$workingstate=intval($testcurlerrarr[1]);
						$_SESSION[$cid][$commentid]['description']='';
						$_SESSION[$cid][$commentid]['working']=$workingstate;
					}

				}

			}

		}

		$outhtml.= '<div id=' . $workingstate . '></div>';
		if (array_key_exists('embedUrl', $_SESSION[$cid][$commentid])) {
			if ($_SESSION[$cid][$commentid]['embedUrl'] != '') {
				//video found
				if ($_SESSION[$cid][$commentid]['videotype'] != 'SCD') {
					// not a soundcloud link
					if ($_SESSION[$cid][$commentid]['logo'] != '') {
						//url to preview picture found
						$videohtml=$outhtml;
						$videohtml .= '<div class="tx-tc-ct-video tx-tc-width95">';
						$videohtml .= '		<div class="tx-tc-ct-video-dp">';
						$videohtml .= '			<div id="tx-tc-cts-vid-formtext-###IDPLUS###p###CID###" class="tx-tc-cts-vid-formtext">';
						if ($_SESSION[$cid][$commentid]['logo']!=$_SESSION[$cid][$commentid]['embedUrl']){
							//flash
							$vidmaxwidth=round(intval($conf['attachments.']['webpagePreviewHeight'])*(4/3), 0);

							$videohtml .= '				<div class="tx-tc-vid"><img class="tx-tc-vidimg tx-tc-blockdisp" id="vidimg' . $cid . 'index1" src="' .
											$_SESSION[$cid][$commentid]['logo'] .
											'" class="tx-tc-pvs-vid-img" /></div>';

						} else {
							//html5
							$sourcearr= explode('@@@', $_SESSION[$cid][$commentid]['logo']);

							$videohtml .= '				<div class="tx-tc-vid">';
							$videohtml .= '				<video width="140" class="tx-tc-vidimgh5 tx-tc-blockdisp" id="vidimg' . $cid . 'index1">';
							$countsourcearr=count($sourcearr);
							for ($v=0;$v<$countsourcearr;$v++) {
								if ($v==0) {
									$videotype='video/ogg';
								} elseif ($v==1) {
									$videotype='video/mp4';
								} else	{
									$videotype='video/webm';
								}

								if (strlen($sourcearr[$v])>4) {
									$videohtml .= '				 <source src="' . $sourcearr[$v] . '" type="' . $videotype . '">';
								}

							}

							$videohtml .= '				 Your browser does not support HTML5 video.';
							$videohtml .= '				 </video>';
							$videohtml .= '				</div>';
						}

						$videohtml .= '				<div class="tx-tc-vid-video">';
						$videohtml .= '					<a href="###VIDEOURL###" rel="nofollow" title="###DESCALT###" onclick="">###TITLE###</a>';
						$videohtml .= '				</div>';
						$videohtml .= '				<div class="tx-tc-vid-desc">###DESC###';
						$videohtml .= '				</div>';
						$videohtml .= '			</div>';
						$videohtml .= '		</div>';
						$videohtml .= '</div>';
					}
				} else {
				// soundcloud embed
					$videohtml = $outhtml;
					$_SESSION[$cid][$commentid]['titleoutfound']=$_SESSION[$cid][$commentid]['title'];
					$videohtml .= '<div class="tx-tc-ct-video tx-tc-width95">';
					$videohtml .= '		<div class="tx-tc-ct-video-dp">';
					$videohtml .= '			<div id="tx-tc-cts-vid-formtext-###IDPLUS###p###CID###" class="tx-tc-cts-vid-formtext">';

					$vidmaxwidth=round(intval($conf['attachments.']['webpagePreviewHeight'])*(4/3), 0);

					$videohtml .= '				<div class="tx-tc-vid"><img class="tx-tc-vidimg tx-tc-blockdisp" id="vidimg' . $cid . 'index1" src="' .
											$_SESSION[$cid][$commentid]['logo'] .
											'" class="tx-tc-pvs-vid-img" /></div>';
					$videohtml .= '				<div class="tx-tc-vid-video">';
					$videohtml .= '					<a href="###VIDEOURL###" rel="nofollow" title="###DESCALT###" onclick="">###TITLE###</a>';
					$videohtml .= '				</div>';
					$videohtml .= '				<div class="tx-tc-vid-desc">###DESC###';
					$videohtml .= '				</div>';
					$videohtml .= '			</div>';
					$videohtml .= '		</div>';
					$videohtml .= '</div>';
				}

			} else {
				unset($_SESSION[$cid][$commentid]['embedUrl']);
			}

		}

		if (!array_key_exists('embedUrl', $_SESSION[$cid][$commentid])) {

			if ($_SESSION[$cid][$commentid]['logo'] != '') {

				$divlogoset=TRUE;
				$outhtml .= '<div class="tc-tc-webpagepreview tx-tc-margin-top0">';
			}

			if ($_SESSION[$cid][$commentid]['working'] < 2) {
				$outhtml .= $wrkimg;
			}

			$textdivleft='tx-tc-margin0';

			if (!isset($_SESSION[$cid][$commentid]['images'])) {
				$_SESSION[$cid][$commentid]['images']=0;
			}

			if (count($_SESSION[$cid][$commentid]['images']) > 0) {
				$textdivleft='tx-tc-pvs-formtext';
				$outhtml .= '<div class="tx-tc-pvs-images" id="toctoc_comments-pvs-images-' . $cid . '"><div id="toctoc_comments-pvs-image-box-' .
								$cid . '"  class="tx-tc-opa1">';
				$outhtmlpic ='';
				$cntimg=count($_SESSION[$cid][$commentid]['images']);
				if ($cntimg>$conf['attachments.']['webpagePreviewNumberOfImages']){
					$cntimg=$conf['attachments.']['webpagePreviewNumberOfImages'];
				}

				for ($i = 0; $i < $cntimg; $i++) {
					$displaystyle=' tx-tc-nodisp';
					if ($i==0) {
						$displaystyle=' tx-tc-blockdisp';
					}

					$outhtmlpic .= '<img id="pvsimg' . $cid . 'index' . $i . '"src="' .
									$_SESSION[$cid][$commentid]['images'][$i]['locallink'] . '" class="tx-tc-pvs-img' . $displaystyle . '" />';
				}

				$outhtml .=$outhtmlpic;
				$outhtml .='</div></div>';
			}

		}

		$trimeddescription=$_SESSION[$cid][$commentid]['description'];
		$trimedText=$_SESSION[$cid][$commentid]['title'];
		$opendiv=FALSE;
		if ($_SESSION[$cid][$commentid]['title'] != '') {
			if (!array_key_exists('embedUrl', $_SESSION[$cid][$commentid])) {
				$outhtml .= '<div id="toctoc-comments-pvs-formtext-' . $cid . '" class="' . $textdivleft . '">';
				$opendiv = TRUE;
				$picfoundinfo = '<span class="tx-tc-nodisp" id="toctoc-picfoundinfo-' . $cid .'">';

				if (!isset($_SESSION[$cid][$commentid]['totalcounter'])) {
					$_SESSION[$cid][$commentid]['totalcounter'] = 0;
				}

				if ($_SESSION[$cid][$commentid]['totalcounter'] > 0) {
					if ($_SESSION[$cid][$commentid]['totalcounter'] > $conf['attachments.']['webpagePreviewNumberOfImages']){
						$_SESSION[$cid][$commentid]['totalcounter'] = $conf['attachments.']['webpagePreviewNumberOfImages'];
					}

					If ($_SESSION[$cid][$commentid]['totalcounter'] > 1) {
						$txtimage =$txtimages;
					}

					$picfoundinfo = '<span class="tx-tc-blockdisp" id="toctoc-picfoundinfo-' . $cid .'"> (' . $_SESSION[$cid][$commentid]['totalcounter'] .' ' .
									$txtimage . ')';
				}

				$picfoundinfo .= '</span>';
			}

			$trimeddescription='';
			$text=$_SESSION[$cid][$commentid]['description'];
			$htmlarr=explode('<br />', $text);
			$text=implode(' ', $htmlarr);

			if (strlen($text)>$maxDescChars){
				$textcroppedleft = substr($text, 0, $maxDescChars);
				$textcroppedright = substr($text, $maxDescChars);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {
					$textcroppedleft .=$textcroppedrightarr[0] . ' ...';
					$trimeddescription =$textcroppedleft;
				}

				else {
					$trimeddescription =$textcroppedleft;
				}

			} else {
					$trimeddescription =$text;
			}

			$trimedText ='';
			$text=nl2br($_SESSION[$cid][$commentid]['title']);
			$htmlarr=explode('<br />', $text);
			$text=implode(' ', $htmlarr);
			$text=htmlspecialchars(stripslashes($text));
			if (strlen($text)>$maxChars){
				$textcroppedleft = substr($text, 0, $maxChars);
				$textcroppedright = substr($text, $maxChars);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {
					$textcroppedleft .=$textcroppedrightarr[0] . ' ...';
					$trimedText =$textcroppedleft;
				}

			} else {
				$trimedText =$text;
			}

			if (array_key_exists('embedUrl', $_SESSION[$cid][$commentid])) {
				$picfoundinfo='';
			}

			$outhtml .= '<div class="tx-tc-pvs-title"><a href="' . $_SESSION[$cid][$commentid]['urlfound'] . '">' . $trimedText . '</a>' . $picfoundinfo  . '</div>';
		} elseif ($_SESSION[$cid][$commentid]['urlfound'] != '') {
			$_SESSION[$cid][$commentid]['urlanalyzing'] .=  '.';
		} elseif ($_SESSION[$cid][$commentid]['url'] != '') {
			$_SESSION[$cid][$commentid]['urlanalyzing']='...';
		}

		if (!array_key_exists('embedUrl', $_SESSION[$cid][$commentid])) {
			if (($_SESSION[$cid][$commentid]['needgoogle'] == 1) && ($_SESSION[$cid][$commentid]['working'] != 2)) {

				$outhtml .= '<div class="tx-tc-pvs-statusgoogle">' . $awaitgoogle . $_SESSION[$cid][$commentid]['urlanalyzing'] . '</div>';
				$_SESSION[$cid][$commentid]['urlanalyzing'] .=  '.';
			}

		}

		if ($_SESSION[$cid][$commentid]['urltext'] != '') {
			$outhtml .= '<div class="tx-tc-pvs-urltext">' . $_SESSION[$cid][$commentid]['urltext'] . '</div>';
		}

		if ($_SESSION[$cid][$commentid]['description'] != '') {
			$trimeddescription=htmlspecialchars(stripslashes($trimeddescription));
			$outhtml .= '<div class="tx-tc-pvs-desc">' . $trimeddescription . '</div>';
		}

		if ($opendiv==TRUE) {
			$outhtml .='</div>';
		}

		if ($_SESSION[$cid][$commentid]['logo'] != '') {
			$divlogoset=TRUE;
		}

		if (!array_key_exists('embedUrl', $_SESSION[$cid][$commentid])) {
			if ($divlogoset) {
				$outhtml .= '</div>';
				$outhtml .= '<div class="tx-tc-pvs-logobg"  id="tx-tc-pvs-logobg-' . $cid .'">';
				$outhtml .= '<img src="' . $_SESSION[$cid][$commentid]['logo'] . '" class="tx-tc-wpplogopic" />';
				$outhtml .= '</div>';
			}

			if ($_SESSION[$cid][$commentid]['title'] != '') {
				$outhtml .='</div>';
			}

		} else {
			if (($_SESSION[$cid][$commentid]['logo'] != '') && ($_SESSION[$cid][$commentid]['embedUrl'] != '')){
				$videohtml = str_replace('###CID###', $cid, $videohtml);
				$videohtml = str_replace('###IDPLUS###', $commentid, $videohtml);
				$videohtml = str_replace('###DESC###', $trimeddescription, $videohtml);
				$trimedaltdescription = htmlspecialchars(stripslashes($trimeddescription));
				$videohtml = str_replace('###DESCALT###', $trimedaltdescription, $videohtml);
				if (trim($trimedText) =='') {
					if ($_SESSION[$cid][$commentid]['titleoutfound']=='') {
						$trimedText=$_SESSION[$cid][$commentid]['urltext'];
					} else {
						$trimedText=$_SESSION[$cid][$commentid]['titleoutfound'];
					}

				} else {
					if ($_SESSION[$cid][$commentid]['titleoutfound']=='') {
						$_SESSION[$cid][$commentid]['titleoutfound'] = $trimedText;
					}

				}

				$videohtml = str_replace('###TITLE###', $trimedText, $videohtml);
				$videohtml = str_replace('###VIDEOSRC###', $_SESSION[$cid][$commentid]['embedUrl'], $videohtml);
				$videohtml = str_replace('###VIDEOURL###', $_SESSION[$cid][$commentid]['urlfound'], $videohtml);

				$outhtml=$videohtml;
				if (array_key_exists('attachmentHTML', $_SESSION[$cid][$commentid])) {
					unset($_SESSION[$cid][$commentid]['embedUrl'] );
					unset($_SESSION[$cid][$commentid]['videosite'] );
					unset($_SESSION[$cid][$commentid]['attachmentHTML']);
				}

			}

		}

		if ($_SESSION[$cid][$commentid]['working'] >= 2) {
			//session_write_close();
			$pObj->commonObj->stop_toctoccomments_session();
		}

		echo $outhtml;

		exit();
	}

}
?>