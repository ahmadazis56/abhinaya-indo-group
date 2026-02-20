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

// Create events table if not exists
$createTable = "
CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    date DATE,
    time TIME,
    location VARCHAR(255),
    status ENUM('upcoming', 'ongoing', 'past') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($createTable)) {
    echo "Error creating table: " . $conn->error;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? null;
    $location = $_POST['location'] ?? '';
    $status = $_POST['status'] ?? 'upcoming';
    
    // Validate required fields
    if (empty($title) || empty($description) || empty($date) || empty($location) || empty($status)) {
        $_SESSION['error_message'] = 'Semua field wajib diisi!';
        header('Location: add.php');
        exit();
    }
    
    // Handle image upload
    $imageFileName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/events/';
        
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
        
        // Generate unique filename
        $imageFileName = time() . '_' . uniqid() . '.' . $fileType;
        $targetFile = $uploadDir . $imageFileName;
        
        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
            $_SESSION['error_message'] = 'Gagal mengupload gambar!';
            header('Location: add.php');
            exit();
        }
    }
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO events (title, description, image, date, time, location, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $description, $imageFileName, $date, $time, $location, $status);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Event berhasil ditambahkan!';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Gagal menyimpan event: ' . $stmt->error;
        header('Location: add.php');
        exit();
    }
    
    $stmt->close();
}

$conn->close();
?>
