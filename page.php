<?php get_header(); ?>

<main>
<?php
if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
    the_content(); // 🚨 THIS IS REQUIRED
  endwhile;
endif;
?>
</main>

<?php get_footer(); ?>