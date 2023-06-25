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
            array('__back_compat_meta_box' => true)
        );
    }

    public function project_url_metabox_callback( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( basename(__FILE__), 'project_external_url_nonce' );

        // Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, 'project_external_url', true );

        ?>
        <input type="text" id="project_external_url" name="project_external_url" value="<?php echo esc_url( $value ); ?>" />
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
            update_post_meta( $post_id, 'project_external_url', sanitize_url( $_POST['project_external_url'] ) );
        }
    }

}