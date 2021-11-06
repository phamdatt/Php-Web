<?php
$topic = loadModel('topic');

$list_topic = $topic->topic_list(['status' => 'index']);
$str_toptid = "";


foreach ($list_topic as $item) {
    $str_toptid .= "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
}

?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=post&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper my-2">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong class="text-uppercase text-danger">Thêm mới bài viết</strong>
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" type="summit" name="THEM">
                            <i class="far fa-save"></i> Lưu[Thêm]</button>
                        <a class="btn btn-danger btn-sm" href="index.php?option=post" role="button">
                            <i class="fas fa-times"></i> Thoát</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="">Tên bài viết</label>
                                <input type="text" class="form-control" name="title" required placeholder="Tên bài viết">
                            </div>
                            <div class="form-group">
                                <label for="">Chi tiết bài viết</label>
                                <textarea class="form-control" name="detail" required rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả</label>
                                <textarea class="form-control" name="metadesc" required rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Từ khóa</label>
                                <textarea class="form-control" name="metakey" required rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Chủ đề bài viết</label>
                                <select class="form-control" name="topid" id="" required>
                                    <option value="">--Chọn chủ đề bài viết--</option>
                                    <?php echo $str_toptid; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Hình đại diện</label>
                                <input type="file" class="form-control" name="img" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select class="form-control" name="status" id="">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
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