<?php get_header();
while (have_posts()) {
    the_post();
?>
    <h2><?php the_title(); ?>
        <?php the_content(); ?>
    <?php
}
get_footer();
    ?>