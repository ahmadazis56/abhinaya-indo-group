<?php
require_once 'config/database.php';

// Get portfolio items for publisher division
$publisherPortfolio = getPortfolioByCategory('publisher');
$publisherTeam = getTeamByDivision('publisher');

$packages = [
    [
        'title' => 'Journal Management',
        'description' => 'Professional end-to-end management for scientific and academic journals.',
        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'
    ],
    [
        'title' => 'Editorial Services',
        'description' => 'Expert editorial support including proofreading, formatting, and peer review coordination.',
        'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'
    ],
    [
        'title' => 'Academic Publishing',
        'description' => 'Publish your research in high-quality academic books and proceedings.',
        'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'
    ],
    [
        'title' => 'Indexing Support',
        'description' => 'Strategic support to get your publications indexed in major global databases.',
        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
    ]
];

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

$pageTitle = "Abhinaya Publisher - Scientific Distribution";
$pageDesc = "Professional academic publishing, journal management, and editorial services.";
include 'includes/header.php';
?>

<!-- Hero Section - Hostinger Dark Style -->
<section class="relative w-full py-24 md:py-32 bg-slate-900 overflow-hidden text-center">
    <div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-emerald-900/50 to-transparent"></div>
        <div class="absolute top-0 left-0 -ml-32 -mt-32 w-96 h-96 rounded-full bg-emerald-600 blur-3xl mix-blend-screen opacity-30"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
        <div class="inline-flex items-center px-4 py-2 bg-slate-800/50 rounded-full border border-slate-700 backdrop-blur-md mb-8">
            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
            <span class="text-sm font-bold text-slate-300 uppercase tracking-widest">Scientific Distribution</span>
        </div>
        
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-[1.1] tracking-tight text-white">
            Academic Publishing <br/>
            <span class="text-emerald-400">Elevated.</span>
        </h1>
        
        <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
            We deliver rigorous peer-review orchestration, exquisite editorial oversight, and extensive worldwide database indexing support.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="#services" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-white transition-all bg-emerald-600 rounded-2xl hover:bg-emerald-700 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                Our Process
            </a>
            <a href="#portfolio" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-slate-900 transition-all bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 hover:border-gray-300">
                View Journals
            </a>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section id="services" class="py-24 bg-gray-50 border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-[#0f172a] mb-4">Publishing Packages</h2>
            <p class="text-lg text-slate-500 font-medium">Flexible publishing plans tailored to your journal needs</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch pt-4">
            <!-- Basic Journal -->
            <div class="bg-white rounded-2xl p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] flex flex-col h-full transform transition-transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                <div class="mb-8 block">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Basic Journal</h3>
                    <div class="flex items-baseline text-slate-900">
                        <span class="text-[2.75rem] leading-none font-bold">Rp 5 Juta</span>
                        <span class="text-sm text-slate-500 font-medium ml-1">/per journal</span>
                    </div>
                </div>
                <ul class="space-y-4 mb-10 flex-1">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Instalasi OJS</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Setup website journal</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Template jurnal</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Struktur editorial</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Konfigurasi workflow submission</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Pembinaan ISSN</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Training editor</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">3 bulan support</span>
                    </li>
                </ul>
                <button class="w-full py-3.5 bg-slate-100 text-slate-800 text-[13px] font-bold uppercase tracking-wide rounded-lg hover:bg-slate-200 transition-colors mt-auto">
                    GET STARTED
                </button>
            </div>

            <!-- Professional Journal -->
            <div class="bg-white rounded-[1.5rem] p-10 shadow-[0_20px_50px_-12px_rgba(99,102,241,0.15)] flex flex-col h-full transform md:-translate-y-4 border-2 border-[#6366f1] relative" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-0 right-6 transform -translate-y-1/2">
                    <span class="bg-[#5a4add] text-white text-[11px] font-bold px-3 py-1 rounded-sm shadow-sm">Most Popular</span>
                </div>
                <div class="mb-8 block">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Professional Journal</h3>
                    <div class="flex items-baseline text-slate-900">
                        <span class="text-[2.75rem] leading-none font-bold">Rp 8 Juta</span>
                        <span class="text-sm text-slate-500 font-medium ml-1">/per website</span>
                    </div>
                </div>
                <ul class="space-y-4 mb-10 flex-1">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">OJS full setup</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">3+ Journal installation</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Fullset Management journal</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Advanced peer-review workflow</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">DOI registration</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Crossref integration</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Indexing preparation</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Plagiarism checking system</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Layout & template journal profesional</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">12 bulan support</span>
                    </li>
                </ul>
                <button class="w-full py-3.5 bg-[#5a4add] text-white text-[13px] font-bold uppercase tracking-wide rounded-lg hover:bg-[#4f3fd6] shadow-md transition-all mt-auto">
                    GET STARTED
                </button>
            </div>

            <!-- Premium Publisher -->
            <div class="bg-white rounded-2xl p-8 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] flex flex-col h-full transform transition-transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                <div class="mb-8 block">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Premium Publisher</h3>
                    <div class="flex items-baseline text-slate-900">
                        <span class="text-[2.75rem] leading-none font-bold">Custom</span>
                        <span class="text-sm text-slate-500 font-medium ml-1">/contact for pricing</span>
                    </div>
                </div>
                <ul class="space-y-4 mb-10 flex-1">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Multi-journal management</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Journal platform terintegrasi</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Portal publisher</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Strategi indexing nasional & internasional</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Scopus preparation system</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">International partnership support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Editorial management system</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Analytics & reporting</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-[15px] text-slate-600 font-medium">Dedicated publishing team</span>
                    </li>
                </ul>
                <button class="w-full py-3.5 bg-slate-100 text-slate-800 text-[13px] font-bold uppercase tracking-wide rounded-lg hover:bg-slate-200 transition-colors mt-auto">
                    GET STARTED
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Publications -->
<section id="portfolio" class="py-24 bg-white border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Scientific Records</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($publisherPortfolio)): ?>
                <?php foreach ($publisherPortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 px-4 bg-gray-50 rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">Publishing List Update</h3>
                    <p class="text-slate-500 font-medium">Our publications list is being updated.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-24 bg-gray-50 border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Editorial Board</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php if (!empty($publisherTeam)): ?>
                <?php foreach ($publisherTeam as $member): ?>
                    <?php include 'includes/team-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 px-4 bg-white rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">Board Update In Progress</h3>
                    <p class="text-slate-500 font-medium">Editorial board members will be highlighted here soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 bg-white text-center border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Drive the conversation.</h2>
        <p class="text-lg md:text-xl text-slate-500 mb-10 font-medium">Join thousands of researchers disseminating quality peer-reviewed articles.</p>
        <a href="contact.php" class="inline-flex items-center justify-center px-10 py-4 text-[16px] font-bold tracking-wide text-white transition-all bg-emerald-600 rounded-2xl hover:bg-emerald-700 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-emerald-200">
            Submit an Inquiry
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
