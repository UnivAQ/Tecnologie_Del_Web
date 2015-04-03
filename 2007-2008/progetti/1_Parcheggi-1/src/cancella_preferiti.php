<?php

if ( $authn->isAuthn() ) {
	try {
		$database->setQuery("DELETE FROM R12 WHERE id_utente = " . $user->getId() . " AND id_parcheggio = " . string_clean($_REQUEST["parcheggio_id"]));
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$page->assign("content", "Parcheggio eliminato dai preferiti.");
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma bisogna essere autenticati per poter accedere a questa sezione.");
}

?>