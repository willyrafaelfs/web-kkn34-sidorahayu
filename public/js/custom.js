// ===== FILE: custom.js =====
// JavaScript Interaktif untuk Website KKN Kelompok 34
// Tema: Hijau Alam & Emas

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== 1. LOADING SPINNER =====
    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner';
    spinner.innerHTML = '<div class="spinner"></div>';
    document.body.appendChild(spinner);
    
    window.addEventListener('load', function() {
        setTimeout(function() {
            spinner.style.opacity = '0';
            setTimeout(function() {
                spinner.remove();
            }, 500);
        }, 500);
    });
    
    // ===== 2. NAVBAR SCROLL EFFECT =====
    const navbar = document.querySelector('.navbar');
    const navbarBrand = document.querySelector('.navbar-brand');
    
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 10px 40px rgba(46, 125, 94, 0.15)';
                navbar.style.backdropFilter = 'blur(15px)';
                navbar.style.padding = '0.5rem 0';
                
                if (navbarBrand) {
                    navbarBrand.style.transform = 'scale(0.95)';
                }
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 5px 30px rgba(0,0,0,0.1)';
                navbar.style.backdropFilter = 'blur(10px)';
                navbar.style.padding = '1rem 0';
                
                if (navbarBrand) {
                    navbarBrand.style.transform = 'scale(1)';
                }
            }
        });
    }
    
    // ===== 3. SMOOTH SCROLL UNTUK ANCHOR LINKS =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Update URL tanpa reload
                history.pushState(null, null, targetId);
            }
        });
    });
    
    // ===== 4. ANIMASI SCROLL (FADE IN UP) =====
    const animateElements = document.querySelectorAll(
        '.card, h2, #tim .col-lg-3, .row .col-md-4, .ratio, #kontak .col-md-6'
    );
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Set initial style
    animateElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(40px)';
        el.style.transition = 'all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1)';
        observer.observe(el);
    });
    
    // ===== 5. BACK TO TOP BUTTON =====
    const backToTop = document.createElement('button');
    backToTop.innerHTML = '<i class="bi bi-arrow-up"></i>';
    backToTop.className = 'btn back-to-top';
    backToTop.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2e7d5e, #d4af37);
        color: white;
        border: none;
        cursor: pointer;
        display: none;
        z-index: 9999;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        transition: all 0.3s;
        font-size: 1.5rem;
        padding: 0;
        line-height: 1;
    `;
    
    // Hover effect
    backToTop.onmouseenter = function() {
        this.style.transform = 'translateY(-5px) scale(1.1)';
        this.style.boxShadow = '0 15px 40px rgba(212, 175, 55, 0.4)';
    };
    
    backToTop.onmouseleave = function() {
        this.style.transform = 'translateY(0) scale(1)';
        this.style.boxShadow = '0 5px 25px rgba(0,0,0,0.2)';
    };
    
    document.body.appendChild(backToTop);
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 500) {
            backToTop.style.display = 'block';
            backToTop.style.animation = 'fadeInUp 0.5s';
        } else {
            backToTop.style.display = 'none';
        }
    });
    
    backToTop.onclick = function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    };
    
    // ===== 6. HOVER EFFECT UNTUK CARD =====
    const cards = document.querySelectorAll('.card:not(.hover-card)');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 20px 40px rgba(46, 125, 94, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'var(--shadow-sm)';
        });
    });
    
    // ===== 7. GALERI LIGHTBOX EFFECT =====
    const galleryItems = document.querySelectorAll('.ratio');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const media = this.querySelector('img, video, iframe');
            
            if (!media) return;
            
            let content = '';
            
            if (media.tagName === 'IMG') {
                content = `<img src="${media.src}" class="img-fluid" style="max-height: 80vh;">`;
            } else if (media.tagName === 'VIDEO') {
                content = `<video src="${media.src}" controls class="w-100" style="max-height: 80vh;"></video>`;
            } else if (media.tagName === 'IFRAME') {
                content = `<iframe src="${media.src}" class="w-100" style="height: 80vh;" allowfullscreen></iframe>`;
            }
            
            // Buat modal sederhana
            const modal = document.createElement('div');
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.95);
                z-index: 99999;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                animation: fadeIn 0.3s;
            `;
            
            modal.innerHTML = `
                <div class="position-relative" style="max-width: 90%; max-height: 90%;">
                    ${content}
                    <button class="btn-close btn-close-white position-absolute top-0 end-0 m-3" style="font-size: 2rem;"></button>
                </div>
            `;
            
            modal.onclick = function(e) {
                if (e.target === modal || e.target.classList.contains('btn-close-white')) {
                    modal.style.opacity = '0';
                    setTimeout(() => modal.remove(), 300);
                }
            };
            
            document.body.appendChild(modal);
        });
    });
    
    // ===== 8. COUNTER ANIMATION UNTUK STATISTIK =====
    // (Jika ada elemen dengan class .counter, jalankan counter)
    const counters = document.querySelectorAll('.counter');
    
    if (counters.length > 0) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target') || counter.innerText);
                    let count = 0;
                    const increment = target / 100;
                    
                    const updateCounter = () => {
                        if (count < target) {
                            count += increment;
                            counter.innerText = Math.ceil(count);
                            setTimeout(updateCounter, 10);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    
                    updateCounter();
                    counterObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => counterObserver.observe(counter));
    }
    
    // ===== 9. AUTO HIDE ALERT AFTER 5 SECONDS =====
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'all 0.5s';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
    
    // ===== 10. PARALLAX EFFECT UNTUK HERO =====
    const heroSection = document.querySelector('#heroCarousel');
    
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrolled = window.scrollY;
            const heroItems = heroSection.querySelectorAll('.carousel-item');
            
            heroItems.forEach(item => {
                const img = item.querySelector('img, video');
                if (img) {
                    const speed = 0.5;
                    img.style.transform = `translateY(${scrolled * speed}px)`;
                }
            });
        });
    }
    
    // ===== 11. TOOLTIP INITIALIZATION =====
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // ===== 12. POPOVER INITIALIZATION =====
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // ===== 13. VALIDASI FORM KONTAK =====
    const contactForm = document.querySelector('#kontak form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const name = this.querySelector('input[name="name"]');
            const email = this.querySelector('input[name="email"]');
            const message = this.querySelector('textarea[name="message"]');
            
            let isValid = true;
            
            // Simple validation
            if (name.value.trim() === '') {
                highlightError(name);
                isValid = false;
            }
            
            if (email.value.trim() === '' || !email.value.includes('@')) {
                highlightError(email);
                isValid = false;
            }
            
            if (message.value.trim() === '') {
                highlightError(message);
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                
                // Show error notification
                showNotification('Harap isi semua field dengan benar', 'error');
            }
        });
    }
    
    function highlightError(element) {
        element.style.borderColor = '#dc3545';
        element.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.25)';
        
        element.addEventListener('input', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        }, { once: true });
    }
    
    // ===== 14. NOTIFICATION SYSTEM =====
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'} me-2" style="font-size: 1.2rem;"></i>
                <span>${message}</span>
            </div>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 30px;
            padding: 15px 25px;
            background: ${type === 'success' ? 'linear-gradient(135deg, #2e7d5e, #d4af37)' : 'linear-gradient(135deg, #dc3545, #ff6b6b)'};
            color: white;
            border-radius: 50px;
            z-index: 10000;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            animation: slideInRight 0.5s;
            font-weight: 500;
            min-width: 300px;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'fadeOutRight 0.5s';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
    
    // ===== 15. ADD KEYFRAME ANIMATIONS =====
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
        
        @keyframes fadeOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    `;
    
    document.head.appendChild(style);
    
    // ===== 16. INTERAKTIF VIDEO CONTROL =====
    const videos = document.querySelectorAll('video');
    videos.forEach(video => {
        video.addEventListener('mouseenter', () => video.play());
        video.addEventListener('mouseleave', () => video.pause());
    });
    
    // ===== 17. DYNAMIC COPYRIGHT YEAR =====
    const yearElement = document.querySelector('footer small:first-child');
    if (yearElement && yearElement.textContent.includes('2026')) {
        yearElement.textContent = yearElement.textContent.replace('2026', new Date().getFullYear());
    }
    
    // ===== 18. LAZY LOADING FOR IMAGES =====
    const images = document.querySelectorAll('img:not([loading])');
    images.forEach(img => {
        img.setAttribute('loading', 'lazy');
    });
    
    // ===== 19. AUTO PLAY/PAUSE CAROUSEL ON HOVER =====
    const carousel = document.querySelector('#heroCarousel');
    if (carousel) {
        const bootstrapCarousel = bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel, {
            interval: 5000,
            ride: 'carousel'
        });
        
        carousel.addEventListener('mouseenter', () => {
            bootstrapCarousel.pause();
        });
        
        carousel.addEventListener('mouseleave', () => {
            bootstrapCarousel.cycle();
        });
    }
    
    // ===== 20. TRUNCATE TEXT FOR BETTER DISPLAY =====
    const cardTitles = document.querySelectorAll('.card-title');
    cardTitles.forEach(title => {
        if (title.scrollWidth > title.clientWidth) {
            title.setAttribute('title', title.textContent);
        }
    });
    
    console.log('✨ KKN 34 Sidorahayu - Custom JS Loaded with Nature & Gold Theme');
});

// ===== GUESTBOOK PAGE JAVASCRIPT =====
// Tambahkan ini di dalam document.addEventListener('DOMContentLoaded', function() { ... });

// ===== 20. GUESTBOOK FORM VALIDATION & ANIMATION =====
const guestbookForm = document.querySelector('form[action="{{ route("messages.store") }}"]');

if (guestbookForm) {
    
    // ===== 20.1 Form Submit with Loading State =====
    guestbookForm.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const name = this.querySelector('input[name="name"]');
        const email = this.querySelector('input[name="email"]');
        const message = this.querySelector('textarea[name="message"]');
        
        let isValid = true;
        
        // Remove existing error messages
        removeErrorMessages();
        
        // Validate Name
        if (name.value.trim() === '') {
            showFieldError(name, 'Nama lengkap harus diisi');
            isValid = false;
        } else if (name.value.trim().length < 3) {
            showFieldError(name, 'Nama minimal 3 karakter');
            isValid = false;
        }
        
        // Validate Email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === '') {
            showFieldError(email, 'Email harus diisi');
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            showFieldError(email, 'Format email tidak valid');
            isValid = false;
        }
        
        // Validate Message
        if (message.value.trim() === '') {
            showFieldError(message, 'Pesan harus diisi');
            isValid = false;
        } else if (message.value.trim().length < 10) {
            showFieldError(message, 'Pesan minimal 10 karakter');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            
            // Scroll to first error
            const firstError = document.querySelector('.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            showNotification('Harap periksa kembali form Anda', 'error');
        } else {
            // Add loading state
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = 'Mengirim... <i class="bi bi-send ms-2"></i>';
        }
    });
    
    // ===== 20.2 Real-time Validation =====
    const inputs = guestbookForm.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove error class on input
            this.classList.remove('error');
            
            // Remove error message if exists
            const nextElement = this.nextElementSibling;
            if (nextElement && nextElement.classList.contains('error-message')) {
                nextElement.remove();
            }
            
            // Add success style if valid
            if (this.value.trim() !== '') {
                this.style.borderColor = 'var(--nature-green)';
            } else {
                this.style.borderColor = '';
            }
        });
        
        // Validate on blur
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '';
            }
        });
    });
    
    // ===== 20.3 Helper Functions =====
    function showFieldError(field, message) {
        field.classList.add('error');
        
        // Check if error message already exists
        let errorMsg = field.nextElementSibling;
        if (!errorMsg || !errorMsg.classList.contains('error-message')) {
            errorMsg = document.createElement('div');
            errorMsg.className = 'error-message';
            field.parentNode.insertBefore(errorMsg, field.nextSibling);
        }
        
        errorMsg.innerHTML = `<i class="bi bi-exclamation-triangle-fill me-1"></i>${message}`;
        errorMsg.style.animation = 'slideInDown 0.3s';
        
        // Add shake animation to field
        field.style.animation = 'shake 0.5s';
        setTimeout(() => {
            field.style.animation = '';
        }, 500);
    }
    
    function removeErrorMessages() {
        document.querySelectorAll('.error').forEach(el => {
            el.classList.remove('error');
            el.style.borderColor = '';
        });
        
        document.querySelectorAll('.error-message').forEach(el => el.remove());
    }
}

// ===== 21. SHAKE ANIMATION =====
const styleSheet = document.createElement('style');
styleSheet.textContent += `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
`;
document.head.appendChild(styleSheet);

// ===== 22. AUTO DISMISS ALERT =====
const successAlert = document.querySelector('.alert-success');
if (successAlert) {
    setTimeout(() => {
        successAlert.style.transition = 'all 0.5s';
        successAlert.style.opacity = '0';
        successAlert.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            if (successAlert.parentNode) {
                successAlert.remove();
            }
        }, 500);
    }, 5000);
}

// ===== 23. FORM FLOATING LABEL FIX =====
const floatingInputs = document.querySelectorAll('.form-floating input, .form-floating textarea');
floatingInputs.forEach(input => {
    // Check if input has value on page load
    if (input.value.trim() !== '') {
        input.classList.add('filled');
    }
    
    input.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            this.classList.add('filled');
        } else {
            this.classList.remove('filled');
        }
    });
});

// ===== 24. CHARACTER COUNTER FOR TEXTAREA =====
const messageTextarea = document.querySelector('textarea[name="message"]');
if (messageTextarea) {
    // Create counter element
    const counterDiv = document.createElement('div');
    counterDiv.className = 'text-muted text-end small mt-1';
    counterDiv.style.fontSize = '0.8rem';
    counterDiv.innerHTML = `<span class="current-count">0</span>/500 karakter`;
    messageTextarea.parentNode.appendChild(counterDiv);
    
    const currentCount = counterDiv.querySelector('.current-count');
    
    messageTextarea.addEventListener('input', function() {
        const length = this.value.length;
        currentCount.textContent = length;
        
        // Change color when approaching limit
        if (length > 450) {
            counterDiv.style.color = '#dc3545';
            counterDiv.style.fontWeight = 'bold';
        } else if (length > 400) {
            counterDiv.style.color = '#ffc107';
        } else {
            counterDiv.style.color = '#6c757d';
            counterDiv.style.fontWeight = 'normal';
        }
        
        // Prevent exceeding 500 characters
        if (length > 500) {
            this.value = this.value.substring(0, 500);
            currentCount.textContent = 500;
        }
    });
}

// ===== 25. EMAIL FORMAT SUGGESTION =====
const emailInput = document.querySelector('input[name="email"]');
if (emailInput) {
    emailInput.addEventListener('blur', function() {
        const email = this.value.trim();
        if (email && !email.includes('@')) {
            // Suggest common email domains
            showNotification('Email harus mengandung @', 'error');
        } else if (email && email.split('@').length > 2) {
            showNotification('Email hanya boleh mengandung satu @', 'error');
        }
    });
}

// ===== 26. PREVENT DOUBLE SUBMIT =====
let formSubmitted = false;
guestbookForm?.addEventListener('submit', function(e) {
    if (formSubmitted) {
        e.preventDefault();
        showNotification('Form sedang diproses, mohon tunggu...', 'error');
        return;
    }
    
    // Mark as submitted if validation passes
    if (this.checkValidity && this.checkValidity()) {
        formSubmitted = true;
    }
});

// ===== 27. SAVE FORM DATA TO LOCALSTORAGE (Optional) =====
const nameInput = document.querySelector('input[name="name"]');
if (nameInput && !successAlert) {
    // Load saved data
    const savedName = localStorage.getItem('guestbook_name');
    const savedEmail = localStorage.getItem('guestbook_email');
    
    if (savedName) nameInput.value = savedName;
    if (savedEmail && emailInput) emailInput.value = savedEmail;
    
    // Save on input
    nameInput.addEventListener('input', function() {
        localStorage.setItem('guestbook_name', this.value);
    });
    
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            localStorage.setItem('guestbook_email', this.value);
        });
    }
}

// ===== 28. CLEAR LOCALSTORAGE ON SUCCESS =====
if (successAlert) {
    localStorage.removeItem('guestbook_name');
    localStorage.removeItem('guestbook_email');
}

// ===== 29. FOCUS FIRST FIELD =====
setTimeout(() => {
    const firstInput = document.querySelector('input[name="name"]');
    if (firstInput && !successAlert) {
        firstInput.focus();
    }
}, 500);

// ===== 30. RIPPLE EFFECT ON BUTTON =====
const guestbookBtn = document.querySelector('.btn-primary');
if (guestbookBtn) {
    guestbookBtn.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        ripple.className = 'ripple';
        ripple.style.left = e.clientX - this.offsetLeft + 'px';
        ripple.style.top = e.clientY - this.offsetTop + 'px';
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
}

// ===== 31. ADD RIPPLE STYLES =====
styleSheet.textContent += `
    .btn-primary {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;

// ===== 32. TOOLTIP FOR FORM FIELDS =====
const formLabels = document.querySelectorAll('.form-floating label');
formLabels.forEach(label => {
    label.setAttribute('data-bs-toggle', 'tooltip');
    label.setAttribute('data-bs-placement', 'right');
    label.setAttribute('title', label.textContent);
});

// Reinitialize tooltips for new elements
if (typeof bootstrap !== 'undefined') {
    const newTooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    newTooltips.forEach(el => {
        new bootstrap.Tooltip(el);
    });
}

// ===== 33. PAGE VISIBILITY CHANGE =====
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        // Page is hidden, maybe pause something
    } else {
        // Page is visible again, refresh something
        console.log('Welcome back to guestbook page');
    }
});

