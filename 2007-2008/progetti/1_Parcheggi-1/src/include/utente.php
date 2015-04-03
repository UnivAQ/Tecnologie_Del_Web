<?php


class Utente {

public function __construct($id = -1, $username = "", $password = "") {
	$this->id = string_clean($id);
	$this->username = string_clean($username);
	$this->password = string_clean($password);
}


public function setId($id) {
	if ( $this->id == -1 ) {
		$this->id = string_clean($id);
	}
	else {
		throw new Exception("Non è possibile modificare l'id di un utente già esistente.");
	}
}


public function getId() {
	return $this->id;
}


public function setUsername($user) {
	if ( is_string($user) && strlen($user) <= 25 ) {
		$this->username = string_clean($user);
	}
	else {
		throw new Exception("{$user} isn't a valid username.");
	}
}


public function getUsername() {
	return string_soil($this->username);
}


public function setPassword($password) {
	if ( is_string($password) ) {
		$this->password = md5(string_clean($password));
	}
	else {
		throw new Exception("{$password} isn't a valid password.");
	}
}


public function getPassword() {
	return string_soil($this->password);
}


public function setNome($nome) {
	if ( is_string($nome) && strlen($nome) <= 100 ) {
		$this->nome = string_clean($nome);
	}
	else {
		throw new Exception("Il nome dev'essere una stringa.");
	}
}


public function getNome() {
	return string_soil($this->nome);
}


public function setCognome($cognome) {
	if ( is_string($cognome) && strlen($cognome) <= 100 ) {
		$this->cognome = string_clean($cognome);
	}
	else {
		throw new Exception("Il cognome dev'essere una stringa.");
	}
}


public function getCognome() {
	return string_soil($this->cognome);
}


public function setDNascita($anno, $mese, $giorno) {
	if ( is_int($anno) && is_int($mese) && is_int($giorno) ) {
		$this->a_nascita = string_clean($anno);
		$this->m_nascita = string_clean($mese);
		$this->g_nascita = string_clean($giorno);
	}
	else {
		throw new Exception("Anno, mese e giorno di nascita devono essere degli interi.");
	}
}


public function getANascita() {
	return string_soil($this->a_nascita);
}


public function getMNascita() {
	return string_soil($this->m_nascita);
}


public function getGNascita() {
	return string_soil($this->g_nascita);
}


public function setLNascita($l_nascita) {
	if ( is_string($l_nascita) && strlen($l_nascita) <= 100 ) {
		$this->l_nascita = string_clean($l_nascita);
	}
	else {
		throw new Exception("Il luogo di nascita dev'essere una stringa.");
	}
}


public function getLNascita() {
	return string_soil($this->l_nascita);
}


public function setEmail($email) {
	if ( is_string($email) && strlen($email) <= 100 ) {
		$this->email = string_clean($email);
	}
	else {
		throw new Exception("L'email dev'essere una stringa.");
	}
}


public function getEmail() {
	return string_soil($this->email);
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
		$database->setQuery("SELECT * FROM Utente WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Utente #{$this->id} non trovato: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() == 1 ) {
		$temp = $database->getData();
		$this->username = string_clean($temp->username);
		$this->password = string_clean($temp->password);
		$this->nome = string_clean($temp->nome);
		$this->cognome = string_clean($temp->cognome);
		$this->a_nascita = strtok(string_clean($temp->d_nascita), "-");
		$this->m_nascita = strtok("-");
		$this->g_nascita = strtok("-");
		$this->l_nascita = string_clean($temp->l_nascita);
		$this->email = string_clean($temp->email);
		$this->indirizzo = new Indirizzo($temp->id_indirizzo);
		try {
			$this->indirizzo->populate($database);
		}
		catch ( Exception $e )
		{
			throw $e;
		}
		return true;
	}
	else {
		throw new Exception("Utente non trovato.");
	}
}


public function save(&$database) {
	try {
		if ( $this->id == -1 ) {
			$database->setQuery("INSERT INTO Utente (nome, cognome, d_nascita, l_nascita, username, password, email, id_indirizzo)VALUES ('{$this->nome}', '{$this->cognome}', '{$this->a_nascita}-{$this->m_nascita}-{$this->g_nascita}', '{$this->l_nascita}', '{$this->username}', '{$this->password}', '{$this->email}', " . $this->indirizzo->getId() . ")");
		}
		else {
			$database->setQuery("UPDATE Utente SET nome = '{$this->nome}', cognome = '{$this->cognome}', d_nascita = '{$this->a_nascita}-{$this->m_nascita}-{$this->g_nascita}', l_nascita = '{$this->l_nascita}', password = '{$this->password}', email = '{$this->email}', id_indirizzo = " . $this->indirizzo->getId() . " WHERE id = {$this->id} LIMIT 1");
		}
		
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $this->id == -1 ) {
		try {
			$database->setQuery("SELECT id FROM Utente WHERE username = '{$this->username}'");
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
			throw new Exception("Impossibile recuperare l'id dell'utente appena inserito.");
		}
	}
		
	return true;
}


public function delete(&$database) {
	try {
		$database->setQuery("DELETE FROM Utente WHERE id = {$this->id} LIMIT 1");
		$database->query();
	}
	catch ( Exception $e ) {
		throw new Exception("Impossibile eseguire la query: " . $e->getMessage());
	}
	
	if ( $database->getResultsNumber() != 1 ) {
		throw new Exception("La rimozione dell'utente dal database non e' andata a buon fine.");
	}
	
	return true;
}


private $id;
private $username;
private $password;
private $nome;
private $cognome;
private $a_nascita;
private $m_nascita;
private $g_nascita;
private $l_nascita;
private $email;

private $indirizzo;

}

?>