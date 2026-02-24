<?php
$pageTitle = $pageTitle ?? "Abhinaya Indo Group - Digital Excellence";
$pageDesc = $pageDesc ?? "Abhinaya Indo Group offers intuitive IT solutions, creative branding, and rigorous scientific publishing services for global businesses.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDesc); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/image/logo.png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#e1faff',
                            100: '#ccf5ff',
                            200: '#99edff',
                            300: '#66e5ff',
                            400: '#33ddff',
                            500: '#14aecf', /* Hostinger Primary Accent */
                            600: '#118da8',
                            700: '#0e6d82',
                            800: '#0b4d5c',
                            900: '#072d36',
                            950: '#04161b',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'glow': '0 0 20px rgba(20, 174, 207, 0.15)',
                        'hostinger': '0 10px 40px rgba(0, 0, 0, 0.04)',
                        'hostinger-hover': '0 20px 60px rgba(0, 0, 0, 0.08)',
                    }
                }
            }
        }
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom Style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Base clean styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff; /* Hostinger pure white base */
            color: #0f172a; /* Hostinger high contrast black */
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.03em;
            color: #0f172a;
        }
        .gradient-text {
            background: linear-gradient(135deg, #14aecf 0%, #0e6d82 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-white selection:bg-primary-500 selection:text-white overflow-x-hidden">

<!-- Navbar - Transparent to White -->
<nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-3 group">
                <div class="relative w-10 h-10 transition-transform duration-300 group-hover:scale-105">
                    <img src="assets/image/logo.png" alt="Abhinaya Logo" class="object-contain w-full h-full drop-shadow-sm filter brightness-0 invert transition-all duration-300" id="nav-logo-img">
                </div>
                <div class="hidden sm:flex flex-col">
                    <span class="text-xl font-heading font-extrabold tracking-tight leading-none transition-colors duration-300 text-white group-hover:text-white/80" id="nav-logo-text">ABHINAYA</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center justify-center flex-1 space-x-2 pl-12 pr-4">
                <a href="index.php" class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg">Home</a>
                <a href="index.php#services" class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg">Services</a>
                
                <!-- Divisions Dropdown -->
                <div class="relative group">
                    <button class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg flex items-center">
                        Divisions
                        <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Panel -->
                    <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-[280px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top scale-95 group-hover:scale-100 z-50">
                        <div class="bg-white rounded-2xl shadow-hostinger border border-gray-100 overflow-hidden py-3">
                            <a href="abhinaya-techno.php" class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors group/item">
                                <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-500 group-hover/item:bg-primary-500 group-hover/item:text-white transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 group-hover/item:text-primary-500 transition-colors">Techno</div>
                                    <div class="text-xs text-slate-500 mt-0.5">Software & IT Solutions</div>
                                </div>
                            </a>
                            <a href="abhinaya-creative.php" class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors group/item">
                                <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-500 group-hover/item:bg-primary-500 group-hover/item:text-white transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 group-hover/item:text-primary-500 transition-colors">Creative</div>
                                    <div class="text-xs text-slate-500 mt-0.5">Branding & Design</div>
                                </div>
                            </a>
                            <a href="abhinaya-publisher.php" class="flex items-start px-5 py-3 hover:bg-slate-50 transition-colors group/item">
                                <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-500 group-hover/item:bg-primary-500 group-hover/item:text-white transition-colors shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-slate-900 group-hover/item:text-primary-500 transition-colors">Publisher</div>
                                    <div class="text-xs text-slate-500 mt-0.5">Scientific Publishing</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="portfolio.php" class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg">Portfolio</a>
                <a href="events.php" class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg">Events</a>
                <a href="https://news.abhinaya.co.id/" target="_blank" rel="noopener" class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg">News</a>
                <a href="about.php" class="nav-link text-white hover:text-white/80 px-3 py-2 text-[15px] font-semibold transition-colors duration-300 rounded-lg">Company</a>
            </div>

            <!-- CTA / Contact - Hostinger Style Outline Button -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="admin/index.php" class="text-sm font-bold text-white hover:text-white/80 transition-colors flex items-center" id="nav-login-btn">
                    <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Log in
                </a>
                <a href="contact.php" class="inline-flex items-center justify-center px-6 py-2 text-[15px] font-bold tracking-wide text-white transition-all bg-transparent border-2 border-white rounded-[12px] hover:bg-white hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white" id="nav-cta-btn">
                    Contact Us
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- JavaScript for Navbar Scroll Color Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        const logoImg = document.getElementById('nav-logo-img');
        const logoText = document.getElementById('nav-logo-text');
        const navLinks = document.querySelectorAll('#navbar .nav-link');
        const loginBtn = document.getElementById('nav-login-btn');
        const ctaBtn = document.getElementById('nav-cta-btn');
        const mobileBtn = document.getElementById('mobileMenuBtn');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                // Scrolled State (White BG, Dark Text)
                logoImg.classList.remove('brightness-0', 'invert');
                
                logoText.classList.remove('text-white', 'group-hover:text-white/80');
                logoText.classList.add('text-slate-900', 'group-hover:text-primary-500');
                
                navLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:text-white/80');
                    link.classList.add('text-slate-900', 'hover:text-primary-500');
                });
                
                if(loginBtn) {
                    loginBtn.classList.remove('text-white', 'hover:text-white/80');
                    loginBtn.classList.add('text-slate-900', 'hover:text-primary-500');
                }
                
                if(ctaBtn) {
                    ctaBtn.classList.remove('text-white', 'border-white', 'hover:bg-white', 'focus:ring-white');
                    ctaBtn.classList.add('text-slate-900', 'border-slate-900', 'hover:bg-slate-900', 'focus:ring-slate-900');
                }
                
                if(mobileBtn) {
                    mobileBtn.classList.remove('text-white', 'hover:bg-white/10');
                    mobileBtn.classList.add('text-slate-900', 'hover:bg-gray-100');
                }
            } else {
                // Top State (Transparent BG, White Text)
                logoImg.classList.add('brightness-0', 'invert');
                
                logoText.classList.remove('text-slate-900', 'group-hover:text-primary-500');
                logoText.classList.add('text-white', 'group-hover:text-white/80');
                
                navLinks.forEach(link => {
                    link.classList.remove('text-slate-900', 'hover:text-primary-500');
                    link.classList.add('text-white', 'hover:text-white/80');
                });
                
                if(loginBtn) {
                    loginBtn.classList.remove('text-slate-900', 'hover:text-primary-500');
                    loginBtn.classList.add('text-white', 'hover:text-white/80');
                }
                
                if(ctaBtn) {
                    ctaBtn.classList.remove('text-slate-900', 'border-slate-900', 'hover:bg-slate-900', 'focus:ring-slate-900');
                    ctaBtn.classList.add('text-white', 'border-white', 'hover:bg-white', 'focus:ring-white');
                }
                
                if(mobileBtn) {
                    mobileBtn.classList.remove('text-slate-900', 'hover:bg-gray-100');
                    mobileBtn.classList.add('text-white', 'hover:bg-white/10');
                }
            }
        });
    });
