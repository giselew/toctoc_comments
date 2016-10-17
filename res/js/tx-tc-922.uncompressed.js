/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
*  toctoc_comments main javascript file, located in the head of the HTML document
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
/*
Inits of global variables
*/
var tctreestate = [];
var tcelemstate = [];

var previewstarted = [];
var previewstartedfp = [];
var previewfpheight = [];
var previewcountnr = [];
var previewfpcountnr = [];
var previewhtml = [];
var previewselcomment = [];
var previewstartedfup = [];
var previewselpic = [];
var previewselpreviewid = [];
var acroppeds = [];

var commentsAjaxData = [];
var commentsAjaxDataImg = [];
var commentsAjaxThisData = [];
var commentsAjaxDataC = [];
var commentsAjaxDataAtt = [];
var commentsAjaxDataLogin = [];
var commentsAjaxDataLoginSess = [];
var commentsAjaxDataLogout = [];

var editsavehtml = '';
var edithtml = '';
var editsavebthtml = '';
var edithtmlkit = '';
var editon = false;
var edituid = 0;
var previewon = false;
var editsavenamehtml = '';
var messageon = false;
var submitopaccontrol = 2;
var logomargin = '';
var nomessagedisplay = 0;
var currentcommenttext = [];
var htmlloginform = '';
var lastshownloginformid = '';
var fbloginok = false;
var overlogout = 0;
var tctnme = 'toctoc_comments_pi1_contenttextbox_';
var tcsbmtnme = 'toctoc_comments_pi1_submit_';

var uploadtype='pic';

var uc_closed = [];
var emolikeoverview_closed = [];
var caretposstart= 0;
var caretposend= 0;
var formhidermoreheightsecondlap=0;
var htmlretcodesave=0;
var commenttitletitlehtml='';
var tclocaltimediff = 0;
var checkdatedelay=200;
var tcservertime = 0;
var noajaxreply=0;
var setupbbcid=false;
var bb_closed = 0;
var replacedlen=0;

var savedpwfrgthtml='';
var tclogincarddec='';
var savefpformhtml = '';

var ilesstooltips = parseInt(showlesstooltips);
var locshowlesstooltips = parseInt(ilesstooltips);
var screenwidth =parseInt(screen.width);
if (screenwidth > 768) {
	if (ilesstooltips == 1) {
		locshowlesstooltips = 0;
	}
}
var sortArr = [];
var dirtySortArr = [];
var sortReviewArr = [];
var sortReviewDoneArr = [];
var isrts = 'rts';
var editedcommenttitle = '';

var shareArr = [];
var shareTime = 0;

var animStatePopup = 0;
var animStateLikeButton = 0;
var animStateSave = 0;
var animLastSave = 0;
var animStateClose = 0;
var lastanimPopup = '';
var activePicNr = 0;

var dispatchArr = [];
var dispatchBase = '';
var runDispatch = 0;
var ltimeout;
var longtouch = 0;
var norighttooltip = 0;
var timeoutID = 0;

/*
Helper functions, some are PHP-equivalents
*/
function array_key_exists (key, search) {
	if (!search || (search.constructor !== Array && search.constructor !== Object)) {
		return false;
	}
	return key in search;
}
function tcb64_dec (data) {
	var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
		ac = 0,
		dec = "",
		tmp_arr = [];

	if (!data) {
		return data;
	}

	data += '';

	do { // unpack four hexets into three octets using index points in b64
		h1 = b64.indexOf(data.charAt(i++));
		h2 = b64.indexOf(data.charAt(i++));
		h3 = b64.indexOf(data.charAt(i++));
		h4 = b64.indexOf(data.charAt(i++));

		bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

		o1 = bits >> 16 & 0xff;
		o2 = bits >> 8 & 0xff;
		o3 = bits & 0xff;

		if (h3 === 64) {
			tmp_arr[ac++] = String.fromCharCode(o1);
		} else if (h4 === 64) {
			tmp_arr[ac++] = String.fromCharCode(o1, o2);
		} else {
			tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
		}
	} while (i < data.length);

	dec = tmp_arr.join('');

	return dec;
}
function toctoc_comments_pi1_base64_encode (data) {
	var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
		ac = 0,
		enc = "",
		tmp_arr = [];

	if (!data) {
		return data;
	}
	if (data.indexOf('>') === -1) {
		data = this.utf8_encode(data + '');
	}

	do { // pack three octets into four hexets
		o1 = data.charCodeAt(i++);
		o2 = data.charCodeAt(i++);
		o3 = data.charCodeAt(i++);

		bits = o1 << 16 | o2 << 8 | o3;

		h1 = bits >> 18 & 0x3f;
		h2 = bits >> 12 & 0x3f;
		h3 = bits >> 6 & 0x3f;
		h4 = bits & 0x3f;

		// use hexets to index into b64, and append result to encoded string
		tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
	} while (i < data.length);

	enc = tmp_arr.join('');

	var r = data.length % 3;

	return (r ? enc.slice(0, r - 3) : enc) + ' === '.slice(r || 3);
}

function utf8_encode (argString) {
	if (argString === null || typeof argString === "undefined") {
		return "";
	}
	var string = (argString + '');
	var utftext = "",
		start, end, stringl = 0;

	start = end = 0;
	stringl = string.length;
	for (var n = 0; n < stringl; n++) {
		var c1 = string.charCodeAt(n);
		var enc = null;
		if (c1 < 128) {
			end++;
		} else if (c1 > 127 && c1 < 2048) {
			enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
		} else {
			enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
		}
		if (enc !== null) {
			if (end > start) {
				utftext += string.slice(start, end);
			}
			utftext += enc;
			start = end = n + 1;
		}
	}
	if (end > start) {
		utftext += string.slice(start, stringl);
	}
	return utftext;
}

function toctoc_comments_pi1_serialize (mixed_value) {
	var _utf8Size = function (str) {
		var size = 0,
		i = 0,
		l = str.length,
		code = '';
		for (i = 0; i < l; i++) {
			code = str.charCodeAt(i);
			if (code < 0x0080) {
			size += 1;
			}
			else if (code < 0x0800) {
				size += 2;
			}
			else {
				size += 3;
			}
		}
		return size;
		};
		var _getType = function (inp) {
		var type = typeof inp,
			match;
		var key;
		if (type === 'object' && !inp) {
			return 'null';
		}
		if (type === "object") {
			if (!inp.constructor) {
				return 'object';
			}
			var cons = inp.constructor.toString();
			match = cons.match(/(\w+)\(/);
			if (match) {
				cons = match[1].toLowerCase();
			}
			var types = ["boolean", "number", "string", "array"];
			for (key in types) {
				if (cons === types[key]) {
					type = types[key];
					break;
				}
			}
		}
		return type;
	};
	var type = _getType(mixed_value);
	var val, ktype = '';
	switch (type) {
	case "function":
		val = "";
		break;
	case "boolean":
		val = "b:" + (mixed_value ? "1" : "0");
		break;
	case "number":
		val = (Math.round(mixed_value) === mixed_value ? "i" : "d") + ":" + mixed_value;
		break;
	case "string":
		val = "s:" + _utf8Size(mixed_value) + ":\"" + mixed_value + "\"";
		break;
	case "array":	case "object":
		val = "a";

		var count = 0;
		var vals = "";
		var okey;
		var key;
		for (key in mixed_value) {
			if (mixed_value.hasOwnProperty(key)) {
				ktype = _getType(mixed_value[key]);
				if (ktype === "function") {
					continue;
				}

				okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
				vals += this.toctoc_comments_pi1_serialize(okey) + this.toctoc_comments_pi1_serialize(mixed_value[key]);
				count++;
			}
		}
		val += ":" + count + ":{" + vals + "}";
		break;
	case "undefined":
		// Fall-through
	default:
		// if the JS object has a property which contains a null value, the string cannot be unserialized by PHP
		val = "N";
		break;
	}
	if (type !== "object" && type !== "array") {
		val += ";";
	} return val;
}
function utf8_decode (str_data) {
	// Converts a UTF-8 encoded string to ISO-8859-1
	var tmp_arr = [],
		i = 0,
		ac = 0,
		c1 = 0,
		c2 = 0,
		c3 = 0;

	str_data += '';

	while (i < str_data.length) {
		c1 = str_data.charCodeAt(i);
		if (c1 < 128) {
			tmp_arr[ac++] = String.fromCharCode(c1);
			i++;
		} else if (c1 > 191 && c1 < 224) {
			c2 = str_data.charCodeAt(i + 1);
			tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
			i += 2;
		} else {
			c2 = str_data.charCodeAt(i + 1);
			c3 = str_data.charCodeAt(i + 2);
			tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
			i += 3;
		}
	}
	
	return tmp_arr.join('');
}
function supports_html5_storage() {
	try {
		return 'localStorage' in window && window['localStorage'] !== null;
	} catch (e) {
		return false;
	}
	
}
function getInternetExplorerVersion() {
	var rv = -1; // Return value assumes failure.
	if (navigator.appName === 'Microsoft Internet Explorer') {
		var ua = navigator.userAgent;
		var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) !== null) {
			rv = parseFloat(RegExp.$1);
		}

	}

	return rv;
}

function tcisInt(value) {
	return !isNaN(parseInt(value)) && (parseFloat(value) === parseInt(value));
}

function tctrim(s) {
	var l=0;
	var r=s.length -1;
	while(l < s.length && s[l] === ' ')
	{	l++; }
	while(r > l && s[r] === ' ')
	{	r-=1;	}
	return s.substring(l, r+1);
}

function tcdelinefeed(s) {
	return s.replace(/(\r\n|\n|\r)/gm,"");
}

function findPos(obj) {
    var curleft = 0;
    var curtop = 0;
    if(obj.offsetLeft) {
    	curleft += parseInt(obj.offsetLeft);
    }
    if(obj.offsetTop) {
    	curtop += parseInt(obj.offsetTop);
    }
    var godi = obj;
    if(navigator.userAgent.indexOf("Safari")>=1) {
    	godi = jQuery("body");
    } 
    if(godi.scrollTop && godi.scrollTop > 0) {
    	curtop -= parseInt(godi.scrollTop);
    }
   
    var pos = [];
	for (i=1;i<100;i++) {
		objparent = obj.parentNode;
		if (objparent) {
			if (objparent.tagName =='body') {
				break;
			} else {

				if(obj.offsetParent) {
			        pos = findPos(obj.offsetParent);
			        if (!((obj.parentNode.id == '') && ((obj.parentNode.tagName.toUpperCase() == 'TABLE') || (obj.parentNode.tagName.toUpperCase() == 'TD') || (obj.parentNode.tagName.toUpperCase() == 'TR'))) && (obj .parentNode.style.display != 'none')) {
			        	curleft += pos[0];
			            curtop += pos[1];
			        }
			    } else if(obj.ownerDocument) {
			        var thewindow = obj.ownerDocument.defaultView;
			        if(!thewindow && obj.ownerDocument.parentWindow) {
			        	thewindow = obj.ownerDocument.parentWindow;
			        }
			        if(thewindow) {
			            if(thewindow.frameElement) {
			                pos = findPos(thewindow.frameElement);
			                curleft += pos[0];
			                curtop += pos[1];
			            }
			        }
			    }
				obj=objparent;
			}
		}
	}

    return [curleft,curtop];
}

/*
Cookie handling for form fields
*/
function toctoc_comments_pi1_createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
function toctoc_comments_pi1_readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function toctoc_comments_pi1_eraseCookie(name) {
	toctoc_comments_pi1_createCookie(name,'',-1);
}
function toctoc_comments_pi1_readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (i= 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) === ' ') {
			c = c.substring(1, c.length);
		}
		if (c.indexOf(nameEQ) === 0) {
			return unescape(c.substring(nameEQ.length,c.length)).replace(/\+/, ' ');
		}
	}
	return false;
}
function toctoc_comments_pi1_setUserDataField(name,icid,enc) {
	var field = document.getElementById('toctoc_comments_pi1_' + icid + name);
	var value = '';
	try {
		if (field && field.value !== '') {
			value = field.value;
			field.value = value;
		}
		if (field && field.value === '') {
			value = toctoc_comments_pi1_readCookie('toctoc_comments_pi1_gimme55');
			var encdo = 0;
			if (typeof value === 'string') {
				if (value == '1') {
					encdo = enc;
				}
			}
			enc = encdo;
			value = toctoc_comments_pi1_readCookie('toctoc_comments_pi1_' + name);
			if (typeof value === 'string') {
				if (enc == 1) {
					var originalvalue = value;
					var legacyvalue = utf8_decode(value);
					value = utf8_decode(tcb64_dec(value));
					if (value.length > legacyvalue.length) {
						value = legacyvalue;
						toctoc_comments_pi1_eraseCookie('toctoc_comments_pi1_' + name);
						toctoc_comments_pi1_createCookie('toctoc_comments_pi1_' + name, this.toctoc_comments_pi1_base64_encode(originalvalue) , cookieLifetime);
					}
					
				} else {
					value = utf8_decode(value);
				}
				
				field.value = value;
				if ((name === 'gender')) {
					changedefuserpic(value, icid);
				}
			}
		}
	}
	catch (e) {
	}
}
/*
Form functions - reading, setting form data
*/
function toctoc_comments_pi1_setUserData(icid) {
	toctoc_comments_pi1_setUserDataField('firstname',icid,1);
	toctoc_comments_pi1_setUserDataField('lastname',icid,1);
	toctoc_comments_pi1_setUserDataField('location',icid,1);
	toctoc_comments_pi1_setUserDataField('email',icid,1);
	toctoc_comments_pi1_setUserDataField('homepage',icid,1);
	toctoc_comments_pi1_setUserDataField('gender',icid,0);
}

function toctoc_comments_pi1_getUserDataField(name,icid) {
	var field = document.getElementById('toctoc_comments_pi1_' + icid + name);
	var value = 0;
	if (name === 'notify') {
		value = 0;
		if (field) {
			if (field.checked === true) {
				value = 1;
			}
		}
		return value;
	}
	else {
		if (field && field.value !== '') {
			value = field.value;
			return value;
		}
		else
		{
			return '';
		}
	}
	
}
function toctoc_comments_pi1_getSearchData(iBrowseCommand, icid) {
	var toctoc_piVars = [];	
	toctoc_piVars['from'] = 1;
	toctoc_piVars['commentage'] = toctoc_comments_pi1_getUserDataField('commentage',icid);
	toctoc_piVars['browsecommand'] = iBrowseCommand;
	toctoc_piVars['conf'] = toctoc_comments_pi1_getUserDataField('confdiff',icid);
	toctoc_piVars['lang'] = activelang;
	toctoc_piVars['langid'] = pagelanId;
	var tmpcontent= toctoc_comments_pi1_getUserDataField('search', icid);
	tmpcontent=tmpcontent.replace(/\t/g,'');

	tmpcontent= tmpcontent.split('>').join('&gt;');
	tmpcontent= tmpcontent.split('<').join('&lt;');
	tmpcontent=tctrim(tmpcontent);
	toctoc_piVars['search'] = this.toctoc_comments_pi1_base64_encode(tmpcontent);
	var str1=this.toctoc_comments_pi1_serialize(toctoc_piVars);
	var str2=this.toctoc_comments_pi1_base64_encode(str1);
	return str2;	
}
function toctoc_comments_pi1_getUserData(icid) {
	var toctoc_piVars = [];
	toctoc_piVars['commenttitle'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('commenttitle',icid));
	toctoc_piVars['firstname'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('firstname',icid));
	toctoc_piVars['lastname'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('lastname',icid));
	toctoc_piVars['location'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('location',icid));
	toctoc_piVars['email'] = toctoc_comments_pi1_getUserDataField('email',icid);
	toctoc_piVars['homepage'] = toctoc_comments_pi1_getUserDataField('homepage',icid);
	toctoc_piVars['itemurl'] = toctoc_comments_pi1_getUserDataField('itemurl',icid);
	toctoc_piVars['itemurlchk'] = toctoc_comments_pi1_getUserDataField('itemurlchk',icid);
	toctoc_piVars['cid'] = toctoc_comments_pi1_getUserDataField('cid',icid);
	toctoc_piVars['insert'] = toctoc_comments_pi1_getUserDataField('insert',icid);
	toctoc_piVars['captcha'] = toctoc_comments_pi1_getUserDataField('captcha',icid);
	toctoc_piVars['level'] = toctoc_comments_pi1_getUserDataField('level',icid);
	toctoc_piVars['notify'] = toctoc_comments_pi1_getUserDataField('notify',icid);
	toctoc_piVars['gender'] = toctoc_comments_pi1_getUserDataField('gender',icid);
	toctoc_piVars['previewselpic'] = previewselpic[icid];
	toctoc_piVars['commentparentid'] =  toctoc_comments_pi1_getUserDataField('commentparentid',icid);
	toctoc_piVars['previewselpreviewid'] = previewselpreviewid[icid];

	var field = document.getElementById('toctoc_comments_pi1_submit_' + icid);
	toctoc_piVars['submit'] = field.value;
	field = document.getElementById(tctnme + icid);
	var tmpcontent=field.value;
	tmpcontent=tmpcontent.replace(/\t/g,'');

	tmpcontent= tmpcontent.split('>').join('&gt;');
	tmpcontent= tmpcontent.split('<').join('&lt;');
	tmpcontent=tctrim(tmpcontent);

	tmpcontent=dbize_emojis(tmpcontent);

	toctoc_piVars['content'] = this.toctoc_comments_pi1_base64_encode(tmpcontent);

	var fieldupl = document.getElementById('toctoc_comments_pi1_uplcontenttextbox_' + icid);
	if (fieldupl) {
		tmpcontent=fieldupl.value;
		tmpcontent=tmpcontent.replace(/\t/g,'');
		tmpcontent= tmpcontent.split('>').join('&gt;');
		tmpcontent= tmpcontent.split('<').join('&lt;');
		tmpcontent=tctrim(tmpcontent);
		
		toctoc_piVars['descriptionbyuser'] = this.toctoc_comments_pi1_base64_encode(tmpcontent);
		toctoc_piVars['originalfilename'] = toctoc_comments_pi1_getUserDataField('originalfilename',icid);
		toctoc_piVars['uploadpicid'] = toctoc_comments_pi1_getUserDataField('uploadpicid',icid);
		toctoc_piVars['uploadpicheight'] = toctoc_comments_pi1_getUserDataField('uploadpicheight',icid);
	} else {
		toctoc_piVars['descriptionbyuser'] = '';
		toctoc_piVars['originalfilename'] = '';
		toctoc_piVars['uploadpicid'] =  '';
		toctoc_piVars['uploadpicheight'] =  0;
	}

	var str1=this.toctoc_comments_pi1_serialize(toctoc_piVars);
	var str2=this.toctoc_comments_pi1_base64_encode(str1);
	return str2;
}
/*
Form functions - data transformation
*/
function dbize_emojis (commentcontent){
	var reresultucdo = /(%u)+/g;
	var resultucd =  escape(commentcontent);
	if (typeof emotjicodes !== 'undefined') {
		for (i= 0; i < emotjicodes.length; i++) {
			candemo= escape(emotjicodes[i][1]);
			var emotjicandArray = String(resultucd).split(candemo);
			if (emotjicandArray.length >1) {
				emoout= candemo.replace(reresultucdo,"\\u");
				resultucd=emotjicandArray.join(emoout);
			}
		}
	}
 	return unescape(resultucd);
}
/*
Form functions - sizing
*/

function comment_formhider(cidcomments, showhider, textaddcomment, loggedon, makewindowresize , thisin) {
	// optional: textaddcomment: ###TEXT_ADD_COMMENT###
	// loggedon (obsolete since global_loggedon), makewindowresize: 1/0
		var tamargin = '0';
		var submitmargin='4px 0 5px ' + boxmodelLabelWidth + 'px';
		var tainitmargin = '0';
		var hidermargin= '0';
		var userpicmargin= '4px 0 0';
		var newmargin='0px';
		if ((global_loggedon === 1) && (cidcomments !== '1')) {
				hidermargin = '5px 0 5px';
				if ((getInternetExplorerVersion()>8)) {
					if (confuseUserImage === 1) {
						tamargin = '0 0 0 '+ parseInt(boxmodelSpacing - 1) + 'px';
					}

				} else {
					if (confuseUserImage === 1) {
						tamargin = '0 0 0 '+ boxmodelSpacing + 'px';
					}

				}

				submitmargin='4px 8px -4px ' + boxmodelSpacing + 'px';
				if (boxmodelLabelWidth == 0) {
					submitmargin='0 0 0 ' + parseInt(boxmodelSpacing - 2) + 'px';;
				}
			}
		var singlecommentid=cidcomments;
		var cidtestval=String(cidcomments).indexOf("6g9");
		if (cidtestval>0){
			userpicmargin='8px 0 0 4px';
			var elemcap=document.getElementById('toctoc_comments_cap_' + cidcomments);
			if (elemcap){
				newmargin='8px 0 0';
			}
			var singlecommentidarr=String(cidcomments).split("6g9");
			singlecommentid=singlecommentidarr[1];
			textaddcomment = utf8_decode(tcb64_dec(textReplyToComment));
		}

		if (showhider === 1) {
			thisin.focus();
		}
		else
		{
			var thishider = document.getElementById('formhider-' + cidcomments);
			var thisuserimg = document.getElementById('tx-tc-uimg-' + cidcomments);
			var thistextarea =document.getElementById('textarea-' + cidcomments);
			var thissubmit =document.getElementById(tcsbmtnme + cidcomments);
			var thissubmitdiv =document.getElementById('tx-tc-div-submit' + cidcomments);
			var thisformsqueezer =document.getElementById('tx-tc-formsqueezer-' + cidcomments);
		}
		if ((showhider === 2) || (showhider === 3)) {
			var thiscontenttextbox = document.getElementById(tctnme + cidcomments);
			var thistermscheckbox = document.getElementById('toctoc_comments_pi1_' + cidcomments + 'acceptterms');
		}
		
		if (showhider === 2) {
			//onblur
			if (overlogout === 0) {

				var hidertopmargin= (-80-parseInt(confuserpicsize));
				thistextarea.style.margin = tainitmargin;

				if (thiscontenttextbox) {
					var checklen = this.tctrim(textaddcomment).length;
					var checkfield = this.tctrim(thiscontenttextbox.value);
					var checkfield2 = checkfield.substr(0,checklen);
					if ((checkfield2 === this.tctrim(textaddcomment)) || (checkfield === '')) {
						//addon to elastic.js
						thiscontenttextbox.style.height = boxmodelTextareaHeight + 'px';
					}
				}
				thissubmit.style.display = 'none';
				thissubmitdiv.style.display = 'none';
				thissubmit.style.height = 0;
				thissubmit.style.margin = 0;

				thishider.style.display = 'none';
				thishider.style.minHeight = 0;
				thishider.style.margin = hidertopmargin + "px 0 0";
				thisformsqueezer.style.height = boxmodelTextareaAreaTotalHeight + 'px';

				if (global_loggedon === 1){
					if (!thisuserimg) {
						thisuserimg = document.getElementById('tx-tc-ct-uimg-' + cidcomments);
					}
					if (thisuserimg) {
						if (!jQuery('#' + thisuserimg.id).hasClass('tx-tc-nodisp')) {
							jQuery('#' + thisuserimg.id).addClass('tx-tc-nodisp');
						}

						thisuserimg.style.display = 'none';
						thisuserimg.style.margin='-' +confuserpicsize+'px 0 0';
					}
					thishider.style.margin ='-' +confuserpicsize+'px 0 0';
				}

				if (toctoc_comments_fadeout('tx-tc-cts-prv-ct-' + cidcomments) === true) {
				}

			}
		};
		if (showhider === 3) {
		//onFocus
				jQuery('#tx-tc-ct-report-' + singlecommentid).css('display', 'none');
				thistextarea.style.margin = tamargin;
				loginformaddhiderdisplay = 'block';
				if ((loginRequiredIdLoginForm === '') || (global_loggedon === 1)) {
					previewselcomment[cidcomments] = 0;
					thissubmit.style.display = 'block';
					thissubmitdiv.style.display = 'block';

					thissubmit.style.height = 'auto';
					thissubmit.style.margin = submitmargin;
				} else {
					if (loginRequiredIdLoginForm !== '') {
						if (lastshownloginformid !== cidcomments) {
							if (lastshownloginformid !== '') {
								tt_showlogin(lastshownloginformid,0);
								comment_formhider(lastshownloginformid, 2, utf8_decode(tcb64_dec(textAddComment)), 0,1);
								jQuery('#toctoc_comments_pi1_contenttextbox_' + lastshownloginformid).elastic();
							}

						}

						loginformaddhiderdisplay = 'table';
					}

				}
				thishider.style.height = '';
				thishider.style.minHeight = '';
				thishider.style.margin =hidermargin;
				thishider.style.display = loginformaddhiderdisplay;
				thisformsqueezer.style.height = 'auto';
				if (thistextarea.style.minHeight == '') {
					thistextarea.style.minHeight='0px';
				}
				var minheight=thistextarea.style.minHeight;
				var minheightval=minheight.substr(0,minheight.indexOf("p"));
				var taoffsetheight=thistextarea.offsetHeight;
				var deltah=0;
				var oldmargin='';
				var oldmarginval=0;
				var newmarginval=0;

				if (minheightval<taoffsetheight){
					deltah=parseInt(taoffsetheight)-parseInt(minheightval);
					oldmargin = thishider.style.margin;
					if (oldmargin.length === 1) {
						newmarginval=deltah;
					} else {
						oldmarginval=oldmargin.substr(0,oldmargin.indexOf("p"));
						newmarginval=parseInt(oldmarginval)+parseInt(deltah);
					}
					thishider.style.margin = newmargin;
				}
				if (global_loggedon === 1){
					if (!thisuserimg) {
						thisuserimg = document.getElementById('tx-tc-ct-uimg-' + cidcomments);
					}
					if (thisuserimg) {
						if (jQuery('#' + thisuserimg.id).hasClass('tx-tc-nodisp')) {
							jQuery('#' + thisuserimg.id).removeClass('tx-tc-nodisp');
						}
						thisuserimg.style.display= 'block';
						thisuserimg.style.margin=userpicmargin;
					}
				}
				jQuery('#formhider-' + cidcomments).slideDown();
				jQuery('#formhider-' + cidcomments).css("overflow","visible");
				
				if (confagbchck == 1) {
					var cookieval = toctoc_comments_pi1_readCookie('toctoc_comments_pi1_tc');
					if (thistermscheckbox) {
						if ((cookieval == 0) || (cookieval == null)) { 
							thistermscheckbox.value = '0';
							thistermscheckbox.checked = false;
						} else {
							thistermscheckbox.value = '1';
							thistermscheckbox.checked = true;
						}
					}
				}

				if (thiscontenttextbox.value == '') {
					elemcap=document.getElementById('tx-tc-div-submit' + cidcomments);
					if ((loginRequiredIdLoginForm === '') || (global_loggedon === 1)){
						if (elemcap.style.opacity !== '0.5'){
							//chnginl uhhh
							jQuery('#tx-tc-div-submit' + cidcomments).css('opacity', '0.6');
						}

						jQuery('#formhider-' + cidcomments).css('opacity', '0.6');
					}
					
					if ((global_loggedon === 0) && (tclogincard !== '')) {
						jQuery('#tx-tc-div-submit' + cidcomments).css('opacity', '1');
					}
					
					elemcap=document.getElementById('tx-tc-' + cidcomments + 'uploaddiv');
					if (elemcap){
						elemcap.style.visibility='hidden';
					}

					if (global_loggedon !== 1){

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'firstname');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'commenttitle');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'lastname');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'homepage');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'location');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'email');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'notify');
						if (elemcap){
							elemcap.disabled = true;
						}

						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'acceptterms');
						if (elemcap){
							elemcap.disabled = true;
						}
						
						elemcap=document.getElementById('tx-tc-ct-form-gender' + cidcomments);
						if (elemcap){
							elemcap.style.visibility='hidden';
						}

					} else {
						elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'commenttitle');
						if (elemcap){
							elemcap.disabled = true;
						}

					}

				}

				tttip('t101','#tx-tc-uimg-' + cidcomments + '[title]');
				tttip('t201','#tx-tc-' + cidcomments + 'uploaddiv img[title]');
				tttip('t101','#toctoc_comments_pi1_' + cidcomments + 'notify[title]');
		};
}

/*
Form functions - data validatation
*/

function searchform_validate(cidcomments) {
	var Searchemptyerror=utf8_decode(tcb64_dec(textErrSearchNull));
	var requiredsearchlength=errSearchRequiredLength;
	var Searchtoshorterror=utf8_decode(tcb64_dec(textErrSearchLength));
	var strelemid='toctoc_comments_pi1_'+cidcomments+'search';
	var testval = tctrim(document.getElementById(strelemid).value);
	testval = testval.replace(/\"/g, '');
	testval = testval.replace(/\%/g, '');
	testval = testval.replace(/\t/g,'');

	var lenvalue = testval.length;
	if (testval === "") {
		document.getElementById(strelemid).value = testval;
		information(Searchemptyerror,cidcomments, function () {});
		document.getElementById(strelemid).focus();
		return false;
	}
	
	if (lenvalue < requiredsearchlength) {
		document.getElementById(strelemid).value = testval;
		information(Searchtoshorterror,cidcomments, function () {});
		document.getElementById(strelemid).focus();
		return false;
	}
	
	return true;	
	
}
function commentform_validate(cidcomments, cidnropt) {
	if (nomessagedisplay==0) {
		var textemptyerror=utf8_decode(tcb64_dec(textErrCommentNull));
		var requiredcommentlength=errCommentRequiredLength;
		var texttoshorterror=utf8_decode(tcb64_dec(textErrCommentLength));
		var strelemid=cidcomments;
		if (!tcisInt(cidcomments)) {
			cidcomments=cidnropt;
		} else {
			strelemid=tctnme + cidcomments;
		}
		var cidtest = '';
		cidtest =cidcomments;
		var cidtestarr = String(strelemid).split("6g9");
		if (cidtestarr.length === 3) {
			cidcomments=cidtestarr[0].replace(tctnme,'');
		}
		
		var reviewuid = '';
		if (global_loggedon == 1) {
			var elemRvw = sortReviewDoneArr[cidcomments];
			if (elemRvw) {
				reviewuid = 'uid' + sortReviewDoneArr[cidcomments] + cidcomments;
				if (document.getElementById(reviewuid)) {
					var reviewtest = document.getElementById(reviewuid).innerHTML;
					
					if ((reviewtest.split('div class="tx-tc-myrts-myrt tx-tc-yourreview"></div>')).length > 1) {
						texttoshorterror=utf8_decode(tcb64_dec(textErrNotReviewed));
						information(texttoshorterror,cidcomments, function () {});
						document.getElementById(strelemid).focus();
						return false;
					}
				}
			}
		}
		
		
	
		if (document.getElementById(strelemid).value === "") {
			information(textemptyerror,cidcomments, function () {});
			document.getElementById(strelemid).focus();
			return false;
		}
	
		var lenvalue = document.getElementById(strelemid).value.length;
		if (lenvalue < requiredcommentlength) {
			information(texttoshorterror,cidcomments, function () {});
			document.getElementById(strelemid).focus();
			return false;
		}
		if ((confagbchck == 1) && (cidcomments !=1)) {
			var cookieval = toctoc_comments_pi1_readCookie('toctoc_comments_pi1_tc');
			
			if ((cookieval == 0) || (cookieval == null)) { 
				information(utf8_decode(tcb64_dec(texttermscond)),cidcomments, function () {});
				document.getElementById(strelemid).focus();
				return false;
			}
		}
	} else {
		return false;
	}
	return true;
}

function tcOpenFile(uploadinputid,iuploadtype)
{
	uploadtype=iuploadtype;
	document.getElementById(uploadinputid).click();
}

function toctoc_comments_fadein (docelem) {
	var opanow=0;
	opanow= getopacity(docelem);
	var opanew=0;
	opanew = parseFloat(opanow)+parseFloat("0.1");
	if (parseFloat(opanew) <= 0.95) {
		setopacity(docelem,opanew,'toctoc_comments_fadein');
		timeoutID = window.setTimeout("toctoc_comments_fadein('" + docelem + "')", 50);

	} else {
		setopacity(docelem,1,'toctoc_comments_fadein');
		return true;
	}
}
function toctoc_comments_fadeout(docelem) {
	var opanow=1;
	var elemdocelem = document.getElementById(docelem);
	if (elemdocelem) {
		if (elemdocelem.style.opacity) {
			opanow=elemdocelem.style.opacity;
		} else {
			opanow=1;
		}
		var opanew=0;
		opanew = parseFloat(opanow)-0.1;
		if (parseFloat(opanew) >= 0.1) {
			setopacity(docelem,opanew,'toctoc_comments_fadeout');
			timeoutID = window.setTimeout("toctoc_comments_fadeout('" + docelem + "')", 50);

		} else {
			jQuery('#' + docelem).addClass('tx-tc-nodisp');
			jQuery('#' + docelem).removeClass('tx-tc-blockdisp');
			return true;
		}
	} else {
		return true;
	}

}

function toctoc_comments_uc_fadeout (cssid, commentid,timeout) {
	if (document.getElementById(cssid)) {
		if (uc_closed[commentid]<3) {
			if (document.getElementById(cssid).style.display !== 'none') {
				opanow= getopacity(cssid);
				opanew=parseFloat(opanow)-0.1;
				if (opanew >= 0.1) {
					setopacity(cssid,opanew,'toctoc_comments_uc_fadeout');
					timeoutID = window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "', '" + commentid + "', '" + timeout + "')", 50);
	
				} else {
					document.getElementById(cssid).style.display = 'none';
					document.getElementById(cssid).style.height = '0px';
					uc_closed[commentid]=0;
					return true;
				}
			} else {
				return true;
			}
		} else if (uc_closed[commentid] === 10)  {
			uc_closed[commentid]=2;
			timeoutID = window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "', '" + commentid + "', '" + timeout + "')", timeout);
		}
	}

}
function toctoc_comments_uc_close(commentid){
	(function($) {
		$('#tx-tc-cts-uc-' + commentid).fadeOut( "slow", function() {
			tttip('hide');
			tttip('hide2');
			tttip('hideemo');
			setopacity('tx-tc-cts-uc-' + commentid,0,'toctoc_comments_uc_close');
			document.getElementById('tx-tc-cts-uc-' + commentid).style.display= 'none';
			document.getElementById('tx-tc-cts-uc-' + commentid).style.height = '0px';
			uc_closed[commentid]=20;
		});
	})(jQuery);
}
function toctoc_comments_ftm_close(cid){
	setopacity('tx-tc-cts-ftm-' + cid,0,'toctoc_comments_ftm_close');
	document.getElementById('tx-tc-cts-ftm-' + cid).style.display= 'none';
	document.getElementById('tx-tc-cts-ftm-' + cid).style.height = '0px';

}
function toctoc_comments_uc_show (timeout, cssid, commentid) {
	timeoutID = window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "', '" + commentid + "', '" + timeout + "')", timeout);
	return true;
}
function show_uc_delayed(commentid,timeoutms) {
	(function($)  {	
		$('#tx-tc-cts-uc-' + commentid).css('height', 'auto');
		$('#tx-tc-cts-uc-' + commentid).css('opacity', '1');

		$('.tx-tc-ct-box-ctclose').css('visibility', 'visible');
		$('#tx-tc-cts-uc-' + commentid).css('transform', 'scale(1,1) translate(0px, 20px)');
		$('#tx-tc-cts-uc-' + commentid).css('-webkit-transform', 'scale(1,1) translate(0px, 20px)');
		$('#tx-tc-cts-uc-' + commentid).fadeIn( "slow", function() {
			setopacity('tx-tc-cts-uc-' + commentid,'1','show_uc_delayed');			
			$('#tx-tc-cts-uc-' + commentid).css('display', 'block');
			toctoc_comments_uc_show(timeoutms, 'tx-tc-cts-uc-' + commentid, commentid);
		});
	 })(jQuery);
}
function show_uc(commentid, cid, commentsAjaxData,toctocuid,imgstr,timeoutms) {
	(function($) {
	 	if (uc_closed[commentid] === 20) {
			uc_closed[commentid]=10;
		} else {
			uc_closed[commentid]=1;
		}
	 	
	 	var doload = 0;
	 	if (parseInt(document.getElementById('tx-tc-cts-uc-inner-' + commentid).innerHTML.length) < 100) {
	 		document.getElementById('tx-tc-cts-uc-inner-' + commentid).innerHTML='<p><b>'+ utf8_decode(tcb64_dec(textLoading)) + '</b></p>';
	 		doload = 1;
	 	}
	 	
	 	setopacity('tx-tc-cts-uc-' + commentid,'1','show_uc');
		$('#tx-tc-cts-uc-' + commentid + ' .tx-tc-ct-box-ctclose').css('visibility', 'hidden');
		$('#tx-tc-cts-uc-' + commentid).css('transform', 'scale(0.6, 0.6) translate(0px, 0px)');
		$('#tx-tc-cts-uc-' + commentid).css('-webkit-transform', 'scale(0.6, 0.6) translate(0px, 0px)');
		$('#tx-tc-cts-uc-' + commentid).css('height', '60px');
		
		if (doload != 0){
			setTimeout(function() {
			$('#tx-tc-cts-uc-' + commentid).css('display', 'block');
				setTimeout(function() {
				 	$('#tx-tc-cts-uc-' + commentid).fadeIn( "fast", function() {
				 		
					 		setopacity('tx-tc-cts-uc-' + commentid,'1','show_uc');
							
				 		
				 	});
				}, 1);
			}, 1);
			
		} 
			if (doload != 0) {
				setTimeout(function() {
					$.ajax({
						type: 'POST',
						url: 'index.php?eID=toctoc_comments_ajax',
						async: false,
						data: 'ajaxdna=' + ajaxdna + '&cmd=getuc&imagetag=' + imgstr + '&toctocuserid=' + toctocuid + '&data=' + commentsAjaxData + '&cid=' + cid + '&commentid=' + commentid,
						success: function(html){
							var htmlpicarr = String(html).split('src="');
							var htmlpicarr2 = String(htmlpicarr[1]).split('\"');
							var piclink = '';
							var isgravatar = 0;
							if (html != String(html).replace('gravatar.','')) {
									isgravatar = 1;
							}
												
							if (isgravatar == 0) {
								piclink = htmlpicarr2[0];
							} else {
								htmlpicarr = String(html).split('gravatar.');
								htmlpicarr2 = String(htmlpicarr[1]).split('\"');
								piclink = '';
								if (htmlpicarr2[0]) {
									piclink = 'gravatar.' + htmlpicarr2[0];
									if (String(htmlpicarr[0]).replace('secure.') != String(htmlpicarr[0])) {
										piclink = 'https://secure.' + piclink;
									} else {
										piclink = 'http://www.' + piclink;
									}
		
								}
		
							}	
							
							$('#tx-tc-cts-uc-' + commentid).fadeOut( "fast", function() {
								$('#tx-tc-cts-uc-inner-' + commentid).html(html);
								
								if (document.getElementById('tx-tc-cts-uc-pic2-' + commentid).innerHTML === '***') {
									document.getElementById('tx-tc-cts-uc-pic2-' + commentid).innerHTML='';
									$('#tx-tc-cts-uc-pic2-' + commentid).css('display', 'block');
									$('#tx-tc-cts-uc-pic2-' + commentid).css('width', '364px');
									$('#tx-tc-cts-uc-pic2-' + commentid).css('background', 'url(\'' + piclink + '\') repeat scroll center center transparent');
								}
			
								tttip('t10-12','.tx-tc-ct-uc-pic img[title]');
								tttip('t101',"#tx-tc-cts-uc-inner-" + commentid + " img[title]");
								tttip('t10-16',"#tx-tc-cts-uc-" + commentid + " input[title]");
							});
							
							
							
							
						}
					});
				}, 2);
			} else {
				setopacity('tx-tc-cts-uc-' + commentid,'0','show_uc_delayed');			
				$('#tx-tc-cts-uc-' + commentid).css('display', 'block');
	
			}

			timeoutID = window.setTimeout("show_uc_delayed('" + commentid + "', " + timeoutms + ")", 2);
	 })(jQuery);
}

