<?

Class Auth {
	
	function doLogin() {
		
		if (!$_SESSION['user']) {
		
			$oid = mysql_query("SELECT * 
		                  	    FROM utente
		                  	   WHERE username = '{$_POST['username']}'
		                  	     AND password = MD5('{$_POST['password']}')");
		
			if (!$oid) {		
				echo "Error in database!<hr>";
				echo mysql_error();
					exit;		
			}
			if (mysql_num_rows($oid) == 0) {
				Header("Location: error.php?id=1");
				exit;
			
			} else {
			
				$_SESSION['user'] = mysql_fetch_assoc($oid);
				
				$oid = mysql_query("SELECT utente.username, 
				                           gruppo.nome, 
				                           servizio.script,
				                           servizio.tableName,
				                           servizio.keyName,
				                           servizio.paramName
                                  FROM utente            
                             LEFT JOIN utente_gruppo 
                                    ON utente_gruppo.id_utente = utente.username
                             LEFT JOIN gruppo 
                                    ON gruppo.id = utente_gruppo.id_gruppo
                             LEFT JOIN gruppo_servizio 
                                    ON gruppo_servizio.id_gruppo = gruppo.id
                             LEFT JOIN servizio 
                                    ON servizio.id = gruppo_servizio.id_servizio
                                 WHERE utente.username =  '{$_SESSION['user']['username']}'");
				if (!$oid) {
					echo "Error in database! (services)";
					exit;
				}
				
				do {
					$data = mysql_fetch_assoc($oid);
					if ($data) {
						$_SESSION['user']['services'][] = $data;
					
					}
					
				} while ($data);
			}
		}
		
		$trovato = false;
		foreach ($_SESSION['user']['services'] as $k => $v) {
			if ($v['script'] == basename($_SERVER['SCRIPT_NAME'])) {
				$trovato = true;
				$currentService = $v;
			}
		}
			
		if (!$trovato) {	
			Header("Location: error.php?id=2");
			exit;
		} 
		
		if ($currentService['tableName']) { // Data Filtering Check
			
			$oid = mysql_query("SELECT username
			                      FROM {$currentService['tableName']}
			                     WHERE {$currentService['keyName']} = '".addslashes($_REQUEST[$currentService['paramName']])."'");
			if (!$oid) {
				echo "Error in database! (df)";
				exit;
			}
			
			$data = mysql_fetch_assoc($oid);
			
			if ($data['username'] != $_SESSION['user']['username']) {
				
				Header("Location: error.php?id=3");
				exit;
			}
			
		}
				
	}
	
	
}


Auth::doLogin();

?>