<?php
/***************************************************************
 *  Copyright notice
*
*  (c) 2013 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
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
 * class.toctoc_comments_attachmentupload.php
*
* AJAX Social Network Components.
*
*
* @author Gisele Wendl <gisele.wendl@toctoc.ch>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   63: class toctoc_comments_attachmentupload
 *   75:     public function main($files, $post)
 *  442:     protected function create_thumbnail_frompdf($pdffile, $pdffilejpg, $impath, $isgm)
 *
 * TOTAL FUNCTIONS: 2
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */


/**
 * Uploads Pics and PDFs
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package TYPO3
 * @subpackage toctoc_comments
 */




$ml = new toctoc_comments_attachmentupload;
$ml->main($_FILES, $_POST);
class toctoc_comments_attachmentupload {
	protected $uplfile = array();
	protected $conf = array();
	protected $extKey = 'toctoc_comments';
	private $jpgquality = 90;
	/**
	 * Main processing
	 *
	 * @param	array		$files: ...
	 * @param	array		$post: ...
	 * @return	[type]		...
	 */
	public function main($files, $post) {
		// $retstr <br>-separated string-array
		// 0: filename
		// 1: relative path
		// 2: file-height
		// 3: server-path and filename

		$ajaxdataarr=array();
		$ajaxdataarr=$post['toctoc_comments_pi1']['ajax'];
		$cid=$post['toctoc_comments_pi1']['cid'];
		$dataajaxatt = unserialize(base64_decode($ajaxdataarr));
		$dataajaxatt['awaitgoogle'] = base64_decode($dataajaxatt['awaitgoogle']);
		$dataajaxatt['txtimage'] = base64_decode($dataajaxatt['txtimage']);
		$dataajaxatt['txtimages'] = base64_decode($dataajaxatt['txtimages']);

		$ajaxdataarrcz=array();
		//$ajaxdataarrcz['attachments2.']=array();
		$ajaxdataarrcz = $dataajaxatt['conf'];
		$this->conf=$ajaxdataarrcz;
		if (!array_key_exists('attachments.', $this->conf)){
			$this->conf['attachments.'] = array();
			$this->conf['attachments.']['picUploadDims'] = 100;
			$this->conf['attachments.']['picUploadMaxDimX'] = 400;
			$this->conf['attachments.']['picUploadMaxDimY'] = 600;
			$this->conf['attachments.']['picUploadMaxDimYWebpage'] = 300;
			$this->conf['attachments.']['picUploadMaxDimWebpage'] = 470;
		} else {
			$this->conf['attachments.']['picUploadDims'] = $this->conf['attachments.']['picUploadDims'];
			$this->conf['attachments.']['picUploadMaxDimX'] = $this->conf['attachments.']['picUploadMaxDimX'];
			$this->conf['attachments.']['picUploadMaxDimY'] = $this->conf['attachments.']['picUploadMaxDimY'];
			$this->conf['attachments.']['picUploadMaxDimYWebpage'] = $this->conf['attachments.']['picUploadMaxDimYWebpage'];
			$this->conf['attachments.']['picUploadMaxDimWebpage'] = $this->conf['attachments.']['picUploadMaxDimWebpage'];
		}

		$retstr = '';
		$sessionFile = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'sessionpath.tmp';
		$sessionSavePath =  @file_get_contents($sessionFile);

		if (!(isset($commonObj))) {
			require_once ('class.toctoc_comments_common.php');
			$commonObj = new toctoc_comments_common;
		}
		$commonObj->start_toctoccomments_session(3*1440, $sessionSavePath);

		if (!isset($_SESSION['uploadstep'])) {
			$_SESSION['uploadstep']=0;
		} else {
			$_SESSION['uploadstep']++;
		}

		$width=0;
		$height=0;
		$new_width=50;
		$new_height=50;
		// Logo won't be resized
		$arrnew_width=array();
		$arrnew_height=array();
		$savepath = 'uploads/tx_toctoccomments/';
		$s=$files['myfile']['name'];
		mb_detect_encoding($s, 'UTF-8') == 'UTF-8' ? : $s = utf8_encode($s);
		mb_detect_encoding($s, 'UTF-8') != 'UTF-8' ? : $s = utf8_decode($s);

		$files['myfile']['name']=$s;
		$_SESSION['submitCommentVars'][$cid]['originalfilename']=$files['myfile']['name'];
		if ($files['myfile']['type'] =='application/pdf') {
			$ext='jpg';
			//pdf
		} else {
			list($width, $height, $typeimg, $attr) = getimagesize($files['myfile']['tmp_name']);

			if ($width==0){
				return '$width==0';
			}

			if ($width>$height){
				$new_width=$this->conf['attachments.']['picUploadDims'];
				$new_height=intval($height*($new_width/$width));
			} else {
				$new_height=$this->conf['attachments.']['picUploadDims'];
				$new_width=intval($width*($new_height/$height));
			}

			$arrnew_width[0]=$new_width;
			$arrnew_height[0]=$new_height;
			$arrnew_width[1]=$width;
			$arrnew_height[1]=$height;
			$arrnew_width[2]=$width;
			$arrnew_height[2]=$height;
			$arrnew_width3=$width;
			$arrnew_height3=$height;

			if (intval($width)>$this->conf['attachments.']['picUploadMaxDimX']){
				$nwidth=$this->conf['attachments.']['picUploadMaxDimX'];
				$arrnew_height[1]=intval($height*($nwidth/$width));
				$arrnew_width[1]=$nwidth;
				if (intval($arrnew_height[1])>$this->conf['attachments.']['picUploadMaxDimY']){
					$nheight=$this->conf['attachments.']['picUploadMaxDimY'];
					$arrnew_width[1]=intval($nwidth*($this->conf['attachments.']['picUploadMaxDimY']/$arrnew_height[1]));
					$arrnew_height[1]=$this->conf['attachments.']['picUploadMaxDimY'];
				}

			} else {
				if (intval($height)>$this->conf['attachments.']['picUploadMaxDimY']){
					$nheight=$this->conf['attachments.']['picUploadMaxDimY'];
					$arrnew_width[1]=intval($width*($nheight/$height));
					$arrnew_height[1]=$nheight;
				}

			}

			if (intval($width)>$this->conf['attachments.']['picUploadMaxDimWebpage']){
				$arrnew_width[2]=$this->conf['attachments.']['picUploadMaxDimWebpage'];
				$arrnew_height[2]=intval($height*($arrnew_width[2]/$width));
			}

			$arrnew_height[3]=0;
			$arrnew_width[3]=0;
			if (isset($typeimg) && in_array($typeimg, array(
					IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_WBMP))) {
				if ($typeimg==3) {
					$ext='png';
				} elseif ($typeimg==2) {
					$ext='jpg';
				} elseif ($typeimg==1) {
					$ext='gif';
				} elseif ($typeimg==4) {
					$ext='bmp';
				} else {
					return '$typeimg==' .$typeimg;
				}

			} else  {
				return 'not isset($typeimg)';
			}

		}

		$dirsep=DIRECTORY_SEPARATOR;
		$impath=str_replace('/', $dirsep, $post['toctoc_comments_pi1']['pathim']);

		$repstr= str_replace('/', $dirsep, '/typo3conf/ext/toctoc_comments/pi1');
		$dirsep=str_replace($repstr, '', dirname(__FILE__));
		$pathirname=$post['toctoc_comments_pi1']['configbaseURL'] . $savepath . 'temp/';
		$isgm = FALSE;
		if (str_replace('convert', '', $impath) != $impath) {
			$isgm = TRUE;
		}

		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txdirname= str_replace('/', '\\', $dirsep .$pathirname);
			if ($isgm == FALSE) {
				$impath .= 'convert.exe';
			}
		} else {
			$txdirname=$dirsep .$pathirname;
			if ($isgm == FALSE) {
				$impath .= 'convert';
			}
		}

