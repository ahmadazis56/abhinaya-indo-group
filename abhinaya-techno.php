<?php
// Panggil koneksi database
require_once 'config/database.php';

// Ambil data portfolio khusus kategori 'techno'
$portfolio_query = "SELECT * FROM portfolio WHERE category = 'techno' ORDER BY id DESC";
$portfolio_result = $conn->query($portfolio_query);
$portfolios = [];
if ($portfolio_result) {
    while ($row = $portfolio_result->fetch_assoc()) {
        $portfolios[] = $row;
    }
}

// Ambil data tim khusus divisi 'techno'
$team_query = "SELECT * FROM team WHERE division = 'techno' ORDER BY id ASC";
$team_result = $conn->query($team_query);
$teams = [];
if ($team_result) {
    while ($row = $team_result->fetch_assoc()) {
        $teams[] = $row;
    }
}

// Packages statis
$packages = [
    [
        'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'title' => 'Lightning Fast',
        'description' => 'Blazing fast performance with cutting-edge technology'
    ],
    [
        'icon' => 'M12 15l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z',
        'title' => 'Secure & Reliable',
        'description' => 'Enterprise-grade security with 99.9% uptime guarantee'
    ],
    [
        'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
        'title' => 'Smart Solutions',
        'description' => 'AI-powered solutions for modern business challenges'
    ],
    [
        'icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4',
        'title' => 'Scalable Architecture',
        'description' => 'Built to grow with your business needs'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abhinaya Techno - IT Solutions & Innovation</title>
    <meta name="description" content="Abhinaya Techno offers cutting-edge IT solutions, software development, and technology consulting services. Transform your business with our innovative technology solutions.">
    
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
            <a href="/" class="flex items-center space-x-2 group">
                <div class="relative w-12 h-12 transition-all duration-300 group-hover:scale-110">
                    <img src="images/logo.png" alt="Abhinaya Logo" class="object-contain w-full h-full">
                </div>
                <div class="hidden sm:block">
                    <div class="text-sm font-bold text-white">ABHINAYA</div>
                    <div class="text-xs text-white/80">INDO GROUP</div>
                </div>
            </a>

            <div class="hidden lg:flex items-center justify-center flex-1 space-x-6">
                <a href="/" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Home</a>
                <a href="#services" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Services</a>
                <a href="/events" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Events</a>
                <a href="/gallery" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Gallery</a>
                <a href="/team-management" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Team</a>
                <a href="/admin/index.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg border border-white/20">Login Admin</a>
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
                Abhinaya Techno
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                Transforming Ideas into Digital Reality
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#portfolio" class="px-8 py-4 bg-white text-[#0e6d7c] font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    View Portfolio
                </a>
                <a href="#team" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-[#0e6d7c] transition-all duration-300">
                    Meet Our Team
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Our Services</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Comprehensive technology solutions to accelerate your digital transformation
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($packages as $index => $package): ?>
                <div class="text-center p-6 rounded-xl bg-gray-50 hover:bg-gradient-to-br hover:from-[#0e6d7c]/5 hover:to-[#14aecf]/5 transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-[#0e6d7c] to-[#14aecf] rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $package['icon']; ?>"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-900"><?php echo htmlspecialchars($package['title']); ?></h3>
                    <p class="text-gray-600"><?php echo htmlspecialchars($package['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Our Portfolio</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover our latest technology projects and success stories
            </p>
        </div>
        
        <?php if (!empty($portfolios)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($portfolios as $project): ?>
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up">
                        <div class="aspect-video bg-gray-200 overflow-hidden">
                            <img src="admin/uploads/portfolio/<?php echo htmlspecialchars($project['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($project['title']); ?>" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-[#0e6d7c] bg-[#0e6d7c]/10 px-3 py-1 rounded-full">
                                    <?php echo htmlspecialchars($project['category']); ?>
                                </span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-900"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars(substr($project['description'], 0, 100)) . '...'; ?></p>
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
        <?php else: ?>
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Portfolio Yet</h3>
                <p class="text-gray-500">Our technology portfolio will be featured here soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Team Section -->
<section id="team" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Our Technology Team</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Meet the brilliant minds behind our innovative solutions
            </p>
        </div>
        
        <?php if (!empty($teams)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($teams as $member): ?>
                    <div class="text-center group" data-aos="fade-up">
                        <div class="relative mb-4 mx-auto w-32 h-32 rounded-full overflow-hidden bg-gray-200">
                            <img src="admin/uploads/team/<?php echo htmlspecialchars($member['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($member['name']); ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-1"><?php echo htmlspecialchars($member['name']); ?></h3>
                        <p class="text-gray-600"><?php echo htmlspecialchars($member['role']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Team Coming Soon</h3>
                <p class="text-gray-500">Our technology team information will be available soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-[#0e6d7c] to-[#14aecf]">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">Ready to Transform Your Business?</h2>
            <p class="text-xl text-white/90 mb-8">
                Let's discuss how our technology solutions can help you achieve your goals
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/admin/index.php" class="px-8 py-4 bg-white text-[#0e6d7c] font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Get Started
                </a>
                <a href="/" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-[#0e6d7c] transition-all duration-300">
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
                    Transforming visions into reality through innovative technology solutions.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#services" class="hover:text-white transition-colors">Services</a></li>
                    <li><a href="#portfolio" class="hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="#team" class="hover:text-white transition-colors">Team</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>Web Development</li>
                    <li>Mobile Apps</li>
                    <li>Software Solutions</li>
                    <li>IT Consulting</li>
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
