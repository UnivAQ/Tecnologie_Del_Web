<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");

$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_form_link.html");
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
$sid = mysql_query("SELECT nome,url,descrizione FROM {$data[tableName]} WHERE {$data[keyName]} = {$_REQUEST[$data[paramName]]}");
$data = mysql_fetch_assoc($sid);

switch ($_REQUEST['page']) {
	
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
		
		$oid = mysql_query("UPDATE link 
							   SET nome = '{$_REQUEST['nome']}',
							   	   url = '".($_REQUEST['url'] != '' ? $_REQUEST['url'] : '')."',
							   	   descrizione = '{$_REQUEST['descrizione']}'
							 WHERE id = '{$_REQUEST['id']}'
							   ");
		
		if(!$oid) {
			$content->setContent("message", "&nbsp;&nbsp;Link non aggiornato.", "esito=\"ko\"");
		} else {
			$main = new Template("dtml/cms_layout.html");
			$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("username", $_SESSION['user']['username']);
			$menu = new Template("dtml/cms_menu_admin.html");
			$content = new Template("dtml/cms_form_link.html");
			$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
			$menu->setContent("segnalati", getResult("SELECT * FROM link"));
			$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
			$main->setContent("menu", $menu->get() );
			foreach($_REQUEST as $key => $value) {
				$content->setContent($key,stripslashes($value));
			}
			$content->setContent("message", "&nbsp;&nbsp;Link modificato correttamente.", "esito=\"ok\"");
		}
		
		$main->setContent("content", $content->get() );
		break;
	
}

$main->close();

?>