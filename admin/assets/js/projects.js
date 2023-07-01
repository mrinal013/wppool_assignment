jQuery(document).ready(function( $ ) {
    $(document).on( 'click', '#add_gallery_single_row .add', function(e) {
        let media_uploader = wp.media({
            frame:    "post", 
            state:    "insert", 
            library : { type : 'image'},
            multiple: true
        });
        media_uploader.on("insert", function(){

            let length = media_uploader.state().get("selection").length;
            let images = media_uploader.state().get("selection").models

            for(let i = 0; i < length; i++){
                let image_url = images[i].changed.url;
                let box = $('#master_box').html();
                $(box).appendTo('#img_box_container');
                let element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
                let html = '<img class="gallery_img_img" src="'+image_url+'" height="auto" width="100%" />';
                element.append(html);
                element.find('.meta_image_url').val(image_url);
            }
        });
        media_uploader.open();
    })
    .on( 'click', '.gallery_area .remove', function() {
        let parent = $(this).parent().parent();
        parent.remove()
    });
})