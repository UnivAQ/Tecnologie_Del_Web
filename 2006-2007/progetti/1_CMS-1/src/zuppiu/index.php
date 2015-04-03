<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";
require "include/menu.inc.php";

$main = new Template("dtml/main.html");
$navigate = new Template("dtml/navigate.html");
$qid = mysql_query("SELECT * FROM features");
$features = mysql_fetch_assoc($qid);
$main->setContent("servicetitle", $features['nomeservizio']);
$main->setContent("description", $features['descrizione']);
$main->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY posizione"), "value=\"id\"" );
$main->setContent("link", getResult("SELECT nome,url FROM link ORDER BY nome"), "value=\"url\"" );
Menu::setMenu();
$main->setContent("contenuto", getFirstResults("SELECT contenuto.id, contenuto.titolo, contenuto.testo, contenuto.data_creazione, contenuto.ora_creazione
												FROM contenuto
												WHERE pubblicato = 'Y'
												ORDER BY contenuto.data_creazione DESC , contenuto.ora_creazione DESC", 5) );
$main->setContent("navigate", $navigate->get() );
$main->close();

?>