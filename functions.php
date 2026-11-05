<?php
/**
 * MyStore Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MYSTORE_VERSION', '1.0.0' );
define( 'MYSTORE_DIR', get_template_directory() );
define( 'MYSTORE_URI', get_template_directory_uri() );
require_once get_template_directory() . '/inc/icons.php';
/* =============================================
   THEME SETUP
   ============================================= */
function mystore_setup() {
    // Translations
    load_theme_textdomain( 'mystore', MYSTORE_DIR . '/languages' );

    // Title tag
    add_theme_support( 'title-tag' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Custom logo
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // HTML5 support
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ] );

    // WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Menus
    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'mystore' ),
        'footer'  => __( 'Footer Menu', 'mystore' ),
    ] );
}
add_action( 'after_setup_theme', 'mystore_setup' );

/* =============================================
   ENQUEUE SCRIPTS & STYLES
   ============================================= */
function mystore_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'mystore-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@400;500;700&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style( 'mystore-style', get_stylesheet_uri(), [ 'mystore-fonts' ], MYSTORE_VERSION );

    // Main JS
    wp_enqueue_script(
        'mystore-script',
        MYSTORE_URI . '/assets/js/main.js',
        [],
        MYSTORE_VERSION,
        true
    );
     wp_enqueue_script(
        'mystore-minicart',
        MYSTORE_URI . '/assets/js/mini-cart.js',
        [],
        MYSTORE_VERSION,
        true
    );
    wp_enqueue_script(
        'mystore-ajax-cart',
        MYSTORE_URI . '/assets/js/add-to-cart.js',
        [ 'jquery', 'mystore-script' ],
        MYSTORE_VERSION,
        true
    );
    // Pass data to JS
    wp_localize_script( 'mystore-script', 'mystore', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'mystore_nonce' ),
    ] );
}
add_action( 'wp_enqueue_scripts', 'mystore_enqueue_assets' );

/* =============================================
   IMAGE SIZES
   ============================================= */
add_image_size( 'mystore-hero',    1600, 900,  true );
add_image_size( 'mystore-product', 600,  900,  false );
add_image_size( 'mystore-card',    400,  400,  true );
add_image_size( 'mystore-category', 400, 600,  true );

/* =============================================
   WIDGET AREAS
   ============================================= */
function mystore_register_sidebars() {
    register_sidebar( [
        'name'          => __( 'Shop Sidebar', 'mystore' ),
        'id'            => 'shop-sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] );

}
add_action( 'widgets_init', 'mystore_register_sidebars' );

/* =============================================
   WOOCOMMERCE HOOKS
   ============================================= */

// Remove default WooCommerce wrappers (we define our own)
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', function() {
    echo '<div class="container"><div class="woo-main">';
} );
add_action( 'woocommerce_after_main_content', function() {
    echo '</div></div>';
} );

// Product columns on archive
add_filter( 'loop_shop_columns', function() { return 3; } );

// Products per page
add_filter( 'loop_shop_per_page', function() { return 12; } );

/* =============================================
   HELPERS
   ============================================= */
// Sold Out badge on shop/archive loop
add_action( 'woocommerce_before_shop_loop_item_title', 'mystore_loop_soldout_badge', 9 );
function mystore_loop_soldout_badge() {
    global $product;
    if ( $product && ! $product->is_in_stock() ) {
        echo '<span class="product-badge product-badge--soldout loop-soldout-badge">Sold Out</span>';
    }
}
/**
 * Get featured products query
 */
function mystore_get_featured_products( $count = 8 ) {
    return new WP_Query( [
        'post_type'      => 'product',
        'posts_per_page' => $count,
        'tax_query'      => [ [
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
        ] ],
        'post_status'    => 'publish',
    ] );
}

/**
 * Render a product card
 */
