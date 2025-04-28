<?php
include 'db_config.php'; // this brings in $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_name = $_POST['child_name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $birth_place = $_POST['birth_place'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $confirmation_date = $_POST['confirmation_date'] ?? '';
    $father_name = $_POST['father_name'] ?? '';
    $mother_name = $_POST['mother_name'] ?? '';
    $address = $_POST['address'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $godparents = $_POST['godparents'] ?? '';
    if (is_array($godparents)) {
        $godparents = implode(', ', array_map('trim', $godparents));
    }
    $priest_name = $_POST['priest_name'] ?? '';
    $confirmation_time = $_POST['confirmation_time'] ?? '';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO confirmation_records
            (child_name, dob, birth_place, gender, confirmation_date, father_name, mother_name, address, contact, godparents, priest_name, confirmation_time)
            VALUES 
            (:child_name, :dob, :birth_place, :gender, :confirmation_date, :father_name, :mother_name, :address, :contact, :godparents, :priest_name, :confirmation_time)
        ");

        $stmt->execute([
            ':child_name' => $child_name,
            ':dob' => $dob,
            ':birth_place' => $birth_place,
            ':gender' => $gender,
            ':confirmation_date' => $confirmation_date,
            ':father_name' => $father_name,
            ':mother_name' => $mother_name,
            ':address' => $address,
            ':contact' => $contact,
            ':godparents' => $godparents,
            ':priest_name' => $priest_name,
            ':confirmation_time' => $confirmation_time
        ]);

        // Redirect after successful insert
        header("Location: confirmation_records.php");
        exit();

    } catch (PDOException $e) {
        echo "❌ Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
