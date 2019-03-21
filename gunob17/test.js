import RegEx;
function test(){
  let name = document.getElementById("randomtext").value;
  if (name.length < 8) {
    alert("only less then 8 carecters");
    return false;
  } else {
    return true;
  }


}

function submitionform(){
  let name = document.getElementById("name").value;
  let reg = new RegEx(/([A-Z][a-z])\w+\s([a-z][A-Z])/)
  let test = reg.constructor;
  if (test.test(name)) {
    alert("success");
  } else {
    alert("this is not a valid name");
  }

}
