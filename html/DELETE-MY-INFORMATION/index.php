<?php
include('../functions.php');
sqlconnect();


$delete = $_GET[delete];

$key = $_GET[key];
$i = 0;
$result = mysql_query("SELECT * FROM getonmywifi WHERE `hash` = '$delete' AND `hashkey` = '$key'") or die("Error: " . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$i++;
}

if ($i == "0") { 


?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>
	<head>
	<link rel="stylesheet" type="text/css" href="../getonmywifi.css" />
		<title>GetOnMyWifi:  Generate a QR code to help others join your Wifi from an iOS device</title>
	</head>
	<body>

	<h3>Entry does not exist.

    </h3>  
    <h2><a href="/">Back</a></h2>  
	</body>
</html>




<?php

 } else {


$result = mysql_query("DELETE FROM getonmywifi WHERE `hash` = '$delete'  AND  `hashkey` = '$key'") or die("Error: " . mysql_error());
$deletefile = "../qrc/" . $delete . "_" . $hashkey . ".png";
unlink($deletefile);



?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>
	<head>
	<link rel="stylesheet" type="text/css" href="../getonmywifi.css" />
		<title>GetOnMyWifi:  Generate a QR code to help others join your Wifi from an iOS device</title>
	</head>
	<body>

	<h3>Your information has been deleted.

    </h3>  
    <h2><a href="/">Back</a></h2>  
	</body>
</html>

<?php

}


?>