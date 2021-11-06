<?php

if (isset($_POST['THEM'])) {
    $user = loadModel('user');
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
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => 1,
            'status' => $_POST['status']
        );
        if (strlen($_FILES["img"]["name"]) == 0) {
            set_flash('message', ['type' => 'danger', 'msg' => 'Hình đại diện chưa chọn!']);
            redirect("index.php?option=user");
        }
        $dir_post = '../public/img/user/';
        $target_file = $dir_post . basename($_FILES["img"]["name"]);
        $type_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($type_file, ['jpg', 'png', 'gif', 'jpeg'])) {

            $file_name = $slug . '.' . $type_file;
            move_uploaded_file($_FILES['img']['tmp_name'], $dir_post . $file_name);
            $data['img'] = $file_name;
            $user->user_insert($data);
            set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công!']);
            redirect("index.php?option=user");
        } else {

            set_flash('message', ['type' => 'danger', 'msg' => 'Định dạng tệp tin không đúng!']);
            redirect("index.php?option=user");
        }
    }
    set_flash('message', ['type' => 'success', 'msg' => $error]);
    redirect('index.php?option=user');
}
?>
<?php require_once('views/header.php'); ?>
<form action="index.php?option=user&cat=insert" method="post" enctype="multipart/form-data">

    <div class="content-wrapper my-2">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <strong class="text-uppercase text-danger">Thêm mới thành viên</strong>
                    </h3>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" href="#" name="THEM" type="summit" role="button">
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
                                <input type="text" class="form-control" name="fullname" required placeholder="Họ và tên">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" required placeholder="Thư điện tử">
                            </div>
                            <div class="form-group">
                                <label for="">Xác nhận lại email</label>
                                <input class="form-control" type="text" name="email_con" required required placeholder="Xác nhận email">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" required placeholder="Số điện thoại">
                            </div>
                            <div class="form-group">
                                <label for="">Tên đăng nhập</label>
                                <input type="text" class="form-control" name="username" required placeholder="Tên đăng nhập">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" required placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="">Xác nhận Mật khẩu</label>
                                <input type="password" class="form-control" name="password_con" required placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Giới tính</label>
                                <select class="form-control" name="gender" required id="">
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Xét quyền</label>
                                <select class="form-control" name="access" required id="">
                                    <option>-- Chọn quyền --</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Editor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Avatar</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select class="form-control" name="status" required id="">
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