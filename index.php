<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: homepage.php"); // Redirect if already logged in
    exit();
}

// Define valid credentials
$valid_username = "admin";
$valid_password = "smapsrms2025"; // Update this if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Trim whitespace
    $password = trim($_POST['password']); // Trim whitespace

    // Debugging output
    error_log("Submitted Username: $username, Submitted Password: $password"); // Log the submitted values

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: homepage.php"); // Redirect to homepage after login
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMAPISMS Login</title>

    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <script src="script.js" defer></script> 
</head>
<body>

    <div class="led-banner">
        <span>Welcome to Saint Michael the Archangel Parish Sacramental Records Management System | To God be the Glory | Have a Good Day!</span>
    </div>

    <div class="login-wrapper">
        <img src="img/leftlogo.png" alt="Left Logo" class="logo-left">

        <div class="container">
            <div class="login-box">
                <h2 class="login-title">User Log In</h2>

                <div class="icon-container">
                    <i class="fas fa-user-circle icon"></i>
                </div>

                <form method="POST" ="action="login.php">
                    <div class="input-group">
                        <input type="text" id="username" name="username" placeholder="Username:" required>
                    </div>

                    <div class="input-group relative">
                        <input type="password" id="password" name="password" placeholder="Password:" required>
                        <i class="fas fa-eye-slash eye-icon"></i>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="login-button">Log in</button>
                </form>

                <?php
                if (isset($_GET['error'])) {
                    echo "<p class='error-message'>" . htmlspecialchars($_GET['error']) . "</p>";
                }
                ?>
            </div>
        </div>

        <img src="img/rightlogo.png" alt="Right Logo" class="logo-right">
    </div>

    <footer>
        <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
