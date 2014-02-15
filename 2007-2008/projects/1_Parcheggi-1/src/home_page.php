<?php

try {
	$database->setQuery("SELECT titolo,corpo,data FROM Annuncio WHERE moderato = false ORDER BY data DESC LIMIT 5");
	$database->query();
}
catch ( Exception $e ) {
	die("FATAL ERROR: " . $e->getMessage());
}

$annunci_array = array();
	
for ( $i = 0; $i < $database->getResultsNumber(); $i++ ) {
	$temp = $database->getData();
	$annunci_array[] = array("titolo" => string_soil($temp->titolo), "corpo" => string_soil($temp->corpo), "data" => string_soil($temp->data));
}

try {
	$database->setQuery("SELECT lat, lon FROM Indirizzo WHERE (lat != 0 AND lon != 0)");
	$database->query();
}
catch ( Exception $e ) {
	die("FATAL ERROR: " . $e->getMessage());
}

$latlon_array = array();

for ($i = 0; $i < $database->getResultsNumber(); $i++ ) {
	$temp = $database->getData();
	$latlon_array[] = array("lat" => string_soil($temp->lat), "lon" => string_soil($temp->lon));
}

$temp = $latlon_array[array_rand($latlon_array)];

$page->assign("lat", $temp["lat"]);
$page->assign("lon", $temp["lon"]);
$page->assign("home_page", true);

if ( count($annunci_array) > 0 ) { 
	$page->assign("annunci", true);
	$page->assign("annunci_array", $annunci_array);
}
else {
	$page->assign("annunci", false);
}

if ( ! $authn->isAuthn() ) {
	$close_session = true;
}

?>