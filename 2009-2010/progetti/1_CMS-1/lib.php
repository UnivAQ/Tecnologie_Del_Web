<?php
include "config.inc.php";

function TagliaStringa($stringa, $max_char){
		if(strlen($stringa)>$max_char){
			$stringa_tagliata=substr($stringa, 0,$max_char);
			$last_space=strrpos($stringa_tagliata," ");
			$stringa_ok=substr($stringa_tagliata, 0,$last_space);
			return $stringa_ok."...";
		}else{
			return $stringa;
		}
	}

function includeSmarty()
{
    require $_SERVER['DOCUMENT_ROOT'].'smarty/Smarty.class.php';
    $smarty = new Smarty;
    $smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'template/';
    $smarty->config_dir = $_SERVER['DOCUMENT_ROOT'].'smarty/configs';
    $smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'smarty/templates_c';
    $smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'].'smarty/cache';
    return $smarty;
}

function checkServizio($id_servizio, $id_utente)
{
    // Controllo admin
    if ($id_utente==0)
        return true;
    
    $sql = "SELECT COUNT(*) FROM servizi, utenti, gruppi, utenti_gruppi, gruppi_servizi WHERE utenti.id_utente=utenti_gruppi.id_utente AND utenti_gruppi.id_gruppo=gruppi.id_gruppo AND gruppi_servizi.id_gruppo = gruppi.id_gruppo AND gruppi_servizi.id_servizio=servizi.id_servizio AND servizi.id_servizio=$id_servizio AND utenti.id_utente=$id_utente";
    $result = mysql_query($sql);
    $resrow = mysql_fetch_row($result);
    if ($resrow[0]!=0)
            return true;
    else
            return false;
}

function checkSessione()
{
	session_start();
	session_regenerate_id(TRUE);
	if (!isset($_SESSION['username'] ) and !isset($_SESSION['password'] ) )
	{
		header('location: /login.php');
		exit;
	}
}

function checkAdmin()
{
    if ($_SESSION['username'] == "admin")
        return true;
    else
        makePermissionError(0);
}

function makePermissionError($id_servizio)
{
    header('location: /error.php?id='.$id_servizio);
    exit;
}

function array_push_assoc($array, $key, $value){
 $array[$key] = $value;
 return $array;
}
?>
