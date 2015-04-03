<?php
include "lib.php";
$smarty = includeSmarty();
	session_start();
	session_regenerate_id(TRUE);

if (isset($_SESSION['username']) && isset($_SESSION['password'] ) )
{
    $logged=true;
    $id_utente = $_SESSION["id_utente"];
}
else
{
    $logged=false;
    $id_utente = -1;
}
$smarty->assign("logged",$logged);
$smarty->assign("username",$_SESSION["username"]);
if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

$id_macrocategoria = intval($_GET["id_macrocategoria"]);
$sql = "SELECT nome FROM macrocategorie WHERE id_macrocategoria=".$id_macrocategoria;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);
$macrocat=array('id_macrocategoria'=>$id_macrocategoria, 'nome_macrocategoria'=>$resrow->nome, 'categorie'=>array());

$sql = "SELECT categorie.id_categoria as id_categoria, categorie.nome as nome_categoria FROM macrocategorie, cat_macrocat, categorie WHERE macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND cat_macrocat.id_categoria=categorie.id_categoria AND macrocategorie.id_macrocategoria=".$id_macrocategoria;
$result = mysql_query($sql);
while ($resrow = mysql_fetch_object($result))
    array_push($macrocat['categorie'],array('id_categoria'=> $resrow->id_categoria, 'nome_categoria'=> $resrow->nome_categoria));

//    $macrocategoria=array('id_categoria'=> $resrow->id_categoria, 'nome_categoria'=> $resrow->nome_categoria);
//

$smarty->assign("macro",$macrocat);

$smarty->display("macrocategorie.tpl.html");
include 'db_close.php';
?>