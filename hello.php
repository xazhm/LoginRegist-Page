<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Get the user's name from the session
$name = $_SESSION['name'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
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
                    <img src="images/graphic2.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3 style="text-align: center; padding-bottom: 25px;">Hello, <?php echo $username; ?>!</h3>
                        <hr>
                        <center>Pesan:</center>
                        <br>
                        Kamu telah melakukan login dengan sukses!

                        <hr>
                        <div class="form-button">
                            <center>
                                <a href="logout.php"><button id="submit" type="submit" class="ibtn">Logout</button></a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>