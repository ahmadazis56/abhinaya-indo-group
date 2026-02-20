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

<main class="flex-1 lg:ml-72">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Portfolio</h1>
                <p class="text-slate-600 mt-1">Kelola portfolio item</p>
            </div>
            <a href="add.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 text-white font-semibold hover:bg-brand-700">
                <i class="fas fa-plus"></i>
                <span>Add New</span>
            </a>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="text-left font-semibold px-5 py-3">Image</th>
                            <th class="text-left font-semibold px-5 py-3">Title</th>
                            <th class="text-left font-semibold px-5 py-3">Category</th>
                            <th class="text-left font-semibold px-5 py-3">Status</th>
                            <th class="text-left font-semibold px-5 py-3">Created</th>
                            <th class="text-right font-semibold px-5 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php if (!empty($portfolioItems)): ?>
                            <?php foreach ($portfolioItems as $item): ?>
                                <tr class="hover:bg-slate-50/60">
                                    <td class="px-5 py-4">
                                        <img src="../uploads/portfolio/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="w-14 h-10 rounded-lg object-cover border border-slate-200">
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-slate-900"><?php echo htmlspecialchars($item['title']); ?></div>
                                        <?php if (!empty($item['description'])): ?>
                                            <div class="text-slate-500 text-xs mt-1"><?php echo substr(htmlspecialchars($item['description']), 0, 100); ?>...</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700"><?php echo !empty($item['category']) ? htmlspecialchars($item['category']) : '-'; ?></td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold <?php echo ($item['status'] ?? '') === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-700'; ?>">
                                            <?php echo ucfirst($item['status'] ?? 'active'); ?>
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700"><?php echo !empty($item['created_at']) ? date('M d, Y', strtotime($item['created_at'])) : '-'; ?></td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $item['id']; ?>" class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100" title="Delete" onclick="return confirm('Are you sure you want to delete this portfolio item?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-slate-600">
                                    <div class="text-slate-400 mb-2"><i class="fas fa-folder-open text-3xl"></i></div>
                                    <div class="font-semibold">No Portfolio Items</div>
                                    <div class="text-sm text-slate-500 mt-1">Start by adding your first portfolio item.</div>
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
