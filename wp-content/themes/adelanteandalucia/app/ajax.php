<?php
namespace App;

class Ajax
{
    public function __construct()
    {
        add_action('wp_ajax_load_more', [$this, 'loadMore']);
        add_action('wp_ajax_nopriv_load_more', [$this, 'loadMore']);
    }

    public function loadMore()
    {
        $args = array();
        $args['post_status'] = "publish";
        $partial = isset($_POST['partial']) && strlen($_POST['partial']) ? $_POST['partial'] :  'content';
        $args['posts_per_page']  = isset($_POST['posts_per_page']) && strlen($_POST['posts_per_page']) ? $_POST['posts_per_page'] :  get_option('posts_per_page');
        $args['post_type'] = isset($_POST['post_type']) && strlen($_POST['post_type']) ? $_POST['post_type'] : 'un_media';
        $args['tax_query'][] = isset($_POST['area']) && strlen($_POST['area']) ? array(
            'taxonomy' => 'un_area',
            'field' => 'slug',
            'terms' => esc_attr($_POST['area'])
        ) : null;
        $args['paged']  = isset($_POST['offset']) ? ((esc_attr($_POST['offset'])/$args['posts_per_page']) + 1) : 1;
        $more = new \WP_Query($args);
        $return = '';
        while ($more->have_posts()) :
            $more->the_post();
            $return .= template('partials.' . $partial);
        endwhile;
        wp_reset_postdata();
        wp_die($return);
    }
}
/**
 * Create object to enable pagination
 */
//new Ajax();
