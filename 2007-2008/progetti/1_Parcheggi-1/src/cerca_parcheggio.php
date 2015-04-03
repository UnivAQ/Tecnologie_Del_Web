<?php

if ( $authn->isAuthn() ) {
	if ( !isset($_REQUEST["step"]) ) {
		$page->assign("cerca_parcheggio", true);
		$page->assign("step", false);
	}
	else {
		try {
			$database->setQuery("SELECT id, nome FROM Parcheggio WHERE id_indirizzo IN (SELECT DISTINCT id FROM Indirizzo WHERE ((via LIKE '%" . string_clean($_REQUEST["via"]) . "%' AND n_civico LIKE '%" . string_clean($_REQUEST["civico"]) . "%') AND (comune LIKE '%" . string_clean($_REQUEST["comune"]) . "%' AND provincia LIKE '%" . string_clean($_REQUEST["provincia"]) . "%' AND cap LIKE '%" . string_clean($_REQUEST["cap"]) . "%')))");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() >= 1 ) {
			$parcheggi_array = array();
			
			for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
				$temp = $database->getData();
				$parcheggi_array["{$temp->id}"] = string_soil($temp->nome);
			}
			
			$page->assign("cerca_parcheggio", true);
			$page->assign("step", true);
			$page->assign("parcheggi_array", $parcheggi_array);
		}
		else {
			$page->assign("content", "<b>Nessun parcheggio trovato.</b>");
		}
	}
}
else {
	$close_session = true;
	$page->assign("content", "Devi essere autenticato per poter accedere a questa funzionalit&agrave;, se non lo sei puoi <a href=\"index.php?action=aggiungi_utente\">crearti un account qui</a>.");
}

?>