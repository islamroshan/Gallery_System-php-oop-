<?php require_once("includes/header.php"); ?>
 
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

 $user = new User;
		
  $message = "";
	if(isset($_POST['add']))
	{
if($user){
		
		$user->username = $_POST['username'];
		$user->password = $_POST['password'];
		$user->firstname= $_POST['firstname'];
		$user->lastname = $_POST['lastname'];

		$user->set_files($_FILES['user_image']);
        $session->message('The user was added successfully');
		$user->upload_image();
        
         $user->save();
          header("Location:users.php");
        	
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

    <div class="col-md-8" >
    	
    	<form method="post" enctype="multipart/form-data">
    		<h1><?php echo $message; ?></h1>
    		<div class="form-group">
    			<label>User Image</label>
    			<input class="form-control" type="file"   name="user_image" >
    		</div>
    		<div class="form-group">
    			<label>User Name</label>
    			<input class="form-control" type="text"   name="username" >
    		</div>
    		<div class="form-group">
    			<label>Password</label>
    			<input class="form-control" type="password"  name="password" >
    		</div>
    		 
    		<div class="form-group">
    			<label>First Name</label>
    			<input class="form-control" type="text" name="firstname" >
    		</div>
    		<div class="form-group">
    			<label>Last Name</label>
    			<input class="form-control" type="text"   name="lastname" >
    		</div>
    		 
    		<a><button  name="add" type="submit" class="btn btn-primary btn-lg ">Add User</button></a>
    		 
    	 </form>     
    </div>
 </div>
 
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>