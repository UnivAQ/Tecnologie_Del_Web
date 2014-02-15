<?php

if ( $authn->isAuthn() ) {
	
	$risultati = false;
	
	try {
		$database->setQuery("SELECT t1.targa, t2.marca, t2.nome, t3.id, t3.arrivo, t3.partenza FROM Automezzo AS t1, Modello AS t2, R10 AS t3 WHERE (t1.id_modello = t2.id) AND (t1.id_utente = " . $user->getId() . ") AND (t3.id_automezzo = t1.id)");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$soste_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$soste_array[] = array("id" => $temp->id, "targa" => $temp->targa, "partenza" => $temp->partenza, "arrivo" => $temp->arrivo, "marca" => $temp->marca, "nome" => $temp->nome);
		$risultati = true;
	}
	
	if ( $risultati ) { 
		$page->assign("lista_soste", true);
		$page->assign("messaggio_sicurezza", "Confermi la cancellazione della preotazione?");
		$page->assign("soste_array", $soste_array);
	}
	else {
		$page->assign("content", "Non ci sono prenotazioni effettuate.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma bisogna essere autenticati per poter accedere a questa sezione.");
}

?>