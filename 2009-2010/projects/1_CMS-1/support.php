<?php
include "lib.php";
$smarty = includeSmarty();
session_start();
session_regenerate_id(TRUE);

if (isset($_SESSION['username'] ) && isset($_SESSION['password'] ) )
{
$smarty->assign("logged",true);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);
}

$smarty->display("support.tpl.html");
?>