<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!-- ── OVERLAY ── -->
<div class="mc-overlay" id="mc-overlay" aria-hidden="true"></div>

<!-- ── SIDEBAR ── -->
<div
    class="mc-sidebar"
    id="mc-sidebar"
    role="dialog"
    aria-modal="true"
    aria-label="<?php esc_attr_e( 'Your cart', 'mystore' ); ?>"
    aria-hidden="true"
>

    <!-- Header -->
    <div class="mc-header">
        <div class="mc-header-left">
            <span class="mc-title"><?php esc_html_e( 'Your Cart', 'mystore' ); ?></span>
            <?php
            $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
            ?>
            <span class="mc-count" id="mc-count"><?php echo esc_html( $count ); ?></span>
        </div>
        <button
            class="mc-close"
            id="mc-close"
            aria-label="<?php esc_attr_e( 'Close cart', 'mystore' ); ?>"
        >
            <?php echo mystore_icon( 'close', 20 ); ?>
        </button>
    </div>

    <!-- Items -->
    <div class="mc-body" id="mc-body">
        <?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>
            <ul class="mc-items" id="mc-items">
                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                    $product   = $cart_item['data'];
                    $quantity  = $cart_item['quantity'];
                    $thumbnail = $product->get_image( 'woocommerce_thumbnail' );
                    $name      = $product->get_name();
                    $price     = WC()->cart->get_product_price( $product );
                    $remove_url = wc_get_cart_remove_url( $cart_item_key );
                ?>
                    <li class="mc-item" data-key="<?php echo esc_attr( $cart_item_key ); ?>">
                        <div class="mc-item-img">
                            <?php echo $thumbnail; ?>
                        </div>
                        <div class="mc-item-info">
                            <span class="mc-item-name"><?php echo esc_html( $name ); ?></span>
                            <div class="mc-item-meta">
                                <span class="mc-item-qty">Qty: <?php echo esc_html( $quantity ); ?></span>
                                <span class="mc-item-price"><?php echo $price; ?></span>
                            </div>
                        </div>
                        <a
                            href="<?php echo esc_url( $remove_url ); ?>"
                            class="mc-item-remove"
                            aria-label="<?php echo esc_attr( sprintf( __( 'Remove %s', 'mystore' ), $name ) ); ?>"
                            data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
                            data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <div class="mc-empty" id="mc-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
                </svg>
                <p><?php esc_html_e( 'Your cart is empty', 'mystore' ); ?></p>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="mc-shop-link">
                    <?php esc_html_e( 'Browse Collection', 'mystore' ); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer — always in DOM, hidden via inline style when cart is empty -->
    <?php $footer_hidden = ( WC()->cart && WC()->cart->is_empty() ) ? ' style="display:none"' : ''; ?>
    <div class="mc-footer" id="mc-footer"<?php echo $footer_hidden; ?>>
        <div class="mc-subtotal">
            <span class="mc-subtotal-label"><?php esc_html_e( 'Subtotal', 'mystore' ); ?></span>
            <span class="mc-subtotal-amount" id="mc-subtotal">
                <?php echo WC()->cart ? WC()->cart->get_cart_subtotal() : ''; ?>
            </span>
        </div>
        <div class="mc-footer-actions">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mc-btn mc-btn--outline">
                <?php esc_html_e( 'View Cart', 'mystore' ); ?>
            </a>
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="mc-btn mc-btn--primary">
                <?php esc_html_e( 'Checkout', 'mystore' ); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>
    </div>

</div><!-- .mc-sidebar -->


<style>
/* ── Mini Cart Sidebar ────────────────────────────────────────── */
:root {
    --mc-width: 420px;
}

/* Overlay */
.mc-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(2px);
    z-index: 9998;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.35s ease;
}

.mc-overlay.is-open {
    opacity: 1;
    pointer-events: all;
}

/* Sidebar */
.mc-sidebar {
    position: fixed;
    top: 0;
    right: 0;
    width: min( var(--mc-width), 100vw );
    height: 100dvh;
    background: var(--color-surface);
    border-left: 1px solid var(--color-border);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    transform: translateX(100%);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: -8px 0 40px rgba(0, 0, 0, 0.4);
}

.mc-sidebar.is-open {
    transform: translateX(0);
}

