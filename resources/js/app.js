import './bootstrap';
import AOS from 'aos';

// Lazy loading for AOS - only load when needed
const initAOS = () => {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false,
        offset: 50,
        // Disable animations on mobile for better performance
        disable: window.innerWidth < 768
    });
};

// Initialize AOS with lazy loading
document.addEventListener('DOMContentLoaded', () => {
    // Use requestIdleCallback if available for non-critical operations
    if ('requestIdleCallback' in window) {
        requestIdleCallback(() => initAOS());
    } else {
        setTimeout(initAOS, 100);
    }
});

// Dark mode toggle functionality - optimized
document.addEventListener('DOMContentLoaded', () => {
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('color-theme',
                document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            );
        });
    }

    // Check for saved theme preference or prefer-color-scheme
    if (
        localStorage.getItem('color-theme') === 'dark' ||
        (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});

// Smooth scroll with performance optimization
const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
};

// Lazy load smooth scroll functionality
if ('requestIdleCallback' in window) {
    requestIdleCallback(() => initSmoothScroll());
} else {
    setTimeout(initSmoothScroll, 300);
}

// FAQ Toggle - optimized for performance
const initFAQ = () => {
    const faqItems = document.querySelectorAll('.faq-item');

    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');

            if (answer) {
                answer.style.maxHeight = '0';
                answer.style.opacity = '0';
                answer.style.overflow = 'hidden';
                answer.style.transition = 'max-height 0.5s ease, opacity 0.3s ease';
            }

            if (question) {
                question.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');

                    // Use more efficient way to close all FAQs
                    document.querySelectorAll('.faq-item.active').forEach(activeItem => {
                        if (activeItem !== item) {
                            activeItem.classList.remove('active');
                            const activeAnswer = activeItem.querySelector('.faq-answer');
                            if (activeAnswer) {
                                activeAnswer.style.maxHeight = '0';
                                activeAnswer.style.opacity = '0';
                            }
                        }
                    });

                    // Toggle current FAQ
                    if (!isActive) {
                        item.classList.add('active');
                        if (answer) {
                            answer.style.maxHeight = answer.scrollHeight + 'px';
                            answer.style.opacity = '1';
                        }
                    } else {
                        item.classList.remove('active');
                        if (answer) {
                            answer.style.maxHeight = '0';
                            answer.style.opacity = '0';
                        }
                    }
                });
            }
        });

        // Open first FAQ by default
        if (faqItems[0]) {
            faqItems[0].classList.add('active');
            const answer = faqItems[0].querySelector('.faq-answer');
            if (answer) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.style.opacity = '1';
            }
        }
    }
};

// Lazy load FAQ functionality
if (document.querySelectorAll('.faq-item').length > 0) {
    if ('requestIdleCallback' in window) {
        requestIdleCallback(() => initFAQ());
    } else {
        setTimeout(initFAQ, 200);
    }
}
