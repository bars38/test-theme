<?php

get_header(); ?>
<?php

        $arg = array(
                'post_type' => 'attachments',
        );

        // Oupput 3 popular posts
        $rev = new WP_Query( $arg );
        if ( $rev->have_posts() ) :
                while ( $rev->have_posts() ) : $rev->the_post();
?>
<a href="<?php echo the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
<?php endwhile; wp_reset_postdata(); endif; ?>
<?php get_footer(); 