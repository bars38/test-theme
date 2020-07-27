<?php
	/*
		Template name: Thank you page
	*/
$callback = $_POST;
print_r( $callback );

get_header(); ?>
<div style="text-align:center;">
<?php
while ( have_posts() ) :
        the_post();
                the_title( '<h1>', '</h1>' );
                if ($callback["response_status"] == "success"){

                }
                echo "<b>Your order ID: ".$callback["order_id"]."</b>";

                the_content();
endwhile;
?>
</div>
<?php get_footer(); ?>
