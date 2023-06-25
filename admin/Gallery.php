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
                    <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                    <input type="hidden"
                             class="meta_image_url"
                             name="gallery[image_url][]"
                             value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
                      />
                  </div>
                  <div class="gallery_area">
                    <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
                  </div>
                  <div class="clear" />
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
                        <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
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
}