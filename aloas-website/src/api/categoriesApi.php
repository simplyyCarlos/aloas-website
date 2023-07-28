<?php 
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();
$sql = "SELECT * FROM types_articles;";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $json_array = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $json_array[] = $row;
    }

    echo json_encode($json_array);
} else {
    echo json_encode(array());
}

