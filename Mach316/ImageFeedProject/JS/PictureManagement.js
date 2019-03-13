document.addEventListener("DOMContentLoaded", function (event) {


    function loadMyImages() {
        let imageUrl = "https://api.myjson.com/bins/nkoo6"
        fetch(imageUrl)
            .then((response) =>
            {
                return response.json()
            })
            .then(response => buildMyImages(response))

    }

    function buildMyImages(images) {

        let imagesString = ""

        for(image of images) {
            imagesString += createImageItem(image)
        }

        let userImagesContainer = document.getElementById("user-images-container")
        userImagesContainer.innerHTML = imagesString;


    }

    function createImageItem(image) {

        let id = image.id
        let imageUrl = image.url;
        let imageHeader = image.header;
        let imageDescription = image.text;
        let comments = image.comments;

        let imageItemString = "" +
            "<div class=\"image-item-container\">" +
            "   <div class=\"image-item\" id=\"" + id + "\">" +
            "       <img class=\"feed-image\" src=\"" + imageUrl + "\">" +
            "   </div>" +
            "   <div class=\"image-content-container\">\n" +
            "        <h2 class=\"image-title\">" + imageHeader + "</h2>" +
            "        <div class=\"image-description-container\">" + imageDescription + "" +
            "   </div>" +
            "   <div class=\"comment-list-container\">";
        for (let i = 0; i < comments.length; i++) {
            imageItemString += createCommentItem(comments[i])
        }
        imageItemString += "</div></div></div>"

        return imageItemString;

    }

    function createCommentItem(comment) {
        let author = comment.author;
        let commentContent = comment.comment;
        return "<div class=\"comment-container\"><h3 class=\"comment-author-name\">" + author + "</h3><div class=\"comment\">" + commentContent + "</div></div>"

    }

    function performClick(e) {
        let elemId = 'theFile'
        let elem = document.getElementById(elemId);
        if (elem && document.createEvent) {
            let evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            elem.dispatchEvent(evt);
        }
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
        let btnUpload = document.getElementById("btnUploadImage");
        btnUpload.addEventListener('click', performClick, false)
    }


    function addHandlers() {
        addPreviewImageListener()
        addUploadImageHandler()
    }

    addHandlers()
   // loadMyImages()

})