//Toggle Navigation Icon onclick
var burger = document.getElementById('burger');
burger.onclick = (function switchIcon(){
    var classIcon = burger.getElementsByTagName("i");
    if(classIcon[0].classList.contains("fa-navicon")){
        classIcon[0].classList.remove("fa-navicon");
        classIcon[0].classList.add("fa-close");
    } else {
        classIcon[0].classList.remove("fa-close");
        classIcon[0].classList.add("fa-navicon");
    }
});