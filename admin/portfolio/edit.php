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
    $sort_order = 0;

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

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Portfolio</h1>
                <p class="text-slate-500 mt-1 text-sm">Update informasi portofolio proyek.</p>
            </div>
            <a href="index.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800 flex items-start gap-3">
                <i class="fas fa-exclamation-circle mt-0.5"></i>
                <div class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <form method="POST" enctype="multipart/form-data" class="divide-y divide-slate-100">
                <input type="hidden" name="id" value="<?php echo $portfolio['id']; ?>">
                
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-brand-500"></i> Informasi Portofolio
                    </h3>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Proyek *</label>
                                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($portfolio['title']); ?>" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Divisi *</label>
                                <select id="category" name="category" required onchange="toggleFields(this.value)" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                    <option value="">Pilih Divisi</option>
                                    <option value="creative" <?php echo $portfolio['category'] == 'creative' ? 'selected' : ''; ?>>Creative</option>
                                    <option value="techno" <?php echo $portfolio['category'] == 'techno' ? 'selected' : ''; ?>>Techno</option>
                                    <option value="publisher" <?php echo $portfolio['category'] == 'publisher' ? 'selected' : ''; ?>>Publisher</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Proyek</label>
                            <textarea id="description" name="description" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"><?php echo htmlspecialchars($portfolio['description']); ?></textarea>
                        </div>

                        <div id="linkField" class="<?php echo ($portfolio['category'] == 'techno' || $portfolio['category'] == 'publisher' || $portfolio['category'] == 'creative') ? '' : 'hidden'; ?>">
                            <label for="link" id="linkLabel" class="block text-sm font-semibold text-slate-700 mb-2">
                                <?php echo ($portfolio['category'] == 'creative') ? 'Link Instagram (Visit Our Instagram)' : 'Tautan Proyek (Project Link)'; ?>
                            </label>
                            <input type="url" id="link" name="link" value="<?php echo htmlspecialchars($portfolio['link']); ?>" placeholder="https://example.com" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tags" class="block text-sm font-semibold text-slate-700 mb-2">Tags / Label</label>
                                <input type="text" id="tags" name="tags" value="<?php echo htmlspecialchars($portfolio['tags']); ?>" placeholder="e.g., design, ui/ux" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                                <p class="mt-2 text-xs text-slate-500">Gunakan koma (,) untuk memisahkan setiap tag.</p>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Portofolio</label>
                                <select id="status" name="status" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                    <option value="active" <?php echo $portfolio['status'] == 'active' ? 'selected' : ''; ?>>Active (Ditampilkan)</option>
                                    <option value="inactive" <?php echo $portfolio['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive (Disembunyikan)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-image text-brand-500"></i> Cover Proyek
                    </h3>

                    <?php if (!empty($portfolio['image'])): ?>
                    <div class="current-image mb-8 border border-slate-200 rounded-xl p-4 bg-slate-50">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Cover Saat Ini:</label>
                        <div class="w-full sm:max-w-md aspect-video bg-white flex items-center justify-center rounded-lg shadow-sm border border-slate-200 p-2 overflow-hidden">
                            <img src="../uploads/portfolio/<?php echo htmlspecialchars($portfolio['image']); ?>" alt="Current Cover" class="w-full h-full object-cover rounded">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="space-y-6">
                        <div>
                            <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Ganti File Gambar</label>
                            
                            <div class="relative group cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl hover:border-brand-500 hover:bg-brand-50 transition-all duration-300 w-full text-center overflow-hidden">
                                <input type="file" id="image" name="image" accept="image/*" onchange="previewPortfolioImage(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="px-6 py-12 flex flex-col items-center justify-center pointer-events-none">
                                    <div class="w-16 h-16 mb-4 rounded-full bg-slate-100 group-hover:bg-white text-slate-400 group-hover:text-brand-500 flex items-center justify-center transition-colors shadow-sm">
                                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                    </div>
                                    <h4 class="text-slate-800 font-bold mb-1 text-lg">Klik atau seret gambar baru ke sini</h4>
                                    <p class="text-slate-500 mb-4 text-sm">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                    
                                    <div class="flex flex-wrap justify-center gap-2 mt-2 font-medium text-[10px] text-slate-500 uppercase tracking-widest">
                                        <span class="px-2 py-1 bg-slate-100 rounded-md">JPG</span>
                                        <span class="px-2 py-1 bg-slate-100 rounded-md">PNG</span>
                                        <span class="px-2 py-1 bg-slate-100 rounded-md">GIF</span>
                                        <span class="px-2 py-1 bg-slate-100 rounded-md">WEBP</span>
                                        <span class="px-2 py-1 bg-slate-100 rounded-md">Max 5MB</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="portfolioPreviewContainer" class="hidden">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Preview Gambar Baru</label>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-center">
                                <div id="portfolioImagePreview" class="w-full sm:max-w-md aspect-video rounded-xl bg-white border border-slate-200 flex items-center justify-center overflow-hidden">
                                    <!-- Preview injected here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8 bg-slate-50 flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <a href="index.php" class="inline-flex justify-center items-center gap-2 px-6 py-3 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function toggleFields(category) {
    const linkField = document.getElementById('linkField');
    const linkLabel = document.getElementById('linkLabel');
    if (category === 'techno' || category === 'publisher' || category === 'creative') {
        linkField.classList.remove('hidden');
        if (category === 'creative') {
            linkLabel.textContent = 'Link Instagram (Visit Our Instagram)';
        } else {
            linkLabel.textContent = 'Tautan Proyek (Project Link)';
        }
    } else {
        linkField.classList.add('hidden');
        document.getElementById('link').value = '';
    }
}

function previewPortfolioImage(event) {
    const file = event.target.files && event.target.files[0];
    const previewContainer = document.getElementById('portfolioPreviewContainer');
    const preview = document.getElementById('portfolioImagePreview');
    if (!preview) return;

    if (!file) {
        previewContainer.classList.add('hidden');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file terlalu besar! Max 5MB');
        event.target.value = '';
        previewContainer.classList.add('hidden');
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        previewContainer.classList.remove('hidden');
        preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover">';
    };
    reader.readAsDataURL(file);
}
</script>

<?php include '../includes/footer.php'; ?>
