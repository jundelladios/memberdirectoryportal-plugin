const mdpselector = '.mdp_medias';
if(document.querySelector(mdpselector)) {
  mdp_init_slides();
}

function mdp_init_slides() {
  const mdpsiema = new Siema({
    selector: mdpselector,
    duration: 200,
    easing: 'ease-out',
    perPage: 1,
    startIndex: 0,
    draggable: true,
    multipleDrag: true,
    threshold: 20,
    loop: true,
    rtl: false,
    onInit: () => {},
    onChange: () => {},
  });

  const mdpsiemaInterval = setInterval(() => mdpsiema.next(), 5000);

  const mdpslidevideo = document.querySelector(".mdp_vid");

  const mdpslideprev = document.querySelector(".mdpprev");
  if(mdpslideprev) {
    document.querySelector(".mdpprev").addEventListener("click", () => {
      mdpsiema.prev();
      clearInterval(mdpsiemaInterval)
      if(mdpslidevideo) {
        mdpslidevideo.pause();
      }
    });
  }

  const mdpslidenext = document.querySelector(".mdpnext");
  if(mdpslidenext) {
    document.querySelector(".mdpnext").addEventListener("click", () => {
      mdpsiema.next();
      clearInterval(mdpsiemaInterval)
      if(mdpslidevideo) {
        mdpslidevideo.pause();
      }
    });
  }


  document.querySelector(mdpselector).addEventListener("mouseover", function() {
    clearInterval(mdpsiemaInterval)
  });
}