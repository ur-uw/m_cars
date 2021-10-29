const menuButton = document.querySelector("#menu");
const navItems = document.querySelector("#navigation");
menuButton.addEventListener("click", () => {
    navItems.classList.toggle("hidden");
});
