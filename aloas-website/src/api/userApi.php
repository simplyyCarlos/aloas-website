<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    // Read raw POST data
    $post_data = json_decode(file_get_contents('php://input'), true);

    // Extract data from the POST request
    $nom = mysqli_real_escape_string($con, $post_data["nom"]);
    $prenom = mysqli_real_escape_string($con, $post_data["prenom"]);
    $email = mysqli_real_escape_string($con, $post_data["email"]);
    $password = mysqli_real_escape_string($con, $post_data["password"]);

    $sql = "SELECT * FROM utilisateurs WHERE mail = '$email'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        http_response_code(201);
        echo json_encode(["error" => "Email already exists"]);
    } else {
        $sql = "INSERT INTO utilisateurs (nom, prenom, mail, mot_de_passe) VALUES ('$nom', '$prenom', '$email', '$password')";
        $result = mysqli_query($con, $sql);
        if($result){
            http_response_code(200);
            echo json_encode(["success" => "User created successfully"]);
        } else {
            http_response_code(202);
            echo json_encode(["error" => "Something went wrong"]);
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $email = mysqli_real_escape_string($con, $_GET["email"]);
    echo($_GET["email"]);
    $password = mysqli_real_escape_string($con, $_GET["password"]);
    echo($_GET["password"]);

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