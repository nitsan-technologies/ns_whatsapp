$( document ).ready(function() {
  $(document).on("click", ".save", function () {
    $('.flashmessage').html("<p class='alert alert-success'>Your changes has been saved successfully</p>");
  });

  $(document).on("click", ".image-upload", function () { 
    $('.upload').prop("checked", true);
  });

  $(document).on("click", ".add-url", function () { 
    $('.url').prop("checked", true);
  });

  $('.field-info-trigger').on('click', function(){
    $(this).parents('.form-group').find('.field-info-text').slideToggle();
  });

  $('.dataTables_length select,\ .dataTables_filter input').addClass('form-control');

  $('#TypoScriptTemplateModuleController').on('submit',function(e){
    e.preventDefault();
    url = $(this).attr('action');
    $.ajax({
        url:url,
        method:'post',
        data:$(this).serializeArray(),
        success:function() {
            window.location.reload();
        }
    })
  });

  $('#TypoScriptTemplateModuleController').on('submit',function(e){
    require(['TYPO3/CMS/Backend/Notification'], function(Notification) {
        Notification.success('Well done', 'Your configuration is updated successfully.');
    });
  });

  $('.custom-reset').on('click', function(){
    var that = $(this);
    that.find('i').addClass('fa-spin');
    var id = that.attr('data-id');
    var defaultValue = $("#" + id).attr('data-value');
    $("#" + id).val(defaultValue);
    $("#" + id).addClass('form__field');
    setTimeout(function(){
        $("#" + id).removeClass('form__field');
        that.find('i').removeClass('fa-spin');
    }, 2000);
  });

  var json = $.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBwIX97bVWr3-6AIUvGkcNnmFgirefZ6Sw', function(data) {
    $.each( data.items, function( index, font ) {
      $('.combobox').append( $('<option class="form-control"></option>').attr('value', font.family).text(font.family) );
      $('.google-fonts').append("'" + font.family + "' => array('title' => '" + font.family + "'),<br>")
    });
  });

});  