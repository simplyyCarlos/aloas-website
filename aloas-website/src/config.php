<?php 
$host = "149.202.51.120"; /* Host name */ 
$user = "Website"; /* User */ 
$password = ""; /* Password */ 
$dbname = "Aloas"; /* Database name */ 
try {
    $con = mysqli_connect($host, $user, $password,$dbname);
    //echo "Connected to $dbname at $host successfully.";   
}catch (mysqli_sql_exception $e) {
      echo $e->getMessage();    
}
// Check connection 
if (!$con) { 
   die("Connection failed: " . mysqli_connect_error()); 
}