/*
jQuery - tooltips
*/
function tttip(styletip, elementid) {
	(function($) {

		if (locshowlesstooltips == 0) {
			if (styletip === 'hide') {
				$('.tx-tc-tooltip').hide();
			} else if (styletip === 'hide2') {
				$('.tx-tc-tooltip2').hide();
			} else if (styletip === 'hideemo') {
				$('.tx-tc-tooltipemoji').hide();
			} else {
				if (styletip === 't101') {
					$("" + elementid + "").cooltip({position: 'top center', offset: [-1,0],effect: 'fade', opacity: 1, tipClass: 'tx-tc-tooltip'});
				} else if  (styletip === 't101e') {
					$("" + elementid + "").cooltip({position: 'top center', offset: [-1,0],opacity: 0.9, tipClass: 'tx-tc-tooltipemoji'});
				} else if  (styletip === 't101er') {
					$("" + elementid + "").cooltip({position: 'top right', offset: [-1,-18],opacity: 0.9, tipClass: 'tx-tc-tooltip2'});
				} else if  (styletip === 't101erb') {
					$("" + elementid + "").cooltip({position: 'bottom center', offset: [5,20],opacity: 0.8, tipClass: 'tx-tc-tooltip2'});
				} else if  (styletip === 't10-12') {
					$("" + elementid + "").cooltip({offset: [-12, 0], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
				} else if  (styletip === 't10-16') {
					$("" + elementid + "").cooltip({offset: [-1, -16], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
				} else if  (styletip === 't10-18') {
					$("" + elementid + "").cooltip({offset: [-1, -18], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
				}  else if  (styletip === 't201') {
					$("" + elementid + "").cooltip({position: 'top right', offset: [-1,0], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip2'});
				} else if  (styletip === 't201-5') {
					$("" + elementid + "").cooltip({position: "top right", offset: [5,-5], effect: 'fade', opacity: 1, tipClass: 'tx-tc-tooltip2'});
				} else if  (styletip === 'temo') {
					if (emojinotooltips == 0) {
						$("" + elementid + "").cooltip({offset: [-1, 0], effect: 'fade', opacity: 1, tipClass: 'tx-tc-tooltipemoji'});
					} else {
						$("" + elementid + "").removeAttr('title');
					}

				} else if (styletip === 't201-65') {
					$("" + elementid + "").cooltip({position: "top right", offset: [-1,-65],effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip2'});
				} else if (styletip === 't201-20') {
					$("" + elementid + "").cooltip({offset: [2, 0],opacity: 1, tipClass: 'tx-tc-tooltip2' }).dynamic({ bottom: { direction: 'down', bounce: true} });
				}
			}
		} else {

			if (styletip === 'hide') {
				$('.tx-tc-tooltip').hide();
			} else if (styletip === 'hide2') {
				$('.tx-tc-tooltip2').hide();
			} else if (styletip === 'hideemo') {
				$('.tx-tc-tooltipemoji').hide();
			} else {
				if  (styletip === 't101') {
					if (elementid != 'span.tx-tc-scopetitlebold[title]') {
						$("" + elementid + "").cooltip({position: 'top center', offset: [-1,0],effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
					} else {
						$("" + elementid + "").removeAttr('title');
					}
				} else if  (styletip === 't101e') {
					$("" + elementid + "").removeAttr('title');
				} else if (styletip === 't101er') {
					$("" + elementid + "").removeAttr('title');
				} else if (styletip === 't101erb') {
					$("" + elementid + "").removeAttr('title');
				} else if  (styletip === 't10-12') {
					$("" + elementid + "").cooltip({offset: [-12, 0], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
				} else if  (styletip === 't10-16') {
					$("" + elementid + "").cooltip({offset: [-1, -16], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
				} else if  (styletip === 't10-18') {
					$("" + elementid + "").cooltip({offset: [-1, -18], effect: 'fade',opacity: 1, tipClass: 'tx-tc-tooltip'});
				}  else if  (styletip === 't201') {
					$("" + elementid + "").removeAttr('title');
				} else if  (styletip === 't201-5') {
					$("" + elementid + "").removeAttr('title');
				} else if  (styletip === 'temo') {
					$("" + elementid + "").removeAttr('title');
				} else if (styletip === 't201-65') {
					$("" + elementid + "").removeAttr('title');
				} else if (styletip === 't201-20') {
					$("" + elementid + "").cooltip({offset: [2, 0],opacity: 1, tipClass: 'tx-tc-tooltip2' }).dynamic({ bottom: { direction: 'down', bounce: true} });
				}
			}
		}
	})(jQuery);
}
/*
 * CRUD functions
 */
function patchtemppicresshow(picressshow, commentid, cid) {
	if (global_loggedon === 1) {
		var strnew = 'tx-tc-cts-img-c' + commentid;
		var strold = 'tx-tc-uimg-' + cid;
		picressshow = picressshow.replace(strold,strnew);
		picressshow = picressshow.replace(' margin: 4px 0px 0px;','');
		picressshow = picressshow.replace(' margin: 8px 0px 0px 4px;','');
		picressshow = picressshow.replace('display: block;','');
		picressshow = picressshow.replace('display: none;','');
		picressshow = picressshow.replace('style="" ','');
		picressshow = picressshow.replace(' class="tx-tc-margin0"',' class="tx-tc-margin0 tx-tc-nodisp"');
		if (picressshow.indexOf('tx-tc-nodisp') === -1) {
			picressshow = picressshow.replace('class="tx-tc-userpic','class="tx-tc-userpic tx-tc-nodisp');
		}
		picressshow = picressshow.replace('align="left" ','');
	}
	return picressshow;
}
function toctoc_comments_delete(id, rating, ajaxData, check, action, cssident, datac, thisdata, commentid, cid, parentid,commentsImgs,refshow, extid) {
	var str1=this.toctoc_comments_pi1_serialize(tctreestate);
	var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);
	var txtDeleteConfirm=utf8_decode(tcb64_dec(textDeleteConfirm));
	var cannotdelete=0;
	var delok=0;
	var extidroot= extid;
	var cidtestarr = String(extid).split("6g9");
	if (cidtestarr.length === 3) {
		extidroot=cidtestarr[0];
	}
	
	if (global_loggedon == 1) {
		if (sortReviewArr[extidroot]) {
			sortReviewArr[extidroot] = 0;
		}
		
	}
	
	tcconfirm(txtDeleteConfirm,cid, function () {
		var elem=document.getElementById('tx-tc-cts-img-' + commentid);
		var picressshow ='';
		if (elem) {
			picressshow = document.getElementById('tx-tc-cts-img-' + commentid).outerHTML;
		} else {
			picressshow = document.getElementById('tx-tc-cts-img-c' + cid).outerHTML;
		}
		
		picressshow = patchtemppicresshow(picressshow, commentid, cid);
		picressend = this.toctoc_comments_pi1_base64_encode(picressshow);
		setopacity('tx-tc-' + cssident + '-dp-' + id,'0.4','toctoc_comments_delete');
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			async: false,
			data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + commentid + '&check=' + check + '&cmd=' + action + '&cid=' + cid,
			success: function(html){
				if (html !== "<div>db403</div>") {
					jQuery('#tx-tc-' + cssident + '-' + id).html(html);

					jQuery('#tx-tc-' + cssident + '-' + id).css('min-height', '0px');
				} else {
					cannotdelete=1;
					parentid=1;
				}
				delok=1;
				if (parentid != 0) {
					delok=0;
					setopacity('tx-tc-cts-dp-' + refshow,'0.4','toctoc_comments_delete');
					jQuery.ajax({
						type: 'POST',
						url: 'index.php?eID=toctoc_comments_ajax',
						async: false,

						data: 'ajaxdna=' + ajaxdna + '&ref=' + refshow + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=0&check=' + check + '&cmd=showcomments'  + '&userpic=' + picressend + '&commentsimgs=' + commentsImgs + '&tctreestateenc=' + tctreestateenc + '&softcheck=1' + '&extref='  + extidroot,
						success: function(html){
							sortArr = [];
							sortReviewArr = [];
							sortReviewDoneArr = [];
							if (html.indexOf('<div id="dummy"></div>')>0){
								var htarr=html.split('<div id="dummy"></div>');
								tophtml=htarr[0];
								html=htarr[1];
								jQuery('#tx-tc-cts-dp-split-' + refshow).html(tophtml);
								timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-dp-split-" + refshow+ "')", 100);
								timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-dp-split-" + refshow+ "')", 110);
							}

							jQuery('#tx-tc-cts-' + refshow).html(html);
							timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-" + refshow+ "')", 100);
							timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-" + refshow+ "')", 110);

						}
					});
				}
			}
		});
		timeoutID = window.setTimeout("tttip('hide');", 1000);
		if (cannotdelete == 0) {
			jQuery('#tx-tc-pi1-form-' + refshow).removeClass('tx-tc-nodisp');
			delok=this.updatecommentscount(cid,-1);
		}
		
		if (cannotdelete === 1) {
			messageon=true;

		}
		
	});
}
function cannotdelete (cid) {
	textmsg = utf8_decode(tcb64_dec(textmessagecannotdelete));
	information(textmsg,cid, function () {});
	timeoutID = window.setTimeout("tttip('hide');", 1000);
	messageon=false;
	return false;
}
function cannotinsert (cid) {
	textmsg = utf8_decode(tcb64_dec(textmessagecannotinsert));
	information(textmsg,cid, function () {});
	messageon=false;
	return false;
}
function tcconfirm(message,cid,callback, bypass) {
	if (bypass != 1) {
		jQuery('#confirm'+cid).txtcmoddlg({
			closeHTML: "<a href='#' title='"+ utf8_decode(tcb64_dec(textDgClose)) + "' class='txtcmoddlg-close'>x</a>",
			position: ["20%"],
			overlayId: 'confirm-overlay',
			containerId: 'confirm-container',
			onShow: function (dialog) {
				var txtcmoddlg = this;
				jQuery('.message', dialog.data[0]).html(message);
	
				// if the user clicks "yes"
				jQuery('.yesconfirm', dialog.data[0]).click(function () {
					// call the callback
	
					if (jQuery.isFunction(callback)) {
						callback.apply();
					}
	
					// close the dialog
					txtcmoddlg.close();
				});
			}
		});
		if (!messageon) {
			return true;
		}
	}
}

function information(message,cid, callback) {

	jQuery('#information'+cid).txtcmoddlg({
		closeHTML: "<a href='#' title='"+ utf8_decode(tcb64_dec(textDgClose)) + "' class='txtcmoddlg-close'>x</a>",
		position: ["20%"],
		overlayId: 'confirm-overlay',
		containerId: 'confirm-container',
		onShow: function (dialog) {
			var txtcmoddlg = this;
			jQuery('.message', dialog.data[0]).html(message);

			// if the user clicks "yes"
			jQuery('.yes', dialog.data[0]).click(function () {
				// call the callback
				if (jQuery.isFunction(callback)) {
					callback.apply();
				}
				// close the dialog
				txtcmoddlg.close();
			});
		}
	});
}
function toctoc_comments_denotify(id, rating, ajaxData, check, action, cssident, datac, thisdata, capsess, cid) {
	setopacity('dnf' + capsess,'0.4','toctoc_comments_denotify');
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + capsess + '&check=' + check + '&cmd=' + action + '&cid=' + cid,
		success: function(html){
			jQuery('#dnf' + capsess).html(html);
		}
	});
	jQuery('#dnf' + capsess).css('display', 'none');
}
function tc_fixDOMattr(strPartDOM, patterin, starttagpattern) {
	// fixes the attributes order in the HTML of the DOM, which can differ from the Output-HTML if the id is before the class
	// text, 'id="tx-tc-cts-ct-tx-tc-cts_', '<div'
	var testifDOMok = strPartDOM.replace(starttagpattern + ' ' + patterin);
	var DOMarrWorkOut = [];
	if (testifDOMok == strPartDOM) {
		//DOM not like expected}

		var DOMarr = strPartDOM.split(patterin);
		var strPartDOMlength = DOMarr.length;
		var startoftag = '';
		var movefromstartoftag = [];
		var newstartoftag = '';
		var DOMarrOut = [];
		if (strPartDOMlength > 1) {
			for (i=1;i<strPartDOMlength;i++) {
				startoftag = (DOMarr[i-1]).substr((DOMarr[i-1]).lastIndexOf(starttagpattern));
				movefromstartoftag[i-1] = startoftag.substr(starttagpattern.length);
			}
			for (i=0;i<movefromstartoftag.length;i++) {
				DOMarrOut = strPartDOM.split(movefromstartoftag[i]);
				strPartDOM = DOMarrOut.join(' ');
			}
			
			DOMarr = strPartDOM.split(starttagpattern + ' ' + patterin);
			strPartDOMlength=DOMarr.length;
			var linesplitarr = [];
			var restofID = '';
			DOMarrOut = [];
			DOMarrOut[0] =DOMarr[0] ;
			for (i=1;i<strPartDOMlength;i++) {				
				linesplitarr = DOMarr[i].split('"');
				restofID = linesplitarr[0] + '"';
				restofLine = DOMarr[i].substr(restofID.length+1);				
				DOMarrOut[i] = starttagpattern + ' ' + patterin + restofID + movefromstartoftag[i-1] + restofLine;
			}
			
			strPartDOM = DOMarrOut.join('');			
			DOMarr = strPartDOM.split(starttagpattern + ' ' + patterin);			
		}
		
	}
	
	return strPartDOM;
}
function toctoc_comments_sort(id, action, cid) {
	var ret = 'ready';
	(function($) {
		var cssident = 'cts';
		
		var oldhtml = $('#tx-tc-' + cssident + '-' + cid).html();
		oldhtml = tc_fixDOMattr(oldhtml, 'id="tx-tc-cts-ct-tx-tc-cts_', '<div');
		var review = 0;
		if (global_loggedon == 1) {
			var elemRvw = sortReviewArr[cid];
			if (elemRvw) {
				review = sortReviewArr[cid];
			}
		}
		// make list of comments in oldhtml
		var presentorderofcommentsarr = oldhtml.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
		var cntpresentorderofcommentsarr = presentorderofcommentsarr.length;
		var removerefreshidarr = [];
		idx=1+review;
		if (tctrim(presentorderofcommentsarr[0]) == '') {
			idx=2+review;
		}
		presentorderidarr = [];
		var presentorderidontoparr = [];
		var topi = 0;
		var commentid = 0;
		for (i=idx;i<cntpresentorderofcommentsarr;i++) {
			presentorderofcommentsidarr = presentorderofcommentsarr[i].split('"');
			presentorderidarr[i-idx] = presentorderofcommentsidarr[0];
			commentid  = String(presentorderofcommentsidarr[0]);
			if (!sortArr[commentid]) {
				ret = 'notready';
				return;
			}
			
			if (sortArr[commentid][6]) {
				if (sortArr[commentid][6] == '0') {
					presentorderidontoparr[topi] = commentid;
					topi++;
				}
			} else {
				console.log('for i=' + i + ' found weird commentid ' + commentid);
			}
	
		}
		dirtySort=0;
		if (sortArr[commentid]) {
			if (sortArr[commentid][2] == 1) {
				if (action < 2) {
					dirtySort=1;
				}
			} else {
				if (sortArr[commentid][1] != action) {
					dirtySort=1;
				}
			}
		} 
		
		dirtySortArr[id] = dirtySort;
		var appendtocommentid = String(commentid);
		var neworderidontoparr = [];
		topi = 0;
		var newpos = 0;
		var checkorigpos = 0;
		var checksrchpos = 0;
		var popcand1 = 0.01;
		var popcand2 = 0.01;
		var crdate = 0;
		var unixts = Math.round(+new Date()/1000);
		var cntpresentorderidontoparr = presentorderidontoparr.length;
		for (i=0;i<cntpresentorderidontoparr;i++) {
			if (action == 0 ) {
				checkorigpos = presentorderidontoparr[i];
				//sort ascend, oldest first
				for (j=0;j<cntpresentorderidontoparr;j++) {
					checksrchpos=presentorderidontoparr[j];
					if (sortArr[checksrchpos][3] < sortArr[checkorigpos][3] ) {
						//[checksrchpos][3] older
						newpos++;
					}
				}
				neworderidontoparr[newpos] = sortArr[presentorderidontoparr[i]][0];
				newpos = 0;
			}
			if (action == 1 ) {
				checkorigpos = presentorderidontoparr[i];
				//sort ascend, oldest first
				for (j=0;j<cntpresentorderidontoparr;j++) {
					checksrchpos=presentorderidontoparr[j];
					if (sortArr[checksrchpos][3] > sortArr[checkorigpos][3] ) {
						//[checksrchpos][3] newer
						newpos++;
					}
				}
				neworderidontoparr[newpos] = sortArr[presentorderidontoparr[i]][0];
				newpos = 0;
			}
			if (action == 2 ) {
				checkorigpos = presentorderidontoparr[i];
				//sort ascend, oldest first
				for (j=0;j<cntpresentorderidontoparr;j++) {
					checksrchpos=presentorderidontoparr[j];
					if (reverse = 0) {
						crdate = sortArr[checksrchpos][3];
					} else {
						crdate = (2*unixts-sortArr[checksrchpos][3]);
					}
					popcand1 = parseFloat(sortArr[checksrchpos][4] + '.' + crdate);
					if (reverse = 0) {
						crdate = sortArr[checkorigpos][3];
					} else {
						crdate = (2*unixts-sortArr[checkorigpos][3]);
					}
					
					popcand2 = parseFloat(sortArr[checkorigpos][4] + '.' + crdate);
					if (popcand1 > popcand2) {
						// this one goes on rank checksrchpos
						newpos++;
					}
				}
				neworderidontoparr[newpos] = sortArr[presentorderidontoparr[i]][0];
				newpos = 0;
			}
		}
		var neworderidarr = [];
		var nordri=0;
		var idontp=0;
		var dogob=0;
		for (i=0;i<cntpresentorderidontoparr;i++) {
			neworderidarr[nordri] = neworderidontoparr[i];
			idontp = neworderidontoparr[i];
			nordri++;
			dogob=0;
			cntpresentorderofcommentsarr = presentorderidarr.length;
			for (j=0;j<cntpresentorderofcommentsarr;j++) {
				if (presentorderidarr[j] == idontp) {
					dogob=1;				
				}
				
				if ((presentorderidarr[j] != idontp) && (dogob==1)) {
					if (sortArr[presentorderidarr[j]][6] == '0') {
						dogob=0;
					}
					
					if (dogob ==1) {
						neworderidarr[nordri] = presentorderidarr[j];
						nordri++;
					}
					
				}
				
			}
		}
		if (sortArr[appendtocommentid]) {
			var elemtoappendtoid = sortArr[appendtocommentid][7];
			for (j=0;j<cntpresentorderofcommentsarr;j++) {
				if (sortArr[neworderidarr[j]][7] != elemtoappendtoid) {
					$('#' + sortArr[neworderidarr[j]][7]).insertAfter($('#' + elemtoappendtoid));
				}
				
				elemtoappendtoid = sortArr[neworderidarr[j]][7];
			}	
		}
	})(jQuery,window,document);
	return ret;
}
function update_sort_menu(tccid) {
	(function($) {
		var tcidarr = String(tccid).split("__0");
		$('#tx-tc-sortlistlink_' + tccid).removeClass('tx-tc-blockdisp');
		$('#tx-tc-sortlistlink_' + tccid).addClass('tx-tc-nodisp');
		$('#sel_tx-tc-sortlistlink_' + tccid).removeClass('tx-tc-nodisp');
		$('#sel_tx-tc-sortlistlink_' + tccid).addClass('tx-tc-blockdisp');
		if (tcidarr[2] == '1') {
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').removeClass('tx-tc-blockdisp');
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').addClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').removeClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').addClass('tx-tc-blockdisp');
			if (document.getElementById('tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02')) {
				$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').removeClass('tx-tc-blockdisp');
				$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').addClass('tx-tc-nodisp');
				$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').removeClass('tx-tc-nodisp');
				$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').addClass('tx-tc-blockdisp');
			}
			
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).removeClass('tx-tc-sortind-pop');
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).removeClass('tx-tc-sortind-up');
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).addClass('tx-tc-sortind-down');
		} else if(tcidarr[2] == '0') {
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').removeClass('tx-tc-blockdisp');
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').addClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').removeClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').addClass('tx-tc-blockdisp');
			if (document.getElementById('tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02')) {
				$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').removeClass('tx-tc-blockdisp');
				$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').addClass('tx-tc-nodisp');
				$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').removeClass('tx-tc-nodisp');
				$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__02').addClass('tx-tc-blockdisp');
			}
			
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).removeClass('tx-tc-sortind-pop');
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).removeClass('tx-tc-sortind-down');
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).addClass('tx-tc-sortind-up');
		} else if(tcidarr[2] == '2') {
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').removeClass('tx-tc-blockdisp');
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').addClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').removeClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__01').addClass('tx-tc-blockdisp');
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').removeClass('tx-tc-blockdisp');
			$('#sel_tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').addClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').removeClass('tx-tc-nodisp');
			$('#tx-tc-sortlistlink_' + tcidarr[0] + '__0' + tcidarr[1]+ '__00').addClass('tx-tc-blockdisp');

			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).removeClass('tx-tc-sortind-up');
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).removeClass('tx-tc-sortind-down');
			$('#tx-tc-sortind_' + tcidarr[0] + '__0' + tcidarr[1]).addClass('tx-tc-sortind-pop');
		}				
	
		tccid = 'tx-tc-sortlistpanel_' + tcidarr[0] + '__0' + tcidarr[1];
		$('#' + tccid).removeClass('tx-tc-blockdisp');
		$('#' + tccid).addClass('tx-tc-nodisp');
	})(jQuery);
}
function toctoc_comments_browse(id, rating, ajaxData, check, action, cssident, datac, thisdata, startpoint, cid, totalrows,commentsImgs) {
	var str1=this.toctoc_comments_pi1_serialize(tctreestate);
	var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);

	setopacity('tx-tc-cts-ctsbrowse-' + cid, '0.4','toctoc_comments_browse 1');
	var elemhide = document.getElementById('tx-tc-cts-ctsbrowse-hide-' + cid);
	if (elemhide) {
		setopacity('tx-tc-cts-ctsbrowse-hide-' + cid, '0.4','toctoc_comments_browse 1');
	}
	var htarr='';
	var oldhtml = document.getElementById('tx-tc-' + cssident + '-' + id).innerHTML;
	oldhtml = tc_fixDOMattr(oldhtml, 'id="tx-tc-cts-ct-tx-tc-cts_', '<div');
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&startpoint=' + startpoint + '&check=' + check + '&cmd=' + action + '&cid=' + cid + '&totalrows=' + totalrows + '&commentsimgs=' + commentsImgs + '&tctreestateenc=' + tctreestateenc,
		success: function(html){
			if (html.indexOf('<div class="dummy"></div><div class="dummy2">') !== -1) {
				htarr=html.split('<div class="dummy"></div><div class="dummy2">');
				html=htarr[0];
				var htmlsessionvar=htarr[1];
				htmlsessionvar=htmlsessionvar.replace('</div>','');
				commentsAjaxDataLoginSess[cid]=htmlsessionvar;
			}

			if (html.indexOf('<div id="dummy"></div>')>0) {
				htarr=html.split('<div id="dummy"></div>');
				tophtml=htarr[0];
				html=htarr[1];
				jQuery('#tx-tc-cts-dp-split-' + id).html(tophtml);
				timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-dp-split-" + id+ "')", 100);
				timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-dp-split-" + id+ "')", 110);
			}
			
			html = tc_fixDOMattr(html, 'id="tx-tc-cts-ct-tx-tc-cts_', '<div');
			var showall=0;
			if (dirtySortArr[cid]) {
				if (dirtySortArr[cid] ==1) {
					showall=1;
					dirtySortArr[cid] = 0;
				}
			}

			var reverse = 1;
			var actionsort = 0;
			var sortpopular = 0;
			for (i=0; i< sortArr.length;i++) {
				if (sortArr[i]) {
					if (sortArr[i][8] == cid) {
						reverse = parseInt(sortArr[i][1]);
						sortpopular = sortArr[i][2];
						actionsort = reverse;
						break;
					}
				}
			}
			if (sortpopular == 1) {
				reverse = 1;
				actionsort = 2;
			}
			
			if (showall==1) {
				jQuery('#tx-tc-' + cssident + '-' + id).html(html);
				editon = false;
			
				update_sort_menu(id + '__0' + cid + '__0' + actionsort);
			
				var presentorderofcommentsarr = html.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
				var cntpresentorderofcommentsarr = presentorderofcommentsarr.length;
				idx=1;
				if (tctrim(presentorderofcommentsarr[0]) == '') {
					idx=2;
				}
				var presentorderidarr = [];

				for (i=idx;i<cntpresentorderofcommentsarr;i++) {
					presentorderofcommentsidarr = presentorderofcommentsarr[i].split('"');
					presentorderidarr[i-idx] = presentorderofcommentsidarr[0];
				}				
				for (i=0;i<presentorderidarr.length;i++) {
					timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ct-tx-tc-cts_" + presentorderidarr[i] + "')", ((i+2)*500));
					timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-ct-tx-tc-cts_" + presentorderidarr[i] + "')", 110);
				}
				timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ctsbrowse-" + cid + "')", 100);
				timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ctsbrowse-hide-" + cid + "')", 100);
				
			} else {
			// find last comment in '#tx-tc-' + cssident + '-' + id
				
				var reverse = 1;
				var sortpopular = 0;
				for (i=0; i< sortArr.length;i++) {
					if (sortArr[i]) {
						if (sortArr[i][8] == cid) {
							reverse = parseInt(sortArr[i][1]);
							sortpopular = sortArr[i][2];
							break;
						}
					}
				}
				if (sortpopular == 1) {
					reverse = 1;
				}
				
				var oldhtmlarr = oldhtml.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
				var cntoldhtmlarr = oldhtmlarr.length;
				var oldhtmlidarr = oldhtmlarr[parseInt(cntoldhtmlarr - 1)].split('"');
				var strlastcommentid = oldhtmlidarr[0];
				var oldhtmlidarrfirst = oldhtmlarr[1].split('"');
				var strfirstcommentid = oldhtmlidarrfirst[0];
				var strsplitcommentid = strlastcommentid;
				if (reverse == 0) {				
					strsplitcommentid = strfirstcommentid;
				}
	
				// find same comment in html, delete what was before (reverse=1) or fater (reverse=0) and same comment
				html = tc_fixDOMattr(html, 'id="tx-tc-cts-ct-tx-tc-cts_', '<div');
				var tmpnewhtmlarr = html.split('<div id="tx-tc-cts-ct-tx-tc-cts_' + strsplitcommentid);
				var idx=1;
				var refreshidarr = [];
				var strremovecommentid = '';
				var tmpnewhtml = '';
				var lesscomments=1;
	
				if (oldhtml.length < html.length) {
					lesscomments=0;
					if (reverse == 1) {
						tmpnewhtml = '<div id="tx-tc-cts-ct-tx-tc-cts_' + strsplitcommentid + tmpnewhtmlarr[1];
					} else {
						tmpnewhtml = tmpnewhtmlarr[0];
					}
				} else {
					// less comments. find last comment in new html
					var removehtmlarr = html.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
					var cntremovehtmlarr = removehtmlarr.length;
					var removehtmlarridx = parseInt(cntremovehtmlarr - 1);
					if (reverse == 0) {
						removehtmlarridx = 1;
					}
	
					//console.log('removehtmlarridx 2: ' +removehtmlarridx);
					var removehtmlarrhtmlidarr = removehtmlarr[removehtmlarridx].split('"');
					strremovecommentid = removehtmlarrhtmlidarr[0];
	
					// make list of comments in oldhtml
					var removerefreshhtmlarr = oldhtml.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
					var cntremoverefreshhtmlarr = removerefreshhtmlarr.length;
					var removerefreshidarr = [];
					idx=1;
					if (tctrim(removerefreshhtmlarr[0]) == '') {
						idx=2;
					}
	
					for (i=idx;i<cntremoverefreshhtmlarr;i++) {
						removerefreshhtmlidarr = [];
						removerefreshhtmlidarr = removerefreshhtmlarr[i].split('"');
						removerefreshidarr[i-idx] = removerefreshhtmlidarr[0];
					}
					// make remove list
					var removelist = [];
					var loadrmvs = 0;
					var rli = -1;
					if (reverse == 0) {
						loadrmvs = 1;
						for (i=0;i<(cntremoverefreshhtmlarr-1);i++) {
							if ((strremovecommentid == removerefreshidarr[i])) {
								loadrmvs = 0;
							}
	
							if (loadrmvs == 1) {
								if (removerefreshidarr[i]) {
									rli++;
									removelist[rli] = removerefreshidarr[i];
								}
	
							}
	
						}
					} else {
						loadrmvs = 1;
						for (i=(cntremoverefreshhtmlarr-1);i>=0;i--) {
							if ((strremovecommentid == removerefreshidarr[i])) {
								loadrmvs = 0;
							}
	
							if (loadrmvs == 1) {
								if (removerefreshidarr[i]) {
									rli++;
									removelist[rli] = removerefreshidarr[i];
								}
	
							}
	
						}
						
					}
	
				}
				tmpnewhtml = tc_fixDOMattr(tmpnewhtml, 'id="tx-tc-cts-ct-tx-tc-cts_', '<div');
				var newhtmlarr = tmpnewhtml.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
				var cntnewhtmlarr = newhtmlarr.length;
				var newhtml = '';
				idx=0;
				if (tmpnewhtml != '') {
					if (tctrim(newhtmlarr[0]) == '') {
						idx=1;
					}
	
					for (i=idx;i<cntnewhtmlarr;i++) {
						newhtml += '<div id="tx-tc-cts-ct-tx-tc-cts_' + newhtmlarr[i];
					}
				}
	
				// build list of commentbox-ids that must be bound
				var refreshhtmlarr = newhtml.split('<div id="tx-tc-cts-ct-tx-tc-cts_');
				var cntrefreshhtmlarr = refreshhtmlarr.length;
				var appendhtml = '';
	
				idx=1;
				if (tctrim(refreshhtmlarr[0]) == '') {
					idx=2;
				}
	
				var refreshhtmlidarr = [];
				var hasrefreshid = 0;
				for (i=idx;i<cntrefreshhtmlarr;i++) {
					refreshhtmlidarr = [];
					refreshhtmlidarr = refreshhtmlarr[i].split('"');
					appendhtml = appendhtml + '<div id="tx-tc-cts-ct-tx-tc-cts_' + refreshhtmlarr[i];
					refreshidarr[i-idx] = refreshhtmlidarr[0];
					hasrefreshid = 1;
				}
				if (appendhtml == '') {
					appendhtml=newhtml;
				}
	
				// get the browseform tx-tc-cts-ctsbrowse- replace its innerHTML by the new one
				var browsehtmlarr = appendhtml.split('<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' +cid + '">');
				var newcommentshtml = browsehtmlarr[0];
				var cntbrowsehtmlarr = browsehtmlarr.length;
	
				if (cntbrowsehtmlarr==1) {
					browsehtmlarr = html.split('<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' +cid + '">');
					cntbrowsehtmlarr = browsehtmlarr.length;
				}
	
				var browsedownhtmlarr = [];
				idx=1;
				var invertbrowser = 0;
				if (cntbrowsehtmlarr==1) {
					invertbrowser = 1;
				}
					
				var browsehtml = '';
				browsehtml = browsehtmlarr[idx].substr(0,browsehtmlarr[idx].lastIndexOf('</span>'))+'</span></div>';
				browsedownhtmlarr = browsehtml.split('</div>');
	
				var browsedownhtml = browsedownhtmlarr[0];
				var browseuphtml = '';
				if ((browsedownhtmlarr.length >1) && ((tctrim(browsedownhtml) != '</span>'))) {
					jQuery('#tx-tc-cts-ctsbrowse-' + cid).html(browsedownhtml);
					if (tctrim(browsedownhtml) != '') {
						timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ctsbrowse-" + cid + "')", 100);
					}
	
					browseuphtml = browsedownhtmlarr[1].replace('<div class="tx-tc-cts-ctsbrowse-hide" id="tx-tc-cts-ctsbrowse-hide-' +cid + '">','');
					if (oldhtml.length > html.length) {
						browseuphtml = '';
					}
					
					if (jQuery('#tx-tc-cts-ctsbrowse-hide-' + cid).html() != null) {
						jQuery('#tx-tc-cts-ctsbrowse-hide-' + cid).html(browseuphtml);
					} else {
						browseuphtml = '<div class="tx-tc-cts-ctsbrowse-hide" id="tx-tc-cts-ctsbrowse-hide-' +cid + '">' + browseuphtml +'</div>';
						jQuery('#tx-tc-cts-ctsbrowse-' + cid).after(browseuphtml);
					}
	
					timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ctsbrowse-hide-" + cid + "')", 200);
				} else {
					jQuery('#tx-tc-cts-ctsbrowse-hide-' + cid).remove();
					browsehtmlarr = html.split('<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' +cid + '">');
					var prebrowsedownhtml = '<div class="tx-tc-cts-ctsbrowse" id="tx-tc-cts-ctsbrowse-' +cid + '">' + browsehtmlarr[1];
					browsedownhtml = prebrowsedownhtml.substr(0,prebrowsedownhtml.lastIndexOf('</span>'))+'</span></div>';
					if (tctrim(browsedownhtml) != '') {
						jQuery('#tx-tc-cts-ctsbrowse-' + cid).html(browsedownhtml);
						timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ctsbrowse-" + cid + "')", 200);
					}
	
				}
	
				// append new comments html or remove
				if (lesscomments==1) {
					for (i=0;i<removelist.length;i++) {
						jQuery('#tx-tc-cts-ct-tx-tc-cts_' + removelist[i]).remove();
						if (edituid == removelist[i]) {
							editon = false;
						}
						
					}
					
				} else {
					if (reverse== 1) {
						jQuery('#tx-tc-cts-ct-tx-tc-cts_' + strsplitcommentid).after(newcommentshtml);
					} else {
						jQuery('#tx-tc-cts-ct-tx-tc-cts_' + strsplitcommentid).before(newcommentshtml);
					}
	
					for (i=0;i<refreshidarr.length;i++) {
						timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-ct-tx-tc-cts_" + refreshidarr[i] + "')", ((i+2)*500));
						timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-ct-tx-tc-cts_" + refreshidarr[i] + "')", 110);
					}
					
				}
				
			}
			
			html='';
		}
	
	});

	setopacity('tx-tc-cts-ctsbrowse-' + cid,'1','toctoc_comments_browse 2');
	elemhide = document.getElementById('tx-tc-cts-ctsbrowse-hide-' + cid);
	if (elemhide) {
		setopacity('tx-tc-cts-ctsbrowse-hide-' + cid, '1','toctoc_comments_browse 1');
	}
	
}
function updateCIDList(icid,irefrec) {
	if (loginRequiredIdLoginForm != '') {
		elem = document.getElementById(tctnme + icid);
		if (elem) {
			checkstr=loginRequiredRefreshCIDs.replace(icid+',', '');
			if (checkstr==loginRequiredRefreshCIDs) {
				loginRequiredRefreshCIDs = loginRequiredRefreshCIDs + icid + ',';
				loginRequiredRefreshRecs = loginRequiredRefreshRecs + irefrec + ',';
			}
			
		}
		
	}
	
}
function toctoc_comments_refresh(id, ttcontentid, commentidin, islogout) {
	// ex: 'tt_news_1001', '199', '1996g95296g9'
	if (islogout !== 1) {
		islogout=0;
	}

	var str1=this.toctoc_comments_pi1_serialize(tctreestate);
	var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);
	var idnrpos = id.lastIndexOf('_');
	var idnr = id.substr(idnrpos+1);
	idnr = idnr.replace("\'","");
	toctoc_comments_refresh_single(id, ttcontentid, commentidin, islogout,tctreestateenc);
	var CIDarr= loginRequiredRefreshCIDs.split(',');
	var Recarr= loginRequiredRefreshRecs.split(',');
	for (i= 0; i < CIDarr.length; i++) {
		if ((CIDarr[i] !== '') && (CIDarr[i] !== ttcontentid))  {
			toctoc_comments_refresh_single(Recarr[i], CIDarr[i], 0, islogout,tctreestateenc);
			idnrpos = Recarr[i].lastIndexOf('_');
			idnr = Recarr[i].substr(idnrpos+1);
			idnr = idnr.replace("\'","");
		}

	}
	
}
function toctoc_comments_refresh_single(id, ttcontentid, commentidin, islogout,tctreestateenc) {
	id=id.replace(/\'/g,'');
	var extidroot=id;
	var testid = id.replace('tt_content_','');
	if (testid === id) {
		id = 'tt_content_' + ttcontentid;
	}
	var idnrpos = id.lastIndexOf('_');
	var idnr = id.substr(idnrpos+1);
	idnr = idnr.replace("\'","");
	var cAjaxData = commentsAjaxData[idnr];
	var cAjaxDataImg = commentsAjaxDataImg[idnr];
	var cAjaxThisData = commentsAjaxThisData[idnr];
	// no piVars
	var cAjaxDataC = '';
	// getting the correct login/out conf
	var cAjaxDataLogin = '';
	if (islogout == 1) {
		cAjaxDataLogin = commentsAjaxDataLogout[idnr];
	} else {
		cAjaxDataLogin = commentsAjaxDataLogin[idnr];
	}
	var cAjaxDataLoginSess = commentsAjaxDataLoginSess[idnr];
	var rating = 1;
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: true,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating+ '&islogout=' + islogout + '&data=' + cAjaxData + '&dataLogin=' + cAjaxDataLogin + '&dataLoginSess=' + cAjaxDataLoginSess + '&isrefresh=1&datac=' + cAjaxDataC + '&datathis=' + cAjaxThisData + '&capsess=0&check=&cmd=showcomments&userpic=&commentsimgs=' + cAjaxDataImg + '&tctreestateenc=' + tctreestateenc + '&extref='  + extidroot,
		success: function(html){
			tttip('hide');
			var fullhtml = html;
			if (html.indexOf('<div id="dummy"></div>')>0){
				var htarr=html.split('<div id="dummy"></div>');
				tophtml=htarr[0];
				html=htarr[1];
				
				if (islogout == 1) {
					global_loggedon=0;
				} else {
					global_loggedon=1;
				}
				
				if (htarr.length > 3) {
					jQuery('#tx-tc-cts-dp-split-' + extidroot).html(tophtml);
					jQuery('#tx-tc-form-dp-' + extidroot).html(htarr[2]);
					jQuery('#tx-tc-cts-' + extidroot).html(html);
					htarr[3]=htarr[3].replace('<div>','');
					htarr[3]=htarr[3].replace('<\/div>','');
					commentsAjaxData[idnr]=htarr[3];				
					tcrebind('#tx-tc-cts-dp-split-' + extidroot);
					tcrebindemo('#tx-tc-cts-dp-split-' + extidroot);
					tcrebind('#tx-tc-form-dp-' + extidroot);
					tcrebindemo('#tx-tc-form-dp-' + extidroot);
					tcrebind('#tx-tc-cts-' + extidroot);
					tcrebindemo('#tx-tc-cts-' + extidroot);
				} else {
					if (htarr[2]) {
						jQuery('#tx-tc-cts-dp-' + extidroot).html(tophtml);
						jQuery('#tx-tc-form-dp-' + extidroot).html(html);
						htarr[2]=htarr[2].replace('<div>','');
						htarr[2]=htarr[2].replace('<\/div>','');
						commentsAjaxData[idnr]=htarr[2];
						tcrebind('#tx-tc-cts-dp-' + extidroot);
						tcrebindemo('#tx-tc-cts-dp-' + extidroot);
						tcrebind('#tx-tc-form-dp-' + extidroot);
						tcrebindemo('#tx-tc-form-dp-' + extidroot);						
					} else {
						console.log('Unexpected HTML from Server: ' + html);
					}

				}
				if (islogout == 1) {
					tcrebind('#tx-tc-sortlistmenu_' + extidroot + '__0' +idnr);
					tcrebindemo('#tx-tc-sortlistmenu_' + extidroot + '__0' +idnr);
					if (jQuery('#tx-tc-pi1-form-' + extidroot).hasClass('tx-tc-reviewform')) {
						if (jQuery('#tx-tc-pi1-form-' + extidroot).hasClass('tx-tc-nodisp')) {
							jQuery('#tx-tc-pi1-form-' + extidroot).removeClass('tx-tc-nodisp');							
						}
						
					}
					
				} else {
					if (jQuery('#tx-tc-pi1-form-' + extidroot).hasClass('tx-tc-reviewform')) {
						//console.log('is review');
						if (fullhtml.replace('tx-tc-ct-userreview','') != fullhtml) {
							//console.log('has userreview' + idnr);						
							var elemRvw = sortReviewDoneArr[idnr];
							if (elemRvw) {
								reviewuid = 'uid' + sortReviewDoneArr[idnr] + idnr;
								if (document.getElementById(reviewuid)) {
									var reviewtest = document.getElementById(reviewuid).innerHTML;
									
									if ((reviewtest.split('div class="tx-tc-myrts-myrt tx-tc-yourreview"></div>')).length == 1) {
										if ((reviewtest.split('div class="tx-tc-myrts-myrt tx-tc-yourreview">')).length > 1) {
											jQuery('#tx-tc-pi1-form-' + extidroot).addClass('tx-tc-nodisp');
										}
										
									}
									
								}
								
							}
							
						}
						
					}
					
				}
				
				if (commentidin !== 0) {
					var elemta=document.getElementById(tctnme + commentidin);
					if (elemta) {
						var commentidarr=commentidin.split('6g9');
						var cttextcurr = '';
						if (currentcommenttext[elemta.id]) {
							cttextcurr = currentcommenttext[elemta.id];
						}
						
						if (commentidarr.length>1) {
							var uid=commentidarr[1];
							if (confreplyModeInline === 1) {
								if (confreplyModeInlineOpenForm === 0) {
									jQuery('#tx-tc-ct-ry-fh-' + uid).css('display', 'none');
									jQuery('#tx-tc-cts-rply-' + uid).css('display', 'block');
									elemta.focus();
									elemta.value=cttextcurr;
									previewselcomment[idnr] = uid;
								} else {
									elemta.value=cttextcurr;
									elemta.focus();
									elemta.value=cttextcurr;
									previewselcomment[idnr] = uid;
								}
								
							}
							
						} else {
							commentidin=previewselcomment[idnr];
							elemta.value=cttextcurr;
							elemta.focus();
							elemta.value=cttextcurr;
							previewselcomment[idnr] = commentidin;
						}
						
						if (cttextcurr !== '') {
							previewstarted[idnr] = toctoc_checkurl(0, document.getElementById('toctoc_comments_pi1_contenttextbox_" + commentidin +"') ,commentidin, previewstarted[idnr], 'jedi', 0, '', '', maxCommentLength);
						}
						
					}
					
				}
				
				tttip('t101','span.tx-tc-ct-denotifybutton[title]');
			} else {
				console.log('success, but unexpected HTML from Server: ' + html);
			}
		},
		error: function (request, status, error) {
			console.log('error: unexpected HTML from Server: ' + status + ', error: ' +error);
		}
	});
}
function setucclick (jqid) {
	jQuery(jqid).on('click', function() {
		ucclick(this);
	});
}
function toctoc_comments_searchbrowse(cid, fromrow, brwseComm) {
	var toctoc_piVars = [];	
	toctoc_piVars['from'] = fromrow;
	toctoc_piVars['browsecommand'] = brwseComm;
	toctoc_piVars['conf'] = toctoc_comments_pi1_getUserDataField('confdiff',cid);
	toctoc_piVars['lang'] = activelang;
	toctoc_piVars['langid'] = pagelanId;
	var str1=this.toctoc_comments_pi1_serialize(toctoc_piVars);
	var str2=this.toctoc_comments_pi1_base64_encode(str1);
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&cmd=searchbrowse&ref='+ cid + '&data='+str2,
		success: function(html){
			jQuery('#txtcsearchresults' + cid).html(html);			
			timeoutID = window.setTimeout("tcrebind('#txtcsearchresults" + cid + "')", 100);
		}
	});
}
function toctoc_comments_search(cid, ajaxdata) {
	//txtcsearchworking###CID###
	
	if (jQuery('#txtcsearchworking' + cid).hasClass('tx-tc-nodisp')) {
		jQuery('#txtcsearchworking' + cid).removeClass('tx-tc-nodisp');		
		jQuery('#txtcsearchworking' + cid).addClass('tx-tc-blockdisp');		
		jQuery('#txtcsearchresults' + cid).html('');	
	}
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&cmd=searchcomment&ref='+ cid + '&data='+ajaxdata,
		success: function(html){
			jQuery('#txtcsearchworking' + cid).addClass('tx-tc-nodisp');
			jQuery('#txtcsearchworking' + cid).removeClass('tx-tc-blockdisp');		

			jQuery('#txtcsearchresults' + cid).html(html);			
			timeoutID = window.setTimeout("tcrebind('#txtcsearchresults" + cid + "')", 100);
		}
	});
}
function checksharrre() {
	if (shareTime > 0) {
		var ajaxdatasharrre = '';
		var str1=toctoc_comments_pi1_serialize(shareArr);
		ajaxdatasharrre = toctoc_comments_pi1_base64_encode(str1);
	
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			async: true,
			data: 'ajaxdna=' + ajaxdna + '&cmd=checksharre&data='+ajaxdatasharrre + '&pageid='+pageid + '&storagePid=' + storagePid,
			success: function(html){
				
			}
		});
	}
}
function toctoc_comments_submit(id, rating, ajaxData, check, action, cssident, datac, thisdata, capsess, cid, caperr,commentsImgs, loggedon, extid, webpagepreviewheight,windowpreviewhtml) {
	// loggedon obsolete
	var isarticle=1;
	if (!cssident) {
		return;
	}
	if ((cssident.indexOf("cts")>=0) || (cssident.indexOf("form")>=0)) {
		if (!jQuery("#"+tcsbmtnme + cid).hasClass("tx-tc-sbinit")) {
			return false;
		}

		var thumbstylemaxheight=parseInt(webpagepreviewheight) + 200;
		var thumbstyleminheight=parseInt(webpagepreviewheight) + 5;
		var formhidermoreheight=parseInt(webpagepreviewheight) + 13;
		var responsed=1;
		var commentid = tctrim(id.substr(11,1000));  // ex.: tt_content_1016

		var extidroot= extid;
		var cidtestarr = String(extid).split("6g9");
		var commentreplyid=0;
		if (cidtestarr.length === 3) {
			extidroot=cidtestarr[0];
			commentreplyid=parseInt(cidtestarr[1] + '' + cidtestarr[2]);
		}
		var mcid=cid; //mastercid
		cidtestarr = String(cid).split("6g9");
		if (cidtestarr.length === 3) {
			mcid=cidtestarr[0];
		}

		var picress = '';
		var picressshow ='';
		var picressend ='';
		if (global_loggedon === 1) {
			var picressorig = document.getElementById('tx-tc-uimg-' + commentid).outerHTML;
			picress = picressorig.replace('block','none');
			picressend = this.toctoc_comments_pi1_base64_encode(picress);
		} else {
			var cookieval = toctoc_comments_pi1_readCookie('toctoc_comments_pi1_dataProtect');			
			if (cookieval == null) { 
				toctoc_comments_pi1_eraseCookie('toctoc_comments_pi1_dataProtect');
				toctoc_comments_pi1_createCookie('toctoc_comments_pi1_dataProtect', 0, cookieLifetime);
			}
		}

		if (capsess === '1') {
			capsess = document.getElementById('toctoc_comments_pi1-cap-' + cid).value;
			setopacity('toctoc_comments_cap_' + cid,'0.4','toctoc_comments_submit 3');
			responsed=0;
			jQuery.ajax({
				type: 'POST',
				url: 'index.php?eID=toctoc_comments_ajax',
				async: false,
				data: 'ajaxdna=' + ajaxdna + '&cmd=checkcap&cid='+ cid + '&code='+capsess,
				success: function(response){

					if (response === '1') {
						responsed=1;
						capsess=4;
					} else {
						caperr=tctrim(caperr);
						if (caperr !== '') {
							jQuery('#tx-tc-cap-message-dp-' + cid).css('display', 'block');
							jQuery("#tx-tc-cap-message-" + cid).html(''  + caperr);

						} else {
							jQuery('#tx-tc-cap-message-dp-' + cid).css('display', 'none');
						}
						responsed=0;
					}
					setopacity('toctoc_comments_cap_' + cid,'1','toctoc_comments_submit 4');
				}
			});

		}

		if (responsed === 1) {
			var htmlretcode=0;
			var htmlretcodeapproval=0;
			setopacity('tx-tc-' + cssident + '-dp-' + extid,'0.4','toctoc_comments_submit 5');
			jQuery.ajax({
				type: 'POST',
				url: 'index.php?eID=toctoc_comments_ajax',
				async: false,
				data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=' + capsess + '&check=' + check + '&cmd=' + action + '&userpic=' + picressend + '&extref='  + extidroot + '&commentreplyid=' +commentreplyid,
				success: function(html){
					//console.log (html);
					console.log ("nomessagedisplay");
					nomessagedisplay = 1;
					htmlretcode= tctrim(html.substr(8,20));
					var posenddiv= htmlretcode.indexOf(">");
					htmlretcode= htmlretcode.substr(0,posenddiv);
					if (!tcisInt(htmlretcode)) {
						htmlretcode=0;
						htmlretcodeapproval=0;
					} else {
						var replstr='<div id=' + htmlretcode + '></div>';
						html = html.replace(replstr,'');
						// from: <div id=101' . $this->newcommentid . '>
						htmlretcodeapproval=tctrim(htmlretcode.substr(0,1));
						htmlretcode=parseInt(tctrim(htmlretcode.substr(3,20)));
					}
					if (html.split('tx-tc-reviewhideform').length > 1) {
						
						jQuery('#tx-tc-pi1-form-' + extid).addClass('tx-tc-nodisp');
					}
					//set html for form
					jQuery('#tx-tc-' + cssident + '-' + extid).html(html);

					//handling emojis
					var reresultucd = /(\\u)+/g;
					tmpcontent =document.getElementById(tctnme + cid).value;
					var cnvtmpcontent =  tmpcontent.replace(reresultucd, '%u');
					tmpcontent =  unescape(cnvtmpcontent);
					document.getElementById(tctnme + cid).value=tmpcontent;

					//tooltip notify checkbox
					tttip('t101',".tx-tc-ct-form-field-ntf input[title]");
					if ((windowpreviewhtml !== '') && (htmlretcode !== 0)) {
						previewhtml[cid] = '';
					}

					if (htmlretcode !== 0) {
						//hide reply on comment-frame if ever present
						var elem=document.getElementById('tx-tc-ct-ry-frame-' + cid);
						if (elem) {
							if (elem.style.display !== 'none') {
								elem.style.display= 'none';
							}
						}
					}
					if ((windowpreviewhtml !== '') && (htmlretcode === 0)) {
						jQuery('#tx-tc-form-wpp-' + cid).html(previewhtml[cid]);

						jQuery('#tx-tc-form-dp-wpp-' + cid).css('display', 'block');
						var thishider = document.getElementById('formhider-' + cid);
						var thishideroffsetHeight = thishider.offsetHeight;

						thishider.style.height = String(parseInt(thishideroffsetHeight) + parseInt(formhidermoreheight)) + "px";
						jQuery('#tx-tc-form-dp-wpp-' + cid).css('min-height', (thumbstyleminheight+'px'));
						jQuery('#tx-tc-form-dp-wpp-' + cid).css('max-height', (thumbstylemaxheight+'px'));
						var haspics=0;
						var haspicsjquery=0;
						if (windowpreviewhtml.indexOf('pvs-images')>2) {
							haspics=1;
						}
						if (previewstarted[cid] === 2) {
							if (previewselpic[cid] !== 888) {
								haspicsjquery=1;
								jQuery('#tx-tc-form-wpp-working' + cid).css('display', 'none');
							}
						} else {
							haspicsjquery=1;
						}
						if ((haspics === 1) && (haspicsjquery === 1)) {
							jQuery('#tx-tc-cts-pvsprevnext-' + cid).css('display', 'block');
							jQuery('#tx-tc-cts-pvsprev-' + cid).css('display', 'block');
							jQuery('#tx-tc-cts-pvsnext-' + cid).css('display', 'block');
							jQuery('#tx-tc-cts-nopreviewpic-' + cid).css('display', 'block');
						}
						jQuery('#tx-tc-cts-pvsfuncs-' + cid).css('display', 'block');
						jQuery('#tx-tc-cts-pvsnopreview-' + cid).css('display', 'block');

						show_pvs_pic(cid,previewselpic[cid]);
					}
					if ((htmlretcodeapproval>=2) && (htmlretcode !== 0)) {
						previewselpreviewid[cid] =0;
						previewselpic[cid] =888;
					}
					//rebinds tooltips
					tttip('t101','span.tx-tc-ct-denotifybutton[title]');
					if ((global_loggedon != 1) || (commentreplyid == 0)) {
						timeoutID = window.setTimeout("tcrebind('#tx-tc-" + cssident + "-" + extid + "')", 50);
						timeoutID = window.setTimeout("tcrebindemo('#tx-tc-" + cssident + "-" + extid+ "')", 55);
					}
					
					if (parseInt(htmlretcodeapproval) == 2) {
						
						timeoutID = window.setTimeout("tcrebind('#tx-tc-form-dp-" + extid + "')", 50);
						timeoutID = window.setTimeout("tcrebindemo('#tx-tc-form-dp-" + extid + "')", 55);
						
					}
					
					var elemcap=document.getElementById('tx-tc-ct-form-gender' + cid);
					if (norighttooltip==1) {
						jQuery('#tx-tc-ct-form-gender' + cid + ' img.tx-tc-defuserpic_m').attr('title','M');
						jQuery('#tx-tc-ct-form-gender' + cid + ' img.tx-tc-defuserpic_f').attr('title','E');
						jQuery('#tx-tc-smilie-icon-' + cid).attr('title','Emoji');
						
					} else {
						if (elemcap){
							tttip('t101',"#tx-tc-ct-form-gender" + cid + " img[title]");
						}
						if (confuseEmoji>0) {
							tttip('t101','#tx-tc-smilie-icon-' + cid + '[title]');
						}
					}
					tttip('t10-18','#tx-tc-cts-ftm-' + cid + ' input[title]');
					tttip('t101','#tx-tc-uimg-' + cid + '[title]');
					if (norighttooltip==1) {
						jQuery('#tx-tc-' + cid + 'uploaddiv img').removeAttr('title');												
					} else {
						tttip('t201','#tx-tc-' + cid + 'uploaddiv img[title]');
					}
					
					tttip('t101','#toctoc_comments_caprefresh_' + cid + '[title]');
					timeoutID = window.setTimeout("tcnomessagedisplay()", 200);
				}
			});
			setopacity('tx-tc-' + cssident + '-dp-' + extidroot,'1','toctoc_comments_submit 6');

			// check if the insert was ok and only if...
			if (parseInt(htmlretcode) > 0)	{
				if (parseInt(htmlretcodeapproval) !== 2) {
					if (!jQuery("#tx-tc-cts-img-" + cid).hasClass('tx-tc-nodisp')) {
						jQuery("#tx-tc-cts-img-" + cid).addClass('tx-tc-nodisp');
					}

					var str1=this.toctoc_comments_pi1_serialize(tctreestate);
					var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);
					previewselpreviewid[cid] =0;
					previewselpic[cid] =888;
					picressshow = patchtemppicresshow(picressorig, commentid, cid);
					picressend = this.toctoc_comments_pi1_base64_encode(picressshow);
					
					if (global_loggedon == 1) {
						sortReviewArr[extidroot] = 1;
						//console.log (extidroot+ ', '+ sortReviewArr[extidroot]);
					}
					
 					setopacity('tx-tc-cts-dp-' + extidroot,'0.4','toctoc_comments_submit 7');
					jQuery.ajax({
						type: 'POST',
						url: 'index.php?eID=toctoc_comments_ajax',
						async: false,
						data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=' + capsess + '&check=' + check + '&cmd=showcomments'  + '&userpic=' + picressend + '&commentsimgs=' + commentsImgs + '&tctreestateenc=' + tctreestateenc + '&extref='  + extidroot,
						success: function(html){
							sortArr = [];
							sortReviewArr = [];
							sortReviewDoneArr = [];
							if (html.indexOf('<div id="dummy"></div>')>0){
						
								var htarr=html.split('<div id="dummy"></div>');
								tophtml=htarr[0];
								html=htarr[1];
								jQuery('#tx-tc-cts-dp-split-' + extidroot).html(tophtml);
								// rebind
								tttip('t101','span.tx-tc-ct-denotifybutton[title]');
								timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-dp-split-" + extidroot + "')", 100);
								timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-dp-split-" + extidroot + "')", 110);
								setucclick('#tx-tc-cts-dp-split-' + extidroot + ' .tx-tc-picclasslink');
							}

							jQuery('#tx-tc-cts-' + extidroot).html(html);
							timeoutID = window.setTimeout("tcrebind('#tx-tc-cts-" + extidroot + "')", 100);
							timeoutID = window.setTimeout("tcrebindemo('#tx-tc-cts-" + extidroot + "')", 110);

						}
					});
					previewselcomment[cid] = 0;
					reset_previewvars(cid);
					setopacity('tx-tc-cts-dp-' + extidroot,'1','toctoc_comments_submit 8');
					// notifications about new comment
					jQuery.ajax({
						type: 'POST',
						url: 'index.php?eID=toctoc_comments_ajax',
						async: true,
						data: 'ajaxdna=' + ajaxdna + '&ref=' + htmlretcode + '&data=' + ajaxData + '&check=' + check + '&cmd=handlecn',
						success: function(html){
							//console.log(html);
						}
					});
				}
			} else if (htmlretcode === 999999999)	{
				messageon=true;
				timeoutID = window.setTimeout("cannotinsert('" + mcid + "')", 100);
				if ((global_loggedon == 1) && (commentreplyid != 0)) {
					timeoutID = window.setTimeout("tcrebind('#tx-tc-" + cssident + "-" + extid + "')", 300);
					timeoutID = window.setTimeout("tcrebindemo('#tx-tc-" + cssident + "-" + extid+ "')", 310);
				}
			}
		}
	} else if (((cssident === 'myrtstop') || (cssident === 'myrts') || (cssident === 'myrtsemo')) && (id.indexOf("toctoc_comments_comments") === -1)) {
		// concerns only Like-Dislike in the commentsbox top
		// bit special: commentsimgs= are passed in var datac, which normally holds the piVars
		var taction = 'like';
		if (action.indexOf("unlike")>=0) {
			taction = 'unlike';
		}
		var topaction = 'liketop';
		if (action.indexOf("unlike")>=0) {
			topaction = 'unliketop';
		}
		if (cssident === 'myrtsemo') {
			topaction += 'emo';
			taction += 'emo';
			if (!(rating)) {
				return;
			}
			jQuery('#tx-tc-myrtstop-dp-' + id + ' .tx-tc-emlp-il2').css('display', 'none');
			jQuery('#tx-tc-myrtstop-dp-' + id + ' .tx-tc-emolike-popup').css('display', 'none');

		}
		//console.log(topaction);
		
		setopacity('tx-tc-myrtstop-dp-' + id,'0.8','toctoc_comments_submit 9');
		setopacity('tx-tc-myrts-dp-' + id,'0.4','toctoc_comments_submit 10');
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			async: false,
			data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + taction + '&commentsimgs=' +  datac + '&pageid=' + pageid,
			success: function(html){
				

				jQuery('#tx-tc-myrts-' + id).html(html);
			}				
		});
		setopacity('tx-tc-myrtstop-dp-' + id,'0.4','toctoc_comments_submit 11');
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			async: true,
			data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + topaction + '&commentsimgs=' +  datac + '&pageid=' + pageid,
			success: function(html){				
					jQuery('#tx-tc-myrtstop-' + id).html(html);
					setopacity('tx-tc-myrtstop-dp-' + id,'1','toctoc_comments_submit 12');
					var locemolike = 0;
					if (jQuery('#tx-tc-myrtstop-' + id).hasClass('tx-tc-emolikemark')) {
						locemolike = 1;
					}
					
					animStateSave=0;
					timeoutID = window.setTimeout("topliketextattachevent('" + id + "', 2, '" + locemolike + "')",300);
			}
		});

		isarticle=1;
		if (id.replace('tx_toctoc_comments_comments_','') !== id) {
			isarticle=0;
		}
		// like on the article
		if ((isarticle==1)) {
			//uc link
			setucclick ('#tx-tc-myrts-dp-' + id + ' div div div .tx-tc-picclasslink');
			if (tcistouch==0) {
				tttip('t101','#tx-tc-myrts-dp-' + id + '.tx-tc-myrts-disilke img[title]');
				tttip('t101','#tx-tc-myrts-dp-' + id + '.tx-tc-myrts-ilke img[title]');
				tttip('t101','#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-disilke img[title]');
				tttip('t101','#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-ilke img[title]');
			} else {
				jQuery('#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-disilke img').removeAttr('title');
				jQuery('#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-ilke img').removeAttr('title');								
			}
			tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div span[title]");
			tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div div[title]");
			tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div a[title]");
			
			tttip('t101','#tx-tc-othertitle-' + id + '[title]');
			tttip('t101','#tx-tc-othertitledis-' + id + '[title]');
			if  (cssident != 'myrtsemo') {
				jQuery('#tx-tc-myrts-dp-' + id + ' div div a.tx-tc-rts-star-l').on('click', function() {
					likeclick(this);
				});
			}
		}


	} else {
		// concerns rest of voting
		// Save scopeinfos
		var savedscope='';
		var elem = document.getElementById('tx-tc-scope-' + id);
		var idwithnoscope= 0;
		idwithnoscope = id;
		var strfirstdiv= '';
		var strfirstdivend= '';
		if (elem) {
			savedscope=elem.outerHTML;
			var idarr = String(id).split("-");
			if (idarr.length>1) {
				idwithnoscope=idarr[0];
			}
			var elemparent = document.getElementById('tx-tc-scope-' + id).parentNode;
				if (elemparent) {
					savedelemparent=elemparent.outerHTML;
					if ((savedelemparent.indexOf('tx-tc-firstvote')) > 2) {
						strfirstdiv='<div class="tx-tc-firstvote">';
						strfirstdivend= '</div>';
					}
				}
			//how many scopes are there?
			var elemmain = document.getElementById('tx-tc-atrts-dp-' + idwithnoscope);
			if (elemmain) {
				var nbrelems = String(elemmain.outerHTML).split('id="tx-tc-scope-').length -1 ;
				if (nbrelems>2) {
					idwithnoscope=idarr[0];
				}
				var elemmstroverall = document.getElementById('tx-tc-scope-' + idwithnoscope);
				if (elemmstroverall) {
					nbrelems=nbrelems-1;
				}
			}
		}

		isarticle=1;
		if (id.replace('tx_toctoc_comments_comments_','') !== id) {
			isarticle=0;
		}

		if (action === 'vote') {
			// when useLikeDislikeStyle=1 is active with votings on top of a comment
			var elemdisp2 = document.getElementById('tx-tc-rts-disp2-' + id);
		}
		if (elemdisp2) {
			setopacity('tx-tc-rts-disp2-' + id,'0.4','toctoc_comments_submit 12.b');
		} else {
			setopacity('tx-tc-' + cssident + '-dp-' + id,'0.4','toctoc_comments_submit 12.a');
		}
		var elemmdisp = document.getElementById('tx-tc-' + cssident + '-' + id);
		var elemmdispuserslikeshtml ='';
		var strbrbr='';
		var elemmdispstr='#tx-tc-' + cssident + '-' + id;
		
		if (elemmdisp) {
			strbrbr='<br>';
		} else {
			elemmdispstr='#tx-tc-' + cssident + '-' + idwithnoscope;
			
			strbrbr='';

			elemmdispuserslikeshtml = document.getElementById('tx-tc-myrts-'+ idwithnoscope).outerHTML;
			var arrbrbr= document.getElementById('tx-tc-atrts-dp-'+ idwithnoscope).innerHTML.split('<br><br>');
			if (arrbrbr.length>1) {
				strbrbr='<br><br>';
			} else {
				arrbrbr= document.getElementById('tx-tc-atrts-dp-'+ idwithnoscope).innerHTML.split('<br>');
				if (arrbrbr.length>1) {
					strbrbr='<br>';
				}
			}
		}
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			async: false,
			data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + action + '&commentsimgs=' +  datac + '&pageid=' + pageid,
			success: function(html){
				html = html.replace(' tx-tc-tipemo-2\">',' tx-tc-tipemo-2\">' + strfirstdiv+ savedscope);
				
				var testreview = String(html).split('tx-tc-yourreview');
				if (testreview.length > 1) {
					isrts = 'rws';
				}					
			 //console.log('1. ' + isrts);
				html = html +strfirstdivend;
				if (elemmdispuserslikeshtml !== '') {
					html=elemmdispuserslikeshtml +strbrbr+ html+'</div></div></div></div>';
				}
				html = html.replace('<div class="tx-tc-overrating">','');
				if (elemdisp2) {
					var htmlarr= html.split('<div class="tx-tc-rts-dp">');
					var htmout = '<div class="tx-tc-rts-dp">' + htmlarr[1];
							
					var cutlen = 20;
					// Unix does 1 char less in the line break ...
					if(htmout.substr((htmout.length-cutlen),5) != '<div>') {
						cutlen = 21;
					}
					htmout =htmout.substr(0,htmout.length-cutlen);
					
					if (htmout=='<div class="tx') {
						// sysmessage coming, crop does not work
						htmout=html;
					}
					
					jQuery(elemdisp2).html(htmout);
					setopacity('tx-tc-rts-disp2-' + id,'1','toctoc_comments_submit 12.b');
				} else {
					jQuery(elemmdispstr).html(html);
				}
			}
		});
		//console.log(id+ ' tx-tc-scope-' + idwithnoscope);
		if (idwithnoscope !== id) {
			var elemmstr = document.getElementById('tx-tc-scope-' + idwithnoscope);
			strfirstdiv= '';
			strfirstdivend= '';
			var savedscopemain='';
			//console.log('tx-tc-scope-' + idwithnoscope);
			if (elemmstr) {
				
				savedscopemain=elemmstr.outerHTML;
				//console.log(savedscopemain);
				var elemparentmain = document.getElementById('tx-tc-scope-' + idwithnoscope).parentNode;
				if (elemparentmain) {
					
					savedelemparent=elemparentmain.outerHTML;
					//console.log('savedelemparent'+savedelemparent.length);
					if ((savedelemparent.indexOf('tx-tc-firstvote')) > 2) {
						strfirstdiv='<div class="tx-tc-firstvote">';
						strfirstdivend= '</div>';
					}
				}

			}
			// get the check
			newcheck= check;
			//
			var elemmnoscopesratings = document.getElementById('tx-tc-rts-dp-'+ idwithnoscope);
			//console.log('22. tx-tc-rts-dp-'+ idwithnoscope + ' ' + elemmnoscopesratings.id);
			if (elemmnoscopesratings) {
				var elemmnoscopesratingshtml = elemmnoscopesratings.innerHTML;
				var elemmnoscopesratingshtmlbasearr0 = String(elemmnoscopesratingshtml).split('tx-tc-rts-star-v-' + rating);
				isrts = 'rts';
				var cssidentdc = cssident;
				var elemmnoscopesratingshtmlbasearr0test = String(elemmnoscopesratingshtml).split('tx-tc-yourreview');
				if (elemmnoscopesratingshtmlbasearr0test.length >1) {
					isrts = 'rws';
					cssidentdc = 'rws-area';
				}
				//console.log('2. ' + isrts);
				var elemmnoscopesratingshtmlbasearr = String(elemmnoscopesratingshtmlbasearr0[1]).split('__' + idwithnoscope + '__');
				var elemmnoscopesratingshtmlbasearr2 = String(elemmnoscopesratingshtmlbasearr[1]).split('\" href');
				var elemmnoscopesratingshtmlbasearr3 = String(elemmnoscopesratingshtmlbasearr2[0]).split('__');
				newcheck= String(elemmnoscopesratingshtmlbasearr3[1]);
				var newchecktestarr = String(newcheck).split('\"');
				if (newchecktestarr.length>1) {
					newcheck=newchecktestarr[0];
				}
				if (nbrelems>1) {
					rating = rating + '-' + nbrelems;
				}
				
				if (newcheck.length>11) {
					setopacity('tx-tc-' + cssident + '-dp-' + idwithnoscope,'0.4','toctoc_comments_submit 12');
					jQuery.ajax({
						type: 'POST',
						url: 'index.php?eID=toctoc_comments_ajax',
						async: true,
						data: 'ajaxdna=' + ajaxdna + '&ref=' + idwithnoscope + '&rating=' + rating + '&data=' + ajaxData + '&check=' + newcheck + '&cmd=' + action + '&commentsimgs=' +  datac + '&overall=1' + '&pageid=' + pageid,
						success: function(htmlx){
							htmlx = htmlx.replace(' tx-tc-tipemo-2\">',' tx-tc-tipemo-2\">' + strfirstdiv + savedscopemain);
							htmlx = htmlx + strfirstdivend;
							//tx-tc-rws-area-
							if (document.getElementById('tx-tc-' + cssidentdc + '-' + idwithnoscope)) {
								jQuery('#tx-tc-' + cssidentdc + '-' + idwithnoscope).html(htmlx);
								//console.log('#tx-tc-' + cssidentdc + '-' + idwithnoscope);
							} else {
								if (document.getElementById('tx-tc-' + cssidentdc + '-__0' + idwithnoscope)) {
									jQuery('#tx-tc-' + cssidentdc + '-__0' + idwithnoscope).html(htmlx);
									//console.log('#tx-tc-' + cssidentdc + '-__0' + idwithnoscope);
								}
							}
							//console.log('isarticle ' + isarticle);
							var locemolike = 0;
							if (isarticle == 1) {
								// voting or like on the article'
								if ((idwithnoscope !== id) && (idwithnoscope !== 0)) {
									tttip('t201-5',"#tx-tc-" + isrts + "-dp-" + idwithnoscope + " div.tx-tc-rts-vote-bar div span[title]");
									tttip('t201-5',"#tx-tc-" + isrts + "-dp-" + idwithnoscope + " div.tx-tc-rts-vote-bar div div[title]");
									tttip('t201-5',"#tx-tc-" + isrts + "-dp-" + idwithnoscope + " div.tx-tc-rts-vote-bar div a[title]");
									jQuery('#tx-tc-' + isrts + '-dp-' + idwithnoscope + ' div div div div a.tx-tc-rts-star-v').off('click');
									jQuery('#tx-tc-' + isrts + '-dp-' + idwithnoscope + ' div div div div a.tx-tc-rts-star-v').on('click', function() {
										starclick(this);
									 });
									tttip('t101','#tx-tc-othertitle-' + idwithnoscope + '[title]');
									tttip('t101','#tx-tc-othertitledis-' + idwithnoscope + '[title]');
									
									
									if (jQuery('#tx-tc-myrtstop-' + idwithnoscope).hasClass('tx-tc-emolikemark')) {
										locemolike = 1;
									} else if  (cssident === 'myrtsemo') {
										locemolike = 1;
									} 
									//console.log ('#tx-tc-my' + isrts + '-dp-' + idwithnoscope + ' div a.tx-tc-rts-star-l');
									
									if (locemolike == 1)  {
										tttip('hideemo');
										bindemolike('#tx-tc-my' + isrts + '-' + idwithnoscope + ' ', 1, 5);										
									} else {
										jQuery('#tx-tc-my' + isrts + '-dp-' + idwithnoscope + ' div div a.tx-tc-rts-star-l').on('click', function() {
											likeclick(this);
										});
									}
									if (tcistouch==0) {
										tttip('t101','#tx-tc-my' + isrts + '-dp-' + idwithnoscope + ' .tx-tc-myrts-disilke img[title]');
										tttip('t101','#tx-tc-my' + isrts + '-dp-' + idwithnoscope + ' .tx-tc-myrts-ilke img[title]');
									} else {
										jQuery('#tx-tc-my' + isrts + '-dp-' + idwithnoscope + ' .tx-tc-myrts-disilke img').removeAttr('title');
										jQuery('#tx-tc-my' + isrts + '-dp-' + idwithnoscope + ' .tx-tc-myrts-ilke img').removeAttr('title');								
									}
								} 
							}
						}
					});
				}

			} else {
				// lets vote anyway on the overall
				newcheck= Math.round(new Date().getTime()/1000);
 				if (nbrelems>1) {
 					rating = rating + '-' + nbrelems;
 				}

				jQuery.ajax({
					type: 'POST',
					url: 'index.php?eID=toctoc_comments_ajax',
					async: true,
					data: 'ajaxdna=' + ajaxdna + '&ref=' + idwithnoscope + '&rating=' + rating + '&data=' + ajaxData + '&check=' + newcheck + '&cmd=' + action + '&commentsimgs=' +  datac + '&overall=1' + '&softcheck=1' + '&pageid=' + pageid,
					success: function(htmlx){

					}
				});

			}

		} else {
			var locemolike = 0;
			if (jQuery('#tx-tc-myrtstop-' + idwithnoscope).hasClass('tx-tc-emolikemark')) {
				locemolike = 1;
			} else if  (cssident === 'myrtsemo') {
				locemolike = 1;
			} 
			
			if (locemolike == 1)  {
				tttip('hideemo');
				bindemolike('#tx-tc-my' + isrts + '-' + idwithnoscope + ' ', 1, 6);										
			}
		}

		// rebinds
		if ((isarticle==1)) {
			// voting or like on the article'
			tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div span[title]");
			tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div div[title]");
			tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div a[title]");
			jQuery('#tx-tc-rts-dp-' + id + ' div div div div a.tx-tc-rts-star-v').on('click', function() {
				starclick(this);
			 });
			tttip('t101','#tx-tc-othertitle-' + id + '[title]');
			tttip('t101','#tx-tc-othertitledis-' + id + '[title]');
			if (emolike !=1) {
				if (tcistouch==0) {
					tttip('t101','#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-disilke img[title]');
					tttip('t101','#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-ilke img[title]');
				} else {
					jQuery('#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-disilke img').removeAttr('title');
					jQuery('#tx-tc-myrts-dp-' + id + ' .tx-tc-myrts-ilke img').removeAttr('title');								
				}
			}
			if (action !== 'vote') {
				topliketextattachevent(id, 1,0);

			} else {
				if  (cssident != 'myrtsemo') {

					jQuery('#tx-tc-myrts-dp-' + id + ' div div a.tx-tc-rts-star-l').on('click', function() {
						likeclick(this);
					});
				}

			}
		} else {

			if (action == 'vote') {
				// short likes display
				jQuery('#tx-tc-rts-disp2-' + id + ' div div div a.tx-tc-rts-star-v').off('click');
				jQuery('#tx-tc-rts-disp2-' + id + ' div div div a.tx-tc-rts-star-v').on('click', function() {
					starclick(this);
				});
				// standard display
				jQuery('#tx-tc-rts-dp-' + id + ' div div div div a.tx-tc-rts-star-v').off('click');
				jQuery('#tx-tc-rts-dp-' + id + ' div div div div a.tx-tc-rts-star-v').on('click', function() {
					starclick(this);
				});
				tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div span[title]");
				tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div div[title]");
				tttip('t201-5',"#tx-tc-rts-dp-" + id + " div.tx-tc-rts-vote-bar div a[title]");

			}

			if  (cssident != 'myrtsemo') {
				jQuery('#tx-tc-myrts-dp-' + id + ' div div a.tx-tc-rts-star-l').off('click');
				jQuery('#tx-tc-myrts-dp-' + id + ' div div a.tx-tc-rts-star-l').on('click', function() {
					likeclick(this);
				});
			}

		}
		//uc links
		setucclick('#tx-tc-myrts-dp-' + id + ' div div div .tx-tc-picclasslink');
	}

}
function tcnomessagedisplay() {
	nomessagedisplay=0;
	console.log ("messagedisplay");
}
function topliketextattachevent(id,rpv, locemolike) {
	if ((locemolike == 1) && (rpv==2)) {
		tttip('hideemo');
		bindemolike('#tx-tc-myrtstop-' + id + ' ', 1, 3);	
	} else {
		jQuery('#tx-tc-myrtstop-dp-' + id + ' div a.tx-tc-rts-star-l').on('click', function() {
			likeclick(this);
		});
	}
	
}

