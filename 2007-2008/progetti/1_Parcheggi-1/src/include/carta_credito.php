<?php

class carta_credito{

public function __construct($id=-1)
{
	$this->id=$id;
}


public function setId($id)
{
	if ( $this->id == -1 ) 
	{
		$this->id = $id;
	}
	else 
	{
		throw new Exception("Non è¨possibile modificare l'id di una carta di credito già  esistente.");
	}
	
}

public function getId() 
{
	return $this->id;
}

public function getTipo()
{
	return string_soil($this->tipo);
}

public function setTipo($tipo)
{
	if (is_string($tipo) && strlen($tipo) <= 20 && $tipo!=""){
	$this->tipo = string_clean($tipo);
	}
	else{
	throw new Exception('Il tipo deve essere una stringa non nulla.');
	}
}

public function getNumero()
{
	return string_soil($this->numero);
}

public function setNumero($numero)
{
	if (is_string($numero) && strlen($numero) <= 50 && $numero!="")
	{
	$this->numero = string_clean($numero);
	}
	else
	{
	throw new Exception('Il numero deve essere una stringa non nulla.');
	}
}

public function getC_Sic() 
{
	return string_soil($this->c_sic);
}

public function setC_Sic($c_sic) 
{
	if (is_string($c_sic) && strlen($c_sic) <= 10){
	$this->c_sic = string_clean($c_sic);	
	}
	else 
	{
	throw new Exception('Il codice di sicurezza deve essere una stringa.');	
	}
}

public function getIntestatario()
{
	return string_soil($this->intestatario);
}

public function setIntestatario($intestatario)
{
	if (is_string($intestatario) && strlen($intestatario) <= 100 && $intestatario != "")
	{
	$this->intestatario = string_clean($intestatario);	
	}
	else
	{
	throw new Exception('L\'intestatario deve essere una stringa non nulla.');	
	}
}

public function getId_Utente() 
{
	return $this->id_utente;
}

public function setUtente($user) {
	if ( is_object($user) && get_class($user) == "Utente" ) {
		$this->id_utente = $user->getId();
	}
	else {
		throw new Exception("L'utente dev'essere un oggetto di tipo Utente.");
	}
}

public function populate(&$database) 
{
	try 
	{
		$database->setQuery("SELECT * FROM Carta_Credito WHERE id = '{$this->id}' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) 
	{
		throw new Exception("id non trovato: {$e->getMessage()}");
	}
	
	if ( $database->getResultsNumber() == 1 ) 
	{
		$temp = $database->getData();
		$this->id = $temp->id;
		$this->tipo = string_clean($temp->tipo);
		$this->numero = string_clean($temp->numero);
		$this->c_sic = string_clean($temp->c_sic);
		$this->intestatario = string_clean($temp->intestatario);
		$this->id_utente = $temp->id_utente;
		return true;
	}
}

public function save(&$database) 
{
	if ( $this->id == -1 ) {
		try {
			$database->setQuery("INSERT INTO Carta_Credito (tipo, numero, c_sic, intestatario, id_utente) VALUES ('{$this->tipo}', '{$this->numero}', '{$this->c_sic}', '{$this->intestatario}', '{$this->id_utente}')");
			$database->query();
		}
		catch ( Exception $e ) 
		{
			throw new Exception("Impossibile eseguire la query: {$e->getMessage()}");
		}
		
		if ( $database->getResultsNumber() != 1 ) 
		{
			throw new Exception("L'inserimento dei dati della carta di credito non e' andato a buon fine.");
		}
		
		return true;
	}
	else 
	{
		try 
		{
			$database->setQuery("UPDATE Carta_Credito SET tipo = '{$this->tipo}', numero = '{$this->numero}', c_sic = '{$this->c_sic}', intestatario = '{$this->intestatario}', id_utente = '{$this->id_utente}' LIMIT 1");
			$database->query();
		}
		catch ( Exception $e ) 
		{
			throw new Exception("Impossibile eseguire la query: {$e->getMessage()}");
		}
		
		if ( $database->getResultsNumber() != 1 ) 
		{
			throw new Exception("L'aggiornamento dei dati della carta di credito non e' andato a buon fine.");
		}
		
		return true;
	}
}

public function delete(&$database) 
{
	try 
	{
		$database->setQuery("DELETE FROM Carta_Credito WHERE id = '{$this->id}' LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) 
	{
		throw new Exception("Impossibile eliminare la carta di credito dal database: {$e->getMessage()}");
	}
	
	if ( $database->getResultsNumber() != 1 ) 
	{
		throw new Exception("La rimozione della carta di credito dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $tipo;
private $numero;
private $c_sic;
private $intestatario;
private $id_utente;
}
?>