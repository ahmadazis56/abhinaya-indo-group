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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['id'] ?? 0;
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? null;
    $location = $_POST['location'] ?? '';
    $status = $_POST['status'] ?? 'upcoming';
    $removeImage = $_POST['remove_image'] ?? 0;
    
    // Validate required fields
    if (empty($title) || empty($description) || empty($date) || empty($location) || empty($status)) {
        $_SESSION['error_message'] = 'Semua field wajib diisi!';
        header('Location: edit.php?id=' . $eventId);
        exit();
    }
    
    // Get current event data
    $stmt = $conn->prepare("SELECT image FROM events WHERE id = ?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentEvent = $result->fetch_assoc();
    $stmt->close();
    
    if (!$currentEvent) {
        $_SESSION['error_message'] = 'Event tidak ditemukan!';
        header('Location: index.php');
        exit();
    }
    
    $imageFileName = $currentEvent['image'];
    
    // Handle image removal
    if ($removeImage == 1 && !empty($imageFileName)) {
        // Delete physical file
        $filePath = '../uploads/events/' . $imageFileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $imageFileName = '';
    }
    
    // Handle new image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/events/';
        
        // Delete old image if exists
        if (!empty($imageFileName)) {
            $oldFilePath = $uploadDir . $imageFileName;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        
        $file = $_FILES['image'];
        $fileName = basename($file['name']);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $file['size'];
        
        // Validate file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error_message'] = 'Format file tidak valid! Hanya JPG, PNG, GIF, WebP yang diperbolehkan.';
            header('Location: edit.php?id=' . $eventId);
            exit();
        }
        
        if ($fileSize > 5 * 1024 * 1024) { // 5MB limit
            $_SESSION['error_message'] = 'Ukuran file terlalu besar! Max 5MB.';
            header('Location: edit.php?id=' . $eventId);
            exit();
        }
        
        // Generate unique filename
        $imageFileName = time() . '_' . uniqid() . '.' . $fileType;
        $targetFile = $uploadDir . $imageFileName;
        
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            $_SESSION['error_message'] = 'Gagal mengupload gambar!';
            header('Location: edit.php?id=' . $eventId);
            exit();
        }
    }
    
    // Update database
    $stmt = $conn->prepare("UPDATE events SET title = ?, description = ?, image = ?, date = ?, time = ?, location = ?, status = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $title, $description, $imageFileName, $date, $time, $location, $status, $eventId);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Event berhasil diupdate!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Gagal mengupdate event: ' . $stmt->error;
        header('Location: edit.php?id=' . $eventId);
        exit();
    }
    
    $stmt->close();
}

$conn->close();
?>
