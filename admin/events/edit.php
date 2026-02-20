<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

// Get event ID from URL
$eventId = $_GET['id'] ?? 0;

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';
?>

<div class="main-content">
    <div class="page-header">
        <h1>✏️ Edit Event</h1>
        <a href="index.php" class="btn btn-secondary">
            <span>←</span> Kembali
        </a>
    </div>

    <div class="form-container">
        <form action="update_event.php" method="POST" enctype="multipart/form-data" class="event-form">
            <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
            
            <div class="form-section">
                <h3>Informasi Event</h3>
                
                <div class="form-group">
                    <label for="title">Judul Event *</label>
                    <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($event['title']); ?>">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Event *</label>
                    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Tanggal Event *</label>
                        <input type="date" id="date" name="date" required value="<?php echo $event['date']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="time">Waktu Event</label>
                        <input type="time" id="time" name="time" value="<?php echo $event['time']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Lokasi Event *</label>
                    <input type="text" id="location" name="location" required value="<?php echo htmlspecialchars($event['location']); ?>">
                </div>

                <div class="form-group">
                    <label for="status">Status Event *</label>
                    <select id="status" name="status" required>
                        <option value="upcoming" <?php echo $event['status'] === 'upcoming' ? 'selected' : ''; ?>>Upcoming</option>
                        <option value="ongoing" <?php echo $event['status'] === 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="past" <?php echo $event['status'] === 'past' ? 'selected' : ''; ?>>Past</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h3>Gambar Event</h3>
                
                <?php if (!empty($event['image'])): ?>
                <div class="current-image">
                    <label>Gambar Saat Ini:</label>
                    <div class="image-preview">
                        <img src="../uploads/events/<?php echo htmlspecialchars($event['image']); ?>" alt="Current Image">
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeCurrentImage()">
                            <i class="fas fa-trash"></i> Hapus Gambar
                        </button>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="image">Ganti Gambar (kosongkan jika tidak ingin mengubah)</label>
                    <div class="file-upload">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <div class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Klik untuk upload gambar baru</p>
                            <small>Format: JPG, PNG, GIF, WebP (Max: 5MB)</small>
                        </div>
                        <div id="imagePreview" class="image-preview"></div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <span>💾</span> Update Event
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

    .current-image {
        margin-bottom: 1.5rem;
    }

    .current-image label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #374151;
    }

    .image-preview {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
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
        font-size: 2rem;
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
        
        .image-preview {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

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
    const date = document.getElementById('date').value;
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
