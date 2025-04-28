<?php
session_start();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $child_name = $_POST['child_name'];
    $dob = $_POST['dob'];
    $birth_place = $_POST['birth_place'];
    $gender = $_POST['gender'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $godparents = $_POST['godparents'];
    $confirmation_date = $_POST['confirmation_date'];
    $confirmation_time = $_POST['confirmation_time'];
    $priest_name = $_POST['priest_name'];
} else {
    // Redirect to registration form if accessed directly
    header("Location: confirmationReg.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation of Registration</title>
    <link rel="stylesheet" href="baptism.css">
</head>
<body>

    <div class="confirmation-container">
        <header>
            <h2>Confirmation of Registration</h2>
        </header>

        <div class="confirmation-details">
            <h3>Child's Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($child_name); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($dob); ?></p>
            <p><strong>Place of Birth:</strong> <?php echo htmlspecialchars($birth_place); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>

            <h3>Parent's Information</h3>
            <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($father_name); ?></p>
            <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($mother_name); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
            <p><strong>Contact No.:</strong> <?php echo htmlspecialchars($contact); ?></p>

            <h3>Godparents</h3>
            <p><?php echo nl2br(htmlspecialchars($godparents)); ?></p>

            <h3>Confirmation Details</h3>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($confirmation_date); ?></p>
            <p><strong>Time:</strong> <?php echo htmlspecialchars($confirmation_time); ?></p>
            <p><strong>Priest:</strong> <?php echo htmlspecialchars($priest_name); ?></p>
        </div>

        <div class="button-container">
            <form action="process_confirmation.php" method="POST">
                <input type="hidden" name="child_name" value="<?php echo htmlspecialchars($child_name); ?>">
                <input type="hidden" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
                <input type="hidden" name="birth_place" value="<?php echo htmlspecialchars($birth_place); ?>">
                <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
                <input type="hidden" name="father_name" value="<?php echo htmlspecialchars($father_name); ?>">
                <input type="hidden" name="mother_name" value="<?php echo htmlspecialchars($mother_name); ?>">
                <input type="hidden" name="address" value="<?php echo htmlspecialchars($address); ?>">
                <input type="hidden" name="contact" value="<?php echo htmlspecialchars($contact); ?>">
                <input type="hidden" name="godparents" value="<?php echo htmlspecialchars($godparents); ?>">
                <input type="hidden" name="confirmation_date" value="<?php echo htmlspecialchars($confirmation_date); ?>">
                <input type="hidden" name="confirmation_time" value="<?php echo htmlspecialchars($confirmation_time); ?>">
                <input type="hidden" name="priest_name" value="<?php echo htmlspecialchars($priest_name); ?>">
                <button type="submit" class="confirm-btn">Confirm Registration</button>
            </form>
            <form action="confirmationReg.php" method="GET">
                <button type="submit" class="edit-btn">Edit Registration</button>
            </form>
        </div>

        <footer>
            <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
        </footer>
    </div>

</body>
</html>
