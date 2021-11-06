<?php
$id = $_REQUEST['id'];
$category = loadModel('category');
$product = loadModel('product');
$row = $product->product_row(['id' => $id]);

$list_category = $category->category_list(['status' => 'index']);
$str_catid = "";


foreach ($list_category as $item) {
    if ($row['catid'] == $item['id']) {
        $str_catid .= "<option selected value='" . $item['id'] . "'>" . $item['name'] . "</option>";
    } else {
        $str_catid .= "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
    }
}

?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=product&cat=process&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

    <div class="content-wrapper my-2">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong class="text-uppercase text-danger">Cập nhật sản phẩm</strong>
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" href="#" name="CAPNHAT" type="summit" role="button">
                            <i class="far fa-save"></i> Lưu[Cập nhật]</button>
                        <a class="btn btn-danger btn-sm" href="index.php?option=product" role="button">
                            <i class="fas fa-times"></i> Thoát</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" value="<?php echo $row['name']; ?>" class="form-control" name="name" required placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Chi tiết sản phẩm</label>
                            <textarea class="form-control" name="detail" required rows="3"><?php echo $row['detail']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="metadesc" required rows="3"><?php echo $row['metadesc']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Từ khóa</label>
                            <textarea class="form-control" name="metakey" required rows="3"><?php echo $row['metakey']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Loại sản phẩm</label>
                            <select class="form-control" name="catid" required id="">
                                <option>-- Chọn loại sản phẩm --</option>
                                <?php echo $str_catid; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng</label>
                            <input type="number" value="<?php echo $row['number']; ?>" class="form-control" required name="number">
                        </div>
                        <div class="form-group">
                            <label for="">Giá bán</label>
                            <input type="number" value="<?php echo $row['price']; ?>" class="form-control" required name="price">
                        </div>
                        <div class="form-group">
                            <label for="">Giá khuyến mãi</label>
                            <input type="number" value="<?php echo $row['pricesale']; ?>" class="form-control" required name="pricesale">
                        </div>
                        <div class="form-group">
                            <label for="">Hình đại diện</label>
                            <input type="file" class="form-control" name="img" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select class="form-control" name="status" id="">
                                <option value="1" <?php if ($row['status'] == 1) {
                                                        echo 'selected';
                                                    } ?>>Xuất bản</option>
                                <option value="2" <?php if ($row['status'] == 2) {
                                                        echo 'selected';
                                                    } ?>>Chưa xuất bản</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
</form>

<?php require_once('views/footer.php'); ?>