<?php

if ( $authn->isAuthn() && $authz->getPerm("Utente") >= 2 ) {
	$risultati = false;
	
	try {
		$database->setQuery("SELECT id,username FROM Utente ORDER BY username");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}

	$user_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$user_array["{$temp->id}"] = string_soil($temp->username);
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("lista_utenti", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare questo utente?");
		$page->assign("user_array", $user_array);
	}
	else {
		$page->assign("content", "Non ci sono utenti.");
	}
}
else {
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}

?>