function toctoc_comments_pi1_setUserDatawrap(tObj) {
	if (tObj) {
		tccid = tObj.id;
		tccid = tccid.replace('tx-tc-setuserdata-','');
		toctoc_comments_pi1_setUserData(tccid);
	}

}

function othertooltip(tObj) {
	if (tObj) {
		tccid = tObj.id;
		tccid = tccid.replace('tx-tc-othertitle-','');
		if ((tObj.id).length !== tccid.length) {
			jQuery('#tx-tc-othertitle-' + tccid + '[title]').cooltip({offset: [-1, 0],effect: 'fade', opacity: 1, tipClass: 'tx-tc-tooltip'});
			jQuery('#tx-tc-othertitledis-' + tccid + '[title]').cooltip({offset: [-1, 0],effect: 'fade', opacity: 1, tipClass: 'tx-tc-tooltip'});
		}

	}

}

function wtrmrk(tObj) {
	if (tObj) {
		tccid = tObj.id;
		tccid = tccid.replace('tx-tc-wtrmrk-formf-','');
		if ((tObj.id).length !== tccid.length) {
			tcidarr = String(tccid).split("__0");
			jQuery('#toctoc_comments_pi1_'+tcidarr[0]+tcidarr[1]).watermark(utf8_decode(tcb64_dec(tcidarr[2])), {left: 0, top: 0, fallback: true});
		} else {
			tccid = tccid.replace('tx-tc-wtrmrk-tcnt-','');
			if ((tObj.id).length !== tccid.length) {
				tcidarr = String(tccid).split("__0");
				jQuery('#'+ tctnme + tcidarr[0]).watermark(utf8_decode(tcb64_dec(tcidarr[1])), {left: 0, top: 0, fallback: true});
			}

		}

	}

}

