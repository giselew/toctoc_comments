<?php
/***************************************************************
*  Copyright notice
*
* (c) 2012 - 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
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
 * class.toctoc_comments_common.php
 *
 * AJAX Social Network Components
 *
 * @author Gisele Wendl <gisele.wendl@toctoc.ch>
 *
 */
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   56: class toctoc_comments_common
 *   65:     public function unmirrorConf($pObj, $confDiff)
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
class toctoc_comments_common {
	/**
 * adds the conf-difference again to the mirror of the conf
 * and reconstuct the full conf
 *
 * @param	array		$confDiff: ...
 * @param	[type]		$confDiff: ...
 * @return	array		$confout
 */
	public function unmirrorConf($pObj, $confDiff) {
		session_name('sess_' . $pObj->extKey);
		session_start();
		if ($_SESSION['dontUseMirrorConf'] == 0) {
			$mirrorconf=array();
			$mirrorconf=unserialize(base64_decode($_SESSION['mirrorconf']));
			if (is_array($confDiff)) {
				$confout = array_replace_recursive($mirrorconf, $confDiff);
			} else {
				$confout = $mirrorconf;
			}

			return $confout;
		} else {
			return $confDiff;
		}
	}

}

if(defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_common.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/toctoc_comments/class.toctoc_comments_common.php']);
}
?>