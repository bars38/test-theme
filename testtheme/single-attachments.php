<?php get_header(); ?>

<?php 

// output our cpt
echo '<div style="text-align:'.get_field('background-position', get_the_ID()).';">';

echo '<img src="'.get_field('image_600x500', get_the_ID()).'">';
echo '<img src="'.get_field('image_300x300', get_the_ID()).'">';

echo "</div>";
?>


<?php get_footer(); ?>
