<?php

require_once("auth.php");

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database Connection (Fix credentials!) should be linked to config.php but......
$host = "localhost";
$dbname = "pesbuk";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM parts WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUDE System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap');
        body {
            font-family: 'Rajdhani', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: #333;
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

        /* Floating Menu */
        .floating-menu {
            position: fixed;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background: #222;
            display: flex;
            justify-content: space-between;
            padding: 8px;
            border-radius: 1.5rem;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
            width: 60%;
            transition: transform 0.3s ease-in-out;
        }
        .floating-menu a {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            padding: 6px 10px;
            border-radius: 1.5rem;
            transition: background 0.3s;
            flex: 1;
            text-align: center;
            margin: 0 7px;
        }
        .floating-menu a.active, .floating-menu a:hover {
            background: #007bff;
        }

        /* Hidden State */
        .floating-menu.hidden {
            transform: translateX(-50%) translateY(135%); /* Move menu down */
        }

        /* Visible Tab to Toggle Menu */
        .menu-tab {
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 6px;
            background: #007bff;
            border-radius: 3px;
            cursor: pointer;
        }
        footer {
            background: #515151;
            color: white;
            text-align: center;
            font-size: 0.7rem;
            padding: 0em;
            margin-top: 2%;
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

    <!-- Floating Menu -->
    <div class="floating-menu">
        <div class="menu-tab"></div>
        <a href="timeline.php">Homepage</a>
        <a href="Parts-Request.php" class="active">Parts Request</a>
        <a href="creator.php">Creator</a>
        <a href="Location.php">Location</a>
    </div>

    <div class="container mt-4" style="flex-grow: 1;">
        <h2>CRUDE System</h2>

        <form method="POST" action="proces.php">
            <input type="hidden" name="id" id="id">

            <div class="mb-3">
                <label class="form-label">Car Manufacturer</label>
                <input type="text" name="manufacturer" id="manufacturer" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Part Number</label>
                <input type="text" name="part_number" id="part_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Orientation</label>
                <select name="orientation" id="orientation" class="form-select" required>
                    <option value="Performance">Performance</option>
                    <option value="Heavy Duty">Heavy Duty</option>
                    <option value="OEM">OEM</option>
                </select>
            </div>

            <button type="submit" name="save" class="btn btn-primary">Save</button>
        </form>

        <hr>

        <h3>Parts List</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Car Manufacturer</th>
                    <th>Part Number</th>
                    <th>Quantity</th>
                    <th>Orientation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['manufacturer']) ?></td>
                        <td><?= htmlspecialchars($row['part_number']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                        <td><?= htmlspecialchars($row['orientation']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
        // Get the floating menu and tab
        const menu = document.querySelector('.floating-menu');
        const menuTab = document.querySelector('.menu-tab');

        // make menu visible when the page loads
        menu.classList.remove('hidden');

        // Toggle menu visibility when clicking the tab
        menuTab.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

    <footer>
        <p>&copy; 2025 VANQ Auto Parts. All rights reserved. Your trusted partner for high-performance auto upgrades and custom modifications.</p>
    </footer>

</body>
</html>
