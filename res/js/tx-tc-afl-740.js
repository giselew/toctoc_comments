/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2014 Gisele Wendl <gisele.wendl@toctoc.ch>
*  toctoc_comments ajaxlogin javascript file, located in the head of the HTML document
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

function ttc_autoajaxfelogin(txtc_feloginautouser,txtc_feloginautopass){
	document.getElementById('user').value=txtc_feloginautouser;
	document.getElementById('pass').value=txtc_feloginautopass;
	var obj=document.getElementById('tx_toctoccomments_pi2_submit');
	ttc_ajaxfelogin(obj);
}
function successlogin (response,standalone,commentid,loadinghtml,ttrid,ttcontentid,objformserializedArray,objname,prefix,objformaction,objformid ) {
	if (response['redirect']){
		//window.location.href=response['redirect'];
	} else {
		var htmlforform='';
		if (standalone == 0) {
			// from inside toctoc_comments
			jQuery('#formhider-'+commentid).html(loadinghtml);
			jQuery('#formhider-'+commentid).css('min-height','40px');
			var htmlforformformhider=(response['data']).replace('tx_toctoccomments_pi2_formlo','tx_toctoccomments_pi2_formlog');
			loggedinarr = (response['data']).split('Youre logged in');
			if (loggedinarr.length>1) {
				if (ttrid !=='') {
					jQuery('#'+objformid).css('display','none');
					htmlforform=htmlforformformhider.replace('id=\"tx-tc-loginform\"','id=\"tx-tc-loginform-2\"');
					htmlforform=htmlforform.replace('tx_toctoccomments_pi2_formlog','tx_toctoccomments_pi2_formlogout');
					htmlforform= htmlforform.replace('Youre logged in.','');
					tclogincarddec=htmlforform;
					toctoc_comments_refresh(ttrid,ttcontentid,commentid);
					newqrystr = jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix;
					if (response['refresh'] != '') {
						// getting page parts if requested in response['refresh']
						refreshidlist = (response['refresh']).split(',');
						newqrystr = newqrystr.replace('&logintype=login','');
						newqrystr = newqrystr + '&refreshcontent=refresh';
						jQuery.ajax({
							type: 'POST',
							url: objformaction,
							asych: true,
							data: newqrystr,
							success: function(data) {	
									for (ix=0; ix < refreshidlist.length; ix++) {
										refreshidlist[ix]=tctrim(refreshidlist[ix]);
										setAJAXhtml(refreshidlist[ix], data);
									}

							}
						});
					}

					// user defined JS goes here (after success for login from inside toctoc_comments)

				}

			} else {
				if (ttrid !=='') {

					jQuery('#formhider-'+commentid).css("opacity","0");
					jQuery('#formhider-'+commentid).html(htmlforformformhider);
					toctoc_comments_fadein('formhider-'+commentid);
					tt_showloginbind();
					rebindanswersignup();

					// user defined JS goes here (after error from login attempt from inside toctoc_comments)
				}
			}
			lougoutelem = document.getElementById('tx-tc-loginout');
			if (lougoutelem) {
				jQuery('#tx-tc-loginout').css("opacity","0");
				toctoc_comments_fadein('tx-tc-loginout');
			}

		} else {
			htmlforformformhider=response['data'];
			htmlforformformhider= (response['data']).replace('Youre logged in.','');
			tclogincarddec=htmlforformformhider;
			var loginisok = 0;
			if (htmlforformformhider == response['data']) {
				htmlforformformhider=htmlforformformhider.substr(String('<div class="tx-tc-loginform" id="tx-tc-loginform">').length+6);
			} else {
				loginisok = 1;
			}

			jQuery('#tx-tc-loginform').html(htmlforformformhider);
			tt_showloginbind();
			if (htmlforformformhider != response['data']) {
				$('#tx-tc-loginform').css("opacity","0");
				window.setTimeout("toctoc_comments_fadein('tx-tc-loginform');",100);
				newqrystr = jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix;
				if (response['refresh'] != '') {
					refreshidlist = (response['refresh']).split(',');
					newqrystr = newqrystr.replace('&logintype=login','');
					newqrystr = newqrystr + '&refreshcontent=refresh';
					jQuery.ajax({
						type: 'POST',
						url: objformaction,
						data: newqrystr,
						success: function(data) {
							
							for (ix=0; ix < refreshidlist.length; ix++) {
									refreshidlist[ix]=tctrim(refreshidlist[ix]);
									setAJAXhtml(refreshidlist[ix], data);
							}
							if (sendbackafterloginout == 1) {
								if (loginisok == 1) {
									window.history.back();		
								}
							} 
						}
					});
				}

			}

			// from stand alone
			// user defined JS goes here (after loginattempt from stand alone version)
			// please add the according logic for distinction of successfull logins according to the exemple above
		}

		jQuery('#tx-tc-loginlogoutinprogress').css('display','none');
		jQuery('#tx-tc-loginlogoutinprogress').removeClass("tx-tc-blockdisp");
		jQuery('#tx-tc-loginlogoutinprogress').addClass("tx-tc-nodisp");

	}
}
function ttc_ajaxfelogin(obj, islogout, fblogin, encuser){
	// Login
	var prefix=obj.form.id.substr(0,obj.form.id.length-5);
	var thechild=document.getElementById(obj.form.id);
	var objformid = obj.form.id;
	
	var objformaction = obj.form.action;
	objformaction = objformaction.replace('%5B','[');
	objformaction = objformaction.replace('%5D',']');
	var objformserializedArray = jQuery(obj.form).serializeArray();
	var objname = obj.name;	
	jQuery('#'+obj.form.id).css('opacity','0.6');
	
	if (String(obj.form.onsubmit).replace('tx_rsaauth_feencrypt','') != String(obj.form.onsubmit)) {
		if (!fblogin) {
			var rsaparam ='&getrsahash=1';
			var rsaresponse = [];
			rsaresponse['onSubmit'] = '';
			rsaresponse['extraHidden'] = '';
			jQuery.ajax({
				type: 'POST',
				url: objformaction,
				async: false,
				data: jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix+rsaparam,
				success: function(data) {
					var respfromserver = utf8_decode(tcb64_dec(data));
					var respfromserverarr = respfromserver.split('toctoc-data-sep');
					rsaresponse['onSubmit'] = respfromserverarr[0];
					rsaresponse['extraHidden'] = respfromserverarr[1];
				},
				error: function (request, status, error) {
					var respfromserver = utf8_decode(tcb64_dec(request.responseText));
					var respfromserverarr = respfromserver.split('toctoc-data-sep');
					rsaresponse['onSubmit'] = respfromserverarr[0];
					rsaresponse['extraHidden'] = respfromserverarr[1];
			    }
			});
			var rsavaluearr = rsaresponse['extraHidden'].split('value="');
			var extrrahiddenOne = rsavaluearr[1].split('"')[0];
			var extrrahiddenTwo = rsavaluearr[2].split('"')[0];
			document.getElementById('rsa_n').value = extrrahiddenOne;
			document.getElementById('rsa_e').value = extrrahiddenTwo;
			objformserializedArray = jQuery(obj.form).serializeArray();
			tx_rsaauth_feencrypt(obj.form);
		}
		
		objformserializedArray = jQuery(obj.form).serializeArray();
	}

	if ((islogout != 1) && (!fblogin)) {
		if (document.getElementById('user').value == '') {
			return;
		}

		if (document.getElementById('pass').value == '') {
			return;
		}

	}
	var fbparam = '';
	if (fblogin == 'fbLogin') {
		fbparam = '&tx_toctoccomments_pi2[fbLogin]=1';
	}
	if (fblogin == 'googleLogin') {
		fbparam = '&tx_toctoccomments_pi2[googleLogin]=1&tx_toctoccomments_pi2[googleEncUser]=' + encuser;
	}
	

	ttid='';
	ttrid='';
	ttcontentid='';
	commentid='';
	var dobreak=0;
	for (i=1;i<10;i++) {
		tr = thechild.parentNode;
		if (tr) {
			if (tr.hasAttribute) {
				if (tr.hasAttribute('id')) {
					ttid=tr.getAttribute('id');
					ttrid = ttid.replace('tx-tc-cts-dp-','');
					ttcontentidtest =ttid.replace('tx-tc-formsqueezer-','');
					if (ttcontentidtest!==ttid) {
						commentid=ttcontentidtest;
						ttcontentidtestarr = ttcontentidtest.split('6g9');
						ttcontentid=ttcontentidtestarr[0];
					}
					if (ttid!==ttrid) {
						dobreak=1;
					} else {
						ttrid = ttid.replace('tx-tc-form-dp-','');
						if (ttid!==ttrid) {
							dobreak=1;
						}
					}
					if (dobreak===1) {
						break;
					}
					ttid='';
					ttrid='';
				}
			}
			thechild=tr;
		}

	}
	var standalone=0;
	if (ttrid!=='') {
		// from toctoc_comments
		var idnrpos = ttrid.lastIndexOf('_');
		var idnr = ttrid.substr(idnrpos+1);
		var idnrtestarr = idnr.split('6g9');
		if (idnrtestarr.length >1) {
			idnr=idnrtestarr[0];
			ttrid=ttrid.substr(0,(idnrpos+1)) + idnr;
		}

		standalone=0;
	} else {
		standalone=1;
	}
	var newqrystr = '';
	var refreshidlist = [];
	tttip('hide');
	if (islogout == 1) {
		//call directly from the submit button of the logout form
		tt_logout(idnr, ttrid);
	} else {
		var loadinghtml=document.getElementById('tx-tc-loginlogoutinprogress').innerHTML;
		if (standalone == 0) {
			jQuery('#formhider-'+commentid).html(loadinghtml);
			jQuery('#formhider-'+commentid).css('min-height','40px');
		}

		jQuery.ajax({
			type: 'POST',
			url: objformaction,
			async: false,
			data: jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix+fbparam,
			success: function(data) {
				var respfromserver = utf8_decode(tcb64_dec(data));
				var response = [];
				var respfromserverarr = respfromserver.split('toctoc-data-sep');
				response['redirect'] = respfromserverarr[0];
				response['data'] = respfromserverarr[1];
				response['refresh'] = respfromserverarr[2];
				successlogin(response,standalone,commentid,loadinghtml,ttrid,ttcontentid,objformserializedArray,objname,prefix,objformaction,objformid );
			},
			error: function (request, status, error) {
				var respfromserver = utf8_decode(tcb64_dec(request.responseText));
				var response = [];
				var respfromserverarr = respfromserver.split('toctoc-data-sep');
				response['redirect'] = respfromserverarr[0];
				response['data'] = respfromserverarr[1];
				response['refresh'] = respfromserverarr[2];
				successlogin(response,standalone,commentid,loadinghtml,ttrid,ttcontentid,objformserializedArray,objname,prefix,objformaction,objformid );
		    }
		});
	}
	return false;
}
function setAJAXhtml(refreshid, data) {
	// extacts the HTML for a given refreshid from data
	var data1 = data.split('id="'+refreshid+'"');
	if (data1.length==2) {
		var data1left = data1[0].split('<');
		var data1leftlast = (data1left[data1left.length-1]).split(' ');
		var data1tag = data1leftlast[0];
		var dataright = data1[1].split('</' + data1tag);
		if (dataright.length>1) {
			// its an id of a tag with an endtag
			var dataafterstarttag = data1[1].substr(((data1[1].split('>'))[0]).length+1);
			var datauptoendtag = dataafterstarttag.split('</' + data1tag);
			var datauptostarttag = dataafterstarttag.split('<' + data1tag);
			var tonextstarttaglength= ('<' + data1tag + datauptostarttag[0]).length;
			var tonextengtaglength= datauptoendtag[0].length;
			var endtagfound =0;
			var isrch=0;
			var outhtml ='';
			if (tonextstarttaglength > tonextengtaglength) {
				outhtml =datauptoendtag[0] + '</' + data1tag + '>';
			} else {
				while (endtagfound !=1) {
					if (tonextstarttaglength > tonextengtaglength) {
						endtagfound =1;
					} else {
						while (tonextstarttaglength < tonextengtaglength) {
							outhtml = outhtml + datauptoendtag[isrch] + '</' + data1tag;
							tonextstarttaglength = tonextstarttaglength + ('<' + data1tag + datauptostarttag[isrch+1]).length;
							tonextengtaglength = tonextengtaglength + (datauptoendtag[isrch+1] + '</' + data1tag ).length;
							isrch++;
						}
						outhtml = outhtml + datauptoendtag[isrch] + '</' + data1tag;
					}

				}
				outhtml =outhtml + '>';
			}
		} else {
			// single tag like img
			outhtml=  '<' + data1left[data1left.length-1] + '"' + refreshid + '"' + (data1[1].split('>'))[0];
		}

		$('#'+refreshid).html(outhtml);

	} else {
		var obj = document.getElementById(refreshid);
		if (obj) {
			obj.outerHTML = '';
		}
	}
	return false;
}

