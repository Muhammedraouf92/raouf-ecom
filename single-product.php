<?php
/**
 * Single Product Template
 *
 * @package MyStore
 */

get_header();

while ( have_posts() ) :
    the_post();
    global $product;
    $product = wc_get_product( get_the_ID() );

    if ( ! $product ) {
        wp_die( __( 'Product not found.', 'mystore' ) );
    }

    // Product data
    $gallery_ids   = $product->get_gallery_image_ids();
    $main_image_id = $product->get_image_id();
    $all_images    = $main_image_id ? array_merge( [ $main_image_id ], $gallery_ids ) : $gallery_ids;
    $rating        = $product->get_average_rating();
    $review_count  = $product->get_review_count();
    $sku           = $product->get_sku();
    $categories    = wc_get_product_category_list( $product->get_id(), ', ' );
    $tags          = wc_get_product_tag_list( $product->get_id() );
?>

<style>
/* ── Product Gallery ───────────────────────────────────────── */
.product-gallery {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
}

.gallery-main {
    width: 100%;
    border-radius: 8px;
    overflow: hidden;
    background: #f5f5f5;
    position: relative;
}

.gallery-zoom-wrap {
    position: relative;
    overflow: hidden;
    display: block;
    line-height: 0;
}

.gallery-lightbox-trigger {
    display: block;
    position: relative;
    cursor: zoom-in;
}

.gallery-main-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                opacity 0.25s ease;
}

/* Zoom on hover */
.gallery-lightbox-trigger:hover .gallery-main-img {
    transform: scale(1.06);
}

/* Zoom icon badge */
.gallery-zoom-icon {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.8);
    transition: opacity 0.2s ease, transform 0.2s ease;
    pointer-events: none;
    color: #222;
}

.gallery-lightbox-trigger:hover .gallery-zoom-icon {
    opacity: 1;
    transform: scale(1);
}

/* Fade transition when swapping images */
.gallery-main-img.is-swapping {
    opacity: 0;
    transform: scale(1.02);
}

/* ── Thumbnails ── */
.gallery-thumbs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.gallery-thumb {
    flex: 0 0 calc(20% - 7px);
    aspect-ratio: 1 / 1;
    padding: 0;
    border: 2px solid transparent;
    border-radius: 6px;
    overflow: hidden;
    background: #f5f5f5;
    cursor: pointer;
    transition: border-color 0.2s ease, opacity 0.2s ease;
    opacity: 0.6;
}

.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    pointer-events: none;
}

.gallery-thumb:hover {
    opacity: 1;
}

.gallery-thumb.is-active {
    border-color: #222;
    opacity: 1;
}
/* Urgency bar */
      .urgency-bar {
        background: #fff0f0;
        border: 1px solid rgba(208, 48, 48, 0.12);
        border-radius: 10px;
        padding: 12px 16px;
        margin: 24px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #d03030;
      }
      .urgency-dot {
        width: 8px;
        height: 8px;
        background: #d03030;
        border-radius: 50%;
        animation: urgencyPulse 1.5s infinite;
      }
      @keyframes urgencyPulse {
        0%,
        100% {
          opacity: 1;
          transform: scale(1);
        }
        50% {
          opacity: 0.5;
          transform: scale(0.8);
        }
      }
@media ( max-width: 480px ) {
    .gallery-thumb {
        flex: 0 0 calc(25% - 6px);
    }
}
	.in-stock{
		display:none;
	}
</style>

