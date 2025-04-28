<?php
include 'db_config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || intval($_GET['id']) <= 0) {
    echo "Invalid ID.";
    exit;
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'groom_name' => $_POST['groom_name'],
        'groom_dob' => $_POST['groom_dob'],
        'groom_address' => $_POST['groom_address'],
        'bride_name' => $_POST['bride_name'],
        'bride_dob' => $_POST['bride_dob'],
        'bride_address' => $_POST['bride_address'],
        'marriage_date' => $_POST['marriage_date'],
        'marriage_time' => $_POST['marriage_time'],
        'priest_name' => $_POST['priest_name'],
        'witnesses' => $_POST['witnesses'],
        'location' => $_POST['location'],
        'id' => $id
    ];

    $stmt = $pdo->prepare("UPDATE marriage_records SET 
        groom_name = :groom_name, groom_dob = :groom_dob, groom_address = :groom_address,
        bride_name = :bride_name, bride_dob = :bride_dob, bride_address = :bride_address,
        marriage_date = :marriage_date, marriage_time = :marriage_time, priest_name = :priest_name,
        witnesses = :witnesses, location = :location WHERE id = :id");
    $stmt->execute($data);

    header("Location: marriageRec.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM marriage_records WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Marriage Edit Form</title>
    <link rel="stylesheet" href="baptism.css" />
</head>
<body>
    <div class="form-container">
        <header>
            <h2>MARRIAGE EDIT FORM</h2>
            <button class="btn btn-secondary go-back" onclick="window.location.href='marriageRec.php'" style="position: fixed; top: 15px; left: 15px; z-index: 1050; background-color: green; border-color: gray; color: white;">Go Back</button>
        </header>
        <form method="POST">
            <div class="church-info">
                <label>Church:</label>
                <input type="text" value="SAINT MICHAEL THE ARCHANGEL PARISH" readonly />
            </div>
            <div class="section">
                <h3>GROOM'S INFORMATION</h3>
                <label>Full Name:</label>
                <input type="text" name="groom_name" value="<?= htmlspecialchars($record['groom_name']) ?>" required />
                <label>Date of Birth:</label>
                <input type="date" name="groom_dob" value="<?= htmlspecialchars($record['groom_dob']) ?>" required />
                <label>Address:</label>
                <input type="text" name="groom_address" value="<?= htmlspecialchars($record['groom_address']) ?>" required />
            </div>
            <div class="section">
                <h3>BRIDE'S INFORMATION</h3>
                <label>Full Name:</label>
                <input type="text" name="bride_name" value="<?= htmlspecialchars($record['bride_name']) ?>" required />
                <label>Date of Birth:</label>
                <input type="date" name="bride_dob" value="<?= htmlspecialchars($record['bride_dob']) ?>" required />
                <label>Address:</label>
                <input type="text" name="bride_address" value="<?= htmlspecialchars($record['bride_address']) ?>" required />
            </div>
            <div class="section">
                <h3>MARRIAGE DETAILS</h3>
                <label>Date of Marriage:</label>
                <input type="date" name="marriage_date" value="<?= htmlspecialchars($record['marriage_date']) ?>" required />
                <label>Time:</label>
                <input type="time" name="marriage_time" value="<?= htmlspecialchars($record['marriage_time']) ?>" required />
                <label>Priest Name:</label>
                <input type="text" name="priest_name" value="<?= htmlspecialchars($record['priest_name']) ?>" required />
                <label>Witnesses:</label>
                <input type="text" name="witnesses" value="<?= htmlspecialchars($record['witnesses']) ?>" required />
                <label>Location:</label>
                <input type="text" name="location" value="<?= htmlspecialchars($record['location']) ?>" required />
            </div>
            <div class="button-container">
                <button type="submit" class="register-btn" style="background-color: #FFD700; color: black; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); border: 2px solid #bfa500;">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
