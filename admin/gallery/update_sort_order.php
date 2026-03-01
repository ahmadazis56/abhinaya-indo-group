<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

// Database connection
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $sortOrder = isset($_POST['sort_order']) ? (int)$_POST['sort_order'] : 0;

    if ($id <= 0) {
        $_SESSION['error_message'] = 'Data tidak valid!';
        header('Location: index.php');
        exit();
    }

    $hasSortOrder = $conn->query("SHOW COLUMNS FROM gallery LIKE 'sort_order'");
    if (!$hasSortOrder || $hasSortOrder->num_rows === 0) {
        $_SESSION['error_message'] = 'Kolom sort_order belum ada. Jalankan fix_missing_columns.php terlebih dahulu.';
        header('Location: index.php');
        exit();
    }

    $stmt = $conn->prepare("UPDATE gallery SET sort_order = ? WHERE id = ?");
    $stmt->bind_param('ii', $sortOrder, $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Sort order berhasil diupdate!';
    } else {
        $_SESSION['error_message'] = 'Gagal update sort order: ' . $stmt->error;
    }

    $stmt->close();
    header('Location: index.php');
    exit();
}

header('Location: index.php');
exit();
?>
