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
    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY fastaccess (deleted,hidden,approved,pid,external_ref_uid,crdate),
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
    myrating int(11) DEFAULT '0' NOT NULL,
    remote_addr varchar(255) DEFAULT '' NOT NULL,
    toctoc_commentsfeuser_feuser int(11) DEFAULT '0' NOT NULL,    
    toctoc_comments_user varchar(100) DEFAULT '' NOT NULL,
    reference varchar(55) DEFAULT '' NOT NULL,
    PRIMARY KEY (reference,toctoc_comments_user),
    KEY uid (uid),
    KEY idxcntilike (ilike),
    KEY idxcntidislike (idislike),
    KEY fastaccess (deleted,reference,toctoc_commentsfeuser_feuser)
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
    average_rating decimal(19,2) DEFAULT '0.00' NOT NULL,
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
    rating int(11) DEFAULT '0' NOT NULL,
    vote_count int(11) DEFAULT '0' NOT NULL,
    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY reference (reference)
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
    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY ip_check (reference,ip)
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