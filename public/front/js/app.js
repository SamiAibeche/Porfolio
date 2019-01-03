$(document).ready(function(){
    $('.link_nav').click(function(e) {
        var sectionTo = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(sectionTo).offset().top
        }, 800);
    });

    $('.navbar-nav>li>a').on('click', function(){
        $('.navbar-collapse').collapse('hide');
        var burger = document.getElementById('burger');
        var classIcon = burger.getElementsByTagName("i");
        if(classIcon[0].classList.contains("fa-bars")){
            classIcon[0].classList.remove("fa-bars");
            classIcon[0].classList.add("fa-times");
        } else {
            classIcon[0].classList.remove("fa-times");
            classIcon[0].classList.add("fa-bars");
        }
    });
});
//Toggle Navigation Icon onclick
var burger = document.getElementById('burger');
burger.onclick = (function switchIcon(){
    var classIcon = burger.getElementsByTagName("i");
    if(classIcon[0].classList.contains("fa-bars")){
        classIcon[0].classList.remove("fa-bars");
        classIcon[0].classList.add("fa-times");
    } else {
        classIcon[0].classList.remove("fa-times");
        classIcon[0].classList.add("fa-bars");
    }
});