<?php
// Start the session
session_start();
// Include the database configuration file which defines $pdo
include 'db_config.php'; // This defines $pdo

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get groom's name from POST data or set empty string if not set
    $groom_name = $_POST['groom_name'] ?? '';
    // Get groom's date of birth from POST data or set empty string if not set
    $groom_dob = $_POST['groom_dob'] ?? '';
    // Get groom's address from POST data or set empty string if not set
    $groom_address = $_POST['groom_address'] ?? '';
    // Get bride's name from POST data or set empty string if not set
    $bride_name = $_POST['bride_name'] ?? '';
    // Get bride's date of birth from POST data or set empty string if not set
    $bride_dob = $_POST['bride_dob'] ?? '';
    // Get bride's address from POST data or set empty string if not set
    $bride_address = $_POST['bride_address'] ?? '';
    // Get marriage date from POST data or set empty string if not set
    $marriage_date = $_POST['marriage_date'] ?? '';
    // Get marriage time from POST data or set empty string if not set
    $marriage_time = $_POST['marriage_time'] ?? '';
    // Get priest's name from POST data or set empty string if not set
    $priest_name = $_POST['priest_name'] ?? '';
    // Get witnesses from POST data or set empty string if not set
    $witnesses = $_POST['witnesses'] ?? '';
    // Get location from POST data or set empty string if not set
    $location = $_POST['location'] ?? '';

    try {
        // Prepare SQL insert statement for marriage_records table
        $sql = "INSERT INTO marriage_records 
            (groom_name, groom_dob, groom_address, bride_name, bride_dob, bride_address, marriage_date, marriage_time, priest_name, witnesses, location)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        // Execute the statement with the provided data
        $stmt->execute([
            $groom_name,
            $groom_dob,
            $groom_address,
            $bride_name,
            $bride_dob,
            $bride_address,
            $marriage_date,
            $marriage_time,
            $priest_name,
            $witnesses,
            $location
        ]);

        // Redirect to marriageRec.php after successful registration
        header("Location: marriageRec.php");
        exit();
    } catch (PDOException $e) {
        // Set error message if there is a database error
        $error_message = "Error saving record: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Marriage Registration Form</title>
    <link rel="stylesheet" href="baptism.css" />
</head>
<body>

    <div class="form-container">
        <header>
            <h2>MARRIAGE REGISTRATION FORM</h2>
            <button class="btn btn-secondary go-back" onclick="window.location.href='homepage.php'" style="position: fixed; top: 15px; left: 15px; z-index: 1050; background-color: green; border-color: gray; color: white;">Go Back</button>
        </header>

        
        
        

        <?php if (!empty($error_message)): ?>
            <div class="error-message" style="color: red; font-weight: bold; margin-bottom: 15px;">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <form action="marriageReg.php" method="POST">
            <div class="church-info">
                <label>Church:</label>
                <input type="text" value="SAINT MICHAEL THE ARCHANGEL PARISH" readonly />
            </div>

            <div class="section">
                <h3>GROOM'S INFORMATION</h3>
                <label>Full Name:</label>
                <input type="text" name="groom_name" required />

                <label>Date of Birth:</label>
                <input type="date" name="groom_dob" required />

                <label>Address:</label>
                <input type="text" name="groom_address" required />
            </div>

            <div class="section">
                <h3>BRIDE'S INFORMATION</h3>
                <label>Full Name:</label>
                <input type="text" name="bride_name" required />

                <label>Date of Birth:</label>
                <input type="date" name="bride_dob" required />

                <label>Address:</label>
                <input type="text" name="bride_address" required />
            </div>

            <div class="section">
                <h3>MARRIAGE DETAILS</h3>
                <label>Date of Marriage:</label>
                <input type="date" name="marriage_date" required />

                <label>Time:</label>
                <input type="time" name="marriage_time" required />

                <label>Priest Name:</label>
                <input type="text" name="priest_name" required />

                <label>Witnesses:</label>
                <input type="text" name="witnesses" required />

                <label>Location:</label>
                <input type="text" name="location" required />
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
