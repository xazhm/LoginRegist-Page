<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: hello.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "loginreg";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database based on the username
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];

            // Redirect to the hello.php page
            header('Location: hello.php');
            exit();
        } else {
            // Incorrect password, redirect back to the login page with an error flag
            header('Location: index.php?login_error=true');
            exit();
        }
    } else {
        // User not found, redirect back to the login page with an error flag
        header('Location: index.php?login_error=true');
        exit();
    }
}
?>