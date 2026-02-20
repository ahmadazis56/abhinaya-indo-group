<?php
require_once 'config/database.php';

// Get portfolio items for techno division
$technoPortfolio = getPortfolioByCategory('techno');

// Get team members for techno division
$technoTeam = getTeamByDivision('techno');

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
    <title>Abhinaya Techno - Digital Solutions That Build Your Future</title>
    <meta name="description" content="Abhinaya Techno offers comprehensive digital solutions including web development, mobile apps, AI solutions, and IT consulting. Transform your business with cutting-edge technology.">
    
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
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-800/60 to-slate-900/80 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-transparent to-slate-900/50 z-10"></div>
    
    <div class="relative z-20 text-center px-6 max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <div class="mb-6 inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-400/30 rounded-full backdrop-blur-sm">
            <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
            <span class="text-cyan-300 text-sm font-medium">Digital Innovation</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-cyan-100 to-blue-100 bg-clip-text text-transparent drop-shadow-2xl">
                Abhinaya Techno
            </span>
        </h1>
        
        <p class="text-2xl md:text-3xl lg:text-4xl mb-6 font-light text-cyan-100 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
            Digital Solutions That Build Your Future
        </p>
        
        <p class="text-lg md:text-xl mb-12 text-gray-300 max-w-4xl mx-auto leading-relaxed font-light" data-aos="fade-up" data-aos-delay="400">
            Transform your business with cutting-edge technology solutions. From web development to AI integration, we build digital experiences that drive growth and innovation.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="600">
            <a href="#packages" class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                Explore Packages
            </a>
            <a href="#portfolio" class="group relative inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 transform hover:scale-105 border border-white/20">
                View Portfolio
            </a>
        </div>
    </div>
</section>

<!-- Packages Section -->
<section id="packages" class="py-20 md:py-32 bg-gradient-to-br from-white via-cyan-50/30 to-blue-50/20">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Pricing Plans</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">Digital Packages</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Choose the perfect package for your digital transformation journey
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Basic Digital Package -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200 relative" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-2 text-gray-800">Basic Digital</h3>
                    <div class="text-4xl font-bold text-cyan-600 mb-2">3.5jt</div>
                    <p class="text-gray-600">Perfect for small businesses</p>
                </div>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Company Profile Website</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Basic SEO Setup</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Mobile Responsive Design</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">1 Year Hosting</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Basic Analytics Setup</span>
                    </li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300">
                    Get Started
                </button>
            </div>

            <!-- Professional Digital Package -->
            <div class="group bg-gradient-to-br from-cyan-50 to-blue-50 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border-2 border-cyan-300 relative" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-4 py-1 rounded-full text-sm font-medium">
                        Most Popular
                    </div>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-2 text-gray-800">Professional Digital</h3>
                    <div class="text-4xl font-bold text-cyan-600 mb-2">5jt</div>
                    <p class="text-gray-600">Ideal for growing businesses</p>
                </div>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Advanced Web Application</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">E-commerce Integration</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Advanced SEO & Marketing</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">API Integration</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">2 Years Hosting & Support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Performance Optimization</span>
                    </li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300">
                    Get Started
                </button>
            </div>

            <!-- Enterprise Solution Package -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200 relative" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-2 text-gray-800">Enterprise Solution</h3>
                    <div class="text-4xl font-bold text-cyan-600 mb-2">Custom</div>
                    <p class="text-gray-600">Tailored for large organizations</p>
                </div>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Custom Enterprise Software</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">AI & Machine Learning Integration</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Cloud Infrastructure Setup</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Advanced Security Solutions</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Dedicated Support Team</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Custom Training & Documentation</span>
                    </li>
                </ul>
                <button class="w-full py-3 bg-gradient-to-r from-gray-700 to-gray-900 text-white font-semibold rounded-xl hover:from-gray-800 hover:to-black transition-all duration-300">
                    Contact Sales
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-20 md:py-32 bg-gradient-to-br from-gray-50 via-white to-cyan-50/30">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Our Work</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">Techno Portfolio</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Explore our latest digital innovations and success stories
            </p>
        </div>

        <?php if (!empty($technoPortfolio)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($technoPortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Portfolio Items Yet</h3>
                <p class="text-gray-500">Our techno portfolio items will be displayed here soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 md:py-32 bg-gradient-to-br from-cyan-600 to-blue-700 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                <span class="text-white text-sm font-medium">Techno Team</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 text-white">Meet Our Experts</h2>
            <p class="text-xl md:text-2xl text-white/80 max-w-3xl mx-auto leading-relaxed font-light">
                Meet the brilliant minds behind our innovative technology solutions
            </p>
        </div>

        <?php if (!empty($technoTeam)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <?php foreach ($technoTeam as $member): ?>
                    <?php include 'includes/team-card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-full mb-4">
                    <svg class="w-10 h-10 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Team Coming Soon</h3>
                <p class="text-white/70">Our techno team members will be featured here.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-cyan-600 to-blue-700">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Transform Your Digital Presence?</h2>
            <p class="text-xl text-white/80 mb-8 leading-relaxed">Let's discuss how our techno solutions can accelerate your business growth</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:info@abhinaya.com" class="inline-flex items-center px-8 py-4 bg-white text-cyan-700 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Contact Us
                </a>
                <a href="tel:+6281234567890" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 transform hover:scale-105 border border-white/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Now
                </a>
            </div>
        </div>
    </div>
</section>

<footer class="bg-gradient-to-r from-[#0e6d7c] to-[#14aecf] border-t border-[#0e6d7c]">
    <div class="bg-[#0a4f5a]">
        <div class="w-full px-6 sm:px-8 lg:px-12 py-6">
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
