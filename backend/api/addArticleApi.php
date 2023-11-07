<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the article data from the request body and validate it
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate the data before using it in SQL query
    $title = isset($data["title"]) ? mysqli_real_escape_string($con, $data["title"]) : "";
    $category = isset($data["category"]) ? intval($data["category"]) : 0; // Ensure it's an integer
    $content = isset($data["content"]) ? mysqli_real_escape_string($con, $data["content"]) : "";

    // Check if required fields are present
    if (empty($title) || empty($category) || empty($content)) {
        echo json_encode(["error" => "Incomplete data provided"]);
    } else {
        // Prepare and execute the SQL query
        $date = date("Y-m-d");
        $sql = "INSERT INTO articles (titre, auteur, date_de_parution, type_article, contenu) VALUES ('$title', 1, '$date', $category, '$content')";

        if (mysqli_query($con, $sql)) {
            echo json_encode(["message" => "Article added successfully"]);
        } else {
            echo json_encode(["error" => "Failed to add the article"]);
        }
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

mysqli_close($con);
