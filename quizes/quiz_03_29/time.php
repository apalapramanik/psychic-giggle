<?php
// Generate current time in HH:MM:SS format
$current_time = date("H:i:s");

// Return the current time as a JSON object
echo json_encode(array("time" => $current_time));
?>
