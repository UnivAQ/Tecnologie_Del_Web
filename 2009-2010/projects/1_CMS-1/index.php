<?php
include "lib.php";
$smarty = includeSmarty();
session_start();
session_regenerate_id(TRUE);

if (isset($_SESSION['username'] ) && isset($_SESSION['password'] ) ) {
    $smarty->assign("logged",true);
    $smarty->assign("username",$_SESSION["username"]);
    if ($_SESSION["id_utente"]==0)
        $smarty->assign("admin",true);

}

$sql = "SELECT * FROM prodotti ORDER BY rand() limit 5 ";
$result = mysql_query($sql);
while ($resrow = mysql_fetch_object($result))
    $oggetti[]=array("id_prodotto"=>$resrow->id_prodotto, "titolo"=>utf8_encode($resrow->titolo),"descrizione"=>substr($resrow->descrizione, 0, 100));
$smarty->assign("oggetti",$oggetti);
$smarty->display("index.tpl.html");
?>