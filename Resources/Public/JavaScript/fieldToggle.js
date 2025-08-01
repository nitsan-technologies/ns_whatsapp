import $ from 'jquery';

$('.field-info-trigger').on('click', function(){
    $(this).parents('.form-group').find('.field-info-text').slideToggle();
});
