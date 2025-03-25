<?php require_once("auth.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location | VANQ Auto Parts</title>
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
        .map-container {
            max-width: 1400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 90%;
        }
        iframe {
            width: 100%;
            height: 500px;
            border: 0;
            border-radius: 10px;
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
    
    <!-- Floating Menu -->
    <div class="floating-menu">
        <div class="menu-tab"></div>
        <a href="timeline.php">Homepage</a>
        <a href="Parts-Request.php">Parts Request</a>
        <a href="creator.php">Creator</a>
        <a href="Location.php" class="active">Location</a>
    </div>

    <div class="map-container">
        <h2>Our Location</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d991.4007457795354!2d106.7591034!3d-6.3157689!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sen!2sid!4v1736607406870!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
        <p>&copy; 2025 VANQ Auto Parts. All rights reserved.</p>
    </footer>
</body>
</html>
