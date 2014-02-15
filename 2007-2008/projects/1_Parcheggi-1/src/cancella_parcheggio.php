<?php

if ( $authn->isAuthn() ) {
	
	try {
		$parcheggio_del = new Parcheggio(string_clean($_REQUEST["parcheggio_id"]));
		$parcheggio_del->populate($database);
	
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
		
	if ( !($user->getId() == $parcheggio_del->getIdProprietario()) && !($authz->getPerm("Parcheggio") >= 3) ) {
		die("FATAL ERROR: si &egrave; tentato di cancellare un parcheggio senza averne i privilegi.");
	}
	
	try {
		$parcheggio_del->delete($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( ($database->count("id_indirizzo", "Parcheggio", "id_indirizzo = " . $parcheggio_del->getIdIndirizzo()) == 0) && ($database->count("id_indirizzo", "Utente", "id_indirizzo = " . $parcheggio_del->getIdIndirizzo()) == 0) ) {		
		try {
			$indirizzo = new Indirizzo($parcheggio_del->getIdIndirizzo());
			$indirizzo->delete($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
	}
		$close_session = false;
		$page->assign("content", "Parcheggio " . $parcheggio_del->getNome() . " cancellato.");

}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}
?>