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
    'techno' => 'bg-blue-50 text-blue-700 ring-1 ring-blue-200/50',
    'creative' => 'bg-purple-50 text-purple-700 ring-1 ring-purple-200/50',
    'publisher' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/50',
    'general' => 'bg-slate-50 text-slate-700 ring-1 ring-slate-200/50'
];

$button_texts = [
    'techno' => 'Visit Website',
    'creative' => 'View Project Case Study',
    'publisher' => 'View Journal',
    'general' => 'View Project'
];

$cat_name = $cat_names[$cat_slug] ?? ucfirst($cat_slug);
$cat_class = $cat_colors[$cat_slug] ?? $cat_colors['general'];
$button_text = $button_texts[$cat_slug] ?? $button_texts['general'];

// Image path handling
$image_url = 'admin/uploads/portfolio/' . htmlspecialchars($project['image']);
if (empty($project['image'])) {
    $image_url = 'https://via.placeholder.com/600x400?text=No+Image';
}
?>

<div class="group bg-white rounded-[2rem] overflow-hidden shadow-hostinger border border-gray-100 flex flex-col h-full hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300" data-aos="fade-up">
    <!-- Image Container (Dynamic Ratio without clipping) -->
    <div class="relative flex justify-center items-center overflow-hidden bg-slate-100 border-b border-gray-100">
        <img src="<?php echo $image_url; ?>" 
             alt="<?php echo htmlspecialchars($project['title']); ?>" 
             class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-105">
        
        <!-- Category Badge Floating -->
        <span class="absolute top-6 left-6 inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-widest backdrop-blur-md bg-white/90 shadow-sm text-slate-800">
            <?php echo $cat_name; ?>
        </span>
    </div>

    <!-- Content -->
    <div class="p-8 md:p-10 flex flex-col flex-1">
        
        <h3 class="text-2xl font-heading font-black text-slate-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">
            <?php echo htmlspecialchars($project['title']); ?>
        </h3>

        <p class="text-slate-500 font-medium leading-relaxed mb-8 flex-1 line-clamp-3">
            <?php echo htmlspecialchars($project['description']); ?>
        </p>

        <?php if (!empty($project['link'])): ?>
            <div class="mt-auto">
                <a href="<?php echo htmlspecialchars($project['link']); ?>" 
                   target="_blank" 
                   class="inline-flex w-full items-center justify-center px-6 py-4 text-[15px] font-bold tracking-wide text-primary-600 transition-all bg-primary-50 rounded-xl group-hover:bg-primary-500 group-hover:text-white">
                    <?php echo $button_text; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
