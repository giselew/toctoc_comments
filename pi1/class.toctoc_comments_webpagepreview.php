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
 * class.toctoc_comments_webpagepreview.php
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
 *   71: class toctoc_comments_webpagepreview
 *  112:     public function main($inputurl,$inputcommentid,$inputcid,$lang,$inconf = array(), $pObj = null, $pObjParent=null)
 *  319:     protected function timepoint($startpoint, $datainfo, $showtotal = false)
 *  344:     protected function check_pvs_url($value)
 *  363:     protected function file_pvs_get_contents_curl($urltofetch,$ext, $savepathfilename = '')
 *  514:     public function saveAndResize($filename, $new_width, $new_height, $pathAndFilename, $ext)
 *  824:     public function previewsite ($pObj=null, $pObjParent=null)
 * 1336:     public function pvs_fetch_images($strextraction,&$strouthtml, $iscss, $cssfile='')
 * 1490:     protected function pvs_fetch_css($strextraction,&$strouthtml, $iscss, $cssfile='')
 * 1594:     protected function checklogopattern($strtest)
 * 1620:     protected function checkimagepattern($strtest)
 * 1646:     protected function checkvideocontent($html)
 * 1928:     protected function croptitleordesc($description)
 * 1952:     protected function cleanouttitleordesc($title)
 *
 * TOTAL FUNCTIONS: 13
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */
  if ($_GET['url']) {
	$ml = new toctoc_comments_webpagepreview;
	session_name('sess_' . 'toctoc_comments');
	session_start();

	$ml->main($_GET['url'],0,10033,'de');
}

	/**
	 * Scans Webpages and fills Session variables for display in toctoc_comments
	 *
	 */
class toctoc_comments_webpagepreview {

// work vars
	var $dosavepicsintemp=true;
	var $wrkext='';
	var $savepath='';
	var $urlhomearrstr = '';
	var $urlsitestr = '';
	var $url = '';
	var $idcounter =0;
	var $totalcounter =0;
	var $images_array = array();
	var $css_array = array();
	var $totalpicscans =0;
	var $logofound = false;
	var $logofoundfullhit = false;
	var $logofoundarr = array();
	var $picfoundarr = array();
	var $logoselectedstr = '';
	var $selectedpics = 0;
	var $returnurl = '';
	var $logoselectedlogolink= '';
	var $urlsubpath= '';
	var $extKey = 'toctoc_comments';
	var $commitcounter = 0;

	var $conf = array();
	var $docutf8declared = false;
	var $docutf8 = false;


//placeholder input
	var $commentid = 'p0';
	var $cid = 'p1003';

//debug
	var $totaltime = 0.000001;
	var $starttime = 0.000001;
	var $doprint=false;
	var $outputhtml=false;

