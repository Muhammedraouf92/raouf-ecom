<?php
/**
 * Template Name: Returns Policy
 *
 * @package Raouf
 */

get_header();
?>

<style>
/* ── Policy Page Shared ───────────────────────────────────────── */
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

/* ── Content area ── */
.policy-body {
    padding: clamp(3rem, 7vh, 5rem) 0 clamp(4rem, 8vh, 7rem);
    max-width: 860px;
    margin: 0 auto;
}

/* Language tabs */
.policy-lang-tabs {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 2.5rem;
    border-bottom: 1px solid var(--color-border);
    padding-bottom: 0;
}
.policy-lang-tab {
    padding: 0.55rem 1.25rem;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--color-muted);
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: color var(--transition), border-color var(--transition);
    margin-bottom: -1px;
    font-family: var(--font-body);
}
.policy-lang-tab.is-active {
    color: var(--color-accent);
    border-bottom-color: var(--color-accent);
}
.policy-lang-panel {
    display: none;
}
.policy-lang-panel.is-active {
    display: block;
}

/* Section cards */
.policy-section {
    margin-bottom: 1.5rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: 12px;
    overflow: hidden;
    transition: border-color var(--transition);
}
.policy-section:hover {
    border-color: rgba(232,197,71,0.25);
}
.policy-section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.4rem 1.75rem;
    border-bottom: 1px solid var(--color-border);
}
.policy-section-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(232,197,71,0.08);
    border: 1px solid rgba(232,197,71,0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
}
.policy-section-title {
    font-family: var(--font-display);
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0;
}
.policy-section-body {
    padding: 1.5rem 1.75rem;
}
.policy-section-body p {
    color: var(--color-muted);
    font-size: 0.95rem;
    line-height: 1.85;
    margin: 0 0 0.75rem;
}
.policy-section-body p:last-child {
    margin-bottom: 0;
}

/* Highlight callout */
.policy-callout {
    margin-top: 1rem;
    padding: 1rem 1.25rem;
    background: rgba(232,197,71,0.06);
    border: 1px solid rgba(232,197,71,0.18);
    border-radius: var(--radius);
    display: flex;
    gap: 0.75rem;
    align-items: flex-start;
}
.policy-callout-icon {
    flex-shrink: 0;
    color: var(--color-accent);
    margin-top: 2px;
}
.policy-callout p {
    color: var(--color-text) !important;
    font-size: 0.88rem !important;
    font-weight: 500;
    margin: 0 !important;
    line-height: 1.65 !important;
}

/* RTL panel */
.policy-lang-panel[dir="rtl"] .policy-section-header {
    flex-direction: row-reverse;
}
.policy-lang-panel[dir="rtl"] .policy-callout {
    flex-direction: row-reverse;
    text-align: right;
}
.policy-lang-panel[dir="rtl"] .policy-section-body p {
    font-size: 1rem;
    line-height: 2;
}
</style>

<!-- ── Banner ── -->
<section class="policy-banner">
    <div class="container">
        <p class="policy-banner-eyebrow">Reham Ali</p>
        <h1>Returns &amp; <em>Shipping</em></h1>
        <p class="policy-banner-meta">سياسة الاسترجاع والشحن &nbsp;·&nbsp; Last updated <?php echo date('F Y'); ?></p>
    </div>
</section>

<hr class="policy-divider">

<!-- ── Body ── -->
<div class="container">
    <div class="policy-body">

        <!-- Language tabs -->
        <div class="policy-lang-tabs" role="tablist" aria-label="Language">
            <button class="policy-lang-tab is-active" role="tab" data-target="en" aria-selected="true">English</button>
            <button class="policy-lang-tab" role="tab" data-target="ar" aria-selected="false">العربية</button>
        </div>

        <!-- ── English panel ── -->
        <div class="policy-lang-panel is-active" id="policy-en" role="tabpanel">

            <!-- Returns & Exchange -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                        </svg>
                    </div>
                    <h2 class="policy-section-title">Return &amp; Exchange Policy</h2>
                </div>
                <div class="policy-section-body">
                    <p>
                        You may try on the item while the courier is waiting. We only accept returns or exchanges <strong style="color:var(--color-text)">at the time of delivery</strong>.
                    </p>
                    <p>
                        Unfortunately, once the courier has left, we will not be able to accept any returns or exchanges.
                    </p>
                    <div class="policy-callout">
                        <span class="policy-callout-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                            </svg>
                        </span>
                        <p>Please inspect your order carefully before the courier leaves — once they depart, no returns or exchanges will be accepted under any circumstances.</p>
                    </div>
                </div>
            </div>

            <!-- Shipping -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                        </svg>
                    </div>
                    <h2 class="policy-section-title">Shipping Policy</h2>
                </div>
                <div class="policy-section-body">
                    <p>
                        Orders are delivered within <strong style="color:var(--color-text)">2 – 6 working days</strong> from the date of purchase.
                    </p>
                    <p>
                        Delivery times may vary depending on your location. You will be contacted by our courier to arrange a suitable delivery time.
                    </p>
                </div>
            </div>

        </div><!-- #policy-en -->

        <!-- ── Arabic panel ── -->
        <div class="policy-lang-panel" id="policy-ar" role="tabpanel" dir="rtl">

            <!-- Returns & Exchange AR -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                        </svg>
                    </div>
                    <h2 class="policy-section-title">سياسة الاسترجاع والاستبدال</h2>
                </div>
                <div class="policy-section-body" style="text-align:right;">
                    <p>
                        يمكنك تجربة القطعة أثناء انتظار المندوب، ونقبل الاسترجاع أو الاستبدال فقط <strong style="color:var(--color-text)">في وقت الاستلام</strong>.
                    </p>
                    <p>
                        للأسف، لا يمكننا قبول أي طلبات استرجاع أو استبدال بعد مغادرة المندوب.
                    </p>
                    <div class="policy-callout">
                        <span class="policy-callout-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                            </svg>
                        </span>
                        <p>يرجى فحص طلبك بعناية قبل مغادرة المندوب — بعد مغادرته، لن يتم قبول أي استرجاع أو استبدال تحت أي ظرف.</p>
                    </div>
                </div>
            </div>

            <!-- Shipping AR -->
            <div class="policy-section">
                <div class="policy-section-header">
                    <div class="policy-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                        </svg>
                    </div>
                    <h2 class="policy-section-title">سياسة الشحن</h2>
                </div>
                <div class="policy-section-body" style="text-align:right;">
                    <p>
                        يتم التوصيل خلال <strong style="color:var(--color-text)">2 – 6 أيام عمل</strong> من تاريخ الشراء.
                    </p>
                    <p>
                        قد تختلف مواعيد التوصيل حسب موقعك. سيتواصل معك المندوب لتحديد موعد التسليم المناسب.
                    </p>
                </div>
            </div>

        </div><!-- #policy-ar -->

    </div>
</div>

<script>
(function () {
    const tabs = document.querySelectorAll('.policy-lang-tab');
    const panels = document.querySelectorAll('.policy-lang-panel');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            const target = this.dataset.target;

            tabs.forEach(function (t) {
                t.classList.remove('is-active');
                t.setAttribute('aria-selected', 'false');
            });
            panels.forEach(function (p) { p.classList.remove('is-active'); });

            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');
            document.getElementById('policy-' + target).classList.add('is-active');
        });
    });
})();
</script>

<?php get_footer(); ?>