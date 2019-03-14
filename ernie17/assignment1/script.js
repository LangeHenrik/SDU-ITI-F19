function checkLoginFields() {
    console.log("*****     Login Checks incomming     *****")
    var name = document.getElementById("login-username").value

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

    return false
}

function checkRegisterFields() {
    console.log("*****     Register Checks incomming     *****")
    var username = document.getElementById("register-username").value

    var password = document.getElementById("register-password").value
    var validPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/.test(password)
    if (validPassword && password.length > 7)
        console.log("Password is fine")

    var passwordRepeat = document.getElementById("register-password-repeat").value

    var firstname = document.getElementById("register-firstname").value

    var lastname = document.getElementById("register-lastname").value

    var zip = document.getElementById("register-zip").value
    var validZip = /^[0-9]{4}$/.test(zip)
    if (validZip)
        console.log("Zip code is fine")

    var email = document.getElementById("register-email").value

    var phone = document.getElementById("register-phone").value
    var validPhone = /^\+[0-9]{8,30}$/.test(phone)
    if (validPhone)
        console.log("Phone number is fine")


    return false
}
