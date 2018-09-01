<!DOCTYPE html>
<html <?php language_attributes(); ?>>

  <head>

		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        ?>

		<?php wp_head(); ?>

	</head>

  <body <?php body_class(); ?>>

		<nav id="nav" class="nav navbar navbar-toggleable-md">
			<div class="navbar-brand">
                <div class="navbar-logo" itemscope>

                    <?php the_custom_logo(); ?>

                </div>

                <div class="navbar-sitename">

				    <?php bloginfo('name'); ?>

                </div>

			</div>
			<button class="navbar-toggler align-right" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar" aria-controls="exCollapsingNavbar" aria-expanded="false" aria-label="Toggle navigation">
				&#9776;
			</button>
			<div class="collapse collapsed navbar-collapse" id="exCollapsingNavbar">

				<?php
                    wp_nav_menu(
                        array(
                            'menu'   => 'eept-navmenu',
                            'walker' => new EeptWPDocsWalkerNavMenu(),
                    		'menu_class' => 'nav navbar-nav'
                        )
                    );
                ?>

			</div>
		</nav>

        <?php if (is_front_page()) : ?>

        <div class="heroimg-wrapper">
            <?php /*echo get_custom_header_markup(); */?>

            <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

        </div>

        <?php endif; ?>
