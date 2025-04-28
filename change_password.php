<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo-left">
                <img src="img/leftlogo.png" alt="Parish Logo">
            </div>
            <h1>Change Password - Saint Michael the Archangel Parish</h1>
            <div class="logo-right">
                <img src="img/rightlogo.png" alt="Right Logo">
            </div>
        </div>
    </header>
 
   

    <main>
        <div class="content-container">
            <h2>Change Your Password</h2>
            <form action="process_password_change.php" method="post">
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit">Change Password</button>
            </form>
        </div>
    </main>
    
    <footer>
        <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
