<?php
	/*
		Template name: But page
	*/

get_header(); ?>
<div style="text-align:center;">
<?php 
while ( have_posts() ) :
        the_post();
                the_title( '<h1>', '</h1>' ); 
                
                the_content();
endwhile;
?>
</div>
<?php get_footer(); ?>