</script>

<!-- Mobile Menu Overlay -->
<div id="mobileMenu" class="fixed inset-0 bg-white z-40 lg:hidden hidden overflow-y-auto">
    <div class="px-4 pt-5 pb-6">
        <div class="flex items-center justify-between mb-8">
            <a href="index.php" class="flex items-center space-x-2">
                <img src="assets/image/logo.png" alt="Abhinaya Logo" class="h-8 w-auto">
                <span class="font-heading font-bold text-secondary-900 text-lg tracking-tight">ABHINAYA</span>
            </a>
            <button id="closeMobileMenu" class="rounded-md p-2 inline-flex items-center justify-center text-secondary-500 hover:text-secondary-900 hover:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                <span class="sr-only">Close menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="grid gap-y-6">
            <a href="index.php" class="text-base font-medium text-secondary-900 hover:text-primary-600">Home</a>
            <a href="index.php#services" class="text-base font-medium text-secondary-900 hover:text-primary-600">Services</a>
            
            <div class="border-y border-secondary-100 py-4 space-y-4">
                <p class="text-sm font-medium text-secondary-500 uppercase tracking-widest pl-2">Divisions</p>
                <div class="grid grid-cols-1 gap-4 pl-4">
                    <a href="abhinaya-techno.php" class="text-base font-medium text-secondary-900 flex items-center">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-500 mr-3"></span>Techno
                    </a>
                    <a href="abhinaya-creative.php" class="text-base font-medium text-secondary-900 flex items-center">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 mr-3"></span>Creative
                    </a>
                    <a href="abhinaya-publisher.php" class="text-base font-medium text-secondary-900 flex items-center">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-3"></span>Publisher
                    </a>
                </div>
            </div>

            <a href="portfolio.php" class="text-base font-medium text-secondary-900 hover:text-primary-600">Portfolio</a>
            <a href="events.php" class="text-base font-medium text-secondary-900 hover:text-primary-600">Events</a>
            <a href="https://news.abhinaya.co.id/" target="_blank" rel="noopener" class="text-base font-medium text-secondary-900 hover:text-primary-600 flex items-center gap-2">News <svg class="w-3.5 h-3.5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>
            <a href="about.php" class="text-base font-medium text-secondary-900 hover:text-primary-600">Company</a>
            <a href="contact.php" class="text-base font-medium text-secondary-900 hover:text-primary-600">Contact Us</a>
            <a href="admin/index.php" class="text-base font-medium text-secondary-500 hover:text-secondary-900 border-t border-secondary-100 pt-6">Login Administrator</a>
        </nav>
    </div>
</div>