	public function main($inputurl,$inputcommentid,$inputcid,$lang,$inconf = array(), $pObj = null, $pObjParent=null) {
		$this->commentid = 'p' . trim($inputcommentid);
		$this->cid = 'p' . trim($inputcid);
		$this->lang = $lang;
		$this->conf = $inconf;

		if ($this->doprint) {
			if (!array_key_exists('attachments.',$inconf)){
				$this->conf['attachments.'] = array();
				$this->conf['attachments.']['webpagePreviewNumberOfImages'] = 10;
				$this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize'] = 1500;
				$this->conf['attachments.']['webpagePreviewScanMinImageSize'] = 40;
				$this->conf['attachments.']['webpagePreviewScanMaxImageSize'] = 450;
				$this->conf['attachments.']['webpagePreviewScanMinLogoSize'] = 30;
				$this->conf['attachments.']['webpagePreviewScanMaxImageScan'] = 40;
				$this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo'] = 55;
				$this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] = 5;
				$this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] = 3;
				$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'] = 70;
				$this->conf['attachments.']['webpagePreviewHeight'] = 70;
				$this->conf['attachments.']['webpagePreviewDescriptionLength'] = 200;
				$this->conf['attachments.']['webpagePreviewScanLogoPatterns'] = 'logo,crght';
				$this->conf['attachments.']['webpagePreviewScanExcludeImagePatterns'] = 'pixeltrans,spacer,youtube,rclogos';
				$this->conf['attachments.']['webpagePreviewCurlTimeout'] = 7000;
				$this->conf['attachments.']['webpagePreviewDescriptionPortionLength'] =40;
				$this->conf['attachments.']['useWebpageVideoPreview'] =1;

			}
		}

		if (intval($this->conf['attachments.']['webpagePreviewNumberOfImages']) ==0) {
			$this->conf['attachments.']['webpagePreviewNumberOfImages'] = 8;
		}
		if ($this->conf['attachments.']['webpagePreviewNumberOfImages'] < 4) {
			$this->conf['attachments.']['webpagePreviewNumberOfImages'] = 4;
		}
		if ($this->conf['attachments.']['webpagePreviewNumberOfImages'] > 25) {
			$this->conf['attachments.']['webpagePreviewNumberOfImages'] = 25;
		}


		if (intval($this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize'] = 1500;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize'] < 300) {
			$this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize'] = 300;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize'] > 6000) {
			$this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize'] = 6000;
		}


		if (intval($this->conf['attachments.']['webpagePreviewScanMinImageSize']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMinImageSize'] = 40;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMinImageSize'] < 30) {
			$this->conf['attachments.']['webpagePreviewScanMinImageSize'] = 30;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMinImageSize'] > 100) {
			$this->conf['attachments.']['webpagePreviewScanMinImageSize'] = 100;
		}

		if (intval($this->conf['attachments.']['webpagePreviewScanMaxImageSize']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageSize'] = 450;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxImageSize'] <  300) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageSize'] = 300;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxImageSize'] >  1280) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageSize'] = 1280;
		}

		if (intval($this->conf['attachments.']['webpagePreviewScanMinLogoSize']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMinLogoSize'] = 30;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMinLogoSize'] < 20) {
			$this->conf['attachments.']['webpagePreviewScanMinLogoSize'] = 20;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMinLogoSize'] > 70) {
			$this->conf['attachments.']['webpagePreviewScanMinLogoSize'] = 70;
		}

		if (intval($this->conf['attachments.']['webpagePreviewScanMaxImageScan']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageScan'] = 40;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxImageScan'] < 20){
			$this->conf['attachments.']['webpagePreviewScanMaxImageScan'] = 20;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxImageScan'] > 100) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageScan'] = 100;
		}


		if (intval($this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo'] = 55;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo'] < 30) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo'] = 30;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo'] > 150) {
			$this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo'] = 150;
		}


		if (intval($this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] = 4;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] < 1) {
			$this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] = 1;
		}
		if ($this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] > 5) {
			$this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] = 5;
		}


		if (intval($this->conf['attachments.']['webpagePreviewScanmaxverticalrelation']) ==0) {
			$this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] = 3;
		}
		if ($this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] < 1) {
			$this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] = 1;
		}
		if ($this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] > 4) {
			$this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] = 4;
		}


		if (intval($this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) ==0) {
			$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'] = 70;
		}
		if ($this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'] < 20) {
			$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'] = 20;
		}
		if ($this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'] > 150) {
			$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'] = 150;
		}


		if (intval($this->conf['attachments.']['webpagePreviewHeight']) ==0) {
			$this->conf['attachments.']['webpagePreviewHeight'] = 70;
		}
		if ($this->conf['attachments.']['webpagePreviewHeight'] < 30) {
			$this->conf['attachments.']['webpagePreviewHeight'] = 30;
		}
		if ($this->conf['attachments.']['webpagePreviewHeight'] > 120) {
			$this->conf['attachments.']['webpagePreviewHeight'] = 120;
		}


		if (intval($this->conf['attachments.']['webpagePreviewDescriptionLength']) ==0) {
			$this->conf['attachments.']['webpagePreviewDescriptionLength'] = 150;
		}
		if ($this->conf['attachments.']['webpagePreviewDescriptionLength'] < 50) {
			$this->conf['attachments.']['webpagePreviewDescriptionLength'] = 50;
		}
		if ($this->conf['attachments.']['webpagePreviewDescriptionLength'] > 500) {
			$this->conf['attachments.']['webpagePreviewDescriptionLength'] = 500;
		}


		if (intval($this->conf['attachments.']['webpagePreviewDescriptionPortionLength']) ==0) {
			$this->conf['attachments.']['webpagePreviewDescriptionPortionLength'] = 40;
		}
		if ($this->conf['attachments.']['webpagePreviewDescriptionPortionLength'] < 10) {
			$this->conf['attachments.']['webpagePreviewDescriptionPortionLength'] = 10;
		}
		if ($this->conf['attachments.']['webpagePreviewDescriptionPortionLength'] > 100) {
			$this->conf['attachments.']['webpagePreviewDescriptionPortionLength'] = 100;
		}

		if (intval($this->conf['attachments.']['webpagePreviewCurlTimeout']) ==0) {
			$this->conf['attachments.']['webpagePreviewCurlTimeout'] = 7000;
		}
		if ($this->conf['attachments.']['webpagePreviewCurlTimeout'] < 3000) {
			$this->conf['attachments.']['webpagePreviewCurlTimeout'] = 3000;
		}
		if ($this->conf['attachments.']['webpagePreviewCurlTimeout'] > 13000) {
			$this->conf['attachments.']['webpagePreviewCurlTimeout'] = 13000;
		}


		$this->url = trim($inputurl);
		$this->url = $this->check_pvs_url($this->url);

		$this->savepath = 'uploads/tx_toctoccomments/';
		$urlhomearr=explode ('/',$this->url);
		$this->urlhomearrstr='';
		for($i = 0; $i < count($urlhomearr); $i++) {
			if (strstr($urlhomearr[$i], 'http')) {
				$this->urlhomearrstr = $urlhomearr[$i] . '//';
			} elseif ($urlhomearr[$i] != '') {
				$this->urlhomearrstr .= $urlhomearr[$i]  . '//';
				$this->urlsitestr = $urlhomearr[$i];
				$i= 10000;
			}
		}
		return $this->previewsite($pObj, $pObjParent);

	}

	/**
	 * debugging function
	 *
	 * @param	[type']		$startpoint: ...
	 * @param	[type']		$datainfo: ...
	 * @param	[type']		$showtotal: ...
	 * @return	[type']		...
	 */
	protected function timepoint($startpoint, $datainfo, $showtotal = false) {
// 		 $value = microtime(TRUE);
// 		if ($startpoint) {
// 			$this->starttime  = microtime(TRUE);

// 		} else {
// 			$valuediff=microtime(TRUE)-$this->starttime;
// 			$this->totaltime  += $valuediff;
// 			if ($this->doprint) {
// 				print ('<br>' . $datainfo . ': ' . $valuediff . '<br>' . $this->starttime);
// 			}
// 		}
// 		if ($showtotal) {
// 			if ($this->doprint) {
// 				print ('<br><br>TOTAL: ' . $this->totaltime . '<br>');
// 			}
// 		}
	}

	/**
	 * Formats URL for subsequent parsing
	 *
	 * @param	string		$value: URL to check
	 * @return	string		checked URL
	 */
	protected function check_pvs_url($value) {
		$value = trim($value);
		if (get_magic_quotes_gpc ()) {
			$value = stripslashes($value);
		}
		$value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		return $value;
	}

	/**
	 * Read content from the web with CURL
	 *
	 * @param	string		$urltofetch: url to fetch
	 * @param	string		$ext: file extension
	 * @param	string		$savepathfilename: path and filename to save
	 * @return	variant		$savepathfilename or false
	 */
	protected function file_pvs_get_contents_curl($urltofetch,$ext, $savepathfilename = '') {
		if (($this->selectedpics < $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ($this->logofound == false)) {
			$this->timepoint(true,'');
			$extorig=$ext;
			$ext= strtolower($ext);
			$urlarr=explode('//',$urltofetch);
			$urlstr='';
			if (strtolower(substr($urlarr[0],0,3)=='htt')) {
				$urlstr=$urlarr[0] . '/';
				$urlarr[0]='';
			}
			$urlstr.=implode('//',$urlarr);
			$urlstr=str_replace('///','//' ,$urlstr);
			$urltofetch=$urlstr;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
			curl_setopt($ch, CURLOPT_URL, $urltofetch);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FAILONERROR,0);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
			curl_setopt($ch, CURLOPT_FILETIME,1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		if (($ext=='html') || ($ext== 'css')) {
				curl_setopt($ch, CURLOPT_TRANSFERTEXT,1);
				curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, intval(($this->conf['attachments.']['webpagePreviewCurlTimeout'])/1000));

		} elseif (($ext=='jpg') || ($ext== 'gif') || ($ext=='png') || ($ext== 'bmp') || ($ext== 'jpeg')) {
				curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
				$curl_errno=0;
			}
			$data = curl_exec($ch);
			$curl_errno = curl_errno($ch);

			if ($curl_errno > 0) {
				$curl_errmsg =  curl_error($ch);
				curl_close($ch);
				if (($ext=='html')) {

					$this->timepoint(false,'file_pvs_get_contents_curl, error reading: ' . $curl_errmsg);
					$_SESSION[$this->cid][$this->commentid]['working'] = 2;
					$_SESSION[$this->cid][$this->commentid]['description'] = 'CURL,' . $curl_errno . ',' .  $curl_errmsg;
					$_SESSION[$this->cid][$this->commentid]['title'] = '';
					$_SESSION[$this->cid][$this->commentid]['urlfound'] = '';
					return false;
					//session_write_close();
					//exit;

				} else {
					return false;
				}
			} else {
				if (($ext=='html')) {
					if (strpos(strtolower($data),'</head>')==0) {
						$urltofetch = str_replace('http:','https:',$urltofetch);
						curl_setopt($ch, CURLOPT_URL, $urltofetch);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						$data = curl_exec($ch);
					}
				}
			}
			$infohttpcode = intval(curl_getinfo($ch, CURLINFO_HTTP_CODE));
			// checking mime types
			if ($infohttpcode< 400)  {
				 $this->returnurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
				if (($ext=='html') || ($ext== 'css')) {
					curl_close($ch);
					$this->timepoint(false,'<b>+ file_pvs_get_contents_curl, text: </b>' . $urltofetch);
					return $data;
				} elseif (($ext=='jpg') || ($ext== 'gif') || ($ext=='png') || ($ext== 'bmp') || ($ext== 'jpeg')) {
					$infofiletype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
					$infofiletime = curl_getinfo($ch, CURLINFO_FILETIME);
					$infofilesize = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
					if ($infofiletype == 'image/gif') {
						$newext= 'gif';

					} elseif  (($infofiletype == 'image/jpeg') || ($infofiletype == 'image/pjpeg')) {
						$newext= 'jpg';

					} elseif ($infofiletype == 'image/png') {
						$newext= 'png';

					} elseif (($infofiletype == 'image/bmp') || ($infofiletype == 'image/x-windows-bmp')){
						$newext= 'bmp';

					} else {
						$newheader = '';
						if ($ext=='jpg') {
							$newheader = 'Content-Type: image/jpeg';
						} elseif ($ext=='png') {
							$newheader = 'Content-Type: image/png';
						}  elseif ($ext=='gif') {
							$newheader = 'Content-Type: image/gif';
						} elseif ($ext=='bmp') {
							$newheader = 'Content-Type: image/bmp';
						}
						$data = $data;
						$newext= $ext;
					}
					curl_close($ch);
					$savepathfilename=str_replace ('.'.$extorig,'.'.$newext,$savepathfilename);
					$this->wrkext=$newext;
					if (intval($infofilesize) > $this->conf['attachments.']['webpagePreviewScanMinimalImageFileSize']) {
						if(file_exists($savepathfilename)){
							unlink($savepathfilename);
						}

						file_put_contents($savepathfilename,$data);
						$this->timepoint(false,'<b>+ file_pvs_get_contents_curl, pic:</b> ' . $urltofetch);
						return $savepathfilename;
					} else {
						$this->timepoint(false,'- file_pvs_get_contents_curl, filesize failed: ' . $urltofetch . ' (' . intval($infofilesize) . ')');
						return false;
					}

				} else {
					$this->timepoint(false,'- file_pvs_get_contents_curl, false: ' . $urltofetch);
					curl_close($ch);
					return false;
				}
			} else {
				if (($ext=='html')) {
					$_SESSION[$this->cid][$this->commentid]['working'] = 2;
					$_SESSION[$this->cid][$this->commentid]['description'] = 'CURL,' . $infohttpcode . ',' .  $curl_errmsg;
					$_SESSION[$this->cid][$this->commentid]['title'] = '';
					$_SESSION[$this->cid][$this->commentid]['urlfound'] = '';
					session_write_close();
					exit;
				}
				$this->timepoint(false,'<b>- file_pvs_get_contents_curl, 4xx-999: </b>' . $urltofetch . ' (returned HTML-Code:) ' . $infohttpcode);
				return false;
			}
		} else {
			$this->timepoint(false,'file_pvs_get_contents_curl, false: ' . $urltofetch);

			return false;
		}
	}

	/**
	 * saves and resizes a picture
	 *
	 * @param	string		$filename: filename of image to fetch by curl
	 * @param	int		$new_width:  new image width
	 * @param	int		$new_height: new image height
	 * @param	string		$pathAndFilename: path and filename for save
	 * @param	string		$ext: file extension
	 * @return	variant		$savepathfilename or false..
	 */
	public function saveAndResize($filename, $new_width, $new_height, $pathAndFilename, $ext){
		if (($this->selectedpics < $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ($this->logofound == false)) {

			$this->timepoint(true,'');
			$path_parts = pathinfo($pathAndFilename);
			$dirsep=DIRECTORY_SEPARATOR;
			$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
			$dirsep=str_replace($repstr,'',dirname(__FILE__));

			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirname= str_replace('/','\\',$dirsep .$path_parts['dirname']);
			} else {
				$txdirname=$dirsep .$path_parts['dirname'];
			}

			$idstr=session_id();
			if ($idstr==false) {
				$idstr = microtime(true);
			}
			$idstr = $idstr . 'Gcid' . $this->cid . 'Wcid' . $this->commentid . 'Gpix' . ($this->selectedpics + 1)  . 'Wend'  ;
			$txdirnamebasename= str_replace(' ','',$path_parts['basename']);
			$txdirname=$txdirname. DIRECTORY_SEPARATOR .$idstr . $txdirnamebasename;

			$savepathfilename = $this->file_pvs_get_contents_curl($filename,$ext,$txdirname);

			if (!$savepathfilename) {
				return false;
			}
			$ext=$this->wrkext;

			$savepathlink='';
			$path_part_spf = pathinfo($savepathfilename);
			if (DIRECTORY_SEPARATOR == '\\') {
				// windows
				$txdirnamespf= str_replace('\\','/',$path_part_spf['basename']);
			} else {
				$txdirnamespf=$path_part_spf['basename'];
			}
			$txdirnamespf= str_replace(' ','',$path_part_spf['basename']);
			$savepathlink= '/' . $this->savepath . 'temp/' .  $txdirnamespf;


			$txdirnamespflogo=str_replace('.'. $ext,'_logo.'. $ext,$txdirnamespf);
			$savepathlogolink= '/' . $this->savepath . 'temp/' .  $txdirnamespflogo;

			$path_partsf = pathinfo($filename);
			if ($this->selectedpics >= $this->conf['attachments.']['webpagePreviewNumberOfImages']) {
				if ((strpos($path_partsf['basename'],'logo')!== false) || (substr($path_partsf['basename'],0,4)=='logo')) {

				} else {
					return false;
				}
			}

			list($width, $height, $typeimg, $attr) = getimagesize($savepathfilename);
			if ($width==0){
				return false;
			}

			if (isset($typeimg) && in_array($typeimg, array(
					IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_WBMP))) {
				if ($typeimg==3) {
					$ext='png';
				} elseif ($typeimg==2) {
					$ext='jpg';
				}elseif ($typeimg==1) {
					$ext='gif';
				}elseif ($typeimg==4) {
					$ext='bmp';
				}else  {
					return false;
				}
			} else  {
				return false;
			}

			if ((strtoupper($ext) =='JPG') || (strtoupper($ext) =='JPEG')) {
				$image = imagecreatefromjpeg($savepathfilename);
			} elseif (strtoupper($ext) =='GIF') {
				$image = imagecreatefromgif($savepathfilename);
			} elseif (strtoupper($ext) =='PNG') {
				$image = imagecreatefrompng($savepathfilename);
			} elseif (strtoupper($ext) =='BMP') {
				$image = imagecreatefromwbmp ($savepathfilename);
			}else {
				return false;
			}
			if ($image) {

				if ($width==0){
					return false;
				}

				if ($width>$height){
					$new_width=$this->conf['attachments.']['webpagePreviewHeight'];
					$new_height=intval($height*($new_width/$width));
				} else {
					$new_height=$this->conf['attachments.']['webpagePreviewHeight'];
					$new_width=intval($width*($new_height/$height));
				}

				if (($width < $this->conf['attachments.']['webpagePreviewScanMinImageSize']) || ($height < $this->conf['attachments.']['webpagePreviewScanMinImageSize'])) {


					$path_partsfbasename=explode(' ',$path_partsf['basename']);
					$hit=$this->checklogopattern($path_partsfbasename[0]);
					if ($hit>0) {
						if ((intval($width/$height) > $this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] ) || (intval($height/$width) > $this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] )) {
								return false;
						} else {
							if ((($width >= $this->conf['attachments.']['webpagePreviewScanMinLogoSize']) || ($height >= $this->conf['attachments.']['webpagePreviewScanMinLogoSize'])) &&
							(($width < $this->conf['attachments.']['webpagePreviewScanMaxImageSize']) && ($height < $this->conf['attachments.']['webpagePreviewScanMaxImageSize']))) {

									$this->logofound = true;
									if ($hit>1) {
										$this->logofullhit = true;
										$this->logoselectedstr = $filename;
										$this->logoselectedlogolink = $savepathlogolink;
									}
									$arrposi=count($this->logofoundarr);
									$this->logofoundarr[$arrposi]['filename'] = $filename;
									$this->logofoundarr[$arrposi]['logolink'] = $savepathlogolink;
							} else {
								if (($this->selectedpics > $this->conf['attachments.']['webpagePreviewNumberOfImages'])) {
									return false;
								}
							}
						}
					} else {
						return false;

					}
				} else {
					if (($width < $this->conf['attachments.']['webpagePreviewScanMaxImageSize']) && ($height < $this->conf['attachments.']['webpagePreviewScanMaxImageSize'])) {
						if (($this->selectedpics < $this->conf['attachments.']['webpagePreviewNumberOfImages'])||($this->logofound==false)) {
							if ((intval($width/$height) > $this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] ) || (intval($height/$width) > $this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] )) {

									return false;


							} else {
								$path_partsfbasename=explode(' ',$path_partsf['basename']);
								$hit=$this->checklogopattern($path_partsfbasename[0]);
								if ($hit>0) {
									if ((($width >= $this->conf['attachments.']['webpagePreviewScanMinLogoSize']) || ($height >= $this->conf['attachments.']['webpagePreviewScanMinLogoSize'])) &&
											(($width < $this->conf['attachments.']['webpagePreviewScanMaxImageSize']) && ($height < $this->conf['attachments.']['webpagePreviewScanMaxImageSize']))) {

										if ($hit==2) {
											$this->logofound = true;
											$this->logofullhit = true;
											$this->logoselectedstr = $filename;
											$this->logoselectedlogolink = $savepathlogolink;

										}
										$arrposi=count($this->logofoundarr);
										$this->logofoundarr[$arrposi]['filename'] = $filename;
										$this->logofoundarr[$arrposi]['logolink'] = $savepathlogolink;

									}
								} else {
									if (($this->selectedpics > $this->conf['attachments.']['webpagePreviewNumberOfImages'])) {
										return false;
									}
								}
							}
						} else {
							if (($this->selectedpics > $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ((intval($width/$height) > $this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] ) || (intval($height/$width) > $this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] ))) {
								return false;
							}
						}
					} else{
						if (($this->selectedpics > $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ((intval($width/$height) > $this->conf['attachments.']['webpagePreviewScanMaxHorzizontalRelation'] ) || (intval($height/$width) > $this->conf['attachments.']['webpagePreviewScanmaxverticalrelation'] ))) {
							return false;
						}
					}

				}
				$this->picfoundarr[count($this->picfoundarr)]['filename'] = $filename;

				// Logo won't be resized'
				$arrnew_width=array();
				$arrnew_height=array();

				$arrnew_width[0]=$new_width;
				$arrnew_height[0]=$new_height;
				if (count($this->logofoundarr)>0) {
					if ($this->logofoundarr[count($this->logofoundarr)-1]['filename'] == $filename) {
						$arrnew_width[1]=$width;
						$arrnew_height[1]=$height;
					} else {
						$arrnew_width[1]=0;
						$arrnew_height[1]=0;

					}
				} else {
					$arrnew_width[1]=0;
					$arrnew_height[1]=0;

				}

				$this->picfoundarr[count($this->picfoundarr)-1]['width'] = $new_width;
				$this->picfoundarr[count($this->picfoundarr)-1]['height'] = $new_height;
				$this->picfoundarr[count($this->picfoundarr)-1]['filesize'] = filesize($savepathfilename);
				$this->picfoundarr[count($this->picfoundarr)-1]['localpathfilename'] = $savepathfilename;
				$this->picfoundarr[count($this->picfoundarr)-1]['locallink'] =$savepathlink;
				$_SESSION[$this->cid][$this->commentid]['images'][count($this->picfoundarr)-1]['locallink'] = $this->picfoundarr[count($this->picfoundarr)-1]['locallink'];
				$_SESSION[$this->cid][$this->commentid]['images'][count($this->picfoundarr)-1]['localpathfilename'] = $this->picfoundarr[count($this->picfoundarr)-1]['localpathfilename'];
				$_SESSION[$this->cid][$this->commentid]['totalcounter'] = $this->selectedpics+1;

				if (intval(3*(($this->selectedpics+1)/$this->conf['attachments.']['webpagePreviewNumberOfImages'])) != $this->commitcounter){
					session_write_close();
					session_start();
					$this->commitcounter+= 1;
				}
				$this->selectedpics += 1;

				if ($this->dosavepicsintemp) {
					for($i = 0; ($i < 2); $i++) {
						if ($arrnew_width[$i]!=0) {
							$new_width=$arrnew_width[$i];
							$new_height=$arrnew_height[$i];
							if ($i==1) {
								$savepathfilename = str_replace('.'. $ext,'_logo.'. $ext,$savepathfilename);

								$this->logoselectedstr=$savepathfilename;
								$this->logofoundarr[0]['filename']=$savepathfilename;
							}
							$image_p = imagecreatetruecolor($new_width, $new_height);

							// handle transparancy
							if ((strtoupper($ext) =='GIF') || (strtoupper($ext) =='PNG')) {
								$trnprt_indx = imagecolortransparent($image);
								// If we have a specific transparent color
								if (($trnprt_indx >= 0) &&($trnprt_indx < 254)) {
									// Get the original image's transparent color's RGB values
									$nmbr_color  = imagecolorstotal($image);
									//if($trnprt_indx>=$nmbr_color) {
										$trnprt_color  = imagecolorsforindex($image, $trnprt_indx);
									//}
									// Allocate the same color in the new image resource
									if ($trnprt_color) {
										$trnprt_indx    = imagecolorallocate($image_p, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

										// Completely fill the background of the new image with allocated color.
										imagefill($image_p, 0, 0, $trnprt_indx);

										// Set the background color for new image to transparent
										imagecolortransparent($image_p, $trnprt_indx);
									}
								} elseif (strtoupper($ext) =='PNG') {

									// Turn off transparency blending (temporarily)
									imagealphablending($image_p, false);

									// Create a new transparent color for image
									$tspcolor = imagecolorallocatealpha($image_p, 0, 0, 0, 127);

									// Completely fill the background of the new image with allocated color.
									imagefill($image_p, 0, 0, $tspcolor);

									// Restore transparency blending
									imagesavealpha($image_p, true);
								}
							}

							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							switch(strtolower($ext)) {
								case "gif":
									imagegif($image_p, $savepathfilename);
									break;
								case "png":
									imagepng($image_p, $savepathfilename,0);
									break;
								case "bmp":
									imagewbmp($image_p, $savepathfilename);
									break;
								case "jpg":
									imagejpeg($image_p,$savepathfilename,100);
									break;
								case "jpeg":
									imagejpeg($image_p,$savepathfilename,100);
									break;
								default:
									return false;

							}
							imagedestroy($image_p);
						}
					}

				}
				$this->timepoint(false,$this->selectedpics . '. saveAndResize: ' . $savepathfilename);
				return $savepathfilename;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	/**
	 * main function for webpage previews
	 *
	 * @param	object		$pObj: toctoc_comment_lib
	 * @param	object		$pObjParent: Parent of toctoc_comment_lib
	 * @return	void
	 */
	public function previewsite ($pObj=null, $pObjParent=null) {

		$strouthtml='';
		$starttime=microtime(true);
		$_SESSION[$this->cid][$this->commentid]['url'] = $this->url;

		$html = $this->file_pvs_get_contents_curl($this->url, 'html');
		if (($html) && ($this->returnurl !='')) {
			//checking for basedir...
			$basedir = '';
			$basedirarr = explode ('<base href="', $html);
			if (count($basedirarr)>1) {
				$basedirarr2 = explode('"', $basedirarr[1]);
				$basedir=$basedirarr2[0];
			}
			$newhost = parse_url($this->returnurl);
			$oldhost= parse_url($this->url);
			$newhoststr =$newhost['scheme'] . '://' . $newhost['host'] . '/';
			$newpathstr='';

			if (array_key_exists('path',$newhost)) {
				$newpathstr=$newhost['path'];
			}
			$oldpathstr='';
			if (array_key_exists('path',$oldhost)) {
				$oldpathstr =$oldhost['path'];
			}

			// subpath for css start

			// when a redirect bring out a new subdirectory, then this new subdirectory
			// must be used to fetsch css-files
			$this->urlsubpath = '';
			if ($oldpathstr == $this->url) {
				if (array_key_exists('scheme',$oldhost)) {
					$oldhoststr =$oldhost['scheme'] . '://' . $oldpathstr;
					if (array_key_exists('host',$oldhost)) {
						$oldpathstr = str_replace($oldhost['host'] ,'',$oldpathstr);
					}else {
						$oldpathstr = str_replace($newhost['host'] ,'',$oldpathstr);
					}
				} else {
					$oldhoststr =$newhost['scheme'] . '://' . $oldpathstr;
					$oldpathstr = str_replace($newhost['host'] ,'',$oldpathstr);
				}

			} else {
				if (array_key_exists('scheme',$oldhost)) {
					$oldhoststr =$oldhost['scheme'] . '://' . $oldhost['host'] . '/';
					$oldpathstr = str_replace($oldhost['host'] ,'',$oldpathstr);
				}
				else {
					if (array_key_exists('host',$oldhost)) {
						$oldhoststr =$newhost['scheme'] . '://' . $oldhost['host'] . '/';
						$oldpathstr = str_replace($oldhost['host'] ,'',$oldpathstr);
					}
					else {

						$oldhoststr =$newhost['scheme'] . '://' . $newhost['host'] . '/';
						$oldpathstr = str_replace($newhost['host'] ,'',$oldpathstr);
					}
				}
			}
			if ($oldpathstr != '') {
				if (substr($oldpathstr,0,1) == '/') {
					$oldpathstr= trim(substr($oldpathstr,1,1024));
				}
			}
			if ($newpathstr != '') {
				if (substr($newpathstr,0,1) == '/') {
					$newpathstr= trim(substr($newpathstr,1,1024));
				}
				$arrnewpath= explode ('/',$newpathstr);
				if (count($arrnewpath)>0){
					$i=count($arrnewpath)-1;
					if ($arrnewpath[$i] == ''){
					// it end with "/" which is fine
					} else {
						//last elem is file so set it to ''
						$arrnewpath[$i] = '';
					}
					$newpathstr='';
					for($i = 0; $i < count($arrnewpath); $i++) {
						if ($arrnewpath[$i] != '') {
							$newpathstr .=$arrnewpath[$i] . '/';
						}
					}
				}
			}
			$this->urlsubpath =$newpathstr;
			// subpath for css end

			if ($this->urlhomearrstr != $newhoststr) {
				$this->urlhomearrstr = $newhoststr;
				$this->urlsitestr = $newhoststr;
			}

			$this->url=$this->returnurl;


		}
		if ($basedir!='') {
			$this->urlsubpath='';
		}
		if ($html) {

			$this->docutf8=true;
			if (mb_detect_encoding($html, 'UTF-8', true) === FALSE) {
				$this->docutf8=false;
			}
			$this->docutf8declared=false;
			if (strpos(strtoupper($html), 'CHARSET=UTF-8') >0 ) {
				$this->docutf8declared=true;
			}
			$htmlarr=explode('<br>', $html);
			$html=implode(' ', $htmlarr);
			$htmlarr=explode('<br />', $html);
			$html=implode(' ', $htmlarr);
			$htmlarr=explode('<br/>', $html);
			$html=implode(' ', $htmlarr);
			$htmlarr=explode('<script', $html);
			$htmlwk=$htmlarr[0];
			if (count($htmlarr)>0) {
				for ($i=1;$i<count($htmlarr);$i++) {
					$posendscript=strpos(strtoupper($htmlarr[$i]),'</SCRIPT>') +9;
					$htmlwk.=substr($htmlarr[$i],$posendscript);
				}
			}
			$html=$htmlwk;
			$htmlsaveforcssinspection=$htmlwk;
			$htmlarr=explode('<style', $html);
			$htmlwk=$htmlarr[0];
			if (count($htmlarr)>0) {
				for ($i=1;$i<count($htmlarr);$i++) {
					$posendscript=strpos(strtoupper($htmlarr[$i]),'</STYLE>') +8;
					$htmlwk.=substr($htmlarr[$i],$posendscript);
				}
			}
			$html=$htmlwk;
			if (!$_GET['url']) {
			$strouthtml='<html xml:lang="' . $pObj->pi_getLLWrap($pObjParent, 'pi1_template.xmllang', true) . '" xmlns="http://www.w3.org/1999/xhtml"><head>';
			} else {
				$strouthtml='<html xml:lang="EN-en" xmlns="http://www.w3.org/1999/xhtml"><head>';

			}
			//$strouthtml='<html xml:lang="DE-de" xmlns="http://www.w3.org/1999/xhtml"><head>';
			$this->timepoint(true,'');
			// parsing begins here:
			$doc = new DOMDocument();
			@$doc->loadHTML($html);

			// get and display what you need:
			$title ='';

			$nodes = $doc->getElementsByTagName('title');
			if (count($nodes->item(0))>0) {
				$title = $nodes->item(0)->nodeValue;

			}
			$metas = $doc->getElementsByTagName('meta');
			$description='';
			for($i = 0; $i < $metas->length; $i++) {
				$meta = $metas->item($i);
				if (strtoupper($meta->getAttribute('name')) == 'DC.DESCRIPTION') {
					$description = $meta->getAttribute('content');
					if ((strpos($description,'¼') > 0) || (strpos($description,'Ã') > 0)) {
						$description=utf8_decode($description);
					}
				}
			}
			if (strlen($description)<$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) {

				for($i = 0; $i < $metas->length; $i++) {
					$meta = $metas->item($i);
					if (strtoupper($meta->getAttribute('name')) == 'DESCRIPTION') {
						if (strlen($meta->getAttribute('content'))>$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) {
							$description = $meta->getAttribute('content');
							if ((strpos($description,'¼') > 0) || (strpos($description,'Ã') > 0)) {
								$description=utf8_decode($description);
							}
						}
					}
				}
			}

			if (strlen($description)<$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) {
				if ($description !='') {
					$description .='&nbsp;';
				}
				$ptags = $doc->getElementsByTagName('p');
				foreach ($ptags as $ptag) {

					$descwork = $ptag->nodeValue;

					$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
							'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
							'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
							'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
									);
					$descwork = preg_replace($search, '', $descwork);
					if ((strpos($descwork,'¼') > 0) || (strpos($descwork,'Ã') > 0)) {
						$descwork=utf8_decode($descwork);
					}

					if (strlen($descwork)>$this->conf['attachments.']['webpagePreviewDescriptionPortionLength']) {
						$description.= $descwork . ' ' ;
					}
				}
			}

			if (strlen($description)<$this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']){
				$spantags = $doc->getElementsByTagName('span');
				foreach ($spantags as $spantag) {

					if (strlen($spantag->nodeValue)>$this->conf['attachments.']['webpagePreviewDescriptionPortionLength']) {
						$descwork = $spantag->nodeValue;

						$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
								'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
								'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
								'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
								);
						$descwork = preg_replace($search, '', $descwork);
						if ((strpos($descwork,'¼') > 0) || (strpos($descwork,'Ã') > 0)) {
							$descwork=utf8_decode($descwork);
						}
						if (strlen($descwork)>$this->conf['attachments.']['webpagePreviewDescriptionPortionLength']) {
							$description.= $descwork . ' ';
						}
					}
				}
			}

			if ($description!=''){
				if (!$this->docutf8declared) {
					if ($this->docutf8) {
						$description = utf8_decode($description);
					}
					if (mb_detect_encoding($description, 'UTF-8', true) === FALSE) {
						$description = utf8_encode($description);
					}
				} else {
					if (mb_detect_encoding($description, 'UTF-8', true) === FALSE) {
						$description = utf8_encode($description);
					}
				}
			}
			if ($title!=''){
				if (!$this->docutf8declared) {
					if ($this->docutf8) {
						$title = utf8_decode($title);
					}
					if (mb_detect_encoding($title, 'UTF-8', true) === FALSE) {
						$title = utf8_encode($title);
					}
				} else {
					if (mb_detect_encoding($title, 'UTF-8', true) === FALSE) {
						$title = utf8_encode($title);
					}
				}
			}


			if (strlen($description)>= $this->conf['attachments.']['webpagePreviewDescriptionMinimalLength'])  {
				$descriptionarr = explode(' ',$description);
				$descriptionlen =0;
				$descriptionout ='';
				$descriptionret='';
			for($i = 0; $i < count($descriptionarr); $i++) {
					$descriptionlen += strlen($descriptionarr[$i])+1;
					$descriptionout .= $descriptionarr[$i] . ' ';
					if ($descriptionlen>=$this->conf['attachments.']['webpagePreviewDescriptionLength']) {
						$descriptionret=$descriptionout . ' ...';
						break;
					}
					$descriptionret=$descriptionout;
				}
				$_SESSION[$this->cid][$this->commentid]['description'] = $descriptionret;
			}
			if  ($title !='')  {
				$_SESSION[$this->cid][$this->commentid]['title'] = $title;
			}
			session_write_close();
			session_start();
			// check for ideo content
			$checkvideocontent=false;
			if ($this->conf['attachments.']['useWebpageVideoPreview'] == 1) {
				if ($this->checkvideocontent($html) == 'found') {
					$checkvideocontent=true;
					$description=$_SESSION[$this->cid][$this->commentid]['description'];
					if (strlen ($description) > $this->conf['attachments.']['webpagePreviewDescriptionLength']) {
						$descriptionarr = explode(' ',$description);
						$descriptionlen =0;
						$descriptionout ='';
						for($i = 0; $i < count($descriptionarr); $i++) {
							$descriptionlen += strlen($descriptionarr[$i])+1;
							$descriptionout .= $descriptionarr[$i] . ' ';
							if ($descriptionlen>=$this->conf['attachments.']['webpagePreviewDescriptionLength']) {
								$description=$descriptionout . ' ...';
								break;
							}
							$description=$descriptionout;
						}
					}

					$strouthtml.= '<br>Description: ' .  $description;
					$_SESSION[$this->cid][$this->commentid]['description'] = $description;

				}
			}

			if ($checkvideocontent==false) {
				$this->images_array=$this->pvs_fetch_images ($html,$strouthtml, false);
				$strouthtml.='<meta http-equiv="Content-Type" content="'; //text/html; charset=utf-8" /></head><body>';

				$css_array_fromcss=array();
				$this->css_array =$this->pvs_fetch_css ($htmlsaveforcssinspection,$strouthtml, false);


				if ($this->doprint) {
					print ('<br>logofoundarr<br>');
					print_r ($this->logofoundarr);
					print ('<br>');
					print ('picfoundarr<br>');
					print_r ($this->picfoundarr);
					print ('<br>');
				}

				$this->timepoint(false,'no Google: ' . $title);
				if ((strlen($description)< $this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) || ($title =='')){
					// if title or description is still missing now, we call googleli
					$_SESSION[$this->cid][$this->commentid]['needgoogle'] = 1;
				}
				session_write_close();
				session_start();



				if ((strlen($description)< $this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) || ($title =='')){
					// if title or description is still missing now, call googleli is here
					require_once('class.toctoc_comments_seostats.php');
					$garr=array();

					try
					{
						$url = new SEOstats($this->url);
						$garr=$url->Googletoctoccomments($this->lang);
						$garrGoogle_Siteindex_Array=$garr['DATA']['GOOGLE']['Google_Siteindex_Array'];
						if (count($garrGoogle_Siteindex_Array) == 0) {
							$garrGoogle_Siteindex_Array=$garr['DATA']['GOOGLE']['Google_Mentions_Array'];
						}
						if (count($garrGoogle_Siteindex_Array)>0) {
							if ((strlen($description)< $this->conf['attachments.']['webpagePreviewDescriptionMinimalLength']) && (strlen($garrGoogle_Siteindex_Array[0]['descr'])-10 > strlen($description))) {
								$description =$garrGoogle_Siteindex_Array[0]['descr'] ;
								$dotdotdotpos =strpos($description, '...',30);
								$description =substr($description, 0, $dotdotdotpos);
								$description = trim($description) . '...';

								$sitepurearr= explode('//',$garrGoogle_Siteindex_Array[0]['url']);
								$sitepure=$sitepurearr[1];
								$sitepurearr2=explode('/',$sitepure);
								$sitepure=$sitepurearr2[0];

								$description = str_replace($sitepure . '/','',$description);
								if ($description=='...') {
									//$description = "No description available";
									$description= $pObj->pi_getLLWrap($pObjParent, 'pi1_template.nodecription', true) ;
								}

								if (mb_detect_encoding($description, 'UTF-8', true) === FALSE) {
									$description = utf8_encode($description);
								}
								$description = '' .str_replace($sitepure,'',$description) . ' (c) Google';
							}

							if ($title=='') {
								$title= '' . $garrGoogle_Siteindex_Array[0]['title'];
								if (mb_detect_encoding($title, 'UTF-8', true) === FALSE) {
									$title = utf8_encode($title);
								}

								if ($title=='') {
									//$title = "Title not available";
									$title = $pObj->pi_getLLWrap($pObjParent, 'pi1_template.notitle', true) ;
								}
							}
						}
					}
					catch (SEOstatsException $e)
					{
						$title = $pObj->pi_getLLWrap($pObjParent, 'pi1_template.notitle', true) ;
						$description= $pObj->pi_getLLWrap($pObjParent, 'pi1_template.nodecription', true) ;
					}
					session_write_close();
					session_start();
				}


				$strouthtml.='<div class="images">';
				for($i = 0; $i < count($this->picfoundarr); $i++) {
					if ($i < $this->conf['attachments.']['webpagePreviewNumberOfImages']) {
						$strouthtml.= '<img src="' . $this->picfoundarr[$i]['locallink']  . '" id="picid' . $i . '" >';

					}
				}
				$strouthtml.= '</div>';
				$strouthtml.= '<div class="info">';
				$strouthtml.= '<input type="hidden" name="total_images" id="total_images" value="'. $this->totalcounter .'" />';

				$strouthtml.= '<label class="title">';
				$strouthtml.= '<br>Title: ' . $title;
				$_SESSION[$this->cid][$this->commentid]['title'] = $title;

				$strouthtml.= '</label><br clear="all" />';
				$strouthtml.= '<label class="url">';


				$fullurlarr = parse_url($this->url);
				$strpathout='';
				if (isset($fullurlarr['path'])) {
					if (strlen ($fullurlarr['path']) >30) {
					$strpathout=trim(substr($fullurlarr['path'],0,30)) . ' ...';

					} else{
						$strpathout=trim($fullurlarr['path']);
					}

				}
				$strouthtml.=  '<br>URL: <a href="' . $this->url .'">' . trim($fullurlarr['host']) . $strpathout . '</a>';

				$_SESSION[$this->cid][$this->commentid]['urlfound'] = $this->url;
				$_SESSION[$this->cid][$this->commentid]['urltext'] = trim($fullurlarr['host']) . $strpathout;

				$strouthtml.= '</label><br clear="all" />';
				$strouthtml.= '<br clear="all" /><label class="desc">';
				if (strlen ($description) > $this->conf['attachments.']['webpagePreviewDescriptionLength']) {
					$descriptionarr = explode(' ',$description);
					$descriptionlen =0;
					$descriptionout ='';
					for($i = 0; $i < count($descriptionarr); $i++) {
							$descriptionlen += strlen($descriptionarr[$i])+1;
							$descriptionout .= $descriptionarr[$i] . ' ';
							if ($descriptionlen>=$this->conf['attachments.']['webpagePreviewDescriptionLength']) {
								$description=$descriptionout . ' ...';
								break;
							}
							$description=$descriptionout;
						}
				}

				$strouthtml.= '<br>Description: ' .  $description;
				$_SESSION[$this->cid][$this->commentid]['description'] = $description;

				$strouthtml.= '</label><br clear="all" />';
				$strouthtml.= '<br clear="all" /><label class="totalimg">';
				if ($this->totalcounter>$this->conf['attachments.']['webpagePreviewNumberOfImages']) {
					$this->totalcounter=$this->conf['attachments.']['webpagePreviewNumberOfImages'];
				}
				$_SESSION[$this->cid][$this->commentid]['totalcounter'] = $this->totalcounter;

				$strouthtml.= 'Total ' . $this->totalcounter  .' images';
				$strouthtml.= '</label><br clear="all" />';
				if ($this->logoselectedlogolink == '') {
					if ((count($this->logofoundarr)>0) && ($this->logofoundarr[0]['logolink']!='')) {
						$this->logoselectedlogolink=$this->logofoundarr[0]['logolink'];
						$this->logoselectedstr=$this->logofoundarr[0]['filename'];
					}
					if ($this->logoselectedlogolink != '') {
						$strouthtml.= '<br clear="all" /><label class="logopic">';
						$strouthtml.= 'Logo: <img src="' . $this->logoselectedlogolink  . '" style="max-width: 300px; max-height: 300px;" id="picid' . $i . '" >';

						$strouthtml.= '</label><br clear="all" />';
					}
				}
				$_SESSION[$this->cid][$this->commentid]['logo'] = $this->logoselectedlogolink;
				$_SESSION[$this->cid][$this->commentid]['logofile'] = $this->logoselectedstr;
				$strouthtml.= '<br>Logo: ' . $_SESSION[$this->cid][$this->commentid]['logo'] .'<br>';



				$strouthtml.= '<br clear="all" /><label class="scaninfo">';
				$strouthtml.= 'total scanned images: ' . $this->totalpicscans  . '<br>';
				$strouthtml.= '</label><br clear="all" />';
				$strouthtml.= '</div>';
			}
		} else {
			$strouthtml= 'Please enter a valid url';
		}
		$difftime = microtime(true) - $starttime;
		$_SESSION[$this->cid][$this->commentid]['working'] = 2;
		$_SESSION[$this->cid][$this->commentid]['exectime'] = intval(1000*$difftime);

		session_write_close();

		if ($this->outputhtml) {
			print $strouthtml . '<br><br>executiontime: ' . intval(1000*$difftime) .' ms<br>';
			print_r($_SESSION[$this->cid][$this->commentid]);
			print_r($this->logofoundarr);
			print '<br></body></html>';

		}
	}

	/**
	 * extractzs images rom css or html files
	 *
	 * @param	string		$strextraction: string with pics to extract
	 * @param	string		$strouthtml: debugging string
	 * @param	boolean		$iscss: parsing goes thru a css-file
	 * @param	string		$cssfile: filename of css, if any
	 * @return	array		$images_arrayout: array with image-filenames
	 */
	public function pvs_fetch_images($strextraction,&$strouthtml, $iscss, $cssfile=''){
		// fetch images
		$this->idcounter +=1;
		$img=array();
		if ($iscss==true) {
			$img[1]=array();
			$strextractionarr= explode('url(',$strextraction);
			$j=0;
			if (count($strextractionarr) > 0) {
				for($i = 1; $i < count($strextractionarr); $i++) {
					$strextractionarr2= explode(')',$strextractionarr[$i]);
					$strextractionarrcand=$strextractionarr2[0];
					$strextractionarrcand=str_replace('"','',$strextractionarrcand);
					$strextractionarrcand=str_replace("'",'',$strextractionarrcand);
					if (!strstr($strextractionarrcand,'.css'))	{
						$img[1][$j]=$strextractionarrcand;
						$j++;
					}
				}
			}

			$cssfilebits=explode('/',$cssfile);
			$cssfilebits[count($cssfilebits)-1] = '';
			$cssfilepath=implode('/',$cssfilebits);
			$cssfilerelpatharr=explode ('/',$cssfilepath);
			$cssfilerelpatharr[0]='';
			$cssfilerelpath='';
			for($i = 0; $i < sizeof($cssfilerelpatharr); $i++) {
				if (($cssfilerelpatharr[$i] !='') && ($cssfilerelpatharr[$i] !=$this->urlsitestr)) {
					$cssfilerelpath.=$cssfilerelpatharr[$i].'/';
				}
			}
		} else {
			$image_regex = '/<img[^>]*' . 'src=[\"|\'](.*)[\"|\']/Ui';
			$cssfilepath='';
			preg_match_all($image_regex, $strextraction, $img, PREG_PATTERN_ORDER);
		}

		// handling of redirected subdirs
		if ($this->urlsubpath!=''){
			if (strpos($cssfilepath,$this->urlsubpath)===false) {
				$cssfilepath=$cssfilepath . $this->urlsubpath;
			}
		}
		// handling of redirected subdirs end


		$images_array = array();
		$j = 0;
		for($i = 0; $i < count($img[1]); $i++) {
			if (!strstr($img[1][$i],'.css'))	{
				$imgfilenamearr= explode('/',$img[1][$i]);
				$imgfilename=$imgfilenamearr[count($imgfilenamearr)-1];
				$imgfilenamearr= explode('.',$imgfilename);
				$imgfilename=$imgfilenamearr[0];

				$hit=$this->checkimagepattern($imgfilename);
				if ($hit<2) {
					$images_array[$j] =$img[1][$i];
					$j++;
				}
			}

		}

		$images_arrayout = array();

		$images_array_unique=array_unique($images_array);
		$k = 1;
		if (($this->selectedpics < $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ($this->logofound == false)) {

			for($i = 0; $i < count($images_array); $i++) {
				if (isset($images_array_unique[$i])) {
					if ($images_array_unique[$i] != '') {
						if (strstr($images_array_unique[$i], 'http')) {
							$images_arrayout[$i]=$images_array_unique[$i];
						} else {
							if ($iscss==true) {
								$images_array_unique[$i]=str_replace($cssfilerelpath,'',$images_array_unique[$i]);
								if (substr($images_array_unique[$i],0,1)=='/') {
									$images_arrayout[$i]=$this->urlhomearrstr . $images_array_unique[$i];
								} else {
									$images_arrayout[$i]=$cssfilepath . $images_array_unique[$i];
								}
							} else {
								// handling of redirected subdirs
								if ($this->urlsubpath!=''){
									if (strpos(($this->urlhomearrstr . $images_array_unique[$i]),$this->urlsubpath)===false) {
										$cssfilepath=$this->urlhomearrstr . $this->urlsubpath . $images_array_unique[$i];
									} else {
										$cssfilepath=$this->urlhomearrstr . $images_array_unique[$i];
									}
								} else {
										$cssfilepath=$this->urlhomearrstr . $images_array_unique[$i];
								}
								// handling of redirected subdirs end
								$images_arrayout[$i]=$cssfilepath;

							}
						}

						$cssfilebits=explode('.',$images_arrayout[$i]);
						$extpic = $cssfilebits[count($cssfilebits)-1];
						$arrwrk = array();
						$arrwrk=explode('//',$images_arrayout[$i]);
						if (count($arrwrk)>1) {
							$arrwrkout='';

							for($i2 = 0; $i2 < count($arrwrk); $i2++) {
								if ($i2==0) {
									$arrwrkout=$arrwrk[$i2] . '//';
								} elseif ($i2==count($arrwrk)-1) {
									$arrwrkout .=$arrwrk[$i2];
								}else {
									$arrwrkout .=$arrwrk[$i2] . '/';
								}
							}
							$images_arrayout[$i]=$arrwrkout;

						}
						$filename=$this->saveAndResize($images_arrayout[$i], 50, 50, '/' . $this->savepath .'temp/temp .' . $extpic,$extpic);

						if ($filename) {
							$k++;
						}
						$this->totalpicscans +=1;
						if (($this->selectedpics > $this->conf['attachments.']['webpagePreviewNumberOfImages']) && (($this->logofound == true) || (($this->selectedpics > $this->conf['attachments.']['webpagePreviewNumberOfImages']) && ($this->logofound == false) && ($this->totalpicscans > $this->conf['attachments.']['webpagePreviewScanMaxImageScan'])))) {
							if ($this->totalpicscans > $this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo']) {
								$i=999999;
							}
						} else {
							if ($this->totalpicscans > $this->conf['attachments.']['webpagePreviewScanMaxImageScansForLogo']) {
								$i=999999;

							}
						}
					}
				}
			}
			$this->totalcounter +=$k-1;
		}

		return $images_arrayout;
	}

	/**
	 * parses for referenced css-files in a string and returns the list of found css-files
	 *
	 * @param	string		$strextraction: string with pics to extract
	 * @param	string		$strouthtml: debugging string
	 * @param	boolean		$iscss: parsing goes thru a css-file
	 * @param	string		$cssfile: filename of css, if any
	 * @return	array		$cssfiles: array with image-filenames
	 */
	protected function pvs_fetch_css($strextraction,&$strouthtml, $iscss, $cssfile=''){
		if (($this->selectedpics < $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ($this->logofound == false)) {
			$strouthtml.='<div class="cssfiles">';
			$cssfiles = array();
			$k = 0;
			$strouthtmlcss= array();
			$cssfilerelpath='';
			if ($iscss==true) {
				$cssfilebits=explode('/',$cssfile);
				$cssfilebits[count($cssfilebits)-1] = '';
				$cssfilepath=implode('/',$cssfilebits);
				$cssfilerelpatharr=explode ('/',$cssfilepath);
				$cssfilerelpatharr[0]='';
				$cssfilerelpath='';
				for($i = 0; $i < sizeof($cssfilerelpatharr); $i++) {
					if (($cssfilerelpatharr[$i] !='') && ($cssfilerelpatharr[$i] !=$this->urlsitestr)) {
						$cssfilerelpath.=$cssfilerelpatharr[$i].'/';
					}
				}
			}
			else {
				$cssfilepath=$this->urlhomearrstr;
			}
			// handling of redirected subdirs
			if ($this->urlsubpath!=''){
				if (strpos($cssfilepath,$this->urlsubpath)===false) {
					$cssfilepath=$cssfilepath . $this->urlsubpath;
				}
			}
			// handling of redirected subdirs end

			// fetch css
			$css_regex = '/import[^;]*' . 'url\([\"|\'](.*)[\"|\']/Ui';
			preg_match_all($css_regex, $strextraction, $cssarr, PREG_PATTERN_ORDER);
			$css_array = $cssarr[1];
			for($i = 0; $i < sizeof($css_array); $i++) {
				if ($css_array[$i]) {
					if (substr($css_array[$i],0,1)=='/') {
						$css_array[$i]=trim(substr($css_array[$i],1,2000));
					}
					$css_arraybits=explode('.',$css_array[$i]);
					if ($css_arraybits[count($css_arraybits)-1]=='css') {
						if (strstr($css_array[$i], 'http')) {
							$strouthtmlcss[$k]='<p id="css'. $k . '">' . $css_array[$i] . '</p>';
							$cssfiles[$k]=$css_array[$i];
						} else {
							$css_array[$i]=str_replace($cssfilerelpath,'',$css_array[$i]);
							$strouthtmlcss[$k]='<p id="css'. $k . '">' . $cssfilepath . $css_array[$i] . '</p>';
							$cssfiles[$k]=$cssfilepath . $css_array[$i];
						}
						$k++;
					}
				}
			}
     		$css_regex = '/<link[^>]*' . 'href=[\"|\'](.*)[\"|\']/Ui';
			preg_match_all($css_regex, $strextraction, $cssarr, PREG_PATTERN_ORDER);
			$css_array = $cssarr[1];

			for($i = 0; $i < sizeof($css_array); $i++) {
				if ($css_array[$i]) {
					if (substr($css_array[$i],0,1)=='/') {
						$css_array[$i]=trim(substr($css_array[$i],1,2000));
					}
					$css_arraybits=explode('.',$css_array[$i]);
					if ($css_arraybits[count($css_arraybits)-1]=='css') {
						if (strstr($css_array[$i], 'http')) {
							$strouthtmlcss[$k]='<p id="css'. $k . '">' . $css_array[$i] . '</p>';
							$cssfiles[$k]=$css_array[$i];

						} else {
							$css_array[$i]=str_replace($cssfilerelpath,'',$css_array[$i]);
							$strouthtmlcss[$k]='<p id="css'. $k . '">' . $cssfilepath . $css_array[$i] . '</p>';
							$cssfiles[$k]=$cssfilepath . $css_array[$i];
						}
						$k++;
					}
				}
			}

			for($i = 0; $i < sizeof($cssfiles); $i++) {
				if (array_search($cssfiles[$i], $this->css_array) ==false ) {
					if (($this->selectedpics < $this->conf['attachments.']['webpagePreviewNumberOfImages']) || ($this->logofound == false)) {
						$htmlcss = $this->file_pvs_get_contents_curl($cssfiles[$i],'css');
						if ($htmlcss != false) {
							$images_arraycss=$this->pvs_fetch_images ($htmlcss,$strouthtml, true,$cssfiles[$i]);
							$this->images_array=array_merge($this->images_array,$images_arraycss);
						}
					} else {
						$i=999999;
					}
				}

			}
			$strouthtml.= '</div>';
			return $cssfiles;
		}
	}

	/**
	 * Checks if input is in list of logo filename patterns
	 *
	 * @param	string		$strtest: ...
	 * @return	int		$hit 0 not found 1, partitial hit, 2 fullhit
	 */
	protected function checklogopattern($strtest){
		$hit=0;
		$strtestarr=explode('.',$strtest);
		$strtest=$strtestarr[0];
		$strconfarr=explode(',',$this->conf['attachments.']['webpagePreviewScanLogoPatterns']);
		for($i = 0; $i < count($strconfarr); $i++) {
			$fullteststr=str_replace($strconfarr[$i],'',$strtest);
			if ($fullteststr!=$strtest) {
				$hit=1;
			}
		}
		$fullteststr=str_replace($strtest,'',$this->conf['attachments.']['webpagePreviewScanLogoPatterns']);
		if ($fullteststr!=$this->conf['attachments.']['webpagePreviewScanLogoPatterns']) {
			$hit=2;
		}
		if (in_array($strtest, explode(',',$this->conf['attachments.']['webpagePreviewScanLogoPatterns']))>0) {
			$hit=2;
		}
		return $hit;
	}
	/**
	 * Checks if input is in list of banned image filename patterns
	 *
	 * @param	string		$strtest: ...
	 * @return	int		$hit 0 not found 1, partitial hit, 2 fullhit
	 */
	protected function checkimagepattern($strtest){
		$hit=0;
		$strtestarr=explode('.',$strtest);
		$strtest=$strtestarr[0];
		$strconfarr=explode(',',$this->conf['attachments.']['webpagePreviewScanExcludeImagePatterns']);
		for($i = 0; $i < count($strconfarr); $i++) {
			$fullteststr=str_replace($strconfarr[$i],'',$strtest);
			if ($fullteststr!=$strtest) {
				$hit=1;
			}
		}
		$fullteststr=str_replace($strtest,'',$this->conf['attachments.']['webpagePreviewScanExcludeImagePatterns']);
		if ($fullteststr!=$this->conf['attachments.']['webpagePreviewScanExcludeImagePatterns']) {
			$hit=2;
		}
		if (in_array($strtest, explode(',',$this->conf['attachments.']['webpagePreviewScanExcludeImagePatterns']))>0) {
			$hit=2;
		}
		return $hit;
	}
	/**
	 * Checks if html contains video and returns fulllink if so
	 *
	 * @param	string		$html: ...
	 * @return	int		$hit 0 not found 1, partitial hit, 2 fullhit
	 */
	protected function checkvideocontent($html) {
		$title='';
		$description='';

		$type='';
		$videotype='';
		$videotype='';
		$site_name='';

		$videoUrl='';
		$thumbnailUrl='';
		$embedUrl='';
		$return= '';
		$metasplits = array();
		$metasplits['og:url'] ='og:url" content="' ;//http://www.youtube.com/watch?v=a6Yqa23LS9c">
		$metasplits['og:title'] ='og:title" content="'; //Argon Sphere vs Shogan - Space Traveler">
		$metasplits['og:description'] ='og:description" content="'; //Album: VA - 2 Sides Of Moon Subscribe for more psytrance music.">
		$metasplits['og:type'] ='og:type" content="'; //video">
		$metasplits['og:image'] ='og:image" content="'; //http://i2.ytimg.com/vi/a6Yqa23LS9c/mqdefault.jpg">
		$metasplits['og:video'] ='og:video" content="'; //http://www.youtube.com/v/a6Yqa23LS9c?autohide=1&amp;version=3">
		$metasplits['og:video:type'] ='og:video:type" content="'; //application/x-shockwave-flash">
		$metasplits['og:video:width'] ='og:video:width" content="'; //640">
		$metasplits['og:video:height'] ='og:video:height" content="'; //480">
		$metasplits['og:site_name'] ='og:site_name" content="'; //YouTube">
		$metasplits['itemprop.url'] ='itemprop="url" href="'; //http://www.youtube.com/watch?v=a6Yqa23LS9c">
		$metasplits['itemprop.name'] ='itemprop="name" content="'; //Argon Sphere vs Shogan - Space Traveler">
		$metasplits['itemprop.description'] ='itemprop="description" content="'; //Album: VA - 2 Sides Of Moon Subscribe for more psytrance music.">
		$metasplits['itemprop.thumbnailUrl'] ='itemprop="thumbnailUrl" href="'; //http://i2.ytimg.com/vi/a6Yqa23LS9c/hqdefault.jpg">
		$metasplits['itemprop.embedURL'] ='itemprop="embedURL" href="'; //http://www.youtube.com/v/a6Yqa23LS9c?autohide=1&amp;version=3">
		$metasplits['itemprop.playerType'] ='itemprop="playerType" content="'; //Flash">
		$metasplits['itemprop.playpageUrl'] ='itemprop="playpageUrl" content="'; //http://vimeo.com/15556391">
		$metasplits['itemprop.video'] ='itemprop="video" itemscope itemtype="'; //


		//check HTML5
		$html5vidogg='';
		$html5vidmp4='';
		$html5vidwebm='';
		$htmlvidarr = explode('<video', $html);
		if (count($htmlvidarr)>1) {
			$htmlvidarrvid = explode('.ogg', $htmlvidarr[1]);
			if (count($htmlvidarrvid)>1) {
				$html5vidogg = $htmlvidarrvid[0] . '.ogg';
			}
			$htmlvidarrvid = explode('.mp4', $htmlvidarr[1]);
			if (count($htmlvidarrvid)>1) {
				$html5vidmp4 = $htmlvidarrvid[0] . '.mp4';
			}
			$htmlvidarrvid = explode('.webm', $htmlvidarr[1]);
			if (count($htmlvidarrvid)>1) {
				$html5vidwebm = $htmlvidarrvid[0]. '.webm';
			}
			if ($html5vidogg!='') {
				$html5vidarr = explode('src=', $html5vidogg);
				if (count($html5vidarr)>1) {
					$html5vidogg = $html5vidarr[count($html5vidarr)-1];
				}
			}
			if ($html5vidmp4!='') {
				$html5vidarr = explode('src=', $html5vidmp4);
				if (count($html5vidarr)>1) {
					$html5vidmp4 = $html5vidarr[count($html5vidarr)-1];
				}
			}
			if ($html5vidwebm!='') {
				$html5vidarr = explode('src=', $html5vidwebm);
				if (count($html5vidarr)>1) {
					$html5vidwebm = $html5vidarr[count($html5vidarr)-1];
				}
			}
			if ($html5vidogg!='') {
				if (strpos($html5vidogg,'http')===false) {
					//add base dir
					if ($this->urlsubpath!=''){
						if (strpos(($this->urlhomearrstr . $html5vidogg),$this->urlsubpath)===false) {
							$html5vidogg=$this->urlhomearrstr . $this->urlsubpath . $html5vidogg;
						} else {
							$html5vidogg=$this->urlhomearrstr  . $html5vidogg;
						}
					} else {
						$html5vidogg=$this->urlhomearrstr  . $html5vidogg;
					}
				}
			}
			$html5vidogg=str_replace('"','',$html5vidogg);
			if ($html5vidmp4!='') {
				if (strpos($html5vidmp4,'http')===false) {
					//add base dir
					if ($this->urlsubpath!=''){
						if (strpos(($this->urlhomearrstr . $html5vidmp4),$this->urlsubpath)===false) {
							$html5vidmp4=$this->urlhomearrstr . $this->urlsubpath . $html5vidmp4;
						} else {
							$html5vidmp4=$this->urlhomearrstr  . $html5vidmp4;
						}
					} else {
						$html5vidmp4=$this->urlhomearrstr  . $html5vidmp4;
					}
				}
			}
			$html5vidmp4=str_replace('"','',$html5vidmp4);
			if ($html5vidwebm!='') {
				if (strpos($html5vidwebm,'http')===false) {
					//add base dir
					if ($this->urlsubpath!=''){
						if (strpos(($this->urlhomearrstr . $html5vidwebm),$this->urlsubpath)===false) {
							$html5vidwebm=$this->urlhomearrstr . $this->urlsubpath . $html5vidwebm;
						} else {
							$html5vidwebm=$this->urlhomearrstr  . $html5vidwebm;
						}
					} else {
						$html5vidwebm=$this->urlhomearrstr  . $html5vidwebm;
					}
				}
			}
			$html5vidwebm=str_replace('"','',$html5vidwebm);

			$thumbnailUrl=$html5vidogg . '@@@' . $html5vidmp4 . '@@@' .$html5vidwebm . '@@@' ;
			$_SESSION[$this->cid][$this->commentid]['embedUrl'] = $thumbnailUrl;
			$_SESSION[$this->cid][$this->commentid]['videotype'] = $videotype;
			$_SESSION[$this->cid][$this->commentid]['totalcounter'] = 1;
			$_SESSION[$this->cid][$this->commentid]['logo'] = $thumbnailUrl;
			$_SESSION[$this->cid][$this->commentid]['videosite'] = '';
			$_SESSION[$this->cid][$this->commentid]['urlfound'] = $_SESSION[$this->cid][$this->commentid]['url'];
			$_SESSION[$this->cid][$this->commentid]['urltext'] = $_SESSION[$this->cid][$this->commentid]['url'];
			$return= 'found';
		}

		if (($html5vidogg=='') && ($html5vidmp4=='') && ($html5vidwebm=='')) {
			$metakeys=array();
			$j=0;
			foreach ($metasplits as $metasplit) {
				$tagcontent='';
				$htmlvidarr = explode($metasplit, $html);
				if (count($htmlvidarr)>1) {
					$tagcontentarr = explode('">', $htmlvidarr[1]);
					$tagcontent=$tagcontentarr[0];
					$propertyval= $metasplit;
					$propertyval = str_replace ('" content="','',$propertyval);
					$propertyval = str_replace ('" itemscope itemtype="','',$propertyval);
					$propertyval = str_replace ('" href="','',$propertyval);
					$propertyval = str_replace ('="','.',$propertyval);
				}
				if ($tagcontent!=''){
					$metakeys[$propertyval]=$tagcontent;
				}
			}
			if (count($metakeys)>0) {
				//$type
				if (array_key_exists('og:type',$metakeys)) {
					if($metakeys['og:type'] =='video') {
						$type='video';
					}
				} elseif (array_key_exists('itemprop.video',$metakeys)) {
					if($metakeys['itemprop.video'] =='http://schema.org/VideoObject') {
						$type='video';
					}
				}
				if ($type=='video') {
					//$description
					if (array_key_exists('og:description',$metakeys)) {
						if ($metakeys['og:description'] !='') {
							$description=$metakeys['og:description'];
						}
					} elseif (array_key_exists('itemprop.description',$metakeys)) {
						if ($metakeys['itemprop.description'] !='') {
							$description=$metakeys['itemprop.description'];
						}
					}
					//$title
					if (array_key_exists('og:title',$metakeys)) {
						if ($metakeys['og:title'] !='') {
							$title=$metakeys['og:title'];
						}
					} elseif (array_key_exists('itemprop.name',$metakeys)) {
						if ($metakeys['itemprop.name'] !='') {
							$title=$metakeys['itemprop.name'];
						}
					}

					//$videotype
					if (array_key_exists('og:video:type',$metakeys)) {
						if ($metakeys['og:video:type']!='') {
							$videotype=$metakeys['og:video:type'];
						}
					}
					//site_name
					if (array_key_exists('og:site_name',$metakeys)) {
						if ($metakeys['og:site_name'] !='') {
							$site_name=$metakeys['og:site_name'];
						}
					} elseif (array_key_exists('itemprop.name',$metakeys)) {
						if (strlen($metakeys['itemprop.name']) <10) {  //Vimeo
							$site_name=$metakeys['itemprop.name'];
						}
					}

					//thumbnailUrl
					if (array_key_exists('itemprop.thumbnailUrl',$metakeys)) {
						if ($metakeys['itemprop.thumbnailUrl'] !='') {
							$thumbnailUrl=$metakeys['itemprop.thumbnailUrl'];
						}
					} elseif (array_key_exists('og:image',$metakeys)) {
						if ($metakeys['og:image'] !='') {
							$thumbnailUrl=$metakeys['og:image'];
						}
					}

					//embedUrl
					if (array_key_exists('og:video',$metakeys)) {
						if ($metakeys['og:video'] !='') {
							$embedUrl=$metakeys['og:video'];
						}
					} elseif (array_key_exists('itemprop.embedURL',$metakeys)) {
						if ($metakeys['itemprop.embedURL'] !='') {
							$embedUrl=$metakeys['itemprop.embedURL'];
						}
					}


					//$videoUrl
					if (array_key_exists('og:url',$metakeys)) {
						if(strpos($metakeys['og:url'],'ttp:') > 0) {
							$videoUrl=$metakeys['og:url'];
						}
					} elseif (array_key_exists('itemprop.url',$metakeys)) {
						if (strpos($metakeys['itemprop.url'],'ttp:') > 0) {
							$videoUrl=$metakeys['itemprop.url'];
						}
					} elseif (array_key_exists('itemprop.playpageUrl',$metakeys)) {
						if (strpos($metakeys['itemprop.playpageUrl'],'ttp:') > 0) {
							$videoUrl=$metakeys['itemprop.playpageUrl'];
						}
					}

					if ($_SESSION[$this->cid][$this->commentid]['title'] =='') {
						$_SESSION[$this->cid][$this->commentid]['title'] = $title;
					}

					$_SESSION[$this->cid][$this->commentid]['urlfound'] = $videoUrl;

					$_SESSION[$this->cid][$this->commentid]['urltext'] = $videoUrl;

					$description= $this->croptitleordesc($description);

					$_SESSION[$this->cid][$this->commentid]['description'] = $description;
					$_SESSION[$this->cid][$this->commentid]['totalcounter'] = 0;
					if ($thumbnailUrl !='') {
						$_SESSION[$this->cid][$this->commentid]['totalcounter'] = 1;
					}
					$_SESSION[$this->cid][$this->commentid]['logo'] = $thumbnailUrl;

					$_SESSION[$this->cid][$this->commentid]['videosite'] = $site_name;
					$_SESSION[$this->cid][$this->commentid]['embedUrl'] = $embedUrl;
					$return ='found';
				}
			}
		} else {

		}

		if ($return=='found') {
			// cleansing
			$description=$_SESSION[$this->cid][$this->commentid]['description'];


			$description=$this->cleanouttitleordesc($description);
			$_SESSION[$this->cid][$this->commentid]['description'] = $description;

			$title=$_SESSION[$this->cid][$this->commentid]['title'];
			$title=$this->cleanouttitleordesc($title);
			$_SESSION[$this->cid][$this->commentid]['title'] = $title;
			return 'found';
		}
		return '';
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$description: ...
	 * @return	[type]		...
	 */
	protected function croptitleordesc($description) {
		if (strlen ($description) > $this->conf['attachments.']['webpagePreviewDescriptionLength']) {
			$descriptionarr = explode(' ',$description);
			$descriptionlen =0;
			$descriptionout ='';
			for($i = 0; $i < count($descriptionarr); $i++) {
				$descriptionlen += strlen($descriptionarr[$i])+1;
				$descriptionout .= $descriptionarr[$i] . ' ';
				if ($descriptionlen>=$this->conf['attachments.']['webpagePreviewDescriptionLength']) {
					$description=$descriptionout . ' ...';
					break;
				}
				$description=$descriptionout;
			}
		}
		return $description;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$title: ...
	 * @return	[type]		...
	 */
	protected function cleanouttitleordesc($title) {
		$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
				'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				'@<![\s\S]*?--[ \t\n\r]*>@',         // Strip multi-line comments including CDATA
		);
		$titleclean = ' ' . preg_replace($search, '', $title);
		$searcharr = explode('http', $titleclean);
		$textdedoublespaced= '';
		if (count($searcharr)>1) {
			for ($d=0;$d<count($searcharr);$d=$d+2) {
				$textdedoublespaced .= $searcharr[$d];
				$searcharr2 = explode(' ', $searcharr[$d+1]);
				unset($searcharr2[0]);
				$textdedoublespaced .= ' ' . implode(' ',$searcharr2);

			}
		} else {
			$textdedoublespaced= trim($titleclean);
		}

		$title = $textdedoublespaced;
		$cleanspacearr= explode('  ', $title);
		$textdedoublespaced= '';
		if (count($cleanspacearr)>1) {
			for ($d=0;$d<count($cleanspacearr);$d++) {
				if (trim($cleanspacearr[$d]) != '') {
					$textdedoublespaced .= trim($cleanspacearr[$d]) . ' ';
				}
			}
		} else {
			$textdedoublespaced=$title;
		}

		$title=trim($textdedoublespaced);
		if ($title!=''){
			$titlearr=explode (' ', $title);
			if (count($titlearr)>1) {
				for ($i=0;$i<count($titlearr);$i++) {
					$titlearr2=explode ('-', $titlearr[$i]);
					if (count($titlearr2)>1) {
						for ($ti=0;$ti<count($titlearr2);$ti++) {
							if (!$this->docutf8declared) {
								if (mb_detect_encoding($titlearr2[$ti], 'UTF-8', true) === FALSE) {
								} else {
									$countrogs= count(explode('?',$titlearr2[$ti]));
									$titletmp = utf8_decode($titlearr2[$ti]);
									if (count(explode('?',$titletmp))<=$countrogs) {
										$titlearr2[$ti]=$titletmp;
									}
								}
								if (mb_detect_encoding($titlearr2[$ti], 'UTF-8', true) === FALSE) {
									$titlearr2[$ti] = utf8_encode($titlearr2[$ti]);
								}
							} else {
								if (mb_detect_encoding($titlearr2[$ti], 'UTF-8', true) === FALSE) {
									$titlearr2[$ti] = utf8_encode($titlearr2[$ti]);
								}
							}
						}


						$titlearr[$i]=implode ('-', $titlearr2);
					} else {
						if (!$this->docutf8declared) {
							if (mb_detect_encoding($titlearr[$i], 'UTF-8', true) === FALSE) {
							} else {
								$countrogs= count(explode('?',$titlearr[$i]));
								$countpms= strlen($titlearr[$i]);
								$titletmp = utf8_decode($titlearr[$i]);
								if (count(explode('?',$titletmp))<=$countrogs) {
									if (strlen($titletmp)<=$countpms) {
										$titlearr[$i]=$titletmp;
									}
								}
							}
							if (mb_detect_encoding($titlearr[$i], 'UTF-8', true) === FALSE) {
								$titlearr[$i] = utf8_encode($titlearr[$i]);
							}
						} else {
							if (mb_detect_encoding($titlearr[$i], 'UTF-8', true) === FALSE) {
								$titlearr[$i] = utf8_encode($titlearr[$i]);
							}
						}
					}
				}

				$title=implode (' ', $titlearr);
			} else {
				if (!$this->docutf8declared) {
					if (mb_detect_encoding($title, 'UTF-8', true) === FALSE) {
					} else {
						$countrogs= count(explode('?',$title));
						$titletmp = utf8_decode($title);
						if (count(explode('?',$titletmp))<=$countrogs) {
							$title=$titletmp;
						}
					}

					if (mb_detect_encoding($title, 'UTF-8', true) === FALSE) {
						$title = utf8_encode($title);
					}
				} else {
					if (mb_detect_encoding($title, 'UTF-8', true) === FALSE) {
						$title = utf8_encode($title);
					}
				}
			}

		}
		$title=htmlspecialchars_decode($title,ENT_QUOTES);
		$title=html_entity_decode($title,ENT_NOQUOTES,'UTF-8');

		return $title;
	}
}
?>