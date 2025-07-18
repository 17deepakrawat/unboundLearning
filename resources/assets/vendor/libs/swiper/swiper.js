import Swiper from "swiper/bundle";

try {
  window.Swiper = Swiper;
} catch (e) {}

export { Swiper };

var mySwiper = new Swiper(".swiper-containers", {
  loop: true,
  autoplay: {
    delay: 2000,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 3,
      spaceBetween: 20,
    },

    576: {
      slidesPerView: 2,
      spaceBetween: 60,
    },

    768: {
      slidesPerView: 2,
      spaceBetween: 60,
    },

    992: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  },
});
