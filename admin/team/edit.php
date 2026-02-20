<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Team member not found.';
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get current team member
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $division = trim($_POST['division']);
    $description = trim($_POST['description']);
    $email = trim($_POST['email']);
    $linkedin = trim($_POST['linkedin']);
    $status = $_POST['status'] ?? 'active';
    $sort_order = $_POST['sort_order'] ?? 0;

    // Handle image upload if new image is provided
    $image = $member['image']; // Keep existing image by default
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

        $uploadDir = '../uploads/team/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Delete old image if it exists
        if (!empty($member['image']) && file_exists($uploadDir . $member['image'])) {
            unlink($uploadDir . $member['image']);
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
    $stmt = $conn->prepare("UPDATE team SET name = ?, role = ?, division = ?, description = ?, image = ?, email = ?, linkedin = ?, status = ?, sort_order = ? WHERE id = ?");
    $stmt->bind_param("ssssssssii", $name, $role, $division, $description, $image, $email, $linkedin, $status, $sort_order, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Team member updated successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to update team member. Please try again.';
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
        <h1>Edit Team Member</h1>
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
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role/Position *</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($member['role']); ?>" required placeholder="e.g., CEO, Senior Developer, Designer">
                        </div>

                        <div class="form-group">
                            <label for="division">Division *</label>
                            <select class="form-control" id="division" name="division" required>
                                <option value="">Select Division</option>
                                <option value="techno" <?php echo (isset($member['division']) && $member['division'] == 'techno') ? 'selected' : ''; ?>>Techno</option>
                                <option value="creative" <?php echo (isset($member['division']) && $member['division'] == 'creative') ? 'selected' : ''; ?>>Creative</option>
                                <option value="publisher" <?php echo (isset($member['division']) && $member['division'] == 'publisher') ? 'selected' : ''; ?>>Publisher</option>
                                <option value="general" <?php echo (isset($member['division']) && $member['division'] == 'general') ? 'selected' : ''; ?>>General</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Biography</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Brief biography or description of the team member"><?php echo htmlspecialchars($member['description']); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" placeholder="name@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">LinkedIn Profile</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($member['linkedin']); ?>" placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Photo</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current photo. Allowed formats: JPG, PNG, GIF, WebP. Max size: 5MB</small>
                            
                            <?php if (!empty($member['image'])): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Current photo:</small><br>
                                    <div style="text-align: center; padding: 10px; border: 1px solid #dee2e6; border-radius: 4px; background: #f8f9fa;">
                                        <img src="../uploads/team/<?php echo htmlspecialchars($member['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($member['name']); ?>" 
                                             style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 2px solid #dee2e6;">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active" <?php echo $member['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $member['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Display Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?php echo htmlspecialchars($member['sort_order']); ?>" min="0">
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
                        <i class="fas fa-save"></i> Update Team Member
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
