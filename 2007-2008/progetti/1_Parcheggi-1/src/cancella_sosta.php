<?php

if ( $authn->isAuthn() ) {
	try {
		$database->setQuery("DELETE FROM R10 WHERE (id = " . string_clean($_REQUEST["sosta_id"]) . ") AND (id_automezzo IN (SELECT DISTINCT id FROM Automezzo WHERE id_utente = " . $user->getId() . "))");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$page->assign("content", "Prenotazione cancellata.");
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma bisogna essere autenticati per poter accedere a questa sezione.");
}

?>