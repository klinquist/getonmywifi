<?php
include('../functions.php');
$mc = $_GET[mc];
$hashkey = $_GET[hashkey];
$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$total = $iPod + $iPhone + $iPad;

if ($mc == "") {die("Sorry, malformed URL");}

sqlconnect();

$result = mysql_query("SELECT * FROM getonmywifi WHERE `hash` LIKE '$mc' AND `hashkey` = '$hashkey'") or die("Error: " . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
     $ssid = $row[4];
     $key = $row[6];
     $hidden = $row[5];
}


if ($ssid == "") {die("Sorry, URL not found");}
if ($total == "0") { die("Sorry, this page can only be viewed from an iOS device.");}


//echo "UPDATE getonmywifi SET `lastaccessedon` = 'now()' WHERE `hash` = '$mc' AND `hashkey`  = '$hashkey'";

mysql_query("UPDATE getonmywifi SET `lastaccessedon` = now() WHERE `hash` = '$mc' AND `hashkey`  = '$hashkey'");




header("Content-type: application/x-apple-aspen-config; chatset=utf-8");
header("Content-Disposition: attachment; filename=\"getonmywifi.mobileconfig\"");

$mobileconfig = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<!DOCTYPE plist PUBLIC \"-//Apple//DTD PLIST 1.0//EN\" \"http://www.apple.com/DTDs/PropertyList-1.0.dtd\">
<plist version=\"1.0\">
<dict>
	<key>PayloadContent</key>
	<array>
		<dict>
			<key>EncryptionType</key>
			<string>Any</string>
			<key>HIDDEN_NETWORK</key>
			<" . $hidden . "/>
			<key>Password</key>
			<string>" . $key . "</string>
			<key>PayloadDescription</key>
			<string>Configures wireless connectivity settings.</string>
			<key>PayloadDisplayName</key>
			<string>Wi-Fi (" . $ssid . ")</string>
			<key>PayloadIdentifier</key>
			<string>com.getonmywifi.wifi</string>
			<key>PayloadOrganization</key>
			<string></string>
			<key>PayloadType</key>
			<string>com.apple.wifi.managed</string>
			<key>PayloadUUID</key>
			<string>F68D18C8-23A2-413B-A2AF-65F43E970B4C</string>
			<key>PayloadVersion</key>
			<integer>1</integer>
			<key>SSID_STR</key>
			<string>" . $ssid . "</string>
		</dict>
	</array>
	<key>PayloadDescription</key>
	<string>Profile to auto-connect to the wifi network " . $ssid . "</string>
	<key>PayloadDisplayName</key>
	<string>GetOnMyWifi: " . $ssid . "</string>
	<key>PayloadIdentifier</key>
	<string>com.getonmywifi</string>
	<key>PayloadOrganization</key>
	<string></string>
	<key>PayloadRemovalDisallowed</key>
	<false/>
	<key>PayloadType</key>
	<string>Configuration</string>
	<key>PayloadUUID</key>
	<string>C5D1927E-C4AA-4FAD-8A1C-D816D3D573F2</string>
	<key>PayloadVersion</key>
	<integer>1</integer>
</dict>
</plist>";
echo $mobileconfig;
?>


