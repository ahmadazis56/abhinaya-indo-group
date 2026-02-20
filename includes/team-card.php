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
    'techno' => 'text-cyan-600',
    'creative' => 'text-purple-600',
    'publisher' => 'text-emerald-600',
    'management' => 'text-slate-600'
];

$div_class = $division_colors[$member_division] ?? 'text-slate-600';
?>

<div class="text-center group" data-aos="fade-up">
    <div class="relative mb-6 mx-auto w-48 h-48">
        <!-- Background Decoration -->
        <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-full scale-110 opacity-0 group-hover:opacity-100 transition-all duration-500 blur-xl"></div>
        
        <!-- Image Wrapper -->
        <div class="relative w-full h-full rounded-full overflow-hidden border-4 border-white shadow-xl group-hover:shadow-2xl transition-all duration-500 transform group-hover:scale-105">
            <img src="<?php echo $image_url; ?>" 
                 alt="<?php echo $member_name; ?>" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
    </div>
    
    <div class="space-y-2">
        <h3 class="text-2xl font-bold text-slate-900 group-hover:text-cyan-600 transition-colors duration-300">
            <?php echo $member_name; ?>
        </h3>
        <div class="flex flex-col items-center">
            <span class="text-sm font-bold uppercase tracking-wider <?php echo $div_class; ?>">
                <?php echo $member_role; ?>
            </span>
            <?php if (!empty($member_bio)): ?>
                <p class="text-slate-500 text-sm mt-2 max-w-xs mx-auto line-clamp-2">
                    <?php echo $member_bio; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
