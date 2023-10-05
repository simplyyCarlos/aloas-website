<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the event data from the request body and validate it
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate the data before using it in SQL query
    $eventName = isset($data["eventName"]) ? mysqli_real_escape_string($con, $data["eventName"]) : "";
    $eventStartDate = isset($data["eventStartDate"]) ? mysqli_real_escape_string($con, $data["eventStartDate"]) : "";
    $eventEndDate = isset($data["eventEndDate"]) ? mysqli_real_escape_string($con, $data["eventEndDate"]) : "";
    $isAllDay = isset($data["isAllDay"]) ? intval($data["isAllDay"]) : 0; // Ensure it's an integer (0 or 1)
    $isRepeatedWeekly = isset($data["isRepeatedWeekly"]) ? intval($data["isRepeatedWeekly"]) : 0; // Ensure it's an integer (0 or 1)
    $eventStartTime = isset($data["eventStartTime"]) ? mysqli_real_escape_string($con, $data["eventStartTime"]) : "";
    $eventStopTime = isset($data["eventStopTime"]) ? mysqli_real_escape_string($con, $data["eventStopTime"]) : "";
    $eventDescription = isset($data["eventDescription"]) ? mysqli_real_escape_string($con, $data["eventDescription"]) : "";

    // Check if required fields are present
    if (empty($eventName) || empty($eventStartDate) || empty($eventEndDate)) {
        echo json_encode(["error" => "Incomplete data provided"]);
    } else {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO events (event_name, start_date, end_date, is_all_day, is_repeated_weekly, start_time, stop_time, description)
                VALUES ('$eventName', '$eventStartDate', '$eventEndDate', $isAllDay, $isRepeatedWeekly, '$eventStartTime', '$eventStopTime', '$eventDescription')";

        if (mysqli_query($con, $sql)) {
            echo json_encode(["message" => "Event added successfully"]);
        } else {
            echo json_encode(["error" => "Failed to add the event"]);
        }
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

mysqli_close($con);
