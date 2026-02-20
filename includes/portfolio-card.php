<?php
/**
 * Reusable Portfolio Card Component
 * Path: includes/portfolio-card.php
 */

// Helper to get category color and name
$cat_slug = strtolower($project['category'] ?? 'general');
$cat_names = [
    'techno' => 'Techno',
    'creative' => 'Creative',
    'publisher' => 'Publisher',
    'general' => 'General'
];

$cat_colors = [
    'techno' => 'bg-blue-100 text-blue-700 border-blue-200',
    'creative' => 'bg-purple-100 text-purple-700 border-purple-200',
    'publisher' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
    'general' => 'bg-slate-100 text-slate-700 border-slate-200'
];

$cat_name = $cat_names[$cat_slug] ?? ucfirst($cat_slug);
$cat_class = $cat_colors[$cat_slug] ?? $cat_colors['general'];

// Image path handling
$image_url = 'admin/uploads/portfolio/' . htmlspecialchars($project['image']);
if (empty($project['image'])) {
    $image_url = 'https://via.placeholder.com/600x400?text=No+Image';
}
?>

<div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col h-full" data-aos="fade-up">
    <!-- Image Container -->
    <div class="relative aspect-[16/10] overflow-hidden">
        <img src="<?php echo $image_url; ?>" 
             alt="<?php echo htmlspecialchars($project['title']); ?>" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
    </div>

    <!-- Content -->
    <div class="p-6 flex flex-col flex-1">
        <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border <?php echo $cat_class; ?>">
                <?php echo $cat_name; ?>
            </span>
            <div class="flex items-center text-emerald-500 text-[10px] font-bold uppercase tracking-wider">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5 animate-pulse"></span>
                Live
            </div>
        </div>

        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors duration-300">
            <?php echo htmlspecialchars($project['title']); ?>
        </h3>

        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
            <?php echo htmlspecialchars($project['description']); ?>
        </p>

        <?php if (!empty($project['link'])): ?>
            <div class="mt-auto">
                <a href="<?php echo htmlspecialchars($project['link']); ?>" 
                   target="_blank" 
                   class="inline-flex items-center text-cyan-600 font-semibold text-sm hover:text-cyan-700 transition-colors group/link">
                    Visit Website
                    <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