function uploadclick(tObj) {
	if (tObj) {
		tccid = tObj.id;
		tccid = tccid.replace('tx-tc-uploadlink-pic-','');
		if ((tObj.id).length !== tccid.length) {
			//is pic
			jQuery('.tx-tc-tooltip2').hide();
			tcOpenFile('toctoc_comments_pi1_' + tccid + 'uploadpic', 'pic');
		} else {
			tccid = tccid.replace('tx-tc-uploadlink-pdf-','');
			if ((tObj.id).length !== tccid.length) {
				//is pdf
				jQuery('.tx-tc-tooltip2').hide();
				tcOpenFile('toctoc_comments_pi1_' + tccid + 'uploadpic', 'pdf');
			}

		}

	}

}

function bbclick(tObj,lformcid) {
	if (tObj) {
		tccid = tObj.id;
		tccid = tccid.replace('txtcbb-','');
		insertbb(tccid,lformcid);
	}

}

function ucclick(tObj) {
	tccid = tObj.id;
	tccid = tccid.replace('tx-tc-nameclasslink__','');
	tcidarr = String(tccid).split("__");
	tccid = tcidarr[1];
	if (tcidarr.length === 5) {
		// : show_uc(commentid, cid, commentsAjaxData,toctocuid,imgstr,timeoutms)
		tttip('hideemo');
		tttip('hide');
		show_uc(tcidarr[0],tccid,commentsAjaxData[tccid],tcidarr[2],tcidarr[3],tcidarr[4]);
		// userpopups, close
		tttip('t101', '.tx-tc-ucclose[title]');
		jQuery('.tx-tc-ucclose').off('click');
		jQuery('.tx-tc-ucclose').on( 'click', function() {
			tccid = this.id;
			tccid = tccid.replace('tx-tc-cts-uc-cls-','');
			tttip('hide');
			toctoc_comments_uc_close(tccid);
		});
	}

}

function bindemolike(parentid, isrebind, fromid) {
	(function($) {
        animStateLikeButton=0;
		var addtodvl1 = ''; 
		var addtorts = ''; 
		var addto27jf = ''; 
		var addto3t54 = ''; 
		var parentid2=parentid;
		if (isrebind ==1) {
			addtodvl1 = 'div div div div div div div ';
			addtorts = 'div div ';
			addto27jf = 'div div div div div div div div';
			addto3t54 = 'div div div div div div div';
			parentid2=parentid.replace('tx-tc-myrtstop-', 'tx-tc-atrts-dp-');
		}
		
		if (tcistouch==0) {
			if (isTouchDevice()) {
				tcistouch=1;
			}
		}
		
		if (tcistouch == 1) {			
			if (parentid == '.tx-tc-rts-area ') {
				$('.tx-tc-atrtstop-ilike-dp a.tx-tc-rts-star-l').off('click');
				$('.tx-tc-atrtstop-ilike-dp a.tx-tc-rts-star-l').on('click', function() {
					emolikeclick(this);				
				});
				//console.log('bindemolike for ' + '.tx-tc-atrtstop-ilike-dp a.tx-tc-rts-star-l');
			} else{
				$(parentid + 'a.tx-tc-rts-star-l').on('click', function() {
					emolikeclick(this);
				});
			}	
			
			$(parentid  + 'a.tx-tc-rts-star-l').contextmenu( function() {
			    return false;
			});	
			
			if (parentid == '.tx-tc-rts-area ') {
				$('.tx-tc-atrtstop-ilike-dp a.tx-tc-rts-star-l').on("taphold", function() {
		        	if (animStateLikeButton !=3) {
			        	animStateLikeButton=0;
						likemouseenter(this);
		        	}
		        });
				
			} else{
				$(parentid + 'a.tx-tc-rts-star-l').on("taphold", function() {
		        	if (animStateLikeButton !=3) {
			        	animStateLikeButton=0;
						likemouseenter(this);
		        	}
		        });
			}	
			
			$(parentid + addtodvl1 + '.tx-tc-emlp-dvl1').contextmenu( function() {
			    return false;
			});	
			$(parentid + addtodvl1 + '.tx-tc-emoicontipp').contextmenu( function() {
			    return false;
			});	
			$(parentid + addtodvl1 + '.tx-tc-emlp-il2').contextmenu( function() {
			    return false;
			});	
			
			$( document ).on ( "vmousemove", parentid + '.tx-tc-emolike-popup', function(event) {	
				  if (animStateClose == 0) {
					animStateLikeButton=3;
					tccid = this.id.replace('tx-tc-emolike-popup-',''); 
					//tx-tc-emolike-popup-tt_content_199
					
					var picwidth = 40;	
					var emotransform = 'scale(1, 1) translate(0px, -13px)';
					var emobacktransform = 'scale(0.833333, 0.833333) rotate(0deg) translate(0px, 0px)';


					var newbackgroundImage = '';
					var newbackgroundposition = '';
					var newpadding = '';
					var transformy = -94;	
					var transformacty = -84;	
					var heightframes = parseInt(this.offsetHeight);
					var offset = $('#' + this.id).offset().top;
					var wintop = $(window).scrollTop();
					var winbot = wintop+ $(window).height();	

					if (window.innerWidth < screenmd) {
						transformy = -68;
						transformacty = -64;
						picwidth = 24;
						emotransform = 'scale(1.25, 1.25) translate(0px, 3px)';
						emobacktransform = 'scale(1, 1) rotate(0deg) translate(0px, 0px)';
					}
					
					activePicNr = parseInt((parseInt(event.pageX) - 25 - parseInt($('#' + this.id).offset().left))/picwidth)+1;

					// check tx-tc-emlp-2-tt_content_199-1
					if (document.getElementById('tx-tc-emlp-2-'+tccid+'-' + activePicNr)) {					
						if ($('#tx-tc-emlp-2-'+tccid+'-' + activePicNr + ' div.tx-tc-emoicontipp').css('display') != 'block') {
							var tccid2=tccid;

							if ($('#tx-tc-emlp-2-' + tccid2+'-' + activePicNr).hasClass('actemo') == true) {
								newbackgroundImage=  "url('/typo3conf/ext/toctoc_comments/res/css/themes/"+selectedTheme+"/img/tiparrow.png')";
							}
							
							if (((wintop - offset)>(-1*(heightframes+32))) && ((winbot - offset) > 0)) {
								transformy = -4;	
								transformacty = 8;
								if (window.innerWidth < screenmd) {
									transformy = 10;
									transformacty = 9;
								}
								
								newbackgroundImage=  "url('/typo3conf/ext/toctoc_comments/res/css/themes/"+selectedTheme+"/img/tipemorev.png')";
								if ($('#tx-tc-emlp-2-' + tccid2+'-' + activePicNr).hasClass('actemo') == true) {
									newbackgroundImage=  "url('/typo3conf/ext/toctoc_comments/res/css/themes/"+selectedTheme+"/img/tiparrowrev.png')";
								}
								
								newbackgroundposition= 'top';
								newpadding = '8px 8px 8px';
							}
							
							//console.log('#tx-tc-emlp-2-'+tccid2+'-' + activePicNr + ' div.tx-tc-emoicontipp, the ID ' + $('#tx-tc-emlp-2-'+tccid2+'-' + activePicNr + ' div.tx-tc-emoicontipp').attr('id'));
							tccid = $('#tx-tc-emlp-2-'+tccid2+'-' + activePicNr + ' div.tx-tc-emoicontipp').attr('id').replace('tx-tc-emlp-2-tipp-',''); 
							
							$('.tx-tc-emoicontipp').css('display', 'none');							
							$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('backgroundImage', newbackgroundImage);
							$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('backgroundPosition', newbackgroundposition);
							$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('padding', newpadding);
							$('#tx-tc-emlp-2-tipp-' + tccid).css('transform', 'translate(0px, '+transformy+'px)');
							$('#tx-tc-emlp-2-tipp-' + tccid).css('-ms-transform', 'translate(0px, '+transformy+'px)');
							$('#tx-tc-emlp-2-tipp-' + tccid).css('-webkit-transform', 'translate(0px, '+transformy+'px)');
							if (window.innerWidth < screenmd) {
								$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('fontSize', '90%');
								$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('fontWeight', '400 !important');
								$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('left', '-10px');
							}
							setTimeout(function() {
								$('.actemo  #tx-tc-emlp-2-tipp-' + tccid).css('transform', 'translate(0px, '+transformacty+'px)');
								$('.actemo  #tx-tc-emlp-2-tipp-' + tccid).css('-ms-transform', 'translate(0px, '+transformacty+'px)');
								$('.actemo  #tx-tc-emlp-2-tipp-' + tccid).css('-webkit-transform', 'translate(0px, '+transformacty+'px)');
								
								$('#tx-tc-emlp-2-tipp-' + tccid).css('display', 'inline-block');							
								
								$('.tx-tc-emlp-il2').css('transition', 'none');
								$('.tx-tc-emlp-il2').css('-webkit-transition', 'none');
								$('.tx-tc-emlp-il2').css('transform', emobacktransform);								
								$('.tx-tc-emlp-il2').css('-ms-transform', emobacktransform);								
								$('.tx-tc-emlp-il2').css('-webkit-transform', emobacktransform);								
								$('.tx-tc-emlp-il2').css('transition', '');
								$('.tx-tc-emlp-il2').css('-webkit-transition', '');
								
								if ($('#tx-tc-emlp-2-' + tccid2+'-' + activePicNr).hasClass('actemo') == true) {
									$('#tx-tc-emlp-2-' + tccid).css('transform', 'scale(1, 1) rotate(180deg) translate(0px, 0px)');
									$('#tx-tc-emlp-2-' + tccid).css('-ms-transform', 'scale(1, 1) rotate(180deg) translate(0px, 0px)');
									$('#tx-tc-emlp-2-' + tccid).css('-webkit-transform', 'scale(1, 1) rotate(180deg) translate(0px, 0px)');
								} else {
									$('#tx-tc-emlp-2-' + tccid).css('transform', emotransform);
									$('#tx-tc-emlp-2-' + tccid).css('-ms-transform', emotransform);
									$('#tx-tc-emlp-2-' + tccid).css('-webkit-transform', emotransform);
								}
								
								$('#tx-tc-emlp-2-' + tccid).css('zIndex', '999');
							}, 1);

						}
					}
				  }
				});
					
			$(parentid + '.tx-tc-abs0').on("vmouseout", function() {
				animStateLikeButton=0;
			});
			
			$(parentid + '.tx-tc-emolike-popup').on("vmouseout", function() {
				if ((animStateSave!=1) && (animStateClose==0) ) {
					animStateClose=2;
					tccid = this.id.replace('tx-tc-emolike-popup-',''); 
					//tx-tc-emolike-popup-tt_content_199
	
					var emobacktransform = 'scale(0.833333, 0.833333) rotate(0deg) translate(0px, 0px)';
					if (window.innerWidth < screenmd) {
						emobacktransform = 'scale(1, 1) rotate(0deg) translate(0px, 0px)';
					}				
					// check tx-tc-emlp-2-tt_content_199-1
					setTimeout(function() {
						$('.tx-tc-emoicontipp').css('display', 'none');
						$('.tx-tc-emlp-il2').css('transition', 'none');
						$('.tx-tc-emlp-il2').css('-webkit-transition', 'none');
						$('.tx-tc-emlp-il2').css('transform', emobacktransform);								
						$('.tx-tc-emlp-il2').css('-ms-transform', emobacktransform);								
						$('.tx-tc-emlp-il2').css('-webkit-transform', emobacktransform);								
						$('.tx-tc-emlp-il2').css('transition', '');
						$('.tx-tc-emlp-il2').css('-webkit-transition', '');
						activePicNr = 0;
						setTimeout(function() {						
							animStatePopup=2;
							timeoutID = window.setTimeout("likemouseout_delayed('" + tccid + "')", 700);

						}, 1);
					}, 1);
					
				
				}

			});
			
			$(parentid + addtodvl1 + 'div.tx-tc-emlp-dvl1').on("tap", function() {
				emolikeclick(this);
			});
			$('.tx-tc-emolikemark').off("tap");
			$('.tx-tc-emolikemark').on("tap", function() {
				return;
			});
					
		} else {
			//alert('isNoTouchDevice');
			$(parentid + '.tx-tc-emolike-popup').on("mouseleave", function() {
				likemouseout(this, 1);
				animStateLikeButton=0;
			});
			
			$(parentid + '.tx-tc-tv2spacer').on("mouseover", function() {
					likemouseout(this.parentNode.parentNode.parentNode, 4);
					animStateLikeButton=0;
			});
			
			$(parentid + '.tx-tc-atrts-dp').on("mouseenter", function() {
				likemouseout(this, 2);
				animStateLikeButton=0;
			});
			
			$('.tx-tc-state-1').on("mouseenter", function() {			
				likemouseout(this, 3);
				animStateLikeButton=0;
			});
			
			$('.tx-tc-state-0').on("mouseenter", function() {			
				likemouseout(this, 3);
				animStateLikeButton=0;
			});
			
			$(parentid + '.tx-tc-abs0').on("mouseover", function() {
				animStateLikeButton=3;
			});			
			$(parentid + addtodvl1 + '.tx-tc-emlp-dvl1').on("mouseover", function() {
				tccid = this.id.replace('tx-tc-emlp-','');
				//tx-tc-emlp-tt_content_345__30__345__f3118158a38a24cff753bf800d53bbb2
				animStateLikeButton=3;
				//console.log (' tccid ' + tccid);
				if (tccid != this.id) {
					
					var picwidth = 40;	
					var emotransform = 'scale(1, 1) translate(0px, -13px)';
					var emobacktransform = 'scale(0.833333, 0.833333) rotate(0deg) translate(0px, 0px)';

					var newbackgroundImage = '';
					var newbackgroundposition = '';
					var newpadding = '';
					
					var transformy = -94;	
					var transformacty = -84;

					var heightframes = parseInt(this.offsetHeight);
					var offset = $('#' + this.id).offset().top;
					var wintop = $(window).scrollTop();
					var winbot = wintop+ $(window).height();
					//console.log (' wintop ' + wintop);
					//console.log (' winbot ' + winbot);
					if (window.innerWidth < screenmd) {
						transformy = -68;
						transformacty = -64;
						picwidth = 24;
						emotransform = 'scale(1.25, 1.25) translate(0px, 3px)';
						emobacktransform = 'scale(1, 1) rotate(0deg) translate(0px, 0px)';
					}
					
					$('.tx-tc-emoicontipp').css('display', 'none');
					$('.tx-tc-emlp-il2').css('transform', emobacktransform);

					tccid2 = document.getElementById('tx-tc-emlp-2-'+tccid).parentNode.id.replace('tx-tc-emlp-2-','');
					if ($('#tx-tc-emlp-2-' + tccid2).hasClass('actemo') == true) {
						newbackgroundImage=  "url('/typo3conf/ext/toctoc_comments/res/css/themes/"+selectedTheme+"/img/tiparrow.png')";
					}
					
					if (((wintop - offset)>(-1*(heightframes+32))) && ((winbot - offset) > 0)) {
						transformy = -4;	
						transformacty = 8;
						if (window.innerWidth < screenmd) {
							transformy = 10;
							transformacty = 9;
						}
						
						newbackgroundImage=  "url('/typo3conf/ext/toctoc_comments/res/css/themes/"+selectedTheme+"/img/tipemorev.png')";
						if ($('#tx-tc-emlp-2-' + tccid2).hasClass('actemo') == true) {
							newbackgroundImage=  "url('/typo3conf/ext/toctoc_comments/res/css/themes/"+selectedTheme+"/img/tiparrowrev.png')";
						}
						newbackgroundposition= 'top';
						newpadding = '8px 8px 8px';
					}

					if ($('#tx-tc-emlp-2-' + tccid2).hasClass('actemo') == true) {
						$('#tx-tc-emlp-2-' + tccid).css('transform', 'scale(1, 1) rotate(180deg) translate(0px, 0px)');
						$('#tx-tc-emlp-2-' + tccid).css('-ms-transform', 'scale(1, 1) rotate(180deg) translate(0px, 0px)');
						$('#tx-tc-emlp-2-' + tccid).css('-webkit-transform', 'scale(1, 1) rotate(180deg) translate(0px, 0px)');
					} else {
						$('#tx-tc-emlp-2-' + tccid).css('transform', emotransform);
						$('#tx-tc-emlp-2-' + tccid).css('-ms-transform', emotransform);
						$('#tx-tc-emlp-2-' + tccid).css('-webkit-transform', emotransform);
					}
					$('#tx-tc-emlp-2-' + tccid).css('zIndex', '999');

					$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('backgroundImage', newbackgroundImage);
					$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('backgroundPosition', newbackgroundposition);
					$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('padding', newpadding);
					
					$('#tx-tc-emlp-2-tipp-' + tccid).css('transform', 'translate(0px, '+transformy+'px)');
					$('#tx-tc-emlp-2-tipp-' + tccid).css('-ms-transform', 'translate(0px, '+transformy+'px)');
					$('#tx-tc-emlp-2-tipp-' + tccid).css('-webkit-transform', 'translate(0px, '+transformy+'px)');
					if (window.innerWidth < screenmd) {
						$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('fontSize', '90%');
						$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('fontWeight', '400 !important');
						$('#tx-tc-emlp-2-tipp-' + tccid + ' span').css('left', '-10px');
					}
					setTimeout(function() {
						//console.log (' setTimeout ' + tccid);
						$('.actemo  #tx-tc-emlp-2-tipp-' + tccid).css('transform', 'translate(0px, '+transformacty+'px)');
						$('.actemo  #tx-tc-emlp-2-tipp-' + tccid).css('-ms-transform', 'translate(0px, '+transformacty+'px)');
						$('.actemo  #tx-tc-emlp-2-tipp-' + tccid).css('-webkit-transform', 'translate(0px, '+transformacty+'px)');
						$('#tx-tc-emlp-2-tipp-' + tccid).css('display', 'inline-block');
					}, 1);
				}
				
			});
			$(parentid + addtodvl1 + '.tx-tc-emlp-dvl1').on("mouseout", function() {
				tccid = this.id.replace('tx-tc-emlp-','');
				if (tccid != this.id) {	
					$('#tx-tc-emlp-2-' + tccid).css('transform', '');
					$('#tx-tc-emlp-2-' + tccid).css('-ms-transform', '');
					$('#tx-tc-emlp-2-' + tccid).css('-webkit-transform', '');
					$('#tx-tc-emlp-2-' + tccid).css('zIndex', '');
					$('#tx-tc-emlp-2-tipp-' + tccid).css('display', '');
				}
				
			});
			if (parentid == '.tx-tc-rts-area ') {
				$('.tx-tc-atrtstop-ilike-dp a.tx-tc-rts-star-l').on("mouseenter", function() {
					animStateLikeButton=0;
					likemouseenter(this);	
					
				});
 			} else {
				$(parentid + 'a.tx-tc-rts-star-l').on("mouseenter", function() {
					animStateLikeButton=0;
					likemouseenter(this);			
				});
			}		
			$(parentid  + 'a.tx-tc-rts-star-l').contextmenu( function() {
			    return false;
			});	
			
			$(parentid  + 'a.tx-tc-rts-star-l').on("mousedown", function(event) {
			    switch (event.which) {
			        case 1:
						longtouch = false;
				        ltimeout = setTimeout(function() {
				            longtouch = true;
				        }, 400);
			            break;
			        default:
			        	longtouch = false;
			    }

			});
			$(parentid  + 'a.tx-tc-rts-star-l').on("mouseleave", function() { 
				longtouch = false;
			});
			$(parentid  + 'a.tx-tc-rts-star-l').on("mouseup", function(event) {
			    switch (event.which) {
			        case 1:
				        if (longtouch == true) {
				        	if (animStateLikeButton !=3) {
					        	animStateLikeButton=0;
								likemouseenter(this);
				        	}
				        } else {
				        	emolikeclick(this);
		
				        }
				        longtouch = false;
				        clearTimeout(ltimeout);
			            break;
			        default:
			        	longtouch = false;
			    }
			   
			});		
			$(parentid + addtodvl1 + 'div.tx-tc-emlp-dvl1').on("mousedown", function(event) {
			    switch (event.which) {
			        case 1:
			        	emolikeclick(this);
			            break;
			        default:
			        	longtouch = false;
			    }
				
			});
		}
		
		if (fromid == 5) {
			setucclick(parentid2 + ' .tx-tc-picclasslink');
		}
		
		$(parentid2 + '.tx-tc-emorep-1g5v div').on('click', function() {
			emolikeoverview(this);
		});
		
		$(parentid2 + '.tx-tc-otheremouserstitle').on("mouseup", function() {
			emolikeoverview(this);
		});
		
		if (isrebind ==1) {
			tttip('t101', parentid2 + ' .tx-tc-otheremouserstitle[title]');
			//tttip('t101e', parentid + ' .tx-tc-emolike-popup span.tx-tc-emlp-span[title]');
			tttip('t101er', parentid2 + addto27jf + ' span.tx-tc-emorep-27jf[title]');
			tttip('t101erb', parentid2 + addto3t54 + ' div.tx-tc-emorep-1g5v[title]');
		}
		
	})(jQuery,window,document);
}

