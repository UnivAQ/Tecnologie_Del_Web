<?php
include "../lib.php";
checkSessione();
checkAdmin();

$smarty = includeSmarty();
$smarty->assign("logged", true);
$smarty->assign("admin", true);
$smarty->assign("username", $_SESSION["username"]);
?>
<?
// Modifica servizi
if (isset ($_POST["mod_servizi"]))
{
    $sql = "DELETE FROM gruppi_servizi where id_gruppo=".$_POST["id_gruppo"];
    mysql_query($sql) or die (mysql_error());

    for ($i=1; $i<=8; $i++)
    {
        if ($_POST[$i]=="on")
        {
            $sql = "INSERT INTO gruppi_servizi (id_gruppo, id_servizio) VALUES (".$_POST["id_gruppo"].", $i)";
            mysql_query($sql) or die (mysql_error());
        }
    }
}

// Aggiungi gruppo a utente
if (isset ($_POST["add_gruppo"]))
{
    $sql = "INSERT INTO gruppi (id_gruppo, nome) VALUES (null, '".$_POST["nome"]."')";
    mysql_query($sql) or die (mysql_error());
}

// Aggiungi nuovo gruppo
if (isset ($_POST["add_gruppo_utente"]))
{
    $sql = "SELECT * FROM utenti_gruppi where id_gruppo=".$_POST["id_gruppo"]." AND id_utente=".$_POST["id_utente"];
    $result = mysql_query($sql);
    if(mysql_num_rows($result)==0)
    {
        $sql = "INSERT INTO utenti_gruppi (id_utente, id_gruppo) VALUES ('".$_POST["id_utente"]."', '".$_POST["id_gruppo"]."')";
        mysql_query($sql) or die (mysql_error());
    }
}

// Delete utente da gruppo
if (isset ($_POST["del_gruppo_utente"]))
{
    $sql = "DELETE FROM utenti_gruppi where id_gruppo=".$_POST["id_gruppo"]." AND id_utente=".$_POST["id_utente"];
    mysql_query($sql) or die (mysql_error());
}

// Elimina macrocategoria
if (isset ($_GET["del_macro"]))
{
    $sql = "DELETE FROM macrocategorie where id_macrocategoria=".$_GET["id_macrocategoria"];
    mysql_query($sql) or die (mysql_error());
}

// Elimina categoria
if (isset ($_GET["del_cat"]))
{
    $sql = "DELETE FROM categorie where id_categoria=".$_GET["id_categoria"];
    mysql_query($sql) or die (mysql_error());
}

// Aggiungi macrocategoria
if (isset ($_POST["add_macro"]))
{
    $sql = "INSERT INTO macrocategorie (id_macrocategoria, nome) VALUES (null, '".$_POST["nome_macrocategoria"]."')";
    mysql_query($sql) or die (mysql_error());
}

// Aggiungi categoria
if (isset ($_POST["add_cat"]))
{
    $sql = "INSERT INTO categorie (id_categoria, nome) VALUES (null, '".$_POST["nome_categoria"]."')";
    mysql_query($sql) or die (mysql_error());
    $id = mysql_insert_id();

    $sql = "INSERT INTO cat_macrocat (id_macrocategoria, id_categoria) VALUES (".$_POST["id_macrocategoria"].", $id)";
    mysql_query($sql) or die (mysql_error());
}
// Stampa lista gruppi-servizi
$sql = "SELECT * FROM gruppi";
$result = mysql_query($sql);
if (mysql_num_rows($result)!=0)
{
    while ($resrow = mysql_fetch_object($result))
    {
        // SET nome gruppo
        $servizi[$resrow->id_gruppo]['nome']=$resrow->nome;
        $servizi[$resrow->id_gruppo]['id_gruppo']=$resrow->id_gruppo;

        // Inizializzazione servizi
        for ($i=2; $i<=8; $i++)
            $servizi[$resrow->id_gruppo][$i]=0;

        // SET servizi
        $sql2 = "SELECT * FROM gruppi_servizi WHERE id_gruppo=$resrow->id_gruppo";
        $result2 = mysql_query($sql2);
        while ($resrow2 = mysql_fetch_object($result2))
            $servizi[$resrow->id_gruppo][$resrow2->id_servizio]=1;

    }
}


$smarty->assign("servizi", $servizi);

// UTENTI

$i=0;
$sql = "SELECT * FROM utenti where id_utente>0";
$result = mysql_query($sql);
while ($resrow = mysql_fetch_object($result))
{
    $utenti[$i]=array('id_utente'=>$resrow->id_utente, 'username'=>$resrow->username, 'gruppi'=>array());

    $sql2 = "SELECT * FROM utenti_gruppi,gruppi WHERE utenti_gruppi.id_gruppo=gruppi.id_gruppo AND utenti_gruppi.id_utente=".$resrow->id_utente;
    $result2 = mysql_query($sql2);
    while ($resrow2 = mysql_fetch_object($result2))
        array_push($utenti[$i]['gruppi'], array("id_gruppo"=>$resrow2->id_gruppo, "nome_gruppo"=>$resrow2->nome));

    $i++;

}
$smarty->assign("utenti", $utenti);

// GRUPPI
$sql = "SELECT * FROM gruppi";
$result = mysql_query($sql);
while ($resrow = mysql_fetch_object($result))
    $gruppi[]=array('id_gruppo'=>$resrow->id_gruppo, 'nome_gruppo'=>$resrow->nome);

$smarty->assign("gruppi", $gruppi);


// CATEGORIE & MACROCATEGORIE
$sql = "SELECT * FROM macrocategorie";
$result = mysql_query($sql);
while ($row = mysql_fetch_object($result))
	$data[] = $row;
$i=0;
foreach ($data as $macrocategoria)
{
        $macrocat[$i]=array('nome_macrocategoria'=>$macrocategoria->nome, 'id_macrocategoria'=>$macrocategoria->id_macrocategoria,'sotto'=>array());
	$sql = "SELECT categorie.id_categoria,categorie.nome FROM macrocategorie,categorie,cat_macrocat WHERE macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND categorie.id_categoria=cat_macrocat.id_categoria AND macrocategorie.id_macrocategoria=".$macrocategoria->id_macrocategoria;
	$result = mysql_query($sql);
	while ($resrow = mysql_fetch_object($result))
            array_push($macrocat[$i]['sotto'],array('id_categoria'=> $resrow->id_categoria, 'nome_categoria'=> $resrow->nome));
        $i++;
}

$smarty->assign("macrocategorie",$macrocat);


$smarty->display("admin/index.tpl.html");
?>