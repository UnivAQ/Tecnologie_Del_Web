<?
session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");
$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_utente_modifica.html");
$kindatext = new Template("dtml/cms_rich_text.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
$oid = mysql_query("SELECT * FROM servizio WHERE script = '".basename($_SERVER['SCRIPT_NAME'])."'");
$data = mysql_fetch_assoc($oid);
$sid = mysql_query("SELECT * FROM {$data[tableName]} WHERE {$data[keyName]} = '{$_REQUEST[$data[paramName]]}'");
$data = mysql_fetch_assoc($sid);
//$content->setContent("kindatext", $kindatext->get());
// Contenuto

switch($_REQUEST['page']) {
	case 0: 
		foreach($data as $key => $value) {
			$content->setContent($key,$value);
		}
		
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}
		
		$now = date('H:i:s');
		$today = date('Y-m-d');
		
		if ($_REQUEST['password'] != '') {
			$query = "UPDATE utente
					 	 SET password = '{$_REQUEST['password']}',
					 	     nome = '{$_REQUEST['nome']}',
					 	     cognome = '{$_REQUEST['cognome']}',
					 	     data_di_nascita = '{$_REQUEST['data_di_nascita']}',
					 	     via = '{$_REQUEST['via']}',
					 	     citta = '{$_REQUEST['citta']}',
					 	     cap = '{$_REQUEST['cap']}',
					 	     email = '{$_REQUEST['email']}',
					 	     telefono_fisso = '{$_REQUEST['telefono_fisso']}',
					 	     telefono_mobile = '{$_REQUEST['telefono_mobile']}',
					 	     url = '{$_REQUEST['url']}'
					   WHERE username = '{$_REQUEST['username']}'";
		} else {
			$query = "UPDATE utente
					 	 SET nome = '{$_REQUEST['nome']}',
					 	     cognome = '{$_REQUEST['cognome']}',
					 	     data_di_nascita = '{$_REQUEST['data_di_nascita']}',
					 	     via = '{$_REQUEST['via']}',
					 	     citta = '{$_REQUEST['citta']}',
					 	     cap = '{$_REQUEST['cap']}',
					 	     email = '{$_REQUEST['email']}',
					 	     telefono_fisso = '{$_REQUEST['telefono_fisso']}',
					 	     telefono_mobile = '{$_REQUEST['telefono_mobile']}',
					 	     url = '{$_REQUEST['url']}'
					   WHERE username = '{$_REQUEST['username']}'";
		}
		
		$oid = mysql_query($query);
		
		if($oid) {
			$main = new Template("dtml/cms_layout.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_form_utente_modifica.html");
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );

			foreach($_REQUEST as $key => $value) {
				$content->setContent($key,stripslashes($value));
			}
			$content->setContent("message", "&nbsp;&nbsp;Profilo utente aggiornato correttamente.", "esito=\"ok\"");
		} else {
			$content->setContent("message", "&nbsp;&nbsp;Profilo non aggiornato. Controllare i campi.", "esito=\"ko\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>