<?php
class Annuncio {

public function __construct($id = -1) {
	$this->id = $id;
	
}

public function getId() {
	return $this->id;
}

public function setTitolo($titolo) {
	if ( is_string($titolo) && strlen($titolo) <= 150 && $titolo != "" ) {
		$this->titolo = string_clean($titolo);
	}
	else {
		throw new Exception ('Il titolo deve essere una stringa e non può essere vuoto.');
	}
}

public function getTitolo() {
	return string_soil($this->titolo);
}

public function setCorpo($corpo) {
	if ( is_string($corpo) ) {
		$this->corpo = string_clean($corpo);
	}
	else {
		throw new Exception ('Il corpo deve essere una stringa.');
	}
}

public function getCorpo() {
	return string_soil($this->corpo);
}

public function setData($data) {
	if ( is_string($data) && $data != "" ) {
		$this->data = string_clean($data);
	}
	else {
		throw new Exception("La data dev'essere una stringa non nulla.");
	}
}

public function getData() {
	return string_soil($this->data);
}

public function setUtente($utente) {
	if ( is_object($utente) && get_class($utente) == "Utente" ) {
		$this->id_utente = $utente->getId();
	}
	else {
		throw new Exception("L'utente dev'essere un oggetto di tipo utente");
	}
}

public function getIdUtente() {
	return $this->id_utente;
}

public function setModerato($moderato) {
	if ( is_bool($moderato) ) {
		if ( $moderato ) {
			$this->moderato = 1;
		}
		else {
			$this->moderato = 0;
		}
	}
	else {
		throw new Exception ('Il campo moderato deve essere un booleano.');
	}
}

public function getModerato() {
	return $this->moderato;
}

public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Annuncio WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Annuncio non trovato: {$e->getMessage()}");
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->titolo = string_clean($temp->titolo);
		$this->corpo = string_clean($temp->corpo);
		$this->data = string_clean($temp->data);
		$this->id_utente = $temp->id_utente;
		$this->moderato = $temp->moderato;
		
		return true;
	}
}

public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Annuncio (titolo, corpo, data, id_utente, moderato) VALUES ('{$this->titolo}', '{$this->corpo}', '{$this->data}', {$this->id_utente}, {$this->moderato})");
		}
		else {
			$database->setQuery("UPDATE Annuncio SET titolo = '{$this->titolo}', corpo = '{$this->corpo}', data = '{$this->data}', id_utente = {$this->id_utente}, moderato = {$this->moderato} WHERE id = {$this->id} LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile salvare i dati dell'annuncio: {$e->getMessage()}");
	}

	if ( $this->id == -1 )  {
		try {
			$database->setQuery("SELECT id FROM Annuncio WHERE titolo = '{$this->titolo}' AND data = '{$this->data}' LIMIT 1");
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
			throw new Exception("Impossibile recuperare l'id dell'annuncio appena inserito.");
		}
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Annuncio WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eliminare l'annuncio dal database: {$e->getMessage()}");
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione dell'annuncio dal database non e' andata a buon fine.");
	}
	
	return true;
}

private $id;
private $titolo;
private $corpo;
private $data;
private $id_utente;
private $moderato;
}
?>