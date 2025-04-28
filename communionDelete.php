<?php
include 'db_config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM communion_records WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: communion.php");
exit;
?>
