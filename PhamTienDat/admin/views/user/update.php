<?php
$id = $_REQUEST['id'];
$user = loadModel('user');
$row = $user->user_row(['id' => $id]);

if (isset($_POST['CAPNHAT'])) {
    $error = '';
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Định dạng email không hợp lệ';
    }
    if ($_POST['email'] != $_POST['email_con'] && $error == '') {
        $error = 'E-Mail không khớp!';
    }

    if ($_POST['password'] != $_POST['password_con'] && $error == '') {
        $error = 'Mật khẩu không khớp!';
    }
    $userRow = $user->user_row(['username' => $_POST['username']]);
    if ($userRow != null && $error == '') {
        $error = 'Tên đăng nhập đã tồn tại!';
    }
    $userRow = $user->user_row(['username' => $_POST['email']]);
    if ($userRow != null && $error == '') {
        $error = 'Email đã tồn tại!';
    }
    $userRow = $user->user_row(['password' => sha1($_POST['password_cu']), 'id' => $id]);
    if ($userRow == null && $error == '') {
        $error = 'Mật khẩu cũ không đúng!';
    }

    if ($error == '') {
        $slug = str_slug($_POST['fullname']);
        $data = array(
            'fullname' => $_POST['fullname'],
            'username' => $_POST['username'],
            'gender' => $_POST['gender'],

            'access' => $_POST['access'],
            'password' => sha1($_POST['password']),
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => 1,
            'status' => $_POST['status']
        );
        if (strlen($_FILES["img"]["name"])) {
            $dir_post = '../public/img/user/';
            $target_file = $dir_post . basename($_FILES["img"]["name"]);
            $type_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (in_array($type_file, ['jpg', 'png', 'gif', 'jpeg'])) {
                if (file_exists($dir_post . $row['img'])) {
                    unlink($dir_post . $row['img']);
                }
                $file_name = $slug . '.' . $type_file;
                move_uploaded_file($_FILES['img']['tmp_name'], $dir_post . $file_name);
                $data['img'] = $file_name;
            }
        }

        $user->user_update($data, $id);
        set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
        redirect("index.php?option=user");
    }
    set_flash('message', ['type' => 'success', 'msg' => $error]);
    redirect('index.php?option=user');
}

?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=user&cat=update&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

    <div class="content-wrapper my-2">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong class="text-uppercase text-danger">Thêm mới thành viên</strong>
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" href="#" name="CAPNHAT" type="summit" role="button">
                            <i class="far fa-save"></i> Lưu[Thêm]</button>
                        <a class="btn btn-danger btn-sm" href="index.php?option=user" role="button">
                            <i class="fas fa-times"></i> Thoát</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="">Họ tên thành viên</label>
                                <input type="text" class="form-control" value="<?php echo $row['fullname']; ?>" name="fullname" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" required value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Xác nhận lại email</label>
                                <input class="form-control" type="text" name="email_con" required required value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" required value="<?php echo $row['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Tên đăng nhập</label>
                                <input type="text" class="form-control" name="username" required value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu cũ</label>
                                <input type="password" class="form-control" name="password_cu" required placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu mới</label>
                                <input type="password" class="form-control" name="password" required placeholder="Xác nhận mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" name="password_con" required placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Giới tính</label>
                                <select class="form-control" name="gender" id="">
                                    <option value="1" <?php if ($row['gender'] == 1) {
                                                            echo 'gender';
                                                        } ?>>Nam</option>
                                    <option value="2" <?php if ($row['gender'] == 2) {
                                                            echo 'selected';
                                                        } ?>>Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Xét quyền</label>

                                <select class="form-control" name="access" id="">
                                    <option value="1" <?php if ($row['access'] == 1) {
                                                            echo 'selected';
                                                        } ?>>Administrator</option>
                                    <option value="2" <?php if ($row['access'] == 2) {
                                                            echo 'selected';
                                                        } ?>>Editor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Avatar</label>
                                <input type="file" class="form-control" name="img">
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