<?php

namespace Projects\Admin;

trait Gallery {
    public function project_gallery_metabox() {
        add_meta_box(
            'post_custom_gallery',
            'Gallery',
            array( $this, 'project_gallery_metabox_callback' ),
            'projects',
            'normal',
            'core'
        );
    }

    public function project_gallery_metabox_callback() {
        wp_nonce_field( basename(__FILE__), 'sample_nonce' );
        global $post;
        $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
        ?>
        <div id="gallery_wrapper">
            <div id="img_box_container">
            <?php 
            if ( isset( $gallery_data['image_url'] ) ){
                for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ){
                ?>
                <div class="gallery_single_row dolu">
                  <div class="gallery_area image_container ">
                    <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="55" width="55" />
                    <input type="hidden"
                             class="meta_image_url"
                             name="gallery[image_url][]"
                             value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
                      />
                  </div>
                  <div class="gallery_area">
                    <span class="button remove" title="Remove"><i class="dashicons dashicons-trash"></i></span>
                  </div>
                  <div class="clear"></div>
                </div> 
                </div>
                <?php
                }
            }
            ?>
            </div>
            <div style="display:none" id="master_box">
                <div class="gallery_single_row">
                    <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                        <input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]" />
                    </div> 
                    <div class="gallery_area"> 
                        <span class="button remove" title="Remove"><i class="dashicons dashicons-trash"></i></span>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div id="add_gallery_single_row">
              <input class="button add" type="button" value="+"  title="Add image"/>
            </div>
        </div>
        <?php
    }

    public function project_gallery_save( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'sample_nonce' ] ) && wp_verify_nonce( $_POST[ 'sample_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
				return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Correct post type
		if ( isset( $_POST['post_type'] ) && 'projects' != $_POST['post_type'] ) // here you can set the post type name
			return;
	 
		if ( $_POST['gallery'] ){
			
			// Build array for saving post meta
			$gallery_data = array();
			for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ){
				if ( '' != $_POST['gallery']['image_url'][$i]){
					$gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
				}
			}
	 
			if ( $gallery_data ) 
				update_post_meta( $post_id, 'gallery_data', $gallery_data );
			else 
				delete_post_meta( $post_id, 'gallery_data' );
		} 
		// Nothing received, all fields are empty, delete option
		else{
			delete_post_meta( $post_id, 'gallery_data' );
		}
    }
}