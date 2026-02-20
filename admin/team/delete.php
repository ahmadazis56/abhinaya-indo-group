<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Team member not found.';
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get team member to delete image file
$stmt = $conn->prepare("SELECT * FROM team WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Team member not found.';
    header('Location: index.php');
    exit;
}

$member = $result->fetch_assoc();
$stmt->close();

// Delete from database
$stmt = $conn->prepare("DELETE FROM team WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Delete image file if it exists
    if (!empty($member['image'])) {
        $imagePath = '../uploads/team/' . $member['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $_SESSION['message'] = 'Team member deleted successfully!';
} else {
    $_SESSION['error'] = 'Failed to delete team member. Please try again.';
}

$stmt->close();
header('Location: index.php');
exit;
?>
