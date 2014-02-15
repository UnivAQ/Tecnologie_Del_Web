<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";
require "include/menu.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/cms_layout.html");
$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_features.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
$qid = mysql_query("SELECT * FROM features");
$features = mysql_fetch_assoc($qid);
$content->setContent("nomeservizio", $features['nomeservizio']);
$content->setContent("descrizione", $features['descrizione']);
$content->setContent("responsabile", $features['responsabile']);

switch($_REQUEST['page']) {
	case 0: 
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		foreach ($_REQUEST as $key => $value) {
			$_REQUEST[$key] = addslashes($value);
		}
		
		$oid = mysql_query("UPDATE features
							   SET nomeservizio = '{$_REQUEST['nomeservizio']}',
							   	   descrizione = '{$_REQUEST['descrizione']}',
							   	   responsabile = '{$_REQUEST['responsabile']}'
							 WHERE id = 0");
		
		if(!$oid) {
			$content->setContent("message", "&nbsp;&nbsp;Features non aggiornate.", "esito=\"ko\"");
		} else {
			$main = new Template("dtml/cms_layout.html");
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_form_features.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );
			$qid = mysql_query("SELECT * FROM features");
			$features = mysql_fetch_assoc($qid);
			$content->setContent("nomeservizio", $features['nomeservizio']);
			$content->setContent("descrizione", $features['descrizione']);
			$content->setContent("responsabile", $features['responsabile']);
			$content->setContent("message", "&nbsp;&nbsp;Features aggiornate correttamente.", "esito=\"ok\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}


$main->close();

?>