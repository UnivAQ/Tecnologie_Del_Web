<?
include "lib.php";
$username=$_POST["username"];
$password=$_POST["password"];
session_start();
session_regenerate_id(TRUE);

$smarty = includeSmarty();

if (isset($username) && isset($password))
{
	$sql="SELECT id_utente FROM utenti where username='".mysql_real_escape_string($username)."' AND PASSWORD='".mysql_real_escape_string(md5($password))."'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)) 
	{
		$resrow = mysql_fetch_array($result);
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['id_utente'] = $resrow["id_utente"];
	} 
	else 
	{
	  $smarty->assign("logged",false);
	}
	header('location: index.php');
}
else
{
    $smarty->assign("logged",false);
}

$smarty->display("login.tpl.html");
include "db_close.php";
?>