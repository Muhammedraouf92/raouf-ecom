<?php
/**
 * Thankyou page – Raouf theme override
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<style>
/* ── Thank-You Page ──────────────────────────────────────────── */

/* Success banner */
.thankyou-banner {
    text-align: center;
    padding: clamp(3.5rem, 8vh, 6rem) 0 clamp(2rem, 4vh, 3rem);
}

.thankyou-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(45, 138, 78, 0.12);
    border: 2px solid rgba(45, 138, 78, 0.3);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    animation: thankyou-pop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}

@keyframes thankyou-pop {
    from { transform: scale(0.6); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}

.thankyou-icon svg {
    color: #5ecb84;
}

.thankyou-banner h1 {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 0.75rem;
    line-height: 1.15;
}

.thankyou-banner h1 em {
    font-style: italic;
    color: var(--color-accent);
}

.thankyou-banner-sub {
    font-size: 0.95rem;
    color: var(--color-muted);
    max-width: 44ch;
    margin: 0 auto 2rem;
    line-height: 1.75;
}

/* Failed state */
.thankyou-failed-banner {
    text-align: center;
    padding: clamp(3rem, 7vh, 5rem) 0 clamp(2rem, 4vh, 3rem);
}

.thankyou-failed-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(226, 85, 85, 0.1);
    border: 2px solid rgba(226, 85, 85, 0.3);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    color: #e25555;
}

.thankyou-failed-banner h1 {
    font-family: var(--font-display);
    font-size: clamp(1.8rem, 3.5vw, 2.6rem);
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 0.75rem;
}

.thankyou-failed-text {
    font-size: 0.92rem;
    color: var(--color-muted);
    margin-bottom: 2rem;
}

.thankyou-failed-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.thankyou-failed-actions .button {
    display: inline-block;
    padding: 0.8rem 2rem;
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-radius: var(--radius);
    text-decoration: none;
    transition: all var(--transition);
    cursor: pointer;
}

.thankyou-failed-actions .button.pay {
    background: var(--color-accent);
    color: #0d0d0d;
    border: none;
}

.thankyou-failed-actions .button.pay:hover {
    background: var(--color-accent-dk);
    transform: translateY(-2px);
}

/* Overview cards row */
.thankyou-overview {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 3rem;
}

.thankyou-overview-card {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 10px;
    padding: 1.1rem 1.25rem;
    text-align: center;
}

.thankyou-overview-label {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--color-muted);
    margin-bottom: 0.4rem;
}

.thankyou-overview-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--color-text);
    line-height: 1.3;
}

.thankyou-overview-value .woocommerce-Price-amount {
    color: var(--color-accent);
}

/* CTA buttons */
.thankyou-ctas {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 3.5rem;
}

.thankyou-cta-primary {
    display: inline-block;
    padding: 0.85rem 2.25rem;
    background: var(--color-accent);
    color: #0d0d0d;
    border-radius: var(--radius);
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    text-decoration: none;
    transition: background var(--transition), transform var(--transition);
}

.thankyou-cta-primary:hover {
    background: var(--color-accent-dk);
    transform: translateY(-2px);
}

.thankyou-cta-secondary {
    display: inline-block;
    padding: 0.85rem 2.25rem;
    background: transparent;
    color: var(--color-muted);
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    text-decoration: none;
    transition: all var(--transition);
}

.thankyou-cta-secondary:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

/* Divider */
.thankyou-divider {
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--color-border), transparent);
    border: none;
    margin: 0 0 3rem;
}

/* ── Order details section (rendered by WooCommerce hook) ──── */
.thankyou-details {
    max-width: 780px;
    margin: 0 auto;
    padding-bottom: clamp(4rem, 8vh, 6rem);
}

/* WooCommerce order-details table */
.woocommerce-order-details,
.woocommerce-customer-details {
    margin-bottom: 2.5rem;
}

.woocommerce-order-details__title,
.woocommerce-column__title {
    font-family: var(--font-display);
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 1rem;
    padding-bottom: 0.6rem;
    border-bottom: 1px solid var(--color-border);
}

.woocommerce-table--order-details {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.88rem;
}

.woocommerce-table--order-details thead th {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-muted);
    padding: 0.6rem 1rem;
    background: var(--color-surface);
    border-bottom: 1px solid var(--color-border);
    text-align: left;
}

.woocommerce-table--order-details thead th.product-total {
    text-align: right;
}

.woocommerce-table--order-details tbody td {
    padding: 0.85rem 1rem;
    border-bottom: 1px solid var(--color-border);
    color: var(--color-text);
    vertical-align: middle;
}

.woocommerce-table--order-details td.product-total {
    text-align: right;
    color: var(--color-accent);
    font-weight: 600;
}

.woocommerce-table--order-details tfoot tr th,
.woocommerce-table--order-details tfoot tr td {
    padding: 0.65rem 1rem;
    border-bottom: 1px solid var(--color-border);
    font-size: 0.85rem;
    color: var(--color-muted);
}

.woocommerce-table--order-details tfoot tr td {
    text-align: right;
}

