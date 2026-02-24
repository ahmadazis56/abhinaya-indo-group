<?php
/**
 * Reusable Team Card Component
 * Path: includes/team-card.php
 */

$member_name = htmlspecialchars($member['name'] ?? '');
$member_role = htmlspecialchars($member['role'] ?? '');
$member_image = htmlspecialchars($member['image'] ?? '');
$member_division = strtolower($member['division'] ?? '');
$member_bio = htmlspecialchars($member['bio'] ?? '');

$image_url = 'admin/uploads/team/' . $member_image;
if (empty($member_image)) {
    $image_url = 'https://via.placeholder.com/400x400?text=No+Photo';
}

$division_colors = [
    'techno' => 'text-primary-600',
    'creative' => 'text-purple-600',
    'publisher' => 'text-emerald-600',
    'management' => 'text-slate-900'
];

$div_class = $division_colors[$member_division] ?? 'text-slate-500';
?>

<div class="text-center group" data-aos="fade-up">
    <!-- Image Wrapper (Hostinger Rounded Square Style) -->
    <div class="relative w-48 h-48 mx-auto mb-6 rounded-[2rem] overflow-hidden shadow-hostinger border border-gray-100 group-hover:shadow-hostinger-hover transition-all duration-300 transform group-hover:-translate-y-2 bg-slate-50">
        <img src="<?php echo $image_url; ?>" 
             alt="<?php echo $member_name; ?>" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter grayscale hover:grayscale-0">
    </div>
    
    <div class="space-y-1.5 px-2">
        <h3 class="text-xl font-heading font-black text-slate-900 group-hover:text-primary-600 transition-colors duration-300">
            <?php echo $member_name; ?>
        </h3>
        <div class="flex flex-col items-center">
            <span class="text-[12px] font-bold uppercase tracking-widest <?php echo $div_class; ?>">
                <?php echo $member_role; ?>
            </span>
            <?php if (!empty($member_bio)): ?>
                <p class="text-slate-500 font-medium text-sm mt-3 max-w-xs mx-auto line-clamp-2">
                    <?php echo $member_bio; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

