<?php
session_start();
include 'db_config.php';

// Check if $pdo is set and valid
if (!isset($pdo) || !($pdo instanceof PDO)) {
    echo "Database connection is not properly initialized.<br>";
    exit;
}

// Get record counts from database
$records = [
    'baptism' => 0,
    'communion' => 0,
    'confirmation' => 0,
    'marriage' => 0
];

try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM baptismal_records");
    $records['baptism'] = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM communion_records");
    $records['communion'] = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM confirmation_records");
    $records['confirmation'] = $stmt->fetchColumn();
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM marriage_records");
    $records['marriage'] = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "Error fetching records: " . htmlspecialchars($e->getMessage()) . "<br>";
    exit;
}

$total = array_sum($records);
?>

<div class="dashboard-container" style="max-width: 600px; margin: 20px auto; padding: 15px; background: linear-gradient(135deg, #f0f4f8, #d9e2ec); border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; position: relative;">
    <button class="close-btn" onclick="window.location.href='homepage.php'" style="position: absolute; top: 15px; right: 15px; background-color: transparent; border: none; font-size: 1.5rem; font-weight: bold; cursor: pointer; color: #888; transition: color 0.3s ease;">&times;</button>
    <header style="text-align: center; margin-bottom: 20px; color: #102a43;">
        <h1 style="font-weight: 700; letter-spacing: 1.5px; font-size: 1.8rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.1);">Sacramental Records Dashboard</h1>
    </header>
    
    <div class="stats-container" style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 15px;">
        <?php foreach ($records as $key => $count): 
            $color = match($key) {
                'baptism' => '#3b82f6',
                'communion' => '#10b981',
                'confirmation' => '#8b5cf6',
                'marriage' => '#ef4444',
                default => '#777'
            };
        ?>
        <div class="stat-card <?= $key ?>" style="flex: 1 1 150px; background: <?= $color ?>; color: white; padding: 15px 20px; border-radius: 12px; box-shadow: 0 6px 15px <?= $color ?>80; transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: default;">
            <h3 style="font-weight: 600; font-size: 1.1rem; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 1px 3px rgba(0,0,0,0.2);"><?= ucfirst($key) ?> Records</h3>
            <div class="stat-value" style="font-size: 2.2rem; font-weight: 800; line-height: 1; text-shadow: 0 2px 6px rgba(0,0,0,0.3);"><?= $count ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <table style="width: 100%; margin-top: 20px; border-collapse: separate; border-spacing: 0 10px; font-size: 1rem; background: white; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background-color: #f9fafb; border-radius: 15px;">
                <th style="padding: 10px 15px; text-align: center; color: #334155; font-weight: 600; letter-spacing: 1px;">Sacrament</th>
                <th style="padding: 10px 15px; text-align: center; color: #334155; font-weight: 600; letter-spacing: 1px;">Count</th>
                <th style="padding: 10px 15px; text-align: center; color: #334155; font-weight: 600; letter-spacing: 1px;">Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $key => $count): 
                $percentage = $total > 0 ? round(($count / $total) * 100, 2) : 0;
                $bgColor = ($key === 'baptism') ? '#e0f2fe' : (($key === 'communion') ? '#d1fae5' : (($key === 'confirmation') ? '#ede9fe' : '#fee2e2'));
            ?>
            <tr style="background-color: <?= $bgColor ?>; border-radius: 12px;">
                <td style="padding: 10px 15px; text-transform: capitalize; color: #1e293b; font-weight: 600;"><?= $key ?></td>
                <td style="padding: 10px 15px; text-align: center; color: #1e293b; font-weight: 700;"><?= $count ?></td>
                <td style="padding: 10px 15px; text-align: center; color: #1e293b; font-weight: 700;"><?= $percentage ?>%</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
