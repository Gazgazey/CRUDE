<?php 
require_once("auth.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VANQ Auto Parts</title>
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
        .content {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            flex-grow: 1;
        }
        .section {
            padding: 15px;
            background: #fff;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section h2 {
            color: #007bff;
        }
        .additional-content {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: justify;
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
        <a href="timeline.php" class="active">Homepage</a>
        <a href="Parts-Request.php">Parts Request</a>
        <a href="creator.php">Creator</a>
        <a href="Location.php">Location</a>
    </div>

    <div class="content">
        <div class="section" id="engine">
            <h2>High-Performance Engines</h2>
            <p>Upgrade your car with turbochargers, performance camshafts, forged pistons, high-flow intake systems, and ECU remapping for optimized fuel efficiency and power delivery.</p>
        </div>
        <div class="section" id="suspension">
            <h2>Suspension Systems</h2>
            <p>Enhance handling with coilovers, performance sway bars, strut braces, adjustable dampers, and reinforced bushings for better stability and cornering precision.</p>
        </div>
        <div class="section" id="brakes">
            <h2>Braking Performance</h2>
            <p>Improve stopping power with big brake kits, ceramic pads, slotted rotors, stainless steel brake lines, and high-performance brake fluids for track-level braking response.</p>
        </div>
    </div>
    
    <div class="additional-content">
        <h2>Understanding Performance Tuning</h2>
        <p>Performance tuning involves optimizing the vehicle's engine, suspension, and aerodynamics for better efficiency and speed. From ECU remaps to weight reduction techniques, every detail contributes to the car’s overall performance.</p>
        <h2>Why Choose VANQ Auto Parts?</h2>
        <p>With years of experience in the automotive industry, VANQ Auto Parts provides high-quality performance components tailored to your vehicle’s needs. We ensure top-tier products for both track and street applications.</p>
        <h2>Expert Advice & Support</h2>
        <p>Our team of experts is always ready to help you find the best modifications for your vehicle. Whether you're a professional racer or a car enthusiast, we have the right parts and advice for you.</p>
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

    <script>
        console.log("Session Data: ", <?php echo json_encode($_SESSION); ?>);
    </script>

    <footer>
        <p>&copy; 2025 VANQ Auto Parts. All rights reserved. Your trusted partner for high-performance auto upgrades and custom modifications.</p>
    </footer>
</body>
</html>