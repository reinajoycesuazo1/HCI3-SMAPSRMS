<?php
include 'db_config.php';

error_log("baptismDelete.php accessed with id: " . ($_GET['id'] ?? 'none'));

$id = $_GET['id'] ?? null;

if (!isset($id) || !is_numeric($id) || intval($id) <= 0) {
    echo "Invalid ID: Missing or invalid ID parameter.";
    error_log("Invalid ID in baptismDelete.php: id param missing or invalid.");
    exit;
}

$id = intval($id);

$stmt = $pdo->prepare("DELETE FROM baptismal_records WHERE id = ?");
$stmt->execute([$id]);

header("Location: baptismalRec.php");
exit;
?>
