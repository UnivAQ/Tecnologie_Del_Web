<?php


class Indirizzo {

public function __construct($id = -1) {
	$this->id = $id;
	
	$this->lat = 0;
	$this->lon = 0;
}


public function getId() {
	return $this->id;
}


public function setVia($via) {
	if ( is_string($via) && strlen($via) <= 100 ) {
		$this->via = string_clean($via);
	}
	else {
		throw new Exception("La via deve essere una stringa.");
	}
}


public function getVia() {
	return string_soil($this->via);
}


public function setCivico($civico) {
	if ( is_string($civico) && strlen($civico) <= 10 ) {
		$this->civico = string_clean($civico);
	}
	else {
		throw new Exception("Il numero civico deve essere una stringa.");
	}
}


public function getCivico() {
	return string_soil($this->civico);
}


public function setComune($comune) {
	if ( is_string($comune) && strlen($comune) <= 100 ) {
		$this->comune = string_clean($comune);
	}
	else {
		throw new Exception("Il comune dev'essere una stringa.");
	}
}


public function getComune() {
	return string_soil($this->comune);
}


public function setProvincia($provincia) {
	if ( is_string($provincia) && strlen($provincia) == 2 ) {
		$this->provincia = string_clean($provincia);
	}
	else {
		throw new Exception("La provincia dev'essere una stringa di due caratteri.");
	}
}


public function getProvincia() {
	return string_soil($this->provincia);
}


public function setCap($cap) {
	if ( is_string($cap) && strlen($cap) == 5 ) {
		$this->cap = string_clean($cap);
	}
	else {
		throw new Exception("Il CAP dev'essere una stringa di cinque caratteri.");
	}
}


public function getCap() {
	return string_soil($this->cap);
}

public function setLat($lat) {
	if ( is_float($lat) ) {
		$this->lat = string_clean($lat);
	}
	else {
		throw new Exception("La latitudine dev'essere un numero in virgola mobile.");
	}
}

public function getLat() {
	return string_soil($this->lat);
}

public function setLon($lon) {
	if ( is_float($lon) ) {
		$this->lon = string_clean($lon);
	}
	else {
		throw new Exception("La longitudine dev'essere un numero in virgola mobile.");
	}
}

public function getLon() {
	return string_soil($this->lon);
}

public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Indirizzo WHERE id = '{$this->id}' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Indirizzo non trovato: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->via = string_clean($temp->via);
		$this->civico = string_clean($temp->n_civico);
		$this->comune = string_clean($temp->comune);
		$this->provincia = string_clean($temp->provincia);
		$this->cap = string_clean($temp->cap);
		$this->lat = string_clean($temp->lat);
		$this->lon = string_clean($temp->lon);
		
		return true;
	}
}


public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Indirizzo (via, n_civico, comune, provincia, cap, lat, lon) VALUES ('{$this->via}', '{$this->civico}', '{$this->comune}', '{$this->provincia}', '{$this->cap}', {$this->lat}, {$this->lon})");
		}
		else {
			$database->setQuery("UPDATE Indirizzo SET via = '{$this->via}', n_civico = '{$this->civico}', comune = '{$this->comune}', provincia = '{$this->provincia}', cap = '{$this->cap}', lat = {$this->lat}, lon = {$this->lon} WHERE id = {$this->id} LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("Il salvataggio dei dati dell'indirizzo non è andato a buon fine.");
	}
	
	if ( $this->id == -1 ) {
		try {
			$database->setQuery("SELECT id FROM Indirizzo WHERE via = '{$this->via}' AND n_civico = '{$this->civico}' AND comune = '{$this->comune}' AND provincia = '{$this->provincia}' AND cap = '{$this->cap}' LIMIT 1");
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
			throw new Exception("Impossibile recuperare l'id dell'indirizzo appena inserito.");
		}
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Indirizzo WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eliminare l'indirizzo dal database: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione dell'indirizzo dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $via;
private $civico;
private $comune;
private $provincia;
private $cap;
private $lat;
private $lon;

}

?>