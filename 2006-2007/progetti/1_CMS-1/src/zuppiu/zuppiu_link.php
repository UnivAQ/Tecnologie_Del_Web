<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");

$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_link.html");
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
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}
		
		$oid = mysql_query("INSERT INTO link
								VALUES(NULL,
									   '{$_SESSION['user']['username']}',
									   '{$_REQUEST['url']}',
									   '{$_REQUEST['nome']}',
									   '{$_REQUEST['descrizione']}')
						   ");
		
		if(!$oid) {
			$main->setContent("menu", $menu->get() );
			$content->setContent("message", "&nbsp;&nbsp;Link non salvato. Controlla i campi.", "esito=\"ko\"");
		} else {
			$main = new Template("dtml/cms_layout.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_form_contenuto.html");
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get());
			$content->setContent("message", "&nbsp;&nbsp;Link salvato correttamente.", "esito=\"ok\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>