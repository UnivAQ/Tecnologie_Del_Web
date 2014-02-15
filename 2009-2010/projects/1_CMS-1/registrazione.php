<?php
include "lib.php";
$smarty = includeSmarty();
session_start();
session_regenerate_id(TRUE);

if (isset($_SESSION['username']) && isset($_SESSION['password'] ) )
{
    $smarty->assign("username",$_SESSION["username"]);
    $logged=true;
    $id_utente = $_SESSION["id_utente"];
    if ($_SESSION["id_utente"]==0)
        $smarty->assign("admin",true);
}
else
{
    $logged=false;
    $id_utente = -1;
}
if ($_GET["tipo"]==1)
    $smarty->assign("tipo",utente);
else
    $smarty->assign("tipo",azienda);



if (isset ($_POST["save"]))
{
    $sql = "SELECT username FROM utenti WHERE username='".$_POST["username"]."'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result)==0)
    {
        $sql = "INSERT INTO utenti (id_utente, username, password, email) VALUES (NULL, '".$_POST["username"]."', '".md5($_POST["password"])."', '".$_POST["email"]."')";
        mysql_query($sql) or die (mysql_error());
        $id = mysql_insert_id();

        if ($_GET["tipo"]==1)
            $sql = "INSERT INTO utenti_gruppi (id_utente, id_gruppo) VALUES ($id, 1);";
        else
            $sql = "INSERT INTO utenti_gruppi (id_utente, id_gruppo) VALUES ($id, 2);";
        mysql_query($sql) or die (mysql_error());

        $smarty->assign("reg_ok",true);
        $smarty->assign("username",$_POST["username"]);
        $smarty->assign("password",$_POST["password"]);
        $smarty->assign("email",$_POST["email"]);

    }
    else
    {
        $smarty->assign("username_exist",true);
    }
}


$smarty->assign("logged",$logged);
$smarty->display("registrazione.tpl.html");
include "db_close.php";
?>