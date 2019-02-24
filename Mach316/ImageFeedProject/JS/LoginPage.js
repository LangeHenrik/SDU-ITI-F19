document.addEventListener("DOMContentLoaded", function (event) {

    function enableLoginOverlay() {
        document.getElementById("background-overlay").style.display = "block";
    }



    function addAlreadyMemberBtnEventListener() {
        let  submitBtn= document.getElementById("btnAlreadyMember")
        submitBtn.addEventListener('click', enableLoginOverlay, false)
    }

    addAlreadyMemberBtnEventListener();

})