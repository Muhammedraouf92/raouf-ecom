/**
 * MyStore – Main JavaScript
 */

document.addEventListener("DOMContentLoaded", function () {
  /* =============================================
       MOBILE NAV TOGGLE
       ============================================= */
  const hamburger = document.querySelector(".hamburger");
  const mobileNav = document.getElementById("mobile-nav");

  if (hamburger && mobileNav) {
    hamburger.addEventListener("click", function () {
      const expanded = this.getAttribute("aria-expanded") === "true";
      this.setAttribute("aria-expanded", String(!expanded));
      mobileNav.setAttribute("aria-hidden", String(expanded));
      mobileNav.classList.toggle("is-open");
      document.body.classList.toggle("nav-open");
    });

    // Close on outside click
    document.addEventListener("click", function (e) {
      if (!hamburger.contains(e.target) && !mobileNav.contains(e.target)) {
        hamburger.setAttribute("aria-expanded", "false");
        mobileNav.setAttribute("aria-hidden", "true");
        mobileNav.classList.remove("is-open");
        document.body.classList.remove("nav-open");
      }
    });
  }
// announcment bar
document.querySelector('.announcement-bar__close')?.addEventListener('click', function () {
    document.querySelector('.announcement-bar').classList.add('hidden');
    sessionStorage.setItem('announcementDismissed', '1');
});

if (sessionStorage.getItem('announcementDismissed') === '1') {
    document.querySelector('.announcement-bar')?.classList.add('hidden');
}
  /* =============================================
       PRODUCT GALLERY – THUMBNAIL SWITCHER
       ============================================= */
  const mainImg = document.getElementById("gallery-main-img");
  const thumbs = document.querySelectorAll(".gallery-thumbs .thumb");

  if (mainImg && thumbs.length) {
    thumbs.forEach(function (thumb) {
      thumb.addEventListener("click", function () {
        const fullSrc = this.dataset.full;
        if (fullSrc) {
          mainImg.src = fullSrc;
        }
        thumbs.forEach((t) => t.classList.remove("active"));
        this.classList.add("active");
      });
    });
  }

  /* =============================================
       QUANTITY CONTROLS
       ============================================= */
  document.querySelectorAll(".qty-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      const input = this.closest(".qty-control").querySelector(".qty-input");
      if (!input) return;

      let value = parseInt(input.value, 10) || 1;
      const min = parseInt(input.min, 10) || 1;
      const max = parseInt(input.max, 10) || 9999;

      if (this.dataset.action === "increment") {
        value = Math.min(value + 1, max);
      } else if (this.dataset.action === "decrement") {
        value = Math.max(value - 1, min);
      }

      input.value = value;
      input.dispatchEvent(new Event("change", { bubbles: true }));
    });
  });

  /* =============================================
       HEADER SCROLL SHADOW
       ============================================= */
  const header = document.querySelector(".site-header");
  if (header) {
    window.addEventListener(
      "scroll",
      function () {
        header.classList.toggle("scrolled", window.scrollY > 10);
      },
      { passive: true },
    );
  }

  /* =============================================
       SCROLL ANIMATIONS (Intersection Observer)
       ============================================= */
  if ("IntersectionObserver" in window) {
    const animateTargets = document.querySelectorAll(
      ".why-us-card, .about-value, .about-image-wrap, .about-content, .category-card, .product-card, .lookbook-banner, .lookbook-inner"
    );

    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: "0px 0px -40px 0px",
      }
    );

    animateTargets.forEach(function (el, index) {
      el.style.opacity = "0";
      el.style.transform = "translateY(30px)";
      el.style.transition =
        "opacity 0.6s ease " +
        (index % 6) * 0.08 +
        "s, transform 0.6s ease " +
        (index % 6) * 0.08 +
        "s";
      observer.observe(el);
    });
  }
});
