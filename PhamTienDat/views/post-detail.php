<?php require_once('views/header.php'); ?>
<?php require_once('views/mod-slideshow.php'); ?>
<?php
$post = loadModel('post');
$slug = $_REQUEST['id'];
$topic = loadModel('topic');
$row_cat = $post->post_row(['slug' => $slug, 'status' => 1]);
$title = $row_cat['title'];
$catid = $row_cat['id'];
$arr_listcatid = array();
$arr_listcatid[] = $catid;
$list_cat1 = $topic->topic_list(['parentid' => $catid, 'status' => 1]);
foreach ($list_cat1 as $row_cat1) {
    $arr_listcatid[] = $row_cat1['id'];
    $list_cat2 = $topic->topic_list(['parentid' => $row_cat1['id'], 'status' => 1]);
    foreach ($list_cat2 as $row_cat2) {
        $arr_listcatid[] = $row_cat2['id'];
    }
}

$args = array(
    'status' => 1,
    'topid_in' => $arr_listcatid,
    'sort' => ['orderby' => 'created_at', 'order' => 'DESC'],


);

$list = $post->post_list($args);


?>
<section>
    <div class="container">
        <div class="row my-4">


            <div class="col-md">
                <div>
                    <h4> <?php echo $title; ?></h4>
                    <div class="tab-container">


                        <?php echo $row_cat['detail']; ?>
                    </div>
                </div>

            </div>
        </div>
</section>
<?php require_once('views/footer.php'); ?>