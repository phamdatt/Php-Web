<?php
$topic = loadModel('topic');
$list = $topic->topic_list(['status' => 'trash']);
?>
<?php require_once('views/header.php'); ?>
<div class="content-wrapper my-2">
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <strong class="text-danger">Danh Sách Chủ Đề</strong>
        </h3>

        <div class="card-tools">

          <a class="btn btn-sm btn-danger" href="index.php?option=topic"><i class="fas fa-times"></i>Thoát</a>

        </div>
      </div>
      <div class="card-body">
        <?php require_once("views/message.php"); ?>

        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th scope="col">Tên chủ đề</th>
              <th class="text-center" style="width:130px;">Chức năng</th>
              <th class="text-center" style="width:20px;">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td class="text-center">

                  <a class="btn btn-sm btn-info" href="index.php?option=topic&cat=retrash&id=<?php echo $row['id']; ?>"><i class="fas fa-undo-alt"></i></a>
                  <a class="btn btn-sm btn-danger" href="index.php?option=topic&cat=delete&id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
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