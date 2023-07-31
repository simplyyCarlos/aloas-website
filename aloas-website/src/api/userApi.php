<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $nom = mysqli_real_escape_string($con, $data["nom"]);
    $prenom = mysqli_real_escape_string($con, $data["prenom"]);
    $email = mysqli_real_escape_string($con, $data["email"]);
    $password = mysqli_real_escape_string($con, $data["password"]);

    $sql = "SELECT * FROM utilisateurs WHERE mail = '$email'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo json_encode(["error" => "Email already exists"]);
    } else {
        $sql = "INSERT INTO utilisateurs (nom, prenom, mail, mot_de_passe) VALUES ('$nom', '$prenom', '$email', '$password')";

        if (mysqli_query($con, $sql)) {
            echo json_encode(["message" => "User added successfully"]);
        } else {
            echo json_encode(["error" => "Failed to add the user"]);
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
        http_response_code(401);
        echo json_encode(["error" => "Invalid email or password"]);
    }
}