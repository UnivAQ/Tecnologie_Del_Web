<?php

if ( $authn->isAuthn() ) {
	$parcheggio = new Parcheggio(string_clean($_REQUEST["parcheggio_id"]));
	
	try {
		$parcheggio->populate($database);
		$indirizzo = new Indirizzo($parcheggio->getIdIndirizzo());
		$indirizzo->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
		
	$page->assign("nome", $parcheggio->getNome());
	$page->assign("via", $indirizzo->getVia());
	$page->assign("civico", $indirizzo->getCivico());
	$page->assign("comune", $indirizzo->getComune());
	$page->assign("provincia", $indirizzo->getProvincia());
	$page->assign("cap", $indirizzo->getCap());
	$page->assign("lat", $indirizzo->getLat());
	$page->assign("lon", $indirizzo->getLon());
	
	$page->assign("parcheggio_id", $parcheggio->getId());
	$page->assign("mostra_parcheggio", true);
	$page->assign("read_only", true);
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma bisogna essere autenticati per poter accedere a questa sezione.");
}

?>