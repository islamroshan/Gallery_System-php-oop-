<?php require_once("includes/init.php"); ?>
 
<?php if(!$session->is_signed_in()) {  header("Location: login.php"); } ?>
<!-- Navigation -->
 <?php 

 if(empty($_GET['id']))
 {
 	header("Location: users.php");
 }
 $user = User::find_by_id($_GET['id']);
 if($user)
 {
 	$session->message('The User Has Been Deleted');
 	$user->delete_user();
 	header("Location: users.php");
 }else {
 	$session->message('The User Has Been Deleted');
 	header("Location: users.php");
 }

 ?>