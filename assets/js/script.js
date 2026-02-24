AOS.init({
    once: true,
    duration: 800,
    easing: 'ease-out-cubic',
    offset: 50
});

// Counter animation for achievements
const counters = document.querySelectorAll('.counter');
const speed = 200;

const animateCounters = () => {
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText.replace(/[^0-9]/g, '');
        const increment = target / speed;

        if (count < target) {
            counter.innerText = Math.ceil(count + increment) + counter.innerText.replace(/[0-9]/g, '');
            setTimeout(() => animateCounters(), 10);
        } else {
            counter.innerText = target + counter.innerText.replace(/[0-9]/g, '');
        }
    });
};

// Trigger counter animation when in viewport
const observerOptions = {
    threshold: 0.5
};

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounters();
            counterObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

counters.forEach(counter => {
    counterObserver.observe(counter);
});

// Navbar scroll effect
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }
});

// Mobile Menu functionality
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const closeMobileMenu = document.getElementById('closeMobileMenu');
const mobileMenu = document.getElementById('mobileMenu');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
}

if (closeMobileMenu && mobileMenu) {
    closeMobileMenu.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
}

// Mobile Accordion functionality
const accordionBtns = document.querySelectorAll('.mobile-accordion-btn');

accordionBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('svg');

        // Toggle current accordion
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');

        // Close other accordions
        accordionBtns.forEach(otherBtn => {
            if (otherBtn !== btn) {
                const otherContent = otherBtn.nextElementSibling;
                const otherIcon = otherBtn.querySelector('svg');
                otherContent.classList.add('hidden');
                otherIcon.classList.remove('rotate-180');
            }
        });
    });
});

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (mobileMenu && !mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
});

// Force video autoplay (safeguard for browsers that block it)
document.addEventListener("DOMContentLoaded", () => {
    const videos = document.querySelectorAll('video[autoplay]');
    videos.forEach(video => {
        // Ensure the video is muted, which is required for autoplay
        video.muted = true;

        let playPromise = video.play();

        if (playPromise !== undefined) {
            playPromise.catch(error => {
                console.log("Autoplay prevented or interrupted:", error);

                // Add a one-time event listener for the first user interaction
                // to trigger play if initial autoplay was blocked
                const playOnInteraction = () => {
                    video.play();
                    document.removeEventListener("touchstart", playOnInteraction);
                    document.removeEventListener("click", playOnInteraction);
                    document.removeEventListener("scroll", playOnInteraction);
                };

                document.addEventListener("touchstart", playOnInteraction, { once: true });
                document.addEventListener("click", playOnInteraction, { once: true });
                document.addEventListener("scroll", playOnInteraction, { once: true });
            });
        }
    });
});
