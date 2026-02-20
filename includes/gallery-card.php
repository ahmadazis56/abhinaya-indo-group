<?php
/**
 * Reusable Gallery Card Component
 * Path: includes/gallery-card.php
 */

$photo_title = htmlspecialchars($photo['title'] ?? '');
$photo_image = htmlspecialchars($photo['image'] ?? '');
$photo_category = htmlspecialchars($photo['category'] ?? 'General');

$image_url = 'admin/uploads/gallery/' . $photo_image;
if (empty($photo_image)) {
    $image_url = 'https://via.placeholder.com/600x600?text=Gallery+Image';
}
?>

<div class="group relative aspect-square overflow-hidden rounded-2xl bg-slate-200 shadow-sm hover:shadow-xl transition-all duration-500 cursor-pointer" data-aos="fade-up">
    <img src="<?php echo $image_url; ?>" 
         alt="<?php echo $photo_title; ?>" 
         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
        <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
            <?php echo $photo_category; ?>
        </span>
        <h3 class="text-white text-lg font-bold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">
            <?php echo $photo_title; ?>
        </h3>
    </div>
</div>
