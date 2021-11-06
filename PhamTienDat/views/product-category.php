<?php
$category = loadModel('category');
$product = loadModel('product');
$pt = loadClass('Phantrang');
$slug = $_REQUEST['cat'];
$row_cat = $category->category_row(['slug' => $slug, 'status' => 1]);
$catid = $row_cat['id'];
$arr_listcatid = array();
$arr_listcatid[] = $catid;
$list_cat1 = $category->category_list(['parentid' => $catid, 'status' => 1]);
foreach ($list_cat1 as $row_cat1) {
  $arr_listcatid[] = $row_cat1['id'];
  $list_cat2 = $category->category_list(['parentid' => $row_cat1['id'], 'status' => 1]);
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
  'catid_in' => $arr_listcatid,
  'sort' => ['orderby' => 'created_at', 'order' => 'DESC'],
  'offset' => $offset,
  'limit' => $limit

);
///
$total = $product->product_count($args);



$list = $product->product_list($args);
$title = $row_cat['name'];
?>
<?php require_once('views/header.php'); ?>
<section class=" clearfix mainmenu bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 my-4">
        <h2>Danh Mục Sản Phẩm</h2>
      </div>
      <div class="col-sm-7">
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary my-3">

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
<section class="clearfix content">
  <div class="container">
    <div class="row">
      <div class="col-md-3" id="m1">
        <?php require_once('views/mod-category.php'); ?>

      </div>
      <div class="col-md-9">
        <h2 class="text-center text-uppercase"><?php echo $title; ?></h2>
        <div class="row">
          <?php foreach ($list as $row) : ?>
            <div class="col-md-4">
              <div class="card" style="width: 18rem;">
                <a href="index.php?option=product&id=<?php echo $row['slug']; ?>">
                  <img src="public/images/<?php echo $row['img']; ?>" class="card-img-top" alt="...">
                </a>
                <div class="card-body">

                  <h3 class="card-text"><?php echo $row['name']; ?></h3>
                  <h3 class="card-text"><?php echo number_format($row['price']); ?><sup>đ</sup></h3>
                  <a href="index.php?option=cart&addcart=<?php echo $row['id']; ?>" class="btn btn-secondary">Mua Hàng</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php echo  $pageLink = $pt->pageLink($total, $pageCurrent, $limit, 'index.php?option=product&cat=' . $slug); ?>

      </div>
    </div>


  </div>
  </div>
</section>
<?php require_once("views/footer.php"); ?>