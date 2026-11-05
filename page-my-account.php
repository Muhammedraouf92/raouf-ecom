<?php
/**
 * My Account Page Template
 * @package Raouf
 */
get_header();
?>

<style>
/* ── My Account Banner ───────────────────────────────────────── */
.myaccount-banner {
    padding: clamp(2.5rem, 6vh, 4.5rem) 0 clamp(1.5rem, 3vh, 2.5rem);
    border-bottom: 1px solid var(--color-border);
}
.myaccount-banner .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}
.myaccount-banner h1 {
    font-family: var(--font-display);
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 700;
    color: var(--color-text);
    line-height: 1.1;
    margin: 0;
}
.myaccount-banner h1 em {
    font-style: italic;
    color: var(--color-accent);
}
.myaccount-banner-greeting {
    font-size: 0.85rem;
    color: var(--color-muted);
}
.myaccount-banner-greeting strong {
    color: var(--color-accent);
    font-weight: 600;
}

/* ── Layout ─────────────────────────────────────────────────── */
.myaccount-wrap {
    padding: clamp(2.5rem, 5vh, 4rem) 0 clamp(4rem, 8vh, 6rem);
}
.myaccount-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.5rem;
    align-items: start;
}

/* ── Sidebar Nav ─────────────────────────────────────────────── */
.woocommerce-MyAccount-navigation {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    overflow: hidden;
    position: sticky;
    top: 90px;
}
.woocommerce-MyAccount-navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.woocommerce-MyAccount-navigation ul li {
    border-bottom: 1px solid var(--color-border);
}
.woocommerce-MyAccount-navigation ul li:last-child {
    border-bottom: none;
}
.woocommerce-MyAccount-navigation ul li a {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.85rem 1.25rem;
    font-size: 0.82rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--color-muted);
    transition: color var(--transition), background var(--transition);
    text-decoration: none;
}
.woocommerce-MyAccount-navigation ul li a:hover {
    color: var(--color-text);
    background: rgba(255,255,255,0.03);
}
.woocommerce-MyAccount-navigation ul li.is-active a {
    color: var(--color-accent);
    background: rgba(232, 197, 71, 0.06);
    border-left: 2px solid var(--color-accent);
}
/* logout link subtle red tint */
.woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--customer-logout a {
    color: #8a4444;
}
.woocommerce-MyAccount-navigation ul li.woocommerce-MyAccount-navigation-link--customer-logout a:hover {
    color: #e25555;
    background: rgba(226,85,85,0.05);
}

/* ── Content area ────────────────────────────────────────────── */
.woocommerce-MyAccount-content {
    min-width: 0;
}

/* ── Dashboard welcome ───────────────────────────────────────── */
.woocommerce-MyAccount-content .woocommerce-notice--info,
.woocommerce-MyAccount-content > p:first-child {
    font-size: 0.92rem;
    color: var(--color-muted);
    line-height: 1.75;
    margin-bottom: 1.5rem;
}
.woocommerce-MyAccount-content > p a {
    color: var(--color-accent);
    text-decoration: none;
}
.woocommerce-MyAccount-content > p a:hover {
    text-decoration: underline;
}

/* Section headings inside content */
.woocommerce-MyAccount-content h2,
.woocommerce-MyAccount-content h3 {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 1.25rem;
    padding-bottom: 0.65rem;
    border-bottom: 1px solid var(--color-border);
}

/* ── Orders table ────────────────────────────────────────────── */
.woocommerce-orders-table,
.woocommerce-MyAccount-content table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.87rem;
}
.woocommerce-orders-table th,
.woocommerce-MyAccount-content table th {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-muted);
    padding: 0.65rem 1rem;
    background: var(--color-surface);
    border-bottom: 1px solid var(--color-border);
    text-align: left;
}
.woocommerce-orders-table td,
.woocommerce-MyAccount-content table td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid var(--color-border);
    color: var(--color-text);
    vertical-align: middle;
}
.woocommerce-orders-table tr:last-child td,
.woocommerce-MyAccount-content table tr:last-child td {
    border-bottom: none;
}
.woocommerce-orders-table td a,
.woocommerce-MyAccount-content table td a {
    color: var(--color-accent);
    text-decoration: none;
    font-weight: 500;
}
.woocommerce-orders-table td a:hover {
    text-decoration: underline;
}

/* Order status badges */
.woocommerce-orders-table__cell-order-status mark,
mark.order-status {
    background: transparent !important;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    padding: 0.25rem 0.65rem;
    border-radius: 999px;
    display: inline-block;
}
mark.order-status.status-completed,
.status-completed mark {
    background: rgba(45,138,78,0.15) !important;
    color: #5ecb84 !important;
}
mark.order-status.status-processing,
.status-processing mark {
    background: rgba(232,197,71,0.12) !important;
    color: var(--color-accent) !important;
}
mark.order-status.status-on-hold,
.status-on-hold mark {
    background: rgba(255,165,0,0.12) !important;
    color: #ffa500 !important;
}
mark.order-status.status-cancelled,
.status-cancelled mark {
    background: rgba(226,85,85,0.12) !important;
    color: #e25555 !important;
}
mark.order-status.status-pending,
.status-pending mark {
    background: rgba(136,136,136,0.12) !important;
    color: var(--color-muted) !important;
}

