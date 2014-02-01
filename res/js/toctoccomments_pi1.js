function toctoc_comments_pi1_base64_encode (data) {
    // Encodes string using MIME base64 algorithm  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/base64_encode    // +   original by: Tyler Akins (http://rumkin.com)
    // +   improved by: Bayron Guevara
    // +   improved by: Thunder.m
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Pellentesque Malesuada    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Rafa? Kukawski (http://kukawski.pl)
    // -    depends on: utf8_encode
    // *     example 1: base64_encode('Kevin van Zonneveld');
    // *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='    // mozilla has this native
    // - but breaks in 2.0.0.12!
    //if (typeof this.window['atob'] == 'function') {
    //    return atob(data);
    //}    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
        ac = 0,
        enc = "",
        tmp_arr = []; 
    if (!data) {
        return data;
    }
     data = this.utf8_encode(data + '');
 
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
    // Encodes an ISO-8859-1 string to UTF-8  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/utf8_encode    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: sowberry
    // +    tweaked by: Jack
    // +   bugfixed by: Onno Marsman    // +   improved by: Yves Sucaet
    // +   bugfixed by: Onno Marsman
    // +   bugfixed by: Ulrich
    // +   bugfixed by: Rafal Kukawski
    // *     example 1: utf8_encode('Kevin van Zonneveld');    // *     returns 1: 'Kevin van Zonneveld'
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
    // Returns a string representation of variable (which can later be unserialized)  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/serialize    // +   original by: Arpad Ray (mailto:arpad@php.net)
    // +   improved by: Dino
    // +   bugfixed by: Andrej Pavlovic
    // +   bugfixed by: Garagoth
    // +      input by: DtTvB (http://dt.in.th/2008-09-16.string-length-in-bytes.html)    // +   bugfixed by: Russell Walker (http://www.nbill.co.uk/)
    // +   bugfixed by: Jamie Beck (http://www.terabit.ca/)
    // +      input by: Martin (http://www.erlenwiese.de/)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
    // +   improved by: Le Torbi (http://www.letorbi.de/)    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net/)
    // +   bugfixed by: Ben (http://benblume.co.uk/)
    // -    depends on: utf8_encode
    // %          note: We feel the main purpose of this function should be to ease the transport of data between php & js
    // %          note: Aiming for PHP-compatibility, we have to translate objects to arrays    // *     example 1: serialize(['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: 'a:3:{i:0;s:5:"Kevin";i:1;s:3:"van";i:2;s:9:"Zonneveld";}'
    // *     example 2: serialize({firstName: 'Kevin', midName: 'van', surName: 'Zonneveld'});
    // *     returns 2: 'a:3:{s:9:"firstName";s:5:"Kevin";s:7:"midName";s:3:"van";s:7:"surName";s:9:"Zonneveld";}'
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
}

function toctoc_comments_pi1_getUserDataField(name,icid) {
    var    field = document.getElementById('toctoc_comments_pi1_' + icid + name);
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
function toctoc_comments_pi1_getUserData(icid) {
    toctoc_piVars = new Array();
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
    toctoc_piVars['notify'] = toctoc_comments_pi1_getUserDataField('notify',icid);
    
    var    field = document.getElementById('toctoc_comments_pi1_submit_' + icid);
    toctoc_piVars['submit'] = field.value;    
    var    field = document.getElementById('toctoc_comments_pi1_contenttextbox_' + icid);
    toctoc_piVars['content'] = field.value;
    str1=this.toctoc_comments_pi1_serialize(toctoc_piVars);
    str2=this.toctoc_comments_pi1_base64_encode(str1);
    return str2;
}
function pushmain(IpushmainH,makewindowresize) {
	//placeholder function for resize of dependent controlls
	//IpushmainH :  offsetHeift-Difference as px
	if (makewindowresize==1) {
		
	}
}
function comment_formhider(cidcomments, showhider, textaddcomment, loggedon, makewindowresize , thisin) {
    // optional: textaddcomment: ###TEXT_ADD_COMMENT###
    // loggedon, makewindowresize: 1/0
	var tamargin = '';
	var submitmargin='';
	var tainitmargin = '0';
	
    if (loggedon==1){
        tamargin = '0 0 0 42px';
        submitmargin='-2px 0 3px 44px';
    }    
    else
    {
        tamargin = '0';
        submitmargin='4px 0 5px 134px';
    }
    
    
    if (showhider==1) {
        thisin.focus();
    }
    else 
    {
    	var thishider = document.getElementById('formhider-' + cidcomments);
    	var thisuserimg = document.getElementById('tx-toctoc-comments-uimg-' + cidcomments);
    	var thistextarea =document.getElementById('textarea-' + cidcomments);
    	var thissubmit =document.getElementById('toctoc_comments_pi1_submit_' + cidcomments);
    	var thisformsqueezer =document.getElementById('tx-toctoc-comments-formsqueezer-' + cidcomments);
    	var pushmainH=0;
    }
    if (showhider==2) {
        //onblur
            var thiscontenttextbox = document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments);
            
            thistextarea.style.margin = tainitmargin;
            
            if (thiscontenttextbox) {
                checklen = this.tctrim(textaddcomment).length;
                checkfield = this.tctrim(thiscontenttextbox.value);
                checkfield2 = checkfield.substr(0,checklen);                
                if ((checkfield2 == this.tctrim(textaddcomment)) || (checkfield=='')) {
                    //addon to elastic.js
                	thiscontenttextbox.style.height = '20px';
                }
            }

            thissubmit.style.visibility = 'hidden';
            thissubmit.style.height = 0; 
            thissubmit.style.margin = 0;
            
            pushmainH = eval(-1 * thishider.offsetHeight);
            thishider.style.visibility = 'hidden';            
            thishider.style.height = 0;
            thishider.style.minHeight = 0;
            thishider.style.margin ="-112px 0 0";
            
            thisformsqueezer.style.height = '32px';

            if (loggedon==1){
                thisuserimg.style.visibility = 'hidden';
                thisuserimg.style.margin='-32px 0 0';
                thishider.style.margin ="-32px 0 0";
            }
            
            pushmain(pushmainH,makewindowresize);

    };
    if (showhider==3) {
    //onFocus=
            thistextarea.style.margin = tamargin;
            
            thissubmit.style.visibility = 'visible';
            thissubmit.style.height = 'auto'; 
            thissubmit.style.margin = submitmargin;
            
            thishider.style.height = '';    
            thishider.style.minHeight = '';    
            thishider.style.margin ="0";
            thishider.style.visibility = 'visible';
            thishider.style.height = thishider.offsetHeight + "px";
    
            thisformsqueezer.style.height = '';
            
            minheight=thistextarea.style.minHeight;
            minheightval=minheight.substr(0,minheight.indexOf("p"));
            taoffsetheight=thistextarea.offsetHeight
            var deltah=0;
            var oldmargin='';
            var oldmarginval=0;
            var oldmarginval=0;
            var newmargin='';
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
                newmargin='0px';
                thishider.style.margin = newmargin;
            }
            
            if (loggedon==1){
                thisuserimg.style.visibility = 'visible';
                thisuserimg.style.margin='4px 0 0 0';
            }
            
            pushmain(eval(thishider.offsetHeight),makewindowresize);
    };
}
function commentform_validate(cidcomments, textemptyerror, texttoshorterror, requiredcommentlength) {
    if (document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments).value == "") {
        alert(textemptyerror);
        document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments).focus();
        return false;
    } 
    lenvalue = document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments).value.length;
    if (lenvalue < requiredcommentlength)
    {
        alert(texttoshorterror);
        document.getElementById('toctoc_comments_pi1_contenttextbox_' + cidcomments).focus();
        return false;
    } 
    return true;
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
function toctoc_comments_uc_fadeout (cssid) {
    opanow=document.getElementById(cssid).style.opacity;
    opanew=eval(opanow-0.1);
    if (opanew >= 0) {
        document.getElementById(cssid).style.opacity = opanew;
        window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "')", 50);
        
    } else {
    document.getElementById(cssid).style.visibility = 'hidden';
    document.getElementById(cssid).style.height = '0px';
        return true;
    }
}
function toctoc_comments_uc_show (timeout, cssid) {
    window.setTimeout("toctoc_comments_uc_fadeout('" + cssid + "')", timeout);
    return true;
}
function show_uc(commentid, cid, commentsAjaxData,toctocuid,imgstr,timeoutms) {    
    jQuery('#toctoc-comments-uc-' + commentid).css('opacity', '0.9');
    jQuery('#toctoc-comments-uc-' + commentid).css('height', '60px');
    jQuery('#toctoc-comments-uc-' + commentid).css('visibility', 'visible');
    if (document.getElementById('toctoc-comments-uc-inner-' + commentid).innerHTML.length < 20) {
        document.getElementById('toctoc-comments-uc-inner-' + commentid).innerHTML='';
        jQuery.ajax({
            type: 'POST',
            url: 'index.php',
            async: false,
            data: 'eID=toctoc_comments_ajax&cmd=getuc&imagetag=' + imgstr + '&toctocuserid=' + toctocuid + '&data=' + commentsAjaxData + '&cid=' + cid + '&commentid=' + commentid,
            success: function(html){
                jQuery('#toctoc-comments-uc-inner-' + commentid).html(html);
            }
        });
    }
    jQuery('#toctoc-comments-uc-' + commentid).css('opacity', '1');
    jQuery('#toctoc-comments-uc-' + commentid).css('visibility', 'visible');
    jQuery('#toctoc-comments-uc-' + commentid).css('height', 'auto');
    toctoc_comments_uc_show(timeoutms, 'toctoc-comments-uc-' + commentid);
 }
