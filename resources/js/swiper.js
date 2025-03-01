// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

const length = document.querySelectorAll('.gallery-top .swiper-slide').length

const loop = (length <= 1) ? false : true

export const galleryThumbs = new Swiper('.gallery-thumbs', {
    spaceBetween: 10,
    slidesPerView: 3,
    loop: loop,
    freeMode: true,
    // loopedSlides: 1, //looped slides should be the same
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    grabCursor: true,
    initialSlide: 0,
    speed: 1000,
});


export const galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 0,
    initialSlide: 0,
    slidesPerView: 1,
    loop: loop,
    centeredSlides: true,
    // loopedSlides: 1, //looped slides should be the same
    speed: 1000,
    navigation: {
      nextEl: '.swiper-button-next',
    //   prevEl: '.swiper-button-prev',
    },
    thumbs: {
      swiper: galleryThumbs,
    }
});

export const galleryMob = new Swiper('.gallery-mob', {
    spaceBetween: 0,
    slidesPerView: 1,
    loop: loop,
    centeredSlides: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

