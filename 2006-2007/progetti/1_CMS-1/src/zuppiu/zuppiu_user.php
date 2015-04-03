<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

define(DUPLICATE_KEY, 1062);

$main = new Template("dtml/cms_layout.html");

$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_utente.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$content->setContent("gruppo", getResult("SELECT id,nome FROM gruppo"));
$main->setContent("menu", $menu->get() );

switch($_REQUEST['page']) {
	case 0: 
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}
		
		$oid = mysql_query("INSERT INTO utente
								 VALUES ('{$_REQUEST['username']}',
								 		 MD5('{$_REQUEST['password']}'),
								 		 '{$_REQUEST['nome']}',
								 		 '{$_REQUEST['cognome']}',
								 		 '{$_REQUEST['data_di_nascita']}',
								 		 '{$_REQUEST['via']}',
								 		 '{$_REQUEST['citta']}',
								 		 '{$_REQUEST['cap']}',
								 		 '{$_REQUEST['email']}',
								 		 '{$_REQUEST['telefono_fisso']}',
								 		 '{$_REQUEST['telefono_mobile']}',
								 		 '".($_REQUEST['url'] != '' ? 'http://'.$_REQUEST['url'] : '')."'
								 		 )
								 ");
		if(!$oid) {
			if (mysql_errno() == DUPLICATE_KEY) {
				$content = new Template("dtml/cms_form_utente.html");
				$content->setContent("gruppo", getResult("SELECT id,nome FROM gruppo"));
				$content->setContent("message", "&nbsp;&nbsp;Username già esistente. Inserirne uno diverso.", "esito=\"ko\"");
				foreach($_REQUEST as $key => $value) {
					$content->setContent($key,stripslashes($value));
				}
			}
		} else {
			$oid = mysql_query("INSERT INTO utente_gruppo VALUES ('{$_REQUEST['username']}',{$_REQUEST['gruppo']})");
			if (!$oid) {
				$content = new Template("dtml/cms_form_utente.html");
				$content->setContent("gruppo", getResult("SELECT id,nome FROM gruppo"));
				$content->setContent("message", "&nbsp;&nbsp;Errore di comunicazione col database. (".mysql_error().")", "esito=\"ko\"");
				foreach($_REQUEST as $key => $value) {
					$content->setContent($key,stripslashes($value));
				}
			} else { // Esito positivo
				$content = new Template("dtml/cms_form_utente.html");
				$content->setContent("gruppo", getResult("SELECT id,nome FROM gruppo"));
				$content->setContent("message", "&nbsp;&nbsp;Utente ".$_REQUEST['username']." aggiunto correttamente.", "esito=\"ok\"");
			}
		}
		$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>