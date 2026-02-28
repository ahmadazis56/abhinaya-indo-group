<?php
// Panggil konfigurasi database
require_once 'config/database.php';
require_once 'includes/news-fetch.php';

// Ambil data
$clients = getLogos('client'); 
$partners = getLogos('partner');
$events = getEvents(3); 
$total_projects = 50;
$total_team = 10;
$total_years = 3;
$satisfaction_rate = 98;

$featuredPortfolio = getPortfolio(6);
$latestNews = getLatestAbhinayaNews(3);

$heroSlides[] = [
    'title' => 'Elevate Your Business',
    'subtitle' => 'With Next-Gen Digital Solutions',
    'description' => 'Abhinaya Indo Group transforms ambitious ideas into industry-leading digital experiences. We partner with innovators to build scalable technology, compelling brands, and rigorous scientific publications.',
    'button_text' => 'Discover Our Expertise'
];

$pageTitle = "Abhinaya Indo Group - Digital Excellence & Innovation";
include 'includes/header.php';
?>

<!-- Hero Section - Full Width Video Background -->
<section class="relative w-full h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
    
    <!-- Video Background -->
    <video autoplay loop muted playsinline class="absolute top-1/2 left-1/2 min-w-full min-h-full w-auto h-auto -translate-x-1/2 -translate-y-1/2 object-cover z-0 filter brightness-[0.4] contrast-[1.1]">
        <source src="assets/image/video.mp4" type="video/mp4">
    </video>
    
    <!-- Gradient Overlay for readability -->
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-transparent to-slate-950/60 z-10 pointer-events-none"></div>

    <div class="relative z-20 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center text-center mt-12">
        
        <!-- Small upper badge -->
        <div class="mb-6" data-aos="fade-down" data-aos-duration="1000">
            <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm font-medium text-primary-200 ring-1 ring-inset ring-white/20 backdrop-blur-sm">
                <svg class="h-3.5 w-3.5 mr-1.5 fill-primary-400" viewBox="0 0 6 6" aria-hidden="true">
                    <circle cx="3" cy="3" r="3" />
                </svg>
                Global Innovation Leader
            </span>
        </div>

        <!-- Main Heading -->
        <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-[5rem] font-heading font-black mb-6 leading-tight tracking-tight text-white drop-shadow-md" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            Abhinaya Indo Group
        </h1>
        
        <!-- Subheading -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-heading font-medium mb-6 text-slate-200" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            Elevate your ideas with us
        </h2>
        
        <!-- Description text -->
        <p class="text-base sm:text-lg md:text-xl md:leading-relaxed mb-10 text-slate-300 font-medium max-w-3xl drop-shadow" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            Empower your vision with Abhinaya transforming businesses with cutting-edge IT solutions, impactful creative strategies, and high-quality scientific publications. Let's innovate and shape the future together.
        </p>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-16" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <a href="contact.php" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-white transition-all bg-[#14aecf] rounded-lg hover:bg-[#118da8] shadow-lg hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-primary-400/50 uppercase">
                Get Started
            </a>
            <a href="#services" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-white transition-all bg-white/10 border border-white/20 backdrop-blur-md rounded-lg hover:bg-white/20 hover:-translate-y-0.5 focus:outline-none">
                Explore Our Divisions
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        
        <!-- Stats/Features row -->
        <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-sm font-medium text-slate-300" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            <div class="flex items-center bg-white/5 backdrop-blur-sm px-4 py-2 rounded-full border border-white/10">
                <div class="w-6 h-6 rounded-full bg-primary-500/20 flex items-center justify-center mr-2">
                    <svg class="w-3.5 h-3.5 text-primary-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                3+ Years Excellence
            </div>
            <div class="flex items-center bg-white/5 backdrop-blur-sm px-4 py-2 rounded-full border border-white/10">
                <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center mr-2">
                    <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
                </div>
                50+ Projects Delivered
            </div>
            <div class="flex items-center bg-white/5 backdrop-blur-sm px-4 py-2 rounded-full border border-white/10">
                <div class="w-6 h-6 rounded-full bg-emerald-500/20 flex items-center justify-center mr-2">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                10+ Expert Team
            </div>
        </div>
        
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 animate-bounce cursor-pointer hover:text-white transition-colors">
        <a href="#services" class="flex flex-col items-center">
            <span class="text-xs font-semibold tracking-widest uppercase mb-2">Scroll</span>
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </a>
    </div>
</section>

