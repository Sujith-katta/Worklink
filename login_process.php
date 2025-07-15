<?php
session_start();
require 'db.php';

$name = trim($_POST['name'] ?? '');
$password = $_POST['password'] ?? '';
$errors = [];

if (empty($name)) $errors[] = "Name is required";
if (empty($password)) $errors[] = "Password is required";

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: login.php');
    exit;
}

// Make case-insensitive query
$stmt = $conn->prepare("SELECT * FROM users WHERE LOWER(name) = LOWER(?)");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];

        // Redirect based on role
        if ($user['role'] === 'worker') {
            header("Location: worker_dashboard.php");
        } elseif ($user['role'] === 'customer') {
            header("Location: customer_search.php");
        }
        exit;
    }
}

// If login fails
$_SESSION['errors'] = ["Invalid name or password"];
header("Location: login.php");
exit;
