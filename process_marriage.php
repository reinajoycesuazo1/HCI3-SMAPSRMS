<?php
session_start();
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validate input
        $husband_name = trim($_POST['husband_name']);
        $wife_name = trim($_POST['wife_name']);
        $marriage_date = $_POST['marriage_date'];
        $location = trim($_POST['location']);

        if (empty($husband_name) || empty($wife_name) || empty($marriage_date) || empty($location)) {
            throw new Exception("All fields are required");
        }

        // Validate date format
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $marriage_date)) {
            throw new Exception("Invalid date format");
        }

        // Insert into database
        $sql = "INSERT INTO marriages (husband_name, wife_name, marriage_date, location) 
                VALUES (:husband, :wife, :date, :location)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            ':husband' => $husband_name,
            ':wife' => $wife_name,
            ':date' => $marriage_date,
            ':location' => $location
        ]);

        $_SESSION['success'] = "Marriage record added successfully!";
        
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Database error. Please try again.";
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    
    header("Location: marriageRec.php");
    exit();
}
?>
