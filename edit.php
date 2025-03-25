<?php
session_start();
require_once 'config.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

try {
    // Fetch the existing part details
    $stmt = $db->prepare("SELECT * FROM parts WHERE id = :id AND user_id = :user_id");
    $stmt->execute([':id' => $id, ':user_id' => $user_id]);
    $part = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$part) {
        die("Part not found or unauthorized access.");
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $manufacturer = $_POST['manufacturer'];
    $part_number = $_POST['part_number'];
    $quantity = $_POST['quantity'];
    $orientation = $_POST['orientation'];

    try {
        $query = "UPDATE parts SET manufacturer = :manufacturer, part_number = :part_number, 
                  quantity = :quantity, orientation = :orientation WHERE id = :id AND user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':manufacturer' => $manufacturer,
            ':part_number' => $part_number,
            ':quantity' => $quantity,
            ':orientation' => $orientation,
            ':id' => $id,
            ':user_id' => $user_id
        ]);

        header("Location: Parts-Request.php?msg=updated");
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Part | VANQ Auto Parts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap');
        body {
            font-family: 'Rajdhani', sans-serif;
            background: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background: #222;
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #007bff;
        }
        .brand h1 {
            margin: 0;
            font-size: 3.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #007bff;
        }
        .auth-buttons a {
            background: #dc3545;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }
        .auth-buttons a:hover {
            background: #a71d2a;
            transform: scale(1.08);
        }
        .container {
            max-width: 1400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 90%;
        }
        footer {
            background: #515151;
            color: white;
            text-align: center;
            font-size: 0.7rem;
            padding: 1rem 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <h1>VANQ</h1>
            <span>Auto Parts</span>
        </div>
        <div class="auth-buttons">
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div class="container mt-4">
        <h2>Edit Part</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Car Manufacturer</label>
                <input type="text" name="manufacturer" class="form-control" value="<?= htmlspecialchars($part['manufacturer']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Part Number</label>
                <input type="text" name="part_number" class="form-control" value="<?= htmlspecialchars($part['part_number']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($part['quantity']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Orientation</label>
                <select name="orientation" class="form-control" required>
                    <option value="Performance" <?= $part['orientation'] == 'Performance' ? 'selected' : '' ?>>Performance</option>
                    <option value="Heavy Duty" <?= $part['orientation'] == 'Heavy Duty' ? 'selected' : '' ?>>Heavy Duty</option>
                    <option value="OEM" <?= $part['orientation'] == 'OEM' ? 'selected' : '' ?>>OEM</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="Parts-Request.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 VANQ Auto Parts. All rights reserved.</p>
    </footer>
</body>
</html>
