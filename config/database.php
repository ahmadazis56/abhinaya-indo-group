<?php
/**
 * Database Configuration for Abhinaya Indo Group
 */

// Database settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");

/**
 * Get events from database
 */
function getEvents($limit = 3) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM events WHERE status IN ('upcoming', 'ongoing') ORDER BY date ASC LIMIT ?");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    $stmt->close();
    return $events;
}

/**
 * Get gallery photos by category
 */
function getGalleryPhotos($category = null, $limit = 8) {
    global $conn;
    if ($category) {
        $stmt = $conn->prepare("SELECT * FROM gallery WHERE category = ? ORDER BY created_at DESC LIMIT ?");
        $stmt->bind_param("si", $category, $limit);
    } else {
        $stmt = $conn->prepare("SELECT * FROM gallery ORDER BY created_at DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $photos = [];
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row;
    }
    $stmt->close();
    return $photos;
}


/**
 * Get statistics for dashboard
 */
function getDashboardStats() {
    global $conn;
    $stats = [];
    
    // Count events
    $result = $conn->query("SELECT COUNT(*) as count FROM events");
    $stats['events'] = $result->fetch_assoc()['count'];
    
    // Count gallery photos
    $result = $conn->query("SELECT COUNT(*) as count FROM gallery");
    $stats['gallery'] = $result->fetch_assoc()['count'];
    
    // Get storage used
    $result = $conn->query("SELECT SUM(file_size) as total FROM gallery WHERE file_size IS NOT NULL");
    $storage = $result->fetch_assoc()['total'];
    $stats['storage'] = $storage ? round($storage, 2) : 0;
    
    return $stats;
}

/**
 * Get recent activity
 */
function getRecentActivity($limit = 5) {
    global $conn;
    $activity = [];
    
    // Recent events
    $result = $conn->query("SELECT 'Event' as type, title as description, created_at as time FROM events ORDER BY created_at DESC LIMIT 3");
    while ($row = $result->fetch_assoc()) {
        $row['time'] = timeAgo($row['time']);
        $activity[] = $row;
    }
    
    // Recent gallery
    $result = $conn->query("SELECT 'Gallery' as type, title as description, created_at as time FROM gallery ORDER BY created_at DESC LIMIT 2");
    while ($row = $result->fetch_assoc()) {
        $row['time'] = timeAgo($row['time']);
        $activity[] = $row;
    }
    
    // Sort by time
    usort($activity, function($a, $b) {
        return strtotime($b['time']) - strtotime($a['time']);
    });
    
    return array_slice($activity, 0, $limit);
}

/**
 * Get portfolio items
 */
function getPortfolio($limit = null, $status = 'active') {
    global $conn;
    $sql = "SELECT * FROM portfolio WHERE status = ? ORDER BY sort_order ASC, created_at DESC";
    if ($limit) {
        $sql .= " LIMIT ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $limit);
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $status);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $portfolio = [];
    while ($row = $result->fetch_assoc()) {
        $portfolio[] = $row;
    }
    $stmt->close();
    return $portfolio;
}

/**
 * Get team members
 */
function getTeam($status = 'active') {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM team WHERE status = ? ORDER BY sort_order ASC, created_at ASC");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $team = [];
    while ($row = $result->fetch_assoc()) {
        $team[] = $row;
    }
    $stmt->close();
    return $team;
}

/**
 * Get logos by category
 */
function getLogos($category = null, $limit = null) {
    global $conn;
    if ($category) {
        $sql = "SELECT * FROM logos WHERE category = ? ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $category, $limit);
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $category);
        }
    } else {
        $sql = "SELECT * FROM logos ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $limit);
        } else {
            $stmt = $conn->prepare($sql);
        }
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $logos = [];
    while ($row = $result->fetch_assoc()) {
        $logos[] = $row;
    }
    $stmt->close();
    return $logos;
}

/**
 * Format time ago
 */
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;
    
    if ($diff < 60) return 'Baru saja';
    if ($diff < 3600) return floor($diff / 60) . ' menit lalu';
    if ($diff < 86400) return floor($diff / 3600) . ' jam lalu';
    if ($diff < 604800) return floor($diff / 86400) . ' hari lalu';
    return date('d M Y', $time);
}
?>
