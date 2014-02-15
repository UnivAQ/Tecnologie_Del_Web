<?php

$page->assign("logged", false);
$page->assign("aggiungi_utente", true);

if ( isset($_REQUEST["step"]) ) {
	try {
		$user->setUsername($_REQUEST["username"]);
		$user->setNome($_REQUEST["nome"]);
		$user->setCognome($_REQUEST["cognome"]);
		$user->setLNascita($_REQUEST["l_nascita"]);
		$a_nascita = $_REQUEST["a_nascita"];
		settype($a_nascita, "integer");
		$m_nascita = $_REQUEST["m_nascita"];
		settype($m_nascita, "integer");
		$g_nascita = $_REQUEST["g_nascita"];
		settype($g_nascita, "integer");
		$user->setDNascita($a_nascita, $m_nascita, $g_nascita);
		
		if ( string_clean($_REQUEST["password"]) == string_clean($_REQUEST["password2"]) ) {
			$user->setPassword(string_clean($_REQUEST["password"]));
		}
		$user->setEmail($_REQUEST["email"]);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}	
	
	try {
		$database->setQuery("SELECT id FROM Indirizzo WHERE via = '" . string_clean($_REQUEST["via"]) . "' AND n_civico = '" . string_clean($_REQUEST["civico"]) . "' AND cap = '" . string_clean($_REQUEST["cap"]) . "' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$indirizzo = new Indirizzo($temp->id);
		$indirizzo->populate($database);
	}
	else {
		$indirizzo = new Indirizzo();
		
		try {
			$indirizzo->setVia($_REQUEST["via"]);
			$indirizzo->setCivico($_REQUEST["civico"]);
			$indirizzo->setComune($_REQUEST["comune"]);
			$indirizzo->setProvincia($_REQUEST["provincia"]);
			$indirizzo->setCap($_REQUEST["cap"]);
			
			$indirizzo->save($database);
		}
		catch ( Exception $e ) {
			die("FATAL ERROR: " . $e->getMessage());
		}
	}
	
	$user->setIndirizzo($indirizzo);
	
	try {
		$user->save($database);
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	try {
		$database->setQuery("SELECT id FROM Utente WHERE username = '" . $user->getUsername() . "'");
		$database->query();
		if ( $database->getResultsNumber() == 1 ) {
			$temp = $database->getData();
			$user = new Utente($temp->id);
			$user->populate($database);
		}
		$database->setQuery("INSERT INTO R1 (id_utente, id_gruppo) VALUES (" . $user->getId() . ", 3)");
		$database->query();
	}
	catch ( Exception $e ) {
		die("FATAL ERROR: " . $e->getMessage());
	}
	
	$page->assign("aggiungi_utente", false);
	$page->assign("content", "Utente registrato, adesso è possibile effettuare il login.");
	$close_session = true;
}
else {
	$page->assign("aggiungi_utente", true);
}

?>
