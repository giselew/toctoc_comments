var tctreestate= new Array();
var tcelemstate= new Array();
var editsavehtml = '';
var edithtml = '';
var editsavebthtml = '';
var editon = false;
var previewon = false;
var editsavenamehtml= '';
var messageon = false;
var submitopaccontrol = 2;
var logomargin = '';
var global_loggedon = 0;

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

	    if (h3 == 64) {
	      tmp_arr[ac++] = String.fromCharCode(o1);
	    } else if (h4 == 64) {
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
	    if (data.indexOf('>') == -1) {
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

	  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}

function utf8_encode (argString) {
    if (argString === null || typeof argString === "undefined") {
        return "";
    }
     var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
    var utftext = "",
        start, end, stringl = 0;
 
    start = end = 0;    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;
         if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.slice(start, end);            }
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
        if (type === "object") {            if (!inp.constructor) {
                return 'object';
            }
            var cons = inp.constructor.toString();
            match = cons.match(/(\w+)\(/);            if (match) {
                cons = match[1].toLowerCase();
            }
            var types = ["boolean", "number", "string", "array"];
            for (key in types) {                if (cons == types[key]) {
                    type = types[key];
                    break;
                }
            }        }
        return type;
    };
    var type = _getType(mixed_value);
    var val, ktype = ''; 
    switch (type) {
    case "function":
        val = "";
        break;    case "boolean":
        val = "b:" + (mixed_value ? "1" : "0");
        break;
    case "number":
        val = (Math.round(mixed_value) == mixed_value ? "i" : "d") + ":" + mixed_value;        break;
    case "string":
        val = "s:" + _utf8Size(mixed_value) + ":\"" + mixed_value + "\"";
        break;
    case "array":    case "object":
        val = "a";

        var count = 0;
        var vals = "";
        var okey;        var key;
        for (key in mixed_value) {
            if (mixed_value.hasOwnProperty(key)) {
                ktype = _getType(mixed_value[key]);
                if (ktype === "function") {                    continue;
                }
 
                okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
                vals += this.toctoc_comments_pi1_serialize(okey) + this.toctoc_comments_pi1_serialize(mixed_value[key]);                count++;
            }
        }
        val += ":" + count + ":{" + vals + "}";
        break;    case "undefined":
        // Fall-through
    default:
        // if the JS object has a property which contains a null value, the string cannot be unserialized by PHP
        val = "N";        break;
    }
    if (type !== "object" && type !== "array") {
        val += ";";
    }    return val;
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
function toctoc_comments_pi1_readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(nameEQ) == 0) {
            return unescape(c.substring(nameEQ.length,c.length)).replace(/\+/, ' ');
        }
    }
    return false;
}
function toctoc_comments_pi1_setUserDataField(name,icid) {
    var    field = document.getElementById('toctoc_comments_pi1_' + icid + name);
    try {
        if (field && field.value != '') {
            value = field.value;
            field.value = value;
        }
        if (field && field.value == '') {
            var    value = toctoc_comments_pi1_readCookie('toctoc_comments_pi1_' + name);
            if (typeof value == 'string') {
                value = utf8_decode(value);
                field.value = value;
                if ((name== 'gender')) {
            		changeavatar(value, icid);
                }
            } 
        }
    }
    catch (e) {
    }
}
function toctoc_comments_pi1_setUserData(icid) {
    toctoc_comments_pi1_setUserDataField('firstname',icid);
    toctoc_comments_pi1_setUserDataField('lastname',icid);
    toctoc_comments_pi1_setUserDataField('location',icid);
    toctoc_comments_pi1_setUserDataField('email',icid);
    toctoc_comments_pi1_setUserDataField('homepage',icid);
    toctoc_comments_pi1_setUserDataField('gender',icid);
}
function toctoc_comments_pi1_getUserDataField(name,icid) {
    var field = document.getElementById('toctoc_comments_pi1_' + icid + name);
    var value = 0;
    if (name == 'notify') {
        value = 0;
        if (field) {
            if (field.checked==true) {
                value = 1;
            }
        }
        return value;
    } 
    else {
        if (field && field.value != '') {
            value = field.value;
            return value;
        }
        else
        {
            return '';
        }        
    }
}
function dbize_emojis (commentcontent){
	var reresultucdo = /(%u)+/g;
    var resultucd =  escape(commentcontent);
	if (typeof emotjicodes != 'undefined') {
		for (var i = 0; i < emotjicodes.length; i++) {
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
function toctoc_comments_pi1_getUserData(icid) {
    var toctoc_piVars = new Array();
    toctoc_piVars['firstname'] = toctoc_comments_pi1_getUserDataField('firstname',icid);
    toctoc_piVars['lastname'] = toctoc_comments_pi1_getUserDataField('lastname',icid);
    toctoc_piVars['location'] = toctoc_comments_pi1_getUserDataField('location',icid);
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
    toctoc_piVars['previewselpic'] = window['previewselpic' + icid];
    toctoc_piVars['commentparentid'] =  toctoc_comments_pi1_getUserDataField('commentparentid',icid);
    if (String(toctoc_piVars['commentparentid']) == '0') {
    	 toctoc_piVars['commentparentid'] = window['previewselcomment' + icid];
    }
   
    toctoc_piVars['previewselpreviewid'] = window['previewselpreviewid' + icid];
    
    var field = document.getElementById('toctoc_comments_pi1_submit_' + icid);
    toctoc_piVars['submit'] = field.value;    
    field = document.getElementById('toctoc_comments_pi1_contenttextbox_' + icid);
    var tmpcontent=field.value;
    tmpcontent=tmpcontent.replace(/\t/g,'');
    
    tmpcontent= tmpcontent.split('>').join('&gt;');
    tmpcontent= tmpcontent.split('<').join('&lt;');
    tmpcontent=tctrim(tmpcontent);
    
    tmpcontent=dbize_emojis(tmpcontent);
    
      
    toctoc_piVars['content'] = this.toctoc_comments_pi1_base64_encode(tmpcontent);
   
    var    fieldupl = document.getElementById('toctoc_comments_pi1_uplcontenttextbox_' + icid);
    if (fieldupl) {
    	tmpcontent=fieldupl.value;
    	tmpcontent=tmpcontent.replace(/\t/g,'');
        tmpcontent= tmpcontent.split('>').join('&gt;');
        tmpcontent= tmpcontent.split('<').join('&lt;');
    	tmpcontent=tctrim(tmpcontent);
    	toctoc_piVars['descriptionbyuser'] = tmpcontent;
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
function pushmain(IpushmainH,makewindowresize) {
	//placeholder function for resize of dependent controlls
	//IpushmainH :  offsetHeift-Difference as px
	if (makewindowresize==1) {
	}
}
function getInternetExplorerVersion() {

    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}
function tttip(styletip, elementid) {

	if (styletip=='hide') {
		jQuery('.tooltip').hide();
	} else 	if (styletip=='hide2') {
		jQuery('.tooltip2').hide();
	} else if  (styletip=='t101') {
		jQuery("" + elementid + "").tooltip({position: 'top center', offset: [-1,0],effect: 'fade',opacity: 1, tipClass: 'tooltip'});
	} else if  (styletip=='t201') {
		jQuery("" + elementid + "").tooltip({position: 'top right', offset: [-1,0],effect: 'fade',opacity: 1, tipClass: 'tooltip2'});
	} else if  (styletip=='t10-12') {
		jQuery("" + elementid + "").tooltip({offset: [-12, 0],effect: 'fade',opacity: 1}); 
	} else if  (styletip=='t10-16') {
		jQuery("" + elementid + "").tooltip({offset: [-1, -16],effect: 'fade',opacity: 1}); 
	} else if  (styletip=='t10-18') {
		jQuery("" + elementid + "").tooltip({offset: [-1, -18],effect: 'fade',opacity: 1}); 
	} else if  (styletip=='t201-5') {
		jQuery("" + elementid + "").tooltip({position: "top right", offset: [5,-5],effect: 'fade', opacity: 1, tipClass: 'tooltip2'});
	} else if  (styletip=='temo') {
		jQuery("" + elementid + "").tooltip({offset: [-1,0],effect: 'fade',opacity: 1, tipClass: 'tooltipemoji'});
	} else if (styletip=='t201-65') {
		jQuery("" + elementid + "").tooltip({position: "top right", offset: [-1,-65],effect: 'fade',opacity: 1, tipClass: 'tooltip2'});
	} else if (styletip=='t201-20') {
		jQuery("" + elementid + "").tooltip({offset: [2, 0],opacity: 1, tipClass: 'tooltip2' }).dynamic({ bottom: { direction: 'down', bounce: true} });
		
	}
}

function comment_formhider(cidcomments, showhider, textaddcomment, loggedon, makewindowresize , thisin) {
    // optional: textaddcomment: ###TEXT_ADD_COMMENT###
    // loggedon, makewindowresize: 1/0
	var tamargin = '0';
	var submitmargin='4px 0 5px ' + boxmodelLabelWidth + 'px';
	var tainitmargin = '0';
	var hidermargin= '0';
	var userpicmargin= '4px 0 0';
	var newmargin='0px';
	  if (loggedon==1){
	        hidermargin = '5px 0 5px';
	        if ((getInternetExplorerVersion()>8)) {
	            tamargin = '0 0 0 8px';
	            submitmargin='-2px 0 3px 8px';
	        } else {
	            tamargin = '0 0 0 9px';
	            submitmargin='-2px 0 3px 9px';
	        }
	    }  
	   
	var cidtestval=String(cidcomments).indexOf("6g9");
	if (cidtestval>0){
		userpicmargin='8px 0 0 4px';
		var elemcap=document.getElementById('toctoc_comments_cap_' + cidcomments);
		if (elemcap){
			newmargin='8px 0 0';
		}
	}
	
		
    if (showhider==1) {
        thisin.focus();
    }
    else 
    {
    	var thishider = document.getElementById('formhider-' + cidcomments);
    	var thisuserimg = document.getElementById('tx-tc-uimg-' + cidcomments);
    	var thistextarea =document.getElementById('textarea-' + cidcomments);
    	var thissubmit =document.getElementById('toctoc_comments_pi1_submit_' + cidcomments);
    	var thissubmitdiv =document.getElementById('tx-tc-div-submit' + cidcomments);
    	var thisformsqueezer =document.getElementById('tx-tc-formsqueezer-' + cidcomments);
    	var pushmainH=0;
    }
    if (showhider==2) {
        //onblur
            var thiscontenttextbox = document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments);
            var hidertopmargin= eval(0-80-confuserpicsize);
            thistextarea.style.margin = tainitmargin;
            
            if (thiscontenttextbox) {
                var checklen = this.tctrim(textaddcomment).length;
                var checkfield = this.tctrim(thiscontenttextbox.value);
                var checkfield2 = checkfield.substr(0,checklen);                
                if ((checkfield2 == this.tctrim(textaddcomment)) || (checkfield=='')) {
                    //addon to elastic.js
                	thiscontenttextbox.style.height = boxmodelTextareaHeight + 'px';
                }
            }
            thissubmit.style.display = 'none';
            thissubmitdiv.style.display = 'none';
            thissubmit.style.height = 0; 
            thissubmit.style.margin = 0;
            
            pushmainH = eval(-1 * thishider.offsetHeight);
            thishider.style.display = 'none';    
            thishider.style.height = 0;
            thishider.style.minHeight = 0;
            thishider.style.margin = hidertopmargin + "px 0 0";
            
            thisformsqueezer.style.height = confuserpicsize + 'px';
            thisformsqueezer.style.height = boxmodelTextareaAreaTotalHeight + 'px';

            if (loggedon==1){
                thisuserimg.style.display = 'none';
                thisuserimg.style.margin='-' +confuserpicsize+'px 0 0';
                thishider.style.margin ='-' +confuserpicsize+'px 0 0';
            }            
            
            if (cidtestval>0){
            }
        	if (toctoc_comments_fadeout('tx-tc-cts-prv-ct-' + cidcomments) == true) {
    		}
        	//reset_previewvars (cidcomments);
            pushmain(pushmainH,makewindowresize);
    };
    if (showhider==3) {
    //onFocus
            thistextarea.style.margin = tamargin;
       	 	window['previewselcomment' + cidcomments] = 0;

            thissubmit.style.display = 'block';
            thissubmitdiv.style.display = 'block';

            thissubmit.style.height = 'auto'; 
            thissubmit.style.margin = submitmargin;
            
            thishider.style.height = '';    
            thishider.style.minHeight = '';    
            thishider.style.margin =hidermargin;
            thishider.style.display = 'block';
            thishider.style.height = thishider.offsetHeight + "px";
    
            thisformsqueezer.style.height = '';
            
            var minheight=thistextarea.style.minHeight;
            var minheightval=minheight.substr(0,minheight.indexOf("p"));
            var taoffsetheight=thistextarea.offsetHeight
            var deltah=0;
            var oldmargin='';
            var oldmarginval=0;
            var oldmarginval=0;
            
            var newmarginval=0;
            if (minheightval<taoffsetheight){
                deltah=eval(taoffsetheight-minheightval);
                oldmargin = thishider.style.margin;
                if (oldmargin.length==1)
                {
                    newmarginval=deltah;
                }
                else
                {
                    oldmarginval=oldmargin.substr(0,oldmargin.indexOf("p"));
                    newmarginval=eval(eval(oldmarginval)+deltah);
                }
                
                thishider.style.margin = newmargin;
            }
            
            if (loggedon==1){
                thisuserimg.style.display= 'block';
                thisuserimg.style.margin=userpicmargin;
            }  
            jQuery( '#formhider-' + cidcomments).hide();
            
            pushmain(eval(thishider.offsetHeight),makewindowresize);

            jQuery( '#formhider-' + cidcomments).slideDown();
            var thiscontenttextbox = document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments);
            if (thiscontenttextbox.value=='') {
	            elemcap=document.getElementById('tx-tc-div-submit' + cidcomments);
	    		if (elemcap.style.opacity!='0.5'){
	    			jQuery( '#tx-tc-div-submit' + cidcomments).css('opacity', '0.6');
	    		}
	            
	            jQuery( '#formhider-' + cidcomments).css('opacity', '0.6');
	            elemcap=document.getElementById('tx-tc-div-submit' + cidcomments);
	    		if (elemcap){
	    			elemcap.disabled = true;
	    		}
	    		elemcap=document.getElementById('tx-tc-' + cidcomments + 'uploaddiv');
	    		if (elemcap){
	    			elemcap.style.visibility='hidden';
	    		}
	    		global_loggedon=loggedon;
	            if (loggedon!=1){
	            	
	            	elemcap=document.getElementById('toctoc_comments_pi1_' + cidcomments + 'firstname');
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
	        		elemcap=document.getElementById('tx-tc-ct-form-gender' + cidcomments);
	        		if (elemcap){
	        			elemcap.style.visibility='hidden';
	        		}
	        		
	        		
	            }
	            if (confuseEmoji>0) {
	            	tttip('t101','#tx-tc-smilie-icon-' + cidcomments + '[title]');
	            }
	            tttip('t101','#tx-tc-uimg-' + cidcomments + '[title]');
	            tttip('t201','#tx-tc-' + cidcomments + 'uploaddiv img[title]');
	            tttip('t101','#toctoc_comments_pi1_' + cidcomments + 'notify[title]');
            }
            
    };
  
}
function commentform_validate(cidcomments, cidnropt) {
	var textemptyerror=utf8_decode(tcb64_dec(textErrCommentNull));
	var requiredcommentlength=errCommentRequiredLength;
	var texttoshorterror=utf8_decode(tcb64_dec(textErrCommentLength));
	if (!tcisInt(cidcomments)) {
		var strelemid=cidcomments;
		cidcomments=cidnropt;
		
	} else {
		var strelemid='toctoc_comments_pi1_contenttextbox_' + cidcomments;
	}
	var cidtest = '';
	cidtest =cidcomments;
	var cidtestarr = String(strelemid).split("6g9");
	if (cidtestarr.length==3) {
		cidcomments=cidtestarr[0].replace('toctoc_comments_pi1_contenttextbox_','');
	}
	
    if (document.getElementById(strelemid).value == "") {
    	information(textemptyerror,cidcomments, function () {});
        document.getElementById(strelemid).focus();
        return false;
    } 
    var lenvalue = document.getElementById(strelemid).value.length;
    if (lenvalue < requiredcommentlength)
    {
        information(texttoshorterror,cidcomments, function () {});
        document.getElementById(strelemid).focus();
        return false;
    } 
    return true;
}
var uploadtype='pic';
function tcOpenFile(uploadinputid,iuploadtype)
{
	uploadtype=iuploadtype;
	document.getElementById(uploadinputid).click();
	
}
function tcisInt(value) { 
    return !isNaN(parseInt(value)) && (parseFloat(value) == parseInt(value)); 
}
function tctrim(s)
{
    var l=0; var r=s.length -1;
    while(l < s.length && s[l] == ' ')
    {    l++; }
    while(r > l && s[r] == ' ')
    {    r-=1;    }
    return s.substring(l, r+1);
}
function tcdelinefeed(s)
{
	return s.replace(/(\r\n|\n|\r)/gm,"");
}
function toctoc_comments_fadein (docelem) {
	var opanow=0;
	opanow= getopacity(docelem);
    var opanew=0;
    opanew = eval(opanow - - 0.1);
    if (eval(opanew) <= 0.95) {
    	setopacity(docelem,opanew,'toctoc_comments_fadein');
        window.setTimeout("toctoc_comments_fadein('" + docelem + "')", 50);
        
    } else {
    	setopacity(docelem,1,'toctoc_comments_fadein');
        return true;
    }
}
function toctoc_comments_fadeout (docelem) {
	var opanow=1;
	var elemdocelem = document.getElementById(docelem);
	if (elemdocelem) {
		opanow=elemdocelem.style.opacity;
	    var opanew=0;
	    opanew = eval(opanow - 0.1);
	    if (eval(opanew) >= 0.1) {
	    	setopacity(docelem,opanew,'toctoc_comments_fadeout');
	        window.setTimeout("toctoc_comments_fadeout('" + docelem + "')", 50);
	        
	    } else {
	    	document.getElementById(docelem).style.display= 'none';
	        return true;
	    }
	} else {
		return true;
	}
}
var uc_closed = new Array();
function toctoc_comments_uc_fadeout (cssid, commentid,timeout) {
	if (uc_closed[commentid]<3) {
		if (document.getElementById(cssid).style.display != 'none') {
			opanow= getopacity(cssid);
		    
		    opanew=eval(opanow-0.1);
		    if (opanew >= 0.1) {
		    	setopacity(cssid,opanew,'toctoc_comments_uc_fadeout');
		        window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "', '" + commentid + "', '" + timeout + "')", 50);
		        
		    } else {
		    	document.getElementById(cssid).style.display = 'none';
			    document.getElementById(cssid).style.height = '0px';
			    uc_closed[commentid]=0;
		        return true;
		    }
		} else {
	        return true;
	    }
    } else if (uc_closed[commentid]==10)  {
    	uc_closed[commentid]=2;
    	window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "', '" + commentid + "', '" + timeout + "')", timeout);
        
    }
}
function toctoc_comments_uc_close(commentid){
	setopacity('tx-tc-cts-uc-' + commentid,0,'toctoc_comments_uc_close');
	document.getElementById('tx-tc-cts-uc-' + commentid).style.display= 'none';
	document.getElementById('tx-tc-cts-uc-' + commentid).style.height = '0px';
	uc_closed[commentid]=20;
}
function toctoc_comments_ftm_close(cid){
	setopacity('tx-tc-cts-ftm-' + cid,0,'toctoc_comments_ftm_close');
	document.getElementById('tx-tc-cts-ftm-' + cid).style.display= 'none';
	document.getElementById('tx-tc-cts-ftm-' + cid).style.height = '0px';

}
function toctoc_comments_uc_show (timeout, cssid, commentid) {
    window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "', '" + commentid + "', '" + timeout + "')", timeout);
    return true;
}

