<?php require_once("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>


<?php if(!$session->is_signed_in()) {  header("Location: login.php"); } ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
     
    <!-- Top Menu Items -->



    <?php include("includes/top_nav.php"); ?>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>
<?php
$message = "";

	if(empty($_GET['id'])){
		header("Location: users.php");
	}
	$user = User::find_by_id($_GET['id']);
	if(isset($_POST['update']))
	{
		
		$user->username = $_POST['username'];
		$user->password = $_POST['password'];
		$user->firstname= $_POST['firstname'];
		$user->lastname = $_POST['lastname'];

         if(empty($_FILES['user_image']))
         {
    
             $user->save();
             header("Location: users.php ");
             $session->message('The User Has Been Updated');
         }
         else {
            
            $user->set_files($_FILES['user_image']);
            $user->save_user_and_image();
            $user->save();
            $session->message('The User Has Been Updated');
            // header("Location: edit_user.php?id={$user->id}");
              header("Location: users.php ");

         }

 }


?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

        </div>
            
 
    <!-- /.container-fluid -->
        <form method="post" enctype="multipart/form-data">
            <h1><?php echo $message; ?></h1>
    <div class="col-md-4 user_image_box">
        <div class="form-group">
                <label>User Image</label>
            <a href="#" data-toggle="modal" data-target="#photo-library">
                <img   class="img-thumbnail img-responsive" src= "<?php echo $user->user_pic_path(); ?>">
            </a>
        </div>
    </div>
    <div class="col-md-8" >
    	   <div class="form-group">
                <label>User Image</label>
                <input class="form-control" type="file"   name="user_image" >
            </div>
    		<div class="form-group">
    			<label>User Name</label>
    			<input class="form-control" type="text"  value="<?php echo $user->username ; ?>"  name="username" >
    		</div>
    		<div class="form-group">
    			<label>Password</label>
    			<input class="form-control" type="text"  value="<?php echo $user->password ; ?>" name="password" >
    		</div>
    		 
    		<div class="form-group">
    			<label>First Name</label>
    			<input class="form-control" type="text"  value="<?php echo $user->firstname ; ?>" name="firstname" >
    		</div>
    		<div class="form-group">
    			<label>Last Name</label>
    			<input class="form-control" type="text"  value="<?php echo $user->lastname ; ?>"  name="lastname" >
    		</div>
    		 <a id="user-id" href="delete_user.php?id=<?php echo $user->id;?>"><button  name="delete"  class="btn btn-denger btn-lg ">Delete</button></a>
    		<a><button  name="update" type="submit" class="btn btn-primary btn-lg ">Update</button></a>
    		 
    	 </form>     
    </div>
 
    </div>
 
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>