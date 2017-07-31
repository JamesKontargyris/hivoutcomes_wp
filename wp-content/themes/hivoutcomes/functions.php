<?php
/**
 * hivoutcomes functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hivoutcomes
 */

if ( ! function_exists( 'hivoutcomes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hivoutcomes_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hivoutcomes, use a find and replace
	 * to change 'hivoutcomes' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hivoutcomes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-primary' => esc_html__( 'Primary', 'hivoutcomes' ),
		'menu-footer' => esc_html__( 'Footer', 'hivoutcomes' ),
	) );

	// Add image thumbnail sizes
	add_image_size('news-extract', 500, 300, true);
	add_image_size('news-banner', 1000, 500, true);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	/*add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );*/

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'hivoutcomes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hivoutcomes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hivoutcomes_content_width', 640 );
}
add_action( 'after_setup_theme', 'hivoutcomes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hivoutcomes_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Content Area Footer', 'hivoutcomes' ),
		'id'            => 'content-area-footer',
		'description'   => esc_html__( 'Add widgets here that should appear in the content area footer.', 'hivoutcomes' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Site Footer', 'hivoutcomes' ),
		'id'            => 'site-footer',
		'description'   => esc_html__( 'Add widgets here that should appear in the site footer.', 'hivoutcomes' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'hivoutcomes_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hivoutcomes_scripts() {
	wp_enqueue_style( 'hivoutcomes-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hivoutcomes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'hivoutcomes-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'hivoutcomes-fontawesome', 'https://use.fontawesome.com/e905a8170f.js', array(), '20160417', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hivoutcomes_scripts' );

/**
 * Implement the Custom Header feature.
 */
/*require get_template_directory() . '/inc/custom-header.php';*/

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
/*require get_template_directory() . '/inc/customizer.php';*/

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// Add site stylesheet to back-end editor
function hivoutcomes_add_editor_styles() {
	add_editor_style( 'style.css' );
}
add_action( 'init', 'hivoutcomes_add_editor_styles' );

// Editor-specific body background style
add_filter('tiny_mce_before_init','hivoutcomes_theme_editor_dynamic_styles');
function hivoutcomes_theme_editor_dynamic_styles( $mceInit ) {
	$styles = 'body.mce-content-body { background: #ffffff; }';
	if ( isset( $mceInit['content_style'] ) ) {
		$mceInit['content_style'] .= ' ' . $styles . ' ';
	} else {
		$mceInit['content_style'] = $styles . ' ';
	}
	return $mceInit;
}

function hivoutcomes_mce_buttons($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'hivoutcomes_mce_buttons');

// Add anchor button to WYSIWYG editor
function set_tinymce_buttons( $initArray ) {
	$initArray['theme_advanced_buttons1'] ='formatselect,|,bold,italic,underline,|,bullist,numlist,charmap,|,pastetext,pasteword,|,removeformat,|,anchor,link,unlink,|,undo,redo';
	$initArray['theme_advanced_buttons2'] = '';
	$initArray['theme_advanced_blockformats'] = 'h2,h3,h4,p';
	return $initArray;
}
add_filter('tiny_mce_before_init', 'set_tinymce_buttons');
/*
* Callback function to filter the MCE settings
*/
function hivoutcomes_mce_before_init_insert_formats( $init_array ) {

// Define the style_formats array

	$style_formats = array(
		/*
		* Each array child is a format with it's own settings
		* Notice that each array has title, block, classes, and wrapper arguments
		* Title is the label which will be visible in Formats menu
		* Block defines whether it is a span, div, selector, or inline style
		* Classes allows you to define CSS classes
		* Wrapper whether or not to add a new block-level element around any selected elements
		*/
		array(
			'title' => 'Red Button',
			'block' => 'span',
			'classes' => 'button--red',
			'wrapper' => true,
		),
		array(
			'title' => 'Grey Button',
			'block' => 'span',
			'classes' => 'button--grey',
			'wrapper' => true,
		),
		array(
			'title' => 'Footnote Reference',
			'inline' => 'span',
			'classes' => 'footnote__reference',
			'wrapper' => false,
		),
		array(
			'title' => 'Footnote Text',
			'block' => 'div',
			'classes' => 'footnote__text',
			'wrapper' => false,
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'hivoutcomes_mce_before_init_insert_formats' );