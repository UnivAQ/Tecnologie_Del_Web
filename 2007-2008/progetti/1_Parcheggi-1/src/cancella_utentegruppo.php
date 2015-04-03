<?php

if ( $authn->isAuthn() ) {
	
	try {
		if ( $authz->getPerm("R1") >= 3 ) {
			$database->setQuery("DELETE FROM R1 WHERE id_utente = " . string_clean($_REQUEST["id"]) . " AND id_gruppo = " . string_clean($_REQUEST["gruppo_id"]));
		}
		else if ( $user->getId() == string_clean($_REQUEST["id"]) ) {
			$database->setQuery("DELETE FROM R1 WHERE id_utente = " . $user->getId() . " AND id_gruppo = " . string_clean($_REQUEST["gruppo_id"]));
		}
	}
	catch ( Exception $e ) {
		die("FATAL ERRROR: " . $e->getMessage());
	}
	
	if ( !($authz->getPerm("R1") >= 3) && !($user->getId() == string_clean($_REQUEST["id"])) ) {
		$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per eliminare un utente dal gruppo.");
	}
	else {
		try {
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERRROR: " . $e->getMessage());
		}
		
		$page->assign("content", "L'utente &egrave; stato rimosso dal gruppo.");
	}
	
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per eliminare un utente dal gruppo.");
}

?>