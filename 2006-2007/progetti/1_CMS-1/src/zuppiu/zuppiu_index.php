<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
require "include/functions.inc.php";

$main = new Template("dtml/cms_layout.html");

$menu = new Template("dtml/cms_menu_admin.html");
$content = new Template("dtml/cms_content_base.html");
$qid = mysql_query("SELECT * FROM features");
$features = mysql_fetch_assoc($qid);
$uid = mysql_query("SELECT * FROM utente WHERE username = 'admin'");
$admin = mysql_fetch_assoc($uid);
$main->setContent("utente", getResult("SELECT nome,cognome FROM utente WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("username", $_SESSION['user']['username']);
$menu->setContent("pubblicati", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'Y') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("bozze", getResult("SELECT * FROM contenuto WHERE (pubblicato = 'N') AND (username = '{$_SESSION['user']['username']}')"));
$menu->setContent("presenti", getResult("SELECT * FROM sezione"));
$menu->setContent("segnalati", getResult("SELECT * FROM link"));
$menu->setContent("archivio", getResult("SELECT * FROM file WHERE username = '{$_SESSION['user']['username']}'"));
$main->setContent("menu", $menu->get() );
$content->setContent("articlesnumber", getCountResult("SELECT * FROM contenuto"));
$content->setContent("draftsnumber", getCountResult("SELECT * FROM contenuto WHERE pubblicato = 'N'"));
$content->setContent("filesnumber", getCountResult("SELECT * FROM file"));
$content->setContent("typesnumber", getCountResult("SELECT DISTINCT mimetype FROM file"));
$content->setContent("linksnumber", getCountResult("SELECT * FROM link"));
$content->setContent("sectionsnumber", getCountResult("SELECT * FROM sezione"));
$content->setContent("subsectionsnumber", getCountResult("SELECT * FROM sottosezione"));
$content->setContent("usersnumber", getCountResult("SELECT * FROM utente"));
$content->setContent("servicetitle", $features['nomeservizio']);
$content->setContent("descrizione", $features['descrizione']);
$content->setContent("adminname", $admin['nome']. " " . $admin['cognome']);
$content->setContent("emailaddress", $admin['email']);
$main->setContent("content", $content->get() );
$main->close();

?>