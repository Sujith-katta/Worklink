<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial; background-color: #f2f2f2; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 400px; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;
        }
        .error { color: red; margin-top: 10px; }
        button { background: #4663e4; color: white; padding: 10px 20px; border: none; border-radius: 5px; margin-top: 20px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <form method="POST" action="login_process.php">
        <h2>Login</h2>

        <?php
        if (isset($_SESSION['errors'])) {
            echo '<div class="error">' . implode("<br>", $_SESSION['errors']) . '</div>';
            unset($_SESSION['errors']);
        }
        ?>

        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>
