<?php
/**
 * Checkout Page Template
 * @package Raouf
 */
get_header();
?>

<style>
/* ══════════════════════════════════════════════════════════════════
   CHECKOUT — BANNER
══════════════════════════════════════════════════════════════════ */
.checkout-banner {
    background: var(--color-surface);
    border-bottom: 1px solid var(--color-border);
    padding: 1.5rem 0;
}
.checkout-banner .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Logo / title */
.checkout-banner h1 {
    font-family: var(--font-display);
    font-size: clamp(1.25rem, 2.5vw, 1.6rem);
    font-weight: 700;
    color: var(--color-text);
    margin: 0;
    line-height: 1;
}
.checkout-banner h1 em {
    font-style: italic;
    color: var(--color-accent);
}

/* Step breadcrumb */
.checkout-steps {
    display: flex;
    align-items: center;
    gap: 0;
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}
.checkout-step {
    color: var(--color-muted);
    padding: 0.3rem 0.75rem;
    border: 1px solid transparent;
    border-radius: 2rem;
    transition: color 0.2s;
}
.checkout-step a { color: inherit; }
.checkout-step.is-active {
    color: var(--color-accent);
    border-color: rgba(232,197,71,0.25);
    background: rgba(232,197,71,0.06);
}
.checkout-step-sep {
    color: var(--color-border);
    font-size: 0.9rem;
    padding: 0 0.1rem;
}

/* ══════════════════════════════════════════════════════════════════
   PAGE WRAP
══════════════════════════════════════════════════════════════════ */
.checkout-wrap {
    padding: 2.5rem 0 5rem;
    min-height: 60vh;
}

/* ══════════════════════════════════════════════════════════════════
   PRE-FORM: NOTICES & LOGIN / COUPON TOGGLES
══════════════════════════════════════════════════════════════════ */
.woocommerce-notices-wrapper { margin-bottom: 1.5rem; }

.woocommerce-error,
.woocommerce-message {
    border-radius: var(--radius) !important;
    padding: 0.85rem 1.1rem 0.85rem 1.25rem !important;
    font-size: 0.85rem !important;
    list-style: none !important;
    margin: 0 0 1rem !important;
}
.woocommerce-error {
    background: rgba(226,85,85,0.07) !important;
    border: 1px solid rgba(226,85,85,0.2) !important;
    border-left: 3px solid #e25555 !important;
    color: #f08080 !important;
}
.woocommerce-message {
    background: rgba(45,138,78,0.07) !important;
    border: 1px solid rgba(45,138,78,0.2) !important;
    border-left: 3px solid #2d8a4e !important;
    color: #6fcf97 !important;
}

.woocommerce-form-login-toggle,
.woocommerce-form-coupon-toggle { margin-bottom: 0.6rem; }

.woocommerce-form-login-toggle .woocommerce-info,
.woocommerce-form-coupon-toggle .woocommerce-info {
    background: var(--color-surface) !important;
    border: 1px solid var(--color-border) !important;
    border-left: 3px solid var(--color-accent) !important;
    border-radius: var(--radius) !important;
    color: var(--color-muted) !important;
    padding: 0.7rem 1rem !important;
    font-size: 0.82rem !important;
    list-style: none !important;
    margin: 0 !important;
}
.woocommerce-form-login-toggle .woocommerce-info a,
.woocommerce-form-coupon-toggle .woocommerce-info a { color: var(--color-accent) !important; }

.woocommerce-form-login,
.woocommerce-form-coupon {
    background: var(--color-surface) !important;
    border: 1px solid var(--color-border) !important;
    border-radius: 10px !important;
    padding: 1.5rem !important;
    margin-bottom: 1.25rem !important;
}

/* ══════════════════════════════════════════════════════════════════
   MAIN CHECKOUT GRID  (2 columns: form | summary wrapper)
══════════════════════════════════════════════════════════════════ */
form.woocommerce-checkout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 2rem;
    align-items: start;
}

/* Sticky order summary wrapper */
.checkout-order-summary {
    position: sticky;
    top: 80px;
    display: flex;
    flex-direction: column;
}
.woocommerce-form__label-for-checkbox{
    width:100% !important;
}
.woocommerce-terms-and-conditions-wrapper p.form-row{
    margin:1rem 0 !important;
}
/* ══════════════════════════════════════════════════════════════════
   LEFT — BILLING FORM
══════════════════════════════════════════════════════════════════ */

.col2-set { display: flex; flex-direction: column; gap: 1.5rem; }
.col2-set .col-1,
.col2-set .col-2 { width: 100% !important; float: none !important; }

