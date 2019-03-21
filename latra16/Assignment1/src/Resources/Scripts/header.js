var userMenuIsVisible = false;
var navIsVisible = false;

function userMenu(elemRef){
    this.userMenuIsVisible = !this.userMenuIsVisible;
    if(userMenuIsVisible){
        elemRef.classList.add("userMenu--visible");
    } else{
        elemRef.classList.remove("userMenu--visible");
    }
}

function nav(){
    this.navIsVisible = !this.navIsVisible;
    var navElements = document.getElementById("nav").querySelector('.nav_elements');
    if(navIsVisible){
        navElements.classList.add("nav--visible");
    } else{
        navElements.classList.remove("nav--visible");
    }
}
