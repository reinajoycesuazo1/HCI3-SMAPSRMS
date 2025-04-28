<?php
include 'db_config.php'; // this brings in $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $participant_name = $_POST['participant_name'] ?? '';
    $dob             = $_POST['dob'] ?? '';
    $gender          = $_POST['gender'] ?? '';
    $school_grade    = $_POST['school_grade'] ?? '';
    $guardian_name   = $_POST['guardian_name'] ?? '';
    $contact         = $_POST['contact'] ?? '';
    $address         = $_POST['address'] ?? '';
    $communion_date  = $_POST['communion_date'] ?? '';
    $priest_name     = $_POST['priest_name'] ?? '';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO communion_records 
            (participant_name, dob, gender, school_grade, guardian_name, contact, address, communion_date, priest_name)
            VALUES 
            (:participant_name, :dob, :gender, :school_grade, :guardian_name, :contact, :address, :communion_date, :priest_name)
        ");

        $stmt->execute([
            ':participant_name'=> $participant_name,
            ':dob'             => $dob,
            ':gender'          => $gender,
            ':school_grade'    => $school_grade,
            ':guardian_name'   => $guardian_name,
            ':contact'         => $contact,
            ':address'         => $address,
            ':communion_date'  => $communion_date,
            ':priest_name'     => $priest_name
        ]);

        // Redirect after successful insert
        header("Location: communion.php");
        exit();

    } catch (PDOException $e) {
        echo "❌ Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
