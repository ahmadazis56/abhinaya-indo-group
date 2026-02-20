<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Abhinaya Indo Group</title>
    <meta name="description" content="Terms of Service of Abhinaya Indo Group. Read our terms and conditions for using our website and services.">
    
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

<!-- Hero Section -->
<section class="relative pt-24 pb-16 bg-gradient-to-br from-[#0e6d7c] to-[#14aecf] overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative container mx-auto px-6 text-center text-white">
        <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                Terms of Service
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                Please read these terms carefully before using our website and services.
            </p>
        </div>
    </div>
</section>

<!-- Terms Content -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg max-w-none" data-aos="fade-up">
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Acceptance of Terms</h2>
                    <p class="text-gray-600 leading-relaxed">
                        By accessing and using the Abhinaya Indo Group website and services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Description of Service</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Abhinaya Indo Group provides technology solutions, creative services, and scientific publishing through our three divisions: Abhinaya Techno, Abhinaya Creative, and Abhinaya Publisher. We reserve the right to modify, suspend, or discontinue any aspect of our service at any time.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">User Responsibilities</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        As a user of our services, you agree to:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Provide accurate and complete information</li>
                        <li>Use our services for lawful purposes only</li>
                        <li>Not attempt to gain unauthorized access to our systems</li>
                        <li>Not interfere with or disrupt our services</li>
                        <li>Not use our services to transmit harmful code or malware</li>
                        <li>Respect intellectual property rights</li>
                        <li>Comply with all applicable laws and regulations</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Intellectual Property Rights</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        All content, trademarks, service marks, logos, and other intellectual property displayed on our website belong to Abhinaya Indo Group or our respective owners. You may not use, copy, reproduce, republish, upload, post, transmit, or distribute such content without our prior written consent.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">User-Generated Content</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        You may have the opportunity to post, link, store, share, and otherwise make available certain information, text, graphics, or other material. You are responsible for the content you submit.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        By submitting content, you grant us a worldwide, non-exclusive, royalty-free license to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Privacy Policy</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Your use of our services is also governed by our Privacy Policy, which outlines how we collect, use, and protect your personal information. Please review our Privacy Policy, which also governs the site and informs users of our data collection practices.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Service Availability</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We strive to maintain high availability of our services, but we do not guarantee that our services will be uninterrupted, timely, secure, or error-free. We are not responsible for any loss or damage arising from service unavailability.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Limitation of Liability</h2>
                    <p class="text-gray-600 leading-relaxed">
                        To the maximum extent permitted by law, Abhinaya Indo Group shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your use of the service.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Indemnification</h2>
                    <p class="text-gray-600 leading-relaxed">
                        You agree to indemnify and hold harmless Abhinaya Indo Group, its officers, directors, employees, agents, and affiliates from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney's fees).
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Termination</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We may terminate or suspend your access immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms. Upon termination, your right to use the service will cease immediately.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Governing Law</h2>
                    <p class="text-gray-600 leading-relaxed">
                        These Terms shall be interpreted and governed by the laws of the Republic of Indonesia without regard to its conflict of law provisions. Any dispute arising from these Terms shall be resolved through amicable discussion or through the appropriate Indonesian courts.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Changes to Terms</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We reserve the right to modify these Terms at any time. If we make material changes, we will notify you by email or by posting a notice on our site prior to the effective date of the changes. Your continued use of the service after such modifications constitutes acceptance of the updated Terms.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Contact Information</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Questions about the Terms of Service should be sent to us at:
                    </p>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <p class="text-gray-700 mb-2"><strong>Email:</strong> legal@abhinaya.co.id</p>
                        <p class="text-gray-700 mb-2"><strong>Phone:</strong> +62 812-3456-7890</p>
                        <p class="text-gray-700"><strong>Address:</strong> Jl. Sudirman No. 123, Jakarta Selatan, DKI Jakarta 12190, Indonesia</p>
                    </div>
                </div>

                <div class="text-center text-gray-500 text-sm">
                    <p><strong>Last Updated:</strong> <?php echo date('F j, Y'); ?></p>
                </div>
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
                    Transforming visions into reality through innovation and excellence.
                </p>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="about.php" class="hover:text-white transition-colors">About</a></li>
                    <li><a href="team.php" class="hover:text-white transition-colors">Team</a></li>
                    <li><a href="contact.php" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="privacy.php" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="terms.php" class="hover:text-white transition-colors">Terms of Service</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li>info@abhinaya.co.id</li>
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
if(isset($conn)) { $conn->close(); } 
?>
