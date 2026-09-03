/**
 * UK Delivery Platform — Client JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
  // Mobile Navigation Toggle
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      navMenu.classList.toggle('is-active');
      const expanded = navMenu.classList.contains('is-active');
      mobileToggle.setAttribute('aria-expanded', expanded);
    });
  }

  // FAQ Accordion
  const faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
      const faqItem = question.parentElement;
      const isOpen = faqItem.classList.contains('is-open');

      // Close all items
      document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('is-open');
      });

      // Toggle clicked item
      if (!isOpen) {
        faqItem.classList.add('is-open');
      }
    });
  });

  // Auto-format tracking search input to uppercase
  const trackingInputs = document.querySelectorAll('.tracking-input');
  trackingInputs.forEach(input => {
    input.addEventListener('input', (e) => {
      e.target.value = e.target.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
    });
  });
});
