// Initialize AOS
AOS.init({ 
    once: true, 
    duration: 600, 
    easing: 'ease-out-sine', 
    offset: 100 
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
