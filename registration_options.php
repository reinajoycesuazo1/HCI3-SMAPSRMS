<?php
session_start();
?>

<div class="registration-modal">
    <div class="registration-header">
        <h2>Registration Options</h2>
        <span class="close-btn" onclick="window.location.href='homepage.php'">&times;</span>
    </div>
    <div class="registration-body">
        <div class="reg-options-grid">
            <a class="reg-option-link" href="baptismReg.php">Baptism</a>
            <a class="reg-option-link" href="confirmationReg.php">Confirmation</a>
            <a class="reg-option-link" href="communionReg.php">Communion</a>
            <a class="reg-option-link" href="marriageReg.php">Marriage</a>
        </div>
    </div>
</div>

<style>
    .registration-modal {
        max-width: 500px;
        margin: 40px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        padding: 20px;
        font-family: Arial, sans-serif;
    }
    .registration-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid rgb(42, 44, 42);
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .registration-header h2 {
        margin: 0;
        color: rgb(36, 37, 36);
        font-weight: bold;
        font-size: 1.5rem;
    }
    .close-btn {
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
        color: #888;
        transition: color 0.3s ease;
    }
    .close-btn:hover {
        color: rgb(209, 11, 11);
    }
    .registration-body {
        display: flex;
        justify-content: center;
    }
    .reg-options-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        width: 100%;
    }
    .reg-option-link {
        display: block;
        padding: 20px;
        font-size: 1.2rem;
        font-weight: bold;
        border: 2px solidrgb(76, 129, 175);
        border-radius: 8px;
        background-color: rgb(49, 51, 49);
        color: white;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        cursor: pointer;
    }
    .reg-option-link:hover {
        background-color: rgb(87, 92, 87);
        border-color: rgb(36, 150, 36);
    }
</style>
