<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'abhinaya_admin';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get gallery photos
$gallery = [];
$hasSortOrder = $conn->query("SHOW COLUMNS FROM gallery LIKE 'sort_order'");
$orderBy = "created_at DESC";
if ($hasSortOrder && $hasSortOrder->num_rows > 0) {
    $orderBy = "sort_order ASC, created_at DESC";
}

$result = $conn->query("SELECT * FROM gallery ORDER BY {$orderBy}");
if ($result) {
    $gallery = $result->fetch_all(MYSQLI_ASSOC);
}

// Get statistics
$totalPhotos = count($gallery);
$totalSize = array_sum(array_column($gallery, 'file_size'));

$conn->close();
?>

<main class="flex-1 lg:ml-72">
<div class="p-4 sm:p-6 lg:p-8">
    <div class="page-header">
        <h1>📸 Gallery Foto</h1>
        <a href="add.php" class="btn btn-primary">
            <span>➕</span> Tambah Foto
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📸</div>
            <div class="stat-info">
                <h3><?php echo $totalPhotos; ?></h3>
                <p>Total Foto</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">💾</div>
            <div class="stat-info">
                <h3><?php echo number_format($totalSize / 1024 / 1024, 2); ?> MB</h3>
                <p>Total Ukuran</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📁</div>
            <div class="stat-info">
                <h3><?php echo count(array_unique(array_column($gallery, 'category'))); ?></h3>
                <p>Kategori</p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-left">
            <select id="categoryFilter" onchange="filterGallery()">
                <option value="">Semua Kategori</option>
                <option value="events">Events</option>
                <option value="projects">Projects</option>
                <option value="team">Team</option>
                <option value="office">Office</option>
                <option value="clients">Clients</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="filter-right">
            <input type="text" id="searchInput" placeholder="Cari judul foto..." onkeyup="filterGallery()">
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-container">
        <?php if (!empty($gallery)): ?>
            <div class="gallery-grid" id="galleryGrid">
                <?php foreach ($gallery as $photo): ?>
                    <div class="gallery-item" data-category="<?php echo $photo['category']; ?>" data-title="<?php echo strtolower($photo['title']); ?>">
                        <div class="gallery-image">
                            <img src="../uploads/gallery/<?php echo htmlspecialchars($photo['image']); ?>" alt="<?php echo htmlspecialchars($photo['title']); ?>">
                            <div class="gallery-overlay">
                                <div class="overlay-actions">
                                    <button class="btn btn-sm btn-info" onclick="viewPhoto('<?php echo $photo['image']; ?>', '<?php echo htmlspecialchars($photo['title']); ?>', '<?php echo htmlspecialchars($photo['description']); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="edit.php?id=<?php echo $photo['id']; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deletePhoto(<?php echo $photo['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-info">
                            <h4><?php echo htmlspecialchars($photo['title']); ?></h4>
                            <p class="gallery-category">
                                <span class="category-tag category-<?php echo $photo['category']; ?>">
                                    <?php echo ucfirst($photo['category']); ?>
                                </span>
                            </p>
                            <form method="POST" action="update_sort_order.php" class="sort-order-form">
                                <input type="hidden" name="id" value="<?php echo (int)$photo['id']; ?>">
                                <input type="number" name="sort_order" value="<?php echo (int)($photo['sort_order'] ?? 0); ?>" class="sort-order-input">
                                <button type="submit" class="btn btn-sm btn-info">Save</button>
                            </form>
                            <p class="gallery-date"><?php echo date('d M Y', strtotime($photo['created_at'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>Belum Ada Foto</h3>
                <p>Mulai dengan menambahkan foto ke gallery</p>
                <a href="add.php" class="btn btn-primary">
                    <span>➕</span> Tambah Foto Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>

</div>
</main>

<!-- Photo Modal -->
<div id="photoModal" class="modal">
    <div class="modal-content modal-large">
        <span class="close" onclick="closePhotoModal()">&times;</span>
        <div class="modal-gallery">
            <img id="modalImage" src="" alt="Gallery Photo">
            <div class="modal-gallery-info">
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
                <div class="modal-meta">
                    <span id="modalDate"></span>
                    <span id="modalCategory"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        font-size: 2rem;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #14aecf, #0f8c9f);
        border-radius: 12px;
        color: white;
    }

    .stat-info h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .stat-info p {
        color: #64748b;
        font-size: 0.9rem;
    }

    .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 1rem;
    }

    .filter-left select,
    .filter-right input {
        padding: 0.8rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.95rem;
        min-width: 200px;
    }

    .filter-right input {
        min-width: 300px;
    }

    .gallery-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .gallery-item {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .gallery-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .gallery-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-image img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .overlay-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-sm {
        padding: 0.5rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
        font-size: 0.8rem;
    }

    .btn-info { background: #3b82f6; }
    .btn-warning { background: #f59e0b; }
    .btn-danger { background: #ef4444; }

    .btn-sm:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .gallery-info {
        padding: 1rem;
    }

    .gallery-info h4 {
        color: #1e293b;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .category-tag {
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        color: white;
    }

    .category-events { background: #3b82f6; }
    .category-projects { background: #10b981; }
    .category-team { background: #f59e0b; }
    .category-office { background: #8b5cf6; }
    .category-clients { background: #ef4444; }
    .category-other { background: #6b7280; }

    .gallery-date {
        color: #64748b;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        color: #1e293b;
        margin-bottom: 1rem;
    }

    .modal-large {
        max-width: 900px;
    }

    .modal-gallery {
        display: flex;
        gap: 2rem;
    }

    .modal-gallery img {
        flex: 1;
        max-height: 500px;
        object-fit: contain;
        border-radius: 8px;
    }

    .modal-gallery-info {
        flex: 0 0 300px;
    }

    .modal-meta {
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .modal-meta span {
        padding: 0.3rem 0.8rem;
        background: #f8fafc;
        border-radius: 15px;
        font-size: 0.85rem;
        color: #64748b;
    }

    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-right input {
            min-width: auto;
        }
        
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .modal-gallery {
            flex-direction: column;
        }
        
        .modal-gallery-info {
            flex: 1;
        }
    }
</style>

<script>
function filterGallery() {
    const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
    const searchFilter = document.getElementById('searchInput').value.toLowerCase();
    const items = document.querySelectorAll('.gallery-item');
    
    items.forEach(item => {
        const category = item.dataset.category.toLowerCase();
        const title = item.dataset.title.toLowerCase();
        
        const matchesCategory = !categoryFilter || category === categoryFilter;
        const matchesSearch = !searchFilter || title.includes(searchFilter);
        
        if (matchesCategory && matchesSearch) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function viewPhoto(image, title, description) {
    const modal = document.getElementById('photoModal');
    document.getElementById('modalImage').src = '../uploads/gallery/' + image;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description || 'Tidak ada deskripsi';
    modal.style.display = 'block';
}

function closePhotoModal() {
    document.getElementById('photoModal').style.display = 'none';
}

function deletePhoto(id) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        window.location.href = 'delete_gallery.php?id=' + id;
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('photoModal');
    if (event.target == modal) {
        closePhotoModal();
    }
}
</script>

<?php include '../includes/footer.php'; ?>
