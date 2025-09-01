<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exists!";
        } else {
            if (isset($_FILES['image'])) {
                $image_name  = $_FILES['image']['name'];
                $type  = $_FILES['image']['type'];
                $temp_name  = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $image_name);
                $img_ext = strtolower(end($img_explode));

                $extensions = ['png', 'jpg', 'jpeg'];
                if (in_array($img_ext, $extensions)) {
                    $time = time();
                    $new_img_name = $time . '.' . $img_ext;

                    if (move_uploaded_file($temp_name, "images/" . $new_img_name)) {
                        $status = "Active now";
                        $random_id = rand(10000000, 99999999); 
                        $enc_pass = password_hash($password, PASSWORD_DEFAULT); 

                        $sql2 = mysqli_query($conn, "INSERT INTO users(unique_id, fname, lname, email, password, img, status) 
                            VALUES({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$enc_pass}', '{$new_img_name}', '{$status}')");

                        if ($sql2) {
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id'];
                                echo "success"; 
                            }
                        } else {
                            echo "Something went wrong!";
                        }
                    }
                } else {
                    echo "Please select an image file (jpeg, jpg, png)";
                }
            } else {
                echo "Please select an image";
            }
        }
    } else {
        echo "$email - This is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
