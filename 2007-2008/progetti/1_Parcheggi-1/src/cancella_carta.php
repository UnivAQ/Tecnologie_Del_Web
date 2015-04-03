<?php
if ( $authn->isAuthn() ) {
	
	$carta = new carta_credito(string_clean($_REQUEST["carta_id"]));
	try {
		$carta->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( !($carta->getId_Utente() == $user->getId()) && !($authz->getPerm("Carta_Credito") >= 3) ) {
		die("FATAL ERROR: Impossibile eliminare questa carta.");
	}
	
	$carta->delete($database);
	
	$page->assign("content", "Carta numero #" . $carta->getNumero() . " eliminata.");
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}
?>