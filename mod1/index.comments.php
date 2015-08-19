<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2015 Gisele Wendl <gisele.wendl@toctoc.ch>
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

	$editTable = 'tx_toctoc_comments_comments';

    // "Create New" Button
    // params = Create New
    $params = '&edit['.$editTable.']['.$pid.']=new&defVals['.$editTable.']';
    $content .= '<a href="#" onclick="'.htmlspecialchars(t3lib_BEfunc::editOnClick($params, $GLOBALS['BACK_PATH'])).'">
    <img src="sysext/t3skin/icons/gfx/new_el.gif" title="'.$GLOBALS['LANG']->getLL('newcomment').'" border="0" alt="" />
    </a><br /><br />';
	$infomessage = '';
	$alertmsg = 0;
    // Bulk actions
    if($_POST['actmul']) {
    	$fields = array();
    	if (isset($_POST['fields'])) {
    		if (is_array($_POST['fields'])) {
    			$fields = $_POST['fields'];
    		}
    	}
    	$numcomments = count($fields);
    	if ($numcomments > 0) {
			$fields_new = '';
			foreach($fields as $field)$fields_new .= ','.intval($field);
			$fields_new = substr($fields_new, 1);

			// Approve
			if($_POST['bulkact'] == '1') {
			  	$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET approved=1 WHERE uid IN ('.
			  			$fields_new.')');
			  	$infomessage = $GLOBALS['LANG']->getLL('approved1');
			  	if ($numcomments !=1){
			  		$infomessage = sprintf($GLOBALS['LANG']->getLL('approvedn'), $numcomments);
			  	}

			} elseif($_POST['bulkact'] == '2') {
			// Disapprove
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET approved=0 WHERE uid IN ('.
						$fields_new.')');
				$infomessage = $GLOBALS['LANG']->getLL('disapproved1');
				if ($numcomments !=1){
					$infomessage = sprintf($GLOBALS['LANG']->getLL('disapprovedn'), $numcomments);
				}

			} elseif($_POST['bulkact'] == '3') {
			// Hide
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET hidden=1 WHERE uid IN ('.
						$fields_new.')');
				$infomessage = $GLOBALS['LANG']->getLL('hidden1');
				if ($numcomments !=1){
					$infomessage = sprintf($GLOBALS['LANG']->getLL('hiddenn'), $numcomments);
				}

			} elseif($_POST['bulkact'] == '4') {
			// Show
			  	$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET hidden=0 WHERE uid IN ('.$fields_new.')');
				$infomessage = $GLOBALS['LANG']->getLL('unhide1');
				if ($numcomments !=1){
					$infomessage = sprintf($GLOBALS['LANG']->getLL('unhiden'), $numcomments);
				}

			} elseif($_POST['bulkact'] == '5') {
			// Delete
				$upd = $GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_comments SET deleted=1 WHERE uid IN ('.$fields_new.')');
				$infomessage = $GLOBALS['LANG']->getLL('commentsdelete1');
				if ($numcomments !=1){
					$infomessage = sprintf($GLOBALS['LANG']->getLL('commentsdeleten'), $numcomments);
				}

			}
			$infomessage .= '<br>';
			$infomessage .= $GLOBALS['LANG']->getLL('donelist') . ': ' . $fields_new;
			$cachemessage ='';

			if ((intval($_POST['bulkact']) >= 1) && (intval($_POST['bulkact']) <= 5)) {

				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('DISTINCT external_ref_uid, external_ref, external_prefix', 'tx_toctoc_comments_comments', 'uid IN ('.$fields_new.')', '', '');
				$num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
				$cpidList = '';
				$external_ref_uidList = '';
				if (intval($num_rows) > 0) {
					$cachemessage .= '<br>';
					while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
						$external_ref_uid = $row['external_ref_uid'];

						if ($row['external_prefix'] == 'pages') {
							$cpidList .= ',' . intval(substr($row['external_ref'], 6));
						} else {
							$contentelementid = intval(substr($row['external_ref_uid'], 11));
							$page_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('pid', 'tt_content', 'uid='.$contentelementid);

							while($row_page=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($page_res)) {
								$cpidList .= ',' . $row_page['pid'];
							}
						}

						$res2 = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_plugincachecontrol', 'external_ref_uid="'.
								$external_ref_uid.'"', '', '');
						$num_rows2 = $GLOBALS['TYPO3_DB']->sql_num_rows($res2);
						if ($num_rows2>0) {
							$GLOBALS['TYPO3_DB']->sql_query('UPDATE tx_toctoc_comments_plugincachecontrol SET ' .
									'tstamp=' . time() .
									' WHERE external_ref_uid ="' . $external_ref_uid . '"');
							$external_ref_uidList .= ', ' . $external_ref_uid;
						} else {
							$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_toctoc_comments_plugincachecontrol',
									array(
											'tstamp' => time(),
											'external_ref_uid' => $external_ref_uid,
									)
							);
							$external_ref_uidList .= ', ' . $external_ref_uid;
						}

					}
					$external_ref_uidList = substr($external_ref_uidList, 1);
					$extArr = explode(',', $external_ref_uidList);
					$extArr = array_unique($extArr);
					$external_ref_uidList = implode (',', $extArr);
					$cachemessage .= 'Reset plugincachecontrol for ' . $external_ref_uidList;
					$cpidList = substr($cpidList, 1);
					$cpidArr = explode(',', $cpidList);
					$cpidArr = array_unique($cpidArr);
					$cpidList = implode (',', $cpidArr);
					$cachemessage .= '<br />Clear pagecache for pages ' . $cpidList;
					if (version_compare(TYPO3_version, '6.0', '<')) {
						t3lib_div::requireOnce(PATH_t3lib . 'class.t3lib_tcemain.php');
					} else {
						require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('core') . 'Classes/DataHandling/DataHandler.php';
					}

					$tce = t3lib_div::makeInstance('t3lib_TCEmain');

					/* @var $tce t3lib_TCEmain */
					foreach ($cpidArr as $cpid) {
						if ($cpid != 0) {
							if (intval($this->vmcNPC) == 0) {
								$tce->clear_cacheCmd($cpid);
							}

						}

					}
					unset($tce);
				}

			}

    	} else {
	      	$infomessage = $GLOBALS['LANG']->getLL('nocommentsselected');
	      	$alertmsg = 1;
    	}
    }
    if ($this->showcachemessage == FALSE) {
    	$cachemessage='';
    }
    if ($infomessage != '') {
    	if ($alertmsg == 1) {
    		$infomessage = '<div class="tx-tc-alert">' . $infomessage . '</div>';
    	} else {
    		$infomessage = '<div class="tx-tc-information">' . $infomessage . $cachemessage . '</div>';
    	}

    }
    unset($_POST['actmul']);
    unset($_POST['bulkact']);
    unset($_POST['fields']);

    $content .= $infomessage;
		// Show all comments on root page
    if($pid == '0') {
      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0', '', '');
    }

    // Show comments on page
    else {
      $page_array = array();
      $page_array[] = $pid; // Insert active pid in array
      // Show comments in subpages, if activated in ext manager
      if($this->extConf['show_sub'] == 1) {
	$page_res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'deleted=0 AND pid='.$pid);

	while($row_page=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($page_res)) {
	  $page_array[] = $row_page['uid'];
	}
      }
      $pages = implode(',', $page_array);
      $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_toctoc_comments_comments', 'deleted=0 AND pid IN ('.$pages.')', '', '');
    }

    $num_rows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

    // No Comment
    if ($num_rows == '') {
      $content .= ''.$GLOBALS['LANG']->getLL('nocomment').'<br /><br />';
    }

    // Root Page and 1 Comment
    else if ($num_rows == '1' && $pid == '0') {
      $content .= ''.$GLOBALS['LANG']->getLL('commentglobal_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('commentglobal_two').'<br /><br />';
    }

    // Root Page and more than 1 Comment
    else if ($num_rows > '1' && $pid == '0') {
      $content .= ''.$GLOBALS['LANG']->getLL('commentglobalmore_one').'<b> '.$num_rows.'</b> '.
      				$GLOBALS['LANG']->getLL('commentglobalmore_two').'<br /><br />';
    }

    // 1 Comment
    else if ($num_rows == '1') {
      $content .= ''.$GLOBALS['LANG']->getLL('onecomment_one').'<b> '.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('onecomment_two').'<br /><br />';
    }

    // More Comments
    else {
      $content .= ''.$GLOBALS['LANG']->getLL('morecomments_one').' <b>'.$num_rows.'</b> '.$GLOBALS['LANG']->getLL('morecomments_two').'<br /><br />';
    }

  // Show Table Head only if at least 1 Comment exists.
  if($num_rows >= '1') {
  $content .= '
    <fieldset>
      <table id="tablesorter-demo" class="tablesorter">
      <thead>
	<tr>
	  <th class="id">'.$GLOBALS['LANG']->getLL('id').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('pid').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('date').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('name').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('comment').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('approveboth').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('hideshow').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('edittwo').'</th>
	  <th>'.$GLOBALS['LANG']->getLL('deletetwo').'</th>
	  <th><input type="checkbox" class="checkall" title="'.$GLOBALS['LANG']->getLL('check_all').'"></th>
	</tr>
	</thead>';
	}

	while($row=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
	  // Get the fields
	  $editTable = 'tx_toctoc_comments_comments';
	  $editUid = $row['uid'];
	  $pid_record = $row['pid'];
	  $hiddenField = 'hidden';
	  $approvedField = 'approved';
	  $name = ''.$row['firstname'].' '.$row['lastname'].'';
	  $comment_txt=htmlspecialchars($row['content']);
	  if (strlen($comment_txt)>$text_crop) {

		$textcroppedleft = substr($comment_txt, 0, $text_crop);
		$textcroppedright = substr($comment_txt, $text_crop);
		$textcroppedrightarr = explode(' ', $textcroppedright);
		if (count($textcroppedrightarr)>1) {

			$textcroppedleft .=$textcroppedrightarr[0] . ' ... ';

		} else {
			$textcroppedleft .=$textcroppedright;
		}
		$comment_txt =$textcroppedleft;
	  }
	  $comment_txt_crop = ''.$comment_txt;

	  $tstamp = $row['crdate'];
	  $time = date('Y-m-d H:i:s', $tstamp);
	  //$time = '' . date('d.m.Y', $tstamp) . ' - ' . date('H:i', $tstamp) . '';

	  /*
	  params2 = Edit
	  params3 = Delete
	  params4 = Hide
	  params5 = Show
	  params6 = Disapprove
	  params7 = Approve
	  */

	  // Get the params
	  $params2 = '&edit['.$editTable.']['.$editUid.']=edit';
	  $params3 ='&cmd['.$editTable.']['.$editUid.'][delete]=1';
	  $params4 ='&data['.$editTable.']['.$editUid.']['.$hiddenField.']=0';
	  $params5 ='&data['.$editTable.']['.$editUid.']['.$hiddenField.']=1';
	  $params6 ='&data['.$editTable.']['.$editUid.']['.$approvedField.']=0';
	  $params7 ='&data['.$editTable.']['.$editUid.']['.$approvedField.']=1';

	  $this->currentTable = 'tx_toctoc_comments_comments';

	$content .= '

	<tr>
	  <td class="img">'.$editUid.'</td>
	  <td>'.$pid_record.'</td>
	  <td class="date">'.$time.'</td>
	  <td class="name">'.$name.'</td>
	  <td>'.$comment_txt_crop.'</td>

	  ';

	  if ($row[$approvedField])	{
	    $content .='
	      <td class="img"><a href="'.$this->doc->issueCommand($params6).'">
	      <img src="'.$GLOBALS['BACK_PATH'].'../typo3conf/ext/toctoc_comments/icon_tx_toctoc_comments.gif" border="0" title="'.
	      $GLOBALS['LANG']->getLL('disapprove').'" align="top" alt=""
	      /></a></td>
	    ';
	  }

	  else {
	    $content .= '
	      <td class="img"><a href="'.$this->doc->issueCommand($params7).'">
	      <img src="'.$GLOBALS['BACK_PATH'].'../typo3conf/ext/toctoc_comments/icon_tx_toctoc_comments_not_approved.gif" border="0" title="'.
	    $GLOBALS['LANG']->getLL('approve').'" align="top" alt="" /></a></td>';
	  }

	  if ($row[$hiddenField])	{
	    $content .='
	      <td class="img"><a href="'.$this->doc->issueCommand($params4).'">
	      <img src="'.$GLOBALS['BACK_PATH'].'sysext/t3skin/icons/gfx/button_unhide.gif" border="0" title="'.
	      $GLOBALS['LANG']->getLL('show').'" align="top" alt=""
	      /></a></td>
	    ';
	  }

	  else {
	    $content .= '
	      <td class="img"><a href="'.$this->doc->issueCommand($params5).'">
	      <img src="'.$GLOBALS['BACK_PATH'].'sysext/t3skin/icons/gfx/button_hide.gif" border="0" title="'.
	    $GLOBALS['LANG']->getLL('hide').'" align="top" alt="" /></a></td>';
	  }
	  
	  if (version_compare(TYPO3_version, '6.3', '>')) {
	  	(class_exists('t3lib_iconWorks', FALSE) || interface_exists('t3lib_iconWorks', FALSE)) ? TRUE : class_alias('\TYPO3\CMS\Backend\Utility\IconUtility', 't3lib_iconWorks');
	  }
	  
	  $content .= '
	    <td class="img"><a href="#" onclick="'.htmlspecialchars(t3lib_BEfunc::editOnClick($params2, $GLOBALS['BACK_PATH'])).'">
	      <img'.t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'], 'gfx/edit2.gif', 'width="11" height="12"').' title="'.
	      $GLOBALS['LANG']->getLL('edit').'" border="0" alt="" /></a>
	    </td>
	    <td class="img"><a href="'.$this->doc->issueCommand($params3).'"
	      onclick="return confirm(unescape(\''.rawurlencode(''.$GLOBALS['LANG']->getLL('delete_txt').'').'\'));">
	      <img'.t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'], 'gfx/garbage.gif', 'width="11" height="12"').' title="'.
	      $GLOBALS['LANG']->getLL('delete').'" alt="" /></a>
	    </td>
	    <td>
	      <input type="checkbox" name="fields[]" value="'.$editUid.'" />
	    </td>';

	  $content .= '
	    </tr>
	  ';
	}

	$content .= '
	  </table>
	  </fieldset>
	  <hr style="margin-top: 5px; margin-bottom: 5px;"/>
	';

	if($num_rows != 0) {
	  $content .= '
	  <div class="pagenav">
	    <div id="pager" class="pager">
	      
		<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/first.png" class="first" />
		<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/prev.png" class="prev" />
		<input type="text" class="pagedisplay"/>
		<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/next.png" class="next" />
		<img src="../typo3conf/ext/toctoc_comments/mod1/img/pager/last.png" class="last" />
		<span class="show_comments">'.$GLOBALS['LANG']->getLL('show_comments').'</span>
		<select class="pagesize">
	    ';

	    $select_val = trim($this->extConf['select_val']);
	    $select_val_arr = explode(',', $select_val);
	    $select_val_arr[] = $max_records; // Add starting value defined in ext manager
	    rsort($select_val_arr); // Sort array
	    $select_val_arr_unique = array_unique($select_val_arr);

	    // Build selectbox
	    foreach($select_val_arr_unique as $o) {
	      // Highlight starting value
	      if($o == $max_records) {
		$content .= '
				<option value="'.$o.'" selected="selected">'.$o.'</option>
		';
	      } elseif($o == '') {
		// Do nothing if array value is empty
		$content .= '';
	      } else {
		$content .= '
				<option value="'.$o.'">'.$o.'</option>
		';
	      }
	    }

	    $content .= '
		</select>
	      
	    </div>
	  </div>
	  ';
	}

	$content .= '
	<div class="div-float">
	  '.$GLOBALS['LANG']->getLL('bulkact').'
	  <select name="bulkact" size="1">
	    <option value="1">'.$GLOBALS['LANG']->getLL('bulkact_one').'</option>
	    <option value="2">'.$GLOBALS['LANG']->getLL('bulkact_two').'</option>
	    <option value="3">'.$GLOBALS['LANG']->getLL('bulkact_three').'</option>
	    <option value="4">'.$GLOBALS['LANG']->getLL('bulkact_four').'</option>
	    <option value="5">'.$GLOBALS['LANG']->getLL('bulkact_five').'</option>
	  </select>
	  <input type="submit" name="actmul" value="'.$GLOBALS['LANG']->getLL('go').'" onclick="return confirm(unescape(\''.
	  rawurlencode(''.$GLOBALS['LANG']->getLL('mul_txt').'').'\'));" />
	</div>
	<div class="clearit">&nbsp;</div>
	';

	$this->content.=$this->doc->section('', $content, 0, 1); 			   
?>