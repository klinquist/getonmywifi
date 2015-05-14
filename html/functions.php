<?
function sqlconnect()
{
    $dbhost="xxxx";           //database host
    $dbuser="xxxx";            //database username
    $dbpassword="xxx";        //database password
    $dbname="xxxx";            //database name
    $db = mysql_connect($dbhost,$dbuser,$dbpassword) or die("Couldn't connect to the database.");
    mysql_select_db($dbname) or die("Couldn't select the database");
}
function generatehash()
{
// *************************
// Random Password Generator
// *************************
    $totalChar = 9; // number of chars in the password
    $salt = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";  // salt to select chars from
    srand((double)microtime()*1000000); // start the random generator
    $password=""; // set the inital variable
    for ($i=0;$i<$totalChar;$i++)  // loop and create password
    $password = $password . substr ($salt, rand() % strlen($salt), 1);
    return $password;
}
function sendemail($emailto, $emailsubject, $emailbody) {
    $mailfromname="YourName";
    $contactemail="YourEmail";
    $eol="\n";
    $mime_boundary=md5(time());
    $headers = 'From: ' . $mailfromname . ' <'. $contactemail . '>'.$eol . 'Reply-To: ' . $mailfromname . ' <'. $contactemail . '>'.$eol.'Return-Path: ' . $mailfromname . ' <'. $contactemail . '>'.$eol."X-Mailer: PHP v".phpversion().$eol.'MIME-Version: 1.0'.$eol;
    $msg .= $emailbody . $eol;
    mail($emailto, $emailsubject, $msg, $headers);
}
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
?>
