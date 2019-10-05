<?php include("includes/header.php"); ?>
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

<div id="page-wrapper">
    <div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

        </div>
            
    </div>
        <!-- /.row -->
         <?php 
        $users = user::find_all_users();
    ?>
        <div class="col-md-12">
           <a href="add_user.php"> <button class="btn btn-primary" >
                Add User
            </button> </a>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Photo</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user) : ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><img class="img-rounded" width="100" height="50" src="<?php  echo $user->image_path_and_placeholder(); ?>" alt="Image"> </td>
                        <td><?php echo $user->username; ?>
                            <div class="action-link">
                                <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                <a href="">View</a>
                            </div>
                        </td>
                        <td><?php echo $user->firstname; ?></td>
                        <td><?php echo $user->lastname; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>