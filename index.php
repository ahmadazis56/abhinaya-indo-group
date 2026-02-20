<?php
// Panggil konfigurasi database dari sistem admin Anda
require_once 'config/database.php';

// Ambil data logo berdasarkan kategori menggunakan fungsi yang sudah Anda buat di config
$clients = getLogos('client'); // Mengambil khusus logo klien
$events = getEvents(3); // Ambil 3 event terbaru
$partners = array_merge(getLogos('publisher'), getLogos('creative'), getLogos('techno'));


// Ambil data portfolio terbaru untuk homepage (limit 6)
$featuredPortfolio = getPortfolio(6);


// Data statis untuk Hero (karena fitur Hero belum ada di tabel admin, kita set statis sementara)
$heroSlides[] = [
    'title' => 'Abhinaya Indo Group',
    'subtitle' => 'Elevate your ideas with us',
    'description' => 'Empower your vision with Abhinaya Indo Group - your trusted partner for innovative digital solutions, creative excellence, and scientific publishing. We transform ideas into impactful reality.',
    'button_text' => 'Explore Our Services'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abhinaya Indo Group - IT Solutions, Creative & Scientific Publishing</title>
    <meta name="description" content="Abhinaya Indo Group offers IT solutions, creative branding, and scientific publishing. Techno, Creative, and Publisher divisions—trusted by companies and institutions worldwide.">
    
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

<?php $slide = $heroSlides[0] ?? null; ?>
<section class="relative w-full h-screen flex items-center justify-center overflow-hidden">
    <video autoplay muted loop playsinline class="video-bg">
        <source src="videos/video.mp4" type="video/mp4">
    </video>
    
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-800/60 to-slate-900/80 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-transparent to-slate-900/50 z-10"></div>
    
    <div class="relative z-20 text-center px-6 max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <div class="mb-6 inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-400/30 rounded-full backdrop-blur-sm">
            <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
            <span class="text-cyan-300 text-sm font-medium">Global Innovation Leader</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-cyan-100 to-blue-100 bg-clip-text text-transparent drop-shadow-2xl">
                <?php echo htmlspecialchars($slide['title']); ?>
            </span>
        </h1>
        
        <p class="text-2xl md:text-3xl lg:text-4xl mb-6 font-light text-cyan-100 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
            <?php echo htmlspecialchars($slide['subtitle']); ?>
        </p>
        
        <p class="text-lg md:text-xl mb-12 text-gray-300 max-w-4xl mx-auto leading-relaxed font-light" data-aos="fade-up" data-aos-delay="400">
            <?php echo htmlspecialchars($slide['description']); ?>
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="600">
            <a href="#services" class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                <?php echo htmlspecialchars($slide['button_text']); ?>
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 md:py-32 bg-gradient-to-br from-white via-cyan-50/30 to-blue-50/20">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Our Expertise</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">Services</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Comprehensive solutions tailored to transform your vision into reality
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Web Development -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-cyan-700 transition-colors">Web Development</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">Custom web applications built with modern technologies and secure code practices.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-cyan-400 rounded-full mr-2"></span>Secure Code</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-cyan-400 rounded-full mr-2"></span>Responsive Design</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-cyan-400 rounded-full mr-2"></span>Performance Optimization</li>
                </ul>
            </div>

            <!-- Mobile Apps -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-purple-700 transition-colors">Mobile Apps</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">Native and cross-platform mobile applications for iOS and Android.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>iOS & Android</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>User-Friendly UI</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>App Store Optimization</li>
                </ul>
            </div>

            <!-- AI Solutions -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-green-700 transition-colors">AI Solutions</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">Cutting-edge artificial intelligence and machine learning solutions.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>Machine Learning</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>Natural Language Processing</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>Predictive Analytics</li>
                </ul>
            </div>

            <!-- Branding Design -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-orange-700 transition-colors">Branding Design</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">Complete brand identity design and visual communication solutions.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-orange-400 rounded-full mr-2"></span>Logo Design</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-orange-400 rounded-full mr-2"></span>Brand Guidelines</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-orange-400 rounded-full mr-2"></span>Visual Identity</li>
                </ul>
            </div>

            <!-- Digital Marketing -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200" data-aos="fade-up" data-aos-delay="500">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-indigo-700 transition-colors">Digital Marketing</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">Strategic digital marketing campaigns to grow your online presence.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>Social Media Management</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>Content Marketing</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></span>SEO Optimization</li>
                </ul>
            </div>

            <!-- Scientific Publishing -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8 border border-gray-100 hover:border-cyan-200" data-aos="fade-up" data-aos-delay="600">
                <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-teal-700 transition-colors">Scientific Publishing</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">Professional scientific journal publishing and academic support services.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-center"><span class="w-2 h-2 bg-teal-400 rounded-full mr-2"></span>Journal Management</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-teal-400 rounded-full mr-2"></span>Peer Review Process</li>
                    <li class="flex items-center"><span class="w-2 h-2 bg-teal-400 rounded-full mr-2"></span>Indexing Services</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section class="py-20 md:py-32 bg-gradient-to-br from-cyan-600 to-blue-700 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full mb-6">
                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                <span class="text-white text-sm font-medium">Our Impact</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 text-white">Achievements</h2>
            <p class="text-xl md:text-2xl text-white/80 max-w-3xl mx-auto leading-relaxed font-light">
                Numbers that speak volumes about our commitment to excellence
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="text-5xl md:text-6xl font-bold text-white mb-4 counter" data-target="470">0</div>
                <div class="text-white/80 font-medium">Projects Completed</div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="text-5xl md:text-6xl font-bold text-white mb-4 counter" data-target="47">0</div>
                <div class="text-white/80 font-medium">Expert Team</div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="text-5xl md:text-6xl font-bold text-white mb-4 counter" data-target="13">0</div>
                <div class="text-white/80 font-medium">Years Excellence</div>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="text-5xl md:text-6xl font-bold text-white mb-4 counter" data-target="98">0</div>
                <div class="text-white/80 font-medium">Client Satisfaction</div>
            </div>
        </div>

    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-24 md:py-32 bg-white relative overflow-hidden">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Our Portfolio</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">Featured Projects</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Explore our latest projects and success stories across all divisions
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($featuredPortfolio)): ?>
                <?php foreach ($featuredPortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Belum ada portfolio yang diupload.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-16 text-center" data-aos="fade-up">
            <a href="portfolio.php" class="inline-flex items-center px-8 py-4 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition-all duration-300 transform hover:scale-105">
                View All Projects
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-20 md:py-32 bg-gradient-to-br from-gray-50 via-white to-cyan-50/30">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Latest Updates</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold mb-6 gradient-text">News & Insights</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                Stay updated with our latest news and industry insights
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <?php include 'includes/event-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">Belum ada event terbaru.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<section id="clients" class="relative py-24 md:py-32 bg-gradient-to-br from-slate-50 via-white to-cyan-50/30 overflow-hidden">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-5xl text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/10 to-blue-500/10 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Trusted Partners</span>
            </div>
            <h2 class="pb-6 font-nacelle text-4xl md:text-6xl font-bold leading-tight gradient-text">
                Our Clients
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed font-light">
                We are trusted by the world's most innovative companies
            </p>
        </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $index => $logo): ?>
                        <?php include 'includes/logo-card.php'; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-8 text-gray-500">
                        <p>Belum ada data klien. Silakan tambahkan klien melalui Admin Panel.</p>
                    </div>
                <?php endif; ?>
            </div>
    </div>
