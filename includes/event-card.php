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

<div class="group bg-white rounded-[2rem] overflow-hidden shadow-hostinger border border-gray-100 flex flex-col h-full hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300" data-aos="fade-up">
    <!-- Image Container (Hostinger Style 4:3 Ratio) -->
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
        <img src="<?php echo $image_url; ?>" 
             alt="<?php echo $event_title; ?>" 
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        
        <!-- Date Badge Floating -->
        <span class="absolute top-6 left-6 inline-flex items-center px-4 py-1.5 rounded-full text-[13px] font-bold tracking-wide backdrop-blur-md bg-white/90 shadow-sm text-slate-800">
            <?php echo $event_date; ?>
        </span>
    </div>

    <!-- Content -->
    <div class="p-8 md:p-10 flex flex-col flex-1">
        
        <div class="flex items-center text-primary-600 text-[12px] font-bold uppercase tracking-widest mb-4">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <?php echo $event_location; ?>
        </div>

        <h3 class="text-2xl font-heading font-black text-slate-900 mb-3 group-hover:text-primary-600 transition-colors duration-300 line-clamp-2">
            <?php echo $event_title; ?>
        </h3>

        <p class="text-slate-500 font-medium leading-relaxed mb-8 flex-1 line-clamp-3">
            <?php echo $event_description; ?>
        </p>

        <div class="mt-auto">
            <a href="event-detail.php?id=<?php echo $event['id']; ?>" class="inline-flex w-full items-center justify-center px-6 py-4 text-[15px] font-bold tracking-wide text-primary-600 transition-all bg-primary-50 rounded-xl group-hover:bg-primary-500 group-hover:text-white">
                Event Details
            </a>
        </div>
    </div>
</div>
