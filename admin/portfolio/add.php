<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $link = trim($_POST['link']);
    $category = strtolower(trim($_POST['category'] ?? ''));
    $tags = trim($_POST['tags']);
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

        $uploadDir = '../uploads/portfolio/';
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
    $stmt = $conn->prepare("INSERT INTO portfolio (title, description, image, link, category, tags, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $title, $description, $image, $link, $category, $tags, $status, $sort_order);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Portfolio item added successfully!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to add portfolio item. Please try again.';
        header('Location: add.php');
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
                    <h1 class="text-2xl font-bold text-slate-900">Add Portfolio</h1>
                    <p class="text-slate-600 mt-1">Create a new portfolio item</p>
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
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-8 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title *</label>
                                <input type="text" id="title" name="title" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                                <select id="category" name="category" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                    <option value="">Select category</option>
                                    <option value="creative">Creative</option>
                                    <option value="techno">Techno</option>
                                    <option value="publisher">Publisher</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600"></textarea>
                        </div>

                        <div>
                            <label for="link" class="block text-sm font-semibold text-slate-700 mb-2">Project Link</label>
                            <input type="url" id="link" name="link" placeholder="https://example.com" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                        </div>

                        <div>
                            <label for="tags" class="block text-sm font-semibold text-slate-700 mb-2">Tags</label>
                            <input type="text" id="tags" name="tags" placeholder="e.g., design, ui/ux" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Image *</label>
                            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4">
                                <div id="portfolioImagePreview" class="w-full aspect-video rounded-xl bg-white border border-slate-200 flex items-center justify-center overflow-hidden">
                                    <div class="text-slate-400 text-sm">Preview</div>
                                </div>
                                <div class="mt-3">
                                    <input type="file" id="image" name="image" accept="image/*" required class="block w-full text-sm text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-brand-600 file:text-white file:font-semibold hover:file:bg-brand-700" onchange="previewPortfolioImage(event)">
                                    <div class="mt-2 text-xs text-slate-500">Allowed: JPG, PNG, GIF, WebP. Max size: 5MB</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                            <select id="status" name="status" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order" value="0" min="0" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
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
                        Save Portfolio
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewPortfolioImage(event) {
    const file = event.target.files && event.target.files[0];
    const preview = document.getElementById('portfolioImagePreview');
    if (!preview) return;

    if (!file) {
        preview.innerHTML = '<div class="text-slate-400 text-sm">Preview</div>';
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file terlalu besar! Max 5MB');
        event.target.value = '';
        preview.innerHTML = '<div class="text-slate-400 text-sm">Preview</div>';
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
