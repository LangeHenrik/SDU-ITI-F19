

let validNameFormat = function(name) {
    return(/[A-z]\s[A-z]/.test(name))
}

let validPassword = function(psw) {

    if(psw.length < 8) {
        return false
    }
    return(/[A-z]\d/.test(psw))

}

let validPhoneNumber = function(phonenumber) {
    return (phonenumber[0] =='+'
        && phonenumber.length >= 8
        && phonenumber.length <= 30)
}

let validEmail = function (email) {
    return(/[A-Za-z0-9\._+]+@[A-Za-z]+\.(com|org|edu|net)/.test(email))
}

let validZipcode = function (zipcode) {
    return ((/\d/).test(zipcode) && zipcode.length === 4)
}

let samePassword = function(psw1, psw2) {
    return psw1 === psw2;
}
