<?php

if ( $authn->isAuthn() ) {
	$risultati = false;
	
	try {
		$database->setQuery("SELECT numero,tipo,id FROM Carta_Credito WHERE id_utente = {$user->getId()} ORDER BY id");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$carte_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$carte_array["{$temp->id}"] = string_soil($temp->numero)." ".string_soil($temp->tipo);
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("lista_carte", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare la carta di credito?");
		$page->assign("carte_array", $carte_array);
	}
	else {
		$page->assign("content", "Non ci sono carte di credito.");
	}
}
else {
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}

?>
