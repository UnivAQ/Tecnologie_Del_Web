<?php
include "lib.php";
$smarty = includeSmarty();

session_start();
session_regenerate_id(TRUE);

if (!isset($_SESSION['username'] ) and !isset($_SESSION['password'] ) )
{
    $smarty->assign("logged",false);
}
else
{
    $id_utente = $_SESSION['id_utente'];
    $smarty->assign("logged",true);
    $smarty->assign("username",$_SESSION["username"]);
    // Controllo ADMIN
    if ($_SESSION["id_utente"]==0)
        $smarty->assign("admin",true);

    // Controllo Servizio: inserimento prodotto
    if (checkServizio(2, $id_utente))
        $smarty->assign("servizio_2",true);

$sql = "SELECT id_prodotto, titolo FROM prodotti WHERE id_utente=".$id_utente;
$result = mysql_query($sql);
if (mysql_num_rows($result))
{
    while ($resrow = mysql_fetch_object($result))
         $prodotto[]=array('id_prodotto'=>$resrow->id_prodotto, 'titolo'=>$resrow->titolo);

    $smarty->assign("prodotto",$prodotto);

}


}

$smarty->display("pannello_utente.tpl.html");
include "db_close.php";
?>