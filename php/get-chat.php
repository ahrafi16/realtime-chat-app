<?php

session_start();

if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";


    $stmt = $conn->prepare("SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY msg_id ASC");
    $stmt->bind_param("iiii", $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
    $stmt->execute();
    $query = $stmt->get_result();

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $output .= '
                    <div class="chat outgoing">
                        <div class="details">
                            <p>' . $row['msg'] . '</p>
                        </div>
                    </div>';
            } else {
                $output .= '
                    <div class="chat incoming">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <p>' . $row['msg'] . '</p>
                        </div>
                    </div>';
            }
        }
        echo $output;
    }
} else {
    header("../login.php");
    exit();
}
