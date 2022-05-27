(function($) {
  'use strict';
  if ($("#lightgallery").length) {
    $("#lightgallery, #lightgallery2, #lightgallery3, #lightgallery1, #lightgallery4, #lightgallery5").lightGallery();
  }

  if ($("#lightgallery-without-thumb").length) {
    $("#lightgallery-without-thumb").lightGallery({
      thumbnail: true,
      animateThumb: false,
      showThumbByDefault: false
    });
  }

  if ($("#video-gallery").length) {
    $("#video-gallery").lightGallery();
  }
})(jQuery);