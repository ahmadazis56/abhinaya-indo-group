<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $eventId = $_POST['id'];
    
    // Get event data to delete image file
    $stmt = $conn->prepare("SELECT image FROM events WHERE id = ?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
    
    if (!$event) {
        $_SESSION['error_message'] = 'Event tidak ditemukan!';
        header('Location: index.php');
        exit();
    }
    
    // Delete image file if exists
    if (!empty($event['image'])) {
        $filePath = '../uploads/events/' . $event['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    
    // Delete from database
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $eventId);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Event berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus event: ' . $stmt->error;
    }
    
    $stmt->close();
    header('Location: index.php');
    exit();
}

$conn->close();
?>