/* ── Billing card ─────────────────────────────────────────────── */
.woocommerce-billing-fields,
.woocommerce-shipping-fields,
.woocommerce-additional-fields {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    padding: 2rem;
}

.woocommerce-billing-fields > h3,
.woocommerce-shipping-fields > h3,
.woocommerce-additional-fields > h3 {
    font-family: var(--font-display);
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--color-border);
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.woocommerce-billing-fields > h3::before {
    content: '';
    display: inline-block;
    width: 3px;
    height: 1em;
    background: var(--color-accent);
    border-radius: 2px;
    flex-shrink: 0;
}

/* ── Form rows ────────────────────────────────────────────────── */
.woocommerce-checkout .form-row {
    position: relative;
    margin: 0 0 1.1rem !important;
    padding: 0 !important;
    float: none !important;
    clear: both !important;
    width: 100% !important;
    display: block !important;
}
.woocommerce-checkout .form-row:last-child { margin-bottom: 0 !important; }

/* Labels */
.woocommerce-checkout label {
    display: block !important;
    font-size: 0.68rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.12em !important;
    color: var(--color-muted) !important;
    margin-bottom: 0.45rem !important;
}
.woocommerce-checkout label .required {
    color: var(--color-accent) !important;
    text-decoration: none !important;
    margin-left: 1px;
}
.woocommerce-checkout #payment div.payment_box::before{
    display: none !important;
}
/* Inputs */
.woocommerce-checkout .input-text,
.woocommerce-checkout input[type="text"],
.woocommerce-checkout input[type="email"],
.woocommerce-checkout input[type="tel"],
.woocommerce-checkout input[type="number"],
.woocommerce-checkout input[type="password"],
.woocommerce-checkout textarea,
.woocommerce-checkout select {
    display: block !important;
    width: 100% !important;
    box-sizing: border-box !important;
    
    border: 1px solid var(--color-border) !important;
    border-radius: var(--radius) !important;
    color: var(--color-text) !important;
    font-family: var(--font-body) !important;
    font-size: 0.9rem !important;
    padding: 0.7rem 0.9rem !important;
    height: auto !important;
    box-shadow: none !important;
    outline: none !important;
    transition: border-color 0.18s ease, box-shadow 0.18s ease !important;
    -webkit-appearance: none !important;
    appearance: none !important;
}
.woocommerce-checkout .input-text:focus,
.woocommerce-checkout input[type="text"]:focus,
.woocommerce-checkout input[type="email"]:focus,
.woocommerce-checkout input[type="tel"]:focus,
.woocommerce-checkout input[type="password"]:focus,
.woocommerce-checkout textarea:focus,
.woocommerce-checkout select:focus {
    border-color: var(--color-accent) !important;
    box-shadow: 0 0 0 3px rgba(232,197,71,0.1) !important;
}
.woocommerce-checkout input::placeholder,
.woocommerce-checkout textarea::placeholder {
    color: #444 !important;
}

/* ── Select2 (state dropdown) ─────────────────────────────────── */
.woocommerce-checkout .select2-container {
    display: block !important;
    width: 100% !important;
}
.woocommerce-checkout .select2-container--default .select2-selection--single {
   
    border: 1px solid var(--color-border) !important;
    border-radius: var(--radius) !important;
    height: 42px !important;
    display: flex !important;
    align-items: center !important;
    transition: border-color 0.18s ease !important;
}
.woocommerce-checkout .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: var(--color-text) !important;
    padding: 0 0.9rem !important;
    font-size: 0.9rem !important;
    font-family: var(--font-body) !important;
    line-height: 42px !important;
}
.woocommerce-checkout .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 42px !important;
    right: 10px !important;
}
.woocommerce-checkout .select2-container--default .select2-selection__arrow b {
    border-color: var(--color-muted) transparent transparent !important;
}
.woocommerce-checkout .select2-container--default.select2-container--open .select2-selection--single {
    border-color: var(--color-accent) !important;
    box-shadow: 0 0 0 3px rgba(232,197,71,0.1) !important;
}
.select2-dropdown {
    background: #1a1a1a !important;
    border: 1px solid var(--color-border) !important;
    border-radius: var(--radius) !important;
    box-shadow: 0 12px 32px rgba(0,0,0,0.4) !important;
}
.select2-results__option {
    color: var(--color-muted) !important;
    font-size: 0.875rem !important;
    font-family: var(--font-body) !important;
    padding: 0.55rem 0.9rem !important;
    transition: background 0.12s !important;
}
.select2-results__option--highlighted,
.select2-results__option[aria-selected="true"] {
    background: rgba(232,197,71,0.1) !important;
    color: var(--color-accent) !important;
}
.select2-search--dropdown { padding: 0.5rem !important; }
.select2-search--dropdown .select2-search__field {
    background: var(--color-bg) !important;
    border: 1px solid var(--color-border) !important;
    border-radius: var(--radius) !important;
    color: var(--color-text) !important;
    padding: 0.4rem 0.7rem !important;
    font-family: var(--font-body) !important;
    font-size: 0.875rem !important;
    outline: none !important;
}