		$idstr=session_id();
		if ($idstr==FALSE) {
			$idstr = microtime(TRUE);
		}

		$idstr = $idstr . 'IMGcid' . $post['toctoc_comments_pi1']['cid'] . 'v' . $_SESSION['uploadstep'] . '.' .$ext;
		$savepathfilename=$txdirname . $idstr;
		if ($files['myfile']['type'] == 'application/pdf') {
			//pdf
			$copyfromfile=$files['myfile']['tmp_name'];
			$copytofile=$txdirname . $files['myfile']['name'];
			if (!copy($copyfromfile, $copytofile)) {
				return print('failed copy for image ' . $copyfromfile . ' to ' . $copytofile . "\n");
			}

			$pdffilejpg=$savepathfilename;
			$pdffilejpg = $this->create_thumbnail_frompdf($copytofile, $pdffilejpg, $impath, $isgm);
			if ($pdffilejpg=='') {
				$pathirname = $post['toctoc_comments_pi1']['configbaseURL'] . 'typo3conf/ext/toctoc_comments/res/css/themes/' .
								$post['toctoc_comments_pi1']['theme'] . '/img/';
				$retstr .= 'adobepdf.png<br>';
				$retstr .= $pathirname . '<br>';
				$retstr .= '80<br>';
				$retstr .= $files['myfile']['name'] . '<br>';
			} else {
				$savepathfilename=$pdffilejpg;
				$image = imagecreatefromjpeg($pdffilejpg);
				$savepathfilename = str_replace('.'. $ext, '_list.'. $ext, $savepathfilename);
				imagejpeg($image, $savepathfilename, $this->jpgquality);

				$retstr .= $idstr . '<br>';
				$retstr .= $pathirname . '<br>';
				$retstr .= '116<br>';
				$retstr .= $files['myfile']['name'] . '<br>';
			}

		} else {
			$retstr .= $idstr . '<br>';
			$retstr .= $pathirname . '<br>';
			$retstr .= $arrnew_height[0] . '<br>';
			if ((strtoupper($ext) =='JPG') || (strtoupper($ext) =='JPEG')) {
				$image = imagecreatefromjpeg($files['myfile']['tmp_name']);
			} elseif (strtoupper($ext) =='GIF') {
				$image = imagecreatefromgif($files['myfile']['tmp_name']);
			} elseif (strtoupper($ext) =='PNG') {
				$image = imagecreatefrompng($files['myfile']['tmp_name']);
			} elseif (strtoupper($ext) =='BMP') {
				$image = imagecreatefromwbmp ($files['myfile']['tmp_name']);
			} else {
				$retstr = '$strtoupper($ext)==' .strtoupper($ext);
				return $retstr;
			}

			$temppicarr=array();
			if ($image) {
				for ($i=0;$i<4;$i++) {
			  		$new_width=$arrnew_width[$i];
					$new_height=$arrnew_height[$i];
					$new_widthcrop=$new_width;
					$new_heightcrop=$new_height;
					$srcy=0;
					if ($i==1) {
						$savepathfilename = str_replace('.'. $ext, '_big.'. $ext, $savepathfilename);

					} elseif ($i==2) {
						$savepathfilename = str_replace('_big.'. $ext, '.'. $ext, $savepathfilename);
						$savepathfilename = str_replace('.'. $ext, '_list.'. $ext, $savepathfilename);
					} elseif ($i==3) {
						if (intval($arrnew_height[$i-1])>$this->conf['attachments.']['picUploadMaxDimYWebpage']){
							$nheight=$this->conf['attachments.']['picUploadMaxDimYWebpage'];
							$arrnew_width[$i]=intval($arrnew_width[$i-1]*($this->conf['attachments.']['picUploadMaxDimYWebpage']/$nheight));
							$arrnew_height[$i]=$this->conf['attachments.']['picUploadMaxDimYWebpage'];
							$srcy=intval(($arrnew_height[$i-1]-$arrnew_height[$i])/2);
							$new_widthcrop=$arrnew_width[$i];
							$new_height=$arrnew_height[$i];
						}

						else {
							$arrnew_width[$i]=$arrnew_width[$i-1];
							$arrnew_height[$i]=$arrnew_height[$i-1];
							$new_widthcrop=$arrnew_width[$i];
							$new_height=$arrnew_height[$i];
						}

						if ($arrnew_width[$i]<$arrnew_width[$i-1]) {
							$new_widthcrop=$arrnew_width[$i-1];
							$arrnew_height[$i]=intval($arrnew_height[$i]*($arrnew_width[$i]/$new_widthcrop));
							$new_height=$arrnew_height[$i];
							$srcy=intval(($arrnew_height[$i-1]-$arrnew_height[$i])/2);

						}

						$width=$arrnew_width[$i-1];
						$height=$arrnew_height[$i-1];
					}

					$temppicarr[$i]['filename']=$savepathfilename;
					$image_p = imagecreatetruecolor($new_widthcrop, $new_height);

					// handle transparancy
					if ((strtoupper($ext) =='GIF') || (strtoupper($ext) =='PNG')) {
						$trnprt_indx = imagecolortransparent($image);
						// If we have a specific transparent color
						if (($trnprt_indx >= 0) && ($trnprt_indx < 254)) {
							// Get the original image's transparent color's RGB values
							$nmbr_color  = imagecolorstotal($image);
							$trnprt_color  = imagecolorsforindex($image, $trnprt_indx);
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
							imagealphablending($image_p, FALSE);

							// Create a new transparent color for image
							$tspcolor = imagecolorallocatealpha($image_p, 0, 0, 0, 127);

							// Completely fill the background of the new image with allocated color.
							imagefill($image_p, 0, 0, $tspcolor);

							// Restore transparency blending
							imagesavealpha($image_p, TRUE);
						}

					}

					if ($i<3){
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					} else {
						imagecopyresampled($image_p, $image, 0, 0, 0, $srcy, $new_widthcrop, $new_height, $width, $height-2*$srcy);

					}

					switch(strtolower($ext)) {
						case 'gif':
							imagegif($image_p, $savepathfilename);
							break;
						case 'png':
							imagepng($image_p, $savepathfilename, 0);
							break;
						case 'bmp':
							imagewbmp($image_p, $savepathfilename);
							break;
						case 'jpg':
							imagejpeg($image_p, $savepathfilename, $this->jpgquality);
							break;
						case 'jpeg':
							imagejpeg($image_p, $savepathfilename, $this->jpgquality);
							break;
						default:
							$retstr = 'strtolower($ext)' . strtolower($ext);
							return $retstr;

					}

					if ($i==2) {
						imagedestroy($image);
						if ((strtoupper($ext) =='JPG') || (strtoupper($ext) =='JPEG')) {
							$image = imagecreatefromjpeg($savepathfilename);
						} elseif (strtoupper($ext) =='GIF') {
							$image = imagecreatefromgif($savepathfilename);
						} elseif (strtoupper($ext) =='PNG') {
							$image = imagecreatefrompng($savepathfilename);
						} elseif (strtoupper($ext) =='BMP') {
							$image = imagecreatefromwbmp ($savepathfilename);
						} else {
							$retstr =  '$strtoupper($ext)==' . strtoupper($ext);
							return $retstr;
						}

					}

					imagedestroy($image_p);
					$retstr .= $savepathfilename . '<br>';
				}

			}

		}

