<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "toctoc_comments".
 *
 * Auto generated 01-02-2014 17:16
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'AJAX Commenting system',
	'description' => 'Adds AJAX commenting and, or rating for main content elements or virtually any record visible in frontend. compatible with TemplaVoila.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '2.2.3',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
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
	'_md5_values_when_last_written' => 'a:156:{s:9:"ChangeLog";s:4:"4682";s:30:"class.toctoc_comments_ajax.php";s:4:"cb1c";s:29:"class.toctoc_comments_api.php";s:4:"f300";s:29:"class.toctoc_comments_eID.php";s:4:"fe2d";s:41:"class.user_toctoc_comments_cms_layout.php";s:4:"9464";s:38:"class.user_toctoc_comments_tcemain.php";s:4:"9e9d";s:37:"class.user_toctoc_comments_ttnews.php";s:4:"090d";s:21:"ext_conf_template.txt";s:4:"446d";s:12:"ext_icon.gif";s:4:"cb51";s:17:"ext_localconf.php";s:4:"7654";s:14:"ext_tables.php";s:4:"a209";s:14:"ext_tables.sql";s:4:"4da3";s:22:"flexform_functions.php";s:4:"6e43";s:27:"icon_tx_toctoc_comments.gif";s:4:"0634";s:37:"icon_tx_toctoc_comments_feuser_mm.gif";s:4:"b806";s:40:"icon_tx_toctoc_comments_not_approved.gif";s:4:"7b2a";s:40:"icon_tx_toctoc_comments_ratings_data.gif";s:4:"4ab9";s:41:"icon_tx_toctoc_comments_ratings_iplog.gif";s:4:"5127";s:37:"icon_tx_toctoc_comments_spamwords.gif";s:4:"3ae0";s:34:"icon_tx_toctoc_comments_urllog.gif";s:4:"2555";s:32:"icon_tx_toctoc_comments_user.gif";s:4:"b806";s:18:"locallang_ajax.xml";s:4:"ea75";s:17:"locallang_csh.xml";s:4:"457a";s:16:"locallang_db.xml";s:4:"a607";s:17:"locallang_eID.xml";s:4:"3f11";s:19:"locallang_hooks.xml";s:4:"36fa";s:7:"tca.php";s:4:"8521";s:51:"controller/class.toctoc_comments_basecontroller.php";s:4:"6b20";s:49:"controller/class.toctoc_comments_fecontroller.php";s:4:"c45d";s:15:"csh/captcha.png";s:4:"41a5";s:14:"doc/manual.pdf";s:4:"cd1d";s:14:"doc/manual.sxw";s:4:"fe54";s:13:"mod1/conf.php";s:4:"c1da";s:14:"mod1/index.php";s:4:"d7f5";s:18:"mod1/locallang.xml";s:4:"6347";s:22:"mod1/locallang_mod.xml";s:4:"016a";s:19:"mod1/moduleicon.gif";s:4:"3228";s:45:"model/class.toctoc_comments_basedatastore.php";s:4:"e250";s:41:"model/class.toctoc_comments_basemodel.php";s:4:"f2f5";s:39:"model/class.toctoc_comments_comment.php";s:4:"be29";s:49:"model/class.toctoc_comments_comment_datastore.php";s:4:"3a49";s:14:"pi1/ce_wiz.gif";s:4:"cee6";s:33:"pi1/class.toctoc_comments_pi1.php";s:4:"bba2";s:46:"pi1/class.user_toctoc_comments_pi1_wizicon.php";s:4:"732b";s:13:"pi1/clear.gif";s:4:"cc11";s:19:"pi1/flexform_ds.xml";s:4:"9efb";s:28:"pi1/flexform_ds_advanced.xml";s:4:"cdcc";s:27:"pi1/flexform_ds_general.xml";s:4:"0ca8";s:27:"pi1/flexform_ds_ratings.xml";s:4:"16b9";s:31:"pi1/flexform_ds_spamprotect.xml";s:4:"5ffa";s:17:"pi1/locallang.xml";s:4:"fbc2";s:21:"pi1/locallang_csh.xml";s:4:"1ff8";s:26:"pi1/toctoc_comment_lib.php";s:4:"9a3e";s:26:"pi1/fonts/Capture it 2.ttf";s:4:"1d78";s:19:"pi1/fonts/Molot.otf";s:4:"41fd";s:27:"pi1/fonts/recaptchaFont.ttf";s:4:"1561";s:29:"pi1/fonts/Walkway rounded.ttf";s:4:"e83d";s:20:"res/css/bemodule.css";s:4:"73f3";s:20:"res/css/idislike.png";s:4:"203e";s:25:"res/css/idislikemaybe.png";s:4:"4f62";s:23:"res/css/idislikered.png";s:4:"bcfb";s:17:"res/css/ilike.png";s:4:"360e";s:22:"res/css/ilikemaybe.png";s:4:"9044";s:26:"res/css/ilikesaturated.png";s:4:"1549";s:41:"res/css/toctoc_comments_myrating_star.png";s:4:"468e";s:40:"res/css/toctoc_comments_rating_stars.png";s:4:"499d";s:30:"res/css/toctoccomments_pi1.css";s:4:"2874";s:34:"res/css/toctoccomments_ratings.css";s:4:"49e8";s:52:"res/css/blacktheme/toctoc_comments_myrating_star.png";s:4:"903b";s:51:"res/css/blacktheme/toctoc_comments_rating_stars.png";s:4:"8d60";s:41:"res/css/blacktheme/toctoccomments_pi1.css";s:4:"b793";s:15:"res/img/asc.gif";s:4:"1baf";s:14:"res/img/bg.gif";s:4:"6dd0";s:29:"res/img/commenting-closed.gif";s:4:"05ac";s:27:"res/img/deletecommentfe.png";s:4:"26fb";s:29:"res/img/denotifycommentfe.png";s:4:"cac3";s:16:"res/img/desc.gif";s:4:"04f1";s:19:"res/img/profile.png";s:4:"ddf0";s:19:"res/img/rclogos.jpg";s:4:"6e3d";s:21:"res/img/rcrefresh.jpg";s:4:"2763";s:19:"res/img/refresh.png";s:4:"5af8";s:21:"res/img/uccontact.png";s:4:"8252";s:16:"res/img/ucip.png";s:4:"87b4";s:19:"res/img/ucstats.png";s:4:"837d";s:34:"res/img/blackrecaptcha/rclogos.jpg";s:4:"e687";s:36:"res/img/blackrecaptcha/rcrefresh.jpg";s:4:"74a8";s:34:"res/img/blackrecaptcha/refresh.png";s:4:"df69";s:23:"res/img/pager/first.png";s:4:"5518";s:22:"res/img/pager/last.png";s:4:"055e";s:22:"res/img/pager/next.png";s:4:"6178";s:22:"res/img/pager/prev.png";s:4:"1448";s:31:"res/img/redrecapcha/rclogos.jpg";s:4:"6e3d";s:33:"res/img/redrecapcha/rcrefresh.jpg";s:4:"2763";s:31:"res/img/redrecapcha/refresh.png";s:4:"d786";s:34:"res/img/whiterecaptcha/rclogos.jpg";s:4:"5a58";s:36:"res/img/whiterecaptcha/rcrefresh.jpg";s:4:"57a6";s:28:"res/js/jquery.elastic-1.6.js";s:4:"4b63";s:32:"res/js/jquery.elastic-1.6.min.js";s:4:"2d6e";s:16:"res/js/jquery.js";s:4:"65b3";s:30:"res/js/jquery.sharrre-1.3.3.js";s:4:"df95";s:28:"res/js/jquery.tablesorter.js";s:4:"ae4b";s:34:"res/js/jquery.tablesorter.pager.js";s:4:"df05";s:18:"res/js/sharrre.php";s:4:"f471";s:28:"res/js/toctoccomments_pi1.js";s:4:"1f2d";s:17:"res/smilie/10.png";s:4:"bd62";s:17:"res/smilie/11.png";s:4:"9238";s:17:"res/smilie/12.png";s:4:"4741";s:17:"res/smilie/13.png";s:4:"0c3f";s:17:"res/smilie/14.png";s:4:"86b4";s:17:"res/smilie/15.png";s:4:"0f36";s:17:"res/smilie/17.png";s:4:"2fa0";s:16:"res/smilie/6.png";s:4:"efff";s:16:"res/smilie/7.png";s:4:"33a9";s:16:"res/smilie/8.png";s:4:"c0f4";s:16:"res/smilie/9.png";s:4:"9fc2";s:20:"res/smilie/angel.png";s:4:"b152";s:23:"res/smilie/confused.png";s:4:"55f2";s:18:"res/smilie/cry.png";s:4:"1b9e";s:24:"res/smilie/curlylips.png";s:4:"e589";s:20:"res/smilie/devil.png";s:4:"65af";s:20:"res/smilie/frown.png";s:4:"673b";s:19:"res/smilie/gasp.png";s:4:"66ca";s:21:"res/smilie/gisele.png";s:4:"ecb3";s:22:"res/smilie/glasses.png";s:4:"9604";s:19:"res/smilie/grin.png";s:4:"9ffd";s:21:"res/smilie/grumpy.png";s:4:"e1ac";s:20:"res/smilie/heart.png";s:4:"5a21";s:21:"res/smilie/jacque.png";s:4:"7947";s:19:"res/smilie/kiki.png";s:4:"a69b";s:19:"res/smilie/kiss.png";s:4:"06cc";s:21:"res/smilie/pacman.png";s:4:"079c";s:22:"res/smilie/penguin.png";s:4:"745a";s:21:"res/smilie/putnam.png";s:4:"2541";s:20:"res/smilie/robot.png";s:4:"6a47";s:20:"res/smilie/roman.png";s:4:"23cb";s:20:"res/smilie/shark.png";s:4:"7ded";s:20:"res/smilie/smile.png";s:4:"7e7e";s:21:"res/smilie/squint.png";s:4:"f5a5";s:25:"res/smilie/sunglasses.png";s:4:"5f4a";s:21:"res/smilie/tongue.png";s:4:"bedf";s:21:"res/smilie/unsure.png";s:4:"f7bb";s:20:"res/smilie/upset.png";s:4:"8ebc";s:19:"res/smilie/wink.png";s:4:"ca72";s:40:"res/template/toctoccomments_ratings.html";s:4:"2858";s:53:"res/template/toctoccomments_reportabuse_template.html";s:4:"693b";s:41:"res/template/toctoccomments_template.html";s:4:"64ba";s:57:"res/template/toctoccomments_template_commentatoremail.txt";s:4:"bd68";s:46:"res/template/toctoccomments_template_email.txt";s:4:"e738";s:50:"res/template/toctoccomments_template_emailinfo.txt";s:4:"7413";s:29:"resources/jquery-1.7.2.min.js";s:4:"b8d6";s:20:"static/constants.txt";s:4:"0617";s:16:"static/setup.txt";s:4:"d87e";s:39:"view/class.toctoc_comments_baseview.php";s:4:"930c";s:40:"view/class.toctoc_comments_errorview.php";s:4:"2da6";s:39:"view/class.toctoc_comments_formview.php";s:4:"161a";s:39:"view/class.toctoc_comments_listview.php";s:4:"2166";}',
);

?>