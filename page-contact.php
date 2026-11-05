<?php
/**
 * Template Name: Contact Us
 *
 * @package Raouf
 */

get_header();
?>

<style>
/* ── Contact Page ─────────────────────────────────────────────── */

/* Banner */
.contact-banner {
    position: relative;
    padding: clamp(4rem, 10vh, 7rem) 0 clamp(3rem, 6vh, 5rem);
    text-align: center;
    overflow: hidden;
}

.contact-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 50% 0%, rgba(232,197,71,0.07) 0%, transparent 65%);
    pointer-events: none;
}

.contact-banner-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-family: var(--font-body);
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--color-accent);
    margin-bottom: 1.25rem;
}

.contact-banner-eyebrow::before,
.contact-banner-eyebrow::after {
    content: '';
    display: block;
    width: 28px;
    height: 1px;
    background: var(--color-accent);
}

.contact-banner h1 {
    font-family: var(--font-display);
    font-size: clamp(2.4rem, 5vw, 4rem);
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 1rem;
    line-height: 1.1;
}

.contact-banner h1 em {
    font-style: italic;
    color: var(--color-accent);
}

.contact-banner-sub {
    color: var(--color-muted);
    font-size: clamp(0.95rem, 1.2vw, 1.05rem);
    max-width: 44ch;
    margin: 0 auto;
    line-height: 1.75;
}

/* Divider line */
.contact-divider {
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--color-border), transparent);
    margin: 0;
    border: none;
}

/* ── Two-column layout ── */
.contact-layout {
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    gap: clamp(3rem, 6vw, 6rem);
    padding: clamp(4rem, 8vh, 6rem) 0;
    align-items: start;
}

/* ── Left: Info ── */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}

.contact-info-heading {
    font-family: var(--font-display);
    font-size: clamp(1.6rem, 2.5vw, 2.2rem);
    font-weight: 700;
    color: var(--color-text);
    line-height: 1.2;
    margin: 0;
}

.contact-info-heading em {
    font-style: italic;
    color: var(--color-accent);
}

.contact-info-body {
    color: var(--color-muted);
    font-size: 0.95rem;
    line-height: 1.85;
    margin: -1.5rem 0 0;
}

/* Info cards */
.contact-cards {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-card {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.1rem 1.25rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    transition: border-color var(--transition);
}

.contact-card:hover {
    border-color: rgba(232, 197, 71, 0.35);
}

.contact-card-icon {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: rgba(232, 197, 71, 0.1);
    border: 1px solid rgba(232, 197, 71, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
    margin-top: 1px;
}

.contact-card-label {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--color-muted);
    margin-bottom: 0.2rem;
}

.contact-card-value {
    font-size: 0.9rem;
    color: var(--color-text);
    line-height: 1.5;
}

.contact-card-value a {
    color: inherit;
    transition: color var(--transition);
}

.contact-card-value a:hover {
    color: var(--color-accent);
}

/* Social row */
.contact-social {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.contact-social-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border: 1px solid var(--color-border);
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    color: var(--color-muted);
    text-transform: uppercase;
    transition: all var(--transition);
}

.contact-social-link:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

/* ── Right: Form panel ── */
.contact-form-panel {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 16px;
    padding: clamp(2rem, 4vw, 3rem);
}

.contact-form-panel-heading {
    font-family: var(--font-display);
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 0.4rem;
}

.contact-form-panel-sub {
    font-size: 0.85rem;
    color: var(--color-muted);
    margin: 0 0 2rem;
    line-height: 1.6;
}

/* ── CF7 Form Styles ── */
.wpcf7-form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.wpcf7-form p {
    margin: 0;
}

/* Labels */
.wpcf7-form label,
.cf7-label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-muted);
    margin-bottom: 0.45rem;
}

/* Text, email, phone, URL inputs */
.wpcf7-form input[type="text"],
.wpcf7-form input[type="email"],
.wpcf7-form input[type="tel"],
.wpcf7-form input[type="url"],
.wpcf7-form input[type="number"],
.wpcf7-form select,
.wpcf7-form textarea {
    width: 100%;
    background: var(--color-bg);
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    color: var(--color-text);
    font-family: var(--font-body);
    font-size: 0.9rem;
    padding: 0.75rem 1rem;
    transition: border-color var(--transition), box-shadow var(--transition);
    outline: none;
    -webkit-appearance: none;
}

