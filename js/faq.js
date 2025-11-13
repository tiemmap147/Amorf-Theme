/**
 * FAQ Accordion Functionality
 * Handles expand/collapse interactions for FAQ items
 */

(function() {
    'use strict';

    /**
     * Initialize FAQ accordion
     */
    function initFAQAccordion() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        if (!faqItems.length) {
            return;
        }

        faqItems.forEach(function(item) {
            const question = item.querySelector('.faq-question');
            
            if (!question) {
                return;
            }

            question.addEventListener('click', function() {
                const isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(function(otherItem) {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        const otherQuestion = otherItem.querySelector('.faq-question');
                        if (otherQuestion) {
                            otherQuestion.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
                
                // Toggle current item
                if (isActive) {
                    item.classList.remove('active');
                    question.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('active');
                    question.setAttribute('aria-expanded', 'true');
                }
            });

            // Handle keyboard navigation
            question.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    question.click();
                }
            });
        });
    }

    /**
     * Initialize when DOM is ready
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFAQAccordion);
    } else {
        initFAQAccordion();
    }

})();




