<?php
$menu = loadModel('menu');
$list = $menu->menu_list(['status' => 'trash']);
?>
<?php require_once('views/header.php'); ?>
<div class="content-wrapper my-2">
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <strong class="text-danger">Danh sách thùng rác sản phẩm</strong>
        </h3>

        <div class="card-tools">
          <a class="btn btn-sm btn-danger" href="index.php?option=menu"><i class="fas fa-times"></i> Thoát</a>

        </div>
      </div>
      <div class="card-body">
        <?php require_once("views/message.php"); ?>
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th scope="col">Tên menu</th>
              <th class="text-center" style="width:130px;">Chức năng</th>
              <th class="text-center" style="width:20px;">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td><a href=""><?php echo $row['name']; ?></a></td>

                <td class="text-center">

                  <a class="btn btn-sm btn-info" href="index.php?option=menu&cat=retrash&id=<?php echo $row['id']; ?>"><i class="fas fa-undo-alt"></i></a>
                  <a class="btn btn-sm btn-danger" href="index.php?option=menu&cat=delete&id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
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