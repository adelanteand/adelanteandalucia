<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    $classes[] = 'page-frontend';

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip;';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);


add_filter('embed_oembed_html', function ($html, $url, $args){
    $provider = '';
    if (preg_match("#https?://youtu\.be/.*#i", $url) || preg_match("#https?://(www\.)?youtube\.com/watch.*#i", $url)) {
        $provider = 'youtube';
    } elseif (preg_match("/vimeo.com\/([^&]+)/i", $url)) {
        $provider = 'vimeo';
    } elseif (preg_match("/twitch\/([^&]+)/i", $url)) {
        $provider = 'twitch';
    }
    if (!empty($provider)) {
        $html = "<div class='oembed ".$provider."' >". $html . "</div>";
    }
    return $html;
}, 10, 3);

/**
 * Disable the emoji's
 */

add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    add_filter('tiny_mce_plugins', function ($plugins) {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    });
});

/**
 * Disable Gutenberg core blocks
 */
add_filter('allowed_block_types_all', function ($allowed_blocks) {
    return [
        'acf/intro',
        'acf/cta',
        'acf/latest-posts',
        'acf/page-header',
        'acf/team',
        'acf/member',
        'acf/grid-links',
        'acf/links',
        'acf/base',
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/shortcode',
        'core/image',
        'core/embed',
        'core/quote',
        'core/columns',
        'core/column',
        'gravityforms/form',
        'core/html'
    ];
});

add_filter('excerpt_length', function() { return 20; }, 10);

//exclude sticky from home blog query
add_action('pre_get_posts', function($query) {
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('post__not_in', [end(get_option('sticky_posts'))]);
    }
    $query->set('ignore_sticky_posts', true);
});

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
});
