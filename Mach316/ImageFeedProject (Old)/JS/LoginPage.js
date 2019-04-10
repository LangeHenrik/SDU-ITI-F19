document.addEventListener("DOMContentLoaded", function (event) {






    //From stackoverflow: https://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
            textbox.addEventListener(event, function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        });
    }


    function setInputFilters() {
        elements = getInputElements();

        for (element of elements) {
            setInputFilter(element, function (value) {
                return /^\d*\.?\d*$/.test(value);
            });
        }
    }

    function getInputElements() {
        inputElementIds = ["phone-input-box", "zip-input-box", "update-user-zip", "update-user-phonenumber"];
        inputElements = [];
        for (id of inputElementIds) {
            console.log(id)
            element = document.getElementById(id);

            if (element != null) {
                inputElements.push(element)
            }
        }

        console.log(inputElements)
        return inputElements;
    }


    setInputFilters();

})