// ===== 34. LOG FORM INTERACTIONS =====
if (guestbookForm) {
    const startTime = Date.now();
    
    guestbookForm.addEventListener('focusin', function() {
        console.log('User started filling guestbook form');
    });
    
    guestbookForm.addEventListener('focusout', function() {
        const timeSpent = Math.round((Date.now() - startTime) / 1000);
        if (timeSpent > 10) {
            console.log(`User spent ${timeSpent} seconds on form`);
        }
    });
}

console.log('✨ Guestbook page enhanced with Nature & Gold theme');

// ===== NEWS PAGE JAVASCRIPT =====
// Tambahkan ini di dalam document.addEventListener('DOMContentLoaded', function() { ... });

// ===== 35. NEWS SEARCH FUNCTIONALITY =====
const searchInput = document.querySelector('.mb-4 .form-control');
const newsCards = document.querySelectorAll('.row .col-md-4');
const newsContainer = document.querySelector('.row');

if (searchInput && newsCards.length > 0) {
    
    // ===== 35.1 Debounce Search =====
    let searchTimeout;
    
    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        
        const searchTerm = e.target.value.toLowerCase().trim();
        
        // Show loading state
        if (searchTerm.length > 0) {
            showSearchLoading();
        }
        
        searchTimeout = setTimeout(() => {
            filterNews(searchTerm);
        }, 500);
    });
    
    function filterNews(searchTerm) {
        let visibleCount = 0;
        
        newsCards.forEach(card => {
            const title = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
            const excerpt = card.querySelector('.card-text')?.textContent.toLowerCase() || '';
            const category = card.querySelector('.text-muted')?.textContent.toLowerCase() || '';
            
            const matches = title.includes(searchTerm) || 
                          excerpt.includes(searchTerm) || 
                          category.includes(searchTerm);
            
            if (searchTerm === '' || matches) {
                card.style.display = '';
                card.style.animation = 'fadeIn 0.5s';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Show empty state if no results
        showEmptyState(visibleCount === 0, searchTerm);
        
        // Update result count
        updateResultCount(visibleCount, searchTerm);
    }
    
    function showSearchLoading() {
        // Add loading indicator if needed
        const loadingEl = document.createElement('div');
        loadingEl.className = 'text-center my-3';
        loadingEl.id = 'search-loading';
        loadingEl.innerHTML = '<div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div>';
        
        if (!document.getElementById('search-loading')) {
            searchInput.parentNode.appendChild(loadingEl);
        }
        
        setTimeout(() => {
            const loading = document.getElementById('search-loading');
            if (loading) loading.remove();
        }, 400);
    }
    
    function showEmptyState(isEmpty, searchTerm) {
        let emptyState = document.querySelector('.empty-search-state');
        
        if (isEmpty) {
            if (!emptyState) {
                emptyState = document.createElement('div');
                emptyState.className = 'empty-search-state text-center py-5';
                emptyState.innerHTML = `
                    <i class="bi bi-search" style="font-size: 3rem; color: var(--nature-green-light);"></i>
                    <h4 class="mt-3">Tidak ditemukan berita</h4>
                    <p class="text-muted">Tidak ada berita yang cocok dengan "${searchTerm}"</p>
                    <button class="btn btn-outline-primary btn-sm mt-2" onclick="clearSearch()">Clear Search</button>
                `;
                newsContainer.parentNode.appendChild(emptyState);
            }
            newsContainer.style.display = 'none';
        } else {
            if (emptyState) emptyState.remove();
            newsContainer.style.display = '';
        }
    }
    
    function updateResultCount(count, searchTerm) {
        let countEl = document.querySelector('.search-result-count');
        
        if (searchTerm !== '') {
            if (!countEl) {
                countEl = document.createElement('div');
                countEl.className = 'search-result-count text-muted mb-3';
                searchInput.parentNode.appendChild(countEl);
            }
            countEl.innerHTML = `Menampilkan ${count} dari ${newsCards.length} berita`;
        } else {
            if (countEl) countEl.remove();
        }
    }
    
    // ===== 35.2 Clear Search Function =====
    window.clearSearch = function() {
        if (searchInput) {
            searchInput.value = '';
            filterNews('');
        }
    };
    
    // ===== 35.3 Search Input Clear Button =====
    const clearButton = document.createElement('button');
    clearButton.className = 'btn btn-link position-absolute end-0 top-50 translate-middle-y';
    clearButton.innerHTML = '<i class="bi bi-x-circle"></i>';
    clearButton.style.display = 'none';
    clearButton.style.color = 'var(--text-muted)';
    
    searchInput.parentNode.style.position = 'relative';
    searchInput.parentNode.appendChild(clearButton);
    
    searchInput.addEventListener('input', function() {
        clearButton.style.display = this.value ? 'block' : 'none';
    });
    
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.focus();
        clearButton.style.display = 'none';
        filterNews('');
    });
}

