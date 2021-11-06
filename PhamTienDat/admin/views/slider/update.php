<?php
$id = $_REQUEST['id'];
$slider = loadModel('slider');
$row = $slider->slider_row(['id' => $id]);
?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=slider&cat=process&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="content-wrapper my-2">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong class="text-uppercase text-danger">Thêm mới slider</strong>
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" href="#" name="CAPNHAT" type="summit" role="button">
                            <i class="far fa-save"></i> Lưu[Cập nhật]</button>
                        <a class="btn btn-danger btn-sm" href="index.php?option=slider" role="button">
                            <i class="fas fa-times"></i> Thoát</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Tên slider</label>
                                <input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name" placeholder="Tên slider">
                            </div>
                            <div class="form-group">
                                <label for="">Liên kết</label>
                                <input type="url" class="form-control" value="<?php echo $row['link']; ?>" name="link" placeholder="Liên kết">
                            </div>
                            <div class="form-group">
                                <label for="">Hình ảnh</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                            <div class="form-group">
                                <label for="">Vị trí</label>
                                <select class="form-control" name="position" id="">
                                    <option>-- Chọn vị trí --</option>
                                    <option value="slideshow">Slideshow</option>

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