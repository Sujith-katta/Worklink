<?php
require 'db.php';

$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$work_type = $_POST['work_type'] ?? '';
$capacity = $_POST['capacity'] ?? '';
$place = $_POST['place'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];

// Validate required fields
if (!$name || !$age || !$gender || !$phone || !$email || !$work_type || !$capacity || !$place || !$password) {
    die("Please fill in all required fields.");
}

// Check if email already exists
$email_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$email_check->bind_param("s", $email);
$email_check->execute();
$email_check->store_result();
if ($email_check->num_rows > 0) {
    die("<div class='error'>This email is already registered. Please use another email.</div>");
}
$email_check->close();

// Handle profile photo upload
$profile_photo = $_FILES['profile_photo'];
$profile_path = '';
if ($profile_photo['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($profile_photo['name'], PATHINFO_EXTENSION);
    $profile_path = 'uploads/profile_' . time() . '.' . $ext;
    move_uploaded_file($profile_photo['tmp_name'], $profile_path);
}

// Handle multiple work images
$work_images = $_FILES['work_images'];
$work_paths = [];
foreach ($work_images['tmp_name'] as $index => $tmpName) {
    if ($work_images['error'][$index] === UPLOAD_ERR_OK) {
        $ext = pathinfo($work_images['name'][$index], PATHINFO_EXTENSION);
        $work_file = 'uploads/work_' . time() . '_' . $index . '.' . $ext;
        move_uploaded_file($tmpName, $work_file);
        $work_paths[] = $work_file;
    }
}
$serialized_images = serialize($work_paths);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Store in database
$stmt = $conn->prepare("INSERT INTO users 
(name, age, gender, phone, email, work_type, capacity, profile_photo, work_images, password, role, place) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'worker', ?)");

$stmt->bind_param(
    "sisssssssss",
    $name, $age, $gender, $phone, $email, $work_type,
    $capacity, $profile_path, $serialized_images, $password_hash, $place
);

if ($stmt->execute()) {
    echo "<div class='success'>Worker registered successfully.</div>";
} else {
    echo "<div class='error'>Error: " . $stmt->error . "</div>";
}
?>
