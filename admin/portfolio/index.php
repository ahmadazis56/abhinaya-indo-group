<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';
$portfolioItems = getPortfolio();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-7xl mx-auto">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Portfolio</h1>
                <p class="text-slate-500 mt-1 text-sm">Kelola daftar item portofolio proyek Anda.</p>
            </div>
            <a href="add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                <i class="fas fa-plus"></i> Tambah Item
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50/80 text-slate-600">
                        <tr>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Gambar</th>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Judul Proyek</th>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Kategori</th>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Tgl Dibuat</th>
                            <th class="text-right font-bold px-6 py-4 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (!empty($portfolioItems)): ?>
                            <?php foreach ($portfolioItems as $item): ?>
                                <tr class="hover:bg-slate-50/60 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-20 h-14 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden group-hover:border-brand-200 transition-colors">
                                            <img src="../uploads/portfolio/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900"><?php echo htmlspecialchars($item['title']); ?></div>
                                        <?php if (!empty($item['description'])): ?>
                                            <div class="text-slate-500 text-xs mt-1 leading-relaxed max-w-sm shrink-0"><?php echo substr(htmlspecialchars($item['description']), 0, 80); ?>...</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[11px] font-bold tracking-wide uppercase border bg-slate-50 text-slate-600 border-slate-200">
                                            <?php echo !empty($item['category']) ? htmlspecialchars($item['category']) : 'Uncategorized'; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-500 text-xs font-medium">
                                        <?php echo !empty($item['created_at']) ? date('M d, Y', strtotime($item['created_at'])) : '-'; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-brand-600 hover:border-brand-200 transition-all shadow-sm" title="Edit">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $item['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all shadow-sm" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus portfolio item ini?')">
                                                <i class="fas fa-trash text-xs"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100">
                                        <i class="fas fa-folder-open text-2xl text-slate-400"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Portofolio</h3>
                                    <p class="text-slate-500 mb-4 text-sm">Tambahkan item portofolio proyek pertama Anda.</p>
                                    <a href="add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-brand-700 bg-brand-50 border border-brand-200 rounded-xl hover:bg-brand-100 transition-colors">
                                        <i class="fas fa-plus"></i> Tambah Item Pertama
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