/* ── Country locked (Egypt read-only) ─────────────────────────── */
#billing_country_field { display: none !important; }

.mystore-country-static .input-text,
.mystore-country-static input[type="text"] {
    background: rgba(232,197,71,0.04) !important;
    border-color: rgba(232,197,71,0.15) !important;
    color: var(--color-accent) !important;
    cursor: default !important;
    opacity: 1 !important;
    font-weight: 500 !important;
    letter-spacing: 0.02em !important;
}

/* ── Validation ───────────────────────────────────────────────── */
.woocommerce-checkout .form-row.woocommerce-invalid .input-text,
.woocommerce-checkout .form-row.woocommerce-invalid input,
.woocommerce-checkout .form-row.woocommerce-invalid select,
.woocommerce-checkout .form-row.woocommerce-invalid .select2-selection {
    border-color: #e25555 !important;
}
.woocommerce-checkout .form-row.woocommerce-validated .input-text,
.woocommerce-checkout .form-row.woocommerce-validated input {
    border-color: #2d8a4e !important;
}
.woocommerce-invalid-required-field label::after {
    content: " — required";
    color: #e25555;
    font-size: 0.67rem;
    text-transform: none;
    letter-spacing: 0;
    font-weight: 400;
}

/* ── Checkbox ─────────────────────────────────────────────────── */
.woocommerce-checkout .woocommerce-form__label-for-checkbox {
    display: flex !important;
    align-items: center !important;
    gap: 0.6rem !important;
    font-size: 0.85rem !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    color: var(--color-muted) !important;
    cursor: pointer;
}
.woocommerce-checkout input[type="checkbox"] {
    width: 15px !important;
    height: 15px !important;
    accent-color: var(--color-accent) !important;
    padding: 0 !important;
    flex-shrink: 0;
}

/* ══════════════════════════════════════════════════════════════════
   RIGHT — ORDER SUMMARY
══════════════════════════════════════════════════════════════════ */
#order_review_heading {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0;
    padding: 1.1rem 1.4rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-bottom: none;
    border-radius: 12px 12px 0 0;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
#order_review_heading::before {
    content: '';
    display: inline-block;
    width: 3px;
    height: 1em;
    background: var(--color-accent);
    border-radius: 2px;
    flex-shrink: 0;
}

#order_review {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-top: none;
    border-radius: 0 0 12px 12px;
    overflow: hidden;
}

/* ── Order items table ────────────────────────────────────────── */
.woocommerce-checkout-review-order-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.82rem;
}
.woocommerce-checkout-review-order-table thead th {
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--color-muted);
    padding: 0.65rem 1.4rem;
    border-bottom: 1px solid var(--color-border);
    text-align: left;
    background: rgba(255,255,255,0.02);
}
.woocommerce-checkout-review-order-table thead th.product-total { text-align: right; }

.woocommerce-checkout-review-order-table tbody tr { transition: background 0.15s; }
.woocommerce-checkout-review-order-table tbody tr:hover { background: rgba(255,255,255,0.02); }

.woocommerce-checkout-review-order-table tbody td {
    padding: 0.85rem 1.4rem;
    border-bottom: 1px solid var(--color-border);
    vertical-align: middle;
}
.woocommerce-checkout-review-order-table td.product-name {
    color: var(--color-text);
    font-size: 0.85rem;
    line-height: 1.4;
}
.woocommerce-checkout-review-order-table td.product-name .product-quantity {
    display: block;
    color: var(--color-muted);
    font-size: 0.75rem;
    margin-top: 0.15rem;
}
.woocommerce-checkout-review-order-table td.product-total {
    color: var(--color-accent);
    font-weight: 600;
    text-align: right;
    white-space: nowrap;
}

/* Totals */
.woocommerce-checkout-review-order-table tfoot tr td,
.woocommerce-checkout-review-order-table tfoot tr th {
    padding: 0.55rem 1.4rem;
    border-bottom: 1px solid var(--color-border);
    font-size: 0.8rem;
    color: var(--color-muted);
}
.woocommerce-checkout-review-order-table tfoot td { text-align: right; }

