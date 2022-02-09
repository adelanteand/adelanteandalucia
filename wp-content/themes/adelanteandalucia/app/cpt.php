<?php
namespace App;

add_action('init', function () {
    $args = array(
        'label'                 => __('Cases', 'adelanteandalucia'),
        'labels'                => array('singular_name' => __('Case', 'adelanteandalucia')),
        'supports'              => array('title', 'thumbnail'),
        'taxonomies'            => array('un_country'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-camera-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'media',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array(
            'slug'                  => 'media',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => false,
        ),
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    //register_post_type('un_media', $args);
}, 0);

add_action('init', function () {
    $args = array(
        'label'                      => 'Pais',
        'hierarchical'               => false,
        'public'                     => true,
        'query_var'                  => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => array(
            'slug'                       => 'pais',
            'with_front'                 => true,
            'hierarchical'               => false,
        )
    );
    //register_taxonomy('un_country', array('un_media'), $args);
});
