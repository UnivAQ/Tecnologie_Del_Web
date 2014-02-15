<?php

if ( $authn->isAuthn() ) {
	
	try {
		$annuncio = new Annuncio(string_clean($_REQUEST["annuncio_id"]));
		$annuncio->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( !($annuncio->getIdUtente() == $user->getId()) && !($authz->getPerm("Annuncio") >= 3) ) {
		$page->assign("content", "Non si possiedono i permessi necessari per eliminare questo annuncio.");
	}
	else {
		$annuncio->delete($database);
		$page->assign("content", "L'annuncio dal titolo \"{$annuncio->getTitolo()}\" &egrave; stato cancellato.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}

?>