(function () {
  'use strict';

  // ─────────────────────────────────────────────
  // Topbar Dismiss
  // ─────────────────────────────────────────────
  var TOPBAR_KEY = 'wp_tail_topbar_dismissed';
  var topbar     = document.getElementById('wp-tail-topbar');
  var closeBtn   = document.getElementById('wp-tail-topbar-close');

  if (topbar) {
    // Remove immediately on page load if previously dismissed (prevents flash).
    if (localStorage.getItem(TOPBAR_KEY) === '1') {
      topbar.remove();
    } else if (closeBtn) {
      closeBtn.addEventListener('click', function () {
        localStorage.setItem(TOPBAR_KEY, '1');
        topbar.classList.add('hidden');
        topbar.addEventListener('transitionend', function () {
          topbar.remove();
        }, { once: true });
      });
    }
  }

  // ─────────────────────────────────────────────
  // Mobile Menu Toggle
  // ─────────────────────────────────────────────
  var hamburger  = document.getElementById('wp-tail-hamburger');
  var mobileMenu = document.getElementById('wp-tail-mobile-menu');
  var header     = document.getElementById('wp-tail-header');

  if (hamburger && mobileMenu) {

    hamburger.addEventListener('click', function () {
      var isOpen = !mobileMenu.classList.contains('hidden');
      if (isOpen) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    });

    // Close when clicking outside the header.
    document.addEventListener('click', function (event) {
      if (header && !header.contains(event.target)) {
        closeMobileMenu();
      }
    });

    // Close on Escape key — return focus to hamburger for accessibility.
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeMobileMenu();
        hamburger.focus();
      }
    });
  }

  function openMobileMenu() {
    mobileMenu.classList.remove('hidden');
    hamburger.setAttribute('aria-expanded', 'true');
    hamburger.setAttribute('aria-label', 'Close navigation menu');
  }

  function closeMobileMenu() {
    if (!mobileMenu.classList.contains('hidden')) {
      mobileMenu.classList.add('hidden');
      hamburger.setAttribute('aria-expanded', 'false');
      hamburger.setAttribute('aria-label', 'Open navigation menu');
    }
  }

})();
