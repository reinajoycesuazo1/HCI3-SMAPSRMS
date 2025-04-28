<?php
include 'db_config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || intval($_GET['id']) <= 0) {
    echo "Invalid request: Missing or invalid ID parameter.";
    exit;
}
$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM confirmation_records WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch();

if (!$record) {
    echo "Record not found for ID: " . htmlspecialchars($id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Confirmation Record</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('img/bg.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        .card {
            max-width: 600px;
            max-height: 700px;
            margin: 30px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
        }
        .card h2 {
            font-family: 'Times New Roman', serif;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            color: #333;
            position: relative;
        }
        .card h2::after {
            content: '';
            width: 60px;
            height: 3px;
            background: #4CAF50;
            display: block;
            margin: 10px auto 0;
            border-radius: 3px;
        }
        .record-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }
        .record-label {
            font-weight: 600;
            color: #555;
            display: flex;
            align-items: center;
        }
        .record-value {
            color: #212529;
            text-align: right;
        }
        .record-label i {
            margin-right: 8px;
            color: #4CAF50;
        }
        .btn-back {
            display: block;
            width: 200px;
            margin: 10px auto 0 auto;
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s, transform 0.3s;
        }
        .btn-back:hover {
            background-color: #43a047;
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2><i class="fas fa-book-open"></i> View Details</h2>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-user"></i>Name:</div>
            <div class="record-value"><?= htmlspecialchars($record['child_name']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-birthday-cake"></i>Date of Birth:</div>
            <div class="record-value"><?= date('m/d/Y', strtotime($record['dob'])) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-map-marker-alt"></i>Birth Place:</div>
            <div class="record-value"><?= htmlspecialchars($record['birth_place']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-venus-mars"></i>Gender:</div>
            <div class="record-value"><?= htmlspecialchars($record['gender']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-male"></i>Father:</div>
            <div class="record-value"><?= htmlspecialchars($record['father_name']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-female"></i>Mother:</div>
            <div class="record-value"><?= htmlspecialchars($record['mother_name']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-home"></i>Address:</div>
            <div class="record-value"><?= htmlspecialchars($record['address']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-hands-helping"></i>Godparents:</div>
            <div class="record-value">
                <?php
                $godparents = $record['godparents'];
                $decoded = json_decode($godparents, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    echo htmlspecialchars(implode(', ', $decoded));
                } else {
                    echo htmlspecialchars($godparents);
                }
                ?>
            </div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-cross"></i>Confirmation Date:</div>
            <div class="record-value"><?= date('m/d/Y', strtotime($record['confirmation_date'])) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-clock"></i>Time:</div>
            <div class="record-value"><?= htmlspecialchars($record['confirmation_time']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-user-tie"></i>Priest:</div>
            <div class="record-value"><?= htmlspecialchars($record['priest_name']) ?></div>
        </div>

        <a href="confirmation_records.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Records</a>
    </div>
</body>
</html>
