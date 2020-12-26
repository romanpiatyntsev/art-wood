<?php

!defined('ART_VERSION') && define('ART_VERSION', wp_get_theme()->get('Version'));
!defined('ART_URL') && define('ART_URL', get_template_directory_uri());
!defined('FP_ID') && define('FP_ID', get_option('page_on_front'));

if (!function_exists('art_setup')) :

	function art_setup()
	{
		load_theme_textdomain('art', get_template_directory() . '/languages');

		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');

		register_nav_menus(array(
			'header_menu' => esc_html__('Меню в шапке', 'art'),
		));

		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		add_theme_support('custom-logo', array(
			'height'      => 45,
			'width'       => 45,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'art_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function art_widgets_init()
{
	// page sidebars
	register_sidebar(array(
		'name'          => esc_html__('Бокова панель', 'art'),
		'id'            => 'sidebar',
		'description'   => esc_html__('Додайте віджети тут', 'art'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	// footer sidebars
	register_sidebar(array(
		'name'          => esc_html__('Footer 1', 'art'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Додайте віджети тут', 'art'),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer 2', 'art'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Додайте віджети тут', 'art'),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'art_widgets_init');

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/add-scripts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Post-types.
 */
require get_template_directory() . '/inc/post_types.php';

/**
 * Helpers
 */
require get_template_directory() . '/inc/helpers/MainHelper.php';


/**
 * add defer async to google map script
 */

function add_async_attribute($tag, $handle)
{
	if ('google-map' !== $handle)
		return $tag;
	return str_replace(' src', ' defer src', $tag);
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

add_image_size('product-thumbnail', 450, 350, true);
add_image_size('product-bg', 1905, 700, true);
add_image_size('product-archive', 9999, 500);

if (!function_exists('write_log')) {
	function write_log($log)
	{
		if (is_array($log) || is_object($log)) {
			error_log(print_r($log, true));
		} else {
			error_log($log);
		}
	}
}

add_action('save_post_prod', 'art_add_title');

function art_add_title($post_id)
{

	if (!wp_is_post_revision($post_id)) {
		remove_action('save_post_prod', 'art_add_title');

		$title = get_the_title($post_id);
		write_log('title:');
		write_log($title);

		if ($title == '') {
			$my_args = [];
			$my_args['ID'] = $post_id;
			$my_args['post_title'] = $post_id;
			wp_update_post($my_args);
		}
		add_action('save_post_prod', 'art_add_title');
	}
}

// ADD NEW COLUMN
function ST4_columns_head($defaults)
{
	$defaults['featured_image'] = 'Featured Image';
	return $defaults;
}

// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID)
{
	if ($column_name == 'featured_image') {
		$post_featured_image = ST4_get_featured_image($post_ID);
		if ($post_featured_image) {
			echo '<img src="' . $post_featured_image . '" />';
		}
	}
}

function ST4_get_featured_image($post_ID)
{
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
		return $post_thumbnail_img[0];
	}
}

add_filter('manage_prod_posts_columns', 'ST4_columns_head');
add_action('manage_prod_posts_custom_column', 'ST4_columns_content', 10, 2);

function getGalleryImgUrl($content, $size = 'full')
{
	$imgSrcs = [];

	if ($content && has_shortcode($content, 'gallery')) {

		preg_match('#\[gallery.*ids=(\"|\')(.+?)\1#is', $content, $matches);
		$ids = !empty($matches) ? explode(',', $matches[2]) : [];

		foreach ($ids as $id) {
			$rawSrc = wp_get_attachment_image_src($id, $size);
			$imgSrcs[] = $rawSrc[0]; // [0] - url;
		}
	}
	return $imgSrcs;
}
