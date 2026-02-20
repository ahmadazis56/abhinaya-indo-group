<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $division = trim($_POST['division']);
    $description = trim($_POST['description']);
    $email = trim($_POST['email']);
    $linkedin = trim($_POST['linkedin']);
    $status = $_POST['status'] ?? 'active';
    $sort_order = $_POST['sort_order'] ?? 0;

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

        $uploadDir = '../uploads/team/';
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
        $_SESSION['error'] = 'Please select a photo to upload.';
        header('Location: add.php');
        exit;
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO team (name, role, division, description, image, email, linkedin, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $name, $role, $division, $description, $image, $email, $linkedin, $status, $sort_order);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Team member added successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to add team member. Please try again.';
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
        <h1>Add Team Member</h1>
        <a href="index.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Team
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
                            <label for="name">Full Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role/Position *</label>
                            <input type="text" class="form-control" id="role" name="role" required placeholder="e.g., CEO, Senior Developer, Designer">
                        </div>

                        <div class="form-group">
                            <label for="division">Division *</label>
                            <select class="form-control" id="division" name="division" required>
                                <option value="">Select Division</option>
                                <option value="techno">Techno</option>
                                <option value="creative">Creative</option>
                                <option value="publisher">Publisher</option>
                                <option value="general">General</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Biography</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Brief biography or description of the team member"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">LinkedIn Profile</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Photo *</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                            <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF, WebP. Max size: 5MB</small>
                            <small class="form-text text-info">For best results, use a square photo (minimum 300x300px)</small>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Display Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Photo Tips:</h6>
                            <ul class="mb-0">
                                <li>Use professional headshots</li>
                                <li>Square format works best</li>
                                <li>Min 300x300 pixels recommended</li>
                                <li>Clear background preferred</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Add Team Member
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
