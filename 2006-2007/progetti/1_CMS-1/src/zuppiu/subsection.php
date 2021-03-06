<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";
require "include/menu.inc.php";

$main = new Template("dtml/internal.html");
$navigate = new Template("dtml/navigate.html");
$qid = mysql_query("SELECT * FROM features");
$features = mysql_fetch_assoc($qid);
$main->setContent("servicetitle", $features['nomeservizio']);
$main->setContent("description", $features['descrizione']);
$main->setContent("sezioni", getResult("SELECT id,nome FROM sezione ORDER BY posizione"), "value=\"id\"" );
$main->setContent("link", getResult("SELECT nome,url FROM link ORDER BY nome"), "value=\"url\"" );
Menu::setMenu();
$main->setContent("navigate", $navigate->get() );
$idsezione = getResult("SELECT id_sezione FROM sottosezione WHERE id = '{$_REQUEST['id']}'");

$main->setContent("contenuto", getFirstResults("SELECT contenuto.id, contenuto.titolo, contenuto.testo, contenuto.ora_creazione, contenuto.data_creazione
												FROM contenuto, contenuto_sottosezione
												WHERE contenuto.id = contenuto_sottosezione.id_contenuto
												AND contenuto_sottosezione.id_sottosezione = '{$_REQUEST['id']}'
												AND contenuto.pubblicato = 'Y'
												ORDER BY contenuto.data_creazione DESC , contenuto.ora_creazione DESC", 5));

$main->setContent("sottosezioni", getResult("SELECT id,nome FROM sottosezione WHERE id_sezione = '{$idsezione[0]['id_sezione']}' ORDER BY nome"), "value=\"id\"");
$main->close();

?>