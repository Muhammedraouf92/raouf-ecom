<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
                    <?php
                    if ( has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        bloginfo( 'name' );
                    }
                    ?>
                </a>
                <p><?php bloginfo( 'description' ); ?></p>
            </div>

            <!-- Shop Links -->
            <div class="footer-col">
                <h4><?php esc_html_e( 'Shop', 'mystore' ); ?></h4>
                <ul>
                    <?php if ( function_exists( 'wc_get_page_id' ) ) : ?>
                        <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'All Products', 'mystore' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ); ?>"><?php esc_html_e( 'Cart', 'mystore' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'checkout' ) ) ); ?>"><?php esc_html_e( 'Checkout', 'mystore' ); ?></a></li>
                        <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php esc_html_e( 'My Account', 'mystore' ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            

            <!-- Information Links -->
            <div class="footer-col">
                <h4><?php esc_html_e( 'Information Links', 'mystore' ); ?></h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/contact-us' ) ); ?>"><?php esc_html_e( 'Contact', 'mystore' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'mystore' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/returns-policy' ) ); ?>"><?php esc_html_e( 'Returns Policy', 'mystore' ); ?></a></li>
                    
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <a href="https://raouf-portfolio-six.vercel.app/" target="_blank" style='color:black;'>Raouf</a>.
                <?php esc_html_e( 'All rights reserved.', 'mystore' ); ?>
            </p>
            <div class="footer-social">
                <a href="https://www.instagram.com/rehamalifashion?igsh=OHZyeGRjdG5pbXg1&utm_source=qr" class="footer-social-link" aria-label="Instagram" target="_blank" rel="noopener">
                    <?php echo mystore_icon( 'instagram', 18 ); ?>
                </a>
               
                <a href="https://www.facebook.com/share/1EQ4bkVuj8/?mibextid=wwXIfr" class="footer-social-link" aria-label="Facebook" target="_blank" rel="noopener">
                    <?php echo mystore_icon( 'facebook', 18 ); ?>
                </a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>