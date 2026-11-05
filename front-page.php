<?php
/**
 * Front Page Template – Hero | Categories | Featured Products
 *
 * @package Raouf
 */

get_header();
?>
<style>
/* ── Hero ──────────────────────────────────────────────────────── */
.hero {
    position: relative;
    min-height: 90vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--color-bg);
    padding: clamp(2rem, 2vh, 4rem) 0;  
}

/* Grain overlay */
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    opacity: 0.95;
    pointer-events: none;
    z-index: 0;
}

/* Gold glow behind shapes */
.hero::after {
    content: '';
    position: absolute;
    right: 8%;
    top: 40%;
    transform: translateY(-50%);
    width: 500px;
    height: 500px;
    background: radial-gradient(ellipse at center, rgba(232,197,71,0.07) 0%, transparent 65%);
    pointer-events: none;
    z-index: 0;
}

.hero .container {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: var(--max-width);
    margin: 0 auto;
    padding: 0 var(--gutter);
}

.hero-inner {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(2rem, 5vw, 5rem);
    align-items: center;
}

/* ── LEFT: Text ─────────────────────────────────────────────────── */
.hero-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-family: var(--font-body);
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--color-accent);
    opacity: 0;
    animation: fadeUp 0.6s ease 0.1s forwards;
}

.hero-eyebrow::before {
    content: '';
    display: block;
    width: 32px;
    height: 1px;
    background: var(--color-accent);
}

.hero-heading {
    font-family: var(--font-display);
    font-size: clamp(2.8rem, 5.5vw, 5rem);
    font-weight: 700;
    line-height: 1.08;
    color: var(--color-text);
    margin: 0;
    opacity: 0;
    animation: fadeUp 0.6s ease 0.25s forwards;
}

.hero-heading em {
    font-style: italic;
    color: var(--color-accent);
}

.hero-body {
    font-family: var(--font-body);
    font-size: clamp(0.95rem, 1.2vw, 1.05rem);
    line-height: 1.75;
    color: var(--color-muted);
    max-width: 42ch;
    margin: 0;
    opacity: 0;
    animation: fadeUp 0.6s ease 0.4s forwards;
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 0.5rem;
    opacity: 0;
    animation: fadeUp 0.6s ease 0.55s forwards;
}

.hero-actions .btn {
    font-family: var(--font-body);
    font-size: 0.82rem;
    font-weight: 600;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.85rem 2rem;
    border-radius: var(--radius);
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.hero-actions .btn-primary {
    background: var(--color-accent);
    color: #0d0d0d;
    border: 2px solid var(--color-accent);
}

.hero-actions .btn-primary:hover {
    background: var(--color-accent-dk);
    border-color: var(--color-accent-dk);
    transform: translateY(-2px);
}

.hero-actions .btn-outline {
    background: transparent;
    color: var(--color-text);
    border: 2px solid var(--color-border);
}

.hero-actions .btn-outline:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
    transform: translateY(-2px);
}

/* ── RIGHT: Shapes ──────────────────────────────────────────────── */
.hero-shapes {
    position: relative;
    height: clamp(460px, 58vw, 620px);
}

.hero-shape {
    position: absolute;
    overflow: hidden;
    background: var(--color-surface);
    opacity: 0;
    animation: popIn 0.75s cubic-bezier(0.34, 1.4, 0.64, 1) forwards;
}

.hero-shape img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    display: block;
    transition: transform 0.6s ease;
}

.hero-shape:hover img {
    transform: scale(1.04);
}

.hero-shape-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent);
    opacity: 0.2;
}

/*
 * Shape 1 — tall portrait, rounded top-left corner dramatically
 * Dominant piece. Top-left. Main model shot.
 */
.hero-shape--1 {
    width: 46%;
    height: 72%;
    top: 0;
    left: 0;
    border-radius: 120px 20px 20px 20px;
    rotate: -3deg;
    z-index: 2;
    animation-delay: 0.3s;
    border: 1px solid var(--color-border);
}

/*
 * Shape 2 — wide landscape with asymmetric blob corners
 * Bottom-left, overlaps shape 1. Gold border — draws the eye.
 */
.hero-shape--2 {
    width: 54%;
    height: 44%;
    bottom: 0;
    left: 5%;
    border-radius: 20px 80px 20px 80px;
    rotate: 2deg;
    z-index: 3;
    animation-delay: 0.45s;
    border: 1px solid var(--color-accent);
    box-shadow: 0 0 0 1px rgba(232,197,71,0.06), 0 8px 40px rgba(0,0,0,0.4);
}

