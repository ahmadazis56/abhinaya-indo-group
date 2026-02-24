<?php
require_once 'config/database.php';

// Ambil data gallery
$gallery = getGalleryPhotos(null, 20); // Gunakan fungsi dari database.php

$pageTitle = "Gallery - Abhinaya Indo Group";
$pageDesc = "Photo gallery of Abhinaya Indo Group events, projects, and team activities.";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative w-full min-h-[50vh] flex items-center justify-center overflow-hidden pt-20 bg-secondary-900 border-b border-secondary-800 text-center">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSIvPjwvc3ZnPg==')] z-0"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-secondary-900 via-transparent to-transparent z-0"></div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-heading font-extrabold mb-6 leading-tight text-white tracking-tight">
            Gallery
        </h1>
        <p class="text-lg md:text-xl text-secondary-400 font-light max-w-2xl mx-auto">
            Visual stories of our journey, events, and achievements.
        </p>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-heading font-bold mb-4 text-secondary-900">Photo Gallery</h2>
            <p class="text-lg text-secondary-500 max-w-2xl mx-auto font-light">
                Explore our collection of memorable moments and project highlights.
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php if (!empty($gallery)): ?>
                <?php foreach ($gallery as $photo): ?>
                    <?php include 'includes/gallery-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 px-4 bg-secondary-50 rounded-3xl border border-secondary-100 border-dashed text-center">
                    <div class="text-secondary-400 mb-4 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-secondary-900 mb-2">No Gallery Photos Yet</h3>
                    <p class="text-secondary-500 font-light">Our gallery photos will be featured here soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-secondary-100 text-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-heading font-bold mb-6 text-secondary-900">Want to See More?</h2>
        <p class="text-lg text-secondary-600 mb-10 font-light">Follow us on social media for regular updates and behind-the-scenes content.</p>
        <a href="contact.php" class="inline-flex items-center justify-center px-10 py-4 text-white font-medium transition-all bg-secondary-900 rounded-xl hover:bg-secondary-800">
            Get in Touch
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