// ===== 36. CATEGORY FILTERING =====
function addCategoryFilter() {
    const categories = new Set();
    
    // Collect unique categories
    document.querySelectorAll('.row .col-md-4 .text-muted').forEach(el => {
        const category = el.textContent.split('|')[0].trim();
        categories.add(category);
    });
    
    if (categories.size > 1) {
        const filterContainer = document.createElement('div');
        filterContainer.className = 'category-filter mb-4';
        filterContainer.innerHTML = '<span class="badge active" data-category="all">Semua</span>';
        
        categories.forEach(category => {
            filterContainer.innerHTML += `<span class="badge" data-category="${category}">${category}</span>`;
        });
        
        // Insert after search box
        const searchBox = document.querySelector('.mb-4');
        searchBox.parentNode.insertBefore(filterContainer, searchBox.nextSibling);
        
        // Add click handlers
        filterContainer.querySelectorAll('.badge').forEach(badge => {
            badge.addEventListener('click', function() {
                // Update active state
                filterContainer.querySelectorAll('.badge').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.dataset.category;
                filterByCategory(category);
            });
        });
    }
}

function filterByCategory(category) {
    newsCards.forEach(card => {
        const cardCategory = card.querySelector('.text-muted')?.textContent.split('|')[0].trim() || '';
        
        if (category === 'all' || cardCategory === category) {
            card.style.display = '';
            card.style.animation = 'fadeIn 0.5s';
        } else {
            card.style.display = 'none';
        }
    });
}

