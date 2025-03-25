<?php
require_once 'config.php';

// Ensure session is started only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    $manufacturer = isset($_POST['manufacturer']) ? $_POST['manufacturer'] : null;
    $part_number = isset($_POST['part_number']) ? $_POST['part_number'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    $orientation = isset($_POST['orientation']) ? $_POST['orientation'] : null;

    try {
        if (isset($_POST['save'])) {
            $query = "INSERT INTO parts (manufacturer, part_number, quantity, orientation, user_id) 
                      VALUES (:manufacturer, :part_number, :quantity, :orientation, :user_id)";
        } elseif (isset($_POST['update'])) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $query = "UPDATE parts SET manufacturer=:manufacturer, part_number=:part_number, 
                      quantity=:quantity, orientation=:orientation 
                      WHERE id=:id AND user_id=:user_id";
        } else {
            die("Invalid request.");
        }

        $stmt = $db->prepare($query);
        $stmt->execute([
            ':manufacturer' => $manufacturer,
            ':part_number' => $part_number,
            ':quantity' => $quantity,
            ':orientation' => $orientation,
            ':user_id' => $user_id
        ]);

        header("Location: Parts-request.php");
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Invalid request method.");
}
?>
