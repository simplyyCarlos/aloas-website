<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $email = mysqli_real_escape_string($con, $_GET["email"]);
    $password = mysqli_real_escape_string($con, $_GET["password"]);

    $sql = "SELECT * FROM utilisateurs WHERE mail = '$email' AND mot_de_passe = '$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        http_response_code(200);
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user"] = $row;
        echo json_encode($row);
    } else {
        http_response_code(201);
        echo json_encode(["error" => "Invalid email or password"]);
    }
}