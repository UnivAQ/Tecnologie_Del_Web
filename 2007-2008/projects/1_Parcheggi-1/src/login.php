<?php

try {
	$user->setUsername($_REQUEST["username"]);
	$user->setPassword($_REQUEST["password"]);
	$authn = new Authn($user);
	$user->setId($authn->login($database));
}
catch ( Exception $e ) {
	die("FATAL ERROR: " . $e->getMessage());
}

if ( $user->getId() != -1 ) {
	try {
		$user->populate($database);
		$authz->authz($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	try {
		$database->setQuery("SELECT nome,id FROM Gruppo WHERE id IN (SELECT DISTINCT id_gruppo From R1 WHERE id_utente = " . $user->getId() . ")");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$nome = string_soil($temp->nome);
		$groups["{$nome}"] = string_soil($temp->id); 
	}
	
	$page->assign("content", "Benvenuto {$user->getUsername()}.");
}
else {
	$page->assign("content", "La procedura di autenticazione non è andata a buon fine.");
	$close_session = true;
}

?>
