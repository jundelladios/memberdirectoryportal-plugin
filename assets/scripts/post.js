jQuery(document).ready( function() {
  jQuery('.mdp_medias').slick({
    slidesToShow    : 1,
    slidesToScroll  : 1,
    adaptiveHeight: true,
    prevArrow:'<button class="mdpmediabtn mdpprev"><i class="fa-solid fa-angle-left"></i></button>',
    nextArrow: '<button class="mdpmediabtn mdpnext"><i class="fa-solid fa-chevron-right"></i></button>'
  });
});