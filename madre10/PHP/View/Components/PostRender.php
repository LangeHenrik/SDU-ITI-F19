<?php
require_once(__DIR__ . '/../../Model/entities/post.php');
require_once(__DIR__ . '/../../Model/entities/comment.php');


function renderFuckingPostWithComments($post, $comments)
{
    $htmlComments = createComments($comments);

    $hidden = (isset($_SESSION['user_id'])) ? "" : "hidden";


    $html =
        "<div class='feed__item'>"
        . "<h3>$post->title</h3>"
        . "<image class='feed__image' src=$post->base64img></image>"
        . "<div class='feed__caption'><p>$post->description</p></div>"
        . "<div class='feed_comments'>"
        . $htmlComments
        . "</div>"
        . "<div class='feed__comment_input'>"
        . "<form action='/feed' method='POST' $hidden>"
        .   "<input type='hidden' name='post_id' value=$post->id >"
        .   "<textarea name='comment' class='feed__comment_input_textarea' rows='4' cols='50' placeholder='Comments...'></textarea>"
        .   "<br/>"
        .   "<button class='feed__comment_submit_button' name='submit' >Submit</button>"
        . "</form>"
        . "</div>"
        . "</div>";

    return $html;
}

function renderFuckingPost($post)
{
    $html =
        "<div class='feed__item'>"
        . "<h3>$post->title</h3>"
        . "<image class='feed__image' src=$post->base64img></image>"
        . "<div class='feed__caption'><p>$post->description</p></div>"
        . "</div>";

    return $html;
}


function createComments($comments)
{
    $html = "";
    foreach ($comments as $comment) {
        $html .=
            "<div class='feed__comment'>"
            . "<div class='feed__comment_author'>$comment->username</div>"
            . "<div class='feed__comment_content'>$comment->content</div>"
            . "</div>";
    }
    return $html;

}