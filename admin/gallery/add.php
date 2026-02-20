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
        <h1>➕ Tambah Foto Gallery</h1>
        <a href="index.php" class="btn btn-secondary">
            <span>←</span> Kembali
        </a>
    </div>

    <div class="form-container">
        <form action="save_gallery.php" method="POST" enctype="multipart/form-data" class="gallery-form">
            <div class="form-section">
                <h3>Upload Foto Gallery</h3>

                <div class="form-group">
                    <label for="sort_order">Urutan (Sort Order)</label>
                    <input type="number" id="sort_order" name="sort_order" value="0">
                </div>
                
                <div class="form-group">
                    <div class="file-upload">
                        <input type="file" id="image" name="image" accept="image/*" required onchange="previewGalleryImage(event)">
                        <div class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h4>Klik untuk Upload Foto</h4>
                            <p>Format: JPG, PNG, GIF, WebP (Max: 5MB)</p>
                        </div>
                        <div id="imagePreview" class="image-preview"></div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <span>⬆️</span> Upload
                </button>
                <a href="index.php" class="btn btn-secondary">
                    Batal
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
        min-height: 80px;
    }

    .file-upload {
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .file-upload:hover {
        border-color: #14aecf;
        background: #f0f9ff;
    }

    .file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .file-upload-label i {
        font-size: 3rem;
        color: #14aecf;
        margin-bottom: 1rem;
    }

    .file-upload-label h4 {
        color: #374151;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .file-upload-label p {
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .file-upload-label small {
        color: #9ca3af;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .image-preview {
        display: none;
        margin-top: 2rem;
        text-align: center;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        background: white;
        padding: 1rem;
    }

    .photo-requirements {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
    }

    .photo-requirements h4 {
        color: #0369a1;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .photo-requirements ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .photo-requirements li {
        color: #0c4a6e;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 2rem;
        border-top: 1px solid #e2e8f0;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .image-preview img {
            max-width: 100%;
            max-height: 200px;
        }
    }
</style>

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
