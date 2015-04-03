<?php

class Authn {

public function __construct(&$utente) {
	$this->utente = $utente;
	$this->logon = false;
}


public function isAuthn() {
	return $this->logon;
}


public function login(&$database) {
	try {
		$database->setQuery("SELECT id FROM Utente WHERE username = '" . $this->utente->getUsername() . "' AND password = '" . $this->utente->getPassword() . "' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Autenticazione impossibile, errore del database: ". $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->logon = true;
		return $temp->id;
	}
	else {
		return -1;
	}
}


public function logout() {
	$this->logon = false;
}


private $utente;
private $logon;

}

?>