<?php
    // CODE TO GET PLACES OF INTREST FROM GEOPLUGIN
    require('geoplugin/geoplugin.class.php');
    $geoplugin = new geoPlugin();

    $nearby = $geoplugin->nearby();

if ( isset($nearby[0]['geoplugin_place']) ) {

	echo "<pre><p>Some places you may wish to visit near " . $geoplugin->city . ": </p>\n";

	foreach ( $nearby as $key => $array ) {
		
		echo ($key + 1) .":<br />";
		echo "\t Place: " . $array['geoplugin_place'] . "<br />";
		echo "\t Region: " . $array['geoplugin_region'] . "<br />";
		echo "\t Latitude: " . $array['geoplugin_latitude'] . "<br />";
		echo "\t Longitude: " . $array['geoplugin_longitude'] . "<br />";
	}
	echo "</pre>\n";
}

?>