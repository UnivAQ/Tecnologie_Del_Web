<?

Class aux {
	
	function first_comma($id,$sep) {
	global $commas;
	
		if (!isset($commas[$id])) {
			$commas[$id] = true;
			return "";
		} else {
			return $sep;
		}
	}
}

Class panel {

  function grid($name,$data,$pars) {
  	
  	$content = "<table class=\"forms\">\n";
  	$first = true;
  	$groups_id_last = 0;
  	
  	foreach($data as $k => $v) {
  		
  	
  		if ($v['gruppo_id'] != $groups_id_last) {
  			$groups_id_last = $v['gruppo_id'];
  			$content .= aux::first_comma("table"," </tr>\n");
  			$content .= "<td colspan=\"19\" class=\"title\">{$v['gruppo_nome']}</td>";
  			$content .= " <tr>\n";
  		}

  		$content .= "<td class=\"sub\"><small>{$v['servizio_nome']}</small></td>";
  		if ($v['enabled']) {
  			$content .= "<td class=\"lateralborder\"><input type=checkbox name=\"c_{$v['gruppo_id']}_{$v['servizio_id']}\" value=\"*\" checked></td>\n";
  		} else {
  			$content .= "<td class=\"lateralborder\"><input type=checkbox name=\"c_{$v['gruppo_id']}_{$v['servizio_id']}\" value=\"*\"></td>\n";		
  		}

  		
  	}
  	
  	$content .= "</table>\n";
  	
  	
  	return $content; 	

  }
  
  
  

}


?>
