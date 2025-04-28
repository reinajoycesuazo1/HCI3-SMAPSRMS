<?php
include 'db_config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid ID.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM baptismal_records WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch();

if (!$record) {
    echo "Record not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Baptismal Certificate</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .certificate-container {
                box-shadow: none !important;
                border: none !important;
            }
        }
        body {
            background-image: url('img/bg.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            font-family: 'Arial', serif;
        }
        
        .certificate-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 40px 50px;
            background: white;
            border: 3px solid #343a40;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            position: relative;
            background-image: url('img/smap.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100% 100%;
            .certificate-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: black;
            text-align: center;
            margin: 0 auto 0.1rem auto;
            font-family: 'Old English Text MT', serif;
            border: 2px solid black;
            border-radius: 10px;
            padding: 2px 20px;
            display: table;
        }
        .church-location {
            font-size: 1.2rem;
            text-align: center;
           line-height: 0.5rem;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
            color: #212529;
            font-family: 'Times New Roman',Georgia;
            
        }
        .this-is-to-certify {
            font-size: 1.0rem;
            text-align: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
            color: #343a40;
            font-family: 'Georgia', serif;
        
    }
        .content p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #212529;
            text-align: justify;
            margin-bottom: 1rem;
            font-family: 'Times New Roman', Times, serif;
        }
        .signature-section {
            margin-top: 4rem;
            display: flex;
            justify-content: right;
            padding: 0 3rem;
        }
        .signature-box {
            border-top: 2px solid #343a40;
            width: 200px;
            text-align: center;
            font-weight: 600;
            font-family: 'Georgia', serif;
            font-size: 1rem;
            color: #343a40;
        }
        .footer-text {
            text-align: center;
            margin-top: 3rem;
            font-size: 0.9rem;
            color: #6c757d;
            font-style: italic;
        }
        .certificate-number {
            position: absolute;
            bottom: 15px;
            right: 30px;
            font-size: 0.9rem;
            color: #6c757d;
            font-family: 'Georgia', serif;
        }
        .print-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1050;
        }

        .go-back-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1050;
        }
    </style>
</head>
 <button class="btn btn-secondary go-back-btn no-print" onclick="window.location.href='baptismalRec.php'" style="position: fixed; top: 15px; left: 15px; z-index: 1050; background-color: green; border-color: gray; color: white;">Go Back</button>
    <button class="btn btn-primary print-btn no-print" onclick="window.print()" style="position: fixed; top: 15px; right: 15px; z-index: 1050;">Print Certificate</button>
    <div class="certificate-container shadow">
        <div class="certificate-number">
            Certificate No: <?= htmlspecialchars($record['certificate_number'] ?? 'N/A') ?>
        </div>
        <div class="certificate-title">Baptismal Certificate</div>
        <div class="church-location">
            <p>Saint Michael the Archangel Parish</p>
            <p>Diocese of Butuan</p>
            <p>Nasipit, Agusan del Norte</p>
        </div>
        <div class="this-is-to-certify">
            <p>This is to certify</p>
        </div>
        <div class="content">
            <p>that <strong><?= htmlspecialchars($record['child_name']) ?></strong>, born on <?= date('F j, Y', strtotime($record['dob'])) ?> in <?= htmlspecialchars($record['birth_place']) ?>, child of <?= htmlspecialchars($record['father_name']) ?> and <?= htmlspecialchars($record['mother_name']) ?>, was baptized on <?= date('F j, Y', strtotime($record['baptism_date'])) ?> at <?= htmlspecialchars($record['baptism_time']) ?> by <?= htmlspecialchars($record['priest_name']) ?>.</p>
            <p>The Godparents were <?= htmlspecialchars($record['godparents']) ?>.
            <p>This certificate is issued for legal purposes.</p>
            <p>Given this <?= date('jS') ?> day of <?= date('F') ?>,<?= date('Y') ?>.</p
        </div>
        <div class="signature-section">
            <div class="signature-box">Parish Priest</div>
            
        </div>
        <div class="footer-text">
            Official Document - Not Valid Without Church Seal<br />
            Parish Address: 123 Church Street, City, Country
        </div>
    </div>
</body>
</html>
