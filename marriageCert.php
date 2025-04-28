<?php
include 'db_config.php';

if (!isset($_GET['id'])) {
    echo "No record selected.";
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM marriage_records WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    echo "Record not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Marriage Certificate</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            padding: 40px;
            background-color: white;
        }
        .certificate {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border: 2px solid black;
        }
        h2 {
            text-align: center;
            text-decoration: underline;
        }
        .info {
            margin-top: 30px;
            font-size: 18px;
        }
        .footer {
            text-align: center;
            margin-top: 60px;
            font-size: 16px;
        }
        .btn-print {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
        }
        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">Print Certificate</button>

    <div class="certificate">
        <h2>MARRIAGE CERTIFICATE</h2>
        <div class="info">
            <p>This certifies that <strong><?= htmlspecialchars($record['groom_name']) ?></strong> and <strong><?= htmlspecialchars($record['bride_name']) ?></strong></p>
            <p>were united in Holy Matrimony on <strong><?= htmlspecialchars($record['marriage_date']) ?></strong> at <strong><?= htmlspecialchars($record['place']) ?></strong>.</p>
            <p>Officiated by <strong><?= htmlspecialchars($record['priest_name']) ?></strong>.</p>
        </div>
        <div class="footer">
            <p>Issued this <?= date("jS") ?> day of <?= date("F Y") ?></p>
            <p>SAINT MICHAEL THE ARCHANGEL PARISH</p>
        </div>
    </div>
</body>
</html>