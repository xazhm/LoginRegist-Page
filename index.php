<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: hello.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
</head>

<body>
    <div class="form-body without-side">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="images/graphic3.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3 style="padding-bottom: 15px; text-align: center;">Login to account</h3>

                        <form action="login.php" method="POST">
                            <?php
                        // Check if login failed and display an error message
                        if (isset($_GET['login_error']) && $_GET['login_error'] === 'true') {
                            echo '<p style="color: red; text-align: center; font-size: 15px;">Invalid username or password. Please try again.</p>';
                        }
                        ?>
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <center>
                                <div class="form-button">
                                    <button id="submit" type="submit" class="ibtn">Login</button>
                                </div>
                            </center>
                        </form>

                        <hr>
                        <center>
                            <div class="page-links">
                                Register? <a href="register.php">here.</a>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>