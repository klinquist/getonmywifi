<?php
$lat = $_POST[lat];
$long = $_POST[long];
$accuracy = $_POST[accuracy];
$host = $_SERVER['HTTP_HOST'];
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>
	<head>
		<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width; initial-scale=.7; maximum-scale=1.0;"> 
	<link rel="stylesheet" type="text/css" href="../getonmywifi.css" />
		<title>GetOnMyWifi:  Generate a QR code to help others join your Wifi from an iOS device</title>
	</head>
	<body>
	
	
	
	



<?php

if($lat == ""){

?>

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
	postwith('',{lat:position.coords.latitude,long:position.coords.longitude,accuracy:position.coords.accuracy});
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


<?php }  ?>




<p class="indent">

<form class="form" method="post" action="../generate.php">
  
    <p class="email">  

        <input type="text" name="email" id="email" />  
        <label for="name">Your email (not required, but recommended!)</label>          
    </p>  
  
    <p class="said">  
        <input type="text" name="ssid" id="ssid" />  
        <label for="email">Your wireless network name (SSID)</label>  
    </p>  
    <p class="said">  
	    <label for="web">Is your network hidden?</label>
       <input type="checkbox" name="hidden" value="true" />  
    
    </p>  
  
    <p class="key">  
        <input type="text" name="encryptionkey" id="key" />  
        <label for="web">Your wireless password (leave blank for no encryption)</label>  
    </p>  

    <p class="geofence">  
        <label for="web">Geofence my QR code</label>
        <input type="checkbox" name="geofence" value="yes" /> 
              
    </p>
  
    <p class="key">  
        <input type="text" name="lat" id="key" value="<?php echo $lat;?>"/>  
        <label for="web">Latitude (for geofencing option)</label>  
    </p>  
    
    <p class="key">  
        <input type="text" name="long" id="key" value="<?php echo $long;?>"/>  
        <label for="web">Longitude (for geofencing option)</label>  
    </p>        	
  
	   <div id="button-box">
    		
    		
                <input type="submit" value="Generate Now" class="button">              
                        
        </div>
  
  
</form>  
        
        </p>
       
        
	</body>
</html>
