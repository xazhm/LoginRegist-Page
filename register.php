<?php

session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: hello.php');
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginreg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$alertMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if username or email already exists in the database
    $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        $alertMessage = "Username or email already exists.";
    } elseif ($password !== $confirmPassword) {
        $alertMessage = "Password and confirm password do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (name, username, email, password)
                        VALUES ('$name', '$username', '$email', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            $alertMessage = "Registration successful. You can now login.";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
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
                        <h3 style="text-align: center; padding-bottom: 25px;">Register new account</h3>

                        <?php if (!empty($alertMessage)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $alertMessage; ?>
                        </div>
                        <?php endif; ?>

                        <form action="register.php" method="POST">
                            <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                            <input class="form-control" type="text" name="username" placeholder="Username" required>
                            <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <input class="form-control" type="password" name="confirm_password"
                                placeholder="Retype Your Password" required>
                            <div class="form-button">
                                <center>
                                    <button id="submit" type="submit" class="ibtn">Register</button>
                                </center>
                            </div>
                        </form>

                        <hr>
                        <center>
                            <div class="page-links">
                                Login? <a href="index.php">here.</a>
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