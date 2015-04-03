<?php

class Parcheggio {


public function __construct($id = -1) {
	$this->id = $id;
}


public function getId() {
	return $this->id;
}


public function setNome($nome) {
	if ( is_string($nome) && strlen($nome) <= 150 ) {
		$this->nome = string_clean($nome);
	}
	else {
		throw new Exception("Il nome dev'essere una stringa.");
	}
}


public function getNome() {
	return string_soil($this->nome);
}


public function setProprietario(&$utente) {
	if ( is_object($utente) && get_class($utente) == "Utente" ) {
		$this->proprietario = $utente;
	}
	else {
		throw new Exception("Il proprietario dev'essere un oggetto di tipo Utente.");
	}
}


public function getIdProprietario() {

	return $this->proprietario->getId();
}


public function setIndirizzo(&$indirizzo) {
	if ( is_object($indirizzo) && get_class($indirizzo) == "Indirizzo" ) {
		$this->indirizzo = $indirizzo;
	}
	else {
		throw new Exception("L'indirizzo dev'essere un oggetto di tipo Indirizzo.");
	}
}


public function getIdIndirizzo() {
	return $this->indirizzo->getId();
}


public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Parcheggio WHERE id = '{$this->id}' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Parcheggio non trovato: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) 
		{
		$temp = $database->getData();
		$this->nome = string_clean($temp->nome);
		$this->indirizzo = new Indirizzo($temp->id_indirizzo);
		$this->proprietario = new Utente($temp->id_utente);
		
		try {
			$this->indirizzo->populate($database);
			$this->proprietario->populate($database);
		}
		catch ( Exception $e ) {
			throw $e;
		}
		
		return true;
	}
}


public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Parcheggio (nome, id_indirizzo, id_utente) VALUES ('{$this->nome}', " . $this->indirizzo->getId() . ", " . $this->proprietario->getId() . ")");
		}
		else {
			$database->setQuery("UPDATE Parcheggio SET nome = '{$this->nome}', id_indirizzo = " . $this->indirizzo->getId() . ", id_utente = " . $this->proprietario->getId() . " WHERE id = {$this->id} LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $this->id == -1 ) {
		try {
			$database->setQuery("SELECT id FROM Parcheggio WHERE nome = '{$this->nome}' AND id_indirizzo = " . $this->indirizzo->getId());
			$database->Query();
		}
		catch ( Exception $e ) {
			throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
		}
		
		if ( $database->getResultsNumber() == 1 ) {
			$temp = $database->getData();
			$this->id = $temp->id;
		}
		else {
			throw new Exception("Impossibile recuperare i dati del parcheggio appena salvato.");
		}
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Parcheggio WHERE id = '{$this->id}' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione del parcheggio dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $nome;

private $proprietario;
private $indirizzo;

}

/* Classe PostoAuto */

class PostoAuto {


public function __construct($id = -1) {
	$this->id = $id;
}


public function getId() {
	return $this->id;
}


public function setParcheggio(&$parcheggio) {
	$this->parcheggio = $parcheggio;
}

public function getIdParcheggio() {
	return $this->parcheggio->getId();
}


public function setTotale($totale) {
	if ( is_int($totale) && $totale > 0 ) {
		$this->totale = string_clean($totale);
	}
	else {
		throw new Exception("Il totale dei posti dev'essere un naturale.");
	}
}

public function getTotale() {
	return string_soil($this->totale);
}

public function setLarghezza($larghezza) {
	if ( is_numeric($larghezza) && $larghezza > 0 ) {
		$this->larghezza = string_clean($larghezza);
	}
	else {
		throw new Exception("La larghezza dev'essere un numero.");
	}
}


public function getLarghezza() {
	return string_soil($this->larghezza);
}


public function setLunghezza($lunghezza) {
	if ( is_numeric($lunghezza) && $lunghezza > 0 ) {
		$this->lunghezza = string_clean($lunghezza);
	}
	else {
		throw new Exception("La lunghezza dev'essere un numero.");
	}
}


public function getLunghezza() {
	return string_soil($this->lunghezza);
}


public function setAltezza($altezza) {
	if ( is_numeric($altezza) && $altezza > 0 ) {
		$this->altezza = string_clean($altezza);
	}
	else {
		throw new Exception("L'altezza dev'essere un numero.");
	}
}


public function getAltezza() {
	return string_soil($this->altezza);
}


public function setTariffa($tariffa) {
	if ( is_numeric($tariffa) && $tariffa > 0 ) {
		$this->tariffa = string_clean($tariffa);
	}
	else {
		throw new Exception("La tariffa oraria dev'essere un numero.");
	}
}

public function getTariffa() 
{
	return string_soil($this->tariffa);
}


public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Posto_Auto WHERE id = '{$this->id}' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Posto auto non trovato: " . $e->getMessage());
	}
	echo $temp;
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->id = $temp->id;
		$this->totale = string_clean($temp->totale);
		$this->larghezza = string_clean($temp->larghezza);
		$this->lunghezza = string_clean($temp->lunghezza);
		$this->altezza = string_clean($temp->altezza);
		$this->tariffa = string_clean($temp->tariffa_oraria);
		$this->parcheggio = new Parcheggio($temp->id_parcheggio);
		try
		{
			$this->parcheggio->populate($database);
		}
		catch ( Exception $e ) {
			throw $e;
		}
		
		return true;
	}
}


public function save(&$database) {
	try {
		
		if ( $this->id == -1 ) 
		{	
			$database->setQuery("INSERT INTO Posto_Auto (totale, larghezza, lunghezza, altezza, tariffa_oraria, id_parcheggio) VALUES ({$this->totale}, {$this->larghezza}, {$this->lunghezza}, {$this->altezza}, {$this->tariffa}, ". $this->getIdParcheggio() . ")");
		}
		else {
			$database->setQuery("UPDATE Posto_Auto SET totale = '{$this->totale}', larghezza = '{$this->larghezza}', lunghezza = '{$this->lunghezza}', altezza = '{$this->altezza}', tariffa_oraria = '{$this->tariffa}', id_parcheggio = " . $this->getIdParcheggio() . " WHERE id = '{$this->id}' LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) 
	{
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) 
	{
		throw new Exception("Il salvataggio dei dati del posto auto non è andato a buon fine.");
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Posto_Auto WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione del posto auto dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $totale;
private $occupati;
private $larghezza;
private $lunghezza;
private $altezza;
private $tariffa;

private $parcheggio;

}


?>