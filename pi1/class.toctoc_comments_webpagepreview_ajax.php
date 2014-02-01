<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2013 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 *   59: class toctoc_comments_getpagepreview
 *   63:     function main()
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

$ml = new toctoc_comments_getpagepreview;
$ml->main();

class toctoc_comments_getpagepreview {
var $lang = 0;
var $extKey = 'toctoc_comments';

	function main() {

		session_name('sess_' . $this->extKey);
		session_start();
		$cmd = $_POST['cmd'];
		if(trim($cmd) != 'getpreview') {
			echo 'bad_cmd_value';
			exit();
		}
		$maxChars=50;
		$cid = 'p'. trim($_POST['ref']);

		$data_str = $_POST['dataconf'];
		$data = unserialize(base64_decode($data_str));
		$conf =$data['conf'];

		$data_str = $_POST['data'];
		$data = unserialize(base64_decode($data_str));

		$this->lang = $data['lang'];
		if (isset($data['commentid'])) {
			$commentid='p'. trim($data['commentid']);
		} else {
			$commentid='p0';
		}

		$data_str = $_POST['dataconfatt'];
		$dataconfatt = unserialize(base64_decode($data_str));
		$conf['attachments.']=$dataconfatt['conf'];
		$websitepreviewareaimagewidth =  $conf['attachments.']['webpagePreviewHeight'] + 10;

		$awaitgoogle =$dataconfatt['awaitgoogle'];
		$txtimage = $dataconfatt['txtimage'];
		$txtimages = $dataconfatt['txtimages'];

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
		$divlogoset=false;
		$wrkimg = '<img align="right" id="tx-tc-form-wpp-working' . trim($_POST['ref']) . '" src="'.$data['configBaseURL'].'typo3conf/ext/toctoc_comments/res/css/themes/' . $conf['theme.']['selectedTheme'] . '/img/workingslides.gif" width="16" height="11" />';
		//$_SESSION['pvscont'] +=1;

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
		else {
			///$_SESSION[$cid][$commentid]['description']='CURL';
		}

		$outhtml.= '<div id=' . $workingstate . '></div>';
		if (array_key_exists('embedUrl',$_SESSION[$cid][$commentid])) {
			if ($_SESSION[$cid][$commentid]['embedUrl'] != '') {
				//video found

					if ($_SESSION[$cid][$commentid]['logo'] != '') {
						//url to preview picture found
						$displaystyle='block';
						$videohtml=$outhtml;
						$videohtml .= '<div class="tx-tc-ct-video" style="width: 95%;">';
						$videohtml .= '		<div class="tx-tc-ct-video-dp">';
						$videohtml .= '			<div id="tx-tc-cts-vid-formtext-###IDPLUS###p###CID###" class="tx-tc-cts-vid-formtext">';
						if ($_SESSION[$cid][$commentid]['logo']!=$_SESSION[$cid][$commentid]['embedUrl']){
							//flash
							$vidmaxwidth=round(intval($conf['attachments.']['webpagePreviewHeight'])*(4/3),0);

							$videohtml .= '				<div class="tx-tc-vid"><img style="display:' . $displaystyle . '; max-width: ' . $vidmaxwidth . 'px; max-height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px;" id="vidimg' . $cid . 'index1" src="' . $_SESSION[$cid][$commentid]['logo'] . '" class="tx-tc-pvs-vid-img" /></div>' ;

						} else {
							//html5
							$sourcearr= explode('@@@', $_SESSION[$cid][$commentid]['logo']);


							$videohtml .= '				<div class="tx-tc-vid">' ;
							$videohtml .= '				<video width="140" style="display:' . $displaystyle . '; margin: 0 -4px 0 -8px; max-height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px;" id="vidimg' . $cid . 'index1">';
							for ($v=0;$v<count($sourcearr);$v++) {
								if ($v==0) {
									$videotype='video/ogg';
								} elseif ($v==1) {
									$videotype='video/mp4';
								} else	{
									$videotype='video/webm';
								}
								if (strlen($sourcearr[$v])>4) {
									$videohtml .= '				 <source src="' . $sourcearr[$v] . '" type="' . $videotype . '">' ;
								}
							}
							$videohtml .= '				 Your browser does not support HTML5 video.' ;
							$videohtml .= '				 </video>' ;
							$videohtml .= '				</div>' ;

						}

						$videohtml .= '				<div class="tx-tc-vid-video">';
						$videohtml .= '					<a href="###VIDEOURL###" rel="nofollow" title= "###DESC###" onclick="">###TITLE###</a>';
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
		if (!array_key_exists('embedUrl',$_SESSION[$cid][$commentid])) {

			if ($_SESSION[$cid][$commentid]['logo'] != '') {

				$divlogoset=true;
				$outhtml .= '<div style="min-height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px; margin-top: 0px; " >';
			}

			if ($_SESSION[$cid][$commentid]['working'] < 2) {
				$outhtml .= $wrkimg;
			}

			$textdivleft=0;
			if (count($_SESSION[$cid][$commentid]['images']) > 0) {
				$textdivleft=(15+$conf['attachments.']['webpagePreviewHeight']);
				$outhtml .= '<div class="tx-tc-pvs-images"  id="toctoc_comments-pvs-images-' . $cid . '" style="border-right: 1px solid #D4D4D4; float: left; width: ' . $websitepreviewareaimagewidth . 'px; height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px;"><div id="toctoc_comments-pvs-image-box-' . $cid . '"  style="filter: alpha(opacity=100); opacity:1;">';
				$outhtmlpic ='';
				$cntimg=count($_SESSION[$cid][$commentid]['images']);
				if ($cntimg>$conf['attachments.']['webpagePreviewNumberOfImages']){
					$cntimg=$conf['attachments.']['webpagePreviewNumberOfImages'];
				}

				for ($i = 0; $i < $cntimg; $i++) {
					$displaystyle='none';
					if ($i==0) {
						$displaystyle='block';

					}
					$outhtmlpic .= '<img style="display:' . $displaystyle . ';" id="pvsimg' . $cid . 'index' . $i . '"src="' . $_SESSION[$cid][$commentid]['images'][$i]['locallink'] . '" class="tx-tc-pvs-img" />' ;
				}

				$outhtml .=$outhtmlpic;
				$outhtml .='</div></div>';
			}
		}
		$trimeddescription=$_SESSION[$cid][$commentid]['description'];
		$trimedText=$_SESSION[$cid][$commentid]['title'];
		$opendiv=false;
		if ($_SESSION[$cid][$commentid]['title'] != '') {
			if (!array_key_exists('embedUrl',$_SESSION[$cid][$commentid])) {
				$outhtml .= '<div id="toctoc-comments-pvs-formtext-' . $cid . '" style="margin: 0 0 0 ' . $textdivleft . 'px; ">';
				$opendiv=true;
				$picfoundinfo = '<span style="display:none;" id="toctoc-picfoundinfo-' . $cid .'">';
				If ($_SESSION[$cid][$commentid]['totalcounter']>0) {
					if ($_SESSION[$cid][$commentid]['totalcounter'] > $conf['attachments.']['webpagePreviewNumberOfImages']){
						$_SESSION[$cid][$commentid]['totalcounter'] = $conf['attachments.']['webpagePreviewNumberOfImages'];
					}

					If ($_SESSION[$cid][$commentid]['totalcounter']>1) {
						$txtimage =$txtimages;
					}
					$picfoundinfo = '<span style="display:block;" id="toctoc-picfoundinfo-' . $cid .'"> (' . $_SESSION[$cid][$commentid]['totalcounter'] .' ' . $txtimage . ')';
				}
				$picfoundinfo .= '</span>';
			}
			$trimeddescription='';
			$text=$_SESSION[$cid][$commentid]['description'];
			$htmlarr=explode('<br />', $text);
			$text=implode(' ', $htmlarr);
			$text=htmlspecialchars(stripslashes($text));
			if (strlen($text)>$maxDescChars){
				$textcroppedleft = substr($text,0,$maxDescChars);
				$textcroppedright = substr($text,$maxDescChars);
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
				$textcroppedleft = substr($text,0,$maxChars);
				$textcroppedright = substr($text,$maxChars);
				$textcroppedrightarr = explode(' ', $textcroppedright);
				if (count($textcroppedrightarr)>1) {
					$textcroppedleft .=$textcroppedrightarr[0] . ' ...';
					$trimedText =$textcroppedleft;
				}
			} else {
				$trimedText =$text;
			}
			if (array_key_exists('embedUrl',$_SESSION[$cid][$commentid])) {
				$picfoundinfo='';
			}
			$outhtml .= '<div class="tx-tc-pvs-title"><a href="' . $_SESSION[$cid][$commentid]['urlfound'] . '">' . $trimedText . '</a>' . $picfoundinfo  . '</div>' ;
		} elseif ($_SESSION[$cid][$commentid]['urlfound'] != '') {
			$_SESSION[$cid][$commentid]['urlanalyzing'] .=  '.';
		} elseif ($_SESSION[$cid][$commentid]['url'] != '') {
			$_SESSION[$cid][$commentid]['urlanalyzing']='...';
		}

		if (!array_key_exists('embedUrl',$_SESSION[$cid][$commentid])) {
			if (($_SESSION[$cid][$commentid]['needgoogle'] == 1) && ($_SESSION[$cid][$commentid]['working'] != 2)) {

				$outhtml .= '<div class="tx-tc-pvs-statusgoogle">' . $awaitgoogle . $_SESSION[$cid][$commentid]['urlanalyzing'] . '</div>' ;
				$_SESSION[$cid][$commentid]['urlanalyzing'] .=  '.';
			}
		}
		if ($_SESSION[$cid][$commentid]['urltext'] != '') {
			$outhtml .= '<div class="tx-tc-pvs-urltext">' . $_SESSION[$cid][$commentid]['urltext'] . '</div>' ;
		}

		if ($_SESSION[$cid][$commentid]['description'] != '') {
			$outhtml .= '<div class="tx-tc-pvs-desc">' . $trimeddescription . '</div>' ;
		}
		if ($opendiv==true) {
			$outhtml .='</div>';
		}

		if ($_SESSION[$cid][$commentid]['logo'] != '') {
			$divlogoset=true;
		}
		if (!array_key_exists('embedUrl',$_SESSION[$cid][$commentid])) {
			if ($divlogoset) {
				$outhtml .= '</div>' ;
				$outhtml .= '<div class="tx-tc-pvs-logobg"  id="tx-tc-pvs-logobg-' . $cid .'" style="margin-top: -' . (7+$conf['attachments.']['webpagePreviewHeight']) . 'px; " >';
				$outhtml .= '<img src="' . $_SESSION[$cid][$commentid]['logo'] . '" style="max-height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px; max-width:100px; float:right; margin-top: 7px; " />';
				$outhtml .= '</div>' ;
			}
			if ($_SESSION[$cid][$commentid]['title'] != '') {
				$outhtml .='</div>';
			}
		} else {
			if (($_SESSION[$cid][$commentid]['logo'] != '') && ($_SESSION[$cid][$commentid]['embedUrl'] != '')){
				$videohtml = str_replace ('###CID###',$cid , $videohtml);
				$videohtml = str_replace ('###IDPLUS###',$commentid , 	$videohtml);
				$videohtml = str_replace ('###DESC###',$trimeddescription , $videohtml);
				if (trim($trimedText) =='') {
					if ($_SESSION[$cid][$commentid]['titleoutfound']=='') {
						$trimedText=$_SESSION[$cid][$commentid]['urltext'] ;
					} else {
						$trimedText=$_SESSION[$cid][$commentid]['titleoutfound'] ;
					}
				} else {
					if ($_SESSION[$cid][$commentid]['titleoutfound']=='') {
						$_SESSION[$cid][$commentid]['titleoutfound'] = $trimedText;
					}
				}
				$videohtml = str_replace ('###TITLE###',$trimedText , $videohtml);
				$videohtml = str_replace ('###VIDEOSRC###',$_SESSION[$cid][$commentid]['embedUrl'] , $videohtml);
				$videohtml = str_replace ('###VIDEOURL###',$_SESSION[$cid][$commentid]['urlfound'] , $videohtml);

				$outhtml=$videohtml;
				if (array_key_exists('attachmentHTML',$_SESSION[$cid][$commentid])) {
					unset($_SESSION[$cid][$commentid]['embedUrl'] );
					unset($_SESSION[$cid][$commentid]['videosite'] );
					unset($_SESSION[$cid][$commentid]['attachmentHTML']);
				}
			}
		}


		if ($_SESSION[$cid][$commentid]['working'] >= 2) {
			session_write_close();
		}

		echo $outhtml;
		exit();
	}
}
?>

