<?php
include 'db_config.php'; // this brings in $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_name = $_POST['child_name'] ?? '';
    $dob             = $_POST['dob'] ?? '';
    $birth_place = $_POST['birth_place'];
    $gender          = $_POST['gender'] ?? '';
    $baptism_date = $_POST['baptism_date']?? '';
    $father_name = $_POST['father_name']?? '';
    $mother_name = $_POST['mother_name']?? '';
    $address = $_POST['address']?? '';
    $godparents = $_POST['godparents'] ?? '';
    if (is_array($godparents)) {
        $godparents = implode(', ', array_map('trim', $godparents));
    }
    $priest_name = $_POST['priest_name']?? '';
    $baptism_time = $_POST['baptism_time']?? '';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO baptismal_records
            (child_name, dob, birth_place, gender, baptism_date, father_name, mother_name, address,godparents, priest_name, baptism_time)
            VALUES 
            (:child_name, :dob, :birth_place, :gender, :baptism_date, :father_name, :mother_name, :address, :godparents, :priest_name, :baptism_time)
        ");

        $stmt->execute([
            ':child_name'=> $child_name,
            ':dob'             => $dob,
            ':birth_place'     => $birth_place,
            ':gender'          => $gender,
            ':baptism_date'    => $baptism_date,
            ':father_name'     => $father_name,
            ':mother_name'     => $mother_name,
            ':address'         => $address,
            ':godparents'      => $godparents,
            ':priest_name'     => $priest_name,
            ':baptism_time'    => $baptism_time // ← corrected this line
        ]);

        // Redirect after successful insert
        header("Location: baptismalRec.php");
        exit();

    } catch (PDOException $e) {
        echo "❌ Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
