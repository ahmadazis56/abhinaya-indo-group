<?php
// Run from browser or CLI to ensure required columns exist.
// This script is safe to run multiple times.

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

function tableExists(mysqli $conn, string $dbName, string $tableName): bool {
    $sql = "SELECT 1 FROM information_schema.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $dbName, $tableName);
    $stmt->execute();
    $res = $stmt->get_result();
    $exists = $res && $res->num_rows > 0;
    $stmt->close();
    return $exists;
}

function columnExists(mysqli $conn, string $dbName, string $tableName, string $columnName): bool {
    $sql = "SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $dbName, $tableName, $columnName);
    $stmt->execute();
    $res = $stmt->get_result();
    $exists = $res && $res->num_rows > 0;
    $stmt->close();
    return $exists;
}

function addColumnIfMissing(mysqli $conn, string $dbName, string $tableName, string $columnName, string $ddl): void {
    if (!tableExists($conn, $dbName, $tableName)) {
        echo "❌ Table not found: {$tableName}<br>";
        return;
    }

    if (columnExists($conn, $dbName, $tableName, $columnName)) {
        echo "✅ {$tableName}.{$columnName} already exists<br>";
        return;
    }

    $sql = "ALTER TABLE `{$tableName}` ADD COLUMN {$ddl}";
    if ($conn->query($sql)) {
        echo "✅ Added {$tableName}.{$columnName}<br>";
    } else {
        echo "❌ Failed adding {$tableName}.{$columnName}: " . htmlspecialchars($conn->error) . "<br>";
    }
}

// EVENTS
// Frontend uses event_date; legacy admin code uses date.
addColumnIfMissing($conn, $database, 'events', 'event_date', "`event_date` DATE NULL AFTER `date`");
addColumnIfMissing($conn, $database, 'events', 'location', "`location` VARCHAR(255) NULL AFTER `time`");

// GALLERY
addColumnIfMissing($conn, $database, 'gallery', 'sort_order', "`sort_order` INT NOT NULL DEFAULT 0 AFTER `category`");

$conn->close();
?>
