<?php
// Start session
session_start();

// 1. Check if User is Logged In and is Worker
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'worker') {
    header('Location: login.php');
    exit();
}

// 2. Connect to Database
include 'db.php';

// 3. Get Worker Details
$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle contact form submission
if (isset($_POST['send_message'])) {
    $customer_id = $_SESSION['id']; // current logged in customer
    $message = $_POST['message'];

    // Insert message into messages table
    $message_sql = "INSERT INTO messages (worker_id, customer_id, message, timestamp)
                    VALUES ('$id', '$customer_id', '$message', NOW())";

    if (mysqli_query($conn, $message_sql)) {
        echo "<p>Message sent successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Worker Profile</title>
    <link rel="stylesheet" href="css/style.css"> <!-- optional -->
</head>
<body>

    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>

    <h3>Your Profile Details:</h3>
    <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
    <p><strong>Experience:</strong> <?php echo htmlspecialchars($user['experience']); ?> years</p>
    <p><strong>Place:</strong> <?php echo htmlspecialchars($user['place']); ?></p>
    <p><strong>Capacity (sq ft):</strong> <?php echo htmlspecialchars($user['capacity']); ?></p>
    <p><strong>Work Type:</strong> <?php echo htmlspecialchars($user['work_type']); ?></p>
    <p><strong>Rating:</strong> <?php echo htmlspecialchars($user['rating']); ?> ⭐</p>

    <?php
    if (!empty($user['images'])) {
        $images = explode(",", $user['images']);
        echo "<h3>Work Images:</h3>";
        foreach ($images as $img) {
            echo "<img src='uploads/$img' alt='Work Image' style='width:150px;height:150px;margin:10px;'>";
        }
    }
    ?>

    <!-- Contact Form for Customer -->
    <h3>Contact this Worker:</h3>
    <form method="POST">
        <textarea name="message" required placeholder="Write your message here..." rows="4" cols="50"></textarea><br><br>
        <button type="submit" name="send_message">Send Message</button>
    </form>

    <br><br>
    <a href="logout.php">Logout</a>

</body>
</html>
