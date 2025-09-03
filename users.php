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
        <section class="users">
            <?php
            include_once "php/config.php";
            $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
            $stmt->bind_param("i", $_SESSION['unique_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                session_destroy();
                header("location: login.php");
                exit();
            }
            ?>
            <header>
                <div class="content">
                    <img src="php/images/<?php echo $row['img'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>


    <script src="js/users.js"></script>
</body>

</html>