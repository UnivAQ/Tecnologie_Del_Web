<?php
if ( $authn->isAuthn() ) {
	$risultati = false;
	
	try {
		
		if ( $authz->getPerm("Automezzo") >= 2 && !isset($_REQUEST["my"]) ) {
			$database->setQuery("SELECT id,targa FROM Automezzo ORDER BY targa");
		}
		else {
			$database->setQuery("SELECT t1.id, t1.targa, t2.marca, t2.nome FROM Automezzo AS t1, Modello AS t2 WHERE t1.id_utente = " . $user->getId() . " ORDER BY t1.targa");
		}
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$auto_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$auto_array["{$temp->id}"] = array("targa" => string_soil($temp->targa), "marca" => string_soil($temp->marca), "nome" => string_soil($temp->nome));
		$risultati = true;
	}
	
	if ( $risultati ) {
		$page->assign("lista_auto", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler cancellare questo automezzo?");
		$page->assign("auto_array", $auto_array);
	}
	else {
		$page->assign("content", "Non ci sono automezzi.");
	}
}
else {
	$close_session = true;
	$page->assign("content","Non si possiedono i permessi necessari per la visualizzazione della pagina.");
}

?>