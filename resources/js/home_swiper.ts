import Swiper from "swiper";
import "swiper/css/bundle";

new Swiper(".homeSwiper", {
    slidesPerView: 2,
    spaceBetween: 20,
    freeMode: true,
    grabCursor: true,

    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 8,
            spaceBetween: 30,
        },
    },
});
