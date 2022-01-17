<?php get_header(); ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            <?php the_archive_title(); ?>
        </h1>
        <div class="page-banner__intro">
            <p><?php the_archive_description(); ?></p>
        </div>
    </div>
</div>
<div class="container container--narrow page-section">
    <?php
    $today = date('Ymd');
    $pastEvents = new WP_Query(array(
        'post_type' =>  'event',
        'orderby' => 'meta_value_num',
        'meta_key' => 'event_date',
        'order' => 'ASC',
        'paged' => get_query_var('paged', 1),
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
            )
        )
    ));
    while ($pastEvents->have_posts()) {
        $pastEvents->the_post();
    ?>
        <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month"><?php
                                                    $eventDate = new DateTime(get_field('event_date'));
                                                    echo $eventDate->format('M');
                                                    ?></span>
                <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p>
                    <?php
                    if (has_excerpt()) {
                        the_excerpt();
                    } else {
                        echo wp_trim_words((get_the_content(0, 18)));
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                </p>
            </div>
        </div>
    <?php }
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
    ?>
</div>
<?php get_footer(); ?>