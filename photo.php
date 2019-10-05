<?php include("includes/header.php"); ?>
<?php 
require_once("admin/includes/init.php");



if(empty($_GET['id']))
{
    header("Location: index.php");
}
$photo = Photo::find_by_id($_GET['id']);
if(isset($_POST['submit']))
{
    $author = trim($_POST['author']); 
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id, $author ,$body);
    if($new_comment && $new_comment->save())
    {
        header("Location: photo.php?id={$photo->id}");
    } else {
        $message = "There was some problem saving";
    }
} else {
    $author = "";
    $body = "";
}
$comments = Comment::find_the_comments($photo->id);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php  echo $photo->title; ?></h1>

                <!-- Author -->
             <!--    <p class="lead">
                    by <a href="#"> </a>
                </p> -->

                <hr>

                <!-- Date/Time -->
               <!--  <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p> -->

                

                <!-- Preview Image -->
                <img class="img-responsive" width="100%" src=" admin/<?php echo $photo->photo_path(); ?>" alt="">


                <!-- Post Content -->
                <p class="lead"><?php  echo $photo->caption; ?></p>
                <p><?php  echo $photo->description; ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" name="author">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                  <?php foreach($comments as $comment): ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                        </h4>
                       <?php echo $comment->body; ?>
                    </div>
                </div>
            <?php endforeach; ?> 

            </div>
<!--  <div class="col-md-4"> -->

            
                 <?php //include("includes/sidebar.php"); ?>



        </div>
<!--         </div> -->
      </div>

            <!-- Blog Sidebar Widgets Column -->
           
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>