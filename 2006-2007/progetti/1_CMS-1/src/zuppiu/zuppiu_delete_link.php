<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";

$oid = mysql_query("SELECT * FROM servizio WHERE script = '".basename($_SERVER['SCRIPT_NAME'])."'");
$data = mysql_fetch_assoc($oid);
$sid = mysql_query("DELETE FROM {$data[tableName]} WHERE {$data[keyName]} = {$_REQUEST[$data[paramName]]}");

if(!$sid) {
	Header("Location: error.php?id=4");
} else {
	Header("Location: zuppiu_report.php?id={$_REQUEST['ref']}");
}

?>