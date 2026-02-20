<?php
/**
 * Database Setup Script for Abhinaya Admin Panel
 * Run this file once to create the database and tables
 */

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

// Create connection without database first
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$createDB = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!$conn->query($createDB)) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($database);

// Create events table
$createEventsTable = "
CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    date DATE,
    time TIME,
    location VARCHAR(255),
    status ENUM('upcoming', 'ongoing', 'past') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!$conn->query($createEventsTable)) {
    echo "Error creating events table: " . $conn->error . "<br>";
} else {
    echo "✅ Events table created successfully<br>";
}

// Create logos table
$createLogosTable = "
CREATE TABLE IF NOT EXISTS logos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255) NOT NULL,
    category ENUM('publisher', 'creative', 'techno', 'client') DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!$conn->query($createLogosTable)) {
    echo "Error creating logos table: " . $conn->error . "<br>";
} else {
    echo "✅ Logos table created successfully<br>";
}

// Create gallery table
$createGalleryTable = "
CREATE TABLE IF NOT EXISTS gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255) NOT NULL,
    category ENUM('event', 'portfolio', 'team', 'general') DEFAULT 'general',
    file_size DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!$conn->query($createGalleryTable)) {
    echo "Error creating gallery table: " . $conn->error . "<br>";
} else {
    echo "✅ Gallery table created successfully<br>";
}

// Create admin users table (optional for future use)
$createUsersTable = "
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

if (!$conn->query($createUsersTable)) {
    echo "Error creating admin_users table: " . $conn->error . "<br>";
} else {
    echo "✅ Admin users table created successfully<br>";
    
    // Insert default admin user
    $defaultPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $insertAdmin = "INSERT IGNORE INTO admin_users (username, password, email, full_name, role) VALUES ('admin', '$defaultPassword', 'admin@abhinaya.co.id', 'Administrator', 'super_admin')";
    
    if (!$conn->query($insertAdmin)) {
        echo "Error inserting default admin: " . $conn->error . "<br>";
    } else {
        echo "✅ Default admin user created (username: admin, password: admin123)<br>";
    }
}

// Create portfolio table
$createPortfolioTable = "
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

if (!$conn->query($createPortfolioTable)) {
    echo "Error creating portfolio table: " . $conn->error . "<br>";
} else {
    echo "✅ Portfolio table created successfully<br>";
}

// Create team table
$createTeamTable = "
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

if (!$conn->query($createTeamTable)) {
    echo "Error creating team table: " . $conn->error . "<br>";
} else {
    echo "✅ Team table created successfully<br>";
}

// Create activity log table (optional for future use)
$createActivityTable = "
CREATE TABLE IF NOT EXISTS activity_log (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(50),
    record_id INT,
    description TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES admin_users(id) ON DELETE SET NULL
)";

if (!$conn->query($createActivityTable)) {
    echo "Error creating activity_log table: " . $conn->error . "<br>";
} else {
    echo "✅ Activity log table created successfully<br>";
}

// Create upload directories
$uploadDirs = [
    '../uploads',
    '../uploads/events',
    '../uploads/logos',
    '../uploads/gallery',
    '../uploads/portfolio',
    '../uploads/team'
];

foreach ($uploadDirs as $dir) {
    if (!file_exists($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "✅ Created directory: $dir<br>";
        } else {
            echo "❌ Failed to create directory: $dir<br>";
        }
    } else {
        echo "✅ Directory already exists: $dir<br>";
    }
}

// Create index.php files to prevent directory listing
$indexFiles = [
    '../uploads/index.php',
    '../uploads/events/index.php',
    '../uploads/logos/index.php',
    '../uploads/gallery/index.php',
    '../uploads/portfolio/index.php',
    '../uploads/team/index.php'
];

$indexContent = '<?php // Access denied - Directory access not allowed ?>';

foreach ($indexFiles as $file) {
    if (!file_exists($file)) {
        if (file_put_contents($file, $indexContent)) {
            echo "✅ Created security file: $file<br>";
        } else {
            echo "❌ Failed to create security file: $file<br>";
        }
    }
}

echo "<hr>";
echo "<h2>🎉 Setup Complete!</h2>";
echo "<p><strong>Database:</strong> $database</p>";
echo "<p><strong>Default Login:</strong> admin / admin123</p>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ol>";
echo "<li>Delete this file (database_setup.php) for security</li>";
echo "<li>Update database credentials in save_*.php files</li>";
echo "<li>Change default admin password</li>";
echo "<li>Start using the admin panel!</li>";
echo "</ol>";
echo "<p><a href='index.php'>Go to Admin Panel</a></p>";

$conn->close();
?>