.woocommerce-checkout-review-order-table tfoot .order-total th,
.woocommerce-checkout-review-order-table tfoot .order-total td {
    color: var(--color-text);
    font-size: 0.95rem;
    font-weight: 700;
    border-bottom: none;
    padding-top: 0.9rem;
    padding-bottom: 0.9rem;
}
.woocommerce-checkout-review-order-table tfoot .order-total td .woocommerce-Price-amount {
    color: var(--color-accent);
    font-size: 1.05rem;
}

/* ── Payment methods ──────────────────────────────────────────── */
#payment { background: transparent !important; padding: 0 !important; }

.wc_payment_methods {
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
    border-top: 1px solid var(--color-border) !important;
}
.wc_payment_methods li.wc_payment_method {
    border-bottom: 1px solid var(--color-border) !important;
    padding: 0 !important;
    background: transparent !important;
    transition: background 0.15s !important;
}
.wc_payment_methods li.wc_payment_method:hover {
    background: rgba(255,255,255,0.02) !important;
}
.wc_payment_methods li.wc_payment_method > label {
    display: flex !important;
    align-items: center !important;
    gap: 0.6rem !important;
    font-size: 0.83rem !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    color: var(--color-text) !important;
    font-weight: 500 !important;
    cursor: pointer;
    padding: 0.9rem 1.4rem !important;
    margin: 0 !important;
}
.wc_payment_methods li.wc_payment_method label img {
    height: 20px !important;
    width: auto !important;
    opacity: 0.85;
}
.wc_payment_methods input[type="radio"] {
    accent-color: var(--color-accent) !important;
    width: 14px !important;
    height: 14px !important;
    padding: 0 !important;
    flex-shrink: 0;
}
.payment_box {
    background: rgba(232,197,71,0.03) !important;
    border-top: 1px solid var(--color-border) !important;
    padding: 0.75rem 1.4rem !important;
    margin: 0 !important;
    font-size: 0.8rem !important;
    color: var(--color-muted) !important;
    line-height: 1.6 !important;
}

/* Privacy */
.woocommerce-privacy-policy-text {
    font-size: 0.68rem !important;
    color: var(--color-muted) !important;
    text-align: center;
    padding: 0.75rem 1.4rem 0 !important;
    margin: 0 !important;
    opacity: 0.7;
}
.woocommerce-privacy-policy-text a { color: var(--color-accent) !important; opacity: 1; }

/* ── Place Order button ───────────────────────────────────────── */
.form-row.place-order {
    padding: 1rem 1.4rem 1.4rem !important;
    margin: 0 !important;
    background: var(--color-surface) !important;
}
#place_order {
    display: block !important;
    width: 100% !important;
    background: var(--color-accent) !important;
    color: #0d0d0d !important;
    border: none !important;
    border-radius: var(--radius) !important;
    padding: 0.9rem 1.5rem !important;
    font-family: var(--font-body) !important;
    font-size: 0.78rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.14em !important;
    cursor: pointer !important;
    transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease !important;
    box-shadow: 0 4px 16px rgba(232,197,71,0.2) !important;
}
#place_order:hover {
    background: var(--color-accent-dk) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 20px rgba(232,197,71,0.3) !important;
}
#place_order:active {
    transform: translateY(0) !important;
}

/* ══════════════════════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════════════════════ */
@media (max-width: 880px) {
    form.woocommerce-checkout {
        display: block;
    }
    .checkout-order-summary {
        position: static;
        margin-top: 2rem;
    }
}
@media (max-width: 600px) {
    .checkout-wrap { padding: 1.5rem 0 3rem; }
    .woocommerce-billing-fields,
    .woocommerce-shipping-fields,
    .woocommerce-additional-fields { padding: 1.25rem; }
    .checkout-steps { display: none; }
}
</style>

<!-- ── Banner ── -->
<div class="checkout-banner">
    <div class="container">
        <h1>Secure <em>Checkout</em></h1>
        <nav class="checkout-steps" aria-label="<?php esc_attr_e( 'Checkout steps', 'mystore' ); ?>">
            <span class="checkout-step"><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" style="color:inherit;"><?php esc_html_e( 'Cart', 'mystore' ); ?></a></span>
            <span class="checkout-step-sep">›</span>
            <span class="checkout-step is-active"><?php esc_html_e( 'Checkout', 'mystore' ); ?></span>
            <span class="checkout-step-sep">›</span>
            <span class="checkout-step"><?php esc_html_e( 'Confirmation', 'mystore' ); ?></span>
        </nav>
    </div>
</div>

<!-- ── Checkout content ── -->
<div class="checkout-wrap">
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>
</div>

<?php get_footer(); ?>