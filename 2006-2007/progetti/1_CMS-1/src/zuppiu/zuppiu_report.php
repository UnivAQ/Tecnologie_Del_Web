<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");
$menu = new Template("dtml/cms_menu_admin.html"); 
$report = new Template("dtml/cms_report.html");
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
/* Fine inizializzazione */

$data = getResult("SELECT query_string,view_script,edit_script,delete_script,keyName FROM riepilogo WHERE id = {$_REQUEST['id']}");
if (ereg("PHPENV\((.*)\)",$data[0]['query_string'],$token)) {
	eval("\$username = ".$token[1].";");
	$data[0]['query_string'] = ereg_replace("PHPENV\((.*)\)",$username,$data[0]['query_string']);
}
$target = (ereg("file", $data[0]['query_string']) ? '1' : '0');
$report->setContent("items", getResult("{$data[0]['query_string']}"),'view="'.$data[0]['view_script'].'" edit="'.$data[0]['edit_script'].'" delete="'.$data[0]['delete_script'].'" keyName="'.$data[0]['keyName'].'" referer="'.$_REQUEST['id'].'" target="'.$target.'"');
$main->setContent("content", $report->get() );
$main->close();
?>