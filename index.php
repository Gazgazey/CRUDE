<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: timeline.php");
    exit();
}
require_once("config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANQ Auto Parts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap');

        body {
            font-family: 'Rajdhani', sans-serif;
            background: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background: #222;
            padding: 1rem;
        }
        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff !important;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .navbar-toggler {
            border: none;
        }
        .btn-auth {
        background: #007bff;
        color: white;
        font-weight: bold;
        padding: 0.4rem 0.8rem; /* Thinner button */
        font-size: 0.85rem;
        border-radius: 4px;
        position: absolute;
        top: 1.8rem; /* Push to the top */
        right: 2rem; /* Push to the right corner */
        transition: 0.3s;
        }

        .btn-auth:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
        .product-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            border: 2px solid #007bff;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.6);
        }
        .container {
            flex-grow: 1; /* Pushes footer to bottom */
        }
        .tech-info {
            background: #eef5ff;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .tech-info h3 {
            color: #007bff;
        }
        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 1rem 0;
            border-top: 3px solid #007bff;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">VANQ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <a href="login.php" class="btn btn-auth">Login</a>
        </div>
    </div>
</nav>


<!-- Products Section -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row g-4">
        <?php
        $products = [
            "Brake Pads" => "High-performance brake pads.",
            "Oil Filters" => "Premium oil filters.",
            "Suspension Kits" => "Durable suspension kits.",
            "Air Filters" => "Superior engine protection.",
            "Spark Plugs" => "High-efficiency ignition.",
            "Clutch Kits" => "Performance-grade clutches.",
            "Headlights" => "Bright and long-lasting.",
            "Fuel Pumps" => "Reliable fuel delivery.",
            "Radiators" => "High-quality cooling system."
        ];

        foreach ($products as $name => $desc) {
            echo "
                <div class='col-md-4 col-sm-6'>
                    <div class='product-card text-center p-3'>
                        <h3>$name</h3>
                        <p>$desc</p>
                    </div>
                </div>";
        }
        ?>
    </div>
</div>

<!-- Footer (Stuck at bottom) -->
<footer>
    <p>&copy; 2025 VANQ Auto Parts. All rights reserved.</p>
</footer>

</body>
</html>
