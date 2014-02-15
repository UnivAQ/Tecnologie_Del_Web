<?php

class Automezzo{

public function __construct($id = -1) {
	$this->id = $id;
}

public function setId($id) {
	if ( $this->id == -1 ) {
		$this->id = $id;
	}
	else {
		throw new Exception("Non è possibile modificare l'id di un automezzo già esistente.");
	}
}

public function getId() {
	return $this->id;
}

public function getTarga(){
	return string_soil($this->targa);
}

public function setTarga($targa){
	if (is_string($targa) && strlen($targa) <= 10 && $targa != ""){
	$this->targa = string_clean($targa);
	}
	else{
	throw new Exception('La targa deve essere una stringa e non pu&ograve; essere nulla.');
	}
}

public function setUtente($user) {
	if ( is_object($user) && get_class($user) == "Utente" ) {
		$this->id_utente = $user->getId();
	}
	else {
		throw new Exception("L'utente dev'essere un oggetto di tipo Utente.");
	}
}

public function getIdUtente() {
	return $this->id_utente;
}

public function setModello($modello) {
	if ( is_object($modello) && get_class($modello) == "Modello" ) {
		$this->id_modello = $modello->getId();
	}
	else {
		throw new Exception("Il modello dev'essere un oggetto di tipo Modello.");
	}
}

public function getIdModello() {
	return $this->id_modello;
}

public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Automezzo WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Automezzo non trovato: {$e->getMessage()}");
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->targa = string_clean($temp->targa);
		$this->id_modello = $temp->id_modello;
		$this->id_utente = $temp->id_utente;
		return true;
	}
	else {
		throw new Exception("Automezzo non trovato.");
	}
}

public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Automezzo (targa, id_modello, id_utente) VALUES ('{$this->targa}', {$this->id_modello}, {$this->id_utente})");
			$database->query();
		}
		else {
			$database->setQuery("UPDATE Automezzo SET targa = '{$this->targa}', id_modello = {$this->id_modello}, id_utente = {$this->id_utente} WHERE id = {$this->id}");
			$database->query();
		}
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: {$e->getMessage()}");
	}
	
	if ( $this->id == -1 ) {
		try {
			$database->setQuery("SELECT id FROM Automezzo WHERE targa = '{$this->targa}'");
			$database->query();
		}
		catch ( Exception $e ) {
			throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() == 1 ) {
			$temp = $database->getData();
			$this->id = $temp->id;
		}
		else {
			throw new Exception("Impossibile recuperare l'id dell'automezzo appena inserito.");
		}
	}
	
	return true;
}

public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Automezzo WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eliminare l'automezzo dal database: {$e->getMessage()}");
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione dell'automezzo dal database non e' andata a buon fine.");
	}
	
	return true;
}

private $id;
private $targa;
private $id_modello;
private $id_utente;
}
?>