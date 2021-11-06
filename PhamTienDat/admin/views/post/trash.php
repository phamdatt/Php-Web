<?php
$post = loadModel('post');
$topic = loadModel('topic');
$list = $post->post_list(['status' => 'trash', 'type' => 'post']);

?>
<?php require_once('views/header.php'); ?>
<div class="content-wrapper my-2">
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <strong class="text-danger"> Thùng Rác Danh Sách Bài Viết</strong>
        </h3>

        <div class="card-tools">

          <a class="btn btn-sm btn-danger" href="index.php?option=post"><i class="fas fa-times"></i> Thoát</a>

        </div>
      </div>
      <div class="card-body">
        <?php require_once("views/message.php"); ?>
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th style="width:100px;">Hình ảnh</th>
              <th scope="col">Tiêu đề bài viết</th>
              <th scope="col">Chủ đề bài viết</th>
              <th class="text-center" style="width:130px;">Chức năng</th>
              <th class="text-center" style="width:20px;">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td>
                  <img class="img-fluid" src="../public/img/post/<?php echo $row['img']; ?>" />

                </td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $topic->topic_name($row['topid']); ?></td>
                <td class="text-center">

                  <a class="btn btn-sm btn-info" href="index.php?option=post&cat=retrash&id=<?php echo $row['id']; ?>"><i class="fas fa-undo-alt"></i></a>
                  <a class="btn btn-sm btn-danger" href="index.php?option=post&cat=delete&id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
                </td>
                <td class="text-center"><?php echo $row['id']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>
<?php require_once('views/footer.php'); ?>