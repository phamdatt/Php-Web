<?php
$id = $_REQUEST['id'];
 
  $post = loadModel('post');
  $row = $post->post_row(['id'=>$id,'type'=>'page']);


  
?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=page&cat=process&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
<div class="content-wrapper my-2">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong class="text-uppercase text-danger">Cập nhật bài viết</strong>
                </h3>
                <div class="card-tools">
                    <button class="btn btn-success btn-sm" type="summit" name="CAPNHAT" >
                        <i class="far fa-save"></i> Lưu[Cập nhật]</button>
                    <a class="btn btn-danger btn-sm" href="index.php?option=page" role="button">
                        <i class="fas fa-times"></i> Thoát</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="">Tên bài viết</label>
                            <input type="text" value="<?php echo $row['title']; ?>" class="form-control" name="title" required placeholder="Tên bài viết">
                        </div>
                        <div class="form-group">
                            <label for="">Chi tiết bài viết</label>
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
                            <label for="">Hình đại diện</label>
                            <input type="file" class="form-control" name="img" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select class="form-control" name="status" id="">
                                <option value="1" <?php if($row['status']==1) {echo 'selected';} ?>>Xuất bản</option>
                                <option value="2" <?php if($row['status']==2) {echo 'selected';} ?>>Chưa xuất bản</option>
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