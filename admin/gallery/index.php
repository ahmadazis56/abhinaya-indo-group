<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit();
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/messages.php';

// Database connection
require_once '../../config/database.php';

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

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
<div class="p-6 sm:p-8 max-w-7xl mx-auto">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Gallery Foto</h1>
            <p class="text-slate-500 mt-1 text-sm">Kelola foto dokumentasi event, portofolio, dan lainnya.</p>
        </div>
        <a href="add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
            <i class="fas fa-plus"></i> Tambah Foto
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <!-- Total Photos -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium mb-1">Total Foto</div>
                    <div class="text-3xl font-bold text-slate-900"><?php echo $totalPhotos; ?></div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
        </div>

        <!-- Total Size -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium mb-1">Total Ukuran</div>
                    <div class="text-3xl font-bold text-slate-900"><?php echo number_format($totalSize / 1024 / 1024, 2); ?> <span class="text-xl font-semibold text-slate-400">MB</span></div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fas fa-hard-drive"></i>
                </div>
            </div>
        </div>
        
        <!-- Categories -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-slate-500 text-sm font-medium mb-1">Kategori</div>
                    <div class="text-3xl font-bold text-slate-900"><?php echo count(array_unique(array_column($gallery, 'category'))); ?></div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Box -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <!-- Filter & Search Bar -->
        <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-white">
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <label class="text-sm font-medium text-slate-500">Kategori:</label>
                <select id="categoryFilter" onchange="filterGallery()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block p-2.5 outline-none transition-colors">
                    <option value="">Semua Kategori</option>
                    <option value="events">Events</option>
                    <option value="projects">Projects</option>
                    <option value="team">Team</option>
                    <option value="office">Office</option>
                    <option value="clients">Clients</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input type="text" id="searchInput" onkeyup="filterGallery()" class="bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 p-2.5 outline-none transition-colors" placeholder="Cari judul foto...">
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="p-6 bg-slate-50/50">
            <?php if (!empty($gallery)): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="galleryGrid">
                    <?php foreach ($gallery as $photo): ?>
                        <div class="gallery-item bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg hover:border-brand-200 transition-all duration-300 group flex flex-col" data-category="<?php echo $photo['category']; ?>" data-title="<?php echo strtolower($photo['title']); ?>">
                            
                            <div class="aspect-square sm:aspect-[4/3] relative overflow-hidden bg-slate-100">
                                <img src="../uploads/gallery/<?php echo htmlspecialchars($photo['image']); ?>" alt="<?php echo htmlspecialchars($photo['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                
                                <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                                    <button class="w-10 h-10 rounded-full bg-white/20 text-white hover:bg-brand-500 hover:scale-110 flex items-center justify-center transition-all" onclick="viewPhoto('<?php echo $photo['image']; ?>', '<?php echo htmlspecialchars(addslashes($photo['title'])); ?>', '<?php echo htmlspecialchars(addslashes($photo['description'])); ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="edit.php?id=<?php echo $photo['id']; ?>" class="w-10 h-10 rounded-full bg-white/20 text-white hover:bg-amber-500 hover:scale-110 flex items-center justify-center transition-all">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="w-10 h-10 rounded-full bg-white/20 text-white hover:bg-rose-500 hover:scale-110 flex items-center justify-center transition-all" onclick="deletePhoto(<?php echo $photo['id']; ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                
                                <?php
                                $catColor = 'bg-slate-500';
                                if($photo['category'] == 'events') $catColor = 'bg-brand-500';
                                if($photo['category'] == 'projects') $catColor = 'bg-emerald-500';
                                if($photo['category'] == 'team') $catColor = 'bg-amber-500';
                                if($photo['category'] == 'office') $catColor = 'bg-violet-500';
                                if($photo['category'] == 'clients') $catColor = 'bg-rose-500';
                                ?>
                                <div class="absolute top-3 left-3 px-2.5 py-1 text-[10px] font-bold text-white rounded-md shadow-sm <?php echo $catColor; ?>">
                                    <?php echo ucfirst($photo['category']); ?>
                                </div>
                            </div>
                            
                            <div class="p-4 flex-1 flex flex-col">
                                <h4 class="text-sm font-bold text-slate-900 mb-1 line-clamp-1 group-hover:text-brand-600 transition-colors" title="<?php echo htmlspecialchars($photo['title']); ?>"><?php echo htmlspecialchars($photo['title']); ?></h4>
                                <p class="text-xs text-slate-400 mb-4"><?php echo date('d M Y', strtotime($photo['created_at'])); ?></p>
                                
                                <form method="POST" action="update_sort_order.php" class="mt-auto flex gap-2">
                                    <input type="hidden" name="id" value="<?php echo (int)$photo['id']; ?>">
                                    <div class="relative flex-1">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none text-slate-400 border-r border-slate-200 pr-2">
                                            <i class="fas fa-sort text-[10px]"></i>
                                        </div>
                                        <input type="number" name="sort_order" value="<?php echo (int)($photo['sort_order'] ?? 0); ?>" class="bg-slate-50 border border-slate-200 text-slate-900 text-xs rounded-lg focus:ring-brand-500 focus:border-brand-500 block w-full pl-8 p-1.5 outline-none transition-colors" placeholder="Order">
                                    </div>
                                    <button type="submit" class="inline-flex justify-center items-center px-2.5 py-1.5 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-slate-200 border-dashed">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-50 flex items-center justify-center text-slate-400"><i class="fas fa-images text-2xl"></i></div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Belum Ada Foto</h3>
                    <p class="text-slate-500 mb-6 max-w-sm mx-auto">Anda belum menambahkan foto apapun ke gallery.</p>
                    <a href="add.php" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm">
                        <i class="fas fa-plus"></i> Tambah Foto Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</main>

<!-- Photo Modal -->
<div id="photoModal" class="fixed inset-0 z-[100] hidden">
    <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity" onclick="closePhotoModal()"></div>
    
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl opacity-100 scale-100">
                <button type="button" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg p-2 transition-colors z-10" onclick="closePhotoModal()">
                    <i class="fas fa-times text-xl"></i>
                </button>
                
                <div class="flex flex-col md:flex-row">
                    <!-- Image -->
                    <div class="md:w-2/3 bg-slate-100 flex items-center justify-center min-h-[300px] md:min-h-[500px]">
                        <img id="modalImage" src="" alt="Gallery Photo" class="max-w-full max-h-[500px] object-contain">
                    </div>
                    
                    <!-- Info -->
                    <div class="md:w-1/3 p-6 sm:p-8 bg-white flex flex-col">
                        <h3 id="modalTitle" class="text-xl font-bold text-slate-900 mb-4 pr-6"></h3>
                        <p id="modalDescription" class="text-slate-600 text-sm mb-6 flex-1 leading-relaxed"></p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-100 space-y-3">
                            <div class="flex items-center gap-3 text-sm">
                                <div class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-500 font-medium">Kategori</div>
                                    <div id="modalCategory" class="font-semibold text-slate-900 capitalize"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
