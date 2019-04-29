document.addEventListener("DOMContentLoaded", function (event) {



    let testRegister = function () {



        username = document.getElementById('register-username').value;
        firstname = document.getElementById('register-firstname').value;
        lastname = document.getElementById('register-lastname').value;
        fullname = username + " " + lastname;
        psw1 = document.getElementById('register-psw1').value;
        psw2 = document.getElementById('register-psw2').value;
        zip = document.getElementById('zip-input-box').value;
        email = document.getElementById('register-email').value;
        phonenumber = document.getElementById('phone-input-box').value;
        city = document.getElementById('register-city').value;

        validName = validNameFormat(fullname)
        validPass = validPassword(psw1)
        samePassw = samePassword(psw1, psw2)
        validZip = validZipcode(zip)
        validPhone = validPhoneNumber(phonenumber)
        validMail = validEmail(email)

        allValid = true;

        if (!validName) {
            document
                .getElementById('label-register-firstname')
                .innerHTML = 'Only 1 firstname!'
            document
                .getElementById('label-register-lastname')
                .innerHTML = 'Only 1 lastname!'
            allValid = false;
        }
        if (!validPass) {
            document
                .getElementById('label-register-password')
                .innerHTML = 'Password has to be longer than 8 and contain both upper, lower case and digits!';
            allValid = false;
        }
        if (!samePassw) {
            document
                .getElementById('label-repeat-password')
                .innerHTML = 'Password has to be the same'
            allValid = false;
        }
        if (!validZip) {
            document
                .getElementById('label-register-zip')
                .innerHTML = 'Zipcode has to consist of 4 digits!'
            allValid = false;
        }
        if (!validPhone) {
            document
                .getElementById('label-register-phonenumber')
                .innerHTML = 'Phonenumber has to be between 8 and 12 digits!';
            allValid = false;
        }
        if (!validMail) {
            document
                .getElementById('label-register-email')
                .innerHTML = 'Enter valid email!';
            allValid = false
        }

        user = {
            username: username,
            firstname: firstname,
            lastname: lastname,
            password: psw1,
            zip: zip,
            city: city,
            phonenumber: phonenumber,
            email: email
        }



        if (allValid) {
            registerUser(user)
        }


    }

    let registerUser = function (user) {

        url = 'http://localhost:8000/PHP/Register.php?'

        fetch(url, {
            method: 'POST',
            body: user,
            headers: {
                'Content-Type':'application/json'
            }
        })
            .then(function (response) {
                return response.json();
            })
            .then(response => console.log(response))
            .catch(error => console.error('Error:', error));

    }





    let validNameFormat = function (name) {
        return (/[A-z]\s[A-z]/.test(name))
    }

    let validPassword = function (psw) {

        if (psw.length < 8) {
            return false
        }
        return (/[A-z]\d/.test(psw))

    }

    let validPhoneNumber = function (phonenumber) {
        return (phonenumber.length >= 8
            && phonenumber.length <= 30)
    }

    let validEmail = function (email) {
        return (/[A-Za-z0-9\._+]+@[A-Za-z]+\.(com|org|edu|net)/.test(email))
    }

    let validZipcode = function (zipcode) {
        return ((/\d/).test(zipcode) && zipcode.length === 4)
    }

    let samePassword = function (psw1, psw2) {
        return psw1 === psw2;
    }


    function addRegisterBtnListener() {
        btnSubmit = document.getElementById("btnSubmit");
        btnSubmit.addEventListener('click', testRegister, false)
    }

    //addRegisterBtnListener()

})
