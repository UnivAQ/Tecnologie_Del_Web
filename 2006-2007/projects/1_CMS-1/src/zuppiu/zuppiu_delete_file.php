<?

session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";

$oid = mysql_query("SELECT * FROM servizio WHERE script = '".basename($_SERVER['SCRIPT_NAME'])."'");
$data = mysql_fetch_assoc($oid);
$_REQUEST[$data[paramName]] = stripslashes($_REQUEST[$data[paramName]]);
$oid = mysql_query("SELECT * FROM {$data[tableName]} WHERE {$data[keyName]} = '".addslashes($_REQUEST[$data[paramName]])."'");
$file = mysql_fetch_assoc($oid);
$sid = mysql_query("DELETE FROM {$data[tableName]} WHERE {$data[keyName]} = '".addslashes($_REQUEST[$data[paramName]])."'");

if($sid) {
	if(unlink($file['path'].$file['nome'])) {
		Header("Location: zuppiu_report.php?id={$_REQUEST['ref']}");
	}  else {
		Header("Location: error.php?id=4");
	}
} else {
	Header("Location: error.php?id=4");
}
?>