// ===== 37. SORTING FUNCTIONALITY =====
function addSortOptions() {
    const sortContainer = document.createElement('div');
    sortContainer.className = 'd-flex justify-content-end mb-3';
    sortContainer.innerHTML = `
        <select class="form-select form-select-sm w-auto" id="sort-news">
            <option value="newest">Terbaru</option>
            <option value="oldest">Terlama</option>
            <option value="az">A-Z</option>
            <option value="za">Z-A</option>
        </select>
    `;
    
    const searchBox = document.querySelector('.mb-4');
    searchBox.parentNode.insertBefore(sortContainer, searchBox.nextSibling);
    
    document.getElementById('sort-news').addEventListener('change', function(e) {
        sortNews(e.target.value);
    });
}

function sortNews(sortBy) {
    const cardsArray = Array.from(newsCards);
    const sortedCards = cardsArray.sort((a, b) => {
        if (sortBy === 'newest') {
            return getDate(b) - getDate(a);
        } else if (sortBy === 'oldest') {
            return getDate(a) - getDate(b);
        } else if (sortBy === 'az') {
            return getTitle(a).localeCompare(getTitle(b));
        } else if (sortBy === 'za') {
            return getTitle(b).localeCompare(getTitle(a));
        }
    });
    
    // Reorder DOM
    newsContainer.innerHTML = '';
    sortedCards.forEach(card => {
        newsContainer.appendChild(card.parentNode);
    });
}