/* Header */
.mc-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--color-border);
    flex-shrink: 0;
}

.mc-header-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.mc-title {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--color-text);
    letter-spacing: 0.02em;
}

.mc-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 22px;
    height: 22px;
    padding: 0 6px;
    background: var(--color-accent);
    color: #0d0d0d;
    font-family: var(--font-body);
    font-size: 0.72rem;
    font-weight: 700;
    border-radius: 999px;
    line-height: 1;
}

.mc-close {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: 1px solid var(--color-border);
    border-radius: 50%;
    background: transparent;
    color: var(--color-muted);
    cursor: pointer;
    transition: var(--transition);
    padding: 0;
}

.mc-close:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

/* Body / scroll area */
.mc-body {
    flex: 1;
    overflow-y: auto;
    padding: 1rem 1.5rem;
    scrollbar-width: thin;
    scrollbar-color: var(--color-border) transparent;
}

/* Items list */
.mc-items {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.mc-item {
    display: grid;
    grid-template-columns: 72px 1fr auto;
    gap: 1rem;
    align-items: start;
    padding-bottom: 1.25rem;
    border-bottom: 1px solid var(--color-border);
}

.mc-item:last-child {
    border-bottom: none;
}

.mc-item-img {
    width: 72px;
    height: 88px;
    border-radius: 8px;
    overflow: hidden;
    background: var(--color-bg);
    flex-shrink: 0;
}

.mc-item-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.mc-item-info {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    padding-top: 2px;
}

.mc-item-name {
    font-family: var(--font-body);
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--color-text);
    line-height: 1.4;
}

.mc-item-meta {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.mc-item-qty {
    font-family: var(--font-body);
    font-size: 0.78rem;
    color: var(--color-muted);
}

.mc-item-price {
    font-family: var(--font-body);
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--color-accent);
}

.mc-item-price .woocommerce-Price-amount {
    color: inherit;
}

.mc-item-remove {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    color: var(--color-muted);
    transition: var(--transition);
    flex-shrink: 0;
    margin-top: 2px;
    text-decoration: none;
}

.mc-item-remove:hover {
    color: #e05555;
    background: rgba(224, 85, 85, 0.1);
}

/* Empty state */
.mc-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    height: 100%;
    min-height: 300px;
    color: var(--color-muted);
    text-align: center;
}

.mc-empty svg {
    opacity: 0.2;
}

.mc-empty p {
    font-family: var(--font-body);
    font-size: 0.95rem;
    color: var(--color-muted);
    margin: 0;
}

.mc-shop-link {
    font-family: var(--font-body);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--color-accent);
    text-decoration: none;
    border-bottom: 1px solid rgba(232, 197, 71, 0.3);
    padding-bottom: 2px;
    transition: var(--transition);
}

.mc-shop-link:hover {
    border-color: var(--color-accent);
}

/* Footer */
.mc-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid var(--color-border);
    display: flex;
    flex-direction: column;
    gap: 1rem;
    flex-shrink: 0;
    background: var(--color-surface);
}

.mc-subtotal {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.mc-subtotal-label {
    font-family: var(--font-body);
    font-size: 0.82rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--color-muted);
}

.mc-subtotal-amount {
    font-family: var(--font-display);
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--color-text);
}

.mc-subtotal-amount .woocommerce-Price-amount {
    color: inherit;
}

.mc-footer-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.mc-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.8rem 1rem;
    border-radius: var(--radius);
    font-family: var(--font-body);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
}

.mc-btn--outline {
    background: transparent;
    color: var(--color-text);
    border: 1.5px solid var(--color-border);
}

.mc-btn--outline:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

.mc-btn--primary {
    background: var(--color-accent);
    color: #0d0d0d;
    border: 1.5px solid var(--color-accent);
}

.mc-btn--primary:hover {
    background: var(--color-accent-dk);
    border-color: var(--color-accent-dk);
}

/* Loading state */
.mc-body.is-loading {
    opacity: 0.5;
    pointer-events: none;
}

/* Cart icon bounce animation */
@keyframes mc-bounce {
    0%, 100% { transform: scale(1); }
    40%       { transform: scale(1.3); }
    70%       { transform: scale(0.9); }
}

.cart-icon.mc-bounce {
    animation: mc-bounce 0.4s ease;
}
</style>


