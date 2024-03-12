<?php
// CONVERT DATETIME FROM DB
function convertDateToField($datetime)
{
    // $datetime contains the datetime value from the database
    // $datetime = "2024-03-10 00:00:00";

    // Create a DateTime object with the given datetime value
    $date = new DateTime($datetime);

    // Format the date as "Y-m-d"
    $formattedDate = $date->format("Y-m-d");

    // Output the formatted date
    return $formattedDate;
}