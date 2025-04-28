<?php
include 'db_config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || intval($_GET['id']) <= 0) {
    echo "Invalid ID.";
    exit;
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Convert godparents array to comma-separated string if godparents are submitted as array
    $godparentsStr = '';
    if (isset($_POST['godparents'])) {
        if (is_array($_POST['godparents'])) {
            $godparentsStr = implode(',', array_map('trim', $_POST['godparents']));
        } else {
            $godparentsStr = trim($_POST['godparents']);
        }
    }

    $data = [
        'child_name' => $_POST['child_name'],
        'dob' => $_POST['dob'],
        'birth_place' => $_POST['birth_place'],
        'gender' => $_POST['gender'],
        'father_name' => $_POST['father_name'],
        'mother_name' => $_POST['mother_name'],
        'address' => $_POST['address'],
        'contact' => $_POST['contact'],
        'godparents' => $godparentsStr,
        'confirmation_date' => $_POST['confirmation_date'],
        'confirmation_time' => $_POST['confirmation_time'],
        'priest_name' => $_POST['priest_name'],
        'id' => $id
    ];

    $stmt = $pdo->prepare("UPDATE confirmation_records SET child_name = :child_name, dob = :dob, birth_place = :birth_place, gender = :gender, father_name = :father_name, mother_name = :mother_name, address = :address, contact = :contact, godparents = :godparents, confirmation_date = :confirmation_date, confirmation_time = :confirmation_time, priest_name = :priest_name WHERE id = :id");
    $stmt->execute($data);
    header("Location: confirmation_records.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM confirmation_records WHERE id = ?");
$stmt->execute([$id]);
$record = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Confirmation Edit Form</title>
    <link rel="stylesheet" href="baptism.css" />
</head>
<body>
    <div class="form-container">
        <header>
            <h2>CONFIRMATION EDIT FORM</h2>
            <button class="btn btn-secondary go-back" onclick="window.location.href='confirmation_records.php'" style="position: fixed; top: 15px; left: 15px; z-index: 1050; background-color: green; border-color: gray; color: white;">Go Back</button>
        </header>
        <form method="POST">
            <div class="church-info">
                <label>Church:</label>
                <input type="text" value="SAINT MICHAEL THE ARCHANGEL PARISH" readonly />
            </div>
            <div class="section">
                <h3>CHILD'S INFORMATION</h3>
                <label>Full Name:</label>
                <input type="text" name="child_name" value="<?= htmlspecialchars($record['child_name']) ?>" required />
                <label>Date of Birth:</label>
                <input type="date" name="dob" value="<?= htmlspecialchars($record['dob']) ?>" required />
                <label>Place of Birth:</label>
                <input type="text" name="birth_place" value="<?= htmlspecialchars($record['birth_place']) ?>" required />
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="">Select</option>
                    <option value="Male" <?= $record['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $record['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="section">
                <h3>PARENT'S INFORMATION</h3>
                <label>Father's Full Name:</label>
                <input type="text" name="father_name" value="<?= htmlspecialchars($record['father_name']) ?>" required />
                <label>Mother's Maiden Name:</label>
                <input type="text" name="mother_name" value="<?= htmlspecialchars($record['mother_name']) ?>" required />
                <label>Address:</label>
                <input type="text" name="address" value="<?= htmlspecialchars($record['address']) ?>" required />
                <label>Contact No.:</label>
                <input type="text" name="contact" value="<?= htmlspecialchars($record['contact']) ?>" required />
            </div>
            <div class="section">
                <h3>GODPARENTS (SPONSORS)</h3>
                <small>Click "Add Godparent" to add or Remove Godparent fields.</small>
                <div id="godparents-container">
                    <div class="godparent-input-wrapper">
                        <input type="text" name="godparents[]" required placeholder="Enter Godparent Name" />
                    </div>
                </div>
                <button type="button" id="add-godparent-btn" class="add-godparent-btn">Add Godparent</button>
            </div>
            <div class="section">
                <h3>CONFIRMATION DETAIL</h3>
                <label>Date of Confirmation:</label>
                <input type="date" name="confirmation_date" value="<?= htmlspecialchars($record['confirmation_date']) ?>" required />
                <label>Time:</label>
                <input type="time" name="confirmation_time" value="<?= htmlspecialchars($record['confirmation_time']) ?>" required />
                <label>Confirming Priest:</label>
                <input type="text" name="priest_name" value="<?= htmlspecialchars($record['priest_name']) ?>" required />
            </div>
            <div class="button-container">
                <button type="submit" class="register-btn" style="background-color: #FFD700; color: black; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); border: 2px solid #bfa500;">Update</button>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('add-godparent-btn');
        const container = document.getElementById('godparents-container');

        function updateRemoveButtons() {
            const removeButtons = container.querySelectorAll('.remove-godparent-btn');
            removeButtons.forEach((btn, index) => {
                btn.style.display = container.children.length > 1 ? 'inline' : 'none';
            });
        }

        addBtn.addEventListener('click', function() {
            const wrapper = document.createElement('div');
            wrapper.className = 'godparent-input-wrapper';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'godparents[]';
            input.placeholder = 'Enter Godparent Name';
            input.required = true;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-godparent-btn';
            removeBtn.title = 'Remove Godparent';
        removeBtn.innerHTML = 'Remove';
            removeBtn.style.marginLeft = '10px';

            removeBtn.addEventListener('click', () => {
                wrapper.remove();
                updateRemoveButtons();
            });

            wrapper.appendChild(input);
            wrapper.appendChild(removeBtn);
            container.appendChild(wrapper);

            updateRemoveButtons();
        });

        // Add remove button event to existing inputs
        container.querySelectorAll('.remove-godparent-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.target.parentElement.remove();
                updateRemoveButtons();
            });
        });

        updateRemoveButtons();
    });
</script>
</body>
</html>
