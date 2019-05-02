<?php

class PostRenderer
{

    public function renderPosts($images)
    {
        $posts = '';
        if ($images) {
            foreach ($images as $image) {
                $posts .= $this->renderPost($image);
            }
        }
        return $posts;
    }

    private function renderPost($image)
    {
        $imagePath = $image->getFileName();
        $imageHeader = $image->getHeader();
        $imageText = $image->getText();
        $imageID = $image->getId();


        $post = "
                  <div class='image-post'>
                  <div class='image-information-wrapper'>
                        <h2 class='image-header'>$imageHeader</h2>
                        <div class='image-wrapper'>
                            <img src=$imagePath class='img-feed-post'/>
                        </div>
                        <div class='image-text'>$imageText</div>
                        </div>
                        <div class='comments'>
                        <div class='textarea-wrapper'> 
                        <div class='comment-form-wrapper'>
                        <form class='comment-form' method='post' action='comment'>
                            <input type='hidden' name='imageID' value=$imageID />
                            <textarea  name='comment' class='comment-textarea' placeholder='Leave a comment.. And be nice!' wrap='hard' rows='5' cols='100'></textarea>
                            <div><input class='btn-submit-comment' type='submit' value='Comment'/></div>
                        </form>
                        </div>
                        </div>";

        $comments = $image->getComments();
        $post .= $this->renderComments($comments);
        $post .= '</div>';

        return $post;

    }

    private function renderComments($comments)
    {

        $renderedComments = "";

        if ($comments) {
            foreach ($comments as $comment) {
                $renderedComments .= $this->renderComment($comment);
            }
        }

        $renderedComments .= "</div>";
        return $renderedComments;

    }

    private function renderComment($comment)
    {
        $commentText = $comment->getComment();
        $commentAuthor = $comment->getAuthorUsername();
        $commentAuthorID = $comment->getAuthorID();

        $userLink = '/Mach316/mvc/public/home/userpage/'.$commentAuthor;

        return "<div class='comment'>
                           <div class='comment-author-name'><a href=$userLink >$commentAuthor</a></div>
                           <div class='comment-text'>$commentText</div>
                </div>";

    }


}
