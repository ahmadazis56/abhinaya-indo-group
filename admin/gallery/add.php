<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-3xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Foto Gallery</h1>
                <p class="text-slate-500 mt-1 text-sm">Upload foto baru ke gallery website.</p>
            </div>
            <a href="index.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <form action="save_gallery.php" method="POST" enctype="multipart/form-data" class="gallery-form divide-y divide-slate-100">
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-cloud-upload-alt text-brand-500"></i> Upload Foto Gallery
                    </h3>

                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Foto *</label>
                            <input type="text" id="title" name="title" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Foto</label>
                            <textarea id="description" name="description" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-semibold text-slate-700 mb-2">Kategori *</label>
                                <select id="category" name="category" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                    <option value="events">Events</option>
                                    <option value="projects">Projects</option>
                                    <option value="team">Team</option>
                                    <option value="office">Office</option>
                                    <option value="clients">Clients</option>
                                    <option value="other" selected>Other</option>
                                </select>
                            </div>
                            <div>
                                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Urutan (Sort Order)</label>
                                <input type="number" id="sort_order" name="sort_order" value="0" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                            </div>
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Foto *</label>
                            
                            <div class="relative group cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl hover:border-brand-500 hover:bg-brand-50 transition-all duration-300 w-full text-center overflow-hidden">
                                <input type="file" id="image" name="image" accept="image/*" required onchange="previewGalleryImage(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="px-6 py-12 flex flex-col items-center justify-center pointer-events-none">
                                    <div class="w-16 h-16 mb-4 rounded-full bg-slate-100 group-hover:bg-white text-slate-400 group-hover:text-brand-500 flex items-center justify-center transition-colors shadow-sm">
                                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                    </div>
                                    <h4 class="text-slate-800 font-bold mb-1 text-lg">Klik atau seret foto ke sini</h4>
                                    <p class="text-slate-500 mb-4 text-sm">Preview foto akan muncul setelah dipilih</p>
                                    
                                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 w-full max-w-sm text-left mx-auto">
                                        <div class="text-[11px] font-semibold text-blue-800 mb-1 uppercase tracking-wider">Persyaratan Foto:</div>
                                        <ul class="text-xs text-blue-700 list-disc list-inside space-y-0.5">
                                            <li>Format: JPG, PNG, GIF, WebP</li>
                                            <li>Ukuran maksimal: 5MB</li>
                                            <li>Resolusi minimal: 800x600px</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="imagePreview" class="hidden mt-6">
                                <p class="text-sm font-semibold text-slate-700 mb-2 text-center">Preview:</p>
                                <div class="flex justify-center">
                                    <img src="" alt="Preview" class="max-w-full sm:max-w-md max-h-[300px] object-contain rounded-xl shadow-sm border border-slate-200 bg-slate-50 p-2">
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
                        <i class="fas fa-upload"></i> Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
function previewGalleryImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        // Check file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Max 5MB');
            event.target.value = '';
            return;
        }
        
        // Check file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            alert('File harus berupa gambar dengan format JPG, PNG, GIF, atau WebP!');
            event.target.value = '';
            return;
        }
        
        // Check image dimensions
        const img = new Image();
        img.onload = function() {
            if (this.width < 800 || this.height < 600) {
                alert('Resolusi foto terlalu kecil! Minimum 800x600px');
                event.target.value = '';
                return;
            }
            displayPreview(file);
        };
        img.src = URL.createObjectURL(file);
    }
}

function displayPreview(file) {
    const preview = document.getElementById('imagePreview');
    const reader = new FileReader();
    
    reader.onload = function(e) {
        preview.innerHTML = '<img src="' + e.target.result + '" alt="Gallery Preview">';
        preview.style.display = 'block';
    };
    
    reader.readAsDataURL(file);
}

// Form validation
document.querySelector('.gallery-form').addEventListener('submit', function(e) {
    const image = document.getElementById('image').files[0];
    
    if (!image) {
        e.preventDefault();
        showNotification('Pilih file foto!', 'error');
        return false;
    }
    
    // Show loading state
    const submitBtn = e.target.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<span>⏳</span> Mengupload...';
    submitBtn.disabled = true;
});
</script>

<?php include '../includes/footer.php'; ?>
