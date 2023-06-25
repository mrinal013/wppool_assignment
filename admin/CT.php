<?php

namespace Projects\Admin;

/*
* Custom taxonomy for projects.
*/
trait CT {

        /**
         * Create project taxonomies for the post type "projects".
         *
         */
    public function register_ct() {

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( 'Project Categories', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'textdomain' ),
            'search_items'      => __( 'Search Project Categories', 'textdomain' ),
            'all_items'         => __( 'All Project Categories', 'textdomain' ),
            'parent_item'       => __( 'Parent Category', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
            'edit_item'         => __( 'Edit Category', 'textdomain' ),
            'update_item'       => __( 'Update Category', 'textdomain' ),
            'add_new_item'      => __( 'Add New Category', 'textdomain' ),
            'new_item_name'     => __( 'New Category Name', 'textdomain' ),
            'menu_name'         => __( 'Project Category', 'textdomain' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'project_categories' ),
        );

        register_taxonomy( 'project_cat', array( 'projects' ), $args );

    }
}