<main class="site-main" id="main" role="main">
    <div class="container">

        <div class="single-product-layout">

            <!-- ==================
                 PRODUCT GALLERY
                 ================== -->
            <div class="product-gallery" data-gallery>

                <!-- MAIN IMAGE -->
                <div class="gallery-main" id="gallery-main">
                    <div class="gallery-zoom-wrap" id="gallery-zoom-wrap">
                        <?php if ( $main_image_id ) : ?>
                            <?php
                            $full_url = wp_get_attachment_image_url( $main_image_id, 'full' );
                            $alt      = get_post_meta( $main_image_id, '_wp_attachment_image_alt', true ) ?: $product->get_name();
                            ?>
                            <a
                                href="<?php echo esc_url( $full_url ); ?>"
                                class="gallery-lightbox-trigger"
                                id="gallery-lightbox-trigger"
                                aria-label="<?php esc_attr_e( 'View full image', 'mystore' ); ?>"
                                data-gallery="product-gallery"
                                data-glightbox="description: <?php echo esc_attr( $product->get_name() ); ?>"
                            >
                                <?php echo wp_get_attachment_image(
                                    $main_image_id,
                                    'mystore-product',
                                    false,
                                    [
                                        'id'      => 'gallery-main-img',
                                        'alt'     => esc_attr( $alt ),
                                        'class'   => 'gallery-main-img',
                                        'loading' => 'eager',
                                    ]
                                ); ?>
                                <span class="gallery-zoom-icon" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="22" height="22">
                                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35M11 8v6M8 11h6"/>
                                    </svg>
                                </span>
                            </a>
                        <?php else : ?>
                            <?php echo wc_placeholder_img( 'mystore-product' ); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- THUMBNAILS -->
                <?php if ( count( $all_images ) > 1 ) : ?>
                    <div class="gallery-thumbs" role="list" aria-label="<?php esc_attr_e( 'Product images', 'mystore' ); ?>">
                        <?php foreach ( $all_images as $index => $img_id ) :
                            $thumb_url   = wp_get_attachment_image_url( $img_id, 'mystore-card' );
                            $full_url    = wp_get_attachment_image_url( $img_id, 'full' );
                            $display_url = wp_get_attachment_image_url( $img_id, 'mystore-product' );
                            $alt_text    = get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ?: $product->get_name();
                        ?>
                            <button
                                class="gallery-thumb <?php echo $index === 0 ? 'is-active' : ''; ?>"
                                role="listitem"
                                data-full="<?php echo esc_url( $display_url ); ?>"
                                data-lightbox-href="<?php echo esc_url( $full_url ); ?>"
                                data-alt="<?php echo esc_attr( $alt_text ); ?>"
                                aria-label="<?php echo esc_attr( sprintf( __( 'View image %d of %d', 'mystore' ), $index + 1, count( $all_images ) ) ); ?>"
                                aria-pressed="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                            >
                                <img
                                    src="<?php echo esc_url( $thumb_url ); ?>"
                                    alt=""
                                    loading="lazy"
                                    decoding="async"
                                >
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- HIDDEN LIGHTBOX LINKS (enables gallery swipe in GLightbox) -->
                <div aria-hidden="true" style="display:none;">
                    <?php foreach ( $all_images as $index => $img_id ) :
                        if ( $index === 0 ) continue;
                        $full_url = wp_get_attachment_image_url( $img_id, 'full' );
                        $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ?: $product->get_name();
                    ?>
                        <a
                            href="<?php echo esc_url( $full_url ); ?>"
                            data-gallery="product-gallery"
                            data-glightbox="description: <?php echo esc_attr( $alt_text ); ?>"
                            tabindex="-1"
                        ></a>
                    <?php endforeach; ?>
                </div>

            </div><!-- .product-gallery -->

            <!-- ==================
                 PRODUCT INFO
                 ================== -->
            <div class="product-info">

                <!-- Breadcrumb -->
                <nav class="breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'mystore' ); ?>">
                    <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Home', 'mystore' ); ?></a>
                    <span aria-hidden="true">/</span>
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'Shop', 'mystore' ); ?></a>
                    <?php if ( $categories ) : ?>
                        <span aria-hidden="true">/</span>
                        <span><?php echo strip_tags( $categories ); ?></span>
                    <?php endif; ?>
                </nav>

                <!-- Product Name -->
                <h1 class="product-title"><?php the_title(); ?></h1>

                <!-- Price -->
                <div class="product-price">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <!-- Short Description -->
                <?php if ( $product->get_short_description() ) : ?>
                    <div class="product-description">
                        <?php echo wp_kses_post( $product->get_short_description() ); ?>
                    </div>
                <?php endif; ?>

                <!-- Add to Cart -->
                <div class="product-form">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
				<!-- Urgency -->
				  <div class="urgency-bar">
					<span class="urgency-dot"></span>
					<span id="urgencyText"
					  >🔥 5 people bought this in the last 24 hours</span
					>
				  </div>
				<script>
					document.addEventListener("DOMContentLoaded", function () {

					  const min = 3;   // minimum buyers
					  const max = 18;  // maximum buyers

					  const randomNumber = Math.floor(Math.random() * (max - min + 1)) + min;

					  document.getElementById("urgencyText").innerHTML =
						`🔥 ${randomNumber} people bought this in the last 24 hours`;

					});
					</script>
                <!-- Tags -->
                <?php
                $tag_terms = get_the_terms( get_the_ID(), 'product_tag' );
                if ( $tag_terms && ! is_wp_error( $tag_terms ) ) : ?>
                    <div class="product-tags">
                        <?php foreach ( $tag_terms as $tag ) : ?>
                            <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>" class="tag">
                                <?php echo esc_html( $tag->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div><!-- .product-info -->
        </div>

        <!-- WooCommerce tabs (Description, Reviews, etc.) -->
        <?php do_action( 'woocommerce_after_single_product_summary' ); ?>

    </div>
</main>

<script>
( function () {
    document.addEventListener( 'DOMContentLoaded', function () {

        /* 1. Init GLightbox */
        if ( typeof GLightbox !== 'undefined' ) {
            GLightbox({
                selector: '[data-gallery="product-gallery"]',
                touchNavigation: true,
                loop: true,
                autoplayVideos: false,
                keyboardNavigation: true,
            });
        }

        /* 2. Thumbnail click → swap main image */
        const mainImg     = document.getElementById( 'gallery-main-img' );
        const mainTrigger = document.getElementById( 'gallery-lightbox-trigger' );
        const thumbs      = document.querySelectorAll( '.gallery-thumb' );

        if ( ! mainImg || ! thumbs.length ) return;

        thumbs.forEach( function ( thumb ) {
            thumb.addEventListener( 'click', function () {
                const newSrc  = this.dataset.full;
                const newHref = this.dataset.lightboxHref;
                const newAlt  = this.dataset.alt;

                if ( ! newSrc ) return;

                // Fade out → swap → fade in
                mainImg.classList.add( 'is-swapping' );

                setTimeout( function () {
                    // ✅ Must clear srcset first — otherwise the browser
                    // ignores src and keeps serving images from srcset
                    mainImg.removeAttribute( 'srcset' );
                    mainImg.removeAttribute( 'sizes' );
                    mainImg.src = newSrc;
                    mainImg.alt = newAlt || '';

                    if ( mainTrigger && newHref ) {
                        mainTrigger.href = newHref;
                    }

                    mainImg.classList.remove( 'is-swapping' );
                }, 250 );

                // Update active thumb
                thumbs.forEach( function ( t ) {
                    t.classList.remove( 'is-active' );
                    t.setAttribute( 'aria-pressed', 'false' );
                } );
                this.classList.add( 'is-active' );
                this.setAttribute( 'aria-pressed', 'true' );
            } );
        } );

    } );
} )();
</script>

<?php
endwhile;
get_footer();
?>