<?php
/**
 * Simple Setup Script for Abhinaya Website
 * Run this to create database and tables
 */

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

echo "<h1>Abhinaya Website Setup</h1>";

try {
    // Create connection
    $conn = new mysqli($host, $username, $password);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p style='color: green;'>✅ Connected to MySQL</p>";
    
    // Create database
    $createDB = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    if (!$conn->query($createDB)) {
        throw new Exception("Error creating database: " . $conn->error);
    }
    echo "<p style='color: green;'>✅ Database created</p>";
    
    // Select database
    $conn->select_db($database);
    
    // Create portfolio table
    $createPortfolio = "
    CREATE TABLE IF NOT EXISTS portfolio (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        image VARCHAR(255) NOT NULL,
        link VARCHAR(255),
        category VARCHAR(100),
        tags TEXT,
        status ENUM('active', 'inactive') DEFAULT 'active',
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($createPortfolio)) {
        throw new Exception("Error creating portfolio table: " . $conn->error);
    }
    echo "<p style='color: green;'>✅ Portfolio table created</p>";
    
    // Create team table
    $createTeam = "
    CREATE TABLE IF NOT EXISTS team (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        role VARCHAR(255),
        description TEXT,
        image VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        linkedin VARCHAR(255),
        status ENUM('active', 'inactive') DEFAULT 'active',
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($createTeam)) {
        throw new Exception("Error creating team table: " . $conn->error);
    }
    echo "<p style='color: green;'>✅ Team table created</p>";
    
    // Create logos table
    $createLogos = "
    CREATE TABLE IF NOT EXISTS logos (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        image VARCHAR(255) NOT NULL,
        status ENUM('active', 'inactive') DEFAULT 'active',
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($createLogos)) {
        throw new Exception("Error creating logos table: " . $conn->error);
    }
    echo "<p style='color: green;'>✅ Logos table created</p>";
    
    // Create admin users table
    $createUsers = "
    CREATE TABLE IF NOT EXISTS admin_users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        full_name VARCHAR(100),
        role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin',
        last_login TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($createUsers)) {
        throw new Exception("Error creating admin_users table: " . $conn->error);
    }
    echo "<p style='color: green;'>✅ Admin users table created</p>";
    
    // Insert default admin user
    $defaultPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $insertAdmin = "INSERT IGNORE INTO admin_users (username, password, email, full_name, role) VALUES ('admin', '$defaultPassword', 'admin@abhinaya.co.id', 'Administrator', 'super_admin')";
    
    if (!$conn->query($insertAdmin)) {
        throw new Exception("Error inserting default admin: " . $conn->error);
    }
    echo "<p style='color: green;'>✅ Default admin created (admin/admin123)</p>";
    
    // Create upload directories
    $uploadDirs = ['uploads', 'uploads/portfolio', 'uploads/team', 'uploads/logos'];
    foreach ($uploadDirs as $dir) {
        if (!file_exists($dir)) {
            if (mkdir($dir, 0755, true)) {
                echo "<p style='color: green;'>✅ Created directory: $dir</p>";
            } else {
                echo "<p style='color: orange;'>⚠️ Failed to create directory: $dir</p>";
            }
        } else {
            echo "<p style='color: blue;'>ℹ️ Directory already exists: $dir</p>";
        }
    }
    
    echo "<hr>";
    echo "<h2 style='color: green;'>🎉 Setup Complete!</h2>";
    echo "<p><strong>Database:</strong> $database</p>";
    echo "<p><strong>Admin Login:</strong> admin / admin123</p>";
    echo "<p><a href='index.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>View Website</a></p>";
    echo "<p><a href='admin/' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px;'>Admin Panel</a></p>";
    echo "<p style='color: orange;'><strong>Important:</strong> Delete this file after setup for security!</p>";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your MySQL configuration and try again.</p>";
}
?>
