<?php

session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id != ?");
$stmt->bind_param("i", $outgoing_id);
$stmt->execute();
$result = $stmt->get_result();
$sql = $result;
$output = "";

if (mysqli_num_rows($sql) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($sql) > 0) {
    include "data.php";
}
echo $output;