function getDate(card) {
    const dateStr = card.querySelector('.text-muted')?.textContent.split('|')[1]?.trim() || '';
    return new Date(dateStr);
}

function getTitle(card) {
    return card.querySelector('.card-title')?.textContent || '';
}

// ===== 38. NEW BADGE FOR RECENT POSTS =====
function markRecentPosts() {
    const today = new Date();
    const threeDaysAgo = new Date(today.setDate(today.getDate() - 3));
    
    document.querySelectorAll('.row .col-md-4').forEach(card => {
        const dateStr = card.querySelector('.text-muted')?.textContent.split('|')[1]?.trim() || '';
        const postDate = new Date(dateStr);
        
        if (postDate > threeDaysAgo) {
            card.setAttribute('data-new', 'true');
        }
    });
}

// ===== 39. TRUNCATE TEXT =====
function truncateText() {
    document.querySelectorAll('.card-title').forEach(el => {
        if (el.scrollWidth > el.clientWidth) {
            el.setAttribute('title', el.textContent);
        }
    });
    
    document.querySelectorAll('.card-text').forEach(el => {
        if (el.scrollHeight > el.clientHeight) {
            el.setAttribute('title', el.textContent);
        }
    });
}

// ===== 40. PAGINATION ENHANCEMENT =====
function enhancePagination() {
    const pagination = document.querySelector('.mt-4 .pagination');
    
    if (pagination) {
        // Add page info
        const activePage = pagination.querySelector('.active .page-link');
        if (activePage) {
            const totalPages = pagination.querySelectorAll('.page-item:not(.disabled)').length - 2; // Exclude prev/next
            const currentPage = activePage.textContent;
            
            const infoEl = document.createElement('div');
            infoEl.className = 'pagination-info';
            infoEl.textContent = `Halaman ${currentPage} dari ${totalPages}`;
            
            pagination.parentNode.appendChild(infoEl);
        }
        
        // Smooth scroll to top on page change
        pagination.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!this.parentElement.classList.contains('disabled') && 
                    !this.parentElement.classList.contains('active')) {
                    window.scrollTo({
                        top: document.querySelector('.container.py-5').offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
}

// ===== 41. IMAGE ERROR HANDLING =====
function handleImageErrors() {
    document.querySelectorAll('.card-img-top').forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'https://placehold.co/600x400?text=Gambar+Tidak+Tersedia';
            this.alt = 'Image not available';
        });
    });
}

