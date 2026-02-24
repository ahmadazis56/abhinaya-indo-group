<?php
require_once 'config/database.php';

$pageTitle = "About Us - Abhinaya Indo Group";
$pageDesc = "Learn about Abhinaya Indo Group - our mission, vision, and commitment to excellence in IT solutions, creative services, and scientific publishing.";
include 'includes/header.php';
?>

<!-- Hero Section - Clean Hostinger Style -->
<section class="relative w-full py-24 md:py-32 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-primary-600 blur-3xl mix-blend-screen opacity-30"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up" data-aos-duration="1000">
        <div class="inline-flex items-center px-4 py-2 bg-slate-800/50 rounded-full border border-slate-700 backdrop-blur-md mb-8">
            <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
            <span class="text-sm font-bold text-slate-300 uppercase tracking-widest">Our Story</span>
        </div>
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-8 leading-[1.1] tracking-tight text-white">
            Pioneering digital <br/>
            <span class="text-primary-400">excellence.</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-400 max-w-3xl mx-auto leading-relaxed font-medium">
            We are a collective of engineers, designers, and innovators dedicated to transforming the way businesses operate and grow in the modern digital age.
        </p>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-24 bg-white border-b border-gray-100 relative">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
            
            <!-- Mission -->
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 bg-primary-50 rounded-[1.25rem] flex items-center justify-center text-primary-600 mb-8 border border-primary-100 shadow-sm">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-heading font-black text-slate-900 mb-6">Our Mission</h2>
                <p class="text-slate-500 leading-relaxed font-medium text-lg">
                    To deliver innovative technology solutions, creative excellence, and scientific publishing services that empower businesses and institutions to achieve their full potential. We are committed to pushing boundaries, fostering creativity, and maintaining the highest standards of quality.
                </p>
            </div>
            
            <!-- Vision -->
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 bg-blue-50 rounded-[1.25rem] flex items-center justify-center text-blue-600 mb-8 border border-blue-100 shadow-sm">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-heading font-black text-slate-900 mb-6">Our Vision</h2>
                <p class="text-slate-500 leading-relaxed font-medium text-lg">
                    To be the leading integrated solutions provider globally, recognized for our technological innovation, creative excellence, and contributions to scientific advancement. We envision a future where technology, creativity, and knowledge converge seamlessly.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Values - Hostinger Cards -->
<section class="py-24 bg-gray-50 border-b border-gray-100">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-heading font-black text-slate-900 mb-4">Core Principles</h2>
            <p class="text-lg text-slate-600 font-medium">The foundational values that drive our work, culture, and partnerships.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <span class="font-black text-xl">1</span>
                </div>
                <h3 class="text-xl font-heading font-black text-slate-900 mb-3">Excellence</h3>
                <p class="text-slate-500 font-medium leading-relaxed">We strive for the absolute highest standards in quality and service delivery across all divisions.</p>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <span class="font-black text-xl">2</span>
                </div>
                <h3 class="text-xl font-heading font-black text-slate-900 mb-3">Innovation</h3>
                <p class="text-slate-500 font-medium leading-relaxed">We embrace creativity and build cutting-edge solutions to solve complex modern problems.</p>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <span class="font-black text-xl">3</span>
                </div>
                <h3 class="text-xl font-heading font-black text-slate-900 mb-3">Integrity</h3>
                <p class="text-slate-500 font-medium leading-relaxed">We operate with honesty, complete transparency, and uncompromising ethical principles.</p>
            </div>
            
            <!-- Card 4 -->
            <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-hostinger hover:-translate-y-2 hover:shadow-hostinger-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <span class="font-black text-xl">4</span>
                </div>
                <h3 class="text-xl font-heading font-black text-slate-900 mb-3">Collaboration</h3>
                <p class="text-slate-500 font-medium leading-relaxed">We believe in the power of dedicated teamwork and building enduring, successful client partnerships.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
