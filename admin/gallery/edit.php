<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

// Get photo ID from URL
$photoId = $_GET['id'] ?? 0;

// Database connection
require_once '../../config/database.php';

// Get photo data
$stmt = $conn->prepare("SELECT * FROM gallery WHERE id = ?");
$stmt->bind_param("i", $photoId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error_message'] = 'Foto tidak ditemukan!';
    header('Location: index.php');
    exit();
}

$photo = $result->fetch_assoc();
$stmt->close();

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Foto Gallery</h1>
                <p class="text-slate-500 mt-1 text-sm">Ubah detail dan metadata foto.</p>
            </div>
            <a href="index.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <form action="update_gallery.php" method="POST" enctype="multipart/form-data" class="gallery-form divide-y divide-slate-100">
                <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">
                
                <!-- Data Section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-brand-500"></i> Informasi Foto
                    </h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Foto *</label>
                            <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($photo['title']); ?>" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Foto</label>
                            <textarea id="description" name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"><?php echo htmlspecialchars($photo['description'] ?? ''); ?></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Kategori *</label>
                                <select id="category" name="category" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                    <option value="events" <?php echo $photo['category'] === 'events' ? 'selected' : ''; ?>>Events</option>
                                    <option value="projects" <?php echo $photo['category'] === 'projects' ? 'selected' : ''; ?>>Projects</option>
                                    <option value="team" <?php echo $photo['category'] === 'team' ? 'selected' : ''; ?>>Team</option>
                                    <option value="office" <?php echo $photo['category'] === 'office' ? 'selected' : ''; ?>>Office</option>
                                    <option value="clients" <?php echo $photo['category'] === 'clients' ? 'selected' : ''; ?>>Clients</option>
                                    <option value="other" <?php echo $photo['category'] === 'other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            <div>
                                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Urutan (Sort Order)</label>
                                <input type="number" id="sort_order" name="sort_order" value="<?php echo (int)($photo['sort_order'] ?? 0); ?>" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-image text-brand-500"></i> Gambar
                    </h3>
                    
                    <?php if (!empty($photo['image'])): ?>
                    <div class="current-image mb-8 border border-slate-200 rounded-xl p-4 bg-slate-50">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Gambar Saat Ini:</label>
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <img src="../uploads/gallery/<?php echo htmlspecialchars($photo['image']); ?>" alt="Current Image" class="w-full sm:w-auto sm:max-w-xs h-32 object-cover rounded-lg shadow-sm border border-slate-200">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Ganti Gambar <span class="text-slate-400 font-normal">(kosongkan jika tidak ingin mengubah)</span></label>
                        <div class="relative group cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl hover:border-brand-500 hover:bg-brand-50 transition-all duration-300 w-full text-center">
                            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="px-6 py-12 flex flex-col items-center justify-center pointer-events-none">
                                <div class="w-16 h-16 mb-4 rounded-full bg-slate-100 group-hover:bg-white text-slate-400 group-hover:text-brand-500 flex items-center justify-center transition-colors shadow-sm">
                                    <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                </div>
                                <p class="text-slate-700 font-semibold mb-1">Klik atau seret gambar baru ke sini</p>
                                <p class="text-sm text-slate-500">Format: JPG, PNG, GIF, WebP (Maks. 5MB)</p>
                            </div>
                        </div>
                        <div id="imagePreview" class="hidden mt-6 flex justify-center w-full"></div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="p-6 sm:p-8 bg-slate-50 flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <a href="index.php" class="inline-flex justify-center items-center gap-2 px-6 py-3 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                        <i class="fas fa-save"></i> Update Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Max 5MB');
            event.target.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="max-w-full sm:max-w-xs h-auto object-cover rounded-lg shadow-sm border border-slate-200 mt-4">';
            preview.style.display = 'flex';
        }
        reader.readAsDataURL(file);
    }
}
</script>

<?php include '../includes/footer.php'; ?>
