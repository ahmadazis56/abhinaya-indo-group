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
    <div class="p-6 sm:p-8 max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Event Baru</h1>
                <p class="text-slate-500 mt-1 text-sm">Tambahkan detail kegiatan atau acara baru.</p>
            </div>
            <a href="index.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <form action="save_event.php" method="POST" enctype="multipart/form-data" class="event-form divide-y divide-slate-100">
                <!-- Data Event Section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-brand-500"></i> Informasi Event
                    </h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Event *</label>
                            <input type="text" id="title" name="title" required placeholder="Masukkan judul event" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Event *</label>
                            <textarea id="description" name="description" rows="5" required placeholder="Deskripsi lengkap tentang event" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="event_date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Event *</label>
                                <input type="date" id="event_date" name="event_date" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                            </div>
                            <div>
                                <label for="time" class="block text-sm font-semibold text-slate-700 mb-2">Waktu Event</label>
                                <input type="time" id="time" name="time" placeholder="09:00" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Event *</label>
                            <input type="text" id="location" name="location" required placeholder="Contoh: Jakarta, Mataram, Online" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Event *</label>
                            <select id="status" name="status" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                <option value="">Pilih Status</option>
                                <option value="upcoming">Upcoming</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="past">Past</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Media Section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-image text-brand-500"></i> Media Event
                    </h3>
                    
                    <div>
                        <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Gambar Event *</label>
                        <div class="relative group cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl hover:border-brand-500 hover:bg-brand-50 transition-all duration-300 w-full text-center">
                            <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="px-6 py-12 flex flex-col items-center justify-center pointer-events-none">
                                <div class="w-16 h-16 mb-4 rounded-full bg-slate-100 group-hover:bg-white text-slate-400 group-hover:text-brand-500 flex items-center justify-center transition-colors shadow-sm">
                                    <i class="fas fa-cloud-upload-alt text-2xl"></i>
                                </div>
                                <p class="text-slate-700 font-semibold mb-1">Klik atau seret gambar ke sini</p>
                                <p class="text-sm text-slate-500">Format: JPG, PNG, GIF (Maks. 5MB)</p>
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
                        <i class="fas fa-save"></i> Simpan Event
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
        // Check file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Max 5MB');
            event.target.value = '';
            return;
        }
        
        // Check file type
        if (!file.type.match('image.*')) {
            alert('File harus berupa gambar!');
            event.target.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview">';
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

// Form validation
document.querySelector('.event-form').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const date = document.getElementById('event_date').value;
    const location = document.getElementById('location').value.trim();
    const image = document.getElementById('image').files[0];
    
    if (!title || !description || !date || !location || !image) {
        e.preventDefault();
        showNotification('Mohon lengkapi semua field yang wajib diisi!', 'error');
        return false;
    }
    
    // Validate date is not in the past for upcoming events
    const status = document.getElementById('status').value;
    const eventDate = new Date(date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (status === 'upcoming' && eventDate < today) {
        e.preventDefault();
        showNotification('Tanggal event tidak boleh di masa lalu untuk status upcoming!', 'error');
        return false;
    }
});
</script>

<?php include '../includes/footer.php'; ?>
