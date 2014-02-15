<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");

$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_contenuto_modifica.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
$oid = mysql_query("SELECT * FROM servizio WHERE script = '".basename($_SERVER['SCRIPT_NAME'])."'");
$data = mysql_fetch_assoc($oid);
$sottosezioni = getResult("SELECT id_sottosezione FROM contenuto_sottosezione WHERE id_contenuto = {$_REQUEST[$data[paramName]]}");
$content->setContent("sezioniSelezionate", getResult("SELECT id_sottosezione FROM contenuto_sottosezione WHERE id_contenuto = {$_REQUEST[$data[paramName]]}"));
$content->setContent("sottosezioni", getResult("SELECT id,nome FROM sottosezione ORDER BY id_sezione"), "sel=\"".spacize($sottosezioni)."\"");
$sid = mysql_query("SELECT titolo,testo,editortype FROM {$data[tableName]} WHERE {$data[keyName]} = {$_REQUEST[$data[paramName]]}");
$data = mysql_fetch_assoc($sid);

switch($_REQUEST['page']) {
	case 0: 
		if($data['editortype'] == 1) {
			$kindatext = new Template("dtml/cms_rich_text.html");
			$content->setContent("kindatext", $kindatext->get() );
		}
		foreach($data as $key => $value) {
			$content->setContent($key,$value);
		}
		$main->setContent("content", $content->get() );
		break;
	case 1:
		
		foreach ($_REQUEST as $k=>$value) {
			$_REQUEST[$k] = addslashes($value);
		}
		
		$ss = explode("|",$_REQUEST['sezioni']);
		
		$today = date('Y-m-d');
		$now = date('H:i:s');
		
		$oid = mysql_query("UPDATE contenuto
								 SET titolo = '{$_REQUEST['titolo']}',
								 	 testo = '{$_REQUEST['testo']}',
								 	 ora_modifica = '{$now}',
								 	 data_modifica = '{$today}',
								 	 pubblicato = '{$_REQUEST['pubblicato']}'
								 WHERE id = '{$_REQUEST['id']}'
						  ");
		
		$did = mysql_query("DELETE FROM contenuto_sottosezione
								  WHERE id_contenuto = {$_REQUEST['id']}");
		
		foreach($ss as $d => $c) {
			$iid = mysql_query("INSERT INTO contenuto_sottosezione
									 VALUES ({$_REQUEST['id']}, $c)");
		}
		
		if($oid) {
			$main = new Template("dtml/cms_layout.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_form_contenuto_modifica.html");
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );
			$sottosezioni = getResult("SELECT id_sottosezione FROM contenuto_sottosezione WHERE id_contenuto = {$_REQUEST[id]}");
			$content->setContent("sezioniSelezionate", getResult("SELECT id_sottosezione FROM contenuto_sottosezione WHERE id_contenuto = {$_REQUEST[id]}"));
			$content->setContent("sottosezioni", getResult("SELECT id,nome FROM sottosezione ORDER BY id_sezione"), "sel=\"".spacize($sottosezioni)."\"");
			foreach($_REQUEST as $key => $value) {
				$content->setContent($key,stripslashes($value));
			}
			$content->setContent("message", "&nbsp;&nbsp;Articolo modificato correttamente.", "esito=\"ok\"");
		} else {
			$content->setContent("message", "&nbsp;&nbsp;Articolo non modificato. Controllare i campi.", "esito=\"ko\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
}

$main->close();

?>