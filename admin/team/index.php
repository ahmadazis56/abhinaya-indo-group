<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

require_once '../../config/database.php';
$teamMembers = getTeam();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-7xl mx-auto">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Team Members</h1>
                <p class="text-slate-500 mt-1 text-sm">Kelola daftar anggota tim Abhinaya.</p>
            </div>
            <a href="add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                <i class="fas fa-plus"></i> Tambah Anggota
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50/80 text-slate-600">
                        <tr>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Profil</th>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Peran / Divisi</th>
                            <th class="text-left font-bold px-6 py-4 whitespace-nowrap">Kontak</th>
                            <th class="text-center font-bold px-6 py-4 whitespace-nowrap">Status</th>
                            <th class="text-center font-bold px-6 py-4 whitespace-nowrap">Urutan</th>
                            <th class="text-right font-bold px-6 py-4 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if (!empty($teamMembers)): ?>
                            <?php foreach ($teamMembers as $member): ?>
                                <tr class="hover:bg-slate-50/60 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-full bg-slate-50 border border-slate-200 overflow-hidden shrink-0 group-hover:border-brand-200 transition-colors">
                                                <img src="../uploads/team/<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900"><?php echo htmlspecialchars($member['name']); ?></div>
                                                <?php if (!empty($member['description'])): ?>
                                                    <div class="text-slate-500 text-xs mt-0.5 line-clamp-1 max-w-[200px]" title="<?php echo htmlspecialchars($member['description']); ?>">
                                                        <?php echo htmlspecialchars($member['description']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-slate-900"><?php echo htmlspecialchars($member['role']); ?></div>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold tracking-wide uppercase border bg-slate-50 text-slate-600 border-slate-200">
                                                <?php echo htmlspecialchars($member['division'] ?? 'general'); ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <?php if (!empty($member['email'])): ?>
                                                <a href="mailto:<?php echo htmlspecialchars($member['email']); ?>" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 text-slate-600 hover:bg-brand-50 hover:text-brand-600 hover:border-brand-200 transition-all shadow-sm" title="<?php echo htmlspecialchars($member['email']); ?>">
                                                    <i class="fas fa-envelope text-xs"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($member['linkedin'])): ?>
                                                <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-slate-50 border border-slate-200 text-[#0A66C2] hover:bg-[#0A66C2]/10 hover:border-[#0A66C2]/30 transition-all shadow-sm" title="LinkedIn Profile">
                                                    <i class="fab fa-linkedin-in text-xs"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (empty($member['email']) && empty($member['linkedin'])): ?>
                                                <span class="text-slate-400 text-xs italic">Tidak ada</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold <?php echo ($member['status'] ?? '') === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200'; ?>">
                                            <?php echo ucfirst($member['status'] ?? 'active'); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-slate-600 font-medium">
                                        <?php echo (int)($member['sort_order'] ?? 0); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="edit.php?id=<?php echo $member['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-brand-600 hover:border-brand-200 transition-all shadow-sm" title="Edit">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <a href="delete.php?id=<?php echo $member['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition-all shadow-sm" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota tim ini?')">
                                                <i class="fas fa-trash text-xs"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100">
                                        <i class="fas fa-users text-2xl text-slate-400"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Anggota Tim</h3>
                                    <p class="text-slate-500 mb-4 text-sm">Tambahkan anggota tim pertama Anda.</p>
                                    <a href="add.php" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-brand-700 bg-brand-50 border border-brand-200 rounded-xl hover:bg-brand-100 transition-colors">
                                        <i class="fas fa-plus"></i> Tambah Anggota Pertama
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
