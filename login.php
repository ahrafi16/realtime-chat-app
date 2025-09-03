<?php include_once "header.php" ?>


<body>
    <div class="wrapper">
        <img src="#" alt="">
        <section class="form login">
            <div class="header-container left">
                <img src="assets/chat_logo.png" alt="Talksy Logo" class="logo">
                <header>Talksy</header>
            </div>
            <form action="#" method="POST">
                <div class="error-txt"></div>
                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fa-solid fa-eye"></i>
                </div>

                <div class="field button">
                    <input type="button" value="Continue to chat">
                </div>
            </form>
            <div class="link">
                Not yet signed up? <a href="index.php">Signup now</a>
            </div>
        </section>
    </div>


    <script src="js/pass-show-hide.js"></script>
    <script src="js/login.js"></script>
</body>

</html>