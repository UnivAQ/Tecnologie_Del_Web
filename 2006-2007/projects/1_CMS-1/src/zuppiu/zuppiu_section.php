<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");

$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_sezioni.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );

// Contenuto

switch($_REQUEST['page']) {
	case 0: 
		$content->setContent("posizione", getResult("SELECT id,nome FROM sezione ORDER BY posizione"));
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}

		$oid = mysql_query("INSERT INTO sezione 
			                        VALUES(NULL,
			                               '{$_REQUEST['nome']}',
			                               '{$_REQUEST['descrizione']}',
			                               {$_REQUEST['posizione']})");
			
		if (!$oid) {
			$content->setContent('message','Errore durante l\'inserimento', "esito=\"ko\"");
		} else {
			$positions = explode("|",$_REQUEST['positionList']);
			
			for ($i=0;$i<count($positions);$i++) {
				$elements = explode(":",$positions[$i]);
				if ($elements[0] != 0) {
					$oid = mysql_query("UPDATE sezione
					                       SET posizione = {$elements[1]}
					                     WHERE id = {$elements[0]}");
					if (!$oid) {
						$content->setContent('message','Generic error in database!', "esito=\"ko\"");
					}
				}
			}
			
			$content->setContent('message','Sezione aggiunta correttamente.', "esito=\"ok\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>