<?php
/**
 * Template Name: Privacy Policy
 *
 * @package Raouf
 */

get_header();
?>

<style>
/* ── Privacy Policy Page ──────────────────────────────────────── */
.policy-banner {
    position: relative;
    padding: clamp(4rem, 10vh, 7rem) 0 clamp(2.5rem, 5vh, 4rem);
    text-align: center;
    overflow: hidden;
}
.policy-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 50% 0%, rgba(232,197,71,0.06) 0%, transparent 60%);
    pointer-events: none;
}
.policy-banner-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--color-accent);
    margin-bottom: 1rem;
}
.policy-banner-eyebrow::before,
.policy-banner-eyebrow::after {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--color-accent);
}
.policy-banner h1 {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4.5vw, 3.4rem);
    font-weight: 700;
    color: var(--color-text);
    margin: 0 0 1rem;
    line-height: 1.1;
}
.policy-banner h1 em {
    font-style: italic;
    color: var(--color-accent);
}
.policy-banner-meta {
    font-size: 0.82rem;
    color: var(--color-muted);
}
.policy-divider {
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--color-border), transparent);
    border: none;
    margin: 0;
}

/* ── Content ── */
.policy-body {
    padding: clamp(3rem, 7vh, 5rem) 0 clamp(4rem, 8vh, 7rem);
    max-width: 800px;
    margin: 0 auto;
}

/* Intro card */
.policy-intro {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-left: 3px solid var(--color-accent);
    border-radius: var(--radius);
    padding: 1.25rem 1.5rem;
    margin-bottom: 2.5rem;
    color: var(--color-muted);
    font-size: 0.92rem;
    line-height: 1.8;
}

/* TOC */
.policy-toc {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    padding: 1.5rem 1.75rem;
    margin-bottom: 2.5rem;
}
.policy-toc-title {
    font-family: var(--font-body);
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--color-muted);
    margin-bottom: 1rem;
}
.policy-toc ol {
    list-style: none;
    counter-reset: toc;
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}
.policy-toc ol li {
    counter-increment: toc;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.policy-toc ol li::before {
    content: counter(toc, decimal-leading-zero);
    font-size: 0.7rem;
    color: var(--color-accent);
    font-weight: 700;
    flex-shrink: 0;
}
.policy-toc ol li a {
    font-size: 0.88rem;
    color: var(--color-muted);
    transition: color var(--transition);
}
.policy-toc ol li a:hover {
    color: var(--color-accent);
}

/* Section cards */
.policy-section {
    margin-bottom: 1.25rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    overflow: hidden;
    scroll-margin-top: 90px;
    transition: border-color var(--transition);
}
.policy-section:hover {
    border-color: rgba(232,197,71,0.2);
}
.policy-section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.75rem;
    border-bottom: 1px solid var(--color-border);
}
.policy-section-num {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(232,197,71,0.08);
    border: 1px solid rgba(232,197,71,0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--color-accent);
    font-family: var(--font-body);
}
.policy-section-title {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0;
}
.policy-section-body {
    padding: 1.4rem 1.75rem;
}
.policy-section-body p {
    color: var(--color-muted);
    font-size: 0.92rem;
    line-height: 1.85;
    margin: 0 0 0.85rem;
}
.policy-section-body p:last-child {
    margin-bottom: 0;
}
.policy-section-body ul {
    list-style: none;
    margin: 0.5rem 0 0.85rem;
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}
.policy-section-body ul li {
    color: var(--color-muted);
    font-size: 0.92rem;
    line-height: 1.75;
    padding-left: 1.1rem;
    position: relative;
}
.policy-section-body ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.6em;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: var(--color-accent);
}
.policy-section-body a {
    color: var(--color-accent);
    text-decoration: underline;
    text-underline-offset: 3px;
}

/* Contact callout at bottom */
.policy-contact-callout {
    margin-top: 2rem;
    padding: 1.5rem 1.75rem;
    background: rgba(232,197,71,0.05);
    border: 1px solid rgba(232,197,71,0.18);
    border-radius: 12px;
    text-align: center;
}
.policy-contact-callout p {
    color: var(--color-muted);
    font-size: 0.9rem;
    margin: 0 0 1rem;
}
.policy-contact-callout a.btn-outline {
    display: inline-flex;
}
</style>

<!-- ── Banner ── -->
<section class="policy-banner">
    <div class="container">
        <p class="policy-banner-eyebrow">Reham Ali</p>
        <h1>Privacy <em>Policy</em></h1>
        <p class="policy-banner-meta">Effective date: <?php echo date('F j, Y'); ?></p>
    </div>
</section>

<hr class="policy-divider">

