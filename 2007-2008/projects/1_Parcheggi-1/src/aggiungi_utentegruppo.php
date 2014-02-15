<?php

if ( $authn->isAuthn() && $authz->getPerm("Utente") >= 1 ) {
	
	try {
		$gruppo = new Gruppo(string_clean($_REQUEST["gruppo_id"]));
		$gruppo->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( !isset($_REQUEST["step"]) ) {
		try {
			$database->setQuery("SELECT id,username FROM Utente WHERE id NOT IN (SELECT DISTINCT id_utente FROM R1 WHERE id_gruppo = " . string_clean($_REQUEST["gruppo_id"]) . ")");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$utenti_array = array();
		
		for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
			$temp = $database->getData();
			$utenti_array["{$temp->id}"] = string_soil($temp->username);
		}
		
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler aggiungere l'utente?");
		$page->assign("aggiungi_utentegruppo", true);
		$page->assign("utenti_array", $utenti_array);
		$page->assign("gruppo", $gruppo->getNome());
		$page->assign("gruppo_id", $gruppo->getId());
	}
	else {
		try {
			$database->setQuery("INSERT INTO R1 VALUES (" . string_clean($_REQUEST["id_utente"]) . ", " . $gruppo->getId() . ")");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "Utente correttamente aggiunto al gruppo.");
	}
}
else {
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}

?>