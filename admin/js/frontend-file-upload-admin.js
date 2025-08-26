(function ($) {
  'use strict';

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  $(function () {
    // Handler for .ready() called.
    $('#ffu-delete-button').on('click', function (e) {
      e.preventDefault();
      var arrayF = [];
      $('input:checkbox[name=ffu_files]:checked').each(function () {
        arrayF.push($(this).val());
      });
      console.log('arrayF :', arrayF);

      console.log(arrayF);
      $.ajax({
        type: 'POST',
        url: the_ajax_script.ajaxurl,
        data: { action: 'ffu_file_delete_ajax', checked: arrayF },

        success: function (data) {
          console.log(data);
          location.reload();
        },
      });
    });
  });
})(jQuery);
