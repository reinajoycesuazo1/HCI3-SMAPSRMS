<?php
session_start();

// Check if the user is logged in
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
    <title>Registration</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo-left">
                <img src="img/leftlogo.png" alt="Parish Logo">
            </div>
            <h1>Registration - Saint Michael the Archangel Parish</h1>
            <div class="logo-right">
                <img src="img/rightlogo.png" alt="Right Logo">
            </div>
        </div>
    </header>
 
    <?php include 'profileMenu.php'; ?>

    <main>
        <div class="content-container">
            <h2>Registration Records</h2>
            <p>This section will contain registration records and forms.</p>
        </div>
    </main>
    
    <footer>
        <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
