document.addEventListener('DOMContentLoaded', function () {

    function addEventListeners() {
        addRegistrationFieldListeners();
    }

    function addRegistrationFieldListeners() {

        console.log('Reg field listener function started')

        let zipField = document.getElementById('zip-input');

        console.log(zipField);

        zipField.addEventListener('keydown', function () {
            let input = zipField.value
            if (isNaN(input)) {
                console.log('Is letter')
                return false;
            } else {
                console.log('Is number')
                return true;
            }
        });
    }


    addEventListeners()

});

