<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
//$servername = "103.206.248.235";
  if($_SERVER['HTTP_HOST']=='localhost'){
    /*************************LOCAL DETAILS***********************************/
$servername="61.246.34.205";
//$baseurl="61.246.34.205";
$port='15000';
$baseurl="157.119.91.195:".$port."";
$username = "sales";
$password = "sales";
$dbname = "salesforce_new";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    /******************************END LOCALS DETAIL**************************/
}
else{
$servername="61.246.34.205";
//$baseurl="61.246.34.205";
$port='15000';
$baseurl="157.119.91.195:".$port."";
//$baseurl="103.206.248.235:".$port."";

$username = "root";
$password = "root";
$dbname = "salesforce_new";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  }



?>