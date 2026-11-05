<?php
/**
 * Cart Page Template
 * @package MyStore
 */
get_header();
?>

<main class="site-main" id="main">
    <div class="container">
        <div class="cart-page-wrapper">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>