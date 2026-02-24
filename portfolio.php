<?php
require_once 'config/database.php';

// Ambil data portfolio dari database
$portfolio_query = "SELECT * FROM portfolio ORDER BY category, id DESC";
$portfolio_result = $conn->query($portfolio_query);
$portfolios = [];
if ($portfolio_result) {
    while ($row = $portfolio_result->fetch_assoc()) {
        $category = $row['category'] ?? 'general';
        if (!isset($portfolios[$category])) {
            $portfolios[$category] = [];
        }
        $portfolios[$category][] = $row;
    }
}

$pageTitle = "Portfolio - Abhinaya Indo Group";
$pageDesc = "Explore our portfolio of technology solutions, creative projects, and scientific publications across all Abhinaya Indo Group divisions.";
include 'includes/header.php';
?>

<!-- Hero Section - Hostinger Dark Style -->
<section class="relative w-full py-24 md:py-32 bg-slate-900 overflow-hidden text-center">
    <div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
        <div class="absolute top-0 left-0 -ml-32 -mt-32 w-96 h-96 rounded-full bg-primary-600 blur-3xl mix-blend-screen opacity-30"></div>
    </div>

    <div class="relative z-10 w-full max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <div class="inline-flex items-center px-4 py-2 bg-slate-800/50 rounded-full border border-slate-700 backdrop-blur-md mb-8">
            <span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>
            <span class="text-sm font-bold text-slate-300 uppercase tracking-widest">Our Work</span>
        </div>
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-[1.1] tracking-tight text-white">
            Proven <span class="text-primary-400">Capability.</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-400 font-medium max-w-2xl mx-auto">
            Discover our diverse, high-impact projects across technology, creative branding, and scientific publishing.
        </p>
    </div>
</section>

<!-- Portfolio Section -->
<section class="py-24 bg-gray-50 relative border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black mb-4 text-slate-900">Featured Projects</h2>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto font-medium">
                Explore our success stories and the innovative solutions we've built for our partners.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">
            <?php if (!empty($portfolios)): ?>
                <?php foreach ($portfolios as $category_slug => $projects): ?>
                    <?php foreach ($projects as $project): ?>
                        <?php include 'includes/portfolio-card.php'; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 px-4 bg-white rounded-[2rem] border border-gray-100 shadow-sm text-center">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">No Projects Yet</h3>
                    <p class="text-slate-500 font-medium">Our portfolio projects will be featured here soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-white text-center border-b border-gray-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-heading font-black mb-6 text-slate-900">Ready to start your project?</h2>
        <p class="text-lg text-slate-500 mb-10 font-medium">Let's discuss how we can help bring your digital vision to life.</p>
        <a href="contact.php" class="inline-flex items-center justify-center px-10 py-4 text-[16px] font-bold tracking-wide text-white transition-all bg-primary-500 rounded-2xl hover:bg-primary-600 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-primary-200">
            Contact Us Today
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
