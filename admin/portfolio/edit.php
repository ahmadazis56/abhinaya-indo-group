<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

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
    $category = strtolower(trim($_POST['category'] ?? ''));
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

<main class="flex-1 lg:ml-72">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Edit Portfolio</h1>
                    <p class="text-slate-600 mt-1">Update portfolio item</p>
                </div>
                <a href="index.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 flex items-start gap-3">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <div class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200 rounded-2xl p-6 overflow-x-hidden">
                <input type="hidden" name="id" value="<?php echo $portfolio['id']; ?>">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title *</label>
                                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($portfolio['title']); ?>" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Division *</label>
                                <select id="category" name="category" required onchange="toggleFields(this.value)" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                    <option value="">Select division</option>
                                    <option value="creative" <?php echo $portfolio['category'] == 'creative' ? 'selected' : ''; ?>>Creative</option>
                                    <option value="techno" <?php echo $portfolio['category'] == 'techno' ? 'selected' : ''; ?>>Techno</option>
                                    <option value="publisher" <?php echo $portfolio['category'] == 'publisher' ? 'selected' : ''; ?>>Publisher</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600"><?php echo htmlspecialchars($portfolio['description']); ?></textarea>
                        </div>

                        <div id="linkField" class="<?php echo ($portfolio['category'] == 'techno' || $portfolio['category'] == 'publisher') ? '' : 'hidden'; ?>">
                            <label for="link" class="block text-sm font-semibold text-slate-700 mb-2">Project Link</label>
                            <input type="url" id="link" name="link" value="<?php echo htmlspecialchars($portfolio['link']); ?>" placeholder="https://example.com" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                        </div>

                        <div>
                            <label for="tags" class="block text-sm font-semibold text-slate-700 mb-2">Tags</label>
                            <input type="text" id="tags" name="tags" value="<?php echo htmlspecialchars($portfolio['tags']); ?>" placeholder="e.g., design, ui/ux" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Image</label>
                            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4">
                                <div id="portfolioImagePreview" class="w-full aspect-video rounded-xl bg-white border border-slate-200 flex items-center justify-center overflow-hidden">
                                    <?php if (!empty($portfolio['image'])): ?>
                                        <img src="../uploads/portfolio/<?php echo htmlspecialchars($portfolio['image']); ?>" alt="<?php echo htmlspecialchars($portfolio['title']); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="text-slate-400 text-sm">Preview</div>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-3">
                                    <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-brand-600 file:text-white file:font-semibold hover:file:bg-brand-700" onchange="previewPortfolioImage(event)">
                                    <div class="mt-2 text-xs text-slate-500">Leave empty to keep current image. Max size: 5MB</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                            <select id="status" name="status" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                <option value="active" <?php echo $portfolio['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $portfolio['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order" value="<?php echo htmlspecialchars($portfolio['sort_order']); ?>" min="0" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            <div class="mt-2 text-xs text-slate-500">Lower numbers appear first</div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-200 flex flex-col sm:flex-row gap-3 sm:justify-end">
                    <a href="index.php" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-600 text-white font-semibold hover:bg-brand-700">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function toggleFields(category) {
    const linkField = document.getElementById('linkField');
    if (category === 'techno' || category === 'publisher') {
        linkField.classList.remove('hidden');
    } else {
        linkField.classList.add('hidden');
        document.getElementById('link').value = '';
    }
}

function previewPortfolioImage(event) {
    const file = event.target.files && event.target.files[0];
    const preview = document.getElementById('portfolioImagePreview');
    if (!preview) return;

    if (!file) {
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file terlalu besar! Max 5MB');
        event.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover">';
    };
    reader.readAsDataURL(file);
}
</script>

<?php include '../includes/footer.php'; ?>
