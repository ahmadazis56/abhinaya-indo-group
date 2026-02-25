<?php
require_once 'config/database.php';

// Get portfolio items for techno division
$technoPortfolio = getPortfolioByCategory('techno');

// Get team members for techno division
$technoTeam = getTeamByDivision('techno');

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

$pageTitle = "Abhinaya Techno - Digital Engineering Solutions";
$pageDesc = "Transform your business with cutting-edge technology solutions. From web development to AI integration.";
include 'includes/header.php';
?>

<!-- Hero Section - Hostinger Dark Style -->
<section class="relative w-full py-24 md:py-32 bg-slate-900 overflow-hidden text-center">
    <div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-primary-600 blur-3xl mix-blend-screen opacity-30"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
        <div class="inline-flex items-center px-4 py-2 bg-slate-800/50 rounded-full border border-slate-700 backdrop-blur-md mb-8">
            <span class="w-2 h-2 bg-blue-400 rounded-full mr-2"></span>
            <span class="text-sm font-bold text-slate-300 uppercase tracking-widest">Technology & Engineering</span>
        </div>
        
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-[1.1] tracking-tight text-white">
            Digital Engineering <br/>
            <span class="text-primary-400">Unleashed.</span>
        </h1>
        
        <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
            We build robust, scalable digital solutions. Empower your enterprise with our forward-thinking software development and technical consulting.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="#packages" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-white transition-all bg-primary-500 rounded-2xl hover:bg-primary-600 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-primary-200">
                Explore Packages
            </a>
            <a href="#portfolio" class="inline-flex items-center justify-center px-8 py-3.5 text-[15px] font-bold tracking-wide text-slate-900 transition-all bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 hover:border-gray-300">
                View Our Work
            </a>
        </div>
    </div>
</section>


