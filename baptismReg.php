<?php
session_start();
include 'db_config.php'; // Connect to sacramental_records DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_name = $_POST['child_name'];
    $dob = $_POST['dob'];
    $birth_place = $_POST['birth_place'];
    $gender = $_POST['gender'];
    $baptism_date = $_POST['baptism_date'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $address = $_POST['address'];
    $godparents = $_POST['godparents'];
    $priest_name = $_POST['priest_name'];
    $baptism_time = $_POST['baptism_time'];

    $sql = "INSERT INTO baptismal_records 
        (child_name, dob, birth_place, gender,baptism_date, father_name, mother_name, address, godparents, priest_name, baptism_time)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss",$child_name, $dob, $birth_place, $gender,$baptism_date,  $father_name, $mother_name, $address, $godparents, $priest_name, $baptism_time);

    if ($stmt->execute()) {
        echo "<h2>✅ Communion registration successful!</h2>";
        echo "<a href='baptismalRec.php'>Register another</a>";
    } else {
        echo "<h2>❌ Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baptismal Registration Form</title>
    <link rel="stylesheet" href="baptism.css">
</head>
<body>

    <div class="form-container">
        <header>
            <h2>BAPTISMAL REGISTRATION FORM</h2>
            <button class="btn btn-secondary go-back" onclick="window.location.href='homepage.php'" style="position: fixed; top: 15px; left: 15px; z-index: 1050; background-color: green; border-color: gray; color: white;">Go Back</button>
        </header>

        <form action="baptismal_submit.php" method="POST">
            <div class="church-info">
                <label>Church:</label>
                <input type="text" value="SAINT MICHAEL THE ARCHANGEL PARISH" readonly>
            </div>

            <div class="section">
                <h3>CHILD'S INFORMATION</h3>
                <label>Full Name:</label>
                <input type="text" name="child_name" required>

                <label>Date of Birth:</label>
                <input type="date" name="dob" required>

                <label>Place of Birth:</label>
                <input type="text" name="birth_place" required>

                <label>Gender:</label>
                <select name="gender" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="section">
                <h3>PARENT'S INFORMATION</h3>
                <label>Father's Full Name:</label>
                <input type="text" name="father_name" required>

                <label>Mother's Maiden Name:</label>
                <input type="text" name="mother_name" required>

                <label>Address:</label>
                <input type="text" name="address" required>

                <label>Contact No.:</label>
                <input type="text" name="contact" required>
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
                <h3>BAPTISM DETAIL</h3>
                <label>Date of Baptism:</label>
                <input type="date" name="baptism_date" required>

                <label>Time:</label>
                <input type="time" name="baptism_time" required>

                <label>Baptizing Priest:</label>
                <input type="text" name="priest_name" required>
            </div>

            <div class="button-container">
                <button type="submit" class="register-btn">Register</button>
            </div>
        </form>

        <footer>
            <p>Copyright &copy; SMAP 2025. smap.com. All Rights Reserved | <a href="#">Privacy Policy</a></p>
        </footer>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.getElementById('add-godparent-btn');
    const container = document.getElementById('godparents-container');

    function updateRemoveButtons() {
        const removeButtons = container.querySelectorAll('.remove-godparent-btn');
        removeButtons.forEach((btn, index) => {
            btn.style.display = container.children.length > 1 ? 'inline-block' : 'none';
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
        removeBtn.style.marginLeft = '5px';

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
