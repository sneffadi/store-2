jQuery(document).ready(function($) {

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('#meta-image-button').click(function(e) {

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if (meta_image_frame) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: {
                text: meta_image.button
            },
            library: {
                type: 'image'
            }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function() {

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            $('#meta-image').val(media_attachment.filename);
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });
});
(function($jq) {
        $jq(document).ready(function() {
            /* Toggle the custom data visibility */
            $jq('.toggle-div').on('click', function() {
                var toggleDiv = $jq(this).attr('data-toggle-div');
                if($jq(this).is(':checked')) $jq('.' + toggleDiv).show(300);
                else $jq('.' + toggleDiv).hide(300);
                });
            });
        })(jQuery.noConflict());