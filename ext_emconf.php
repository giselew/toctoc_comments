<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "toctoc_comments".
 *
 * Auto generated 01-02-2014 17:12
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'AJAX Social Network Components',
	'description' => 'Modern AJAX-based commenting and rating system. It allows sharing as well. Comments or ratings can be made on content elements or for any record visible in frontend. Compatible with TemplaVoila, tt_news, tt_products, community, cwt_community and many other extensions. Update from comments is possible. Comments can have attachments, BB-Code and smilies. Ratings by voting stars and facebook-like iLikes. Many options for spam-protection. AJAX is based on jQuery. The extension is extremely configurable.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '3.3.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/tx_toctoccomments/temp, uploads/tx_toctoccomments/webpagepreview',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Gisele Wendl',
	'author_email' => 'gisele.wendl@toctoc.ch',
	'author_company' => 'TocToc Internetmanagement',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-100.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:283:{s:9:"ChangeLog";s:4:"80d0";s:30:"class.toctoc_comments_ajax.php";s:4:"34d8";s:29:"class.toctoc_comments_api.php";s:4:"6809";s:29:"class.toctoc_comments_eID.php";s:4:"387f";s:41:"class.user_toctoc_comments_cms_layout.php";s:4:"00b1";s:38:"class.user_toctoc_comments_tcemain.php";s:4:"e9c8";s:37:"class.user_toctoc_comments_ttnews.php";s:4:"a981";s:21:"ext_conf_template.txt";s:4:"0c90";s:12:"ext_icon.gif";s:4:"cb51";s:17:"ext_localconf.php";s:4:"8e16";s:14:"ext_tables.php";s:4:"b5a4";s:14:"ext_tables.sql";s:4:"1d73";s:25:"ext_tables_static+adt.sql";s:4:"37fb";s:22:"flexform_functions.php";s:4:"5c53";s:27:"icon_tx_toctoc_comments.gif";s:4:"0634";s:38:"icon_tx_toctoc_comments_attachment.gif";s:4:"8e68";s:37:"icon_tx_toctoc_comments_feuser_mm.gif";s:4:"b806";s:38:"icon_tx_toctoc_comments_ipbl_local.gif";s:4:"ff1e";s:39:"icon_tx_toctoc_comments_ipbl_static.gif";s:4:"737e";s:40:"icon_tx_toctoc_comments_not_approved.gif";s:4:"7b2a";s:41:"icon_tx_toctoc_comments_prefixtotable.gif";s:4:"6054";s:40:"icon_tx_toctoc_comments_ratings_data.gif";s:4:"4ab9";s:41:"icon_tx_toctoc_comments_ratings_iplog.gif";s:4:"5127";s:37:"icon_tx_toctoc_comments_spamwords.gif";s:4:"3ae0";s:34:"icon_tx_toctoc_comments_urllog.gif";s:4:"2555";s:32:"icon_tx_toctoc_comments_user.gif";s:4:"b806";s:18:"locallang_ajax.xml";s:4:"ea75";s:17:"locallang_csh.xml";s:4:"61f7";s:16:"locallang_db.xml";s:4:"8dd6";s:17:"locallang_eID.xml";s:4:"56ac";s:19:"locallang_hooks.xml";s:4:"9f30";s:7:"tca.php";s:4:"f70b";s:15:"csh/captcha.png";s:4:"41a5";s:24:"doc/manual developer.pdf";s:4:"82f3";s:24:"doc/manual developer.sxw";s:4:"619e";s:14:"doc/manual.pdf";s:4:"18d3";s:14:"doc/manual.sxw";s:4:"0c4e";s:13:"doc/Thumbs.db";s:4:"1d70";s:13:"mod1/conf.php";s:4:"c1da";s:14:"mod1/index.php";s:4:"550d";s:18:"mod1/locallang.xml";s:4:"6347";s:22:"mod1/locallang_mod.xml";s:4:"016a";s:19:"mod1/moduleicon.gif";s:4:"3228";s:14:"pi1/ce_wiz.gif";s:4:"cee6";s:46:"pi1/class.toctoc_comments_attachmentupload.php";s:4:"8a9c";s:33:"pi1/class.toctoc_comments_pi1.php";s:4:"dced";s:45:"pi1/class.toctoc_comments_seostats.google.php";s:4:"29c2";s:38:"pi1/class.toctoc_comments_seostats.php";s:4:"914c";s:44:"pi1/class.toctoc_comments_webpagepreview.php";s:4:"da69";s:49:"pi1/class.toctoc_comments_webpagepreview_ajax.php";s:4:"43ce";s:46:"pi1/class.user_toctoc_comments_pi1_wizicon.php";s:4:"579b";s:13:"pi1/clear.gif";s:4:"cc11";s:19:"pi1/flexform_ds.xml";s:4:"4077";s:28:"pi1/flexform_ds_advanced.xml";s:4:"d2c8";s:31:"pi1/flexform_ds_attachments.xml";s:4:"5f96";s:27:"pi1/flexform_ds_general.xml";s:4:"e694";s:27:"pi1/flexform_ds_ratings.xml";s:4:"16b9";s:31:"pi1/flexform_ds_spamprotect.xml";s:4:"f2db";s:17:"pi1/locallang.xml";s:4:"f0d8";s:21:"pi1/locallang_csh.xml";s:4:"2d4b";s:26:"pi1/toctoc_comment_lib.php";s:4:"82dd";s:26:"pi1/fonts/Capture it 2.ttf";s:4:"1d78";s:19:"pi1/fonts/Molot.otf";s:4:"41fd";s:27:"pi1/fonts/recaptchaFont.ttf";s:4:"1561";s:29:"pi1/fonts/Walkway rounded.ttf";s:4:"e83d";s:20:"res/css/bemodule.css";s:4:"73f3";s:20:"res/css/idislike.png";s:4:"203e";s:25:"res/css/idislikemaybe.png";s:4:"4f62";s:23:"res/css/idislikered.png";s:4:"bcfb";s:17:"res/css/ilike.png";s:4:"360e";s:22:"res/css/ilikemaybe.png";s:4:"9044";s:26:"res/css/ilikesaturated.png";s:4:"1549";s:19:"res/css/tx-tc30.css";s:4:"481e";s:30:"res/css/themes/black/theme.txt";s:4:"4c69";s:42:"res/css/themes/black/css/tx-tc30-theme.css";s:4:"8c74";s:36:"res/css/themes/black/img/black90.png";s:4:"16f0";s:43:"res/css/themes/black/img/ceditcommentfe.png";s:4:"9fd8";s:34:"res/css/themes/black/img/close.png";s:4:"e934";s:38:"res/css/themes/black/img/closehuge.png";s:4:"454e";s:37:"res/css/themes/black/img/closejqt.png";s:4:"6347";s:37:"res/css/themes/black/img/closesml.png";s:4:"77ff";s:44:"res/css/themes/black/img/deletecommentfe.png";s:4:"b7c1";s:46:"res/css/themes/black/img/denotifycommentfe.png";s:4:"c266";s:42:"res/css/themes/black/img/editcommentfe.png";s:4:"1dcf";s:38:"res/css/themes/black/img/nopreview.png";s:4:"26fb";s:41:"res/css/themes/black/img/nopreviewpic.png";s:4:"d830";s:36:"res/css/themes/black/img/profile.png";s:4:"96f8";s:37:"res/css/themes/black/img/profilef.png";s:4:"c179";s:36:"res/css/themes/black/img/rclogos.jpg";s:4:"e687";s:38:"res/css/themes/black/img/rcrefresh.jpg";s:4:"74a8";s:34:"res/css/themes/black/img/red90.png";s:4:"b0b9";s:36:"res/css/themes/black/img/refresh.png";s:4:"df69";s:40:"res/css/themes/black/img/savecomment.png";s:4:"8f65";s:39:"res/css/themes/black/img/tccollapse.png";s:4:"5f81";s:37:"res/css/themes/black/img/tcexpand.png";s:4:"fb4f";s:37:"res/css/themes/black/img/tiparrow.png";s:4:"58bd";s:58:"res/css/themes/black/img/toctoc_comments_myrating_star.png";s:4:"903b";s:57:"res/css/themes/black/img/toctoc_comments_rating_stars.png";s:4:"8d60";s:38:"res/css/themes/black/img/uploadpdf.png";s:4:"ca92";s:38:"res/css/themes/black/img/uploadpic.png";s:4:"312e";s:36:"res/css/themes/black/img/white90.png";s:4:"746e";s:32:"res/css/themes/default/theme.txt";s:4:"c9b1";s:44:"res/css/themes/default/css/tx-tc30-theme.css";s:4:"6652";s:38:"res/css/themes/default/img/black90.png";s:4:"16f0";s:45:"res/css/themes/default/img/ceditcommentfe.png";s:4:"9fd8";s:36:"res/css/themes/default/img/close.png";s:4:"3847";s:40:"res/css/themes/default/img/closehuge.png";s:4:"454e";s:39:"res/css/themes/default/img/closejqt.png";s:4:"1e5e";s:39:"res/css/themes/default/img/closesml.png";s:4:"4551";s:46:"res/css/themes/default/img/deletecommentfe.png";s:4:"c32e";s:48:"res/css/themes/default/img/denotifycommentfe.png";s:4:"ab05";s:44:"res/css/themes/default/img/editcommentfe.png";s:4:"8e3e";s:40:"res/css/themes/default/img/nopreview.png";s:4:"26fb";s:43:"res/css/themes/default/img/nopreviewpic.png";s:4:"a09f";s:38:"res/css/themes/default/img/profile.png";s:4:"da02";s:39:"res/css/themes/default/img/profilef.png";s:4:"cdd8";s:38:"res/css/themes/default/img/rclogos.jpg";s:4:"5a58";s:40:"res/css/themes/default/img/rcrefresh.jpg";s:4:"57a6";s:36:"res/css/themes/default/img/red90.png";s:4:"b0b9";s:38:"res/css/themes/default/img/refresh.png";s:4:"5af8";s:42:"res/css/themes/default/img/savecomment.png";s:4:"9b42";s:41:"res/css/themes/default/img/tccollapse.png";s:4:"5f81";s:39:"res/css/themes/default/img/tcexpand.png";s:4:"fb4f";s:39:"res/css/themes/default/img/tiparrow.png";s:4:"abc6";s:60:"res/css/themes/default/img/toctoc_comments_myrating_star.png";s:4:"468e";s:59:"res/css/themes/default/img/toctoc_comments_rating_stars.png";s:4:"499d";s:40:"res/css/themes/default/img/uploadpdf.png";s:4:"ca92";s:40:"res/css/themes/default/img/uploadpic.png";s:4:"312e";s:38:"res/css/themes/default/img/white90.png";s:4:"746e";s:28:"res/css/themes/red/theme.txt";s:4:"5dd1";s:40:"res/css/themes/red/css/tx-tc30-theme.css";s:4:"c7af";s:34:"res/css/themes/red/img/black90.png";s:4:"16f0";s:41:"res/css/themes/red/img/ceditcommentfe.png";s:4:"9fd8";s:32:"res/css/themes/red/img/close.png";s:4:"e934";s:36:"res/css/themes/red/img/closehuge.png";s:4:"454e";s:35:"res/css/themes/red/img/closejqt.png";s:4:"acd9";s:35:"res/css/themes/red/img/closesml.png";s:4:"77ff";s:42:"res/css/themes/red/img/deletecommentfe.png";s:4:"b7c1";s:44:"res/css/themes/red/img/denotifycommentfe.png";s:4:"c266";s:40:"res/css/themes/red/img/editcommentfe.png";s:4:"1dcf";s:36:"res/css/themes/red/img/nopreview.png";s:4:"26fb";s:39:"res/css/themes/red/img/nopreviewpic.png";s:4:"d830";s:34:"res/css/themes/red/img/profile.png";s:4:"76b1";s:35:"res/css/themes/red/img/profilef.png";s:4:"10dc";s:34:"res/css/themes/red/img/rclogos.jpg";s:4:"6e3d";s:36:"res/css/themes/red/img/rcrefresh.jpg";s:4:"2763";s:32:"res/css/themes/red/img/red90.png";s:4:"b0b9";s:34:"res/css/themes/red/img/refresh.png";s:4:"d786";s:38:"res/css/themes/red/img/savecomment.png";s:4:"8f65";s:37:"res/css/themes/red/img/tccollapse.png";s:4:"5f81";s:35:"res/css/themes/red/img/tcexpand.png";s:4:"fb4f";s:35:"res/css/themes/red/img/tiparrow.png";s:4:"e185";s:56:"res/css/themes/red/img/toctoc_comments_myrating_star.png";s:4:"dda4";s:55:"res/css/themes/red/img/toctoc_comments_rating_stars.png";s:4:"896a";s:36:"res/css/themes/red/img/uploadpdf.png";s:4:"ca92";s:36:"res/css/themes/red/img/uploadpic.png";s:4:"312e";s:34:"res/css/themes/red/img/white90.png";s:4:"746e";s:29:"res/css/themes/work/theme.txt";s:4:"c9b1";s:41:"res/css/themes/work/css/tx-tc30-theme.css";s:4:"6652";s:35:"res/css/themes/work/img/black90.png";s:4:"16f0";s:42:"res/css/themes/work/img/ceditcommentfe.png";s:4:"9fd8";s:33:"res/css/themes/work/img/close.png";s:4:"3847";s:37:"res/css/themes/work/img/closehuge.png";s:4:"454e";s:36:"res/css/themes/work/img/closejqt.png";s:4:"1e5e";s:36:"res/css/themes/work/img/closesml.png";s:4:"4551";s:43:"res/css/themes/work/img/deletecommentfe.png";s:4:"c32e";s:45:"res/css/themes/work/img/denotifycommentfe.png";s:4:"ab05";s:41:"res/css/themes/work/img/editcommentfe.png";s:4:"8e3e";s:37:"res/css/themes/work/img/nopreview.png";s:4:"26fb";s:40:"res/css/themes/work/img/nopreviewpic.png";s:4:"a09f";s:35:"res/css/themes/work/img/profile.png";s:4:"da02";s:36:"res/css/themes/work/img/profilef.png";s:4:"cdd8";s:35:"res/css/themes/work/img/rclogos.jpg";s:4:"5a58";s:37:"res/css/themes/work/img/rcrefresh.jpg";s:4:"57a6";s:33:"res/css/themes/work/img/red90.png";s:4:"b0b9";s:35:"res/css/themes/work/img/refresh.png";s:4:"5af8";s:39:"res/css/themes/work/img/savecomment.png";s:4:"9b42";s:38:"res/css/themes/work/img/tccollapse.png";s:4:"5f81";s:36:"res/css/themes/work/img/tcexpand.png";s:4:"fb4f";s:36:"res/css/themes/work/img/tiparrow.png";s:4:"abc6";s:57:"res/css/themes/work/img/toctoc_comments_myrating_star.png";s:4:"468e";s:56:"res/css/themes/work/img/toctoc_comments_rating_stars.png";s:4:"499d";s:37:"res/css/themes/work/img/uploadpdf.png";s:4:"ca92";s:37:"res/css/themes/work/img/uploadpic.png";s:4:"312e";s:35:"res/css/themes/work/img/white90.png";s:4:"746e";s:20:"res/img/adobepdf.png";s:4:"6113";s:15:"res/img/asc.gif";s:4:"1baf";s:14:"res/img/bg.gif";s:4:"6dd0";s:29:"res/img/commenting-closed.gif";s:4:"05ac";s:16:"res/img/desc.gif";s:4:"04f1";s:16:"res/img/next.png";s:4:"af4d";s:16:"res/img/prev.png";s:4:"5390";s:18:"res/img/report.png";s:4:"c38d";s:21:"res/img/uccontact.png";s:4:"8252";s:16:"res/img/ucip.png";s:4:"87b4";s:19:"res/img/ucstats.png";s:4:"837d";s:20:"res/img/usericon.gif";s:4:"0bef";s:25:"res/img/workingslides.gif";s:4:"707d";s:38:"res/img/blacktheme/deletecommentfe.png";s:4:"b7c1";s:40:"res/img/blacktheme/denotifycommentfe.png";s:4:"4a2b";s:36:"res/img/blacktheme/editcommentfe.png";s:4:"1dcf";s:35:"res/img/blacktheme/nopreviewpic.png";s:4:"d830";s:34:"res/img/blacktheme/savecomment.png";s:4:"8f65";s:23:"res/img/pager/first.png";s:4:"5518";s:22:"res/img/pager/last.png";s:4:"055e";s:22:"res/img/pager/next.png";s:4:"6178";s:22:"res/img/pager/prev.png";s:4:"1448";s:28:"res/js/jquery.elastic-1.6.js";s:4:"4b63";s:32:"res/js/jquery.elastic-1.6.min.js";s:4:"2d6e";s:16:"res/js/jquery.js";s:4:"65b3";s:30:"res/js/jquery.sharrre-1.3.3.js";s:4:"df95";s:38:"res/js/jquery.simplemodal.1.4.3.min.js";s:4:"d701";s:28:"res/js/jquery.tablesorter.js";s:4:"ae4b";s:34:"res/js/jquery.tablesorter.pager.js";s:4:"df05";s:26:"res/js/jquery.tools.min.js";s:4:"9f09";s:26:"res/js/jquery.watermark.js";s:4:"75da";s:18:"res/js/sharrre.php";s:4:"f471";s:17:"res/js/tx-tc30.js";s:4:"10aa";s:17:"res/smilie/10.png";s:4:"bd62";s:17:"res/smilie/11.png";s:4:"9238";s:17:"res/smilie/12.png";s:4:"4741";s:17:"res/smilie/13.png";s:4:"0c3f";s:17:"res/smilie/14.png";s:4:"86b4";s:17:"res/smilie/15.png";s:4:"0f36";s:17:"res/smilie/17.png";s:4:"2fa0";s:16:"res/smilie/6.png";s:4:"efff";s:16:"res/smilie/7.png";s:4:"33a9";s:16:"res/smilie/8.png";s:4:"c0f4";s:16:"res/smilie/9.png";s:4:"9fc2";s:20:"res/smilie/angel.png";s:4:"b152";s:23:"res/smilie/confused.png";s:4:"55f2";s:18:"res/smilie/cry.png";s:4:"1b9e";s:24:"res/smilie/curlylips.png";s:4:"e589";s:20:"res/smilie/devil.png";s:4:"65af";s:20:"res/smilie/frown.png";s:4:"673b";s:19:"res/smilie/gasp.png";s:4:"66ca";s:21:"res/smilie/gisele.png";s:4:"ecb3";s:22:"res/smilie/glasses.png";s:4:"9604";s:19:"res/smilie/grin.png";s:4:"9ffd";s:21:"res/smilie/grumpy.png";s:4:"e1ac";s:20:"res/smilie/heart.png";s:4:"5a21";s:21:"res/smilie/jacque.png";s:4:"7947";s:19:"res/smilie/kiki.png";s:4:"a69b";s:19:"res/smilie/kiss.png";s:4:"06cc";s:21:"res/smilie/pacman.png";s:4:"079c";s:22:"res/smilie/penguin.png";s:4:"745a";s:21:"res/smilie/putnam.png";s:4:"2541";s:20:"res/smilie/robot.png";s:4:"6a47";s:20:"res/smilie/roman.png";s:4:"23cb";s:20:"res/smilie/shark.png";s:4:"7ded";s:20:"res/smilie/smile.png";s:4:"7e7e";s:21:"res/smilie/squint.png";s:4:"f5a5";s:25:"res/smilie/sunglasses.png";s:4:"5f4a";s:21:"res/smilie/tongue.png";s:4:"bedf";s:21:"res/smilie/unsure.png";s:4:"f7bb";s:20:"res/smilie/upset.png";s:4:"8ebc";s:19:"res/smilie/wink.png";s:4:"ca72";s:40:"res/template/toctoccomments_ratings.html";s:4:"f1cf";s:41:"res/template/toctoccomments_template.html";s:4:"4cf5";s:59:"res/template/toctoccomments_template_commentator_email.html";s:4:"f9ce";s:57:"res/template/toctoccomments_template_commentatoremail.txt";s:4:"9716";s:45:"res/template/toctoccomments_template_eid.html";s:4:"7e5b";s:47:"res/template/toctoccomments_template_email.html";s:4:"259c";s:46:"res/template/toctoccomments_template_email.txt";s:4:"1d9e";s:51:"res/template/toctoccomments_template_email_coi.html";s:4:"60ce";s:50:"res/template/toctoccomments_template_email_coi.txt";s:4:"7921";s:50:"res/template/toctoccomments_template_emailinfo.txt";s:4:"5da2";s:61:"res/template/toctoccomments_template_reportcomment_email.html";s:4:"f0ad";s:60:"res/template/toctoccomments_template_reportcomment_email.txt";s:4:"d155";s:35:"res/template/mailimg/pixeltrans.gif";s:4:"bf92";s:53:"res/template/mailimg/toctoc_comments_banner_admin.jpg";s:4:"ac38";s:52:"res/template/mailimg/toctoc_comments_banner_user.jpg";s:4:"abc8";s:45:"res/template/mailimg/toctoc_comments_logo.jpg";s:4:"0827";s:48:"res/template/mailimg/toctoc_comments_mailico.jpg";s:4:"571b";s:30:"resources/createstaticdata.php";s:4:"9a73";s:30:"resources/createstaticdata.txt";s:4:"cf12";s:29:"resources/jquery-1.7.2.min.js";s:4:"b8d6";s:29:"resources/jquery.watermark.js";s:4:"75da";s:33:"resources/jquery.watermark.min.js";s:4:"ad60";s:44:"resources/original_ext_tables_static+adt.sql";s:4:"37fb";s:44:"resources/toctoc_comments_mod_extensions.txt";s:4:"cff1";s:20:"static/constants.txt";s:4:"43a3";s:16:"static/setup.txt";s:4:"353e";}',
);

?>