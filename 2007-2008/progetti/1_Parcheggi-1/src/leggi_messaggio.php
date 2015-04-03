<?php

if ( $authn->isAuthn() ) {
	try {
		$messaggio = new Messaggio(string_clean($_REQUEST["messaggio_id"]));
		$messaggio->populate($database);
		
		$mittente = new Utente($messaggio->getIdMittente());
		$mittente->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( ($messaggio->getIdDestinatario() == $user->getId()) || ($messaggio->getIdMittente() == $user->getId()) ) {
		$page->assign("leggi_messaggio", true);
		
		if ( $messaggio->getIdMittente() == $user->getId() ) {
			$page->assign("read_only", true);
		}
		
		$page->assign("mittente", $mittente->getUsername());
		$page->assign("titolo", $messaggio->getTitolo());
		$page->assign("corpo", $messaggio->getCorpo());
		$page->assign("messaggio_id", $messaggio->getId());
		
		try {
			if ( ! $messaggio->getLetto() ) {
				$messaggio->setLetto(true);
				$messaggio->save($database);
			}
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
	}
	else {
		$page->assign("content", "Il messaggio che stai cercando di leggere non &egrave; tuo.");
	}
}
else {
	$close_session = false;
	$page->assign("content", "Bisogna essere autenticati per poter leggere un messaggio.");
}

?>