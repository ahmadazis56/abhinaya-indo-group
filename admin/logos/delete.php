<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Logo not found.';
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? 0;

// Get logo to delete image file
$stmt = $conn->prepare("SELECT * FROM logos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Logo not found.';
    header('Location: index.php');
    exit;
}

$logo = $result->fetch_assoc();
$stmt->close();

// Delete from database
$stmt = $conn->prepare("DELETE FROM logos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Delete image file if it exists
    if (!empty($logo['image'])) {
        $imagePath = '../uploads/logos/' . $logo['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $_SESSION['message'] = 'Logo deleted successfully!';
} else {
    $_SESSION['error'] = 'Failed to delete logo. Please try again.';
}

$stmt->close();
header('Location: index.php');
exit;
?>
