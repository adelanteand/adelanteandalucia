<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    $ajax_params = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('ungrynerd'),
    );
    wp_enqueue_style('google_fonts', '//fonts.googleapis.com/css?family=Work+Sans:wght@400;700;800;900&display=swap', false, null);
    wp_enqueue_style('adelanteandalucia.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('adelanteandalucia.js', asset_path('scripts/main.js'), [], null, true);
    wp_localize_script('adelanteandalucia.js', 'ungrynerd', $ajax_params);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

add_action('wp_head', function () {
    echo '<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>';
});

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style('editor.css', asset_path('styles/editor.css'), false, null);
});

add_action('after_setup_theme', function () {
    load_theme_textdomain('adelanteandalucia', get_template_directory() . '/lang');
});

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'adelanteandalucia-blocks',
        asset_path('scripts/gutenberg.js'),
        ['wp-blocks', 'wp-element', 'wp-edit-post']
    );
});


/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');
    add_theme_support('custom-logo');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    add_image_size('huge', 2700, 2700, false);

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support('editor-font-sizes', array());
    add_theme_support('editor-color-palette', array());
    add_theme_support('disable-custom-font-sizes');
    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-gradients');
    add_theme_support('editor-gradient-presets', array());
    remove_theme_support('core-block-patterns');
}, 20);

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });

    /**
     * Create @svg() Blade directive
     */
    sage('blade')->compiler()->directive('svg', function ($arguments) {
        // Accept multiple arguments
        list($path, $class) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
        $path = trim($path, "' ");
        $class = trim($class, "' ");

        // Create the DOM document to remove the XML version element
        $svg = new \DOMDocument();
        $svg->load(svg_path($path));
        $svg->documentElement->setAttribute("class", $class);
        $output = $svg->saveXML($svg->documentElement);

        return $output;
    });
});
