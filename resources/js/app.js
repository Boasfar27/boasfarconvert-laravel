import './bootstrap';
import AOS from 'aos';

// Initialize AOS animation library
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false,
        offset: 50
    });
});

// Dark mode toggle functionality
document.addEventListener('DOMContentLoaded', () => {
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');

            // Save preference to localStorage
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('color-theme', 'dark');
            } else {
                localStorage.setItem('color-theme', 'light');
            }
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

// Smooth scroll for anchor links
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

// FAQ Toggle
document.addEventListener('DOMContentLoaded', function () {
    const faqItems = document.querySelectorAll('.faq-item');

    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all FAQs
                faqItems.forEach(faq => {
                    faq.classList.remove('active');
                    const answer = faq.querySelector('.faq-answer');
                    if (answer && faq !== item) {
                        answer.style.maxHeight = '0';
                        answer.style.opacity = '0';
                    }
                });

                // Toggle current FAQ
                if (!isActive) {
                    item.classList.add('active');
                    const answer = item.querySelector('.faq-answer');
                    if (answer) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.opacity = '1';
                    }
                }
            });

            // Initialize: hide all answers
            const answer = item.querySelector('.faq-answer');
            if (answer) {
                answer.style.maxHeight = '0';
                answer.style.opacity = '0';
                answer.style.overflow = 'hidden';
                answer.style.transition = 'max-height 0.5s ease, opacity 0.3s ease';
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
});