function mystore_product_card( $product_id = null ) {
    global $product;
    if ( $product_id ) {
        $product = wc_get_product( $product_id );
    }
    if ( ! $product ) return;

   if ( ! $product->is_in_stock() ) {
        $badge = '<span class="product-badge product-badge--soldout">Sold Out</span>';
    } elseif ( $product->is_on_sale() ) {
        $badge = '<span class="product-badge">Sale</span>';
    } else {
        $badge = '';
    }
    $price       = $product->get_price_html();
    $thumbnail   = $product->get_image( 'mystore-card' );
    $link        = get_permalink( $product->get_id() );
    $name        = $product->get_name();
    $category    = wp_get_post_terms( $product->get_id(), 'product_cat' );
    $cat_name    = ! empty( $category ) ? $category[0]->name : '';
    ?>
    <article class="product-card">
        <a href="<?php echo esc_url( $link ); ?>" class="product-card-image">
            <?php echo $badge; ?>
            <?php echo $thumbnail; ?>
            <div class="product-card-actions">
                <?php
                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                    sprintf(
                        '<button class="quick-add-btn" data-product-id="%d">%s</button>',
                        $product->get_id(),
                        mystore_icon('bag', 16) 
                    ),
                    $product
                );
                ?>
            </div>
        </a>
        <div class="product-card-body">
            <?php if ( $cat_name ) : ?>
                <p class="product-category"><?php echo esc_html( $cat_name ); ?></p>
            <?php endif; ?>
            <h3 class="product-name">
                <a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $name ); ?></a>
            </h3>
            <div class="product-price-row">
                <span class="price"><?php echo $price; ?></span>
            </div>
        </div>
    </article>
    <?php
}


function mystore_enqueue_glightbox() {
    if ( is_product() ) {
        wp_enqueue_style(
              'glightbox',
              'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css',
              [],
              '3.3.0'
          );
          wp_enqueue_script(
              'glightbox',
              'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js',
              [],
              '3.3.0',
              true // load in footer
          );
      }
  }
add_action( 'wp_enqueue_scripts', 'mystore_enqueue_glightbox' );

  function mystore_hero_customizer( $wp_customize ) {
      $wp_customize->add_section( 'mystore_hero_circles', [
          'title'    => __( 'Hero Circle Images', 'mystore' ),
         'priority' => 30,
      ]);
 
      for ( $i = 1; $i <= 4; $i++ ) {
          $wp_customize->add_setting( "mystore_hero_circle_{$i}", [
              'default'           => '',
             'sanitize_callback' => 'esc_url_raw',
          ]);
         $wp_customize->add_control(
              new WP_Customize_Image_Control( $wp_customize, "mystore_hero_circle_{$i}", [
                 'label'   => sprintf( __( 'Circle Image %d', 'mystore' ), $i ),
                'section' => 'mystore_hero_circles',
            ])
         );
     }
     $wp_customize->add_setting( "mystore_hero_about", [
              'default'           => '',
             'sanitize_callback' => 'esc_url_raw',
          ]);
     $wp_customize->add_control(
              new WP_Customize_Image_Control( $wp_customize, "mystore_hero_about", [
                'label'   => sprintf( __( 'About Image', 'mystore' )),
                'section' => 'mystore_hero_circles',
            ])
         );
}
add_action( 'customize_register', 'mystore_hero_customizer' );

