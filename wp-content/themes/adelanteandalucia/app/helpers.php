<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

/**
 * Return path of requested svg file
 * @param  string $file File name
 * @return string       file path
 */
function svg_path($file)
{
    return get_template_directory() . '/assets/images/' . $file;
}


/**
 * Return pagination
 * @param  object custom query
 */
function ungrynerd_pagination($query = null)
{
    global $wp_query;
    $query = $query ? $query : $wp_query;
    $big = 999999999;
    $args = array();
    $paginate = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big, false))),
        'type' => 'array',
        'total' => $query->max_num_pages,
        'format' => '?paged=%#%',
        'mid_size' => 2,
        'end_size' => 1,
        'current' => max(1, get_query_var('paged')),
        'prev_next' => true,
        'prev_text' => '<svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.756 16 0 8l8.756-8L12 2.964 6.487 8 12 13.036 8.756 16z" fill="#24c87e"/> </svg>',
        'next_text' => '<svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.244 0 12 8l-8.756 8L0 13.036 5.513 8 0 2.964 3.244 0z" fill="#24c87e"/> </svg> ',
        'add_args' => array($args)
    ));
    if ($query->max_num_pages > 1) : ?>
        <ul class="c-pagination">
            <?php foreach ($paginate as $page) {
                echo '<li class="c-pagination__item">' . $page . '</li>';
            } ?>
        </ul>
    <?php endif;
}
