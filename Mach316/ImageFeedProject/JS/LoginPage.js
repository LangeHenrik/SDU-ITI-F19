document.addEventListener("DOMContentLoaded", function (event) {

    function enableLoginOverlay() {
        document.getElementById("background-overlay").style.display = "block";
    }



    function addAlreadyMemberBtnEventListener() {
        let  submitBtn= document.getElementById("btnAlreadyMember")
        submitBtn.addEventListener('click', enableLoginOverlay, false)
    }

    addAlreadyMemberBtnEventListener();




    //From stackoverflow: https://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
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

        for(element of elements) {
            setInputFilter(element, function(value) {
                return /^\d*\.?\d*$/.test(value);
            });
        }
    }

    function getInputElements() {
        inputElementIds = ["phone-input-box", "zip-input-box"];
        inputElements = [];
        for(id of inputElementIds) {
            element = document.getElementById(id);

            inputElements.push(element)
        }

        console.log(inputElements)
        return inputElements;
    }



    setInputFilters();



})