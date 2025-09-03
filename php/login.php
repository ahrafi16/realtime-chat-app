
<?php
session_start();

if (isset($_SESSION['unique_id'])) {
    header("location: users.php");
}
?>


<?php
include_once "config.php";

// Get POST data and trim spaces
$email = trim(mysqli_real_escape_string($conn, $_POST['email']));
$password = trim(mysqli_real_escape_string($conn, $_POST['password']));

if (!empty($email) && !empty($password)) {
    // Fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $sql = $result;

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $status = "Active Now";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            } else {
                echo "Something went wrong!";
            }
        } else {
            echo "Email or Password is incorrect!";
        }
    } else {
        echo "Email or Password is incorrect!";
    }
} else {
    echo "All input fields are required!";
}
