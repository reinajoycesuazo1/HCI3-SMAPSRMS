<?php
include 'db_config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID.");
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM communion_records WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $record = $stmt->fetch();

    if (!$record) {
        die("Record not found.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = [
            ':participant_name' => $_POST['participant_name'],
            ':dob'              => $_POST['dob'],
            ':gender'           => $_POST['gender'],
            ':school_grade'     => $_POST['school_grade'],
            ':guardian_name'    => $_POST['guardian_name'],
            ':contact'          => $_POST['contact'],
            ':address'          => $_POST['address'],
            ':communion_date'   => $_POST['communion_date'],
            ':priest_name'      => $_POST['priest_name'],
            ':id'               => $id
        ];

        $update = $pdo->prepare("
            UPDATE communion_records SET
                participant_name = :participant_name,
                dob = :dob,
                gender = :gender,
                school_grade = :school_grade,
                guardian_name = :guardian_name,
                contact = :contact,
                address = :address,
                communion_date = :communion_date,
                priest_name = :priest_name
            WHERE id = :id
        ");
        $update->execute($data);

        header("Location: communion.php");
        exit();
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Communion Record</title>
    <link rel="stylesheet" href="baptism.css" />
</head>
<body style="background-image: url('img/bg.png'); background-repeat: no-repeat; background-position: center; background-size: cover;">
    <div class="form-container">
        <header>
            <h2>EDIT COMMUNION RECORD</h2>
            <button class="btn btn-secondary go-back" onclick="window.location.href='communion.php'" style="position: fixed; top: 15px; left: 15px; z-index: 1050; background-color: green; border-color: gray; color: white;">Go Back</button>
        </header>
        <form method="POST">
            <div class="section">
                <label>Name:</label>
                <input type="text" name="participant_name" value="<?= htmlspecialchars($record['participant_name']) ?>" required />
            </div>
            <div class="section">
                <label>Date of Birth:</label>
                <input type="date" name="dob" value="<?= htmlspecialchars($record['dob']) ?>" required />
            </div>
            <div class="section">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="Male" <?= $record['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $record['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="section">
                <label>School Grade:</label>
                <input type="text" name="school_grade" value="<?= htmlspecialchars($record['school_grade']) ?>" required />
            </div>
            <div class="section">
                <label>Guardian Name:</label>
                <input type="text" name="guardian_name" value="<?= htmlspecialchars($record['guardian_name']) ?>" required />
            </div>
            <div class="section">
                <label>Contact:</label>
                <input type="text" name="contact" value="<?= htmlspecialchars($record['contact']) ?>" required />
            </div>
            <div class="section">
                <label>Address:</label>
                <input type="text" name="address" value="<?= htmlspecialchars($record['address']) ?>" required />
            </div>
            <div class="section">
                <label>Communion Date:</label>
                <input type="date" name="communion_date" value="<?= htmlspecialchars($record['communion_date']) ?>" required />
            </div>
            <div class="section">
                <label>Priest Name:</label>
                <input type="text" name="priest_name" value="<?= htmlspecialchars($record['priest_name']) ?>" required />
            </div>
            <div class="button-container">
                <button type="submit" class="register-btn" style="background-color: #FFD700; color: black; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); border: 2px solid #bfa500;">Update</button>
            </div>
        </form>
       
</body>
</html>
