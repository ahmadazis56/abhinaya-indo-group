<?php
require_once 'config/database.php';

// Get portfolio items for creative division
$creativePortfolio = getPortfolioByCategory('creative');

// Get team members for creative division
$creativeTeam = getTeamByDivision('creative');

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
    <title>Abhinaya Creative - Elevate your brand with our expert services</title>
    <meta name="description" content="Abhinaya Creative offers comprehensive branding, digital marketing, and content creation services. Elevate your brand with our expert creative solutions.">
    
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
<section class="relative w-full h-screen flex items-center justify-center overflow-hidden">
    <video autoplay muted loop playsinline class="video-bg">
        <source src="videos/video.mp4" type="video/mp4">
    </video>
    
    <div class="absolute inset-0 bg-gradient-to-r from-purple-900/80 via-pink-800/60 to-purple-900/80 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-purple-900/90 via-transparent to-purple-900/50 z-10"></div>
    
    <div class="relative z-20 text-center px-6 max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <div class="mb-6 inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500/20 to-pink-500/20 border border-purple-400/30 rounded-full backdrop-blur-sm">
            <span class="w-2 h-2 bg-purple-400 rounded-full mr-2 animate-pulse"></span>
            <span class="text-purple-300 text-sm font-medium">Creative Excellence</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-purple-100 to-pink-100 bg-clip-text text-transparent drop-shadow-2xl">
                Abhinaya Creative
            </span>
        </h1>
        
        <p class="text-2xl md:text-3xl lg:text-4xl mb-6 font-light text-purple-100 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
            Elevate your brand with our expert services
        </p>
        
        <p class="text-lg md:text-xl mb-12 text-gray-300 max-w-4xl mx-auto leading-relaxed font-light" data-aos="fade-up" data-aos-delay="400">
            Transform your brand identity with our comprehensive creative solutions. From branding design to digital marketing, we create experiences that captivate and convert.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="600">
            <a href="#services" class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                Explore Services
            </a>
            <a href="#portfolio" class="group relative inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 transform hover:scale-105 border border-white/20">
                View Portfolio
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 md:py-32 bg-gradient-to-br from-white via-purple-50/30 to-pink-50/20">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-purple-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-purple-700 text-sm font-medium">Our Expertise</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">Creative Services</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Comprehensive creative solutions to elevate your brand presence
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Branding & Identity -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-purple-200" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-purple-700 transition-colors">Branding & Identity</h3>
                <p class="text-gray-600 leading-relaxed mb-6">Complete brand identity design and visual communication solutions that make your brand memorable.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>Logo Design</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>Brand Guidelines</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>Visual Identity</li>
                </ul>
            </div>

            <!-- Digital Marketing -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-purple-200" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-indigo-700 transition-colors">Digital Marketing</h3>
                <p class="text-gray-600 leading-relaxed mb-6">Strategic digital marketing campaigns to grow your online presence and engage your audience.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>Social Media Management</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>Content Marketing</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>SEO Optimization</li>
                </ul>
            </div>

            <!-- Content Creation -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-purple-200" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-pink-700 transition-colors">Content Creation</h3>
                <p class="text-gray-600 leading-relaxed mb-6">Engaging content creation that tells your story effectively and resonates with your audience.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-pink-400 rounded-full mr-2"></span>Video Production</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-pink-400 rounded-full mr-2"></span>Photography</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-pink-400 rounded-full mr-2"></span>Copywriting</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Packages Section -->
<section id="packages" class="py-20 md:py-32 bg-gradient-to-br from-gray-50 via-white to-purple-50/30">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-purple-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-purple-700 text-sm font-medium">Social Media Packages</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">Marketing Solutions</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Choose the perfect package for your social media marketing needs
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- BASIC PRESENCE Package -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-purple-200 relative" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-2 text-gray-800">BASIC PRESENCE</h3>
                    <div class="text-4xl font-bold text-purple-600 mb-2">1.8jt</div>
                    <p class="text-gray-600">Essential social media setup</p>
                </div>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">3 Social Media Platforms</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">12 Posts Monthly</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Basic Analytics Report</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Community Management</span>
                    </li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-700 transition-all duration-300">
                    Get Started
                </button>
            </div>

            <!-- GROWTH CONTENT Package -->
            <div class="group bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border-2 border-purple-300 relative" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white px-4 py-1 rounded-full text-sm font-medium">
                        Most Popular
                    </div>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-2 text-gray-800">GROWTH CONTENT</h3>
                    <div class="text-4xl font-bold text-purple-600 mb-2">2.5jt</div>
                    <p class="text-gray-600">Comprehensive content strategy</p>
                </div>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">5 Social Media Platforms</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">20 Posts Monthly</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Content Strategy</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Monthly Analytics</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Influencer Collaboration</span>
                    </li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-700 transition-all duration-300">
                    Get Started
                </button>
            </div>

            <!-- BRANDING & CONVERSION Package -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-purple-200 relative" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-2 text-gray-800">BRANDING & CONVERSION</h3>
                    <div class="text-4xl font-bold text-purple-600 mb-2">3jt</div>
                    <p class="text-gray-600">Premium brand experience</p>
                </div>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">All Social Media Platforms</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">30+ Posts Monthly</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Video Content Production</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Conversion Optimization</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Dedicated Account Manager</span>
                    </li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-700 transition-all duration-300">
                    Get Started
                </button>
            </div>
        </div>

        <!-- Additional Packages -->
        <div class="mx-auto max-w-4xl" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-center mb-8 text-gray-800">Additional Packages</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-purple-200">
                    <h4 class="text-lg font-bold mb-2 text-purple-700">Paid Ads</h4>
                    <p class="text-gray-600 text-sm">Strategic paid advertising campaigns across platforms</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-purple-200">
                    <h4 class="text-lg font-bold mb-2 text-purple-700">Script Video</h4>
                    <p class="text-gray-600 text-sm">Professional video script writing and production</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-purple-200">
                    <h4 class="text-lg font-bold mb-2 text-purple-700">Campaign Proposal</h4>
                    <p class="text-gray-600 text-sm">Comprehensive marketing campaign strategy</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Creative Portfolio</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Explore our latest creative projects and design masterpieces
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <?php if (!empty($creativeTeam)): ?>
                <?php foreach ($creativeTeam as $member): ?>
                    <?php include 'includes/team-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Our creative team will be featured here soon.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- Team Section -->
<section id="team" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Creative Team</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Meet the creative minds behind our innovative designs
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
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Creative Team Coming Soon</h3>
                <p class="text-gray-500">Our creative team information will be available soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-purple-600 to-pink-600">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">Ready to Create Something Amazing?</h2>
            <p class="text-xl text-white/90 mb-8">
                Let's bring your creative vision to life with our innovative solutions
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="admin/index.php" class="px-8 py-4 bg-white text-purple-600 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    Get Started
                </a>
                <a href="index.php" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-purple-600 transition-all duration-300">
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
                    Transforming visions into reality through creative innovation.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#services" class="hover:text-white transition-colors">Services</a></li>
                    <li><a href="#portfolio" class="hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="#team" class="hover:text-white transition-colors">Team</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>Brand Design</li>
                    <li>Digital Marketing</li>
                    <li>Content Creation</li>
                    <li>Visual Identity</li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>creative@abhinaya.co.id</li>
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
