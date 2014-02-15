<?php

if ( $authn->isAuthn() ) {
	try {
		$annuncio = new Annuncio(string_clean($_REQUEST["annuncio_id"]));
		$annuncio->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( isset($_REQUEST["my"]) ) {
		$page->assign("my", true);
	}
	
	if ( !isset($_REQUEST["step"]) ) {
		$page->assign("approva_annuncio", true);
		$page->assign("titolo", $annuncio->getTitolo());
		$page->assign("corpo", $annuncio->getCorpo());
		$page->assign("annuncio_id", $annuncio->getId());
	}
	else {
		if ( string_clean($_REQUEST["moderazione"]) == "1" ) {
			try {
				$annuncio->setModerato(false);
				
				$annuncio->save($database);
			}
			catch ( Exception $e ) {
				die("FATAL ERROR: " . $e->getMessage());
			}
			
			$page->assign("content", "L'annuncio dal titolo \"" . $annuncio->getTitolo() . "\" &egrave; stato approvato.");
		}
		else {
			$page->assign("content", "L'annuncio dal titolo \"" . $annuncio->getTitolo() . "\" non &egrave; stato approvato.");
		}
	}
}
else {
	$close_session = true;
	$page->assign("content", "Bisogna essere autenticati per potere accedere a questa sezione.");
}

?>