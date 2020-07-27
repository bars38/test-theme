<?php
	/*
		Template name: Home page
	*/
	get_header();
?>

	<div class="blog-block">
		<div class="container-fluid new-padding">
			<div class="row new-margin">
				<div class="col new-padding d-flex justify-content-center">
					<div class="title-block">
						<h3>New posts</h3>
					</div>
				</div>
			</div>
			<div class="row new-margin justify-content-center">
				<?php
					// Get 3 new posts
					$arg = array(
						'post_status' => 'publish',
						'post_type' => 'post',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' =>  'DESC'
					);
                                        // Oupput 3 new posts
					$rev = new WP_Query( $arg );
					if ( $rev -> have_posts() ) :
						while ( $rev -> have_posts() ) : $rev -> the_post();
				?>
				<div class="col-12 col-md-3 new-padding">
					<div class="post-item">
						<div class="post-title">
                                                    <div class="post-img-main">
                                                        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), "post_medium" ); ?>">
                                                    </div>
                                                    <a href="<?php echo the_permalink(); ?>" class="url-main"><h4><?php the_title(); ?></h4></a>
                                                        <?php
                                                        
                                                            // Get post's author id
                                                            $post_author_id = get_post_field( 'post_author', $post_id );

                                                        ?>
							<span class="post-date"><?php echo get_the_date('d/m/y'); ?> by <?php the_author_meta('first_name', $post_author_id); ?> &nbsp;<?php the_author_meta('last_name', $post_author_id); ?></span>
						</div>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>
		</div>
	</div>


	<div class="demo-block">
		<div class="container">
			<div class="row">
				<div class="col d-sm-flex justify-content-between">
					<div class="title-block">
						<h3>Subscribe on our news.</h3>
					</div>
                                    <form id="subs-form">
                                        <div class="input-group mb-3">
                                                <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" style="width: 300px; height: calc(4em + .75rem + 2px);">
                                        <div class="input-group-append">
                                                <a href="#">Subscribe</a>
                                        </div>
                                        </div>
                                    </form>
				</div>
			</div>
		</div>
	</div>


	<div class="blog-block">
		<div class="container-fluid new-padding">
			<div class="row new-margin">
				<div class="col new-padding d-flex justify-content-center">
					<div class="title-block">
						<h3>Popular</h3>
					</div>
				</div>
			</div>
			<div class="row new-margin justify-content-center">
				<?php
					// Get 3 popular posts
					$arg = array(
						'post_status' => 'publish',
						'post_type' => 'post',
						'posts_per_page' => 3,
                                                'order'     => 'DESC',
                                                'meta_key' => 'view_count',
                                                'orderby'   => 'meta_value_num'
					);
                                        // Oupput 3 popular posts
					$rev = new WP_Query( $arg );
					if ( $rev -> have_posts() ) :
						while ( $rev -> have_posts() ) : $rev -> the_post();
				?>
				<div class="col-12 col-md-3 new-padding">
					<div class="post-item">
						<div class="post-title">
                                                    <a href="<?php echo the_permalink(); ?>" class="url-main"><h4><?php the_title(); ?></h4></a>
                                                    <span class="post-date"><?php echo "Views: ".get_post_meta(get_the_ID(), "view_count", true); ?></span>
						</div>
						<div class="excerpt">
							<?php
                                                        	$post_content = get_the_content();
                                                                // Checks the string length, if under 100 chars...
                                                                        if (strlen($post_content) < 100){
                                                                        // Outputs the whole post content
                                                                        print $post_content . '...';
                                                                }else{
                                                                        // Output only 500 chars, but don't cut halfway through a word
                                                                        $post_trimmed = substr($post_content, 0, strpos($post_content, ' ', 100));
                                                                        print $post_trimmed . '...';
                                                                }
                                                        ?>
						</div>
						<a class="" href="<?php the_permalink(); ?>">Read more</a>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