.woocommerce-table--order-details tfoot .order-total th,
.woocommerce-table--order-details tfoot .order-total td {
    color: var(--color-text);
    font-size: 1rem;
    font-weight: 700;
    border-bottom: none;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.woocommerce-table--order-details tfoot .order-total td .woocommerce-Price-amount {
    color: var(--color-accent);
    font-size: 1.1rem;
}

/* Customer address columns */
.woocommerce-customer-details .woocommerce-columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.woocommerce-customer-details .woocommerce-column {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 10px;
    padding: 1.25rem;
}

.woocommerce-customer-details address {
    font-style: normal;
    font-size: 0.88rem;
    color: var(--color-muted);
    line-height: 1.85;
}

/* ── Responsive ─────────────────────────────────────────────── */
@media (max-width: 760px) {
    .thankyou-overview {
        grid-template-columns: 1fr 1fr;
    }
    .woocommerce-customer-details .woocommerce-columns {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .thankyou-overview {
        grid-template-columns: 1fr 1fr;
    }
    .thankyou-ctas {
        flex-direction: column;
        align-items: center;
    }
    .thankyou-cta-primary,
    .thankyou-cta-secondary {
        width: 100%;
        text-align: center;
    }
}
</style>

<div class="woocommerce-order">

    <?php if ( $order ) : ?>

        <?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <!-- ── Failed state ── -->
            <div class="thankyou-failed-banner">
                <div class="container">
                    <div class="thankyou-failed-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h1><?php esc_html_e( 'Payment Failed', 'mystore' ); ?></h1>
                    <p class="thankyou-failed-text">
                        <?php esc_html_e( 'Unfortunately your order could not be processed. Please try again or contact us if the issue persists.', 'mystore' ); ?>
                    </p>
                    <div class="thankyou-failed-actions">
                        <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay">
                            <?php esc_html_e( 'Try Again', 'mystore' ); ?>
                        </a>
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button">
                                <?php esc_html_e( 'My Account', 'mystore' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php else : ?>

            <!-- ── Success banner ── -->
            <div class="thankyou-banner">
                <div class="container">
                    <div class="thankyou-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <h1><?php esc_html_e( 'Thank You', 'mystore' ); ?> — <em><?php esc_html_e( 'Order Confirmed!', 'mystore' ); ?></em></h1>
                    <p class="thankyou-banner-sub">
                        <?php
                        if ( $order->get_billing_email() ) {
                            printf(
                                /* translators: %s: email address */
                                esc_html__( 'A confirmation email has been sent to %s. We\'ll let you know when your order is on its way.', 'mystore' ),
                                '<strong>' . esc_html( $order->get_billing_email() ) . '</strong>'
                            );
                        } else {
                            esc_html_e( 'A confirmation email has been sent to you. We\'ll let you know when your order is on its way.', 'mystore' );
                        }
                        ?>
                    </p>
                </div>
            </div>

            <!-- ── Overview cards ── -->
            <div class="container">
                <div class="thankyou-overview">

                    <div class="thankyou-overview-card">
                        <p class="thankyou-overview-label"><?php esc_html_e( 'Order', 'mystore' ); ?></p>
                        <p class="thankyou-overview-value">#<?php echo esc_html( $order->get_order_number() ); ?></p>
                    </div>

                    <div class="thankyou-overview-card">
                        <p class="thankyou-overview-label"><?php esc_html_e( 'Date', 'mystore' ); ?></p>
                        <p class="thankyou-overview-value"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></p>
                    </div>

                    <div class="thankyou-overview-card">
                        <p class="thankyou-overview-label"><?php esc_html_e( 'Total', 'mystore' ); ?></p>
                        <p class="thankyou-overview-value"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></p>
                    </div>

                    <div class="thankyou-overview-card">
                        <p class="thankyou-overview-label"><?php esc_html_e( 'Payment', 'mystore' ); ?></p>
                        <p class="thankyou-overview-value"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></p>
                    </div>

                </div>

                <!-- ── CTAs ── -->
                <div class="thankyou-ctas">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="thankyou-cta-primary">
                        <?php esc_html_e( 'Continue Shopping', 'mystore' ); ?>
                    </a>
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) . 'orders/' ); ?>" class="thankyou-cta-secondary">
                            <?php esc_html_e( 'View My Orders', 'mystore' ); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <hr class="thankyou-divider">

                <!-- ── Full order details (items + addresses) ── -->
                <div class="thankyou-details">
                    <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
                    <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
                </div>

            </div>

        <?php endif; ?>

    <?php else : ?>

        <!-- ── No order (direct page visit) ── -->
        <div class="thankyou-banner">
            <div class="container">
                <div class="thankyou-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <h1><?php esc_html_e( 'Thank You', 'mystore' ); ?> — <em><?php esc_html_e( 'Order Received!', 'mystore' ); ?></em></h1>
                <p class="thankyou-banner-sub">
                    <?php esc_html_e( 'Your order has been received. Check your email for confirmation details.', 'mystore' ); ?>
                </p>
                <div class="thankyou-ctas">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="thankyou-cta-primary">
                        <?php esc_html_e( 'Continue Shopping', 'mystore' ); ?>
                    </a>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>