<!-- Services Section - Hostinger Style Rounded Cards -->
<section id="services" class="py-24 md:py-32 bg-gray-50 relative overflow-hidden xl:px-8">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-24" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 leading-tight mb-6">Built for scale,<br/>designed for speed.</h2>
            <p class="text-lg text-slate-600 font-medium">Select the specialized division that aligns with your business goals. Unbeatable performance, unrivaled support.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            
            <!-- Service 1 (Techno) - Highlighted -->
            <div class="bg-white p-10 md:p-12 rounded-[2rem] shadow-[0_20px_60px_rgba(20,174,207,0.15)] border-[3px] border-primary-500 hover:-translate-y-2 transition-transform duration-300 relative group flex flex-col h-full" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary-500 text-white text-[11px] font-black uppercase tracking-widest py-1.5 px-5 rounded-full shadow-lg">
                    Most Popular
                </div>
                
                <div class="mb-8">
                    <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">Techno</h3>
                    <p class="text-slate-500 font-medium">Custom software & robust web platforms.</p>
                </div>
                
                <div class="space-y-4 mb-10 flex-grow">
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Web & Mobile App Development
                    </div>
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Enterprise Information Systems
                    </div>
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Custom IT Solutions
                    </div>
                </div>

                <a href="abhinaya-techno.php" class="inline-flex w-full items-center justify-center px-6 py-4 text-[15px] font-bold tracking-wide text-white transition-all bg-primary-500 rounded-xl hover:bg-primary-600 shadow-md">
                    Explore IT Solutions
                </a>
            </div>

            <!-- Service 2 (Creative) -->
            <div class="bg-white p-10 md:p-12 rounded-[2rem] shadow-hostinger border border-gray-100 hover:shadow-hostinger-hover hover:-translate-y-2 transition-all duration-300 relative group flex flex-col h-full" data-aos="fade-up" data-aos-delay="200">
                <div class="mb-8">
                    <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">Creative</h3>
                    <p class="text-slate-500 font-medium">Data-driven marketing & visual identities.</p>
                </div>
                
                <div class="space-y-4 mb-10 flex-grow">
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Social Media Management
                    </div>
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Creative Content Production
                    </div>
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Branding & Digital Marketing
                    </div>
                </div>

                <a href="abhinaya-creative.php" class="inline-flex w-full items-center justify-center px-6 py-4 text-[15px] font-bold tracking-wide text-primary-600 transition-all bg-primary-50 rounded-xl group-hover:bg-primary-500 group-hover:text-white">
                    Explore Branding
                </a>
            </div>

            <!-- Service 3 (Publisher) -->
            <div class="bg-white p-10 md:p-12 rounded-[2rem] shadow-hostinger border border-gray-100 hover:shadow-hostinger-hover hover:-translate-y-2 transition-all duration-300 relative group flex flex-col h-full" data-aos="fade-up" data-aos-delay="300">
                <div class="mb-8">
                    <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">Publisher</h3>
                    <p class="text-slate-500 font-medium">Rigorous academic publishing & journals.</p>
                </div>
                
                <div class="space-y-4 mb-10 flex-grow">
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Fullset Journal Management
                    </div>
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        National & International Indexing
                    </div>
                    <div class="flex items-center text-slate-700 font-semibold text-[15px]">
                        <svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Professional Academic Publishing
                    </div>
                </div>

                <a href="abhinaya-publisher.php" class="inline-flex w-full items-center justify-center px-6 py-4 text-[15px] font-bold tracking-wide text-primary-600 transition-all bg-primary-50 rounded-xl group-hover:bg-primary-500 group-hover:text-white">
                    Explore Publishing
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section - Hostinger Clean Numbers -->
<section class="py-20 md:py-24 bg-white border-y border-gray-100 relative overflow-hidden">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 relative z-10 w-full">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 md:gap-8 justify-items-center">
            
            <div class="text-center w-full max-w-[200px]" data-aos="fade-up" data-aos-delay="100">
                <div class="text-5xl md:text-6xl lg:text-7xl font-heading font-black text-slate-900 mb-3 tracking-tighter">
                    <span class="counter" data-target="<?php echo $total_projects; ?>">0</span>+
                </div>
                <div class="text-slate-500 font-bold text-[13px] tracking-widest uppercase">Projects Delivered</div>
            </div>
            
            <div class="text-center w-full max-w-[200px]" data-aos="fade-up" data-aos-delay="200">
                <div class="text-5xl md:text-6xl lg:text-7xl font-heading font-black text-slate-900 mb-3 tracking-tighter">
                    <span class="counter" data-target="<?php echo $total_team; ?>">0</span>
                </div>
                <div class="text-slate-500 font-bold text-[13px] tracking-widest uppercase">Expert Team</div>
            </div>
            
            <div class="text-center w-full max-w-[200px]" data-aos="fade-up" data-aos-delay="300">
                <div class="text-5xl md:text-6xl lg:text-7xl font-heading font-black text-slate-900 mb-3 tracking-tighter">
                    <span class="counter" data-target="<?php echo $total_years; ?>">0</span>
                </div>
                <div class="text-slate-500 font-bold text-[13px] tracking-widest uppercase">Years Excellence</div>
            </div>
            
            <div class="text-center w-full max-w-[200px]" data-aos="fade-up" data-aos-delay="400">
                <div class="text-5xl md:text-6xl lg:text-7xl font-heading font-black text-slate-900 mb-3 tracking-tighter">
                    <span class="counter" data-target="<?php echo $satisfaction_rate; ?>">0</span>%
                </div>
                <div class="text-slate-500 font-bold text-[13px] tracking-widest uppercase">Client Satisfaction</div>
            </div>
            
        </div>
    </div>
