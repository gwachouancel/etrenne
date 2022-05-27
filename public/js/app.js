$.validator.addMethod("validateSelect", function(value, element, arg){
    return value.trim();
   }, "Please select a value");
  (function($) { 
    // general toast message
      showToast = function(type, heading, message) {
        let toastColor = {
            success : '#f96868',
            info: '#46c35f',
            warning: '#57c7d4',
            error: '#f2a654',
        };
        'use strict';
        resetToastPosition();
        $.toast({
          heading: heading,
          text: message,
          showHideTransition: 'slide',
          icon: type,
          loaderBg: toastColor[type],
          position: 'top-right'
        })
      };
      
      resetToastPosition = function() {
        $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
        $(".jq-toast-wrap").css({
          "top": "",
          "left": "",
          "bottom": "",
          "right": ""
        }); //to remove previous position style
      }
    })(jQuery);