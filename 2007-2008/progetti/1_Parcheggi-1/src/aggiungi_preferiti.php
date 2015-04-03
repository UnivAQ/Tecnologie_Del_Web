<?php

if ( $authn->isAuthn() ) {
	try {
		$database->setQuery("INSERT INTO R12 (id_utente, id_parcheggio) VALUES (". $user->getId() .", " . string_clean($_REQUEST["parcheggio_id"]) . ")");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$page->assign("content", "Parcheggio aggiunto ai preferiti.");
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma bisogna essere autenticati per poter accedere a questa sezione.");	
}

?>