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

    public function renderPost($image)
    {
        $imagePath = '/Mach316/mvc/app/uploads/' . $image->getFileName();


        $post = "<div class='image-post'>
                  
                   <div class='image-wrapper'>
                        <img src={$imagePath} class='img-feed-post'/>
                   </div>
                   <div class='textarea-wrapper'> 
                        <textarea  class='comment-textarea' wrap='hard' rows='10' cols='70'></textarea>
                   </div>";

        $comments = $image->getComments();
        $post .= $this->renderComments($comments);
        $post .= '</div>';

        return $post;

    }

    public function renderComments($comments)
    {

        $renderedComments = "<div class='comments'>";

        if ($comments) {
            foreach ($comments as $comment) {
                $renderedComments .= $this->renderComment($comment);
            }
        }

        $renderedComments .= "</div>";
        return $renderedComments;

    }

    public function renderComment($comment)
    {
        $commentText = $comment->getComment();
        $commentAuthor = $comment->getAuthorUsername();
        $commentAuthorID = $comment->getAuthorID();

        $userLink = '/Mach316/mvc/public/api/getuser/'.$commentAuthorID;

        return "<div class='comment'>
                           <div class='comment-author-name'><a href=$userLink >$commentAuthor</a></div>
                           <div class='comment-text'>$commentText</div>
                </div>";

    }


}
