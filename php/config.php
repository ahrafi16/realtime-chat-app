<?php

$conn = mysqli_connect("localhost", "root", "anjum5801", "chat");

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Connection failed. Please try again later.");
}

mysqli_set_charset($conn, "utf8"); 
