document.addEventListener("DOMContentLoaded", function (event) {

    function loadFeedJSON(callback) {

        var xmlRequest = new XMLHttpRequest();
        xmlRequest.overrideMimeType("application/json");
        xmlRequest.open('GET', 'https://api.myjson.com/bins/177o26', true);
        xmlRequest.onreadystatechange = function () {
            if (xmlRequest.readyState == 4 && xmlRequest.status == "200") {
                callback(xmlRequest.responseText);
            }
        };
        xmlRequest.send(null);
    }


    loadFeedJSON(function (response) {
        // Parsing JSON string into object
        let imageData = JSON.parse(response);
        buildFeedContent(imageData)
    });


    function buildFeedContent(imageData) {
        let feedRenderString = ""

        for (let i = 0; i < imageData.length; i++) {
            feedRenderString += createImageItem(imageData[i])
        }

        document.getElementById("image-feed-container").innerHTML = feedRenderString;

        let commentButtons = document.getElementsByClassName("btnComment");
        console.log(commentButtons)

        for (btn of commentButtons) {
            btn.addEventListener('click', addComment, false)
        }
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
            "   <input class=\"input-comment-author\" type=\"text\" placeholder=\"name\">" +
            "   <textarea cols=\"80\" rows=\"5\" placeholder=\"Comment on the picture....\"></textarea>" +
            "   <button class=\"btnComment\">Add comment</button>" +
            "   <div class=\"comment-list-container\">";
        for (let i = 0; i < comments.length; i++) {
            imageItemString += createCommentItem(comments[i])
        }
        imageItemString += "</div></div></div>"

        return imageItemString;

    }


    function addComment(e) {

        let targetImageContainer = e.target.parentElement.parentElement;
        let imageItemId = targetImageContainer.getElementsByClassName("image-item")[0].id;
        let commentList = targetImageContainer.getElementsByClassName("comment-list-container")[0];
        let newComment = createCommentItem(getCommentObject(targetImageContainer));
        commentList.innerHTML += newComment
        clearCommentArea(targetImageContainer)

    }

    function clearCommentArea(container) {
        let textArea =container.getElementsByTagName("textarea")[0]
        let authorInput = container.getElementsByTagName("input")[0]
        textArea.value = "";
        authorInput.value= "";
    }

    function getCommentObject(container) {

        let authorInput = container.getElementsByTagName("input")[0]
        let commentAuthor = authorInput.value;
        if(commentAuthor == "") {
            commentAuthor = "Anonymous"
        }
        let textArea =container.getElementsByTagName("textarea")[0]
        let comment = textArea.value;
        return commentObject = {author: commentAuthor, comment: comment}
    }


    function createCommentItem(comment) {
        let author = comment.author;
        let commentContent = comment.comment;
        return "<div class=\"comment-container\"><h3 class=\"comment-author-name\">" + author + "</h3><div class=\"comment\">" + commentContent + "</div></div>"

    }


});