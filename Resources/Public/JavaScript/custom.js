$( document ).ready(function() {
  $('.ns-whatsapp-btn').on('click', function() {
    $(this).parents('[class*="col-"]').siblings().slideToggle();
    $(this).parents('[class*="col-"]').siblings().toggleClass("show");
  });

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
  if (document.getElementById("resetStyle6")){
    document.getElementById("resetStyle6").addEventListener("click",function (){

      $("#deleteImage").val(1)
      $('#submit6').click();
    })
  }
if (document.querySelectorAll(".addValidrequired").length>0){
  document.querySelectorAll(".addValidrequired").forEach(el => el.addEventListener('click', event => {
    if (el.getAttribute("data-id") == 0) {
      $("#imageurl").attr('required', 'required')
      $("#image-upload").removeAttr('required', 'required')
    } else {
      $("#imageurl").removeAttr('required', 'required')
      $("#image-upload").attr('required', 'required')
    }
  }));
}
  if (document.getElementById("validStyle7")) {
    document.getElementById("validStyle7").addEventListener("click",function (e){
      if ($("#imageurlradio").prop("checked")) {
        if (!isImgLink($("#imageurl").val())){
          $(".urlvalid").removeClass('d-none');
          e.preventDefault();
        }else{
          $(".urlvalid").addClass('d-none');
        }
      }else{
        $(".urlvalid").addClass('d-none');
      }

    });
  }

  function isImgLink(url) {
    if(typeof url !== 'string') return false;
    return(url.match(/^http[^\?]*.(jpg|jpeg|gif|png|tiff|bmp)(\?(.*))?$/gmi) != null);
  }
});  