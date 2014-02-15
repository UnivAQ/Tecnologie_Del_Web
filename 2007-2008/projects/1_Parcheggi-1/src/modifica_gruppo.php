<?php

if ( $authn->isAuthn() && $authz->getPerm("Gruppo") >= 4 ) {
	
	$gruppo = new Gruppo(string_clean($_REQUEST["gruppo_id"]));
	try {
		$gruppo->populate($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	try {
		$database->setQuery("SELECT t_name, permesso FROM Permesso WHERE id_gruppo = " . $gruppo->getId());
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$table_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$table_array[] = array("nome" => string_soil($temp->t_name), "permesso" => string_soil($temp->permesso));
	}
	
	$page->assign("table_array", $table_array);
	
	if ( ! isset($_REQUEST["step"]) ) {
		$page->assign("modifica_gruppo", true);
		$page->assign("messaggio_sicurezza", "Sei sicuro di modificare il gruppo?");
		$page->assign("gruppo_id", string_clean($_REQUEST["gruppo_id"]));
		$page->assign("nome", $gruppo->getNome());
	}
	else {
		try {
			$gruppo->setNome(string_clean($_REQUEST["nome"]));
			$gruppo->save($database);
			
			for ( $i = 0; $i < count($table_array); $i++ ) {
				$database->setQuery("UPDATE Permesso SET permesso = " . string_clean($_REQUEST["{$table_array[$i]["nome"]}"]) . " WHERE t_name = '" . $table_array[$i]["nome"] . "' AND id_gruppo = " .$gruppo->getId());
				$database->query();
			}
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "Il gruppo &egrave; stato modificato.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per modificare un gruppo.");
}

?>