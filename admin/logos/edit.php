<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';

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

<main class="flex-1 lg:ml-72">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Edit Logo</h1>
                    <p class="text-slate-600 mt-1">Update client or partner logo information</p>
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
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Name *</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($logo['name']); ?>" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Category *</label>
                            <select id="category" name="category" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600">
                                <option value="client" <?php echo $logo['category'] == 'client' ? 'selected' : ''; ?>>Client (Will appear in Our Clients section)</option>
                                <option value="publisher" <?php echo $logo['category'] == 'publisher' ? 'selected' : ''; ?>>Partner (Will appear in Our Partners section)</option>
                                <option value="creative" <?php echo $logo['category'] == 'creative' ? 'selected' : ''; ?>>Partner (Will appear in Our Partners section)</option>
                                <option value="techno" <?php echo $logo['category'] == 'techno' ? 'selected' : ''; ?>>Partner (Will appear in Our Partners section)</option>
                            </select>
                            <p class="mt-2 text-xs text-slate-500 italic">"Client" goes to Our Clients. All others go to Our Partners.</p>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="4" placeholder="Brief description of the client or partner" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600"><?php echo htmlspecialchars($logo['description']); ?></textarea>
                        </div>
                    </div>

                    <div class="lg:col-span-4 space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Logo Image</label>
                            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-4 text-center">
                                <div id="logoPreview" class="w-full aspect-square rounded-xl bg-white border border-slate-200 flex items-center justify-center overflow-hidden mb-3">
                                    <?php if (!empty($logo['image'])): ?>
                                        <img src="../uploads/logos/<?php echo htmlspecialchars($logo['image']); ?>" alt="<?php echo htmlspecialchars($logo['name']); ?>" class="max-w-full max-h-full object-contain p-2">
                                    <?php else: ?>
                                        <div class="text-slate-400 text-sm px-4">Preview</div>
                                    <?php endif; ?>
                                </div>
                                <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-brand-600 file:text-white file:font-semibold hover:file:bg-brand-700" onchange="previewLogo(event)">
                                <div class="mt-2 text-[10px] text-slate-500 uppercase tracking-wider font-bold">Leave empty to keep current image</div>
                            </div>
                        </div>

                        <div class="rounded-xl bg-cyan-50 border border-cyan-100 p-4">
                            <h6 class="text-cyan-800 font-bold text-xs uppercase tracking-widest mb-2 flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> Best Results
                            </h6>
                            <ul class="text-xs text-cyan-700 space-y-1 font-medium">
                                <li>• Use transparent PNG images</li>
                                <li>• High-resolution original file</li>
                                <li>• Center-aligned logos</li>
                            </ul>
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
function previewLogo(event) {
    const file = event.target.files && event.target.files[0];
    const preview = document.getElementById('logoPreview');
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
        preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="max-w-full max-h-full object-contain p-2">';
    };
    reader.readAsDataURL(file);
}
</script>

<?php include '../includes/footer.php'; ?>
