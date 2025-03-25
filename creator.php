<?php require_once("auth.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VANQ Creators</title>
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
            font-size: 2.5rem;
            color: #007bff;
        }
        .content {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .profile-img {
            width: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .section {
            margin-top: 20px;
            padding: 15px;
            background: #fff;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
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
        .btn-download {
            display: block;
            text-align: center;
            padding: 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-download:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <h1>VANQ</h1>
            <span>Auto Parts</span>
        </div>
    </header>
    <div class="content">
        <div class="text-center">
            <img src="Assets/Profpict.jpeg" alt="Profile Picture" style="text-align: right;" class="profile-img">
        </div>
        <div class="section">
            <h2>Contact Information</h2>
            <p>👤 Name: Bagas Adi Wicaksana</p>
            <p>📧 Email: <a href="mailto:aquadragon360@gmail.com">aquadragon360@gmail.com</a></p>
            <p>📞 WhatsApp: <a href="https://api.whatsapp.com/send?phone=6281290168367" target="_blank">+62 812-9016-8367</a></p>
            <p>📞 Phone: <a href="tel:+6281119033330">+62 811-1903-3330</a></p>
        </div>
        <div class="section">
            <h2>Introduction</h2>
            <p>I am a student at Binus Short Course learning Web Programming. I am eager to learn, hardworking, and have experience in digital marketing and ship mechanics.</p>
        </div>
        <div class="section">
            <h2>Education</h2>
            <ul>
                <li>Binus Course - Web Programming (2024 - 2025)</li>
                <li>Beruf Ausbildung Internationale (2022 - 2024)</li>
                <li>Virtuè Education - German Course (2020 - 2022)</li>
                <li>SMA Trimurti Surabaya (2017 - 2020)</li>
            </ul>
        </div>
        <div class="section">
            <h2>Experience</h2>
            <ul>
                <li>Digital Marketing - Property (Mid 2022)</li>
                <li>Ship Mechanic Assistant (Early 2023)</li>
            </ul>
        </div>
        <div class="section">
            <h2>Skills</h2>
            <ul>
                <li>HTML (Beginner)</li>
                <li>CSS (Beginner)</li>
                <li>JavaScript (None)</li>
                <li>PHP (None)</li>
                <li>German (Beginner)</li>
                <li>English (Beginner)</li>
            </ul>
        </div>
        <a href="Assets/New_CV.zip" download="CV_Adi.pdf" class="btn-download">Download CV</a>
    </div>
    <!-- Floating Menu -->
    <div class="floating-menu">
        <div class="menu-tab"></div>
        <a href="timeline.php">Homepage</a>
        <a href="Parts-Request.php">Parts Request</a>
        <a href="creator.php" class="active">Creator</a>
        <a href="Location.php">Location</a>
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
</body>
</html>
