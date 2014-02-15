<?php

if ( $authn->isAuthn() ) {
	if ( !isset($_REQUEST["step"]) ) {
		$page->assign("invia_messaggio", true);
		
		if ( isset($_REQUEST["messaggio_id"]) ) {
			try {
				$messaggio = new Messaggio(string_clean($_REQUEST["messaggio_id"]));
				$messaggio->populate($database);
				
				$destinatario = new Utente($messaggio->getIdMittente());
				$destinatario->populate($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
			
			$page->assign("titolo", "Re: " . $messaggio->getTitolo());
			$page->assign("corpo", $destinatario->getUsername() . " ha scritto:\n\n" . $messaggio->getCorpo());
			$page->assign("destinatario", $destinatario->getUsername());
		}
	}
	else {
		$messaggio = new Messaggio();
		
		try {
			$database->setQuery("SELECT id FROM Utente WHERE username = '" . string_clean($_REQUEST["destinatario"]) ."'");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$temp = $database->getData();
		$destinatario = new Utente($temp->id);
		
		try {
			$messaggio->setTitolo($_REQUEST["titolo"]);
			$messaggio->setCorpo($_REQUEST["corpo"]);
			$messaggio->setData(date("o\-m\-d G\:i\:s"));
			$messaggio->setMittente($user);
			$messaggio->setDestinatario($destinatario);
			$messaggio->setLetto(false);
			
			$messaggio->save($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "Caro " . $user->getUsername() . ", il messaggio &egrave; stato inviato all'utente {$_REQUEST["destinatario"]}.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter inviare un messaggio.");
}

?>