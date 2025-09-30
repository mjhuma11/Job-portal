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

        // Initialize Categories Pagination
        initializeCategoriesPagination();

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

    // Categories Pagination Functions
    function initializeCategoriesPagination() {
        // Handle category pagination clicks with smooth scroll
        document.addEventListener('click', function(e) {
            // Check if clicked element is a category pagination link
            if (e.target.closest('a[href*="categories_page"]')) {
                e.preventDefault();
                const link = e.target.closest('a');
                const url = link.href;
                
                // Show loading state
                showNotification('Loading categories...', 'info');
                
                // Fetch new page content
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Parse the response
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Find the categories section in the new content
                    const newCategoriesSection = doc.querySelector('.py-16[style*="var(--bg-light)"]');
                    const currentCategoriesSection = document.querySelector('.py-16[style*="var(--bg-light)"]');
                    
                    if (newCategoriesSection && currentCategoriesSection) {
                        // Replace the categories section
                        currentCategoriesSection.innerHTML = newCategoriesSection.innerHTML;
                        
                        // Scroll to categories section
                        currentCategoriesSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Update URL without page reload
                        window.history.pushState({}, '', url);
                    }
                })
                .catch(error => {
                    console.error('Error loading categories:', error);
                    showNotification('Error loading categories. Please try again.', 'error');
                    // Fallback to normal navigation
                    window.location.href = url;
                });
            }
        });

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(e) {
            location.reload();
        });
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