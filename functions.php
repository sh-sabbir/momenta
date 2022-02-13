<?php

function momenta_setup() {
    /*
    * Make theme available for translation.
    * If you're building a theme based on Twenty Seventeen, use a find and replace
    * to change 'momenta' to the name of your theme in all the template files.
    */
    load_theme_textdomain('momenta');

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    /*
	 * Enables custom line height for blocks
	 */
    add_theme_support('custom-line-height');

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support('post-thumbnails');

    add_image_size('momenta-featured-image', 1200, 800, true);

    add_image_size('momenta-thumbnail-avatar', 100, 100, true);


    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'top'    => __('Top Menu', 'momenta'),
            'social' => __('Social Links Menu', 'momenta'),
        )
    );

    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        )
    );

    /*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        )
    );

    // Add theme support for Custom Logo.
    add_theme_support(
        'custom-logo',
        array(
            'width'      => 250,
            'height'     => 250,
            'flex-width' => true,
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Load regular editor styles into the new block-based editor.
    add_theme_support('editor-styles');

    // Load default block styles.
    add_theme_support('wp-block-styles');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Define and register starter content to showcase the theme on new sites.
    $starter_content = array(
        'widgets'     => array(
            // Place three core-defined widgets in the sidebar area.
            'sidebar-1' => array(
                'text_business_info',
                'search',
                'text_about',
            ),

            // Add the core-defined business info widget to the footer 1 area.
            'sidebar-2' => array(
                'text_business_info',
            ),

            // Put two core-defined widgets in the footer 2 area.
            'sidebar-3' => array(
                'text_about',
                'search',
            ),
        ),

        // Specify the core-defined pages to create and add custom thumbnails to some of them.
        'posts'       => array(
            'home',
            'about'            => array(
                'thumbnail' => '{{image-sandwich}}',
            ),
            'contact'          => array(
                'thumbnail' => '{{image-espresso}}',
            ),
            'blog'             => array(
                'thumbnail' => '{{image-coffee}}',
            ),
            'homepage-section' => array(
                'thumbnail' => '{{image-espresso}}',
            ),
        ),

        // Create the custom image attachments used as post thumbnails for pages.
        'attachments' => array(
            'image-espresso' => array(
                'post_title' => _x('Espresso', 'Theme starter content', 'momenta'),
                'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
            ),
            'image-sandwich' => array(
                'post_title' => _x('Sandwich', 'Theme starter content', 'momenta'),
                'file'       => 'assets/images/sandwich.jpg',
            ),
            'image-coffee'   => array(
                'post_title' => _x('Coffee', 'Theme starter content', 'momenta'),
                'file'       => 'assets/images/coffee.jpg',
            ),
        ),

        // Default to a static front page and assign the front and posts pages.
        'options'     => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),

        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods'  => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{contact}}',
        ),

        // Set up nav menus for each of the two areas registered in the theme.
        'nav_menus'   => array(
            // Assign a menu to the "top" location.
            'top'    => array(
                'name'  => __('Top Menu', 'momenta'),
                'items' => array(
                    'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                    'page_about',
                    'page_blog',
                    'page_contact',
                ),
            ),

            // Assign a menu to the "social" location.
            'social' => array(
                'name'  => __('Social Links Menu', 'momenta'),
                'items' => array(
                    'link_yelp',
                    'link_facebook',
                    'link_twitter',
                    'link_instagram',
                    'link_email',
                ),
            ),
        ),
    );

    /**
     * Filters Twenty Seventeen array of starter content.
     *
     * @param array $starter_content Array of starter content.
     */
    $starter_content = apply_filters('momenta_starter_content', $starter_content);

    add_theme_support('starter-content', $starter_content);
}
add_action('after_setup_theme', 'momenta_setup');


/**
 * Enqueues scripts and styles.
 */
function momenta_scripts() {
    // Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_theme_file_uri('/assets/css/main.css'), array(), '20201208' );
}
add_action('wp_enqueue_scripts', 'momenta_scripts');
