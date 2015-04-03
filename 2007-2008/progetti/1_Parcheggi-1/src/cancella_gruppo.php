<?php

if ( $authn->isAuthn() && $authz->getPerm("Gruppo") >= 3 ) {
	
	$gruppo = new Gruppo(string_clean($_REQUEST["gruppo_id"]));
	
	try {
		$gruppo->populate($database);
		
		$database->setQuery("DELETE FROM Permesso WHERE id_gruppo = " . $gruppo->getid());
		$database->query();
		
		$database->setQuery("DELETE FROM R1 WHERE id_gruppo = " . $gruppo->getid());
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$gruppo->delete($database);
	$page->assign("content", "Il gruppo \"{$gruppo->getNome()}\" &egrave; stato cancellato.");
}
else {
	$close_session = true;
	$page->assign("content", "Non si possiedono i permessi necessari per poter cancellare un gruppo.");
}

?>