<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$editortype = 0;
$main = new Template("dtml/cms_layout.html");
$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_contenuto.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
$content->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY nome"));

switch($_REQUEST['editor']) {
	case 0:
	default:
		$content->setContent("editortype", "0");
		break;
	case 1: 
		$kindatext = new Template("dtml/cms_rich_text.html");
		$content->setContent("kindatext", $kindatext->get());
		$content->setContent("editortype", "1");
		$editortype = 1;
		break;
}
// Contenuto

switch($_REQUEST['page']) {
	case 0: 
		$main->setContent("content", $content->get() );		
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}
		
		if(!$editortype) {
			$_REQUEST['testo'] = nl2br($_REQUEST['testo']);
		}
		
		$subsections = explode("|", $_REQUEST['sezioni']);
		$selectedFiles = explode("|", $_REQUEST['selectedFiles']);
		
		$today = date('Y-m-d');
		$now = date('H:i:s');
		
		$oid = mysql_query("INSERT INTO contenuto
								 VALUES (NULL,
								 		 '{$_SESSION['user']['username']}',
								 		 '{$_REQUEST['titolo']}',
								 		 '{$_REQUEST['testo']}',
								 		 '{$now}',
								 		 '{$today}',
								 		 '{$now}',
								 		 '{$today}',
								 		 '{$_REQUEST['pubblicato']}',
								 		 {$editortype})");
		
		$hid = mysql_query("SELECT id FROM contenuto
							 WHERE (titolo = '{$_REQUEST['titolo']}') 
							 AND (ora_creazione = '$now')
							 AND (data_creazione = '$today')");
		
		$aux = mysql_fetch_assoc($hid);
		
		/* Inserimento FILE (se associati) */
		if (count($selectedFiles) > 0) {
			foreach ($selectedFiles as $key => $value) {
				if ($value != "") {
					$qid = mysql_query("INSERT INTO contenuto_file
									     VALUES ({$aux['id']}, '".addslashes($value)."')");
				}
			}
		}
		
		/* Inserimento SOTTOSEZIONI */
		foreach ($subsections as $key => $value) {
			$suid = mysql_query("INSERT INTO contenuto_sottosezione
									  VALUES ({$aux['id']}, {$value}) ");
		}
		
		if($oid) {
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
			$main->setContent("menu", $menu->get() );
			$content->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY nome"));
			$content->setContent("message", "&nbsp;&nbsp;Articolo inserito correttamente.", "esito=\"ok\"");
		} else {
			$content->setContent("message", "&nbsp;&nbsp;Articolo non inserito. Controllare i campi.", "esito=\"ko\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>