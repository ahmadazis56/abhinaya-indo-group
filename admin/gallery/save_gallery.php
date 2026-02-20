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

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create gallery table if not exists
$createTable = "
CREATE TABLE IF NOT EXISTS gallery (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255) NOT NULL,
    category ENUM('events', 'projects', 'team', 'office', 'clients', 'other') DEFAULT 'other',
    file_size INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($createTable)) {
    echo "Error creating table: " . $conn->error;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle image upload
    $imageFileName = '';
    $fileSize = 0;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/gallery/';
        
        // Create upload directory if not exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $file = $_FILES['image'];
        $fileName = basename($file['name']);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $file['size'];
        
        // Validate file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error_message'] = 'Format file tidak valid! Hanya JPG, PNG, GIF, WebP yang diperbolehkan.';
            header('Location: add.php');
            exit();
        }
        
        if ($fileSize > 5 * 1024 * 1024) { // 5MB limit
            $_SESSION['error_message'] = 'Ukuran file terlalu besar! Max 5MB.';
            header('Location: add.php');
            exit();
        }
        
        // Check image dimensions
        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            $_SESSION['error_message'] = 'File yang diupload bukan gambar yang valid!';
            header('Location: add.php');
            exit();
        }
        
        list($width, $height) = $imageInfo;
        if ($width < 800 || $height < 600) {
            $_SESSION['error_message'] = 'Resolusi gambar terlalu kecil! Minimum 800x600px.';
            header('Location: add.php');
            exit();
        }
        
        // Generate unique filename
        $imageFileName = time() . '_' . uniqid() . '.' . $fileType;
        $targetFile = $uploadDir . $imageFileName;
        
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            $_SESSION['error_message'] = 'Gagal mengupload gambar!';
            header('Location: add.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Pilih file gambar terlebih dahulu!';
        header('Location: add.php');
        exit();
    }
    
    // Insert into database with default values
    $title = 'Gallery_' . time(); // Generate default title
    $description = ''; // Empty description
    $category = 'other'; // Default category
    $stmt = $conn->prepare("INSERT INTO gallery (title, description, image, category, file_size) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $description, $imageFileName, $category, $fileSize);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Foto gallery berhasil ditambahkan!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Gagal menyimpan foto: ' . $stmt->error;
        header('Location: add.php');
        exit();
    }
    
    $stmt->close();
}

$conn->close();
?>
