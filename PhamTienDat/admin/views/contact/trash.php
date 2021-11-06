<?php
$contact = loadModel('contact');
$list = $contact->contact_list(['status' => 'trash']);
?>
<?php require_once('views/header.php'); ?>
<div class="content-wrapper my-2">
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <strong class="text-danger">Thùng Rác Liên Hệ</strong>
        </h3>

        <div class="card-tools">
          <a class="btn btn-sm btn-success" href="index.php?option=contact"><i class="fas fa-times"></i> Thoát</a>


        </div>
      </div>
      <div class="card-body">
        <?php require_once("views/message.php"); ?>
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th style="width:130px;">Tiêu đề liên hệ</th>
              <th scope="col">Email</th>
              <th scope="col">Điện thoại</th>
              <th class="text-center" style="width:130px;">Trạng thái</th>
              <th class="text-center" style="width:130px;">Chức năng</th>
              <th class="text-center" style="width:20px;">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td class="text-center">
                  <span class="badge badge-danger">Chưa trả lời</span>
                </td>

                <td class="text-center">

                  <a class="btn btn-sm btn-info" href="index.php?option=contact&cat=retrash&id=<?php echo $row['id']; ?>"><i class="fas fa-undo-alt"></i></a>
                  <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=delete&id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
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