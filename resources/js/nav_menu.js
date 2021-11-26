const menuButton = document.querySelector("#menu");
const navItems = document.querySelector("#navigation");
if (menuButton) {
    menuButton.addEventListener("click", () => {
        navItems.classList.toggle("hidden");
    });
}
