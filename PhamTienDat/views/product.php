<?php

$product = loadModel('product');
$pt = loadClass('Phantrang');

//xulyphantrang
$limit = 6;
$pageCurrent = $pt->pageCurrent();
$offset = $pt->pageOffset($pageCurrent, $limit);

//
$args = array(
  'status' => 1,

  'sort' => ['orderby' => 'created_at', 'order' => 'DESC'],
  'offset' => $offset,
  'limit' => $limit

);
///
$total = $product->product_count($args);



$list = $product->product_list($args);
$title = 'Tất Cả Sản Phẩm';
?>
<?php require_once('views/header.php'); ?>
<section class=" clearfix mainmenu bg-secondary>
			<div class=" container">
  <div class="row">
    <div class="col-sm-5 my-4">
      <h2>Tất Cả Sản Phẩm</h2>
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
      <div class="col-md-4" id="m1">
        <?php require_once('views/mod-category.php'); ?>

      </div>
      <div class="col-md-8">
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
                  <h4 class="price"><?php echo number_format($row['price']); ?><sup>đ</sup></h4>
                  <a href="index.php?option=cart&addcart=<?php echo $row['id']; ?>" class="btn btn-secondary">Mua Hàng</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <?php echo  $pageLink = $pt->pageLink($total, $pageCurrent, $limit, 'index.php?option=product');
          ?>
        </div>
      </div>
    </div>


  </div>
  </div>
</section>
<?php require_once("views/footer.php"); ?>