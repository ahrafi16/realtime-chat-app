<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location:login.php");
    exit();
}
?>



<?php include_once "header.php" ?>


<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "php/config.php";
                $user_id = (int)$_GET['user_id']; // Cast to integer for safety
                $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                } else {
                    header("location: users.php");
                    exit();
                }
                ?>
                <a href="users.php" class="back-icon"> <i class="fa-solid fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status'] ?></p>

                </div>
            </header>
            <div class="chat-box">

            </div>

            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="js/chat.js"></script>

</body>

</html>