(function (window) {
    'use strict';
    window.PhotoMosaic.LightboxBridge.nextgenpro = function ($, $mosaic, $items) {
        if ( !window.nplModalSettings ) {
            PhotoMosaic.Utils.log.error(
                "Please make sure NextGEN Pro is installed and that Gallery > Other Options > Lightbox Effect > 'What must the lightbox be applied to?' is set to 'Only apply to NextGEN and WordPress images'."
            );
            return false;
        }

        // var gallery_id = $mosaic.parent().data('photoMosaic')._id;
        var npl_class = 'nextgen_pro_lightbox';

        $items.each(function () {
            var $this = $(this);

            $this.addClass(npl_class).data({
                nplmodalGalleryId : '!',
                nplmodalImageId : $this.find('img').attr('id')
            });
        }).nplModal(window.nplModalSettings);
    }
}(window));