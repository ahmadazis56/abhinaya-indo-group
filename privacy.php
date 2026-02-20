<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Abhinaya Indo Group</title>
    <meta name="description" content="Privacy Policy of Abhinaya Indo Group. Learn how we collect, use, and protect your personal information.">
    
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
                Privacy Policy
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">
                Your privacy is important to us. Learn how we collect, use, and protect your information.
            </p>
        </div>
    </div>
</section>

<!-- Privacy Content -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="prose prose-lg max-w-none" data-aos="fade-up">
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Introduction</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        At Abhinaya Indo Group, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        By using our website and services, you agree to the collection and use of information in accordance with this policy.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Information We Collect</h2>
                    
                    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Personal Information</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        We may collect personally identifiable information, including but not limited to:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2 mb-6">
                        <li>Name and contact information (email, phone number)</li>
                        <li>Company information and job title</li>
                        <li>Communication history and preferences</li>
                        <li>Account credentials (when applicable)</li>
                    </ul>

                    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Technical Information</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        We automatically collect certain technical information when you visit our website:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>IP address and browser type</li>
                        <li>Device information and operating system</li>
                        <li>Pages visited and time spent on our site</li>
                        <li>Referring website addresses</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">How We Use Your Information</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        We use the information we collect for various purposes, including:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Providing and improving our services</li>
                        <li>Responding to your inquiries and requests</li>
                        <li>Sending you marketing communications (with your consent)</li>
                        <li>Analyzing website usage to enhance user experience</li>
                        <li>Ensuring security and preventing fraud</li>
                        <li>Complying with legal obligations</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Information Sharing</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>To trusted service providers who assist us in operating our website</li>
                        <li>When required by law or to protect our rights</li>
                        <li>To business partners with your explicit consent</li>
                        <li>In connection with a business transaction (merger, acquisition, etc.)</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Data Security</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These include SSL encryption, secure servers, and regular security reviews.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Your Rights</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        You have the right to:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Access and update your personal information</li>
                        <li>Request deletion of your data (where applicable)</li>
                        <li>Opt-out of marketing communications</li>
                        <li>Object to processing of your information</li>
                        <li>Request data portability</li>
                    </ul>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Cookies and Tracking</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Our website uses cookies and similar tracking technologies to enhance your experience. You can control cookie settings through your browser preferences.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Changes to This Policy</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date.
                    </p>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Contact Us</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        If you have any questions about this Privacy Policy or our data practices, please contact us:
                    </p>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <p class="text-gray-700 mb-2"><strong>Email:</strong> privacy@abhinaya.co.id</p>
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
