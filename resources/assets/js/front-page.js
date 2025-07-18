/**
 * Main - Front Pages
 */
'use strict';

(function () {
  const nav = document.querySelector('.layout-navbar'),
    heroAnimation = document.getElementById('hero-animation'),
    animationImg = document.querySelectorAll('.hero-dashboard-img'),
    animationElements = document.querySelectorAll('.hero-elements-img'),
    swiperLogos = document.getElementById('swiper-clients-logos'),
    swiperReviews = document.getElementById('swiper-reviews'),
    swiperCourses = document.getElementById('swiper-courses'),
    swiperProgramTypes = document.getElementById('swiper-program-types'),
    swiperRecognisation = document.getElementById('swiper-recognisation'),
    swiperSpecializations = document.getElementById('swiper-specializations'),
    swiperUniversities = document.getElementById('swiper-univerities'),
    ReviewsPreviousBtn = document.getElementById('reviews-previous-btn'),
    ReviewsNextBtn = document.getElementById('reviews-next-btn'),
    ReviewsSliderPrev = document.querySelector('.swiper-button-prev'),
    ReviewsSliderNext = document.querySelector('.swiper-button-next'),
    priceDurationToggler = document.querySelector('.price-duration-toggler'),
    testimonials = document.getElementById('testimonials'),
    priceMonthlyList = [].slice.call(document.querySelectorAll('.price-monthly')),
    priceYearlyList = [].slice.call(document.querySelectorAll('.price-yearly'));

  // Hero
  const mediaQueryXL = '1200';
  const width = screen.width;
  if (width >= mediaQueryXL && heroAnimation) {
    heroAnimation.addEventListener('mousemove', function parallax(e) {
      animationElements.forEach(layer => {
        layer.style.transform = 'translateZ(1rem)';
      });
      animationImg.forEach(layer => {
        let x = (window.innerWidth - e.pageX * 2) / 100;
        let y = (window.innerHeight - e.pageY * 2) / 100;
        layer.style.transform = `perspective(1200px) rotateX(${y}deg) rotateY(${x}deg) scale3d(1, 1, 1)`;
      });
    });
    nav.addEventListener('mousemove', function parallax(e) {
      animationElements.forEach(layer => {
        layer.style.transform = 'translateZ(1rem)';
      });
      animationImg.forEach(layer => {
        let x = (window.innerWidth - e.pageX * 2) / 100;
        let y = (window.innerHeight - e.pageY * 2) / 100;
        layer.style.transform = `perspective(1200px) rotateX(${y}deg) rotateY(${x}deg) scale3d(1, 1, 1)`;
      });
    });

    heroAnimation.addEventListener('mouseout', function () {
      animationElements.forEach(layer => {
        layer.style.transform = 'translateZ(0)';
      });
      animationImg.forEach(layer => {
        layer.style.transform = 'perspective(1200px) scale(1) rotateX(0) rotateY(0)';
      });
    });
  }

  // swiper carousel
  // Customers reviews
  // -----------------------------------
  if (swiperReviews) {
    new Swiper(swiperReviews, {
      slidesPerView: 1,
      spaceBetween: 5,
      grabCursor: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      loop: true,
      loopAdditionalSlides: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        1200: {
          slidesPerView: 3,
          spaceBetween: 26
        },
        992: {
          slidesPerView: 2,
          spaceBetween: 20
        }
      }
    });
  }

  if (swiperCourses) {
    new Swiper(swiperCourses, {
      slidesPerView: 1,
      spaceBetween: 5,
      autoplay: {
        delay: 2000,
        disableOnInteraction: true
      },
      loop: true,
      loopAdditionalSlides: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        1600: {
          slidesPerView: 4,
          spaceBetween: 15
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 30
        }
      }
    });
  }

  if (swiperProgramTypes) {
    new Swiper(swiperProgramTypes, {
      slidesPerView: 1,
      spaceBetween: 5,
      autoplay: {
        delay: 2000,
        disableOnInteraction: true
      },
      loop: true,
      loopAdditionalSlides: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        1600: {
          slidesPerView: 4,
          spaceBetween: 15
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 30
        }
      }
    });
  }

  if (swiperRecognisation) {
    new Swiper(swiperRecognisation, {
      slidesPerView: 5,
      spaceBetween: 2,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false
      },
      loop: true,
      loopAdditionalSlides: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        1200: {
          slidesPerView: 5,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 2,
          spaceBetween: 20
        }
      }
    });
  }

  if (swiperSpecializations) {
    new Swiper(swiperSpecializations, {
      slidesPerView: 1,
      spaceBetween: 5,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false
      },
      loop: true,
      loopAdditionalSlides: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        1200: {
          slidesPerView: 4,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        }
      }
    });
  }

  if (swiperUniversities) {
    new Swiper(swiperUniversities, {
      slidesPerView: 1,
      spaceBetween: 5,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false
      },
      loop: true,
      loopAdditionalSlides: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        1200: {
          slidesPerView: 4,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        480: {
          slidesPerView: 2,
          spaceBetween: 30
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        }
      }
    });
  }

  // Reviews slider next and previous
  // -----------------------------------
  // Add click event listener to next button
  if (ReviewsNextBtn) {
    ReviewsNextBtn.addEventListener('click', function () {
      ReviewsSliderNext.click();
    });
    ReviewsPreviousBtn.addEventListener('click', function () {
      ReviewsSliderPrev.click();
    });
  }

  // Review client logo
  // -----------------------------------
  if (swiperLogos) {
    new Swiper(swiperLogos, {
      slidesPerView: 2,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      breakpoints: {
        992: {
          slidesPerView: 5
        },
        768: {
          slidesPerView: 3
        }
      }
    });
  }

  if (testimonials) {
    new Swiper(testimonials, {
      direction: 'vertical',
      spaceBetween: 1,
      mousewheel: false,
      grabCursor: true,
      loop: true,
      // autoplay: {
      //   delay: 3000,
      //   disableOnInteraction: true
      // },
      breakpoints: {
        1200: {
          slidesPerView: 3,
          spaceBetween: 10
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 10
        },
        
        480: {
          slidesPerView: 3,
          spaceBetween: 10
        },
        320: {
          slidesPerView: 3,
          spaceBetween: 10
        }
      },
      
       // pagination: {
      //   el: '.swiper-pagination',
      //   clickable: true,
      // },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    });

    //     function adjustSwiperHeight() {
    //       const targetDiv = document.getElementById('testimonialsDom'); // Replace with your div's ID or class
    //       const swiperContainer = document.querySelector('.swiper'); // Adjust selector if needed

    //       if (targetDiv && swiperContainer) {
    //         // Set the Swiper container height to match the target div's height
    //         var height = targetDiv.offsetHeight + 360 > 896 ? 812 : targetDiv.offsetHeight+360;
    //         swiperContainer.style.height = `${height}px`;
    //       }
    //     }

    //     // Call the function on window load and resize
    //     window.addEventListener('load', adjustSwiperHeight);
    //     window.addEventListener('resize', adjustSwiperHeight);
    function adjustSwiperHeight() {
      const targetDiv = document.getElementById('testimonialsDom');
      const swiperContainer = document.querySelector('.swiper');
      if (window.innerWidth > 510) {
        if (targetDiv && swiperContainer) {
          var height = targetDiv.offsetHeight + 360 > 896 ? 812 : targetDiv.offsetHeight + 360;
          swiperContainer.style.height = `${height}px`;
        }

      }
    }
    window.addEventListener('load', adjustSwiperHeight);
    window.addEventListener('resize', adjustSwiperHeight);
  }
})
  ();
