<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../config/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Portfolio item not found.';
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

// Get current portfolio item
$stmt = $conn->prepare("SELECT * FROM portfolio WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = 'Portfolio item not found.';
    header('Location: index.php');
    exit;
}

$portfolio = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $link = trim($_POST['link']);
    $category = trim($_POST['category']);
    $tags = trim($_POST['tags']);
    $status = $_POST['status'] ?? 'active';
    $sort_order = $_POST['sort_order'] ?? 0;

    // Handle image upload if new image is provided
    $image = $portfolio['image']; // Keep existing image by default
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

        $uploadDir = '../uploads/portfolio/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Delete old image if it exists
        if (!empty($portfolio['image']) && file_exists($uploadDir . $portfolio['image'])) {
            unlink($uploadDir . $portfolio['image']);
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
    $stmt = $conn->prepare("UPDATE portfolio SET title = ?, description = ?, image = ?, link = ?, category = ?, tags = ?, status = ?, sort_order = ? WHERE id = ?");
    $stmt->bind_param("sssssssii", $title, $description, $image, $link, $category, $tags, $status, $sort_order, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Portfolio item updated successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to update portfolio item. Please try again.';
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
        <h1>Edit Portfolio Item</h1>
        <a href="index.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Portfolio
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
                            <label for="title">Title *</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($portfolio['title']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($portfolio['description']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="link">Project Link</label>
                            <input type="url" class="form-control" id="link" name="link" value="<?php echo htmlspecialchars($portfolio['link']); ?>" placeholder="https://example.com">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($portfolio['category']); ?>" placeholder="e.g., Web Design, Mobile App">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags" value="<?php echo htmlspecialchars($portfolio['tags']); ?>" placeholder="e.g., design, development, ui/ux">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current image. Allowed formats: JPG, PNG, GIF, WebP. Max size: 5MB</small>
                            
                            <?php if (!empty($portfolio['image'])): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Current image:</small><br>
                                    <img src="../uploads/portfolio/<?php echo htmlspecialchars($portfolio['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($portfolio['title']); ?>" 
                                         style="max-width: 100%; height: auto; max-height: 200px; border-radius: 4px; border: 1px solid #dee2e6;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active" <?php echo $portfolio['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $portfolio['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?php echo htmlspecialchars($portfolio['sort_order']); ?>" min="0">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Portfolio Item
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
</style>
