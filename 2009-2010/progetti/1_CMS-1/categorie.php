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
else
{
    $smarty->assign("logged",false);
    $id_utente = -1;
}


if ($_SESSION["id_utente"]==0)
    $smarty->assign("admin",true);

$sql = "SELECT * FROM macrocategorie";
$result = mysql_query($sql);
while ($row = mysql_fetch_object($result))
	$data[] = $row;
$i=0;
foreach ($data as $macrocategoria)
{
        $macrocat[$i]=array('macro'=>$macrocategoria->nome,'sotto'=>array());
	$sql = "SELECT categorie.id_categoria,categorie.nome FROM macrocategorie,categorie,cat_macrocat WHERE macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND categorie.id_categoria=cat_macrocat.id_categoria AND macrocategorie.id_macrocategoria=".$macrocategoria->id_macrocategoria;
	$result = mysql_query($sql);
	while ($resrow = mysql_fetch_object($result))
            array_push($macrocat[$i]['sotto'],array('id_categoria'=> $resrow->id_categoria, 'nome'=> $resrow->nome));
        $i++;
}

$smarty->assign("macrocategorie",$macrocat);

$smarty->display("categorie.tpl.html");
include 'db_close.php';
?>