<?php
session_start();
include 'db_config.php'; // Include database configuration
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marriage Registration Form</title>
    <link rel="stylesheet" href="marriage.css">
</head>
<body>

    <div class="form-container">
        <header>
            <h2>MARRIAGE REGISTRATION FORM</h2>
            <button class="close-btn">&times;</button>
        </header>

        <form action="process_marriage.php" method="POST">
            <div class="section">
                <h3>COUPLE'S INFORMATION</h3>
                <label>Husband's Full Name:</label>
                <input type="text" name="husband_name" required>

                <label>Wife's Full Name:</label>
                <input type="text" name="wife_name" required>

                <label>Date of Marriage:</label>
                <input type="date" name="marriage_date" required>

                <label>Location:</label>
                <input type="text" name="location" required>
            </div>

            <div class="button-container">
                <button type="submit" class="register-btn">Register</button>
            </div>
        </form>

        <footer>
            <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
        </footer>
    </div>

</body>
</html>