<!-- ── Body ── -->
<div class="container">
    <div class="policy-body">

        <p class="policy-intro">
            At <strong>Reham Ali</strong>, we respect your privacy and are committed to protecting the personal information you share with us. This policy explains what data we collect, how we use it, and the choices you have.
        </p>

        <!-- Table of contents -->
        <div class="policy-toc">
            <p class="policy-toc-title">Contents</p>
            <ol>
                <li><a href="#pp-collect">Information We Collect</a></li>
                <li><a href="#pp-use">How We Use Your Information</a></li>
                <li><a href="#pp-share">Sharing of Information</a></li>
                <li><a href="#pp-cookies">Cookies</a></li>
                <li><a href="#pp-security">Data Security</a></li>
                <li><a href="#pp-rights">Your Rights</a></li>
                <li><a href="#pp-contact">Contact Us</a></li>
            </ol>
        </div>

        <!-- 1. Information We Collect -->
        <div class="policy-section" id="pp-collect">
            <div class="policy-section-header">
                <span class="policy-section-num">01</span>
                <h2 class="policy-section-title">Information We Collect</h2>
            </div>
            <div class="policy-section-body">
                <p>When you place an order or contact us, we may collect the following information:</p>
                <ul>
                    <li>Full name and contact details (phone number, email address)</li>
                    <li>Shipping address and delivery preferences</li>
                    <li>Order history and transaction details</li>
                    <li>Messages you send us through the contact form or social media</li>
                </ul>
                <p>We do not collect payment card details directly — payments are processed securely through trusted third-party payment providers.</p>
            </div>
        </div>

        <!-- 2. How We Use -->
        <div class="policy-section" id="pp-use">
            <div class="policy-section-header">
                <span class="policy-section-num">02</span>
                <h2 class="policy-section-title">How We Use Your Information</h2>
            </div>
            <div class="policy-section-body">
                <p>Your information is used solely to:</p>
                <ul>
                    <li>Process and fulfil your orders</li>
                    <li>Communicate order updates and delivery status</li>
                    <li>Respond to your enquiries and customer service requests</li>
                    <li>Improve our products and shopping experience</li>
                    <li>Send promotional updates (only if you have opted in)</li>
                </ul>
                <p>We will never use your data for purposes beyond what is listed above without your explicit consent.</p>
            </div>
        </div>

        <!-- 3. Sharing -->
        <div class="policy-section" id="pp-share">
            <div class="policy-section-header">
                <span class="policy-section-num">03</span>
                <h2 class="policy-section-title">Sharing of Information</h2>
            </div>
            <div class="policy-section-body">
                <p>We do not sell, rent, or trade your personal information. We may share limited data with:</p>
                <ul>
                    <li><strong style="color:var(--color-text)">Delivery couriers</strong> — only name, phone, and address needed to complete your order</li>
                    <li><strong style="color:var(--color-text)">Payment processors</strong> — to handle transactions securely</li>
                    <li><strong style="color:var(--color-text)">Legal authorities</strong> — only when required by law</li>
                </ul>
                <p>All third parties we work with are obligated to keep your information confidential.</p>
            </div>
        </div>

        <!-- 4. Cookies -->
        <div class="policy-section" id="pp-cookies">
            <div class="policy-section-header">
                <span class="policy-section-num">04</span>
                <h2 class="policy-section-title">Cookies</h2>
            </div>
            <div class="policy-section-body">
                <p>Our website uses cookies to enhance your browsing experience. Cookies are small text files stored on your device that help us:</p>
                <ul>
                    <li>Remember your cart contents between visits</li>
                    <li>Keep you logged in to your account</li>
                    <li>Understand how visitors use our site (analytics)</li>
                </ul>
                <p>You can disable cookies in your browser settings at any time. Note that some features of the store may not function correctly without them.</p>
            </div>
        </div>

        <!-- 5. Security -->
        <div class="policy-section" id="pp-security">
            <div class="policy-section-header">
                <span class="policy-section-num">05</span>
                <h2 class="policy-section-title">Data Security</h2>
            </div>
            <div class="policy-section-body">
                <p>We take reasonable measures to protect your personal information from unauthorised access, disclosure, or misuse. Our website uses SSL encryption (HTTPS) for all data transmitted between your browser and our servers.</p>
                <p>While we strive to protect your information, no method of transmission over the internet is 100% secure. We encourage you to use strong passwords and keep your account details confidential.</p>
            </div>
        </div>

        <!-- 6. Your Rights -->
        <div class="policy-section" id="pp-rights">
            <div class="policy-section-header">
                <span class="policy-section-num">06</span>
                <h2 class="policy-section-title">Your Rights</h2>
            </div>
            <div class="policy-section-body">
                <p>You have the right to:</p>
                <ul>
                    <li>Request access to the personal data we hold about you</li>
                    <li>Ask us to correct or delete your data</li>
                    <li>Opt out of marketing communications at any time</li>
                    <li>Request that we stop processing your data</li>
                </ul>
                <p>To exercise any of these rights, please contact us using the details below.</p>
            </div>
        </div>

        <!-- 7. Contact -->
        <div class="policy-section" id="pp-contact">
            <div class="policy-section-header">
                <span class="policy-section-num">07</span>
                <h2 class="policy-section-title">Contact Us</h2>
            </div>
            <div class="policy-section-body">
                <p>If you have any questions about this privacy policy or how we handle your data, please reach out:</p>
                <p>
                    <strong style="color:var(--color-text)">Email:</strong> <a href="mailto:hello@rehamali.com">hello@rehamali.com</a><br>
                    <strong style="color:var(--color-text)">Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a>
                </p>
            </div>
        </div>

        <!-- Bottom CTA -->
        <div class="policy-contact-callout">
            <p>Have a question not covered here? Our team is happy to help.</p>
            <a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>" class="btn btn-outline">Contact Us</a>
        </div>

    </div>
</div>

<?php get_footer(); ?>