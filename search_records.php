<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['username'])) {
    http_response_code(403);
    echo "Access denied.";
    exit();
}

$query = $_GET['q'] ?? '';
$query = trim($query);

if ($query === '') {
    echo "<p>Please enter a search term.</p>";
    exit();
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$results = [];

try {
    // Search baptismal_records
    $stmt = $pdo->prepare("SELECT 'Baptism' AS sacrament, id, child_name, dob FROM baptismal_records WHERE child_name LIKE ? LIMIT 10");
    $stmt->execute(["%$query%"]);
    $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));

    // Search communion_records
    $stmt = $pdo->prepare("SELECT 'Communion' AS sacrament, id, participant_name AS child_name, dob FROM communion_records WHERE participant_name LIKE ? LIMIT 10");
    $stmt->execute(["%$query%"]);
    $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));

    // Search confirmation_records
    $stmt = $pdo->prepare("SELECT 'Confirmation' AS sacrament, id, child_name, dob FROM confirmation_records WHERE child_name LIKE ? LIMIT 10");
    $stmt->execute(["%$query%"]);
    $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));

    // Search marriage_records
    $stmt = $pdo->prepare("SELECT 'Marriage' AS sacrament, id, groom_name AS child_name, groom_dob AS dob FROM marriage_records WHERE groom_name LIKE ? LIMIT 10");
    $stmt->execute(["%$query%"]);
    $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "<p style='color: red; font-family: Arial, sans-serif;'>Error during search: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

if (empty($results)) {
    echo "<p style='font-family: Arial, sans-serif;'>No records found for '<strong>" . htmlspecialchars($query) . "</strong>'.</p>";
    exit();
}

echo "<h2 style='color:rgb(255, 255, 255); font-family: Arial, sans-serif; font-weight: 700; margin-bottom: 15px;'>Search Results for '<em>" . htmlspecialchars($query) . "</em>'</h2>";
echo "<div style='display: flex; flex-wrap: wrap; gap: 15px; font-family: Arial, sans-serif;'>";

foreach ($results as $row) {
    // Determine action URL based on sacrament
    $actionUrl = "#";
    switch ($row['sacrament']) {
        case 'Baptism':
            $actionUrl = "baptismView.php?id=" . urlencode($row['id']);
            break;
        case 'Communion':
            $actionUrl = "communionView.php?id=" . urlencode($row['id']);
            break;
        case 'Confirmation':
            $actionUrl = "confirmationView.php?id=" . urlencode($row['id']);
            break;
        case 'Marriage':
            $actionUrl = "marriageView.php?id=" . urlencode($row['id']);
            break;
    }

    echo "<div style='flex: 1 1 300px; background: #f9fafb; border-radius: 10px; box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1); padding: 15px;'>";
    echo "<h3 style='margin-top: 0; color: #334155;'>" . htmlspecialchars($row['sacrament']) . "</h3>";
    echo "<p style='margin: 5px 0; font-weight: 600; color: #1e293b;'>Name: " . htmlspecialchars($row['child_name']) . "</p>";
    echo "<p style='margin: 5px 0; color: #475569;'>Date of Birth: " . htmlspecialchars($row['dob']) . "</p>";
    echo "<a href='" . htmlspecialchars($actionUrl) . "' style='display: inline-block; margin-top: 10px; background-color:rgb(55, 56, 58); color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; box-shadow: 0 2px 6px rgba(15, 15, 16, 0.5); transition: background-color 0.3s ease;'>View Details</a>";
    echo "</div>";
}

echo "</div>";
?>
