// CareerBridge Interactive Components
(function () {
    'use strict';

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {
        console.log('CareerBridge: Initializing interactive components...');

        // Initialize Navigation
        initializeNavigation();

        // Initialize Footer
        initializeFooter();

        // Initialize Carousel (if exists)
        initializeCarousel();

        console.log('CareerBridge: All components initialized successfully!');
    });

    // Navigation Functions
    function initializeNavigation() {
        // Desktop mega menu
        const pagesMenuTrigger = document.getElementById('pages-menu-trigger');
        const megaMenu = document.getElementById('mega-menu');
        let megaMenuTimeout;

        if (pagesMenuTrigger && megaMenu) {
            console.log('CareerBridge: Initializing mega menu...');

            // Show mega menu on hover
            pagesMenuTrigger.parentElement.addEventListener('mouseenter', function () {
                clearTimeout(megaMenuTimeout);
                megaMenu.classList.add('active');
            });

            // Hide mega menu when leaving
            pagesMenuTrigger.parentElement.addEventListener('mouseleave', function () {
                megaMenuTimeout = setTimeout(() => {
                    megaMenu.classList.remove('active');
                }, 150);
            });

            // Keep menu open when hovering over the mega menu itself
            megaMenu.addEventListener('mouseenter', function () {
                clearTimeout(megaMenuTimeout);
            });

            megaMenu.addEventListener('mouseleave', function () {
                megaMenuTimeout = setTimeout(() => {
                    megaMenu.classList.remove('active');
                }, 150);
            });
        }

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            console.log('CareerBridge: Initializing mobile menu...');

            mobileMenuButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');

                // Toggle hamburger icon
                const icon = this.querySelector('svg');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                }
            });
        }

        // Mobile pages submenu
        const mobilePagessTrigger = document.getElementById('mobile-pages-trigger');
        const mobilePagesMenu = document.getElementById('mobile-pages-menu');

        if (mobilePagessTrigger && mobilePagesMenu) {
            console.log('CareerBridge: Initializing mobile pages submenu...');

            mobilePagessTrigger.addEventListener('click', function () {
                mobilePagesMenu.classList.toggle('hidden');
                const arrow = this.querySelector('svg');
                arrow.classList.toggle('rotate-180');
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (event) {
            if (mobileMenu && mobileMenuButton &&
                !mobileMenu.contains(event.target) &&
                !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuButton.querySelector('svg');
                if (icon) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
            }
        });
    }

    // Footer Functions
    function initializeFooter() {
        // Newsletter subscription functionality
        const newsletterBtn = document.getElementById('newsletter-btn');
        const newsletterEmail = document.getElementById('newsletter-email');

        if (newsletterBtn && newsletterEmail) {
            console.log('CareerBridge: Initializing newsletter subscription...');

            newsletterBtn.addEventListener('click', function () {
                const email = newsletterEmail.value.trim();

                if (!email) {
                    showNotification('Please enter your email address.', 'warning');
                    return;
                }

                if (!isValidEmail(email)) {
                    showNotification('Please enter a valid email address.', 'error');
                    return;
                }

                // Simulate newsletter subscription
                newsletterBtn.innerHTML = 'Subscribing...';
                newsletterBtn.disabled = true;

                setTimeout(() => {
                    showNotification('Thank you for subscribing to our newsletter!', 'success');
                    newsletterEmail.value = '';
                    newsletterBtn.innerHTML = 'Subscribe';
                    newsletterBtn.disabled = false;
                }, 1500);
            });

            // Allow subscription with Enter key
            newsletterEmail.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    newsletterBtn.click();
                }
            });
        }

        // Add hover effects to social media links
        document.querySelectorAll('footer a[href="#"]').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                showNotification('Social media integration coming soon!', 'info');
            });
        });
    }

    // Carousel Functions
    function initializeCarousel() {
        const carousel = document.getElementById('heroSection');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicators = document.querySelectorAll('.carousel-indicator');

        if (!carousel || !prevBtn || !nextBtn || indicators.length === 0) {
            console.log('CareerBridge: Carousel elements not found, skipping initialization');
            return;
        }

        console.log('CareerBridge: Initializing carousel...');

        let currentSlide = 0;
        const totalSlides = 3;
        let autoSlideInterval;

        // Carousel data - Only background images change, hero image and content stay fixed
        const slides = [
            {}, // Slide 1 - only background changes
            {}, // Slide 2 - only background changes  
            {}  // Slide 3 - only background changes
        ];

        function showSlide(index) {
            // Update background images only
            document.querySelectorAll('[id^="bg"]').forEach((bg, i) => {
                bg.style.opacity = i === index ? '1' : '0';
            });

            // DO NOT update hero image - keep it static
            // DO NOT update any text content - keep it fixed

            // Update indicators only
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === index);
                if (i === index) {
                    indicator.style.backgroundColor = 'var(--accent-color)';
                } else {
                    indicator.style.backgroundColor = '';
                }
            });

            currentSlide = index;
        }

        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }

        function prevSlide() {
            const prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }

        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // Event listeners
        prevBtn.addEventListener('click', () => {
            stopAutoSlide();
            prevSlide();
            startAutoSlide();
        });

        nextBtn.addEventListener('click', () => {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });

        // Indicator clicks
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                stopAutoSlide();
                showSlide(index);
                startAutoSlide();
            });
        });

        // Pause on hover
        carousel.addEventListener('mouseenter', stopAutoSlide);
        carousel.addEventListener('mouseleave', startAutoSlide);

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        carousel.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            }
            if (touchEndX > touchStartX + 50) {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            } else if (e.key === 'ArrowRight') {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            }
        });

        // Initialize carousel
        showSlide(0);
        startAutoSlide();
    }

    // Utility Functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

        // Set notification style based on type
        switch (type) {
            case 'success':
                notification.style.backgroundColor = 'var(--accent-color)';
                notification.style.color = 'white';
                break;
            case 'error':
                notification.style.backgroundColor = 'var(--secondary-color)';
                notification.style.color = 'white';
                break;
            case 'warning':
                notification.style.backgroundColor = '#f39c12';
                notification.style.color = 'white';
                break;
            default:
                notification.style.backgroundColor = 'var(--primary-color)';
                notification.style.color = 'white';
        }

        notification.textContent = message;
        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translate-x-0';
        }, 100);

        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translate-x-full';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Smooth scroll for anchor links
    document.addEventListener('click', function (e) {
        if (e.target.matches('a[href^="#"]')) {
            e.preventDefault();
            const target = document.querySelector(e.target.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
})();