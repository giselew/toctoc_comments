/***************************************************************
*  Copyright notice
*
*  (c) 2012 - 2016 Gisele Wendl <gisele.wendl@toctoc.ch>
*  toctoc_comments javascript file handlich bindings of events, located in the footer of the HTML document
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
 * Init of working variables
 */

var tccid = '';
var tccid2 = '';
var tccid3 = '';


function visiblizeReportOptionsIntAjax(selval, optshowcache)	{
	(function($) {
		var dopaintopts = 1;
		$('#subpaneltitle' + selval).css('color', '');	
		if (optshowcache == 1) {
			
			var outtable= '#txtcbe-ajaxtablereports';
			//console.log('selval ' + selval);
			
			if (reportssave[selval] != '') {
				$(outtable).html(reportssave[selval]);				
				$('#subpaneltitle' + selval).css('color', '#5475c8');			
				dopaintopts = 0;
			} else {
				$('#jscleaning').html('');
			}
		}
		lastreportindex = selval;
		var elemcap=document.getElementById('rep' + selval + 'options');
		if (elemcap) {
			elemcap.style.display = 'block';
			elemcap=document.getElementById('showreport' + selval);
		    if (elemcap) {
				elemcap.style.background = '#c4c4c4';
		    }
			
			for (i=1;i<=numofreports;i++) {
				if (i != selval) {
					elemcap=document.getElementById('rep' + i + 'options');
		    		if (elemcap) {
						elemcap.style.display = 'none';
		    		}
			
					elemcap=document.getElementById('showreport' + i);
					if (elemcap) {
						elemcap.style.background = '';
				    }
	
				}
	
			}
			elemcap=document.getElementById('repsubmit');
			if (elemcap) {
			    elemcap.style.display = 'block';
			}
	
		} else {
			for (i=1;i<=numofreports;i++) {
				elemcap=document.getElementById('rep' + i + 'options');
				if (elemcap) {
					elemcap.style.display = 'none';
				}
			
				elemcap=document.getElementById('showreport' + i);
				if (elemcap) {
					elemcap.style.background = '';
			    }
	
		    	elemcap=document.getElementById('repsubmit');
		   		if (elemcap) {
		   			elemcap.style.display = 'none';
		   		}
	
			}
		}
		if (dopaintopts == 0) {
			txtcinittablesorter();
			tablesorteraddons();
		}


	})(jQuery,window);

}
function bindbulkact(thisobj) {
	(function($) {
	

	// bulkact: 'actmul6g91, pactmul6g91 ....'
	tccid = thisobj.id;
	var localaction = '';
	var message = '';
	var field;
	var psrc = '';
	var uidstr='';
	var mergeuser='';
	var mergeuserid = '';
	var actionid = '';
	var optval  = '';
	
	var action = 'refresh=1&fromajax=1';
	var idtestarr = String(tccid).split("6g9");
	$(thisobj).css('opacity', '0.6');
	
	actionid = idtestarr[1];
	
	var loadingid= '#txtcbe-ajaxloadingreport'+actionid;
	
	if (idtestarr[0] == 'actreport') {
		$(loadingid).css('display', 'block');
	}
	
	if ((idtestarr[0]).replace('actmul', '') != String(idtestarr[0])) {
		action += '&actadmincommand1=1&admincommand=1&actmul=Go';
		actionid = '&bulkact='+actionid;
		localaction='comments';
	}
	
	if ((idtestarr[0]).replace('actuser', '') != String(idtestarr[0])) {
		action += '&actadmincommand2=1&admincommand=2&admincommand2=1&actuser=Go';
		actionid = '&bulkactuser='+actionid;
		// mergeuser
		field = document.getElementById('mergeuser');
		mergeuser='&mergeuser=' +  field.value;
		mergeuserid = field.value;
		localaction='users';
	}
	
	var outtable= '#txtcbulkstatus';
	var uidstrsav = '';
	uidstr = $("form input:checkbox").serialize();
	// fields%5B%5D=841&fields%5B%5D=661&fields%5B%5D=660
	uidstr=uidstr.replace(/fields%5B%5D=/g, '');
	uidstr=uidstr.replace(/&/g, '-');	
	if (((idtestarr[0]).replace('actreport', '') != String(idtestarr[0])) || ((idtestarr[0]).replace('bulkactreps', '') != String(idtestarr[0]))) {
		if ((idtestarr[0]).replace('bulkactreps', '') != String(idtestarr[0])) {
			// when deleting sessions or blacklisting
			optval = 1;
		} else {
			// when displaying a report
			field = document.getElementById('optreport6g9'+actionid);
			if (field) {
				optval = field.value;
			} else {
				optval = 0;
			}
		}
		
		if (optval == 'undefined') {
			optval = 0;
		}
		
		if (!optval) {
			optval = 0;
		}
		
		localaction='reports';
		
		if ((idtestarr[0]).replace('bulkactreps', '') != String(idtestarr[0])) {
			action += '&admincommand=4&actadmincommand4=1&repsubmit=Go&optreport=' +optval;
			action += '&admincommand41=41&actadmincommand41=1';
			actionid = '&bulkactreport=1&bulkactreps='+actionid;
			outtable= '#txtcbulkstatus';
			uidstr = $("form input:checkbox").serialize();
			uidstrsav=uidstr.replace(/fields%5B%5D=/g, '');
			uidstrsav=uidstrsav.replace(/&/g, '7g87g8');
			uidstr = uidstrsav;

		} else {
			action += '&admincommand=4&actadmincommand4=1&repsubmit=Go&optreport=' +optval;
			if (actionid == 2) {
				field = document.getElementById('activeuserreportsince');
				action += '&activeuserreportsince=' +  field.value;
				field = document.getElementById('activeuserreportto');
				action += '&activeuserreportto='  +  field.value;
				field = document.getElementById('activeuserreporttimedays');
				action += '&activeuserreporttimedays=' +  field.value;
			}
			
			actionid = '&bulkactreport='+actionid;	
			outtable= '#txtcbe-ajaxtablereports';
			
		}
		
	} 

	// 621-632-212
	if (uidstr != '') {				
		uidstr='&fields='+ uidstr;				
	}
	//spamhaushtml
	if ((idtestarr[0]).replace('admincommand3', '') != String(idtestarr[0])) {
		localaction='spamhaus';
		outtable= '#spamhaushtmlframe';
		mergeuser= '' ;
		actionid= '' ;
		action += '&refreships=1&admincommand=3&admincommand3=1&actadmincommand3=1';
	}
	
	//database
	if ((idtestarr[0]).replace('admincommand5', '') != String(idtestarr[0])) {
		if (idtestarr[1] == '0') {
			localaction='database';
			action += '&refreshdb=1&admincommand=5&admincommand5=1&actadmincommand5=1';
		} else {
			localaction='database';
			action += '&purgecache=1&admincommand=5&admincommand5=1&actadmincommand5=1';
			
		}
		outtable= '#databasehtmlframe';
		mergeuser= '';
		actionid= idtestarr[1];
		
	}
	
	if (idtestarr.length > 2) {
		message=idtestarr[2];
		if (message !='') {
			if (confirm(unescape(message))) {
				message='';
			}
			
		}
		
	}
	
	if (message =='') {
		$.ajax({
			type: 'POST',
			url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
			async: false,
			data: action + actionid + uidstr + mergeuser,									
			success: function(html){
				var htmlarr = html.split('6g9newdat6g9');
				
				if (htmlarr.length > 1) {
					html = htmlarr[0];
					elem = document.getElementById('sysdbsize');
					if (elem) {
						elem.innerHTML=htmlarr[1];						
					}
					elem = document.getElementById('syslastcheck');
					if (elem) {
						elem.innerHTML=htmlarr[2];						
					}					
				}
				
				var htmlarrcache = html.split('6g9newcachedat6g9');
				if (htmlarrcache.length > 1) {
					html = htmlarrcache[0];
				}
				
				$(outtable).html(html);	
				if (htmlarrcache.length > 1) {
					$('.tx-tc-be-bulkcache').off('click');	
					setTimeout(function() {
						
						$('#adminshowcache span').removeClass('tx-tc-datarequester');
						$('#adminshowcache span').removeClass('tx-tc-be-link');
						$('#adminshowcache span').removeClass('tx-tc-be-bulkcache');
						$('#adminshowcache span').addClass('tx-tc-nodatarequester');
						$('#adminshowcache span').css('opacity', '');
						
						$('#adminshowcache img').removeClass('tx-tc-datarequester');
						$('#adminshowcache img').removeClass('tx-tc-be-link');
						$('#adminshowcache img').removeClass('tx-tc-be-p-bulkcache');
						$('#adminshowcache img').addClass('tx-tc-nodatarequester');
						$('#hascache').removeClass('tx-tc-show');
						$('#hascache').addClass('tx-tc-dontshow');
						$('#nocache').removeClass('tx-tc-dontshow');
						$('#nocache').addClass('tx-tc-show');
					}, 1);
				}
				$('#txtcbulkstatus').css('display', '');
				if (localaction == 'spamhaus') {
					$('#spamhaushtmlframe .tx-tc-information .tx-tc-messageclosebutton').click(function() {
						$('#spamhaushtmlframe .tx-tc-information').css('display', 'none');
					});
					$('#spamhaushtmlframe .tx-tc-alert .tx-tc-messageclosebutton').click(function() {
						$('#spamhaushtmlframe .tx-tc-alert').css('display', 'none');
					});
				} else {
					if (localaction == 'database') {
						$('#databasehtmlframe .tx-tc-information .tx-tc-messageclosebutton').click(function() {
							$('#databasehtmlframe .tx-tc-information').css('display', 'none');
						});
						$('#databasehtmlframe .tx-tc-alert .tx-tc-messageclosebutton').click(function() {
							$('#databasehtmlframe .tx-tc-alert').css('display', 'none');
						});
					} else {
						$('.tx-tc-messageclosebutton').click(function() {
							$('#txtcbulkstatus').css('display', 'none');
						});
						
					}
					
				}
										
				var uidarr=[];
				var teststr = '';
				if (localaction == 'comments') {
					uidstr=uidstr.replace('&fields=', '');
					uidarr=uidstr.split('-');
					teststr = uidarr[0];

					if (html.replace(uidarr[0], '') != html) {
							// look like there's a success
						if ((actionid=='&bulkact=1') || (actionid=='&bulkact=2')) {
							// make approved or not approved icon  icon	
							psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved.' + picext;
							if ((actionid=='&bulkact=2')) {
								// make approved icon	
								psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-hidden.' + picext;
							}
							
							for (i= 0; i < uidarr.length; i++) {
								//approve06g9663
								$('#approve06g9' + uidarr[i] + ' img').attr({
									  src: psrc
								});
								$('#approve16g9' + uidarr[i] + ' img').attr({
									  src: psrc
								});
								
							}
							
						}
						
						if ((actionid=='&bulkact=3') || (actionid=='&bulkact=4')) {
							// make hide or not unhide icon  icon	
							psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide.' + picext;
							if ((actionid=='&bulkact=4')) {
								// make approved icon	
								psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext;
							}
							
							for (i= 0; i < uidarr.length; i++) {
								//approve06g9663
								$('#hide06g9' + uidarr[i] + ' img').attr({
									  src: psrc
								});
								$('#hide16g9' + uidarr[i] + ' img').attr({
									  src: psrc
								});
								
							}
							
						}
						
						if ((actionid=='&bulkact=5')) {
							// delete rows
							for (i= 0; i < uidarr.length; i++) {
								$('#txtc-row-'+uidarr[i]).remove();
							}
							
						}
					
					}
				}
				
				if (localaction == 'users') {
					uidstr=uidstr.replace('&fields=', '');
					uidarr=uidstr.split('-');
					if (html.replace('tx-tc-alert', '') == html) {
					// delete rows
						for (i= 0; i < uidarr.length; i++) {
							// oh mergeuserid
							if (mergeuserid != uidarr[i]) {
								teststr = uidarr[i].replace(/\./g, '');
								teststr = teststr.replace(/\:/g, '');
								$('#txtc-row-'+teststr+'').remove();	
								
							} 
						}
						
						if (mergeuserid != '') {
							teststr = mergeuserid.replace(/\./g, '');
							teststr = teststr.replace(/\:/g, '');
							$('#txtc-row-'+teststr+'').addClass('tx-tc-hilight');
							$("input:checkbox").prop('checked', '');
							
						}
					}
					
				}
				
				
				if (localaction == 'spamhaus') {							
					outtable = 'notable';
				}
				if (localaction == 'database') {							
					outtable = 'notable';
				}
				
				if (localaction == 'reports') {							
					var actid = actionid.replace('&bulkactreport=1&bulkactreps=','');
					var uidarrlvl2 = [];
					if(actid !=actionid) {
						actionid=1;
						optval = actid;								
						uidstrsav=uidstrsav.replace('&fields=', '');
						uidarr=uidstrsav.split('7g87g8');
					} else {
						actid = actionid.replace('&bulkactreport=','');
						if(actid > 0) {
							reportssave[actid] = html;
							visiblizeReportOptionsIntAjax(actid, 0);								
						}
						
					}

					if (actionid == 1) {
						var editUid  = 0;
						if (html.replace('tx-tc-alert', '') == html) {
					//sessions, remove or setup banned icon
							var elem;
							if (optval == 1) {
								//sessions remove
								for (i= 0; i < uidarr.length; i++) {
									uidarrlvl2 = String(uidarr[i]).split('6g9-6g9');
									editUid = String(uidarrlvl2[2]);
									$('#txtc-row-'+editUid).remove();								
								}
								
								elem = document.getElementById('countsessionrows');
								if (elem) {
									tccid2 = elem.innerHTML;
									tccid3 = Math.round((Math.round(tccid2,0)-uidarr.length),0);
									if (tccid3==0) {
										$('#countnosessionrows').css('display', '');
										$('#countsomesessionrows').css('display', 'none');
										$('#countsomesessionrowsrest').css('display', 'none');												
									} else {
										elem.innerHTML=tccid3;
									}
									
								}
								
							}
							
							if (optval > 1) {
								//mark banned
								
								var strbl = '';
								var supclass = '';
																	
								if (optval == 2) {
			    					strbl = txtblockedcommenting;
								} else {
			    					strbl = txtblockedfrontend;
			    					supclass = 'tx-tc-alert';
			    				}
			    				
								for (i= 0; i < uidarr.length; i++) {
									uidarrlvl2 = String(uidarr[i]).split('6g9-6g9');
									editUid = String(uidarrlvl2[2]);
									
									if (!$('#sup-row-'+editUid+'').hasClass('tx-tc-sup')) {
										strbl = '<sup id="#sup-row-'+editUid+'" class="' + supclass + '" title="' + strbl + '">&#8709;</sup>';
				
										$(strbl).insertAfter('#ctlsup-row-'+editUid);
										//console.log('adding ' + strbl + ' after editUid "#ctlsup-row-' + editUid + '"');
									} else {
										//console.log('title ' + strbl + ', editUid ' + '"#sup-row-'+editUid+'"');
										$('#sup-row-'+editUid+'').attr('title', strbl);
										if (supclass == 'tx-tc-alert') {
											if (!$('#sup-row-'+editUid).hasClass('tx-tc-alert')) {
												$('#sup-row-'+editUid).addClass('tx-tc-alert');														
											}
											
										} else {
											if (!$('#sup-row-'+editUid).hasClass('tx-tc-alert')) {
												$('#sup-row-'+editUid).removeClass('tx-tc-alert');														
											}	
											
										}
										
									}									
								}
								
							}
							
						}
						
					}
					
					if (outtable != 'notable') {
						txtcinittablesorter();
						tablesorteraddons();
					}
					
				}
				
			}
		
		});
	}
	$(loadingid).css('display', 'none');
	$(thisobj).css('opacity', '1');			

	
})(jQuery,window);

}
function tablesorteraddons() {
	(function($) {
		// check/uncheck items
		$('.checkall').change(function() {
			//$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
			 $("input:checkbox").prop('checked', $(this).prop("checked"));
		});
		// flip/flop for responsive table columns
	    $('.tx-tc-flip1').click(function() {
				$('.tx-tc-flop1').addClass('tx-tc-show');
		    	$('.tx-tc-flip1').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop1-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip1-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flip1').removeClass('tx-tc-show');
		    	$('.tx-tc-flop1').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip1-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop1-col').removeClass('tx-tc-showtable-cell');
		});
		$('.tx-tc-flop1').click(function() {
				$('.tx-tc-flip1').addClass('tx-tc-show');
		    	$('.tx-tc-flop1').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip1-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop1-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flop1').removeClass('tx-tc-show');
		    	$('.tx-tc-flip1').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop1-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip1-col').removeClass('tx-tc-showtable-cell');
		});
		$('.tx-tc-flip2').click(function() {
				$('.tx-tc-flop2').addClass('tx-tc-show');
		    	$('.tx-tc-flip2').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop2-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip2-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flip2').removeClass('tx-tc-show');
		    	$('.tx-tc-flop2').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip2-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop2-col').removeClass('tx-tc-showtable-cell');
		});
		$('.tx-tc-flop2').click(function() {
				$('.tx-tc-flip2').addClass('tx-tc-show');
		    	$('.tx-tc-flop2').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip2-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop2-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flop2').removeClass('tx-tc-show');
		    	$('.tx-tc-flip2').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop2-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip2-col').removeClass('tx-tc-showtable-cell');
		});    
		$('.tx-tc-flip3').click(function() {
				$('.tx-tc-flop3').addClass('tx-tc-show');
		    	$('.tx-tc-flip3').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop3-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip3-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flip3').removeClass('tx-tc-show');
		    	$('.tx-tc-flop3').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip3-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop3-col').removeClass('tx-tc-showtable-cell');
		});
		$('.tx-tc-flop3').click(function() {
				$('.tx-tc-flip3').addClass('tx-tc-show');
		    	$('.tx-tc-flop3').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip3-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop3-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flop3').removeClass('tx-tc-show');
		    	$('.tx-tc-flip3').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop3-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip3-col').removeClass('tx-tc-showtable-cell');
		});	
		 $('.tx-tc-flip4').click(function() {
				$('.tx-tc-flop4').addClass('tx-tc-show');
		    	$('.tx-tc-flip4').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop4-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip4-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flip4').removeClass('tx-tc-show');
		    	$('.tx-tc-flop4').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip4-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop4-col').removeClass('tx-tc-showtable-cell');
		});
		$('.tx-tc-flop4').click(function() {
				$('.tx-tc-flip4').addClass('tx-tc-show');
		    	$('.tx-tc-flop4').addClass('tx-tc-dontshow');		    		
				$('.tx-tc-flip4-col').addClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flop4-col').addClass('tx-tc-showtable-cell');
		    	$('.tx-tc-flop4').removeClass('tx-tc-show');
		    	$('.tx-tc-flip4').removeClass('tx-tc-dontshow');		    		
				$('.tx-tc-flop4-col').removeClass('tx-tc-dontshow-cell');				
				$('.tx-tc-flip4-col').removeClass('tx-tc-showtable-cell');
		});
		// comments, single commands
		$('.tx-tc-cmdparams3').click(function() {
			// delete: 'delete6g9' . $editUid
			
			tccid = this.id;
			
			var uid=0;
			var message='';
			var idtestarr = String(tccid).split("6g9");
			
			if (idtestarr.length === 3) {
				uid=idtestarr[1];
				message=idtestarr[2];
				if (confirm(unescape(message))) {
					$.ajax({
						type: 'POST',
						url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
						async: false,
						data: 'admincommand=delete&uid=' + uid,
						success: function(html){
							if (html != '000') {
								setTimeout(function() {
									$('#txtc-row-'+uid).slideUp( "slow", function() {
									});
								}, 1);
							}
						}
					});
				}				
			}
		});	
		$('.tx-tc-cmdparams4').click(function() {
			// hide: 'hide6g9' . $editUid
			tccid = this.id;
			var uid=0;
			var hact = 'unhide';
			var psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext;
			var idtestarr = String(tccid).split("6g9");
			if ($('#' + tccid + ' img').attr('src') == '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext) {
				hact = 'hide';
				psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide.' + picext;
			}
			if (idtestarr.length === 2) {
				setTimeout(function() {
					$('#' + tccid + ' img').css('padding', '0 0');
					$('#' + tccid + ' img').attr({
						  src: '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif'
					});
					$('#' + tccid + ' img').css('border', '1px solid white');
					}, 1);
				uid=idtestarr[1];
				$.ajax({
					type: 'POST',
					url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
					async: false,
					data: 'admincommand='+hact+'&uid=' + uid,
					success: function(html){
						if (html != '000') {
							setTimeout(function() {
								$('#' + tccid + ' img').attr({
									  src: psrc
								});
								$('#' + tccid + ' img').css('padding', '7px 0');
								$('#' + tccid + ' img').css('border', '');
							}, 1);
						}
					}
				});
			}
		});	
		
		$('.tx-tc-cmdparams5').click(function() {
			// hide: 'hide6g9' . $editUid
			tccid = this.id;
			var uid=0;
			var idtestarr = String(tccid).split("6g9");
			var hact = 'unhide';
			var psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext;
			var idtestarr = String(tccid).split("6g9");
			if ($('#' + tccid + ' img').attr('src') == '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext) {
				hact = 'hide';
				psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide.' + picext;
			}
			
			if (idtestarr.length === 2) {
				setTimeout(function() {
					$('#' + tccid + ' img').css('padding', '0 0');
					$('#' + tccid + ' img').attr({
						  src: '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif'
					});
					$('#' + tccid + ' img').css('border', '1px solid white');
				}, 1);
				uid=idtestarr[1];
				$.ajax({
					type: 'POST',
					url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
					async: false,
					data: 'admincommand='+hact+'&uid=' + uid,
					success: function(html){
						if (html != '000') {
							setTimeout(function() {
								$('#' + tccid + ' img').attr({
									  src: psrc
								});
								$('#' + tccid + ' img').css('padding', '7px 0');
								$('#' + tccid + ' img').css('border', '');
							}, 1);
						}
					}
				});
			}
		});
		$('.tx-tc-cmdparams6').click(function() {
			// disapprove: 'approve06g9' . $editUid
			tccid = this.id;
			var uid=0;
			var idtestarr = String(tccid).split("6g9");
			var hact = 'approve';
			var psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved.' + picext;
			var idtestarr = String(tccid).split("6g9");
			if ($('#' + tccid + ' img').attr('src') == '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved.' + picext) {
				hact = 'disapprove';
				psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-hidden.' + picext;
			}
			if (idtestarr.length === 2) {
				setTimeout(function() {
					$('#' + tccid + ' img').css('padding', '0 0');
					$('#' + tccid + ' img').attr({
						  src: '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif'
					});
					$('#' + tccid + ' img').css('border', '1px solid white');
				}, 1);
				uid=idtestarr[1];
				$.ajax({
					type: 'POST',
					url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
					async: false,
					data: 'admincommand='+hact+'&uid=' + uid,
					success: function(html){
						if (html != '000') {
							setTimeout(function() {
								$('#' + tccid + ' img').attr({
									  src: psrc
								});
								$('#' + tccid + ' img').css('padding', '7px 0');
								$('#' + tccid + ' img').css('border', '');
							}, 1);
						}
					}
				});
			}
		});	
		
		$('.tx-tc-cmdparams7').click(function() {
			// approve: 'approve16g9' . $editUid
			tccid = this.id;
			var uid=0;
			var idtestarr = String(tccid).split("6g9");
			var hact = 'approve';
			var psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved.' + picext;
			var idtestarr = String(tccid).split("6g9");
			if ($('#' + tccid + ' img').attr('src') == '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-approved.' + picext) {
				hact = 'disapprove';
				psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/overlay-hidden.' + picext;
			}
	
			if (idtestarr.length === 2) {
				setTimeout(function() {
					$('#' + tccid + ' img').css('padding', '0 0');
					$('#' + tccid + ' img').attr({
						  src: '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/big-f0f0f0.gif'
					});
					$('#' + tccid + ' img').css('border', '1px solid white');
				}, 1);
				uid=idtestarr[1];
				$.ajax({
					type: 'POST',
					url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
					async: false,
					data: 'admincommand='+hact+'&uid=' + uid,									
					success: function(html){
						if (html != '000') {
							setTimeout(function() {
								$('#' + tccid + ' img').attr({
									  src: psrc
								});
								$('#' + tccid + ' img').css('padding', '7px 0');
								$('#' + tccid + ' img').css('border', '');
							}, 1);
						}
					}
				});
			}
		});
		$('.tx-tc-be-bulkactr').click(function() {
			tccid = this.id;
			tccid = tccid.replace('showreport','');
			visiblizeReportOptionsIntAjax(tccid, 1);
			
		});
		$('.tx-tc-be-bulkact').click(function() {
			bindbulkact(this);
		});
		
	})(jQuery,window,document);
}
function postajaxcommand(thisid) {
	(function($) {
		tccid = thisid;
		var refreshdata='';
		//console.log(tccid);
		var admincommand = 0;
		// commentlist
		if (tccid == 'roverview') {
			refreshdata='&refresh=1';
			$('#txtcbe-ajaxoverview').slideUp( "fast", function() {
				setTimeout(function() {
					$('#txtcbe-ajaxoverview').css('display', '');
					$('#txtcbe-ajaxoverview').css('opacity', '0.6');
					$('#txtcbe-ajaxloadingoverview').css('display', 'block');
				}, 1);
				$('#txtcbe-ajaxloadingoverview').slideDown( "slow", function() {
					// Animation complete
					admincommand = 0;
					$.ajax({
						type: 'POST',
						url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
						async: false,
						data: 'actadmincommand=1&admincommand=' + admincommand + refreshdata,
						success: function(html){
							$('#txtcbe-ajaxloadingoverview').slideUp( "slow", function() {
								// Animation complete								

								$('#txtcbe-ajaxoverview').html(html);
								$('#txtcbe-ajaxoverview').css('opacity', '');
								$('#txtcbe-ajaxoverview').css('display', '');
								$('#txtcbe-ajaxtitleoverview').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtitleoverview').removeClass('tx-tc-show');
								$('#txtcbe-ajaxoverview').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxoverview').removeClass('tx-tc-show');

	
								$('#txtcbe-ajaxloadingoverview').css('display', 'none');
								$('.tx-tc-datarequester').click(function() {
									postajaxcommand(this.id);
									    
								});
								$('.tx-tc-panelclosebutton').click(function() {
									tccid = this.id;
									tccid = tccid.replace('tx-tc-subpaneltitle','');
									if (($('#tx-tc-subiconpanel').css('display') != 'block')) {
										$('#tx-tc-subiconpanel').css('display', 'block');
									}
									
									$('#tx-tc-subpanel' + tccid).slideUp( "slow", function() {
										// Animation complete
										$('#tx-tc-subpanel' + tccid).css('display', 'none');
										$('#tx-tc-subicon' + tccid).css('display', 'block');
									});	
								});
								$('.tx-tc-be-bulkspamhaus').click(function() {
										bindbulkact(this);
								});
								
								$('.tx-tc-be-bulkdatabase').click(function() {
									bindbulkact(this);
								});
								$('.tx-tc-be-bulkcache').click(function() {
									bindbulkact(this);
								});								
								$('#shwmoreuserstrg').click(function() {
									$('#shwmoreuserstrg').css('display', 'none');
									$('#shwmoreusers').css('display', 'block');
								});
								$('#shwlessusers').click(function() {
									$('#shwmoreuserstrg').css('display', 'block');
									$('#shwmoreusers').css('display', 'none');
								});
								$('#shwmorecommentstrg').click(function() {
									$('#shwmorecommentstrg').css('display', 'none');
									$('#shwmorecomments').css('display', 'block');
								});
								$('#shwlesscomments').click(function() {
									$('#shwmorecommentstrg').css('display', 'block');
									$('#shwmorecomments').css('display', 'none');
								});
								$('#shwmoreratingstrg').click(function() {
									$('#shwmoreratingstrg').css('display', 'none');
									$('#shwmoreratings').css('display', 'block');
								});
								$('#shwlessratings').click(function() {
									$('#shwmoreratingstrg').css('display', 'block');
									$('#shwmoreratings').css('display', 'none');
								});	
								
								$('.tx-tc-subicons').click(function() {
									tccid = this.id;
									tccid = tccid.replace('tx-tc-subicon','');
									$('#tx-tc-subpanel' + tccid).css('display', 'table');
									$('#tx-tc-subpanel' + tccid).slideDown( "slow", function() {
										// Animation complete
										$('#tx-tc-subicon' + tccid).css('display', 'none');
									});	
									var dontshowmaster = 0;
									if (($('#tx-tc-subicon1').css('display') == '') || ($('#tx-tc-subicon1').css('display') == 'none')) {
										dontshowmaster += 1;
									}
									if (($('#tx-tc-subicon2').css('display') == '') || ($('#tx-tc-subicon2').css('display') == 'none')) {
										dontshowmaster += 1;
									}
									if (($('#tx-tc-subicon3').css('display') == '') || ($('#tx-tc-subicon3').css('display') == 'none')) {
										dontshowmaster += 1;
									}
									if (($('#tx-tc-subicon4').css('display') == '') || ($('#tx-tc-subicon4').css('display') == 'none')) {
										dontshowmaster += 1;
									}
									if (($('#tx-tc-subicon5').css('display') == '') || ($('#tx-tc-subicon5').css('display') == 'none')) {
										dontshowmaster += 1;
									}
									if (($('#tx-tc-subicon6').css('display') == '') || ($('#tx-tc-subicon6').css('display') == 'none')) {
										dontshowmaster += 1;
									}
									if (dontshowmaster==6) {
										$('#tx-tc-subiconpanel').css('display', 'none');				
									}
									
								});
							});					
						}
					});
								
				});
			});
		}
		if ((tccid == 'acomment') || (tccid == 'rcomment') || (tccid == 'pcomment')) {
				setTimeout(function() {
					$('#txtcbe-ajaxloadingcomments').css('display', 'none');
				
					$('#txtcbe-ajaxtableusers').html('');
					$('#txtcbe-ajaxtablereports').html('');	
					$('#txtcbe-ajaxtitletableusers').css('display', 'none');
					$('#txtcbe-ajaxtitletableusers').removeClass('tx-tc-dontshow');
					$('#txtcbe-ajaxtitletablereports').removeClass('tx-tc-show');
					$('#txtcbe-ajaxtitletableusers').removeClass('tx-tc-show');
					$('#txtcbe-ajaxtitletablereports').removeClass('tx-tc-dontshow');
					if (tccid == 'rcomment') {
						refreshdata='&refresh=1';
					}
					
					$('#txtcbe-ajaxtableusers').removeClass('tx-tc-dontshow');
					$('#txtcbe-ajaxtablereports').removeClass('tx-tc-show');
					$('#txtcbe-ajaxtableusers').removeClass('tx-tc-show');
					$('#txtcbe-ajaxtablereports').removeClass('tx-tc-dontshow');
	
					$('#txtcbe-ajaxtitletablereports').css('display', 'none');
				}, 1);
				$('#txtcbe-ajaxtablecomments').slideUp( "fast", function() {
				setTimeout(function() {
					// Animation complete			
					$('#txtcbe-ajaxtitletablecomments').css('display', 'block');
					$('#txtcbe-ajaxtablecomments').html('');
					$('#txtcbe-ajaxloadingcomments').css('display', 'block');
				}, 1);
				$('#txtcbe-ajaxloadingcomments').slideDown( "slow", function() {
					// Animation complete
					admincommand = 1;
					$.ajax({
						type: 'POST',
						url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
						async: false,
						data: 'actadmincommand=1&admincommand=' + admincommand + refreshdata,
						success: function(html){
							$('#txtcbe-ajaxloadingcomments').slideUp( "slow", function() {
								// Animation complete								

								$('#txtcbe-ajaxtablecomments').html(html);
								$('#txtcbe-ajaxtablecomments').css('display', 'block');
								$('#txtcbe-ajaxtitletablecomments').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtitletablecomments').removeClass('tx-tc-show');
								$('#txtcbe-ajaxtablecomments').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtablecomments').removeClass('tx-tc-show');
								txtcinittablesorter();
								tablesorteraddons();	
								$('#txtcbe-ajaxloadingcomments').css('display', 'none');									
							});					
						}
					});
								
				});				
					
			});			
		}
		
		if ((tccid == 'auser') || (tccid == 'ruser') || (tccid == 'puser')) {
			setTimeout(function() {
				$('#txtcbe-ajaxloadingusers').css('display', 'none');
				$('#txtcbe-ajaxtablecomments').html('');
				$('#txtcbe-ajaxtablereports').html('');
				$('#txtcbe-ajaxtitletablecomments').css('display', 'none');
				$('#txtcbe-ajaxtitletablereports').css('display', 'none');
				$('#txtcbe-ajaxtitletablecomments').removeClass('tx-tc-dontshow');
				$('#txtcbe-ajaxtitletablereports').removeClass('tx-tc-dontshow');
				$('#txtcbe-ajaxtablecomments').removeClass('tx-tc-dontshow');
				$('#txtcbe-ajaxtablereports').removeClass('tx-tc-dontshow');
				$('#txtcbe-ajaxtitletablecomments').removeClass('tx-tc-show');
				$('#txtcbe-ajaxtitletablereports').removeClass('tx-tc-show');
				$('#txtcbe-ajaxtablecomments').removeClass('tx-tc-show');
				$('#txtcbe-ajaxtablereports').removeClass('tx-tc-show');
				if (tccid == 'ruser') {
					refreshdata='&refresh=1';
				}
			}, 1);
			$('#txtcbe-ajaxtableusers').slideUp( "fast", function() {
				// Animation complete		
				setTimeout(function() {
					$('#txtcbe-ajaxtitletableusers').css('display', 'block');
					$('#txtcbe-ajaxtableusers').html('');
					$('#txtcbe-ajaxloadingusers').css('display', 'block');
				}, 1);
					$('#txtcbe-ajaxloadingusers').slideDown( "slow", function() {
						// Animation complete
					admincommand = 2;
					$.ajax({
						type: 'POST',
						url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
						async: false,
						data: 'actadmincommand=1&admincommand=' + admincommand + refreshdata,
						success: function(html){
							$('#txtcbe-ajaxloadingusers').slideUp( "slow", function() {
								// Animation complete								

								$('#txtcbe-ajaxtableusers').html(html);
								$('#txtcbe-ajaxtableusers').css('display', 'block');
								$('#txtcbe-ajaxtitletableusers').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtitletableusers').removeClass('tx-tc-show');
								$('#txtcbe-ajaxtableusers').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtableusers').removeClass('tx-tc-show');
								txtcinittablesorter();
								tablesorteraddons();	
								$('#txtcbe-ajaxloadingusers').css('display', 'none');									
							});					
						}
					});
									
				});				
					
			});				
		}
		
		if ((tccid == 'areport') || (tccid == 'rreport') || (tccid == 'preport')) {

			$('#txtcbe-ajaxloadingreports').css('display', 'none');
			$('#txtcbe-ajaxtablecomments').html('');
			$('#txtcbe-ajaxtitletablecomments').css('display', 'none');
			$('#txtcbe-ajaxtitletableusers').css('display', 'none');
			$('#txtcbe-ajaxtitletableusers').removeClass('tx-tc-dontshow');
			$('#txtcbe-ajaxtitletablecomments').removeClass('tx-tc-dontshow');
			$('#txtcbe-ajaxtitletableusers').removeClass('tx-tc-show');
			$('#txtcbe-ajaxtitletablecomments').removeClass('tx-tc-show');
			$('#txtcbe-ajaxtableusers').removeClass('tx-tc-dontshow');
			$('#txtcbe-ajaxtablecomments').removeClass('tx-tc-dontshow');
			$('#txtcbe-ajaxtableusers').removeClass('tx-tc-show');
			$('#txtcbe-ajaxtablecomments').removeClass('tx-tc-show');
			$('#txtcbe-ajaxtableusers').html('');
			var intrefresh=1;
			if (tccid == 'rreport') {
				
				refreshdata='&refresh=1';
				reportssave[0] = "";
				reportssave[1] = "";
				reportssave[2] = "";
				reportssave[3] = "";
				reportssave[4] = "";
				intrefresh=0;
			}
			
			$('#txtcbe-ajaxtablereports').slideUp( "fast", function() {
				// Animation complete	
				setTimeout(function() {
					$('#txtcbe-ajaxtitletablereports').css('display', 'block');
					$('#txtcbe-ajaxtablereports').html('');
					$('#txtcbe-ajaxloadingreports').css('display', 'block');
				}, 1);
				
				$('#txtcbe-ajaxloadingreports').slideDown( "slow", function() {
					// Animation complete
					admincommand = 4;
					$.ajax({
						type: 'POST',
						url: 'index.php?ajaxID=AdministrationTocTocASNCAjaxController::indexAction',
						async: false,
						data: 'actadmincommand=1&bulkactreport=0&admincommand=' + admincommand + refreshdata,
						success: function(html){
							$('#txtcbe-ajaxloadingreports').slideUp( "slow", function() {
								// Animation complete								
								
								$('#txtcbe-ajaxtablereports').html(html);
								$('#txtcbe-ajaxtablereports').css('display', 'block');
								$('#txtcbe-ajaxtitletablereports').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtitletablereports').removeClass('tx-tc-show');
								$('#txtcbe-ajaxtablereports').removeClass('tx-tc-dontshow');
								$('#txtcbe-ajaxtablereports').removeClass('tx-tc-show');
								visiblizeReportOptionsIntAjax(lastreportindex, intrefresh);	
								txtcinittablesorter();
								tablesorteraddons();	
								$('#txtcbe-ajaxloadingreports').css('display', 'none');									
							});					
						}
					});
								
				});				
					
			});				
		}

	})(jQuery);
}
//soft scroll to top of the page
function goToByScroll(id){
	  (function($) {
	    $('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
	  })(jQuery);
	}
// backend footer function
function beftr() {
	(function($) {
		tablesorteraddons();
		$('.tx-tc-panelclosebutton').click(function() {
			tccid = this.id;
			tccid = tccid.replace('tx-tc-subpaneltitle','');
			if (($('#tx-tc-subiconpanel').css('display') != 'block')) {
				$('#tx-tc-subiconpanel').css('display', 'block');
			}
			
			$('#tx-tc-subpanel' + tccid).slideUp( "slow", function() {
				// Animation complete
				$('#tx-tc-subpanel' + tccid).css('display', 'none');
				$('#tx-tc-subicon' + tccid).css('display', 'block');
			});	
		});
		$('.tx-tc-be-bulkspamhaus').click(function() {
			bindbulkact(this);
	});
	
	$('.tx-tc-be-bulkdatabase').click(function() {
		bindbulkact(this);
	});
	
	$('.tx-tc-be-bulkcache').click(function() {
		bindbulkact(this);
	});
		
		$('.tx-tc-subicons').click(function() {
			tccid = this.id;
			tccid = tccid.replace('tx-tc-subicon','');
			$('#tx-tc-subpanel' + tccid).css('display', 'table');
			$('#tx-tc-subpanel' + tccid).slideDown( "slow", function() {
				// Animation complete
				$('#tx-tc-subicon' + tccid).css('display', 'none');
			});	
			var dontshowmaster = 0;
			if (($('#tx-tc-subicon1').css('display') == '') || ($('#tx-tc-subicon1').css('display') == 'none')) {
				dontshowmaster += 1;
			}
			if (($('#tx-tc-subicon2').css('display') == '') || ($('#tx-tc-subicon2').css('display') == 'none')) {
				dontshowmaster += 1;
			}
			if (($('#tx-tc-subicon3').css('display') == '') || ($('#tx-tc-subicon3').css('display') == 'none')) {
				dontshowmaster += 1;
			}
			if (($('#tx-tc-subicon4').css('display') == '') || ($('#tx-tc-subicon4').css('display') == 'none')) {
				dontshowmaster += 1;
			}
			if (($('#tx-tc-subicon5').css('display') == '') || ($('#tx-tc-subicon5').css('display') == 'none')) {
				dontshowmaster += 1;
			}
			if (($('#tx-tc-subicon6').css('display') == '') || ($('#tx-tc-subicon6').css('display') == 'none')) {
				dontshowmaster += 1;
			}
			if (dontshowmaster==6) {
				$('#tx-tc-subiconpanel').css('display', 'none');				
			}
			
		});
		$('#shwmoreuserstrg').click(function() {
			$('#shwmoreuserstrg').css('display', 'none');
			$('#shwmoreusers').css('display', 'block');
		});
		$('#shwlessusers').click(function() {
			$('#shwmoreuserstrg').css('display', 'block');
			$('#shwmoreusers').css('display', 'none');
		});
		$('#shwmorecommentstrg').click(function() {
			$('#shwmorecommentstrg').css('display', 'none');
			$('#shwmorecomments').css('display', 'block');
		});
		$('#shwlesscomments').click(function() {
			$('#shwmorecommentstrg').css('display', 'block');
			$('#shwmorecomments').css('display', 'none');
		});
		$('#shwmoreratingstrg').click(function() {
			$('#shwmoreratingstrg').css('display', 'none');
			$('#shwmoreratings').css('display', 'block');
		});
		$('#shwlessratings').click(function() {
			$('#shwmoreratingstrg').css('display', 'block');
			$('#shwmoreratings').css('display', 'none');
		});	
		
		$('.tx-tc-refresh').click(function() {
			postajaxcommand(this.id);
		});
		$('.tx-tc-datarequester').click(function() {
			postajaxcommand(this.id);
			    
		});
		// soft scroll to top of the page
		$('#txtctoptrigger').click(function() {
			goToByScroll('txtctopancer');
		});
		// show/hide overview panel
		$('.tx-tc-showpanel').click(function() {
			tccid = this.id;
			var state=0;
			var psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext;
			var idtestarr = String(tccid).split("6g9");
			if ($('#' + tccid + ' img').attr('src') == '../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-hide.' + picext) {
				psrc='../typo3conf/ext/toctoc_comments/Resources/Public/Icons/actions-edit-unhide.' + picext;
				state=1;
			}
			if ((tccid = 'shwoverview')) {
				if (state==0) {
					$('#txtcbe-ajaxoverview').slideDown( "slow", function() {
						// Animation complete
						$('#txtcbe-ajaxtitleoverview').removeClass('tx-tc-panelbar-collapsed');
					});
				} else {
					$('#txtcbe-ajaxoverview').slideUp( "slow", function() {
						// Animation complete
						$('#txtcbe-ajaxtitleoverview').addClass('tx-tc-panelbar-collapsed');
						
					});	
				}
				$('#' + tccid + ' img').attr({
					  src: psrc
				});
			} 
		});
	})(jQuery);
}
