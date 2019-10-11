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

if(empty($_GET['id']))
{
	header("Location: index.php");
} else 
{
	$photo = Photo::find_by_id($_GET['id']);
	if(isset($_POST['update']))
	{
	if($photo)
	{
		$photo->title = $_POST['title'];
		$photo->caption = $_POST['caption'];
		$photo->alternate_text= $_POST['alternate_text'];
		$photo->description = $_POST['description'];

		$photo->save();
	}

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
    	<form method="post">
    		<div class="form-group">
    			<label>Title</label>
    			<input class="form-control" type="text" value="<?php echo $photo->title ;?>" name="title" >
    		</div>
    		<div class="form-group">
    			<img  class="img-responsive img-thumbnail" src="<?php  echo $photo->photo_path(); ?>">
    		</div>
    		<div class="form-group">
    			<label>Caption</label>
    			<input class="form-control" type="text" value="<?php echo $photo->caption ;?>" name="caption" >
    		</div>
    		<div class="form-group">
    			<label>Alternate Text</label>
    			<input class="form-control" type="text" value="<?php echo $photo->alternate_text ;?>" name="alternate_text" >
    		</div>
    		<div class="form-group">
    			<label>Description</label>
    			<textarea class="form-control"  name="description"><?php echo $photo->description ;?></textarea>
    		</div>
    	
    </div>

<div class="col-md-4" >
    <div  class="photo-info-box">
        <div class="info-box-header">
           <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
        </div>
    <div class="inside">
      <div class="box-inner">
         <p class="text">
           <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
          </p>
          <p class="text ">
            Photo Id: <span class="data photo_id_box">34</span>
          </p>
          <p class="text">
            Filename: <span class="data">image.jpg</span>
          </p>
         <p class="text">
          File Type: <span class="data">JPG</span>
         </p>
         <p class="text">
           File Size: <span class="data">3245345</span>
         </p>
      </div>
       
      <div class="info-box-footer clearfix">
        <div class="info-box-delete pull-left">
            <a  href="delete_user.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
        </div>
       
        <div class="info-box-update pull-right ">
            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
        </div>   
      </div>
      </form>

    </div>          
</div>
</div>

 
 </div>

<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>