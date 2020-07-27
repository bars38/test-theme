	<footer>
		<div class="container">
			<div class="row">
				<div class="col d-flex justify-content-center">
					<a href="/" class="logo">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f-logo.png" alt="">
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col d-flex justify-content-center">
					<div class="text">
						<?php echo get_theme_mod( 'true_footer_copyright_text' ); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>