		if (isset($image)) {
		imagedestroy($image);
		}

		return print $retstr;
	}

	/**
	 * function tries to create thumbnail from pdf with imagemagick
	 * depending on server-configuration it works or not, Windowsenvironments are problematic
	 *
	 * @param	string		$pdffile: ...
	 * @param	string		$pdffilejpg: ...
	 * @param	string		$impath: ...
	 * @param	[type]		$isgm: ...
	 * @return	string		...
	 */
	protected function create_thumbnail_frompdf($pdffile, $pdffilejpg, $impath, $isgm) {
		$data='';

		if ($isgm == TRUE) {
			$txexeccommand= '"' . $impath . '  -geometry 90x116! -colorspace RGB -quality 95 "' . $pdffile . '[0]" "' . $pdffilejpg . '"';
		} else {
			$txexeccommand= '"' . $impath . '" -geometry 90x116! -colorspace RGB -quality 95 -sharpen 1x2 "' . $pdffile . '[0]" "' . $pdffilejpg . '"';
		}

		if (DIRECTORY_SEPARATOR == '\\') {
			// windows
			$txexeccommand= str_replace(DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR, $txexeccommand);
		}

		$pdffilejpg0=str_replace('.jpg', '-0.jpg', $pdffilejpg);
		system($txexeccommand);
		usleep(1000000);

		if (file_exists($pdffilejpg)) {
			return $pdffilejpg;
		} elseif (file_exists($pdffilejpg0)) {
			return $pdffilejpg0;
		} else{
			return '';
		}

	}
}
?>