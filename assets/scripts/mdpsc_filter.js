if(document.querySelector(".mdp-more-button")) {
  document.querySelector(".mdp-more-button").addEventListener("click", () => {
    if(document.querySelector(".mdp-more-filter")) {
      document.querySelector(".mdp-more-filter").classList.toggle('active')
    }
  });
}