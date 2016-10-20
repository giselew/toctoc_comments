#
# Table structure for table 'tx_toctoc_comments_comments'
#
CREATE TABLE tx_toctoc_comments_comments (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(1) unsigned DEFAULT '0' NOT NULL,
	approved int(1) DEFAULT '0' NOT NULL,
	external_ref varchar(255) DEFAULT '' NOT NULL,
	external_prefix varchar(255) DEFAULT '' NOT NULL,
	gender int(1) DEFAULT '0' NOT NULL,
	commenttitle varchar(255) DEFAULT '' NOT NULL,
	firstname varchar(255) DEFAULT '' NOT NULL,
	lastname varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	homepage text NOT NULL,
	location varchar(255) DEFAULT '' NOT NULL,
	content text NOT NULL,
	remote_addr varchar(255) DEFAULT '' NOT NULL,
	double_post_check varchar(32) DEFAULT '' NOT NULL,
	external_ref_uid varchar(255) DEFAULT '' NOT NULL,
	toctoc_commentsfeuser_feuser int(11) DEFAULT '0' NOT NULL,
	toctoc_comments_user varchar(100) DEFAULT '' NOT NULL,
	tx_commentsnotify_notify tinyint(1) unsigned default '0' NOT NULL,
	attachment_id int(11) DEFAULT '0' NOT NULL,
	attachment_subid  int(11) DEFAULT '0' NOT NULL,
	parentuid int(11) unsigned DEFAULT '0' NOT NULL,
	tx_commentsresponse_response text NOT NULL,
	isreview int(1) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY fastaccess (deleted,hidden,approved,pid,external_ref_uid,crdate),
	KEY commoncomm (parentuid,uid),
	KEY tcemainhookcid (external_ref_uid,deleted),
	KEY tcemainhook (external_ref,deleted)
);

#
# Table structure for table 'tx_toctoc_comments_feuser_mm'
#
CREATE TABLE tx_toctoc_comments_feuser_mm (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	ilike int(1) DEFAULT '0' NOT NULL,
	idislike int(1) DEFAULT '0' NOT NULL,
	myrating decimal(19,8) DEFAULT '0.00000000' NOT NULL,
	seen int(11) DEFAULT '0' NOT NULL,
	remote_addr varchar(255) DEFAULT '' NOT NULL,
	toctoc_commentsfeuser_feuser int(11) DEFAULT '0' NOT NULL,
	toctoc_comments_user varchar(100) DEFAULT '' NOT NULL,
	reference varchar(55) DEFAULT '' NOT NULL,
	reference_scope int(11) DEFAULT '0' NOT NULL,
	tstampilike int(11) unsigned DEFAULT '0' NOT NULL,
	tstampidislike int(11) unsigned DEFAULT '0' NOT NULL,
	tstampmyrating int(11) unsigned DEFAULT '0' NOT NULL,
	tstampseen int(11) unsigned DEFAULT '0' NOT NULL,
	pagetstampilike int(11) unsigned DEFAULT '0' NOT NULL,
	pagetstampidislike int(11) unsigned DEFAULT '0' NOT NULL,
	pagetstampmyrating int(11) unsigned DEFAULT '0' NOT NULL,
	pagetstampseen int(11) unsigned DEFAULT '0' NOT NULL,
	isreview int(1) DEFAULT '0' NOT NULL,
	emolikeid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (reference,reference_scope,toctoc_comments_user,pid),
	KEY uid (uid),
	KEY idxcntilike (ilike),
	KEY idxcntidislike (idislike),
	KEY idxcntseen (seen),
	KEY fastaccess (deleted,reference,reference_scope,toctoc_commentsfeuser_feuser)
);

#
# Table structure for table 'tx_toctoc_comments_user'
#
CREATE TABLE tx_toctoc_comments_user (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	toctoc_comments_user varchar(100) DEFAULT '' NOT NULL,
	ip varchar(255) DEFAULT '0' NOT NULL,
	ipresolved varchar(255) DEFAULT '0' NOT NULL,
	initial_firstname varchar(255) DEFAULT '' NOT NULL,
	initial_lastname varchar(255) DEFAULT '' NOT NULL,
	initial_email varchar(255) DEFAULT '' NOT NULL,
	initial_homepage varchar(255) DEFAULT '' NOT NULL,
	initial_location varchar(255) DEFAULT '' NOT NULL,
	comment_count int(11) DEFAULT '0' NOT NULL,
	average_rating decimal(19,8) DEFAULT '0.00000000' NOT NULL,
	vote_count int(11) DEFAULT '0' NOT NULL,
	like_count int(11) DEFAULT '0' NOT NULL,
	dislike_count int(11) DEFAULT '0' NOT NULL,
	current_firstname varchar(255) DEFAULT '' NOT NULL,
	current_lastname varchar(255) DEFAULT '' NOT NULL,
	current_email varchar(255) DEFAULT '' NOT NULL,
	current_homepage varchar(255) DEFAULT '' NOT NULL,
	current_location varchar(255) DEFAULT '' NOT NULL,
	current_ip varchar(255) DEFAULT '0' NOT NULL,
	tstamp_lastupdate int(11) unsigned DEFAULT '0' NOT NULL,
	optindate int(11) unsigned DEFAULT '0' NOT NULL,
	optin_email varchar(255) DEFAULT '' NOT NULL,
	optin_ip varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (toctoc_comments_user,pid),
	KEY parent (pid),
	KEY uid (uid)
);
#
# Table structure for table 'tx_toctoc_comments_urllog'
#
CREATE TABLE tx_toctoc_comments_urllog (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	external_ref varchar(255) DEFAULT '' NOT NULL,
	url text NOT NULL,
	external_ref_uid varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY tcemainhookcid (external_ref_uid,deleted),
	KEY tcemainhook (external_ref,deleted)
);

