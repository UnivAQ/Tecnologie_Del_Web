<?php

require_once("include/config.php");
require_once("include/mysql_class.php");
require_once("include/string_functions.php");
require_once("include/indirizzo.php");
require_once("include/utente.php");
require_once("include/automezzo.php");
require_once("include/modello.php");
require_once("include/carta_credito.php");
require_once("include/annuncio.php");
require_once("include/parcheggio.php"); 
require_once("include/messaggio.php");
require_once("include/gruppo.php");
require_once("include/authn.php");
require_once("include/authz.php");

require_once(SMARTY_DIR . "Smarty.class.php");


require_once("include/intro.php");

$page = new Smarty();
$page->caching = 0;
$page->assign("title", "Parcheggi in Italia");
$page->assign("css", "css/styles.css");
$page->assign("header","Home page");

if ( is_file("./" . string_clean($_REQUEST["action"]) . ".php") ) {
	require_once(string_clean("./" . $_REQUEST["action"]) . ".php");
}
else {	
	require_once("home_page.php");
}

if ( $authn->isAuthn() && !$close_session ) {
	$page->assign("logged", true);
	$page->assign("username", $user->getUsername());
	$page->assign("id", $user->getId());
	$page->assign("authn", true);
	$page->assign("back", $_SERVER["HTTP_REFERER"]);
	
	if ( isset($groups["Amministratori"]) ) {
		$page->assign("amministratore", true);
	}
	if ( isset($groups["Gestori di Parcheggi"]) ) {
		$page->assign("parcheggio", true);
	}
	
	try {
		if ( ($counter = $database->count("id", "Messaggio", "id_destinatario = " . $user->getId() ." AND letto = 0")) > 0 ) {
			$page->assign("nuovi_messaggi", true);
			$page->assign("numero_messaggi", $counter);
		}
		else {
			$page->assign("nuovi_messaggi", false);
		}
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
}

$page->display("page.tpl");

require_once("include/outro.php");

?>