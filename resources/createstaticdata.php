<?php
// this is a commandline script, it imports a fresh list from www.spamhaus.org
// you need to adjust the storagePid to the TYPO3 folder where your static IP-blocking list is located
$storagePid=3;
function fetchDropLasso() {
	if (!extension_loaded('curl')) {
		die('curl extension is required!');
	}
	if (!($ch = curl_init('http://www.spamhaus.org/DROP/drop.lasso'))) {
		die('Could not create curl channel!');
	}

	$file = tempnam(is_callable('sys_get_temp_dir') ? sys_get_temp_dir() : '/tmp', '');
	$fd = fopen($file, 'w+');
	curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
	curl_setopt($ch, CURLOPT_MUTE, TRUE);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
	curl_setopt($ch, CURLOPT_FILE, $fd);
	curl_exec($ch);
	fclose($fd);
	if (($failed = (curl_errno($ch) != 0))) {
		echo 'curl failed with error %d [%s]', curl_errno($ch), curl_error($ch);
	}
	curl_close($ch);
	if ($failed) {
		@unlink($file);
		die;
	}
	return $file;
}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$fd: ...
	 * @return	[type]		...
	 */
function createTableDef($fd) {
	fwrite($fd, '#
# Table structure for table \'tx_toctoc_comments_ipbl_static\'
#
DROP TABLE IF EXISTS tx_toctoc_comments_ipbl_static;
CREATE TABLE tx_toctoc_comments_ipbl_static (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT \'0\' NOT NULL,
	tstamp int(11) DEFAULT \'0\' NOT NULL,
	crdate int(11) DEFAULT \'0\' NOT NULL,
	cruser_id int(11) DEFAULT \'0\' NOT NULL,
	ipaddr varchar(80) DEFAULT \'\' NOT NULL,
	comment text,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY ipaddr (ipaddr(22))
);

');
}

if ($_SERVER['REMOTE_ADDR']) {
	// May not be called from web!
	die('This is a command line tool!');
}

if (($filename = fetchDropLasso())) {
	$fd = fopen($filename, 'rt');
	$fsql = fopen('ext_tables_static+adt.sql', 'w');
	createTableDef($fsql);
	while (FALSE !== ($s = fgets($fd))) {
		if (FALSE !== ($pos = strpos($s, ';'))) {
			$s = substr($s, 0, $pos);
		}
		if (($s = trim($s))) {
			fprintf($fsql, 'INSERT INTO tx_toctoc_comments_ipbl_static (pid, ipaddr,comment) VALUES (' . $storagePid . ', \'%s\',\'%s\');%c',
				addslashes($s), 'DROP lasso', 10);
		}
	}
	fclose($fd);
	fclose($fsql);
	unlink($filename);
}

?>