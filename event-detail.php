<?php
require_once 'config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: events.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: events.php');
    exit;
}

$event = $result->fetch_assoc();
$stmt->close();

$pageTitle = htmlspecialchars($event['title']) . " - Abhinaya Events";
$pageDesc = "Join us for " . htmlspecialchars($event['title']) . " hosted by Abhinaya Indo Group.";
include 'includes/header.php';

$event_date = isset($event['date']) ? date('d M Y', strtotime($event['date'])) : '';
$image_url = 'admin/uploads/events/' . htmlspecialchars($event['image']);
if (empty($event['image'])) {
    $image_url = 'https://via.placeholder.com/1200x600?text=Event+Cover';
}
?>

<!-- Hero Section for Event Detail -->
<section class="relative w-full pt-32 pb-24 md:pt-40 md:pb-32 bg-slate-900 border-b border-secondary-100 text-center">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiMwZjk0ODgiIGZpbGwtb3BhY2l0eT0iMC4wNSIvPjwvc3ZnPg==')] z-0 hidden"></div>
    <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-primary-900/50 to-transparent z-0 opacity-20"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <div class="inline-flex items-center px-4 py-2 bg-slate-800/50 rounded-full border border-slate-700 backdrop-blur-md mb-8">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>
            <span class="text-sm font-bold text-slate-300 uppercase tracking-widest"><?php echo $event_date; ?></span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold mb-6 leading-tight text-white tracking-tight">
            <?php echo htmlspecialchars($event['title']); ?>
        </h1>
        <div class="flex items-center justify-center space-x-2 text-primary-400 text-sm font-bold uppercase tracking-widest mt-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span><?php echo htmlspecialchars($event['location']); ?></span>
        </div>
    </div>
</section>

<!-- Event Details Content -->
<section class="py-16 md:py-24 bg-white relative">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Large Cover Image -->
        <div class="w-full max-w-2xl mx-auto rounded-[2rem] overflow-hidden mb-16 shadow-hostinger border border-gray-100 relative -mt-32 md:-mt-40 z-20" data-aos="fade-up" data-aos-delay="100">
            <img src="<?php echo $image_url; ?>" alt="Event Cover" class="w-full h-auto object-cover bg-white">
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12" data-aos="fade-up" data-aos-delay="200">
            <!-- Main Content -->
            <div class="lg:col-span-2 prose prose-lg prose-slate max-w-none">
                <h2 class="text-3xl font-heading font-black text-slate-900 mb-6">About This Event</h2>
                <div class="text-slate-600 leading-relaxed font-medium whitespace-pre-line">
                    <?php echo htmlspecialchars($event['description']); ?>
                </div>
            </div>
            
            <!-- Sidebar Details -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 shadow-sm sticky top-28">
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-6">Event Info</h3>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 shrink-0 mr-4">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-400 uppercase tracking-widest mb-1">Date</p>
                                <p class="text-base font-bold text-slate-900"><?php echo $event_date; ?></p>
                            </div>
                        </li>
                        
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 shrink-0 mr-4">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-400 uppercase tracking-widest mb-1">Time</p>
                                <p class="text-base font-bold text-slate-900"><?php echo htmlspecialchars($event['time'] ?? 'TBA'); ?></p>
                            </div>
                        </li>

                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 shrink-0 mr-4">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-400 uppercase tracking-widest mb-1">Location</p>
                                <p class="text-base font-bold text-slate-900"><?php echo htmlspecialchars($event['location']); ?></p>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <a href="https://wa.me/6285646603602?text=<?php echo urlencode('Halo Abhinaya, saya ingin mendaftar untuk event: ' . $event['title']); ?>" target="_blank" class="w-full inline-flex items-center justify-center px-6 py-4 text-[15px] font-bold tracking-wide text-white transition-all bg-primary-500 rounded-xl hover:bg-primary-600 shadow-md">
                            Register / Inquire
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<?php include 'includes/footer.php'; ?>
