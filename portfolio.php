<?php
// Panggil koneksi database
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

// Definisikan warna untuk setiap kategori
$category_colors = [
    'techno' => 'from-blue-600 to-cyan-600',
    'creative' => 'from-purple-600 to-pink-600', 
    'publisher' => 'from-emerald-600 to-teal-600',
    'general' => 'from-gray-600 to-slate-600'
];

$category_names = [
    'techno' => 'Technology Solutions',
    'creative' => 'Creative Projects',
    'publisher' => 'Publications',
    'general' => 'General Projects'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Abhinaya Indo Group</title>
    <meta name="description" content="Explore our portfolio of technology solutions, creative projects, and scientific publications across all Abhinaya Indo Group divisions.">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50">

<nav id="navbar" class="fixed top-0 left-0 w-full z-50 bg-gradient-to-r from-[#0e6d7c]/90 to-[#14aecf]/90 backdrop-blur-2xl border-b border-[#0e6d7c]/30 transition-all duration-500">
    <div class="w-full px-4 lg:px-6">
        <div class="flex items-center justify-between h-16">
            <a href="index.php" class="flex items-center space-x-2 group">
                <div class="relative w-12 h-12 transition-all duration-300 group-hover:scale-110">
                    <img src="images/logo.png" alt="Abhinaya Logo" class="object-contain w-full h-full">
                </div>
                <div class="hidden sm:block">
                    <div class="text-sm font-bold text-white">ABHINAYA</div>
                    <div class="text-xs text-white/80">INDO GROUP</div>
                </div>
            </a>

            <div class="hidden lg:flex items-center justify-center flex-1 space-x-6">
                <a href="index.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Home</a>
                <a href="#services" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Services</a>
                <a href="events.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Events</a>
                <a href="gallery.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Gallery</a>
                <a href="team.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Team</a>
                <a href="admin/index.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg border border-white/20">Login Admin</a>
            </div>

            <button id="mobileMenuBtn" class="lg:hidden text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative pt-24 pb-16 bg-gradient-to-br from-[#0e6d7c] to-[#14aecf] overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative container mx-auto px-6 text-center text-white">
        <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                Our Portfolio
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                Discover our diverse projects across technology, creative, and publishing divisions
            </p>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Featured Projects</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Explore our success stories and innovative solutions across all divisions
            </p>
        </div>
        
        <?php if (!empty($portfolios)): ?>
            <?php foreach ($portfolios as $category => $projects): ?>
                <div class="mb-20" data-aos="fade-up">
                    <div class="text-center mb-12">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900">
                            <?php echo htmlspecialchars($category_names[$category] ?? ucfirst($category)); ?>
                        </h3>
                        <div class="w-20 h-1 mx-auto bg-gradient-to-r <?php echo $category_colors[$category] ?? $category_colors['general']; ?> rounded-full"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($projects as $index => $project): ?>
                            <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                <div class="aspect-video bg-gray-200 overflow-hidden">
                                    <?php if (!empty($project['image'])): ?>
                                        <img src="admin/uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($project['title']); ?>" 
                                             class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br <?php echo $category_colors[$category] ?? $category_colors['general']; ?> flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium bg-gradient-to-r <?php echo $category_colors[$category] ?? $category_colors['general']; ?> text-white px-3 py-1 rounded-full">
                                            <?php echo htmlspecialchars($project['category']); ?>
                                        </span>
                                    </div>
                                    <h4 class="text-xl font-semibold mb-2 text-gray-900"><?php echo htmlspecialchars($project['title']); ?></h4>
                                    <p class="text-gray-600 mb-4"><?php echo htmlspecialchars(substr($project['description'], 0, 120)) . '...'; ?></p>
                                    <?php if (!empty($project['link'])): ?>
                                        <a href="<?php echo htmlspecialchars($project['link']); ?>" 
                                           target="_blank" 
                                           class="inline-flex items-center text-[#0e6d7c] hover:text-[#14aecf] font-medium transition-colors">
                                            View Project
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Portfolio Items Yet</h3>
                <p class="text-gray-500">Our portfolio projects will be featured here soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-[#0e6d7c] to-[#14aecf]">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">Ready to Start Your Project?</h2>
            <p class="text-xl text-white/90 mb-8">
                Let's discuss how we can help bring your vision to life
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="contact.php" class="px-8 py-4 bg-white text-[#0e6d7c] font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Get Started
                </a>
                <a href="index.php" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-[#0e6d7c] transition-all duration-300">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10">
                        <img src="images/logo.png" alt="Abhinaya Logo" class="object-contain w-full h-full">
                    </div>
                    <div>
                        <div class="text-sm font-bold">ABHINAYA</div>
                        <div class="text-xs text-gray-400">INDO GROUP</div>
                    </div>
                </div>
                <p class="text-gray-400 text-sm">
                    Transforming visions into reality through innovation and excellence.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="events.php" class="hover:text-white transition-colors">Events</a></li>
                    <li><a href="gallery.php" class="hover:text-white transition-colors">Gallery</a></li>
                    <li><a href="team.php" class="hover:text-white transition-colors">Team</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Divisions</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="abhinaya-techno.php" class="hover:text-white transition-colors">Techno</a></li>
                    <li><a href="abhinaya-creative.php" class="hover:text-white transition-colors">Creative</a></li>
                    <li><a href="abhinaya-publisher.php" class="hover:text-white transition-colors">Publisher</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>info@abhinaya.co.id</li>
                    <li>+62 812-3456-7890</li>
                    <li>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-white/60 text-sm mb-4 md:mb-0">
                    &copy; <?php echo date('Y'); ?> ABHINAYA INDO GROUP. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="assets/js/script.js"></script>

</body>
</html>
<?php 
// Tutup koneksi
if(isset($conn)) { $conn->close(); } 
?>
