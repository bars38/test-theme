<?php get_header(); ?>

<?php
/* Start the Loop */
    while ( have_posts() ) :
            the_post();
    ?>
<article>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'testtheme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		?>
	</div><!-- .entry-content -->

</article>
<?php
    endwhile; // End of the loop.
?>
<?php 

        // Count post views for popularity
        $view_count = get_post_meta(get_the_ID(), "view_count", true); 
        $view_count++;
        update_post_meta(get_the_ID(), "view_count", $view_count);
?>


<?php get_footer(); ?>
