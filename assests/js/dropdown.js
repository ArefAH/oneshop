const menu = document.querySelector(".menu");

let dropdown = menu.addEventListener("hover", () => {
    menu.classList.toggle("menu-open");
})