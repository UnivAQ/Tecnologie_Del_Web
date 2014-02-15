<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/cms_layout.html");
$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_permessi.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );

$content->setContent("permessi", getResult("SELECT gruppo.nome AS gruppo_nome, 
						                          gruppo.id AS gruppo_id, 
						                          servizio.nome AS servizio_nome, 
						                          servizio.id AS servizio_id, 
						                          IF ( gruppo_servizio.id_gruppo IS  NULL ,'','*') AS enabled
						                     FROM gruppo, servizio
						                LEFT JOIN gruppo_servizio 
						                       ON gruppo_servizio.id_gruppo = gruppo.id 
						                      AND gruppo_servizio.id_servizio = servizio.id
						                ORDER  BY gruppo.id"));

switch ($_REQUEST['page']) {
	case 0:
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		$oid = mysql_query("DELETE FROM gruppo_servizio");
		
		foreach ($_REQUEST as $k => $v) {
			if(ereg("c_(.*)", $k, $token)) {
				$ids = explode("_", $token[1]);
				$oid = mysql_query("INSERT INTO gruppo_servizio VALUES ({$ids[0]},{$ids[1]})");
			}
		}
		
		$main = new Template("dtml/cms_layout.html");
		$menu = new Template("dtml/cms_menu_admin.html");
		$content = new Template("dtml/cms_permessi.html");
		$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
		$main->setContent("username", $_SESSION['user']['username']);
		$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
		$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
		$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
		$menu->setContent("segnalati", getResult("SELECT * FROM link"));
		$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
		$main->setContent("menu", $menu->get() );
		
		$content->setContent("permessi", getResult("SELECT gruppo.nome AS gruppo_nome, 
								                          gruppo.id AS gruppo_id, 
								                          servizio.nome AS servizio_nome, 
								                          servizio.id AS servizio_id, 
								                          IF ( gruppo_servizio.id_gruppo IS  NULL ,'','*') AS enabled
								                     FROM gruppo, servizio
								                LEFT JOIN gruppo_servizio 
								                       ON gruppo_servizio.id_gruppo = gruppo.id 
								                      AND gruppo_servizio.id_servizio = servizio.id
								                ORDER  BY gruppo.id"));
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();
?>