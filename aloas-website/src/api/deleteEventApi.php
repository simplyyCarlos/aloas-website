<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $eventID = isset($data["eventId"]) ? intval($data["eventId"]) : 0;
    
    if ($eventID > 0) {
        // Perform the event deletion
        $sql = "DELETE FROM events WHERE id = ?";
        
        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $eventID);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(array("message" => "Event deleted successfully"));
            } else {
                echo json_encode(array("error" => "Error deleting event"));
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(array("error" => "Prepared statement error"));
        }
    } else {
        echo json_encode(array("error" => "Invalid event ID"));
    }
    mysqli_close($con);
} else {
    echo json_encode(array("error" => "Invalid request method"));
}
