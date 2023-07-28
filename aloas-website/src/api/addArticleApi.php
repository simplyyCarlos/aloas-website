<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();
// ... (existing code to establish database connection)

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the article data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Sanitize and validate the data (if needed)

    // Insert the article data into the database
    $title = mysqli_real_escape_string($con, $data["title"]);
    $category = mysqli_real_escape_string($con, $data["category"]);
    $content = mysqli_real_escape_string($con, $data["content"]);
    $date = date("Y-m-d");

    $sql = "INSERT INTO articles (titre, category, content) VALUES ('$title', '$category', '$content')";

    if (mysqli_query($con, $sql)) {
        // Return a success message (optional)
        echo json_encode(["message" => "Article added successfully"]);
    } else {
        // Return an error message (optional)
        echo json_encode(["error" => "Failed to add the article"]);
    }
}

mysqli_close($con);
