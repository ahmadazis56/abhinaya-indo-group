<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

echo "<h1>Test Events Page</h1>";
echo "<p>Session Status: " . (isset($_SESSION['admin_logged_in']) ? 'Logged In' : 'Not Logged In') . "</p>";
echo "<p>Current Directory: " . __DIR__ . "</p>";
echo "<p>Parent Directory: " . dirname(__DIR__) . "</p>";

// Test database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    echo "<p>Database Error: " . $conn->connect_error . "</p>";
} else {
    echo "<p>Database Connected Successfully!</p>";
    
    // Test query
    $sql = "SELECT COUNT(*) as count FROM events";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "<p>Total Events: " . $row['count'] . "</p>";
    
    $conn->close();
}

// Test file includes
echo "<h2>Testing File Includes:</h2>";

$header_path = '../includes/header.php';
if (file_exists($header_path)) {
    echo "<p>✅ Header exists: $header_path</p>";
} else {
    echo "<p>❌ Header missing: $header_path</p>";
}

$sidebar_path = '../includes/sidebar.php';
if (file_exists($sidebar_path)) {
    echo "<p>✅ Sidebar exists: $sidebar_path</p>";
} else {
    echo "<p>❌ Sidebar missing: $sidebar_path</p>";
}

echo "<p><a href='index.php'>Back to Events</a></p>";
?>
