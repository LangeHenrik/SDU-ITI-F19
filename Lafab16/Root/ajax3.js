
let piccount = 4;
   window.onscroll = function(){
     if ((document.documentElement.scrollTop+window.innerHeight) > (document.documentElement.offsetHeight-2)) {
       loadDoc();
     }
   }

   function loadDoc() {
     piccount = piccount +4;
     let display = document.getElementById("ajax"); //
           let xmlhttp = new XMLHttpRequest();
           xmlhttp.open("GET", "load_images3.php?pictureCount="+piccount);

           xmlhttp.send();
           xmlhttp.onreadystatechange = function() {
             if (this.readyState === 4 && this.status === 200) {
               //alert("jaxa");
               display.innerHTML = this.responseText;
             } else {
               display.innerHTML = "Loading...";
             };
           }
}
