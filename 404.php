<?php
/**
 * 404 Template
 * @package Raouf
 */
get_header();
?>

<style>
/* ── 404 Page ────────────────────────────────────────────────── */
.error404-wrap {
    min-height: 70vh;
    display: flex;
    align-items: center;
    padding: clamp(4rem, 10vh, 7rem) 0;
}

.error404-inner {
    text-align: center;
    max-width: 560px;
    margin: 0 auto;
}

/* Big decorative number */
.error404-number {
    font-family: var(--font-display);
    font-size: clamp(8rem, 20vw, 14rem);
    font-weight: 700;
    line-height: 1;
    letter-spacing: -0.04em;
    background: linear-gradient(180deg, var(--color-accent) 0%, transparent 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    opacity: 0.35;
    user-select: none;
    margin-bottom: -0.25em;
}

.error404-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--color-accent);
    margin-bottom: 1rem;
}

.error404-eyebrow::before,
.error404-eyebrow::after {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--color-accent);
}

.error404-heading {
    font-family: var(--font-display);
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--color-text);
    line-height: 1.15;
    margin: 0 0 1rem;
}

.error404-heading em {
    font-style: italic;
    color: var(--color-accent);
}

.error404-sub {
    font-size: 0.95rem;
    color: var(--color-muted);
    line-height: 1.75;
    margin: 0 auto 2.5rem;
    max-width: 38ch;
}

/* Actions */
.error404-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 3rem;
}

.error404-btn-primary {
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

.error404-btn-primary:hover {
    background: var(--color-accent-dk);
    transform: translateY(-2px);
}

.error404-btn-secondary {
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

.error404-btn-secondary:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

/* Quick links */
.error404-links-label {
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.14em;
    color: var(--color-muted);
    margin-bottom: 0.85rem;
}

.error404-links {
    display: flex;
    gap: 0.6rem;
    justify-content: center;
    flex-wrap: wrap;
}

.error404-link {
    display: inline-block;
    padding: 0.4rem 1rem;
    border: 1px solid var(--color-border);
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 500;
    color: var(--color-muted);
    text-decoration: none;
    letter-spacing: 0.04em;
    transition: all var(--transition);
}

.error404-link:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

@media (max-width: 480px) {
    .error404-actions {
        flex-direction: column;
        align-items: stretch;
    }
    .error404-btn-primary,
    .error404-btn-secondary {
        text-align: center;
    }
}
</style>

<div class="error404-wrap">
    <div class="container">
        <div class="error404-inner">

            <div class="error404-number" aria-hidden="true">404</div>

            <p class="error404-eyebrow"><?php esc_html_e( 'Page not found', 'mystore' ); ?></p>

            <h1 class="error404-heading">
                <?php esc_html_e( 'Lost in', 'mystore' ); ?> <em><?php esc_html_e( 'the Collection?', 'mystore' ); ?></em>
            </h1>

            <p class="error404-sub">
                <?php esc_html_e( 'The page you\'re looking for has moved, been removed, or never existed. Let\'s get you back on track.', 'mystore' ); ?>
            </p>

            <div class="error404-actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error404-btn-primary">
                    <?php esc_html_e( 'Back to Home', 'mystore' ); ?>
                </a>
                <?php if ( function_exists( 'wc_get_page_id' ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="error404-btn-secondary">
                        <?php esc_html_e( 'Browse the Shop', 'mystore' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Quick links -->
            <p class="error404-links-label"><?php esc_html_e( 'Or go to', 'mystore' ); ?></p>
            <div class="error404-links">
                <?php if ( function_exists( 'wc_get_page_id' ) ) : ?>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ); ?>" class="error404-link">
                        <?php esc_html_e( 'Cart', 'mystore' ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="error404-link">
                        <?php esc_html_e( 'My Account', 'mystore' ); ?>
                    </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="error404-link">
                    <?php esc_html_e( 'Contact Us', 'mystore' ); ?>
                </a>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>