#
# Table structure for table 'tx_toctoc_ratings_data'
#
CREATE TABLE tx_toctoc_ratings_data (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	reference varchar(55) DEFAULT '' NOT NULL,
	rating decimal(19,6) DEFAULT '0.000000' NOT NULL,
	vote_count decimal(19,6) DEFAULT '0.000000' NOT NULL,
	reference_scope int(11) DEFAULT '0' NOT NULL,
	isreview int(1) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY reference (reference,reference_scope)
);

#
# Table structure for table 'tx_toctoc_ratings_iplog'
#
CREATE TABLE tx_toctoc_ratings_iplog (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	reference varchar(55) DEFAULT '' NOT NULL,
	ip varchar(255) DEFAULT '0' NOT NULL,
	reference_scope int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY ip_check (reference,reference_scope,ip(64))
);

#
# Table structure for table 'tx_toctoc_ratings_scope'
#
CREATE TABLE tx_toctoc_ratings_scope (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	scope_title varchar(255) DEFAULT '' NOT NULL,
	scope_description varchar(255) DEFAULT '' NOT NULL,
	display_order tinyint(10) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY scope (sys_language_uid,scope_title),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)
);

#
# Table structure for table 'tx_toctoc_comments_spamwords'
#
CREATE TABLE tx_toctoc_comments_spamwords (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	spamword varchar(255) DEFAULT '' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	spamvalue int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY spamword (sys_language_uid,spamword)
);

#
# Table structure for table 'tx_toctoc_comments_attachment'
#
CREATE TABLE tx_toctoc_comments_attachment (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	attachmentvariant int(11) DEFAULT '0' NOT NULL,
	systemurltext tinytext NOT NULL,
	photo_main blob NOT NULL,
	photos_etc blob NOT NULL,
	title tinytext NOT NULL,
	description tinytext NOT NULL,
	attachmentfilesize int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY att_url (attachmentvariant,systemurltext(64))
);

#
# Table structure for table 'tx_toctoc_comments_attachment_mm'
#
CREATE TABLE tx_toctoc_comments_attachment_mm (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	attachmentid int(11) DEFAULT '0' NOT NULL,
   	userurltext tinytext NOT NULL,
	reference varchar(55) DEFAULT '' NOT NULL,
	PRIMARY KEY (uid),
	KEY att_mmref (reference,attachmentid),
	KEY att_mmurl (userurltext(64))
);


#
# Table structure for table 'tx_toctoc_comments_sharing'
#
CREATE TABLE tx_toctoc_comments_sharing (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	reference int(11) unsigned DEFAULT '0' NOT NULL,
	external_ref varchar(255) DEFAULT '' NOT NULL,
	external_prefix varchar(255) DEFAULT '' NOT NULL,
	sharer varchar(255) DEFAULT '' NOT NULL,
   	shareurl tinytext NOT NULL,
    	sharecount int(11) DEFAULT '0' NOT NULL,
    	sys_language_uid int(11) unsigned DEFAULT '0' NOT NULL,
 	PRIMARY KEY (uid),
	KEY shr_sharer (sharer,shareurl(64)),
	KEY shr_url (shareurl(64))
);

#
# Table structure for table 'tx_toctoc_comments_emolike'
#
CREATE TABLE tx_toctoc_comments_emolike (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	emolike_ll tinytext NOT NULL,
	emolike_setfolder tinytext NOT NULL,
	emolike_setpos int(11) unsigned DEFAULT '0' NOT NULL,
	emolike_rating int(11) unsigned DEFAULT '0' NOT NULL,
	emolike_sort int(11) unsigned DEFAULT '0' NOT NULL,
	emolike_engagement int(11) unsigned DEFAULT '0' NOT NULL,
	emolike_colorcode tinytext NOT NULL,
	PRIMARY KEY (uid)
);

