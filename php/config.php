<?php

$conn = mysqli_connect("localhost", "root", "anjum5801", "chat");

if (!$conn) {
    echo "Database connection failed !" . mysqli_connect_error();
}
