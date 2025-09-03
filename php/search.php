<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";
$searchTerm = "%{$searchTerm}%";
$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id != ? AND (fname LIKE ? OR lname LIKE ?)");
$stmt->bind_param("iss", $outgoing_id, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$sql = $result;
if (mysqli_num_rows($sql) > 0) {
    include "data.php";
} else {
    $output .= "No users found to your search term";
}
echo $output;
