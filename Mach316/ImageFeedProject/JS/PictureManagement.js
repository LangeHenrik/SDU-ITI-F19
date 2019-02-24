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


    function dropHandler(e) {

        e.stopPropagation();
        e.preventDefault();


        if (e.dataTransfer.items) {
            for (let i = 0; i < e.dataTransfer.items.length; i++) {
                if (e.dataTransfer.items[i].kind === 'file') {
                    let file = e.dataTransfer.items[i].getAsFile();
                    handleImagePreview(file)
                }
            }
        }
    }

    function handleImagePreview(file) {
        let preview = document.getElementById("dropZone")
        preview.style.border = "none"
        const img = document.createElement("img");
        img.classList.add("obj");
        img.file = file;
        img.style.maxHeight = "100%"
        img.style.maxWidth = "100%"
        preview.innerHTML = ""
        preview.appendChild(img);

        const reader = new FileReader();
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
        appendImageInputForm()

    }

    function appendImageInputForm() {
        document.getElementById("new-image-input-form").style.display = "block"
    }


    function dragOverHandler(e) {
        e.preventDefault();
        let dropzone = document.getElementById("dropZone")
        // dropzone.style.backgroundColor = "rgba(0,0,100,0.3)"

    }

    function dragLeaveHandler(e) {
        e.preventDefault();
        let dropzone = document.getElementById('dropZone')
        dropzone.style.backgroundColor = "none"
    }

    function addDragDropHandlers() {
        let dropZone = document.getElementById("dropZone")
        dropZone.addEventListener('dragleave', dragLeaveHandler, false)
        dropZone.addEventListener('drop', dropHandler, false)
        dropZone.addEventListener('dragover', dragOverHandler, false)
    }

    function addUploadImageHandler() {
        let btnUpload = document.getElementById("btnUploadImage");
        btnUpload.addEventListener('click', performClick, false)
    }

    function addHandlers() {
        addDragDropHandlers()
        addUploadImageHandler()
    }

    addHandlers()
    loadMyImages()

})