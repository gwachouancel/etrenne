(function($) {
  'use strict';
  $(function() {
    if ($('#sortable-table-1').length) {
      $('#sortable-table-1').tablesort();
    }
    if ($('#sortable-table-2').length) {
      $('#sortable-table-2').tablesort();
    }
    $('.table.table-striped.table-hover').each(function() {
      $(this).find('th').each(function(){
        $(this).addClass('sortStyle');
        $(this).append('<i class="mdi mdi-chevron-down"></i>');
      });
      $(this).tablesort();
    });
  });
})(jQuery);
