<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    exit("Access denied.");
}

$host = "localhost";
$db_name = "pesbuk";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Default fetch mode
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
