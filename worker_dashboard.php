<?php
session_start();

// Ensure only logged-in workers can access
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'worker') {
    header('Location: login.php');
    exit();
}

// Include DB connection
include 'db.php';

// Get worker details
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$worker = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Worker Dashboard</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Optional -->
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($worker['name']) ?>!</h1>
    <p><strong>Email:</strong> <?= htmlspecialchars($worker['email']) ?></p>
    <p><strong>Work Type:</strong> <?= htmlspecialchars($worker['work_type']) ?></p>
    <p><strong>Place:</strong> <?= htmlspecialchars($worker['place']) ?></p>

    <a href="view_messages.php">View Messages</a> |
    <a href="logout.php">Logout</a>
</body>
</html>
