(function (window) {
    'use strict';
    window.PhotoMosaic.LightboxBridge.nextgenpro = function ($, $mosaic, $items) {
        if ( !window.nplModalSettings ) {
            PhotoMosaic.Utils.log.error(
                "Please make sure NextGEN Pro is installed and that Gallery > Other Options > Lightbox Effect > 'What must the lightbox be applied to?' is set to 'Only apply to NextGEN and WordPress images'."
            );
            return false;
        }

        var mosaic_id = $mosaic.parent().data('photoMosaic')._id;
        var npl_class = 'nextgen_pro_lightbox';

        if (!window.galleries) {
            window.galleries = {};
        }

        $items.each(function () {
            var $this = $(this);
            var $img = $this.find('img');
            var data = $this.data();
            var gallery_id = "gallery_" + mosaic_id;
            var image_id = $img.attr('id');

            $this.addClass(npl_class).data({
                'nplmodal-gallery-id' : mosaic_id,
                'nplmodal-image-id' : image_id
            });

            if (!window.galleries[ gallery_id ]) {
                window.galleries[ gallery_id ] = {
                    ID : mosaic_id,
                    images_list : [],
                    display_settings : {}
                };
            }

            window.galleries[ gallery_id ].images_list.push({
                description : "",
                image : $this.attr('href'),
                image_id : image_id,
                thumb : $img.attr('src'),
                title : $this.attr('title')
            });

        }).nplModal(window.nplModalSettings);
    }
}(window));