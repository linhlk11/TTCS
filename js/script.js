let userBox = document.querySelector('.header .flex .account-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

window.onscroll = () =>{
    userBox.classList.remove('active');
    navbar.classList.remove('active');
}

const swiper = new Swiper('.swiper', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,
    speed: 1000,
    centeredSlides: true,
    // autoplay: {
    //     delay: 3000,
    //     disableOnInteraction: false,
    // },
    breakpoints: {
        // when window width is <= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 480px
        480: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 640px
        640: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 768px
        768: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 1024px
        1024: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 1280px
        1280: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 1440px
        1440: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        // when window width is <= 1600px
        1600: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
    },

  
    // If we need pagination
    // pagination: {
    //     el: ".swiper-pagination",
    //     type: "progressbar",
    // },
  
    // Navigation arrows
    // navigation: {
    //   nextEl: '.swiper-button-next',
    //   prevEl: '.swiper-button-prev',
    // },
  
    // And if we need scrollbar
    scrollbar: {
        el: ".swiper-scrollbar",
        hide: true,
    },
});