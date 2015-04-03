<?php

class Gruppo {

public function __construct($id = -1) {
	$this->id = $id;
}

public function getId() {
	return $this->id;
}

public function setNome($nome) {
	if ( is_string($nome) && strlen($nome) <= 50 ) {
		$this->nome = string_clean($nome);
	}
	else {
		throw new Exception("Il nome del gruppo dev'essere una stringa.");
	}
}

public function getNome() {
	return string_soil($this->nome);
}


public function populate(&$database) {
	try {
		$database->setQuery("SELECT * FROM Gruppo WHERE id = {$this->id}");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile popolare il gruppo: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->nome = string_clean($temp->nome);
		
		return true;
	}
	else {
		throw new Exception("Impossibile popolare il gruppo.");
	}
}


public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Gruppo (nome) VALUES ('{$this->nome}')");
		}
		else {
			$database->setQuery("UPDATE Gruppo SET nome = '{$this->nome}' WHERE id = {$this->id} LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile salvare i dati del gruppo: " . $e->getMessage());
	}
	
	if ( $this->id == -1 ) {
		try {
			$database->setQuery("SELECT id FROM Gruppo WHERE nome = '{$this->nome}'");
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
			throw new Exception("Impossibile recuperare l'id del gruppo appena inserito.");
		}
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Gruppo WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione del gruppo dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $nome;

}

?>
