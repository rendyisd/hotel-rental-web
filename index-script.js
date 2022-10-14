// Open login modal if login failed
if($('#login-failed').length){
    $('#login-modal').modal();
}

// Phone Area

var phoneMenuActive = false;
$('.nav-menu-icon').click( ()=>{
    if(!phoneMenuActive){
        $('.dropdown-menu-sw').addClass('phone-menu-active');
        $('.header-menu').css('top', '0');
        phoneMenuActive = true;
        return;
    }
    $('.phone-menu-active').removeClass('phone-menu-active');
    $('.header-menu').css('top', '-90vh');
    phoneMenuActive = false;
});

// Phone Area


let bg_images = ['bg1.jpg', 'bg2.jpg', 'bg3.jpg', 'bg4.jpg'];

let index = 0;
const header_img = document.querySelector('.header-img');

window.onload = () => {
    setInterval(()=>{
        index = index >= (bg_images.length-1) ? 0 : (index+1);
        header_img.style.backgroundImage = `url('image/index-page/backgrounds/${bg_images[index]}')`;
    }, 4000);
}

const stickNav = document.querySelector('.logo-nav');
const logoImage = document.querySelector('.logo-img')
const navArr = Array.from(document.getElementsByClassName('btn-desktop'));

const scrollAnchor = ($('.loc-section').offset().top)-150;

window.addEventListener('scroll', ()=>{
    let scrollHeight = window.scrollY;
    let borderRadius = scrollHeight < 30 ? scrollHeight : 30;

    if(scrollHeight > 0 && scrollHeight < scrollAnchor){
        stickNav.style.backgroundColor = 'white';
        stickNav.style.borderBottomLeftRadius = `${borderRadius}px`;
        stickNav.style.borderBottomRightRadius = `${borderRadius}px`;

        $('.icon-bar').css("background-color", "black");

        navArr.forEach((item) => {
            item.style.color = 'black';
            item.classList.toggle('sticky', true);
        });
        logoImage.src = "image/index-page/logo-black.png";
    }
    else{
        stickNav.style.backgroundColor = '';
        stickNav.style.borderBottomLeftRadius = `${borderRadius}px`;
        stickNav.style.borderBottomRightRadius = `${borderRadius}px`;

        $('.icon-bar').css("background-color", "white");

        navArr.forEach((item) => {
            item.style.color = 'white';
            item.classList.toggle('sticky', false); 
        });
        logoImage.src = "image/index-page/logo-white.png";
    }
});