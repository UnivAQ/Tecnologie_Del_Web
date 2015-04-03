<?php
include "lib.php";
$smarty = includeSmarty();
session_start();
session_regenerate_id(TRUE);
if (isset($_SESSION['username']) && isset($_SESSION['password'] ) ) {
    $logged=true;
    $id_utente = $_SESSION["id_utente"];
    $smarty->assign("username",$_SESSION["username"]);
}
else {
    $logged=false;
    $id_utente = -1;
}
$smarty->assign("username",$_SESSION["username"]);
$smarty->assign("logged",$logged);


if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);
$id_categoria = intval($_GET["id_categoria"]);

$sql = "SELECT categorie.nome AS nome_categoria, macrocategorie.nome AS nome_macrocategoria, macrocategorie.id_macrocategoria, categorie.id_categoria FROM categorie,macrocategorie,cat_macrocat WHERE categorie.id_categoria=cat_macrocat.id_categoria AND macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND categorie.id_categoria=".$id_categoria;
$result = mysql_query($sql);
$resrow = mysql_fetch_object($result);



$categoria=array('nome_macrocategoria'=>$resrow->nome_macrocategoria,'id_macrocategoria'=>$resrow->id_macrocategoria, 'nome_categoria'=>$resrow->nome_categoria,'id_categoria'=>$resrow->id_categoria,'prodotto'=>array());
$sql = "SELECT id_prodotto, titolo, descrizione FROM prodotti WHERE id_categoria=".$id_categoria;
$result = mysql_query($sql);
if (mysql_num_rows($result))
{
	while ($resrow = mysql_fetch_object($result))
	{
            array_push($categoria['prodotto'],array('id_prodotto'=> $resrow->id_prodotto, 'descrizione'=> substr($resrow->descrizione, 0 , 60),'titolo'=> utf8_encode($resrow->titolo)));
		//echo '<a href="prodotto.php?id_prodotto='.$resrow->id_prodotto.'">'.$resrow->titolo.'</a><br>';
	}
}


$smarty->assign("categoria",$categoria);

$smarty->display("sottocategorie.tpl.html");
include 'db_close.php';
?>