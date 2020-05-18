<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "education";
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	}
	$db->set_charset("utf8");
?>