<?php
if (version_compare(TYPO3_version, '6.0', '<')) {
	require_once(t3lib_extMgm::extPath('lang', 'lang.php'));
} else {
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('lang') . 'Classes/LanguageService.php';
}

	/**
	 * [Describe function...]
	 *
	 */
class ux_tx_felogin_pi1 extends tx_felogin_pi1 {
	protected function processRedirect() {
		return array();;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$content: ...
	 * @param	[type]		$conf: ...
	 * @return	[type]		...
	 */
	public function main($content,$conf){
		$GLOBALS['TSFE']->additionalHeaderData[$this->prefixId]='<script src="'.$GLOBALS['TSFE']->tmpl->getFileName('EXT:toctoc_comments/res/js/tx-tc-ajaxfelogin.js').'" type="text/javascript"></script>';
		$prefix=$this->prefixId;

		$content=parent::main($content,$conf);
		if ($conf['toctoc_comments.']['fancybox.']['overlayColor']=='') {
			$conf['toctoc_comments.']['fancybox.']['overlayColor']='#000000';
		}
		if ($conf['toctoc_comments.']['fancybox.']['overlayOpacity']=='') {
			$conf['toctoc_comments.']['fancybox.']['overlayOpacity']='0.4';
		}
		if ($conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['NewAccount'] == '') {
			$conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['NewAccount'] = 'new account';
		}
		if ($conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'] == '') {
			$conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'] = $this->pi_getLL('ll_forgot_header', '', 1);
		}
		if ($conf['toctoc_comments.']['fancybox.']['pagewidthnewaccount']=='') {
			$conf['toctoc_comments.']['fancybox.']['pagewidthnewaccount']='450';
		}
		if ($conf['toctoc_comments.']['fancybox.']['pageheightnewaccount']=='') {
			$conf['toctoc_comments.']['fancybox.']['pageheightnewaccount']='450';
		}
		if ($conf['toctoc_comments.']['fancybox.']['pagewidthforgotpw']=='') {
			$conf['toctoc_comments.']['fancybox.']['pagewidthforgotpw']='350';
		}
		if ($conf['toctoc_comments.']['fancybox.']['pageheightforgotpw']=='') {
			$conf['toctoc_comments.']['fancybox.']['pageheightforgotpw']='250';
		}
		if ($conf['toctoc_comments.']['iframe.']['pagewidthnewaccount']=='') {
			$conf['toctoc_comments.']['iframe.']['pagewidthnewaccount']='450';
		}
		if ($conf['toctoc_comments.']['iframe.']['pageheightnewaccount']=='') {
			$conf['toctoc_comments.']['iframe.']['pageheightnewaccount']='450';
		}


		$hrefnewaccount='';
		if ($conf['toctoc_comments.']['fancybox.']['pageidnewaccount']=='') {
			$conf['toctoc_comments.']['fancybox.']['pageidnewaccount']='0';
		} else {

			if (intval($conf['toctoc_comments.']['useIFrameforSignUp'])==0) {
				if (intval($conf['toctoc_comments.']['fancybox.']['pageidnewaccount'])!=0) {
					$conflink = array(
						// Link to page
						'parameter' => $conf['toctoc_comments.']['fancybox.']['pageidnewaccount'],
						// Set no additional parameters
						'additionalParams' => '',
						// We must add cHash because we use parameters
						'useCashHash' => TRUE,
						// We want link only
						'returnLast' => 'url',
						'ATagParams' => 'rel="applist-1"',
					);
					$hrefnewaccount = $this->cObj->typoLink('', $conflink);
					$newuser='';
							// sign up link with fancybox
					if (intval($conf['toctoc_comments.']['fancybox.']['pageidforgotpw'])!=0) {
						$newuser='<br>';
					}
					$newuser .= '<a onmouseover="jQuery(\'a.applist\').fancybox({	\'titlePosition\' : \'outside\',\'overlayColor\' : \''.
					$conf['toctoc_comments.']['fancybox.']['overlayColor'].
					'\',\'overlayOpacity\' : \''.$conf['toctoc_comments.']['fancybox.']['overlayOpacity'].
					'\',\'hideOnContentClick\' : false,\'speedIn\' : \'300\',\'speedOut\' : \'300\',\'changeSpeed\': \'300\',\'easingIn\': \'swing\',\'easingOut\': \'swing\',\'transitionIn\' : \'elastic\',\'transitionOut\' : \'elastic\',\'type\' : \'iframe\',\'autoDimensions\' : false,\'width\' : '.
					$conf['toctoc_comments.']['fancybox.']['pagewidthnewaccount'].',\'height\' : '.$conf['toctoc_comments.']['fancybox.']['pageheightnewaccount'].
					',\'scrolling\' : \'auto\',\'titleShow\' : true,\'showNavArrows\' : false});" class="applist" rel="applist-6" href="'.
					$hrefnewaccount.'">'.
					$conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['NewAccount'].
					'</a>';
				}
				$newiframe='';
			} else {
				$conflink = array(
						// Link to page
						'parameter' => $conf['toctoc_comments.']['iframe.']['pageidnewaccount'],
						// Set no additional parameters
						'additionalParams' => '',
						// We must add cHash because we use parameters
						'useCashHash' => TRUE,
						// We want link only
						'returnLast' => 'url',
						'ATagParams' => '',
				);
				$hrefnewaccount = $this->cObj->typoLink('', $conflink);			// sign up link with fancybox
				$newuser='';
				$newiframe='<div class="tx-tc-login-form-iframe" id="tx-tc-iframesignup" style="display:none;"><iframe id="tx-tc-signupiframef" frameborder="0" class="tx-tc-signupiframe" scrolling="no" src="'.
						$hrefnewaccount.'" style="height:' .$conf['toctoc_comments.']['iframe.']['pageheightnewaccount'] .'px;" seamless></iframe></div>';
			}

		}
// forgot password link
		$hrefforgotpw='';
		$buttonnewaccount='';
		$forgotpw='';
		if ($conf['toctoc_comments.']['fancybox.']['pageidforgotpw']=='') {
			$conf['toctoc_comments.']['fancybox.']['pageidforgotpw']='0';

		} else {
			$params = '&' . $this->prefixId.'[forgot]=1';
			if (intval($conf['toctoc_comments.']['useIFrameforSignUp'])==0) {
				if (intval($conf['toctoc_comments.']['fancybox.']['pageidforgotpw']) != 0) {

					$conflink2 = array(
							// Link to current page
							'parameter' => $conf['toctoc_comments.']['fancybox.']['pageidforgotpw'],
							// Set additional parameters
							'additionalParams' => $params,
							// We must add cHash because we use parameters
							'useCashHash' => TRUE,
							// We want link only
							'ATagParams' => 'rel="applist-2"',
					);
					$hrefforgotpw = $this->cObj->typoLink($conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'], $conflink2);
					$hrefforgotpw = str_replace('<a ',
							'<a onmouseover="jQuery(\'a.applist\').fancybox({	\'titlePosition\' : \'outside\',\'overlayColor\' : \''.
							$conf['toctoc_comments.']['fancybox.']['overlayColor'].
							'\',\'overlayOpacity\' : \''.$conf['toctoc_comments.']['fancybox.']['overlayOpacity'].
							'\',\'hideOnContentClick\' : false,\'speedIn\' : \'300\',\'speedOut\' : \'300\',\'changeSpeed\': \'300\',\'easingIn\': \'swing\',\'easingOut\': \'swing\',\'transitionIn\' : \'elastic\',\'transitionOut\' : \'elastic\',\'type\' : \'iframe\',\'autoDimensions\' : false,\'width\' : '.
					        $conf['toctoc_comments.']['fancybox.']['pagewidthforgotpw'].',\'height\' : '.$conf['toctoc_comments.']['fancybox.']['pageheightforgotpw'].
							',\'scrolling\' : \'auto\',\'titleShow\' : true,\'showNavArrows\' : false});" class="applist" ',
							$hrefforgotpw);
					$forgotpw= str_replace('</a>','',$hrefforgotpw);
				}
				$iframeforgotpw='';
			} else {

				$conflink2 = array(
						// Link to current page
						'parameter' => $conf['toctoc_comments.']['iframe.']['pageidforgotpw'],
						// Set additional parameters
						'additionalParams' => $params,
						// We must add cHash because we use parameters
						'useCashHash' => TRUE,
						// We want link only
						'returnLast' => 'url',
						'ATagParams' => '',
				);
				//make iframe
				$hrefforiframe = $this->cObj->typoLink('', $conflink2);
				$iframeforgotpw='<div class="tx-tc-login-form-iframe-forgotpw" id="tx-tc-iframeforgotpw" style="display:none;"><iframe frameborder="0" class="tx-tc-signupiframe" scrolling="no" src="'.
						$hrefforiframe.'" style="height:' .$conf['toctoc_comments.']['iframe.']['pageheightforgotpw'] .'px;" seamless></iframe></div>';

				// make links for iframe-display
				if (intval($conf['toctoc_comments.']['iframe.']['pageidforgotpw']) !=0 ) {
					$hrefforgotpw = '<a  rel="nofollow" href="javascript:void(0)" style="display:block;" id="tx-tc-linkforgotpw" onclick="jQuery(\'#tx-tc-iframesignup\').css(\'display\', \'none\');

						jQuery(\'#tx-tc-iframeforgotpw\').css(\'display\', \'block\');
						jQuery(\'#tx-tc-linkfornewaccount\').css(\'display\', \'block\');
						jQuery(\'#tx-tc-linkforgotpw\').css(\'display\', \'none\');
						jQuery(\'#tx-tc-buttonfornewaccount\').css(\'display\', \'none\');
						" >' . $conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['forgotpw'] . '</a>';
				}
				if (intval($conf['toctoc_comments.']['iframe.']['pageidnewaccount']) !=0 ) {
				 	$hrefnewaccount = '<a  rel="nofollow" href="javascript:void(0)" style="display:none" id="tx-tc-linkfornewaccount" onclick="jQuery(\'#tx-tc-iframesignup\').css(\'display\', \'block\');
						jQuery(\'#tx-tc-iframeforgotpw\').css(\'display\', \'none\');
						jQuery(\'#tx-tc-linkfornewaccount\').css(\'display\', \'none\');
						jQuery(\'#tx-tc-linkforgotpw\').css(\'display\', \'block\');
				 		jQuery(\'#tx-tc-buttonfornewaccount\').css(\'display\', \'none\');
						" >' . $conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['NewAccount'] . '</a>';

				 	$buttonnewaccount = '<div class="tx-tc-login-form-iframe" id="tx-tc-buttonfornewaccount">
				 		<input type="button" id="tx-tc-buttonfornewaccount-bt"
				 		onclick="jQuery(\'#tx-tc-iframesignup\').css(\'display\', \'block\');
						jQuery(\'#tx-tc-iframeforgotpw\').css(\'display\', \'none\');
						jQuery(\'#tx-tc-linkfornewaccount\').css(\'display\', \'none\');
						jQuery(\'#tx-tc-linkforgotpw\').css(\'display\', \'block\');
						jQuery(\'#tx-tc-buttonfornewaccount\').css(\'display\', \'none\');
				 		" value="' . $conf['toctoc_comments.']['ll.'][$GLOBALS['TSFE']->lang . '.']['ButtonNewAccount'] . '"
				 				class="tx-tc-ct-submit tx-tc-login-button"  /></div>';
				 }

				$hrefnewaccount= str_replace('</a>','',$hrefnewaccount);

				$forgotpw=$hrefforgotpw.$hrefnewaccount;
			}

		}
		$contentforgotpwarr=explode('###DIV_BLOCKLINKS###',$content);

		if (count($contentforgotpwarr)>1) {
			$contentarrlink=explode('</a>',$contentforgotpwarr[1]);
			$contentarrlink[0]=$forgotpw;
			$contentforgotpwarr[1]=implode('</a>',$contentarrlink);
			$content=implode('###DIV_BLOCKLINKS###',$contentforgotpwarr);
		}

//watermark fe_login
		if ($conf['toctoc_comments.']['watermark']==1) {
			$contentarr=explode('<label class="tx-tc-ct-label"',$content);
			for ($i=1;$i<count($contentarr);$i++) {
				$contentarrlabel=explode('">',$contentarr[$i]);
				$contentarrlabeltext=explode('</label>',$contentarrlabel[1]);
				$contentlabeltext=$contentarrlabeltext[0];
				$contentlabeltext=str_replace(':','',$contentlabeltext);
				$contentarrrest=array();
				$contentarrrest=explode('</label>',$contentarr[$i]);
				if (count($contentarrrest)>1) {
					$contentarr[$i]=$contentarrrest[1];
				}
				if (count($contentarrrest)>2) {
					for ($j=2;$j<count($contentarrrest);$j++) {
							$contentarr[$i].='</label>'.$contentarrrest[$j] ;
					}
				}
				$contentarr[$i]=str_replace('<input class="tx-tc-ct-input"','<input class="tx-tc-ct-input" placeholder="' . $contentlabeltext . '" ',$contentarr[$i]);
				//print $contentlabeltext .'<br>';exit;
			}
			$content=implode('',$contentarr);
		}
		$stylepassdiv = '';
		if ((intval($conf['toctoc_comments.']['fancybox.']['pageidnewaccount']) + intval($conf['toctoc_comments.']['fancybox.']['pageidnewaccount'])) == 0) {
			if (intval($conf['toctoc_comments.']['useIFrameforSignUp'])==0) {
				$stylepassdiv= ' style="display:none;"' ;
			}
		}
		if ((intval($conf['toctoc_comments.']['iframe.']['pageidnewaccount']) + intval($conf['toctoc_comments.']['iframe.']['pageidnewaccount'])) == 0) {
			if (intval($conf['toctoc_comments.']['useIFrameforSignUp'])==1) {
				$stylepassdiv= ' style="display:none;"' ;
			}
		}
		if (intval($conf['toctoc_comments.']['useIFrameforSignUp'])==0) {

			$passdivtogether='<div class="tx-tc-login-form-field" ' . $stylepassdiv . ' id="tx-tc-forgotpw">';
			$passdivseparated='';
			$addformstyle='';
		} else {
			$passdivtogether='<div class="tx-tc-login-form-field-fr" ' . $stylepassdiv . ' id="tx-tc-forgotpw">';
			$passdivseparated='';
			$addformstyle='';
		}

		$content=strtr($content,array(
			'###FORM_ID###'=>$prefix.'_form',
			'###FORM_SUBMIT###'=>'',
			'###DIV_BLOCKLINKS###'=>$passdivtogether,
			'###ADDFORMSTYLE###' => $addformstyle,
			'###SUBMIT_ONCLICK###'=>'return ttc_ajaxfelogin(this);',
			'###FORM_ONMOUSEOVER###'=>'txtc_feloginobj=this;',
			'###NEWUSER###' => $newuser,
			'###IFRAME###' => $buttonnewaccount . $newiframe . $iframeforgotpw,));

		$redirect=false;
		// Redirect
		if ($this->conf['redirectMode'] && !$this->conf['redirectDisable'] && !$this->noRedirect) {
			$redirectUrl = parent::processRedirect();
			if (count($redirectUrl)) {
				$this->redirectUrl = $this->conf['redirectFirstMethod'] ? array_shift($redirectUrl) : array_pop($redirectUrl);
			} else {
				$this->redirectUrl = '';
			}
		}
		// Process the redirect
		if (($this->logintype === 'login' || $this->logintype === 'logout') && $this->redirectUrl && !$this->noRedirect) {
			if (!$GLOBALS['TSFE']->fe_user->cookieId) {
				$content .= $this->cObj->stdWrap($this->pi_getLL('cookie_warning', '', 1), $this->conf['cookieWarning_stdWrap.']);
			} else {
				$redirect=$this->redirectUrl;
			}
		}

		if($this->piVars['ajax']){
			if($this->piVars['ajax']==$prefix){
				$response->redirect=$redirect;
				$response->data=$content;
				echo json_encode($response);
				die();
			}else{
				return;
			}
		}
		if($redirect) {
			t3lib_utility_Http::redirect($redirect);
		}
		$content='<div id="'.$prefix.'">'.$content.'</div>';
		$content.='<div id="'.$prefix.'_indication" style="display: none;"></div>';
		return $content;
	}
}
?>