<?php
$servername="192.168.0.8";
$port='8185';
$baseurl="192.168.0.8:".$port."";
$username = "root";
$password = "root";
$dbname = "salesforce_new";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>