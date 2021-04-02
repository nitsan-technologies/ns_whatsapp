define([
    'jquery',
    'TYPO3/CMS/Backend/Modal',
    'TYPO3/CMS/NsWhatsapp/Main',
    'TYPO3/CMS/NsWhatsapp/Datatables',
    'TYPO3/CMS/Backend/jquery.clearable'
], function ($, Model) {
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
    $('[data-toggle="tooltip"]').tooltip();

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
  var json = $.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBwIX97bVWr3-6AIUvGkcNnmFgirefZ6Sw', function(data) {
    $.each( data.items, function( index, font ) {
      $('.combobox').append( $('<option class="form-control"></option>').attr('value', font.family).text(font.family) );
      $('.google-fonts').append("'" + font.family + "' => array('title' => '" + font.family + "'),<br>")
    });
  });
});


