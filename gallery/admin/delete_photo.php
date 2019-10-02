<?php require_once("includes/init.php"); ?>
 
<?php if(!$session->is_signed_in()) {  header("Location: login.php"); } ?>
<!-- Navigation -->
 <?php 

 if(empty($_GET['id']))
 {
 	header("Location: photo.php");
 }
 $photo = Photo::find_by_id($_GET['id']);
 if($photo)
 {
 	$photo->delete_photo();
 	header("Location: photo.php");
 }else {
 	header("Location: photo.php");
 }

 ?>