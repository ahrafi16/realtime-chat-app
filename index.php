<?php include_once "header.php" ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat app</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt">This is an error messsage !</div>
                <div class="name-details">
                    <div class="field input">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>

                </div>
                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div class="field">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
            </form>
            <div class="link">
                Already signed up? <a href="login.php">Login now</a>
            </div>
        </section>
    </div>

    <script src="js/pass-show-hide.js"></script>
    <script src="js/signup.js"></script>
</body>

</html>