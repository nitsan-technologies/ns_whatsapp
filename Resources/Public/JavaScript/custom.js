$('.ns-whatsapp-btn').on('click', function() {
    $(this).parent('[class*="col-"]').siblings().slideToggle();
  });