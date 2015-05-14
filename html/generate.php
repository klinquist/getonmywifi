<?php
include('phpqrcode/qrlib.php');
include('functions.php');

$email = $_POST[email];
$ssid = $_POST[ssid];
$key = $_POST[encryptionkey];
$geofence = $_POST[geofence];
$hidden = $_POST[hidden];
$lat = $_POST[lat];
$long = $_POST[long];

if ($geofence == "") { $lat = ""; $long = ""; }
if ($hidden == "") {$hidden = "false";}
if ($ssid == "") { die("No SSID specified."); }

$hash = generatehash();
$hashkey = generatehash();
sqlconnect();

$url = "http://www.getonmywifi.com/d/" . $hash;
$tempfile = "http://www.getonmywifi.com/qrc/" . $hash . "_" . $hashkey . ".png";
$localfile = "qrc/" . $hash . "_" . $hashkey . ".png";

QRcode::png($url, $localfile, 'M', 8, 2);

//QRcode::png('http://www.getonmywifi.com', 'qrc/holla.png', 'M', 8, 2);

$ip = $_SERVER['REMOTE_ADDR']; 
$result = mysql_query("INSERT INTO getonmywifi VALUES ('', '$hash', '$hashkey', '$email', '$ssid', '$hidden', '$key', '$lat', '$long', '$ip', now(), '' )") or die("Error: " . mysql_error());
  // <body onload="javascript:window.print()">

if ($email != "") {
	$body = "Thank you for trying out GetOnMyWifi!\n\nHere is a link to your QR code:\n" . $tempfile . "\n\nIf you wish to remove your network information from our database, it can be done with a single click:\nhttp://www.getonmywifi.com/DELETE-MY-INFORMATION/" . $hash . "_" . $hashkey . "\n\nThanks,\nKris Linquist, creator of GetOnMyWifi.com";

	sendemail($email, "GetOnMyWifi access", $body);
}



?>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>
	<head>
	<link rel="stylesheet" type="text/css" href="qrcodepage.css" />
		<title>GetOnMyWifi:  Generate a QR code to help others join your Wifi from an iOS device</title>
	</head>
	
	<center><h2><a href="javascript:window.print()">print</a></h2><br><br><Br>
Scan this QR code with RedLaser(™) on your iOS device to join my wifi<Br>
	<img src="<?php echo "$tempfile"; ?>"><br>
	ssid: <?php echo "$ssid"; ?><br><br>
http://www.getonmywifi.com/
	</center>
	
	  
	</body>
</html>
