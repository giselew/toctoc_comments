function visiblizeReportOptionsIntAjax(t,c){!function(s){var e=1;if(s("#subpaneltitle"+t).css("color",""),1==c){var o="#txtcbe-ajaxtablereports";""!=reportssave[t]?(s(o).html(reportssave[t]),s("#subpaneltitle"+t).css("color","#5475c8"),e=0):s("#jscleaning").html("")}lastreportindex=t;var a=document.getElementById("rep"+t+"options");if(a){for(a.style.display="block",a=document.getElementById("showreport"+t),a&&(a.style.background="#c4c4c4"),i=1;i<=numofreports;i++)i!=t&&(a=document.getElementById("rep"+i+"options"),a&&(a.style.display="none"),a=document.getElementById("showreport"+i),a&&(a.style.background=""));a=document.getElementById("repsubmit"),a&&(a.style.display="block")}else for(i=1;i<=numofreports;i++)a=document.getElementById("rep"+i+"options"),a&&(a.style.display="none"),a=document.getElementById("showreport"+i),a&&(a.style.background=""),a=document.getElementById("repsubmit"),a&&(a.style.display="none");0==e&&(txtcinittablesorter(),tablesorteraddons())}(jQuery,window)}function bindbulkact(t){!function(c){tccid=t.id;var s,e="",o="",a="",l="",n="",r="",d="",x="",p="refresh=1&fromajax=1",m=String(tccid).split("6g9");c(t).css("opacity","0.6"),d=m[1];var b="#txtcbe-ajaxloadingreport"+d;"actreport"==m[0]&&c(b).css("display","block"),m[0].replace("actmul","")!=String(m[0])&&(p+="&actadmincommand1=1&admincommand=1&actmul=Go",d="&bulkact="+d,e="comments"),m[0].replace("actuser","")!=String(m[0])&&(p+="&actadmincommand2=1&admincommand=2&admincommand2=1&actuser=Go",d="&bulkactuser="+d,s=document.getElementById("mergeuser"),n="&mergeuser="+s.value,r=s.value,e="users");var u="#txtcbulkstatus",h="";l=c("form input:checkbox").serialize(),l=l.replace(/fields%5B%5D=/g,""),l=l.replace(/&/g,"-"),(m[0].replace("actreport","")!=String(m[0])||m[0].replace("bulkactreps","")!=String(m[0]))&&(m[0].replace("bulkactreps","")!=String(m[0])?x=1:(s=document.getElementById("optreport6g9"+d),x=s?s.value:0),"undefined"==x&&(x=0),x||(x=0),e="reports",m[0].replace("bulkactreps","")!=String(m[0])?(p+="&admincommand=4&actadmincommand4=1&repsubmit=Go&optreport="+x,p+="&admincommand41=41&actadmincommand41=1",d="&bulkactreport=1&bulkactreps="+d,u="#txtcbulkstatus",l=c("form input:checkbox").serialize(),h=l.replace(/fields%5B%5D=/g,""),h=h.replace(/&/g,"7g87g8"),l=h):(p+="&admincommand=4&actadmincommand4=1&repsubmit=Go&optreport="+x,2==d&&(s=document.getElementById("activeuserreportsince"),p+="&activeuserreportsince="+s.value,s=document.getElementById("activeuserreportto"),p+="&activeuserreportto="+s.value,s=document.getElementById("activeuserreporttimedays"),p+="&activeuserreporttimedays="+s.value),d="&bulkactreport="+d,u="#txtcbe-ajaxtablereports")),""!=l&&(l="&fields="+l),m[0].replace("admincommand3","")!=String(m[0])&&(e="spamhaus",u="#spamhaushtmlframe",n="",d="",p+="&refreships=1&admincommand=3&admincommand3=1&actadmincommand3=1"),m[0].replace("admincommand5","")!=String(m[0])&&(e="database",u="#databasehtmlframe",n="",d="",p+="&refreshdb=1&admincommand=5&admincommand5=1&actadmincommand5=1"),m.length>2&&(o=m[2],""!=o&&confirm(unescape(o))&&(o="")),""==o&&c.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:p+d+l+n,success:function(t){var s=t.split("6g9newdat6g9");s.length>1&&(t=s[0],f=document.getElementById("sysdbsize"),f&&(f.innerHTML=s[1]),f=document.getElementById("syslastcheck"),f&&(f.innerHTML=s[2])),c(u).html(t),c("#txtcbulkstatus").css("display",""),"spamhaus"==e?(c("#spamhaushtmlframe .tx-tc-information .tx-tc-messageclosebutton").click(function(){c("#spamhaushtmlframe .tx-tc-information").css("display","none")}),c("#spamhaushtmlframe .tx-tc-alert .tx-tc-messageclosebutton").click(function(){c("#spamhaushtmlframe .tx-tc-alert").css("display","none")})):"database"==e?(c("#databasehtmlframe .tx-tc-information .tx-tc-messageclosebutton").click(function(){c("#databasehtmlframe .tx-tc-information").css("display","none")}),c("#databasehtmlframe .tx-tc-alert .tx-tc-messageclosebutton").click(function(){c("#databasehtmlframe .tx-tc-alert").css("display","none")})):c(".tx-tc-messageclosebutton").click(function(){c("#txtcbulkstatus").css("display","none")});var o=[],n="";if("comments"==e&&(l=l.replace("&fields=",""),o=l.split("-"),n=o[0],t.replace(o[0],"")!=t)){if("&bulkact=1"==d||"&bulkact=2"==d)for(a="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved."+picext,"&bulkact=2"==d&&(a="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-hidden."+picext),i=0;i<o.length;i++)c("#approve06g9"+o[i]+" img").attr({src:a}),c("#approve16g9"+o[i]+" img").attr({src:a});if("&bulkact=3"==d||"&bulkact=4"==d)for(a="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide."+picext,"&bulkact=4"==d&&(a="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext),i=0;i<o.length;i++)c("#hide06g9"+o[i]+" img").attr({src:a}),c("#hide16g9"+o[i]+" img").attr({src:a});if("&bulkact=5"==d)for(i=0;i<o.length;i++)c("#txtc-row-"+o[i]).remove()}if("users"==e&&(l=l.replace("&fields=",""),o=l.split("-"),t.replace("tx-tc-alert","")==t)){for(i=0;i<o.length;i++)r!=o[i]&&(n=o[i].replace(/\./g,""),n=n.replace(/\:/g,""),c("#txtc-row-"+n).remove());""!=r&&(n=r.replace(/\./g,""),n=n.replace(/\:/g,""),c("#txtc-row-"+n).addClass("tx-tc-hilight"),c("input:checkbox").prop("checked",""))}if("spamhaus"==e&&(u="notable"),"database"==e&&(u="notable"),"reports"==e){var p=d.replace("&bulkactreport=1&bulkactreps=",""),m=[];if(p!=d?(d=1,x=p,h=h.replace("&fields=",""),o=h.split("7g87g8")):(p=d.replace("&bulkactreport=",""),p>0&&(reportssave[p]=t,visiblizeReportOptionsIntAjax(p,0))),1==d){var b=0;if(t.replace("tx-tc-alert","")==t){var f;if(1==x){for(i=0;i<o.length;i++)m=String(o[i]).split("6g9-6g9"),b=String(m[2]),c("#txtc-row-"+b).remove();f=document.getElementById("countsessionrows"),f&&(tccid2=f.innerHTML,tccid3=Math.round(Math.round(tccid2,0)-o.length,0),0==tccid3?(c("#countnosessionrows").css("display",""),c("#countsomesessionrows").css("display","none"),c("#countsomesessionrowsrest").css("display","none")):f.innerHTML=tccid3)}if(x>1){var w="",g="";for(2==x?w=txtblockedcommenting:(w=txtblockedfrontend,g="tx-tc-alert"),i=0;i<o.length;i++)m=String(o[i]).split("6g9-6g9"),b=String(m[2]),c("#sup-row-"+b).hasClass("tx-tc-sup")?(c("#sup-row-"+b).attr("title",w),"tx-tc-alert"==g?c("#sup-row-"+b).hasClass("tx-tc-alert")||c("#sup-row-"+b).addClass("tx-tc-alert"):c("#sup-row-"+b).hasClass("tx-tc-alert")||c("#sup-row-"+b).removeClass("tx-tc-alert")):(w='<sup id="#sup-row-'+b+'" class="'+g+'" title="'+w+'">&#8709;</sup>',c(w).insertAfter("#ctlsup-row-"+b))}}}"notable"!=u&&(txtcinittablesorter(),tablesorteraddons())}}}),c(b).css("display","none"),c(t).css("opacity","1")}(jQuery,window)}function tablesorteraddons(){!function(t){t(".checkall").change(function(){t("input:checkbox").prop("checked",t(this).prop("checked"))}),t(".tx-tc-flip1").click(function(){t(".tx-tc-flop1").addClass("tx-tc-show"),t(".tx-tc-flip1").addClass("tx-tc-dontshow"),t(".tx-tc-flop1-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flip1-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flip1").removeClass("tx-tc-show"),t(".tx-tc-flop1").removeClass("tx-tc-dontshow"),t(".tx-tc-flip1-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flop1-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flop1").click(function(){t(".tx-tc-flip1").addClass("tx-tc-show"),t(".tx-tc-flop1").addClass("tx-tc-dontshow"),t(".tx-tc-flip1-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flop1-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flop1").removeClass("tx-tc-show"),t(".tx-tc-flip1").removeClass("tx-tc-dontshow"),t(".tx-tc-flop1-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flip1-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flip2").click(function(){t(".tx-tc-flop2").addClass("tx-tc-show"),t(".tx-tc-flip2").addClass("tx-tc-dontshow"),t(".tx-tc-flop2-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flip2-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flip2").removeClass("tx-tc-show"),t(".tx-tc-flop2").removeClass("tx-tc-dontshow"),t(".tx-tc-flip2-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flop2-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flop2").click(function(){t(".tx-tc-flip2").addClass("tx-tc-show"),t(".tx-tc-flop2").addClass("tx-tc-dontshow"),t(".tx-tc-flip2-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flop2-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flop2").removeClass("tx-tc-show"),t(".tx-tc-flip2").removeClass("tx-tc-dontshow"),t(".tx-tc-flop2-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flip2-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flip3").click(function(){t(".tx-tc-flop3").addClass("tx-tc-show"),t(".tx-tc-flip3").addClass("tx-tc-dontshow"),t(".tx-tc-flop3-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flip3-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flip3").removeClass("tx-tc-show"),t(".tx-tc-flop3").removeClass("tx-tc-dontshow"),t(".tx-tc-flip3-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flop3-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flop3").click(function(){t(".tx-tc-flip3").addClass("tx-tc-show"),t(".tx-tc-flop3").addClass("tx-tc-dontshow"),t(".tx-tc-flip3-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flop3-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flop3").removeClass("tx-tc-show"),t(".tx-tc-flip3").removeClass("tx-tc-dontshow"),t(".tx-tc-flop3-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flip3-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flip4").click(function(){t(".tx-tc-flop4").addClass("tx-tc-show"),t(".tx-tc-flip4").addClass("tx-tc-dontshow"),t(".tx-tc-flop4-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flip4-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flip4").removeClass("tx-tc-show"),t(".tx-tc-flop4").removeClass("tx-tc-dontshow"),t(".tx-tc-flip4-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flop4-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-flop4").click(function(){t(".tx-tc-flip4").addClass("tx-tc-show"),t(".tx-tc-flop4").addClass("tx-tc-dontshow"),t(".tx-tc-flip4-col").addClass("tx-tc-dontshow-cell"),t(".tx-tc-flop4-col").addClass("tx-tc-showtable-cell"),t(".tx-tc-flop4").removeClass("tx-tc-show"),t(".tx-tc-flip4").removeClass("tx-tc-dontshow"),t(".tx-tc-flop4-col").removeClass("tx-tc-dontshow-cell"),t(".tx-tc-flip4-col").removeClass("tx-tc-showtable-cell")}),t(".tx-tc-cmdparams3").click(function(){tccid=this.id;var c=0,s="",e=String(tccid).split("6g9");3===e.length&&(c=e[1],s=e[2],confirm(unescape(s))&&t.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"admincommand=delete&uid="+c,success:function(s){"000"!=s&&t("#txtc-row-"+c).slideUp("slow",function(){})}}))}),t(".tx-tc-cmdparams4").click(function(){tccid=this.id;var c=0,s="unhide",e="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext,o=String(tccid).split("6g9");t("#"+tccid+" img").attr("src")=="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext&&(s="hide",e="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide."+picext),2===o.length&&(t("#"+tccid+" img").css("padding","0 0"),t("#"+tccid+" img").attr({src:"../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif"}),t("#"+tccid+" img").css("border","1px solid white"),c=o[1],t.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"admincommand="+s+"&uid="+c,success:function(c){"000"!=c&&(t("#"+tccid+" img").attr({src:e}),t("#"+tccid+" img").css("padding","7px 0"),t("#"+tccid+" img").css("border",""))}}))}),t(".tx-tc-cmdparams5").click(function(){tccid=this.id;var c=0,s=String(tccid).split("6g9"),e="unhide",o="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext,s=String(tccid).split("6g9");t("#"+tccid+" img").attr("src")=="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext&&(e="hide",o="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide."+picext),2===s.length&&(t("#"+tccid+" img").css("padding","0 0"),t("#"+tccid+" img").attr({src:"../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif"}),t("#"+tccid+" img").css("border","1px solid white"),c=s[1],t.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"admincommand="+e+"&uid="+c,success:function(c){"000"!=c&&(t("#"+tccid+" img").attr({src:o}),t("#"+tccid+" img").css("padding","7px 0"),t("#"+tccid+" img").css("border",""))}}))}),t(".tx-tc-cmdparams6").click(function(){tccid=this.id;var c=0,s=String(tccid).split("6g9"),e="approve",o="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved."+picext,s=String(tccid).split("6g9");t("#"+tccid+" img").attr("src")=="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved."+picext&&(e="disapprove",o="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-hidden."+picext),2===s.length&&(t("#"+tccid+" img").css("padding","0 0"),t("#"+tccid+" img").attr({src:"../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif"}),t("#"+tccid+" img").css("border","1px solid white"),c=s[1],t.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"admincommand="+e+"&uid="+c,success:function(c){"000"!=c&&(t("#"+tccid+" img").attr({src:o}),t("#"+tccid+" img").css("padding","7px 0"),t("#"+tccid+" img").css("border",""))}}))}),t(".tx-tc-cmdparams7").click(function(){tccid=this.id;var c=0,s=String(tccid).split("6g9"),e="approve",o="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved."+picext,s=String(tccid).split("6g9");t("#"+tccid+" img").attr("src")=="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved."+picext&&(e="disapprove",o="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-hidden."+picext),2===s.length&&(t("#"+tccid+" img").css("padding","0 0"),t("#"+tccid+" img").attr({src:"../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif"}),t("#"+tccid+" img").css("border","1px solid white"),c=s[1],t.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"admincommand="+e+"&uid="+c,success:function(c){"000"!=c&&(t("#"+tccid+" img").attr({src:o}),t("#"+tccid+" img").css("padding","7px 0"),t("#"+tccid+" img").css("border",""))}}))}),t(".tx-tc-be-bulkactr").click(function(){tccid=this.id,tccid=tccid.replace("showreport",""),visiblizeReportOptionsIntAjax(tccid,1)}),t(".tx-tc-be-bulkact").click(function(){bindbulkact(this)})}(jQuery,window,document)}function postajaxcommand(t){!function(c){tccid=t;var s="",e=0;if("roverview"==tccid&&(s="&refresh=1",c("#txtcbe-ajaxoverview").slideUp("fast",function(){c("#txtcbe-ajaxoverview").css("display",""),c("#txtcbe-ajaxoverview").css("opacity","0.6"),c("#txtcbe-ajaxloadingoverview").css("display","block"),c("#txtcbe-ajaxloadingoverview").slideDown("slow",function(){e=0,c.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"actadmincommand=1&admincommand="+e+s,success:function(t){c("#txtcbe-ajaxloadingoverview").slideUp("slow",function(){c("#txtcbe-ajaxoverview").html(t),c("#txtcbe-ajaxoverview").css("opacity",""),c("#txtcbe-ajaxoverview").css("display",""),c("#txtcbe-ajaxtitleoverview").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitleoverview").removeClass("tx-tc-show"),c("#txtcbe-ajaxoverview").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxoverview").removeClass("tx-tc-show"),c("#txtcbe-ajaxloadingoverview").css("display","none"),c(".tx-tc-datarequester").click(function(){postajaxcommand(this.id)}),c(".tx-tc-panelclosebutton").click(function(){tccid=this.id,tccid=tccid.replace("tx-tc-subpaneltitle",""),"block"!=c("#tx-tc-subiconpanel").css("display")&&c("#tx-tc-subiconpanel").css("display","block"),c("#tx-tc-subpanel"+tccid).slideUp("slow",function(){c("#tx-tc-subpanel"+tccid).css("display","none"),c("#tx-tc-subicon"+tccid).css("display","block")})}),c(".tx-tc-be-bulkspamhaus").click(function(){bindbulkact(this)}),c(".tx-tc-be-bulkdatabase").click(function(){bindbulkact(this)}),c("#shwmoreuserstrg").click(function(){c("#shwmoreuserstrg").css("display","none"),c("#shwmoreusers").css("display","block")}),c("#shwlessusers").click(function(){c("#shwmoreuserstrg").css("display","block"),c("#shwmoreusers").css("display","none")}),c("#shwmorecommentstrg").click(function(){c("#shwmorecommentstrg").css("display","none"),c("#shwmorecomments").css("display","block")}),c("#shwlesscomments").click(function(){c("#shwmorecommentstrg").css("display","block"),c("#shwmorecomments").css("display","none")}),c("#shwmoreratingstrg").click(function(){c("#shwmoreratingstrg").css("display","none"),c("#shwmoreratings").css("display","block")}),c("#shwlessratings").click(function(){c("#shwmoreratingstrg").css("display","block"),c("#shwmoreratings").css("display","none")}),c(".tx-tc-subicons").click(function(){tccid=this.id,tccid=tccid.replace("tx-tc-subicon",""),c("#tx-tc-subpanel"+tccid).css("display","table"),c("#tx-tc-subpanel"+tccid).slideDown("slow",function(){c("#tx-tc-subicon"+tccid).css("display","none")});var t=0;(""==c("#tx-tc-subicon1").css("display")||"none"==c("#tx-tc-subicon1").css("display"))&&(t+=1),(""==c("#tx-tc-subicon2").css("display")||"none"==c("#tx-tc-subicon2").css("display"))&&(t+=1),(""==c("#tx-tc-subicon3").css("display")||"none"==c("#tx-tc-subicon3").css("display"))&&(t+=1),(""==c("#tx-tc-subicon4").css("display")||"none"==c("#tx-tc-subicon4").css("display"))&&(t+=1),(""==c("#tx-tc-subicon5").css("display")||"none"==c("#tx-tc-subicon5").css("display"))&&(t+=1),(""==c("#tx-tc-subicon6").css("display")||"none"==c("#tx-tc-subicon6").css("display"))&&(t+=1),6==t&&c("#tx-tc-subiconpanel").css("display","none")})})}})})})),("acomment"==tccid||"rcomment"==tccid||"pcomment"==tccid)&&(c("#txtcbe-ajaxloadingcomments").css("display","none"),c("#txtcbe-ajaxtableusers").html(""),c("#txtcbe-ajaxtablereports").html(""),c("#txtcbe-ajaxtitletableusers").css("display","none"),c("#txtcbe-ajaxtitletableusers").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablereports").removeClass("tx-tc-show"),c("#txtcbe-ajaxtitletableusers").removeClass("tx-tc-show"),c("#txtcbe-ajaxtitletablereports").removeClass("tx-tc-dontshow"),"rcomment"==tccid&&(s="&refresh=1"),c("#txtcbe-ajaxtableusers").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtablereports").removeClass("tx-tc-show"),c("#txtcbe-ajaxtableusers").removeClass("tx-tc-show"),c("#txtcbe-ajaxtablereports").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablereports").css("display","none"),c("#txtcbe-ajaxtablecomments").slideUp("fast",function(){c("#txtcbe-ajaxtitletablecomments").css("display","block"),c("#txtcbe-ajaxtablecomments").html(""),c("#txtcbe-ajaxloadingcomments").css("display","block"),c("#txtcbe-ajaxloadingcomments").slideDown("slow",function(){e=1,c.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"actadmincommand=1&admincommand="+e+s,success:function(t){c("#txtcbe-ajaxloadingcomments").slideUp("slow",function(){c("#txtcbe-ajaxtablecomments").html(t),c("#txtcbe-ajaxtablecomments").css("display","block"),c("#txtcbe-ajaxtitletablecomments").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablecomments").removeClass("tx-tc-show"),c("#txtcbe-ajaxtablecomments").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtablecomments").removeClass("tx-tc-show"),txtcinittablesorter(),tablesorteraddons(),c("#txtcbe-ajaxloadingcomments").css("display","none")})}})})})),("auser"==tccid||"ruser"==tccid||"puser"==tccid)&&(c("#txtcbe-ajaxloadingusers").css("display","none"),c("#txtcbe-ajaxtablecomments").html(""),c("#txtcbe-ajaxtablereports").html(""),c("#txtcbe-ajaxtitletablecomments").css("display","none"),c("#txtcbe-ajaxtitletablereports").css("display","none"),c("#txtcbe-ajaxtitletablecomments").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablereports").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtablecomments").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtablereports").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablecomments").removeClass("tx-tc-show"),c("#txtcbe-ajaxtitletablereports").removeClass("tx-tc-show"),c("#txtcbe-ajaxtablecomments").removeClass("tx-tc-show"),c("#txtcbe-ajaxtablereports").removeClass("tx-tc-show"),"ruser"==tccid&&(s="&refresh=1"),c("#txtcbe-ajaxtableusers").slideUp("fast",function(){c("#txtcbe-ajaxtitletableusers").css("display","block"),c("#txtcbe-ajaxtableusers").html(""),c("#txtcbe-ajaxloadingusers").css("display","block"),c("#txtcbe-ajaxloadingusers").slideDown("slow",function(){e=2,c.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"actadmincommand=1&admincommand="+e+s,success:function(t){c("#txtcbe-ajaxloadingusers").slideUp("slow",function(){c("#txtcbe-ajaxtableusers").html(t),c("#txtcbe-ajaxtableusers").css("display","block"),c("#txtcbe-ajaxtitletableusers").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletableusers").removeClass("tx-tc-show"),c("#txtcbe-ajaxtableusers").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtableusers").removeClass("tx-tc-show"),txtcinittablesorter(),tablesorteraddons(),c("#txtcbe-ajaxloadingusers").css("display","none")})}})})})),"areport"==tccid||"rreport"==tccid||"preport"==tccid){c("#txtcbe-ajaxloadingreports").css("display","none"),c("#txtcbe-ajaxtablecomments").html(""),c("#txtcbe-ajaxtitletablecomments").css("display","none"),c("#txtcbe-ajaxtitletableusers").css("display","none"),c("#txtcbe-ajaxtitletableusers").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablecomments").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletableusers").removeClass("tx-tc-show"),c("#txtcbe-ajaxtitletablecomments").removeClass("tx-tc-show"),c("#txtcbe-ajaxtableusers").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtablecomments").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtableusers").removeClass("tx-tc-show"),c("#txtcbe-ajaxtablecomments").removeClass("tx-tc-show"),c("#txtcbe-ajaxtableusers").html("");var o=1;"rreport"==tccid&&(s="&refresh=1",reportssave[0]="",reportssave[1]="",reportssave[2]="",reportssave[3]="",reportssave[4]="",o=0),c("#txtcbe-ajaxtablereports").slideUp("fast",function(){c("#txtcbe-ajaxtitletablereports").css("display","block"),c("#txtcbe-ajaxtablereports").html(""),c("#txtcbe-ajaxloadingreports").css("display","block"),c("#txtcbe-ajaxloadingreports").slideDown("slow",function(){e=4,c.ajax({type:"POST",url:"ajax.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction",async:!1,data:"actadmincommand=1&bulkactreport=0&admincommand="+e+s,success:function(t){c("#txtcbe-ajaxloadingreports").slideUp("slow",function(){c("#txtcbe-ajaxtablereports").html(t),c("#txtcbe-ajaxtablereports").css("display","block"),c("#txtcbe-ajaxtitletablereports").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtitletablereports").removeClass("tx-tc-show"),c("#txtcbe-ajaxtablereports").removeClass("tx-tc-dontshow"),c("#txtcbe-ajaxtablereports").removeClass("tx-tc-show"),visiblizeReportOptionsIntAjax(lastreportindex,o),txtcinittablesorter(),tablesorteraddons(),c("#txtcbe-ajaxloadingreports").css("display","none")})}})})})}}(jQuery)}function goToByScroll(t){!function(c){c("html,body").animate({scrollTop:c("#"+t).offset().top},"slow")}(jQuery)}function beftr(){!function(t){tablesorteraddons(),t(".tx-tc-panelclosebutton").click(function(){tccid=this.id,tccid=tccid.replace("tx-tc-subpaneltitle",""),"block"!=t("#tx-tc-subiconpanel").css("display")&&t("#tx-tc-subiconpanel").css("display","block"),t("#tx-tc-subpanel"+tccid).slideUp("slow",function(){t("#tx-tc-subpanel"+tccid).css("display","none"),t("#tx-tc-subicon"+tccid).css("display","block")})}),t(".tx-tc-be-bulkspamhaus").click(function(){bindbulkact(this)}),t(".tx-tc-be-bulkdatabase").click(function(){bindbulkact(this)}),t(".tx-tc-subicons").click(function(){tccid=this.id,tccid=tccid.replace("tx-tc-subicon",""),t("#tx-tc-subpanel"+tccid).css("display","table"),t("#tx-tc-subpanel"+tccid).slideDown("slow",function(){t("#tx-tc-subicon"+tccid).css("display","none")});var c=0;(""==t("#tx-tc-subicon1").css("display")||"none"==t("#tx-tc-subicon1").css("display"))&&(c+=1),(""==t("#tx-tc-subicon2").css("display")||"none"==t("#tx-tc-subicon2").css("display"))&&(c+=1),(""==t("#tx-tc-subicon3").css("display")||"none"==t("#tx-tc-subicon3").css("display"))&&(c+=1),(""==t("#tx-tc-subicon4").css("display")||"none"==t("#tx-tc-subicon4").css("display"))&&(c+=1),(""==t("#tx-tc-subicon5").css("display")||"none"==t("#tx-tc-subicon5").css("display"))&&(c+=1),(""==t("#tx-tc-subicon6").css("display")||"none"==t("#tx-tc-subicon6").css("display"))&&(c+=1),6==c&&t("#tx-tc-subiconpanel").css("display","none")}),t("#shwmoreuserstrg").click(function(){t("#shwmoreuserstrg").css("display","none"),t("#shwmoreusers").css("display","block")}),t("#shwlessusers").click(function(){t("#shwmoreuserstrg").css("display","block"),t("#shwmoreusers").css("display","none")}),t("#shwmorecommentstrg").click(function(){t("#shwmorecommentstrg").css("display","none"),t("#shwmorecomments").css("display","block")}),t("#shwlesscomments").click(function(){t("#shwmorecommentstrg").css("display","block"),t("#shwmorecomments").css("display","none")}),t("#shwmoreratingstrg").click(function(){t("#shwmoreratingstrg").css("display","none"),t("#shwmoreratings").css("display","block")}),t("#shwlessratings").click(function(){t("#shwmoreratingstrg").css("display","block"),t("#shwmoreratings").css("display","none")}),t(".tx-tc-refresh").click(function(){postajaxcommand(this.id)}),t(".tx-tc-datarequester").click(function(){postajaxcommand(this.id)}),t("#txtctoptrigger").click(function(){goToByScroll("txtctopancer")}),t(".tx-tc-showpanel").click(function(){tccid=this.id;var c=0,s="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext;String(tccid).split("6g9");t("#"+tccid+" img").attr("src")=="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide."+picext&&(s="../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide."+picext,c=1),(tccid="shwoverview")&&(0==c?t("#txtcbe-ajaxoverview").slideDown("slow",function(){t("#txtcbe-ajaxtitleoverview").removeClass("tx-tc-panelbar-collapsed")}):t("#txtcbe-ajaxoverview").slideUp("slow",function(){t("#txtcbe-ajaxtitleoverview").addClass("tx-tc-panelbar-collapsed")}),t("#"+tccid+" img").attr({src:s}))})}(jQuery)}var tccid="",tccid2="",tccid3="";