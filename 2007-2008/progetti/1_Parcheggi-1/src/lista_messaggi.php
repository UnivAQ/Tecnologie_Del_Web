<?php

if ( $authn->isAuthn() ) {
	try {
		$database->setQuery("SELECT id,titolo,id_mittente FROM Messaggio WHERE id_destinatario = " . $user->getId() . " ORDER BY data");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$messaggi_in = false;
	$messaggiin_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		
		try {
			$mittente = new Utente($temp->id_mittente);
			$mittente->populate($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$messaggiin_array["{$temp->id}"] = $mittente->getUsername() . ": " . string_soil($temp->titolo);
		$messaggi_in = true;
	}
	
	try {
		$database->setQuery("SELECT id,titolo,id_destinatario FROM Messaggio WHERE id_mittente = " . $user->getId() . " ORDER BY data");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$messaggi_out = false;
	$messaggiout_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		
		try {
			$destinatario = new Utente($temp->id_destinatario);
			$destinatario->populate($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$messaggiout_array["{$temp->id}"] = $destinatario->getUsername() . ": " . string_soil($temp->titolo);
		$messaggi_out = true;
	}
	
	$page->assign("messaggi_in", $messaggi_in);
	$page->assign("messaggi_out", $messaggi_out);
	$page->assign("lista_messaggi", true);
	$page->assign("messaggio_sicurezza", "Confermi la cancellazione del messaggio?");
	$page->assign("messaggiin_array", $messaggiin_array);
	$page->assign("messaggiout_array", $messaggiout_array);
}
else {
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}

?>