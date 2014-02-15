<?php


class Messaggio {

public function __construct($id = -1) {
	$this->id = $id;
}


public function getId() {
	return $this->id;
}

public function setMittente($mittente) {
	if ( is_object($mittente) && get_class($mittente) == "Utente" ) {
		$this->mittente = $mittente->getId();
	}
	else {
		throw new Exception("Il mittente dev'essere un oggetto di tipo Utente.");
	}
}

public function getIdMittente() {
	return $this->mittente;
}


public function setTitolo($titolo) {
	if ( is_string($titolo) && strlen($titolo) <= 150 ) {
		$this->titolo = string_clean($titolo);
	}
	else {
		throw new Exception("Il titolo dev'essere una stringa.");
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
		throw new Exception("Il corpo dev'essere una stringa.");
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

public function setDestinatario($destinatario) {
	if ( is_object($destinatario) && get_class($destinatario) == "Utente" ) {
		$this->destinatario = $destinatario->getId();
	}
	else {
		throw new Exception("Il destinatario dev'essere un oggetto di tipo Utente.");
	}
}


public function getIdDestinatario() {
	return $this->destinatario;
}

public function setLetto($letto) {
	if ( is_bool($letto) ) {
		if ( $letto ) {
			$this->letto = 1;
		}
		else {
			$this->letto = 0;
		}
	}
	else {
		throw new Exception("Il valore letto dev'essere un booleano.");
	}
}

public function getLetto() {
	return $this->letto;
}

public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Messaggio WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Messaggio non trovato: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		
		$this->titolo = string_clean($temp->titolo);
		$this->corpo = string_clean($temp->corpo);
		$this->data = string_clean($temp->data);
		$this->mittente = $temp->id_mittente;
		$this->destinatario = $temp->id_destinatario;
		
		return true;
	}
	else {
		throw new Exception("Messaggio non trovato.");
	}
}


public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Messaggio (titolo, corpo, data, id_mittente, id_destinatario, letto) VALUES ('{$this->titolo}', '{$this->corpo}', '{$this->data}', {$this->mittente}, {$this->destinatario}, {$this->letto})");
		}
		else {
			$database->setQuery("UPDATE Messaggio SET letto = {$this->letto} WHERE id = {$this->id} LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Messaggio WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione del messaggio dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $titolo;
private $corpo;
private $data;
private $mittente;
private $destinatario;
private $letto;

}

?>