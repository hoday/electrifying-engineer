<?php


/**
 * Sets $content_width global
 */
if (!isset($content_width)) {
    $content_width = 760;
}


/**
 * Adds support for custom theme header image
 */
add_theme_support(
    'custom-header',
    array(
        'width' => 1280,
        'height' => 300,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => false,
        'default-image' => get_template_directory_uri() . '/assets/img/default-bg.jpg',
        'uploads' => true
    )
);


/**
 * Adds support for custom logo
 */
add_theme_support(
    'custom-logo',
    array(
    	'height'      => '1rem',
    	'width'       => 'auto',
    	'flex-height' => true,
    	'flex-width'  => true,
    	'header-text' => array( 'site-title', 'site-description' ),
    )
);

/**
 * Adds support for thumbnails
 */
add_theme_support('post-thumbnails');

/**
 * Adds support for the title tag
 */
add_theme_support('title-tag');

/**
 * Adds support for automatic feed links
 */
add_theme_support('automatic-feed-links');

/**
 * Adds support for custom background
 */
add_theme_support(
    'custom-background',
    array(
    	'default-color'          => '#f0f0fe',
    	'default-image'          => '',
    	'default-repeat'         => 'repeat',
    	'default-position-x'     => 'left',
        'default-position-y'     => 'top',
        'default-size'           => 'auto',
    	'default-attachment'     => 'scroll',
    )
);

/**
 * Adds editor style
 */
add_editor_style('editor-style.css');


/**
 * Registers location for navigation menu
 */
function eept_register_nav_menu() {
  register_nav_menu('eept-navmenu', __('Navigation Menu', 'electrifying-engineer'));
}
add_action('init', 'eept_register_nav_menu');

/**
 * Registers location for widget sidebar
 */
function eept_widgets_init() {
    $args = array(
    	'name'          => __( 'Sidebar name', 'electrifying-engineer' ),
    	'id'            => 'sidebar-1',    // ID should be LOWERCASE  ! ! !
    	'description'   => '',
        'class'         => '',
    	'before_widget' => '<li id="%1$s" class="widget %2$s">',
    	'after_widget'  => '</li>',
    	'before_title'  => '<h2 class="widgettitle">',
    	'after_title'   => '</h2>'
    );
    register_sidebar($args);
}
add_action('widgets_init', 'eept_widgets_init');


/**
 * Adds HTML5 theme support.
 */
function eept_after_setup_theme() {
    add_theme_support('html5', array('search-form'));
}
add_action('after_setup_theme', 'eept_after_setup_theme');


/**
 * Enqueue scripts and styles
 */
function eept_enqueue_scripts() {
    wp_enqueue_style('eept-style', get_stylesheet_uri());
    wp_enqueue_script('eept-script', get_template_directory_uri() . '/assets/js/eept-script.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'eept_enqueue_scripts');


/**
 * Checks if the excellent-engineering-portfolio is active
 *
 */
 if (in_array('electrifying-engineering-portfolio/electrifying-engineering-portfolio.php', apply_filters('active_plugins', get_option('active_plugins')))){
     /**
      * Adds callback for switching page template
      */
     add_filter('template_include', 'eept_switch_page_template');

 }

function eept_switch_page_template($template) {

    $postType = get_post_type();

    if (
        !is_admin() &&
        is_main_query() &&
        (
            $postType == 'eep_project' ||
            $postType == 'eep_portfolio_item'
        )
    ) {
        error_log('switching template in theme:');
		$new_template = locate_template(array('pagefullwidth.php'));
		if (!empty( $new_template)) {
			return $new_template;
		}
	}

	return $template;
}

/**
 * Custom walker class. - For styling menu bar with bootstrap
 */
class EeptWPDocsWalkerNavMenu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth,
						'nav-item' /*added for bootstrap*/
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="nav-link menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        if (is_object($args)) {
            $args_before        = $args->before;
            $args_after         = $args->after;
            $args_link_before   = $args->link_before;
            $args_link_after    = $args->link_after;
        } elseif (is_array($args)) {
            $args_before        = $args['before'];
            $args_after         = $args['after'];
            $args_link_before   = $args['link_before'];
            $args_link_after    = $args['link_after'];
        } else {
            $args_before        = '';
            $args_after         = '';
            $args_link_before   = '';
            $args_link_after    = '';
        }


        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args_before,
            $attributes,
            $args_link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args_link_after,
            $args_after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
