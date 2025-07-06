<?php
$host = 'localhost';
$user = 'root';
$pass = 'D@niel2004';
$db = 'lost_found_app';

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>