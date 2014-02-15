<?php

class Modello {
	public function __construct($id = -1) {
		$this->id = $id;
	}
	
	public function setId($id) {
		if ( $this->id == -1 ) {
			$this->id = $id;
		}
		else {
			throw new Exception("Non è possibile modificare l'id di un modello già esistente.");
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setLarghezza($larghezza) {
		if ( $larghezza != "" ) {
			settype($larghezza, "float");
			$this->larghezza = string_clean($larghezza);
		}
		else {
			throw new Exception("La larghezza deve essere un numero in virgola mobile.");
		}
	}
	
	public function getLarghezza(){
		return string_soil($this->larghezza);
	}
	
	public function setLunghezza($lunghezza) {
		if ( $lunghezza != "" ) {
			settype($lunghezza, "float");
			$this->lunghezza = string_clean($lunghezza);
		}
		else {
			throw new Exception("La lunghezza deve essere un numero in virgola mobile.");
		}
	}
	
	public function getLunghezza() {
		return string_soil($this->lunghezza);
	}
	
	public function setAltezza($altezza) {
		if ( $altezza != "" ) {
			settype($altezza, "float");
			$this->altezza = string_clean($altezza);
		}
		else {
			throw new Exception("L'altezza deve essere un numero in virgola mobile.");
		}
	}
	
	public function getAltezza() {
		return string_soil($this->altezza);
	}
	
	public function setMarca($marca) {
		if ( is_string($marca) && strlen($marca) <= 100 && $marca != "" ) {
			$this->marca = string_clean($marca);
		}
		else {
			throw new Exception("La marca deve essere una stringa non nulla.");
		}
	}
	
	public function getMarca() {
		return string_soil($this->marca);
	}
	
	public function setNome($nome) {
		if ( is_string($nome) && strlen($nome) <= 100 && $nome != "" ) {
			$this->nome = string_clean($nome);
		}
		else {
			throw new Exception("Il nome deve essere una stringa non nulla.");
		}
	}
	
	public function getNome() {
		return string_soil($this->nome);
	}
	
	public function populate(&$database) {
		try {
			$database->setQuery("SELECT * FROM Modello WHERE id = {$this->id} LIMIT 1");
			$database->query();
		}
		catch ( Exception $e ) {
			throw new Exception("Modello non trovato: {$e->getMessage()}.");
		}
		
		if ( $database->getResultsNumber() == 1 ) {
			$temp = $database->getData();
			$this->larghezza = string_clean($temp->larghezza);
			$this->lunghezza = string_clean($temp->lunghezza);
			$this->altezza = string_clean($temp->altezza);
			$this->marca = string_clean($temp->marca);
			$this->nome = string_clean($temp->nome);
			
			return true;
		}
		else {
			throw new Exception("Automezzo non trovato.");
		}
	}
	
	public function save(&$database) {
		try {
			if ( $this->id == -1 ) {
				$database->setQuery("INSERT INTO Modello (larghezza, lunghezza, altezza, marca, nome) VALUES ({$this->larghezza}, {$this->lunghezza}, {$this->altezza}, '{$this->marca}', '{$this->nome}')");
				$database->query();
			}
			else {
				$database->setQuery("UPDATE Modello SET larghezza = {$this->larghezza}, lunghezza = {$this->lunghezza}, altezza = {$this->altezza}, marca = '{$this->marca}', nome = '{$this->nome}' WHERE id = {$this->id} LIMIT 1");
				$database->query();
			}
		}
		catch ( Exception $e ) {
			throw new Exception("Impossibile eseguire la query: {$e->getMessage()}");
		}
		
		if ( $this->id == -1 ) {
			try {
				$database->setQuery("SELECT id FROM Modello WHERE marca = '{$this->marca}' AND nome = '{$this->nome}'");
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
				throw new Exception("Impossibile recuperare l'id del modello appena inserito.");
			}
		}
		
		return true;
	}
	
	public function delete(&$database) {
		try {
			$database->setQuery("DELETE FROM Modello WHERE id = {$this->id} LIMIT 1");
			$database->query();
		}
		catch ( Exception $e ) {
			throw new Exception("Impossibile eliminare il modello dal database: {$e->getMessage()}");
		}
		
		if ( $database->getResultsNumber() != 1 ) {
			throw new Exception("La rimozione del modello dal database non e' andata a buon fine.");
		}
		
		return true;
	}
	
	private $id;
	private $larghezza;
	private $lunghezza;
	private $altezza;
	private $marca;
	private $nome;
}

?>