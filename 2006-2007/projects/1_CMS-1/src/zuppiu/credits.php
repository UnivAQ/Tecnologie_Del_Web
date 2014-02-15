<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";
require "include/menu.inc.php";

$main = new Template("dtml/main_credits.html");
$navigate = new Template("dtml/navigate.html");
$credits = new Template("dtml/credits.html");
$qid = mysql_query("SELECT * FROM features");
$features = mysql_fetch_assoc($qid);
$main->setContent("servicetitle", $features['nomeservizio']);
$main->setContent("description", $features['descrizione']);
$leavecomments = new Template("dtml/leave_comments.html");
$leavecomments->setContent("id", $_REQUEST['id']);
$main->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY posizione"), "value=\"id\"" );
$main->setContent("link", getResult("SELECT nome,url FROM link ORDER BY nome"), "value=\"url\"" );
Menu::setMenu();
$main->setContent("navigate", $navigate->get() );
$main->setContent("contenuto", $credits->get() );

$main->close();

?>