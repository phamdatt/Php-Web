<?php
$contact = loadModel('contact');
$list = $contact->contact_list(['status' => 'index']);
?>
<?php require_once('views/header.php'); ?>
<div class="content-wrapper my-2">
  <!-- Main content -->
  <section class="content">
    <?php require_once("views/message.php"); ?>

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <strong class="text-danger">Tất Cả Liên Hệ</strong>
        </h3>
        <div class="card-tools">
          <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=trash"><i class="fas fa-trash"></i> Thùng rác</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th style="width:130px;">Tiêu đề liên hệ</th>
              <th scope="col">Email</th>
              <th scope="col">Điện thoại</th>
              <th class="text-center">Trạng thái</th>
              <th class="text-center">Chức năng</th>
              <th class="text-center">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>

                <td class="text-center">
                  <?php if ($row['status'] == 1) : ?>
                    <span class="badge badge-danger">Đã trả lời</span>
                  <?php else : ?>
                    <span class="badge badge-danger">Chưa trả lời</span>
                  <?php endif; ?>

                </td>
                <td class="text-center">
                  <?php if ($row['status'] == 1) : ?>
                    <a class="btn btn-sm btn-success" href="index.php?option=contact&cat=status&id=<?php echo $row['id']; ?>"><i class="fas fa-toggle-on"></i></a>
                  <?php else : ?>
                    <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=status&id=<?php echo $row['id']; ?>"><i class="fas fa-toggle-off"></i></a>
                  <?php endif; ?>
                  <a class="btn btn-sm btn-info" href="index.php?option=contact&cat=update&id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="index.php?option=contact&cat=deltrash&id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
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