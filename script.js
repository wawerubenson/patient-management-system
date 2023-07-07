
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const theme = document.querySelector(".theme-toggler");



menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', ()=> {
    sideMenu.style.display = 'none';
});

// change theme
theme.addEventListener('click', ()=> {
    document.body.classList.toggle('dark-theme-variables');

    theme.querySelector('span:nth-child(1)').classList.toggle('active');
    theme.querySelector('span:nth-child(2)').classList.toggle('active'); 
})


