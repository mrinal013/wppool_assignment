<?php

namespace Projects\Admin;


trait CPT {

    public function register_cpt() {
        $labels = array(
            'name'                  => _x( 'Projects', 'Post type general name', 'projects' ),
            'singular_name'         => _x( 'Project', 'Post type singular name', 'projects' ),
            'menu_name'             => _x( 'Projects', 'Admin Menu text', 'projects' ),
            'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'projects' ),
            'add_new'               => __( 'Add New', 'projects' ),
            'add_new_item'          => __( 'Add New Project', 'projects' ),
            'new_item'              => __( 'New Project', 'projects' ),
            'edit_item'             => __( 'Edit Project', 'projects' ),
            'view_item'             => __( 'View Project', 'projects' ),
            'all_items'             => __( 'All Projects', 'projects' ),
            'search_items'          => __( 'Search Projects', 'projects' ),
            'parent_item_colon'     => __( 'Parent Projects:', 'projects' ),
            'not_found'             => __( 'No Projects found.', 'projects' ),
            'not_found_in_trash'    => __( 'No Projects found in Trash.', 'projects' ),
            'featured_image'        => _x( 'Project Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'projects' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'projects' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'projects' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'projects' ),
            'archives'              => _x( 'Project archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'projects' ),
            'insert_into_item'      => _x( 'Insert into Project', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'projects' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Project', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'projects' ),
            'filter_items_list'     => _x( 'Filter Projects list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'projects' ),
            'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'projects' ),
            'items_list'            => _x( 'Projects list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'projects' ),
        );     
        $args = array(
            'labels'             => $labels,
            'description'        => 'Projects custom post type.',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'projects' ),
            // 'exclude_from_search' => true,
            'show_in_nav_menus'  => false,
            'has_archive'        => true,
            'capability_type'    => 'post',
            'hierarchical'       => true,
            'menu_position'      => 20,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'taxonomies'         => array( 'project_cat' ),
            'show_in_rest'       => true
        );
         
        register_post_type( 'projects', $args );
    }

    public function project_title( $title ) {
        $screen = get_current_screen();
   
        if  ( 'projects' == $screen->post_type ) {
             $title = __( 'Project Title', 'projects' );
        }
      
        return $title;
    }

}