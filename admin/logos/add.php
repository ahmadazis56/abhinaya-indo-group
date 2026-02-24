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

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-3xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Add Logo</h1>
                <p class="text-slate-500 mt-1 text-sm">Tambahkan logo Client atau Partner baru.</p>
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
                
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-brand-500"></i> Informasi Instansi
                    </h3>

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Instansi *</label>
                            <input type="text" id="name" name="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Kategori *</label>
                            <select id="category" name="category" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                <option value="client">Client (Ditampilkan di Our Clients)</option>
                                <option value="partner">Partner (Ditampilkan di Our Partners)</option>
                            </select>
                            <p class="mt-2 text-xs text-slate-500">Selain "Client" akan otomatis masuk ke bagian Our Partners.</p>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Singkat</label>
                            <textarea id="description" name="description" rows="4" placeholder="Keterangan opsional tentang client/partner ini" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"></textarea>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-image text-brand-500"></i> Upload Logo
                    </h3>

                    <div class="space-y-6">
                        <div>
                            <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Pilih File Logo *</label>
                            
                            <div class="relative group cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl hover:border-brand-500 hover:bg-brand-50 transition-all duration-300 w-full text-center overflow-hidden">
                                <input type="file" id="image" name="image" accept="image/*" required onchange="previewLogo(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="px-6 py-12 flex flex-col items-center justify-center pointer-events-none">
                                    <div class="w-16 h-16 mb-4 rounded-full bg-slate-100 group-hover:bg-white text-slate-400 group-hover:text-brand-500 flex items-center justify-center transition-colors shadow-sm">
                                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                    </div>
                                    <h4 class="text-slate-800 font-bold mb-1 text-lg">Klik atau seret logo ke sini</h4>
                                    <p class="text-slate-500 mb-4 text-sm">Disarankan menggunakan format PNG transparan.</p>
                                    
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

                        <div id="logoPreviewContainer" class="hidden">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Preview Logo</label>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-center justify-center">
                                <div id="logoPreview" class="w-full max-w-sm h-32 flex items-center justify-center overflow-hidden">
                                    <!-- Preview image will be injected here -->
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
                        <i class="fas fa-save"></i> Save Logo
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
        preview.innerHTML = '<div class="text-slate-400 text-sm px-4">Preview</div>';
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('Ukuran file terlalu besar! Max 5MB');
        event.target.value = '';
        preview.innerHTML = '<div class="text-slate-400 text-sm px-4">Preview</div>';
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
