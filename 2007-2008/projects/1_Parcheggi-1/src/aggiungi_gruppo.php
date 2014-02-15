<?php

if ( $authn->isAuthn() && $authz->getPerm("Gruppo") >= 1 ) {
	
	try {
		$database->setQuery("SHOW TABLES");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$table_array = array();
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		settype($temp, "array");
		$table_array[] = array("nome" => $temp["Tables_in_parcheggi"]);
	}
	
	$page->assign("table_array", $table_array);
	
	if ( !isset($_REQUEST["step"]) ) {
		$page->assign("aggiungi_gruppo", true);
	}
	else {
		$gruppo = new Gruppo();
		
		try {
			$gruppo->setNome($_REQUEST["nome"]);
			
			$gruppo->save($database);
			
		for ( $i = 0; $i < count($table_array); $i++ ) {
				$database->setQuery("INSERT INTO Permesso VALUES ('" . $table_array[$i]["nome"] . "', " . string_clean($_REQUEST["{$table_array[$i]["nome"]}"]) ." , " . $gruppo->getId() . " )");
				$database->query();
			}
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
		
		$page->assign("content", "Gruppo \"" . $gruppo->getNome() . "\" inserito con successo.");
	}
}
else {
	$close_session = true;
	$page->assign("content", "Spiacenti ma non si possiedono i permessi necessari per aggiungere un gruppo.");
}

?>