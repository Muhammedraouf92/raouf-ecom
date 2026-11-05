<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
            <!-- Announcement Bar -->
<!--     <div class="announcement-bar" role="region" aria-label="<?php esc_attr_e( 'Promotion', 'mystore' ); ?>">
            <div class="announcement-bar__inner">
                <span class="announcement-bar__icon">🌙</span>
                <p class="announcement-bar__text">
                    Ramadan Mubarak — Celebrate the season with 
                    <strong>10% off</strong> our full Ramadan Collection
                </p>
               
                <button class="announcement-bar__close" aria-label="<?php esc_attr_e( 'Dismiss', 'mystore' ); ?>">&#x2715;</button>
            </div>
        </div> -->
    <div class="container">

        <div class="header-inner">
            <button class="hamburger" aria-label="<?php esc_attr_e( 'Toggle menu', 'mystore' ); ?>" aria-expanded="false">
                    <?php echo mystore_icon('menu'); ?>
                </button>
            <!-- Logo -->
           <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
             <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                <?php bloginfo( 'name' ); ?>
            </a>
            <?php endif; ?>

            <!-- Primary Navigation -->
            <nav class="main-nav" aria-label="<?php esc_attr_e( 'Primary', 'mystore' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu_class'     => '',
                    'container'      => false,
                    'fallback_cb'    => function() {
                        echo '<ul>';
                        echo '<li><a href="' . home_url() . '">' . __( 'Home', 'mystore' ) . '</a></li>';
                        echo '<li><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">' . __( 'Shop', 'mystore' ) . '</a></li>';
                        echo '</ul>';
                    },
                ] );
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <?php if ( function_exists( 'WC' ) ) : ?>
                    <div class="cart-icon">
                       <?php echo mystore_icon('cart'); ?>
                        <?php $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
                        <?php if ( $count > 0 ) : ?>
                            <span class="cart-count"><?php echo esc_html( $count ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                
            </div>

        </div>
    </div>
</header>

<!-- Mobile Nav Overlay (toggled via JS) -->
<div class="mobile-nav" id="mobile-nav" aria-hidden="true">
    <div class="mobile-nav-inner">
        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-nav-list',
            'container'      => false,
        ] );
        ?>
    </div>
</div>