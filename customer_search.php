<?php
session_start();
require 'db.php';

$work_type = $_GET['work_type'] ?? '';
$place = $_GET['place'] ?? '';
$workers = [];

if ($work_type || $place) {
    $query = "SELECT * FROM users WHERE role='worker'";
    $params = [];
    $types = '';

    if ($work_type) {
        $query .= " AND work_type = ?";
        $types .= 's';
        $params[] = $work_type;
    }

    if ($place) {
        $query .= " AND place LIKE ?";
        $types .= 's';
        $params[] = "%$place%";
    }

    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $workers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Workers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ddd;
            padding: 20px;
        }
        .search-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 30px;
        }
        input, select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 16px;
            border: none;
            background-color: #2d89ef;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .results {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            width: 280px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .info {
            margin: 10px 0;
            text-align: left;
        }
        .info p {
            margin: 4px 0;
        }
        textarea {
            width: 100%;
            border-radius: 5px;
            padding: 5px;
            resize: none;
        }
    </style>
</head>
<body>
    <h2>Search for Workers</h2>
    <form class="search-box" method="get" action="">
        <label>Work Type:
            <select name="work_type">
                <option value="">-- Select --</option>
                <option value="Electrician" <?= $work_type == 'Electrician' ? 'selected' : '' ?>>Electrician</option>
                <option value="Plumber" <?= $work_type == 'Plumber' ? 'selected' : '' ?>>Plumber</option>
                <option value="Carpenter" <?= $work_type == 'Carpenter' ? 'selected' : '' ?>>Carpenter</option>
                <option value="Mechanic" <?= $work_type == 'Mechanic' ? 'selected' : '' ?>>Mechanic</option>
                <!-- Add more types -->
            </select>
        </label>
        <label>Place:
            <input type="text" name="place" value="<?= htmlspecialchars($place) ?>">
        </label>
        <button type="submit">Search</button>
    </form>

    <h3>Search Results:</h3>
    <div class="results">
        <?php if (empty($workers)): ?>
            <p>No workers found.</p>
        <?php else: ?>
            <?php foreach ($workers as $worker): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($worker['profile_photo']) ?>" alt="Profile">
                    <h4><?= htmlspecialchars($worker['name']) ?></h4>
                    <p>(<?= htmlspecialchars($worker['work_type']) ?>)</p>
                    <div class="info">
                        <p>Age: <?= $worker['age'] ?></p>
                        <p>Gender: <?= $worker['gender'] ?></p>
                        <p>📞 <?= $worker['phone'] ?></p>
                        <p>📧 <?= $worker['email'] ?></p>
                        <p>📍 <?= $worker['place'] ?></p>
                    </div>
                    <label>Message:
                        <textarea rows="2" placeholder="Write your message..."></textarea>
                    </label>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