function emolikeoverview (tObj) {
	(function($) {
		tccid = tObj.id;
		tccid = tccid.replace('tx-tc-totalreactsnbr-','');
		tccid = tccid.replace('tx-tc-othertitle-','');
		tcidarr = String(tccid).split("__");
		
		if (tccid != tObj.id) {
			tttip('hide');
			tttip('hideemo');
			tccid = tcidarr[0];
			tccid2 = tcidarr[1];
			show_emolikeoverview(tccid,tccid2, commentsAjaxData[tccid2]);
			// userpopups, close
			tttip('t101', '.tx-tc-emolikeoverviewclose[title]');
			tttip('t101erb', 'i.tx-tc-emorep-comments[title]');
			tttip('t101erb', 'i.tx-tc-emorep-reactions[title]');
			tttip('t101erb', 'i.tx-tc-emorep-contact[title]');
			$('.tx-tc-emolikeoverviewclose').off('click');
			$('.tx-tc-emolikeoverviewclose').on( 'click', function() {
				tccid = this.id;
				tccid = tccid.replace('tx-tc-cts-emolikeoverview-cls-','');
				tttip('hide');
				tttip('hide2');
				toctoc_comments_emolikeoverview_close(tccid);
			});
		}
	})(jQuery);
}
function toctoc_comments_emolikeoverview_close(cid){
	(function($) {
		//setopacity('tx-tc-cts-emolikeoverview-' + cid,0,'toctoc_comments_emolikeoverview_close');
		$('#tx-tc-cts-emolikeoverview-' + cid).fadeOut( "slow", function() {
		    // Animation complete.
			document.getElementById('tx-tc-cts-emolikeoverview-' + cid).style.display= 'none';
			document.getElementById('tx-tc-cts-emolikeoverview-' + cid).style.height = '0px';
			$('#tx-tc-cts-emolikeoverview-' + cid).css('transform', '');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('-webkit-transform', '');
			
			$('#tx-tc-cts-emolikeoverview-' + cid).removeClass('tx-tc-emlk-show');
			$('#tx-tc-ovldlg-' + cid).remove();
			tttip('hide');
			tttip('hide2');
			tttip('hideemo');
			emolikeoverview_closed[cid]=20;
		 });
		
	})(jQuery);
}
function dialog_background(cid, objid){
	(function($) {
		// create the overlay
		var ovlccid = 0;
		if (objid!=1) {
			ovlccid=cid;
		}
		var overlay = $('<div></div>')
			.attr('id', 'tx-tc-ovldlg-' + ovlccid)
			.addClass('simpletxtcdlg-overlay close')
			.css($.extend({}, {
				display: 'block',
				opacity: 0.5,
				height: '100%',
				width: '100%',
				position: 'fixed',
				left: 0,
				top: 0,
				zIndex: 9,
				backgroundColor: 'black',
		  }))
		.appendTo('body');

		$('.simpletxtcdlg-overlay').on( 'click', function() {
			tccid = this.id;
			tccid = tccid.replace('tx-tc-ovldlg-','');
			if ((this.id).length !== tccid.length) {
				if (objid==1) {
					
					setTimeout(function() {
						//console.log('#tx-tc-cts-pic-formtext-' + cid + ' .close');
						$('#tx-tc-cts-pic-formtext-' + cid + ' .close').trigger('click');	
						setTimeout(function() {
							$('#tx-tc-ovldlg-0').remove();		
						}, 2);
					}, 1);	
					
				} else {
					toctoc_comments_emolikeoverview_close(cid);
				}
				
			}
		 });
	})(jQuery);
}
function show_emolikeoverview(ref, cid, commentsAjaxData) {
	(function($) {
	 	if (emolikeoverview_closed[cid] === 20) {
	 		emolikeoverview_closed[cid]=10;
		} else {
			emolikeoverview_closed[cid]=1;
		}
	 	
		var offset = $('#tx-tc-totalreactsnbr-'+ref+'__' + cid).offset().top;
			 	
		var heightframes = 400;
		
		//var posxy = [];
		//posxy=findPos(document.getElementById('tx-tc-totalreactsnbr-'+ref+'__' + cid));
		//var yorig=posxy[1]; 
		
		var winscrolled = $(window).scrollTop();
		var winheight = $(window).height();
		
		var yorig = offset-winscrolled;
		var bottomdiff = (winheight-yorig);
		//console.log('yorig  ' + yorig + ' = offset ' + offset+ ' - winscrolled ' + winscrolled);
		//console.log('bottomdiff ' + bottomdiff + ' = (winheight ' + winheight+ '- yorig ' + yorig + ' ) ' );		
		
		var transformpx = 0;
		if ((bottomdiff) < 400) {	
			transformpx = -(400-(bottomdiff));
		}
		
		tttip('hideemo');
		tttip('hide2');
		tttip('hide');
	 	dialog_background(cid);
	 	
		var borderradius=$('#tx-tc-cts-emolikeoverview-' + cid).css('border-radius');
		var boxwidth=$('#tx-tc-cts-emolikeoverview-' + cid).width();
		$('#tx-tc-cts-emolikeoverview-' + cid).removeClass('tx-tc-emlk-show');
		if (parseInt(document.getElementById('tx-tc-cts-emolikeoverview-inner-' + cid).innerHTML.length) < 500) {		
			setopacity('tx-tc-cts-emolikeoverview-' + cid,'0.6','show_emolikeoverview');
			$('#tx-tc-cts-emolikeclose-' + cid).css('visibility', 'hidden');
		 	
			$('#tx-tc-cts-emolikeoverview-' + cid).css('display', 'block');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('width', parseInt(boxwidth*0.5)+'px');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('left', parseInt(boxwidth*0.25)+'px');
			document.getElementById('tx-tc-cts-emolikeoverview-' + cid).style.height = parseInt(boxwidth*0.5)+'px';
			$('#tx-tc-cts-emolikeoverview-' + cid).css('border-radius', '100%');
			document.getElementById('tx-tc-cts-emolikeoverview-inner-' + cid).innerHTML='<div class="tx-tc-cts-emolikeov-start"><i class="tx-tc-cts-emlov-strt-pic"></i></div>';
			$('#tx-tc-cts-emolikeoverview-' + cid).addClass('tx-tc-emlk-grow');
			setTimeout(function() {
				setopacity('tx-tc-cts-emolikeoverview-' + cid,'0.9','show_emolikeoverview');
				$.ajax({
					type: 'POST',
					url: 'index.php?eID=toctoc_comments_ajax',
					async: false,
					data: 'ajaxdna=' + ajaxdna + '&cmd=getemorslt&data=' + commentsAjaxData + '&imagedata=' + commentsAjaxDataImg[cid] + '&cid=' + cid + '&ref=' + ref,
					success: function(html){
						$('#tx-tc-cts-emolikeoverview-' + cid).removeClass('tx-tc-emlk-grow');
						var htmlpicarr = String(html).split('typo3temp');
						var htmlpicarr2 = String(htmlpicarr[1]).split('\"');
						var piclink = '';
						var isgravatar = 0;
						if (html != String(html).replace('gravatar.','')) {
								isgravatar = 1;
						}
											
						if (isgravatar == 0) {
							piclink = 'typo3temp' + htmlpicarr2[0];
						} else {
							htmlpicarr = String(html).split('gravatar.');
							htmlpicarr2 = String(htmlpicarr[1]).split('\"');
							piclink = '';
							if (htmlpicarr2[0]) {
								piclink = 'gravatar.' + htmlpicarr2[0];
								if (String(htmlpicarr[0]).replace('secure.') != String(htmlpicarr[0])) {
									piclink = 'https://secure.' + piclink;
								} else {
									piclink = 'http://www.' + piclink;
								}
	
							}
	
						}
						
						$('#tx-tc-cts-emolikeoverview-inner-' + cid).css('visibility', 'hidden');
						$('#tx-tc-cts-emolikeoverview-inner-' + cid).html(html);
						var liwidth = 8+$('#tx-tc-cts-emolikeoverview-inner-' + cid + ' .tx-tc-ct-elikeov-topelemtab').width();
						var lileft = $('#tx-tc-cts-emolikeoverview-inner-' + cid + ' .tx-tc-ct-elikeov-topelemtab').position();
						$('#tx-tc-elikeovinner-' +tccid + ' ul.tx-tc-ct-elikeov-tablist li span.tx-tc-ct-elikeov-topelemspn span.tx-tc-textlink').css('color', '');
						$('li#tx-tc-elikeov-topelem-' +tccid + '__0 span.tx-tc-ct-elikeov-topelemspn span.tx-tc-textlink').css('color', colourcodeemo[0]);
						$('#tx-tc-elikeov-dsx-'+cid).css('background', colourcodeemo[0] +' none repeat scroll 0% 0%');
						$('#tx-tc-elikeov-dsx-'+cid).css('left', parseInt(lileft.left)+'px');
						$('#tx-tc-elikeov-dsx-'+cid).css('width', parseInt(liwidth)+'px');
						
						
						$('div.tx-tc-elikeov-user-uc').on( "mouseenter", function() {
							tccid = $(this).find('.tx-tc-uimgsize').attr('id'); 
							if (tccid) {
								tccid2 = tccid.replace('tx-tc-cts-img-','')
								if (tccid != tccid2) {
									$('.tx-tc-uimgsize').removeClass('tx-tc-uimgsizehover');
									$('#tx-tc-cts-img-' + tccid2).addClass('tx-tc-uimgsizehover');
								}
							}
						});
						
						$('#tx-tc-cts-emolikeoverview-inner-' + cid + ' .tx-tc-ct-elikeov-topelemtab').on( 'click', function() {
							tccid = this.id;
							tccid = tccid.replace('tx-tc-elikeov-topelem-','');
							if ((this.id).length !== tccid.length) {
								tcidarr = String(tccid).split("__");
								// ex.: tx-tc-rts-star-l-###VALUE###__###REF###__###CID###__###CHECK###__liketop
								// tx-tc-rts-star-l-###VALUE###__###REF###__###CID###__###CHECK###__like__###IDEMO###
								
								if (tcidarr.length == 2) {
									tccid = tcidarr[0]; //###CID###
									tccid2 =tcidarr[1]; //###SORTNR###
									var liwidth = 8+$('#' + this.id).width();
									var lileft = $('#' + this.id).position();
								//console.log('liwidth: '+liwidth+', lileft: '+parseInt(lileft.left)+', colourcodeemo: '+ colourcodeemo[tccid2]);
									
									$('#tx-tc-elikeovinner-' +tccid + ' ul.tx-tc-ct-elikeov-tablist li span.tx-tc-ct-elikeov-topelemspn span.tx-tc-textlink').css('color', '');
									$('li#tx-tc-elikeov-topelem-' +tccid + '__' +tccid2 + ' span.tx-tc-ct-elikeov-topelemspn span.tx-tc-textlink').css('color', colourcodeemo[tccid2]);
									
									$('#tx-tc-elikeov-dsx-'+tccid).css('background', colourcodeemo[tccid2] +' none repeat scroll 0% 0%');								
									$('#tx-tc-elikeov-dsx-'+tccid).css('left', parseInt(lileft.left)+'px');
									$('#tx-tc-elikeov-dsx-'+tccid).css('width', parseInt(liwidth)+'px');								
									
									if (tccid2==0) {
										// show all
										$('.tx-tc-elikeov-user-uc').removeClass('tx-tc-nodisp');
										$('.tx-tc-elikeov-user-uc').addClass('tx-tc-tabledisp');
										$('div#tx-tc-elikeov-topelemtab-' +tccid + '__0 div.tx-tc-elikeov-user-uc.tx-tc-emlk-hideinall').removeClass('tx-tc-emlk-showinemoid');
									} else {
										//hide all apart from tccid2
										$('.tx-tc-elikeov-user-uc').addClass('tx-tc-nodisp');
										$('.tx-tc-elikeov-user-uc').removeClass('tx-tc-tabledisp');
										$('.tx-tc-elikeov-user-uc-' +tccid2).removeClass('tx-tc-nodisp');
										$('.tx-tc-elikeov-user-uc-' +tccid2).addClass('tx-tc-tabledisp');
										$('div#tx-tc-elikeov-topelemtab-' +tccid + '__0 div.tx-tc-elikeov-user-uc.tx-tc-emlk-hideinall').removeClass('tx-tc-emlk-showinemoid');
										$('div#tx-tc-elikeov-topelemtab-' +tccid + '__0 div.tx-tc-elikeov-user-uc.tx-tc-emlk-hideinall.tx-tc-elikeov-user-uc-' + tccid2).addClass('tx-tc-emlk-showinemoid');
									}
								}
							}
							
						});
						tttip('t101e','.tx-tc-ct-elikeov-topelemspn i[title]');
						tttip('t101',"#tx-tc-cts-emolikeoverview-inner-" + cid + " img[title]");
						tttip('t10-16',"#tx-tc-cts-emolikeoverview-" + cid + " input[title]");
						tttip('t101erb', 'i.tx-tc-emorep-comments[title]');
						tttip('t101erb', 'i.tx-tc-emorep-reactions[title]');
						tttip('t101erb', 'i.tx-tc-emorep-contact[title]');
					}
				});
				setopacity('tx-tc-cts-emolikeoverview-' + cid,'0','show_emolikeoverview');
	
			}, 1);
	
		//setopacity('tx-tc-cts-emolikeoverview-' + cid,'1','show_emolikeoverview');
			setTimeout(function() {
				setopacity('tx-tc-cts-emolikeoverview-' + cid,'1','show_emolikeoverview');
				$('#tx-tc-cts-emolikeoverview-' + cid).removeClass('tx-tc-cts-emolikeoverview');				
				$('#tx-tc-cts-emolikeoverview-' + cid).css('left', '');
				$('#tx-tc-cts-emolikeoverview-' + cid).css('width', '');
				$('#tx-tc-cts-emolikeoverview-' + cid).css('height', '400px');
				$('#tx-tc-cts-emolikeoverview-' + cid).css('border-radius', borderradius);
				$('#tx-tc-cts-emolikeoverview-' + cid).css('transform', 'scale(1, 1) translate(0px, ' + transformpx + 'px)');
				$('#tx-tc-cts-emolikeoverview-' + cid).css('-webkit-transform', 'scale(1, 1) translate(0px, ' + transformpx + 'px)');
				$('#tx-tc-cts-emolikeoverview-' + cid).addClass('tx-tc-cts-emolikeoverview');
				$('#tx-tc-cts-emolikeoverview-' + cid).css('display', 'block');
				$('#tx-tc-cts-emolikeoverview-' + cid).addClass('tx-tc-emlk-show');
				$('#tx-tc-cts-emolikeclose-' + cid).css('visibility', 'visible');				
				$('#tx-tc-cts-emolikeoverview-inner-' + cid).css('display', 'block');
				$('#tx-tc-cts-emolikeoverview-inner-' + cid).css('visibility', 'visible');
			}, 1);
		} else {
			$('#tx-tc-cts-emolikeoverview-' + cid).removeClass('tx-tc-cts-emolikeoverview');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('transform', 'scale(1, 1) translate(0px, ' + transformpx + 'px)');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('-webkit-transform', 'scale(1, 1) translate(0px, ' + transformpx + 'px)');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('left', '');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('width', '');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('height', '400px');
			$('#tx-tc-cts-emolikeoverview-' + cid).css('border-radius', borderradius);			
			$('#tx-tc-cts-emolikeoverview-' + cid).addClass('tx-tc-cts-emolikeoverview');
			$('#tx-tc-cts-emolikeoverview-' + cid).addClass('tx-tc-emlk-show');
			$('#tx-tc-cts-emolikeoverview-inner-' + cid).css('display', 'block');
			$('#tx-tc-cts-emolikeoverview-inner-' + cid).css('visibility', 'visible');
			$('#tx-tc-cts-emolikeoverview-' + cid).fadeIn( "slow", function() {
				setopacity('tx-tc-cts-emolikeoverview-' + cid,'1','show_emolikeoverview');
				$('#tx-tc-cts-emolikeclose-' + cid).css('visibility', 'visible');			
				$('#tx-tc-cts-emolikeoverview-' + cid).css('display', 'block');
			});
		}
	 })(jQuery);
}
function emolikeclick(tObj) {
	(function($) {
		var d = new Date();
		var animSaveAttempt = d.getTime(); 
		if ((parseInt(animSaveAttempt) - parseInt(animLastSave)) > 1500) {
			animLastSave = animSaveAttempt;
			
			tccid = tObj.id;
			tccid = tccid.replace('tx-tc-rts-star-l-','');
			var unfocusdelay=1000;
			var speeduphideicons='09';
			var anidelay = 20;
			//console.log('emolikeclick '+ tObj.id);
				if (tccid != tObj.id) {
					tcidarr = String(tccid).split("__");
					// ex.: tx-tc-rts-star-l-###VALUE###__###REF###__###CID###__###CHECK###__liketop
					// tx-tc-rts-star-l-###VALUE###__###REF###__###CID###__###CHECK###__like__###IDEMO###
				
					if (tcidarr.length == 6) {
						tccid = tcidarr[2]; //###CID###
						tccid2 =tcidarr[1]; //###REF###
						// button emolike
						tttip('hideemo');
						setopacity('tx-tc-emolike-popup-'+tccid2,0.4,'emolikeclick');
						tttip('hide');
						tttip('hide2');	
						if (document.getElementById('tx-tc-myrtstop-dp-' + tccid2)) {
							document.getElementById('tx-tc-myrtstop-dp-' + tccid2).focus();
						}
						toctoc_comments_submit(tccid2, tcidarr[5], commentsAjaxData[tccid], tcidarr[3], tcidarr[4], 'myrtsemo', 
								'',tccid);
										
						toctoc_delaytooltip(tccid2);				
						
						if (tcistouch==0) {
							if (isTouchDevice()) {
								tcistouch=1;
							}
						}
						if (tcistouch==1) {
							unfocusdelay=1;
							
						}
						setTimeout(function() {
							if (window.getSelection) {
								  if (window.getSelection().empty) {  // Chrome
								    window.getSelection().empty();
								  } else if (window.getSelection().removeAllRanges) {  // Firefox
								    window.getSelection().removeAllRanges();
								  }
							} else if (document.selection) {  // IE?
								  document.selection.empty();
							}
							
							if (document.getElementById('tx-tc-myrtstop-dp-' + tccid2)) {
								document.getElementById('tx-tc-myrtstop-dp-' + tccid2).focus();
							}
						}, unfocusdelay);
					}		
				} else {
					if (animStateSave!=1) {
						
						window.clearTimeout(timeoutID);
						animStateSave=1;
						//popup emolike?
						tccid = tccid.replace('tx-tc-emlp-','');
						if (tccid != tObj.id) {
							
							
							if (tcistouch==0) {
								if (isTouchDevice()) {
									tcistouch=1;
								}
							}
							if (tcistouch==1) {
								anidelay=160;
								unfocusdelay=1;
								speeduphideicons='';
							}
							
							setTimeout(function() {
								tccid3 ='like';
								if ($('#' + tObj.id).hasClass('tx-tc-emodislike')) {
									tccid3 ='unlike';
								}
								
								tcidarr = String(tccid).split("__");
								var txtccid = tcidarr[2]; //###CID###
								tccid2 =tcidarr[0]; //###REF###
								//console.log('icon emolike '+ tccid2 + ', val: ' +tcidarr[1]);
								// button emolike
			
								$('#tx-tc-emlp-' + tccid).css('transform', 'scale(1.1, 1.1) translate(0px, -10px)');
								$('#tx-tc-emlp-' + tccid).css('-webkit-transform', 'scale(1.1, 1.1) translate(0px, -10px)');
								$('#tx-tc-emlp-' + tccid).css('transition', 'all 0.2s ease-out 0s');
								$('#tx-tc-emlp-' + tccid).css('-webkit-transition', 'all 0.2s ease-out 0s');
								$('#tx-tc-abs0-'+tccid2+' .tx-tc-emlp-dvl1' ).each(function(index) {				
									if (('tx-tc-emlp-' + tccid) != this.id) {
										//console.log(this.id);
										
										$('#'+this.id).css('transform', 'scale(0.1, 0.1) translate(-50px,250px)');
										$('#'+this.id).css('-webkit-transform', 'scale(0.1, 0.1) translate(-50px,250px)');
										$('#'+this.id).css('transition', 'all 0.'+speeduphideicons+(1+index)+'s ease-in 0s');
										$('#'+this.id).css('-webkit-transition', 'all 0.'+speeduphideicons+(1+index)+'s ease-in 0s');
										$('#'+this.id).css('opacity', '0');					
									}		
								});
								$('#tx-tc-emolike-popup-' + tccid2).css('transition', 'all 0.2s ease-in 0s');
								$('#tx-tc-emolike-popup-' + tccid2).css('-webkit-transition', 'all 0.2s ease-in 0s');					
								
								$('#tx-tc-emolike-popup-' + tccid2).css("transform", "scale(0, 0)");
								$('#tx-tc-emolike-popup-' + tccid2).css("-webkit-transform", "scale(0, 0)");
								$('#tx-tc-emolike-popup-' + tccid2).css("opacity", "0");
								setTimeout(function() {
									setTimeout(function() {
										
										$('#tx-tc-emlp-' + tccid).css('transform', 'scale(0.01, 0.01) translate(-50px, 50px)');
										$('#tx-tc-emlp-' + tccid).css('-webkit-transform', 'scale(0.01, 0.01) translate(-50px, 50px)');
										$('#tx-tc-emlp-' + tccid).css('transition', 'all 0.15s ease-in 0s');
										$('#tx-tc-emlp-' + tccid).css('-webkit-transition', 'all 0.15s ease-in 0s');
										$('#tx-tc-emlp-' + tccid).css('opacity', '0');	
									setTimeout(function() {
											tttip('hideemo');				
											tttip('hide');
											tttip('hide2');	
											$('#tx-tc-emolike-popup-' + tccid2).css("display", "none");
											$('#tx-tc-abs0-'+tccid2+' .tx-tc-emlp-dvl1' ).each(function(index) {				
													$('#'+this.id).css('display', 'none');					
						
											});
											
											if (document.getElementById('tx-tc-myrtstop-dp-' + tccid2)) {
												document.getElementById('tx-tc-myrtstop-dp-' + tccid2).focus();
											}
											
											toctoc_comments_submit(tccid2, tcidarr[1], commentsAjaxData[txtccid], tcidarr[3],tccid3, 'myrtsemo', 
															'',txtccid);
											toctoc_delaytooltip(tccid2);
											animStateSave=0;
											
											setTimeout(function() {
												if (document.getElementById('tx-tc-myrtstop-dp-' + tccid2)) {
													document.getElementById('tx-tc-myrtstop-dp-' + tccid2).focus();
												}
												if (window.getSelection) {
													  if (window.getSelection().empty) {  // Chrome
													    window.getSelection().empty();
													  } else if (window.getSelection().removeAllRanges) {  // Firefox
													    window.getSelection().removeAllRanges();
													  }
												} else if (document.selection) {  // IE?
													  document.selection.empty();
												}
												
											}, unfocusdelay);
												
									}, anidelay);
											

									}, (1));
									
								}, 1);
											
							}, 1);
									
						}	
					}
				}
			}
			
	})(jQuery);
}
function likeclick(tObj) {
	(function($) {
			tccid = tObj.id;			
			tccid = tccid.replace('tx-tc-rts-star-l-','');
			tcidarr = String(tccid).split("__");
			// ex.: tx-tc-rts-star-l-###VALUE###__###REF###__###CID###__###CHECK###__liketop
			tccid = tcidarr[2]; //###CID###
			tccid2 =tcidarr[1]; //###REF###
			if (tcidarr.length === 5) {
				tttip('hide');
				// console.log('toctoc_comments_submit ' + tccid2);
				toctoc_comments_submit(tccid2, tcidarr[0], commentsAjaxData[tccid], tcidarr[3],tcidarr[4], 'myrts', commentsAjaxDataC[tccid],tccid);
				if (tcistouch==0) {
					tttip('t101', '.tx-tc-myrts-disilke img[title]');
					tttip('t101', '.tx-tc-myrts-ilke img[title]');
				} else {
					$('.tx-tc-myrts-disilke img').removeAttr('title');
					$('.tx-tc-myrts-ilke img').removeAttr('title');								
				}
				toctoc_delaytooltip(tccid2);
			}			
	})(jQuery);

}
function isTouchDevice(){	
	  return (typeof(window.ontouchstart) != 'undefined') ? true : false;
}
function likemouseenter(tObj) {
	if (animStateClose != 1) {
	(function($) {
		if (animStatePopup==2) {
			animStatePopup=0;
		}
		window.clearTimeout(timeoutID);
		var locemolike = 0;
		if ($('#' + tObj.parentNode.parentNode.parentNode.id).hasClass('tx-tc-emolikemark')) {
			locemolike = 1;
		}
		var emobacktransform = 'scale(0.833333, 0.833333) rotate(0deg) translate(0px, 0px)';					
		if (window.innerWidth < screenmd) {
			emobacktransform = 'scale(1, 1) rotate(0deg) translate(0px, 0px)';
		}
		if (animStatePopup==0){
			if (locemolike == 1) {
				tccid = tObj.id;
				tccid = tccid.replace('tx-tc-rts-star-l-1__','');
				if (tObj.id.length != tccid.length) {
					tcidarr = String(tccid).split("__");
					tccid=tcidarr[0];
				} else {
					tccid = tccid.replace('tx-tc-rts-star-l-0__','');
					if (tObj.id.length != tccid.length) {
						tcidarr = String(tccid).split("__");
						tccid=tcidarr[0];
					}
					
				}
				if ((lastanimPopup != '') && (lastanimPopup != tccid)) {				
					$('#tx-tc-emolike-popup-' + lastanimPopup ).fadeOut( "fast", function() {
					    // Animation complete.
						$('#tx-tc-emolike-popup-' + lastanimPopup).css('transform', '');
						$('#tx-tc-emolike-popup-' + lastanimPopup).css('-webkit-transform', '');
						$('#tx-tc-emolike-popup-' + lastanimPopup).css('opacity', '');
						$('#tx-tc-emolike-popup-' + lastanimPopup).removeClass('tx-tc-blockdisp');
						$('#tx-tc-emolike-popup-' + lastanimPopup).addClass('tx-tc-nodisp');
						$('#tx-tc-emolike-popup-' + lastanimPopup).css("display", "");
						lastanimPopup = tccid;
					});					
				}
				var elem = document.getElementById('tx-tc-cts-dp-split-' + tccid);
				var elemid = '';
				if (!elem) {
				   elem = document.getElementById('tx-tc-cts-' + tccid);
				   if (elem) {
					   elemid = '#tx-tc-cts-' + tccid; 
				   }
				} else {
					elemid = '#tx-tc-cts-dp-split-' + tccid;
				}

				if (elem) {
					var heightframes = parseInt(tObj.parentNode.parentNode.offsetHeight);
					var offset = $(elemid).offset().top;
					var wintop = $(window).scrollTop();
					var winbot = wintop+ $(window).height();
					var winwith = window.innerWidth;
					$('.tx-tc-emoicontipp').css('display', 'none');	
					$('.tx-tc-emlp-il2').css('transform', emobacktransform);								
					$('.tx-tc-emlp-il2').css('-ms-transform', emobacktransform);								
					$('.tx-tc-emlp-il2').css('-webkit-transform', emobacktransform);
					if (tObj.id.length != tccid.length) {
						if (winwith > 500) {
							heightframes += 48;
						} else {
							heightframes += 16;
						}
						//console.log('wintop:'+(wintop - offset));
						//console.log('winbot:'+(winbot - offset));
						if (((wintop - offset)>(-1*(heightframes+32))) && ((winbot - offset) > 0)) {
							$('#tx-tc-abs0-' + tccid).css('top', (heightframes) +'px');
						} else {
							$('#tx-tc-abs0-' + tccid).css('top', '');
						}
						
						if ($('#tx-tc-emolike-popup-' + tccid).hasClass('tx-tc-nodisp')) {
							if (animStatePopup==0) {
								if (($('#tx-tc-emlp-2-' + tccid + '-' + 1).hasClass("tx-tc-emlp-dvl2"))) {
									for (var it=1;it<8;it++) {
										$('#tx-tc-emlp-2-' + tccid + '-' + it).css("visibility", "hidden");					
										$('#tx-tc-emlp-2-' + tccid + '-' + it).removeClass("tx-tc-emlp-dvl2");					
									}
									
								}
								
								$('#tx-tc-emolike-popup-' + tccid).css("visibility", "hidden");	
								$('#tx-tc-emolike-popup-' + tccid).removeClass('tx-tc-nodisp');
								animStatePopup=1;							
								timeoutID = window.setTimeout("animpanel_delayed('"+ tccid +"')", 0);
								return;
							}	
							
						}	
						
					}
				}
				
			}
	
		}
	})(jQuery);
	}
}
function animpanel_delayed(tccid) {
	if (animStateClose != 1) {

		(function($) {
			$('#tx-tc-emolike-popup-' + tccid).css("visibility", "");	
			for (var it=1;it<8;it++) {
				$('#tx-tc-emlp-2-' + tccid + '-' + it).css("visibility", "");					
				$('#tx-tc-emlp-2-' + tccid + '-' + it).addClass("tx-tc-emlp-dvl2");					
			}
			$('#tx-tc-emolike-popup-' + tccid).css("transform", "scale(1, 1) translate(0px, 0px)");
			$('#tx-tc-emolike-popup-' + tccid).css("-webkit-transform", "scale(1, 1) translate(0px, 0px)");
			$('#tx-tc-emolike-popup-' + tccid).css("opacity", "1");	
			animStatePopup=0;
			timeoutID = window.setTimeout("animpanel_check('"+ tccid +"')", 2500);
			return;
		})(jQuery);
	}
}
function animpanel_check(tccid) {	
	(function($) {
		if (animStateLikeButton != 3) {
			if (animStatePopup==0){				
					animStatePopup=2;
					if (animStateClose != 1) {
						timeoutID = window.setTimeout("likemouseout_delayed('" + tccid + "')", 10);
						return;
					} else {
						return;
					}
			} else {
				if (animStateClose != 1) {
					timeoutID = window.setTimeout("animpanel_check('"+ tccid +"')", 1000);
				} else {
					return;
				}
			}
		} else {
			if (animStateClose != 1) {
				timeoutID = window.setTimeout("animpanel_check('"+ tccid +"')", 1000);
			} else {
				return;
			}
		}		
	})(jQuery);
}
function likemouseout(tObj, popup) {
	if (animStateClose != 1) {
		tccid = tObj.id;	
		
		if (popup == 0) {
			if (animStateLikeButton != 3) {
				tccid = tccid.replace('tx-tc-myrtstop-dp-','');
			}
	 	} else if (popup == 1) {
			tccid = tccid.replace('tx-tc-emolike-popup-','');
			animStateLikeButton=0;
	 	} else if (popup == 2) {
			tccid = tccid.replace('tx-tc-atrts-dp-','');
		} else if (popup == 3) {
			tccid = tccid.replace('tx-tc-form-','');
			animStateLikeButton=0;
		} else if (popup == 4) {
			//console.log(tccid);
			tccid = tccid.replace('tx-tc-cts-dp-split-','');
			animStateLikeButton=0;
		} else if (popup == 5) {
			//console.log(tccid);
			tccid = tccid.replace('tx-tc-abs0-','');
			animStateLikeButton=0;
		}
		
		if (animStatePopup==0){	
			if (tObj.id.length != tccid.length) {
				
				animStatePopup=2;
				timeoutID = window.setTimeout("likemouseout_delayed('" + tccid + "')", 700);
				return;
			}
			
		}
	}

}
function likemouseout_delayed(tccid) {
	(function($) {
		if ((animStatePopup==2) && (animStateSave!=1)) {
			if (document.getElementById('tx-tc-myrtstop-dp-' + tccid)) {
				document.getElementById('tx-tc-myrtstop-dp-' + tccid).focus();				
			}
			//console.log('windowinnerWidth ' + window.innerWidth);
			//console.log('$windowwidth ' + $(window).width());

			animStatePopup=0;
			var emotimeouttabl = 1;
			if (tcistouch ==1) {
				emotimeouttabl = 300;
				var emobacktransform = 'scale(0.833333, 0.833333) rotate(0deg) translate(0px, 0px)';
				if (window.innerWidth < screenmd) {
					emobacktransform = 'scale(1, 1) rotate(0deg) translate(0px, 0px)';
				}
				$('.tx-tc-emolikemark').trigger("tap");
				setTimeout(function() {
					$('.tx-tc-emoicontipp').css('display', 'none');
					$('.tx-tc-emlp-il2').css('transform', emobacktransform);								
					$('.tx-tc-emlp-il2').css('-ms-transform', emobacktransform);								
					$('.tx-tc-emlp-il2').css('-webkit-transform', emobacktransform);								
					$('.tx-tc-emlp-il2').css('transition', '');
					$('.tx-tc-emlp-il2').css('-webkit-transition', '');
				}, 5);											
			}
			if (animStateLikeButton == 3) {
				animStateClose = 0;
			} else {	
				window.clearTimeout(timeoutID);
				
				animStateClose = 1;	
				setTimeout(function() {
					//
					if (tcistouch == 0) {
						$('#tx-tc-emolike-popup-' + tccid).fadeOut( "slow", function() {
						    // Animation complete.
							setTimeout(function() {
								//console.log('fadeOut 3 animStateLikeButton ' + animStateLikeButton);
								$('#tx-tc-emolike-popup-' + tccid).css('transform', '');
								$('#tx-tc-emolike-popup-' + tccid).css('-webkit-transform', '');
								tttip('hide');
								tttip('hide2');
								tttip('hideemo');
								setTimeout(function() {
									$('#tx-tc-emolike-popup-' + tccid).css('opacity', '');
									$('#tx-tc-emolike-popup-' + tccid).removeClass('tx-tc-blockdisp');
									setTimeout(function() {
										$('#tx-tc-emolike-popup-' + tccid).css('display', '');
										$('#tx-tc-emolike-popup-' + tccid).addClass('tx-tc-nodisp');
									
									
										animStatePopup=0;	
										animStateLikeButton = 0;
								
									}, 12);
									animStateLikeButton = 0;
									animStateClose = 0;	
									animStatePopup=0;
									return;
								}, 1);
							}, 1);
						});	
					} else {
						$('#tx-tc-emolike-popup-' + tccid).css('transform', '');
						$('#tx-tc-emolike-popup-' + tccid).css('-webkit-transform', '');
						animStateLikeButton = 3;
						animStatePopup=2;	
						$('#tx-tc-emolike-popup-' + tccid).fadeOut( "slow", function() {
							$('#tx-tc-emolike-popup-' + tccid2).css('opacity', '');
							$('#tx-tc-emolike-popup-' + tccid).removeClass('tx-tc-blockdisp');							
							setTimeout(function() {
								$('#tx-tc-emolike-popup-' + tccid).css('display', '');
								$('#tx-tc-emolike-popup-' + tccid).addClass('tx-tc-nodisp');
							
							
								animStatePopup=0;	
								animStateLikeButton = 0;
						
							}, 12);
							animStateClose = 0;	
							tttip('hide');
							tttip('hide2');
							tttip('hideemo');
							
							return;
						});	
						
					}
				}, emotimeouttabl);

			}
			
		}
	})(jQuery);		
}

function starclick(tObj) {

	tccid = tObj.id;
	tccid = tccid.replace('tx-tc-rts-star-v-','');
	if (tccid == tObj.id) {
		tccid = tccid.replace('tx-tc-rws-star-v-','');
	}
	
	// parsing tx-tc-rts-star-v-###VALUE###__###REF###__###CID###__###CHECK###
	tcidarr = String(tccid).split("__");
	tccid = tcidarr[2]; //###CID###
	tccid2 =tcidarr[1]; //###REF###
	tccid3 = tccid2.replace('tx_toctoc_comments_comments_','');
	if ((tObj.id).length !== tccid.length) {
		tccid3 ='vote';
	} else {
		tccid3 ='votearticle';
	}

	if (tcidarr.length === 4) {
		tttip('hide2');
		toctoc_comments_submit(tccid2, tcidarr[0], commentsAjaxData[tccid], tcidarr[3], tccid3, 'rts', commentsAjaxDataC[tccid],tccid);
	}
}

function getCursorPos(input) {
	if (input !== null) {
		if ("selectionStart" in input && document.activeElement === input) {
			return {
				start: input.selectionStart,
				end: input.selectionEnd
			};
		}
		
		else if (input.createTextRange) {
			var sel = document.selection.createRange();
			if (sel.parentElement() === input) {
				var rng = input.createTextRange();
				rng.moveToBookmark(sel.getBookmark());
				for (var len = 0; rng.compareEndPoints("EndToStart", rng) > 0; rng.moveEnd("character", -1)) {
					len++;
				}
				rng.setEndPoint("StartToStart", input.createTextRange());
				for (var pos = { start: 0, end: len }; rng.compareEndPoints("EndToStart", rng) > 0; rng.moveEnd("character", -1)) {
					pos.start++;
					pos.end++;
				}
				return pos;
			}
		}
	}
	return -1;
}
function setCursorPos(input, start, end) {
	if (arguments.length < 3) {
		end = start;
	}
	if ("selectionStart" in input) {
		setTimeout(function() {
			input.selectionStart = start;
			input.selectionEnd = end;
		}, 1);
	}
	else if (input.createTextRange) {
		var rng = input.createTextRange();
		rng.moveStart("character", start);
		rng.collapse();
		rng.moveEnd("character", end - start);
		rng.select();
	}
}

