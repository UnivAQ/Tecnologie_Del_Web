<?php

if ( $authn->isAuthn() && $authz->getPerm("R1") >= 2 ) {
	
	$gruppo = new Gruppo(string_clean($_REQUEST["gruppo_id"]));
	
	try {
		$gruppo->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$risultati = false;
	
	try {
		$database->setQuery("SELECT username,id FROM Utente WHERE id IN (SELECT DISTINCT id_utente FROM R1 WHERE id_gruppo = " . string_clean($_REQUEST["gruppo_id"]) . ")");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$user_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$user_array["{$temp->id}"] = array("nome" => string_soil($temp->username), "gid" => string_clean($_REQUEST["gruppo_id"]));
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("messaggio_sicurezza", "Sicuro di voler eliminare l\'utente dal gruppo ?");
		$page->assign("lista_utentigruppo", true);
		$page->assign("utenti_array", $user_array);
		$page->assign("gruppo", $gruppo->getNome());
	}
	else {
		$page->assign("content", "Non ci sono utenti nel gruppo.");
	}
	
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per visualizzare la lista degli utenti del  gruppo.");
}

?>