/* View order button */
.woocommerce-orders-table .button,
.woocommerce-MyAccount-content .button {
    display: inline-block;
    padding: 0.4rem 0.9rem;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    border-radius: var(--radius);
    border: 1px solid var(--color-border);
    color: var(--color-muted) !important;
    text-decoration: none !important;
    transition: all var(--transition);
    background: transparent;
    cursor: pointer;
    font-family: var(--font-body);
}
.woocommerce-orders-table .button:hover,
.woocommerce-MyAccount-content .button:hover {
    border-color: var(--color-accent);
    color: var(--color-accent) !important;
    background: rgba(232,197,71,0.05);
}

/* ── Address blocks ──────────────────────────────────────────── */
.woocommerce-Addresses {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}
.woocommerce-Address {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    padding: 1.5rem;
}
.woocommerce-Address-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--color-border);
}
.woocommerce-Address-title h3 {
    font-size: 0.9rem !important;
    margin: 0 !important;
    padding: 0 !important;
    border: none !important;
}
.woocommerce-Address-title .edit {
    font-size: 0.72rem !important;
    padding: 0.3rem 0.75rem !important;
}
address {
    font-style: normal;
    font-size: 0.88rem;
    color: var(--color-muted);
    line-height: 1.8;
}

/* ── Account / Address Forms ─────────────────────────────────── */
.woocommerce-EditAccountForm,
.woocommerce-address-fields {
    display: flex;
    flex-direction: column;
    gap: 0;
}
.woocommerce-MyAccount-content .form-row {
    margin: 0 0 1.1rem !important;
    padding: 0 !important;
}
.woocommerce-MyAccount-content .form-row-first,
.woocommerce-MyAccount-content .form-row-last {
    width: calc(50% - 0.5rem) !important;
    float: none !important;
    display: inline-block !important;
    vertical-align: top;
}
.woocommerce-MyAccount-content .form-row-first {
    margin-right: 1rem !important;
}
.woocommerce-MyAccount-content label {
    display: block !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--color-muted) !important;
    margin-bottom: 0.45rem !important;
}
.woocommerce-MyAccount-content label .required {
    color: var(--color-accent) !important;
    text-decoration: none !important;
}
.woocommerce-MyAccount-content .input-text,
.woocommerce-MyAccount-content input[type="text"],
.woocommerce-MyAccount-content input[type="email"],
.woocommerce-MyAccount-content input[type="tel"],
.woocommerce-MyAccount-content input[type="password"],
.woocommerce-MyAccount-content select {
    width: 100% !important;
    background: var(--color-bg) !important;
    border: 1px solid var(--color-border) !important;
    border-radius: var(--radius) !important;
    color: var(--color-text) !important;
    font-family: var(--font-body) !important;
    font-size: 0.9rem !important;
    padding: 0.75rem 1rem !important;
    height: auto !important;
    box-shadow: none !important;
    transition: border-color var(--transition), box-shadow var(--transition) !important;
    outline: none !important;
    -webkit-appearance: none;
}
.woocommerce-MyAccount-content .input-text:focus,
.woocommerce-MyAccount-content input[type="text"]:focus,
.woocommerce-MyAccount-content input[type="email"]:focus,
.woocommerce-MyAccount-content input[type="tel"]:focus,
.woocommerce-MyAccount-content input[type="password"]:focus,
.woocommerce-MyAccount-content select:focus {
    border-color: var(--color-accent) !important;
    box-shadow: 0 0 0 3px rgba(232, 197, 71, 0.08) !important;
}
.woocommerce-MyAccount-content input::placeholder {
    color: #444 !important;
}

/* Select2 in forms */
.woocommerce-MyAccount-content .select2-container--default .select2-selection--single {
    background: var(--color-bg) !important;
    border: 1px solid var(--color-border) !important;
    border-radius: var(--radius) !important;
    height: 44px !important;
    display: flex !important;
    align-items: center !important;
}
.woocommerce-MyAccount-content .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: var(--color-text) !important;
    line-height: 44px !important;
    padding: 0 1rem !important;
    font-size: 0.9rem !important;
}
.woocommerce-MyAccount-content .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 44px !important;
    right: 10px !important;
}
.woocommerce-MyAccount-content .select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: var(--color-muted) transparent transparent !important;
}

/* Fieldset legend (password change section) */
.woocommerce-MyAccount-content fieldset {
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    padding: 1.25rem 1.25rem 0.5rem;
    margin: 1rem 0 1.1rem;
}
.woocommerce-MyAccount-content fieldset legend {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-muted);
    padding: 0 0.5rem;
}

