<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Logo not found.';
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get current logo
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $category = $_POST['category'] ?? 'client';

    // Handle image upload if new image is provided
    $image = $logo['image']; // Keep existing image by default
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Invalid file type. Please upload JPG, PNG, GIF, or WebP images.';
            header('Location: edit.php?id=' . $id);
            exit;
        }

        if ($_FILES['image']['size'] > $maxSize) {
            $_SESSION['error'] = 'File size too large. Maximum size is 5MB.';
            header('Location: edit.php?id=' . $id);
            exit;
        }

        $uploadDir = '../uploads/logos/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Delete old image if it exists
        if (!empty($logo['image']) && file_exists($uploadDir . $logo['image'])) {
            unlink($uploadDir . $logo['image']);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $fileName;
        } else {
            $_SESSION['error'] = 'Failed to upload image. Please try again.';
            header('Location: edit.php?id=' . $id);
            exit;
        }
    }

    // Update database
    $stmt = $conn->prepare("UPDATE logos SET name = ?, description = ?, image = ?, category = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $description, $image, $category, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Logo updated successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to update logo. Please try again.';
        header('Location: edit.php?id=' . $id);
        exit;
    }

    $stmt->close();
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">
    <div class="page-header">
        <h1>Edit Logo</h1>
        <a href="index.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Logos
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($logo['name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Brief description of the client or partner"><?php echo htmlspecialchars($logo['description']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="client" <?php echo $logo['category'] == 'client' ? 'selected' : ''; ?>>Client</option>
                                <option value="publisher" <?php echo $logo['category'] == 'publisher' ? 'selected' : ''; ?>>Publisher</option>
                                <option value="creative" <?php echo $logo['category'] == 'creative' ? 'selected' : ''; ?>>Creative</option>
                                <option value="techno" <?php echo $logo['category'] == 'techno' ? 'selected' : ''; ?>>Technology Partner</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Logo Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current image. Allowed formats: JPG, PNG, GIF, WebP. Max size: 5MB</small>
                            
                            <?php if (!empty($logo['image'])): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Current logo:</small><br>
                                    <div style="background: #f8f9fa; padding: 10px; border-radius: 4px; border: 1px solid #dee2e6;">
                                        <img src="../uploads/logos/<?php echo htmlspecialchars($logo['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($logo['name']); ?>" 
                                             style="max-width: 100%; height: auto; max-height: 120px; object-fit: contain;">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Category Guide:</h6>
                            <ul class="mb-0">
                                <li><strong>Client:</strong> Companies you've worked for</li>
                                <li><strong>Publisher:</strong> Publishing partners</li>
                                <li><strong>Creative:</strong> Creative agencies</li>
                                <li><strong>Technology:</strong> Tech partners</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Logo
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<style>
.form-group {
    margin-bottom: 1.5rem;
}

.form-actions {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #dee2e6;
}

.form-actions .btn {
    margin-right: 1rem;
}

.form-control-file {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 0.375rem 0.75rem;
}

.form-text {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.mt-2 {
    margin-top: 0.5rem;
}

.alert-info h6 {
    margin-bottom: 0.5rem;
}

.alert-info ul {
    font-size: 0.875rem;
}
</style>
