<?php

if ( $authn->isAuthn() ) {
	$page->assign("menu_messaggi", true);
	
	try {
		if ( $database->count("id", "Messaggio", "id_destinatario = " . $user->getId() ." AND letto = 0") > 0 ) {
			$page->assign("nuovi_messaggi", true);
			
			$database->setQuery("SELECT id,titolo FROM Messaggio WHERE id_destinatario = " . $user->getId() . " AND letto = 0");
			$database->query();
			
			$messaggi_array = array();
			
			for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
				$temp = $database->getData();
				$messaggi_array["{$temp->id}"] = string_soil($temp->titolo);
			}
			
			$page->assign("messaggi_array", $messaggi_array);
		}
		else {
			$page->assign("nuovi_messaggi", false);
		}
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma devi essere autenticato per poter accedere a questa sezione.");
}

?>