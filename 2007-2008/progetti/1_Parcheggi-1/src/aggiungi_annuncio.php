<?php

if ( $authn->isAuthn() && $authz->getPerm("Annuncio") >= 1 ) {
	if ( !isset($_REQUEST["step"]) ) {
		$page->assign("aggiungi_annuncio", true);
	}
	else {
		try {
			$annuncio = new Annuncio();
			$annuncio->setTitolo($_REQUEST["titolo"]);
			$annuncio->setCorpo($_REQUEST["corpo"]);
			$annuncio->setData(date("o\-m\-d G\:i\:s"));
			$annuncio->setUtente($user);
			$annuncio->setModerato(true);
			
			$annuncio->save($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "L'annuncio dal titolo \"" . $annuncio->getTitolo() . "\" &egrave; attualmente in moderazione.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter aggiungere un annuncio.");
}

?>