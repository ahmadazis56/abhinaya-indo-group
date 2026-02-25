<?php
require_once 'config/database.php';

// Handle form submission
$form_submitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    // $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Basic validation
    if (!empty($name) && !empty($message)) {
        // Route to WhatsApp
        $wa_number = "6285646603602";
        $wa_text = urlencode("Halo, nama saya $name. Saya ingin menanyakan tentang *$subject*.\n\nPesan:\n$message");
        header("Location: https://api.whatsapp.com/send?phone=$wa_number&text=$wa_text");
        exit();
    } else {
        $error_message = "Please fill in all required fields.";
        $form_submitted = true;
    }
}

$pageTitle = "Contact Us - Abhinaya Indo Group";
$pageDesc = "Get in touch with Abhinaya Indo Group. Contact us for IT solutions, creative services, and scientific publishing inquiries.";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative w-full py-24 md:py-32 bg-slate-900 overflow-hidden text-center min-h-[50vh] flex items-center justify-center">
    <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-primary-900/50 to-transparent z-0 opacity-20"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiMwZjk0ODgiIGZpbGwtb3BhY2l0eT0iMC4wNSIvPjwvc3ZnPg==')] z-0 hidden"></div>
    
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-heading font-extrabold mb-6 leading-tight text-white tracking-tight">
            Contact <span class="text-primary-400">Us</span>
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl mx-auto font-medium">
            We'd love to hear from you. Let's discuss how we can help transform your vision into reality.
        </p>
    </div>
</section>

<!-- Contact Form & Info -->
<section class="py-24 bg-white relative -mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="bg-white rounded-3xl shadow-soft border border-secondary-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-5">
                <!-- Info Panel -->
                <div class="lg:col-span-2 bg-secondary-900 p-10 text-white flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-2xl font-heading font-bold mb-2">Get In Touch</h3>
                        <p class="text-secondary-400 font-light mb-10">Fill out the form and our team will get back to you within 24 hours.</p>
                        
                        <div class="space-y-8">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-primary-400 mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <div class="ml-4">
                                    <h4 class="text-sm font-semibold mb-1 text-secondary-200">Email</h4>
                                    <a href="mailto:info@abhinaya.co.id" class="text-white hover:text-primary-300 transition-colors">info@abhinaya.co.id</a>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-primary-400 mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13 2.257a1 1 0 001.21.502l4.493 1.498a1 1 0 00.684-.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <div class="ml-4">
                                    <h4 class="text-sm font-semibold mb-1 text-secondary-200">Phone</h4>
                                    <p class="text-white"><a href="https://wa.me/6285646603602" target="_blank" class="hover:text-primary-300 transition-colors">+62 8564-6603-602</a></p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-primary-400 mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <div class="ml-4 w-full pr-4">
                                    <h4 class="text-sm font-semibold mb-3 text-secondary-200">Operational Location</h4>
                                    <div class="rounded-xl overflow-hidden w-full aspect-video border border-white/10 relative z-20">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3944.8185984283073!2d116.0739846!3d-8.613408!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbff0abf65451%3A0xd3a22200333d2b6c!2sGOR%20TENIS%20MEJA%20BINTANG%20LOMBOK!5e0!3m2!1sid!2sid!4v1771648116696!5m2!1sid!2sid" class="absolute inset-0 w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Panel -->
                <div class="lg:col-span-3 p-10 lg:p-14 bg-white">
                    <?php if ($form_submitted): ?>
                        <?php if (isset($success_message)): ?>
                            <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <?php echo htmlspecialchars($success_message); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($error_message)): ?>
                            <div class="mb-8 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?php echo htmlspecialchars($error_message); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <form method="POST" action="contact.php" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-secondary-700 mb-2">Full Name</label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-secondary-50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" placeholder="Jane Doe">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-secondary-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-secondary-50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all outline-none" placeholder="jane@example.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-secondary-700 mb-2">Inquiry Type</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 bg-secondary-50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all outline-none appearance-none">
                                <option value="">Select a topic</option>
                                <option value="techno">Technology Solutions (Techno)</option>
                                <option value="creative">Design & Branding (Creative)</option>
                                <option value="publisher">Publishing (Publisher)</option>
                                <option value="general">General Inquiry</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-secondary-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 bg-secondary-50 border border-secondary-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all outline-none resize-none" placeholder="Tell us about your project..."></textarea>
                        </div>
                        
                        <div class="pt-2">
                            <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary-600">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
