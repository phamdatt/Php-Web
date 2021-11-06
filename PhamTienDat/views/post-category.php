<?php
$category = loadModel('topic');
$product = loadModel('post');
$pt = loadClass('Phantrang');
$slug = $_REQUEST['cat'];
$row_cat = $category->topic_row(['slug' => $slug, 'status' => 1]);
$catid = $row_cat['id'];
$arr_listcatid = array();
$arr_listcatid[] = $catid;
$list_cat1 = $category->topic_list(['parentid' => $catid, 'status' => 1]);
foreach ($list_cat1 as $row_cat1) {
  $arr_listcatid[] = $row_cat1['id'];
  $list_cat2 = $category->topic_list(['parentid' => $row_cat1['id'], 'status' => 1]);
  foreach ($list_cat2 as $row_cat2) {
    $arr_listcatid[] = $row_cat2['id'];
  }
}
//xulyphantrang
$limit = 6;
$pageCurrent = $pt->pageCurrent();
$offset = $pt->pageOffset($pageCurrent, $limit);

//
$args = array(
  'status' => 1,
  'topid_in' => $arr_listcatid,
  'sort' => ['orderby' => 'created_at', 'order' => 'DESC'],
  'offset' => $offset,
  'limit' => $limit

);
///
$total = $product->post_count($args);



$list = $product->post_list($args);
$title = $row_cat['name'];
?>
<?php require_once('views/header.php'); ?>
<section class=" clearfix mainmenu bg-danger">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 my-4">
        <h2>Tất Cả Sản Phẩm</h2>
      </div>
      <div class="col-sm-7">
        <nav class="navbar navbar-expand-lg navbar-light bg-danger my-3">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php require_once('views/mod-mainmenu.php'); ?>

          </div>
        </nav>
      </div>
    </div>
</section>
<?php require_once('views/mod-slideshow.php'); ?>
<section class="clearfix content">
  <div class="container">
    <div class="row">

      <div class="col-md">
        <div class="row">
          <?php foreach ($list as $row) : ?>
            <div class="col-md-4">
              <div class="post">
                <a href="index.php?option=post&id=<?php echo $row['slug']; ?>">
                  <img src="public/images/<?php echo $row['img']; ?>" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                  <p><?php echo $row['updated_at']; ?></p>

                  <p class="card-text"><a href="index.php?option=post&id=<?php echo $row['slug']; ?>" class="pro-name"><?php echo $row['title']; ?></a></p>
                  <h3 class="card-text"><?php echo $row['metakey']; ?></h3>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php echo  $pageLink = $pt->pageLink($total, $pageCurrent, $limit, 'index.php?option=post&cat=' . $slug); ?>

      </div>

    </div>


  </div>
  </div>
</section>
<?php require_once("views/footer.php"); ?>