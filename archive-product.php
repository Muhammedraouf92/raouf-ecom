<?php
/**
 * Shop Page (WooCommerce Product Archive)
 *
 * @package MyStore
 */

get_header();
?>

<main class="site-main" id="main" role="main">
    <div class="container">
        <div class="shop-layout">

            <!-- ==============================
                 SIDEBAR / FILTERS
                 ============================== -->
            <aside class="shop-sidebar" aria-label="<?php esc_attr_e( 'Shop filters', 'mystore' ); ?>">

                <!-- Search -->
                <h3><?php esc_html_e( 'Search', 'mystore' ); ?></h3>
                <?php get_search_form(); ?>

             
               
               

                <!-- Price Filter (WooCommerce widget) -->
                <h3><?php esc_html_e( 'Price', 'mystore' ); ?></h3>
                <?php
                if ( is_active_sidebar( 'shop-sidebar' ) ) {
                    dynamic_sidebar( 'shop-sidebar' );
                } else {
                    // Fallback: manual widget
                    the_widget( 'WC_Widget_Price_Filter' );
                }
                ?>

            </aside>

            <!-- ==============================
                 PRODUCT GRID
                 ============================== -->
            <div class="shop-main">
                <div class="shop-toolbar">
                    <p>
                        <?php if ( woocommerce_result_count() ) : ?>
                            <?php woocommerce_result_count(); ?>
                        <?php endif; ?>
                    </p>
                    <?php woocommerce_catalog_ordering(); ?>
                </div>

                <?php
                if ( woocommerce_product_loop() ) {
                    woocommerce_product_loop_start();

                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();
                            // Use WooCommerce's default loop content, or override below:
                            wc_get_template_part( 'content', 'product' );
                        }
                    }

                    woocommerce_product_loop_end();
                    woocommerce_pagination();
                } else {
                    do_action( 'woocommerce_no_products_found' );
                }
                ?>

            </div>
            <!-- /.shop-main -->

        </div>
        <!-- /.shop-layout -->
    </div>
</main>

<?php get_footer(); ?>