<?

session_start();
require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/functions.inc.php";

$oid = mysql_query("SELECT * FROM servizio WHERE script = '".basename($_SERVER['SCRIPT_NAME'])."'");
$data = mysql_fetch_assoc($oid);
$sid = mysql_query("SELECT path,mimetype FROM {$data[tableName]} WHERE {$data[keyName]} = '".addslashes($_REQUEST[$data[paramName]])."'");
$data = mysql_fetch_assoc($sid);

header("Content-Type: ".$data['mimetype']);
header("Location: ".$data['path'].$_REQUEST['nome']);

?>