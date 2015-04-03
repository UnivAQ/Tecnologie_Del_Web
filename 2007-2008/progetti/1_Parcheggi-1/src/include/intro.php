<?php

session_start();

$close_session = false;

$database = new MySQLDB($db_user, $db_pass);
$database->setDatabase($db_name);
try {
	$database->connect();
}
catch ( Exception $e ) {
	print("FATAL ERROR: " . $e->getMessage());
}

if ( isset($_SESSION["user"]) ) {
	$user = unserialize($_SESSION["user"]);
	$authn = unserialize($_SESSION["authn"]);
	$authz = unserialize($_SESSION["authz"]);
	$groups = unserialize($_SESSION["groups"]);
}
else {
	$user = new Utente();
	$authn = new Authn($user);
	$authz = new Authz($user);
	$groups = array();
}

?>