/*
 * Shape 3 — small square, one dramatically rounded corner
 * Top-right. Detail/accessory shot.
 */
.hero-shape--3 {
    width: 33%;
    height: 33%;
    top: 3%;
    right: 1%;
    border-radius: 8px 90px 8px 8px;
    rotate: 4deg;
    z-index: 2;
    animation-delay: 0.55s;
    border: 1px solid var(--color-border);
}

/*
 * Shape 4 — pill / stadium shape (fully rounded top, flat-ish bottom)
 * Bottom-right, partially behind shape 2. Secondary model shot.
 */
.hero-shape--4 {
    width: 37%;
    height: 56%;
    bottom: 1%;
    right: 1%;
    border-radius: 999px 999px 20px 20px;
    rotate: -2deg;
    z-index: 1;
    animation-delay: 0.65s;
    border: 1px solid var(--color-border);
}

/* Decorative accents */
.hero-deco-dot {
    position: absolute;
    border-radius: 50%;
    background: var(--color-accent);
    animation: fadeIn 1s ease forwards;
    opacity: 0;
}

.hero-deco-dot--1 {
    width: 6px;
    height: 6px;
    top: 37%;
    right: 36%;
    animation-delay: 1.1s;
}

.hero-deco-dot--2 {
    width: 3px;
    height: 3px;
    bottom: 27%;
    left: 57%;
    animation-delay: 1.2s;
}

.hero-deco-line {
    position: absolute;
    background: var(--color-border);
    opacity: 0;
    animation: fadeIn 1s ease 1s forwards;
}

.hero-deco-line--1 {
    width: 1px;
    height: 55px;
    top: 48%;
    right: 35%;
    transform: rotate(18deg);
}

/* ── Animations ─────────────────────────────────────────────────── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes popIn {
    from { opacity: 0; transform: scale(0.9) translateY(12px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

@keyframes fadeIn {
    to { opacity: 1; }
}

/* ── Responsive ─────────────────────────────────────────────────── */
@media ( max-width: 900px ) {
    .hero-inner {
        grid-template-columns: 1fr;
    }

    .hero-shapes {
        height: clamp(340px, 85vw, 480px);
        order: -1;
    }

    .hero-body {
        max-width: 100%;
    }
}

@media ( max-width: 480px ) {
    .hero-heading {
        font-size: clamp(2.2rem, 9vw, 3rem);
    }

    .hero-actions {
        flex-direction: column;
    }

    .hero-actions .btn {
        text-align: center;
        justify-content: center;
    }
}
</style>
<!-- =============================================
     HERO SECTION
     ============================================= -->
<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'mystore' ); ?>">
    <div class="container">
        <div class="hero-inner">

            <!-- ── LEFT: Text ── -->
            <div class="hero-content">

                <span class="hero-eyebrow">
                    <?php echo esc_html( get_theme_mod( 'mystore_hero_eyebrow', __( 'Style Without Limits', 'mystore' ) ) ); ?>
                </span>

                <h1 class="hero-heading">
                    <?php echo wp_kses_post( get_theme_mod( 'mystore_hero_heading', 'Discover Your&nbsp;<em>Style</em>' ) ); ?>
                </h1>

                <p class="hero-body">
                    <?php echo esc_html( get_theme_mod( 'mystore_hero_text', __( 'Explore our curated collection of premium products crafted with care and designed to last.', 'mystore' ) ) ); ?>
                </p>

                <div class="hero-actions">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary">
                        <?php esc_html_e( 'Shop Now', 'mystore' ); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url( get_theme_mod( 'mystore_hero_secondary_url', home_url( '#categories' ) ) ); ?>" class="btn btn-outline">
                        <?php esc_html_e( 'Browse Categories', 'mystore' ); ?>
                    </a>
                </div>

            </div>

            <!-- ── RIGHT: Shapes ── -->
            <div class="hero-shapes" aria-hidden="true">

                <?php
                $shapes = [
                    [ 'mod' => 'mystore_hero_circle_1', 'class' => 'hero-shape--1' ],
                    [ 'mod' => 'mystore_hero_circle_2', 'class' => 'hero-shape--2' ],
                    [ 'mod' => 'mystore_hero_circle_3', 'class' => 'hero-shape--3' ],
                    [ 'mod' => 'mystore_hero_circle_4', 'class' => 'hero-shape--4' ],
                ];

                foreach ( $shapes as $i => $shape ) :
                    $img_url = get_theme_mod( $shape['mod'], '' );
                ?>
                    <div class="hero-shape <?php echo esc_attr( $shape['class'] ); ?>">
                        <?php if ( $img_url ) : ?>
                            <img
                                src="<?php echo esc_url( $img_url ); ?>"
                                alt=""
                                loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
                                decoding="async"
                            >
                        <?php else : ?>
                            <div class="hero-shape-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="m3 9 4-4 4 4 4-6 4 6"/><circle cx="8.5" cy="13.5" r="1.5"/></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <!-- Decorative gold dots + line -->
                <div class="hero-deco-dot hero-deco-dot--1"></div>
                <div class="hero-deco-dot hero-deco-dot--2"></div>
                <div class="hero-deco-line hero-deco-line--1"></div>

            </div>

        </div>
    </div>
