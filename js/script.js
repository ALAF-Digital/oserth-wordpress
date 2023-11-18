
var swiper = new Swiper(".main-hero .swiper", {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});


var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        420: {
            slidesPerView: 1,
            spaceBetween: 4,
        },

        640: {
            slidesPerView: 2,
            spaceBetween: 6,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});





var mySwiper3 = new Swiper(".mySwiper3", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + '' + (index + 1) + "</span>";
        },
    },


    breakpoints: {
        420: {
            slidesPerView: 1,
            spaceBetween: 4,
        },

        640: {
            slidesPerView: 1,
            spaceBetween: 6,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1200: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
});

var produuctimgdetail = new Swiper(".produuct-imgdetail", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
   
});





document.querySelector(".nav-item.dropdownmy").addEventListener("click", () => {
    document.querySelector("#shop-dropdown").classList.toggle("show")
})
document.querySelector(".nav-item.dropdownmy").addEventListener("mouseover", () => {
    document.querySelector("#shop-dropdown").classList.toggle("show")
})
document.querySelector(".nav-item.dropdownmy").addEventListener("mouseout", () => {
    document.querySelector("#shop-dropdown").classList.toggle("show")
})




