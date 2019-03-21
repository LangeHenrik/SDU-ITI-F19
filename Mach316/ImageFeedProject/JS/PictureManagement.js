document.addEventListener("DOMContentLoaded", function (event) {



    function performClick(e) {

        console.log("CLICK")

        let elemId = 'theFile'
        let elem = document.getElementById(elemId);
        if (elem && document.createEvent) {
            let evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            elem.dispatchEvent(evt);
        }
        document.body.scrollTop = document.documentElement.scrollTop = 0;
    }


    //From stackoverflow  - https://stackoverflow.com/questions/18457340/how-to-preview-selected-image-in-input-type-file-in-popup-using-jquery
    function PreviewImage() {
        document.getElementById('preview').style.display = 'block';
        document.getElementById('btn-submit-image').disabled = false;
        let oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("theFile").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("preview").src = oFREvent.target.result;
        };
    };


    function addPreviewImageListener() {
        document.getElementById('theFile').addEventListener('change', PreviewImage);
    }


    function addUploadImageHandler() {
        if(document.getElementById('btn-upload-pulse') != null) {
            let btnUploadPulse = document.getElementById('btn-upload-pulse')
            btnUploadPulse.addEventListener('click', performClick, false)
        }
        if(document.getElementById('btn-upload-no-pulse') != null) {
            let btnUpload = document.getElementById("btn-upload-no-pulse");
            btnUpload.addEventListener('click', performClick, false)
        }

    }


    function addHandlers() {
        addPreviewImageListener()
        addUploadImageHandler()
    }

    addHandlers()
   // loadMyImages()

})