function show_uc(commentid, cid, commentsAjaxData,toctocuid,imgstr,timeoutms) {    
 	if (uc_closed[commentid]==20) {
		uc_closed[commentid]=10;
	} else {
		uc_closed[commentid]=1;
	}
 	
    setopacity('tx-tc-cts-uc-' + commentid,'0.9','show_uc');
    jQuery('.tx-tc-ct-box-ctclose').css('visibility', 'hidden');
    jQuery('#tx-tc-cts-uc-' + commentid).css('height', '60px');
    jQuery('#tx-tc-cts-uc-' + commentid).css('display', 'block');
    if (document.getElementById('tx-tc-cts-uc-inner-' + commentid).innerHTML.length < 50) {
    	
        document.getElementById('tx-tc-cts-uc-inner-' + commentid).innerHTML='<p><b>'+ utf8_decode(tcb64_dec(textLoading)) + '</b></p>';
        jQuery.ajax({
            type: 'POST',
            url: 'index.php',
            async: false,
            data: 'eID=toctoc_comments_ajax&cmd=getuc&imagetag=' + imgstr + '&toctocuserid=' + toctocuid + '&data=' + commentsAjaxData + '&cid=' + cid + '&commentid=' + commentid,
            success: function(html){
                var htmlpicarr = String(html).split('typo3temp');
            	var htmlpicarr2 = String(htmlpicarr[1]).split('\"');
            	var piclink = 'typo3temp' + htmlpicarr2[0];
                jQuery('#tx-tc-cts-uc-inner-' + commentid).html(html);  

              	if (document.getElementById('tx-tc-cts-uc-pic2-' + commentid).innerHTML=='***') {
              		document.getElementById('tx-tc-cts-uc-pic2-' + commentid).innerHTML='';
                	jQuery('#tx-tc-cts-uc-pic2-' + commentid).css('display', 'block');
                	jQuery('#tx-tc-cts-uc-pic2-' + commentid).css('width', '364px');
                	jQuery('#tx-tc-cts-uc-pic2-' + commentid).css('background', 'url(\'' + piclink + '\') repeat scroll center center transparent');
                }  
              	tttip('t10-12','.tx-tc-ct-uc-pic img[title]');
              	tttip('t101',"#tx-tc-cts-uc-inner-" + commentid + " img[title]");
                tttip('t10-16',"#tx-tc-cts-uc-" + commentid + " input[title]");
            }
        });
    } 
    
    setopacity('tx-tc-cts-uc-' + commentid,'1','show_uc');
    jQuery('#tx-tc-cts-uc-' + commentid).css('display', 'block');
    jQuery('#tx-tc-cts-uc-' + commentid).css('height', 'auto');
    jQuery('.tx-tc-ct-box-ctclose').css('visibility', 'visible');
    toctoc_comments_uc_show(timeoutms, 'tx-tc-cts-uc-' + commentid, commentid);
 }

function toctoc_comments_delete(id, rating, ajaxData, check, action, cssident, datac, thisdata, commentid, cid, parentid,commentsImgs,refshow, extid) {
	var str1=this.toctoc_comments_pi1_serialize(tctreestate);
    var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);
    var txtDeleteConfirm=utf8_decode(tcb64_dec(textDeleteConfirm));
    var cannotdelete=0;
    var delok=0;
    var extidroot= extid;
    var cidtestarr = String(extid).split("6g9");
	if (cidtestarr.length==3) {
		extidroot=cidtestarr[0];
	}
    tcconfirm(txtDeleteConfirm,cid, function () {
	    var elem=document.getElementById('tx-tc-cts-img-' + commentid);
		if (elem) {
			var picressshow = document.getElementById('tx-tc-cts-img-' + commentid).outerHTML;
		} else {
			var picressshow = document.getElementById('tx-tc-cts-img-c' + cid).outerHTML;
		}
	   	setopacity('tx-tc-' + cssident + '-dp-' + id,'0.4','toctoc_comments_delete');
	   	
	    jQuery.ajax({
	        type: 'POST',
	        url: 'index.php?eID=toctoc_comments_ajax',
	        async: false,
	        data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + commentid + '&check=' + check + '&cmd=' + action + '&cid=' + cid,
	        success: function(html){
	            if (html != "<div>db403</div>") {
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
	                    data: 'ref=' + refshow + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=0&check=' + check + '&cmd=showcomments'  + '&userpic=' + picressshow + '&commentsimgs=' + commentsImgs + '&tctreestateenc=' + tctreestateenc + '&softcheck=1' + '&extref='  + extidroot,
	                    success: function(html){
	                    	if (html.indexOf('<div id="dummy"></div>')>0){
	                    		
	                    		var htarr=html.split('<div id="dummy"></div>');
	                    		tophtml=htarr[0];
	                    		html=htarr[1];
	                    		jQuery('#tx-tc-cts-dp-split-' + refshow).html(tophtml);
	                    	}
	                        jQuery('#tx-tc-cts-' + refshow).html(html);
	                       
	                    }
	                });
	            }
	        }
	    });
	    if (delok==1) {
	    	delok=this.updatecommentscount(cid,-1);
	    }
	    if (cannotdelete==1) {
	    	messageon=true;
	    	window.setTimeout("cannotdelete(" + cid + ")", 100);
	    }
    });
} 
function cannotdelete (cid) {
	textmsg = utf8_decode(tcb64_dec(textmessagecannotdelete));
	information(textmsg,cid, function () {});
	messageon=false;
	return false; 
}
function cannotinsert (cid) {
	textmsg = utf8_decode(tcb64_dec(textmessagecannotinsert));
	information(textmsg,cid, function () {});
	messageon=false;
	return false; 
}
function tcconfirm(message,cid,callback) {
	jQuery('#confirm'+cid).modal({
		closeHTML: "<a href='#' title='"+ utf8_decode(tcb64_dec(textDgClose)) + "' class='modal-close'>x</a>",
		position: ["20%",],
		overlayId: 'confirm-overlay',
		containerId: 'confirm-container', 
		onShow: function (dialog) {
			var modal = this;

			jQuery('.message', dialog.data[0]).append(message);

			// if the user clicks "yes"
			jQuery('.yesconfirm', dialog.data[0]).click(function () {
				// call the callback
				if (jQuery.isFunction(callback)) {
					callback.apply();
				}
				// close the dialog
				modal.close(); // or $.modal.close();
			});
		}
	});
	if (!messageon) {
		return true;
	}
}