#
# Table structure for table 'tx_toctoc_comments_prefixtotable'
#
CREATE TABLE tx_toctoc_comments_prefixtotable (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,
	pi1_key tinytext NOT NULL,
	pi1_table tinytext NOT NULL,
	show_uid tinytext NOT NULL,
	displayfields tinytext NOT NULL,
	topratingsimagesfolder tinytext NOT NULL,
	topratingsdetailpage int(11) unsigned DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	KEY pi1_key (pi1_key(64)),
	KEY pi1_table (pi1_table(64))
);

#
# Table structure for table 'tx_toctoc_comments_ipbl_local'
#
CREATE TABLE tx_toctoc_comments_ipbl_local (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	ipaddr varchar(255) DEFAULT '' NOT NULL,
	blockfe int(11) DEFAULT '0' NOT NULL,
	comment text,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY ipaddr (ipaddr(50))
);

#
# Table structure for table 'tx_toctoc_comments_ipbl_static'
#
CREATE TABLE tx_toctoc_comments_ipbl_static (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	ipaddr varchar(80) DEFAULT '' NOT NULL,
	comment text,
	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY ipnr (ipaddr(32))
);

#
# Table structure for table 'tx_toctoc_comments_plugincachecontrol'
#
CREATE TABLE tx_toctoc_comments_plugincachecontrol (
	uid int(11) NOT NULL auto_increment,
	external_ref_uid char(100) DEFAULT '' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	PRIMARY KEY (uid),
	UNIQUE KEY external_ref_uid (external_ref_uid)
);

#
# Table structure for table 'tx_toctoc_comments_cacheajax'
#
CREATE TABLE tx_toctoc_comments_cacheajax (
	uid int(11) NOT NULL auto_increment,
	crdate int(11) DEFAULT '0' NOT NULL,
	AJAXCache char(20) DEFAULT '' NOT NULL,
	md5Data char(32) DEFAULT '' NOT NULL,
	AJAXdata blob NOT NULL,
	PRIMARY KEY (uid),
	UNIQUE KEY Xmd5DataCache (AJAXCache,md5Data)
);

#
# Table structure for table 'tx_toctoc_comments_cachereport'
#
CREATE TABLE tx_toctoc_comments_cachereport (
	uid int(11) NOT NULL auto_increment,
	crdate int(11) DEFAULT '0' NOT NULL,
	md5PluginId char(32) DEFAULT '' NOT NULL,
	ReportPluginMode int(11) DEFAULT '0' NOT NULL,
	ReportUser char(11) DEFAULT '0' NOT NULL,
	ReportData blob NOT NULL,
	external_ref_uid char(100) DEFAULT '' NOT NULL,
	PRIMARY KEY (uid),
	UNIQUE KEY XReportUserCache (md5PluginId,ReportUser),
	KEY XexternalRefUid (external_ref_uid)
);

#
# Table structure for table 'tx_toctoc_comments_cache'
#
CREATE TABLE tx_toctoc_comments_cache (
    id int(11) NOT NULL auto_increment,
    identifier varchar(250) DEFAULT '' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    content mediumblob,
    lifetime int(11) DEFAULT '0' NOT NULL,
    PRIMARY KEY (id),
    KEY cache_id (identifier)
);

#
# TABLE STRUCTURE FOR TABLE 'tx_toctoc_comments_cache_tags'
#
CREATE TABLE tx_toctoc_comments_cache_tags (
    id int(11) NOT NULL auto_increment,
    identifier varchar(250) DEFAULT '' NOT NULL,
    tag varchar(250) DEFAULT '' NOT NULL,
    PRIMARY KEY (id),
    KEY cache_id (identifier),
    KEY cache_tag (tag)
);

#
# TABLE STRUCTURE FOR TABLE 'tx_toctoc_comments_cache_mailconf'
#
CREATE TABLE tx_toctoc_comments_cache_mailconf (
    id int(11) NOT NULL auto_increment,
    crdate int(11) DEFAULT '1471672855' NOT NULL,
    mailconf text NOT NULL,
    PRIMARY KEY (id)
);

#
# TABLE STRUCTURE FOR TABLE 'tx_toctoc_comments_longuidreference'
#
CREATE TABLE tx_toctoc_comments_longuidreference (
    uid int(11) NOT NULL auto_increment,
    externaluid varchar(255) DEFAULT '' NOT NULL,
    PRIMARY KEY (uid),
    KEY external_uid (externaluid)
);

#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
    gender int(11) unsigned DEFAULT '0' NOT NULL,
    tx_toctoc_comments_facebook_id tinytext,
    tx_toctoc_comments_facebook_link tinytext,
    tx_toctoc_comments_facebook_gender tinytext,
    tx_toctoc_comments_facebook_email tinytext,
    tx_toctoc_comments_facebook_locale varchar(5) DEFAULT '' NOT NULL,
    tx_toctoc_comments_facebook_updated_time varchar(25) DEFAULT '' NOT NULL
);
