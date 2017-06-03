jQuery(document).ready(function( $ ){
    'use strict';

    //Make sortable images
    $('#dy-post-gallery-metabox ul').sortable({
        cancel  : 'li.add-new'
    });

    $(document).on( 'click', 'a.dy-post-gallery-delete', function( e ){
        e.preventDefault();
        var li = $(this).closest('li');
        $(li).fadeOut(500, function(){
            $(li).remove();
        });
    });

    $('li.add-new .dy-post-gallery-image img').click(function(){
        renderMediaUploader();
    });
    
    function renderMediaUploader() {
        'use strict';

        var file_frame;

        if ( undefined !== file_frame ) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            frame   : 'post',
            state   : 'insert',
            library : {
                type: 'image',
            },
            multiple: true
        });
        
        file_frame.on( 'insert', function() {

            var selection = file_frame.state().get('selection');
            selection.map(function(attachment) {
                console.log(attachment);
                var image_data = attachment.toJSON();
                $('<li><div class="dy-post-gallery-image"><img src="' + image_data.sizes.thumbnail.url + '" width="100" height="100"/><a href="#" class="dy-post-gallery-delete">x</a><input type="hidden" name="dy_post_gallery_image_url[]" value="' + image_data.id + '"/></div></li>')
                .insertBefore($('#dy-post-gallery-metabox ul li:last')).closest('ul').sortable();
              });

        });

        file_frame.open();

    }
    
});