</section>

<!-- =============================================
     ABOUT SECTION
     ============================================= -->
<section class="about" aria-labelledby="about-heading">
    <div class="container">
        <div class="about-inner">

            <!-- ── LEFT: Image ── -->
            <div class="about-image-wrap">
                <div class="about-image-frame">
                    <?php
                    $about_image = get_theme_mod( 'mystore_hero_about', '' );
                    if ( $about_image ) : ?>
                        <img
                            src="<?php echo esc_url( $about_image ); ?>"
                            alt="<?php esc_attr_e( 'Reham Ali — About', 'mystore' ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    <?php else : ?>
                        <div class="about-img-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <path d="m21 15-5-5L5 21"/>
                            </svg>
                            <span>Your image here</span>
                        </div>
                    <?php endif; ?>
                </div>

                <span class="about-image-tag">Est. Reham Ali</span>
            </div>

            <!-- ── RIGHT: Text ── -->
            <div class="about-content">

                <span class="about-eyebrow">Our Story</span>

                <h2 class="about-heading" id="about-heading">
                    Modesty &amp; Fashion,<br><em>Hand in Hand</em>
                </h2>

                <hr class="about-divider">

                <p class="about-body">
                    At Reham Ali, we believe modesty and fashion go hand in hand. Our pieces are designed for the modern woman who values elegance, comfort, and confidence. Inspired by timeless cuts and breathable fabrics, our collections blend tradition with contemporary flair.
                </p>

                <!-- Stats / values row -->
                <div class="about-values">
                    <div class="about-value">
                        <span class="about-value-number">$$</span>
                        <span class="about-value-label">Unique Pieces</span>
                    </div>
                    <div class="about-value">
                        <span class="about-value-number">100%</span>
                        <span class="about-value-label">Modest Design</span>
                    </div>
                    <div class="about-value">
                        <span class="about-value-number">∞</span>
                        <span class="about-value-label">Timeless Style</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- =============================================
     WHY SHOP WITH US
     ============================================= -->
