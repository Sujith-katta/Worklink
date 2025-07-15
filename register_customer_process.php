<?php
session_start();
require 'db.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$gender = $_POST['gender'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];

$_SESSION['form_data'] = $_POST;

if (empty($name)) $errors[] = "Name is required";
if (empty($email)) $errors[] = "Email is required";
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
if (!in_array($gender, ['male', 'female', 'others'])) $errors[] = "Invalid gender selected";
if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters long";

// Check for duplicate email
if (empty($errors)) {
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $errors[] = "This email is already registered.";
    }
    $check->close();
}

if (empty($errors)) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, gender, email, password, role) VALUES (?, ?, ?, ?, 'customer')");
    $stmt->bind_param("ssss", $name, $gender, $email, $password_hash);

    if ($stmt->execute()) {
        $_SESSION['registration_success'] = true;
        unset($_SESSION['form_data']);
        header('Location: registration_success.php');
        exit;
    } else {
        $errors[] = "Database error: " . $conn->error;
    }
}

$_SESSION['errors'] = $errors;
header('Location: register_customer.php');
exit;
