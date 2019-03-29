window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("header-nav").style.margin = "20px auto";
    document.getElementById("header-logo").style.display = "none";
    document.getElementById("header").style.height = "50px";
  } else {
    document.getElementById("header-nav").style.margin = "0 auto";
    document.getElementById("header-logo").style.display = "block";
    document.getElementById("header").style.height = "100px";
  }
}
