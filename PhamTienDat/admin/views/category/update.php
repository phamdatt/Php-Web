<?php
$id = $_REQUEST['id'];
$category = loadModel('category');
$row = $category->category_row(['id' => $id]);
$list = $category->category_list(['status' => 'index']);
$str_parentid = "";
$str_orders = "";

foreach ($list as $item) {
    if ($item['id'] == $row['parentid']) {
        $str_parentid .= "<option selected value='" . $item['id'] . "'>" . $item['name'] . "</option>";
    } else {
        $str_parentid .= "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
    }
}

?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=category&cat=process&id=<?php echo $id; ?>" method="post" name="ab">
    <div class="content-wrapper my-2">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong class="text-uppercase text-danger">Cập nhật loại sản phẩm</strong></h3>
                    <div class="card-tools">
                        <button type="submit" name="CAPNHAT" class="btn btn-success btn-sm"><i class="far fa-save"></i> Lưu[Cập nhật]</button>

                        <a class="btn btn-danger btn-sm" href="index.php?option=category" role="button">
                            <i class="fas fa-times"></i> Thoát</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="">Tên loại sản phẩm</label>
                                <input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name" placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <textarea class="form-control" name="metadesc" rows="3"><?php echo $row['metadesc']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Từ khóa</label>
                                <textarea class="form-control" name="metakey" rows="3"><?php echo $row['metakey']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Loại sản phẩm cha</label>
                                <select class="form-control" name="parentid">
                                    <option value="0">-- Cấp cha --</option>
                                    <?php echo $str_parentid; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Sắp xếp</label>
                                <select class="form-control" name="orders" id="">
                                    <option value='0'>-- None --</option>
                                    <?php echo $str_orders; ?>

                                </select>
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