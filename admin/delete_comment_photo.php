<?php require_once("includes/init.php"); ?>
 
<?php if(!$session->is_signed_in()) {  header("Location: login.php"); } ?>
<!-- Navigation -->
 <?php 

 if(empty($_GET['id']))
 {
 	header("Location: comment.php");
 }
 $comment = Comment::find_by_id($_GET['id']);
 if($comment)
 {
 	$comment->delete();
 	$session->message("The Comment With {$comment->id} has been deleted");
 	header("Location: comment_photo.php?id={$comment->photo_id}");
 }else {
 	header("Location: comment.php");
 }

 ?>