// ===== 42. LAZY LOAD IMAGES =====
function lazyLoadImages() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('.card-img-top[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// ===== 43. KEYBOARD NAVIGATION =====
function setupKeyboardNav() {
    document.addEventListener('keydown', function(e) {
        // Ctrl+F to focus search
        if (e.ctrlKey && e.key === 'f') {
            e.preventDefault();
            searchInput?.focus();
        }
        
        // Escape to clear search
        if (e.key === 'Escape' && searchInput === document.activeElement) {
            searchInput.value = '';
            filterNews('');
            searchInput.blur();
        }
    });
}

// ===== 44. INITIALIZE ALL NEWS FEATURES =====
if (document.querySelector('.row .col-md-4')) {
    // Add category filter if multiple categories exist
    addCategoryFilter();
    
    // Add sort options
    addSortOptions();
    
    // Mark recent posts
    markRecentPosts();
    
    // Truncate text
    truncateText();
    
    // Enhance pagination
    enhancePagination();
    
    // Handle image errors
    handleImageErrors();
    
    // Setup keyboard navigation
    setupKeyboardNav();
    
    // Lazy load images
    lazyLoadImages();
    
    // Add fade-in animation to cards
    newsCards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.5s ${index * 0.1}s forwards`;
    });
}

// ===== 45. PRINT FUNCTIONALITY =====
function addPrintButton() {
    const printBtn = document.createElement('button');
    printBtn.className = 'btn btn-outline-secondary btn-sm float-end';
    printBtn.innerHTML = '<i class="bi bi-printer"></i> Cetak Halaman';
    printBtn.onclick = () => window.print();
    
    const header = document.querySelector('.container.py-5 > h1');
    if (header) {
        header.parentNode.insertBefore(printBtn, header.nextSibling);
    }
}

addPrintButton();

// ===== 46. SHARE BUTTONS =====
function addShareButtons() {
    const shareContainer = document.createElement('div');
    shareContainer.className = 'd-flex justify-content-end gap-2 mb-3';
    shareContainer.innerHTML = `
        <button class="btn btn-sm btn-outline-success" onclick="shareNews('facebook')">
            <i class="bi bi-facebook"></i>
        </button>
        <button class="btn btn-sm btn-outline-info" onclick="shareNews('twitter')">
            <i class="bi bi-twitter"></i>
        </button>
        <button class="btn btn-sm btn-outline-success" onclick="shareNews('whatsapp')">
            <i class="bi bi-whatsapp"></i>
        </button>
    `;
    
    const searchBox = document.querySelector('.mb-4');
    if (searchBox) {
        searchBox.parentNode.insertBefore(shareContainer, searchBox);
    }
}

window.shareNews = function(platform) {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
            break;
        case 'whatsapp':
            shareUrl = `https://api.whatsapp.com/send?text=${title}%20${url}`;
            break;
    }
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
};

// Add share buttons if on desktop
if (window.innerWidth > 768) {
    addShareButtons();
}

// ===== 47. SCROLL TO TOP ON PAGE CHANGE =====
window.addEventListener('load', function() {
    if (window.location.hash) {
        const element = document.querySelector(window.location.hash);
        if (element) {
            setTimeout(() => {
                element.scrollIntoView({ behavior: 'smooth' });
            }, 100);
        }
    }
});

console.log('✨ News page enhanced with Nature & Gold theme');

// ===== GALLERY PAGE JAVASCRIPT =====
// Tambahkan ini di dalam document.addEventListener('DOMContentLoaded', function() { ... });

// ===== 48. GALLERY FILTER FUNCTIONALITY =====
const galleryItems = document.querySelectorAll('.row.g-4 .col-md-4');
const galleryContainer = document.querySelector('.row.g-4');

