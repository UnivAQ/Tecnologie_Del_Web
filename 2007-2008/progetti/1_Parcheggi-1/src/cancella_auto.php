<?php

if ( $authn->isAuthn() ) {
	
	$auto = new Automezzo(string_clean($_REQUEST["auto_id"]));
	try {
		$auto->populate($database);
		$modello = new Modello($auto->getIdModello());
		$modello->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( !($auto->getIdUtente() == $user->getId()) && !($authz->getPerm("Automezzo") >= 3) ) {
		die("FATAL ERROR: Impossibile eliminare questo automezzo.");
	}
	
	$auto->delete($database);
	
	if ( $database->count("id_modello", "Automezzo", "id_modello = " . $auto->getIdModello()) == 0 && $authz->getPerm("Modello") >= 3 ) {
		$modello->delete($database);
	}
	
	$page->assign("content", "Automezzo con targa #" . $auto->getTarga() . " eliminato.");
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}

?>