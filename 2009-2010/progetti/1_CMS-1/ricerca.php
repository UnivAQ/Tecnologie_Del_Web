<?php
include "lib.php";
$smarty = includeSmarty();
session_start();
session_regenerate_id(TRUE);
if (isset($_SESSION['username']) && isset($_SESSION['password'] ) ) {
    $logged=true;
    $id_utente = $_SESSION["id_utente"];
    $smarty->assign("username",$_SESSION["username"]);
    if ($_SESSION["id_utente"]==0)
        $smarty->assign("admin",true);
}
else {
    $logged=false;
    $id_utente = -1;
}
if(isset($_POST["ord"]))
    $order="DESC";
else $order="ASC";

if(isset($_POST["q"])) {
    if($_POST["q"]!=""){

    $smarty->assign("campo",$_POST["q"]);
    $arr_txt = explode(" ", utf8_decode($_POST["q"]));

    $sql = "SELECT * FROM prodotti WHERE ";
    for ($i=0; $i<count($arr_txt); $i++) {
        if ($i > 0) {
            $sql .= " AND ";
        }
        $sql .= "(titolo LIKE '%" . $arr_txt[$i] . "%' OR descrizione LIKE '%" . $arr_txt[$i] . "%')  ORDER BY titolo ".$order;
    }

    $result = mysql_query($sql);
    while ($resrow = mysql_fetch_object($result))
        $oggetti[]=array("id_prodotto"=>$resrow->id_prodotto, "titolo"=>utf8_encode($resrow->titolo),"descrizione"=>substr($resrow->descrizione, 0, 60));

    $smarty->assign("oggetti",$oggetti);
}
}
else
    $smarty->assign("no_query",true);
$smarty->assign("logged",$logged);

$smarty->display("ricerca.tpl.html");
include "db_close.php";
?>
