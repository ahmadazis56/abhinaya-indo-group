<?php
/**
 * Reusable Logo Card Component (Client/Partner)
 * Path: includes/logo-card.php
 */

$logo_name = htmlspecialchars($logo['name'] ?? '');
$logo_image = htmlspecialchars($logo['image'] ?? '');
$logo_url = 'admin/uploads/logos/' . $logo_image;

if (empty($logo_image)) {
    $logo_url = 'https://via.placeholder.com/200x100?text=No+Logo';
}
?>

<div class="group relative flex items-center justify-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-soft transition-all duration-300 transform hover:-translate-y-1 border border-secondary-100 hover:border-primary-200 cursor-pointer overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 to-teal-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    <div class="relative z-10 w-full h-full flex items-center justify-center min-h-[80px]">
        <img src="<?php echo $logo_url; ?>" 
             alt="<?php echo $logo_name; ?>" 
             title="<?php echo $logo_name; ?>"
             class="object-contain max-h-12 max-w-full w-auto h-auto transition-all duration-500 grayscale opacity-60 group-hover:opacity-100 group-hover:grayscale-0 group-hover:scale-105">
    </div>
</div>
