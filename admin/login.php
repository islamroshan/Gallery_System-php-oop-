  <?php require_once("includes/header.php"); ?>  
 
<?php 

if($session->is_signed_in()){
    header("Location: index.php");
}
if(isset($_POST['submit'])) {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    //Method to check 
    
    $user_found = User::verify_user($username, $password);
    
    if($user_found)
    {
        $session->login($user_found);
       header("Location: index.php");
    } else {
       $the_message = "The Username or Password You Enter  Is incorrect";
    }
} else {
    $the_message = "";
    $username = "";
    $username = "";
}
?>
<div id="page-wrapper">
  <div class="row">
    
  
<div class="col-lg-12">
            <h1 class="page-header">
                Login with your account
                
            </h1>

  </div>
 
<div class="col-md-4 col-md-offset-3">

 
	
<form   action="" method="post">
	<h4 class="bg-danger"><?php echo $the_message; ?></h4>
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username) ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="<?php echo htmlentities($username) ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>

</div>
</div>
 
 