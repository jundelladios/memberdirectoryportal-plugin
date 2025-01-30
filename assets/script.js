// const mdpselector = '.mdp_medias';
// if(document.querySelector(mdpselector)) {
//   mdp_init_slides();
// }

// function mdp_init_slides() {
  
//   const mdpsiema = new Siema({
//     selector: mdpselector,
//     duration: 200,
//     easing: 'ease-out',
//     perPage: 1,
//     startIndex: 0,
//     draggable: true,
//     multipleDrag: true,
//     threshold: 20,
//     loop: true,
//     rtl: false,
//     onInit: () => {},
//     onChange: () => {},
//   });

//   const mdpsiemaInterval = setInterval(() => mdpsiema.next(), 5000);

//   const mdpslidevideo = document.querySelector(".mdp_vid");

//   const mdpslideprev = document.querySelector(".mdpprev");
//   if(mdpslideprev) {
//     document.querySelector(".mdpprev").addEventListener("click", () => {
//       mdpsiema.prev();
//       clearInterval(mdpsiemaInterval)
//       if(mdpslidevideo) {
//         mdpslidevideo.pause();
//       }
//     });
//   }

//   const mdpslidenext = document.querySelector(".mdpnext");
//   if(mdpslidenext) {
//     document.querySelector(".mdpnext").addEventListener("click", () => {
//       mdpsiema.next();
//       clearInterval(mdpsiemaInterval)
//       if(mdpslidevideo) {
//         mdpslidevideo.pause();
//       }
//     });
//   }


//   document.querySelector(mdpselector).addEventListener("mouseover", function() {
//     clearInterval(mdpsiemaInterval)
//   });
// }


jQuery(document).ready( function() {
  jQuery('.mdp_medias').slick({
    slidesToShow    : 1,
    slidesToScroll  : 1,
    adaptiveHeight: true,
    prevArrow:'<button class="mdpmediabtn mdpprev"><i class="fa-solid fa-angle-left"></i></button>',
    nextArrow: '<button class="mdpmediabtn mdpnext"><i class="fa-solid fa-chevron-right"></i></button>'
  });
  
  jQuery('.mdp_medias').slickLightbox({
    itemSelector        : 'a',
    navigateByKeyboard  : true,
    slick: {
      prevArrow:'<button class="mdpmediabtn mdpprev"><i class="fa-solid fa-angle-left"></i></button>',
      nextArrow: '<button class="mdpmediabtn mdpnext"><i class="fa-solid fa-chevron-right"></i></button>'
    }
  });
});

if(document.querySelector(".mdp-more-button")) {
  document.querySelector(".mdp-more-button").addEventListener("click", () => {
    if(document.querySelector(".mdp-more-filter")) {
      document.querySelector(".mdp-more-filter").classList.toggle('active')
    }
  });
}