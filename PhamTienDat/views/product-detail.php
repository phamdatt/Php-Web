<?php $product = loadModel('product');
$category = loadModel('category');
$slug = $_REQUEST['id'];
$row = $product->product_row(['slug' => $slug, 'status' => 1]);
$catid = $row['catid'];
$title = $row['name'];
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
  'not_id' => $row['id'],
  'sort' => ['orderby' => 'created_at', 'order' => 'DESC'],
  'limit' => 30

);
$list_other = $product->product_list($args);

?>
<?php require_once('views/header.php'); ?>
<section class=" clearfix mainmenu bg-danger">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 my-4">
        <h2>Tất Cả Danh Mục</h2>
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

<section class="clearfix content my-3">
  <div class="container">
    <div class="row product-title">
      <div class="col-md">
        <h3><a href="#"><?php echo $row['name']; ?></a></h3>
      </div>
    </div>
    <div class="row product-detail">

      <div class="col-md-5">


        <img src="public/images/<?php echo $row['img']; ?>" class="card-img-top" alt="...">

      </div>
      <div class="col-md-7">


        <div class="product-img" itemprop="description">TÍNH NĂNG NỔI BẬT
          <p>
            <strong><?php echo $row['name']; ?></strong>
          </p>
          <p><?php echo $row['metadesc']; ?></p><br>
          <div class="product_price">

            <p>Giá Bán: <?php echo number_format($row['price']); ?><br></p>
            <p>Giá Khuyến Mãi: <?php echo $row['pricesale']; ?><br></p>
            <p>Thương Hiệu: <?php echo $row['metakey']; ?></p>
            <form action="index.php?option=cart&addcart=<?php echo $row['id']; ?>" method="post">
              <input type="number" value="1" name="qty" min="1" max="10" />
              <button type="submit" name="DATMUA">Mua Hàng</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="product-information my-2">
      <div class="col-md-12">
        <div class="head-title">Chi Tiết Sản Phẩm</div>
        <div class="tab-container">
          <div class="text-center" id="pt1"><?php echo $row['name']; ?></div>
          <div class="img-detail">
            <div style="padding-left:350px;">

              <img src="public/images/<?php echo $row['img']; ?>" class="card-img-top" alt="...">
            </div>
          </div class="text-detail">
          <?php echo $row['detail']; ?>

        </div>
      </div>
    </div>
    <div class="product-enjoy my-2">
      <div class="head-title">Sản Phẩm Tương Tự</div>
      <div class="tab-container">
        <div class="row">
          <?php foreach ($list_other as $item) : ?>

            <div class="col-md-4">
              <div class="card" style="width: 21rem;">
                <a href="index.php?option=product&id=<?php echo $item['slug']; ?>">
                  <img src="public/images/<?php echo $item['img']; ?>" class="card-img-top" alt="...">
                </a>
                <div class="card-body">

                  <h3 class="card-text"><?php echo $item['name']; ?></h3>
                  <h3 class="card-text"><?php echo number_format($item['price']); ?><sup>đ</sup></h3>
                  <a href="index.php?option=cart&addcart=<?php echo $item['id']; ?>" class="btn btn-secondary">Mua Hàng</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once('views/footer.php'); ?>