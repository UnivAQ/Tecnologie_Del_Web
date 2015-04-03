<?php

/*
 Copyright (C) 2007-2008 Alessio 'isazi' Sclocco <isazi@olografix.org>
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, version 3 of the License.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class MySQLDB {

public function __construct($user = "", $password = "", $server = "localhost") {
	$this->server = "localhost";
	$this->user = $user;
	$this->password = $password;
	$this->connection = false;
	$this->data = false;
	$this->database = "";
	$this->query = "";
}


public function __destruct() {
	if ( is_resource($this->data) ) {
		mysql_free_result($this->data);
	}
	$this->disconnect();
}


public function connect() {
	$this->connection = mysql_connect($this->server, $this->user, $this->password);
	if ( !$this->connection ) {
		throw new Exception("Error: " . mysql_error());
	}
	
	if ( is_string($this->database) ) {
		$this->setDatabase($this->database);
	}
}


public function disconnect() {
	if ( $this->connection ) {
		if ( !mysql_close($this->connection) ) {
			throw new Exception("Error: " . mysql_error());
		}
	}
}


public function setServer($server) {
	if ( is_string($server) ) {
		$this->server = $server;
	}
	else {
		throw new Exception("{$server} isn't a valid server string.");
	}
}


public function getServer() {
	return $this->server;
}


public function setUser($user) {
	if ( is_string($user) ) {
		$this->user = $user;
	}
	else {
		throw new Exception("{$user} isn't a valid username string.");
	}
}


public function getUser() {
	return $this->user;
}


public function setPassword($password) {
	if ( is_string($password) ) {
		$this->password = $password;
	}
	else {
		throw new Exception("{$password} isn't a valid password string.");
	}
}


public function setDatabase($database) {
	if ( is_string($database) ) {
		$this->database = $database;
		
		if ( $this->connection ) {
			mysql_select_db($this->database, $this->connection);
		}
	}
	else {
		throw new Exception("{$database} isn't a valid database string.");
	}
}


public function getDatabase() {
	return $this->database;
}


public function setQuery($query) {
	if ( is_string($query) ) {
		$this->query = $query;
	}
	else {
		throw new Exception("{$query} isn't a valid query string.");
	}
}


public function getQuery() {
	return $this->query;
}


public function query() {
	$temp = mysql_query($this->query, $this->connection);
	
	if ( !$temp ) {
		throw new Exception("Error: " . mysql_error());
	}
	else {
		if ( is_resource($this->data) ) {
			mysql_free_result($this->data);
		}
		
		$this->data = $temp;
	}
}


public function getData() {
	if ( is_bool($this->data) ) {
		return $this->data;
	}
	else {
		return mysql_fetch_object($this->data);
	}
}


public function getResultsNumber() {
	if ( is_bool($this->data) ) {
		return mysql_affected_rows($this->connection);
	}
	else if ( $this->data ) {
		return mysql_num_rows($this->data);
	}
	else {
		return -1;
	}
}

public function count($what, $where, $when = "") {
	try {
		$query = "SELECT COUNT(" . $what . ") FROM " . $where;
		if ( $when != "" ) {
			$query .= " WHERE " . $when;
		}
		$this->setQuery($query);
		$this->query();
	}
	catch ( Exception $e ) {
		throw $e;
	}
	
	if ( $this->getResultsNumber() == 1 ) {
		$temp = $this->getData();
		settype($temp, "array");
		
		return $temp["COUNT(" . $what . ")"];
	}
	else {
		throw new Exception("Impossibile eseguire questa operazione di COUNT.");
	}
}

private $connection;
private $data;

private $server;
private $user;
private $password;
private $database;
private $query;

}

?>