function mystore_lookbook_customizer( $wp_customize ) {
    $wp_customize->add_section( 'mystore_lookbook', [
        'title'    => __( 'Lookbook Banner', 'mystore' ),
        'priority' => 35,
    ] );

    // Background image
    $wp_customize->add_setting( 'mystore_lookbook_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );
    $wp_customize->add_control(
        new WP_Customize_Image_Control( $wp_customize, 'mystore_lookbook_image', [
            'label'   => __( 'Background Image', 'mystore' ),
            'section' => 'mystore_lookbook',
        ] )
    );

    // Heading
    $wp_customize->add_setting( 'mystore_lookbook_heading', [
        'default'           => 'Style That <em>Speaks</em> for Itself',
        'sanitize_callback' => 'wp_kses_post',
    ] );
    $wp_customize->add_control( 'mystore_lookbook_heading', [
        'label'   => __( 'Heading (HTML allowed)', 'mystore' ),
        'section' => 'mystore_lookbook',
        'type'    => 'textarea',
    ] );

    // Subtext
    $wp_customize->add_setting( 'mystore_lookbook_text', [
        'default'           => 'Explore our latest looks — crafted for confidence, designed for every occasion.',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'mystore_lookbook_text', [
        'label'   => __( 'Subtext', 'mystore' ),
        'section' => 'mystore_lookbook',
        'type'    => 'textarea',
    ] );
}
add_action( 'customize_register', 'mystore_lookbook_customizer' );



// 1. Output the mini cart sidebar in the footer
function mystore_mini_cart_sidebar() {
    get_template_part( 'woocommerce/mini-cart-sidebar' );
}
add_action( 'wp_footer', 'mystore_mini_cart_sidebar' );






function mystore_cart_fragments( $fragments ) {
    $cart = WC()->cart;

    // Item count badge
    $fragments['#mc-count'] = '<span class="mc-count" id="mc-count">' . $cart->get_cart_contents_count() . '</span>';

    // Subtotal
    $fragments['#mc-subtotal'] = '<span class="mc-subtotal-amount" id="mc-subtotal">' . $cart->get_cart_subtotal() . '</span>';

    // Items list (or empty state)
    ob_start();
    if ( ! $cart->is_empty() ) : ?>
        <ul class="mc-items" id="mc-items">
            <?php foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) :
                $product    = $cart_item['data'];
                $quantity   = $cart_item['quantity'];
                $thumbnail  = $product->get_image( 'woocommerce_thumbnail' );
                $name       = $product->get_name();
                $price      = $cart->get_product_price( $product );
                $remove_url = wc_get_cart_remove_url( $cart_item_key );
            ?>
                <li class="mc-item" data-key="<?php echo esc_attr( $cart_item_key ); ?>">
                    <div class="mc-item-img"><?php echo $thumbnail; ?></div>
                    <div class="mc-item-info">
                        <span class="mc-item-name"><?php echo esc_html( $name ); ?></span>
                        <div class="mc-item-meta">
                            <span class="mc-item-qty">Qty: <?php echo esc_html( $quantity ); ?></span>
                            <span class="mc-item-price"><?php echo $price; ?></span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( $remove_url ); ?>"
                       class="mc-item-remove"
                       data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
                       data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>"
                       aria-label="<?php echo esc_attr( sprintf( __( 'Remove %s', 'mystore' ), $name ) ); ?>">
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
    <?php endif;
    $fragments['#mc-body'] = '<div class="mc-body" id="mc-body">' . ob_get_clean() . '</div>';

    // Footer — always in DOM, hidden via inline style when cart is empty
    $footer_hidden = $cart->is_empty() ? ' style="display:none"' : '';
    ob_start(); ?>
        <div class="mc-footer" id="mc-footer"<?php echo $footer_hidden; ?>>
            <div class="mc-subtotal">
                <span class="mc-subtotal-label"><?php esc_html_e( 'Subtotal', 'mystore' ); ?></span>
                <span class="mc-subtotal-amount" id="mc-subtotal"><?php echo $cart->get_cart_subtotal(); ?></span>
            </div>
            <div class="mc-footer-actions">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="mc-btn mc-btn--outline"><?php esc_html_e( 'View Cart', 'mystore' ); ?></a>
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="mc-btn mc-btn--primary">
                    <?php esc_html_e( 'Checkout', 'mystore' ); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    <?php $fragments['#mc-footer'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'mystore_cart_fragments' );
// add to cart handler
function mystore_ajax_add_to_cart() {
    check_ajax_referer( 'mystore_nonce', 'nonce');

    $product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
    $quantity   = isset( $_POST['quantity'] )   ? absint( $_POST['quantity'] )   : 1;

    if ( ! $product_id ) {
        wp_send_json_error( [ 'message' => __( 'Invalid product.', 'mystore' ) ] );
    }

    $product = wc_get_product( $product_id );

    if ( ! $product || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
        wp_send_json_error( [ 'message' => __( 'Product unavailable.', 'mystore' ) ] );
    }

    // Variable products need extra handling — send them to the product page
    if ( $product->is_type( 'variable' ) ) {
        wp_send_json_error( [
            'message'  => __( 'Please select options.', 'mystore' ),
            'redirect' => get_permalink( $product_id ),
        ]);
    }

    $added = WC()->cart->add_to_cart( $product_id, $quantity );

    if ( $added ) {
        WC()->cart->calculate_totals();
           $fragments = apply_filters( 'woocommerce_add_to_cart_fragments', [] );
        wp_send_json_success([
            'message'     => sprintf(
                __( '"%s" added to cart.', 'mystore' ),
                $product->get_name()
            ),
            'cart_count'  => WC()->cart->get_cart_contents_count(),
            'cart_total'  => WC()->cart->get_cart_total(),
            'fragments'  => $fragments,
        ]);
    } else {
        wp_send_json_error( [ 'message' => __( 'Could not add to cart.', 'mystore' ) ] );
    }
}
add_action( 'wp_ajax_mystore_add_to_cart',        'mystore_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_mystore_add_to_cart', 'mystore_ajax_add_to_cart' );


/* =============================================
   CHECKOUT FIELD CUSTOMIZATIONS
   ============================================= */

/**
 * Customize billing fields:
 * - Merge first/last name → Full Name
 * - Lock country to Egypt
 * - Rename address_1 → Full Address
 * - Remove unused fields
 * - Make phone required
 */
add_filter( 'woocommerce_checkout_fields', 'mystore_customize_checkout_fields' );
function mystore_customize_checkout_fields( $fields ) {
    // Remove unwanted billing fields
    unset(
        $fields['billing']['billing_first_name'],
        $fields['billing']['billing_last_name'],
        $fields['billing']['billing_company'],
        $fields['billing']['billing_address_2'],
        $fields['billing']['billing_city'],
        $fields['billing']['billing_postcode']
    );

    // Add Full Name field
    $fields['billing']['billing_full_name'] = [
        'label'       => __( 'Full Name', 'mystore' ),
        'placeholder' => __( 'Your full name', 'mystore' ),
        'required'    => true,
        'class'       => [ 'form-row-wide' ],
        'priority'    => 10,
    ];

    // Email at top
    if ( isset( $fields['billing']['billing_email'] ) ) {
        $fields['billing']['billing_email']['priority'] = 5;
    }

    // Static Egypt display field (read-only, inside the field wrapper, between name and address)
    $fields['billing']['billing_country_display'] = [
        'type'              => 'text',
        'label'             => __( 'Country', 'mystore' ),
        'required'          => false,
        'class'             => [ 'form-row-wide', 'mystore-country-static' ],
        'custom_attributes' => [ 'readonly' => 'readonly', 'tabindex' => '-1' ],
        'priority'          => 45,
    ];

    // Rename address_1 → Full Address
    if ( isset( $fields['billing']['billing_address_1'] ) ) {
        $fields['billing']['billing_address_1']['label']       = __( 'Full Address', 'mystore' );
        $fields['billing']['billing_address_1']['placeholder'] = __( 'Street, building number, area', 'mystore' );
        $fields['billing']['billing_address_1']['priority']    = 50;
    }

    // State priority
    if ( isset( $fields['billing']['billing_state'] ) ) {
        $fields['billing']['billing_state']['priority'] = 60;
    }

    // Phone required, at the end
    if ( isset( $fields['billing']['billing_phone'] ) ) {
        $fields['billing']['billing_phone']['required'] = true;
        $fields['billing']['billing_phone']['priority'] = 100;
    }

    return $fields;
}

// Default billing country = Egypt
add_filter( 'default_checkout_billing_country', function() { return 'EG'; } );

/**
 * Inject first_name / last_name from billing_full_name before WooCommerce processes posted data.
 * Also lock country to EG.
 */
add_filter( 'woocommerce_checkout_posted_data', 'mystore_process_full_name_posted' );
function mystore_process_full_name_posted( $data ) {
    if ( ! empty( $data['billing_full_name'] ) ) {
        $full  = sanitize_text_field( $data['billing_full_name'] );
        $parts = explode( ' ', $full, 2 );
        $data['billing_first_name'] = $parts[0];
        $data['billing_last_name']  = isset( $parts[1] ) ? $parts[1] : '';
    }
    $data['billing_country'] = 'EG';
    return $data;
}

// Validate full name on submit
add_action( 'woocommerce_checkout_process', 'mystore_validate_full_name' );
function mystore_validate_full_name() {
    if ( empty( $_POST['billing_full_name'] ) ) {
        wc_add_notice( __( 'Full name is required.', 'mystore' ), 'error' );
    }
}

// Wrap #order_review_heading + #order_review in a single div for clean 2-col grid
add_action( 'woocommerce_checkout_before_order_review_heading', function() {
    echo '<div class="checkout-order-summary">';
} );
add_action( 'woocommerce_checkout_after_order_review', function() {
    echo '</div>';
} );

// Pre-fill full name and country display for returning customers
add_filter( 'woocommerce_checkout_get_value', 'mystore_prefill_checkout_values', 10, 2 );
function mystore_prefill_checkout_values( $value, $key ) {
    if ( 'billing_full_name' === $key && WC()->customer ) {
        $full = trim( WC()->customer->get_billing_first_name() . ' ' . WC()->customer->get_billing_last_name() );
        return $full ?: '';
    }
    if ( 'billing_country_display' === $key ) {
        return __( 'Egypt', 'mystore' );
    }
    return $value;
}

