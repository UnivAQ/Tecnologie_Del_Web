<?php 
// Database access
$cnf_dbhost		= "localhost";
$cnf_dbuser		= "root";
$cnf_dbpass		= "root";
$cnf_dbname		= "tdw";

// Script path
$script_dir = "/var/www/tdw/trunk/";

// Admin account
$admin_password = "21232f297a57a5a743894a0e4a801fc3";


// Don't edit after this
$db = mysql_connect($cnf_dbhost, $cnf_dbuser, $cnf_dbpass) or die ("Errore!");
@mysql_select_db($cnf_dbname, $db);
?>