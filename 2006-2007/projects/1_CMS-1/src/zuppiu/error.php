<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

switch($_REQUEST['id']) {
	case 1: $main = new Template("dtml/main.html");
			$admin = new Template("dtml/adminNotLogged.html");
			$navigate = new Template("dtml/navigate.html");
			$main->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY posizione"), "value=\"id\"" );
			$main->setContent("link", getResult("SELECT nome,url FROM link ORDER BY nome"), "value=\"url\"" );
			$admin->setContent("message", "Username o password errati. Riprovare.");
			$main->setContent("admin", $admin->get() );
			$main->setContent("contenuto", getFirstResults("SELECT titolo,testo,ora_creazione,data_creazione FROM contenuto WHERE pubblicato = 'Y' ORDER BY data_creazione,ora_creazione DESC", 5) );
			$main->setContent("navigate", $navigate->get() );
			$main->close();
			
			break;
	
	case 2: $main = new Template("dtml/cms_layout.html");
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_error.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );
			$content->setContent("message", "&nbsp;&nbsp;Non si hanno i privilegi per accedere a questa operazione.");
			$main->setContent("content", $content->get() );
			$main->close();
			break;
			
	case 3: $main = new Template("dtml/cms_layout.html");
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_error.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );
			$content->setContent("message", "&nbsp;&nbsp;Data filtering error: il contenuto selezionato non appartiene all'utente corrente.");
			$main->setContent("content", $content->get() );
			$main->close();
			break;
}
?>