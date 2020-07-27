<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  	<head>
	    <meta charset="<?php bloginfo("charset"); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0 shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <?php wp_head(); ?>
        <script src="https://api.fondy.eu/static_common/v1/checkout/ipsp.js"></script>
  	</head>
  	<body <?php body_class(); ?>>
        <header class="header-block navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f-logo.png" alt="">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar str-1"></span>
                    <span class="icon-bar str-3"></span>
                    <span class="icon-bar str-2"></span>
                </button>
                <div class="collapse navbar-collapse d-sm-block justify-content-end" id="navbarCollapse">

                    <?php testtheme_header_menu(); ?>
                    <ul class="navbar-nav top-menu d-sm-none">
                        <li>
                            <a href="#">Menu 1</a>
                        </li>
                        <li>
                            <a href="#">Menu 2</a>
                        </li>
                        <li>
                            <a href="#">Manu 3</a>
                        </li>
                        <li>
                            <a href="#">Menu 4</a>
                        </li>
                    </ul>

                </div>
            </div>
        </header>
