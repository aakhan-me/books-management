<?php

class BMP_Book_CPT {
    public static function bmp_book_cpt_function() {
        $labels = array(
            'name'                  => _x( 'Books', 'Post Type General Name', 'ikonic' ),
            'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'ikonic' ),
            'menu_name'             => __( 'Books', 'ikonic' ),
            'name_admin_bar'        => __( 'Books', 'ikonic' ),
            'archives'              => __( 'Item Archives', 'ikonic' ),
            'attributes'            => __( 'Item Attributes', 'ikonic' ),
            'parent_item_colon'     => __( 'Parent Item:', 'ikonic' ),
            'all_items'             => __( 'All Items', 'ikonic' ),
            'add_new_item'          => __( 'Add New Item', 'ikonic' ),
            'add_new'               => __( 'Add New', 'ikonic' ),
            'new_item'              => __( 'New Item', 'ikonic' ),
            'edit_item'             => __( 'Edit Item', 'ikonic' ),
            'update_item'           => __( 'Update Item', 'ikonic' ),
            'view_item'             => __( 'View Item', 'ikonic' ),
            'view_items'            => __( 'View Items', 'ikonic' ),
            'search_items'          => __( 'Search Item', 'ikonic' ),
            'not_found'             => __( 'Not found', 'ikonic' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'ikonic' ),
            'featured_image'        => __( 'Featured Image', 'ikonic' ),
            'set_featured_image'    => __( 'Set featured image', 'ikonic' ),
            'remove_featured_image' => __( 'Remove featured image', 'ikonic' ),
            'use_featured_image'    => __( 'Use as featured image', 'ikonic' ),
            'insert_into_item'      => __( 'Insert into item', 'ikonic' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'ikonic' ),
            'items_list'            => __( 'Items list', 'ikonic' ),
            'items_list_navigation' => __( 'Items list navigation', 'ikonic' ),
            'filter_items_list'     => __( 'Filter items list', 'ikonic' ),
        );

        $rewrite = array(
            'slug'                  => 'book',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'Book', 'ikonic' ),
            'description'           => __( 'Post Type Description', 'ikonic' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => false,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-portfolio',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        
        register_post_type( 'books', $args );
    }
}
