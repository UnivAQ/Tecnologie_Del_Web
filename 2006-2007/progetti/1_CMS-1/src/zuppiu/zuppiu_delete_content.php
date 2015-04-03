<?
session_start();

require "include/template.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";

$oid = mysql_query("SELECT * FROM servizio WHERE script = '".basename($_SERVER['SCRIPT_NAME'])."'");
$data = mysql_fetch_assoc($oid);
$fid = mysql_query("SELECT * FROM contenuto_file WHERE id_contenuto = {$_REQUEST[$data[paramName]]}");
$cid = mysql_query("SELECT * FROM commento WHERE id_contenuto = {$_REQUEST[$data[paramName]]}");
$sid = mysql_query("DELETE FROM {$data[tableName]} WHERE {$data[keyName]} = {$_REQUEST[$data[paramName]]}");
if (mysql_num_rows($fid) > 0) {
	$oid = mysql_query("DELETE FROM contenuto_file WHERE id_contenuto = {$_REQUEST[$data[paramName]]}");
}
if (mysql_num_rows($cid) > 0) {
	$oid = mysql_query("DELETE FROM commento WHERE id_contenuto = {$_REQUEST[$data[paramName]]}");
}

if(!$sid) {
	Header("Location: error.php?id=4");
} else {
	Header("Location: zuppiu_report.php?id={$_REQUEST['ref']}");
}
?>