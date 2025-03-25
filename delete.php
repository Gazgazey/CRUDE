<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    try {
        $query = "DELETE FROM parts WHERE id = :id AND user_id = :user_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':user_id' => $user_id
        ]);
        
        header("Location: Parts-Request.php");
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
