const openMenu = document.querySelector('#open-menu');
const closeMenu = document.querySelector('#close-menu');
const menuButton = document.querySelector('#menu-button');
const menuBody = document.querySelector('#menubody');

let menuStatus = false;

menuButton.addEventListener('click', () => {
    if (menuStatus == false) {
        closeMenu.classList.remove('visible');
        openMenu.classList.add('visible');
        menuBody.classList.add('change');
        menuStatus = true;
    } else if (menuStatus == true) {
        openMenu.classList.remove('visible');
        closeMenu.classList.add('visible');
        menuButton.classList.remove('change');
        menuStatus = false;
    }
});