<?php

if ( $authn->isAuthn() ) {
	$risultati = false;
	
	try {
		if ( $authz->getPerm("Gruppo") >= 2 && !isset($_REQUEST["my"]) ) {
			$page->assign("my", false);
			$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare il gruppo?");
			$database->setQuery("SELECT * FROM Gruppo WHERE 1 = 1 ORDER BY id");
		}
		else {
			$page->assign("my", true);
			$page->assign("messaggio_sicurezza", "Sei sicuro di voler abbandonare il gruppo?");
			$database->setQuery("SELECT * FROM Gruppo WHERE id IN (SELECT DISTINCT id_gruppo FROM R1 WHERE id_utente = " . $user->getId() .")");
		}
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$gruppi_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$gruppi_array["{$temp->id}"] = array("nome" => string_soil($temp->nome), "id" => $user->getId());
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("lista_gruppi", true);
		$page->assign("gruppi_array", $gruppi_array);
	}
	else {
		$page->assign("content", "Non ci sono gruppi.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per visualizzare la lista dei gruppi.");
}

?>