function toctoc_checkurl(previewopenedarr) {
// called from Page, when writing a comment.
// it checks if the last entire word is a URL and then gets the webpagepreview
	var keyval = arguments[0];
	var fieldta = arguments[1];
	var wx = arguments[9];
	var wy = arguments[10];
	var ewhich = arguments[11];
	var pos = getCursorPos(fieldta);
	if (pos.start === null || typeof pos.start === "undefined") {
	} else {
		this.caretposstart = pos.start;
		this.caretposend = pos.end;
	}

	if (((this.caretposend - this.caretposstart) > 0) || (ewhich==3)) {
		// something has been selected, popup for bbcodes is available a little instant
		lformcid=arguments[2];
		selectbb(wx,wy,lformcid);
	}

	var previewopenedprogress = arguments[3];
	if (fieldta !== null) {
		var fieldvalue=fieldta.value;
		var id=arguments[2];

		var lang=arguments[4];
		var webpagepreviewheight=arguments[5];
		var ajaxData=arguments[6];
		var ajaxDataAtt=arguments[7];
		var maxCommentlength=arguments[8];
		if (previewopenedprogress !== 99999) {
			if (fieldvalue.length > maxCommentlength) {
				document.getElementById(tctnme + id).value=fieldvalue.substr(0,maxCommentlength);
			}
			var disableinp = false;
			var hideelems = 'visible';
			var opastate= '1';
			var elemcap=document.getElementById('tx-tc-div-submit' + id);
			var opastatesm= '';
			if (fieldvalue.length > 0) {
				if (elemcap){
					if ((elemcap.style.opacity === '0.6') || (elemcap.style.opacity === '')) {
						opastatesm = '1';
					} else {
						opastatesm = elemcap.style.opacity;
					}
				}
			} else {
				if ((loginRequiredIdLoginForm === '') || (global_loggedon === 1)){
					disableinp = true;
				}
				hideelems = 'hidden';
				opastate = '0.6';
				opastatesm = '0.6';
				if (elemcap){
					if (elemcap.style.opacity !== '1'){
						opastatesm = elemcap.style.opacity;
					}
				}
			}

			if ((loginRequiredIdLoginForm === '') || (global_loggedon === 1)) {
				jQuery( '#formhider-' + id).css('opacity', opastate);
				jQuery( '#tx-tc-div-submit' + id).css('opacity', opastatesm);
			}
			elemcap=document.getElementById(tcsbmtnme + id);
			if (elemcap){
				elemcap.disabled = disableinp;
			}
			elemcap=document.getElementById('tx-tc-' + id + 'uploaddiv');
			if (elemcap){
				elemcap.style.visibility=hideelems;
			}
			if (lang !== 'jedi') {
				if (global_loggedon !== 1){
					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'firstname');
					if (elemcap){
						elemcap.disabled = disableinp;
					}

					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'commenttitle');
					if (elemcap){
						elemcap.disabled = disableinp;
					}

					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'lastname');
					if (elemcap){
						elemcap.disabled = disableinp;
					}

					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'homepage');
					if (elemcap){
						elemcap.disabled = disableinp;
					}

					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'location');
					if (elemcap){
						elemcap.disabled = disableinp;
					}

					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'email');
					if (elemcap){
						elemcap.disabled = disableinp;
					}

					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'notify');
					if (elemcap){
						elemcap.disabled = disableinp;
					}
										
					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'acceptterms');
					if (elemcap){
						elemcap.disabled = disableinp;
					}
					
					elemcap=document.getElementById('tx-tc-ct-form-gender' + id);
					if (elemcap){
						tttip('t101',"#tx-tc-ct-form-gender" + id + " img[title]");
						elemcap.style.visibility=hideelems;
					}

				} else {
					elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'commenttitle');
					if (elemcap){
						elemcap.disabled = disableinp;
					}
				}

			} else {
				// jedi is from bad comments report
				elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'from');
				if (elemcap){
					elemcap.disabled = disableinp;
				}

				elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'frommail');
				if (elemcap){
					elemcap.disabled = disableinp;
				}

			}

			var elem= document.getElementById('prv-ct-' + id);
			var elemsmt= document.getElementById('tx-tc-div-submit' + id);

			if (submitopaccontrol === 2) {
				if (elemsmt) {
					submitopaccontrol= getopacity('tx-tc-div-submit' + id);
				}

			}

			if (fieldvalue.length > errCommentRequiredLength) {
				if (elem) {
					tttip('t101','#prv-ct-' + id + '[title]');
					jQuery('#prv-ct-' + id).removeClass('tx-tc-nodisp');
					jQuery('#prv-ct-' + id).addClass('tx-tc-blockdisp');
				}

				if ((elemsmt) && (submitopaccontrol === 0.5)) {
					elemsmt.style.opacity='1';
				}

			} else {
				if (elem) {
					jQuery('#prv-ct-' + id).addClass('tx-tc-nodisp');
					jQuery('#prv-ct-' + id).removeClass('tx-tc-blockdisp');
				}
				if ((global_loggedon === 0) && (tclogincard !== '')) {
					elemsmt.style.opacity='1';
				} else {
					if ((elemsmt) && (submitopaccontrol === 0.5)) {
						elemsmt.style.opacity='0.5';
					}
				}

			}
		}

		if (typeof emotjicodes !== 'undefined') {
			if (keyval === 32) {
				var emotjicandArray = String(fieldvalue).split(':');
				var emotjicandArrayLastElem =0;
				if (emotjicandArray.length >1) {
					emotjicandArrayLastElem = emotjicandArray.length-2;
				} else {
					if (emotjicandArray.length === 1) {
						emotjicandArrayLastElem = 0;
					}
				}

				var emotjicand=tcdelinefeed(emotjicandArray[emotjicandArrayLastElem]);
				if (emotjicand.length > 0) {

					emotjicand=emotjicand.toUpperCase();
					for (i= 0; i < emotjicodes.length; i++) {
						if (emotjicodes[i][0] === emotjicand) {
							emotjicandArray[emotjicandArrayLastElem]='::';
							emotjicandArray[emotjicandArrayLastElem+1]='';
							emotjiout=emotjicodes[i][1];
							fieldvalue=emotjicandArray.join(":");
							fieldvalue=fieldvalue.replace('::::','');
							if (previewopenedprogress !== 99999) {
								document.getElementById(tctnme + id).value=fieldvalue + emotjiout + ' ';
							} else {

								document.getElementById('toctoc_comments_pi1_contenttextboxc_' + id).value=fieldvalue + emotjiout + ' ';
							}
							return 0;
						}
					}

				}
			}

		}
		if (lang !== 'jedi') {
			if (previewopenedprogress !== 99999) {
				if (previewstartedfp[id] === 0) {
				//13 is enter, 16 shift, 32 space
					if (keyval === 32) {
						if (previewhtml[id] === '') {
							var fieldvalueArray = String(fieldvalue).split(' ');
							var fieldvalueArrayLastElem =0;
							if (fieldvalueArray.length >1) {
								fieldvalueArrayLastElem = fieldvalueArray.length-2;
							}
							else
							{
								if (fieldvalueArray.length === 1) {
									fieldvalueArrayLastElem = 0;
								}
								else
								{
									return previewopenedprogress;
								}
							}

							var testurl=tcdelinefeed(fieldvalueArray[fieldvalueArrayLastElem]);
							if (testurl.length > 8) {
								var tcRegExp = /(www\.|http:\/\/|https:\/\/)(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
								if (tcRegExp.test(testurl)) {
									if ((testurl.substr(0,4) === 'www\.') || (testurl.substr(0,4) === 'http') ) {
										var testurlArray = testurl.split('.');
										if (testurlArray.length >1) {
											if (previewopenedprogress === 0) {
												previewopenedprogress = 1;
												toctoc_previewurl(id, testurl,previewopenedprogress,lang,webpagepreviewheight,ajaxData,ajaxDataAtt);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

	return previewopenedprogress;
}



function toctoc_settooltip (id) {
	var opanow= getopacity('tx-tc-myrtstop-dp-'+id);
	if (parseFloat(opanow)>0.9){
		if (emolike == 0) {
			tttip('t101','#tx-tc-myrtstop-'+id+' #tx-tc-myrtstop-dp-'+id+' .tx-tc-atrtstop-ilike-dp a[title]');
		}
		return false;
	} else {
		timeoutID = window.setTimeout("toctoc_settooltip('"+id+"')", 100);
	}
}
function toctoc_delaytooltip (id) {
	var elem=document.getElementById('tx-tc-myrtstop-dp-'+id);
	if (elem) {
		timeoutID = window.setTimeout("toctoc_settooltip('"+id+"')", 200);
	}
}

function toctoc_previewurl(id, previewopened, previewopenedprogress, lang, webpagepreviewheight,ajaxData,ajaxDataAtt) {
	jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'block');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '15px');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '15px');
	setopacity(tcsbmtnme + id,'0.4','toctoc_previewurl 1');
	formhidermoreheightsecondlap=0;
	document.getElementById('formhider-' + id).style.height = "auto";
	previewselpic = [];
	var previewarr = [];
	previewarr['url']=tctrim(previewopened);
	previewarr['lang']=lang;
	previewcountnr[id] = previewcountnr[id] +1;
	previewarr['commentid']=previewcountnr[id] ;
	previewarr['webpagepreviewheight']=webpagepreviewheight;
	previewarr['configBaseURL']=utf8_decode(tcb64_dec(configbaseURL));
	previewarr['langid']=pagelanId;

	var str1=toctoc_comments_pi1_serialize(previewarr);
	var ajaxpreviewopened=toctoc_comments_pi1_base64_encode(str1);

	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopened + '&cmd=getpreviewinit' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
		success: function(html){

		}
	});
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: true,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopened + '&cmd=startpreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
		success: function(html){
			if (html > 0) {
				previewselpreviewid[id] =html;
			}
		}
	});
	jQuery('#tx-tc-' + id + 'uploaddiv').css('display', 'none');
	timeoutID = window.setTimeout("toctoc_previewurl_fetch('" + id + "', '" + previewopened  + "', " + previewopenedprogress  + ", 0, '" + lang + "', " + webpagepreviewheight + ", '" + ajaxData + "', '" + ajaxDataAtt + "')", 700);
}

function toctoc_previewurl_fetch (id, purl,pip, iterations, lang,webpagepreviewheight , ajaxData, ajaxDataAtt) {
	var tmpthumbheight=webpagepreviewheight;
	var thumbstylemaxheight=tmpthumbheight + 200;
	var thumbstyleminheight=tmpthumbheight + 5;
	var formhidermoreheight=tmpthumbheight - 2;
	iterations=iterations+1;

	var previewopenurl = purl;
	var previewarr = [];
	previewarr['url']=purl;
	previewarr['lang']=lang;
	previewarr['commentid']=previewcountnr[id] ;
	previewarr['webpagepreviewheight']=webpagepreviewheight;
	previewarr['configBaseURL']=utf8_decode(tcb64_dec(configbaseURL));
	previewarr['langid']=pagelanId;
	var previewopenedprogress = previewstarted[id];
	if (previewopenedprogress !== 2) {
		if (iterations<30) {
			var str1=this.toctoc_comments_pi1_serialize(previewarr);
			var ajaxpreviewopenurl=this.toctoc_comments_pi1_base64_encode(str1);
			// send to server the cid and the original url
			var htmlretcode=0;
			
			// old url: utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/pi1/class.toctoc_comments_webpagepreview_ajax.php',

			jQuery.ajax({
				type: 'POST',
				url: 'index.php?eID=toctoc_comments_ajax',
				async: true,
				data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=webpagepreviewajax' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
				success: function(html){

					htmlretcode= tctrim(html.substr(8,20));

					var posenddiv= htmlretcode.indexOf(">");
					htmlretcode= htmlretcode.substr(0,posenddiv);

					if (!tcisInt(htmlretcode)) {
						htmlretcode="-1";
					} else {
						var replstr='<div id=' + htmlretcode + '></div>';
						html = html.replace(replstr,'');
					}
					var posworking = html.indexOf("tx-tc-pvs-title");
					var posworkingnotitle = html.indexOf("tx-tc-pvs-urltext");
					if ((iterations>=1) && (html.length > 150)) {
						if ((htmlretcode < 4) && ((posworking>2)||(posworkingnotitle>2))) {
							wppelem=document.getElementById('tx-tc-form-dp-wpp-' + id);
							if (wppelem) {
								if (wppelem.style.maxHeight !== (thumbstylemaxheight+'px')) {
									//chnginl uhhh
									var fhoffseth = parseInt(document.getElementById('formhider-' + id).offsetHeight)+parseInt(formhidermoreheight);
									document.getElementById('formhider-' + id).style.height = "auto";
									jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', (thumbstyleminheight+'px'));
									jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', (thumbstylemaxheight+'px'));
									jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'block');
									formhidermoreheightsecondlap=formhidermoreheight;
								}
							} else {
								document.getElementById('formhider-' + id).style.height = "auto";
								formhidermoreheightsecondlap=formhidermoreheight;
							}
						}
					}

					if ((htmlretcode >3) ) {
						htmlretcodesave=htmlretcode;
						previewopenedprogress=2;
						previewstarted[id]=2;
						jQuery('#tx-tc-form-wpp-' + id).html(html);
						wppelem=document.getElementById('tx-tc-form-dp-wpp-' + id);
						if (wppelem) {
							if (document.getElementById('tx-tc-form-dp-wpp-' + id).style.maxHeight !== '0px') {
								//chnginl uhhh
								document.getElementById('formhider-' + id).style.height = "auto";
								jQuery('#tx-tc-form-wpp-' + id).html('<img id="tx-tc-form-wpp-working' + id + '" class="tx-tc-working tx-tc-blockdisp" width="16" height="11" align="right" alt="'+ utf8_decode(tcb64_dec(textLoading)) + '" title="' + utf8_decode(tcb64_dec(textLoading)) +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/' + selectedTheme + '/img/workingslides.gif">');
								jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'none');
								jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '0px');
								jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '0px');
								previewopenedprogress = 2;
								previewstarted[id] = previewopenedprogress;
								reset_previewvars (id);
							}
						} else {
							document.getElementById('formhider-' + id).style.height = "auto";
							previewopenedprogress = 2;
							previewstarted[id] = previewopenedprogress;
							reset_previewvars (id);
						}
						setopacity(tcsbmtnme + id,'1','toctoc_previewurl_fetch 1');

						return true;
					}
					if (previewopenedprogress === 2) {
						setopacity(tcsbmtnme + id,'1','toctoc_previewurl_fetch 2');
						return true;
					} else {
						jQuery('#tx-tc-form-wpp-' + id).html(html);
						previewhtml[id] = html;
					}
					var haspics=0;
					var haspicsjquery=0;

					if (html.indexOf('pvs-images')>2) {
						haspics=1;
					}
					if (tctrim(htmlretcode) === '3') {
						previewselpic[id] =0;
					}
					if ((tctrim(htmlretcode) === '2') || (tctrim(htmlretcode) === '3') || (previewstarted[id] === 2)) {
						previewopenedprogress=2;

						if (previewstarted[id] === 2) {
							if (previewselpic[id] !== 888) {
								haspicsjquery=1;
								jQuery('#tx-tc-form-wpp-working' + id).css('display', 'none');
							}
						} else {
							haspicsjquery=1;
							previewstarted[id] = 2;
						}

						if ((haspics === 1) && (haspicsjquery === 1)) {
							jQuery('#tx-tc-cts-pvsprevnext-' + id).css('display', 'block');
							jQuery('#tx-tc-cts-pvsprev-' + id).css('display', 'block');
							jQuery('#tx-tc-cts-pvsnext-' + id).css('display', 'block');
							jQuery('#tx-tc-cts-nopreviewpic-' + id).css('display', 'block');
						}
						jQuery('#tx-tc-cts-pvsfuncs-' + id).css('display', 'block');
						jQuery('#tx-tc-cts-pvsnopreview-' + id).css('display', 'block');

						previewselpic[id] = change_pvs_pic(id,888,0);

						var testelem = document.getElementById('toctoc-comments-pvs-formtext-p' + id);
						if (testelem) {
							fhoffseth = parseInt(document.getElementById('toctoc-comments-pvs-formtext-p' + id).offsetHeight);

							logomargin = '-'+fhoffseth+'px';
							jQuery('#tx-tc-pvs-logobg-p' + id).css('margin-top', logomargin);
							logomargin='';
						}

						if (tctrim(htmlretcode) !== '3') {
 							jQuery.ajax({
								type: 'POST',
								url: 'index.php?eID=toctoc_comments_ajax',
								async: true,
								data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=savepreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
								success: function(html){
									if (html !== '') {
										if (html > 0) {
											previewselpreviewid[id] =html;
										}
									}
								}
							});
 							
						} else {
							jQuery('#tx-tc-form-wpp-working' + id).css('display', 'none');
						}
						setTimeout(function() {	
 							previewarr = [];
 							previewarr['cid']=id;
 							var str1=this.toctoc_comments_pi1_serialize(previewarr);
 							var ajaxpreviewopenurl=this.toctoc_comments_pi1_base64_encode(str1);
 							jQuery.ajax({
 								type: 'POST',
 								url: 'index.php?eID=toctoc_comments_ajax',
 								async: true,
 								data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=cleanuppreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
 								success: function(html){
 								}
 							});
						}, 1000);
						setopacity(tcsbmtnme + id,'1','toctoc_previewurl_fetch 3');

					}
					return true;
				}
			});
			timeoutID = window.setTimeout("toctoc_previewurl_fetch('" + id + "', '" + previewopenurl  + "', " + previewopenedprogress  + ", " + iterations + ", '" + lang + "', " + webpagepreviewheight  + ", '" + ajaxData + "', '" + ajaxDataAtt + "')", 1000);
		} else {
			iterations = 0;
			previewopenedprogress = 2;
			previewstarted[id] = previewopenedprogress;

			if (previewhtml[id] === '<img align="right" id="tx-tc-form-wpp-working' + id +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/'+selectedTheme+'/img/workingslides.gif" width="16" height="11" />') {
				document.getElementById('formhider-' + id).style.height = "auto";
				jQuery('#tx-tc-form-wpp-' + id).html('<img id="tx-tc-form-wpp-working' + id + '" class="tx-tc-working tx-tc-blockdisp" width="16" height="11" align="right" alt="'+ tcb64_dec(textLoading) + '" title="' + tcb64_dec(textLoading) +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/' + selectedTheme + '/img/workingslides.gif">');
				jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'none');
				jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '0px');
				jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '0px');
				setopacity(tcsbmtnme + id,'1','toctoc_previewurl_fetch 4');
				reset_previewvars (id);
			}
		}
		return true;
	} else {
		previewstarted[id]=0;
		if (htmlretcodesave !== 0) {
			reset_previewvars (id);
		}
		setopacity(tcsbmtnme + id,'1','toctoc_previewurl_fetch 5');
		htmlretcodesave=0;
	return true;

	}
}
function toctoc_previewurl_close (id,previewopenedprogress,webpagepreviewheight,ajaxData,ajaxDataAtt) {
	// send to server the cid and clean up temp
	var previewarr = [];
	previewarr['cid']=id;
	var str1=this.toctoc_comments_pi1_serialize(previewarr);
	var ajaxpreviewopenurl=this.toctoc_comments_pi1_base64_encode(str1);
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: true,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=cleanuppreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
		success: function(html){
		}
	});
	document.getElementById('formhider-' + id).style.height = "auto";
	jQuery('#tx-tc-form-wpp-' + id).html('<img id="tx-tc-form-wpp-working' + id + '" class="tx-tc-working tx-tc-blockdisp" width="16" height="11" align="right" alt="' + tcb64_dec(textLoading)  + '" title="' + tcb64_dec(textLoading) +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/' + selectedTheme + '/img/workingslides.gif">');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'none');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '0px');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '0px');
	jQuery('#tx-tc-cts-pvsprevnext-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-pvsprev-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-pvsnext-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-nopreviewpic-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-pvsfuncs-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-pvsnopreview-' + id).css('display', 'none');
	setopacity('tx-tc-form-dp-wpp-' + id,'1','toctoc_previewurl_close');
	jQuery('#tx-tc-' + id + 'uploaddiv').css('display', 'block');
	reset_previewvars (id);
	return true;
}
function reset_previewvars (id) {
	previewstarted[id] = 0;
	previewselpic[id] = 0;
	previewhtml[id] = '';
	previewselpreviewid[id] = 0;
	jQuery('#tx-tc-form-wpp-working' + id).on( 'click', function() {
		tccid = this.id;
		tccid = tccid.replace('tx-tc-form-wpp-working','');
		tccid2 = tccid;
		tcidarr = String(tccid).split("6g9");
		if (tcidarr.length === 3) {
			tccid=tcidarr[0];
		}
		toctoc_previewurl_close(tccid2, previewstarted[tccid2], confpvsheight, commentsAjaxData[tccid],  commentsAjaxDataAtt[tccid]);
	});
}
function change_pvs_pic(cid, currentindex, booforward) {
	var i=0;
	var j=0;
	do {
		var field = document.getElementById('pvsimgp' + cid + 'index' + i);
		if (field) {
			if (!field.src) {
				j=1001;
			}
		} else {
			j=1001;
		}
		i++;
		j++;
	} while (j < 1000);
	i=i-1;
	if (i === 0) {
		booforward=2;
	}
	// i = Anzahl Bilder
	var nextindex=0;
	if (currentindex === 888) {
		if (booforward === 2) {
			nextindex=888;
		}
	} else {
		nextindex=currentindex;
		if (booforward === 1) {
			if (currentindex<i-1) {
				nextindex=currentindex+1;
				jQuery('#pvsimgp' + cid + 'index' + currentindex).css('display', 'none');
				jQuery('#pvsimgp' + cid + 'index' + nextindex).css('display', 'block');
			}
		}
		else
		{
			if (currentindex>0) {
				nextindex=currentindex-1;
				jQuery('#pvsimgp' + cid + 'index' + currentindex).css('display', 'none');
				jQuery('#pvsimgp' + cid + 'index' + nextindex).css('display', 'block');
			}
		}
	}
	return nextindex;
}
function show_pvs_pic(cid, currentindex) {
	var i=0;
	var j=0;
	do {
		var field = document.getElementById('pvsimgp' + cid + 'index' + i);

		if (field) {
			if (!field.src) {
				j=1001;
			} else {
				jQuery('#pvsimgp' + cid + 'index' + i).css('display', 'none');
			}
		} else {
			j=1001;
		}
		i++;
		j++;

	} while (j < 1000);
	jQuery('#pvsimgp' + cid + 'index' + currentindex).css('display', 'block');
	previewselpic[cid] = currentindex;
	return '';
}
function remove_pvs_pic(cid) {

	document.getElementById('toctoc-comments-pvs-formtext-p' + cid).style.margin = "0px 0px 0px 2px";
	document.getElementById('pvsimgp' + cid + 'index' + previewselpic[cid]).style.display='none';
	jQuery('#toctoc_comments-pvs-image-box-p' + cid).css('display', 'none');
	jQuery('#toctoc_comments-pvs-images-p' + cid).css('border-right', 'none');
	jQuery('#tx-tc-cts-pvsprevnext-' + cid).css('display', 'none');
	jQuery('#toctoc-picfoundinfo-p' + cid).css('display', 'none');
	jQuery('#toctoc_comments-pvs-images-p' + cid).css('width', '0px');
	setopacity('toctoc_comments-pvs-image-box-p' + cid,'1','remove_pvs_pic');
	return 888;
}
function setopacity(elemid, opacityval, triggerdby) {
	var elem=document.getElementById(elemid);
	if (elem) {
		elem.style.opacity=opacityval;
		elem.style.filter='alpha(opacity='+ parseInt(String(100*parseFloat(opacityval))) +')';
	}
	else
	{
		console.log('element ' + elemid + ' does not exist, call triggered by: ' + triggerdby);
	}
}
function getopacity(elemid) {
	if (document.getElementById(elemid).style.opacity >= 0) {
		var opacityval=document.getElementById(elemid).style.opacity;
	} else {
		if (document.getElementById(elemid).style.filter.indexOf('opacity') >= 0) {
			opacityfilter=document.getElementById(elemid).style.filter;
			opacityfilterarr=opacityfilter.split("=");
			opacityfilter=opacityfilterarr[1];
			opacityfilterarr=opacityfilter.split(")");
			opacityval=opacityfilterarr[0];
		} else {
			opacityval='1';
			console.log('no opacity found for element: ' + elemid);
		}
	}
	return opacityval;
}
function commentreply(uid, previewselcommentcid, cid, ref, triggeredzone, triggereduid){
	previewselcomment[cid] = uid;
	if (triggeredzone === 'triggerform') {
		jQuery('#tx-tc-ct-report-' + uid).css('display', 'none');

		jQuery('#tx-tc-ct-ry-fh-' + uid).css('display', 'none');
		jQuery('#tx-tc-cts-rply-' + uid).css('display', 'block');

		comment_formhider(uid, 1, '', 0, 0, document.getElementById(tctnme + triggereduid));
		previewselcomment[cid] = uid;
	} else {

		setopacity('tx-tc-ct-ry-frame-' + cid,'0','commentreply');


		var elem=document.getElementById('tx-tc-cts-img-' + uid);
		var pichtml = '';
		if (elem) {
			pichtml = document.getElementById('tx-tc-cts-img-' + uid).outerHTML;
			pichtml = pichtml.replace('tx-tc-cts-img-','tx-tc-cts-imgsdw-');
		} else {
			pichtml = document.getElemevntById('tx-tc-cts-img-c' + cid).outerHTML;
			pichtml = pichtml.replace('tx-tc-cts-img-c','tx-tc-cts-imgsdw-');
		}

		pichtml = pichtml.replace('padding: 0;','margin: 0 8px 0 0;');
		pichtml = pichtml.replace('width=','class="tx-tc-ct-ry-img" align="left" width=');
		pichtml = pichtml.replace('width: 96px; height: 96px;','width: '+confuserpicsize+'px; height: '+confuserpicsize+'px;');
		txthtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML;
		txthtml = txthtml.replace('tcsroc-','tcsroc-999');
		txthtml = txthtml.replace('tx-tc-acropped-','tx-tc-acropped-999');
		txthtml = txthtml.replace('tx-tc-cropped-','tx-tc-cropped-999');

		var ratingsdisplaymodeoneelem = document.getElementById('tx-tc-ct-box-cttxt-start-' + uid);
		if (ratingsdisplaymodeoneelem) {
			txthtml = txthtml + '<br>' + ratingsdisplaymodeoneelem.innerHTML;
			txthtml = txthtml.replace('tcsroc-','tcsroc-999');
			txthtml = txthtml.replace('tx-tc-acropped-','tx-tc-acropped-999');
			txthtml = txthtml.replace('tx-tc-cropped-','tx-tc-cropped-999');

		}

		document.getElementById('tx-tc-ct-rybox-' + cid).innerHTML = pichtml + txthtml;
		jQuery('#tx-tc-ct-rybox-title-' + cid).css('display', 'block');
		jQuery('#tx-tc-ct-rybox-' + cid).css('display', 'block');
		jQuery('#tx-tc-cts-cocfuncs-' + cid).addClass('tx-tc-blockdisp');
		jQuery('#tx-tc-cts-cocfuncs-' + cid).removeClass('tx-tc-nodisp');
		jQuery('#tx-tc-cts-nococ-' + cid).addClass('tx-tc-blockdisp');
		jQuery('#tx-tc-cts-nococ-' + cid).removeClass('tx-tc-nodisp');

		jQuery('#tx-tc-ct-ry-frame-' + cid).css('display', 'block');
		comment_formhider(cid, 1, '', 0, 0, document.getElementById(tctnme + cid));
		previewselcomment[cid] = uid;
		toctoc_comments_fadein('tx-tc-ct-ry-frame-' + cid);
	}

}
function toctoc_coc_close(cid){
	previewselcomment[cid] = 0;
	if (toctoc_comments_fadeout('tx-tc-ct-ry-frame-' + cid) === true) {
		document.getElementById('tx-tc-ct-ry-frame-' + cid).style.display= 'none';
		jQuery('#tx-tc-ct-rybox-' + cid).css('display', 'none');
		jQuery('#tx-tc-ct-rybox-' + cid).html = '';
		jQuery('#tx-tc-ct-rybox-' + cid).css('display', 'none');
		jQuery('#tx-tc-ct-rybox-title-' + cid).css('display', 'none');

		jQuery('#tx-tc-cts-cocfuncs-' + cid).removeClass('tx-tc-blockdisp');
		jQuery('#tx-tc-cts-cocfuncs-' + cid).addClass('tx-tc-nodisp');
		jQuery('#tx-tc-cts-nococ-' + cid).removeClass('tx-tc-blockdisp');
		jQuery('#tx-tc-cts-nococ-' + cid).addClass('tx-tc-nodisp');
	}
}
/*
 * changing default user picture for anonymous users
 */
function changedefuserpic(gender, cid){
	(function($) {
		if (gender === '0') {
			$('#toctoc_comments_pi1_' + cid + 'gender').val('0');
			$('#tx-toctoc-comments-comments-img-gender-0-' + cid).removeClass('tx-tc-opa40');
			$('#tx-toctoc-comments-comments-img-gender-0-' + cid).addClass('tx-tc-opa1');
			$('#tx-toctoc-comments-comments-img-gender-1-' + cid).removeClass('tx-tc-opa1');
			$('#tx-toctoc-comments-comments-img-gender-1-' + cid).addClass('tx-tc-opa40');
		} else {
			$('#toctoc_comments_pi1_' + cid + 'gender').val('1');
			$('#tx-toctoc-comments-comments-img-gender-0-' + cid).removeClass('tx-tc-opa1');
			$('#tx-toctoc-comments-comments-img-gender-0-' + cid).addClass('tx-tc-opa40');
			$('#tx-toctoc-comments-comments-img-gender-1-' + cid).removeClass('tx-tc-opa40');
			$('#tx-toctoc-comments-comments-img-gender-1-' + cid).addClass('tx-tc-opa1');
		}
	})(jQuery);
}
/*
 * Comment previews
 */
function previewct(ajaxData, icid, onoff) {
	if (onoff === 0) {
		setopacity('tx-tc-cts-prv-ct-dp-' + icid,'0.4','previewct_off');
		tttip('hide');
		if (toctoc_comments_fadeout('tx-tc-cts-prv-ct-' + icid) === true) {
			icid=0;
		}
 	} else {
		var toctoc_pV = [];
		setopacity('tx-tc-cts-prv-ct-dp-' + icid,'0.6','previewct');
		jQuery('#tx-tc-cts-prv-ct-dp-' + icid).removeClass('tx-tc-nodisp');
		jQuery('#tx-tc-cts-prv-ct-dp-' + icid).addClass('tx-tc-blockdisp');
		// get the textareas current value and make ajaxpost for convert to comment

		var field = document.getElementById(tctnme + icid);
		var tmpcontent=field.value;
		tmpcontent=tmpcontent.replace(/\t/g,'');

		tmpcontent= tmpcontent.split('>').join('&gt;');
		tmpcontent= tmpcontent.split('<').join('&lt;');
		tmpcontent=tctrim(tmpcontent);

		tmpcontent=dbize_emojis(tmpcontent);

		toctoc_pV['cmd'] = 'preview';
		toctoc_pV['content'] = this.toctoc_comments_pi1_base64_encode(tmpcontent);
		var str1=this.toctoc_comments_pi1_serialize(toctoc_pV);
		var str2=this.toctoc_comments_pi1_base64_encode(str1);
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			async: false,
			data: 'ajaxdna=' + ajaxdna + '&cmd=previewcomment&data=' + str2 + '&dataconf=' + ajaxData,
			success: function(html){
				jQuery('#tx-tc-cts-prv-content-' + icid).html(html);

				jQuery('#tx-tc-cts-prv-content-' + icid).removeClass('tx-tc-nodisp');
				jQuery('#tx-tc-cts-prv-ct-' + icid).removeClass('tx-tc-nodisp');
				jQuery('#tx-tc-cts-div-ct-prv-' + icid).removeClass('tx-tc-nodisp');
				jQuery('#tx-tc-cts-img-prv-ct-' + icid).removeClass('tx-tc-nodisp');

				jQuery('#tx-tc-cts-prv-content-' + icid).addClass('tx-tc-blockdisp');
				jQuery('#tx-tc-cts-prv-ct-' + icid).addClass('tx-tc-blockdisp');
				jQuery('#tx-tc-cts-div-ct-prv-' + icid).addClass('tx-tc-blockdisp');
				jQuery('tx-tc-cts-img-prv-ct-' + icid).addClass('tx-tc-blockdisp');
				setopacity('tx-tc-cts-prv-ct-' + icid,'1','previewct_success');
				setTimeout(function() {
					setopacity('tx-tc-cts-prv-ct-dp-' + icid,'1','previewct');
					jQuery('#tx-tc-cts-prv-ct-dp-' + icid).removeClass('tx-tc-nodisp');
					jQuery('#tx-tc-cts-prv-ct-dp-' + icid).addClass('tx-tc-blockdisp');
					tttip('t101', "#prv-ct-" + icid + "[title]");
					tttip('t101',"#tx-tc-cts-img-prv-ct-" + icid + "[title]");
					tttip('temo','#tx-tc-cts-prv-content-' + icid + ' img[title]');
					tttip('temo','#tx-tc-cts-prv-content-' + icid + ' .emoji[title]');
				}, 1);
			}
		});

	}
}

/*
 * recent comments links
 */

function recentct(toprating, rcid, pid, url) {
	if (toprating === 1){
		setopacity('tx-tc-trt-cts-article-' + rcid,'0.6','recentct toprating');
	} else {
		setopacity('tx-tc-recent-cts-article-' + rcid,'0.6','recentct');
	}
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&cmd=rcclearcache&pid=' + pid,
		success: function(html){
			window.open(url, '_self');
		}
	});
}

/*
 * comment edit on and off, save
 */

