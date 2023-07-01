<?php

namespace Projects\Admin;

trait Block {
    public function create_block_projects_block_init() {
        add_shortcode( 'projects', array( $this, 'projects_render_shortcode' ) );
        register_block_type( PLUGIN_MAIN_DIR . '/projects/build', array(
            'render_callback' => array( $this, 'projects_render_shortcode' )
        ) );
    }

    public function projects_render_shortcode() {
        $html = '<div id="projects"></div>';
        return $html;
    }
}