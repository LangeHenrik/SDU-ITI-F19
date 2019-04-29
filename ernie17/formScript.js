function checkFields() {
    console.log("*****     Checks incomming     *****")
    var names = document.getElementById("name").value.split(" ")
    var nameCount = 0
    names.forEach(function(name) {
        if (name.length > 0)
            nameCount++
    });
    
    if (nameCount < 2)
    {
        //alert("You need at least two names")
        return false
    } else
    {
        console.log("Name is fine!")
    }

    var password = document.getElementById("password").value
    var validPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password)
    if (validPassword && password.length > 7)
        console.log("Password is fine")

    var phone = document.getElementById("phone").value
    var validPhone = /^\+[0-9]{8,30}/.test(phone)
    if (validPhone)
        console.log("Phone number is fine")

    var zip = document.getElementById("zip").value
    var validZip = /[0-9]{4}/.test(zip)
    if (validZip)
        console.log("Zip code is fine")

    return false
}