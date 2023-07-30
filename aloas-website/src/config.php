<?php 
$host = "149.202.51.120"; /* Host name */ 
$user = "Website"; /* User */ 
$password = ""; /* Password */ 
$dbname = "Aloas"; /* Database name */ 
$con = mysqli_connect($host, $user, $password,$dbname); 
// Check connection 
if (!$con) { 
   die("Connection failed: " . mysqli_connect_error()); 
}