<?php
while ($row = mysqli_fetch_assoc($sql)) {
    $stmt2 = $conn->prepare("SELECT * FROM messages WHERE (incoming_msg_id = ? OR outgoing_msg_id = ?) AND (outgoing_msg_id = ? OR incoming_msg_id = ?) ORDER BY msg_id DESC LIMIT 1");
    $stmt2->bind_param("iiii", $row['unique_id'], $row['unique_id'], $outgoing_id, $outgoing_id);
    $stmt2->execute();
    $query2 = $stmt2->get_result();

    if ($query2->num_rows > 0) {
        $row2 = $query2->fetch_assoc();
        $result = $row2['msg'];
        $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
    } else {
        $result = "No message available";
        $you = "";
    }

    // shorten long message
    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

    // check online/offline
    $offline = ($row['status'] == "Offline now") ? "offline" : "";

    $output .= '
                <a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '">
                        <i class="fa-solid fa-circle"></i>
                    </div>
                </a>
                ';

    $stmt2->close();
}