function tt_logout(idnr, ttrid) {
	// logout
	// function triggered from the log out link in the toctoc_Comments plugin
	// idnr: example '10046g92966g9', ttrid: tt_content_1004
	var standalone = 0;
	var objhtml = '';
	if (tclogincarddec !='') {
		objhtml = tclogincarddec;
	} else {
		objhtml = utf8_decode(tcb64_dec(tclogincard));
	}

	document.body.innerHTML += '<div id="frmtmplogout" class="tx-tc-nodisp">' + objhtml + '</div>';
	if (ttrid=='') {
		//stand alone
		standalone = 1;
	} else {
		// from toctoc_comments
		var commentid = idnr;
		var idnrpos = ttrid.lastIndexOf('_');
		var idnrtestarr = idnr.split('6g9');

		if (idnrtestarr.length >1) {
			idnr = idnrtestarr[0];
			ttrid = ttrid.substr(0,(idnrpos+1)) + idnr;
		}

		ttcontentid = idnr;
	}
	var obj = document.getElementById('tx_toctoccomments_pi2_formlogout_submit');
	if (standalone == 0) {
		var loadinghtml = document.getElementById('tx-tc-loginlogoutinprogress-' +commentid).innerHTML;
	}

	var inith =0;
	if (standalone===0) {
		inith = parseInt(document.getElementById('cf'+commentid).offsetHeight) - 10 - parseInt(document.getElementById('textarea-'+commentid).offsetHeight);
		jQuery('#formhider-'+commentid).html(loadinghtml);
		jQuery('#tx-tc-div-submit'+commentid).css('display','none');
		jQuery('#formhider-'+commentid).css('min-height',inith+'px');
	}

	var refreshidlist = [];
	var newqrystr=jQuery.param(jQuery(obj.form).serializeArray())+'&'+obj.name+'=1&tx_toctoccomments_pi2[ajax]=tx_toctoccomments_pi2';
	var objformaction = obj.form.action;
	objformaction = objformaction.replace('%5B','[');
	objformaction = objformaction.replace('%5D',']');

	var objformid = obj.form.id;
	tttip('hide');
	jQuery.ajax({
		type: 'POST',
		url: objformaction,
		data: jQuery.param(jQuery(obj.form).serializeArray())+'&'+obj.name+'=1&tx_toctoccomments_pi2[ajax]=tx_toctoccomments_pi2',
		success: function(data) {
			var respfromserver = utf8_decode(tcb64_dec(data));
			var response = [];
			var respfromserverarr = respfromserver.split('toctoc-data-sep');
			response['redirect'] = respfromserverarr[0];
			response['data'] = respfromserverarr[1];
			response['refresh'] = respfromserverarr[2];

			if (response['redirect']){
				window.location.href=response['redirect'];
			} else {
				htmlforform=response['data'];
				tclogincarddec=htmlforform;
				if (standalone===0) {
					inith = parseInt(document.getElementById('formhider-'+commentid).offsetHeight);
					jQuery('#'+objformid).css('display','none');
					toctoc_comments_refresh(ttrid,ttcontentid,commentid,1);
					if (response['refresh'] != '') {
						refreshidlist = (response['refresh']).split(',');
						newqrystr = newqrystr.replace('&logintype=logout','');
						newqrystr = newqrystr + '&refreshcontent=refresh';
						jQuery.ajax({
							type: 'POST',
							url: objformaction,
							async: true,
							data: newqrystr,
							success: function(data) {
								for (ix=0; ix < refreshidlist.length; ix++) {
									refreshidlist[ix]=tctrim(refreshidlist[ix]);
									setAJAXhtml(refreshidlist[ix], data);
								}
								
							}
						
						});
					}

					// user defined JS goes here (after logout from inside toctoc_comments)

					lougoutelem = document.getElementById('tx-tc-loginout');
					if (lougoutelem) {
						jQuery('#tx-tc-loginout').css('display','none');
					}
					jQuery('#tx-tc-loginlogoutinprogress-' +commentid).removeClass("tx-tc-blockdisp");
					jQuery('#tx-tc-loginlogoutinprogress-' +commentid).addClass("tx-tc-nodisp");
					jQuery('#tx_toctoccomments_pi2').html(htmlforform);

				} else {
					// user defined JS goes here (after logout from stand alone version)
					jQuery('#tx-tc-loginform').html(response['data']);
					jQuery('#tx-tc-loginform').css("opacity","0");
					toctoc_comments_fadein('tx-tc-loginform');
					tt_showloginbind();

					if (response['refresh'] != '') {
						refreshidlist = (response['refresh']).split(',');
						newqrystr = newqrystr.replace('&logintype=logout','');
						newqrystr = newqrystr + '&refreshcontent=refresh';
						jQuery.ajax({
						type: 'POST',
						url: objformaction,
						data: newqrystr,
						success: function(data) {
							
								for (ix=0; ix < refreshidlist.length; ix++) {
										refreshidlist[ix]=tctrim(refreshidlist[ix]);
										setAJAXhtml(refreshidlist[ix], data);
								}								
								if (sendbackafterloginout == 1) {
									window.history.back();									
								} 
							}
						});
					}

				}

			}
		}
	});
	jQuery('#frmtmplogout').remove;
	return false;
}
function ttc_ajaxfeforgotpw(obj){
	// Login
	var prefix=obj.form.id.substr(0,obj.form.id.length-5);
	var thechild=document.getElementById(obj.form.id);
	var objformid = obj.form.id;
	var objformaction = obj.form.action;
	objformaction = objformaction.replace('%5B','[');
	objformaction = objformaction.replace('%5D',']');

	var objformserializedArray = jQuery(obj.form).serializeArray();
	var objname = obj.name;

	ttid='';
	ttrid='';
	ttcontentid='';
	savefpformhtml = document.getElementById('tx-tc-loginformfp').innerHTML;

	jQuery('#'+objformid).css('opacity','0.6');
	var dobreak=0;
	for (i=1;i<10;i++) {
		tr = thechild.parentNode;
		if (tr) {
			if (tr.hasAttribute) {
				if (tr.hasAttribute('id')) {
					ttid=tr.getAttribute('id');
					ttrid = ttid.replace('tx-tc-cts-dp-','');
					ttcontentidtest =ttid.replace('tx-tc-formsqueezer-','');
					if (ttcontentidtest!==ttid) {
						commentid=ttcontentidtest;
						ttcontentidtestarr = ttcontentidtest.split('6g9');
						ttcontentid=ttcontentidtestarr[0];
					}
					if (ttid!==ttrid) {
						dobreak=1;
					} else {
						ttrid = ttid.replace('tx-tc-form-dp-','');
						if (ttid!==ttrid) {
							dobreak=1;
						}
					}
					if (dobreak===1) {
						break;
					}
					ttid='';
					ttrid='';
				}
			}
			thechild=tr;
		}
	}
	var standalone=0;
	if (ttrid!=='') {
		// from toctoc_comments
		var idnrpos = ttrid.lastIndexOf('_');
		var idnr = ttrid.substr(idnrpos+1);
		var idnrtestarr = idnr.split('6g9');
		if (idnrtestarr.length >1) {
			idnr=idnrtestarr[0];
			ttrid=ttrid.substr(0,(idnrpos+1)) + idnr;
		}
	} else {
		standalone=1;
	}

	jQuery.ajax({
		type: 'POST',
		url: objformaction,
		data: jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix,
		success: function(data) {
			var respfromserver = utf8_decode(tcb64_dec(data));
			var responsefp = [];
			var respfromserverarr = respfromserver.split('toctoc-data-sep');
			responsefp['redirect'] = respfromserverarr[0];
			responsefp['data'] = respfromserverarr[1];
			responsefp['refresh'] = respfromserverarr[2];

			if (responsefp['redirect']){
				window.location.href=responsefp['redirect'];
			} else {
				var htmlforform='';
				if (standalone===0) {
					// from inside toctoc_comments
					htmlforform=responsefp['data'];

				} else {
					htmlforform=responsefp['data'];
				}
				htmlforform=htmlforform.replace('class="tx-tc-status-for-felogin"', 'class="tx-tc-status-for-felogin tx-tc-blockdisp"');
				htmlforform=htmlforform.replace('<div class="tx-tc-loginform tx-tc-nodisp" id="tx-tc-loginformfp">', '');
				htmlforform=htmlforform.substr(0, (htmlforform.length-8));

				jQuery('#tx-tc-loginformfp').html(htmlforform);
				jQuery('#'+objformid).css('opacity','1');
				window.setTimeout("rebindloginback()", 5500);

			}
		}
	});

	return false;
}

