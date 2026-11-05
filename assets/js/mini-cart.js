(function ($) {
  "use strict";

  let isOpen = false;

  function getElements() {
    return {
      sidebar: document.getElementById("mc-sidebar"),
      overlay: document.getElementById("mc-overlay"),
      closeBtn: document.getElementById("mc-close"),
      cartIcon: document.querySelector(".cart-icon"),
    };
  }
  function updateCartCount(count) {
    const badge = document.querySelector(".cart-count");
    if (!badge) return;
    badge.textContent = count;
    badge.style.display = count > 0 ? "" : "none";
  }
  function openCart() {
    const { sidebar, overlay } = getElements();
    if (!sidebar) return;
    sidebar.classList.add("is-open");
    overlay.classList.add("is-open");
    sidebar.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden";
    isOpen = true;
  }

  function closeCart() {
    const { sidebar, overlay } = getElements();
    if (!sidebar) return;
    sidebar.classList.remove("is-open");
    overlay.classList.remove("is-open");
    sidebar.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
    isOpen = false;
  }

  function refreshFragments(callback) {
    $.ajax({
      url: wc_add_to_cart_params.wc_ajax_url
        .toString()
        .replace("%%endpoint%%", "get_refreshed_fragments"),
      method: "POST",
      success: function (data) {
        if (data && data.fragments) {
          $.each(data.fragments, function (key, value) {
            $(key).replaceWith(value);
          });
        }
        if (typeof callback === "function") callback();
      },
    });
  }

  // ── Static event listeners (attached once to document, never lost) ──

  // Close button
  $(document).on("click", "#mc-close", function () {
    closeCart();
  });

  // Overlay
  $(document).on("click", "#mc-overlay", function () {
    closeCart();
  });

  // Cart icon in header
  $(document).on("click", ".cart-icon", function (e) {
    e.preventDefault();
    openCart();
  });

  // Escape key
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && isOpen) closeCart();
  });

  function showNotice(message, type) {
    const $notice = $(
      '<div class="mystore-cart-notice ' + type + '">' + message + "</div>",
    );
    $(".mystore-cart-notice").remove();
    $("body").append($notice);
    setTimeout(() => $notice.addClass("visible"), 10);
    setTimeout(() => {
      $notice.removeClass("visible");
      setTimeout(() => $notice.remove(), 400);
    }, 3000);
  }

  // ── Add to cart → open sidebar ──
  $(document.body).on(
    "added_to_cart",
    function (event, fragments, cart_hash, $button) {
      // Apply fragments first
      if (fragments) {
        $.each(fragments, function (key, value) {
          $(key).replaceWith(value);
        });
        const count = parseInt($("#mc-count").text()) || 0;
        updateCartCount(count);
      }

      // Show notice
      const productName =
        $button && $button.data("product_name")
          ? $button.data("product_name")
          : "Item";
      showNotice(productName + " added to cart.", "success");

      // Bounce cart icon
      const cartIcon = document.querySelector(".cart-icon");
      if (cartIcon) {
        cartIcon.classList.remove("mc-bounce");
        void cartIcon.offsetWidth;
        cartIcon.classList.add("mc-bounce");
        cartIcon.addEventListener(
          "animationend",
          function () {
            cartIcon.classList.remove("mc-bounce");
          },
          { once: true },
        );
      }

      openCart();
    },
  );

  // ── Remove item ──
  $(document).on("click", ".mc-item-remove", function (e) {
    e.preventDefault();

    const cartItemKey = $(this).data("cart-item-key");
    if (!cartItemKey) return;

    $("#mc-body").addClass("is-loading");

    $.ajax({
      url: wc_add_to_cart_params.wc_ajax_url
        .toString()
        .replace("%%endpoint%%", "remove_from_cart"),
      method: "POST",
      data: { cart_item_key: cartItemKey },
      success: function () {
        refreshFragments(function () {
          const count = parseInt($("#mc-count").text()) || 0;
          updateCartCount(count);
          if (isOpen) openCart();
        });
      },
      error: function () {
        window.location.reload();
      },
      complete: function () {
        $("#mc-body").removeClass("is-loading");
      },
    });
  });
})(jQuery);
