<?php
include 'db_config.php'; // this brings in $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $groom_name     = $_POST['groom_name'] ?? '';
    $groom_dob      = $_POST['groom_dob'] ?? '';
    $groom_address  = $_POST['groom_address'] ?? '';
    $bride_name     = $_POST['bride_name'] ?? '';
    $bride_dob      = $_POST['bride_dob'] ?? '';
    $bride_address  = $_POST['bride_address'] ?? '';
    $marriage_date  = $_POST['marriage_date'] ?? '';
    $marriage_time  = $_POST['marriage_time'] ?? '';
    $priest_name    = $_POST['priest_name'] ?? '';
    $witnesses      = $_POST['witnesses'] ?? '';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO marriage_records 
            (groom_name, groom_dob, groom_address, bride_name, bride_dob, bride_address, marriage_date, marriage_time, priest_name, witnesses)
            VALUES 
            (:groom_name, :groom_dob, :groom_address, :bride_name, :bride_dob, :bride_address, :marriage_date, :marriage_time, :priest_name, :witnesses)
        ");

        $stmt->execute([
            ':groom_name'    => $groom_name,
            ':groom_dob'     => $groom_dob,
            ':groom_address' => $groom_address,
            ':bride_name'    => $bride_name,
            ':bride_dob'     => $bride_dob,
            ':bride_address' => $bride_address,
            ':marriage_date' => $marriage_date,
            ':marriage_time' => $marriage_time,
            ':priest_name'   => $priest_name,
            ':witnesses'     => $witnesses
        ]);

        // Redirect to a success page or listing
        header("Location: marriageRec.php");
        exit();

    } catch (PDOException $e) {
        echo "❌ Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
