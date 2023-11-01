<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $eventName = isset($data["eventName"]) ? mysqli_real_escape_string($con, $data["eventName"]) : "";
    $eventIsAllDay = isset($data["eventIsAllDay"]) ? intval($data["eventIsAllDay"]) : 0; 
    $eventIsRepeatedWeekly = isset($data["eventIsRepeatedWeekly"]) ? intval($data["eventIsRepeatedWeekly"]) : 0; 
    // log in console end and start date 
    $eventStartDate = isset($data["eventStartDate"]) ? mysqli_real_escape_string($con, $data["eventStartDate"]) : "";
    $eventEndDate = isset($data["eventEndDate"]) ? mysqli_real_escape_string($con, $data["eventEndDate"]) : "";
    

    // create a hardcoded dates for testing

    $eventLocation = isset($data["eventLocation"]) ? mysqli_real_escape_string($con, $data["eventLocation"]) : "";
    $eventDescription = isset($data["eventDescription"]) ? mysqli_real_escape_string($con, $data["eventDescription"]) : "";
    $sql = "INSERT INTO events (eventName, eventStartDate, eventEndDate, eventIsAllDay, eventIsRepeatedWeekly, eventLocation, eventDescription) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssiiss", $eventName, $eventStartDate, $eventEndDate, $eventIsAllDay, $eventIsRepeatedWeekly, $eventLocation, $eventDescription);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array("message" => "Event inserted successfully"));
        } else {
            echo json_encode(array("error" => "Error inserting event"));
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("error" => "Prepared statement error"));
    }
    mysqli_close($con);
    } else {
        echo json_encode(array("error" => "Invalid request method"));
    }
