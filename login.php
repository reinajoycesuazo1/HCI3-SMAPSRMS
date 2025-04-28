<?php
session_start();

// Updated user credentials
$valid_username = "admin";
$valid_password = "smapsrms2025"; // Updated password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Trim whitespace
    $password = trim($_POST['password']); // Trim whitespace

    // Debugging output
    error_log("Submitted Username: $username, Submitted Password: $password"); // Log the submitted values

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: homepage.php");
        exit();
    } else {
        header("Location: index.php?error=Invalid username or password");
        exit();
    }
}