function toctoc_comments_delete(id, rating, ajaxData, check, action, cssident, datac, thisdata, capsess, cid) {
    jQuery('#tx-toctoc-comments-' + cssident + '-display-' + id).css('opacity', '0.6');
    jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + capsess + '&check=' + check + '&cmd=' + action + '&cid=' + cid,
        success: function(html){
            jQuery('#tx-toctoc-comments-' + cssident + '-' + id).html(html);
        }
    });
    jQuery('#tx-toctoc-comments-' + cssident + '-display-' + id).css('visibility', 'hidden');
} 
function toctoc_comments_denotify(id, rating, ajaxData, check, action, cssident, datac, thisdata, capsess, cid) {
    jQuery('#dnf' + capsess).css('opacity', '0.6');
    jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&cuid=' + capsess + '&check=' + check + '&cmd=' + action + '&cid=' + cid,
        success: function(html){
            jQuery('#dnf' + capsess).html(html); 
        }
    });
    jQuery('#dnf' + capsess).css('visibility', 'hidden');
} 
function toctoc_comments_browse(id, rating, ajaxData, check, action, cssident, datac, thisdata, startpoint, cid, totalrows,commentsImgs) {
    jQuery('#tx-toctoc-comments-comments-display-' + id).css('opacity', '0.7');
    jQuery.ajax({
        type: 'POST',
        url: 'index.php?eID=toctoc_comments_ajax',
        async: false,
        data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&startpoint=' + startpoint + '&check=' + check + '&cmd=' + action + '&cid=' + cid + '&totalrows=' + totalrows + '&commentsimgs=' + commentsImgs,
        success: function(html){
            jQuery('#tx-toctoc-comments-' + cssident + '-' + id).html(html);
        }
    });
    jQuery('#tx-toctoc-comments-comments-display-' + id).css('opacity', '1');
}
function toctoc_comments_submit(id, rating, ajaxData, check, action, cssident, datac, thisdata, capsess, cid, caperr,commentsImgs, loggedon, extid) {
    if ((cssident.indexOf("comment")>=0) || (cssident.indexOf("form")>=0)) {

        responsed=1;
        commentid = tctrim(id.substr(11,1000));  // ex.: tt_content_1016
        picress = '';
        picressshow ='';
        if (loggedon==true) {
            picressorig = document.getElementById('tx-toctoc-comments-uimg-' + commentid).outerHTML;
            picress = picressorig.replace('visible','hidden');
        } 
        if (capsess=='1') {
            response=0;            
            capsess = document.getElementById('toctoc_comments_pi1-captcha-' + cid).value;
            jQuery('#toctoc_comments_captcha_' + cid).css('opacity', '0.6');
            responsed=0;
            jQuery.ajax({
                type: 'POST',
                url: 'index.php?eID=toctoc_comments_ajax',
                async: false,
                data: 'cmd=checkcap&cid='+ cid + '&code='+capsess,
                success: function(response){
                    if(response==1)    {
                        jQuery('#toctoc_comments_captcha_' + cid).css('opacity', '1');
                        responsed=1;    
                    }
                    else
                    {
                        
                        jQuery("#tx-toctoc-comments-captcha-message-" + cid).html(''  + caperr);                
                        jQuery('#toctoc_comments_captcha_' + cid).css('opacity', '1');
                        responsed=0;
                    }
                }
            });
            
        }
        if (responsed==1) {
            htmlretcode=0;
            jQuery('#tx-toctoc-comments-' + cssident + '-display-' + extid).css('opacity', '0.6');
            jQuery.ajax({
                type: 'POST',
                url: 'index.php?eID=toctoc_comments_ajax',
                async: false,
                data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=' + capsess + '&check=' + check + '&cmd=' + action + '&userpic=' + picress+ '&extref='  + extid,
                success: function(html){
                    htmlretcode= tctrim(html.substr(8,20));
                    //alert(htmlretcode);
                    posenddiv= htmlretcode.indexOf(">");
                    htmlretcode= htmlretcode.substr(0,posenddiv);
                    if (!tcisInt(htmlretcode)) {
                        htmlretcode=0;
                    } else {
                        replstr='<div id=' + htmlretcode + '></div>';
                        html = html.replace(replstr,'');
                    }
                    jQuery('#tx-toctoc-comments-' + cssident + '-' + extid).html(html);
                }
            });
            jQuery('#tx-toctoc-comments-' + cssident + '-display-' + extid).css('opacity', '1');
            // check if the insert wwas omk and only if...
            if(htmlretcode != 0)    {
                if (loggedon== true) {
                    strnew = 'tx-toctoc-comments-comments-img-' + commentid;
                    strold = 'tx-toctoc-comments-uimg-' + cid;
                    picressshow = picressorig.replace(strold,strnew);
                    picressshow = picressshow.replace(' margin: 4px 0px 0px;','');
                    picressshow = picressshow.replace('align="left" ','');
                }
                
                jQuery('#tx-toctoc-comments-comments-display-' + extid).css('opacity', '0.6');
                jQuery.ajax({
                    type: 'POST',
                    url: 'index.php?eID=toctoc_comments_ajax',
                    async: false,
                    data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&datac=' + datac + '&datathis=' + thisdata + '&capsess=' + capsess + '&check=' + check + '&cmd=showcomments'  + '&userpic=' + picressshow + '&commentsimgs=' + commentsImgs,
                    success: function(html){
                        jQuery('#tx-toctoc-comments-comments-' + extid).html(html);
                    }
                });
                jQuery('#tx-toctoc-comments-comments-display-' + extid).css('opacity', '1');
            }
        } 
    }    
    else if (((cssident=='myratingstop') || (cssident=='myratings')) && (id.indexOf("toctoc_comments_comments")==-1)) {
        // concerns only Like-Dislike in the commentsbox top
        
        taction = 'like';
        if (action.indexOf("unlike")>=0) {
            taction = 'unlike';
        }    
        topaction= 'liketop';
        if (action.indexOf("unlike")>=0) {
            topaction = 'unliketop';
        }
        jQuery('#tx-toctoc-comments-myratingstop-display-' + id).css('opacity', '0.8');
        jQuery('#tx-toctoc-comments-myratings-display-' + id).css('opacity', '0.6');
        jQuery.ajax({
            type: 'POST',
            url: 'index.php?eID=toctoc_comments_ajax',
            async: false,
            data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + taction,
            success: function(html){
                jQuery('#tx-toctoc-comments-myratings-' + id).html(html);
            }
            });
        jQuery('#tx-toctoc-comments-myratingstop-display-' + id).css('opacity', '0.6');
        jQuery.ajax({
            type: 'POST',
            url: 'index.php?eID=toctoc_comments_ajax',
            async: true,
            data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + topaction,
            success: function(html){
                jQuery('#tx-toctoc-comments-myratingstop-' + id).html(html);
            }
            });
    } else {
        // concerns rest of voting
        
        jQuery('#tx-toctoc-comments-' + cssident + '-display-' + id).css('opacity', '0.6');
        jQuery.ajax({
            type: 'POST',
            url: 'index.php?eID=toctoc_comments_ajax',
            async: true,
            data: 'ref=' + id + '&rating=' + rating + '&data=' + ajaxData + '&check=' + check + '&cmd=' + action,
            success: function(html){
                jQuery('#tx-toctoc-comments-' + cssident + '-' + id).html(html);
            }
        });
    }
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