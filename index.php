<?php require_once("admin/includes/header.php"); ?>

<?php $photos = Photo::find_all_users(); ?>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnail  row">
                <?php foreach($photos as $photo): ?>
                
                    <div class="col-xs-6 col-md-3">
                        <a class="" href="photo.php?id=<?php echo $photo->id; ?>" >
                           <img class="home-page-photo thumbnail img-responsive" src="admin/<?php  echo $photo->photo_path() ?>" alt="">
                        </a>
                    </div>
              
            <?php endforeach; ?>
              </div>
            </div>



 

        <?php include("includes/footer.php"); ?>
