<?php
// Panggil koneksi database
require_once 'config/database.php';

// Ambil data team dari database dan kelompokkan berdasarkan divisi
$team_query = "SELECT * FROM team ORDER BY division, name ASC";
$team_result = $conn->query($team_query);
$teams_by_division = [];
if ($team_result) {
    while ($row = $team_result->fetch_assoc()) {
        $division = $row['division'] ?? 'general';
        if (!isset($teams_by_division[$division])) {
            $teams_by_division[$division] = [];
        }
        $teams_by_division[$division][] = $row;
    }
}

// Definisikan warna untuk setiap divisi
$division_colors = [
    'techno' => 'from-blue-600 to-cyan-600',
    'creative' => 'from-purple-600 to-pink-600', 
    'publisher' => 'from-emerald-600 to-teal-600',
    'general' => 'from-gray-600 to-slate-600'
];

$division_names = [
    'techno' => 'Abhinaya Techno',
    'creative' => 'Abhinaya Creative',
    'publisher' => 'Abhinaya Publisher',
    'general' => 'General Management'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team - Abhinaya Indo Group</title>
    <meta name="description" content="Meet the talented team behind Abhinaya Indo Group - experts in IT solutions, creative services, and scientific publishing.">
    
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
                <a href="events.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Events</a>
                <a href="gallery.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg">Gallery</a>
                <a href="team.php" class="text-white/90 hover:text-white px-3 py-2 text-sm font-medium transition-all duration-300 hover:bg-white/10 rounded-lg bg-white/10">Team</a>
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

<section class="relative w-full min-h-screen flex items-center justify-center overflow-hidden pt-16">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-cyan-900/20 via-transparent to-blue-900/20"></div>
    
    <div class="relative z-20 text-center px-6 max-w-4xl mx-auto py-20" data-aos="fade-up" data-aos-duration="1000">
        <div class="mb-6 inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-400/30 rounded-full backdrop-blur-sm">
            <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
            <span class="text-cyan-300 text-sm font-medium">Meet Our Team</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-cyan-100 to-blue-100 bg-clip-text text-transparent drop-shadow-2xl">
                Our Amazing Team
            </span>
        </h1>
        
        <p class="text-xl md:text-2xl mb-12 text-gray-300 max-w-3xl mx-auto leading-relaxed font-light" data-aos="fade-up" data-aos-delay="200">
            The talented individuals who make Abhinaya Indo Group a leader in IT solutions, creative excellence, and scientific publishing.
        </p>
    </div>
</section>

<section class="py-20 md:py-32 bg-gradient-to-br from-slate-50 via-white to-cyan-50/30">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-6xl">
            <?php if (!empty($teams_by_division)): ?>
                <?php foreach ($teams_by_division as $division => $members): ?>
                    <div class="mb-16" data-aos="fade-up">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                                <?php echo htmlspecialchars($division_names[$division] ?? ucfirst($division)); ?>
                            </h2>
                            <div class="w-24 h-1 mx-auto bg-gradient-to-r <?php echo $division_colors[$division] ?? $division_colors['general']; ?> rounded-full"></div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <?php foreach ($members as $index => $member): ?>
                                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                                    <div class="relative h-80 bg-gradient-to-br <?php echo $division_colors[$division] ?? $division_colors['general']; ?> overflow-hidden">
                                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>
                                        <?php if (!empty($member['image'])): ?>
                                            <img src="admin/uploads/team/<?php echo htmlspecialchars($member['image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($member['name']); ?>" 
                                                 class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <div class="flex space-x-3">
                                                <?php if (!empty($member['linkedin'])): ?>
                                                <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors duration-300 transform hover:scale-110">
                                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                                    </svg>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (!empty($member['email'])): ?>
                                                <a href="mailto:<?php echo htmlspecialchars($member['email']); ?>" class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors duration-300 transform hover:scale-110">
                                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($member['name']); ?></h3>
                                        <p class="text-cyan-600 font-semibold mb-4"><?php echo htmlspecialchars($member['role']); ?></p>
                                        <?php if (!empty($member['bio'])): ?>
                                            <p class="text-gray-600 text-sm leading-relaxed"><?php echo htmlspecialchars(substr($member['bio'], 0, 100)) . '...'; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Team Members Yet</h3>
                    <p class="text-gray-500">Our team information will be available soon.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-20 md:py-32 bg-gradient-to-br from-gray-50 via-white to-cyan-50/20">
    <div class="w-full px-6 sm:px-8 lg:px-12">
        <div class="mx-auto max-w-4xl text-center">
            <div class="mb-6 inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 border border-cyan-400/30 rounded-full backdrop-blur-sm">
                <span class="w-2 h-2 bg-cyan-400 rounded-full mr-2 animate-pulse"></span>
                <span class="text-cyan-700 text-sm font-medium">Join Our Team</span>
            </div>
            
            <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                Ready to Make an Impact?
            </h2>
            
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed font-light">
                We're always looking for talented individuals who share our passion for innovation and excellence. Join us in shaping the future of technology and creativity.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="mailto:careers@abhinayaindo.com" class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <span class="mr-2">Send Your Resume</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </a>
                <a href="index.php" class="group relative inline-flex items-center px-8 py-4 bg-white text-cyan-600 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 border-2 border-cyan-200 hover:border-cyan-300">
                    <span class="mr-2">Back to Home</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

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
                    Transforming visions into reality through innovation and excellence.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="events.php" class="hover:text-white transition-colors">Events</a></li>
                    <li><a href="gallery.php" class="hover:text-white transition-colors">Gallery</a></li>
                    <li><a href="team.php" class="hover:text-white transition-colors">Team</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Divisions</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="abhinaya-techno.php" class="hover:text-white transition-colors">Techno</a></li>
                    <li><a href="abhinaya-creative.php" class="hover:text-white transition-colors">Creative</a></li>
                    <li><a href="abhinaya-publisher.php" class="hover:text-white transition-colors">Publisher</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>careers@abhinaya.co.id</li>
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
// Tutup koneksi (Koneksi dipanggil dari config/database.php)
if(isset($conn)) { $conn->close(); } 
?>
