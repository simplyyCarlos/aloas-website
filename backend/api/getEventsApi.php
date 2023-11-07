<?php
include_once("../config.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Use prepared statements for security
    $sql = "SELECT id, eventName, eventStartDate, eventEndDate, eventIsAllDay, eventIsRepeatedWeekly, eventLocation, eventDescription FROM events";
    
    $events = array();
    if ($stmt = mysqli_prepare($con, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = $row;
            }
            mysqli_free_result($result);
        } else {
            echo json_encode(array("error" => "Error executing the query"));
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("error" => "Prepared statement error"));
    }

    mysqli_close($con);

    // Return the events as JSON
    echo json_encode($events);
} else {
    echo json_encode(array("error" => "Invalid request method"));
}
