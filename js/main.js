const openMenu = document.querySelector('#open-menu');
const closeMenu = document.querySelector('#close-menu');
const menuButton = document.querySelector('#menu-button');
const menuBody = document.querySelector('#menubody');

let menuStatus = false;

menuButton.addEventListener('click', () => {
    console.log(menuStatus);
    if (menuStatus == false) {

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
        document.getElementById("menuLinkContainer").style.display = "none";
    }
});

function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}