
function fetchFeed() {
    fetch('https://api.myjson.com/bins/177o26')
        .then(response => response.json())
        .then(data => createFeedHtml(data))
        .catch(error => console.log("Failed fetch: ", error))
}

function createFeedHtml(data) {
    let html = '<h1> Feed </h1>';
    data.forEach((entry) => {
        html += createFeedItem(entry);
    });

    addFeedHtmlToDom(html);
    addButtonEventListeners();
}

function createFeedItem(item) {
    let html =
        '<div class="feed__item">' +
        '<h2>'+ item.header +'</h2>' +
        '<image class="feed__image" src="'+ item.url +'"></image>' +
        '<div class="feed__caption"><p>'+ item.text +'</p></div>'+
        '<div class="feed_comments">'+createFeedItemComments(item.comments)+ '</div>' +
        createCommentInputSection() +
        '</div>';

    return html;
}

function createFeedItemComments(comments){
    let html = "";
    comments.forEach(comment => {
        html +=
            '<div class="feed__comment">' +
            '<div class="feed__comment_author">'+ comment.author +'</div>' +
            '<div class="feed__comment_content">'+ comment.comment +'</div>' +
            '</div>'
    });
    return html;
}

function createCommentInputSection() {
    let html =
        '<div class="feed__comment_input">' +
        '<textarea class="feed__comment_input_textarea" rows="4" cols="50" placeholder="Comments..."></textarea>' +
        '<br/>' +
        '<button class="feed__comment_submit_button">Submit</button>' +
        '</div>';

    return html;
}

function addButtonEventListeners() {
    let submitButtons = document.getElementsByClassName("feed__comment_submit_button");
    for(let button of submitButtons) {
        button.addEventListener("click",handleCommentSubmit)
    }
}

function handleCommentSubmit(event) {
    //TODO: Get author name from user if logged in...
    let author = "Donald Trump";
    let text = event.target.parentNode.childNodes[0].value;
    let comment = {
        author: author,
        comment: text
    };
    event.target.parentNode.parentNode.childNodes[3].innerHTML += createFeedItemComments([comment]);
    event.target.parentNode.childNodes[0].value = "";
}


function addFeedHtmlToDom(html) {
    document.getElementById('feed_container').innerHTML = html;
}


fetchFeed();

