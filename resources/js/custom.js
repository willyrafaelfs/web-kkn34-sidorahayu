// File: custom.js
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. ANIMASI SCROLL (AOS Style) - Aman
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.card, .navbar, footer, h2');
        elements.forEach(element => {
            const position = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (position < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Set initial style
    document.querySelectorAll('.card, footer, h2').forEach(el => {
        el.style.transition = 'all 0.8s ease';
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
    });
    
    // Run on load
    animateOnScroll();
    
    // Run on scroll
    window.addEventListener('scroll', animateOnScroll);
    
    // 2. BACK TO TOP BUTTON - Aman (buat element baru di bawah footer)
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    backToTopBtn.className = 'btn back-to-top';
    backToTopBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2d6a4f, #d4af37);
        color: white;
        border: none;
        cursor: pointer;
        display: none;
        z-index: 9999;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    `;
    
    backToTopBtn.onmouseover = () => {
        backToTopBtn.style.transform = 'translateY(-5px)';
        backToTopBtn.style.boxShadow = '0 6px 20px rgba(212, 175, 55, 0.4)';
    };
    
    backToTopBtn.onmouseout = () => {
        backToTopBtn.style.transform = 'translateY(0)';
        backToTopBtn.style.boxShadow = '0 4px 15px rgba(0,0,0,0.2)';
    };
    
    document.body.appendChild(backToTopBtn);
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            backToTopBtn.style.display = 'block';
            backToTopBtn.style.animation = 'fadeIn 0.3s';
        } else {
            backToTopBtn.style.display = 'none';
        }
    });
    
    backToTopBtn.onclick = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
    
    // 3. HOVER EFFECT UNTUK CARD - Aman (hanya tambah efek)
    const cards = document.querySelectorAll('.card, .dropdown-menu');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.boxShadow = '0 20px 30px rgba(45, 106, 79, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 5px 20px rgba(45, 106, 79, 0.1)';
        });
    });
    
    // 4. NAVBAR SCROLL EFFECT - Aman (ubah class/style)
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 5px 30px rgba(45, 106, 79, 0.15)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 15px rgba(0,0,0,0.1)';
                navbar.style.backdropFilter = 'blur(5px)';
            }
        });
    }
    
    // 5. TYPEWRITER EFFECT UNTUK TAGLINE - Aman (text di footer)
    const footerText = document.querySelector('footer p.small');
    if (footerText && footerText.textContent.includes('Mengabdi dengan hati')) {
        // Simpan teks asli
        const originalText = footerText.textContent;
        
        // Bisa tambah efek sederhana
        setInterval(() => {
            footerText.style.opacity = '0.8';
            setTimeout(() => {
                footerText.style.opacity = '1';
            }, 100);
        }, 3000);
    }
    
    // 6. NOTIFICATION TOAST - Aman (buat element baru)
    function showNotification(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast-notification ${type}`;
        toast.innerHTML = `
            <i class="bi ${type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle'} me-2"></i>
            ${message}
        `;
        toast.style.cssText = `
            position: fixed;
            top: 100px;
            right: 30px;
            padding: 15px 25px;
            background: linear-gradient(135deg, #2d6a4f, #d4af37);
            color: white;
            border-radius: 50px;
            z-index: 10000;
            animation: slideInRight 0.3s, fadeOut 0.3s 2.7s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
    
    // 7. LOADING SPINNER - Aman (tambah di main)
    const mainContent = document.querySelector('main');
    if (mainContent) {
        const spinner = document.createElement('div');
        spinner.className = 'page-loader';
        spinner.innerHTML = '<div class="spinner"></div>';
        spinner.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s;
        `;
        
        const spinnerInner = spinner.querySelector('.spinner');
        spinnerInner.style.cssText = `
            width: 50px;
            height: 50px;
            border: 3px solid #d8f3dc;
            border-top-color: #2d6a4f;
            border-right-color: #d4af37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        `;
        
        document.body.appendChild(spinner);
        
        window.addEventListener('load', () => {
            spinner.style.opacity = '0';
            setTimeout(() => {
                spinner.remove();
            }, 500);
        });
    }
    
    // 8. COUNTER ANIMATION - Aman (tambah di elemen yang ada)
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / 100;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 10);
            } else {
                counter.innerText = target;
            }
        };
        
        // Trigger ketika elemen terlihat
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCount();
                    observer.unobserve(entry.target);
                }
            });
        });
        
        observer.observe(counter);
    });
    
    // 9. PARALLAX EFFECT - Aman (untuk background)
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const hero = document.querySelector('.hero-section');
        if (hero) {
            hero.style.backgroundPositionY = `${scrolled * 0.5}px`;
        }
    });
    
    // 10. DARK MODE TOGGLE - Aman (opsional)
    const darkModeToggle = document.createElement('button');
    darkModeToggle.className = 'btn btn-sm position-fixed';
    darkModeToggle.innerHTML = '<i class="bi bi-moon"></i>';
    darkModeToggle.style.cssText = `
        bottom: 100px;
        right: 30px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #2d3e2f;
        color: white;
        border: none;
        z-index: 9999;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    `;
    
    darkModeToggle.onclick = () => {
        document.body.classList.toggle('dark-mode');
        if (document.body.classList.contains('dark-mode')) {
            darkModeToggle.innerHTML = '<i class="bi bi-sun"></i>';
            // Tambah style dark mode
        } else {
            darkModeToggle.innerHTML = '<i class="bi bi-moon"></i>';
        }
    };
    
    document.body.appendChild(darkModeToggle);
    
    // 11. IMAGE LAZY LOAD - Aman (tambah attribute)
    const images = document.querySelectorAll('img[src]');
    images.forEach(img => {
        if (!img.hasAttribute('loading')) {
            img.setAttribute('loading', 'lazy');
        }
    });
    
    // 12. TOOLTIP INIT - Bootstrap native
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // 13. POPOVER INIT - Bootstrap native
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // 14. SMOOTH SCROLL UNTUK ANCHOR LINKS
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // 15. COPYRIGHT YEAR AUTO UPDATE
    const yearElement = document.querySelector('footer small:contains("2026")');
    if (yearElement) {
        yearElement.innerHTML = yearElement.innerHTML.replace('2026', new Date().getFullYear());
    }
    
});

// Add keyframe animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in {
        animation: fadeIn 0.8s ease;
    }
`;

document.head.appendChild(style);