<!-- Updated Packages Section -->
<section id="updated-packages" class="py-24 bg-gray-50 border-b border-gray-100">
  <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-20" data-aos="fade-up">
      <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6 leading-tight">Our Service Packages</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
      <!-- Basic Digital -->
      <div class="bg-white rounded-[2rem] p-10 border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300 relative flex flex-col" data-aos="fade-up" data-aos-delay="100">
        <div class="mb-8">
          <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">Basic Digital</h3>
          <p class="text-slate-500 text-sm mb-6 pb-6 border-b border-gray-100 font-medium">Rp 3,5 Juta per project</p>
          <div class="flex items-baseline text-slate-900">
            <span class="text-5xl font-black tracking-tight">3.5jt</span>
            <span class="ml-1 text-slate-500 font-medium tracking-wide">/project</span>
          </div>
        </div>
        <ul class="space-y-4 mb-10 flex-1 text-[15px] text-slate-600 font-medium">
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Company profile website / landing page</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Desain UI/UX dasar</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Mobile responsive</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Domain & hosting setup (jika tersedia)</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Form kontak</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>SEO dasar</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-500 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>1 bulan support teknis</span></li>
        </ul>
        <a href="https://wa.me/6285646603602?text=Halo%20Abhinaya,%20saya%20tertarik%20dengan%20paket%20Basic%20Digital." target="_blank" class="w-full block text-center py-4 bg-white text-slate-900 font-bold border-2 border-slate-200 rounded-2xl hover:border-primary-500 hover:text-primary-600 transition-colors">Get Started</a>
      </div>
      <!-- Professional Digital -->
      <div class="bg-primary-50 rounded-[2rem] p-10 border-2 border-primary-500 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300 relative flex flex-col md:-translate-y-4" data-aos="fade-up" data-aos-delay="200">
        <div class="absolute top-0 right-8 transform -translate-y-1/2"><span class="bg-primary-600 text-white text-[11px] font-bold uppercase tracking-widest py-1.5 px-4 rounded-full shadow-md">Most Popular</span></div>
        <div class="mb-8">
          <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">Professional Digital</h3>
          <p class="text-slate-600 text-sm mb-6 pb-6 border-b border-primary-200 font-medium">Rp 5 Juta per project</p>
          <div class="flex items-baseline text-slate-900">
            <span class="text-5xl font-black tracking-tight">5jt</span>
            <span class="ml-1 text-slate-600 font-medium tracking-wide">/project</span>
          </div>
        </div>
        <ul class="space-y-4 mb-10 flex-1 text-[15px] text-slate-700 font-medium">
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Website / sistem informasi sederhana</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>UI/UX custom design</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Mobile responsive</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>SEO on-page</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Integrasi WhatsApp Business</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>CMS / admin panel</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Keamanan dasar (SSL + security layer)</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Training admin</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-primary-600 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>6 bulan support teknis</span></li>
        </ul>
        <a href="https://wa.me/6285646603602?text=Halo%20Abhinaya,%20saya%20tertarik%20dengan%20paket%20Professional%20Digital." target="_blank" class="w-full block text-center py-4 bg-primary-500 text-white font-bold rounded-2xl hover:bg-primary-600 shadow-md hover:shadow-lg transition-all">Get Started</a>
      </div>
      <!-- Enterprise Solution -->
      <div class="bg-white rounded-[2rem] p-10 border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300 relative flex flex-col" data-aos="fade-up" data-aos-delay="300">
        <div class="mb-8">
          <h3 class="text-2xl font-heading font-black text-slate-900 mb-2">Enterprise Solution</h3>
          <p class="text-slate-500 text-sm mb-6 pb-6 border-b border-gray-100 font-medium">Custom Pricing</p>
        </div>
        <ul class="space-y-4 mb-10 flex-1 text-[15px] text-slate-600 font-medium">
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Sistem informasi enterprise</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Web aplikasi</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Mobile app (Android/iOS)</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>ERP mini system</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>POS system</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Portal berita</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>E-Government system</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>AI-based system</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Dashboard big data</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>API integration</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Cloud deployment</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Multi-role user system</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Maintenance kontrak tahunan</span></li>
          <li class="flex items-start"><svg class="w-5 h-5 text-slate-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg><span>Dedicated developer team</span></li>
        </ul>
        <a href="https://wa.me/6285646603602?text=Halo%20Abhinaya,%20saya%20tertarik%20dengan%20paket%20Enterprise%20Solution." target="_blank" class="w-full block text-center py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-colors">Contact Sales</a>
      </div>
    </div>
  </div>
</section>


<!-- Portfolio Section -->
<section id="portfolio" class="py-24 bg-white border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Techno Portfolio</h2>
            <p class="text-lg text-slate-500 font-medium">
                Discover the enterprise-grade applications and systems we've shipped.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">
            <?php if (!empty($technoPortfolio)): ?>
                <?php foreach ($technoPortfolio as $project): ?>
                    <?php include 'includes/portfolio-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 px-4 bg-gray-50 rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">Portfolio Curating</h3>
                    <p class="text-slate-500 font-medium">Our technology portfolio is currently being curated.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-24 bg-gray-50 border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">The Engineering Minds</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php if (!empty($technoTeam)): ?>
                <?php foreach ($technoTeam as $member): ?>
                    <?php include 'includes/team-card.php'; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 px-4 bg-white rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-slate-300 mb-6 flex justify-center">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-heading font-black text-slate-900 mb-2">Team Update In Progress</h3>
                    <p class="text-slate-500 font-medium">Our engineering team members will be highlighted here soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-white text-center border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-6">Build the future with us.</h2>
        <p class="text-lg md:text-xl text-slate-500 mb-10 font-medium">Discuss your technical requirements with our lead engineers today.</p>
        <a href="contact.php" class="inline-flex items-center justify-center px-10 py-4 text-[16px] font-bold tracking-wide text-white transition-all bg-primary-500 rounded-2xl hover:bg-primary-600 shadow-hostinger hover:shadow-hostinger-hover hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-primary-200">
            Start a Conversation
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
