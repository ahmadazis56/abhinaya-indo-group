<?php
/**
 * Reusable Logo Card Component (Client/Partner)
 * Path: includes/logo-card.php
 */

$logo_name = htmlspecialchars($logo['name'] ?? '');
$logo_image = htmlspecialchars($logo['image'] ?? '');
$logo_url = 'uploads/logos/' . $logo_image;

if (empty($logo_image)) {
    $logo_url = 'https://via.placeholder.com/200x100?text=No+Logo';
}
?>

<div class="group relative flex items-center justify-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border border-gray-100 hover:border-cyan-200 cursor-pointer" data-aos="fade-up">
    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 to-blue-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    <div class="relative z-10 w-full h-full flex items-center justify-center">
        <img src="<?php echo $logo_url; ?>" 
             alt="<?php echo $logo_name; ?>" 
             title="<?php echo $logo_name; ?>"
             class="object-contain max-h-16 w-auto transition-all duration-500 grayscale group-hover:grayscale-0 group-hover:scale-110">
    </div>
</div>
