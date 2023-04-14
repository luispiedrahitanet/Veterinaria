(function ($) {

  "use strict";

    // PRE LOADER
    $(window).load(function(){
      $('.preloader').fadeOut(1000); // set duration in brackets    
    });


    //Navigation Section
    $('.navbar-collapse a').on('click',function(){
      $(".navbar-collapse").collapse('hide');
    });


    // Owl Carousel
    $('.owl-carousel').owlCarousel({
      animateOut: 'fadeOut',
      items:1,
      loop:true,
      autoplay:true,
    })


    // PARALLAX EFFECT
    $.stellar();  


    // SMOOTHSCROLL
    $(function() {
      $('.navbar-default a, #home a, footer a').on('click', function(event) {
        var $anchor = $(this);
          $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 49
          }, 1000);
            event.preventDefault();
      });
    });  


    // WOW ANIMATION
    new WOW({ mobile: false }).init();


})(jQuery);


// ======================================================

$("#appointment-form").submit(e => {

  e.preventDefault();

  let nombre = $("#nombre").val();
  let email = $("#email").val();
  let telefono = $("#telefono").val();
  let mensaje = $("#mensaje").val();

  $.post("app/bin/CorreoContacto.php", {nombre,email,telefono,mensaje}, (response) => {
    
    if(response = 'enviado'){
      $("#infoDev").html('<p class="alert alert-success" role="alert">Mensaje enviado. Gracias por contactarnos.</p>');
      $("#nombre").val("");
      $("#email").val("");
      $("#telefono").val("");
      $("#mensaje").val("");
    }else{
      $("#infoDev").html('<p class="alert alert-danger" role="alert">Hubo problemas al enviar el mensaje</p>');
    }
  });
  
});

