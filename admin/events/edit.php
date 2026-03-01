<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

// Get event ID from URL
$eventId = $_GET['id'] ?? 0;

// Database connection
require_once '../../config/database.php';

// Get event data
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error_message'] = 'Event tidak ditemukan!';
    header('Location: index.php');
    exit();
}

$event = $result->fetch_assoc();
$stmt->close();

$eventDateValue = '';
if (isset($event['event_date']) && !empty($event['event_date'])) {
    $eventDateValue = $event['event_date'];
} elseif (isset($event['date']) && !empty($event['date'])) {
    $eventDateValue = $event['date'];
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Event</h1>
                <p class="text-slate-500 mt-1 text-sm">Ubah detail kegiatan atau acara.</p>
            </div>
            <a href="index.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <form action="update_event.php" method="POST" enctype="multipart/form-data" class="event-form divide-y divide-slate-100">
                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                
                <!-- Data Event Section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-info-circle text-brand-500"></i> Informasi Event
                    </h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Judul Event *</label>
                            <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($event['title']); ?>" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Event *</label>
                            <textarea id="description" name="description" rows="5" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400 resize-y"><?php echo htmlspecialchars($event['description']); ?></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="event_date" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Event *</label>
                                <input type="date" id="event_date" name="event_date" required value="<?php echo htmlspecialchars($eventDateValue); ?>" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                            </div>
                            <div>
                                <label for="time" class="block text-sm font-semibold text-slate-700 mb-2">Waktu Event</label>
                                <input type="time" id="time" name="time" value="<?php echo $event['time']; ?>" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Event *</label>
                            <input type="text" id="location" name="location" required value="<?php echo htmlspecialchars($event['location']); ?>" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium placeholder:text-slate-400">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status Event *</label>
                            <select id="status" name="status" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-slate-900 bg-white focus:outline-none focus:ring-4 focus:ring-brand-600/15 focus:border-brand-600 transition-all font-medium">
                                <option value="upcoming" <?php echo $event['status'] === 'upcoming' ? 'selected' : ''; ?>>Upcoming</option>
                                <option value="ongoing" <?php echo $event['status'] === 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                                <option value="past" <?php echo $event['status'] === 'past' ? 'selected' : ''; ?>>Past</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Media Section -->
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-image text-brand-500"></i> Gambar Event
                    </h3>
                    
                    <?php if (!empty($event['image'])): ?>
                    <div class="current-image mb-8 border border-slate-200 rounded-xl p-4 bg-slate-50">
                        <label class="block text-sm font-semibold text-slate-700 mb-3">Gambar Saat Ini:</label>
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <img src="../uploads/events/<?php echo htmlspecialchars($event['image']); ?>" alt="Current Image" class="w-full sm:w-auto sm:max-w-xs h-32 object-cover rounded-lg shadow-sm border border-slate-200">
                            <button type="button" class="inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-rose-600 bg-white border border-rose-200 rounded-lg hover:bg-rose-50 hover:border-rose-300 transition-colors shadow-sm" onclick="removeCurrentImage()">
                                <i class="fas fa-trash"></i> Hapus Gambar
                            </button>
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
                        <i class="fas fa-save"></i> Update Event
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
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="max-width: 200px; max-height: 150px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">';
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

function removeCurrentImage() {
    if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
        // Add hidden input to indicate image removal
        const form = document.querySelector('.event-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'remove_image';
        hiddenInput.value = '1';
        form.appendChild(hiddenInput);
        
        // Hide current image section
        document.querySelector('.current-image').style.display = 'none';
    }
}

// Form validation
document.querySelector('.event-form').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const date = document.getElementById('event_date').value;
    const location = document.getElementById('location').value.trim();
    
    if (!title || !description || !date || !location) {
        e.preventDefault();
        showNotification('Mohon lengkapi semua field yang wajib diisi!', 'error');
        return false;
    }
    
    // Show loading state
    const submitBtn = e.target.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<span>⏳</span> Menyimpan...';
    submitBtn.disabled = true;
});
</script>

<?php include '../includes/footer.php'; ?>
