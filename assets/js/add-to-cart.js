jQuery(function ($) {
  // ── Add to cart ────────────────────────────────────────────────
  $(document).on("click", ".quick-add-btn", function (e) {
    e.preventDefault();

    const $btn = $(this);
    const productId = $btn.data("product-id");

    if ($btn.hasClass("loading")) return; // prevent double-click

    $btn.addClass("loading").prop("disabled", true);

    $.post(mystore.ajaxurl, {
      action: "mystore_add_to_cart",
      nonce: mystore.nonce,
      product_id: productId,
      quantity: 1,
    })
      .done(function (response) {
        if (response.success) {
          $btn.addClass("added");
          updateCartCount(response.data.cart_count);
          showNotice(response.data.message, "success");
          // Update mini cart fragments
          if (response.data.fragments) {
            $.each(response.data.fragments, function (selector, html) {
              $(selector).replaceWith(html);
            });
          }
          $("#mc-sidebar").addClass("is-open");
          $("#mc-overlay").addClass("is-open");
          document.body.style.overflow = "hidden";
          // Reset button state after a moment
          setTimeout(() => $btn.removeClass("added"), 2000);
        } else {
          // Variable product → redirect to product page
          if (response.data.redirect) {
            window.location.href = response.data.redirect;
            return;
          }
          showNotice(response.data.message, "error");
        }
      })
      .fail(function () {
        showNotice("Something went wrong. Please try again.", "error");
      })
      .always(function () {
        $btn.removeClass("loading").prop("disabled", false);
      });
  });

  // ── Single product page add to cart (AJAX) ─────────────────────
  $(document).on("submit", "form.cart", function (e) {
    const $form = $(this);

    // Let variable products submit normally (they need variation selection)
    if ($form.hasClass("variations_form")) return;

    const $btn = $form.find(".single_add_to_cart_button");
    if ($btn.hasClass("loading") || $btn.hasClass("disabled")) return;

    e.preventDefault();

    const productId =
      $form.find('[name="add-to-cart"]').val() || $btn.attr("value");
    const quantity = parseInt($form.find('[name="quantity"]').val()) || 1;

    if (!productId) return;

    $btn.addClass("loading").prop("disabled", true);

    $.post(mystore.ajaxurl, {
      action: "mystore_add_to_cart",
      nonce: mystore.nonce,
      product_id: productId,
      quantity: quantity,
    })
      .done(function (response) {
        if (response.success) {
          updateCartCount(response.data.cart_count);
          showNotice(response.data.message, "success");
          if (response.data.fragments) {
            $.each(response.data.fragments, function (selector, html) {
              $(selector).replaceWith(html);
            });
          }
          $("#mc-sidebar").addClass("is-open");
          $("#mc-overlay").addClass("is-open");
          document.body.style.overflow = "hidden";
        } else {
          showNotice(
            response.data.message || "Could not add to cart.",
            "error",
          );
        }
      })
      .fail(function () {
        showNotice("Something went wrong. Please try again.", "error");
      })
      .always(function () {
        $btn.removeClass("loading").prop("disabled", false);
      });
  });

  // ── Helpers ────────────────────────────────────────────────────

  function updateCartCount(count) {
    const $icon = $(".cart-icon");
    let $badge = $icon.find(".cart-count");

    if (count > 0) {
      if ($badge.length) {
        // Already exists, just update the number
        $badge.text(count);
      } else {
        // Doesn't exist yet, create it
        $icon.append('<span class="cart-count">' + count + "</span>");
      }
    } else {
      // Cart is empty, remove the badge entirely
      $badge.remove();
    }
  }

  function showNotice(message, type) {
    const $notice = $(
      '<div class="mystore-cart-notice ' + type + '">' + message + "</div>",
    );

    // Remove any existing notice first
    $(".mystore-cart-notice").remove();

    $("body").append($notice);

    // Animate in
    setTimeout(() => $notice.addClass("visible"), 10);

    // Fade out after 3 s
    setTimeout(() => {
      $notice.removeClass("visible");
      setTimeout(() => $notice.remove(), 400);
    }, 3000);
  }
});
