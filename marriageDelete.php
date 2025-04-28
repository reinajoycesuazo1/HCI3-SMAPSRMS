<?php
include 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM marriage_records WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: marriageRec.php");
    exit();
} else {
    echo "Invalid request.";
}
?>