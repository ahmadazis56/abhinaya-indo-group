<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

// Database connection
require_once '../../config/database.php';

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Get photo info to delete file
    $stmt = $conn->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $photo = $result->fetch_assoc();
        $imageFile = '../uploads/gallery/' . $photo['image'];
        
        // Delete file if exists
        if (file_exists($imageFile)) {
            unlink($imageFile);
        }
        
        // Delete from database
        $deleteStmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $deleteStmt->bind_param("i", $id);
        
        if ($deleteStmt->execute()) {
            $_SESSION['success_message'] = 'Foto berhasil dihapus!';
        } else {
            $_SESSION['error_message'] = 'Gagal menghapus foto: ' . $deleteStmt->error;
        }
        
        $deleteStmt->close();
    } else {
        $_SESSION['error_message'] = 'Foto tidak ditemukan!';
    }
    
    $stmt->close();
}

$conn->close();
header('Location: index.php');
exit();
?>
