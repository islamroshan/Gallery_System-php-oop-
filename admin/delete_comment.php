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
 	header("Location: comment.php");
 }else {
 	header("Location: comment.php");
 }

 ?>