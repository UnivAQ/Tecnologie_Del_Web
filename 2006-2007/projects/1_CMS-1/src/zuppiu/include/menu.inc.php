<?

Class Menu {
	
	function setMenu() {
		global $main;
		
		if ($_SESSION['user']){
			$admin = new Template("dtml/adminLogged.html");
		} else {
			$admin = new Template("dtml/adminNotLogged.html");
		}
		$main->setContent("loginform", $admin->get() );
	}
	
}

?>