function savect(id, icid,pid){
	
	var str0 = '';
	var strcommenttitle = '';
	var toctoc_pV = [];
	toctoc_pV['commenttitle'] = str0;
	if (document.getElementById('toctoc_comments_pi1_commenttitlec_' + id)) {
		var str0 = document.getElementById('toctoc_comments_pi1_commenttitlec_' + id).value;
		strcommenttitle=str0;
		str0=str0.replace(/\t/g,'');

		str0= str0.split('>').join('&gt;');
		str0= str0.split('<').join('&lt;');
		str0=tctrim(str0);
		toctoc_pV['commenttitle'] = this.toctoc_comments_pi1_base64_encode(str0);
	}
	
	var str1=document.getElementById('toctoc_comments_pi1_contenttextboxc_' + id).value;

	str1=str1.replace(/\t/g,'');

	str1= str1.split('>').join('&gt;');
	str1= str1.split('<').join('&lt;');
	str1=tctrim(str1);
	str1=dbize_emojis(str1);

	
	toctoc_pV['cmd'] = 'savect';
	toctoc_pV['content'] = this.toctoc_comments_pi1_base64_encode(str1);

	str1=this.toctoc_comments_pi1_serialize(toctoc_pV);
	var strcontent=this.toctoc_comments_pi1_base64_encode(str1);
	var ajaxData=commentsAjaxData[icid];
	var thisdata=commentsAjaxThisData[icid];
	var datac=commentsAjaxDataC[icid];
	var cssident = 'cts-ct';
	setopacity('tx-tc-' + cssident + '-dp-tx-tc-cts_' + id,'0.4','savect');
	tttip('hide');
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: false,
		data: 'ajaxdna=' + ajaxdna + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + id + '&pid=' + pid + '&cid=' + icid + '&content=' + strcontent + '&cmd=updatect',
		success: function(html){
			if (edithtmlkit !== '') {
				editsavenamehtml=edithtmlkit+'<br />';
			} else {
				if (confuseNameCommentSeparator==1) {
					editsavenamehtml= editsavenamehtml + ' ' + utf8_decode(tcb64_dec(textnameCommentSeparator)) + '&nbsp;';
				} else {
					editsavenamehtml= editsavenamehtml + '';
				}
			}
			
			editsavenamehtml= editsavenamehtml + commenttitletitlehtml;
			
			
			// test and processing if useVotes=1 and useLikeDislikeStyle=1
			var elemd2vilikeids = document.getElementById('tx-tc-ct-box-cttxt-start-'+ id);

			if (elemd2vilikeids) {
				jQuery('#tx-tc-ct-box-cttxt-start-' + id).html(commenttitletitlehtml + html);
				if (elemd2vilikeids.style.display !== '') {
					elemd2vilikeids.style.display='';
				}
				var cttxtarr = document.getElementById('tx-tc-ct-box-cttxt-'+ id).innerHTML.split('<form class');
				document.getElementById('tx-tc-ct-box-cttxt-'+ id).innerHTML=cttxtarr[0];
			} else {
				jQuery('#tx-tc-ct-box-cttxt-' + id).html(editsavenamehtml + html);
			}
			
			var elem= document.getElementById('tx-tc-commenttitle-' + id);
			if (elem) {
				var commentTitleStdWraparr = utf8_decode(tcb64_dec(textcommentTitleStdWrap)).split('|');
				if (strcommenttitle != '') {					
					elem.innerHTML = commentTitleStdWraparr[0] + strcommenttitle + commentTitleStdWraparr[1] + '<br>';
				} else {
					if (textrequiredcommenttitle == '') {
						elem.innerHTML = commentTitleStdWraparr[0] + '' + commentTitleStdWraparr[1];
					} else {
						// take initial value as save wont save the commenttitle empty
						elem.innerHTML = commentTitleStdWraparr[0] + editedcommenttitle + commentTitleStdWraparr[1];
					}
				}
			}
			
			commenttitletitlehtml='';
			if (edithtmlkit !== '') {
				edithtmlkit='';
			}
			if (norighttooltip==0) {
				editsavebthtml = editsavebthtml.replace('span class' , 'span title=\"' +utf8_decode(tcb64_dec(textEditComment)) + '\" class');
			}
			document.getElementById('edf' + id).outerHTML = editsavebthtml;
			document.getElementById('savef' + id).outerHTML = '';
			elem= document.getElementById('tx-tc-ct-ry-rl-' + id);
			if (elem) {
				if (elem.style.display !== '') {
					elem.style.display='';
				}
			}
			elem= document.getElementById('tx-tc-rts-dp-tx_toctoc_comments_comments_' + id);
			if (elem) {
				elem.style.display='';
			}
			elem= document.getElementById('tx-tc-myrts-dp-tx_toctoc_comments_comments_' + id);
			if (elem) {
				elem.style.display='';
			}
			elem= document.getElementById('tx-tc-rts-disp2-tx_toctoc_comments_comments_' + id);
			if (elem) {
				elem.style.display='';
			}
			elem= document.getElementById('txtcnamepart' + id);
			if (elem) {
				elem.style.display='';

			}
			elem = document.getElementById('tx-tc-ct-box-cttxt-start-'+ id);
			if (elem) {
				if (elem.style.display !== '') {
					elem.style.display='';
				}
			}
			
			elem = document.getElementById('toctoc_comments_pi1_commenttitlec_' + id);
			if (elem) {	
				// ...
			}
			if (elemd2vilikeids) {
				timeoutID = window.setTimeout("tcrebind('#tx-tc-ct-box-cttxt-start-" + id + "', 'savect-cttxt-start')", 100);
				} else {
				timeoutID = window.setTimeout("tcrebind('#tx-tc-ct-box-cttxt-" + id + "', 'savect-cttxt')", 100);
			}
			timeoutID = window.setTimeout("rebindediticon('#edf" + id + " ')", 40);

			edituid = 0;
			editon = false;
		}
	});
	var elem= document.getElementById('df' + id);
	if (elem) {
		elem.style.display='';
	}
	editsavenamehtml='';
	edithtmlkit='';
	setopacity('tx-tc-' + cssident + '-dp-tx-tc-cts_' + id,'1','savect');
}
function rebindediticon (itopid) {
	(function($) {
		$(itopid + '.tx-tc-ct-editbutton').on( 'click', function() {
			tccid = this.id;
			tccid = tccid.replace('toctoc_comments_pi1_submitedit_uid','');
			tccid2=tccid;
			tttip('hide');
			if ((this.id).length !== tccid.length) {
				tcidarr = String(tccid).split("__0");
				if (tcidarr.length > 1) {
					tccid=tcidarr[0];
				}
				editct(tcidarr[0], tcidarr[1], tcidarr[2], 1, this.id);
				tttip('t101','#' + this.id +'[title]');
			}
			//cancel edit
			$(itopid + '.tx-tc-ct-ceditbutton').on( 'click', function() {
				tccid = this.id;
				tccid = tccid.replace('toctoc_comments_pi1_submitedit_uid','');
				tttip('hide');
				if ((this.id).length !== tccid.length) {
					tcidarr = String(tccid).split("__0");
					if (tcidarr.length > 1) {
						tccid=tcidarr[0];
					}

					// : editct(uid, icid, pid, onoff, buttonid)
					editct(tcidarr[0], tcidarr[1], tcidarr[2], 0, this.id);
					tttip('t101','#' + this.id +'[title]');
				}

			});
			timeoutID = window.setTimeout("setsavecteventdelayed('.tx-tc-ct-savebutton')", 50);
		});
	})(jQuery);
}
function setsavecteventdelayed(tccid3) {
	(function($) {
		$(tccid3).on( 'click', function() {
			tccid = this.id;
			tccid = tccid.replace('toctoc_comments_pi1_submitsave_uid','');
			tttip('hide');
			if ((this.id).length !== tccid.length) {
				tcidarr = String(tccid).split("__0");
				if (tcidarr.length > 1) {
					tccid=tcidarr[0];
				}
				var fulluid = "toctoc_comments_pi1_contenttextboxc_" +  tcidarr[0] + "";
				// : savect(uid , 'icid', pid)
				if (commentform_validate(fulluid, tcidarr[1])) {
					savect(tcidarr[0], tcidarr[1], tcidarr[2]);
					tttip('t101','#' + this.id +'[title]');
				}

			}

		});
	})(jQuery);

}
function editct(uid, icid, pid, onoff, buttonid) {
	var elemdnf = document.getElementById('dnf'+ uid);
	var elemd2vilikeids = document.getElementById('tx-tc-ct-box-cttxt-start-'+ uid);
	var elem = document.getElementById('tx-tc-ct-ry-rl-' + uid);
	if (onoff === 0) {
		document.getElementById('tx-tc-ct-box-cttxt-' + uid).outerHTML = editsavehtml;
		document.getElementById('edf' + uid).outerHTML = editsavebthtml;
		document.getElementById('savef' + uid).outerHTML = '';
		var elemdf= document.getElementById('df' + uid);
		if (elemdf) {
			elemdf.style.display='';
		}
		elemdf= document.getElementById('tx-tc-rts-dp-tx_toctoc_comments_comments_' + uid);
		if (elemdf) {
			elemdf.style.display='';
		}
		elemdf= document.getElementById('tx-tc-myrts-dp-tx_toctoc_comments_comments_' + uid);
		if (elemdf) {
			elemdf.style.display='';
		}
		elemdf= document.getElementById('txtcnamepart' + uid);
		if (elemdf) {
			elemdf.style.display='';
		}

		elemdf= document.getElementById('tx-tc-rts-disp2-tx_toctoc_comments_comments_' + uid);
		if (elemdf) {
			elemdf.style.display='';
		}

		if (elemdnf) {
			elemdnf.style.display='';
		}

		if (elemd2vilikeids) {
			if (elemd2vilikeids.style.display !== '') {
				elemd2vilikeids.style.display='';
			}

		}

		if (elem) {
			if (elem.style.display !== '') {
				elem.style.display='';
			}
		}
		tttip('hide');
		elem= document.getElementById(buttonid);
		if (elem) {
			var savebtmhtml = elem.outerHTML;
			if (norighttooltip==0) {
				savebtmhtml = savebtmhtml.replace('span class' , 'span title=\"' +utf8_decode(tcb64_dec(textEditComment)) + '\" class');
			}
			
			elem.outerHTML=savebtmhtml;
		}
		rebindediticon("#" + buttonid);
		tttip('t101',"#" + buttonid + "[title]");
		// Comment crop link
		jQuery('#tx-tc-tcsroc-' + uid).on( 'click', function() {
			tccid = this.id;
			tccid = tccid.replace('tx-tc-tcsroc-','');
			if (tccid != this.id) {
				jQuery('#tx-tc-acropped-' + tccid + ' .tx-tc-tooltip').hide();
				tcsroc(tccid);
			}
		});
		editon = false;
		edituid = 0;
		editsavehtml ='';
		commenttitletitlehtml='';

	} else {
		if (editon === false) {
			editon = true;
			edituid = uid;
			elem = document.getElementById('df' + uid);
			if (elem) {
				elem.style.display='none';
			}

			elem= document.getElementById('tx-tc-rts-dp-tx_toctoc_comments_comments_' + uid);
			if (elem) {
				elem.style.display='none';
			}

			elem= document.getElementById('tx-tc-commenttitle-' + uid);
			if (elem) {
				commenttitletitlehtml=elem.outerHTML;
			}

			elem= document.getElementById('txtcnamepart' + uid);
			if (elem) {
				elem.style.display='none';
			}

			elem= document.getElementById('tx-tc-myrts-dp-tx_toctoc_comments_comments_' + uid);
			if (elem) {
				elem.style.display='none';
			}

			elem= document.getElementById('tx-tc-rts-disp2-tx_toctoc_comments_comments_' + uid);
			if (elem) {
				elem.style.display='none';
			}

			if (elemdnf) {
				elemdnf.style.display='none';
			}

			editsavehtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).outerHTML;
			if (acroppeds[uid]) {
				edithtml = acroppeds[uid];
			} else {
				edithtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML;
			}


			if (elemd2vilikeids) {
				edithtml = '<b>Firstname</b>&nbsp;<b>Lastname</b> - ' + elemd2vilikeids.innerHTML;
				document.getElementById('tx-tc-ct-box-cttxt-start-'+ uid).style.display='none';
			}

			var edithtmlarr = edithtml.split('tx-tc-overrating-date');
			if (edithtmlarr.length >1) {
				// displaymode2-edit
				var edithtmlkitarr = edithtml.split('</span><br>');
				edithtmlkit = edithtmlkitarr[0]+'</span>';
				if (edithtmlkitarr[1]) {
					edithtml='<b>Firstname</b>&nbsp;<b>Lastname</b> - ' + edithtmlkitarr[1];
				}

			}

			editsavebthtml = document.getElementById('edf' + uid).outerHTML;
			// dename, desmile and deurl edithtml

			var edithtmldn = '';
			edithtml = edithtml.replace(commenttitletitlehtml,'');
			edithtml=edithtml.replace(/<br \/>/g, '\r');
			edithtml=edithtml.replace(/<br>/g, '\r');

			elem= document.getElementById('tx-tc-acropped-' + uid);
			if (elem) {
				var edithtmloutarray=edithtml.split('tx-tc-acropped-');
				if (edithtmloutarray.length > 1) {
					var edithtmloutarrayspan=edithtmloutarray[1].split('</span>');
					edithtmloutarrayspanparttwo=edithtmloutarrayspan[1].split('>');
					edithtmloutarrayspanparttwo.splice(0,1);
					edithtmloutarrayspan[1]=edithtmloutarrayspanparttwo.join('>');
					edithtmloutarrayspan.splice(0,1);
					edithtmloutarray[1]=edithtmloutarrayspan.join('</span>');
					edithtmloutarray[1]=edithtmloutarray[1].substr(1,edithtmloutarray[1].length-8);
					edithtml=edithtmloutarray.join('');
					edithtml=edithtml.replace('<span class="tx-tc-inlinedisp" id="','');
					edithtml=edithtml.replace('<span class="tx-tc-nodisp" id="','');
					edithtml=edithtml.replace('/span><span id="tx-tc-cropped-' + uid + '" class="tx-tc-nodisp">','');
					edithtml=edithtml.replace('<span style="display: none;" class="tx-tc-inlinedisp" id="/span><span style="display: inline;" id="tx-tc-cropped-' + uid + '" class="tx-tc-nodisp">','');
				}

			}

			var dnArray = edithtml.split(' ' + utf8_decode(tcb64_dec(textnameCommentSeparator)) + '&nbsp;');
			if (dnArray.length>1) {
				editsavenamehtml=tctrim(dnArray[0]) + ' ';
				edithtmldn=tctrim(dnArray[1]);
				for (i = 2; i < dnArray.length; i++) {
					edithtmldn+=' ' + utf8_decode(tcb64_dec(textnameCommentSeparator)) + '&nbsp;' + dnArray[i];
				}

			} else {
				edithtmldn=edithtml.replace('<b>Firstname</b>&nbsp;<b>Lastname</b> - ','');
			}

			var edithtmlds = '';
			var smilieArray = edithtmldn.split('<img');
			if (smilieArray.length <= 1) {
				edithtmlds=edithtmldn;
			} else {
				for (i= 0; i < smilieArray.length; i++) {
					smilieSubArray = smilieArray[i].split('alt=\"' );

					if (smilieSubArray.length > 1) {
						thesmile= smilieSubArray[1].substr(0,smilieSubArray[1].indexOf('"'));
						theendtad= smilieSubArray[1].substr(0,smilieSubArray[1].indexOf('>'));

						smilieSubArrayrest=smilieSubArray[1].substr(smilieSubArray[1].indexOf('>')+1);
						edithtmlds += thesmile + smilieSubArrayrest;
					} else {
						edithtmlds += smilieArray[i];
					}

				}

			}

			edithtmlouturl = '';
			var urlArray = edithtmlds.split('<\/a>' );
			if (urlArray.length <= 1) {
				edithtmlouturl=edithtmlds;
			} else {
				var linkstr = '';
				var linkstrarr = [];
				for (i = 0; i < urlArray.length; i++) {
					urlSubArray = urlArray[i].split('<a' );
					if (urlSubArray.length > 1) {
						hastag= urlSubArray[0].indexOf('tx-tc-external-autolink');
						if (hastag > 0) {							
							linkstr = urlSubArray[0].substr(0, urlSubArray[0].indexOf('>')+1);
							linkstr = linkstr.replace('href="http://', '');
							linkstr = linkstr.replace('href="https://', '');
							linkstr = linkstr.replace('href="', '');
							linkstrarr = linkstr.split('"');
							linkstr = tctrim(linkstrarr[0]);
							if (linkstr != '') {
								edithtmlouturl += linkstr;
							} else {
								edithtmlouturl += urlSubArray[0].substr(urlSubArray[0].indexOf('>')+1);
							}

						} else {
							edithtmlouturl += urlSubArray[0];
						}

						hastag= urlSubArray[1].indexOf('tx-tc-external-autolink');
						if (hastag > 0) {
							
							linkstr = urlSubArray[1].substr(0, urlSubArray[1].indexOf('>')+1);
							linkstr = linkstr.replace('href="http://', '');
							linkstr = linkstr.replace('href="https://', '');
							linkstr = linkstr.replace('href="', '');
							linkstrarr = linkstr.split('"');
							linkstr = tctrim(linkstrarr[0]);
							if (linkstr != '') {
								edithtmlouturl += linkstr;
							} else {
								edithtmlouturl += urlSubArray[1].substr(urlSubArray[1].indexOf('>')+1);
							}
						} else {
							edithtmlouturl += urlSubArray[1];
						}

					} else {
						edithtmlouturl += urlArray[i];
					}

				}

			}
			edithtmloutbb = edithtmlouturl;


			for (i = 0; i < BBs.length; i++) {
				edithtmloutbb= edithtmloutbb.split('</' + BBs[i] + '>').join('[/' + BBsBBs[i]+ ']');
				edithtmloutbb= edithtmloutbb.split('<' + BBs[i] + '>').join('[' + BBsBBs[i]+ ']');
			}
			for (i = 0; i < BBs.length; i++) {
				// [/q]  [q]
				edithtmloutbb=edithtmloutbb.replace('[/' + BBsBBs[i] +']  [' + BBsBBs[i] +']','');
			}


			var edithtmloutemouc ='';
			var edithtmloutemoarrtest= edithtmloutbb.split("\r");
			if (edithtmloutemoarrtest.length <= 1) {
				edithtmloutemoarrtest= edithtmloutbb.split("\n");
			}

			if (edithtmloutemoarrtest.length > 1) {
				edithtmloutbb=edithtmloutemoarrtest.join('-@#@-');
			}

			var edithtmloutemoarr= edithtmloutbb.split('<span title="');
			if (edithtmloutemoarr.length > 1) {
				for (i = 0; i < edithtmloutemoarr.length; i++) {
					edithtmloutemoarr2= edithtmloutemoarr[i].split('" class="emoji emoji');
					if (edithtmloutemoarr2.length > 1) {
						edithtmloutemoarr2[0]='';
					}

					edithtmloutemoarr[i]=edithtmloutemoarr2.join('');
				}

			}

			if (edithtmloutemoarr.length > 1) {
				for (i = 0; i < edithtmloutemoarr.length; i++) {
					edithtmloutemoarr2 = [];
					edithtmloutemoarr2= edithtmloutemoarr[i].split('"></span>');
					if (edithtmloutemoarr2.length > 1) {
						edithtmloutemoarr3 = [];
						edithtmloutemoarr3= edithtmloutemoarr2[0].split(' ');
						if (edithtmloutemoarr3.length > 1) {
							if (edithtmloutemoarr3[1].length > 9) {
							edithtmloutemouc = '%' + edithtmloutemoarr3[1].replace(/-/g,'%');
							edithtmloutemoarr2[0]=edithtmloutemouc;
							} else {
								if (edithtmloutemoarr3[1].length > 5) {

									edithtmloutemouc = edithtmloutemoarr3[1].replace(/-/g,'%');
									edithtmloutemouc = edithtmloutemouc.substr(1);
									edithtmloutemoarr2[0]=edithtmloutemouc;
								} else {
									if (edithtmloutemoarr3[1].length > 1) {

										edithtmloutemouc = edithtmloutemoarr3[1].replace(/-/g,'%');
										edithtmloutemouc = '%' + edithtmloutemouc;
										edithtmloutemoarr2[0]=edithtmloutemouc;
									}

								}

							}

						}

						edithtmloutemoarr[i]=edithtmloutemoarr2.join('');
					}

				}

				edithtmloutbb=edithtmloutemoarr.join('');
				edithtmloutbb=unescape(edithtmloutbb);
			}

			edithtmloutbb= tctrim(edithtmloutbb.split('-@#@-').join("\r"));
			if (edithtmloutbb.substr(0,4)=='&nbs') {
				if (confuseNameCommentSeparator==1) {
					edithtmloutbb=edithtmloutbb.substr(6);
				}

			}
			//check commenttitle
			var outcommenttitlehtml ='';
			elem= document.getElementById('tx-tc-commenttitle-' + uid);
			var strcommenttitle = '';
			if (elem) {
				strcommenttitle = elem.innerHTML;
				var commentTitleStdWraparr = utf8_decode(tcb64_dec(textcommentTitleStdWrap)).split('|');
				strcommenttitle = strcommenttitle.replace(commentTitleStdWraparr[0],'');
				strcommenttitle = strcommenttitle.replace(commentTitleStdWraparr[1],'');
				strcommenttitle = strcommenttitle.replace('<br>','');
				editedcommenttitle = strcommenttitle;
			}
			
			if (elem) {	
				outcommenttitlehtml +='<div class="tx-tc-ct-form-field tx-tc-ct-name tx-tc-width100">';
				if (textrequiredcommenttitle != '') {
					textrequiredcommenttitle = utf8_decode(tcb64_dec(textrequiredcommenttitle));
				}
				var phdr = '';
				if (dolabel == 0) {
					outcommenttitlehtml +='<label class="tx-tc-ct-label tx-tc-ct-label-commenttitle';
					outcommenttitlehtml +='" for="toctoc_comments_pi1_commenttitle">' + utf8_decode(tcb64_dec(textCommenttitle)) + textrequiredcommenttitle+'</label>';
				} else {
					phdr = 'placeholder="' + utf8_decode(tcb64_dec(textCommenttitle)).replace(':','') + textrequiredcommenttitle+'" ';
				}
				formfieldcclass = '';
				if (boxmodelLabelWidth != 0) {
					formfieldcclass = 'tx-tc-ct-input tx-tc-ct-input-commenttitle';
				}
				outcommenttitlehtml += '<input class="' + formfieldcclass + '" ' + phdr + ' type="text" size="" name="toctoc_comments_pi1[commenttitle]"'; 
				outcommenttitlehtml += ' id="toctoc_comments_pi1_commenttitlec_' + uid +'" value="' + strcommenttitle + '" />';
				outcommenttitlehtml += '</div>';
			}
			
			
			// output the form
			outhtml= '<form class="tx-tc-form-for-newcomment"';
			outhtml+='><fieldset class="tx-tc-ct-fieldset"><textarea id="toctoc_comments_pi1_contenttextboxc_' + uid + '" class="tx-tc-ctinput-textarea" ';
			outhtml+='onfocus="jQuery(';
			outhtml+="'#toctoc_comments_pi1_contenttextboxc_" + uid + "').elastic();";
			outhtml+='" onblur="';
			outhtml+="jQuery('#toctoc_comments_pi1_contenttextboxc_" + uid + "').elastic();";
			outhtml+="jQuery('#toctoc_comments_pi1_contenttextboxc_" + uid + "').autoGrow();" ;
			outhtml+='" style="overflow: hidden; height: 20px; font-size: 100%;" cols="42" autocomplete="off">' + edithtmloutbb + '</textarea>' + outcommenttitlehtml + '</fieldset></form>';

			elem= document.getElementById('tx-tc-ct-ry-rl-' + uid);
			if (elem) {
				if (elem.style.display !== 'none') {
					elem.style.display = 'none';;
				}

			}

			jQuery('#'+buttonid).removeClass("tx-tc-ct-editbutton");
			jQuery('#'+buttonid).addClass("tx-tc-ct-ceditbutton");
			var newbuttonhtml= document.getElementById(buttonid).outerHTML;

			newbuttonhtml = newbuttonhtml.replace('editcommentfe','ceditcommentfe');
			if (norighttooltip==0) {
				newbuttonhtml = newbuttonhtml.replace('span class' , 'span title=\"' +utf8_decode(tcb64_dec(textCancelEditComment)) + '\" class');
			}
			savebthtml=editsavebthtml;

			savebthtml = savebthtml.replace('tx-tc-ct-ceditbutton','tx-tc-ct-savebutton');
			if (norighttooltip==0) {
				savebthtml = savebthtml.replace('span class' , 'span title=\"' + utf8_decode(tcb64_dec(textSaveComment))+ '\" class');
			}
			strnewfunc=icid + '__0' + uid + '__0' + icid + '__0' + pid;

			savebthtml = savebthtml.replace((uid + '__0' + icid + '__0' + pid + '__0' + buttonid), strnewfunc);
			savebthtml = savebthtml.replace('id=\"edf', 'id=\"savef');
			savebthtml = savebthtml.replace('class=\"tx-tc-ct-editfo','class=\"tx-tc-ct-savefo');
			savebthtml = savebthtml.replace('toctoc_comments_pi1_submitedit_uid','toctoc_comments_pi1_submitsave_uid');
			document.getElementById('edf' + uid).outerHTML = editsavebthtml+savebthtml;
			jQuery('#'+buttonid.replace('toctoc_comments_pi1_submitedit_uid','toctoc_comments_pi1_submitsave_uid')).removeClass("tx-tc-ct-editbutton");
			jQuery('#'+buttonid.replace('toctoc_comments_pi1_submitedit_uid','toctoc_comments_pi1_submitsave_uid')).addClass("tx-tc-ct-savebutton");

			if (confuseEmoji>0) {
				tapadding=22+Math.round(Math.round(boxmodelSpacing)/2);
				//smilieselectorttooltip = ' title="' + utf8_decode(tcb64_dec(textAddemoji))+'"';
				smilieselectorttooltip = ' ';
				smilieselectorhtml = '<div id="tx-tc-smilie-iconlink-' + icid + '6g9' +  uid + '6g9'+ '"><div class="tx-tc-smilie-icon" id="tx-tc-smilie-icon-' + icid + '6g9' +  uid + '6g9'+ '" ' + smilieselectorttooltip + '></div></div><div class="tx-tc-smilie-popup" id="tx-tc-smilie-popup-' + icid + '6g9' +  uid + '6g9'+ '"></div>';
				outhtml= outhtml.replace('</textarea>','</textarea>'+ smilieselectorhtml);
			}
			outhtml= outhtml.replace(/\t/g,'');
			//tooltippin:
			if (edithtmlkit !== '') {
				outhtml=edithtmlkit+outhtml;
				outhtml= outhtml.replace('class=\"tx-tc-form-for-newcomment\"','class=\"tx-tc-form-for-newcomment\" style=\"margin: 0 16px 0 0\"');
			}

			if (elemd2vilikeids) {
				outhtml= outhtml.replace('class=\"tx-tc-form-for-newcomment\"','class=\"tx-tc-form-for-newcomment\" style=\"margin: 0 16px 0 0\"');
				document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML += outhtml;
			} else {
				outhtml= outhtml.replace('class=\"tx-tc-form-for-newcomment\"','class=\"tx-tc-form-for-newcomment\" style=\"margin: 0 16px 0 0\"');
				document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML = outhtml;
			}

			document.getElementById(buttonid).outerHTML=newbuttonhtml;

			jQuery('#tx-tc-ct-box-cttxt-' + uid).on('keyup click', function(e) {
				var dummyret=99999;

					toctoc_checkurl(e.keyCode,document.getElementById('toctoc_comments_pi1_contenttextboxc_' + uid), uid, dummyret, activelang, confpvsheight, commentsAjaxData[uid],  commentsAjaxDataAtt[uid], maxCommentLength, e.pageX, e.pageY, e.which);
				});

			//focussing

			document.getElementById('toctoc_comments_pi1_contenttextboxc_' + uid).focus();
			rebindediticon("#" + buttonid.replace('toctoc_comments_pi1_submitedit_uid','toctoc_comments_pi1_submitsave_uid'));
			tttip('t101',"#" + buttonid + "[title]");
			tttip('t101',"#" + buttonid.replace('toctoc_comments_pi1_submitedit_uid','toctoc_comments_pi1_submitsave_uid') + "[title]");
			tcrebindemo('#tx-tc-ct-box-cttxt-' + uid);
		}

	}

}

/*
 *	Collapse expand comments
 */
function jtctrvw(tObj) {
	(function($) {
		tcnum=1;
		var checkchild=1;
		if (tObj.parentNode) {
			if (tObj.parentNode.id) {
				tccid = tObj.parentNode.id;
				tccid = tccid.replace('tctrvw__','');
				if (tccid != tObj.parentNode.id) {
					checkchild=0;
					tcidarr = String(tccid).split("__");
					tccid3=tcidarr[2].replace('@', '');
					tccid2=tcidarr[3].replace('@', '');
					$('.tx-tc-tooltip').hide();
					tctrvw(tcidarr[0], tcidarr[1], tccid3, tccid2);
					tcnum = 0;
				}

			}

		}
		if (checkchild===1) {
			tccid = tObj.firstChild.id;
			tccid = tccid.replace('tctrvw__','');
			tccid = tccid.replace('__nbcl','');
			if (tccid != tObj.firstChild.id) {
				tcidarr = String(tccid).split("__");
				tccid3=tcidarr[2].replace('@', '');
				tccid2=tcidarr[3].replace('@', '');
				$('.tx-tc-tooltip').hide();
				tctrvw(tcidarr[0], tcidarr[1], tccid3, tccid2);
				tcnum = 0;
			}

		}

		if (tcnum === 1) {
			// images
			if (tObj.id) {
				tccid = tObj.id;
				tccid = tccid.replace('tctrvw__','');
				if (tccid != tObj.id) {
					tcidarr = String(tccid).split("__");
					tccid3=tcidarr[2].replace('@', ' ');
					tccid2=tcidarr[3].replace('@', ' ');
					$('.tx-tc-tooltip').hide();
					tctrvw(tcidarr[0], tcidarr[1], tccid3, tccid2);
				}
			}
		}
	})(jQuery);
}
function tctrvw (expand, uid, children, allchildren){
	(function($) {
		allchildren = allchildren.replace(/@/g,'');
		var allchildrenArray = allchildren.split('rr');
		var childrenArray = children.split('rr');
		var ihtml= '';
		if (parseInt(expand) === 0) {
		//expand
			for (i= 0; i < childrenArray.length; i++) {
				if  (tcisInt(childrenArray[i])){
					childrenArray[i]=tctrim(childrenArray[i]);
					//document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).style.display= 'table';
					$('#tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).removeClass('tx-tc-nodisp');
					$('#tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).addClass('tx-tc-tabledisp');
					tctreestate[childrenArray[i]]=expand;
					//store visiblitystate of child
					if (!array_key_exists(uid,tcelemstate)) {
						tcelemstate[uid]= [];
						tcelemstate[uid][childrenArray[i]]= [];
					}

					if (!array_key_exists(childrenArray[i],tcelemstate[uid])) {
						tcelemstate[uid][childrenArray[i]]= [];
					}

					tcelemstate[uid][childrenArray[i]]['visible']=1;
					//restore expansionstate of child
					elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]);
					if (elemicon) {
						ihtml= document.getElementById('tx-tc-cts-explink-' + childrenArray[i]).innerHTML;
						if (tcelemstate[uid][childrenArray[i]]['expanded'] === 1) {
							document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display= 'block';
							document.getElementById('tx-tc-cts-img-exp-0-' + childrenArray[i]).style.display= 'none';
							ihtml = ihtml.replace('"tx-tc-lnkexp-2','"tx-tc-lnkexp');
							document.getElementById('tx-tc-cts-explink-' + childrenArray[i]).innerHTML=ihtml.replace('tctrvw__0','tctrvw__1');
						} else {
							document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display= 'none';
							document.getElementById('tx-tc-cts-img-exp-0-' + childrenArray[i]).style.display= 'block';
							tcelemstate[uid][childrenArray[i]]['expanded']=0;
							ihtml = ihtml.replace('"tx-tc-lnkexp','"tx-tc-lnkexp-2');
							document.getElementById('tx-tc-cts-explink-' + childrenArray[i]).innerHTML=ihtml.replace('tctrvw__1','tctrvw__0');
						}
					} else{
						tcelemstate[uid][childrenArray[i]]['expanded']=2;	//is leave
					}
				}
			}
			for (i= 1; i < allchildrenArray.length; i++) {
				allchildrenArray[i]=tctrim(allchildrenArray[i]);
				if  (tcisInt(tctrim(allchildrenArray[i]))){
					if (!array_key_exists(uid,tcelemstate)) {
							tcelemstate[uid]= [];
							tcelemstate[uid][allchildrenArray[i]]= [];
						}
						if (!array_key_exists(allchildrenArray[i],tcelemstate[uid])) {
							tcelemstate[uid][allchildrenArray[i]]= [];
						}

					if (tcelemstate[uid][allchildrenArray[i]]['visible'] === 1) {
						//document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display= 'table';
						$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).removeClass('tx-tc-nodisp');
						$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).addClass('tx-tc-tabledisp');
					} else {
						//document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display= 'none';
						$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).removeClass('tx-tc-tabledisp');
						$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).addClass('tx-tc-nodisp');
						tcelemstate[uid][allchildrenArray[i]]['visible']=0;
					}
					//restore expansionstate of child
					elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]);
					if (elemicon) {
						ihtml= document.getElementById('tx-tc-cts-explink-' + allchildrenArray[i]).innerHTML;
						if (tcelemstate[uid][allchildrenArray[i]]['expanded'] === 1) {
							document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display= 'block';
							document.getElementById('tx-tc-cts-img-exp-0-' + allchildrenArray[i]).style.display= 'none';
							ihtml = ihtml.replace('"tx-tc-lnkexp-2','"tx-tc-lnkexp');
							document.getElementById('tx-tc-cts-explink-' + allchildrenArray[i]).innerHTML=ihtml.replace('tctrvw__0','tctrvw__1');
						} else {
							document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display= 'none';
							document.getElementById('tx-tc-cts-img-exp-0-' + allchildrenArray[i]).style.display= 'block';
							tcelemstate[uid][allchildrenArray[i]]['expanded']=0;
							ihtml = ihtml.replace('"tx-tc-lnkexp','"tx-tc-lnkexp-2');
							document.getElementById('tx-tc-cts-explink-' + allchildrenArray[i]).innerHTML=ihtml.replace('tctrvw__1','tctrvw__0');
						}
					} else{
						tcelemstate[uid][allchildrenArray[i]]['expanded']=2;	//is leave
					}
				}
			}
			linkelem=document.getElementById('tx-tc-cts-explink-' + uid);
			if (linkelem) {
				ihtml= linkelem.innerHTML;
			}

			document.getElementById('tx-tc-cts-img-exp-0-' + uid).style.display= 'none';
			document.getElementById('tx-tc-cts-img-exp-1-' + uid).style.display= 'block';
			if (linkelem) {
				ihtml = ihtml.replace('"tx-tc-lnkexp-2','"tx-tc-lnkexp');
				document.getElementById('tx-tc-cts-explink-' + uid).innerHTML=ihtml.replace('tctrvw__0','tctrvw__1');
			}
		} else {
			//collapse
			for (i= 0; i < childrenArray.length; i++) {
				childrenArray[i]=tctrim(childrenArray[i]);
				if (tcisInt(childrenArray[i])){
					//document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).style.display= 'none';
					$('#tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).removeClass('tx-tc-tabledisp');
					$('#tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).addClass('tx-tc-nodisp');

					tctreestate[childrenArray[i]]=expand;
					//store visiblitystate of child
					if (!array_key_exists(uid,tcelemstate)) {
							tcelemstate[uid]= [];
							tcelemstate[uid][childrenArray[i]]= [];
					}
					if (!array_key_exists(childrenArray[i],tcelemstate[uid])) {
							tcelemstate[uid][childrenArray[i]]= [];
					}

					tcelemstate[uid][childrenArray[i]]['visible']=0;
					//store expansionstate of child
					elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]);
					if (elemicon) {
					    if ((document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display === 'block') || (($('#tx-tc-cts-img-exp-1-' + childrenArray[i]).hasClass('tx-tc-blockdisp')) && (document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display == ''))) {
							tcelemstate[uid][childrenArray[i]]['expanded']=1;
						} else {
							tcelemstate[uid][childrenArray[i]]['expanded']=0;
						}
					} else{
						tcelemstate[uid][childrenArray[i]]['expanded']=2;	//is leave
					}
				}
			}
			for (i= 1; i < allchildrenArray.length; i++) {
				allchildrenArray[i]=tctrim(allchildrenArray[i]);

				if (tcisInt(allchildrenArray[i])){
					if (!array_key_exists(uid,tcelemstate)) {
							tcelemstate[uid]= [];
							tcelemstate[uid][allchildrenArray[i]]= [];
					}
					if (!array_key_exists(allchildrenArray[i],tcelemstate[uid])) {
							tcelemstate[uid][allchildrenArray[i]]= [];
					}

				    if (($('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).hasClass("tx-tc-tabledisp")) || ((!$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).hasClass('tx-tc-nodisp')) && (document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display == ''))) {
				    	tctreestate[allchildrenArray[i]]=0;
						//store visiblitystate of child
						tcelemstate[uid][allchildrenArray[i]]['visible']=1;

					} else {
						tctreestate[allchildrenArray[i]]=1;
						//store visiblitystate of child
						tcelemstate[uid][allchildrenArray[i]]['visible']=0;
					}

					//store expansionstate of child
					elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]);
					if (elemicon) {
					    if ((document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display === 'block') || ((!$('#tx-tc-cts-img-exp-1-' + allchildrenArray[i]).hasClass('tx-tc-nodisp')) && (document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display == ''))) {
							tcelemstate[uid][allchildrenArray[i]]['expanded']=1;
						} else {
							tcelemstate[uid][allchildrenArray[i]]['expanded']=0;
						}

					} else {
						tcelemstate[uid][allchildrenArray[i]]['expanded']=2;	//is leave
					}

					//document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display= 'none';
					$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).removeClass('tx-tc-tabledisp');
					$('#tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).addClass('tx-tc-nodisp');
				}
			}
			linkelem=document.getElementById('tx-tc-cts-explink-' + uid);
			if (linkelem) {
				ihtml= linkelem.innerHTML;
			}

			document.getElementById('tx-tc-cts-img-exp-1-' + uid).style.display= 'none';
			
			document.getElementById('tx-tc-cts-img-exp-0-' + uid).style.display= 'block';
			if (linkelem) {
				ihtml = ihtml.replace('"tx-tc-lnkexp','"tx-tc-lnkexp-2');
				document.getElementById('tx-tc-cts-explink-' + uid).innerHTML=ihtml.replace('tctrvw__1','tctrvw__0');
			}
		}
	})(jQuery);
}

function tcsroc(uid){

	document.getElementById('tx-tc-cropped-' + uid).style.display='inline';
	document.getElementById('tx-tc-acropped-' + uid).style.display='none';
	// remove '" class="tx-tc-nodisp"><q>'
	// and '</q> <span style="display: none;" class="tx-tc-inlinedisp" id="tx-tc-acropped'
	var wrkhtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML;
	acroppeds[uid]=wrkhtml;
	for (i = 0; i < BBs.length; i++) {
		if ((wrkhtml.replace('\" class="tx-tc-nodisp\"><'+BBs[i]+'>', '') != wrkhtml) && (wrkhtml.replace('</'+BBs[i]+'> <span style=\"display: none;\" class=\"tx-tc-inlinedisp\" id=\"tx-tc-acropped', '') != wrkhtml)) {
			wrkhtml= wrkhtml.replace('\" class=\"tx-tc-nodisp\"><'+BBs[i]+'>', '\" class=\"tx-tc-nodisp\">');
			wrkhtml= wrkhtml.replace('</'+BBs[i]+'> <span style=\"display: none;\" class=\"tx-tc-inlinedisp\" id=\"tx-tc-acropped', '<span style=\"display: none;\" class=\"tx-tc-inlinedisp\" id=\"tx-tc-acropped');
		}
	}
	document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML =wrkhtml;
}

function updatecommentscount (cid, addval){
	var elem=document.getElementById('tx-tc-ct-cnt-' + cid);
	if (elem) {
		if (elem.innerHTML.indexOf('icon_comments')>0) {
			var elemarriconized= elem.innerHTML.split('.png">');
			var countval=tctrim(elemarriconized[1].substr(0, elemarriconized[1].indexOf('<')));
			var newval = parseInt(countval)+parseInt(addval);
			elemarriconized[1]=newval+elemarriconized[1].substr(elemarriconized[1].indexOf('<'));
			var eleminnerHTML = elemarriconized.join('.png">');
		} else {
			if (elem.innerHTML.indexOf('nbrofcomments srt">')>0) {
				elemarriconized= elem.innerHTML.split('nbrofcomments srt">');
				countval=tctrim(elemarriconized[1].substr(0, elemarriconized[1].indexOf('<')));
				newval = parseInt(countval)+parseInt(addval);
				elemarriconized[1]=newval+'&nbsp;'+elemarriconized[1].substr(elemarriconized[1].indexOf('<'));
				eleminnerHTML = elemarriconized.join('nbrofcomments srt">');

			} else {

				if (elem.innerHTML.indexOf('nbrofcomments-1">')>0) {
					///nbrofcomments-1">
					elemarriconized= elem.innerHTML.split('nbrofcomments-1">');
					countval=tctrim(elemarriconized[1].substr(0, elemarriconized[1].indexOf('<')));
					newval = parseInt(countval)+parseInt(addval);
					elemarriconized[1]=newval+elemarriconized[1].substr(elemarriconized[1].indexOf('<'));
					eleminnerHTML = elemarriconized.join('nbrofcomments-1">');

				} else {
					elemarriconized= elem.innerHTML.split('nbrofcomments">');
					countval=tctrim(elemarriconized[1].substr(0, elemarriconized[1].indexOf('<')));
					newval = parseInt(countval)+parseInt(addval);
					elemarriconized[1]=newval+elemarriconized[1].substr(elemarriconized[1].indexOf('<'));
					eleminnerHTML = elemarriconized.join('nbrofcomments">');
				}
			}
		}
		jQuery('#tx-tc-ct-cnt-' + cid).html(eleminnerHTML);
		if (newval<=confcommentsPerPage) {
			var elema=document.getElementById('tx-tc-cts-ctsbrowse-hide-' + cid);
			if (elema) {
				jQuery('#tx-tc-cts-ctsbrowse-hide-' + cid).css('display', 'none');
			}
			var elemb=document.getElementById('tx-tc-cts-ctsbrowse-' + cid);
			if (elemb) {
				if (tctrim(elemb.innerHTML) === '') {
					jQuery('#tx-tc-cts-ctsbrowse-' + cid).css('display', 'none');
				}
			}
		}
	}
	return 0;
}

function toctoc_comments_pi1_getUploadData(icid) {
	var toctoc_piVars = [];
	toctoc_piVars['firstname'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('firstname',icid));
	toctoc_piVars['commenttitle'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('commenttitle',icid));
	toctoc_piVars['lastname'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('lastname',icid));
	toctoc_piVars['location'] = this.toctoc_comments_pi1_base64_encode(toctoc_comments_pi1_getUserDataField('location',icid));
	toctoc_piVars['email'] = toctoc_comments_pi1_getUserDataField('email',icid);
	toctoc_piVars['homepage'] = toctoc_comments_pi1_getUserDataField('homepage',icid);
	toctoc_piVars['notify'] = toctoc_comments_pi1_getUserDataField('notify',icid);

	toctoc_piVars['itemurl'] = toctoc_comments_pi1_getUserDataField('itemurl',icid);
	toctoc_piVars['itemurlchk'] = toctoc_comments_pi1_getUserDataField('itemurlchk',icid);
	toctoc_piVars['cid'] = toctoc_comments_pi1_getUserDataField('cid',icid);
	toctoc_piVars['level'] = toctoc_comments_pi1_getUserDataField('level',icid);
	toctoc_piVars['myfile'] = toctoc_comments_pi1_getUserDataField('uploadpic',icid);
	toctoc_piVars['pathim'] = utf8_decode(tcb64_dec(pathim));

	var str1=this.toctoc_comments_pi1_serialize(toctoc_piVars);
	var str2=this.toctoc_comments_pi1_base64_encode(str1);
	return str2;
}

function tcfilechange_delayed(id,ajaxData,ajaxDataAtt){
	timeoutID = window.setTimeout("tcfilechange('"+id+"', '" +ajaxData+"', '" +ajaxDataAtt+"')", 600);
	return;

}

