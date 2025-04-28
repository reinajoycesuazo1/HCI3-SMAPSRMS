<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}

// Database connection
$servername = "localhost"; // Change if necessary
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "smapsrms"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful.<br>";
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_name = $_POST['child_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_names = $_POST['parent_names'];

    // Insert data into the database
    $sql = "INSERT INTO SacramentalRecords (user_id, sacrament_type, date, details) VALUES (?, 'baptism', ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $_SESSION['user_id'], $date_of_birth, $child_name . " - Parents: " . $parent_names);

    if ($stmt->execute()) {
        // Redirect to baptismalRec.php after successful registration
        header("Location: baptismalRec.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
