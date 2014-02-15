<?php

if ( !$close_session ) {
	$_SESSION["user"] = serialize($user);
	$_SESSION["authn"] = serialize($authn);
	$_SESSION["authz"] = serialize($authz);
	$_SESSION["groups"] = serialize($groups);
	
	session_write_close();
}
else {
	unset($_SESSION["user"]);
	unset($_SESSION["authn"]);
	unset($_SESSION["authz"]);
	unset($_SESSION["groups"]);
	
	session_destroy();
}

?>