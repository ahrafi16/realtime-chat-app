<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "$email - This email already exists!";
        } else {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_name = $_FILES['image']['name'];
                $type = $_FILES['image']['type'];
                $temp_name = $_FILES['image']['tmp_name'];

                $max_file_size = 5 * 1024 * 1024; // 5MB
                if ($_FILES['image']['size'] > $max_file_size) {
                    echo "File size too large. Maximum 5MB allowed.";
                    exit();
                }

                $img_explode = explode('.', $image_name);
                $img_ext = strtolower(end($img_explode));

                $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
                $extensions = ['png', 'jpg', 'jpeg'];

                if (in_array($_FILES['image']['type'], $allowed_types) && in_array($img_ext, $extensions)) {
                    $time = time();
                    $new_img_name = $time . '.' . $img_ext;

                    if (move_uploaded_file($temp_name, "images/" . $new_img_name)) {
                        $status = "Active now";
                        $random_id = rand(10000000, 99999999);
                        $enc_pass = password_hash($password, PASSWORD_DEFAULT);

                        $stmt2 = $conn->prepare("INSERT INTO users(unique_id, fname, lname, email, password, img, status) VALUES(?, ?, ?, ?, ?, ?, ?)");
                        $stmt2->bind_param("issssss", $random_id, $fname, $lname, $email, $enc_pass, $new_img_name, $status);
                        $result2 = $stmt2->execute();

                        if ($result2) {
                            $stmt3 = $conn->prepare("SELECT * FROM users WHERE email = ?");
                            $stmt3->bind_param("s", $email);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();
                            if ($result3->num_rows > 0) {
                                $row = $result3->fetch_assoc();
                                $_SESSION['unique_id'] = $row['unique_id'];
                                echo "success";
                            } else {
                                echo "Something went wrong while fetching user data!";
                            }
                        } else {
                            echo "Database error: " . $stmt2->error;
                        }
                    } else {
                        echo "Failed to upload image. Please try again.";
                    }
                } else {
                    echo "Please select a valid image file (jpeg, jpg, png)";
                }
            } else {
                echo "Please select an image file.";
            }
        }
    } else {
        echo "$email - This is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
