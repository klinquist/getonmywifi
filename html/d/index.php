<?php
include('../functions.php');
$mc = $_GET[mc];
if ($mc == "") { $mc = $_POST[mc]; $hashkey = $_POST[hashkey]; }
$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$total = $iPod + $iPhone + $iPad;
$lat = $_POST[lat];
$long = $_POST[long];

if ($mc == "") {die("Sorry, malformed URL");}

sqlconnect();

$result = mysql_query("SELECT * FROM getonmywifi WHERE `hash` LIKE '$mc'") or die("Error: " . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	 $ssid = $row[4];
	 $hashkey = $row[2];
     $geolat= $row[7];
     $geolong = $row[8];
}



if ($ssid == "") {die("Sorry, URL not found");}
if ($total == "0") { die("Sorry, this page can only be viewed from an iOS device.");}


if ($geolat == "") {
	$location = "Location: http://www.getonmywifi.com/d/send.php?mc=" . $mc . "&hashkey=" . $hashkey;
 	header( $location ) ;
} else {


	if ($lat == "") {


	?>

		<html><body>
		<script type="text/javascript">
		// Javascript POST function
		function postwith (to,p) {
		  var myForm = document.createElement("form");
		  myForm.method="post" ;
		  myForm.action = to ;
		  for (var k in p) {
		    var myInput = document.createElement("input") ;
		    myInput.setAttribute("name", k) ;
		    myInput.setAttribute("value", p[k]);
		    myForm.appendChild(myInput) ;
		  }
		  document.body.appendChild(myForm) ;
		  myForm.submit() ;
		  document.body.removeChild(myForm) ;
		}


		//Javascript Geolocation function
		function foundLocation(position)
		{
			postwith('',{lat:position.coords.latitude,long:position.coords.longitude,accuracy:position.coords.accuracy,mc:"<?php echo $mc;?>",hashkey:"<?php echo $hashkey;?>"});
		}

		//Post $lat = "nonegiven"  if user does not want to share their location
		function noLocation()
		{
		  postwith('', {lat:'nonegiven'});
		}

		//Post $lat = "unsupported"  if the user's browser does not support it.
		function unSupported()
		{
		  postwith('', {lat:'unsupported'});
		}

		//Only attempt to find location if browser supports it
		if (navigator.geolocation) {
		      navigator.geolocation.getCurrentPosition(foundLocation, noLocation);

		} else {

		  	unSupported();

		}

		</script>

		<?php

 	} else {


			if ($lat == "nonegiven") { die("Your location required to add wifi network. Please enable location services for Safari on your iOS device"); }
			if ($lat == "unsupported") { die("Your location required to add wifi network. Please enable location services for Safari on your iOS device"); }

			$dist = round(distance($lat, $long, $geolat, $geolong, "m"),2);

			if ($dist > .5) {  die ("Sorry, you are too far away from the network to add the profile.");} else {

				$location = "Location: http://www.getonmywifi.com/d/send.php?mc=" . $mc . "&hashkey=" . $hashkey;
			 	header( $location ) ;


	}



	}


}





?>
