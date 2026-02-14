<?php include 'header.php'; ?>

<section class="hero" id="hero">
    <video class="hero-video" autoplay muted loop playsinline>
        <source src="assets/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title"><span class="hero-title-main">Abhinaya Techno</span></h1>
            <p class="hero-subtitle">IT Solutions, Software Development, and System Integration</p>
            <p class="hero-description">
                Empowering businesses with cutting-edge technology solutions. We specialize in custom software
                development, system integration, and innovative IT solutions that drive digital transformation.
            </p>
            <div class="hero-cta">
                <a href="#techno-services" class="btn btn-primary">Explore Our Services</a>
                <a href="contact" class="btn btn-secondary">Get a Quote</a>
            </div>
        </div>
    </div>
</section>

<section class="unit-section" id="techno-services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Layanan Inti</h2>
            <p class="section-subtitle">Struktur card mengikuti proporsi halaman referensi: 3 card besar per baris, rounded 16px.</p>
        </div>

        <div class="unit-grid-3">
            <article class="unit-card">
                <h3>Web & Mobile Development</h3>
                <p>Custom web application, landing page, dan aplikasi mobile sesuai kebutuhan bisnis.</p>
            </article>
            <article class="unit-card" style="background:linear-gradient(135deg,#ecfeff 0%,#ecfdf5 100%);border-color:#bbf7d0;">
                <h3>Business Management Systems</h3>
                <p>ERP mini, sistem operasional, dashboard monitoring, dan otomasi proses internal.</p>
            </article>
            <article class="unit-card" style="background:linear-gradient(135deg,#faf5ff 0%,#fdf2f8 100%);border-color:#e9d5ff;">
                <h3>AI-Powered Solutions</h3>
                <p>Integrasi AI untuk analitik, rekomendasi, chatbot, dan peningkatan efisiensi tim.</p>
            </article>
        </div>

        <div class="package-grid">
            <article class="package-card">
                <h3>Basic Digital</h3>
                <p class="package-price">Rp 3,5 Juta / project</p>
                <ul class="package-list">
                    <li>Company profile website</li>
                    <li>Responsive design</li>
                    <li>CMS sederhana</li>
                    <li>1 bulan maintenance</li>
                </ul>
                <a href="contact" class="btn btn-secondary">Pilih Paket</a>
            </article>

            <article class="package-card highlight">
                <span class="badge-popular">Most Popular</span>
                <h3>Professional Digital</h3>
                <p class="package-price">Rp 5 Juta / project</p>
                <ul class="package-list">
                    <li>Website / sistem informasi</li>
                    <li>Integrasi API</li>
                    <li>Dashboard admin</li>
                    <li>Support prioritas</li>
                </ul>
                <a href="contact" class="btn btn-primary">Pilih Paket</a>
            </article>

            <article class="package-card">
                <h3>Enterprise Solution</h3>
                <p class="package-price">Custom / kontak kami</p>
                <ul class="package-list">
                    <li>Sistem skala enterprise</li>
                    <li>Arsitektur cloud</li>
                    <li>Integrasi multi-platform</li>
                    <li>SLA support dedicated</li>
                </ul>
                <a href="contact" class="btn btn-secondary">Diskusi Kebutuhan</a>
            </article>
        </div>

        <div class="portfolio-grid">
            <article class="portfolio-card">
                <img src="assets/img/abhinaya-techno/sipeta.png" alt="Sipeta" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Tourism Platform - Sipeta Lombok Utara</h3>
                    <p>Platform pariwisata terpadu dengan informasi destinasi, agenda wisata, dan promosi digital.</p>
                </div>
            </article>
            <article class="portfolio-card">
                <img src="assets/img/abhinaya-techno/tiuloka.png" alt="Tiuloka" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Travel Platform - Tiuloka Lombok Holiday</h3>
                    <p>Portal paket perjalanan, pemesanan layanan, dan manajemen itinerary wisata.</p>
                </div>
            </article>
            <article class="portfolio-card">
                <img src="assets/img/abhinaya-techno/kammi.png" alt="Kammipusat" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Business Platform - Kammipusat</h3>
                    <p>Platform manajemen bisnis untuk operasional, monitoring performa, dan laporan berkala.</p>
                </div>
            </article>
            <article class="portfolio-card">
                <img src="assets/img/abhinaya-techno/satuHukum.png" alt="Satu Hukum" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Legal Platform - Satu Hukum Indonesia</h3>
                    <p>Portal informasi hukum dan layanan publik digital dengan navigasi kategori yang jelas.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
