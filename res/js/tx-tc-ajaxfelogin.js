var txtc_feloginobj;
var txtc_feloginautouser='';
var txtc_feloginautopass='';
function ttc_autoajaxfelogin(){
	document.getElementById('user').value==txtc_feloginautouser;
	document.getElementById('pass').value==txtc_feloginautopass;
	document.getElementById('tx_felogin_pi1_submit').click();
}
function ttc_ajaxfelogin(obj){
	// Login
	var prefix=obj.form.id.substr(0,obj.form.id.length-5);
	var thechild=document.getElementById(obj.form.id);
	var objformid = obj.form.id;
	var objformaction = obj.form.action;
	var objformserializedArray = jQuery(obj.form).serializeArray();
	var objname = obj.name;

	ttid='';
	ttrid='';
	ttcontentid='';
	jQuery('#'+obj.form.id).css('opacity','0.6');
	for (i=1;i<10;i++) {
		tr = thechild.parentNode;
		if (tr) {
			if (tr.getAttribute('id')) {
				ttid=tr.getAttribute('id');
				ttrid = ttid.replace('tx-tc-cts-dp-','');
				ttcontentidtest =ttid.replace('tx-tc-formsqueezer-','');
				if (ttcontentidtest!=ttid) {
					commentid=ttcontentidtest;
					ttcontentidtestarr = ttcontentidtest.split('6g9');
					ttcontentid=ttcontentidtestarr[0];
				}
				if (ttid!=ttrid) {
					break;
				} else {
					ttrid = ttid.replace('tx-tc-form-dp-','');
					if (ttid!=ttrid) {
						break;
					}
				}
				ttid='';
				ttrid='';
			}
			thechild=tr;
		}
	}
	if (ttrid!='') {
		// from toctoc_comments
	    var idnrpos = ttrid.lastIndexOf('_');
	    var idnr = ttrid.substr(idnrpos+1);
	    var idnrtestarr = idnr.split('6g9');
	    if (idnrtestarr.length >1) {
	    	idnr=idnrtestarr[0];
	    	ttrid=ttrid.substr(0,(idnrpos+1)) + idnr;
	    }	
		var standalone=0;
	} else {
		var standalone=1;
	}
	//console.log('standalone'+standalone);
	var loadinghtml=document.getElementById('tx-tc-loginlogoutinprogress').innerHTML;
	if (standalone==0) {
		jQuery('#formhider-'+commentid).css('min-height',40+'px');
		jQuery('#formhider-'+commentid).html(loadinghtml);
		jQuery('#formhider-'+commentid).css('min-height',40+'px');
	} else {
		jQuery('#'+obj.form.id).css('display','none');
		jQuery('#tx-tc-loginlogoutinprogress').css('display','block');
	}	
	jQuery.ajax({  
		type: 'POST',  
		url: objformaction,  
		data: jQuery.param(jQuery(objformserializedArray))+'&'+objname+'=1&tx_felogin_pi1[ajax]='+prefix,  
		success: function(data) {
			var response=jQuery.parseJSON(data);
			if (response.redirect){
				window.location.href=response.redirect;
			} else {
				if (standalone==0) {
					// from inside toctoc_comments
					var inith = eval(document.getElementById('formhider-'+commentid).offsetHeight);
					var loadinghtml=document.getElementById('tx-tc-loginlogoutinprogress').innerHTML;
					jQuery('#formhider-'+commentid).css('min-height',40+'px');
					jQuery('#formhider-'+commentid).html(loadinghtml);
					jQuery('#formhider-'+commentid).css('min-height',40+'px');
					var htmlforformformhider=(response.data).replace('tx_felogin_pi1_formlo','tx_felogin_pi1_formlog');
	
					loggedinarr= response.data.split('Youre logged in');
					if (loggedinarr.length>1) {
						if (ttrid !='') {
							jQuery('#'+objformid).css('display','none');
							toctoc_comments_refresh(ttrid,ttcontentid,commentid);
							// user defined JS goes here (after success for login from inside toctoc_comments)
						}
					} else {
						if (ttrid !='') {
							jQuery('#formhider-'+commentid).html(htmlforformformhider);
							// user defined JS goes here (after error from login attempt from inside toctoc_comments)
						} 
					}
					lougoutelem = document.getElementById('tx-tc-loginout');
					if (lougoutelem) {
						jQuery('#tx-tc-loginout').css('display','block');
					}
					var htmlforform=htmlforformformhider.replace('id=\"tx-tc-loginform\"','id=\"tx-tc-loginform-2\"');
					htmlforform=htmlforform.replace('tx_felogin_pi1_formlog','tx_felogin_pi1_formlogout');
				} else {
					var htmlforform=response.data;
					// from stand alone
					// user defined JS goes here (after loginattempt from stand alone version)
					// please add the according logic for distinction of successfull logins according to the exemple above
				}
				jQuery('#tx-tc-loginlogoutinprogress').css('display','none');
				jQuery('#'+prefix).html(htmlforform);
			}
		}  
	});  
	return false;
}
function tt_logout(idnr, ttrid) {
	// logout
	// function triggered from the log out link in the toctoc_Comments plugin
	// idnr: example '10046g92966g9', ttrid: tt_content_1004
	if ((idnr==0) && (ttrid==0)) {
		//stand alone
		var standalone=1;
	} else {
		// from toctoc_comments
		var standalone=0;
		var commentid=idnr;
		var idnrpos = ttrid.lastIndexOf('_');
		var idnrtestarr = idnr.split('6g9');
		
		if (idnrtestarr.length >1) {
			idnr=idnrtestarr[0];
			ttrid=ttrid.substr(0,(idnrpos+1)) + idnr;
		}
		ttcontentid=idnr;	
	}

	var obj = document.getElementById('tx_felogin_pi1_formlogout_submit');
	var loadinghtml=document.getElementById('tx-tc-loginlogoutinprogress').innerHTML;
	if (standalone==0) {
		var inith = eval(document.getElementById('cf'+commentid).offsetHeight) - eval(document.getElementById('textarea-'+commentid).offsetHeight);
		jQuery('#formhider-'+commentid).html(loadinghtml);
		jQuery('#tx-tc-div-submit'+commentid).css('display','none');
		jQuery('#formhider-'+commentid).css('min-height',inith+'px');
	} else {
		jQuery('#'+obj.form.id).css('display','none');
		jQuery('#tx-tc-loginlogoutinprogress').css('display','block');
	}	
	jQuery.ajax({  
		type: 'POST',  
		url: obj.form.action,  
		data: jQuery.param(jQuery(obj.form).serializeArray())+'&'+obj.name+'=1&tx_felogin_pi1[ajax]=tx_felogin_pi1',  
		success: function(data) {
			var response=jQuery.parseJSON(data);
			if (response.redirect){
				window.location.href=response.redirect;
			} else {
				if (standalone==0) {
					var inith = eval(document.getElementById('formhider-'+commentid).offsetHeight);
					jQuery('#'+obj.form.id).css('display','none');
					toctoc_comments_refresh(ttrid,ttcontentid,commentid,1);
					// user defined JS goes here (after logout from inside toctoc_comments)

					lougoutelem = document.getElementById('tx-tc-loginout');
					if (lougoutelem) {
						jQuery('#tx-tc-loginout').css('display','none');
					}
				} else {
					// user defined JS goes here (after logout from stand alone version)
					
				}
				jQuery('#tx-tc-loginlogoutinprogress').css('display','none');
				jQuery('#tx_felogin_pi1').html(response.data);
			}
		}  
	});  
	
	return false;
}