/* Save button */
.woocommerce-MyAccount-content [type="submit"],
.woocommerce-MyAccount-content .woocommerce-Button {
    background: var(--color-accent) !important;
    color: #0d0d0d !important;
    border: none !important;
    border-radius: var(--radius) !important;
    padding: 0.85rem 2rem !important;
    font-family: var(--font-body) !important;
    font-size: 0.82rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: background var(--transition), transform var(--transition) !important;
    text-decoration: none !important;
    display: inline-block;
}
.woocommerce-MyAccount-content [type="submit"]:hover,
.woocommerce-MyAccount-content .woocommerce-Button:hover {
    background: var(--color-accent-dk) !important;
    transform: translateY(-2px);
}

/* ── Notices ─────────────────────────────────────────────────── */
.woocommerce-MyAccount-content .woocommerce-error,
.woocommerce-MyAccount-content .woocommerce-message,
.woocommerce-MyAccount-content .woocommerce-info {
    border-radius: var(--radius) !important;
    padding: 0.85rem 1.25rem !important;
    margin-bottom: 1.5rem !important;
    list-style: none !important;
    font-size: 0.88rem !important;
    border: 1px solid transparent !important;
}
.woocommerce-MyAccount-content .woocommerce-message {
    background: rgba(45,138,78,0.1) !important;
    border-color: rgba(45,138,78,0.25) !important;
    border-left: 3px solid #2d8a4e !important;
    color: #5ecb84 !important;
}
.woocommerce-MyAccount-content .woocommerce-error {
    background: rgba(226,85,85,0.1) !important;
    border-color: rgba(226,85,85,0.25) !important;
    border-left: 3px solid #e25555 !important;
    color: #e25555 !important;
}
.woocommerce-MyAccount-content .woocommerce-info {
    background: var(--color-surface) !important;
    border-color: var(--color-border) !important;
    border-left: 3px solid var(--color-accent) !important;
    color: var(--color-muted) !important;
}
.woocommerce-MyAccount-content .woocommerce-error a,
.woocommerce-MyAccount-content .woocommerce-message a,
.woocommerce-MyAccount-content .woocommerce-info a {
    color: var(--color-accent) !important;
}

/* ── Login / Register forms (logged-out state) ───────────────── */
.woocommerce-account:not(.logged-in) .woocommerce-MyAccount-content {
    display: none;
}
/* WooCommerce renders login+register as two .u-column divs */
.woocommerce > .col2-set {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}
.woocommerce > .col2-set .col-1,
.woocommerce > .col2-set .col-2 {
    width: 100% !important;
    float: none !important;
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    padding: 2rem;
}
.woocommerce-form-login h2,
.woocommerce-form-register h2 {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--color-border);
}
.woocommerce-form__label-for-checkbox {
    display: flex !important;
    align-items: center !important;
    gap: 0.6rem !important;
    font-size: 0.88rem !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    color: var(--color-muted) !important;
    font-weight: 400 !important;
    cursor: pointer;
}
.woocommerce-form__label-for-checkbox input[type="checkbox"] {
    width: 16px !important;
    height: 16px !important;
    accent-color: var(--color-accent) !important;
    padding: 0 !important;
    flex-shrink: 0;
}
.woocommerce-LostPassword a,
.woocommerce-privacy-policy-text a,
.woocommerce-form-register .woocommerce-privacy-policy-text {
    font-size: 0.8rem !important;
    color: var(--color-muted) !important;
}
.woocommerce-LostPassword a:hover {
    color: var(--color-accent) !important;
}

/* ── Order detail view ───────────────────────────────────────── */
.woocommerce-order-details__title,
.woocommerce-column__title {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--color-border);
}
.woocommerce-customer-details address {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    padding: 1.25rem;
}

/* ── Responsive ──────────────────────────────────────────────── */
@media (max-width: 860px) {
    .myaccount-layout {
        grid-template-columns: 1fr;
    }
    .woocommerce-MyAccount-navigation {
        position: static;
    }
    .woocommerce-MyAccount-navigation ul {
        display: flex;
        flex-wrap: wrap;
    }
    .woocommerce-MyAccount-navigation ul li {
        border-bottom: none;
        border-right: 1px solid var(--color-border);
    }
    .woocommerce-MyAccount-navigation ul li:last-child {
        border-right: none;
    }
    .woocommerce-MyAccount-navigation ul li a {
        padding: 0.7rem 1rem;
        font-size: 0.75rem;
    }
    .woocommerce-Addresses {
        grid-template-columns: 1fr;
    }
    .woocommerce > .col2-set {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .woocommerce-MyAccount-content .form-row-first,
    .woocommerce-MyAccount-content .form-row-last {
        width: 100% !important;
        display: block !important;
        margin-right: 0 !important;
    }
}
</style>

<!-- ── Banner ── -->
<div class="myaccount-banner">
    <div class="container">
        <h1>My <em>Account</em></h1>
        <?php if ( is_user_logged_in() ) : ?>
            <p class="myaccount-banner-greeting">
                <?php
                $current_user = wp_get_current_user();
                /* translators: %s: user display name */
                printf(
                    esc_html__( 'Welcome back, %s', 'mystore' ),
                    '<strong>' . esc_html( $current_user->display_name ) . '</strong>'
                );
                ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- ── Account content ── -->
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-layout">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>