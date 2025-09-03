<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

    if (isset($logout_id) && !empty($logout_id)) {
        $status = "Offline now";
        $stmt = $conn->prepare("UPDATE users SET status = ? WHERE unique_id = ?");
        $stmt->bind_param("si", $status, $logout_id);
        $result = $stmt->execute();

        if ($result) {
            session_unset();
            session_destroy();
            header("location: ../login.php");
            exit();
        } else {
            echo "Error updating status: " . $stmt->error;
        }
    } else {
        header("location: ../users.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}
