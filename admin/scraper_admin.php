<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
require_once '../scraper/news_scraper.php';

// Initialize scraper
$scraper = new NewsScraper();

// Handle actions
$action = $_GET['action'] ?? 'view';
$message = '';

if ($action === 'clear_cache') {
    $scraper->clearCache();
    $message = 'Cache cleared successfully!';
} elseif ($action === 'scrape_now') {
    $scraper->clearCache();
    $news = $scraper->getLatestNews(10);
    $message = 'Scraping completed! Found ' . count($news) . ' news items.';
}

// Get current cache status
$cacheStatus = $scraper->getCacheStatus();
$latestNews = $scraper->getLatestNews(10);
?>

<main class="flex-1 lg:ml-72 bg-slate-50 min-h-screen">
    <div class="p-6 sm:p-8 max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">News Scraper Admin</h1>
                <p class="text-slate-500 mt-1 text-sm">Kelola proses scraping berita otomatis dari situs WordPress.</p>
            </div>
            <div class="flex gap-3">
                <a href="?action=scrape_now" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 transition-colors shadow-sm shadow-brand-600/20">
                    <i class="fas fa-sync-alt"></i> Scrape Now
                </a>
                 <a href="?action=clear_cache" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-xl hover:bg-rose-100 transition-colors">
                    <i class="fas fa-trash-alt"></i> Clear Cache
                </a>
            </div>
        </div>

        <?php if ($message): ?>
            <div class="mb-8 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 flex items-start gap-3">
                <i class="fas fa-check-circle mt-0.5 text-emerald-600"></i>
                <div class="text-sm font-medium"><?php echo htmlspecialchars($message); ?></div>
            </div>
        <?php endif; ?>

        <!-- Cache Status Cards -->
        <h2 class="text-lg font-bold text-slate-900 mb-4">Cache Status</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-brand-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Status</p>
                        <h3 class="text-2xl font-bold text-slate-900">
                             <?php echo is_array($cacheStatus) ? ($cacheStatus['is_valid'] ? '<span class="text-emerald-500">Valid</span>' : '<span class="text-rose-500">Expired</span>') : '<span class="text-slate-400">No Cache</span>'; ?>
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                        <i class="fas fa-server text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Cache Age</p>
                        <h3 class="text-2xl font-bold text-slate-900">
                             <?php echo is_array($cacheStatus) ? gmdate('i:s', $cacheStatus['age']) : '00:00'; ?>
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Time Until Refresh</p>
                        <h3 class="text-2xl font-bold text-slate-900">
                            <?php echo is_array($cacheStatus) ? gmdate('i:s', $cacheStatus['remaining']) : '00:00'; ?>
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i class="fas fa-hourglass-half text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 mb-1">Items Scraped</p>
                        <h3 class="text-2xl font-bold text-slate-900">
                             <?php echo count($latestNews); ?>
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-lg font-bold text-slate-900 mb-4 inline-flex items-center gap-2">
            <i class="fas fa-newspaper text-brand-500"></i> Latest News
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $news): ?>
                    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group flex flex-col h-full">
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-100 border-b border-slate-100 shrink-0">
                            <?php if (!empty($news['image'])): ?>
                                <img src="<?php echo htmlspecialchars($news['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($news['image_alt'] ?? $news['title']); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.src='../assets/img/team management/abdul.png'">
                            <?php else: ?>
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                    <i class="fas fa-image text-4xl mb-2"></i>
                                    <span class="text-sm font-medium">No Image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-semibold whitespace-nowrap">
                                    <i class="far fa-calendar-alt mr-1"></i> <?php echo date('d M Y', strtotime($news['date'] ?? 'now')); ?>
                                </span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2 leading-tight">
                                <?php echo htmlspecialchars($news['title']); ?>
                            </h3>
                            
                            <?php if (!empty($news['excerpt'])): ?>
                                <p class="text-slate-500 text-sm line-clamp-3 mb-4 leading-relaxed flex-1">
                                    <?php echo htmlspecialchars($news['excerpt']); ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="mt-auto pt-4 border-t border-slate-100">
                                 <?php if (!empty($news['link'])): ?>
                                    <a href="<?php echo htmlspecialchars($news['link']); ?>" 
                                       class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 hover:text-brand-700 transition-colors" 
                                       target="_blank">
                                        Read Source Article <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full">
                    <div class="bg-white border border-slate-100 rounded-2xl p-12 text-center shadow-sm">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100">
                            <i class="fas fa-search text-2xl text-slate-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Tidak Ada Berita</h3>
                        <p class="text-slate-500 mb-4 text-sm max-w-sm mx-auto">Kami tidak menemukan data berita terbaru. Klik tombol "Scrape Now" di atas untuk mengambil berita.</p>
                        <a href="?action=scrape_now" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-brand-700 bg-brand-50 border border-brand-200 rounded-xl hover:bg-brand-100 transition-colors">
                            <i class="fas fa-sync-alt"></i> Coba Scrape Sekarang
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