function uploadmessage(message,cid) {
	//console.log('message ' + message + 'cid ' + cid);
	information(message,cid, function () {});
	messageon=false;
	return false;
}
function tcfilechange(id,ajaxData,ajaxDataAtt){

	var informid='cf' + id;
	var ininputpicid='toctoc_comments_pi1_' + id + 'uploadpicid';
	var ininputpicidh='toctoc_comments_pi1_' + id + 'uploadpicheight';
	var ininputpicname='toctoc_comments_pi1_' + id + 'originalfilename';
	var inthisname='toctoc_comments_pi1_' + id + 'uploadpic';
	var inthisajax='toctoc_comments_pi1_' + id + 'ajax';
	var inupldiv='tx-tc-' + id + 'uploaddiv';
	var lineheightupload = 8;
	var inthis= document.getElementById(inthisname);
	var previewidfup='';
	var previewfupdir='';
	var previewfupheight=0;
	var textmsg ='';
	var ispicupload=true;
	if(uploadtype === 'pdf') {
		ispicupload=false;
	}
	var pathimarr= [];
	pathimarr['path']=utf8_decode(tcb64_dec(pathim));
	var inthishiddenajax = document.getElementById(inthisajax);
	inthishiddenajax.value= ajaxDataAtt;
	
	var ininputpicidvalelem = document.getElementById(ininputpicid);
	var ininputpicidvalelemh = document.getElementById(ininputpicidh);
	var ininputpicnameelem = document.getElementById(ininputpicname);
	// geting correct id of the informationpanel for subcomments
	var msgcid= '';
	tcidarr2 = String(id).split("6g9");
	if (tcidarr2.length === 3) {
		msgcid=tcidarr2[0];
	} else {
		msgcid=tccid;
	}
	
	if( inthis.files ){
	//files supported (HTML5)
		var file = inthis.files[0];
		var fname = file.name;
		if(file.name.length < 1) {
			return false;
		} else if (uploadtype === 'pic') {
			if(file.type !== 'image/png' && file.type !== 'image/jpg' && file.type !== 'image/gif' && file.type !== 'image/jpeg') {
				textmsg = utf8_decode(tcb64_dec(textPicFiletypeErr));
				messageon=true;
				timeoutID = window.setTimeout("uploadmessage('" + textmsg + "', '" + msgcid + "')", 100);
				return false;
			}
			if(file.size > picUploadMaxfilesize) {
				textmsg = utf8_decode(tcb64_dec(textPicFileToBig));
				messageon=true;
				timeoutID = window.setTimeout("uploadmessage('" + textmsg + "', '" + msgcid + "')", 100);
				return false;
			}
		} else if (uploadtype === 'pdf') {
			if(file.type !== 'application/pdf' && file.type !== 'application/x-pdf' ) {
				textmsg = utf8_decode(tcb64_dec(textpdfFiletypeErr));
				messageon=true;
				timeoutID = window.setTimeout("uploadmessage('" + textmsg + "', '" + msgcid + "')", 100);
				return false;
			}
			if(file.size > pdfUploadMaxfilesize) {
				textmsg = utf8_decode(tcb64_dec(textPdfFileToBig));
				messageon=true;
				timeoutID = window.setTimeout("uploadmessage('" + textmsg + "', '" + msgcid + "')", 100);
				return false;
			}
		}
		var oData = new FormData(document.forms.namedItem('n' + informid));

		oData.append("myfile", file);
		oData.append("toctoc_comments_pi1[pathim]", pathimarr['path']);
		oData.append("toctoc_comments_pi1[configbaseURL]", utf8_decode(tcb64_dec(configbaseURL)));
		previewstartedfp[id] = 1;
		setopacity(tcsbmtnme + id,'0.4','tcfilechange');
		jQuery('#' + inupldiv).css('display', 'none');
		jQuery('#tx-tc-form-fup-working' + id).css('display', 'block');
		// old: url: utf8_decode(tcb64_dec(configbaseURL)) + "typo3conf/ext/toctoc_comments/pi1/class.toctoc_comments_attachmentupload.php",

		jQuery.ajax({
			type: 'POST',
			url: 'index.php?eID=toctoc_comments_ajax',
			data: oData,
			async: false,
			success: function(data){
				dataarr=data.split('<br>');
				previewidfup=dataarr[0];
				previewfupdir=dataarr[1];
				previewfupheight=dataarr[2];
				previewstartedfp[id] = 2;

			},
			processData: false,  // tell jQuery not to process the data
			contentType: false	// tell jQuery not to set contentType
		});

	} else {
	//.files not supported
		alert ("Your browser supports no HTML5 uploads (files not supported)");
	}
	
	if (previewfupheight < 46) {
		previewfupheight = 46;
	}
	
	jQuery('#tx-tc-form-dp-fup-' + id).css('display', 'none');
	jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', '0px');
	jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', '0px');
	jQuery('#tx-tc-form-fup-working' + id).css('display', 'none');

	if (previewstartedfp[id] === 2) {
		document.getElementById('tx-tc-cts-previewfup-' + id).src=previewfupdir+previewidfup;
		document.getElementById('formhider-' + id).style.height = String(parseInt(document.getElementById('formhider-' + id).offsetHeight)+parseInt(previewfupheight)+parseInt(lineheightupload)) + 'px';
		jQuery('#tx-tc-form-dp-fup-' + id).css('display', 'block');

		jQuery('#tx-tc-cts-previewfup-' + id).css('display', 'block');
		jQuery('#tx-tc-cts-nopreviewfup-' + id).css('display', 'block');
		jQuery('#tx-tc-cts-pvsfuncsfup-' + id).css('display', 'block');
		jQuery('#tx-tc-cts-fuppicprv-' + id).css('display', 'block');
		jQuery('#tx-tc-cts-fupta-' + id).css('display', 'block');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('max-height', previewfupheight+'px');
		if (!ispicupload) {
			document.getElementById('tx-tc-cts-previewfup-' + id).title=fname;
			document.getElementById('tx-tc-cts-nopreviewfup-' + id).title=utf8_decode(tcb64_dec(textclosepdfupload));
			if (document.getElementById('toctoc_comments_pi1_uplcontenttextbox_' + id).value === '') {
				jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).watermark(utf8_decode(tcb64_dec(textpdfdescribe)) + ' \"' + fname + '\"', {left: 0, top: 0, fallback: true});
			}

		} else {
			document.getElementById('tx-tc-cts-nopreviewfup-' + id).title=utf8_decode(tcb64_dec(textclosepicupload));
			if (document.getElementById('toctoc_comments_pi1_uplcontenttextbox_' + id).value === '') {
				jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).watermark(utf8_decode(tcb64_dec(textimagedescribe)) + ' \"' + fname + '\"', {left: 0, top: 0, fallback: true});
			}
		}

		previewfuph=parseInt(previewfupheight)+parseInt(lineheightupload);
		jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', previewfuph+'px');
		jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', previewfuph+'px');

		tttip('t101','#tx-tc-cts-nopreviewfup-' + id + '[title]');
		jQuery('#' + inupldiv).css('display', 'none');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('display', 'block');
		previewstartedfp[id] = 3;
		previewfpheight[id] = previewfupheight;
		ininputpicidvalelem.value=previewidfup;
		ininputpicidvalelemh.value=previewfupheight;
		ininputpicnameelem.value=fname;
	} else {
		jQuery('#tx-tc-form-dp-fup-' + id).css('display', 'none');
		jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', '0px');
		jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', '0px');
		jQuery('#tx-tc-cts-fuppicprv-' + id).css('display', 'none');
		jQuery('#tx-tc-cts-fupta-' + id).css('display', 'none');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('max-height', '0px');
		jQuery('#' + inupldiv).css('display', 'block');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('display', 'none');

		previewstartedfp[id]  = 0;
		previewfpheight[id]  = 0;
		ininputpicidvalelem.value='';
		ininputpicidvalelemh.value='0';
		ininputpicnameelem.value='';
		jQuery('#tx-tc-cts-nopreviewfup-' + id).css('display', 'none');
	}
	setopacity(tcsbmtnme + id,'1','tcfilechange');
	return true;

}

function tcformatnewdate(comparedate) {
	var start_time_for_conversion = comparedate;
	var end_time_for_conversion = Math.round(new Date().getTime()/1000)- tclocaltimediff ;
	var difference_of_times = end_time_for_conversion - start_time_for_conversion;
	var time_difference_string = '';
	var stringcollator=0;
	var morethanonstr ='';
	var unit_size = 0;
	for (var i_make_time = 6; i_make_time > 0; i_make_time=i_make_time-1)	{
		switch(i_make_time)
		{
		// Handle Minutes
		// ........................
		case 1:
			unit_title = utf8_decode(tcb64_dec(pi1_templatetimeconvminute));
			morethanonstr =utf8_decode(tcb64_dec(pi1_templatetimeconvminutes));
			unit_size = 60;
			break;
		// Handle Hours
		// ........................
		case 2:
			unit_title = utf8_decode(tcb64_dec(pi1_templatetimeconvhour));
			morethanonstr =utf8_decode(tcb64_dec(pi1_templatetimeconvhours));
			unit_size = 3600;
			break;
		// Handle Days
		// ........................

		case 3:
			unit_title = utf8_decode(tcb64_dec(pi1_templatetimeconvday));
			morethanonstr =utf8_decode(tcb64_dec(pi1_templatetimeconvdays));
			unit_size = 86400;
			break;
		// Handle Weeks
		// ........................
		case 4:
			unit_title = utf8_decode(tcb64_dec(pi1_templatetimeconvweek));
			morethanonstr =utf8_decode(tcb64_dec(pi1_templatetimeconvweeks));
			unit_size = 604800;
			break;
		// Handle Months (31 Days)
		// ........................
		case 5:
			unit_title = utf8_decode(tcb64_dec(pi1_templatetimeconvmonth));
			morethanonstr = utf8_decode(tcb64_dec(pi1_templatetimeconvmonths));
			unit_size = 2678400;
			break;
		// Handle Years (365 Days)
		// ........................
		case 6:
			unit_title = utf8_decode(tcb64_dec(pi1_templatetimeconvyear));
			morethanonstr = utf8_decode(tcb64_dec(pi1_templatetimeconvyears));
			unit_size = 31536000;
			break;
		default:
			break;
		}

		if (difference_of_times > (unit_size - 1)) {
			var modulus_for_time_difference = difference_of_times % unit_size;
			var seconds_for_current_unit = difference_of_times - modulus_for_time_difference;
			var units_calculated = seconds_for_current_unit / unit_size;
			difference_of_times = modulus_for_time_difference;
			if (stringcollator<2) {
				if (units_calculated === 1) {
					time_difference_string += units_calculated + ' ' + unit_title + ' ';
				} else {
					time_difference_string += units_calculated + ' ' + morethanonstr + ' ';
				}
				stringcollator = stringcollator + 1;
			}
		}
	}
	// Handle Seconds
	// ........................
	if (stringcollator<2) {
		if (difference_of_times === 1) {
			time_difference_string += difference_of_times + ' ' + utf8_decode(tcb64_dec(pi1_templatetimeconvsecond)) + ' ';
		} else {
			time_difference_string += difference_of_times + ' ' + utf8_decode(tcb64_dec(pi1_templatetimeconvseconds)) + ' ';
		}
	}

	var retstr = tctrim(utf8_decode(tcb64_dec(pi1_templatetimeconvtextbefore)) + ' ' + time_difference_string + utf8_decode(tcb64_dec(pi1_templatetimeconvtextafter)));
	retstr = retstr.replace(/-/g,'');
	return retstr;
}


function check_dates() {
	var j=0;
	var tstampdate=0;
	var addmiddot ='';
	var slen = 0;
	var elen = 0;
	var idstr = '';
	var idfromidstr = 0;
	var newformatdate='';
	var tmpformatdate='';
	var elem;
	if (tcservertime !== 0) {
		// reply from ajax is here
		var cdstart = Math.round(new Date().getTime());
		checkdatedelay = 500;
		jQuery('.tx-tc-dyndate').each(function(index) {		
			//console.log( index + " children: " + jQuery(this).children().attr('id'));
			idstr = jQuery(this).children().attr('id');
			idfromidstr = idstr.replace('tx-tc-ctdatedisp-','');
			if (idstr != idfromidstr) {
				elem = document.getElementById('tx-tc-ctdatetime-' + idfromidstr);
				if (elem) {
					tstampdate=elem.innerHTML;
					newformatdate=tcformatnewdate(tstampdate);
					elemdisp= document.getElementById('tx-tc-ctdatedisp-' + idfromidstr);
					addmiddot ='';

					if (elemdisp) {
						slen= elemdisp.innerHTML.length;

						if (elemdisp.innerHTML.indexOf(middotchar)>1) {
							addmiddot ='&nbsp;' + middotchar + '&nbsp;';
						}
						if (elemdisp.innerHTML.indexOf('·')>1) {
							addmiddot ='&nbsp;' + middotchar + '&nbsp;';
						}
						elemdisp.innerHTML=newformatdate + addmiddot;
						//console.log( index + " changed: " + 'tx-tc-ctdatedisp-' + idfromidstr);
						
						elen= elemdisp.innerHTML.length;
						if (((slen-elen) >= 12) && ((slen-elen) <= 15)) {
							addmiddot ='&nbsp;' + middotchar + '&nbsp;';
							elemdisp.innerHTML=newformatdate + addmiddot;
							//console.log( index + " changed 2: " + 'tx-tc-ctdatedisp-' + idfromidstr);
						}
						j++;
						
					}
				} 
				
			} else {
				idfromidstr = idstr.replace('tx-tc-rctdatedisp-','');
				if (idstr != idfromidstr) {
					elem = document.getElementById('tx-tc-rctdatetime-' + idfromidstr);
					if (elem) {
						tstampdate=elem.innerHTML;
						newformatdate=tcformatnewdate(tstampdate);
						elemdisp= document.getElementById('tx-tc-rctdatedisp-' + idfromidstr);
						addmiddot ='';

						if (elemdisp) {
							if (elemdisp.innerHTML.indexOf('&nbsp;')>1) {
								addmiddot ='&nbsp;' + middotchar + '&nbsp;';
							}
							elemdisp.innerHTML=newformatdate + addmiddot;
							//console.log( index + " changed: " + 'tx-tc-rctdatedisp-' + idfromidstr);
							j++;
							
						}
					}
				}	else {
					idfromidstr = idstr.replace('tx-tc-rctlowdatedisp-','');
					if (idstr != idfromidstr) {
						elem = document.getElementById('tx-tc-rctlowdatetime-' + idfromidstr);
						if (elem) {
							tstampdate=elem.innerHTML;
							//console.log('tstampdate' + tstampdate);
							tmpformatdate=tcformatnewdate(tstampdate);
							newformatdate = tmpformatdate.substr(0, 1).toString().toLowerCase() + tmpformatdate.substr(1, newformatdate.length).toString();
							//console.log('newformatdate ' + newformatdate);
							elemdisp = document.getElementById('tx-tc-rctlowdatedisp-' + idfromidstr);
							addmiddot ='';

							if (elemdisp) {
								if (elemdisp.innerHTML.indexOf('&nbsp;')>1) {
									addmiddot ='&nbsp;' + middotchar + '&nbsp;';
								}
								elemdisp.innerHTML=newformatdate + addmiddot;
								//console.log( index + " changed: " + 'tx-tc-rctlowdatedisp-' + idfromidstr);
								j++;
								
							}
						}
					} else {
						//console.log( index + " no change for: " + idstr);
					}
					
				}
				
			}
			if (!jQuery(this).css('opacity', '1')) {
				jQuery(this).css('opacity', '1');				
			}
		});
		
		cdtime = Math.round(new Date().getTime()) - cdstart;
	}

	if (checkdatedelay == 200) {
		if (tcservertime !== 0) {
			checkdatedelay=500;
		} else {
			noajaxreply++;
			if (noajaxreply>100) {
				console.log('exit waiting for AJAX, no reply');
				return true;
			}
		}
		timeoutID = window.setTimeout("check_dates()", checkdatedelay);

	} else {
		if (j == 0) {
			return true;
		}
		checkdatedelay=60000;
		timeoutID = window.setTimeout("check_dates()", checkdatedelay);
	}
}
if (tcdateformat === 0) {
	var langData = '';
	var langDataVars = [];	
	langDataVars['lang'] = activelang;
	langDataVars['langid'] = pagelanId;
	var str1 = this.toctoc_comments_pi1_serialize(langDataVars);
	langData = this.toctoc_comments_pi1_base64_encode(str1);
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: true,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + 0 + '&pageid=' + pageid + '&cmd=gettime&data=' + langData,
		success: function(html){
			tcservertime = parseInt(html);
			tclocaltimediff = Math.round(new Date().getTime() / 1000) - tcservertime;
		}
	});
	check_dates();
}
if (tcsmiliecard !== '') {
	var tcsmiliecardhtml=utf8_decode(tcb64_dec(tcsmiliecard));
}
if (tcbbcard !== '') {
	var tcbbcardhtml=utf8_decode(tcb64_dec(tcbbcard));
}

function comments_view(icid, iusr, ajaxData, isComment, storagepid) {
	comments_view_delayed(icid, iusr, ajaxData, isComment, storagepid);
}
function comments_view_delayed(icid, iusr, ajaxData, isComment, storagepid) {
	dispatchArr[((dispatchArr.length))] = this.toctoc_comments_pi1_base64_encode('data=' + ajaxData + '&pageid=' + pageid + '&usr=' + iusr + '&ref=' + icid + '&cmd=commentsview&storagepid=' + storagepid);
	runDispatch = 1;
	dispatchBase = '&data=' + ajaxData;
}

function dispatchAjax() {
	if (runDispatch ==1) {		
		if (dispatchArr.length > 0) {
			var str1=this.toctoc_comments_pi1_serialize(dispatchArr);
			var str2=this.toctoc_comments_pi1_base64_encode(str1);		
			jQuery.ajax({
				type: 'POST',
				url: 'index.php?eID=toctoc_comments_ajax',
				async: true,
				data: 'ajaxdna=' + ajaxdna + '&cmd=dispatchAjax&pageid=' + pageid + '&dispatchData=' + str2 + dispatchBase,
				success: function(html){
					if (html.length > 1) {
						console.log('dispatchAjax, AJAX returned: ' + html);
					}
		
				}
			});
		}
		runDispatch =0;
		dispatchBase = '';
		dispatchArr = [];		
	}
}

/*
 * BB-Code panel
 */
function selectbb(wx,wy,lformcid) {
	(function($) {
		if (document.getElementById('txtcbbmenu')) {
			if (document.getElementById('txtcbbmenu').style.display === 'block') {
				document.getElementById('txtcbbmenu').style.display = 'none';
				bb_closed=0;
			}
			if (setupbbcid === false) {
					document.getElementById('txtcbbmenu').innerHTML=utf8_decode(tcb64_dec(tcbbcard));
					setupbbcid === true;
			}
	
			$('#txtcbbmenu').css('top', '0');
			$('#txtcbbmenu').css('left', '0');
			
			setTimeout(function() {
//				//var offset = $('#txtcbbmenu').offset().top;
//				var xorigBB = $('#txtcbbmenu').offset().left;
//				//var winscrolled = $(window).scrollTop();
//				//var winheight = $(window).height();
//				
//				var yorigBB = ($('#txtcbbmenu').offset().top)-($(window).scrollTop());
//				console.log('wy: ' + wy + ', -yorigBB: ' + yorigBB + ', -2*boxmodelLineHeight: ' + (-2*boxmodelLineHeight));
	
				var posxy = [];
				posxy=findPos(document.getElementById('txtcbbmenu'));
				var xorigBB=posxy[0];
				var yorigBB=posxy[1];
				$('#txtcbbmenu').css('top', (wy-yorigBB-2*boxmodelLineHeight) +'px');
				$('#txtcbbmenu').css('opacity', '1');
				$('#txtcbbmenu').css('left', (wx-xorigBB-20) +'px');
				$('#txtcbbmenu').css('display', 'block');
				bb_closed=3500/10;
				toctoc_comments_bb_show(10);
				$('.tx-tc-bb-item').off('click');
				$('.tx-tc-bb-item').on( 'click', function() {
					bbclick(this,lformcid);
				});
				$('.tx-tc-bbclose').off('click');
				$('.tx-tc-bbclose').on( 'click', function() {
					toctoc_comments_bb_close();
				});
				$('.tx-tc-ct-fieldset').off('click');
				$('.tx-tc-ct-fieldset').on( 'click', function() {
					toctoc_comments_bb_close();
				});
				
			}, 1);
		}
	})(jQuery);
}
function toctoc_comments_bb_fadeout(timeout) {
	if (bb_closed<3) {
		if (document.getElementById('txtcbbmenu').style.display !== 'none') {
			opanow= getopacity('txtcbbmenu');

			opanew=parseFloat(opanow)-0.1;
			if (opanew >= 0.1) {
				setopacity('txtcbbmenu',opanew,'toctoc_comments_bb_fadeout');
				timeoutID = window.setTimeout("toctoc_comments_bb_fadeout(" + timeout + ")", 50);

			} else {
				document.getElementById('txtcbbmenu').style.display = 'none';
				bb_closed=0;
				return true;
			}

		} else {
			return true;
		}

	} else {
		bb_closed=bb_closed-1;
		timeoutID = window.setTimeout("toctoc_comments_bb_fadeout(" + timeout + ")", timeout);
	}

}
function toctoc_comments_bb_close() {
	jQuery('.tx-tc-ct-fieldset').off('click');
	jQuery('#txtcbbmenu').css('opacity', '0');
	bb_closed=0;
}
function toctoc_comments_bb_show (timeout) {
	timeoutID = window.setTimeout("toctoc_comments_bb_fadeout(" + timeout + ")", timeout);
	return true;
}
function insertbb(actionbb,lformcid) {
	var bbstart = '';
	var bbend = '';
	if (actionbb !== 'del'){
		// insert bb
		bbstart = '[' + actionbb +']';
		bbend = '[/' + actionbb +']';

	}

	//9736g94886g9 case
	var topcid = '';
	var cidtestarr = String(lformcid).split("6g9");
	if (cidtestarr.length === 3) {
			topcid=cidtestarr[1];
	}

	var taelem=document.getElementById(tctnme + lformcid);
	var taid=tctnme + lformcid;

	//tx-tc-ct-ry-rl-492
	var taelemtest=document.getElementById('tx-tc-ct-ry-rl-'+topcid);
	var forcecommenteditbox=0;
	if(taelemtest) {
		//chnginl
		if ((taelemtest.style.display === 'none') || (jQuery('#' + taelemtest.id).hasClass('tx-tc-nodisp'))) {
			forcecommenteditbox=1;
		}

	}

	if ((!taelem) || (forcecommenteditbox === 1)) {
		taelem=document.getElementById('toctoc_comments_pi1_contenttextboxc_' + lformcid);
		taid='toctoc_comments_pi1_contenttextboxc_' + lformcid;
	}

	if (taelem) {
		taelem.focus();
		var bbedtext=taelem.value.substr(this.caretposstart, (this.caretposend-this.caretposstart));
		var testbbstart = taelem.value.substr((this.caretposstart-bbstart.length),bbstart.length);
		var testbbend = taelem.value.substr((this.caretposend),bbend.length);
		var newvalue= '';

		if (actionbb === 'del') {
			newvalue= taelem.value.substr(0,this.caretposstart) + taelem.value.substr(this.caretposend);
			replacedlen=0;
			if ((getInternetExplorerVersion()>0)) {
				if (taelem.value === '') {
					timeoutID = window.setTimeout("set_bb_delayed('"+taid+"', '"+newvalue+"', '"+replacedlen+"')", 600);
					return;
				}

			}

			taelem.value = newvalue;
		} else {
			bbedtextstarr = bbedtext.split('[');
			bbedtextetarr = bbedtext.split(']');
			var testbbtext = '';
			var startkorr=0;
			var bbedtextpos=0;
			if ((bbedtextstarr.length>1)) {
				for (i=0 ; i < bbedtextstarr.length-1 ; i++) {
					if (bbedtextstarr[i].length > testbbtext) {
						testbbtext =bbedtextstarr[i];
						bbedtextpos = bbedtextstarr[i].lastIndexOf(']');
						if (bbedtextpos>0) {
							testbbtext =bbedtextstarr[i].substr(bbedtextpos);
							startkorr=startkorr+bbedtextpos+1;
						}

					} else {
						startkorr=startkorr+1+bbedtextstarr[i].length;
					}

				}
			}
			var testbbtextet = '';
			var startkorret=0;
			if ((bbedtextetarr.length>1)) {
				for (i=0 ; i < bbedtextetarr.length-1 ; i++) {
					if (bbedtextetarr[i].length > testbbtextet) {
						testbbtextet =bbedtextetarr[i];
						bbedtextpos = bbedtextetarr[i].lastIndexOf('[');
						if (bbedtextpos>0) {
							testbbtextet =bbedtextetarr[i].substr(bbedtextpos);
							startkorret=startkorret+bbedtextpos+1;
						}

					} else {
						startkorret=startkorret+1+bbedtextetarr[i].length;
					}

				}
			}

			if (testbbtextet.length > testbbtext.length) {
				startkorr=startkorret;
				testbbtext=testbbtextet;
			}

			if (testbbtext !== '') {
				this.caretposstart = this.caretposstart+startkorr;
				this.caretposend =this.caretposstart+testbbtext.length;
				bbedtext=testbbtext;
			}

			if ((testbbstart==bbstart) &&(testbbend==bbend)) {
				//remove them
				newvalue= taelem.value.substr(0,(this.caretposstart-bbstart.length)) + bbedtext + taelem.value.substr(this.caretposend+bbend.length);
			} else {
				newvalue= taelem.value.substr(0,this.caretposstart) + bbstart + bbedtext + bbend + taelem.value.substr(this.caretposend);
			}

			replacedlen=(bbstart).length;
			if ((getInternetExplorerVersion()>0)) {
				if (taelem.value === '') {
					timeoutID = window.setTimeout("set_bb_delayed('"+taid+"', '"+newvalue+"', '"+replacedlen+"')", 600);
					return;
				}

			}

			taelem.value = newvalue;
		}

		this.caretposstart=parseInt(this.caretposstart+replacedlen);
		this.caretposend=this.caretposstart;
		setCursorPos(taelem, this.caretposstart, this.caretposend);
		toctoc_comments_bb_close();
	}

}

function set_bb_delayed(taelemstr,tavalue,replacedlen) {
	taelem=document.getElementById(taelemstr);
	taelem.value = tavalue;
	this.caretposstart=parseInt(this.caretposstart)+parseInt(replacedlen);
	this.caretposend=this.caretposstart;
	setCursorPos(taelem, this.caretposstart, this.caretposend);
}

/*
 * File upload
 */

function remove_fup_pic(id,previewopenedprogress,fuppreviewheight,ajaxData,ajaxDataAtt) {
	var ininputpicid='toctoc_comments_pi1_' + id + 'uploadpicid';
	var ininputpicidh='toctoc_comments_pi1_' + id + 'uploadpicheight';
	var ininputpicname='toctoc_comments_pi1_' + id + 'originalfilename';
	var inupldiv='tx-tc-' + id + 'uploaddiv';
	var lineheightupload=8;
	var tmpthumbheight=fuppreviewheight;
	// send to server the cid and clean up temp
	var previewarr = [];
	previewarr['cid']=id;
	str1=this.toctoc_comments_pi1_serialize(previewarr);
	ajaxpreviewopenurl=this.toctoc_comments_pi1_base64_encode(str1);
	var ininputpicidvalelem = document.getElementById(ininputpicid);
	var ininputpicidvalelemh = document.getElementById(ininputpicidh);
	var ininputpicnameelem = document.getElementById(ininputpicname);
	var str2=this.toctoc_comments_pi1_base64_encode(ininputpicnameelem.value);
	var originalfilename = str2;
	jQuery.ajax({
		type: 'POST',
		url: 'index.php?eID=toctoc_comments_ajax',
		async: true,
		data: 'ajaxdna=' + ajaxdna + '&ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=cleanupfup' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=' + ininputpicidvalelem.value + '&originalfilename=' + originalfilename,
		success: function(html){
		}
	});
	document.getElementById('tx-tc-cts-previewfup-' + id).src='';
	jQuery('#' + inupldiv).css('display', 'block');
	document.getElementById('formhider-' + id).style.height = String(parseInt(document.getElementById('formhider-' + id).offsetHeight)-(parseInt(tmpthumbheight)+parseInt(lineheightupload))) + 'px';
	jQuery('#tx-tc-form-dp-fup-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-nopreviewfup-' + id).css('display', 'none');
	jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', '0px');
	jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', '0px');
	jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('display', 'none');
	jQuery('#tx-tc-cts-fuppicprv-' + id).css('display', 'none');
	jQuery('#tx-tc-cts-fupta-' + id).css('display', 'none');

	ininputpicidvalelem.value='';
	ininputpicidvalelemh.value='0';
	ininputpicnameelem.value='';
	previewstartedfp[id] = 0;
	previewfpheight[id] = 0;
	return true;
}

/*
 * Emojis
 */
function emoselpage (idshow,idhide) {
	(function($) {
		$('#tx-tc-emopage-' + idhide).addClass('tx-tc-nodisp');
		$('#tx-tc-emopage-' + idhide).removeClass('tx-tc-blockdisp');
		$('#tx-tc-emopage-' + idshow).addClass('tx-tc-blockdisp');
		$('#tx-tc-emopage-' + idshow).removeClass('tx-tc-nodisp');
	})(jQuery);
}

function insertemoji(emojiid) {
	if (emojiid.substr(0,1) === 'u') {
		//emojicode
		emojiid=emojiid.replace(/-/g,'%');
		emojiid = '%' + emojiid;
		tmpcontent =  unescape(emojiid);
		if (tmpcontent.substr(0,2) === '%u') {
			tmpcontent = tmpcontent.substr(2);
  		}
		emojiid=tmpcontent;
	} else {
		if (emojiid.substr(0,2) === '-u') {
			//emojicode
			emojiid=emojiid.replace('-u','%u');
			tmpcontent =  unescape(emojiid);
			emojiid=tmpcontent;
		} else {
			emojiid=emojiid+' ';
		}
	}
	//9736g94886g9 case
	var topcid = '';
	var cidtestarr = String(lastemojicid).split("6g9");
	if (cidtestarr.length === 3) {
			topcid=cidtestarr[1];
	}

	var taelem=document.getElementById(tctnme + lastemojicid);
	var taid=tctnme + lastemojicid;

	//tx-tc-ct-ry-rl-492
	var taelemtest=document.getElementById('tx-tc-ct-ry-rl-'+topcid);
	var forcecommenteditbox=0;
	if(taelemtest) {
		if ((taelemtest.style.display === 'none') || (jQuery('tx-tc-ct-ry-rl-'+topcid).hasClass('tx-tc-nodisp'))) {
			//chnginl
			forcecommenteditbox=1;
		}
	}
	if ((!taelem) || (forcecommenteditbox === 1)) {
		taelem=document.getElementById('toctoc_comments_pi1_contenttextboxc_' + topcid);
		taid='toctoc_comments_pi1_contenttextboxc_' + topcid;
	}
	if (taelem) {
		taelem.focus();
		var newvalue= taelem.value.substr(0,this.caretposstart) + emojiid + taelem.value.substr(this.caretposend) ;
		replacedlen=emojiid.length;
		if ((getInternetExplorerVersion()>0)) {
			if (taelem.value === '') {
				timeoutID = window.setTimeout("set_emoji_delayed('"+taid+"', '"+newvalue+"')", 600);
				return;
			}
		}
		taelem.value = newvalue;
		this.caretposstart=parseInt(this.caretposstart)+parseInt(emojiid.length);
		this.caretposend=this.caretposstart;
		setCursorPos(taelem, this.caretposstart, this.caretposend);

	}
}
function set_emoji_delayed(taelemstr,tavalue) {
	taelem=document.getElementById(taelemstr);
	taelem.value = tavalue;
	this.caretposstart=parseInt(this.caretposstart)+parseInt(replacedlen);
	this.caretposend=this.caretposstart;
	setCursorPos(taelem, this.caretposstart, this.caretposend);
}

/*
 * Login/Logout
 */
function tt_showlogin(idtoshowlogin, onoff) {

	if (tclogincarddec !=='') {
		htmlloginform=tclogincarddec;
	} else {
		if (tclogincard !=='') {
			htmlloginform=utf8_decode(tcb64_dec(tclogincard));
		} else {
			if (loginRequiredIdLoginForm === '') {
				alert ("You need to define TS-Option advanced.loginRequiredIdLoginForm");
			}

		}

	}

	taelemshw=document.getElementById('formhiderinside-'+idtoshowlogin);
	taelemhdr=document.getElementById('formhider-'+idtoshowlogin);
	if (taelemshw) {
		if (onoff === 0) {
			taelemhdr.innerHTML='';
			taelemshw.style.display="none";
		} else {
			taelemhdr.innerHTML=htmlloginform;
			taelemshw.style.display = "table";
			taelemshw.style.width = "100%";
			savedpwarr=htmlloginform.split('<div class="tx-tc-loginform tx-tc-nodisp" id="tx-tc-loginformfp">');
			savedpwfrgthtml= '<div class="tx-tc-loginform tx-tc-nodisp" id="tx-tc-loginformfp">'+savedpwarr[1];
			savedpwfrgthtml = savedpwfrgthtml.replace('class="tx-tc-status-for-felogin"', 'class="tx-tc-status-for-felogin tx-tc-blockdisp"');
			savedpwfrgthtml = savedpwfrgthtml.replace('<div class="tx-tc-loginform tx-tc-nodisp" id="tx-tc-loginformfp">', '');
			// loginform
			tt_showloginbind();
		}

	}

}
function tt_showloginbind() {
	(function($) {
		$('.tx-tc-login-submitli').on('click', function() {
			ttc_ajaxfelogin(this);
		});
		$('#tx_toctoccomments_pi2_form').on('submit', false );

		$('.tx-tc-login-submitlo').on('click', function() {
			ttc_ajaxfelogin(this,1);
		});
		$('#tx_toctoccomments_pi2_formlo').on('submit', false );

		$('.tx-tc-login-submitfo').on('click', function() {
			ttc_ajaxfeforgotpw(this);
		});
		$('#u_0_0').on('click', function() {
			fbLogin();
		});
		
		$('#signinButton').on('click', function() {
			googleclicked = 1;
			//googleLogin();
		});
		
		setTimeout(function() {
			if (document.getElementById('signinButton')) {
		
				$.getScript('https://apis.google.com/js/client:platform.js', function() {
					
				});
			}
		}, 500);	
		
		$('#tx_toctoccomments_pi2_formfo').on('submit', false );

		$('.tx-tc-login-submitsu').on('click', function() {
			ttc_ajaxfesignup(this);
		});
        
		$('#tx_toctoccomments_pi2_formso').on('submit', false );

		$('.tx-tc-forgotpw').on( 'click', function() {
			$('#tx-tc-loginformfp').removeClass('tx-tc-nodisp');
			$('#tx-tc-loginformfp').addClass('tx-tc-blockdisp');
			$('#tx_toctoccomments_pi2_form').addClass('tx-tc-nodisp');
			$('#tx_toctoccomments_pi2_form').removeClass('tx-tc-blockdisp');
			$('#tx-tc-buttonfornewaccount').addClass('tx-tc-nodisp');
			$('#tx-tc-buttonfornewaccount').removeClass('tx-tc-blockdisp');
			$('#tx-tc-status-for-felogin').addClass('tx-tc-nodisp');
			$('#tx-tc-status-for-felogin').removeClass('tx-tc-blockdisp');
		});
		$('.tx-tc-loginbacklink').on( 'click', function() {
			$('#tx-tc-status-for-felogin').removeClass('tx-tc-nodisp');
			$('#tx-tc-status-for-felogin').addClass('tx-tc-blockdisp');
			$('#tx_toctoccomments_pi2_form').removeClass('tx-tc-nodisp');
			$('#tx_toctoccomments_pi2_form').addClass('tx-tc-blockdisp');
			$('#tx-tc-buttonfornewaccount').removeClass('tx-tc-nodisp');
			$('#tx-tc-buttonfornewaccount').addClass('tx-tc-blockdisp');
			$('#tx-tc-loginformfp').addClass('tx-tc-nodisp');
			$('#tx-tc-loginformfp').removeClass('tx-tc-blockdisp');
		});
		$('#tx-tc-buttonfornewaccount-bt').on( 'click', function() {

			$('#tx-tc-buttonfornewaccount').addClass('tx-tc-nodisp');
			$('#tx-tc-buttonfornewaccount').removeClass('tx-tc-blockdisp');
			$('#tx-tc-loginformso').removeClass('tx-tc-nodisp');
			$('#tx-tc-loginformso').addClass('tx-tc-blockdisp');
			$('#tx-tc-forgotpw').addClass('tx-tc-nodisp');
			$('#tx-tc-forgotpw').removeClass('tx-tc-blockdisp');
		});
		$('#tx-tc-signonlink').on( 'click', function() {
			$('#tx-tc-loginformso').addClass('tx-tc-nodisp');
			$('#tx-tc-loginformso').removeClass('tx-tc-blockdisp');
			$('#tx-tc-buttonfornewaccount').removeClass('tx-tc-nodisp');
			$('#tx-tc-buttonfornewaccount').addClass('tx-tc-blockdisp');
			$('#tx-tc-forgotpw').addClass('tx-tc-blockdisp');
			$('#tx-tc-forgotpw').removeClass('tx-tc-nodisp');

		});
	})(jQuery);
}