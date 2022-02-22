require("./bootstrap");
import "./nav_menu";
import "./home_swiper";
window.scrollToId = (id) => {
    if (id != null) {
        var elm = document.getElementById(id);
        elm.scrollIntoView({
            behavior: "smooth",
            block: "start",
            inline: "nearest",
        });
    }
};
