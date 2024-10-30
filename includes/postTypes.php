<?php
/**
 * Created by PhpStorm.
 * User: gertz
 * Date: 15.03.18
 * Time: 14:33
 */
function blf_addForms()
{
    $labels = array(
        'name' => 'BLS Forms',
        'all_items' => 'Existing Forms',

    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_icon'  => 'dashicons-carrot',
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title','thumbnail')
    );
    register_post_type('bls-forms',$args);
}
add_action('init', 'blf_addForms');