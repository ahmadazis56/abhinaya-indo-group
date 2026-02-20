<?php
// Basic configuration
define('ROOT_PATH', __DIR__);
require_once 'config/database.php';

// Get data from database
$clientLogos = getLogos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abhinaya Indo Group</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        
        nav ul {
            list-style: none;
            display: flex;
        }
        
        nav ul li {
            margin-left: 30px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #007bff;
        }
        
        section {
            background: #fff;
            margin: 30px 0;
            padding: 40px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1, h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        
        h1 {
            font-size: 36px;
            color: #007bff;
        }
        
        h2 {
            font-size: 28px;
            color: #333;
        }
        
        .no-content {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }
        
        .admin-link {
            background: #28a745;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        .admin-link:hover {
            background: #218838;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
            }
            
            nav ul {
                flex-direction: column;
                gap: 10px;
            }
            
            nav ul li {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">Abhinaya Indo Group</div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#divisions">Divisions</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#team">Team Management</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="admin/" class="admin-link">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <!-- Home Section -->
        <section id="home">
            <h1>Welcome to Abhinaya Indo Group</h1>
            <p style="text-align: center; font-size: 18px; margin-bottom: 30px;">
                Professional services for your business needs
            </p>
        </section>

        <!-- Divisions Section -->
        <section id="divisions">
            <h2>Our Divisions</h2>
            <div class="no-content">
                <p>Division information will be featured here soon.</p>
            </div>
        </section>

        <!-- Events Section -->
        <section id="events">
            <h2>Events</h2>
            <div class="no-content">
                <p>Upcoming events will be featured here soon.</p>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery">
            <h2>Gallery</h2>
            <div class="no-content">
                <p>Gallery photos will be featured here soon.</p>
            </div>
        </section>

        <!-- News Section -->
        <section id="news">
            <h2>News</h2>
            <div class="no-content">
                <p>Latest news and updates will be featured here soon.</p>
            </div>
        </section>

        <!-- Team Management Section -->
        <section id="team">
            <h2>Team Management</h2>
            <div class="no-content">
                <p>Team information will be featured here soon.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact">
            <h2>Contact</h2>
            <div class="no-content">
                <p>Contact information will be featured here soon.</p>
            </div>
        </section>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Abhinaya Indo Group. All rights reserved.</p>
            <p style="margin-top: 10px;">
                <a href="admin/" style="color: #fff; text-decoration: none;">Admin Panel</a>
            </p>
        </div>
    </footer>
</body>
</html>
