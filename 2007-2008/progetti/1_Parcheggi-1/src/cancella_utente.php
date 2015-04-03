<?php

if ( $authn->isAuthn() ) {
	if ( $user->getId() == string_clean($_REQUEST["id"]) ) {
		$user_del = $user;
	}
	else if ( $authz->getPerm("Utente") >= 3 ) {
		$user_del = new Utente(string_clean($_REQUEST["id"]));
		try {
			$user_del->populate($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
	}
	else {
		die("FATAL ERROR: si &egrave; tentato di cancellare un utente senza averne i privilegi.");
	}
	
	try {
		$user_del->delete($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( $database->count("id_indirizzo", "Utente", "id_indirizzo = " . $user_del->getIdIndirizzo()) == 0 ) {
		try {
			$indirizzo = new Indirizzo($user_del->getIdIndirizzo());
			$indirizzo->delete($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
	}
	
	if ( $user_del->getId() == $user->getId() ) {
		$close_session = true;
		$page->assign("content", "Addio " . $user_del->getUsername() . ".");
	}
	else {
		$close_session = false;
		$page->assign("content", "Utente " . $user_del->getUsername() . " cancellato.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter accedere a questa sezione.");
}

?>