function rebindloginback(){
	document.getElementById('tx-tc-loginformfp').innerHTML = savefpformhtml;
	(function($) {
		$('#tx-tc-status-for-felogin').removeClass("tx-tc-nodisp");
		$('#tx-tc-status-for-felogin').addClass("tx-tc-blockdisp");
		$('#tx_toctoccomments_pi2_form').removeClass("tx-tc-nodisp");
		$('#tx_toctoccomments_pi2_form').addClass("tx-tc-blockdisp");
		$('#tx-tc-buttonfornewaccount').removeClass("tx-tc-nodisp");
		$('#tx-tc-buttonfornewaccount').addClass("tx-tc-blockdisp");
		$('#tx-tc-loginformfp').addClass("tx-tc-nodisp");
		$('#tx-tc-loginformfp').removeClass("tx-tc-blockdisp");
		$('.tx-tc-login-submitfo').on("click", function() {
			ttc_ajaxfeforgotpw(this);
		});
		$('#u_0_0').on("click", function() {
			fbLogin();
		});

		$('#tx-tc-loginformfp .tx-tc-loginbacklink').on( "click", function() {
			$('#tx-tc-status-for-felogin').removeClass("tx-tc-nodisp");
			$('#tx-tc-status-for-felogin').addClass("tx-tc-blockdisp");
			$('#tx_toctoccomments_pi2_form').removeClass("tx-tc-nodisp");
			$('#tx_toctoccomments_pi2_form').addClass("tx-tc-blockdisp");
			$('#tx-tc-buttonfornewaccount').removeClass("tx-tc-nodisp");
			$('#tx-tc-buttonfornewaccount').addClass("tx-tc-blockdisp");
			$('#tx-tc-loginformfp').addClass("tx-tc-nodisp");
			$('#tx-tc-loginformfp').removeClass("tx-tc-blockdisp");
		});
	})(jQuery);
}
function rebindanswersignup(){
	(function($) {
		$('#tx-tc-signonlink').off("click");
		$('#tx-tc-buttonfornewaccount-bt').off("click");
		$('#tx-tc-signonlink').on("click", function() {
			$('#tx-tc-loginformso').addClass("tx-tc-nodisp");
			$('#tx-tc-loginformso').removeClass("tx-tc-blockdisp");
			$('#tx-tc-buttonfornewaccount').removeClass("tx-tc-nodisp");
			$('#tx-tc-buttonfornewaccount').addClass("tx-tc-blockdisp");
			$('#tx-tc-forgotpw').addClass("tx-tc-blockdisp");
			$('#tx-tc-forgotpw').removeClass("tx-tc-nodisp");
		});
		$('#tx-tc-buttonfornewaccount-bt').on( "click", function() {
			$('#tx-tc-buttonfornewaccount').addClass("tx-tc-nodisp");
			$('#tx-tc-buttonfornewaccount').removeClass("tx-tc-blockdisp");
			$('#tx-tc-loginformso').removeClass("tx-tc-nodisp");
			$('#tx-tc-loginformso').addClass("tx-tc-blockdisp");
			$('#tx-tc-forgotpw').addClass("tx-tc-nodisp");
			$('#tx-tc-forgotpw').removeClass("tx-tc-blockdisp");
		});
		$('#tx_toctoccomments_pi2_submitso').off("click");
		$('#tx_toctoccomments_pi2_formso').off("click");
		$('#tx_toctoccomments_pi2_submitso').on("click", function() {
			ttc_ajaxfesignup(this);
		});
		$('#tx_toctoccomments_pi2_formso').on("submit", false );
		$('#freecaprefresh').trigger("click");

	})(jQuery);
}
function ttc_ajaxfecp(obj){
	// change password
	var prefix=obj.form.id.substr(0,obj.form.id.length-7);
	var thechild=document.getElementById(obj.form.id);
	var objformid = obj.form.id;
	var objformaction = obj.form.action;
	objformaction = objformaction.replace('%5B','[');
	objformaction = objformaction.replace('%5D',']');

	var objformserializedArray = jQuery(obj.form).serializeArray();
	var objname = obj.name;

		if (document.getElementById('tx_toctoc_comments_pi2-changepassword1').value == '') {
			return;
		}

		if (document.getElementById('tx_toctoc_comments_pi2-changepassword2').value == '') {
			return;
		}

	ttid='';
	ttrid='';
	ttcontentid='';
	jQuery('#'+objformid).css('opacity','0.6');
	var dobreak=0;
	for (i=1;i<10;i++) {
		tr = thechild.parentNode;
		if (tr) {
			if (tr.hasAttribute) {
				if (tr.hasAttribute('id')) {
					ttid=tr.getAttribute('id');
					ttrid = ttid.replace('tx-tc-cts-dp-','');
					ttcontentidtest =ttid.replace('tx-tc-formsqueezer-','');
					if (ttcontentidtest!==ttid) {
						commentid=ttcontentidtest;
						ttcontentidtestarr = ttcontentidtest.split('6g9');
						ttcontentid=ttcontentidtestarr[0];
					}
					if (ttid!==ttrid) {
						dobreak=1;
					} else {
						ttrid = ttid.replace('tx-tc-form-dp-','');
						if (ttid!==ttrid) {
							dobreak=1;
						}
					}
					if (dobreak===1) {
						break;
					}
					ttid='';
					ttrid='';
				}
			}
			thechild=tr;
		}
	}
	var standalone=0;
	if (ttrid!=='') {
		// from toctoc_comments
		var idnrpos = ttrid.lastIndexOf('_');
		var idnr = ttrid.substr(idnrpos+1);
		var idnrtestarr = idnr.split('6g9');
		if (idnrtestarr.length >1) {
			idnr=idnrtestarr[0];
			ttrid=ttrid.substr(0,(idnrpos+1)) + idnr;
		}

	} else {
		standalone=1;
	}
	tttip('hide');
	jQuery.ajax({
		type: 'POST',
		url: objformaction,
		data: jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix,
		success: function(data) {
			var respfromserver = utf8_decode(tcb64_dec(data));
			var responsefp = [];
			var respfromserverarr = respfromserver.split('toctoc-data-sep');
			responsefp['redirect'] = respfromserverarr[0];
			responsefp['data'] = respfromserverarr[1];
			responsefp['refresh'] = respfromserverarr[2];

			if (responsefp['redirect']){
				window.location.href=responsefp['redirect'];
			} else {
				var htmlforform='';
				if (standalone==0) {
					// from inside toctoc_comments
					htmlforform=responsefp['data'];

				} else {
					htmlforform=responsefp['data'];
				}
				htmlforform=htmlforform.replace('class="tx-tc-status-for-felogin"', 'class="tx-tc-status-for-felogin tx-tc-blockdisp"');
				htmlforform=htmlforform.replace('<div class="tx-tc-loginform tx-tc-nodisp" id="tx-tc-loginformcp">', '');
				htmlforform=htmlforform.substr(0, (htmlforform.length-8));
				var htmlforformnoerr=htmlforform.replace('ERROR', '');

				jQuery('#tx_toctoccomments_pi2_cp').html(htmlforformnoerr);
				jQuery('#'+objformid).css('opacity','1');
				if ($('#tx-tc-loginformcp').hasClass("tx-tc-nodisp")) {
					$('#tx-tc-loginformcp').addClass("tx-tc-blockdisp");
					$('#tx-tc-loginformcp').removeClass("tx-tc-nodisp");
				}

				if (htmlforformnoerr == htmlforform) {
					window.setTimeout("rebindcpback(1)", 5500);
				} else {
					window.setTimeout("rebindcpback(0)", 5);
				}
			}
		}
	});

	return false;
}
function rebindcpback(goback){
	(function($) {
		if (goback==1) {
			var fadeelem = '';



			if (document.getElementById('tx_toctoccomments_pi2_cp')) {
				fadeelem = 'tx_toctoccomments_pi2_cp';
			} else {
				fadeelem = 'tx-tc-cpwf';
			}
			if (toctoc_comments_fadeout(fadeelem) === true) {
				document.getElementById('tx-tc-loginformcp').innerHTML = '';
				$('#tx-tc-loginformcp').addClass("tx-tc-nodisp");
				$('#tx-tc-loginformcp').removeClass("tx-tc-blockdisp");
			}
		}
		if (goback==0) {
			// submit of password change
			$('#tx-tc-loginformcp').addClass("tx-tc-blockdisp");
			$('#tx-tc-loginformcp').removeClass("tx-tc-nodisp");
			$('#tx_toctoccomments_pi2_submitcp').on("click", function() {
				ttc_ajaxfecp(this);
			});
		}
	})(jQuery);
}
function ttc_ajaxfesignup(obj){
	// sign up
	var prefix=obj.form.id.substr(0,obj.form.id.length-7);
	var thechild=document.getElementById(obj.form.id);
	var objformid = obj.form.id;
	var objformaction = obj.form.action;
	objformaction = objformaction.replace('%5B','[');
	objformaction = objformaction.replace('%5D',']');

	var objformserializedArray = jQuery(obj.form).serializeArray();
	var objname = obj.name;
	var txtc_feloginautopass = '';
	var txtc_feloginautouser = '';
	var tfield = document.getElementById('usersignup');

	if (tfield && tfield.value !== '') {
		txtc_feloginautouser = tfield.value;
	}

	tfield = document.getElementById('password1');
	if (tfield && tfield.value !== '') {
		txtc_feloginautopass = tfield.value;
	}

	ttid='';
	ttrid='';
	ttcontentid='';
	jQuery('#'+objformid).css('opacity','0.6');
	var dobreak=0;
	for (i=1;i<10;i++) {
		tr = thechild.parentNode;
		if (tr) {
			if (tr.hasAttribute) {
				if (tr.hasAttribute('id')) {
					ttid=tr.getAttribute('id');
					ttrid = ttid.replace('tx-tc-cts-dp-','');
					ttcontentidtest =ttid.replace('tx-tc-formsqueezer-','');
					if (ttcontentidtest!==ttid) {
						commentid=ttcontentidtest;
						ttcontentidtestarr = ttcontentidtest.split('6g9');
						ttcontentid=ttcontentidtestarr[0];
					}
					if (ttid!==ttrid) {
						dobreak=1;
					} else {
						ttrid = ttid.replace('tx-tc-form-dp-','');
						if (ttid!==ttrid) {
							dobreak=1;
						}
					}
					if (dobreak===1) {
						break;
					}
					ttid='';
					ttrid='';
				}
			}
			thechild=tr;
		}
	}
	var standalone=0;
	if (ttrid!=='') {
		// from toctoc_comments
		var idnrpos = ttrid.lastIndexOf('_');
		var idnr = ttrid.substr(idnrpos+1);
		var idnrtestarr = idnr.split('6g9');
		if (idnrtestarr.length >1) {
			idnr=idnrtestarr[0];
			ttrid=ttrid.substr(0,(idnrpos+1)) + idnr;
		}

	} else {
		standalone=1;
	}
	tttip('hide');
	jQuery.ajax({
		type: 'POST',
		url: objformaction,
		data: jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_toctoccomments_pi2[ajax]='+prefix,
		success: function(data) {
			var respfromserver = utf8_decode(tcb64_dec(data));
			var responseso = [];
			var respfromserverarr = respfromserver.split('toctoc-data-sep');
			responseso['redirect'] = respfromserverarr[0];
			responseso['data'] = respfromserverarr[1];
			responseso['refresh'] = respfromserverarr[2];

			if (responseso['redirect']){
				window.location.href=responseso['redirect'];
			} else {
				var htmlforform='';
				if (standalone===0) {
					// from inside toctoc_comments
					htmlforform=responseso['data'];

				} else {
					htmlforform=responseso['data'];
					// from stand alone
					// user defined JS goes here (after loginattempt from stand alone version)
					// please add the according logic for distinction of successfull logins according to the exemple above
				}
				htmlforform=htmlforform.replace('class="tx-tc-status-for-felogin"', 'class="tx-tc-status-for-felogin tx-tc-blockdisp"');
				htmlforform=htmlforform.replace('<div class="tx-tc-loginform tx-tc-nodisp" id="tx-tc-loginformso">', '');
				htmlforform=htmlforform.replace('href="#"', 'id="freecaprefresh" href="#"');
				htmlforform=htmlforform.substr(0, (htmlforform.length-8));

				if (htmlforform.indexOf('SIGNUPANDLOGINOK')>1) {
					window.setTimeout("ttc_autoajaxfelogin('" + txtc_feloginautouser + "', '" + txtc_feloginautopass + "')", 20);
				} else {
					jQuery('#tx-tc-loginformso').html(htmlforform);
					window.setTimeout("rebindanswersignup()", 10);
					if (htmlforform.indexOf('SIGNUPANDCONFIRM')>1) {
						jQuery('#tx-tc-loginformso').css("opacity","1");
					} else {
						jQuery('#tx-tc-loginformso').css("opacity","0");
						toctoc_comments_fadein('tx-tc-loginformso');
					} 
				
					
				}

			}

		}
	});

	return false;
}


