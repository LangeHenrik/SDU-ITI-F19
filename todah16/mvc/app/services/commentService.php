<?php

class CommentService{
    
    public function comment($id, $NewCommentModel){
        
        $user_name =$_SESSION['user_name'];
        $comment = $_POST['comment'];
        
        $newComment = new NewComment($user_name, $comment, $id);
        
        return $newComment;
    }
    
}