</section>

<!-- Portfolio Showcase - Modern Grid -->
<section id="portfolio" class="py-24 md:py-32 bg-white relative xl:px-8">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 relative z-10 w-full">
        
        <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-24" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6 leading-tight">Our Portofolio</h2>
            <p class="text-lg text-slate-600 font-medium">Explore a selection of our most impactful projects that transformed businesses and delighted users.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">
            <?php if (!empty($featuredPortfolio)): ?>
                <?php foreach ($featuredPortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-16 bg-gray-50 rounded-[2rem] border border-gray-100">
                    <p class="text-slate-500 font-medium">Our latest projects are currently being updated.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-16 text-center" data-aos="fade-up">
            <a href="portfolio.php" class="inline-flex items-center justify-center px-10 py-4 text-[16px] font-bold tracking-wide text-slate-900 transition-all bg-white border-2 border-slate-200 rounded-full hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-4 focus:ring-slate-100 group">
                View All Projects
                <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1 text-slate-400 group-hover:text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- Dynamic Clients / Partners Section -->
<section id="clients" class="py-16 md:py-24 bg-white relative border-t border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 relative z-10 w-full">
        
        <div class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-heading font-black text-slate-900 mb-4">Trusted by Industry Leaders</h2>
            <p class="text-lg text-slate-500 font-medium">Empowering global brands with scalable digital solutions.</p>
        </div>

        <!-- 1. Our Clients (Static Grid Form) -->
        <div class="mb-12 flex flex-col items-center w-full">
            <?php if (!empty($clients)): ?>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 md:gap-12 w-full items-center justify-items-center" data-aos="fade-up" data-aos-delay="100">
                    <?php foreach ($clients as $index => $logo): ?>
                        <div class="flex items-center justify-center p-4 transition-all duration-300">
                            <img src="<?php echo empty($logo['image']) ? 'https://via.placeholder.com/200x100?text=No+Logo' : 'admin/uploads/logos/' . htmlspecialchars($logo['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($logo['name'] ?? ''); ?>" 
                                 class="max-w-full max-h-[120px] md:max-h-[150px] w-auto object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="w-full text-center py-8 text-slate-400">
                    <p class="font-medium">Client list currently being updated.</p>
                </div>
            <?php endif; ?>
            
            <!-- Clean Action Button -->
            <div class="mt-12 text-center w-full" data-aos="fade-up">
                <a href="contact.php" class="inline-flex items-center justify-center px-8 py-3 text-[15px] font-bold tracking-wide text-slate-700 transition-all bg-white border-2 border-slate-200 rounded-full hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-4 focus:ring-slate-100">
                    Become a Partner
                </a>
            </div>
        </div>
    </div> <!-- Close max-w container -->

    <!-- 2. Our Partners (Animated Infinite Ticker) -->
    <div class="relative w-full border-t border-gray-100 pt-16">
        <div class="text-center mb-10 px-4" data-aos="fade-up">
            <h3 class="text-2xl font-heading font-black text-slate-900">Our Strategic Partners</h3>
        </div>

        <div class="relative w-full overflow-hidden flex items-center group">
            <!-- Smooth wide fade edges to blend into bg -->
            <div class="absolute inset-y-0 left-0 w-32 md:w-64 bg-gradient-to-r from-white via-white to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-32 md:w-64 bg-gradient-to-l from-white via-white to-transparent z-10 pointer-events-none"></div>
            
            <?php if (!empty($partners)): ?>
                <div class="flex animate-scroll-left group-hover:[animation-play-state:paused] w-max items-center">
                    <div class="flex items-center space-x-12 px-6">
                        <?php foreach (array_merge($partners, $partners) as $index => $logo): ?>
                            <div class="w-80 shrink-0 flex justify-center items-center">
                                <img src="<?php echo empty($logo['image']) ? 'https://via.placeholder.com/200x100?text=No+Logo' : 'admin/uploads/logos/' . htmlspecialchars($logo['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($logo['name'] ?? ''); ?>" 
                                     class="max-w-full h-16 md:h-20 w-auto object-contain grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-500 cursor-pointer">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="w-full text-center py-8 text-slate-400">
                    <p class="font-medium">Partner list currently being updated.</p>
                </div>
            <?php endif; ?>
        </div>
</section>

<!-- ======================================= -->
<!-- Latest News Section                      -->
<!-- ======================================= -->
<section id="news" class="py-24 md:py-32 bg-slate-50 relative overflow-hidden xl:px-8">
    <!-- Abstract Background -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -bottom-24 -right-24 w-[400px] h-[400px] rounded-full bg-[#14aecf]/5 blur-[80px]"></div>
        <div class="absolute top-0 left-0 w-[300px] h-[300px] rounded-full bg-indigo-500/5 blur-[80px]"></div>
    </div>
    
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 relative z-10">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-16" data-aos="fade-up">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-full bg-[#14aecf]/10 px-3 py-1 text-sm font-semibold text-[#14aecf] ring-1 ring-inset ring-[#14aecf]/20 mb-4">
                    <svg class="h-2 w-2 mr-1.5 fill-[#14aecf]" viewBox="0 0 6 6"><circle cx="3" cy="3" r="3" /></svg>
                    Berita Terbaru
                </span>
                <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 leading-tight mb-4">Kabar dari Abhinaya</h2>
                <p class="text-lg text-slate-600 font-medium">Informasi dan liputan terkini langsung dari laman berita resmi kami.</p>
            </div>
            <a href="https://news.abhinaya.co.id/category/abhinaya/" target="_blank" rel="noopener" class="inline-flex items-center gap-2 shrink-0 px-6 py-3 text-sm font-bold tracking-wide text-slate-700 bg-white border-2 border-slate-200 rounded-full hover:bg-slate-50 hover:border-slate-300 transition-all">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $index => $article): ?>
                    <article class="bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-2 transition-all duration-300 flex flex-col group" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        
                        <!-- Thumbnail -->
                        <a href="<?php echo htmlspecialchars($article['link']); ?>" target="_blank" rel="noopener" class="block relative aspect-[16/10] overflow-hidden bg-slate-100 shrink-0">
                            <?php if (!empty($article['image'])): ?>
                                <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($article['title']); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#14aecf]/10 to-indigo-500/10">
                                    <svg class="w-12 h-12 text-[#14aecf]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            <?php endif; ?>
                            <!-- Overlay badge -->
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/90 text-slate-700 shadow-sm backdrop-blur-sm">
                                    <?php echo htmlspecialchars($article['category']); ?>
                                </span>
                            </div>
                        </a>
                        
                        <!-- Content -->
                        <div class="p-7 flex flex-col flex-1">
                            <!-- Date -->
                            <time class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <?php echo htmlspecialchars($article['date_formatted']); ?>
                            </time>
                            
                            <!-- Title -->
                            <h3 class="text-lg font-heading font-black text-slate-900 mb-3 leading-tight line-clamp-3 group-hover:text-[#14aecf] transition-colors">
                                <a href="<?php echo htmlspecialchars($article['link']); ?>" target="_blank" rel="noopener">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                            </h3>
                            
                            <!-- Excerpt -->
                            <p class="text-slate-500 font-medium text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                <?php echo htmlspecialchars($article['excerpt']); ?>
                            </p>
                            
                            <!-- Read more link -->
                            <a href="<?php echo htmlspecialchars($article['link']); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-sm font-bold text-[#14aecf] hover:text-[#0f8ca8] transition-colors mt-auto group/link">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 bg-white rounded-[2rem] border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <p class="text-slate-500 font-semibold">Berita sedang dimuat, coba refresh halaman.</p>
                    <a href="https://news.abhinaya.co.id/" target="_blank" class="inline-flex items-center gap-2 mt-4 text-sm font-bold text-[#14aecf] hover:underline">Kunjungi Portal Berita Kami</a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>