<?php

namespace Projects\Admin;

trait REST_API {
    public function rest_api_all_projects() {
        register_rest_route( 'projects/v1', '/all', array(
            'methods' => 'GET',
            'callback' => [ $this, 'get_all_projects' ],
            'permission_callback' => '__return_true'
          ) );
    }

    public function get_all_projects() {
        $args = array(
            'post_type' => 'projects',
            'posts_per_page' => -1,
            'fields' => 'ids'
        );
        $all_projects_query = new \WP_Query( $args );
        $all_projects = $all_projects_query->posts;

        $return_data = array();

        if ( ! empty( $all_projects ) ) {
            foreach ( $all_projects as $project ) {
                $project_title = get_the_title( $project );
                $project_thumbnail_url = get_the_post_thumbnail_url( $project, 'full' );
                $project_cat = get_the_terms( $project, 'project_cat' );
                $object = new \StdClass();
                $object->project_title = $project_title;
                $object->project_id = $project;
                $object->project_cover = $project_thumbnail_url;
                $object->project_cat = $project_cat;
                $return_data[] = $object;
            }
            return $return_data;
        } else {
            new \WP_Error( 'There are no project' );
        }
        
    }
}