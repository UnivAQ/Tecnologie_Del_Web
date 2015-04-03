<?php

class Authz {

public function __construct(&$utente) {
	$this->utente = $utente;
	
	$this->gruppi = array();
	$this->permessi = array();
}


public function getPerm($table) {
	return $this->permessi[$table];
}

public function authz(&$database) {
	try {
		$database->setQuery("SELECT DISTINCT id_gruppo FROM R1 WHERE id_utente = " . $this->utente->getId());
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile recuperare i gruppi dell'utente, database error: " . $e->getMessage());
	}
	
	for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
		$temp = $database->getData();
		$this->gruppi[] = $temp->id_gruppo;
	}
	
	
	foreach ( $this->gruppi as $gruppo ) {
		try {
			$database->setQuery("SELECT permesso, t_name FROM Permesso WHERE id_gruppo = {$gruppo}");
			$database->query();
		}
		catch ( Exception $e ) {
			throw new Exception("Impossibile recuperare i permessi dell'utente: " . $e->getMessage());
		}
		
		for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
			$temp = $database->getData();
			if ( array_key_exists($temp->t_name, $this->permessi) ) {
				if ( $this->permessi[$temp->t_name] < $temp->permesso ) {
					$this->permessi[$temp->t_name] = $temp->permesso;
				}
			}
			else {
				$this->permessi[$temp->t_name] = $temp->permesso;
			}
		}
	}
}


private $utente;
private $gruppi;
private $permessi;

}

?>