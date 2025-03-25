<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: timeline.php");
    exit;
}

require_once("config.php");

if(isset($_POST['register'])){
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    $check_sql = "SELECT COUNT(*) FROM users WHERE username = :username";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->execute([':username' => $username]);
    $user_exists = $check_stmt->fetchColumn();

    if ($user_exists) {
        $message = "Username already taken. Please choose another one.";
    } else {

        $sql = "INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)";
        $stmt = $db->prepare($sql);


        $params = array(
            ":name" => $name,
            ":username" => $username,
            ":password" => $password,
            ":email" => $email
        );


        $saved = $stmt->execute($params);


        if($saved) {
            $message = "Account successfully created! You can now log in.";
        } else {
            $message = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VANQ Auto Parts</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Rajdhani', sans-serif;
            margin: 0;
            padding: 0;
            background: #222;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .register-container {
            background: #333;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 90%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .register-container h2 {
            color: #007bff;
            margin-bottom: 1.5rem;
        }
        .register-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .register-form input {
            width: 100%;
            max-width: 350px;
            padding: 12px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            text-align: center;
        }
        .register-form button {
            width: 100%;
            max-width: 350px;
            padding: 12px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 15px;
        }
        .register-form button:hover {
            background: #0056b3;
        }
        .register-container a {
            display: block;
            margin-top: 15px;
            color: #ddd;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .register-container a:hover {
            color: #007bff;
        }
        .back-home {
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
        }
        .back-home:hover {
            color: #0056b3;
        }
        .message {
            margin-top: 10px;
            color: #28a745;
            font-weight: bold;
        }
        @media (max-width: 480px) {
            .register-container {
                padding: 1.5rem;
            }
            .register-form input, .register-form button {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create an Account</h2>
        <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>
        <form class="register-form" action="" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
    <a href="index.php" class="back-home">← Back to Home</a>
</body>
</html>
