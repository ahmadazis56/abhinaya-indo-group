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

<div class="main-content">
    <div class="page-header">
        <h1>➕ Tambah Event Baru</h1>
        <a href="index.php" class="btn btn-secondary">
            <span>←</span> Kembali
        </a>
    </div>

    <div class="form-container">
        <form action="save_event.php" method="POST" enctype="multipart/form-data" class="event-form">
            <div class="form-section">
                <h3>Informasi Event</h3>
                
                <div class="form-group">
                    <label for="title">Judul Event *</label>
                    <input type="text" id="title" name="title" required placeholder="Masukkan judul event">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Event *</label>
                    <textarea id="description" name="description" rows="4" required placeholder="Deskripsi lengkap tentang event"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Tanggal Event *</label>
                        <input type="date" id="event_date" name="event_date" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Waktu Event</label>
                        <input type="time" id="time" name="time" placeholder="09:00">
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Lokasi Event *</label>
                    <input type="text" id="location" name="location" required placeholder="Contoh: Jakarta, Mataram, Online">
                </div>

                <div class="form-group">
                    <label for="status">Status Event *</label>
                    <select id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="past">Past</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h3>Media Event</h3>
                
                <div class="form-group">
                    <label for="image">Gambar Event *</label>
                    <div class="file-upload">
                        <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                        <div class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Klik untuk upload gambar</p>
                            <small>Format: JPG, PNG, GIF (Max: 5MB)</small>
                        </div>
                        <div id="imagePreview" class="image-preview"></div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <span>💾</span> Simpan Event
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <span>❌</span> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 800px;
    }

    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .form-section h3 {
        color: #1e293b;
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #374151;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #14aecf;
        box-shadow: 0 0 0 3px rgba(20, 174, 207, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .file-upload {
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload:hover {
        border-color: #14aecf;
        background: #f8fafc;
    }

    .file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-upload-label i {
        font-size: 3rem;
        color: #14aecf;
        margin-bottom: 1rem;
    }

    .file-upload-label p {
        color: #374151;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .file-upload-label small {
        color: #6b7280;
    }

    .image-preview {
        margin-top: 1rem;
        display: none;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 1rem;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .form-container {
            padding: 1.5rem;
        }
    }
</style>

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
