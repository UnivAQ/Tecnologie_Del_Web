var on_off=new Array();
var menu_code=new Array();

<?
include "lib.php";

$sql = "SELECT * FROM macrocategorie";
$result = mysql_query($sql);
while ($row = mysql_fetch_object($result))
    $data[] = $row;
$i=0;
foreach ($data as $macrocategoria)
{
    echo 'document.write(\'<h3><a href="javascript:void(0)" style="text-decoration:none" onClick="collapse_menu(menu'.($i+1).', '.$i.'); return false"><b>+ '.$macrocategoria->nome.'</b></a></h3><span id="menu'.($i+1).'"></span>\');';
    echo "\n";

    $sql = "SELECT categorie.id_categoria,categorie.nome FROM macrocategorie,categorie,cat_macrocat WHERE macrocategorie.id_macrocategoria=cat_macrocat.id_macrocategoria AND categorie.id_categoria=cat_macrocat.id_categoria AND macrocategorie.id_macrocategoria=".$macrocategoria->id_macrocategoria;
    $result = mysql_query($sql);
    while ($resrow = mysql_fetch_object($result))
        $categorie.="&nbsp;&nbsp;&nbsp;- <a href=\'http://www.tdw.lan/sottocategorie.php?id_categoria=$resrow->id_categoria\'>$resrow->nome</a><br />";

    echo 'menu_code['.$i.']="'.$categorie.'";';
    echo "\n";
    $i++;
    $categorie="";
}


?>


number_of_menus=<? echo $i; ?>;
for (loop=0; loop<number_of_menus; loop++){
    on_off[loop]=0;
    }

    function collapse_menu(menu_id, menu_number){
    if (on_off[menu_number]==0){
    menu_id.innerHTML=menu_code[menu_number];
    on_off[menu_number]=1;
    }else{
    menu_id.innerHTML="";
    on_off[menu_number]=0;
    }
    }
