<?php
require_once 'config/database.php';

// Get portfolio items for creative division
$creativePortfolio = getPortfolioByCategory('creative');

// Get team members for creative division
$creativeTeam = getTeamByDivision('creative');

function getPortfolioByCategory($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM portfolio WHERE category = ? AND status = 'active' ORDER BY sort_order ASC, created_at DESC");
    if($stmt) {
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
    return [];
}

function getTeamByDivision($division) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM team WHERE division = ? AND status = 'active' ORDER BY sort_order ASC, created_at ASC");
    if($stmt) {
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
    return [];
}

$pageTitle = "Abhinaya Creative - Brand & Design Studio";
$pageDesc = "Transform your brand identity with our comprehensive creative solutions. From branding design to digital marketing.";
include 'includes/header.php';
?>

<!-- Hero Section - Hostinger Dark Style -->
<section class="relative w-full py-24 md:py-32 bg-slate-900 overflow-hidden text-center">
    <div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-purple-900/50 to-transparent"></div>
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-purple-600 blur-3xl mix-blend-screen opacity-30"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
        <div class="inline-flex items-center px-4 py-2 bg-slate-800/50 rounded-full border border-slate-700 backdrop-blur-md mb-8">
            <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
            <span class="text-sm font-bold text-slate-300 uppercase tracking-widest">Brand & Design Studio</span>
        </div>
        
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-[1.1] tracking-tight text-white">
            Design that <br/>
            <span class="text-purple-400">Communicates.</span>
        </h1>
        
        <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
            We craft compelling visual identities and data-driven marketing campaigns that captivate audiences and inspire action.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="#packages" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-white transition-all bg-purple-600 rounded-2xl hover:bg-purple-700 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-purple-200">
                Marketing Packages
            </a>
            <a href="#portfolio" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-slate-900 transition-all bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 hover:border-gray-300">
                View Studio Work
            </a>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="py-24 bg-white border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-2xl font-heading font-black text-slate-900 mb-3">Brand Identity</h3>
                <p class="text-slate-500 mb-4 font-medium leading-relaxed">Defining absolute clarity in how your brand is perceived. We cover identity design, brand voice, and visual guidelines.</p>
                <div class="flex flex-wrap gap-2 text-[13px] font-bold text-slate-400 uppercase tracking-widest">
                    <span>Logos &bull; Typography &bull; Directives</span>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-2xl font-heading font-black text-slate-900 mb-3">Performance Marketing</h3>
                <p class="text-slate-500 mb-4 font-medium leading-relaxed">Executing campaigns mapped precisely to growth targets across social channels, search behavior, and email segments.</p>
                <div class="flex flex-wrap gap-2 text-[13px] font-bold text-slate-400 uppercase tracking-widest">
                    <span>PPC &bull; SEO &bull; Social Ads</span>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-2xl font-heading font-black text-slate-900 mb-3">Content Creation</h3>
                <p class="text-slate-500 mb-4 font-medium leading-relaxed">Rich multimedia storytelling that connects emotionally and visually with your consumers contextually.</p>
                <div class="flex flex-wrap gap-2 text-[13px] font-bold text-slate-400 uppercase tracking-widest">
                    <span>Video &bull; Copy &bull; Photography</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Packages Section (unchanged) -->
<!-- Note: The service cards for Creative were not modified because they already reflect the desired offerings. -->
<section id="packages" class="py-24 bg-gray-50 border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-20" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6 leading-tight">Amplify your voice.</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <!-- Basic Package -->
            <div class="bg-white rounded-[2rem] p-10 border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300 relative flex flex-col" data-aos="fade-up" data-aos-delay="100">
                <div class="mb-8">
                    <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">BASIC PRESENCE</h3>
                    <p class="text-slate-500 text-sm mb-6 pb-6 border-b border-gray-100 font-medium">Menjaga kehadiran brand tetap aktif dan konsisten di media sosial.</p>
                    <div class="flex items-baseline text-slate-900">
                        <span class="text-5xl font-black tracking-tight">1.8jt</span>
                        <span class="ml-1 text-slate-500 font-medium tracking-wide">/bulan</span>
                    </div>
                </div>
                <ul class="space-y-4 mb-10 flex-1 text-[15px] text-slate-600 font-medium">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Konten Feed Instagram: 12 konten (3 konten/minggu: 3 feed visual + 1 video)</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Video TikTok: 8 konten</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Instagram Story: 1–3 per hari</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Perencanaan, Copywriting, & Riset Hashtag</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Penjadwalan & 2 kali revisi minor</span>
                    </li>
                </ul>
                <a href="https://wa.me/6285646603602?text=Halo%20Tim%20Abhinaya%2C%20saya%20ingin%20berkonsultasi%20mengenai%20layanan%20Creative%3A%20paket%20Basic%20Presence.%20Boleh%20minta%20informasi%20lebih%20lanjut%3F" target="_blank" class="w-full block text-center py-4 bg-white text-slate-900 font-bold border-2 border-slate-200 rounded-2xl hover:border-purple-600 hover:text-purple-700 transition-colors">Get Started</a>
            </div>

            <!-- Growth Package - Highlighted -->
            <div class="bg-purple-50 rounded-[2rem] p-10 border-2 border-purple-600 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300 relative flex flex-col md:-translate-y-4" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-0 right-8 transform -translate-y-1/2">
                    <span class="bg-purple-600 text-white text-[11px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full shadow-md">Most Popular</span>
                </div>
                <div class="mb-8">
                    <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">GROWTH CONTENT</h3>
                    <p class="text-slate-600 text-sm mb-6 pb-6 border-b border-purple-200 font-medium">Meningkatkan interaksi audiens dan performa konten.</p>
                    <div class="flex items-baseline text-slate-900">
                        <span class="text-5xl font-black tracking-tight">2.5jt</span>
                        <span class="ml-1 text-slate-600 font-medium tracking-wide">/bulan</span>
                    </div>
                </div>
                <ul class="space-y-4 mb-10 flex-1 text-[15px] text-slate-700 font-medium">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Konten Feed Instagram: 12 konten (3 konten/minggu: 2 feed visual + 1 video)</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Video TikTok: 12 konten</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Instagram Story: 2–4 per hari</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Perencanaan, Copywriting, Riset, & Pengelolaan akun</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-purple-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>3 Revisi & Laporan performa bulanan</span>
                    </li>
                </ul>
                <a href="https://wa.me/6285646603602?text=Halo%20Tim%20Abhinaya%2C%20saya%20ingin%20berkonsultasi%20mengenai%20layanan%20Creative%3A%20paket%20Growth%20Content.%20Boleh%20minta%20informasi%20lebih%20lanjut%3F" target="_blank" class="w-full block text-center py-4 bg-purple-600 text-white font-bold rounded-2xl hover:bg-purple-700 shadow-md hover:shadow-lg transition-all">Get Started</a>
            </div>

            <!-- Conversion Package -->
            <div class="bg-white rounded-[2rem] p-10 border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300 relative flex flex-col" data-aos="fade-up" data-aos-delay="300">
                <div class="mb-8">
                    <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">BRANDING & CONVERSION</h3>
                    <p class="text-slate-500 text-sm mb-6 pb-6 border-b border-gray-100 font-medium">Penguatan brand sekaligus mendorong konversi.</p>
                    <div class="flex items-baseline text-slate-900">
                        <span class="text-5xl font-black tracking-tight">3jt</span>
                        <span class="ml-1 text-slate-500 font-medium tracking-wide">/bulan</span>
                    </div>
                </div>
                <ul class="space-y-4 mb-10 flex-1 text-[15px] text-slate-600 font-medium">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Konten Feed Instagram: 12 konten (3 konten/minggu: 2 feed visual + 1 video)</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Video TikTok / Reels: 12 konten</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Instagram Story: 6 per hari</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>Copywriting + CTA, Ide Strategis, Riset & Pengelolaan Akun</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        <span>3 Revisi & Laporan performa bulanan lengkap</span>
                    </li>
                </ul>
                <a href="https://wa.me/6285646603602?text=Halo%20Tim%20Abhinaya%2C%20saya%20ingin%20berkonsultasi%20mengenai%20layanan%20Creative%3A%20paket%20Branding%20%26%20Conversion.%20Boleh%20minta%20informasi%20lebih%20lanjut%3F" target="_blank" class="w-full block text-center py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-colors">Get Started</a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-24 bg-white border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Creative Portfolio</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if (!empty($creativePortfolio)): ?>
                <?php foreach ($creativePortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 px-4 bg-gray-50 rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">Portfolio Curating</h3>
                    <p class="text-slate-500 font-medium">Our creative works are being curated.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-24 bg-gray-50 border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">The Studio Crew</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php if (!empty($creativeTeam)): ?>
                <?php foreach ($creativeTeam as $member): ?>
                    <?php include 'includes/team-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 px-4 bg-white rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">Crew Update In Progress</h3>
                    <p class="text-slate-500 font-medium">Our design and marketing team members will be highlighted here soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 bg-white text-center border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Ready to create something iconic?</h2>
        <p class="text-lg md:text-xl text-slate-500 mb-10 font-medium">Bring your vision out of your head and into the world.</p>
        <a href="contact.php" class="inline-flex items-center justify-center px-10 py-4 text-[16px] font-bold tracking-wide text-white transition-all bg-purple-600 rounded-2xl hover:bg-purple-700 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-purple-200">
            Start a Project
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
