<?php
session_start();
include 'db_config.php'; // This should define $pdo
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Baptismal Records</title>
    <link rel="stylesheet" href="communion.css" />
</head>
<body>
    <div class="form-container">
        <header>
            <h2>BAPTISMAL RECORDS</h2>
           
            
        </header>

        <table class="records-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $pdo->query("SELECT id, child_name, baptism_date FROM baptismal_records ORDER BY baptism_date DESC");
                    $records = $stmt->fetchAll();
                    $count = 1;

                    if ($records) {
                        foreach ($records as $row) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['child_name']) . "</td>";
                            echo "<td>" . date('m/d/Y', strtotime($row['baptism_date'])) . "</td>";
                            echo "<td class='action-buttons'>
                                    <a href='baptismView.php?id={$row['id']}' class='btn view-btn'>View</a>
                                    <a href='baptismEdit.php?id={$row['id']}' class='btn edit-btn'>Edit</a>
                                    <a href='baptismDelete.php?id={$row['id']}' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                                    <a href='baptismCert.php?id={$row['id']}&type=baptism' class='btn print-btn' target='_blank'>Print</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='4'>Error fetching records: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; gap: 10px;">
            <button class="btn go-back" onclick="window.location.href='homepage.php'" style="background-color:rgb(12, 165, 61); color: white; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                Go Back
            </button>
            <a href="baptismReg.php" class="btn add-btn" style="background-color:rgb(150, 76, 175); color: white; border-radius: 5px; padding: 10px 20px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background-color 0.3s ease;">
                Add New Record
            </a>
        </div>
    </div>
</body>
</html>
