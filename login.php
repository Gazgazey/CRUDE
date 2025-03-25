<?php
session_start(); // Start session at the very top

require_once("config.php");

$message = ""; // Default message variable

// If user is already logged in, redirect to timeline
if (isset($_SESSION["user_id"])) {
    header("Location: timeline.php");
    exit();
}

// Check if form was submitted
if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Prepare query
    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify password
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"]; // Store only user ID
            $_SESSION["user"] = $user;

            header("Location: timeline.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VANQ Auto Parts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #222;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }
        .login-container {
            background: #333;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .form-control {
            background-color: #444;
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 10px;
            color: #ff4d4d;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="mb-3">Login to VANQ</h2>
        <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username or Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <a href="register.php" class="d-block mt-3 text-light">Create an Account</a>
    </div>
</body>
</html>
