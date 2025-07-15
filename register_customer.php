<?php
session_start();
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Registration</title>
    <style>
        body { font-family: Arial; background-color: #f2f2f2; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 400px; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;
        }
        .gender-options { margin-top: 10px; }
        .gender-options label { font-weight: normal; margin-right: 15px; }
        .error { color: red; margin-top: 10px; }
        small#passwordHint { display: block; margin-top: 5px; color: #d00; }
        button {
            background: #4663e4; color: white; padding: 10px 20px; border: none;
            border-radius: 5px; margin-top: 20px; cursor: pointer; width: 100%;
        }
    </style>
</head>
<body>
    <form method="POST" action="register_customer_process.php">
        <h2>Customer Registration</h2>

        <?php
        if (isset($_SESSION['errors'])) {
            echo '<div class="error">' . implode("<br>", $_SESSION['errors']) . '</div>';
            unset($_SESSION['errors']);
        }
        ?>

        <label>Name:</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($form_data['name'] ?? '') ?>">

        <label>Email:</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($form_data['email'] ?? '') ?>">

        <label>Gender:</label>
        <div class="gender-options">
            <input type="radio" name="gender" value="male" required <?= ($form_data['gender'] ?? '') === 'male' ? 'checked' : '' ?>> Male
            <input type="radio" name="gender" value="female" <?= ($form_data['gender'] ?? '') === 'female' ? 'checked' : '' ?>> Female
            <input type="radio" name="gender" value="others" <?= ($form_data['gender'] ?? '') === 'others' ? 'checked' : '' ?>> Others
        </div>

        <label>Password:</label>
        <input type="password" name="password" id="password" required minlength="8">
        <small id="passwordHint"></small>

        <button type="submit">Register</button>
    </form>

    <script>
    const passwordInput = document.getElementById('password');
    const hint = document.getElementById('passwordHint');

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;

        if (value.length < 8) {
            hint.textContent = "Password must be at least 8 characters long.";
        } else if (!/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/.test(value)) {
            hint.textContent = "Use letters + numbers. Try: sujith@9900";
        } else {
            hint.textContent = "";
        }
    });
    </script>
</body>
</html>
