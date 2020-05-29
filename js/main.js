const openMenu = document.querySelector('#open-menu');
const closeMenu = document.querySelector('#close-menu');
const menuButton = document.querySelector('#menu-button');
const menuBody = document.querySelector('#menubody');

let menuStatus = false;

menuButton.addEventListener('click', () => {
    console.log(menuStatus);
    if (menuStatus == false) {
        // closeMenu.classList.remove('visible');
        // openMenu.classList.add('visible');
        // menuBody.classList.add('change');
        document.getElementById("menuLinkContainer").style.display = "block";
        menuBody.classList.add('change');
        openMenu.classList.remove('visible');
        closeMenu.classList.add('visible');
        menuStatus = true;
    } else if (menuStatus == true) {
        // openMenu.classList.remove('visible');
        // closeMenu.classList.add('visible');
        // menuButton.classList.remove('change');

        menuBody.classList.remove('change');
        closeMenu.classList.remove('visible');
        openMenu.classList.add('visible');
        menuStatus = false;
        document.getElementById("menuLinkContainer").style.display = "none";
    }
});

