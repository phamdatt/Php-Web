<?php $title = 'Trang Chủ'; ?>
<?php require_once('views/header.php'); ?>
<section class="clearfix mainmenu bg-secondary">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 my-4">
        <h2>Danh Mục Sản Phẩm</h2>
      </div>
      <div class="col-sm-7">
        <nav class="navbar navbar-expand-lg navbar-light my-3">

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
<?php
require_once("views/mod-slideshow.php");
?>
<section class="clearfix content">
  <div class="container">

    <?php
    $category = loadModel('category');
    $product = loadModel('product');
    $list_category = $category->category_list(['parentid' => 0, 'status' => 1]);
    ?>
    <section class="clearfix content ">
      <div class="container">
        <?php foreach ($list_category as $cat) : ?>
          <?php

          $catid = $cat['id'];
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
          $args = array(
            'status' => 1,
            'catid_in' => $arr_listcatid,
            'sort' => ['orderby' => 'created_at', 'order' => 'DESC'],
            'limit' => 8

          );
          $list = $product->product_list($args);

          ?>
          <h1 class="text-center text-uppercase"><?php echo $cat['name']; ?></h1>

          <div class="row " id="content">
            <?php foreach ($list as $row) : ?>
              <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                  <a href="index.php?option=product&id=<?php echo $row['slug']; ?>">
                    <img src="public/images/<?php echo $row['img']; ?>" class="card-img-top" alt="...">
                  </a>
                  <div class="card-body">

                    <p class="card-text"><a href="index.php?option=product&id=<?php echo $row['slug']; ?>" class="pro-name"><?php echo $row['name']; ?></a></p>
                    <h4 class="price"><?php echo number_format($row['price']); ?><sup>đ</sup></h4>
                    <a href="index.php?option=cart&addcart=<?php echo $row['id']; ?>" class="btn btn-secondary">Mua Hàng</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>
  </div>
</section>
<?php require_once("views/footer.php"); ?>