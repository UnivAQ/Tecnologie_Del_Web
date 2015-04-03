<?php

if ( $authn->isAuthn() ) {
	if ( ! isset($_REQUEST["step"]) ) {
		$page->assign("aggiungi_auto", true);
	}
	else {
		try {
			$database->setQuery("SELECT id FROM Modello WHERE marca = '" . string_clean($_REQUEST["marca"]) . "' AND nome = '" . string_clean($_REQUEST["modello"]) . "'");
			$database->query();
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() != 1 ) {
			$modello = new Modello();
			try {
				$larghezza = string_clean($_REQUEST["larghezza"]);
				$larghezza = str_replace(",", ".", $larghezza);
				settype($larghezza, "float");
				$modello->setLarghezza($larghezza);
				$lunghezza = string_clean($_REQUEST["lunghezza"]);
				$lunghezza = str_replace(",", ".", $lunghezza);
				settype($lunghezza, "float");
				$modello->setLunghezza($lunghezza);
				$altezza = string_clean($_REQUEST["altezza"]);
				$altezza = str_replace(",", ".", $altezza);
				settype($altezza, "float");
				$modello->setAltezza($altezza);
				$modello->setMarca(string_clean($_REQUEST["marca"]));
				$modello->setNome(string_clean($_REQUEST["modello"]));
				
				$modello->save($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
		}
		else {
			$temp = $database->getData();
			try {
				$modello = new Modello($temp->id);
				$modello->populate($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
		}
		
		$auto = new Automezzo();
		try {
			$auto->setTarga($_REQUEST["targa"]);
			$auto->setModello($modello);
			$auto->setUtente($user);
			
			$auto->save($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "Caro " . $user->getUsername() . ", la macchina &egrave; stata aggiunta con successo.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per poter aggiungere automobili.");
}

?>