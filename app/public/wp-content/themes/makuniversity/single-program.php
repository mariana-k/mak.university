<?php get_header();
while (have_posts()) {
    the_post();
    pageBanner();
?>
    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    All Programs
                </a>
                <span class="metabox__main">
                    <?php the_title(); ?>
                </span>
            </p>
        </div>
        <div class="generic-content"><?php echo get_the_content(); ?></div>
        <hr class="sectoin-break" />
        <h2 class="headline headline--medium"><?php echo get_the_title(); ?> Professors</h2>
        <ul class="professor-cards">
        <?php
        $relatedProfessors = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' =>  'professor',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));

        if ($relatedProfessors->have_posts()) {
            while ($relatedProfessors->have_posts()) {
                $relatedProfessors->the_post(); 
        ?>
            <li class="professor-card__list-item">
                <a class="professor-card" href="<?php the_permalink(); ?>">
                    <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorPortrait'); ?>" />   
                    <span class="professor-card__name"><?php the_title(); ?></span>
                </a>
            </li>
        <?php }
        } else {
            echo 'Nothing found';
        }
        wp_reset_postdata();
        ?>
        </ul>
        <hr class="sectoin-break" />
        <h2 class="headline headline--medium">Upcoming <?php get_the_title(); ?> Events</h2>
        <?php
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' =>  'event',
            'orderby' => 'meta_value_num',
            'meta_key' => 'event_date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                ),
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));
        if ($homepageEvents->have_posts()) {
            while ($homepageEvents->have_posts()) {
                $homepageEvents->the_post(); 
                get_template_part('template-parts/content-event');
            }
        } else {
            echo 'Nothing found';
        } ?>
    </div>
<?php
}
get_footer();
?>