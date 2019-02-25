function party() {
  //  document.body.style.backgroundColor = "red";

  //document.getElementById('partybutt').innerHTML = "Make it snow!";

  console.log("Hello");
  alert("Color changed!");



}


function checkInput() {
  var name = document.getElementById('name').value;
  var password = document.getElementById('password').value;
  var phone = document.getElementById('phone').value;
  var email = document.getElementById('email').value;
  var zip = document.getElementById('zip').value;

  var nameRE = /([a-z]|[A-Z])+\s+([a-z]|[A-Z])/g;

  if (true) {

  } else {

  }


  if (password.length < 8) {
    alert("password too short. Please try againg.");
    return false;

  } else {
    return true;
  }






}
