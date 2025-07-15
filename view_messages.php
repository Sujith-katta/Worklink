<?php
// Start session
session_start();

// 1. Check if Worker is Logged In
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'worker') {
    header('Location: login.php');
    exit();
}

// 2. Connect to Database
include 'db.php';

// 3. Get Worker ID
$worker_id = $_SESSION['id'];

// Handle Reply Submission
if (isset($_POST['send_reply'])) {
    $message_id = $_POST['message_id'];
    $reply_message = $_POST['reply_message'];
    $customer_id = $_POST['customer_id'];

    // Insert Reply into messages table with reference to the original message
    $reply_sql = "INSERT INTO messages (worker_id, customer_id, message, timestamp, reply_to)
                  VALUES ('$worker_id', '$customer_id', '$reply_message', NOW(), '$message_id')";

    if (mysqli_query($conn, $reply_sql)) {
        echo "<p>Reply sent successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}

// 4. Fetch All Messages for this Worker
$sql = "SELECT * FROM messages WHERE worker_id='$worker_id' ORDER BY timestamp DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link rel="stylesheet" href="css/style.css"> <!-- optional -->
</head>
<body>

    <h1>Your Messages</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <ul>
            <?php while ($message = mysqli_fetch_assoc($result)): ?>
                <li>
                    <h3>From Customer ID: <?php echo htmlspecialchars($message['customer_id']); ?></h3>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars($message['message']); ?></p>
                    <p><small>Received on: <?php echo htmlspecialchars($message['timestamp']); ?></small></p>

                    <!-- Display All Replies Under the Original Message -->
                    <?php
                    // Fetch replies for this message
                    $replies_sql = "SELECT * FROM messages WHERE reply_to='" . $message['id'] . "' ORDER BY timestamp ASC";
                    $replies_result = mysqli_query($conn, $replies_sql);
                    if (mysqli_num_rows($replies_result) > 0):
                        while ($reply = mysqli_fetch_assoc($replies_result)): ?>
                            <div style="margin-left: 20px; border-left: 2px solid #ccc; padding-left: 10px;">
                                <p><strong>Reply from Worker:</strong> <?php echo htmlspecialchars($reply['message']); ?></p>
                                <p><small>Replied on: <?php echo htmlspecialchars($reply['timestamp']); ?></small></p>
                            </div>
                        <?php endwhile;
                    endif;
                    ?>

                    <!-- Display Reply Form Only for Unreplied Messages -->
                    <?php if ($message['reply_to'] == NULL): // Only allow reply to messages that haven't been replied to ?>
                        <h4>Reply to this message:</h4>
                        <form method="POST">
                            <textarea name="reply_message" required placeholder="Write your reply here..." rows="4" cols="50"></textarea><br><br>
                            <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                            <input type="hidden" name="customer_id" value="<?php echo $message['customer_id']; ?>">
                            <button type="submit" name="send_reply">Send Reply</button>
                        </form>
                    <?php endif; ?>

                    <hr>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>You have no messages yet.</p>
    <?php endif; ?>

    <br><br>
    <a href="worker_profile.php">Back to Profile</a> | <a href="logout.php">Logout</a>

</body>
</html>
