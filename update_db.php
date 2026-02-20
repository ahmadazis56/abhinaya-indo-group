<?php
/**
 * Database Update Script
 * Add division column to team table
 */

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

echo "<h1>Database Update - Add Division Column</h1>";

try {
    // Create connection
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p style='color: green;'>✅ Connected to database: $database</p>";
    
    // Check if column already exists
    $checkColumn = "SHOW COLUMNS FROM team LIKE 'division'";
    $result = $conn->query($checkColumn);
    
    if ($result->num_rows > 0) {
        echo "<p style='color: orange;'>⚠️ Column 'division' already exists in team table</p>";
    } else {
        // Add division column
        $alterTable = "ALTER TABLE team ADD COLUMN division VARCHAR(50) DEFAULT 'techno' AFTER role";
        
        if (!$conn->query($alterTable)) {
            throw new Exception("Error adding division column: " . $conn->error);
        }
        
        echo "<p style='color: green;'>✅ Column 'division' added successfully to team table</p>";
    }
    
    // Show table structure
    echo "<h3>Current Team Table Structure:</h3>";
    $structure = $conn->query("DESCRIBE team");
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    while ($row = $structure->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<hr>";
    echo "<h2 style='color: green;'>🎉 Update Complete!</h2>";
    echo "<p><strong>Important:</strong> Delete this file after running for security!</p>";
    echo "<p><a href='admin/team/' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Team Admin</a></p>";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration and try again.</p>";
}
?>
