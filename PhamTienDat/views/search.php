<?php
$title = $_REQUEST['keyword'];
$product = loadModel('product');
$keyword = (isset($_REQUEST['keyword'])) ? $_REQUEST['keyword'] : '';
$list_product = $product->product_list(['keyword' => $keyword, 'status' => 1]);
if ($list_product) {
    $orror = "San pham tim kiem";
} else {
    $orror = "khong co";
}

?>

<?php require_once('views/header.php'); ?>
<section class=" clearfix mainmenu bg-secondary">
    <div class=" container">
        <div class="row">
            <div class="col-sm-5 my-4">
                <h4>Danh Mục Sản Phẩm</h4>
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
    <div class="row">
        <div class="col-md-3">
            <?php require_once('views/mod-category.php'); ?>
        </div>
        <div class="col-md-9">
            <h3 class="text-center"><?php echo $title; ?></h3>

            <div class="row">

                <?php foreach ($list_product as $row) : ?>

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
        </div>

</section>