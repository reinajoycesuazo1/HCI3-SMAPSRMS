<?php
session_start();
include 'db_config.php'; // This should define $pdo
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Marriage Records</title>
    <link rel="stylesheet" href="communion.css" />
</head>
<body>
    <div class="form-container">
        <header>
            <h2>MARRIAGE RECORDS</h2>
        </header>

        <table class="records-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Groom</th>
                    <th>Bride</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $pdo->query("SELECT id, groom_name, bride_name, marriage_date FROM marriage_records ORDER BY marriage_date DESC");
                    $records = $stmt->fetchAll();
                    $count = 1;

                    if ($records) {
                        foreach ($records as $row) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['groom_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['bride_name']) . "</td>";
                            echo "<td>" . date('m/d/Y', strtotime($row['marriage_date'])) . "</td>";
                            echo "<td class='action-buttons'>
                                    <a href='marriageView.php?id={$row['id']}' class='btn view-btn'>View</a>
                                    <a href='marriageEdit.php?id={$row['id']}' class='btn edit-btn'>Edit</a>
                                    <a href='marriageDelete.php?id={$row['id']}' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
<!-- Print action removed as requested -->
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='5'>Error fetching records: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; gap: 10px;">
            <button class="btn go-back" onclick="window.location.href='homepage.php'" style="background-color:rgb(12, 165, 61); color: white; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                Go Back
            </button>
            <a href="marriageReg.php" class="btn add-btn" style="background-color:rgb(150, 76, 175); color: white; border-radius: 5px; padding: 10px 20px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                Add New Record
            </a>
        </div>
    </div>
</body>
</html>
