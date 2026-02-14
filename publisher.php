<?php include 'header.php'; ?>

<section class="hero" id="hero">
    <video class="hero-video" autoplay muted loop playsinline>
        <source src="assets/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero-overlay"></div>

    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title"><span class="hero-title-main">Abhinaya Publisher</span></h1>
            <p class="hero-subtitle">Academic Publishing, Journal Management, and Research Support</p>
            <p class="hero-description">
                Advancing academic excellence through professional publishing services. We provide comprehensive
                journal management, publication support, and research dissemination solutions for scholars worldwide.
            </p>
            <div class="hero-cta">
                <a href="#publisher-services" class="btn btn-primary">Explore Our Services</a>
                <a href="contact" class="btn btn-secondary">Submit Manuscript</a>
            </div>
        </div>
    </div>
</section>

<section class="unit-section publisher-page" id="publisher-services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Publisher Cards & Journal Listing</h2>
            <p class="section-subtitle">Komposisi card meniru referensi dengan proporsi 3 kolom dan variasi tinggi card jurnal.</p>
        </div>

        <div class="unit-grid-3">
            <article class="unit-card" style="background:linear-gradient(135deg,#faf5ff 0%,#eff6ff 100%);border-color:#ddd6fe;min-height:311px;">
                <h3>Scientific Journals</h3>
                <p>Pengelolaan jurnal ilmiah terstandar untuk berbagai bidang penelitian.</p>
            </article>
            <article class="unit-card" style="background:linear-gradient(135deg,#eff6ff 0%,#ecfeff 100%);border-color:#bfdbfe;min-height:311px;">
                <h3>Global Indexing</h3>
                <p>Dukungan indexing internasional, metadata, dan peningkatan visibilitas artikel.</p>
            </article>
            <article class="unit-card" style="background:linear-gradient(135deg,#fdf2f8 0%,#faf5ff 100%);border-color:#fbcfe8;min-height:311px;">
                <h3>International Collaboration</h3>
                <p>Kolaborasi akademik lintas institusi dan penguatan jejaring penelitian global.</p>
            </article>
        </div>

        <div class="package-grid">
            <article class="package-card" style="min-height:591px;">
                <h3>Basic Journal</h3>
                <p class="package-price">Rp 5 Juta / jurnal</p>
                <ul class="package-list">
                    <li>Instalasi OJS</li>
                    <li>Setup template jurnal</li>
                    <li>Pelatihan editor</li>
                    <li>Support teknis awal</li>
                </ul>
                <a href="contact" class="btn btn-secondary">Pilih Paket</a>
            </article>

            <article class="package-card highlight" style="min-height:620px;">
                <span class="badge-popular">Most Popular</span>
                <h3>Professional Journal</h3>
                <p class="package-price">Rp 8 Juta / website</p>
                <ul class="package-list">
                    <li>Setup OJS lengkap</li>
                    <li>Editorial workflow</li>
                    <li>Layout & publishing support</li>
                    <li>Optimasi indexing</li>
                </ul>
                <a href="contact" class="btn btn-primary">Pilih Paket</a>
            </article>

            <article class="package-card" style="min-height:591px;">
                <h3>Premium Publisher</h3>
                <p class="package-price">Custom / kontak kami</p>
                <ul class="package-list">
                    <li>Multi-journal management</li>
                    <li>Automasi proses editorial</li>
                    <li>Integrasi DOI & indexing</li>
                    <li>Tim support dedicated</li>
                </ul>
                <a href="contact" class="btn btn-secondary">Diskusi Kebutuhan</a>
            </article>
        </div>

        <div class="journal-grid">
            <article class="journal-card tall">
                <img src="assets/img/journal-covers/ijmst-cover.jpg" alt="IJMST" class="journal-thumb">
                <div class="journal-body">
                    <h3>Indonesian Journal of Modern Science and Technology</h3>
                    <p>ISSN tersedia • Peer-reviewed • Open Access</p>
                </div>
            </article>
            <article class="journal-card">
                <img src="assets/img/journal-covers/JGDS.png" alt="JSGDS" class="journal-thumb">
                <div class="journal-body">
                    <h3>Journal of Social Growth and Development Studies</h3>
                    <p>ISSN tersedia • Multidisiplin • Open Journal</p>
                </div>
            </article>
            <article class="journal-card">
                <img src="assets/img/journal-covers/CIVIC.png" alt="Civic Governance" class="journal-thumb">
                <div class="journal-body">
                    <h3>Civic Governance and Public Administration</h3>
                    <p>Coming Soon • Editorial board in progress</p>
                </div>
            </article>
            <article class="journal-card">
                <img src="assets/img/journal-covers/JPHN.png" alt="Public Health" class="journal-thumb">
                <div class="journal-body">
                    <h3>Journal of Public Health and Nursing</h3>
                    <p>Coming Soon • Fokus kesehatan dan keperawatan</p>
                </div>
            </article>
            <article class="journal-card">
                <img src="assets/img/journal-covers/JAMED.png" alt="Accounting" class="journal-thumb">
                <div class="journal-body">
                    <h3>Journal of Accounting, Management, and Economic Development</h3>
                    <p>Review berkala • Manajemen & ekonomi terapan</p>
                </div>
            </article>
            <article class="journal-card">
                <img src="assets/img/journal-covers/jurnal-pengabdian.png" alt="Pengabdian" class="journal-thumb">
                <div class="journal-body">
                    <h3>Jurnal Pengabdian : Abhinaya</h3>
                    <p>Coming Soon • Community service and impact studies</p>
                </div>
            </article>
            <article class="journal-card">
                <img src="assets/img/journal-covers/JDLLI.png" alt="JDLLI" class="journal-thumb">
                <div class="journal-body">
                    <h3>Journal of Digital Learning and Literacy Innovation</h3>
                    <p>Coming Soon • Education technology and literacy innovation</p>
                </div>
            </article>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