function information(message,cid, callback) {


		
	jQuery('#information'+cid).modal({
		closeHTML: "<a href='#' title='"+ utf8_decode(tcb64_dec(textDgClose)) + "' class='modal-close'>x</a>",
		position: ["20%",],
		overlayId: 'confirm-overlay',
		containerId: 'confirm-container', 
		onShow: function (dialog) {
			var modal = this;

			jQuery('.message', dialog.data[0]).append(message);

			// if the user clicks "yes"
			jQuery('.yes', dialog.data[0]).click(function () {
				// call the callback
				if (jQuery.isFunction(callback)) {
					callback.apply();
				}
				// close the dialog
				modal.close(); // or $.modal.close();
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
        data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + capsess + '&check=' + check + '&cmd=' + action + '&cid=' + cid,
        success: function(html){
            jQuery('#dnf' + capsess).html(html); 
        }
    });
    jQuery('#dnf' + capsess).css('display', 'none');
} 
function toctoc_comments_browse(id, rating, ajaxData, check, action, cssident, datac, thisdata, startpoint, cid, totalrows,commentsImgs) {
	var str1=this.toctoc_comments_pi1_serialize(tctreestate);
    var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);
    
    setopacity('tx-tc-cts-dp-' + id,'0.4','toctoc_comments_submit 1');
    jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&startpoint=' + startpoint + '&check=' + check + '&cmd=' + action + '&cid=' + cid + '&totalrows=' + totalrows + '&commentsimgs=' + commentsImgs + '&tctreestateenc=' + tctreestateenc,
        success: function(html){
        	
        	if (html.indexOf('<div id="dummy"></div>')>0){
        		
        		var htarr=html.split('<div id="dummy"></div>');
        		tophtml=htarr[0];
        		html=htarr[1];
        		jQuery('#tx-tc-cts-dp-split-' + id).html(tophtml);
        	}
            jQuery('#tx-tc-' + cssident + '-' + id).html(html);
            editon = false;
        }
    });
    setopacity('tx-tc-cts-dp-' + id,'1','toctoc_comments_submit 2');
}
function toctoc_comments_submit(id, rating, ajaxData, check, action, cssident, datac, thisdata, capsess, cid, caperr,commentsImgs, loggedon, extid, webpagepreviewheight,windowpreviewhtml) {
    if ((cssident.indexOf("cts")>=0) || (cssident.indexOf("form")>=0)) {
    	if (getopacity('toctoc_comments_pi1_submit_' + cid) != '1') {
    		return false;
    	}
     	var thumbstylemaxheight=webpagepreviewheight + 200;
    	var thumbstyleminheight=webpagepreviewheight + 5;
    	var formhidermoreheight=webpagepreviewheight + 13;
    	var responsed=1;
        var commentid = tctrim(id.substr(11,1000));  // ex.: tt_content_1016
        
        var extidroot= extid;
        var cidtestarr = String(extid).split("6g9");
        var commentreplyid=0;
		if (cidtestarr.length==3) {
			extidroot=cidtestarr[0];
			commentreplyid=parseInt(cidtestarr[1] + '' + cidtestarr[2]);
		}   
		var mcid=cid; //mastercid
		var cidtestarr = String(cid).split("6g9");
		if (cidtestarr.length==3) {
			mcid=cidtestarr[0];
		}   
		
		
        var picress = '';
        var picressshow ='';       
        if (loggedon==true) {
        	var picressorig = document.getElementById('tx-tc-uimg-' + commentid).outerHTML;
            picress = picressorig.replace('block','none');
        } 
        
        if (capsess=='1') {
        	var response=0;            
        	capsess = document.getElementById('toctoc_comments_pi1-cap-' + cid).value;
        	setopacity('toctoc_comments_cap_' + cid,'0.4','toctoc_comments_submit 3');
            responsed=0;
            jQuery.ajax({
                type: 'POST',
                url: 'index.php?eID=toctoc_comments_ajax',
                async: false,
                data: 'cmd=checkcap&cid='+ cid + '&code='+capsess,
                success: function(response){
                    if (response==1) {
                        responsed=1;  
                        capsess=4;
                    } else {
                    	caperr=tctrim(caperr);
                    	if (caperr !='') {
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
        
        if (responsed==1) {        	
        	var htmlretcode=0;
        	var htmlretcodeapproval=0;
        	setopacity('tx-tc-' + cssident + '-dp-' + extid,'0.4','toctoc_comments_submit 5');
             jQuery.ajax({
                type: 'POST',
                url: 'index.php?eID=toctoc_comments_ajax',
                async: false,
                data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=' + capsess + '&check=' + check + '&cmd=' + action + '&userpic=' + picress + '&extref='  + extidroot + '&commentreplyid=' +commentreplyid,
                success: function(html){
                	//console.log(html);
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
                        htmlretcode=tctrim(htmlretcode.substr(3,20));
                    }
                    //set html for form
                    jQuery('#tx-tc-' + cssident + '-' + extid).html(html);

                    //handling emojis
                    var reresultucd = /(\\u)+/g;
                    tmpcontent =document.getElementById('toctoc_comments_pi1_contenttextbox_' + cid).value;                    
                    var cnvtmpcontent =  tmpcontent.replace(reresultucd, '%u');                    
                    tmpcontent =  unescape(cnvtmpcontent);
                    document.getElementById('toctoc_comments_pi1_contenttextbox_' + cid).value=tmpcontent;
                   
                    //tooltiop notify checkbox
                    tttip('t101',".tx-tc-ct-form-field-ntf input[title]");
                    if ((windowpreviewhtml !='') && (htmlretcode != 0)) {
                    	window['previewhtml' + cid] = '';
                    }
                    if (htmlretcode != 0) {
                    	//hide reply on comment-frame if ever present
                    	var elem=document.getElementById('tx-tc-ct-ry-frame-' + cid);
                    	if (elem) {
                    		if (elem.style.display!= 'none') {
                    			elem.style.display= 'none';
                    		}
                    	}
                    }
                    if ((windowpreviewhtml !='') && (htmlretcode == 0)) {
                    	jQuery('#tx-tc-form-wpp-' + cid).html(window['previewhtml' + cid]);
                    	jQuery('#tx-tc-form-dp-wpp-' + cid).css('display', 'block');
                    	var thishider = document.getElementById('formhider-' + cid);
                   	 	var thishideroffsetHeight = thishider.offsetHeight;
                    	thishider.style.height = eval(thishideroffsetHeight + formhidermoreheight) + "px";
				    	jQuery('#tx-tc-form-dp-wpp-' + cid).css('min-height', (thumbstyleminheight+'px'));
				    	jQuery('#tx-tc-form-dp-wpp-' + cid).css('max-height', (thumbstylemaxheight+'px'));
				    	var haspics=0;
						var haspicsjquery=0;
						if (windowpreviewhtml.indexOf('pvs-images')>2) {
							haspics=1;
						}
	                   	if (window['previewstarted' + cid] == 2) {
	                		 if (window['previewselpic' + cid] != 888) {
	                			 haspicsjquery=1;
	                			 jQuery('#tx-tc-form-wpp-working' + cid).css('display', 'none');
	                		 }
	                	 } else {
	                		 haspicsjquery=1;
	                	}
				    	if ((haspics==1) && (haspicsjquery==1)) {
	                    	jQuery('#tx-tc-cts-pvsprevnext-' + cid).css('display', 'block');
	                    	jQuery('#tx-tc-cts-pvsprev-' + cid).css('display', 'block');
	                    	jQuery('#tx-tc-cts-pvsnext-' + cid).css('display', 'block');
	                       	jQuery('#tx-tc-cts-nopreviewpic-' + cid).css('display', 'block');
                       	}
                    	jQuery('#tx-tc-cts-pvsfuncs-' + cid).css('display', 'block');
                    	jQuery('#tx-tc-cts-pvsnopreview-' + cid).css('display', 'block');
                 	
                    	show_pvs_pic(cid,window['previewselpic' + cid]);
                    }
                    if ((htmlretcodeapproval>=2) && (htmlretcode!=0)) {
	                   	window['previewselpreviewid' + cid] =0;
	    	            window['previewselpic' + cid] =888;
                    }
                //tooltips
             	var elemcap=document.getElementById('tx-tc-ct-form-gender' + cid);
	    		if (elemcap){
	    			tttip('t101',"#tx-tc-ct-form-gender" + cid + " img[title]");
	    		}
	            if (confuseEmoji>0) {
	            	tttip('t101','#tx-tc-smilie-icon-' + cid + '[title]');
	            }
	            tttip('t10-18','#tx-tc-cts-ftm-' + cid + ' input[title]');
	            tttip('t101','#tx-tc-uimg-' + cid + '[title]');
	            tttip('t201','#tx-tc-' + cid + 'uploaddiv img[title]');
	            tttip('t101','#toctoc_comments_caprefresh_' + cid + '[title]');
	            }
             });
             setopacity('tx-tc-' + cssident + '-dp-' + extidroot,'1','toctoc_comments_submit 6');

            // check if the insert wwas omk and only if...
             //console.log ('htmlretcode: ' + htmlretcode + ', htmlretcodeapproval: ' + htmlretcodeapproval);
             if(htmlretcode > 0)    {
                if (htmlretcodeapproval !=2)    {
	               	var str1=this.toctoc_comments_pi1_serialize(tctreestate);
	                var tctreestateenc=this.toctoc_comments_pi1_base64_encode(str1);
		            window['previewselpreviewid' + cid] =0;
		            window['previewselpic' + cid] =888;
	                if (loggedon== true) {
	                	var strnew = 'tx-tc-cts-img-c' + commentid;
	                	var strold = 'tx-tc-uimg-' + cid;
	                	picressshow = picressorig.replace(strold,strnew);
	                    picressshow = picressshow.replace(' margin: 4px 0px 0px;','');
	                    picressshow = picressshow.replace('align="left" ','');
	                }
                
	                setopacity('tx-tc-cts-dp-' + extidroot,'0.4','toctoc_comments_submit 7');
	                jQuery.ajax({
	                    type: 'POST',
	                    url: 'index.php?eID=toctoc_comments_ajax',
	                    async: false,
	                    data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=' + capsess + '&check=' + check + '&cmd=showcomments'  + '&userpic=' + picressshow + '&commentsimgs=' + commentsImgs + '&tctreestateenc=' + tctreestateenc + '&extref='  + extidroot,
	                    success: function(html){
	                    	if (html.indexOf('<div id="dummy"></div>')>0){
	                    		
	                    		var htarr=html.split('<div id="dummy"></div>');
	                    		tophtml=htarr[0];
	                    		html=htarr[1];
	                    		jQuery('#tx-tc-cts-dp-split-' + extidroot).html(tophtml);
	                    		tttip('t101','.tx-tc-ct-denotifybutton[title]');
	                    	}
	                        jQuery('#tx-tc-cts-' + extidroot).html(html);
	                        window['previewselcomment' + cid] = 0;
	                        reset_previewvars(cid);
	                    }
	                });
	                setopacity('tx-tc-cts-dp-' + extidroot,'1','toctoc_comments_submit 8');
	                jQuery.ajax({
	                    type: 'POST',
	                    url: 'index.php?eID=toctoc_comments_ajax',
	                    async: true,
	                    data: 'ref=' + htmlretcode + '&data=' + ajaxData + '&check=' + check + '&cmd=handlecn',
	                    success: function(html){
	                    }
                    });
                }
            }
            if (htmlretcode == 999999999)    { 
            	messageon=true;
            	window.setTimeout("cannotinsert('" + mcid + "')", 100);
    		}
        } 
    }    
    else if (((cssident=='myrtstop') || (cssident=='myrts')) && (id.indexOf("toctoc_comments_comments")==-1)) {
        // concerns only Like-Dislike in the commentsbox top
    	// bit special: commentsimgs= are passed in var  datac
        
    	var taction = 'like';
        if (action.indexOf("unlike")>=0) {
            taction = 'unlike';
        }    
        topaction= 'liketop';
        if (action.indexOf("unlike")>=0) {
        	var topaction = 'unliketop';
        }
        
        setopacity('tx-tc-myrtstop-dp-' + id,'0.8','toctoc_comments_submit 9');
        setopacity('tx-tc-myrts-dp-' + id,'0.4','toctoc_comments_submit 10');
        jQuery.ajax({
            type: 'POST',
            url: 'index.php?eID=toctoc_comments_ajax',
            async: false,
            data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + taction + '&commentsimgs=' +  datac + '&pageid=' + pageid,
            success: function(html){
                 jQuery('#tx-tc-myrts-' + id).html(html);
              }
            });
         setopacity('tx-tc-myrtstop-dp-' + id,'0.4','toctoc_comments_submit 11');
        jQuery.ajax({
            type: 'POST',
            url: 'index.php?eID=toctoc_comments_ajax',
            async: true,
            data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + topaction + '&commentsimgs=' +  datac + '&pageid=' + pageid,
            success: function(html){
                 jQuery('#tx-tc-myrtstop-' + id).html(html);
                 setopacity('tx-tc-myrtstop-dp-' + id,'1','toctoc_comments_submit 12');
            }
        });
        elem = document.getElementById('tx-tc-cts-dp-' + thisdata);
        tttip('t101','#tx-tc-myrts-dp-' + id + '.tx-tc-myrts-disilke img[title]');
        tttip('t101','#tx-tc-myrts-dp-' + id + '.tx-tc-myrts-ilke img[title]');
 
    } else {
        // concerns rest of voting
    	// Save scopeinfos

        var savedscope='';
        var elem = document.getElementById('tx-tc-scope-' + id);
        var idwithnoscope= id;
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
    			 //console.log ('savedelemparent: ' + savedelemparent);
    			 
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
	            } else {
	            	
	            }
    		}
        } 
        setopacity('tx-tc-' + cssident + '-dp-' + id,'0.4','toctoc_comments_submit 12');
        var elemmdisp = document.getElementById('tx-tc-' + cssident + '-' + id);
        var elemmdispuserslikeshtml ='';
        var strbrbr='';
        if (elemmdisp) {
        	var elemmdispstr='#tx-tc-' + cssident + '-' + id;
            strbrbr='<br>';

        } else {
        	var elemmdispstr='#tx-tc-' + cssident + '-' + idwithnoscope;
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
            data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + action + '&commentsimgs=' +  datac + '&pageid=' + pageid,
            success: function(html){
            	html = html.replace('tipClass: \'tooltip2\'});">','tipClass: \'tooltip2\'});">' + strfirstdiv+ savedscope);
            	html = html +strfirstdivend;
            	if (elemmdispuserslikeshtml!='') {
             		html=elemmdispuserslikeshtml +strbrbr+ html+'</div></div></div></div>';
            	}
                jQuery(elemmdispstr).html(html);
            }
        });
        
        if (idwithnoscope != id) {
        	var elemmstr = document.getElementById('tx-tc-scope-' + idwithnoscope);
        	strfirstdiv= '';
            strfirstdivend= '';
        	var savedscopemain='';
            if (elemmstr) {
            	savedscopemain=elemmstr.outerHTML;
            	var elemparentmain = document.getElementById('tx-tc-scope-' + idwithnoscope).parentNode;
       		 	if (elemparentmain) {
       			 savedelemparent=elemparentmain.outerHTML; 
       			// console.log ('savedelemparent main: ' + savedelemparent);
       			 if ((savedelemparent.indexOf('tx-tc-firstvote')) > 2) {
       				 strfirstdiv='<div class="tx-tc-firstvote">';
       				 strfirstdivend= '</div>';
       			 }
       		 }
            	
             }           
            // get the check
            newcheck= check;
            var elemmnoscopesratings = document.getElementById('tx-tc-rts-dp-'+ idwithnoscope);
             if (elemmnoscopesratings) {
	            var elemmnoscopesratingshtml = elemmnoscopesratings.innerHTML;
	            var elemmnoscopesratingshtmlbasearr = String(elemmnoscopesratingshtml).split('\'' + idwithnoscope + '\', ' + rating +'');
	            var elemmnoscopesratingshtmlbasearr2 = String(elemmnoscopesratingshtmlbasearr[1]).split('\', \'vote\'');
	            var elemmnoscopesratingshtmlbasearr3 = String(elemmnoscopesratingshtmlbasearr2[0]).split('\'');
	            newcheck= elemmnoscopesratingshtmlbasearr3[1];
	            if (nbrelems>1) {
	            	rating = rating + '-' + nbrelems;
	            }
	            if (newcheck.length>11) {
		            setopacity('tx-tc-' + cssident + '-dp-' + idwithnoscope,'0.4','toctoc_comments_submit 12');
		            jQuery.ajax({
		                type: 'POST',
		                url: 'index.php?eID=toctoc_comments_ajax',
		                async: true,
		                data: 'ref=' + idwithnoscope + '&rating=' + rating + '&data=' + ajaxData + '&check=' + newcheck + '&cmd=' + action + '&commentsimgs=' +  datac + '&overall=1' + '&pageid=' + pageid,
		                success: function(htmlx){
		                	htmlx = htmlx.replace('tipClass: \'tooltip2\'});">','tipClass: \'tooltip2\'});">' + strfirstdiv + savedscopemain);
		                	htmlx = htmlx + strfirstdivend;
		                    jQuery('#tx-tc-' + cssident + '-' + idwithnoscope).html(htmlx);
		                }
		            });
	            }
             } 
             else 
             {
            	 // lets vote anyway on the overall
            	 //console.log ('lets vote anyway on the overall');
            	 newcheck= Math.round(new Date().getTime()/1000);
 	            if (nbrelems>1) {
 	            	rating = rating + '-' + nbrelems;
 	            }
	            jQuery.ajax({
	                type: 'POST',
	                url: 'index.php?eID=toctoc_comments_ajax',
	                async: true,
	                data: 'ref=' + idwithnoscope + '&rating=' + rating + '&data=' + ajaxData + '&check=' + newcheck + '&cmd=' + action + '&commentsimgs=' +  datac + '&overall=1' + '&softcheck=1' + '&pageid=' + pageid,
	                success: function(htmlx){
	                	//console.log (htmlx);
	                }
	            });
 	          
             }
        }
        if (idwithnoscope != id){
            tttip('t201-5',"#tx-tc-rts-dp-" + idwithnoscope + " .tx-tc-rts-vote-bar div span[title]");
            tttip('t201-5',"#tx-tc-rts-dp-" + idwithnoscope + " .tx-tc-rts-vote-bar div a[title]");

        }
        tttip('t201-5',"#tx-tc-rts-dp-" + id + " .tx-tc-rts-vote-bar div span[title]");
        tttip('t201-5',"#tx-tc-rts-dp-" + id + " .tx-tc-rts-vote-bar div a[title]");
      
        tttip('t101','#tx-tc-myrts-dp-' + idwithnoscope + '.tx-tc-myrts-disilke img[title]');
        tttip('t101','#tx-tc-myrts-dp-' + idwithnoscope + '.tx-tc-myrts-ilke img[title]');
    }
}
function getCursorPos(input) {
    if ("selectionStart" in input && document.activeElement == input) {
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
    return -1;
}
function setCursorPos(input, start, end) {
    if (arguments.length < 3) end = start;
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
var caretposstart= 0;
var caretposend= 0;
function toctoc_checkurl(previewopenedarr) {
// called from Page, when writing a comment.
// it checks if the last entire word is a URL and then gets the webpagepreview
	var keyval=arguments[0];
	var fieldta=arguments[1];
	var pos = getCursorPos(fieldta);
    if (pos.start === null || typeof pos.start === "undefined") {
    } else {
    	this.caretposstart=pos.start;
    	this.caretposend=pos.end;
    }
	var fieldvalue=fieldta.value;
	var id=arguments[2];
	var previewopenedprogress=arguments[3];
	var lang=arguments[4];
	var webpagepreviewheight=arguments[5];
	var ajaxData=arguments[6];
	var ajaxDataAtt=arguments[7];
	var maxCommentlength=arguments[8];
	var previewarr = new Array();
	//alert(lang);
	if (previewopenedprogress!=99999) {
		if (fieldvalue.length > maxCommentlength) {
			document.getElementById('toctoc_comments_pi1_contenttextbox_' + id).value=fieldvalue.substr(0,maxCommentlength);
		}
		if (fieldvalue.length > 0) {
			var disableinp = false;
			var hideelems = 'visible';
			var opastate= '1';
			var elemcap=document.getElementById('tx-tc-div-submit' + id);
	 		if (elemcap.style.opacity=='0.6'){
	 			var opastatesm= '1';
	 		}	else {
	 			var opastatesm= elemcap.style.opacity;
	 		}
		} else {
			var disableinp = true;
			var hideelems = 'hidden';
			var opastate= '0.6';
			var elemcap=document.getElementById('tx-tc-div-submit' + id);
	 		if (elemcap.style.opacity=='1'){
	 			var opastatesm= '0.6';
	 		}	else {
	 			var opastatesm= elemcap.style.opacity;
	 		}
		}
			
		
        jQuery( '#formhider-' + id).css('opacity', opastate);        
        jQuery( '#tx-tc-div-submit' + id).css('opacity', opastatesm);
         elemcap=document.getElementById('toctoc_comments_pi1_submit_' + id);
		if (elemcap){
			elemcap.disabled = disableinp;
		}
		elemcap=document.getElementById('tx-tc-' + id + 'uploaddiv');
		if (elemcap){
			elemcap.style.visibility=hideelems;
		}
		if (lang != 'jedi') {
	        if (global_loggedon!=1){
	        	elemcap=document.getElementById('toctoc_comments_pi1_' + id + 'firstname');
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
	    		elemcap=document.getElementById('tx-tc-ct-form-gender' + id);
	    		if (elemcap){
	    		    tttip('t101',"#tx-tc-ct-form-gender" + id + " img[title]");
	    			elemcap.style.visibility=hideelems;
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
		
		if (submitopaccontrol ==2) {
			if (elemsmt) {
				submitopaccontrol= getopacity('tx-tc-div-submit' + id);
			}
			
		}
		if (fieldvalue.length > errCommentRequiredLength) {
		    if (elem) {
		    	tttip('t101',"#prv-ct-" + id + "[title]");
		    	elem.style.display='block';
		    }
		    if ((elemsmt) && (submitopaccontrol == 0.5)) {
		    	elemsmt.style.opacity='1';
		    }
		} else {
			if (elem) {
		    	elem.style.display='none';
		    }
			if ((elemsmt) && (submitopaccontrol == 0.5)) {
			    elemsmt.style.opacity='0.5';
			}
		}  
	}

	if (typeof emotjicodes != 'undefined') {
		if (keyval == '32') {
			var emotjicandArray = String(fieldvalue).split(':'); 
			
			var testemotjielem=0;
			var emotjicandArrayLastElem =0;
			if (emotjicandArray.length >1) {
				emotjicandArrayLastElem = emotjicandArray.length-2;
			} else {
				if (emotjicandArray.length ==1) {
					emotjicandArrayLastElem = 0;
				} 			
			}

			var emotjicand=tcdelinefeed(emotjicandArray[emotjicandArrayLastElem]);	
			if (emotjicand.length > 0) {
		
				emotjicand=emotjicand.toUpperCase();
				for (var i = 0; i < emotjicodes.length; i++) {
					if (emotjicodes[i][0]==emotjicand) {
						emotjicandArray[emotjicandArrayLastElem]='::';
						emotjicandArray[emotjicandArrayLastElem+1]='';
						emotjiout=	emotjicodes[i][1];
						fieldvalue=emotjicandArray.join(":");
						fieldvalue=fieldvalue.replace('::::','');
						if (previewopenedprogress!=99999) {
							document.getElementById('toctoc_comments_pi1_contenttextbox_' + id).value=fieldvalue + emotjiout + ' ';
						} else {
							
							document.getElementById('toctoc_comments_pi1_contenttextboxc_' + id).value=fieldvalue + emotjiout + ' ';
						}
					  return 0;
					}
				}
						
			}
		}
		
	}
	if (lang != 'jedi') {
		if (previewopenedprogress!=99999) {
			if (window['previewstartedfp' + id] =='0') {
			//13 is enter, 16 shift, 32 space
				if (keyval == '32') {
					if (window['previewhtml' + id] == '') {
						var fieldvalueArray = String(fieldvalue).split(' '); 
						var testurlelem=0;
						var fieldvalueArrayLastElem =0;
						if (fieldvalueArray.length >1) {
							fieldvalueArrayLastElem = fieldvalueArray.length-2;
						} 
						else
						{
							if (fieldvalueArray.length ==1) {
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
								if ((testurl.substr(0,4)=='www\.') || (testurl.substr(0,4)=='http') ) {
									var testurlArray = testurl.split('.'); 
									if (testurlArray.length >1) {
										if (previewopenedprogress==0) {
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
	
	return previewopenedprogress;
}

function toctoc_previewurl(id, previewopened, previewopenedprogress, lang, webpagepreviewheight,ajaxData,ajaxDataAtt) {
	jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'block');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '15px');
	jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '15px');
	setopacity('toctoc_comments_pi1_submit_' + id,'0.4','toctoc_previewurl 1');
	formhidermoreheightsecondlap=0;
	document.getElementById('formhider-' + id).style.height = "auto";
	var previewarr = new Array();
	previewarr['url']=tctrim(previewopened);
	previewarr['lang']=lang;
	previewarr['commentid']=window['previewcountnr' + id] ;
	previewarr['webpagepreviewheight']=webpagepreviewheight;
	previewarr['configBaseURL']=utf8_decode(tcb64_dec(configbaseURL));

	var str1=toctoc_comments_pi1_serialize(previewarr);
	var ajaxpreviewopened=toctoc_comments_pi1_base64_encode(str1);
	
	jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'ref=' + id + '&data=' + ajaxpreviewopened + '&cmd=getpreviewinit' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
        success: function(html){
        	
        }
    });
	jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: true,
        data: 'ref=' + id + '&data=' + ajaxpreviewopened + '&cmd=startpreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
        success: function(html){
        	if (html > 0) {
        		window['previewselpreviewid' + id] =html;
        	}
        }
    });
	jQuery('#tx-tc-' + id + 'uploaddiv').css('display', 'none');
	window.setTimeout("toctoc_previewurl_fetch('" + id + "', '" + previewopened  + "', " + previewopenedprogress  + ", 0, '" + lang + "', " + webpagepreviewheight + ", '" + ajaxData + "', '" + ajaxDataAtt + "')", 700);
}
function toctoc_settooltip (id) {
	var opanow= getopacity('tx-tc-myrtstop-dp-'+id);
	if (eval(opanow)>0.9){
		tttip('t101','#tx-tc-myrtstop-'+id+' #tx-tc-myrtstop-dp-'+id+' .tx-tc-atrtstop-ilike-dp a[title]');
		return false;
	} else {
		window.setTimeout("toctoc_settooltip('"+id+"')", 100);	
	}
}
function toctoc_delaytooltip (id) {
	var elem=document.getElementById('tx-tc-myrtstop-dp-'+id);
	if (elem) {
		window.setTimeout("toctoc_settooltip('"+id+"')", 200);
	}
}
var formhidermoreheightsecondlap=0;
var htmlretcodesave=0;
function toctoc_previewurl_fetch (id, purl,pip, iterations, lang,webpagepreviewheight , ajaxData, ajaxDataAtt) {
	var tmpthumbheight=webpagepreviewheight;
	var thumbstylemaxheight=tmpthumbheight + 200;
	var thumbstyleminheight=tmpthumbheight + 5;
	var formhidermoreheight=tmpthumbheight - 2;
	iterations=iterations+1;
	
	var previewopenurl = purl;
	var previewarr = new Array();
	previewarr['url']=purl;
	previewarr['lang']=lang;
	previewarr['commentid']=window['previewcountnr' + id] ;
	previewarr['webpagepreviewheight']=webpagepreviewheight;
	previewarr['configBaseURL']=utf8_decode(tcb64_dec(configbaseURL));
	var previewopenedprogress = window['previewstarted' + id];
    if (previewopenedprogress != 2) {
    	if (iterations<30) {
    		var str1=this.toctoc_comments_pi1_serialize(previewarr);
	    	var ajaxpreviewopenurl=this.toctoc_comments_pi1_base64_encode(str1);
	    	// send to server the cid and the original url
	    	var htmlretcode=0;
	    	jQuery.ajax({
	            type: 'POST',
	            url: utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/pi1/class.toctoc_comments_webpagepreview_ajax.php',
	            async: true,
	            data: 'ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=getpreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
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
			    	if ((iterations>=1) && (html.length > 150)) {
			    		if ((htmlretcode < 4) && (posworking>2)) {
				    		if (document.getElementById('tx-tc-form-dp-wpp-' + id).style.maxHeight != (thumbstylemaxheight+'px')) {
				    			var fhoffseth = eval(document.getElementById('formhider-' + id).offsetHeight + formhidermoreheight);
						    	document.getElementById('formhider-' + id).style.height = "auto";
						    	jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'block');
						    	jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', (thumbstyleminheight+'px'));
						    	jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', (thumbstylemaxheight+'px'));
						    	formhidermoreheightsecondlap=formhidermoreheight;
				    		}
			    		} 
			    	}  

			    	if ((htmlretcode >3) ) {
			    		htmlretcodesave=htmlretcode;
		    			previewopenedprogress=2;
		    			window['previewstarted' + id]=2;
		    			jQuery('#tx-tc-form-wpp-' + id).html(html);
		    	    	//
		    			if (document.getElementById('tx-tc-form-dp-wpp-' + id).style.maxHeight != '0px') {
			    	    	document.getElementById('formhider-' + id).style.height = "auto";
			    	    	jQuery('#tx-tc-form-wpp-' + id).html('<img id="tx-tc-form-wpp-working' + id + '" width="16" height="11" align="right" alt="'+ utf8_decode(tcb64_dec(textLoading)) + '" title="' + utf8_decode(tcb64_dec(textLoading)) +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/' + selectedTheme + '/img/workingslides.gif">');
			    	    	jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'none');
			    	    	jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '0px');
			    	    	jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '0px');
			    	    	
		    			}
		    			setopacity('toctoc_comments_pi1_submit_' + id,'1','toctoc_previewurl_fetch 1');
		    			return true;
	    			}
			    	 if (previewopenedprogress==2) {
			    		 setopacity('toctoc_comments_pi1_submit_' + id,'1','toctoc_previewurl_fetch 2');
			    		 return true; 
			    	 }
			    	 else
			    	 {
			    		 jQuery('#tx-tc-form-wpp-' + id).html(html);
			    		 window['previewhtml' + id] = html;
			    	 }
					var haspics=0;
					var haspicsjquery=0;
					
					if (html.indexOf('pvs-images')>2) {
						haspics=1;
					}
					 if (tctrim(htmlretcode)=='3') {
						 window['previewselpic' + id] =0;
					 }
                    if ((tctrim(htmlretcode)=='2') || (tctrim(htmlretcode)=='3') || (window['previewstarted' + id] == 2)) {
                    	previewopenedprogress=2;

                    	 if (window['previewstarted' + id] == 2) {
                    		 if (window['previewselpic' + id] != 888) {
                    			 haspicsjquery=1;
                    			 jQuery('#tx-tc-form-wpp-working' + id).css('display', 'none');
                    		 }
                    	 } else {
                    		 haspicsjquery=1;
                    		 window['previewstarted' + id] = 2;
                    	}

                    	if ((haspics==1) && (haspicsjquery==1)) {
	                    	jQuery('#tx-tc-cts-pvsprevnext-' + id).css('display', 'block');
	                    	jQuery('#tx-tc-cts-pvsprev-' + id).css('display', 'block');
	                    	jQuery('#tx-tc-cts-pvsnext-' + id).css('display', 'block');
	                       	jQuery('#tx-tc-cts-nopreviewpic-' + id).css('display', 'block');
                       	}
                    	jQuery('#tx-tc-cts-pvsfuncs-' + id).css('display', 'block');
                    	jQuery('#tx-tc-cts-pvsnopreview-' + id).css('display', 'block');
                 	
                    	window['previewselpic' + id] = change_pvs_pic(id,888,0);
                    	
                    	
                    	
                    	var testelem = document.getElementById('toctoc-comments-pvs-formtext-p' + id);
                    	if (testelem) {
	                    	fhoffseth = eval(document.getElementById('toctoc-comments-pvs-formtext-p' + id).offsetHeight);
					    	
					    	logomargin = '-'+fhoffseth+'px';
	                    	jQuery('#tx-tc-pvs-logobg-p' + id).css('margin-top', logomargin);
	                		logomargin='';
                    	} else {
                    		
                    	}
                    	if (tctrim(htmlretcode)!='3') {						    	
 	                    	jQuery.ajax({
	                            type: 'POST',
	                            url: 'index.php?eID=toctoc_comments_ajax',
	                            async: true,
	                            data: 'ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=savepreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
	                            success: function(html){
	                            	if (html != '') {
	                            		if (html > 0) {
	                            			window['previewselpreviewid' + id] =html;
	                            		}
	                            	}
	                            }
	                        });
                    	} else {
                    		jQuery('#tx-tc-form-wpp-working' + id).css('display', 'none');
                    	}
                    	setopacity('toctoc_comments_pi1_submit_' + id,'1','toctoc_previewurl_fetch 3');
                    	
                    }
                    return true;
	            }
	        });
	        window.setTimeout("toctoc_previewurl_fetch('" + id + "', '" + previewopenurl  + "', " + previewopenedprogress  + ", " + iterations + ", '" + lang + "', " + webpagepreviewheight  + ", '" + ajaxData + "', '" + ajaxDataAtt + "')", 1000);
    	} else {
    		iterations = 0;
    		previewopenedprogress = 2;
    		window['previewstarted' + id] = previewopenedprogress;
    		
      		if (window['previewhtml' + id] =='<img align="right" id="tx-tc-form-wpp-working' + id +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/'+selectedTheme+'/img/workingslides.gif" width="16" height="11" />') {
     	    	document.getElementById('formhider-' + id).style.height = "auto";
    	    	jQuery('#tx-tc-form-wpp-' + id).html('<img id="tx-tc-form-wpp-working' + id + '" width="16" height="11" align="right" alt="'+ tcb64_dec(textLoading) + '" title="' + tcb64_dec(textLoading) +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/' + selectedTheme + '/img/workingslides.gif">');
    	    	jQuery('#tx-tc-form-dp-wpp-' + id).css('display', 'none');
    	    	jQuery('#tx-tc-form-dp-wpp-' + id).css('min-height', '0px');
    	    	jQuery('#tx-tc-form-dp-wpp-' + id).css('max-height', '0px');
    	    	setopacity('toctoc_comments_pi1_submit_' + id,'1','toctoc_previewurl_fetch 4');
    	    	reset_previewvars (id);
			}
    
      	
        }  
    	return true;   
    } else {
    	//console.log('toctoc_previewurl_fetch 5');
    	window['previewstarted' + id]=0;
    	if (htmlretcodesave !=0) {
    		reset_previewvars (id);
    	}
    	setopacity('toctoc_comments_pi1_submit_' + id,'1','toctoc_previewurl_fetch 5');
    	htmlretcodesave=0;
	  return true;
	  
	}
}
function toctoc_previewurl_close (id,previewopenedprogress,webpagepreviewheight,ajaxData,ajaxDataAtt) {
	var result=0;
	var tmpthumbheight=webpagepreviewheight+13;
	// send to server the cid and clean up temp 
    var previewarr = new Array();
	previewarr['cid']=id;
	var str1=this.toctoc_comments_pi1_serialize(previewarr);
	var ajaxpreviewopenurl=this.toctoc_comments_pi1_base64_encode(str1);
	jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: true,
        data: 'ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=cleanuppreview' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=0',
        success: function(html){
        }
    });
	document.getElementById('formhider-' + id).style.height = "auto";
	jQuery('#tx-tc-form-wpp-' + id).html('<img id="tx-tc-form-wpp-working' + id + '" width="16" height="11" align="right" alt="' + tcb64_dec(textLoading)  + '" title="' + tcb64_dec(textLoading) +'" src="' + utf8_decode(tcb64_dec(configbaseURL)) + 'typo3conf/ext/toctoc_comments/res/css/themes/' + selectedTheme + '/img/workingslides.gif">');
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
	window['previewstarted' + id] = 0;
	window['previewselpic' + id] = 0;
	window['previewcountnr' + id] = window['previewcountnr' + id]+1;
	window['previewhtml' + id] = '';	
	window['previewselpreviewid' + id] = 0;
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
	if (i==0) {
		booforward=2;
	}
	// i = Anzahl Bilder
	if (currentindex==888) {
		if (booforward==2) {
			nextindex=888;
		} 
		else 
		{
			nextindex=0;
		}
	} else {
		var nextindex=currentindex;
		if (booforward==1) {
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
    window['previewselpic' + cid] = currentindex;
	return '';	
}
function remove_pvs_pic(cid) {
		
		document.getElementById('toctoc-comments-pvs-formtext-p' + cid).style.margin = "0px 0px 0px 2px";
		document.getElementById('pvsimgp' + cid + 'index' + window['previewselpic' + cid]).style.display='none';
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
		elem.style.filter='alpha(opacity='+ eval(100*opacityval) +')';
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
	 
	window['previewselcomment' + cid] = uid;
	if (triggeredzone == 'triggerform') {
		jQuery('#tx-tc-ct-ry-fh-' + uid).css('display', 'none');
		jQuery('#tx-tc-cts-rply-' + uid).css('display', 'block');
		
		comment_formhider(uid, 1, '', 0, 0, document.getElementById('toctoc_comments_pi1_contenttextbox_' + triggereduid));
		window['previewselcomment' + cid] = uid;
		//document.getElementById('toctoc_comments_pi1_contenttextboxc_' + uid).focus();
		
	} else {
		
		setopacity('tx-tc-ct-ry-frame-' + cid,'0','commentreply');
	
	    var elem=document.getElementById('tx-tc-cts-img-' + uid);
		if (elem) {
			var pichtml = document.getElementById('tx-tc-cts-img-' + uid).outerHTML;
			pichtml = pichtml.replace('tx-tc-cts-img-','tx-tc-cts-imgsdw-');
		} else {
			var pichtml = document.getElemevntById('tx-tc-cts-img-c' + cid).outerHTML;
			pichtml = pichtml.replace('tx-tc-cts-img-c','tx-tc-cts-imgsdw-');
		}
		  
		 pichtml = pichtml.replace('padding: 0;','margin: 0 8px 0 0;');
	    pichtml = pichtml.replace('width=','class="tx-tc-ct-ry-img" align="left" width=');
	    pichtml = pichtml.replace('width: 96px; height: 96px;','width: '+confuserpicsize+'px; height: '+confuserpicsize+'px;');
	    txthtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML;
	    txthtml = txthtml.replace('roc(','roc(999');
	    txthtml = txthtml.replace('tx-tc-acropped-','tx-tc-acropped-999');
	    txthtml = txthtml.replace('tx-tc-cropped-','tx-tc-cropped-999');
	       
		document.getElementById('tx-tc-ct-rybox-' + cid).innerHTML = pichtml + txthtml;
		jQuery('#tx-tc-ct-rybox-title-' + cid).css('display', 'block');
		jQuery('#tx-tc-ct-rybox-' + cid).css('display', 'block');
		jQuery('#tx-tc-cts-cocfuncs-' + cid).css('display', 'block');
		jQuery('#tx-tc-cts-nococ-' + cid).css('display', 'block');
		jQuery('#tx-tc-ct-ry-frame-' + cid).css('display', 'block');
		var elem =document.getElementById('toctoc_comments_pi1_contenttextbox_'+cid);
		comment_formhider(cid, 1, '', 0, 0,elem);
		window['previewselcomment' + cid] = uid;
		toctoc_comments_fadein('tx-tc-ct-ry-frame-' + cid);
	}

}
function toctoc_coc_close(cid){
	window['previewselcomment' + cid] = 0;
	if (toctoc_comments_fadeout('tx-tc-ct-ry-frame-' + cid) == true) {
		document.getElementById('tx-tc-ct-ry-frame-' + cid).style.display= 'none';
		jQuery('#tx-tc-ct-rybox-' + cid).css('display', 'none');
		jQuery('#tx-tc-ct-rybox-' + cid).html = '';
		jQuery('#tx-tc-ct-rybox-' + cid).css('display', 'none');
		jQuery('#tx-tc-ct-rybox-title-' + cid).css('display', 'none');
		jQuery('#tx-tc-cts-cocfuncs-' + cid).css('display', 'none');
		jQuery('#tx-tc-cts-nococ-' + cid).css('display', 'none');
	}
}
function changeavatar(gender, cid){
	if (gender==0) {
		document.getElementById('toctoc_comments_pi1_' + cid + 'gender').value= '0';
		setopacity('tx-toctoc-comments-comments-img-gender-0-' + cid,'1','changeavatar');
		setopacity('tx-toctoc-comments-comments-img-gender-1-' + cid,'0.4','changeavatar');
	} else {
		document.getElementById('toctoc_comments_pi1_' + cid + 'gender').value= '1';
		setopacity('tx-toctoc-comments-comments-img-gender-0-' + cid,'0.4','changeavatar');
		setopacity('tx-toctoc-comments-comments-img-gender-1-' + cid,'1','changeavatar');
	}
}
function savect(id, icid,pid){
	var str1=document.getElementById('toctoc_comments_pi1_contenttextboxc_' + id).value;
	
	str1=str1.replace(/\t/g,'');
    
	str1= str1.split('>').join('&gt;');
	str1= str1.split('<').join('&lt;');
	str1=tctrim(str1);
	str1=dbize_emojis(str1);

	var toctoc_pV = new Array();
    toctoc_pV['cmd'] = 'savect';	
    toctoc_pV['content'] = this.toctoc_comments_pi1_base64_encode(str1);	
	
	var str1=this.toctoc_comments_pi1_serialize(toctoc_pV);
	var strcontent=this.toctoc_comments_pi1_base64_encode(str1);
	var ajaxData=window['commentsAjaxData' + icid];
	var thisdata=window['commentsAjaxThisData' + icid];
	var datac=window['commentsAjaxDataC' + icid];
	var cssident = 'cts-ct';
	setopacity('tx-tc-' + cssident + '-dp-tx-tc-cts_' + id,'0.4','savect');
	tttip('hide');
   jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + id + '&pid=' + pid + '&cid=' + icid + '&content=' + strcontent + '&cmd=updatect',
        success: function(html){
            jQuery('#tx-tc-ct-box-cttxt-' + id).html(editsavenamehtml + ' - ' + html);
            document.getElementById('edf' + id).outerHTML = editsavebthtml;
    		document.getElementById('savef' + id).outerHTML = '';
    		var elem= document.getElementById('tx-tc-ct-ry-rl-' + id);
        	if (elem) {
        		if (elem.style.display!='block') {
        			elem.style.display='block';
        		}
        	}
        	editon = false;
        }
    });
    var elem= document.getElementById('df' + id);
	if (elem) {
		elem.style.display='block';
	}
	setopacity('tx-tc-' + cssident + '-dp-tx-tc-cts_' + id,'1','savect');
}

function previewct(ajaxData, icid, onoff) {
	if (onoff==0) {
		setopacity('tx-tc-cts-prv-ct-dp-' + icid,'0.4','previewct_off');
		tttip('hide');
		if (toctoc_comments_fadeout('tx-tc-cts-prv-ct-' + icid) == true) {
		}
 	} else {
			var toctoc_pV = new Array();
			setopacity('tx-tc-cts-prv-ct-dp-' + icid,'0.6','previewct');
			jQuery('#tx-tc-cts-prv-ct-dp-' + icid).css('display', 'block');
			 var elem= document.getElementById('prv-ct-' + icid);
		    // get the textareas current value and make ajaxpost for convert to comment
    	
	        var field = document.getElementById('toctoc_comments_pi1_contenttextbox_' + icid);
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
	            data: 'cmd=previewcomment&data=' + str2 + '&dataconf=' + ajaxData,
	            success: function(html){
	                jQuery('#tx-tc-cts-prv-content-' + icid).html(html);
	                jQuery('#tx-tc-cts-prv-content-' + icid).css('display', 'block');
	                jQuery('#tx-tc-cts-prv-ct-' + icid).css('display', 'block');
	                jQuery('#tx-tc-cts-div-ct-prv-' + icid).css('display', 'block');
	                jQuery('tx-tc-cts-img-prv-ct-' + icid).css('display', 'block');
	                setopacity('tx-tc-cts-prv-ct-' + icid,'1','previewct_success');
	            }
	        }); 
	      setopacity('tx-tc-cts-prv-ct-dp-' + icid,'1','previewct');
	      
	      jQuery('#tx-tc-cts-prv-ct-dp-' + icid).css('display', 'block');
			//tttip('t101','#tx-tc-myrtstop-'+id+' .tx-tc-atrtstop-ilike-dp a[title]');

			tttip('t101', "#prv-ct-" + icid + "[title]");
			tttip('t101',"#tx-tc-cts-img-prv-ct-" + icid + "[title]");
			tttip('temo','#tx-tc-cts-prv-content-' + icid + ' img[title]');
			tttip('temo','#tx-tc-cts-prv-content-' + icid + ' .emoji[title]');
	}
}
function recentct(toprating, rcid, pid, url) {
	if (toprating==1){
		setopacity('tx-tc-trt-cts-article-' + rcid,'0.6','recentct toprating');
	} else {
		setopacity('tx-tc-recent-cts-article-' + rcid,'0.6','recentct');
	}
    jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'cmd=rcclearcache&pid=' + pid,
        success: function(html){
        	window.location.href = url;
        }
    });
}
function editct(uid, icid, pid, onoff){
	
	var fulluid = "'toctoc_comments_pi1_contenttextboxc_" + uid + "'";
	
	if (onoff==0) {
		document.getElementById('tx-tc-ct-box-cttxt-' + uid).outerHTML = editsavehtml;
		document.getElementById('edf' + uid).outerHTML = editsavebthtml;
		document.getElementById('savef' + uid).outerHTML = '';
		var elem= document.getElementById('df' + uid);
    	if (elem) {
    		elem.style.display='block';
    	}
    	var elemdnf = document.getElementById('dnf'+ uid);
		if (elemdnf) {
			elemdnf.style.display='block';
    	}
	
		elem= document.getElementById('tx-tc-ct-ry-rl-' + uid);
    	if (elem) {
    		if (elem.style.display!='block') {
    			elem.style.display='block';
    		}
    	}
    	tttip('hide');
    	elem= document.getElementById('toctoc_comments_pi1_submitedit_uid' + uid);
    	if (elem) {
    		var savebtmhtml = elem.outerHTML;
	       	savebtmhtml = savebtmhtml.replace('top left;\"' , 'top left;\" title=\"' + utf8_decode(tcb64_dec(textEditComment))+ '\"');
	       	elem.outerHTML=savebtmhtml;
    	}
    	tttip('t101',"#toctoc_comments_pi1_submitedit_uid" + uid + "[title]");
     	editon = false;
	} else {
		if (editon == false) {
			editon = true;
			 var elem= document.getElementById('df' + uid);
		    	if (elem) {
		    		elem.style.display='none';
		    	}
			var elemdnf = document.getElementById('dnf'+ uid);
			if (elemdnf) {
				elemdnf.style.display='none';
	    	}
			 editsavehtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).outerHTML;
			 edithtml = document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML;
			 
			 editsavebthtml = document.getElementById('edf' + uid).outerHTML;
			 
			 // dename, desmile and deurl edithtml
	    	
			 var edithtmldn = '';
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
	    			edithtml=edithtml.replace('<span style="display: inline;" id="','');
	    			edithtml=edithtml.replace('<span style="display: none;" id="','');
	    		}
	    	}	
	    	
	    	var dnArray = edithtml.split('-');
			 editsavenamehtml=tctrim(dnArray[0]);
			 edithtmldn=tctrim(dnArray[1]);
			 for (var i = 2; i < dnArray.length; i++) {
				 edithtmldn+='-' + dnArray[i]; 
			 }
			 
			 var edithtmlds = '';
			 var smilieArray = edithtmldn.split('<img');
			 if (smilieArray.length <= 1) {
				 edithtmlds=edithtmldn;
			 } else {
				 for (var i = 0; i < smilieArray.length; i++) {
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
				 for (var i = 0; i < urlArray.length; i++) {
					 urlSubArray = urlArray[i].split('<a' );	
					 if (urlSubArray.length > 1) {
						 hastag= urlSubArray[0].indexOf('tx-tc-external-autolink');
						 if (hastag > 0) {
							 edithtmlouturl += urlSubArray[0].substr(urlSubArray[0].indexOf('>')+1) ;
						 } else {
							 edithtmlouturl += urlSubArray[0];
						 }
						 hastag= urlSubArray[1].indexOf('tx-tc-external-autolink');
						 if (hastag > 0) {
							 edithtmlouturl += urlSubArray[1].substr(urlSubArray[1].indexOf('>')+1) ;
						 } else {
							 edithtmlouturl += urlSubArray[1];
						 }				 
					 } else {
						 edithtmlouturl += urlArray[i];
					}
	
				 }
			 }
			 edithtmloutbb = edithtmlouturl;
			 BBs= new Array();
			
			 BBs[0] = 'b';
			 BBs[1] = 'i';			
			 BBs[2] = 'code';

			 for (var i = 0; i < BBs.length; i++) {
				 edithtmloutbb= edithtmloutbb.split('</' + BBs[i] + '>').join('[/' + BBs[i]+ ']');
				 edithtmloutbb= edithtmloutbb.split('<' + BBs[i] + '>').join('[' + BBs[i]+ ']');
			 }
			 
			 
			 var edithtmloutemouc ='';
			 var edithtmloutemoarrtest= edithtmloutbb.split("\r");
			 if (edithtmloutemoarrtest.length > 1) {
				 
			 } else {
				 edithtmloutemoarrtest= edithtmloutbb.split("\n");
			 }
			 if (edithtmloutemoarrtest.length > 1) {
				 edithtmloutbb=edithtmloutemoarrtest.join('-@#@-');
			 }			 
			 
			 var edithtmloutemoarr= edithtmloutbb.split('<span title="');//[.]" class="emoji emoji/);
			 if (edithtmloutemoarr.length > 1) {
				 for (var i = 0; i < edithtmloutemoarr.length; i++) {
					 edithtmloutemoarr2= edithtmloutemoarr[i].split('" class="emoji emoji');
					 if (edithtmloutemoarr2.length > 1) {
						 edithtmloutemoarr2[0]='';
					 }
					 edithtmloutemoarr[i]=edithtmloutemoarr2.join('');
					// console.log('1: ' + edithtmloutemoarr[i]);
				 }
			 }


			if (edithtmloutemoarr.length > 1) {
				 for (var i = 0; i < edithtmloutemoarr.length; i++) {
					 edithtmloutemoarr2= edithtmloutemoarr[i].split('"></span>');
					 if (edithtmloutemoarr2.length > 1) {
						// console.log('2: ' + edithtmloutemoarr2[0]);
						 edithtmloutemoarr3= edithtmloutemoarr2[0].split(' ');
						 if (edithtmloutemoarr3.length > 1) {
							 if (edithtmloutemoarr3[1].length > 9) {
							 edithtmloutemouc = '%' + edithtmloutemoarr3[1].replace(/-/g,'%');
							 //edithtmloutemouc = '&#x' + edithtmloutemoarr3[0] +';';
							 edithtmloutemoarr2[0]=edithtmloutemouc;
							// console.log('3: ' + edithtmloutemouc);
							 } else {
								 if (edithtmloutemoarr3[1].length > 5) {
							 
									 edithtmloutemouc = edithtmloutemoarr3[1].replace(/-/g,'%');
									 edithtmloutemouc = edithtmloutemouc.substr(1);
									 //edithtmloutemouc = '&#x' + edithtmloutemoarr3[0] +';';
									 edithtmloutemoarr2[0]=edithtmloutemouc;
									// console.log('3: ' + edithtmloutemouc);
								 }else {
									 if (edithtmloutemoarr3[1].length > 1) {
										 
										 edithtmloutemouc = edithtmloutemoarr3[1].replace(/-/g,'%');
										 edithtmloutemouc = '%' + edithtmloutemouc;
										 //edithtmloutemouc = '&#x' + edithtmloutemoarr3[0] +';';
										 edithtmloutemoarr2[0]=edithtmloutemouc;
										// console.log('3: ' + edithtmloutemouc);
									 }
								 }

							 }
						}

						 edithtmloutemoarr[i]=edithtmloutemoarr2.join('');
						 //console.log('4: ' + edithtmloutemoarr[i]);
					 }
				 }
			 
				 edithtmloutbb=edithtmloutemoarr.join('');
				 edithtmloutbb=unescape(edithtmloutbb);
			}
			
			edithtmloutbb= edithtmloutbb.split('-@#@-').join("\r");
			 
			outhtml= '<form class="tx-tc-form-for-newcomment"';
			outhtml+='><fieldset class="tx-tc-ct-fieldset"><textarea id="toctoc_comments_pi1_contenttextboxc_' + uid + '" class="tx-tc-ctinput-textarea" ';
			outhtml+='onfocus="jQuery(';
			outhtml+="'#toctoc_comments_pi1_contenttextboxc_" + uid + "').elastic();";
			outhtml+='" onblur="';
			outhtml+="jQuery('#toctoc_comments_pi1_contenttextboxc_" + uid + "').elastic();";
			outhtml+="jQuery('#toctoc_comments_pi1_contenttextboxc_" + uid + "').autoGrow();" ;
			outhtml+='" style="overflow: hidden; height: 20px; font-size: 100%;" cols="42" autocomplete="off">' + edithtmloutbb + '</textarea></fieldset></form>';
			 
			
			 elem= document.getElementById('tx-tc-ct-ry-rl-' + uid);
	    	if (elem) {
	    		if (elem.style.display != 'none') {
	    			elem.style.display = 'none';;
	    		}
	    	}
	    	
	    	var newbuttonhtml= document.getElementById('toctoc_comments_pi1_submitedit_uid' + uid).outerHTML;
	       	newbuttonhtml = newbuttonhtml.replace('editcommentfe','ceditcommentfe');
	       	newbuttonhtml = newbuttonhtml.replace(', ' + pid + ', 1)', ', ' + pid + ', 0)');
	       	newbuttonhtml = newbuttonhtml.replace('top left;\"' , 'top left;\" title=\"' +utf8_decode(tcb64_dec(textCancelEditComment)) + '\"');
	       	
	       	savebthtml=editsavebthtml;
	       	
	       	strnewfunc='if (commentform_validate(' + fulluid + ', \'' + icid + '\')) {savect(' + uid + ', \'' + icid + '\', ' + pid + ')}';
	       	savebthtml = savebthtml.replace('editcommentfe','savecomment');
	       	savebthtml = savebthtml.replace(', 1)',')');
	       	savebthtml = savebthtml.replace('top left;\"' , 'top left;\" title=\"' + utf8_decode(tcb64_dec(textSaveComment))+ '\"');
	       	savebthtml = savebthtml.replace(utf8_decode(tcb64_dec(textEditComment)) + '\"', '\"');
	       	savebthtml = savebthtml.replace('editct(' + uid + ', \'' + icid + '\', ' + pid + ')', strnewfunc);
	       	savebthtml = savebthtml.replace('id=\"edf', 'id=\"savef');
	       	savebthtml = savebthtml.replace('class=\"tx-tc-ct-editfo','class=\"tx-tc-ct-savefo');
	       	savebthtml = savebthtml.replace('toctoc_comments_pi1_submitedit_uid','toctoc_comments_pi1_submitsave_uid');
			document.getElementById('edf' + uid).outerHTML = editsavebthtml+savebthtml;

			
		
			if (confuseEmoji>0) {
				Math.round(boxmodelSpacing)
				tapadding=22+Math.round(Math.round(boxmodelSpacing)/2);
				smilieselectorttooltipjs = ' onmouseover="jQuery(\'#tx-tc-smilie-icon-' + icid + '6g9' +  uid + '6g9'+ '[title]\').tooltip({offset: [-1,0],effect: \'fade\',opacity: 1});" ';
				smilieselectorttooltip = ' title="' + utf8_decode(tcb64_dec(textAddemoji))+'"';
				smilieselectorhtml='<span '+ smilieselectorttooltipjs + '><a href="javascript:void(0)" onclick="jQuery(\'.tooltip\').hide();selectemoji(\'' + icid + '6g9' +  uid + '6g9'+ '\');" id="tx-tc-smilie-iconlink-' + icid + '6g9' +  uid + '6g9'+ '" rel="nofollow" ><div class="tx-tc-smilie-icon" id="tx-tc-smilie-icon-' + icid + '6g9' +  uid + '6g9'+ '" ' + smilieselectorttooltip + '></div></a></span><div class="tx-tc-smilie-popup" id="tx-tc-smilie-popup-' + icid + '6g9' +  uid + '6g9'+ '"></div>';
				outhtml= outhtml.replace('</textarea>','</textarea>'+ smilieselectorhtml);
			}
			
			//tooltippin:
			
			document.getElementById('tx-tc-ct-box-cttxt-' + uid).innerHTML = outhtml;
			document.getElementById('toctoc_comments_pi1_submitedit_uid' + uid).outerHTML=newbuttonhtml;
			jQuery('#tx-tc-ct-box-cttxt-' + uid).bind('keyup click', function(e) {
				var dummyret=99999;
	        	 toctoc_checkurl(e.keyCode,document.getElementById('toctoc_comments_pi1_contenttextboxc_' + uid),uid, dummyret, 'en', 0, '', '',maxCommentLength);
	          });
			
			tttip('t101',"#toctoc_comments_pi1_submitedit_uid" + uid + "[title]");
			tttip('t101',"#toctoc_comments_pi1_submitsave_uid" + uid + "[title]");
			

			//focussing
			document.getElementById('toctoc_comments_pi1_contenttextboxc_' + uid).focus();
		}
	}
}
function supports_html5_storage() {
	  try {
	    return 'localStorage' in window && window['localStorage'] !== null;
	  } catch (e) {
	    return false;
	  }
}
function tctrvw (expand, uid, children, allchildren){
	var allchildrenArray = allchildren.split(',' );
	var childrenArray = children.split(',' );
	if (expand==0){
	//expand
	    for (var i = 0; i < childrenArray.length; i++) {
	    	if  (tcisInt(childrenArray[i])){
	    		childrenArray[i]=tctrim(childrenArray[i]);
    			document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).style.display= 'block';
    			tctreestate[childrenArray[i]]=expand;
    			//store visiblitystate of child
    			
       			if (!array_key_exists(uid,tcelemstate)) {
       				 tcelemstate[uid]= new Array();
       				 tcelemstate[uid][childrenArray[i]]= new Array();
       			}
       			if (!array_key_exists(childrenArray[i],tcelemstate[uid])) {
       				 tcelemstate[uid][childrenArray[i]]= new Array();
       			}
    			tcelemstate[uid][childrenArray[i]]['visible']=1;
    			
    			
    			//restore expansionstate of child
    			elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]);
				if (elemicon) {
	    			if (tcelemstate[uid][childrenArray[i]]['expanded']==1) {
	    				document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display= 'block';
	    				document.getElementById('tx-tc-cts-img-exp-0-' + childrenArray[i]).style.display= 'none';
	    			} else {
	    				document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display= 'none';
	    				document.getElementById('tx-tc-cts-img-exp-0-' + childrenArray[i]).style.display= 'block';
	    				tcelemstate[uid][childrenArray[i]]['expanded']=0;
	    			}
				} else{ 
					tcelemstate[uid][childrenArray[i]]['expanded']=2;   //is leave
				}
	    	}
	    }
	    for (var i = 1; i < allchildrenArray.length; i++) {
	    	allchildrenArray[i]=tctrim(allchildrenArray[i]);
	    	if  (tcisInt(tctrim(allchildrenArray[i]))){
	    		if (!array_key_exists(uid,tcelemstate)) {
      				 tcelemstate[uid]= new Array();
      				 tcelemstate[uid][allchildrenArray[i]]= new Array();
      			}
      			if (!array_key_exists(allchildrenArray[i],tcelemstate[uid])) {
      				 tcelemstate[uid][allchildrenArray[i]]= new Array();
      			}
	    		
    			if (tcelemstate[uid][allchildrenArray[i]]['visible']==1) {
    				document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display= 'block';
				} else {
					document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display= 'none';
					tcelemstate[uid][allchildrenArray[i]]['visible']=0;
				}
    			//restore expansionstate of child
    			elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]);
				if (elemicon) {
	    			if (tcelemstate[uid][allchildrenArray[i]]['expanded']==1) {
	    				document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display= 'block';
	    				document.getElementById('tx-tc-cts-img-exp-0-' + allchildrenArray[i]).style.display= 'none';
	    			} else {
	    				document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display= 'none';
	    				document.getElementById('tx-tc-cts-img-exp-0-' + allchildrenArray[i]).style.display= 'block';
	    				tcelemstate[uid][allchildrenArray[i]]['expanded']=0;
	    			}
				} else{ 
					tcelemstate[uid][allchildrenArray[i]]['expanded']=2;   //is leave
				}
	    	}
	    }
	    document.getElementById('tx-tc-cts-img-exp-0-' + uid).style.display= 'none';
	    document.getElementById('tx-tc-cts-img-exp-1-' + uid).style.display= 'block';
	} else {
		//collapse
		for (var i = 0; i < childrenArray.length; i++) {
	    	childrenArray[i]=tctrim(childrenArray[i]);
	    	if (tcisInt(childrenArray[i])){
    			document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + childrenArray[i]).style.display= 'none';
    			tctreestate[childrenArray[i]]=expand;
    			//store visiblitystate of child
    			if (!array_key_exists(uid,tcelemstate)) {
     				 tcelemstate[uid]= new Array();
     				 tcelemstate[uid][childrenArray[i]]= new Array();
     			}
     			if (!array_key_exists(childrenArray[i],tcelemstate[uid])) {
     				 tcelemstate[uid][childrenArray[i]]= new Array();
     			}
     			
    			tcelemstate[uid][childrenArray[i]]['visible']=0;
    			//store expansionstate of child
    			elemicon = document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]);
				if (elemicon) {
	    			if (document.getElementById('tx-tc-cts-img-exp-1-' + childrenArray[i]).style.display== 'block') {
	    				tcelemstate[uid][childrenArray[i]]['expanded']=1;
	    			} else {
	    				tcelemstate[uid][childrenArray[i]]['expanded']=0;
	    			}
				} else{ 
					tcelemstate[uid][childrenArray[i]]['expanded']=2;   //is leave
				}
	    	}
	    }
	    for (var i = 1; i < allchildrenArray.length; i++) {
	    	allchildrenArray[i]=tctrim(allchildrenArray[i]);
	    	if  (tcisInt(allchildrenArray[i])){
		    		if (!array_key_exists(uid,tcelemstate)) {
	     				 tcelemstate[uid]= new Array();
	     				 tcelemstate[uid][allchildrenArray[i]]= new Array();
	     			}
	     			if (!array_key_exists(allchildrenArray[i],tcelemstate[uid])) {
	     				 tcelemstate[uid][allchildrenArray[i]]= new Array();
	     			}
	    			if (document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display!='none') {
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
    	    			if (document.getElementById('tx-tc-cts-img-exp-1-' + allchildrenArray[i]).style.display== 'block') {
    	    				tcelemstate[uid][allchildrenArray[i]]['expanded']=1;
    	    			} else {
    	    				tcelemstate[uid][allchildrenArray[i]]['expanded']=0;
    	    			}
    				} else{ 
    					tcelemstate[uid][allchildrenArray[i]]['expanded']=2;   //is leave
    				}
	    			document.getElementById('tx-tc-cts-ct-tx-tc-cts_' + allchildrenArray[i]).style.display= 'none';
	    	}
	    }
	    document.getElementById('tx-tc-cts-img-exp-1-' + uid).style.display= 'none';
	    document.getElementById('tx-tc-cts-img-exp-0-' + uid).style.display= 'block';
	}
}
function tcsroc (uid){
	document.getElementById('tx-tc-cropped-' + uid).style.display='inline';
	document.getElementById('tx-tc-acropped-' + uid).style.display='none';
}
function updatecommentscount (cid, addval){
	var elem=document.getElementById('tx-tc-ct-cnt-' + cid);
	if (elem) {
		var elemarr = elem.innerHTML.split(" ");
		var countval=tctrim(elemarr[0].substr(elemarr[0].indexOf('>')+1));
		var newval = eval(countval+addval);
		elemarr[0]='<span>' + newval;
		var eleminnerHTML = elemarr.join(" ");
		jQuery('#tx-tc-ct-cnt-' + cid).html(eleminnerHTML);
		if (newval<=confcommentsPerPage) {
			var elema=document.getElementById('tx-tc-cts-ctsbrowse-hide-' + cid);
			if (elema) {
				jQuery('#tx-tc-cts-ctsbrowse-hide-' + cid).css('display', 'none');
			}
			var elemb=document.getElementById('tx-tc-cts-ctsbrowse-' + cid);
			if (elemb) {
				if (tctrim(elemb.innerHTML)=='') {
						jQuery('#tx-tc-cts-ctsbrowse-' + cid).css('display', 'none');
				}
			}
		}
	} 
	return 0;
	
}
function toctoc_comments_pi1_getUploadData(icid) {
    var toctoc_piVars = new Array();
    toctoc_piVars['firstname'] = toctoc_comments_pi1_getUserDataField('firstname',icid);
    toctoc_piVars['lastname'] = toctoc_comments_pi1_getUserDataField('lastname',icid);
    toctoc_piVars['location'] = toctoc_comments_pi1_getUserDataField('location',icid);
    toctoc_piVars['email'] = toctoc_comments_pi1_getUserDataField('email',icid);
    toctoc_piVars['homepage'] = toctoc_comments_pi1_getUserDataField('homepage',icid);
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
function tcfilechange_delayed(id, lang, fuppreviewheight,ajaxData,ajaxDataAtt){
	window.setTimeout("tcfilechange('"+id+"', '" +lang+"', '" +fuppreviewheight+"', '" +ajaxData+"', '" +ajaxDataAtt+"')", 600);
	return; 
	
}
function tcfilechange(id, lang, fuppreviewheight,ajaxData,ajaxDataAtt){
	
	var informid='cf' + id;
	var ininputpicid='toctoc_comments_pi1_' + id + 'uploadpicid';
	var ininputpicidh='toctoc_comments_pi1_' + id + 'uploadpicheight';
	var ininputpicname='toctoc_comments_pi1_' + id + 'originalfilename';
	var inthisname='toctoc_comments_pi1_' + id + 'uploadpic';
	var inthisajax='toctoc_comments_pi1_' + id + 'ajax';
	var inupldiv='tx-tc-' + id + 'uploaddiv';
	var lineheightupload = 8;
	
	var previewarr = new Array();
	previewarr['lang']=lang;
	previewarr['commentid']=window['previewfpcountnr' + id] ;
	previewarr['fuppreviewheight']=fuppreviewheight;
	
	var str1=toctoc_comments_pi1_serialize(previewarr);
	var ajaxpreviewopened=toctoc_comments_pi1_base64_encode(str1);
	
	var inthis= document.getElementById(inthisname);
    var previewidfup='';
    var previewfupdir='';
    var previewfupheight=0; 
    var textmsg ='';
    var ispicupload=true;
	if(uploadtype=='pdf') {
		ispicupload=false;
	}
	var pathimarr= new Array();
	pathimarr['path']=utf8_decode(tcb64_dec(pathim));
	var inthishiddenajax = document.getElementById(inthisajax);
	inthishiddenajax.value= ajaxDataAtt;

	var ininputpicidvalelem = document.getElementById(ininputpicid);
	var ininputpicidvalelemh = document.getElementById(ininputpicidh);
	var ininputpicnameelem = document.getElementById(ininputpicname);
	
	
    if( inthis.files ){
	  //files supported (HTML5)
    	var file = inthis.files[0];  
		var fname = file.name;
		var fsize = file.size;
		var ftype = file.type;
		if(file.name.length < 1) {
			  return false;
		  }
		  else if (uploadtype=='pic') {
			  if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg') {
				  textmsg = utf8_decode(tcb64_dec(textPicFiletypeErr));
				  information(textmsg,id, function () {});
				  return false;
			  }
			  if(file.size > picUploadMaxfilesize) {
				  textmsg = utf8_decode(tcb64_dec(textPicFileToBig));
				  information(textmsg,id, function () {});
				  return false;
			  }
		  }
		  else if (uploadtype=='pdf') {
			  if(file.type != 'application/pdf' && file.type != 'application/x-pdf' ) {
				  textmsg = utf8_decode(tcb64_dec(textpdfFiletypeErr));    		    	
				  information(textmsg,id, function () {});
				  return false;
			  }
			  if(file.size > pdfUploadMaxfilesize) {
				  textmsg = utf8_decode(tcb64_dec(textPdfFileToBig));
				  information(textmsg,id, function () {});
			      return false;
			  }
		}
		var oData = new FormData(document.forms.namedItem('n' + informid));
		
		oData.append("myfile", file);
		oData.append("toctoc_comments_pi1[pathim]", pathimarr['path']);
		oData.append("toctoc_comments_pi1[configbaseURL]", utf8_decode(tcb64_dec(configbaseURL)));
		window['previewstartedfp' + id] = 1;
		setopacity('toctoc_comments_pi1_submit_' + id,'0.4','tcfilechange');	 
		jQuery('#' + inupldiv).css('display', 'none');
		jQuery('#tx-tc-form-fup-working' + id).css('display', 'block');
		jQuery.ajax({
		  	  url: utf8_decode(tcb64_dec(configbaseURL)) + "typo3conf/ext/toctoc_comments/pi1/class.toctoc_comments_attachmentupload.php",
		  	  type: "POST",
		  	  data: oData,
		  	  async: false,
		  	  success: function(data){
		  			dataarr=data.split('<br>');
		  			previewidfup=dataarr[0];
		  			previewfupdir=dataarr[1];
		  			previewfupheight=dataarr[2];
		  			window['previewstartedfp' + id] = 2;
		  			   			
		  	  },
		  	  processData: false,  // tell jQuery not to process the data
		  	  contentType: false   // tell jQuery not to set contentType
		 });

    } else {
	  //.files not supported
    	alert ("Your browser supports no HTML5 uploads (files not supported)");
	}

	
	jQuery('#tx-tc-form-dp-fup-' + id).css('display', 'none');
	jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', '0px');
	jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', '0px');
	jQuery('#tx-tc-form-fup-working' + id).css('display', 'none');
	
	if (window['previewstartedfp' + id] == 2) {
		document.getElementById('tx-tc-cts-previewfup-' + id).src=previewfupdir+previewidfup;
		document.getElementById('formhider-' + id).style.height = eval(eval(document.getElementById('formhider-' + id).offsetHeight) + eval(parseInt(previewfupheight)+parseInt(lineheightupload))) + 'px';
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
			
			if (document.getElementById('toctoc_comments_pi1_uplcontenttextbox_' + id).value=='') {
				jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).watermark(utf8_decode(tcb64_dec(textpdfdescribe)) + ' \"' + fname + '\"', {left: 0, top: 0, fallback: true});		
			}
	
		} else {
			document.getElementById('tx-tc-cts-nopreviewfup-' + id).title=utf8_decode(tcb64_dec(textclosepicupload));
			if (document.getElementById('toctoc_comments_pi1_uplcontenttextbox_' + id).value=='') {
				jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).watermark(utf8_decode(tcb64_dec(textimagedescribe)) + ' \"' + fname + '\"', {left: 0, top: 0, fallback: true});		
			}
		}
	  
		previewfuph=eval(parseInt(previewfupheight)+parseInt(lineheightupload));
		jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', previewfuph+'px');
		jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', previewfuph+'px');
		
		jQuery('#' + inupldiv).css('display', 'none');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('display', 'block');
		window['previewstartedfp' + id] = 3;
		window['previewfpheight' + id] = previewfupheight;
		ininputpicidvalelem.value=previewidfup;
		ininputpicidvalelemh.value=previewfupheight;
		ininputpicnameelem.value=fname;
	}
	else 
	{
		jQuery('#tx-tc-form-dp-fup-' + id).css('display', 'none');
		jQuery('#tx-tc-form-dp-fup-' + id).css('min-height', '0px');
		jQuery('#tx-tc-form-dp-fup-' + id).css('max-height', '0px');
		jQuery('#tx-tc-cts-fuppicprv-' + id).css('display', 'none');
		jQuery('#tx-tc-cts-fupta-' + id).css('display', 'none');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('max-height', '0px');
		jQuery('#' + inupldiv).css('display', 'block');
		jQuery('#toctoc_comments_pi1_uplcontenttextbox_' + id).css('display', 'none');
	
		window['previewstartedfp' + id] = 0;
		window['previewfpheight' + id] = 0;
		ininputpicidvalelem.value='';
		ininputpicidvalelemh.value='0';
		ininputpicnameelem.value='';
		jQuery('#tx-tc-cts-nopreviewfup-' + id).css('display', 'none');
	}
	setopacity('toctoc_comments_pi1_submit_' + id,'1','tcfilechange');
	return true;   
    
}
var tclocaltimediff = 0;
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
		}

		if (difference_of_times > (unit_size - 1)) {
			var modulus_for_time_difference = difference_of_times % unit_size;
			var seconds_for_current_unit = difference_of_times - modulus_for_time_difference;
			var units_calculated = seconds_for_current_unit / unit_size;
			difference_of_times = modulus_for_time_difference;
			if (stringcollator<2) {
				if (units_calculated==1) {
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
		if (difference_of_times==1) {
			time_difference_string += difference_of_times + ' ' + utf8_decode(tcb64_dec(pi1_templatetimeconvsecond)) + ' ';
		} else {
			time_difference_string += difference_of_times + ' ' + utf8_decode(tcb64_dec(pi1_templatetimeconvseconds)) + ' ';
		}
	}

	var retstr= tctrim(utf8_decode(tcb64_dec(pi1_templatetimeconvtextbefore)) + ' ' + time_difference_string + utf8_decode(tcb64_dec(pi1_templatetimeconvtextafter)));
	retstr= retstr.replace(/-/g,'');
	return retstr;
}
var checkdatedelay=200;
var tcservertime = 0;

var noajaxreply=0;
function check_dates() {
	var j=0;
	var tstampdate=0;
	var addmiddot ='';
	var newformatdate='';
	if (tcservertime != 0) {
		// reply from ajax is here
		var cdstart =Math.round(new Date().getTime());
		for (var i = tccommnetidstart ; i < tccommnetidto ; i++) {
			elem= document.getElementById('tx-tc-ctdatetime-' + i);
		 	if (elem) {
		 		tstampdate=elem.innerHTML;
		 		newformatdate=tcformatnewdate(tstampdate);
		 		elemdisp= document.getElementById('tx-tc-ctdatedisp-' + i);
		 		addmiddot ='';
		 		
			 	if (elemdisp) {
			 		//console.log(elemdisp.innerHTML);
			 		if (elemdisp.innerHTML.indexOf('&nbsp;')>1) {
			 			addmiddot ='&nbsp;&middot;&nbsp;';	
			 			//console.log('ok');
			 		}
			 		elemdisp.innerHTML=newformatdate + addmiddot;
			 		j++;
			 	}
			}
		}
		for (var i = tccommnetidstart ; i < tccommnetidto ; i++) {
			elem= document.getElementById('tx-tc-rctdatetime-' + i);
		 	if (elem) {
		 		tstampdate=elem.innerHTML;
		 		newformatdate=tcformatnewdate(tstampdate);
		 		elemdisp= document.getElementById('tx-tc-rctdatedisp-' + i);
		 		addmiddot ='';
		 		
			 	if (elemdisp) {
			 		if (elemdisp.innerHTML.indexOf('&nbsp;')>1) {
			 			addmiddot ='&nbsp;&middot;&nbsp;';	
			 		}
			 		elemdisp.innerHTML=newformatdate + addmiddot;
			 		j++;
			 	}
			}
		}
		cdtime = Math.round(new Date().getTime()) - cdstart;
	}
	
	if (checkdatedelay==200) {
		if (tcservertime != 0) {
			checkdatedelay=500;
		} else {
			noajaxreply++;
			if (noajaxreply>100) {
				console.log('exit waiting for AJAX, no reply');
				return true;
			}
		}
		window.setTimeout("check_dates()", checkdatedelay);
		
	} else {
		if (j==0) {
			return true;
		}
		checkdatedelay=60000;
		window.setTimeout("check_dates()", checkdatedelay);
	}
}
if (tcdateformat==0) {
	jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: true,
        data: 'ref=' + 0 + '&cmd=gettime',
        success: function(html){
        	tcservertime = html;
        	tclocaltimediff = Math.round(new Date().getTime() / 1000) - tcservertime;
        }
    });
	check_dates();
}
if (tcsmiliecard) {
var tcsmiliecardhtml=utf8_decode(tcb64_dec(tcsmiliecard)); 
}
var lastemojicid='';
function selectemoji(cid) {
	if (lastemojicid ==cid) {
		document.getElementById('tx-tc-smilie-popup-' + lastemojicid).style.display="none";	
		document.getElementById('tx-tc-smilie-popup-' + lastemojicid).innerHTML='';
		
		smilieselectorttooltip = ' title="' + utf8_decode(tcb64_dec(textAddemoji))+'"';
		document.getElementById('tx-tc-smilie-iconlink-' + lastemojicid).innerHTML='<div class="tx-tc-smilie-icon" id="tx-tc-smilie-icon-' + lastemojicid + '" ' + smilieselectorttooltip + '></div>';
		tttip('t101',"#tx-tc-smilie-icon-" + lastemojicid + "[title]");
		lastemojicid='';
		return;
		
	}
	if (lastemojicid !='') {			
		document.getElementById('tx-tc-smilie-popup-' + lastemojicid).style.display="none";	
		document.getElementById('tx-tc-smilie-popup-' + lastemojicid).innerHTML='';
		smilieselectorttooltip = ' title="' + utf8_decode(tcb64_dec(textAddemoji))+'"';

		document.getElementById('tx-tc-smilie-iconlink-' + lastemojicid).innerHTML='<div class="tx-tc-smilie-icon" id="tx-tc-smilie-icon-' + lastemojicid + '" ' + smilieselectorttooltip + '></div>';
		
		tttip('t101',"#tx-tc-smilie-icon-" + lastemojicid + "[title]");
		
		lastemojicid='';

	}
	document.getElementById('tx-tc-smilie-popup-' + cid).innerHTML=tcsmiliecardhtml;
	document.getElementById('tx-tc-smilie-popup-' + cid).style.display="block";
	smilieselectorttooltip = ' title="' + utf8_decode(tcb64_dec(textCloseemoji))+'"';
	document.getElementById('tx-tc-smilie-iconlink-' + cid).innerHTML='<div class="tx-tc-smilie-icon open" id="tx-tc-smilie-icon-' + cid + '" ' + smilieselectorttooltip + '></div>';
	tttip('t101',"#tx-tc-smilie-icon-" + cid + "[title]");

	lastemojicid=cid;
}
function remove_fup_pic(id,previewopenedprogress,fuppreviewheight,ajaxData,ajaxDataAtt) {
	var result=0;
	var informid='cf' + id;
	var ininputpicid='toctoc_comments_pi1_' + id + 'uploadpicid';
	var ininputpicidh='toctoc_comments_pi1_' + id + 'uploadpicheight';
	var ininputpicname='toctoc_comments_pi1_' + id + 'originalfilename';
	var inthisname='toctoc_comments_pi1_' + id + 'uploadpic';
	var inupldiv='tx-tc-' + id + 'uploaddiv';
	var lineheightupload=8;
	var tmpthumbheight=fuppreviewheight;
	// send to server the cid and clean up temp 
    var previewarr = new Array();
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
        data: 'ref=' + id + '&data=' + ajaxpreviewopenurl + '&cmd=cleanupfup' + '&dataconf=' + ajaxData + '&dataconfatt=' + ajaxDataAtt + '&previewid=' + ininputpicidvalelem.value + '&originalfilename=' + originalfilename,
        success: function(html){
        }
    });
	document.getElementById('tx-tc-cts-previewfup-' + id).src='';
	jQuery('#' + inupldiv).css('display', 'block');	
	document.getElementById('formhider-' + id).style.height = eval(eval(document.getElementById('formhider-' + id).offsetHeight) - eval(parseInt(tmpthumbheight)+parseInt(lineheightupload))) + 'px';
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
	window['previewstartedfp' + id] = 0;
	window['previewfpheight' + id] = 0;
	return true;     
}	
function emoselpage (idshow,idhide) {
      document.getElementById('tx-tc-emopage-' + idhide).style.display = "none";
      document.getElementById('tx-tc-emopage-' + idshow).style.display = "block";
}
var replacedlen=0;
function insertemoji(emojiid) {
	if (emojiid.substr(0,1)=='u') {
		//emojicode
		emojiid=emojiid.replace(/-/g,'%');
		emojiid = '%' + emojiid;
		tmpcontent =  unescape(emojiid);
        if (tmpcontent.substr(0,2)=='%u') {
        	  tmpcontent = tmpcontent.substr(2);
  		}
        emojiid=tmpcontent; 
	} else {
		if (emojiid.substr(0,2)=='-u') {
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
	if (cidtestarr.length==3) {
		 topcid=cidtestarr[1];
	}
	var taelem=document.getElementById('toctoc_comments_pi1_contenttextbox_' + lastemojicid);
	var taid='toctoc_comments_pi1_contenttextbox_' + lastemojicid;
	
	//tx-tc-ct-ry-rl-492
	var taelemtest=document.getElementById('tx-tc-ct-ry-rl-'+topcid);
	var forcecommenteditbox=0;
	if(taelemtest) {
		if(taelemtest.style.display=='none') {
			forcecommenteditbox=1;
		}
	}
	if ((!taelem) || (forcecommenteditbox==1)) {
		taelem=document.getElementById('toctoc_comments_pi1_contenttextboxc_' + topcid);
		taid='toctoc_comments_pi1_contenttextboxc_' + topcid;
	}
	if (taelem) {
		taelem.focus();
		var newvalue= taelem.value.substr(0,this.caretposstart) + emojiid + taelem.value.substr(this.caretposend) ;
		replacedlen=emojiid.length;
		if ((getInternetExplorerVersion()>0)) {
			if (taelem.value =='') {
				window.setTimeout("set_emoji_delayed('"+taid+"', '"+newvalue+"')", 600);
				return; 
			} 
		} 
		taelem.value = 	newvalue;
		this.caretposstart=eval(this.caretposstart+emojiid.length);
		this.caretposend=this.caretposstart;
		setCursorPos(taelem, this.caretposstart, this.caretposend); 
		
	} 
}
function set_emoji_delayed(taelemstr,tavalue) {
	//alert(taelemstr);
	taelem=document.getElementById(taelemstr);
	taelem.value = 	tavalue;
	this.caretposstart=eval(this.caretposstart+replacedlen);
	this.caretposend=this.caretposstart;
	setCursorPos(taelem, this.caretposstart, this.caretposend); 
}
jQuery.fn.autoGrow = function(){
    return this.each(function(){
        var heightDefault = this.offsetHeight;
        //Functions
        var grow = function() {
            if (this.offsetHeight!=heightDefault) {
                deltah =eval(this.offsetHeight-heightDefault);                
                nodename = this.parentNode.id;
                formhiderdivid='formhider-' + nodename.substr(9,100); 
                newmargin='0';
                document.getElementById(formhiderdivid).style.margin = newmargin;
                heightDefault=this.offsetHeight;
                
                pushmain(deltah,1);
            }
        }
    });
};