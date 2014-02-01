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
* Comment management script.
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   58: class toctoc_comments_getpagepreview
 *   62:     function main()
 *
 * TOTAL FUNCTIONS: 1
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

/**
 * Comment management script.
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
		$wrkimg = '<img align="right" id="tx-toctoc-comments-form-sitepreview-working' . trim($_POST['ref']) . '" src="/typo3conf/ext/toctoc_comments/res/img/workingslides.gif" width="16" height="11" />';
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
		$trimeddescription=$_SESSION[$cid][$commentid]['description'];
		$trimedText=$_SESSION[$cid][$commentid]['title'];
		if ($_SESSION[$cid][$commentid]['title'] != '') {
		$outhtml .= '<div id="toctoc-comments-pvs-formtext-' . $cid . '" style="margin: 0 0 0 ' . $textdivleft . 'px; ">';
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
			$outhtml .= '<div class="tx-tc-pvs-title"><a href="' . $_SESSION[$cid][$commentid]['urlfound'] . '">' . $trimedText . '</a>' . $picfoundinfo  . '</div>' ;
		} elseif ($_SESSION[$cid][$commentid]['urlfound'] != '') {
			$_SESSION[$cid][$commentid]['urlanalyzing'] .=  '.';
		} elseif ($_SESSION[$cid][$commentid]['url'] != '') {
			$_SESSION[$cid][$commentid]['urlanalyzing']='...';
		}

		if (($_SESSION[$cid][$commentid]['needgoogle'] == 1) && ($_SESSION[$cid][$commentid]['working'] != 2)) {

			$outhtml .= '<div class="tx-tc-pvs-statusgoogle">' . $awaitgoogle . $_SESSION[$cid][$commentid]['urlanalyzing'] . '</div>' ;
			$_SESSION[$cid][$commentid]['urlanalyzing'] .=  '.';
		}
		if ($_SESSION[$cid][$commentid]['urltext'] != '') {
			$outhtml .= '<div class="tx-tc-pvs-urltext">' . $_SESSION[$cid][$commentid]['urltext'] . '</div>' ;
		}

		if ($_SESSION[$cid][$commentid]['description'] != '') {
			$outhtml .= '<div class="tx-tc-pvs-desc">' . $trimeddescription . '</div>' ;
		}
		if ($_SESSION[$cid][$commentid]['title'] != '') {
			$outhtml .='</div>';
		}

		if ($_SESSION[$cid][$commentid]['logo'] != '') {
			$divlogoset=true;
		}
		if ($divlogoset) {
			$outhtml .= '</div>' ;
			$outhtml .= '<div class="tx-tc-pvs-logobg" style="margin-top: -' . (7+$conf['attachments.']['webpagePreviewHeight']) . 'px; " >';
			$outhtml .= '<img src="' . $_SESSION[$cid][$commentid]['logo'] . '" style="max-height: ' . $conf['attachments.']['webpagePreviewHeight'] . 'px; max-width:100px; float:right; margin-top: 7px; " />';
			$outhtml .= '</div>' ;
		}
		if ($_SESSION[$cid][$commentid]['title'] != '') {
			$outhtml .='</div>';
		}

		if ($_SESSION[$cid][$commentid]['working'] >= 2) {
			session_write_close();
		}

		echo $outhtml;
		exit();
	}
}
?>