</section>

<section id="partners" class="w-full bg-gradient-to-br from-gray-50 via-white to-cyan-50/20 py-20 md:py-32 relative overflow-hidden">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-4xl pb-16 text-center" data-aos="fade-up">
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-400/30 rounded-full backdrop-blur-sm mb-6">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Strategic Partnerships</span>
            </div>
            <h2 class="pb-4 font-nacelle text-4xl md:text-5xl font-bold leading-tight gradient-text">
                Our Partners
            </h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed font-light">
                Collaborating with leading institutions and organizations worldwide.
            </p>
        </div>
        
        <?php if(!empty($partners)): ?>
        <div class="relative">
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white via-white/80 to-transparent z-20"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white via-white/80 to-transparent z-20"></div>
            
            <div class="overflow-hidden bg-white/40 backdrop-blur-sm rounded-2xl border border-white/20 shadow-xl">
                <div class="flex animate-scroll-left py-12">
                    
                    <?php for($i=0; $i<2; $i++): ?>
                        <?php foreach ($partners as $logo): ?>
                        <div class="flex items-center justify-center px-12 flex-shrink-0">
                            <?php include 'includes/logo-card.php'; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="text-center text-gray-500 py-8">
                <p>Belum ada data partner. Silakan tambahkan Publisher, Creative, atau Techno di menu Logos pada Admin Panel.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<footer class="bg-slate-900 text-white border-t border-slate-800">
    <div class="w-full px-6 sm:px-8 lg:px-12 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Company Info -->
            <div class="space-y-6">
                <a href="index.php" class="flex items-center space-x-3">
                    <img src="images/logo.png" alt="Abhinaya Logo" class="w-12 h-12 object-contain">
                    <div>
                        <div class="text-lg font-bold tracking-tight">ABHINAYA</div>
                        <div class="text-xs text-slate-400 font-medium">INDO GROUP</div>
                    </div>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Transforming Ideas into Digital Excellence. Leading provider of innovative IT solutions, creative branding, and scientific publishing services across Indonesia and globally.
                </p>
                <div class="flex items-center space-x-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-cyan-600 transition-colors duration-300">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-cyan-600 transition-colors duration-300">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-cyan-600 transition-colors duration-300">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-bold mb-6">About</h4>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="about.php" class="hover:text-cyan-500 transition-colors">Company Profile</a></li>
                    <li><a href="team.php" class="hover:text-cyan-500 transition-colors">Our Team</a></li>
                    <li><a href="contact.php" class="hover:text-cyan-500 transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-white font-bold mb-6">Services</h4>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="abhinaya-techno.php" class="hover:text-cyan-500 transition-colors">Web Development</a></li>
                    <li><a href="abhinaya-techno.php" class="hover:text-cyan-500 transition-colors">Mobile Apps</a></li>
                    <li><a href="abhinaya-creative.php" class="hover:text-cyan-500 transition-colors">Branding</a></li>
                    <li><a href="abhinaya-publisher.php" class="hover:text-cyan-500 transition-colors">Publishing</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="text-white font-bold mb-6">Resources</h4>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="portfolio.php" class="hover:text-cyan-500 transition-colors">Portfolio</a></li>
                    <li><a href="events.php" class="hover:text-cyan-500 transition-colors">Latest News</a></li>
                    <li><a href="gallery.php" class="hover:text-cyan-500 transition-colors">Gallery</a></li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-slate-500 text-sm">
                &copy; 2026 ABHINAYA INDO GROUP. All rights reserved.
            </p>
            <div class="flex items-center space-x-6 text-sm text-slate-500">
                <a href="privacy.php" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="terms.php" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="privacy.php" class="hover:text-white transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>


<script src="assets/js/script.js"></script>

</body>
</html>
<?php 
// Tutup koneksi (Koneksi dipanggil dari config/database.php)
if(isset($conn)) { $conn->close(); } 
?>