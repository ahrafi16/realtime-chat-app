<?php
include_once "config.php";
session_start();


// Get POST data and trim spaces
$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
$password = trim(mysqli_real_escape_string($conn, $_POST['password']));

if (!empty($email) && !empty($password)) {
    // Fetch user by email
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        // Verify password using password_verify
        if (password_verify($password, $row['password'])) {
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
        } else {
            echo "Email or Password is incorrect!";
        }
    } else {
        echo "Email or Password is incorrect!";
    }
} else {
    echo "All input fields are required!";
}
