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
 * BackendSystem.php
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
 *   53: class toctoc_comments_be_db
 *   61:     public function bedb(&$pObj)
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
class toctoc_comments_be_db {

	/**
	 * Desc
	 *
	 * @param	[type]		$$pObj: ...
	 * @return	[type]		...
	 */
	public function bedb(&$pObj) {
		$content ='';
		$strbrbr = '';
		$strbrbrstart = '<div class="tx-tc-100 tx-tc-sessioncolornone" id="databasehtml">';
		$strbrbrdivend = '</div>';
		$strinfostart = '&nbsp;';
		$strinfoend = '';
     	$infomessage = '';
    	$alertmsg = 0;

    	// Bulk action
    	$newdataarray = '';
    	if (isset($_POST['refreshdb'])) {
    		$newdataarray = array();
    		$schema = '';
    		if (version_compare(TYPO3_version, '6.0', '<')) {
    			$schema = TYPO3_db_name;
    		} elseif (version_compare(TYPO3_version, '8.1', '<')) {
    			$cm = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager');
    			$schema = $cm->getLocalConfigurationValueByPath('DB/database');
       		} else {
    			$cm = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager');
    			$schema = $cm->getLocalConfigurationValueByPath('DB/Connections/Default/dbname');
    		}

   $querymerged='SELECT TABLE_NAME AS tablenamen FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = "'.$schema.'" AND TABLE_NAME LIKE "%tx_toc%"';

			$resultmerged1= $GLOBALS['TYPO3_DB']->sql_query($querymerged);
			$i=0;
			while ($rowsmerged1 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resultmerged1)) {
    				$worktable =$rowsmerged1['tablenamen'];
    				$GLOBALS['TYPO3_DB']->sql_query('OPTIMIZE TABLE '.$schema.'.' . $worktable . ';');
   					$GLOBALS['TYPO3_DB']->sql_query('REPAIR TABLE '.$schema.'.' . $worktable . ';');
   					$GLOBALS['TYPO3_DB']->sql_query('CHECK TABLE '.$schema.'.' .  $worktable . ';');
   					$GLOBALS['TYPO3_DB']->sql_query('ANALYZE TABLE '.$schema.'.' . $worktable . ';');
					$i++;
    		}

    		$infomessage = $i . ' ' . $GLOBALS['LANG']->getLL('tablesoptimized');
    		$infomessage = '<div class="tx-tc-messagebody">' . $infomessage . '</div><div class="tx-tc-messageclosebutton" title="'.$GLOBALS['LANG']->getLL('closemessage').'">x</div>';
    		$infomessage = '<div class="tx-tc-information">' . $infomessage . '</div>';
    		$newdataarray = $pObj->be_common->getOverviewSystemData ($pObj);
    	}

		$content .= $infomessage;
		$content .= $strbrbrdivend . '</div>';
		if (!$_POST['refreshdb']) {
		   	$content .= $strbrbrstart . '
				<span>
		    		<span id="admincommand56g906g9'.
		  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'" class="tx-tc-datarequester tx-tc-be-link tx-tc-be-bulkdatabase">

		  			<img id="padmincommand56g906g9'.
		  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'" class="tx-tc-datarequester tx-tc-be-link" align="left" '.
			'src="'.
					$GLOBALS['BACK_PATH'] . $pObj->picpathsysext . $pObj->iconRefresh . '" ' . $pObj->iconWidthHeight . 'title="'.
			    					$GLOBALS['LANG']->getLL('optimizetable').'" alt="" />' . $GLOBALS['LANG']->getLL('optimizetable') .
			    	'</span>
				</span>
			';
		}

	    unset($_POST['refreshdb']);
	    if (is_array($newdataarray)) {
	    	$content .= '6g9newdat6g9' . $pObj->be_common->human_filesize($newdataarray['datalength']) .
	    				'6g9newdat6g9' . $newdataarray['lastcheck'];
	    }
		return $content;

	}
}
?>