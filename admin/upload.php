<?php include("includes/header.php"); ?>
<!-- Navigation -->
<?php if(!$session->is_signed_in()) {  header("Location: login.php"); } ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
 
    <!-- Top Menu Items -->

    <?php 
    $message = "";
    
    if(isset($_POST['submit']))
    {
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->set_files($_FILES['file_upload']);
        
        if($photo->save()) 
        {
            $message = "Photo uploaded Sucessfully";
        } else {
            $message = join("<br>", $photo->errors);
        }
 
    }
    
    ?>


    <?php include("includes/top_nav.php"); ?>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

        </div>
            
    </div>
        <!-- /.row -->
        <div class="col-md-6">
            <h1><?php echo $message; ?></h1>
        <form action="upload.php"  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title">
            </div> 
            <div class="form-group">
                <input type="file" class="form-control" name="file_upload">
            </div>
            <input type="submit" name="submit">
        </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>