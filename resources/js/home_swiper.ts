import Swiper from "swiper";
new Swiper(".mySwiper", {
    slidesPerView: 2,
    spaceBetween: 20,
    freeMode: true,
    grabCursor: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
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
