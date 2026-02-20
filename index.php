<?php
// Panggil konfigurasi database dari sistem admin Anda
require_once 'config/database.php';

// Ambil data logo berdasarkan kategori menggunakan fungsi yang sudah Anda buat di config
$clients = getLogos('client'); // Mengambil khusus logo klien

// Mengambil logo untuk partner (gabungan dari publisher, creative, techno)
$publishers = getLogos('publisher');
$creatives = getLogos('creative');
$technos = getLogos('techno');
$partners = array_merge($publishers, $creatives, $technos);

// Data statis untuk Hero (karena fitur Hero belum ada di tabel admin, kita set statis sementara)
$heroSlides[] = [
    'title' => 'Abhinaya Indo Group',
    'subtitle' => 'Transforming Visions Into Reality',
    'description' => 'Leading the future with innovative IT solutions, creative excellence, and scientific publishing.',
    'button_text' => 'Start Your Journey'
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

        <div class="w-full">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $index => $client): ?>
                    <div class="group relative flex items-center justify-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border border-gray-100 hover:border-cyan-200 cursor-pointer" data-aos="fade-up" data-aos-delay="<?php echo ($index % 6) * 50; ?>">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/5 to-blue-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10 w-full h-full flex items-center justify-center">
                            <img src="uploads/logos/<?php echo htmlspecialchars($client['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($client['name']); ?>" 
                                 title="<?php echo htmlspecialchars($client['name']); ?>"
                                 class="object-contain max-h-16 w-auto transition-all duration-500 grayscale group-hover:grayscale-0 group-hover:scale-110">
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-8 text-gray-500">
                        <p>Belum ada data klien. Silakan tambahkan klien melalui Admin Panel.</p>
                    </div>
                <?php endif; ?>
            </div>
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
                        <?php foreach ($partners as $partner): ?>
                        <div class="flex items-center justify-center px-12 flex-shrink-0">
                            <div class="flex items-center justify-center w-48 h-24 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:bg-gradient-to-br hover:from-cyan-50 hover:to-blue-50 group border border-gray-100">
                                <div class="relative w-full h-full flex items-center justify-center p-4">
                                    <img src="uploads/logos/<?php echo htmlspecialchars($partner['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($partner['name']); ?>" 
                                         class="object-contain transition-all duration-500 group-hover:scale-105 max-w-full max-h-full opacity-80 group-hover:opacity-100">
                                    
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2 rounded-b-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <p class="text-white text-xs font-medium text-center truncate">
                                            <?php echo htmlspecialchars($partner['name']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
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
// Tutup koneksi (Koneksi dipanggil dari config/database.php)
if(isset($conn)) { $conn->close(); } 
?>