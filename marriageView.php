<?php
include 'db_config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || intval($_GET['id']) <= 0) {
    echo "Invalid request: Missing or invalid ID parameter.";
    exit;
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM marriage_records WHERE id = ?");
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
    <title>View Marriage Record</title>
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
            <div class="record-label"><i class="fas fa-user"></i> Groom:</div>
            <div class="record-value"><?= htmlspecialchars($record['groom_name']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-user"></i> Bride:</div>
            <div class="record-value"><?= htmlspecialchars($record['bride_name']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-calendar-alt"></i> Marriage Date:</div>
            <div class="record-value"><?= date('m/d/Y', strtotime($record['marriage_date'])) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-clock"></i> Marriage Time:</div>
            <div class="record-value"><?= htmlspecialchars($record['marriage_time']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-church"></i> Location:</div>
            <div class="record-value"><?= htmlspecialchars($record['location']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-user-tie"></i> Officiant:</div>
            <div class="record-value"><?= htmlspecialchars($record['priest_name']) ?></div>
        </div>
        <div class="record-row">
            <div class="record-label"><i class="fas fa-users"></i> Witnesses:</div>
            <div class="record-value"><?= htmlspecialchars($record['witnesses']) ?></div>
        </div>

        <a href="marriageRec.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Records</a>
    </div>
</body>
</html>
