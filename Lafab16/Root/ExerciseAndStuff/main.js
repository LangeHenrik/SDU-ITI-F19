var username;

function register() {
//Select the values written on the website with the querySelector()
  var username = document.querySelector("#uname").value;
  var pword = document.querySelector("#psw").value;
  var pword2 = document.querySelector("#psw2").value;
  var city = document.querySelector("#city").value;
  var zipcode = document.querySelector("#zipcode").value;


  if (pword == pword2){
      username = ["username", "pword", "pword2", "city", "zipcode"]; // How do I save this array for later use?? I made the var global but i cant acces it from the login function
      console.log("You are now registered and ready to login! Click here to login")
  } else {
    console.log("Sorry! Your password does not match. Please choose the same password.")
  }
}

function login(){
//
  var username = document.querySelector("#uname").value;
  var pword = document.querySelector("#psw").value;

  if(username[0]==username && username[1]==pword){
  //Succes! Jump to the index side
  console.log("Succes! Jump to the index side")
  } else {
    console.log("Sorry! Your username and password do not match. If you not already have a user click on the 'Register'-button and get started!");
  }
}
