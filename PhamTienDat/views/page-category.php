<?php
$post = loadModel('post');
$slug = $_REQUEST['cat'];
$title = "Gioi Thieu";
$post_list = $post->post_row(['status' => 1, 'type' => 'page', 'slug' => $slug]);
?>
<?php require_once('views/header.php'); ?>
<section class="clearfix content">
    <div class="container">
        <div class="row">

            <div class="col-md tab-container">
                <h5><?php echo $post_list['title']; ?></h5>

                <?php echo $post_list['detail']; ?>



            </div>


        </div>
    </div>
</section>
<?php require_once('views/footer.php'); ?>