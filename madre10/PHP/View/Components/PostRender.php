<?php
require_once(__DIR__ . '/../../Model/entities/post.php');
require_once(__DIR__ . '/../../Model/entities/comment.php');


function renderFuckingPostWithComments($post, $comments)
{
    $htmlComments = createComments($comments);

    $html =
        "<div class='feed__item'>"
        . "<h2>$post->title</h2>"
        . "<image class='feed__image' src='/uploaded_images/$post->file_name'></image>"
        . "<div class='feed__caption'><p>$post->description</p></div>"
        . "<div class='feed_comments'>"
        . $htmlComments
        . "</div>"
        . "<div class='feed__comment_input'>"
        . "<textarea class='feed__comment_input_textarea' rows='4' cols='50' placeholder='Comments...'></textarea>"
        . "<br/>"
        . "<button class='feed__comment_submit_button'>Submit</button>"
        . "</div>"
        . "</div>";

    return $html;
}

function renderFuckingPost($post)
{
    $html =
        "<div class='feed__item'>"
        . "<h2>$post->title</h2>"
        . "<image class='feed__image' src='/uploaded_images/$post->file_name'></image>"
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
            . "<div class='feed__comment_author'>AUTHOR GOES HERE</div>"
            . "<div class='feed__comment_content'>$comment->content</div>"
            . "</div>";
    }
    return $html;

}