<section class="section why-us-section" aria-labelledby="why-us-heading">
    <div class="container">
        <div class="section-header" style="text-align:center;">
            <h2 class="section-title" id="why-us-heading"><?php esc_html_e( 'Why Shop With Us', 'mystore' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Everything we do is for you', 'mystore' ); ?></p>
        </div>

        <div class="why-us-grid">

            <div class="why-us-card">
                <div class="why-us-icon">
                   <?php echo mystore_icon( 'return', 26 ); ?>
                </div>
                <h3 class="why-us-title"><?php esc_html_e( 'Easy Returns', 'mystore' ); ?></h3>
                <p class="why-us-desc"><?php esc_html_e( 'Try on your order while the courier waits. Returns accepted on the spot, hassle-free.', 'mystore' ); ?></p>
            </div>

            <div class="why-us-card">
                <div class="why-us-icon">
                    <?php echo mystore_icon( 'delivery', 26 ); ?>
                </div>
                <h3 class="why-us-title"><?php esc_html_e( 'Fast Delivery', 'mystore' ); ?></h3>
                <p class="why-us-desc"><?php esc_html_e( 'Your order arrives within 2–6 working days. We keep you updated every step of the way.', 'mystore' ); ?></p>
            </div>

            <div class="why-us-card">
                <div class="why-us-icon">
                    <?php echo mystore_icon( 'star', 26 ); ?>
                </div>
                <h3 class="why-us-title"><?php esc_html_e( 'Modest Elegance', 'mystore' ); ?></h3>
                <p class="why-us-desc"><?php esc_html_e( 'Every piece is designed for the modern woman — timeless, comfortable, and beautifully modest.', 'mystore' ); ?></p>
            </div>

            <div class="why-us-card">
                <div class="why-us-icon">
                    <?php echo mystore_icon( 'correct', 26 ); ?>
                </div>
                <h3 class="why-us-title"><?php esc_html_e( 'Quality Fabrics', 'mystore' ); ?></h3>
                <p class="why-us-desc"><?php esc_html_e( 'We carefully select breathable, premium fabrics so every piece feels as good as it looks.', 'mystore' ); ?></p>
            </div>

        </div>
    </div>
</section>

<!-- =============================================
     CATEGORIES SECTION
     ============================================= -->
<section class="section" id="categories" aria-labelledby="categories-heading">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" id="categories-heading"><?php esc_html_e( 'Shop by Category', 'mystore' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Find exactly what you\'re looking for', 'mystore' ); ?></p>
        </div>

        <?php
        $categories = get_terms( [
            'taxonomy'   => 'product_cat',
            'orderby'    => 'count',
            'order'      => 'DESC',
            'hide_empty' => true,
            'number'     => 6,
            'exclude'    => [ get_option( 'default_product_cat' ) ],
        ] );

        if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) : ?>
            <div class="categories-grid">
                <?php foreach ( $categories as $category ) :
                    $thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
                    $thumbnail_url = $thumbnail_id
                        ? wp_get_attachment_image_url( $thumbnail_id, 'mystore-category' )
                        : wc_placeholder_img_src( 'mystore-category' );
                    $cat_link      = get_term_link( $category, 'product_cat' );
                    ?>
                    <a href="<?php echo esc_url( $cat_link ); ?>" class="category-card">
                        <img src="<?php echo esc_url( $thumbnail_url ); ?>"
                             alt="<?php echo esc_attr( $category->name ); ?>"
                             loading="lazy">
                        <div class="category-card-body">
                            <h3><?php echo esc_html( $category->name ); ?></h3>
                            <span>
                                <?php
                                printf(
                                    esc_html( _n( '%s product', '%s products', $category->count, 'mystore' ) ),
                                    number_format_i18n( $category->count )
                                );
                                ?>
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        <?php else : ?>
            <p class="no-content"><?php esc_html_e( 'No product categories found.', 'mystore' ); ?></p>
        <?php endif; ?>

    </div>
</section>

<!-- =============================================
     LOOKBOOK BANNER
     ============================================= -->
<?php $lookbook_img = get_theme_mod( 'mystore_lookbook_image', '' ); ?>
<section
    class="lookbook-banner"
    <?php if ( $lookbook_img ) : ?>style="--lookbook-bg: url('<?php echo esc_url( $lookbook_img ); ?>');"<?php endif; ?>
    aria-labelledby="lookbook-heading"
>
    <div class="lookbook-overlay"></div>
    <div class="container lookbook-inner">
        <span class="lookbook-eyebrow"><?php esc_html_e( 'New Collection', 'mystore' ); ?></span>
        <h2 class="lookbook-heading" id="lookbook-heading">
            <?php echo wp_kses_post( get_theme_mod( 'mystore_lookbook_heading', 'Style That <em>Speaks</em> for Itself' ) ); ?>
        </h2>
        <p class="lookbook-body">
            <?php echo esc_html( get_theme_mod( 'mystore_lookbook_text', 'Explore our latest looks — crafted for confidence, designed for every occasion.' ) ); ?>
        </p>
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="lookbook-cta">
            <?php esc_html_e( 'Shop the Collection', 'mystore' ); ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

<!-- =============================================
     FEATURED PRODUCTS SECTION
     ============================================= -->
<section class="section" style="background: var(--color-surface); margin-top: 0;" aria-labelledby="featured-heading">
    <div class="container">
        <div class="section-header" style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem;">
            <div>
                <h2 class="section-title" id="featured-heading"><?php esc_html_e( 'Featured Products', 'mystore' ); ?></h2>
                <p class="section-subtitle" style="margin-bottom:0;"><?php esc_html_e( 'Hand-picked just for you', 'mystore' ); ?></p>
            </div>
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-outline">
                <?php esc_html_e( 'View All', 'mystore' ); ?>
            </a>
        </div>

        <?php
        $featured = mystore_get_featured_products( 8 );

        if ( $featured->have_posts() ) :
            wc_set_loop_prop( 'columns', 4 );
        ?>
            <div class="products-grid">
                <?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
                    <?php mystore_product_card( get_the_ID() ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

        <?php else : ?>
            <p class="no-content"><?php esc_html_e( 'No featured products found. Mark some products as "Featured" in WooCommerce.', 'mystore' ); ?></p>
        <?php endif; ?>

    </div>
</section>



<?php get_footer(); ?>