if (galleryItems.length > 0) {
    
    // ===== 48.1 Create Filter Buttons =====
    function createFilterButtons() {
        const mediaTypes = new Set();
        
        // Collect unique media types
        galleryItems.forEach(item => {
            const card = item.querySelector('.card');
            const hasImage = card.querySelector('img');
            const hasVideo = card.querySelector('video');
            const hasIframe = card.querySelector('iframe');
            
            if (hasImage) mediaTypes.add('image');
            if (hasVideo) mediaTypes.add('video');
            if (hasIframe) mediaTypes.add('video'); // YouTube as video
        });
        
        if (mediaTypes.size > 1) {
            const filterContainer = document.createElement('div');
            filterContainer.className = 'gallery-filter';
            
            // All button
            filterContainer.innerHTML = `
                <button class="filter-btn active" data-filter="all">
                    <i class="bi bi-grid"></i> Semua
                </button>
            `;
            
            // Individual type buttons
            if (mediaTypes.has('image')) {
                filterContainer.innerHTML += `
                    <button class="filter-btn" data-filter="image">
                        <i class="bi bi-image"></i> Foto
                    </button>
                `;
            }
            
            if (mediaTypes.has('video')) {
                filterContainer.innerHTML += `
                    <button class="filter-btn" data-filter="video">
                        <i class="bi bi-camera-reels"></i> Video
                    </button>
                `;
            }
            
            // Insert after header
            const header = document.querySelector('.container.py-5 .text-center');
            header.parentNode.insertBefore(filterContainer, header.nextSibling);
            
            // Add click handlers
            filterContainer.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active state
                    filterContainer.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filter = this.dataset.filter;
                    filterGallery(filter);
                });
            });
        }
    }
    
    // ===== 48.2 Filter Gallery Function =====
    function filterGallery(filter) {
        let visibleCount = 0;
        
        galleryItems.forEach(item => {
            const card = item.querySelector('.card');
            const hasImage = card.querySelector('img');
            const hasVideo = card.querySelector('video, iframe');
            
            let show = false;
            
            if (filter === 'all') {
                show = true;
            } else if (filter === 'image' && hasImage) {
                show = true;
            } else if (filter === 'video' && hasVideo) {
                show = true;
            }
            
            if (show) {
                item.style.display = '';
                item.style.animation = 'fadeIn 0.5s';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show empty state if no items
        showEmptyState(visibleCount === 0);
        
        // Update stats
        updateGalleryStats();
    }
    
    // ===== 48.3 Empty State =====
    function showEmptyState(isEmpty) {
        let emptyState = document.querySelector('.gallery-empty');
        
        if (isEmpty) {
            if (!emptyState) {
                emptyState = document.createElement('div');
                emptyState.className = 'gallery-empty';
                emptyState.innerHTML = `
                    <i class="bi bi-images"></i>
                    <h3>Tidak Ada Media</h3>
                    <p class="text-muted">Tidak ditemukan media untuk kategori ini</p>
                `;
                galleryContainer.parentNode.appendChild(emptyState);
            }
            galleryContainer.style.display = 'none';
        } else {
            if (emptyState) emptyState.remove();
            galleryContainer.style.display = '';
        }
    }
    
    // ===== 49. LIGHTBOX FUNCTIONALITY =====
    function initLightbox() {
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function(e) {
                // Don't open lightbox if clicking on video controls
                if (e.target.tagName === 'VIDEO' || e.target.tagName === 'BUTTON') {
                    return;
                }
                
                openLightbox(index);
            });
        });
    }
    
    function openLightbox(startIndex) {
        const items = [];
        
        // Collect all media items
        galleryItems.forEach(item => {
            const card = item.querySelector('.card');
            const img = card.querySelector('img');
            const video = card.querySelector('video');
            const iframe = card.querySelector('iframe');
            const title = card.querySelector('.card-title')?.textContent || '';
            const description = card.querySelector('.card-text')?.textContent || '';
            
            if (img) {
                items.push({
                    type: 'image',
                    src: img.src,
                    title: title,
                    description: description
                });
            } else if (video) {
                items.push({
                    type: 'video',
                    src: video.querySelector('source')?.src || video.src,
                    title: title,
                    description: description
                });
            } else if (iframe) {
                items.push({
                    type: 'youtube',
                    src: iframe.src,
                    title: title,
                    description: description
                });
            }
        });
        
        if (items.length === 0) return;
        
        let currentIndex = startIndex;
        
        // Create lightbox
        const lightbox = document.createElement('div');
        lightbox.className = 'gallery-lightbox';
        
        function renderLightbox() {
            const item = items[currentIndex];
            
            let mediaHtml = '';
            
            if (item.type === 'image') {
                mediaHtml = `<img src="${item.src}" class="lightbox-media" alt="${item.title}">`;
            } else if (item.type === 'video') {
                mediaHtml = `
                    <video controls autoplay class="lightbox-media">
                        <source src="${item.src}" type="video/mp4">
                    </video>
                `;
            } else if (item.type === 'youtube') {
                mediaHtml = `
                    <iframe src="${item.src}?autoplay=1" class="lightbox-media" style="width: 80vw; height: 80vh;" allowfullscreen></iframe>
                `;
            }
            
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    ${mediaHtml}
                    <button class="lightbox-close">&times;</button>
                    ${items.length > 1 ? `
                        <button class="lightbox-nav prev"><i class="bi bi-chevron-left"></i></button>
                        <button class="lightbox-nav next"><i class="bi bi-chevron-right"></i></button>
                    ` : ''}
                    <div class="lightbox-caption">
                        <h5 style="color: white; margin-bottom: 0.3rem;">${item.title}</h5>
                        <p style="color: rgba(255,255,255,0.7); margin-bottom: 0;">${item.description}</p>
                    </div>
                </div>
            `;
        }
        
        renderLightbox();
        document.body.appendChild(lightbox);
        document.body.style.overflow = 'hidden';
        
        // Close button
        lightbox.querySelector('.lightbox-close').addEventListener('click', () => {
            lightbox.remove();
            document.body.style.overflow = '';
        });
        
        // Click outside to close
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.remove();
                document.body.style.overflow = '';
            }
        });
        
        // Navigation
        if (items.length > 1) {
            lightbox.querySelector('.prev').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                renderLightbox();
            });
            
            lightbox.querySelector('.next').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % items.length;
                renderLightbox();
            });
        }
        
        // Keyboard navigation
        function handleKeydown(e) {
            if (e.key === 'Escape') {
                lightbox.remove();
                document.body.style.overflow = '';
                document.removeEventListener('keydown', handleKeydown);
            } else if (e.key === 'ArrowLeft') {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                renderLightbox();
            } else if (e.key === 'ArrowRight') {
                currentIndex = (currentIndex + 1) % items.length;
                renderLightbox();
            }
        }
        
        document.addEventListener('keydown', handleKeydown);
    }
    
    // ===== 50. MEDIA TYPE BADGES =====
    function addMediaTypeBadges() {
        galleryItems.forEach(item => {
            const card = item.querySelector('.card');
            const mediaType = document.createElement('span');
            mediaType.className = 'media-type';
            
            if (card.querySelector('img')) {
                mediaType.innerHTML = '<i class="bi bi-image me-1"></i> Foto';
                mediaType.style.background = 'linear-gradient(135deg, var(--nature-green), #45b787)';
            } else if (card.querySelector('video')) {
                mediaType.innerHTML = '<i class="bi bi-camera-reels me-1"></i> Video';
                mediaType.style.background = 'linear-gradient(135deg, var(--gold), #f5b342)';
            } else if (card.querySelector('iframe')) {
                mediaType.innerHTML = '<i class="bi bi-youtube me-1"></i> YouTube';
                mediaType.style.background = 'linear-gradient(135deg, #ff0000, #cc0000)';
            }
            
            card.style.position = 'relative';
            card.appendChild(mediaType);
        });
    }
    
    // ===== 51. GALLERY STATS =====
    function createGalleryStats() {
        const totalItems = galleryItems.length;
        const totalImages = document.querySelectorAll('.card img').length;
        const totalVideos = document.querySelectorAll('.card video, .card iframe').length;
        
        const statsContainer = document.createElement('div');
        statsContainer.className = 'gallery-stats';
        statsContainer.innerHTML = `
            <div class="stat-item">
                <div class="stat-number">${totalItems}</div>
                <div class="stat-label">Total Media</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${totalImages}</div>
                <div class="stat-label">Foto</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${totalVideos}</div>
                <div class="stat-label">Video</div>
            </div>
        `;
        
        const header = document.querySelector('.container.py-5 .text-center');
        header.parentNode.insertBefore(statsContainer, header.nextSibling);
    }
    
    function updateGalleryStats() {
        const statsContainer = document.querySelector('.gallery-stats');
        if (!statsContainer) return;
        
        const visibleItems = Array.from(galleryItems).filter(item => item.style.display !== 'none').length;
        const visibleImages = Array.from(galleryItems).filter(item => 
            item.style.display !== 'none' && item.querySelector('img')
        ).length;
        const visibleVideos = Array.from(galleryItems).filter(item => 
            item.style.display !== 'none' && (item.querySelector('video') || item.querySelector('iframe'))
        ).length;
        
        statsContainer.innerHTML = `
            <div class="stat-item">
                <div class="stat-number">${visibleItems}</div>
                <div class="stat-label">Ditampilkan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${visibleImages}</div>
                <div class="stat-label">Foto</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${visibleVideos}</div>
                <div class="stat-label">Video</div>
            </div>
        `;
    }
    
    // ===== 52. SEARCH IN GALLERY =====
    function addGallerySearch() {
        const searchContainer = document.createElement('div');
        searchContainer.className = 'mb-4';
        searchContainer.style.maxWidth = '400px';
        searchContainer.style.margin = '0 auto';
        searchContainer.innerHTML = `
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Cari judul atau deskripsi..." id="gallery-search">
                <i class="bi bi-search position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            </div>
        `;
        
        const header = document.querySelector('.container.py-5 .text-center');
        header.parentNode.insertBefore(searchContainer, header.nextSibling);
        
        let searchTimeout;
        document.getElementById('gallery-search').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();
                
                galleryItems.forEach(item => {
                    const title = item.querySelector('.card-title')?.textContent.toLowerCase() || '';
                    const description = item.querySelector('.card-text')?.textContent.toLowerCase() || '';
                    
                    if (searchTerm === '' || title.includes(searchTerm) || description.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                updateGalleryStats();
                showEmptyState(Array.from(galleryItems).filter(item => item.style.display !== 'none').length === 0);
            }, 300);
        });
    }
    
    // ===== 53. VIDEO THUMBNAIL GENERATION =====
    function generateVideoThumbnails() {
        document.querySelectorAll('video').forEach(video => {
            video.addEventListener('loadeddata', function() {
                // You could capture a frame as thumbnail if needed
                this.setAttribute('data-loaded', 'true');
            });
        });
    }
    
    // ===== 54. DOWNLOAD BUTTON =====
    function addDownloadButton() {
        galleryItems.forEach(item => {
            const img = item.querySelector('img');
            if (img) {
                const downloadBtn = document.createElement('a');
                downloadBtn.href = img.src;
                downloadBtn.download = img.alt || 'gallery-image';
                downloadBtn.className = 'btn btn-sm btn-outline-primary mt-2';
                downloadBtn.innerHTML = '<i class="bi bi-download me-1"></i> Download';
                downloadBtn.style.borderRadius = 'var(--rounded-full)';
                downloadBtn.style.padding = '0.3rem 1rem';
                downloadBtn.style.fontSize = '0.8rem';
                
                downloadBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
                
                item.querySelector('.card-body').appendChild(downloadBtn);
            }
        });
    }
    
    // ===== 55. INITIALIZE ALL GALLERY FEATURES =====
    
    // Create filter buttons
    createFilterButtons();
    
    // Add media type badges
    addMediaTypeBadges();
    
    // Create gallery stats
    createGalleryStats();
    
    // Add gallery search
    addGallerySearch();
    
    // Initialize lightbox
    initLightbox();
    
    // Generate video thumbnails
    generateVideoThumbnails();
    
    // Add download buttons (optional - comment if not needed)
    // addDownloadButton();
    
    // Add animation on scroll
    galleryItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        item.style.transition = 'all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1)';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // ===== 56. LAZY LOAD VIDEOS =====
    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const video = entry.target;
                const source = video.querySelector('source');
                if (source && !video.hasAttribute('data-loaded')) {
                    video.load();
                    video.setAttribute('data-loaded', 'true');
                }
                videoObserver.unobserve(video);
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('video').forEach(video => {
        videoObserver.observe(video);
    });
    
    // ===== 57. KEYBOARD SHORTCUTS =====
    document.addEventListener('keydown', function(e) {
        // Press 'f' to focus search
        if (e.key === 'f' && e.ctrlKey === false && !e.target.matches('input, textarea')) {
            e.preventDefault();
            const searchInput = document.getElementById('gallery-search');
            if (searchInput) searchInput.focus();
        }
    });
    
    console.log('✨ Gallery page enhanced with Nature & Gold theme');
}