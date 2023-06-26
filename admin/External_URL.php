<?php

namespace Projects\Admin;

trait External_URL {

    public function project_external_url() {
        add_meta_box(
            'post_custom_url',
            __( 'Project URL', 'projects' ),
            array( $this, 'project_url_metabox_callback' ),
            'projects',
            'normal',
            'core',
            array( '__back_compat_meta_box' => true )
        );
    }

    public function project_url_metabox_callback( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( basename(__FILE__), 'project_external_url_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
		$project_external_url = get_post_meta( $post->ID, '_project_external_url', true );

        ?>
        <input type="text" id="project-external-url" name="project_external_url" value="<?php echo esc_url( $project_external_url ); ?>" />
        <?php

    }

    public function project_url_save( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'project_external_url_nonce' ] ) && wp_verify_nonce( $_POST[ 'project_external_url_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
				return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Correct post type
		if ( isset( $_POST['post_type'] ) && 'projects' != $_POST['post_type'] ) {
			return;
        }

        if ( isset( $_POST['project_external_url'] ) && $_POST['project_external_url'] ) {
            update_post_meta( $post_id, '_project_external_url', sanitize_url( $_POST['project_external_url'] ) );
        }
    }

    public function project_url_meta() {
        $metafields = array( '_project_external_url' );

        foreach( $metafields as $metafield ) {
            // Pass an empty string to register the meta key across all existing post types.
            register_post_meta( '', $metafield, array(
                'show_in_rest' => true,
                'type' => 'string',
                'single' => true,
                'sanitize_callback' => 'sanitize_text_field',
                'auth_callback' => function() { 
                    return current_user_can( 'edit_posts' );
                }
            ));
        }
    }

}