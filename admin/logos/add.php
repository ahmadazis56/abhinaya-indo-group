<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $category = $_POST['category'] ?? 'client';

    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $_SESSION['error'] = 'Invalid file type. Please upload JPG, PNG, GIF, or WebP images.';
            header('Location: add.php');
            exit;
        }

        if ($_FILES['image']['size'] > $maxSize) {
            $_SESSION['error'] = 'File size too large. Maximum size is 5MB.';
            header('Location: add.php');
            exit;
        }

        $uploadDir = '../uploads/logos/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $fileName;
        } else {
            $_SESSION['error'] = 'Failed to upload image. Please try again.';
            header('Location: add.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please select an image to upload.';
        header('Location: add.php');
        exit;
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO logos (name, description, image, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $description, $image, $category);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Logo added successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to add logo. Please try again.';
        header('Location: add.php');
        exit;
    }

    $stmt->close();
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="main-content">
    <div class="page-header">
        <h1>Add Logo</h1>
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
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Brief description of the client or partner"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="client">Client (Will appear in Our Clients section)</option>
                                <option value="publisher">Partner (Will appear in Our Partners section)</option>
                                <option value="creative">Partner (Will appear in Our Partners section)</option>
                                <option value="techno">Partner (Will appear in Our Partners section)</option>
                            </select>
                            <small class="form-text text-muted">"Client" goes to Our Clients. All others go to Our Partners.</small>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Logo Image *</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                            <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF, WebP. Max size: 5MB</small>
                            <small class="form-text text-info">For best results, use transparent PNG or high-resolution logo</small>
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
                        <i class="fas fa-save"></i> Save Logo
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

.alert-info h6 {
    margin-bottom: 0.5rem;
}

.alert-info ul {
    font-size: 0.875rem;
}
</style>
