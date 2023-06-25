jQuery(document).ready(function( $ ) {
	
	$(document).on( 'click', '#add_gallery_single_row .add', function(e) {
        media_uploader = wp.media({
            frame:    "post", 
            state:    "insert", 
            multiple: true 
        });
        media_uploader.on("insert", function(){

            var length = media_uploader.state().get("selection").length;
            var images = media_uploader.state().get("selection").models

            for(var i = 0; i < length; i++){
                var image_url = images[i].changed.url;
                var box = $('#master_box').html();
                $(box).appendTo('#img_box_container');
                var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
                var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
                element.append(html);
                element.find('.meta_image_url').val(image_url);
                console.log(image_url);		
            }
        });
        media_uploader.open();
    })
    .on( 'click', '.gallery_area .remove', function() {
        let parent = $(this).parent().parent();
        parent.remove()
    })
	
    
});