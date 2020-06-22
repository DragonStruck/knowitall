const openMenu = document.querySelector('#open-menu');
const closeMenu = document.querySelector('#close-menu');
const menuButton = document.querySelector('#menu-button');
const menuBody = document.querySelector('#menubody');

let menuStatus = false;

menuButton.addEventListener('click', () => {
    console.log(menuStatus);
    if (menuStatus == false) {

        document.getElementById("menubody").style.display = "block";
        document.getElementById("menuLinkContainer").style.display = "block";
        menuBody.classList.add('change');
        openMenu.classList.remove('visible');
        closeMenu.classList.add('visible');
        menuStatus = true;
    } else if (menuStatus == true) {

        menuBody.classList.remove('change');
        closeMenu.classList.remove('visible');
        openMenu.classList.add('visible');
        menuStatus = false;
        document.getElementById("menubody").style.display = "none";
        document.getElementById("menuLinkContainer").style.display = "none";
    }
});

const kalenderButton = document.querySelector('#calender');
const kalenderBody = document.querySelector('#calenderbody');

let kalenderStatus = false;

kalenderButton.addEventListener('click', () => {
    console.log(kalenderStatus);
    if (kalenderStatus == false) {
        kalenderBody.classList.remove('addtop')
        // kalenderBody.style.display = 'block';
        kalenderBody.style.opacity = 1;
        kalenderStatus = true;
    } else if (kalenderStatus == true) {

        // kalenderBody.style.display = 'none';
        kalenderBody.classList.add('addtop')
        kalenderBody.style.opacity = 0;
        kalenderStatus = false;
    }
});

const formButton = document.querySelector('#upload');
const formBody = document.querySelector('#formbody');

let formStatus = false;

formButton.addEventListener('click', () => {
    console.log("sdfw");
    if (formStatus == false) {
        formBody.classList.add('mobileform')
        formStatus = true;
    } else if (formStatus == true) {
        formBody.classList.remove('mobileform')
        formStatus = false;
    }
});