.wpcf7-form input[type="text"]:focus,
.wpcf7-form input[type="email"]:focus,
.wpcf7-form input[type="tel"]:focus,
.wpcf7-form input[type="url"]:focus,
.wpcf7-form input[type="number"]:focus,
.wpcf7-form select:focus,
.wpcf7-form textarea:focus {
    border-color: var(--color-accent);
    box-shadow: 0 0 0 3px rgba(232, 197, 71, 0.08);
}

.wpcf7-form input::placeholder,
.wpcf7-form textarea::placeholder {
    color: #444;
}

.wpcf7-form textarea {
    resize: vertical;
    min-height: 130px;
}

/* Two-col row inside form (name + email side by side) */
.cf7-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

/* Submit button */
.wpcf7-form input[type="submit"],
.wpcf7-submit {
    width: 100%;
    background: var(--color-accent);
    color: #0d0d0d;
    border: none;
    border-radius: var(--radius);
    padding: 0.9rem 2rem;
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: background var(--transition), transform var(--transition);
    margin-top: 0.25rem;
}

.wpcf7-form input[type="submit"]:hover,
.wpcf7-submit:hover {
    background: var(--color-accent-dk);
    transform: translateY(-2px);
}

/* Validation errors */
.wpcf7-not-valid-tip {
    font-size: 0.75rem;
    color: #e25555;
    margin-top: 0.3rem;
    display: block;
}

.wpcf7-form input.wpcf7-not-valid,
.wpcf7-form textarea.wpcf7-not-valid {
    border-color: #e25555;
}

/* Response output */
.wpcf7-response-output {
    margin-top: 0.5rem;
    padding: 0.75rem 1.1rem;
    border-radius: var(--radius);
    font-size: 0.85rem;
    border: none !important;
}

.wpcf7-mail-sent-ok {
    background: rgba(45, 138, 78, 0.15);
    color: #5ecb84;
    border-left: 3px solid #2d8a4e !important;
}

.wpcf7-mail-sent-ng,
.wpcf7-validation-errors,
.wpcf7-spam-blocked {
    background: rgba(226, 85, 85, 0.12);
    color: #e25555;
    border-left: 3px solid #e25555 !important;
}

/* ── Responsive ── */
@media (max-width: 860px) {
    .contact-layout {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 540px) {
    .cf7-row {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- ── Banner ── -->
<section class="contact-banner">
    <div class="container">
        <p class="contact-banner-eyebrow">Reham Ali</p>
        <h1>Let's <em>Talk</em></h1>
        <p class="contact-banner-sub">
            Have a question about an order, a style enquiry, or just want to say hello? We'd love to hear from you.
        </p>
    </div>
</section>

<hr class="contact-divider">

<!-- ── Main content ── -->
<section class="contact-section">
    <div class="container">
        <div class="contact-layout">

            <!-- LEFT: Contact info -->
            <div class="contact-info">

                <h2 class="contact-info-heading">
                    We're here<br><em>for you</em>
                </h2>

                <p class="contact-info-body">
                    Fill in the form and our team will get back to you within 24 hours. You can also reach us directly through any of the channels below.
                </p>

                <div class="contact-cards">

                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <?php echo mystore_icon( 'email', 17 ); ?>
                        </div>
                        <div>
                            <p class="contact-card-label">Email</p>
                            <p class="contact-card-value">
                                <a href="mailto:info@rehamali.com">info@rehamali.com</a>
                            </p>
                        </div>
                    </div>                                                   

                </div><!-- .contact-cards -->

                <!-- Social links -->
                <div class="contact-social">
                    <a href="https://www.instagram.com/rehamalifashion?igsh=OHZyeGRjdG5pbXg1&utm_source=qr" class="contact-social-link" aria-label="Instagram">
                       <?php echo mystore_icon( 'instagram', 14 ); ?>
                        Instagram
                    </a>
                   
                    <a href="https://www.facebook.com/share/1EQ4bkVuj8/?mibextid=wwXIfr" class="contact-social-link" aria-label="Facebook">
                        <?php echo mystore_icon( 'facebook', 14 ); ?>
                        Facebook
                    </a>
                </div>

            </div><!-- .contact-info -->

            <!-- RIGHT: Form -->
            <div class="contact-form-panel">
                <h3 class="contact-form-panel-heading">Send a Message</h3>
                <p class="contact-form-panel-sub">All fields marked are required. We reply within 24 hours.</p>

                <?php echo do_shortcode('[contact-form-7 id="4ff9a66" title="Contact form 1"]'); ?>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>