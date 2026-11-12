const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');
const wrapper = document.querySelector('.wrapper');
const registerLink = document.querySelector('.register-link');
const loginLink = document.querySelector('.login-link');
const but_tonPopup = document.querySelector('.but_tonLogin-popup');
const iconClose = document.querySelector('.icon-close');
const form = document.querySelector("form");

// Navbar open/close
if (bar && nav) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    });
}
if (close && nav) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    });
}

// Register toggle
if (registerLink && wrapper) {
    registerLink.onclick = () => {
        wrapper.classList.add('active');
    };
}
if (loginLink && wrapper) {
    loginLink.onclick = () => {
        wrapper.classList.remove('active');
    };
}

// Login popup
if (but_tonPopup && wrapper) {
    but_tonPopup.onclick = () => {
        wrapper.classList.add('active-popup');
    };
}
if (iconClose && wrapper) {
    iconClose.onclick = () => {
        wrapper.classList.remove('active-popup');
        wrapper.classList.remove('active');
    };
}

// SweetAlert events
const sweetalert2 = document.getElementById('sweetalert2');
if (sweetalert2) {
    sweetalert2.addEventListener('click', function () {
        Swal.fire({
            title: "Thank You!",
            text: "Successfull",
            icon: "success"
        });
    });
}
const sweetalert3 = document.getElementById('sweetalert3');
if (sweetalert3) {
    sweetalert3.addEventListener('click', function () {
        Swal.fire({
            title: "Thank You!",
            text: "Successfull",
            icon: "success"
        });
    });
}
