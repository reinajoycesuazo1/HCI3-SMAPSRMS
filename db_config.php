<?php
// Database configuration
$host = 'localhost';
$db_name = 'smapsrms';
$username = 'root';
$password = '';

try {
    // Create PDO instance with UTF-8 charset
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db_name;charset=utf8mb4", 
        $username, 
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    
    // Make available globally
    global $pdo;
    
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Could not connect to the database. Please try again later.");
}
?>
