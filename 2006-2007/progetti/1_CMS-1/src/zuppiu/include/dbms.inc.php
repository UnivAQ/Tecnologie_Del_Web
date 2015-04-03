<?

/* Database Management System */
$conn = mysql_connect('localhost','root','paoloboz') or die("Errore nella connessione a MySql: " . mysql_error());
mysql_select_db('zuppiu',$conn) or die("Errore nella selezione del db: " . mysql_error());

?>