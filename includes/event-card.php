<?php
/**
 * Reusable Event Card Component
 * Path: includes/event-card.php
 */

$event_title = htmlspecialchars($event['title'] ?? '');
$event_date = isset($event['date']) ? date('d M Y', strtotime($event['date'])) : '';
$event_location = htmlspecialchars($event['location'] ?? '');
$event_image = htmlspecialchars($event['image'] ?? '');
$event_description = htmlspecialchars($event['description'] ?? '');

$image_url = 'admin/uploads/events/' . $event_image;
if (empty($event_image)) {
    $image_url = 'https://via.placeholder.com/600x400?text=Event+Image';
}
?>

<div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col h-full" data-aos="fade-up">
    <div class="relative aspect-[16/9] overflow-hidden">
        <img src="<?php echo $image_url; ?>" 
             alt="<?php echo $event_title; ?>" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-lg text-slate-900 text-xs font-bold shadow-sm">
                <?php echo $event_date; ?>
            </span>
        </div>
    </div>

    <div class="p-6 flex flex-col flex-1">
        <div class="flex items-center text-cyan-600 text-xs font-bold uppercase tracking-wider mb-3">
            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <?php echo $event_location; ?>
        </div>

        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors duration-300">
            <?php echo $event_title; ?>
        </h3>

        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
            <?php echo $event_description; ?>
        </p>

        <div class="mt-auto pt-6 border-t border-slate-50">
            <a href="events.php" class="inline-flex items-center text-slate-900 font-bold text-sm hover:text-cyan-600 transition-colors group/link">
                Learn More
                <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
