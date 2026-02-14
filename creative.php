<?php include 'header.php'; ?>

<section class="hero" id="hero">
    <video class="hero-video" autoplay muted loop playsinline>
        <source src="assets/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title"><span class="hero-title-main">Abhinaya Creative</span></h1>
            <p class="hero-subtitle">Digital Branding, Content Creation, and Social Media Management</p>
            <p class="hero-description">
                Transform your brand identity with our creative expertise. We craft compelling visual stories,
                engaging content, and strategic digital campaigns that resonate with your audience.
            </p>
            <div class="hero-cta">
                <a href="#creative-services" class="btn btn-primary">Explore Our Services</a>
                <a href="contact" class="btn btn-secondary">Start Your Project</a>
            </div>
        </div>
    </div>
</section>

<section class="unit-section creative-page" id="creative-services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Creative Service Cards</h2>
            <p class="section-subtitle">Disusun meniru layout referensi: 3 cards overview, 3 pricing cards, dan portfolio cards tinggi.</p>
        </div>

        <div class="unit-grid-3">
            <article class="unit-card" style="background:linear-gradient(135deg,#faf5ff 0%,#fdf2f8 100%);border-color:#fbcfe8;">
                <h3>Branding & Identity</h3>
                <p>Pembuatan identitas visual, guideline brand, logo, dan key visual campaign.</p>
            </article>
            <article class="unit-card" style="background:linear-gradient(135deg,#eff6ff 0%,#ecfeff 100%);border-color:#bfdbfe;">
                <h3>Digital Marketing</h3>
                <p>Strategi distribusi konten dan performa campaign untuk peningkatan engagement.</p>
            </article>
            <article class="unit-card" style="background:linear-gradient(135deg,#f0fdf4 0%,#ecfdf5 100%);border-color:#bbf7d0;">
                <h3>Content Creation</h3>
                <p>Produksi konten foto, video, copywriting, dan desain feed untuk berbagai kanal.</p>
            </article>
        </div>

        <div class="package-grid">
            <article class="package-card" style="min-height:785px;">
                <h3>Starter Creative</h3>
                <p class="package-price">Rp 2,5 Juta / bulan</p>
                <ul class="package-list">
                    <li>12 desain feed / bulan</li>
                    <li>Copywriting basic</li>
                    <li>Scheduling content</li>
                    <li>Laporan bulanan</li>
                </ul>
                <a href="contact" class="btn btn-secondary">Pilih Paket</a>
            </article>

            <article class="package-card highlight" style="min-height:824px;">
                <span class="badge-popular">Most Popular</span>
                <h3>Growth Creative</h3>
                <p class="package-price">Rp 4,5 Juta / bulan</p>
                <ul class="package-list">
                    <li>20 desain feed / bulan</li>
                    <li>6 video reels / bulan</li>
                    <li>Campaign planning</li>
                    <li>Optimasi engagement</li>
                </ul>
                <a href="contact" class="btn btn-primary">Pilih Paket</a>
            </article>

            <article class="package-card" style="min-height:785px;">
                <h3>Premium Creative</h3>
                <p class="package-price">Custom / kontak kami</p>
                <ul class="package-list">
                    <li>Konten multi-channel</li>
                    <li>Creative direction</li>
                    <li>Produksi campaign besar</li>
                    <li>Tim dedicated</li>
                </ul>
                <a href="contact" class="btn btn-secondary">Diskusi Kebutuhan</a>
            </article>
        </div>

        <div class="portfolio-grid">
            <article class="portfolio-card">
                <img src="assets/img/creative/astra.png" alt="Astra Brand Project" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Brand Identity - Astra Brand Project</h3>
                    <p>Konsep identitas visual lengkap untuk konsistensi komunikasi brand di digital.</p>
                </div>
            </article>
            <article class="portfolio-card">
                <img src="assets/img/creative/desain-poster.png" alt="Poster Campaign" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Graphic Design - Desain Poster Campaign</h3>
                    <p>Desain materi promosi untuk campaign event dan activation dengan visual kuat.</p>
                </div>
            </article>
            <article class="portfolio-card">
                <img src="assets/img/creative/event-documentation.png" alt="Event Documentation" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Photography - Event Documentation</h3>
                    <p>Dokumentasi profesional untuk event, konferensi, dan aktivitas promosi brand.</p>
                </div>
            </article>
            <article class="portfolio-card">
                <img src="assets/img/creative/feeds-folio.png" alt="Social Media Feeds" class="portfolio-thumb">
                <div class="portfolio-body">
                    <h3>Content Creation - Social Media Feeds</h3>
                    <p>Kurasi dan desain konten feed social media yang fokus pada storytelling brand.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
