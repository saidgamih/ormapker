<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

// Register Custom Post Type Marker
// Post Type Key: Marker

class Ormapker_Create_Marker {

    public function __construct()
    {
        add_action('init', array($this, 'create_marker_cpt'), 0);
    }

    public function create_marker_cpt() {
        $labels = array(
            'name' => _x( 'Markers', 'Post Type General Name', 'ormapker' ),
            'singular_name' => _x( 'Marker', 'Post Type Singular Name', 'ormapker' ),
            'menu_name' => _x( 'Google Maps markers', 'Admin Menu text', 'ormapker' ),
            'name_admin_bar' => _x( 'Marker', 'Add New on Toolbar', 'ormapker' ),
            'archives' => __( 'Marker', 'ormapker' ),
            'attributes' => __( 'Marker', 'ormapker' ),
            'parent_item_colon' => __( 'Marker', 'ormapker' ),
            'all_items' => __( 'All Markers', 'ormapker' ),
            'add_new_item' => __( 'Add New Marker', 'ormapker' ),
            'add_new' => __( 'Add New', 'ormapker' ),
            'new_item' => __( 'New Marker', 'ormapker' ),
            'edit_item' => __( 'Edit Marker', 'ormapker' ),
            'update_item' => __( 'Update Marker', 'ormapker' ),
            'view_item' => __( 'View Marker', 'ormapker' ),
            'view_items' => __( 'View Markers', 'ormapker' ),
            'search_items' => __( 'Search Marker', 'ormapker' ),
            'not_found' => __( 'Not found', 'ormapker' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'ormapker' ),
            'featured_image' => __( 'Featured Image', 'ormapker' ),
            'set_featured_image' => __( 'Set featured image', 'ormapker' ),
            'remove_featured_image' => __( 'Remove featured image', 'ormapker' ),
            'use_featured_image' => __( 'Use as featured image', 'ormapker' ),
            'insert_into_item' => __( 'Insert into Marker', 'ormapker' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Marker', 'ormapker' ),
            'items_list' => __( 'Markers list', 'ormapker' ),
            'items_list_navigation' => __( 'Markers list navigation', 'ormapker' ),
            'filter_items_list' => __( 'Filter Markers list', 'ormapker' ),
        );
        
        $args = array(
            'label' => __( 'Marker', 'ormapker' ),
            'description' => __( 'Map marker', 'ormapker' ),
            'labels' => $labels,
            'menu_icon' => 'dashicons-location-alt',
            'supports' => array('title', 'editor'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'has_archive' => false,
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'can_export' => true,
            'show_in_nav_menus' => false,
            'menu_position' => 5,
            'capability_type' => 'post',
            'show_in_rest' => false,
            'query_var' => 'ormapker_marker',
        );
        register_post_type( 'ormapker_marker', $args );
    }
}