require("./bootstrap");
import "./nav_menu";
import "./home_swiper";
declare global {
    interface Window {
        Swiper: any;
        scrollToId: (id: string) => void;
    }
}
// to declare global things and used in all laravel balde we must use window.{name}
window.scrollToId = (id: string) => {
    if (id != null) {
        var elm = document.getElementById(id);
        elm?.scrollIntoView({
            behavior: "smooth",
            block: "start",
            inline: "nearest",
        });
    }
};
