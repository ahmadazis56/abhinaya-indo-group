<?php
require_once 'config/database.php';

// Get portfolio items for publisher division
$publisherPortfolio = getPortfolioByCategory('publisher');

// Get team members for publisher division
$publisherTeam = getTeamByDivision('publisher');

function getPortfolioByCategory($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM portfolio WHERE category = ? AND status = 'active' ORDER BY sort_order ASC, created_at DESC");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $portfolio = [];
    while ($row = $result->fetch_assoc()) {
        $portfolio[] = $row;
    }
    $stmt->close();
    return $portfolio;
}

function getTeamByDivision($division) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM team WHERE division = ? AND status = 'active' ORDER BY sort_order ASC, created_at ASC");
    $stmt->bind_param("s", $division);
    $stmt->execute();
    $result = $stmt->get_result();
    $team = [];
    while ($row = $result->fetch_assoc()) {
        $team[] = $row;
    }
    $stmt->close();
    return $team;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abhinaya Publisher - Academic & Scientific Publishing</title>
    <meta name="description" content="Abhinaya Publisher offers professional academic publishing, journal management, and editorial services. Partner with us for quality scientific publications.">
    
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
                
                <!-- Divisions Dropdown -->
                <div class="relative group">
                    <button class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg flex items-center">
                        Divisions
                        <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100">
                        <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
                            <a href="abhinaya-techno.php" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50 hover:text-cyan-700 transition-all duration-200 text-sm font-medium">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                    Abhinaya Techno
                                </div>
                            </a>
                            <a href="abhinaya-creative.php" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 hover:text-purple-700 transition-all duration-200 text-sm font-medium">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                    Abhinaya Creative
                                </div>
                            </a>
                            <a href="abhinaya-publisher.php" class="block px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 transition-all duration-200 text-sm font-medium">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    Abhinaya Publisher
                                </div>
                            </a>
                            <div class="border-t border-gray-100">
                                <a href="divisions.php" class="block px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-all duration-200 text-sm font-medium">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                        </svg>
                                        View All Divisions
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
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

<!-- Mobile Menu -->
<div id="mobileMenu" class="fixed inset-0 bg-black/95 z-40 lg:hidden hidden">
    <div class="flex flex-col h-full p-6">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10">
                    <img src="images/logo.png" alt="Abhinaya Logo" class="object-contain w-full h-full">
                </div>
                <div>
                    <div class="text-sm font-bold text-white">ABHINAYA</div>
                    <div class="text-xs text-white/80">INDO GROUP</div>
                </div>
            </div>
            <button id="closeMobileMenu" class="text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <nav class="flex-1 overflow-y-auto">
            <div class="space-y-2">
                <a href="index.php" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                    Home
                </a>
                <a href="#services" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                    Services
                </a>
                
                <!-- Mobile Divisions Accordion -->
                <div class="mobile-accordion">
                    <button class="mobile-accordion-btn w-full px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 flex items-center justify-between">
                        <span>Divisions</span>
                        <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mobile-accordion-content hidden pl-4 space-y-2 mt-2">
                        <a href="abhinaya-techno.php" class="block px-4 py-2 text-white/70 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-300 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                </svg>
                                Abhinaya Techno
                            </div>
                        </a>
                        <a href="abhinaya-creative.php" class="block px-4 py-2 text-white/70 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-300 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                </svg>
                                Abhinaya Creative
                            </div>
                        </a>
                        <a href="abhinaya-publisher.php" class="block px-4 py-2 text-white/70 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-300 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Abhinaya Publisher
                            </div>
                        </a>
                        <a href="divisions.php" class="block px-4 py-2 text-white/50 hover:text-white hover:bg-white/5 rounded-lg transition-all duration-300 text-sm border-t border-white/10 mt-2 pt-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                View All Divisions
                            </div>
                        </a>
                    </div>
                </div>
                
                <a href="events.php" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                    Events
                </a>
                <a href="gallery.php" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                    Gallery
                </a>
                <a href="team.php" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300">
                    Team
                </a>
                <a href="admin/index.php" class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 border border-white/20">
                    Login Admin
                </a>
            </div>
        </nav>
    </div>
</div>

<!-- Hero Section -->
<section class="relative pt-24 pb-16 bg-gradient-to-br from-emerald-600 to-teal-600 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative container mx-auto px-6 text-center text-white">
        <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                Abhinaya Publisher
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                Excellence in Academic & Scientific Publishing
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#portfolio" class="px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    View Publications
                </a>
                <a href="#team" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-emerald-600 transition-all duration-300">
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
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Publishing Services</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Comprehensive publishing solutions for academic and scientific excellence
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($packages as $index => $package): ?>
                <div class="text-center p-6 rounded-xl bg-gray-50 hover:bg-gradient-to-br hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 hover:shadow-lg" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-full flex items-center justify-center">
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
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Our Publications</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover our academic journals and scientific publications
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($publisherPortfolio)): ?>
                <?php foreach ($publisherPortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Publications Yet</h3>
                    <p class="text-gray-500">Our academic publications will be featured here soon.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- Team Section -->
<section id="team" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Publishing Team</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Meet the experts behind our academic publishing excellence
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <?php if (!empty($publisherTeam)): ?>
                <?php foreach ($publisherTeam as $member): ?>
                    <?php include 'includes/team-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Our publishing team will be featured here soon.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-emerald-600 to-teal-600">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">Ready to Publish Your Research?</h2>
            <p class="text-xl text-white/90 mb-8">
                Partner with us for professional academic publishing services
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="admin/index.php" class="px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Get Started
                </a>
                <a href="index.php" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-emerald-600 transition-all duration-300">
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
                    Excellence in academic and scientific publishing.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#services" class="hover:text-white transition-colors">Services</a></li>
                    <li><a href="#portfolio" class="hover:text-white transition-colors">Publications</a></li>
                    <li><a href="#team" class="hover:text-white transition-colors">Team</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>Academic Publishing</li>
                    <li>Journal Management</li>
                    <li>Editorial Services</li>
                    <li>Distribution</li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>publisher@abhinaya.co.id</li>
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
