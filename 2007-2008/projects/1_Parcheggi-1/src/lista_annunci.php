<?php

if ( $authn->isAuthn() ) {
	$risultati = false;
	
	try {
		if ( $authz->getPerm("Annuncio") >= 2 && !isset($_REQUEST["my"]) ) {
			$page->assign("menu_amministrazione", true);
			$database->setQuery("SELECT id,titolo FROM Annuncio ORDER BY data");
		}
		else {
			$database->setQuery("SELECT id,titolo FROM Annuncio WHERE id_utente = " . $user->getId() . " ORDER BY data");
		}
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$annunci_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$annunci_array["{$temp->id}"] = string_soil($temp->titolo);
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("lista_annunci", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare questo annuncio?");
		$page->assign("annunci_array", $annunci_array);
	}
	else {
		$page->assign("content", "Non ci sono annunci.");
	}
}
else {
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}

?>