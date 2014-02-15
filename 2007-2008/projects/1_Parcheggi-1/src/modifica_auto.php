<?php

if ( $authn->isAuthn() ) {
	try {
		$auto = new Automezzo(string_clean($_REQUEST["auto_id"]));
		$auto->populate($database);
		$modello = new Modello($auto->getIdModello());
		$modello->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( $user->getId() == $auto->getIdUtente() ) {
		$auto_mod = $auto;
	}
	else if ( $authz->getPerm("Automezzo") >= 4 ) {
		$auto_mod = $auto;
		$page->assign("read_only", true);
	}
	else {
		die("FATAL ERROR: non &egrave; possibile modificare l'auto selezionata.");
	}
	
	if ( isset($_REQUEST["step"]) ) {
		$auto_mod->setTarga($_REQUEST["targa"]);
		
		if ( $authz->getPerm("Modello") >= 4 ) {
			$larghezza = $_REQUEST["larghezza"];
			$larghezza = str_replace(",", ".", $larghezza);
			settype($larghezza, "float");
			$modello->setLarghezza($larghezza);
			$lunghezza = $_REQUEST["lunghezza"];
			$lunghezza = str_replace(",", ".", $lunghezza);
			settype($lunghezza, "float");
			$modello->setLunghezza($lunghezza);
			$altezza = $_REQUEST["altezza"];
			$altezza = str_replace(",", ".", $altezza);
			settype($altezza, "float");
			$modello->setAltezza($altezza);
			$modello->setMarca($_REQUEST["marca"]);
			$modello->setNome($_REQUEST["modello"]);
			
			try {
				$modello->save($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
		}
		
		try {
			$auto_mod->save($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "L'automezzo &egrave; stato modificato.");
	}
	else {
		$page->assign("marca", $modello->getMarca());
		$page->assign("modello", $modello->getNome());
		$page->assign("targa", $auto_mod->getTarga());
		$page->assign("larghezza", $modello->getLarghezza());
		$page->assign("lunghezza", $modello->getLunghezza());
		$page->assign("altezza", $modello->getAltezza());
		
		$page->assign("modifica_auto", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di voler modificare l\'automezzo?");
		$page->assign("auto_id", $auto_mod->getId());
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per potere accedere a questa sezione.");
}

?>