<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
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

// Get form data
$id = $_POST['id'] ?? 0;
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$category = $_POST['category'] ?? 'other';
$sortOrder = isset($_POST['sort_order']) ? (int)$_POST['sort_order'] : 0;

// Validate input
if (empty($id) || empty($title)) {
    $_SESSION['error_message'] = 'Judul foto harus diisi!';
    header("Location: edit.php?id=$id");
    exit();
}

// Get current image info in case we update size or keep the old one
$stmt = $conn->prepare("SELECT image, file_size FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$currentPhoto = $result->fetch_assoc();
$stmt->close();

if (!$currentPhoto) {
    $_SESSION['error_message'] = 'Foto tidak ditemukan!';
    header('Location: index.php');
    exit();
}

$imageFileName = $currentPhoto['image'];
$fileSize = $currentPhoto['file_size'];

// Check if new image is uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/gallery/';
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileSize = $file['size'];
    
    // Validate file type
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($fileType, $allowedTypes)) {
        $_SESSION['error_message'] = 'Format file tidak valid! Hanya JPG, PNG, GIF, WebP yang diperbolehkan.';
        header("Location: edit.php?id=$id");
        exit();
    }
    
    if ($newFileSize > 5 * 1024 * 1024) { // 5MB limit
        $_SESSION['error_message'] = 'Ukuran file terlalu besar! Max 5MB.';
        header("Location: edit.php?id=$id");
        exit();
    }
    
    // Generate new filename
    $newImageFileName = time() . '_' . uniqid() . '.' . $fileType;
    $targetFile = $uploadDir . $newImageFileName;
    
    // Upload new file
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Delete old image if it exists and is different
        if (!empty($imageFileName) && file_exists($uploadDir . $imageFileName)) {
            unlink($uploadDir . $imageFileName);
        }
        $imageFileName = $newImageFileName;
        $fileSize = $newFileSize;
    } else {
        $_SESSION['error_message'] = 'Gagal mengupload gambar baru!';
        header("Location: edit.php?id=$id");
        exit();
    }
}

// Check if sort_order column exists
$hasSortOrder = $conn->query("SHOW COLUMNS FROM gallery LIKE 'sort_order'");

// Update database
if ($hasSortOrder && $hasSortOrder->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE gallery SET title = ?, description = ?, image = ?, category = ?, sort_order = ?, file_size = ? WHERE id = ?");
    $stmt->bind_param("ssssiii", $title, $description, $imageFileName, $category, $sortOrder, $fileSize, $id);
} else {
    $stmt = $conn->prepare("UPDATE gallery SET title = ?, description = ?, image = ?, category = ?, file_size = ? WHERE id = ?");
    $stmt->bind_param("ssssii", $title, $description, $imageFileName, $category, $fileSize, $id);
}

if ($stmt->execute()) {
    $_SESSION['success_message'] = 'Foto gallery berhasil diupdate!';
    header('Location: index.php');
} else {
    $_SESSION['error_message'] = 'Gagal mengupdate foto: ' . $stmt->error;
    header("Location: edit.php?id=$id");
}

$stmt->close();
$conn->close();
?>
